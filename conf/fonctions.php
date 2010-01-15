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
			
			
		}elseif($type == 2){
		
			echo '<meta http-equiv="refresh" content="2;url='.$page.'" />';
		
		}else{
		
			echo '<meta http-equiv="refresh" content="0;url='.$page.'" />';
			
		}
	}
	
	
	
	function errAcces()
	{
		return('<br /><br />
					<ul class="erreur">
						<li>Vous n\'avez pas accès à cette page</li>
					</ul>');
	}
	
?>