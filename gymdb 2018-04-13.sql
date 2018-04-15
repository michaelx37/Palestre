-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Apr 13, 2018 alle 10:35
-- Versione del server: 5.7.14
-- Versione PHP: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gymdb`
--
CREATE DATABASE IF NOT EXISTS `gymdb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `gymdb`;

-- --------------------------------------------------------

--
-- Struttura della tabella `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `gym_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comment` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `comments`
--

INSERT INTO `comments` (`comment_id`, `gym_id`, `user_id`, `comment`) VALUES
(1, 1, 2, 'BioRex in Godereccia'),
(2, 2, 2, 'BioRex in Goldenrain'),
(3, 1, 1, 'MrRage in Godereccia'),
(4, 2, 1, 'MrRage in Goldenrain');

-- --------------------------------------------------------

--
-- Struttura della tabella `gym_list`
--

CREATE TABLE `gym_list` (
  `gym_id` int(11) NOT NULL,
  `gym_name` varchar(255) NOT NULL,
  `gym_owner` varchar(255) DEFAULT NULL,
  `gym_location` varchar(255) DEFAULT NULL,
  `gym_coordinates` varchar(255) DEFAULT NULL,
  `gym_telephone` varchar(255) DEFAULT NULL,
  `gym_fax` varchar(255) DEFAULT NULL,
  `gym_website` varchar(255) DEFAULT NULL,
  `gym_mail` varchar(255) DEFAULT NULL,
  `gym_description` text,
  `gym_hours` varchar(255) DEFAULT NULL,
  `gym_icon` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `gym_list`
--

INSERT INTO `gym_list` (`gym_id`, `gym_name`, `gym_owner`, `gym_location`, `gym_coordinates`, `gym_telephone`, `gym_fax`, `gym_website`, `gym_mail`, `gym_description`, `gym_hours`, `gym_icon`) VALUES
(1, 'Godereccia', 'Guje', 'Favelas', NULL, NULL, NULL, NULL, NULL, 'Un po\' nigga', NULL, '/sub/Avatars/usertile43.bmp'),
(2, 'Goldenrain', 'Red', 'Fava', NULL, NULL, NULL, NULL, NULL, 'Umidiccia', NULL, '/sub/Avatars/usertile12.bmp'),
(3, 'Sector &beta;', 'BioRex', 'FZero', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile10.bmp'),
(4, 'Prova 0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(5, 'Prova 1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(6, 'Prova 2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(7, 'Prova 3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(8, 'Prova 4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(9, 'Prova 5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(10, 'Prova 6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(11, 'Prova 7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(12, 'Prova 8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(13, 'Prova 9', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(14, 'Prova 10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(15, 'Prova 11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(16, 'Prova 12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(17, 'Prova 13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(18, 'Prova 14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(19, 'Prova 15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(20, 'Prova 16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(21, 'Prova 17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(22, 'Prova 18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(23, 'Prova 19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(24, 'Prova 20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(25, 'Prova 21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(26, 'Prova 22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(27, 'Prova 23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(28, 'Prova 24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(29, 'Prova 25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(30, 'Prova 26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(31, 'Prova 27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(32, 'Prova 28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(33, 'Prova 29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(34, 'Prova 30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(35, 'Prova 31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(36, 'Prova 32', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(37, 'Prova 33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(38, 'Prova 34', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(39, 'Prova 35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(40, 'Prova 36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(41, 'Prova 37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(42, 'Prova 38', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(43, 'Prova 39', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(44, 'Prova 40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(45, 'Prova 41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(46, 'Prova 42', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(47, 'Prova 43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(48, 'Prova 44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(49, 'Prova 45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(50, 'Prova 46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(51, 'Prova 47', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(52, 'Prova 48', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(53, 'Prova 49', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(54, 'Prova 50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(55, 'Prova 51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(56, 'Prova 52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(57, 'Prova 53', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(58, 'Prova 54', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(59, 'Prova 55', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(60, 'Prova 56', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(61, 'Prova 57', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(62, 'Prova 58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp'),
(63, 'Prova 59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/sub/Avatars/usertile13.bmp');

-- --------------------------------------------------------

--
-- Struttura della tabella `gym_reviews`
--

CREATE TABLE `gym_reviews` (
  `review_id` int(11) NOT NULL,
  `gym_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `rating` float(5,1) DEFAULT NULL,
  `comment` text,
  `first_review` timestamp NULL DEFAULT NULL,
  `modified_review` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `gym_reviews`
--

INSERT INTO `gym_reviews` (`review_id`, `gym_id`, `user_id`, `rating`, `comment`, `first_review`, `modified_review`) VALUES
(1, 1, 1, 5.0, 'MrRage in Godereccia', '2018-04-10 17:34:00', NULL),
(2, 2, 1, 2.0, 'MrRage in Goldenrain', '2018-04-10 17:35:00', NULL),
(3, 1, 2, 4.0, 'BioRex in Godereccia', '2018-04-10 17:36:00', NULL),
(4, 2, 2, 2.0, 'BioRex in Goldenrain', '2018-04-10 17:37:00', NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `ratings`
--

CREATE TABLE `ratings` (
  `rating_id` int(11) NOT NULL,
  `gym_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `rating` float(5,1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `ratings`
--

INSERT INTO `ratings` (`rating_id`, `gym_id`, `user_id`, `rating`) VALUES
(1, 1, 1, 5.0),
(2, 1, 2, 4.0),
(3, 2, 1, 2.0),
(4, 2, 2, 1.0);

-- --------------------------------------------------------

--
-- Struttura della tabella `user_list`
--

CREATE TABLE `user_list` (
  `user_id` int(11) NOT NULL,
  `user_nickname` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_login_token` varchar(255) DEFAULT NULL,
  `user_last_login` timestamp NULL DEFAULT NULL,
  `user_last_login_temp` timestamp NULL DEFAULT NULL,
  `user_last_name` varchar(255) NOT NULL,
  `user_first_name` varchar(255) NOT NULL,
  `user_bday` smallint(6) DEFAULT NULL,
  `user_gender` varchar(255) NOT NULL,
  `user_mail` varchar(255) DEFAULT NULL,
  `user_avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `user_list`
--

INSERT INTO `user_list` (`user_id`, `user_nickname`, `user_password`, `user_login_token`, `user_last_login`, `user_last_login_temp`, `user_last_name`, `user_first_name`, `user_bday`, `user_gender`, `user_mail`, `user_avatar`) VALUES
(1, 'MrRage', '147147', NULL, '2018-04-11 07:20:38', '2018-04-11 07:20:38', 'R D', 'Mic', 26, 'maschio', '', '/sub/Avatars/usertile16.bmp'),
(2, 'BioRex', '147147', NULL, '2018-04-11 07:21:10', '2018-04-13 08:34:19', 'F', 'Zero', 20, 'maschio', '', '/sub/Avatars/usertile16.bmp');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `gym_id` (`gym_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indici per le tabelle `gym_list`
--
ALTER TABLE `gym_list`
  ADD PRIMARY KEY (`gym_id`);

--
-- Indici per le tabelle `gym_reviews`
--
ALTER TABLE `gym_reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `gym_id` (`gym_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indici per le tabelle `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `gym_id` (`gym_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indici per le tabelle `user_list`
--
ALTER TABLE `user_list`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT per la tabella `gym_list`
--
ALTER TABLE `gym_list`
  MODIFY `gym_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT per la tabella `gym_reviews`
--
ALTER TABLE `gym_reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT per la tabella `ratings`
--
ALTER TABLE `ratings`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT per la tabella `user_list`
--
ALTER TABLE `user_list`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`gym_id`) REFERENCES `gym_list` (`gym_id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user_list` (`user_id`);

--
-- Limiti per la tabella `gym_reviews`
--
ALTER TABLE `gym_reviews`
  ADD CONSTRAINT `gym_reviews_ibfk_1` FOREIGN KEY (`gym_id`) REFERENCES `gym_list` (`gym_id`),
  ADD CONSTRAINT `gym_reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user_list` (`user_id`);

--
-- Limiti per la tabella `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`gym_id`) REFERENCES `gym_list` (`gym_id`),
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user_list` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
