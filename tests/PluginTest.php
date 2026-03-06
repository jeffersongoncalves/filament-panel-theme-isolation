<?php

use Filament\Facades\Filament;
use JeffersonGoncalves\FilamentPanelThemeIsolation\FilamentPanelThemeIsolationPlugin;

it('registers the plugin', function () {
    $panel = Filament::getCurrentPanel() ?? Filament::getPanel('admin');
    $plugin = $panel->getPlugin('filament-panel-theme-isolation');

    expect($plugin)->toBeInstanceOf(FilamentPanelThemeIsolationPlugin::class);
});

it('has the correct plugin id', function () {
    $plugin = FilamentPanelThemeIsolationPlugin::make();

    expect($plugin->getId())->toBe('filament-panel-theme-isolation');
});

it('publishes config file', function () {
    $configPath = config_path('filament-panel-theme-isolation.php');

    // Clean up if exists from previous test
    if (file_exists($configPath)) {
        unlink($configPath);
    }

    $this->artisan('vendor:publish', [
        '--tag' => 'filament-panel-theme-isolation-config',
        '--force' => true,
    ])->assertSuccessful();

    expect(file_exists($configPath))->toBeTrue();

    // Clean up
    unlink($configPath);
});

it('has migrate_legacy_key config option', function () {
    expect(config('filament-panel-theme-isolation.migrate_legacy_key'))->toBeTrue();
});

it('overrides base layout view', function () {
    $view = view('filament-panels::components.layout.base');

    expect($view->getPath())->toContain('filament-panel-theme-isolation');
});

it('overrides theme switcher view', function () {
    $view = view('filament-panels::components.theme-switcher.index');

    expect($view->getPath())->toContain('filament-panel-theme-isolation');
});
