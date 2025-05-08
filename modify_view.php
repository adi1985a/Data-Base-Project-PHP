<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $host = 'localhost';
    $dbname = 'test';
    $username = 'root';
    $password = 'haslo';

    try 
    {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $table_name = $_POST['table_name'];
        $columns = $_POST['columns'];
        
        $sql = "CREATE OR REPLACE VIEW $table_name AS SELECT $columns FROM subscribers";
        $pdo->exec($sql);

        echo "Widok został pomyślnie zaktualizowany.";

    } 
    catch (PDOException $e) 
    {
        echo "Błąd: " . $e->getMessage();
    }
}
?>
