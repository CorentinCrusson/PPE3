-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 01 oct. 2019 à 06:51
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `videoppe3`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `idClient` int(11) NOT NULL AUTO_INCREMENT,
  `nomClient` char(60) NOT NULL,
  `prenomClient` char(60) NOT NULL,
  `emailClient` char(32) NOT NULL,
  `dateAbonnementClient` date NOT NULL,
  `login` char(30) NOT NULL,
  `pwd` char(30) NOT NULL,
  `actif` int(11) NOT NULL,
  PRIMARY KEY (`idClient`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`idClient`, `nomClient`, `prenomClient`, `emailClient`, `dateAbonnementClient`, `login`, `pwd`, `actif`) VALUES
(1, 'Therriault', 'Corine', 'corine.therriault@gmail.com', '2018-01-01', 'Therriault', 'Therriault', 1),
(2, 'Drouin', 'Gabrielle', 'gabrielle.drouin@gmail.com', '2018-01-02', 'Drouin', 'Drouin', 1),
(3, 'Langelier', 'Alexis', 'alexis.langelier@gmail.com', '2018-01-01', 'Langelier', 'Langelier', 1),
(4, 'Pichette', 'Girard', 'girard.pichette@gmail.com', '2018-01-03', 'Pichette', 'Pichette', 1),
(5, 'Tardif', 'Henriette', 'henriette.tardif@laposte.net', '2018-02-01', 'Tardif', 'Tardif', 1),
(6, 'Gaudreau', 'Eric', 'eric.gaudreau@gmail.com', '2018-01-01', 'Gaudreau', 'Gaudreau', 1),
(7, 'Chouinard', 'Hilaire', 'hilaire.chouinard@laposte.net', '2018-01-01', 'Chouinard', 'Chouinard', 1),
(8, 'Leclair', 'Nazaire', 'nazaire.leclerc@laposte.net', '2018-01-01', 'Leclair', 'Leclair', 1),
(9, 'Leblanc', 'Louis', 'corentincrusson@gmail.com', '2018-02-01', 'Leblanc', 'Leblanc', 1),
(10, 'Vaillancour', 'Caroline', 'caroline.vaillancour@gmail.com', '2018-01-01', 'Vaillancour', 'Vaillancour', 1),
(42, 'fzef', 'fezf', 'fezff@gmail.com', '2019-09-18', 'admin', 'admin', 0),
(41, 'jij', 'iojioj', 'ijoij@gmail.com', '5454-06-04', 'root', 'root', 0),
(40, 'jij', 'iojioj', 'ijoij@gmail.com', '5454-06-04', 'root', 'root', 0),
(39, 'jij', 'iojioj', 'ijoij@gmail.com', '5454-06-04', 'root', 'root', 0),
(38, 'dzddz', 'dz', 'dz@gmail.com', '2564-05-04', 'root', 'root', 0),
(37, 'Corentin', 'Crusson', 'charlie@gmail.com', '2000-12-22', 'admin', 'admin', 0);

-- --------------------------------------------------------

--
-- Structure de la table `emprunt`
--

DROP TABLE IF EXISTS `emprunt`;
CREATE TABLE IF NOT EXISTS `emprunt` (
  `idEmprunt` int(11) NOT NULL AUTO_INCREMENT,
  `dateEmprunt` date NOT NULL,
  `idClient` int(11) NOT NULL,
  `idSupport` int(11) NOT NULL,
  PRIMARY KEY (`idEmprunt`),
  KEY `fk_emprunt_client` (`idClient`),
  KEY `fk_emprunt_support` (`idSupport`)
) ENGINE=MyISAM AUTO_INCREMENT=91 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `emprunt`
--

INSERT INTO `emprunt` (`idEmprunt`, `dateEmprunt`, `idClient`, `idSupport`) VALUES
(1, '2018-04-01', 1, 3),
(2, '2018-04-11', 1, 4),
(3, '2018-03-12', 1, 8),
(4, '2018-05-01', 1, 22),
(5, '2018-08-09', 1, 20),
(6, '2018-07-12', 1, 9),
(7, '2018-07-24', 1, 28),
(8, '2018-08-05', 1, 40),
(9, '2018-09-01', 1, 42),
(10, '2018-02-01', 2, 1),
(11, '2018-03-11', 2, 2),
(12, '2018-04-12', 2, 5),
(13, '2018-06-01', 2, 30),
(14, '2018-08-09', 2, 35),
(15, '2018-08-12', 2, 8),
(16, '2018-09-24', 2, 48),
(17, '2018-03-05', 2, 36),
(18, '2018-06-01', 2, 12),
(19, '2018-06-01', 3, 1),
(20, '2018-07-11', 3, 6),
(21, '2018-02-12', 3, 12),
(22, '2018-05-01', 3, 18),
(23, '2018-09-09', 3, 24),
(24, '2018-06-12', 3, 42),
(25, '2018-03-24', 3, 30),
(26, '2018-04-05', 3, 32),
(27, '2018-06-01', 3, 36),
(28, '2018-06-01', 4, 2),
(29, '2018-05-11', 4, 5),
(30, '2018-04-12', 4, 8),
(31, '2018-03-01', 4, 12),
(32, '2018-08-09', 4, 30),
(33, '2018-07-12', 4, 19),
(34, '2018-06-24', 4, 38),
(35, '2018-05-05', 4, 32),
(36, '2018-04-01', 4, 12),
(37, '2018-02-01', 5, 13),
(38, '2018-03-11', 5, 14),
(39, '2018-04-12', 5, 18),
(40, '2018-05-01', 5, 32),
(41, '2018-06-09', 5, 30),
(42, '2018-07-12', 5, 19),
(43, '2018-08-24', 5, 38),
(44, '2018-09-05', 5, 15),
(45, '2018-04-01', 5, 28),
(46, '2018-06-01', 6, 23),
(47, '2018-09-11', 6, 24),
(48, '2018-08-12', 6, 28),
(49, '2018-07-01', 6, 42),
(50, '2018-06-09', 6, 40),
(51, '2018-05-12', 6, 29),
(52, '2018-04-24', 6, 48),
(53, '2018-03-05', 6, 10),
(54, '2018-03-01', 6, 12),
(55, '2018-04-01', 7, 33),
(56, '2018-04-11', 7, 1),
(57, '2018-03-12', 7, 15),
(58, '2018-05-01', 7, 18),
(59, '2018-08-09', 7, 19),
(60, '2018-07-12', 7, 14),
(61, '2018-07-24', 7, 38),
(62, '2018-08-05', 7, 12),
(63, '2018-09-01', 7, 25),
(64, '2018-04-01', 8, 1),
(65, '2018-04-11', 8, 2),
(66, '2018-03-12', 8, 18),
(67, '2018-05-01', 8, 25),
(68, '2018-08-09', 8, 29),
(69, '2018-07-12', 8, 30),
(70, '2018-07-24', 8, 7),
(71, '2018-08-05', 8, 5),
(72, '2018-09-01', 8, 14),
(73, '2018-04-01', 9, 15),
(74, '2018-04-11', 9, 17),
(75, '2018-03-12', 9, 22),
(76, '2018-05-01', 9, 11),
(77, '2018-08-09', 9, 27),
(78, '2018-07-12', 9, 1),
(79, '2018-07-24', 9, 2),
(80, '2018-08-05', 9, 15),
(81, '2018-09-01', 9, 17),
(82, '2018-04-01', 10, 12),
(83, '2018-04-11', 10, 14),
(84, '2018-03-12', 10, 18),
(85, '2018-05-01', 10, 32),
(86, '2018-08-09', 10, 1),
(87, '2018-07-12', 10, 8),
(88, '2018-07-24', 10, 18),
(89, '2018-08-05', 10, 40),
(90, '2018-09-01', 10, 44);

-- --------------------------------------------------------

--
-- Structure de la table `episode`
--

DROP TABLE IF EXISTS `episode`;
CREATE TABLE IF NOT EXISTS `episode` (
  `idSerie` int(11) NOT NULL,
  `numSaison` int(11) NOT NULL,
  `numEpisode` int(11) NOT NULL,
  `titreEpisode` char(150) NOT NULL,
  `duree` int(11) NOT NULL,
  PRIMARY KEY (`idSerie`,`numSaison`,`numEpisode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `episode`
--

INSERT INTO `episode` (`idSerie`, `numSaison`, `numEpisode`, `titreEpisode`, `duree`) VALUES
(1, 1, 1, 'L hiver vient (Winter Is Coming)', 45),
(1, 1, 2, 'La Route royale (The Kingsroad)', 45),
(1, 1, 3, 'Lord Snow (Lord Snow)', 45),
(1, 1, 4, 'Infirmes, B&acirc;tards et Choses bris&eacute;es (Cripples, Bastards and Broken Things)', 45),
(1, 1, 5, 'Le Loup et le Lion (The Wolf and the Lion)', 45),
(1, 1, 6, 'Une couronne dor&eacute;e (A Golden Crown)', 45),
(1, 1, 7, 'Gagner ou mourir (You Win or You Die)', 45),
(1, 1, 8, 'La Pointe de l &eacute;p&eacute;e (The Pointy End)', 45),
(1, 1, 9, 'Baelor (Baelor)', 45),
(1, 1, 10, 'De feu et de sang (Fire and Blood)', 45),
(1, 2, 1, 'Le Nord se souvient (The North Remembers)', 45),
(1, 2, 2, 'Les Contr&eacute;es nocturnes (The Night Lands)', 45),
(1, 2, 3, 'Ce qui est mort ne saurait mourir (What Is Dead May Never Die)', 45),
(1, 2, 4, 'Le Jardin des os (Garden of Bones)', 45),
(1, 2, 5, 'Le Fant&ocirc;me d Harrenhal (The Ghost of Harrenhal)', 45),
(1, 2, 6, 'Les Anciens et les Nouveaux Dieux (The Old Gods and the New)', 45),
(1, 2, 7, 'Un homme sans honneur (A Man Without Honor)', 45),
(1, 2, 8, 'Le Prince de Winterfell (The Prince of Winterfell)', 45),
(1, 2, 9, 'La N&eacute;ra (Blackwater)', 45),
(1, 2, 10, 'Valar Morghulis (Valar Morghulis)', 45),
(1, 3, 1, 'Valar Dohaeris (Valar Dohaeris)', 45),
(1, 3, 2, 'Noires ailes, noires nouvelles (Dark Wings, Dark Words)', 45),
(1, 3, 3, 'Les Immacul&eacute;s (Walk of Punishment)', 45),
(1, 3, 4, 'Voici que son tour de garde est fini (And Now His Watch Is Ended)', 45),
(1, 3, 5, 'Bais&eacute;e par le feu (Kissed by Fire)', 45),
(1, 3, 6, 'L Ascension (The Climb)', 45),
(1, 3, 7, 'L Ours et la Belle (The Bear and the Maiden Fair)', 45),
(1, 3, 8, 'Les Pu&icirc;n&eacute;s (Second Sons)', 45),
(1, 3, 9, 'Les Pluies de Castamere (The Rains of Castamere)', 45),
(1, 3, 10, 'Mhysa (Mhysa)', 45),
(1, 4, 1, 'Deux &eacute;p&eacute;es (Two Swords)', 45),
(1, 4, 2, 'Le Lion et la Rose (The Lion and the Rose)', 45),
(1, 4, 3, 'Briseuse de cha&icirc;nes (Breaker of Chains)', 45),
(1, 4, 4, 'F&eacute;ale (Oathkeeper)', 45),
(1, 4, 5, 'Premier du nom (First of His Name)', 45),
(1, 4, 6, 'Les Lois des dieux et des hommes (The Laws of Gods and Men)', 45),
(1, 4, 7, 'L Oiseau moqueur (Mockingbird)', 45),
(1, 4, 8, 'La Montagne et la Vip&egrave;re (The Mountain and the Viper)', 45),
(1, 4, 9, 'Les Veilleurs au rempart (The Watchers on the Wall)', 45),
(1, 4, 10, 'Les Enfants (The Children)', 45),
(1, 5, 1, 'Les Guerres &agrave; venir (The Wars to Come)', 45),
(1, 5, 2, 'La Demeure du Noir et du Blanc (The House of Black and White)', 45),
(1, 5, 3, 'Le Poids du nom (High Sparrow)', 45),
(1, 5, 4, 'Histoires familiales (Sons of the Harpy)', 45),
(1, 5, 5, 'Tuer l enfant pour laisser na&icirc;tre l homme (Kill the Boy)', 45),
(1, 5, 6, 'Insoumis, Invaincus, Intacts (Unbowed, Unbent, Unbroken)', 45),
(1, 5, 7, 'Le Cadeau (The Gift)', 45),
(1, 5, 8, 'Durlieu (Hardhome)', 45),
(1, 5, 9, 'La Danse des dragons (The Dance of Dragons)', 45),
(1, 5, 10, 'La Mis&eacute;ricorde de la m&egrave;re (Mother s Mercy)', 45),
(1, 6, 1, 'La Femme rouge (The Red Woman)', 45),
(1, 6, 2, 'La Maison (Home)', 45),
(1, 6, 3, 'Le Briseur de serment (Oathbreaker)', 45),
(1, 6, 4, 'Le Livre de l &eacute;tranger (Book of the Stranger)', 45),
(1, 6, 5, 'La Porte (The Door)', 45),
(1, 6, 6, 'De mon sang (Blood of My Blood)', 45),
(1, 6, 7, 'L Homme bris&eacute; (The Broken Man)', 45),
(1, 6, 8, 'Personne (No One)', 45),
(1, 6, 9, 'La Bataille des b&acirc;tards (The Battle of the Bastards)', 45),
(1, 6, 10, 'Les Vents de l hiver (The Winds of Winter)', 45),
(1, 7, 1, 'Peyredragon (Dragonstone)', 45),
(1, 7, 2, 'Du Typhon (Stormborn)', 45),
(1, 7, 3, 'La Justice de la reine (The Queen s Justice)', 45),
(1, 7, 4, 'Les Butins de la guerre (The Spoils of War)', 45),
(1, 7, 5, 'Fort-Levant (Eastwatch)', 45),
(1, 7, 6, 'Au-del&agrave; du Mur (Beyond the Wall)', 45),
(1, 7, 7, 'Le Dragon et le Loup (The Dragon and the Wolf)', 45),
(2, 1, 1, 'Le Naufrag&eacute; / Le Retour du naufrag&eacute; (Pilot)', 50),
(2, 1, 2, 'La Promesse / D entre les morts (Honor Thy Father)', 50),
(2, 1, 3, 'Tireurs solitaires / Ami ou Ennemi . (Lone Gunmen)', 50),
(2, 1, 4, 'Un homme innocent (An Innocent Man)', 50),
(2, 1, 5, 'Le Second Archer / Dommages collat&eacute;raux (Damaged)', 50),
(2, 1, 6, 'H&eacute;ritages (Legacies)', 50),
(2, 1, 7, 'Communion d &acirc;mes / Femme fatale (Muse of Fire)', 50),
(2, 1, 8, 'Vendetta (Vendetta)', 50),
(2, 1, 9, 'Pas de tr&ecircve pendant No&euml;l / Une ombre sur la ville (Year s End)', 50),
(2, 1, 10, 'Br&ucirclures / &agrave feu et &agrave; sang (Burned)', 50),
(2, 1, 11, 'Confiance et Trahison / M&eacute;fiance aveugle (Trust But Verify)', 50),
(2, 1, 12, 'Vertigo (Vertigo)', 50),
(2, 1, 13, 'Trahison / Abus de confiance (Betrayal)', 50),
(2, 1, 14, 'L Odyss&eacute;e / L Art de la guerre (The Odyssey)', 50),
(2, 1, 15, 'Le Dodger / Insaisissable (Dodger)', 50),
(2, 1, 16, 'Dette de sang / Les Liens du sang (Dead to Rights)', 50),
(2, 1, 17, 'L Instinct de vengeance (The Huntress Returns)', 50),
(2, 1, 18, 'Le Sauveur (Salvation)', 50),
(2, 1, 19, 'Travail inachev&eacute; (Unfinished Business)', 50),
(2, 1, 20, 'Effraction / Un retour inattendu (Home Invasion)', 50),
(2, 1, 21, 'Mensonges et Manigances / Le Programme (The Undertaking)', 50),
(2, 1, 22, 'Cr&eacute;puscule / Menace sur la ville (Darkness on the Edge of Town)', 50),
(2, 1, 23, 'Sacrifice / L Affrontement (Sacrifice)', 50),
(2, 2, 1, 'Le combat  / Les Justiciers (City of Heroes)', 50),
(2, 2, 2, 'D&eacute;mons int&eacute;rieurs / Crise d identit&eacute; (Identity)', 50),
(2, 2, 3, 'L union fait la force / Poup&eacute;es de cire (Broken Dolls)', 50),
(2, 2, 4, 'Traverser les &eacute;preuves / L &Eacute;preuve (Crucible)', 50),
(2, 2, 5, 'La Ligue des assassins (League of Assassins)', 50),
(2, 2, 6, 'Pacte avec l ennemi (Keep Your Enemies Closer)', 50),
(2, 2, 7, 'Le Proc&egrave;s (State v. Queen)', 50),
(2, 2, 8, 'Le Scientifique (The Scientist)', 50),
(2, 2, 9, 'Du poison dans les veines (Three Ghosts)', 50),
(2, 2, 10, 'Bombe &agrave; retardement (Blast Radius)', 50),
(2, 2, 11, 'Le masque tombe / Le masque est tomb&eacute; (Blind Spot)', 50),
(2, 2, 12, '&Agrave; la recherche du g&eacute;n&eacute;rateur / Tremblements (Tremors)', 50),
(2, 2, 13, 'Vivre ou mourir / L H&eacute;riti&egrave;re du d&eacute;mon (Heir to the Demon)', 50),
(2, 2, 14, 'L Heure de la mort / Le Roi du temps (Time of Death)', 50),
(2, 2, 15, 'La Promesse (The Promise)', 50),
(2, 2, 16, 'L Escadron suicide (Suicide Squad)', 50),
(2, 2, 17, 'Les Anges de la nuit / Oiseaux de proie (Birds of Prey)', 50),
(2, 2, 18, 'R&eacute;v&eacute;lations / Diversion (Deathstroke)', 50),
(2, 2, 19, '&agrave; d&eacute;couvert / Le Mal dans le sang (The Man Under the Hood)', 50),
(2, 2, 20, 'Journ&eacute;e noire (Seeing Red)', 50),
(2, 2, 21, 'Le Calme avant la temp&ecirc;te (City of Blood)', 50),
(2, 2, 22, '&Eacute;tat de si&egrave;ge (Streets of Fire)', 50),
(2, 2, 23, 'L Assaut final (Unthinkable)', 50),
(2, 3, 1, 'Le Calme avant la temp&ecircte / Retour en force (The Calm)', 50),
(2, 3, 2, 'Sara / L Adieu (Sara)', 50),
(2, 3, 3, 'Corto Maltese / L ile de Corto Maltese (Corto Maltese)', 50),
(2, 3, 4, 'Le Magicien (The Magician)', 50),
(2, 3, 5, 'Le Pass&eacute; secret de Felicity Smoak (The Secret Origin of Felicity Smoak)', 50),
(2, 3, 6, 'Coupable / Un nouvel Arsenal (Guilty)', 50),
(2, 3, 7, 'Cupidon / Bourreau des cœurs (Draw Back Your Bow)', 50),
(2, 3, 8, 'Le Courage et l Audace / L etoffe des h&eacute;ros (The Brave and the Bold)', 50),
(2, 3, 9, 'L Ascension (The Climb)', 50),
(2, 3, 10, 'Abandonn&eacute; / La D&eacute;b&acirc;cle (Left Behind)', 50),
(2, 3, 11, 'Le R&egrave;gne de Brick / La Nuit des justiciers (Midnight City)', 50),
(2, 3, 12, 'R&eacute;sistance / Guerre totale (Uprising)', 50),
(2, 3, 13, 'D&eacute;doublement / Lutte fratricide (Canaries)', 50),
(2, 3, 14, 'R&eacute;surgence / &agrave; l origine (The Return)', 50),
(2, 3, 15, 'Nanda Parbat / Bienvenue &agrave; Nanda Parbat (Nanda Parbat)', 50),
(2, 3, 16, 'La Proposition / L Offre (The Offer)', 50),
(2, 3, 17, 'Tendances suicidaires / D&eacute;masqu&eacute;s (Suicidal Tendencies)', 50),
(2, 3, 18, 'Ennemi public / L Homme &agrave; abattre (Public Enemy)', 50),
(2, 3, 19, 'Extrêmes Mesures / Alliance n&eacute;cessaire (Broken Arrow)', 50),
(2, 3, 20, 'Sans retour / M&eacute;connaissable (The Fallen)', 50),
(2, 3, 21, 'Al Sah-him / Quelqu un d autre (Al Sah-him)', 50),
(2, 3, 22, 'L &eacute;ep&eacute;e / Quelque chose d autre (This Is Your Sword)', 50),
(2, 3, 23, 'Je m appelle Oliver Queen / Je suis Oliver Queen (My Name Is Oliver Queen)', 50),
(2, 4, 1, 'Une lumi&egrave;re dans les t&eacute;n&egrave;bres (Green Arrow)', 50),
(2, 4, 2, 'Amiti&eacute contrari&eacutee (The Candidate)', 50),
(2, 4, 3, 'Nouveaux Instincts (Restoration)', 50),
(2, 4, 4, 'Au service de la ville (Beyond Redemption)', 50),
(2, 4, 5, '&Agrave; la recherche de l &acirc;me perdue (Haunted)', 50),
(2, 4, 6, 'Un probl&egrave;me de taille (Lost Souls)', 50),
(2, 4, 7, 'Sauver la paix (Brotherhood)', 50),
(2, 4, 8, 'Les L&eacute;gendes d hier (Legends of Yesterday )', 50),
(2, 4, 9, 'Pousser &agrave; bout (Dark Waters)', 50),
(2, 4, 10, 'Pour Felicity (Blood Debts)', 50),
(2, 4, 11, 'Les Cons&eacute;quences du pass&eacute; (A.W.O.L.)', 50),
(2, 4, 12, 'Trop lourd &agrave; porter (Unchained)', 50),
(2, 4, 13, 'Le Combat des maîtres (Sins of the Father)', 50),
(2, 4, 14, 'Sale Temps pour un justicier (Code of Silence)', 50),
(2, 4, 15, 'Le Kidnapping (Taken)', 50),
(2, 4, 16, 'Victimes de l amour (Broken Hearts)', 50),
(2, 4, 17, 'Lueur d espoir (Beacon of Hope)', 50),
(2, 4, 18, 'Derni&egrave;re Mission (Eleven-Fifty-Nine)', 50),
(2, 4, 19, 'Le Chant du Canary (Canary Cry)', 50),
(2, 4, 20, 'La Phase finale (Genesis)', 50),
(2, 4, 21, 'Avant la fin du monde (Monument Point)', 50),
(2, 4, 22, 'Le D&eacute;luge (Lost in the Flood)', 50),
(2, 4, 23, 'Rupture (Schism)', 50),
(2, 5, 1, 'H&eacute;ritage (Legacy)', 50),
(2, 5, 2, 'Nouvelles Recrues (The Recruits)', 50),
(2, 5, 3, 'Une question de confiance (A Matter of Trust)', 50),
(2, 5, 4, 'P&eacute;nitence (Penance)', 50),
(2, 5, 5, 'La Cible humaine (Human Target)', 50),
(2, 5, 6, 'Tout commence (So It Begins)', 50),
(2, 5, 7, 'Vigilante (Vigilante)', 50),
(2, 5, 8, 'R&ecirc;ve ou R&eacute;alit&eacute; (Invasion!)', 50),
(2, 5, 9, 'Une trace dans l histoire (What We Leave Behind)', 50),
(2, 5, 10, 'Qui es-tu . (Who Are You.)', 50),
(2, 5, 11, 'Seconde Chance (Second Chances)', 50),
(2, 5, 12, 'Bratva (Bratva)', 50),
(2, 5, 13, 'L Ombre des armes (Spectre of the Gun)', 50),
(2, 5, 14, 'Le Purificateur (The Sin-Eater)', 50),
(2, 5, 15, 'Combattre le mal par le mal (Fighting Fire with Fire)', 50),
(2, 5, 16, '&Eacute;chec et Mat (Checkmate)', 50),
(2, 5, 17, 'Kapiushon (Kapiushon)', 50),
(2, 5, 18, 'Sous protection (Disbanded)', 50),
(2, 5, 19, 'Liaisons dangereuses (Dangerous Liaisons)', 50),
(2, 5, 20, 'Pi&egrave;ges (Underneath)', 50),
(2, 5, 21, 'En L honneur de nos p&egrave;res (Honor Thy Fathers)', 50),
(2, 5, 22, 'Disparus (Missing)', 50),
(2, 5, 23, 'Lian Yu (Lian Yu)', 50),
(2, 6, 1, 'Les Cons&eacute;quences (Fallout)', 50),
(2, 6, 2, 'Hommage (Tribute)', 50),
(2, 6, 3, 'Parent proche (Next of Kin)', 50),
(2, 6, 4, 'Inversion (Reversal)', 50),
(2, 6, 5, 'Deathstroke  le retour (Deathstroke Returns)', 50),
(2, 6, 6, 'Promesses tenues (Promises Kept)', 50),
(2, 6, 7, 'Thanksgiving (Thanksgiving)', 50),
(2, 6, 8, 'Crise sur Terre-X (Crisis on Earth-X)', 50),
(2, 6, 9, 'Divergences (Irreconcilable Differences)', 50),
(2, 6, 10, 'Divis&eacute;s (Divided)', 50),
(2, 6, 11, 'La Chute (We Fall)', 50),
(2, 6, 12, 'Pour rien (All for Nothing)', 50),
(2, 6, 13, 'La Ruse du diable (The Devil s Greatest Trick)', 50),
(2, 6, 14, 'Le Clash (Collision Course)', 50),
(2, 6, 15, 'Double (Doppelganger)', 50),
(2, 6, 16, 'La Ligue des assassins (The Thanatos Guild)', 50),
(2, 6, 17, 'Fr&egrave;res d armes (Brothers in Arms)', 50),
(2, 6, 18, 'Les Fondamentaux (Fundamentals)', 50),
(2, 6, 19, 'Le Dragon (The Dragon)', 50),
(2, 6, 20, 'Changer de camp (Shifting Allegiances)', 50),
(2, 6, 21, 'Dossier no 11-19-41-73 (Docket No. 11-19-41-73)', 50),
(2, 6, 22, 'Les liens qui unissent (The Ties That Bind)', 50),
(2, 6, 23, 'Perp&eacute;tuit&eacute; (Life Sentence)', 50);

-- --------------------------------------------------------

--
-- Structure de la table `film`
--

DROP TABLE IF EXISTS `film`;
CREATE TABLE IF NOT EXISTS `film` (
  `idFilm` int(11) NOT NULL AUTO_INCREMENT,
  `duree` char(20) NOT NULL,
  `idSupport` int(11) DEFAULT NULL,
  PRIMARY KEY (`idFilm`),
  KEY `fk_support` (`idSupport`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `film`
--

INSERT INTO `film` (`idFilm`, `duree`, `idSupport`) VALUES
(1, '1 heure et 43 min.', 3),
(2, '1 heure et 37 min.', 4),
(3, '1 heure et 40 min.', 5),
(4, '1 heure et 51 min.', 6),
(5, '1 heure et 32 min.', 7),
(6, '1 heure et 28 min.', 8),
(7, '1 heure et 48 min.', 9),
(8, '1 heure et 29 min.', 10),
(9, '1 heure et 16 min.', 11),
(10, '1 heure et 30 min.', 12),
(11, '1 heure et 48 min.', 13),
(12, '1 heure et 44 min.', 14),
(13, '1 heure et 37 min.', 15),
(14, '1 heure et 44 min.', 16),
(15, '1 heure et 30 min.', 17),
(16, '1 heure et 27 min.', 18),
(17, '1 heure et 36 min.', 19),
(18, '1 heure et 42 min.', 20),
(19, '1 heure et 34 min.', 21),
(20, '1 heure et 32 min.', 22),
(21, '1 heure et 42 min.', 23),
(22, '1 heure et 53 min.', 24),
(23, '1 heure et 23 min.', 25),
(24, '1 heure et 46 min.', 26),
(25, '1 heure et 26 min.', 27),
(26, '1 heure et 29 min.', 28),
(27, '2 heures et 1 min.', 29),
(28, '1 heure et 47 min.', 30),
(29, '1 heure et 40 min.', 31),
(30, '2 heures et 16 min.', 32),
(31, '1 heure et 43 min.', 33),
(32, '1 heure et 43 min.', 34),
(33, '1 heure et 52 min.', 35),
(34, '1 heure et 42 min.', 36),
(35, '1 heure et 22 min.', 37),
(36, '1 heure et 39 min.', 38),
(37, '1 heure et 44 min.', 39),
(38, '1 heure et 57 min.', 40),
(39, '1 heure et 34 min.', 41),
(40, '1 heure et 42 min.', 42),
(41, '1 heure et 36 min.', 43),
(42, '2 heures et 6 min.', 44),
(43, '2 heures', 45),
(44, '1 heure et 13 min.', 46),
(45, '1 heure et 38 min.', 47),
(46, '1 heure et 15 min.', 48),
(47, '1 heure et 46 min.', 49),
(48, '1 heure et 41 min.', 50),
(49, '1 heure et 44 min.', 51),
(50, '1 heure et 41 min.', 52),
(51, '1 heure et 37 min.', 53),
(52, '1 heure et 53 min.', 54),
(53, '1 heure et 35 min.', 55),
(54, '1 heure et 14 min.', 56);

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

DROP TABLE IF EXISTS `genre`;
CREATE TABLE IF NOT EXISTS `genre` (
  `idGenre` int(11) NOT NULL AUTO_INCREMENT,
  `libelleGenre` char(32) NOT NULL,
  PRIMARY KEY (`idGenre`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `genre`
--

INSERT INTO `genre` (`idGenre`, `libelleGenre`) VALUES
(1, 'Drame Action'),
(2, 'Fantastique'),
(3, 'Aventure'),
(4, 'Policier'),
(5, 'Comedie'),
(6, 'Science-Fiction'),
(7, 'Drame'),
(8, 'Guerre'),
(9, 'Horreur'),
(10, 'Bibliographie');

-- --------------------------------------------------------

--
-- Structure de la table `saison`
--

DROP TABLE IF EXISTS `saison`;
CREATE TABLE IF NOT EXISTS `saison` (
  `idSerie` int(11) NOT NULL,
  `numSaison` int(11) NOT NULL,
  `anneeSaison` int(11) NOT NULL,
  `nbrEpisodesPrevus` int(11) NOT NULL,
  PRIMARY KEY (`idSerie`,`numSaison`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `saison`
--

INSERT INTO `saison` (`idSerie`, `numSaison`, `anneeSaison`, `nbrEpisodesPrevus`) VALUES
(1, 1, 2011, 10),
(1, 2, 2012, 10),
(1, 3, 2013, 10),
(1, 4, 2014, 10),
(1, 5, 2015, 10),
(1, 6, 2016, 10),
(1, 7, 2017, 7),
(1, 8, 2018, 0),
(2, 1, 2013, 23),
(2, 2, 2014, 23),
(2, 3, 2015, 23),
(2, 4, 2016, 23),
(2, 5, 2017, 23),
(2, 6, 2018, 23);

-- --------------------------------------------------------

--
-- Structure de la table `serie`
--

DROP TABLE IF EXISTS `serie`;
CREATE TABLE IF NOT EXISTS `serie` (
  `idSerie` int(11) NOT NULL,
  `resumeSerie` char(250) NOT NULL,
  `idSupport` int(11) DEFAULT NULL,
  PRIMARY KEY (`idSerie`),
  KEY `fk_support` (`idSupport`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `serie`
--

INSERT INTO `serie` (`idSerie`, `resumeSerie`, `idSupport`) VALUES
(1, 'La s&eacute;rie se d&eacute;roule dans un univers fictif et narre les luttes de pouvoir des familles nobles pour le contr&ocircle; du tr&ocirc;ne de fer.', 1),
(2, 'Un jeune milliardaire et playboy Oliver Queen devient un justicier dans la ville de Starling…', 2);

-- --------------------------------------------------------

--
-- Structure de la table `support`
--

DROP TABLE IF EXISTS `support`;
CREATE TABLE IF NOT EXISTS `support` (
  `idSupport` int(11) NOT NULL AUTO_INCREMENT,
  `titreSupport` char(150) NOT NULL,
  `realisateur` char(60) NOT NULL,
  `image` char(30) NOT NULL,
  `idGenre` int(11) NOT NULL,
  PRIMARY KEY (`idSupport`),
  KEY `fk_support_genre` (`idGenre`)
) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `support`
--

INSERT INTO `support` (`idSupport`, `titreSupport`, `realisateur`, `image`, `idGenre`) VALUES
(1, 'Game of Strone', 'George R. R. Martin.', '1.jpg', 2),
(2, 'Arrow', 'Andrew Kreisberg, Greg Berlanti et Marc Guggenheim', '2.jpg', 2),
(3, 'Tigre accroupi dragon cach&eacute;: &eacute;p&eacute;e du destin', 'Yuen Woo-ping', '3.jpg', 3),
(4, 'Les fondements de la prise en charge', 'Jonathan Evison	', '4.jpg', 5),
(5, 'Renaissance', 'Karl Mueller	', '5.jpg', 4),
(6, 'Tallulah', 'Sian Heder', '6.jpg', 5),
(7, 'bisous bisous', 'Christopher Louie', '7.jpg', 7),
(8, 'ARQ', 'Tony Elliott	', '8.jpg', 6),
(9, 'Le si&egrave;ge de Jadotville', 'Richie Smyth', '9.jpg', 8),
(10, 'Je suis la jolie chose qui vit à la maison', 'Osgood Perkins', '10.jpg', 9),
(11, '7 a&ntil;deos', 'Roger Gual', '11.jpg', 7),
(12, 'Piti&eacute;', 'Chris Sparling', '12.jpg', 4),
(13, 'Spectral', 'Nic Mathieu', '13.jpg', 6),
(14, 'Barry', 'Vikram Gandhi', '14.jpg', 10),
(15, 'Coin Heist', 'Emily Hagins', '15.jpg', 7),
(16, 'Clinique', 'Alistair Legrand', '16.jpg', 4),
(17, 'iBoy', 'Kevin Brooks', '17.jpg', 6),
(18, 'R&ecirc;ves Imp&eacute;riaux', 'Malik Vitthal', '18.jpg', 7),
(19, 'Je ne me sens plus chez moi dans ce monde', 'Macon Blair', '19.jpg', 7),
(20, 'Sables br&ucirc;lants', 'Gerard McMurray', '20.jpg', 7),
(21, 'Deidra & Laney Rob a Train', 'Sydney Freeland', '21.jpg', 7),
(22, 'La femme la plus d&eacute;test&eacute;e en Am&eacute;rique', 'Tommy O Haver', '22.jpg', 10),
(23, 'La d&eacute;couverte', 'Charlie McDowell', '23.jpg', 2),
(24, 'Ch&acirc;teau de sable', 'Fernando Coimbra', '24.jpg', 8),
(25, 'Tramps', 'Adam Leon', '25.jpg', 5),
(26, 'Faire des reproches!', 'Hiroyuki Seshita', '26.jpg', 6),
(27, 'Lac miroitant', 'Oren Uziel', '27.jpg', 4),
(28, 'Tu m as eu', 'Brent Bonacorso', '28.jpg', 4),
(29, 'Okja', 'Bong Joon-ho', '29.jpg', 7),
(30, 'Jusqu &agrave; l os', 'Marti Noxon', '30.jpg', 8),
(31, 'Menace de mort', 'Adam Wingard', '31.jpg', 9),
(32, 'D abord, ils ont tu&eacute; mon p&egrave;re', 'Angelina Jolie', '32.jpg', 7),
(33, 'Gerald s Game', 'Mike Flanagan', '33.jpg', 9),
(34, 'Nos &acirc;mes la nuit', 'Ritesh Batra', '34.jpg', 5),
(35, 'Les histoires de Meyerowitz (nouvelles et s&eacute;lectionn&eacute;es)', 'Noah Baumbach', '35.jpg', 5),
(36, '1922', 'Zak Hilditch', '36.jpg', 9),
(37, 'Wheelman', 'Jeremy Rush', '37.jpg', 1),
(38, 'Le tueur', 'Marcelo Galvão', '38.jpg', 5),
(39, 'H&eacute;ritage de No&euml;l', 'Ernie Barbarash', '39.jpg', 7),
(40, 'Brillant', 'David Ayer', '40.jpg', 6),
(41, 'La journ&eacute;e portes ouvertes', 'Matt Angel', '41.jpg', 9),
(42, 'Le paradoxe de Cloverfield', 'Julius Onah', '42.jpg', 6),
(43, 'Irrempla&ccedil;able Vous', 'Stephanie Laing', '43.jpg', 7),
(44, 'Muet', 'Duncan Jones', '44.jpg', 6),
(45, 'L &eacute;tranger', 'Martin Zandvliet', '45.jpg', 7),
(46, 'Paradoxe', 'Daryl Hannah', '46.jpg', 2),
(47, 'Roxanne Roxanne', 'Michael Larnell', '47.jpg', 10),
(48, '6 ballons', 'Marja-Lewis Ryan', '48.jpg', 7),
(49, 'Viens dimanche', 'Joshua Marston', '49.jpg', 10),
(50, 'parfois', 'Priyadarshan', '50.jpg', 7),
(51, 'Cargaison', 'Ramke', '51.jpg', 9),
(52, 'Calibre', 'Matt Palmer', '56.jpg', 4),
(53, 'TAU', 'Federico D Alessandro', '53.jpg', 4),
(54, 'Comment &ccedil;a finit', 'David M. Rosenthal', '54.jpg', 1),
(55, 'Extinction', 'Ben Young', '55.jpg', 6),
(56, 'Saveurs de la jeunesse: version internationale', 'Li Haoling', '56.jpg', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
