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
				$extension = explode('.', $search_txt[8]) ;
				if($extension[0] == $idtext)
				{
					if($search_txt[7] == 'false')
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
						
						$add_txt = new Sql();
							
						$add_new = Req($add_txt,'	INSERT INTO texte (id_membre , titre , corps , date_ajout , id_categorie , droit_lecture , droit_notation , droit_commenter)
													VALUES ('.$search_txt[0].' , "'.$search_txt[2].'" , "'.$contenutxt.'" , NOW() , '.$search_txt[1].' , '.$search_txt[3].' , '.$search_txt[4].' , '.$search_txt[5].') ') ;
							
							rename('user_txt/'.$file.'' , 'user_txt/'.$search_txt[0].'#'.$search_txt[1].'#'.$search_txt[2].'#'.$search_txt[3].'#'.$search_txt[4].'#'.$search_txt[5].'#'.$search_txt[6].'#true#'.$extension[0].'.txt' );
							
						echo '<br /><br />
						<div class="form_addtxttobdd">
							<ul class="ok">
								<li>Le texte à bien été ajouté à la base de données (Veuillez patientez...)</li>
							</ul>				
						</div>' ;
						
						changePage('index.php?page=listtext', 2);
					}
					else
					{
						echo '<br /><br />
								<ul class="erreur">
									<li>Texte déja dans la base de données</li>
								</ul>' ;
					}
				}
			}
		}
		closedir($MyDirectory);
	}
}
?>