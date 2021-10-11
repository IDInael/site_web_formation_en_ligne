$(document).ready(function(){

$('#logo_holder').load('../Vue/logo.html');
	$('footer').load('../Vue/footer.html');
	

	$("#login_compte").submit(function(e){
		e.preventDefault();

		var donnees=$(this).serialize();

			$.ajax({
			url : '../Modele/connection.php',
				type : 'POST',
				data : donnees,

				dataType : 'html',
				success : function(reponse,statut){

					switch(reponse){
						case '0': 
							$('#erreur_msg').text("verifier que votre login ou mail est correcte");
							break;
						case '1':
							$('#erreur_msg').text("mot de passe incorrect");
							break;
						case 'etu':
							window.location.replace("../Vue/accueil_etu.php");
							break;
						case 'ens':
							window.location.replace("../Vue/accueil_ens.php");
							break;
						default :
							$('#erreur_msg').text(reponse);
					}

				},
				error : function(resultat,statut,error){
					$('#erreur_msg').append(error);
					$('#erreur_msg').append(statut);
					$('#erreur_msg').append(resultat);
				},

				complete : function(resultat,statut){
					
				}
			});
	});

	$("#logo_holder").click(function(){
		window.location.replace("../Vue/index.html");
	})

});