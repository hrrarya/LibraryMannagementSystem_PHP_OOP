-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2019 at 06:50 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `f_name` varchar(10) NOT NULL,
  `l_name` varchar(10) NOT NULL,
  `u_name` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `f_name`, `l_name`, `u_name`, `email`, `password`) VALUES
(1, 'Hridoy', 'Arya', 'hrrarya', 'hrrarya@gmail.com', '5a71c8fb7305d1dfc619e50ed5373aa1');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(10) NOT NULL,
  `b_name` varchar(20) NOT NULL,
  `b_img` varchar(255) NOT NULL,
  `b_author` varchar(20) NOT NULL,
  `b_publication` varchar(40) NOT NULL,
  `cat` int(10) NOT NULL,
  `stock` int(10) NOT NULL,
  `postTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `b_name`, `b_img`, `b_author`, `b_publication`, `cat`, `stock`, `postTime`) VALUES
(10, 'Python for all', 'img/Chrysanthemum.jpg', 'Tamim Shahriar Subee', 'Dwimik Publication', 4, 500, '2019-01-20 11:30:18'),
(11, 'PHP code bible', 'img/Desert.jpg', 'pattrick Doe', 'Leo Pulication', 1, 400, '2019-01-20 11:30:57'),
(12, 'Java assential', 'img/Hydrangeas.jpg', 'Nurujjaman Milon', 'Dwimik Publication', 2, 100, '2019-01-20 11:31:39'),
(13, 'Ruby on rails', 'img/Jellyfish.jpg', 'Ruby', 'Ruby', 3, 500, '2019-01-20 11:32:07');

-- --------------------------------------------------------

--
-- Table structure for table `cat`
--

CREATE TABLE `cat` (
  `id` int(11) NOT NULL,
  `c_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cat`
--

INSERT INTO `cat` (`id`, `c_name`) VALUES
(1, 'php'),
(2, 'java'),
(3, 'Ruby'),
(4, 'python'),
(5, 'Dot.net');

-- --------------------------------------------------------

--
-- Table structure for table `issue_book`
--

CREATE TABLE `issue_book` (
  `id` int(11) NOT NULL,
  `b_id` int(10) NOT NULL,
  `u_id` int(10) NOT NULL,
  `issue_date` datetime NOT NULL,
  `status` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `issue_book`
--

INSERT INTO `issue_book` (`id`, `b_id`, `u_id`, `issue_date`, `status`) VALUES
(13, 7, 5, '2018-12-29 11:59:40', ''),
(15, 7, 3, '2018-12-29 12:27:19', '');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `u_id` int(10) NOT NULL,
  `mes` varchar(255) NOT NULL,
  `toAdmin` varchar(3) NOT NULL,
  `status` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `u_id`, `mes`, `toAdmin`, `status`) VALUES
(1, 6, 'Please return the books imediately.', 'no', 'yes'),
(2, 5, 'Please approve my requested book.', 'yes', ''),
(3, 6, 'please back borrowed book.', 'no', 'yes'),
(4, 6, 'please back the book.', 'no', 'yes'),
(5, 6, 'i want to back python book.', 'yes', 'yes'),
(6, 6, 'Plese answer me.', 'yes', 'yes'),
(7, 6, 'please sir.', 'yes', 'yes'),
(8, 6, 'Okay.', 'no', 'yes'),
(9, 6, 'Okay.', 'no', 'yes'),
(10, 6, 'Where?', 'yes', 'yes'),
(11, 6, 'come to the office.', 'no', 'yes'),
(12, 5, 'tell me the book name and id.', 'no', 'no'),
(13, 5, '??', 'no', 'no'),
(14, 6, 'lorem ipsum delor sit ametlorem ipsum delor sit ametlorem ipsum delor sit ametlorem ipsum delor sit ametlorem ipsum delor sit ametlorem ipsum delor sit ametlorem ipsum delor sit ametlorem ipsum delor sit ametlorem ipsum delor sit ametlorem ipsum delor sit', 'no', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `f_name` varchar(20) NOT NULL,
  `l_name` varchar(20) NOT NULL,
  `u_name` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `sem` int(3) NOT NULL,
  `enrollment` varchar(40) NOT NULL,
  `status` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `f_name`, `l_name`, `u_name`, `password`, `email`, `contact`, `sem`, `enrollment`, `status`) VALUES
(5, 'hridy', 'ah', 'hjfsjdhfj', '65b2d8a9f45098217440ee74c929032d', 'jjsjdhfj@gmail.com', '3767', 7, '999', 'no'),
(6, 'Hridoy', 'Arya', 'hrrarya', '5a71c8fb7305d1dfc619e50ed5373aa1', 'hrrarya1@gmail.com', '4444', 6, '000', 'yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cat`
--
ALTER TABLE `cat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issue_book`
--
ALTER TABLE `issue_book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `cat`
--
ALTER TABLE `cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `issue_book`
--
ALTER TABLE `issue_book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
