<?php
	spl_autoload_register(function ($class_name) {
    	include $class_name . '.php';
    });


    $conn=new Bdd("localhost","formation","root","toor");

    $conn->connect();
    $dbh=$conn->db;

    if(isset($_POST['nom'])&&isset($_POST['prenom'])&&isset($_POST['mail'])&&isset($_POST['mdp'])&&isset($_POST['table']))
    {
    	$nom=$_POST['nom'];
    	$prenom=$_POST['prenom'];
    	$mdp=$_POST['mdp'];
    	$mail=$_POST['mail'];

    	$table=$_POST['table'];

    	$verification=$dbh->query("SELECT count(id_utilisateur) total from utilisateur where mail='$mail'");
    	$res=$verification->fetch();
    	$nb=$res['total'];

    	if($nb>0)
    	{
    		echo "existe";
    	}
    	else
    	{
			$res=$dbh->query("SELECT count(nom) as id from $table");
			$test=$res->fetch();
			
			 $nb=$test['id'];
			 $nb++;

			 if($table=="Etudiant")
			 {
			 	$id="etu_".$nb;
			 }
			 else
			 	$id="ens_".$nb;
			

			 $sql="INSERT INTO $table VALUES('$id','$nom','$prenom','$mail','$mdp',0)";
			 			 
			try 
			{
				$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				// activation du rapport d’erreurs et des exceptions


				$dbh->beginTransaction();
					$dbh->exec($sql);
				$dbh->commit();

				echo 'ok';
			}catch(Exception $e) 
			{
				$dbh->rollBack();
				echo " F a i l e d : " . $e->getMessage();
			}
		}

		$conn->disconnect();

	}

?>