<?php require "config.php"; 

if(isset($_GET['action']) && $_GET['action'] == "deconnexion")
{
	session_destroy();
}

if(internauteEstConnecte())
{
	header("Location: profil.php");
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Espace Membres</title>
</head>
<body>
	<h1>Connectez vous !</h1>
	<?php require "header.php"; ?>
	<form action="profil.php"  method="post">
		<label>Pseudo : </label>
		<input type="text" name="pseudo">
		<label>Mot de passe : </label>
		<input type="text" name="mdp">
		<button type="submit">Connexion</button>
	</form>
	
<?php
require "footer.php"
?>

</body>
</html>