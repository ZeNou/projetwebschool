<?php

if(isset($_SESSION['id']))
{

	echo '<p>Deconnexion en cours...</p>';
	// on d�truit toutes les variables de la session en �crasant le tableau
	/*$_SESSION = array();

	// pour d�truire compl�tement la session,
	// il faut effacer �galement le cookie de session
	// pour ne pas seulement effacer les donn�es de session.
	if (isset($_COOKIE[session_name()])) {
		setcookie(session_name(), '', time()-42000, '/');
	}

	// et on finit par d�truire la session
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