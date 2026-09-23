# Covido — COVID-19 Test, Vaccine & Hospital Management System


# COMPLETE PROJECT INSPECTION, IMPLEMENTATION & SETUP REPORT

---

# 👨‍💻 PROJECT INFORMATION

| Field | Detail |
|---|---|
| Project Name | Covido (folder name: `covid_website`) |
| Project Type | Multi-role Web Application (PHP + MySQL) |
| Project Category | Healthcare / COVID-19 Test & Vaccination Management System |
| Frontend | HTML, CSS (Bootstrap), JavaScript, PHP (server-rendered pages) |
| Backend | PHP (procedural, `mysqli`) |
| Database | MySQL (database name: `covid_system`) |
| API | No REST API found / not verified — pages are traditional server-rendered PHP, not JSON endpoints |
| Authentication | Partially implemented — a shared login page exists, but role-specific flows are incomplete/broken (see Section 14) |
| Architecture | Three separate PHP front-ends (`frontend/`, `patient/`, `Backend/`) each with their own `connection.php`, sharing one MySQL database |
| Admin Panel | Implemented, based on the "SB Admin 2" Bootstrap template (`/Backend`) |
| Hospital Panel | Implemented, based on the same "SB Admin 2" template (`/frontend/hospital`, duplicated in `/patient/hospital`) |
| User/Customer Platform | Public marketing site + patient area (`/frontend`, duplicated in `/patient`) |
| GitHub Repository | Not found in the uploaded project |

> ⚠️ Note on naming: this report keeps the developer's original file/folder names exactly as uploaded (e.g. `pateint_dashboard.php`, `covid_webite`) — these typos exist in the source code itself.

---

# 1. PROJECT OVERVIEW

The uploaded project is a **PHP/MySQL healthcare web application** built around the COVID-19 pandemic theme. It is designed as a **three-role system**:

- **Public visitors / Patients** — a marketing-style informational site (home, about, doctors, news, contact) plus registration/login and a patient area.
- **Hospitals** — a dashboard (built on the "SB Admin 2" Bootstrap admin template) where a hospital can register, get approved by an admin, view approved patients, add COVID reports, and manage vaccine/test status.
- **Administrators** — a dashboard (also "SB Admin 2") for approving hospitals, viewing patients, managing the vaccine catalog, viewing bookings, and exporting COVID reports.

The project's core purpose, as implemented, is to let hospitals register and be vetted by an admin, let patients register, and let hospital staff record COVID test results and vaccination status against a shared MySQL database (`covid_system`). A booking system (`booking` table) is referenced throughout the admin and hospital panels for tracking test/vaccine requests and their approval status.

The codebase is **not a single, unified application**. It consists of **three parallel PHP project folders** (`frontend/`, `patient/`, `Backend/`) that each independently connect to the same database and, in the case of `frontend/` and `patient/`, duplicate a large amount of near-identical code (including an entire embedded copy of the SB Admin 2 hospital dashboard inside each). This structure appears to be the result of incremental, copy-paste development rather than a single planned architecture.

---

# 2. PROJECT CATEGORY

**Healthcare Management System — COVID-19 Test & Vaccination Tracking Platform**, combining:
- A public informational/marketing website
- A hospital administration dashboard
- An admin/super-admin dashboard

---

# 3. TECHNOLOGIES USED

## Frontend
- HTML5 / CSS3
- Bootstrap (v4 via CDN in several pages, and a bundled `bootstrap.min.css`/`bootstrap.bundle.min.js` in `frontend/js` and `patient/js`)
- Vanilla JavaScript
- jQuery (`jquery.min.js`, `jquery.validate.js`)
- Owl Carousel (`owl.carousel.min.js/css`)
- mCustomScrollbar (`jquery.mCustomScrollbar`)
- Animate.css (`animate.min.css`)
- Nice Select (`nice-select.css`)
- Font Awesome (icon font, both the older 4.x CSS build in the public site and the FontAwesome-Free vendor package in the admin/hospital panels)
- Google Fonts ("Nunito", used by the SB Admin 2 panels)
- Poppins / IcoMoon custom web fonts (self-hosted `.ttf`/`.woff`)

## Backend
- PHP (procedural style), using the `mysqli` extension (both the object-oriented `new mysqli(...)` form and the procedural `mysqli_connect()` form appear in different files)
- PHP sessions (`session_start()`, `$_SESSION`) for login state
- No PHP framework (no Laravel/Symfony/CodeIgniter) — plain PHP scripts, one per page

## Database
- **MySQL**, connected to a database named `covid_system`
- No ORM; all queries are raw SQL strings

## APIs
**REST API was not found / not verified.** All PHP files render full HTML pages directly (server-side rendering) rather than exposing JSON endpoints. There is no `/api` folder, no `Content-Type: application/json` response, and no route/controller layer.

## Libraries & Frameworks
- **SB Admin 2** (Start Bootstrap, v4.1.3) — the open-source Bootstrap 4 admin dashboard template, used as-is for the Admin panel (`/Backend`) and the Hospital panel (`/frontend/hospital`, `/patient/hospital`). It ships its own `package.json`, `gulpfile.js`, SCSS source, and a full FontAwesome-Free vendor package — these are template build tools, not custom application logic.
- The public-facing site (`frontend/`, `patient/`) appears to be built from a separate free HTML template ("Covido"-branded Bootstrap landing page kit).

## UI / Design
- Public site: card/section-based marketing layout, hero banner, carousels, "loading" overlay, custom fonts.
- Admin/Hospital panels: sidebar + topbar dashboard layout with stat cards, tables, and Chart.js-ready demo scripts (`chart-area-demo.js`, `chart-bar-demo.js`, `chart-pie-demo.js`) inherited from the SB Admin 2 template.

---

# 4. PROJECT STRUCTURE

```
covid_webite/
├── Backend/                     # Admin dashboard (SB Admin 2 template)
│   ├── index.php                # Admin dashboard home (live DB counts)
│   ├── admin_approve_hospitals.php
│   ├── admin_booking_details.php
│   ├── admin_covid_report.php
│   ├── admin_hospital_view.php
│   ├── admin_vaccine_list.php
│   ├── admin_viewpatients.php
│   ├── add-vaccine.php / edit-vaccine.php / delete-vaccine.php
│   ├── approve-hospitals.php / process-hospital.php
│   ├── hospital_managemnet.php
│   ├── booking_edit.php
│   ├── search_results.php
│   ├── export_covid_report.php  # Exports patients/reports to .xls
│   ├── connection.php           # MySQL connection (covid_system)
│   ├── navbar.php / sidebar.php / footer.php
│   ├── login.html / register.html / forgot-password.html   # Static SB Admin 2 template stubs (not wired to PHP/DB)
│   ├── css/ js/ scss/ vendor/   # SB Admin 2 template assets (FontAwesome, jQuery, Bootstrap)
│   └── package.json / gulpfile.js  # Template build tooling (Sass/JS bundling), unrelated to the app logic
│
├── frontend/                    # Public site + patient/hospital entry points
│   ├── index.php                # Public homepage
│   ├── about.php, cornata.php, hospital.php  # Informational pages
│   ├── contact.html / contact.php             # Contact form (DB-backed)
│   ├── doctores.html, news.html, action.html   # Static informational pages
│   ├── register.php             # Combined hospital/patient registration form
│   ├── login.php                # Combined login (routes by role_id)
│   ├── signout.php              # Session logout
│   ├── pateint_dashboard.php    # Patient dashboard — placeholder only
│   ├── hospital_dashboard.php   # Hospital dashboard — placeholder only
│   ├── connection.php           # MySQL connection (covid_system)
│   ├── navbar.php / footer.php
│   ├── css/ js/ images/ fonts/  # Public site assets
│   └── hospital/                # Full embedded copy of the Hospital admin panel (SB Admin 2)
│       ├── index.php            # Hospital dashboard home (live DB counts)
│       ├── hospital_register.php, signup.php, process-hospital.php
│       ├── hospital_add_report.php, hospital_booking_list.php
│       ├── hospital_view_approved_patients.php
│       ├── update_test_result.php, update_vaccine_status.php
│       ├── approve_request.php, reject_request.php, send_request.php
│       ├── search_results.php, logout.php
│       ├── connection.php, navbar.php, sidebar.php, footer.php
│       └── css/ js/ img/ scss/ vendor/  # SB Admin 2 assets
│
├── patient/                     # Near-duplicate of frontend/, for the patient-facing flow
│   ├── (same public pages as frontend/: index.php, about.php, register.php, login.php, etc.)
│   ├── pateint_dashboard.php    # Placeholder only
│   └── hospital/                # Another near-duplicate of the hospital admin panel
│
└── README.md (this file)
```

## Approximate File Count (non-vendor, project-authored files)

| Type | Approx. Count | Notes |
|---|---|---|
| PHP files | ~70 | Split across `Backend/`, `frontend/` (incl. `frontend/hospital/`), and `patient/` (incl. `patient/hospital/`) |
| HTML files | ~25 | Mostly static informational pages and unused SB Admin 2 template stubs (login/register/forgot-password/utilities/charts demo pages) |
| CSS files (custom) | ~5 (`style.css`, `responsive.css`, `sb-admin-2.css`, etc.) | Plus several vendored CSS libraries (Bootstrap, Animate.css, Owl Carousel, Font Awesome, nice-select) |
| SCSS partials | ~24 | SB Admin 2 template source (unused unless rebuilt with Gulp) |
| JavaScript files (custom) | ~6 | `custom.js`, `slider-setting.js`, `sb-admin-2.js`, chart demo scripts |
| JSON files | 2 | `package.json`, `package-lock.json` (SB Admin 2 template tooling only, ×3 copies) |
| SQL files | **0** | No `.sql` export is included in the project |
| Images | ~90+ | Marketing/UI images (`frontend/images`, duplicated in `patient/images`), plus SB Admin 2 sample illustrations (`undraw_*.svg`) |
| Fonts | ~20 | Poppins family, IcoMoon, FontAwesome `.otf`, Helvetica webfont |
| Vendor/third-party folders | jQuery, jQuery Easing, FontAwesome-Free (full package with hundreds of individual SVG icons) | Bundled inside `Backend/vendor`, `frontend/hospital/vendor`, `patient/hospital/vendor` |

Third-party/template resources (SB Admin 2 dashboard template, Bootstrap, jQuery, Font Awesome, Owl Carousel, Animate.css, custom web fonts) are clearly separable from the custom application code (the `.php` files containing business logic and SQL queries).

---

# 5. DATABASE IMPLEMENTATION

- **Database technology:** MySQL, accessed via the `mysqli` PHP extension.
- **Database name:** `covid_system`
- **Host:** `localhost`
- **Connection files found:** `Backend/connection.php`, `frontend/connection.php`, `frontend/hospital/connection.php`, `patient/connection.php`, `patient/hospital/connection.php` — each is a **separate, independent connection file** rather than one shared include.
- **Credentials:** username `root`, empty password (typical local XAMPP/WAMP default). No credentials are stored in environment variables.
- **Database driver:** `mysqli` (both object-oriented and procedural calling styles are used inconsistently across files).

## Tables Referenced in the Code (confirmed by `SELECT`/`INSERT`/`UPDATE`/`JOIN` statements)

| Table | Used In | Notes |
|---|---|---|
| `hospital` | Most Backend/Hospital files | Singular form — the table actually used by the dashboards |
| `hospitals` | `frontend/register.php` only | **Plural form** — inconsistent with the rest of the app, which reads/writes `hospital` |
| `patient` | Most Backend/Hospital files | Singular form — the table actually used by the dashboards |
| `patients` | `frontend/register.php` only | **Plural form** — same inconsistency as above |
| `user_credentials` | `frontend/login.php` | Expected columns: `username`, `password` (plain text), `role_id`, `user_id` |
| `booking` | Admin/Hospital dashboards, `approve_request.php`, `booking_edit.php` | Expected columns include `hospital_id`, `patient_id`, `type`, `status` |
| `bookings` | `frontend/hospital/reject_request.php` only | **Plural form**, inconsistent with `booking` used elsewhere |
| `covid_report` | `update_test_result.php`, `admin_covid_report.php` | Singular form |
| `covid_reports` | `hospital_add_report.php` | **Plural form**, inconsistent with `covid_report` used elsewhere |
| `vaccine` | `add-vaccine.php`, `admin_vaccine_list.php`, `edit-vaccine.php`, `delete-vaccine.php` | |
| `hospital_requests` | `frontend/hospital/send_request.php` | Columns: `patient_id`, `request_type`, `request_status` |
| `contact_messages` | `frontend/contact.php` | Columns: `name`, `phone`, `email`, `message` |

**The uploaded project does not contain a SQL database export.** No `.sql` file, migration script, or schema definition is present anywhere in the ZIP. The table and column names above are inferred strictly from the SQL statements embedded in the PHP source code — actual column types, primary keys, foreign keys, and indexes cannot be confirmed without the schema.

⚠️ **Naming inconsistency:** the code uses **both singular and plural table names** for the same conceptual entity (`hospital`/`hospitals`, `patient`/`patients`, `booking`/`bookings`, `covid_report`/`covid_reports`). Depending on which tables actually exist in the live database, one or more of `register.php`, `send_request.php`, `hospital_add_report.php`, or `reject_request.php` will fail at runtime.

## CRUD Operations Confirmed by Source Code

See the table in **Section 15**.

---

# 6. REQUIREMENTS

Based strictly on the technologies detected in the code:

- **PHP** (with the `mysqli` extension enabled) — version not pinned in the code; PHP 7.x/8.x compatible syntax is used
- **MySQL** or **MariaDB** server
- **Apache** (or another web server capable of running PHP) — e.g., via **XAMPP**/**WAMP**/**MAMP**
- A modern **web browser**
- **Node.js + npm** — only required if you intend to rebuild the SB Admin 2 template's Sass/JS via Gulp (`package.json`/`gulpfile.js` in `Backend/`, `frontend/hospital/`, `patient/hospital/`); **not required** to simply run the application, since compiled CSS/JS (`sb-admin-2.css`, `sb-admin-2.min.css`, etc.) is already included
- A code editor such as **VS Code** (optional, for development)

---

# 7. INSTALLATION & SETUP

> These steps reflect what the code actually expects (e.g., hard-coded `localhost` DB host and the `http://localhost/covid_webite/...` redirect URLs found in `frontend/login.php`). No `composer.json`, `.env`, or dependency-installation script was found for the PHP side.

1. **Install prerequisites:** Install XAMPP (or WAMP/MAMP) so Apache, PHP, and MySQL are available locally.
2. **Extract the project:** Unzip the uploaded archive so that its root folder is named `covid_webite`.
3. **Place the project** inside your server's web root, e.g. `C:\xampp\htdocs\covid_webite` (Windows/XAMPP) or `/opt/lampp/htdocs/covid_webite` (Linux/XAMPP). This path matters because `frontend/login.php` hard-codes redirect URLs such as `http://localhost/covid_webite/Backend/index.php`.
4. **Start Apache and MySQL** from the XAMPP control panel (or equivalent).
5. **Create the database:** Open phpMyAdmin (`http://localhost/phpmyadmin`) and create a new database named exactly `covid_system` (this name is hard-coded in every `connection.php` file).
6. **Create the required tables manually.** No SQL dump is included, so you must create tables matching the columns referenced in Section 5 (`hospital`, `patient`, `user_credentials`, `booking`, `covid_report`, `vaccine`, `hospital_requests`, `contact_messages`) before the application will function. See Section 8 for details.
7. **Verify database credentials:** All `connection.php` files assume host `localhost`, user `root`, and an **empty password**. If your MySQL root user has a password, you must edit every `connection.php` file (there are 5 separate copies — see Section 5) to match.
8. **No PHP dependency installation is required** — the project uses plain `mysqli` calls with no Composer packages.
9. **(Optional) Rebuild admin template assets:** If you want to modify the SB Admin 2 SCSS/JS, run `npm install` followed by `npm start` inside `Backend/`, `frontend/hospital/`, or `patient/hospital/` (each has its own `package.json`/`gulpfile.js`). This is not necessary to run the site, since compiled CSS/JS is already present.
10. **Open the application** in your browser (see Section 33 for URLs).
11. **Register test data**, since the database starts empty (no seed data / SQL export is provided).
12. **Sign in** using credentials you insert directly into `user_credentials`, `hospital`, or `patient` (see Section 14 for why the built-in registration forms alone are not sufficient to log in through `frontend/login.php`).

---

# 8. DATABASE SETUP

**No SQL file exists in this project**, so the schema must be created manually. Based strictly on the columns referenced in the PHP source (see Section 5's table), you will need, at minimum, tables that can satisfy the following queries found in the code:

```sql
-- Referenced by frontend/login.php
-- user_credentials(username, password, role_id, user_id)

-- Referenced by Backend/, frontend/hospital/, patient/hospital/
-- hospital(id, name, email, phone, address, registration_no, register_date, password, status, user_id)

-- Referenced by Backend/, frontend/hospital/
-- patient(id, name, email, phone, address, dob, gender, status, approved_test, vaccine_status, user_id)

-- Referenced by admin_booking_details.php, approve_request.php, booking_edit.php
-- booking(id, patient_id, hospital_id, type, status)

-- Referenced by update_test_result.php, admin_covid_report.php, export_covid_report.php
-- covid_report(id, patient_id, hospital_id, date, result)

-- Referenced by hospital_add_report.php
-- covid_reports(id, hospital_id, patient_id, booking_id, report_details, report_date)

-- Referenced by add-vaccine.php, admin_vaccine_list.php
-- vaccine(id, vaccine_name, availability, dose_required, created_at)

-- Referenced by frontend/hospital/send_request.php
-- hospital_requests(id, patient_id, request_type, request_status)

-- Referenced by frontend/contact.php
-- contact_messages(id, name, phone, email, message)
```

These are **inferred column lists**, not a verified schema — exact data types, defaults, and relationships (foreign keys) must be defined by the developer, since no schema/migration file exists in the uploaded project. Note again the singular/plural table-name conflicts described in Section 5 (`covid_report` vs. `covid_reports`, `booking` vs. `bookings`, `hospital` vs. `hospitals`, `patient` vs. `patients`) — you will need to decide on one naming convention and update the inconsistent files accordingly for the whole application to work end-to-end.

---

# 9. CONFIGURATION

## Configuration files found
- `Backend/connection.php`
- `frontend/connection.php`
- `frontend/hospital/connection.php`
- `patient/connection.php`
- `patient/hospital/connection.php`

Each of these hard-codes:
```php
$host = "localhost";
$user = "root";
$password = "";          // empty — local development default
$database = "covid_system";
```

**No `.env` file, no external configuration/secrets file, and no API keys are present in the project.** The only "configuration" is the direct database connection string repeated in five separate files.

🔒 **Security note:** These are default local-development credentials (empty root password), not production secrets — there is nothing sensitive to redact here, but this also means the project is **not configured for production use**. Before any real deployment, credentials should be moved out of source-controlled PHP files and into environment variables (e.g., via `getenv()` or a `.env` loader), and a dedicated, least-privilege MySQL user (not `root`) should be used.

---

# 10. USER / CUSTOMER FEATURES

| Feature | Status |
|---|---|
| Public homepage (`index.php`) | ✅ IMPLEMENTED (static/informational) |
| About / "Corona Virus" info page | ✅ IMPLEMENTED (static content) |
| Doctors listing page (`doctores.html`) | 🖥️ UI ONLY (static HTML, not database-driven) |
| News page (`news.html`) | 🖥️ UI ONLY (static HTML) |
| Contact form | ✅ IMPLEMENTED (inserts into `contact_messages` via `frontend/contact.php`) |
| Combined Hospital/Patient registration (`register.php`) | ⚠️ PARTIALLY IMPLEMENTED — inserts into `hospitals`/`patients` tables, which are **not the same tables** (`hospital`/`patient`) read by the login and dashboard pages (see Section 5 and 14) |
| Login (`login.php`) | ⚠️ PARTIALLY IMPLEMENTED — queries `user_credentials` and routes by `role_id`, but nothing in the codebase writes to `user_credentials`, so no account created via the public registration form can actually log in |
| Patient dashboard | 🖥️ UI ONLY — `frontend/pateint_dashboard.php` and `patient/pateint_dashboard.php` only output the literal text "this is patient dashboard" behind a session check; no real patient functionality (viewing own test results, booking a test/vaccine, etc.) is implemented |
| Booking a COVID test / vaccine appointment (patient-initiated) | ❌ NOT IMPLEMENTED / NOT FOUND — no form or endpoint in the entire project inserts a new row into the `booking` table; bookings can only be **viewed/approved/rejected/deleted**, never **created** |
| Logout | ✅ IMPLEMENTED (`frontend/signout.php` destroys the session) |

---

# 11. ADMIN PANEL

Located in `/Backend`, built on the SB Admin 2 template.

| Feature | Status |
|---|---|
| Dashboard home with live counts (registered patients, approved/pending hospitals, completed vaccinations) | ✅ IMPLEMENTED — values are pulled live via `SELECT COUNT(*)` queries against `patient`, `hospital`, and `booking` |
| Sidebar / topbar navigation | ✅ IMPLEMENTED (template-provided) |
| Admin login gate on dashboard (`session_start()` + `$_SESSION['admin']` check) | ⚠️ PARTIALLY IMPLEMENTED — `Backend/index.php` redirects unauthenticated users to `admin_login.php`, but **that file does not exist anywhere in the project**, and no code anywhere sets `$_SESSION['admin']`. `Backend/login.html` is present but is a static, unwired SB Admin 2 template page with no form `action` and no PHP logic. **The admin panel therefore has no working login path as delivered.** |
| Hospital approval queue (`admin_approve_hospitals.php`) | ✅ IMPLEMENTED — approves/rejects hospitals with a direct `UPDATE hospital SET status=...` |
| Hospital directory view (`admin_hospital_view.php`) | ✅ IMPLEMENTED (read-only listing) |
| Patient management — view all patients (`admin_viewpatients.php`) | ✅ IMPLEMENTED (read-only listing; no edit/delete for patients was found) |
| Vaccine catalog — add/edit/delete/list (`add-vaccine.php`, `edit-vaccine.php`, `delete-vaccine.php`, `admin_vaccine_list.php`) | ✅ IMPLEMENTED — full CRUD confirmed against the `vaccine` table |
| Booking details — view/delete (`admin_booking_details.php`) | ⚠️ PARTIALLY IMPLEMENTED — bookings can be viewed and deleted, but not created or manually re-assigned from this screen |
| Booking edit (`booking_edit.php`) | ✅ IMPLEMENTED (updates an existing booking's fields) |
| Global search across hospitals/patients (`search_results.php`) | ✅ IMPLEMENTED (uses `LIKE` search with `UNION`) |
| Export COVID reports to Excel (`export_covid_report.php`) | ✅ IMPLEMENTED — streams a `.xls`-labelled HTML table joining `covid_report`, `patient`, and `hospital` |
| Reports & Analytics ("Charts" page) | 🖥️ UI ONLY — `charts.html` is an unmodified SB Admin 2 demo page with the template's own **hardcoded sample data**, not wired to the project's database |
| Role-based permissions (multiple admin roles) | ❌ NOT IMPLEMENTED / NOT FOUND — only a single implicit "admin" concept exists (and, as noted above, its login gate is broken) |

---

# 12. MODULE-BY-MODULE IMPLEMENTATION

### Authentication
- **Files:** `frontend/login.php`, `frontend/register.php`, `frontend/signout.php`, `patient/login.php`, `frontend/hospital/hospital_register.php`, `frontend/hospital/logout.php`, `Backend/login.html` (unwired), `Backend/index.php` (session gate)
- **Frontend:** Plain HTML forms, styled with Bootstrap.
- **Backend:** `mysqli` queries against `user_credentials` (patients/general users) and direct `INSERT`/`SELECT` against `hospital` (hospital accounts).
- **Database:** `user_credentials`, `hospital`.
- **Status:** Partially implemented and internally inconsistent (see Section 14).

### Hospital Registration & Approval
- **Files:** `frontend/hospital/hospital_register.php`, `frontend/hospital.php`, `Backend/admin_approve_hospitals.php`, `Backend/process-hospital.php`
- **Frontend:** Registration form collecting name, email, phone, address, registration number, password.
- **Backend:** Inserts a `Pending` hospital row; admin can approve/reject, flipping the `status` column.
- **Database:** `hospital` table.
- **Status:** ✅ Implemented end-to-end for the approval workflow (registration → pending → admin approve/reject).

### Patient Management
- **Files:** `Backend/admin_viewpatients.php`, `frontend/hospital/hospital_view_approved_patients.php`
- **Frontend:** Read-only Bootstrap tables.
- **Backend:** Simple `SELECT * FROM patient` (and `WHERE status='Approved'` for the hospital view).
- **Status:** ✅ Implemented (read-only). No patient edit/delete found in either panel.

### COVID Test Reporting
- **Files:** `frontend/hospital/hospital_add_report.php`, `frontend/hospital/update_test_result.php`, `Backend/admin_covid_report.php`, `Backend/export_covid_report.php`
- **Backend:** Hospitals can submit a free-text report (`covid_reports` table) or update a structured Positive/Negative/Pending result (`covid_report` table) — **these are two different tables for what appears to be the same concept**, so the two features do not share data.
- **Status:** ⚠️ Partially implemented / fragmented due to the table-name split.

### Vaccine Management
- **Files:** `Backend/add-vaccine.php`, `edit-vaccine.php`, `delete-vaccine.php`, `admin_vaccine_list.php`, `frontend/hospital/update_vaccine_status.php`
- **Backend:** Full CRUD on the `vaccine` catalog (name, availability, doses required) from the admin side; hospitals can separately update a patient's `vaccine_status` field.
- **Status:** ✅ Implemented.

### Booking / Requests
- **Files:** `frontend/hospital/send_request.php`, `frontend/hospital/approve_request.php`, `frontend/hospital/reject_request.php`, `Backend/admin_booking_details.php`, `Backend/booking_edit.php`
- **Backend:** A hospital can log a request (`hospital_requests` table) on behalf of a patient; separately, bookings in the `booking`/`bookings` table can be approved, rejected, viewed, edited, and deleted — but, as noted, never *created* through any confirmed code path other than `send_request.php`'s `hospital_requests` insert, which is a **different table** from `booking`.
- **Status:** ⚠️ Partially implemented / fragmented; `reject_request.php` additionally references a non-existent include (`../Backend/db_connect.php` instead of `connection.php`) and the `bookings` table instead of `booking`, so this specific file will error at runtime as written.

### Contact
- **Files:** `frontend/contact.php`
- **Status:** ✅ Implemented (stores submissions in `contact_messages`).

### Dashboard / Analytics
- **Files:** `Backend/index.php`, `frontend/hospital/index.php`
- **Status:** ✅ Implemented for the summary count cards (live `COUNT(*)` queries). ❌ The `charts.html` "Reports & Analytics" page is unmodified SB Admin 2 demo content with hardcoded sample numbers, not real analytics.

---

# 13. API IMPLEMENTATION

**REST API was not found in the uploaded project.** Every `.php` file renders a complete HTML page (or, in the case of `export_covid_report.php`, an HTML table with `.xls` headers) rather than exposing a JSON/REST endpoint. There is no routing layer, no `/api` directory, and no `Content-Type: application/json` responses anywhere in the codebase.

---

# 14. AUTHENTICATION & AUTHORIZATION

| Aspect | Status |
|---|---|
| Registration UI | ✅ Present (`register.php`, `hospital_register.php`) |
| Registration backend | ⚠️ Partially implemented — `frontend/register.php` writes to `hospitals`/`patients` (plural), while `hospital_register.php` writes correctly to `hospital` (singular) |
| Login UI | ✅ Present (`login.php`) |
| Login backend | ⚠️ Implemented but broken end-to-end for public sign-ups — `login.php` reads from `user_credentials`, a table that **no registration form in the project ever inserts into**. As written, a user who registers via `register.php` cannot subsequently log in via `login.php`. |
| Sessions | ✅ Implemented (`session_start()`, `$_SESSION['username']`, `$_SESSION['hospital_id']`, `$_SESSION['patient_id']`) |
| Password hashing | ❌ NOT IMPLEMENTED — passwords are compared with a plain `===` string check (`frontend/login.php`) and stored/inserted as plain text (`hospital_register.php`); no `password_hash()`/`password_verify()` calls exist anywhere in the project |
| Password reset | 🖥️ UI ONLY — `forgot-password.html` exists only as an unwired SB Admin 2 template page |
| Email verification | ❌ NOT IMPLEMENTED / NOT FOUND |
| Role-based access (patient / hospital / admin) | ⚠️ PARTIALLY IMPLEMENTED — `login.php` branches on a `role_id` column and redirects accordingly, but the admin branch (`role_id == 1`) simply redirects to `Backend/index.php`, which itself requires `$_SESSION['admin']` — a session key that **is never set by `login.php` or anywhere else in the project** |
| Protected routes | ⚠️ PARTIALLY IMPLEMENTED — several hospital pages check `$_SESSION['hospital_id']` before proceeding, but the placeholder patient dashboards check a differently-shaped session (`$_SESSION['user']['role']`) that nothing in the login flow ever populates, and the admin dashboard's gate points at a non-existent login page |

**Summary:** Authentication **UI** (forms, pages) exists across all three roles, but the **backend wiring between registration → credential storage → login → session → dashboard access is inconsistent and, for the admin role, incomplete** (missing `admin_login.php`, no code sets `$_SESSION['admin']`). This should be treated as a partially implemented / broken authentication system rather than a working one, as delivered.

---

# 15. CRUD OPERATIONS

| Module | Create | Read | Update | Delete | Status |
|---|---|---|---|---|---|
| Hospital accounts | ✅ (`hospital_register.php`) | ✅ (`admin_hospital_view.php`, login lookups) | ✅ (approve/reject status) | ❌ Not found | ⚠️ Partial |
| Patient accounts | ✅ (`register.php`, into `patients`) | ✅ (`admin_viewpatients.php`) | ❌ Not found | ❌ Not found | ⚠️ Partial |
| Vaccine catalog | ✅ (`add-vaccine.php`) | ✅ (`admin_vaccine_list.php`) | ✅ (`edit-vaccine.php`) | ✅ (`delete-vaccine.php`) | ✅ Full CRUD |
| Booking | ❌ Not found (no create path into `booking`) | ✅ (`admin_booking_details.php`, `approve_request.php`) | ✅ (`booking_edit.php`, approve/reject status) | ✅ (`admin_booking_details.php`) | ⚠️ Partial (no Create) |
| Hospital requests (`hospital_requests`) | ✅ (`send_request.php`) | ❌ No listing page found | ❌ Not found | ❌ Not found | ⚠️ Partial (Create only) |
| COVID reports (`covid_report`) | ❌ Not found | ✅ (`admin_covid_report.php`, `export_covid_report.php`) | ✅ (`update_test_result.php`) | ❌ Not found | ⚠️ Partial |
| COVID reports (`covid_reports`, separate table) | ✅ (`hospital_add_report.php`) | ❌ No listing page found | ❌ Not found | ❌ Not found | ⚠️ Partial (Create only) |
| Contact messages | ✅ (`contact.php`) | ❌ No admin listing page found | ❌ Not found | ❌ Not found | ⚠️ Partial (Create only) |

---

# 16. FRONTEND IMPLEMENTATION

- **Pages:** Public marketing pages (home, about, doctors, news, contact), combined registration/login, patient placeholder dashboard, and two full copies of a hospital admin dashboard.
- **Components:** Shared PHP partials via `include()` — `navbar.php`, `footer.php`, `sidebar.php` (admin/hospital panels only).
- **Layout:** Bootstrap grid-based responsive layout on the public site; SB Admin 2's sidebar + topbar layout on the admin/hospital panels.
- **Forms:** Native HTML forms posting to the same PHP file (`action=""`), validated only with the `required` HTML attribute — no custom client-side validation logic was found tied to these forms, aside from the generic `jquery.validate.js` library being loaded (not confirmed to be actively bound to any specific form in the inspected files).
- **CSS framework:** Bootstrap (v4/v5 mixed, depending on the page — some pages load Bootstrap 4.6.2 or 5.3.x from a CDN, others use a locally bundled `bootstrap.min.css`).
- **JavaScript:** jQuery-based interactivity (carousel, scrollbar, loader animation) on the public site; SB Admin 2's own JS (`sb-admin-2.js`) plus Chart.js demo scripts on the admin/hospital panels.
- **Charts:** Chart.js **demo** scripts (`chart-area-demo.js`, `chart-bar-demo.js`, `chart-pie-demo.js`) are present from the SB Admin 2 template but were not found wired to live application data.
- **Assets:** Large image library for the marketing site (`frontend/images`, duplicated in `patient/images`), custom Poppins/IcoMoon fonts, and SB Admin 2's own illustration SVGs (`undraw_*.svg`).

---

# 17. BACKEND IMPLEMENTATION

- **Language:** PHP, procedural style (no classes/controllers).
- **Routing:** None — each `.php` file is directly requested by URL; there is no front controller or router.
- **Database access:** Direct `mysqli_query()`/`mysqli_connect()` calls (and, in a few files such as `frontend/hospital.php`, prepared statements with `bind_param`) scattered inside the same file that renders the HTML.
- **Middleware:** None in the framework sense; access checks are done ad hoc via `if (!isset($_SESSION[...]))` at the top of individual files, inconsistently applied (see Section 14).
- **Business logic:** Embedded directly inside each page script (no service layer).
- **Validation:** Minimal — mostly relies on the HTML `required` attribute; some files use `mysqli_real_escape_string()` before inserting, others (e.g. `admin_approve_hospitals.php`, `process-hospital.php`, `update_test_result.php`) interpolate `$_GET`/`$_POST` values directly into SQL strings without escaping.
- **Error handling:** Basic — several files call `die("Connection failed: ...")` on DB connection failure; most query failures are silently ignored (no `mysqli_error()` check) except in the registration and admin approval flows, which do surface `mysqli_error($conn)` to the user.

---

# 18. RESPONSIVE DESIGN

- The public site includes a dedicated `responsive.css` stylesheet and uses the Bootstrap grid, so it is reasonable to say **basic responsive layout is implemented** for the marketing pages.
- The admin/hospital dashboards inherit SB Admin 2's responsive sidebar/topbar behavior (collapsible sidebar, responsive tables via `.table-responsive`), which is a supported feature of that template.
- No custom mobile-specific testing artifacts (e.g., dedicated mobile screenshots, breakpoints beyond the template/Bootstrap defaults) were found, so deeper responsive QA (very small screens, tablet-specific tuning) is **not verified**.

---

# 19. SECURITY INSPECTION

| Practice | Status |
|---|---|
| Password hashing | ❌ Not implemented — plain-text comparison and storage |
| SQL injection protection | ⚠️ Inconsistent — some files use `mysqli_real_escape_string()` or prepared statements (`frontend/hospital.php`); many others (e.g. `admin_approve_hospitals.php`, `process-hospital.php`, `update_test_result.php`, `update_vaccine_status.php`, `search_results.php` partially) interpolate `$_GET`/`$_POST` directly into SQL strings, which is a SQL-injection risk |
| Prepared statements | ⚠️ Used in isolated places only, not consistently across the codebase |
| Session-based authorization | ⚠️ Present but inconsistent (see Section 14) |
| Input validation | ⚠️ Minimal — largely limited to HTML `required` attributes and `empty()` checks on the contact form |
| File upload validation | ❌ Not applicable / not found — no file upload functionality exists in the project |
| XSS protection | ⚠️ Partial — many table-rendering pages correctly use `htmlspecialchars()` on output, but not universally (e.g., some admin pages echo `$row[...]` values directly) |
| CSRF protection | ❌ Not implemented — no CSRF tokens found on any form |
| Environment variables for secrets | ❌ Not used — DB credentials are hard-coded directly in five separate PHP files |
| Credential exposure risk | ⚠️ Database credentials (`root` / empty password) are hard-coded in source; since this is a default local-dev credential (no real secret), it is a **configuration weakness for production use** rather than an exposed live secret |

**Recommendation:** Before any production or public deployment, the project would need password hashing (`password_hash`/`password_verify`), consistent use of prepared statements everywhere, CSRF tokens on all state-changing forms, and externalized configuration (environment variables) for database credentials.

---

# 20. ERROR HANDLING & VALIDATION

- **Client-side validation:** HTML5 `required` attributes on form fields; the `jquery.validate.js` library is loaded on the public site but no explicit `.validate()` binding was found in the inspected JS files.
- **Server-side validation:** Basic `empty()` checks (contact form, `hospital.php`); most other forms trust `$_POST` values directly.
- **Database errors:** Connection failures are handled with `die("Connection failed: ...")`. Query failures are surfaced to the user only in a few flows (registration, hospital approval); elsewhere they fail silently (a failed `mysqli_query()` simply returns `false`, and subsequent `mysqli_fetch_assoc()`/`mysqli_num_rows()` calls on that `false` result would trigger a PHP warning rather than a handled error).
- **HTTP/API errors:** Not applicable — no REST API layer exists.
- **Empty states:** Some listing pages do show a "No data" / "No pending requests" message (`hospital_view_approved_patients.php`, `approve_request.php`); others (e.g. `admin_viewpatients.php`) will simply render an empty table with no explicit empty-state message.

---

# 21. SEARCH, FILTERING & SORTING

| Feature | Status |
|---|---|
| Admin global search (hospitals + patients) | ✅ IMPLEMENTED — `Backend/search_results.php` runs a `LIKE`-based `UNION` query across `hospital` and `patient` |
| Hospital booking filter (`?filter=pending`) | ✅ IMPLEMENTED — `hospital_booking_list.php` appends a `WHERE status='pending'` clause based on a query-string parameter |
| Category / price filters | ❌ Not applicable — no e-commerce catalog exists in this project |
| Sorting | ❌ Not found — no `ORDER BY` clause with user-controlled sort direction was found on any listing page |
| Pagination | ❌ Not found — all listing pages (`admin_viewpatients.php`, `admin_vaccine_list.php`, `admin_hospital_view.php`, etc.) load and render the full result set with no `LIMIT`/page controls |

---

# 22. REPORTS & ANALYTICS

- **Dashboard summary cards** (`Backend/index.php`, `frontend/hospital/index.php`): ✅ **Dynamic / database-driven** — figures come from live `SELECT COUNT(*)` queries.
- **"Charts" page** (`charts.html` in `Backend/`, `frontend/hospital/`, `patient/hospital/`): ❌ **Hardcoded / mock data** — this is the unmodified SB Admin 2 demo page, using the template's built-in sample datasets in `chart-area-demo.js`, `chart-bar-demo.js`, and `chart-pie-demo.js`. It is not connected to `covid_system` and should not be described as real analytics.
- **Excel export** (`export_covid_report.php`): ✅ **Dynamic / database-driven** — pulls a live `JOIN` across `covid_report`, `patient`, and `hospital`.

---

# 23. TESTING CHECKLIST

```
[ ] Apache and MySQL start successfully (XAMPP/WAMP)
[ ] Database "covid_system" exists and connection.php files connect without error
[ ] Required tables have been manually created (see Section 8)
[ ] Public homepage (frontend/index.php) loads
[ ] Contact form submits and a row appears in contact_messages
[ ] Hospital registration (hospital_register.php) inserts a Pending row into `hospital`
[ ] Admin can view/approve/reject pending hospitals (requires manually granting admin session access — see Section 14)
[ ] Approved hospital can log in and reach frontend/hospital/index.php
[ ] Hospital dashboard shows correct live counts from `booking`
[ ] Vaccine can be added, edited, listed, and deleted from the admin panel
[ ] Hospital can submit a COVID report via hospital_add_report.php
[ ] Hospital can update a test result via update_test_result.php
[ ] Hospital can update a patient's vaccine status
[ ] Admin can export a COVID report as .xls
[ ] Global search returns matching hospitals/patients
[ ] Patient registration (register.php) — confirm this does NOT currently allow login via login.php (known gap, see Section 14)
```

---

# 24. CONFIRMED IMPLEMENTED FEATURES

- ✅ Public marketing site (home, about, contact) with database-backed contact form
- ✅ Hospital registration → admin approval workflow
- ✅ Admin dashboard with live counts (patients, hospitals, vaccinations)
- ✅ Hospital dashboard with live counts (approved/pending bookings, test/vaccine totals)
- ✅ Full CRUD for the vaccine catalog
- ✅ Hospital-side vaccine status and COVID test result updates
- ✅ Admin-side booking view/edit/delete
- ✅ Global admin search across hospitals and patients
- ✅ COVID report export to Excel-compatible file
- ✅ Session-based logout

# 25. PARTIALLY IMPLEMENTED FEATURES

- ⚠️ **Registration → Login pipeline:** registration writes to `hospitals`/`patients` (plural) while the app reads `hospital`/`patient` (singular); `login.php` reads `user_credentials`, which nothing populates.
- ⚠️ **Admin authentication:** the dashboard gate expects `$_SESSION['admin']` and a page called `admin_login.php`, neither of which is implemented/exists.
- ⚠️ **Booking workflow:** bookings can be reviewed, approved, rejected, edited, and deleted, but no in-project form actually **creates** a new `booking` row.
- ⚠️ **COVID reporting:** split across two differently-named tables (`covid_report` vs. `covid_reports`) with no shared read/write path.
- ⚠️ **Patient dashboard:** exists only as a placeholder ("this is patient dashboard") behind a session check that the login flow never actually satisfies.

# 26. FEATURES NOT IMPLEMENTED / NOT FOUND

- ❌ REST/JSON API of any kind
- ❌ Password hashing, CSRF protection, or rate limiting
- ❌ Patient self-service booking of a COVID test or vaccine appointment
- ❌ Patient-facing view of their own test/vaccine history
- ❌ Email verification or password-reset backend (the "forgot password" page is a static, unwired template stub)
- ❌ Pagination or user-controlled sorting on any listing page
- ❌ Role/permission management beyond an implicit admin/hospital/patient split
- ❌ Automated tests of any kind (no test suite/files found)
- ❌ SQL schema/migration/export file

# 27. CURRENT PROJECT STATUS

```
Frontend:        PARTIAL   (public site complete; patient area is placeholder-only)
Backend:         PARTIAL   (admin + hospital modules largely functional; several broken links/paths)
Database:        PARTIAL   (no schema file provided; naming inconsistencies between files)
Authentication:  PARTIAL / BROKEN FOR ADMIN  (admin login path does not exist; patient registration and login are not connected)
Admin Panel:     PARTIAL   (most CRUD screens work; login gate to reach them is broken as delivered)
API:             NOT FOUND
Payments:        NOT FOUND
Security:        NEEDS IMPROVEMENT
```

---

# 28. PROJECT WORKFLOW

## Hospital onboarding & operations (the most complete workflow)
```
Hospital
  ↓
hospital_register.php  (INSERT INTO hospital, status='Pending')
  ↓
Admin reviews via admin_approve_hospitals.php
  ↓
Admin approves/rejects (UPDATE hospital SET status=...)
  ↓
Hospital logs in via frontend/login.php (role_id = 2)
  ↓
frontend/hospital/index.php  (Hospital Dashboard — live booking counts)
  ↓
Hospital manages: approved patients / test reports / vaccine status / booking approvals
```

## Public visitor / patient (as implemented)
```
Visitor
  ↓
frontend/index.php (browse public content, contact form)
  ↓
register.php (choose role = patient → INSERT INTO patients)
  ↓
login.php (queries user_credentials — NOT populated by the above step)
  ↓
⚠️ Login cannot currently succeed for a self-registered patient
```

---

# 29. PROJECT ARCHITECTURE

```
                ┌───────────────────────┐
                │   Web Browser (User)   │
                └───────────┬────────────┘
                            │  HTTP
      ┌─────────────────────┼─────────────────────┐
      │                     │                     │
┌─────▼──────┐      ┌───────▼────────┐    ┌───────▼────────┐
│ frontend/   │      │ frontend/      │    │ Backend/        │
│ (public +   │      │ hospital/      │    │ (Admin panel,   │
│  patient    │      │ (Hospital      │    │  SB Admin 2)    │
│  entry)     │      │  panel,        │    │                 │
│             │      │  SB Admin 2)   │    │                 │
└─────┬───────┘      └───────┬────────┘    └───────┬─────────┘
      │                       │                      │
      │        (each has its own connection.php)     │
      └───────────────┬──────────────┬────────────────┘
                       │              │
                 ┌─────▼──────────────▼─────┐
                 │   MySQL: covid_system      │
                 │ hospital / patient /       │
                 │ booking / vaccine / etc.   │
                 └────────────────────────────┘

Note: patient/ is a near-duplicate of frontend/ (including its own
copy of the hospital panel) and connects to the same database
independently — it is not a shared module.
```

---

# 30. COMMON ERRORS & SOLUTIONS

| Error | Likely Cause | Solution |
|---|---|---|
| `Connection failed: ...` on any page | MySQL not running, wrong credentials, or `covid_system` database missing | Start MySQL, create the `covid_system` database, verify credentials in the relevant `connection.php` |
| Blank page / "Table doesn't exist" (via PHP warning) | The required table hasn't been created (no SQL dump is shipped) | Manually create the tables listed in Section 8 before testing that module |
| Registering as a patient, then unable to log in | `register.php` writes to `patients`, but `login.php` reads `user_credentials` | Insert a matching row into `user_credentials` manually, or align the two files to use the same table (see Section 25) |
| Redirected to a 404 after visiting `Backend/index.php` without a session | `admin_login.php` is referenced but does not exist in the project | Create an `admin_login.php` that authenticates and sets `$_SESSION['admin']`, or point the redirect at an existing login page |
| `frontend/hospital/reject_request.php` fatal error | It includes a non-existent `../Backend/db_connect.php` and targets a `bookings` table that isn't used elsewhere | Fix the include path to `connection.php` and align the table name to `booking` |
| Dashboard links (e.g. sidebar `index.php`) go to the wrong panel | The project has three parallel copies of similar pages (`frontend/`, `patient/`, `Backend/`) with hard-coded `http://localhost/covid_webite/...` paths | Ensure the project folder is placed exactly as `covid_webite` in your web root, matching the hard-coded paths in `frontend/login.php` |
| Vaccine/report changes don't show up where expected | Two differently-named tables are used for the same concept (`covid_report` vs `covid_reports`) | Standardize on a single table name and update all referencing files |

---

# 31. FUTURE IMPROVEMENTS

- Unify the three parallel project folders (`frontend/`, `patient/`, `Backend/`) into a single application with one shared connection file and one copy of the hospital panel.
- Resolve the singular/plural table-name conflicts (`hospital`/`hospitals`, `patient`/`patients`, `booking`/`bookings`, `covid_report`/`covid_reports`) and ship a real `.sql` schema export.
- Implement password hashing (`password_hash`/`password_verify`) and remove plain-text password comparisons.
- Build a working admin login (`admin_login.php`) that actually sets `$_SESSION['admin']`.
- Connect the patient registration flow to `user_credentials` so self-registered patients can log in.
- Build a real patient dashboard (view own test results/vaccine status, request a booking) to replace the current placeholder pages.
- Add CSRF tokens to all state-changing forms and consistently use prepared statements for all SQL queries.
- Add pagination and sorting to admin listing pages.
- Replace hardcoded database credentials with environment-variable-based configuration.
- Replace the static "Charts"/analytics page with real, database-driven reporting.
- Add automated tests (none currently exist).

---

# 32. QUICK START

```
1. Install XAMPP (Apache + MySQL + PHP)
2. Extract the project to htdocs/covid_webite
3. Start Apache and MySQL
4. Create a MySQL database named "covid_system"
5. Manually create the tables listed in Section 8 (no SQL file is included)
6. Open http://localhost/covid_webite/frontend/index.php in your browser
7. Register a hospital, approve it as needed (see Section 14 for current auth limitations), and explore
```

---

# 33. PROJECT URLS

| Purpose | URL (assuming default XAMPP setup) |
|---|---|
| Public site | `http://localhost/covid_webite/frontend/index.php` |
| Patient area (duplicate site) | `http://localhost/covid_webite/patient/index.php` |
| Hospital login | `http://localhost/covid_webite/frontend/login.php` |
| Hospital dashboard | `http://localhost/covid_webite/frontend/hospital/index.php` |
| Admin dashboard | `http://localhost/covid_webite/Backend/index.php` (login gate currently non-functional — see Section 14) |
| phpMyAdmin | `http://localhost/phpmyadmin` |
| GitHub repository | Not found in the uploaded project |

---

# 34. FINAL PROJECT SUMMARY

This project is a **PHP/MySQL COVID-19 management system** built around three roles — patients, hospitals, and administrators — using plain procedural PHP with `mysqli` and the free "SB Admin 2" Bootstrap dashboard template for the admin and hospital panels, alongside a separately-templated public marketing site.

**What is genuinely working:** the hospital registration-and-approval pipeline, the admin and hospital dashboards' live statistics, full vaccine-catalog CRUD, booking review/approval/edit/delete, hospital-side test-result and vaccination-status updates, the contact form, global admin search, and Excel report export are all backed by real, functioning SQL against a `covid_system` database.

**Important limitations:** the project is really **three separate, overlapping PHP codebases** (`frontend/`, `patient/`, `Backend/`) rather than one unified app, with duplicated logic and inconsistent table naming (singular vs. plural) between them. The **admin panel's login gate points at a page that does not exist**, and **no code path lets a self-registered patient actually log in**, since registration and login target different tables. There is **no schema/SQL export**, **no password hashing**, **no CSRF protection**, **no REST API**, and **no automated tests**. The patient-facing dashboard is a placeholder rather than a working feature.

In its current state, this is best described as a **partially functional prototype / academic project**, with a solid and largely working hospital+admin backend, but with authentication, patient self-service, and cross-module data consistency requiring further work before it could be considered production-ready.

---

# 35. FINAL PROJECT INFORMATION

```
PROJECT NAME:      Covido (covid_website)
PROJECT TYPE:      Multi-role Web Application
CATEGORY:          Healthcare / COVID-19 Test & Vaccination Management System
FRONTEND:          HTML, CSS, Bootstrap, JavaScript, jQuery, PHP (server-rendered)
BACKEND:           PHP (procedural, mysqli)
DATABASE:          MySQL ("covid_system") — no SQL export included
API:               Not found / not verified (no REST API)
AUTHENTICATION:    Partially implemented / broken for admin and patient self-registration flows
ARCHITECTURE:      Three parallel PHP project folders (frontend/, patient/, Backend/) sharing one MySQL database
ADMIN:             Implemented (SB Admin 2 template) — CRUD screens functional; login gate broken
USER/CUSTOMER:     Public site and contact form implemented; patient dashboard is a placeholder
INSTALLATION:      XAMPP/WAMP + manually created MySQL schema (see Section 8)
DEVELOPER:         Youza Ahsan
GITHUB:            https://github.com/youzaahsan/Covido-COVID-19-Management-System
```
