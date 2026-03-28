# Store Management Web App

## Overview

This repository contains a PHP-based store management web application project.

The main application source is located under:

- `BENKHELIFA_FAROUK_G1_IGE46/`

## Project Structure

- `BENKHELIFA_FAROUK_G1_IGE46/app/` — application logic
- `BENKHELIFA_FAROUK_G1_IGE46/config/` — configuration files
- `BENKHELIFA_FAROUK_G1_IGE46/public/` — public entry/assets
- `BENKHELIFA_FAROUK_G1_IGE46/routes/` — route definitions
- `BENKHELIFA_FAROUK_G1_IGE46/README.md` — nested app setup guide

## Quick Start

1. Use XAMPP/WAMP/LAMP with PHP + MySQL.
2. Ensure this project is served from your web root.
3. Configure DB access in `BENKHELIFA_FAROUK_G1_IGE46/config/database.php`.
4. Open:
   - `http://localhost/BENKHELIFA_FAROUK_G1_IGE46/public/login`

## Notes

- A legacy `readme.docx` remains in the nested folder for archival purposes.
- Seeded users are now created with modern `password_hash` values.
- Authentication keeps backward compatibility with existing legacy MD5 records if present.

## Suggested Future Rename

For naming consistency, a cleaner repository name would be:

- `store-management-webapp`

## License

MIT License (see `LICENSE`).
