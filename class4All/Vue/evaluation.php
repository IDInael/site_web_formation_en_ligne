<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Evaluation de niveau</title>
	<script type="text/javascript" src="style/jquery-3.5.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/css/home.css">
	<link rel="stylesheet" type="text/css" href="style/css/footer.css">
	<link rel="stylesheet" type="text/css" href="style/css/page.css">

	<script type="text/javascript" src="../Controller/header.js"></script>

	<script type="text/javascript" src="../Controller/evaluation.js"></script>
	<script type="text/javascript" src="style/js/page.js"></script>
</head>
<body>
	<?php
		include 'header.inc.php';
	?>

	<div id="body">
		<div id="contenu">
			<form id="evaluation_qcm" method="post">
				<div id="question">
					
				</div>
				<menu>
					<input class="bouton" type="submit" name="" value="Soumettre">
					<button id="recommencer" value="recommencer">Recommencer</button>
				</menu>	
			</form>
		</div>

		<dialog id="boite_dialog">
			<form method="dialog">
				<p id="message"></p>
				<button id="btn_fermer">Fermer</button>
			</form>
		</dialog>
	</div>
	<footer></footer>
</body>
</html>