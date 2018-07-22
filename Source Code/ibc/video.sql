-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2016 at 04:54 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `video`
--

-- --------------------------------------------------------

--
-- Table structure for table `background`
--

CREATE TABLE `background` (
  `bg_id` int(6) NOT NULL,
  `bg_color` varchar(7) DEFAULT NULL,
  `template_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `background`
--

INSERT INTO `background` (`bg_id`, `bg_color`, `template_id`) VALUES
(1, '#009688', 1),
(2, '#FFFFFF', 2),
(3, '#F44336', 3),
(4, '#FFFFFF', 4),
(5, '#000000', 5),
(6, '#FFFFFF', 6),
(7, '#000000', 7),
(8, '#000000', 8),
(9, '#000000', 9);

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `id` int(6) NOT NULL,
  `ip_address` varchar(20) DEFAULT NULL,
  `ip_name` varchar(200) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `last_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`id`, `ip_address`, `ip_name`, `date_added`, `last_updated`) VALUES
(5, '192.168.0.2', 'IBCPH-PC', '2016-12-12 13:02:05', '2016-12-14 01:26:31'),
(7, '10.0.0.74', 'IBCPH-PC2', '2016-12-16 14:36:51', NULL),
(10, '10.0.0.7', 'IBCPH-PC3', '2016-12-19 16:11:23', NULL),
(11, '10.0.0.52', 'IBCPH-PC4', '2016-12-19 16:28:39', '2016-12-19 16:28:58'),
(12, '10.0.0.6', 'IBCPH-CressaPC', '2016-12-19 16:35:24', NULL),
(13, '192.168.11.3', 'IBC-AteCressa', '2016-12-21 16:50:10', '2016-12-21 16:50:29'),
(14, '$2y$10$9gZup6kUF5ipa', 'Try-Device', '2016-12-24 11:50:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `emergency`
--

CREATE TABLE `emergency` (
  `id` int(6) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `title_color` varchar(7) DEFAULT NULL,
  `message` blob,
  `duration` varchar(5) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emergency`
--

INSERT INTO `emergency` (`id`, `title`, `title_color`, `message`, `duration`, `status`) VALUES
(1, 'Attention!', '#FFFFFF', 0x557769616e206e6161616161616121212121, '7000', 0);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(30) NOT NULL,
  `date_add` datetime DEFAULT NULL,
  `role` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`, `name`, `date_add`, `role`) VALUES
(11, 'ibcphil', '$2y$10$3qQM9A8EwRfJbH4bna.y6u.xEntGElZpYjTYTEC.thrtlBIMM6E96', 'ibc', NULL, 'IBC'),
(12, 'Darren02', '$2y$10$nKCGlt1gehkdH3H4arTjBOJkpBcC3LXcHrahrwuPCw1qWcYj7CwkC', 'Tata', '2016-12-24 11:40:48', 'SUPERADMIN'),
(13, 'Cressa123', '$2y$10$/YmBfGDrUuQcC7na.ohJROcaMB.TEO4px6D1FmAeH04QApRjLpK9i', 'Cressa Tupaz', '2016-12-24 11:41:59', 'ADMIN');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(15) NOT NULL,
  `date_time` datetime DEFAULT NULL,
  `user_name` varchar(200) DEFAULT NULL,
  `action` varchar(200) DEFAULT NULL,
  `section` varchar(200) DEFAULT NULL,
  `old_value` blob,
  `new_value` blob,
  `type` varchar(200) DEFAULT NULL,
  `template_id` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `marquee`
--

CREATE TABLE `marquee` (
  `marquee_id` int(6) NOT NULL,
  `marquee_text` blob,
  `font_type` varchar(100) DEFAULT NULL,
  `font_color` varchar(7) DEFAULT NULL,
  `font_size` int(2) DEFAULT NULL,
  `scroll_speed` int(2) DEFAULT NULL,
  `template_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marquee`
--

INSERT INTO `marquee` (`marquee_id`, `marquee_text`, `font_type`, `font_color`, `font_size`, `scroll_speed`, `template_id`) VALUES
(1, 0x54532031393839204e4f572053484f57494e47, 'Arial', '#FFFFFF', 70, 15, 1),
(2, 0x5461796c6f72205377696674204e6f77, 'Arial', '#F44336', 50, 15, 2),
(3, 0x73616d706c6520746578742073616d706c652074657874, 'Arial', '#9E9E9E', 50, 10, 3),
(4, 0x73616d706c6520746578742073616d706c6520746578742073616d706c652074657874, 'Arial', '#F44336', 80, 30, 4),
(5, '', 'Arial', '#F44336', 80, 30, 5),
(6, 0x54657374207363726f6c6c6572, 'Arial', '#F44336', 50, 15, 6),
(7, NULL, 'Arial', '#FFFFFF', 50, 45, 7),
(8, NULL, 'Arial', '#FFFFFF', 50, 45, 8),
(9, NULL, 'Arial', '#FFFFFF', 50, 45, 9);

-- --------------------------------------------------------

--
-- Table structure for table `mute`
--

CREATE TABLE `mute` (
  `location` varchar(100) DEFAULT NULL,
  `volume` varchar(3) DEFAULT NULL,
  `template_id` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mute`
--

INSERT INTO `mute` (`location`, `volume`, `template_id`) VALUES
('main-ad', '1.0', 1),
('second-top', '0', 1),
('top-left', '0', 6),
('bottom-right', '0.8', 6),
('main-ad', '1.0', 2),
('second-top', '0', 2),
('second-left', '0.8', 3),
('second-right', '0.6', 3),
('main-left', '0.7', 4),
('main-right', '0.1', 4),
('main-left', '1.0', 5),
('main-right', '0', 5),
('main-ad', '1.0', 7),
('main-left', '0', 8);

-- --------------------------------------------------------

--
-- Table structure for table `refresh`
--

CREATE TABLE `refresh` (
  `id` int(1) NOT NULL,
  `refresh` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `refresh`
--

INSERT INTO `refresh` (`id`, `refresh`) VALUES
(1, 1),
(2, 36000);

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

CREATE TABLE `template` (
  `id` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template`
--

INSERT INTO `template` (`id`, `status`) VALUES
(1, 0),
(2, 0),
(3, 0),
(4, 0),
(5, 0),
(6, 0),
(7, 1),
(8, 0),
(9, 0);

-- --------------------------------------------------------

--
-- Table structure for table `upload`
--

CREATE TABLE `upload` (
  `id` int(11) NOT NULL,
  `name` blob NOT NULL,
  `type` varchar(10) NOT NULL,
  `location` varchar(20) NOT NULL,
  `template_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `background`
--
ALTER TABLE `background`
  ADD PRIMARY KEY (`bg_id`);

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emergency`
--
ALTER TABLE `emergency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marquee`
--
ALTER TABLE `marquee`
  ADD PRIMARY KEY (`marquee_id`);

--
-- Indexes for table `refresh`
--
ALTER TABLE `refresh`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template`
--
ALTER TABLE `template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upload`
--
ALTER TABLE `upload`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `background`
--
ALTER TABLE `background`
  MODIFY `bg_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `emergency`
--
ALTER TABLE `emergency`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `marquee`
--
ALTER TABLE `marquee`
  MODIFY `marquee_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `template`
--
ALTER TABLE `template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `upload`
--
ALTER TABLE `upload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
