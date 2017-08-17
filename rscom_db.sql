-- phpMyAdmin SQL Dump
-- version 4.0.10.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 17 2017 г., 17:37
-- Версия сервера: 5.5.45
-- Версия PHP: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `rscom_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `rs_gallery_category`
--

CREATE TABLE IF NOT EXISTS `rs_gallery_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `main_image_id` int(10) unsigned DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `description` text,
  `is_main` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  KEY `main_image_id` (`main_image_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `rs_gallery_category`
--

INSERT INTO `rs_gallery_category` (`id`, `parent_id`, `main_image_id`, `title`, `alias`, `description`, `is_main`) VALUES
(7, NULL, 54, 'Тест', '', '', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `rs_gallery_image`
--

CREATE TABLE IF NOT EXISTS `rs_gallery_image` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cat_id` int(10) unsigned NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `ext` varchar(15) NOT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `description` text,
  `meta_keys` text,
  `meta_desc` text,
  `create_at` int(10) unsigned DEFAULT '0',
  `update_at` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `cat_id` (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=74 ;

--
-- Дамп данных таблицы `rs_gallery_image`
--

INSERT INTO `rs_gallery_image` (`id`, `cat_id`, `title`, `ext`, `alias`, `description`, `meta_keys`, `meta_desc`, `create_at`, `update_at`) VALUES
(54, 7, '01', '.jpg', NULL, NULL, NULL, NULL, 0, 0),
(55, 7, '1', '.jpg', NULL, NULL, NULL, NULL, 0, 0),
(56, 7, '1_3', '.jpg', NULL, NULL, NULL, NULL, 0, 0),
(57, 7, '02', '.jpg', NULL, NULL, NULL, NULL, 0, 0),
(58, 7, '2', '.jpg', NULL, NULL, NULL, NULL, 0, 0),
(59, 7, '2_3', '.jpg', NULL, NULL, NULL, NULL, 0, 0),
(60, 7, '03', '.jpg', NULL, NULL, NULL, NULL, 0, 0),
(61, 7, '3', '.jpg', NULL, NULL, NULL, NULL, 0, 0),
(62, 7, '3_1', '.jpg', NULL, NULL, NULL, NULL, 0, 0),
(63, 7, '04', '.jpg', NULL, NULL, NULL, NULL, 0, 0),
(64, 7, '4_1', '.jpg', NULL, NULL, NULL, NULL, 0, 0),
(65, 7, '5-1', '.jpg', NULL, NULL, NULL, NULL, 0, 0),
(66, 7, '7_3', '.jpg', NULL, NULL, NULL, NULL, 0, 0),
(67, 7, '24_1', '.jpg', NULL, NULL, NULL, NULL, 0, 0),
(68, 7, '43_3', '.jpg', NULL, NULL, NULL, NULL, 0, 0),
(69, 7, '54s_3', '.jpg', NULL, NULL, NULL, NULL, 0, 0),
(70, 7, '76_3', '.jpg', NULL, NULL, NULL, NULL, 0, 0),
(71, 7, '572632', '.jpg', NULL, NULL, NULL, NULL, 0, 0),
(72, 7, '17213621', '.jpg', NULL, NULL, NULL, NULL, 0, 0),
(73, 7, '453303179', '.jpg', NULL, NULL, NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `rs_gallery_migration`
--

CREATE TABLE IF NOT EXISTS `rs_gallery_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `rs_gallery_migration`
--

INSERT INTO `rs_gallery_migration` (`version`, `apply_time`) VALUES
('m130524_201442_init', 1495352058),
('m140622_111540_create_image_table', 1494152877),
('m140622_111545_add_name_to_image_table', 1494152877),
('m140930_003227_gallery_manager', 1494288426);

-- --------------------------------------------------------

--
-- Структура таблицы `rs_gallery_user`
--

CREATE TABLE IF NOT EXISTS `rs_gallery_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `rs_gallery_user`
--

INSERT INTO `rs_gallery_user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'buttler', '3_Kv_vTvKNXpbuJ4fbQrcqMe7NPxwrG5', '$2y$13$quB8go1h2f1hG0xZRCRyROVshl9wVaawOarhWEbhoIQ/.OHSo3bzG', NULL, 'admin@mail.com', 10, 1495352311, 1495352311);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `rs_gallery_category`
--
ALTER TABLE `rs_gallery_category`
  ADD CONSTRAINT `category_fk_1` FOREIGN KEY (`parent_id`) REFERENCES `rs_gallery_category` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `category_fk_2` FOREIGN KEY (`main_image_id`) REFERENCES `rs_gallery_image` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `rs_gallery_image`
--
ALTER TABLE `rs_gallery_image`
  ADD CONSTRAINT `rs_gallery_image_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `rs_gallery_category` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
