<?php
	spl_autoload_register(function ($class_name) {
    	include $class_name . '.php';
    });

    $conn=new Bdd("localhost","formation","root","toor");

    $conn->connect();
    $dbh=$conn->db;

    session_start();

    $format_video=array("mp4","webm","avi","mov","MOV","MPG","mpg");



    if(isset($_SESSION['id_cours']))
    {
        $id=$_SESSION['id_cours'];

        $sql="SELECT titre,id_contenu,description from Contenu where id_cours='$id'";

        $i=0;
        foreach ($dbh->query($sql) as $row) 
        {
            $i++;
            echo '<div class="cours_containt">';
            echo '<h3 class="title">Chapitre '.$i.' : '.$row['titre'].'</h3>';
            echo '<p>'.$row['description'].'</p>';
            echo '<ul class="liste_fichier_containt">';

            $id_contenu=$row['id_contenu'];

            $sql="SELECT nom_fichier,chemin,format from Fichier where id_contenu=:id_contenu";

            $requete=$dbh->prepare($sql);
            $requete->execute(array(":id_contenu"=>$id_contenu));

            $result=$requete->fetchAll();

            foreach ($result as $fichier) 
            {
                $format=$fichier['format'];
                $nom=$fichier['nom_fichier'];
                $chemin=$fichier['chemin'];

                

                if(in_array($format, $format_video))
                {
                    echo '<li class="video">';
                    echo '<video width="400" height="222" controls="controls">';
                    echo '<source src="'.$chemin.'"/>';
                    echo '</video>';
                }
                else
                {
                    if($format=="mp3"||$format=="wav")
                    {
                        echo "<li>";
                        echo '<figure><figcaption>'.$nom.':</figcaption>';
                        echo '<audio controls src="'.$chemin.'"/></figure>';
                    }
                    else
                    {

                        if($format=="jpg"||$format=="JPG"||$format=="png"||$format=="jpeg")
                        {
                            echo "<li>";
                            echo '<img src="'.$chemin.'" style="max-width: 600px; max-height: 100px;" >';
                        }
                        else
                        {
                            echo '<li class="fichier">';
                            echo '<a href="'.$chemin.'"  target="_blank">'.$nom.'</a>';
                        }
                    }
                }

                echo '</li>';

            }

            echo '</ul></div>';
        }
    }

	$conn->disconnect();


?>