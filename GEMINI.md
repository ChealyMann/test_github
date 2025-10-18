
# GEMINI.md

## Project Overview

This is a Laravel 12 project that appears to be a Human Resources Management System. It includes features for managing departments, employees, and attendance. The project uses a MySQL database (inferred from the migrations) and Vite for frontend asset compilation with Tailwind CSS.

The application has the following key entities:
*   **Users:** For authentication and authorization.
*   **Departments:** To categorize employees.
*   **Positions:** To define roles within departments.
*   **Employees:** The main entity, with details like name, contact information, and department/position.
*   **Attendance Records:** To track employee attendance.
*   **Payrolls:** For managing employee salaries.
*   **Awards and Missions:** For employee recognition and tasks.

## Building and Running

### Prerequisites
*   PHP 8.2+
*   Composer
*   Node.js & npm
*   A database server (e.g., MySQL)

### Installation
1.  Clone the repository.
2.  Copy the `.env.example` file to `.env` and configure your database credentials.
3.  Run `composer install` to install PHP dependencies.
4.  Run `npm install` to install frontend dependencies.
5.  Run `php artisan key:generate` to generate an application key.
6.  Run `php artisan migrate` to create the database tables.
7.  (Optional) Run `php artisan db:seed` to seed the database with initial data.

### Development
To run the development server, you can use the following command:

```bash
composer run dev
```

This will concurrently start:
*   The PHP development server (`php artisan serve`)
*   The queue listener (`php artisan queue:listen`)
*   The log watcher (`php artisan pail`)
*   The Vite development server (`npm run dev`)

Alternatively, you can run these commands in separate terminals.

### Building for Production
To build the frontend assets for production, run:

```bash
npm run build
```

### Testing
To run the test suite, use the following command:

```bash
composer test
```

## Development Conventions

*   **Framework:** The project follows the standard Laravel 12 project structure and conventions.
*   **Styling:** Tailwind CSS is used for styling. Utility-first CSS is preferred.
*   **Frontend:** JavaScript and CSS are compiled using Vite. The main entry points are `resources/css/app.css` and `resources/js/app.js`.
*   **Database:** Database schema changes are managed through migrations.
*   **Routing:** Routes are defined in `routes/web.php` for web routes and `routes/api.php` for API routes.
*   **Testing:** PHPUnit is used for testing. Tests are located in the `tests` directory.
