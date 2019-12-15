<h2 align="center">Short number</h2>

Shortens given number by taking digits and adding K, M, B or T after them. For example **1234** will be formatted to **1K** and **20244023** to **20M**. Package supports multiple languages, the default is English.

- [Supported languages](https://github.com/SerhiiCho/short-number#supported-languages)
- [Usage](https://github.com/SerhiiCho/short-number#usage)
- [Configurations](https://github.com/SerhiiCho/short-number#configurations)
    - [Change language](https://github.com/SerhiiCho/short-number#change-language)
- [Options](https://github.com/SerhiiCho/short-number#options)
    - [Output to lowercase](https://github.com/SerhiiCho/short-number#output-to-lowercase)
    - [Round the number](https://github.com/SerhiiCho/short-number#round-the-number)
- [Contribute](https://github.com/SerhiiCho/short-number#contribute)

## Supported languages

| Language  | Short | Thousand | Million   | Billion | Trillion |
| :-------- |:------|:---------|:----------|:--------|:---------|
| English   | en    | 1K       | 1M        | 1B      | 1T       |
| Русский   | ru    | 1ТЫС     | 1МЛН      | 1МЛД    | 1ТРН     |

## Usage

```php
use Serhii\ShortNumber\Conv;

Conv::short(1909234); // returns: 2M
Conv::short(20234); // returns: 20K
```

## Configurations

#### Change language

For changing the language you want to call `set` method once before calling other methods from this package.

```php
Serhii\ShortNumber\Lang::set('ru');
```

## Options

#### Output to lowercase

By default uppercase is set, to make it lower just pass `lower` as the seconds argument to a `short` method.

```php
use Serhii\ShortNumber\Conv;

Conv::short(1352); // returns: 1K
Conv::short(1352, 'lower'); // returns: 1k
```

#### Round the number

If number is at 90% or above to the next digit, it will round it. For example **1899** will be converted to **1K**, but **1900** to **2K**. To make it round at 50% use option `half`.

```php
use Serhii\ShortNumber\Conv;

Conv::short(500, 'half'); // returns: 1K
Conv::short(499, 'half'); // returns: 499
Conv::short(500); // returns: 500
```

## Contribute

You can provide any issues or pull requests that are in frame of this package. For adding language support you can copy any file in `src/lang` directory and translate it. After adding language would be nice to add information about new language to a table in README.md file in section [Supported languages](https://github.com/SerhiiCho/short-number#supported-languages).
