<?php
session_start();
$pdo = new PDO("mysql:host=localhost;dbname=blog;charset=utf8", "root", "");
if (isset($_GET['t'], $_GET['id']) and !empty($_GET['t']) and !empty($_GET['id'])) {
    $getid = (int) $_GET['id'];
    $gett = (int) $_GET['t'];
    $sessionid = 5;
    $check = $pdo->prepare('SELECT id FROM articles WHERE id = ?');
    $check->execute(array($getid));
    if ($check->rowCount() == 1) {
        if ($gett == 1) {
            $check_like = $pdo->prepare('SELECT id FROM likes WHERE id_article = ? AND id_user = ?');
            $check_like->execute(array($getid, $sessionid));

            $del = $pdo->prepare('DELETE FROM dislikes WHERE id_article = ? AND id_user = ?');
            $del->execute(array($getid, $sessionid));

            if ($check_like->rowCount() == 1) {
                $del = $pdo->prepare('DELETE FROM likes WHERE id_article = ? AND id_user = ?');
                $del->execute(array($getid, $sessionid));
            } else {
                $ins = $pdo->prepare('INSERT INTO likes (id_article, id_user) VALUES (?, ?)');
                $ins->execute(array($getid, $sessionid));
            }
        } elseif ($gett == 2) {
            $check_like = $pdo->prepare('SELECT id FROM dislikes WHERE id_article = ? AND id_user = ?');
            $check_like->execute(array($getid, $sessionid));
            $del = $pdo->prepare('DELETE FROM likes WHERE id_article = ? AND id_user = ?');
            $del->execute(array($getid, $sessionid));

            if ($check_like->rowCount() == 1) {
                $del = $pdo->prepare('DELETE FROM dislikes WHERE id_article = ? AND id_user = ?');
                $del->execute(array($getid, $sessionid));
            } else {
                $ins = $pdo->prepare('INSERT INTO dislikes (id_article, id_user) VALUES (?, ?)');
                $ins->execute(array($getid, $sessionid));
            }
        }
        header('Location: http://localhost/blog-reda/article.php?id=' . $getid);
    } else {
        exit('Erreur fatale. <a href="http://localhost/blog-reda/articles.php" Revenir à l\'artciles</a>');
    }
} else {
    exit('Erreur fatale. <a href="http://localhost/blog-reda/articles.php">Revenir à l\'articles</a>');
}
