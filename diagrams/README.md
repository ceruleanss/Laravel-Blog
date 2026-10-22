# Modern Laravel 13 Blog System - PlantUML Flowcharts

This directory contains comprehensive **PlantUML Flowcharts (Activity Diagrams)** capturing the functional workflows, business logic, security policies, and architectural lifecycles of the application.

All diagrams are **pre-configured and guaranteed 100% un-clipped and A4 paper friendly** with bounded width wrapping (`skinparam wrapWidth 200–220`), clean swimlane geometry, and zero canvas clipping or truncation.

---

## Diagram Index

| File | Title | Description & Core Logic |
| :--- | :--- | :--- |
| [**`01_auth_flow.puml`**](01_auth_flow.puml) | **User Login & Rate Limiting Flow** | Details Login authentication, `RateLimiter` queries against the SQLite `cache` table (5-attempt throttling & lockout), session regeneration, and remember token logic. |
| [**`01b_registration_flow.puml`**](01b_registration_flow.puml) | **User Registration & Account Setup** | Details User Registration, field validations (`username` & `email` unique rules), password hashing via `Hash::make()`, automatic DiceBear avatar seeding, and auto-login. |
| [**`02_public_blog_feed_flow.puml`**](02_public_blog_feed_flow.puml) | **Public Feed & Multi-Parameter Query Filtering** | Details the multi-parameter search query pipeline (`search`, `category`, `author`), Eloquent local scope `scopeFilter()`, eager loading (`$with = ['author', 'category']`) for $N+1$ prevention, and paginated card rendering. |
| [**`02b_single_post_view_flow.puml`**](02b_single_post_view_flow.puml) | **Single Post View & Route Model Binding** | Details the single article view flow via `GET /posts/{post:slug}`, implicit route-model binding, 404 handling, related articles discovery from the same category, and full markdown display. |
| [**`03_post_creation_flow.puml`**](03_post_creation_flow.puml) | **Author Dashboard: Post Creation & Alpine.js** | Details the post creation lifecycle, real-time client-side Alpine.js slug auto-generation, live image preview via `FileReader`, server-side validation, public disk file storage, and flash alerts. |
| [**`04_post_update_flow.puml`**](04_post_update_flow.puml) | **Author Dashboard: Post Update & Policy Check** | Details post editing, authorization verification via `PostPolicy@update`, unique slug rule ignoring current post ID, old image deletion from storage on replacement, and database updates. |
| [**`05_post_deletion_flow.puml`**](05_post_deletion_flow.puml) | **Author Dashboard: Post Deletion & Modal** | Details post deletion with Alpine.js interactive confirmation modal dialog, cancellation/confirmation branches, `PostPolicy@delete` authorization, disk file cleanup, and model deletion. |
| [**`06_system_architecture_request_lifecycle_flow.puml`**](06_system_architecture_request_lifecycle_flow.puml) | **End-to-End System Architecture Lifecycle** | High-level request lifecycle from Client Browser through Docker, PHP Server, Laravel 13 Kernel, Global & Web Middleware, Route Dispatching, Policy Gatekeeping, SQLite DB, and Blade Component Tree rendering. |

---

## Why Diagrams No Longer Get Cut Off

1. **Eliminated Parallel Swimlane Multiplying**:
   - In PlantUML, multi-branch `if/else` conditions spanning across swimlanes cause PlantUML to draw separate side-by-side copies of all columns, blowing diagram widths past the 4096px cutoff limit.
   - Separate, focused workflows now keep diagram widths cleanly between 1200px and 2500px.
2. **Removed Artificial Scale Max Constraints**:
   - Removed `scale max 1700x1150` which was artificially capping diagram heights at 1150px and clipping taller flows.
3. **Constrained Node Width (`skinparam wrapWidth 200–220`)**:
   - Automatically wraps sentences inside activity boxes so no column stretches horizontally past printable page margins.
4. **Natural Bounding Box**:
   - Each diagram naturally computes its complete boundaries from `start` to `stop` without clipping borders or truncated text.

---

## How to Render and Export to A4 PDF / PNG

### Option 1: VS Code PlantUML Extension
1. Open any `.puml` file.
2. Press `Alt + D` to preview.
3. Right-click the preview and select **Export Current Diagram** → choose **PNG** or **PDF**.

### Option 2: PlantUML Command Line (CLI)
Render all diagrams directly using Java:
```bash
# Export all diagrams as PNG images
java -jar plantuml.jar diagrams/*.puml

# Export all diagrams as vector SVG graphics
java -jar plantuml.jar -tsvg diagrams/*.puml
```

### Option 3: Online PlantUML Server
Copy and paste the code from any `.puml` file into [PlantText](https://www.planttext.com/) or the [PlantUML Web Server](http://www.plantuml.com/plantuml/uml/).
