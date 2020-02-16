<?php 
require "config.php";
require "header.php";

$requete = $bdd->query("SELECT
prd.id_produit,
sal.titre,
sal.capacite,
sal.ville,
prd.date_arrivee,
prd.date_depart,
prd.prix,
prd.etat
FROM
produit prd
JOIN salles sal ON
prd.id_salle = sal.id_salle");

// Afficher le tableau de membres

$content="";
$content .= "<table border ='5'>";

for ($i=0; $i < $requete->columnCount() ; $i++) { 
	$colonne = $requete->getColumnMeta($i);
	$content .= "<th>" . $colonne['name'] . '</th>';
}
$content .= "<th>Modifier" . '</th>';
$content .= "<th>Supprimer" . '</th>';

while($ligne = $requete->fetch(PDO::FETCH_ASSOC))
{
	$content .= "<tr>";
	$content .= "<td>" . $ligne['id_produit'] .  "</td>";
	$content .= "<td>" . $ligne['titre'] ."</td>";
	$content .= "<td>" . $ligne['capacite'] ."</td>";
	$content .= "<td>" . $ligne['ville'] ."</td>";
    $content .= "<td>" . $ligne['date_arrivee'] .  "</td>";
    $content .= "<td>" . $ligne['date_depart'] .  "</td>";
	$content .= "<td>" . $ligne['prix'] . "€" . "</td>";
    $content .= "<td>" . $ligne['etat'] .  "</td>";

    $content .= "<td>" . "<a href='modifier_produit.php?id_produit=". $ligne['id_produit'] ."'>Modifier</a>" .  "</td>";
	$content .= "<td>" . "<a href='supprimer_produit.php?id_produit=". $ligne['id_produit'] ."'> Supprimer </a>" .  "</td>";
    $content .= "</tr>";

}


?>

<p style="text-align:center; font-size:40px;"> <a href="ajouter_produit.php" style="color:grey">Ajouter un produit <i class="fas fa-user-plus"></i></a> </p>

<?php
$content .= "</table>";
echo $content;

require "footer.php"
?>