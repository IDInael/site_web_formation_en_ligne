$(document).ready(function(){

	

	$("#formulaire_inscription").submit(function(e){
		e.preventDefault();

		var donnees=$(this).serialize();
		var mdp1=$('#mdp').val();
		var mdp2=$('#mdp2').val();

		if(mdp1==mdp2)
		{
			$.ajax({
			url : '../Modele/inscription.php',
				type : 'POST',
				data : donnees,

				dataType : 'html',
				success : function(reponse,statut){
					if(reponse=='existe')
						$('#erreur_msg').text("cette adresse mail est deja utilisé par un compte !");
					else if(reponse=='ok')
						window.location.replace("../Vue/connection.html");
					else
					{
						$('#erreur_msg').text("erreur serveur :");
						$('#erreur_msg').append(reponse);
					}

				},
				error : function(resultat,statut,error){
					$('#erreur_msg').append(error);
					$('#erreur_msg').append(resultat);
				},

				complete : function(resultat,statut){
					
				}
			});
		}
		else
		{
			$('#erreur_msg').text("veuiller verifier la confirmation de votre mots de passe");
			$('#mdp2').focus()
		}

	});
});