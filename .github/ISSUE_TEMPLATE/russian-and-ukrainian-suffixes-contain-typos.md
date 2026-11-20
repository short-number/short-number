---
title: Russian and Ukrainian suffixes contain typos
labels: bug
---

## Russian and Ukrainian suffixes contain typos

`sets/ru.php` and `sets/uk.php` use `млд` and `трн` for billion and trillion.

### Steps to Reproduce
Select each language without overwrites. Format `1_000_000_000` and `1_000_000_000_000` on 64-bit PHP.

### Expected Result
Suffixes `млрд` and `трлн`.

### Actual Result
The set files contain `млд` and `трн`.

### Fix
Correct both sets and their tests. Check custom mappings that depend on the old strings.
