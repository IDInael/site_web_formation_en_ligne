<?php
spl_autoload_register(function ($class_name) {
    	include $class_name . '.php';
    });


    $conn=new Bdd("localhost","formation","root","toor");

    $conn->connect();
    $dbh=$conn->db;

    if(isset($_SESSION['id_utilisateur'])&&isset($_SESSION['compte_utilisateur']))
    {
    	$id=$_SESSION['id_utilisateur'];
    	$table=$_SESSION['compte_utilisateur'];

    	$sql="SELECT u.nom, u.prenom, u.mail,u.password, niveau from utilisateur u join $table where id_utilisateur='$id'";

    	$requete=$dbh->query($sql);
    	$result=$requete->fetch();
    }
    $conn->disconnect();
?>

<form id="formulaire_modification" class="formulaire" method="post">

	<?php

	echo '
	<p><label for="nom">Nom : </label><input class="valeur_input valeur_input2" type="text" name="nom" required="required" value="'.$result['nom'].'"></p>
	<p><label for="prenom">Prenom : </label><input class="valeur_input valeur_input2" type="text" name="prenom" value="'.$result['prenom'].'"></p>
	<p><label for="mail">Email : </label><input class="valeur_input valeur_input2" type="email" name="mail" required="required" value="'.$result['mail'].'"></p>';
	if($_SESSION['compte_utilisateur']=="etudiant")
		echo '<p>Niveau : '.$result['niveau'].'</p>';


	echo '<p class="hidden"><label for="mdp">Mots de passe : </label><input class="valeur_input valeur_input2" type="password" id="mdp" name="mdp" required="required" minlength="8" value="'.$result['password'].'"></p>
	<p class="hidden"><label for="mdp2">Confirmation mots de passe : </label><input class="valeur_input valeur_input2" id="mdp2" type="password" name="mdp2" required="required" value="'.$result['password'].'"></p>';

	?>
	<p>
		<button class="bouton" id="btn_fermer_profil">Fermer</button>
		<input id="btn_sauvegarder" class="bouton" type="submit" value="sauvegarder" hidden="hidden"> 
		<button class="bouton" id="btn_modification">Modifier</button>
		
	</p>
	

</form>
<div id="erreur_msg">	
	</div>