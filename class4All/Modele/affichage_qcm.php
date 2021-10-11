<?php
spl_autoload_register(function ($class_name) {
    	include $class_name . '.php';
    });
session_start();

	$niveau=0;

	if(isset($_SESSION['id_utilisateur'])&&isset($_SESSION['compte_utilisateur']))
	{
		if($_SESSION['compte_utilisateur']=="etudiant")
		{
			$conn=new Bdd("localhost","formation","root","toor");
		    $conn->connect();
		    $dbh=$conn->db;

		    $condition=$_SESSION['id_utilisateur'];

		    $requete=$dbh->query("SELECT niveau from Etudiant where id_etudiant='$condition'");
		    $reponse=$requete->fetch();

		    $niveau=$reponse['niveau'];
		    $conn->disconnect();
		}
		
	}

	define("FIC_XML", "../database/QCM/niveau_".$niveau.".xml");

	
	

	if(file_exists(FIC_XML))
	{
		$tableau=array();

		$fichier=simplexml_load_file(FIC_XML);

		//extraction des qcm
		foreach ($fichier[0] as $eval) 
		{
			$tmp=new QCM((string)$eval->question,(string)$eval->reponse,(string)$eval->proposition1,(string)$eval->proposition2,(string)$eval->proposition3);
			$tableau[]=$tmp;
		}

		//desordonner l'ordre des qcm


		//affichage des qcm desordonnée

		$i=0;
		foreach ($tableau as $qcm) 
		{
			
			echo '<h5>'.(string)$qcm->question.'</h5>';

				foreach ($qcm->desordonner() as $c) 
				{
					echo '<p><input type="radio" name="reponse_'.$i.'" value="'.(string)$c.'">';
					echo '<label for="reponse_'.$i.'">'.(string)$c.'</label></p>';
				}
				$i++;
		}

		$_SESSION['tab']=$tableau;
	}
	else
	{
		echo "Il n'existe pas encore de QCM disponible pour ce niveau : ".$niveau;
	}

	

?>