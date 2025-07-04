-- phpMyAdmin SQL Dump
-- version 5.2.2-dev+20241218.440f6dd41bdeb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 24, 2025 at 04:30 PM
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
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `unique_id` varchar(255) NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `otp_link_token` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`unique_id`, `email`, `password`, `otp_link_token`) VALUES
('66fd0rrf43716', 'chrisjosh087@gmail.com', 'Ohfwebsite4321##', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_sessions`
--

CREATE TABLE `admin_sessions` (
  `user_id` int(11) NOT NULL,
  `unique_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `browser_agent` text DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `verification_status` tinyint(1) DEFAULT NULL,
  `session_1` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_sessions`
--

INSERT INTO `admin_sessions` (`user_id`, `unique_id`, `created_at`, `browser_agent`, `ip_address`, `verification_status`, `session_1`) VALUES
(574733571, '66fd0rrf43716', '2025-03-24 14:02:13', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '::1', 1, '1e9421649412a15e26432076f2b75c2d8c50e27a1111c592bb6fd323d936d3fd3a43faec03da1e16849139c4bf8c5f6c6a0490b408451660646fa9bf'),
(1732955940, '66fd0rrf43716', '2025-03-24 16:01:28', 'Mozilla/5.0 (X11; Linux x86_64; rv:128.0) Gecko/20100101 Firefox/128.0', '127.0.0.1', 1, '86329214e2eb39ae5434a692f3d7ffb21b168dbdb5089f93769db27ad1a14562fcde1040ad021a9547684cae0ad5aa16efcdbe7783b9819c37bc262e');

-- --------------------------------------------------------

--
-- Table structure for table `blog_cover_image`
--

CREATE TABLE `blog_cover_image` (
  `image_id` varchar(6) NOT NULL,
  `blog_id` varchar(6) NOT NULL,
  `url_path` varchar(200) NOT NULL,
  `uploaded_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `blog_id` varchar(100) NOT NULL,
  `blog_title` varchar(200) NOT NULL,
  `blog_description` varchar(200) NOT NULL,
  `category` varchar(200) NOT NULL,
  `body` text NOT NULL,
  `image` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `published_at` timestamp NULL DEFAULT current_timestamp(),
  `status` enum('published','draft') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
 
--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`blog_id`, `blog_title`, `blog_description`, `category`, `body`, `image`, `created_at`, `published_at`, `status`) VALUES
('0ef0288eed2d', 'How to make rice', 'This is talking about food and it\'s menus', 'business', 'Boil the water and put the rice inside lolzz', 'Restaurant-Food-Promotion-Facebook-Cover-Design-scaled.jpg', '2025-03-24 14:16:43', '2025-03-24 14:16:43', 'published'),
('15d081a02c99', 'Talking about Marriage', 'This is talking about Marriage', 'health', 'Go and marry', 'png-clipart-fashion-clothing-woman-dress-design-woman-people-fashion.png', '2025-03-24 15:31:07', '2025-03-24 15:31:07', 'published'),
('2253271627b7', 'Artificial intelligence', 'This is talking about Tech', 'tech', 'This is a tech information', 'wallpaperflare.com_wallpaper.jpg', '2025-03-24 15:56:06', '2025-03-24 15:56:06', 'published'),
('2e26412337c1', 'Yam', 'This is talking about Business', 'business', 'akjsnkals', 'Restaurant-Food-Promotion-Facebook-Cover-Design-scaled.jpg', '2025-03-24 15:49:17', '2025-03-24 15:49:17', 'published'),
('34f12dbb21d9', 'Food', 'This is talking about food and it\'s menus', 'health', 'sjdskdmsldmw', 'Restaurant-Food-Promotion-Facebook-Cover-Design-scaled.jpg', '2025-03-24 15:46:19', '2025-03-24 15:46:19', 'published');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `doctor_id` int(11) NOT NULL,
  `doctor_name` varchar(200) NOT NULL,
  `area_of_specialization` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL,
  `is_available` tinyint(1) NOT NULL,
  `image` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `id` int(11) NOT NULL,
  `transaction_id` varchar(100) NOT NULL,
  `donor_name` varchar(255) DEFAULT NULL,
  `donor_email` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `currency` varchar(10) NOT NULL,
  `message` text DEFAULT NULL,
  `payment_status` enum('pending','successful','failed') DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nurses`
--

CREATE TABLE `nurses` (
  `nurse_id` int(11) NOT NULL,
  `nurse_name` varchar(200) NOT NULL,
  `area_of_specialization` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL,
  `is_available` tinyint(1) NOT NULL,
  `image` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `nurses`
--

INSERT INTO `nurses` (`nurse_id`, `nurse_name`, `area_of_specialization`, `status`, `is_available`, `image`, `created_at`) VALUES
(4, 'Esther', 'Surgeon', 'nurse', 1, 'png-clipart-fashion-clothing-woman-dress-design-woman-people-fashion.png', '2025-03-24 16:26:19');

-- --------------------------------------------------------

--
-- Table structure for table `partnership_table`
--

CREATE TABLE `partnership_table` (
  `name` varchar(200) NOT NULL,
  `gender` varchar(200) NOT NULL,
  `profession` varchar(200) NOT NULL,
  `volunteer_field` varchar(200) NOT NULL,
  `status` enum('approved','pending','rejected') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `physiologist`
--

CREATE TABLE `physiologist` (
  `physiologist_id` int(11) NOT NULL,
  `physiologist_name` varchar(200) NOT NULL,
  `area_of_specialization` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL,
  `is_available` tinyint(1) NOT NULL,
  `image` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `physiologist`
--

INSERT INTO `physiologist` (`physiologist_id`, `physiologist_name`, `area_of_specialization`, `status`, `is_available`, `image`, `created_at`) VALUES
(1, 'Davis Jeff', 'Surgeon', 'physiologist', 0, 'wallpaperflare.com_wallpaper.jpg', '2025-03-24 16:25:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`unique_id`);

--
-- Indexes for table `admin_sessions`
--
ALTER TABLE `admin_sessions`
  ADD KEY `fk_admins_unique_id` (`unique_id`);

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD UNIQUE KEY `blog_id` (`blog_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD UNIQUE KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transaction_id` (`transaction_id`);

--
-- Indexes for table `nurses`
--
ALTER TABLE `nurses`
  ADD UNIQUE KEY `nurse_id` (`nurse_id`);

--
-- Indexes for table `physiologist`
--
ALTER TABLE `physiologist`
  ADD UNIQUE KEY `physiologist_id` (`physiologist_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `doctor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nurses`
--
ALTER TABLE `nurses`
  MODIFY `nurse_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `physiologist`
--
ALTER TABLE `physiologist`
  MODIFY `physiologist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_sessions`
--
ALTER TABLE `admin_sessions`
  ADD CONSTRAINT `fk_admins_unique_id` FOREIGN KEY (`unique_id`) REFERENCES `admins` (`unique_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
