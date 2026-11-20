---
title: An empty array does not clear overwrites
labels: bug
---

## An empty array does not clear overwrites

`Lang::set()` uses `if ($overwrites)`, so `[]` skips the update.

### Steps to Reproduce
Call `Lang::set('en', ['k' => 'thousand'])`, then `Lang::set('en', [])`, then `Number::short(1000)`.

### Expected Result
`1k`, with the previous mapping cleared.

### Actual Result
The condition preserves the mapping, so the predicted output is `1thousand`.

### Fix
Distinguish `null` from `[]` with `!== null` and clear mappings for an empty array.
