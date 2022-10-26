-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2022 at 09:19 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

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
-- Table structure for table `chall`
--

CREATE TABLE `chall` (
  `cid` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `hint` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chall`
--

INSERT INTO `chall` (`cid`, `file`, `name`, `hint`, `date`) VALUES
(2, 'doan cl.txt', 'first', 'đoán xem', '2022-10-26'),
(3, 'khong doan.txt', 'second', 'đoán tiếp đi', '2022-10-26');

-- --------------------------------------------------------

--
-- Table structure for table `hws`
--

CREATE TABLE `hws` (
  `hid` int(11) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `pid` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `prj_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hws`
--

INSERT INTO `hws` (`hid`, `file`, `date`, `pid`, `user`, `prj_id`) VALUES
(1, '(1)D20G03N03.pdf', '2022-10-25 23:13:55', 2, 'stu1', 2),
(3, '(1)BTL.docx', '2022-10-25 23:28:48', 2, 'stu1', 2),
(6, 'dataD20.txt', '2022-10-25 23:31:49', 2, 'stu1', 1),
(8, '(2)dataD20.txt', '2022-10-25 23:32:31', 2, 'stu1', 1),
(9, 'Trick.docx', '2022-10-25 23:32:44', 2, 'stu1', 1),
(11, '(1)Trick.docx', '2022-10-25 23:33:04', 2, 'stu1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hwt`
--

CREATE TABLE `hwt` (
  `hid` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hwt`
--

INSERT INTO `hwt` (`hid`, `name`, `file`, `date`) VALUES
(1, 'Nin', '(6)vcs.sql', '2022-10-25 21:38:57'),
(2, 'Nin', '(7)vcs.sql', '2022-10-25 21:39:08');

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
(19, 2, 'stu1', '280301341_1806448113020043_8173389599074428960_n.jpg', 3, 'stu2', '', 'cuoi cl'),
(20, 2, 'stu1', '280301341_1806448113020043_8173389599074428960_n.jpg', 3, 'stu2', '', 'alo123');

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
-- Indexes for table `chall`
--
ALTER TABLE `chall`
  ADD PRIMARY KEY (`cid`);

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
-- AUTO_INCREMENT for table `chall`
--
ALTER TABLE `chall`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hws`
--
ALTER TABLE `hws`
  MODIFY `hid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `hwt`
--
ALTER TABLE `hwt`
  MODIFY `hid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
