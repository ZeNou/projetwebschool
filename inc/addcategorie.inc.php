<?php
	$form_addcat = '<h1>Ajouter une nouvelle catégorie</h1><br />
			<form method="POST" name="formulaire_addcat" id="formulaire_addcat">
				<table id="formulaire_addcat">
					<tr>
						<td> <label for="cat"> Catégorie : </label> </td>
						<td> <input type="text" name="add_cat" id="cat" /> <span class="error"> &nbsp; </span> </td>
					</tr>
					<tr>
						<td colspan="2"> <input type="submit" value="Envoyer" name="valid_addcat" id="valid_addcat" /></td>
					</tr>
				</table>
			</form>';

	if(isset($_POST['valid_addcat']))
	{	
		$phpnomcat = $_POST['add_cat'];
		
			$erreur = array() ;
				
		if(empty($phpnomcat))
		{
			array_push($erreur, "Le nom de la catégorie est vide !!!") ;
		}
		else
		{
			if (strlen($phpnomcat) < 2)
			{
				array_push($erreur, "Saisir un nom de 2 caractéres minimum") ;			}	
		}	
		
		if (count($erreur) != 0)
		{
			echo $form_addcat;
		
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
						
				$add_new = Req($new_insc,'	INSERT INTO categorie (nom)
											VALUES (\''.$phpnomcat.'\'); ');
											
				echo $form_addcat ;
				
				echo '<br /><br />
					<ul class="ok">
						<li>Catégorie Ajoutée</li>
					</ul>' ;
			}
		}		
	}
	else
	{	
		echo $form_addcat ; 
	}
?>