<?php
session_start();

if (!isset($_SESSION["id"]) || $_SESSION["role"] !== "admin") {

    header("Location: deconnexion.php");
}

?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>

    <body>

        <h1>page admin</h1>
        <p>Bienvenu <?= $_SESSION["pseudo"] ?> </p>
        <a href="deconnexion.php">deconnexion</a>

    </body>

</html>