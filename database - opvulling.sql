-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 05 Jan 2011 om 10:49
-- Serverversie: 5.1.41
-- PHP-Versie: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `webschool`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `class`
--

CREATE TABLE IF NOT EXISTS `class` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(8) NOT NULL,
  `fullname` varchar(32) DEFAULT NULL,
  `mentor` varchar(16) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Gegevens worden uitgevoerd voor tabel `class`
--

INSERT INTO `class` (`id`, `name`, `fullname`, `mentor`) VALUES
(1, 'mt1', 'MT1', NULL),
(2, 'mt2', 'MT2', NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `file`
--

CREATE TABLE IF NOT EXISTS `file` (
  `id` int(8) NOT NULL,
  `path` varchar(64) NOT NULL,
  `size` int(32) NOT NULL,
  `fullname` varchar(64) NOT NULL,
  `owner` int(4) NOT NULL,
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `path` (`path`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden uitgevoerd voor tabel `file`
--


-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(16) NOT NULL,
  `fullname` varchar(32) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Gegevens worden uitgevoerd voor tabel `role`
--

INSERT INTO `role` (`id`, `name`, `fullname`) VALUES
(1, 'leerling', 'Leerling'),
(2, 'docent', 'Docent'),
(3, 'medewerker', 'Medewerker');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `role` int(2) NOT NULL DEFAULT '1',
  `class` int(2) DEFAULT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(128) NOT NULL,
  `lastlogin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `firstname` varchar(128) NOT NULL,
  `lastname` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `phone` varchar(128) DEFAULT NULL,
  `mobilephone` varchar(128) DEFAULT NULL,
  UNIQUE KEY `id` (`id`,`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Gegevens worden uitgevoerd voor tabel `user`
--

INSERT INTO `user` (`id`, `role`, `class`, `username`, `password`, `lastlogin`, `firstname`, `lastname`, `email`, `phone`, `mobilephone`) VALUES
(1, 1, 2, 'Danny', '092d994149c78a053e2f28f0d8681c0e', '2011-01-05 10:30:47', 'Danny', 'Kriger', 'danny@kriger.nl', '0206331538', '0624817446'),
(2, 1, 1, 'Henk', '0d1c664bc5f1b11cd5f969bc58efdc96', '2011-01-05 10:29:28', 'Henk', 'Ankerman', 'mathijs@bernson.eu', '0200000000', '0630107711'),
(3, 1, 2, 'Farid', '0d1c664bc5f1b11cd5f969bc58efdc96', '2011-01-05 10:38:07', 'Karel', 'Ankerman', 'f.elnasire@vividwebsystems.nl', '0200000000', '0631694246');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
