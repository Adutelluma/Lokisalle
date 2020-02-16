<?php
require "config.php";


$id_produit = $_GET['id_produit'];

$requete = $bdd->exec("DELETE FROM produit WHERE id_produit = '$id_produit'");

$content .= "Le produit ayant pour id  = " . $id_produit . " a bien été supprimé et vous serez redirigé dans 3 secondes";




echo $content;
header("Refresh:3; URL=afficher_produits.php");
?>