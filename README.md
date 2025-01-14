# Portfolio Project - Resume & Technology Learning Platform

(Это черновое описание, будет изменено позже)

## Technologies Used

### Backend:
- **PHP 8.4** – The latest stable version of PHP, providing modern features and improved performance.
- **Laravel 11** – A robust and scalable PHP framework, utilizing Inertia.js for a seamless full-stack experience.
- **PostgreSQL 17** – Powerful, open-source relational database system with advanced features.
- **Redis 7** – High-performance in-memory data store for caching and session management.

### Frontend:
- **Vue 3** – Progressive JavaScript framework for building dynamic user interfaces.
- **Inertia.js** – Framework for building single-page apps using classic server-side routing and controllers.

### Development Tools:
- **Laravel Telescope** – Debugging and introspection tool for Laravel applications.

## Installation Instructions

### 1. **Docker Compose Setup**

To get the project running with Docker, use the following command to build and start the containers:

docker compose up --build

### 2. **Inside the Docker Container**

docker exec -it (project_name)_php bash

### 3. **Run the Laravel Commands**
- **php artisan migrate** – Run the migrations to set up your database schema.
- **php artisan storage:link** – Create a symbolic link for public storage.
- **php artisan db:seed** – Populate the database with initial data using the seeders.
 
