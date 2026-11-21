# Short Number

[![Quality checks](https://github.com/short-number/short-number/actions/workflows/php.yml/badge.svg)](https://github.com/short-number/short-number/actions/workflows/php.yml)
[![Total Downloads](https://poser.pugx.org/serhii/short-number/downloads)](https://packagist.org/packages/serhii/short-number)
[![License](https://poser.pugx.org/serhii/short-number/license)](https://packagist.org/packages/serhii/short-number)

Lightweight package shortens given number to a short representation of it. For example **1234** will be formatted to **1k** and **20244023** to **20m**. Package supports multiple languages and can be easily extended with new languages.

### Follow the [full documentation](https://short-number.serhiicho.com/) for this package

## Requirements

If you use Podman or Docker then requirements are already satisfied by the container image. Otherwise, make sure you have the following installed:

- PHP 8.1 or higher
- `mbstring` extension (used for the `upperCase` option)

## Installation

```bash
composer require serhii/short-number
```

## Usage

```php
use Serhii\ShortNumber\Number;

Number::short(0);         // '0'
Number::short(999);       // '999'
Number::short(1234);      // '1k'
Number::short(5_935_235); // '5m'
Number::short(-1234);     // '-1k'
```

Numbers below `1000` are returned as is. Numbers are shortened up to 18 digits (`999 quadrillion`), anything larger throws `Serhii\ShortNumber\Exceptions\LargeNumberException`.

## Languages

English is used by default. Set another language once before calling `Number::short()`:

```php
use Serhii\ShortNumber\Lang;
use Serhii\ShortNumber\Number;

Lang::set('ru');

Number::short(2000); // '2тыс'
```

| Flag | Language  | Code |
| ---- | --------- | ---- |
| 🇬🇧   | English   | en   |
| 🇷🇺   | Russian   | ru   |
| 🇺🇦   | Ukrainian | uk   |
| 🇨🇳   | Chinese   | zh   |
| 🇯🇵   | Japanese  | ja   |

`Lang::current()` returns the active language code and `Lang::resetToDefaults()` restores English.

## Development

Install dependencies and run the full check suite:

```bash
composer install
composer check
```

Individual commands:

| Command          | Description                        |
| ---------------- | ---------------------------------- |
| `composer test`  | Run PHPUnit tests                  |
| `composer stan`  | Run PHPStan static analysis        |
| `composer cs`    | Run PHP CodeSniffer                |
| `composer pint`  | Check code style with Laravel Pint |

## OCI

If you use OCI tools like Podman or Docker, you can use `podman-compose` or `docker compose` to build and run the container. See instructions below. Note, we use `podman-compose` in the examples, but you can replace it with `docker compose` if you prefer.

### Build an Image

To build an image, navigate to the root of the project and run this:

```bash
podman-compose build
```

### Run the Container

To run a container, navigate to the root of the project and run this:

```bash
podman-compose up -d
```

### Enter the Container

Enter a container if you need to run composer:

```bash
podman-compose exec app bash
```

Inside the container you can use PHP and Composer like you normally would. For example, to install dependencies, run this:

```bash
composer install
```

### Cleanup

You can remove networks and cleanup by running this:

```bash
podman-compose down
```

## License

The Short Number project is licensed under the [MIT License](https://github.com/short-number/short-number/blob/master/LICENSE.md)
