# Release Notes

## v4.0.0 (2024-12-14)
- 🇨🇳 Add support for Chinese language
- Rewrite the codebase to make it more extendable

## v3.0.9 (2024-11-01)
- Typo in `README.md` file

## v3.0.8 (2024-11-01)
- Update `composer.json` file
- Move repo to a new organization `short-number/short-number`

## v3.0.7 (2024-09-08)
- Remove not working badge from `README.md` file
- Update composer dev packages to the latest versions
- Remove backslashes from each native PHP function in the codebase

## v3.0.6 (2024-03-07)
- Fixed typos in `CHANGELOG.md` file
- Updated `README.md` file by adding a badge and LICENSE section

## v3.0.5 (2024-03-06)
- Code refactoring
- Moved scripts from `Makefile` to `composer.json` file
- Updated PHPStan to the latest version

## v3.0.4 (2023-11-14)
- Added support for `PHP 8.3`

## v3.0.3 (2023-09-07)
- Renamed master branch to main
- Added support for `PHP 8.2`
- Installed Laravel Pint package
- Formatted code with Laravel Pint
- Added Pint checks to GitHub actions

## v3.0.2 (2022-01-27)
- Removed section in docs that is not relevant

## v3.0.1 (2022-01-27)
- Added link to `README.md` that shows example of usage
- Fixed bug with default English language. It didn't default to English when language is not set

## v3.0.0 (2022-01-27)
- Added `CHANGELOG.md` file
- Removed ability to pass option `Option::UPPER` as the second argument to `conv` method
- Added support for `PHP 8.1`
- Added `.gitattributes` to exclude `Makefile`
- Improved documentation
- Removed support for `PHP 7.1`

## v2.0.3 (2021-03-16)
- Added support for php 8 in `composer.json` file

## v2.0.2 (2020-12-06)
- Added PHPStan package
- Added phpcs fixer package
- Added ability to overwrite any amount of fields, not just 4 fields
- Code refactoring

## v2.0 (2020-12-05)
- Renamed `Conv` class to `Number`
- Renamed `short()` method to `trans()`
- Added support for Ukrainian language
- Added easy way to contribute new language support
- Improved documentation
- Added `CONTRIBUTE.md` file with instructions how to contribute language support
- Fixed bug when you couldn't convert negative numbers
- Added ability to overwrite translations by passing array to `Lang::set()` method as the second argument
- Changed string options with constants
- Changed default case to lowercase instead of uppercase
- Added more tests
- Added php8 to GitHub actions CI

## v1.1.1 (2020-11-17)
- Added MIT license

## v1.1 (2019-12-31)
- Changed namespace for tests

## v1.0.1 (2019-12-16)
- Changed first parameter type in `short()` method in `Conv.php`

## v1.0 (2019-12-16)
- First version release