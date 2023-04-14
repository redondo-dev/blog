<?php
session_start();

$pdo = new PDO("mysql:host=localhost;dbname=blog", "root", "");

// $articles = $articles->fetch();
// $titre = $articles['title'];
// $contenu = $articles['content'];


$articles = $pdo->prepare('SELECT * FROM articles ORDER BY date_publication DESC');
$articles->execute();
$articles = $articles->fetchAll();

if (isset($articles)) {

    ?>
    <!DOCTYPE html>
    <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
            <title>artcile</title>
        </head>

        <body>



            <ul>
                <?php foreach ($articles as $a) { ?>


                    <li><a href="article.php?id=<?= $a['id'] ?>"><?= $a['title'] ?></a> |
                        <a href="redaction.php?edit=<?= $a['id'] ?>">Modifier</a> |
                        <a href="supprimer.php?id=<?= $a['id'] ?>">Supprimer</a>
                    </li>
                <?php } ?>

                <ul>
                    <button> <a href="connexion.php">Connexion</a></button><br><br>
                    <button> <a href="inscription.php">Inscription</a></button><br><br>
                    <button> <a href="articles.php">Articles</a></button><br><br>
                    <button> <a href="redaction.php">rediger un Articles</a></button><br>
        </body>
        <?php

} else {
    die('Cet article n\'existe pas !');
}
?>

</html>