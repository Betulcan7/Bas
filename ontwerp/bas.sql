-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 16 mei 2024 om 14:53
-- Serverversie: 10.4.25-MariaDB
-- PHP-versie: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bas`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `artikel`
--

CREATE TABLE `artikel` (
  `artId` int(11) NOT NULL,
  `artOmschrijving` varchar(12) NOT NULL,
  `artInkoop` decimal(5,2) NOT NULL,
  `artVerkoop` decimal(5,2) NOT NULL,
  `artVoorraad` int(11) NOT NULL,
  `artMinVoorraad` int(11) NOT NULL,
  `artMaxVoorraad` int(11) NOT NULL,
  `artLocatie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `artikel`
--

INSERT INTO `artikel` (`artId`, `artOmschrijving`, `artInkoop`, `artVerkoop`, `artVoorraad`, `artMinVoorraad`, `artMaxVoorraad`, `artLocatie`) VALUES
(1, 'Laptop', '799.99', '999.99', 10, 5, 20, 101),
(2, 'Smartphone', '399.99', '499.99', 15, 8, 25, 102),
(3, 'Monitor', '199.99', '249.99', 20, 10, 30, 103);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `inkooporder`
--

CREATE TABLE `inkooporder` (
  `inkOrdId` int(11) NOT NULL,
  `levId` int(11) NOT NULL,
  `artId` int(11) NOT NULL,
  `inkOrdDatum` date NOT NULL,
  `inkOrdBestAantal` int(11) NOT NULL,
  `inkOrdStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `inkooporder`
--

INSERT INTO `inkooporder` (`inkOrdId`, `levId`, `artId`, `inkOrdDatum`, `inkOrdBestAantal`, `inkOrdStatus`) VALUES
(1, 1, 1, '2024-04-26', 50, 0),
(2, 2, 2, '2024-04-27', 30, 1),
(3, 3, 3, '2024-04-28', 20, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klant`
--

CREATE TABLE `klant` (
  `klantId` int(11) NOT NULL,
  `klantNaam` varchar(20) NOT NULL,
  `klantEmail` varchar(30) NOT NULL,
  `klantAdres` varchar(30) NOT NULL,
  `klantPostcode` varchar(6) NOT NULL,
  `klantWoonplaats` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `klant`
--

INSERT INTO `klant` (`klantId`, `klantNaam`, `klantEmail`, `klantAdres`, `klantPostcode`, `klantWoonplaats`) VALUES
(1, 'Jan Jansen', 'jan@example.com', 'Hoofdstraat 1', '1234AB', 'Amsterdam'),
(2, 'Piet Pietersen', 'piet@example.com', 'Kerkweg 5', '5678CD', 'Utrecht'),
(3, 'Marieke de Vries', 'marieke@example.com', 'Dorpsstraat 10', '9012EF', 'Rotterdam');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `leverancier`
--

CREATE TABLE `leverancier` (
  `levId` int(11) NOT NULL,
  `levNaam` varchar(15) NOT NULL,
  `levContact` varchar(20) NOT NULL,
  `levEmail` varchar(30) NOT NULL,
  `levAdres` varchar(30) NOT NULL,
  `levPostcode` varchar(6) NOT NULL,
  `levWoonplaats` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `leverancier`
--

INSERT INTO `leverancier` (`levId`, `levNaam`, `levContact`, `levEmail`, `levAdres`, `levPostcode`, `levWoonplaats`) VALUES
(1, 'TechSupply', 'Jan Jansen', 'jan@example.com', '123 Hoofdstraat', '1234AB', 'Rotterdam'),
(2, 'ElectroWorld', 'Eva de Vries', 'eva@example.com', '456 Eikenlaan', '5678CD', 'Rotterdam');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `verkooporder`
--

CREATE TABLE `verkooporder` (
  `verkOrdId` int(11) NOT NULL,
  `klantId` int(11) NOT NULL,
  `artId` int(11) NOT NULL,
  `verkOrdDatum` date NOT NULL,
  `verkOrdBestAantal` int(11) NOT NULL,
  `verkOrdStatus` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `verkooporder`
--

INSERT INTO `verkooporder` (`verkOrdId`, `klantId`, `artId`, `verkOrdDatum`, `verkOrdBestAantal`, `verkOrdStatus`) VALUES
(10, 1, 1, '2024-04-26', 5, 1),
(11, 2, 2, '2024-04-27', 3, 1),
(12, 3, 3, '2024-04-28', 2, 1);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`artId`);

--
-- Indexen voor tabel `inkooporder`
--
ALTER TABLE `inkooporder`
  ADD PRIMARY KEY (`inkOrdId`),
  ADD UNIQUE KEY `levId` (`levId`),
  ADD UNIQUE KEY `artId` (`artId`);

--
-- Indexen voor tabel `klant`
--
ALTER TABLE `klant`
  ADD PRIMARY KEY (`klantId`);

--
-- Indexen voor tabel `leverancier`
--
ALTER TABLE `leverancier`
  ADD PRIMARY KEY (`levId`);

--
-- Indexen voor tabel `verkooporder`
--
ALTER TABLE `verkooporder`
  ADD PRIMARY KEY (`verkOrdId`),
  ADD UNIQUE KEY `klantId` (`klantId`),
  ADD UNIQUE KEY `artId` (`artId`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `artikel`
--
ALTER TABLE `artikel`
  MODIFY `artId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `inkooporder`
--
ALTER TABLE `inkooporder`
  MODIFY `inkOrdId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `klant`
--
ALTER TABLE `klant`
  MODIFY `klantId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `leverancier`
--
ALTER TABLE `leverancier`
  MODIFY `levId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `verkooporder`
--
ALTER TABLE `verkooporder`
  MODIFY `verkOrdId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
