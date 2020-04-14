-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le :  lun. 13 avr. 2020 à 17:34
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
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(55) NOT NULL,
  `pwd` varchar(55) NOT NULL,
  `Nom` varchar(55) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Prenom` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `acheteurs`
--

INSERT INTO `acheteurs` (`ID`, `login`, `pwd`, `Nom`, `Prenom`, `email`) VALUES
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
(11, 't\"z', 'r', 'r\"z', 'tz\"', 'tz\"');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
