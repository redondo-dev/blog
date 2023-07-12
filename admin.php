<?php
session_start();

if (!isset($_SESSION["id"]) || $_SESSION["role"] !== "admin") {

    header("Location: deconnexion.php");
} else {
    header("location:users.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/style.css">
    <title>Document</title>
</head>

<body>

    <h1>Page admin</h1>
    <p>Bienvenu sur la page administrateur<?= $_SESSION["pseudo"] ?> </p>
    <a href="deconnexion.php">deconnexion</a>

</body>

</html>