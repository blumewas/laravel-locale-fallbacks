# Opiniated variant on how localizations should be resolved

[![Latest Version on Packagist](https://img.shields.io/packagist/v/blumewas/laravel-locale-fallbacks.svg?style=flat-square)](https://packagist.org/packages/blumewas/laravel-locale-fallbacks)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/blumewas/laravel-locale-fallbacks/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/blumewas/laravel-locale-fallbacks/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/blumewas/laravel-locale-fallbacks/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/blumewas/laravel-locale-fallbacks/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/blumewas/laravel-locale-fallbacks.svg?style=flat-square)](https://packagist.org/packages/blumewas/laravel-locale-fallbacks)

Opiniated variant on how localizations for an app should be loaded.

## Installation

You can install the package via composer:

```bash
composer require blumewas/laravel-locale-fallbacks
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-locale-fallbacks-config"
```

This is the contents of the published config file:

```php
return [
    /**
     * Define the fallback chain for each locale.
     * The keys are the locale codes, and the values are arrays of fallback locales.
     * For example, if 'de' falls back to 'en', you would set:
     * 'de' => ['en'].
     * This means that if a translation is not found in 'de', it will look for
     * the translation in 'en'.
     * You can define multiple fallbacks for a locale.
     * For example, 'de' => ['en', 'fr'] means it will first
     * try 'en', and if not found, it will try 'fr'.
     * A fallback chain is also composed. E.g. if 'de' falls back to 'en',
     * and 'de-DE' falls back to 'de', we will first try 'de-DE',
     * then 'de', and finally 'en'. This would be equivalent to:
     * 'de-DE' => ['de', 'en'],
     * 'de' => ['en'].
     */
    'fallbacks' => [
        'de' => ['en'],
    ],

    /**
     * Whether to automatically add two-letter language codes as fallbacks.
     * This is useful for apps that have regional variations of languages
     * (e.g., 'en-US' and 'en-GB') and want to ensure that
     * the two-letter code ('en') is always available as a fallback.
     */
    'autofallback_two_letter_codes' => true,
];
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [blumewas](https://github.com/blumewas)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
