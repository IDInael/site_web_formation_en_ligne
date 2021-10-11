<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>paage d'accueil</title>

	<script type="text/javascript" src="style/jquery-3.5.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/css/home.css">
	<link rel="stylesheet" type="text/css" href="style/css/footer.css">
	<script type="text/javascript" src="../Controller/header.js"></script>

	
	<script type="text/javascript" src="../Controller/accueil_perso.js"></script>
	<script type="text/javascript" src="../Controller/gestion_cours.js"></script>
	<script type="text/javascript" src="style/js/page.js"></script>
	<link rel="stylesheet" type="text/css" href="style/css/page.css">
	<link rel="stylesheet" type="text/css" href="style/css/ajouter_cours.css">
</head>
<body>
	
	<?php
		include 'header.inc.php';
	?>

	<div id="body">
		
		<div id="centrale">

		</div>
		
	</div>

	<div id="ajouter_cours">
		<form id="formulaire_ajout_cours" class="formulaire" method="post">
			<p><label class="texte" for="nom_cours">Nom du cours : </label><input required="required" class="valeur_input" type="text" name="nom_cours" minlength="3"></p>
			<p><label class="texte" for="niveau">Niveau : </label><input required="required" class="valeur_input" type="number" name="niveau" min="0" max="10"></p>
			<p><label class="texte" for="mot_cle">Mots clé (X,X,X)</label><input required="required" class="valeur_input" type="type" name="mot_cle"></p>
			<p><label class="texte" for="description">Description du cours </label></p>
			<textarea class="valeur_input" name="description" required="required">
			</textarea>
			<button id="ajouter">Ajouter</button>
			<button id="fermer">Annuler</button>
		</form>
	</div>
	<div id="erreur">
	</div>
	<footer>
		
	</footer>
</body>
</html>