-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2023 at 08:44 PM
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
-- Database: `tms`
--

-- --------------------------------------------------------

--
-- Table structure for table `roads`
--

CREATE TABLE `roads` (
  `road_id` int(11) NOT NULL,
  `road_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `roads`
--

INSERT INTO `roads` (`road_id`, `road_name`) VALUES
(4, 'Jinja Road'),
(5, 'Bombo Road'),
(6, 'Hoima Road'),
(8, 'Kampala Road');

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `rid` int(11) NOT NULL,
  `road_id` int(11) NOT NULL,
  `fromm` varchar(100) NOT NULL,
  `too` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`rid`, `road_id`, `fromm`, `too`, `status`) VALUES
(1, 1, 'jok', 'ijij', 'Clear'),
(2, 2, 'Mapeera', 'Watooto Church', 'Moderate'),
(3, 2, 'Mapeera', 'City Square', 'Jam'),
(4, 4, 'Post Office', 'Internal Affairs', 'Unavailable'),
(5, 4, 'Bank Of Uganda', 'Nakawa', 'Clear'),
(6, 5, 'Wandegeya', 'Bwaise', 'Jam'),
(7, 5, 'Kubiri', 'Bwaise', 'Moderate'),
(8, 6, 'Kampala', 'Nansana', 'Clear'),
(9, 6, 'Nansana', 'Wakiso', 'Unavailable');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `token` varchar(200) NOT NULL,
  `role` varchar(100) NOT NULL,
  `date_registered` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `fullname`, `phone`, `email`, `password`, `token`, `role`, `date_registered`) VALUES
(5, 'Tracy Muzaki', '0740909525', 'tracymuzaki12@gmail.com', '109d63fe5e9366a7d3cb9eb58be233648898444c', '', 'super_admin', '2023-10-15 19:05:42 PM'),
(6, 'Doreen A', '0704487563', 'doreenasiimwe5@gmail.com', 'e453dbf96ac903773262fbd305fd33af23a99593', '', 'user', '2023-11-28 10:50:09 AM'),
(13, 'Sarah A', '0773805834', 'tracymuzaki23@gmail.com', '9447c4dbc86c3bb33129986f9ad1a669bfd7e8ea', '', 'officer', '2023-11-29 17:46:16 PM'),
(14, 'Kenneth Waks', '0784675790', 'wakskenneth@gmail.com', '2eaab2fbb032b258b58fdaed26b83ca391ddcd0a', '', 'admin', '2023-11-29 18:09:07 PM'),
(15, 'Nganda Gladys', '0741395925', 'gladamanda42@gmail.com', '291f2c90d146f0bd94e130dd5d8b7b2ac51e561c', '', 'admin', '2023-11-29 18:12:04 PM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `roads`
--
ALTER TABLE `roads`
  ADD PRIMARY KEY (`road_id`),
  ADD KEY `road_id` (`road_id`,`road_name`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`rid`),
  ADD KEY `rid` (`rid`,`road_id`,`fromm`,`too`,`status`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`),
  ADD KEY `userid` (`userid`,`fullname`,`phone`,`email`,`password`,`role`,`date_registered`),
  ADD KEY `userid_2` (`userid`,`fullname`,`phone`,`email`,`password`,`token`,`role`,`date_registered`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `roads`
--
ALTER TABLE `roads`
  MODIFY `road_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
