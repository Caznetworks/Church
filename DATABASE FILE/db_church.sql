-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2023 at 03:41 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

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
  `Address` varchar(255) NOT NULL,
  `Godmother` varchar(255) NOT NULL,
  `Godfather` varchar(255) NOT NULL,
  `Baptism` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_baptism`
--

INSERT INTO `tbl_baptism` (`id`, `Candidate`, `Birth`, `Place`, `Father`, `Mother`, `Address`, `Godmother`, `Godfather`, `Baptism`) VALUES
(1, 'Jaymarl', '2022-12-22', 'Japan', 'Arturo', 'Maria', 'Japan', 'Doraemon', 'Nobita', '2023-05-14'),
(2, 'Giordan Benamir', '2003-01-26', 'Circle Circle, Tanauan', 'Renato Benamir', 'Elsa Benamir', 'Circle Circle, Tanauan', 'Jaymarl Mondido', 'Jorish Ann Migo', '2023-06-04');

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
  `mother` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `mass` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_funeral`
--

INSERT INTO `tbl_funeral` (`id`, `lastname`, `firstname`, `birth`, `death`, `age`, `spouse`, `name_of_kin`, `relationship_to_deceased`, `number`, `mass`) VALUES
(1, 'asdfasdf', 'asdfasdfasdf', '1999-09-18', '2023-05-03', 23, 'asdfasdf', 'asddfasfda', 'asdfasfa', 12312312312, '2023-05-21');

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
(2, 'Veronica Matore', 'vrncmtr', '2f0a9324e7098cdae19af7de97690327', 'Admin'),
(3, 'vero', 'vero5', '7b6e2b9ce94e0df714e842041ea8c76f', 'User'),
(4, 'Giordan Benamir', 'kapenamir', '1059c5ae65326e7f02ba9a9552889c6a', 'Admin');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_bride`
--
ALTER TABLE `tbl_bride`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_funeral`
--
ALTER TABLE `tbl_funeral`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_groom`
--
ALTER TABLE `tbl_groom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
