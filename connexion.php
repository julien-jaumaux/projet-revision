<?php

include('dbh.php');
include('user.php');
$user = new User();
if(!empty($_POST)){
$login =$_POST['login'];
$password =$_POST['password'];
$user->connect($login, $password,$dbh);
$user->isConnected();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
<h1>Connexion<h1>
    <form method="post" action="">
        <p>login</p>
        <input type="text" name="login">
        <p>Password</p>
        <input type="password" name="password">
        <input type="submit" name="Se connecter">
    </form>
    <button><a href="inscription.php">S'inscrire</a></button>
</body>
</html>