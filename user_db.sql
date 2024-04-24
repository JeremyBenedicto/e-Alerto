-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2024 at 01:22 AM
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
-- Table structure for table `admin_response`
--

CREATE TABLE `admin_response` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_response`
--

INSERT INTO `admin_response` (`id`, `user_id`, `message`, `timestamp`) VALUES
(3, 19, 'Thank you for your valuable feedback. We appreciate your report and will take the necessary actions.', '2024-04-19 14:03:26'),
(4, 15, 'Thank you for your valuable feedback. We appreciate your report and will take the necessary actions.', '2024-04-19 14:13:54');

-- --------------------------------------------------------

--
-- Table structure for table `injury_form`
--

CREATE TABLE `injury_form` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `civil_status` varchar(20) DEFAULT NULL,
  `NO1` varchar(255) DEFAULT NULL,
  `PO1` varchar(255) DEFAULT NULL,
  `TO1` varchar(255) DEFAULT NULL,
  `DO1` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `bp` varchar(20) DEFAULT NULL,
  `nameofcaller` varchar(255) DEFAULT NULL,
  `numofcaller` varchar(20) DEFAULT NULL,
  `wound_type` text DEFAULT NULL,
  `fracture_type` varchar(20) DEFAULT NULL,
  `emergency_types` text DEFAULT NULL,
  `others_text` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `injury_form`
--

INSERT INTO `injury_form` (`id`, `name`, `age`, `sex`, `civil_status`, `NO1`, `PO1`, `TO1`, `DO1`, `date`, `address`, `bp`, `nameofcaller`, `numofcaller`, `wound_type`, `fracture_type`, `emergency_types`, `others_text`) VALUES
(1, 'jeremy cando benedicto', 23, 'male', 'married', '23', '23', '23', '23', '2024-04-16', 'Tagumpay', '187', '77777', 'marites', 'laceration', 'closed', 'others_checkbox', 'owera');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `unique_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `unique_id`, `message`, `timestamp`) VALUES
(1, 21, 0, 'masakit ipit', '2024-04-18 12:37:29'),
(2, 21, 0, 'hello', '2024-04-18 13:06:10'),
(3, 15, 0, 'kumain', '2024-04-18 14:11:02'),
(4, 19, 0, 'fgfdgfd', '2024-04-19 13:44:33'),
(5, 19, 0, 'dfgfdgf', '2024-04-19 13:47:59');

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
(58, 'uploads/1.png', 'image/png'),
(59, 'uploads/2.png', 'image/png'),
(60, 'uploads/4.png', 'image/png'),
(61, 'uploads/3.png', 'image/png'),
(63, 'uploads/1.png', 'image/png');

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
(18, 731219, 'Rafael', 'johnrafaellee@gmail.com', '09157646467', '202cb962ac59075b964b07152d234b70', 'ff704ac8d94d61ac042a9a579399332e.png', 'Benedicto', 'Lee', 22, 'Tagumpay', 'male', 'Active Now'),
(19, 756548, 'a', 'a@gmail.com', '09157646467', '202cb962ac59075b964b07152d234b70', 'appLogo.png', 'a', 'a', 12, 'Tagumpay', 'female', 'Active Now'),
(20, 305162, 'maru', 'webpage651@gmail.com', '09157646467', '202cb962ac59075b964b07152d234b70', 'brother-icon-1458x2048-32dx9t45.png', 'secret', 'ayaw', 99, 'Tagumpay', 'male', 'Active Now'),
(21, 468999, 'Jeremy', 'jeremy@gmail.com', '09157646467', '202cb962ac59075b964b07152d234b70', 'download (1).jpg', 'Cando', 'Benedicto', 22, '96 Everlasting', 'male', 'Active Now');

-- --------------------------------------------------------

--
-- Table structure for table `user_locations`
--

CREATE TABLE `user_locations` (
  `id` int(11) NOT NULL,
  `user_id` int(100) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_locations`
--

INSERT INTO `user_locations` (`id`, `user_id`, `latitude`, `longitude`, `timestamp`) VALUES
(1, 21, '15.484189916666669', '121.31221033333335', '2024-04-18 12:37:34'),
(2, 21, '15.484209100000001', '121.3122096', '2024-04-18 13:06:33'),
(3, 15, '15.484176214285716', '121.31221085714287', '2024-04-18 14:11:08'),
(4, 19, '15.484209100000001', '121.3122096', '2024-04-19 13:44:38'),
(5, 19, '15.484209100000001', '121.3122096', '2024-04-19 13:48:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accident_record`
--
ALTER TABLE `accident_record`
  ADD PRIMARY KEY (`accident_id`);

--
-- Indexes for table `admin_response`
--
ALTER TABLE `admin_response`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `injury_form`
--
ALTER TABLE `injury_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `user_locations`
--
ALTER TABLE `user_locations`
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
-- AUTO_INCREMENT for table `admin_response`
--
ALTER TABLE `admin_response`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `injury_form`
--
ALTER TABLE `injury_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `photo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `user_form`
--
ALTER TABLE `user_form`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user_locations`
--
ALTER TABLE `user_locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_response`
--
ALTER TABLE `admin_response`
  ADD CONSTRAINT `admin_response_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_form` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
