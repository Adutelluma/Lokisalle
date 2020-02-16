<?php
require "config.php";

$erreurauth=false;
if($_POST)
{
	$pseudo = htmlentities($_POST['pseudo'], ENT_QUOTES) ;
	$mdp = htmlentities($_POST['mdp'], ENT_QUOTES);

	$req = $bdd->query("SELECT * FROM membre WHERE pseudo = '$pseudo' AND mdp = '$mdp'");

	$resultat = $req->fetch(PDO::FETCH_ASSOC);
	if ($resultat==false){
		$erreurauth=true;
	}else{
		foreach ($resultat as $key => $value) {
			if($key != "mdp")
			{
				$_SESSION['membre'][$key] = $value;
			}
		}
	}	

}

// on met le header ici et non après le config car sinon ça appelle d'abord le header puis ça fait la demande des infos.
//En le mettant à cet endroit j'ai les infos d'enregistrées et après je lance le header
require "header.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Page de profil</title>
</head>
<body>
	

<?php	
if(internauteEstConnecte())
	{
		echo "<h3>Voici toutes vos informations : </h3>";
	} else {
		if ($erreurauth){
			echo "<h1>Erreur d'authentification :</h1> La combinaison Pseudo / Mot de passe est incorrecte. <br>";
		}
		echo "Connectez-vous en cliquant <a href='connexion.php'>ici </a> !";
	}

	foreach ($_SESSION as $key => $value) {
		foreach ($value as $key2 => $value2) {
			echo "<p>$key2 = $value2</p>";
 		}
	}
	?>

<?php
	require "footer.php"
?>
</body>
</html>