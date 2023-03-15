<?php
include('bdh.php');
include('user.php');

if(isset($_GET['ordre']) && ($_GET['ordre']) == 'croissant'){
$showArticle = $dbh->prepare("SELECT article, login FROM articles INNER JOIN utilisateurs ON articles.id_utilisateur = utilisateurs.id ORDER BY articles.id DESC");
$ordre = 'decroissant';
echo"Classement par ordre décroissant<br>";
echo"<br>";
}
else{
    $showArticle = $dbh->prepare("SELECT article, login FROM articles INNER JOIN utilisateurs ON articles.id_utilisateur = utilisateurs.id ORDER BY articles.id ASC");
    $ordre = 'croissant'; 
    echo"Classement par ordre croissant<br>";
    echo"<br>";   
}
$showArticle->execute();
$result = $showArticle->fetchAll(PDO::FETCH_ASSOC);

foreach ($result as $key => $value){
    echo $value['article']."<br>";
    echo $value['login']."<br>";
    echo "<br>";
}

echo '<button><a href="articles.php?ordre='.$ordre.'">changer l\'ordre de classement</a></button>';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste</title>
</head>
<body>
    <button><a href="logout.php">Se déconnecter</a></button>
    <button><a href="article.php">Ajouter article</a></button>
    <button><a href="profil.php">Modifier son profil</a></button>
</body>
</html>