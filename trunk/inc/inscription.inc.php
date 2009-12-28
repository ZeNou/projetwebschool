<?php
if(!isset($_SESSION['id']))
{
	echo '<h1>Inscrivez-vous</h1><br />';
	
	$form_loggin = '
			<form method="POST" name="formulaire_inscription" id="formulaire_inscription">
				<table id="formulaire_inscription">
					<tr>
						<td> <label for="pseudo"> Pseudo : </label> </td>
						<td> <input type="text" name="pseudo" id="pseudo" /> <span class="error"> &nbsp; </span> </td>
					</tr>
					<tr>
						<td> <label for="nom"> Nom : </label> </td>
						<td> <input type="text" name="nom" id="nom" /> <span class="error"> &nbsp; </span> </td>
					</tr>
					<tr>
						<td> <label for="prenom"> Prenom : </label> </td>
						<td> <input type="text" name="prenom" id="prenom" /> <span class="error"> &nbsp; </span> </td>
					</tr>
					<tr>
						<td> <label for="pass"> Mot de passe : </label> </td>
						<td> <input type="password" name="pass" id="pass" /> <span class="error"> &nbsp; </span> </td>
					</tr>
					<tr>
						<td> <label for="pass2"> Confirmation du mot de passe : </label> </td>
						<td> <input type="password" name="pass2" id="pass2" /> <span class="error"> &nbsp; </span> </td>
					</tr>
					<tr>
						<td> <label for="mail"> E-mail : </label> </td>
						<td> <input type="text" name="mail" id="mail" /> <span class="error"> &nbsp; </span> </td>
					</tr>
					<tr>
						<td colspan="2"> <input type="submit" value="Envoyer" id="valid_inscription" /></td>
					</tr>
				</table>
			</form>';

	if(isset($_POST['valid_inscription']))
	{	
	
		echo "envoi ok" ;
		
	}else{
	
		echo $form_loggin; 
		
	}
}
?>