-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Värd: localhost
-- Tid vid skapande: 11 dec 2015 kl 12:53
-- Serverversion: 5.6.21
-- PHP-version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databas: `bettan`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `bets`
--

CREATE TABLE IF NOT EXISTS `bets` (
`bet_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tournament_id` int(11) NOT NULL,
  `goal` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `bets`
--

INSERT INTO `bets` (`bet_id`, `game_id`, `team_id`, `user_id`, `tournament_id`, `goal`) VALUES
(9, 4, 17, 7, 1, 2),
(10, 5, 18, 7, 1, 1);

-- --------------------------------------------------------

--
-- Tabellstruktur `games`
--

CREATE TABLE IF NOT EXISTS `games` (
`game_id` int(11) NOT NULL,
  `game_number` int(11) NOT NULL,
  `team_name` varchar(255) NOT NULL,
  `home_team` text NOT NULL,
  `game_date` varchar(30) NOT NULL,
  `game_time` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `games`
--

INSERT INTO `games` (`game_id`, `game_number`, `team_name`, `home_team`, `game_date`, `game_time`) VALUES
(4, 1, 'France', 'true', '2016-01-01', '10:10'),
(5, 1, 'Sweden', 'false', '2016-01-01', '10:10'),
(6, 2, 'Tyskland', 'true', '2016-02-28', '10:10'),
(7, 2, 'Italy', 'false', '2016-01-01', '10:10'),
(8, 3, 'Ukraine', 'true', '2015-12-10', '10:10'),
(9, 3, 'Austria', 'false', '2015-12-10', '10:10');

-- --------------------------------------------------------

--
-- Tabellstruktur `goals`
--

CREATE TABLE IF NOT EXISTS `goals` (
`goal_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `goal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellstruktur `teams`
--

CREATE TABLE IF NOT EXISTS `teams` (
`team_id` int(11) NOT NULL,
  `team_name` varchar(255) NOT NULL,
  `group_nr` varchar(255) NOT NULL,
  `team_flag` varchar(255) NOT NULL,
  `team_points` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `teams`
--

INSERT INTO `teams` (`team_id`, `team_name`, `group_nr`, `team_flag`, `team_points`) VALUES
(17, 'France', 'A', 'FRA.png', 0),
(18, 'Sweden', 'B', 'SWE.png', 0),
(19, 'England', 'A', 'ENG.png', 0),
(20, 'Ireland', 'C', 'IRL.png', 0),
(21, 'Spain', 'C', 'ESP.png', 0);

-- --------------------------------------------------------

--
-- Tabellstruktur `tournament`
--

CREATE TABLE IF NOT EXISTS `tournament` (
`tournament_id` int(11) NOT NULL,
  `tournament_name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tournament_text` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `tournament`
--

INSERT INTO `tournament` (`tournament_id`, `tournament_name`, `user_id`, `tournament_text`) VALUES
(1, 'Eriks Liga', 7, 'Tjenare mannen!'),
(2, 'Eriks Liga', 7, 'Tjenare mannen!'),
(3, 'Lisa Hawks', 1, ''),
(4, 'Galna gänget', 1, ''),
(5, 'Goofy', 1, '');

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `admin` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_password`, `user_email`, `admin`) VALUES
(1, 'lisaadmin', 'drug6bAx!', 'lisahjarpe@hotmail.com', 'true'),
(5, 'lisafisa', 'drug6bAx!', 'lisahjarpe@gmail.com', 'false'),
(7, 'erik', 'hiho1234', 'erik.elmehed@live.se', 'false');

-- --------------------------------------------------------

--
-- Tabellstruktur `user_tournaments`
--

CREATE TABLE IF NOT EXISTS `user_tournaments` (
`user_tournaments_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `tournament_id` int(11) NOT NULL,
  `user_points` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `user_tournaments`
--

INSERT INTO `user_tournaments` (`user_tournaments_id`, `user_id`, `user_name`, `tournament_id`, `user_points`) VALUES
(1, 7, 'erik', 2, 0),
(2, 1, 'lisaadmin', 3, 0),
(3, 1, 'lisaadmin', 4, 0),
(4, 1, 'lisaadmin', 5, 0);

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `bets`
--
ALTER TABLE `bets`
 ADD PRIMARY KEY (`bet_id`), ADD UNIQUE KEY `bet_id` (`bet_id`);

--
-- Index för tabell `games`
--
ALTER TABLE `games`
 ADD PRIMARY KEY (`game_id`), ADD UNIQUE KEY `game_id` (`game_id`);

--
-- Index för tabell `goals`
--
ALTER TABLE `goals`
 ADD PRIMARY KEY (`goal_id`);

--
-- Index för tabell `teams`
--
ALTER TABLE `teams`
 ADD PRIMARY KEY (`team_id`), ADD UNIQUE KEY `team_id` (`team_id`);

--
-- Index för tabell `tournament`
--
ALTER TABLE `tournament`
 ADD PRIMARY KEY (`tournament_id`), ADD UNIQUE KEY `tournament_id` (`tournament_id`);

--
-- Index för tabell `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_id`), ADD UNIQUE KEY `user_id` (`user_id`,`user_name`);

--
-- Index för tabell `user_tournaments`
--
ALTER TABLE `user_tournaments`
 ADD PRIMARY KEY (`user_tournaments_id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `bets`
--
ALTER TABLE `bets`
MODIFY `bet_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT för tabell `games`
--
ALTER TABLE `games`
MODIFY `game_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT för tabell `goals`
--
ALTER TABLE `goals`
MODIFY `goal_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT för tabell `teams`
--
ALTER TABLE `teams`
MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT för tabell `tournament`
--
ALTER TABLE `tournament`
MODIFY `tournament_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT för tabell `users`
--
ALTER TABLE `users`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT för tabell `user_tournaments`
--
ALTER TABLE `user_tournaments`
MODIFY `user_tournaments_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
