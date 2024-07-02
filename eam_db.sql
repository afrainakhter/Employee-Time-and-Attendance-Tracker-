-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2024 at 05:02 PM
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
-- Database: `eam_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblleaves`
--

CREATE TABLE `tblleaves` (
  `Lid` int(11) NOT NULL,
  `LeaveType` varchar(110) NOT NULL,
  `ToDate` varchar(120) NOT NULL,
  `FromDate` varchar(120) NOT NULL,
  `duration` int(11) NOT NULL,
  `Description` mediumtext NOT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `AdminRemark` mediumtext DEFAULT NULL,
  `AdminRemarkDate` varchar(120) DEFAULT NULL,
  `Status` int(1) NOT NULL,
  `IsRead` int(1) NOT NULL,
  `employee_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblleaves`
--

INSERT INTO `tblleaves` (`Lid`, `LeaveType`, `ToDate`, `FromDate`, `duration`, `Description`, `PostingDate`, `AdminRemark`, `AdminRemarkDate`, `Status`, `IsRead`, `employee_id`) VALUES
(22, 'Study leave', '2024-01-27', '2024-01-17', 10, 'I want to study for my next project.', '2024-01-30 16:34:09', NULL, NULL, 1, 0, 3),
(23, 'Paternity leave', '2024-01-18', '2024-01-11', 7, 'humm', '2024-01-30 17:52:27', NULL, NULL, 0, 0, 3),
(24, 'Health Leave', '2024-01-10', '2024-01-05', 5, '', '2024-01-31 08:48:23', NULL, NULL, 1, 0, 7),
(25, 'Casual Leaves', '2024-02-28', '2024-01-31', 28, '', '2024-01-31 08:50:18', NULL, NULL, 2, 0, 7),
(26, 'Casual Leaves', '2024-02-07', '2024-02-01', 6, 'hi', '2024-02-07 18:33:58', NULL, NULL, 1, 0, 3),
(27, 'Casual Leaves', '2024-02-11', '2024-02-09', 2, 'hhhh', '2024-02-08 02:25:20', NULL, NULL, 1, 0, 9);

-- --------------------------------------------------------

--
-- Table structure for table `tblleavetype`
--

CREATE TABLE `tblleavetype` (
  `id` int(11) NOT NULL,
  `LeaveType` varchar(200) DEFAULT NULL,
  `Description` mediumtext DEFAULT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblleavetype`
--

INSERT INTO `tblleavetype` (`id`, `LeaveType`, `Description`, `CreationDate`) VALUES
(14, 'Casual Leaves', 'Casual Leave', '2024-01-30 16:29:07'),
(15, 'Health Leave', 'Health Leave', '2024-01-30 16:29:16'),
(16, 'Paternity leave', 'Paternity leave', '2024-01-30 16:29:26'),
(17, 'Study leave', 'Study leave', '2024-01-30 16:29:36'),
(18, 'Maternity leave', 'Maternity leave', '2024-01-30 16:29:45'),
(19, 'Bereavement leave', 'Bereavement leave', '2024-01-30 16:29:54');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attendance`
--

CREATE TABLE `tbl_attendance` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `shift` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date` date NOT NULL,
  `check_in` time NOT NULL,
  `in_status` varchar(255) NOT NULL,
  `check_out` time NOT NULL,
  `out_status` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_attendance`
--

INSERT INTO `tbl_attendance` (`id`, `employee_id`, `department`, `shift`, `location`, `message`, `date`, `check_in`, `in_status`, `check_out`, `out_status`, `created_at`) VALUES
(2, 'EMP-2', 'Business', '05:00:00-09:00:00', 'Home', 'sorry I am late', '2024-01-30', '22:04:29', 'Late', '22:04:31', 'Over Time', '2024-01-30 16:34:31'),
(3, 'EMP-2', 'Business', '05:00:00-09:00:00', 'Home', 'hi ', '2024-02-07', '00:03:29', 'On Time', '00:00:00', '', '2024-02-07 18:33:29'),
(4, 'EMP-9', 'HR', '05:00:00-09:00:00', 'Home', 'hi', '2024-02-08', '07:52:56', 'Late', '07:54:09', 'Early', '2024-02-08 02:24:09');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_department`
--

CREATE TABLE `tbl_department` (
  `id` int(11) NOT NULL,
  `department_id` varchar(255) NOT NULL,
  `department_name` varchar(250) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1=Active, 0=Inactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_department`
--

INSERT INTO `tbl_department` (`id`, `department_id`, `department_name`, `status`, `created_at`) VALUES
(4, '1', 'HR', 1, '2024-01-30 16:28:20'),
(5, '2', 'IT', 1, '2024-01-30 16:28:28'),
(6, '3', 'Business', 1, '2024-01-30 16:28:35');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee`
--

CREATE TABLE `tbl_employee` (
  `id` int(11) NOT NULL,
  `first_name` varchar(250) NOT NULL,
  `last_name` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `emailid` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `dob` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `employee_id` varchar(250) NOT NULL,
  `joining_date` varchar(250) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `shift` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT '0' COMMENT '1=Admin, 0=Employee',
  `status` tinyint(4) NOT NULL COMMENT '1=Active, 0=Inactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Lrty` int(11) DEFAULT 25,
  `password_reset` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `tbl_employee`
--

INSERT INTO `tbl_employee` (`id`, `first_name`, `last_name`, `username`, `emailid`, `password`, `dob`, `gender`, `employee_id`, `joining_date`, `phone`, `shift`, `department`, `role`, `status`, `created_at`, `Lrty`, `password_reset`) VALUES
(1, 'Time', 'Vista', 'tvista', 'tvista@mail.com', '123hello', '1992-02-15', 'Male', 'ASTR012447', '2024-01-10', '7854000065', '0', 'Admin', '1', 1, '2024-01-30 15:52:32', 25, 0),
(3, 'Afrain', 'akhter', 'afrain', 'afrain@gmail.com', '$2y$10$GdffzJGKBNfJ3rFYbsASouDJxakazVhy7Q7BysTycOUH7WaREmXLK', '18/04/2001', 'Female', 'EMP-2', '04/01/2024', '0188633120', '05:00:00-09:00:00', 'Business', '0', 1, '2024-02-07 18:34:35', 9, 1),
(4, 'Zarin', 'Tasmin', 'roichi', 'zarin@gmail.com', '$2y$10$.PmuhmjwNFEjscV4bfgzqOLKekm0p.RzPJFw86DgO/zwBNr5MZ6yK', '03/01/2024', 'Female', 'EMP-4', '04/01/2024', '0188633120', '05:00:00-09:00:00', 'IT', '0', 1, '2024-02-07 17:21:17', 25, 1),
(5, 'Fabiha', 'Tahsin', 'fabiha', 'faviha@gmail.com', '$2y$10$uhf31c27Ic7y5wLA45vtleMMJhMfD77ENt9aEJ9iH32bj86IISbOe', '15/05/2002', 'Female', 'EMP-5', '13/01/2024', '0188633768', '05:00:00-09:00:00', 'IT', '0', 1, '2024-01-31 07:42:39', 25, 1),
(6, 'risad', 'risad', 'risad', 'risad@gmail.com', '123456', '31/01/2001', 'Male', 'EMP-6', '04/01/2024', '0188633120', '05:00:00-09:00:00', 'IT', '0', 1, '2024-01-31 08:38:06', 25, 1),
(7, 'rter', 'ee', 'rt', 'ere@gmail.com', '123456', '31/01/2001', 'Female', 'EMP-7', '11/01/2024', '0188633120', '05:00:00-09:00:00', 'HR', '0', 1, '2024-01-31 08:50:56', 5, 1),
(8, 'araaf', 'abu', 'araf', 'araf@gmail.com', '123hello', '08/02/2002', 'Male', 'EMP-8', '08/02/2024', '0188633120', '05:00:00-09:00:00', 'HR', '0', 1, '2024-02-07 20:05:59', 25, 0),
(9, 'afrain ', 'ak', 'afrainakhter', 'afrain@gmail.com', '$2y$10$k37vOrdxJ3AiiUi8c2RMeuFZikPBM9JDOH3rnQ6K2b5le.5jP29Bm', '08/02/2002', 'Female', 'EMP-9', '09/02/2024', '0188633120', '05:00:00-09:00:00', 'HR', '0', 1, '2024-02-08 02:27:08', 23, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_location`
--

CREATE TABLE `tbl_location` (
  `id` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_location`
--

INSERT INTO `tbl_location` (`id`, `location`, `created_at`) VALUES
(4, 'Home', '2024-01-30 16:27:47'),
(5, 'Office', '2024-01-30 16:27:51'),
(6, 'Field', '2024-01-30 16:28:06');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shift`
--

CREATE TABLE `tbl_shift` (
  `id` int(11) NOT NULL,
  `start_time` varchar(255) NOT NULL,
  `end_time` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1=Active,0=Inactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_shift`
--

INSERT INTO `tbl_shift` (`id`, `start_time`, `end_time`, `status`, `created_at`) VALUES
(3, '05:00:00', '09:00:00', 1, '2024-01-30 16:27:14'),
(4, '09:00:00', '05:00:00', 1, '2024-01-30 16:27:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblleaves`
--
ALTER TABLE `tblleaves`
  ADD PRIMARY KEY (`Lid`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `tblleavetype`
--
ALTER TABLE `tblleavetype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_department`
--
ALTER TABLE `tbl_department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_location`
--
ALTER TABLE `tbl_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_shift`
--
ALTER TABLE `tbl_shift`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblleaves`
--
ALTER TABLE `tblleaves`
  MODIFY `Lid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tblleavetype`
--
ALTER TABLE `tblleavetype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_department`
--
ALTER TABLE `tbl_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_location`
--
ALTER TABLE `tbl_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_shift`
--
ALTER TABLE `tbl_shift`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblleaves`
--
ALTER TABLE `tblleaves`
  ADD CONSTRAINT `tblleaves_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `tbl_employee` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
