<?php
require_once "config/db.php"; 
require_once "App/models/User.php";
require_once "App/models/Recette.php";
require_once "App/models/Categorie.php";
require_once "App/controllers/AuthController.php";
require_once "App/controllers/Recettecontroller.php";

$page = $_GET['page'] ?? 'home';
$database = new Database();
$db = $database->getConnection();
$auth = new AuthController($db);
$recetteCtrl = new RecetteController($db);
$categorieModel = new Categorie($db);

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
        $recettes = $recetteCtrl->getUserRecettes();
        include 'App/views/Dashboard.php';
    break;
    case 'ajouter':
        $data = $recetteCtrl->ajouter();
        include 'App/views/Recette/ajouter.php';
        break;

    case 'editRecette':
        $data = $recetteCtrl->handleEdit();
        include 'App/views/Recette/edit.php';
        break;

    case 'deleteRecette':
        $recetteCtrl->handleDelete();
        break;

    case 'logout':
        session_destroy();
        header("Location: index.php?page=login");
        exit();
        break;

    case 'acceuil':
        $recetteCtrl->listRecette();
        break;

    default:
        $recetteCtrl->listRecette();
        break;
}
?>