# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [1.0.0] - 2026-03-05

### Added

- Panel-specific localStorage keys for theme preference (`theme-{panelId}`)
- Automatic migration of legacy `theme` key to panel-specific key on first load
- Fallback to generic `theme` key when panel-specific key is not set
- CSS variable `--panel-id` injection for JavaScript-side panel identification
- Publishable config and views
- Plugin class for optional `->plugin()` registration
