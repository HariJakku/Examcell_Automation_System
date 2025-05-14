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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','staff','student') NOT NULL
) ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `user_id`, `password`, `role`) VALUES
(14, 'likitha', 'admin@gmail.com', NULL, '$2y$10$W7MNdB2g3caTVKjG1Q88WeSyYj3ovf61X0d/3dkn5njbeBhpUYzPu', 'admin'),
(15, 'ADITYA', NULL, 'stf-1', '$2y$10$Mnx1ORYl.zQZbb9./GJK9eSovS5mQKb9UkbVYd/3FpHK/hnv.zVbi', 'staff'),
(16, 'Bhasker', NULL, 'stf-2', '$2y$10$cK3FM4HI6Kysbpltjzd07e9WKZViEjUmZvAQBw5bpJoLcWujL0v4C', 'staff'),
(17, 'Rajeshwari', NULL, 'stf-3', '$2y$10$6LQTeNNXbG3dkdjO7tvyaehFJNxujOD2NqNr.QTlpbOsrV6CUeoJG', 'staff'),
(18, 'Reshma', NULL, 'stf-4', '$2y$10$37g2eXfvyQwjMB.OBHpgPODIjQ2g.DtznKXbRknNKiVutzCSKeJQ2', 'staff'),
(19, 'Aparna', NULL, 'stf-5', '$2y$10$9EqrgPVuiwKfvuXZMl2YG.t4TZj98QKvCb7VB.tVsjvS5EyPqUqJK', 'staff'),
(20, 'Tulasi', NULL, 'stf-6', '$2y$10$zhbpkj70VytSYDybBXqe5uAVo6yGdffMy.Uz4pYm7VdL7cYq3pLmy', 'staff'),
(21, 'BabuRao', NULL, 'stf-7', '$2y$10$feAxGpgj.Krk6SlHpXT7uObhYl/ZkpDkrHKBjlXyrkdcMjrOid0N.', 'staff'),
(22, 'Prasad', NULL, 'stf-8', '$2y$10$YNbTs1BaK815ZDxIAobbRObCQ1UMg01BNMDq5IIu9kaxiPsHv2eRO', 'staff'),
(23, 'BalaKrishna', NULL, 'stf-9', '$2y$10$jcPRKI9JP4Sb36pLbHi8E.RxZKZbJsELG6HF21nFYNM.pyCWozaaC', 'staff'),
(24, 'SriLaxmi', NULL, 'stf-10', '$2y$10$QbYJck1KhprPRjAMX0g5UOjLGlh0jWd0Ko1GO8AnW9hwbrVHdcsAm', 'staff'),
(25, 'laxmi', NULL, '22501', '$2y$10$x95jZkLhCH9DWbyJFMwR0OhDZxs3j4A1zrnzPq65zJyafI3UGBaIy', 'student'),
(26, 'hari', NULL, '22502', '$2y$10$/IeqUQItKMxWDqNk0Y5fqOuuVgTDQWrFZ1a9cxVYrq9RDw3/yyXO6', 'student'),
(27, 'dharani', NULL, '22503', '$2y$10$rWpAFX/jMntSPIODRFZArOANwS3P0c0Tabsy7HK87iFxW96Z9EMD6', 'student'),
(28, 'aruna', NULL, '22504', '$2y$10$hAcnWxpWPGjwWrU.3WlS2ed520HsdTnob7qySeSU3sFfvchjbKBpm', 'student'),
(29, 'satish', NULL, '22505', '$2y$10$q2OQLyWkTA9GMsj/3W/LzOBgO.byNBS4Yy3TaM55vLzYauR9FNanC', 'student'),
(30, 'sujatha', NULL, '22506', '$2y$10$oYyMax5hnLWfGe4aJjfM4.EVRpb9bjZm11XC05f/kfY49N/7O96cW', 'student'),
(31, 'karthik', NULL, '22507', '$2y$10$YHCMQxqJUMh2nsK5fhgTxudoqzvzUQ1gUEW64VX9PbSU/JAsdrama', 'student'),
(32, 'shyam', NULL, '22508', '$2y$10$cS.5fjbFgNl7XaLAPIE5RuvmxR5JvRtuYn2j5Oh30J1S3Qz8bbBgi', 'student'),
(33, 'Santhosh', NULL, '22509', '$2y$10$t7yEK0RtHixCB.f055ax8OH4qfV41fs0BsbOCsmc.Ob6v71Re0n1q', 'student'),
(34, 'Uma', NULL, '22510', '$2y$10$lB0igKOfoqKzU5SxB4wa/.pLdSZ02lkSqCRXy9QZoFaBmIYTYcF5a', 'student'),
(35, 'Neelima', NULL, '22511', '$2y$10$g.U/v.zX8rSJzkIirtxB5e7a.vdGdelvex6FIetq9llwKxNTURama', 'student'),
(36, 'Sai', NULL, '22512', '$2y$10$LZV0tbICdLa0yOuPpA719OgvzpBluQJBaH4ADaHN/8gf2v4TloBRe', 'student'),
(37, 'Likhil', NULL, '22513', '$2y$10$9gQy/7UMPmhHrdBiF3vaduuwgnOPXGQlbpUb4h54wgKY9wZyXVXuq', 'student'),
(38, 'Revanth', NULL, '22514', '$2y$10$2iCU5YZ3hq/4Wb6EJ2.gx.rUMoc.25W7x8cdLfiICE4UuTKB81RfK', 'student'),
(39, 'Jyoshna', NULL, '22515', '$2y$10$miNC7ibpjjIQLrFNZA2ZCuyuHiYkhUE8Gf7KEy7VfJJNQsY56Fcq6', 'student'),
(40, 'Ashok', NULL, '22516', '$2y$10$YBdQmnkQV2c9BbtzlpF77.HjPU3IEOnxoxgMdPGq9JIC8a9bxzF2q', 'student'),
(41, 'Shiva', NULL, '22517', '$2y$10$uzjv2uRhrdmDeMh4twhciO8WhPDKy14K6V8rmKVpPxm0vxS6Ez9.K', 'student'),
(42, 'Jahnavi', NULL, '22518', '$2y$10$5h3wwm1LnV1J.pltYDfVceT.zWnG5KIhVtb7jrri.UIru6qjyEha2', 'student'),
(43, 'Harsha', NULL, '22519', '$2y$10$jZTCmJ8/aCAJ8tqPjOiMz.rU9A3Agr2iIUyKPVvBlcMGauoeSODHS', 'student'),
(44, 'Sharmila', NULL, '22520', '$2y$10$ZrSRMWq2sxhs2u5gOJ3hi.G86VxTBhEuH9woojhdX6Gqawtw8ZNJi', 'student'),
(45, 'Ganesh', NULL, '22521', '$2y$10$fe2fEeIOZ1KyXnWCBOV9FeWEy8Q0gzx.oRZPiIpRS.kPADLRY68qm', 'student'),
(46, 'Lavanya', NULL, '22522', '$2y$10$zi02DXNqX7sF0EnsBaQ3vOGfATl.dV0kuo0h9P7cKLWIpYkQUuYB2', 'student'),
(47, 'Haritha', NULL, '22523', '$2y$10$mO/e3BiAp4a/m4cq/USCHeVB8EDhjASfVhPBLkfVJaSCbu1cYSSIi', 'student'),
(48, 'Snigdha', NULL, '22524', '$2y$10$ioHEaTHkDiHUd9T45jqOD.vwt45f9yfEmOF3abPdVHmwcYxBZETae', 'student'),
(49, 'Prasanna', NULL, '22525', '$2y$10$lQuzj5K5BP8QW3ItOiXK2e5Fc97tbE021jD/tf394fzKee/Mz79ly', 'student'),
(50, 'KrishnaSai', NULL, '22526', '$2y$10$51R.RONgvIEv98iXxZP5bOFxnGsNQWpj38XYVsKg2pNFktsoRZCo6', 'student'),
(51, 'Deepthi', NULL, '22527', '$2y$10$eXlrwFyYdAOhhChKOcwZVue6C.uYEClqd1aYGf13uCi72fQLRPqBK', 'student'),
(52, 'Sandhya', NULL, '22528', '$2y$10$1MhApgR2SLn1UjKT9M0KzeMgn/mxSdrs4Ulmfi4iBa63SH5cSeCDG', 'student'),
(53, 'Sravani', NULL, '22529', '$2y$10$N0H4MGXWofgIzIA/tk4hBO5kRwlh6BoFVXfV/wlTgs7afu9qAgKGS', 'student'),
(54, 'jaishankar', NULL, '22530', '$2y$10$2qdx4SmUTPJF1vUAqSyb6ekjc/8NOxhGcVg3jx8YDUaCTqQPkwGIK', 'student'),
(55, 'navya', NULL, '22531', '$2y$10$9c/csIbAhGFLML4g6sXuu.e.jbZP5gY1x9YwZfjVIgDN6Z1f2/1vy', 'student'),
(57, 'abc', NULL, '20501', '$2y$10$5VTgSpY44Ye19FvDCQGL7.ud8i6lnd84OchJu9u23ggM7nocD4aAS', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
