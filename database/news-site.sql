-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2021 at 07:52 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `news-site`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `post` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `post`) VALUES
(33, 'Sports', 1),
(34, 'Business', 0),
(40, 'Entertainment', 3),
(36, 'Health', 0),
(37, 'Politics', 1),
(41, 'Religion', 0),
(39, 'Science', 0);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `category` int(11) NOT NULL,
  `post_date` varchar(50) NOT NULL,
  `author` int(11) NOT NULL,
  `post_img` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `title`, `description`, `category`, `post_date`, `author`, `post_img`) VALUES
(49, 'post 4', 'Richard Barnett, the Arkansas man charged with breaking into Speaker Nancy Pelosiâ€™s office and stealing her mail during the Jan. 6 riot at the Capitol, threw a tantrum during a virtual court hearing on Thursday, yelling at the judge and his own lawyers that it wasnâ€™t â€œfairâ€ that he was still in jail weeks after his arrest.', 40, '02 Mar, 2021', 25, '603fd79e8f9365.42804104.jpg'),
(42, 'test user', 'Appearing by video from jail, Mr. Barnett erupted into anger after Judge Cooper set the next court date in his case for a day in May, shouting that he did not want to remain behind bars for â€œanother month.â€\r\n\r\nâ€œTheyâ€™re dragging this out!â€ he hollered. â€œTheyâ€™re letting everybody else out!â€\r\n\r\nAfter a brief recess to calm the defendant down, Judge Cooper resumed the hearing, saying he would consider a new motion for release if and when Mr. Barnettâ€™s lawyers filed one.', 37, '24 Feb, 2021', 25, '6036a1fd213990.41472721.jpg'),
(44, 'post 3', 'ongoing â€” and so far unsuccessful â€” effort to be freed on bond, and he loudly lost his patience with the process at an otherwise routine hearing in front of Judge Christopher Cooper of Federal District Court in Washington.\r\n\r\nAppearing by video from jail, Mr. Barnett erupted into anger after Judge Cooper set the next court date in his case for a day in May, shouting that he did not want to remain behind bars for â€œanother month.â€', 40, '25 Feb, 2021', 25, '603756c1346dc9.71841716.jpg'),
(45, 'post 4 edit', 'One of the most recognizable figures from the Capitol assault, Mr. Barnett, 60, was photographed on Jan. 6 with his feet up on a desk in Ms. Pelosiâ€™s office and a cattle-prod-like stun gun dangling from his belt.\r\n\r\nFrom the moment he was taken into custody, he has waged an', 33, '25 Feb, 2021', 28, '603756fd112f71.62709740.jpg'),
(52, 'post 5', 'hyweuewjhejerjerujr\r\ntit7otktyolyly\r\ntitototoyopy8opy8upy8p\r\ntirtot7oytoyoy8opy8psfhethje\r\nretjerjrjrtjrtjrjrjrtjrtttttttttttttttt', 40, '07 Mar, 2021', 25, '6044deb1e34b26.21230039.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `websiteName` varchar(60) NOT NULL,
  `logo` varchar(50) NOT NULL,
  `footerDesc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`websiteName`, `logo`, `footerDesc`) VALUES
('News Website', '6047cfe12d6152.23232946.jpg', 'Copyright by Tanvir Ahmed.');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `role` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `username`, `password`, `role`) VALUES
(25, 'Tanvir', 'Ahmed', 'tanvir', 'e10adc3949ba59abbe56e057f20f883e', 1),
(28, 'Rafik', 'rabby', 'rafik', 'e10adc3949ba59abbe56e057f20f883e', 0),
(29, 'hasan', 'khan', 'hasan', 'e10adc3949ba59abbe56e057f20f883e', 0),
(30, 'shawon', 'ahmed', 'shawon', 'e10adc3949ba59abbe56e057f20f883e', 0),
(31, 'tanvir', 'rahman', 'tanvirrah', 'e10adc3949ba59abbe56e057f20f883e', 0),
(32, 'rupu', 'khan', 'rupu', 'e10adc3949ba59abbe56e057f20f883e', 0),
(33, 'ashik', 'ahmed', 'ashik', 'e10adc3949ba59abbe56e057f20f883e', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`),
  ADD UNIQUE KEY `post_id` (`post_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
