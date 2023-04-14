<?php
session_start();

// 1. connexion a la bdd
try {

    $pdo = new PDO("mysql:host=localhost;dbname=blog", "root", "");

} catch (PDOException $e) {

    echo $e->getMessage();
}


if (isset($_POST["email"])) {

    $email = htmlspecialchars(trim($_POST["email"]));
    $pass = htmlspecialchars($_POST["password"]);

    // 2. verifier si les champs ne sont pas vides
    if (!empty($email) && !empty($pass)) {

        // 3. si l'email existe

        $select = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $select->execute([$email]);
        $data = $select->fetch();
        // var_dump($data);

        if ($data) {

            // 4. recupéré le mot de passe dans la bdd

            $pdoPass = $data["password"];

            // 5. comparer les mots de passe (bdd et post)
            if (password_verify($pass, $pdoPass)) {

                // 6. creer une session de connexion ou je vais stocker des infos sur l'utilisateur
                $_SESSION["id"] = $data["id"];
                $_SESSION["pseudo"] = $data["pseudo"];
                $_SESSION["role"] = $data["role"];
                // 7. verifier si l'utilisateur connecter est un admin ou user

                if ($data["role"] === "admin") {

                    header("Location: admin.php");

                } else {

                    header("Location: users.php");
                }






            } else {
                $error = "le mot de passe est incorrect";
            }




        } else {

            $error = 'L/email nexiste pas  <a href="\blog-reda\inscription.php">cliquez ici pour vous inscrire<a>"';
        }





    } else {

        $error = "Veuillez remplire les champs !";
    }




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

        <h1>Connexion</h1>


        <form action="" method="POST">
            <input type="text" placeholder="email" name="email">
            <input type="password" placeholder="Mot de passe" name="password">
            <input type="submit">

        </form>

        <?php
        if (isset($error)) {
            echo "<p style='color:red'>$error</p>";
        } else {
            echo ('<vous étes bien connecté> ');
        }


        ?>

        <button> <a href="connexion.php">Connexion</a></button><br><br>
        <button> <a href="inscription.php">Inscription</a></button><br><br>
        <button> <a href="articles.php">Articles</a></button><br>
        <button> <a href="redaction.php">rediger un Articles</a></button><br>



    </body>

</html>