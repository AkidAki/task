-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Dec 17, 2024 at 05:14 PM
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
-- Database: `task_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `COMMENT_ID` varchar(10) NOT NULL,
  `CONTENT` varchar(200) NOT NULL,
  `EMPLOYEE_ID` varchar(10) NOT NULL,
  `TASK_ID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `EMPLOYEE_ID` int(10) NOT NULL,
  `EMPLOYEE_NAME` varchar(200) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `EMP_PASSWORD` varchar(10) NOT NULL,
  `JOB_TITLE` varchar(50) NOT NULL,
  `HIRE_DATE` date NOT NULL,
  `EMPLOYEE_USERNAME` varchar(20) NOT NULL,
  `MANAGER_ID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`EMPLOYEE_ID`, `EMPLOYEE_NAME`, `EMAIL`, `EMP_PASSWORD`, `JOB_TITLE`, `HIRE_DATE`, `EMPLOYEE_USERNAME`, `MANAGER_ID`) VALUES
(1, 'Ahmad', 'ahmad@gmail.com', 'Ahmad1', 'System Analyst', '2024-12-03', 'ahmad1', '002'),
(2, 'Ifwat', 'ifwat@gmail.com', '', 'Cleaner berjaya', '2025-11-11', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `MANAGER_ID` varchar(10) NOT NULL,
  `DEPARTMENT` varchar(20) NOT NULL,
  `MANAGER_NAME` varchar(200) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `MAN_PASSWORD` varchar(10) NOT NULL,
  `HIRE_DATE` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`MANAGER_ID`, `DEPARTMENT`, `MANAGER_NAME`, `EMAIL`, `MAN_PASSWORD`, `HIRE_DATE`) VALUES
('002', 'tapah', 'jebat', 'jebat@gmail.com', 'Jebat1', '2024-12-10');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `PROJECT_ID` varchar(10) NOT NULL,
  `PROJECT_NAME` varchar(200) NOT NULL,
  `DESCRIPTION` varchar(200) NOT NULL,
  `START_DATE` date NOT NULL,
  `END_DATE` date NOT NULL,
  `MANAGER_ID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `TASK_ID` varchar(10) NOT NULL,
  `TASK_NAME` varchar(200) NOT NULL,
  `DESCRIPTION` varchar(200) NOT NULL,
  `PRIORITY` varchar(50) NOT NULL,
  `STATUS` varchar(10) NOT NULL,
  `DUE_DATE` date NOT NULL,
  `EMPLOYEE_ID` varchar(10) NOT NULL,
  `PROJECT_ID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`COMMENT_ID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`EMPLOYEE_ID`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`MANAGER_ID`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`PROJECT_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `EMPLOYEE_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
