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

        $user_id = $_POST['id'];
        $subscriber_name = $_POST['fname'];
        $email = $_POST['email'];

        $stmt = $pdo->prepare("UPDATE subscribers SET fname = :fname, email = :email WHERE id = :id");
        $stmt->bindParam(':fname', $subscriber_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $user_id);
        $stmt->execute();

        echo "Zaktualizowano dane użytkownika.";

        
        $stmt_audit = $pdo->prepare("INSERT INTO audit_subscribers (subscriber_name, action_performed) VALUES (:subscriber_name, 'Updated a subscriber')");
        $stmt_audit->bindParam(':subscriber_name', $subscriber_name);
        $stmt_audit->execute();

    } 
    catch (PDOException $e) 
    {
        echo "Błąd: " . $e->getMessage();
    }
}
?>
