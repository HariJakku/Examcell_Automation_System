-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2025 at 12:39 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exam_cell_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `room_allocations`
--

CREATE TABLE `room_allocations` (
  `allocation_id` int(11) NOT NULL,
  `room_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_allocations`
--

INSERT INTO `room_allocations` (`allocation_id`, `room_id`, `student_id`) VALUES
(9, 56, 25),
(10, 56, 26),
(11, 56, 27),
(12, 56, 28),
(13, 56, 29),
(14, 57, 30),
(15, 57, 31),
(16, 57, 32),
(17, 57, 33),
(18, 57, 34),
(19, 58, 35),
(20, 58, 36),
(21, 58, 37),
(22, 58, 38),
(23, 58, 39),
(24, 59, 40),
(25, 59, 41),
(26, 59, 42),
(27, 59, 43),
(28, 59, 44),
(29, 59, 45),
(30, 59, 46),
(31, 59, 47),
(32, 59, 48),
(33, 59, 49),
(34, 60, 50),
(35, 60, 51),
(36, 60, 52),
(37, 60, 53),
(38, 60, 54);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `room_allocations`
--
ALTER TABLE `room_allocations`
  ADD PRIMARY KEY (`allocation_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `student_id` (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `room_allocations`
--
ALTER TABLE `room_allocations`
  MODIFY `allocation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `room_allocations`
--
ALTER TABLE `room_allocations`
  ADD CONSTRAINT `room_allocations_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`),
  ADD CONSTRAINT `room_allocations_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
