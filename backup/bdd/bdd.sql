-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Dim 03 Janvier 2010 à 19:29
-- Version du serveur: 5.1.36
-- Version de PHP: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de données: `projetweb`
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
-- Contraintes pour la table `texte`
--
ALTER TABLE `texte`
  ADD CONSTRAINT `fk_texte_categorie` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_texte_membre` FOREIGN KEY (`id_membre`) REFERENCES `membre` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
