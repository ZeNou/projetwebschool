<?php
if(isset($_GET['idtext']))
{
	if($_SESSION['level'] == 1)
	{
		echo '	<ul class="erreur">
					<li>Vous n\'avez pas accès à cette page, votre droit à la lecture vous a été supprimé</li>
				</ul>' ;
	}
	else
	{
		$typefichier = base64_decode($_GET['type']) ;
	
		if($typefichier == 'fichier')
		{
			$idtext = base64_decode($_GET['idtext']) ;
			$auteur = base64_decode($_GET['aut']) ;
			$categorie = base64_decode($_GET['cat']) ;
			
			$MyDirectory = opendir('user_txt');
			
			while($file = @readdir($MyDirectory)) 
			{
				if(!is_dir('user_txt'.'/'.$file) AND $file != '.' AND $file != '..') 
				{
					$search_txt = explode('#' , $file);
					$extension = explode('.', $search_txt[8]) ;
					if($extension[0] == $idtext)
					{
						echo '
						<table id="liretxt">
							<tr>
								<th> Auteur </th>
								<th> Date d\'ajout </th>
								<th> Catégorie </th>
								<th> Etat du texte </th>
							</tr>
							<tr>
								<td class="td_listtxt"> '.$auteur.' </td>
								<td class="td_listtxt"> '.date("\L\e j/n/Y à H:i:s", $search_txt[6]).' </td>
								<td class="td_listtxt"> '.$categorie.' </td>
								<td class="td_listtxt"> Non modéré pas l\'administrateur </td>
							</tr>
						</table><br /><br />';
						
						echo '
						<fieldset id=affichagetxt>
								<legend>'.$search_txt[2].'</legend> ';
								if (!$ouverturefile = fopen('user_txt/'.$file.'','r')) 
								{
									echo 'Echec de l\'ouverture du fichier';
									exit;
								}
								else 
								{
									$contenutxt = file_get_contents('/user_txt/'.$file.'', FILE_USE_INCLUDE_PATH);
									echo '<div id="corpsdutxt">'.$contenutxt.'</div>' ;
									fclose($ouverturefile); 
								}
						echo '
						</fieldset>';
					}
				}
			}
			closedir($MyDirectory);
		}
		elseif($typefichier == 'bdd')
		{
			echo "from bdd" ;
		}	
	}
}
?>