<?php

echo '<dl id="menu">';

if(!isset($_SESSION['id']))
{
	
	echo '
		<dt>Inscription</dt>
		<dd>
			<ul>
				<li><a href="index.php?page=inscription">Vous devez vous inscrire pour profiter des services de ce site</a></li>
			</ul>
		</dd>';
	
}else{

	echo '<dt>Bienvenue '.$_SESSION['pseudo'].' :</dt>
					<dd>
						<ul>
							<li><a href="index.php?page=listtext">Lire des textes</a></li>
							<li><a href="index.php?page=addtext">Ajouter un récit</a></li>
						</ul>
					</dd>
				<dt>Votre compte : </dt>
					<dd>
						<ul>
							<li><a href="index.php?page=listamis">Gerer vos amis</a></li>
							<li><a href="index.php?page=">Modifier les informations de votre compte</a></li>
							<li><a href="index.php?page=">Modifier votre mot de passe</a></li>
						</ul>
					</dd>
		';
	
	/* Si le membre est un administrateur */
	if($_SESSION['level'] == 9){
	
		echo '<dt>Catégorie :</dt>
					<dd>
						<ul>
							<li><a href="index.php?page=addcategorie">Ajouter une catégories</a></li>
							<li><a href="index.php?page=modifcategorie">Modifier une catégories</a></li>
						</ul>
					</dd>
		';
		
	}
	
	echo '<dt><a href="index.php?page=accueil&d=1">Se déconnecter</a></dt>';
	
	
	
}

echo '</dl>';

?>