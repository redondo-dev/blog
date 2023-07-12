<?php
session_start();
$pdo = new PDO("mysql:host=localhost;dbname=blog", "root", "");
if (isset($_GET['id']) and !empty($_GET['id'])) {
    $suppr_id = htmlspecialchars($_GET['id']);
    $suppr = $pdo->prepare('DELETE FROM articles WHERE id = ?');
    $suppr->execute(array($suppr_id));
    header('Location: http://localhost/blog-reda/articles/');

}
?>