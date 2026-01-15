<?php

namespace App\Filament\Pages;

use App\Filament\Exports\FinancialReportExporter;
use App\Models\Order;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Carbon\Carbon;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Actions\ExportAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;
use BackedEnum;

class FinancialReport extends Page implements HasTable, HasForms, HasActions
{
    use HasPageShield;
    use InteractsWithActions;
    use InteractsWithTable;
    use InteractsWithForms;

    protected string $view = 'filament.pages.financial-report';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPresentationChartLine;

    protected static string | UnitEnum | null $navigationGroup = 'Laporan';

    protected static ?string $title = 'Laporan Keuangan';

    protected static ?int $navigationSort = 1;

    public ?array $data = [];

    public function table(Table $table): Table
    {
        return $table
            ->query(Order::query())
            ->columns([
                TextColumn::make('created_at')->date()->label('Tanggal'),
                TextColumn::make('invoice_number')->label('Invoice')->searchable(),
                TextColumn::make('user.name')->label('Pelanggan'),
                
                TextColumn::make('payment_status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'paid' => 'success',
                        'partial' => 'warning',
                        'unpaid' => 'danger',
                    }),

                TextColumn::make('total_amount')
                    ->label('Omzet')
                    ->money('IDR')
                    ->summarize([
                        Sum::make()->label('Total Omzet'),
                    ]),

                TextColumn::make('paid_amount')
                    ->label('Uang Masuk (Cashflow)')
                    ->money('IDR')
                    ->summarize([
                        Sum::make()->label('Total Uang Masuk'),
                    ]),
            ])
            ->filters([
                Filter::make('periode')
                    ->form([
                        DatePicker::make('start_date')
                            ->label('Dari Tanggal')
                            ->default(now()->startOfMonth()),
                        DatePicker::make('end_date')
                            ->label('Sampai Tanggal')
                            ->default(now()),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['start_date'],
                                fn (Builder $query, $date) => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['end_date'],
                                fn (Builder $query, $date) => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['start_date'] ?? null) $indicators[] = 'Dari: ' . Carbon::parse($data['start_date'])->toFormattedDateString();
                        if ($data['end_date'] ?? null) $indicators[] = 'Sampai: ' . Carbon::parse($data['end_date'])->toFormattedDateString();
                        return $indicators;
                    }),
            ])
            
            ->headerActions([
                ExportAction::make()
                    ->exporter(FinancialReportExporter::class) 
                    ->label('Download Excel Keuangan')
                    ->icon('heroicon-m-document-arrow-down')
                    ->color('success')
                    ->columnMapping(false)
                    ->fileName(fn () => 'Laporan-Keuangan-' . date('Y-m-d')),
            ]);
    }
    public function updatedData()
    {
        $this->resetTable();
    }
}
