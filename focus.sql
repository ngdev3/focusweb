-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2019 at 10:39 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `focus`
--

-- --------------------------------------------------------

--
-- Table structure for table `f_category`
--

CREATE TABLE `f_category` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `short_name` varchar(255) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `f_category`
--

INSERT INTO `f_category` (`id`, `full_name`, `short_name`, `created_date`, `updated_date`) VALUES
(1, 'Monday', 'MON', NULL, '2019-01-28 11:58:09'),
(2, 'Tuesday', 'TUE', NULL, '2019-01-28 11:59:28'),
(3, 'Wednesday', 'WED', NULL, '2019-01-28 11:59:48'),
(4, 'Thursday', 'THU', NULL, '2019-01-28 12:00:02'),
(5, 'Friday', 'FRI', NULL, '2019-01-28 12:00:12'),
(6, 'Saturday', 'SAT', NULL, '2019-01-28 12:00:24'),
(7, 'Sunday', 'SUN', NULL, '2019-01-28 12:00:34');

-- --------------------------------------------------------

--
-- Table structure for table `f_coaches_center`
--

CREATE TABLE `f_coaches_center` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` longtext NOT NULL,
  `description` varchar(255) NOT NULL,
  `added_by` int(11) NOT NULL,
  `status` enum('active','inactive','delete') DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `f_coaches_center`
--

INSERT INTO `f_coaches_center` (`id`, `title`, `url`, `description`, `added_by`, `status`, `created_date`, `updated_date`) VALUES
(1, 'Voluptas ratione do nemo tempora ratione et eiusmod unde sit quis in quis', 'https://www.youtube.com/embed/UBMk30rjy0o', 'Nostrum nostrum est error explicabo Cillum', 1, 'inactive', '2019-01-16 01:40:20', '2019-02-05 10:13:58'),
(2, 'Libero quasi qui voluptatum veniam odio earum beatae pariatur Reprehenderit odio harum', 'https://www.youtube.com/embed/UBMk30rjy0o', 'Laudantium qui qui sequi dicta cillum esse', 1, 'active', '2019-01-16 01:40:25', '2019-02-05 10:13:58'),
(3, 'Ad in non omnis eligendi voluptatibus consequatur Quo culpa sint sequi dolor modi tempora', 'https://www.youtube.com/embed/UBMk30rjy0o', 'Aute rerum voluptatum odit sit consequatur Nihil quia recusandae Odit provident nulla enim explicabo Vero exercitationem', 1, 'active', '2019-01-16 01:40:30', '2019-02-05 10:13:58');

-- --------------------------------------------------------

--
-- Table structure for table `f_coach_category`
--

CREATE TABLE `f_coach_category` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` enum('active','inactive','delete') DEFAULT 'active',
  `type` enum('1','2') NOT NULL COMMENT '1=>''mastery'',2=>''leadership''',
  `created_date` datetime DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `f_coach_category`
--

INSERT INTO `f_coach_category` (`id`, `title`, `status`, `type`, `created_date`, `updated_date`) VALUES
(1, 'Personal Development', 'active', '1', NULL, '2019-02-19 07:28:22'),
(2, 'Dating and Relationship', 'active', '1', NULL, '2019-02-19 07:28:32'),
(3, 'Goal Settings', 'active', '1', NULL, '2019-02-19 07:28:58'),
(4, 'Financial Investing', 'active', '1', NULL, '2019-02-19 07:28:58');

-- --------------------------------------------------------

--
-- Table structure for table `f_coach_conversion_log`
--

CREATE TABLE `f_coach_conversion_log` (
  `id` int(11) NOT NULL,
  `became` varchar(255) NOT NULL,
  `type` int(11) DEFAULT NULL,
  `converted_by` int(11) NOT NULL,
  `whois` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `f_coach_conversion_log`
--

INSERT INTO `f_coach_conversion_log` (`id`, `became`, `type`, `converted_by`, `whois`, `created_date`, `updated_date`) VALUES
(1, 'is_user', NULL, 1, 17, '2019-01-17 12:57:08', '2019-01-17 11:57:08'),
(2, 'is_user', NULL, 1, 16, '2019-01-17 12:57:13', '2019-01-17 11:57:13'),
(3, 'is_coach', 2, 1, 17, '2019-01-17 12:59:22', '2019-01-17 11:59:22'),
(4, 'is_coach', 2, 1, 17, '2019-01-17 12:59:22', '2019-01-17 11:59:22'),
(5, 'is_user', NULL, 1, 17, '2019-01-17 12:59:46', '2019-01-17 11:59:46'),
(6, 'is_coach', 2, 1, 17, '2019-01-17 01:00:53', '2019-01-17 12:00:53'),
(7, 'is_add_user', NULL, 1, 18, '2019-01-17 01:02:28', '2019-01-17 12:02:28'),
(8, 'is_user', NULL, 1, 17, '2019-01-18 01:31:44', '2019-01-18 12:31:44'),
(9, 'is_coach', 2, 1, 18, '2019-01-18 01:42:30', '2019-01-18 12:42:30'),
(10, 'is_coach', 2, 1, 17, '2019-01-18 01:42:37', '2019-01-18 12:42:37');

-- --------------------------------------------------------

--
-- Table structure for table `f_color_schemes`
--

CREATE TABLE `f_color_schemes` (
  `id` int(11) NOT NULL,
  `scheme_color_name` varchar(255) NOT NULL,
  `background_color` varchar(255) NOT NULL,
  `font_color` varchar(255) NOT NULL,
  `button_color` varchar(255) NOT NULL,
  `added_by` int(11) NOT NULL,
  `status` enum('active','inactive','delete') DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `f_color_schemes`
--

INSERT INTO `f_color_schemes` (`id`, `scheme_color_name`, `background_color`, `font_color`, `button_color`, `added_by`, `status`, `created_date`, `updated_date`) VALUES
(1, 'Blue Background', '#f0f0f0', '#f0f0f0', '#f0f0f0', 1, 'active', NULL, '2019-01-21 12:55:01'),
(2, 'Blue Color Scheme', '#000000', '#dc4903', '#000000', 1, 'active', '2019-01-16 08:49:26', '2019-01-21 12:54:50'),
(3, 'BlueBluessss', '#50e01f', '#ffff00', '#ff0000', 1, 'active', '2019-01-16 09:11:41', '2019-01-16 03:41:41');

-- --------------------------------------------------------

--
-- Table structure for table `f_days`
--

CREATE TABLE `f_days` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `short_name` varchar(255) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `f_days`
--

INSERT INTO `f_days` (`id`, `full_name`, `short_name`, `created_date`, `updated_date`) VALUES
(1, 'Monday', 'MON', NULL, '2019-01-28 11:58:09'),
(2, 'Tuesday', 'TUE', NULL, '2019-01-28 11:59:28'),
(3, 'Wednesday', 'WED', NULL, '2019-01-28 11:59:48'),
(4, 'Thursday', 'THU', NULL, '2019-01-28 12:00:02'),
(5, 'Friday', 'FRI', NULL, '2019-01-28 12:00:12'),
(6, 'Saturday', 'SAT', NULL, '2019-01-28 12:00:24'),
(7, 'Sunday', 'SUN', NULL, '2019-01-28 12:00:34');

-- --------------------------------------------------------

--
-- Table structure for table `f_focus_meeting`
--

CREATE TABLE `f_focus_meeting` (
  `id` int(11) NOT NULL,
  `days` varchar(255) NOT NULL,
  `meeting_name` longtext NOT NULL,
  `meeting_goals` varchar(255) NOT NULL,
  `set_time` varchar(255) NOT NULL,
  `set_date` varchar(255) NOT NULL,
  `set_reminder` varchar(255) NOT NULL,
  `set_notification` varchar(255) NOT NULL,
  `status` enum('active','inactive','delete') DEFAULT 'active',
  `added_by` int(11) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `f_focus_meeting`
--

INSERT INTO `f_focus_meeting` (`id`, `days`, `meeting_name`, `meeting_goals`, `set_time`, `set_date`, `set_reminder`, `set_notification`, `status`, `added_by`, `created_date`, `updated_date`) VALUES
(1, '1', 'Rajat', '1, 2', 'Tue Feb 12 2019 05:07:30 GMT+0530 (India Standard Time)', 'Sat Feb 16 2019 17:25:19 GMT+0530 (India Standard ...', '30', 'Tue Feb 12 2019 05:07:30 GMT+0530 (India Standard Time)', 'active', 1, '2019-02-12 05:08:06', '2019-02-12 14:16:22'),
(2, '1, 2, 3, 4, 5', 'Week Days Week Days', '3, 4, 5', 'Tue Feb 12 2019 12:19:07 GMT+0530 (India Standard Time)', 'Sat Feb 16 2019 17:25:19 GMT+0530 (India Standard ...', '15', 'Tue Feb 12 2019 21:19:07 GMT+0530 (India Standard Time)', 'active', 1, '2019-02-12 05:20:19', '2019-02-12 14:16:15'),
(3, '1, 2, 5', 'rrrrrrrrrrrrr', '6, 7', '01:00:00', '14-02-2019', '15 min', '01:00:00', 'active', 17, '2019-02-13 12:41:01', '2019-02-13 07:11:01'),
(4, '1, 5, 7, 2, 6, 3, 4', 'Week Days Week Days 0', '8, 9, 10', 'Tue Feb 12 2019 12:26:07 GMT+0530 (India Standard Time)', 'Sun Feb 16 2020 17:25:19 GMT+0530 (India Standard Time)', '01', 'Tue Feb 12 2019 21:23:07 GMT+0530 (India Standard Time)', 'active', 1, '2019-02-13 12:47:46', '2019-02-13 07:17:46');

-- --------------------------------------------------------

--
-- Table structure for table `f_focus_meeting_goals`
--

CREATE TABLE `f_focus_meeting_goals` (
  `id` int(11) NOT NULL,
  `focus_meeting_id` int(11) NOT NULL,
  `action_step` longtext NOT NULL,
  `status` enum('active','inactive','delete') DEFAULT 'active',
  `added_by` int(11) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `f_focus_meeting_goals`
--

INSERT INTO `f_focus_meeting_goals` (`id`, `focus_meeting_id`, `action_step`, `status`, `added_by`, `created_date`, `updated_date`) VALUES
(1, 1, 'Early Wake Up', 'active', 1, '2019-02-12 05:08:06', NULL),
(2, 1, 'Daily Excersie', 'active', 1, '2019-02-12 05:08:07', NULL),
(3, 2, 'Week Days Week Days', 'active', 1, '2019-02-12 05:20:19', NULL),
(4, 2, 'Week DaysWeek Days', 'active', 1, '2019-02-12 05:20:19', NULL),
(5, 2, 'Week Days Week Days', 'active', 1, '2019-02-12 05:20:19', NULL),
(6, 3, 'T', 'active', 1, '2019-02-12 05:25:38', '2019-02-13 07:11:01'),
(7, 3, 'T', 'active', 1, '2019-02-12 05:25:38', '2019-02-13 07:11:01'),
(8, 4, 'One 1', 'active', 1, '2019-02-13 12:43:14', '2019-02-13 07:17:46'),
(9, 4, 'Two 2', 'active', 1, '2019-02-13 12:43:14', '2019-02-13 07:17:46'),
(10, 4, 'Three 3', 'active', 1, '2019-02-13 12:43:14', '2019-02-13 07:17:46');

-- --------------------------------------------------------

--
-- Table structure for table `f_leadership`
--

CREATE TABLE `f_leadership` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` longtext NOT NULL,
  `description` varchar(255) NOT NULL,
  `added_by` int(11) NOT NULL,
  `type` enum('1','2') NOT NULL COMMENT '''1''=>''content'', ''2''=>''video''',
  `status` enum('active','inactive','delete') DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `f_leadership`
--

INSERT INTO `f_leadership` (`id`, `title`, `url`, `description`, `added_by`, `type`, `status`, `created_date`, `updated_date`) VALUES
(3, 'Leadership Content Listing', '', 'Leadership Content Listing', 1, '1', 'active', '2019-01-18 12:59:15', NULL),
(4, 'Add Business Leadership video', 'Add Business Leadership video', 'http://www.capaligisyk.tv', 1, '2', 'active', '2019-01-18 12:59:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `f_master_class`
--

CREATE TABLE `f_master_class` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` longtext NOT NULL,
  `description` varchar(255) NOT NULL,
  `added_by` int(11) NOT NULL,
  `status` enum('active','inactive','delete') DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `f_master_class`
--

INSERT INTO `f_master_class` (`id`, `title`, `url`, `description`, `added_by`, `status`, `created_date`, `updated_date`) VALUES
(1, 'Nam at doloribus ad velit laborum excepteur irure quo minima numquam qui rerum voluptates fugiat id expedita in obcaecati dolorum', 'http://www.fulafy.us', 'Mollit cupidatat quis neque eius laudantium ut reprehenderit tempora voluptatibus ullamco qui quae', 1, 'active', '2019-01-16 01:57:18', '2019-01-24 11:12:27');

-- --------------------------------------------------------

--
-- Table structure for table `f_membership`
--

CREATE TABLE `f_membership` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `cardnumber` varchar(255) NOT NULL,
  `name_at_card` varchar(255) NOT NULL,
  `cvv` varchar(255) NOT NULL,
  `expiry` varchar(255) NOT NULL,
  `billing_email` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `tnx_id` longtext,
  `created_date` datetime DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `f_membership`
--

INSERT INTO `f_membership` (`id`, `user_id`, `added_by`, `cardnumber`, `name_at_card`, `cvv`, `expiry`, `billing_email`, `start_date`, `end_date`, `tnx_id`, `created_date`, `updated_date`) VALUES
(1, 2, 2, '1236547894561236', 'rajat', '236', '02/2089', '', '2019-01-01', '2019-01-31', 'jhfgf87656g678584u6cffgdxzdztdg', NULL, '2019-01-15 12:40:33');

-- --------------------------------------------------------

--
-- Table structure for table `f_morning_focus`
--

CREATE TABLE `f_morning_focus` (
  `id` int(11) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `set_time` varchar(255) NOT NULL,
  `globalformate` time NOT NULL,
  `localformate` time NOT NULL,
  `quotation_title` varchar(255) NOT NULL,
  `quotation` longtext NOT NULL,
  `status` enum('active','inactive','delete') DEFAULT NULL,
  `added_by` int(11) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `f_morning_focus`
--

INSERT INTO `f_morning_focus` (`id`, `from_date`, `to_date`, `set_time`, `globalformate`, `localformate`, `quotation_title`, `quotation`, `status`, `added_by`, `created_date`, `updated_date`) VALUES
(1, '2001-03-01', '2019-01-30', '4:10:15 PM', '16:10:15', '16:10:15', 'dfgdfgdgooo', 'dgfdfgdg555', 'active', 1, '2019-01-16 11:40:16', '2019-02-05 07:53:07'),
(2, '2019-05-01', '1970-01-01', '4:41:45 PM', '16:41:45', '16:41:45', 'ddd', 'dddd', 'active', 1, '2019-01-16 12:11:55', '2019-02-05 07:53:07'),
(3, '2019-01-01', '2019-03-02', '4:46:30 PM', '16:46:30', '16:46:30', 'gdfgd', 'fgdfgdfgdfg', 'active', 1, '2019-01-16 12:16:48', '2019-01-16 06:50:57');

-- --------------------------------------------------------

--
-- Table structure for table `f_my_goal`
--

CREATE TABLE `f_my_goal` (
  `id` int(11) NOT NULL,
  `target_date` varchar(255) NOT NULL,
  `goal_name` varchar(255) NOT NULL,
  `goal_steps` varchar(255) NOT NULL,
  `added_by` int(11) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `f_my_goal`
--

INSERT INTO `f_my_goal` (`id`, `target_date`, `goal_name`, `goal_steps`, `added_by`, `created_date`, `updated_date`) VALUES
(1, 'Mon Mar 02 2020 00:00:00 GMT+0530 (India Standard Time)', 'Rajat gupta', '1, 2, 3', 1, '2019-02-13 08:13:09', '2019-02-13 14:43:09'),
(2, 'Fri Nov 24 1995 00:00:00 GMT+0530 (India Standard Time)', 'Nash Gillespie', '4, 5, 6', 1, '2019-02-13 08:16:30', '2019-02-13 14:46:31'),
(3, 'Sat Aug 25 2029 00:00:00 GMT+0530 (India Standard Time)', 'Rajat New Goal Set', '7, 8, 9', 1, '2019-02-13 08:31:02', '2019-02-14 05:14:23'),
(4, 'Fri Nov 24 1995 00:00:00 GMT+0530 (India Standard Time)', 'Nash Gillespie', '10, 11, 12', 1, '2019-02-14 10:16:00', '2019-02-14 04:46:00'),
(5, 'Thu Nov 24 2011 00:00:00 GMT+0530 (India Standard Time)', 'Nash Gillespie Update', '13, 14, 15', 1, '2019-02-14 10:21:56', '2019-02-14 05:22:37'),
(6, 'Thu Nov 24 2011 00:00:00 GMT+0530 (India Standard Time)', 'Nash Gillespie Update', '16, 17, 18', 1, '2019-02-14 10:54:12', '2019-02-14 05:24:13'),
(7, 'Thu Nov 24 2011 00:00:00 GMT+0530 (India Standard Time)', 'Nash Gillespie Update', '19, 20, 21', 1, '2019-02-14 10:54:53', '2019-02-14 05:24:53'),
(8, 'Fri Nov 24 1995 00:00:00 GMT+0530 (India Standard Time)', 'Nash Gillespie', '22, 23, 24', 1, '2019-02-14 10:55:03', '2019-02-14 05:25:04');

-- --------------------------------------------------------

--
-- Table structure for table `f_my_goal_steps`
--

CREATE TABLE `f_my_goal_steps` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `selected_day` varchar(255) NOT NULL,
  `set_time` varchar(255) NOT NULL,
  `goal_id` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `f_my_goal_steps`
--

INSERT INTO `f_my_goal_steps` (`id`, `title`, `selected_day`, `set_time`, `goal_id`, `created_date`, `updated_date`) VALUES
(1, 'Grace Claytonfdfdf', '5, 4, 3', 'Wed Feb 13 2019 00:15:54 GMT+0530 (India Standard Time)', 1, NULL, '2019-02-14 05:16:34'),
(2, 'Test Two', '7, 3, 5, 4', 'Wed Feb 13 2019 08:11:48 GMT+0530 (India Standard Time)', 1, NULL, '2019-02-13 14:43:09'),
(3, 'Test Three', '4, 3, 2', 'Wed Feb 13 2019 08:11:48 GMT+0530 (India Standard Time)', 1, NULL, '2019-02-13 14:43:09'),
(4, 'Grace Clayton', '5, 4, 3', 'Wed Feb 13 2019 00:15:54 GMT+0530 (India Standard Time)', 2, '2019-02-13 08:16:31', '2019-02-13 14:46:31'),
(5, 'Xavier Kent', '7, 2, 5', 'Wed Feb 13 2019 08:14:54 GMT+0530 (India Standard Time)', 2, '2019-02-13 08:16:31', '2019-02-13 14:46:31'),
(6, 'Hope Eaton', '7', 'Wed Feb 13 2019 08:15:54 GMT+0530 (India Standard Time)', 2, '2019-02-13 08:16:31', '2019-02-13 14:46:31'),
(7, 'Kameko Pruitt', '3, 7', 'Wed Feb 13 2019 08:29:39 GMT+0530 (India Standard Time)', 3, '2019-02-13 08:31:02', '2019-02-13 15:01:02'),
(8, 'Caryn Byrd', '4, 5', 'Wed Feb 13 2019 13:29:39 GMT+0530 (India Standard Time)', 3, '2019-02-13 08:31:02', '2019-02-13 15:01:02'),
(9, 'Pamela Rojas', '7, 1, 2', 'Wed Feb 13 2019 14:29:39 GMT+0530 (India Standard Time)', 3, '2019-02-13 08:31:02', '2019-02-13 15:01:02'),
(10, 'Grace Clayton', '5, 4, 3', 'Wed Feb 13 2019 00:15:54 GMT+0530 (India Standard Time)', 4, '2019-02-14 10:16:00', '2019-02-14 04:46:00'),
(11, 'Xavier Kent', '7, 2, 5', 'Wed Feb 13 2019 08:14:54 GMT+0530 (India Standard Time)', 4, '2019-02-14 10:16:00', '2019-02-14 04:46:00'),
(12, 'Hope Eaton', '7', 'Wed Feb 13 2019 08:15:54 GMT+0530 (India Standard Time)', 4, '2019-02-14 10:16:00', '2019-02-14 04:46:00'),
(13, 'Rajat One', '5, 4, 3, 2, 7', 'Wed Feb 13 2019 19:15:54 GMT+0530 (India Standard Time)', 1, '2019-02-14 10:21:56', '2019-02-14 05:22:37'),
(14, 'Rajat Two', '7, 2, 5, 6, 3, 4', 'Wed Feb 13 2019 08:14:54 GMT+0530 (India Standard Time)', 1, '2019-02-14 10:21:56', '2019-02-14 05:22:37'),
(15, 'Rajat Three', '7, 6, 1, 2, 3, 4, 5', 'Wed Feb 13 2019 08:15:54 GMT+0530 (India Standard Time)', 1, '2019-02-14 10:21:56', '2019-02-14 05:22:37'),
(16, 'Rajat One', '5, 4, 3, 2, 7', 'Wed Feb 13 2019 19:15:54 GMT+0530 (India Standard Time)', 6, '2019-02-14 10:54:13', '2019-02-14 05:24:13'),
(17, 'Rajat Two', '7, 2, 5, 6, 3, 4', 'Wed Feb 13 2019 08:14:54 GMT+0530 (India Standard Time)', 6, '2019-02-14 10:54:13', '2019-02-14 05:24:13'),
(18, 'Rajat Three', '7, 6, 1, 2, 3, 4, 5', 'Wed Feb 13 2019 08:15:54 GMT+0530 (India Standard Time)', 6, '2019-02-14 10:54:13', '2019-02-14 05:24:13'),
(19, 'Rajat One', '5, 4, 3, 2, 7', 'Wed Feb 13 2019 19:15:54 GMT+0530 (India Standard Time)', 7, '2019-02-14 10:54:53', '2019-02-14 05:24:53'),
(20, 'Rajat Two', '7, 2, 5, 6, 3, 4', 'Wed Feb 13 2019 08:14:54 GMT+0530 (India Standard Time)', 7, '2019-02-14 10:54:53', '2019-02-14 05:24:53'),
(21, 'Rajat Three', '7, 6, 1, 2, 3, 4, 5', 'Wed Feb 13 2019 08:15:54 GMT+0530 (India Standard Time)', 7, '2019-02-14 10:54:53', '2019-02-14 05:24:53'),
(22, 'Grace Clayton', '5, 4, 3', 'Wed Feb 13 2019 00:15:54 GMT+0530 (India Standard Time)', 8, '2019-02-14 10:55:04', '2019-02-14 05:25:04'),
(23, 'Xavier Kent', '7, 2, 5', 'Wed Feb 13 2019 08:14:54 GMT+0530 (India Standard Time)', 8, '2019-02-14 10:55:04', '2019-02-14 05:25:04'),
(24, 'Hope Eaton', '7', 'Wed Feb 13 2019 08:15:54 GMT+0530 (India Standard Time)', 8, '2019-02-14 10:55:04', '2019-02-14 05:25:04');

-- --------------------------------------------------------

--
-- Table structure for table `f_my_vision`
--

CREATE TABLE `f_my_vision` (
  `id` int(11) NOT NULL,
  `image_id` varchar(255) NOT NULL,
  `vision_title` varchar(255) NOT NULL,
  `background_id` int(11) NOT NULL,
  `textforimage` longtext NOT NULL,
  `goal_date` varchar(255) NOT NULL,
  `status` enum('active','inactive','delete') DEFAULT 'active',
  `added_by` int(11) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `f_my_vision`
--

INSERT INTO `f_my_vision` (`id`, `image_id`, `vision_title`, `background_id`, `textforimage`, `goal_date`, `status`, `added_by`, `created_date`, `updated_date`) VALUES
(1, '0', '', 0, '', '', NULL, 17, '2019-01-28 05:57:37', '2019-01-28 12:27:37'),
(2, '', 'ksdhkhskdhk kjhsk hksh sk hkshk hskh kshk sh', 1, 'hdjkfghkjdhfkjg hk jfgk dkfgh kdfghkdfg hkd fgkhd fkgh dk fghkdfhg ', '22-01-2019', 'active', 0, NULL, NULL),
(3, '', 'ksdhkhskdhk kjhsk hksh sk hkshk hskh kshk sh', 1, 'hdjkfghkjdhfkjg hk jfgk dkfgh kdfghkdfg hkd fgkhd fkgh dk fghkdfhg ', '22-01-2019', 'active', 0, NULL, NULL),
(4, '', 'ksdhkhskdhk kjhsk hksh sk hkshk hskh kshk sh', 1, 'hdjkfghkjdhfkjg hk jfgk dkfgh kdfghkdfg hkd fgkhd fkgh dk fghkdfhg ', '22-01-2019', 'active', 0, NULL, NULL),
(5, '', 'ksdhkhskdhk kjhsk hksh sk hkshk hskh kshk sh', 1, 'hdjkfghkjdhfkjg hk jfgk dkfgh kdfghkdfg hkd fgkhd fkgh dk fghkdfhg ', '22-01-2019', 'active', 0, NULL, NULL),
(6, '', 'ksdhkhskdhk kjhsk hksh sk hkshk hskh kshk sh', 1, 'hdjkfghkjdhfkjg hk jfgk dkfgh kdfghkdfg hkd fgkhd fkgh dk fghkdfhg ', '22-01-2019', 'active', 0, NULL, NULL),
(7, '', 'ksdhkhskdhk kjhsk hksh sk hkshk hskh kshk sh', 1, 'hdjkfghkjdhfkjg hk jfgk dkfgh kdfghkdfg hkd fgkhd fkgh dk fghkdfhg ', '22-01-2019', 'active', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `f_payment_log`
--

CREATE TABLE `f_payment_log` (
  `id` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `method` varchar(255) NOT NULL,
  `added_by` int(11) NOT NULL,
  `tnx_id` longtext,
  `created_date` datetime DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `f_plans`
--

CREATE TABLE `f_plans` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `currency` varchar(255) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `f_plans`
--

INSERT INTO `f_plans` (`id`, `title`, `amount`, `type`, `currency`, `created_date`, `updated_date`) VALUES
(1, 'Per Month', '4.99', 'monthly', '$', NULL, '2019-01-15 12:18:03'),
(2, 'Per Year', '4.90', 'year', '$', NULL, '2019-01-15 12:18:27');

-- --------------------------------------------------------

--
-- Table structure for table `f_queries`
--

CREATE TABLE `f_queries` (
  `id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `added_by` int(11) NOT NULL,
  `concern` longtext,
  `created_date` datetime DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `f_queries`
--

INSERT INTO `f_queries` (`id`, `subject`, `content`, `added_by`, `concern`, `created_date`, `updated_date`) VALUES
(1, 'Need Coach', 'Need Coach', 15, 'Need Coach', NULL, '2019-01-15 12:59:36'),
(2, 'Need Coach', 'Need Coach', 15, 'Need Coach', NULL, '2019-01-15 12:59:36');

-- --------------------------------------------------------

--
-- Table structure for table `f_retreats`
--

CREATE TABLE `f_retreats` (
  `id` int(11) NOT NULL,
  `status` enum('approve','disapprove') DEFAULT NULL,
  `added_by` int(11) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `f_self_mastery`
--

CREATE TABLE `f_self_mastery` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` longtext NOT NULL,
  `category` int(11) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `added_by` int(11) NOT NULL,
  `type` enum('1','2') NOT NULL COMMENT '''1''=>''content'', ''2''=>''video''',
  `status` enum('active','inactive','delete') DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `f_self_mastery`
--

INSERT INTO `f_self_mastery` (`id`, `title`, `url`, `category`, `description`, `added_by`, `type`, `status`, `created_date`, `updated_date`) VALUES
(1, 'one', 'http://www.fulafy.uscb', NULL, 'Mollit cupidatat quis neque eius laudantium ut reprehenderit tempora voluptatibus ullamco qui quae', 1, '1', 'inactive', '2019-01-16 01:57:18', '2019-02-19 08:03:54'),
(2, 'Officia in quae voluptatibus tempora tempor molestias ut irure cum tenetur', 'http://www.fulafy.uscb', 1, 'Dolorem odit lorem animi cupidatat fugit dolore qui consectetur molestiae natus aliquip expedita commodi minus officia', 1, '1', 'active', '2019-01-18 11:42:15', '2019-02-19 04:26:54'),
(3, 'In proident nostrum numquam in qui aut nisi aliquip quia enim laboris aute et', 'http://www.fulafy.uscb', NULL, 'Ea adipisci consequuntur irure non dolor ea et sit doloribus autem', 1, '1', 'active', '2019-01-18 11:42:25', '2019-02-19 08:04:02'),
(4, 'Animi voluptate eligendi numquam voluptatum in ut quo consectetur omnis beatae voluptatem id do dolor magnam dolor', 'http://www.fulafy.uscb', NULL, 'Adipisicing voluptatem sint enim quis dolorem', 1, '2', 'active', '2019-01-18 12:11:02', '2019-02-19 08:04:02'),
(5, 'Fugiat et omnis dolor rerum et esse 1', 'http://www.fulafy.uscb', NULL, 'Rerum molestiae nesciunt explicabo Incididunt ut quasi dolor', 1, '1', 'active', '2019-01-18 12:11:54', '2019-02-19 08:04:02'),
(6, 'Aspernatur voluptas non id fugit rerum irure sit quibusdam dolor velit iure blanditiis officia dolor fuga Eligendi quidem2', 'http://www.fulafy.uscb', NULL, 'Enim itaque accusamus ullam libero quas harum accusantium amet reprehenderit et quaerat eius aut ut id molestias', 1, '2', 'active', '2019-01-18 12:12:00', '2019-02-19 08:04:02'),
(7, 'Consequatur irure a nihil iusto similique optio natus labore sunt quod adipisicing pariatur Qui vitae aut in vel Nam', 'http://www.fulafy.uscb', NULL, 'Nam molestiae corrupti reprehenderit similique voluptas nulla consequuntur', 1, '2', 'active', '2019-01-18 12:32:01', '2019-02-19 08:04:02'),
(8, 'Self Mastery video Listing', 'http://www.xurofafywuniq.co.uk', NULL, 'Self Mastery video Listing', 1, '2', 'active', '2019-01-18 12:42:16', '2019-02-19 08:04:02'),
(9, 'Add Self Mastery video', 'http://www.pogyq.org.au', NULL, 'Add Self Mastery video', 1, '2', 'active', '2019-01-18 12:44:00', '2019-02-19 08:04:02'),
(10, 'sdfsdfdgdgdgggd', '', 1, 'sdfsdfssdsdgdgg', 1, '1', 'active', '2019-02-19 09:28:17', '2019-02-19 04:46:51');

-- --------------------------------------------------------

--
-- Table structure for table `f_temp_image_upload`
--

CREATE TABLE `f_temp_image_upload` (
  `id` int(11) NOT NULL,
  `file_name` longtext NOT NULL,
  `thumbnail_name` longtext NOT NULL,
  `file_ext` text NOT NULL,
  `added_by` int(11) NOT NULL,
  `file_size` varchar(255) NOT NULL,
  `raw_name` longtext NOT NULL,
  `image_type` varchar(255) NOT NULL,
  `status` enum('active','inactive','delete') DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `f_temp_image_upload`
--

INSERT INTO `f_temp_image_upload` (`id`, `file_name`, `thumbnail_name`, `file_ext`, `added_by`, `file_size`, `raw_name`, `image_type`, `status`, `created_date`, `updated_date`) VALUES
(2, 'd2bb3481b6c43afdee7e53c98b0c8899.jpg', 'd2bb3481b6c43afdee7e53c98b0c8899_thumb.jpg', '.jpg', 17, '486.91', 'd2bb3481b6c43afdee7e53c98b0c8899', 'jpeg', NULL, '2019-01-28 08:57:34', NULL),
(3, 'fe90a528d06d0cd55697b5da5befcfc0.jpg', 'fe90a528d06d0cd55697b5da5befcfc0_thumb.jpg', '.jpg', 17, '486.91', 'fe90a528d06d0cd55697b5da5befcfc0', 'jpeg', NULL, '2019-01-28 08:58:39', NULL),
(4, '04bbb6819cdf3aea0e7c8b6dbc439554.jpg', '04bbb6819cdf3aea0e7c8b6dbc439554_thumb.jpg', '.jpg', 17, '102.61', '04bbb6819cdf3aea0e7c8b6dbc439554', 'jpeg', NULL, '2019-02-08 11:00:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `f_vision_image_upload`
--

CREATE TABLE `f_vision_image_upload` (
  `id` int(11) NOT NULL,
  `file_name` longtext NOT NULL,
  `thumbnail_name` longtext NOT NULL,
  `file_ext` text NOT NULL,
  `added_by` int(11) NOT NULL,
  `vision_id` int(11) NOT NULL,
  `file_size` varchar(255) NOT NULL,
  `raw_name` longtext NOT NULL,
  `image_type` varchar(255) NOT NULL,
  `status` enum('active','inactive','delete') DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `f_weekly_focus`
--

CREATE TABLE `f_weekly_focus` (
  `id` int(11) NOT NULL,
  `days` varchar(255) NOT NULL,
  `weekly_title` longtext NOT NULL,
  `set_time` varchar(255) NOT NULL,
  `set_reminder` varchar(255) NOT NULL,
  `set_notification` varchar(255) NOT NULL,
  `status` enum('active','inactive','delete') DEFAULT NULL,
  `added_by` int(11) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `f_weekly_focus`
--

INSERT INTO `f_weekly_focus` (`id`, `days`, `weekly_title`, `set_time`, `set_reminder`, `set_notification`, `status`, `added_by`, `created_date`, `updated_date`) VALUES
(1, '', 'Weekly Focus', '01:00:00', '15 min', '01:00:00', 'active', 17, NULL, NULL),
(2, '1, 2', 'Weekly Focus', '01:00:00', '15 min', '01:00:00', 'active', 17, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `is_coach` int(11) NOT NULL DEFAULT '0',
  `coach_cat` int(11) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `available_sizes` varchar(255) DEFAULT NULL,
  `token` longtext,
  `token_valid` date DEFAULT NULL,
  `profile_image` longtext NOT NULL,
  `mobile_no` varchar(255) DEFAULT NULL,
  `is_member` int(11) NOT NULL,
  `status` enum('active','inactive','delete') DEFAULT 'active',
  `modified_time` datetime DEFAULT NULL,
  `added_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `added_by` int(11) NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `last_login` varchar(255) DEFAULT NULL,
  `login_from` varchar(255) NOT NULL,
  `user_type` enum('1','2','3') DEFAULT NULL COMMENT '1=admin, 2=user, 3=coaches'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `is_coach`, `coach_cat`, `password`, `available_sizes`, `token`, `token_valid`, `profile_image`, `mobile_no`, `is_member`, `status`, `modified_time`, `added_date`, `added_by`, `updated_date`, `last_login`, `login_from`, `user_type`) VALUES
(1, 'Rajat', 'Gupta', 'admin@yopmail.com', 0, NULL, 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, '20190118-012925.jpg', '8506003445', 0, 'active', NULL, '2019-01-11 05:33:24', 0, NULL, '2019-02-19 12:43:06', 'Android', '1'),
(15, 'Xaviera', 'Scott', 'cedypikiru@yopmail.com', 0, NULL, '26c8b760b746633ac4bb6ebee967a8df', NULL, NULL, NULL, '', '8506003444', 1, 'active', NULL, '2019-01-15 05:38:27', 1, '2019-01-15 00:00:00', NULL, '', '2'),
(16, 'Coach', 'Hogan', 'coach@yopmail.com', 0, NULL, '40b9dfa806aed160f6047cffad3180c8', NULL, NULL, NULL, '', '8056465458', 0, 'active', NULL, '2019-01-15 05:41:03', 1, NULL, NULL, '', '2'),
(17, 'End', 'User', 'user@yopmail.com', 1, 2, '922508177e9c7e017697c15fb57c5601', NULL, NULL, NULL, '', '8523697845', 0, 'active', NULL, '2019-01-15 05:42:05', 1, '2019-01-15 00:00:00', NULL, '', '3'),
(18, 'Eden', 'Frye', 'lohysudy@yopmail.com', 1, 2, 'ddd56dbcc3e8a4d482fe2cb7a5753af8', NULL, NULL, NULL, '', '8887905070', 0, 'inactive', NULL, '2019-01-16 19:32:21', 1, NULL, NULL, '', '3'),
(19, 'Post', 'Rajat', 'rajat51@yopmail.com', 0, NULL, 'd41d8cd98f00b204e9800998ecf8427e', NULL, NULL, NULL, '', '8506003696', 0, 'active', NULL, '2019-01-20 22:57:41', 0, NULL, NULL, '', '2'),
(20, 'Post', 'Rajat', 'rajat52@yopmail.com', 0, NULL, 'd41d8cd98f00b204e9800998ecf8427e', NULL, NULL, NULL, '', '8506003696', 0, 'active', NULL, '2019-01-20 23:00:02', 0, NULL, NULL, '', NULL),
(21, 'Post', 'Rajat', 'rajat53@yopmail.com', 0, NULL, 'd278212eee10f20d8d1b032cc5f971c2', NULL, NULL, NULL, '', '8506003696', 0, 'active', NULL, '2019-01-20 23:06:49', 0, NULL, NULL, '', NULL),
(22, 'Post', 'Rajat', 'rajat54@yopmail.com', 0, NULL, '6358dd1b9b9fbb0638b2cefe1961e15f', NULL, NULL, NULL, '', '8506003696', 0, 'active', NULL, '2019-01-20 23:10:30', 0, NULL, NULL, '', '2'),
(23, 'Post', 'Rajat', 'rajat55@yopmail.com', 0, NULL, '0ef3e419b0bb5196187e01d2b9ba4292', NULL, NULL, NULL, '', '8506003696', 0, 'active', NULL, '2019-01-20 23:12:26', 0, '2019-01-21 00:00:00', '2019-02-01 03:20:17', 'android', '2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `f_category`
--
ALTER TABLE `f_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `f_coaches_center`
--
ALTER TABLE `f_coaches_center`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `f_coach_category`
--
ALTER TABLE `f_coach_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `f_coach_conversion_log`
--
ALTER TABLE `f_coach_conversion_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `f_color_schemes`
--
ALTER TABLE `f_color_schemes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `f_days`
--
ALTER TABLE `f_days`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `f_focus_meeting`
--
ALTER TABLE `f_focus_meeting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `f_focus_meeting_goals`
--
ALTER TABLE `f_focus_meeting_goals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `f_leadership`
--
ALTER TABLE `f_leadership`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `f_master_class`
--
ALTER TABLE `f_master_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `f_membership`
--
ALTER TABLE `f_membership`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `f_morning_focus`
--
ALTER TABLE `f_morning_focus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `f_my_goal`
--
ALTER TABLE `f_my_goal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `f_my_goal_steps`
--
ALTER TABLE `f_my_goal_steps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `f_my_vision`
--
ALTER TABLE `f_my_vision`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `f_payment_log`
--
ALTER TABLE `f_payment_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `f_plans`
--
ALTER TABLE `f_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `f_queries`
--
ALTER TABLE `f_queries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `f_self_mastery`
--
ALTER TABLE `f_self_mastery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `f_temp_image_upload`
--
ALTER TABLE `f_temp_image_upload`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `f_vision_image_upload`
--
ALTER TABLE `f_vision_image_upload`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `f_weekly_focus`
--
ALTER TABLE `f_weekly_focus`
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
-- AUTO_INCREMENT for table `f_category`
--
ALTER TABLE `f_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `f_coaches_center`
--
ALTER TABLE `f_coaches_center`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `f_coach_category`
--
ALTER TABLE `f_coach_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `f_coach_conversion_log`
--
ALTER TABLE `f_coach_conversion_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `f_color_schemes`
--
ALTER TABLE `f_color_schemes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `f_days`
--
ALTER TABLE `f_days`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `f_focus_meeting`
--
ALTER TABLE `f_focus_meeting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `f_focus_meeting_goals`
--
ALTER TABLE `f_focus_meeting_goals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `f_leadership`
--
ALTER TABLE `f_leadership`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `f_master_class`
--
ALTER TABLE `f_master_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `f_membership`
--
ALTER TABLE `f_membership`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `f_morning_focus`
--
ALTER TABLE `f_morning_focus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `f_my_goal`
--
ALTER TABLE `f_my_goal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `f_my_goal_steps`
--
ALTER TABLE `f_my_goal_steps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `f_my_vision`
--
ALTER TABLE `f_my_vision`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `f_payment_log`
--
ALTER TABLE `f_payment_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `f_plans`
--
ALTER TABLE `f_plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `f_queries`
--
ALTER TABLE `f_queries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `f_self_mastery`
--
ALTER TABLE `f_self_mastery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `f_temp_image_upload`
--
ALTER TABLE `f_temp_image_upload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `f_vision_image_upload`
--
ALTER TABLE `f_vision_image_upload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `f_weekly_focus`
--
ALTER TABLE `f_weekly_focus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
