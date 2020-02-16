<?php
require "config.php"; 
require "header.php"; 



$categories = get_categories();
$villes = get_villes();
$capacites = get_capacites();
$salles = get_salles();

function get_categories()
{
	global $bdd;
	$req = $bdd->prepare('SELECT DISTINCT categorie FROM salles'); //  permet de récupérer les différentes sortes de salles (reunion, bureau, formation)
	$req->execute();
    $categories = $req->fetchAll();
	
    return $categories;
}

function get_villes()
{
	global $bdd;
	$req = $bdd->prepare('SELECT DISTINCT ville FROM salles'); //  permet de récupérer les différentes sortes de villes 
	$req->execute();
	$villes = $req->fetchAll();
	
	return $villes;
}

function get_capacites()
{
	global $bdd;
	$req = $bdd->prepare('SELECT capacite, id_salle FROM salles GROUP BY capacite ASC');
	$req->execute();
	$capacites = $req->fetchAll();
	
	return $capacites;
}

function get_salles()
{
	global $bdd;
	$req = $bdd->prepare('SELECT salles.id_salle, salles.titre, salles.description, salles.photo,
     salles.ville, salles.adresse, salles.cp, salles.capacite, salles.categorie, DATE_FORMAT(date_arrivee, \'%d/%m/%Y\')
        AS date_arrivee_fr, 
     DATE_FORMAT(date_depart, \'%d/%m/%Y\') 
        AS date_depart_fr, produit.prix, produit.etat 
							FROM salles
								LEFT JOIN produit
									ON salles.id_salle = produit.id_salle
										WHERE produit.etat = "libre"
											AND date_arrivee > NOW()
												ORDER BY id_salle');
	$req->execute();
	$salles = $req->fetchAll();
	
    return $salles;

}
?>
    <div class="container">

        
			<form action="index.php" method="post">
				<div class="alert alert-info">
					<produit >Catégorie</produit>
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
					<produit >Ville</produit>
					<?php foreach($villes as $ville){?>
					<div class="radio">
						<label>
						<input  name="ville" value="<?php echo $ville['ville'];?>" type="radio">
						<?php echo ($ville['ville']);?>
						</label>
					</div>
					<?php }?>
				</div>
				<produit>Capacité</produit>
                <div>
					<select name="capacite">
					<?php foreach($capacites as $capacite){?>
						<option value="<?php echo $capacite['capacite'];?>"><?php echo $capacite['capacite'];?></option>
					<?php }?>
					</select>
				</div>
				<produit >Prix</produit>
                <div class="list-group">
                    <input  name="prix" type="text" class="span2" value="" data-slider-min="10" data-slider-max="1000" data-slider-step="5" 
                    data-slider-value="[250,450]"/> <b>€</b>
				</div>
				<div>
                <produit >Période</produit>
                    
					<label>Date d'arrivée</label>
						<input type='date' name="date_arrivee" />
					
							<span class="glyphicon glyphicon-calendar"></span>
						</span>
				
					<label>Date de départ</label>
					
						<input type='date' name="date_depart" />
					
							<span class="glyphicon glyphicon-calendar"></span>
						</span>
				
				</div>
				<hr>
				<button type="submit" class="btn btn-default">Chercher</button>
			</form>
            </div>
			
           
        <div class="row">
                <?php foreach($salles as $salle)
                {?>
                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <img src="images/<?php echo $salle['photo'];?>" alt="la salle <?php echo $salle['titre'];?>">
                            <div class="caption">
                                <h4 class="pull-right"><?php echo $salle['prix'];?> €</h4>
                                <h4><a href="index.php?section=salle&id=<?php echo $salle['id_salle'];?>&ville=<?php echo $salle['ville'];?>"><?php echo $salle['titre'];?></a>
                                </h4>
                                <produit><?php echo mb_strimwidth($salle['description'], 0, 65, '...');?></produit>
								<produit class="glyphicon glyphicon-calendar"> <?php echo $salle['date_arrivee_fr'].' au '.$salle['date_depart_fr'];?></produit>
                            </div>
                            <div class="ratings">
                                <produit style="color:black" class="pull-right glyphicon glyphicon-search">
                                <a href="index.php?section=salle&id=<?php echo $salle['id_salle'];?>&ville=<?php echo $salle['ville'];?>">Voir</a></produit>
                                <produit>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                </produit>
                            </div>
                        </div>
                    </div>
				<?php }?>
                </div> 

      

 </div>    <!-- div container de bootstrap -->

<?php
require "footer.php"; ?>