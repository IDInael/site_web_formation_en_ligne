<?php
    spl_autoload_register(function ($class_name) {
        include $class_name . '.php';
    });

session_start();
$conn=new Bdd("localhost","formation","root","toor");

$conn->connect();
$dbh=$conn->db;

   /* if(isset($_POST['commande']))
    {
         if(isset($_POST['id_cours']))
        {
            $id=$_POST['id_cours'];
            $sql=("SELECT nom_cours from Cours where id_cours='$id'");

            $verification=$dbh->query($sql);
            $res=$verification->fetch();
            $nb=$res['nom_cours'];

            $_SESSION['id_cours']=$id;

            echo $nb;
        }
    }
    else
    {*/
        ajoutcontenu($dbh);
   // }


$conn->disconnect();



function ajoutcontenu($dbh)
{
    $type=array("zip","rar","doc","ppt","docx","pptx","webm","mp4","mp3","wav","avi","mov","MOV","MPG","mpg","pdf","xls","odt","ods","txt","png","jpeg","jpg","JPG");

    if(isset($_FILES['fichiers'])&&$_POST['titre']&&isset($_SESSION['id_cours']))
    {

        $id=$_SESSION['id_cours'];
        $titre=$_POST['titre'];
        $description="";

        
        if(isset($_POST['description']))
            $description=$_POST['description'];
       // insertion du contnenu de cours

       // echo $id." ".$titre." ".$description."************************************";

         $sql=("SELECT count(id_contenu) nb from Contenu where id_cours=:id and titre=:titre");
         $verification=$dbh->prepare($sql);
         $verification->execute(array(":id"=>$id,":titre"=>$titre));
         $res=$verification->fetch();

        if($res['nb']==0)
        {
            $sql="INSERT into Contenu(titre,id_cours,description) VALUES('$titre','$id','$description')";
            insertionbdd($dbh,$sql);
        }
        else
        {
            $sql="UPDATE Contenu set description='$description' where titre='$titre' and id_cours='$id'";
            insertionbdd($dbh,$sql);
        }

         $sql=("SELECT id_contenu from Contenu where id_cours='$id' and titre='$titre'");

        $verification=$dbh->query($sql);
        $res=$verification->fetch();

        $id_contenu=$res['id_contenu'];


        if(count($_FILES['fichiers']['name']) > 0 ){

            for($i=0; $i<count($_FILES['fichiers']['name']); $i++) 
            {
                $tmpFilePath = $_FILES['fichiers']['tmp_name'][$i];

                if($tmpFilePath !="")
                {
                
                    $shortname = $_FILES['fichiers']['name'][$i];

                    $chemin = "../database/Fichiers/" .$_FILES['fichiers']['name'][$i];
                    $type_fichier = strtolower(pathinfo($shortname,PATHINFO_EXTENSION));


                    if(in_array($type_fichier, $type))
                    {
                        if(move_uploaded_file($tmpFilePath, $chemin)) 
                        {

                            //$files[] = $shortname;

                            $sql="INSERT INTO Fichier(nom_fichier,chemin,format,id_contenu) VALUES('$shortname','$chemin','$type_fichier','$id_contenu')";
                            insertionbdd($dbh,$sql);
        /*
                            
                            //insert into db 
                            //use $shortname for the filename
                            //use $chemin for the relative url to the file

                            */

                        }
                  }
                  else
                  {
                    echo $shortname." : fichier non pris en charge \n";
                  }
                }
                else
                {
                    echo $tmpFilePath." : not found \n";
                }

            }//fin boucle for
        }
    }
    else
    {
        print_r($_FILES);
        //echo 'rien \n'.$_FILES['fichiers'].' '.$_POST['titre'].' '.$_SESSION['id_cours'];
    }
}



function insertionbdd($dbh,$sql)
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