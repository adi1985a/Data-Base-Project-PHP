# Database View Manager

## Overview
Database View Manager is a PHP script that creates or updates MySQL database views based on user input. It processes POST requests to generate views from the `audit_subscribers` table, using selected columns with aliases. Built with PDO for secure database connections and robust error handling.

## Features
- **View Creation/Modification**: Creates or replaces MySQL views with user-specified table names and columns.
- **Column Aliasing**: Automatically generates aliases for selected columns to avoid conflicts.
- **Secure Database Access**: Uses PDO with error mode set to exceptions for safe MySQL connections.
- **Input Validation**: Checks for required form fields (table name and columns).
- **Error Handling**: Provides user-friendly error messages for database or input issues.

## Requirements
- PHP 7.4 or higher
- MySQL database with the `audit_subscribers` table
- PDO MySQL extension enabled
- Database credentials:
  - Host: `localhost`
  - Database: `test`
  - Username: `root`
  - Password: `haslo` (replace with your actual password)

## Setup
1. Clone the repository:
   ```bash
   git clone <repository-url>
   cd <repository-directory>
   ```
2. Configure the MySQL database:
   - Create a database named `test`.
   - Ensure the `audit_subscribers` table exists with relevant columns.
   - Update the `$password` variable in the script with your MySQL root password.
3. Place the script in a web server directory (e.g., Apache or Nginx document root).
4. Ensure the web server has PHP and MySQL PDO support enabled.
5. Access the script via a web browser or POST request (e.g., through a form).

## Usage
1. **Form Submission**:
   - Create an HTML form with:
     - `table_name`: Name of the view to create or replace.
     - `columns`: Comma-separated list of column names from `audit_subscribers`.
     - `modify_view`: Submit button identifier.
   - Example form:
     ```html
     <form method="POST" action="script.php">
         <input type="text" name="table_name" placeholder="View name">
         <input type="text" name="columns" placeholder="column1, column2">
         <input type="submit" name="modify_view" value="Create View">
     </form>
     ```
2. **Script Execution**:
   - Submit the form via POST to trigger the `modify_view` action.
   - The script connects to the `test` database, validates inputs, and creates/replaces the view.
   - Success or error messages are returned as text output.
3. **Output**:
   - On success: "Widok został pomyślnie zaktualizowany."
   - On failure: Error message (e.g., missing fields or database errors).

## File Structure
- `script.php`: Main PHP script for handling view creation and database interaction.
- `README.md`: This file, providing project documentation.

## Notes
- The script assumes the `audit_subscribers` table exists in the `test` database; adjust the table name or schema as needed.
- The `$password` variable should be secured (e.g., use environment variables or a configuration file) in production.
- The script includes a placeholder for adding users (`add_user`), which is not implemented.
- Column names in the `columns` input should match those in `audit_subscribers` and be comma-separated with spaces (e.g., "column1, column2").
- Ensure the web server user has write permissions for the database.

## Contributing
Contributions are welcome! To contribute:
1. Fork the repository.
2. Create a new branch (`git checkout -b feature-branch`).
3. Make changes and commit (`git commit -m "Add feature"`).
4. Push to the branch (`git push origin feature-branch`).
5. Open a pull request.

## License
This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Contact
For questions or feedback, open an issue on GitHub or contact the repository owner.