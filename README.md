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

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="laravel-locale-fallbacks-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-locale-fallbacks-config"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$laravelLocaleFallbacks = new Blumewas\LaravelLocaleFallbacks();
echo $laravelLocaleFallbacks->echoPhrase('Hello, Blumewas!');
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
