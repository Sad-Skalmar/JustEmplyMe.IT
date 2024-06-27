-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2024 at 04:54 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `job`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `application_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `job_id` int(11) DEFAULT NULL,
  `application_date` date DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `job_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `min_salary` int(11) NOT NULL,
  `max_salary` int(11) NOT NULL,
  `company` varchar(100) NOT NULL,
  `location` varchar(50) NOT NULL,
  `workplace` varchar(15) NOT NULL,
  `date` date NOT NULL,
  `description` text NOT NULL,
  `experience` varchar(15) NOT NULL,
  `type` varchar(25) NOT NULL,
  `job_owner_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`job_id`, `name`, `min_salary`, `max_salary`, `company`, `location`, `workplace`, `date`, `description`, `experience`, `type`, `job_owner_id`) VALUES
(17, 'Python developer', 7000, 10000, 'COLOP Polska', 'Katowice', '', '2024-06-03', 'Rola w organizacji:\r\nSzukamy Python Developera, który pasjonuje się tworzeniem nowoczesnych aplikacji i narzędzi wykorzystujących język Python. Jeśli jesteś osobą, która nie boi się wyzwań programistycznych, ciągle poszukuje nowych sposobów rozwoju i chce pracować w dynamicznym środowisku, to ta oferta jest właśnie dla Ciebie. Sprawdź poniżej, co oferujemy i czego oczekujemy od kandydatów na to stanowisko.\r\n\r\nOczekiwania:\r\n\r\nDoświadczenie w programowaniu w języku Python\r\nZnajomość frameworków takich jak Django, Flask\r\nUmiejętność pracy z bazami danych SQL i NoSQL\r\nZnajomość systemów kontroli wersji (np. Git)\r\nPraktyczna znajomość zagadnień związanych z RESTful API\r\nUmiejętność pracy w zespole oraz komunikatywność\r\nGotowość do nauki i rozwijania swoich umiejętności\r\nWykształcenie wyższe kierunkowe związane z informatyką lub pokrewnymi dziedzinami\r\nBardzo dobra znajomość języka angielskiego\r\n\r\nZadania:\r\n\r\nProjektowanie i rozwój zaawansowanych aplikacji przy użyciu języka Python\r\nWspółpraca z zespołem deweloperskim w celu tworzenia i wdrażania nowych funkcji\r\nDiagnozowanie i usuwanie błędów w aplikacjach, dbanie o ich wydajność\r\nTestowanie aplikacji i zapewnianie ich jakości\r\nCiągłe doskonalenie istniejących funkcjonalności oraz wprowadzanie nowych\r\nTworzenie dokumentacji technicznej\r\n\r\nCo oferujemy?\r\n\r\nWynagrodzenie w przedziale 8000 - 14000 PLN brutto miesięcznie\r\nUmowę o pracę lub B2B\r\nPrywatną opiekę medyczną\r\nMożliwość pracy zdalnej lub hybrydowej\r\nElastyczne godziny pracy\r\nSzkolenia i konferencje branżowe\r\nKartę MultiSport\r\nPrzyjazną atmosferę pracy\r\nPremie za osiągnięcia\r\nMożliwość pracy z najnowszymi technologiami', 'Stationary', 'Full-Time', 11),
(30, 'Junior WebMaster', 3500, 4500, 'COLOP Polska', 'Katowice', 'Stationary', '2024-06-27', 'Jako Junior Webmaster, będziesz odgrywać kluczową rolę w tworzeniu, zarządzaniu i optymalizacji stron internetowych. Twoje główne zadania obejmą utrzymanie i aktualizację treści, dbanie o spójność i estetykę witryn oraz zapewnianie, że wszystkie strony działają poprawnie i są zoptymalizowane pod kątem wydajności i SEO.\r\n\r\nBędziesz pracować blisko z zespołem programistów, projektantów graficznych oraz specjalistów ds. marketingu, aby wdrażać nowe funkcje i poprawki, rozwiązywać problemy techniczne oraz dbać o najwyższą jakość doświadczeń użytkowników. Twoje obowiązki mogą również obejmować monitorowanie ruchu na stronie, analizowanie statystyk oraz wprowadzanie zmian na podstawie uzyskanych danych.\r\n\r\nWymagania na to stanowisko to podstawowa znajomość języków HTML, CSS i JavaScript, umiejętność korzystania z systemów zarządzania treścią (CMS), takich jak WordPress, oraz podstawowa wiedza na temat SEO i analityki internetowej. Znajomość narzędzi takich jak Google Analytics, podstawy graficznego projektowania oraz umiejętność pracy w zespole będą dodatkowymi atutami.\r\n\r\nIdealny kandydat to osoba z pasją do nowych technologii, kreatywna i dokładna, z dobrymi umiejętnościami komunikacyjnymi i gotowa do ciągłego uczenia się i rozwoju w dynamicznym środowisku internetowym.\r\n', 'Junior', 'Full-Time', 11);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `tin` varchar(15) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `birthdate` date NOT NULL,
  `work` varchar(50) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `mail`, `name`, `phone`, `tin`, `company_name`, `birthdate`, `work`, `description`) VALUES
(9, 'testo', '$2y$10$glWNsPxzPxJ/uIboNm0Tc.4ghnzy9xOuQy0B1/6TI5/', 'kola@gmail.com', 'konrad gho', '201900019', '', '', '0000-00-00', '', ''),
(11, 'colop', '$2y$10$RwgDZHv4gV1UvoB6/URyjOtF/Fpslih5BoWKYy1uByRodVJ22dAR2', 'colop@gmail.com', '', '', '291820392810', 'COLOP Polska', '0000-00-00', 'Drukarki', ''),
(12, 'chuj', '$2y$10$OgLweJpQI0F2FwPl/TjceeLB7Xf9.Z4bvsEwB6JUCUi7UNwPMVbk2', 'ania@gmail.com', 'ania danecka', '503000121', '', '', '0000-00-00', '', ''),
(13, 'Ivan', '$2y$10$dtisoH.RIAp5AUQzPf0ySOXY3y3VoGzR28CnLz0elBoJS2iIX4/1G', 'kornad@gmail.com', 'Ivan Korecko', '503222109', '', '', '0000-00-00', '', ''),
(14, 'konradd', '$2y$10$FYQwAFuVxOR.069HVof4AOx.6sjwsQ8Qrl99ieG7.ZVW4A2TEve3a', 'koin@gmail.com', 'konrad hoscilo', '102910290', '', '', '0000-00-00', '', ''),
(16, 'sad_skalmar2', '$2y$10$9XmBa4zN8m21ktez6bsJy.tXZa410old92WmkjoAIH3H/SE6WlZfu', 'konrad2323@gmail.com', 'konrad hościło', '102102102', '', '', '0000-00-00', 'Student', ''),
(17, 'Ivanisko', '$2y$10$VJhxfKApinC7iczuVml40eZsj51NoOxWRknSS6knxnd6r4mcVOKTS', 'Ivan22@gmail.com', 'Ivan Komis', '201920129', '', '', '0000-00-00', '', ''),
(19, 'sad_skalmar3', '$2y$10$7kp0WyfGOrjVqjTOrRipT.xHMmgbAd4Adh2YrwHUf0M5.tMraKcT6', 'konrad.hamiloo@gmail.com', 'Konrad Bombiło', '222111333', '', '', '0000-00-00', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`application_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `job_id` (`job_id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`job_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `mail` (`mail`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `applications_ibfk_2` FOREIGN KEY (`job_id`) REFERENCES `offers` (`job_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
