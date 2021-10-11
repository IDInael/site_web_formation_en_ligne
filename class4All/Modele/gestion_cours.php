<?php
	spl_autoload_register(function ($class_name) {
    	include $class_name . '.php';
    });

	session_start();

			$conn=new Bdd("localhost","formation","root","toor");

		    $conn->connect();
		    $dbh=$conn->db;



		    if(isset($_POST['nom_cours'])&&isset($_POST['niveau'])&&isset($_POST['description'])&&isset($_SESSION['id_utilisateur']))
		    {
		    	$nom=$_POST['nom_cours'];
		    	$niveau=$_POST['niveau'];
		    	$admin=$_SESSION['id_utilisateur'];
		    	$description=$_POST['description'];



		    	$verification=$dbh->query("SELECT count(id_cours) total from Cours where nom_cours='$nom' and admin='$admin'");
		    	$res=$verification->fetch();
		    	$nb=$res['total'];

		    	if($nb!=0)
		    	{
		    		echo "existe"; //le cours existe deja
		    	}
		    	else
		    	{
					$res=$dbh->query("SELECT count(niveau) as id from Cours");
					$test=$res->fetch();
					
					 $nb=$test['id'];
					 $nb++;

					 $id=substr($nom, 0,3).'_'.$nb;
					

					 $sql="INSERT INTO Cours VALUES('$id','$nom','$niveau','$admin','$description')";
					 executer($dbh,$sql);	

					 if(isset($_POST['mot_cle']))
					 {
					 	$str=str_replace(" ", "", $_POST['mot_cle']);
					 	$mot_cle=preg_split("/(,|;|-|:)/",$str);

					 	foreach ($mot_cle as $c) 
					 	{
					 		$sql="INSERT INTO Mots_cle VALUES('$c','$id')";
					 		executer($dbh,$sql);
					 	}
					 }
					 echo "ok";
				}
			}
			else
			{
				echo 'erreur';
			}
			$conn->disconnect();
    
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