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
	<title>ProjetWeb</title>
	
	<link href="css/general.css" rel="stylesheet" type="text/css" />
	
	<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script> 

</head>

<body>

	<div id="contenu">

		<div id="header">
			<ul>
				<li><a href="index.php?page=accueil">Accueil</a></li>
				<li><a href="index.php?page=inscription">Inscription</a></li>
				<li><a href="index.php?page=login">Login</a></li>
			</ul>
		</div>
		
		<dl id="menu">
			<dt><a href="index.php?page=article&amp;rubrique=1">Rubrique 1</a></dt>
			<dd>
				<ul>
					<li><a href="index.php?page=article&amp;article=1">article 1.1</a></li>
					<li><a href="index.php?page=article&amp;article=2">article 1.2</a></li>
					<li><a href="index.php?page=article&amp;article=3">article 1.3</a></li>
				</ul>
			</dd>
			<dt><a href="index.php?page=article&amp;rubrique=2">Rubrique 2</a></dt>
			<dd>
				<ul>
					<li><a href="index.php?page=article&amp;article=4">article 2.1</a></li>
					<li><a href="index.php?page=article&amp;article=5">article 2.2</a></li>
					<li><a href="index.php?page=article&amp;article=6">article 2.3</a></li>
				</ul>
			</dd>
			<dt><a href="index.php?page=article&amp;rubrique=3">Rubrique 3</a></dt>
			<dd>
				<ul>
					<li><a href="index.php?page=article&amp;article=7">article 3.1</a></li>
					<li><a href="index.php?page=article&amp;article=8">article 3.2</a></li>
					<li><a href="index.php?page=article&amp;article=9">article 3.3</a></li>
				</ul>
			</dd>
		</dl>
		
		<div id="page">
			
			<?php include(dirname(__FILE__). '/centre.php'); ?>
			
		</div>
		
		<p id="footer">&copy; <?php echo date("Y"); ?>, INSIA - <a href="index.php?page=contact">Contact</a></p>
		
	</div>
		
</body>
</html>