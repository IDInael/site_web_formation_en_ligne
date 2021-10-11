<?php
	spl_autoload_register(function ($class_name) {
    	include $class_name . '.php';
    });

    $conn=new Bdd("localhost","formation","root","toor");

    $conn->connect();
    $dbh=$conn->db;

    session_start();

    if(isset($_SESSION['id_utilisateur'])&&isset($_SESSION['compte_utilisateur']))
    {
    	//echo $_SESSION['id_utilisateur']." ".$_SESSION['compte_utilisateur'];

        $condition=$_SESSION['id_utilisateur'];

    	if($_SESSION['compte_utilisateur']=='etudiant')
    	{
    		
    		$sql=("SELECT c.id_cours,nom_cours, description from Cours c,Etudiant_cours ec where c.id_cours=ec.id_cours and ec.id_etudiant='$condition'");

    		echo '<div id="cours_suivi"><h2>Cours Suivi</h2>';
    		foreach ($dbh->query($sql) as $row) 
    		{
    			echo '<div class="mes_cours"><a href="gestion_contenu_cours.php?id_cours='.$row['id_cours'].'&nom_cours='.$row['nom_cours'].'"> <h3>'.$row['nom_cours'].'</h3></a>';
                echo '<p>'.$row['description'].'</p></div>';
    		}
    		echo '</di>';


    		$sql=("SELECT id_cours,nom_cours, description from Cours where niveau<=(select niveau from Etudiant where id_etudiant='$condition') and id_cours not in(select id_cours from Etudiant_cours where id_etudiant='$condition')");

    		echo '<div id="cours_recommande"><h2>Cours recommande</h2>';
    		foreach ($dbh->query($sql) as $row) 
    		{
    			echo '<div class="cours_r"><h3>'.$row['nom_cours'].'</h3>';
                echo '<p>'.$row['description'].'</p>';
                echo '<button class="inscription_cours" onclick="inscription_cours(\''.$row['id_cours'].'\')">'.' '." S'inscrire</button>";

                echo '</div>';
    		}
    		echo '</di>';
    	}
        else
        {
            $sql=("SELECT id_cours,nom_cours,description from Cours where admin='$condition'");

            echo '<div id="cours_suivi"><h2>Mes cours </h2>';
            foreach ($dbh->query($sql) as $row) 
            {
                echo '<div class="mes_cours"><a href="gestion_contenu_cours.php?id_cours='.$row['id_cours'].'&nom_cours='.$row['nom_cours'].'"> <h3>'.$row['nom_cours'].'</h3></a>';
                echo '<p>'.$row['description'].'</p></div>';
            }
            echo '</di>';
        }
			
	}
	else
	{
		echo $_SESSION['id_utilisateur']." ".$_SESSION['compte_utilisateur'];
		echo 'erreur';
	}

	$conn->disconnect();


?>