<?php

class Recette {
    private $conn;
    private $table = "recette";

    private $id;
    private $titre;
    private $ingredients;
    private $instructions;
    private $portions;
    private $temps;
    private $rating;
    private $visiteur_id;
    private $categorie_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Getters
    public function getId() { return $this->id; }
    public function getTitre() { return $this->titre; }
    public function getIngredients() { return $this->ingredients; }
    public function getInstructions() { return $this->instructions; }
    public function getPortions() { return $this->portions; }
    public function getTemps() { return $this->temps; }
    public function getRating() { return $this->rating; }
    public function getVisiteurId() { return $this->visiteur_id; }
    public function getCategorieId() { return $this->categorie_id; }

    // Setters
    public function setId($id) { $this->id = $id; }
    public function setTitre($titre) { $this->titre = $titre; }
    public function setIngredients($ingredients) { $this->ingredients = $ingredients; }
    public function setInstructions($instructions) { $this->instructions = $instructions; }
    public function setPortions($portions) { $this->portions = $portions; }
    public function setTemps($temps) { $this->temps = $temps; }
    public function setRating($rating) { $this->rating = $rating; }
    public function setVisiteurId($visiteur_id) { $this->visiteur_id = $visiteur_id; }
    public function setCategorieId($categorie_id) { $this->categorie_id = $categorie_id; }

    // Get all recipes (for acceuil page)
    public function getAllRecettes() {
        $sql = "SELECT r.*, v.username AS auteur, c.nom AS categorie_nom 
                FROM {$this->table} r 
                LEFT JOIN visiteur v ON r.visiteur_id = v.id
                LEFT JOIN categorie c ON r.categorie_id = c.id
                ORDER BY r.created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get all recipes for a specific user
    public function getAllByUser($userId) {
        $sql = "SELECT r.*, c.nom AS categorie_nom 
                FROM {$this->table} r 
                LEFT JOIN categorie c ON r.categorie_id = c.id 
                WHERE r.visiteur_id = ? 
                ORDER BY r.created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    // Get a single recipe by ID
    public function getById($id) {
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Update an existing recipe (checks visiteur_id for ownership)
    public function update() {
        $sql = "UPDATE {$this->table} 
                SET titre = ?, ingredients = ?, instructions = ?, portions = ?, temps = ?, categorie_id = ? 
                WHERE id = ? AND visiteur_id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $this->titre,
            $this->ingredients,
            $this->instructions,
            $this->portions,
            $this->temps,
            $this->categorie_id,
            $this->id,
            $this->visiteur_id
        ]);
    }

    // Delete a recipe (checks visiteur_id for ownership)
    public function delete($id, $visiteurId) {
        $sql = "DELETE FROM {$this->table} WHERE id = ? AND visiteur_id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id, $visiteurId]);
    }

  public function create(){
    $sql = "INSERT INTO {$this->table} (titre, ingredients, instructions, portions, temps, visiteur_id, categorie_id) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $this->conn->prepare($sql);
    return $stmt->execute([
        $this->titre,
        $this->ingredients,
        $this->instructions,
        $this->portions,
        $this->temps,
        $this->visiteur_id,
        $this->categorie_id
    ]);

  }

}

?>
