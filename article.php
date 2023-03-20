<?php
// session_start();

include('dbh.php');
include('user.php');
$id_utilisateur = $_SESSION['user']->id;

//---------------ajouter un nouvel article--------------//

if(isset($_POST['submit'])){
    if(!empty($_POST['article']) ){
    $article = $_POST['article'];
    $createArticle = $dbh->prepare("INSERT INTO articles(article, id_utilisateur) VALUES (?,?)");
    $createArticle->execute([$article, $id_utilisateur]);

    $selectid = $dbh->prepare("SELECT id FROM articles WHERE id_utilisateur = ? ORDER BY id DESC");
    $selectid->execute(array($_SESSION['user']->id));
    $res = $selectid->fetch(PDO::FETCH_ASSOC);

    if(isset($_POST['categorie'])){
        for($i=0;$i<count($_POST['categorie']);$i++){
            $req = $dbh->prepare("INSERT INTO liaison(id_article, id_categorie) VALUE (?,?)");
            $req->execute([$res['id'], $_POST['categorie'][$i]]);
        }
    }
    }
    echo"<br>votre article à bien été ajouté.";
    }

    //--------------ajouter une nouvelle catégorie------------//

    if(isset($_POST['submitcategorie'])){
        if(!empty($_POST['categorie']) ){
            $categorie = $_POST['categorie'];
            $createCategorie = $dbh->prepare("INSERT INTO categories(nom) VALUES (?)");
            $createCategorie->execute([$categorie]);
            }
            echo"<br>votre catégorie à bien été ajouté.";
            var_dump($_POST['categorie']);
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
    <!-- ajout aricle -->

<form method="post" action="">
        <h1>Ajouter un article</h1>
        <label>Articles</label>
        <input type="text" name="article">
        <fieldset>
        <legend>Veuillez sélectionner votre catégorie :</legend>
        <?php 
        $recupCategorie = $dbh->prepare("SELECT * FROM categories");
        $recupCategorie->execute();
        $result = $recupCategorie->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $key => $value): ?>
            <label for="<?= $value['nom']?>"><?= $value['nom']?></label>
            <input type="checkbox" id="<?= $value['nom']?>" value="<?= $value['id'] ?>" name="categorie[]">
            <?php //var_dump($value);?><br>
        <?php
        endforeach;
        ?>
        </fieldset>
        <input type="submit" name="submit">
    </form><br>
    <!-- ajout catégorie -->

    <form method="post" action="">
        <label>Ajouter catégorie</label>
        <input type="text"  name="categorie">
        <input type="submit" name="submitcategorie">
        
</form>
    <?php //var_dump($_POST['categorie']); ?>
    <button><a href="logout.php">Se déconnecter</a></button>
    <button><a href="articles.php">Liste d'articles</a></button>
    <button><a href="profil.php">Modifier son profil</a></button>
</body>
</html>