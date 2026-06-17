## Architecture

This project follows a layered, separation-of-concerns approach rather than
strict DDD — appropriate for the scope of this task while still keeping a
clear single source of truth for business rules.

- **Requests/Controllers** — input validation and HTTP orchestration only. --> blood flow
- **DTOs** — typed data transfer between layers, avoiding array-passing. --> blood cells
- **Services** — business logic layer. A Service is a black box: callers --> heart/liver etc.
  (controllers, tests) only know the contract (input → expected result),
  not the implementation. This keeps business rules in exactly one place.
- **Managers** — data access layer. Whether the underlying source is MySQL, --> brain/memory
  Redis cache, or eventually a search engine, the calling code doesn't care —
  only the Manager knows.
- **Resources** — consistent API response shaping (Laravel default). --> communication channel (voice,touch)


## Architecture Philosophy

The core goal is separation of concerns with a single source of truth for
business rules, and Single Responsibility as the guiding principle
throughout. This led to two key abstractions: *Services* and *Managers*.

**Service** — a black box business logic unit. Callers (controllers, tests)
only know the contract: what input it expects and what result it returns.
They have no knowledge of *how* the Service arrives at that result. This
keeps business rules isolated in exactly one place per concern.

**Manager** — the single layer responsible for data operations (create,
read, update, delete) regardless of the underlying storage mechanism.
Whether the data lives in MySQL, Cache, or a future NoSQL/search
store, only the Manager knows — callers remain unaware of the storage
detail.

This isn't strict DDD (no explicit Aggregates, Value Objects, or bounded
contexts), but it satisfies the same underlying concern DDD addresses:
business logic isolated from infrastructure, making the codebase easier to
extend and reason about as it grows.

### Why standard MVC (Cruddy by Design)

I'm assuming this service sits (interview task) within a broader microservice ecosystem,
which means it likely receives many small, focused requests for individual
CRUD-style operations (add to watchlist, update status, remove, etc.) from
other services or clients.

So, because of that, I followed the "Cruddy by Design" approach popularized by Adam Wathan at Laracon -> 
resource-oriented controllers mapped cleanly to CRUD verbs, each controller thin and clearly
scoped, with business logic delegated to Services and data access
delegated to Managers (described above).

This keeps the application itself simple and predictable to consume from
outside, while the Service/Manager separation internally still gives clean
boundaries if any piece of this ever needs to be extracted or scaled
independently later.
