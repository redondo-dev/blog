<?php
session_start();

$pdo = new PDO('mysql:host=localhost;dbname=blog', 'root', '');

if (isset($_FILES['avatar']) and !empty($_FILES['avatar']['pseudo'])) {
    $tailleMax = 2097152;
    $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
    if ($_FILES['avatar']['size'] <= $tailleMax) {
        $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['pseudo'], '.'), 1));
        if (in_array($extensionUpload, $extensionsValides)) {
            $chemin = "users/avatars/" . $_SESSION['id'] . "." . $extensionUpload;
            $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
            
            if ($resultat) {
                $updateavatar = $bdd->prepare('UPDATE users SET avatar = :avatar WHERE id = :id');
                $updateavatar->execute(array(
                    'avatar' => $_SESSION['id'] . "." . $extensionUpload,
                    'id' => $_SESSION['id']
                ));
                header('Location: users.php?id=' . $_SESSION['id']);
            } else {
                $msg = "Erreur durant l'importation de votre photo de profil";
            }
        } else {
            $msg = "Votre photo de profil doit être au format jpg, jpeg, gif ou png";
        }
    } else {
        $msg = "Votre photo de profil ne doit pas dépasser 2Mo";
    }
}
