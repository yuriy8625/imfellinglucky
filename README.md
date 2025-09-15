# imfeelinglucky — Run Guide

This document describes how to run the application using Docker Compose and the `Makefile`.

## Requirements

- Docker and Docker Compose
- GNU Make
- Open ports on host: `APP_PORT` (defaults to 80)

The application service runs in a container named `app-test-task` (see `docker-compose.yml`).

## Quick Start
Run full initialization (build containers, install dependencies, generate key, run migrations, seed database):
```bash
make init
```

After completion, the app will be available at:
- http://localhost (or http://localhost:<APP_PORT> if you changed the port in `.env` via `APP_PORT`)

## Makefile Commands

The following targets are defined in the `Makefile`:

- `init`
  - Description: full project initialization.
  - Actions: copies `.env.example` to `.env` (if missing), brings up containers with `--build`, waits for DB readiness, then runs:
    - `composer install`
    - `php artisan key:generate`
    - `php artisan migrate`
    - `php artisan db:seed`
    - `php artisan optimize:clear`
  - Command:
    ```bash
    make init
    ```

- `up`
  - Description: start containers in detached mode (without full initialization).
  - Command:
    ```bash
    make up
    ```

- `down`
  - Description: stop and remove containers (database data persists in the volume).
  - Command:
    ```bash
    make down
    ```

- `rebuild`
  - Description: rebuild images and start containers.
  - Command:
    ```bash
    make rebuild
    ```

- `shell`
  - Description: open a shell inside the application container `app-test-task`.
  - Command:
    ```bash
    make shell
    ```
