# **Doc Fav Tech Test**

A PHP application following **Domain-Driven Design (DDD)** and **Clean Architecture** principles.  
The goal of this project is to demonstrate **good software design practices** while implementing **user registration and
management** using **Doctrine ORM**, **Value Objects**, **Repositories**, and **Use Cases**.

## **Links**

- [GitHub](#)

## **Table of Contents**

- [Installation](#installation)
- [General Description](#general-description)
    - [Requirements](#requirements)
    - [Util commands](#util-commands)

---

## **Installation**

1. Clone the repository

    ```sh
    git clone https://github.com/davichano/docfavtest.git
    cd docfavtest
    ```

2. Install dependencies:

    ```sh
    composer install
    ```      
3. Set up environment variables by copying .env.example:

    ```sh
    cp .env.example .env
    ```  
4. Sync the database:

    ```sh
    php cli-config.php orm:schema-tool:create
    ```

## **General Description**

This application is built to **manage user registration and authentication** while ensuring a **clean and maintainable
codebase** using **best practices in software architecture**.

Key features include:

- **Domain-Driven Design (DDD)**: The project is structured into **Domain, Application, Infrastructure, and Presentation
  layers**.
- **Use of Value Objects**: Important fields such as `UserId`, `Email`, `Name`, and `Password` are encapsulated as Value
  Objects to ensure consistency and immutability.
- **Doctrine ORM for Persistence**: The application uses **Doctrine ORM** to handle database operations, following the *
  *Repository Pattern**.
- **Separation of Concerns**: The business logic is decoupled from the infrastructure using **Ports & Adapters (
  Hexagonal Architecture)**.
- **Event-Driven Architecture**: A domain event (`UserRegisteredEvent`) is triggered when a user is successfully
  registered.
- **Automated Testing**: The application includes **unit tests** for Value Objects, Entities, and Use Cases, as well as
  **integration tests** for the database.
- **Docker Support**: The project can be set up using **Docker** for easier deployment.

---

### **Requirements**

To run this project, you need:

✅ **PHP 8.3** (Recommended)  
✅ **Composer** (Dependency manager for PHP)  
✅ **MySQL** (Database engine used with Doctrine ORM)  
✅ **Doctrine ORM** (Object-Relational Mapper for PHP)  
✅ **PHPUnit** (Testing framework)  
✅ **Docker** (Optional, for containerized development)

---

### **Util Commands**

💡 **Doctrine ORM Commands:**

- `php cli-config.php orm:info` → Show registered entities.
- `php cli-config.php orm:schema-tool:create` → Create the database schema.
- `php cli-config.php orm:schema-tool:update --force` → Update the database schema without losing data.

💡 **Doctrine Migrations Commands (If used instead of `schema-tool`):**

- `php cli-config.php migrations:diff` → Generate a new migration based on changes in entities.
- `php cli-config.php migrations:migrate` → Apply all pending migrations to the database.
- `php cli-config.php migrations:status` → Show the status of migrations.

💡 **Testing and Code Quality:**

- `./vendor/bin/phpunit` → Run unit and integration tests.
- `./vendor/bin/phpstan analyse` → Run static code analysis.
- `./vendor/bin/php-cs-fixer fix` → Automatically format the code to follow PSR standards.

---

### **🎯 Next Steps**

- Implement the **RegisterUserUseCase** following Clean Architecture.
- Create a **REST API Controller** to handle user registration requests.
- Deploy the application using **Docker**.

🚀 **This project is a technical demonstration of Clean Architecture and DDD in PHP.** 🚀
