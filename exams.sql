-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2025 at 12:38 PM
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
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `exam_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `room_id` int(11) NOT NULL,
  `exam_time` time NOT NULL,
  `invigilator1` varchar(40) NOT NULL,
  `invigilator2` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `subject`, `exam_date`, `start_time`, `end_time`, `room_id`, `exam_time`, `invigilator1`, `invigilator2`) VALUES
(30, 'C', '2025-03-20', '00:00:00', '00:00:00', 56, '09:30:00', '', ''),
(31, 'PYTHON', '2025-03-20', '00:00:00', '00:00:00', 57, '09:30:00', '', ''),
(32, 'JAVA', '2025-03-21', '00:00:00', '00:00:00', 58, '09:30:00', '', ''),
(33, 'DS', '2025-03-21', '00:00:00', '00:00:00', 59, '09:30:00', '', ''),
(34, 'CN', '2025-03-21', '00:00:00', '00:00:00', 60, '10:00:00', '', ''),
(35, 'DBMS', '2025-03-20', '00:00:00', '00:00:00', 56, '14:30:00', '', ''),
(36, 'DAA', '2025-03-20', '00:00:00', '00:00:00', 57, '14:30:00', '', ''),
(37, 'FSAD', '2025-03-21', '00:00:00', '00:00:00', 58, '14:30:00', '', ''),
(38, 'DM', '2025-03-21', '00:00:00', '00:00:00', 59, '14:30:00', '', ''),
(39, 'C#', '2025-03-22', '00:00:00', '00:00:00', 60, '09:30:00', '', ''),
(40, 'FLAT', '2025-03-22', '00:00:00', '00:00:00', 57, '02:30:00', '', ''),
(41, 'IML', '2025-03-15', '00:00:00', '00:00:00', 60, '01:45:00', '', ''),
(42, 'co', '2025-03-16', '00:00:00', '00:00:00', 63, '15:00:00', '', ''),
(43, 'ENS', '2025-03-15', '00:00:00', '00:00:00', 58, '10:00:00', '', ''),
(44, 'FLAT', '2025-03-30', '00:00:00', '00:00:00', 58, '18:00:00', '', ''),
(45, 'AP', '2025-03-16', '00:00:00', '00:00:00', 59, '03:00:00', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
