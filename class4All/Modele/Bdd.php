<?php
	class Bdd
	{
		public $db=null;
		public $dbname=null;
		public $host=null;
		public $user=null;
		public $pswd=null;

		function __construct($h,$dbn,$u,$p)
		{
			$this->dbname=$dbn;
			$this->host=$h;
			$this->user=$u;
			$this->pswd=$p;
		}

		function getLogin()
		{
			return $this->user;
		}

		function getHost()
		{
			return $this->host;
		}

		function __toString()
		{
			return $this->host.":".$this->dbname.":".$this->user.":".$this->pswd;
		}

		function connect()
		{
			try
			{
				$this->db=new PDO('mysql:host='. $this->host. ";dbname=". $this->dbname,$this->user,$this->pswd,array (PDO:: ATTR_PERSISTENT => true));
//				echo 'connexion etablie avec succes<br/>';
			}
			catch(PDOException $e)
			{
				print "Erreur ! ".$e->getMessage()."<br/>";
				die();
			}
		}

		function disconnect()
		{
			$this->db=null;
			//echo "deconexion";
		}

	}
?>