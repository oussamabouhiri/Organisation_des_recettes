<?php
require_once "config/db.php"; 
require_once "App/models/User.php";
require_once "App/controllers/AuthController.php";
$page = $_GET['page'] ?? 'home';
$database = new Database();
$db = $database->getConnection();
$auth = new AuthController($db);
$recipeModel = new Recette($db);
$recettes = $recipeModel->getAllRecettes();

switch ($page) {
    case 'login':
        $auth->handleLogin();
        include 'App/views/Auth/login.php'; 
        break;
    case 'register':
        $auth->handleRegister();
        include 'App/views/Auth/register.php'; 

        break;
    case 'dashboard':
        include 'App/views/DashboardUser.php';
        break;
    default:
        echo "<h1>Bienvenue</h1><a href='?page=login'>Se connecter</a> | <a href='?page=register'>S'inscrire</a>";
}
?>