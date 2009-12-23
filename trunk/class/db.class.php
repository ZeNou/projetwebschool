<?php

class Erreur extends Exception {

	public function __construct($Msg) {
		parent :: __construct($Msg);
	}

	public function RetourneErreur() {

		$msg = '<p><strong>' . $this->getMessage() . '</strong></p>';
		$msg .= '<p><strong>Ligne</strong> : ' . $this->getLine() . '</p></p>';
		$msg .= '<p><strong>Message</strong> : '.mysql_error().'</p>';
		return $msg;
		
	}
}

class Sql
{
	private
	$Serveur = '',
	$Bdd = '',
	$Identifiant = '',
	$Mdp = '',
	$Lien = '',
	$Debogue = true,
	$LimiteParPage,
	$PageCourante = 1,
	$nombreItemsTotal = 0,
	$NbRequetes = 0;

	public function __construct($Serveur = cfgServeur, $Bdd = cfgBdd, $Identifiant = cfgLogin, $Mdp = cfgPass)
	{
		$this->Serveur = $Serveur;
		$this->Bdd = $Bdd;
		$this->Identifiant = $Identifiant;
		$this->Mdp = $Mdp;

		$this->Lien=mysql_connect($this->Serveur, $this->Identifiant, $this->Mdp);

		if (!$this->Lien && $this->Debogue) throw new Erreur ('Erreur de connexion au serveur SQL.');

		$Base = mysql_select_db($this->Bdd,$this->Lien);

		if (!$Base && $this->Debogue) throw new Erreur ('Erreur de connexion à la base de données.');
		
	}

	public function RetourneNbRequetes()
	{
		return $this->NbRequetes;
	}

	
	public function TabSQL($Requete, $LimiteParPage = 0, $PageCourante = 1, $CountSpecial = '')
	{
				
		if($LimiteParPage != 0)
		{
			$Requete_count 		= '';
			/*
			 * On assigne les valeurs rentré par l'utilisateurs aux valeurs privées de la classe
			 * afin de pouvoir utiliser Paginator sans avoir a rentrer ces données :-)
			 */
			$this->LimiteParPage = $LimiteParPage;
			$this->PageCourante = $PageCourante;

			if( $CountSpecial == '' )
			{
				/* 
				 * Corrige la requete automatiquement pour y glisser notre count perso
				 * Ce qui permet d'écrire qu'une seule fois la requete au lieu de deux :p
				 */
				(!stripos($Requete, 'DISTINCT')) 	? $debut = "SELECT " 	:	$debut = "SELECT DISTINCT ";
				// stripos permet de trouver la position du FROM, puis substr permet de virer tt ce qu'il y a avant
				$Requete_count 				= 	$debut . 'COUNT(*) '. substr($Requete, stripos($Requete, 'FROM'));
				
				$Qry 								= 	mysql_fetch_row(mysql_query($Requete_count,$this->Lien));
				
			}else{
				
				/*
				 * Sinon on utilise le COUNT 'Spécial'...
				 */
				$Qry 								= 	mysql_fetch_row(mysql_query($CountSpecial,$this->Lien));
				
			}
			
			
			$this->nombreItemsTotal	=	$Qry[0];

			$page_nbparpage 				= 	ceil($this->nombreItemsTotal / $this->LimiteParPage);

			$premiereEntree				= 	($this->PageCourante - 1) * $this->LimiteParPage;
			
			$Requete							.= ' LIMIT ' . $premiereEntree . ', ' . $this->LimiteParPage .';';
		}
		
		$i = 0;
			
		$Ressource = mysql_query($Requete,$this->Lien);

		$TabResultat=array();

		if (!$Ressource and $this->Debogue) throw new Erreur ('Erreur de requête SQL.');
		while ($Ligne = mysql_fetch_assoc($Ressource))
		{
			foreach ($Ligne as $clef => $valeur) $TabResultat[$i][$clef] = $valeur;
			$i++;
		}

		mysql_free_result($Ressource);

		$this->NbRequetes++;

		return $TabResultat;
	}

	public function DernierId()
	{
		return mysql_insert_id($this->Lien);
	}

	public function QuerySQL($Requete)
	{
		$Ressource = mysql_query($Requete,$this->Lien);

		if (!$Ressource and $this->Debogue) throw new Erreur ('Erreur de requête SQL.');

		$this->NbRequetes++;
		$NbAffectee = mysql_affected_rows();
		return $NbAffectee;
	}
	
	public function Paginator()
	{
		/*
		 * Si la limite n'a pas été déclarer, celà signifie que l'on ne veux pas de pagination
		 * donc on affiche rien :)
		 */
		if($this->LimiteParPage != 0)
		{
			$pageSuivante		 	= $this->PageCourante;
			$pagePrecedente		= $this->PageCourante - 1;
			$pagePrecedente2		= $this->PageCourante - 2;
			$maxPages				= ceil($this->nombreItemsTotal / $this->LimiteParPage);

			$includePage				= trim($_GET['page']);
			
			
			$laPagination 			= '<div class="pagination" align="center">';

			$espaces 					= ' ';
			//$separation 				= ' ... ';
			$separation 				= ' ';

			if ( $this->PageCourante > 1 ) {
				
				$laPagination .= '<a href="?page='.$includePage.'&n=1">Début</a>'.$separation;
				
				if ( $this->PageCourante > 2) $laPagination .= '<a href="?page='.$includePage.'&n='.$pagePrecedente2.'">Page '.$pagePrecedente2.'</a>'.$espaces.'';
				
				$laPagination .= '<a href="?page='.$includePage.'&n='.$pagePrecedente.'">Page '.$pagePrecedente.'</a>'.$espaces.'';
				
			}


			if ($this->PageCourante < $maxPages) {

				for ($i = $this->PageCourante; $i <= $maxPages; $i++) {
					
					if ($i == $this->PageCourante) {
					
						$laPagination .= '<span>Page '.$i.'</span>'.$espaces.'';
						
					}elseif($i == $this->PageCourante + 1){
					
						$laPagination .= '<a href="?page='.$includePage.'&n='.$pageSuivante.'">Page '.$i.'</a>'.$espaces.'';
					
					}elseif($i == $this->PageCourante + 2){
					
						$laPagination .= '<a href="?page='.$includePage.'&n='.$pageSuivante.'">Page '.$i.'</a>'.$espaces.'';
					
					}
				
					$pageSuivante++;
					
					
				}

			}else{

				$laPagination .= '<span>Page '.$this->PageCourante.'</span>'.$espaces.'';

			}

			if ($this->PageCourante < $maxPages) {

				$laPagination .= $separation . '<a href="?page='.$includePage.'&n='.$maxPages.'">Fin</a>'; // Affiche le lien "Fin" seulement quand c'est pas la dernière page

			}
				
				
			$laPagination .= '</div>';
			
			return $laPagination;
		}
	}
	
	
	
	public function Close()
	{
		if($this->Lien)
			mysql_close($this->Lien);
			
	}

}
?>