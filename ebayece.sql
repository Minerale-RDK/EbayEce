-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le :  mer. 15 avr. 2020 à 13:58
-- Version du serveur :  8.0.18
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ebayece`
--

-- --------------------------------------------------------

--
-- Structure de la table `acheteurs`
--

DROP TABLE IF EXISTS `acheteurs`;
CREATE TABLE IF NOT EXISTS `acheteurs` (
  `IDAcheteur` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(55) NOT NULL,
  `pwd` varchar(55) NOT NULL,
  `Nom` varchar(55) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Prenom` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  PRIMARY KEY (`IDAcheteur`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `acheteurs`
--

INSERT INTO `acheteurs` (`IDAcheteur`, `login`, `pwd`, `Nom`, `Prenom`, `email`) VALUES
(1, 'victor', 'victor', 'victor', '', ''),
(2, 'test', 'test', 'test', 'test', 'test'),
(3, 'j', 'j', 'jean', 'jean', 'j'),
(4, 'max', 'max', 'max', 'max', 'max'),
(5, 'ee', 'ee', 'ee', 'te', 'ee'),
(6, 'eee', 'ee', 'ee', 'te', 'ee'),
(7, 'eeevr', 'r', 'ee', 'te', 'ee'),
(8, 'eeevrez', 'z', 'ee', 'te', 'ee'),
(9, 'eeevrezges', 'e', 'ee', 'te', 'ee'),
(10, 'feseeeee', 'ee', 'fes', 'fess', 'fes'),
(11, 't\"z', 'r', 'r\"z', 'tz\"', 'tz\"'),
(12, 'ee', 'e', 'ee', 'ee', 'ee'),
(13, '', '', '', '', ''),
(14, '', '', '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `administrateurs`
--

DROP TABLE IF EXISTS `administrateurs`;
CREATE TABLE IF NOT EXISTS `administrateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `pwd` varchar(55) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `administrateurs`
--

INSERT INTO `administrateurs` (`id`, `login`, `pwd`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `IDItem` int(11) NOT NULL AUTO_INCREMENT,
  `nomitem` varchar(55) NOT NULL,
  `description` text NOT NULL,
  `chemindossier` varchar(55) NOT NULL,
  `typevente` int(11) NOT NULL,
  `prix` int(11) NOT NULL,
  `categorie` varchar(55) NOT NULL,
  `datefin` int(11) NOT NULL,
  `IDVendeur` int(11) NOT NULL,
  `avendre` tinyint(1) NOT NULL,
  PRIMARY KEY (`IDItem`),
  KEY `IDVendeur` (`IDVendeur`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `items`
--

INSERT INTO `items` (`IDItem`, `nomitem`, `description`, `chemindossier`, `typevente`, `prix`, `categorie`, `datefin`, `IDVendeur`, `avendre`) VALUES
(7, 'Test', 'Test', 'files/imgitem/0.88091100 1586954006', 1, 150, 'FoT', 0, 1, 1),
(8, 'Test', 'Test', 'files/imgitem/0.88319300 1586954114', 1, 150, 'FoT', 0, 1, 1),
(9, 'fes<', 'fes', 'files/imgitem/0.79394000 1586956221', 1, 40, 'FoT', 0, 1, 1),
(10, 'fnezjno', 'f,les,', 'files/imgitem/0.41024000 1586956608', 1, 75, 'FoT', 0, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `vendeurs`
--

DROP TABLE IF EXISTS `vendeurs`;
CREATE TABLE IF NOT EXISTS `vendeurs` (
  `IDVendeur` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `file_url` varchar(255) NOT NULL,
  `cover_url` varchar(255) NOT NULL,
  PRIMARY KEY (`IDVendeur`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `vendeurs`
--

INSERT INTO `vendeurs` (`IDVendeur`, `login`, `pwd`, `Nom`, `Prenom`, `email`, `name`, `file_url`, `cover_url`) VALUES
(1, 'paulo92', 'polo', 'Senard', 'Paul', 'paulsenard@free.fr', 'avatar.jpg', 'files/paulo92/avatar.jpg', ''),
(9, 'paulo11', 'aa', 'martin', 'Clément', 'paulsenard@free.fr', 'avatar.jpg', 'files/paulo11/avatar.jpg', 'images/fonddecouv/5.jpg');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `IDVendeur` FOREIGN KEY (`IDVendeur`) REFERENCES `vendeurs` (`IDVendeur`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
