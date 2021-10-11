$(document).ready(function(){

	$("#ajouter_cours").hide();



	$('#formulaire_ajout_cours').submit(function(e){

		e.preventDefault();

		var donnees=$("#formulaire_ajout_cours").serialize();
		//$("#formulaire_ajout_cours").submit();
		
		$.ajax({

		url : '../Modele/gestion_cours.php',
		type : 'POST',
		dataType : 'html',
		data : donnees,

		success : function(reponse, status){

				switch(reponse){
					case "existe":
						$("#erreur").text("le cours existe deja");break;
					case "ok":
						
						//alert("cours ajouté avec succes");
						$("#ajouter_cours").hide();
						$("#formulaire_ajout_cours")[0].reset();
						break;

					default :
						$("#erreur").text("Erreur lors du traitement :"+reponse);break;
				}
				location.reload();			
		},

		error : function(resultat,statut,error){
					$('#erreur').append(error);
					$('#erreur').append(statut);
					$('#erreur').append(resultat);
				},
		complete : function(resultat,statut){
					//$('#centrale').load("../Modele/accueil_perso.php");
					location.reload();
				}
	});
	});


	$("#lien_ajout").click(function(e){
		e.preventDefault();
		$("#ajouter_cours").show();
		//location.reload();
	});

	$("#fermer").click(function(e){
		e.preventDefault();
		$("#ajouter_cours").hide();
		$("#formulaire_ajout_cours")[0].reset();
		//location.reload();
	});

});