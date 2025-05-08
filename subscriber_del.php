<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) 
{
    $user_id = $_GET['id'];

    $host = 'localhost';
    $dbname = 'test'; 
    $username = 'root';
    $password = 'haslo';

    try 
    {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("SELECT * FROM subscribers WHERE id = :id");
        $stmt->bindParam(':id', $user_id);
        $stmt->execute();
        $user = $stmt->fetch();

        if ($user) 
        {
            $stmt = $pdo->prepare("DELETE FROM subscribers WHERE id = :id");
            $stmt->bindParam(':id', $user_id);
            $stmt->execute();

            $stmt = $pdo->prepare("INSERT INTO audit_subscribers (subscriber_name, action_performed) VALUES (:subscriber_name, 'Deleted a subscriber')");
            $stmt->bindParam(':subscriber_name', $user['fname']); 
            $stmt->execute();

            echo "Użytkownik został pomyślnie usunięty.";
        } 
        
        else 
        {
            echo "Nie znaleziono użytkownika o podanym ID.";
        }
    } 
    
    catch (PDOException $e) 
    {
        echo "Błąd: " . $e->getMessage();
    }
} 

else 
{
    echo "Brak danych ID użytkownika do usunięcia.";
}

?>

