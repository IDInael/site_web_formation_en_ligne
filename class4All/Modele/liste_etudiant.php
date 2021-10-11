<?php
	spl_autoload_register(function ($class_name) {
    	include $class_name . '.php';
    });

	$conn=new Bdd("localhost","formation","root","toor");

    $conn->connect();
    $dbh=$conn->db;

    if(isset($_SESSION['id_cours']))
    {
    	$id=$_SESSION['id_cours'];

    	$sql="SELECT distinct nom, prenom, niveau from etudiant join etudiant_cours where id_cours=:id_cours ";

    	$requete=$dbh->prepare($sql);
    	$requete->execute(array(":id_cours"=>$id));

    	$result=$requete->fetchAll();

    	echo "<ol>";
    	foreach ($result as $row) 
    	{
    		echo '<li class="liste_etu">'.$row['nom']." ".$row['prenom']." : niv ".$row['niveau']."</li>";
    	}
    	echo "</ol>";
    }
?>