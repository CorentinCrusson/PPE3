﻿<?php
include_once('Modeles/Metiers/emprunt.php');

Class conteneurEmprunt
	{
	//ATTRIBUTS PRIVES-------------------------------------------------------------------------
	private $lesEmprunt;

	//CONSTRUCTEUR-----------------------------------------------------------------------------
	public function __construct()
		{
		$this->lesEmprunts = new arrayObject();
		}

	//METHODE AJOUTANT UN Emprunt------------------------------------------------------------------------------
	public function mettreUnEmpruntEnPlus($unIdEmprunt, $uneDateEmprunt,$unClient,$unSupport, $uneDateFinEmprunt)
		{

		$unEmprunt = new emprunt($unIdEmprunt, $uneDateEmprunt,$unClient,$unSupport,$uneDateFinEmprunt);
		$this->lesEmprunts->append($unEmprunt);

		}

	//METHODE RETOURNANT LE NOMBRE d'emprunt-------------------------------------------------------------------------------
	public function nbEmprunt()
		{
		return $this->lesEmprunts->count();
		}

	//METHODE RETOURNANT LA LISTE DES Emprunts -----------------------------------------------------------------------------------------
	public function listeDesEmprunts($unLogin,$retour)
		{
		$liste = '<div class="conteneur" style="color: white ;">';
		$i=0;
		$dateEmprunts = array();
	/*	$this->listeEmprunt = new arrayObject();

		//On cherche d'abord les bons emprunts
		foreach ($this->lesEmprunts as $unEmprunt) {
			if($unEmprunt->getLeClient()->getLoginClient()==$unLogin)
			{
				$listeEmprunt->append($unEmprunt);
			}
		}*/
		foreach($this->lesEmprunts as $unEmprunt) {
				$unSupport=$unEmprunt->getLeSupport();
				$leClient=$unEmprunt->getLeClient();

				if ($leClient->getLoginClient()==$unLogin && $unEmprunt->getDateFinEmprunt() > date("Y-m-d") ) {
						$row = $retour->fetch(PDO::FETCH_NUM);
						if($row[0]!=null) {
							$liste = $liste.'
							<div class="element"> <a href="index.php?vue=videotheque&action=fiche&id='.$row[1].'">
							<img center src="./Images/'.$row[0].'" /> </a> </div>
							';
						}
					}
			}
		return $liste.'</div>';
		}

		//METHODE RETOURNANT LA LISTE DES emprunts DANS UNE BALISE <SELECT>------------------------------------------------------------------
	public function lesEmpruntsAuFormatHTML()
		{
		$liste = "<SELECT name = 'idEmprunt'>";
		foreach ($this->lesEmprunts as $unEmprunt)
			{
			$liste = $liste."<OPTION value='".$unEmprunt->getIdEmprunt()."'>".$unEmprunt->getDateEmprunt()."</OPTION>";
			}
		$liste = $liste."</SELECT>";
		return $liste;
		}

//METHODE RETOURNANT UN emprunt A PARTIR DE SON NUMERO--------------------------------------------
	public function donneObjetEmpruntDepuisNumero($unIdEmprunt)
		{
		//initialisation d'un booléen (on part de l'hypothèse que l'emprunt n'existe pas)
		$trouve=false;
		$leBonEmprunt=null;
		//création d'un itérateur sur la collection lesEmprunts
		$iEmprunt = $this->lesEmprunts->getIterator();
		//TQ on a pas trouvé l'emprunt et que l'on est pas arrivé au bout de la collection
		while ((!$trouve)&&($iEmprunt->valid()))
			{
			//SI le numéro de l'emprunt courant correspond au numéro passé en paramètre
			if ($iEmprunt->current()->getIdEmprunt()==$unIdEmprunt)
				{
				//maj du booléen
				$trouve=true;
				//sauvegarde l'emprunt courant
				$leBonEmprunt = $iEmprunt->current();

				}
			//SINON on passe à l'emprunt suivant
			else
				$iEmprunt->next();
			}
		return $leBonEmprunt;
		}

	}

?>
