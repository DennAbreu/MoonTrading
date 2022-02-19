-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2022 at 07:25 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cisc4900`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `bankUsername` varchar(128) NOT NULL,
  `bankTotal` decimal(15,4) NOT NULL,
  `bankInv` decimal(15,4) NOT NULL,
  `bankAvail` decimal(15,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`bankUsername`, `bankTotal`, `bankInv`, `bankAvail`) VALUES
('DennisAbreu', '2000.0000', '563.8110', '1096.0890');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `stocksUsername` varchar(128) NOT NULL,
  `stocksSymbol` varchar(128) NOT NULL,
  `stocksShares` int(255) NOT NULL,
  `stocksInv` decimal(15,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`stocksUsername`, `stocksSymbol`, `stocksShares`, `stocksInv`) VALUES
('DennisAbreu', 'ACST', 100, '47.1800'),
('DennisAbreu', 'AMC', 24, '429.6000'),
('DennisAbreu', 'FOSL', 10, '122.5000'),
('DennisAbreu', 'MARA', 5, '156.6500'),
('DennisAbreu', 'SHMP', 10, '5.6810'),
('DennisAbreu', 'VOR', 5, '142.3000');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `usersId` int(11) NOT NULL,
  `usersUsername` varchar(128) NOT NULL,
  `usersName` varchar(128) NOT NULL,
  `usersEmail` varchar(128) NOT NULL,
  `usersPassword` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`usersId`, `usersUsername`, `usersName`, `usersEmail`, `usersPassword`) VALUES
(41, 'DennisAbreu', 'Dennis', 'DennisAbreu@gmail.com', '$2y$10$E73Nu7/slarNunKOuhmpa.Nhpzh.Y.7u6qt.S0vceJ4yL0.iIWx4u');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`bankUsername`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`stocksUsername`,`stocksSymbol`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usersId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `usersId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
