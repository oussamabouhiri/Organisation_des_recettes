<?php

require_once "../../config/db.php";
require_once "../models/User.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);

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