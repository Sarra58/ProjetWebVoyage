-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 30 nov. 2024 à 20:14
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `blog`
--

CREATE TABLE `blog` (
  `id_con` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `contenu` varchar(255) NOT NULL,
  `categorie` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `blog`
--

INSERT INTO `blog` (`id_con`, `titre`, `contenu`, `categorie`, `image`) VALUES
(1, 'L\'Avenir de l\'Agriculture Durable', 'L\'agriculture durable repose sur l\'idée de produire de manière responsable, tout en préservant les ressources naturelles pour les générations futures. Elle vise à équilibrer les besoins alimentaires croissants avec la protection de la biodiversité, de l\'e', 'agricole', 'produits-agricoles.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id_com` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `contenu` text NOT NULL,
  `cons` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id_com`, `nom`, `contenu`, `cons`) VALUES
(40, 'khaoula', 'important', 1),
(41, 'achref', 'toop', 1),
(48, 'j', 'j', 1);

-- --------------------------------------------------------

--
-- Structure de la table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `id_con` int(11) NOT NULL,
  `likes` int(11) DEFAULT 0,
  `dislikes` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `votes`
--

INSERT INTO `votes` (`id`, `id_con`, `likes`, `dislikes`) VALUES
(24, 1, 1, 0),
(25, 1, 0, 1),
(26, 1, 1, 0),
(27, 1, 0, 1),
(28, 1, 1, 0),
(29, 1, 1, 0),
(30, 1, 0, 1),
(31, 1, 1, 0),
(32, 1, 1, 0),
(33, 1, 0, 1),
(34, 1, 1, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id_con`);

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id_com`),
  ADD KEY `fk_commentaire_blog` (`cons`);

--
-- Index pour la table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_con` (`id_con`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `blog`
--
ALTER TABLE `blog`
  MODIFY `id_con` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id_com` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT pour la table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `fk_commentaire_blog` FOREIGN KEY (`cons`) REFERENCES `blog` (`id_con`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`id_con`) REFERENCES `blog` (`id_con`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
