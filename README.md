<p align="center">
  <img src="https://www.seven.io/wp-content/uploads/Logo.svg" width="250" alt="seven logo" />
</p>

<h1 align="center">seven SMS for InvoiceNinja</h1>

<p align="center">
  Send transactional SMS to clients and vendors of <a href="https://www.invoiceninja.com/">InvoiceNinja</a> via the seven gateway. Auto-fires on creation events.
</p>

<p align="center">
  <a href="LICENSE"><img src="https://img.shields.io/badge/License-MIT-teal.svg" alt="MIT License" /></a>
  <img src="https://img.shields.io/badge/InvoiceNinja-5.x-blue" alt="InvoiceNinja 5.x" />
  <img src="https://img.shields.io/badge/PHP-8.1%2B-purple" alt="PHP 8.1+" />
  <img src="https://img.shields.io/badge/status-WIP-orange" alt="Work in Progress" />
</p>

> **Heads up:** Core SMS dispatch is implemented; the settings UI is still being built out.

---

## Features

- **Client Creation SMS** - Auto-fire on `ClientWasCreated`
- **Vendor Creation SMS** - Auto-fire on `VendorWasCreated`
- **Template Variables** - Reference any field on the client/vendor object via `{{field}}`
- **Robust Error Handling** - Failures are logged without breaking InvoiceNinja core flows
- **Modular** - Self-contained Laravel module, no patches to core

## Prerequisites

- An [InvoiceNinja](https://www.invoiceninja.com/) installation
- PHP 8.1+ and Composer
- Node.js + npm (for building frontend assets)
- A [seven account](https://www.seven.io/) with API key ([How to get your API key](https://help.seven.io/en/developer/where-do-i-find-my-api-key))

## Installation

### 1. Enable module autoloading

Add `Modules\\` to PSR-4 in InvoiceNinja's `composer.json`:

```json
{
  "autoload": {
    "psr-4": {
      "App\\": "app/",
      "Modules\\": "Modules/"
    }
  }
}
```

### 2. Install the module

```bash
composer require seven.io/invoiceninja
composer dump-autoload
```

### 3. Configure the API key

```dotenv
SEVEN_API_KEY=your-seven-api-key
```

The module is auto-discovered. Configure events and templates from the InvoiceNinja modules UI.

## Configuration

| Setting | Description |
|---------|-------------|
| `apiKey` | seven API key (defaults to `SEVEN_API_KEY` env) |
| `sms.from` | Default sender ID |
| `events.clientCreated.enabled` | Toggle client-creation SMS |
| `events.clientCreated.text` | Template for the SMS body |
| `events.vendorCreated.enabled` | Toggle vendor-creation SMS |
| `events.vendorCreated.text` | Template for the SMS body |

### Template variables

Any field on the client/vendor object can be referenced:

```
Hello {{name}}, welcome! Your email {{email}} is now registered.
```

## Development

```bash
npm run dev    # Vite dev server with HMR
npm run build  # Production assets to ../../public/build-seven/
```

The Vite output is intentionally placed outside the module so it doesn't collide with InvoiceNinja's main asset pipeline.

## Support

Need help? Feel free to [contact us](https://www.seven.io/en/company/contact/) or [open an issue](https://github.com/seven-io/InvoiceNinja/issues).

## License

[MIT](LICENSE)
