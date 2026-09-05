<div class="filament-hidden">

![Filament Panel Theme Isolation](https://raw.githubusercontent.com/jeffersongoncalves/filament-panel-theme-isolation/1.x/art/jeffersongoncalves-filament-panel-theme-isolation.png)

</div>

# Filament Panel Theme Isolation

[![Buy Me A Coffee](https://img.shields.io/badge/Buy%20Me%20A%20Coffee-support-FFDD00?style=flat-square&logo=buy-me-a-coffee&logoColor=black)](https://buymeacoffee.com/jeffersongoncalves)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/jeffersongoncalves/filament-panel-theme-isolation.svg?style=flat-square)](https://packagist.org/packages/jeffersongoncalves/filament-panel-theme-isolation)
[![Total Downloads](https://img.shields.io/packagist/dt/jeffersongoncalves/filament-panel-theme-isolation.svg?style=flat-square)](https://packagist.org/packages/jeffersongoncalves/filament-panel-theme-isolation)
[![License](https://img.shields.io/packagist/l/jeffersongoncalves/filament-panel-theme-isolation.svg?style=flat-square)](LICENSE.md)

Isolates dark/light theme preference per Filament panel using prefixed localStorage keys.

When a Filament application has multiple panels (e.g., `admin`, `app`, `tenant`), they all share the same `theme` key in `localStorage`. Switching dark/light mode in one panel affects all others. This plugin fixes that by using panel-specific keys like `theme-admin`, `theme-app`, etc.

Based on [filamentphp/filament#19417](https://github.com/filamentphp/filament/pull/19417).

## Compatibility

| Plugin Version | Filament | PHP | Laravel |
|----------------|----------|-----|---------|
| 1.x | ^3.0 | ^8.1 | ^10.0 |
| 2.x | ^4.0 | ^8.2 | ^11.0 |
| 3.x | ^5.0 | ^8.2 | ^11.28 |

## Installation

You can install the package via composer:

```bash
composer require jeffersongoncalves/filament-panel-theme-isolation:"^1.0"
```

That's it! The plugin works automatically via Laravel auto-discovery. No additional configuration is needed.

### Optional: Register as a Filament Plugin

If you prefer explicit registration via the plugin API:

```php
use JeffersonGoncalves\FilamentPanelThemeIsolation\FilamentPanelThemeIsolationPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->id('admin')
        ->plugin(FilamentPanelThemeIsolationPlugin::make());
}
```

## How It Works

1. Each panel saves its theme preference to a unique localStorage key: `theme-{panelId}` (e.g., `theme-admin`, `theme-app`).
2. On first load after installing, the existing generic `theme` key is automatically migrated to the panel-specific key.
3. If the panel-specific key doesn't exist, it falls back to the generic `theme` key for backwards compatibility.
4. No database or session changes required — everything is localStorage.

## Publishing

### Config

```bash
php artisan vendor:publish --tag=filament-panel-theme-isolation-config
```

### Views

```bash
php artisan vendor:publish --tag=filament-panel-theme-isolation-views
```

## Maintenance Notes

The overridden views are copies of Filament's original views with minimal patches.

After updating Filament, compare the original views with the overrides:

```bash
diff vendor/filament/filament/packages/panels/resources/views/components/layout/base.blade.php \
     vendor/jeffersongoncalves/filament-panel-theme-isolation/resources/views/components/layout/base.blade.php
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Security Vulnerabilities

Please see [SECURITY](.github/SECURITY.md) for details.

## Credits

- [Jefferson Gonçalves](https://github.com/jeffersongoncalves)

## License

MIT License. See [LICENSE](LICENSE) for details.
