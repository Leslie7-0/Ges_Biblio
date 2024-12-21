-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 21 déc. 2024 à 23:45
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ges_bibliotheque`
--

-- --------------------------------------------------------

--
-- Structure de la table `bibliothecaire`
--

CREATE TABLE `bibliothecaire` (
  `id_biblio` int(11) NOT NULL,
  `nom_biblio` varchar(100) DEFAULT NULL,
  `prenom_biblio` varchar(100) DEFAULT NULL,
  `email_biblio` varchar(100) DEFAULT NULL,
  `tel_biblio` int(11) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `bibliothecaire`
--

INSERT INTO `bibliothecaire` (`id_biblio`, `nom_biblio`, `prenom_biblio`, `email_biblio`, `tel_biblio`, `password`) VALUES
(1, 'kakeu', 'leslie', 'leslie@gmail.com', 694414917, '123'),
(2, 'mekouo', 'abigaelle', 'abi@gmail.com', 697598741, '345'),
(3, 'mapo', 'andrade', 'andrade@gmail.com', 698745675, '123');

-- --------------------------------------------------------

--
-- Structure de la table `emprunts`
--

CREATE TABLE `emprunts` (
  `id_emprunt` int(11) NOT NULL,
  `id_membre` int(11) DEFAULT NULL,
  `id_oeuvre` int(11) DEFAULT NULL,
  `date_emprunt` date DEFAULT NULL,
  `date_retour` date DEFAULT NULL,
  `limit_emprunt` int(11) NOT NULL DEFAULT 1,
  `nom_membre` varchar(255) NOT NULL,
  `prenom_membre` varchar(255) DEFAULT NULL,
  `email_membre` varchar(255) DEFAULT NULL,
  `titre_oeuvre` varchar(255) DEFAULT NULL,
  `auteur_oeuvre` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `emprunts`
--

INSERT INTO `emprunts` (`id_emprunt`, `id_membre`, `id_oeuvre`, `date_emprunt`, `date_retour`, `limit_emprunt`, `nom_membre`, `prenom_membre`, `email_membre`, `titre_oeuvre`, `auteur_oeuvre`) VALUES
(11, 1, 9, '2024-12-13', '2024-12-22', 10, '', 'leslie', 'leslie@gmail.com', '', 'reword brith'),
(12, 3, 7, '2024-12-13', '2024-12-23', 7, '', 'Joel', 'daniel@gmail.com', '', 'Louis de finess'),
(13, 1, 8, '2024-12-13', '2024-12-22', 5, '', 'leslie', 'leslie@gmail.com', '', 'Densi Lagel'),
(14, 5, 10, '2024-12-11', '2024-12-21', 4, '', 'victor', 'dev@gmail.com', '', 'Robert GIMS'),
(15, 9, 11, '2024-12-14', '2024-12-22', 5, '', 'rachel', 'rachel@gmail.com', '', 'Tom\'s'),
(17, 11, 13, '2024-12-18', '2024-12-23', 2, '', 'Divane', 'divane@gmail.com', '', 'Beans sthon');

-- --------------------------------------------------------

--
-- Structure de la table `exemplaires`
--

CREATE TABLE `exemplaires` (
  `id_exemplaire` int(11) NOT NULL,
  `id_oeuvre` int(11) DEFAULT NULL,
  `nom_exemplaire` varchar(100) NOT NULL,
  `email_membre` varchar(100) DEFAULT NULL,
  `nombre_exemplaires` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

CREATE TABLE `membres` (
  `id_membre` int(11) NOT NULL,
  `matricule_membre` varchar(10) NOT NULL,
  `nom_membre` varchar(100) NOT NULL,
  `prenom_membre` varchar(100) NOT NULL,
  `sexe` varchar(1) NOT NULL,
  `email_membre` varchar(100) NOT NULL,
  `tel_membre` int(11) NOT NULL,
  `statut` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `membres`
--

INSERT INTO `membres` (`id_membre`, `matricule_membre`, `nom_membre`, `prenom_membre`, `sexe`, `email_membre`, `tel_membre`, `statut`) VALUES
(1, '24B2042', 'kakeu', 'leslie', 'F', 'leslie@gmail.com', 654789621, 'Etudiant'),
(3, '24B2044', 'Tatsinkou', 'Joel', 'M', 'daniel@gmail.com', 697854231, 'Etudiant'),
(5, '24B2046', 'Fotso', 'victor', 'M', 'dev@gmail.com', 65999623, 'Etudiant'),
(8, 'H5677', 'Mapo', 'Andrade', 'F', 'mapo@gmail.com', 659996238, 'Enseignant'),
(9, 'J9754', 'Atchouki', 'rachel', 'F', 'rachel@gmail.com', 689754213, 'Etudiant'),
(11, 'S5413', 'Tsiemi', 'Divane', 'M', 'divane@gmail.com', 698754213, 'Enseignant'),
(13, 'W3023', 'qwert', 'asdfghj', 'M', 'daniel@gmail.com', 234567, 'Enseignant'),
(18, 'W2662', 'DEMON', 'ScorpioDEV', 'F', 'S@gmail.com', 8998569, 'Etudiant');

-- --------------------------------------------------------

--
-- Structure de la table `oeuvres`
--

CREATE TABLE `oeuvres` (
  `id_oeuvre` int(11) NOT NULL,
  `titre_oeuvre` varchar(100) DEFAULT NULL,
  `auteur_oeuvre` varchar(100) DEFAULT NULL,
  `statut_oeuvre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `oeuvres`
--

INSERT INTO `oeuvres` (`id_oeuvre`, `titre_oeuvre`, `auteur_oeuvre`, `statut_oeuvre`) VALUES
(7, 'The cuser', 'Louis de finess', 'Disponible'),
(8, 'Wags', 'Densi Lagel', 'Emprunté'),
(9, 'Restart', 'reword brith', 'Disponible'),
(10, 'IA et Ressource ', 'Robert GIMS', 'Disponible'),
(11, 'The darkwark ', 'Tom\'s', 'Disponible'),
(13, 'Rollers', 'Beans sthon', 'Disponible'),
(17, 'Trahison', 'DevMK', 'Disponible'),
(18, 'Vengeance', 'Devil', 'Disponible');

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `id_reservation` int(11) NOT NULL,
  `id_membre` int(11) DEFAULT NULL,
  `id_oeuvre` int(11) DEFAULT NULL,
  `date_reservation` date DEFAULT NULL,
  `nom_membre` varchar(255) NOT NULL,
  `prenom_membre` varchar(255) NOT NULL,
  `email_membre` varchar(255) NOT NULL,
  `titre_oeuvre` varchar(255) NOT NULL,
  `auteur_oeuvre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`id_reservation`, `id_membre`, `id_oeuvre`, `date_reservation`, `nom_membre`, `prenom_membre`, `email_membre`, `titre_oeuvre`, `auteur_oeuvre`) VALUES
(2, 5, 11, '2024-12-18', '', 'victor', 'dev@gmail.com', '', 'Tom\'s'),
(3, 1, 7, '2024-12-19', 'kakeu', 'leslie', 'leslie@gmail.com', 'The cuser', 'Louis de finess'),
(4, 8, 10, '2024-12-19', 'Mapo', 'Andrade', 'mapo@gmail.com', 'IA et Ressource ', 'Robert GIMS');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bibliothecaire`
--
ALTER TABLE `bibliothecaire`
  ADD PRIMARY KEY (`id_biblio`);

--
-- Index pour la table `emprunts`
--
ALTER TABLE `emprunts`
  ADD PRIMARY KEY (`id_emprunt`),
  ADD KEY `fk_emprunt_membre` (`id_membre`),
  ADD KEY `fk_emprunt_oeuvre` (`id_oeuvre`);

--
-- Index pour la table `exemplaires`
--
ALTER TABLE `exemplaires`
  ADD PRIMARY KEY (`id_exemplaire`),
  ADD KEY `fk_id_oeuvre` (`id_oeuvre`);

--
-- Index pour la table `membres`
--
ALTER TABLE `membres`
  ADD PRIMARY KEY (`id_membre`);

--
-- Index pour la table `oeuvres`
--
ALTER TABLE `oeuvres`
  ADD PRIMARY KEY (`id_oeuvre`);

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id_reservation`),
  ADD KEY `fk_reservation_membre` (`id_membre`),
  ADD KEY `fk_reservation_oeuvre` (`id_oeuvre`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `bibliothecaire`
--
ALTER TABLE `bibliothecaire`
  MODIFY `id_biblio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `emprunts`
--
ALTER TABLE `emprunts`
  MODIFY `id_emprunt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `exemplaires`
--
ALTER TABLE `exemplaires`
  MODIFY `id_exemplaire` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `membres`
--
ALTER TABLE `membres`
  MODIFY `id_membre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `oeuvres`
--
ALTER TABLE `oeuvres`
  MODIFY `id_oeuvre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id_reservation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `emprunts`
--
ALTER TABLE `emprunts`
  ADD CONSTRAINT `fk_emprunt_membre` FOREIGN KEY (`id_membre`) REFERENCES `membres` (`id_membre`),
  ADD CONSTRAINT `fk_emprunt_oeuvre` FOREIGN KEY (`id_oeuvre`) REFERENCES `oeuvres` (`id_oeuvre`);

--
-- Contraintes pour la table `exemplaires`
--
ALTER TABLE `exemplaires`
  ADD CONSTRAINT `fk_id_oeuvre` FOREIGN KEY (`id_oeuvre`) REFERENCES `oeuvres` (`id_oeuvre`);

--
-- Contraintes pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `fk_reservation_membre` FOREIGN KEY (`id_membre`) REFERENCES `membres` (`id_membre`),
  ADD CONSTRAINT `fk_reservation_oeuvre` FOREIGN KEY (`id_oeuvre`) REFERENCES `oeuvres` (`id_oeuvre`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
