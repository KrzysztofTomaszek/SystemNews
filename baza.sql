-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 02 Lis 2017, 15:38
-- Wersja serwera: 10.1.16-MariaDB
-- Wersja PHP: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `newssystem`
--
CREATE DATABASE IF NOT EXISTS `newssystem` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `newssystem`;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `autorzy`
--

CREATE TABLE `autorzy` (
  `autorzyID` int(11) NOT NULL,
  `autor` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `autorzy`
--

INSERT INTO `autorzy` (`autorzyID`, `autor`) VALUES
(1, 'Zenek'),
(2, 'Zdzichu'),
(3, 'Ala'),
(4, 'Iwona');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `groups`
--

CREATE TABLE `groups` (
  `groupsID` int(11) NOT NULL,
  `name` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `groups`
--

INSERT INTO `groups` (`groupsID`, `name`) VALUES
(1, 'Administrator'),
(2, 'Czytelnik');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `komentarze`
--

CREATE TABLE `komentarze` (
  `komentarzeID` int(11) NOT NULL,
  `komentarz` text COLLATE utf8_polish_ci NOT NULL,
  `data` datetime NOT NULL,
  `newsID` int(11) NOT NULL,
  `usersID` int(11) NOT NULL,
  `ban` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `komentarze`
--

INSERT INTO `komentarze` (`komentarzeID`, `komentarz`, `data`, `newsID`, `usersID`, `ban`) VALUES
(1, 'Dobre Newsowe', '2017-10-18 00:12:30', 13, 2, 0),
(2, 'TAKI komentarz', '2017-10-12 11:30:40', 13, 3, 0),
(3, 'Super NEWS', '2017-10-14 15:23:04', 12, 2, 0),
(4, 'No tak', '2017-10-14 14:00:20', 11, 2, 0),
(5, 'I co teraz?', '2017-10-15 00:14:23', 10, 2, 0),
(6, 'Do zbanowania.', '2017-10-15 16:30:54', 10, 1, 1),
(7, 'tak\r\n', '2017-11-01 22:44:50', 13, 1, 0),
(8, 'asdvb', '2017-11-01 22:57:02', 15, 2, 0),
(9, 'eqwadfs', '2017-11-01 23:31:47', 1, 1, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `news`
--

CREATE TABLE `news` (
  `newsID` int(11) NOT NULL,
  `tytul` text COLLATE utf8_polish_ci NOT NULL,
  `tresc` text COLLATE utf8_polish_ci NOT NULL,
  `data` date NOT NULL,
  `autor` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `news`
--

INSERT INTO `news` (`newsID`, `tytul`, `tresc`, `data`, `autor`) VALUES
(1, 'Tytul1', 'TO jest tresc tego zacnego newsa1', '2017-09-14', 'Ala'),
(2, 'Tytul2', 'TO jest tresc tego zacnego newsa2', '2017-09-15', 'PAn TAk'),
(3, 'Tytul3', 'TO jest tresc tego zacnego newsa3', '2017-09-24', 'Ala'),
(4, 'Tytul4', 'TO jest tresc tego zacnego newsa4', '2017-09-20', 'TYP'),
(5, 'Tytul5', 'TO jest tresc tego zacnego newsa5', '2017-09-20', 'admin'),
(6, 'Tytul6', 'TO jest tresc tego zacnego newsa6', '2017-09-26', 'user'),
(7, 'Tytul7', 'TO jest tresc tego zacnego newsa7', '2017-09-26', 'Zdzichu'),
(8, 'Tytul8', 'TO jest tresc tego zacnego newsa8', '2017-10-05', 'Zdzichu'),
(9, 'Tytul9', 'TO jest tresc tego zacnego newsa9', '2017-10-21', 'Zenek'),
(10, 'Tytul10', 'TO jest tresc tego zacnego newsa10', '2017-10-02', 'Stachu'),
(11, 'Tytul11', 'TO jest tresc tego zacnego newsa11', '2017-10-03', 'Zenek'),
(12, 'Tytul12', 'TO jest tress', '2017-10-15', 'Zenek');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ocenynews`
--

CREATE TABLE `ocenynews` (
  `ocenyNewsID` int(11) NOT NULL,
  `newsID` int(11) NOT NULL,
  `usersID` int(11) NOT NULL,
  `ocena` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `ocenynews`
--

INSERT INTO `ocenynews` (`ocenyNewsID`, `newsID`, `usersID`, `ocena`) VALUES
(1, 12, 2, 4),
(3, 12, 3, 3),
(5, 10, 2, 1),
(6, 9, 2, 3),
(7, 5, 2, 3),
(11, 1, 1, 4);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `usersID` int(11) NOT NULL,
  `login` text COLLATE utf8_polish_ci NOT NULL,
  `password` text COLLATE utf8_polish_ci NOT NULL,
  `groupsID` int(11) NOT NULL,
  `ban` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`usersID`, `login`, `password`, `groupsID`, `ban`) VALUES
(1, 'admin', 'qwerty', 1, 0),
(2, 'user14', 'qwerty', 2, 0),
(3, 'user2', 'qwerty', 2, 0),
(4, 'nowy', 'qwe', 2, 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `autorzy`
--
ALTER TABLE `autorzy`
  ADD PRIMARY KEY (`autorzyID`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`groupsID`);

--
-- Indexes for table `komentarze`
--
ALTER TABLE `komentarze`
  ADD PRIMARY KEY (`komentarzeID`),
  ADD KEY `newsID` (`newsID`),
  ADD KEY `usersID` (`usersID`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`newsID`);

--
-- Indexes for table `ocenynews`
--
ALTER TABLE `ocenynews`
  ADD PRIMARY KEY (`ocenyNewsID`),
  ADD KEY `newsID` (`newsID`),
  ADD KEY `usersID` (`usersID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usersID`),
  ADD KEY `groupsID` (`groupsID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `autorzy`
--
ALTER TABLE `autorzy`
  MODIFY `autorzyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT dla tabeli `groups`
--
ALTER TABLE `groups`
  MODIFY `groupsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT dla tabeli `komentarze`
--
ALTER TABLE `komentarze`
  MODIFY `komentarzeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT dla tabeli `news`
--
ALTER TABLE `news`
  MODIFY `newsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT dla tabeli `ocenynews`
--
ALTER TABLE `ocenynews`
  MODIFY `ocenyNewsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `usersID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `komentarze`
--
ALTER TABLE `komentarze`
  ADD CONSTRAINT `news_ibfk_2` FOREIGN KEY (`newsID`) REFERENCES `news` (`newsID`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`usersID`) REFERENCES `users` (`usersID`);

--
-- Ograniczenia dla tabeli `ocenynews`
--
ALTER TABLE `ocenynews`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`newsID`) REFERENCES `news` (`newsID`),
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`usersID`) REFERENCES `users` (`usersID`);

--
-- Ograniczenia dla tabeli `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `groups_ibfk` FOREIGN KEY (`groupsID`) REFERENCES `groups` (`groupsID`) ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
