<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Modyfikuj Widok</title>
</head>

<body>

    <h1>Modyfikuj Widok</h1>

    <form action="process_data.php" method="post">
        <h2>Modyfikuj Widok:</h2>
        <p>Nazwa Tabeli:</p>
        <input type="text" name="table_name" placeholder="Nazwa Tabeli" required>

        <p>Wybierz Kolumny (oddzielone przecinkami):</p>
        <input type="text" name="columns" placeholder="Kolumny" required>

        <button type="submit" name="modify_view">Zapisz Widok</button>
    </form>

    <?php

    include('widoki.php');

    if (isset($result)) {
        echo "<p>$result</p>";
    }
    ?>

</body>

</html>
