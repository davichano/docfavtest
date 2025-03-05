# Doc Fav Tech Test

A simple PHP web application following **Domain-Driven Design (DDD)** and **Clean Architecture**.  
This project implements a **REST API** using **PHP 8.3**, **Doctrine ORM**, **Symfony Event Dispatcher**, and **Monolog
** for logging.

## Links

- [GitHub Repository](https://github.com/davichano/docfavtest)

## Table of Contents
- [Installation](#installation)
- [General Description](#general-description)
    - [Requirements](#requirements)
  - [Util Commands](#util-commands)

---

## Installation

1. Clone the repository:
   ```sh
   git clone https://github.com/davichano/docfavtest
   cd docfavtest
   ```

2. Install dependencies:
   ```sh
   composer install
   ```

3. Configure environment variables:
   Create a `.env` file with the following content:
   ```env
   DB_NAME=docfav
   DB_USER=root
   DB_PASSWORD=
   DB_HOST=127.0.0.1
   DB_DRIVER=pdo_mysql
   APP_ENV=dev
   ```

4. Run database migrations:
   ```sh
    php cli-config.php orm:schema-tool:create  
   ```

5. Start the built-in PHP server:
   ```sh
   php -S localhost:8000 -t public/
   ```

6. The API is now accessible at:
   ```
   http://localhost:8000
   ```

---

## General Description

This is a REST API for user registration, implementing:

- **Domain-Driven Design (DDD)**
- **Clean Architecture**
- **Doctrine ORM** for database abstraction
- **Event-Driven Programming** with Symfony Event Dispatcher
- **Logging** with Monolog
- **Unit and Integration Tests** with PHPUnit

### **Requirements**

- PHP 8.3
- Composer
- MySQL
- Doctrine ORM

---

## Util Commands

- **Show registered entities:**
  ```sh
  php cli-config.php orm:info
  ```

- **Create database schema:**
  ```sh
  php cli-config.php orm:schema-tool:create
  ```

- **Update database schema without losing data:**
  ```sh
  php cli-config.php orm:schema-tool:update --force
  ```

- **Run unit tests:**
  ```sh
  ./vendor/bin/phpunit
  ```

---

## Logs and Debugging

- The application logs are stored in:
  ```sh
  logs/app.log
  ```
- Log levels:
    - `DEBUG` for development
    - `INFO` for user events

---

### Future Improvements

- Implement authentication and token-based access
- Expand API functionality (update and delete users)
- Docker support for easier deployment

---
