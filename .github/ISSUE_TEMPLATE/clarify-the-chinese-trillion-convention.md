---
title: Clarify the Chinese trillion convention
labels: question
---

## Clarify the Chinese trillion convention

`sets/zh.php` uses `兆` for 10^12. Its meaning varies by region and context. This needs locale review, not a confirmed bug report.

### Steps to Reproduce
Inspect the 10^12 mapping and have native speakers for the intended locale review it.

### Expected Result
A documented scale convention appropriate for the target locale.

### Actual Result
The set uses `兆`; suitability for the intended audience is unconfirmed.

### Fix
Document the locale and convention. Consider `万亿` or separate locale sets if native-language review supports a change.
