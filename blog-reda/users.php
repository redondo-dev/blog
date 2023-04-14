<?php
session_start();

if (!isset($_SESSION["id"])) {

    header("Location: deconnexion.php");
}


// 1. connexion a la bdd
try {

    $pdo = new PDO("mysql:host=localhost;dbname=blog", "root", "");

} catch (PDOException $e) {

    echo $e->getMessage();
}




?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
        <title>Document</title>
    </head>

    <body>
        <p>Bienvenu <?= $_SESSION["pseudo"] ?> </p>

        <h1>page <?php echo $_SESSION["pseudo"]; ?></h1>


        <a href="deconnexion.php">deconnexion</a>






        <a href="index.php">reconexion</a>

        <?php

        ?>
    </body>

</html>