$(function(){

	// VERIFICATION DU FORMULAIRE D'INSCRIPTION -----------------------------------------------------------------------------------------------------------------
	$('#valid_inscription').click(function() {
		var valid_formulaire = true ;
		
		//VERIF DU PSEUDO
		if($("#pseudo").val() == "")
		{
			$("#pseudo").next(".error").fadeIn().text("Veuillez saisir votre pseudo") ;
			valid_formulaire = false ;
		}
		else if(!$("#pseudo").val().match(/^[a-zA-Z]*$/))
		{
			$("#pseudo").next(".error").fadeIn().text("Veuillez saisir un pseudo valide") ;
			valid_formulaire = false ;
		}
		else if($("#pseudo").val().length <= 2 )
		{
			$("#pseudo").next(".error").fadeIn().text("Pseudo de 3 caractéres minimum") ;
			valid_formulaire = false ;
		}
		else 
		{
			$("#pseudo").next(".error").fadeOut();
		}
		
		//VERIF DU NOM
		if($("#nom").val() == "")
		{
			$("#nom").next(".error").fadeIn().text("Veuillez saisir votre nom") ;
			valid_formulaire = false ;
		}
		else if(!$("#nom").val().match(/^[a-zA-Z]*$/))
		{
			$("#nom").next(".error").fadeIn().text("Veuillez saisir un nom valide") ;
			valid_formulaire = false ;
		}
		else if($("#nom").val().length <= 2 )
		{
			$("#nom").next(".error").fadeIn().text("Nom de 3 caractéres minimum") ;
			valid_formulaire = false ;
		}
		else 
		{
			$("#nom").next(".error").fadeOut();
		}
		
		//VERIF DU PRENOM
		if($("#prenom").val() == "")
		{
			$("#prenom").next(".error").fadeIn().text("Veuillez saisir votre prenom") ;
			valid_formulaire = false ;
		}
		else if(!$("#prenom").val().match(/^[a-zA-Z]*$/))
		{
			$("#prenom").next(".error").fadeIn().text("Veuillez saisir un prenom valide") ;
			valid_formulaire = false ;
		}
		else if($("#prenom").val().length <= 2 )
		{
			$("#prenom").next(".error").fadeIn().text("Prenom de 3 caractére minimum") ;
			valid_formulaire = false ;
		}
		else 
		{
			$("#prenom").next(".error").fadeOut();
		}
		
		//VERIF DU MOT DE PASSE 1
		if($("#pass").val() == "")
		{
			$("#pass").next(".error").fadeIn().text("Veuillez saisir votre mot de passe") ;
			valid_formulaire = false ;
		}
		else if(!$("#pass").val().match(/^[a-zA-Z\d]*$/))
		{
			$("#pass").next(".error").fadeIn().text("Veuillez saisir un mot de passe valide") ;
			valid_formulaire = false ;
		}
		else if($("#pass").val().length <= 5 )
		{
			$("#pass").next(".error").fadeIn().text("Mot de passe de 6 caractéres minimum") ;
			valid_formulaire = false ;
		}
		else 
		{
			$("#pass").next(".error").fadeOut();
		}
		
		//VERIFICATION DU PASS 2
		if($("#pass2").val() == "")
		{
			$("#pass2").next(".error").fadeIn().text("Veuillez confirmer de votre mot de passe") ;
			valid_formulaire = false ;
		}
		else if(!$("#pass2").val().match(/^[a-zA-Z\d]*$/))
		{
			$("#pass2").next(".error").fadeIn().text("Votre confirmation du mot de passe n'est pas valide") ;
			valid_formulaire = false ;
		}
		else if($("#pass2").val().length <= 5 )
		{
			$("#pass2").next(".error").fadeIn().text("Mot de passe de 6 caractéres minimum") ;
			valid_formulaire = false ;
		}
		else 
		{
			$("#pass2").next(".error").fadeOut();
		}
		
		if($("#pass").val() != $("#pass2").val())
		{
			$("#pass").next(".error").fadeIn().text("Le mot de passe saisie ne correspond avec la confirmation") ;
			$("#pass2").next(".error").fadeIn().text("Le mot de passe saisie ne correspond avec la confirmation") ;
			valid_formulaire = false ;
		}
		
		//VERIF DU MAIL
		if($("#mail").val() == "")
		{
			$("#mail").next(".error").fadeIn().text("Veuillez saisir votre email") ;
			valid_formulaire = false ;
		}
		else if(!$("#mail").val().match(/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/))
		{
			$("#mail").next(".error").fadeIn().text("Veuillez saisir un email valide") ;
			valid_formulaire = false ;
		}
		else 
		{
			$("#mail").next(".error").fadeOut();
		}
		
		return valid_formulaire ;
	});
	//FIN VERIF FORM INSCRIPTION
	
	//VERIFICATION DU FORMULAIRE D'AJOUT D'UNE CATEGORIE -------------------------------------------------------------------------------------------------------
	$('#valid_addcat').click(function() {
		var valid_formulaire = true ;
		
		//VERIF DU NOM
		if($("#cat").val() == "")
		{
			$("#cat").next(".error").fadeIn().text("Nom vide") ;
			valid_formulaire = false ;
		}
		else if(!$("#cat").val().match(/^[a-zA-Z]*$/))
		{
			$("#cat").next(".error").fadeIn().text("Saisir un nom valide") ;
			valid_formulaire = false ;
		}
		else if($("#cat").val().length <= 2 )
		{
			$("#cat").next(".error").fadeIn().text("3 caractéres minimum") ;
			valid_formulaire = false ;
		}
		else 
		{
			$("#cat").next(".error").fadeOut();
		}
		
		return valid_formulaire ;
	});
	
	//VERIFICATION DU FORMULAIRE DE MODIFICATION D'UNE CATEGORIE ----------------------------------------------------------------------------------------------
	$('#confirm_addNewNameCat').click(function() {
		var valid_formulaire = true ;
		
		//VERIF DU NOM
		if($("#add_newnamecat").val() == "")
		{
			$("#add_newnamecat").next(".error").fadeIn().text("Nom vide") ;
			valid_formulaire = false ;
		}
		else if(!$("#add_newnamecat").val().match(/^[a-zA-Z]*$/))
		{
			$("#add_newnamecat").next(".error").fadeIn().text("Saisir un nom valide") ;
			valid_formulaire = false ;
		}
		else if($("#add_newnamecat").val().length <= 2 )
		{
			$("#add_newnamecat").next(".error").fadeIn().text("3 caractéres minimum") ;
			valid_formulaire = false ;
		}
		else 
		{
			$("#add_newnamecat").next(".error").fadeOut();
		}
		
		return valid_formulaire ;
	});
	
	//VERIFICATION DU FORMULAIRE D'AJOUT D'UN TEXTE -----------------------------------------------------------------------------------------------------------------
	$('#valid_addtext').click(function() {
		var valid_formulaire = true ;
		
		//VERIF DU TITRE
		if($("#titre").val() == "")
		{
			$("#titre").next(".error").fadeIn().text("Titre vide") ;
			valid_formulaire = false ;
		}
		else if(!$("#titre").val().match(/^[a-zA-Z ]*$/))
		{
			$("#titre").next(".error").fadeIn().text("Saisir un titre valide") ;
			valid_formulaire = false ;
		}
		else if($("#titre").val().length <= 2 )
		{
			$("#titre").next(".error").fadeIn().text("3 caractéres minimum") ;
			valid_formulaire = false ;
		}
		else 
		{
			$("#titre").next(".error").fadeOut();
		}
		
		//VERIF DU CORPS
		if($("#corps").val() == "")
		{
			$("#corps").next(".error").fadeIn().text("Le corps du texte est vide") ;
			valid_formulaire = false ;
		}
		else if($("#corps").val().length <= 20 )
		{
			$("#corps").next(".error").fadeIn().text("20 caractéres minimum") ;
			valid_formulaire = false ;
		}
		else 
		{
			$("#corps").next(".error").fadeOut();
		}
		
		//VERIF DE LA CATEGORIE
		if($("#cat").val() == 0)
		{
			$("#cat").next(".error").fadeIn().text("Choisir un catégorie") ;
			valid_formulaire = false ;
		}else 
		{
			$("#cat").next(".error").fadeOut();
		}
		
		//VERIF DES AUTORISATION
		var checkOK = $("input:checked").length ;
      
		if(checkOK == 0)
		{
			if (!confirm("Votre texte ne pourras être ni lu, ni noté, ni commenter ?"))
			{ 
				$(".checkboxautorisation").fadeOut() ;
				valid_formulaire = false ;
			}
		}
		
		if(checkOK != 0)
		{
			var lectureOK = 0 ;
			for(var i=1; i<=checkOK ; i++)
			{
				if($('#check'+[i]).val() == 1)
				{
					lectureOK ++ ;
				}
			}
			
			if(lectureOK == 0)
			{
				$(".checkboxautorisation").fadeIn().text("Vous devez mettre votre texte en lecture pour qu'il puisse être lu ou commenté") ;
				valid_formulaire = false ;	
			}
		}
		
		return valid_formulaire ;
	});
});