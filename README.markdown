# 🐘📊 PHP MySQL ViewManager Script ⚙️
_A PHP script for dynamically creating or updating MySQL database views based on user-submitted table names and columns from the `audit_subscribers` table, using PDO for secure connections._

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![PHP](https://img.shields.io/badge/PHP-%3E%3D7.4-777BB4.svg?logo=php)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1.svg?logo=mysql)](https://www.mysql.com/)
[![PDO](https://img.shields.io/badge/PDO-PHP%20Data%20Objects-8892BF.svg)]() <!-- Generic PDO badge -->

## 📋 Table of Contents
1.  [Overview](#-overview)
2.  [Key Features](#-key-features)
3.  [System & Database Requirements](#-system--database-requirements)
4.  [Setup and Configuration](#️-setup-and-configuration)
5.  [Usage (Form Submission)](#️-usage-form-submission)
6.  [File Structure](#-file-structure)
7.  [Important Notes & Security Considerations](#-important-notes--security-considerations)
8.  [Contributing](#-contributing)
9.  [License](#-license)
10. [Contact](#-contact)

## 📄 Overview

The **PHP MySQL ViewManager Script**, developed by Adrian Lesniak, is a server-side PHP script designed to dynamically create or replace views in a MySQL database. It processes HTTP POST requests, typically from an HTML form, to generate these views. Users can specify a target view name and a comma-separated list of columns from a predefined source table (e.g., `audit_subscribers`). The script automatically generates aliases for the selected columns to prevent naming conflicts in the new view. It utilizes **PHP Data Objects (PDO)** for secure database connections and incorporates robust error handling, providing user-friendly feedback for successful operations or any issues encountered.

## ✨ Key Features

*   ➕ **Dynamic View Creation/Modification**:
    *   Generates `CREATE OR REPLACE VIEW` SQL statements based on user input.
    *   Allows users to define the name of the view and select specific columns from the source table (`audit_subscribers`).
*   🏷️ **Automatic Column Aliasing**:
    *   Intelligently creates aliases for the selected columns in the view definition (e.g., `original_column_name AS alias_column_name`) to avoid potential naming conflicts or to provide more descriptive names in the view.
*   🛡️ **Secure Database Access with PDO**:
    *   Uses PHP Data Objects (PDO) for database interaction, which supports prepared statements (though not explicitly used for DDL here, PDO itself promotes safer practices).
    *   Configures PDO error mode to `PDO::ERRMODE_EXCEPTION` for robust error handling and easier debugging.
*   ✔️ **Input Validation**:
    *   Checks for the presence of required form fields (`table_name` for the view name, and `columns` for the list of columns).
*   💬 **User Feedback & Error Handling**:
    *   Provides clear success messages in Polish (e.g., "Widok został pomyślnie zaktualizowany.") upon successful view creation/update.
    *   Outputs user-friendly error messages for issues such as missing input fields or database connection/query failures.
*   ⚙️ **POST Request Processing**:
    *   Specifically designed to handle data submitted via the HTTP `POST` method, typically from an HTML form with an action targeting this script.

## 🛠️ System & Database Requirements

### Server-Side:
*   **PHP Version**: 7.4 or higher.
*   **Web Server**: Any web server capable of executing PHP scripts (e.g., Apache with `mod_php`, Nginx with PHP-FPM, or PHP's built-in development server).
*   **PHP Extensions**:
    *   **PDO (PHP Data Objects)** extension must be enabled.
    *   **PDO MySQL driver** (`pdo_mysql`) must be enabled for connecting to MySQL databases.
*   **MySQL Database Server**:
    *   A running MySQL database instance.
    *   The script is configured to connect to a database named `test`.
    *   The source table (e.g., `audit_subscribers`) must exist within the `test` database and contain the columns that users will select for the view.
*   **Database Credentials**:
    *   Host: `localhost` (configurable in the script)
    *   Database Name: `test` (configurable in the script)
    *   Username: `root` (configurable in the script)
    *   Password: `haslo` ( **MUST be replaced with your actual MySQL root password or a dedicated user's password in the script**).
*   **Write Permissions**: The web server user (e.g., `www-data`, `apache`) must have appropriate permissions to `CREATE VIEW` and `REPLACE VIEW` on the specified database.

### Client-Side (for submitting data to this script):
*   **Web Browser**: Any standard web browser to submit the HTML form.
*   **HTML Form**: An HTML page with a form that POSTs data to this PHP script.

## ⚙️ Setup and Configuration

1.  **Clone or Download the Script**:
    ```bash
    git clone <repository-url>
    cd <repository-directory>
    ```
    *(Replace `<repository-url>` and `<repository-directory>` if applicable, or simply download/create `script.php` in your project folder).*

2.  **Configure MySQL Database**:
    *   Ensure your MySQL server is running.
    *   Create a database named `test` if it doesn't already exist:
        ```sql
        CREATE DATABASE IF NOT EXISTS test;
        USE test;
        ```
    *   Ensure the source table (e.g., `audit_subscribers`) exists within the `test` database and is populated with relevant columns. Example:
        ```sql
        CREATE TABLE IF NOT EXISTS audit_subscribers (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT,
            email VARCHAR(255),
            action_type VARCHAR(50),
            action_timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            details TEXT
            -- Add other columns as needed
        );
        ```

3.  **Update Database Credentials in `script.php`**:
    *   Open `script.php` (or your named PHP file).
    *   Locate the database connection parameters, especially the `$password` variable.
    *   **Crucially, change `$password = 'haslo';` to your actual MySQL root password or the password for a dedicated database user.**
        ```php
        $host = 'localhost';
        $db   = 'test';
        $user = 'root';
        $password = 'YOUR_ACTUAL_MYSQL_PASSWORD'; // <--- UPDATE THIS
        $charset = 'utf8mb4';
        ```

4.  **Deploy to Web Server**:
    *   Place `script.php` in a directory accessible by your PHP-enabled web server (e.g., `htdocs/your_project/` for XAMPP, or `/var/www/html/your_project/` for a typical Linux Apache setup).
    *   Ensure the web server has PHP and the MySQL PDO extension enabled.

5.  **Create an HTML Form (Client-Side)**:
    Create an `index.html` or `form.php` page that will submit data to `script.php`. See the "Usage (Form Submission)" section for an example form structure.

## 💡 Usage (Form Submission)

This PHP script is designed to be the target of an HTML form submission using the `POST` method.

1.  **Create an HTML Form**:
    You need an HTML form that sends data to this script. Place this in a file like `index.html` or `form.php` in your web server directory.
    **Example HTML Form (`index.html`):**
    ```html
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Create/Update Database View</title>
    </head>
    <body>
        <h2>Database View Manager</h2>
        <form method="POST" action="script.php">  <!-- Ensure 'script.php' is the correct path -->
            <p>
                <label for="table_name">View Name:</label><br>
                <input type="text" id="table_name" name="table_name" placeholder="e.g., my_custom_view" required>
            </p>
            <p>
                <label for="columns">Columns from 'audit_subscribers' (comma-separated, e.g., user_id, email, action_type):</label><br>
                <input type="text" id="columns" name="columns" placeholder="e.g., user_id, email, action_type" required style="width: 400px;">
            </p>
            <p>
                <input type="submit" name="modify_view" value="Create or Update View">
            </p>
        </form>
    </body>
    </html>
    ```

2.  **Access the Form and Submit**:
    *   Open the HTML form page (e.g., `http://localhost/your_project/index.html`) in your web browser.
    *   Fill in the "View Name" field with the desired name for your new or existing view.
    *   In the "Columns" field, enter a comma-separated list of column names from the `audit_subscribers` table that you want to include in the view (e.g., `user_id, email, action_timestamp`).
    *   Click the "Create or Update View" button.

3.  **Script Execution & Output**:
    *   The browser will send a POST request to `script.php`.
    *   The script will attempt to connect to the MySQL database, validate the inputs, and execute the `CREATE OR REPLACE VIEW` SQL statement.
    *   **On Success**: The script will output a success message in Polish: `"Widok został pomyślnie zaktualizowany."` (The view has been successfully updated.)
    *   **On Failure**: It will output an error message indicating the issue (e.g., "Błąd: Nazwa tabeli i kolumny są wymagane." for missing fields, or a database error message if the SQL execution fails).

## 🗂️ File Structure

*   `script.php` (or your chosen name, e.g., `view_manager.php`): The main PHP script containing the logic for database connection, input validation, SQL generation, and view creation/replacement.
*   `index.html` (or `form.php` - **Not part of this script, but required to use it**): The HTML page containing the form that POSTs data to `script.php`.
*   `README.md`: This documentation file.

## 📝 Important Notes & Security Considerations

*   **Source Table**: The script is hardcoded to create views based on the `audit_subscribers` table within the `test` database. Adjust these names in the script if your setup differs.
*   **Password Security**: **The `$password` variable containing the MySQL password should NEVER be hardcoded directly in a script in a production environment.** Use environment variables, a secure configuration file outside the webroot, or a secrets management system. For local development, it's a common shortcut, but be aware of the risk.
*   **Input Sanitization & SQL Injection**: While PDO helps prevent SQL injection for *data values* in prepared statements, constructing DDL statements (like `CREATE VIEW`) dynamically with user input for table and column names can still be risky if not handled carefully.
    *   The current script appears to directly use user-provided column names in the SQL query. **It's crucial to validate and sanitize these column names strictly against a known list of allowed columns from `audit_subscribers` or use a robust whitelisting approach to prevent SQL injection through malicious column names.**
    *   Similarly, the view name (`table_name`) should also be sanitized (e.g., allow only alphanumeric characters and underscores).
*   **Error Reporting**: In a production environment, detailed database error messages should not be exposed directly to the user. They should be logged, and a generic error message shown to the user.
*   **`add_user` Placeholder**: The script includes a commented-out section for an `add_user` action. This is not implemented and is separate from the view management functionality.
*   **Column Input Format**: The "Columns" input expects a comma-separated list, potentially with spaces (e.g., "column1, column2, column3"). The script needs to correctly parse this string.
*   **Database Permissions**: The MySQL user specified in the PDO connection (`root` by default) must have the necessary privileges (`CREATE VIEW`, `DROP VIEW` if `REPLACE` implies a drop, `SELECT` on `audit_subscribers`) on the `test` database.

## 🤝 Contributing

Contributions to the **PHP MySQL ViewManager Script** are welcome, especially for:

*   Implementing robust input sanitization and validation for view names and column names to prevent SQL injection.
*   Improving error handling and user feedback.
*   Making database connection parameters and source table names configurable (e.g., via a separate config file).
*   Adding functionality to list existing views or view definitions.
*   Developing the placeholder `add_user` functionality if desired as part of a broader admin tool.

1.  Fork the repository.
2.  Create a new branch for your feature (`git checkout -b feature/SecureViewCreation`).
3.  Make your changes to `script.php`.
4.  Commit your changes (`git commit -m 'Security: Add column name whitelisting'`).
5.  Push to the branch (`git push origin feature/SecureViewCreation`).
6.  Open a Pull Request.

## 📃 License

This project is licensed under the **MIT License**.
(If you have a `LICENSE` file in your repository, refer to it: `See the LICENSE file for details.`)

## 📧 Contact

PHP script concept by **Adrian Lesniak**.
For questions, feedback, or to report issues, please open an issue on the GitHub repository or contact the repository owner.

---
🔧 _Dynamically managing your MySQL views with PHP and PDO._
