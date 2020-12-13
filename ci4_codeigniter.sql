-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 13, 2020 at 06:29 AM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci4_codeigniter`
--

-- --------------------------------------------------------

--
-- Table structure for table `gallary`
--

DROP TABLE IF EXISTS `gallary`;
CREATE TABLE IF NOT EXISTS `gallary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallary`
--

INSERT INTO `gallary` (`id`, `user_id`, `image`) VALUES
(8, 21, '1597137565_a8a22b7ab0d83962fda1.png'),
(9, 21, '1597137596_dd49b46a74b3e9fa6327.png'),
(32, 21, '1602349280_0a6ce0a38b4bb51a542f.jpg'),
(11, 21, '1597138432_7fcda410593f0ed6640e.png'),
(12, 21, '1597138976_e90706c99ad280923865.png'),
(13, 21, '1597139008_f1fbd16bbbc1f01bc6ab.png'),
(15, 21, '1597139088_2f6b2563b6bc97bf14aa.png'),
(16, 21, '1597139149_543cc16a79556cfbe1e8.png'),
(18, 21, '1597139324_6cb35b565a66aef2bc8d.png'),
(19, 21, '1597139413_328a9cca0be63cfe560a.png'),
(20, 21, '1597139456_e87dc720d04ff8b61e36.png'),
(21, 21, '1597140245_b8638a9aeeae3e6b594b.png'),
(22, 21, '1597140297_d8d57bddeda78987feb9.png'),
(23, 21, '1597140385_270a824496670f258a15.png'),
(24, 21, '1597140927_9e3b42829e00c69d7571.png'),
(25, 21, '1597140997_b95c9849739be4930044.png'),
(26, 21, '1597141388_b57bf9a21b5e8072245b.png'),
(29, 21, '1598074861_a3f9dd931300a685ca39.png'),
(30, 21, '1600593445_68d9c8d912a76a282b20.png');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` text NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(4, '2020-07-27-104154', 'App\\Database\\Migrations\\CreateTableUsers', 'default', 'App', 1596023734, 1),
(5, '2020-08-05-070411', 'App\\Database\\Migrations\\CreateRolesTable', 'default', 'App', 1596611203, 2),
(6, '2020-08-05-091646', 'App\\Database\\Migrations\\CreateModulesTable', 'default', 'App', 1596619091, 3),
(7, '2020-08-06-134241', 'App\\Database\\Migrations\\CreateRolePermissionTable', 'default', 'App', 1596721527, 4);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

DROP TABLE IF EXISTS `modules`;
CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `module` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `module`, `created_at`, `updated_at`) VALUES
(1, 'Users', '2020-08-04 23:02:28', '2020-08-04 23:02:28'),
(2, 'roles', '2020-08-04 23:03:02', '2020-08-04 23:03:02'),
(3, 'modules', '2020-08-04 23:03:21', '2020-08-04 23:08:27');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2020-08-04 21:02:54', '2020-08-04 21:09:43'),
(2, 'user', '2020-08-04 21:10:00', '2020-08-04 22:04:47');

-- --------------------------------------------------------

--
-- Table structure for table `role_permission`
--

DROP TABLE IF EXISTS `role_permission`;
CREATE TABLE IF NOT EXISTS `role_permission` (
  `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `permission` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role_permission`
--

INSERT INTO `role_permission` (`id`, `user_id`, `permission`) VALUES
(1, 20, '[\"users_index\",\"users_create\",\"users_edit\",\"users_permission\",\"roles_index\",\"roles_create\",\"roles_edit\",\"roles_delete\",\"modules_index\"]'),
(4, 16, '[\"users_index\",\"roles_index\",\"modules_index\"]'),
(3, 21, '[\"users_index\",\"users_create\",\"users_edit\",\"users_delete\",\"users_permission\",\"roles_index\",\"roles_create\",\"roles_edit\",\"roles_delete\",\"modules_index\",\"modules_create\",\"modules_edit\",\"modules_delete\"]'),
(5, 15, '[\"users_index\"]');

-- --------------------------------------------------------

--
-- Table structure for table `role_permission1`
--

DROP TABLE IF EXISTS `role_permission1`;
CREATE TABLE IF NOT EXISTS `role_permission1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `permission` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role_permission1`
--

INSERT INTO `role_permission1` (`id`, `user_id`, `module_id`, `permission`) VALUES
(1, 20, 1, '[\"users_index\",\"users_create\",\"users_edit\",\"users_permission\",\"roles_index\",\"roles_edit\",\"roles_delete\",\"modules_index\"]'),
(4, 19, 1, '[\"users_index\",\"users_permission\",\"roles_index\"]'),
(2, 21, 1, '{\"users\\/index\":1,\"users\\/create\":0,\"users\\/edit\":1,\"users\\/delete\":1,\"roles\\/index\":0,\"roles\\/create\":1,\"roles\\/edit\":1,\"roles\\/delete\":0,\"modules\\/index\":1,\"modules\\/create\":0,\"modules\\/edit\":1,\"modules\\/delete\":0}');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` int(11) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `phone_no` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `profile` varchar(255) DEFAULT NULL,
  `email_verify` int(11) DEFAULT NULL,
  `verification_token` varchar(100) DEFAULT NULL,
  `resetpass_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `role`, `gender`, `phone_no`, `status`, `profile`, `email_verify`, `verification_token`, `resetpass_token`, `created_at`, `updated_at`) VALUES
(1, 'kmvpn', 'vpn', 'kmvpn@yopmail.com', '$2y$10$OFtM4fm9GWybuC56c6wosedJsMLT4GJOmru2QKy9G/ATAAOfYAOxC', 1, 'male', '1239631230', 1, NULL, 1, NULL, '', '2020-07-29 01:25:57', '2020-07-30 01:26:32'),
(2, 'Tarun', 'Patoliya', 'test@yopmail.com', '$2y$10$DZuuVCrbuIozXj0pu7FnYO0J1I2flzvBpFSHKD7rHFsdtwQadPJKa', 1, 'female', '1234567890', 1, NULL, 1, NULL, NULL, '2020-07-30 02:05:20', '2020-07-31 20:26:02'),
(10, 'test', 'test', 'test2@yopmail.com', '$2y$10$jx/.MsmElRx32cvAKMB6iuVYABG0.5cwO/VdT9gaL8hURccDqMkL.', 1, 'male', '1234567890', 1, NULL, NULL, NULL, NULL, '2020-08-03 23:06:27', '2020-08-03 23:06:27'),
(11, 'test', 'test', 'test3@yopmail.com', '$2y$10$/bqbQQ4pRlnfbYZsG0y1f.jLHZesRc0KbHfNEz1Vd5UW3nvzWh3rq', 1, 'male', '1234567890', 1, NULL, 1, NULL, NULL, '2020-08-03 23:20:03', '2020-08-03 23:20:03'),
(12, 'test4', 'test4', 'test4@yopmail.com', '$2y$10$E1k.eay2A6fXHVhw1nClHewdA6w6G897VBNU4LZEu.BHUwhXb4GZi', 1, 'male', '1234567890', 1, '1596534951_1ae79493663e4bfe0eb6.png', 1, NULL, NULL, '2020-08-03 23:25:51', '2020-08-03 23:25:51'),
(13, 'test', 'test', 'test5@yopmail.com', '$2y$10$q6AZW/M4b2li.ufZYMEub.Zo6OUxXa1jK16r3aGVTBLlgFeLf1rZq', 1, 'male', '1234567890', 1, '1596535302_c699acf0e69811e59ab7.png', 1, NULL, NULL, '2020-08-03 23:31:42', '2020-08-03 23:31:42'),
(14, 'test5', 'test5', 'test6@yopmail.com', '$2y$10$lvUGv4HVlMovqG/9lXMgL.O7LYqkhmoxW62FbeNx4bHvAS5ju9L5S', 1, 'male', '1234567890', 1, '1596535671_3eefa0e44991a998aaac.png', 1, NULL, NULL, '2020-08-03 23:37:51', '2020-08-03 23:37:51'),
(15, 'test7', 'test7', 'test7@yopmail.com', '$2y$10$qSNi5ZUgSj/zFbqlOMD/LeHckWjC/pkLy7lbxQ21.QkhCo3hTy852', 2, 'male', '1234567890', 1, '1596603655_8618748a966204cc78d1.png', 1, NULL, NULL, '2020-08-03 23:39:56', '2020-08-04 23:56:16'),
(16, 'test', 'test', 'test8@yopmail.com', '$2y$10$wl/S2poVbkyF/L3THEvFo.tgymECwDD5zaoS/luoicw1Pwx52DAU2', 2, 'male', '1324567890', 1, '1596546960_f8a5c8da6ba32555cf12.png', 1, NULL, NULL, '2020-08-03 23:42:34', '2020-08-04 23:56:07'),
(19, 'test2', 'test', 'test10@yopmail.com', '$2y$10$6fBNFFSeGzP6s.cmMTVMd.UcgqACIPwOrR1gjmvcQbe49mxL.cnxS', 2, 'male', '1234567890', 1, '1596537550_18a4538fba02b50a2fe7.png', 1, NULL, NULL, '2020-08-04 00:09:10', '2020-08-06 22:42:14'),
(20, 'test11', 'test11', 'test11@yopmail.com', '$2y$10$WL4y7E/IE/u0zCvHCxeqLeb7QEAEmWNkedHanXOCRxtCbYQfyu8mq', 2, 'male', '1234567890', 1, '1596604842_1d3117429ebb52f640a0.png', 1, '', NULL, '2020-08-04 18:50:42', '2020-12-12 18:03:35'),
(21, 'test12', 'test12', 'test12@yopmail.com', '$2y$10$bFJX9aWvuieNcJi6cc9uxeyudthakptDEi/HU7GBEouap7x2L0Eiu', 1, 'male', '1234567890', 1, '1596772814_8be3bd5a9d48d16a5491.png', 1, '', NULL, '2020-08-06 17:30:14', '2020-08-06 17:48:07');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
