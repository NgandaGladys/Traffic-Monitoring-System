-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2023 at 02:00 AM
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
  `road_name` varchar(200) NOT NULL,
  `location` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `roads`
--

INSERT INTO `roads` (`road_id`, `road_name`, `location`) VALUES
(4, 'Jinja Road', 'Jinja Road Main Station'),
(5, 'Bombo Road', 'Mukono Police Station'),
(6, 'Hoima Road', 'Mukono Police Station'),
(8, 'Entebbe Road', 'Jinja Road Main Station'),
(10, 'Kira Road', 'Jinja Road Main Station'),
(16, 'Gayaza Road', 'Bweyogerere Police Station'),
(17, 'Ggaba Road', 'Bweyogerere Police Station'),
(18, 'Kampala Road', 'Mukono Police Station'),
(19, 'Yusufu Lule Road', 'Bweyogerere Police Station'),
(20, 'Wampewo Road', 'Jinja Road Main Station');

-- --------------------------------------------------------

--
-- Table structure for table `traffic_points`
--

CREATE TABLE `traffic_points` (
  `rid` int(11) NOT NULL,
  `road_id` int(11) NOT NULL,
  `fromm` varchar(100) NOT NULL,
  `too` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `traffic_points`
--

INSERT INTO `traffic_points` (`rid`, `road_id`, `fromm`, `too`, `status`) VALUES
(1, 1, 'jok', 'ijij', 'Clear'),
(2, 2, 'Mapeera', 'Watooto Church', 'Moderate'),
(3, 2, 'Mapeera', 'City Square', 'Jam'),
(4, 4, 'Post Office', 'Internal Affairs', 'Unavailable'),
(5, 4, 'Bank Of Uganda', 'Nakawa', 'Clear'),
(6, 5, 'Wandegeya', 'Bwaise', 'Jam'),
(7, 5, 'Kubiri', 'Bwaise', 'Moderate'),
(8, 6, 'Kampala', 'Nansana', 'Clear'),
(9, 6, 'Nansana', 'Wakiso', 'Unavailable'),
(25, 15, 'Rubis', 'Kira Traffic Lights', 'Moderate'),
(26, 6, 'Wandegeya', 'Kalerwe', 'Moderate');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `location` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `token` varchar(200) NOT NULL,
  `role` varchar(100) NOT NULL,
  `date_registered` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `fullname`, `phone`, `email`, `location`, `password`, `token`, `role`, `date_registered`) VALUES
(6, 'Doreen Asiimwe', '0704487563', 'doreenasiimwe5@gmail.com', 'Jinja Road Main Station', 'e453dbf96ac903773262fbd305fd33af23a99593', '', 'officer', '2023-11-28 10:50:09 AM'),
(14, 'Kenneth Waks', '0784675790', 'wakskenneth@gmail.com', 'Jinja Road Main Station', '2eaab2fbb032b258b58fdaed26b83ca391ddcd0a', '', 'admin', '2023-11-29 18:09:07 PM'),
(21, 'Sarah A', '0773805834', 'tracymuzaki23@gmail.com', 'Mukono Police Station', 'e2d41471b6665e4d8b0085f9f1049c45a9291877', '', 'officer', '2023-11-30 14:29:56 PM'),
(31, 'Flavia N', '0777788888', 'flavia@gmail.com', 'Mukono Police Station', 'a58843087c6951df6f8f931968c6919fa562ff37', '', 'officer', '2023-12-04 16:50:29 PM'),
(32, 'Kenneth Waks', '0784675790', 'wakskenneth1@gmail.com', 'Jinja Road Main Station', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '', 'officer', '2023-12-06 17:07:43 PM'),
(44, 'Tracy Muzaki', '0740909525', 'tracymuzaki12@gmail.com', 'Jinja Road Main Station', '109d63fe5e9366a7d3cb9eb58be233648898444c', '', 'super_admin', '2023-12-11 17:04:19 PM'),
(45, 'Nganda Gladys', '0741395925', 'gladamanda42@gmail.com', 'Mukono Police Station', '291f2c90d146f0bd94e130dd5d8b7b2ac51e561c', '', 'admin', '2023-12-11 17:08:16 PM'),
(46, 'Peruth A', '0777788899', 'peruth@gmail.com', 'Jinja Road Main Station', '7a9aed90b0688c4eb2e3a1b6a7e1fc93418467ec', '', 'user', '2023-12-11 17:10:32 PM'),
(53, 'Annet B', '0775123411', 'annet@gmail.com', 'Mukono Police Station', '6effafa1d5074748533d5cdd618ddd4d3b858174', '', 'user', '2023-12-12 03:16:55 AM'),
(54, 'Kenneth Waks', '0784675790', 'kenneth@gmail.com', 'Jinja Road Main Station', '20eabe5d64b0e216796e834f52d61fd0b70332fc', '', 'officer', '2023-12-13 15:32:20 PM'),
(55, 'winnie', '0777788888', 'admin@gmail.com', 'Bweyogerere Police Station', '35a232cb688dfcbe8d456f72c8441dd4ff51ea4d', '', 'admin', '2023-12-15 03:33:25 AM');

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
-- Indexes for table `traffic_points`
--
ALTER TABLE `traffic_points`
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
  MODIFY `road_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `traffic_points`
--
ALTER TABLE `traffic_points`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
