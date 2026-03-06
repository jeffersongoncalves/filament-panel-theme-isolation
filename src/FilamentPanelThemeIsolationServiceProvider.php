<?php

namespace JeffersonGoncalves\FilamentPanelThemeIsolation;

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
        $this->callAfterResolving('view', function ($view) {
            /** @var \Illuminate\View\FileViewFinder $finder */
            $finder = $view->getFinder();
            $finder->prependNamespace('filament-panels', __DIR__ . '/../resources/views');
        });
    }
}
