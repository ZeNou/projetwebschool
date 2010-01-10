<?php
if(isset($_SESSION['id']))
{	
	if(isset($_GET['idmem']))
	{
		$idok = base64_decode($_GET['idmem']) ;
		
		$autorisation = new Sql();
		
		$tab_autorisation = Tab($autorisation,'	SELECT *
												FROM droitbycategorie 
												WHERE membre_id = '.$idok.'');
		
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
										echo ' - '.$msg_catname['nom'].' <br />' ;
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
		
		echo 'formulaire des modifications des restrictions';
	}
}
?>