<?php
include_once('Modeles/Metiers/serie.php');

Class conteneurSerie
	{
	//ATTRIBUTS PRIVES-------------------------------------------------------------------------
	private $lesSeries;

	//CONSTRUCTEUR-----------------------------------------------------------------------------
	public function __construct()
		{
		$this->lesSeries = new arrayObject();
		}

	//METHODE AJOUTANT UNE serie------------------------------------------------------------------------------
	public function ajouteUneSerie($unId‪Serie, $unTitreSupport, $unRealisateurSupport, $uneImageSupport, $leGenreDeLaSerie, $unResumeSerie)
		{
		$uneSerie = new serie($unId‪Serie, $unTitreSupport, $unRealisateurSupport, $uneImageSupport, $leGenreDeLaSerie, $unResumeSerie);
		$this->lesSeries->append($uneSerie);

		}

	//METHODE RETOURNANT LE NOMBRE de series-------------------------------------------------------------------------------
	public function nbSeries()
		{
		return $this->lesSeries->count();
		}

	//METHODE RETOURNANT LA LISTE DES  series-----------------------------------------------------------------------------------------
	public function listeDesSeries($retour)
		{
		$liste = '<div class="conteneur col-lg-3 col-md-4 col-sm-6 col-xs-12">';
		$nb=0;
		foreach ($this->lesSeries as $uneSerie)
			{
				$row = $retour->fetch(PDO::FETCH_OBJ);
				if(empty($row))
				{
					break;
				}
				$id = $row->idSupport;

				$liste = $liste.'<div class="element hovereffect col-lg-3 col-md-4 col-sm-6 col-xs-12">  <img id='.$id.' src=./Images/'.$row->image.'
				title="'.$uneSerie->getTitreSerie().'" class="img-responsive" /> </a>
				<div class="overlay">
          <h2>'.$uneSerie->getTitreSerie().'</h2>
						<a class="info" href="index.php?vue=videotheque&action=fiche&id='.$id.' "	> Appuyer Ici </a>
				</div></div>';

			}
			$liste = $liste.'</div>';
		return $liste;
		}

		//METHODE RETOURNANT LA LISTE DES series DANS UNE BALISE <SELECT>------------------------------------------------------------------
	public function lesSeriesAuFormatHTML()
		{
		$liste = "<SELECT name = 'idSerie'>";
		foreach ($this->lesSeries as $uneSerie)
			{
			$liste = $liste."<OPTION value='".$uneSerie->getIdSerie()."'>".$uneSerie->getTitreSerie()."</OPTION>";
			}
		$liste = $liste."</SELECT>";
		return $liste;
		}

	//METHODE RETOURNANT UNE serie A PARTIR DE SON NUMERO--------------------------------------------
	public function donneObjetSerieDepuisNumeroSerie($unIdSerie)
		{
		//initialisation d'un booléen (on part de l'hypothèse que la serie n'existe pas)
		$trouve=false;
		$laBonneSerie=null;
		//création d'un itérateur sur la collection lesSeries
		$iSerie = $this->lesSeries->getIterator();
		//TQ on a pas trouvé la serie et que l'on est pas arrivé au bout de la collection
		while ((!$trouve)&&($iSerie->valid()))
			{
			//SI le numéro da la serie courant correspond au numéro passé en paramètre
			if ($iSerie->current()->getIdSerie()==$unIdSerie)
				{
				//maj du booléen
				$trouve=true;
				//sauvegarde la serie courant
				$laBonneSerie = $iSerie->current();

				}
			//SINON on passe à la série suivant
			else
				$iSerie->next();
			}
		return $laBonneSerie;
		}

	}

?>
