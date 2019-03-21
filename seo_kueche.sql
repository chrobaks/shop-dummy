-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 21. Mrz 2019 um 17:21
-- Server-Version: 10.1.37-MariaDB
-- PHP-Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `seo_kueche`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `article_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `article_description` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_url` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `delivery_status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `articles`
--

INSERT INTO `articles` (`id`, `article_name`, `article_description`, `price`, `image_url`, `delivery_status`) VALUES
(1, 'Baby-Artikel 1', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.', '19.99', 'baby-artikel.png', 1),
(2, 'Baby-Artikel 2', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.', '120.30', 'baby-artikel.png', 1),
(3, 'Baby-Artikel 3', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.', '5.37', 'baby-artikel.png', 1),
(4, 'Baby-Artikel 4', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.', '340.00', 'baby-artikel.png', 1),
(5, 'Kleinkinder-Artikel 1', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa', '12.99', 'kleinkinder-artikel.png', 1),
(6, 'Kleinkinder-Artikel 2', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa', '10.50', 'kleinkinder-artikel.png', 1),
(7, 'Kleinkinder-Artikel 3', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa', '834.50', 'kleinkinder-artikel.png', 1),
(8, 'Kleinkinder-Artikel 4', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa', '14.35', 'kleinkinder-artikel.png', 1),
(9, 'Fahrzeuge-Artikel 1', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa', '25.50', 'fahrzeuge-artikel.png', 1),
(10, 'Fahrzeuge-Artikel 2', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa', '40.00', 'fahrzeuge-artikel.png', 1),
(11, 'Fahrzeuge-Artikel 3', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa', '120.39', 'fahrzeuge-artikel.png', 1),
(12, 'Spiele-Artikel 1', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa', '11.00', 'spiele-artikel.png', 1),
(13, 'Spiele-Artikel 2', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa', '30.99', 'spiele-artikel.png', 1),
(14, 'Spiele-Artikel 3', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa', '12.25', 'spiele-artikel.png', 1),
(15, 'Technik-Artikel 1', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa', '450.45', 'technik-artikel.png', 1),
(16, 'Technik-Artikel 2', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa', '12.99', 'technik-artikel.png', 1),
(17, 'Technik-Artikel 3', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa', '23.35', 'technik-artikel.png', 1),
(18, 'Ernährungsbuch 1', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.', '13.90', '2019-19-03-17-03-14-produkt-dummy.png', 0),
(19, 'Ernährungsbuch 2', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.            ', '25.90', '2019-19-03-17-16-48-produkt-dummy.png', 1),
(20, 'Ernährungsbuch 3', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.            ', '12.50', '2019-19-03-17-18-29-produkt-dummy.png', 1),
(21, 'Ernährungsbuch Getreide', 'Ein fundierter Ratgeber zu Diagnose und Entwicklungsverlauf von Schaderregern sowie zum sinnvollen Pflanzenschutz.            ', '85.50', '2019-20-03-13-13-17-produkt-dummy.png', 1),
(22, 'Ratgeber Saisonelle Ernährung', 'Nach Darlegung der Historie der Saisonbereinigung folgt eine Darstellung praktisch wichtiger Bereinigungsverfahren und eine Einführung in die Analyse ', '17.95', '2019-20-03-14-18-45-produkt-dummy.png', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `articles_map`
--

DROP TABLE IF EXISTS `articles_map`;
CREATE TABLE `articles_map` (
  `article_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `articles_map`
--

INSERT INTO `articles_map` (`article_id`, `cat_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 3),
(10, 3),
(11, 3),
(12, 4),
(13, 4),
(14, 4),
(15, 5),
(16, 5),
(17, 5),
(18, 6),
(19, 6),
(20, 6),
(21, 6),
(22, 7);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `cat_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `categories`
--

INSERT INTO `categories` (`id`, `cat_name`, `description`) VALUES
(1, 'Baby', 'Nützliches und wichtiges rund um das Thema Baby.'),
(2, 'Kleinkinder', 'Umweltbewußte Artikel mit Gütesiegel. Grosse Auswahl an Spielzeug und Büchern für Kleinkinder.'),
(3, 'Fahrzeuge', 'Hier schlägt das Fahrerherz höher. Das Neuseste zum Thema Fahrzeuge.'),
(4, 'Spiele', 'Traditionell oder Digital;- in unsere Spielecke bleibt kein Wunsch unerfüllt.'),
(5, 'Technik', 'Hier fühlen sich Nerds wohl;- aktuelle Produkte aus der IT-Welt.'),
(6, 'Ernährung', 'Regionale Produkte aus ökologisch sinnvollen Anbau und energiesparender Produktion.');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `role` int(1) NOT NULL DEFAULT '0',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `email`, `pass`, `role`, `create_at`) VALUES
(1, 'testuser@seo-kueche.de', '$2y$10$AaJUTQBctSp/KhWAhW5xUeZ2Hu3XBqx1awSs9rfUbvKPqlxL2XVmO', 0, '2019-03-15 12:58:21'),
(2, 'testadmin@seo-kueche.de', '$2y$10$v1HF14eKUMP8J3AwUWe7a.zIyMc3riJ2OO2TUYeTeE50tVVhvoKEO', 1, '2019-03-15 13:00:15');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_order`
--

DROP TABLE IF EXISTS `user_order`;
CREATE TABLE `user_order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_type` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `order_price` decimal(10,2) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `user_order`
--

INSERT INTO `user_order` (`id`, `user_id`, `payment_type`, `order_price`, `create_at`) VALUES
(1, 1, 'paypal', '450.45', '2019-03-20 18:08:17'),
(2, 1, 'paypal', '900.90', '2019-03-21 16:08:14');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_order_article`
--

DROP TABLE IF EXISTS `user_order_article`;
CREATE TABLE `user_order_article` (
  `id` int(11) NOT NULL,
  `user_order_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `article_price` decimal(10,2) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `user_order_article`
--

INSERT INTO `user_order_article` (`id`, `user_order_id`, `article_id`, `article_price`, `amount`) VALUES
(1, 1, 15, '450.45', 1),
(2, 2, 15, '450.45', 2);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `article_name` (`article_name`);

--
-- Indizes für die Tabelle `articles_map`
--
ALTER TABLE `articles_map`
  ADD KEY `article_id` (`article_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indizes für die Tabelle `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cat_name` (`cat_name`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `user_order`
--
ALTER TABLE `user_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indizes für die Tabelle `user_order_article`
--
ALTER TABLE `user_order_article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_order_id` (`user_order_id`),
  ADD KEY `article_id` (`article_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT für Tabelle `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `user_order`
--
ALTER TABLE `user_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `user_order_article`
--
ALTER TABLE `user_order_article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
