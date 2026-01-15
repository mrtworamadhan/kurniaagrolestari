<?php

namespace App\Filament\Resources\LandAnalysisRequests;

use App\Filament\Resources\LandAnalysisRequests\Pages\ManageLandAnalysisRequests;
use App\Models\Garden;
use App\Models\LandAnalysisRequest;
use App\Models\LandAssessment;
use App\Models\User;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LandAnalysisRequestResource extends Resource
{
    protected static ?string $model = LandAnalysisRequest::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedInboxArrowDown;

    protected static ?string $navigationLabel = 'Request Analisa Lahan';

    protected static ?int $navigationSort = 2;
    protected static ?string $recordTitleAttribute = 'name';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', ['pending'])->count();
    }
    
    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function getNavigationBadgeTooltip(): ?string
    {
        return 'Permohonan Analisa Baru';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                ->schema([
                    
                    Section::make('Informasi Pemilik')
                        ->description('Data diri calon client')
                        ->icon('heroicon-m-user')
                        ->schema([
                            TextInput::make('owner_name')
                                ->label('Nama Pemilik')
                                ->required()
                                ->prefixIcon('heroicon-m-user'),
                            
                            TextInput::make('phone')
                                ->label('WhatsApp / HP')
                                ->tel()
                                ->required()
                                ->prefixIcon('heroicon-m-phone'),
                            
                            TextInput::make('email')
                                ->email()
                                ->prefixIcon('heroicon-m-envelope'),
                            
                            TextInput::make('city')
                                ->label('Kota/Kabupaten')
                                ->prefixIcon('heroicon-m-map-pin'),

                            Textarea::make('address')
                                ->label('Alamat Lengkap')
                                ->rows(2)
                                ->columnSpanFull(),
                        ])->columns(2),

                    Section::make('Data Teknis Kebun')
                        ->icon('heroicon-m-map')
                        ->schema([
                            TextInput::make('location')
                                ->label('Lokasi Kebun')
                                ->required(),
                            
                            TextInput::make('area_size')
                                ->label('Luas Lahan')
                                ->numeric()
                                ->suffix('Hektar'),

                            TextInput::make('plant_type')
                                ->label('Komoditas'),

                            TextInput::make('plant_age')
                                ->label('Usia Tanam')
                                ->numeric()
                                ->suffix('Tahun'),

                            Select::make('soil_type_id')
                                ->label('Jenis Tanah')
                                ->relationship('soilType', 'name')
                                ->preload()
                                ->searchable()
                                ->createOptionForm([
                                    TextInput::make('name')->required(),
                                ]),

                            TextInput::make('topography')
                                ->label('Kontur Lahan'),
                        ])->columns(2),

                    Section::make('Diagnosa & Masalah')
                        ->icon('heroicon-m-clipboard-document-list')
                        ->schema([
                            TextInput::make('plant_variety')
                                ->label('Varietas Bibit'),
                            
                            TextInput::make('bunch_weight')
                                ->label('Berat Janjang (BJR)')
                                ->suffix('kg'),

                            RichEditor::make('current_condition')
                                ->label('Kondisi Saat Ini (Keluhan)')
                                ->toolbarButtons(['bold', 'italic', 'bulletList'])
                                ->columnSpanFull(),

                            Textarea::make('fertilizer_history')
                                ->label('Riwayat Pemupukan (6 Bulan Terakhir)')
                                ->rows(3)
                                ->columnSpanFull(),
                        ])->columns(2),
                ])
                ->columnSpan(['lg' => 2]), 

            Group::make()
                ->schema([
                    
                    Section::make('Status Request')
                        ->schema([
                            Select::make('status')
                                ->options([
                                    'pending' => 'Pending',
                                    'contacted' => 'Sudah Dihubungi',
                                    'converted' => 'Diterima (Client)',
                                    'rejected' => 'Ditolak',
                                ])
                                ->default('pending')
                                ->required()
                                ->selectablePlaceholder(false)
                                ->native(false),
                        ]),

                    Section::make('Target Produksi')
                        ->schema([
                            TextInput::make('current_yield')
                                ->label('Panen Sekarang')
                                ->suffix('Ton/Bln'),
                            
                            TextInput::make('target_yield')
                                ->label('Target Harapan')
                                ->suffix('Ton/Bln')
                                ->extraInputAttributes(['class' => 'text-primary-600 font-bold']),
                        ]),

                    Section::make('Dokumentasi')
                        ->schema([
                            FileUpload::make('photos')
                                ->label('Foto Kondisi Kebun')
                                ->image()
                                ->multiple()
                                ->imageEditor()
                                ->disk('public')
                                ->directory('requests-photos')
                                ->columnSpanFull(),

                            TextInput::make('video_url')
                                ->label('Link Video')
                                ->placeholder('https://...')
                                ->suffixIcon('heroicon-m-video-camera'),
                            
                            TextInput::make('coordinates')
                                ->label('Titik Koordinat')
                                ->suffixIcon('heroicon-m-map-pin'),
                        ]),
                ])
                ->columnSpan(['lg' => 1]), 
        ])
        ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Tgl Masuk')
                    ->sortable(),
                TextColumn::make('owner_name')
                    ->label('Nama')
                    ->searchable(),
                TextColumn::make('phone')
                    ->label('WA'),
                TextColumn::make('plant_type')
                    ->label('Tanaman'),
                TextColumn::make('area_size')
                    ->label('Luas (Ha)'),
                TextColumn::make('soilType.name')
                    ->label('Tanah')
                    ->badge(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'converted' => 'success',
                        'rejected' => 'danger',
                    }),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                
                Action::make('convert')
                    ->label('Terima & Jadi Client')
                    ->icon('heroicon-m-user-plus')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Konversi Menjadi Client Resmi')
                    ->modalDescription('Aksi ini akan otomatis membuat akun User, Data Kebun, dan Data Assessment berdasarkan request ini. Password default user adalah: "password123"')
                    ->visible(fn (LandAnalysisRequest $record) => $record->status === 'pending')
                    ->action(function (LandAnalysisRequest $record) {
                        
                        DB::transaction(function () use ($record) {
                            $user = User::firstOrCreate(
                                ['email' => $record->email ?? $record->phone.'@kurniaagro.com'],
                                [
                                    'name' => $record->owner_name,
                                    'phone' => $record->phone,
                                    'password' => Hash::make('password123'),
                                    'role' => 'client',
                                    'is_active' => 1,
                                ]
                            );

                            $garden = Garden::create([
                                'user_id' => $user->id,
                                'name' => 'Kebun ' . $record->location, 
                                'plant_type' => $record->plant_type,
                                'soil_type_id' => $record->soil_type_id,
                                'area_size' => $record->area_size,
                                'plant_age' => $record->plant_age,
                                'location' => $record->location,
                                'coordinates' => $record->coordinates,
                            ]);

                            LandAssessment::create([
                                'garden_id' => $garden->id,
                                'status' => 'pending',
                                'plant_variety' => $record->plant_variety,
                                'topography' => $record->topography,
                                'current_condition' => $record->current_condition,
                                'fertilizer_history' => $record->fertilizer_history,
                                'bunch_weight' => $record->bunch_weight,
                                'current_yield' => $record->current_yield,
                                'target_yield' => $record->target_yield,
                                'photos' => $record->photos,
                                'video_url' => $record->video_url,
                            ]);

                            $record->update(['status' => 'converted']);
                        });

                        Notification::make()->title('Berhasil dikonversi menjadi Client!')->success()->send();
                    }),
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
            'index' => ManageLandAnalysisRequests::route('/'),
        ];
    }
}
