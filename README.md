# Post management system

## Description
This project is a **post management** API application built using **Laravel 12**. It allows users to perform **CRUD** operations (create, read, update, delete) on posts.

### Key Features:
- **CRUD Operations**: Create, read, update, and delete posts.
- **Form Requests**: Validation is handled by custom form request classes.
- **Service Layer**: Business logic is separated into service classes.
- **Authentication**: Secured using Laravel Sanctum.
- **API Documentaion**: Postman collection available for testing and documentation.

### Technologies Used:
- **Laravel 12**
- **PHP**
- **MySQL**
- **XAMPP** (for local development environment)
- **Composer** (PHP dependency manager)
- **Laravel Sanctum** (authentication)
- **Postman** (API testing and docs)

---

## Installation
To install this application you have to install composer in your machine. Then install laravel package globally using composer. After got composer and laravel installed in your machine you can follow the steps below to get this application installed properly.

### Prerequisites
Ensure you have the following installed on your machine:
- **XAMPP**: For running MySQL and Apache servers locally.
- **Composer**: For PHP dependency management.
- **PHP**: Required for running Laravel.
- **MySQL**: Database for the project

### Steps to Run the Project

1. Clone the Repository  
   ```bash
   git clone https://github.com/NevinRashid/Post_Management.git
2. Navigate to the Project Directory
   ```bash
   cd postTask
3. Install Dependencies
   ```bash
   composer install
4. Create Environment File
   ```bash
   cp .env.example .env
   Update the .env file with your database configuration (MySQL credentials, database name, etc.).
5. Generate Application Key
    ```bash
    php artisan key:generate
6. Run Migrations
    ```bash
    php artisan migrate
7. Run the Application
    ```bash
    php artisan serve

## API Documentation
You can find and test all API endpoints in the provided Postman collection.

### Postman Collection:
- 
