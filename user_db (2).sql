-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2024 at 10:00 AM
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
(3, 23, 'Thank you for your valuable report. We appreciate your message and will take the necessary actions.', '2024-05-02 01:13:15');

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
(1, 24, 0, 'NASAKSAK', '2024-05-02 00:47:08'),
(2, 25, 0, 'nabundol', '2024-05-02 00:48:59'),
(4, 23, 0, 'hello', '2024-05-02 01:00:11'),
(5, 23, 0, 'nabagok', '2024-05-02 01:12:49'),
(6, 23, 0, 'sunog ', '2024-05-02 02:15:01'),
(7, 28, 0, 'sfvdfvdfs', '2024-05-07 06:41:20');

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
(59, 'uploads/2.png', 'image/png'),
(61, 'uploads/3.png', 'image/png'),
(66, 'uploads/final 4.jpg', 'image/jpeg');

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
  `status` varchar(255) NOT NULL,
  `id_photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_form`
--

INSERT INTO `user_form` (`id`, `unique_id`, `firstname`, `email`, `cpnum`, `password`, `image`, `middlename`, `lastname`, `age`, `address`, `gender`, `status`, `id_photo`) VALUES
(7, 0, 'MDRRMO', 'admin@gmail.com', '09157646467', '202cb962ac59075b964b07152d234b70', 'newlogo.png', 'e-Alerto', 'Admin', 22, 'Tagumpay/Gabaldon', 'male', 'Active Now', NULL),
(22, 915515, 'Ernez Louie', 'oweramaru@gmail.com', '09584256322', '202cb962ac59075b964b07152d234b70', 'IMG_0947.JPG', 'Ubarro', 'Owera', 21, 'Purok 4/ Cuyapa', 'male', 'Active Now', NULL),
(23, 940654, 'Jeremy', 'jeremybenedicto@gmail.com', '09157646467', '202cb962ac59075b964b07152d234b70', 'FB_IMG_1714400082100.jpg', 'Cando', 'Benedicto', 21, 'Everlasting/ Tagumpay', 'male', 'Active Now', NULL),
(24, 919230, 'John Rafael', 'johnrafaellee@gmail.com', '09451237458', '202cb962ac59075b964b07152d234b70', 'IMG_20240223_214751.jpg', 'Benedicto', 'Lee', 21, 'Cadena de Amor', 'male', 'Active Now', NULL),
(25, 879242, 'Sam Russel ', 'sam@gmail.com', '09452123546', '202cb962ac59075b964b07152d234b70', 'FB_IMG_1714400782969.jpg', 'Bautista', 'Cabaltica', 21, 'River side 2/ Sawmill', 'male', 'Active Now', NULL),
(27, 334042, 'owera', 'ad@gmail.com', '2222', '202cb962ac59075b964b07152d234b70', 'Purple and Blue Modern Upcoming Event Announcement Carousel Instagram Post (3).png', 'ernez', 'umali', 2, 'vghfgh', 'male', 'Active Now', NULL),
(28, 416831, 'jeremy', 'jeremyb@gmail.com', '09157646467', '202cb962ac59075b964b07152d234b70', 'profile.png', 'cando', 'benedicto', 22, 'Tagumpay', 'female', 'Active Now', 'human.jpg');

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
(5, 23, '15.4840291', '121.3122275', '2024-04-29 14:37:36'),
(6, 24, '15.4840291', '121.3122275', '2024-04-29 14:38:35'),
(7, 22, '15.4840291', '121.3122275', '2024-04-29 14:41:49'),
(8, 24, '15.455827194981422', '121.33762951725001', '2024-05-02 00:47:12'),
(9, 25, '15.45578', '121.337623', '2024-05-02 00:49:06'),
(11, 23, '15.455827194981422', '121.33762951725001', '2024-05-02 01:00:18'),
(12, 23, '15.455910362798612', '121.33775895172607', '2024-05-02 01:12:56'),
(13, 23, '15.455817266435442', '121.33762414911163', '2024-05-02 02:15:07'),
(14, 28, '15.484093999999999', '121.312214', '2024-05-07 06:41:25');

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
  MODIFY `accident_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_response`
--
ALTER TABLE `admin_response`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `injury_form`
--
ALTER TABLE `injury_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `photo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `user_form`
--
ALTER TABLE `user_form`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `user_locations`
--
ALTER TABLE `user_locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
