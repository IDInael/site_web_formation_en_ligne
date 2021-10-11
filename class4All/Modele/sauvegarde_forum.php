<?php


session_start();


if(isset($_SESSION['id_cours'])&&isset($_SESSION['nom_utilisateur'])&&isset($_SESSION['prenom_utilisateur'])&&isset($_POST['message']))
{
	define("FIC_XML", "../database/forum/forum_".$_SESSION['id_cours'].".xml");

	if(file_exists(FIC_XML))
	{
		$fichier = simplexml_load_file(FIC_XML);
		
	}
	else
	{
		$fichier=new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><forums><forum></forum></forums>');
	}

	$publication = $fichier->forum[0]->addChild("publication");
	$publication->addChild("auteur",$_SESSION['nom_utilisateur'].' '.$_SESSION['prenom_utilisateur']);
	$publication->addChild("message",$_POST['message']);


		//print_r($fichier);
	$fichier->asXML(FIC_XML);
}

?>