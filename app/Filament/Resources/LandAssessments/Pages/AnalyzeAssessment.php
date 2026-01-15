<?php

namespace App\Filament\Resources\LandAssessments\Pages;

use App\Filament\Resources\LandAssessments\LandAssessmentResource;
use App\Models\LandAssessment;
use App\Models\Product;
use App\Models\Recommendation;
use App\Models\SoilStandard;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Repeater\TableColumn;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;

class AnalyzeAssessment extends Page implements HasForms, HasInfolists
{
    use InteractsWithForms;
    use InteractsWithInfolists;

    protected static string $resource = LandAssessmentResource::class;

    protected string $view = 'filament.resources.land-assessments.pages.analyze-assessment';

    protected static ?string $title = 'Analisa & Rekomendasi';

    public LandAssessment $record;
    public ?array $data = [];

    public function mount(LandAssessment $record): void
    {
        $this->record = $record;
        if ($this->record->recommendation) {
            $this->form->fill($this->record->recommendation->toArray());
        }
    }

    public function getGapAnalysisData(): array
    {
        $lab = $this->record->labResult;
        
        if (!$lab) return [];

        $garden = $this->record->garden;
        
        $standard = SoilStandard::where('plant_type', $garden->plant_type)
                    ->where('soil_type', $garden->soil_type)
                    ->first();
        
        $stdValues = $standard ? $standard->standard_values : [];

        $params = [
            'ph_level'    => ['label' => 'pH Tanah', 'unit' => ''],
            'c_organic'   => ['label' => 'C-Organik', 'unit' => '%'],
            'ktk'         => ['label' => 'KTK', 'unit' => 'cmol'],

            'n_total'     => ['label' => 'Nitrogen (N)', 'unit' => '%'],
            'p_available' => ['label' => 'Phospat (P)', 'unit' => 'ppm'],
            'k_exchange'  => ['label' => 'Kalium (K)', 'unit' => 'cmol'],
            'mg_exchange' => ['label' => 'Magnesium (Mg)', 'unit' => 'cmol'],
            'ca_exchange' => ['label' => 'Kalsium (Ca)', 'unit' => 'cmol'],
            's_sulfur'    => ['label' => 'Sulfur (S)', 'unit' => 'ppm'],

            'boron'       => ['label' => 'Boron (B)', 'unit' => 'ppm'],
            'zinc'        => ['label' => 'Seng (Zn)', 'unit' => 'ppm'],
            'copper'      => ['label' => 'Tembaga (Cu)', 'unit' => 'ppm'],
        ];

        $results = [];

        foreach ($params as $key => $meta) {
            $actual = floatval($lab->{$key} ?? 0);
            $target = floatval($stdValues[$key] ?? 0);
            $gap = $target > 0 ? round($actual - $target, 2) : 0;
            
            $status = 'Normal';
            $color = 'success';
            
            if ($actual < $target) {
                $status = 'DEFISIT';
                $color = 'danger';
            } elseif ($actual > ($target * 1.5)) {
                $status = 'SURPLUS';
                $color = 'warning';
            }

            $results[] = [
                'parameter' => $meta['label'],
                'actual'    => $actual . ' ' . $meta['unit'],
                'target'    => $target . ' ' . $meta['unit'],
                'status'    => $status,
                'color'     => $color,
                'gap'       => $gap,
            ];
        }

        return $results;
    }
    public function infolist(Schema $infolist): Schema
    {
        return $infolist
            ->record($this->record)
            ->schema([
                Section::make('Informasi Pemilik & Lokasi')
                    ->icon('heroicon-o-user')
                    ->schema([
                        Grid::make(3)->schema([
                            Group::make([
                                TextEntry::make('garden.user.name')
                                    ->label('Nama Pemilik')
                                    ->weight(FontWeight::Bold)
                                    ->icon('heroicon-m-user'),
                                TextEntry::make('garden.user.phone')
                                            ->label('Kontak (WA)')
                                            ->icon('heroicon-m-phone')
                                            ->copyable(),
                            ]),
                            Group::make([
                                TextEntry::make('garden.name')
                                                ->label('Nama Blok/Kebun'),
                                TextEntry::make('garden.location')
                                                ->label('Alamat / Lokasi')
                                                ->icon('heroicon-m-map-pin'),
                                TextEntry::make('garden.plant_age')->label('Usia')->suffix(' Tahun'),
                            ]),
                            Group::make([
                                TextEntry::make('garden.plant_type')
                                    ->label('Komoditas')
                                    ->badge()
                                    ->color('success'),
                                TextEntry::make('garden.soil_type')
                                    ->label('Jenis Tanah')
                                    ->badge()
                                    ->color('warning'),
                                TextEntry::make('garden.area_size')
                                    ->label('Luas Lahan')
                                    ->suffix(' Ha')
                                    ->weight(FontWeight::Bold),
                                
                            ]),
                        
                        ]),
                       
                    ]),

                Section::make('Data Kuesioner (Kondisi Lapangan)')
                    ->icon('heroicon-o-clipboard-document-list')
                    ->schema([
                        Grid::make(3)->schema([
                            TextEntry::make('status')
                                ->label('Status Assessment')
                                ->badge(),
                            
                            TextEntry::make('plant_variety')
                                ->label('Varietas Bibit')
                                ->placeholder('-'),

                            TextEntry::make('topography')
                                ->label('Topografi / Kontur')
                                ->icon('heroicon-m-chart-bar')
                                ->placeholder('-'),
                        ]),

                        Section::make('Statistik Panen')
                            ->schema([
                                Grid::make(3)->schema([
                                    TextEntry::make('bunch_weight')
                                        ->label('Berat Tandan Rata-rata'),
                                    
                                    TextEntry::make('current_yield')
                                        ->label('Panen Saat Ini (Aktual)'),
                                    
                                    TextEntry::make('target_yield')
                                        ->label('Target Panen')
                                        ->color('primary')
                                        ->weight(FontWeight::Bold),
                                ]),
                            ])->compact(),

                        Grid::make(2)->schema([
                            TextEntry::make('current_condition')
                                ->label('Kondisi Visual Tanaman')
                                ->columnSpan(1),
                            
                            TextEntry::make('fertilizer_history')
                                ->label('Riwayat Pemupukan (6 Bulan)')
                                ->columnSpan(1),
                        ]),
                    ]),

                Section::make('Dokumentasi Visual')
                    ->icon('heroicon-o-camera')
                    ->schema([
                        ImageEntry::make('photos')
                            ->label('Foto Lapangan')
                            ->disk('public') 
                            ->columnSpanFull()
                            ->height(150),
                        
                        TextEntry::make('video_url')
                            ->label('Link Video')
                            ->icon('heroicon-m-video-camera')
                            ->formatStateUsing(fn ($state) => $state ? 'Tonton Video Lapangan' : 'Tidak ada video')
                            ->url(fn ($state) => $state)
                            ->openUrlInNewTab()
                            ->color('primary')
                            ->visible(fn ($state) => !empty($state)),
                    ])->collapsible(),
                

                Section::make('Analisa Kesenjangan Hara (Gap Analysis)')
                    ->icon('heroicon-o-beaker')
                    ->description('Perbandingan Hasil Lab Aktual vs Standar Ideal.')
                    ->schema([
                        RepeatableEntry::make('gap_data')
                            ->label('')
                            ->state(fn () => $this->getGapAnalysisData()) 
                            ->table([
                                TableColumn::make('Parameter'),
                                TableColumn::make('Hasil Lab'),
                                TableColumn::make('Standar'),
                                TableColumn::make('Status'),
                                TableColumn::make('Selisih (Gap)'),
                            ])
                            ->schema([
                                TextEntry::make('parameter')
                                    ->label('Parameter')
                                    ->weight(FontWeight::Bold),
                                
                                TextEntry::make('actual')
                                    ->label('Hasil Lab'),
                                
                                TextEntry::make('target')
                                    ->label('Standar'),
                                
                                TextEntry::make('status')
                                    ->label('Status')
                                    ->badge()
                                    ->color(fn ($state) => match ($state) {
                                        'DEFISIT' => 'danger',
                                        'SURPLUS' => 'warning',
                                        default => 'success',
                                    }),
                                
                                TextEntry::make('gap')
                                    ->label('Selisih (Gap)')
                                    ->color(fn ($record) => $record['status'] === 'DEFISIT' ? 'danger' : 'gray')
                                    ->weight(FontWeight::Bold),
                            ])
                            ->columns(5) 
                            ->contained(false)
                    ])
                    ->visible(fn () => !empty($this->getGapAnalysisData())),
                
                Section::make('Menunggu Data Lab')
                    ->schema([
                        TextEntry::make('alert')
                            ->label('')
                            ->default('⚠️ Data Hasil Lab belum diinputkan. Silakan kembali ke menu Edit dan input data lab di tab "Hasil Laboratorium" sebelum membuat rekomendasi.')
                            ->color('danger')
                            ->weight(FontWeight::Bold)
                    ])
                    ->visible(fn () => empty($this->getGapAnalysisData())),
            ]);
    }

    public function form(Schema $form): Schema
    {
        return $form
            ->schema([
                Section::make('Keputusan Agronom / Analyst')
                    ->schema([
                        RichEditor::make('summary')
                            ->label('Diagnosa & Kesimpulan')
                            ->required()
                            ->columnSpanFull(),

                        Repeater::make('product_recommendations')
                            ->label('Resep Produk')
                            ->schema([
                                Select::make('product_id')
                                    ->label('Produk')
                                    ->options(Product::where('is_active', true)->pluck('name', 'id'))
                                    ->required()
                                    ->searchable()
                                    ->columnSpan(4),
                                
                                TextInput::make('dosage')
                                    ->label('Dosis')
                                    ->required()
                                    ->columnSpan(3),
                                
                                TextInput::make('frequency')
                                    ->label('Frekuensi')
                                    ->required()
                                    ->columnSpan(3),
                            ])
                            ->columns(10)
                            ->addActionLabel('Tambah Resep'),

                        RichEditor::make('application_notes')
                            ->label('Catatan Aplikasi')
                            ->columnSpanFull(),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        Recommendation::updateOrCreate(
            ['land_assessment_id' => $this->record->id],
            [
                'summary' => $data['summary'],
                'product_recommendations' => $data['product_recommendations'],
                'application_notes' => $data['application_notes'],
            ]
        );
        
        $this->record->update(['status' => 'completed']);

        Notification::make()->success()->title('Rekomendasi Berhasil Disimpan')->send();
    }
}
