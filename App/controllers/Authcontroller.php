<?php
session_start();
require_once "../../config/db.php";
require_once "../models/User.php";


$database = new Database();
$db = $database->getConnection();
$user = new User($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

   
    // Get form  the data
    $user->setUsername($_POST['username']);
    $user->setEmail($_POST['email']);
    $user->setPassword($_POST['password']);

    // Register
    if ($user->register()) {
        echo " User registered successfully!";
    } else {
        echo " Error registering user.";
    }

}

  function login(){
          global $user;

        $email = trim($_POST['email']);
        $password = $_POST['password'];
        if(empty($email) || empty($password)) {
           die("Champs obligatoires.");
        }
 $userdata = $user-> getUserByEmail($email);
 
    if ($userdata){
        if(password_verify($password, $userdata['password'])){
            $_SESSION['user_id'] = $userdata['id'];
            $_SESSION['username'] = $userdata['username'];
            header ("location: ../view/DashboardUser.php");
            exit();
        } else {
            die("Mot de passe incorrect.");

        }
    }
    else {
            echo "Aucun utilisateur trouvé avec cet email.";
        }

 
    }
 ?>