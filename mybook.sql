-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 25 Lis 2021, 13:46
-- Wersja serwera: 10.4.21-MariaDB
-- Wersja PHP: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `mybook`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `categories` int(11) NOT NULL,
  `author` varchar(512) NOT NULL,
  `page` int(11) NOT NULL,
  `file_name` varchar(512) NOT NULL,
  `is_read` bit(1) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `book`
--

INSERT INTO `book` (`id`, `title`, `description`, `categories`, `author`, `page`, `file_name`, `is_read`, `user_id`) VALUES
(1, 'Pan tadeusz', 'pan tadeusz ksiazka .', 8, 'Adam Mickiewicz', 345, 'testowaNazwa', b'0', 34),
(12, 'Pan tadeusz 23', 'Pan Tadeusz, czyli ostatni zajazd na Litwie – poemat epicki Adama Mickiewicza wydany w dwóch tomach w 1834 w Paryżu przez Aleksandra Jełowickiego. Ta epopeja narodowa powstała w latach 1832–1834 w Paryżu. Składa się z dwunastu ksiąg pisanych wierszem, trzynastozgłoskowym aleksandrynem polskim.', 9, 'Adam Mickiewicz', 34, 'user_name_dan981_id_user_15_title_bookPantadeusz23.jpg', b'1', 15),
(13, 'Pan tadeusz', 'fdgdfgd', 9, 'Adam Mickiewicz', 45, 'user_name_dan981_id_user_15_title_bookPantadeusz.jpg', b'0', 15),
(15, 'Pan tadeusz 234', 'erewrew', 10, 'Adam Mickiewicz', 34, 'user_name_dan981_id_user_15_title_bookPantadeusz234.jpg', b'1', 15);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name_categories` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `categories`
--

INSERT INTO `categories` (`id`, `name_categories`) VALUES
(6, 'Akcji'),
(9, 'Bajka'),
(10, 'Familijna'),
(2, 'Informatyka'),
(4, 'Manga'),
(8, 'Przygodowa'),
(3, 'Romans'),
(5, 'Sensacyjna'),
(1, 'Techniczna'),
(7, 'Wojenna');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user_table`
--

CREATE TABLE `user_table` (
  `id` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `user_table`
--

INSERT INTO `user_table` (`id`, `username`, `email`, `password`) VALUES
(1, 'dan98', 'daniel@onet.pl', ''),
(11, 'daniel2', 'dan2@onet.pl', '$argon2i$v=19$m=65536,t=4,p=1$LkU0MmR4ZG5kVXUuUzZueA$+1qH5zh51yFvPUp5WrB7ONXDD2EY1ik3zuMkjnb6RC0'),
(12, 'daniel234', 'dan3@onet.pl', '$argon2i$v=19$m=65536,t=4,p=1$OGpkT2o5Slhya1dRM2VWcg$8ROrlguy8EYgxWFaLyrSgB9bOB4fDpwtEAVPVmc8RAA'),
(13, 'daniel23', 'dan45@onet.pl', '$argon2i$v=19$m=65536,t=4,p=1$SEVqRloxenlNc2xoTmlNbA$mYU05x4RtgnYfg10DkR5w/+1tTW1doCw7iarVtWH264'),
(14, 'daniel236', 'dan11@onet.pl', '$argon2i$v=19$m=65536,t=4,p=1$VVdyMGhheHdRclB0eFhTQQ$kns8bkK198kZ8sSJI14SEmJ4kJjdLsmEr672AmNtKfI'),
(15, 'dan981', 'pepi1@onet.pl', '$argon2i$v=19$m=65536,t=4,p=1$R29Gb3lxTm5XNjRIUDgycA$A8iUahK1MCK57U2n8As4F1H9NKobU/OWND7ZEf8IA+8'),
(16, 'daniel12345', 'polska@onet.pl', '$argon2i$v=19$m=65536,t=4,p=1$Y1gvYnpnTVR5VWgwY2wwMQ$SdLz70PfBUMVWh/VdwLB/3BrEip5u3IpMYzPU5Ey1Rs');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_categories` (`name_categories`);

--
-- Indeksy dla tabeli `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT dla tabeli `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT dla tabeli `user_table`
--
ALTER TABLE `user_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
