<?php

	
	function Req($obj, $requete)
	{
	
		try
		{

			return $obj->QuerySQL($requete);
						  
		}catch (Erreur $e) {
		
			echo $e->RetourneErreur();
			
		}
		
	}
	
	
	
	
	function Tab($obj, $requete, $LimiteParPage = 0, $PageCourante = 1, $CountSpecial = '')
	{
	
		try
		{

			return $obj->TabSQL($requete, $LimiteParPage, $PageCourante, $CountSpecial);
						  
		}catch (Erreur $e) {
		
			echo $e->RetourneErreur();
			
		}
		
	}
	
	function getIp()   //Permet d'avoir l'ip d'un membre (meme si proxy)
	{
		if ( isset($_SERVER['HTTP_X_FORWARDED_FOR']) )
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else
			$ip = $_SERVER['REMOTE_ADDR'];
					
		return $ip;
	}

	
	
	function AffPseudo($taille, $avant = '', $apres = '', $couleur = '')
	{
	
		if($taille == 'gros')
		{
			
			echo '<span class="PseudoGros"><font color="'.$couleur.'">'.$avant.'</font>'.$_SESSION['pseudo'].'<font color="'.$couleur.'">'.$apres.'</font>'.'</span>';
			
		}elseif($taille == 'petit'){
			
			echo $_SESSION['pseudo'];
			
		}else{
			
			echo '<span class="PseudoGros"><font color="'.$couleur.'">'.$avant.'</font>'.$_SESSION['pseudo'].'<font color="'.$couleur.'">'.$apres.'</font>'.'</span>';
			
		}
		
	}
	
	function usrId()
	{
		return($_SESSION['id']);
	}
	
	function changePage($page, $type)
	{
		if ($type == 0)
		{
		
			header('Location: '.$page.'');
			
		}elseif($type == 1){
			
			echo '<meta http-equiv="refresh" content="0;url='.$page.'" />';
			
			
		}else{
		
			echo '<meta http-equiv="refresh" content="0;url='.$page.'" />';
		
		}
	}
	
	
	
	function getEtat($etat)
	{
		
		switch($etat)
		{
			case 0 : return('<span class="infoEtat" title="Votre site doit être soumis à une vérification manuelle par les administrateurs du site.">Vérification</span>');
			break;
			
			case 1 : return('<span class="infoEtat" title="Votre site est désormais validé.">Validé <img src="images/valider_24x24.png" /></span>');
			break;
			
			default : return('<span class="infoEtat" title="En vérification...">En vérification...</span>');
			break;
		}
		
		
	}
	
	function getFlag($numero_pays)
	{
		switch($numero_pays)
		{
			case 1 : return('<img src="images/pays/fr_16x16.png" border="0" title="France" />');
			break;
			
			default : return('<img src="images/pays/fr_16x16.png" border="0" title="France" />');
			break;
		}
	}
	
	
	function creeCookies($valeur)
	{
		@setcookie("sid",$valeur,time()+365*24*3600);
	}
	
	
	function supprimerCookies()
	{
		setcookie('sid');
		setcookie('sid', '', time() - 3600);
	}
	
	function getCred()
	{
		if(isset($_SESSION['id']))
		{
			$getCred			= new Sql();
			

			$mbr_cred		= Tab($getCred,'SELECT credits
															FROM '.tblmembres.'
															WHERE id = \''.$_SESSION['id'].'\'');

			$membresCred	= $mbr_cred[0]['credits'];
			
			$getCred->Close();
			
			return $membresCred;
		}
	}
	
	function addHisto($objet, $action, $mbr_id, $secondmbr = 'NULL', $site_id = 'NULL', $somme = 'NULL', $ancien_solde = 'NULL', $nouveau_solde = 'NULL', $infos = 'NULL')
	{
	
		if($secondmbr 			!= 'NULL') $secondmbr 		= '\'' .$secondmbr . '\'';
		if($site_id 				!= 'NULL') $site_id				= '\'' .$site_id . '\'';
		if($somme 				!= 'NULL') $somme 			= '\'' .$somme . '\'';
		if($ancien_solde 		!= 'NULL') $ancien_solde 	= '\'' .$ancien_solde . '\'';
		if($nouveau_solde 	!= 'NULL') $nouveau_solde 	= '\'' .$nouveau_solde . '\'';
		if($infos 					!= 'NULL') $infos 				= '\'' .$infos . '\'';
		
		

		$histo_req		= Req($objet,	'INSERT INTO '.tblhistoriques.' (membre_id, historiques_action_id, autre_membre_id, sites_id, somme, ancien_solde, nouveau_solde, ip, date, infos)
													 VALUES (\''.$mbr_id.'\',\''.$action.'\','.$secondmbr.','.$site_id.','.$somme.','.$ancien_solde.','.$nouveau_solde.',\''.getIp().'\',NOW(),'.$infos.');
														');


	}
	
?>