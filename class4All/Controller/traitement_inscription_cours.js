function inscription_cours(id_cours)
{
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
	  if (this.readyState == 4 && this.status == 200) 
	  {
	    //$('#centrale').load("../Modele/accueil_perso.php");
	    //alert(this.responseText);
	    location.reload();
	  }
	};
	xmlhttp.open("GET", "../Modele/inscription_cours.php?id="+id_cours, true);
	xmlhttp.send();
}