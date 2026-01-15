<?php

namespace App\Providers\Filament;

use Filament\Enums\DatabaseNotificationsPosition;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Notifications\DatabaseNotification;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                
            ])
            ->navigationGroups([
                NavigationGroup::make()
                    ->label('Laporan')
                    ->collapsible(false),
                NavigationGroup::make()
                    ->label('Toko & Transaksi')
                    ->collapsible(false),
                NavigationGroup::make()
                    ->label('Smart Farming')
                    ->collapsible(true),
                NavigationGroup::make()
                    ->label('Master Data')
                    ->collapsible(true),
                NavigationGroup::make()
                    ->label('CMS & Website')
                    ->collapsible(true),
                NavigationGroup::make()
                    ->label('User Management')
                    ->collapsible(true),    
                NavigationGroup::make()
                    ->label('Setting Perusahaan')
                    ->collapsible(true),
                
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->plugins([
                FilamentShieldPlugin::make()
                    ->navigationLabel('Roles Setting')
                    ->navigationGroup('User Management'),  
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->databaseNotifications()
            ->databaseNotifications(position: DatabaseNotificationsPosition::Sidebar)
            ->sidebarCollapsibleOnDesktop(condition: true);
    }
}
