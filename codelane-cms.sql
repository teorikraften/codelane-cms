-- phpMyAdmin SQL Dump
-- version 4.3.3
-- http://www.phpmyadmin.net
--
-- Värd: localhost
-- Tid vid skapande: 12 apr 2015 kl 13:13
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
  `done_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=165 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumpning av Data i tabell `assignments`
--

INSERT INTO `assignments` (`id`, `accepted`, `user`, `pm`, `content`, `assignment`, `created_at`, `updated_at`, `deleted_at`, `done_at`) VALUES
(1, 0, 2, 4, '', 'creator', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00'),
(2, 0, 2, 5, '', 'creator', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00'),
(3, 0, 2, 5, '', 'author', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00'),
(4, 0, 2, 5, '', 'reviewer', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00'),
(5, 0, 2, 5, '', 'reminder', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00'),
(6, 0, 2, 6, '', 'creator', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00'),
(7, 0, 2, 6, '', 'author', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00'),
(8, 0, 2, 6, '', 'settler', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00'),
(9, 0, 2, 6, '', 'reviewer', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00'),
(10, 0, 2, 6, '', 'reminder', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00'),
(74, 0, 2, 8, '', 'creator', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(75, 0, 2, 8, '', 'author', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(76, 0, 2, 8, '', 'settler', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(77, 0, 2, 8, '', 'reviewer', '0000-00-00 00:00:00', '2015-04-10 05:05:51', NULL, NULL),
(78, 0, 2, 8, '', 'end-reviewer', '0000-00-00 00:00:00', '2015-04-10 05:05:51', NULL, NULL),
(79, 0, 2, 8, '', 'reminder', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(139, 0, 2, 9, '', 'creator', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(140, 0, 2, 9, '', 'author', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(141, 0, 2, 9, '', 'settler', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(142, 0, 2, 9, '', 'reviewer', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(143, 0, 2, 9, '', 'end-reviewer', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(144, 0, 2, 9, '', 'reminder', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(152, 0, 2, 7, '', 'creator', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(153, 0, 2, 7, '', 'author', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(154, 0, 2, 7, '', 'settler', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(155, 0, 2, 7, '', 'reviewer', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(156, 0, 2, 7, '', 'end-reviewer', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(157, 0, 2, 7, '', 'reminder', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(158, 0, 3, 7, '', 'reminder', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(159, 0, 1, 10, '', 'creator', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(160, 0, 1, 10, '', 'author', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(161, 0, 1, 10, '', 'settler', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(162, 0, 1, 10, '', 'reviewer', '0000-00-00 00:00:00', '2015-04-10 09:40:08', NULL, NULL),
(163, 0, 1, 10, '', 'end-reviewer', '0000-00-00 00:00:00', '2015-04-10 09:40:08', NULL, NULL),
(164, 0, 1, 10, '', 'reminder', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumpning av Data i tabell `categories`
--

INSERT INTO `categories` (`id`, `parent`, `token`, `name`, `created_at`, `updated_at`, `deleted_at`, `added_by`) VALUES
(1, 0, 'en-kategori', 'En kategori', '2015-04-10 05:32:32', '2015-04-10 05:32:32', NULL, 0),
(2, 1, 'johan', 'Johan', '2015-04-10 05:32:37', '2015-04-10 05:32:37', NULL, 0),
(3, 2, 'jonas', 'Jonas', '2015-04-10 08:57:11', '2015-04-10 08:57:11', NULL, 0),
(4, 3, 'patric', 'Patric', '2015-04-10 08:57:25', '2015-04-10 08:57:25', NULL, 0),
(5, 3, 'onur-4', 'Onur', '2015-04-10 08:57:35', '2015-04-10 08:57:35', NULL, 0),
(6, 3, 'eric-6', 'Eric', '2015-04-10 08:57:47', '2015-04-10 08:57:47', NULL, 0),
(7, 3, 'nick-9', 'Nick', '2015-04-10 08:57:57', '2015-04-10 08:57:57', NULL, 0),
(8, 0, 'screenshots', 'Screenshots', '2015-04-10 08:58:48', '2015-04-10 08:58:48', NULL, 0),
(9, 8, 'svartvitt', 'Svartvitt', '2015-04-10 08:59:12', '2015-04-10 08:59:12', NULL, 0),
(10, 8, 'farg-', 'Färg ', '2015-04-10 08:59:24', '2015-04-10 08:59:24', NULL, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumpning av Data i tabell `comments`
--

INSERT INTO `comments` (`id`, `user`, `content`, `position_start`, `position_end`, `parent`, `created_at`, `updated_at`, `deleted_at`, `pm`) VALUES
(1, 1, 'comon', 0, 0, 0, '2015-04-12 11:02:59', '2015-04-12 11:02:59', NULL, 10),
(2, 1, 'nice', 0, 10, 0, '2015-04-12 11:04:16', '2015-04-12 11:04:16', NULL, 10);

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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumpning av Data i tabell `favourites`
--

INSERT INTO `favourites` (`id`, `user`, `pm`, `created_at`, `updated_at`) VALUES
(4, 2, 8, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 1, 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 1, 8, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

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
  `status` set('assigned','written','reviewed','end-reviewed','published','published-reminded','revision-waiting','revision-assigned','revision-reviewed','revision-end-reviewed','revision-written') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'assigned',
  `safetystatus` set('K1','K2','K3') COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `draft` text COLLATE utf8_unicode_ci,
  `token` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `department` int(10) unsigned NOT NULL,
  `published` tinyint(1) NOT NULL,
  `validity_period` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `validity_date` date DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `revision_date` date DEFAULT NULL,
  `expiration_date` date DEFAULT NULL,
  `first_published_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumpning av Data i tabell `pms`
--

INSERT INTO `pms` (`id`, `code`, `status`, `safetystatus`, `title`, `content`, `draft`, `token`, `department`, `published`, `validity_period`, `validity_date`, `created_by`, `revision_date`, `expiration_date`, `first_published_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '', 'assigned', NULL, '', '', '', '5', 0, 0, NULL, NULL, 2, NULL, NULL, '0000-00-00', '2015-04-09 10:27:19', '2015-04-09 10:27:19', '2015-04-09 13:39:00'),
(2, '', 'assigned', NULL, '', '', '', '0', 0, 0, NULL, NULL, 2, NULL, NULL, '0000-00-00', '2015-04-09 10:27:32', '2015-04-09 10:27:32', '2015-04-09 13:39:00'),
(3, '', 'assigned', NULL, '', '', '', '5-7', 0, 0, NULL, NULL, 2, NULL, NULL, '0000-00-00', '2015-04-09 10:28:34', '2015-04-09 10:28:34', '2015-04-09 13:39:00'),
(4, '', 'assigned', NULL, '', '', '', '1', 0, 0, NULL, NULL, 2, NULL, NULL, '0000-00-00', '2015-04-09 10:39:49', '2015-04-09 10:39:49', '2015-04-09 13:39:00'),
(5, '', 'assigned', NULL, 'Nu finns en rubrik', '', '', 'nu-finns-en-rubrik', 0, 0, NULL, NULL, 2, NULL, NULL, '0000-00-00', '2015-04-09 10:57:34', '2015-04-09 10:57:34', '2015-04-09 13:39:00'),
(6, '', 'assigned', NULL, 'TestPM', '', '', 'testpm', 0, 0, NULL, NULL, 2, NULL, NULL, '0000-00-00', '2015-04-09 11:03:51', '2015-04-09 11:03:51', '2015-04-09 13:39:00'),
(7, '', 'published', NULL, 'En ny rubrik', '<p>Juste, h&auml;r &auml;r inneh&aring;llet.</p>', NULL, '4', 0, 1, '2y', NULL, 2, NULL, NULL, '0000-00-00', '2015-04-09 11:05:27', '2015-04-10 05:59:09', NULL),
(8, '', 'published', NULL, 'Rubrik!', '<p>Inneh&aring;ll!</p>', NULL, '7', 0, 1, '1y6m', NULL, 2, NULL, '2016-10-10', '0000-00-00', '2015-04-10 04:50:56', '2015-04-10 05:05:51', NULL),
(9, '', 'published', NULL, 'Rubiks kub', '<p>Inneh&aring;ll TYBG</p>', NULL, '1', 0, 1, '2y', NULL, 2, NULL, '2016-04-26', '0000-00-00', '2015-04-10 05:21:56', '2015-04-10 05:59:01', NULL),
(10, '', 'revision-written', NULL, 'Patrics PM', '\n                <span id="1" class="comment active"><p>Hej.</p></span>\n            ', '<p>Hej.</p>', 'patrics-pm', 0, 1, '1y', NULL, 1, NULL, '2016-04-10', '0000-00-00', '2015-04-10 09:38:24', '2015-04-12 11:02:59', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumpning av Data i tabell `roles`
--

INSERT INTO `roles` (`id`, `name`, `role_type`, `department_code`, `department_parent`, `created_at`, `updated_at`, `deleted_at`, `added_by`) VALUES
(1, 'Sjuksköterska', 'department', NULL, NULL, '2015-04-10 08:31:25', '2015-04-10 08:31:25', NULL, 0),
(2, 'Chef', 'department', NULL, NULL, '2015-04-10 08:31:37', '2015-04-10 08:31:37', NULL, 0),
(3, 'Städare', 'department', NULL, NULL, '2015-04-10 08:31:44', '2015-04-10 08:31:44', NULL, 0),
(4, 'Undersköterska', 'department', NULL, NULL, '2015-04-10 08:32:13', '2015-04-10 08:32:13', NULL, 0),
(5, 'Bawlius', 'department', NULL, NULL, '2015-04-10 08:33:15', '2015-04-10 08:33:15', NULL, 0),
(6, 'LÄKARE', 'department', NULL, NULL, '2015-04-10 08:36:59', '2015-04-10 08:36:59', NULL, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumpning av Data i tabell `tags`
--

INSERT INTO `tags` (`id`, `name`, `token`, `created_at`, `updated_at`, `deleted_at`, `added_by`) VALUES
(1, 'nedo', 'nedo', '2015-04-10 05:32:19', '2015-04-10 05:32:19', NULL, 0),
(2, 'nick', 'nick', '2015-04-10 08:29:32', '2015-04-10 08:29:32', NULL, 0),
(3, 'kiss', 'kiss', '2015-04-10 08:29:36', '2015-04-10 08:29:36', NULL, 0),
(4, 'nedo_jonas_bäst', 'nedo-jonas-bast', '2015-04-10 08:29:36', '2015-04-10 08:29:36', NULL, 0),
(5, 'SWAG', 'swag', '2015-04-10 08:29:36', '2015-04-10 08:29:36', NULL, 0),
(6, 'Jonasfap', 'jonasfap', '2015-04-10 08:29:37', '2015-04-10 08:29:37', NULL, 0),
(7, 'vafan', 'vafan', '2015-04-10 08:29:45', '2015-04-10 08:29:45', NULL, 0),
(8, 'fakk yoo', 'fakk-yoo', '2015-04-10 08:29:46', '2015-04-10 08:29:46', NULL, 0),
(9, 'TYBG', 'tybg', '2015-04-10 08:29:52', '2015-04-10 08:29:52', NULL, 0),
(10, 'broooor', 'broooor', '2015-04-10 08:29:52', '2015-04-10 08:29:52', NULL, 0),
(11, 'hallå', 'halla', '2015-04-10 08:29:54', '2015-04-10 08:29:54', NULL, 0),
(12, 'IZMIRR', 'izmirr', '2015-04-10 08:29:56', '2015-04-10 08:29:56', NULL, 0),
(13, 'onur', 'onur', '2015-04-10 08:29:58', '2015-04-10 08:29:58', NULL, 0),
(14, 'tvåvar', 'tvavar', '2015-04-10 08:29:59', '2015-04-10 08:29:59', NULL, 0),
(15, '"Om alla lägger två var"', 'om-alla-lagger-tva-var', '2015-04-10 08:30:00', '2015-04-10 08:30:00', NULL, 0),
(16, 'mat', 'mat', '2015-04-10 08:30:04', '2015-04-10 08:30:04', NULL, 0),
(17, 'HJÄRTA', 'hjarta', '2015-04-10 08:30:05', '2015-04-10 08:30:05', NULL, 0),
(18, 'om alla lägger till 2 taggar så blir det bra', 'om-alla-lagger-till-2-taggar-sa-blir-det-bra', '2015-04-10 08:30:07', '2015-04-10 08:30:07', NULL, 0),
(19, 'Johanäger', 'johanager', '2015-04-10 08:30:08', '2015-04-10 08:30:08', NULL, 0),
(20, '"MAn måste lägga seriösa taggar"', 'man-maste-lagga-seriosa-taggar', '2015-04-10 08:30:10', '2015-04-10 08:30:10', NULL, 0),
(21, 'MAGE', 'mage', '2015-04-10 08:30:12', '2015-04-10 08:30:12', NULL, 0),
(22, 'eric', 'eric', '2015-04-10 08:30:13', '2015-04-10 08:30:13', NULL, 0),
(23, 'ochentill', 'ochentill', '2015-04-10 08:30:15', '2015-04-10 08:30:15', NULL, 0),
(24, 'kebab', 'kebab', '2015-04-10 08:30:16', '2015-04-10 08:30:16', NULL, 0),
(25, '"De min dator överbelastar', 'de-min-dator-overbelastar', '2015-04-10 08:30:22', '2015-04-10 08:30:22', NULL, 0),
(26, 'är favoriter en bugg?', 'ar-favoriter-en-bugg', '2015-04-10 08:30:50', '2015-04-10 08:30:50', NULL, 0);

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
(1, 'admin@jdahl.se', '$2y$10$td8xXkka1O8a3pZEZ/tfsOAkJ3N/WLY0yN9WSgtwbOiEHtgyGb0Ta', 'Admin Adminsson', 'admin', 1, '2015-04-09 08:00:00', '2015-04-10 08:57:12', NULL, '3391SecAeS5e77MgPpszjLVEr2Rv0q73hiH8jWKl5HZzo76HjE4tfLux7hre'),
(2, 'pmadmin@jdahl.se', '$2y$10$IbVArhuXxDtRwDYXWyCZT.CEpMsycIX4Z3MZIK.Y3b1xeQEZKilw2', 'PM-Admin Sara', 'pm-admin', 0, '2015-04-09 09:27:23', '2015-04-10 09:37:20', NULL, 'DkngR1rnHog0WFMgLCCZQ7XaauDxK5lhzLert14O01yeuXJqZBssIUaE7QQ8'),
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumpning av Data i tabell `user_roles`
--

INSERT INTO `user_roles` (`id`, `user`, `role`, `created_at`, `updated_at`) VALUES
(3, 1, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

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
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=165;
--
-- AUTO_INCREMENT för tabell `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT för tabell `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT för tabell `favourites`
--
ALTER TABLE `favourites`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT för tabell `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT för tabell `pms`
--
ALTER TABLE `pms`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
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
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT för tabell `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
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
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
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
