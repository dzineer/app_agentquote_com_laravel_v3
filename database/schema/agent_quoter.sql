-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 16, 2019 at 05:15 AM
-- Server version: 10.1.26-MariaDB-0+deb9u1
-- PHP Version: 7.1.12-2+0~20171207160754.12+jessie~1.gbp5c91f3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aqdb1`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_quote`
--

CREATE TABLE `account_quote` (
  `id` int(11) UNSIGNED NOT NULL COMMENT 'primary key',
  `hostname` varchar(255) NOT NULL,
  `endpoint` varchar(255) NOT NULL,
  `client_id` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL,
  `site_num` varchar(16) NOT NULL,
  `grant_type` varchar(20) NOT NULL,
  `client_secret` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `account_quote`
--

INSERT INTO `account_quote` (`id`, `hostname`, `endpoint`, `client_id`, `password`, `site_num`, `grant_type`, `client_secret`) VALUES
(1, 'http://149.28.45.153', '/oauth2-server/token.php?', 'fdecker', 'fdecker', '3', 'client_credentials', 'fdecker');

-- --------------------------------------------------------

--
-- Table structure for table `affiliates`
--

CREATE TABLE `affiliates` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `affiliates`
--

INSERT INTO `affiliates` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'AQ Term', '2018-12-11 10:26:16', '2018-12-11 10:26:16'),
(2, 'Legacy', '2018-12-11 10:26:16', '2018-12-11 10:26:16'),
(3, 'TRKing', '2019-01-18 00:00:00', '2019-01-18 00:00:00'),
(4, 'Unique Writers Inc', '2019-03-15 00:00:00', '2019-03-15 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `affiliate_coupon`
--

CREATE TABLE `affiliate_coupon` (
  `id` int(11) NOT NULL,
  `affiliate_id` int(11) NOT NULL,
  `coupon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_coupon_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `affiliate_coupon`
--

INSERT INTO `affiliate_coupon` (`id`, `affiliate_id`, `coupon`, `billing_coupon_id`) VALUES
(1, 1, 'AGENTQUOTE', 1),
(2, 2, 'LQD', 1),
(3, 3, 'TRKing', 1),
(4, 4, 'UW030119', 1);

-- --------------------------------------------------------

--
-- Table structure for table `affiliate_types`
--

CREATE TABLE `affiliate_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `affiliate_types`
--

INSERT INTO `affiliate_types` (`id`, `name`) VALUES
(1, 'Administrator'),
(2, 'Manager'),
(3, 'Agent');

-- --------------------------------------------------------

--
-- Table structure for table `affiliate_type_users`
--

CREATE TABLE `affiliate_type_users` (
  `affiliate_id` int(11) NOT NULL,
  `affiliate_type_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `affiliate_type_users`
--

INSERT INTO `affiliate_type_users` (`affiliate_id`, `affiliate_type_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 3, '2018-12-11 17:00:00', '2018-12-11 17:00:00'),
(1, 2, 4, '2018-12-11 17:00:00', '2018-12-11 17:00:00'),
(1, 3, 5, '2018-12-11 17:00:00', '2018-12-11 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `affiliate_user`
--

CREATE TABLE `affiliate_user` (
  `affiliate_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `billing_coupons`
--

CREATE TABLE `billing_coupons` (
  `id` int(10) UNSIGNED NOT NULL,
  `coupon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `billing_coupons`
--

INSERT INTO `billing_coupons` (`id`, `coupon`, `created_at`, `updated_at`) VALUES
(1, 'MMLQ', '2018-12-11 17:00:00', '2018-12-11 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `card_subscriptions`
--

CREATE TABLE `card_subscriptions` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `expiry_month` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_gateway` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_four_digits` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expiry_year` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carriers`
--

CREATE TABLE `carriers` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'primary key',
  `company_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(256) NOT NULL,
  `link1` varchar(256) DEFAULT NULL,
  `link2` varchar(256) DEFAULT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carriers`
--

INSERT INTO `carriers` (`id`, `company_id`, `name`, `link1`, `link2`, `active`) VALUES
(82, 1, 'Banner Life Insurance Company', '#AgentGuide', '#eApp', 1),
(83, 4, 'American General Life Insurance Company', '#AgentGuide', '#eApp', 1),
(84, 5, 'Transamerica Life Insurance Company', '#AgentGuide', '#eApp', 1),
(85, 6, 'Protective Life Insurance Company', '#AgentGuide', '#eApp', 1),
(86, 8, 'PRUCO Life Insurance Company', '#AgentGuide', '#eApp', 1),
(87, 9, 'United of Omaha Life Insurance Company', '#AgentGuide', '#eApp', 1),
(88, 11, 'William Penn Life Insurance Company of NY', '#AgentGuide', '#eApp', 1),
(89, 13, 'United States Life Insurance Company in the City of New York', '#AgentGuide', '#eApp', 1),
(90, 14, 'PRUCO Life Insurance Company of NJ', '#AgentGuide', '#eApp', 1),
(91, 16, 'North American Company for Life and Health Insurance', '#AgentGuide', '#eApp', 1),
(92, 17, 'Brighthouse Financial', '#AgentGuide', '#eApp', 1),
(93, 20, 'Lincoln Financial Group NY', '#AgentGuide', '#eApp', 1),
(94, 22, 'Lincoln Financial Group', '#AgentGuide', '#eApp', 1),
(95, 23, 'Brighthouse Life Insurance Company of NY', '#AgentGuide', '#eApp', 1),
(96, 24, 'AXA Equitable Life Insurance Company', '#AgentGuide', '#eApp', 1),
(97, 25, 'Savings Bank Life Insurance Company of MA', '#AgentGuide', '#eApp', 1),
(98, 26, 'American National Insurance Company', '#AgentGuide', '#eApp', 1),
(99, 27, 'Symetra Life Insurance Company', '#AgentGuide', '#eApp', 1),
(100, 28, 'Cincinnati Life Insurance Company', '#AgentGuide', '#eApp', 1),
(101, 29, 'Principal Financial Group', '#AgentGuide', '#eApp', 1),
(102, 30, 'Principal Financial Group NY', '#AgentGuide', '#eApp', 1),
(103, 31, 'First Symetra National Life Insurance Company of New York', '#AgentGuide', '#eApp', 1),
(104, 32, 'American-Amicable Life Insurance Company of Texas', '#AgentGuide', '#eApp', 1),
(105, 33, 'Occidental Life Insurance Company of NC', '#AgentGuide', '#eApp', 1),
(106, 34, 'John Hancock Life Insurance Company USA', '#AgentGuide', '#eApp', 1),
(107, 35, 'John Hancock Life Insurance Company NY', '#AgentGuide', '#eApp', 1),
(108, 36, 'Foresters Life Insurance & Annuity', '#AgentGuide', '#eApp', 1),
(109, 38, 'Americo Financial Life & Annuity', '#AgentGuide', '#eApp', 1),
(110, 39, 'United Home Life Insurance Company', '#AgentGuide', '#eApp', 1),
(111, 40, 'The Baltimore Life Insurance Company', '#AgentGuide', '#eApp', 1),
(112, 41, 'Gerber Life Insurance Company', '#AgentGuide', '#eApp', 1),
(113, 43, 'Assurity Life Insurance Company', '#AgentGuide', '#eApp', 1),
(114, 44, 'Royal Neighbors of America', '#AgentGuide', '#eApp', 1),
(115, 45, 'Fidelity Life Association', '#AgentGuide', '#eApp', 1),
(116, 46, 'Liberty Bankers Life Insurance Company', '#AgentGuide', '#eApp', 1),
(117, 47, 'S.USA Life Insurance Company', '#AgentGuide', '#eApp', 1),
(118, 48, 'Oxford Life Insurance Company', '#AgentGuide', '#eApp', 1),
(119, 49, 'LifeShield National Insurance Company', '#AgentGuide', '#eApp', 1),
(120, 50, 'Kansas City Life Insurance Company', '#AgentGuide', '#eApp', 1),
(121, 51, 'PHL Variable Insurance Company', '#AgentGuide', '#eApp', 1),
(122, 52, 'Continental Life Brentwood TN', '#AgentGuide', '#eApp', 1),
(123, 53, 'American Continental Insurance Company', '#AgentGuide', '#eApp', 1),
(124, 54, 'Security National Life Ins Co', '#AgentGuide', '#eApp', 1);

-- --------------------------------------------------------

--
-- Table structure for table `carriers_categories`
--

CREATE TABLE `carriers_categories` (
  `company_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carriers_categories`
--

INSERT INTO `carriers_categories` (`company_id`, `category_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(4, 4),
(5, 1),
(5, 4),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(9, 2),
(9, 4),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(15, 2),
(15, 4),
(16, 1),
(17, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(25, 4),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 2),
(32, 4),
(33, 2),
(33, 4),
(34, 1),
(35, 1),
(36, 1),
(36, 2),
(36, 4),
(37, 1),
(38, 2),
(38, 4),
(39, 2),
(39, 4),
(40, 2),
(41, 4),
(42, 4),
(43, 1),
(44, 4),
(45, 4),
(46, 4),
(47, 4),
(48, 4),
(49, 4),
(50, 2),
(51, 1),
(51, 2),
(51, 4),
(52, 4),
(53, 4),
(54, 4);

-- --------------------------------------------------------

--
-- Table structure for table `carriers_category_users`
--

CREATE TABLE `carriers_category_users` (
  `category_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carriers_category_users`
--

INSERT INTO `carriers_category_users` (`category_id`, `user_id`, `company_id`) VALUES
(1, 1, 1),
(1, 1, 4),
(1, 1, 5),
(1, 1, 6),
(1, 1, 8),
(1, 1, 9),
(1, 1, 11),
(1, 1, 13),
(1, 1, 14),
(1, 1, 16),
(1, 1, 17),
(1, 1, 20),
(1, 1, 22),
(1, 1, 23),
(1, 1, 24),
(1, 1, 25),
(1, 1, 26),
(1, 1, 27),
(1, 1, 28),
(1, 1, 29),
(1, 1, 30),
(1, 1, 31),
(1, 1, 34),
(1, 1, 35),
(1, 1, 36),
(1, 1, 43),
(1, 1, 51),
(1, 3, 1),
(1, 3, 4),
(1, 3, 5),
(1, 3, 6),
(1, 3, 8),
(1, 3, 9),
(1, 3, 11),
(1, 3, 13),
(1, 3, 14),
(1, 3, 16),
(1, 3, 17),
(1, 3, 20),
(1, 3, 22),
(1, 3, 23),
(1, 3, 24),
(1, 3, 25),
(1, 3, 26),
(1, 3, 27),
(1, 3, 28),
(1, 3, 29),
(1, 3, 30),
(1, 3, 31),
(1, 3, 34),
(1, 3, 35),
(1, 3, 36),
(1, 3, 43),
(1, 3, 51),
(1, 6, 1),
(1, 6, 4),
(1, 6, 5),
(1, 6, 6),
(1, 6, 8),
(1, 6, 9),
(1, 6, 11),
(1, 6, 13),
(1, 6, 14),
(1, 6, 16),
(1, 6, 17),
(1, 6, 20),
(1, 6, 22),
(1, 6, 23),
(1, 6, 24),
(1, 6, 25),
(1, 6, 26),
(1, 6, 27),
(1, 6, 28),
(1, 6, 29),
(1, 6, 30),
(1, 6, 31),
(1, 6, 34),
(1, 6, 35),
(1, 6, 36),
(1, 6, 43),
(1, 6, 51),
(1, 7, 1),
(1, 7, 4),
(1, 7, 5),
(1, 7, 6),
(1, 7, 8),
(1, 7, 9),
(1, 7, 11),
(1, 7, 13),
(1, 7, 14),
(1, 7, 16),
(1, 7, 17),
(1, 7, 20),
(1, 7, 22),
(1, 7, 23),
(1, 7, 24),
(1, 7, 25),
(1, 7, 26),
(1, 7, 27),
(1, 7, 28),
(1, 7, 29),
(1, 7, 30),
(1, 7, 31),
(1, 7, 34),
(1, 7, 35),
(1, 7, 36),
(1, 7, 43),
(1, 7, 51),
(1, 28, 1),
(1, 28, 4),
(1, 28, 5),
(1, 28, 8),
(1, 28, 9),
(1, 28, 11),
(1, 28, 13),
(1, 28, 14),
(1, 28, 16),
(1, 28, 17),
(1, 28, 20),
(1, 28, 22),
(1, 28, 23),
(1, 28, 24),
(1, 28, 25),
(1, 28, 26),
(1, 28, 27),
(1, 28, 28),
(1, 28, 29),
(1, 28, 30),
(1, 28, 31),
(1, 28, 36),
(1, 28, 43),
(1, 28, 51),
(1, 31, 1),
(1, 31, 4),
(1, 31, 5),
(1, 31, 6),
(1, 31, 8),
(1, 31, 9),
(1, 31, 11),
(1, 31, 13),
(1, 31, 14),
(1, 31, 16),
(1, 31, 17),
(1, 31, 20),
(1, 31, 22),
(1, 31, 23),
(1, 31, 24),
(1, 31, 25),
(1, 31, 26),
(1, 31, 27),
(1, 31, 28),
(1, 31, 29),
(1, 31, 30),
(1, 31, 31),
(1, 31, 34),
(1, 31, 35),
(1, 31, 36),
(1, 31, 43),
(1, 31, 51),
(1, 34, 1),
(1, 34, 4),
(1, 34, 5),
(1, 34, 6),
(1, 34, 8),
(1, 34, 9),
(1, 34, 11),
(1, 34, 13),
(1, 34, 14),
(1, 34, 16),
(1, 34, 17),
(1, 34, 20),
(1, 34, 22),
(1, 34, 23),
(1, 34, 24),
(1, 34, 25),
(1, 34, 26),
(1, 34, 27),
(1, 34, 28),
(1, 34, 29),
(1, 34, 30),
(1, 34, 31),
(1, 34, 34),
(1, 34, 35),
(1, 34, 36),
(1, 34, 43),
(1, 34, 51),
(1, 46, 1),
(1, 46, 4),
(1, 46, 5),
(1, 46, 6),
(1, 46, 8),
(1, 46, 9),
(1, 46, 11),
(1, 46, 13),
(1, 46, 14),
(1, 46, 16),
(1, 46, 17),
(1, 46, 20),
(1, 46, 22),
(1, 46, 23),
(1, 46, 24),
(1, 46, 25),
(1, 46, 26),
(1, 46, 27),
(1, 46, 28),
(1, 46, 29),
(1, 46, 30),
(1, 46, 31),
(1, 46, 34),
(1, 46, 35),
(1, 46, 36),
(1, 46, 43),
(1, 46, 51),
(1, 49, 4),
(1, 49, 5),
(1, 49, 9),
(1, 49, 16),
(1, 49, 26),
(1, 49, 36),
(1, 49, 43),
(1, 73, 1),
(1, 73, 4),
(1, 73, 5),
(1, 73, 9),
(1, 73, 16),
(1, 73, 26),
(1, 73, 36),
(1, 73, 43),
(1, 78, 9),
(1, 78, 36),
(1, 126, 1),
(1, 126, 4),
(1, 126, 5),
(1, 126, 6),
(1, 126, 8),
(1, 126, 9),
(1, 126, 11),
(1, 126, 13),
(1, 126, 14),
(1, 126, 16),
(1, 126, 17),
(1, 126, 20),
(1, 126, 22),
(1, 126, 23),
(1, 126, 24),
(1, 126, 25),
(1, 126, 26),
(1, 126, 27),
(1, 126, 28),
(1, 126, 29),
(1, 126, 30),
(1, 126, 31),
(1, 126, 34),
(1, 126, 35),
(1, 126, 36),
(1, 126, 43),
(1, 126, 51),
(1, 127, 1),
(1, 127, 4),
(1, 127, 5),
(1, 127, 6),
(1, 127, 8),
(1, 127, 9),
(1, 127, 11),
(1, 127, 13),
(1, 127, 14),
(1, 127, 16),
(1, 127, 17),
(1, 127, 20),
(1, 127, 22),
(1, 127, 23),
(1, 127, 24),
(1, 127, 25),
(1, 127, 26),
(1, 127, 27),
(1, 127, 28),
(1, 127, 29),
(1, 127, 30),
(1, 127, 31),
(1, 127, 34),
(1, 127, 35),
(1, 127, 36),
(1, 127, 43),
(1, 127, 51),
(1, 128, 5),
(1, 128, 9),
(1, 128, 16),
(1, 128, 26),
(1, 129, 5),
(1, 129, 9),
(1, 129, 36),
(2, 1, 9),
(2, 1, 32),
(2, 1, 33),
(2, 1, 36),
(2, 1, 38),
(2, 1, 39),
(2, 1, 40),
(2, 1, 50),
(2, 1, 51),
(2, 3, 9),
(2, 3, 32),
(2, 3, 33),
(2, 3, 36),
(2, 3, 38),
(2, 3, 39),
(2, 3, 40),
(2, 3, 50),
(2, 3, 51),
(2, 6, 9),
(2, 6, 32),
(2, 6, 36),
(2, 6, 38),
(2, 6, 39),
(2, 6, 40),
(2, 7, 9),
(2, 7, 32),
(2, 7, 33),
(2, 7, 36),
(2, 7, 38),
(2, 7, 39),
(2, 7, 40),
(2, 7, 50),
(2, 7, 51),
(2, 28, 9),
(2, 28, 32),
(2, 28, 36),
(2, 28, 38),
(2, 28, 39),
(2, 28, 40),
(2, 28, 50),
(2, 28, 51),
(2, 31, 9),
(2, 31, 32),
(2, 31, 33),
(2, 31, 36),
(2, 31, 38),
(2, 31, 39),
(2, 31, 40),
(2, 31, 50),
(2, 31, 51),
(2, 34, 9),
(2, 34, 32),
(2, 34, 33),
(2, 34, 36),
(2, 34, 38),
(2, 34, 39),
(2, 34, 40),
(2, 34, 50),
(2, 34, 51),
(2, 46, 9),
(2, 46, 32),
(2, 46, 33),
(2, 46, 36),
(2, 46, 38),
(2, 46, 39),
(2, 46, 40),
(2, 46, 50),
(2, 46, 51),
(2, 49, 9),
(2, 49, 32),
(2, 49, 33),
(2, 49, 36),
(2, 49, 38),
(2, 49, 39),
(2, 49, 40),
(2, 73, 9),
(2, 73, 32),
(2, 73, 33),
(2, 73, 36),
(2, 73, 38),
(2, 78, 9),
(2, 78, 32),
(2, 78, 33),
(2, 78, 36),
(2, 78, 39),
(2, 126, 9),
(2, 126, 32),
(2, 126, 33),
(2, 126, 36),
(2, 126, 38),
(2, 126, 39),
(2, 126, 40),
(2, 126, 50),
(2, 126, 51),
(2, 127, 9),
(2, 127, 32),
(2, 127, 33),
(2, 127, 36),
(2, 127, 38),
(2, 127, 39),
(2, 127, 40),
(2, 127, 50),
(2, 127, 51),
(4, 1, 4),
(4, 1, 5),
(4, 1, 9),
(4, 1, 25),
(4, 1, 32),
(4, 1, 33),
(4, 1, 36),
(4, 1, 38),
(4, 1, 39),
(4, 1, 41),
(4, 1, 44),
(4, 1, 45),
(4, 1, 46),
(4, 1, 47),
(4, 1, 48),
(4, 1, 49),
(4, 1, 51),
(4, 1, 52),
(4, 1, 53),
(4, 1, 54),
(4, 3, 4),
(4, 3, 5),
(4, 3, 9),
(4, 3, 25),
(4, 3, 32),
(4, 3, 33),
(4, 3, 36),
(4, 3, 38),
(4, 3, 39),
(4, 3, 41),
(4, 3, 44),
(4, 3, 45),
(4, 3, 46),
(4, 3, 47),
(4, 3, 48),
(4, 3, 49),
(4, 3, 51),
(4, 3, 52),
(4, 3, 53),
(4, 3, 54),
(4, 6, 4),
(4, 6, 5),
(4, 6, 9),
(4, 6, 25),
(4, 6, 32),
(4, 6, 33),
(4, 6, 36),
(4, 6, 38),
(4, 6, 39),
(4, 6, 41),
(4, 6, 44),
(4, 6, 45),
(4, 6, 46),
(4, 6, 47),
(4, 6, 48),
(4, 6, 49),
(4, 6, 51),
(4, 6, 52),
(4, 6, 53),
(4, 6, 54),
(4, 7, 4),
(4, 7, 5),
(4, 7, 9),
(4, 7, 25),
(4, 7, 32),
(4, 7, 33),
(4, 7, 36),
(4, 7, 38),
(4, 7, 39),
(4, 7, 41),
(4, 7, 44),
(4, 7, 45),
(4, 7, 46),
(4, 7, 47),
(4, 7, 48),
(4, 7, 49),
(4, 7, 51),
(4, 7, 52),
(4, 7, 53),
(4, 7, 54),
(4, 28, 4),
(4, 28, 5),
(4, 28, 9),
(4, 28, 25),
(4, 28, 32),
(4, 28, 33),
(4, 28, 36),
(4, 28, 38),
(4, 28, 39),
(4, 28, 41),
(4, 28, 44),
(4, 28, 45),
(4, 28, 46),
(4, 28, 47),
(4, 28, 52),
(4, 28, 53),
(4, 31, 4),
(4, 31, 5),
(4, 31, 9),
(4, 31, 25),
(4, 31, 32),
(4, 31, 33),
(4, 31, 36),
(4, 31, 38),
(4, 31, 39),
(4, 31, 41),
(4, 31, 44),
(4, 31, 45),
(4, 31, 46),
(4, 31, 47),
(4, 31, 48),
(4, 31, 49),
(4, 31, 51),
(4, 31, 52),
(4, 31, 53),
(4, 31, 54),
(4, 34, 4),
(4, 34, 5),
(4, 34, 9),
(4, 34, 25),
(4, 34, 32),
(4, 34, 33),
(4, 34, 36),
(4, 34, 38),
(4, 34, 39),
(4, 34, 41),
(4, 34, 44),
(4, 34, 45),
(4, 34, 46),
(4, 34, 47),
(4, 34, 48),
(4, 34, 49),
(4, 34, 51),
(4, 34, 52),
(4, 34, 53),
(4, 34, 54),
(4, 46, 4),
(4, 46, 5),
(4, 46, 9),
(4, 46, 25),
(4, 46, 32),
(4, 46, 33),
(4, 46, 36),
(4, 46, 38),
(4, 46, 39),
(4, 46, 41),
(4, 46, 44),
(4, 46, 45),
(4, 46, 46),
(4, 46, 47),
(4, 46, 48),
(4, 46, 49),
(4, 46, 51),
(4, 46, 52),
(4, 46, 53),
(4, 46, 54),
(4, 49, 4),
(4, 49, 5),
(4, 49, 9),
(4, 49, 32),
(4, 49, 33),
(4, 49, 36),
(4, 49, 38),
(4, 49, 39),
(4, 49, 41),
(4, 49, 44),
(4, 49, 45),
(4, 49, 52),
(4, 49, 53),
(4, 53, 4),
(4, 53, 5),
(4, 53, 9),
(4, 53, 25),
(4, 53, 32),
(4, 53, 33),
(4, 53, 36),
(4, 53, 38),
(4, 53, 39),
(4, 53, 41),
(4, 53, 44),
(4, 53, 45),
(4, 53, 46),
(4, 53, 47),
(4, 53, 48),
(4, 53, 49),
(4, 53, 51),
(4, 53, 52),
(4, 53, 53),
(4, 53, 54),
(4, 57, 4),
(4, 57, 5),
(4, 57, 9),
(4, 57, 25),
(4, 57, 32),
(4, 57, 33),
(4, 57, 36),
(4, 57, 38),
(4, 57, 39),
(4, 57, 41),
(4, 57, 44),
(4, 57, 45),
(4, 57, 46),
(4, 57, 47),
(4, 57, 48),
(4, 57, 49),
(4, 57, 51),
(4, 57, 52),
(4, 57, 53),
(4, 57, 54),
(4, 73, 4),
(4, 73, 5),
(4, 73, 9),
(4, 73, 32),
(4, 73, 33),
(4, 73, 36),
(4, 73, 41),
(4, 73, 44),
(4, 78, 5),
(4, 78, 9),
(4, 78, 32),
(4, 78, 33),
(4, 78, 36),
(4, 78, 39),
(4, 126, 4),
(4, 126, 5),
(4, 126, 9),
(4, 126, 25),
(4, 126, 32),
(4, 126, 33),
(4, 126, 36),
(4, 126, 38),
(4, 126, 39),
(4, 126, 41),
(4, 126, 44),
(4, 126, 45),
(4, 126, 46),
(4, 126, 47),
(4, 126, 48),
(4, 126, 49),
(4, 126, 51),
(4, 126, 52),
(4, 126, 53),
(4, 126, 54),
(4, 127, 4),
(4, 127, 5),
(4, 127, 9),
(4, 127, 25),
(4, 127, 32),
(4, 127, 33),
(4, 127, 36),
(4, 127, 38),
(4, 127, 39),
(4, 127, 41),
(4, 127, 44),
(4, 127, 45),
(4, 127, 46),
(4, 127, 47),
(4, 127, 48),
(4, 127, 49),
(4, 127, 51),
(4, 127, 52),
(4, 127, 53),
(4, 127, 54),
(4, 129, 4),
(4, 129, 5),
(4, 129, 9),
(4, 129, 32),
(4, 129, 36),
(4, 129, 44),
(4, 129, 45);

-- --------------------------------------------------------

--
-- Table structure for table `carriers_popular`
--

CREATE TABLE `carriers_popular` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carriers_popular`
--

INSERT INTO `carriers_popular` (`id`, `company_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2019-02-26 17:00:00', '2019-02-26 17:00:00'),
(2, 4, '2019-02-26 17:00:00', '2019-02-26 17:00:00'),
(3, 5, '2019-02-26 17:00:00', '2019-02-26 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `carriers_sit`
--

CREATE TABLE `carriers_sit` (
  `category_id` int(10) UNSIGNED NOT NULL COMMENT 'primary key',
  `user_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `carriers_siwl`
--

CREATE TABLE `carriers_siwl` (
  `category_id` int(10) UNSIGNED NOT NULL COMMENT 'primary key',
  `user_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `carrier_guides`
--

CREATE TABLE `carrier_guides` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guide_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(11) UNSIGNED NOT NULL,
  `product` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preferred` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carrier_guides`
--

INSERT INTO `carrier_guides` (`id`, `company_id`, `name`, `url`, `guide_title`, `category_id`, `product`, `preferred`, `created_at`, `updated_at`) VALUES
(3, 1, 'Term Simple G', 'https://underwritten1', 'Termers', 1, 'Term Simple', 1, '2019-02-24 10:00:00', '2019-02-24 10:00:00'),
(4, 1, 'Guide2', 'https://underwritten2', NULL, 1, 'Term Simple', 1, '2019-02-24 10:00:00', '2019-02-24 10:00:00'),
(5, 1, 'Guide3', 'https://sit_1', NULL, 2, 'SI Term Simple', 1, '2019-02-24 10:00:00', '2019-02-24 10:00:00'),
(6, 1, 'Guide4', 'https://sit_2', NULL, 2, 'SI Term Simple', 1, '2019-02-24 10:00:00', '2019-02-24 10:00:00'),
(7, 4, 'Guide1a', 'https://underwritten1', NULL, 1, 'AG Term Simple', 0, '2019-02-24 10:00:00', '2019-02-24 10:00:00'),
(8, 4, 'Guide2a', 'https://underwritten2', NULL, 1, 'AG Term Simple', 0, '2019-02-24 10:00:00', '2019-02-24 10:00:00'),
(9, 4, 'Guide3a', 'https://sit_1', NULL, 2, 'AG SI Term Simple', 1, '2019-02-24 10:00:00', '2019-02-24 10:00:00'),
(10, 4, 'Guide4a', 'https://sit_2', NULL, 2, 'AG SI Term Simple', 0, '2019-02-24 10:00:00', '2019-02-24 10:00:00'),
(11, 5, 'Guide1b', 'https://underwritten1', NULL, 1, 'TA Term Simple', 0, '2019-02-24 10:00:00', '2019-02-24 10:00:00'),
(12, 5, 'Guide2b', 'https://underwritten2', NULL, 1, 'TA Term Simple', 1, '2019-02-24 10:00:00', '2019-02-24 10:00:00'),
(13, 5, 'Guide3b', 'https://sit_1', NULL, 2, 'TA SI Term Simple', 0, '2019-02-24 10:00:00', '2019-02-24 10:00:00'),
(14, 5, 'Guide4b', 'https://sit_2', NULL, 2, 'TA SI Term Simple', 1, '2019-02-24 10:00:00', '2019-02-24 10:00:00'),
(15, 6, 'Guide5b', 'https://underwritten1', NULL, 1, 'PROT Term Simple', 0, '2019-02-24 10:00:00', '2019-02-24 10:00:00'),
(16, 6, 'Guide5b', 'https://underwritten2', NULL, 1, 'PROT Term Simple', 1, '2019-02-24 10:00:00', '2019-02-24 10:00:00'),
(17, 6, 'Guide5b', 'https://sit_1', NULL, 2, 'PROT SI Term Simple', 0, '2019-02-24 10:00:00', '2019-02-24 10:00:00'),
(18, 6, 'Guide5b', 'https://sit_2', NULL, 2, 'PROT SI Term Simple', 1, '2019-02-24 10:00:00', '2019-02-24 10:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `categories_insurance`
--

CREATE TABLE `categories_insurance` (
  `category_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories_insurance`
--

INSERT INTO `categories_insurance` (`category_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Underwritten Term', '2019-02-24 17:00:00', '2019-02-24 17:00:00'),
(2, 'Simplified Issue Term', '2019-02-24 17:00:00', '2019-02-24 17:00:00'),
(3, 'GUL', '2019-02-24 17:00:00', '2019-02-24 17:00:00'),
(4, 'Final Expense (SIWL)', '2019-02-24 17:00:00', '2019-02-24 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `colors_user`
--

CREATE TABLE `colors_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `menu_bar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rates_background` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_form_background` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header_background` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts_user`
--

CREATE TABLE `contacts_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `fname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `addr1` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `addr2` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zipcode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `primary_phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_user`
--

CREATE TABLE `customer_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `customer_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_address_street` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_address_street2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_address_country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_address_city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_address_state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_address_zip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `features_users`
--

CREATE TABLE `features_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `group_user`
--

CREATE TABLE `group_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_item_user`
--

CREATE TABLE `invoice_item_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_total` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_percentage` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_item_user`
--

INSERT INTO `invoice_item_user` (`id`, `item_id`, `invoice_id`, `code`, `quantity`, `discount_amount`, `tax_name`, `description`, `item_total`, `tax_id`, `tax_type`, `price`, `product_id`, `account_name`, `name`, `tax_percentage`, `created_at`, `updated_at`) VALUES
(1, '1616760000000073298', '1616760000000073286', 'my_mobile_life_quoter', '1', '0', '', 'Charges for this duration (from 27-November-2018 to 26-November-2019 )', '60', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2018-11-27 02:45:33', '2018-11-27 02:45:33'),
(2, '1616760000000081049', '1616760000000081037', 'my_mobile_life_quoter', '1', '0', '', 'Charges for this duration (from 28-November-2018 to 27-November-2019 )', '60', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2018-11-28 09:43:59', '2018-11-28 09:43:59'),
(3, '1616760000000081171', '1616760000000081159', 'my_mobile_life_quoter', '1', '0', '', 'Charges for this duration (from 28-November-2018 to 27-November-2019 )', '60', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2018-11-28 09:46:09', '2018-11-28 09:46:09'),
(4, '1616760000000081291', '1616760000000081279', 'my_mobile_life_quoter', '1', '0', '', 'Charges for this duration (from 28-November-2018 to 27-November-2019 )', '60', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2018-11-28 09:46:53', '2018-11-28 09:46:53'),
(5, '1616760000000081411', '1616760000000081399', 'my_mobile_life_quoter', '1', '0', '', 'Charges for this duration (from 28-November-2018 to 27-November-2019 )', '60', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2018-11-28 09:47:32', '2018-11-28 09:47:32'),
(6, '1616760000000081531', '1616760000000081519', 'my_mobile_life_quoter', '1', '0', '', 'Charges for this duration (from 28-November-2018 to 27-November-2019 )', '60', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2018-11-28 09:49:01', '2018-11-28 09:49:01'),
(7, '1616760000000081651', '1616760000000081639', 'my_mobile_life_quoter', '1', '0', '', 'Charges for this duration (from 28-November-2018 to 27-November-2019 )', '60', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2018-11-28 09:50:00', '2018-11-28 09:50:00'),
(8, '1616760000000081771', '1616760000000081759', 'my_mobile_life_quoter', '1', '0', '', 'Charges for this duration (from 28-November-2018 to 27-November-2019 )', '60', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2018-11-28 09:50:45', '2018-11-28 09:50:45'),
(9, '1616760000000081893', '1616760000000081881', 'my_mobile_life_quoter', '1', '0', '', 'Charges for this duration (from 28-November-2018 to 27-November-2019 )', '60', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2018-11-28 14:59:41', '2018-11-28 14:59:41'),
(10, '1616760000000082052', '1616760000000082040', 'my_mobile_life_quoter', '1', '0', '', 'Charges for this duration (from 28-November-2018 to 27-November-2019 )', '60', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2018-11-28 15:57:54', '2018-11-28 15:57:54'),
(11, '1616760000000090044', '1616760000000090032', 'my_mobile_life_quoter', '1', '0', '', 'Charges for this duration (from 3-December-2018 to 2-December-2019 )', '60', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2018-12-03 18:33:26', '2018-12-03 18:33:26'),
(12, '1616760000000090170', '1616760000000090158', 'my_mobile_life_quoter', '1', '0', '', 'Charges for this duration (from 3-December-2018 to 2-December-2019 )', '60', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2018-12-03 20:23:50', '2018-12-03 20:23:50'),
(13, '1616760000000096170', '1616760000000096158', 'my_mobile_life_quoter', '1', '0', '', 'Charges for this duration (from 5-December-2018 to 4-December-2019 )', '60', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2018-12-05 11:21:12', '2018-12-05 11:21:12'),
(14, '1616760000000104168', '1616760000000104156', 'my_mobile_life_quoter', '1', '0', '', 'Charges for this duration (from 5-December-2018 to 4-December-2019 )', '60', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2018-12-05 15:45:26', '2018-12-05 15:45:26'),
(15, '1616760000000104292', '1616760000000104280', 'my_mobile_life_quoter', '1', '0', '', 'Charges for this duration (from 5-December-2018 to 4-December-2019 )', '60', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2018-12-05 15:50:25', '2018-12-05 15:50:25'),
(16, '1616760000000112548', '1616760000000112536', 'my_mobile_life_quoter', '1', '0', '', 'Charges for this duration (from 6-December-2018 to 5-December-2019 )', '60', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2018-12-06 11:57:16', '2018-12-06 11:57:16'),
(17, '1616760000000112672', '1616760000000112660', 'my_mobile_life_quoter', '1', '0', '', 'Charges for this duration (from 6-December-2018 to 5-December-2019 )', '60', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2018-12-06 12:01:12', '2018-12-06 12:01:12'),
(18, '1616760000000112798', '1616760000000112786', 'my_mobile_life_quoter', '1', '0', '', 'Charges for this duration (from 6-December-2018 to 5-December-2019 )', '60', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2018-12-06 12:06:23', '2018-12-06 12:06:23'),
(19, '1616760000000112924', '1616760000000112912', 'my_mobile_life_quoter', '1', '0', '', 'Charges for this duration (from 6-December-2018 to 5-December-2019 )', '60', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2018-12-06 12:12:11', '2018-12-06 12:12:11'),
(20, '1616760000000111052', '1616760000000111040', 'my_mobile_life_quoter', '1', '0', '', 'Charges for this duration (from 6-December-2018 to 5-December-2019 )', '60', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2018-12-06 14:05:55', '2018-12-06 14:05:55'),
(21, '1616760000000124044', '1616760000000124032', 'my_mobile_life_quoter', '1', '0', '', 'Charges for this duration (from 7-December-2018 to 6-December-2019 )', '60', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2018-12-07 10:02:25', '2018-12-07 10:02:25'),
(22, '1616760000000136036', '1616760000000136032', 'my_mobile_life_quoter', '1', '10', '', 'Charges for this duration (from 12-December-2018 to 11-December-2019 )', '50', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2018-12-12 09:42:01', '2018-12-12 09:42:01'),
(23, '1616760000000135038', '1616760000000135034', 'my_mobile_life_quoter', '1', '10', '', 'Charges for this duration (from 12-December-2018 to 11-December-2019 )', '50', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2018-12-12 15:42:43', '2018-12-12 15:42:43'),
(24, '1616760000000140121', '1616760000000140111', 'my_mobile_life_quoter', '1', '60', '', 'Charges for this duration (from 12-December-2018 to 11-December-2019 )', '0', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2018-12-13 05:05:49', '2018-12-13 05:05:49'),
(25, '1616760000000140215', '1616760000000140205', 'my_mobile_life_quoter', '1', '60', '', 'Charges for this duration (from 12-December-2018 to 11-December-2019 )', '0', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2018-12-13 05:36:43', '2018-12-13 05:36:43'),
(26, '1616760000000151036', '1616760000000151032', 'my_mobile_life_quoter', '1', '10', '', 'Charges for this duration (from 13-December-2018 to 12-December-2019 )', '50', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2018-12-13 09:52:25', '2018-12-13 09:52:25'),
(27, '1616760000000151158', '1616760000000151154', 'my_mobile_life_quoter', '1', '10', '', 'Charges for this duration (from 13-December-2018 to 12-December-2019 )', '50', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2018-12-13 09:57:36', '2018-12-13 09:57:36'),
(28, '1616760000000151278', '1616760000000151274', 'my_mobile_life_quoter', '1', '10', '', 'Charges for this duration (from 13-December-2018 to 12-December-2019 )', '50', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2018-12-13 10:08:38', '2018-12-13 10:08:38'),
(29, '1616760000000152040', '1616760000000152036', 'my_mobile_life_quoter', '1', '10', '', 'Charges for this duration (from 13-December-2018 to 12-December-2019 )', '50', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2018-12-13 10:20:15', '2018-12-13 10:20:15'),
(30, '1616760000000151400', '1616760000000151396', 'my_mobile_life_quoter', '1', '10', '', 'Charges for this duration (from 13-December-2018 to 12-December-2019 )', '50', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2018-12-13 11:00:54', '2018-12-13 11:00:54'),
(31, '1616760000000152166', '1616760000000152162', 'my_mobile_life_quoter', '1', '10', '', 'Charges for this duration (from 13-December-2018 to 12-December-2019 )', '50', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2018-12-13 11:02:38', '2018-12-13 11:02:38'),
(32, '1616760000000150048', '1616760000000150044', 'my_mobile_life_quoter', '1', '10', '', 'Charges for this duration (from 13-December-2018 to 12-December-2019 )', '50', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2018-12-13 11:17:27', '2018-12-13 11:17:27'),
(33, '1616760000000151522', '1616760000000151518', 'my_mobile_life_quoter', '1', '10', '', 'Charges for this duration (from 13-December-2018 to 12-December-2019 )', '50', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2018-12-13 11:18:28', '2018-12-13 11:18:28'),
(34, '1616760000000151646', '1616760000000151642', 'my_mobile_life_quoter', '1', '10', '', 'Charges for this duration (from 13-December-2018 to 12-December-2019 )', '50', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2018-12-13 14:04:49', '2018-12-13 14:04:49'),
(35, '1616760000000151855', '1616760000000151851', 'my_mobile_life_quoter', '1', '10', '', 'Charges for this duration (from 13-December-2018 to 12-December-2019 )', '50', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2018-12-14 04:59:46', '2018-12-14 04:59:46'),
(36, '1616760000000150176', '1616760000000150172', 'my_mobile_life_quoter', '1', '10', '', 'Charges for this duration (from 13-December-2018 to 12-December-2019 )', '50', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2018-12-14 05:12:01', '2018-12-14 05:12:01'),
(37, '1616760000000173589', '1616760000000173577', 'my_mobile_life_quoter', '1', '0', '', 'Charges for this duration (from 17-January-2019 to 16-January-2020 )', '60', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2019-01-17 19:01:05', '2019-01-17 19:01:05'),
(38, '1616760000000173705', '1616760000000173693', 'my_mobile_life_quoter', '1', '0', '', 'Charges for this duration (from 17-January-2019 to 16-January-2020 )', '60', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2019-01-18 06:16:51', '2019-01-18 06:16:51'),
(39, '1616760000000183048', '1616760000000183036', 'my_mobile_life_quoter', '1', '0', '', 'Charges for this duration (from 18-January-2019 to 17-January-2020 )', '60', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2019-01-18 15:02:10', '2019-01-18 15:02:10'),
(40, '1616760000000183282', '1616760000000183270', 'my_mobile_life_quoter', '1', '0', '', 'Charges for this duration (from 18-January-2019 to 17-January-2020 )', '60', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2019-01-18 15:42:37', '2019-01-18 15:42:37'),
(41, '1616760000000183398', '1616760000000183386', 'my_mobile_life_quoter', '1', '0', '', 'Charges for this duration (from 18-January-2019 to 17-January-2020 )', '60', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2019-01-18 15:48:23', '2019-01-18 15:48:23'),
(42, '1616760000000183515', '1616760000000183511', 'my_mobile_life_quoter', '1', '10', '', 'Charges for this duration (from 20-January-2019 to 19-January-2020 )', '50', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2019-01-20 08:58:00', '2019-01-20 08:58:00'),
(43, '1616760000000183637', '1616760000000183633', 'my_mobile_life_quoter', '1', '10', '', 'Charges for this duration (from 20-January-2019 to 19-January-2020 )', '50', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2019-01-20 15:33:52', '2019-01-20 15:33:52'),
(44, '1616760000000183759', '1616760000000183755', 'my_mobile_life_quoter', '1', '10', '', 'Charges for this duration (from 20-January-2019 to 19-January-2020 )', '50', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2019-01-20 15:42:46', '2019-01-20 15:42:46'),
(45, '1616760000000183896', '1616760000000183884', 'my_mobile_life_quoter', '1', '0', '', 'Charges for this duration (from 21-January-2019 to 20-January-2020 )', '60', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2019-01-21 10:00:19', '2019-01-21 10:00:19'),
(46, '1616760000000185026', '1616760000000185014', 'my_mobile_life_quoter', '1', '0', '', 'Charges for this duration (from 21-January-2019 to 20-January-2020 )', '60', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2019-01-21 14:01:52', '2019-01-21 14:01:52'),
(47, '1616760000000188044', '1616760000000188032', 'my_mobile_life_quoter', '1', '0', '', 'Charges for this duration (from 21-January-2019 to 20-January-2020 )', '60', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2019-01-21 17:26:55', '2019-01-21 17:26:55'),
(48, '1616760000000186169', '1616760000000186165', 'my_mobile_life_quoter', '1', '10', '', 'Charges for this duration (from 21-January-2019 to 20-January-2020 )', '50', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2019-01-22 06:28:31', '2019-01-22 06:28:31'),
(49, '1616760000000193964', '1616760000000193960', 'my_mobile_life_quoter', '1', '10', '', 'Charges for this duration (from 22-January-2019 to 21-January-2020 )', '50', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2019-01-22 09:32:38', '2019-01-22 09:32:38'),
(50, '1616760000000200199', '1616760000000200195', 'my_mobile_life_quoter', '1', '10', '', 'Charges for this duration (from 23-January-2019 to 22-January-2020 )', '50', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2019-01-23 08:40:47', '2019-01-23 08:40:47'),
(51, '1616760000000200437', '1616760000000200433', 'my_mobile_life_quoter', '1', '10', '', 'Charges for this duration (from 23-January-2019 to 22-January-2020 )', '50', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2019-01-23 10:45:33', '2019-01-23 10:45:33'),
(52, '1616760000000200603', '1616760000000200599', 'my_mobile_life_quoter', '1', '10', '', 'Charges for this duration (from 23-January-2019 to 22-January-2020 )', '50', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2019-01-23 15:30:38', '2019-01-23 15:30:38'),
(53, '1616760000000200745', '1616760000000200741', 'my_mobile_life_quoter', '1', '10', '', 'Charges for this duration (from 23-January-2019 to 22-January-2020 )', '50', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2019-01-23 17:21:52', '2019-01-23 17:21:52'),
(54, '1616760000000200889', '1616760000000200885', 'my_mobile_life_quoter', '1', '10', '', 'Charges for this duration (from 23-January-2019 to 22-January-2020 )', '50', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2019-01-23 17:28:51', '2019-01-23 17:28:51'),
(55, '1616760000000205066', '1616760000000205062', 'my_mobile_life_quoter', '1', '10', '', 'Charges for this duration (from 23-January-2019 to 22-January-2020 )', '50', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2019-01-23 17:40:01', '2019-01-23 17:40:01'),
(56, '1616760000000205210', '1616760000000205206', 'my_mobile_life_quoter', '1', '10', '', 'Charges for this duration (from 23-January-2019 to 22-January-2020 )', '50', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2019-01-23 17:51:43', '2019-01-23 17:51:43'),
(57, '1616760000000205354', '1616760000000205350', 'my_mobile_life_quoter', '1', '10', '', 'Charges for this duration (from 23-January-2019 to 22-January-2020 )', '50', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2019-01-23 18:05:45', '2019-01-23 18:05:45'),
(58, '1616760000000207036', '1616760000000207032', 'my_mobile_life_quoter', '1', '10', '', 'Charges for this duration (from 24-January-2019 to 23-January-2020 )', '50', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2019-01-24 10:50:30', '2019-01-24 10:50:30'),
(59, '1616760000000207239', '1616760000000207235', 'my_mobile_life_quoter', '1', '10', '', 'Charges for this duration (from 24-January-2019 to 23-January-2020 )', '50', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2019-01-24 11:34:34', '2019-01-24 11:34:34'),
(60, '1616760000000211087', '1616760000000211083', 'my_mobile_life_quoter', '1', '10', '', 'Charges for this duration (from 25-January-2019 to 24-January-2020 )', '50', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2019-01-25 10:10:44', '2019-01-25 10:10:44'),
(61, '1616760000000215283', '1616760000000215279', 'my_mobile_life_quoter', '1', '10', '', 'Charges for this duration (from 25-January-2019 to 24-January-2020 )', '50', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2019-01-25 15:47:57', '2019-01-25 15:47:57'),
(62, '1616760000000215559', '1616760000000215555', 'my_mobile_life_quoter', '1', '10', '', 'Charges for this duration (from 25-January-2019 to 24-January-2020 )', '50', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2019-01-25 16:31:14', '2019-01-25 16:31:14'),
(63, '1616760000000215780', '1616760000000215776', 'my_mobile_life_quoter', '1', '10', '', 'Charges for this duration (from 25-January-2019 to 24-January-2020 )', '50', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2019-01-25 16:45:12', '2019-01-25 16:45:12'),
(64, '1616760000000215902', '1616760000000215898', 'my_mobile_life_quoter', '1', '10', '', 'Charges for this duration (from 25-January-2019 to 24-January-2020 )', '50', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2019-01-25 16:48:10', '2019-01-25 16:48:10'),
(65, '1616760000000219184', '1616760000000219180', 'my_mobile_life_quoter', '1', '10', '', 'Charges for this duration (from 25-January-2019 to 24-January-2020 )', '50', '', 'tax', '60', '1616760000000071005', 'Sales', 'Mobile Quoter', '0', '2019-01-25 17:31:51', '2019-01-25 17:31:51'),
(66, '1612310000000138038', '1612310000000138034', 'my_mobile_life_quoter', '1', '10', '', 'Charges for this duration (from 25-January-2019 to 24-January-2020 )', '50', '', 'tax', '60', '1612310000000125087', 'Sales', 'Mobile Quoter', '0', '2019-01-25 18:00:17', '2019-01-25 18:00:17'),
(67, '1612310000000179036', '1612310000000179032', 'my_mobile_life_quoter', '1', '10', '', 'Charges for this duration (from 19-February-2019 to 18-February-2020 )', '50', '', 'tax', '60', '1612310000000125087', 'Sales', 'Mobile Quoter', '0', '2019-02-20 00:59:55', '2019-02-20 00:59:55'),
(68, '1612310000000188044', '1612310000000188032', 'my_mobile_life_quoter', '1', '0', '', 'Charges for this duration (from 22-February-2019 to 21-February-2020 )', '60', '', 'tax', '60', '1612310000000125087', 'Sales', 'Mobile Quoter', '0', '2019-02-23 06:03:46', '2019-02-23 06:03:46'),
(69, '1612310000000192044', '1612310000000192032', 'my_mobile_life_quoter', '1', '0', '', 'Charges for this duration (from 27-February-2019 to 26-February-2020 )', '60', '', 'tax', '60', '1612310000000125087', 'Sales', 'Mobile Quoter', '0', '2019-02-27 19:31:50', '2019-02-27 19:31:50'),
(70, '1612310000000200036', '1612310000000200032', 'my_mobile_life_quoter', '1', '10', '', 'Charges for this duration (from 4-March-2019 to 3-March-2020 )', '50', '', 'tax', '60', '1612310000000125087', 'Sales', 'Mobile Quoter', '0', '2019-03-04 16:28:55', '2019-03-04 16:28:55'),
(71, '1612310000000214046', '1612310000000214034', 'my_mobile_life_quoter', '1', '0', '', 'Charges for this duration (from 15-March-2019 to 14-March-2020 )', '60', '', 'tax', '60', '1612310000000125087', 'Sales', 'Mobile Quoter', '0', '2019-03-15 14:12:23', '2019-03-15 14:12:23');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_user`
--

CREATE TABLE `invoice_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_total` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_url` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_user`
--

INSERT INTO `invoice_user` (`id`, `user_id`, `number`, `invoice_id`, `invoice_date`, `customer_id`, `status`, `currency_code`, `sub_total`, `total`, `customer_name`, `invoice_url`, `created_at`, `updated_at`) VALUES
(42, 9, 'AQ-005074', '1616760000000173693', '2019-01-17', '1616760000000173674', 'paid', 'USD', '60', '60', 'Test2 Two', 'https://subscriptions.zoho.com/portal/agentquote2018test/secure?CInvoiceID=2-f7bf1e13850d76221bb8cbdb2df5260c86c95e16a74a471cfa06b013c609f93127da833a52195b7491034d328241f09b0c8b920caf7a621fb00d3279baaade4632f2d422110cf256 ', '2019-01-18 08:59:17', '2019-01-18 08:59:17'),
(43, 10, 'AQ-005074', '1616760000000173693', '2019-01-17', '1616760000000173674', 'paid', 'USD', '60', '60', 'Test2 Two', 'https://subscriptions.zoho.com/portal/agentquote2018test/secure?CInvoiceID=2-f7bf1e13850d76221bb8cbdb2df5260c86c95e16a74a471cf9cb7344afc2549dba5b8a89a9b71fb391034d328241f09b0c8b920caf7a621f3b18966342a08bc68362122172f8cf69 ', '2019-01-18 09:02:52', '2019-01-18 09:02:52'),
(44, 11, 'AQ-005074', '1616760000000173693', '2019-01-17', '1616760000000173674', 'paid', 'USD', '60', '60', 'Test2 Two', 'https://subscriptions.zoho.com/portal/agentquote2018test/secure?CInvoiceID=2-f7bf1e13850d76221bb8cbdb2df5260c86c95e16a74a471ce04c5013d4305bb71989bc13aa2cd72c91034d328241f09b0c8b920caf7a621f6e547880a83c5b79b9ffaf52a02f68a1 ', '2019-01-18 09:06:17', '2019-01-18 09:06:17'),
(45, 12, 'AQ-005074', '1616760000000173693', '2019-01-17', '1616760000000173674', 'paid', 'USD', '60', '60', 'Test2 Two', 'https://subscriptions.zoho.com/portal/agentquote2018test/secure?CInvoiceID=2-f7bf1e13850d76221bb8cbdb2df5260c86c95e16a74a471c4e89f2330d83a5f418cc0b860fb57a9491034d328241f09b0c8b920caf7a621f3b30c796d45ce1ea01ea8b6857779caa ', '2019-01-18 09:55:38', '2019-01-18 09:55:38'),
(46, 13, 'AQ-005074', '1616760000000173693', '2019-01-17', '1616760000000173674', 'paid', 'USD', '60', '60', 'Test2 Two', 'https://subscriptions.zoho.com/portal/agentquote2018test/secure?CInvoiceID=2-f7bf1e13850d76221bb8cbdb2df5260c86c95e16a74a471c0db37061225465a60afa72fb81e7454b91034d328241f09b0c8b920caf7a621f95597d0a3c7fcac48dc16af40f4ee70a ', '2019-01-18 09:56:38', '2019-01-18 09:56:38'),
(47, 14, 'AQ-005075', '1616760000000183036', '2019-01-18', '1616760000000183017', 'paid', 'USD', '60', '60', 'Joe Smith', 'https://subscriptions.zoho.com/portal/agentquote2018test/secure?CInvoiceID=2-f7bf1e13850d7622fb9a99ad79938e723ecbdaa45eb1cc921d4e53bb4212298bd2de753344db8eac91034d328241f09b0c8b920caf7a621fe6ed275996b5aa4011e80a707f5b3196 ', '2019-01-18 15:02:10', '2019-01-18 15:02:10'),
(48, 16, 'AQ-005077', '1616760000000183270', '2019-01-18', '1616760000000183251', 'paid', 'USD', '60', '60', 'Test2 Two', 'https://subscriptions.zoho.com/portal/agentquote2018test/secure?CInvoiceID=2-f7bf1e13850d7622fb9a99ad79938e72aa34c3423c056c7eec3922a9ad57109f6705d081c2e08b0391034d328241f09b0c8b920caf7a621fe6ed275996b5aa4011e80a707f5b3196 ', '2019-01-18 15:42:37', '2019-01-18 15:42:37'),
(49, 17, 'AQ-005078', '1616760000000183386', '2019-01-18', '1616760000000183367', 'paid', 'USD', '60', '60', 'Franklin Decker', 'https://subscriptions.zoho.com/portal/agentquote2018test/secure?CInvoiceID=2-f7bf1e13850d7622fb9a99ad79938e72425c7ed2dcc7b4f673e263dc56e3fdcf3d72002b047849b691034d328241f09b0c8b920caf7a621fe6ed275996b5aa4011e80a707f5b3196 ', '2019-01-18 15:48:23', '2019-01-18 15:48:23'),
(50, 18, 'AQ-005079', '1616760000000183511', '2019-01-20', '1616760000000183492', 'paid', 'USD', '50', '50', 'Test2 Two', 'https://subscriptions.zoho.com/portal/agentquote2018test/secure?CInvoiceID=2-f7bf1e13850d7622fb9a99ad79938e7284c790682d54d168ae124b88765337cb9976be8910f1ecd491034d328241f09b0c8b920caf7a621fbd60d0a72d4feb2411e80a707f5b3196 ', '2019-01-20 08:58:00', '2019-01-20 08:58:00'),
(51, 19, 'AQ-005080', '1616760000000183633', '2019-01-20', '1616760000000183614', 'paid', 'USD', '50', '50', 'Test2 Two', 'https://subscriptions.zoho.com/portal/agentquote2018test/secure?CInvoiceID=2-f7bf1e13850d7622fb9a99ad79938e7262c4a961e0cc12bcf2f3646ad65c9e0aad04d911dbdc5a4c91034d328241f09b0c8b920caf7a621fbd60d0a72d4feb2411e80a707f5b3196 ', '2019-01-20 15:33:52', '2019-01-20 15:33:52'),
(52, 20, 'AQ-005081', '1616760000000183755', '2019-01-20', '1616760000000183736', 'paid', 'USD', '50', '50', 'Test2 Two', 'https://subscriptions.zoho.com/portal/agentquote2018test/secure?CInvoiceID=2-f7bf1e13850d7622fb9a99ad79938e72f7f9dde51c8930b38946923345261538f4e980eeb07aecd591034d328241f09b0c8b920caf7a621fbd60d0a72d4feb2411e80a707f5b3196 ', '2019-01-20 15:42:46', '2019-01-20 15:42:46'),
(53, 22, 'AQ-005081', '1616760000000183755', '2019-01-20', '1616760000000183736', 'paid', 'USD', '50', '50', 'Test2 Two', 'https://subscriptions.zoho.com/portal/agentquote2018test/secure?CInvoiceID=2-f7bf1e13850d7622fb9a99ad79938e72f7f9dde51c8930b3c6a6d8e8b1eea55aa839d8f1f8065a4c91034d328241f09b0c8b920caf7a621fbd60d0a72d4feb2411e80a707f5b3196 ', '2019-01-20 15:44:28', '2019-01-20 15:44:28'),
(54, 23, 'AQ-005081', '1616760000000183755', '2019-01-20', '1616760000000183736', 'paid', 'USD', '50', '50', 'Test2 Two', 'https://subscriptions.zoho.com/portal/agentquote2018test/secure?CInvoiceID=2-f7bf1e13850d7622fb9a99ad79938e72f7f9dde51c8930b3f253f751b42db1f9339c0339950ab78d91034d328241f09b0c8b920caf7a621fbd60d0a72d4feb2411e80a707f5b3196 ', '2019-01-20 15:52:46', '2019-01-20 15:52:46'),
(55, 24, 'AQ-005081', '1616760000000183755', '2019-01-20', '1616760000000183736', 'paid', 'USD', '50', '50', 'Test2 Two', 'https://subscriptions.zoho.com/portal/agentquote2018test/secure?CInvoiceID=2-f7bf1e13850d7622fb9a99ad79938e72f7f9dde51c8930b3f88f6dcee43ec9782313c6ede177d4c191034d328241f09b0c8b920caf7a621fbd60d0a72d4feb2411e80a707f5b3196 ', '2019-01-20 15:56:45', '2019-01-20 15:56:45'),
(56, 25, 'AQ-005081', '1616760000000183755', '2019-01-20', '1616760000000183736', 'paid', 'USD', '50', '50', 'Test2 Two', 'https://subscriptions.zoho.com/portal/agentquote2018test/secure?CInvoiceID=2-f7bf1e13850d7622fb9a99ad79938e72f7f9dde51c8930b3dcfb98f746f80397cd4fc3aed3caa16391034d328241f09b0c8b920caf7a621fbd60d0a72d4feb2411e80a707f5b3196 ', '2019-01-20 15:57:54', '2019-01-20 15:57:54'),
(57, 26, 'AQ-005082', '1616760000000183884', '2019-01-21', '1616760000000183865', 'paid', 'USD', '60', '60', 'Test2 Two', 'https://subscriptions.zoho.com/portal/agentquote2018test/secure?CInvoiceID=2-f7bf1e13850d7622fb9a99ad79938e72e39c4025c0611e89934697be56466706f7deaf743188ceb991034d328241f09b0c8b920caf7a621f000cef5d3c16731a11e80a707f5b3196 ', '2019-01-21 10:00:19', '2019-01-21 10:00:19'),
(58, 27, 'AQ-005083', '1616760000000185014', '2019-01-21', '1616760000000183995', 'paid', 'USD', '60', '60', 'Test2 Two', 'https://subscriptions.zoho.com/portal/agentquote2018test/secure?CInvoiceID=2-f7bf1e13850d76227ef981c005755faae05d11ca99166b0e0b1536b344242c9c101119b36a935fc891034d328241f09b0c8b920caf7a621f000cef5d3c16731a11e80a707f5b3196 ', '2019-01-21 14:01:52', '2019-01-21 14:01:52'),
(59, 28, 'AQ-005085', '1616760000000188032', '2019-01-21', '1616760000000188013', 'paid', 'USD', '60', '60', 'Tony Sarlese', 'https://subscriptions.zoho.com/portal/agentquote2018test/secure?CInvoiceID=2-f7bf1e13850d762217a1d07b84e2b676ee4d3053e8c36bffce3db9c80cc0d328b019b38118bc31d491034d328241f09b0c8b920caf7a621f000cef5d3c16731a11e80a707f5b3196 ', '2019-01-21 17:26:55', '2019-01-21 17:26:55'),
(60, 29, 'AQ-005086', '1616760000000186165', '2019-01-21', '1616760000000186146', 'paid', 'USD', '50', '50', 'Frank D', 'https://subscriptions.zoho.com/portal/agentquote2018test/secure?CInvoiceID=2-f7bf1e13850d76220965b42c0641f373042cb8aa4cafb03cddc8f2f296faea794d19ca467bd70ce991034d328241f09b0c8b920caf7a621f000cef5d3c16731a11e80a707f5b3196 ', '2019-01-22 06:28:31', '2019-01-22 06:28:31'),
(61, 30, 'AQ-005087', '1616760000000193960', '2019-01-22', '1616760000000193941', 'paid', 'USD', '50', '50', 'Tester Oner', 'https://subscriptions.zoho.com/portal/agentquote2018test/secure?CInvoiceID=2-f7bf1e13850d7622022366f8ad58fa08f504bf71aafe4cb66eb58f3b2b4155014704f2697b3dc88991034d328241f09b0c8b920caf7a621fe8050ca0d533703111e80a707f5b3196 ', '2019-01-22 09:32:38', '2019-01-22 09:32:38'),
(62, 31, 'AQ-005099', '1616760000000200195', '2019-01-23', '1616760000000200176', 'paid', 'USD', '50', '50', 'Frank Decker3', 'https://zohosecurepay.com/subscriptions/agentquote2018test/secure?CInvoiceID=2-f7bf1e13850d7622cad4dc844ef0ceebf6bf2a131423edb1121e467090b5fb9dc83068b4860535a891034d328241f09b0c8b920caf7a621f6290e760c6653f6811e80a707f5b3196 ', '2019-01-23 08:40:47', '2019-01-23 08:40:47'),
(63, 32, 'AQ-005102', '1616760000000200433', '2019-01-23', '1616760000000200414', 'paid', 'USD', '50', '50', 'Franklin Decker', 'https://zohosecurepay.com/subscriptions/agentquote2018test/secure?CInvoiceID=2-f7bf1e13850d7622cad4dc844ef0ceeb5072883e9babeebc9aa761a24d1695fe35823b471139ce1991034d328241f09b0c8b920caf7a621f6290e760c6653f6811e80a707f5b3196 ', '2019-01-23 10:45:33', '2019-01-23 10:45:33'),
(64, 33, 'AQ-005103', '1616760000000200599', '2019-01-23', '1616760000000200580', 'paid', 'USD', '50', '50', 'Franklin Decker', 'https://zohosecurepay.com/subscriptions/agentquote2018test/secure?CInvoiceID=2-f7bf1e13850d7622cad4dc844ef0ceeba28cb9a8e44d898984d1860940a4e3cd1c23b95eb40139c491034d328241f09b0c8b920caf7a621f6290e760c6653f6811e80a707f5b3196 ', '2019-01-23 15:30:38', '2019-01-23 15:30:38'),
(65, 34, 'AQ-005105', '1616760000000200741', '2019-01-23', '1616760000000200722', 'paid', 'USD', '50', '50', 'Micro Test', 'https://zohosecurepay.com/subscriptions/agentquote2018test/secure?CInvoiceID=2-f7bf1e13850d7622cad4dc844ef0ceeb1d873c11543f83d56bbd12a63e44115ce4c3957eddc0f34f91034d328241f09b0c8b920caf7a621f6290e760c6653f6811e80a707f5b3196 ', '2019-01-23 17:21:52', '2019-01-23 17:21:52'),
(66, 35, 'AQ-005107', '1616760000000200885', '2019-01-23', '1616760000000200866', 'paid', 'USD', '50', '50', 'Franklin Decker', 'https://zohosecurepay.com/subscriptions/agentquote2018test/secure?CInvoiceID=2-f7bf1e13850d7622cad4dc844ef0ceebd61b69f8fae05b819cd227d8a6f0490977db3bee5c34f3e191034d328241f09b0c8b920caf7a621f6290e760c6653f6811e80a707f5b3196 ', '2019-01-23 17:28:51', '2019-01-23 17:28:51'),
(67, 36, 'AQ-005108', '1616760000000205062', '2019-01-23', '1616760000000205043', 'paid', 'USD', '50', '50', 'Franklin Decker', 'https://zohosecurepay.com/subscriptions/agentquote2018test/secure?CInvoiceID=2-f7bf1e13850d7622e92f35d449b68d390c1333b406d592b5b8c8818a253a1d42fc4fdb25d214638291034d328241f09b0c8b920caf7a621f6290e760c6653f6811e80a707f5b3196 ', '2019-01-23 17:40:01', '2019-01-23 17:40:01'),
(68, 37, 'AQ-005110', '1616760000000205206', '2019-01-23', '1616760000000205187', 'paid', 'USD', '50', '50', 'Franklin Decker', 'https://zohosecurepay.com/subscriptions/agentquote2018test/secure?CInvoiceID=2-f7bf1e13850d7622e92f35d449b68d39235013e9defdb2ef15c40949f6a85311947e2a60b674c50491034d328241f09b0c8b920caf7a621f6290e760c6653f6811e80a707f5b3196 ', '2019-01-23 17:51:43', '2019-01-23 17:51:43'),
(69, 38, 'AQ-005112', '1616760000000205350', '2019-01-23', '1616760000000205331', 'paid', 'USD', '50', '50', 'Franklin Decker', 'https://zohosecurepay.com/subscriptions/agentquote2018test/secure?CInvoiceID=2-f7bf1e13850d7622e92f35d449b68d39394b41354a4f001bce003a5979621e0cade63b18e8c7dcd791034d328241f09b0c8b920caf7a621f6290e760c6653f6811e80a707f5b3196 ', '2019-01-23 18:05:45', '2019-01-23 18:05:45'),
(70, 39, 'AQ-005115', '1616760000000207032', '2019-01-24', '1616760000000207013', 'paid', 'USD', '50', '50', 'Franklin Decker', 'https://zohosecurepay.com/subscriptions/agentquote2018test/secure?CInvoiceID=2-f7bf1e13850d7622d68aa9b890bf12f9ee4d3053e8c36bffddfe27af7c96a9e76d25365629acdf2491034d328241f09b0c8b920caf7a621f09ad5e721b94bda811e80a707f5b3196 ', '2019-01-24 10:50:30', '2019-01-24 10:50:30'),
(71, 40, 'AQ-005117', '1616760000000207235', '2019-01-24', '1616760000000207216', 'paid', 'USD', '50', '50', 'Franklin Decker', 'https://zohosecurepay.com/subscriptions/agentquote2018test/secure?CInvoiceID=2-f7bf1e13850d7622d68aa9b890bf12f93be0411b976a7afd57493c469bef95e5e3049bb095f6734991034d328241f09b0c8b920caf7a621f09ad5e721b94bda811e80a707f5b3196 ', '2019-01-24 11:34:34', '2019-01-24 11:34:34'),
(72, 41, 'AQ-005120', '1616760000000211083', '2019-01-25', '1616760000000211064', 'paid', 'USD', '50', '50', 'Franklin Decker', 'https://zohosecurepay.com/subscriptions/agentquote2018test/secure?CInvoiceID=2-f7bf1e13850d762293b380fe5f28cf7ee7d27b6adcca0d7392b6d1a32c79384802717e16a741ef6591034d328241f09b0c8b920caf7a621f6126c8d9beef6d5211e80a707f5b3196 ', '2019-01-25 10:10:44', '2019-01-25 10:10:44'),
(73, 42, 'AQ-005126', '1616760000000215279', '2019-01-25', '1616760000000215260', 'paid', 'USD', '50', '50', 'Joe Decker', 'https://zohosecurepay.com/subscriptions/agentquote2018test/secure?CInvoiceID=2-f7bf1e13850d7622a0e685a421ccab233304b8d4dae51acbd508b12077137d7eb6be557ec777c4e691034d328241f09b0c8b920caf7a621f6126c8d9beef6d5211e80a707f5b3196 ', '2019-01-25 15:47:57', '2019-01-25 15:47:57'),
(74, 43, 'AQ-005128', '1616760000000215555', '2019-01-25', '1616760000000215536', 'paid', 'USD', '50', '50', 'Test2 Two', 'https://zohosecurepay.com/subscriptions/agentquote2018test/secure?CInvoiceID=2-f7bf1e13850d7622a0e685a421ccab239287af59b8ca73306ef77ae094dc1ff66b69b4183ecb976291034d328241f09b0c8b920caf7a621f6126c8d9beef6d5211e80a707f5b3196 ', '2019-01-25 16:31:14', '2019-01-25 16:31:14'),
(75, 44, 'AQ-005130', '1616760000000215776', '2019-01-25', '1616760000000215757', 'paid', 'USD', '50', '50', 'Franklin Deckerer', 'https://zohosecurepay.com/subscriptions/agentquote2018test/secure?CInvoiceID=2-f7bf1e13850d7622a0e685a421ccab23ebedcbaa9100174dd6f4304fbc8fbedc05ce6d7e6f8d635b91034d328241f09b0c8b920caf7a621f6126c8d9beef6d5211e80a707f5b3196 ', '2019-01-25 16:45:12', '2019-01-25 16:45:12'),
(76, 45, 'AQ-005131', '1616760000000215898', '2019-01-25', '1616760000000215879', 'paid', 'USD', '50', '50', 'Franklin Deckers', 'https://zohosecurepay.com/subscriptions/agentquote2018test/secure?CInvoiceID=2-f7bf1e13850d7622a0e685a421ccab237a09e08f216587b30815bc37eee12e4ca7ec88042de64aff91034d328241f09b0c8b920caf7a621f6126c8d9beef6d5211e80a707f5b3196 ', '2019-01-25 16:48:10', '2019-01-25 16:48:10'),
(77, 46, 'AQ-005133', '1616760000000219180', '2019-01-25', '1616760000000219161', 'paid', 'USD', '50', '50', 'First Paypal', 'https://zohosecurepay.com/subscriptions/agentquote2018test/secure?CInvoiceID=2-f7bf1e13850d76225cc9f7e68c11511559b0641215eb4f4b1f72074d6a5d4675947e2a60b674c50491034d328241f09b0c8b920caf7a621f6126c8d9beef6d5211e80a707f5b3196 ', '2019-01-25 17:31:51', '2019-01-25 17:31:51'),
(78, 47, 'INV-AQ-73249', '1612310000000138034', '2019-01-25', '1612310000000138015', 'paid', 'USD', '50', '50', 'Patrick Pegram', 'https://subscriptions.mymobilelifequoter.com/portal/agentquoter/secure?CInvoiceID=2-a649294517db6380c0b604ee83135fb2ae12c49e71e0438a3dee2cb59142733cfa193e4278f81fdc91034d328241f09b8d24acf793b2b7bc6126c8d9beef6d5211e80a707f5b3196 ', '2019-01-25 18:00:17', '2019-01-25 18:00:17'),
(79, 125, 'INV-AQ-73280', '1612310000000179032', '2019-02-19', '1612310000000179013', 'paid', 'USD', '50', '50', 'Floyd West', 'https://subscriptions.mymobilelifequoter.com/portal/agentquoter/secure?CInvoiceID=2-a649294517db6380a4d2f78d0c4b1402ee4d3053e8c36bfffbec65dc6fa2a79e4ad5f72e50715b8c91034d328241f09b8d24acf793b2b7bccd0099b67dcd64fd11e80a707f5b3196 ', '2019-02-20 00:59:55', '2019-02-20 00:59:55'),
(80, 126, 'INV-AQ-73281', '1612310000000188032', '2019-02-22', '1612310000000188013', 'paid', 'USD', '60', '60', 'Larry Lerner', 'https://subscriptions.mymobilelifequoter.com/portal/agentquoter/secure?CInvoiceID=2-a649294517db638017a1d07b84e2b676ee4d3053e8c36bffaed75f6cb1eed85cccb14daf8aee2c0891034d328241f09b8d24acf793b2b7bcf25cdac6aaa6d8f611e80a707f5b3196 ', '2019-02-23 06:03:46', '2019-02-23 06:03:46'),
(81, 127, 'INV-AQ-73282', '1612310000000192032', '2019-02-27', '1612310000000192013', 'paid', 'USD', '60', '60', 'ANITA PARSONS KING', 'https://subscriptions.mymobilelifequoter.com/portal/agentquoter/secure?CInvoiceID=2-a649294517db63800a77a087dfbe2a15ee4d3053e8c36bff13e7fc88ef6caafe3cbaef9ade946ed891034d328241f09b8d24acf793b2b7bc61a1a56c64c1c5a211e80a707f5b3196 ', '2019-02-27 19:31:50', '2019-02-27 19:31:50'),
(82, 128, 'INV-AQ-73283', '1612310000000200032', '2019-03-04', '1612310000000200013', 'paid', 'USD', '50', '50', 'Katherine Clark', 'https://subscriptions.mymobilelifequoter.com/portal/agentquoter/secure?CInvoiceID=2-a649294517db6380cad4dc844ef0ceebee4d3053e8c36bffe1df18a8dcf3775c25f1be442174586691034d328241f09b8d24acf793b2b7bc163792e7a0c4b39c11e80a707f5b3196 ', '2019-03-04 16:28:55', '2019-03-04 16:28:55'),
(83, 129, 'INV-AQ-73284', '1612310000000214034', '2019-03-15', '1612310000000214015', 'paid', 'USD', '60', '60', 'Randy Catlett', 'https://subscriptions.mymobilelifequoter.com/portal/agentquoter/secure?CInvoiceID=2-a649294517db6380756e6b94e4d03908ae12c49e71e0438a6e6a90d63e65d4db7239059273acffdf91034d328241f09b240618ce8a0fc6968cc7688e7065969011e80a707f5b3196 ', '2019-03-15 14:12:23', '2019-03-15 14:12:23');

-- --------------------------------------------------------

--
-- Table structure for table `leads_user`
--

CREATE TABLE `leads_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `lead_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `quote_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages_user`
--

CREATE TABLE `messages_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `landing-pages`
--

CREATE TABLE `landing-pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `subdomain_id` int(10) UNSIGNED DEFAULT NULL,
  `default_category_id` int(10) UNSIGNED DEFAULT '0',
  `profile_id` int(10) UNSIGNED DEFAULT NULL,
  `show_logo` tinyint(1) NOT NULL DEFAULT '0',
  `show_portrait` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1796, '2014_10_12_000000_create_users_table', 1),
(1797, '2014_10_12_100000_create_password_resets_table', 1),
(1798, '2018_09_13_054440_create_subdomains_table', 1),
(1799, '2018_09_13_054516_create_microsites_table', 1),
(1800, '2018_09_13_055028_create_features_users_table', 1),
(1801, '2018_09_13_075046_create_categories_insurance_table', 1),
(1802, '2018_09_13_084730_create_profile_user_table', 1),
(1803, '2018_09_19_175835_create_colors_user_table', 1),
(1804, '2018_09_24_150947_update_users_add_firstname_lastname_timezone', 1),
(1805, '2018_09_25_065631_create_messages_user_table', 1),
(1806, '2018_09_25_074750_create_quotes_user_table', 1),
(1807, '2018_09_25_081120_create_leads_user_table', 1),
(1808, '2018_09_25_081719_create_contacts_user_table', 1),
(1809, '2018_09_26_120349_update_messages_user_add_search_index', 1),
(1810, '2018_10_19_094436_create_roles_table', 1),
(1811, '2018_10_19_094627_create_role_user_table', 1),
(1812, '2018_10_19_101406_create_groups_table', 1),
(1813, '2018_10_19_101818_create_group_user_table', 1),
(1814, '2018_10_19_103314_create_affiliates_table', 1),
(1815, '2018_10_19_103451_create_affiliate_user_table', 1),
(1816, '2018_11_14_102840_create_subscription_user_table', 1),
(1817, '2018_11_14_104328_create_plan_subscriptions_table', 1),
(1818, '2018_11_14_104811_create_card_subscriptions_table', 1),
(1819, '2018_11_21_063056_create_sessions_table', 1),
(1820, '2018_11_26_105005_create_invoice_user_table', 1),
(1821, '2018_11_26_105006_create_invoice_item_user_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `otp_users`
--

CREATE TABLE `otp_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `otp` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('tsarlese@agentquote.com ', '$2y$10$phQrsMKvrrGWbPvoLQr3v.yDZhXVKfIV9Tli7./y6b73223JkWRAu', '2019-01-21 17:24:15'),
('delanosan@gmail.com', '$2y$10$lU5JGjj1c0GO8oMmRXGDveILvk1YiQqbjLwWQpHkfKqpdeyjs60ay', '2019-02-08 06:58:52'),
('Fwlegacy2@gmail.com', '$2y$10$KgrSFiKqjGgj9kfPB0zgSOLWUuVu/xGmWKV6tuIuAW5OfwcpNaUku', '2019-02-26 19:05:57'),
('rstugberk@gmail.com', '$2y$10$14.ApGDRgz/uRO57AALEluLdI04H3BcRj4Yu6YRqXCHjB3mEhDhHK', '2019-03-13 17:18:46');

-- --------------------------------------------------------

--
-- Table structure for table `plan_subscriptions`
--

CREATE TABLE `plan_subscriptions` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `plan_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `setup_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plan_subscriptions`
--

INSERT INTO `plan_subscriptions` (`id`, `user_id`, `plan_code`, `name`, `quantity`, `price`, `discount`, `total`, `setup_fee`, `description`, `tax_id`, `created_at`, `updated_at`) VALUES
(50, 9, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-01-18 08:59:17', '2019-01-18 08:59:17'),
(51, 10, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-01-18 09:02:52', '2019-01-18 09:02:52'),
(52, 11, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-01-18 09:06:17', '2019-01-18 09:06:17'),
(53, 12, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-01-18 09:55:38', '2019-01-18 09:55:38'),
(54, 13, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-01-18 09:56:38', '2019-01-18 09:56:38'),
(55, 14, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-01-18 15:02:10', '2019-01-18 15:02:10'),
(56, 16, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-01-18 15:42:37', '2019-01-18 15:42:37'),
(57, 17, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-01-18 15:48:23', '2019-01-18 15:48:23'),
(58, 18, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-01-20 08:58:00', '2019-01-20 08:58:00'),
(59, 19, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-01-20 15:33:52', '2019-01-20 15:33:52'),
(60, 20, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-01-20 15:42:46', '2019-01-20 15:42:46'),
(61, 22, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-01-20 15:44:28', '2019-01-20 15:44:28'),
(62, 23, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-01-20 15:52:46', '2019-01-20 15:52:46'),
(63, 24, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-01-20 15:56:45', '2019-01-20 15:56:45'),
(64, 25, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-01-20 15:57:54', '2019-01-20 15:57:54'),
(65, 26, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-01-21 10:00:19', '2019-01-21 10:00:19'),
(66, 27, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-01-21 14:01:52', '2019-01-21 14:01:52'),
(67, 28, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-01-21 17:26:55', '2019-01-21 17:26:55'),
(68, 29, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-01-22 06:28:31', '2019-01-22 06:28:31'),
(69, 30, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-01-22 09:32:38', '2019-01-22 09:32:38'),
(70, 31, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-01-23 08:40:47', '2019-01-23 08:40:47'),
(71, 32, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-01-23 10:45:33', '2019-01-23 10:45:33'),
(72, 33, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-01-23 15:30:38', '2019-01-23 15:30:38'),
(73, 34, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-01-23 17:21:52', '2019-01-23 17:21:52'),
(74, 35, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-01-23 17:28:51', '2019-01-23 17:28:51'),
(75, 36, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-01-23 17:40:01', '2019-01-23 17:40:01'),
(76, 37, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-01-23 17:51:43', '2019-01-23 17:51:43'),
(77, 38, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-01-23 18:05:45', '2019-01-23 18:05:45'),
(78, 39, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-01-24 10:50:30', '2019-01-24 10:50:30'),
(79, 40, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-01-24 11:34:34', '2019-01-24 11:34:34'),
(80, 41, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-01-25 10:10:44', '2019-01-25 10:10:44'),
(81, 42, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-01-25 15:47:57', '2019-01-25 15:47:57'),
(82, 43, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-01-25 16:31:14', '2019-01-25 16:31:14'),
(83, 44, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-01-25 16:45:12', '2019-01-25 16:45:12'),
(84, 45, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-01-25 16:48:10', '2019-01-25 16:48:10'),
(85, 46, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-01-25 17:31:51', '2019-01-25 17:31:51'),
(86, 47, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-01-25 18:00:17', '2019-01-25 18:00:17'),
(87, 49, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-02-18 15:08:31', '2019-02-18 15:08:31'),
(88, 50, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-02-18 15:14:17', '2019-02-18 15:14:17'),
(89, 51, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-02-18 15:31:39', '2019-02-18 15:31:39'),
(90, 53, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-02-18 16:53:06', '2019-02-18 16:53:06'),
(91, 54, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-02-18 17:08:21', '2019-02-18 17:08:21'),
(92, 55, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-02-18 17:09:44', '2019-02-18 17:09:44'),
(93, 56, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-02-18 17:09:52', '2019-02-18 17:09:52'),
(94, 57, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-02-18 17:10:14', '2019-02-18 17:10:14'),
(95, 58, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-02-18 17:15:52', '2019-02-18 17:15:52'),
(96, 59, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-02-18 17:28:48', '2019-02-18 17:28:48'),
(97, 60, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-02-18 17:29:01', '2019-02-18 17:29:01'),
(98, 69, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-02-18 18:07:39', '2019-02-18 18:07:39'),
(99, 70, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-02-18 18:09:12', '2019-02-18 18:09:12'),
(100, 72, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-02-18 18:10:13', '2019-02-18 18:10:13'),
(101, 73, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-02-18 18:11:46', '2019-02-18 18:11:46'),
(102, 74, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-02-18 18:12:56', '2019-02-18 18:12:56'),
(103, 75, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-02-18 18:15:26', '2019-02-18 18:15:26'),
(104, 76, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-02-18 18:17:32', '2019-02-18 18:17:32'),
(105, 77, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-02-18 18:18:48', '2019-02-18 18:18:48'),
(106, 78, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-02-18 18:22:39', '2019-02-18 18:22:39'),
(107, 79, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-02-18 18:22:45', '2019-02-18 18:22:45'),
(108, 80, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-02-18 18:22:52', '2019-02-18 18:22:52'),
(109, 81, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-02-18 18:23:26', '2019-02-18 18:23:26'),
(110, 125, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-02-20 00:59:55', '2019-02-20 00:59:55'),
(111, 126, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-02-23 06:03:46', '2019-02-23 06:03:46'),
(112, 127, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-02-27 19:31:50', '2019-02-27 19:31:50'),
(113, 128, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-03-04 16:28:55', '2019-03-04 16:28:55'),
(114, 129, 'my_mobile_life_quoter', 'Mobile Quoter', '1', '60', NULL, '60', '0', NULL, NULL, '2019-03-15 14:12:23', '2019-03-15 14:12:23');

-- --------------------------------------------------------

--
-- Table structure for table `profile_user`
--

CREATE TABLE `profile_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `contact_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `portrait` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_addr1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_addr2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_zip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profile_user`
--

INSERT INTO `profile_user` (`id`, `user_id`, `contact_email`, `logo`, `portrait`, `company`, `contact_phone`, `contact_addr1`, `contact_addr2`, `contact_city`, `contact_state`, `contact_zip`, `position_title`, `created_at`, `updated_at`) VALUES
(3, 3, 'demo1@example.com', NULL, NULL, 'AgentQuote', NULL, '345 Gold Rd.', NULL, 'Fullerton', 'OH', '92833', NULL, '2018-11-28 09:46:09', '2018-12-06 15:32:20'),
(4, 4, 'demo2@example.com', NULL, NULL, 'AgentQuote', NULL, '345 Gold Rd.', NULL, 'Fullerton', 'CA', '92833', NULL, '2018-11-28 09:46:53', '2018-11-28 09:46:53'),
(5, 5, 'demo3@example.com', NULL, NULL, 'AgentQuote', NULL, '345 Gold Rd.', NULL, 'Fullerton', 'CA', '92833', NULL, '2018-11-28 09:47:32', '2018-11-28 09:47:32'),
(6, 6, 'ppegram@legacyagent.com ', NULL, NULL, 'AgentQuote', NULL, '345 Gold Rd.', NULL, 'Fullerton', 'OH', '92833', NULL, '2018-11-28 09:49:01', '2019-01-02 20:39:44'),
(7, 7, 'mhrynewich@legacyagent.com', NULL, NULL, 'AgentQuote', NULL, '345 Gold Rd.', NULL, 'Fullerton', 'MI', '92833', NULL, '2018-11-28 09:50:00', '2019-02-22 17:01:43'),
(8, 8, 'tsarlese@agentquote.com ', NULL, NULL, 'AgentQuote', NULL, '345 Gold Rd.', NULL, 'Fullerton', 'CA', '92833', NULL, '2018-11-28 09:50:45', '2018-11-28 09:50:45'),
(22, 25, 'delanosan@gmail.com', NULL, NULL, 'Agentquote', NULL, '34353 Gold St.', NULL, 'Fullerton', 'CA', '90631', NULL, '2019-01-20 15:57:54', '2019-01-20 15:57:54'),
(23, 26, 'delanosan_fd3@gmail.com', NULL, NULL, 'Agentquote', NULL, '34353 Gold St.', NULL, 'Fullerton', 'CA', '90631', NULL, '2019-01-21 10:00:19', '2019-01-21 10:00:19'),
(24, 27, 'delanosan_dddddd@gmail.com', NULL, NULL, 'Agentquote', NULL, '34353 Gold St.', NULL, 'Fullerton', 'CA', '90631', NULL, '2019-01-21 14:01:52', '2019-01-21 14:01:52'),
(25, 28, 'tsarlese@gmail.com', NULL, NULL, 'AQ', NULL, '123 Any', NULL, 'Sheridan', 'WY', '82801', NULL, '2019-01-21 17:26:55', '2019-01-25 20:30:40'),
(26, 29, 'delanosan_zoho@gmail.com', NULL, NULL, 'Agentquote', NULL, '34353 Gold St.', NULL, 'Fullerton', 'CA', '90631', NULL, '2019-01-22 06:28:31', '2019-01-22 06:28:31'),
(27, 30, 'delanosan_test_1@gmail.com', NULL, NULL, 'Agentquote', NULL, '34353 Gold St.', NULL, 'Fullerton', 'CA', '90631', NULL, '2019-01-22 09:32:38', '2019-01-22 09:32:38'),
(28, 31, 'microsite@mailinator.com', NULL, NULL, 'Agentquote', NULL, '34 Gold Rd.', NULL, 'Fullerton', 'CA', '92870', NULL, '2019-01-23 08:40:47', '2019-01-23 08:40:47'),
(29, 32, 'delanosan_test_22@gmail.com', NULL, NULL, 'Agentquote', NULL, '414 N. Placentia Ave.', NULL, 'Placentia', 'CA', '92870', NULL, '2019-01-23 10:45:33', '2019-01-23 10:45:33'),
(30, 33, 'withpatrick@mailinator.com', NULL, NULL, 'Agentquote', NULL, '3435 Gooold St.', NULL, 'Fullerton', 'CA', '90631', NULL, '2019-01-23 15:30:38', '2019-01-23 15:30:38'),
(31, 34, 'microtest@mailinator.com', NULL, NULL, 'Agentquote', NULL, '34353 Gold St.', NULL, 'Fullerton', 'CA', '90631', NULL, '2019-01-23 17:21:52', '2019-01-23 17:21:52'),
(32, 35, 'microtest2@mailinator.com', NULL, NULL, 'Agentquote', NULL, '34353 Gold St.', NULL, 'Fullerton', 'CA', '90631', NULL, '2019-01-23 17:28:51', '2019-01-23 17:28:51'),
(33, 36, 'microtest3@mailinator.com', NULL, NULL, 'Agentquote', NULL, '34353 Gold St.', NULL, 'Fullerton', 'CA', '90631', NULL, '2019-01-23 17:40:01', '2019-01-23 17:40:01'),
(34, 37, 'microtest4@mailinator.com', NULL, NULL, 'Agentquote', NULL, '34353 Gold St.', NULL, 'Fullerton', 'CA', '90631', NULL, '2019-01-23 17:51:43', '2019-01-23 17:51:43'),
(35, 38, 'microtest5@mailinator.com', NULL, NULL, 'Agentquote', NULL, '34353 Gold St.', NULL, 'Fullerton', 'CA', '90631', NULL, '2019-01-23 18:05:45', '2019-01-23 18:05:45'),
(36, 39, 'testwithme@mailinator.com', NULL, NULL, 'Agentquote', NULL, '34353 Gold St.', NULL, 'Fullerton', 'CA', '90631', NULL, '2019-01-24 10:50:30', '2019-01-24 10:50:30'),
(37, 40, 'gowest@mailinator.com', NULL, NULL, 'Agentquote', NULL, '34353 Gold St.', NULL, 'Fullerton', 'CA', '90631', NULL, '2019-01-24 11:34:34', '2019-01-24 11:34:34'),
(38, 41, 'delanosan_fd33@gmail.com', NULL, NULL, 'Agentquote', NULL, '414 N. Placentia Ave.', NULL, 'Placentia', 'CA', '92870', NULL, '2019-01-25 10:10:44', '2019-01-25 10:10:44'),
(39, 42, 'joejoejoe@mailinator.com', NULL, NULL, 'Agentquote', NULL, '34353 Gold St.', NULL, 'Fullerton', 'CA', '90631', NULL, '2019-01-25 15:47:57', '2019-01-25 15:47:57'),
(40, 43, 'joejoejoe1123@mailinator.com', NULL, NULL, 'Agentquote', NULL, '34353 Gold St.', NULL, 'Fullerton', 'CA', '90631', NULL, '2019-01-25 16:31:14', '2019-01-25 16:31:14'),
(41, 44, 'fdeckerer@mailinator.com', NULL, NULL, 'TR King', NULL, '34353 Gold St.', NULL, 'Fullerton', 'CA', '90631', NULL, '2019-01-25 16:45:12', '2019-01-25 16:45:12'),
(42, 45, 'fdeckers@mailinator.com', NULL, NULL, 'TR King', NULL, '34353 Gold St.', NULL, 'Fullerton', 'CA', '90631', NULL, '2019-01-25 16:48:10', '2019-01-25 16:48:10'),
(43, 46, 'firstpaypal@mailinator.com', NULL, NULL, 'My Co.', NULL, '34353 Gold St.', NULL, 'Fullerton', 'CA', '90631', NULL, '2019-01-25 17:31:51', '2019-01-25 17:31:51'),
(44, 47, 'billing@agentquoter.com', NULL, NULL, 'Legacy', NULL, '548 Deer Run', NULL, 'White Lake', 'MI', '48386', NULL, '2019-01-25 18:00:17', '2019-01-25 18:00:17'),
(45, 49, 'twalko@legacysecure.com', NULL, NULL, 'legacy', NULL, '1615 York Road Suite 301', NULL, 'Lutherville', 'MD', '21093', NULL, '2019-02-18 15:08:31', '2019-02-18 15:10:14'),
(46, 50, 'ucanbeinsured@gmail.com', NULL, NULL, 'legacy', NULL, '2724 Wilkinson Pike', NULL, 'Murfreesboro', 'TN', '37129', NULL, '2019-02-18 15:14:17', '2019-02-18 15:16:27'),
(47, 51, 'tyewest1@gmail.com', NULL, NULL, 'trking', NULL, '1702 Caswell pkwy', NULL, 'Marietta', 'GA', '30060', NULL, '2019-02-18 15:31:39', '2019-02-18 15:31:39'),
(48, 53, 'Rogersbenefits@gmail.com', NULL, NULL, 'trking', NULL, '164 Maple Ridge Rd', NULL, 'Reisterstown', 'MD', '21136', NULL, '2019-02-18 16:53:06', '2019-02-18 16:53:06'),
(49, 54, 'christopher@sammybean.com', NULL, NULL, 'trking', NULL, '6903 WIREVINE DR', NULL, 'BROOKSVILLE', 'FL', '34602', NULL, '2019-02-18 17:08:21', '2019-02-18 17:08:21'),
(50, 55, 'roxiewelsh@gmail.com', NULL, NULL, 'trking', NULL, 'po box 1065', NULL, 'sahuarita', 'AZ', '85629', NULL, '2019-02-18 17:09:44', '2019-02-18 17:09:44'),
(51, 56, 'rbgersten01@gmail.com', NULL, NULL, 'trking', NULL, '80 fawcett street', NULL, 'cambridge', 'MA', '02138', NULL, '2019-02-18 17:09:52', '2019-02-18 17:09:52'),
(52, 57, 'larry@larrybooksh.com', NULL, NULL, 'trking', NULL, '75 Trumbull Drive', NULL, 'Hudson', 'OH', '44236', NULL, '2019-02-18 17:10:14', '2019-02-18 17:10:14'),
(53, 58, 'unity4895@yahoo.com', NULL, NULL, 'legacy', NULL, '1952 Rugby St', NULL, 'Cleveland', 'OH', '44087', NULL, '2019-02-18 17:15:52', '2019-02-18 17:15:52'),
(54, 59, 'eric@EmpowermentRS.com', NULL, NULL, 'legacy', NULL, '30 South Wacker Drive Suite 2200', NULL, 'Chicago', 'IL', '60606', NULL, '2019-02-18 17:28:48', '2019-02-18 17:28:48'),
(55, 60, 'Fwlegacy2@gmail.com', NULL, NULL, 'legacy', NULL, '16618 N 153rd Dr', NULL, 'Surprise', 'AZ', '85374', NULL, '2019-02-18 17:29:01', '2019-02-18 17:29:01'),
(56, 69, 'rstugberk@gmail.com', NULL, NULL, 'legacy', NULL, '12306 Blair Ridge Rd', NULL, 'Fairfax', 'VA', '22033', NULL, '2019-02-18 18:07:39', '2019-02-18 18:07:39'),
(57, 70, 'sthao2012@gmail.com', NULL, NULL, 'legacy', NULL, '618 Stockton CT', NULL, 'Madison', 'WI', '53711', NULL, '2019-02-18 18:09:12', '2019-02-18 18:09:12'),
(58, 72, 'phirutsaoins@gmail.com', NULL, NULL, 'legacy', NULL, '3450 Adriatic Avenue', NULL, 'Long Beach', 'CA', '90810', NULL, '2019-02-18 18:10:13', '2019-02-18 18:10:13'),
(59, 73, 'reynoldsffg@gmail.com', NULL, NULL, 'legacy', NULL, '49815 Antelope Dr. E.', NULL, 'Bennett', 'CO', '80102', NULL, '2019-02-18 18:11:46', '2019-02-18 18:11:46'),
(60, 74, 'contact.tpalumbo@gmail.com', NULL, NULL, 'legacy', NULL, '11676 Great Abaco Ct', NULL, 'El Paso', 'TX', '76010', NULL, '2019-02-18 18:12:56', '2019-02-18 18:12:56'),
(61, 75, 'Matthew.lake18@gmail.com', NULL, NULL, 'legacy', NULL, '6875 Brooklyn Ave SE', NULL, 'Grand Rapids', 'MI', '49508', NULL, '2019-02-18 18:15:26', '2019-02-18 18:15:26'),
(62, 76, 'dlaggan@gmail.com', NULL, NULL, 'legacy', NULL, '3122 Coventry Dr', NULL, 'Parma', 'OH', '44134', NULL, '2019-02-18 18:17:32', '2019-02-18 18:17:32'),
(63, 77, 'wjohnson0310@gmail.com', NULL, NULL, 'legacy', NULL, '1755 Indian Lakes', NULL, 'Cedar Springs', 'MI', '49319', NULL, '2019-02-18 18:18:48', '2019-02-18 18:18:48'),
(64, 78, 'carlh5000@gmail.com', NULL, NULL, 'legacy', NULL, '3000 East Main St.', NULL, 'Columbus', 'OH', '43209', NULL, '2019-02-18 18:22:39', '2019-02-18 18:22:39'),
(65, 79, 'mharrison@psfin.com', NULL, NULL, 'legacy', NULL, '4215 E McDowell Rd', NULL, 'Mesa', 'AZ', '85215', NULL, '2019-02-18 18:22:45', '2019-02-18 18:22:45'),
(66, 80, 'timothycasey@comcast.net', NULL, NULL, 'legacy', NULL, '750 Towne Center Dr', NULL, 'Joppatowne', 'MD', '21085', NULL, '2019-02-18 18:22:52', '2019-02-18 18:22:52'),
(67, 81, 'tbowles0517@gmail.com', NULL, NULL, 'legacy', NULL, '2828 N Nansemond DR', NULL, 'Suffolk', 'VA', '23435', NULL, '2019-02-18 18:23:26', '2019-02-18 18:23:26'),
(68, 125, 'fwestii@yahoo.com', NULL, NULL, '', NULL, '16618 N 153rd Dr', NULL, 'Surprise', 'AZ', '85374', NULL, '2019-02-20 00:59:55', '2019-02-20 00:59:55'),
(69, 126, 'larrylerner5@gmail.com', NULL, NULL, '', NULL, '3000 Alexandria', NULL, 'marlton', 'NJ', '08054', NULL, '2019-02-23 06:03:46', '2019-02-23 06:03:46'),
(70, 127, 'anitaparsonsking@gmail.com', NULL, NULL, '', NULL, '842 Camelia Ave', NULL, 'Baton Rouge', 'LA', '70806', NULL, '2019-02-27 19:31:50', '2019-02-27 19:31:50'),
(71, 128, 'KATHERINE4INSURANCE@GMAIL.COM', NULL, NULL, 'Fredrick Insurance Brokers', NULL, '1510 Pecan Valley Ct', NULL, 'Corinth', 'TX', '76210', NULL, '2019-03-04 16:28:55', '2019-03-04 16:28:55'),
(72, 129, 'rcatlett@adv1brokers.com', NULL, NULL, '', NULL, '1086 Boulder Run', NULL, 'New Braunfels ', 'TX', '78132', NULL, '2019-03-15 14:12:22', '2019-03-15 14:12:22');

-- --------------------------------------------------------

--
-- Table structure for table `quotes_user`
--

CREATE TABLE `quotes_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `birthdate` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `smoker` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `term` int(11) NOT NULL,
  `coverage` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_id` int(11) NOT NULL,
  `product_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `premium_monthly` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `premium_quarterly` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `premium_semiannually` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `premium_annually` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'super', 'Super over all', NULL, NULL),
(2, 'admin', 'Admin over Group', NULL, NULL),
(3, 'manager', 'Manager over Group', NULL, NULL),
(4, 'user', 'Basic User', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`) VALUES
(1, 4, 1),
(2, 4, 2),
(3, 4, 3),
(4, 4, 4),
(5, 4, 5),
(6, 4, 6),
(7, 4, 7),
(8, 4, 8),
(12, 4, 13),
(26, 4, 30),
(27, 4, 31),
(28, 4, 32),
(29, 4, 33),
(30, 4, 34),
(31, 4, 35),
(32, 4, 36),
(33, 4, 37),
(34, 4, 38),
(35, 4, 39),
(36, 4, 40),
(37, 4, 41),
(38, 4, 42),
(39, 4, 43),
(40, 4, 45),
(41, 4, 47),
(42, 4, 48),
(43, 4, 49),
(44, 4, 51),
(45, 4, 52),
(46, 4, 54),
(47, 4, 55),
(48, 4, 56),
(49, 4, 57),
(50, 4, 9),
(51, 4, 10),
(52, 4, 11),
(53, 4, 12),
(54, 4, 14),
(55, 4, 16),
(56, 4, 17),
(57, 4, 18),
(58, 4, 19),
(59, 4, 20),
(60, 4, 22),
(61, 4, 23),
(62, 4, 24),
(63, 4, 25),
(64, 4, 26),
(65, 4, 27),
(66, 4, 28),
(67, 4, 29),
(68, 4, 44),
(69, 4, 46),
(70, 4, 50),
(71, 4, 53),
(72, 4, 58),
(73, 4, 59),
(74, 4, 60),
(75, 4, 69),
(76, 4, 70),
(77, 4, 72),
(78, 4, 73),
(79, 4, 74),
(80, 4, 75),
(81, 4, 76),
(82, 4, 77),
(83, 4, 78),
(84, 4, 79),
(85, 4, 80),
(86, 4, 81),
(87, 4, 125),
(88, 4, 126),
(89, 4, 127),
(90, 4, 128),
(91, 4, 129);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subdomains`
--

CREATE TABLE `subdomains` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscription_user`
--

CREATE TABLE `subscription_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `subscription_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `next_billing_at` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `interval_unit` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_symbol` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auto_collect` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_total` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscription_user`
--

INSERT INTO `subscription_user` (`id`, `subscription_id`, `user_id`, `name`, `next_billing_at`, `product_id`, `interval_unit`, `amount`, `currency_symbol`, `product_name`, `auto_collect`, `sub_total`, `status`, `customer_id`, `created_at`, `updated_at`) VALUES
(48, '1616760000000173672', '9', 'Mobile Quoter-Mobile Quoter', '2020-01-17', '1616760000000071001', 'years', '60', '$', 'Mobile Quoter', '1', '60', NULL, '1616760000000173674', '2019-01-18 08:59:17', '2019-01-18 08:59:17'),
(49, '1616760000000173672', '10', 'Mobile Quoter-Mobile Quoter', '2020-01-17', '1616760000000071001', 'years', '60', '$', 'Mobile Quoter', '1', '60', NULL, '1616760000000173674', '2019-01-18 09:02:52', '2019-01-18 09:02:52'),
(50, '1616760000000173672', '11', 'Mobile Quoter-Mobile Quoter', '2020-01-17', '1616760000000071001', 'years', '60', '$', 'Mobile Quoter', '1', '60', NULL, '1616760000000173674', '2019-01-18 09:06:17', '2019-01-18 09:06:17'),
(51, '1616760000000173672', '12', 'Mobile Quoter-Mobile Quoter', '2020-01-17', '1616760000000071001', 'years', '60', '$', 'Mobile Quoter', '1', '60', NULL, '1616760000000173674', '2019-01-18 09:55:38', '2019-01-18 09:55:38'),
(52, '1616760000000173672', '13', 'Mobile Quoter-Mobile Quoter', '2020-01-17', '1616760000000071001', 'years', '60', '$', 'Mobile Quoter', '1', '60', NULL, '1616760000000173674', '2019-01-18 09:56:38', '2019-01-18 09:56:38'),
(53, '1616760000000183015', '14', 'Mobile Quoter-Mobile Quoter', '2020-01-18', '1616760000000071001', 'years', '60', '$', 'Mobile Quoter', '1', '60', NULL, '1616760000000183017', '2019-01-18 15:02:10', '2019-01-18 15:02:10'),
(54, '1616760000000183249', '16', 'Mobile Quoter-Mobile Quoter', '2020-01-18', '1616760000000071001', 'years', '60', '$', 'Mobile Quoter', '1', '60', NULL, '1616760000000183251', '2019-01-18 15:42:37', '2019-01-18 15:42:37'),
(55, '1616760000000183365', '17', 'Mobile Quoter-Mobile Quoter', '2020-01-18', '1616760000000071001', 'years', '60', '$', 'Mobile Quoter', '1', '60', NULL, '1616760000000183367', '2019-01-18 15:48:23', '2019-01-18 15:48:23'),
(56, '1616760000000183490', '18', 'Mobile Quoter-Mobile Quoter', '2020-01-20', '1616760000000071001', 'years', '60', '$', 'Mobile Quoter', '1', '60', NULL, '1616760000000183492', '2019-01-20 08:58:00', '2019-01-20 08:58:00'),
(57, '1616760000000183612', '19', 'Mobile Quoter-Mobile Quoter', '2020-01-20', '1616760000000071001', 'years', '60', '$', 'Mobile Quoter', '1', '60', NULL, '1616760000000183614', '2019-01-20 15:33:52', '2019-01-20 15:33:52'),
(58, '1616760000000183734', '20', 'Mobile Quoter-Mobile Quoter', '2020-01-20', '1616760000000071001', 'years', '60', '$', 'Mobile Quoter', '1', '60', NULL, '1616760000000183736', '2019-01-20 15:42:46', '2019-01-20 15:42:46'),
(59, '1616760000000183734', '22', 'Mobile Quoter-Mobile Quoter', '2020-01-20', '1616760000000071001', 'years', '60', '$', 'Mobile Quoter', '1', '60', NULL, '1616760000000183736', '2019-01-20 15:44:28', '2019-01-20 15:44:28'),
(60, '1616760000000183734', '23', 'Mobile Quoter-Mobile Quoter', '2020-01-20', '1616760000000071001', 'years', '60', '$', 'Mobile Quoter', '1', '60', NULL, '1616760000000183736', '2019-01-20 15:52:46', '2019-01-20 15:52:46'),
(61, '1616760000000183734', '24', 'Mobile Quoter-Mobile Quoter', '2020-01-20', '1616760000000071001', 'years', '60', '$', 'Mobile Quoter', '1', '60', NULL, '1616760000000183736', '2019-01-20 15:56:45', '2019-01-20 15:56:45'),
(62, '1616760000000183734', '25', 'Mobile Quoter-Mobile Quoter', '2020-01-20', '1616760000000071001', 'years', '60', '$', 'Mobile Quoter', '1', '60', NULL, '1616760000000183736', '2019-01-20 15:57:54', '2019-01-20 15:57:54'),
(63, '1616760000000183863', '26', 'Mobile Quoter-Mobile Quoter', '2020-01-21', '1616760000000071001', 'years', '60', '$', 'Mobile Quoter', '1', '60', NULL, '1616760000000183865', '2019-01-21 10:00:19', '2019-01-21 10:00:19'),
(64, '1616760000000183993', '27', 'Mobile Quoter-Mobile Quoter', '2020-01-21', '1616760000000071001', 'years', '60', '$', 'Mobile Quoter', '1', '60', NULL, '1616760000000183995', '2019-01-21 14:01:52', '2019-01-21 14:01:52'),
(65, '1616760000000188011', '28', 'Mobile Quoter-Mobile Quoter', '2020-01-21', '1616760000000071001', 'years', '60', '$', 'Mobile Quoter', '1', '60', NULL, '1616760000000188013', '2019-01-21 17:26:55', '2019-01-21 17:26:55'),
(66, '1616760000000186144', '29', 'Mobile Quoter-Mobile Quoter', '2020-01-21', '1616760000000071001', 'years', '60', '$', 'Mobile Quoter', '1', '60', NULL, '1616760000000186146', '2019-01-22 06:28:31', '2019-01-22 06:28:31'),
(67, '1616760000000193939', '30', 'Mobile Quoter-Mobile Quoter', '2020-01-22', '1616760000000071001', 'years', '60', '$', 'Mobile Quoter', '1', '60', NULL, '1616760000000193941', '2019-01-22 09:32:38', '2019-01-22 09:32:38'),
(68, '1616760000000200174', '31', 'Mobile Quoter-Mobile Quoter', '2020-01-23', '1616760000000071001', 'years', '60', '$', 'Mobile Quoter', '1', '60', NULL, '1616760000000200176', '2019-01-23 08:40:47', '2019-01-23 08:40:47'),
(69, '1616760000000200412', '32', 'Mobile Quoter-Mobile Quoter', '2020-01-23', '1616760000000071001', 'years', '60', '$', 'Mobile Quoter', '1', '60', NULL, '1616760000000200414', '2019-01-23 10:45:33', '2019-01-23 10:45:33'),
(70, '1616760000000200578', '33', 'Mobile Quoter-Mobile Quoter', '2020-01-23', '1616760000000071001', 'years', '60', '$', 'Mobile Quoter', '1', '60', NULL, '1616760000000200580', '2019-01-23 15:30:38', '2019-01-23 15:30:38'),
(71, '1616760000000200720', '34', 'Mobile Quoter-Mobile Quoter', '2020-01-23', '1616760000000071001', 'years', '60', '$', 'Mobile Quoter', '1', '60', NULL, '1616760000000200722', '2019-01-23 17:21:52', '2019-01-23 17:21:52'),
(72, '1616760000000200864', '35', 'Mobile Quoter-Mobile Quoter', '2020-01-23', '1616760000000071001', 'years', '60', '$', 'Mobile Quoter', '1', '60', NULL, '1616760000000200866', '2019-01-23 17:28:51', '2019-01-23 17:28:51'),
(73, '1616760000000205041', '36', 'Mobile Quoter-Mobile Quoter', '2020-01-23', '1616760000000071001', 'years', '60', '$', 'Mobile Quoter', '1', '60', NULL, '1616760000000205043', '2019-01-23 17:40:01', '2019-01-23 17:40:01'),
(74, '1616760000000205185', '37', 'Mobile Quoter-Mobile Quoter', '2020-01-23', '1616760000000071001', 'years', '60', '$', 'Mobile Quoter', '1', '60', NULL, '1616760000000205187', '2019-01-23 17:51:43', '2019-01-23 17:51:43'),
(75, '1616760000000205329', '38', 'Mobile Quoter-Mobile Quoter', '2020-01-23', '1616760000000071001', 'years', '60', '$', 'Mobile Quoter', '1', '60', NULL, '1616760000000205331', '2019-01-23 18:05:45', '2019-01-23 18:05:45'),
(76, '1616760000000207011', '39', 'Mobile Quoter-Mobile Quoter', '2020-01-24', '1616760000000071001', 'years', '60', '$', 'Mobile Quoter', '1', '60', NULL, '1616760000000207013', '2019-01-24 10:50:30', '2019-01-24 10:50:30'),
(77, '1616760000000207214', '40', 'Mobile Quoter-Mobile Quoter', '2020-01-24', '1616760000000071001', 'years', '60', '$', 'Mobile Quoter', '1', '60', NULL, '1616760000000207216', '2019-01-24 11:34:34', '2019-01-24 11:34:34'),
(78, '1616760000000211062', '41', 'Mobile Quoter-Mobile Quoter', '2020-01-25', '1616760000000071001', 'years', '60', '$', 'Mobile Quoter', '1', '60', NULL, '1616760000000211064', '2019-01-25 10:10:44', '2019-01-25 10:10:44'),
(79, '1616760000000215258', '42', 'Mobile Quoter-Mobile Quoter', '2020-01-25', '1616760000000071001', 'years', '60', '$', 'Mobile Quoter', '1', '60', NULL, '1616760000000215260', '2019-01-25 15:47:57', '2019-01-25 15:47:57'),
(80, '1616760000000215534', '43', 'Mobile Quoter-Mobile Quoter', '2020-01-25', '1616760000000071001', 'years', '60', '$', 'Mobile Quoter', '1', '60', NULL, '1616760000000215536', '2019-01-25 16:31:14', '2019-01-25 16:31:14'),
(81, '1616760000000215755', '44', 'Mobile Quoter-Mobile Quoter', '2020-01-25', '1616760000000071001', 'years', '60', '$', 'Mobile Quoter', '1', '60', NULL, '1616760000000215757', '2019-01-25 16:45:12', '2019-01-25 16:45:12'),
(82, '1616760000000215877', '45', 'Mobile Quoter-Mobile Quoter', '2020-01-25', '1616760000000071001', 'years', '60', '$', 'Mobile Quoter', '1', '60', NULL, '1616760000000215879', '2019-01-25 16:48:10', '2019-01-25 16:48:10'),
(83, '1616760000000219159', '46', 'Mobile Quoter-Mobile Quoter', '2020-01-25', '1616760000000071001', 'years', '60', '$', 'Mobile Quoter', '1', '60', NULL, '1616760000000219161', '2019-01-25 17:31:51', '2019-01-25 17:31:51'),
(84, '1612310000000138013', '47', 'Mobile Quoter-Mobile Quoter', '2020-01-25', '1612310000000125083', 'years', '60', '$', 'Mobile Quoter', '1', '60', NULL, '1612310000000138015', '2019-01-25 18:00:17', '2019-01-25 18:00:17'),
(85, '1612310000000158019', '49', 'Mobile Quoter-Mobile Quoter', '2020-02-18', '1612310000000125083', 'years', '60', '$', 'Mobile Quoter', '', '60', NULL, '1612310000000163026', '2019-02-18 15:08:31', '2019-02-18 15:08:31'),
(86, '1612310000000161170', '50', 'Mobile Quoter-Mobile Quoter', '2020-02-18', '1612310000000125083', 'years', '60', '$', 'Mobile Quoter', '', '60', NULL, '1612310000000163013', '2019-02-18 15:14:17', '2019-02-18 15:14:17'),
(87, '1612310000000161251', '51', 'Mobile Quoter-Mobile Quoter', '2020-02-18', '1612310000000125083', 'years', '60', '$', 'Mobile Quoter', '', '60', NULL, '1612310000000162964', '2019-02-18 15:31:39', '2019-02-18 15:31:39'),
(88, '1612310000000161344', '53', 'Mobile Quoter-Mobile Quoter', '2020-02-18', '1612310000000125083', 'years', '60', '$', 'Mobile Quoter', '', '60', NULL, '1612310000000162951', '2019-02-18 16:53:06', '2019-02-18 16:53:06'),
(89, '1612310000000161478', '54', 'Mobile Quoter-Mobile Quoter', '2020-02-18', '1612310000000125083', 'years', '60', '$', 'Mobile Quoter', '', '60', NULL, '1612310000000162925', '2019-02-18 17:08:21', '2019-02-18 17:08:21'),
(90, '1612310000000161545', '55', 'Mobile Quoter-Mobile Quoter', '2020-02-18', '1612310000000125083', 'years', '60', '$', 'Mobile Quoter', '', '60', NULL, '1612310000000162912', '2019-02-18 17:09:44', '2019-02-18 17:09:44'),
(91, '1612310000000161610', '56', 'Mobile Quoter-Mobile Quoter', '2020-02-18', '1612310000000125083', 'years', '60', '$', 'Mobile Quoter', '', '60', NULL, '1612310000000162899', '2019-02-18 17:09:52', '2019-02-18 17:09:52'),
(92, '1612310000000161677', '57', 'Mobile Quoter-Mobile Quoter', '2020-02-18', '1612310000000125083', 'years', '60', '$', 'Mobile Quoter', '', '60', NULL, '1612310000000162886', '2019-02-18 17:10:14', '2019-02-18 17:10:14'),
(93, '1612310000000161746', '58', 'Mobile Quoter-Mobile Quoter', '2019-06-06', '1612310000000125083', 'years', '60', '$', 'Mobile Quoter', '', '60', NULL, '1612310000000162873', '2019-02-18 17:15:52', '2019-02-18 17:15:52'),
(94, '1612310000000161776', '59', 'Mobile Quoter-Mobile Quoter', '2019-05-01', '1612310000000125083', 'years', '60', '$', 'Mobile Quoter', '', '60', NULL, '1612310000000162860', '2019-02-18 17:28:48', '2019-02-18 17:28:48'),
(95, '1612310000000161804', '60', 'Mobile Quoter-Mobile Quoter', '2020-01-08', '1612310000000125083', 'years', '60', '$', 'Mobile Quoter', '', '60', NULL, '1612310000000162847', '2019-02-18 17:29:01', '2019-02-18 17:29:01'),
(96, '1612310000000167363', '69', 'Mobile Quoter-Mobile Quoter', '2019-10-31', '1612310000000125083', 'years', '60', '$', 'Mobile Quoter', '', '60', NULL, '1612310000000162834', '2019-02-18 18:07:39', '2019-02-18 18:07:39'),
(97, '1612310000000167424', '70', 'Mobile Quoter-Mobile Quoter', '2019-06-19', '1612310000000125083', 'years', '60', '$', 'Mobile Quoter', '', '60', NULL, '1612310000000162821', '2019-02-18 18:09:12', '2019-02-18 18:09:12'),
(98, '1612310000000167485', '72', 'Mobile Quoter-Mobile Quoter', '2019-10-26', '1612310000000125083', 'years', '60', '$', 'Mobile Quoter', '', '60', NULL, '1612310000000162808', '2019-02-18 18:10:13', '2019-02-18 18:10:13'),
(99, '1612310000000167546', '73', 'Mobile Quoter-Mobile Quoter', '2019-08-09', '1612310000000125083', 'years', '60', '$', 'Mobile Quoter', '', '60', NULL, '1612310000000162795', '2019-02-18 18:11:46', '2019-02-18 18:11:46'),
(100, '1612310000000167607', '74', 'Mobile Quoter-Mobile Quoter', '2019-07-21', '1612310000000125083', 'years', '60', '$', 'Mobile Quoter', '', '60', NULL, '1612310000000162782', '2019-02-18 18:12:56', '2019-02-18 18:12:56'),
(101, '1612310000000167717', '75', 'Mobile Quoter-Mobile Quoter', '2019-05-01', '1612310000000125083', 'years', '60', '$', 'Mobile Quoter', '', '60', NULL, '1612310000000162756', '2019-02-18 18:15:26', '2019-02-18 18:15:26'),
(102, '1612310000000167778', '76', 'Mobile Quoter-Mobile Quoter', '2019-12-20', '1612310000000125083', 'years', '60', '$', 'Mobile Quoter', '', '60', NULL, '1612310000000162743', '2019-02-18 18:17:32', '2019-02-18 18:17:32'),
(103, '1612310000000167839', '77', 'Mobile Quoter-Mobile Quoter', '2019-09-24', '1612310000000125083', 'years', '60', '$', 'Mobile Quoter', '', '60', NULL, '1612310000000162730', '2019-02-18 18:18:48', '2019-02-18 18:18:48'),
(104, '1612310000000167900', '78', 'Mobile Quoter-Mobile Quoter', '2019-06-15', '1612310000000125083', 'years', '60', '$', 'Mobile Quoter', '', '60', NULL, '1612310000000162717', '2019-02-18 18:22:39', '2019-02-18 18:22:39'),
(105, '1612310000000167961', '79', 'Mobile Quoter-Mobile Quoter', '2019-12-29', '1612310000000125083', 'years', '60', '$', 'Mobile Quoter', '', '60', NULL, '1612310000000162704', '2019-02-18 18:22:45', '2019-02-18 18:22:45'),
(106, '1612310000000168020', '80', 'Mobile Quoter-Mobile Quoter', '2019-05-01', '1612310000000125083', 'years', '60', '$', 'Mobile Quoter', '', '60', NULL, '1612310000000162691', '2019-02-18 18:22:52', '2019-02-18 18:22:52'),
(107, '1612310000000168081', '81', 'Mobile Quoter-Mobile Quoter', '2019-12-06', '1612310000000125083', 'years', '60', '$', 'Mobile Quoter', '', '60', NULL, '1612310000000162678', '2019-02-18 18:23:26', '2019-02-18 18:23:26'),
(108, '1612310000000179011', '125', 'Mobile Quoter-Mobile Quoter', '2020-02-19', '1612310000000125083', 'years', '60', '$', 'Mobile Quoter', '1', '60', NULL, '1612310000000179013', '2019-02-20 00:59:55', '2019-02-20 00:59:55'),
(109, '1612310000000188011', '126', 'Mobile Quoter-Mobile Quoter', '2020-02-22', '1612310000000125083', 'years', '60', '$', 'Mobile Quoter', '1', '60', NULL, '1612310000000188013', '2019-02-23 06:03:46', '2019-02-23 06:03:46'),
(110, '1612310000000192011', '127', 'Mobile Quoter-Mobile Quoter', '2020-02-27', '1612310000000125083', 'years', '60', '$', 'Mobile Quoter', '1', '60', NULL, '1612310000000192013', '2019-02-27 19:31:50', '2019-02-27 19:31:50'),
(111, '1612310000000200011', '128', 'Mobile Quoter-Mobile Quoter', '2020-03-04', '1612310000000125083', 'years', '60', '$', 'Mobile Quoter', '1', '60', NULL, '1612310000000200013', '2019-03-04 16:28:55', '2019-03-04 16:28:55'),
(112, '1612310000000214013', '129', 'Mobile Quoter-Mobile Quoter', '2020-03-15', '1612310000000125083', 'years', '60', '$', 'Mobile Quoter', '1', '60', NULL, '1612310000000214015', '2019-03-15 14:12:23', '2019-03-15 14:12:23');

-- --------------------------------------------------------

--
-- Table structure for table `support_videos`
--

CREATE TABLE `support_videos` (
  `id` int(10) UNSIGNED NOT NULL,
  `caption` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preferred` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `support_videos`
--

INSERT INTO `support_videos` (`id`, `caption`, `url`, `image`, `preferred`, `created_at`, `updated_at`) VALUES
(1, 'General Setup', 'https://player.vimeo.com/video/317978590', 'https://i.vimeocdn.com/video/760316423.webp?mw=800&mh=600', 1, '2019-02-21 17:00:00', '2019-02-21 17:00:00'),
(2, 'Product Input', 'https://player.vimeo.com/video/317978934', 'https://i.vimeocdn.com/video/760316274.webp?mw=900&mh=600', 1, '2019-02-21 17:00:00', '2019-02-21 17:00:00'),
(3, 'FE', 'https://player.vimeo.com/video/317984214', 'https://i.vimeocdn.com/video/760316115.webp?mw=900&mh=600', 1, '2019-02-21 17:00:00', '2019-02-21 17:00:00'),
(4, 'SI Term', 'https://player.vimeo.com/video/317978934', 'https://i.vimeocdn.com/video/760315980.webp?mw=900&mh=600', 1, '2019-02-21 17:00:00', '2019-02-21 17:00:00'),
(5, 'Term Life', 'https://player.vimeo.com/video/317986659', 'https://i.vimeocdn.com/video/760315833.webp?mw=900&mh=600', 1, '2019-02-21 17:00:00', '2019-02-21 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `theme_user`
--

CREATE TABLE `theme_user` (
  `user_id` int(11) NOT NULL,
  `theme_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `theme_user`
--

INSERT INTO `theme_user` (`user_id`, `theme_id`) VALUES
(1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_id` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_zone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `profile_id`, `remember_token`, `created_at`, `updated_at`, `fname`, `lname`, `time_zone`) VALUES
(3, 'Demo One', 'demo1@example.com', '$2y$10$ayDCstqXDbTeRCK2wWanjuMbAM1iNN8.PjxQbLwLvEdsgrA3vT5I6', 3, 'JDS3qAsTtKsTGPNwmdZ3qVcgp3hTEBRW52zOvjzL8DxQ3WxS9BHMi0XGR91C', '2018-11-28 09:46:09', '2018-11-28 09:46:09', 'Demo', 'One', NULL),
(4, 'Demo Two', 'demo2@example.com', '$2y$10$S0Yn11X4RR0N.I8MYAV03uNV3oZbZF6WZB5Tg/SHFts5qG1NOwAnG', 4, 'PM1mLHZ0V6n0l37gJ7zmI20NDwRcigvkzEALbTmx0WTSJk1fAWusiCImfJYC', '2018-11-28 09:46:53', '2018-11-28 09:46:53', 'Demo', 'Two', NULL),
(5, 'Demo Three', 'demo3@example.com', '$2y$10$GKoXHpbOGs74bSndYOZ3y.ZcQjmhYy2Wpv.A/KKCi.hCGTt3vDTz.', 5, 'Fqvaw7wDKRG1kPqNLHvmFfhiqrhyWcDOayAWtiBcsvdgzT9egS291V7U3G5I', '2018-11-28 09:47:32', '2018-11-28 09:47:32', 'Demo', 'Three', NULL),
(6, 'Patrick Pegram', 'ppegram@legacyagent.com ', '$2y$10$tmw6QhyhE2hXO4xL9apuK.XUp6PY6X2aA.9cSrJuI4jwqD34niArW', 6, 'QfVowd8YgTR63dmSgZcpXg7La8uSnSKazkFYmbo0dFyQFXKuFRrUhApSDzqB', '2018-11-28 09:49:01', '2019-02-08 06:35:19', 'Patrick', 'Pegram', NULL),
(7, 'Test', 'mhrynewich@legacyagent.com', '$2y$10$fFxTXynaS/HEXEtUoyIbqe0ox26lRGrveKyymXkaP/DztS6f.SKLC', 7, '3N8WwE19HVFMyfj1uSKxuDrshAowhSSY8v3HUx0BBQFPM5RV84K1ul7jGPAf', '2018-11-28 09:50:00', '2019-02-22 18:09:01', 'Michael', 'Hrynewich', NULL),
(8, 'Tony Sarlese', 'tsarlese@agentquote.com ', '$2y$10$.UESFz5YIJeC9lQtGtE59.DDsbAdyx/nBpFM5wg4O4uDeJW.MhPhW', 8, 'IRRzYtWa95RKVrfS2Jcg4ioWoyk20A1G11if9KhqaPF3Pvt5OuYRxe6xeIvj', '2018-11-28 09:50:45', '2018-11-28 09:50:45', 'Tony', 'Sarlese', NULL),
(25, 'Test2 Two', 'delanosan@gmail.com', '$2y$10$XyQWNrLA.esTSKgeEJTL1eA2PewK0hd8B1w20e9/um2QZma9t10HW', 22, 'IFVj8Atp1x2GliaGg3v1GaDF8VsslNhqN7tOJJrLSwrtzRTIhnoZ6AiVkuYP', '2019-01-20 15:57:54', '2019-01-20 15:57:54', 'Test2', 'Two', NULL),
(26, 'Test2 Two', 'delanosan_fd3@gmail.com', '$2y$10$BEaRnhrz39dDwC9CjOTrweUFyWXnXEh9hxRdYAieCi6Xc5oPNChjq', 23, 'Q7OqVj3lVkuhKc5TmsIkUnnMPM93ZQPuGqjlm67wKm34TN5vfqheZKV3dJiB', '2019-01-21 10:00:19', '2019-01-21 10:00:19', 'Test2', 'Two', NULL),
(27, 'Test2 Two', 'delanosan_dddddd@gmail.com', '$2y$10$gESi11dP4tNGoFFwqqiEEe7ZlSbUNYiFaE66Z.E/D3T1mzlEXYEwy', 24, '5NQLMOdwGMHDQzALHlHkuySh4qck1ZotcqP5F9mRqZLPvuVABNCckpwfN6Ez', '2019-01-21 14:01:52', '2019-01-21 14:01:52', 'Test2', 'Two', NULL),
(28, 'Tony Sarlese', 'tsarlese@gmail.com', '$2y$10$kdra9NugQlNTW99OPpyqzOBmPDYSksV/5YZrqJErCx/GP.4TAKd2a', 25, 'VS8ygzRFvZlHhWCeVXYSIv6dBxuqXDQKfHocpjdte9XE40NLgiwjn503cKsc', '2019-01-21 17:26:55', '2019-01-21 17:26:55', 'Tony', 'Sarlese', NULL),
(29, 'Frank D', 'delanosan_zoho@gmail.com', '$2y$10$ijYXBPbfP9efclODAtPa6urrkPR3Dv.Z9bQ1kqp46unkYQ3np9cj6', 26, '4nPZyiGcfSPkHJXLpAbkbziS73QHK8p0eYMjlBt4VoC4O4Su9upORbHjiPEo', '2019-01-22 06:28:31', '2019-01-22 06:28:31', 'Frank', 'D', NULL),
(30, 'Tester Oner', 'delanosan_test_1@gmail.com', '$2y$10$DoS77jOAkPcrcKrsRvAQxuwDrpOOxRNj3aV2nysZJtUxFklxAdLi.', 27, 'GCF4BroLrK1NuVRfk1yKWJ8G3C7hyXo2KaNCSbWhHS8TkUJWZlCj5X9cG4zL', '2019-01-22 09:32:38', '2019-01-22 09:32:38', 'Tester', 'Oner', NULL),
(31, 'Frank Decker3', 'microsite@mailinator.com', '$2y$10$42QbHTW1DhVV66J.FvNNMeOAG0xgcb0J41pOIcioXoM.lRd6Fmyau', 28, 'NnVq7KiVL8KvWo4HBdrT2Ad4knFek5cEXaVC0mHMKEeW93EwsCU4QU1FP6JE', '2019-01-23 08:40:47', '2019-01-23 08:40:47', 'Frank', 'Decker3', NULL),
(32, 'Franklin Decker', 'delanosan_test_22@gmail.com', '$2y$10$MOCiKY8zSV9WHyEsaw/37ugqxKKzHh3Z/JEXtHB0LRvdNPIvNhpHO', 29, 'dfHGsjkZSSTYvQEnBREHbhozBihFZqYZbIymzoErbwfCgysLV59cZzsNcEMi', '2019-01-23 10:45:33', '2019-01-23 10:45:33', 'Franklin', 'Decker', NULL),
(33, 'Franklin Decker', 'withpatrick@mailinator.com', '$2y$10$XwD1JwH3.VhuJ1oyqYxF1uX.H2ihqXJso1grEq1pGEroVtLASFXN6', 30, 'PTBhxKrvH96oSd1ht2WYrCQOZNthVzKZyn8bVDuKqAFrhVkM35ttanwjfjca', '2019-01-23 15:30:38', '2019-01-23 15:30:38', 'Franklin', 'Decker', NULL),
(44, 'Franklin Deckerer', 'fdeckerer@mailinator.com', '$2y$10$EkliaPnSK3R6Sq7BJ3q5RuNvIxdB5dtjMNB4i8HJCH682Nq6x3y3u', 41, 'PMLhRaJp5HYJcVdByn5N7R5wGfgQMemlJb0oA7DM0Q5Oyx6QorAskTr8APMW', '2019-01-25 16:45:12', '2019-01-25 16:45:12', 'Franklin', 'Deckerer', NULL),
(45, 'Franklin Deckers', 'fdeckers@mailinator.com', '$2y$10$/LCHluKE5UCKRjrF5cc8J./SJVYfPuBT7vxVWMoxE.DEsW2Ga2iyK', 42, 'ZW3Ll8elBtCLvddllKyQHQcMhXy5EjD9ZLvsjiO7pBgkKrefHIVa7kU1cXry', '2019-01-25 16:48:10', '2019-01-25 16:48:10', 'Franklin', 'Deckers', NULL),
(46, 'First Paypal', 'firstpaypal@mailinator.com', '$2y$10$O6J7hNkkhoK7tRLtEb12POICdbVQY0308RS4WHXgIF9Bp9ZAYYuji', 43, 'FLIgfw9yYVgBQIKQiCLMsp6RsDQtm3NwC2gFiUe51IscbO1JbxR5vTO3xKyp', '2019-01-25 17:31:51', '2019-01-25 17:31:51', 'First', 'Paypal', NULL),
(47, 'Patrick Pegram', 'billing@agentquoter.com', '$2y$10$T.QCG9btrT303PrMimAAwO6DKMG5WT5FNHkhc/F.XSwAnt.nQ67Ym', 44, 'WduxDVNtFGy7PaKrJEpfTbun0NbkZLk6tHzAg41CsjjCQiYzI7pBwmRAAZ16', '2019-01-25 18:00:17', '2019-01-25 18:00:17', 'Patrick', 'Pegram', NULL),
(49, 'Timothy Walko', 'twalko@legacysecure.com', '$2y$10$BoDlvJs8hbnYsb/TY97ap.qWVtLTRgQy82TzX7mZIry/u1PzQG9cW', 45, 'VBhbsAJoClyiEaRG4ePE8p2YxlEz8ypTsZrlKsDcZMcYxY0uqosa8H9hLjqc', '2019-02-18 15:08:31', '2019-02-18 20:07:08', 'Timothy', 'Walko', NULL),
(50, 'David Stubbs', 'ucanbeinsured@gmail.com', '$2y$10$Pne6wJumx.LB4MrVeWOVj.PYNInZzt6GujCreeMRqg7kw4GqxLpfK', 46, 'SzA13nHsm95zq5oElTuVMbbcCgxThAGIVvArPJISdCk6OipWSIY4drahaYPs', '2019-02-18 15:14:17', '2019-02-18 15:14:17', 'David', 'Stubbs', NULL),
(51, 'Tye', 'tyewest1@gmail.com', '$2y$10$gVF/jutNqX.UNCyrYmZ.OuvHJPFoNC.ifJaaMaLXHO36KeY0.Ojrm', 47, 'NKCZMDHidDp5sjMnniahonekpvQapREXXy3NcFCy9YVleDmEWeEX7KBPBJH9', '2019-02-18 15:31:39', '2019-02-18 15:31:39', 'Tye', 'West', NULL),
(53, 'Danielle', 'Rogersbenefits@gmail.com', '$2y$10$Jn7PL9r4EuKuklGln2WJw.3dAhxZENClGifmHVmpaXVUzIScKLqwC', 48, NULL, '2019-02-18 16:53:06', '2019-02-18 16:53:06', 'Danielle', 'Rogers', NULL),
(54, 'Christopher McCall', 'christopher@sammybean.com', '$2y$10$5JnW2UOl9u2/2AiBE1TWSeNCLvFMyI.j8aLKBIMzsFatF/2ai9.H2', 49, NULL, '2019-02-18 17:08:21', '2019-02-18 17:08:21', 'Christopher', 'McCall', NULL),
(55, 'Roxie Govea-Welsh', 'roxiewelsh@gmail.com', '$2y$10$dySh2CQqX6JdQBL.DJgEWeNLzYIb96UDYBwCgKK1RA3V5GpLeeqR.', 50, NULL, '2019-02-18 17:09:44', '2019-02-18 17:09:44', 'Roxie', 'Govea-Welsh', NULL),
(56, 'Robert Gersten', 'rbgersten01@gmail.com', '$2y$10$kajEHK8M4n4rqQUcBTHv6Oke5gNn8PbvpNKX656mKjzLa6byCuVxC', 51, NULL, '2019-02-18 17:09:52', '2019-02-18 17:09:52', 'Robert', 'Gersten', NULL),
(57, 'Larry Booksh', 'larry@larrybooksh.com', '$2y$10$jU4U69cDpT0ii7zhHuZE2.lTbxO6KRnx2aSF.tScyxHBX0noxjhje', 52, 'GNb1VLW532slvECV8suxgmrQ7EyPQfmTOUcbmubDn54H97B6S5yWdWxuy8Ap', '2019-02-18 17:10:14', '2019-02-18 17:10:14', 'Larry', 'Booksh', NULL),
(58, 'Pamela Young', 'unity4895@yahoo.com', '$2y$10$2EZ6rcY0az8qnvdTHFWlmu7HPaSrx6wBFLQLPu9ir9Ga1lsoekdRW', 53, 'jJsbTpITIn4J0gZ1BonSY9iiifKaUbPIK0atkhSzDp5qlHE6mEAIxrTDLqOu', '2019-02-18 17:15:52', '2019-02-18 17:15:52', 'Pamela', 'Young', NULL),
(59, 'Eric Williams', 'eric@EmpowermentRS.com', '$2y$10$wFoA.EDUuJzDK29pdu9deudf.DPFlgFIAbRE.qTirG1ca2ygki7ny', 54, NULL, '2019-02-18 17:28:48', '2019-02-18 17:28:48', 'Eric', 'Williams', NULL),
(60, 'Floyd West', 'Fwlegacy2@gmail.com', '$2y$10$hq0414JM3ntz3iT0q3bdqO7UUXDMhXh8tA55AEj.wk5J45.zfr./C', 55, 'rAMV1VMhcOrcF3WJuJfhsfnDqWjnYtgmKjOeKkASygvd5QYpIKQkqywtvrdh', '2019-02-18 17:29:01', '2019-02-18 17:29:01', 'Floyd', 'West', NULL),
(69, 'Rasim Tugberk', 'rstugberk@gmail.com', '$2y$10$hKmZ3./NKZWy5l8FYNj/xe4UvGivCEz91ilbLJZgBKKSOBKvR/v5W', 56, NULL, '2019-02-18 18:07:39', '2019-02-18 18:07:39', 'Rasim', 'Tugberk', NULL),
(70, 'Som Thao', 'sthao2012@gmail.com', '$2y$10$JCdfmfkQ9IR801//CflNc.SJ3OwLSNJH4VNN8fbmZyoEKtusEMJM2', 57, NULL, '2019-02-18 18:09:12', '2019-02-18 18:09:12', 'Som', 'Thao', NULL),
(72, 'Phirut Sao', 'phirutsaoins@gmail.com', '$2y$10$SDnk.xsRup6PcJsLAmRAJ.qb9.KzyEs9C4qZl1tieUd0p01ubwdwa', 58, NULL, '2019-02-18 18:10:13', '2019-02-18 18:10:13', 'Phirut', 'Sao', NULL),
(73, 'Roger Reynolds', 'reynoldsffg@gmail.com', '$2y$10$x9.Wy.hE.8LuRKpYZMd4.eXxeWCKrcW5wfFFsK.oJAgCAtBM9Niyi', 59, 'y1ktRvQ1ewlY0CNYscyKH1tSV5MP9mCr4sjJJSTCZb1jaOFnwttajWPh6uOc', '2019-02-18 18:11:46', '2019-02-18 21:09:12', 'Roger', 'Reynolds', NULL),
(74, 'Tony Palumbo', 'contact.tpalumbo@gmail.com', '$2y$10$kItNsnPBtmbqoXqDQgHPKeKumQAXYyJICMjyeYxSSoYUGFxbdT78q', 60, NULL, '2019-02-18 18:12:56', '2019-02-18 18:12:56', 'Tony', 'Palumbo', NULL),
(75, 'Matt Lake', 'Matthew.lake18@gmail.com', '$2y$10$Ck7/3Ee3lhlIXmc5nt2U/Oh8Ax5iLimjiOzedcS57NqxzXcfugF2O', 61, NULL, '2019-02-18 18:15:26', '2019-02-18 18:15:26', 'Matt', 'Lake', NULL),
(76, 'David Laggan', 'dlaggan@gmail.com', '$2y$10$9wlMNi6h2I7dz3y5I./4MuQ3PecoMp7QvCqjwARHug0yCStRk0CJG', 62, NULL, '2019-02-18 18:17:32', '2019-02-18 18:17:32', 'David', 'Laggan', NULL),
(77, 'William Johnson', 'wjohnson0310@gmail.com', '$2y$10$X631hi3T/pilV/QMP4me/u0mFqPOuTEbWwP5QGLNGOGviOlUWURwG', 63, NULL, '2019-02-18 18:18:48', '2019-02-18 18:18:48', 'William', 'Johnson', NULL),
(78, 'Carl Howington', 'carlh5000@gmail.com', '$2y$10$vm5rYdMOnO2dyIfws1vPgeZOFy7tIUxEaDovpV3j7nRYZE/6nDsiW', 64, 'uOL6DCi2Sd5o1hYPWWq0nIM5BCnCjMQoHNGaPsmtECmOITNGUAFMHfNDYTN8', '2019-02-18 18:22:39', '2019-02-18 21:36:17', 'Carl', 'Howington', NULL),
(79, 'Matthew Harrison', 'mharrison@psfin.com', '$2y$10$Z4uY5h8fHGEBnajUKia0oeVxMI3UilysvV3lE3ffJEl0q21s.0.ny', 65, NULL, '2019-02-18 18:22:45', '2019-02-18 18:22:45', 'Matthew', 'Harrison', NULL),
(80, 'Timothy Casey', 'timothycasey@comcast.net', '$2y$10$n.Gu0XMdqMAqRekHSg9//eR.ZvCtR9UxhCj.eZ46YnbxxO3wtCRCS', 66, NULL, '2019-02-18 18:22:52', '2019-02-18 18:22:52', 'Timothy', 'Casey', NULL),
(81, 'Trae Bowles', 'tbowles0517@gmail.com', '$2y$10$JZluUkIeriNwCONkA9nACexe6qnHnpQkxeqPXxyuAguMVbw15pGMe', 67, NULL, '2019-02-18 18:23:26', '2019-02-18 18:23:26', 'Trae', 'Bowles', NULL),
(125, 'Floyd West', 'fwestii@yahoo.com', '$2y$10$7Pt5nB0LA1rIkeV/jxipyem7VYwblTCNPQAIUl4NW5k0.BxIuGt/.', 68, 'xaVIVEQ2hUNlx6N8T9pzzdzNxewHIqPa8PQBvh3tMQFLiLwZ5MmzYY884STM', '2019-02-20 00:59:55', '2019-02-20 00:59:55', 'Floyd', 'West', NULL),
(126, 'Larry Lerner', 'larrylerner5@gmail.com', '$2y$10$q9BeNQowvmf3K8fVJU.jkeAGSe4C6U2.AIJHSIlPvrEdyIhPhj1/u', 69, 'TR6Fq3WKe2mvqrkootC9VzUw8Uw7C3gf5jn3n4viloNw4T5lvKiJnJfnq8R3', '2019-02-23 06:03:46', '2019-02-23 06:03:46', 'larry', 'lerner', NULL),
(127, 'ANITA PARSONS KING', 'anitaparsonsking@gmail.com', '$2y$10$Cl2fGcOxHDT1qFs/xEdl7.jh.8XMy08lCl8Y5IMjL.S0dODNODXNC', 70, 'cL4EH6vpCG4xgqYU03fm2sHdgku8O9MUyWZ5kE8YmWUGcon9OvGalujNgV8m', '2019-02-27 19:31:50', '2019-02-27 19:31:50', 'ANITA PARSONS', 'KING', NULL),
(128, 'Katherine Clark', 'KATHERINE4INSURANCE@GMAIL.COM', '$2y$10$56m7EnD5cX1MEVfoVYf/Y.as6.suLwNlcrTbdIB26Fr/NwqXwyJFS', 71, 'QcRHyZjswZslhLQH931LYlW8AxwvA1H62h16kc369NhcgugouBK2GOSPeMH4', '2019-03-04 16:28:55', '2019-03-04 16:28:55', 'Katherine', 'Clark', NULL),
(129, 'Randy Catlett', 'rcatlett@adv1brokers.com', '$2y$10$hEkYYvoc2zmZdAw212DpA.Rre86We9TQFv40POARxpf2h1BraJ5fS', 72, 'y1qoo31ws00RwUTenASbKzBTITfXH3UdDUS19YKpwJMJELhgwquU5SApybtE', '2019-03-15 14:12:22', '2019-03-15 14:12:22', 'Randy', 'Catlett', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_quote`
--
ALTER TABLE `account_quote`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `affiliates`
--
ALTER TABLE `affiliates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `affiliate_coupon`
--
ALTER TABLE `affiliate_coupon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `affiliate_types`
--
ALTER TABLE `affiliate_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billing_coupons`
--
ALTER TABLE `billing_coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `card_subscriptions`
--
ALTER TABLE `card_subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carriers`
--
ALTER TABLE `carriers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `company_id` (`company_id`);

--
-- Indexes for table `carriers_categories`
--
ALTER TABLE `carriers_categories`
  ADD UNIQUE KEY `company_id` (`company_id`,`category_id`);

--
-- Indexes for table `carriers_category_users`
--
ALTER TABLE `carriers_category_users`
  ADD UNIQUE KEY `category_id` (`category_id`,`user_id`,`company_id`);

--
-- Indexes for table `carriers_popular`
--
ALTER TABLE `carriers_popular`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `carrier_guides`
--
ALTER TABLE `carrier_guides`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_carrier` (`company_id`),
  ADD KEY `fk_category` (`category_id`);

--
-- Indexes for table `categories_insurance`
--
ALTER TABLE `categories_insurance`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_id` (`category_id`);

--
-- Indexes for table `colors_user`
--
ALTER TABLE `colors_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts_user`
--
ALTER TABLE `contacts_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_user`
--
ALTER TABLE `customer_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features_users`
--
ALTER TABLE `features_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_user`
--
ALTER TABLE `group_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_item_user`
--
ALTER TABLE `invoice_item_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_user`
--
ALTER TABLE `invoice_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leads_user`
--
ALTER TABLE `leads_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages_user`
--
ALTER TABLE `messages_user`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `messages_user` ADD FULLTEXT KEY `fulltext_index` (`name`,`email`,`phone`,`message`);

--
-- Indexes for table `landing-pages`
--
ALTER TABLE `landing-pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otp_users`
--
ALTER TABLE `otp_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `plan_subscriptions`
--
ALTER TABLE `plan_subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile_user`
--
ALTER TABLE `profile_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotes_user`
--
ALTER TABLE `quotes_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD UNIQUE KEY `sessions_id_unique` (`id`);

--
-- Indexes for table `subdomains`
--
ALTER TABLE `subdomains`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription_user`
--
ALTER TABLE `subscription_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_videos`
--
ALTER TABLE `support_videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_quote`
--
ALTER TABLE `account_quote`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `affiliates`
--
ALTER TABLE `affiliates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `affiliate_coupon`
--
ALTER TABLE `affiliate_coupon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `affiliate_types`
--
ALTER TABLE `affiliate_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `billing_coupons`
--
ALTER TABLE `billing_coupons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `card_subscriptions`
--
ALTER TABLE `card_subscriptions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carriers`
--
ALTER TABLE `carriers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `carriers_popular`
--
ALTER TABLE `carriers_popular`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `carrier_guides`
--
ALTER TABLE `carrier_guides`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `colors_user`
--
ALTER TABLE `colors_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contacts_user`
--
ALTER TABLE `contacts_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_user`
--
ALTER TABLE `customer_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `features_users`
--
ALTER TABLE `features_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group_user`
--
ALTER TABLE `group_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_item_user`
--
ALTER TABLE `invoice_item_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `invoice_user`
--
ALTER TABLE `invoice_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `leads_user`
--
ALTER TABLE `leads_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages_user`
--
ALTER TABLE `messages_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `landing-pages`
--
ALTER TABLE `landing-pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1822;

--
-- AUTO_INCREMENT for table `otp_users`
--
ALTER TABLE `otp_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `plan_subscriptions`
--
ALTER TABLE `plan_subscriptions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `profile_user`
--
ALTER TABLE `profile_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `quotes_user`
--
ALTER TABLE `quotes_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `subdomains`
--
ALTER TABLE `subdomains`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscription_user`
--
ALTER TABLE `subscription_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `support_videos`
--
ALTER TABLE `support_videos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carriers_popular`
--
ALTER TABLE `carriers_popular`
  ADD CONSTRAINT `carriers_popular_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `carriers` (`company_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
