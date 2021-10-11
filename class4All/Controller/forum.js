$(document).ready(function(){

	$("#discussion").load('../Modele/affichage_forum.php');

	setInterval(function () {
        $('#discussion').load('../Modele/affichage_forum.php');
    }, 3000);

	$("#publication").submit(function(e){
		e.preventDefault();

			var donnees=$(this).serialize();

			$.ajax({
				url : '../Modele/sauvegarde_forum.php',
				type : 'POST',
				data : donnees,
				dataType : 'html',
				success : function(reponse,statut){
					$("#discussion").load('../Modele/affichage_forum.php');
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

