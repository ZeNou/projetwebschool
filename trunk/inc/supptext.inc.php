<?php
if(isset($_SESSION['id']) AND $_SESSION['level'] == 9)
{
	if(isset($_GET['idtext']))
	{
		$idtxt = base64_decode($_GET['idtext']) ;
		$typefichier = base64_decode($_GET['type']) ;
	
		if($typefichier == 'fichier')
		{
			$MyDirectory = opendir('user_txt');
			while($file = @readdir($MyDirectory)) 
			{
				if(!is_dir('user_txt'.'/'.$file) AND $file != '.' AND $file != '..') 
				{
					$valeur = explode("#", $file) ;
					$extension = explode(".", $valeur[8]) ;
					
					if($extension[0] == $idtxt)
					{
						if(file_exists('user_txt/'.$file))
						{
							unlink('user_txt/'.$file);
							
							echo '<br /><br />
							<div class="form_modifcat">
								<ul class="ok">
									<li>Fichier supprimé (Veuillez patientez...)</li>
								</ul>				
							</div>' ;
							
							//changePage('index.php?page=listtext', 2);
						}
					}
					
					if($extension[0] > $idtxt)
					{
						rename('user_txt/'.$file.'' , 'user_txt/'.$valeur[0].'#'.$valeur[1].'#'.$valeur[2].'#'.$valeur[3].'#'.$valeur[4].'#'.$valeur[5].'#'.$valeur[6].'#'.$valeur[7].'#'.($extension[0]-1).'.txt' );
					}
				}
			}
			closedir($MyDirectory);
		}
		else
		{
			$del_txt = new Sql();
						
			$del = Req($del_txt,'	DELETE FROM texte
									WHERE id = '.$idtxt.'  ');
										
			changePage('index.php?page=listtext', 1);		
		}
	}	
}
else
{

	echo '<br /><br />
			<ul class="erreur">
				<li>Vous n\'avez pas accès à cette page</li>
			</ul>' ;

}
?>