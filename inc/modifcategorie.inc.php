﻿<?php
if(isset($_SESSION['id']) AND $_SESSION['level'] == 9)
{

	echo '<h1>Ajouter une nouvelle catégorie</h1><br />' ;

	$list_cat = new Sql();
			
	$tab_cat = Tab($list_cat,'	SELECT id, nom
								FROM categorie  ');
			
	echo '
	<div id="listeCat">
		<table>
			<tr>
				<th>ID</th>
				<th colspan="3">Nom de la catégorie</th>
			</tr>' ;
	foreach ($tab_cat as $tab_msg)
	{
		$id = base64_encode($tab_msg['id']) ;
		echo '<tr>
				<td>'.$tab_msg['id'].'</td>
				<td>'.$tab_msg['nom'].' </td>
				<td><a href="index.php?page=modifcategorie&idcat='.$id.'&action='.base64_encode('modif').'"><img src="./images/png/edit.png" alt="éditer la catégorie" title="modifier"/></a></td>
				<td><a href="index.php?page=modifcategorie&idcat='.$id.'&action='.base64_encode('supp').'"><img src="./images/png/supp.png" alt="supprimer la catégorie" title="supprimer"/></a></td>
			</tr>';
	}
	echo '</table>
	</div>';
	
	if(isset($_GET['idcat']))
	{
		$idok = base64_decode($_GET['idcat']) ;
		if(base64_decode($_GET['action']) == "modif")
		{
			?>
				<div class="form_modifcat">
					<form action="#" method="POST" name="formulaire_newnamecat" id="formulaire_newnamecat">
						<input type="hidden" name="idcat" value="<?php echo $_GET['idcat'] ?>" />
						<table id="formulaire_newnamecat">
							<tr>
								<th> <label for="add_newnamecat"> Nouveau nom de la catégorie <?php echo $idok ; ?> : </label> </th>
							</tr>
							<tr>
								<td> <input type="text" name="add_newnamecat" id="add_newnamecat"/> <span class="error"> &nbsp; </span> </td>
							</tr>
							<tr>
								<td> <input type="submit" value="Confirmer" name="confirm_addNewNameCat" id="confirm_addNewNameCat" /> </td>
							</tr>
						</table>
					</form>
				</div>		
			<?php
		}
		elseif(base64_decode($_GET['action']) == "supp")
		{
			$affiche_txt = new Sql();
	
			$tab_affichetxt = Tab($affiche_txt,'SELECT COUNT(*) AS nbretxt
												FROM texte
												WHERE id_categorie='.$idok.' ');
		
			if($tab_affichetxt[0]['nbretxt'] == 0)
			{
				$del_cat = new Sql();
							
				$del = Req($del_cat,'	DELETE FROM categorie
										WHERE id = '.$idok.'  ');
										
				$del_droit = new Sql();
							
				$del = Req($del_cat,'	DELETE FROM droitbycategorie
										WHERE categorie_id = '.$idok.'  ');
											
				changePage('index.php?page=modifcategorie', 1);		
			}
			else
			{
				echo '<br /><br />
					<div class="form_modifcat">
						<ul class="erreur">
							<li> La catégorie ne peux être supprimé, des textes y sont répertorier </li>
						</ul> ';
			}
		}
	}	
	
	if(isset($_POST['confirm_addNewNameCat']))
	{
		$idok = base64_decode($_POST['idcat']) ;
		$phpnewname = $_POST['add_newnamecat'] ;
		
		$erreur = array() ;
				
		if(empty($phpnewname))
		{
			array_push($erreur, "Le nom de la catégorie est vide !!!") ;
		}
		else
		{
			if (strlen($phpnewname) < 2)
			{
				array_push($erreur, "Saisir un nom de 2 caractéres minimum") ;			
			}	
		}	
		
		if (count($erreur) != 0)
		{
			echo '<br /><br />
				<div class="form_modifcat">
					<ul class="erreur">' ;
			foreach ($erreur as $err_msg)
			{
				echo '<li>'.$err_msg.'</li>';
			}
			echo '</ul>
				</div>';
		}
		else
		{
			if(count($erreur) == 0)
			{
				$new_cat = new Sql();
						
				$add_new = Req($new_cat,'	UPDATE categorie
											SET nom = \''.$phpnewname.'\'
											WHERE id = '.$idok.'  ');
											
				echo '<br /><br />
				<div class="form_modifcat">
					<ul class="ok">
						<li>Catégorie modifiée (Veuillez patientez...)</li>
					</ul>				
				</div>' ;
				
				changePage('index.php?page=modifcategorie', 2);
			}
		}	
	}
}
else
{
	echo errAcces();	
}
?>