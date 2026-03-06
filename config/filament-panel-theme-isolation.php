<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Migrate Legacy Key
    |--------------------------------------------------------------------------
    |
    | When enabled, on first page load the plugin will copy the existing
    | generic 'theme' localStorage key to the panel-specific key
    | 'theme-{panelId}'. This ensures a seamless transition for users
    | who already had a theme preference saved before installing this plugin.
    |
    */

    'migrate_legacy_key' => true,

];
