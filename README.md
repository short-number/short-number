# Short Number

[![Short number](https://github.com/short-number/short-number/actions/workflows/php.yml/badge.svg)](https://github.com/short-number/short-number/actions/workflows/php.yml)
[![Total Downloads](https://poser.pugx.org/serhii/short-number/downloads)](https://packagist.org/packages/serhii/short-number)
[![License](https://poser.pugx.org/serhii/short-number/license)](https://packagist.org/packages/serhii/short-number)

Lightweight package shortens given number to a short representation of it. For example **1234** will be formatted to **1k** and **20244023** to **20m**. Package supports multiple languages and can be easily extended with new languages.

### Follow the [full documentation](https://short-number.github.io/) for this package

## Quick Start

```bash
composer require serhii/short-number
```

## Supported Languages
| Flag | Language           | Code |
| ---- | ------------------ | ---- |
| 🇬🇧   | English            | en   |
| 🇷🇺   | Russian            | ru   |
| 🇺🇦   | Ukrainian          | uk   |
| 🇨🇳   | Chinese            | zh   |
| 🇯🇵   | Japanese           | ja   |

## License

The Short Number project is licensed under the [MIT License](https://github.com/short-number/short-number/blob/master/LICENSE.md)

## Development
### Without Docker
You'll need to have Composer and PHP installed on your machine

### With Docker
#### Build an image
To build an image, navigate to the root of the project that contains `Dockerfile` and run this command:
```bash
docker compose build app
```

#### Run the container
To run a container, navigate to the root of the project that contains `Dockerfile` and run this command:
```bash
docker compose run --rm app
```