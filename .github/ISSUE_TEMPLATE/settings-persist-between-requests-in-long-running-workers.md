---
title: Settings persist between requests in long-running workers
labels: enhancement
---

## Settings persist between requests in long-running workers

Language, overwrites, and singleton configuration are process-wide state.

### Steps to Reproduce
In one persistent worker, change settings during one request. Format a number in the next request without resetting them.

### Expected Result
Request-specific settings are isolated, or process-wide behavior and reset requirements are documented.

### Actual Result
The source retains shared settings. Effects depend on the worker's isolation model.

### Fix
Provide instance-based or per-call settings. Document persistence; a sequential reset alone does not handle concurrent requests.
