-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 25, 2022 at 01:20 AM
-- Server version: 10.5.12-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u182278162_1sec`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_current`
--

CREATE TABLE `data_current` (
  `id` int(11) NOT NULL,
  `soil_moisture` int(11) NOT NULL,
  `temprature` int(11) NOT NULL,
  `humidity` int(11) NOT NULL,
  `fertilizer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `thingsspeak`
--

CREATE TABLE `thingsspeak` (
  `id` int(11) NOT NULL,
  `apikey` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `channelid` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `thingsspeak`
--

INSERT INTO `thingsspeak` (`id`, `apikey`, `channelid`) VALUES
(1, '071RIAVKLTQNA7BK', '1954297');

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `id` int(11) NOT NULL,
  `value` varchar(400) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `id` int(11) NOT NULL,
  `token` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tokens`
--

INSERT INTO `tokens` (`id`, `token`) VALUES
(1, '57212ed186a96dd001627f66e007cc75b98711950be12ca3cd12d095ea98f299'),
(2, 'a7d43cadfa551cb6b189c6c87effc38a8db40e7ae2d9829c1aba926386029b7b'),
(3, 'd42644b50e84de0487b66886b469758130cbf707c96bb890ef0263d159f3865f'),
(4, '856b8d40722d0fb50d0404ca5118ed980a3b5445b75134d969fc4eb907054db2'),
(5, 'a86085e091bc80cab3683962b873dbe6d15c82ceb73b6f05560654fc87628715'),
(6, '241f5ca9a0bc0b82c3d69d7add1a94ff9a6e8d8cb7b1a4fbce97415bddd5430a'),
(7, 'd0c147e78acc18f06687109d3566329289a149ea882e11dbece71c934dc86ff1'),
(8, '038d83c98a2aa72c29a2b2b8dac6d4dfef90f6e1af5e572a86b57b9a99a52732'),
(9, '33abd54dbaa981631ad24c7cab1c1c274ee6454df0a425e49b7b47d6de6bf963'),
(10, '35f2a7a47bff0416e69ae5cc8afc6a8ad62a33d16403ef70d10ac270d9235410'),
(11, '0e74bdd88ecb20f082683380ea2d472165b7e53f85114263750609c929e4b960'),
(12, '2b9756507954c7c739ff60c0e8f0510fe06bd097f7755eba9228445318a4bc8e'),
(13, 'ae17c4afd850d478372fcd67779c75b274018e40bf293ea48bd0ec09b9156ce1'),
(14, 'fa228a52e328b8569fbeb511a7612ce0ea7e6600a21dd40bd8c8139a3dc14845'),
(15, '4495b4fbd5d8eafbd531c949353aa2e22ca84aee056282b8cc16b6c695469836'),
(16, 'b834092613456799ac7c887eade72a70d7f79abf767a67f0173921ad556f37b1');

-- --------------------------------------------------------

--
-- Table structure for table `_users`
--

CREATE TABLE `_users` (
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `_users`
--

INSERT INTO `_users` (`username`, `password`, `id`) VALUES
('dev', 'pass', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_current`
--
ALTER TABLE `data_current`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thingsspeak`
--
ALTER TABLE `thingsspeak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `_users`
--
ALTER TABLE `_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_current`
--
ALTER TABLE `data_current`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `thingsspeak`
--
ALTER TABLE `thingsspeak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `token`
--
ALTER TABLE `token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `_users`
--
ALTER TABLE `_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
