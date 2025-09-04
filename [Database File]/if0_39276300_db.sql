-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql211.infinityfree.com
-- Generation Time: Sep 04, 2025 at 04:58 PM
-- Server version: 11.4.7-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_39276300_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `fastest_wins_easy`
--

CREATE TABLE `fastest_wins_easy` (
  `username` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_seconds` int(11) DEFAULT NULL COMMENT 'เวลาเล่นเป็นวินาที',
  `moves_count` int(11) DEFAULT NULL COMMENT 'จำนวนการเดิน',
  `achieved_date` timestamp NULL DEFAULT NULL,
  `ranking` bigint(21) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fastest_wins_extreme`
--

CREATE TABLE `fastest_wins_extreme` (
  `username` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_seconds` int(11) DEFAULT NULL COMMENT 'เวลาเล่นเป็นวินาที',
  `moves_count` int(11) DEFAULT NULL COMMENT 'จำนวนการเดิน',
  `achieved_date` timestamp NULL DEFAULT NULL,
  `ranking` bigint(21) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fastest_wins_hard`
--

CREATE TABLE `fastest_wins_hard` (
  `username` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_seconds` int(11) DEFAULT NULL COMMENT 'เวลาเล่นเป็นวินาที',
  `moves_count` int(11) DEFAULT NULL COMMENT 'จำนวนการเดิน',
  `achieved_date` timestamp NULL DEFAULT NULL,
  `ranking` bigint(21) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fastest_wins_medium`
--

CREATE TABLE `fastest_wins_medium` (
  `username` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_seconds` int(11) DEFAULT NULL COMMENT 'เวลาเล่นเป็นวินาที',
  `moves_count` int(11) DEFAULT NULL COMMENT 'จำนวนการเดิน',
  `achieved_date` timestamp NULL DEFAULT NULL,
  `ranking` bigint(21) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `game_statistics`
--

CREATE TABLE `game_statistics` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `game_mode` enum('ai_easy','ai_medium','ai_hard','ai_extreme') NOT NULL,
  `result` enum('win','lose') NOT NULL,
  `game_duration` int(11) NOT NULL COMMENT 'เวลาเล่นเป็นวินาที',
  `moves_count` int(11) NOT NULL COMMENT 'จำนวนการเดิน',
  `pieces_captured` int(11) DEFAULT 0 COMMENT 'จำนวนหมากที่กินได้',
  `pieces_lost` int(11) DEFAULT 0 COMMENT 'จำนวนหมากที่ถูกกิน',
  `kings_promoted` int(11) DEFAULT 0 COMMENT 'จำนวนหมากที่เลื่อนเป็นกษัตริย์',
  `game_start_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `game_end_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `game_statistics`
--

INSERT INTO `game_statistics` (`id`, `user_id`, `username`, `game_mode`, `result`, `game_duration`, `moves_count`, `pieces_captured`, `pieces_lost`, `kings_promoted`, `game_start_time`, `game_end_time`, `created_at`) VALUES
(59, 1, 'player', 'ai_extreme', 'win', 70, 60, 8, 3, 3, '2025-07-25 09:27:43', '2025-07-25 09:28:53', '2025-07-25 02:28:54'),
(60, 7, 'Thanapiphat', 'ai_extreme', 'lose', 83, 52, 2, 8, 0, '2025-07-25 09:30:46', '2025-07-25 09:32:09', '2025-07-25 02:32:10'),
(61, 9, 'ThanapiphatX', 'ai_extreme', 'win', 35, 33, 8, 2, 1, '2025-07-25 09:40:01', '2025-07-25 09:40:36', '2025-07-25 02:40:36'),
(62, 9, 'ThanapiphatX', 'ai_hard', 'lose', 34, 36, 1, 8, 0, '2025-07-25 09:41:02', '2025-07-25 09:41:37', '2025-07-25 02:41:37'),
(63, 9, 'ThanapiphatX', 'ai_hard', 'win', 40, 42, 8, 2, 0, '2025-07-25 09:41:41', '2025-07-25 09:42:22', '2025-07-25 02:42:22'),
(64, 9, 'ThanapiphatX', 'ai_medium', 'win', 47, 47, 8, 4, 2, '2025-07-25 09:42:31', '2025-07-25 09:43:18', '2025-07-25 02:43:19'),
(65, 9, 'ThanapiphatX', 'ai_easy', 'win', 39, 38, 8, 4, 1, '2025-07-25 09:43:29', '2025-07-25 09:44:08', '2025-07-25 02:44:09'),
(66, 7, 'Thanapiphat', 'ai_extreme', 'lose', 55, 61, 5, 8, 1, '2025-07-25 09:58:07', '2025-07-25 09:59:02', '2025-07-25 02:59:03'),
(67, 12, 'Basnakub2', 'ai_extreme', 'lose', 71, 50, 6, 8, 0, '2025-07-25 12:45:36', '2025-07-25 12:46:48', '2025-07-25 05:46:47'),
(68, 10, 'Bassi', 'ai_extreme', 'win', 47, 40, 8, 5, 1, '2025-07-25 13:18:43', '2025-07-25 13:19:30', '2025-07-25 06:19:31'),
(69, 1, 'player', 'ai_extreme', 'lose', 88, 115, 7, 8, 1, '2025-07-26 09:17:16', '2025-07-26 09:18:45', '2025-07-26 02:18:44'),
(72, 1, 'player', 'ai_extreme', 'lose', 56, 62, 6, 8, 1, '2025-07-27 05:30:49', '2025-07-27 05:31:46', '2025-07-26 22:31:46'),
(74, 9, 'ThanapiphatX', 'ai_extreme', 'lose', 35, 63, 5, 8, 1, '2025-07-29 15:04:42', '2025-07-29 15:05:18', '2025-07-29 08:05:19'),
(78, 1, 'player', 'ai_easy', 'win', 95, 47, 8, 4, 2, '2025-08-01 09:53:26', '2025-08-01 09:55:01', '2025-08-01 02:55:01'),
(79, 1, 'player', 'ai_medium', 'lose', 148, 128, 7, 8, 2, '2025-08-01 09:55:32', '2025-08-01 09:58:00', '2025-08-01 02:58:00'),
(82, 9, 'ThanapiphatX', 'ai_extreme', 'lose', 55, 50, 5, 8, 0, '2025-08-05 13:03:35', '2025-08-05 13:04:30', '2025-08-05 06:04:30'),
(83, 10, 'Bassi', 'ai_extreme', 'lose', 55, 48, 6, 8, 1, '2025-08-07 22:37:17', '2025-08-07 22:38:13', '2025-08-07 15:38:13'),
(85, 1, 'player', 'ai_medium', 'win', 69, 50, 5, 3, 2, '2025-08-08 09:35:27', '2025-08-08 09:36:37', '2025-08-08 02:36:38'),
(86, 1, 'player', 'ai_medium', 'lose', 56, 34, 0, 7, 0, '2025-08-08 10:02:48', '2025-08-08 10:03:44', '2025-08-08 03:03:46'),
(87, 1, 'player', 'ai_hard', 'win', 80, 59, 8, 3, 2, '2025-08-08 10:06:21', '2025-08-08 10:07:41', '2025-08-08 03:07:42'),
(89, 1, 'player', 'ai_medium', 'lose', 189, 63, 2, 8, 1, '2025-08-08 10:11:27', '2025-08-08 10:14:37', '2025-08-08 03:14:38'),
(92, 9, 'ThanapiphatX', 'ai_extreme', 'lose', 50, 52, 5, 8, 1, '2025-08-08 11:07:04', '2025-08-08 11:07:54', '2025-08-08 04:07:54'),
(100, 15, 'A1234', 'ai_easy', 'win', 59, 42, 8, 2, 2, '2025-08-22 09:47:16', '2025-08-22 09:48:16', '2025-08-22 02:48:16'),
(101, 15, 'A1234', 'ai_medium', 'win', 140, 67, 8, 5, 3, '2025-08-22 09:50:52', '2025-08-22 09:53:13', '2025-08-22 02:53:14'),
(102, 17, 'kuy', 'ai_easy', 'win', 33, 37, 8, 2, 2, '2025-08-22 11:04:59', '2025-08-22 11:05:33', '2025-08-22 04:05:34'),
(103, 18, 'Pause', 'ai_extreme', 'win', 79, 49, 8, 2, 2, '2025-08-22 14:13:04', '2025-08-22 14:14:24', '2025-08-22 07:14:25'),
(104, 10, 'Bassi', 'ai_extreme', 'lose', 66, 64, 3, 8, 1, '2025-08-29 09:08:19', '2025-08-29 09:09:26', '2025-08-29 02:09:26'),
(110, 19, 'Kao', 'ai_extreme', 'win', 90, 35, 8, 2, 1, '2025-09-03 14:47:58', '2025-09-03 14:49:29', '2025-09-03 07:49:31'),
(114, 20, 'lll099', 'ai_extreme', 'win', 92, 36, 7, 2, 1, '2025-09-03 14:54:02', '2025-09-03 14:55:35', '2025-09-03 07:55:38'),
(117, 21, 'Aum1', 'ai_extreme', 'win', 78, 62, 8, 5, 3, '2025-09-03 14:59:59', '2025-09-03 15:01:17', '2025-09-03 08:01:17'),
(118, 1, 'player', 'ai_extreme', 'lose', 515, 57, 7, 8, 1, '2025-09-03 15:02:35', '2025-09-03 15:11:11', '2025-09-03 08:11:13'),
(119, 1, 'player', 'ai_extreme', 'lose', 141, 37, 3, 7, 0, '2025-09-03 15:11:19', '2025-09-03 15:13:40', '2025-09-03 08:13:42'),
(129, 23, 'miloKingHacker', 'ai_extreme', 'lose', 350, 73, 6, 8, 2, '2025-09-03 15:35:38', '2025-09-03 15:41:28', '2025-09-03 08:41:28'),
(130, 19, 'Kao', 'ai_hard', 'win', 40, 56, 7, 4, 1, '2025-09-03 15:41:56', '2025-09-03 15:42:37', '2025-09-03 08:42:38'),
(133, 1, 'player', 'ai_medium', 'lose', 69, 46, 1, 8, 1, '2025-09-03 15:55:26', '2025-09-03 15:56:35', '2025-09-03 08:56:36'),
(134, 1, 'player', 'ai_medium', 'lose', 188, 92, 5, 8, 4, '2025-09-03 15:53:39', '2025-09-03 15:56:47', '2025-09-03 08:56:48'),
(140, 1, 'player', 'ai_hard', 'lose', 73, 40, 1, 8, 0, '2025-09-03 15:57:35', '2025-09-03 15:58:48', '2025-09-03 08:58:49'),
(141, 27, 'seonpung_le', 'ai_medium', 'win', 98, 37, 8, 3, 1, '2025-09-03 15:57:54', '2025-09-03 15:59:33', '2025-09-03 08:59:34'),
(142, 29, 'dekdee', 'ai_easy', 'win', 93, 38, 8, 1, 2, '2025-09-03 15:58:34', '2025-09-03 16:00:08', '2025-09-03 09:00:09'),
(144, 30, 'PPlnwza007', 'ai_hard', 'win', 106, 85, 8, 6, 4, '2025-09-03 15:59:22', '2025-09-03 16:01:09', '2025-09-03 09:01:10'),
(145, 28, 'earthmzn', 'ai_easy', 'win', 159, 68, 8, 5, 2, '2025-09-03 15:58:36', '2025-09-03 16:01:15', '2025-09-03 09:01:17'),
(149, 30, 'PPlnwza007', 'ai_extreme', 'win', 29, 40, 8, 1, 2, '2025-09-03 16:02:17', '2025-09-03 16:02:46', '2025-09-03 09:02:47'),
(150, 29, 'dekdee', 'ai_extreme', 'lose', 86, 42, 2, 8, 0, '2025-09-03 16:01:33', '2025-09-03 16:02:59', '2025-09-03 09:03:00'),
(156, 31, 'Mmm', 'ai_medium', 'lose', 318, 157, 7, 8, 3, '2025-09-03 16:01:59', '2025-09-03 16:07:17', '2025-09-03 09:07:17'),
(157, 1, 'player', 'ai_hard', 'lose', 161, 54, 4, 8, 1, '2025-09-03 16:04:45', '2025-09-03 16:07:27', '2025-09-03 09:07:28'),
(158, 1, 'player', 'ai_extreme', 'lose', 119, 57, 5, 8, 1, '2025-09-03 16:05:39', '2025-09-03 16:07:38', '2025-09-03 09:07:39'),
(159, 1, 'player', 'ai_easy', 'lose', 70, 38, 3, 7, 0, '2025-09-03 16:07:37', '2025-09-03 16:08:47', '2025-09-03 09:07:57'),
(161, 1, 'player', 'ai_extreme', 'lose', 54, 50, 4, 8, 1, '2025-09-03 16:07:41', '2025-09-03 16:08:36', '2025-09-03 09:08:36'),
(163, 1, 'player', 'ai_medium', 'lose', 191, 90, 2, 8, 3, '2025-09-03 16:05:56', '2025-09-03 16:09:08', '2025-09-03 09:09:10'),
(166, 34, 'Tunggg', 'ai_easy', 'win', 89, 42, 8, 1, 2, '2025-09-03 16:08:28', '2025-09-03 16:09:58', '2025-09-03 09:10:00'),
(167, 37, 'Khanathip_54', 'ai_easy', 'win', 84, 46, 8, 2, 2, '2025-09-03 16:08:38', '2025-09-03 16:10:02', '2025-09-03 09:10:04'),
(170, 1, 'player', 'ai_extreme', 'lose', 61, 42, 2, 8, 0, '2025-09-03 16:09:20', '2025-09-03 16:10:22', '2025-09-03 09:10:23'),
(171, 1, 'player', 'ai_extreme', 'lose', 120, 137, 6, 8, 3, '2025-09-03 16:08:42', '2025-09-03 16:10:42', '2025-09-03 09:10:43'),
(178, 35, 'mahiru', 'ai_extreme', 'win', 175, 42, 8, 4, 2, '2025-09-03 16:10:00', '2025-09-03 16:12:56', '2025-09-03 09:12:57'),
(179, 1, 'player', 'ai_medium', 'lose', 87, 56, 3, 8, 1, '2025-09-03 16:11:36', '2025-09-03 16:13:04', '2025-09-03 09:13:08');

-- --------------------------------------------------------

--
-- Table structure for table `leaderboards`
--

CREATE TABLE `leaderboards` (
  `id` int(11) NOT NULL,
  `leaderboard_type` enum('fastest_win_easy','fastest_win_medium','fastest_win_hard','fastest_win_extreme','most_wins_easy','most_wins_medium','most_wins_hard','most_wins_extreme') NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `score` int(11) NOT NULL COMMENT 'วินาที (fastest) หรือ จำนวนชนะ (most_wins)',
  `moves_count` int(11) DEFAULT NULL COMMENT 'จำนวนการเดิน (สำหรับ fastest)',
  `game_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leaderboards`
--

INSERT INTO `leaderboards` (`id`, `leaderboard_type`, `user_id`, `username`, `score`, `moves_count`, `game_date`) VALUES
(33, 'fastest_win_extreme', 1, 'player', 70, 60, '2025-07-25 09:28:53'),
(34, 'most_wins_extreme', 1, 'player', 1, NULL, '2025-07-25 09:28:53'),
(35, 'fastest_win_extreme', 9, 'ThanapiphatX', 35, 33, '2025-07-25 09:40:36'),
(36, 'most_wins_extreme', 9, 'ThanapiphatX', 1, NULL, '2025-07-25 09:40:36'),
(37, 'fastest_win_hard', 9, 'ThanapiphatX', 40, 42, '2025-07-25 09:42:22'),
(38, 'most_wins_hard', 9, 'ThanapiphatX', 1, NULL, '2025-07-25 09:42:22'),
(39, 'fastest_win_medium', 9, 'ThanapiphatX', 47, 47, '2025-07-25 09:43:18'),
(40, 'most_wins_medium', 9, 'ThanapiphatX', 1, NULL, '2025-07-25 09:43:18'),
(41, 'fastest_win_easy', 9, 'ThanapiphatX', 39, 38, '2025-07-25 09:44:08'),
(42, 'most_wins_easy', 9, 'ThanapiphatX', 1, NULL, '2025-07-25 09:44:08'),
(43, 'fastest_win_extreme', 10, 'Bassi', 47, 40, '2025-07-25 13:19:30'),
(44, 'most_wins_extreme', 10, 'Bassi', 1, NULL, '2025-07-25 13:19:30'),
(45, 'fastest_win_easy', 1, 'player', 95, 47, '2025-08-01 09:55:01'),
(46, 'most_wins_easy', 1, 'player', 1, NULL, '2025-08-01 09:55:01'),
(47, 'fastest_win_medium', 1, 'player', 69, 50, '2025-08-08 09:36:37'),
(48, 'most_wins_medium', 1, 'player', 1, NULL, '2025-08-08 09:36:37'),
(49, 'fastest_win_hard', 1, 'player', 80, 59, '2025-08-08 10:07:41'),
(50, 'most_wins_hard', 1, 'player', 1, NULL, '2025-08-08 10:07:41'),
(51, 'fastest_win_easy', 15, 'A1234', 59, 42, '2025-08-22 09:48:16'),
(52, 'most_wins_easy', 15, 'A1234', 1, NULL, '2025-08-22 09:48:16'),
(53, 'fastest_win_medium', 15, 'A1234', 140, 67, '2025-08-22 09:53:13'),
(54, 'most_wins_medium', 15, 'A1234', 1, NULL, '2025-08-22 09:53:13'),
(55, 'fastest_win_easy', 17, 'kuy', 33, 37, '2025-08-22 11:05:33'),
(56, 'most_wins_easy', 17, 'kuy', 1, NULL, '2025-08-22 11:05:33'),
(57, 'fastest_win_extreme', 18, 'Pause', 79, 49, '2025-08-22 14:14:24'),
(58, 'most_wins_extreme', 18, 'Pause', 1, NULL, '2025-08-22 14:14:24'),
(59, 'fastest_win_extreme', 19, 'Kao', 90, 35, '2025-09-03 14:49:29'),
(60, 'most_wins_extreme', 19, 'Kao', 1, NULL, '2025-09-03 14:49:29'),
(61, 'fastest_win_extreme', 20, 'lll099', 92, 36, '2025-09-03 14:55:35'),
(62, 'most_wins_extreme', 20, 'lll099', 1, NULL, '2025-09-03 14:55:35'),
(63, 'fastest_win_extreme', 21, 'Aum1', 78, 62, '2025-09-03 15:01:17'),
(64, 'most_wins_extreme', 21, 'Aum1', 1, NULL, '2025-09-03 15:01:17'),
(65, 'fastest_win_hard', 19, 'Kao', 40, 56, '2025-09-03 15:42:37'),
(66, 'most_wins_hard', 19, 'Kao', 1, NULL, '2025-09-03 15:42:37'),
(67, 'fastest_win_medium', 27, 'seonpung_le', 98, 37, '2025-09-03 15:59:33'),
(68, 'most_wins_medium', 27, 'seonpung_le', 1, NULL, '2025-09-03 15:59:33'),
(69, 'fastest_win_easy', 29, 'dekdee', 93, 38, '2025-09-03 16:00:08'),
(70, 'most_wins_easy', 29, 'dekdee', 1, NULL, '2025-09-03 16:00:08'),
(71, 'fastest_win_hard', 30, 'PPlnwza007', 106, 85, '2025-09-03 16:01:09'),
(72, 'most_wins_hard', 30, 'PPlnwza007', 1, NULL, '2025-09-03 16:01:09'),
(73, 'fastest_win_easy', 28, 'earthmzn', 159, 68, '2025-09-03 16:01:15'),
(74, 'most_wins_easy', 28, 'earthmzn', 1, NULL, '2025-09-03 16:01:15'),
(75, 'fastest_win_extreme', 30, 'PPlnwza007', 29, 40, '2025-09-03 16:02:46'),
(76, 'most_wins_extreme', 30, 'PPlnwza007', 1, NULL, '2025-09-03 16:02:46'),
(77, 'fastest_win_easy', 34, 'Tunggg', 89, 42, '2025-09-03 16:09:58'),
(78, 'most_wins_easy', 34, 'Tunggg', 1, NULL, '2025-09-03 16:09:58'),
(79, 'fastest_win_easy', 37, 'Khanathip_54', 84, 46, '2025-09-03 16:10:02'),
(80, 'most_wins_easy', 37, 'Khanathip_54', 1, NULL, '2025-09-03 16:10:02'),
(81, 'fastest_win_extreme', 35, 'mahiru', 175, 42, '2025-09-03 16:12:56'),
(82, 'most_wins_extreme', 35, 'mahiru', 1, NULL, '2025-09-03 16:12:56');

-- --------------------------------------------------------

--
-- Table structure for table `login_sessions`
--

CREATE TABLE `login_sessions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `session_token` varchar(255) NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `expires_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `login_sessions`
--

INSERT INTO `login_sessions` (`id`, `user_id`, `session_token`, `ip_address`, `user_agent`, `created_at`, `expires_at`, `is_active`) VALUES
(138, 1, 'ad6a6d458373ce54effa6ac7c1cc17a3e35603dd635544f5a19b7c77b7bea24b', '1.47.2.31', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '2025-07-16 02:09:01', '2025-07-17 16:09:00', 1),
(139, 1, 'e8722f2eb0acaab6aca9415fa5cbc9027330f3f5514d11238245a5fbc1c7cfed', '1.47.2.31', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36', '2025-07-16 03:49:29', '2025-07-17 17:49:29', 1),
(140, 1, '2119ce1c01e478b8eaaa24d87272f60629d7689401b9ab0bb05bcf27baf7c23c', '183.88.223.197', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '2025-07-17 02:33:03', '2025-07-18 16:33:03', 1),
(141, 1, '0b4e963b8dedf0adc07bcf0a10565ec09d7a89bac0e584f6f0128449a00e531a', '1.46.129.55', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '2025-07-25 02:27:03', '2025-07-26 16:27:03', 1),
(142, 1, '52be3e2702e4a6791243002e4047b40293c46f28764546eb2f3d8d859d3342fa', '1.46.129.55', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '2025-07-25 02:27:04', '2025-07-26 16:27:04', 1),
(143, 1, '68a33d9fa821c7cf87dfac13f7982e953b9178e473f640e5060a291119fef50e', '1.46.129.55', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36', '2025-07-25 02:27:35', '2025-07-26 16:27:35', 1),
(144, 7, 'a631f34591eb40a62a67ad2e9a8e5f239f2e7e3ba3c5c269163667bf1c91a730', '1.46.129.55', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36', '2025-07-25 02:30:26', '2025-07-26 16:30:26', 1),
(145, 9, '43f87a300ebe9e91d91a87b455ebd801ff2fd143041195bfa40faffd187357a7', '1.46.129.55', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '2025-07-25 02:39:45', '2025-07-26 16:39:45', 1),
(146, 10, '397879922cfbbb8f97087089e8e213d20acf5b10d02963fb837e731eec91799e', '1.46.129.55', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36', '2025-07-25 05:04:08', '2025-07-26 19:04:08', 1),
(147, 10, '170e3fdba5f47d5355d97a478fd17c118b1bc5b9859e630bf05877775927d587', '1.46.129.55', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36', '2025-07-25 05:19:57', '2025-07-26 19:19:57', 1),
(148, 10, '5e922f58f93b6eddcfe115a42923550b6153f3dfe475748d79db359dbd4bcb63', '1.46.129.55', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36', '2025-07-25 05:29:42', '2025-07-26 19:29:42', 1),
(149, 1, '8aa503050297e43a7252f5f37144cc73a696e2d9fcf0606117f0e8090ab08732', '183.88.223.197', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '2025-07-25 05:33:36', '2025-07-26 19:33:36', 1),
(150, 10, '678fd91250179999c0669ccf828d6d6abfabb135a0cad3394e6d11b380e02836', '1.46.129.55', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36', '2025-07-25 05:40:22', '2025-07-26 19:40:22', 1),
(151, 1, '5020f15d777f1972707f4063de100ae5c4bb075a9f7f2379d99c064b05b53bff', '183.88.223.197', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '2025-07-25 05:42:16', '2025-07-26 19:42:16', 1),
(152, 11, 'e01c35388b87814133f3547282beb4533c78f6b138142d2a97c88303a747a206', '183.88.223.197', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '2025-07-25 05:45:11', '2025-07-26 19:45:11', 1),
(153, 12, 'e0999899034da37602b5a3ed6f2e5d9c111b37207b49637efc145a08eb9430f4', '183.88.223.197', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '2025-07-25 05:45:26', '2025-07-26 19:45:26', 1),
(154, 1, '87ce8f3455a431b41755debdca81c735e403f4b2d85b21806dbbbe56ebaa2255', '49.48.226.176', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '2025-07-26 01:40:35', '2025-07-27 15:40:35', 1),
(155, 1, '580de3037b72cea2d5063426e77361f619807b223084b60a14da2561c91fd929', '49.48.226.176', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '2025-07-26 02:17:10', '2025-07-27 16:17:10', 1),
(156, 9, '42eb1095f5c706a62746723bbb46d38d44415d96403ebf69456e9f3ad14584c2', '1.47.17.234', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '2025-07-29 08:04:38', '2025-07-30 22:04:37', 1),
(157, 1, '4e3a462c932d43f006ce01fee2bd5aa3c4443bffe72f1487bd355b91614c808a', '49.48.248.21', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '2025-07-31 09:32:25', '2025-08-01 23:32:25', 1),
(158, 10, 'ce0c8d3ba0500ff7f716e62ec71592031d36f7642363fb90db78ebfd222cfb8c', '1.46.129.231', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36', '2025-08-01 02:50:36', '2025-08-02 16:50:36', 1),
(159, 1, '4a2802e0b53a0c0bd97f72b65bc64015cede27ba1ff7b8ff17188cc8bce5c02f', '49.230.92.74', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 [FBAN/FBIOS;FBAV/518.0.0.36.107;FBBV/769778401;FBDV/iPhone14,5;FBMD/iPhone;FBSN/iOS;FBSV/18.5;FBSS/3;FBCR/;FBID/phone;FBLC/th_TH;FBOP/80]', '2025-08-01 02:53:13', '2025-08-02 16:53:13', 1),
(160, 1, '45d79e9f3f8cc892c84b052eff6318995e7c24f3a3a1d5043d9ecfae25c5078d', '49.237.23.133', 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_5_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 [FBAN/FBIOS;FBAV/494.0.0.52.98;FBBV/696628843;FBDV/iPhone16,2;FBMD/iPhone;FBSN/iOS;FBSV/17.5.1;FBSS/3;FBCR/;FBID/phone;FBLC/th_TH;FBOP/80]', '2025-08-01 03:03:43', '2025-08-02 17:03:43', 1),
(161, 9, 'a9ef0426a43642381f2760b786e90f8c57c525fa0c5b4e45f72105501e2d5049', '49.237.14.184', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '2025-08-01 04:36:54', '2025-08-02 18:36:54', 1),
(162, 9, 'b2d810b423a929b0a93cdacc77054e07aad91df5e40da2516ab926813180ce2d', '49.237.14.184', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '2025-08-01 04:45:27', '2025-08-02 18:45:27', 1),
(163, 1, 'fb8cabb5cc447d7bf7100b3168f4b77ef3bef901c64a383ccaa81ed0b07606de', '49.48.246.235', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '2025-08-03 03:17:25', '2025-08-04 17:17:25', 1),
(164, 1, 'c7b72a6cb888266f4af7827ed1c01cc9603e30fa4bfe47b04120be8a55ab8412', '49.230.44.245', 'Mozilla/5.0 (Linux; Android 12; M2007J3SY Build/SKQ1.211006.001; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/138.0.7204.169 Mobile Safari/537.36 [FB_IAB/FB4A;FBAV/518.0.0.53.109;]', '2025-08-04 01:34:03', '2025-08-05 15:34:03', 1),
(165, 12, '2a5e3a9b074c04bbe81b5a90adc0561e52bff3337679ad5431f003e47000a05d', '1.47.153.181', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '2025-08-04 01:38:39', '2025-08-05 15:38:39', 1),
(166, 1, '69f4d1800483c1bb86e9f9b1025fc3237643954ec8bc366b96bb769799d1baee', '49.48.226.84', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', '2025-08-04 08:17:51', '2025-08-05 22:17:51', 1),
(167, 9, '13370f711aefa09763c0056efa92ef700e2b49509dba7284d83d9df6c0651621', '1.47.146.213', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '2025-08-05 06:03:19', '2025-08-06 20:03:19', 1),
(168, 1, 'a7c338a0bb24486671348dc0bb185a77d27c1536b90427d1d0ca294a089c5794', '49.48.246.112', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '2025-08-07 11:27:07', '2025-08-09 01:27:07', 1),
(169, 1, '1c7ed015db5700bc57e44dd099f368d6c59894b0c113a1897bceee4fb33530f7', '49.48.246.112', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '2025-08-07 11:58:05', '2025-08-09 01:58:05', 1),
(170, 1, '578371fd9599f6d1152bd051d1c5ef16144f240204b6d6ca4c4434c91e6baf7c', '49.48.246.112', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '2025-08-07 12:05:42', '2025-08-09 02:05:42', 1),
(171, 10, '1c720f73b55de2953358bd834b0cc011ca7c755bac26031bd461c696027b077b', '49.48.246.235', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Mobile Safari/537.36', '2025-08-07 15:37:13', '2025-08-09 05:37:13', 1),
(172, 1, '08eb620fc4d8b4020e9af0b8d44ba3f269352296fd1fde612cb4d2c812de6e90', '49.237.14.4', 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_5_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.5 Mobile/15E148 Safari/604.1', '2025-08-08 02:34:09', '2025-08-09 16:34:09', 1),
(173, 1, 'e8ec01e69323688075323087e757f20d3eb639e8b1e944c87bf984052a63f324', '49.237.14.4', 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_5_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) GSA/378.0.783859256 Mobile/15E148 Safari/604.1', '2025-08-08 02:35:13', '2025-08-09 16:35:13', 1),
(174, 1, '5f78b673e58e915f17580b51d115f2614aec23297fe70cec45bb8299b33dec53', '49.230.71.159', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.5 Mobile/15E148 Safari/604.1', '2025-08-08 02:58:13', '2025-08-09 16:58:13', 1),
(175, 9, 'bd9493ed7d151be1a8506a001e7508978f51222c59fca0453af3f87592b85a75', '1.46.8.244', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '2025-08-08 03:00:31', '2025-08-09 17:00:31', 1),
(176, 1, 'a9229fcddec7d9ef581267c7377359616243269ca8b0fcb3dc16f1aba65e5d92', '49.237.14.4', 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_5_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) GSA/378.0.783859256 Mobile/15E148 Safari/604.1', '2025-08-08 03:02:25', '2025-08-09 17:02:25', 1),
(177, 1, 'a26d83f968edf1f1860c387c6c36da09f0efb0f5368b7871dbd9118dc7e671aa', '49.230.71.159', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.5 Mobile/15E148 Safari/604.1', '2025-08-08 03:04:42', '2025-08-09 17:04:42', 1),
(178, 9, '5ae255c622166d9237584d8aa78d00e9825d7180ba671fdb2a89e5b1f37bcb76', '1.46.8.244', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '2025-08-08 03:17:43', '2025-08-09 17:17:43', 1),
(179, 1, 'b0312c396b6112d6d091697f72a76134a8c4d66c82981edd8d79971f8fba6986', '49.237.14.4', 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_5_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) GSA/378.0.783859256 Mobile/15E148 Safari/604.1', '2025-08-08 03:42:54', '2025-08-09 17:42:54', 1),
(180, 9, '9c466a0418fd86ae13ec60d868c64536f97c084dc03cf9d836ee780fade1e89c', '1.46.8.244', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '2025-08-08 04:06:48', '2025-08-09 18:06:49', 1),
(181, 1, 'f6c3b847fde4c7e14918d940d023ce8cdda79bf4479d6728c3f41e1303919cbf', '156.146.49.166', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '2025-08-09 07:59:25', '2025-08-10 21:59:25', 1),
(182, 1, '0dc57cfcf79ab616f8d8bbaeb337e65b859d3a9f5d4a1a8338d0c63da6b9376a', '49.228.246.55', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '2025-08-09 07:59:31', '2025-08-10 21:59:31', 1),
(183, 1, 'c56d08941115966ef0352c43c9d4ae725700a1a69c354bb397c16e7d9b085612', '27.55.76.136', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.5 Mobile/15E148 Safari/604.1', '2025-08-11 03:42:54', '2025-08-12 17:42:54', 1),
(184, 1, '366861c15e9ae542c9fb2878c403f2da2386a564573e9f0a994371c59b0ad712', '104.28.246.147', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '2025-08-14 07:48:08', '2025-08-15 21:48:08', 1),
(185, 1, 'abef991932ffc8b99d28826331cd56c49918a200a14b08aff8d179b9c7e2e7fb', '34.61.103.79', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', '2025-08-14 07:48:21', '2025-08-15 21:48:21', 1),
(186, 1, '6c4d1dedda6ee1dd5809c58988406794df80ac992ee4829c460dea9f0c894e24', '49.230.91.97', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Mobile Safari/537.36', '2025-08-15 02:11:25', '2025-08-16 16:11:25', 1),
(187, 10, 'db2484a1998750b1a934a89cf43838b80601295bc8b372defb9a18c30f7c615d', '1.47.149.242', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Mobile Safari/537.36', '2025-08-15 03:54:49', '2025-08-16 17:54:49', 1),
(188, 10, '1eaa14bd2a52b2e2c6df3ed8ff926eeec30780bb3293ddb3011456ea918a9774', '1.47.149.242', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Mobile Safari/537.36', '2025-08-15 06:13:26', '2025-08-16 20:13:26', 1),
(189, 13, '675906ac266e94ad430270d3274a5c28d34460054e796622b76ea9389f19b0cd', '49.48.228.107', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-16 13:31:17', '2025-08-18 03:31:17', 1),
(190, 10, '88a1774410441296f288533d774fcb01e93d561818474dd516dbfc6bd6b6c885', '49.48.228.107', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Mobile Safari/537.36', '2025-08-16 13:39:32', '2025-08-18 03:39:32', 1),
(191, 14, 'e0f42ed6c2bbc2b86f31160ebe97d66f0c375f5b2c274cc223f27b48e8c0f23d', '49.48.228.107', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.6 Mobile/15E148 Safari/604.1', '2025-08-16 13:40:20', '2025-08-18 03:40:20', 1),
(192, 14, 'a4a44b6eca653025eb93654a6c3fd13d823a6dbc91c4e2b20535fc496988f0cf', '49.48.228.107', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-16 13:51:31', '2025-08-18 03:51:31', 1),
(193, 14, 'b373378e008bf27a084dcca816a51364fe0d57a87b4e9aacc4fa7576a9875369', '49.48.228.107', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-16 13:51:45', '2025-08-18 03:51:45', 1),
(194, 1, '9cc14591ddf32cecb7bfa0703b491f00663357482eb82674b2604a59acbc6fe9', '49.48.228.107', 'Mozilla/5.0 (Linux; Android 13; SM-A515F Build/TP1A.220624.014; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/138.0.7204.179 Mobile Safari/537.36 [FB_IAB/FB4A;FBAV/520.1.0.70.109;]', '2025-08-16 14:08:14', '2025-08-18 04:08:14', 1),
(195, 10, '3860ca5973cc4a37704de1d64dc8027ed839b9368522257f2f106e96498e13e0', '49.48.228.107', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Mobile Safari/537.36', '2025-08-18 11:02:02', '2025-08-20 01:02:02', 1),
(196, 1, '30007f32951eb2c59c2386ded1351859a5498ef4b02756153c31632acf159a21', '49.48.228.107', 'Mozilla/5.0 (Linux; Android 13; SM-A515F Build/TP1A.220624.014; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/138.0.7204.179 Mobile Safari/537.36 Line/15.13.1/IAB', '2025-08-18 11:02:33', '2025-08-20 01:02:32', 1),
(197, 10, 'c26eed833262799533fd2908bef5c567d2391d2b32a9977d7ad25a5a5b80a2e5', '1.46.153.240', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Mobile Safari/537.36', '2025-08-19 03:33:28', '2025-08-20 17:33:28', 1),
(198, 1, '54fc0b332b7ef8d05fa763bc2467ddf41fa3604434cb505464a7af53579ae036', '49.229.230.103', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 Safari Line/15.13.0', '2025-08-22 02:34:36', '2025-08-23 16:34:36', 1),
(199, 15, 'b259a8c28cc3c3c4e43f76fee8d1629266ea331ab3ac805edda098320bdf6c35', '182.232.63.133', 'Mozilla/5.0 (Linux; Android 14; 23124RN87G Build/UP1A.231005.007; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/138.0.7204.179 Mobile Safari/537.36 Line/15.13.1/IAB', '2025-08-22 02:47:08', '2025-08-23 16:47:08', 1),
(200, 16, '23262622dbea366f0c06e2c17aba70827befc430f939461177377aa3d686fca7', '1.46.202.27', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-22 02:58:26', '2025-08-23 16:58:26', 1),
(201, 1, '64573994daec786d75a4ce88855d40402f87b246a57b4d2533835c0551a7b83b', '49.237.16.177', 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_5_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 Safari Line/15.11.0', '2025-08-22 03:24:34', '2025-08-23 17:24:34', 1),
(202, 17, 'caa34ceae9714030dc887ce9d21cc7d7eab65b1dd7f9e70fe3c9611a52b2d996', '49.229.176.31', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-22 04:04:06', '2025-08-23 18:04:07', 1),
(203, 18, 'f1f5563664bba6d387cf63a427f91adcc69820b5cc748f26e0989789c8c825f5', '223.24.93.30', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_1_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 Safari Line/15.13.0', '2025-08-22 07:12:23', '2025-08-23 21:12:23', 1),
(204, 10, '842fa081e8e10dcc4dbba5d0001b5fe4dc402d1784b56bd2f072f538d040c9ac', '1.46.132.79', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Mobile Safari/537.36', '2025-08-29 02:08:14', '2025-08-30 16:08:14', 1),
(205, 9, 'f1cdee8d216970f63b54c167c17351369a11fcdf93ad4cd2c8ca0bdf620103a2', '49.48.250.140', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-30 10:10:41', '2025-09-01 00:10:42', 1),
(206, 10, 'f3323921ccccc8e7df224ad17700dc24ac39dffc32ebbca82be1e96d77afea53', '1.46.2.30', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Mobile Safari/537.36', '2025-09-03 00:58:29', '2025-09-04 14:58:29', 1),
(207, 10, 'be2b79a1b0b50023a156d25bb4cdacf37ecd2511baccae29bd12b220c410ac25', '1.46.2.30', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Mobile Safari/537.36', '2025-09-03 00:58:29', '2025-09-04 14:58:29', 1),
(208, 10, 'a86288302af701d3b7f6b7fd074a8bd6bfd6bd6b42fc821369476f88fab977f9', '1.46.2.30', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Mobile Safari/537.36', '2025-09-03 06:28:06', '2025-09-04 20:28:06', 1),
(209, 1, '8bc4a78f17f9a1c8d3418bef2638de9344f95bababa902ca849a539646205f7f', '49.237.86.209', 'Mozilla/5.0 (Linux; Android 15; ASUS_AI2401_C Build/AQ3A.240812.002; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/139.0.7258.143 Mobile Safari/537.36 Line/15.13.1/IAB', '2025-09-03 07:45:48', '2025-09-04 21:45:48', 1),
(210, 1, 'ab5be31c18a67bd5f2441273f7c4b365a201737450d7f80dbe34332e55b6e2ea', '1.46.17.45', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 Safari Line/15.13.0', '2025-09-03 07:46:21', '2025-09-04 21:46:21', 1),
(211, 1, 'e93ad87fc7c0048040a62a2d28a7207d4ec6368715d9c51b81ffd575d26593d0', '183.88.223.197', 'Mozilla/5.0 (Linux; Android 15; RMX3785 Build/AP3A.240617.008; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/139.0.7258.143 Mobile Safari/537.36 Line/15.14.1/IAB', '2025-09-03 07:46:25', '2025-09-04 21:46:25', 1),
(212, 1, '025b04addc4ce9bfa7aabae38afa291253bceef245d8b48b0871f1d9542f566b', '49.230.73.38', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 Safari Line/15.13.0', '2025-09-03 07:46:37', '2025-09-04 21:46:37', 1),
(213, 1, '9beb1d0ed7ddbfb419f16cc42183ba96ce541733a60560cd626ab9b39777ee76', '49.230.53.89', 'Mozilla/5.0 (Linux; Android 15; V2427 Build/AP3A.240905.015.A2_V000L1; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/139.0.7258.143 Mobile Safari/537.36 Line/15.13.1/IAB', '2025-09-03 07:46:38', '2025-09-04 21:46:38', 1),
(214, 1, 'f842f26631d2a9557f81dde7a04328fd5de903b7c4cd5dc31de95885486ec968', '1.46.2.30', 'Mozilla/5.0 (Linux; Android 13; SM-A515F Build/TP1A.220624.014; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/139.0.7258.143 Mobile Safari/537.36 Line/15.14.1/IAB', '2025-09-03 07:47:01', '2025-09-04 21:47:01', 1),
(215, 19, 'f27536b39878dafd1a4ff77001f6b20b34b10c63a2e648b1df924aca856bbfb4', '110.77.232.3', 'Mozilla/5.0 (Linux; Android 12; V2029 Build/SP1A.210812.003; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/139.0.7258.143 Mobile Safari/537.36 Line/15.14.1/IAB', '2025-09-03 07:47:17', '2025-09-04 21:47:17', 1),
(216, 1, 'a9663bbfc0cacaf0705211521fc536ca693c696c5f7d2cd6d2edac1f3c69e2a9', '1.0.211.245', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-03 07:48:35', '2025-09-04 21:48:35', 1),
(217, 1, 'aff05b67942581abf3f55551be996f840b479df1d061c985be5c17bd96acf596', '1.0.211.245', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-03 07:48:36', '2025-09-04 21:48:36', 1),
(218, 1, 'cf1492ffc2484959c2f6da7e1aa53b865ccec033807749b1e8dbbad71c47a882', '1.0.211.245', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-03 07:48:37', '2025-09-04 21:48:37', 1),
(219, 1, 'd09ea80c8d1a0cff8a4a3d6934e72b061d47d9f964c3bdaba834a284899ac208', '1.0.211.245', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-03 07:48:39', '2025-09-04 21:48:39', 1),
(220, 1, 'aa0cae33bc54b8fed490f67e95cfaacb9976a16670d5c6651f7993b5f757e25f', '49.48.225.50', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-03 07:50:12', '2025-09-04 21:50:12', 1),
(221, 1, '4fd8589ebecb60b97ec67cd5a20cd8054fdc46487bfbdd4d27b66b2c96783f4e', '27.55.79.161', 'Mozilla/5.0 (Linux; Android 15; RMX3661 Build/AP3A.240617.008; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/139.0.7258.143 Mobile Safari/537.36 Line/15.14.1/IAB', '2025-09-03 07:51:30', '2025-09-04 21:51:30', 1),
(222, 20, 'dc7b5b08ed346a4071ad75831d0f628af1d61dc874ef93c2683ea115362bc56e', '122.155.60.25', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Mobile Safari/537.36', '2025-09-03 07:52:26', '2025-09-04 21:52:26', 1),
(223, 1, 'ec5791f42415d5316bbf9c79c297e92d5545c6905b975866081d68ad2283ec37', '49.230.73.31', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', '2025-09-03 07:52:50', '2025-09-04 21:52:50', 1),
(224, 1, 'b2b3c44e6f434afd01867e9195a341cc36cb3b0205269ca791956da38534682b', '49.230.73.31', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', '2025-09-03 07:52:53', '2025-09-04 21:52:53', 1),
(225, 1, '01731359be7415c3f223c6f1877a3b2fe05cab379088ad23c2006b94dd57fa86', '49.230.90.225', 'Mozilla/5.0 (Linux; Android 15; SM-A166P Build/AP3A.240905.015.A2; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/139.0.7258.143 Mobile Safari/537.36 Line/15.11.2/IAB', '2025-09-03 07:57:33', '2025-09-04 21:57:33', 1),
(226, 1, 'fc8eb414f0ea2a54c7edecb9e737b88942396b37fc5cc3cdda01258f47abd4fa', '27.55.79.161', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Mobile Safari/537.36', '2025-09-03 07:57:49', '2025-09-04 21:57:49', 1),
(227, 21, '60c099985f9858ced051cef74ba7d233f33b823f2749c4833e717ab6f056e4c5', '49.237.40.245', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 Safari Line/15.13.0', '2025-09-03 07:59:50', '2025-09-04 21:59:50', 1),
(228, 1, '94f645e73971feddc0165a4c5b529fee8065ff33db531eda5337dc34335a37cc', '49.237.65.74', 'Mozilla/5.0 (Linux; Android 15; ALI-NX1 Build/HONORALI-N21; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/139.0.7258.144 Mobile Safari/537.36 Line/15.14.1/IAB', '2025-09-03 08:00:18', '2025-09-04 22:00:18', 1),
(229, 1, '18efa07312d977625e93f82444f3d79d3621ee0083025d548dc211641cabb9ab', '1.46.2.30', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Mobile Safari/537.36 OPR/91.0.0.0', '2025-09-03 08:02:26', '2025-09-04 22:02:26', 1),
(230, 22, '9077dd5373fad99a5975bfa634fcd0cdf16fa71077d588158882034331210538', '49.229.198.167', 'Mozilla/5.0 (Linux; Android 11; SM-A226B Build/RP1A.200720.012; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/139.0.7258.158 Mobile Safari/537.36 Line/15.14.1/IAB', '2025-09-03 08:07:20', '2025-09-04 22:07:20', 1),
(231, 1, 'e7bed9257a08123dbd63292365f030b78be744843bb4ff0363f4d7ab966bcac7', '49.237.82.9', 'Mozilla/5.0 (Linux; Android 15; CPH2531 Build/AP3A.240617.008; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/139.0.7258.143 Mobile Safari/537.36 Line/15.14.1/IAB', '2025-09-03 08:09:37', '2025-09-04 22:09:37', 1),
(232, 1, '259d091eb7c098b017d231680e0612efba8dafeb7a36ec3457f5db61b5b82cc0', '49.237.166.240', 'Mozilla/5.0 (Linux; Android 11; moto g(9) plus Build/RPAS31.Q2-59-17-4-5-5; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/139.0.7258.158 Mobile Safari/537.36 Line/15.14.1/IAB', '2025-09-03 08:15:34', '2025-09-04 22:15:34', 1),
(233, 1, 'cd50a1542b98fb2e338af4b19fce99d75ff0b3decf8b53a7b33ae9760fdd406b', '49.237.12.249', 'Mozilla/5.0 (Linux; Android 13; CPH2197 Build/TP1A.220905.001; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/139.0.7258.158 Mobile Safari/537.36 Line/15.13.1/IAB', '2025-09-03 08:15:56', '2025-09-04 22:15:56', 1),
(234, 1, '8f435da10c610ff0b8eb4e681c8bbed0c6a458d5902da99718ccd48ab2bcdd29', '49.48.225.50', 'Mozilla/5.0 (Linux; Android 9; vivo 1915 Build/PPR1.180610.011; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/138.0.7204.179 Mobile Safari/537.36 Line/15.2.1/IAB', '2025-09-03 08:17:09', '2025-09-04 22:17:09', 1),
(235, 1, '4421b7684062896b2c9bca9290bbf0741123de324c6c23c265b0738480ea3acb', '49.237.73.223', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 Safari Line/15.13.0', '2025-09-03 08:20:01', '2025-09-04 22:20:01', 1),
(236, 1, 'b4640366560379dfffe895c57fb6313a7d99a38e793dd027f2499942001f6ab8', '49.48.225.50', 'Mozilla/5.0 (Linux; Android 12; V2111 Build/SP1A.210812.003; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/139.0.7258.143 Mobile Safari/537.36 Line/15.14.1/IAB', '2025-09-03 08:21:34', '2025-09-04 22:21:34', 1),
(237, 1, '714ae285df5922b46aaca515b1dd34a5406b8a4d4513c8d5cf3ad72b618b5132', '49.48.225.50', 'Mozilla/5.0 (Linux; Android 15; SM-A066B Build/AP3A.240905.015.A2; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/139.0.7258.143 Mobile Safari/537.36 Line/15.14.1/IAB', '2025-09-03 08:27:02', '2025-09-04 22:27:02', 1),
(238, 23, '0e80369ca1b63915ffc5ca1313bade7414ba3b05f5ebcaa8e02d310deb76ade7', '1.0.211.245', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-03 08:35:27', '2025-09-04 22:35:27', 1),
(239, 1, 'd0adb263124cf76f6172e6a39ad44bd982f4cf950d2388f4489ee315641ac8a4', '182.232.48.153', 'Mozilla/5.0 (Linux; Android 11; SHARK PRS-H0 Build/PROS2203060OS00MP5; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/139.0.7258.143 Mobile Safari/537.36 Line/15.13.1/IAB', '2025-09-03 08:51:52', '2025-09-04 22:51:52', 1),
(240, 1, '4d477fa02505cfc6d86989cbb11ec9564f8ca7393eeba6632f792b6d27251525', '49.237.85.64', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 Safari Line/15.7.0', '2025-09-03 08:53:27', '2025-09-04 22:53:27', 1),
(241, 1, 'c485c22901f42dc8219d8dc811cdac53a1ec6ec956c08eeaa8bed8832b971c58', '1.46.140.88', 'Mozilla/5.0 (Linux; Android 15; V2322 Build/AP3A.240905.015.A2_NNCS; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/139.0.7258.143 Mobile Safari/537.36 Line/15.14.1/IAB', '2025-09-03 08:53:53', '2025-09-04 22:53:53', 1),
(242, 1, 'caa79171df5e743654457006c96fbf02e4b210895331b9e158e600ffdd7166fd', '27.55.79.168', 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_6_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 Safari Line/15.13.0', '2025-09-03 08:53:54', '2025-09-04 22:53:54', 1),
(243, 1, '1749e77b28b7e9c7f8f9ea953c0bc2b1f89bffd229fab9eed111d024836f569a', '182.232.55.228', 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 Safari Line/15.13.0', '2025-09-03 08:54:38', '2025-09-04 22:54:38', 1),
(244, 1, '833b7d5f1c083d8bc54a68dd460fd6f06173fcfad14db479fef4828f83fcd03c', '183.88.223.197', 'Mozilla/5.0 (Linux; Android 14; SM-A528B Build/UP1A.231005.007; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/139.0.7258.143 Mobile Safari/537.36 Line/15.14.1/IAB', '2025-09-03 08:55:14', '2025-09-04 22:55:14', 1),
(245, 1, '8c27ce921fad65aa0e7d3a5692989717d0f91de141556689824fe8754f5e1131', '1.46.17.45', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 Safari Line/15.13.0', '2025-09-03 08:56:06', '2025-09-04 22:56:06', 1),
(246, 25, '25d83bca2f7271d3ba22f491dd817391037d0d61ac853c6f6252b200fff0d2e9', '182.232.179.35', 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_0_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 Safari Line/15.13.0', '2025-09-03 08:57:02', '2025-09-04 22:57:02', 1),
(247, 26, 'f0b6f4ab3e66ddae774efc93defb71250771bc407b46a95df109689a70d5f95a', '49.230.136.34', 'Mozilla/5.0 (Linux; Android 15; CPH2699 Build/AP3A.240617.008; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/139.0.7258.143 Mobile Safari/537.36 Line/15.14.1/IAB', '2025-09-03 08:57:11', '2025-09-04 22:57:11', 1),
(248, 1, 'a78cd8cea5bacad3eba1525f9858f3ecbb2dc2fdf93e417ab3df84bbd5a56ab5', '183.88.223.197', 'Mozilla/5.0 (Linux; Android 15; SM-A065F Build/AP3A.240905.015.A2; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/139.0.7258.143 Mobile Safari/537.36 Line/15.13.1/IAB', '2025-09-03 08:57:23', '2025-09-04 22:57:23', 1),
(249, 27, '28558087a46b30d41f580d39e354bdb49e7ca8e3e32c9af942c57c40fa6c0de2', '49.48.225.50', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Mobile Safari/537.36', '2025-09-03 08:57:35', '2025-09-04 22:57:35', 1),
(250, 1, 'd83c7f3f2238809a59eb8b2a500a5af7d5415ba93f188ef1d0c5bcf7f2f4a8c9', '183.88.223.197', 'Mozilla/5.0 (Linux; Android 13; SM-A235F Build/TP1A.220624.014; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/139.0.7258.158 Mobile Safari/537.36 Line/15.14.1/IAB', '2025-09-03 08:57:40', '2025-09-04 22:57:40', 1),
(251, 1, 'f5128226f8bee56150484e003e06e4223f386b9138fc37fabb63b4422f0529c8', '223.24.193.19', 'Mozilla/5.0 (Linux; Android 13; RMX3612 Build/TP1A.220905.001; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/139.0.7258.143 Mobile Safari/537.36 Line/15.13.1/IAB', '2025-09-03 08:57:48', '2025-09-04 22:57:48', 1),
(252, 28, '80cdd83f51e979c6c008de9604ab1d6d241a67a00afab0ba26401710868ee90c', '49.237.18.39', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Mobile Safari/537.36', '2025-09-03 08:57:48', '2025-09-04 22:57:48', 1),
(253, 1, 'a4e3ce62bd7ad911a8afa9d2140696a79f51e9bdb408bce8db949621bedc08dc', '49.230.89.188', 'Mozilla/5.0 (Linux; Android 15; CPH2699 Build/AP3A.240617.008; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/139.0.7258.143 Mobile Safari/537.36 Line/15.0.0/IAB', '2025-09-03 08:58:12', '2025-09-04 22:58:12', 1),
(254, 29, '953c9544fed4d5ce7926219f50f03f00a4a00792855edfb29a6a19660a37c3e7', '49.237.69.159', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_4_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 Safari Line/15.13.0', '2025-09-03 08:58:18', '2025-09-04 22:58:18', 1),
(255, 30, '144aa5013b985676070da1a4a305e46a5a581c3c7ad5d5cb74d7e751a543012c', '49.48.225.50', 'Mozilla/5.0 (iPad; CPU OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 Safari Line/15.13.0', '2025-09-03 08:58:32', '2025-09-04 22:58:32', 1),
(256, 1, '8f6900e1a95278097c7a34d49f97f60dd670cdbd5c98319b41a40245c96c5589', '1.47.9.78', 'Mozilla/5.0 (Linux; Android 13; CPH2203 Build/TP1A.220905.001; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/139.0.7258.143 Mobile Safari/537.36 Line/15.13.1/IAB', '2025-09-03 08:59:05', '2025-09-04 22:59:05', 1),
(257, 1, 'f245da72b73eb23815dfdb17fb7d631b8290ccd8451bd0274c16e07b4c47b1bf', '1.46.142.0', 'Mozilla/5.0 (Linux; Android 12; M2102J20SG Build/SKQ1.211006.001; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/139.0.7258.143 Mobile Safari/537.36 Line/15.13.1/IAB', '2025-09-03 08:59:35', '2025-09-04 22:59:35', 1),
(258, 1, '46158968fc1e0c4d852ba8d97c7acc72e9675035f492f0450eaca86cd0f458bc', '49.230.71.46', 'Mozilla/5.0 (Linux; Android 15; SM-A556E Build/AP3A.240905.015.A2; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/139.0.7258.143 Mobile Safari/537.36 Line/15.14.1/IAB', '2025-09-03 08:59:36', '2025-09-04 22:59:36', 1),
(259, 32, '11dfc1998e140f53a160296bbc9ae06bf2d24e64cfebc924a8a1bb75b2a20385', '49.48.225.50', 'Mozilla/5.0 (Linux; Android 15; SM-A346E Build/AP3A.240905.015.A2; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/140.0.7339.47 Mobile Safari/537.36 Line/15.14.1/IAB', '2025-09-03 09:01:09', '2025-09-04 23:01:09', 1),
(260, 1, 'fffed2607b73dcfc8be82707d187e515b300d1e38aca1af7e12eabae7ddbb505', '49.237.43.124', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-03 09:01:11', '2025-09-04 23:01:11', 1),
(261, 31, 'babb8b3d9a711a695058359ad87a163d8d6680228d93f56a4a77f9df1555df6e', '49.237.40.9', 'Mozilla/5.0 (Linux; Android 12; SM-A125F Build/SP1A.210812.016; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/139.0.7258.143 Mobile Safari/537.36 Line/15.14.1/IAB', '2025-09-03 09:01:20', '2025-09-04 23:01:20', 1),
(262, 33, '314506ad87cee3bdd640056fb10afb9d4b80805bd059a9b2cf7f0dae190a1389', '1.46.142.0', 'Mozilla/5.0 (Linux; Android 12; M2102J20SG Build/SKQ1.211006.001; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/139.0.7258.143 Mobile Safari/537.36 Line/15.13.1/IAB', '2025-09-03 09:01:28', '2025-09-04 23:01:28', 1),
(263, 1, 'c143a684cdeed263517989c34d0f084274acd0f3546220783ee786d7dc1e64a7', '49.48.225.50', 'Mozilla/5.0 (Linux; Android 15; V2338A Build/AP3A.240905.015.A2; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/127.0.6533.103 Mobile Safari/537.36 Line/15.13.1/IAB', '2025-09-03 09:01:36', '2025-09-04 23:01:36', 1),
(264, 1, '5948491cc9f3d8970a8bdd279f5b473eacf7e6d03d179a92e1e432bc084bd5ac', '183.88.223.197', 'Mozilla/5.0 (iPad; CPU OS 18_1_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 Safari Line/15.13.0', '2025-09-03 09:02:34', '2025-09-04 23:02:34', 1),
(265, 1, '77e3a72e78cb71e0d449fa90e4b3268dccb62a677a6f7b2e3ab36229b9271ca3', '49.48.225.50', 'Mozilla/5.0 (Linux; Android 15; V2348 Build/AP3A.240905.015.A2; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/139.0.7258.158 Mobile Safari/537.36 Line/15.13.1/IAB', '2025-09-03 09:02:49', '2025-09-04 23:02:49', 1),
(266, 34, '877abd5ae9b2fd6d182028684539a68b0fe28493ab9568eabf225a76eefe4daf', '223.24.160.212', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 Safari Line/15.13.0', '2025-09-03 09:03:59', '2025-09-04 23:03:59', 1),
(267, 35, 'aa8669533acf817e144635509de47aa9d62e76ceb44d1e93cac1ea28170f0837', '182.232.50.210', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Mobile Safari/537.36', '2025-09-03 09:04:05', '2025-09-04 23:04:05', 1),
(268, 1, 'eaf951867b9a7961f15fdc5adc3efe1c9a86eff8828cb8afac3b90c4bbb6c7db', '182.232.6.117', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_4_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 Safari Line/15.13.0', '2025-09-03 09:04:32', '2025-09-04 23:04:32', 1),
(269, 1, 'd66ccaf69c34d6b5304f55c32fd0f49d8a0df41e30a18181f1a88d2c8bbd813b', '183.88.223.197', 'Mozilla/5.0 (Linux; Android 15; RMX3785 Build/AP3A.240617.008; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/139.0.7258.143 Mobile Safari/537.36 Line/15.14.1/IAB', '2025-09-03 09:04:36', '2025-09-04 23:04:36', 1),
(270, 1, '41ee4632154a3df8219f9dabba8bd30454c94b8573f69a5a087566ae31a2baf4', '49.230.136.38', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 Safari Line/15.9.0', '2025-09-03 09:04:41', '2025-09-04 23:04:41', 1),
(271, 1, '10a9e1fce06f1ac00c7768b28e9d733795bb2d2308b0b29ce553d5637193fe34', '183.88.223.197', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', '2025-09-03 09:04:50', '2025-09-04 23:04:50', 1),
(272, 1, '33f9a41b9a2ac9d9e7bac6579882b4a1c2a9cd9c1c7e96cdbb2efc3dda97fdbf', '182.232.35.29', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 Safari Line/15.13.0', '2025-09-03 09:05:01', '2025-09-04 23:05:01', 1),
(273, 1, '6979ba4476390fe6dcc990d8fc5b21d236d4a3bda779acdfd973f7ebb4bab2b2', '49.230.65.138', 'Mozilla/5.0 (Linux; Android 13; Infinix X6528 Build/TP1A.220624.014; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/139.0.7258.143 Mobile Safari/537.36 Line/15.13.1/IAB', '2025-09-03 09:05:07', '2025-09-04 23:05:07', 1),
(274, 1, '17ef8091660e775a389cee1ff31dd7818a0f6561f7f9b6042de1b57166edc4a1', '49.230.65.138', 'Mozilla/5.0 (Linux; Android 13; Infinix X6528 Build/TP1A.220624.014; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/139.0.7258.143 Mobile Safari/537.36 Line/15.13.1/IAB', '2025-09-03 09:05:10', '2025-09-04 23:05:10', 1),
(275, 1, 'd298c6765cafa6b7bace6822b24e9dd715cfa7affe5413359b6e3688989c1efd', '49.237.37.2', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_7_11 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 Safari Line/15.7.2', '2025-09-03 09:05:12', '2025-09-04 23:05:12', 1),
(276, 1, '7a5fe288ad860d5d775aff1d643d5eb885b7dcfbb83006a53a025756f50dcfac', '49.230.236.247', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', '2025-09-03 09:05:14', '2025-09-04 23:05:14', 1),
(277, 1, 'fc8ae98246cbb2f27255e0e1fab21e36ff66f6247d34281c318ef65bf0ef67b2', '49.230.65.138', 'Mozilla/5.0 (Linux; Android 13; Infinix X6528 Build/TP1A.220624.014; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/139.0.7258.143 Mobile Safari/537.36 Line/15.13.1/IAB', '2025-09-03 09:05:16', '2025-09-04 23:05:16', 1),
(278, 36, '0a550e5d956bf84b90452f4ce23c5936b83bf88e8cbcd9b5be0ea4e2ec876177', '183.88.223.197', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', '2025-09-03 09:05:21', '2025-09-04 23:05:21', 1),
(279, 1, 'a838aca6bcef50684b9b471bd590c7cb074e5097fe7e89584e5dd00fa8e6686c', '182.232.141.28', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 Safari Line/15.13.0', '2025-09-03 09:06:37', '2025-09-04 23:06:37', 1),
(280, 1, 'f2dea552a65adcc413d432adb5fda34562633e03090e5753d15f932c2cea9c3c', '1.46.87.142', 'Mozilla/5.0 (Linux; Android 14; Infinix X6833B Build/UP1A.231005.007; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/139.0.7258.143 Mobile Safari/537.36 Line/15.13.1/IAB', '2025-09-03 09:07:13', '2025-09-04 23:07:13', 1),
(281, 37, 'ca4e41baebbc7c14c3cb38a558f42df5f939de3b11798cd99a3dfecc83a9b207', '49.237.34.71', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Mobile Safari/537.36', '2025-09-03 09:07:55', '2025-09-04 23:07:55', 1),
(282, 1, 'adfb60a5a865b2916706a76a7a43cfb2f91697a2c5f3d7693b96aa83f0ae80f4', '49.230.65.138', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Mobile Safari/537.36', '2025-09-03 09:08:10', '2025-09-04 23:08:10', 1),
(283, 1, '84c35e92a32a6baecca7560c19c08b1684be0edecbd8e4fa149da3af7bbe2fbc', '49.48.225.50', 'Mozilla/5.0 (Linux; Android 15; SM-A156E Build/AP3A.240905.015.A2; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/139.0.7258.143 Mobile Safari/537.36 Line/15.14.1/IAB', '2025-09-03 09:08:16', '2025-09-04 23:08:16', 1),
(284, 1, 'fec8c6f9a77379f5290123eb59ae25ba6510f92e48b3761640925ec9a9606757', '49.237.43.124', 'Mozilla/5.0 (Linux; Android 15; ASUS_AI2401_C Build/AQ3A.240812.002; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/139.0.7258.143 Mobile Safari/537.36 Line/15.13.1/IAB', '2025-09-03 09:08:26', '2025-09-04 23:08:26', 1),
(285, 1, '97225833c58850a728754db6c0f7eb3b59bb16cfa11b383d7fd199e74556d503', '1.47.8.248', 'Mozilla/5.0 (Linux; Android 11; CPH1907 Build/RKQ1.200903.002; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/139.0.7258.144 Mobile Safari/537.36 Line/15.14.1/IAB', '2025-09-03 09:08:33', '2025-09-04 23:08:33', 1),
(286, 1, '4ef02b734e98d040a08312d17ddfae100055c3e9bc6623e4541f488b8c10f733', '49.230.71.58', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Mobile Safari/537.36', '2025-09-03 09:08:51', '2025-09-04 23:08:51', 1),
(287, 1, '2bd6c79866b8dd402ad9a8dbaf5116d60975d1f0947c8e869a42ad4e3d2fd3a5', '49.230.136.38', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_3_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 Safari Line/15.13.0', '2025-09-03 09:08:55', '2025-09-04 23:08:55', 1),
(288, 1, 'd87a064f539d896257f77b4a6d6112302e1dec6045df4bd9bbfa62baf96029bb', '183.88.223.197', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', '2025-09-03 09:10:53', '2025-09-04 23:10:53', 1),
(289, 1, '7448685cec7bb57d0bd37f6365c98f9ebf775c035e5792597847884341c8ab2a', '49.229.182.249', 'Mozilla/5.0 (Linux; Android 15; CPH2669 Build/AP3A.240617.008; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/139.0.7258.143 Mobile Safari/537.36 [FB_IAB/FB4A;FBAV/522.0.0.58.109;]', '2025-09-03 09:16:04', '2025-09-04 23:16:04', 1),
(290, 1, '314ff2a2a4998b7829e8c4c2df429d875ae3ac878191859fed32ac901750f1aa', '49.237.69.232', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-03 09:16:22', '2025-09-04 23:16:22', 1),
(291, 1, '94cb192859be636e09b42db4b40f77a697b124a56bad5957fac8c2c63289ab7c', '1.47.17.99', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 Safari Line/15.13.0', '2025-09-03 09:17:54', '2025-09-04 23:17:54', 1),
(292, 39, '1860405051380b88609ee0c68e70709ba86e220032f057c4640486164a41c0d6', '58.10.30.136', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', '2025-09-04 15:27:52', '2025-09-06 05:27:52', 1),
(293, 12, '90d0d4fd80bf7e0afad63e9d5ef61051929b2d1347de866b25da327917e7fe2c', '49.48.227.165', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-04 20:57:02', '2025-09-06 10:57:02', 1);

-- --------------------------------------------------------

--
-- Table structure for table `most_wins_easy`
--

CREATE TABLE `most_wins_easy` (
  `username` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_wins` bigint(21) NOT NULL,
  `fastest_time` int(11) DEFAULT NULL COMMENT 'เวลาเล่นเป็นวินาที',
  `latest_win` timestamp NULL DEFAULT NULL,
  `ranking` bigint(21) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `most_wins_extreme`
--

CREATE TABLE `most_wins_extreme` (
  `username` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_wins` bigint(21) NOT NULL,
  `fastest_time` int(11) DEFAULT NULL COMMENT 'เวลาเล่นเป็นวินาที',
  `latest_win` timestamp NULL DEFAULT NULL,
  `ranking` bigint(21) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `most_wins_hard`
--

CREATE TABLE `most_wins_hard` (
  `username` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_wins` bigint(21) NOT NULL,
  `fastest_time` int(11) DEFAULT NULL COMMENT 'เวลาเล่นเป็นวินาที',
  `latest_win` timestamp NULL DEFAULT NULL,
  `ranking` bigint(21) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `most_wins_medium`
--

CREATE TABLE `most_wins_medium` (
  `username` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_wins` bigint(21) NOT NULL,
  `fastest_time` int(11) DEFAULT NULL COMMENT 'เวลาเล่นเป็นวินาที',
  `latest_win` timestamp NULL DEFAULT NULL,
  `ranking` bigint(21) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `player_stats_summary`
--

CREATE TABLE `player_stats_summary` (
  `user_id` int(11) NOT NULL,
  `username` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_games` bigint(21) NOT NULL,
  `total_wins` decimal(22,0) DEFAULT NULL,
  `total_losses` decimal(22,0) DEFAULT NULL,
  `win_percentage` decimal(28,2) DEFAULT NULL,
  `wins_easy` decimal(22,0) DEFAULT NULL,
  `wins_medium` decimal(22,0) DEFAULT NULL,
  `wins_hard` decimal(22,0) DEFAULT NULL,
  `wins_extreme` decimal(22,0) DEFAULT NULL,
  `fastest_easy` bigint(11) DEFAULT NULL,
  `fastest_medium` bigint(11) DEFAULT NULL,
  `fastest_hard` bigint(11) DEFAULT NULL,
  `fastest_extreme` bigint(11) DEFAULT NULL,
  `avg_game_duration` decimal(14,4) DEFAULT NULL,
  `total_play_time` decimal(32,0) DEFAULT NULL,
  `last_played` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_active` tinyint(1) DEFAULT 1,
  `last_login` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `created_at`, `updated_at`, `is_active`, `last_login`) VALUES
(1, 'player', '$2y$10$xQbeGqatNbbSXsnqyvYnZ.iz5SDI8kcrYXA7CRMUNiusKSQUOqxv2', NULL, '2025-06-27 12:05:46', '2025-09-03 09:17:54', 1, '2025-09-03 09:17:54'),
(2, 'demo', '$2y$10$YourHashedPasswordHere', NULL, '2025-06-27 12:05:46', '2025-06-27 12:05:46', 1, NULL),
(3, 'test1234', '$2y$10$Ie10vjM0kNfZ1VSrhx.Nnu5rmNIHhmIPwCxqcVVTzc..7ujSh.aVC', NULL, '2025-06-27 12:11:26', '2025-07-01 12:34:21', 1, '2025-07-01 12:34:21'),
(4, 'ikas', '$2y$10$8.6aN1DATpiZldZOywooOuMOa0dEEr3mc5aBmOIntBg8kLaTpXeC', NULL, '2025-07-02 09:37:26', '2025-07-02 09:37:37', 1, '2025-07-02 09:37:37'),
(5, 'loveyaimak', '$2y$10$fMjQyd13RWblyBeB.gstlO/xuYQFWkOdCJSUq3t0Neh31jUImf.yW', NULL, '2025-07-04 09:14:14', '2025-07-04 10:16:03', 1, '2025-07-04 10:16:03'),
(6, 'test1235', '$2y$10$6dPwcw0f621OVTTh1I1scOaMUP6zavQx1fTNuau3n22eJ2pysTNqy', NULL, '2025-07-12 14:36:39', '2025-07-12 16:20:07', 1, '2025-07-12 16:20:07'),
(7, 'Thanapiphat', '$2y$10$itTX71H3/LdHFFpWqg5NE.1y/l2bM.Oan0n5a21Te8LPJWNwNow5y', NULL, '2025-07-25 02:30:04', '2025-07-25 02:30:26', 1, '2025-07-25 02:30:26'),
(8, 'teste', '$2y$10$MHqZB3q.SlKi8ZFSbs.gKeMJwoZPCyqULfmYYiYzTmFc0hr1atayy', NULL, '2025-07-25 02:36:28', '2025-07-25 02:36:28', 1, NULL),
(9, 'ThanapiphatX', '$2y$10$niUuaHHaRsvMw0OMRqm24.1EkLZfAPpNCMIeTefOSeDnaDr5Sg/sS', NULL, '2025-07-25 02:39:42', '2025-08-30 10:10:41', 1, '2025-08-30 10:10:41'),
(10, 'Bassi', '$2y$10$RXoOShSla1bOIYyDbvyOn.coYLGy0fqxbPxq4aJZ.b5YH2RAK6IVq', NULL, '2025-07-25 05:04:04', '2025-09-03 06:28:06', 1, '2025-09-03 06:28:06'),
(11, 'Basnakub', '$2y$10$z/bdBOiBnTn70ofTKKlK/OpsTUwap8WNIgVcnd9RD4C3zlROSYy0K', NULL, '2025-07-25 05:44:46', '2025-07-25 05:45:11', 1, '2025-07-25 05:45:11'),
(12, 'Basnakub2', '$2y$10$uWYswFt/KBWEPTAilU0nY.rgZRretTSQ/itatar5w/89JlzMS5Mja', NULL, '2025-07-25 05:45:24', '2025-09-04 20:57:02', 1, '2025-09-04 20:57:02'),
(13, '13f131f31', '$2y$10$9qUoPFyz.sZVm64FIFY8t.9n6QyuGbDeI6HrupmwE8OJDcz7TjpTW', NULL, '2025-08-16 13:31:12', '2025-08-16 13:31:17', 1, '2025-08-16 13:31:17'),
(14, 'QuertyX123', '$2y$10$4jQaOzT/Uq/zShAhxX2nHOTxfPi18EqpL.Jmr3sglnkn0xNqg1W16', NULL, '2025-08-16 13:40:18', '2025-08-16 13:51:51', 1, '2025-08-16 13:51:45'),
(15, 'A1234', '$2y$10$.zpxQuNf25..kiNm5GnJDOkpsMHQKYL/TEPoZ6NN.lhkiJCbO4mnW', NULL, '2025-08-22 02:47:05', '2025-08-22 02:47:08', 1, '2025-08-22 02:47:08'),
(16, 'Krotkub', '$2y$10$Dbq3rrOAs/Pqwv8BFgqdsOYp7VUly1xiqLmzINOvfgBSWvS6XcrzS', NULL, '2025-08-22 02:58:20', '2025-08-22 02:58:26', 1, '2025-08-22 02:58:26'),
(17, 'kuy', '$2y$10$M//JDhgJBlfeLWnyfbX5vu5yPPtC/w0IDEv6TlUjLaFfzV28g1h/K', NULL, '2025-08-22 04:04:01', '2025-08-22 04:04:06', 1, '2025-08-22 04:04:06'),
(18, 'Pause', '$2y$10$nR23DXsOwbn7ecyec37Xkup.fTQFBjuLskzpOSFXCbQTcjA7zAIEC', NULL, '2025-08-22 07:12:20', '2025-08-22 07:12:23', 1, '2025-08-22 07:12:23'),
(19, 'Kao', '$2y$10$KWBx6ERq0TRffp9GmiVUHu7g2Sx56RKnxa79/TMIkBvRNVkJxeMjW', NULL, '2025-09-03 07:47:13', '2025-09-03 07:47:17', 1, '2025-09-03 07:47:17'),
(20, 'lll099', '$2y$10$jjU/GW8Yh21nKt5Xn3VnPeMQg8x6JJjGe7287q3K.i5KaTDJhnToS', NULL, '2025-09-03 07:52:16', '2025-09-03 07:52:26', 1, '2025-09-03 07:52:26'),
(21, 'Aum1', '$2y$10$yJa4jLJWR5B3sZrcbTzjIOLQuO3wSsqSJMhmhotT5fKdPHdQy1nFe', NULL, '2025-09-03 07:59:45', '2025-09-03 07:59:50', 1, '2025-09-03 07:59:50'),
(22, 'lnwChinazA007', '$2y$10$ktNbJXHIS15fB/B9B5USveyB2FI60lMYEVLXTe9O27BDpQ2FpRubu', NULL, '2025-09-03 08:07:17', '2025-09-03 08:07:20', 1, '2025-09-03 08:07:20'),
(23, 'miloKingHacker', '$2y$10$W6m6JHfAtsbGZ/7qBGSlveDxNot7//s7U38l75ZmqRMg1zZrjYtiW', NULL, '2025-09-03 08:35:25', '2025-09-03 08:35:27', 1, '2025-09-03 08:35:27'),
(24, 'Maz', '$2y$10$CI2fMz1Ruki7n95AX7jtK.efRgUOvkqujiXPtmsPM9/swPuSjjuUm', NULL, '2025-09-03 08:51:45', '2025-09-03 08:51:45', 1, NULL),
(25, 'lnwnuiza', '$2y$10$VPwc399M5GCO75MBeoZcNOUoE2rIPOCn70B3kI4wk/F9Yj.Oux3QO', NULL, '2025-09-03 08:56:57', '2025-09-03 08:57:02', 1, '2025-09-03 08:57:02'),
(26, 'BxngtimeWinterfell', '$2y$10$BdBLKcxFtqSKyQjVrwp4nu3gwOmWktWZl8bUEXD2ZfRrB/UKy3/wW', NULL, '2025-09-03 08:57:08', '2025-09-03 08:57:11', 1, '2025-09-03 08:57:11'),
(27, 'seonpung_le', '$2y$10$uNh1VxRszkUNagAD0gm3IeSAGm4HjZJPMCyqTxK4RMlS0cYAndORq', NULL, '2025-09-03 08:57:17', '2025-09-03 08:57:35', 1, '2025-09-03 08:57:35'),
(28, 'earthmzn', '$2y$10$0h4ilvVtQYOiOkm3.H8qi./Qf/WSGDatNuuyedoNZHkWofqwQVq8m', NULL, '2025-09-03 08:57:44', '2025-09-03 08:57:48', 1, '2025-09-03 08:57:48'),
(29, 'dekdee', '$2y$10$Hr7pHcx/vV7soMkyGGVHpucwzfmxgxATa254WuU.8QEwCEILXW4Xu', NULL, '2025-09-03 08:58:14', '2025-09-03 08:58:18', 1, '2025-09-03 08:58:18'),
(30, 'PPlnwza007', '$2y$10$P4zU2vPNwf6s1SZQrrd6b..mY3sw7ubsSMZlXEYXDvcLpHTl0WNjO', NULL, '2025-09-03 08:58:27', '2025-09-03 08:58:32', 1, '2025-09-03 08:58:32'),
(31, 'Mmm', '$2y$10$v5Weh6d44551Tf2RQYqSfOk7TtRhX.zw7So4EG74crGH86Sb5Kgau', NULL, '2025-09-03 09:00:58', '2025-09-03 09:01:20', 1, '2025-09-03 09:01:20'),
(32, 'Man', '$2y$10$f2g9yzbGgx3URkZB6KtBBejcmt.23KFcXO607ytUBHBrtjqJBpzZ6', NULL, '2025-09-03 09:01:05', '2025-09-03 09:01:09', 1, '2025-09-03 09:01:09'),
(33, '303Sosad', '$2y$10$dhvOVXlsmgY2vvWjuq8ZC.IJ.hKLyqFujMltWF0Dz/o4fX8C5D4YS', NULL, '2025-09-03 09:01:25', '2025-09-03 09:01:28', 1, '2025-09-03 09:01:28'),
(34, 'Tunggg', '$2y$10$pZ3XWDiMf5mboFsJ3ycEyO5s62lAsjdB5KsKoAl/NZV7ZSkfCqXT2', NULL, '2025-09-03 09:03:54', '2025-09-03 09:03:59', 1, '2025-09-03 09:03:59'),
(35, 'mahiru', '$2y$10$t52iJo2ig8jXQW8XllJuTuXQD9PmHuxJFMnVOF3.b4J.cYze51LeO', NULL, '2025-09-03 09:04:01', '2025-09-03 09:04:05', 1, '2025-09-03 09:04:05'),
(36, 'Tony', '$2y$10$jeEJxGve4/k2n.LkdxRCte4tpFSsF2saHm23XLH1W3c2x1P9tSoSi', NULL, '2025-09-03 09:05:17', '2025-09-03 09:05:21', 1, '2025-09-03 09:05:21'),
(37, 'Khanathip_54', '$2y$10$UNoXYCdZd2GRLCjo4AQrJe.ON8/Yp94UzHlBC9Rhst/PwoSAg659O', NULL, '2025-09-03 09:07:51', '2025-09-03 09:07:55', 1, '2025-09-03 09:07:55'),
(38, 'PGbut100', '$2y$10$8//U0J5/Jpcjx/Vo.KQOQOietlm6IWNmVI/I5n0msEsSDJ.ufwX4G', NULL, '2025-09-03 09:17:21', '2025-09-03 09:17:21', 1, NULL),
(39, 'dec', '$2y$10$GltT8n7O87XybIxIvzNGbO747dGUn7YZq2ZzZlGEsOEYyJjn3rxSC', NULL, '2025-09-04 15:27:45', '2025-09-04 15:27:52', 1, '2025-09-04 15:27:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `game_statistics`
--
ALTER TABLE `game_statistics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user_id` (`user_id`);

--
-- Indexes for table `leaderboards`
--
ALTER TABLE `leaderboards`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user_type` (`user_id`,`leaderboard_type`);

--
-- Indexes for table `login_sessions`
--
ALTER TABLE `login_sessions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `session_token` (`session_token`),
  ADD KEY `login_sessions_ibfk_1` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `game_statistics`
--
ALTER TABLE `game_statistics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;

--
-- AUTO_INCREMENT for table `leaderboards`
--
ALTER TABLE `leaderboards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `login_sessions`
--
ALTER TABLE `login_sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=294;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `game_statistics`
--
ALTER TABLE `game_statistics`
  ADD CONSTRAINT `game_statistics_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `leaderboards`
--
ALTER TABLE `leaderboards`
  ADD CONSTRAINT `leaderboards_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `login_sessions`
--
ALTER TABLE `login_sessions`
  ADD CONSTRAINT `login_sessions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
