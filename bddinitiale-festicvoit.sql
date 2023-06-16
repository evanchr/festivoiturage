-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 16 juin 2023 à 17:36
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `festicovoit`
--

-- --------------------------------------------------------

--
-- Structure de la table `festival`
--

CREATE TABLE `festival` (
  `nom` varchar(35) NOT NULL,
  `dateDebut` date NOT NULL,
  `dateFin` date NOT NULL,
  `localisation` varchar(35) NOT NULL,
  `cheminPhoto` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `festival`
--

INSERT INTO `festival` (`nom`, `dateDebut`, `dateFin`, `localisation`, `cheminPhoto`) VALUES
('Delta Festival', '2023-08-23', '2023-08-27', 'Marseille (13)', 'Images/Delta.jpg'),
('Francofolies', '2023-07-12', '2023-07-16', 'La Rochelle (17)', 'Images/Francofolies.jpg'),
('Hellfest', '2023-06-15', '2023-06-18', 'Clisson (44)', 'Images/Hellfest.jpg'),
('Les Ardentes', '2023-07-06', '2023-07-09', 'Liège (Belgique)', 'Images/Ardentes.jpg'),
('Les Eurockéennes', '2023-06-29', '2023-07-02', 'Belfort (90)', 'Images/Eurockéennes.jpg'),
('Les Vieilles Charrues', '2023-07-13', '2023-07-17', 'Carhaix-Plouguer (29)', 'Images/LVC.jpg'),
('Printemps de Bourges', '2023-04-18', '2023-04-23', 'Bourges (18)', 'Images/PDB.jpg'),
('Solidays', '2023-06-23', '2023-06-25', 'Paris-Longchamp (75)', 'Images/Solidays.jpg'),
('Terres du son', '2023-07-07', '2023-07-09', 'Monts (37)', 'Images/TDS.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `festivalier`
--

CREATE TABLE `festivalier` (
  `id` int(11) NOT NULL,
  `nom` varchar(25) NOT NULL,
  `prenom` varchar(25) NOT NULL,
  `age` int(11) NOT NULL,
  `genre` varchar(10) NOT NULL,
  `festival` varchar(35) NOT NULL,
  `ville` varchar(30) NOT NULL,
  `dateAller` date NOT NULL,
  `dateRetour` date DEFAULT NULL,
  `description` text NOT NULL,
  `createur` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `festivalier`
--

INSERT INTO `festivalier` (`id`, `nom`, `prenom`, `age`, `genre`, `festival`, `ville`, `dateAller`, `dateRetour`, `description`, `createur`) VALUES
(8, 'Martin', 'Lisa', 25, 'Féminin', 'Francofolies', 'Rennes (35)', '2023-06-06', '2023-07-09', 'Salut c\'est Lisa ! Je poste cette annonce car j\'aimerai trouver quelqu\'un qui pourrait m\'emmener aux vieilles charrues   ', 'evan'),
(9, 'Moreau', 'Clément', 25, 'Masculin', 'Francofolies', 'Paris (75)', '2023-07-08', '2023-07-10', 'Je suis à la recherche d\'un véhicule en région parisienne afin de me rendre aux Francofolies. Je suis pret à partager les frais d\'essence et de péage si besoin', 'evan');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `nom` varchar(25) NOT NULL,
  `prenom` varchar(25) NOT NULL,
  `age` int(11) NOT NULL,
  `pseudo` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`nom`, `prenom`, `age`, `pseudo`, `password`, `admin`) VALUES
('charrier', 'evan', 20, 'evan', '1234', 1);

-- --------------------------------------------------------

--
-- Structure de la table `vehicule`
--

CREATE TABLE `vehicule` (
  `id` int(11) NOT NULL,
  `type` varchar(30) NOT NULL,
  `places` int(11) NOT NULL,
  `ville` varchar(25) NOT NULL,
  `festival` varchar(35) NOT NULL,
  `dateAller` date NOT NULL,
  `dateRetour` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `proprietaire` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `vehicule`
--

INSERT INTO `vehicule` (`id`, `type`, `places`, `ville`, `festival`, `dateAller`, `dateRetour`, `description`, `proprietaire`) VALUES
(3, 'Renault Clio V', 3, 'Paris (75)', 'Solidays', '2023-08-07', '0000-00-00', 'Je me rends seul à Solidays c\'est pourquoi je poste une annonce afin de compléter les 3 places vacantes ', 'evan'),
(5, 'Peugeot 308', 2, 'Toulouse (31)', 'Les Vieilles Charrues', '2023-06-06', '2023-06-09', 'bonjour je mets à disposition mon véhicules pour 2 personnes', 'evan');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `festival`
--
ALTER TABLE `festival`
  ADD PRIMARY KEY (`nom`);

--
-- Index pour la table `festivalier`
--
ALTER TABLE `festivalier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `festival` (`festival`) USING BTREE,
  ADD KEY `createur` (`createur`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`pseudo`);

--
-- Index pour la table `vehicule`
--
ALTER TABLE `vehicule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `festival` (`festival`),
  ADD KEY `appartient` (`proprietaire`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `festivalier`
--
ALTER TABLE `festivalier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `festivalier`
--
ALTER TABLE `festivalier`
  ADD CONSTRAINT `concerner` FOREIGN KEY (`festival`) REFERENCES `festival` (`nom`) ON DELETE CASCADE,
  ADD CONSTRAINT `creerPar` FOREIGN KEY (`createur`) REFERENCES `user` (`pseudo`) ON DELETE CASCADE;

--
-- Contraintes pour la table `vehicule`
--
ALTER TABLE `vehicule`
  ADD CONSTRAINT `appartient` FOREIGN KEY (`proprietaire`) REFERENCES `user` (`pseudo`) ON DELETE CASCADE,
  ADD CONSTRAINT `concerne` FOREIGN KEY (`festival`) REFERENCES `festival` (`nom`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
