<?php
@session_start();
mb_internal_encoding ('UTF-8');
//echo mb_internal_encoding(); afficher lencodage en cours.
include_once(dirname(__FILE__). '/conf/config.php');
include_once(dirname(__FILE__). '/conf/fonctions.php');
include_once(dirname(__FILE__). '/conf/cookies.php');

if (isset($_GET['d']) && isset($_SESSION['id'])) {
			
			$_SESSION = array();

			// pour détruire complètement la session,
			// il faut effacer également le cookie de session
			// pour ne pas seulement effacer les données de session.
			if (isset($_COOKIE[session_name()])) {
				setcookie(session_name(), '', time()-42000, '/');
			}

			// et on finit par détruire la session
			session_destroy();
			// destruction du cookies avant changement de page
			supprimerCookies();
			
			echo "<meta http-equiv=\"Refresh\" content=\"0;URL=?p=1\" />";
			
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>dizSurf</title>
	
	<link href="css/general.css" rel="stylesheet" type="text/css" />
	
	<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script> 

</head>

<body>
	
	<div id="page">
		
		<?php include(dirname(__FILE__). '/centre.php'); ?>
		
	</div>
	
	
</body>
</html>