<?php
session_start();


$pdo = new PDO("mysql:host=localhost;dbname=blog;charset=utf8", "root", "");
if (isset($_FILES['file'])) {
    $tmpName = $_FILES['file']['tmp_name'];
    $name = $_FILES['file']['name'];
    $size = $_FILES['file']['size'];
    $error = $_FILES['file']['error'];
    $type = $_FILES['file']['type'];

    // move_uploaded_file($tmpName, './upload/' . $name);

    $tabExtension = explode('.', $name);
    $extension = strtolower(end($tabExtension));

    // Tableau des extensions que l'on accepte
    $extensions = ['jpg', 'png', 'jpeg', 'gif'];

    //Taille max que l'on accepte
    $maxSize = 4000000;

    if (in_array($extension, $extensions) && $size <= $maxSize && $error == 0) {
        $uniqueName = uniqid('', true);
        //uniqid génère quelque chose comme ca : 5f586bf96dcd38.73540086
        $img = $uniqueName . "." . $extension;
        //$file = 5f586bf96dcd38.73540086.jpg
        move_uploaded_file($tmpName, './upload/' . $img);
    }
    echo 'votre image a bien été telechargé';
}
if (isset($_POST['article_titre'], $_POST['article_contenu'])) {
    if (!empty($_POST['article_titre']) and !empty($_POST['article_contenu'])) {
        $auteur = $_SESSION["id"];
        $article_titre = htmlspecialchars($_POST['article_titre']);
        $article_contenu = htmlspecialchars($_POST['article_contenu']);
        $ins = $pdo->prepare('INSERT INTO articles (title, content,img,date_publication,auteur) VALUES (?,?,?, NOW(),?)');
        $ins->execute(array($article_titre, $article_contenu, $img, $auteur));

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
    <link rel="stylesheet" href="./public/style.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"> -->
</head>
<h1>Redaction d'articles</h1>

<body>
    <form align="center" form action="redaction.php" method="POST" enctype="multipart/form-data">

        <input type="text" name="article_titre" placeholder="Titre" /><br />
        <textarea name="article_contenu" placeholder="Contenu de l'article"></textarea><br />
        <input type="file" name="file">
        <button type="submit">Enregistrer</button>
    </form>



    <br />
    <?php if (isset($message)) {
        echo $message;
    } ?>
    <br><br>
    <button> <a href=" connexion.php">Connexion</a></button><br><br>
    <button> <a href="inscription.php">Inscription</a></button><br><br>
    <button> <a href="articles.php">Articles</a></button><br><br>
    <button> <a href="redaction.php">rediger un Articles</a></button><br>
</body>

</html>