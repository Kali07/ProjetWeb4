-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 24 mai 2020 à 22:09
-- Version du serveur :  5.7.19
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `workshop3`
--

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

DROP TABLE IF EXISTS `membre`;
CREATE TABLE IF NOT EXISTS `membre` (
  `id_membre` int(5) NOT NULL AUTO_INCREMENT,
  `nom` varchar(60) DEFAULT NULL,
  `prenom` varchar(60) DEFAULT NULL,
  `email` varchar(60) NOT NULL,
  `mdp` varchar(250) NOT NULL,
  `statut` varchar(10) NOT NULL DEFAULT 'membre',
  PRIMARY KEY (`id_membre`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`id_membre`, `nom`, `prenom`, `email`, `mdp`, `statut`) VALUES
(9, 'Depo', 'Papi', 'papi@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'membre'),
(8, 'Venus', 'Toto', 'toto@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'membre'),
(1, 'Richard', 'Kali', 'richard@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'admin'),
(2, 'Coratella', 'Enzo', 'enzo@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id_message` int(5) NOT NULL AUTO_INCREMENT,
  `id_envoyeur` int(11) NOT NULL,
  `id_receveur` int(11) NOT NULL,
  `message_` text,
  `date_message` datetime DEFAULT NULL,
  PRIMARY KEY (`id_message`),
  KEY `id_envoyeur` (`id_envoyeur`),
  KEY `id_receveur` (`id_receveur`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id_message`, `id_envoyeur`, `id_receveur`, `message_`, `date_message`) VALUES
(21, 8, 9, 'Oui je peux vous le faire à 55 euros si vous venez demain ', '2020-05-23 23:53:29'),
(20, 9, 8, 'Bonjour Mr, j\'aimerai savoir si ce prix est négociable ? ', '2020-05-23 23:51:49');

-- --------------------------------------------------------

--
-- Structure de la table `objectd`
--

DROP TABLE IF EXISTS `objectd`;
CREATE TABLE IF NOT EXISTS `objectd` (
  `id_object` int(5) NOT NULL AUTO_INCREMENT,
  `ref_id_membre` int(5) DEFAULT NULL,
  `titre` varchar(60) DEFAULT NULL,
  `prix` decimal(6,2) NOT NULL,
  `description_object` text,
  `caracteristiques` text,
  `statut_objet` varchar(60) DEFAULT 'attente',
  `photo1` varchar(60) DEFAULT '',
  `photo2` varchar(60) DEFAULT '',
  `photo3` varchar(60) DEFAULT '',
  PRIMARY KEY (`id_object`),
  KEY `ref_id_membre` (`ref_id_membre`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `objectd`
--

INSERT INTO `objectd` (`id_object`, `ref_id_membre`, `titre`, `prix`, `description_object`, `caracteristiques`, `statut_objet`, `photo1`, `photo2`, `photo3`) VALUES
(9, 8, 'Ecran Dell Model 4', '109.00', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco ', 'Hd, Vision nocturne ', 'valide', 'img/1590269669dell-monitor-300x300.png', 'img/159026966961k0vSy2dJL._AC_SL1500_.jpg', ''),
(10, 8, 'Le clavier de Mobility Lab', '80.00', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco ', 'allumage etc..', 'valide', 'img/1590270548imagesNRUOZ8K0.jpg', 'img/1590270548LD0005031673_2.jpg', 'img/1590270548imagesNRUOZ8K0.jpg'),
(11, 9, 'Chargeur new Model', '60.00', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco ', 'Cuivre, Neon, Coltan ', 'valide', 'img/15903561631540-1.jpg', 'img/1590356163LD0001327108_2.jpg', 'img/1590356163LD0003553653_2.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
