-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Värd: 10.209.1.136
-- Skapad: 14 apr 2015 kl 23:26
-- Serverversion: 5.5.32
-- PHP-version: 5.3.10-1ubuntu3.11

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databas: `184115-test`
--

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
(1, 'admin@codelane.se', '$2y$10$P50MXsShlvmD9D3/d/Uyh.GDEFVbqR/RNHztupYIj9F/Hr/N4ai3.', 'Magnus Persson', 'admin', 0, '0000-00-00 00:00:00', '2015-04-14 19:16:30', NULL, 'Qbr8tWGXvcqUTn29NBdDFxpl4TlNiPU4lfa2A48LhI95yVquA2HAm6u17Z0M'),
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
(25, 'liam@codelane.se', '$2y$10$ZREowMqnEzzTiOVhJEIuOucXuD99ZW8qwZJ70fT6feoCklz8xOIDe', 'Liam Strömberg', 'admin', 0, '2015-04-14 18:50:24', '2015-04-14 19:23:19', NULL, 'r2K1vEkivloSlSpsZsepoZ5C09nXkDYk1GTy2u9sEHBtPTRGmAjAnw1n1PHj'),
(26, 'mia.svensson@ds.se', 'NULL', 'Mia Svensson', 'unverified', 0, '2015-04-14 19:19:18', '2015-04-14 19:19:18', NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
