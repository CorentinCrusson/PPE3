<?php
include_once './Modeles/Conteneurs/conteneurClient.php';
include_once './Modeles/Conteneurs/conteneurEmprunt.php';
include_once './Modeles/Conteneurs/conteneurEpisode.php';
include_once './Modeles/Conteneurs/conteneurFilm.php';
include_once './Modeles/Conteneurs/conteneurGenre.php';
include_once './Modeles/Conteneurs/conteneurSaison.php';
include_once './Modeles/Conteneurs/conteneurSerie.php';
include_once './Modeles/Conteneurs/conteneurSupport.php';
include_once './Modeles/accesBD.php';

Class gestionVideo
	{
	//ATTRIBUTS PRIVES---------------------------------------------------------------------------------------------------------------------------
	private $tousLesClients;
	private $tousLesSupports;
	private $tousLesEmprunts;
	private $tousLesEpisodes;
	private $tousLesFilms;
	private $tousLesGenres;
	private $toutesLesSaisons;
	private $toutesLesSeries;
	private $maBD;

	//CONSTRUCTEUR--------------------------------------------------------------------------------------------------------------------------------
	public function __construct()
		{
		$this->tousLesClients = new conteneurClient();
		$this->tousLesGenres = new conteneurGenre();
		$this->tousLesSupports = new conteneurSupport();
		$this->tousLesFilms = new conteneurFilm();
		$this->toutesLesSeries = new conteneurSerie();
		$this->toutesLesSaisons = new conteneurSaison();
		$this->tousLesEpisodes = new conteneurEpisode();
		$this->tousLesEmprunts = new conteneurEmprunt();

		$this->maBD = new accesBD();

		$this->chargeLesClients();
		$this->chargeLesGenres();
		$this->chargeLesSupports();
		$this->chargeLesFilms();
		$this->chargeLesSeries();
		$this->chargeLesSaisons();
		$this->chargeLesEpisodes();
		$this->chargeLesEmprunts();

		}


	//METHODE CHARGEANT TOUTES LES Clients--------------------------------------------------------------------------------------
	private function chargeLesClients()
	{
		$resultat=$this->maBD->chargement('client');
		$nb=0;
		while ($nb<sizeof($resultat))
			{
			//instanciation du client et ajout de celui-ci dans la collection
			$this->tousLesClients->ajouteUnClient($resultat[$nb][0],$resultat[$nb][1],$resultat[$nb][2],$resultat[$nb][3],$resultat[$nb][4],$resultat[$nb][5],$resultat[$nb][6]);
			$nb++;

			}
	}
	//METHODE CHARGEANT TOUS LES GENRES-----------------------------------------------------------------------------------
	private function chargeLesGenres()
		{
		$resultat=$this->maBD->chargement('genre');
		$nb=0;

		while ($nb<sizeof($resultat))
			{
				$this->tousLesGenres->ajouteUnGenre($resultat[$nb][0],$resultat[$nb][1]);

			$nb++;
			}

		}
	//METHODE CHARGEANT TOUS LES Supports-----------------------------------------------------------------------------------
	private function chargeLesSupports()
		{
		$resultat=$this->maBD->chargement('support');
		$nb=0;
		while ($nb<sizeof($resultat))
			{
				$leGenre = $this->tousLesGenres->donneObjetGenreDepuisNumero($resultat[$nb][4]);
				$this->tousLesSupports->ajouteUnSupport($resultat[$nb][0],$resultat[$nb][1],$resultat[$nb][2],$resultat[$nb][3],$leGenre);

			$nb++;
			}

		}
		//METHODE CHARGEANT TOUS LES FILMS-----------------------------------------------------------------------------------
	private function chargeLesFilms()
		{
		$resultat=$this->maBD->chargement('film');
		$nb=0;
		while ($nb<sizeof($resultat))
			{
				$leSupport = $this->tousLesSupports->donneObjetSupportDepuisNumero($resultat[$nb][2]);
				$leGenre = $leSupport->getLeGenreDeSupport();
				$leGenre = $this->tousLesGenres->donneObjetGenreDepuisNumero($leGenre->getIdGenre());
				$this->tousLesFilms->ajouteUnFilm($resultat[$nb][0],$leSupport->getTitreSupport(),$leSupport->getRealisateurSupport(),$leSupport->getImageSupport(),$leGenre,$resultat[$nb][1]);
			$nb++;
			}

		}

//METHODE CHARGEANT TOUTES LES SERIES-----------------------------------------------------------------------------------
	private function chargeLesSeries()
		{
		$resultat=$this->maBD->chargement('serie');
		$nb=0;
		while ($nb<sizeof($resultat))
			{
				$leSupport = $this->tousLesSupports->donneObjetSupportDepuisNumero($resultat[$nb][2]);
				$leGenre = $this->tousLesGenres->donneObjetGenreDepuisNumero($leSupport->getLeGenreDeSupport()->getIdGenre());
				$this->toutesLesSeries->ajouteUneSerie($resultat[$nb][0],$leSupport->getTitreSupport(),$leSupport->getRealisateurSupport(),$leSupport->getImageSupport(),$leGenre,$resultat[$nb][1]);
			$nb++;
			}

		}
//METHODE CHARGEANT TOUTES LES SAISONS-----------------------------------------------------------------------------------
	private function chargeLesSaisons()
		{
		$resultat=$this->maBD->chargement('Saison');
		$nb=0;

		while ($nb<sizeof($resultat))
			{   $laSerie = $this->toutesLesSeries->donneObjetSerieDepuisNumeroSerie($resultat[$nb][0]);
				$this->toutesLesSaisons->ajouteUneSaison($resultat[$nb][1],$resultat[$nb][2],$resultat[$nb][3],$laSerie);
			$nb++;
			}

		}
		//METHODE CHARGEANT TOUTES LES EPISODES-----------------------------------------------------------------------------------
	private function chargeLesEpisodes()
		{
		$resultat=$this->maBD->chargement('episode');
		$nb=0;
		while ($nb<sizeof($resultat))
			{
			$laSaison = $this->toutesLesSaisons->donneObjetSaisonDepuisNumero($resultat[$nb][0],$resultat[$nb][1]);
			$this->tousLesEpisodes->ajouteUnEpisode($resultat[$nb][2],$resultat[$nb][3],$resultat[$nb][4],$laSaison);
			$nb++;
			}

		}
	//METHODE CHARGEANT TOUS LES EMPRUNTS -----------------------------------------------------------------------------------
	private function chargeLesEmprunts()
		{
		$resultat=$this->maBD->chargement('emprunt');
		$nb=0;
		while ($nb<sizeof($resultat))
			{
				// récupérer le client et le support à partir de l'emprunt
				$leSupport = $this->tousLesSupports->donneObjetSupportDepuisNumero($resultat[$nb][3]);
				$unClient = $this->tousLesClients->donneObjetClientDepuisNumero($resultat[$nb][2]);
				$this->tousLesEmprunts->mettreUnEmpruntEnPlus($resultat[$nb][0], $resultat[$nb][1],$unClient,$leSupport,$resultat[$nb][4]);
			    $nb++;
			}

		}

/*METHODE AFFICHANT FILM/SERIES
		public function recupererFilmsSeries($video)
		{
			$requete = $this->maBD->recupererInfos($video);
			foreach($requete as $r){
      ?>
        <div style="margin-top: 20px 0; border-bottom: 2px solid #ccc"><?= $r['idSupport'] . " " . $r['titreSupport'] ?></div><?php
    	}
			return $requete;
		}*/

//METHODE QUI VERIF LE LOGIN ET LE PASSWORD DE L UTILISATEUR
	public function verifLogin($unLogin, $unPassword)
	{
		$resultat=$this->tousLesClients->verificationExistanceClient($unLogin, $unPassword);
		if ($resultat == 1)
		{
			if ($this->maBD->verificationActif($unLogin) == 0)
				$resultat = 2;
		}
		return $resultat;
	}


//METHODE INSERANT UN CLIENT----------------------------------------------------------------------------------------------------------
	public function ajouteUnClient($unNomClient, $unPrenomClient, $unEmailClient, $uneDateAbonnement,$unLogin, $unPassword)
		{
		//insertion du client dans la base de données
		$sonNumero = $this->maBD->insertClient($unNomClient, $unPrenomClient, $unEmailClient, $uneDateAbonnement, $unLogin, $unPassword);
		//instanciation du client et ajout de celui-ci dans la collection
		$this->tousLesClients->ajouteUnClient($sonNumero, $unNomClient, $unPrenomClient, $unEmailClient, $uneDateAbonnement, $unLogin, $unPassword);

		return true;
		}
	//METHODE INSERANT UN FILM----------------------------------------------------------------------------------------------------------
	public function ajouteUnFilm($unIdFilm,$unTitreFilm, $unRealisateurFilm, $unIdGenre,$uneDureeFilm)
		{
		//insertion du film dans la base de données
		$sonNumero = $this->maBD->insertFilm($unTitreFilm, $unRealisateurFilm, $unIdGenre,$uneDureeFilm);
		//instanciation du film et ajout de celui-ci dans la collection
		$leGenre= null;
		$leGenre=$leGenre->donneObjetGenreDepuisNumero($unIdGenre);
		$this->tousLesFilms->ajouteUnFilm($unIdFilm,$unTitreFilm, $unRealisateurFilm, $leGenre,$uneDureeFilm);
		}
	//METHODE INSERANT UNE SERIE----------------------------------------------------------------------------------------------------------
	public function ajouteUneSerie($unIdSerie,$unTitreSerie, $unRealisateurSerie, $unIdGenre,$unResumeSerie)
		{
		//insertion de la serie dans la base de données
		$sonNumero = $this->maBD->insertSerie($unTitreSerie, $unRealisateurSerie, $unIdGenre,$unResumeSerie);
		//instanciation de la serie et ajout de celui-ci dans la collection
		$leGenre= null;
		$leGenre=$leGenre->donneObjetGenreDepuisNumero($unIdGenre);
		$this->toutesLesSeries->ajouteUneSerie($unIdSerie,$unTitreSerie, $unRealisateurSerie, $leGenre,$unResumeSerie);
		}
		//METHODE INSERANT UN GENRE----------------------------------------------------------------------------------------------------------
	public function ajouteUnGenre($unLibelleGenre)
		{
		//insertion du genre dans la base de données
		$sonNumero = $this->maBD->insertGenre($unLibelleGenre);
		//instanciation du genre et ajout de celui-ci dans la collection
		$this->tousLesGenres->ajouteUnGenre($sonNumero,$unLibelleGenre);
		}
	//METHODE INSERANT UNE SAISON--------------------------------------------------------------------------------------------------------
	public function ajouteUneSaison($unIdSerie,$uneAnneeSaison, $unNbrEpisodesPrevus)
		{
		//insertion de la saison  dans la base de données
		$sonCode=$this->maBD->insertSaison($unIdSerie,$uneAnneeSaison, $unNbrEpisodesPrevus);
		$leGenre = null;
		$laSerie = null;
		$laSerie = $laSerie->donneObjetSerieDepuisNumero($unIdSerie);
		//instanciation de la saison et ajout de celle-ci dans la collection
		$this->toutesLesSaisons->ajouteUneSaison($unIdSaison,$uneAnneeSaison, $unNbrEpisodeSaison, $laSerie);
		}

    //METHODE INSERANT UN EMPRUNT--------------------------------------------------------------------------------------------------------
	public function ajouteUnEmprunt($uneDateEmprunt, $unIdClient, $unIdSupport,$dureeEmprunt)
		{
			$uneDateFinEmprunt = date("Y-m-d", mktime(0,0,0, date("m")+$dureeEmprunt  , date("d"), date("Y")) );
		//insertion de l'emprunt  dans la base de données
		$sonCode=$this->maBD->insertEmprunt($uneDateEmprunt, $unIdClient, $unIdSupport,$uneDateFinEmprunt);

		//instanciation de l'emprunt et ajout de celui-ci dans la collection
		$leClient = null;
		$leClient = $this->getLesClients()->donneObjetClientDepuisNumero($unIdClient);
		$leSupport = null;
		$leSupport = $this->tousLesSupports->donneObjetSupportDepuisNumero($unIdSupport);
		$this->tousLesEmprunts->mettreUnEmpruntEnPlus($sonCode, $uneDateEmprunt,$leClient,$leSupport,$uneDateFinEmprunt);

		return true;
		}
	//METHODE INSERANT UN EPISODE --------------------------------------------------------------------------------------------------------
	public function ajouteUnEpisode($unIdSerie, $unNumSaison, $unTitreEpisode, $uneDuree)
		{
		//insertion d'un episode  dans la base de données
		$sonCode=$this->maBD->insertEpisode($unIdSerie, $unNumSaison, $unTitreEpisode, $uneDuree);

		//instanciation de l'épisode et ajout de celui-ci dans la collection
		$leGenre = null;
		$laSerie = null;
		$laSaison = null;
		$laSaison = $laSaison->donneObjetSaisonDepuisNumero($unIdSerie,$unNumSaison);
		$this->tousLesEpisodes->ajouteUnEpisode($sonCode,$unTitreEpisode,$uneDureeEpisode, $laSaison);
		}

		public function modifClient($nomClient, $prenomClient,$mailClient,$passwdClient)
			{
				//On vérifie si le champ saisi est vide et si c'est le cas, on rentre le champ avec les informations initiales

				foreach($this->tousLesClients->getLesClients() as $unClient)
				{
					if($unClient->getLoginClient() == $_SESSION['login'])
						{
							if (empty($nomClient))
								$nomClient = $unClient->getNomClient();

							if (empty($prenomClient))
								$prenomClient = $unClient->getPrenomClient();

							if (empty($mailClient))
								$mailClient = $unClient->getEmailClient();

							if (empty($passwdClient))
								$passwdClient = $unClient->getPwdClient();

							$unId = $unClient->getIdClient();
						}
				}
				$this->maBD->updateClient($unId, $nomClient,$prenomClient,$mailClient,$passwdClient);
			}

	//METHODE SUPPRIMANT UN EMPRUNT--------------------------------------------------------------------------------------------------------
	public function supprimerUnEmprunt($unIdClient, $unIdSupport)
		{
			$requete = $this->maBD->supprimerEmprunt($unIdClient, $unIdSupport,$action=true);

			return $requete;
		}

	//METHODE RETOURNANT LE NOMBRE DE CLIENT------------------------------------------------------------------------------------------------
	public function donneNbClients()
		{
		return $this->tousLesClients->nbClients();
		}

	//METHODE RETOURNANT LE NOMBRE DE FIlMS----------------------------------------------------------------------------------------------
	public function donneNbFilms()
		{
		return $this->tousLesFilms->nbFilms();
		}
	public function donneNbSeries()
		{
		return $this->toutesLesSeries->nbSeries();
		}
	public function donneNbGenres()
		{
		return $this->tousLesGenres->nbGenres();
		}
	public function donneNbSaisons()
		{
		return $this->toutesLesSaisons->nbSaisons();
		}
	public function donneNbEmprunts()
		{
		return $this->tousLesEmprunts->nbEmprunts();
		}
	public function donneNbEpisodes()
		{
		return $this->tousLesEpisodes->nbEpisodes();
		}

	 //METHODE RETOURNANT Le password d'un client en fonction du mail envoyé ----------------------------------------------------------------------------------------------------------------------
	 public function trouvePassword($mail)
	 {
		 $retour = $this->tousLesClients->donneObjetClientDepuisMail($mail);

		 if ($retour != null)
		 {
			 $retour = $retour->getPwdClient();
		 }

		 return $retour;
	 }

	 public function getLesClients()
	 {
		 return $this->tousLesClients;
	 }

	 private function getLesSupports()
	 {
		 return $this->tousLesSupports;
	 }

	//METHODE RETOURNANT LA LISTE DES differents elements-------------------------------------------------------------------------------------------------------
	public function listeLesClients($login)
		{
		return $this->tousLesClients->listeDesClients($login);
		}
	public function listeLesFilms($idGenre='')
		{
			$retour = $this->maBD->donneImageFilm($idGenre);
			$liste = $this->tousLesFilms->listeDesFilms($retour);
			return $liste;
		}
	public function listeLesSeries($idGenre='')
		{
			$retour = $this->maBD->donneImageSerie($idGenre);
			$liste = $this->toutesLesSeries->listeDesSeries($retour);
			return $liste;
		}
	public function listeLesGenres()
		{
			$imageGenre = $this->maBD->donneImagesGenre();
			return $this->tousLesGenres->listeDesGenres($imageGenre);
		}
	public function listeLesSaisons()
		{
		return $this->toutesLesSaisons->listeLesSaisons();
		}
	public function listeLesEmprunts($login)
		{
			$retour = $this->maBD->donneImagesEmprunts($login);
			$retour = $this->tousLesEmprunts->listeDesEmprunts($login,$retour);
			return $retour;
		}
	public function listeLesEpisodes()
		{
		return $this->tousLesEpisodes->listeDesEpisodes();
		}

	//METHODE RETOURNANT LA LISTE DES DIFFERENTS ELEMENTS DANS DES BALISES <SELECT>-----------------------------------------------------------------
	public function lesClientsAuFormatHTML()
		{
		return $this->tousLesClients->lesClientsAuFormatHTML();
		}
	public function lesFilmsAuFormatHTML()
		{
		return $this->tousLesFilms->lesFilmsAuFormatHTML();
		}
	public function lesSeriesAuFormatHTML()
		{
		return $this->toutesLesSeries->lesSeriesAuFormatHTML();
		}
	public function lesGenresAuFormatHTML()
		{
		return $this->tousLesGenres->lesGenresAuFormatHTML();
		}
	public function lesSaisonsAuFormatHTML()
		{
		return $this->toutesLesSaisons->lesSaisonsAuFormatHTML();
		}
	public function lesEmpruntsAuFormatHTML()
		{
		return $this->tousLesEmprunts->lesEmpruntsAuFormatHTML();
		}
	public function lesEpisodesAuFormatHTML()
		{
		return $this->tousLesEpisodes->lesEpisodesAuFormatHTML();
		}
		
		//Methode retournant les informations des clients
		public function recupInfosClient ($idClient)
		{
			$resultat = $this->maBD->recupInfosClient($idClient);

			$tab = array();

			$tab = $resultat->fetch(PDO::FETCH_BOTH);

			return $tab;
		}
		//METHODE RETOURNANT LES CONTENUS DRE Supports
		public function retournerInfosSupport($id,$type)
		{
			if($type=="film")
			{
				$rep = $this->maBD->retournerInfosFilm($id);
			} else if($type=="serie"){
				$rep =  $this->maBD->retournerInfosSerie($id);
			}

			return $rep;
		}

		//RETOURNE UN SUPPORT ALEATOIRE ( FILM OU SERIE ) en fonction d'un genre
		public function retourneAleaSupport($idGenre=0)
		{
			$supports = array();

			$resultat = $this->maBD->retournerSupportGenre($idGenre);

			while($donnees = $resultat->fetch(PDO::FETCH_OBJ)) {

				array_push($supports,$donnees->idSupport);
			}

			$id = $supports[ rand( 0,count($supports)-1 ) ];
			return $id;
		}

	}

?>
