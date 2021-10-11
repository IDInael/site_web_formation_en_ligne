<?php
	session_start();

	if(isset($_SESSION['connecter'])&&$_SESSION['compte_utilisateur'])
	{
		if($_SESSION['connecter']=="oui")
		{
			if($_SESSION['compte_utilisateur']=="etudiant")
			{
				echo "1";
			}
			else
			{
				echo "2";
			}
		}
		else
		{
			echo "0";
		}
	}
	else
	{
		echo "0";
	}
?>