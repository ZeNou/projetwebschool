<?php
if(isset($_SESSION['id']))
{
	if(isset($_POST['add_comm']))
	{
		$comm = $_POST['add_comm'] ;
		$idtext = $_POST['idtext'] ;
		$auteur = $_POST['auteur'] ;
		$cat = $_POST['nomcat'] ;
		
		$add_com = new Sql();
						
		$comm = Req($add_com,'	INSERT INTO commentaire(corps, id_texte, id_membre)
								VALUES ("'.$comm.'" , '.$idtext.' , '.$_SESSION['id'].') ');
									
		changePage('index.php?page=liretext&idtext='.base64_encode($idtext).'&aut='.base64_encode($auteur).'&cat='.base64_encode($cat).'&type='.base64_encode('bdd').'"', 1);		
	}
	else
	{
		echo '
		<ul class="erreur">
			<li>Veuillez saisir un commentaire</li>
		</ul> ';
	}
}
else
{
	echo errAcces();
}
?>