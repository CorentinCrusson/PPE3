<?php
//include du fichier GESTION pour les objets (Modeles)
include 'Modeles/gestionVideo.php';
include 'Api/Allocine/api-allocine-helper.php';

//classe CONTROLEUR qui redirige vers les bonnes vues les bonnes informations
class Controleur
	{
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//---------------------------ATTRIBUTS PRIVES-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	private $maVideotheque;
	private $helper;

	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//---------------------------CONSTRUCTEUR------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	public function __construct()
		{
		$this->maVideotheque = new gestionVideo();
		$this->helper = new AlloHelper();
		}


	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//---------------------------METHODE D'AFFICHAGE DE L'ENTETE-----------------------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	public function afficheEntete()
		{
		//appel de la vue de l'entête
		require 'Vues/entete.php';
		}


	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//---------------------------METHODE D'AFFICHAGE DU PIED DE PAGE------------------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	public function affichePiedPage()
		{
		//appel de la vue du pied de page
		require 'Vues/piedPage.php';
		}


	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//--------------------------METHODE D'AFFICHAGE DU MENU-----------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	public function afficheMenu()
		{
		//appel de la vue du menu
		require 'Vues/menu.php';
		}


	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//--------------------------METHODE D'AFFICHAGE DES VUES----------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	public function affichePage($action,$vue)
		{
		//SELON la vue demandée
		switch ($vue)
			{
			case 'compte':
				$this->vueCompte($action);
				break;
			case 'film':
				$this->vueFilm($action);
				break;
			case 'serie':
				$this->vueSerie($action);
				break;
			case 'Videotheque':
				$this->vueRessource($action);
				break;
			case "accueil":
				$this->vueAccueil($action);
				break;
			/*case "search":
				$this->vueSearch($action);
				break;*/
			}
		}


	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//----------------------------Mon Compte--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	private function vueCompte($action)
		{

		//SELON l'action demandée
		switch ($action)
			{

			//CAS visualisation de mes informations-------------------------------------------------------------------------------------------------
			case 'visualiser' :
				//ici il faut pouvoir avoir accès au information de l'internaute connecté
				$_SESSION['lesClients'] = $this->maVideotheque->listeLesClients($_SESSION['login']);

				require 'Vues/profil.php';
				break;
			case 'visuEmprunt':
				require 'Vues/menu.php';
				$affichage = $this->maVideotheque->listeLesEmprunts($_SESSION['login']);
				echo $affichage;
				break;
			case 'deconnexion':
				session_destroy();
				$this->redirection("","Déconnexion Effectuée");
					break;

			case 'search':
				require 'Vues/menu.php';
				$affichage = $this->maVideotheque->recherche($_SESSION['search']);
				echo $affichage;
				break;

			//CAS enregistrement d'une modification sur le compte------------------------------------------------------------------------------
			case 'modifier' :
				// ici il faut pouvoir modifier le mot de passe de l'utilisateur
				require 'Vues/modifClient.php';
				break;
			//CAS ajouter un utilisateur ------------------------------------------------------------------------------
			case 'nouveauLogin' :
				// ici il faut pouvoir recuperer un nouveau utilisateur
				$unNom = $_POST['nomClient'];
				$unPrenom = $_POST['prenomClient'];
				$unEmail = $_POST['emailClient'];
				$uneDate = $_POST['dateAbonnementClient'];
				$unLogin = $_POST['login'];
				$unPassword = $_POST['password'];

				if($this->maVideotheque->ajouteUnClient($unNom,$unPrenom,$unEmail,$uneDate,$unLogin,$unPassword))
				{

					$message = "Bonjour, \n Je vous confirme ".$unNom." ".$unPrenom." que votre compte a bien été créée, sous le login : \n ".$unLogin."\n Cependant, nous attendons
					chèque à l'adresse : XXX la poste Nantes (44000) \n\n Je vous souhaites une agréable journée. \n\nCordialement,\nVideo&Co ";


					if (mail($unEmail,"Confirmation de l'Inscription à Video&Co",$message, "From: Video&Co")) {
						$retour = "L'email a été envoyé.";
					} else {
						$retour = "L'email n'a pas été envoyé";
					}
				}
				echo $retour."\n";
				require 'Vues/inscription.php';
				break;

			case "modification":
				$unNom = $_POST['nomClient'];
				$unPrenom = $_POST['prenomClient'];
				$unEmail = $_POST['mailClient'];
				$unPassword = $_POST['passwdClient'];
/*
					if (empty($idPers))
					{
						$message = "Veuillez saisir les informations sur la Personne Physique à modifier";
						$lien = 'index.php?vue=persPhysique&action=modifier';
						$_SESSION['message'] = $message;
						$_SESSION['lien'] = $lien;
						require 'Vues/erreur.php';
					}*/
						$this->maVideotheque->modifClient($unNom, $unPrenom, $unEmail, $unPassword);
						$this->redirection("?vue=compte&action=verifLogin","Modifications Effectués");
					break;

			//CAS verifier un utilisateur ------------------------------------------------------------------------------
			case 'verifLogin' :
				// ici il faut pouvoir vérifier un login un nouveau utilisateur
				//Je récupère les login et password saisi et je verifie leur existancerequire
				//pour cela je verifie dans le conteneurClient via la gestion.
				if (isset($_SESSION['login'])) {
					$resultat = 1;
				}
				else
				{

					$unLogin=$_POST['login'];
					$unPassword=$_POST['password'];
					/*if(isset($_POST['login']) && isset($_POST['password']))
					{*/
						$resultat=$this->maVideotheque->verifLogin($unLogin, $unPassword);
				  //}
					}
							//si le client existe alors j'affiche le menu et la page visuGenre.php
							if($resultat==1)
							{
								if(!isset($_SESSION['login']))
									$_SESSION['login'] = $unLogin;
									$this->redirection("?vue=accueil&action=visualiser","Identifiants Corrects");
								echo $this->maVideotheque->listeLesGenres();
							}
							else
							{
								// destroy la session et je repars sur l'acceuil en affichant un texte pour prévenir la personne
								//des mauvais identifiants;
								session_destroy();

								/*Si resultat = 0 alors Identifiants Incorrents
									Sinon si resultat = 2 alors Abonnement non Actif */

								switch($resultat)
								{
									case 0:
										$retour = "Identifiants Incorrects";
										break;
									case 2:
										$retour = "Abonnement Non Actif";
										break;
									default:
										$retour = "Echec de Connexion";
								}
									$this->redirection("",$retour);
									}

							break;

				case 'passwdMissed' :
					//Formulaire permettant d'avoir l'email et d'envoyer son mot de passe avec contrôle de la présence ou non de cet email
					if(!isset($_POST['mailDuClient']))
					{
						require 'Vues/resetPassword.php';
					}
					else {
						$mail = $_POST['mailDuClient'];
						$password = $this->maVideotheque->trouvePassword($mail);
						$message="";

						//Si l'email est fausse
						if ($password == null)
						{
							$message = "Email Invalide";
						} else {

						//Envoi de l'email
						if (mail($mail,"Envoi de votre de Mot de Passe","Voici votre mot de passe : \n\n".$password, "From: Video&Co"))
				    	$message = "L'email a été envoyé.";
						}
						//Message accomplissant de l'envoi positivement ou négativement de l'email
						$this->redirection("",$message);
					}
					break;
				}
		}
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//----------------------------Film--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

	private function vueFilm($action)
		{
		//SELON l'action demandée
		switch ($action)
			{

				//CAS visualisation de tous les films-------------------------------------------------------------------------------------------------
				case "visualiser" :
				require 'Vues/menu.php';
					//ici il faut pouvoir visualiser l'ensemble des films
					$affichage = $this->maVideotheque->listeLesFilms();
					echo $affichage;
					break;

			}
		}
		//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
		//---------------------------- Accueil --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
		//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

	private function vueAccueil($action)
	{
		switch($action) {

			case "visualiser":
				$_SESSION['nom'] = $this->maVideotheque->getLesClients()->donneObjetClientDepuisLogin($_SESSION['login'])->getNomClient();
				$_SESSION['prenom'] = $this->maVideotheque->getLesClients()->donneObjetClientDepuisLogin($_SESSION['login'])->getPrenomClient();
				require 'Vues/menu.php';

				//TEST API1234
				$code = 27061;
		 		$profile = 'small';
				try
		    {
		        // Envoi de la requête
		        $movie = $this->helper->movie($code, $profile );

		        // Afficher le titre
		        //echo "Titre du film: ", $movie->title, PHP_EOL;

		        // Afficher toutes les données
		        //print_r($movie->getArray());

		    }
		    catch( ErrorException $error )
		    {
		        // En cas d'erreur
		        echo "Erreur n°", $error->getCode(), ": ", $error->getMessage(), PHP_EOL;
		    }
				//echo $this->maVideotheque->listeLesFilms();
				break;
		}

	}

	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//----------------------------Serie--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	private function vueSerie($action)
		{
		//SELON l'action demandée
		switch ($action)
			{

			//CAS visualisation de toutes les Series-------------------------------------------------------------------------------------------------
			case "visualiser" :
				//ici il faut pouvoir visualiser l'ensemble des Séries
				require 'Vues/menu.php';
				$affichage = $this->maVideotheque->listeLesSeries();
				echo $affichage;
				break;

			}
		}
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//----------------------------Vidéotheque-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	private function vueVideotheque($action)
		{
		//SELON l'action demandée
		switch ($action)
			{

			//CAS Choix d'un genre------------------------------------------------------------------------------------------------
			case "choixGenre" :
				if ($this->maVideotheque->donneNbGenres()==0)
					{
					$message = "il n existe pas de genre";
					$lien = 'index.php?vue=ressource&action=ajouter';
					$_SESSION['message'] = $message;
					$_SESSION['lien'] = $lien;
					require 'Vues/erreur.php';
					}
				else
					{
					$_SESSION['lesRessources'] = $this->maMairie->listeLesRessources();
					require 'Vues/voirRessource.php';
					}
				break;

			//CAS enregistrement d'une ressource dans la base------------------------------------------------------------------------------
			case "enregistrer" :
				$nom = $_POST['nomRessource'];
				if (empty($nom))
					{
					$message = "Veuillez saisir les informations";
					$lien = 'index.php?vue=ressource&action=ajouter';
					$_SESSION['message'] = $message;
					$_SESSION['lien'] = $lien;
					require 'Vues/erreur.php';
					}
				else
					{
					$this->maMairie->ajouteUneressource($nom);
					require 'Vues/enregistrer.php';
					//$_SESSION['Controleur'] = serialize($this);
					}
				break;
			}
		}

		private function vueSearch($action)
		{
			switch($action) {
				case "accueil":
					break;
			}
		}

		//Methode permettant de rediriger vers une page, en écrivant un message lors de la transition
		private function redirection($page,$message="")
		{
			echo "</nav>
					<div class='container h-100'>
						<div class='row h-100 justify-content-center align-items-center'>
							<span class='text-white'>".$message."</span>
						</div>
					</div>
					<meta http-equiv='refresh' content='1;index.php".$page."'>";
		}

		/*METHODE POUR AFFICHER le résultat de la recherche
		public function afficherResultatRecherche($video)
		{
			if(isset($_GET['video'])){
		    $video = (String) trim($_GET['video']);
			}
			$this->maVideotheque->recupererFilmsSeries($video);
		}*/

	}
?>
