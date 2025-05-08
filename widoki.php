<?php
$host = 'localhost';
$dbname = 'test';
$username = 'root';
$password = 'haslo';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Pobierz listę widoków
    $stmt = $pdo->query("SHOW FULL TABLES WHERE TABLE_TYPE LIKE 'VIEW'");
    $views = $stmt->fetchAll(PDO::FETCH_COLUMN);

    foreach ($views as $view) {
        echo "<h2>Widok: $view</h2>";

        // Pobierz dane z widoku
        $stmt = $pdo->query("SELECT * FROM $view");
        $columns = $stmt->columnCount();

        if ($stmt->rowCount() > 0) {
            echo "<table>";
            echo "<tr>";
            for ($i = 0; $i < $columns; $i++) {
                $colInfo = $stmt->getColumnMeta($i);
                echo "<th>{$colInfo['name']}</th>";
            }
            echo "</tr>";

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                foreach ($row as $value) {
                    echo "<td>$value</td>";
                }
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<p>Brak danych w widoku $view.</p>";
        }
    }
} catch (PDOException $e) {
    echo "Błąd: " . $e->getMessage();
}
?>
