# Short Number

[![Total Downloads](https://poser.pugx.org/serhii/short-number/downloads)](https://packagist.org/packages/serhii/short-number)
[![License](https://poser.pugx.org/serhii/short-number/license)](https://codeberg.org/short-number/short-number/src/branch/master/LICENSE.md)

Lightweight package shortens given number to a short representation of it. For example **1234** will be formatted to **1k** and **20244023** to **20m**. Package supports multiple languages and can be easily extended with new languages.

### Follow the [full documentation](https://short-number.codeberg.page/) for this package

## Quick Start

```bash
composer require serhii/short-number
```

## Supported Languages

| Flag | Language  | Code |
| ---- | --------- | ---- |
| 🇬🇧   | English   | en   |
| 🇷🇺   | Russian   | ru   |
| 🇺🇦   | Ukrainian | uk   |
| 🇨🇳   | Chinese   | zh   |
| 🇯🇵   | Japanese  | ja   |

## License

The Short Number project is licensed under the [MIT License](https://codeberg.org/short-number/short-number/src/branch/master/LICENSE.md)

## Contribute

### With Container Engine

#### Build an Image

To build an image, navigate to the root of the project and run this command.

With Podman:

```bash
podman-compose build
```

With Docker:

```bash
docker compose build
```

#### Run the Container

To run a container, navigate to the root of the project and run this command.

With Podman:

```bash
podman-compose up -d
```

With Docker:

```bash
docker compose up -d
```

#### Enter the Container

Enter a container if you need to run composer.

With Podman:

```bash
podman-compose exec app bash
```

With Docker:

```bash
docker compose exec app bash
```

#### Cleanup

You can remove networks and cleanup by running this command.

With Podman:

```bash
podman-compose down
```

With Docker:

```bash
docker compose down
```
