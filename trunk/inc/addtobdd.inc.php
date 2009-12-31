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
		$idtext = base64_decode($_GET['idtext']) ;
		
		$MyDirectory = opendir('user_txt');
		
		while($file = @readdir($MyDirectory)) 
		{
			if(!is_dir('user_txt'.'/'.$file) AND $file != '.' AND $file != '..') 
			{
				$search_txt = explode('#' , $file);
				$extension = explode('.', $search_txt[7]) ;
				if($extension[0] == $idtext)
				{
					if (!$ouverturefile = fopen('user_txt/'.$file.'','r')) 
					{
						echo 'Echec de l\'ouverture du fichier';
						exit;
					}
					else 
					{
						$contenutxt = file_get_contents('/user_txt/'.$file.'', FILE_USE_INCLUDE_PATH);
						fclose($ouverturefile); 
					}
					
					echo $search_txt[6] ;
					$add_txt = new Sql();
						
					$add_new = Req($add_txt,'	INSERT INTO texte (id_membre , titre , corps , date_ajout , id_categorie , droit_lecture , droit_notation , droit_commenter)
												VALUES ('.$search_txt[0].' , "'.$search_txt[2].'" , "'.$contenutxt.'" , '.$search_txt[6].' , '.$search_txt[1].' , '.$search_txt[3].' , '.$search_txt[4].' , '.$search_txt[5].') ') ;
												
					echo '<br /><br />
					<div class="form_addtxttobdd">
						<ul class="ok">
							<li>Le texte à bien été ajouté à la base de données (Veuillez patientez...)</li>
						</ul>				
					</div>' ;
					
					changePage('index.php?page=listtext', 2);
				}
			}
		}
		closedir($MyDirectory);
	}
}
?>