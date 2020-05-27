-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 27 mai 2020 à 15:17
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
  `Id_Ad` int(11) NOT NULL AUTO_INCREMENT,
  `Nom_Ad` varchar(30) NOT NULL,
  `Email_Ad` varchar(50) NOT NULL,
  `Password_Ad` varchar(50) NOT NULL,
  `CIN_Ad` varchar(10) NOT NULL,
  PRIMARY KEY (`Id_Ad`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `admin1`
--

INSERT INTO `admin1` (`Id_Ad`, `Nom_Ad`, `Email_Ad`, `Password_Ad`, `CIN_Ad`) VALUES
(1, 'Admin', 'Admin@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'H1234678');

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
  `Date_Insc` datetime DEFAULT NULL,
  PRIMARY KEY (`CIN_Cl`),
  UNIQUE KEY `MailUnique` (`Email_Cl`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`CIN_Cl`, `Nom_Cl`, `Prenom_Cl`, `Email_Cl`, `Password_Cl`, `Date_Insc`) VALUES
('H1234', 'Saadoune', 'Sanaa', 'Sanaa@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2020-05-25 03:01:50');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `Id_Cmd` int(11) NOT NULL AUTO_INCREMENT,
  `Date_Cmd` datetime NOT NULL,
  `CIN_Cl` varchar(10) NOT NULL,
  `Facture` float NOT NULL,
  `MethodePaiement` varchar(50) NOT NULL,
  PRIMARY KEY (`Id_Cmd`),
  KEY `CIN_Cl` (`CIN_Cl`)
) ENGINE=MyISAM AUTO_INCREMENT=149 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`Id_Cmd`, `Date_Cmd`, `CIN_Cl`, `Facture`, `MethodePaiement`) VALUES
(112, '2020-05-26 17:21:56', 'H1234', 17, 'Especes'),
(111, '2020-05-26 17:19:52', 'H1234', 10, 'Especes'),
(110, '2020-05-26 17:18:11', 'H1234', 2, 'Especes'),
(107, '2020-05-26 17:16:05', 'H1234', 10, 'Especes'),
(6, '2020-05-23 15:52:54', 'H1234', 9, 'Especes'),
(109, '2020-05-26 17:17:01', 'H1234', 2, 'Especes'),
(8, '2020-05-23 15:55:04', 'H1234', 9, 'Especes'),
(9, '2020-05-23 15:55:29', 'H1234', 9, 'Especes'),
(108, '2020-05-26 17:16:28', 'H1234', 2, 'Especes'),
(11, '2020-05-23 15:56:57', 'H1234', 9, 'Especes'),
(12, '2020-05-23 15:59:29', 'H1234', 9, 'Especes'),
(13, '2020-05-23 16:00:00', 'H1234', 9, 'Especes'),
(14, '2020-05-23 16:00:36', 'H1234', 9, 'Especes'),
(15, '2020-05-23 16:01:19', 'H1234', 9, 'Especes'),
(16, '2020-05-23 16:01:37', 'H1234', 9, 'Especes'),
(17, '2020-05-23 16:02:02', 'H1234', 9, 'Especes'),
(18, '2020-05-23 16:07:24', 'H1234', 9, 'Especes'),
(19, '2020-05-23 16:07:47', 'H1234', 9, 'Especes'),
(20, '2020-05-23 16:09:34', 'H1234', 9, 'Especes'),
(21, '2020-05-23 16:09:50', 'H1234', 9, 'Especes'),
(22, '2020-05-23 16:10:16', 'H1234', 9, 'Especes'),
(23, '2020-05-23 16:11:04', 'H1234', 9, 'Especes'),
(24, '2020-05-23 16:11:17', 'H1234', 9, 'Especes'),
(25, '2020-05-23 16:11:47', 'H1234', 9, 'Especes'),
(26, '2020-05-23 16:12:00', 'H1234', 9, 'Especes'),
(27, '2020-05-23 16:12:28', 'H1234', 9, 'Especes'),
(28, '2020-05-23 16:12:40', 'H1234', 9, 'Especes'),
(29, '2020-05-23 16:13:12', 'H1234', 9, 'Especes'),
(30, '2020-05-23 16:13:40', 'H1234', 9, 'Especes'),
(31, '2020-05-23 16:13:51', 'H1234', 9, 'Especes'),
(32, '2020-05-23 16:14:41', 'H1234', 9, 'Especes'),
(33, '2020-05-23 16:15:07', 'H1234', 9, 'Especes'),
(34, '2020-05-23 16:15:35', 'H1234', 9, 'Especes'),
(35, '2020-05-23 16:15:56', 'H1234', 9, 'Especes'),
(36, '2020-05-23 16:16:41', 'H1234', 9, 'Especes'),
(37, '2020-05-23 16:19:05', 'H1234', 9, 'Especes'),
(38, '2020-05-23 16:19:39', 'H1234', 9, 'Especes'),
(39, '2020-05-23 16:20:04', 'H1234', 9, 'Especes'),
(40, '2020-05-23 16:20:24', 'H1234', 9, 'Especes'),
(41, '2020-05-23 16:20:33', 'H1234', 9, 'Especes'),
(42, '2020-05-23 16:21:36', 'H1234', 9, 'Especes'),
(43, '2020-05-23 16:21:57', 'H1234', 9, 'Especes'),
(44, '2020-05-23 16:22:15', 'H1234', 9, 'Especes'),
(45, '2020-05-23 16:22:32', 'H1234', 9, 'Especes'),
(46, '2020-05-23 16:23:38', 'H1234', 9, 'Especes'),
(47, '2020-05-23 16:24:16', 'H1234', 9, 'Especes'),
(48, '2020-05-23 16:24:21', 'H1234', 9, 'Especes'),
(49, '2020-05-23 16:24:41', 'H1234', 9, 'Especes'),
(50, '2020-05-23 16:25:03', 'H1234', 9, 'Especes'),
(51, '2020-05-23 16:25:09', 'H1234', 9, 'Especes'),
(52, '2020-05-23 16:26:38', 'H1234', 9, 'Especes'),
(53, '2020-05-23 16:26:56', 'H1234', 9, 'Especes'),
(54, '2020-05-23 16:27:11', 'H1234', 9, 'Especes'),
(55, '2020-05-23 16:27:59', 'H1234', 9, 'Especes'),
(56, '2020-05-23 16:30:18', 'H1234', 9, 'Especes'),
(57, '2020-05-23 16:31:27', 'H1234', 9, 'Especes'),
(58, '2020-05-23 16:31:43', 'H1234', 9, 'Especes'),
(59, '2020-05-23 16:32:01', 'H1234', 9, 'Especes'),
(60, '2020-05-23 16:32:33', 'H1234', 9, 'Especes'),
(61, '2020-05-23 16:32:53', 'H1234', 9, 'Especes'),
(62, '2020-05-23 16:33:19', 'H1234', 9, 'Especes'),
(63, '2020-05-23 16:33:40', 'H1234', 9, 'Especes'),
(64, '2020-05-23 16:34:03', 'H1234', 9, 'Especes'),
(65, '2020-05-23 16:34:36', 'H1234', 9, 'Especes'),
(66, '2020-05-23 16:35:04', 'H1234', 9, 'Especes'),
(67, '2020-05-23 16:35:33', 'H1234', 9, 'Especes'),
(68, '2020-05-23 16:35:46', 'H1234', 9, 'Especes'),
(69, '2020-05-23 16:36:47', 'H1234', 9, 'Especes'),
(70, '2020-05-23 16:37:41', 'H1234', 9, 'Especes'),
(71, '2020-05-23 16:38:07', 'H1234', 9, 'Especes'),
(72, '2020-05-23 16:38:28', 'H1234', 9, 'Especes'),
(73, '2020-05-23 16:39:03', 'H1234', 9, 'Especes'),
(74, '2020-05-23 16:39:20', 'H1234', 9, 'Especes'),
(75, '2020-05-23 16:39:45', 'H1234', 9, 'Especes'),
(76, '2020-05-23 16:39:57', 'H1234', 9, 'Especes'),
(77, '2020-05-23 16:40:16', 'H1234', 9, 'Especes'),
(78, '2020-05-23 16:40:37', 'H1234', 9, 'Especes'),
(79, '2020-05-23 16:42:42', 'H1234', 9, 'Especes'),
(80, '2020-05-23 16:43:02', 'H1234', 9, 'Especes'),
(81, '2020-05-23 16:43:21', 'H1234', 9, 'Especes'),
(82, '2020-05-23 16:43:31', 'H1234', 9, 'Especes'),
(83, '2020-05-23 16:44:24', 'H1234', 9, 'Especes'),
(84, '2020-05-23 16:44:37', 'H1234', 9, 'Especes'),
(85, '2020-05-23 16:44:58', 'H1234', 9, 'Especes'),
(86, '2020-05-23 16:45:31', 'H1234', 9, 'Especes'),
(87, '2020-05-23 16:46:39', 'H1234', 9, 'Especes'),
(88, '2020-05-24 23:35:17', 'H1234', 9, 'Especes'),
(89, '2020-05-24 23:39:47', 'H1234', 9, 'Especes'),
(90, '2020-05-24 23:40:03', 'H1234', 9, 'Especes'),
(91, '2020-05-24 23:40:28', 'H1234', 9, 'Especes'),
(92, '2020-05-24 23:40:59', 'H1234', 9, 'Especes'),
(93, '2020-05-24 23:41:41', 'H1234', 9, 'Especes'),
(94, '2020-05-24 23:42:32', 'H1234', 9, 'Especes'),
(95, '2020-05-24 23:42:43', 'H1234', 9, 'Especes'),
(96, '2020-05-24 23:43:19', 'H1234', 9, 'Especes'),
(97, '2020-05-24 23:44:41', 'H1234', 9, 'Especes'),
(98, '2020-05-24 23:45:03', 'H1234', 9, 'Especes'),
(99, '2020-05-24 23:45:54', 'H1234', 9, 'Especes'),
(100, '2020-05-24 23:46:23', 'H1234', 9, 'Especes'),
(101, '2020-05-24 23:48:38', 'H1234', 9, 'Especes'),
(102, '2020-05-24 23:49:01', 'H1234', 9, 'Especes'),
(103, '2020-05-24 23:49:58', 'H1234', 9, 'Especes'),
(104, '2020-05-24 23:50:53', 'H1234', 9, 'Especes'),
(105, '2020-05-24 23:51:08', 'H1234', 9, 'Especes'),
(106, '2020-05-24 23:55:59', 'H1234', 9, 'Especes'),
(113, '2020-05-26 17:22:32', 'H1234', 10, 'Especes'),
(114, '2020-05-26 17:23:02', 'H1234', 10, 'Especes'),
(115, '2020-05-26 17:23:20', 'H1234', 10, 'Especes'),
(116, '2020-05-26 17:27:10', 'H1234', 10, 'Especes'),
(117, '2020-05-26 17:27:16', 'H1234', 10, 'Especes'),
(118, '2020-05-26 17:27:40', 'H1234', 10, 'Especes'),
(119, '2020-05-26 17:27:54', 'H1234', 10, 'Especes'),
(120, '2020-05-26 17:28:08', 'H1234', 10, 'Especes'),
(121, '2020-05-26 17:28:41', 'H1234', 10, 'Especes'),
(122, '2020-05-26 17:29:16', 'H1234', 10, 'Especes'),
(123, '2020-05-26 17:30:33', 'H1234', 10, 'Especes'),
(124, '2020-05-26 17:30:41', 'H1234', 10, 'Especes'),
(125, '2020-05-26 17:31:04', 'H1234', 10, 'Especes'),
(126, '2020-05-26 17:31:28', 'H1234', 2, 'Especes'),
(127, '2020-05-26 17:32:38', 'H1234', 9, 'Especes'),
(128, '2020-05-26 17:34:13', 'H1234', 12, 'Especes'),
(129, '2020-05-26 23:42:23', 'H1234', 36, 'Especes'),
(130, '2020-05-27 00:09:49', 'H1234', 28, 'Especes'),
(131, '2020-05-27 00:10:21', 'H1234', 28, 'Especes'),
(132, '2020-05-27 00:37:02', 'H1234', 28, 'Especes'),
(133, '2020-05-27 00:37:16', 'H1234', 32, 'Especes'),
(134, '2020-05-27 01:07:17', 'H1234', 9, 'CarteBanquaire'),
(135, '2020-05-27 03:27:02', 'H1234', 30, 'Especes'),
(136, '2020-05-27 03:28:18', 'H1234', 9, 'Especes'),
(137, '2020-05-27 03:29:20', 'H1234', 648, 'Especes'),
(138, '2020-05-27 03:30:34', 'H1234', 43, 'Especes'),
(139, '2020-05-27 03:33:15', 'H1234', 23, 'Especes'),
(140, '2020-05-27 03:39:36', 'H1234', 30, 'Especes'),
(141, '2020-05-27 03:48:03', 'H1234', 103, 'Especes'),
(142, '2020-05-27 03:50:03', 'H1234', 41, 'Especes'),
(143, '2020-05-27 03:50:25', 'H1234', 278, 'Especes'),
(144, '2020-05-27 04:02:08', 'H1234', 278, 'Especes'),
(145, '2020-05-27 04:02:22', 'H1234', 103, 'Especes'),
(146, '2020-05-27 04:03:21', 'H1234', 223, 'Especes'),
(147, '2020-05-27 04:05:22', 'H1234', 223, 'Especes'),
(148, '2020-05-27 04:05:52', 'H1234', 223, 'Especes');

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

--
-- Déchargement des données de la table `ligne_commande`
--

INSERT INTO `ligne_commande` (`Id_Cmd`, `Id_Prod`, `Quantite`) VALUES
(144, 1, 4),
(144, 2, 5),
(144, 3, 4),
(145, 1, 5),
(145, 2, 4),
(145, 3, 1),
(146, 1, 5),
(146, 2, 4),
(146, 3, 3),
(147, 1, 5),
(147, 2, 4),
(147, 3, 3),
(148, 1, 5),
(148, 2, 4),
(148, 3, 3);

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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`Id_Prod`, `Nom_Prod`, `Prix_Prod`, `Quantite_Prod`, `Categorie`) VALUES
(1, 'Banane', 7, 26, 'Fruit'),
(2, 'Yagourt', 2, 79, 'Danone'),
(3, 'Nutella', 60, 66, 'Chocolat');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
