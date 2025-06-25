<?php
// Database configuration
// Zmień te wartości zgodnie z Twoją konfiguracją XAMPP

$host = 'localhost';        // lub '127.0.0.1'
$dbname = 'test';           // nazwa bazy danych
$username = 'root';         // nazwa użytkownika MySQL
$password = '';             // hasło MySQL (puste dla domyślnej instalacji XAMPP)

// Function to get database connection
function getDBConnection() {
    global $host, $dbname, $username, $password;
    
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        throw new Exception("Database connection failed: " . $e->getMessage());
    }
}

// Function to check if database exists
function checkDatabaseExists() {
    global $host, $username, $password, $dbname;
    
    try {
        $pdo = new PDO("mysql:host=$host", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $pdo->query("SHOW DATABASES LIKE '$dbname'");
        return $stmt->rowCount() > 0;
    } catch (PDOException $e) {
        return false;
    }
}
?> 