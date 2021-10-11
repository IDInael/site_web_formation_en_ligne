<?php
//header("Content-type: text/xml");
session_start();

if(isset($_SESSION['id_cours']))
{
	define("FIC_XML", "../database/forum/forum_".$_SESSION['id_cours'].".xml");

	if(file_exists(FIC_XML))
	{
		$fichier=simplexml_load_file(FIC_XML);

		echo '<ul id="coms">';
		foreach ($fichier->forum[0] as $publication) 
		{
			echo '<li><h5 class="nom">'.$publication->auteur.'</h5>';
			echo ' <span class="message">  '.$publication->message.'</span></li>';
		}
		echo '</ul>';
	}
}
?>