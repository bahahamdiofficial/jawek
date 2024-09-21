-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2024 at 04:35 PM
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
-- Database: `u186675676_login_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_pic` text NOT NULL DEFAULT '\'default_profile.jpg\''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `full_name`, `email`, `password`, `profile_pic`) VALUES
('1', 'Admin', 'admin@jawek.tn', '$2y$10$vsBsfBseuGDp9Q2z6/ZP2.GdBQ0YZ.lo06ubHYAwkN/33w0k3rplO', '\'default_profile.jpg\'');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Véhicules'),
(2, 'Immobilier'),
(3, 'Emplois'),
(4, 'Multimédias'),
(5, 'Animaux'),
(6, 'Telephones'),
(7, 'Meubles'),
(8, 'Mode'),
(9, 'Services'),
(10, 'Jeux'),
(11, 'Autre');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `loc_id` int(11) NOT NULL,
  `name` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `loc_id`, `name`) VALUES
(1, 1, 'Ben Arous ville'),
(2, 1, 'Borj Cedria'),
(3, 1, 'Megrine'),
(4, 1, 'Fouchana'),
(5, 1, 'Ezzahra'),
(6, 1, 'Radès'),
(7, 2, 'Tunis Medina'),
(8, 2, 'Agba'),
(9, 2, 'Ezzouhour'),
(10, 2, 'Harairia'),
(11, 2, 'El Kram'),
(12, 2, 'Goulette'),
(13, 2, 'Sijoumi'),
(14, 3, 'Ariana'),
(15, 3, 'Borj Touil'),
(16, 4, 'Gabes ville'),
(17, 4, 'El Hamma'),
(18, 5, 'Monastir ville'),
(19, 5, 'Téboulba'),
(20, 6, 'Sousse ville'),
(21, 6, 'Kalaa Sghira'),
(22, 7, 'Nabeul ville'),
(23, 7, 'Beni Kalled'),
(24, 8, 'Medenine ville'),
(25, 8, 'Djerba Midoun'),
(26, 9, 'Sfax ville'),
(27, 9, 'El Amra'),
(28, 10, 'Kébili ville'),
(29, 10, 'Souk Lahad'),
(30, 11, 'Zaghouan ville'),
(31, 11, 'Zriba'),
(40, 16, 'Bizerte centre'),
(41, 16, 'Ras jebel'),
(42, 1, 'Autre'),
(43, 2, 'Autre'),
(44, 3, 'Autre'),
(45, 4, 'Autre'),
(46, 5, 'Autre'),
(47, 6, 'Autre'),
(48, 7, 'Autre'),
(49, 8, 'Autre'),
(50, 9, 'Autre'),
(51, 10, 'Autre'),
(52, 11, 'Autre'),
(53, 12, 'Autre'),
(54, 13, 'Autre'),
(55, 14, 'Autre'),
(56, 15, 'Autre'),
(57, 16, 'Autre'),
(58, 17, 'Autre'),
(59, 18, 'Autre'),
(60, 19, 'Autre'),
(61, 20, 'Autre'),
(62, 21, 'Autre'),
(63, 22, 'Autre'),
(64, 23, 'Autre'),
(65, 24, 'Autre');

-- --------------------------------------------------------

--
-- Table structure for table `favourites`
--

CREATE TABLE `favourites` (
  `favourite_id` varchar(100) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `follow_id` varchar(255) NOT NULL,
  `seller` varchar(255) NOT NULL,
  `followed_by` varchar(255) NOT NULL,
  `follow_status` int(11) NOT NULL DEFAULT 1,
  `date_followed` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`follow_id`, `seller`, `followed_by`, `follow_status`, `date_followed`) VALUES
('320875', '1', '1032', 1, '2024-09-21');

-- --------------------------------------------------------

--
-- Table structure for table `identity_confirmation`
--

CREATE TABLE `identity_confirmation` (
  `identity_id` varchar(100) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `document_image` varchar(200) NOT NULL,
  `is_verified` int(11) NOT NULL DEFAULT 0,
  `date_posted` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `identity_confirmation`
--

INSERT INTO `identity_confirmation` (`identity_id`, `user_id`, `document_image`, `is_verified`, `date_posted`) VALUES
('373947', '1', '61387095.jpg', 0, '2024-01-19');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `name`) VALUES
(1, 'Ben Arous'),
(2, 'Tunis'),
(3, 'Ariana'),
(4, 'Gabes'),
(5, 'Monastir'),
(6, 'Sousse'),
(7, 'Nabeul'),
(8, 'Medenine'),
(9, 'Sfax'),
(10, 'Kébili'),
(11, 'Zaghouan'),
(12, 'Kairouan'),
(13, 'Manouba'),
(14, 'Tataouine'),
(15, 'Jendouba'),
(16, 'Bizerte'),
(17, 'Mahdia'),
(18, 'Kasserine'),
(19, 'Sidi Bouzid'),
(20, 'Tozeur'),
(21, 'Kef'),
(22, 'Gafsa'),
(23, 'Siliana'),
(24, 'Beja');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `from_user` varchar(255) NOT NULL,
  `to_user` varchar(255) NOT NULL,
  `msg` varchar(1000) NOT NULL,
  `product_id` varchar(255) DEFAULT NULL,
  `time_sent` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `from_user`, `to_user`, `msg`, `product_id`, `time_sent`) VALUES
(74, '1033', '1032', 'gf', '', '2024-09-21 11:25:31');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `description` varchar(4000) NOT NULL,
  `category` varchar(255) NOT NULL,
  `subcategory` varchar(255) DEFAULT NULL,
  `product_condition` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `city` int(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `alt_phone_number` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Member_ID` int(11) NOT NULL,
  `show_phone` int(11) NOT NULL DEFAULT 1,
  `is_sold` int(1) NOT NULL DEFAULT 0,
  `is_pending` int(1) NOT NULL DEFAULT 0,
  `is_paused` int(1) NOT NULL DEFAULT 0,
  `is_active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `price`, `description`, `category`, `subcategory`, `product_condition`, `location`, `city`, `user_id`, `alt_phone_number`, `created_at`, `Member_ID`, `show_phone`, `is_sold`, `is_pending`, `is_paused`, `is_active`) VALUES
('579206', 'Omega X Swatch', '1', 'Omega X Swatch to the Planets with the Bioceramic MoonSwatch', '11', '29', 'Neuf', '16', 40, 1033, '', '2024-09-21 14:25:11', 0, 1, 0, 0, 1, 1),
('612962', 'z robot 1000', '47000', 'Nouveauté moto 2014 : Kawasaki Z 1000', '1', '2', 'Neuf', '17', 58, 1034, '', '2024-09-21 14:33:00', 0, 1, 0, 0, 0, 1),
('873371', 'Golf 7', '10', 'regrg', '1', '1', 'good_condition', '1', 1, 1, '', '2024-09-21 09:08:07', 0, 1, 0, 0, 0, 0),
('935139', 'Mercedes Benz CLA Review 2024', '250000', 'Review 2024', '1', '1', 'Neuf', '8', 25, 1032, '', '2024-09-21 14:04:29', 0, 1, 1, 0, 0, 1),
('948006', 'Villa modern luxury', '4000000', 'Villa modern luxury dubai', '2', '5', 'Neuf', '2', 7, 1032, '', '2024-09-21 14:23:34', 0, 1, 0, 0, 1, 1),
('979828', 'iPhone 14 Pro Max Unboxing', '1', 'iPhone 14 Pro Max Unboxing', '6', '24', 'Neuf', '6', 20, 1034, '', '2024-09-21 14:29:54', 0, 1, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `image_id` varchar(100) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `image` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`image_id`, `product_id`, `image`) VALUES
('102838', '579206', '99281423.png'),
('143763', '107333', '53466428.jpg'),
('200155', '935139', '3193188.jpeg'),
('206028', '107333', '55135763.jpg'),
('229559', '935139', '14819821.jpg'),
('232593', '979828', '50845208.jpg'),
('249238', '579206', '99420901.png'),
('262312', '935139', '72586225.jpeg'),
('268999', '612962', '95068269.jpg'),
('285855', '107333', '33345083.jpg'),
('421516', '935139', '84602707.jpg'),
('592190', '948006', '78407448.jpg'),
('630828', '579206', '68316253.png'),
('819532', '873371', '47549972.jpg'),
('838732', '935139', '70875646.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `reported_users`
--

CREATE TABLE `reported_users` (
  `report_id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `report` varchar(1000) NOT NULL,
  `date_reported` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reported_users`
--

INSERT INTO `reported_users` (`report_id`, `user_id`, `report`, `date_reported`) VALUES
('134925', '1', 'Nudity', '2023-08-28'),
('168081', '1', 'Prohibited items', '2023-08-28'),
('247213', '1', 'Prohibited items', '2023-08-28'),
('332860', '1', 'Theft', '2023-08-28'),
('518923', '1', '', '2023-08-30'),
('806879', '1013', '', '2023-09-03'),
('848158', '1', '', '2023-08-30'),
('862847', '1', 'Bad guy', '2023-08-28');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL,
  `con_id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id`, `con_id`, `name`) VALUES
(1, 1, 'Voiture'),
(2, 1, 'Moto'),
(3, 1, 'Bateaux'),
(4, 2, 'Appartement'),
(5, 2, 'Maisons et Villas'),
(6, 6, 'Smartphone'),
(7, 4, 'Télévisions'),
(8, 4, 'Ordinateurs portables'),
(9, 4, 'Ordinateur de bureau'),
(10, 1, 'Vélo'),
(11, 7, 'Salon'),
(12, 5, 'Nourriture'),
(13, 4, 'Image & Son'),
(14, 8, 'Vêtements'),
(15, 6, 'Smartwatch'),
(16, 6, 'Accessoires Téléphonie'),
(20, 1, 'Autre'),
(19, 2, 'Autre'),
(21, 3, 'Autre'),
(22, 4, 'Autre'),
(23, 5, 'Autre'),
(24, 6, 'Autre'),
(25, 7, 'Autre'),
(26, 8, 'Autre'),
(27, 9, 'Autre'),
(28, 10, 'Autre'),
(29, 11, 'Autre'),
(30, 8, 'Chaussures'),
(31, 8, 'Accessoires'),
(32, 8, 'Produits de beauté');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `profile_pic` text NOT NULL DEFAULT 'default_profile.jpg',
  `bio` varchar(255) DEFAULT NULL,
  `unique_id` int(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `email_code` int(6) DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `TrustStatus` int(11) NOT NULL DEFAULT 0 COMMENT 'Seller rank '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `phone`, `name`, `password_hash`, `profile_pic`, `bio`, `unique_id`, `status`, `email_code`, `is_active`, `TrustStatus`) VALUES
(1032, 'jawek', 'admin@jawek.tn', '20000000', 'Jawek', '$2y$10$y5c8OZDu8kaoaLUENkSxEe/iHZvy/BGPd4Phmm3DZ/4N3iUR2aaXS', 'default_profile.jpg', '', 0, '', NULL, 1, 0),
(1033, 'bahahamdi', 'bahahamdiofficial@gmail.com', '2000001', 'Baha', '$2y$10$o7sNvfod1/o3uedoStRD1.y1j6vdK.xN4EaSw6dLgA9VEamWWP31C', 'default_profile.jpg', NULL, 0, '', NULL, 1, 0),
(1034, 'max', 'max@gmail.com', '20000222', 'Max', '$2y$10$E.jGEY3u6qgNVtFLxYs8z.adOJBoPEf61lZuGS7zmlnO1fjwqCvo6', 'default_profile.jpg', NULL, 0, '', NULL, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `identity_confirmation`
--
ALTER TABLE `identity_confirmation`
  ADD PRIMARY KEY (`identity_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `Member_ID` (`Member_ID`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `reported_users`
--
ALTER TABLE `reported_users`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username_2` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1035;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
