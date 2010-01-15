<?php
if(isset($_SESSION['id']))
{
	$nombredetexteNM = 0 ;
	$nombredetexteM = 0 ;

	echo '
		Voici votre profil mister '.$_SESSION['pseudo'].' <br /><br />
	<table class="listtext">
		<caption> Vos textes non modérés </caption>
		<tr>
			<th> Nombre de texte sur le portail (non modéré): </th>
		</tr>';
					
	$MyDirectory = opendir('user_txt');
	while($file = @readdir($MyDirectory)) 
	{
		if(!is_dir('user_txt'.'/'.$file) AND $file != '.' AND $file != '..') 
		{
			$valeur = explode("#", $file) ;
			$extension = explode(".", $valeur[8]) ;
			
			if( ($valeur[7] == 'false') AND ($valeur[0] == $_SESSION['id']) )
			{
				$nombredetexteNM+=1;
			}
		}
	}
	echo '
		<tr>
			<td class="td_listtxt">'.$nombredetexteNM.'</td>
		</tr>
	</table><br /><br />' ;
	
	closedir($MyDirectory);
	
	$affiche_txt = new Sql();
	
	$tab_affichetxt = Tab($affiche_txt,'SELECT COUNT(*) AS nbretxt, AVG(note) AS moyenne
										FROM texte t LEFT JOIN note n ON(t.id = n.texte_id)
										WHERE t.id_membre='.$_SESSION['id'].' 
										AND droit_notation=1');
	
		if($tab_affichetxt[0]['moyenne'] == NULL)
			$moyenne = "Aucun de vos n'a encore été notés" ;
		else
			$moyenne = $tab_affichetxt[0]['moyenne'] ;
	
	echo '
	<table class="listtext">
		<caption> Vos textes modérés </caption>
		<tr>
			<th> Nombre de texte </th>
			<th> Moyenne des notes de tous vos textes (dont la notation est activé) </th>
		</tr>
		<tr>
			<td class="td_listtxt">'.$tab_affichetxt[0]['nbretxt'].'</td>
			<td class="td_listtxt">'.round($moyenne, "2").' / 10</td>
		</th>
	</table>';
}
else
{
	echo errAcces();
}
?>