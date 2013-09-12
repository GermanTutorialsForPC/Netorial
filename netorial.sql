-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 12. Sep 2013 um 20:40
-- Server Version: 5.5.29
-- PHP-Version: 5.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `netorial`
--
CREATE DATABASE IF NOT EXISTS `netorial` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `netorial`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `friendship`
--

CREATE TABLE IF NOT EXISTS `friendship` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `firstid` int(255) NOT NULL,
  `secondid` int(255) NOT NULL,
  `confired` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `groupData`
--

CREATE TABLE IF NOT EXISTS `groupData` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `groupName` varchar(60) NOT NULL,
  `admin` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `groupsRelation`
--

CREATE TABLE IF NOT EXISTS `groupsRelation` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `groupID` int(255) NOT NULL,
  `memberID` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `pageID` int(255) NOT NULL,
  `userID` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `loginlog`
--

CREATE TABLE IF NOT EXISTS `loginlog` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `userid` int(255) NOT NULL,
  `userip` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `messageService`
--

CREATE TABLE IF NOT EXISTS `messageService` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `fromUser` int(255) NOT NULL,
  `toUser` int(255) NOT NULL,
  `messageText` longtext NOT NULL,
  `sentOn` datetime NOT NULL,
  `readIt` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pinnwand`
--

CREATE TABLE IF NOT EXISTS `pinnwand` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `pwcontent` text NOT NULL,
  `userid` int(255) NOT NULL,
  `postOnUserID` int(255) NOT NULL,
  `poston` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `administraedFrom` int(255) NOT NULL,
  `type` int(1) NOT NULL,
  `profileName` varchar(255) NOT NULL,
  `profilInfos` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `prename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
