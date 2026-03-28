# Store Management App (Nested Project)

This folder contains the actual PHP application source.

## Structure

- `app/` — MVC-like application code (`Controllers`, `Models`, `Views`)
- `config/` — database/bootstrap configuration
- `routes/` — route dispatching (`web.php`)
- `public/` — web entrypoint (`index.php`) and static assets

## Local Run (XAMPP/WAMP/LAMP)

1. Place the project so that `public/` is served by your web server.
2. Ensure PHP and MySQL are running.
3. Open `config/database.php` and confirm DB credentials.
4. Visit:
   - `http://localhost/BENKHELIFA_FAROUK_G1_IGE46/public/login`

## Default Seeded Accounts

On first run, the app seeds default users (including `admin`) using secure `password_hash` values.

> ⚠️ This project includes educational/demo seed data. Authentication also supports legacy MD5 records for backward compatibility when migrating older databases.

## Notes

- The older `readme.docx` remains for archival/reference.
- Prefer this Markdown file for collaboration and versioned documentation.
