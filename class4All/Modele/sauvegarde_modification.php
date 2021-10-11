<?php
	spl_autoload_register(function ($class_name) {
    	include $class_name . '.php';
    });

	session_start();

    $conn=new Bdd("localhost","formation","root","toor");

    $conn->connect();
    $dbh=$conn->db;

    if(isset($_POST['nom'])&&isset($_POST['prenom'])&&isset($_POST['mail'])&&isset($_POST['mdp'])&&isset($_SESSION['id_utilisateur'])&&isset($_SESSION['compte_utilisateur']))
    {
    	$nom=$_POST['nom'];
    	$prenom=$_POST['prenom'];
    	$mdp=$_POST['mdp'];
    	$mail=$_POST['mail'];

    	$table=$_SESSION['compte_utilisateur'];
    	$id=$_SESSION['id_utilisateur'];

    	$verification=$dbh->query("SELECT count(id_utilisateur) total from utilisateur where mail='$mail' and id_utilisateur!='$id'");
    	$res=$verification->fetch();
    	$nb=$res['total'];

    	if($nb>0)
    	{
    		echo "existe";
    	}
    	else
    	{

    		if($table="etudiant")
    		{

			 $sql="UPDATE Etudiant set nom='$nom', prenom='$prenom', mail='$mail', password='$mdp' where id_etudiant='$id' ";
			}	
			else
			{
				$sql="UPDATE Enseignant set nom='$nom', prenom='$prenom', mail='$mail', password='$mdp' where id_enseignant='$id' ";
			}

			try 
			{
				$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				// activation du rapport d’erreurs et des exceptions


				$dbh->beginTransaction();
					$dbh->exec($sql);
				$dbh->commit();

				$_SESSION['nom_utilisateur']=$nom;
				$_SESSION['prenom_utilisateur']=$prenom;

				echo 'ok';
			}catch(Exception $e) 
			{
				$dbh->rollBack();
				echo " F a i l e d : " . $e->getMessage();
			}
		}

		$conn->disconnect();

	}
	else
	{
		echo $_POST['nom'].' '.$_POST['prenom'].' '.$_POST['mail'].' '.$_POST['mdp'].' '.$_SESSION['id_utilisateur'].' '.$_SESSION['compte_utilisateur'];
	}

?>