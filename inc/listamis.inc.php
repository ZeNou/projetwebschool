<?php
if(!isset($_SESSION['id']))
{

	echo errAcces();
	exit();
				
}

	echo '<h1>Liste de vos amis</h1><br />' ;

	echo '<dl>';
	
	$friends 	= new Sql();
			
	$tab_cat 	= Tab($friends,'SELECT DISTINCT g.id, g.titre
											FROM '.tblgroupe.' g,'.tblamis.' a
											WHERE a.id_groupe_amis = g.id
											');
			

		foreach ($tab_cat as $grp)
		{
			$id_groupe = $grp['id'];
			
			echo '<dt>'.$grp['titre'].'</dt>
						<dd>
								<ul>
					';
			
			
			$tab_amis 	= Tab($friends,'SELECT m.id, m.pseudo
										FROM '.tblamis.' a, '.tblmembres.' m
										WHERE a.id_amis = m.id
										AND a.id_groupe_amis = \''.$id_groupe.'\'
										');
								
								
			foreach ($tab_amis as $amis)
			{
				echo '<li>- '.$amis['pseudo'].' <span class="suppr">(<a href="#">supprimer</a>)</span></li>';
			}
			
			
			echo '	</ul>
					</dd>';
		}
		
	echo '</dl>';

	
?>