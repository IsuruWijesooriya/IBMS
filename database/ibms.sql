-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2024 at 03:00 PM
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
-- Database: `ibms`
--

-- --------------------------------------------------------

--
-- Table structure for table `msg`
--

CREATE TABLE `msg` (
  `id` int(50) NOT NULL,
  `sender` varchar(100) NOT NULL,
  `reciever` varchar(100) NOT NULL,
  `msg` varchar(2500) NOT NULL,
  `transmission` int(50) NOT NULL,
  `tic` int(50) NOT NULL DEFAULT 0,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `msg`
--

INSERT INTO `msg` (`id`, `sender`, `reciever`, `msg`, `transmission`, `tic`, `datetime`) VALUES
(16, 'Admin Editor', 'Employee User', 'hi', 0, 1, '2024-01-04 10:14:49'),
(17, 'Admin Editor', 'Employee User', 'how are you', 0, 1, '2024-01-04 10:14:57'),
(18, 'Admin Editor', 'Rasini Sehani', 'hello', 0, 1, '2024-01-04 10:15:05'),
(19, 'Admin Editor', 'Rasini Sehani', 'how is the project', 0, 1, '2024-01-04 10:15:15'),
(20, 'Employee User', 'Admin Editor', 'Hi', 0, 1, '2024-01-04 10:58:57'),
(21, 'Employee User', 'Admin Editor', 'How Are you?', 0, 1, '2024-01-04 10:59:08'),
(22, 'Admin Editor', 'Employee User', 'Fine', 0, 1, '2024-01-08 19:16:31'),
(23, 'Admin Editor', 'Employee User', 'nice work', 0, 1, '2024-01-08 19:20:32'),
(24, 'Employee User', 'Admin Editor', 'I have Done project', 0, 1, '2024-01-08 19:34:08'),
(25, 'Employee User', 'Admin Editor', 'ok', 0, 1, '2024-01-08 19:37:27'),
(26, 'Admin Editor', 'Employee User', 'ok', 0, 1, '2024-01-08 19:37:52'),
(27, 'Admin Editor', 'Employee User', '1', 0, 1, '2024-01-08 20:39:30'),
(28, 'Admin Editor', 'Employee User', 'nice', 0, 1, '2024-01-08 22:28:08'),
(29, 'Admin Editor', 'Employee User', 'hi', 0, 1, '2024-01-08 22:34:46'),
(30, 'Admin Editor', 'Employee User', 'Project completed', 0, 1, '2024-01-08 22:35:31'),
(31, 'Admin Editor', 'Employee User', 'ok', 0, 1, '2024-01-08 22:35:57'),
(32, 'Admin Editor', 'Employee User', 'ok', 0, 1, '2024-01-08 22:36:46'),
(33, 'Admin Editor', 'Employee User', 'ok', 0, 1, '2024-01-08 22:37:52'),
(34, 'Admin Editor', 'Employee User', 'ok', 0, 1, '2024-01-08 22:38:13'),
(35, 'Admin Editor', 'Employee User', 'what?', 0, 1, '2024-01-08 22:38:43'),
(36, 'Admin Editor', 'Rasini Sehani', 'ok?', 0, 1, '2024-01-08 22:48:28'),
(37, 'Admin Editor', 'Employee User', 'ok', 0, 1, '2024-01-08 22:55:06'),
(38, 'Admin Editor', 'Rasini Sehani', 'ooo', 0, 1, '2024-01-08 22:55:15'),
(39, 'Admin Editor', 'Rasini Sehani', '1', 0, 1, '2024-01-08 22:56:13'),
(40, 'Admin Editor', 'Employee User', '222', 0, 1, '2024-01-08 22:56:22'),
(41, 'Admin Editor', 'Rasini Sehani', '1111', 0, 1, '2024-01-08 22:56:57'),
(42, 'Admin Editor', 'Employee User', 'ok', 0, 1, '2024-01-08 22:57:07'),
(43, 'Admin Editor', 'Rasini Sehani', 'as', 0, 1, '2024-01-08 22:58:25'),
(44, 'Admin Editor', 'Employee User', 'aa', 0, 1, '2024-01-08 22:58:45'),
(45, 'Admin Editor', 'Rasini Sehani', '111111', 0, 1, '2024-01-08 22:59:20'),
(46, 'Employee User', 'Admin Editor', 'ok', 0, 1, '2024-01-08 23:07:40'),
(47, 'Employee User', 'Admin Editor', 'i am done', 0, 1, '2024-01-08 23:07:50'),
(48, 'Rasini Sehani', 'Admin Editor', 'hi', 0, 0, '2024-01-08 23:16:20'),
(49, 'Rasini Sehani', 'Admin Editor', 'ok', 0, 0, '2024-01-08 23:16:25'),
(50, 'Rasini Sehani', 'Admin Editor', 'Here is the code for the advance research for the customers. please check itt and send me a details about it. And also i wanr a feedback for it.', 0, 0, '2024-01-08 23:24:31'),
(51, 'Employee User', 'Admin Editor', 'hello', 0, 1, '2024-01-08 23:30:34'),
(52, 'Employee User', 'Admin Editor', 'is projet is overr', 0, 1, '2024-01-08 23:30:57'),
(53, 'Rasini Sehani', 'Admin Editor', 'hi', 0, 0, '2024-01-08 23:31:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `privilege` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `fullname`, `email`, `dob`, `username`, `password`, `address`, `privilege`) VALUES
('2', 'Admin', 'Editor', 'Admin Editor', '123@gmail.com', '2023-11-28', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', '111,colombo', 1),
('3', 'Employee', 'User', 'Employee User', '123@gmail.com', '2023-11-28', 'user', '12dea96fec20593566ab75692c9949596833adc9', '111,colombo', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `msg`
--
ALTER TABLE `msg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `msg`
--
ALTER TABLE `msg`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
