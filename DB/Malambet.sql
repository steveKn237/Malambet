-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 05 juin 2024 à 12:13
-- Version du serveur : 10.6.16-MariaDB-0ubuntu0.22.04.1
-- Version de PHP : 8.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `Malambet`
--
CREATE DATABASE IF NOT EXISTS `Malambet` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `Malambet`;

-- --------------------------------------------------------

--
-- Structure de la table `Equipes`
--

CREATE TABLE `Equipes` (
  `EquipeID` int(11) NOT NULL,
  `NomEquipe` varchar(50) NOT NULL,
  `Acronyme` varchar(3) NOT NULL,
  `Logo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Equipes`
--

INSERT INTO `Equipes` (`EquipeID`, `NomEquipe`, `Acronyme`, `Logo`) VALUES
(1, 'FC Bayern München', 'BAY', 'img/BAY.png'),
(2, 'Real Madrid', 'RMA', 'img/RMA.png'),
(3, 'Olympique de Marseille', 'OM', 'img/OM.png'),
(4, 'Paris Saint Germin', 'PSG', 'img/PSG.png'),
(5, 'FC Barcelona', 'BAR', 'img/BAR.png'),
(6, 'Borussia Dortmund', 'BVB', 'img/BVB.png');

-- --------------------------------------------------------

--
-- Structure de la table `Ligue`
--

CREATE TABLE `Ligue` (
  `idLigue` int(11) NOT NULL,
  `nomLigue` varchar(100) NOT NULL,
  `Acronyme` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Ligue`
--

INSERT INTO `Ligue` (`idLigue`, `nomLigue`, `Acronyme`) VALUES
(1, 'Ligue Des Champions', 'LDC'),
(2, 'Ligue 1 Mcdonald\'s', 'L1'),
(3, 'Bundesliga', 'Bundes');

-- --------------------------------------------------------

--
-- Structure de la table `Matchs`
--

CREATE TABLE `Matchs` (
  `MatchID` int(11) NOT NULL,
  `EquipeID_domicile` int(11) DEFAULT NULL,
  `EquipeID_visiteur` int(11) DEFAULT NULL,
  `Date` datetime DEFAULT NULL,
  `idLigue` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Matchs`
--

INSERT INTO `Matchs` (`MatchID`, `EquipeID_domicile`, `EquipeID_visiteur`, `Date`, `idLigue`) VALUES
(2, 3, 2, '2024-05-22 21:00:00', 1),
(3, 1, 3, '2024-05-22 13:02:01', 1),
(4, 3, 4, '2024-05-22 19:00:00', 2),
(5, 1, 5, '2024-10-04 14:56:20', 1),
(6, 6, 1, '2024-06-27 14:00:42', 3);

-- --------------------------------------------------------

--
-- Structure de la table `Paris`
--

CREATE TABLE `Paris` (
  `ID_pari` int(11) NOT NULL,
  `UserPariID` int(11) DEFAULT NULL,
  `MatchPariID` int(11) DEFAULT NULL,
  `EquipeChoisie` int(11) DEFAULT NULL,
  `Montant_mise` decimal(10,2) DEFAULT NULL,
  `Cote` decimal(10,2) DEFAULT NULL,
  `Statut_pari` enum('en cours','gagné','perdu') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateurs`
--

CREATE TABLE `Utilisateurs` (
  `UserID` int(11) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Mdp_hash` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Equipes`
--
ALTER TABLE `Equipes`
  ADD PRIMARY KEY (`EquipeID`);

--
-- Index pour la table `Ligue`
--
ALTER TABLE `Ligue`
  ADD PRIMARY KEY (`idLigue`);

--
-- Index pour la table `Matchs`
--
ALTER TABLE `Matchs`
  ADD PRIMARY KEY (`MatchID`),
  ADD KEY `EquipeID_domicile` (`EquipeID_domicile`),
  ADD KEY `EquipeID_visiteur` (`EquipeID_visiteur`),
  ADD KEY `fk_idLigue` (`idLigue`);

--
-- Index pour la table `Paris`
--
ALTER TABLE `Paris`
  ADD PRIMARY KEY (`ID_pari`),
  ADD KEY `UserPariID` (`UserPariID`),
  ADD KEY `MatchPariID` (`MatchPariID`),
  ADD KEY `EquipeChoisie` (`EquipeChoisie`);

--
-- Index pour la table `Utilisateurs`
--
ALTER TABLE `Utilisateurs`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Equipes`
--
ALTER TABLE `Equipes`
  MODIFY `EquipeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `Ligue`
--
ALTER TABLE `Ligue`
  MODIFY `idLigue` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `Matchs`
--
ALTER TABLE `Matchs`
  MODIFY `MatchID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `Paris`
--
ALTER TABLE `Paris`
  MODIFY `ID_pari` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Utilisateurs`
--
ALTER TABLE `Utilisateurs`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Matchs`
--
ALTER TABLE `Matchs`
  ADD CONSTRAINT `Matchs_ibfk_1` FOREIGN KEY (`EquipeID_domicile`) REFERENCES `Equipes` (`EquipeID`),
  ADD CONSTRAINT `Matchs_ibfk_2` FOREIGN KEY (`EquipeID_visiteur`) REFERENCES `Equipes` (`EquipeID`),
  ADD CONSTRAINT `fk_idLigue` FOREIGN KEY (`idLigue`) REFERENCES `Ligue` (`idLigue`);

--
-- Contraintes pour la table `Paris`
--
ALTER TABLE `Paris`
  ADD CONSTRAINT `Paris_ibfk_1` FOREIGN KEY (`UserPariID`) REFERENCES `Utilisateurs` (`UserID`),
  ADD CONSTRAINT `Paris_ibfk_2` FOREIGN KEY (`MatchPariID`) REFERENCES `Matchs` (`MatchID`),
  ADD CONSTRAINT `Paris_ibfk_3` FOREIGN KEY (`EquipeChoisie`) REFERENCES `Equipes` (`EquipeID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
