<?php
require "config.php";
require "header.php";

$id= $_SESSION['membre']['id_membre'];
$requete = $bdd->query("SELECT
cmd.id_commande,
cmd.id_produit,
sal.titre,
sal.photo,
sal.capacite,
prd.prix,
prd.date_arrivee,
prd.date_depart
FROM
commande cmd
JOIN produit prd ON
cmd.id_produit = prd.id_produit
JOIN salles sal ON
sal.id_salle = prd.id_salle
WHERE cmd.id_membre=". $_SESSION['membre']['id_membre'] );
?>

<p style="padding-top:150px;text-align:center; font-size:40px; color:grey; ">
Vous avez réservé :
</p>


<?php 
$content="";
$content .= "<table border ='5'>";

for ($i=0; $i < $requete->columnCount() ; $i++) { 
	$colonne = $requete->getColumnMeta($i);
	$content .= "<th>" . $colonne['name'] . '</th>';
}

while($ligne = $requete->fetch(PDO::FETCH_ASSOC))
{
	$content .= "<tr>";
	$content .= "<td>" . $ligne['id_commande'] .  "</td>";
	$content .= "<td>" . $ligne['id_produit'] .  "</td>";
    $content .= "<td>" . $ligne['titre'] . "</td>";
    $content .= "<td>" ."<img src='images/".$ligne['photo'] ."' alt='' >" ."</td>";
	$content .= "<td>" . $ligne['capacite'] . " personnes</td>";
	$content .= "<td>" . $ligne['prix'] ." € </td>";
    $content .= "<td>" . $ligne['date_arrivee'] .  "</td>";
    $content .= "<td>" . $ligne['date_depart'] .  "</td>";
    $content .= "</tr>";
    $content .= "<td>" . "<a href='avis.php?id_produit=". $ligne['id_produit'] ."'> Ajouter un avis </a>" .  "</td>";
}
$content .= "</table>";
echo $content;
?>

<?php require "footer.php"; ?>