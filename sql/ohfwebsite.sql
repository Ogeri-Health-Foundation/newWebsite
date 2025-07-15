-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2025 at 12:26 AM
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
('66fd0rrf43716', 'praiseonojs@gmail.com', 'Ohfwebsite4321##', '4bda4fb6fa934d4751c447af6625f870d18732b42c3ea06ae62c71bddc321baf853b2baf793709caddbe7778f69e89587785');

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
(1488836857, '66fd0rrf43716', '2025-03-21 08:41:16', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '::1', 1, '9ff5aba7121063ed55f601320c5d51968b73cc2d7c23429e7fdeb27bc05e93d9b86f9cc846871f4a2b3a126700041fe11399e50c20f19a19d39ca091'),
(942925002, '66fd0rrf43716', '2025-03-27 20:17:47', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:136.0) Gecko/20100101 Firefox/136.0', '127.0.0.1', 1, 'a98c40fc2be9b501f4583a2afff7ead5b1b3af0ac5008cc7cb24cb73e301d912f67d00e72af20d50c40f03f8ad9d064ccdbbdcd38660128b0717943d'),
(1348662288, '66fd0rrf43716', '2025-04-06 17:52:16', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:137.0) Gecko/20100101 Firefox/137.0', '127.0.0.1', 1, '2c82f0a6890ed01929e4969b430ebe53c557d41c3ead052ea2ef61d762d2d806c23cc00d568840e71118a0162d3cdbada5509f5cfdf418ceea5e52c7');

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
-- Table structure for table `blog_images`
--

CREATE TABLE `blog_images` (
  `blog_image_id` varchar(100) NOT NULL,
  `blog_id` varchar(100) NOT NULL,
  `img_path` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog_images`
--

INSERT INTO `blog_images` (`blog_image_id`, `blog_id`, `img_path`) VALUES
('gallery_67f3f410a5739', 'bd0fc30c225c', 'gZbJ-1ej.jpg'),
('gallery_67f3f410ad187', 'bd0fc30c225c', 'iMSNae3I.jpg');

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
('5a904b1d2e3a', 'Machine learning', 'This is talking about Tech', 'tech', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed viverra arcu vel est hendrerit, sit amet malesuada augue vestibulum. Duis facilisis mauris in libero tincidunt, ac aliquam nunc tincidunt. Nulla facilisi. Sed ut velit non purus vehicula luctus. Integer sagittis ex non justo viverra tincidunt. Aliquam erat volutpat. Vivamus non porta velit. Donec feugiat, tortor at accumsan euismod, nunc nulla vulputate nisl, nec rutrum neque nulla sed lacus.\n\nVestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; In at purus in tellus viverra aliquam. Nullam posuere turpis id metus malesuada dapibus. Proin volutpat, orci in tempor tincidunt, purus ligula suscipit lacus, sed tincidunt neque nulla sed erat. Cras laoreet tortor id fermentum accumsan. Donec pretium sapien ut purus laoreet, vitae accumsan elit porttitor. Sed ornare, arcu et eleifend sagittis, nunc augue rhoncus sem, eget fermentum augue orci ac massa.\n\nSuspendisse potenti. Pellentesque condimentum imperdiet odio, ac imperdiet metus egestas ut. Donec condimentum felis vitae lacinia fringilla. Sed imperdiet dapibus nisl, in pulvinar eros facilisis eu. Etiam sit amet congue ante. Suspendisse pharetra tortor sapien, a tempus ipsum fermentum nec. Nullam nec tincidunt turpis. Cras luctus erat non magna vestibulum, nec sollicitudin purus ultricies. Sed vitae erat eget tortor pretium vehicula.\n\nMauris eget semper nunc, vitae euismod lorem. Donec eu magna vitae nulla porttitor commodo. Nulla vulputate odio non sagittis varius. Sed sed ex et lorem tincidunt rhoncus. Curabitur posuere lacinia neque, ac tincidunt ante vehicula ac. Pellentesque tincidunt convallis urna. In porta justo orci, ac placerat odio feugiat vel. Pellentesque rutrum nisi a magna fermentum, at viverra metus bibendum. Vestibulum at nunc et velit feugiat luctus. Aliquam erat volutpat. Integer euismod erat sed enim gravida finibus. Curabitur id efficitur ante.\n\nUt blandit sollicitudin nisi ac ultricies. Nullam at nisi justo. Donec tincidunt mauris in nisl varius, sed pulvinar justo tincidunt. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Aenean maximus diam orci, nec rutrum velit pulvinar nec. Proin eget malesuada tortor. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Suspendisse ultricies, augue a viverra fermentum, tortor purus fringilla eros, at iaculis metus diam ac erat.\n\nAliquam erat volutpat. Sed nec facilisis elit, nec sodales tellus. Vivamus sollicitudin dapibus libero ac euismod. In hac habitasse platea dictumst. Curabitur id dolor fermentum, lobortis odio sed, dignissim magna. Curabitur finibus, est sed congue malesuada, ligula sem viverra massa, non commodo lacus purus nec purus. Integer laoreet blandit tortor a blandit. Nulla facilisi. Pellentesque euismod diam vel dolor luctus, non dictum eros finibus. Cras imperdiet neque sit amet nibh tincidunt tincidunt. Pellentesque et quam risus. Integer a efficitur sapien.\n\nMorbi ac lorem id mauris mattis congue. Vivamus et purus magna. Pellentesque euismod magna sed risus faucibus lobortis. Etiam gravida vitae nunc in feugiat. Aliquam erat volutpat. In viverra nisi lacus, a viverra nulla finibus sed. Vivamus tempor finibus fermentum. Sed faucibus eu mi eu pulvinar. In in eros sem. Integer ultrices vitae eros vitae blandit. Fusce tincidunt felis nulla, et sodales tortor vehicula vitae.\n\nPraesent a leo nisl. Morbi vel ex leo. Aenean mattis bibendum quam, ac posuere diam euismod sed. Maecenas id nulla finibus, efficitur nulla in, luctus nunc. Fusce ut risus augue. Aenean nec nisi eu justo lacinia blandit. Donec commodo tortor sed lacinia tincidunt. Nullam sit amet fermentum neque. Pellentesque ultricies nisi quis ligula tristique cursus. Pellentesque vel fermentum risus. Integer malesuada enim ac porttitor rutrum.\n\nSed in finibus justo, ac rhoncus justo. Vivamus id risus vitae nulla fermentum iaculis. Donec feugiat diam et risus tristique feugiat. Curabitur eu augue a justo gravida iaculis. Sed ac diam purus. Nullam facilisis finibus ante, ac euismod nisi eleifend a. Integer eget purus nec sem mattis sodales nec vitae elit. Curabitur ultricies leo sed nibh fermentum, a suscipit magna aliquam. Nulla facilisi. Nam suscipit, ex vitae pharetra fermentum, nulla ante tincidunt lorem, id tempus nunc arcu a nunc.\n\nEtiam tincidunt, lacus sit amet malesuada efficitur, risus arcu tincidunt magna, et fringilla nulla quam vel augue. Proin et sapien sed mi mattis luctus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer varius purus ut sem cursus, et bibendum sem semper. Aliquam euismod orci nec lacus porta, sed tincidunt tellus rhoncus. Etiam lacinia ex ac erat malesuada, vel pulvinar ex ultrices. Nullam consectetur orci at metus ornare fringilla.\n\nQuisque et arcu iaculis, iaculis elit sed, efficitur lacus. Nulla facilisi. Phasellus laoreet erat vel magna ultricies, ac vehicula velit tincidunt. Sed rhoncus velit non magna hendrerit, at efficitur est lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vivamus sit amet diam sem. Pellentesque efficitur sem in pulvinar hendrerit. Cras tempor velit sed fermentum lobortis.\n\nInteger tincidunt risus ut ante rutrum, ut convallis erat sodales. Integer gravida a elit ut efficitur. Duis vel diam dolor. Integer rhoncus turpis sit amet nisi lacinia, et convallis magna porta. Sed sit amet sem odio. Fusce sit amet tortor id justo varius pulvinar. Aenean gravida leo ut augue cursus, eget gravida risus feugiat. Maecenas imperdiet justo vitae sem efficitur rutrum.\n\nProin et nisl eget lorem fermentum convallis. Cras sodales ut libero sed facilisis. Pellentesque quis vehicula augue. Curabitur ullamcorper pulvinar ligula. Vestibulum lacinia ipsum eget felis volutpat, sit amet volutpat velit vulputate. Duis quis odio magna. Mauris tincidunt orci in libero lacinia, eget faucibus libero tincidunt. Nunc suscipit convallis elit. Duis nec risus at metus luctus sodales. In sit amet metus nec justo imperdiet iaculis nec sit amet nisi.\n\nNam fermentum malesuada ipsum, vitae efficitur ante viverra at. Mauris sed libero at velit iaculis cursus. Etiam sit amet risus vel velit elementum facilisis in sed tellus. Cras nec metus sed mauris vehicula hendrerit. Phasellus laoreet arcu ut nulla pulvinar, vel placerat metus bibendum. Sed non rhoncus nulla. Nulla dictum nisi vitae tellus dictum, vitae posuere sem sagittis. Vivamus accumsan nulla ut sollicitudin maximus. Sed quis volutpat lacus. Suspendisse sollicitudin sapien sit amet nisi rutrum facilisis.\n\nIn rhoncus sapien nec laoreet tristique. Suspendisse potenti. Fusce dignissim vel lacus non fringilla. Pellentesque in enim sed nulla suscipit tincidunt non ut metus. Quisque fringilla, arcu at laoreet ultricies, velit mi viverra nisi, ut rutrum dolor lacus eu ante. Duis ac convallis est. Suspendisse vitae est sed neque varius convallis. Sed bibendum, sem at fermentum rutrum, risus neque gravida quam, ac vehicula turpis quam sed lorem.\n', 'wallpaperflare.com_wallpaper.jpg', '2025-03-20 22:32:20', '2025-03-20 22:32:20', 'published'),
('5f5ba7b8253a', 'JUST TEST', 'This is just a test to make sure things work', 'tech', 'hello guys, this is just me messing around', 'Bv_TEd-V.jpg', '2025-04-07 15:47:01', '2025-04-07 15:47:01', 'published'),
('bd0fc30c225c', 'JUST TEST', 'This is just a test to make sure things work', 'tech', 'hello guys, this is just me messing around', 'Bv_TEd-V.jpg', '2025-04-07 15:49:36', '2025-04-07 15:49:36', 'published'),
('d54e9b6cd887', 'Test', 'This is just a test to make sure things work', 'business', 'test', 'image5.jpg', '2025-04-08 18:25:38', '2025-04-08 18:25:38', 'published'),
('d5fa157e7440', 'How to make Rice', 'This Blog talks about rice', 'business', 'I Like eating rice me and jellof rice get cordial relationship ', 'Restaurant-Food-Promotion-Facebook-Cover-Design-scaled.jpg', '2025-03-20 16:10:42', '2025-03-20 16:10:42', 'published'),
('ec4dd8055cfe', 'Testing again', 'testing', 'tech', 'test', 'image6.jpg', '2025-04-08 18:28:26', '2025-04-08 18:28:26', 'published');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `number` varchar(20) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `number`, `company`, `message`, `submitted_at`) VALUES
(1, 'praise', 'onojapraise2018@gmail.com', '08160218671', 'Inquiries', 'I want to know how to volunteer', '2025-06-16 06:46:01'),
(2, 'Praise', 'praiseonojs@gmail.com', '08160218671', 'test', 'this is just to test', '2025-06-16 06:48:39'),
(3, 'Praise', 'praiseonojs@gmail.com', '08160218671', 'another test', 'just testing again', '2025-06-16 06:50:41'),
(4, 'Prevail', 'onojapraise2018@gmail.com', '08160218671', 'Just test', 'just testing', '2025-06-16 07:10:50'),
(5, 'onoja', 'praiseonojs@gmail.com', '08160218671', 'another test', 'just test', '2025-06-16 07:19:39'),
(6, 'blessing', 'praiseonojs@gmail.com', '08160218671', 'hope to get it right', 'testing', '2025-06-16 07:26:42');

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
('', 'Onoja Praise', 'Optician', 'doctor', 0, 'profile-pic1.jpg', '2025-04-07 15:52:59'),
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

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`id`, `transaction_id`, `donor_name`, `donor_email`, `amount`, `currency`, `message`, `payment_status`, `created_at`) VALUES
(1, '9429039', 'B-Cloud technologies', 'ravesb_2a1a520483e25e18af5a_praiseonojs@gmail.com', 10000.00, 'NGN', 'testing', 'successful', '2025-06-16 21:48:37'),
(2, '9429047', 'B-Cloud technologies', 'ravesb_2a1a520483e25e18af5a_praiseonojs@gmail.com', 100.00, 'NGN', 'just to see', 'successful', '2025-06-16 21:55:48');

-- --------------------------------------------------------

--
-- Table structure for table `donation_events`
--

CREATE TABLE `donation_events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `goal_amount` decimal(10,2) NOT NULL,
  `amount_raised` decimal(10,2) NOT NULL DEFAULT 0.00,
  `short_description` text NOT NULL,
  `full_description` text NOT NULL,
  `banner_image` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'ongoing',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donation_events`
--

INSERT INTO `donation_events` (`id`, `title`, `category`, `goal_amount`, `amount_raised`, `short_description`, `full_description`, `banner_image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Help save lives', 'Education', 200000.00, 121000.00, 'testing', 'just test', 'assets/images/donation/1742939410_imag12.jpg', 'ongoing', '2025-03-25 21:50:10', '2025-04-08 18:51:37'),
(2, 'We want to Help this community with drugs', 'Community', 300000.00, 1000.00, 'this is to help purchase drugs for the community', 'Purchase', 'assets/images/donation/1744138126_image18.jpg', 'ongoing', '2025-04-08 18:48:47', '2025-04-08 19:27:34');

-- --------------------------------------------------------

--
-- Table structure for table `donation_single`
--

CREATE TABLE `donation_single` (
  `id` int(11) NOT NULL,
  `donation_event_id` int(11) NOT NULL,
  `donor_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `currency` varchar(10) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `message` text DEFAULT NULL,
  `donation_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donation_single`
--

INSERT INTO `donation_single` (`id`, `donation_event_id`, `donor_name`, `email`, `amount`, `currency`, `payment_method`, `message`, `donation_date`) VALUES
(1, 1, 'Praise Onoja', 'praiseonojs@gmail.com', 100000.00, 'NGN', 'Flutterwave', 'just help', '2025-03-26 21:16:16'),
(2, 1, 'Praise Onoja', 'praiseonojs@gmail.com', 10000.00, 'NGN', 'Flutterwave', 'just help', '2025-03-27 20:31:40'),
(3, 1, 'Onoja steven', 'praiseonojs@gmail.com', 1000.00, 'NGN', 'Flutterwave', 'just to help the kids', '2025-04-07 15:56:08'),
(4, 1, 'Praise Onoja', 'praiseonojs@gmail.com', 10000.00, 'NGN', 'Flutterwave', 'just to help', '2025-04-08 18:51:37'),
(5, 2, 'steven onoja', 'praiseonojs@gmail.com', 1000.00, 'NGN', 'Flutterwave', 'just to help', '2025-04-08 19:27:34');

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
  `total_attendees` int(11) DEFAULT NULL,
  `bp_screened` int(11) DEFAULT NULL,
  `high_bp_detected` int(11) DEFAULT NULL,
  `repeat_attendees` int(11) DEFAULT NULL,
  `counselled` int(11) DEFAULT NULL,
  `medications_dispensed` int(11) DEFAULT NULL,
  `referrals` int(11) DEFAULT NULL,
  `average_age` int(11) DEFAULT NULL,
  `gender_male` int(11) DEFAULT NULL,
  `gender_female` int(11) DEFAULT NULL,
  `villages_served` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_id`, `title`, `banner_image`, `location`, `time`, `date`, `description`, `body`, `status`, `total_attendees`, `bp_screened`, `high_bp_detected`, `repeat_attendees`, `counselled`, `medications_dispensed`, `referrals`, `average_age`, `gender_male`, `gender_female`, `villages_served`, `created_at`, `updated_at`) VALUES
(1, 'ba61de03d420', 'Chicken republic', 'Restaurant-Food-Promotion-Facebook-Cover-Design-scaled.jpg', 'Ojota', '13:24:00.000000', '2025-03-25', 'Visit near by Resturanat', 'A place where all type of meals are served', 'completed', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-25 22:32:08', '2025-06-17 21:23:26'),
(2, 'cf46c1fb4b0c', 'Lagos Tech Fest', 'depositphotos_449066958-stock-photo-financial-accounting-logo-financial-logo-removebg-preview.png', 'Landmark', '09:00:00.000000', '2025-03-31', 'Lagos Tech Festival', 'Attend Lagos Tech Festival to Connect with people and all', 'upcoming', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-26 08:47:31', '2025-06-17 21:23:26'),
(3, '0c7c16ec4ed2', 'Cyber Fest', 'Restaurant-Food-Promotion-Facebook-Cover-Design-scaled.jpg', 'Landmark', '02:11:00.000000', '2025-03-26', 'Cyber fest is fun', 'Let\'s get started with cyber fest', 'upcoming', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-26 10:08:32', '2025-06-17 21:23:26'),
(4, '2fa9278ea562', 'Caterring', 'png-clipart-fashion-clothing-woman-dress-design-woman-people-fashion.png', 'LAGOS', '13:52:00.000000', '2025-03-26', 'NIVEE', 'LETS GOO', 'upcoming', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-26 10:52:42', '2025-06-17 21:23:26'),
(5, '3d80dec2c28a', 'Mr Robot', 'wallpaperflare.com_wallpaper.jpg', 'USA', '10:34:00.000000', '2025-03-26', 'This series is so cool', 'I love Mr robot', 'completed', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-26 18:31:30', '2025-06-17 21:23:26'),
(6, 'a09c2dee0214', 'BBQ party', 'WhatsApp Image 2025-04-03 at 18.56.01_71c6bc8a.jpg', 'Lekki', '19:00:00.000000', '2025-04-11', 'this is just to test', 'his is just to test again', 'upcoming', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-07 15:58:41', '2025-06-17 21:23:26');

-- --------------------------------------------------------

--
-- Table structure for table `event_galleries`
--

CREATE TABLE `event_galleries` (
  `event_gallery_id` varchar(100) NOT NULL,
  `event_id` varchar(100) NOT NULL,
  `img_path` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_galleries`
--

INSERT INTO `event_galleries` (`event_gallery_id`, `event_id`, `img_path`) VALUES
('gallery_67e9cdae1524b', '23b9428740b3', 'Restaurant-Food-Promotion-Facebook-Cover-Design-scaled.jpg'),
('gallery_67e9cdae15ec3', '23b9428740b3', 'png-clipart-fashion-clothing-woman-dress-design-woman-people-fashion.png'),
('gallery_67e9cdae16a03', '23b9428740b3', 'png-clipart-fashion-clothing-woman-dress-design-woman-people-fashion-removebg-preview.png'),
('gallery_67f3f6654ec4c', 'a09c2dee0214', 'Screenshot 2025-03-28 at 19-48-37 Kitchen & Bar.png'),
('gallery_67f3f66553dc5', 'a09c2dee0214', 'Screenshot 2025-03-28 at 19-48-37 Kitchen & Bar.png');

-- --------------------------------------------------------

--
-- Table structure for table `event_images`
--

CREATE TABLE `event_images` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `image_filename` varchar(255) NOT NULL,
  `image_order` int(11) DEFAULT 1,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medical_rep`
--

CREATE TABLE `medical_rep` (
  `id` int(11) NOT NULL,
  `report_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medical_rep`
--

INSERT INTO `medical_rep` (`id`, `report_id`, `name`, `email`, `phone`, `message`, `created_at`) VALUES
(1, 4, 'onoja', 'onojapraise2018@gmail.com', '08160218671', 'test', '2025-06-16 22:14:44'),
(2, 174608, 'Praise', 'onojapraise2018@gmail.com', '08160218671', 'just work', '2025-06-16 22:17:50'),
(3, 2147483647, 'onoja', 'onojapraise2018@gmail.com', '08160218671', 'test', '2025-06-16 22:19:17');

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
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `id` int(11) NOT NULL,
  `company_logo` varchar(255) DEFAULT NULL,
  `partner_name` varchar(255) NOT NULL,
  `partner_email` varchar(255) NOT NULL,
  `partner_phone` varchar(20) DEFAULT NULL,
  `company_address` varchar(255) DEFAULT NULL,
  `business_type` enum('Technology','Finance','Healthcare','Retail','Education','Other') NOT NULL,
  `partnership_type` enum('Sponsor','Collaborator','Service Provider','Investor') NOT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `contact_role` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`id`, `company_logo`, `partner_name`, `partner_email`, `partner_phone`, `company_address`, `business_type`, `partnership_type`, `contact_person`, `contact_role`, `created_at`, `updated_at`) VALUES
(1, '../assets/images/partnership-upload/1743014799_image1.jpg', 'Steve devs', 'steve@gmail.com', '09098877887', 'lagos', 'Technology', 'Collaborator', 'praise', 'ceo', '2025-03-25 09:23:54', '2025-03-26 18:46:39');

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
('544345', 'josi', 'Physiologist', 'Physiologist', 1, 'Group (3).png', '2025-03-21 08:48:24');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subscribed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`, `subscribed_at`) VALUES
(7, 'praiseonojs@gmail.com', '2025-06-16 21:27:06');

-- --------------------------------------------------------

--
-- Table structure for table `volunteers`
--

CREATE TABLE `volunteers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `home_address` text NOT NULL,
  `role` varchar(100) DEFAULT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `profession` varchar(255) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `resume` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `phone` varchar(20) NOT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `skills` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`skills`)),
  `motivation` text DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `volunteers`
--

INSERT INTO `volunteers` (`id`, `name`, `email`, `home_address`, `role`, `gender`, `profession`, `profile_picture`, `resume`, `bio`, `status`, `created_at`, `updated_at`, `phone`, `instagram`, `skills`, `motivation`, `facebook`, `linkedin`, `twitter`) VALUES
(2, 'Aurelia', 'aurili@gmail.com', 'ikate lekki', 'Marketing', 'Female', 'Marketer', 'ARIELLA\'S HOUSE.png', NULL, NULL, 'Rejected', '2025-03-24 10:02:21', '2025-06-17 19:32:33', '', NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'Praise', 'praiseonojs@gmail.com', 'onoja street', 'Administration', 'Male', 'Web Dev', 'profile-pic1.jpg', NULL, NULL, 'Rejected', '2025-03-24 16:42:18', '2025-06-17 19:33:48', '', NULL, NULL, NULL, NULL, NULL, NULL),
(21, 'Calistus', 'calman@gmail.com', 'ikeja', 'Marketing', 'Male', 'Web Dev', 'vol_67f532aa94709.jpg', NULL, NULL, 'Approved', '2025-04-08 14:28:58', '2025-04-08 14:44:43', '09088767263', NULL, NULL, NULL, NULL, NULL, NULL),
(22, 'Cj', 'cj@gmail.com', 'lekki', 'Patient Clinic', 'Male', 'Web Dev', 'image1.jpg', NULL, NULL, 'Approved', '2025-04-08 18:56:27', '2025-04-08 18:56:47', '', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `volunteer_opportunities`
--

CREATE TABLE `volunteer_opportunities` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('pending','published') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `volunteer_opportunities`
--

INSERT INTO `volunteer_opportunities` (`id`, `title`, `start_date`, `end_date`, `description`, `image`, `status`, `created_at`) VALUES
(1, 'Need Web developers to build in out next event', '2022-12-12', '2023-02-22', 'help', 'imag12.jpg', 'published', '2025-03-24 18:16:24'),
(5, 'Need administrators', '2024-12-12', '2025-12-12', 'Need administrators', 'image7.jpg', 'published', '2025-03-29 18:42:03'),
(7, 'Help us administer drugs to our communities', '2025-12-12', '2025-12-22', 'Help us administer drugs', 'image6.jpg', 'published', '2025-04-08 11:01:23');

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
(1, 13, 3, 2025, 0, 1, 11, 0, 5, 0, 22, 39),
(2, 14, 4, 2025, 0, 0, 0, 1, 0, 0, 2, 3),
(3, 15, 4, 2025, 0, 4, 7, 1, 0, 0, 0, 12),
(4, 24, 6, 2025, 0, 0, 0, 13, 0, 0, 0, 13),
(5, 25, 6, 2025, 0, 2, 0, 0, 0, 0, 0, 2);

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
-- Indexes for table `blog_images`
--
ALTER TABLE `blog_images`
  ADD PRIMARY KEY (`blog_image_id`),
  ADD UNIQUE KEY `blog_image_id` (`blog_image_id`);

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD UNIQUE KEY `blog_id` (`blog_id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `donation_events`
--
ALTER TABLE `donation_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donation_single`
--
ALTER TABLE `donation_single`
  ADD PRIMARY KEY (`id`),
  ADD KEY `donation_event_id` (`donation_event_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_images`
--
ALTER TABLE `event_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_event_id` (`event_id`);

--
-- Indexes for table `medical_rep`
--
ALTER TABLE `medical_rep`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nurses`
--
ALTER TABLE `nurses`
  ADD UNIQUE KEY `nurse_id` (`nurse_id`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `partner_email` (`partner_email`);

--
-- Indexes for table `physiologist`
--
ALTER TABLE `physiologist`
  ADD UNIQUE KEY `physiologist_id` (`physiologist_id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `volunteers`
--
ALTER TABLE `volunteers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `volunteer_opportunities`
--
ALTER TABLE `volunteer_opportunities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `weekly_engagement`
--
ALTER TABLE `weekly_engagement`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `donation_events`
--
ALTER TABLE `donation_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `donation_single`
--
ALTER TABLE `donation_single`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `event_images`
--
ALTER TABLE `event_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medical_rep`
--
ALTER TABLE `medical_rep`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `volunteers`
--
ALTER TABLE `volunteers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `volunteer_opportunities`
--
ALTER TABLE `volunteer_opportunities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `weekly_engagement`
--
ALTER TABLE `weekly_engagement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_sessions`
--
ALTER TABLE `admin_sessions`
  ADD CONSTRAINT `fk_admins_unique_id` FOREIGN KEY (`unique_id`) REFERENCES `admins` (`unique_id`) ON DELETE CASCADE;

--
-- Constraints for table `donation_single`
--
ALTER TABLE `donation_single`
  ADD CONSTRAINT `donation_single_ibfk_1` FOREIGN KEY (`donation_event_id`) REFERENCES `donation_events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `event_images`
--
ALTER TABLE `event_images`
  ADD CONSTRAINT `fk_event_images_event_id` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
