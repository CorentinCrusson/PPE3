<?php
include_once('Modeles/Metiers/genre.php');

Class conteneurGenre
	{
	//ATTRIBUTS PRIVES-------------------------------------------------------------------------
	private $lesGenres;

	//CONSTRUCTEUR-----------------------------------------------------------------------------
	public function __construct()
		{
		$this->lesGenres = new arrayObject();
		}

	//METHODE AJOUTANT UN genre------------------------------------------------------------------------------
	public function ajouteUnGenre($unId‪Genre, $unLibelleGenre)
		{
		$unGenre = new genre($unId‪Genre, $unLibelleGenre);
		$this->lesGenres->append($unGenre);

		}

	//METHODE RETOURNANT LE NOMBRE de genres-------------------------------------------------------------------------------
	public function nbGenres()
		{
		return $this->lesGenres->count();
		}

	//METHODE RETOURNANT LA LISTE DES Genres-----------------------------------------------------------------------------------------
	public function listeDesGenres($listeImageGenre)
		{
		$liste = "<div class='container h-100'>
                    <div class='row h-100 justify-content-center align-items-center'>
                        <table class='table w-50'>
                            <tbody>";
		foreach ($this->lesGenres as $unGenre)
			{
				$row = $listeImageGenre->fetch(PDO::FETCH_OBJ);
				$liste = $liste.'<tr><td class="text-white td-table"> <a href="index.php?vue=videotheque&action=visualiserGenre&idGenre='.$row->idGenre.' "	> <img src="./Images/'.$row->image.'" /> </a> </td><td class="text-white td-table">'.$unGenre->getLibelleGenre().'</td></tr>';
			}
			$liste=$liste."</tbody></table></div></div>";
		return $liste;
		}

		//METHODE RETOURNANT LA LISTE DES genres DANS UNE BALISE <SELECT>------------------------------------------------------------------
	public function lesGenresAuFormatHTML()
		{
			$liste ='<li><a href="index.php?vue=videotheque&action=aleatoire">Aléatoire</a></li>';
			$nb = 1;
		foreach ($this->lesGenres as $unGenre)
			{
				$liste = $liste.'<li><a href="index.php?vue=videotheque&action=aleatoire&genre='.$nb.'">'.$unGenre->getLibelleGenre().'</a></li>';
				$nb++;
			}
		return $liste;
		}

//METHODE RETOURNANT UN genre A PARTIR DE SON NUMERO--------------------------------------------
	public function donneObjetGenreDepuisNumero($unIdGenre)
		{
		//initialisation d'un booléen (on part de l'hypothèse que le genre n'existe pas)
		$trouve=false;
		$leBonGenre=null;
		//création d'un itérateur sur la collection lesGenres
		$iGenre = $this->lesGenres->getIterator();
		//TQ on a pas trouvé le genre et que l'on est pas arrivé au bout de la collection
		while ((!$trouve)&&($iGenre->valid()))
			{
			//SI le numéro du genre courant correspond au numéro passé en paramètre
			if ($iGenre->current()->getIdGenre() == $unIdGenre)
				{
				//maj du booléen
				$trouve=true;
				//sauvegarde du genre courant
				$leBonGenre = $iGenre->current();

				}
			//SINON on passe au genre suivant
			else
				$iGenre->next();
			}
		return $leBonGenre;
		}

	}

?>
