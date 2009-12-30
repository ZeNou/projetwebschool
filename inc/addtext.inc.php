<?php
if(isset($_SESSION['id']))
{
	function form_addtext()
	{
		echo 
		'<h1>Ajouter un texte :</h1><br />
		<form action="#" method="POST" name="formulaire_addtext" id="formulaire_addtext">
			<table id="formulaire_addtext">
				<tr>
					<td> <label for="titre"> Titre : </label> </td>
					<td> <input type="text" name="add_txttitre" id="titre" /> <span class="error"> &nbsp; </span> </td>
				</tr>
				<tr>
					<td> <label for="corps"> Corps du texte : </label> </td>
					<td> <textarea name="add_txtcorps" id="corps" rows=10 cols=30></textarea> <span class="error"> &nbsp; </span> </td>
				</tr>
				<tr>
					<td> <label for="cat"> Catégorie : </label> </td>
					<td> ' ;
						$list_cat = new Sql();
									
						$tab_cat = Tab($list_cat,'	SELECT id, nom
													FROM categorie  ');
								
						echo '<select name="add_txtcat" id="cat">
								<option value="0" selected="selected"> --- Choisir --- </option>' ;
							foreach ($tab_cat as $tab_msg)
							{
								$id = base64_encode($tab_msg['id']) ;
								echo '<option value="'.$id.'"> '.$tab_msg['nom'].' </option>';
							}
						echo '</select> <span class="error"> &nbsp; </span>';
				echo '
					</td>
				</tr>
				<tr>
					<td> Autorisation : </label> </td>
					<td> 
						<input type="checkbox" name="droit[]" id="check1" value="1" checked="checked" /> <label for="check1">Lecture	</label><br />
						<input type="checkbox" name="droit[]" id="check2" value="2" /> <label for="check2">Notation	</label><br />
						<input type="checkbox" name="droit[]" id="check3" value="3" /> <label for="check3">Commentaire</label><br /> 	
						<span class="error checkboxautorisation"> &nbsp; </span>						
					</td>
				</tr>
				<tr>
					<td colspan="2"> <input type="submit" value="Envoyer" name="valid_addtext" id="valid_addtext" /></td>
				</tr>
			</table>
		</form>';
	}

	if(isset($_POST['valid_addtext']))
	{	
		$phptitre = $_POST['add_txttitre'];
		$phpcorps = $_POST['add_txtcorps'];
		$phpcat = base64_decode($_POST['add_txtcat']);
		
		if(isset($_POST['droit']))
			$phpdroit = $_POST['droit'];
		else
			$phpdroit = array(0,0,0) ;
		
		foreach ($phpdroit as $choix)
		{
			if($choix == 1)
			{
				$phplecture = 1 ;
			}
			if($choix == 2)
			{
				$phpnotation = 1 ;
			}
			if($choix == 3)
			{
				$phpcomm = 1 ;
			}
		}
			if(!isset($phplecture)) $phplecture=0;
			if(!isset($phpnotation)) $phpnotation=0;
			if(!isset($phpcomm)) $phpcomm=0;
		
				$erreur = array() ;
				
		if(empty($phptitre))
		{
			array_push($erreur, "Le titre est vide !") ;
		}
		else
		{
			if (strlen($phptitre) < 2)
			{
				array_push($erreur, "Saisir un titre de 2 caractéres minimum") ;			}	
		}		
		
		if (empty($phpcorps))
		{
			array_push($erreur, "Le corps du texte est vide !") ;
		}
		else
		{
			if (strlen($phpcorps) < 20)
			{
				array_push($erreur, "Saisir un texte de 20 caractéres minimum") ;
			}	
		}
		
		if (empty($phpcat))
		{
			array_push($erreur, "Aucune catégorie choisie !") ;
		}
		else
		{
			if (strlen($phpcat) == 0)
			{
				array_push($erreur, "Saisir une catégorie") ;
			}	
		}
		
		if (count($erreur) != 0)
		{
			form_addtext();
		
			echo '<br /><br />
				<div class="form_addtxt">
					<ul class="erreur">' ;
			foreach ($erreur as $err_msg)
			{
				echo '<li>'.$err_msg.'</li>';
			}
			echo '</ul>
				</div>';
		}
		else
		{
			//CREATION FICHIER TXT
			$filename = $_SESSION['id'].'#'.$phpcat.'#'.$phptitre.'#'.$phplecture.'#'.$phpnotation.'#'.$phpcomm.'#'.time().'.txt' ;
        
				$open = fopen('user_txt/'.$filename,"w+");
			 
			if (is_writable('user_txt/'.$filename)) 
			{
				if (fwrite($open, $phpcorps) == false) 
				{
					echo 'Impossible d\'écrire dans le fichier '.$filename.'';
					exit;
				}     
				else
				{
					echo '<br /><br />
					<div class="form_modifcat">
						<ul class="ok">
							<li>Votre texte à bien été créer</li>
						</ul>				
					</div>' ;
				}
			}
			else 
			{
				echo 'Impossible d\'écrire dans le fichier '.$filename.'';
			}
			
			fclose($open); 
		}
		
	}else{
		form_addtext();
	}
}
?>