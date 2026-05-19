-- Thai Checkers example database.
-- Safe seed data only. Do not commit production dumps or real user data.

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP TABLE IF EXISTS `login_sessions`;
DROP TABLE IF EXISTS `leaderboards`;
DROP TABLE IF EXISTS `game_statistics`;
DROP TABLE IF EXISTS `users`;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_active` tinyint(1) DEFAULT 1,
  `last_login` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `idx_users_username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `game_statistics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_stats_user` (`user_id`),
  KEY `idx_stats_mode` (`game_mode`),
  KEY `idx_stats_result` (`result`),
  KEY `idx_stats_duration` (`game_duration`),
  KEY `idx_stats_win_fast` (`result`,`game_mode`,`game_duration`),
  CONSTRAINT `game_statistics_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=181 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `leaderboards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `leaderboard_type` enum('fastest_win_easy','fastest_win_medium','fastest_win_hard','fastest_win_extreme','most_wins_easy','most_wins_medium','most_wins_hard','most_wins_extreme') NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `score` int(11) NOT NULL COMMENT 'วินาที (fastest) หรือ จำนวนชนะ (most_wins)',
  `moves_count` int(11) DEFAULT NULL COMMENT 'จำนวนการเดิน (สำหรับ fastest)',
  `game_date` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'วันที่ทำสถิตินี้',
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_user_type` (`user_id`,`leaderboard_type`),
  KEY `idx_leaderboard_type` (`leaderboard_type`),
  KEY `idx_leaderboard_score` (`score`),
  CONSTRAINT `leaderboards_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `login_sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `session_token` varchar(255) NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `expires_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `session_token` (`session_token`),
  KEY `idx_sessions_token` (`session_token`),
  KEY `idx_sessions_user` (`user_id`),
  CONSTRAINT `login_sessions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `users` (`id`, `username`, `password`, `email`, `created_at`, `updated_at`, `is_active`, `last_login`) VALUES
(1, 'demo', '$2y$10$HFK5YbhrNZTd9qBlA2VD5.WfQTy/K2uFsfarzAdAGdFpzpN7e8rq6', 'demo@example.com', '2026-01-01 10:00:00', '2026-01-01 10:00:00', 1, '2026-01-05 18:30:00'),
(2, 'player2', '$2y$10$QDpnTxHYGtZmLIBj3tRoBevnvlCKx/ohxSFODbwxIAm8DhYFTLYDy', 'player2@example.com', '2026-01-02 11:15:00', '2026-01-02 11:15:00', 1, '2026-01-06 19:45:00');

INSERT INTO `game_statistics` (`id`, `user_id`, `username`, `game_mode`, `result`, `game_duration`, `moves_count`, `pieces_captured`, `pieces_lost`, `kings_promoted`, `game_start_time`, `game_end_time`, `created_at`) VALUES
(1, 1, 'demo', 'ai_easy', 'win', 95, 22, 8, 3, 1, '2026-01-05 18:00:00', '2026-01-05 18:01:35', '2026-01-05 18:01:35'),
(2, 1, 'demo', 'ai_medium', 'lose', 210, 42, 5, 8, 0, '2026-01-05 18:10:00', '2026-01-05 18:13:30', '2026-01-05 18:13:30'),
(3, 2, 'player2', 'ai_medium', 'win', 180, 36, 8, 6, 2, '2026-01-06 19:20:00', '2026-01-06 19:23:00', '2026-01-06 19:23:00'),
(4, 2, 'player2', 'ai_hard', 'win', 260, 50, 8, 7, 1, '2026-01-06 19:30:00', '2026-01-06 19:34:20', '2026-01-06 19:34:20');

INSERT INTO `leaderboards` (`id`, `leaderboard_type`, `user_id`, `username`, `score`, `moves_count`, `game_date`, `last_updated`) VALUES
(1, 'fastest_win_easy', 1, 'demo', 95, 22, '2026-01-05 18:01:35', '2026-01-05 18:01:35'),
(2, 'most_wins_easy', 1, 'demo', 3, NULL, '2026-01-05 18:01:35', '2026-01-05 18:01:35'),
(3, 'fastest_win_medium', 2, 'player2', 180, 36, '2026-01-06 19:23:00', '2026-01-06 19:23:00'),
(4, 'most_wins_medium', 2, 'player2', 2, NULL, '2026-01-06 19:23:00', '2026-01-06 19:23:00'),
(5, 'fastest_win_hard', 2, 'player2', 260, 50, '2026-01-06 19:34:20', '2026-01-06 19:34:20');

INSERT INTO `login_sessions` (`id`, `user_id`, `session_token`, `ip_address`, `user_agent`, `created_at`, `expires_at`, `is_active`) VALUES
(1, 1, 'example-inactive-session-token-0001', '127.0.0.1', 'Example Browser', '2026-01-05 18:30:00', '2026-01-06 18:30:00', 0);

ALTER TABLE `users` AUTO_INCREMENT = 43;
ALTER TABLE `game_statistics` AUTO_INCREMENT = 181;
ALTER TABLE `leaderboards` AUTO_INCREMENT = 83;
ALTER TABLE `login_sessions` AUTO_INCREMENT = 98;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
