-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2024 at 06:04 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `accident_record`
--

CREATE TABLE `accident_record` (
  `accident_id` int(11) NOT NULL,
  `name` varchar(155) NOT NULL,
  `age` int(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `sex` enum('male','female') NOT NULL,
  `date` varchar(55) NOT NULL,
  `vehicle_type` enum('bicycle','motorcycle','tricycle','4 wheel vehicle') NOT NULL,
  `mobile_number` varchar(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accident_record`
--

INSERT INTO `accident_record` (`accident_id`, `name`, `age`, `address`, `location`, `sex`, `date`, `vehicle_type`, `mobile_number`, `image`) VALUES
(20, 'Juan Dela Cruz', 56, 'Cuyapa', 'Purok 3, Pantoc', 'male', '2024-03-26', 'tricycle', '0945512388', 'ff704ac8d94d61ac042a9a579399332e.png'),
(21, 'jeremy cando benedicto', 44, 'Tagumpay', '96, Everlasting, Tagumpay', 'male', '2024-04-01', 'tricycle', '09157646467', 'appLogo.png'),
(22, 'jeremy cando benedicto', 23, 'Tagumpay', 'tagumnpay', 'male', '2024-04-02', 'tricycle', '09157646467', '3695103.png');

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
(13, 805713, 573836844, 'hi'),
(14, 625685, 573836844, 'hakdog'),
(15, 389059, 573836844, 'g'),
(16, 389059, 573836844, 'tar ml4'),
(17, 625685, 573836844, 'sss'),
(18, 389059, 1258838597, 'ddgfdgf'),
(19, 625685, 573836844, 'hello'),
(20, 389059, 573836844, 'tanga'),
(21, 625685, 1258838597, 'hi'),
(22, 625685, 1258838597, 'hello'),
(23, 389059, 1258838597, 'otw'),
(24, 805713, 1258838597, 'hi');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `photo_id` int(11) NOT NULL,
  `photo_path` varchar(255) NOT NULL,
  `photo_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`photo_id`, `photo_path`, `photo_type`) VALUES
(42, 'uploads/final 1.jpg', 'image/jpeg'),
(43, 'uploads/final 4.jpg', 'image/jpeg'),
(44, 'uploads/SPORTS.png', 'image/png'),
(45, 'uploads/final 2.jpg', 'image/jpeg'),
(46, 'uploads/final 3.jpg', 'image/jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `user_form`
--

CREATE TABLE `user_form` (
  `id` int(100) NOT NULL,
  `unique_id` int(255) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cpnum` varchar(11) NOT NULL,
  `password` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `age` int(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_form`
--

INSERT INTO `user_form` (`id`, `unique_id`, `firstname`, `email`, `cpnum`, `password`, `image`, `middlename`, `lastname`, `age`, `address`, `gender`, `status`) VALUES
(7, 0, 'Jeremy', 'admin@gmail.com', '09157646467', '202cb962ac59075b964b07152d234b70', '2023-12-15.png', 'Cando', 'Benedicto', 1, 'Tagumpay/Gabaldon', 'male', 'Active Now'),
(14, 805713, 'Gabaldon ', 'jeremybenedicto2020@gmail.com', '0', '202cb962ac59075b964b07152d234b70', '2.png', 'MDRRMO', 'Benedicto', 22, 'Everlasting/Tagumpay', 'female', 'Active Now'),
(15, 625685, 'Sam', 'sam@gmail.com', '09157646467', '202cb962ac59075b964b07152d234b70', 'brother-icon-1458x2048-32dx9t45.png', 'Russel', 'Cabaltica', 22, 'Sawmill', 'male', 'Active Now'),
(16, 389059, 'owera', 'owera@gmail.com', '0', '202cb962ac59075b964b07152d234b70', 'logo.png', 'ernez', 'umali', 23, 'apayuc', 'male', 'Active Now'),
(17, 125385, 'Sir Dane', 'Dane@gmail.com', '0', '202cb962ac59075b964b07152d234b70', 'brother-icon-1458x2048-32dx9t45.png', 'Irang', 'Sisor', 18, 'South', 'male', 'Offline Now'),
(18, 731219, 'Rafael', 'johnrafaellee@gmail.com', '09157646467', '202cb962ac59075b964b07152d234b70', 'ff704ac8d94d61ac042a9a579399332e.png', 'Benedicto', 'Lee', 22, 'Tagumpay', 'male', 'Active Now');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accident_record`
--
ALTER TABLE `accident_record`
  ADD PRIMARY KEY (`accident_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`photo_id`);

--
-- Indexes for table `user_form`
--
ALTER TABLE `user_form`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accident_record`
--
ALTER TABLE `accident_record`
  MODIFY `accident_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `photo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `user_form`
--
ALTER TABLE `user_form`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
