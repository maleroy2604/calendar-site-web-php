-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 31 Janvier 2017 à 15:12
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";



/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `prwb_calendar_g33`
--
CREATE DATABASE IF NOT EXISTS `prwb_calendar_G33` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `prwb_calendar_G33`;

-- --------------------------------------------------------

--
-- Structure de la table `calendar`
--

CREATE TABLE `calendar` (
  `idcalendar` int(11) NOT NULL,
  `description` varchar(50) NOT NULL,
  `color` char(6) NOT NULL,
  `iduser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `calendar`
--

INSERT INTO `calendar` (`idcalendar`, `description`, `color`, `iduser`) VALUES
(1, 'grololo', '80ff00', 1),
(2, 'la', '0000ff', 1);

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

CREATE TABLE `event` (
  `idevent` int(11) NOT NULL,
  `start` datetime NOT NULL,
  `finish` datetime DEFAULT NULL,
  `whole_day` tinyint(1) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `idcalendar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `event`
--

INSERT INTO `event` (`idevent`, `start`, `finish`, `whole_day`, `title`, `description`, `idcalendar`) VALUES
(4, '2012-10-16 20:30:00', '2012-10-17 20:30:00', 1, 'moi', 'fyg,,;ik;', 1),
(5, '2012-10-16 20:30:00', '2012-10-17 20:30:00', 1, 'toi', 'yhrfoiushgv', 1),
(6, '2012-10-16 20:30:00', '2012-10-17 20:30:00', 1, 'jkjk', 'hjkhj', 2),
(7, '2017-01-10 00:05:00', '2017-01-12 02:05:00', 1, 'mzrrr', 'hgloiusfmeoiif', 1),
(8, '2017-01-11 00:00:00', '2017-01-04 00:00:00', 1, 'fdgdfd', 'fhdfdhyd', 1),
(9, '2017-01-11 00:00:00', '2017-01-04 00:00:00', 1, 'fdgdfd', 'fhdfdhyd', 1),
(10, '2017-01-12 05:55:00', '2017-01-10 05:47:00', 1, 'dfsgd', 'dfgfdg', 1),
(11, '2017-01-12 05:55:00', '2017-01-10 05:47:00', 1, 'dfsgd', 'dfgfdg', 1),
(12, '2017-01-12 05:55:00', '2017-01-10 05:47:00', 1, 'dfsgd', 'dfgfdg', 1),
(13, '2017-01-12 05:55:00', '2017-01-10 05:47:00', 1, 'dfsgd', 'dfgfdg', 1),
(14, '2017-01-12 05:55:00', '2017-01-10 05:47:00', 1, 'dfsgd', 'dfgfdg', 1),
(15, '2017-01-12 05:55:00', '2017-01-10 05:47:00', 1, 'dfsgd', 'dfgfdg', 1),
(16, '2017-01-12 05:55:00', '2017-01-10 05:47:00', 1, 'dfsgd', 'dfgfdg', 1),
(17, '2017-01-12 05:55:00', '2017-01-10 05:47:00', 1, 'dfsgd', 'dfgfdg', 1),
(18, '2017-01-11 05:59:00', '2017-01-13 05:05:00', 1, 'cxbxcb', 'cxvbb', 1),
(19, '2017-01-19 05:05:00', '2017-01-18 05:05:00', 1, 'cvbgx', 'fdgdfg', 2),
(20, '2017-01-19 02:01:00', '2017-01-12 04:04:00', 0, 'tortue', 'fgdfg', 1),
(21, '2017-01-11 00:00:00', '2017-01-17 00:00:00', 1, '54646', 'fhgj', 1),
(22, '2017-01-03 12:01:00', '2017-01-24 05:05:00', 0, 'gagaga', 'gagagazgazg', 1),
(23, '2017-01-14 05:05:00', '2017-01-29 05:54:00', 1, 'ghhgh', 'hghg', 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `iduser` int(11) NOT NULL,
  `pseudo` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(50) NOT NULL,
  `full_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`iduser`, `pseudo`, `password`, `email`, `full_name`) VALUES
(1, 'ant', '8886348de94e8020a61205f2dc62fb7b', 'ant@gmail.com', 'antoine');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `calendar`
--
ALTER TABLE `calendar`
  ADD PRIMARY KEY (`idcalendar`),
  ADD KEY `fk_calendar_user_idx` (`iduser`);

--
-- Index pour la table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`idevent`),
  ADD KEY `fk_event_calendar1_idx` (`idcalendar`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`),
  ADD UNIQUE KEY `pseudo_UNIQUE` (`pseudo`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `calendar`
--
ALTER TABLE `calendar`
  MODIFY `idcalendar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `event`
--
ALTER TABLE `event`
  MODIFY `idevent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `calendar`
--
ALTER TABLE `calendar`
  ADD CONSTRAINT `fk_calendar_user` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`);

--
-- Contraintes pour la table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `fk_event_calendar` FOREIGN KEY (`idcalendar`) REFERENCES `calendar` (`idcalendar`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
