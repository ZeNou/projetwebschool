<?php
	$listemembre = new Sql();
	
	$tab_listemembre = Tab($listemembre,'	SELECT *
											FROM membre ');
	
	echo '
	<table class="listmembre">
		<caption> Liste des membres inscrits sur le site </caption>
		<tr>
			<th> ID </th>
			<th> Pseudo </th>
			<th> Nom </th>
			<th> Prénom </th>
			<th> E-mail </th>		
			<th> Date d\'inscription </th>
			<th> Level </th> 
			<th> Modifier les droits de ce membre';
		foreach($tab_listemembre as $tab_membre)
		{
			echo '
			<tr> 
				<td> '.$tab_membre['id'].' </td>
				<td> '.$tab_membre['pseudo'].' </td>
				<td> '.$tab_membre['nom'].' </td>
				<td> '.$tab_membre['prenom'].' </td>
				<td> '.$tab_membre['mail'].' </td>
				<td class="td_listtxt"> '.$tab_membre['date_inscription'].' </td>
				<td class="td_listtxt"> '.$tab_membre['level'].' </td>
				<td class="td_listtxt"> <a href="index.php?page=modifdroit&idmem='.base64_encode($tab_membre['id']).'" title="modifier les droits du membre '.$tab_membre['pseudo'].'"><img src="./images/png/edit.png" alt="édition des droits" /></a> </td>
			';
		}
	echo '</table>' ;
?>