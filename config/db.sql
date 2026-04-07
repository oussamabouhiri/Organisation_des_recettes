
CREATE DATABASE recette_app;
USE recette_app;

CREATE TABLE visiteur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE categorie (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE recette (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    ingredients TEXT NOT NULL,
    instructions TEXT NOT NULL,
    portions INT,
    temps INT, 
    rating FLOAT DEFAULT 0,

    visiteur_id INT,
    categorie_id INT,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (visiteur_id) REFERENCES visiteur(id)
        ON DELETE CASCADE,

    FOREIGN KEY (categorie_id) REFERENCES categorie(id)
        ON DELETE SET NULL
);