<?php
if($_SESSION['level'] == 9)
{
	echo '<h1>Ajouter une nouvelle catégorie</h1><br />' ;

	$list_cat = new Sql();
			
	$tab_cat = Tab($list_cat,'	SELECT id, nom
								FROM categorie ; ');
			
	echo '<table>
			<tr>
				<th>ID</th>
				<th>Nom de la catégorie</th>
			</tr>' ;
	foreach ($tab_cat as $tab_msg)
	{
		echo '<tr>
				<td>'.$tab_msg['id'].'</td>
				<td>'.$tab_msg['nom'].'</td>
			</tr>';
	}
	echo '</table>';
}
else
{
	echo '<br /><br />
			<ul class="erreur">
				<li>Vous n\'avez pas accès à cette page</li>
			</ul>' ;
}
?>