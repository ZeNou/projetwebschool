<?php

if(isset($_SESSION['id'])) exit();


$form_inscription = new Form('formulaire_inscription', 'POST');

$form_inscription->add('Text', 'frm_pseudo')
							 ->maxlength(10)
							 ->label("Votre nom d'utilisateur");

$form_inscription->add('Email', 'frm_mail')
							  ->label("Votre adresse email"); 
				 
$form_inscription->add('Text', 'frm_parrain')
							 ->label("Votre parrain")
							 ->Required(false);


$form_inscription->add('Submit', 'submit')
							 ->value("Je m'inscris !");

// Pré-remplissage avec les valeurs précédemment entrées (s'il y en a)
$form_inscription->bound($_POST);

	

if ($form_inscription->is_valid($_POST)) {


	$phppseudo		= $form_inscription->get_cleaned_data('frm_pseudo');
	$phpmail 			= $form_inscription->get_cleaned_data('frm_mail');
	$phpparrain 		= $form_inscription->get_cleaned_data('frm_parrain');
	$phplangue		= 1;


	$phppass			= GenerePassword(6); 
	$phppass_crypt	= sha1($phppass); //encrypter le pass
	echo $phppass;

	$insert 				= new Sql();
	
	
	$pseudo_exist 	= Req($insert,'SELECT id
														 FROM '.tblmembres.'
														 WHERE pseudo = \''.$phppseudo.'\'');
				 
	$mail_exist		= Req($insert,'SELECT id
														 FROM '.tblmembres.'
														 WHERE email = \''.$phpmail.'\'');
														 
	$tab_erreurs		= array();

	
	
	
	
	
	if( $pseudo_exist != 0 ) 					$tab_erreurs[] = 'Le pseudo choisis existe déjà.';
	if( mb_strlen($phppseudo) < 3) 		$tab_erreurs[] = 'Le pseudo doit faire au minimum 3 caractères.';
	if( $mail_exist != 0 ) 						$tab_erreurs[] = 'Le mail choisis existe déjà.';
	
	/*
	 * On check  si l'utilisateur a rentré un parrain
	 */
	if(mb_strlen($phpparrain) != 0)
	{
	
			if( !is_numeric($phpparrain) )	
			{
			
				$tab_erreurs[] = 'L\'identifiant de votre parrain doit être sous forme de chiffres.';
				
			}else{
			
				/*
				 * On vérifie si le parrain existe
				  */
				$parrain_exist		= Req($insert,'SELECT pseudo
																		 FROM '.tblmembres.'
																		 WHERE id = \''.$phpparrain.'\'');
				/*
				 * S'il n'existe pas, alors le parrain est NULL.
				  */
				if($parrain_exist != 1) $phpparrain = 'NULL';
				
			}
			
	}else{
	
		$phpparrain = 'NULL';
	
	}
	
			if( count($tab_erreurs) == 0 )
			{
			
				// alors on insert le membre dans la bdd
				$uniqid		= md5(uniqid(mt_rand(), true));
				
				
				$insertion	= Req($insert,'INSERT INTO '.tblmembres.' (pseudo, pass, email, date_creation, uniqid, langue_id, parrain)
															 VALUES (\''.$phppseudo.'\',\''.$phppass_crypt.'\',\''.$phpmail.'\', NOW(),\''.$uniqid.'\',\''.$phplangue.'\','.$phpparrain.');
															');
				
				$idnouvelinscrit = $insert->DernierId();
				
				// Ajout au logs l'inscription du mec
				addHisto($insert, 1, $idnouvelinscrit);
				
				// Ajout dans l'historique du parrain l'inscription de son filleul
				if ($parrain_exist == 1)
				addHisto($insert, 4, $phpparrain, $idnouvelinscrit);
				
				
				echo 'INSCRIPTION OK !';
			
			}else{
			
				// sinon on affiche le(s) msg derreur
				echo '<ul class=\'erreur\'>';
				
					foreach ($tab_erreurs as $err_msg)
					{
						echo '<li>' . $err_msg . '</li>';
					}
				
				// mettre un javascript history back
				
				echo '</ul>';
			
			}
	
	
	
	$insert->Close();
	
	
	
} else {
	
	
	echo $form_inscription;
	
	
}



?>