<?php
	spl_autoload_register(function ($class_name) {
    	include $class_name . '.php';
    });

	session_start();

			$conn=new Bdd("localhost","formation","root","toor");

		    $conn->connect();
		    $dbh=$conn->db;



		    if(isset($_POST['login'])&&isset($_POST['mdp']))
		    {
		    	$login=$_POST['login'];


		    	$verification=$dbh->query("SELECT count(id_utilisateur) total from utilisateur where mail='$login' or id_utilisateur='$login'");
		    	$res=$verification->fetch();
		    	$nb=$res['total'];

		    	if($nb!=1)
		    	{
		    		echo "0"; //l'utilisateur n'est pas dans la base
		    	}
		    	else
		    	{
					$res=$dbh->query("SELECT id_utilisateur, nom, prenom, password,mail from utilisateur where mail='$login' or id_utilisateur='$login'");
					$test=$res->fetch();
					
					 $mdp=$test['password'];

					 if($mdp!=$_POST['mdp'])
					 {
					 	echo "1"; //mot de passe incorrect
					 }
					 else
					 {
					 	
					 	$_SESSION['id_utilisateur']=$test['id_utilisateur'];
					 	$_SESSION['nom_utilisateur']=$test['nom'];
					 	$_SESSION['prenom_utilisateur']=$test['prenom'];
					 	$_SESSION['mail_utilisateur']=$test['mail'];
					 	$_SESSION['connecter']="oui";

					 	$compte=substr($_SESSION['id_utilisateur'], 0,3);

					 	if($compte=="etu")
					 		$_SESSION['compte_utilisateur']="etudiant";
					 	else
					 		$_SESSION['compte_utilisateur']='enseignant';

					 	echo $compte;

					 }
				}

				

			}
			else
			{
				/*if(isset($_SESSION['connecter']))
			    {
			    	if($_SESSION['connecter']=="oui"&&isset($_SESSION['id_utilisateur']))
			    	{
			    		$compte=substr($_SESSION['id_utilisateur'], 0,3);
			    		echo $compte;
			    	}
			    }
			    else
			    {
					echo 'erreur';
				}*/
				echo 'erreur';
			}
			$conn->disconnect();
    

?>