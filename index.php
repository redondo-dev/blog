<!DOCTYPE html>
<html lang="en">

<?php
session_start();
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/style.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"> -->
    <title>Document</title>
</head>

<body>
    <div align="center">
        <h1>page d'acceuil-bienvenue sur mon blog </h1>
        <button type="button" class="btn btn-secondary"><a href="connexion.php">Connexion</a></button>
        <br><br>
        <button type="button" class="btn btn-primary"><a href="inscription.php">Inscription</a></button><br><br>
        <button><a href="articles.php">Articles</a></button><br><br>
        <button type="button" class="btn btn-success"> <a href="redaction.php">rediger un Articles</a></button><br>
    </div>
</body>

</html>