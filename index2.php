<?php require "config.php"; 
require "header.php"; 

?>


<?php
$requete = $bdd->prepare("SELECT salles.titre, salles.capacite, salles.categorie, salles.ville, produit.prix 
							FROM salles, produit
							WHERE produit.id_salle= salles.id_salle ");
$requete->bindParam(":ville", $_POST['ville'], PDO::PARAM_STR);
$requete->execute();
$resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
if(empty ($content))
foreach ($resultat as $key => $value) {

	$content .= "<p>";
	
	// partie qui affiche toutes les salles
    foreach ($value as $key2 => $value2) {
        $content .= "<strong>".$key2."</strong> : " . $value2 . "<br>";
    }
    
} else {



$content="";
$requete = $bdd->prepare("SELECT titre, capacite, categorie, ville FROM salles WHERE ville = :ville");
$requete->bindParam(":ville", $_POST['ville'], PDO::PARAM_STR);
$requete->execute();
$resultat = $requete->fetchAll(PDO::FETCH_ASSOC);


$i = 0;

echo "<h3>Salles de  ". $_POST['ville']  ."</h3>";

foreach ($resultat as $key => $value) {

    $content .= "<p>";
    foreach ($value as $key2 => $value2) {
        $content .= "<strong>".$key2."</strong> : " . $value2 . "<br>";
    }

}

}
?>

<form method="post">
<label >Saisir une ville</label>
<input type="ville" name="ville">
<input type="submit" value="Chercher">

</form>

<p>
        <label for="categorie">type de salle :</label><br>
		<input type="radio" name="categorie" value="reunion"> Réunion<br>
		<input type="radio" name="categorie" value="bureau"> Bureau<br>
		<input type="radio" name="categorie" value="formation"> Formation<br>
        
    </p>  

<input type="submit" value="Chercher">
<?php echo $content; 

require "footer.php"; ?>