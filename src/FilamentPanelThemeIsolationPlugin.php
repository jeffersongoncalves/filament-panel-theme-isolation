<?php

namespace JeffersonGoncalves\FilamentPanelThemeIsolation;

use Filament\Contracts\Plugin;
use Filament\Panel;

class FilamentPanelThemeIsolationPlugin implements Plugin
{
    public static function make(): static
    {
        return app(static::class);
    }

    public static function get(): static
    {
        return filament(app(static::class)->getId());
    }

    public function getId(): string
    {
        return 'filament-panel-theme-isolation';
    }

    public function register(Panel $panel): void
    {
        //
    }

    public function boot(Panel $panel): void
    {
        //
    }
}
