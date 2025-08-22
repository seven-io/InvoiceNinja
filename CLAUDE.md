# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is the **Seven module** for InvoiceNinja - a Laravel module that integrates Seven.io's SMS/messaging services. The module automatically sends SMS notifications when clients are created and provides a settings interface for API configuration.

## Development Commands

### Frontend Build
```bash
npm run dev    # Development server with Vite
npm run build  # Production build with asset optimization
```

### PHP Dependencies
```bash
composer install  # Install PHP dependencies including Seven.io API client
```

## Architecture

This follows Laravel's **modular architecture** using nwidart/laravel-modules pattern. The module is completely self-contained with its own:

- Service providers (`app/Providers/SevenServiceProvider.php`)
- Controllers (stub implementations need completion)
- Event listeners (`app/Listeners/ClientWasCreatedListener.php`)
- Routes (`routes/web.php`, `routes/api.php`)
- Configuration (`config/seven.php`, `module.json`)
- Frontend assets with Vite build pipeline

### Key Components

**Event-Driven SMS Integration:**
- `ClientWasCreatedListener` responds to InvoiceNinja's `ClientWasCreated` events
- Sends personalized SMS via Seven.io API with template variable substitution
- Template format: `{{field_name}}` maps to client object properties

**Configuration System:**
- Module settings defined in `module.json` with JSON schema validation
- Runtime config in `config/seven.php` with environment variable support
- Required: `SEVEN_API_KEY` environment variable

**Frontend Build:**
- Vite configuration outputs to `../../public/build-seven/`
- Separate build directory prevents conflicts with main InvoiceNinja app
- SCSS preprocessing with Laravel Vite plugin integration

### External Dependencies

- **Seven.io API Client** (`seven.io/api` v7.0.0) - Official PHP SDK for SMS functionality
- API endpoint: `https://gateway.seven.io/api/sms`

## Development Status

Currently **WIP (Work In Progress)** - core SMS functionality implemented but requires:
- Controller implementation for settings UI (`SettingsController`, `SevenController`)
- Frontend components for module configuration
- Test suite implementation (directories exist but empty)

## File Structure Notes

- Module metadata and provider registration: `module.json`
- Main service provider: `app/Providers/SevenServiceProvider.php`
- Core business logic: `app/Listeners/ClientWasCreatedListener.php`
- Build configuration: `vite.config.js` (outputs to main app public directory)
- No database migrations (stateless design)