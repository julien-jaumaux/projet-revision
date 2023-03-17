<?php
include('dbh.php');
include('user.php');
$user = new User('');
if(!empty($_POST)){
$login =$_POST['login'];
$password =$_POST['password'];
$email =$_POST['email'];
$firstname =$_POST['firstname'];
$lastname =$_POST['lastname'];
$user->register($login, $password, $email, $firstname, $lastname,$dbh);

}
//var_dump($_SESSION['user']);
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
<h1>Inscription<h1>
    <form method="post" action="">
        <p>login</p>
        <input type="text" name="login" placeholder="login">
        <p>Password</p>
        <input type="password" name="password" placeholder="password">
        <p>Confirm password</p>
        <input type="password" name="confirmpassword" placeholder="confirmpassword">
        <p>email</p>
        <input type="email" name="email" placeholder="email">
        <p>Prenom</p>
        <input type="text" name="firstname" placeholder="firstname">
        <p>Nom</p>
        <input type="text" name="lastname" placeholder="lastname">
        <input type="submit" name="s'inscrire">
    </form>
    <button><a href="connexion.php">Se connecter</a></button>
</body>
</html>
