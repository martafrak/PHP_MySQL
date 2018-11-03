-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 03 Lis 2018, 13:28
-- Wersja serwera: 10.1.29-MariaDB
-- Wersja PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `login`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `login` text COLLATE utf8_polish_ci NOT NULL,
  `password` text COLLATE utf8_polish_ci NOT NULL,
  `email` text COLLATE utf8_polish_ci NOT NULL,
  `level` int(11) NOT NULL,
  `city` text COLLATE utf8_polish_ci NOT NULL,
  `discount` int(11) NOT NULL,
  `premium` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`ID`, `login`, `password`, `email`, `level`, `city`, `discount`, `premium`) VALUES
(1, 'LadyInRed', 'example1', 'ladyinred@email.com', 4, 'London', 5, '0000-00-00 00:00:00'),
(2, 'Caroline22', 'example2', 'carroline22@email.com', 1, 'Warsaw', 2, '0000-00-00 00:00:00'),
(3, 'Tom1994', 'Example3', 'Tom1994@email.com', 1, 'Lyon', 2, '0000-00-00 00:00:00'),
(4, 'marta', 'Example4', 'marta@email.com', 6, 'Poznan', 25, '0000-00-00 00:00:00'),
(5, 'Oliver', 'Example5', 'Oliver333@email.com', 6, 'Barcelona', 27, '0000-00-00 00:00:00'),
(12, 'test', '$2y$10$ipVLuOTjeHZ.sxGBQtTXHeCuLspmnLN8J6L3Eb8W/GVuhtAn8LbCm', 'testowy123@test.pl', 1, 'Wroclaw', 10, '2018-11-17 13:28:25');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
