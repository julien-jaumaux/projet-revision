<?php
// session_start();

include('bdh.php');
include('user.php');
$id_utilisateur = $_SESSION['user']['id'];

if(isset($_POST['submit'])){
    if(!empty($_POST['article']) ){
    $article = $_POST['article'];
    $createArticle = $dbh->prepare("INSERT INTO articles(article, id_utilisateur) VALUES (?,?)");
    $createArticle->execute([$article, $id_utilisateur]);
    }
    echo"<br>votre article à bien été ajouté.";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article</title>
</head>
<body>
<form method="post" action="">
        <h1>Ajouter un article</h1>
        <p>Articles</p>
        <input type="text" name="article">
        <input type="submit" name="submit">
    </form>
    <button><a href="logout.php">Se déconnecter</a></button>
    <button><a href="articles.php">Liste d'articles</a></button>
</body>
</html>