<?php
if(isset($_SESSION['id']))
{
	if(isset($_POST['note']))
	{
		$note = $_POST['note'] ;
		$idtext = $_POST['idtext'] ;
		$auteur = $_POST['auteur'] ;
		$cat = $_POST['nomcat'] ;
		
		$add_note = new Sql();
						
		$note = Req($add_note,'	INSERT INTO note(note, texte_id, membre_id)
								VALUES ('.$note.' , '.$idtext.' , '.$_SESSION['id'].') ');
									
		changePage('index.php?page=liretext&idtext='.base64_encode($idtext).'&aut='.base64_encode($auteur).'&cat='.base64_encode($cat).'&type='.base64_encode('bdd').'"', 1);		
	}
	else
	{
		echo '
		<ul class="erreur">
			<li>Veuillez choisir une note</li>
		</ul> ';
	}
}
else
{
	echo errAcces();	
}
?>