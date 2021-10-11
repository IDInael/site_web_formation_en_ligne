<?php
	//header("Content-Type: application/json");

	session_start();


	if(isset($_SESSION['id_utilisateur'])&&isset($_SESSION['nom_utilisateur'])&&isset($_SESSION['prenom_utilisateur'])&&isset($_SESSION['compte_utilisateur']))
	{
		
		if($_GET['commande']=='connexion')
		{
			echo "PAGE D'ACCUEIL :  ".$_SESSION['nom_utilisateur'].' '.$_SESSION['prenom_utilisateur'];
		}
		else 
		{
				$_SESSION['id_utilisateur']=null;
				$_SESSION['nom_utilisateur']=null;
				$_SESSION['prenom_utilisateur']=null;
				$_SESSION['compte_utilisateur']=null;
				$_SESSION['connecter']="non";
				echo 'deconnexion';
		}			
	}
	else
	{
		echo "ko";
	}

?>