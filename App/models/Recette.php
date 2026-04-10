<?php

class Recette {
    private $conn;
    private $table = "recette";

    private $id;
    private $titre;

class Recette {
    
private $conn;
    private $id;
    private $title ;
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
}

?>
    private $user_id;
    private $categorie_id;
    public function __construct($db){
    $this ->conn = $db;
    }

    public function getAllRecettes(){
        $sql = 'SELECT r.* , v.username as autheur , c.nom as categorie_nom 
        from recette r 
        inner join visiteur v on r.visiteur_id =v.id
        inner join categorie c  on r.categorie_id = c.id';
        $stmt = $this ->conn -> prepare ($sql);
        $stmt -> execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getOneRecette($id){
        $sql = 'SELECT r.* , c.nom as categorie_nom v.username as autheur
        from recette inner join visiteur v on r.visiteur_id = v.id 
        inner join categorie c on c.id = r.categorie_id
        where r.id = ?';
        $stmt = $this -> conn-> prepare($sql);
        $stmt -> execute (['id']);
return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}







?>
