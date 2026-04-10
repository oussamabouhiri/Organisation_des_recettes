<?php


class Recette {
    
private $conn;
    private $id;
    private $title ;
    private $ingredients;
    private $instructions;
    private $portions;
    private $temps;
    private $rating;
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