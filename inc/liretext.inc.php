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
		$idtext = base64_decode($_GET['idtext']) ;
			
		if($typefichier == 'fichier')
		{
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
			$affiche_txt = new Sql();
	
			$tab_affichetxt = Tab($affiche_txt,'SELECT m.pseudo, c.nom, t.titre, t.corps, t.date_ajout, t.droit_lecture, t.droit_notation, t.droit_commenter, t.id_categorie, t.id
												FROM membre m JOIN texte t ON(t.id_membre=m.id) JOIN categorie c ON(c.id=t.id_categorie) 
												WHERE t.id = '.$idtext.' ');
			
			
			$sommesnote = 0;
			$notefinale = 0;
			$recup_note = new Sql();	
			$tab_note = Tab($recup_note,'	SELECT note
											FROM note
											WHERE texte_id = '.$idtext.' ');
			if(count($tab_note) != 0)
			{
				foreach($tab_note as $note)
				{
					$sommesnote += $note['note'] ;
				}
				$notefinale = $sommesnote/count($tab_note) ;
			}
			
			if($tab_affichetxt[0]['droit_lecture'] == 1)
			{
				echo '
					<table id="liretxt">
						<tr>
							<th> Auteur </th>
							<th> Date d\'ajout </th>
							<th> Catégorie </th>
							<th> Etat du texte </th>
							<th> Note du texte </th>
						</tr>
						<tr>
							<td class="td_listtxt"> '.$tab_affichetxt[0]['pseudo'].' </td>
							<td class="td_listtxt"> '.$tab_affichetxt[0]['date_ajout'].' </td>
							<td class="td_listtxt"> '.$tab_affichetxt[0]['nom'].' </td>
							<td class="td_listtxt"> Modéré pas l\'administrateur </td>
							<td class="td_listtxt"> ';
							if($tab_affichetxt[0]['droit_notation'] == 1)
							{
								echo round($notefinale, "2").'/10 ('.count($tab_note).' votant)';
							}
							else
							{
								echo 'Notation désactiver' ;
							}
					echo '	</td>
						</tr>
					</table><br /><br />';
							
				echo '
					<fieldset id=affichagetxt>
						<legend>'.$tab_affichetxt[0]['titre'].'</legend> 
						'.$tab_affichetxt[0]['corps'].'
					</fieldset>';
					
				if($tab_affichetxt[0]['droit_notation'] == 1)
				{
					$cherche_note = new Sql();
	
					$tab_note = Tab($cherche_note,'	SELECT membre_id, texte_id
													FROM note 
													WHERE texte_id = '.$idtext.'
													AND membre_id = '.$_SESSION['id'].' ');
					
					if(count($tab_note) == 0)
					{
						echo '<form method="POST" action="index.php?page=envoinote" name="noter_txt">
							<input type="hidden" value="'.$idtext.'" name="idtext" />
							<input type="hidden" value="'.$tab_affichetxt[0]['pseudo'].'" name="auteur" />
							<input type="hidden" value="'.$tab_affichetxt[0]['nom'].'" name="nomcat" />
										
						Note : <select name="note"' ;
							for($i=1 ; $i<=10 ;$i++)
							{
								echo '<option value="'.$i.'"> '.$i.' </option> ';
							}
							
						echo '</select>
						<input type="submit" value="Noter ce texte" />
						</form>
						<br /><br />';
					}
					else
					{
						echo '
						<ul class="erreur">
							<li>Vous avez déjà noter ce texte</li>
						</ul><br /><br />';	
					}
				}
				else
				{
					echo '<br /><br />
					<ul class="erreur">
						<li>L\'auteur ne souhaite pas que son texte soit noté</li>
					</ul><br />';	
				}
				
				if($tab_affichetxt[0]['droit_commenter'] == 1)
				{
					$affiche_com = new Sql();
	
					$tab_affichecom = Tab($affiche_com,'SELECT m.pseudo, t.id, c.corps
														FROM membre m JOIN commentaire c ON(c.id_membre=m.id) JOIN texte t ON(c.id_texte=t.id) 
														WHERE c.id_texte = '.$idtext.' ');
					
					echo '<table>
								<caption> Voici vos commentaires </caption>' ;
					if(count($tab_affichecom) == 0)
					{
						echo '<br /><br />
						<ul class="erreur">
							<li>Il n\'y a pas de commentaire pour ce texte </li>
						</ul>';	

					}
					else
					{
						foreach($tab_affichecom as $tab_msg)
						{
							echo '
							<tr> 
								<td class="commentaire_pseudo"> '.$tab_msg['pseudo'].' : </td>
								<td class="commentaire_corps"> '.$tab_msg['corps'].' </td>
							</tr> ';
						}
					}
					echo '
						<tr>
							<td colspan="2" class="commentaire_form">
							<form method="POST" action="index.php?page=ajoutcommentaire" name="ajoutcommentaire" id="ajoutcommentaire"> 
								<input type="hidden" value="'.$idtext.'" name="idtext" />
								<input type="hidden" value="'.$tab_affichetxt[0]['pseudo'].'" name="auteur" />
								<input type="hidden" value="'.$tab_affichetxt[0]['nom'].'" name="nomcat" />
								<textarea name="add_comm" id="comm" rows="5" cols="40"></textarea> <br /> <span class="error ajoutcommentaire"> &nbsp; </span> <br />
								<input type="submit" value="Ajouter le commentaire" id="valid_ajoutcommentaire"/>
							</form>
							</td>
						</tr>
					</table>';
				}
				else
				{
					echo '<br /><br />
					<ul class="erreur">
						<li>L\'auteur à désactiver les commentaires sur son texte</li>
					</ul>';	
				}
			}
			else
			{
				echo '<br /><br />
				<ul class="erreur">
					<li>L\'auteur n\'autorise pas la lecture de son texte</li>
				</ul>';	
			}
		}	
	}
}
?>