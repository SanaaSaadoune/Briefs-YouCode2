-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 14 mai 2020 à 00:52
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bdvente`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin1`
--

DROP TABLE IF EXISTS `admin1`;
CREATE TABLE IF NOT EXISTS `admin1` (
  `Id_Ad` int(11) NOT NULL,
  `Email_Ad` varchar(50) NOT NULL,
  `Password_Ad` varchar(50) NOT NULL,
  `CIN_Ad` int(10) NOT NULL,
  PRIMARY KEY (`Id_Ad`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `CIN_Cl` varchar(10) NOT NULL,
  `Nom_Cl` varchar(30) NOT NULL,
  `Prenom_Cl` varchar(30) NOT NULL,
  `Email_Cl` varchar(80) NOT NULL,
  `Password_Cl` varchar(50) NOT NULL,
  PRIMARY KEY (`CIN_Cl`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `Id_Cmd` int(11) NOT NULL AUTO_INCREMENT,
  `Date_Cmd` date NOT NULL,
  `CIN_Cl` varchar(10) NOT NULL,
  PRIMARY KEY (`Id_Cmd`),
  KEY `CIN_Cl` (`CIN_Cl`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ligne_commande`
--

DROP TABLE IF EXISTS `ligne_commande`;
CREATE TABLE IF NOT EXISTS `ligne_commande` (
  `Id_Cmd` int(11) NOT NULL,
  `Id_Prod` int(11) NOT NULL,
  `Quantite` int(11) NOT NULL,
  KEY `Id_Cmd` (`Id_Cmd`),
  KEY `Id_Prod` (`Id_Prod`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `Id_Prod` int(11) NOT NULL AUTO_INCREMENT,
  `Nom_Prod` varchar(30) NOT NULL,
  `Prix_Prod` float NOT NULL,
  `Quantite_Prod` int(11) NOT NULL,
  `Categorie` varchar(30) NOT NULL,
  PRIMARY KEY (`Id_Prod`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
