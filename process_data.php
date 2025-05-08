<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host = 'localhost';
    $dbname = 'test';
    $username = 'root';
    $password = 'haslo';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (isset($_POST['add_user'])) {
            // Kod dla dodawania użytkownika (bez zmian)
        } elseif (isset($_POST['modify_view'])) {
            $table_name = isset($_POST['table_name']) ? $_POST['table_name'] : '';
            $columns = isset($_POST['columns']) ? $_POST['columns'] : '';

            if (!empty($table_name) && !empty($columns)) {
                $result = createViewSQL($pdo, $table_name, $columns);
                echo $result;
            } else {
                echo "Proszę uzupełnić wszystkie pola formularza.";
            }
        }
    } catch (PDOException $e) {
        echo "Błąd: " . $e->getMessage();
    }
}

function createViewSQL($pdo, $table_name, $columns) {
    try {
        // Zamieniamy przekazane kolumny na tablicę
        $selected_columns = explode(', ', $columns);

        // Tworzymy aliasy dla kolumn, aby uniknąć konfliktów
        $column_aliases = array_map(function ($column) {
            return "`$column` AS `col$column`";
        }, $selected_columns);

        // Łączymy aliasy kolumn w zapytanie SQL
        $select_clause = implode(', ', $column_aliases);

        // Tworzymy dynamiczne zapytanie SQL
        $sql = "CREATE OR REPLACE VIEW $table_name AS SELECT $select_clause FROM audit_subscribers";

        // Wykonujemy zapytanie SQL
        $pdo->exec($sql);

        return "Widok został pomyślnie zaktualizowany.";
    } catch (PDOException $e) {
        return "Błąd: " . $e->getMessage();
    }
}






?>
