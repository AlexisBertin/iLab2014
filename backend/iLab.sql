-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 24 Février 2014 à 19:12
-- Version du serveur: 5.5.29
-- Version de PHP: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données: `iLab`
--

-- --------------------------------------------------------

--
-- Structure de la table `friends`
--

CREATE TABLE `friends` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prenom` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `montant` decimal(11,0) NOT NULL,
  `created` datetime NOT NULL,
  `liste` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `dateFin` date NOT NULL,
  `note` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Contenu de la table `friends`
--

INSERT INTO `friends` (`id`, `prenom`, `montant`, `created`, `liste`, `username`, `dateFin`, `note`) VALUES
(46, 'Heu', -890, '2014-02-21 12:48:22', 'DWM', 'Admin', '2014-02-21', 'C''est un gros con.'),
(47, 'Johny', 17, '2014-02-24 19:08:19', 'DWM', 'admin', '2014-03-24', 'dude');

-- --------------------------------------------------------

--
-- Structure de la table `listes`
--

CREATE TABLE `listes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomDeListe` varchar(255) NOT NULL,
  `createdBy` varchar(255) NOT NULL,
  `created` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `created` (`created`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Contenu de la table `listes`
--

INSERT INTO `listes` (`id`, `nomDeListe`, `createdBy`, `created`) VALUES
(13, 'DWM', 'admin', '2014-02-17'),
(14, 'Green', 'admin', '2014-02-17'),
(15, 'HJLS', 'admin', '2014-02-17'),
(16, 'Derp', 'admin', '2014-02-18'),
(17, 'Mex', 'admin', '2014-02-18'),
(18, 'Ilab', 'Admin', '2014-02-21'),
(19, 'Huehue', 'Admin', '2014-02-21'),
(20, 'Gggg', 'Admin', '2014-02-21');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `lastlogin` datetime NOT NULL,
  `token` varchar(255) NOT NULL,
  `activer` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `mail`, `avatar`, `created`, `lastlogin`, `token`, `activer`) VALUES
(1, 'dfsdf', '68a1ec017794f9edb24fa53e20971933c4b41780', 'mail@alexisbertin.fr', '', '2014-02-11 09:22:46', '0000-00-00 00:00:00', 'd74ea7329d8c9c8d7232d3dfcf839db06ae888fe', 0),
(2, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'mail@alexisbertin.fr', '', '2014-02-11 09:31:27', '0000-00-00 00:00:00', '5de038b59cc220743dc359590cc98a03cf08857c', 1),
(4, 'salut', '1bfbdf35b1359fc6b6f93893874cf23a50293de5', 'mail@alexisbertin.fr', '', '2014-02-11 11:00:07', '0000-00-00 00:00:00', '9767fa8cf318fbe675868679f605682ade83c5e7', 1);
