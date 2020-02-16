<?php

require "config.php";
require "header.php";

$content="";
$requete="";
if(isset($_GET['id_membre'])) $id_membre= $_GET['id_membre'];
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$requete = $bdd->query("SELECT * FROM membre WHERE id_membre = '$id_membre'");
$resultat = $requete->fetch(PDO::FETCH_ASSOC);

$pseudo = $resultat['pseudo'];
$titre = $resultat['titre'];
$nom = $resultat['nom'];
$prenom = $resultat['prenom'];
$mdp = $resultat['mdp'];
$email = $resultat['email'];
$admin =$resultat['admin'];

if($_POST){
	$requete = $bdd->prepare("UPDATE membre SET pseudo = :pseudo, titre = :titre, nom = :nom,  prenom= :prenom, mdp = :mdp,
    email= :email, admin=:admin WHERE id_membre = '$id_membre'");

	$requete->execute(array(
		"pseudo" => $_POST['pseudo'],
		"titre" => $_POST['titre'],
        "nom" => $_POST['nom'],
        "prenom" =>$_POST['prenom'],
        "mdp" => $_POST['mdp'],
        "email" => $_POST['email'],
        "admin" => $_POST['admin'],
	));
    echo "<p style='color:green;font-style:bold; text-align:center'>Modification réussi !</p>";
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>
		Modifier les informations d'un membre
	</title>
</head>
<body>
<p style="text-align:center; font-size:40px; color:grey"> Modifier / Corriger les informations d'un membre </p>

<!-- Accès au formulaire  de modification -->

<form action="" method="post" class="inscription">
    <p>
        <label for="pseudo">Pseudo</label><br>
        <input type="text" name="pseudo" value="<?php echo $pseudo ?>">
    </p>  

    <p>
        <label for="titre">Titre</label><br>
        <input type="radio" name="titre" value="mr"> Homme<br>
        <input type="radio" name="titre" value="mme"> Femme<br>
    </p>  

    <p>
        <label for="nom">Nom *</label><br>
        <input type="text" name="nom" value="<?php echo $nom ?>">
    </p>    

    <p>
        <label for="prenom">Prenom * </label><br>
        <input type="text" name="prenom" value="<?php echo $prenom ?>">
    </p>  

    <p>
        <label for="mdp">Mot de Passe </label><br>
        <input type="text" name="mdp" value="<?php echo $mdp ?>">
    </p>  

    <p>
        <label for="email"> Email </label><br>
        <input type="text" name="email" value="<?php echo $email ?>">
    </p> 

    <p>
        <label for="admin">type de compte :</label><br>
    	<input type="radio" name="admin" value="0"> Membre<br>
        <input type="radio" name="admin" value="1"> Admin<br>
    </p>  

    <button type="submit">Modifier</button>

</form>

<?php 
require "footer.php"
?>
