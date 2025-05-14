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
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(11) NOT NULL,
  `student_id` varchar(50) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `marks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `student_id`, `subject`, `marks`) VALUES
(23, '22501', 'C', 30),
(24, '22501', 'PYTHON', 28),
(25, '22501', 'JAVA', 30),
(26, '22501', 'DBMS', 29),
(27, '22501', 'CN', 28),
(28, '22502', 'C', 30),
(29, '22502', 'DBMS', 28),
(30, '22502', 'CN', 30),
(31, '22502', 'C#', 30),
(32, '22502', 'PYTHON', 28),
(33, '22503', 'FSAD', 29),
(34, '22503', 'DM', 28),
(35, '22503', 'PYTHON', 28),
(36, '22503', 'C', 27),
(37, '22503', 'JAVA', 25),
(38, '22504', 'C', 25),
(39, '22504', 'PYTHON', 28),
(40, '22504', 'JAVA', 30),
(41, '22504', 'DBMS', 30),
(42, '22504', 'CN', 29),
(43, '22505', 'FSAD', 29),
(44, '22505', 'DM', 30),
(45, '22505', 'PYTHON', 28),
(46, '22505', 'C', 27),
(47, '22505', 'JAVA', 30),
(48, '22506', 'JAVA', 30),
(49, '22506', 'C', 28),
(56, '22508', 'JAVA', 25),
(57, '22508', 'PYTHON', 28),
(58, '22509', 'C', 29),
(59, '22509', 'JAVA', 27);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `results_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
