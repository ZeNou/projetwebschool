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
			
			echo '<meta http-equiv="Refresh" content="0;URL=index.php" />';			
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>ProjetWeb</title>
	
	<link href="css/general.css" rel="stylesheet" type="text/css" />
	
	<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script> 
	<script type="text/javascript" src="js/script.js"></script> 

</head>

<body>

	<div id="contenu">

		<div id="header">
			<ul>
				<li><a href="index.php?page=accueil">Accueil</a></li>
				<?php if(!isset($_SESSION['id'])) echo '<li><a href="index.php?page=inscription">Inscription</a></li>'; ?>
				<?php if(!isset($_SESSION['id'])) echo '<li><a href="index.php?page=login">Login</a></li>'; ?>
				<?php if(isset($_SESSION['id'])) echo '<li><a href="index.php?page=accueil&d=1">Se Déconnecter</a></li>'; ?>
			</ul>
		</div>
		
		<div id="container">
		
			<div id="gauche">
				<?php include(dirname(__FILE__). '/box/menu.php'); ?>
			</div>
			
			<div id="droite">
				
				<?php include(dirname(__FILE__). '/centre.php'); ?>
				
			</div>

		</div>
		
	
		
		<div id="footer">&copy; <?php echo date("Y"); ?>, INSIA - <a href="index.php?page=contact">Contact</a></div>
		
	</div>
		
</body>
</html>