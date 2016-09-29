-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2016 �?09 �?29 �?16:00
-- 服务器版本: 5.5.40
-- PHP 版本: 5.6.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `lar`
--

-- --------------------------------------------------------

--
-- 表的结构 `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2016_09_20_034810_create_table_users', 1),
('2016_09_20_081006_create_table_tests', 2),
('2016_09_27_064039_create_table_questions', 2);

-- --------------------------------------------------------

--
-- 表的结构 `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `desc` text COLLATE utf8_unicode_ci COMMENT 'description',
  `user_id` int(10) unsigned NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'ok',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `questions_user_id_foreign` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- 转存表中的数据 `questions`
--

INSERT INTO `questions` (`id`, `title`, `desc`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, '为什么你是一只鸡', NULL, 1, '', '2016-09-26 23:33:54', '2016-09-26 23:33:54'),
(2, '哈哈', '描述', 1, '', '2016-09-26 23:34:34', '2016-09-27 00:02:52'),
(3, 'test1', NULL, 1, 'ok', '2016-09-27 00:04:44', '2016-09-27 00:04:44'),
(4, '为什么你是一只鸡', NULL, 1, 'ok', '2016-09-27 00:30:18', '2016-09-27 00:30:18'),
(5, '为什么你是一只鸡', NULL, 1, 'ok', '2016-09-27 00:30:19', '2016-09-27 00:30:19'),
(6, '为什么你是一只鸡', NULL, 1, 'ok', '2016-09-27 00:30:21', '2016-09-27 00:30:21'),
(7, '为什么你是一只鸡', NULL, 1, 'ok', '2016-09-27 00:30:22', '2016-09-27 00:30:22'),
(8, '为什么你是一只鸡', NULL, 1, 'ok', '2016-09-27 00:30:22', '2016-09-27 00:30:22'),
(9, '为什么你是一只鸡', NULL, 1, 'ok', '2016-09-27 00:30:23', '2016-09-27 00:30:23'),
(10, '为什么你是一只鸡', NULL, 1, 'ok', '2016-09-27 00:30:24', '2016-09-27 00:30:24'),
(11, '为什么你是一只鸡', NULL, 1, 'ok', '2016-09-27 00:30:24', '2016-09-27 00:30:24'),
(12, '为什么你是一只鸡', NULL, 1, 'ok', '2016-09-27 00:30:25', '2016-09-27 00:30:25'),
(13, '为什么你是一只鸡', NULL, 1, 'ok', '2016-09-27 00:30:26', '2016-09-27 00:30:26'),
(14, '为什么你是一只鸡', NULL, 1, 'ok', '2016-09-27 00:30:27', '2016-09-27 00:30:27'),
(15, '为什么你是一只鸡', NULL, 1, 'ok', '2016-09-27 00:30:27', '2016-09-27 00:30:27'),
(16, '为什么你是一只鸡', NULL, 1, 'ok', '2016-09-27 00:30:28', '2016-09-27 00:30:28'),
(17, '为什么你是一只鸡', NULL, 1, 'ok', '2016-09-27 00:30:29', '2016-09-27 00:30:29');

-- --------------------------------------------------------

--
-- 表的结构 `tests`
--

CREATE TABLE IF NOT EXISTS `tests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `article` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `intro` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_phone_unique` (`phone`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `avatar_url`, `phone`, `password`, `intro`, `created_at`, `updated_at`) VALUES
(1, 'lyy', NULL, NULL, NULL, '$2y$10$2WsYJGKFDhGImSQ.6cUg3uAp8kT4YVXCBw3AYuxQMUh235Cbab0Ny', NULL, '2016-09-26 22:36:43', '2016-09-26 22:36:43'),
(2, 'test', NULL, NULL, NULL, '$2y$10$us.BV/ymrnT/urkUYkWGwepbZjOD8/RWHGWezXfjKXraga74qaMlK', NULL, '2016-09-26 23:29:14', '2016-09-26 23:29:14');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
