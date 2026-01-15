<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Akun')
                    ->description('Data untuk login ke aplikasi.')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        TextInput::make('password')
                            ->password()
                            ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                            ->dehydrated(fn ($state) => filled($state)) 
                            ->required(fn (string $context): bool => $context === 'create') 
                            ->label(fn (string $context): string => $context === 'edit' ? 'Password Baru (Opsional)' : 'Password'),

                        Select::make('role')
                            ->label('Role Aplikasi')
                            ->options([
                                'admin' => 'Administrator',
                                'analyst' => 'Analyst (Agronom)',
                                'sales' => 'Sales / Marketing',
                                'client' => 'Client / Petani',
                            ])
                            ->default('client')
                            ->required()
                            ->native(false),
                        
                        Select::make('customer_group')
                            ->label('Group Pelanggan')
                            ->helperText('Menentukan level harga produk (Retail/Agen).')
                            ->options([
                                'retail' => 'Retail (Umum)',
                                'agent' => 'Agen (Harga Khusus)',
                                'distributor' => 'Distributor (Harga Pabrik)',
                            ])
                            ->default('retail')
                            ->required()
                            ->native(false),
                        
                        Toggle::make('is_active')
                            ->label('Akun Aktif')
                            ->default(true),
                    ])->columns(2),

                Section::make('Profil & Alamat')
                    ->description('Data lengkap untuk pengiriman dan kontak.')
                    ->schema([
                        FileUpload::make('avatar')
                            ->label('Foto Profil')
                            ->avatar()
                            ->image()
                            ->disk('public')
                            ->visibility('public')
                            ->directory('avatars')
                            ->columnSpanFull(),

                        TextInput::make('phone')
                            ->label('No. WhatsApp')
                            ->tel()
                            ->required(),

                        TextInput::make('city')
                            ->label('Kota / Kabupaten'),

                        Textarea::make('address')
                            ->label('Alamat Lengkap')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])->columns(2)
                    ->collapsible(),
            ]);
    }
}
