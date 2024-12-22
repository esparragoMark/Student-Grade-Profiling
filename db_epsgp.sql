-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2024 at 12:45 PM
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
-- Database: `db_epsgp`
--

-- --------------------------------------------------------

--
-- Table structure for table `first_quarter_tbl`
--

CREATE TABLE `first_quarter_tbl` (
  `id` int(11) NOT NULL,
  `ww1` int(11) DEFAULT NULL,
  `ww2` int(11) DEFAULT NULL,
  `ww3` int(11) DEFAULT NULL,
  `ww4` int(11) DEFAULT NULL,
  `ww5` int(11) DEFAULT NULL,
  `ww6` int(11) DEFAULT NULL,
  `ww7` int(11) DEFAULT NULL,
  `ww8` int(11) DEFAULT NULL,
  `ww9` int(11) DEFAULT NULL,
  `ww10` int(11) DEFAULT NULL,
  `wwTotal` int(11) DEFAULT NULL,
  `pt1` int(11) DEFAULT NULL,
  `pt2` int(11) DEFAULT NULL,
  `pt3` int(11) DEFAULT NULL,
  `pt4` int(11) DEFAULT NULL,
  `pt5` int(11) DEFAULT NULL,
  `pt6` int(11) DEFAULT NULL,
  `pt7` int(11) DEFAULT NULL,
  `pt8` int(11) DEFAULT NULL,
  `pt9` int(11) DEFAULT NULL,
  `pt10` int(11) DEFAULT NULL,
  `ptTotal` int(11) DEFAULT NULL,
  `quarterly_assessment` decimal(10,2) DEFAULT NULL,
  `quarterly_grade` decimal(10,2) DEFAULT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `first_quarter_tbl`
--

INSERT INTO `first_quarter_tbl` (`id`, `ww1`, `ww2`, `ww3`, `ww4`, `ww5`, `ww6`, `ww7`, `ww8`, `ww9`, `ww10`, `wwTotal`, `pt1`, `pt2`, `pt3`, `pt4`, `pt5`, `pt6`, `pt7`, `pt8`, `pt9`, `pt10`, `ptTotal`, `quarterly_assessment`, `quarterly_grade`, `student_id`) VALUES
(1, 10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 10, 8, 0, 0, 0, 0, 0, 0, 0, 0, 0, 8, 45.33, 90.78, 4);

-- --------------------------------------------------------

--
-- Table structure for table `fourth_quarter_tbl`
--

CREATE TABLE `fourth_quarter_tbl` (
  `id` int(11) NOT NULL,
  `ww1` int(11) DEFAULT NULL,
  `ww2` int(11) DEFAULT NULL,
  `ww3` int(11) DEFAULT NULL,
  `ww4` int(11) DEFAULT NULL,
  `ww5` int(11) DEFAULT NULL,
  `ww6` int(11) DEFAULT NULL,
  `ww7` int(11) DEFAULT NULL,
  `ww8` int(11) DEFAULT NULL,
  `ww9` int(11) DEFAULT NULL,
  `ww10` int(11) DEFAULT NULL,
  `wwTotal` int(11) DEFAULT NULL,
  `pt1` int(11) DEFAULT NULL,
  `pt2` int(11) DEFAULT NULL,
  `pt3` int(11) DEFAULT NULL,
  `pt4` int(11) DEFAULT NULL,
  `pt5` int(11) DEFAULT NULL,
  `pt6` int(11) DEFAULT NULL,
  `pt7` int(11) DEFAULT NULL,
  `pt8` int(11) DEFAULT NULL,
  `pt9` int(11) DEFAULT NULL,
  `pt10` int(11) DEFAULT NULL,
  `ptTotal` int(11) DEFAULT NULL,
  `quarterly_assessment` decimal(10,2) DEFAULT NULL,
  `quarterly_grade` decimal(10,2) DEFAULT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `second_quarter_tbl`
--

CREATE TABLE `second_quarter_tbl` (
  `id` int(11) NOT NULL,
  `ww1` int(11) DEFAULT NULL,
  `ww2` int(11) DEFAULT NULL,
  `ww3` int(11) DEFAULT NULL,
  `ww4` int(11) DEFAULT NULL,
  `ww5` int(11) DEFAULT NULL,
  `ww6` int(11) DEFAULT NULL,
  `ww7` int(11) DEFAULT NULL,
  `ww8` int(11) DEFAULT NULL,
  `ww9` int(11) DEFAULT NULL,
  `ww10` int(11) DEFAULT NULL,
  `wwTotal` int(11) DEFAULT NULL,
  `pt1` int(11) DEFAULT NULL,
  `pt2` int(11) DEFAULT NULL,
  `pt3` int(11) DEFAULT NULL,
  `pt4` int(11) DEFAULT NULL,
  `pt5` int(11) DEFAULT NULL,
  `pt6` int(11) DEFAULT NULL,
  `pt7` int(11) DEFAULT NULL,
  `pt8` int(11) DEFAULT NULL,
  `pt9` int(11) DEFAULT NULL,
  `pt10` int(11) DEFAULT NULL,
  `ptTotal` int(11) DEFAULT NULL,
  `quarterly_assessment` decimal(10,2) DEFAULT NULL,
  `quarterly_grade` decimal(10,2) DEFAULT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `second_quarter_tbl`
--

INSERT INTO `second_quarter_tbl` (`id`, `ww1`, `ww2`, `ww3`, `ww4`, `ww5`, `ww6`, `ww7`, `ww8`, `ww9`, `ww10`, `wwTotal`, `pt1`, `pt2`, `pt3`, `pt4`, `pt5`, `pt6`, `pt7`, `pt8`, `pt9`, `pt10`, `ptTotal`, `quarterly_assessment`, `quarterly_grade`, `student_id`) VALUES
(4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, 0.00, 4);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `student_LRN` varchar(20) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `class_name` varchar(100) NOT NULL,
  `grade_level` int(11) NOT NULL,
  `section` varchar(50) DEFAULT NULL,
  `school_year` varchar(20) NOT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `first_name`, `last_name`, `gender`, `student_LRN`, `date_of_birth`, `contact_number`, `email`, `class_name`, `grade_level`, `section`, `school_year`, `users_id`) VALUES
(3, 'Jason', 'Gagante', 'Female', '1234567', '2024-12-05', '09245673323', 'joy@gmail.com', 'mathemathics', 12, 'uranos', '2013-2014', 27),
(4, 'Pan', 'Kanton', 'Male', '113442083857', '2024-12-12', '09800900700', 'pancitkanton@gmail.com', 'Science', 11, 'A', '2023-2024', 26);

-- --------------------------------------------------------

--
-- Table structure for table `third_quarter_tbl`
--

CREATE TABLE `third_quarter_tbl` (
  `id` int(11) NOT NULL,
  `ww1` int(11) DEFAULT NULL,
  `ww2` int(11) DEFAULT NULL,
  `ww3` int(11) DEFAULT NULL,
  `ww4` int(11) DEFAULT NULL,
  `ww5` int(11) DEFAULT NULL,
  `ww6` int(11) DEFAULT NULL,
  `ww7` int(11) DEFAULT NULL,
  `ww8` int(11) DEFAULT NULL,
  `ww9` int(11) DEFAULT NULL,
  `ww10` int(11) DEFAULT NULL,
  `wwTotal` int(11) DEFAULT NULL,
  `pt1` int(11) DEFAULT NULL,
  `pt2` int(11) DEFAULT NULL,
  `pt3` int(11) DEFAULT NULL,
  `pt4` int(11) DEFAULT NULL,
  `pt5` int(11) DEFAULT NULL,
  `pt6` int(11) DEFAULT NULL,
  `pt7` int(11) DEFAULT NULL,
  `pt8` int(11) DEFAULT NULL,
  `pt9` int(11) DEFAULT NULL,
  `pt10` int(11) DEFAULT NULL,
  `ptTotal` int(11) DEFAULT NULL,
  `quarterly_assessment` decimal(10,2) DEFAULT NULL,
  `quarterly_grade` decimal(10,2) DEFAULT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','Teacher') NOT NULL,
  `token` varchar(64) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `username`, `password`, `role`, `token`, `image`) VALUES
(3, 'Joy Gagante', 'joy@gmail.com', 'joy', 'Admin', 'df86d62ef9dae5425617138101d6ee323ec001003e31fded1ac2a764deb0ec88', '../assets/image/epsgp_logo.jpg'),
(26, 'Example Lang', 'example@gmail.com', 'example', 'Teacher', 'fd5669e55730db7f18d844f176a8b0ce6b17df22f8ab491b613419365fd42f02', '../assets/image/temlogo.jpg'),
(27, 'alyssa', 'alyssa@gmail.com', '1234', 'Teacher', 'a4b9cba4e001b4f54921c387bd9ab657ef8241a8e301910a6b3a071cad91c47e', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `first_quarter_tbl`
--
ALTER TABLE `first_quarter_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `first_quarter_tbl_ibfk_1` (`student_id`);

--
-- Indexes for table `fourth_quarter_tbl`
--
ALTER TABLE `fourth_quarter_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `second_quarter_tbl`
--
ALTER TABLE `second_quarter_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `student_LRN` (`student_LRN`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `users_id` (`users_id`);

--
-- Indexes for table `third_quarter_tbl`
--
ALTER TABLE `third_quarter_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `token` (`token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `first_quarter_tbl`
--
ALTER TABLE `first_quarter_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `fourth_quarter_tbl`
--
ALTER TABLE `fourth_quarter_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `second_quarter_tbl`
--
ALTER TABLE `second_quarter_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `third_quarter_tbl`
--
ALTER TABLE `third_quarter_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `first_quarter_tbl`
--
ALTER TABLE `first_quarter_tbl`
  ADD CONSTRAINT `first_quarter_tbl_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE;

--
-- Constraints for table `fourth_quarter_tbl`
--
ALTER TABLE `fourth_quarter_tbl`
  ADD CONSTRAINT `fourth_quarter_tbl_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE;

--
-- Constraints for table `second_quarter_tbl`
--
ALTER TABLE `second_quarter_tbl`
  ADD CONSTRAINT `second_quarter_tbl_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `third_quarter_tbl`
--
ALTER TABLE `third_quarter_tbl`
  ADD CONSTRAINT `third_quarter_tbl_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
