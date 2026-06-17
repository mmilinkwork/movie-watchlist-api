## Task Approach & Design Decisions

### Adding a movie to the watchlist
1. Check — primarily handled in the Form Request validation layer.
    - By `movie_id` — direct relation if it already exists in our `movies` table.
    - By `title` — case-insensitive contextual search against our local table
      before hitting the external API.

2. If not found locally, we contact the external API (OMDb):
    - The requested title/id is first written to cache (enables rollback if
      the job fails mid-way).
    - A job is dispatched to fetch the movie from OMDb.
        - On success: the movie is persisted locally and linked to the user's
          watchlist. After linking, we reload cache for movies table.
        - On failure (not found): the user is notified the movie couldn't be
          located and is asked to verify the input.
    - Note: OMDb only supports single-item lookup, not bulk. The current
      design (one job per movie) naturally extends to a future "bulk add"
      feature without structural changes — just multiple job dispatches.

### Updating a watchlist item
- `status` enum: `added`, `watching`, `watched`
- `watched_at` — set automatically when status transitions to `watched`
- `is_favorite` — boolean flag
- `personal_rating` — 1–10, optional
- `notes` — text, optional
- `added_via` — `manual` or `recommendation` (recommendation flow between
  users is a natural extension once a friend/follow system exists — out of
  scope for now, but the field is designed to support it later without
  migration changes)

### Listing & searching the watchlist
- Core movie fields (`title`, `year`, `genre`, `short_plot`) live on the main
  `movies` table and are indexed for fast basic search.
- Extended metadata is stored in a separate `movie_details` table as JSON —
  keeps the primary table lean while preserving richer data for future use.
- Search is implemented behind an interface/contract, so the underlying
  engine (plain MySQL today, Elasticsearch/Solr later) can be swapped
  without touching calling code. A Strategy pattern would allow multiple
  search backends to coexist if needed.

### Viewing a single item
Straightforward — eager loading to avoid N+1 queries, returned through an
API Resource for consistent shape.

### Removing an item
Straightforward delete; bulk delete is a natural future extension.

### Rate Limiting
Applied at application level via Laravel's built-in throttle middleware,
anticipating future scale rather than reacting to current load.
