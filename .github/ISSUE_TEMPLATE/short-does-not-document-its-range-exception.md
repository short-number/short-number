---
title: short() does not document its range exception
labels: documentation
---

## short() does not document its range exception

The sets stop at 18 digits. `Number::short()` has no `@throws LargeNumberException` tag.

### Steps to Reproduce
On 64-bit PHP, format `999_999_999_999_999_999`, `1_000_000_000_000_000_000`, and `PHP_INT_MAX`.

### Expected Result
The method documents its supported range and exception.

### Actual Result
Source review indicates that values from 10^18 throw `LargeNumberException`; the method does not declare it in PHPDoc.

### Fix
Document the range and add `@throws LargeNumberException`.
