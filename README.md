<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Task Management API

This project is a **Task Management API** developed using Laravel 12. It provides endpoints to manage tasks efficiently, following RESTful principles and utilizing repositories, services, interfaces, and resources.

## Features
- Create, update, delete, and list tasks.
- Filter tasks by status, priority, and date range.
- Soft delete functionality.
- Pagination support.

## Installation

1. **Clone the repository:**
   ```sh
   git clone https://github.com/brhmsn80/task-management-api.git
   cd task-management-api
   ```

2. **Install dependencies:**
   ```sh
   composer install
   ```

3. **Set up environment file:**
   ```sh
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure your database in the `.env` file and run migrations:**
   ```sh
   php artisan migrate
   ```

5. **Run the application:**
   ```sh
   php artisan serve
   ```

## API Endpoints

| Method   | Endpoint             | Description                          |
|----------|----------------------|--------------------------------------|
| **GET**  | `/api/tasks`         | List all tasks with filtering & pagination |
| **POST** | `/api/tasks`         | Create a new task                   |
| **PUT**  | `/api/tasks/{task}`  | Update an existing task             |
| **DELETE** | `/api/tasks/{task}` | Delete a task                       |

## Request Validation
- `title`: Required, unique, max 255 characters.
- `description`: Optional.
- `status`: Must be one of (`pending`, `in_progress`, `completed`).
- `priority`: Must be one of (`low`, `medium`, `high`).
- `due_date`: Must be a future date.
- `user_id`: Must exist in the `users` table.

## Technologies Used
- **Laravel 12** (Framework)
- **MySQL** (Database)
- **PHP 8+** (Programming Language)
- **Postman** (API Testing)
