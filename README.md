# Study Planner

## Description

Study Planner is a Laravel-based web application designed to help students organize their subjects, study tasks, study sessions, and service requests.

The system allows users to create, view, update, and manage study-related records and service requests while applying authentication and authorization controls.

## Student Information

- Name: Jessica Mae Jamisal
- Course: BS Information Technology
- Year & Section: 4th Year - Block 3

## Technologies Used

- Laravel
- PHP
- MySQL
- XAMPP
- Composer
- Git
- GitHub

## Requirements

Before running the project, make sure the following are installed:

- PHP
- Composer
- XAMPP
- MySQL
- Git

## Database

Database Name:

```text
study_planner_db
```

The project uses MySQL through XAMPP.

The database name should be recorded in the project documentation, but database passwords and other sensitive credentials must not be shared or committed to the repository.

---

# Laboratory 2 - Plan and Implement the Request Data Model

## Request Data Model

Laboratory 2 adds a `requests` table to the existing Study Planner Laravel project.

The `requests` table stores information about requests submitted by users, including the requester, requested item or service, quantity, purpose, and request status.

## Requests Table Fields

| Field | Data Type | Constraint | Purpose |
|---|---|---|---|
| `id` | BIGINT | Primary Key, Auto Increment | Unique request number |
| `requester_name` | VARCHAR(100) | Required | Person submitting the request |
| `requester_email` | VARCHAR(255) | Required | Contact address |
| `item_name` | VARCHAR(150) | Required | Requested item or service |
| `quantity` | UNSIGNED INTEGER | Required | Requested quantity |
| `purpose` | TEXT | Required | Reason for the request |
| `status` | VARCHAR(20) | Default: `pending` | Request state |
| `created_at` | TIMESTAMP | Required | Creation time |
| `updated_at` | TIMESTAMP | Required | Update time |

## Quantity Rule

The `quantity` field uses an unsigned integer because a requested quantity must not be negative.

An unsigned integer can still allow a value of zero. Therefore, all sample requests use a positive quantity. The positive-quantity rule is applied through application validation.

## Status Rule

A new request begins with `pending` status because a newly submitted request has not yet been reviewed or processed.

The database uses `pending` as the default status when no status is provided during insertion.

One sample request was inserted without specifying the `status` field. The database automatically stored its status as `pending`, verifying that the default value works correctly.

## User Stories

### 1. Requester

**User Story:**

As a requester, I want to submit my name, email, requested item, quantity, and purpose so that my request can be recorded accurately.

**Acceptance Criteria:**

1. The request must store the requester's name, email, item name, quantity, and purpose.
2. The quantity must be greater than zero.

### 2. Staff Reviewer

**User Story:**

As a staff reviewer, I want each request to have a status so that I can identify the current state of a request.

**Acceptance Criteria:**

1. A new request must have a `pending` status when no status is provided.
2. The request must store the status together with the other request information.

### 3. Record Keeper

**User Story:**

As a record keeper, I want each request to have a unique ID and timestamps so that I can identify and track request records.

**Acceptance Criteria:**

1. Each request must have a unique `id`.
2. Each request must record `created_at` and `updated_at` timestamps.

## Migration

The request table migration was created using the following command:

```bash
php artisan make:migration create_requests_table
```

The migration creates the `requests` table with the required fields.

The migration can be reversed using its `down()` method, which drops the `requests` table if it exists.

## Run the Migration

To apply the migration, use:

```bash
php artisan migrate
```

To verify the migration status, use:

```bash
php artisan migrate:status
```

The `create_requests_table` migration should appear with a `Ran` status after the migration is successfully executed.

## Verify the Requests Table

The `requests` table can be inspected using phpMyAdmin or another MySQL client.

The project uses the existing MySQL database:

```text
study_planner_db
```

The table structure should contain the following fields:

```text
id
requester_name
requester_email
item_name
quantity
purpose
status
created_at
updated_at
```

## Sample Request Records

Three fictional sample requests were inserted into the `requests` table.

| ID | Requester Name | Item Name | Quantity | Status |
|---:|---|---|---:|---|
| 3 | Wren Santos | Study Planner Notebook | 2 | pending |
| 4 | Lorelyn Habal | USB Flash Drive | 1 | pending |
| 5 | Nainer Setnam | Printer Ink | 2 | pending |

All sample requests use positive quantities and have a purpose.

The first request omitted the `status` field during insertion. Its resulting `pending` status verifies the database default.

## SQL Query Used for Verification

The three request records can be displayed using:

```sql
SELECT id, requester_name, item_name, quantity, status FROM requests;
```

The query verifies the request ID, requester name, requested item, quantity, and current status.

## Verification Summary

The `requests` table was successfully created through a Laravel migration and verified using `php artisan migrate:status`.

The table structure was inspected using phpMyAdmin. Three fictional request records were inserted, and all records contain positive quantities and `pending` status.

The first record demonstrates that the database automatically applied the `pending` default when the status was omitted during insertion.

## Git

Before committing the changes, check the repository status using:

```bash
git status
```

Confirm that the `.env` file remains excluded by `.gitignore`.

Add the migration and README update using:

```bash
git add database/migrations README.md
```

Commit the changes using:

```bash
git commit -m "Add request data model and migration"
```

Push the commit to the same GitHub repository used for Laboratory 1.

The repository should contain the Laravel project, request migration, and updated README.

The actual `.env` file, passwords, tokens, and MySQL `.sql` exports must not be uploaded to GitHub.

---

# Laboratory 3 - Secure Request Access Through Reviewed Changes

## Authentication and Roles

The request system uses authenticated user sessions.

Three fictional accounts are used for testing:

| Account | Role | Purpose |
|---|---|---|
| Test User | Student | Student A |
| Student B | Student | Student B |
| Administrator | Admin | Administrator testing |

Passwords are not documented or committed to the repository.

The `users` table includes a `role` field with `student` as the default value.

## Request Ownership

Each service request is linked to its authenticated owner through the `user_id` field.

The `ServiceRequest` model uses the existing `requests` table.

Ownership is determined using the authenticated user's ID, not the requester name or email.

Existing Laboratory 2 request records were preserved and assigned to the appropriate fictional student accounts. Requests #3 and #5 belong to Test User (Student A), while Request #4 belongs to Student B.

## Access Control Rules

The following rules are enforced server-side:

- Guests cannot access request pages.
- Authenticated students can view only their own requests.
- Students cannot view another student's request.
- Students can create requests for themselves.
- Only administrators can view all requests.
- Only administrators can update request status.
- Students cannot change request ownership, role, or status through submitted request data.
- Request status is limited to `pending`, `approved`, or `rejected`.

Unauthorized request access uses HTTP `403 Forbidden`.

## Routes

| Method | Route | Access |
|---|---|---|
| GET | `/login` | Guest |
| POST | `/login` | Guest |
| POST | `/logout` | Authenticated |
| GET | `/requests` | Authenticated |
| GET | `/requests/create` | Students |
| POST | `/requests` | Students |
| GET | `/requests/{serviceRequest}` | Owner or Admin |
| PATCH | `/requests/{serviceRequest}/status` | Admin |

GET routes are used for reading request information.

POST is used for creating a new request.

PATCH is used only for updating request status.

## Authorization Policy

The `ServiceRequestPolicy` class controls access to service requests.

The following policy methods are implemented:

- `viewAny` allows authenticated users to access the request list.
- `view` allows an administrator or the request owner to view a specific request.
- `create` allows students to create requests.
- `updateStatus` allows administrators to update request status.

Authorization is enforced in the controller using Laravel Gate authorization before protected data is displayed or modified.

## Request Validation

Student request creation uses server-side validation.

The following fields are validated:

| Field | Validation |
|---|---|
| `item_name` | Required, string, maximum 150 characters |
| `quantity` | Required, integer, minimum 1 |
| `purpose` | Required, string, maximum 2000 characters |

Students are prohibited from submitting the following fields:

- `user_id`
- `status`
- `is_admin`
- `role`

The authenticated user's ID, name, and email are assigned server-side.

New requests are always assigned the `pending` status by the controller.

## Status Update Validation

Only administrators can update a request status.

The allowed status values are:

- `pending`
- `approved`
- `rejected`

Only the `status` field is updated.

Students cannot update request status because the controller authorizes the administrator-only `updateStatus` policy before performing the database update.

## CSRF Protection and Output Escaping

Forms that create requests, update request status, and log out include Laravel CSRF protection using @csrf.

The status update form uses:

@method('PATCH')

User-provided request information is displayed using Blade's escaped output syntax to prevent submitted HTML from being interpreted as page markup.

An HTML escaping test using <b>LAB3</b> displayed the text literally instead of rendering it as bold HTML.

## Security Test Summary

The following Laboratory 3 security tests were performed:

| Test | Result |
|---|---|
| T01 Guest access denial | Passed |
| T02 Student sees own requests only | Passed |
| T03 Student cannot view another student's request | Passed |
| T04 Student cannot update request status | Passed |
| T05 Administrator can view and update requests | Passed |
| T06 Invalid input is rejected | Passed |
| T07 Spoofed ownership/status/role fields are rejected | Passed |
| T08 HTML output is escaped | Passed |
| T09 CSRF token protection is enforced | Passed |
| T10 Invalid administrator status value is rejected | Passed |

The denied-write tests were also checked against the database to confirm that unauthorized or invalid requests did not create or modify records.

## Dependency and Security Checks

Composer and JavaScript dependencies should be checked for known security issues using:

```bash
- `composer audit` — No security vulnerability advisories found.
- `npm audit` — Could not be run because the project does not have an existing `package-lock.json` lockfile. No npm audit result was available.
```

## File Responsibilities

| File | Responsibility |
|---|---|
| `app/Models/ServiceRequest.php` | Maps the ServiceRequest model to the existing requests table and defines the ownership relationship |
| `app/Policies/ServiceRequestPolicy.php` | Defines authorization rules for viewing and updating requests |
| `app/Http/Controllers/AuthController.php` | Handles login and logout |
| `app/Http/Controllers/ServiceRequestController.php` | Handles request listing, creation, viewing, validation, and status updates |
| `resources/views/auth/login.blade.php` | Login form |
| `resources/views/service_requests/index.blade.php` | Request list |
| `resources/views/service_requests/create.blade.php` | Request creation form |
| `resources/views/service_requests/show.blade.php` | Request details and administrator status form |
| `routes/web.php` | Defines authentication and service request routes |

## Git and Pull Request

Laboratory 3 was developed on the following feature branch:

```text
feature/lab3-secure-requests
```
The reviewed implementation commit was:
```text
8c99952
```
Commit message:
```text
Secure request ownership and status access
```

The changes were pushed to GitHub and reviewed through Pull Request #1.

Pull Request:

https://github.com/JessicaMae8/Study_Planner/pull/1

The pull request was reviewed and approved by `roreryen`.

Branch protection was not configured for this repository. Peer approval through Pull Request #1 was used as the review control before merging into `main`.

GitHub Issue:

Issue #2 — Secure request ownership and status access:
https://github.com/JessicaMae8/Study_Planner/issues/2

The pull request was merged successfully into `main`.

Merge commit:

```text
f0733a7
```

## Laboratory 3 Verification

Verification instruction: Test administrator access and administrator-only status updates.


---

# Laboratory 4 - Containers and Reproducible Environments

## Overview

Laboratory 4 introduces a Docker-based environment for the existing Study Planner Laravel application. The environment separates the web server, Laravel application, and MySQL database into individual services.

Docker Compose manages the services, their network, startup dependencies, and persistent database storage. The original XAMPP database, `study_planner_db`, remains separate from the Docker database, `laravel_request_container_db`.

## Technologies Used

- Laravel 12
- PHP 8.3
- MySQL 8.4
- Nginx
- Docker
- Docker Compose
- Composer
- Node.js
- npm

## Docker Architecture

The environment contains three main services:

| Service | Technology | Responsibility |
|---|---|---|
| `web` | Nginx | Receives browser requests and serves the Laravel public directory |
| `app` | PHP-FPM | Runs the Laravel application |
| `db` | MySQL 8.4 | Stores users, service requests, and other application records |

The browser accesses the application at `http://127.0.0.1:8080`. Nginx forwards PHP requests to the `app` service over the internal Docker network. The Laravel application connects to MySQL using the hostname `db` and port `3306`.

## Docker Configuration Files

| File | Purpose |
|---|---|
| `Dockerfile` | Defines the multi-stage image build for dependencies, frontend assets, the Laravel application, and Nginx |
| `compose.yaml` | Defines the application, web server, database, network, persistent volume, and health check |
| `.dockerignore` | Excludes unnecessary files and sensitive local configuration from the Docker build context |
| `.env.container.example` | Provides an example of the environment variables required by the container environment |
| `docker/nginx/default.conf` | Configures Nginx to serve the Laravel application and forward PHP requests to PHP-FPM |

The actual `.env.container` file contains local configuration and secrets. It is excluded from Git and must not be uploaded to the repository.

## Environment Configuration

The Docker environment uses a separate database named `laravel_request_container_db`. The application connects to the database through the internal Docker network using `DB_HOST=db` and `DB_PORT=3306`.

The database uses a dedicated application account. Database credentials and the Laravel application key must be configured locally and must not be committed to GitHub or included in public documentation.

## Build and Start the Environment

Use the following commands from the project directory:

```bash
docker compose --env-file .env.container config --quiet
docker compose --env-file .env.container up -d --build
docker compose --env-file .env.container ps
```

The configuration check validates the Compose configuration. The second command builds the required images and starts the services. The final command displays the service status and published ports.

## Database Migrations

Run the Laravel migrations inside the application container:

```bash
docker compose --env-file .env.container exec app php artisan migrate
docker compose --env-file .env.container exec app php artisan migrate:status
```

The migrations create the required tables in the Docker database. The original XAMPP database is separate and should not be reset as part of this exercise.

## Application Verification

The application was accessed through `http://127.0.0.1:8080`. The redesigned login page was displayed, and a test student account successfully accessed the service request page.

A fictional request was created to test database persistence:

| Test Item | Recorded Value |
|---|---|
| Request reference | `CONTAINER-PERSIST-01` |
| Request owner | Test Student |
| Quantity | 1 |
| Status | pending |
| Purpose | Docker persistence testing |

The request remained available after the application container was recreated. It also remained available after the Docker Compose services were stopped and started again.

## Persistence

The Compose configuration defines a named volume, `db_data`, for MySQL data storage. This volume allows database records to remain available when containers are replaced or the services are restarted.

The persistence checks used the following commands:

```bash
docker compose --env-file .env.container up -d
docker compose --env-file .env.container ps
```

The test request was checked again after restarting the services. The database volume must not be removed during normal restart and persistence testing.

## Security Verification

The following checks were performed:

- The application container runs as the non-root `www-data` user.
- The MySQL service is accessible to other services on the internal Docker network and is not published directly to the host.
- The web service is bound to `127.0.0.1:8080`.
- The actual `.env.container` file is excluded from Git.
- The Nginx image receives the Laravel public directory rather than the entire application source.
- The Docker database uses a separate database name and dedicated application account.

The following command verifies the application container's runtime user:

```bash
docker compose --env-file .env.container exec app id
```

The following command checks whether the local environment file is ignored by Git:

```bash
git check-ignore -v .env.container
```

## GitHub Review and Collaboration

The Docker environment was developed on the feature branch `feature/lab4-containers` and submitted through Pull Request #3.

- Repository: https://github.com/JessicaMae8/Study_Planner
- Pull Request: https://github.com/JessicaMae8/Study_Planner/pull/3
- Feature commit: `74a7636`
- Merge commit: `47a2bd9`

The pull request was approved by the reviewer and merged into `main`.

## Verification Summary

The Docker Compose environment was built and started successfully. The web, application, and database services ran as separate containers, and the MySQL service reported a healthy status. The Laravel migrations were applied to the Docker database, login and request creation were tested, and the test request remained available after application container recreation and a full service restart.

The environment also uses a named database volume, an internal service network, local-only web port publishing, and a Git-ignored local environment file.
