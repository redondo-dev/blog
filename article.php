<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./public/style.css">
</head>

<body>


    <?php
    session_start();
    $getid = $_GET["id"];
    $getuser = $_SESSION['id'];
    // $commentaire = $_GET['commentaire'];
    $pdo = new PDO("mysql:host=localhost;dbname=blog", "root", "");
    $articles = $pdo->prepare('SELECT * FROM articles WHERE id =?');
    $articles->execute([$getid]);
    $a = $articles->fetch();


    $likes = $pdo->prepare('SELECT id FROM likes WHERE id_article = ?');
    $likes->execute(array($getid));
    $likes = $likes->rowCount();

    $dislikes = $pdo->prepare('SELECT id FROM dislikes WHERE id_article = ?');
    $dislikes->execute(array($getid));
    $dislikes = $dislikes->rowCount();


    ?>

    <p align="center"><a href="article.php?id=<?= $a['id'] ?>"></a><?= $a['title'] ?>
        <br><br><br>
        <img src="./upload/<?= $a['img'] ?>" width='300px'><br><br>

    </p>


    <p align="center">
        <a href="action.php?t=1&id=<?= $a['id'] ?>">J'aime</a> (<?= $likes ?>)
        <br />
        <a href="action.php?t=2&id=<?= $a['id'] ?>">Je n'aime pas</a> (<?= $dislikes ?>)
    </p>

    <?php
    if (isset($_POST['submit_commentaire'])) {

        if (isset($_POST['commentaire']) and !empty($_POST['commentaire'])) {

            $commentaire = htmlspecialchars($_POST['commentaire']);
            $insert = $pdo->prepare('INSERT INTO commentaires (auteur_id,id_article ,commentaire) VALUES (?,?,?)');
            $insert->execute(array($getuser, $getid, $commentaire));

            $c = "<span style='color:red'>Votre commentaire a bien été posté</span>";
        } else {
            $c = "Erreur: Tous les champs doivent être complétés";
        }
    }

    ?>
    <h2>Commentaires:</h2>
    <form method="POST">
        <textarea name="commentaire" placeholder="Votre commentaire..."></textarea><br />
        <input type="submit" value="Poster mon commentaire" name="submit_commentaire" />
    </form>
    <br><br>
    <p><?php echo $getuser; ?></p>
    <br><br>
    <div><?php echo $commentaire; ?></div>
    <p> <?php if (isset($c)) {
            echo $c;
        }

        ?></p>



    <h2>liens pour les autres pages</h2>
    <ul align="right">
        <button type="button" class="btn btn-success"><a href="connexion.php">Connexion</a></button><br><br>
        <button> <a href="inscription.php">Inscription</a></button><br><br>
        <button> <a href="articles.php">Articles</a></button><br><br>
        <button> <a href="redaction.php">rediger un Articles</a></button><br>
    </ul>

</body>

</html>