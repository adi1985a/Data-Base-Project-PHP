<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Lista Użytkowników</title>
</head>
<body>

    <h1>Wyświetl Użytkowników</h1>
    <p>Delete - powoduje usunięcie użytkownika oraz uruchomienie wyzwalacza po usunięciu.</p>
    <p>Edit - po edycji użytkownika zostanie uruchomiony wyzwalacz.</p>

    <?php
    
    $host = 'localhost';
    $dbname = 'test';
    $username = 'root';
    $password = 'haslo';

    try 
    {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->query("SELECT * FROM subscribers");
        
        echo "<table border='1'>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>";

        $idCounter = 1; 

        while ($row = $stmt->fetch()) 
        {
            echo "<tr>
                    <td>{$idCounter}</td>
                    <td>{$row['fname']}</td>
                    <td>{$row['email']}</td>
                    <td>
                        <a href='subscriber_edit.php?id={$row['id']}'>Edit</a> | 
                        <a href='subscriber_del.php?id={$row['id']}'>Delete</a>
                    </td>
                </tr>";
            $idCounter++; 
        }

        echo "</table>";

    } 
    catch (PDOException $e) 
    {
        echo "Błąd: " . $e->getMessage();
    }
    ?>

</body>
</html>
