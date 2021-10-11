<?php

		spl_autoload_register(function ($class_name) {
    	include $class_name . '.php';
    });

	session_start();

	$conn=new Bdd("localhost","formation","root","toor");

    $conn->connect();
    $dbh=$conn->db;

	if(isset($_GET['id'])&&$_SESSION['id_utilisateur'])
	{
		$id_cours=$_GET['id'];
		$id_utilisateur=$_SESSION['id_utilisateur'];

		//verifie que l'etudiant n'est pas deja inscrit

		$verification=$dbh->query("SELECT count(id_cours) total from Etudiant_cours where id_cours='$id_cours' and id_etudiant='$id_utilisateur'");
    	$res=$verification->fetch();
    	$nb=$res['total'];

    	if($nb==0)
    	{
    		$sql="INSERT into Etudiant_cours VALUES('$id_utilisateur','$id_cours')";

    		executer($dbh,$sql);

    		echo "inscription au cours ".$id_cours." effectuee avec succes";
    	}

    	$conn->disconnect();
	}

	function executer($dbh,$sql)
{
	try 
	{
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		// activation du rapport d’erreurs et des exceptions


		$dbh->beginTransaction();
			$dbh->exec($sql);
		$dbh->commit();

	}catch(Exception $e) 
	{
		$dbh->rollBack();
		echo " F a i l e d : " . $e->getMessage();
	}
}
?>