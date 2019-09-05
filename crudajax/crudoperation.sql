-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2019. Sze 05. 14:48
-- Kiszolgáló verziója: 10.1.39-MariaDB
-- PHP verzió: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `crudoperation`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `crudtable`
--

CREATE TABLE `crudtable` (
  `id` int(5) NOT NULL,
  `firstname` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `gender` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `country` varchar(100) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `crudtable`
--

INSERT INTO `crudtable` (`id`, `firstname`, `lastname`, `email`, `mobile`, `gender`, `country`) VALUES
(12, 'Leo ', 'Nardo', 'leo@gmail.com', '0620548464646', 'Male', 'Germany'),
(13, 'Michel', 'Angelo', 'michel@gmail.com', '0620816465465', 'Male', 'Ireland'),
(20, 'Rafa', 'Ello', 'rafa@gmail.com', '06208654646', 'Male', 'England'),
(21, 'Dona', 'Tello', 'dona@gmail.com', '06208654646', 'Female', 'Australia');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `crudtable`
--
ALTER TABLE `crudtable`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `crudtable`
--
ALTER TABLE `crudtable`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
