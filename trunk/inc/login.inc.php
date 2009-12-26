<?php

if(!isset($_SESSION['id']))
{
	echo '<h1>Identifiez-vous</h1>';

	
	$form_loggin = '<form id="formulaire_identification" name="formulaire_identification" method="POST">
								<label for="log_mail">Votre email</label><input type="text" value="" id="log_mail" name="log_mail" /><br /><br />
								<label for="log_pass">Votre mot de passe</label><input type="text" value="" id="log_pass" name="log_pass" /><br /><br />
							
								<input type="submit" name="insc" value="S\'identifier" />
						
							</form>';





	if(isset($_POST['insc']))
	{
	
		$phpmail 		= $_POST['log_mail'];
		$phppass 		= sha1($_POST['log_pass']);
		
		$verif_infos	= new Sql();
		
		
		$verif_pwd 	= Req($verif_infos,'SELECT id
														FROM '.tblmembres.'
														WHERE mail = \''.$phpmail.'\'
														AND pass = \''.$phppass.'\'');

		if ($verif_pwd == 1)
		{
			echo 1;
			$tab_infos =	Tab($verif_infos,'SELECT id, nom, prenom, mail, pseudo, level
														FROM '.tblmembres.'
														WHERE mail = \''.$phpmail.'\'
														AND pass = \''.$phppass.'\';');

			$_SESSION['id'] 				= $tab_infos[0]['id'];
			$_SESSION['nom'] 			= $tab_infos[0]['nom'];
			$_SESSION['prenom'] 		= $tab_infos[0]['prenom'];
			$_SESSION['mail'] 			= $tab_infos[0]['mail'];
			$_SESSION['pseudo'] 		= $tab_infos[0]['pseudo'];
			$_SESSION['level'] 			= $tab_infos[0]['level'];
			

			
			/* Une fois que l'authentification est réussit on change de page */
			changePage('index.php', 1);
			
		}else{
			
			echo '<ul class="erreur">
						<li>Votre email ou votre mot de passe sont incorrect.</li>
					</ul>';
					
			echo $form_loggin;
			
		}
		
		
		
		$verif_infos->Close();
		
	}else{

		echo $form_loggin; 

	}

}


?>