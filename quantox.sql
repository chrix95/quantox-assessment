-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 21, 2021 at 12:38 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quantox`
--

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

DROP TABLE IF EXISTS `grades`;
CREATE TABLE IF NOT EXISTS `grades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(191) NOT NULL,
  `grade` int(191) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `user_id`, `grade`) VALUES
(1, 1, 9),
(2, 2, 9),
(3, 3, 2),
(4, 4, 1),
(5, 1, 7),
(6, 1, 9),
(7, 1, 4),
(8, 2, 3),
(9, 2, 9),
(10, 2, 2),
(11, 3, 4),
(12, 3, 1),
(13, 3, 4),
(14, 4, 9),
(15, 9, 9);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `student_id` int(191) NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `board` enum('csm','csmb') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`student_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `name`, `board`, `created_at`) VALUES
(1, 'Christopher Okokon Ntuk', 'csm', '2021-07-21 09:38:47'),
(2, 'Ehisogie Ibrahim', 'csmb', '2021-07-21 09:38:47'),
(3, 'David Okokon Ntuk', 'csm', '2021-07-21 09:39:54'),
(4, 'Ehisogie Ibrahim', 'csmb', '2021-07-21 09:39:54');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
