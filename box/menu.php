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
	if($_SESSION['level'] == 1)
	{
		echo '	<dt>Bienvenue '.$_SESSION['pseudo'].' :</dt>
					<dd>
						<ul>
							<li><a href="index.php?page=">Lire des textes</a></li>
							<li><a href="index.php?page=addtext">Ajouter un récit</a></li>
						</ul>
					</dd>
				<dt>Votre compte : </dt>
					<dd>
						<ul>
							<li><a href="index.php?page=">Gerer vos amis</a></li>
							<li><a href="index.php?page=">Modifier les informations de votre compte</a></li>
							<li><a href="index.php?page=">Modifier votre mot de passe</a></li>
						</ul>
					</dd>
				<dt><a href="index.php?page=">Se déconnecter</a></dt>
		';
	}
	elseif($_SESSION['level'] == 9)
	{
		echo '	<dt>Bienvenue '.$_SESSION['pseudo'].' :</dt>
				<dd>
					<ul>
						<li><a href="index.php?page=addtext">Ajouter un récit</a></li>
						<li><a href="index.php?page=">Changer son mot de passe</a></li>
					</ul>
				</dd>
				<dt>Catégorie :</dt>
				<dd>
					<ul>
						<li><a href="index.php?page=addcategorie">Ajouter une catégories</a></li>
						<li><a href="index.php?page=modifcategorie">Modifier une catégories</a></li>
					</ul>
				</dd>
				<dt><a href="index.php?page=">Se déconnecter</a></dt>
		';
	}
}

echo '</dl>';

?>