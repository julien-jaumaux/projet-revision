<?php
session_start();


class User
{
    public $dbh;
    public $login;
    public $password;
    public $email;
    public $firstname;
    public $lastname;

    public function __construct($login, $password, $email, $firstname, $lastname){
        $this->dbh = new PDO('mysql:host=localhost;dbname=revisions', 'root', '');
        $this->login = $login;
        $this->password = $password;
        $this->email = $email;
        $this->firstname = $firstname;
        $this->lastname = $lastname;

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

    public function register(){
        $createUser = $this->dbh->prepare("INSERT INTO utilisateurs(login, password, email, firstname, lastname) VALUES (?, ?, ?, ?, ?)");
        $createUser->execute([$this->login, $this->password, $this->email, $this->firstname, $this->lastname]);
        
    }

    public function connect($login, $password){
        $connect = $this->dbh->prepare("SELECT * FROM utilisateurs WHERE login = ? AND password = ?");
        $connect->execute([$login, $password]);
        $result = $connect->fetch(PDO::FETCH_ASSOC);
        $_SESSION['user'] = $result;
        var_dump($_SESSION);
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
}

$user = new User("test1","test1","test1@","test1","test1");
//$user->register();
// $user->connect("test1","test1");
// $user->disconnect();
//$user->isConnected();
//session_destroy();

?>