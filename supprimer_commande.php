<?php
require "config.php";

$id_commande = $_GET['id_commande'];

$req = $bdd ->query("SELECT
    c.id_produit
    FROM commande c
    WHERE c.id_commande='$id_commande'
"
);

$result = $req->fetchAll();

var_dump ($result);

$requete= $bdd-> exec("UPDATE produit SET etat = 'libre' WHERE id_produit=". $result[0]['id_produit'] ) ; 



$requete = $bdd->exec("DELETE FROM commande WHERE id_commande = '$id_commande'");

$content .= "La commande ayant pour id  = " . $id_commande . " a bien été supprimée et vous serez redirigé dans 3 secondes";




echo $content;
header("Refresh:3; URL=afficher_reservation.php");
?>