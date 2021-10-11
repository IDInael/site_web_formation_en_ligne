//localStorage.setItem('theme','0');

$(document).ready(function(){
	$('#btn_option').click(function(btn){
		btn.preventDefault();
		$("#option").show(500);
	});

	$("#option").hover(function(){
		$(this).show();
	}, function(){
		$(this).hide(500);
	});

	var theme=localStorage.getItem('theme');
	


		if(theme=='1')
		{
			$("#body").css("background-color","rgb(11,22,22,0.8)");
			$(".cours_r").css("background-color","gray");
			$(".mes_cours").css("background-color","gray");
			$("#body").css("color","rgb(254,254,254)");
			$(".cours_r").css("color","rgb(254,254,254)");
			$(".mes_cours").css("color","rgb(254,254,254)");
			//alert(theme);
		}
		else
		{
			$("#body").css("background-color","rgb(238,254,254,0.6)");
			$(".cours_r").css("background-color","rgb(238,254,254,0.6)");
			$(".mes_cours").css("background-color","rgb(238,254,254,0.6)");
			$("#body").css("color","rgb(0,0,0)");
			$(".cours_r").css("color","rgb(0,0,0)");
			$(".mes_cours").css("color","rgb(0,0,0)");
		}
		//	$("#claire").trigger('click');
	
	var btn_option=document.getElementById("option");

/*
	btn_option.addEventListener("mouseover", function(){

		setTimeout(function(){
			$("#option").hide(500);
		},1000);
		
	});*/

	$('#deconnexion').click(function(){
		$.ajax({

		url : '../../Modele/gestion_connexion.php',
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

	$("#btn_voir_profil").click(function(btn){
		btn.preventDefault();
		$("#modification").show();
	});

	$("#btn_fermer_profil").click(function(btn){
		btn.preventDefault();
		$("#modification").hide();
	});

	$("#btn_modification").click(function(btn){
		btn.preventDefault();
		$(".valeur_input2").prop("disabled",false);
		$(".valeur_input2").css("background-color","rgb(254,254,254)");
		$(this).hide();
		$("#btn_sauvegarder").show();
		$(".hidden").show();
	});



	$("#modification").hide();
	$(".hidden").hide();
	$(".valeur_input2").prop("disabled",true);

	$("#formulaire_modification").submit(function(e){
		e.preventDefault();

		var donnees=$(this).serialize();
		var mdp1=$('#mdp').val();
		var mdp2=$('#mdp2').val();

		if(mdp1==mdp2)
		{
			$.ajax({
			url : '../Modele/sauvegarde_modification.php',
				type : 'POST',
				data : donnees,

				dataType : 'html',
				success : function(reponse,statut){
					if(reponse=='existe')
						$('#erreur_msg').text("cette adresse mail est deja utilisé par un compte !");
					else if(reponse=='ok')
						{
							location.reload(true);
						}
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

	$("#sombre").click(function(btn){
		btn.preventDefault();
		localStorage.setItem('theme','1');
		$("#body").css("background-color","rgb(11,22,22,0.8)");
		$(".cours_r").css("background-color","rgb(0,0,0)");
		$(".mes_cours").css("background-color","rgb(0,0,0)");
		$("#body").css("color","rgb(254,254,254)");
		$(".cours_r").css("color","rgb(254,254,254)");
		$(".mes_cours").css("color","rgb(254,254,254)");
	});

	$("#claire").click(function(btn){
		btn.preventDefault();
		localStorage.setItem('theme','0');
		$("#body").css("background-color","rgb(238,254,254,0.6)");
		$(".cours_r").css("background-color","rgb(238,254,254,0.6)");
		$(".mes_cours").css("background-color","rgb(238,254,254,0.6)");
		$("#body").css("color","rgb(0,0,0)");
		$(".cours_r").css("color","rgb(0,0,0)");
		$(".mes_cours").css("color","rgb(0,0,0)");
	});

	$("#btn_suppression_compte").click(function(btn){
		btn.preventDefault();
		var res=confirm("Etes-vous sur de vouloir supprimer votre compte ?");

		if(res==true)
		{

			$.ajax({
			url : '../Modele/suppression.php',
				type : 'GET',

				dataType : 'html',
				success : function(reponse,statut){
					if(reponse=='ok')
						window.location.replace("../Vue/index.html");
					else
					{
						alert("erreur de traitement");
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
	});
});