<?php

	class QCM
	{
		public $question;
		public $proposition1;
		public $proposition2;
		public $proposition3;
		public $reponse;

		function __construct($q,$r,$p1,$p2,$p3)
		{
			$this->question=$q;
			$this->proposition1=$p1;
			$this->proposition2=$p2;
			$this->proposition3=$p3;
			$this->reponse=$r;
		}

		function desordonner()
		{
			$tab=array($this->proposition3,$this->reponse,$this->proposition2,$this->proposition1);

			for($i=count($tab)-1;$i>=0;$i--)
			{
				$ind=random_int(0, $i);
				$tmp=$tab[$ind];
				$tab[$ind]=$tab[$i];
				$tab[$i]=$tmp;
			}

			return $tab;
		}

		function getResultat($text)
		{
			//retourne 0 quand c'est vrai
			if(strcmp($this->reponse,$text)==0)
				return 1;
			else
				return 0;
		}
	}
?>