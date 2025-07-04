  -- phpMyAdmin SQL Dump
  -- version 5.2.2-dev+20241218.440f6dd41bdeb1
  -- https://www.phpmyadmin.net/
  --
  -- Host: localhost:3306
  -- Generation Time: Mar 21, 2025 at 08:01 PM
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
  (1488836857, '66fd0rrf43716', '2025-03-21 08:41:16', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '::1', 1, '9ff5aba7121063ed55f601320c5d51968b73cc2d7c23429e7fdeb27bc05e93d9b86f9cc846871f4a2b3a126700041fe11399e50c20f19a19d39ca091');

  -- --------------------------------------------------------

  --
  -- Table structure for table `blog_cover_image`
  --

  CREATE TABLE `blog_cover_image` (
    `image_id` varchar(6) NOT NULL,
    `blog_id` varchar(6) NOT NULL,
    `url_path` varchar(200) NOT NULL,
    `uploaded_at` timestamp NULL DEFAULT current_timestamp()
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

  --
  -- Dumping data for table `blog_posts`
  --

  INSERT INTO `blog_posts` (`blog_id`, `blog_title`, `blog_description`, `category`, `body`, `image`, `created_at`, `published_at`, `status`) VALUES
  ('5a904b1d2e3a', 'Machine learning', 'This is talking about Tech', 'tech', 'hahahahaha', 'wallpaperflare.com_wallpaper.jpg', '2025-03-20 22:32:20', '2025-03-20 22:32:20', 'published'),
  ('d5fa157e7440', 'How to make Rice', 'This Blog talks about rice', 'business', 'I Like eating rice me and jellof rice get cordial relationship ', 'Restaurant-Food-Promotion-Facebook-Cover-Design-scaled.jpg', '2025-03-20 16:10:42', '2025-03-20 16:10:42', 'published');

  -- --------------------------------------------------------

  --
  -- Table structure for table `doctors`
  --

  CREATE TABLE `doctors` (
    `doctor_id` varchar(100) NOT NULL,
    `doctor_name` varchar(200) NOT NULL,
    `area_of_specialization` varchar(200) NOT NULL,
    `status` varchar(200) NOT NULL,
    `is_available` tinyint(1) NOT NULL,
    `image` varchar(200) NOT NULL,
    `created_at` timestamp NULL DEFAULT current_timestamp()
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

  --
  -- Dumping data for table `doctors`
  --

  INSERT INTO `doctors` (`doctor_id`, `doctor_name`, `area_of_specialization`, `status`, `is_available`, `image`, `created_at`) VALUES
  ('000061', 'Davis Jeff', 'doctor', 'doctor', 1, 'png-clipart-fashion-clothing-woman-dress-design-woman-people-fashion.png', '2025-03-21 08:41:54'),
  ('00006133', 'kenny', 'doctor', 'doctor', 1, 'ddcd4128b1ac1ae2b35c62bf242045c9-removebg-preview.png', '2025-03-21 08:46:09');

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
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

  -- --------------------------------------------------------

  --
  -- Table structure for table `nurses`
  --

  CREATE TABLE `nurses` (
    `nurse_id` varchar(100) NOT NULL,
    `nurse_name` varchar(200) NOT NULL,
    `area_of_specialization` varchar(200) NOT NULL,
    `status` varchar(200) NOT NULL,
    `is_available` tinyint(1) NOT NULL,
    `image` varchar(200) NOT NULL,
    `created_at` timestamp NULL DEFAULT current_timestamp()
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

  --
  -- Dumping data for table `nurses`
  --

  INSERT INTO `nurses` (`nurse_id`, `nurse_name`, `area_of_specialization`, `status`, `is_available`, `image`, `created_at`) VALUES
  ('00006', 'Esther', 'nurse', 'nurse', 1, 'png-clipart-fashion-clothing-woman-dress-design-woman-people-fashion-removebg-preview.png', '2025-03-21 08:42:46'),
  ('000061', 'kehinde', 'nurse', 'nurse', 1, 'ddcd4128b1ac1ae2b35c62bf242045c9-removebg-preview.png', '2025-03-21 08:50:15'),
  ('00006133', 'kenny', 'nurse', 'nurse', 1, 'ddcd4128b1ac1ae2b35c62bf242045c9-removebg-preview.png', '2025-03-21 08:50:00');

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
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

  -- --------------------------------------------------------

  --
  -- Table structure for table `physiologist`
  --

  CREATE TABLE `physiologist` (
    `physiologist_id` varchar(100) NOT NULL,
    `physiologist_name` varchar(200) NOT NULL,
    `area_of_specialization` varchar(200) NOT NULL,
    `status` varchar(200) NOT NULL,
    `is_available` tinyint(1) NOT NULL,
    `image` varchar(200) NOT NULL,
    `created_at` timestamp NULL DEFAULT current_timestamp()
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

  --
  -- Dumping data for table `physiologist`
  --

  INSERT INTO `physiologist` (`physiologist_id`, `physiologist_name`, `area_of_specialization`, `status`, `is_available`, `image`, `created_at`) VALUES
  ('544345', 'josi', 'Physiologist', 'Physiologist', 0, 'Group (3).png', '2025-03-21 08:48:24');

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
  -- AUTO_INCREMENT for table `donations`
  --
  ALTER TABLE `donations`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
