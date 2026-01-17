<?php

namespace App\Filament\Resources\CompanyDocuments;

use App\Filament\Resources\CompanyDocuments\Pages\ManageCompanyDocuments;
use App\Models\CompanyDocument;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;
use UnitEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CompanyDocumentResource extends Resource
{
    protected static ?string $model = CompanyDocument::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static string | UnitEnum | null $navigationGroup = 'Setting Perusahaan';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Legalitas & Dokumen';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Dokumen')
                            ->placeholder('Contoh: NIB / NPWP / SIUP')
                            ->required(),

                        TextInput::make('document_number')
                            ->label('Nomor SK / Dokumen'),

                        FileUpload::make('file_path')
                            ->label('Upload File (PDF/Gambar)')
                            ->disk('public')
                            ->visibility('public')
                            ->directory('legal-docs')
                            ->acceptedFileTypes(['application/pdf', 'image/*'])
                            ->required()
                            ->columnSpanFull(),

                        Textarea::make('description')
                            ->label('Keterangan')
                            ->rows(2)
                            ->columnSpanFull(),
                    ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->weight('bold'),

                TextColumn::make('document_number')
                    ->label('Nomor Dokumen'),

                TextColumn::make('file_path')
                    ->label('File')
                    ->formatStateUsing(fn () => 'Lihat File')
                    ->icon('heroicon-m-arrow-top-right-on-square')
                    ->url(fn ($record) => asset('storage/' . $record->file_path))
                    ->openUrlInNewTab()
                    ->color('info'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageCompanyDocuments::route('/'),
        ];
    }
}
