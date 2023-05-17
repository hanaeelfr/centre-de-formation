-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 10 mai 2023 à 17:59
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `centre_formation`
--

-- --------------------------------------------------------

--
-- Structure de la table `aprenant`
--

CREATE TABLE `aprenant` (
  `id_aprenant` int(11) NOT NULL,
  `img` varchar(500) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `aprenant`
--

INSERT INTO `aprenant` (`id_aprenant`, `img`, `nom`, `prenom`, `email`, `password`) VALUES
(1, '', 'el fraihi', 'hanae', 'hanae.fraihi@gmail.com', 'bb1463f391b1b22cdb9540b033b90bb8'),
(2, '', 'merrah', 'zineb', 'zineb.merrah@gmail.com', 'b77fb1c7da34235978129b41f4a01407'),
(3, '', 'hanae', 'ayoub', 'ayoub-bakali@gmail.com', 'b62411a8678debc438ee3c8c22c52118'),
(4, '', 'mejdoubi', 'faima', 'fatima_mejdoubi@gmail.com', 'b62411a8678debc438ee3c8c22c52118'),
(5, '', 'khabali', 'hamid', 'hamid-khabali1@gmail.com', 'b62411a8678debc438ee3c8c22c52118'),
(6, '', 'achraf', 'jaouan', 'achraf.samia@gmail.com', 'b62411a8678debc438ee3c8c22c52118'),
(9, '', 'yassin', 'haj', 'yassin.haj12@gmail.com', 'b62411a8678debc438ee3c8c22c52118'),
(11, '', 'hanae', 'hanae', 'hanaemario@gmail.com', 'b62411a8678debc438ee3c8c22c52118'),
(12, '', 'test', 'test', 'test3@gmail.com', 'b62411a8678debc438ee3c8c22c52118');

-- --------------------------------------------------------

--
-- Structure de la table `aprenant_session`
--

CREATE TABLE `aprenant_session` (
  `id_aprenant` int(50) NOT NULL,
  `id_session` int(50) NOT NULL,
  `resultat` varchar(50) DEFAULT NULL,
  `date_validation` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `aprenant_session`
--

INSERT INTO `aprenant_session` (`id_aprenant`, `id_session`, `resultat`, `date_validation`) VALUES
(1, 5, NULL, NULL),
(6, 3, NULL, NULL),
(11, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `formateur`
--

CREATE TABLE `formateur` (
  `id_formateur` int(11) NOT NULL,
  `nom` varchar(25) NOT NULL,
  `prenom` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `formateur`
--

INSERT INTO `formateur` (`id_formateur`, `nom`, `prenom`, `email`, `password`) VALUES
(1, 'chaba', 'fouad', 'fouad-chaba@gmail.com', 'fouadCHABA100'),
(2, 'ghaylan', 'ahemd', 'ahemd_ghaylan@gmail.com', 'ghaylanahemd09'),
(3, 'thami', 'souad', 'souad.thami@gmail.com', 'thamiSOUAD'),
(4, 'bakhat', 'chaimae', 'chaimae_bakhat@gmail.com', 'bakhatCHAIMAE'),
(5, 'wazani', 'mohamed', 'mohamed-wazani@gmail.com', 'mohamedWAZANI');

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

CREATE TABLE `formation` (
  `id_formation` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `sujet` varchar(50) NOT NULL,
  `catégorie` varchar(50) NOT NULL,
  `masse_horaire` varchar(30) NOT NULL,
  `description` varchar(690) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `formation`
--

INSERT INTO `formation` (`id_formation`, `image`, `sujet`, `catégorie`, `masse_horaire`, `description`) VALUES
(1, 'Gestion.jpg', 'Introduction à la gestion de projet', 'Gestion de projet', '40', 'Cette formation permet aux participants de comprendre les fondamentaux de la gestion de projet et de mettre en place des processus efficaces'),
(2, 'français.jpg', 'Language', 'Langues', '60', 'Cette formation est conçue pour les débutants qui souhaitent apprendre les bases de la langue française.'),
(3, 'excel1.png', 'Excel avancé pour les professionnels', 'Informatique', '30', 'Cette formation sadresse aux professionnels qui souhaitent améliorer leur utilisation dExcel pour des tâches avancées, telles que lanalyse de données.'),
(4, 'soft.jpg', 'Communication professionnelle', 'Communication', '50', 'Cette formation enseigne les compétences clés de communication nécessaires pour réussir dans un environnement professionnel.'),
(5, 'ressources.jpg', 'Gestion des ressources humaines', 'Ressources humaines', '70', 'Cette formation couvre les concepts de base de la gestion des ressources humaines, y compris le recrutement, la formation et le développement, la rémunération et les avantages sociaux.');

-- --------------------------------------------------------

--
-- Structure de la table `session`
--

CREATE TABLE `session` (
  `id_session` int(11) NOT NULL,
  `date_début` date NOT NULL,
  `date_fin` date NOT NULL,
  `place_max` int(11) NOT NULL,
  `etat` varchar(20) NOT NULL,
  `id_formation` int(11) NOT NULL,
  `id_formateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `session`
--

INSERT INTO `session` (`id_session`, `date_début`, `date_fin`, `place_max`, `etat`, `id_formation`, `id_formateur`) VALUES
(1, '2023-03-05', '2023-05-23', 18, 'en cours', 1, 3),
(2, '2023-04-06', '2023-05-27', 15, 'en cours dinscriptio', 2, 4),
(3, '2023-06-01', '2023-06-30', 20, 'cloturée', 5, 2),
(4, '2023-06-15', '2023-07-29', 15, ' inscription achevée', 2, 2),
(5, '2023-07-01', '2023-07-29', 25, 'annulé', 4, 5),
(6, '2023-07-02', '2023-08-15', 25, 'en cours', 3, 5);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `aprenant`
--
ALTER TABLE `aprenant`
  ADD PRIMARY KEY (`id_aprenant`);

--
-- Index pour la table `aprenant_session`
--
ALTER TABLE `aprenant_session`
  ADD PRIMARY KEY (`id_aprenant`,`id_session`),
  ADD KEY `id_session` (`id_session`);

--
-- Index pour la table `formateur`
--
ALTER TABLE `formateur`
  ADD PRIMARY KEY (`id_formateur`);

--
-- Index pour la table `formation`
--
ALTER TABLE `formation`
  ADD PRIMARY KEY (`id_formation`);

--
-- Index pour la table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id_session`),
  ADD KEY `id_formation` (`id_formation`),
  ADD KEY `id_formateur` (`id_formateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `aprenant`
--
ALTER TABLE `aprenant`
  MODIFY `id_aprenant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `formateur`
--
ALTER TABLE `formateur`
  MODIFY `id_formateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `formation`
--
ALTER TABLE `formation`
  MODIFY `id_formation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `session`
--
ALTER TABLE `session`
  MODIFY `id_session` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `session_ibfk_1` FOREIGN KEY (`id_formation`) REFERENCES `formation` (`id_formation`),
  ADD CONSTRAINT `session_ibfk_2` FOREIGN KEY (`id_formateur`) REFERENCES `formateur` (`id_formateur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
