---
title: Documentation uses incorrect method names and output
labels: documentation
---

## Documentation uses incorrect method names and output

The usage guide names `conv` and gives `20m` for `Number::short(20_234)`. The language page calls `Lang::short(2000)`. The Composer description describes the setter rather than the package.

### Steps to Reproduce
Compare the examples with the public API and run them with default settings. Read `composer.json`.

### Expected Result
Examples use `Number::short()`, 20_234 gives `20k`, and the description explains number shortening.

### Actual Result
The reviewed text contains the incorrect names, scale, and description above.

### Fix
Correct the examples and description. Add tests for runnable examples.
