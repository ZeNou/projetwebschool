<?php
if(isset($_SESSION['id']))
{
	echo '
	<form method="POST" action="#" name="choixcat" id="choixcat">';
		$list_cat = new Sql();
									
		$tab_cat = Tab($list_cat,'	SELECT id, nom
									FROM categorie  ');
									
		echo 'Trier par catégorie : <select name="add_txtcat" id="cat">
				<option value="0" > --- Choisir --- </option>' ;
			foreach ($tab_cat as $tab_msg)
			{
				$id = base64_encode($tab_msg['id']) ;
				echo '<option value="'.$id.'" '; if(isset($_POST['valid_tricat']) AND $_POST['add_txtcat'] == $id) { echo 'selected="selected"' ; }  echo' > '.$tab_msg['nom'].' </option>';
			}
		echo '</select> <span class="error"> &nbsp; </span> <input type="submit" id="valid_tricat" name="valid_tricat" value="OK" />
	</form>
	
	<br />
	<table id="listtext">
		<tr>
			<th rowspan="2"> Auteur </th>
			<th rowspan="2"> Catégorie </th>
			<th rowspan="2"> Titre du texte </th>
			<th rowspan="2"> Date d\'ajout </th>
			<th colspan="3"> Autorisation </th>		
			<th rowspan="2"> Lire ce texte </th> ';
		if($_SESSION['level'] == 9)
		{
			echo '
			<th rowspan="2"> Delete </th> 
			<th rowspan="2"> Add </th> ';
		}
	echo '
		</tr>
		<tr>
			<th>Lecture</th>
			<th>Notation</th>
			<th>Commentaire</th>
		</tr>';
					
	$MyDirectory = opendir('user_txt');
	while($file = @readdir($MyDirectory)) 
	{
		if(!is_dir('user_txt'.'/'.$file) AND $file != '.' AND $file != '..') 
		{
			$valeur = explode("#", $file) ;
			$extension = explode(".", $valeur[7]) ;
			
			$search_cat = new Sql();
			
			$tab_cat = Tab($search_cat,'	SELECT nom
											FROM categorie  
											WHERE id='.$valeur[1].'');
			$idcat = $valeur[1] ;
			$valeur[1] = $tab_cat[0]['nom'];
			
			$search_auteur = new Sql();
			
			$tab_auteur = Tab($search_auteur,'	SELECT pseudo
												FROM membre  
												WHERE id='.$valeur[0].'');
			$valeur[0] = $tab_auteur[0]['pseudo'];
			
			if($valeur[3] == 1) $valeur[3] = "oui"; else $valeur[3] = "non" ;
			if($valeur[4] == 1) $valeur[4] = "oui"; else $valeur[4] = "non" ;
			if($valeur[5] == 1) $valeur[5] = "oui"; else $valeur[5] = "non" ;
			
			if(isset($_POST['valid_tricat']))
			{
				$idcatok = base64_decode($_POST['add_txtcat']) ;

				if($idcatok == $idcat)
				{
				
					echo '
						<tr> 
							<td> '.$valeur[0].' </td>
							<td> '.$valeur[1].' </td>
							<td> '.$valeur[2].' </td>
							<td class="td_listtxt"> '.date("\L\e j/n/Y à H:i:s", $valeur[6]).' </td>
							<td class="td_listtxt"> '.$valeur[3].' </td>
							<td class="td_listtxt"> '.$valeur[4].' </td>
							<td class="td_listtxt"> '.$valeur[5].' </td>
							<td class="td_listtxt"> <a href="index.php?page=liretext&idtext='.base64_encode($extension[0]).'&aut='.base64_encode($valeur[0]).'&cat='.base64_encode($valeur[1]).'" title="Lecture du texte"><img src="./images/png/read.png" alt="lecture" /> </td> ';
					if($_SESSION['level'] == 9)
					{
						echo '	<td class="td_listtxt"> <a href="index.php?page=supptext&idtext='.base64_encode($extension[0]).'" title="Supprimé ce texte"><img src="./images/png/supp.png" alt="suppression" /> </td>
								<td class="td_listtxt"> <a href="index.php?page=addtobdd&idtext='.base64_encode($extension[0]).'" title="Ajouté à la BDD"><img src="./images/png/save.png" alt="ajouté à la bdd" /> </td> ';
					}
					echo'	</tr>' ;
				}
			}
			else
			{
					echo '
						<tr> 
							<td> '.$valeur[0].' </td>
							<td> '.$valeur[1].' </td>
							<td> '.$valeur[2].' </td>
							<td class="td_listtxt"> '.date("\L\e j/n/Y à H:i:s", $valeur[6]).' </td>
							<td class="td_listtxt"> '.$valeur[3].' </td>
							<td class="td_listtxt"> '.$valeur[4].' </td>
							<td class="td_listtxt"> '.$valeur[5].' </td>
							<td class="td_listtxt"> <a href="index.php?page=liretext&idtext='.base64_encode($extension[0]).'&aut='.base64_encode($valeur[0]).'&cat='.base64_encode($valeur[1]).'" title="Lecture du texte"><img src="./images/png/read.png" alt="lecture" /> </td> ';
				if($_SESSION['level'] == 9)
				{
					echo '	<td class="td_listtxt"> <a href="index.php?page=supptext&idtext='.base64_encode($extension[0]).'" title="Supprimé ce texte"><img src="./images/png/supp.png" alt="suppression" /> </td>
							<td class="td_listtxt"> <a href="index.php?page=addtobdd&idtext='.base64_encode($extension[0]).'" title="Ajouté à la BDD"><img src="./images/png/save.png" alt="ajouté à la bdd" /> </td> ';
				}
				echo'	</tr>' ;
			}
		}
	}
	echo '</table>' ;
	
	closedir($MyDirectory);
}
?>
