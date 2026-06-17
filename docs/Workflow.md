## Implementation Priority

Given the time-boxed nature of this task (3-5h), the following order
reflects what I consider highest-value first — core functionality and
the integration that everything else depends on, before peripheral CRUD.

### 1. OMDb API Communication Service
The riskiest and most central piece — every other feature depends on this
working correctly. Building it first surfaces integration issues early
(rate limits, missing results, API shape) rather than discovering them
once the rest of the app is already built around assumptions.

### 2. Add to Watchlist
The core user action described in the task. Depends on #1 being in place.
Includes the duplicate-check and local-lookup-before-external-call logic.

### 3. Update Watchlist Status
Second most important user action — status transitions (`added` →
`watching` → `watched`), plus `watched_at`, `is_favorite`, `personal_rating`,
`notes`.

### 4. List Watchlist (filter + pagination)
Read-heavy endpoint, depends on #2 having data to list. Filtering by
status/favorite, basic pagination.

### 5. View Single Item
Low complexity, mostly eager loading + Resource shaping. Quick to build
once the model relations exist.

### 6. Remove Item
Simplest endpoint, no real complexity. Placed last as the lowest-risk,
lowest-effort item.

### 7. Authorization (Laravel Sanctum)
Wraps everything above. Deliberately last: easier to retrofit auth onto
working endpoints than to fight auth issues while still building business
logic. All routes will be scoped to the authenticated user once this
lands.

## Time-box notes
If time runs short, items 1–4 represent the functional core. Items 5–7
are straightforward enough to document as "what I'd do next" in the
README if not fully implemented.
