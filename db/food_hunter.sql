-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2025 at 01:17 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food hunter`
--

-- --------------------------------------------------------

--
-- Table structure for table `donation`
--

CREATE TABLE `donation` (
  `id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `donor_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `donation_staus` varchar(255) NOT NULL,
  `volunteer_id` int(11) NOT NULL,
  `delivery_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donation`
--

INSERT INTO `donation` (`id`, `food_id`, `donor_id`, `qty`, `donation_staus`, `volunteer_id`, `delivery_status`) VALUES
(1, 1, 5, 20, 'Donated', 3, 'Delivered'),
(2, 1, 6, 10, 'Donated', 3, 'Delivered'),
(3, 1, 6, 10, 'Donated', 3, 'Delivered');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `donation_id` int(11) NOT NULL,
  `ngo_id` int(11) DEFAULT NULL,
  `donor_id` int(11) DEFAULT NULL,
  `feedback_type` enum('donor','volunteer','ngo') NOT NULL,
  `review` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `vol_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `donation_id`, `ngo_id`, `donor_id`, `feedback_type`, `review`, `rating`, `created_at`, `vol_id`) VALUES
(1, 3, 4, NULL, 'donor', 'qqqqqqqqqq', 4, '2025-10-06 05:15:19', 0),
(2, 1, 4, NULL, 'volunteer', 'qqqqqq', 5, '2025-10-06 05:15:59', 0),
(4, 3, 4, 6, 'ngo', 'hh', 5, '2025-11-06 12:13:36', 0),
(6, 1, 4, NULL, 'ngo', 'dddddd', 5, '2025-11-06 12:16:49', 3);

-- --------------------------------------------------------

--
-- Table structure for table `food donation`
--

CREATE TABLE `food donation` (
  `id` int(11) NOT NULL,
  `Title` varchar(50) NOT NULL,
  `Organization id` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Date of donation` date NOT NULL,
  `Description` varchar(150) NOT NULL,
  `image` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food donation`
--

INSERT INTO `food donation` (`id`, `Title`, `Organization id`, `Quantity`, `Date of donation`, `Description`, `image`) VALUES
(1, 'Nourish a Life', 4, 10, '2025-09-15', 'life', 'uploads/events-2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `user_id`, `user_name`, `password`, `user_type`, `status`) VALUES
(6, '0', 'admin', 'admin', 'admin', 'active'),
(7, '3', 'joeljohny@23', 'joeljohny@238', 'volunteer', 'active'),
(9, '4', 'unity23@gmail.com', 'unity@33', 'ngo', 'active'),
(11, '5', 'avyukths2020@gmail.com', 'avyukth@2020', 'user', 'active'),
(13, '6', 'dona@gmail.com', 'dO@12345', 'user', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `ngo`
--

CREATE TABLE `ngo` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `address` varchar(50) NOT NULL,
  `license` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ngo`
--

INSERT INTO `ngo` (`id`, `name`, `email`, `phone`, `address`, `license`) VALUES
(4, 'Unity', 'unity23@gmail.com', 9867453423, 'Unity Organization\r\nErnakulam', 'uploads/donate-5331777_1280.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `phone`, `address`) VALUES
(5, 'Avyukth S', 'avyukths2020@gmail.com', 9878985645, 'Puthuthara (h)\r\nErnakulam'),
(6, 'Dona Davis', 'dona@gmail.com', 8798879878, 'Aluva\r\nnear metro station');

-- --------------------------------------------------------

--
-- Table structure for table `volunteer`
--

CREATE TABLE `volunteer` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `volunteer`
--

INSERT INTO `volunteer` (`id`, `name`, `email`, `phone`, `address`) VALUES
(3, 'Joel Johny', 'joeljohny@23', 9756342387, 'Kalathyparambil (h)\r\nErnakulam');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `donation`
--
ALTER TABLE `donation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `donation_id` (`donation_id`),
  ADD KEY `ngo_id` (`ngo_id`),
  ADD KEY `donor_id` (`donor_id`);

--
-- Indexes for table `food donation`
--
ALTER TABLE `food donation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ngo`
--
ALTER TABLE `ngo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `volunteer`
--
ALTER TABLE `volunteer`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `donation`
--
ALTER TABLE `donation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `food donation`
--
ALTER TABLE `food donation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `ngo`
--
ALTER TABLE `ngo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `volunteer`
--
ALTER TABLE `volunteer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
