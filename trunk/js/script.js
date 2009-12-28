$(function(){

	// VERIFICATION DU FORMULAIRE D'INSCRIPTION
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
	
});