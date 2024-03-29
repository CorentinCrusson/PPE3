﻿<?php
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
		if(isset($_SESSION['login'])) {
			if(!isset($_SESSION['nom'])) {
				$_SESSION['nom'] = $this->maVideotheque->getLesClients()->donneObjetClientDepuisLogin($_SESSION['login'])->getNomClient();
				$_SESSION['prenom'] = $this->maVideotheque->getLesClients()->donneObjetClientDepuisLogin($_SESSION['login'])->getPrenomClient();
			}
		}
		$_SESSION['lesGenres'] = $this->maVideotheque->lesGenresAuFormatHTML();
		require 'Vues/menu.php';
		}

	/*public function afficheBarreRecherche()
	{
		require 'Vues/searchBar.php';
	}*/


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
				$this->afficheMenu();
				$this->vueFilm($action);
				break;
			case 'serie':
				$this->afficheMenu();
				$this->vueSerie($action);
				break;
			case 'videotheque':
				$this->afficheMenu();
				$this->vueRessource($action);
				break;
			case "accueil":
				$this->afficheMenu();
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
				$this->afficheMenu();
				
				//ici il faut pouvoir avoir accès au information de l'internaute connecté
				$idClient = $this->maVideotheque->getLesClients()->donneObjetClientDepuisLogin($_SESSION['login'])->getIdClient();
				$_SESSION['leClient'] = $this->maVideotheque->recupInfosClient($idClient);

				require 'Vues/profil.php';
				break;

			case 'visuEmprunt':
				$this->afficheMenu();
				$affichage = $this->maVideotheque->listeLesEmprunts($_SESSION['login']);
				echo $affichage;
				break;
			case 'deconnexion':
				session_destroy();
				$this->redirection("","Déconnexion Effectuée");
					break;

			case 'search':
				$this->afficheMenu();
				$affichage = $this->maVideotheque->recherche($_SESSION['search']);
				echo $affichage;
				break;

			//CAS enregistrement d'une modification sur le compte------------------------------------------------------------------------------
			case 'modifier' :
				// ici il faut pouvoir modifier le mot de passe de l'utilisateur
				$this->afficheMenu();
				require 'Vues/Modifier_Profil.php';
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
										$retour = "Echec de la Verification";
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
							var_dump("email INVALIDE");
						} else {

						//Envoi de l'email
						if (mail($mail,"Envoi de votre de Mot de Passe","Voici votre mot de passe : \n\n".$password, "From: Video&Co"))
				    	//$message = "L'email a été envoyé.";
							var_dump('ah');
						else
							var_dump($mail);
						}
						//Message accomplissant de l'envoi positivement ou négativement de l'email
						//$this->redirection("",$message,5);
					}
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
				//require 'Vues/searchBar.php';



				/*TEST API1234
				$code = 27061;
		 		$profile = 'small';
				try
		    {
		        /* -*9Envoi de la requête
		        $movie = $this->helper->movie($code, $profile );

		        // Afficher le titre
		        echo "Titre du film: ", $movie->title, PHP_EOL;

		        // Afficher toutes les données
		        print_r($movie->getArray());

		    }
		    catch( ErrorException $error )
		    {
		        // En cas d'erreur
		        echo "Erreur n°", $error->getCode(), ": ", $error->getMessage(), PHP_EOL;
		    }
				*/
 				echo '<div id="displaySupport"'.$this->maVideotheque->listeLesGenres().'</div>';
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
					//require 'Vues/searchBar.php';
					//ici il faut pouvoir visualiser l'ensemble des films
					$affichage = $this->maVideotheque->listeLesFilms();
					echo '<div id="displaySupport" style="visibility=visible">'.$affichage.'</div>';
					break;

					case "emprunter":
						$retour = '';
						if($_GET['id']) {

								$idClient = $this->maVideotheque->getLesClients()->donneObjetClientDepuisLogin($_SESSION['login'])->getIdClient();

								$resultat = $this->maVideotheque->ajouteUnEmprunt(date("Y-m-d"),$idClient,$_GET['id'],3);

								$retour = $retour.'<div class="test" style="color: white;">';
								if(isset($resultat))
								{
									// résultats
									$retour = $retour.'<p> Emprunt Effectué ! </p>';

								} else {

									$retour = $retour.'<p> /!\ Erreur au niveau de l\Emprunt </p>';
								}


								$retour = "";

								$this->redirection("?vue=videotheque&action=fiche&id=".$_GET['id'],$retour);
						}

						break;

					case "supprimer":
							$retour = '';
							if($_GET['id']) {
									$idClient = $this->maVideotheque->getLesClients()->donneObjetClientDepuisLogin($_SESSION['login'])->getIdClient();
									$resultat = $this->maVideotheque->supprimerUnEmprunt($idClient,$_GET['id']);

									$retour = $retour.'<div class="test" style="color: white;">';
									if($resultat)
									{
										// résultats
										$retour = $retour.'<p> Emprunt Supprimé ! </p>';

									} else {

										$retour = $retour.'<p> /!\ Ce support n\'a pas été ajouté </p>';
									}


									$retour = "";

									$this->redirection("?vue=videotheque&action=fiche&id=".$_GET['id'],$retour);
							}
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
				//require 'Vues/searchBar.php';
				//ici il faut pouvoir visualiser l'ensemble des Séries
				$affichage = $this->maVideotheque->listeLesSeries();
				echo '<div id="displaySupport">'.$affichage.'</div>';
				break;

				case "emprunter":
					$retour = '';
					if($_GET['id']) {

							$idClient = $this->maVideotheque->getLesClients()->donneObjetClientDepuisLogin($_SESSION['login'])->getIdClient();
							$resultat = $this->maVideotheque->ajouteUnEmprunt(date("Y-m-d"),$idClient,$_GET['id'],1)	;

							$retour = $retour.'<div class="test" style="color: white;">';
							if(isset($resultat))
							{
								// résultats
								$retour = $retour.'<p> Emprunt Effectué ! </p>';

							} else {

								$retour = $retour.'<p> /!\ Erreur au niveau de l\Emprunt </p>';
							}


							$retour = "";


							$this->redirection("?vue=videotheque&action=fiche&id=".$_GET['id'],$retour);
					}

					break;

				case "supprimer":
						$retour = '';
						if($_GET['id']) {

								$idClient = $this->maVideotheque->getLesClients()->donneObjetClientDepuisLogin($_SESSION['login'])->getIdClient();
								$resultat = $this->maVideotheque->supprimerUnEmprunt($idClient,$_GET['id']);

								$retour = $retour.'<div class="test" style="color: white;">';
								if($resultat)
								{
									// résultats
									$retour = $retour.'<p> Emprunt Supprimé ! </p>';

								} else {

									$retour = $retour.'<p> /!\ Ce support n\'a pas été ajouté </p>';
								}


								$retour = "";

								$this->redirection("?vue=videotheque&action=fiche&id=".$_GET['id'],$retour);
						}

						break;

			}
		}
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//----------------------------Vidéotheque-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	private function vueRessource($action)
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

			case "fiche":
				$retour = '';

				if($_GET['id']) {
						$id = $_GET['id'];
						$support ="film";
						$empty = true;

						$idClient = $this->maVideotheque->getLesClients()->donneObjetClientDepuisLogin($_SESSION['login'])->getIdClient();
						$resultat = $this->maVideotheque->retournerInfosSupport($id,$support);

						if(isset($resultat))
						{
							// résultats
							$retour = $retour.'<div class="conteneur" style="padding-left: 10%; padding-top: 2%; color: white;">';

							while($donnees = $resultat->fetch(PDO::FETCH_OBJ)) {
								// je remplis un tableau et mettant le nom de la ville en index pour garder le tri
									$retour = $retour.'
									<div class="element">
										<img src="./Images/'.$donnees->image.'" />
									</div>

									<div class="element">
										<h2> Titre </h2>
										<p id="titre">'.$donnees->titreSupport.'</p>

										<h2> Réalisateur </h2>
										<p id="realisateur">'.$donnees->realisateur.'</p>

										<h2> Resumé </h2>
										<p id="resume">Null</p>

										<h2> Durée </h2>
										<p id="duree">'.$donnees->duree.'</p>

										<h2> Genre </h2>
										<p id="genre">'.$donnees->libelleGenre.'</p>
									';
									$empty = false;
							}

							if($empty) {
								$support = "serie";
								$resultat = $this->maVideotheque->retournerInfosSupport($id,$support);
									while($donnees = $resultat->fetch(PDO::FETCH_OBJ)) {
										// je remplis un tableau et mettant le nom de la ville en index pour garder le tri
											$retour = $retour.'
												<div class="element">
													<img src="./Images/'.$donnees->image.'" />
												</div>

											<div class="element">
												<h2> Titre </h2>
												<p id="titre">'.$donnees->titreSupport.'</p>

												<h2> Réalisateur </h2>
												<p id="realisateur">'.$donnees->realisateur.'</p>

												<h2> Resumé </h2>
												<p id="resume">'.$donnees->resumeSerie.'</p>

												<h2> Durée </h2>
												<p id="duree">Null</p>

												<h2> Genre </h2>
												<p id="genre">'.$donnees->libelleGenre.'</p>';
									}
							}

							if($this->maVideotheque->supprimerUnEmprunt($idClient,$id)) {
								$retour = $retour.'<button type="submit" class="btn btn-danger btn-default"><span class="fas fa-power-off"></span>
								<a style="text-decoration:none;color:white;" href="index.php?vue='.$support.'&action=supprimer&id='.$_GET['id'].'"> Supprimer </a> </button> </div> </div>';
						  } else {
								$retour = $retour.'<button type="submit" class="btn btn-success btn-default"><span class="fas fa-power-off"></span>
								<a style="text-decoration:none;color:white;" href="index.php?vue='.$support.'&action=emprunter&id='.$_GET['id'].'"> Emprunter </a> </button> </div> </div>';
							}
							$retour = $retour.'</div>';
						}

					}

				echo $retour;
				break;

				case "visualiserGenre":
					$idGenre = $_GET['idGenre'];
					echo $this->maVideotheque->listeLesFilms($idGenre);
					echo $this->maVideotheque->listeLesSeries($idGenre);
					break;

				case "aleatoire":
					if(isset($_GET['genre'])) {
						$id = $this->maVideotheque->retourneAleaSupport($_GET['genre']);
					} else {
						$id = $this->maVideotheque->retourneAleaSupport(rand(1,$this->maVideotheque->donneNbGenres()));
					}
					$page = '?vue=videotheque&action=fiche&id='.$id;
					$this->redirection($page,"",0);
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
		private function redirection($page,$message="",$content=1)
		{
			echo "</nav>
					<div class='container h-100'>
						<div class='row h-100 justify-content-center align-items-center'>
							<span class='text-white'>".$message."</span>
						</div>
					</div>
					<meta http-equiv='refresh' content='.$content.;index.php$page'>
					";
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
