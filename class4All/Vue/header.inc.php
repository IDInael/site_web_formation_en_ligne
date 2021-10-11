<header>
		<div id="logo_holder">
			<?php
				include 'logo.html';
			?>
		</div>

		<div id="navigation">
				<div id="utilisateur">
					
					<?php
						session_start();

						if(isset($_SESSION['id_utilisateur'])&&isset($_SESSION['compte_utilisateur']))
						{
							if($_SESSION['compte_utilisateur']=="etudiant")
								echo "ACCUEIL ETUDIANT : ";
							else
							{
								echo "ACCUEIL ENSEIGNANT : ";
							}
							echo $_SESSION['nom_utilisateur'].' '.$_SESSION['prenom_utilisateur'];
						}
						else
						{
							header('location: index.html');
						}
					?>
				</div>
				<div class="search">
					<form id="formulaire_recherche">
						<input class="searchTerm" id="recherche_input" type="text" name="rechercher" required="required">
						<button class="searchButton" id="btn_rechercher"><i class="fa fa-search"></i></button>
						<button class="searchButton" id="btn_option"><i class="fa fa-search"></i></button>
					</form>
				</div>
				
		</div>
	</header>
	<div class="resultat_recherche" hidden="hidden">
		<form>
			<button id="fermer_diag"></button>
		</form>
				
				<div id="resultat_recherche">
					
				</div>
		</div>
	<div id="option" hidden="hidden">
			
			    <div class="wrapper">
			        <ul class="mainMenu">

			        	<?php

			        	if(isset($_SESSION['compte_utilisateur']))
			        	{
			        		if($_SESSION['compte_utilisateur']=="etudiant")
			        		{

					           	 echo '<li class="item" id="account">
					                <a href="#account" class="btn"><i class="fas fa-user-circle"></i>Cours</a>
					                <div class="subMenu">
					                    <a href="accueil_etu.php#cours_suivi">Mes cours</a>
					                    <a href="accueil_etu.php#cours_recommande">Cours recommandés</a>
					                </div>
					            </li>
					            <li class="item" id="about">
					                <a href="#about" class="btn"><i class="fas fa-address-card"></i>Evaluation</a>
					                <div class="subMenu">
					                    <a href="evaluation.php">Faire un test QCM</a>
					                </div>
					            </li>
					            <li class="item" id="nav">
					                <a href="#nav" class="btn"><i class="fas fa-address-card"></i>Navigation</a>
					                <div class="subMenu">
					                	<a href="index.html">Accueil class4All</a>
					                    <a href="accueil_etu.php">Accueil mon cours</a>
					                </div>
					            </li>';
					        }
					        else
					        {
					        	echo '<li class="item" id="account">
						                <a href="#account" class="btn"><i class="fas fa-user-circle"></i>Cours</a>
						                <div class="subMenu">
						                    <a href="accueil_ens.php#cours_suivi">Mes cours</a>
						                </div>
						            </li>
						            <li class="item" id="about">
						                <a href="#about" class="btn"><i class="fas fa-address-card"></i>Gestion cours</a>
						                <div class="subMenu">
						                    <a href="" id="lien_ajout">Ajouter un cours</a>
						                </div>
						            </li>
						            <li class="item" id="nav">
					                <a href="#nav" class="btn"><i class="fas fa-address-card"></i>Navigation</a>
					                <div class="subMenu">
					                	<a href="index.html">Accueil class4All</a>
					                    <a href="accueil_ens.php">Accueil mon cours</a>
					                </div>
					            </li>';
					        }
			            }
			            ?>
			            <li class="item" id="support">
			                <a href="#support" class="btn"><i class="fas fa-info"></i>Thème</a>
			                <div class="subMenu">
			                    <a id="sombre" href="">Sombre</a>
			                    <a id="claire" href="">Claire</a>
			                </div>
			            </li>
			            <li class="item" id="profil">
			                <a href="#profil" class="btn"><i class="fas fa-info"></i>Gestion compte</a>
			                <div class="subMenu">
			                    <a id="btn_voir_profil" href="">Voir mon profil</a>
			                    <a id="btn_suppression_compte" href="">Supprimer mon compte</a>
			                </div>
			            </li>
			            <li class="item">
			                <a id="deconnexion" href="#" class="btn"><i class="fas fa-sign-out-alt"></i>Se deconnecter</a>
			            </li>
			        </ul>
			    </div>
		</div>

		<div id="modification" >
			<?php
				include '../Modele/modification.php';
			?>
			
		</div>