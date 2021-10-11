<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Gestion de contenu de cours</title>
	<script type="text/javascript" src="style/jquery-3.5.1.min.js"></script>
	<script type="text/javascript" src="../Controller/gestion_contenu_cours.js"></script>
	

	<link rel="stylesheet" type="text/css" href="style/css/home.css">
	<link rel="stylesheet" type="text/css" href="style/css/footer.css">
	<script type="text/javascript" src="../Controller/header.js"></script>

	<script type="text/javascript" src="style/js/page.js"></script>
	
	<link rel="stylesheet" type="text/css" href="style/css/page.css">
	<link rel="stylesheet" type="text/css" href="style/css/gestion_contenu_cours.css">

</head>
<body>
	<?php
		include 'header.inc.php';
	?>
	<div>
		<?php
			if(isset($_GET['nom_cours'])&&isset($_GET['id_cours']))
			{
				$_SESSION['id_cours']=$_GET['id_cours'];
				echo '<span><a href="forum.php?id_cours='.$_GET['id_cours'].'&nom_cours='.$_GET['nom_cours'].'"><h3>Participer au forum...</h3></a></span>';
			}
		?>
	</div>

	
	<div id="body">
		<?php
			if(isset($_GET['nom_cours']))
			{
				echo '<h2 id="nom_cours">Cours de '.$_GET['nom_cours'].'</h2>';
			}
		?>
		
		<p id="id_c" hidden="hidden"><?php if(isset($_GET['id_cours'])){echo $_GET['id_cours'];} ?></p>

		<p id="id_cours" hidden="hidden"></p>
		<div id="centrale">
				<div class="gauche fils">
					<?php
						
						if(isset($_SESSION['id_utilisateur'])&&isset($_SESSION['compte_utilisateur']))
						{
							if($_SESSION['compte_utilisateur']=="enseignant")
							{
								echo '<button id="btn_ajout">Ajouter contenu</button>';
								echo '<button id="btn_ajout_QCM">Ajouter un QCM</button>';

								echo '<h4>Liste des étudiants inscrits :</h4>';

								include '../Modele/liste_etudiant.php';
							}
						}
					?>
				</div>
				<div id="contenu" class="fils">
					
				</div>
		</div>
		
	</div>
	<dialog id="boite_dialog">
		  <form id="formulaire_QCM" method="dialog">
		    <p><label for="question">Question :</label><input  type="text" id="question" name="question" required="required"></p>
		    <p><label for="reponse">Reponse :</label><input type="text" id="reponse" name="reponse" required="required"></p>
		    <p><label for="proposition1">Choix :</label><input type="text" id="proposition1" name="proposition1" required="required"></p>
		    <p><label for="proposition2">Choix :</label><input type="text" id="proposition2" name="proposition2" required="required"></p>
		    <p><label for="proposition3">Choix :</label><input type="text" id="proposition3" name="proposition3" required="required"></p>
		    <menu>
		      <button id="annuler" value="annuler">Annuler</button>
		      <button id="confirmer" value="confirmer">Confirmer</button>
		    </menu>
		  </form>
		</dialog>


		<div id="erreur">
			
		</div>
	<div id="formulaire"  hidden="hidden">
			<form id="ajout_contenu" class="formulaire" enctype="multipart/form-data" method="post">
				<p><label class="texte" for="titre">Titre : </label><input class="valeur_input" type="text" name="titre" required="required"></p>
				<p><label class="texte" for="fichiers">Selectionner les fichiers : </label>
					<input id='upload' name="fichiers[]" type="file" multiple="multiple" required="required" /> </p>
				<p><label for="description">Les textes de vos chapitres :</label></p>	

				<p><textarea id="description" name="description" rows="10" cols="100"></textarea></p>
    			<button id="valider" name="valider">Valider</button>
    			<button id="btn_annuler">Annuler</button>
			</form>
		</div>
	
	<footer>
	</footer>
</body>
</html>