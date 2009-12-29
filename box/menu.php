<?php

echo '<dl id="menu">';

if(!isset($_SESSION['id']))
{
	
	echo '
		<dt><a href="index.php?page=inscription">Inscription</a></dt>
		<dd>
			<ul>
				<li><a href="index.php?page=inscription">Vous devez vous inscrire pour profiter des services de ce site</a></li>
			</ul>
		</dd>';
	
}else{

	echo '<dt>Bienvenue '.$_SESSION['pseudo'].',</dt>
			<dd>
				<ul>
					<li><a href="index.php?page=article&article=1">Ajouter un récit</a></li>
					<li><a href="index.php?page=article&article=2">Gestion des catégories</a></li>
					<li><a href="index.php?page=article&article=2">Changer son mot de passe</a></li>
				</ul>
			</dd>
			<dt><a href="index.php?page=accueil&d=1">Se déconnecter</a></dt>
	';

}

echo '</dl>';

?>