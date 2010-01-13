<?php

if(isset($_SESSION['id']))
{

	echo '<p>Deconnexion en cours...</p>';
	// on détruit toutes les variables de la session en écrasant le tableau
	/*$_SESSION = array();

	// pour détruire complètement la session,
	// il faut effacer également le cookie de session
	// pour ne pas seulement effacer les données de session.
	if (isset($_COOKIE[session_name()])) {
		setcookie(session_name(), '', time()-42000, '/');
	}

	// et on finit par détruire la session
	session_destroy();
	// destruction du cookies avant changement de page
	supprimerCookies();*/

	changePage('index.php', 1);
	
}
else
{
	echo errAcces();	
}
?>