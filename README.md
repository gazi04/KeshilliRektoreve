# Rectors' Council Web Application

## Getting Started

Follow these steps to get your project up and running on your local machine.

### Prerequisites

Before you begin, ensure you have the following installed:

* **PHP:** Version 8.1 or higher is recommended.
* **Composer:** A dependency manager for PHP.
* **Node.js & npm (or Yarn):** For frontend asset compilation (if applicable).
* **A database system:** Such as MySQL, PostgreSQL, SQLite, etc. (MySQL is commonly used with Laravel).

### Installation

1.  **Clone the repository:**

    ```bash
    git clone [https://github.com/gazi04/KeshilliRektoreve.git](https://github.com/gazi04/KeshilliRektoreve.git)
    cd KeshilliRektoreve
    ```

2.  **Install Composer dependencies:**

    ```bash
    composer install
    ```

3.  **Create and configure the `.env` file:**

    Laravel uses an `.env` file to manage environment-specific configurations (like database credentials, API keys, etc.).

    * Copy the example environment file:

        ```bash
        cp .env.example .env
        ```

    * Open the newly created `.env` file in your text editor. You'll need to configure your database connection. Here's an example for MySQL:

        ```dotenv
        APP_NAME="Your Laravel Project"
        APP_ENV=local
        APP_KEY=
        APP_DEBUG=true
        APP_URL=http://localhost:8000

        LOG_CHANNEL=stack
        LOG_LEVEL=debug

        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=your_database_name # <--- CHANGE THIS
        DB_USERNAME=your_database_username # <--- CHANGE THIS
        DB_PASSWORD=your_database_password # <--- CHANGE THIS

        # Other configurations...
        ```
        **Make sure to change `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` to match your local database setup.**

4.  **Generate an application key:**

    This command generates a unique key for your application, which is stored in your `.env` file. This key is crucial for session and other encrypted data.

    ```bash
    php artisan key:generate
    ```

5.  **Run database migrations:**

    This command will create the necessary tables in your database based on your Laravel migrations.

    ```bash
    php artisan migrate
    ```

    *If you have seeders (dummy data) you want to run, you can do so after migrations:*

    ```bash
    php artisan db:seed
    ```

6.  **Install Node.js dependencies (if applicable, for frontend assets):**

    If your project includes frontend assets compiled with npm or Yarn, you'll need to run:

    ```bash
    npm install
    # OR
    yarn install
    ```

7.  **Compile frontend assets (if applicable):**

    After installing Node.js dependencies, compile your assets:

    ```bash
    npm run dev
    # OR
    yarn dev
    ```
    For production, you might use `npm run build` or `yarn build`.

### Running the Project

Once you've completed the installation steps, you can start the Laravel development server:

```bash
php artisan serve
# OR
composer run dev
```
