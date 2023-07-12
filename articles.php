<?php
session_start();

$pdo = new PDO("mysql:host=localhost;dbname=blog", "root", "");
$articles = $pdo->prepare('SELECT * FROM articles ORDER BY date_publication DESC');
$articles->execute();
$articles = $articles->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./public/style.css">
	<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"> -->

	<title>articles</title>
</head>

<body>
	<h1>Mes articles </h1>

	<ul>
		<?php foreach ($articles as $a) { ?>


			<li align="center"><a href="article.php?id=<?= $a['id'] ?>"> <?= $a['title'] ?><?= $a['content'] ?><Br></Br>
					<br><br>
					<div><img src="./upload/<?= $a['img'] ?>" width='300px'>
						<div><br><br>

			</li>
			<button type="button" class="btn btn-success"><a href="redaction.php?edit=<?= $a['id'] ?>">Modifier</a></button><br><br>
			<button type="button" class="btn btn-danger"><a href="supprimer.php?id=<?= $a['id'] ?>">Supprimer</a></button><br><br>
			<button type="button" class="btn btn-success"><a href="article.php?id=<?= $a['id'] ?>">afficher</a></button><br><br>

			<br><br>



		<?php } ?>



		<ul align="right">
			<button type="button" class="btn btn-success"><a href="connexion.php">Connexion</a></button><br><br>
			<button> <a href="inscription.php">Inscription</a></button><br><br>
			<button> <a href="articles.php">Articles</a></button><br><br>
			<button> <a href="article.php">commentaire</a></button><br><br>
			<button> <a href="redaction.php">rediger un Articles</a></button><br>
		</ul>

</body>

<!-- commentaire sur les articles -->
<?php
