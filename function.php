<?php

// fonctions admin / membre

function internauteEstConnecte()
{
	if(!isset($_SESSION['membre'])) return false;
	else return true;
}

function internauteEstConnecteEtEstAdmin()
{
	if(internauteEstConnecte() && $_SESSION['membre']['admin'] == 1) return true;
	else return false;
}
?>
