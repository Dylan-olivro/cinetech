-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 09 mai 2023 à 12:15
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cinetech`
--

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `commentaire` text NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_media` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `commentaire`, `id_user`, `id_media`, `date`) VALUES
(77, 'test de commentaire', 2, 772071, '2023-05-04 22:19:40'),
(78, 'kjdksjsk', 2, 772071, '2023-05-04 22:19:44'),
(79, 'kjdksjsk', 2, 772071, '2023-05-04 22:22:04'),
(80, 'cdfkldfdlf', 2, 1222995, '2023-05-04 22:35:06'),
(81, 'commentaire', 2, 238, '2023-05-05 02:19:01'),
(82, 'ksdjsskjd', 2, 238, '2023-05-05 02:25:21'),
(83, 'sfgsfdsfs', 2, 429351, '2023-05-05 12:33:30'),
(84, 'sdfsdfs', 2, 429351, '2023-05-05 12:33:37');

-- --------------------------------------------------------

--
-- Structure de la table `favoris`
--

CREATE TABLE `favoris` (
  `id` int(11) NOT NULL,
  `id_media` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `favoris`
--

INSERT INTO `favoris` (`id`, `id_media`, `id_user`, `type`) VALUES
(25, 1396, 2, 'tv'),
(50, 776821, 2, 'movie'),
(61, 278, 2, 'movie'),
(63, 238, 2, 'movie'),
(64, 804150, 2, 'movie'),
(65, 37854, 2, 'tv');

-- --------------------------------------------------------

--
-- Structure de la table `liaison_comment`
--

CREATE TABLE `liaison_comment` (
  `id` int(11) NOT NULL,
  `id_comment` int(11) NOT NULL,
  `id_parent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `liaison_comment`
--

INSERT INTO `liaison_comment` (`id`, `id_comment`, `id_parent`) VALUES
(1, 1, 0),
(2, 27, 26),
(3, 28, 26),
(4, 29, 26),
(5, 30, 26),
(6, 31, 26),
(7, 32, 26),
(8, 33, 26),
(9, 34, 26),
(10, 35, 26),
(11, 36, 26),
(12, 37, 26),
(13, 38, 26),
(14, 39, 26),
(15, 40, 26),
(16, 41, 26),
(17, 44, 31),
(18, 45, 31),
(19, 46, 31),
(20, 47, 31),
(21, 48, 31),
(22, 49, 31),
(23, 50, 31),
(24, 51, 31),
(25, 52, 31),
(26, 53, 31),
(27, 54, 31),
(28, 55, 31),
(29, 56, 31),
(30, 57, 31),
(31, 58, 31),
(32, 59, 31),
(33, 60, 31),
(34, 61, 31),
(35, 63, 62),
(38, 66, 62),
(39, 67, 62),
(40, 1, 68),
(41, 2, 68),
(42, 3, 70),
(43, 4, 70),
(44, 5, 71),
(45, 6, 71),
(46, 7, 72),
(47, 8, 72),
(48, 9, 72),
(49, 10, 73),
(50, 11, 73),
(51, 12, 73),
(52, 13, 70),
(53, 14, 74),
(54, 15, 74),
(55, 16, 75),
(56, 17, 77),
(57, 18, 78),
(58, 19, 78),
(59, 20, 81),
(60, 21, 82),
(61, 22, 84);

-- --------------------------------------------------------

--
-- Structure de la table `responses`
--

CREATE TABLE `responses` (
  `id` int(11) NOT NULL,
  `response` text NOT NULL,
  `date` datetime NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `responses`
--

INSERT INTO `responses` (`id`, `response`, `date`, `id_user`) VALUES
(1, '', '0000-00-00 00:00:00', 2),
(2, 'deuxieme reponse', '0000-00-00 00:00:00', 2),
(3, '1ere reponse du 1er commentaire', '0000-00-00 00:00:00', 2),
(4, 'deuxieme reponse du premier commentaire', '0000-00-00 00:00:00', 2),
(5, '1ere reponse du 2eme commentaire', '0000-00-00 00:00:00', 2),
(6, '1ere reponse du 2eme commentaire', '0000-00-00 00:00:00', 2),
(7, 'REPONSE', '0000-00-00 00:00:00', 2),
(8, 'REPONSE', '0000-00-00 00:00:00', 2),
(9, 'REPONSE', '0000-00-00 00:00:00', 2),
(10, 'REPONSE 2', '0000-00-00 00:00:00', 2),
(11, 'REPONSE 3', '0000-00-00 00:00:00', 2),
(12, 'REPONSE 3', '0000-00-00 00:00:00', 2),
(13, '3eme reponse', '0000-00-00 00:00:00', 2),
(14, '', '0000-00-00 00:00:00', 2),
(15, 'ok2', '0000-00-00 00:00:00', 2),
(16, 'testé', '0000-00-00 00:00:00', 2),
(17, '', '2023-05-04 22:28:23', 2),
(18, 'kdsksdjksjdskjdskdjs', '2023-05-04 22:28:32', 2),
(19, 'skjskdjsdksjd', '2023-05-04 22:29:24', 2),
(20, 'reponse', '2023-05-05 02:19:08', 2),
(21, '', '2023-05-05 02:31:07', 2),
(22, 'fsdfsdf', '2023-05-05 12:33:43', 2);

-- --------------------------------------------------------

--
-- Structure de la table `testcomment`
--

CREATE TABLE `testcomment` (
  `id` int(11) NOT NULL,
  `commentaire` text NOT NULL,
  `id_media` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_parent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`) VALUES
(1, 'dylan', 'dylan@laplateforme.io', '$2y$10$2R4HuyeuB.Qsa6U1kvXsG.9dR/xOaDGNkfMcMYPCe1mA79YSedNyu', 2),
(2, 'admin', 'admin@laplateforme.io', '$2y$10$reVX08ta9Ya1vBho9aTPUuI2yAlUSWEauYR27g1clZ/Ftzit/haqS', 2),
(3, 'modo', 'modo@laplateforme.io', '$2y$10$253vyp.kbXYB4i0axv99C.rEWPqLwYmLftALS3XMgcKMKpP0rWgGW', 1),
(4, 'user1', 'user1@laplateforme.io', '$2y$10$rBX1.e1EJ9xOXRfB6JsKPeUToFp3YnNH4yUgMVSioYcoEZ4GzEY7u', 0),
(5, 'user2', 'user2@laplateforme.io', '$2y$10$PHVpx03CJ17BGAI4YnzeIezh4l4m3qwBH.RY/XPJRmvraH8vHIupW', 0),
(6, 'John', 'john@john.com', '$2y$10$K9Tw1DuduwP7uaUulkL91urGJkYAgnvkgHshnj506C/umgOLHzOy2', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `favoris`
--
ALTER TABLE `favoris`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `liaison_comment`
--
ALTER TABLE `liaison_comment`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `responses`
--
ALTER TABLE `responses`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `testcomment`
--
ALTER TABLE `testcomment`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT pour la table `favoris`
--
ALTER TABLE `favoris`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT pour la table `liaison_comment`
--
ALTER TABLE `liaison_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT pour la table `responses`
--
ALTER TABLE `responses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `testcomment`
--
ALTER TABLE `testcomment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
