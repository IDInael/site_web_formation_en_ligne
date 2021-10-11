<?php
	spl_autoload_register(function ($class_name) {
    	include $class_name . '.php';
    });

	session_start();

    $conn=new Bdd("localhost","formation","root","toor");

    $conn->connect();
    $dbh=$conn->db;

    if(isset($_SESSION['id_utilisateur'])&&isset($_SESSION['compte_utilisateur']))
    {
    	$table=$_SESSION['compte_utilisateur'];
    	$id=$_SESSION['id_utilisateur'];

    		if($table=="etudiant")
    		{

			 $sql="DELETE from Etudiant where id_etudiant='$id' ";
			}	
			else
			{
				$sql="DELETE from Enseignant where id_enseignant='$id' ";
			}

			try 
			{
				$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				// activation du rapport d’erreurs et des exceptions


				$dbh->beginTransaction();
					$dbh->exec($sql);
				$dbh->commit();

				$_SESSION['id_utilisateur']=null;
				$_SESSION['nom_utilisateur']=null;
				$_SESSION['prenom_utilisateur']=null;
				$_SESSION['compte_utilisateur']=null;
				$_SESSION['connecter']="non";

				echo 'ok';
			}catch(Exception $e) 
			{
				$dbh->rollBack();
				echo " F a i l e d : " . $e->getMessage();
			}

		$conn->disconnect();

	}

?>