
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="shortcut icon" type="image/ico" href="favicon.ico"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="text.css" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/83004e9897.js" crossorigin="anonymous"></script>

<title>Lokisalle, la référence en solution de réservation de salles en France</title>

</head>

<a href="index.php" ><img src="loki.png" alt="logo de Lokisalle" class="loki"></a>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">Lokisalle - Accueil</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="qui_sommes_nous.php">Qui sommes nous</a></li>
      <li><a href="contact.php">Nous contacter</a></li>
    </ul>
  </div>
</nav>
<nav class="navbar navbar-left" style="margin-right:20px">
	<ul>
		<?php if(internauteEstConnecteEtEstAdmin()) { ?>
				<li><a href="afficher_membre.php">Gestion membres</a></li>
				<li><a href="gestion_reservation.php">Gestion des réservations et des produits</a></li>
				<li><a href="salles.php">Gestion des salles</a></li>
        <li><a href="avisAll.php">Gestion des avis</a></li>
        <li><a href="kpi.php">KPI</a></li>
    <?php } ?>

</nav>  
  <nav class="navbar navbar-right" style="margin-right:20px">
    <?php if(internauteEstConnecte()){ ?>
					<li><a href="profil.php">Mon Profil</a></li>
          <!-- <li><a href="avisClient.php">Mes avis</a></li> -->
          <li><a href="reservationsClient.php">Mes réservations et avis à laisser</a></li>
					<li><a href="connexion.php?action=deconnexion">Deconnexion</a></li>
		<?php } else { ?>
					<li><a href="connexion.php">Connexion</a></li>
					<li><a href="inscription.php">Créer un compte</a></li>
		<?php } ?>
		
	</ul>
</nav>