-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 21, 2012 at 10:20 PM
-- Server version: 5.0.90-log
-- PHP Version: 5.3.2-pl0-gentoo

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `scc_finance`
--

-- --------------------------------------------------------

--
-- Table structure for table `2011_Admin`
--

CREATE TABLE IF NOT EXISTS `2011_Admin` (
  `Admin_Username` varchar(10) NOT NULL,
  UNIQUE KEY `Admin_Username` (`Admin_Username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `2011_Attendance`
--

CREATE TABLE IF NOT EXISTS `2011_Attendance` (
  `Attendance_ID` int(11) NOT NULL auto_increment,
  `Event_ID` int(11) NOT NULL,
  `Username` varchar(10) NOT NULL,
  PRIMARY KEY  (`Attendance_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4056 ;

-- --------------------------------------------------------

--
-- Table structure for table `2011_Banners`
--

CREATE TABLE IF NOT EXISTS `2011_Banners` (
  `Banner_ID` int(11) NOT NULL auto_increment,
  `Banner_Name` varchar(30) NOT NULL,
  `Banner_Address` varchar(50) NOT NULL,
  PRIMARY KEY  (`Banner_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `2011_Interests`
--

CREATE TABLE IF NOT EXISTS `2011_Interests` (
  `Interest_ID` int(11) NOT NULL auto_increment,
  `InterestName` text NOT NULL,
  PRIMARY KEY  (`Interest_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Table structure for table `2011_Mail`
--

CREATE TABLE IF NOT EXISTS `2011_Mail` (
  `ID` int(11) NOT NULL auto_increment,
  `body` longtext NOT NULL,
  `category` varchar(30) NOT NULL,
  `department` varchar(30) NOT NULL,
  `upcomingevents` varchar(60) NOT NULL,
  `subject` text,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `2011_management`
--

CREATE TABLE IF NOT EXISTS `2011_management` (
  `ID` int(11) NOT NULL auto_increment,
  `name` varchar(500) NOT NULL,
  `position` varchar(500) NOT NULL,
  `degree` varchar(500) NOT NULL,
  `blurb` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- Table structure for table `2011_Members`
--

CREATE TABLE IF NOT EXISTS `2011_Members` (
  `Username` tinytext NOT NULL,
  `Mobile` varchar(15) NOT NULL,
  `Interests` varchar(20) NOT NULL,
  `Dept` varchar(30) default NULL,
  `Forename` tinytext NOT NULL,
  `Surname` tinytext NOT NULL,
  `Department` tinytext NOT NULL,
  `Email` tinytext NOT NULL,
  `Reg_time` datetime NOT NULL,
  `Reg_method` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `2012_management`
--

CREATE TABLE IF NOT EXISTS `2012_management` (
  `ID` int(11) NOT NULL auto_increment,
  `name` varchar(500) NOT NULL,
  `position` varchar(500) NOT NULL,
  `degree` varchar(500) NOT NULL,
  `blurb` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- Table structure for table `asia`
--

CREATE TABLE IF NOT EXISTS `asia` (
  `ID` int(11) NOT NULL,
  `title` varchar(500) NOT NULL,
  `body` text NOT NULL,
  `event` int(11) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `ID` int(11) NOT NULL auto_increment,
  `title` varchar(500) NOT NULL,
  `date` date NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL,
  `location` varchar(500) NOT NULL,
  `organisers` varchar(500) NOT NULL,
  `information` text NOT NULL,
  `Interests` varchar(30) NOT NULL,
  `Open` varchar(9) NOT NULL,
  `Sponsor` tinyint(2) default NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=144 ;

-- --------------------------------------------------------

--
-- Table structure for table `hk`
--

CREATE TABLE IF NOT EXISTS `hk` (
  `Username` tinytext NOT NULL,
  `Reg_time` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `homepage`
--

CREATE TABLE IF NOT EXISTS `homepage` (
  `ID` int(11) NOT NULL,
  `title` varchar(500) NOT NULL,
  `body` text NOT NULL,
  `event` int(11) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `learning`
--

CREATE TABLE IF NOT EXISTS `learning` (
  `ID` int(11) NOT NULL auto_increment,
  `section` int(11) NOT NULL,
  `Title` varchar(500) NOT NULL,
  `filename` varchar(500) NOT NULL,
  `filetype` varchar(500) NOT NULL,
  `filesize` int(11) NOT NULL,
  `content` mediumblob NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `learning_sections`
--

CREATE TABLE IF NOT EXISTS `learning_sections` (
  `ID` int(11) NOT NULL auto_increment,
  `title` varchar(500) NOT NULL,
  `intro` text NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `management`
--

CREATE TABLE IF NOT EXISTS `management` (
  `ID` int(11) NOT NULL auto_increment,
  `name` varchar(500) NOT NULL,
  `position` varchar(500) NOT NULL,
  `degree` varchar(500) NOT NULL,
  `blurb` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE IF NOT EXISTS `media` (
  `ID` int(11) NOT NULL,
  `title` varchar(500) NOT NULL,
  `body` text NOT NULL,
  `event` int(11) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `publication_sections`
--

CREATE TABLE IF NOT EXISTS `publication_sections` (
  `ID` int(11) NOT NULL auto_increment,
  `title` varchar(500) NOT NULL,
  `intro` text NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `sponsors`
--

CREATE TABLE IF NOT EXISTS `sponsors` (
  `ID` int(11) NOT NULL auto_increment,
  `name` varchar(500) NOT NULL,
  `type` varchar(100) NOT NULL,
  `profile` text NOT NULL,
  `logo` varchar(100) NOT NULL,
  `link` varchar(500) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=101 ;

-- --------------------------------------------------------

--
-- Table structure for table `subsidpage`
--

CREATE TABLE IF NOT EXISTS `subsidpage` (
  `ID` int(11) NOT NULL,
  `title` varchar(500) NOT NULL,
  `body` text NOT NULL,
  `event` int(11) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


-------------------------------------------------------------------
-- Table structure for the new content (CMS) table

CREATE TABLE IF NOT EXISTS `pages_content` (

`name` varchar(20) NOT NULL,

`title` varchar(100) NOT NULL,

`content` text NOT NULL,

`lastedit_who` varchar(10) DEFAULT NULL,

`lastedit_when` datetime DEFAULT NULL,

PRIMARY KEY (`name`)

) ENGINE=InnoDB DEFAULT CHARSET=latin1;# MySQL returned an empty result set (i.e. zero rows).

-------------------------------------------------------------------
-- Table structure for the new members table

CREATE TABLE IF NOT EXISTS `members` (

`uname` varchar(30) NOT NULL,

`mobile` varchar(15) DEFAULT NULL,

`dept` tinytext NOT NULL,

`fname` tinytext NOT NULL,

`lname` tinytext NOT NULL,

`email` tinytext NOT NULL,

`regdate` datetime NOT NULL,

`regmethod` varchar(20) NOT NULL,

`admin` int(11) NOT NULL,

PRIMARY KEY (`uname`)

) ENGINE=InnoDB DEFAULT CHARSET=latin1;