-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 10 mai 2021 à 20:14
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `formation`
--
CREATE DATABASE IF NOT EXISTS `formation` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `formation`;

-- --------------------------------------------------------

--
-- Structure de la table `contenu`
--

DROP TABLE IF EXISTS `contenu`;
CREATE TABLE IF NOT EXISTS `contenu` (
  `id_contenu` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `id_cours` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id_contenu`),
  KEY `fk_contenu_cours` (`id_cours`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `contenu`
--

INSERT INTO `contenu` (`id_contenu`, `titre`, `id_cours`, `description`) VALUES
(30, 'Notion de OS', 'Int_1', ''),
(31, 'test', 'Int_1', ''),
(32, 'rien', 'Int_1', ''),
(33, 'Notion OS', 'Int_1', 'Cours complet sur le fonctionnement du systeme d\'exploitation'),
(34, 'Computer science', 'Eng_2', 'informatique in french means computer science in english'),
(35, 'Cours video', 'Eng_2', ''),
(36, 'Last exam', 'Eng_2', 'liste des examens des annÃ©es precedentes'),
(37, 'Notion de base', 'Hac_5', 'Fichier powerpoint qui resume les notions de bases du hacking'),
(38, 'Hacker', 'Hac_5', 'hacker vs white hat'),
(39, 'white hat', 'Hac_5', 'les bons hacker'),
(40, 'Travel', 'Eng_3', ''),
(41, 'Roadtrip', 'Eng_3', 'Discover the world'),
(42, 'BDD', 'Int_1', 'Modification en cours');

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

DROP TABLE IF EXISTS `cours`;
CREATE TABLE IF NOT EXISTS `cours` (
  `id_cours` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nom_cours` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `niveau` int(11) NOT NULL,
  `admin` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id_cours`),
  KEY `fk_enseignant_cours` (`admin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `cours`
--

INSERT INTO `cours` (`id_cours`, `nom_cours`, `niveau`, `admin`, `description`) VALUES
('Eng_2', 'English', 0, 'ens_2', 'english course level 0			'),
('Eng_3', 'English L1', 1, 'ens_2', 'english course level 1			'),
('Eng_4', 'English L2', 2, 'ens_2', 'english of business			'),
('Hac_5', 'Hacking', 1, 'ens_1', 'Un cours Ã  la securitÃ© informatique			'),
('Int_1', 'Introduction a la programmation', 0, 'ens_1', 'linux			');

-- --------------------------------------------------------

--
-- Structure de la table `enseignant`
--

DROP TABLE IF EXISTS `enseignant`;
CREATE TABLE IF NOT EXISTS `enseignant` (
  `id_enseignant` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `nom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mail` text COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `niveau` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_enseignant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `enseignant`
--

INSERT INTO `enseignant` (`id_enseignant`, `nom`, `prenom`, `mail`, `password`, `niveau`) VALUES
('ens_1', 'Dilane', 'Cannon', 'dilanecannon@gmail.com', '1234', 0),
('ens_2', 'Mamy', 'Marie', 'mariemamy@gmail.com', '12345678', 0);

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

DROP TABLE IF EXISTS `etudiant`;
CREATE TABLE IF NOT EXISTS `etudiant` (
  `id_etudiant` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `nom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mail` text COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `niveau` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_etudiant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`id_etudiant`, `nom`, `prenom`, `mail`, `password`, `niveau`) VALUES
('etu_1', 'INGETA', 'DinaÃ«l', 'idinael.797@gmail.com', '12345678', 1);

-- --------------------------------------------------------

--
-- Structure de la table `etudiant_cours`
--

DROP TABLE IF EXISTS `etudiant_cours`;
CREATE TABLE IF NOT EXISTS `etudiant_cours` (
  `id_etudiant` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `id_cours` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_etudiant`,`id_cours`),
  KEY `id_cours` (`id_cours`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `etudiant_cours`
--

INSERT INTO `etudiant_cours` (`id_etudiant`, `id_cours`) VALUES
('etu_1', 'Int_1');

-- --------------------------------------------------------

--
-- Structure de la table `fichier`
--

DROP TABLE IF EXISTS `fichier`;
CREATE TABLE IF NOT EXISTS `fichier` (
  `id_fichier` int(11) NOT NULL AUTO_INCREMENT,
  `format` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `chemin` text COLLATE utf8_unicode_ci NOT NULL,
  `id_contenu` int(11) DEFAULT NULL,
  `nom_fichier` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_fichier`),
  KEY `id_contenu` (`id_contenu`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `fichier`
--

INSERT INTO `fichier` (`id_fichier`, `format`, `chemin`, `id_contenu`, `nom_fichier`) VALUES
(23, 'jpg', '../database/Fichiers/topologie.JPG', 30, 'topologie.JPG'),
(24, 'jpg', '../database/Fichiers/test parfeu.JPG', 31, 'test parfeu.JPG'),
(25, 'jpg', '../database/Fichiers/test parfeu.JPG', 31, 'test parfeu.JPG'),
(26, 'jpg', '../database/Fichiers/parfeu.JPG', 31, 'parfeu.JPG'),
(27, 'jpg', '../database/Fichiers/postgres entrepris.JPG', 31, 'postgres entrepris.JPG'),
(28, 'jpg', '../database/Fichiers/test parfeu.JPG', 31, 'test parfeu.JPG'),
(29, 'docx', '../database/Fichiers/fiche S&R.docx', 32, 'fiche S&R.docx'),
(30, 'pdf', '../database/Fichiers/fiche S&R.pdf', 30, 'fiche S&R.pdf'),
(34, 'txt', '../database/Fichiers/shell.txt', 33, 'shell.txt'),
(35, 'pdf', '../database/Fichiers/CoursSR3.pdf', 31, 'CoursSR3.pdf'),
(36, 'mp4', '../database/Fichiers/production ID_3775278.mp4', 31, 'production ID_3775278.mp4'),
(37, 'mp3', '../database/Fichiers/Touching Moment - Wayne Jones.mp3', 32, 'Touching Moment - Wayne Jones.mp3'),
(38, 'png', '../database/Fichiers/tablette.png', 34, 'tablette.png'),
(39, 'mp4', '../database/Fichiers/production ID_4340782.mp4', 35, 'production ID_4340782.mp4'),
(40, 'pdf', '../database/Fichiers/exam05-2016.pdf', 36, 'exam05-2016.pdf'),
(41, 'pdf', '../database/Fichiers/exam05-2018.pdf', 36, 'exam05-2018.pdf'),
(42, 'pdf', '../database/Fichiers/exam06-2015.pdf', 36, 'exam06-2015.pdf'),
(43, 'zip', '../database/Fichiers/Partie_1.zip', 36, 'Partie_1.zip'),
(44, 'pptx', '../database/Fichiers/Groupe SEB_Offre_ALTERNANCE_Technicien.ne Outillage et BE 1.pptx', 37, 'Groupe SEB_Offre_ALTERNANCE_Technicien.ne Outillage et BE 1.pptx'),
(45, 'jpg', '../database/Fichiers/hacker.jpg', 38, 'hacker.jpg'),
(46, 'png', '../database/Fichiers/tablette.png', 38, 'tablette.png'),
(47, 'png', '../database/Fichiers/tablette.png', 38, 'tablette.png'),
(48, 'png', '../database/Fichiers/tablette.png', 39, 'tablette.png'),
(49, 'png', '../database/Fichiers/angel-1273986.png', 40, 'angel-1273986.png'),
(50, 'mp4', '../database/Fichiers/production ID_4762901.mp4', 41, 'production ID_4762901.mp4'),
(51, 'mp4', '../database/Fichiers/production ID_3775278.mp4', 41, 'production ID_3775278.mp4'),
(52, 'mp4', '../database/Fichiers/video.mp4', 41, 'video.mp4'),
(53, 'zip', '../database/Fichiers/Fwd Offre dalternance - Forum des Indsutries.zip', 42, 'Fwd Offre dalternance - Forum des Indsutries.zip'),
(54, 'pdf', '../database/Fichiers/exam05-2018.pdf', 42, 'exam05-2018.pdf');

-- --------------------------------------------------------

--
-- Structure de la table `mots_cle`
--

DROP TABLE IF EXISTS `mots_cle`;
CREATE TABLE IF NOT EXISTS `mots_cle` (
  `mots` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `id_cours` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`mots`,`id_cours`),
  KEY `id_cours` (`id_cours`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `mots_cle`
--

INSERT INTO `mots_cle` (`mots`, `id_cours`) VALUES
('anglais', 'Eng_2'),
('english', 'Eng_2'),
('speaking', 'Eng_2'),
('anglais', 'Eng_3'),
('english', 'Eng_3'),
('speaking', 'Eng_3'),
('anglais', 'Eng_4'),
('english', 'Eng_4'),
('speaking', 'Eng_4'),
('darknet', 'Hac_5'),
('hacking', 'Hac_5'),
('piratage', 'Hac_5'),
('informatique', 'Int_1'),
('ordinateur', 'Int_1'),
('programmation', 'Int_1');

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `utilisateur`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
`id_utilisateur` varchar(10)
,`nom` varchar(50)
,`prenom` varchar(50)
,`mail` mediumtext
,`password` varchar(50)
);

-- --------------------------------------------------------

--
-- Structure de la vue `utilisateur`
--
DROP TABLE IF EXISTS `utilisateur`;

DROP VIEW IF EXISTS `utilisateur`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `utilisateur`  AS  select `etudiant`.`id_etudiant` AS `id_utilisateur`,`etudiant`.`nom` AS `nom`,`etudiant`.`prenom` AS `prenom`,`etudiant`.`mail` AS `mail`,`etudiant`.`password` AS `password` from `etudiant` union select `enseignant`.`id_enseignant` AS `id_utilisateur`,`enseignant`.`nom` AS `nom`,`enseignant`.`prenom` AS `prenom`,`enseignant`.`mail` AS `mail`,`enseignant`.`password` AS `password` from `enseignant` ;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `contenu`
--
ALTER TABLE `contenu`
  ADD CONSTRAINT `fk_contenu_cours` FOREIGN KEY (`id_cours`) REFERENCES `cours` (`id_cours`) ON DELETE CASCADE;

--
-- Contraintes pour la table `cours`
--
ALTER TABLE `cours`
  ADD CONSTRAINT `fk_enseignant_cours` FOREIGN KEY (`admin`) REFERENCES `enseignant` (`id_enseignant`) ON DELETE SET NULL;

--
-- Contraintes pour la table `etudiant_cours`
--
ALTER TABLE `etudiant_cours`
  ADD CONSTRAINT `etudiant_cours_ibfk_1` FOREIGN KEY (`id_etudiant`) REFERENCES `etudiant` (`id_etudiant`) ON DELETE CASCADE,
  ADD CONSTRAINT `etudiant_cours_ibfk_2` FOREIGN KEY (`id_cours`) REFERENCES `cours` (`id_cours`) ON DELETE CASCADE;

--
-- Contraintes pour la table `fichier`
--
ALTER TABLE `fichier`
  ADD CONSTRAINT `fichier_ibfk_1` FOREIGN KEY (`id_contenu`) REFERENCES `contenu` (`id_contenu`) ON DELETE CASCADE;

--
-- Contraintes pour la table `mots_cle`
--
ALTER TABLE `mots_cle`
  ADD CONSTRAINT `mots_cle_ibfk_1` FOREIGN KEY (`id_cours`) REFERENCES `cours` (`id_cours`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
