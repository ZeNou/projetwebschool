<?php
	echo '
	<table>
		<tr>
			<th rowspan="2"> Auteur </th>
			<th rowspan="2"> Catégorie </th>
			<th rowspan="2"> Titre du texte </th>
			<th rowspan="2"> Date d\'ajout </th>
			<th colspan="3"> Autorisation </th>			
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
			
			if($valeur[3] == 1) $valeur[3] = "oui"; else $valeur[3] = "non" ;
			if($valeur[4] == 1) $valeur[4] = "oui"; else $valeur[4] = "non" ;
			if($valeur[5] == 1) $valeur[5] = "oui"; else $valeur[5] = "non" ;
			
				echo '
					<tr> 
						<td> '.$valeur[0].' </td>
						<td> '.$valeur[1].' </td>
						<td> '.$valeur[2].' </td>
						<td> '.date("Y/n/j H:i:s", $extension[0]).' </td>
						<td> '.$valeur[3].' </td>
						<td> '.$valeur[4].' </td>
						<td> '.$valeur[5].' </td>
					</tr>' ;
		}
	}
	echo '</table>' ;
	
	closedir($MyDirectory);
?>
