<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['modify_view'])) {
    // Include database configuration
    require_once 'config.php';

    try {
        $pdo = getDBConnection();

        $table_name = trim($_POST['table_name']);
        $columns = trim($_POST['columns']);

        // Validation
        if (empty($table_name) || empty($columns)) {
            throw new Exception("All fields are required!");
        }

        // Validate table name (only letters, numbers, and underscores)
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $table_name)) {
            throw new Exception("Invalid table name! Use only letters, numbers, and underscores.");
        }

        // Validate columns
        $allowed_columns = ['subscriber_name', 'action_performed', 'date_added', 'id'];
        $column_array = array_map('trim', explode(',', $columns));
        
        foreach ($column_array as $col) {
            if (!in_array($col, $allowed_columns)) {
                throw new Exception("Invalid column: $col. Allowed columns: " . implode(', ', $allowed_columns));
            }
        }

        // Create or replace view
        $columns_sql = implode(', ', $column_array);
        $sql = "CREATE OR REPLACE VIEW {$table_name}_view AS SELECT {$columns_sql} FROM audit_subscribers";
        
        $pdo->exec($sql);

        $_SESSION['view_result'] = "View '{$table_name}_view' has been successfully created/updated!";
        
    } catch (Exception $e) {
        $_SESSION['view_error'] = $e->getMessage();
    }
}

// Redirect back to index
header("Location: index.php");
exit();
?>
