-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mar. 08 sep. 2020 à 20:08
-- Version du serveur :  5.7.24
-- Version de PHP : 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gym`
--

-- --------------------------------------------------------

--
-- Structure de la table `abonnements`
--

CREATE TABLE `abonnements` (
  `num_ab` int(11) NOT NULL,
  `num_user` int(11) NOT NULL,
  `num_service` int(11) NOT NULL,
  `date_ab` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `abonnements`
--

INSERT INTO `abonnements` (`num_ab`, `num_user`, `num_service`, `date_ab`) VALUES
(2, 1, 3, '05/09/2020'),
(3, 1, 1, '05/09/2020'),
(4, 1, 2, '06/09/2020'),
(5, 2, 5, '06/09/2020'),
(6, 2, 4, '06/09/2020'),
(7, 2, 1, '06/09/2020'),
(8, 2, 3, '06/09/2020'),
(9, 3, 1, '06/09/2020'),
(10, 3, 4, '06/09/2020'),
(11, 3, 3, '06/09/2020'),
(12, 2, 6, '06/09/2020');

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `num_admin` int(11) NOT NULL,
  `nom_admin` varchar(30) NOT NULL,
  `pass_admin` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`num_admin`, `nom_admin`, `pass_admin`) VALUES
(1, 'Admin', '@dmin');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `num_msg` int(11) NOT NULL,
  `email_envoyeur` varchar(85) NOT NULL,
  `sujet` varchar(50) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`num_msg`, `email_envoyeur`, `sujet`, `message`) VALUES
(2, 'bilhonore@gmail.com', 'Plainte', 'Vos cours de Renforcements musculaires sont nuls à chier..Je me retire de votre club ');

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

CREATE TABLE `services` (
  `num_service` int(11) NOT NULL,
  `libelle_service` varchar(50) NOT NULL,
  `jours` varchar(50) NOT NULL,
  `heure` varchar(50) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`num_service`, `libelle_service`, `jours`, `heure`, `image`) VALUES
(1, 'Renforcement Musculaire', 'Chaque jour', '12h à 13h30', 'img/muscle_127px.png'),
(2, 'Elliptique', 'Chaque Lundi/Mardi', '9h à 11h00', 'img/ovality_sensor_127px.png'),
(3, 'Pilates', 'Chaque jour', '14h à 15h00', 'img/pilates_127px.png'),
(4, 'Tapis', 'Chaque Mercredi/Jeudi/Vendredi', '15h15 à 16h45', 'img/treadmill_127px.png'),
(5, 'Vélos', 'Chaque Jour', '17h à 18h45', 'img/stepper_127px.png'),
(7, 'Soulevé de terre', 'Chaque jour', '11h15 à 11h55', '../img/deadlift_127px.png');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `num_user` int(11) NOT NULL,
  `nom_user` varchar(35) NOT NULL,
  `prenoms_user` varchar(50) NOT NULL,
  `adr_mail` varchar(85) NOT NULL,
  `password_user` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`num_user`, `nom_user`, `prenoms_user`, `adr_mail`, `password_user`) VALUES
(1, 'Igodo', 'Saddat', 'saddat_12@gmail.com', '5895a7516acf342d2d9a29fb1f8abac0a0b3ba21'),
(2, 'Bernard', 'Aleck', 'aleckbernard9@gmail.com', 'fb3099d0eb4c3edfa0db61100342d1ebdfd8e479'),
(3, 'Segbe', 'Koffi Matthieu', 'mendona_mendo@gmail.com', '93c350b68b0b2c5a16ade03f5dbdd4044a5c0649');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `abonnements`
--
ALTER TABLE `abonnements`
  ADD PRIMARY KEY (`num_ab`),
  ADD KEY `FK_abonnements_utilisateurs` (`num_user`),
  ADD KEY `FK_abonnements_services` (`num_service`);

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`num_admin`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`num_msg`);

--
-- Index pour la table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`num_service`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`num_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `abonnements`
--
ALTER TABLE `abonnements`
  MODIFY `num_ab` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `num_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `num_msg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `services`
--
ALTER TABLE `services`
  MODIFY `num_service` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `num_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `abonnements`
--
ALTER TABLE `abonnements`
  ADD CONSTRAINT `FK_abonnements_utilisateurs` FOREIGN KEY (`num_user`) REFERENCES `utilisateurs` (`num_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
