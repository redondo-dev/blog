<?php
session_start();


$pdo = new PDO("mysql:host=localhost;dbname=blog;charset=utf8", "root", "");

if (isset($_POST['article_titre'], $_POST['article_contenu'])) {
    if (!empty($_POST['article_titre']) and !empty($_POST['article_contenu'])) {
        $auteur = $_SESSION["id"];
        $article_titre = htmlspecialchars($_POST['article_titre']);
        $article_contenu = htmlspecialchars($_POST['article_contenu']);

        $ins = $pdo->prepare('INSERT INTO articles (title, content, date_publication,auteur) VALUES (?, ?, NOW(),?)');
        $ins->execute(array($article_titre, $article_contenu, $auteur));
        $message = 'Votre article a bien été ajouté';
    } else {
        $message = 'Veuillez remplir tous les champs';
    }
}
?>
<!DOCTYPE html>
<html>

    <head>
        <title>Rédaction</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    </head>

    <body>
        <form method="POST">
            <input type="text" name="article_titre" placeholder="Titre" /><br />
            <textarea name="article_contenu" placeholder="Contenu de l'article"></textarea><br />
            <input type="submit" value="Envoyer l'article" />

        </form>
        <br />
        <?php if (isset($message)) {
            echo $message;
        } ?>
        <br><br>
        <button> <a href="connexion.php">Connexion</a></button><br><br>
        <button> <a href="inscription.php">Inscription</a></button><br><br>
        <button> <a href="articles.php">Articles</a></button><br><br>
        <button> <a href="redaction.php">rediger un Articles</a></button><br>
    </body>

</html>