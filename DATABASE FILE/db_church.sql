-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2023 at 03:43 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_church`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_baptism`
--

CREATE TABLE `tbl_baptism` (
  `id` int(11) NOT NULL,
  `Candidate` varchar(255) NOT NULL,
  `Birth` date NOT NULL,
  `Place` varchar(255) NOT NULL,
  `Father` varchar(255) NOT NULL,
  `Mother` varchar(255) NOT NULL,
  `number` bigint(15) NOT NULL,
  `Godmother` varchar(255) NOT NULL,
  `Godfather` varchar(255) NOT NULL,
  `Baptism` date NOT NULL,
  `Verification` tinyint(1) NOT NULL,
  `Verification1` tinyint(1) NOT NULL,
  `Verification2` tinyint(1) NOT NULL,
  `Verification3` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_baptism`
--

INSERT INTO `tbl_baptism` (`id`, `Candidate`, `Birth`, `Place`, `Father`, `Mother`, `number`, `Godmother`, `Godfather`, `Baptism`, `Verification`, `Verification1`, `Verification2`, `Verification3`) VALUES
(1, 'Emily Johnson', '2022-04-15', 'Sto. Tomas', 'Michael Johnson', 'Sarah Johnson', 9123487841, 'Jennifer Davis', 'Robert Thompson', '2023-04-30', 0, 0, 0, 0),
(2, 'David Wilson', '2022-09-08', 'Tanauan', 'Thomas Wilson', 'Jessica Wilson', 9148872654, 'Amanda Roberts', 'Christopher Brown', '2023-05-07', 0, 0, 0, 0),
(3, 'Sophia Thompson', '2022-12-08', 'Sto. Tomas', 'Benjamin Thompson', 'Olivia Thompson', 9124813577, 'Emily Martinez', 'Daniel Anderson', '2023-05-14', 0, 0, 0, 0),
(4, 'Ethan Davis', '2023-01-30', 'Tanauan', 'Matthew Davis', 'Lauren Davis', 9418756412, 'Samantha Miller', 'Andrew Wilson', '2023-05-21', 0, 0, 0, 0),
(5, 'Ava Hernandez', '2023-03-12', 'Sto. Tomas', 'Juan Hernandez', 'Maria Hernandez', 9425785412, 'Isabella Lopez', 'Gabriel Ramirez', '2023-04-23', 0, 0, 0, 0),
(6, 'Liam Clark', '2022-08-22', 'Calamba', 'Christopher Clark', ' Emily Clark', 9421875121, 'Victoria Turner', 'Samuel Scott', '2023-05-21', 0, 0, 0, 0),
(7, 'Isabella Moore', '2022-08-04', 'Tanauan', 'David Moore', 'Sarah Moore', 9413215451, 'Sophia Lewis', 'Benjamin Turner', '2023-05-21', 0, 0, 0, 0),
(8, 'Olivia Martinez', '2022-07-04', 'Tanauan', 'Carlos Martinez', 'Maria Martinez', 9842317841, 'Gabriela Garcia', 'Alejandro Rodriguez', '2023-04-23', 0, 0, 0, 0),
(9, 'Elijah Walker', '2022-06-12', 'Sto. Tomas', 'Michael Walker', ' Jessica Walker', 9425752156, 'Emily Wright', 'Daniel Thompson', '2023-05-21', 0, 0, 0, 0),
(10, 'Mia Garcia', '2022-06-19', 'Sto. Tomas', 'Antonio Garcia', 'Sofia Garcia', 9452158711, 'Gabriela Hernandez', 'Luis Ramirez', '2023-05-21', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bride`
--

CREATE TABLE `tbl_bride` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `age` int(11) NOT NULL,
  `place` varchar(50) NOT NULL,
  `citizenship` varchar(50) NOT NULL,
  `number` bigint(11) NOT NULL,
  `Religion` varchar(50) NOT NULL,
  `father` varchar(50) NOT NULL,
  `mother` varchar(50) NOT NULL,
  `dob2` date NOT NULL,
  `time` varchar(50) NOT NULL,
  `verification` tinyint(1) NOT NULL,
  `Verification1` tinyint(1) NOT NULL,
  `Verification2` tinyint(1) NOT NULL,
  `Verification3` tinyint(1) NOT NULL,
  `Verification4` tinyint(1) NOT NULL,
  `Verification5` tinyint(1) NOT NULL,
  `Verification6` tinyint(1) NOT NULL,
  `Verification7` tinyint(1) NOT NULL,
  `Verification8` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_bride`
--

INSERT INTO `tbl_bride` (`id`, `name`, `email`, `dob`, `age`, `place`, `citizenship`, `number`, `Religion`, `father`, `mother`, `dob2`, `time`, `verification`, `Verification1`, `Verification2`, `Verification3`, `Verification4`, `Verification5`, `Verification6`, `Verification7`, `Verification8`) VALUES
(1, 'Emily Johnson', 'emily.johnson@example.com', '1992-09-28', 30, 'Lipa City', 'Filipino', 9234567890, 'Catholic', 'Robert Johnson', 'Jennifer Johnson', '2023-05-14', '10AM', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 'Sofia Santos', 'sofia.santos@example.com', '1999-06-20', 23, 'Batangas City', 'Filipino', 9218765432, 'Christian', 'Ricardo Santos', 'Carmen Santos', '2023-05-14', '11AM', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 'Isabella Gomez', 'isabella.gomez@example.com', '1995-09-15', 27, 'San Juan, Batangas', 'Filipino', 9234567890, 'Christian', 'Alejandro Gomez', 'Sofia Gomez', '2023-05-14', '11AM', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, 'Sophia Torres', 'sophia.torres@example.com', '1990-04-18', 33, 'Nasugbu, Batangas', 'Filipino', 9218765432, 'Christian', 'Ricardo Torres', 'Carmen Torres', '2023-05-14', '3PM', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5, 'Emma Reyes', 'emma.reyes@example.com', '1993-08-12', 29, 'Batangas City', 'Filipino', 9234567890, 'Christian', 'Jose Reyes', 'Maria Reyes', '2023-05-14', '4PM', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6, 'Olivia Dela Cruz', 'olivia.delacruz@example.com', '1991-05-19', 31, 'Tanauan City', 'Filipino', 9218765432, 'Christian', 'Antonio Dela Cruz', 'Maria Dela Cruz', '2023-05-28', '3PM', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(7, 'Camila Santos', 'camila.santos@example.com', '1992-03-14', 31, 'Batangas City', 'Filipino', 9234567890, 'Christian', 'Ricardo Santos', 'Carmen Santos', '2023-05-28', '11AM', 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_funeral`
--

CREATE TABLE `tbl_funeral` (
  `id` int(11) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `birth` date NOT NULL,
  `death` date NOT NULL,
  `age` int(11) NOT NULL,
  `spouse` varchar(255) NOT NULL,
  `name_of_kin` varchar(255) NOT NULL,
  `relationship_to_deceased` varchar(255) NOT NULL,
  `number` bigint(20) NOT NULL,
  `mass` date NOT NULL,
  `death_certificate` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_funeral`
--

INSERT INTO `tbl_funeral` (`id`, `lastname`, `firstname`, `birth`, `death`, `age`, `spouse`, `name_of_kin`, `relationship_to_deceased`, `number`, `mass`, `death_certificate`) VALUES
(1, 'asdfasdf', 'asdfasdfasdf', '1999-09-18', '2023-05-03', 23, 'asdfasdf', 'asddfasfda', 'asdfasfa', 12312312312, '2023-05-21', 1),
(2, 'lumes', 'juan', '2019-06-04', '2023-05-04', 3, 'a', 's', 's', 96567, '2023-05-07', 0),
(3, 'sas', 'asasasa', '2011-02-01', '2023-05-04', 12, 'sa', 'as', 'asasa', 123123, '2023-05-07', 0),
(4, 'asdas', 'dasdasd', '2023-01-04', '2023-05-04', 0, 'dasdas', 'dasd', 'asdas', 0, '2023-05-07', 0),
(5, 'asdas', 'dasdasd', '2023-01-04', '2023-05-04', 0, 'dasdas', 'dasd', 'asdas', 0, '2023-05-07', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_groom`
--

CREATE TABLE `tbl_groom` (
  `id` int(11) NOT NULL,
  `name1` varchar(255) NOT NULL,
  `email1` varchar(255) NOT NULL,
  `dob1` date NOT NULL,
  `age1` int(11) NOT NULL,
  `place1` varchar(255) NOT NULL,
  `citizenship1` varchar(255) NOT NULL,
  `number1` bigint(15) NOT NULL,
  `Religion1` varchar(255) NOT NULL,
  `father1` varchar(255) NOT NULL,
  `mother1` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_groom`
--

INSERT INTO `tbl_groom` (`id`, `name1`, `email1`, `dob1`, `age1`, `place1`, `citizenship1`, `number1`, `Religion1`, `father1`, `mother1`) VALUES
(1, 'John Smith', ' john.smith@example.com', '1990-05-15', 32, 'Batangas City', 'Filipino', 9123456789, 'Christian', 'Michael Smith', 'Susan Smith'),
(2, 'Benjamin Cruz', 'benjamin.cruz@example.com', '1998-12-10', 24, 'Tanauan City', 'Filipino', 9187654321, 'Catholic', 'Antonio Cruz', 'Maria Cruz'),
(3, 'Gabriel Reyes', 'gabriel.reyes@example.com', '1993-03-05', 30, 'Lipa City', 'Filipino', 9123456789, 'Catholic', 'Manuel Reyes', 'Patricia Reyes'),
(4, 'Daniel Lim', 'daniel.lim@example.com', '1987-07-29', 35, 'Malvar, Batangas', 'Filipino', 9187654321, 'Catholic', 'Eduardo Lim', 'Anita Lim'),
(5, 'Samuel Santos', 'samuel.santos@example.com', '1992-11-08', 30, 'Tanauan City', 'Filipino', 9123456789, 'Catholic', 'Juan Santos', 'Maria Santos'),
(6, 'Miguel Fernandez', 'miguel.fernandez@example.com', '1989-11-02', 33, 'Nasugbu, Batangas', 'Filipino', 9187654321, 'Catholic', 'Ricardo Fernandez', 'Carmen Fernandez'),
(7, 'Sebastian Reyes', 'sebastian.reyes@example.com', '1994-07-08', 28, 'Lipa City', 'Filipino', 9123456789, 'Catholic', 'Juan Reyes', 'Sofia Reyes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `UserType` varchar(255) NOT NULL DEFAULT 'User'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`ID`, `Name`, `Username`, `Password`, `UserType`) VALUES
(1, '', '', 'd41d8cd98f00b204e9800998ecf8427e', 'd41d8cd98f00b204e9800998ecf8427e'),
(2, 'Veronica Matore', 'vrncmtr', '$2y$10$ldtk3ygw4rR8K82oVQg2F.W5sbjuOUPsX29P7/IDGV5sgY74RAIx6', 'Admin'),
(3, 'vero', 'vero5', '7b6e2b9ce94e0df714e842041ea8c76f', 'User'),
(4, 'Giordan Benamir', 'kapenamir', '1059c5ae65326e7f02ba9a9552889c6a', 'Admin'),
(5, 'jay', 'jay', '3680c9b1b4242280103410dd997e3d9d', 'Admin'),
(6, 'Veronica Matore', 'vrncmtr', '$2y$10$ldtk3ygw4rR8K82oVQg2F.W5sbjuOUPsX29P7/IDGV5sgY74RAIx6', 'Admin'),
(7, 'Veronica Matore', 'vrncmtr', '$2y$10$ldtk3ygw4rR8K82oVQg2F.W5sbjuOUPsX29P7/IDGV5sgY74RAIx6', 'Admin'),
(8, 'Veronica Matore', 'vrncmtr1', '$2y$10$NmWFwXhmj4hXtaDPr4w..exKkrOtUo9w2aqwmJzp9Ovo0BhcPerkG', 'Admin'),
(9, 'Vincent Barquilla', 'ben10', '$2y$10$OeNX3VsBfKMp1gOoARYyY.v1KzENaytbypJD14RPjBOarF/uXhcsm', 'Admin'),
(10, 'Giordan', 'halohalo', '$2y$10$4Jg2jbJCIB3QlvFlJcYoYe6N6tPTL.dR7c6T5dOFkQpKCi8f5CwQC', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_baptism`
--
ALTER TABLE `tbl_baptism`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_bride`
--
ALTER TABLE `tbl_bride`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_funeral`
--
ALTER TABLE `tbl_funeral`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_groom`
--
ALTER TABLE `tbl_groom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_baptism`
--
ALTER TABLE `tbl_baptism`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_bride`
--
ALTER TABLE `tbl_bride`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_funeral`
--
ALTER TABLE `tbl_funeral`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_groom`
--
ALTER TABLE `tbl_groom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
