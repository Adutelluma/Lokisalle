<?php

require "config.php";
require "header.php";

$connexion = new PDO ("mysql:host=localhost;dbname=lokisalle",
                        "root",
                        "");

$sql = "SELECT salles.titre, 
                salles.categorie,
                produit.date_arrivee,
                produit.prix
        FROM produit
            JOIN salles
                ON salles.id= produit.id_salle";
                
$stmt= $connexion-> query($sql) ;

echo($stmt);






?>