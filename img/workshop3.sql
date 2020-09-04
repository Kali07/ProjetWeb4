-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 23 mai 2020 à 21:25
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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`id_membre`, `nom`, `prenom`, `email`, `mdp`, `statut`) VALUES
(1, 'Kali', 'Richard', 'kali@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'admin'),
(2, 'Enzo', NULL, 'enzo@gmail.com', '12345', 'amin'),
(3, 'toto', 'test', 'toto@gmail.com', '1234', 'membre'),
(4, 'Richard', 'Rick', 'moi@toujours', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'membre'),
(5, 'popopo', 'papi', 'papi@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'membre'),
(6, 'MULAMBA', 'ferf', 'lolo@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'membre'),
(7, 'Jean', 'Paull', 'murat@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'membre');

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
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id_message`, `id_envoyeur`, `id_receveur`, `message_`, `date_message`) VALUES
(1, 6, 3, 'je te trouve ici', '2020-05-22 15:02:09'),
(2, 6, 5, 'Je suis interessé par votre produit', '2020-05-21 16:13:00'),
(3, 6, 3, 'je voullu', '2020-05-19 09:00:00'),
(4, 5, 5, 'mon propre message', '2020-05-22 08:21:22'),
(5, 5, 5, 'mon propre message', '2020-05-21 09:20:11'),
(6, 4, 5, 'enzo4555555555555', '2020-05-21 18:26:33'),
(7, 4, 5, 'Je suis Karim et je suis interessé par votre produit', '2020-05-21 09:24:16'),
(8, 6, 3, 'un autre test que je souhaite faire', '2020-05-22 20:59:56'),
(9, 6, 3, 'c\'est une bonne affaire', '2020-05-22 21:02:09'),
(10, 6, 5, 'ceci ets un message archi test, donc si vous trouvez ceci vous serez en paix', '2020-05-22 21:03:32'),
(11, 1, 5, 'je me permet de vous contacter encore pour vous dire merci de publier un telle belle offre', '2020-05-22 21:06:31'),
(12, 1, 5, 'coucouuuuu toi laaaaaaaaa', '2020-05-22 21:21:18'),
(13, 1, 5, 'cococococo papiiiiii', '2020-05-22 21:23:27'),
(14, 5, 1, 'je te repond papiiii', '2020-05-22 21:26:51'),
(15, 4, 5, 'bonjour c\'est rick ', '2020-05-22 21:28:21'),
(16, 5, 4, 'j\'ai vu mr richaaaaaaaaard', '2020-05-22 21:29:14'),
(17, 4, 5, 'merci pour votre reponse ', '2020-05-22 21:36:58'),
(18, 5, 4, 'de rien ', '2020-05-22 21:38:03'),
(19, 4, 5, 'toto', '2020-05-23 23:24:15');

-- --------------------------------------------------------

--
-- Structure de la table `objectd`
--

DROP TABLE IF EXISTS `objectd`;
CREATE TABLE IF NOT EXISTS `objectd` (
  `id_object` int(5) NOT NULL AUTO_INCREMENT,
  `ref_id_membre` int(5) DEFAULT NULL,
  `titre` varchar(60) DEFAULT NULL,
  `prix` decimal(4,2) NOT NULL,
  `description_object` text,
  `caracteristiques` text,
  `statut_objet` varchar(60) DEFAULT 'attente',
  `photo1` varchar(60) DEFAULT '',
  `photo2` varchar(60) DEFAULT '',
  `photo3` varchar(60) DEFAULT '',
  PRIMARY KEY (`id_object`),
  KEY `ref_id_membre` (`ref_id_membre`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `objectd`
--

INSERT INTO `objectd` (`id_object`, `ref_id_membre`, `titre`, `prix`, `description_object`, `caracteristiques`, `statut_objet`, `photo1`, `photo2`, `photo3`) VALUES
(4, 5, 'Nature', '52.00', 'je suis en confinement ', 'boire ou mousser', 'valide', '', '', ''),
(5, 5, 'le fichier 3', '39.00', '\r\n^$*pùmolikujyhftgdrfsedzsaq', 'boire ou mousser existe bel et bien', 'valide', 'img/logo5.png', '', ''),
(6, 3, 'Deuxieme article', '50.22', 'srxdcgfhjb,kl,clnjnclblkcblkqnclbqjkvcgcisdkvjbkzebfqfqfqfqfqfqfqfgdghflfjlfklfttrjheggvvvvlebveve', 'vzvzvzvfrgfezgzgzfzzccffgcegergthyjyululfgzfc', 'valide', 'img/autre3.png', 'img/autre2.png', ''),
(7, 4, 'Imprimente full hd', '45.00', 'votre choix reste le meilleur de tous', 'noir et puissant', 'attente', 'img/1590267317a-evolucao-do-php.png', 'img/1590267317arriere_plan1.jpg', ''),
(8, 4, 'Perpignan', '55.00', 'DZQEFSGRTHYJUTGRH', 'boire ou mousser', 'valide', 'img/159026785817455241_1310125012388067_1593017763_o.jpg', 'img/1590267858archivage_pc.jpg', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
