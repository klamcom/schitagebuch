-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 22. Jan 2024 um 20:51
-- Server-Version: 10.4.32-MariaDB
-- PHP-Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `skitagedb`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tblskitag`
--

CREATE TABLE `tblskitag` (
  `id` int(11) NOT NULL,
  `fkUserId` int(11) NOT NULL,
  `skigebiet` varchar(100) NOT NULL,
  `datum` date NOT NULL,
  `startzeit` time NOT NULL,
  `endezeit` time NOT NULL,
  `kommentar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `tblskitag`
--

INSERT INTO `tblskitag` (`id`, `fkUserId`, `skigebiet`, `datum`, `startzeit`, `endezeit`, `kommentar`) VALUES
(1, 1, 'Forsteralm', '2024-01-03', '09:00:00', '17:00:00', 'Viel Sonne, aber wenig Schnee'),
(3, 1, 'Forsteralm', '2024-01-04', '08:00:00', '17:00:00', 'Auf der Hütte war mittags sehr viel los.'),
(4, 3, 'Glasenberg', '2024-01-10', '11:00:00', '14:00:00', 'Nur mehr sehr wenig Schnee'),
(10, 1, 'Glasenberg', '2024-01-08', '10:00:00', '17:00:00', 'Cool wars schon'),
(11, 1, 'Haus im Ennstal', '2024-01-11', '08:00:00', '17:00:00', 'Die Piste und das Wetter waren wunderschön!'),
(12, 4, 'Postalm Gosau', '2024-01-12', '09:00:00', '15:00:00', 'Ich kann gar nicht Schifahren!');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbluser`
--

CREATE TABLE `tbluser` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `vorname` varchar(64) NOT NULL,
  `nachname` varchar(64) NOT NULL,
  `mypassword` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `tbluser`
--

INSERT INTO `tbluser` (`id`, `email`, `vorname`, `nachname`, `mypassword`, `role`) VALUES
(1, 'markus@klausriegler.org', 'Markus', 'Klausriegler', '$2y$10$qU9jAPUBU5JB4HsXqtjq9eJ/9Q2ZZJHRaxEPr/lE0CAnZE9GqJmma', ''),
(2, 'admin@klausriegler.org', 'Max', 'Klausriegler', '$2y$10$NzEI09Tf/SMwkKS1K/Vy3O4NXQH3UgBVp3xy/rcPSHUUFaDKMaqV.', 'admin'),
(3, 'niklas@klausriegler.org', 'Niklas', 'Klausriegler', '$2y$10$IfCn1ENfWXheBB9GXpKQOu9yrnmo3hNQcSD38kQTOW8KL/swPN63O', ''),
(4, 'henrik@klausriegler.org', 'Henrik', 'Klausriegler', '$2y$10$EzdofkKRsgsZd9/ASWT5AOntIuoRM6/W4tlz0Q2poD4tvI6dPAtle', '');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `tblskitag`
--
ALTER TABLE `tblskitag`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `fkUserId` (`fkUserId`);

--
-- Indizes für die Tabelle `tbluser`
--
ALTER TABLE `tbluser`
  ADD UNIQUE KEY `id` (`id`) USING BTREE;

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `tblskitag`
--
ALTER TABLE `tblskitag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT für Tabelle `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `tblskitag`
--
ALTER TABLE `tblskitag`
  ADD CONSTRAINT `tblskitag_ibfk_1` FOREIGN KEY (`fkUserId`) REFERENCES `tbluser` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
