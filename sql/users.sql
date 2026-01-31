-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2026 at 11:31 PM
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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `PASSWORD`, `role`) VALUES
(1, 'Drion', 'Driongegollaj@gmail.com', '$2y$10$mj71LEt37i6uSECtiwWHAeawLppNX38pvkbGzaXOazMa5j7DUbU6K', 'admin'),
(3, 'DRION', 'driongegollaj17@gmail.com', '$2y$10$SXifghyd8MP7mdmEDB6ycuvaVW9XBPwS19iRvhSdSDAYIApYoJ2Ve', 'admin'),
(4, 'Filan', 'Filani@gmail.com', '$2y$10$X5WgGnrRe6SgcRH9K3T5ge7ggz36r4.60ohd4Hy7YxhvP//UU6E9K', 'user'),
(5, 'driongegolla', 'drion.gegollaj@gmail.com', '$2y$10$flk09yUsOJcQRXh5tfL1N.CYGtwTYSG2X3T70cyTiYYbzk3cQqJJi', 'admin'),
(6, 'test', 'test@gmail.com', '$2y$10$rbqoVhi.JvXzOfTU7XGRKe5wf69bU/N846Glox2ysL2m4y69edNoO', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
