<?php

class User {
    private $conn ;
    private $id;
    private $username;
    private $email;
    private $password;
       public function __construct($db) {
        $this->conn = $db;
    }

    // Getters
      public function getId(){
        return $this -> id;
    }
    public function getUsername() {
        return $this->username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }
    
// Setters

public function setUsername($username) {
        $this->username = $username;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

     public function login($email , $password){
        $sql= "SELECT * FROM visiteur where email = ?";
        $stmt = $this ->conn -> prepare($sql) ;
        $stmt -> execute ([$email]);
        $user = $stmt ->fetch(PDO::FETCH_ASSOC);

      if ($user && password_verify($password,$user['password'])){
        return $user;
      }else {
        return false ;
      }
 }

 public function register($username, $email, $password){
    // Vérifie si le username existe déjà
    $sql = "SELECT * FROM visiteur WHERE username = ? OR email = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$username, $email]);
    
    if ($stmt->rowCount() > 0) {
        return false; // L'utilisateur existe déjà
    }
    
    // Insère le nouvel utilisateur
    $hashedpassword = password_hash($password, PASSWORD_BCRYPT);
    $sql = 'INSERT INTO visiteur (username,email,password) values (?,?,?)';
    $stmt = $this->conn->prepare($sql);
    return $stmt->execute([$username, $email, $hashedpassword]);
 }
}

?>