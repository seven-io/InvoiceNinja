<img alt='' src="https://www.seven.io/wp-content/uploads/Logo.svg" width="250" />

# seven.io SMS Module for InvoiceNinja

Automatically send SMS notifications to clients using seven.io's messaging service when they are created in InvoiceNinja.

## What It Does

This module integrates seven.io's SMS API with InvoiceNinja to:

- **Automatically send SMS notifications** when new clients are created
- **Personalize messages** using client data (name, email, etc.)
- **Configure SMS settings** through InvoiceNinja's module interface
- **Handle API errors gracefully** with comprehensive logging

## Features

- **Automatic SMS sending** on client creation events
- **Template-based messaging** with variable substitution
- **Easy configuration** via module settings
- **Robust error handling** and logging
- **Modular architecture** that doesn't interfere with core InvoiceNinja

## Installation

### 1. Prerequisites

- InvoiceNinja installation
- [API key](https://help.seven.io/en/articles/9582186-where-do-i-find-my-api-key) from seven.io
- PHP 8.1+ with Composer
- Node.js and npm (for frontend assets)

### 2. Install Dependencies

1. Autoloading: By default, module classes are not loaded automatically. You can autoload your modules using `psr-4`, add `"Modules\\": "Modules/"` in
   **composer.json**.
   ``` json
   {
     "autoload": {
       "psr-4": {
         "App\\": "app/",
         "Modules\\": "Modules/"
       }
     }
   }
   ```
2. Run `composer require seven.io/invoiceninja`

3. Run `composer dump-autoload`

### 3. Configure Environment

Add your seven.io API key to your environment configuration:

```bash
# In your .env file
SEVEN_API_KEY=your_seven_io_api_key_here
```

### 4. Enable the Module

The module will be automatically discovered by InvoiceNinja. You can configure it through the modules interface in your InvoiceNinja admin panel.

## Configuration

### SMS Message Templates

Messages support template variables that are automatically replaced with client data:

```
Hello {{name}}, welcome to our service! Your email {{email}} has been registered.
```

Available template variables include any field from the client object (name, email, phone, address, etc.).

### Module Settings

Configure the module through InvoiceNinja's interface:

- **apiKey**: Your seven.io API key
- **sms.from**: The sender ID for SMS messages
- **events.clientCreated.enabled**: Toggle SMS notifications on/off
- **events.clientCreated.text**: Customizable SMS message with variable support

## How It Works

1. **Event Listening**: The module listens for InvoiceNinja's `ClientWasCreated` events
2. **Message Processing**: When triggered, it processes the SMS template with client data
3. **API Communication**: Sends the SMS via seven.io's REST API
4. **Error Handling**: Logs success/failure and handles API errors gracefully

## Development

### Building Assets

For development with hot reloading:
```bash
npm run dev
```

For production builds:
```bash
npm run build
```

### File Structure

```
app/
    Http/Controllers/     # Web controllers (WIP)
    Listeners/            # Event listeners for SMS sending
    Providers/            # Laravel service providers
config/seven.php          # Module configuration
resources/                # Frontend assets and views
routes/                   # Web and API routes
module.json               # Module metadata and settings schema
```

## API Integration

This module uses the official seven.io PHP SDK (`seven.io/api`) to communicate with seven.io's messaging service. All API calls are properly authenticated and include comprehensive error handling.

## Support

For issues related to:
- **Module functionality**: Create an issue in this repository
- **seven.io API**: Contact seven.io support
- **InvoiceNinja core**: Refer to InvoiceNinja documentation

## License

[![MIT](https://img.shields.io/badge/License-MIT-teal.svg)](LICENSE)
