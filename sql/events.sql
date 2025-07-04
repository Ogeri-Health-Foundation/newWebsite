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
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `event_id` varchar(100) NOT NULL,
  `title` varchar(200) NOT NULL,
  `banner_image` varchar(200) NOT NULL,
  `location` varchar(200) NOT NULL,
  `time` time(6) NOT NULL,
  `date` date NOT NULL,
  `description` varchar(200) NOT NULL,
  `body` text NOT NULL,
  `status` enum('completed','upcoming') NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_id`, `title`, `banner_image`, `location`, `time`, `date`, `description`, `body`, `status`, `created_at`) VALUES
(1, 'ba61de03d420', 'Chicken republic', 'Restaurant-Food-Promotion-Facebook-Cover-Design-scaled.jpg', 'Ojota', '13:24:00.000000', '2025-03-25', 'Visit near by Resturanat', 'A place where all type of meals are served', 'completed', '2025-03-25 22:32:08'),
(2, 'cf46c1fb4b0c', 'Lagos Tech Fest', 'depositphotos_449066958-stock-photo-financial-accounting-logo-financial-logo-removebg-preview.png', 'Landmark', '09:00:00.000000', '2025-03-31', 'Lagos Tech Festival', 'Attend Lagos Tech Festival to Connect with people and all', 'upcoming', '2025-03-26 08:47:31'),
(3, '0c7c16ec4ed2', 'Cyber Fest', 'Restaurant-Food-Promotion-Facebook-Cover-Design-scaled.jpg', 'Landmark', '02:11:00.000000', '2025-03-26', 'Cyber fest is fun', 'Let\'s get started with cyber fest', 'upcoming', '2025-03-26 10:08:32'),
(4, '2fa9278ea562', 'Caterring', 'png-clipart-fashion-clothing-woman-dress-design-woman-people-fashion.png', 'LAGOS', '13:52:00.000000', '2025-03-26', 'NIVEE', 'LETS GOO', 'upcoming', '2025-03-26 10:52:42'),
(5, '3d80dec2c28a', 'Mr Robot', 'wallpaperflare.com_wallpaper.jpg', 'USA', '10:34:00.000000', '2025-03-26', 'This series is so cool', 'I love Mr robot', 'completed', '2025-03-26 18:31:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
