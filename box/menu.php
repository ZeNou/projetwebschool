<?php

echo '<dl id="menu">';

if(!isset($_SESSION['id']))
{
	
	echo '
		<dt><a href="index.php?page=article&rubrique=1">Rubrique 1</a></dt>
		<dd>
			<ul>
				<li><a href="index.php?page=article&article=1">article 1.1</a></li>
				<li><a href="index.php?page=article&article=2">article 1.2</a></li>
				<li><a href="index.php?page=article&article=3">article 1.3</a></li>
			</ul>
		</dd>
		<dt><a href="index.php?page=article&rubrique=2">Rubrique 2</a></dt>
		<dd>
			<ul>
				<li><a href="index.php?page=article&article=4">article 2.1</a></li>
				<li><a href="index.php?page=article&article=5">article 2.2</a></li>
				<li><a href="index.php?page=article&article=6">article 2.3</a></li>
			</ul>
		</dd>
		<dt><a href="index.php?page=article&rubrique=3">Rubrique 3</a></dt>
		<dd>
			<ul>
				<li><a href="index.php?page=article&article=7">article 3.1</a></li>
				<li><a href="index.php?page=article&article=8">article 3.2</a></li>
				<li><a href="index.php?page=article&article=9">article 3.3</a></li>
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
			<dt><a href="index.php?page=article&rubrique=3">Se déconnecter</a></dt>
	';

}

echo '</dl>';

?>