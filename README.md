# Portfolio Project - Resume & Technology Learning Platform

(Это черновое описание, будет изменено позже)

## Table of Contents
1. [Technologies Used](#technologies-used)
2. [Installation Instructions](#installation-instructions)

## Technologies Used

### Backend:
- **PHP 8.4** – The latest stable version of PHP, providing modern features and improved performance.
- **Laravel 11** – A robust and scalable PHP framework, utilizing Inertia.js for a seamless full-stack experience.
- **PostgreSQL 17** – Powerful, open-source relational database system with advanced features.
- **MongoDB 6** – A document-oriented database designed for flexible data structures and high performance.
- **Redis 7** – High-performance in-memory data store for caching and session management.

### Frontend:
- **Vue 3** – Progressive JavaScript framework for building dynamic user interfaces.
- **Inertia.js** – Framework for building single-page apps using classic server-side routing and controllers.

### Development Tools:
- **Laravel Telescope** – Debugging and introspection tool for Laravel applications.
- **Xdebug** – A powerful debugging tool for PHP, enabling breakpoints, call stack analysis, and performance profiling.

## Installation Instructions

### 1. **Set environments**
- fill in the .env file

### 2. **Docker Compose Setup**

- **docker compose up --build** – To get the project running with Docker.

### 3. **Inside the Docker Container**

- **docker exec -it (project_name)_php bash**

### 4. **Run the Laravel Commands**
- **php artisan migrate** – Run the migrations to set up your database schema.
- **php artisan storage:link** – Create a symbolic link for public storage.
- **php artisan db:seed** – Populate the database with initial data using the seeders.
 
