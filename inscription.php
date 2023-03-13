<?php
session_start();

include('user.php');
$user = new User();
if(!empty($_POST)){
$login =$_POST['login'];
$password =$_POST['password'];
$email =$_POST['email'];
$firstname =$_POST['firstname'];
$lastname =$_POST['lastname'];
$user->register($login, $password, $email, $firstname, $lastname);
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
<h1>Inscription<h1>
    <form method="post" action="">
        <p>login</p>
        <input type="text" name="login">
        <p>email</p>
        <input type="email" name="email">
        <p>Password</p>
        <input type="password" name="password">
        <p>Prenom</p>
        <input type="text" name="firstname">
        <p>Nom</p>
        <input type="text" name="lastname">
        <input type="submit" name="s'inscrire">
    </form>