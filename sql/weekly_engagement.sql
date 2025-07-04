-- phpMyAdmin SQL Dump
-- version 5.2.2-dev+20241218.440f6dd41bdeb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 27, 2025 at 08:52 PM
-- Server version: 11.4.3-MariaDB-1
-- PHP Version: 8.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ohfwebsite`
--

-- --------------------------------------------------------

--
-- Table structure for table `weekly_engagement`
--

CREATE TABLE `weekly_engagement` (
  `id` int(11) NOT NULL,
  `week` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `sun` int(11) DEFAULT 0,
  `mon` int(11) DEFAULT 0,
  `tue` int(11) DEFAULT 0,
  `wed` int(11) DEFAULT 0,
  `thu` int(11) DEFAULT 0,
  `fri` int(11) DEFAULT 0,
  `sat` int(11) DEFAULT 0,
  `total` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `weekly_engagement`
--

INSERT INTO `weekly_engagement` (`id`, `week`, `month`, `year`, `sun`, `mon`, `tue`, `wed`, `thu`, `fri`, `sat`, `total`) VALUES
(1, 13, 3, 2025, 0, 1, 11, 0, 5, 0, 0, 17);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `weekly_engagement`
--
ALTER TABLE `weekly_engagement`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `weekly_engagement`
--
ALTER TABLE `weekly_engagement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
