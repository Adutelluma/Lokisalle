<?php
require "config.php";
require "header.php";
?>

<br>
<br>
<br>
<br>
<br>
<div class="misenform">
<p style="text-align:center; font-size:40px; color:grey;">
Affichage des réservations.    
</p>

<?php
$requete = $bdd->query("SELECT
cmd.id_commande,
mbr.pseudo,
sal.titre,
sal.photo,
sal.ville,
cmd.date_enregistrement
FROM
commande cmd
JOIN produit prd ON
cmd.id_produit = prd.id_produit
JOIN salles sal ON
prd.id_salle = sal.id_salle
JOIN membre mbr ON
cmd.id_membre = mbr.id_membre");

// Afficher le tableau des reservations
$content="";
$content .= "<table border ='5'>";

for ($i=0; $i < $requete->columnCount() ; $i++) { 
	# code...
	$colonne = $requete->getColumnMeta($i);
	$content .= "<th>" . $colonne['name'] . '</th>';
}
$content .= "<th>"  . '</th>';

//INSERT INTO `commande` (`id_commande`, `id_membre`, `id_produit`, `date_enregistrement`) VALUES (NULL, '18', '28', '2020-02-09 10:32:19');
while($ligne = $requete->fetch(PDO::FETCH_ASSOC))
{
	$content .= "<tr>";
	$content .= "<td>" . $ligne['id_commande'] .  "</td>";
	$content .= "<td>" . $ligne['pseudo'] .  "</td>";
	$content .= "<td>" . $ligne['titre'] .  "</td>";
	$content .= "<td>" . "<img src='images/" . $ligne['photo'] ."' alt='' >" .  "</td>";
	$content .= "<td>" . $ligne['ville'] .  "</td>";
    $content .= "<td>" . $ligne['date_enregistrement'] .  "</td>";

	$content .= "<td>" . "<a href='supprimer_commande.php?id_commande=". $ligne['id_commande'] ."'> Supprimer </a>" .  "</td>";
    $content .= "</tr>";
  
}

  $content .= "</table>";
    echo $content;



require "footer.php"
?>