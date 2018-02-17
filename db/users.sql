
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Июл 01 2017 г., 10:41
-- Версия сервера: 10.1.24-MariaDB
-- Версия PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `user1`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `nick` varchar(40) NOT NULL,
  `skype` varchar(50) NOT NULL,
  `icq` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` int(11) NOT NULL,
  `goal` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `language` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `visitedtime` datetime NOT NULL,
  `ip` varchar(20) NOT NULL,
  PRIMARY KEY (`ip`),
  KEY `language` (`language`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
