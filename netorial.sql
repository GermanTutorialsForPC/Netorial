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

--
-- Daten für Tabelle `friendship`
--

INSERT INTO `friendship` (`id`, `firstid`, `secondid`, `confired`) VALUES
(1, 1, 2, 1),
(2, 1, 3, 1);

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

--
-- Daten für Tabelle `groupData`
--

INSERT INTO `groupData` (`id`, `groupName`, `admin`) VALUES
(1, 'Gruppe 1', 1);

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

--
-- Daten für Tabelle `groupsRelation`
--

INSERT INTO `groupsRelation` (`id`, `groupID`, `memberID`) VALUES
(1, 1, 1);

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

--
-- Daten für Tabelle `likes`
--

INSERT INTO `likes` (`id`, `pageID`, `userID`) VALUES
(1, 6, 1);

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

--
-- Daten für Tabelle `loginlog`
--

INSERT INTO `loginlog` (`id`, `userid`, `userip`) VALUES
(1, 1, '::1'),
(2, 1, '::1'),
(3, 3, '::1'),
(4, 1, '::1'),
(5, 1, '::1'),
(6, 1, '::1'),
(7, 1, '::1'),
(8, 1, '::1'),
(9, 1, '::1');

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

--
-- Daten für Tabelle `messageService`
--

INSERT INTO `messageService` (`id`, `fromUser`, `toUser`, `messageText`, `sentOn`, `readIt`) VALUES
(3, 1, 3, 'Hallo', '2013-05-10 17:36:03', 1);

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

--
-- Daten für Tabelle `pinnwand`
--

INSERT INTO `pinnwand` (`id`, `pwcontent`, `userid`, `postOnUserID`, `poston`) VALUES
(1, 'Test', 1, 1, '2012-08-13 19:16:34'),
(2, 'Test 2', 1, 1, '2012-08-13 17:24:06'),
(3, 'Test 3', 1, 1, '2012-08-13 19:27:31'),
(4, 'Hallo, ich bin ein neuer Test', 1, 1, '2012-12-16 15:27:02'),
(5, 'Hallo, ich bin ein neuer Test, zum 2.', 1, 1, '2012-12-16 16:04:08'),
(6, 'Dies ist ein Testlauf', 1, 1, '2012-12-16 16:04:22'),
(7, 'Hallo', 1, 2, '2012-12-16 16:04:38');

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

--
-- Daten für Tabelle `profile`
--

INSERT INTO `profile` (`id`, `administraedFrom`, `type`, `profileName`, `profilInfos`) VALUES
(1, 1, 1, 'German Tutorial For PC', 'Musik:<br>Alles -_-_-_:-_:->|-#*## <br> Genutzte Software: <br>Dreamweaver -_-_-_:-_:->|-#*## <br> Gibt Tutorials in: <br>Alles rund um dem PC -_-_-_:-_:->|-#*## <br>Braucht Hilfe in: <br>Schokoladenherstellunge -_-_-_:-_:->|-#*## <br> Sonstiges: <br>Mag Schokolade :-)'),
(2, 4, 1, 'Test User', ''),
(3, 2, 1, 'Test User', ''),
(4, 3, 1, 'Testerich Userrich', ''),
(6, 1, 2, 'German Tutorials For PC', '&Uuml;ber uns:<br>ich machen HD Tutorials auf YouTube -_-_-_:-_:->|-#*## <br> Website: <br><a href="http://www.gertuts-forpc.tk">http://www.gertuts-forpc.tk</a>');

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

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `prename`, `lastname`, `email`, `password`) VALUES
(1, 'German Tutorials', 'For PC ', 'gertuts.forpc@googlemail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(2, 'Test', 'User', 'test@me.com', '81dc9bdb52d04dc20036dbd8313ed055'),
(3, 'Testerich', 'Userrich', 'test2@me.com', '81dc9bdb52d04dc20036dbd8313ed055'),
(4, 'Test', 'User', 'test3@me.com', '25d55ad283aa400af464c76d713c07ad');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
