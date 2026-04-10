<?php

class Categorie {
    private $conn;
    private $table = "categorie";

    private $id;
    private $nom;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Getters
    public function getId() { return $this->id; }
    public function getNom() { return $this->nom; }

    // Setters
    public function setId($id) { $this->id = $id; }
    public function setNom($nom) { $this->nom = $nom; }

    // Get all categories
    public function getAll() {
        $sql = "SELECT * FROM {$this->table} ORDER BY nom";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Get a category by ID
    public function getById($id) {
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}

?>
