<?php
if(isset($_SESSION['id']))
{
	echo '
	<form method="POST" action="#" name="choixcat" id="choixcat">';
		$list_cat = new Sql();
									
		$tab_cat = Tab($list_cat,'	SELECT id, nom
									FROM categorie  ');
									
		echo 'Trier par catégorie : <select name="add_txtcat" id="cat">
				<option value="0" > Choisir une catégorie </option>
				<option value="ALL"> Toutes les catégories </option>' ;
			foreach ($tab_cat as $tab_msg)
			{
				$id = base64_encode($tab_msg['id']) ;
				echo '<option value="'.$id.'" '; if(isset($_POST['valid_tricat']) AND $_POST['add_txtcat'] == $id) { echo 'selected="selected"' ; }  echo' > '.$tab_msg['nom'].' </option>';
			}
		echo '</select> <span class="error"> &nbsp; </span> <input type="submit" id="valid_tricat" name="valid_tricat" value="OK" />
	</form>
	
	<br />
	<table class="listtext">
		<caption> Texte non modéré par l\'administrateur </caption>
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
			$extension = explode(".", $valeur[8]) ;
			
			if($valeur[7] == 'false')
			{
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
				
				if(isset($_POST['valid_tricat']) AND ($_POST['add_txtcat'] != 'ALL'))
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
								<td class="td_listtxt"> <a href="index.php?page=liretext&idtext='.base64_encode($extension[0]).'&aut='.base64_encode($valeur[0]).'&cat='.base64_encode($valeur[1]).'&type='.base64_encode('fichier').'" title="Lecture du texte"><img src="./images/png/read.png" alt="lecture" /> </td> ';
						if($_SESSION['level'] == 9)
						{
							echo '	<td class="td_listtxt"> <a href="index.php?page=supptext&idtext='.base64_encode($extension[0]).'&type='.base64_encode('fichier').'" title="Supprimé ce texte"><img src="./images/png/supp.png" alt="suppression" /> </td>
									<td class="td_listtxt"> <a href="index.php?page=addtobdd&idtext='.base64_encode($extension[0]).'&type='.base64_encode('fichier').'" title="Ajouté à la BDD"><img src="./images/png/save.png" alt="ajouté à la bdd" /> </td> ';
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
								<td class="td_listtxt"> <a href="index.php?page=liretext&idtext='.base64_encode($extension[0]).'&aut='.base64_encode($valeur[0]).'&cat='.base64_encode($valeur[1]).'&type='.base64_encode('fichier').'" title="Lecture du texte"><img src="./images/png/read.png" alt="lecture" /> </td> ';
					if($_SESSION['level'] == 9)
					{
						echo '	<td class="td_listtxt"> <a href="index.php?page=supptext&idtext='.base64_encode($extension[0]).'&type='.base64_encode('fichier').'" title="Supprimé ce texte"><img src="./images/png/supp.png" alt="suppression" /> </td>
								<td class="td_listtxt"> <a href="index.php?page=addtobdd&idtext='.base64_encode($extension[0]).'&type='.base64_encode('fichier').'" title="Ajouté à la BDD"><img src="./images/png/save.png" alt="ajouté à la bdd" /> </td> ';
					}
					echo'	</tr>' ;
				}
			}
		}
	}
	echo '</table><br /><br />' ;
	
	closedir($MyDirectory);
	
	echo '
	<table class="listtext">
		<caption> Texte modéré par l\'administrateur </caption>
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
			<th rowspan="2"> Delete </th> ';
		}
	echo '
		</tr>
		<tr>
			<th>Lecture</th>
			<th>Notation</th>
			<th>Commentaire</th>
		</tr>';
					
	$affiche_txt = new Sql();
	
	$tab_affichetxt = Tab($affiche_txt,'SELECT m.pseudo, c.nom, t.titre, t.date_ajout, t.droit_lecture, t.droit_notation, t.droit_commenter, t.id_categorie, t.id
										FROM membre m JOIN texte t ON(t.id_membre=m.id) JOIN categorie c ON(c.id=t.id_categorie) ');
									
	foreach ($tab_affichetxt as $tab_msg)
	{
		if($tab_msg['droit_lecture'] == 1) $tab_msg['droit_lecture']  = "oui"; else $tab_msg['droit_lecture']  = "non" ;
		if($tab_msg['droit_notation'] == 1) $tab_msg['droit_notation']  = "oui"; else $tab_msg['droit_notation']  = "non" ;
		if($tab_msg['droit_commenter'] == 1) $tab_msg['droit_commenter']  = "oui"; else $tab_msg['droit_commenter']  = "non" ;
		
		if(isset($_POST['valid_tricat']) AND ($_POST['add_txtcat'] != 'ALL'))
		{
			$idcatok = base64_decode($_POST['add_txtcat']) ;

			if($idcatok == $tab_msg['id_categorie'])
			{			
				echo '
					<tr> 
						<td> '.$tab_msg['pseudo'].' </td>
						<td> '.$tab_msg['nom'].' </td>
						<td> '.$tab_msg['titre'].' </td>
						<td class="td_listtxt"> '.date("\L\e j/n/Y à H:i:s", $tab_msg['date_ajout']).' </td>
						<td class="td_listtxt"> '.$tab_msg['droit_lecture'].' </td>
						<td class="td_listtxt"> '.$tab_msg['droit_notation'].' </td>
						<td class="td_listtxt"> '.$tab_msg['droit_commenter'].' </td>
						<td class="td_listtxt"> <a href="index.php?page=liretext&idtext='.base64_encode($tab_msg['id']).'&aut='.base64_encode($tab_msg['pseudo']).'&cat='.base64_encode($tab_msg['nom']).'&type='.base64_encode('bdd').'" title="Lecture du texte"><img src="./images/png/read.png" alt="lecture" /> </td> ';
				if($_SESSION['level'] == 9)
				{
					echo '	<td class="td_listtxt"> <a href="index.php?page=supptext&idtext='.base64_encode($tab_msg['id']).'&type='.base64_encode('bdd').'" title="Supprimé ce texte"><img src="./images/png/supp.png" alt="suppression" /> </td> ';
				}
				echo'	</tr>' ;
			}
		}
		else
		{
			echo '
				<tr> 
					<td> '.$tab_msg['pseudo'].' </td>
					<td> '.$tab_msg['nom'].' </td>
					<td> '.$tab_msg['titre'].' </td>
					<td class="td_listtxt"> '.date("\L\e j/n/Y à H:i:s", $tab_msg['date_ajout']).' </td>
					<td class="td_listtxt"> '.$tab_msg['droit_lecture'].' </td>
					<td class="td_listtxt"> '.$tab_msg['droit_notation'].' </td>
					<td class="td_listtxt"> '.$tab_msg['droit_commenter'].' </td>
					<td class="td_listtxt"> <a href="index.php?page=liretext&idtext='.base64_encode($tab_msg['id']).'&aut='.base64_encode($tab_msg['pseudo']).'&cat='.base64_encode($tab_msg['nom']).'&type='.base64_encode('bdd').'" title="Lecture du texte"><img src="./images/png/read.png" alt="lecture" /> </td> ';
			if($_SESSION['level'] == 9)
			{
				echo '	<td class="td_listtxt"> <a href="index.php?page=supptext&idtext='.base64_encode($tab_msg['id']).'&type='.base64_encode('bdd').'" title="Supprimé ce texte"><img src="./images/png/supp.png" alt="suppression" /> </td> ';
			}
			echo'	</tr>' ;
		}		
	}
	echo '</table>' ;
}
?>
