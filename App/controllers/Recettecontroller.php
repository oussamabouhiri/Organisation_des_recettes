<?php

class RecetteController {
    private $recetteModel;
    private $categorieModel;

    public function __construct($db) {
        $this->recetteModel = new Recette($db);
        $this->categorieModel = new Categorie($db);
    }

    // List all recipes (for acceuil page)
    public function listRecette() {
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';
        if ($search !== '') {
            $recettes = $this->recetteModel->search($search);
        } else {
            $recettes = $this->recetteModel->getAllRecettes();
        }
        include 'App/views/Acceuil.php';
    }

    // Handle edit form display + POST update
    public function handleEdit() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?page=login");
            exit();
        }

        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)$_POST['id'];

            $this->recetteModel->setId($id);
            $this->recetteModel->setTitre(trim($_POST['titre']));
            $this->recetteModel->setIngredients(trim($_POST['ingredients']));
            $this->recetteModel->setInstructions(trim($_POST['instructions']));
            $this->recetteModel->setPortions((int)$_POST['portions']);
            $this->recetteModel->setTemps((int)$_POST['temps']);
            $this->recetteModel->setCategorieId(!empty($_POST['categorie_id']) ? (int)$_POST['categorie_id'] : null);
            $this->recetteModel->setVisiteurId($_SESSION['user_id']);

            if ($this->recetteModel->update()) {
                header("Location: index.php?page=dashboard&success=updated");
                exit();
            } else {
                $error = "Erreur lors de la modification de la recette.";
            }
        }

        // Get recipe data for the form
        $recette = $this->recetteModel->getById($id);

        // Check ownership
        if (!$recette || $recette['visiteur_id'] != $_SESSION['user_id']) {
            header("Location: index.php?page=dashboard&error=notfound");
            exit();
        }

        $categories = $this->categorieModel->getAll();

        return ['recette' => $recette, 'categories' => $categories, 'error' => $error];
    }

    // Handle recipe deletion
    public function handleDelete() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?page=login");
            exit();
        }

        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

        if ($id > 0) {
            $recette = $this->recetteModel->getById($id);
            if ($recette && $recette['visiteur_id'] == $_SESSION['user_id']) {
                $this->recetteModel->delete($id, $_SESSION['user_id']);
                header("Location: index.php?page=dashboard&success=deleted");
                exit();
            }
        }

        header("Location: index.php?page=dashboard&error=deletefailed");
        exit();
    }

    // Get all recipes for the logged-in user
    public function getUserRecettes() {
        if (!isset($_SESSION['user_id'])) {
            return [];
        }
        return $this->recetteModel->getAllByUser($_SESSION['user_id']);
    }

    // Get all categories
    public function getCategories() {
        return $this->categorieModel->getAll();
    }
        // Handle add form display + POST creation
        public function ajouter() {
            if (!isset($_SESSION['user_id'])) {
                header("Location: index.php?page=login");
                exit();
            }
    
            $error = null;
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $this->recetteModel->setTitre(trim($_POST['titre']));
                $this->recetteModel->setIngredients(trim($_POST['ingredients']));
                $this->recetteModel->setInstructions(trim($_POST['instructions']));
                $this->recetteModel->setPortions((int)$_POST['portions']);
                $this->recetteModel->setTemps((int)$_POST['temps']);
                $this->recetteModel->setCategorieId(!empty($_POST['categorie_id']) ? (int)$_POST['categorie_id'] : null);
                $this->recetteModel->setVisiteurId($_SESSION['user_id']);
    
                if ($this->recetteModel->create()) {
                    header("Location: index.php?page=dashboard&success=added");
                    exit();
                } else {
                    $error = "Erreur lors de la création de la recette.";
                }
            }
    
            $categories = $this->categorieModel->getAll();
            return ['categories' => $categories, 'error' => $error];  
}
}

?>
