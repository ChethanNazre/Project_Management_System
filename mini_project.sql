-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2024 at 03:59 PM
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
-- Database: `mini_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `project_details`
--

CREATE TABLE `project_details` (
  `project_id` varchar(10) NOT NULL,
  `project_title` varchar(100) NOT NULL,
  `project_mentor` varchar(30) NOT NULL,
  `academic_year` varchar(10) NOT NULL,
  `problem_statement` varchar(200) NOT NULL,
  `team_number` int(10) NOT NULL,
  `student_1` varchar(20) NOT NULL,
  `usn_1` varchar(20) NOT NULL,
  `student_2` varchar(20) NOT NULL,
  `usn_2` varchar(20) NOT NULL,
  `student_3` varchar(20) NOT NULL,
  `usn_3` varchar(20) NOT NULL,
  `student_4` varchar(20) NOT NULL,
  `usn_4` varchar(20) NOT NULL,
  `student_5` varchar(20) NOT NULL,
  `usn_5` varchar(20) NOT NULL,
  `report_file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `uandp`
--

CREATE TABLE `uandp` (
  `username` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `project_details`
--
ALTER TABLE `project_details`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `uandp`
--
ALTER TABLE `uandp`
  ADD PRIMARY KEY (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
