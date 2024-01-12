-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 12 jan. 2024 à 11:29
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
-- Base de données : `mathindex`
--

-- --------------------------------------------------------

--
-- Structure de la table `classroom`
--

CREATE TABLE `classroom` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `classroom`
--

INSERT INTO `classroom` (`id`, `name`) VALUES
(61, 'Seconde'),
(62, 'Première'),
(63, 'Terminale');

-- --------------------------------------------------------

--
-- Structure de la table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `course`
--

INSERT INTO `course` (`id`, `name`) VALUES
(61, 'Mathématique'),
(62, 'Français'),
(63, 'Phisique');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20240111135610', '2024-01-11 14:56:15', 553);

-- --------------------------------------------------------

--
-- Structure de la table `exercise`
--

CREATE TABLE `exercise` (
  `id` int(11) NOT NULL,
  `course_id_id` int(11) NOT NULL,
  `classroom_id_id` int(11) NOT NULL,
  `thematic_id_id` int(11) NOT NULL,
  `origin_id_id` int(11) DEFAULT NULL,
  `exercice_file_id_id` int(11) NOT NULL,
  `correction_file_id_id` int(11) NOT NULL,
  `created_by_id_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `chapter` varchar(255) DEFAULT NULL,
  `keywords` longtext DEFAULT NULL,
  `difficulty` int(11) NOT NULL,
  `duration` double NOT NULL,
  `origin_name` varchar(255) DEFAULT NULL,
  `origin_information` longtext DEFAULT NULL,
  `proposed_by_type` varchar(255) DEFAULT NULL,
  `proposed_by_first_name` varchar(255) DEFAULT NULL,
  `proposed_by_last_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `exercise`
--

INSERT INTO `exercise` (`id`, `course_id_id`, `classroom_id_id`, `thematic_id_id`, `origin_id_id`, `exercice_file_id_id`, `correction_file_id_id`, `created_by_id_id`, `name`, `chapter`, `keywords`, `difficulty`, `duration`, `origin_name`, `origin_information`, `proposed_by_type`, `proposed_by_first_name`, `proposed_by_last_name`) VALUES
(1, 61, 61, 142, 42, 83, 82, 128, 'Exercice Maths Algèbre', 'Chapitre 1', 'algèbre', 5, 1, 'Manuel Maths', 'Page 12, 2ème paragraphe', 'Etudiant', 'Alexandre', 'Duchemin');

-- --------------------------------------------------------

--
-- Structure de la table `exercise_skill`
--

CREATE TABLE `exercise_skill` (
  `exercise_id` int(11) NOT NULL,
  `skill_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `file`
--

CREATE TABLE `file` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `original_name` varchar(255) NOT NULL,
  `extension` varchar(255) NOT NULL,
  `size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `file`
--

INSERT INTO `file` (`id`, `name`, `original_name`, `extension`, `size`) VALUES
(81, 'ExerciceMaths_Arithmétique.pdf', 'Exercice Arithmétique', 'pdf', 500),
(82, 'ExerciceMaths_Multiplication.docx', 'Exercice Multiplication', 'docx', 2),
(83, 'ExerciceMaths_Fonction_Dérivée.pdf', 'Exercice fonction dérivée', 'pdf', 800),
(84, 'ExerciceMaths_Variable.pdf', 'Exercie variable', 'pdf', 900);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `origin`
--

CREATE TABLE `origin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `origin`
--

INSERT INTO `origin` (`id`, `name`) VALUES
(41, 'Livre'),
(42, 'Manuel');

-- --------------------------------------------------------

--
-- Structure de la table `skill`
--

CREATE TABLE `skill` (
  `id` int(11) NOT NULL,
  `course_id_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `skill`
--

INSERT INTO `skill` (`id`, `course_id_id`, `name`) VALUES
(103, 63, 'Chercher'),
(104, 62, 'Modéliser'),
(105, 61, 'Représenter'),
(106, 63, 'Raisonner'),
(107, 63, 'Calculer'),
(108, 61, 'Communiquer');

-- --------------------------------------------------------

--
-- Structure de la table `thematic`
--

CREATE TABLE `thematic` (
  `id` int(11) NOT NULL,
  `course_id_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `thematic`
--

INSERT INTO `thematic` (`id`, `course_id_id`, `name`) VALUES
(137, 61, 'Arithmétique'),
(138, 61, 'Géométrie'),
(139, 62, 'Algèbre'),
(140, 62, 'Probabilités et statistiques'),
(141, 63, 'Fraction'),
(142, 62, 'Trigonométrie'),
(143, 63, 'Equation différentielle'),
(144, 63, 'Calcul vectoriel');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `last_name`, `first_name`, `role`, `password`) VALUES
(128, 'romain@gmail.com', 'Fernandes', 'Romain', 'Contributeur', 'motDePasse'),
(129, 'kilian.O@gmail.com', 'Oulekhiari', 'Kilian', 'Visiteur', 'password'),
(130, 'kilian.D@gmail.com', 'Deletraz', 'Kilian', 'Visiteur', '1234'),
(131, 'alexduduch77@gmail.com', 'Duchemin', 'Alexandre', 'Visiteur', '1234'),
(132, 'admin.@gmail@gmail.com', 'Admin_last_name', 'Admin_first_name', 'Administrateur', 'admin5678');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `classroom`
--
ALTER TABLE `classroom`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `exercise`
--
ALTER TABLE `exercise`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_AEDAD51C21B154DA` (`exercice_file_id_id`),
  ADD UNIQUE KEY `UNIQ_AEDAD51CC6EC65A9` (`correction_file_id_id`),
  ADD KEY `IDX_AEDAD51C96EF99BF` (`course_id_id`),
  ADD KEY `IDX_AEDAD51C13BB01DE` (`classroom_id_id`),
  ADD KEY `IDX_AEDAD51CFF174F9A` (`thematic_id_id`),
  ADD KEY `IDX_AEDAD51CC23E42B3` (`origin_id_id`),
  ADD KEY `IDX_AEDAD51C555BB088` (`created_by_id_id`);

--
-- Index pour la table `exercise_skill`
--
ALTER TABLE `exercise_skill`
  ADD PRIMARY KEY (`exercise_id`,`skill_id`),
  ADD KEY `IDX_7B0B13B5E934951A` (`exercise_id`),
  ADD KEY `IDX_7B0B13B55585C142` (`skill_id`);

--
-- Index pour la table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `origin`
--
ALTER TABLE `origin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `skill`
--
ALTER TABLE `skill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5E3DE47796EF99BF` (`course_id_id`);

--
-- Index pour la table `thematic`
--
ALTER TABLE `thematic`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7C1CDF7296EF99BF` (`course_id_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `classroom`
--
ALTER TABLE `classroom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT pour la table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT pour la table `exercise`
--
ALTER TABLE `exercise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `file`
--
ALTER TABLE `file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `origin`
--
ALTER TABLE `origin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT pour la table `skill`
--
ALTER TABLE `skill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT pour la table `thematic`
--
ALTER TABLE `thematic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `exercise`
--
ALTER TABLE `exercise`
  ADD CONSTRAINT `FK_AEDAD51C13BB01DE` FOREIGN KEY (`classroom_id_id`) REFERENCES `classroom` (`id`),
  ADD CONSTRAINT `FK_AEDAD51C21B154DA` FOREIGN KEY (`exercice_file_id_id`) REFERENCES `file` (`id`),
  ADD CONSTRAINT `FK_AEDAD51C555BB088` FOREIGN KEY (`created_by_id_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_AEDAD51C96EF99BF` FOREIGN KEY (`course_id_id`) REFERENCES `course` (`id`),
  ADD CONSTRAINT `FK_AEDAD51CC23E42B3` FOREIGN KEY (`origin_id_id`) REFERENCES `origin` (`id`),
  ADD CONSTRAINT `FK_AEDAD51CC6EC65A9` FOREIGN KEY (`correction_file_id_id`) REFERENCES `file` (`id`),
  ADD CONSTRAINT `FK_AEDAD51CFF174F9A` FOREIGN KEY (`thematic_id_id`) REFERENCES `thematic` (`id`);

--
-- Contraintes pour la table `exercise_skill`
--
ALTER TABLE `exercise_skill`
  ADD CONSTRAINT `FK_7B0B13B55585C142` FOREIGN KEY (`skill_id`) REFERENCES `skill` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_7B0B13B5E934951A` FOREIGN KEY (`exercise_id`) REFERENCES `exercise` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `skill`
--
ALTER TABLE `skill`
  ADD CONSTRAINT `FK_5E3DE47796EF99BF` FOREIGN KEY (`course_id_id`) REFERENCES `course` (`id`);

--
-- Contraintes pour la table `thematic`
--
ALTER TABLE `thematic`
  ADD CONSTRAINT `FK_7C1CDF7296EF99BF` FOREIGN KEY (`course_id_id`) REFERENCES `course` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
