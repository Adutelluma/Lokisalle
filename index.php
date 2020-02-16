<?php
require "config.php"; 
require "header.php"; 
?>
<div style="border:black 1px solid;margin-top:100px;margin-right:200px; margin-left:200px; text-align:center">
<h1 >Lokisalle, la référence de la réservation de salles<br> pour les professionnels et particuliers.</h1>

<p style="text-align:center; font-size:20px; margin-top:20px">Fiers de nos salles, nous les proposons à la location depuis maintenant 25 ans. <br>
Nos clients aiment réserver nos salles qui ont chacune une identité qui lui est propre. <br>
Venez apprécier nos salles dans les villes de Paris, Lyon et Marseille !</p>
</div>
<?php
$req = $bdd->prepare('SELECT DISTINCT categorie FROM salles'); //  permet de récupérer les différentes sortes de salles (reunion, bureau, formation)
$req->execute();
$categories = $req->fetchAll();

$req = $bdd->prepare('SELECT DISTINCT ville FROM salles'); //  permet de récupérer les différentes sortes de villes 
$req->execute();
$villes = $req->fetchAll();

$req = $bdd->prepare('SELECT capacite, id_salle FROM salles GROUP BY capacite ASC'); // récupère les capacités des salles
$req->execute();
$capacites = $req->fetchAll();

$where="produit.etat = 'libre' "; // permet d'ajouter le statut "libre" au recherches

if ($_POST){

	if(!empty($_POST['ville'])){
		$where .= " AND salles.ville = \"".$_POST['ville']. " \""; // filtre en fonction de la ville

	}
	if(!empty($_POST['categorie'])){
		$where .= " AND salles.categorie = \"" . $_POST['categorie']. "\""; // filtre en fonction de la catégorie(formation etc)
	} 
	if(!empty($_POST['capacite'])){
		$where .= " AND salles.capacite >=  ". $_POST['capacite']; // filtre en fonction de sa capacité
	} 
	if(!empty($_POST['date_arrivee'])){
		$where .= " AND produit.date_arrivee <= \"" . $_POST['date_arrivee']. "\""; // filtre en fonction de la date arrivée
		$where .= " AND produit.date_depart >= \"" . $_POST['date_arrivee']. "\""; // ajout d'une sécurité si date_depart est vide

	} 
	if(!empty($_POST['date_depart'])){
		$where .= " AND produit.date_depart >= \"" . $_POST['date_depart']. "\""; // filtre en fonction de la date départ
		$where .= " AND produit.date_arrivee <= \"" . $_POST['date_depart']. "\""; // sécurité si date_arrivee n'est pas indiqué

	} 
	if(!empty($_POST['prix'])){
		$where .= " AND produit.prix <= \"" . $_POST['prix']. "\""; // filtre sur les prix inférieurs a ce qui est donné
	}
}

// récupération des informations nécessaires pour mon affichage
$req = $bdd->prepare('SELECT salles.id_salle, salles.titre, salles.description, salles.photo,
salles.ville, salles.adresse, salles.cp, salles.capacite, salles.categorie, DATE_FORMAT(date_arrivee, \'%d/%m/%Y\')
AS date_arrivee, 
DATE_FORMAT(date_depart, \'%d/%m/%Y\') 
AS date_depart, produit.prix, produit.etat , produit.id_produit
FROM salles
JOIN produit
ON salles.id_salle = produit.id_salle
WHERE '.$where.' AND date_arrivee > NOW()
ORDER BY produit.date_arrivee ASC');

$req->execute();
$salles = $req->fetchAll();
?>

<!-- Filtrage des données -->

<div class="container" style="padding-top:120px; padding-bottom:50px">
        
	<form action="index.php" method="post">
		<div class="alert alert-info">

		<!-- catégorie -->
			<p >Catégorie</p>
			<?php foreach($categories as $categorie){?>
			<div class="radio">
				<label>
				<input  name="categorie" value="<?php echo $categorie['categorie'];?>" type="radio">
				<?php echo ($categorie['categorie']);?>
				</label>
			</div>
			<?php }?>
		</div>
		
		<div class="alert alert-info">

			<!-- Ville  -->
			<p>Ville</p>
			<?php foreach($villes as $ville){?>
			<div class="radio">
				<label>
				<input  name="ville" value="<?php echo $ville['ville'];?>" type="radio">
				<?php echo ($ville['ville']);?>
				</label>
			</div>
			<?php }?>
		</div>

		<!-- capacité -->
		<p>Capacité</p>
		<div>
			<select name="capacite">
			<option value="0">Capacité minimale de votre salle</option>
			<?php foreach($capacites as $capacite){?>
				<option value="<?php echo $capacite['capacite'];?>"><?php echo $capacite['capacite'];?></option>
			<?php }?>
			</select>
		</div>
		<!-- Prix -->
		<p >Prix</p>
		<div class="list-group">
			<input  name="prix" type="text" class="span2" value="" data-slider-min="10" data-slider-max="1000" data-slider-step="5" 
			data-slider-value="[250,450]"/> <b>€</b>
		</div>

		<div>
			<!-- Période -->
			<p >Période</p>
				
				<label>Date d'arrivée</label>
					<input type='date' name="date_arrivee" />
					<span class="glyphicon glyphicon-calendar"></span>
			
				<label>Date de départ</label>
					<input type='date' name="date_depart" />
					<span class="glyphicon glyphicon-calendar"></span>
					
		</div>
		<br>
		

		<button type="submit" class="btn btn-default">Chercher</button> <br>
	<hr>
	</form>
</div>
			
<!-- Affichage des salles           -->

<div class="row">
	<?php 
		if ($salles == false){
			echo "Il n'y a pas de propositions pour votre sélection, modifiez votre demande s'il vous plaît.";
		}else{
		foreach($salles as $salle)
		{?>
		<div class="col-sm-4 col-lg-4 col-md-4">
			<div class="thumbnail">
				<div>
				<a href="fiche_produit.php?id_produit=
				<?php
				echo $salle['id_produit']; 

				?>">
				<img style="max-height:150px" src="images/<?php echo $salle['photo'];?>" alt="la salle <?php echo $salle['titre'];?>"></a>
				</div>

				<div class="caption">
					<h4 class="pull-right"><?php echo $salle['prix'];?> €</h4>
					<h4><a href="fiche_produit.php?id_produit=<?php echo $salle['id_produit'];?>"><?php echo $salle['titre'];?></a>
					</h4>
					<p><?php echo mb_strimwidth($salle['description'], 0, 65, '...');?></p>
					<p class="glyphicon glyphicon-calendar"> <?php echo $salle['date_arrivee'].' au '.$salle['date_depart'];?></p>
				</div>

				<div class="ratings" style="text-align:right">
					
				<a href="fiche_produit.php?id_produit=<?php echo $salle['id_produit'];?>"><p class="glyphicon glyphicon-search" > Voir </p></a>
					</p>
					
			
				</div>

			</div>
		</div>
	<?php }
	}
	?>
</div> 


<?php
require "footer.php"; ?>