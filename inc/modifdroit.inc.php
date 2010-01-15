<?php
if(isset($_SESSION['id']) AND $_SESSION['level'] == 9)
{	
	if(isset($_GET['idmem']))
	{
		$autorisation = new Sql();
		
		$idok = base64_decode($_GET['idmem']);
		
		/*
		 * Supprime une interdiction
		 */
		 
		if(isset($_GET['idsuppr']))
		{
			
			$id_suppr = base64_decode($_GET['idsuppr']);
		
			$suppr_interdit = Req($autorisation,'DELETE FROM droitbycategorie
																WHERE membre_id = '.$idok.'
																AND categorie_id = '.$id_suppr.'') ;
		}
		
		/*
		 *	Ajoute l'interdiction a une catégorie
		 */
		if(isset($_POST['categorie']))
		{
			foreach($_POST['categorie'] as $interdit)
			{
				
				$ajout_interdit = Req($autorisation,'INSERT INTO droitbycategorie (membre_id, categorie_id)
																	VALUES ('.$idok.','.$interdit.') ') ;
				
			}
		}
		
		$tab_autorisation = Tab($autorisation,'	SELECT *
																	FROM droitbycategorie 
																	WHERE membre_id = '.$idok.'');
		echo '<div id="restrictionbycat">
				<form method="POST" action="" id="form_modifdroit">';
				
		if(count($tab_autorisation) != 0)
		{
			echo '
				<table>
					<tr>
						<th>';
								if($tab_autorisation == 1)
									echo 'Ce membre ne peux pas poster de texte dans la catégorie : ' ;
								else
									echo 'Ce membre ne peux pas poster de texte dans les catégories : ' ;
			echo '		</th>
					</tr>
					<tr>
						<td>';			
							foreach($tab_autorisation as $msg_autorisation)
							{
								if($msg_autorisation['membre_id'] == $idok)
								{
									$catname = new Sql();
						
									$tab_catname = Tab($catname,'	SELECT nom
																					FROM categorie 
																					WHERE id = '.$msg_autorisation['categorie_id'].' ');
									
									foreach($tab_catname as $msg_catname)
									{
										echo ' - '.$msg_catname['nom'].' <span class="suppr">(<a href="index.php?page=modifdroit&idmem='.base64_encode($idok).'&idsuppr='.base64_encode($msg_autorisation['categorie_id']).'">supprimer</a>)</span><br />' ;
									}					
								}	
							}
			echo '		</td>
					</tr>
				</table> <br /> <br />';
		}
		else
		{
			echo '
				<table>
					<tr>
						<th> Ce membre n\'a pas de restrictions. </th>
					</tr>
				</table> <br /> <br />';
		}
		
		$listecat = new Sql();
		
		/* Sous jointure qui permet de ne pas ressortir les catégories déjà interdites */
		$tab_listecat = Tab($listecat,'	SELECT id, nom
													FROM categorie
													WHERE id NOT IN (SELECT categorie_id
																				FROM droitbycategorie
																				WHERE membre_id = '.$idok.')
													');
		
		echo '
			<table>
				<tr>
					<th> Veuillez cocher la/les catégorie(s) <br /> que vous voulez interdire à ce membre </th>
				</tr>';
		foreach($tab_listecat as $msg_listecat)
		{
			echo '
				<tr>
					<td><input type="checkbox" value="'.$msg_listecat['id'].'" name="categorie[]" id="'.$msg_listecat['nom'].'" /> <label for="'.$msg_listecat['nom'].'"> '.$msg_listecat['nom'].' </label></td>
				</tr>';
		}
		echo '	<tr>
					<td> <span class="error checkboxautorisation"> &nbsp; </span> </td>
				</tr>
				<tr>
					<td><input type="submit" value="valider" id="valid_form_modifdroit" /></td>
				</tr>
			</table>
			</form>
		</div>';
	}
}
else
{
	echo errAcces();	
}
?>