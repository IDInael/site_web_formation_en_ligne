<?php
	spl_autoload_register(function ($class_name) {
    	include $class_name . '.php';
    });

    $conn=new Bdd("localhost","formation","root","toor");

    $conn->connect();
    $dbh=$conn->db;

    session_start();

    //condition
    if(isset($_GET['recherche'])&&isset($_SESSION['compte_utilisateur']))
    {
	    $tab_rech=explode("%",$_GET['recherche']);

	    $sql="SELECT distinct c.id_cours,nom_cours, description, niveau from Mots_cle m, Cours c where (mots LIKE :recherche OR nom_cours LIKE :recherche or description LIKE :recherche) AND c.id_cours=m.id_cours";

	    $requete=$dbh->prepare($sql);

	    foreach ($tab_rech as $recherche) 
	    {
		    $requete->execute(array(":recherche"=>'%'.$recherche.'%'));
		    $tab=$requete->fetchAll();

		    if(count($tab)<=0)
		    {
		    	echo '<p>Aucun resultat trouvé pour : '.$recherche.'</p>';
		    }
		    else
		    {
		    	echo '<p>Resultat de recherche associé au mot clé : '.$recherche.'</p>';
		    	echo '<ul id="recherche">';
			    foreach ( $tab as $resultat) 
			    {
			    	echo '<li class="recherche" style="list-style-type:none;">';

			    	if($_SESSION['compte_utilisateur']=="etudiant")
			    	{
			    		echo '<a href="../Vue/gestion_contenu_cours.php?id_cours='.$resultat['id_cours'].'&nom_cours='.$resultat['nom_cours'].'">';
			    	}		    	
			    	echo '<h4>'.$resultat['nom_cours'].'" : niveau '.$resultat['niveau'].'</h4>';

			    	if($_SESSION['compte_utilisateur']=="etudiant")
			    	{
			    		echo '</a>';
			    	}
			    	echo '<p>'.$resultat['description']."<p/></li>";
			    }	
			    echo "</ul>";
			}	
		}
	}
	else
	{
		echo "erreur de traitement ";
	}
?>