-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Gegenereerd op: 12 okt 2016 om 23:02
-- Serverversie: 5.6.17
-- PHP-versie: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `videotheek`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `acteur`
--

CREATE TABLE IF NOT EXISTS `acteur` (
  `idActeur` int(11) NOT NULL,
  `naam` varchar(45) NOT NULL,
  PRIMARY KEY (`idActeur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `acteur`
--

INSERT INTO `acteur` (`idActeur`, `naam`) VALUES
(1, 'Christian Bale'),
(2, 'Ben Affleck');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestelling`
--

CREATE TABLE IF NOT EXISTS `bestelling` (
  `idBestelling` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `idVideo` int(11) NOT NULL,
  `idKlant` int(11) NOT NULL,
  `afleverdatum` date NOT NULL,
  `prijs` float NOT NULL,
  PRIMARY KEY (`idBestelling`),
  KEY `Fk_Bestelling_Videos_idx` (`idVideo`),
  KEY `Fk_Bestelling_Users_idx` (`idKlant`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Gegevens worden geëxporteerd voor tabel `bestelling`
--

INSERT INTO `bestelling` (`idBestelling`, `idVideo`, `idKlant`, `afleverdatum`, `prijs`) VALUES
(1, 1, 11, '0000-00-00', 9.5),
(2, 1, 11, '2016-10-14', 9.5),
(3, 1, 11, '2016-10-22', 9.5);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `genre`
--

CREATE TABLE IF NOT EXISTS `genre` (
  `idGenre` int(11) NOT NULL,
  `Genre` varchar(100) NOT NULL,
  PRIMARY KEY (`idGenre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `genre`
--

INSERT INTO `genre` (`idGenre`, `Genre`) VALUES
(1, 'Action'),
(2, 'Adventure');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klachten`
--

CREATE TABLE IF NOT EXISTS `klachten` (
  `idKlacht` int(11) NOT NULL,
  `idKlant` int(11) NOT NULL,
  `klacht` varchar(255) NOT NULL,
  PRIMARY KEY (`idKlacht`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `idKlant` int(11) NOT NULL AUTO_INCREMENT,
  `naam` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `adres` varchar(45) NOT NULL,
  `woonplaats` varchar(45) NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `geblokkeerd` tinyint(1) NOT NULL DEFAULT '0',
  `activatiedatum` datetime NOT NULL,
  `userrole` enum('klant','bezorger','baliemedewerker','eigenaar','admin') NOT NULL DEFAULT 'klant',
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`idKlant`),
  UNIQUE KEY `emailadres_UNIQUE` (`email`),
  UNIQUE KEY `adresregel1_UNIQUE` (`adres`),
  UNIQUE KEY `adres` (`adres`),
  UNIQUE KEY `adres_2` (`adres`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Gegevens worden geëxporteerd voor tabel `login`
--

INSERT INTO `login` (`idKlant`, `naam`, `email`, `adres`, `woonplaats`, `activated`, `geblokkeerd`, `activatiedatum`, `userrole`, `password`) VALUES
(11, 'Klant de Klant', 'klant@mail.nl', 'klantadres 1', 'klantstad', 1, 0, '2016-10-12 20:15:24', 'klant', '202cb962ac59075b964b07152d234b70'),
(12, 'Admin de Admin', 'admin@mail.nl', 'Adminstraat 1', 'Adminstad', 1, 0, '2016-10-12 20:16:06', 'admin', '202cb962ac59075b964b07152d234b70'),
(14, 'Bezorger de Bezorger', 'bezorger@mail.nl', 'Bezorgeradres 1', 'Bezorgerstad', 1, 0, '2016-10-12 20:17:35', 'bezorger', '202cb962ac59075b964b07152d234b70'),
(15, 'Baliemedewerker de Baliemedewerker', 'baliemedewerker@mail.nl', 'Baliemedewerkeradres 1', 'Baliemedewerkerstad', 1, 0, '2016-10-12 20:18:52', 'baliemedewerker', '202cb962ac59075b964b07152d234b70'),
(16, 'Eigenaar de Eigenaar', 'eigenaar@mail.nl', 'Eigenaarstraat 1', 'Eigenaarstad', 1, 0, '2016-10-12 20:19:26', 'eigenaar', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `reservering`
--

CREATE TABLE IF NOT EXISTS `reservering` (
  `idReservering` int(11) NOT NULL,
  `idKlant` int(11) NOT NULL,
  `idVideo` int(11) NOT NULL,
  PRIMARY KEY (`idReservering`,`idKlant`,`idVideo`),
  KEY `Fk_Reserveringen_Klant_idx` (`idKlant`),
  KEY `Fk_Reserveringen_Video_idx` (`idVideo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `video`
--

CREATE TABLE IF NOT EXISTS `video` (
  `idVideo` int(11) NOT NULL,
  `titel` varchar(45) NOT NULL,
  `beschrijving` varchar(255) NOT NULL,
  `fotopad` varchar(100) NOT NULL,
  `prijs` float NOT NULL DEFAULT '7.5',
  `aantalBeschikbaar` int(11) NOT NULL,
  PRIMARY KEY (`idVideo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `video`
--

INSERT INTO `video` (`idVideo`, `titel`, `beschrijving`, `fotopad`, `prijs`, `aantalBeschikbaar`) VALUES
(1, 'The Dark Knight', 'When the menace known as the Joker wreaks havoc and chaos on the people of Gotham, the caped crusader must come to terms with one of the greatest psychological tests of his ability to fight injustice.', 'the_dark_knight.jpg', 7.5, 12),
(2, 'Batman VS Superman: Dawn Of Justice', 'Fearing that the actions of Superman are left unchecked, Batman takes on the Man of Steel, while the world wrestles with what kind of a hero it really needs.', 'batman_vs_superman.jpg', 7.5, 10),
(3, 'Captain America: Civil War', 'Political interference in the Avengers'' activities causes a rift between former allies Captain America and Iron Man.', 'captain_america_civil_war.jpg', 7.5, 0),
(4, 'Frozen', 'When the newly crowned Queen Elsa accidentally uses her power to turn things into ice to curse her home in infinite winter, her sister, Anna, teams up with a mountain man, his playful reindeer, and a snowman to change the weather condition.', 'frozen.jpg', 7.5, 0),
(5, 'Inception', 'A thief, who steals corporate secrets through use of dream-sharing technology, is given the inverse task of planting an idea into the mind of a CEO.', 'inception.jpg', 7.5, 0),
(6, 'Interstellar', 'A team of explorers travel through a wormhole in space in an attempt to ensure humanity''s survival.', 'Interstellar.jpg', 7.5, 0),
(7, 'Se7en', 'Two detectives, a rookie and a veteran, hunt a serial killer who uses the seven deadly sins as his modus operandi.', 'se7en.jpg', 7.5, 0),
(8, 'Zootopia', 'In a city of anthropomorphic animals, a rookie bunny cop and a cynical con artist fox must work together to uncover a conspiracy.', 'zootopia.jpg', 7.5, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `videoacteur`
--

CREATE TABLE IF NOT EXISTS `videoacteur` (
  `idVideoActeur` int(11) NOT NULL,
  `idVideo` int(11) NOT NULL,
  `idActeur` int(11) NOT NULL,
  PRIMARY KEY (`idVideoActeur`),
  KEY `Fk_VideoActeur_Videos_idx` (`idVideo`),
  KEY `Fk_VideoActeur_Acteur_idx` (`idActeur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `videoacteur`
--

INSERT INTO `videoacteur` (`idVideoActeur`, `idVideo`, `idActeur`) VALUES
(1, 1, 1),
(2, 2, 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `videogenre`
--

CREATE TABLE IF NOT EXISTS `videogenre` (
  `idVideoGenre` int(11) NOT NULL,
  `idVideo` int(11) NOT NULL,
  `idGenre` int(11) NOT NULL,
  PRIMARY KEY (`idVideoGenre`),
  KEY `Fk_VideoGenre_Genre_idx` (`idGenre`),
  KEY `Fk_VideoGenre_Videos_idx` (`idVideo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `videogenre`
--

INSERT INTO `videogenre` (`idVideoGenre`, `idVideo`, `idGenre`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 1),
(4, 2, 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `winkelmand`
--

CREATE TABLE IF NOT EXISTS `winkelmand` (
  `idWinkelmand` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `idVideo` int(11) NOT NULL,
  `titel` varchar(50) NOT NULL,
  `idKlant` int(11) NOT NULL,
  `prijs` float NOT NULL,
  PRIMARY KEY (`idWinkelmand`),
  KEY `Fk_Winkelmand_Video_idx` (`idVideo`),
  KEY `Fk_Winkelmand_Users_idx` (`idKlant`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `reservering`
--
ALTER TABLE `reservering`
  ADD CONSTRAINT `Fk_Reserveringen_Video` FOREIGN KEY (`idVideo`) REFERENCES `video` (`idVideo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `videoacteur`
--
ALTER TABLE `videoacteur`
  ADD CONSTRAINT `Fk_VideoActeur_Acteur` FOREIGN KEY (`idActeur`) REFERENCES `acteur` (`idActeur`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Fk_VideoActeur_Videos` FOREIGN KEY (`idVideo`) REFERENCES `video` (`idVideo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `videogenre`
--
ALTER TABLE `videogenre`
  ADD CONSTRAINT `Fk_VideoGenre_Genre` FOREIGN KEY (`idGenre`) REFERENCES `genre` (`idGenre`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Fk_VideoGenre_Videos` FOREIGN KEY (`idVideo`) REFERENCES `video` (`idVideo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
