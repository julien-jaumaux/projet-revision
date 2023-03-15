<?php
include('bdh.php');
include('user.php');

if(isset($_POST['modifier'])){
    $user = new User();
    $user->update($_POST['login'],$_POST['password'],$_POST['email'],$_POST['firstname'],$_POST['lastname']);
}
if(isset($_SESSION['valider'])){
    echo $_SESSION['valider'];
    
}


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
</head>
<body>
    <h1>Modifier profil<h1>
        <form method="post" action="">
            <p>login</p>
            <input type="text" name="login" value="<?=$_SESSION['user']['login']?>">
            <p>Password</p>
            <input type="password" name="password" value="<?=$_SESSION['user']['password']?>">
            <p>email</p>
            <input type="email" name="email" value="<?=$_SESSION['user']['email']?>">
            <p>Prenom</p>
            <input type="text" name="firstname" value="<?=$_SESSION['user']['firstname']?>">
            <p>Nom</p>
            <input type="text" name="lastname" value="<?=$_SESSION['user']['lastname']?>">
            <input type="submit" name="modifier" >
        </form>
        <button><a href="logout.php">Se déconnecter</a></button>
        <button><a href="articles.php">Liste d'articles</a></button>
        <button><a href="article.php">Ajouter article</a></button>
</body>
</html>
<?php
 unset($_SESSION['valider']);
?>