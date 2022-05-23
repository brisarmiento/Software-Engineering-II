-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2022 at 05:04 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `menderm1_MSU_Banking_App`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `acc_number` int(255) NOT NULL,
  `cust_id` int(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `balance` decimal(18,2) NOT NULL DEFAULT 0.00,
  `pending` decimal(18,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`acc_number`, `cust_id`, `type`, `balance`, `pending`) VALUES
(14349309, 1886976572, 'Checkings', '878000.00', '0.00'),
(21244713, 1886976572, 'Savings', '23298.59', '0.00'),
(80185985, 1886976572, 'Checkings', '0.00', '0.00');


--
-- Table structure for table `acc_request`
--

CREATE TABLE `acc_request` (
  `ID` int(50) NOT NULL,
  `acc_type` varchar(255) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acc_request`
--

INSERT INTO `acc_request` (`ID`, `acc_type`, `username`, `password`, `email`, `fname`, `lname`, `address`) VALUES
(957270, 'Savings', 'csmith', '$2y$10$zOEtlteynruQJotEyKeUreCW4v4vYm.I1gq.zFuxejTl1Aob.Jc5O', 'csmith@montclair.edu', 'Chris', 'Smith', '123 test, IA 72633'),
(957271, 'Savings', 'wrock', '$2y$10$oPjcCgFvSFOG3evRJqQSMOKl03l.ihtsKlLrDRLFgYyq7p.MfJeZ2', 'test@ddsmai.com', 'Will', 'Rock', 'dsdadassd Test Town, AL 13231'),
(957272, 'Savings', 'test', '$2y$10$H568DSUJ6n/U8KkHtNYlueT2u2hbwLuQ69biLS5QEZdPiq7DbcBLK', 'q@dsa.com', 'q', 'q', 'q q, AL 12313');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `username`, `password`) VALUES
(1, 'mmendero', 'g6banking');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `ID` int(50) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`ID`, `username`, `password`, `email`, `fname`, `lname`, `address`) VALUES
(1886976572, 'mmendero', '$2y$10$0zswSoqNgzPcaIPLxR3/MePsaLS3nFg9qkj/ZIx6Xu8cJKASET8wS', 'matthewmendero@gmail.com', 'Matthew', 'Mendero', '136');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `ID` int(50) NOT NULL,
  `acc_number` int(50) NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `recipient_name` varchar(100) NOT NULL,
  `recipient_acc` int(50) NOT NULL,
  `amount` decimal(18,2) NOT NULL,
  `balance` decimal(18,2) NOT NULL,
  `date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`ID`, `acc_number`, `type`, `name`, `recipient_name`, `recipient_acc`, `amount`, `balance`, `date`) VALUES
(73, 14349309, 'Deposit', 'Birthday', 'Matthew', 14349309, '1000000.00', '1000000.00', '2022-04-11 10:57:16am'),
(74, 14349309, 'Withdraw', 'Tuition', 'Matthew', 14349309, '100000.00', '900000.00', '2022-04-11 10:57:28am'),
(75, 14349309, 'Withdraw', 'Food', 'Matthew', 14349309, '20000.00', '880000.00', '2022-04-11 10:57:46am'),
(76, 14349309, 'Withdraw', 'Taxes', 'Matthew', 14349309, '2000.00', '878000.00', '2022-04-11 10:57:54am'),
(77, 21244713, 'Deposit', 'Paycheck', 'Matthew', 21244713, '23322.00', '23322.00', '2022-04-11 11:02:55am'),
(78, 21244713, 'Withdraw', 'Food', 'Matthew', 21244713, '23.41', '23298.59', '2022-04-11 11:03:09am');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`acc_number`);

--
-- Indexes for table `acc_request`
--
ALTER TABLE `acc_request`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `cUsername` (`username`),
  ADD UNIQUE KEY `cEmail` (`email`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `cUsername` (`username`),
  ADD UNIQUE KEY `cEmail` (`email`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `acc_number` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98635841;

--
-- AUTO_INCREMENT for table `acc_request`
--
ALTER TABLE `acc_request`
  MODIFY `ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=957275;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1886976573;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- User Priveledges --
-- GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, DROP, FILE, INDEX, ALTER, CREATE TEMPORARY TABLES, EXECUTE, CREATE VIEW, SHOW VIEW, CREATE ROUTINE, ALTER ROUTINE, EVENT, TRIGGER ON *.* TO `G6_admin`@`localhost` IDENTIFIED BY PASSWORD '*C285157A2629417E8D3ABE8323336295368ECB63';
-- GRANT ALL PRIVILEGES ON `group6_banking`.* TO `G6_admin`@`localhost`;
