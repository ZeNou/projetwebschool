-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Dim 03 Janvier 2010 à 19:35
-- Version du serveur: 5.1.36
-- Version de PHP: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de données: `projetweb`
--

-- --------------------------------------------------------

--
-- Structure de la table `amis`
--

DROP TABLE IF EXISTS `amis`;
CREATE TABLE IF NOT EXISTS `amis` (
  `id_membre` int(11) NOT NULL,
  `id_amis` int(11) NOT NULL,
  `id_groupe_amis` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_membre`,`id_amis`),
  KEY `fk_amis_membre_1` (`id_membre`),
  KEY `fk_amis_membre_2` (`id_amis`),
  KEY `fk_amis_groupe_amis` (`id_groupe_amis`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `amis`
--

INSERT INTO `amis` (`id_membre`, `id_amis`, `id_groupe_amis`) VALUES
(1, 3, NULL),
(3, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`) VALUES
(2, 'Roman'),
(3, 'Drame'),
(4, 'Fantastique'),
(5, 'Sience-Fiction'),
(6, 'Historique');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `corps` text NOT NULL,
  `id_texte` int(11) NOT NULL,
  `id_membre` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_commentaire_texte` (`id_texte`),
  KEY `fk_commentaire_membre` (`id_membre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `commentaire`
--


-- --------------------------------------------------------

--
-- Structure de la table `groupe_amis`
--

DROP TABLE IF EXISTS `groupe_amis`;
CREATE TABLE IF NOT EXISTS `groupe_amis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(45) NOT NULL,
  `description` varchar(45) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `groupe_amis`
--


-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

DROP TABLE IF EXISTS `membre`;
CREATE TABLE IF NOT EXISTS `membre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) NOT NULL,
  `prenom` varchar(45) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `pseudo` varchar(10) NOT NULL,
  `pass` varchar(45) NOT NULL,
  `level` tinyint(4) NOT NULL,
  `date_inscription` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `membre`
--

INSERT INTO `membre` (`id`, `nom`, `prenom`, `mail`, `pseudo`, `pass`, `level`, `date_inscription`) VALUES
(1, 'Leboucq', 'Benjamin', 'benjamin.leboucq@gmail.com', 'ZeNou', 'c70a56420949d5461db7e0008f442a319c8fddec', 9, '2009-12-26 17:20:10'),
(3, 'Dizdarevic', 'Jonahan', 'dizda@dizda.com', 'Dizda', '2e63061cc526e00cb5e6f729b18dddcb306b98c0', 1, '2009-12-29 03:05:43');

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

DROP TABLE IF EXISTS `note`;
CREATE TABLE IF NOT EXISTS `note` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `note` tinyint(4) NOT NULL,
  `texte_id` int(11) NOT NULL,
  `membre_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_note_texte` (`texte_id`),
  KEY `fk_note_membre` (`membre_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `note`
--


-- --------------------------------------------------------

--
-- Structure de la table `texte`
--

DROP TABLE IF EXISTS `texte`;
CREATE TABLE IF NOT EXISTS `texte` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_membre` int(11) NOT NULL,
  `titre` varchar(45) NOT NULL,
  `corps` text NOT NULL,
  `date_ajout` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_categorie` smallint(6) NOT NULL,
  `droit_lecture` tinyint(4) NOT NULL DEFAULT '1',
  `droit_notation` tinyint(4) NOT NULL DEFAULT '1',
  `droit_commenter` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`,`id_membre`),
  KEY `fk_texte_membre` (`id_membre`),
  KEY `fk_texte_categorie` (`id_categorie`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Contenu de la table `texte`
--


--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `amis`
--
ALTER TABLE `amis`
  ADD CONSTRAINT `fk_amis_groupe_amis` FOREIGN KEY (`id_groupe_amis`) REFERENCES `groupe_amis` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_amis_membre_1` FOREIGN KEY (`id_membre`) REFERENCES `membre` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_amis_membre_2` FOREIGN KEY (`id_amis`) REFERENCES `membre` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `fk_commentaire_membre` FOREIGN KEY (`id_membre`) REFERENCES `membre` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_commentaire_texte` FOREIGN KEY (`id_texte`) REFERENCES `texte` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Contraintes pour la table `note`
--
ALTER TABLE `note`
  ADD CONSTRAINT `fk_note_membre` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_note_texte` FOREIGN KEY (`texte_id`) REFERENCES `texte` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Contraintes pour la table `texte`
--
ALTER TABLE `texte`
  ADD CONSTRAINT `fk_texte_categorie` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_texte_membre` FOREIGN KEY (`id_membre`) REFERENCES `membre` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
