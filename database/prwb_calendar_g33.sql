-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Lun 20 Mars 2017 à 20:54
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
CREATE DATABASE IF NOT EXISTS `prwb_calendar_g33` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `prwb_calendar_g33`;

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
(3, 'JAAAA', 'ff8040', 1),
(4, 'ggggg', 'ff0000', 2),
(5, 'oooooo', '00ff00', 2);

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
(1, '2017-03-20 08:00:00', '2017-03-20 16:00:00', 0, 'uuuu', 'UUUUU', 3),
(2, '2017-03-20 07:00:00', '2017-03-20 16:00:00', 0, 'lololo', 'lololololo', 3),
(3, '2017-03-20 08:00:00', '2017-03-20 16:00:00', 0, 'pppp', 'ppppp', 4),
(4, '2017-03-21 08:00:00', '2017-03-21 09:00:00', 0, 'lllllll', 'lllll', 5);

-- --------------------------------------------------------

--
-- Structure de la table `share`
--

CREATE TABLE `share` (
  `iduser` int(11) NOT NULL,
  `idcalendar` int(11) NOT NULL,
  `read_only` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `share`
--

INSERT INTO `share` (`iduser`, `idcalendar`, `read_only`) VALUES
(1, 4, 1),
(1, 5, 0),
(3, 4, 0),
(3, 5, 1);

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
(1, 'ant', '8886348de94e8020a61205f2dc62fb7b', 'ant@gmail.com', 'ant '),
(2, 'aaa', '8886348de94e8020a61205f2dc62fb7b', 'AAA@gmail.com', 'aaa'),
(3, 'bbb', '8886348de94e8020a61205f2dc62fb7b', 'bbb@gmail.com', 'bbb');

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
-- Index pour la table `share`
--
ALTER TABLE `share`
  ADD PRIMARY KEY (`iduser`,`idcalendar`),
  ADD KEY `idcalendar` (`idcalendar`);

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
  MODIFY `idcalendar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `event`
--
ALTER TABLE `event`
  MODIFY `idevent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
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

--
-- Contraintes pour la table `share`
--
ALTER TABLE `share`
  ADD CONSTRAINT `share_ibfk_1` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`),
  ADD CONSTRAINT `share_ibfk_2` FOREIGN KEY (`idcalendar`) REFERENCES `calendar` (`idcalendar`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
