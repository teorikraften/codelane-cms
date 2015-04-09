-- phpMyAdmin SQL Dump
-- version 4.3.3
-- http://www.phpmyadmin.net
--
-- Värd: localhost
-- Tid vid skapande: 09 apr 2015 kl 12:26
-- Serverversion: 5.6.22
-- PHP-version: 5.5.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databas: `codelane-cms`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `assignments`
--

CREATE TABLE IF NOT EXISTS `assignments` (
  `id` int(10) unsigned NOT NULL,
  `accepted` tinyint(1) NOT NULL,
  `user` int(10) unsigned NOT NULL,
  `pm` int(10) unsigned NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `assignment` enum('creator','author','settler','reviewer','end-reviewer','reminder') COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `done_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL,
  `parent` int(10) unsigned NOT NULL,
  `token` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `added_by` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) unsigned NOT NULL,
  `user` int(10) unsigned NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `position_start` int(11) NOT NULL,
  `position_end` int(11) NOT NULL,
  `parent` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `pm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `favourites`
--

CREATE TABLE IF NOT EXISTS `favourites` (
  `id` int(10) unsigned NOT NULL,
  `user` int(10) unsigned NOT NULL,
  `pm` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(100) NOT NULL,
  `pm` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `added_by` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellstruktur `password_reminders`
--

CREATE TABLE IF NOT EXISTS `password_reminders` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `pms`
--

CREATE TABLE IF NOT EXISTS `pms` (
  `id` int(10) unsigned NOT NULL,
  `code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` set('assigned','reviewed','published','published-reminded','revision-waiting','revision-assigned','revision-reviewed') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'assigned',
  `safetystatus` set('K1','K2','K3') COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `department` int(10) unsigned NOT NULL,
  `published` tinyint(1) NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `revision_date` date DEFAULT NULL,
  `expiration_date` date NOT NULL,
  `first_published_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `pm_categories`
--

CREATE TABLE IF NOT EXISTS `pm_categories` (
  `id` int(10) unsigned NOT NULL,
  `pm` int(10) unsigned NOT NULL,
  `category` int(10) unsigned NOT NULL,
  `added_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `pm_roles`
--

CREATE TABLE IF NOT EXISTS `pm_roles` (
  `id` int(10) unsigned NOT NULL,
  `pm` int(10) unsigned NOT NULL,
  `role` int(10) unsigned NOT NULL,
  `added_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `pm_tags`
--

CREATE TABLE IF NOT EXISTS `pm_tags` (
  `id` int(10) unsigned NOT NULL,
  `pm` int(10) unsigned NOT NULL,
  `tag` int(10) unsigned NOT NULL,
  `added_by` int(10) unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `role_type` enum('department','profession','clinic','hospital') COLLATE utf8_unicode_ci NOT NULL,
  `department_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `department_parent` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `added_by` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `added_by` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `templates`
--

CREATE TABLE IF NOT EXISTS `templates` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `privileges` set('unverified','verified','pm-admin','admin') COLLATE utf8_unicode_ci DEFAULT NULL,
  `tooltips_on` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `privileges`, `tooltips_on`, `created_at`, `updated_at`, `deleted_at`, `remember_token`) VALUES
(1, 'admin@jdahl.se', '$2y$10$td8xXkka1O8a3pZEZ/tfsOAkJ3N/WLY0yN9WSgtwbOiEHtgyGb0Ta', 'Admin Adminsson', 'admin', 1, '2015-04-09 08:00:00', '2015-04-09 09:28:47', NULL, 'jjTjC6enNffj8Ud6bDwXEG0vP4D3IaxTx2WEvpBxRcUEpTVCHnYTRWVrphX8'),
(2, 'pmadmin@jdahl.se', '$2y$10$IbVArhuXxDtRwDYXWyCZT.CEpMsycIX4Z3MZIK.Y3b1xeQEZKilw2', 'PM-Admin Sara', 'pm-admin', 0, '2015-04-09 09:27:23', '2015-04-09 09:59:18', NULL, 'UFsrHVZC2BjDI5NTWHoPtGZZUbD3fJp8xFUev5SBQrHVcPEpX14vdJaJMrvV'),
(3, 'verifierad@jdahl.se', '$2y$10$p662Xn2plUUber.FrLSfwO.kMkaweZAUT6n3VjiTB2LSqlG5KEWOi', 'Verifierad Mats', 'verified', 0, '2015-04-09 09:27:51', '2015-04-09 09:30:21', NULL, '3OoDvICJowfzzf3NpjX1Ca4oU5WZMA5wttDqLHsv7YcFLzRgoxtBV1s3c6Qa'),
(4, 'overifierad@jdahl.se', '$2y$10$9FQLuh5FrCj91EiLniU5JuDJP4Qm2ld57r/62YUjSSOBAOZrVAFnG', 'Overifierad Hasse', 'unverified', 0, '2015-04-09 09:28:12', '2015-04-09 09:30:45', NULL, NULL);

-- --------------------------------------------------------

--
-- Tabellstruktur `user_roles`
--

CREATE TABLE IF NOT EXISTS `user_roles` (
  `id` int(10) unsigned NOT NULL,
  `user` int(10) unsigned NOT NULL,
  `role` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`), ADD KEY `assignments_user_foreign` (`user`), ADD KEY `assignments_pm_foreign` (`pm`);

--
-- Index för tabell `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`), ADD KEY `added_by` (`added_by`);

--
-- Index för tabell `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`), ADD KEY `comments_user_foreign` (`user`);

--
-- Index för tabell `favourites`
--
ALTER TABLE `favourites`
  ADD PRIMARY KEY (`id`), ADD KEY `favourites_user_foreign` (`user`), ADD KEY `favourites_pm_foreign` (`pm`);

--
-- Index för tabell `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `password_reminders`
--
ALTER TABLE `password_reminders`
  ADD KEY `password_reminders_email_index` (`email`), ADD KEY `password_reminders_token_index` (`token`);

--
-- Index för tabell `pms`
--
ALTER TABLE `pms`
  ADD PRIMARY KEY (`id`), ADD KEY `pms_created_by_foreign` (`created_by`), ADD FULLTEXT KEY `search` (`title`,`content`);

--
-- Index för tabell `pm_categories`
--
ALTER TABLE `pm_categories`
  ADD PRIMARY KEY (`id`), ADD KEY `pm_categories_pm_foreign` (`pm`), ADD KEY `pm_categories_category_foreign` (`category`), ADD KEY `pm_categories_added_by_foreign` (`added_by`);

--
-- Index för tabell `pm_roles`
--
ALTER TABLE `pm_roles`
  ADD PRIMARY KEY (`id`), ADD KEY `pm_roles_pm_foreign` (`pm`), ADD KEY `pm_roles_role_foreign` (`role`), ADD KEY `pm_roles_added_by_foreign` (`added_by`);

--
-- Index för tabell `pm_tags`
--
ALTER TABLE `pm_tags`
  ADD PRIMARY KEY (`id`), ADD KEY `pm_tags_pm_foreign` (`pm`), ADD KEY `pm_tags_tag_foreign` (`tag`), ADD KEY `pm_tags_added_by_foreign` (`added_by`);

--
-- Index för tabell `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`), ADD KEY `user_roles_user_foreign` (`user`), ADD KEY `user_roles_role_foreign` (`role`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT för tabell `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT för tabell `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT för tabell `favourites`
--
ALTER TABLE `favourites`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT för tabell `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT för tabell `pms`
--
ALTER TABLE `pms`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT för tabell `pm_categories`
--
ALTER TABLE `pm_categories`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT för tabell `pm_roles`
--
ALTER TABLE `pm_roles`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT för tabell `pm_tags`
--
ALTER TABLE `pm_tags`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT för tabell `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT för tabell `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT för tabell `templates`
--
ALTER TABLE `templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT för tabell `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT för tabell `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- Restriktioner för dumpade tabeller
--

--
-- Restriktioner för tabell `assignments`
--
ALTER TABLE `assignments`
ADD CONSTRAINT `assignments_pm_foreign` FOREIGN KEY (`pm`) REFERENCES `pms` (`id`),
ADD CONSTRAINT `assignments_user_foreign` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

--
-- Restriktioner för tabell `comments`
--
ALTER TABLE `comments`
ADD CONSTRAINT `comments_user_foreign` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

--
-- Restriktioner för tabell `favourites`
--
ALTER TABLE `favourites`
ADD CONSTRAINT `favourites_pm_foreign` FOREIGN KEY (`pm`) REFERENCES `pms` (`id`),
ADD CONSTRAINT `favourites_user_foreign` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

--
-- Restriktioner för tabell `pms`
--
ALTER TABLE `pms`
ADD CONSTRAINT `pms_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Restriktioner för tabell `pm_categories`
--
ALTER TABLE `pm_categories`
ADD CONSTRAINT `pm_categories_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`),
ADD CONSTRAINT `pm_categories_category_foreign` FOREIGN KEY (`category`) REFERENCES `categories` (`id`),
ADD CONSTRAINT `pm_categories_pm_foreign` FOREIGN KEY (`pm`) REFERENCES `pms` (`id`);

--
-- Restriktioner för tabell `pm_roles`
--
ALTER TABLE `pm_roles`
ADD CONSTRAINT `pm_roles_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`),
ADD CONSTRAINT `pm_roles_pm_foreign` FOREIGN KEY (`pm`) REFERENCES `pms` (`id`),
ADD CONSTRAINT `pm_roles_role_foreign` FOREIGN KEY (`role`) REFERENCES `roles` (`id`);

--
-- Restriktioner för tabell `pm_tags`
--
ALTER TABLE `pm_tags`
ADD CONSTRAINT `pm_tags_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`),
ADD CONSTRAINT `pm_tags_pm_foreign` FOREIGN KEY (`pm`) REFERENCES `pms` (`id`),
ADD CONSTRAINT `pm_tags_tag_foreign` FOREIGN KEY (`tag`) REFERENCES `tags` (`id`);

--
-- Restriktioner för tabell `user_roles`
--
ALTER TABLE `user_roles`
ADD CONSTRAINT `user_roles_role_foreign` FOREIGN KEY (`role`) REFERENCES `roles` (`id`),
ADD CONSTRAINT `user_roles_user_foreign` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
