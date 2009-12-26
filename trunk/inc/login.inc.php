<?php

if(!isset($_SESSION['id']))
{
	echo '<h1>Identifiez-vous</h1>';

	$form_loggin = new Form('formulaire_identification', 'POST');

	//$form_loggin->action('?page=login');

	$form_loggin->add('Email', 'log_mail')
						  ->label("Votre adresse email");

	$form_loggin->add('Password', 'log_pass')
						  ->label("Votre mot de passe"); 
								  
	$form_loggin->add('Submit', 'submit')
						  ->value("Identification");
						  
	$form_loggin->bound($_POST);





	if ($form_loggin->is_valid($_POST)) {


		$phpmail		= $form_loggin->get_cleaned_data('log_mail');
		$phppass		= $form_loggin->get_cleaned_data('log_pass');
		
		$phppass		= sha1($phppass);
		
		$verif_infos	= new Sql();
		
		
		$verif_pwd 		= Req($verif_infos,'SELECT id
																FROM '.tblmembres.'
																WHERE email = \''.$phpmail.'\'
																AND pass = \''.$phppass.'\'');

		if ($verif_pwd == 1)
		{
			
			$tab_infos =	Tab($verif_infos,'SELECT id, pseudo, email, niveau_id, langue_id, parrain, uniqid
																FROM '.tblmembres.'
																WHERE email = \''.$phpmail.'\'
																AND pass = \''.$phppass.'\'');

			$_SESSION['id'] 				= $tab_infos[0]['id'];
			$_SESSION['pseudo'] 		= $tab_infos[0]['pseudo'];
			$_SESSION['email'] 			= $tab_infos[0]['email'];
			$_SESSION['niveau_id'] 	= $tab_infos[0]['niveau_id'];
			$_SESSION['langue_id'] 	= $tab_infos[0]['langue_id'];
			$_SESSION['parrain'] 		= $tab_infos[0]['parrain'];
			
			$phpuniqid	= $tab_infos[0]['uniqid'];
			$useragent	=	sha1($_SERVER['HTTP_USER_AGENT']);
			
			// Place l'user agent crypté dans l'uniqid de l'utilisateur a partir de la position 5
			$hashcook	=	substr_replace($phpuniqid, $useragent, 5, 0);
			
			
			
			$_SESSION['hashcook']	=	$hashcook;

			
			
			//header('Location: index.php');
			//Warning: Cannot modify header information - headers already sent by (output started at /var/www/dizsurf/index.php:18) in /var/www/dizsurf/box/login.php on line 59
			changePage('index.php?c=1', 1);
			
		}else{
			
			echo '<ul class=\'erreur\'>
						<li>Votre email ou votre mot de passe sont incorrect.</li>
					</ul>';
					
			echo $form_loggin;
			
		}
		
		
		
		$verif_infos->Close();
		
	}else{

		echo $form_loggin; 

	}

}else{

	include(dirname(__FILE__). '/logged.php');

}


?>