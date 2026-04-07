<?php

class User {
    private $conn;
    private $table = "visiteur";
    private $id;
    private $username;
    private $email;
    private $password;

    public function __construct($db) {
        $this->conn = $db;
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

    // Register the user user
    public function register() {
        $query = "INSERT INTO " . $this->table . " (username, email, password)
                  VALUES (:username, :email, :password)";

        $stmt = $this->conn->prepare($query);

        // Hashing the password 
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);

        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $hashedPassword);

        return $stmt->execute();
    }



     function login ($email){
    $sql= "SELECT * FROM users where email = :email";
    $stmt = $this ->conn -> prepare($sql) ;
    $stmt -> execute (["email => $email "]);
    return $stmt ->fetch(PDO::FETCH_ASSOC);
 }
}

?>