$(document).ready(function(){
	$('#logo_holder').load('../Vue/logo.html');
	$('footer').load('../Vue/footer.html');

		$("#logo_holder").click(function(){
		window.location.replace("../Vue/index.html");
	});

	$("#btn_rechercher").click(function(btn)
	{
		btn.preventDefault();
		var recherche=$("#recherche_input").val();

		recherche=recherche.replaceAll(" ","%");
		$("#fermer").trigger('click');
		//alert(recherche);
		if(recherche=="")
		{
			$("#recherche_input").focus();
		}
		else
		{
			$("#resultat_recherche").load("../Modele/recherche.php?recherche="+recherche);
			$('.resultat_recherche').show();
		}
	});

	$("#fermer_diag").click(function(){
		$("#formulaire_recherche")[0].reset();
		//$("#recherche_input").val("");
		$(".resultat_recherche").hide();
		$("#resultat_recherche").text("");
	})
});