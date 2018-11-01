-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 01 Lis 2018, 12:03
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
-- Baza danych: `example_database`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `books`
--

CREATE TABLE `books` (
  `ID` int(11) NOT NULL,
  `author` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `title` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `year_pub` int(11) NOT NULL,
  `category` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `books`
--

INSERT INTO `books` (`ID`, `author`, `title`, `year_pub`, `category`) VALUES
(1, 'Rowling', 'Harry Potter', 1997, 'Fantasy'),
(2, 'Sanderson', 'Skyward', 2018, 'Fantasy'),
(3, 'Barnes', 'The Hunted', 2018, 'Mystery'),
(4, 'Herron', 'The Drop', 2018, 'Thriller'),
(5, 'Kray', 'Deceived', 2018, 'Mystery'),
(6, 'Alcott', 'Little Women', 2004, 'biography'),
(7, 'Kang', 'The Vegetarian', 2016, 'Fiction'),
(8, 'Hertmans', 'War and Turpentine', 2016, 'Fiction'),
(9, 'McEwan', 'Atonement', 2003, 'Fiction'),
(10, 'Rey', 'Curious George', 1941, 'picture'),
(11, 'Franzen', 'FREEDOM', 2010, 'Fiction'),
(12, 'Trevor', 'SELECTED STORIES', 2010, 'Fiction');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `books`
--
ALTER TABLE `books`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
