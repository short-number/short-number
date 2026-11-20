---
title: Formatting disables Japanese and Chinese default rewrites
labels: bug
---

## Formatting disables Japanese and Chinese default rewrites

`Number::applyDefaultOverwrites()` matches the finished string. The `1千` to `千` rule stops matching when a separator is added.

### Steps to Reproduce
Select `ja`, set `suffixSeparator` to a space, and format 1000. Repeat with `zh`.

### Expected Result
The separator does not disable the language rewrite.

### Actual Result
The source predicts `1 千`, which does not match `1千`.

### Fix
Apply language rewrites before assembling the formatted output. Test separators, signs, and decimals together.
