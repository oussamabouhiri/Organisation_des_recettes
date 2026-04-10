<?php

class Recettecontroller {
 private $db;
 public function __construct($db){
 $this ->db=$db;
 }
 public function listRecette(){
    $Recettemodel= new Recette($this->db);
    $recettes= $Recettemodel->getAllRecettes();
    require_once 'App/views/Acceuil.php';
 }
}





?>