/**
 * Panel Theme Isolation — dark-mode.js override
 *
 * This script patches the Alpine theme store to use panel-specific
 * localStorage keys (e.g., 'theme-admin' instead of 'theme').
 *
 * It runs on 'alpine:init' alongside Filament's own index.js.
 * Since Filament's index.js also listens for 'alpine:init', this script
 * re-initializes the theme store with the correct panel-prefixed key.
 */
document.addEventListener('alpine:init', () => {
    const panelId = getComputedStyle(document.documentElement)
        .getPropertyValue('--panel-id')
        .trim()
        .replace(/['"]/g, '')

    if (!panelId) {
        return
    }

    const storageKey = `theme-${panelId}`

    // Migrate legacy 'theme' key to panel-specific key (one-time)
    if (!localStorage.getItem(storageKey) && localStorage.getItem('theme')) {
        localStorage.setItem(storageKey, localStorage.getItem('theme'))
    }

    const theme =
        localStorage.getItem(storageKey) ??
        localStorage.getItem('theme') ??
        getComputedStyle(document.documentElement).getPropertyValue(
            '--default-theme-mode',
        ) ??
        'light'

    // Re-initialize the Alpine theme store with the correct value
    window.Alpine.store(
        'theme',
        theme === 'dark' ||
            (theme === 'system' &&
                window.matchMedia('(prefers-color-scheme: dark)').matches)
            ? 'dark'
            : 'light',
    )

    // Override the theme-changed listener to use prefixed key
    window.addEventListener('theme-changed', (event) => {
        let theme = event.detail

        localStorage.setItem(storageKey, theme)

        if (theme === 'system') {
            theme = window.matchMedia('(prefers-color-scheme: dark)').matches
                ? 'dark'
                : 'light'
        }

        window.Alpine.store('theme', theme)
    })

    // Override system preference listener to use prefixed key
    window
        .matchMedia('(prefers-color-scheme: dark)')
        .addEventListener('change', (event) => {
            if (localStorage.getItem(storageKey) === 'system') {
                window.Alpine.store('theme', event.matches ? 'dark' : 'light')
            }
        })
})
