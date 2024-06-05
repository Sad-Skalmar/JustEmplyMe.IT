-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2024 at 01:47 AM
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
(15, 'Sprzedawca', 1000, 5000, 'COLOP Polska', 'Katowice', '', '2024-06-03', 'Praca sprzedawcy warzyw to jedno z tych zajęć, które, choć może wydawać się proste, niesie za sobą wiele wyzwań i wymaga szeregu umiejętności. To praca, która wymaga nie tylko znajomości asortymentu, ale także umiejętności interpersonalnych, zrozumienia zasad handlu oraz dbania o jakość produktów.\r\nCodzienne Zadania\r\n\r\nPraca sprzedawcy warzyw zaczyna się często bardzo wcześnie rano. Pierwszym zadaniem jest przygotowanie stoiska – rozstawienie warzyw w sposób estetyczny i atrakcyjny dla klientów. Ważne jest, aby warzywa były świeże, czyste i dobrze wyeksponowane. Sprzedawca musi znać techniki przechowywania, aby produkty jak najdłużej zachowały świeżość.\r\nKontakt z Klientem\r\n\r\nSprzedawca warzyw musi być komunikatywny i otwarty. Codziennie spotyka różne osoby i musi umieć odpowiadać na ich pytania dotyczące produktów. Klienci często pytają o pochodzenie warzyw, metody uprawy, czy sposoby przygotowania. Dlatego sprzedawca powinien mieć wiedzę na temat sezonowości, wartości odżywczych i sposobów przygotowania warzyw.\r\nZnajomość Produktów\r\n\r\nKluczowym aspektem pracy sprzedawcy warzyw jest doskonała znajomość asortymentu. Sprzedawca powinien wiedzieć, które warzywa są najlepsze w danym sezonie, jak rozpoznać świeżość i jakość produktów oraz jakie są ich właściwości zdrowotne. Wiedza ta jest nie tylko przydatna podczas rozmów z klientami, ale także pomaga w efektywnym zarządzaniu zapasami.\r\nUmiejętności Handlowe\r\n\r\nSprzedawca warzyw to także dobry handlowiec. Musi umieć zachęcić klientów do zakupu, promować mniej popularne produkty oraz negocjować ceny, zwłaszcza na targach. Umiejętność przekonywania i budowania relacji z klientami jest tutaj kluczowa. Warto również, aby sprzedawca umiał szybko obsługiwać kasy fiskalne i posługiwać się podstawowymi technikami marketingowymi.\r\nDbanie o Higienę\r\n\r\nDbanie o higienę stoiska i produktów to kolejny istotny aspekt pracy sprzedawcy warzyw. Regularne sprzątanie, mycie warzyw oraz utrzymanie porządku na stoisku wpływają na postrzeganie sprzedawcy przez klientów. Czystość jest jednym z najważniejszych czynników wpływających na decyzje zakupowe klientów.\r\nWyzwania Zawodowe\r\n\r\nPraca sprzedawcy warzyw wiąże się także z pewnymi wyzwaniami. Przede wszystkim jest to praca fizyczna – przenoszenie skrzynek z warzywami, długie godziny spędzone na nogach, niezależnie od warunków pogodowych. Dodatkowo, praca ta wymaga ciągłej uwagi i gotowości do odpowiedzi na potrzeby klientów.\r\nSatysfakcja z Pracy\r\n\r\nMimo trudności, praca sprzedawcy warzyw może być bardzo satysfakcjonująca. Kontakt z ludźmi, możliwość oferowania zdrowych i świeżych produktów, a także satysfakcja z prowadzenia własnego stoiska czy sklepu to tylko niektóre z pozytywnych aspektów tej pracy. Wielu sprzedawców ceni sobie niezależność i bezpośredni wpływ na sukces swojego przedsięwzięcia.\r\nPodsumowanie\r\n\r\nPraca sprzedawcy warzyw to zawód wymagający zaangażowania, wiedzy i umiejętności interpersonalnych. Choć niesie ze sobą pewne wyzwania, oferuje także wiele możliwości satysfakcji zawodowej i osobistej. Sprzedawca warzyw to ktoś, kto nie tylko sprzedaje produkty, ale także dba o zdrowie i zadowolenie swoich klientów, co czyni tę pracę niezwykle wartościową i znaczącą.\r\n', '', 'Practice / Internship', 11),
(16, 'C++ Developer', 10000, 15000, 'COLOP Polska', 'Katowicec', '', '2024-06-03', 'Rola w organizacji:\r\nDo naszego zespołu poszukujemy C++ Developera, osoby zafascynowanej programowaniem w języku C++ oraz tworzeniem zaawansowanych aplikacji. Jeśli jesteś pasjonatem technologii, a tworzenie efektywnych i funkcjonalnych rozwiązań sprawia Ci radość, to ta praca jest dla Ciebie! Dołącz do nas i sprawdź poniżej, co oferujemy oraz jakie są oczekiwania względem kandydatów.\r\n\r\nOczekiwania:\r\nDoświadczenie zawodowe w programowaniu w języku C++\r\nZnajomość struktur danych i algorytmów\r\nUmiejętność pracy z systemami operacyjnymi Unix/Linux\r\nZnajomość narzędzi programistycznych (np. Git, Make)\r\nDokładność oraz optymalizacja kodu\r\nBiegła znajomość języka angielskiego w celu czytania dokumentacji technicznej\r\nWykształcenie wyższe techniczne lub informatyczne\r\n\r\nZadania:\r\nProjektowanie i implementacja zaawansowanych aplikacji w języku C++\r\nDiagnozowanie i usuwanie błędów w kodzie\r\nTestowanie i wdrażanie aplikacji\r\nOptymalizacja wydajności aplikacji\r\nTworzenie dokumentacji technicznej\r\n\r\nCo oferujemy?\r\nWynagrodzenie w przedziale od 8000 do 15000 PLN brutto miesięcznie\r\nUmowę o pracę lub B2B\r\nPrywatną opiekę medyczną\r\nMożliwość pracy zdalnej lub hybrydowej\r\nElastyczne godziny pracy\r\nPakiet szkoleń i możliwości rozwoju zawodowego\r\nAtmosferę sprzyjającą rozwojowi osobistemu i zawodowemu\r\nKartę Multisport\r\nUdział w wydarzeniach branżowych\r\nIntegracje firmowe i wyjścia integracyjne\r\nElastyczny system premiowy (np. premie za wydajność, premie świąteczne)', 'Hybrid', 'Part-Time', 11),
(17, 'Python developer', 7000, 10000, 'COLOP Polska', 'Katowice', '', '2024-06-03', 'Rola w organizacji:\r\nSzukamy Python Developera, który pasjonuje się tworzeniem nowoczesnych aplikacji i narzędzi wykorzystujących język Python. Jeśli jesteś osobą, która nie boi się wyzwań programistycznych, ciągle poszukuje nowych sposobów rozwoju i chce pracować w dynamicznym środowisku, to ta oferta jest właśnie dla Ciebie. Sprawdź poniżej, co oferujemy i czego oczekujemy od kandydatów na to stanowisko.\r\n\r\nOczekiwania:\r\n\r\nDoświadczenie w programowaniu w języku Python\r\nZnajomość frameworków takich jak Django, Flask\r\nUmiejętność pracy z bazami danych SQL i NoSQL\r\nZnajomość systemów kontroli wersji (np. Git)\r\nPraktyczna znajomość zagadnień związanych z RESTful API\r\nUmiejętność pracy w zespole oraz komunikatywność\r\nGotowość do nauki i rozwijania swoich umiejętności\r\nWykształcenie wyższe kierunkowe związane z informatyką lub pokrewnymi dziedzinami\r\nBardzo dobra znajomość języka angielskiego\r\n\r\nZadania:\r\n\r\nProjektowanie i rozwój zaawansowanych aplikacji przy użyciu języka Python\r\nWspółpraca z zespołem deweloperskim w celu tworzenia i wdrażania nowych funkcji\r\nDiagnozowanie i usuwanie błędów w aplikacjach, dbanie o ich wydajność\r\nTestowanie aplikacji i zapewnianie ich jakości\r\nCiągłe doskonalenie istniejących funkcjonalności oraz wprowadzanie nowych\r\nTworzenie dokumentacji technicznej\r\n\r\nCo oferujemy?\r\n\r\nWynagrodzenie w przedziale 8000 - 14000 PLN brutto miesięcznie\r\nUmowę o pracę lub B2B\r\nPrywatną opiekę medyczną\r\nMożliwość pracy zdalnej lub hybrydowej\r\nElastyczne godziny pracy\r\nSzkolenia i konferencje branżowe\r\nKartę MultiSport\r\nPrzyjazną atmosferę pracy\r\nPremie za osiągnięcia\r\nMożliwość pracy z najnowszymi technologiami', 'Stationary', 'Full-Time', 11),
(18, 'Js Developer', 2000, 5000, 'COLOP Polska', 'Katowice', '', '2024-06-03', 'Js developer to specjalista w dziedzinie programowania, który specjalizuje się w języku JavaScript. Zadaniem takiej osoby jest projektowanie, budowanie i rozwijanie aplikacji internetowych lub mobilnych.\r\n\r\nObowiązki:\r\n\r\nTworzenie i utrzymywanie oprogramowania JavaScript zgodnie z wymaganiami klienta i specyfikacjami projektu.\r\nUdział w procesie projektowym, w tym analiza wymagań, projektowanie, testowanie i udoskonalanie oprogramowania.\r\nRozwiązywanie problemów związanych z oprogramowaniem, w tym debugowanie i naprawa błędów.\r\n\r\nKorzystanie z narzędzi programistycznych, takich jak środowisko programistyczne, system kontroli wersji i testowanie automatyczne.\r\nWspółpraca z innymi członkami zespołu projektowego w celu zapewnienia efektywnego i skutecznego wykorzystania zasobów.\r\n\r\nMonitorowanie trendów i nowych technologii w dziedzinie oprogramowania, aby pozostać aktualnym i dostarczać najnowsze rozwiązania klientom.\r\nWymagany poziom zdolności analitycznych i zdolność do pracy w zespole.\r\nOdpowiedzialność za przestrzeganie procedur i standardów programistycznych w celu zapewnienia jakości i niezawodności oprogramowania.\r\n\r\nWymagania:\r\nDoświadczenie w programowaniu w języku JavaScript oraz znajomość przynajmniej jednego frameworka, takiego jak Angular, React itp.\r\nUmiejętność pracy w zespole oraz dobra komunikacja interpersonalna.\r\nZnajomość narzędzi deweloperskich, takich jak GIT, Webpack itp.\r\nZnajomość zagadnień związanych z responsywnością stron internetowych i aplikacji.\r\nUmiejętność rozwiązywania problemów i znajomość podstawowych algorytmów.\r\nDoświadczenie w testowaniu kodu i pisanie testów jednostkowych.\r\nZnajomość języka angielskiego na poziomie umożliwiającym komunikację z programistami z innych krajów.\r\nZainteresowanie najnowszymi technologiami i chęć do nauki.', 'Remote', 'Full-Time', 11),
(19, 'Sprzątacz', 1500, 5000, 'COLOP Polska', 'Katowice', '', '2024-06-03', 'Poszukuje osoby sprzątającej do biura', 'Stationary', 'Practice / Internship', 11),
(21, 'Sprzedawca jaj', 3000, 5000, 'COLOP Polska', 'Katowice', 'Stationary', '2024-06-06', 'Daj to taki chinski sprzedawca jaj', 'Mid', 'Full-Time', 11);

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
(16, 'sad_skalmar2', '$2y$10$9XmBa4zN8m21ktez6bsJy.tXZa410old92WmkjoAIH3H/SE6WlZfu', 'konrad2323@gmail.com', 'konrad hościło', '102102102', '', '', '0000-00-00', 'Student', '');

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
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
