$(document).ready(function(){

	$("#formulaire").hide();

	$("#contenu").load("../Modele/liste_contenu.php");

	$("#ajout_contenu").submit(function(e){
		e.preventDefault();

		//var donnees=$("#ajout_contenu").serialize();
		//$("#ajout_contenu").submit();
		var donnees=new FormData($(this)[0]);
		
		$.ajax({

		url : '../Modele/traitement_contenu.php',
		type : 'POST',
		data : donnees,
		processData: false,
		contentType :  false,
		

		success : function(reponse, status){

				//alert(reponse);
				$('#resultat_recherche').append(reponse);
				$("#formulaire").hide();	
				$('#ajout_contenu')[0].reset();
				$("#contenu").load("../Modele/liste_contenu.php");
		},

		error : function(resultat,statut,error){
					$('#erreur').append(error);
					$('#erreur').append(statut);
					$('#erreur').append(resultat);
				}
	});
	});


	$("#btn_ajout").click(function(e){
		e.preventDefault();
		$("#formulaire").show();
	});

	
	var btn_qcm=document.getElementById('btn_ajout_QCM');
	var boite_dialog=document.getElementById('boite_dialog');


	btn_qcm.addEventListener('click', function onOpen() {
	    if (typeof boite_dialog.showModal === "function")
	    {
	      boite_dialog.showModal();
	    } 
	    else 
	    {
	      alert("L'API dialog n'est pas prise en charge par votre navigateur");
	    }
  });

	$("#annuler").on('click',function(btn){
		btn.preventDefault();
		boite_dialog.close();
	});

	boite_dialog.addEventListener('close',function(e){
		e.preventDefault();

		if(boite_dialog.returnValue=="confirmer")
		{
			var q=$("#question").val();
			var r=$("#reponse").val();
			var p1=$("#proposition1").val();
			var p2=$("#proposition2").val();
			var p3=$("#proposition3").val();

			$.ajax({

				url : '../Modele/sauvegarde_QCM.php',
				type : 'POST',
				dataType : 'html',
				data : "question="+q+"&reponse="+r+"&choix1="+p1+"&choix2="+p2+"&choix3="+p3,

				success : function(reponse, status){

				},

				error : function(resultat,statut,error){
							$('#erreur').append(error);
							$('#erreur').append(statut);
							$('#erreur').append(resultat);
						}
			});
			boite_dialog.returnValue="";
		}

		$("#formulaire_QCM")[0].reset();
	});

	$("#btn_annuler").click(function(){
		$("#formulaire").hide();
		$('#ajout_contenu')[0].reset();

	});


});