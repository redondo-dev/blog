<?php
session_start();


$pdo = new PDO('mysql:host=localhost;dbname=blog', 'root', '');

if (isset($_POST['forminscription'])) {


    if (!empty($_POST['pseudo']) and !empty($_POST['email']) and !empty($_POST['email2']) and !empty($_POST['mdp']) and !empty($_POST['mdp2'])) {
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $email = htmlspecialchars($_POST['email']);
        $email2 = htmlspecialchars($_POST['email2']);
        $mdp = $_POST['mdp'];
        $mdp2 = $_POST['mdp2'];

        $pseudolenght = strlen($pseudo);
        if ($pseudolenght <= 255) {

            if ($email == $email2) {
                if ($mdp == $mdp2) {
                } else {
                    $error = "vos mots de passes ne correspondent pas ";
                }
            } else {
                $error = "votre pseudo doit contenir moins de 255 caracteres ";
            }
        } else {
            $Error = "tous les chmaps doivent etre remplis";
        }
        $mdp = password_hash($mdp, PASSWORD_DEFAULT);

        $r = $pdo->prepare("INSERT INTO users (pseudo,email,password) VALUES (?,?,?)");
        $r->execute([$pseudo, $email, $mdp]);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/style.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"> -->
    <title>inscription</title>
</head>

<body>
    <div align="center">
        <h2>inscription </h2>
        <br><br><br>
        <div align="center">
            <form action="inscription.php" method="post">
                <label for="pseudo">Pseudo :</label>
                <input type="text" name="pseudo" id="pseudo" placeholder="votre pseudo">
                <br><br><br>
                <label for="email">E-Mail :</label>
                <input type="email" name="email" id="email" placeholder="votre email">
                <br><br>
                <label for="email">confirmez votre E-Mail :</label>
                <input type="email" name="email2" id="email2" placeholder="confirmation email">
                <br><br>
                <label for="mdp">Mot de pass :</label>
                <input type="password" name="mdp" id="mdp" placeholder="votre mot de pass">
                <br><br>
                <label for="mdp2">Confirmez votre mot de pass :</label>
                <input type="password" name="mdp2" id="mdp2" placeholder="confirmez votre mot de pass">
                <br><br>
                <input type="submit" name="forminscription" value="je m'inscris ">
            </form>
        </div>
    </div>
    <br><br>
    <?php
    if (isset($erreur)) {
        echo '<font color="red"' . $erreur . '<font>';
    }






    ?>
    <div align="center">
        <a href="connexion.php">page de connexion</a>
        <button> <a href="connexion.php">Connexion</a></button><br><br>
        <button> <a href="inscription.php">Inscription</a></button><br><br>
        <button> <a href="articles.php">Articles</a></button><br>
        <button> <a href="redaction.php">rediger un Articles</a></button><br>
    </div>
</body>

</html>