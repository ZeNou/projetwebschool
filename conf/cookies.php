<?php

if (isset($_GET['c'])) { // si le get 'c' est sur 1 et si il nya pas de cookies alors on le créée

	$encrypt = base64_encode($_SESSION['hashcook']);

	creeCookies($encrypt);
	
}



if (isset($_COOKIE['sid']) AND !isset($_SESSION['id']) AND !isset($_GET['d']) AND !empty($_COOKIE['sid']))
{
	// On récupère le cookie et on le décrypte :
	$decrypt 				= base64_decode($_COOKIE['sid']);

	// On récupère l'user agent de l'internaute sachante qu'il commence a partir du 5e caractère et qu'il en fait 40.
	$get_user_agent 	= substr($decrypt, 5, 40);
	// on retire l'user agent pour extraire l'uniq id de l'utilisateur
	$get_uniqid 			= str_replace($get_user_agent, '',$decrypt);
	
	/*
	 * Si l'user argent du cookies correspond bien à celui qui vien d'arriver sur le site, alors on le log
	 * sinon on détruit le cookies par mesure de sécurité
	 */
	if( $get_user_agent == sha1($_SERVER['HTTP_USER_AGENT']) )
	{
	
	
		$cook_log		= new Sql();
		
		
		$cook_verif 	= Req($cook_log,'SELECT id
																FROM '.tblmembres.'
																WHERE uniqid = \''.$get_uniqid.'\'');

																
		if ($cook_verif == 1)
		{
			
			$tab_infos =	Tab($cook_log,'SELECT id, pseudo, email, niveau_id, langue_id, parrain
																FROM '.tblmembres.'
																WHERE uniqid = \''.$get_uniqid.'\'');

			$_SESSION['id'] 				= $tab_infos[0]['id'];
			$_SESSION['pseudo'] 		= $tab_infos[0]['pseudo'];
			$_SESSION['email'] 		= $tab_infos[0]['email'];
			$_SESSION['niveau_id'] 	= $tab_infos[0]['niveau_id'];
			$_SESSION['langue_id'] 	= $tab_infos[0]['langue_id'];
			$_SESSION['parrain'] 		= $tab_infos[0]['parrain'];
			
			
		}else{
		
			supprimerCookies();
		
		}
	
		$cook_log->Close();

		
	}else{
	
		supprimerCookies();
	
	}

}
	
?>