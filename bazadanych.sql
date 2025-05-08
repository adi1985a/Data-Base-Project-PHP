-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 30 Lis 2023, 21:55
-- Wersja serwera: 10.4.27-MariaDB
-- Wersja PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `test`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `audit_subscribers`
--

CREATE TABLE `audit_subscribers` (
  `id` int(11) NOT NULL,
  `subscriber_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `action_performed` varchar(50) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Zrzut danych tabeli `audit_subscribers`
--

INSERT INTO `audit_subscribers` (`id`, `subscriber_name`, `action_performed`, `date_added`) VALUES
(1, 'dsasdds', 'Insert a new subscriber', '2023-10-31 20:57:19'),
(2, 'dsasdds', 'Deleted a subscriber', '2023-10-31 20:59:13'),
(3, 'adam', 'Insert a new subscriber', '2023-10-31 21:01:01'),
(4, 'maciej', 'Insert a new subscriber', '2023-10-31 21:02:50'),
(5, 'lukasz', 'Insert a new subscriber', '2023-10-31 21:05:19'),
(6, 'ewa', 'Insert a new subscriber', '2023-10-31 21:05:46'),
(7, 'edward', 'Insert a new subscriber', '2023-10-31 21:14:00'),
(8, 'ula', 'Insert a new subscriber', '2023-10-31 21:14:55'),
(9, 'ignacy', 'Insert a new subscriber', '2023-10-31 21:26:09'),
(10, 'ignacy', 'Insert a new subscriber', '2023-10-31 21:26:09'),
(11, 'ignacy', 'Deleted a subscriber', '2023-10-31 21:53:34'),
(12, 'ignacy', 'Deleted a subscriber', '2023-10-31 21:53:34'),
(13, 'maciej', 'Insert a new subscriber', '2023-10-31 21:58:06'),
(14, 'maciej', 'Insert a new subscriber', '2023-10-31 21:58:06'),
(15, 'maciej', 'Deleted a subscriber', '2023-10-31 22:03:36'),
(16, 'maciej', 'Deleted a subscriber', '2023-10-31 22:03:36'),
(17, 'roland', 'Insert a new subscriber', '2023-10-31 22:05:12'),
(18, 'roland', 'Insert a new subscriber', '2023-10-31 22:05:12'),
(19, 'emil', 'Insert a new subscriber', '2023-10-31 22:08:39'),
(20, 'emil', 'Insert a new subscriber', '2023-10-31 22:08:39'),
(21, 'as', 'Insert a new subscriber', '2023-10-31 22:25:42'),
(22, 'as', 'Insert a new subscriber', '2023-10-31 22:25:42'),
(23, 'as', 'Deleted a subscriber', '2023-10-31 22:34:36'),
(24, 'as', 'Deleted a subscriber', '2023-10-31 22:34:36'),
(25, 'rolanda', 'Updated a subscriber', '2023-10-31 22:44:05'),
(26, 'rolanda', 'Updated a user', '2023-10-31 22:44:05'),
(27, 'rolanda', 'Updated a subscriber', '2023-10-31 22:44:05'),
(28, 'sdaf', 'Insert a new subscriber', '2023-11-30 20:51:43');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Zrzut danych tabeli `subscribers`
--

INSERT INTO `subscribers` (`id`, `fname`, `email`) VALUES
(2, 'adam', 'adam@wp.pl'),
(3, 'maciej', 'maciej@wp.pl'),
(4, 'lukasz', 'lukasz@wp.pl'),
(5, 'ewa', 'ewa@wp.pl'),
(6, 'edward', 'edward@wp.pl'),
(7, 'ula', 'ula@wp.pl'),
(10, 'rolanda', 'roland@wp.pl'),
(11, 'emil', 'emil@wp.pl'),
(13, 'sdaf', 'edgwf32@wp.pl');

--
-- Wyzwalacze `subscribers`
--
DELIMITER $$
CREATE TRIGGER `after_subscriber_delete` AFTER DELETE ON `subscribers` FOR EACH ROW BEGIN
    INSERT INTO audit_subscribers (subscriber_name, action_performed)
    VALUES (OLD.fname, 'Deleted a subscriber');
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_subscriber_edit` AFTER UPDATE ON `subscribers` FOR EACH ROW BEGIN
    INSERT INTO audit_subscribers (subscriber_name, action_performed)
    VALUES (NEW.fname, 'Updated a subscriber');
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_subscriber_update` AFTER UPDATE ON `subscribers` FOR EACH ROW BEGIN
    IF NEW.fname != OLD.fname THEN
        INSERT INTO audit_subscribers (subscriber_name, action_performed)
        VALUES (NEW.fname, 'Updated a user');
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_subscriber_insert` BEFORE INSERT ON `subscribers` FOR EACH ROW BEGIN
    INSERT INTO audit_subscribers (subscriber_name, action_performed)
    VALUES (NEW.fname, 'Insert a new subscriber');
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `usunieci_data_dod_i_usun`
-- (Zobacz poniżej rzeczywisty widok)
--
CREATE TABLE `usunieci_data_dod_i_usun` (
`subscriber_name` varchar(255)
,`date_dodania` timestamp
,`date_usuniecia` timestamp
);

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `widok_edycji_uzytkownikow`
-- (Zobacz poniżej rzeczywisty widok)
--
CREATE TABLE `widok_edycji_uzytkownikow` (
`subscriber_name` varchar(255)
,`date_last_edited` timestamp
);

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `widok_istniejacych_uzytkownikow`
-- (Zobacz poniżej rzeczywisty widok)
--
CREATE TABLE `widok_istniejacych_uzytkownikow` (
`subscriber_name` varchar(255)
,`date_dodania` timestamp
);

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `widok_usunieci_uzytkownicy`
-- (Zobacz poniżej rzeczywisty widok)
--
CREATE TABLE `widok_usunieci_uzytkownicy` (
`subscriber_name` varchar(255)
,`date_deleted` timestamp
);

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `widok_uzytkownicy`
-- (Zobacz poniżej rzeczywisty widok)
--
CREATE TABLE `widok_uzytkownicy` (
`subscriber_name` varchar(255)
,`date_added` timestamp
);

-- --------------------------------------------------------

--
-- Struktura widoku `usunieci_data_dod_i_usun`
--
DROP TABLE IF EXISTS `usunieci_data_dod_i_usun`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `usunieci_data_dod_i_usun`  AS SELECT `a`.`subscriber_name` AS `subscriber_name`, `a`.`date_added` AS `date_dodania`, max(`b`.`date_added`) AS `date_usuniecia` FROM (`audit_subscribers` `a` join `audit_subscribers` `b` on(`a`.`subscriber_name` = `b`.`subscriber_name`)) WHERE `a`.`action_performed` = 'Insert a new subscriber' AND `b`.`action_performed` = 'Deleted a subscriber' GROUP BY `a`.`subscriber_name`, `a`.`date_added``date_added`  ;

-- --------------------------------------------------------

--
-- Struktura widoku `widok_edycji_uzytkownikow`
--
DROP TABLE IF EXISTS `widok_edycji_uzytkownikow`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `widok_edycji_uzytkownikow`  AS SELECT `audit_subscribers`.`subscriber_name` AS `subscriber_name`, max(`audit_subscribers`.`date_added`) AS `date_last_edited` FROM `audit_subscribers` WHERE `audit_subscribers`.`action_performed` = 'Updated a subscriber' OR `audit_subscribers`.`action_performed` = 'Updated a user' GROUP BY `audit_subscribers`.`subscriber_name``subscriber_name`  ;

-- --------------------------------------------------------

--
-- Struktura widoku `widok_istniejacych_uzytkownikow`
--
DROP TABLE IF EXISTS `widok_istniejacych_uzytkownikow`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `widok_istniejacych_uzytkownikow`  AS SELECT DISTINCT `a`.`subscriber_name` AS `subscriber_name`, `a`.`date_added` AS `date_dodania` FROM `audit_subscribers` AS `a` WHERE `a`.`action_performed` = 'Insert a new subscriber''Insert a new subscriber'  ;

-- --------------------------------------------------------

--
-- Struktura widoku `widok_usunieci_uzytkownicy`
--
DROP TABLE IF EXISTS `widok_usunieci_uzytkownicy`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `widok_usunieci_uzytkownicy`  AS SELECT `audit_subscribers`.`subscriber_name` AS `subscriber_name`, max(`audit_subscribers`.`date_added`) AS `date_deleted` FROM `audit_subscribers` WHERE `audit_subscribers`.`action_performed` = 'Deleted a subscriber' GROUP BY `audit_subscribers`.`subscriber_name``subscriber_name`  ;

-- --------------------------------------------------------

--
-- Struktura widoku `widok_uzytkownicy`
--
DROP TABLE IF EXISTS `widok_uzytkownicy`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `widok_uzytkownicy`  AS SELECT `audit_subscribers`.`subscriber_name` AS `subscriber_name`, `audit_subscribers`.`date_added` AS `date_added` FROM `audit_subscribers` ORDER BY `audit_subscribers`.`date_added` AS `DESCdesc` ASC  ;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `audit_subscribers`
--
ALTER TABLE `audit_subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `audit_subscribers`
--
ALTER TABLE `audit_subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT dla tabeli `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
