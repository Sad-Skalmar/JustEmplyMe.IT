-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2024 at 12:05 AM
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
  `type` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`job_id`, `name`, `min_salary`, `max_salary`, `company`, `location`, `workplace`, `date`, `description`, `experience`, `type`) VALUES
(1, 'sprzedawca', 13213, 23123121, 'Żabka', 'katowice', 'Stationary', '2024-05-22', '31321321', 'Mid', 'Practice / Internship'),
(2, 'Dev C++', 7000, 10000, 'agile', 'katowice', '', '2024-05-22', 'DEV +++C', '', ''),
(3, 'dadfwa', 22212, 23332, 'ube', 'kodsak', '', '2024-05-22', 'dwadawfa', '', ''),
(4, 'Python Developer', 2000, 6000, 'agile', 'warszawa', '', '2024-05-22', 'Opis stanowiska:\r\n\r\nJesteśmy dynamiczną firmą technologiczną, która rozwija innowacyjne rozwiązania w obszarze oprogramowania. Aktualnie poszukujemy doświadczonego programisty C++, który dołączy do naszego zespołu rozwojowego. Poszukujemy kreatywnej i ambitnej osoby, gotowej na wyzwania związane z tworzeniem oprogramowania wysokiej jakości.\r\n\r\nObowiązki:\r\n\r\n    Tworzenie, rozwijanie i utrzymywanie oprogramowania w języku C++\r\n    Bieżąca optymalizacja i poprawa wydajności istniejących rozwiązań\r', '', ''),
(5, 'dwadwa', 212, 3213, 'dwa', 'dwa', '', '2024-05-22', 'dwadwa', '', ''),
(6, 'tesdt', 321, 3213213, 'tesdt', 'tesdt', '', '2024-05-22', 'dwadwadwa', '', ''),
(7, 'test', 321, 321321, 'test', 'test', '', '2024-05-22', 'dwadwadwa', '', ''),
(8, 'dwadwa', 321, 321, 'dwa', 'dwa', 'Stationary', '2024-05-22', 'dwadwa', 'Mid', 'Part-Time'),
(9, 'dwa', 3123, 1321, 'dad', 'adwa', 'Stationary', '2024-05-22', 'wadwadwadaw', 'Junior', 'Full-Time'),
(10, 'wadwa', 321312, 3123, 'dwadsa', '', 'Stationary', '2024-05-22', 'dwadwadwadwa', 'Trainee', 'Full-Time'),
(11, 'dwadaw', 321312, 213123, 'dsaf', 'asdfsada', 'Remote', '2024-05-22', 'dwadwadsafds', 'Junior', 'Full-Time'),
(12, 'CSS Developer', 7000, 10000, 'CSSS', 'katowice', 'Stationary', '2024-05-22', 'Stanowisko: CSS Developer\r\n\r\nLokalizacja: Dowolna (praca zdalna lub lokalizacja biura w [miasto/miasta])\r\n\r\nRodzaj pracy: Pełny etat / Umowa o pracę\r\n\r\nOpis stanowiska:\r\n\r\nSzukamy doświadczonego i kreatywnego CSS developera, który dołączy do naszego zespołu projektowego. Jako część zespołu IT będziesz odpowiedzialny/a za projektowanie, tworzenie i utrzymanie interfejsów użytkownika naszych aplikacji internetowych. Poszukujemy pasjonatów, którzy lubią wyzwania i mają silne umiejętności w dziedzinie CSS oraz znajomość najlepszych praktyk.\r\n\r\nObowiązki:\r\n\r\n    Projektowanie i rozwój responsywnych, estetycznych i intuicyjnych interfejsów użytkownika przy użyciu CSS, HTML i JavaScript.\r\n    Tworzenie wieloplatformowych stron internetowych, które zapewniają spójność wizualną i użyteczność.\r\n    Optymalizacja wydajności i responsywności stron internetowych.\r\n    Współpraca z zespołem projektowym w celu realizacji wymagań projektowych i dostosowania projektów do potrzeb klientów.\r\n    Śledzenie i implementacja najnowszych trendów i technologii w projektowaniu interfejsów użytkownika.\r\n\r\nWymagania:\r\n\r\n    Doświadczenie w projektowaniu interfejsów użytkownika przy użyciu CSS, HTML i JavaScript.\r\n    Znajomość narzędzi do pracy z CSS, takich jak preprocessors (np. Sass, Less) oraz narzędzia do zarządzania zależnościami (np. npm, yarn).\r\n    Umiejętność pracy z systemami kontroli wersji, takimi jak Git.\r\n    Zrozumienie zasad responsywnego projektowania i umiejętność dostosowania projektów do różnych urządzeń i przeglądarek.\r\n    Doskonałe umiejętności komunikacyjne oraz zdolność pracy w zespole.\r\n\r\nMile widziane:\r\n\r\n    Doświadczenie w pracy nad projektami e-commerce.\r\n    Znajomość narzędzi do projektowania graficznego, takich jak Adobe Photoshop czy Sketch.\r\n    Znajomość podstawowych zasad UX/UI.\r\n    Zainteresowanie i znajomość najnowszych trendów w projektowaniu stron internetowych.\r\n\r\nOferujemy:\r\n\r\n    Elastyczne godziny pracy i możliwość pracy zdalnej.\r\n    Konkurencyjne wynagrodzenie oraz pakiet benefitów (np. prywatna opieka medyczna, karta Multisport).\r\n    Możliwość rozwoju zawodowego i uczestnictwa w szkoleniach branżowych.\r\n    Przyjazną atmosferę pracy w dynamicznym zespole.\r\n\r\nJeśli jesteś pasjonatem technologii, masz doświadczenie w projektowaniu responsywnych interfejsów użytkownika oraz chcesz rozwijać się zawodowo w dynamicznym środowisku pracy, czekamy na Twoje zgłoszenie!', 'Senior', 'Full-Time'),
(13, 'test', 321321, 321321, 'test', 'test', 'Remote', '2024-05-22', 'dwadwada', 'Mid', 'Full-Time'),
(14, 'dwadwa', 31231, 321321, 'dawdwa', 'dwadwa', '', '2024-05-27', 'dwadwadaw', 'Stationary', 'Part-Time');

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
(14, 'konradd', '$2y$10$FYQwAFuVxOR.069HVof4AOx.6sjwsQ8Qrl99ieG7.ZVW4A2TEve3a', 'koin@gmail.com', 'konrad hoscilo', '102910290', '', '', '0000-00-00', '', '');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
