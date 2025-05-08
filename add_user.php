/* The code you provided is a PHP script that handles a form submission using the POST method. */
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

        $subscriber_name = $_POST['fname'];
        $email = $_POST['email'];

        $stmt = $pdo->prepare("INSERT INTO subscribers (fname, email) VALUES (:fname, :email)");
        $stmt->bindParam(':fname', $subscriber_name);
        $stmt->bindParam(':email', $email);
        $stmt->execute();


        echo "Dodano nowego użytkownika do bazy danych.";

        $stmt_audit = $pdo->prepare("INSERT INTO audit_subscribers (subscriber_name, action_performed) VALUES (:subscriber_name, 'Insert a new subscriber')");
        $stmt_audit->bindParam(':subscriber_name', $subscriber_name);
        $stmt_audit->execute();

    } 
    
    catch (PDOException $e) 
    {
        echo "Błąd: " . $e->getMessage();
    }
    echo "<br/>Imie: ";
    echo $subscriber_name;
    echo "<br/>Email: ";
    echo $email;


}
?>