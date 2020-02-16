<?php 

require "config.php";
require "header.php";

if(isset($_GET['id_salle'])) $id_salle= $_GET['id_salle'];
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$requete = $bdd->query("SELECT * FROM salles WHERE id_salle = '$id_salle'");

$resultat = $requete->fetch(PDO::FETCH_ASSOC);

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

	echo "Modification réussi !";

}

?>
<!DOCTYPE html>
<html>
<head>
	
</head>
<body>
<p style="text-align:center; font-size:40px;">
    <a href="ajouter_membre.php" style="color:grey">
        <h1>Modification de la salle <?php echo $titre  ?></h1>
    </a>
</p>


<form action="" method="post">

    <p>
        <label for="titre">Titre *</label><br>
        <input type="text" name="titre"value="<?php echo $titre ?>">
    </p>    

    <p>
        <label for="description">Description * </label><br>
        <textarea name="description" rows="4" cols="50"> <?php echo $description ?></textarea>
    </p>  

    <p>
    <input type="file" id="photo" name="photo"><br><br>
<?php 
    
    echo "<i>Vous pouvez uplaoder une nouvelle photo si vous souhaitez la changer</i><br>";
    echo '<img src="images/' . $resultat['photo'] . '" ="90" height="90"><br>';
    
 ?>   
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
        <textarea type="text" name="adresse" ><?php echo $adresse ?> </textarea>
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
        <label for="categorie">Catégorie</label><br>
            <input type="radio" name="categorie" value="réunion">Salle de réunion</option>
           <input type="radio" name="categorie"  value="bureau">Bureau</option>
           <input type="radio" name="categorie"  value="formation">Salle de formation</option>
    </p>
    <button type="submit">Envoyer</button>

    </form>


    <?php 
        require "footer.php";

    ?>