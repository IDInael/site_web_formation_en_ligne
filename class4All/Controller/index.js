$(document).ready(function(){

	$('#seconnecter').click(function(){
		$.ajax({

		url : '../Modele/home.php',
		type : 'GET',
		dataType : 'html',

		success : function(reponse, status){

			if(reponse=="1")
			{
				window.location.replace("../Vue/accueil_etu.php");
			}
			else if(reponse=="2")
			{
				window.location.replace("../Vue/accueil_ens.php");
			}
			else
			{
				window.location.replace("../Vue/connection.html");
			}
		},

		error : function(resultat,statut,error){
					$('#erreur').append(error);
					$('#erreur').append(statut);
					$('#erreur').append(resultat);
				}
	});
	});

	$('#s_inscrire').click(function(){
		$.ajax({

		url : '../Modele/home.php',
		type : 'GET',
		dataType : 'html',

		success : function(reponse, status){

			if(reponse=="1")
			{
				window.location.replace("../Vue/accueil_etu.php");
			}
			else if(reponse=="2")
			{
				window.location.replace("../Vue/accueil_ens.php");
			}
			else
			{
				window.location.replace("../Vue/inscription.html");
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