-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2014-09-10 03:58:26
-- 服务器版本： 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `webqq`
--

-- --------------------------------------------------------

--
-- 表的结构 `friendsinfo`
--

CREATE TABLE IF NOT EXISTS `friendsinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `friendid` int(11) NOT NULL,
  `friendNoteName` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `friendsinfo`
--

INSERT INTO `friendsinfo` (`id`, `userid`, `friendid`, `friendNoteName`) VALUES
(1, 1, 2, '阿汤哥'),
(2, 1, 3, '女神'),
(3, 1, 4, '皮帅哥'),
(4, 2, 1, 'Jim'),
(5, 2, 3, '苏大妈');

-- --------------------------------------------------------

--
-- 表的结构 `userinfo`
--

CREATE TABLE IF NOT EXISTS `userinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userpwd` varchar(20) NOT NULL,
  `userNickname` varchar(20) NOT NULL,
  `userHeadImage` varchar(300) NOT NULL,
  `userState` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `userinfo`
--

INSERT INTO `userinfo` (`id`, `userpwd`, `userNickname`, `userHeadImage`, `userState`) VALUES
(1, '123', 'Jim Green', 'headimages/4.jpg', 'offline'),
(2, '123', 'Tom Cruise', 'headimages/14.jpg', 'offline'),
(3, '123', 'Sophie Marceau', 'headimages/15.jpg', 'offline'),
(4, '123', 'Brad Pitt', 'headimages/25.jpg', 'offline');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
