-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Dim 10 Janvier 2010 à 13:46
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

CREATE TABLE IF NOT EXISTS `amis` (
  `id_membre` int(11) NOT NULL,
  `id_amis` int(11) NOT NULL,
  `id_groupe_amis` int(11) NOT NULL,
  PRIMARY KEY (`id_membre`,`id_amis`),
  KEY `fk_amis_membre_1` (`id_membre`),
  KEY `fk_amis_membre_2` (`id_amis`),
  KEY `fk_amis_groupe_amis` (`id_groupe_amis`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `amis`
--


-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`) VALUES
(1, 'Roman'),
(2, 'Fantastique'),
(3, 'Drame'),
(4, 'Action');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE IF NOT EXISTS `commentaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `corps` text NOT NULL,
  `id_texte` int(11) NOT NULL,
  `id_membre` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_commentaire_texte` (`id_texte`),
  KEY `fk_commentaire_membre` (`id_membre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `commentaire`
--


-- --------------------------------------------------------

--
-- Structure de la table `droitbycategorie`
--

CREATE TABLE IF NOT EXISTS `droitbycategorie` (
  `membre_id` int(11) NOT NULL,
  `categorie_id` smallint(6) NOT NULL,
  PRIMARY KEY (`membre_id`,`categorie_id`),
  KEY `fk_droitbycategorie_membre1` (`membre_id`),
  KEY `fk_droitbycategorie_categorie1` (`categorie_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `droitbycategorie`
--

INSERT INTO `droitbycategorie` (`membre_id`, `categorie_id`) VALUES
(1, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `groupe_amis`
--

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `membre`
--

INSERT INTO `membre` (`id`, `nom`, `prenom`, `mail`, `pseudo`, `pass`, `level`, `date_inscription`) VALUES
(1, 'Leboucq', 'Benjamin', 'benjamin.leboucq@gmail.com', 'ZeNou', 'c70a56420949d5461db7e0008f442a319c8fddec', 9, '2010-01-09 13:52:51'),
(2, 'Dizdarevic', 'Jonathan', 'dizzda@gmail.com', 'Dizda', '2e63061cc526e00cb5e6f729b18dddcb306b98c0', 2, '2010-01-09 16:31:11');

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

CREATE TABLE IF NOT EXISTS `note` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `note` tinyint(4) NOT NULL,
  `texte_id` int(11) NOT NULL,
  `membre_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_note_texte` (`texte_id`),
  KEY `fk_note_membre` (`membre_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `note`
--


-- --------------------------------------------------------

--
-- Structure de la table `texte`
--

CREATE TABLE IF NOT EXISTS `texte` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_membre` int(11) NOT NULL,
  `titre` varchar(45) NOT NULL,
  `corps` text NOT NULL,
  `date_ajout` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `droit_lecture` tinyint(4) NOT NULL DEFAULT '1',
  `droit_notation` tinyint(4) NOT NULL DEFAULT '1',
  `droit_commenter` tinyint(4) NOT NULL DEFAULT '1',
  `id_categorie` smallint(6) NOT NULL,
  PRIMARY KEY (`id`,`id_membre`),
  KEY `fk_texte_membre` (`id_membre`),
  KEY `fk_texte_categorie` (`id_categorie`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `texte`
--

INSERT INTO `texte` (`id`, `id_membre`, `titre`, `corps`, `date_ajout`, `droit_lecture`, `droit_notation`, `droit_commenter`, `id_categorie`) VALUES
(1, 1, 'fichier', 'mdlkfqmldskfj mqldkfjqmsdlkf jqmdlkfj qmldkfjqm ldsk fjqmldskfjmqslkfdjq', '2010-01-09 18:46:25', 1, 0, 1, 3),
(2, 1, 'Test text', 'Ã¹mdlkfqmdl fkqjmdlkfq mdlk dmfq ldkqmdlkfd qsdf', '2010-01-09 18:46:34', 1, 1, 1, 2);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `amis`
--
ALTER TABLE `amis`
  ADD CONSTRAINT `fk_amis_membre_1` FOREIGN KEY (`id_membre`) REFERENCES `membre` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_amis_membre_2` FOREIGN KEY (`id_amis`) REFERENCES `membre` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_amis_groupe_amis` FOREIGN KEY (`id_groupe_amis`) REFERENCES `groupe_amis` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `fk_commentaire_texte` FOREIGN KEY (`id_texte`) REFERENCES `texte` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_commentaire_membre` FOREIGN KEY (`id_membre`) REFERENCES `membre` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Contraintes pour la table `droitbycategorie`
--
ALTER TABLE `droitbycategorie`
  ADD CONSTRAINT `fk_droitbycategorie_membre1` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_droitbycategorie_categorie1` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `note`
--
ALTER TABLE `note`
  ADD CONSTRAINT `fk_note_texte` FOREIGN KEY (`texte_id`) REFERENCES `texte` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_note_membre` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Contraintes pour la table `texte`
--
ALTER TABLE `texte`
  ADD CONSTRAINT `fk_texte_membre` FOREIGN KEY (`id_membre`) REFERENCES `membre` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_texte_categorie` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
