# Laravel Chatbot package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/rahulalam31/larabot.svg?style=flat-square)](https://packagist.org/packages/rahulalam31/larabot)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/rahulalam31/larabot/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/rahulalam31/larabot/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/rahulalam31/larabot/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/rahulalam31/larabot/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/rahulalam31/larabot.svg?style=flat-square)](https://packagist.org/packages/rahulalam31/larabot)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.



## Installation

You can install the package via composer:

```bash
composer require rahulalam31/larabot
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="larabot-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="larabot-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="larabot-views"
```

## Usage

```php
$larabot = new rahulalam31\Larabot();
echo $larabot->echoPhrase('Hello, rahulalam31!');
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

- [Rahul Alam](https://github.com/rahulalam31)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
