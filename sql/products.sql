-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2026 at 12:56 AM
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
-- Database: `restaurant_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `image`, `created_by`) VALUES
(1, 'Ushqimet tona', 'Në restorantin tonë, çdo pjatë është një udhëtim shijesh. 		Përgatitur me përbërës të freskët dhe të zgjedhur me kujdes, ushqimet tona 		 kombinojnë traditën me kreativitetin modern', 'images/food.jpg', 1),
(2, 'Pijet tona', 'Pijet tona janë menduar për të plotësuar çdo shije dhe 	për të sjellë freski në çdo moment. Çdo gotë është një eksperiencë më vete 		nga freskia e frutave deri te eleganca e verës, pijet tona janë krijuar për 	të kënaqur çdo klient.', 'images/drinks.jpg', 1),
(3, 'Këndi i lojërave', 'Në restorantin tonë, fëmijët gëzojnë një kënd lojërash të sigurt dhe argëtues, ku mund të luajnë e të shijojnë momente të gëzueshme ndërsa prindërit relaksohen. Kjo hapësirë e veçantë është menduar për të sjellë buzëqeshje dhe energji pozitive për më të vegjlit.', 'images/Img6.png', 1),
(4, 'Lokacioni', 'Restoranti ynë ndodhet në një vend të veçantë, pranë Burimit të Istogut, ku uji i kristaltë buron mes gjelbërimit dhe krijon një atmosferë të qetë e relaksuese. rrethuar nga malet madhështore të Istogut, lokacioni ynë ofron një pamje të mrekullueshme natyrore, ideale për të shijuar ushqimin në harmoni me tingujt e natyrës.', 'images/lokacion.png', 1),
(5, 'Ambienti', 'Rreth restorantit shtrihet një mjedis i gjelbër dhe i qetë, ku lumi me ujë të pastër rrjedh mes gurëve dekorativë dhe shatërvanëve të vegjël. Tingulli i ujit bashkohet me gjelbërimin përreth, duke krijuar një atmosferë të relaksuar dhe të veçantë për çdo vizitor', 'images/ambienti.png', 1),
(6, 'Parkingu', 'Restoranti ynë ofron hapësirë të bollshme për parkim , ofron dy zona të përshtatshme për parkim: një hapësirë të gjerë në fillim të hyrjes dhe një tjetër më afër ndërtesës, e menduar posaçërisht për personat që kanë vështirësi në ecje. Kjo organizim siguron qasje të lehtë dhe komoditet për çdo vizitor.', 'images/parking.png', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
