<?php
if(!isset($_SESSION['id']))
{
	$form_login = '<h1>Inscrivez-vous</h1><br />
			<form method="POST" name="formulaire_inscription" id="formulaire_inscription">
				<table id="formulaire_inscription">
					<tr>
						<td> <label for="pseudo"> Pseudo : </label> </td>
						<td> <input type="text" name="insc_pseudo" id="pseudo" /> <span class="error"> &nbsp; </span> </td>
					</tr>
					<tr>
						<td> <label for="nom"> Nom : </label> </td>
						<td> <input type="text" name="insc_nom" id="nom" /> <span class="error"> &nbsp; </span> </td>
					</tr>
					<tr>
						<td> <label for="prenom"> Prenom : </label> </td>
						<td> <input type="text" name="insc_prenom" id="prenom" /> <span class="error"> &nbsp; </span> </td>
					</tr>
					<tr>
						<td> <label for="pass"> Mot de passe : </label> </td>
						<td> <input type="password" name="insc_pass" id="pass" /> <span class="error"> &nbsp; </span> </td>
					</tr>
					<tr>
						<td> <label for="pass2"> Confirmation du mot de passe : </label> </td>
						<td> <input type="password" name="insc_pass2" id="pass2" /> <span class="error"> &nbsp; </span> </td>
					</tr>
					<tr>
						<td> <label for="mail"> E-mail : </label> </td>
						<td> <input type="text" name="insc_mail" id="mail" /> <span class="error"> &nbsp; </span> </td>
					</tr>
					<tr>
						<td colspan="2"> <input type="submit" value="Envoyer" name="valid_inscription" id="valid_inscription" /></td>
					</tr>
				</table>
			</form>';

	if(isset($_POST['valid_inscription']))
	{	
		$phpnom = $_POST['insc_nom'];
		$phpprenom = $_POST['insc_prenom'];
		$phppseudo = $_POST['insc_pseudo'];
		$phpmail = $_POST['insc_mail'];
		$phppass = sha1($_POST['insc_pass']);
		$phppass2 = sha1($_POST['insc_pass2']);
		
				$erreur = array() ;
				
		if(empty($phpnom))
		{
			array_push($erreur, "Le champ nom est vide !!!") ;
		}
		else
		{
			if (strlen($phpnom) < 2)
			{
				array_push($erreur, "Saisir un nom de 2 caractéres minimum") ;			}	
		}		
		
		if (empty($phpprenom))
		{
			array_push($erreur, "Le champ prenom est vide !!!") ;
		}
		else
		{
			if (strlen($phpprenom) < 2)
			{
				array_push($erreur, "Saisir un prenom de 2 caractéres minimum") ;
			}	
		}
		
		if (empty($phppseudo))
		{
			array_push($erreur, "Le champ pseudo est vide !!!") ;
		}
		else
		{
			if (strlen($phppseudo) < 3)
			{
				array_push($erreur, "Saisir un login de 3 caractéres minimum") ;
			}	
		}
		
		if (empty($phppass) OR empty($phppass2))
		{
			array_push($erreur, "Le champ mot de passe est vide !!!") ;
		}
		else
		{
			if ((strlen($_POST['insc_pass']) < 6) OR (strlen($_POST['insc_pass2']) < 6))
			{
				array_push($erreur, "Saisir un mot de passe de 6 caractéres minimum") ;
			}	
			if($phppass != $phppass2)
			{
				array_push($erreur, "Saisir les mêmes mot de passe !!!") ;
			}
		}
		
		if (empty($phpmail))
		{
			array_push($erreur, "Le champ email est vide !!!") ;
		}
		else
		{
			$RegexMail = '/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/' ;
			if(!preg_match($RegexMail,$phpmail))
			{
				array_push($erreur, "Saisir une adresse mail valide") ;
			}
		}
		
		if (count($erreur) != 0)
		{
			echo $form_login;
		
			echo '<br /><br /><ul class="erreur">' ;
			foreach ($erreur as $err_msg)
			{
				echo '<li>'.$err_msg.'</li>';
			}
			echo '</ul>';
		}
		else
		{
			if(count($erreur) == 0)
			{
				$new_insc = new Sql();
						
				$add_new = Req($new_insc,'	INSERT INTO membre (nom, prenom, mail, pseudo, pass, level, date_inscription)
											VALUES (\''.$phpnom.'\',\''.$phpprenom.'\',\''.$phpmail.'\',\''.$phppseudo.'\',\''.$phppass.'\', 2 , NOW() ); ');
			
				echo "Inscription OK" ;
			}
		}
		
	}else{
	
		echo $form_login; 
		
	}
}
else
{
	echo errAcces();	
}
?>