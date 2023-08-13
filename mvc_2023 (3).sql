-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 13. Aug 2023 um 20:43
-- Server-Version: 10.4.28-MariaDB
-- PHP-Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `mvc_2023`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(64) NOT NULL,
  `body` text NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL,
  `updated_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `body`, `created_at`, `updated_at`) VALUES
(15, 3, 'Bisaflor - Pokemon', '            Das ist gerade eigentlich nur ein Test ob die Bearbeitung korrekt funktioniert.      ', 1691872352, 1691933165),
(20, 3, 'Bisasam - Pokemon', 'Das ist ein weiterer Test.', 1691934099, 1691934099),
(21, 3, 'Bisaknosp - Pokemon', '                                                Ein weiterer Test. Anscheinend erfolgreich. Jo                                ', 1691935881, 1691938615),
(26, 3, 'DSASDWEF$EWFWEFEW', 'EWFWEFEWFWEFWEFEWFWEF\"EFWE', 1691950242, 1691950242);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `post_images`
--

CREATE TABLE `post_images` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `path` varchar(64) NOT NULL,
  `alt_text` varchar(64) NOT NULL,
  `uploaded_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `post_images`
--

INSERT INTO `post_images` (`id`, `post_id`, `path`, `alt_text`, `uploaded_at`) VALUES
(11, 15, 'images/943e3134f9823ae32c6a75b7be7729fa.png', 'wrwd2qwdqwdqwwqdq', 1691872352),
(16, 20, 'images/e341ece3b584de55dbbd1a44720bfaf6.png', 'Bisasam - Pokemon', 1691934099),
(17, 21, 'images/f4efc347f787c070784eb47290706c08.png', 'Bisaknosp - Pokemon', 1691935881),
(22, 26, 'images/9589b5535dcc5cdc1ced8cc78b857185.jpg', 'DSASDWEF$EWFWEFEW', 1691950242);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `post_likes`
--

CREATE TABLE `post_likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `post_likes`
--

INSERT INTO `post_likes` (`id`, `user_id`, `post_id`) VALUES
(78, 3, 15),
(94, 3, 20),
(79, 3, 21),
(93, 10, 20);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(255) NOT NULL,
  `joined_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `joined_at`) VALUES
(3, 'sdarby1', 'sean.darby@outlook.de', '$2y$11$YPHUtlZcSF2gxH9WO2hdzu/ceMrN/KkYucw.KqrZJl3BeBdBaKrwC', 1691665515),
(5, 'test', 'test@test.de', '$2y$11$CL3iK7cyx8a1NkK3uiCcge6LZorCWKNNRfRxOoDiEneygqIEWRyRy', 1691767067),
(6, 'sean.drby', 'sean.darby@heckendorf.net', '$2y$11$GoAcHW9kb0txyJP.fNyZ8e.BeAJNHYl4q3hnSbgBhPDqJ5Rc4EDcG', 1691767151),
(8, 'lionelmessi', 'lionel@messi.ag', '$2y$11$djaPN9PgSMoIy51ZBWmCeu8fk6dZ0JIztxGU8T4qWB7CPxf7Ky4Y2', 1691934874),
(9, 'andy420', 'naomi.darby@heckendorf.net', '$2y$11$bAwrcyRi7a9nlrYJ7CBo3uCqX91mIM.NAEkNsKd/QgIX.L70ykldq', 1691938288),
(10, 'sienderby', 'siensienderby@gmail.com', '$2y$11$9UElg.SjOhQlulHKLzeopulEdX7.0CDs2uTH7okBgc6L8OCu/6aQS', 1691946412);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`),
  ADD KEY `user_id` (`user_id`);

--
-- Indizes für die Tabelle `post_images`
--
ALTER TABLE `post_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indizes für die Tabelle `post_likes`
--
ALTER TABLE `post_likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`post_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT für Tabelle `post_images`
--
ALTER TABLE `post_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT für Tabelle `post_likes`
--
ALTER TABLE `post_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `post_images`
--
ALTER TABLE `post_images`
  ADD CONSTRAINT `post_images_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `post_likes`
--
ALTER TABLE `post_likes`
  ADD CONSTRAINT `post_likes_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_likes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
