<?php

/*
 * Si la variable est déclaré et qu'elle a des caractères du style "aazsfdf-fdqd"
 * alors on cherche le fichier correspondant au nom de la variable.
 */
 //bla
isset($_GET['page']) && (preg_match('/^[a-z-]{3,10}$/', $_GET['page'])) ? $page = trim($_GET['page']) : $page = 'erreur';

if(isset($_GET['page'])){
	
	$page = trim($_GET['page']);

	$page = dirname(__FILE__).'/inc/' . $page . '.inc.php';
	
	if (in_array($page, glob(dirname(__FILE__).'/inc/*.inc.php'))) {
		
	    include($page);
	    
	}else{
		
		include(dirname(__FILE__).'/inc/erreur.inc.php');
		
	}
}else{
	
	include(dirname(__FILE__).'/inc/accueil.inc.php');
	
}

?>