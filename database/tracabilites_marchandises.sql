-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 10 mars 2026 à 21:14
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tracabilites_marchandises`
--

-- --------------------------------------------------------

--
-- Structure de la table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('trace-marchandise-cache-5c95211a90b1297ef8744740e977d6f3', 'i:1;', 1773164173),
('trace-marchandise-cache-5c95211a90b1297ef8744740e977d6f3:timer', 'i:1773164173;', 1773164173),
('trace-marchandise-cache-bc89a681d4ceea0f12ee82c14f216b15', 'i:1;', 1773164282),
('trace-marchandise-cache-bc89a681d4ceea0f12ee82c14f216b15:timer', 'i:1773164282;', 1773164282),
('trace-marchandise-cache-ecd71e17e62096243afa5af71391ea86', 'i:1;', 1773165370),
('trace-marchandise-cache-ecd71e17e62096243afa5af71391ea86:timer', 'i:1773165370;', 1773165370);

-- --------------------------------------------------------

--
-- Structure de la table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `documents`
--

CREATE TABLE `documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `marchandise_id` bigint(20) UNSIGNED NOT NULL,
  `nom_fichier` varchar(255) NOT NULL,
  `chemin_fichier` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `documents`
--

INSERT INTO `documents` (`id`, `marchandise_id`, `nom_fichier`, `chemin_fichier`, `created_at`, `updated_at`) VALUES
(1, 1, 'statistiques-eagle-tech-1768586359982.pdf', 'documents/1773089937_statistiques-eagle-tech-1768586359982.pdf', '2026-03-09 18:58:59', '2026-03-09 18:58:59'),
(2, 2, 'TP ADMINISTRATION DES RX INFORMATIQUES_260210_150624.pdf', 'documents/1773095638_TP ADMINISTRATION DES RX INFORMATIQUES_260210_150624.pdf', '2026-03-09 20:33:58', '2026-03-09 20:33:58'),
(3, 3, 'uplPlan.png', 'documents/1773150908_uplPlan.png', '2026-03-10 11:55:08', '2026-03-10 11:55:08'),
(4, 4, '20240117_132510.jpg', 'documents/1773151950_20240117_132510.jpg', '2026-03-10 12:12:30', '2026-03-10 12:12:30');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `historiques`
--

CREATE TABLE `historiques` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `marchandise_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `action` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `historiques`
--

INSERT INTO `historiques` (`id`, `marchandise_id`, `user_id`, `action`, `created_at`, `updated_at`) VALUES
(1, 3, 2, 'Enregistrement initial de la marchandise.', '2026-03-10 11:55:08', '2026-03-10 11:55:08'),
(2, 3, 2, 'Mise à jour des informations par l\'agent.', '2026-03-10 11:56:34', '2026-03-10 11:56:34'),
(3, 3, 3, 'Changement de statut : de [EN ATTENTE] vers [EN CONTRôLE].', '2026-03-10 11:57:37', '2026-03-10 11:57:37'),
(4, 4, 2, 'Enregistrement initial de la marchandise.', '2026-03-10 12:12:30', '2026-03-10 12:12:30'),
(5, 4, 3, 'Changement de statut : de [EN ATTENTE] vers [EN ATTENTE].', '2026-03-10 12:25:57', '2026-03-10 12:25:57'),
(6, 4, 3, 'Changement de statut : de [EN ATTENTE] vers [VALIDéE].', '2026-03-10 12:26:13', '2026-03-10 12:26:13'),
(7, 4, 3, 'Changement de statut : de [VALIDéE] vers [BLOQUéE].', '2026-03-10 12:26:48', '2026-03-10 12:26:48'),
(8, 3, 3, 'Changement de statut : de [EN CONTRôLE] vers [VALIDéE].', '2026-03-10 15:36:54', '2026-03-10 15:36:54'),
(9, 3, 3, 'Changement de statut : de [VALIDéE] vers [BLOQUéE].', '2026-03-10 15:56:12', '2026-03-10 15:56:12');

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `marchandises`
--

CREATE TABLE `marchandises` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reference` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `importateur` varchar(255) NOT NULL,
  `statut` enum('en attente','en contrôle','validée','bloquée') NOT NULL DEFAULT 'en attente',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `marchandises`
--

INSERT INTO `marchandises` (`id`, `reference`, `description`, `importateur`, `statut`, `created_at`, `updated_at`) VALUES
(1, '001', 'les boutelles des jus venant de Tanzanie', 'COLLETTE MUSWAMBA', 'bloquée', '2026-03-09 18:58:57', '2026-03-09 20:39:39'),
(2, '002', 'les marchandise nous vient du zambie des marchandises agronomique pour la plantation', 'RAPHAEL TSHOMBA', 'validée', '2026-03-09 20:33:58', '2026-03-09 20:37:13'),
(3, '2026-003', 'marchandise a vendre venant de la kenya des vetement poule', 'SANGAMAY PALASA,SARRIVE', 'bloquée', '2026-03-10 11:55:08', '2026-03-10 15:56:12'),
(4, '2026-004', 'IK', 'ILUNGA JILE', 'bloquée', '2026-03-10 12:12:30', '2026-03-10 12:26:48');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_08_14_170933_add_two_factor_columns_to_users_table', 1),
(5, '2026_03_08_065502_create_marchandises_table', 1),
(6, '2026_03_08_110512_add_role_to_users_table', 1),
(7, '2026_03_09_183921_create_documents_table', 2),
(8, '2026_03_10_120439_create_historiques_table', 3);

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('biU53fCd2N1Om7jCotpsS4qmHls2qGKD04Wox1sF', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:147.0) Gecko/20100101 Firefox/147.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiQW5XWDhsUklMSGxPZEMxbFRtM3UzSUx3eklXdERZNVdhUUN4dkp6RSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjM0OiJodHRwOi8vbG9jYWxob3N0OjgwMDAvbWFyY2hhbmRpc2VzIjtzOjU6InJvdXRlIjtzOjE4OiJtYXJjaGFuZGlzZXMuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=', 1773172612),
('tJ13GH7YbqLKrz029Dfdlk5QK4sVGH0Cqq0J0SGb', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiMUVBMGtWaDg0dEd3R3ZySldzWkRwSlpSMHJSb1dHVWhmV3NaNms1TyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjMxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvZGFzaGJvYXJkIjtzOjU6InJvdXRlIjtzOjk6ImRhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7fQ==', 1773172724),
('vAhcy5hN0Jt7Rq9cADCWgdOq1PahLCWp84j0OAF0', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoidGpsT0xPb3laY1lKM0laN3hVUld1bWtLSXBTNlJyWFlmdWJPWHFCMCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjMxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvZGFzaGJvYXJkIjtzOjU6InJvdXRlIjtzOjk6ImRhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1773166754);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'agent',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrateur', 'admin@trace.cd', 'admin', NULL, '$2y$12$uiYTkISR2KFuvF0BPufat.7xjkJOdy3s1Gan/3ultWIf6gOEOMdEu', NULL, NULL, NULL, NULL, '2026-03-08 09:15:38', '2026-03-08 09:15:38'),
(2, 'Agent Enregistrement', 'agent@trace.cd', 'agent', NULL, '$2y$12$/ux5a5J6H9fsxCv9kqVexu/Ji6CfoiQKFEwKOql4ArGO8Rtv1.qUu', NULL, NULL, NULL, NULL, '2026-03-08 09:15:38', '2026-03-08 09:15:38'),
(3, 'Contrôleur Douane', 'controleur@trace.cd', 'controleur', NULL, '$2y$12$Q5KVEtD0ZsyqUx.DJM4mIeQ./Y8SKFVnmietRQrOgIgI.cVacQiSe', NULL, NULL, NULL, NULL, '2026-03-08 09:15:39', '2026-03-08 09:15:39'),
(4, 'Rachela fungu', 'rachel14@gmail.com', 'agent', NULL, '$2y$12$OoeE68D0jthhmHAFx8PnbuhpMY7UN7L.Yrt6Q2PZo3hj9ZsDzCt.W', NULL, NULL, NULL, NULL, '2026-03-08 16:23:06', '2026-03-09 16:04:07'),
(5, 'SIFA RASHIDI', 'sifarashidi17@gmail.com', 'controleur', NULL, '$2y$12$b7GBkPdbBtyCfdy55CX6xOx2edhXZhtvlCIm/mm0aVrgnrgzEkmXC', NULL, NULL, NULL, NULL, '2026-03-09 16:06:29', '2026-03-09 16:06:29');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Index pour la table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Index pour la table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `documents_marchandise_id_foreign` (`marchandise_id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `historiques`
--
ALTER TABLE `historiques`
  ADD PRIMARY KEY (`id`),
  ADD KEY `historiques_marchandise_id_foreign` (`marchandise_id`),
  ADD KEY `historiques_user_id_foreign` (`user_id`);

--
-- Index pour la table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Index pour la table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `marchandises`
--
ALTER TABLE `marchandises`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `marchandises_reference_unique` (`reference`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `historiques`
--
ALTER TABLE `historiques`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `marchandises`
--
ALTER TABLE `marchandises`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_marchandise_id_foreign` FOREIGN KEY (`marchandise_id`) REFERENCES `marchandises` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `historiques`
--
ALTER TABLE `historiques`
  ADD CONSTRAINT `historiques_marchandise_id_foreign` FOREIGN KEY (`marchandise_id`) REFERENCES `marchandises` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `historiques_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
