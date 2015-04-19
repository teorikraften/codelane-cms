-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 19 apr 2015 kl 13:24
-- Serverversion: 5.6.17
-- PHP-version: 5.5.12

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
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `accepted` set('true','false','unknown') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'unknown',
  `user` int(10) unsigned NOT NULL,
  `pm` int(10) unsigned NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `assignment` enum('creator','author','settler','reviewer','end-reviewer','reminder') COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `done_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `assignments_user_foreign` (`user`),
  KEY `assignments_pm_foreign` (`pm`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=226 ;

--
-- Dumpning av Data i tabell `assignments`
--

INSERT INTO `assignments` (`id`, `accepted`, `user`, `pm`, `content`, `assignment`, `created_at`, `updated_at`, `deleted_at`, `done_at`) VALUES
(1, '', 1, 1, '', 'creator', '0000-00-00 00:00:00', '2015-04-14 16:33:27', NULL, NULL),
(2, '', 1, 1, '', 'author', '0000-00-00 00:00:00', '2015-04-14 16:33:27', NULL, NULL),
(3, '', 1, 1, '', 'settler', '0000-00-00 00:00:00', '2015-04-14 16:33:27', NULL, '2015-04-14 16:33:26'),
(4, '', 1, 1, '', 'reviewer', '0000-00-00 00:00:00', '2015-04-14 16:33:27', NULL, '2015-04-14 16:33:14'),
(5, '', 1, 1, '', 'end-reviewer', '0000-00-00 00:00:00', '2015-04-14 16:33:27', NULL, '2015-04-14 16:33:23'),
(6, '', 1, 1, '', 'reminder', '0000-00-00 00:00:00', '2015-04-14 16:33:27', NULL, NULL),
(7, '', 1, 2, '', 'creator', '0000-00-00 00:00:00', '2015-04-14 16:52:31', NULL, NULL),
(8, '', 1, 2, '', 'author', '0000-00-00 00:00:00', '2015-04-14 16:52:31', NULL, NULL),
(9, '', 1, 2, '', 'settler', '0000-00-00 00:00:00', '2015-04-14 16:52:31', NULL, '2015-04-14 16:52:31'),
(10, '', 1, 2, '', 'reviewer', '0000-00-00 00:00:00', '2015-04-14 16:52:31', NULL, '2015-04-14 16:52:22'),
(11, '', 1, 2, '', 'end-reviewer', '0000-00-00 00:00:00', '2015-04-14 16:52:31', NULL, '2015-04-14 16:52:28'),
(12, '', 1, 2, '', 'reminder', '0000-00-00 00:00:00', '2015-04-14 16:52:31', NULL, NULL),
(13, '', 1, 3, '', 'creator', '0000-00-00 00:00:00', '2015-04-14 17:00:33', NULL, NULL),
(14, '', 1, 3, '', 'author', '0000-00-00 00:00:00', '2015-04-14 17:00:33', NULL, NULL),
(15, '', 1, 3, '', 'settler', '0000-00-00 00:00:00', '2015-04-14 17:00:33', NULL, '2015-04-14 17:00:33'),
(16, '', 1, 3, '', 'reviewer', '0000-00-00 00:00:00', '2015-04-14 17:00:33', NULL, '2015-04-14 17:00:25'),
(17, '', 1, 3, '', 'end-reviewer', '0000-00-00 00:00:00', '2015-04-14 17:00:33', NULL, '2015-04-14 17:00:30'),
(18, '', 1, 3, '', 'reminder', '0000-00-00 00:00:00', '2015-04-14 17:00:33', NULL, NULL),
(19, '', 1, 4, '', 'creator', '0000-00-00 00:00:00', '2015-04-14 17:06:11', NULL, NULL),
(20, '', 1, 4, '', 'author', '0000-00-00 00:00:00', '2015-04-14 17:06:11', NULL, NULL),
(21, '', 1, 4, '', 'settler', '0000-00-00 00:00:00', '2015-04-14 17:06:11', NULL, '2015-04-14 17:06:11'),
(22, '', 1, 4, '', 'reviewer', '0000-00-00 00:00:00', '2015-04-14 17:06:11', NULL, '2015-04-14 17:06:05'),
(23, '', 1, 4, '', 'end-reviewer', '0000-00-00 00:00:00', '2015-04-14 17:06:11', NULL, '2015-04-14 17:06:08'),
(24, '', 1, 4, '', 'reminder', '0000-00-00 00:00:00', '2015-04-14 17:06:11', NULL, NULL),
(25, '', 1, 5, '', 'creator', '0000-00-00 00:00:00', '2015-04-14 17:12:32', NULL, NULL),
(26, '', 1, 5, '', 'author', '0000-00-00 00:00:00', '2015-04-14 17:12:32', NULL, NULL),
(27, '', 1, 5, '', 'settler', '0000-00-00 00:00:00', '2015-04-14 17:12:32', NULL, '2015-04-14 17:12:32'),
(28, '', 1, 5, '', 'reviewer', '0000-00-00 00:00:00', '2015-04-14 17:12:32', NULL, '2015-04-14 17:12:23'),
(29, '', 1, 5, '', 'end-reviewer', '0000-00-00 00:00:00', '2015-04-14 17:12:32', NULL, '2015-04-14 17:12:29'),
(30, '', 1, 5, '', 'reminder', '0000-00-00 00:00:00', '2015-04-14 17:12:32', NULL, NULL),
(31, '', 1, 6, '', 'creator', '0000-00-00 00:00:00', '2015-04-14 17:46:31', NULL, NULL),
(32, '', 1, 6, '', 'author', '0000-00-00 00:00:00', '2015-04-14 17:46:31', NULL, NULL),
(33, '', 1, 6, '', 'settler', '0000-00-00 00:00:00', '2015-04-14 17:46:31', NULL, '2015-04-14 17:46:31'),
(34, '', 1, 6, '', 'reviewer', '0000-00-00 00:00:00', '2015-04-14 17:46:31', NULL, '2015-04-14 17:46:18'),
(35, '', 1, 6, '', 'end-reviewer', '0000-00-00 00:00:00', '2015-04-14 17:46:31', NULL, '2015-04-14 17:46:26'),
(36, '', 1, 6, '', 'reminder', '0000-00-00 00:00:00', '2015-04-14 17:46:31', NULL, NULL),
(37, '', 1, 7, '', 'creator', '0000-00-00 00:00:00', '2015-04-14 17:53:57', NULL, NULL),
(38, '', 1, 7, '', 'author', '0000-00-00 00:00:00', '2015-04-14 17:53:57', NULL, NULL),
(39, '', 1, 7, '', 'settler', '0000-00-00 00:00:00', '2015-04-14 17:53:57', NULL, '2015-04-14 17:53:57'),
(40, '', 1, 7, '', 'reviewer', '0000-00-00 00:00:00', '2015-04-14 17:53:57', NULL, '2015-04-14 17:53:24'),
(41, '', 1, 7, '', 'end-reviewer', '0000-00-00 00:00:00', '2015-04-14 17:53:57', NULL, '2015-04-14 17:53:29'),
(42, '', 1, 7, '', 'reminder', '0000-00-00 00:00:00', '2015-04-14 17:53:57', NULL, NULL),
(43, '', 1, 8, '', 'creator', '0000-00-00 00:00:00', '2015-04-14 17:54:01', NULL, NULL),
(44, '', 1, 8, '', 'author', '0000-00-00 00:00:00', '2015-04-14 17:54:01', NULL, NULL),
(45, '', 1, 8, '', 'settler', '0000-00-00 00:00:00', '2015-04-14 17:54:01', NULL, '2015-04-14 17:54:01'),
(46, '', 1, 8, '', 'reviewer', '0000-00-00 00:00:00', '2015-04-14 17:54:01', NULL, '2015-04-14 17:53:34'),
(47, '', 1, 8, '', 'end-reviewer', '0000-00-00 00:00:00', '2015-04-14 17:54:01', NULL, '2015-04-14 17:53:38'),
(48, '', 1, 8, '', 'reminder', '0000-00-00 00:00:00', '2015-04-14 17:54:01', NULL, NULL),
(49, '', 1, 9, '', 'creator', '0000-00-00 00:00:00', '2015-04-14 17:54:04', NULL, NULL),
(50, '', 1, 9, '', 'author', '0000-00-00 00:00:00', '2015-04-14 17:54:04', NULL, NULL),
(51, '', 1, 9, '', 'settler', '0000-00-00 00:00:00', '2015-04-14 17:54:04', NULL, '2015-04-14 17:54:04'),
(52, '', 1, 9, '', 'reviewer', '0000-00-00 00:00:00', '2015-04-14 17:54:04', NULL, '2015-04-14 17:53:42'),
(53, '', 1, 9, '', 'end-reviewer', '0000-00-00 00:00:00', '2015-04-14 17:54:04', NULL, '2015-04-14 17:53:50'),
(54, '', 1, 9, '', 'reminder', '0000-00-00 00:00:00', '2015-04-14 17:54:04', NULL, NULL),
(55, '', 1, 10, '', 'creator', '0000-00-00 00:00:00', '2015-04-14 17:54:07', NULL, NULL),
(56, '', 1, 10, '', 'author', '0000-00-00 00:00:00', '2015-04-14 17:54:07', NULL, NULL),
(57, '', 1, 10, '', 'settler', '0000-00-00 00:00:00', '2015-04-14 17:54:07', NULL, '2015-04-14 17:54:07'),
(58, '', 1, 10, '', 'reviewer', '0000-00-00 00:00:00', '2015-04-14 17:54:07', NULL, '2015-04-14 17:53:47'),
(59, '', 1, 10, '', 'end-reviewer', '0000-00-00 00:00:00', '2015-04-14 17:54:07', NULL, '2015-04-14 17:53:54'),
(60, '', 1, 11, '', 'creator', '0000-00-00 00:00:00', '2015-04-14 18:16:00', NULL, NULL),
(61, '', 1, 11, '', 'author', '0000-00-00 00:00:00', '2015-04-14 18:16:00', NULL, NULL),
(62, '', 1, 11, '', 'settler', '0000-00-00 00:00:00', '2015-04-14 18:16:00', NULL, '2015-04-14 18:16:00'),
(63, '', 1, 11, '', 'reviewer', '0000-00-00 00:00:00', '2015-04-14 18:16:00', NULL, '2015-04-14 18:15:50'),
(64, '', 1, 11, '', 'end-reviewer', '0000-00-00 00:00:00', '2015-04-14 18:16:00', NULL, '2015-04-14 18:15:56'),
(65, '', 1, 11, '', 'reminder', '0000-00-00 00:00:00', '2015-04-14 18:16:00', NULL, NULL),
(66, '', 1, 12, '', 'creator', '0000-00-00 00:00:00', '2015-04-14 18:26:18', NULL, NULL),
(67, '', 1, 12, '', 'author', '0000-00-00 00:00:00', '2015-04-14 18:26:18', NULL, NULL),
(68, '', 1, 12, '', 'settler', '0000-00-00 00:00:00', '2015-04-14 18:26:18', NULL, '2015-04-14 18:26:18'),
(69, '', 1, 12, '', 'reviewer', '0000-00-00 00:00:00', '2015-04-14 18:26:18', NULL, '2015-04-14 18:26:09'),
(70, '', 1, 12, '', 'end-reviewer', '0000-00-00 00:00:00', '2015-04-14 18:26:18', NULL, '2015-04-14 18:26:14'),
(71, '', 1, 12, '', 'reminder', '0000-00-00 00:00:00', '2015-04-14 18:26:18', NULL, NULL),
(72, '', 1, 13, '', 'creator', '0000-00-00 00:00:00', '2015-04-14 18:27:56', NULL, NULL),
(73, '', 1, 13, '', 'author', '0000-00-00 00:00:00', '2015-04-14 18:27:56', NULL, NULL),
(74, '', 1, 13, '', 'settler', '0000-00-00 00:00:00', '2015-04-14 18:27:56', NULL, '2015-04-14 18:27:56'),
(75, '', 1, 13, '', 'reminder', '0000-00-00 00:00:00', '2015-04-14 18:27:56', NULL, NULL),
(87, 'unknown', 5, 14, '', 'reminder', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(86, 'unknown', 1, 14, '', 'end-reviewer', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(85, 'unknown', 6, 14, '', 'reviewer', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(84, 'unknown', 22, 14, '', 'settler', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(83, 'unknown', 25, 14, '', 'author', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(82, 'unknown', 11, 14, '', 'creator', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(88, 'unknown', 25, 15, '', 'creator', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(89, 'unknown', 25, 15, '', 'author', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(90, 'unknown', 25, 15, '', 'settler', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(91, 'unknown', 25, 15, '', 'reviewer', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(92, 'unknown', 3, 15, '', 'end-reviewer', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(93, 'unknown', 9, 15, '', 'reminder', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(94, 'unknown', 1, 16, '', 'creator', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(95, 'unknown', 25, 16, '', 'author', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(96, 'unknown', 1, 16, '', 'settler', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(97, 'false', 1, 16, 'Jag tänker inte godkänna förrän du byter ut ordet "dåligt" mot "bra".\r\n\r\nMVH Magnus', 'reviewer', '0000-00-00 00:00:00', '2015-04-14 19:16:23', NULL, '2015-04-14 19:16:23'),
(98, 'unknown', 1, 16, '', 'end-reviewer', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(99, 'unknown', 1, 16, '', 'reminder', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(100, 'unknown', 1, 17, '', 'creator', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(101, 'unknown', 1, 17, '', 'author', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(102, 'unknown', 1, 17, '', 'settler', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(103, 'unknown', 1, 17, '', 'reviewer', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(104, 'unknown', 1, 17, '', 'end-reviewer', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(105, 'unknown', 1, 17, '', 'reminder', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(106, 'unknown', 1, 18, '', 'creator', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(107, 'unknown', 1, 18, '', 'author', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(108, 'unknown', 1, 18, '', 'settler', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(109, 'unknown', 1, 18, '', 'reviewer', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(110, 'unknown', 1, 18, '', 'end-reviewer', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(111, 'unknown', 1, 18, '', 'reminder', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(112, 'unknown', 1, 19, '', 'creator', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(113, 'unknown', 1, 19, '', 'author', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(114, 'unknown', 1, 19, '', 'settler', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(115, 'unknown', 1, 19, '', 'reviewer', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(116, 'unknown', 1, 19, '', 'end-reviewer', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(117, 'unknown', 1, 19, '', 'reminder', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(118, 'unknown', 1, 20, '', 'creator', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(119, 'unknown', 1, 20, '', 'author', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(120, 'unknown', 1, 20, '', 'settler', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(121, 'unknown', 1, 20, '', 'reviewer', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(122, 'unknown', 1, 20, '', 'end-reviewer', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(123, 'unknown', 1, 20, '', 'reminder', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(124, 'unknown', 1, 21, '', 'creator', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(125, 'unknown', 1, 21, '', 'author', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(126, 'unknown', 1, 21, '', 'settler', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(127, 'unknown', 1, 21, '', 'reviewer', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(128, 'unknown', 1, 21, '', 'end-reviewer', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(129, 'unknown', 1, 21, '', 'reminder', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(130, 'unknown', 1, 22, '', 'creator', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(131, 'unknown', 1, 22, '', 'author', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(132, 'unknown', 1, 22, '', 'settler', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(133, 'unknown', 1, 22, '', 'reviewer', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(134, 'unknown', 1, 22, '', 'end-reviewer', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(135, 'unknown', 1, 22, '', 'reminder', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(136, 'unknown', 1, 23, '', 'creator', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(137, 'unknown', 1, 23, '', 'author', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(138, 'unknown', 1, 23, '', 'settler', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(139, 'unknown', 1, 23, '', 'reviewer', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(140, 'unknown', 1, 23, '', 'end-reviewer', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(141, 'unknown', 1, 23, '', 'reminder', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(142, 'unknown', 1, 25, '', 'creator', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(143, 'unknown', 4, 25, '', 'author', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(144, 'unknown', 1, 25, '', 'settler', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(145, 'unknown', 16, 25, '', 'reviewer', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(146, 'unknown', 16, 25, '', 'end-reviewer', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(147, 'unknown', 16, 25, '', 'reminder', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(148, 'unknown', 1, 33, '', 'creator', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(149, 'unknown', 1, 33, '', 'author', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(150, 'unknown', 1, 33, '', 'settler', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(151, 'unknown', 1, 33, '', 'reviewer', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(152, 'unknown', 1, 33, '', 'end-reviewer', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(153, 'unknown', 1, 33, '', 'reminder', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(154, 'unknown', 1, 44, '', 'creator', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(155, 'unknown', 1, 44, '', 'author', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(156, 'unknown', 1, 44, '', 'settler', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(157, 'unknown', 1, 44, '', 'reviewer', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(158, 'unknown', 1, 44, '', 'end-reviewer', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(159, 'unknown', 1, 44, '', 'reminder', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(160, 'unknown', 1, 45, '', 'creator', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(161, 'unknown', 1, 45, '', 'author', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(162, 'unknown', 1, 45, '', 'settler', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(163, 'unknown', 1, 45, '', 'reviewer', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(164, 'unknown', 1, 45, '', 'end-reviewer', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(165, 'unknown', 1, 45, '', 'reminder', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(183, 'unknown', 25, 46, '', 'reminder', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(182, 'unknown', 25, 46, '', 'end-reviewer', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(181, 'unknown', 25, 46, '', 'reviewer', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(180, 'unknown', 25, 46, '', 'settler', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(179, 'unknown', 25, 46, '', 'author', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(178, 'unknown', 25, 46, '', 'creator', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(184, 'unknown', 25, 47, '', 'creator', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(185, 'unknown', 25, 47, '', 'author', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(186, 'unknown', 25, 47, '', 'settler', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(187, 'unknown', 25, 47, '', 'reviewer', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(188, 'unknown', 25, 47, '', 'end-reviewer', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(189, 'unknown', 25, 48, '', 'creator', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(190, 'unknown', 25, 48, '', 'author', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(191, 'unknown', 25, 48, '', 'settler', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(192, 'unknown', 25, 48, '', 'reviewer', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(193, 'unknown', 25, 48, '', 'end-reviewer', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(225, 'unknown', 1, 49, '', 'reminder', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(224, 'unknown', 1, 49, '', 'end-reviewer', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(223, 'unknown', 1, 49, '', 'reviewer', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(222, 'unknown', 7, 49, '', 'settler', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(221, 'unknown', 4, 49, '', 'author', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(220, 'unknown', 1, 49, '', 'creator', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Tabellstruktur `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent` int(10) unsigned NOT NULL,
  `token` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `added_by` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `added_by` (`added_by`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Dumpning av Data i tabell `categories`
--

INSERT INTO `categories` (`id`, `parent`, `token`, `name`, `created_at`, `updated_at`, `deleted_at`, `added_by`) VALUES
(1, 0, 'akutmottagningen', 'Akutmottagningen', '2015-04-14 16:14:51', '2015-04-14 16:14:51', NULL, 0),
(2, 1, 'administrativa-riktlinjer', 'Administrativa riktlinjer', '2015-04-14 16:15:05', '2015-04-14 16:15:05', NULL, 0),
(3, 1, 'arbetsfloden', 'Arbetsflöden', '2015-04-14 16:15:16', '2015-04-14 16:15:16', NULL, 0),
(4, 1, 'arbetsbeskrivningar', 'Arbetsbeskrivningar', '2015-04-14 16:15:28', '2015-04-14 16:15:28', NULL, 0),
(5, 1, 'medicinsektionen', 'Medicinsektionen', '2015-04-14 16:15:40', '2015-04-14 17:01:29', '2015-04-14 17:01:29', 0),
(6, 1, 'ortopedsektionen', 'Ortopedsektionen', '2015-04-14 16:15:51', '2015-04-14 17:01:31', '2015-04-14 17:01:31', 0),
(7, 0, 'hjartmedicin', 'Hjärtmedicin', '2015-04-14 16:16:08', '2015-04-14 16:16:08', NULL, 0),
(8, 7, 'administrativa-riktlinjer-4', 'Administrativa riktlinjer', '2015-04-14 16:17:19', '2015-04-14 16:17:19', NULL, 0),
(9, 7, 'delegering', 'Delegering', '2015-04-14 16:18:47', '2015-04-14 16:18:47', NULL, 0),
(10, 7, 'nutrition', 'Nutrition', '2015-04-14 16:18:53', '2015-04-14 16:18:53', NULL, 0),
(11, 0, 'internmedicin', 'Internmedicin', '2015-04-14 16:19:17', '2015-04-14 16:19:17', NULL, 0),
(12, 11, 'gastroenheten', 'Gastroenheten', '2015-04-14 16:19:40', '2015-04-14 16:19:40', NULL, 0),
(13, 11, 'akutmedicin', 'Akutmedicin', '2015-04-14 16:19:56', '2015-04-14 16:19:56', NULL, 0),
(14, 11, 'administrativa-riktlinjer-3', 'Administrativa riktlinjer', '2015-04-14 16:20:06', '2015-04-14 16:20:06', NULL, 0),
(15, 0, 'humbug', 'Humbug', '2015-04-14 19:17:40', '2015-04-14 19:17:50', '2015-04-14 19:17:50', 0),
(16, 0, 'humbug', 'Humbug', '2015-04-14 19:17:57', '2015-04-14 19:18:05', '2015-04-14 19:18:05', 0);

-- --------------------------------------------------------

--
-- Tabellstruktur `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user` int(10) unsigned NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `position_start` int(11) NOT NULL,
  `position_end` int(11) NOT NULL,
  `parent` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `pm` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_user_foreign` (`user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellstruktur `favourites`
--

CREATE TABLE IF NOT EXISTS `favourites` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user` int(10) unsigned NOT NULL,
  `pm` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `favourites_user_foreign` (`user`),
  KEY `favourites_pm_foreign` (`pm`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Tabellstruktur `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` varchar(100) NOT NULL,
  `pm` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `added_by` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellstruktur `notes`
--

CREATE TABLE IF NOT EXISTS `notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `pm_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

--
-- Dumpning av Data i tabell `notes`
--

INSERT INTO `notes` (`id`, `title`, `content`, `user_id`, `pm_id`) VALUES
(1, 'Kom ihåg att skriva ut', 'Läsa på remisshantering', 1, 2),
(2, 'Ladda ner innan jag går hem', 'Hur går det till när någon inte kan betala med kontokort?', 1, 7),
(5, 'Läs på rutiner vid kontakt med', 'Hur gör SLA?', 1, 11),
(6, 'Kom ihåg att sova', 'Påminn Adrian att sluta raida.', 1, 15),
(19, 'Liams viktiga anteckning!', 'Jaha, det här var ju viktigt...', 25, 15);

-- --------------------------------------------------------

--
-- Tabellstruktur `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `pm_id` int(11) NOT NULL,
  `target_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumpning av Data i tabell `notifications`
--

INSERT INTO `notifications` (`id`, `title`, `content`, `user_id`, `pm_id`, `target_id`) VALUES
(1, 'Test', 'Första notifieringen', 10, 10, 1),
(2, 'hej', 'k', 1, 15, 25),
(3, 'hej', 'k', 1, 15, 25);

-- --------------------------------------------------------

--
-- Tabellstruktur `password_reminders`
--

CREATE TABLE IF NOT EXISTS `password_reminders` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_reminders_email_index` (`email`),
  KEY `password_reminders_token_index` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `pms`
--

CREATE TABLE IF NOT EXISTS `pms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pms_created_by_foreign` (`created_by`),
  FULLTEXT KEY `search` (`title`,`content`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=50 ;

--
-- Dumpning av Data i tabell `pms`
--

INSERT INTO `pms` (`id`, `code`, `status`, `safetystatus`, `title`, `content`, `draft`, `token`, `department`, `published`, `validity_period`, `validity_date`, `created_by`, `revision_date`, `expiration_date`, `first_published_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'VO-5', 'revision-written', NULL, 'Ansvarsarbete', '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">\n<html><body><p>&nbsp;Ansvarsarbete - riktlinjer</p>\r\n<div title="Page 1">\r\n<ul><li>\r\n<p>Tiden ska la&Igrave;&circ;ggas in i Heroma som ansvarstid</p>\r\n</li>\r\n<li>\r\n<p>Ansvarstidens omfattning diskuteras med na&Igrave;&circ;rmaste chef</p>\r\n</li>\r\n<li>\r\n<p>Anso&Igrave;&circ;kan om ansvarsarbete sker i dialog med na&Igrave;&circ;rmaste chef som till- eller avstyrker i samra&Igrave;&Scaron;d med bemanningsassistent</p>\r\n</li>\r\n<li>\r\n<p>Om ansvarstid inte lagts in i Heroma fa&Igrave;&Scaron;r ansvarstid endast tas ut om personalbemanning bedo&Igrave;&circ;ms vara ho&Igrave;&circ;g</p>\r\n</li>\r\n<li>\r\n<p>Ansvarsarbete utfo&Igrave;&circ;rs pa&Igrave;&Scaron; arbetsplatsen. Man byter om och sta&Igrave;&circ;mplar in/ut som vanligt</p>\r\n</li>\r\n<li>\r\n<p>Den som utfo&Igrave;&circ;r ansvarsarbete ska kunna rycka in i va&Igrave;&Scaron;rden pa&Igrave;&Scaron; bega&Igrave;&circ;ran av arbetsledningen</p>\r\n</li>\r\n<li>\r\n<p>Om ansvarsarbete ska utfo&Igrave;&circ;ras utanfo&Igrave;&circ;r sjukhuset, t ex fo&Igrave;&circ;r studiebeso&Igrave;&circ;k eller benchmarking, ska detta godka&Igrave;&circ;nnas i fo&Igrave;&circ;rva&Igrave;&circ;g&nbsp;</p>\r\n</li>\r\n</ul></div></body></html>\n', '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">\n<html><body><p>&nbsp;Ansvarsarbete - riktlinjer</p>\r\n<div title="Page 1">\r\n<ul><li>\r\n<p>Tiden ska la&Igrave;&circ;ggas in i Heroma som ansvarstid</p>\r\n</li>\r\n<li>\r\n<p>Ansvarstidens omfattning diskuteras med na&Igrave;&circ;rmaste chef</p>\r\n</li>\r\n<li>\r\n<p>Anso&Igrave;&circ;kan om ansvarsarbete sker i dialog med na&Igrave;&circ;rmaste chef som till- eller avstyrker i samra&Igrave;&Scaron;d med bemanningsassistent</p>\r\n</li>\r\n<li>\r\n<p>Om ansvarstid inte lagts in i Heroma fa&Igrave;&Scaron;r ansvarstid endast tas ut om personalbemanning bedo&Igrave;&circ;ms vara ho&Igrave;&circ;g</p>\r\n</li>\r\n<li>\r\n<p>Ansvarsarbete utfo&Igrave;&circ;rs pa&Igrave;&Scaron; arbetsplatsen. Man byter om och sta&Igrave;&circ;mplar in/ut som vanligt</p>\r\n</li>\r\n<li>\r\n<p>Den som utfo&Igrave;&circ;r ansvarsarbete ska kunna rycka in i va&Igrave;&Scaron;rden pa&Igrave;&Scaron; bega&Igrave;&circ;ran av arbetsledningen</p>\r\n</li>\r\n<li>\r\n<p>Om ansvarsarbete ska utfo&Igrave;&circ;ras utanfo&Igrave;&circ;r sjukhuset, t ex fo&Igrave;&circ;r studiebeso&Igrave;&circ;k eller benchmarking, ska detta godka&Igrave;&circ;nnas i fo&Igrave;&circ;rva&Igrave;&circ;g&nbsp;</p>\r\n</li>\r\n</ul></div></body></html>\n', 'ansvarsarbete', 0, 1, '1y', NULL, 1, NULL, '2016-04-14', '0000-00-00', '2015-04-14 16:21:09', '2015-04-16 08:53:38', NULL),
(2, 'VO-1', 'published', NULL, 'Ansvarsfördelning chefer kassan - receptionen', '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">\n<html><body><p>&nbsp;</p>\r\n<div title="Page 1">\r\n<div>\r\n<div>\r\n<p>Sekreterarchef ansvarar o&Igrave;&#136;ver akutens kassa enligt fo&Igrave;&#136;ljande:</p>\r\n<ul><li>\r\n<p>Avgifter &ndash; asyl, asylso&Igrave;&#136;kande, utomla&Igrave;&#136;nspatienter, inomla&Igrave;&#136;nspatienter, utomlandspatienter</p>\r\n</li>\r\n<li>\r\n<p>Taxakoder - enligt lista SLL avgiftshandboken, turisthandboken</p>\r\n</li>\r\n<li>\r\n<p>Makuleringar av fakturor/beso&Igrave;&#136;k</p>\r\n</li>\r\n<li>\r\n<p>DRG</p>\r\n</li>\r\n<li>\r\n<p>Remisshantering</p>\r\n</li>\r\n<li>\r\n<p>Nyansta&Igrave;&#136;llda &ndash; beho&Igrave;&#136;righet till PU-web, kassan samt boka sjukreseutbildning</p>\r\n</li>\r\n<li>\r\n<p>Tja&Igrave;&#136;nsteresor</p>\r\n</li>\r\n<li>\r\n<p>Parkeringstillsta&Igrave;&#138;nd fo&Igrave;&#136;r patienter och kriminalva&Igrave;&#138;rd</p>\r\n</li>\r\n<li>\r\n<p>RES &ndash; system som visar om fakturan a&Igrave;&#136;r betald eller inte</p>\r\n</li>\r\n<li>\r\n<p>Frikort, ho&Igrave;&#136;gkostnadskort</p>\r\n</li>\r\n<li>\r\n<p>Sammankoppling av identitet och reservnummer pa&Igrave;&#138; oka&Igrave;&#136;nda pat. Samverka med o&Igrave;&#136;vriga kliniker i</p>\r\n<p>denna fra&Igrave;&#138;ga</p>\r\n</li>\r\n<li>\r\n<p>Felregistrerade patienter</p>\r\n</li>\r\n<li>\r\n<p>Ka&Igrave;&#136;nnedom om registrering av patienter i ha&Igrave;&#136;ndelse av katastrof</p>\r\n</li>\r\n<li>\r\n<p>Reception/kassa mo&Igrave;&#136;ten</p>\r\n<p>Chefsjuksko&Igrave;&#136;terska fo&Igrave;&#136;r akutens reception ansvarar enligt fo&Igrave;&#136;ljande:</p>\r\n</li>\r\n</ul><ul><li>\r\n<p>Arbetssa&Igrave;&#136;tt</p>\r\n</li>\r\n<li>\r\n<p>Flo&Igrave;&#136;de</p>\r\n</li>\r\n<li>\r\n<p>Pretriage och samverkan med SLSO</p>\r\n</li>\r\n<li>\r\n<p>SLA</p>\r\n</li>\r\n<li>\r\n<p>Arbetssa&Igrave;&#136;tt receptionen i ha&Igrave;&#136;ndelse av katastrof i samra&Igrave;&#138;d med katastrofansvarig chefsjuksko&Igrave;&#136;terska</p>\r\n</li>\r\n<li>\r\n<p>Reception/kassa mo&Igrave;&#136;ten&nbsp;</p>\r\n</li>\r\n</ul></div>\r\n</div>\r\n</div></body></html>\n', NULL, 'ansvarsfordelning-chefer-kassan-receptionen', 0, 1, '1y', NULL, 1, NULL, '2016-04-14', '0000-00-00', '2015-04-14 16:50:58', '2015-04-14 16:52:31', NULL),
(3, 'VO-7', 'published', NULL, 'Arbetsbeskrivning larmteam', '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">\n<html><body><p>&nbsp;</p>\r\n<div title="Page 1">\r\n<div>\r\n<div>\r\n<ul><li>\r\n<p>Larmteamet (sjuksko&Igrave;&#136;terska samt undersko&Igrave;&#136;terska) ska handla&Igrave;&#136;gga larmpatienter pa&Igrave;&#138; alla sektioner pa&Igrave;&#138; larm/akutrummen tillsammans med la&Igrave;&#136;kare</p>\r\n</li>\r\n<li>\r\n<p>Ba&Igrave;&#136;ra varsin larmtelefon</p>\r\n</li>\r\n<li>\r\n<p>Utsedd larmsjuksko&Igrave;&#136;terska att ta na&Igrave;&#136;stkommande larm ba&Igrave;&#136;r &rdquo;hotline&rdquo; tfn 581 89, se Flo&Igrave;&#136;de larmkedja</p>\r\n</li>\r\n<li>\r\n<p>Vid behov samt om mo&Igrave;&#136;jlighet finns, hja&Igrave;&#136;lpa va&Igrave;&#138;rdlagen med o&Igrave;&#136;vervakning av patienter pa&Igrave;&#138; ro&Igrave;&#136;ntgen samt under patientens transport till avdelning</p>\r\n</li>\r\n<li>\r\n<p>Info&Igrave;&#136;r varje larm se till att incheckning sker enligt Incheckning vid larm</p>\r\n</li>\r\n<li>\r\n<p>Rapport fra&Igrave;&#138;n ambulanssjuksko&Igrave;&#136;terska mottages innan o&Igrave;&#136;verflyttning av patienten sker.</p>\r\n<p>OBS! Detta ga&Igrave;&#136;ller ej vid hja&Igrave;&#136;rtstopp</p>\r\n</li>\r\n<li>\r\n<p>Ansvarar fo&Igrave;&#136;r att iordningssta&Igrave;&#136;lla akutrummet efter varje patient.</p>\r\n</li>\r\n<li>\r\n<p>I bo&Igrave;&#136;rjan av sitt arbetspass utfo&Igrave;&#136;ra dagliga rutiner enligt checklistor</p>\r\n</li>\r\n<li>\r\n<p>Larmteamet a&Igrave;&#136;ger ra&Igrave;&#136;tten att begra&Igrave;&#136;nsa antalet a&Igrave;&#138;ska&Igrave;&#138;dare pa&Igrave;&#138; akutrummet</p>\r\n<p>Na&Igrave;&#136;r larm inte pa&Igrave;&#138;ga&Igrave;&#138;r a&Igrave;&#136;r teamet i na&Igrave;&#136;ra dialog med SLA fo&Igrave;&#136;r att v.b va&Igrave;&#136;xla mellan olika positioner och vara flexibel, t.ex.</p>\r\n</li>\r\n</ul><ul><li>\r\n<p>V ara behja&Igrave;&#136;lplig pa&Igrave;&#138; sektionerna i patientarbete</p>\r\n</li>\r\n<li>\r\n<p>Triagera pa&Igrave;&#138; sektion i syfte att fo&Igrave;&#136;rhindra &rdquo;stoppat flo&Igrave;&#136;de&rdquo;</p>\r\n</li>\r\n<li>\r\n<p>Triagera i central triage vid &rdquo;ho&Igrave;&#136;gflo&Igrave;&#136;de&rdquo;&nbsp;</p>\r\n</li>\r\n</ul></div>\r\n</div>\r\n</div></body></html>\n', NULL, 'arbetsbeskrivning-larmteam', 0, 1, '1y', NULL, 1, NULL, '2016-04-14', '0000-00-00', '2015-04-14 16:59:47', '2015-04-14 17:00:33', NULL),
(4, 'HK-234', 'published', NULL, 'Arbetsbeskrivning dagbakjour på hjärkliniken', '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">\n<html><body><p>Dagbakjour&nbsp;</p>\r\n<p>Dagbakjouren &auml;r minst enkelspecialist och &auml;r l&auml;kare med ledningsansvar. Denne har som huvudsaklig uppgift att styra de andra l&auml;karnas arbete, vara behj&auml;lplig vid fr&aring;gor, st&ouml;tta vid larm samt ta hand om konsultfr&aring;gor.</p>\r\n<p>V&aring;rdlagsarbetet: Dagbakjouren tillh&ouml;r inget v&aring;rdlag men har det yttersta ansvaret f&ouml;r att v&aring;rdlagens arbete framskrider. F&ouml;r att v&aring;rdlagen ska prestera optimalt b&ouml;r dagbakjouren arbeta enligt f&ouml;ljande princip:</p>\r\n<p>&middot; &nbsp; &nbsp; &nbsp; St&ouml;tta v&aring;rdlagsl&auml;karna vid medicinska och praktiska fr&aring;gor</p>\r\n<p>Dagbakjouren ska alltid vara antr&auml;ffbar personligen eller p&aring; DECT telefon 58174 som st&aring;r intill &nbsp; &nbsp; &nbsp; specialistens dator mellan kl 08.00&ndash;16.30</p>\r\n<p>&middot; &nbsp; &nbsp; &nbsp; Om arbetet stannar av eller g&aring;r l&aring;ngsamt i ett v&aring;rdlag g&ouml;r dagbakjouren bed&ouml;mning om och hur hj&auml;lp beh&ouml;ver tillskjutas</p>\r\n<p>&middot; &nbsp; &nbsp; &nbsp; Ansvara f&ouml;r vem som skall b&auml;ra larms&ouml;kare 007</p>\r\n<p>&middot; &nbsp; &nbsp; &nbsp; &Ouml;vervaka prioriteringar av patienter och vid behov prioritera upp eller ned.</p>\r\n<p>&middot; &nbsp; &nbsp; &nbsp; I st&ouml;rsta m&ouml;jliga m&aring;n ha med sig UL vid prelimin&auml;r bed&ouml;mning.</p>\r\n<p>&middot; &nbsp; &nbsp; &nbsp; Ansvara f&ouml;r &auml;ndring av initial prioritering dvs om patienter skall prioriteras av v&aring;rdpersonal enligt RETTS p&aring; sektionen eller om fl&ouml;det till sektionen bromsas och hj&auml;rtpatienter prioriteras genom den centrala RETTS-triageringen.</p>\r\n<p>&middot; &nbsp; &nbsp; &nbsp; Signera EKG s&aring; fort detta &auml;r taget.</p>\r\n<p>&middot; &nbsp; &nbsp; &nbsp; N&auml;rvara och om m&ouml;jligt leda uppstartsm&ouml;te kl 09.00 och avst&auml;mningsm&ouml;te kl 14.45 dagligen.</p>\r\n<p>Larm: Larm handl&auml;ggs av larml&auml;kare (l&auml;kare med s&ouml;k 007). Dagbakjour f&ouml;ljer vid behov med in p&aring; larmen till dess att situationen &auml;r kontrollerad. P&aring; avd 70 sal 3 har ansvarig l&auml;kare s&ouml;k 400 och kan efter kontakt l&auml;kare till l&auml;kare vara behj&auml;lplig att handl&auml;gga larm p&aring; akuten.&nbsp;</p>\r\n<p>Handl&auml;ggning av egna patienter: Dagbakjouren kan och b&ouml;r ta egna patienter n&auml;r tiden till&aring;ter. L&auml;mpligen v&auml;ljer man som dagbakjour patienter d&auml;r sjuksk&ouml;terskans insats &auml;r liten och sannolikhet f&ouml;r hemg&aring;ng &auml;r stor.</p>\r\n<p>Konsultationer: Alla konsultationer fr&aring;n andra sektioner p&aring; akuten ska handl&auml;ggas av dagbakjouren. Om patienten bed&ouml;ms beh&ouml;va &ouml;verf&ouml;ras fr&aring;n en sektion till en annan ska dock vidare handl&auml;ggning sk&ouml;tas av det v&aring;rdlag patienten i s&aring; fall tilldelas, i st&ouml;rsta m&ouml;jliga m&aring;n skall dock patienter inte flyttas mellan sektioner utan handl&auml;ggas mha konsultation fr&aring;n annan sektion om s&aring; kr&auml;vs. Undantag vid tidig identifierad felsortering.</p>\r\n<p>&Ouml;verbelastning: Vid h&ouml;gt infl&ouml;de av patienter &auml;r dagbakjouren ansvarig f&ouml;r hurvida extra personal b&ouml;r inkallas fr&aring;n annan position eller via sms, VG se separat PM.</p>\r\n<p>Direktinskrivning: Dagbakjouren &auml;r ansvarig f&ouml;r att hitta l&auml;mpliga patienter f&ouml;r direktinskrivning p&aring; avdelning mellan kl 13.00&ndash;15.00 varje vardag. Det g&auml;ller i normall&auml;ge 1 pat/avdelning och denna patient beh&ouml;ver id-band men i &ouml;vrigt inga utf&ouml;rda aktiviteter, VG se separat PM &rdquo;direktinskrivning p&aring; hj&auml;rtkliniken&rdquo;. &nbsp; &nbsp;</p></body></html>\n', NULL, 'arbetsbeskrivning-dagbakjour-pa-hjarkliniken', 0, 1, '1y', NULL, 1, NULL, '2016-04-14', '0000-00-00', '2015-04-14 17:03:10', '2015-04-14 17:06:11', NULL),
(5, 'EX-14', 'published', NULL, 'Exempel-PM', '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">\n<html><body><p>Detta &auml;r ett exempel-PM.</p></body></html>\n', NULL, 'exempel-pm', 0, 1, '1y', NULL, 1, NULL, '2016-04-14', '0000-00-00', '2015-04-14 17:11:21', '2015-04-14 17:12:32', NULL),
(6, 'EX-12', 'published', NULL, 'Exempel på en arbetsbeskrivning', '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">\n<html><body><p>Det h&auml;r &auml;r ocks&aring; ett exempel-PM, skrivet av n&aring;gon som heter Magnus. Det handlar om arbetsbeskrivning.</p></body></html>\n', NULL, 'exempel-pm-5', 0, 1, '1y', NULL, 1, NULL, '2016-04-14', '0000-00-00', '2015-04-14 17:45:20', '2015-04-14 17:46:31', NULL),
(7, '', 'published', NULL, 'Skyddad identitet', '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">\n<html><body><p>Riktlinje g&auml;llande s&ouml;kande patienter med Skyddad identitet <br> Med skyddad identitet menas att Skatteverket i s&auml;rskilt beslut givit en person som har hotas till livet <br> skyddad adress i befolkningsregistret (s&aring; kallad sp&auml;rrmarkering) eller att personen kvarskrivits p&aring; sin <br> gamla bostadsadress <br> F&ouml;ljande rutiner &auml;r framtagna f&ouml;r att f&ouml;rhindra att sekretessbelagda personuppgifter i register och journaler <br> l&auml;mnas ut till obeh&ouml;rig person, vilket kan inneb&auml;ra risk f&ouml;r liv och h&auml;lsa. <br><br><br> N&auml;r p ersoner med skyddad identitet skrivs in p&aring; akutmottagningen f&ouml;ljs nedanst&aring;ende rutiner: <br><br> Patienter med Skyddad identitet har ett s&auml;rskilt personnummer som de har f&aring;tt fr&aring;n folkbokf&ouml;ringen. <br> Namnet &auml;r d&aring; automatiskt bytt till PERSONUPPGIFTEN SKYDDAD <br><br> Dessa personer skall ha Upplysningsskydd i TC <br><br> Fr&aring;ga var patienten vill sitta och v&auml;nta. Vill patienten sitta p&aring; rum ska detta tillgodoses i den m&aring;n det <br> &auml;r m&ouml;jligt <br><br> Fr&aring;ga hur hon/han vill bli uppropad. Anteckna namn i Kommentarsf&auml;ltet i akutliggaren <br><br> Om patient en ej samtycker till sammanh&aring;llen journal skall journalen sp&auml;rras via <br> patientv&auml;gledaren enligt DSAB&acute;s riktlinjer <br><br> N&auml;r vi har en patient med skyddad ident itet som inte kan betala med kontokort och inte kan f&aring; <br> fakturan i handen s&aring; g&auml;ller f&ouml;ljande med postg&aring;ngen: <br> 1. Faktura skrivs <br> 2. L&auml;ggs i ett litet kuvert som klistras igen <br> 3. Skriv personnumret p&aring; det lilla kuvertet <br> 4. L&auml;gg det lilla kuvertet i ett st&ouml;rre kuvert och klistra igen <br> 5. Skriv adressen: F&ouml;rmedlingsuppdrag <br> 106 61 Stockholm <br> 6. St&auml;mpla med Akutmottagningens st&auml;mpel p&aring; baksidan av kuvertet (ifall kuvertet m&aring;ste returneras)</p></body></html>\n', NULL, 'skyddad-identitet', 0, 1, '1y', NULL, 1, NULL, '2016-04-14', '0000-00-00', '2015-04-14 17:48:38', '2015-04-14 17:53:57', NULL),
(8, '', 'published', NULL, 'Skapa reservnummer till DSAB', '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">\n<html><body><p>Akutmot tagningens reception &auml;r enda enheten p&aring; Danderyds sjukhus AB som kan skapa nya <br> reservnummer jourtid i PU</p>\r\n<ul><li>webben.</li>\r\n</ul><p>N&auml;r &ouml;vriga verksamheter p&aring; sjukhuset beh&ouml;ver v&aring;r assistans kring detta g&ouml;r vi enligt f&ouml;ljande: <br> Skapa ett r eservnummer enligt instruktion i Hur g&ouml;r man p&auml;rmen, Att ta ut reservnummer <br> Skriv ut en kopia p&aring; uttaget reservnummer <br> Uppge datum och aktuell avdelning/klinik som ska debiteras samt din signatur p&aring; kopian <br> Spara kopian i p&auml;rmen; Reservnummer till andra kliniker som finns i akutens receptio n <br> Underlaget (kopior ) samlas ihop och skickas till v&aring;r ekonomicontroller <br> Matilda M&aring;lqvist, hus 50 plan 7 ekonomiavdelningen 2</p>\r\n<ul><li>3 ggr/&aring;r</li>\r\n</ul><p>Arbetsinsatsen interndebiteras</p></body></html>\n', NULL, 'skapa-reservnummer-till-dsab', 0, 1, '1y', NULL, 1, NULL, '2016-04-14', '0000-00-00', '2015-04-14 17:48:44', '2015-04-14 17:54:01', NULL),
(9, '', 'published', NULL, 'Sjuksköterska med ledningsansvar (SLA) bemanningsrutin', '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">\n<html><body><p>Jourtid <br> N&auml;r bemanningsansvarig chefsjuksk&ouml;terska inte &auml;r p&aring; plats; kv&auml;llar, n&auml;tter och helger s&aring; &ouml;vertar <br> sjuksk&ouml;terska med ledningsansvar arbetsgivaransvaret <br><br> Som st&ouml;d f&ouml;r ledningsansva rig sjuksk&ouml;terska finns alltid bemanningsansvarig chefsjuksk&ouml;terska <br> tillg&auml;nglig per telefon. Svarar bemanningsansvarig chefsjuksk&ouml;terska inte direkt s&aring; ringer hon tillbaka <br> senast inom en timme. Rollen som ledningsansvarig sjuksk&ouml;terska kan vara utsatt d&auml;rf &ouml;r ser vi det <br> som oerh&ouml;rt v&auml;sentligt med chefst&ouml;d . <br> I chefsuppdraget ing&aring;r inte att &aring;ka in till arbetsplatsen jourtid f&ouml;rutom vid h&auml;ndelse av katastrof <br><br><br><br> Vid fr&aring;nvaro sjukdom, VAB etc. <br> Se &ouml;ver situationen p&aring; akuten, beh&ouml;ver passet ers&auml;ttas eller klarar vi oss &auml;nd&aring; <br><br> G&aring;r det att omf&ouml;rdela personal, t.ex. n&aring;gon som &auml;r disponibel, fr&aring;n v&aring;rdlag till triage eller tv&auml;rtom <br> eller finns det ngn som har ansvarstid eller annan uppgift som g&aring;r att skjuta till ett senare tillf&auml;lle. <br> Kanske r&auml;cker det med en punktinsat s vid ett &ouml;verbelastat tillf&auml;lle. <br><br><br> Om personen beh&ouml;ver ers&auml;ttas <br> V&auml;rdera hur m&aring;nga timmar av passet som beh&ouml;ver ers&auml;ttas <br><br> 1) Ring eller sms:a timanst&auml;llda <br><br> 2) Tillfr&aring;ga kollegor som redan &auml;r i tj&auml;nst, i f&ouml;rsta hand deltidare <br><br> 3) Tillfr&aring;ga kollegor som inte &auml;r i tj &auml;nst <br><br> 4) Beordring kan ev. bli aktuell t efter dialog med bemanningsansvarig chef <br><br> Extern bemanning tillfr&aring;gas inte vid akuta luckor jourtid utan planeras in med framf&ouml;rh&aring;llning <br><br><br><br><br> Dokumentation &ouml;ver fr&aring;nvaro och vidtagna &aring;tg&auml;rder skrivs ner p&aring; f&ouml;r h&auml;r avset t dokument och <br> rapporteras/l&auml;mnas till ansvarig chef n&auml;stkommande vardag.</p></body></html>\n', NULL, 'sjukskoterska-med-ledningsansvar--bemanningsrutin', 0, 1, '1y', NULL, 1, NULL, '2016-04-14', '0000-00-00', '2015-04-14 17:48:48', '2015-04-14 17:54:04', NULL),
(10, '', 'published', NULL, 'Sjukresor', '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">\n<html><body><p>Sjukresor <br><br> Patienter kan ers&auml;ttas ekonomisk helt elle r delvis - f&ouml;r kostnader med t ex taxi.</p>\r\n<p>D&auml;rvid g&auml;ller f&ouml;ljande <br> 1. Patienten har kommit med taxi (och &auml;r ber&auml;ttigad till reseers&auml;ttning). Bed&ouml;mning kan <br> g&ouml;ras av sjuksk&ouml;terska e ller l&auml;kare. Blanketten Sjukresa Hem/ers&auml;ttning fylls i komplett <br> och l&auml;mnas till patienten som g&aring;r till receptionen, d&auml;r skrivs blankett f&ouml;r reseers&auml;ttning <br> ut, patienten skriver under och skickar blankett + taxikvitto till Sjukreseenheten <br> 2. Patienten skall &aring;terv&auml;nda hem med taxi (och &auml;r ber&auml;ttigad till reseers&auml;ttning) <br> blanketten Sjukresa Hem/Ers&auml;ttning ifylls i till&auml;mpliga delar och l&auml;mnas till patienten <br> som sedan g&aring;r till receptionen och f&aring;r sjukresekortet laddat <br> 3. Patienten kommer med taxi men kan/vill inte betala. Dessa &auml;renden ska <br> taxichauff&ouml;ren sj&auml;lv hantera efter taxibolagets rutiner fr.o.m. 2014-04-21</p>\r\n<p>4. Patient fr&aring;n annat l&auml;n i Sverige (ULP), EU-land och Norden som &auml;r ber&auml;ttigad till</p>\r\n<p>sjukresa kan f&aring; detta beviljat av l&auml;kare eller sjuksk&ouml;terska hem till anh&ouml;rig/v&auml;n i <br> Stockholms l&auml;n samt sjukresor mellan v&aring;r dgivare i SLL. Dagtid vardagar faxas <br> blanketten Tillst&aring;nd f&ouml;r sjukresa eller specialfordon<br> till f&auml;rdtj&auml;nsten och d&auml;refter ringer <br> man f&auml;rdtj&auml;nst/sjukresor och de laddar sjukresekortet, s&aring; ha kortet till hands n&auml;r du <br> ringer. Jourtid anv&auml;nds sjukresebiljett tillsammans med ifylld blankett <br> Tillst&aring;nd f&ouml;r sjukresor <br><br> 5. Asyls&ouml;kande och tillst&aring;ndsl&ouml;sa som &auml;r ber&auml;ttigad till sjukresa f&aring;r sjukresan beviljad <br> om s&aring; &auml;r befogat av l&auml;kare eller sjuksk&ouml;terska. Dagtid vardagar faxas blanketten <br> Tillst&aring;nd f&ouml;r sjukresa eller specialfordon<br> till f&auml;rdtj&auml;nst/sjukresor. Kryssa i rutan f&ouml;r <br> asyls&ouml;kande och fyll i LMA-kortnummer. &Auml;r det ett ogiltigt LMA-kort anses patienten som tillst&aring;ndsl&ouml;s och d&aring; skrivs Tillst&aring;ndsl&ouml;s ist&auml;llet f&ouml;r LMA-kortnumret. D&auml;refter</p>\r\n<p>ringer man f&auml;rdtj&auml;nst/sjukresor och de laddar sjukresekortet s&aring; ha kortet till hands n&auml;r <br> du ringer. Jourtid anv&auml;nds sjukresebiljet t tillsammans med ifylld blankett <br> Tillst&aring;nd f&ouml;r sjukresor <br><br> Sjukresor ska anv&auml;ndas mycket restriktivt! <br><br> F&auml;rdtj&auml;nsten <br> Box 30103 <br> 104 25 Stockholm</p></body></html>\n', NULL, 'sjukresor', 0, 1, '1y', NULL, 1, NULL, '2016-04-14', '0000-00-00', '2015-04-14 17:49:15', '2015-04-14 17:54:07', NULL),
(11, 'VO-4-2', 'published', NULL, 'Presskontakter', '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">\n<html><body><p>Rutiner vid f&ouml;rfr&aring;gan fr&aring;n press/media, t ex efter olyckor.</p>\r\n<ul><li>Media f&ouml;ljer p&aring; olika s&auml;tt ambulanslarm och &ouml;nskar ibland snabbt f&aring; besked om h&auml;ndelsen</li>\r\n<li>Det &auml;r ett legitimt allm&auml;nintresse och skall tillgodoses under kontrollerade former med beaktande av patientens integritet och anh&ouml;rigas behov</li>\r\n<li>Pressf&ouml;rfr&aring;gningar som inkommer till akuten DS h&auml;nvisas till Sjuksk&ouml;terska med Ledningsansvar (SLA) p&aring; 08-123 556 71</li>\r\n<li>SLA g&ouml;r enligt f&ouml;ljande:</li>\r\n</ul><ol><li>Utan att bekr&auml;fta att patienten inkommit dokumentera f&ouml;rfr&aring;gan samt namn- och kontaktuppgifter till journalisten och meddela att vi ringer upp inom kort</li>\r\n<li>SLA kontaktar Pressansvarig alternativt Enheten f&ouml;r kommunikation. Pressansvarig finns p&aring; tfn 08-123 56 388 vardagar 08.00 &ndash; 17.00. Enheten f&ouml;r Kommunikation finns p&aring; 08-123 562 51 (Annakarin Svenningsson) vardagar 08.00-17.00. Det finns &auml;ven ett pressjoursnummer tfn 08-123 562 77.</li>\r\n<li>Jourtid h&auml;nvisas pressen till n&auml;stkommande vardag om det inte finns risk f&ouml;r en massmedial kris. Vid risk f&ouml;r en massmedial kris ska chefl&auml;kare i beredskap kontaktas.</li>\r\n<li>Vid st&ouml;rre olycka/katastrof blir Enheten f&ouml;r kommunikation jour genom Katastrofledningen p&aring; sjukhuset. Dessa pressamtal h&auml;nvisas d&aring; till v&auml;xeln.</li>\r\n</ol><p>L&auml;s mer i riktlinjen Massmediapolicy allm&auml;n.</p></body></html>\n', NULL, 'presskontakter', 0, 1, '1y', NULL, 1, NULL, '2016-04-14', '0000-00-00', '2015-04-14 18:12:40', '2015-04-14 18:16:00', NULL),
(12, 'SSK-432-21', 'published', NULL, 'Strålskyddsrutiner', '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">\n<html><body><p>M&aring;let f&ouml;r str&aring;lskyddet &auml;r att undvika on&ouml;dig bestr&aring;lning som medf&ouml;r on&ouml;diga risker. Personal och medf&ouml;ljande skall skyddas mot den spridda str&aring;lningen fr&aring;n patienten. Patienten skyddas genom optimering av unders&ouml;kningsmetod, t.ex. inbl&auml;ndning och l&auml;mplig dosniv&aring;.</p>\r\n<p>Varje enskild unders&ouml;kning/behandling skall vara ber&auml;ttigad samt optimerad f&ouml;r varje patient.</p>\r\n<p>All personal skall ha genomg&aring;tt str&aring;lskyddsutbildning samt handhavandeutbildning p&aring; aktuell utrustning.</p>\r\n<ol><li>Personal och medf&ouml;ljande som vistas inne i unders&ouml;kningsrummet vid genomlysning eller bildtagning skall b&auml;ra str&aring;lskyddsf&ouml;rkl&auml;de och halskrage.&nbsp;</li>\r\n<li>Angiorummen &auml;r klassade som kontrollerat omr&aring;de. Se vidare rutiner f&ouml;r vilka som f&aring;r vistas i kontrollerat omr&aring;de, &rdquo; Lokala rutiner f&ouml;r lokaler klassade som kontrollerat omr&aring;de.&rdquo;</li>\r\n<li>Till kategori A skall all personal h&ouml;ra som deltar i angiografiverksamhet och interventionella procedurer. Personal i kategori A skall alltid b&auml;ra personlig dosimeter vid arbete p&aring; angiolab. L&auml;kare skall &auml;ven ha handdosimeter f&ouml;r kontroll av dosgr&auml;nsen f&ouml;r h&auml;nder.</li>\r\n<li>F&ouml;r kvinnliga patienter i fertil &aring;lder, se &rdquo;Rutiner f&ouml;r kvinnor i fertil &aring;lder som skall genomg&aring; r&ouml;ntgenunders&ouml;kning.&rdquo;</li>\r\n<li>F&ouml;r kvinnlig personal i fertil &aring;lder, se &rdquo;Handl&auml;ggning av gravid personal i verksamhet med joniserande str&aring;lning&rdquo; &nbsp;</li>\r\n<li>Str&aring;lskyddskl&auml;der/halskragar skall &aring;rligen unders&ouml;kas genom visuell inspektion med avseende p&aring; skador. Om yttre skador uppt&auml;cks skall str&aring;lskyddet r&ouml;ntgengenomlysas.</li>\r\n<li>Efter varje patient skall str&aring;ldosen tillsammans med genomlysningstiden registreras i Swedeheart respektive pacemakerregistret.&nbsp;</li>\r\n<li>F&ouml;r pacemakerverksamheten skall en dosrapport printas ut f&ouml;r varje patient d&auml;r str&aring;ldos och genomlysningstid finns med. Dosrapporterna samlas i en p&auml;rm och skickas m&aring;nadsvis till Sjukhusfysik.&nbsp;</li>\r\n<li>Tillbud med str&aring;lning skall omedelbart anm&auml;las till Enheten f&ouml;r sjukhusfysik samt rapporteras i H&auml;ndelseVis.</li>\r\n<li>Om dosgr&auml;nsen f&ouml;r patienter, 300 Gycm2 (30 000 cGycm2), &ouml;verskrids skall detta omedelbart anm&auml;las till Enheten f&ouml;r sjukhusfysik. F&ouml;r vidare handl&auml;ggning se &rdquo;Rutiner vid &ouml;verskridande av huddosgr&auml;ns&rdquo;.&nbsp;</li>\r\n</ol></body></html>\n', NULL, 'stralskyddsrutiner', 0, 1, '1y', NULL, 1, NULL, '2016-04-14', '0000-00-00', '2015-04-14 18:25:08', '2015-04-14 18:26:18', NULL),
(13, 'EX-13', 'published', NULL, 'Exempel-PM', '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">\n<html><body><p>Det h&auml;r &auml;r ett exempel-PM.</p></body></html>\n', NULL, 'exempel-pm-7', 0, 1, '1y', NULL, 1, NULL, '2016-04-14', '0000-00-00', '2015-04-14 18:27:34', '2015-04-14 18:27:56', NULL),
(14, 'VSU-523-212', 'assigned', NULL, 'Papperskorgarnas standard', '', NULL, 'papperskorgarnas-standard', 0, 0, '1y', NULL, 25, NULL, NULL, '0000-00-00', '2015-04-14 19:07:36', '2015-04-14 19:07:36', NULL),
(15, 'DRIF-3422', 'written', NULL, 'Sömnbrist hos personalen', '', '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">\n<html><body><p>H&auml;r &auml;r en text om s&ouml;mnbrist hos personalen.</p></body></html>\n', 'somnbrist-hos-personalen', 0, 0, '1y', NULL, 25, NULL, NULL, '0000-00-00', '2015-04-14 19:09:07', '2015-04-14 19:09:31', NULL),
(16, 'PAPP-4234', 'assigned', NULL, 'Papperssortering', '', '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">\n<html><body><p>Det h&auml;r &auml;r ett d&aring;ligt PM.</p></body></html>\n', 'papperssortering', 0, 0, '1y', NULL, 25, NULL, NULL, '0000-00-00', '2015-04-14 19:13:21', '2015-04-14 19:16:23', NULL),
(17, 'X2000', 'written', NULL, 'Checklista för nyanställd läkare vid Hudkliniken', '', '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">\n<html><body><h2 style="padding-left: 60px;">Checklista f&ouml;r nyanst&auml;lld l&auml;kare vid Hudmottagningen &nbsp;</h2>\r\n<div style="padding-left: 60px;">Namn:</div>\r\n<div style="padding-left: 60px;">Fadder: &nbsp;</div>\r\n<div style="padding-left: 60px;">&nbsp;</div>\r\n<div style="padding-left: 60px;">&iuml;&#129;&sup2; Best&auml;lla namnskylt</div>\r\n<div style="padding-left: 60px;">&iuml;&#129;&sup2; Best&auml;lla st&auml;mpel &nbsp;</div>\r\n<div style="padding-left: 60px;">&iuml;&#129;&sup2; Utse arbetsplats</div>\r\n<div style="padding-left: 60px;">&iuml;&#129;&sup2; Nycklar &nbsp;</div>\r\n<div style="padding-left: 60px;">&iuml;&#129;&sup2; Postfack &nbsp;</div>\r\n<div style="padding-left: 60px;">&iuml;&#129;&sup2; Rutiner vid diktering, genomg&aring;ng med sekreterare</div>\r\n<div style="padding-left: 60px;">&iuml;&#129;&sup2; Telefonanknytning skall meddelas till v&auml;xeln</div>\r\n<div style="padding-left: 60px;">&iuml;&#129;&sup2; Larm, koder &nbsp;</div>\r\n<div style="padding-left: 60px;">&iuml;&#129;&sup2; Personalparkering &nbsp;</div>\r\n<div style="padding-left: 60px;">&iuml;&#129;&sup2; Personalmatsal &nbsp;</div>\r\n<div style="padding-left: 60px;">&iuml;&#129;&sup2; ID-kort (dator) &nbsp;</div>\r\n<div style="padding-left: 90px;">- &iuml;&#129;&sup2; Kort</div>\r\n<div style="padding-left: 90px;">- &iuml;&#129;&sup2; Befogenheter till 211</div>\r\n<div style="padding-left: 90px;">- &iuml;&#129;&sup2; F&ouml;rskrivarkod f&ouml;r att skriva e-recept</div>\r\n<div style="padding-left: 60px;">&iuml;&#129;&sup2; Schema &nbsp;&iuml;&#129;&sup2; Kom &amp; G&aring;</div>\r\n<div style="padding-left: 60px;">&iuml;&#129;&sup2; Intran&auml;t &nbsp;</div>\r\n<div style="padding-left: 60px;">&iuml;&#129;&sup2; Sj&auml;lvservice &nbsp;</div>\r\n<div style="padding-left: 60px;">&iuml;&#129;&sup2; Rutiner vid fr&aring;nvaro &nbsp;</div>\r\n<div style="padding-left: 90px;">- &iuml;&#129;&sup2; Semester</div>\r\n<div style="padding-left: 90px;">- &iuml;&#129;&sup2; Utbildning</div>\r\n<div style="padding-left: 90px;">- &iuml;&#129;&sup2; Sjuk</div>\r\n<div style="padding-left: 60px;">&iuml;&#129;&sup2; TakeCare, Dorisutbildning</div>\r\n<div style="padding-left: 60px;">&iuml;&#129;&sup2; HLR &nbsp;</div>\r\n<div style="padding-left: 90px;">- &iuml;&#129;&sup2; Att larma fr&aring;n rum &nbsp;</div>\r\n<div style="padding-left: 90px;">- &iuml;&#129;&sup2; Att larma resc. team &nbsp;</div>\r\n<div style="padding-left: 90px;">- &iuml;&#129;&sup2; Akutv&auml;ska och l&auml;kemedel &nbsp;</div>\r\n<div style="padding-left: 90px;">- &iuml;&#129;&sup2; Utbildning med mini-Anne &nbsp;</div>\r\n<div style="padding-left: 60px;">&iuml;&#129;&sup2; Utrymningsv&auml;gar vid Brand &nbsp;</div>\r\n<div style="padding-left: 90px;">- &iuml;&#129;&sup2; Boka tid med Berit som visar</div>\r\n<div style="padding-left: 60px;">&iuml;&#129;&sup2; Hygienregler och kl&auml;df&ouml;rr&aring;d &nbsp;&nbsp;</div></body></html>\n', 'checklista-for-nyanstalld-lakare-vid-hudkliniken', 0, 0, '1y', NULL, 1, NULL, NULL, '0000-00-00', '2015-04-14 19:14:13', '2015-04-14 19:21:18', NULL),
(18, 'R2D2', 'assigned', NULL, 'Äggallergi och influensavaccination', '', '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">\n<html><body><h1>Influensavaccinering av personer som har sv&aring;r allergi mot &auml;gg eller andra &auml;mnen</h1>\r\n<h3>Det influensavaccin som &auml;r upphandlat och anv&auml;nds i Stockholms l&auml;ns landsting (Fluarix&reg;) &auml;r odlat p&aring; h&ouml;ns&auml;gg och det f&auml;rdiga vaccinet inneh&aring;ller sm&aring; m&auml;ngder av &rdquo;&auml;gg-protein&rdquo;.</h3>\r\n<h3>Personer med lindrig &auml;ggallergi &ndash; som kan &auml;ta mat med &auml;gg i, som sockerkaka eller pannkakor, utan att reagera allergiskt - kan i regel vaccineras med Fluarix, om de kan observeras 30 min efter vaccinationen med beredskap f&ouml;r att kunna behandla en allergisk reaktion.</h3>\r\n<h3>F&ouml;r personer med mer uttalad &auml;ggallergi hade SLL upphandlat Inflexal V&reg; (Crucell), d&auml;r halten av &auml;ggprotein &auml;r s&aring; l&aring;gt att de flesta &auml;ggallergiker, med undantag av de som reagerat med anafylaxi, kan ges vaccinet under sedvanlig &ouml;vervakning. Tyv&auml;rr har det visat sig att f&ouml;retaget inte kan leverera vaccinet till denna s&auml;song p g a en inte n&auml;rmare specificerad &rdquo;kvalitetsbrist&rdquo; i n&aring;gra av tillverkningssatserna utanf&ouml;r Sverige. Det finns tyv&auml;rr inget annat influensavaccin p&aring; marknaden som kan ges till personer med uttalad &auml;ggallergi.</h3>\r\n<h3>Personer som har uttalad &auml;ggallergi och som tillh&ouml;r en riskgrupp f&ouml;r att f&aring; sv&aring;r influensa b&ouml;r d&auml;rf&ouml;r f&aring; m&ouml;jlighet att diskutera med en allergolog - eller n&auml;r det g&auml;ller barn en allergikunnig barnl&auml;kare som vid behov kan remittera vidare till Specialistmottagningen f&ouml;r barnvacciner p&aring; Sachsska barn- och ungdomssjukhuset - om det &auml;nd&aring; kan g&aring; att vaccinera under speciell uppsikt.</h3>\r\n<h3>Personer som tillh&ouml;r de grupper som riskerar att f&aring; en sv&aring;r eller komplicerad influensa och som inte kan vaccineras p g a &auml;ggallergi b&ouml;r f&aring; information om att de ska kontakta sin l&auml;kare vid misstanke p&aring; att de drabbats av influensa f&ouml;r st&auml;llningstagande till behandling med antiviral terapi.&nbsp;</h3></body></html>\n', 'aggallergi-och-influensavaccination', 0, 0, '1y', NULL, 1, NULL, NULL, '0000-00-00', '2015-04-14 19:25:16', '2015-04-14 19:32:04', NULL),
(19, '9001', 'assigned', NULL, 'Hälsodeklaration för vuxna', '', '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">\n<html><body><p style="padding-left: 600px;">Vaccinationsdatum ________</p>\r\n<p style="padding-left: 600px;">Personnummer __________</p>\r\n<p style="padding-left: 600px;">Namn________________</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>_________________________________________________________________________</p>\r\n<p>Har du allergi mot &auml;gg?</p>\r\n<p>Har du haft s&aring; sv&aring;r allergisk reaktion mot n&aring;got annat att det var n&ouml;dv&auml;ndigt att s&ouml;ka sjukv&aring;rd?</p>\r\n<p>Har du reagerat kraftigt p&aring; tidigare vaccinationer?</p>\r\n<p>Har du f&aring;tt annan vaccination de senaste 2-4 veckorna?</p>\r\n<p>Har du bl&ouml;darsjuka eller annan bl&ouml;dningsben&auml;genhet?</p>\r\n<p>Har du n&aring;gon kronisk sjukdom?</p>\r\n<p style="padding-left: 30px;">Om ja, har du:</p>\r\n<p style="padding-left: 30px;">Kronisk lungsjukdom, inklusive astma</p>\r\n<p style="padding-left: 30px;">Kraftig &ouml;vervikt (BMI&gt;40)</p>\r\n<p style="padding-left: 30px;">Neuromuskul&auml;r sjukdom (till exempel MS)</p>\r\n<p style="padding-left: 30px;">Kronisk hj&auml;rtk&auml;rlsjukdom (dock inte enbart f&ouml;rh&ouml;jt blodtryck)</p>\r\n<p style="padding-left: 30px;">&Ouml;kad risk f&ouml;r infektioner</p>\r\n<p style="padding-left: 30px;">(till exempel immunsbristsjukdom, men ocks&aring; andra tillst&aring;nd</p>\r\n<p style="padding-left: 30px;">s&aring;som cancer eller autoimmunitet d&auml;r sjukdomen i sig</p>\r\n<p style="padding-left: 30px;">eller behandlingen medf&ouml;r en &ouml;kad risk f&ouml;r infektioner)</p>\r\n<p style="padding-left: 30px;">Kronisk lever- eller njursvikt</p>\r\n<p style="padding-left: 30px;">Diabetes mellitus</p>\r\n<p style="padding-left: 30px;">CP/multifunktionshandikapp</p>\r\n<p>&Auml;r du gravid?</p>\r\n<p style="padding-left: 30px;">Om ja, vilken graviditetsvecka:</p>\r\n<p>Samtycker du till att dina vaccinationsuppgifter g&aring;r att l&auml;sas av andra v&aring;rdgivare?</p>\r\n<p>_________________________________________________________________________</p></body></html>\n', 'halsodeklaration-for-vuxna', 0, 0, '1y', NULL, 1, NULL, NULL, '0000-00-00', '2015-04-14 19:26:26', '2015-04-14 19:38:39', NULL),
(20, '1994', 'assigned', NULL, 'Strålskyddsrutiner - PCI Coronar Pacemaker', '', '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">\n<html><body><p class="western">M&aring;let f&ouml;r str&aring;lskyddet &auml;r att undvika on&ouml;dig bestr&aring;lning som medf&ouml;r on&ouml;diga risker. Personal och medf&ouml;ljande skall skyddas mot den spridda str&aring;lningen fr&aring;n patienten. Patienten skyddas genom optimering av unders&ouml;kningsmetod, t.ex. inbl&auml;ndning och l&auml;mplig dosniv&aring;.</p>\r\n<p class="western">&nbsp;</p>\r\n<p class="western"><span style="font-size: 10pt;"><span style="font-size: 12pt;">Varje enskild unders&ouml;kning/behandling skall vara </span><span style="font-size: 12pt;"><strong>ber&auml;ttigad</strong></span><span style="font-size: 12pt;"> samt </span><span style="font-size: 12pt;"><strong>optimerad</strong></span><span style="font-size: 12pt;"> f&ouml;r varje patient.</span></span></p>\r\n<p class="western">&nbsp;</p>\r\n<p class="western"><span style="font-size: 10pt;"><span style="font-size: 12pt;">All personal skall ha genomg&aring;tt </span><span style="font-size: 12pt;"><strong>str&aring;lskyddsutbildning </strong></span><span style="font-size: 12pt;">samt</span><span style="font-size: 12pt;"><strong> handhavandeutbildning p&aring; aktuell utrustning</strong></span><span style="font-size: 12pt;">.</span></span></p>\r\n<p class="western">&nbsp;</p>\r\n<ol><li>\r\n<p class="western"><span style="font-size: 10pt;"><span style="font-size: 12pt;">Personal och medf&ouml;ljande som vistas inne i unders&ouml;kningsrummet vid genomlysning eller bildtagning skall b&auml;ra str&aring;lskyddsf&ouml;rkl&auml;de och halskrage. </span></span></p>\r\n</li>\r\n</ol><p class="western" style="margin-left: 0.64cm; widows: 0; orphans: 0;">&nbsp;</p>\r\n<ol start="2"><li>\r\n<p class="western"><span style="font-size: 10pt;"><span style="font-size: 12pt;">Angiorummen &auml;r klassade som kontrollerat omr&aring;de. Se vidare rutiner f&ouml;r vilka som f&aring;r vistas i kontrollerat omr&aring;de, </span><span style="font-size: 12pt;">&rdquo;</span><span style="font-size: 12pt;"><strong> Lokala rutiner f&ouml;r lokaler klassade som kontrollerat omr&aring;de.&rdquo;</strong></span></span></p>\r\n</li>\r\n</ol><p class="western">&nbsp;</p>\r\n<ol start="3"><li>\r\n<p class="western"><span style="font-size: 10pt;"><span style="font-size: 12pt;">Till </span><span style="font-size: 12pt;"><strong>kategori A</strong></span><span style="font-size: 12pt;"> skall all personal h&ouml;ra som deltar i angiografiverksamhet och interventionella procedurer. Personal i </span><span style="font-size: 12pt;"><strong>kategori A</strong></span><span style="font-size: 12pt;"> skall alltid b&auml;ra personlig dosimeter vid arbete p&aring; angiolab. L&auml;kare skall &auml;ven ha handdosimeter f&ouml;r kontroll av dosgr&auml;nsen f&ouml;r h&auml;nder.</span></span></p>\r\n</li>\r\n</ol><p class="western">&nbsp;</p>\r\n<ol start="4"><li>\r\n<p class="western"><span style="font-size: 10pt;"><span style="font-size: 12pt;">F&ouml;r kvinnliga </span><span style="font-size: 12pt;"><strong>patienter</strong></span><span style="font-size: 12pt;"> i fertil &aring;lder, se &rdquo;Rutiner f&ouml;r kvinnor i fertil &aring;lder som skall genomg&aring; r&ouml;ntgenunders&ouml;kning.&rdquo;</span></span></p>\r\n</li>\r\n</ol><p class="western">&nbsp;</p>\r\n<ol start="5"><li>\r\n<p class="western"><span style="font-size: 10pt;"><span style="font-size: 12pt;">F&ouml;r kvinnlig </span><span style="font-size: 12pt;"><strong>personal</strong></span><span style="font-size: 12pt;"> i fertil &aring;lder, se </span><span style="font-size: 12pt;">&rdquo;Handl&auml;ggning av gravid personal i verksamhet med joniserande str&aring;lning&rdquo; </span></span></p>\r\n</li>\r\n</ol><p class="western">&nbsp;</p>\r\n<ol start="6"><li>\r\n<p class="western"><span style="font-size: 10pt;"><span style="font-size: 12pt;">Str&aring;lskyddskl&auml;der/halskragar skall &aring;rligen unders&ouml;kas genom visuell inspektion med avseende p&aring; skador. Om yttre skador uppt&auml;cks skall str&aring;lskyddet r&ouml;ntgengenomlysas.</span></span></p>\r\n</li>\r\n</ol><p class="western">&nbsp;</p>\r\n<ol start="7"><li>\r\n<p class="western"><span style="font-size: 10pt;"><span style="font-size: 12pt;">Efter varje patient skall </span><span style="font-size: 12pt;"><strong>str&aring;ldosen</strong></span><span style="font-size: 12pt;"> tillsammans med genomlysningstiden registreras i Swedeheart respektive </span><span style="font-size: 12pt;"><span style="background: #ffff00;">pacemakerregistret</span></span><span style="font-size: 12pt;">. </span></span></p>\r\n</li>\r\n</ol><p class="western">&nbsp;</p>\r\n<ol start="8"><li>\r\n<p class="western"><span style="font-size: 10pt;"><span style="font-size: 12pt;">F&ouml;r pacemakerverksamheten skall en dosrapport printas ut f&ouml;r varje patient d&auml;r str&aring;ldos och genomlysningstid finns med. Dosrapporterna samlas i en p&auml;rm och skickas m&aring;nadsvis till Sjukhusfysik. </span></span></p>\r\n</li>\r\n</ol><p class="western">&nbsp;</p>\r\n<ol start="9"><li>\r\n<p class="western"><span style="font-size: 12pt;">Tillbud med str&aring;lning skall omedelbart anm&auml;las till Enheten f&ouml;r sjukhusfysik samt rapporteras i H&auml;ndelseVis.</span></p>\r\n</li>\r\n</ol><p class="western">&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<ol start="10"><li>\r\n<p class="western"><span style="font-size: 10pt;"><span style="font-size: 12pt;">Om dosgr&auml;nsen f&ouml;r patienter, 300 Gycm</span><sup><span style="font-size: 12pt;">2 </span></sup><span style="font-size: 12pt;">(30&nbsp;000 c</span><span style="font-size: 12pt;">Gycm</span><sup><span style="font-size: 12pt;">2</span></sup><span style="font-size: 12pt;">),</span><span style="font-size: 12pt;"> &ouml;verskrids skall detta omedelbart anm&auml;las till Enheten f&ouml;r sjukhusfysik. F&ouml;r vidare handl&auml;ggning se &rdquo;Rutiner vid &ouml;verskridande av huddosgr&auml;ns&rdquo;.&nbsp;</span></span></p>\r\n</li>\r\n</ol></body></html>\n', 'stralskyddsrutiner-pci-coronar-pacemaker', 0, 0, '1y', NULL, 1, NULL, NULL, '0000-00-00', '2015-04-14 19:27:17', '2015-04-14 19:39:46', NULL),
(21, '1337', 'assigned', NULL, 'Akut extern pacing - via defibrillator LP 20', '', NULL, 'akut-extern-pacing-via-defibrillator-lp-20', 0, 0, '2y', NULL, 1, NULL, NULL, '0000-00-00', '2015-04-14 19:28:31', '2015-04-14 19:28:31', NULL),
(22, '1111', 'assigned', NULL, 'Akuta koronara syndrom', '', '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">\n<html><body><p style="margin-top: 0.42cm; margin-bottom: 0.11cm; line-height: 100%;"><span style="font-size: 12pt;"><strong>Akuta koronara syndrom</strong></span></p>\r\n<p style="margin-top: 0.42cm; margin-bottom: 0.11cm; line-height: 100%;"><span style="font-size: 12pt;">Delas in i:</span></p>\r\n<ol><li>\r\n<p class="western" style="margin-bottom: 0cm; line-height: 100%;">ST-h&ouml;jningsinfarkt (STEMI)</p>\r\n</li>\r\n<li>\r\n<p class="western" style="margin-bottom: 0cm; line-height: 100%;">Icke-ST-h&ouml;jningsinfarkt (NSTEMI)</p>\r\n</li>\r\n<li>\r\n<p class="western" style="margin-bottom: 0cm; line-height: 100%;">Instabil angina</p>\r\n</li>\r\n</ol><p class="western" style="margin-bottom: 0cm; line-height: 100%;">&nbsp;</p>\r\n<p class="western" style="margin-bottom: 0cm; line-height: 100%;">F&ouml;r handl&auml;ggning och behandling h&auml;nvisas till kompendium i &rdquo;Akut Hj&auml;rtsjukv&aring;rd&rdquo;.</p>\r\n<p class="western" style="margin-bottom: 0cm; line-height: 100%;">Dessa patienter &auml;r alltid inl&auml;ggningsfall.</p>\r\n<p class="western" style="margin-bottom: 0cm; line-height: 100%;">&nbsp;</p>\r\n<p class="western" style="margin-bottom: 0cm; line-height: 100%;"><strong>V&auml;rdering av risk och bl&ouml;dning</strong></p>\r\n<p class="western" style="margin-bottom: 0cm; line-height: 100%;">Riskv&auml;rdering kan ske med hj&auml;lp av olika risk-scorer. Den b&auml;st validerade scoren &auml;r den s.k. GRACE-scoren som &auml;r ganska komplicerad men det finns en bra kalkylator p&aring; Internet; <span style="color: #0000ff;"><span style="text-decoration: underline;"><a href="http://www.outcomes.org/grace/">www.outcomes.org/grace/</a></span></span>. Ett resultat med &ge;3% d&ouml;dlighet under v&aring;rdtiden, eller &ge;8% inom 6 m&aring;nader, indikerar h&ouml;g risk.</p>\r\n<p class="western" style="margin-bottom: 0cm; line-height: 100%;">Enklare att anv&auml;nda &auml;r TIMI risk score d&auml;r sju parametrar ger 0 eller 1 po&auml;ng, sammanlagt &ge;3 p = h&ouml;g risk.</p>\r\n<ul><li>\r\n<p class="western" style="margin-bottom: 0cm; line-height: 100%;">&Aring;lder &ge;65 &aring;r</p>\r\n</li>\r\n</ul><ul><li>\r\n<p class="western" style="margin-bottom: 0cm; line-height: 100%;">3 eller fler av riskfaktorerna: hereditet, hypertoni, hyperlipidemi, diabetes, r&ouml;kning</p>\r\n</li>\r\n<li>\r\n<p class="western" style="margin-bottom: 0cm; line-height: 100%;">K&auml;nd signifikant koronarsjukdom</p>\r\n</li>\r\n<li>\r\n<p class="western" style="margin-bottom: 0cm; line-height: 100%;">ST-s&auml;nkning/h&ouml;jning p&aring; EKG</p>\r\n</li>\r\n<li>\r\n<p class="western" style="margin-bottom: 0cm; line-height: 100%;">2 eller fler angina-attacker senaste dygnet</p>\r\n</li>\r\n<li>\r\n<p class="western" style="margin-bottom: 0cm; line-height: 100%;">Medicinering med ASA sedan minst 7 dagar f&ouml;re inkomsten</p>\r\n</li>\r\n<li>\r\n<p class="western" style="margin-bottom: 0cm; line-height: 100%;">F&ouml;rh&ouml;jt troponin T</p>\r\n</li>\r\n</ul><p class="western" style="margin-bottom: 0cm; line-height: 100%;">Crusade bleeding risk score rekommenderas i ESC guidelines. Hematokrit, Kreatinin clearence, hj&auml;rtfrekvens, k&ouml;n, f&ouml;rekomst av diabetes mellitus, hj&auml;rtsvikt och vaskul&auml;r sjukdom samt systolisk BT ing&aring;r som parametrar och risk kalkylator finns p&aring; <span style="color: #0000ff;"><span style="text-decoration: underline;"><a href="http://www.crusadebleedingscore.org/">www.crusadebleedingscore.org</a></span></span>.</p>\r\n<p class="western" style="margin-bottom: 0cm; line-height: 100%;">Bet&auml;nk att en stor bl&ouml;dning ofta ger en st&ouml;rre relativ risk j&auml;mf&ouml;rt med en ischemisk h&auml;ndelse.</p>\r\n<p class="western" style="margin-bottom: 0cm; line-height: 100%;">&nbsp;</p>\r\n<p class="western" style="margin-bottom: 0cm; line-height: 100%;"><strong>Vilka ska ha mer antitrombotisk behandling &auml;n bara ASA?</strong></p>\r\n<p class="western" style="margin-bottom: 0cm; line-height: 100%;">Endast patienter med objektiva tecken p&aring; AKS (f&ouml;rh&ouml;jt Hs-TnT och/eller ST-f&ouml;r&auml;ndringar) ordineras clopidogrel/ticagrelor samt inj fondaparinux s.c. efter beaktande av risken f&ouml;r bl&ouml;dningskomplikation (se nedan). Detta &auml;r viktigt f&ouml;r att t.ex. patienter med aortadissektion ej skall ges dessa potenta l&auml;kemedel, som f&ouml;rsv&aring;rar m&ouml;jligheterna f&ouml;r lyckad kirurgisk behandling.</p>\r\n<p class="western" style="margin-bottom: 0cm; line-height: 100%;">Fondaparinux ordineras i dosen 2,5 mg s.c.en g&aring;ng per dygn, ev reducerad dos vid njursvikt (ber&auml;knat GFR&lt;30ml/min). Andra dosen ges 16-24 timmar efter den f&ouml;rsta, med sikte p&aring; daglig ordinationstid kl. 08.00 eller 20.00 (se lathund nedan).</p>\r\n<p class="western" style="margin-bottom: 0cm; line-height: 100%;">&nbsp;</p>\r\n<p class="western" style="margin-bottom: 0cm; line-height: 100%;"><strong>Troponin</strong></p>\r\n<p class="western" style="margin-bottom: 0cm; line-height: 100%;">Provtagning f&ouml;r Hs-TnT skall ske vid inkomst samt efter sex timmar.</p>\r\n<p class="western" style="margin-bottom: 0cm; line-height: 100%;">&nbsp;</p>\r\n<p class="western" style="margin-bottom: 0cm; line-height: 100%;"><strong>&Ouml;vervakning</strong></p>\r\n<p class="western" style="margin-bottom: 0cm; line-height: 100%;">Patienten &ouml;vervakas med kontinuerlig ST-monitorering f&ouml;r att uppt&auml;cka ev. &ouml;verg&aring;ende ST-f&ouml;r&auml;ndringar. Om inte ST-monitorering finns tillg&auml;nglig b&ouml;r patienten &ouml;vervakas med telemetri och med upprepade registreringar av 12-avlednings-EKG, tex. vid sm&auml;rta och 10 timmar efter inkomst.</p>\r\n<p class="western" style="margin-bottom: 0cm; line-height: 100%;">&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p class="western" style="margin-bottom: 0cm; line-height: 100%;">Vid &aring;terkommande ischemiska br&ouml;stsm&auml;rtor och/eller dynamiska ST-f&ouml;r&auml;ndringar trots full behandling enligt ovan tas kontakt med hj&auml;rtbakjour f&ouml;r diskussion om omedelbar kontakt med angiolab/PCI-jour &auml;r aktuell. I andra hand ordineras infusion Aggrastat enligt s&auml;rskilt PM.</p></body></html>\n', 'akuta-koronara-syndrom', 0, 0, '1y', NULL, 1, NULL, NULL, '0000-00-00', '2015-04-14 19:29:04', '2015-04-14 19:45:06', NULL);
INSERT INTO `pms` (`id`, `code`, `status`, `safetystatus`, `title`, `content`, `draft`, `token`, `department`, `published`, `validity_period`, `validity_date`, `created_by`, `revision_date`, `expiration_date`, `first_published_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(23, '1691', 'assigned', NULL, 'Non-invasiv ventilation', '', '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">\n<html><body><p class="western" style="margin-bottom: 0.42cm; line-height: 100%;"><strong><span style="font-size: 18pt;"><span style="text-decoration: underline;">Non-invasiv ventilation (NIV)</span></span></strong></p>\r\n<ul><li>\r\n<p class="western" style="margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><strong><span style="font-size: 10pt;"><span style="font-weight: normal;">Ventilationsst&ouml;d levererad genom patientens &ouml;vre luftv&auml;g via mask eller liknande hj&auml;lpmedel &auml;r en bepr&ouml;vad och </span></span></strong></p>\r\n</li>\r\n</ul><p class="western" style="margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><strong> <span style="font-size: 10pt;"><span style="font-weight: normal;">v&auml;ldokumenterad metod som minskar intubationsbehov, mortalitet samt f&ouml;rl&auml;ngd sjukhusvistelse.</span></span></strong></p>\r\n<p class="western" style="margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><strong> <span style="font-size: 10pt;"><span style="font-weight: normal;">Det &auml;r aldrig felaktigt att p&aring;b&ouml;rja behandling med NIV om inga kontraindikationer f&ouml;religger men &ouml;verv&auml;g </span></span></strong></p>\r\n<p class="western" style="margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><strong> <span style="font-size: 10pt;"><span style="font-weight: normal;">kontakt med narkosjour f&ouml;r st&auml;llningstagande till intubation om patienten inte f&ouml;rb&auml;ttras.</span></span></strong></p>\r\n<p class="western" style="margin-top: 0.49cm; margin-bottom: 0.49cm; line-height: 100%;"><strong><span style="font-size: 10pt;">Indikationer (hypoxi med/eller utan CO2-retention):</span></strong></p>\r\n<ul><li>\r\n<p class="western" style="margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><span style="font-size: 10pt;">Dekompenserad hj&auml;rtsvikt</span></p>\r\n</li>\r\n<li>\r\n<p class="western" style="margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><span style="font-size: 10pt;">Lung&ouml;dem</span></p>\r\n</li>\r\n<li>\r\n<p class="western" style="margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><span style="font-size: 10pt;">KOL/obstruktivitet</span></p>\r\n</li>\r\n<li>\r\n<p class="western" style="margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><span style="font-size: 10pt;">Pneumoni </span></p>\r\n</li>\r\n<li>\r\n<p class="western" style="margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><span style="font-size: 10pt;">S&ouml;mnapnesyndrom</span></p>\r\n</li>\r\n<li>\r\n<p class="western" style="margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><span style="font-size: 10pt;">Restriktiv lungsjukdom</span></p>\r\n</li>\r\n<li>\r\n<p class="western" style="margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><span style="font-size: 10pt;">Thoraxtrauma (thoraxdr&auml;n om pneumothorax)</span></p>\r\n</li>\r\n<li>\r\n<p class="western" style="margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><span style="font-size: 10pt;">Neuromuskul&auml;r sjukdom</span></p>\r\n</li>\r\n<li>\r\n<p class="western" style="margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><span style="font-size: 10pt;">Postoperativ andningssvikt</span></p>\r\n</li>\r\n<li>\r\n<p class="western" style="margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><span style="font-size: 10pt;">Immunsupprimerade patienter (tex organtransplanterade)</span></p>\r\n</li>\r\n<li>\r\n<p class="western" style="margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><span style="font-size: 10pt;">Pat som inte kan intuberas</span></p>\r\n</li>\r\n</ul><p class="western" style="margin-top: 0.49cm; margin-bottom: 0.49cm; line-height: 100%;"><span style="font-size: 10pt;"><strong>Kontraindikationer:</strong></span></p>\r\n<ul><li>\r\n<p class="western" style="margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><span style="font-size: 10pt;">Behov av akut intubation</span></p>\r\n</li>\r\n<li>\r\n<p class="western" style="margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><span style="font-size: 10pt;">Medvetandes&auml;nkt, agiterad eller icke samarbetsvillig patient</span></p>\r\n</li>\r\n<li>\r\n<p class="western" style="margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><span style="font-size: 10pt;">Aspirationsrisk, nedsatt sv&auml;ljfunktion eller ventrikelretention</span></p>\r\n</li>\r\n<li>\r\n<p class="western" style="margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><span style="font-size: 10pt;">Pneumothorax utan dr&auml;nage</span></p>\r\n</li>\r\n<li>\r\n<p class="western" style="margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><span style="font-size: 10pt;">Palliativ behandlig kan utg&ouml;ra en relativ kontraindikation</span></p>\r\n</li>\r\n<li>\r\n<p class="western" style="margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><span style="font-size: 10pt;">Hemodynamisk instabilitet med systoliskt BT &lt; 70 mmHg</span></p>\r\n</li>\r\n<li>\r\n<p class="western" style="margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><span style="font-size: 10pt;">Systoliskt BT &lt;90 mmHg &auml;r en relativ kontraindikation</span></p>\r\n</li>\r\n<li>\r\n<p class="western" style="margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><span style="font-size: 10pt;">H&ouml;gt luftv&auml;gshinder</span></p>\r\n</li>\r\n<li>\r\n<p class="western" style="margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><span style="font-size: 10pt;">Akut sinuit el mediaotit</span></p>\r\n</li>\r\n<li>\r\n<p class="western" style="margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><span style="font-size: 10pt;">N&auml;sbl&ouml;dning</span></p>\r\n</li>\r\n<li>\r\n<p class="western" style="margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><span style="font-size: 10pt;">Trauma mot ansiktet (tex br&auml;nnskada eller fraktur)</span></p>\r\n</li>\r\n<li>\r\n<p class="western" style="margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><span style="font-size: 10pt;">Nyopererad (tex &ouml;vre GI, luftv&auml;g eller ansikte)</span></p>\r\n</li>\r\n</ul><p class="western" style="margin-top: 0.49cm; margin-bottom: 0.49cm; line-height: 100%;"><br></p>\r\n<p class="western" style="margin-top: 0.49cm; margin-bottom: 0.49cm; line-height: 100%;"><br></p>\r\n<p class="western" style="margin-top: 0.49cm; margin-bottom: 0.49cm; line-height: 100%;"><span style="font-size: 10pt;"><strong>Genomf&ouml;rande:</strong></span></p>\r\n<ul><li>\r\n<p class="western" style="margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><span style="font-family: Times, serif;"><span style="font-size: 10pt;">F&ouml;rklara syfte samt behandling f&ouml;r patienten</span></span></p>\r\n</li>\r\n<li>\r\n<p class="western" style="margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><span style="font-family: Times, serif;"><span style="font-size: 10pt;">Kontrollera BT, puls, andningsfrekvens samt lyssna p&aring; hj&auml;rta och lungor.</span></span></p>\r\n</li>\r\n<li>\r\n<p class="western" style="margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><span style="font-family: Times, serif;"><span style="font-size: 10pt;">Vid kliniska tecken till hypovolemi gl&ouml;m ej att ge v&auml;tska iv (Ringer-Acetat/NaCl)</span></span></p>\r\n</li>\r\n<li>\r\n<p class="western" style="margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><span style="font-family: Times, serif;"><span style="font-size: 10pt;">V&auml;lj hel mask (n&auml;sa och mun) el ansiktsmask (hela ansiktet).</span></span></p>\r\n</li>\r\n<li>\r\n<p class="western" style="margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><span style="font-family: Times, serif;"><span style="font-size: 10pt;">V&auml;lj r&auml;tt mode f&ouml;r avsedd mask s&aring; att l&auml;ckage ber&auml;kningar blir korrekta.</span></span></p>\r\n</li>\r\n<li>\r\n<p class="western" style="margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><span style="font-family: Times, serif;"><span style="font-size: 10pt;">V&auml;lj S/T mode (Spontant/Tidsbest&auml;mt)</span></span></p>\r\n</li>\r\n<li>\r\n<p class="western" style="margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><span style="font-family: Times, serif;"><span style="font-size: 10pt;">H&aring;ll masken manuellt de f&ouml;rsta minuterna f&ouml;r att avg&ouml;ra hur v&auml;l patienten tolererar masken och kan medverka (alt aktivering av RAMPtid (vid ventilationssvikt) med tidsintervallet 10-15 min)</span></span></p>\r\n</li>\r\n</ul><p class="western" style="margin-left: 0.63cm; margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><br></p>\r\n<ul><li>\r\n<p class="western" style="margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 150%;"><span style="font-family: Times, serif;"><span style="font-size: 10pt;">Vid hypoxi utan CO2-retention ( tex lung&ouml;dem)</span></span></p>\r\n</li>\r\n<li>\r\n<p class="western" style="margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><span style="font-family: Times, serif;"><span style="font-size: 10pt;">efterstr&auml;va ett l&aring;gt tryckunderst&ouml;d (=IPAP-EPAP)</span></span></p>\r\n</li>\r\n<li>\r\n<p class="western" style="margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><span style="font-family: Times, serif;"><span style="font-size: 10pt;">b&ouml;rja med IPAP 9-11cm H2O samt EPAP 6-8 cm H2O </span></span></p>\r\n</li>\r\n<li>\r\n<p class="western" style="margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><span style="font-family: Times, serif;"><span style="font-size: 10pt;">administrera syrgas inom intervallet 40-60%</span></span></p>\r\n</li>\r\n<li>\r\n<p class="western" style="margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><span style="font-family: Times, serif;"><span style="font-size: 10pt;">efterstr&auml;va tillfredst&auml;llande tidalvolymer (normalv&auml;rde 6-8ml/kg kroppsvikt)</span></span></p>\r\n</li>\r\n<li>\r\n<p class="western" style="margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><span style="font-family: Times, serif;"><span style="font-size: 10pt;">v&auml;lj stigtid 2-3. </span></span></p>\r\n</li>\r\n<li>\r\n<p class="western" style="margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><span style="font-family: Times, serif;"><span style="font-size: 10pt;">om pO2 &auml;r fortsatt l&aring;gt (blodgas) &ouml;ka EPAP 0,5-1 cm H2O samt syrgastillf&ouml;rseln</span></span></p>\r\n</li>\r\n</ul><p class="western" style="margin-left: 1.91cm; margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><span style="font-family: Times, serif;"><span style="font-size: 10pt;">(dock fortsatt inom intervallet 40-60%)</span></span></p>\r\n<ul><li>\r\n<p class="western" style="margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><span style="font-family: Times, serif;"><span style="font-size: 10pt;">intermittent behandling &auml;r oftast tillr&auml;ckligt f&ouml;r att uppn&aring; ett tillfredst&auml;llande resultat</span></span></p>\r\n</li>\r\n<li>\r\n<p class="western" style="margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><span style="font-family: Times, serif;"><span style="font-size: 10pt;">CPAP kan vara ett alternativ (b&ouml;rja med 5-6 cmH2O)</span></span></p>\r\n</li>\r\n</ul><p class="western" style="margin-left: 2.54cm; margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><br></p>\r\n<p class="western" style="margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 150%;"><span style="font-family: Times, serif;"><span style="font-size: 10pt;">- Vid hypoxi och CO2-retention (tex obstruktivitet/KOL) </span></span></p>\r\n<ul><li>\r\n<p class="western" style="margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><span style="font-family: Times, serif;"><span style="font-size: 10pt;">efterstr&auml;va ett h&ouml;gt tryckunderst&ouml;d (=IPAP-EPAP)</span></span></p>\r\n</li>\r\n</ul><p class="western" style="margin-left: 1.9cm; margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><span style="font-family: Times, serif;"><span style="font-size: 10pt;">- b&ouml;rja med IPAP 15-20 cm H2O samt EPAP 4-5 cm H2O</span></span></p>\r\n<p class="western" style="margin-left: 1.9cm; margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><span style="font-family: Times, serif;"><span style="font-size: 10pt;">- syrgastillf&ouml;rsel inom intervallet 30-35% </span></span></p>\r\n<p class="western" style="margin-left: 1.9cm; margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><span style="font-family: Times, serif;"><span style="font-size: 10pt;">- efterstr&auml;va tillfredst&auml;llande tidalvolymer (normalv&auml;rde 6-8ml/kg kroppsvikt)</span></span></p>\r\n<p class="western" style="margin-left: 1.9cm; margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><span style="font-family: Times, serif;"><span style="font-size: 10pt;">- v&auml;lj stigtid 1-2 </span></span></p>\r\n<p class="western" style="margin-left: 1.9cm; margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><span style="font-family: Times, serif;"><span style="font-size: 10pt;">- om fortsatt f&ouml;rh&ouml;jt pCO2 &ouml;ka IPAP 2 cmH2O stegvis till max 20 cm H2O men </span></span></p>\r\n<p class="western" style="margin-left: 1.9cm; margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><span style="font-family: Times, serif;"><span style="font-size: 10pt;">var uppm&auml;rksam p&aring; tecken till uppbl&aring;sning av mags&auml;cken (aerofagi)</span></span></p>\r\n<p class="western" style="margin-left: 1.9cm; margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><span style="font-family: Times, serif;"><span style="font-size: 10pt;">- intermittent behandling &auml;r ett alternativ men efterstr&auml;van av s&aring; l&aring;nga </span></span></p>\r\n<p class="western" style="margin-left: 1.9cm; margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><span style="font-family: Times, serif;"><span style="font-size: 10pt;">behandlingsperioder som m&ouml;jligt, framf&ouml;r allt f&ouml;rsta dygnet &auml;r av vikt</span></span></p>\r\n<p class="western" style="margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><br></p>\r\n<p class="western" style="margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><strong>&Ouml;verv&auml;g invasiv ventilationsbehandling (respirator) om:</strong></p>\r\n<ul><li>\r\n<p style="margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><span style="font-size: 12pt;"><span style="font-size: 10pt;">pH &lt;7,20</span></span></p>\r\n</li>\r\n<li>\r\n<p style="margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><span style="font-size: 10pt;">GCS &lt;8</span></p>\r\n</li>\r\n<li>\r\n<p style="margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><span style="font-size: 12pt;"><span style="font-size: 10pt;">pO2 &lt;6 kPa trots max tolererad extra syrgas</span></span></p>\r\n</li>\r\n<li>\r\n<p class="western" style="margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><span style="font-size: 10pt;">Andnings och hj&auml;rtstillest&aring;nd</span></p>\r\n</li>\r\n</ul><p class="western" style="margin-top: 0.21cm; margin-bottom: 0.21cm; line-height: 100%;"><span style="font-size: 14pt;"><strong>Vid utebliven klinisk f&ouml;rb&auml;ttring samt station&auml;ra blodgasv&auml;rden &ouml;verv&auml;g kontakt med hj&auml;rtbakjour och/eller narkosjour (s&ouml;k 617).</strong></span></p>\r\n<p class="western" style="margin-top: 0.42cm; margin-bottom: 0.42cm; line-height: 100%;"><span style="font-size: 20pt;"><strong>Patientdataf&ouml;nster V60 (</strong></span><span style="font-size: 20pt;">fr&aring;n v&auml;nster till h&ouml;ger)</span><span style="font-size: 20pt;"><strong>:</strong></span></p>\r\n<p class="western" style="margin-top: 0.42cm; margin-bottom: 0.42cm; line-height: 100%;"><br></p>\r\n<p class="western" style="margin-top: 0.42cm; margin-bottom: 0.42cm; line-height: 100%;"><span style="font-size: 10pt;"><strong>Mode: </strong></span><span style="font-size: 10pt;">S/T (spontant/tidsbest&auml;mt) eller CPAP</span></p>\r\n<p class="western" style="margin-top: 0.42cm; margin-bottom: 0.42cm; line-height: 115%;"><span style="font-family: Times, serif;"><span style="font-size: 10pt;"><strong>Andningsfas/triggningsindikator</strong></span></span><span style="font-family: Times, serif;"><span style="font-size: 10pt;"> (&ouml;vre v&auml;nstra h&ouml;rnet) : </span></span></p>\r\n<ul><li>\r\n<p class="western" style="margin-top: 0.42cm; margin-bottom: 0.42cm; line-height: 115%;"><span style="font-family: Times, serif;"><span style="font-size: 10pt;"><strong>Spont</strong></span></span><span style="font-family: Times, serif;"><span style="font-size: 10pt;"> (patient triggat andetag, inspiratorisk fas, turkos f&auml;rg)</span></span></p>\r\n</li>\r\n<li>\r\n<p class="western" style="margin-top: 0.42cm; margin-bottom: 0.42cm; line-height: 115%;"><span style="font-family: Times, serif;"><span style="font-size: 10pt;"><strong>Tidsb</strong></span></span><span style="font-family: Times, serif;"><span style="font-size: 10pt;"> (ventilator triggat andetag, inspiratorisk fas, orange f&auml;rg)</span></span></p>\r\n</li>\r\n<li>\r\n<p class="western" style="margin-top: 0.42cm; margin-bottom: 0.42cm; line-height: 115%;"><span style="font-family: Times, serif;"><span style="font-size: 10pt;"><strong>Utandn </strong></span></span><span style="font-family: Times, serif;"><span style="font-size: 10pt;">(expiratorisk fas, bl&aring; f&auml;rg)</span></span></p>\r\n</li>\r\n</ul><p class="western" style="margin-top: 0.42cm; margin-bottom: 0.42cm; line-height: 115%;"><span style="font-family: Times, serif;"><span style="font-size: 10pt;"><strong>Frekvens: </strong></span></span><span style="font-family: Times, serif;"><span style="font-size: 10pt;">Respiratorisk frekvens/total andningsfrekvens (genomsnitt av 6 andetag el 15 s)</span></span></p>\r\n<p class="western" style="margin-top: 0.42cm; margin-bottom: 0.42cm; line-height: 115%;" align="justify"><span style="font-family: Times, serif;"><span style="font-size: 10pt;"><strong>Vt: </strong></span></span><span style="font-family: Times, serif;"><span style="font-size: 10pt;">Ber&auml;knad utandad tidalvolym (avser de senaste 6 andetagen)</span></span></p>\r\n<p class="western" style="margin-top: 0.42cm; margin-bottom: 0.42cm; line-height: 115%;" align="justify"><span style="font-family: Times, serif;"><span style="font-size: 10pt;"><strong>Ve: </strong></span></span><span style="font-family: Times, serif;"><span style="font-size: 10pt;">Ber&auml;knad minutventilation dvs produkten av tidalvolym samt andningsfrekvens (&ouml;kad total minutventilation betyder som regel l&auml;gre PaCO2)</span></span></p>\r\n<p class="western" style="margin-top: 0.42cm; margin-bottom: 0.42cm; line-height: 115%;" align="justify"><span style="font-family: Times, serif;"><span style="font-size: 10pt;"><strong>PIP: </strong></span></span><span style="font-family: Times, serif;"><span style="font-size: 10pt;">Inspiratoriskt topptryck dvs det h&ouml;gsta patienttrycket under f&ouml;reg&aring;ende andningscykel (f&ouml;r h&ouml;ga topptryck inneb&auml;r risk f&ouml;r lungskada inklusive pneumothorax)</span></span></p>\r\n<p class="western" style="margin-top: 0.42cm; margin-bottom: 0.42cm; line-height: 115%;" align="justify"><span style="font-family: Times, serif;"><span style="font-size: 10pt;"><strong>Tot.l&auml;ck: </strong></span></span><span style="font-family: Times, serif;"><span style="font-size: 10pt;">Uppskattat totalt l&auml;ckage som ett genomsnitt under f&ouml;reg&aring;ende andningscykel, OBS! l&auml;ckage skall finnas f&ouml;r en bekv&auml;m behandling.</span></span></p>\r\n<p class="western" style="margin-top: 0.42cm; margin-bottom: 0.42cm; line-height: 115%;"><span style="font-family: Times, serif;"><span style="font-size: 10pt;"><strong>Pat trig: </strong></span></span><span style="font-family: Times, serif;"><span style="font-size: 10pt;">Patient triggade andetag i procent av totalt antal andetag senaste 15 min</span></span></p>\r\n<p class="western" style="margin-top: 0.42cm; margin-bottom: 0.42cm; line-height: 115%;"><span style="font-family: Times, serif;"><span style="font-size: 10pt;"><strong>Ti/Ttot: </strong></span></span><span style="font-family: Times, serif;"><span style="font-size: 10pt;">Inspirationstid dividerad med den totala andningscykeltiden </span></span></p>\r\n<p class="western" style="margin-top: 0.42cm; margin-bottom: 0.42cm; line-height: 115%;"><span style="font-family: Times, serif;"><span style="font-size: 10pt;"><strong>T (cmH2O): </strong></span></span><span style="font-family: Times, serif;"><span style="font-size: 10pt;">Luftv&auml;gstryck kurva (EPAP+IPAP)</span></span></p>\r\n<p class="western" style="margin-top: 0.42cm; margin-bottom: 0.42cm; line-height: 115%;"><span style="font-family: Times, serif;"><span style="font-size: 10pt;"><strong>V (l/min): </strong></span></span><span style="font-family: Times, serif;"><span style="font-size: 10pt;">Uppskattat patientfl&ouml;de dvs det totala tillf&ouml;rda fl&ouml;det minus l&auml;ckagefl&ouml;det.</span></span></p>\r\n<p class="western" style="margin-top: 0.42cm; margin-bottom: 0.42cm; line-height: 115%;"><span style="font-family: Times, serif;"><span style="font-size: 10pt;"><strong>V (ml): </strong></span></span><span style="font-family: Times, serif;"><span style="font-size: 10pt;">Uppskattad patientvolym </span></span></p>\r\n<p class="western" style="margin-top: 0.42cm; margin-bottom: 0.42cm; line-height: 115%;"><span style="font-family: Times, serif;"><span style="font-size: 10pt;"><strong>IPAP: </strong></span></span><span style="font-family: Times, serif;"><span style="font-size: 10pt;">Inspiratoriskt positivt luftv&auml;gstryck </span></span></p>\r\n<p class="western" style="margin-top: 0.42cm; margin-bottom: 0.42cm; line-height: 115%;"><span style="font-family: Times, serif;"><span style="font-size: 10pt;"><strong>Frekvens (BPM, nedre v&auml;nstra h&ouml;rnet): </strong></span></span><span style="font-family: Times, serif;"><span style="font-size: 10pt;">Respiratorisk frekvens el andetag/minut</span></span></p>\r\n<p class="western" style="margin-top: 0.42cm; margin-bottom: 0.42cm; line-height: 115%;"><span style="font-family: Times, serif;"><span style="font-size: 10pt;"><strong>I-tid (sek): </strong></span></span><span style="font-family: Times, serif;"><span style="font-size: 10pt;">Inspirationstid dvs den del av andningscykeln som motsvarar inspirationen</span></span></p>\r\n<p class="western" style="margin-top: 0.42cm; margin-bottom: 0.42cm; line-height: 115%;"><span style="font-family: Times, serif;"><span style="font-size: 10pt;"><strong>Stign (stigtid): </strong></span></span><span style="font-family: Times, serif;"><span style="font-size: 10pt;">Dvs den frekvens med vilken det inspiratoriska trycket stiger till inst&auml;llt (m&aring;l)tryck. F&ouml;r l&aring;ng stigtid/lutning kan medf&ouml;ra att pat inte &rdquo;f&aring;r luft&rdquo;s&aring; snabbt som &ouml;nskas vilket kan &ouml;ka andningsarbetet. Pat med uttalad dyspne trivs oftast b&auml;ttre med en kortare stigtid (dvs 1-2)</span></span></p>\r\n<p class="western" style="margin-top: 0.42cm; margin-bottom: 0.42cm; line-height: 115%;"><span style="font-family: Times, serif;"><span style="font-size: 10pt;"><strong>AV/RAMP(5-45 min): </strong></span></span><span style="font-family: Times, serif;"><span style="font-size: 10pt;">Dvs ett intervall under vilket ventilatorn &ouml;kar trycket linj&auml;rt vilket bidrar till att minska patientens anstr&auml;ngning och obehag</span></span></p>\r\n<p class="western" style="margin-top: 0.42cm; margin-bottom: 0.42cm; line-height: 115%;"><span style="font-family: Times, serif;"><span style="font-size: 10pt;"><strong>EPAP: </strong></span></span><span style="font-family: Times, serif;"><span style="font-size: 10pt;">Expiratoriskt positivt luftv&auml;gstryck</span></span></p>\r\n<p>&nbsp;</p>\r\n<p class="western" style="margin-top: 0.42cm; margin-bottom: 0.42cm; line-height: 115%;"><span style="font-size: 10pt;"><strong>02: </strong></span><span style="font-size: 10pt;">Syrgaskoncentration som skall tillf&ouml;ras</span></p></body></html>\n', 'non-invasiv-ventilation', 0, 0, '1y', NULL, 1, NULL, NULL, '0000-00-00', '2015-04-14 19:30:00', '2015-04-14 19:46:22', NULL),
(47, '89478', 'assigned', NULL, 'Test', '', NULL, 'test', 0, 0, '1y', NULL, 25, NULL, NULL, '0000-00-00', '2015-04-19 07:44:17', '2015-04-19 07:44:17', NULL),
(48, '89478', 'assigned', NULL, 'Test', '', NULL, 'test-7', 0, 0, '1y', NULL, 25, NULL, NULL, '0000-00-00', '2015-04-19 07:44:18', '2015-04-19 07:44:18', NULL),
(49, '89478', 'assigned', NULL, 'Test', '', NULL, 'test-9', 0, 0, '1y', NULL, 25, NULL, NULL, '0000-00-00', '2015-04-19 07:45:09', '2015-04-19 07:45:09', NULL);

-- --------------------------------------------------------

--
-- Tabellstruktur `pm_categories`
--

CREATE TABLE IF NOT EXISTS `pm_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pm` int(10) unsigned NOT NULL,
  `category` int(10) unsigned NOT NULL,
  `added_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pm_categories_pm_foreign` (`pm`),
  KEY `pm_categories_category_foreign` (`category`),
  KEY `pm_categories_added_by_foreign` (`added_by`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Dumpning av Data i tabell `pm_categories`
--

INSERT INTO `pm_categories` (`id`, `pm`, `category`, `added_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 1, 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(3, 2, 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(5, 3, 4, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(6, 4, 8, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(8, 6, 12, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(10, 7, 3, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(11, 8, 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(12, 9, 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(14, 10, 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(15, 11, 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(16, 5, 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(17, 12, 8, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(18, 13, 8, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Tabellstruktur `pm_roles`
--

CREATE TABLE IF NOT EXISTS `pm_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pm` int(10) unsigned NOT NULL,
  `role` int(10) unsigned NOT NULL,
  `added_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pm_roles_pm_foreign` (`pm`),
  KEY `pm_roles_role_foreign` (`role`),
  KEY `pm_roles_added_by_foreign` (`added_by`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=44 ;

--
-- Dumpning av Data i tabell `pm_roles`
--

INSERT INTO `pm_roles` (`id`, `pm`, `role`, `added_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(4, 2, 12, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(5, 2, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(9, 3, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(10, 3, 8, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(11, 3, 17, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(12, 4, 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(16, 6, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(17, 6, 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(18, 6, 18, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(22, 7, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(23, 8, 12, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(24, 9, 8, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(25, 9, 11, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(26, 9, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(31, 10, 8, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(32, 10, 17, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(33, 10, 12, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(34, 10, 11, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(35, 10, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(36, 11, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(37, 11, 12, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(38, 11, 8, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(39, 11, 10, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(40, 5, 4, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(41, 5, 15, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(42, 5, 16, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(43, 12, 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Tabellstruktur `pm_tags`
--

CREATE TABLE IF NOT EXISTS `pm_tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pm` int(10) unsigned NOT NULL,
  `tag` int(10) unsigned NOT NULL,
  `added_by` int(10) unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `not_published` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `pm_tags_pm_foreign` (`pm`),
  KEY `pm_tags_tag_foreign` (`tag`),
  KEY `pm_tags_added_by_foreign` (`added_by`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=46 ;

--
-- Dumpning av Data i tabell `pm_tags`
--

INSERT INTO `pm_tags` (`id`, `pm`, `tag`, `added_by`, `deleted_at`, `created_at`, `updated_at`, `not_published`) VALUES
(45, 1, 1, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(44, 1, 2, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(9, 2, 2, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(10, 2, 1, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(11, 2, 3, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(12, 2, 4, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(13, 3, 7, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(14, 4, 5, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(15, 4, 6, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(16, 4, 7, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(20, 6, 7, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(21, 6, 8, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(25, 7, 9, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(26, 8, 10, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(27, 9, 2, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(29, 10, 11, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(30, 11, 16, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(31, 11, 13, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(32, 11, 14, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(33, 11, 12, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(34, 5, 1, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(35, 5, 2, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(36, 5, 8, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(37, 5, 12, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(38, 5, 14, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(39, 12, 17, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(40, 12, 18, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(41, 13, 8, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Tabellstruktur `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `role_type` enum('department','profession','clinic','hospital') COLLATE utf8_unicode_ci NOT NULL,
  `department_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `department_parent` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `added_by` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=24 ;

--
-- Dumpning av Data i tabell `roles`
--

INSERT INTO `roles` (`id`, `name`, `role_type`, `department_code`, `department_parent`, `created_at`, `updated_at`, `deleted_at`, `added_by`) VALUES
(1, 'Akutmottagningen', 'department', NULL, NULL, '2015-04-14 16:07:16', '2015-04-14 16:07:16', NULL, 0),
(2, 'Hjärtkliniken', 'department', NULL, NULL, '2015-04-14 16:07:32', '2015-04-14 16:07:32', NULL, 0),
(3, 'Infektionskliniken', 'department', NULL, NULL, '2015-04-14 16:07:53', '2015-04-14 16:07:53', NULL, 0),
(4, 'Talkliniken', 'department', NULL, NULL, '2015-04-14 16:08:36', '2015-04-14 16:08:36', NULL, 0),
(5, 'Kirurgkliniken', 'department', NULL, NULL, '2015-04-14 16:08:46', '2015-04-14 16:08:54', NULL, 0),
(6, 'Ortopeden', 'department', NULL, NULL, '2015-04-14 16:09:04', '2015-04-14 16:09:04', NULL, 0),
(7, 'Thorax', 'department', NULL, NULL, '2015-04-14 16:09:07', '2015-04-14 16:09:07', NULL, 0),
(8, 'sköterska', 'department', NULL, NULL, '2015-04-14 16:09:16', '2015-04-14 16:09:16', NULL, 0),
(9, 'kirurg', 'department', NULL, NULL, '2015-04-14 16:09:21', '2015-04-14 16:09:21', NULL, 0),
(10, 'läkare', 'department', NULL, NULL, '2015-04-14 16:09:51', '2015-04-14 16:09:51', NULL, 0),
(11, 'administration', 'department', NULL, NULL, '2015-04-14 16:09:57', '2015-04-14 16:09:57', NULL, 0),
(12, 'receptionist', 'department', NULL, NULL, '2015-04-14 16:10:01', '2015-04-14 16:10:01', NULL, 0),
(13, 'parkeringsvakt', 'department', NULL, NULL, '2015-04-14 16:10:10', '2015-04-14 16:10:10', NULL, 0),
(14, 'lokalvårdare', 'department', NULL, NULL, '2015-04-14 16:10:58', '2015-04-14 16:10:58', NULL, 0),
(15, 'inköpsansvarig', 'department', NULL, NULL, '2015-04-14 16:11:07', '2015-04-14 16:11:07', NULL, 0),
(16, 'kaffeansvarig', 'department', NULL, NULL, '2015-04-14 16:11:19', '2015-04-14 16:11:19', NULL, 0),
(17, 'undersköterska', 'department', NULL, NULL, '2015-04-14 16:12:07', '2015-04-14 16:12:07', NULL, 0),
(18, 'akutläkare', 'department', NULL, NULL, '2015-04-14 16:12:30', '2015-04-14 16:12:30', NULL, 0),
(19, 'dietist', 'department', NULL, NULL, '2015-04-14 16:12:47', '2015-04-14 16:12:47', NULL, 0),
(20, 'vårdbiträde', 'department', NULL, NULL, '2015-04-14 16:12:58', '2015-04-14 16:12:58', NULL, 0),
(21, 'optiker', 'department', NULL, NULL, '2015-04-14 16:13:35', '2015-04-14 16:13:35', NULL, 0),
(22, 'Intensivvårdsavdelningen', 'department', NULL, NULL, '2015-04-14 16:14:06', '2015-04-14 16:14:06', NULL, 0),
(23, 'Röntgen', 'department', NULL, NULL, '2015-04-14 16:14:23', '2015-04-14 16:14:23', NULL, 0);

-- --------------------------------------------------------

--
-- Tabellstruktur `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `added_by` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Dumpning av Data i tabell `tags`
--

INSERT INTO `tags` (`id`, `name`, `token`, `created_at`, `updated_at`, `deleted_at`, `added_by`) VALUES
(1, 'ansvarsarbete', 'ansvarsarbete', '2015-04-14 16:34:19', '2015-04-14 16:34:19', NULL, 0),
(2, 'ansvar', 'ansvar', '2015-04-14 16:34:23', '2015-04-14 16:34:23', NULL, 0),
(3, 'kassa', 'kassa', '2015-04-14 16:51:37', '2015-04-14 16:51:37', NULL, 0),
(4, 'reception', 'reception', '2015-04-14 16:51:48', '2015-04-14 16:51:48', NULL, 0),
(5, 'dagbakjour', 'dagbakjour', '2015-04-14 17:06:45', '2015-04-14 17:06:45', NULL, 0),
(6, 'jour', 'jour', '2015-04-14 17:06:48', '2015-04-14 17:06:48', NULL, 0),
(7, 'arbetsbeskrivning', 'arbetsbeskrivning', '2015-04-14 17:06:56', '2015-04-14 17:08:17', NULL, 0),
(8, 'exempel', 'exempel', '2015-04-14 17:46:54', '2015-04-14 17:46:54', NULL, 0),
(9, 'skyddad identitet', 'skyddad-identitet', '2015-04-14 17:54:40', '2015-04-14 17:54:40', NULL, 0),
(10, 'reservnummer', 'reservnummer', '2015-04-14 17:55:44', '2015-04-14 17:55:44', NULL, 0),
(11, 'sjukresor', 'sjukresor', '2015-04-14 17:56:45', '2015-04-14 17:56:45', NULL, 0),
(12, 'massmedia', 'massmedia', '2015-04-14 18:16:11', '2015-04-14 18:16:11', NULL, 0),
(13, 'press', 'press', '2015-04-14 18:16:14', '2015-04-14 18:16:14', NULL, 0),
(14, 'presskontakter', 'presskontakter', '2015-04-14 18:16:19', '2015-04-14 18:16:19', NULL, 0),
(15, 'olycka', 'olycka', '2015-04-14 18:16:23', '2015-04-14 18:16:23', NULL, 0),
(16, 'kris', 'kris', '2015-04-14 18:16:26', '2015-04-14 18:16:26', NULL, 0),
(17, 'strålskydd', 'stralskydd', '2015-04-14 18:26:29', '2015-04-14 18:26:29', NULL, 0),
(18, 'rutiner', 'rutiner', '2015-04-14 18:26:33', '2015-04-14 18:26:33', NULL, 0);

-- --------------------------------------------------------

--
-- Tabellstruktur `templates`
--

CREATE TABLE IF NOT EXISTS `templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `privileges` set('unverified','verified','pm-admin','admin') COLLATE utf8_unicode_ci DEFAULT NULL,
  `tooltips_on` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=27 ;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `privileges`, `tooltips_on`, `created_at`, `updated_at`, `deleted_at`, `remember_token`) VALUES
(1, 'admin@codelane.se', '$2y$10$P50MXsShlvmD9D3/d/Uyh.GDEFVbqR/RNHztupYIj9F/Hr/N4ai3.', 'Magnus Persson', 'admin', 0, '0000-00-00 00:00:00', '2015-04-19 09:09:49', NULL, 'QnEt2ElZtwBUGi0rA9J5h7KlWXJeD8r4BryXIGvLeaoo3CklJh0Ru52grlwF'),
(2, 'asa@codelane.se', 'NULL', 'Åsa Svensson', 'pm-admin', 0, '2015-04-14 15:43:52', '2015-04-14 15:43:52', NULL, NULL),
(3, 'lena@codelane.se', 'NULL', 'Lena Andersson', 'verified', 0, '2015-04-14 15:44:11', '2015-04-14 15:44:11', NULL, NULL),
(4, 'malte@codelane.se', 'NULL', 'Malte Vesterholm', 'admin', 0, '2015-04-14 15:44:29', '2015-04-14 15:44:29', NULL, NULL),
(5, 'jens@codelane.se', 'NULL', 'Jens Sandström', 'unverified', 0, '2015-04-14 15:45:18', '2015-04-14 15:45:18', NULL, NULL),
(6, 'irene@codelane.se', 'NULL', 'Irene Pettersson', 'pm-admin', 0, '2015-04-14 15:47:24', '2015-04-14 15:47:30', NULL, NULL),
(7, 'ahmed@codelane.se', 'NULL', 'Amir Al-hakim', 'unverified', 0, '2015-04-14 15:48:24', '2015-04-14 15:48:24', NULL, NULL),
(8, 'lennart@codelane.se', 'NULL', 'Lennart Söderström', 'verified', 0, '2015-04-14 15:49:01', '2015-04-14 15:49:01', NULL, NULL),
(9, 'per@codelane.se', 'NULL', 'Per Sandberg', 'verified', 0, '2015-04-14 15:49:21', '2015-04-14 15:49:21', NULL, NULL),
(10, 'per2@codelane.se', 'NULL', 'Per Sundström', 'unverified', 0, '2015-04-14 15:49:56', '2015-04-14 15:49:56', NULL, NULL),
(11, 'margareta@codelane.se', 'NULL', 'Margareta Hasselrot', 'pm-admin', 0, '2015-04-14 15:50:17', '2015-04-14 15:50:17', NULL, NULL),
(12, 'anna@codelane.se', 'NULL', 'Anna Hasselrot', 'verified', 0, '2015-04-14 15:50:28', '2015-04-14 19:24:27', NULL, NULL),
(13, 'kent@codelane.se', 'NULL', 'Kent Strand', 'verified', 0, '2015-04-14 15:51:02', '2015-04-14 15:51:02', NULL, NULL),
(14, 'birk@codelane.se', 'NULL', 'Birk Bengtsson', 'unverified', 0, '2015-04-14 15:52:42', '2015-04-14 15:52:42', NULL, NULL),
(15, 'linnea@codelane.se', 'NULL', 'Linnéa Jonsson', 'verified', 0, '2015-04-14 15:53:23', '2015-04-14 15:53:23', NULL, NULL),
(16, 'ahmedi@codelane.se', 'NULL', 'Ahmed Ibrahim', 'verified', 0, '2015-04-14 15:54:53', '2015-04-14 15:54:53', NULL, NULL),
(17, 'daniel@codelane.se', 'NULL', 'Daniel Olsson', 'verified', 0, '2015-04-14 15:55:34', '2015-04-14 15:55:34', NULL, NULL),
(18, 'danne@codelane.se', 'NULL', 'Daniel Strömbergsson', 'unverified', 0, '2015-04-14 15:55:46', '2015-04-14 15:55:46', NULL, NULL),
(19, 'kjettil@codelane.se', 'NULL', 'Kjettil Björgen', 'verified', 0, '2015-04-14 15:56:15', '2015-04-14 15:56:15', NULL, NULL),
(20, 'nikki@codelane.se', 'NULL', 'Nikki Löw', 'unverified', 0, '2015-04-14 15:57:27', '2015-04-14 15:57:27', NULL, NULL),
(21, 'andy@codelane.se', 'NULL', 'Andy Yousef', 'verified', 0, '2015-04-14 15:57:48', '2015-04-14 15:57:48', NULL, NULL),
(22, 'patric@codelane.se', 'NULL', 'Patric Lantz', 'pm-admin', 0, '2015-04-14 15:58:01', '2015-04-14 15:58:01', NULL, NULL),
(23, 'eric@codelane.se', 'NULL', 'Eric Norgren', 'pm-admin', 0, '2015-04-14 15:58:51', '2015-04-14 15:58:51', NULL, NULL),
(24, 'jonadahl@kth.se', 'NULL', 'Jonas Dahl', 'admin', 0, '2015-04-14 15:59:03', '2015-04-14 15:59:03', NULL, NULL),
(25, 'liam@codelane.se', '$2y$10$ZREowMqnEzzTiOVhJEIuOucXuD99ZW8qwZJ70fT6feoCklz8xOIDe', 'Liam Strömberg', 'admin', 0, '2015-04-14 18:50:24', '2015-04-19 08:08:20', NULL, 'LZa6Fw2NjpXOJifu1s2PAN4v5HU2y5qsM8A4SXJ8c3drPBcyVrGOvtufUgIp'),
(26, 'mia.svensson@ds.se', 'NULL', 'Mia Svensson', 'unverified', 0, '2015-04-14 19:19:18', '2015-04-14 19:19:18', NULL, NULL);

-- --------------------------------------------------------

--
-- Tabellstruktur `user_roles`
--

CREATE TABLE IF NOT EXISTS `user_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user` int(10) unsigned NOT NULL,
  `role` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `user_roles_user_foreign` (`user`),
  KEY `user_roles_role_foreign` (`role`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumpning av Data i tabell `user_roles`
--

INSERT INTO `user_roles` (`id`, `user`, `role`, `created_at`, `updated_at`) VALUES
(1, 25, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 25, 8, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
