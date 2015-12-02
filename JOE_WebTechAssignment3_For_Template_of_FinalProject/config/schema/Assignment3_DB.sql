-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2015 at 04:20 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `assignment3`
--
CREATE DATABASE IF NOT EXISTS `assignment3` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `assignment3`;

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `body` text NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=65 ;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `body`, `created`, `modified`, `user_id`) VALUES
(1, 'The title', 'This is the article body.', '2015-10-21 15:24:01', '2015-11-25 16:53:26', 1),
(2, 'A title once again', 'And the article body follows.', '2015-10-21 15:24:01', '2015-11-25 16:53:11', 1),
(3, 'Title strikes back', 'This is really exciting! Not.', '2015-10-21 15:24:01', '2015-11-25 16:52:32', 1),
(58, 'Good Title', 'Good Body Content', '2015-11-21 04:11:34', '2015-11-25 16:53:49', 8),
(63, 'Web Technologies', 'HTML, CSS, JavaScript, JQuery', '2015-11-22 09:39:59', '2015-11-26 01:35:02', 8),
(64, 'Very Good Title', 'Enjoy your life! Be happy!', '2015-11-25 20:01:39', '2015-11-25 20:01:39', 15);

-- --------------------------------------------------------

--
-- Table structure for table `articles_tags`
--

CREATE TABLE IF NOT EXISTS `articles_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `articles_tags`
--

INSERT INTO `articles_tags` (`id`, `article_id`, `tag_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 1),
(4, 2, 3),
(5, 3, 3),
(6, 3, 4),
(35, 58, 3),
(36, 58, 5),
(39, 2, 4),
(44, 63, 3),
(45, 63, 4),
(46, 64, 2),
(47, 64, 3),
(48, 64, 6);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` varchar(20) NOT NULL,
  `article_id` int(11) NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `article_id`, `approved`) VALUES
(1, 'Happy', 1, 1),
(5, 'comment 1', 3, 1),
(8, 'Enjoy!', 1, 0),
(9, 'Good!', 2, 1),
(11, 'comment 2', 3, 1),
(12, 'comment 3', 3, 0),
(19, 'Cool!', 2, 1),
(29, 'my comment', 58, 1),
(32, 'Wow!', 63, 0),
(33, 'Fun!', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `tag`) VALUES
(1, 'Food'),
(2, 'Fun'),
(3, 'Family'),
(4, 'Fiction'),
(5, 'Documentary'),
(6, 'Action');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created`, `modified`) VALUES
(1, 'John', '$2y$10$8/ezWdbTr5Rc8dOYtHzVHOmoH17KjdDqNeBOFLP6SR4Ta6aKsSSoC', 'author', '2015-11-25 19:58:31', '2015-11-25 19:58:31'),
(7, 'admin', '$2y$10$LWi.zFEqDvp01UKsjunb3OLBjf.fou9RGcSK9wg/3wjbz.lCYQ5ky', 'admin', '2015-11-20 19:29:24', '2015-11-20 19:29:24'),
(8, 'Smith', '$2y$10$dt1kR0qmk6L7Q8svxtwTpeJwznVRWSgiLd0bQ./OazuaNel1kEhLW', 'author', '2015-11-25 19:59:33', '2015-11-25 19:59:33'),
(14, 'James', '$2y$10$LaFsCWlVES4.H7mmK/ZKY.1Z.NE/fD.YoDMFxp4VoG.s5l014EEeO', 'author', '2015-11-25 20:00:39', '2015-11-25 20:00:39'),
(15, 'Joe', '$2y$10$kjn/apjyjp5RqQD98onfpuJNs6pw5rNqdxD.kNfWGbvJyv8k4Hgni', 'author', '2015-11-25 20:00:59', '2015-11-25 20:00:59');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
