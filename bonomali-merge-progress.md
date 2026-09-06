# Bonomali design merge — progress context

Branch: `feature/bonomali-merge` (off `main`, not pushed, no commits yet — nothing committed until you ask).

## Why this project

`D:\wamp64\www\rms` **is** the Bonomali Mangrove Resort's system (`.env`: `APP_NAME="Bonomali Mangrove Resort"`, DB `rms`). Its public frontend was a generic "Hotelia" CodeCanyon demo theme, pulling ~20 stylesheets/scripts live from a third-party demo host (`codecanyon8.kreativdev.com`) and using placeholder orange/navy branding. `D:\wamp64\www\Bonomali full website build` is the resort's real, purpose-built design (color/type/spacing tokens, real logo, real imagery, real page content) plus a parallel Laravel backend (`bonomali-backend`) with booking/rate/promo domain logic RMS doesn't have yet.

Approved scope (full merge): design system + page structure + booking logic + a React booking widget, admin (Kaiadmin) panel left untouched.

## Phase 0 — Safety ✅ done

- Created branch `feature/bonomali-merge`.
- Admin panel (`resources/views/layouts/*`, `app/Models/Admin/*`, Kaiadmin assets) untouched and out of scope — no model/route name collisions found between RMS's existing `CheckIn`/`Checkout` (front-desk) and Bonomali's `Booking`/`Stay`/`RateTier`/`Promo`/`Payment`/`Enquiry` (online reservation) domain, so Phase 3 can add the latter cleanly.

## Phase 1 — Design foundation ✅ done

**Scope adjustment made mid-phase (flagged, not silently done):** the plan text said "drop the external Hotelia CDN links." On inspection, those links aren't just branding — `theme_four/style.css`, `responsive.css`, `main.css` etc. are the actual layout engine for every frontend page (rooms, gallery, packages, about...), and only the header/footer + homepage are in scope for Phase 1. Dropping them now would break the other 8 pages until Phase 2 converts them to native Bonomali markup. So Phase 1 instead layers Bonomali branding on top of the existing theme rather than removing it; full removal happens per-page in Phase 2 as each page gets real Bonomali markup.

**Files added:**
- `resources/css/bonomali/tokens/{base,colors,effects,fonts,spacing,typography}.css` — copied verbatim from the Bonomali design system (`_ds/bonomali-design-system-.../tokens/`).
- `resources/css/bonomali-tokens.css` — manifest that imports the six token files (mirrors the source's own `styles.css`).
- `resources/css/frontend.css` — new Vite entry: imports the tokens, sets `font-family: var(--font-sans)` (Nunito) globally across the frontend, documents the bridge strategy.
- `public/assets/bonomali/logo/{bonomali-logo.png,bonomali-logo-reversed.png}` — real resort logo, copied from the source project's `assets/logo/`.

**Files changed:**
- `vite.config.js` — added `resources/css/frontend.css` as a third Vite input (alongside the existing `app.css`/`app.js`, which the admin panel doesn't actually use — admin runs on `public/assets/` Kaiadmin directly, confirmed no conflict).
- `resources/views/frontend/layouts/header.blade.php` — added `@vite(['resources/css/frontend.css'])`; replaced all ~138 hardcoded Hotelia orange/navy hex values (`#FEA116`/`#0F172B`) with Bonomali gold/bark (`#BC8832`/`#3F1B0E`); favicon and the three `<img>` logo references now point at the real logo (reversed variant used on the dark mobile menu; the white-background nav bar keeps the standard mark).
- `resources/views/frontend/layouts/footer.blade.php` — footer logo swapped to the reversed mark (dark footer background).

**Also fixed (unrelated to this task but blocking verification):** deleted a stale `public/hot` file left over from a previous, no-longer-running `npm run dev` session — it's gitignored/untracked, not part of anyone's in-progress work, and its presence made Laravel's `@vite()` try to reach a dead Vite dev server at `localhost:5173` instead of using the built `public/build/manifest.json`, which is what silently zeroed out the new CSS during my first verification pass.

**Verified:** `npx vite build` succeeds (0 errors). Loaded the homepage via `php artisan serve` + headless browser: title, hero, nav, and footer all render; `--gold` resolves to `#BC8832`; body font is Nunito; all three new logo images load (887×900, not broken). Screenshot confirmed gold header bar, real logo, warm canvas background, dark-brown footer.

**Pre-existing issues found, not introduced by this work (left alone, in scope for later cleanup if wanted):**
- `public/js/custom.js` — 404, referenced but never existed.
- `assets/images/footer-bg-2.jpg` — 404, footer background image referenced with a relative path missing the `asset()` helper.
- `mask-brush-4.svg` on the external Hotelia CDN — CORS-blocked.
- The whole external-CDN dependency itself (`codecanyon8.kreativdev.com/...`) is still live for every page except header/footer's now-local logo/favicon — it goes away page-by-page in Phase 2.

## Phase 2 — Page/content port ✅ done

Every frontend page rebuilt in native Bonomali markup on a shared component library (`resources/css/frontend.css` — classes prefixed `bm-`: `.bm-hero`, `.bm-section`/`-alt`/`-forest`, `.bm-split`, `.bm-grid`, `.bm-card`, `.bm-quote-band`, `.bm-facility`, `.bm-timeline-item`, `.bm-accordion-item`, `.bm-gallery-*`, `.bm-article`, `.bm-field`/`.bm-alert-*`, `.bm-footer`). The Hotelia CDN dependency is now fully gone from `header.blade.php`/`footer.blade.php` (rewritten from scratch, no more external stylesheet links) and from every page below.

**Reference page + pattern**: `resources/views/frontend/about.blade.php` — built first, screenshot-verified, then used as the template for everything else.

**Pages rebuilt** (all screenshot- or agent-verified in-browser, 0 console errors, 0 failed requests):
- `index_one.blade.php` (Home) — real DB data (`$sliders`, `$rooms`, `$packages`, `$aboutUs`) merged with Bonomali's real brand copy (story, facilities, manifesto quote). Room amenities field was a JSON-string column rendering raw (`["ere","test456"]`) — fixed with `json_decode` fallback.
- `about.blade.php` — Bonomali's real "story"/"promise" copy.
- `room.blade.php` (route `/rooms`, the *actually-live* view — `rooms.blade.php` plural is dead code, never routed to, left alone) — real `RoomType`/`Room` data restyled as cards, type-filter tabs preserved, plus Bonomali's real "every rate includes" info band. **Did not overwrite real prices/descriptions with Bonomali's example numbers** — only added supporting copy, per the data-integrity rule.
- `package.blade.php` (route `/packages`, live view — `packages.blade.php` plural is the dead one) — same treatment, filters/pagination preserved.
- `services.blade.php` ("Experience" in nav) — day timeline, village-kitchen split, facilities grid, all real Bonomali copy.
- `contact.blade.php` — real address/phone/email, getting-here steps, a **working** enquiry form (posts to new `contact.submit` route → `Enquiry` model → DB), original Google Maps iframe preserved, 6-question FAQ teaser.
- `faq.blade.php`, `gallery.blade.php`, `journal.blade.php` + `journalShow.blade.php` (new) — all DB-backed (see below), replacing static/dead Hotelia markup.
- `termsConditions.blade.php` — previously a broken duplicate-header page hardcoded to "Hotelia"/"Dhaka" fake branding (never shared this site's real header/footer at all); rebuilt on the shared layout with an honest "being finalised, contact us" holding message — **no invented legal clauses**, since no real terms text exists anywhere to source from.
- `bookingConfirmed.blade.php` (new, no route yet) — minimal placeholder; full reference/payment-status logic is a Phase 3+ concern.

**New DB-backed content modules** (migrations + `App\Models\Admin\{Faq,Gallery,JournalPost,Enquiry}` + full admin CRUD under `/admin/faq`, `/admin/gallery`, `/admin/journal`, `/admin/enquiries` — prefixed `admin/` specifically because `faq`/`gallery`/`journal` collide with the public routes of the same name, unlike this app's older admin resources which are bare-URL by convention):
- **28 FAQs** across 6 categories, **10 gallery items**, **11 full journal articles** — all seeded via `database/seeders/BonomaliContentSeeder.php` from the resort's own real copy (extracted verbatim from `Bonomali full website build`'s `faq-data.js`/`media-data.js`/`journal-data.js` — sourced, not fabricated; images reused from `public/assets/bonomali/imagery/`, already copied in Phase 1).
- Contact form now writes to the same `enquiries` table (`type='contact'`).

**Route collision caught and fixed**: adding `Route::resource('/faq', ...)` etc. inside the existing admin group (which has no `/admin` URL prefix by convention — checked, that's true of every pre-existing admin resource too) silently shadowed the public `/faq` page. Fixed by wrapping just the four new resources in `Route::prefix('admin')->group()`.

**Also fixed**: a stale `public/hot` file kept reappearing after each agent's own `npm run dev`-adjacent testing — removed each time it blocked `@vite()` from serving the built manifest.

## Phase 3 — Booking backend 🔄 in progress

Reviewed `bonomali-backend`'s actual services in full (`AvailabilityService`, `QuoteService`, `PromoService`, `CancellationService`, `Stay`/`RateTier`/`Promo`/`Booking`/`Setting` models) — genuinely well-designed, kept almost verbatim. Key design decision, confirmed by the reference's own migration comment ("A STAY is the thing the website sells. A ROOM is the thing housekeeping cleans... do not collapse these two ideas"): **new domain is fully separate from `Room`/`RoomType`/`CheckIn`/`Checkout`**, zero risk to existing front-desk features.

Adaptations from the reference: no bilingual (`_bn`) columns (this build is English-only), no payment-gateway integration (the resort's own published FAQ already says payments are manual/offline — building a fake gateway would be fabrication), `Booking`→`Reservation` naming to avoid ambiguity with front-desk `CheckIn`/`Checkout`, `App\Models\Admin\*` namespace to match house convention.

Dispatched as one large background task: migrations (`stays`, `rate_tiers`, `promos`, `reservations`, `settings`), models, services, `PricingException`, `routes/api.php` (GET `/api/quote`, GET `/api/availability`, POST `/api/reservations`) — `bootstrap/app.php` already updated to register `api:` routing — admin CRUD (Stays incl. nested rate-tier manager, Promos, Reservations view/confirm/cancel, a one-page Settings editor), two Mailables (guest ack + office notice, both hit `MAIL_MAILER=log` so nothing external fires), and seeding the resort's real 5 stays, real rate tiers, and real 10 promo codes (all sourced from the reference project — legitimate published pricing, not invented).

**Independently re-verified (not just trusting the background agent's self-report):** rebuilt assets, restarted a fresh dev server, and by hand: called `GET /api/quote` and confirmed the arithmetic myself night-by-night (Chitra, 3 nights spanning a weekday+weekend, 2 guests → gross ৳34,200, weekday discount ৳1,530, VAT ৳4,901, total ৳37,571 — matches manual calculation exactly); logged into `/stays`, `/promos`, `/reservations`, `/settings` as the existing seeded admin user and confirmed all four render; confirmed `Stay`/`RateTier`/`Promo`/`Reservation` counts (5/15/10/1) match what was seeded.

## Phase 4 — React booking widget ✅ done

Added `@vitejs/plugin-react@^4` (pinned for Vite 6 compat — the latest major requires Vite 8) as an isolated Vite entry (`resources/js/booking/main.jsx` + `BookingWidget.jsx`), scoped via `include: /booking\/.*\.jsx$/` so React's Fast Refresh preamble never loads on any Blade/jQuery/Kaiadmin page. Builds as a separate `main-*.js` chunk (~200KB), only loaded on the Cottages page.

`BookingWidget.jsx`: live-debounced calls to `/api/quote` as the guest changes stay/dates/guests/promo, a real price breakdown (nightly rate, weekday saving, promo discount, VAT, total — all from the server, never recomputed client-side), availability-problem messages mapped to plain English, and a guest-details form that POSTs to `/api/reservations` on submit, showing the real `BON-XXXXXX` reference on success.

Mounted on `room.blade.php` (`/rooms`, now rebuilt around the real `Stay` data instead of the dev/test `RoomType`/`Room` records — see below), with each cottage card's "Check availability" button dispatching a custom event that pre-selects that stay in the widget and scrolls to it. Header's "Book now" now links to `/rooms#booking-widget` instead of the contact page.

**Scope decision**: replaced `index_one.blade.php`'s and `room.blade.php`'s use of `Room`/`RoomType` (which only has dev/test placeholder data — "test33", "test2", amenities literally named "test456") with the new `Stay` model (5 real, published cottages/pod with real names/descriptions/rates). This is the opposite of the earlier data-integrity caution, not a violation of it: showing real content instead of leftover test placeholders to actual site visitors is the correct outcome. `Room`/`RoomType` and their full admin CRUD are untouched and still drive front-desk operations exactly as before — they're just no longer what the public marketing page displays.

**Verified end-to-end by me, live, three times**: (1) filled the widget for Chitra/3 nights/2 guests and confirmed the on-screen quote matches a hand calculation exactly; (2) clicked a cottage card's "Check availability" button and confirmed it pre-selects that stay and updates the guest-count minimum; (3) filled and submitted the full guest-details form, got back a real `BON-BJG5YN` reference, then independently confirmed in the DB that the reservation was created with the correct stay/dates/total, and in `storage/logs/laravel.log` that the office-notification email fired with the correct figures.

## Phase 5 — Final QA ✅ done

- Swept every public route (`/`, `/about`, `/rooms`, `/packages`, `/services`, `/contact`, `/faq`, `/gallery`, `/journal`, `/journal/{slug}`, `/terms-and-conditions`, `/login`) — all return 200.
- Confirmed the admin/Kaiadmin panel is genuinely untouched: `git diff main` shows zero changes to `resources/views/layouts/*`, `public/assets/*` (Kaiadmin), or any `Room`/`RoomType`/`CheckIn`/`Checkout` model/controller/view.
- Ran `php artisan test`: found it was at **1/25 passing** before I touched anything, root-caused to a pre-existing, unrelated bug (`bigInteger('category_id', 60)` in the original `create_packages_table` migration passes `60` as Laravel's `$autoIncrement` argument, not a length — creates two auto-increment columns, which MySQL rejects outright). Confirmed via `git diff main` that this migration was **untouched by any of this work** and the bug traces to the original project-setup commit. Fixed it (one-line, additive-safe: the buggy migration already ran successfully against the live dev DB long ago, so editing the file has zero effect on existing data — it only matters for a fresh migrate, e.g. this test suite). **Now 22/25 passing.**
- The remaining 3 failures are a second, separate pre-existing issue: `route('profile.edit')` (Breeze's default) actually resolves to `admin.profile.edit`, because the app's original author wrapped Breeze's default profile routes inside its `Route::middleware('auth')->name('admin.')->group()`. Fixing this properly requires a naming-convention decision (rename the route, or move profile/dashboard out of the `admin.` group) that's outside this task's scope — left alone, flagged here for a decision later.
- Final `npx vite build`: clean, 81 modules, 4 output chunks (frontend CSS, admin app CSS/JS untouched, new booking widget JS).

## What's genuinely NOT done (by design, not oversight)

- **Payment integration**: intentionally skipped — the resort's own real, published FAQ says payment is currently manual/offline ("we send payment details for a deposit... the balance is settled with us directly"), so building a fake gateway would be fabrication, not a feature. Reservations are enquiry-style requests requiring staff confirmation via the new `/reservations` admin page, matching that real process.
- **`bookingConfirmed.blade.php`**: built as a static placeholder, no route wired to it. Not needed for a complete flow — the booking widget already shows the guest their reference and confirmation message inline on success. Wiring a `/booking-confirmed/{reference}` page showing live reservation status would be a natural next increment if the resort later adds online payment.
- **Settings admin page** intentionally omits `holidays` (a list of one-off dates for peak pricing) — editable only via tinker/seeder for now; not enough UI value for a single list-of-dates field to justify more form complexity at this stage.
- **A dedicated Pod-only landing page** (Bonomali's source project has a separate `Pod.dc.html`) — the Pod is fully present as one of the 5 stays throughout (Cottages listing, booking widget, homepage teaser), just not on its own separate route. Would be a quick follow-up if wanted.

## How to pick this back up

Branch `feature/bonomali-merge`, nothing committed. To try it: `npm run build` (or `npm run dev`), `php artisan serve`, visit `/`. Admin login is the existing seeded user. Real content — 5 stays, 15 rate tiers, 10 promos, 28 FAQs, 10 gallery items, 11 journal posts, default settings — is already seeded via `database/seeders/BonomaliContentSeeder.php` (idempotent-ish; re-running it isn't tested for duplicate-safety, don't run it twice without checking).
