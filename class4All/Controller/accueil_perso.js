$(document).ready(function(){

	$.ajax({

		url : '../Modele/gestion_connexion.php',
		type : 'GET',
		dataType : 'html',
		data : "commande=connexion",

		success : function(reponse, status){

			if(reponse=="ko"||reponse=="deconnexion")
			{
				window.location.replace("../Vue/connection.html");
			}
			else
			{
				//$("#logo_holder").load("../Vue/logo.html");
				$("footer").load("../Vue/footer.html");
				$('#centrale').load("../Modele/accueil_perso.php");
				//$("#utilisateur").append(reponse);
			}
		},

		error : function(resultat,statut,error){
					$('#erreur').append(error);
					$('#erreur').append(statut);
					$('#erreur').append(resultat);
				}
	});

	$('#deconnexion').click(function(){
		$.ajax({

		url : '../Modele/gestion_connexion.php',
		type : 'GET',
		dataType : 'html',
		data : "commande=deconnexion",

		success : function(reponse, status){

			if(reponse=="deconnexion")
			{
				window.location.replace("../Vue/connection.html");
			}
			else
			{
				$("#utilisateur").append(reponse);
			}
		},

		error : function(resultat,statut,error){
					$('#erreur').append(error);
					$('#erreur').append(statut);
					$('#erreur').append(resultat);
				}
	});
	});

});