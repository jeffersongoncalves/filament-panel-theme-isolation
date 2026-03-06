<?php

namespace JeffersonGoncalves\FilamentPanelThemeIsolation\Tests\Fixtures;

use Filament\Panel;
use Filament\PanelProvider;
use JeffersonGoncalves\FilamentPanelThemeIsolation\FilamentPanelThemeIsolationPlugin;

class TestPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->plugin(FilamentPanelThemeIsolationPlugin::make());
    }
}
