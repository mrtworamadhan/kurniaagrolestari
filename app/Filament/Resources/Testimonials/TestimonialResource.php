<?php

namespace App\Filament\Resources\Testimonials;

use App\Filament\Resources\Testimonials\Pages\ManageTestimonials;
use App\Models\Testimonial;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;
use UnitEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChatBubbleBottomCenterText;

    protected static string | UnitEnum | null $navigationGroup = 'CMS & Website';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationLabel = 'Testimoni';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Data Testimoni')
                    ->columnSpanFull()
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('name')
                                    ->label('Nama Orang')
                                    ->required()
                                    ->placeholder('Pak Budi'),
                                
                                TextInput::make('role')
                                    ->label('Jabatan / Status')
                                    ->placeholder('Petani Sawit - Riau'),
                            ]),
                            
                        Select::make('rating')
                            ->label('Bintang Rating')
                            ->options([
                                5 => '⭐️⭐️⭐️⭐️⭐️ (5 - Sempurna)',
                                4 => '⭐️⭐️⭐️⭐️ (4 - Bagus)',
                                3 => '⭐️⭐️⭐️ (3 - Cukup)',
                                2 => '⭐️⭐️ (2 - Kurang)',
                                1 => '⭐️ (1 - Buruk)',
                            ])
                            ->default(5)
                            ->required(),

                        Textarea::make('content')
                            ->label('Isi Testimoni')
                            ->rows(3)
                            ->required(),

                        FileUpload::make('avatar')
                            ->label('Foto Orang')
                            ->avatar()
                            ->disk('public')
                            ->visibility('public')
                            ->directory('testimonials'),

                        Toggle::make('is_active')
                            ->label('Tampilkan di Web')
                            ->default(true),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                ImageColumn::make('avatar')
                    ->circular(),

                TextColumn::make('name')
                    ->searchable()
                    ->description(fn (Testimonial $record) => $record->role),

                TextColumn::make('rating')
                    ->label('Rating')
                    ->formatStateUsing(fn (string $state): string => str_repeat('⭐️', $state)),

                ToggleColumn::make('is_active')
                    ->label('Tampil'),
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
            'index' => ManageTestimonials::route('/'),
        ];
    }
}
