-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2025. Sze 10. 09:45
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `utazasteszt`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cost`
--

CREATE TABLE `cost` (
  `id` int(11) NOT NULL,
  `category` enum('accommodation','transport','food','activity','other') NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `currency` varchar(10) NOT NULL,
  `date` date DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `route_id` int(11) DEFAULT NULL,
  `dest_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `cost`
--

INSERT INTO `cost` (`id`, `category`, `amount`, `currency`, `date`, `user_id`, `route_id`, `dest_id`) VALUES
(1, 'accommodation', 200.00, 'EUR', '2025-06-02', 1, 1, 1),
(2, 'transport', 120.50, 'EUR', '2025-06-03', 1, 1, 2),
(3, 'food', 75.00, 'EUR', '2025-06-04', 1, 1, 3);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `destination`
--

CREATE TABLE `destination` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `country` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `coords` point DEFAULT NULL,
  `is_global` tinyint(1) DEFAULT 0,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `destination`
--

INSERT INTO `destination` (`id`, `name`, `country`, `description`, `coords`, `is_global`, `user_id`) VALUES
(1, 'Budapest', 'Hungary', 'Főváros, gazdag történelmi és kulturális látnivalókkal.', NULL, 1, NULL),
(2, 'Paris', 'France', 'A szerelem városa, Eiffel-torony, Louvre, Notre Dame.', NULL, 1, NULL),
(3, 'Custom Beach', 'Spain', 'Egyéni célpont, kedvenc tengerpart.', NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `type` enum('email','push','popup') NOT NULL,
  `threshold` decimal(10,2) DEFAULT NULL,
  `channel` varchar(50) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `notification`
--

INSERT INTO `notification` (`id`, `type`, `threshold`, `channel`, `user_id`) VALUES
(1, 'email', 100.00, 'gmail', 1),
(2, 'push', 50.00, 'mobile', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `pricewatch`
--

CREATE TABLE `pricewatch` (
  `id` int(11) NOT NULL,
  `item_type` enum('flight','hotel','program') NOT NULL,
  `item_id` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `pricewatch`
--

INSERT INTO `pricewatch` (`id`, `item_type`, `item_id`, `price`, `date`, `user_id`) VALUES
(1, 'flight', 'BUD-PAR-2025-06-01', 89.99, '2025-04-01', 1),
(2, 'hotel', 'HOTEL12345', 120.00, '2025-04-02', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `route`
--

CREATE TABLE `route` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `route`
--

INSERT INTO `route` (`id`, `name`, `start_date`, `end_date`, `user_id`) VALUES
(1, 'Európai körút', '2025-06-01', '2025-06-15', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `routedestinations`
--

CREATE TABLE `routedestinations` (
  `route_id` int(11) NOT NULL,
  `dest_id` int(11) NOT NULL,
  `order_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `routedestinations`
--

INSERT INTO `routedestinations` (`route_id`, `dest_id`, `order_no`) VALUES
(1, 1, 1),
(1, 2, 2),
(1, 3, 3);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `settings` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`settings`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `role`, `settings`) VALUES
(1, 'Kiss Péter', 'peter.kiss@example.com', 'hashed_password1', 'user', NULL),
(2, 'Nagy Anna', 'anna.nagy@example.com', 'hashed_password2', 'admin', NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `weather`
--

CREATE TABLE `weather` (
  `id` int(11) NOT NULL,
  `dest_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `temperature` decimal(5,2) DEFAULT NULL,
  `conditions` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `weather`
--

INSERT INTO `weather` (`id`, `dest_id`, `date`, `temperature`, `conditions`) VALUES
(1, 1, '2025-06-02', 26.50, 'Sunny'),
(2, 2, '2025-06-05', 21.00, 'Cloudy'),
(3, 3, '2025-06-10', 28.00, 'Clear skies');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `cost`
--
ALTER TABLE `cost`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `route_id` (`route_id`),
  ADD KEY `dest_id` (`dest_id`);

--
-- A tábla indexei `destination`
--
ALTER TABLE `destination`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- A tábla indexei `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- A tábla indexei `pricewatch`
--
ALTER TABLE `pricewatch`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- A tábla indexei `route`
--
ALTER TABLE `route`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- A tábla indexei `routedestinations`
--
ALTER TABLE `routedestinations`
  ADD PRIMARY KEY (`route_id`,`dest_id`),
  ADD KEY `dest_id` (`dest_id`);

--
-- A tábla indexei `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- A tábla indexei `weather`
--
ALTER TABLE `weather`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dest_id` (`dest_id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `cost`
--
ALTER TABLE `cost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `destination`
--
ALTER TABLE `destination`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `pricewatch`
--
ALTER TABLE `pricewatch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `route`
--
ALTER TABLE `route`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT a táblához `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `weather`
--
ALTER TABLE `weather`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `cost`
--
ALTER TABLE `cost`
  ADD CONSTRAINT `cost_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cost_ibfk_2` FOREIGN KEY (`route_id`) REFERENCES `route` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cost_ibfk_3` FOREIGN KEY (`dest_id`) REFERENCES `destination` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `destination`
--
ALTER TABLE `destination`
  ADD CONSTRAINT `destination_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL;

--
-- Megkötések a táblához `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `pricewatch`
--
ALTER TABLE `pricewatch`
  ADD CONSTRAINT `pricewatch_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `route`
--
ALTER TABLE `route`
  ADD CONSTRAINT `route_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `routedestinations`
--
ALTER TABLE `routedestinations`
  ADD CONSTRAINT `routedestinations_ibfk_1` FOREIGN KEY (`route_id`) REFERENCES `route` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `routedestinations_ibfk_2` FOREIGN KEY (`dest_id`) REFERENCES `destination` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `weather`
--
ALTER TABLE `weather`
  ADD CONSTRAINT `weather_ibfk_1` FOREIGN KEY (`dest_id`) REFERENCES `destination` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
