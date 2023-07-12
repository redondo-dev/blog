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
    <div align="center">
        <h1>Bienvenue <?= $_SESSION["pseudo"] ?> </h1>

        <h1>page de profil de <?php echo $_SESSION["pseudo"]; ?></h1>


        <a href="deconnexion.php">deconnexion</a><br>
        <a href="editerprofil.php">editer profil</a><br>

        <button> <a href="redaction.php">rediger un Articles</a></button><br>
        <a href="connexion.php">Connexion</a><br>
        <a href="index.php">reconnexion</a>
    </div>
    <?php

    ?>
</body>

</html>