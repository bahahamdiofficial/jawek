-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2023 at 10:23 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_pass`
--

CREATE TABLE `admin_pass` (
  `id` int(11) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `a_name` varchar(25) NOT NULL,
  `a_pic` text NOT NULL DEFAULT 'default_profile.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_pass`
--

INSERT INTO `admin_pass` (`id`, `mail`, `password_hash`, `a_name`, `a_pic`) VALUES
(1, 'admin@jawek.tn', 'Azerty1234.!', 'Admin', 'default_profile.jpg');

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
  `incoming_msg_id` int(255) NOT NULL,
  `outgoing_msg_id` int(255) NOT NULL,
  `msg` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`) VALUES
(1, 1335668422, 1345961762, 'holla');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `subcategory` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `Member_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `category`, `subcategory`, `location`, `user_id`, `created_at`, `Member_ID`) VALUES
(1, 'popop', '4247', 'Cut.00_00_18_22.Still004.png', '', '', '', 0, '2023-07-31 12:52:58', 0),
(3, 'dfds', '746', 'Cut.00_00_19_55.Still003.png', '', '', '', 0, '2023-07-31 12:52:58', 0),
(5, 'dfds', '746', 'Cut.00_00_19_55.Still003.png', '', '', '', 0, '2023-07-31 12:52:58', 0),
(6, 'dfds', '454', '361635716_118631061292439_7283768901511958207_n.jpg', '', '', '', 0, '2023-07-31 12:52:58', 0),
(7, 'popop', '4527', '711.jpg', '', '', '', 0, '2023-07-31 12:52:58', 0),
(8, 'dd', '86', '_MG_8324.JPG', '', '', '', 0, '2023-07-31 12:52:58', 0),
(9, 'dd', '86', '_MG_8324.JPG', '', '', '', 0, '2023-07-31 12:52:58', 0),
(10, 'dd', '86', '_MG_8324.JPG', '', '', '', 0, '2023-07-31 12:52:58', 0),
(11, 'dd', '86', '_MG_8324.JPG', '', '', '', 0, '2023-07-31 12:52:58', 0),
(12, 'popop', '3', '358105430_663583652483847_658447186854065900_n.jpg', '', '', '', 0, '2023-07-31 12:52:58', 0),
(13, 'popop', '12', '342210658_1856014031442192_812062154485864182_n.jpg', '', '', '', 0, '2023-07-31 12:52:58', 0),
(14, 'ddf', '4', '356194783_248863651321261_2922985401954521114_n.jpg', '', '', '', 0, '2023-07-31 12:52:58', 0),
(15, 'ddf', '4', '356194783_248863651321261_2922985401954521114_n.jpg', '', '', '', 0, '2023-07-31 12:52:58', 0),
(16, 'popop', '47574', '360143735_294566286382865_4025771854749078498_n.jpg', '1', '2', '16', 0, '2023-07-31 12:52:58', 0),
(17, 'popop', '475', '346289983_5548385595265157_574799044746631107_n.jpg', '1', '3', '19', 0, '2023-07-31 12:52:58', 0),
(18, 'z750', '21.000', '363420200_6349612481796126_5728985925102067770_n.jpg', '1', '2', '13', 0, '2023-08-01 00:29:11', 0);

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
(6, 2, 'Terrains'),
(7, 4, 'Télévisions'),
(8, 4, 'Ordinateurs portables'),
(9, 4, 'Ordinateur de bureau');

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
  `unique_id` int(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `phone`, `name`, `password_hash`, `profile_pic`, `unique_id`, `status`) VALUES
(1, 'baha', 'googaa@gmail.com', '', 'Baha Hamdi', '$2y$10$Sf63hcKtXmz2AFV4pSuuy.GCLvluvQZPCo5iVVm9RU0Hvm5K0v8Vy', 'default_profile.jpg', 0, '0'),
(2, '1111', 'DD1yosra@yahho.fr', '', 'yosra', '$2y$10$nn4rEhe9m1wRcFNhSI4ok.2ZMhnhSCQ71t4yFZlZgcgMXKRvrncfC', 'default_profile.jpg', 0, '0'),
(10, '22', 'softign@gmail.com1', '', 'baha', '$2y$10$AXt0utHxXYWCqXriL/dh6u.p93BBekrN6LjZt58F6LVPWh4Dz7XKe', 'default_profile.jpg', 0, '0'),
(12, 'saif007', 'saif@gmail.com', '', 'saif', '$2y$10$Zp1X52xOh9M2fQ8z2ix.q.0wtYsElAAkFDxILjaEQzmEVb3CIGBIW', 'default_profile.jpg', 1335668422, '0'),
(13, 'appnester', 'appnester@gmail.com', '', 'App Nester', '$2y$10$t8bJ2qbQBWqmeAHWccjFAuCAtwgn8IXVOMYuzjKjRj8N9z6QbKZHa', 'default_profile.jpg', 1395384648, '0'),
(14, 'mrwick', 'wick@gmail.com', '', 'Mr Wick', '$2y$10$NXLkRuS.cFmnQIL7/iCUEuk3gjuPTr42BHvY.r2yEJ0jmJ4MpOFLm', 'default_profile.jpg', 0, '0'),
(15, 'bahahamdi__', 'bahahamdiofficial@gmail.com', '', 'Baha', '$2y$10$C1ndOqN7Q72F9YNSDxgAMOJmSTQzBH30NL9Sm1zalrixmDN4GJ.oS', 'default_profile.jpg', 0, '0'),
(17, 'toot', 'Toot1@gmail.com', '', 'Baha', '$2y$10$tOMIV137QSNFmQcsHJxojulGnY2mNr9iEm54njY4kmFM4HNNBUOnq', 'default_profile.jpg', 106846831, '0'),
(18, 'toota', 'Toot11@gmail.com', '', 'toota', '$2y$10$B.IJGZVvdZPcTAVoLten9.VFN/GepmCqJuXq8ZCBs4ZLjrzgZSKdi', 'default_profile.jpg', 757575, '0'),
(1001, 'Elmoudir', 'elmoudir@gmail.com', '', 'El Moudir', '$2y$10$VyQgycjKXVjBqIsJQRphLu3D4tCDVIsueethDfO739GQEDOwdBRuS', 'default_profile.jpg', 0, ''),
(1004, 'iphone', 'iphone@gmail.com', '', 'Iphone', '$2y$10$A1ApmzSPZtDccyrgcmBj3u/rjcmZH9pgeihTImGQ.9Hmrt75Vjf4K', 'default_profile.jpg', 0, ''),
(1005, 'nokia', 'nokia@gmail.com', '98745877', 'Nokia', '$2y$10$NwkZBRXGjZv9s9u1coXeb.ER5VzfD5tAWDG5aElvrbxLKD6Bs7Snq', 'default_profile.jpg', 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_pass`
--
ALTER TABLE `admin_pass`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `Member_ID` (`Member_ID`);

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
-- AUTO_INCREMENT for table `admin_pass`
--
ALTER TABLE `admin_pass`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1006;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
