<?php
$host = 'localhost';
$dbname = 'test';
$username = 'root';
$password = 'haslo'; // Zastąp to swoim hasłem

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    echo "Połączenie udane!";
} catch (PDOException $e) {
    echo "Błąd: " . $e->getMessage();
}
?>