<?php
	echo '
	<table id="listtext">
		<tr>
			<th rowspan="2"> Auteur </th>
			<th rowspan="2"> Catégorie </th>
			<th rowspan="2"> Titre du texte </th>
			<th rowspan="2"> Date d\'ajout </th>
			<th colspan="3"> Autorisation </th>		
			<th rowspan="2"> Lire ce texte </th>			
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
			$extension = explode(".", $valeur[6]) ;
			
			$search_cat = new Sql();
			
			$tab_cat = Tab($search_cat,'	SELECT nom
											FROM categorie  
											WHERE id='.$valeur[1].'');
			$valeur[1] = $tab_cat[0]['nom'];
			
			$search_auteur = new Sql();
			
			$tab_auteur = Tab($search_auteur,'	SELECT pseudo
												FROM membre  
												WHERE id='.$valeur[0].'');
			$valeur[0] = $tab_auteur[0]['pseudo'];
			
			if($valeur[3] == 1) $valeur[3] = "oui"; else $valeur[3] = "non" ;
			if($valeur[4] == 1) $valeur[4] = "oui"; else $valeur[4] = "non" ;
			if($valeur[5] == 1) $valeur[5] = "oui"; else $valeur[5] = "non" ;
			
				echo '
					<tr> 
						<td> '.$valeur[0].' </td>
						<td> '.$valeur[1].' </td>
						<td> '.$valeur[2].' </td>
						<td class="td_listtxt"> '.date("Y/n/j H:i:s", $extension[0]).' </td>
						<td class="td_listtxt"> '.$valeur[3].' </td>
						<td class="td_listtxt"> '.$valeur[4].' </td>
						<td class="td_listtxt"> '.$valeur[5].' </td>
						<td class="td_listtxt"> <a href="index.php?page=liretext" title="Lecture du texte"><img src="./images/png/read.png" alt="lecture" /> </td>
					</tr>' ;
		}
	}
	echo '</table>' ;
	
	closedir($MyDirectory);
?>
