<?php
require "config.php";
require "header.php";

$id= $_SESSION['membre']['id_membre'];
$id_salle="";
$requete = $bdd->query("SELECT
prd.id_produit,
sal.id_salle,
sal.titre,
sal.photo,
sal.capacite,
sal.ville,
prd.date_arrivee,
prd.date_depart,
prd.prix,
prd.etat
FROM
produit prd
JOIN salles sal ON
prd.id_salle = sal.id_salle
JOIN commande cmd ON cmd.id_produit=prd.id_produit
WHERE prd.id_produit=" .  $_GET['id_produit']." 
 AND $id = cmd.id_membre
 ORDER BY date_enregistrement DESC
");

$content="";
$content .= "<table border ='5'>";

for ($i=0; $i < $requete->columnCount() ; $i++) { 
	# code...
	$colonne = $requete->getColumnMeta($i);
	$content .= "<th>" . $colonne['name'] . '</th>';
}

while($ligne = $requete->fetch(PDO::FETCH_ASSOC))
{
	$content .= "<tr>";
    $content .= "<td>" . $ligne['id_produit'] .  "</td>";
    $content .= "<td>" . $ligne['id_salle'] . "</td>";
    $content .= "<td>" . $ligne['titre'] . "</td>";
    $content .= "<td>" ."<img src='images/".$ligne['photo'] ."' alt='' >" ."</td>";
	$content .= "<td>" . $ligne['capacite'] . " personnes</td>";
	$content .= "<td>" . $ligne['ville'] ."</td>";
    $content .= "<td>" . $ligne['date_arrivee'] .  "</td>";
    $content .= "<td>" . $ligne['date_depart'] .  "</td>";
	$content .= "<td>" . $ligne['prix'] . "€" . "</td>";
    $content .= "<td>" . $ligne['etat'] .  "</td>";

    $content .= "</tr>";
    
    $id_salle=$ligne['id_salle'] ;
}

// ajout de la requête AVIS
$reponse = $bdd -> query('SELECT id_avis, id_membre , id_salle, commentaire, note, date_enregistrement
                            from avis
                           
                        ');
$produits = $reponse->fetchAll();


if (isset ($_POST['note']))
{
    $id_membre=$id;
    $commentaire = $_POST['commentaire'];
    $note = $_POST['note'];
 


// INSERT INTO `avis` (`id_avis`, `id_membre`, `id_salle`,
// `commentaire`, `note`, `date_enregistrement`) VALUES (NULL, '17', '5', 'Très jolie salle', '4', current_timestamp());

   $requete = $bdd->exec("INSERT INTO avis (id_membre , id_salle, commentaire, note)
   VALUES ('$id_membre', '$id_salle', '$commentaire', '$note')");
    
    echo "<p style='color:red; text-align:center'> Merci pour votre avis ! </p>";
}  
?>
<p style="padding-top:150px;text-align:center; font-size:40px; color:grey; ">
Votre avis pour votre réservation  
</p>

<?php 
$content .= "</table>";
echo $content;
?>
<?php  
$checkAvis = $bdd->query(
"SELECT 
a.commentaire, 
a.note
FROM avis a
WHERE a.id_membre =". $id . " 
AND a.id_salle=" . $id_salle
);
$avis = $checkAvis->fetchAll();

if (empty($avis) ){
echo "
    <form method='post'>

    <p>
        <label for='commentaire'>Commentaire :</label><br>
        <textarea name='commentaire' value='votre commentaire' cols='30' rows='10'></textarea>
    </p> 
    <p>
        <select name='note'>
        <option value=''>--Votre note--</option>
        <option value='1'>1</option>
        <option value='2'>2</option>
        <option value='3'>3</option>
        <option value='4'>4</option>
        <option value='5'>5</option>
        </select>
    </p> 
    <p>
    <button type='submit'>Envoyer</button>
    </p>
    </form>
";
} else {
    echo " <p  style='padding-top:150px;text-align:center; font-size:40px; color:grey;'> Vous avez mis la note de  : " . $avis[0]['note'] . "/5" . "<br>"; 
    echo "Vous avez mis comme commentaire : " .  $avis[0]['commentaire'] . "<br> </p> ";
    }

require "footer.php";
?>