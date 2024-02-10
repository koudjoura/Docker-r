-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 28 nov. 2023 à 00:54
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestionstock`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `nom_article` varchar(30) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix_unitaire` int(11) NOT NULL,
  `date_fabrication` date NOT NULL,
  `date_expiration` date NOT NULL,
  `images` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `nom_article`, `id_categorie`, `quantite`, `prix_unitaire`, `date_fabrication`, `date_expiration`, `images`) VALUES
(6, 'Mac Book Air', 1, 33, 400000, '2022-10-17', '2028-06-17', NULL),
(7, 'Hp', 1, 1, 300000, '2023-11-21', '2029-02-17', NULL),
(8, 'DELL LATIUDE', 1, 12, 200000, '2023-11-01', '2026-09-26', NULL),
(9, 'Kits LG', 3, 12, 1200, '2023-11-01', '2024-08-02', NULL),
(10, 'Iphone 13', 2, 12, 500000, '2021-06-25', '2027-10-25', NULL),
(11, 'Télécommande', 6, 12, 3000, '2023-10-30', '2027-11-25', '../public/images/12.PNG');

-- --------------------------------------------------------

--
-- Structure de la table `categorie_article`
--

CREATE TABLE `categorie_article` (
  `id` int(11) NOT NULL,
  `libelle_categorie` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categorie_article`
--

INSERT INTO `categorie_article` (`id`, `libelle_categorie`) VALUES
(1, 'Ordinateur'),
(2, 'Telephone'),
(3, 'Ecouteur'),
(4, 'Chargeur'),
(5, 'Imprimante'),
(6, 'Casque'),
(7, 'Bic'),
(8, 'Ancre');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `telephone` varchar(30) NOT NULL,
  `adresse` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `nom`, `prenom`, `telephone`, `adresse`) VALUES
(1, 'Dadi ', 'Moussa', '+221785276885', 'fass'),
(2, 'Moussa', 'Issa', '+221785276885', 'fass'),
(3, 'ISSA', 'Brahim', '+221785276885', 'Medina'),
(4, 'Mht', 'Moussa', '+221780187701', 'Fass Paillotte'),
(5, 'Dady', 'Houno', '+221785276885', 'fass');

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `id` int(11) NOT NULL,
  `id_articles` int(11) NOT NULL,
  `id_fournisseurs` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix` int(11) NOT NULL,
  `date_commande` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`id`, `id_articles`, `id_fournisseurs`, `quantite`, `prix`, `date_commande`) VALUES
(1, 6, 1, 2, 800000, '2023-11-23 12:47:33'),
(2, 7, 1, 2, 600000, '2023-11-23 13:15:30'),
(3, 6, 1, 12, 4800000, '2023-11-23 13:15:49');

-- --------------------------------------------------------

--
-- Structure de la table `fournisseurs`
--

CREATE TABLE `fournisseurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `telephone` varchar(30) NOT NULL,
  `adresse` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `fournisseurs`
--

INSERT INTO `fournisseurs` (`id`, `nom`, `prenom`, `telephone`, `adresse`) VALUES
(1, 'Mht ', 'Oki', '+221 780187701', 'Fass Paillotte'),
(2, 'Kamis', 'Djeroua', '+221785276885', 'Medina'),
(3, 'ISSA', 'Tergouri', '+221785276885', 'Medina'),
(4, 'AHMAT', 'Tahir', '+221780187701', 'Fass Paillotte');

-- --------------------------------------------------------

--
-- Structure de la table `ventes`
--

CREATE TABLE `ventes` (
  `id` int(11) NOT NULL,
  `id_articles` int(11) NOT NULL,
  `id_clients` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix` int(11) NOT NULL,
  `date_vente` datetime NOT NULL DEFAULT current_timestamp(),
  `etat` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ventes`
--

INSERT INTO `ventes` (`id`, `id_articles`, `id_clients`, `quantite`, `prix`, `date_vente`, `etat`) VALUES
(1, 6, 1, 1, 400000, '2023-11-17 17:04:51', '0'),
(2, 6, 1, 1, 400000, '2023-11-17 17:06:52', '0'),
(3, 6, 3, 2, 800000, '2023-11-17 17:43:06', '0'),
(4, 7, 1, 3, 900000, '2023-11-17 17:44:50', '0'),
(5, 8, 2, 2, 400000, '2023-11-22 15:39:41', '0'),
(6, 6, 1, 3, 1200000, '2023-11-22 16:38:07', '0'),
(7, 7, 2, 2, 600000, '2023-11-22 16:38:18', '0'),
(8, 6, 3, 5, 2000000, '2023-11-22 16:38:30', '0'),
(9, 7, 2, 4, 1200000, '2023-11-23 13:19:44', '1'),
(10, 9, 1, 10, 12000, '2023-11-23 13:34:05', '0'),
(11, 7, 1, 1, 300000, '2023-11-23 13:41:27', '1'),
(12, 9, 3, 111, 133200, '2023-11-23 13:41:48', '1'),
(13, 6, 2, 10, 4000000, '2023-11-23 13:47:04', '1'),
(14, 6, 1, 12, 4800000, '2023-11-23 13:47:35', '1');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categorie` (`id_categorie`);

--
-- Index pour la table `categorie_article`
--
ALTER TABLE `categorie_article`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_articles` (`id_articles`),
  ADD KEY `id_fournisseurs` (`id_fournisseurs`);

--
-- Index pour la table `fournisseurs`
--
ALTER TABLE `fournisseurs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ventes`
--
ALTER TABLE `ventes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_articles` (`id_articles`),
  ADD KEY `id_clients` (`id_clients`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `categorie_article`
--
ALTER TABLE `categorie_article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `fournisseurs`
--
ALTER TABLE `fournisseurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `ventes`
--
ALTER TABLE `ventes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `commandes_ibfk_1` FOREIGN KEY (`id_articles`) REFERENCES `articles` (`id`),
  ADD CONSTRAINT `commandes_ibfk_2` FOREIGN KEY (`id_fournisseurs`) REFERENCES `fournisseurs` (`id`);

--
-- Contraintes pour la table `ventes`
--
ALTER TABLE `ventes`
  ADD CONSTRAINT `ventes_ibfk_1` FOREIGN KEY (`id_articles`) REFERENCES `articles` (`id`),
  ADD CONSTRAINT `ventes_ibfk_2` FOREIGN KEY (`id_clients`) REFERENCES `clients` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
