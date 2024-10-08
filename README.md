# Laravel Task Management System

A Laravel Task Management System is a web application that helps users organize and track their tasks efficiently for better productivity and workflow management.

## Table of Contents
- [Getting Started](#getting-started)
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Environment Variables](#environment-variables)
- [Running Migrations and Seeders](#running-migrations-and-seeders)
- [Usage](#usage)


Follow the instructions below to set up and run the project locally.

### Prerequisites
- PHP >= 8.1
- Composer
- MySQL or any other database
- Laravel >= 9
- Node.js and npm (if using frontend assets)

### Installation

1. **Clone the repository:**
   ```bash
   git clone https://github.com/mihir1313/task-management-system.git
   cd task-management-system
   

2. **Install Composer:**
   ```bash
    composer install
   
3. **Install laravel/sanctum:**
   ```bash
   composer require laravel/sanctum
4. **Copy the .env.example to create your own .env file:**
     ```bash
    cp .env.example .env
5. **Configure the .env file: Update the following lines in the .env file to match your local setup:**
     ```bash
    APP_NAME="Todo API"
    APP_URL=http://localhost:8000

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=task_metromindz
    DB_USERNAME=root
    DB_PASSWORD=
6. **Generate the application key:**
     ```bash
    php artisan key:generate
7. **Run migrations:**
    ```bash
    php artisan migrate
8. **Seed the database:**
     ```bash
    php artisan db:seed
9.**Serve the application:**
   ```bash
    php artisan serve

