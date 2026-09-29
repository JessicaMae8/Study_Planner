# Study Planner

## Description

Study Planner is a Laravel-based web application designed to help students organize their subjects, study tasks, and study sessions. The system allows users to create, view, update, and delete study-related records.

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

An unsigned integer can still allow a value of zero. Therefore, all sample requests use a positive quantity. The positive-quantity rule will be applied through application validation in a later laboratory.

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