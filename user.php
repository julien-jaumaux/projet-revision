<?php

class User
{
    public $dbh;
    public $login;
    public $password;
    public $email;
    public $firstname;
    public $lastname;

    public function __construct(){
        $this->dbh = new PDO('mysql:host=localhost;dbname=revisions', 'root', '');
    }

    /*-----------méthode get--------------*/

    public function getLogin(){
        return $login;
    }

    public function getPassword(){
        return $password;
    }

    public function getEmail(){
        return $email;
    }

    public function getFirstname(){
        return $firstname;
    }

    public function getLastname(){
        return $lastname;
    }

    /*--------------méthode set--------------*/

    public function setLogin(){
        $this->login = $login;
    }

    public function setPassword(){
        $this->password = $password;
    }

    public function setEmail(){
        $this->email = $email;
    }

    public function setFirstname(){
        $this->firstname = $firstname;
    }

    public function setLastname(){
        $this->lastname = $lastname;
    }

    /*---------------------------*/

    public function register($login, $password, $email, $firstname, $lastname){
        if(!empty($login) && !empty($password) && !empty($email) && !empty($firstname) && !empty($lastname)){
            $createUser = $this->dbh->prepare("INSERT INTO utilisateurs(login, password, email, firstname, lastname) VALUES (?, ?, ?, ?, ?)");
            $createUser->execute([$login, $password, $email, $firstname, $lastname]);  
        }
        else{

        echo"Veuillez remplir tous les champs";
        } 
    }

    public function connect($login, $password){
        if(!empty($login) && !empty($password)){
        $connect = $this->dbh->prepare("SELECT * FROM utilisateurs WHERE login = ? AND password = ?");
        $connect->execute([$login, $password]);
        $result = $connect->fetch(PDO::FETCH_ASSOC);
        if($connect->rowCount()==1){    
        $_SESSION['user'] = $result;
        header("location:article.php");
        var_dump($this->isConnected());
        }
        }
        else{
            echo"Veuillez remplir tous les champs";
            } 
    }
    
    public function disconnect(){
        unset($_SESSION['user']);
        var_dump($_SESSION);
    }

    public function isConnected(){
        if (isset($_SESSION['user'])){
            echo "--connnected--";
            return true;
        }
        else{
            echo "--disconnected--";
            return false;
        }
    } 
    
    public function update($login, $password, $email, $firstname, $lastname)
    {
        $updateUser = $this->dbh->prepare("UPDATE utilisateurs SET login=?, password=?, email=?, firstname=?, lastname=? WHERE login = ?");
        $updateUser->execute([$login, $password, $email, $firstname, $lastname, $_SESSION['user']['login']]);
        $_SESSION['user']['login'] = $_POST['login'];
        $_SESSION['user']['password'] = $_POST['password'];
        $_SESSION['user']['email'] = $_POST['email'];
        $_SESSION['user']['firstname'] = $_POST['firstname'];
        $_SESSION['user']['lastname'] = $_POST['lastname'];
        $_SESSION['valider'] = "votre profil est bien modifié";
        header("location:profil.php");
        exit();
        
    }
}

//$user = new User();
//$user->register();
// $user->connect("test1","test1");
// $user->disconnect();
//$user->isConnected();
//$user->update();
//session_destroy();

?>