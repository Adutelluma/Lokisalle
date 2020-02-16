<?php

//CONNEXION A LA BDD

try {

	$bdd = new PDO('mysql:host=localhost;dbname=lokisalle;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
 
// connexion bdd hébergeur

  // $bdd = new PDO('mysql:host=sql25;dbname=biw42671;charset=utf8', 'biw42671', 'khiQ8ls4HGYu', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

} catch (Exception $e) {

	die("Erreur : " . $e->getMessage());

}

//SESSION
session_start();

//VARIABLES
$content = "";

//CHEMIN
define("RACINE_SITE", "/espace_membre/");

//INCLUSIONS
require_once ("function.php");