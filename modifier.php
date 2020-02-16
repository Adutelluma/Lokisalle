<?php 
require "header.php";
require "config.php";

$titre = $resultat['titre'];
$description = $resultat['description'];
$photo = $resultat['photo'];
$pays = $resultat['pays'];
$ville = $resultat['ville'];
$adresse = $resultat['adresse'];
$cp = $resultat['cp'];
$capacite = $resultat['capacite'];
$categorie = $resultat['categorie'];

if($_POST)
{
	$requete = $bdd->prepare("UPDATE salles SET titre = :titre, description = :description, photo = :photo,  pays= :pays, ville = :ville,
    adresse= :adresse, cp = :cp, capacite = :capacite, categorie= :categorie  WHERE id_salle = '$id_salle'");

	$requete->execute(array(
        "titre" => $_POST['titre'],
		"description" => $_POST['description'],
        "photo" => $_POST['photo'],
        "pays" =>$_POST['pays'],
        "ville" => $_POST['ville'],
        "adresse" => $_POST['adresse'],
        "cp" => $_POST['cp'],
        "capacite" => $_POST['capacite'],
        "categorie" => $_POST['categorie'],
	));

	$content .= "<p style='color:green;font-style:bold;'>Modification réussi !</p>";

}

?>
<!DOCTYPE html>
<html>
<head>
	
</head>
<body>
	<h2>Modifier une salle</h2>
<form action="" method="post">

    <p>
        <label for="titre">Titre *</label><br>
        <input type="text" name="titre"value="<?php echo $titre ?>">
    </p>    

    <p>
        <label for="description">Description * </label><br>
        <input type="text" name="description" value="<?php echo $description ?>">
    </p>  

    <p>
        <label for="photo">photo</label><br>
        <input type="file" name="photo" value="<?php echo "<img src='" . $ligne['photo'] ."' alt='' >" ?>">
    </p>  

    <p>
        <label for="pays">Profession</label><br>
        <input type="text" name="pays" value="<?php echo $pays ?>">
    </p>  


    <p>
        <label for="ville">Ville</label><br>
        <input type="name" name="ville" value="<?php echo $ville ?>">
    </p>  

    <p>
        <label for="adresse">Adresse</label><br>
        <textarea type="text" name="adresse" value="<?php echo $adresse ?>">> </textarea>
    </p> 

    <p>
        <label for="cp">Code postal</label><br>
        <input type="name" name="cp" value="<?php echo $cp ?>">
    </p>  

    <p>
        <label for="capacite">Capacité de la salle</label><br>
        <input type="number" name="capacite" value="<?php echo $capacite ?>">
    </p>  

    <p>
        <label for="categorie"> Categorie</label><br>
        <option value="réunion"> Salle de réunion</option>
        <option value="bureau"> Bureau</option><br>
        <option value="formation"> Salle de formation</option><br>
    </p>  

    <button type="submit">Modifier</button>

    </form>
    
	<?php echo $content; ?>