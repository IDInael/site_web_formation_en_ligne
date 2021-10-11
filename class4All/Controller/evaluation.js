$(document).ready(function(){

	//var boite_dialog=document.getElementById('boite_dialogue');


	$("#question").load("../Modele/affichage_qcm.php");

	$("#recommencer").click(function(btn){
		btn.preventDefault();
		$("#question").load("../Modele/affichage_qcm.php");
	});

	$("#btn_fermer").click(function(btn){
		btn.preventDefault();
		location.reload(true);
		boite_dialog.close();

	});

	$("#evaluation_qcm").submit(function(e){
		e.preventDefault();

		donnees=$(this).serialize();

		$.ajax({
				url : '../Modele/evaluation.php',
				type : 'POST',
				data : donnees,
				dataType : 'html',
				success : function(reponse,statut){
					$("#message").text(reponse);
					
					if (typeof boite_dialog.showModal === "function")
				    {
				      boite_dialog.showModal();
				    } 
				    else 
				    {
				      alert("L'API dialog n'est pas prise en charge par votre navigateur");
				    }
				},
				error : function(resultat,statut,error){
					alert(error);
					alert(resultat);
				},

				complete : function(resultat,statut){
					
				}
			});
	});

});