-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2024 at 11:49 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `voting`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Makes Work Fun'),
(2, 'Team Player'),
(3, 'Culture Champion'),
(4, 'Difference Maker');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`) VALUES
(1, 'Stole Ristov'),
(2, 'Dragan Stojanov'),
(3, 'Gjorgi Mitrevski'),
(4, 'Davor Milenkov'),
(5, 'Ivan Ivanov');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `nominee_id` int(11) NOT NULL,
  `voter_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `category_id`, `nominee_id`, `voter_id`, `comment`, `timestamp`) VALUES
(1, 1, 2, 1, 'ITS ME ', '2024-12-04 13:25:19'),
(2, 1, 2, 1, 'ITS ME ', '2024-12-04 15:41:04'),
(3, 3, 3, 1, 'sad', '2024-12-04 15:41:25'),
(4, 3, 3, 1, 'sad', '2024-12-04 18:21:48'),
(5, 2, 2, 1, 'sdadasd', '2024-12-05 11:03:32'),
(6, 2, 2, 1, 'sdadasd', '2024-12-05 11:09:46'),
(7, 2, 2, 1, 'sdadasd', '2024-12-05 20:45:53'),
(8, 2, 2, 1, 'sdadasd', '2024-12-05 20:45:56'),
(9, 1, 3, 1, 'asdad', '2024-12-05 20:46:38'),
(10, 4, 4, 1, 'asadasd', '2024-12-05 20:51:57'),
(11, 1, 2, 1, 'he is funny ', '2024-12-05 21:06:00'),
(12, 1, 4, 1, 'top excelent \r\n', '2024-12-05 21:07:20'),
(13, 4, 4, 1, 'excelent player ', '2024-12-05 21:07:47'),
(14, 2, 1, 4, 'top ', '2024-12-05 21:08:19'),
(15, 2, 1, 4, 'top ', '2024-12-05 21:13:59'),
(16, 2, 1, 4, 'top ', '2024-12-05 21:55:05'),
(17, 1, 3, 1, 'asdasd', '2024-12-05 21:55:19'),
(18, 3, 3, 4, 'top', '2024-12-05 21:56:13'),
(19, 3, 3, 4, 'top', '2024-12-05 22:07:30'),
(20, 2, 4, 2, 'excelent ', '2024-12-05 22:34:58'),
(21, 1, 2, 5, 'excelent ', '2024-12-05 22:35:25'),
(22, 1, 2, 5, 'excelent ', '2024-12-05 22:41:47'),
(23, 1, 3, 4, '.', '2024-12-05 22:42:19'),
(24, 1, 3, 4, 'good ', '2024-12-05 22:45:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `nominee_id` (`nominee_id`),
  ADD KEY `voter_id` (`voter_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`nominee_id`) REFERENCES `employees` (`id`),
  ADD CONSTRAINT `votes_ibfk_3` FOREIGN KEY (`voter_id`) REFERENCES `employees` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
