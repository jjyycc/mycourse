-- phpMyAdmin SQL Dump
-- version 3.2.5
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2017 �?11 �?02 �?00:36
-- 服务器版本: 5.5.57
-- PHP 版本: 5.6.30

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `csdb`
--

-- --------------------------------------------------------

--
-- 表的结构 `classinfo`
--

CREATE TABLE IF NOT EXISTS `classinfo` (
  `id` varchar(40) NOT NULL,
  `cid` varchar(20) DEFAULT NULL,
  `title` varchar(20) DEFAULT NULL,
  `startdate` date DEFAULT NULL,
  `description` varchar(256) DEFAULT NULL,
  `teaid` varchar(40) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `courseBH` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_cid_ClassInfo` (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `classinfo`
--


-- --------------------------------------------------------

--
-- 表的结构 `courseinfo`
--

CREATE TABLE IF NOT EXISTS `courseinfo` (
  `id` varchar(40) NOT NULL,
  `bh` varchar(20) DEFAULT NULL,
  `mc` varchar(20) DEFAULT NULL,
  `kss` int(11) DEFAULT NULL,
  `kcjs` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_bh_courseInfo` (`bh`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `courseinfo`
--

INSERT INTO `courseinfo` (`id`, `bh`, `mc`, `kss`, `kcjs`) VALUES
('b5a27c71-bb12-11e7-ab88-083e8ee3a602', '002', 'The Computer Techled', 48, 'none'),
('c1b59d8e-b929-11e7-9c6a-083e8ee3a602', '001', 'C# 语言程序设计', 48, 'C# 语言是基于微软.Net 框架下进行信息化系统开发的高效开发语言，值得学习！');

-- --------------------------------------------------------

--
-- 表的结构 `stu2class`
--

CREATE TABLE IF NOT EXISTS `stu2class` (
  `id` varchar(40) NOT NULL,
  `stuId` varchar(40) NOT NULL,
  `clsId` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `stu2class`
--


-- --------------------------------------------------------

--
-- 表的结构 `studentexinfo`
--

CREATE TABLE IF NOT EXISTS `studentexinfo` (
  `id` varchar(40) NOT NULL,
  `xh` varchar(20) DEFAULT NULL,
  `Mobile` varchar(20) DEFAULT NULL,
  `qq` varchar(128) DEFAULT NULL,
  `weixin` varchar(128) DEFAULT NULL,
  `Description` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_xh_stdEx` (`xh`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `studentexinfo`
--


-- --------------------------------------------------------

--
-- 表的结构 `studentinfo`
--

CREATE TABLE IF NOT EXISTS `studentinfo` (
  `id` varchar(40) NOT NULL,
  `xh` varchar(20) DEFAULT NULL,
  `bj` varchar(128) DEFAULT NULL,
  `zy` varchar(128) DEFAULT NULL,
  `xy` varchar(50) DEFAULT NULL,
  `xb` varchar(2) DEFAULT NULL,
  `xm` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_xh` (`xh`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `studentinfo`
--

INSERT INTO `studentinfo` (`id`, `xh`, `bj`, `zy`, `xy`, `xb`, `xm`) VALUES
('2dd123ba-bd1a-11e7-925a-083e8ee3a602', '100002', NULL, '计算机科学', '计算机科学与技术学院', '男', '测试学生1'),
('6f394bb3-bd1a-11e7-925a-083e8ee3a602', '100003', '计科1班', '计算机科学', '计算机科学与技术学院', '男', '测试学生3'),
('fbba7903-bd19-11e7-925a-083e8ee3a602', '100001', NULL, '计算机科学', '计算机科学与技术学院', '男', '测试学生');

-- --------------------------------------------------------

--
-- 表的结构 `teacherinfo`
--

CREATE TABLE IF NOT EXISTS `teacherinfo` (
  `id` varchar(40) NOT NULL,
  `gh` varchar(20) DEFAULT NULL,
  `xm` varchar(20) DEFAULT NULL,
  `zc` varchar(20) DEFAULT NULL,
  `js` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_gh_teacherInfo` (`gh`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `teacherinfo`
--

INSERT INTO `teacherinfo` (`id`, `gh`, `xm`, `zc`, `js`) VALUES
('12710db9-bd14-11e7-925a-083e8ee3a602', '008', '测试教师', '讲师', NULL),
('ce642473-bd14-11e7-925a-083e8ee3a602', '007', '测试教师', '讲师', NULL),
('dbd938fc-b896-11e7-bd45-083e8ee3a602', '20064746', '章杰', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `userinfo`
--

CREATE TABLE IF NOT EXISTS `userinfo` (
  `id` varchar(40) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `pw` varchar(20) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `pid` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_username_userInfo` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `userinfo`
--

INSERT INTO `userinfo` (`id`, `username`, `pw`, `role`, `pid`) VALUES
('54c1c4fc-bd1e-11e7-925a-083e8ee3a602', 'admin', 'admin', 'admin', NULL),
('559ed84c-bd2f-11e7-aafe-083e8ee3a602', 'cs1', '111111', 'student', '6f394bb3-bd1a-11e7-925a-083e8ee3a602'),
('64c85f1e-bd21-11e7-925a-083e8ee3a602', 'manager1', '111111', 'admin', NULL),
('a83d2acb-bd21-11e7-925a-083e8ee3a602', 'manager2', '111111', 'admin', NULL);
