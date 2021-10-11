<?php
spl_autoload_register(function ($class_name) {
    	include $class_name . '.php';
    });
session_start();

	if(isset($_SESSION['tab']))
	{
		$pts=0;
		$total=count($_SESSION['tab']);

		for($i=0;$i<$total;$i++)
		{
			if(isset($_POST['reponse_'.$i]))//si la question i a été repondu
			{
				$pts+=$_SESSION['tab'][$i]->getResultat($_POST['reponse_'.$i]);
			}
		}

		$niveau=0;
		if($pts>($total/2))
		{

			$conn=new Bdd("localhost","formation","root","toor");

		    $conn->connect();
		    $dbh=$conn->db;
		    

		    if(isset($_SESSION['id_utilisateur']))
		    {
		    	$id=$_SESSION['id_utilisateur'];

		    	$sql="SELECT niveau from etudiant where id_etudiant='$id'";

		    	$requete=$dbh->query($sql);

		    	$result=$requete->fetch();

		    	$niveau=$result['niveau']+1;

		    	$sql="UPDATE Etudiant set niveau=$niveau where id_etudiant='$id'";

		    	executer($dbh,$sql);
		    }
		    

			echo "Votre score : ".$pts.'/'.$total.'. Felicitation, vous passer au niveau '.$niveau;

		}
		else
		{
			echo "Votre score : ".$pts.'/'.$total.'. Retentez votre chance pour passer au niveau '.($niveau+1);
		}
		
	}
	else
	{
		echo "erreur de traitement";
		echo $_SESSION['tab'][0];
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