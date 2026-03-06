<?php

namespace JeffersonGoncalves\FilamentPanelThemeIsolation;

use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentPanelThemeIsolationServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-panel-theme-isolation';

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$name)
            ->hasConfigFile();
    }

    public function packageBooted(): void
    {
        // Override Filament views with patched versions
        $this->callAfterResolving('view', function ($view) {
            /** @var \Illuminate\View\FileViewFinder $finder */
            $finder = $view->getFinder();
            $finder->prependNamespace('filament-panels', __DIR__ . '/../resources/views');
        });

        // Override dark-mode.js with patched version
        FilamentAsset::register([
            Js::make('dark-mode', __DIR__ . '/../resources/js/dark-mode.js'),
        ], 'filament/filament');
    }
}
