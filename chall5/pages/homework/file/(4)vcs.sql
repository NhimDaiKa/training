-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2022 at 06:55 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vcs`
--

-- --------------------------------------------------------

--
-- Table structure for table `hws`
--

CREATE TABLE `hws` (
  `hid` int(11) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `pid` int(11) NOT NULL,
  `user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `hwt`
--

CREATE TABLE `hwt` (
  `hid` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `pid` int(11) NOT NULL,
  `user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `mid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `send` varchar(255) NOT NULL,
  `sava` varchar(255) DEFAULT NULL,
  `rid` int(11) NOT NULL,
  `receive` varchar(255) NOT NULL,
  `rava` varchar(255) DEFAULT NULL,
  `mess` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`mid`, `sid`, `send`, `sava`, `rid`, `receive`, `rava`, `mess`) VALUES
(9, 2, 'stu1', '280301341_1806448113020043_8173389599074428960_n.jpg', 3, 'stu2', NULL, 'helo'),
(17, 2, 'stu1', '280301341_1806448113020043_8173389599074428960_n.jpg', 3, 'stu2', '', 'abc'),
(18, 3, 'stu2', '', 2, 'stu1', '280301341_1806448113020043_8173389599074428960_n.jpg', 'hihi'),
(19, 2, 'stu1', '280301341_1806448113020043_8173389599074428960_n.jpg', 3, 'stu2', '', 'cuoi cl');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `pid` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `role` int(11) NOT NULL,
  `avatar` text DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `sdt` varchar(50) DEFAULT NULL,
  `bio` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`pid`, `user`, `pass`, `name`, `role`, `avatar`, `email`, `sdt`, `bio`) VALUES
(1, 'teacher', 'teacher', 'teacher', 1, NULL, 'teacher@gmail.com', '123456789', NULL),
(2, 'stu1', 'alo', 'stu1', 0, '280301341_1806448113020043_8173389599074428960_n.jpg', 'nin@gmail.com', '0969204163', 'hello, i\'m ninh'),
(3, 'stu2', 'stu2', 'stu2', 0, NULL, 'stu2@gmail.com', '123456789', NULL),
(4, 'stu3', 'stu3', 'stu3', 0, NULL, 'stu3@gmail.com', '123456789', NULL),
(5, 'stu4', 'stu4', 'stu4', 0, NULL, 'stu4@gmail.com', '123456789', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hws`
--
ALTER TABLE `hws`
  ADD PRIMARY KEY (`hid`);

--
-- Indexes for table `hwt`
--
ALTER TABLE `hwt`
  ADD PRIMARY KEY (`hid`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`mid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`pid`,`user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hwt`
--
ALTER TABLE `hwt`
  MODIFY `hid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `mid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
