<?php
spl_autoload_register(function ($class_name) {
    	include $class_name . '.php';
    });

session_start();

if(isset($_SESSION['id_cours'])&&isset($_POST['question'])&&isset($_POST['reponse'])&&isset($_POST['choix1'])&&isset($_POST['choix2'])&&isset($_POST['choix3']))
{
	$id_cours=$_SESSION['id_cours'];

	$conn=new Bdd("localhost","formation","root","toor");
    $conn->connect();
    $dbh=$conn->db;

    $requete=$dbh->query("SELECT niveau from Cours where id_cours='$id_cours'");
    $reponse=$requete->fetch();

    $niveau=$reponse['niveau'];
    $conn->disconnect();


	define("FIC_XML", '../database/QCM/niveau_'.$niveau.".xml");


	if(file_exists(FIC_XML))
	{
		$fichier = simplexml_load_file(FIC_XML);
		
	}
	else
	{
		$fichier=new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><evaluation></evaluation>');
	}

	$qcm = $fichier[0]->addChild("qcm");
	$qcm->addChild("question",$_POST['question']);
	$qcm->addChild("reponse",$_POST['reponse']);
	$qcm->addChild("proposition1",$_POST['choix1']);
	$qcm->addChild("proposition2",$_POST['choix2']);
	$qcm->addChild("proposition3",$_POST['choix3']);
	
		print_r($fichier);
	$fichier->asXML(FIC_XML);



}
?>