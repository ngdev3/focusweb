-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2019 at 02:00 PM
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
-- Table structure for table `f_cms`
--

CREATE TABLE `f_cms` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `cms_id` enum('1','2','3') NOT NULL DEFAULT '1',
  `description` longtext NOT NULL,
  `added_by` int(11) NOT NULL,
  `status` enum('active','inactive','delete') DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `f_cms`
--

INSERT INTO `f_cms` (`id`, `type`, `cms_id`, `description`, `added_by`, `status`, `created_date`, `updated_date`) VALUES
(1, 'About Us', '1', 'About Us Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32', 1, 'active', NULL, '2019-02-27 05:58:35'),
(2, 'Terms and Condition', '2', 'Terms and Condition, Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32', 1, 'active', '2019-02-27 10:26:03', '2019-02-27 05:58:24');

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
(4, 'Financial Investing', 'active', '1', NULL, '2019-02-19 07:28:58'),
(5, 'Business Intelligence', 'active', '2', NULL, '2019-02-19 10:39:23'),
(6, 'Brand Development', 'active', '2', NULL, '2019-02-19 10:39:28'),
(7, 'Marketing', 'active', '2', NULL, '2019-02-19 10:39:31'),
(8, 'Video Production', 'active', '2', NULL, '2019-02-19 10:39:15');

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
(10, 'is_coach', 2, 1, 17, '2019-01-18 01:42:37', '2019-01-18 12:42:37'),
(11, 'is_coach', 1, 1, 23, '2019-02-28 07:16:15', '2019-02-28 06:16:15'),
(12, 'is_user', NULL, 1, 23, '2019-02-28 07:16:25', '2019-02-28 06:16:25'),
(13, 'is_coach', 2, 1, 23, '2019-02-28 07:46:56', '2019-02-28 06:46:56'),
(14, 'is_user', NULL, 1, 23, '2019-02-28 07:47:03', '2019-02-28 06:47:03'),
(15, 'is_coach', 2, 1, 23, '2019-02-28 07:48:05', '2019-02-28 06:48:05'),
(16, 'is_user', NULL, 1, 23, '2019-02-28 07:48:21', '2019-02-28 06:48:21'),
(17, 'is_coach', 2, 1, 23, '2019-02-28 07:48:27', '2019-02-28 06:48:27'),
(18, 'is_user', NULL, 1, 23, '2019-02-28 07:49:19', '2019-02-28 06:49:19'),
(19, 'is_coach', 2, 1, 23, '2019-02-28 07:49:25', '2019-02-28 06:49:25'),
(20, 'is_user', NULL, 1, 23, '2019-02-28 07:49:59', '2019-02-28 06:49:59'),
(21, 'is_coach', 2, 1, 23, '2019-02-28 07:50:09', '2019-02-28 06:50:09'),
(22, 'is_user', NULL, 1, 23, '2019-02-28 07:50:33', '2019-02-28 06:50:33'),
(23, 'is_coach', 2, 1, 23, '2019-02-28 07:51:13', '2019-02-28 06:51:13'),
(24, 'is_user', NULL, 1, 23, '2019-02-28 07:51:22', '2019-02-28 06:51:22'),
(25, 'is_coach', 2, 1, 23, '2019-02-28 07:52:02', '2019-02-28 06:52:02'),
(26, 'is_user', NULL, 1, 23, '2019-02-28 07:52:07', '2019-02-28 06:52:07'),
(27, 'is_coach', 2, 1, 23, '2019-02-28 07:53:30', '2019-02-28 06:53:30'),
(28, 'is_user', NULL, 1, 23, '2019-02-28 07:55:16', '2019-02-28 06:55:16'),
(29, 'is_coach', 1, 1, 22, '2019-02-28 10:41:14', '2019-02-28 09:41:14'),
(30, 'is_user', NULL, 1, 22, '2019-02-28 10:41:18', '2019-02-28 09:41:18'),
(31, 'is_coach', 1, 1, 22, '2019-02-28 10:47:47', '2019-02-28 09:47:47'),
(32, 'is_coach', 1, 1, 21, '2019-02-28 10:48:03', '2019-02-28 09:48:03'),
(33, 'is_user', NULL, 1, 22, '2019-02-28 10:49:07', '2019-02-28 09:49:07'),
(34, 'is_coach', 1, 1, 22, '2019-02-28 10:49:12', '2019-02-28 09:49:12'),
(35, 'is_user', NULL, 1, 22, '2019-02-28 10:49:44', '2019-02-28 09:49:44'),
(36, 'is_coach', 1, 1, 22, '2019-02-28 10:49:55', '2019-02-28 09:49:55'),
(37, 'is_coach', 2, 1, 23, '2019-02-28 10:50:27', '2019-02-28 09:50:27'),
(38, 'is_user', NULL, 1, 23, '2019-02-28 10:50:45', '2019-02-28 09:50:45'),
(39, 'is_coach', 2, 1, 23, '2019-02-28 10:50:51', '2019-02-28 09:50:51'),
(40, 'is_user', NULL, 1, 23, '2019-02-28 10:51:04', '2019-02-28 09:51:04'),
(41, 'is_add_user', NULL, 1, 24, '2019-03-13 05:25:51', '2019-03-13 04:25:51'),
(42, 'is_update_user', NULL, 1, 23, '2019-03-14 08:01:42', '2019-03-14 07:01:42'),
(43, 'is_add_user', NULL, 1, 25, '2019-03-14 08:23:02', '2019-03-14 07:23:02'),
(44, 'is_add_coach', NULL, 1, 26, '2019-03-14 08:24:39', '2019-03-14 07:24:39');

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
(1, '1, 6, 7, 3, 4', 'Rajat', '1, 2', 'Tue Feb 12 2019 05:07:30 GMT+0530 (India Standard Time)', 'Sat Feb 16 2019 17:25:19 GMT+0530 (India Standard Time)', '30', 'Tue Feb 12 2019 05:07:30 GMT+0530 (India Standard Time)', 'active', 1, '2019-02-19 09:03:27', '2019-02-19 15:33:27'),
(2, '1, 2, 3, 4, 5', 'Week Days Week Days', '3, 4, 5', 'Tue Feb 12 2019 12:19:07 GMT+0530 (India Standard Time)', 'Sat Feb 16 2019 17:25:19 GMT+0530 (India Standard ...', '15', 'Tue Feb 12 2019 21:19:07 GMT+0530 (India Standard Time)', 'active', 1, '2019-02-12 05:20:19', '2019-02-12 14:16:15'),
(3, '1, 2, 5', 'rrrrrrrrrrrrr', '6, 7', '01:00:00', '14-02-2019', '15 min', '01:00:00', 'active', 17, '2019-02-13 12:41:01', '2019-02-13 07:11:01'),
(4, '1, 5, 7, 2, 6, 3, 4', 'Week Days Week Days 0', '8, 9, 10', 'Tue Feb 12 2019 12:26:07 GMT+0530 (India Standard Time)', 'Sun Feb 16 2020 17:25:19 GMT+0530 (India Standard Time)', '01', 'Tue Feb 12 2019 21:23:07 GMT+0530 (India Standard Time)', 'active', 1, '2019-02-13 12:47:46', '2019-02-13 07:17:46'),
(5, '1, 6, 7, 3', 'Nnnn', '11, 12, 13', 'Tue Feb 19 2019 09:03:31 GMT+0530 (India Standard Time)', 'Tue Feb 19 2019 21:03:31 GMT+0530 (India Standard Time)', '01', 'Tue Feb 19 2019 09:03:31 GMT+0530 (India Standard Time)', 'active', 1, '2019-02-19 09:04:10', '2019-02-19 15:34:10');

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
(1, 1, 'Early Wake Up', 'active', 1, '2019-02-12 05:08:06', '2019-02-19 03:33:27'),
(2, 1, 'Daily Excersie', 'active', 1, '2019-02-12 05:08:07', '2019-02-19 03:33:27'),
(3, 2, 'Week Days Week Days', 'active', 1, '2019-02-12 05:20:19', NULL),
(4, 2, 'Week DaysWeek Days', 'active', 1, '2019-02-12 05:20:19', NULL),
(5, 2, 'Week Days Week Days', 'active', 1, '2019-02-12 05:20:19', NULL),
(6, 3, 'T', 'active', 1, '2019-02-12 05:25:38', '2019-02-13 07:11:01'),
(7, 3, 'T', 'active', 1, '2019-02-12 05:25:38', '2019-02-13 07:11:01'),
(8, 4, 'One 1', 'active', 1, '2019-02-13 12:43:14', '2019-02-13 07:17:46'),
(9, 4, 'Two 2', 'active', 1, '2019-02-13 12:43:14', '2019-02-13 07:17:46'),
(10, 4, 'Three 3', 'active', 1, '2019-02-13 12:43:14', '2019-02-13 07:17:46'),
(11, 5, 'Nmmm', 'active', 1, '2019-02-19 09:03:47', '2019-02-19 03:34:10'),
(12, 5, 'Mmmm', 'active', 1, '2019-02-19 09:03:48', '2019-02-19 03:34:10'),
(13, 5, 'Bnfnfnfnf', 'active', 1, '2019-02-19 09:03:48', '2019-02-19 03:34:10');

-- --------------------------------------------------------

--
-- Table structure for table `f_leadership`
--

CREATE TABLE `f_leadership` (
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
-- Dumping data for table `f_leadership`
--

INSERT INTO `f_leadership` (`id`, `title`, `url`, `category`, `description`, `added_by`, `type`, `status`, `created_date`, `updated_date`) VALUES
(4, 'Add Business Leadership video', 'https://www.youtube.com/embed/UBMk30rjy0o', NULL, 'http://www.capaligisyk.tv', 1, '2', 'active', '2019-01-18 12:59:59', '2019-03-02 15:18:00'),
(13, 'Daily life can be made happier. It is a matter of choice. It is our attitude that makes us feel happy or unhappy. It is true, we meet all kinds of situations during the day, and some of them may happiness and what does it means to them answers....', 'https://www.youtube.com/embed/UBMk30rjy0o', 5, 'Daily life can be made happier. It is a matter of choice. It is our attitude that makes us feel happy or unhappy. It is true, we meet all kinds of situations during the day, and some of them may happiness and what does it means to them answers....', 1, '1', 'active', '2019-02-26 05:37:52', '2019-03-02 15:18:08'),
(14, 'Daily life can be made happier. It is a matter of choice. It is our attitude that makes us feel happy or unhappy. It is true, we meet all kinds of situations during the day, and some of them may happiness and what does it means to them answers....', 'https://www.youtube.com/embed/UBMk30rjy0o', 6, 'Daily life can be made happier. It is a matter of choice. It is our attitude that makes us feel happy or unhappy. It is true, we meet all kinds of situations during the day, and some of them may happiness and what does it means to them answers....', 1, '1', 'active', '2019-02-26 05:37:57', '2019-03-02 15:18:08'),
(15, 'Daily life can be made happier. It is a matter of choice. It is our attitude that makes us feel happy or unhappy. It is true, we meet all kinds of situations during the day, and some of them may happiness and what does it means to them answers....', 'https://www.youtube.com/embed/UBMk30rjy0o', 7, 'Daily life can be made happier. It is a matter of choice. It is our attitude that makes us feel happy or unhappy. It is true, we meet all kinds of situations during the day, and some of them may happiness and what does it means to them answers....', 1, '1', 'active', '2019-02-26 05:38:01', '2019-03-02 15:18:08'),
(16, 'Daily life can be made happier. It is a matter of choice. It is our attitude that makes us feel happy or unhappy. It is true, we meet all kinds of situations during the day, and some of them may happiness and what does it means to them answers....', 'https://www.youtube.com/embed/UBMk30rjy0o', 8, 'Daily life can be made happier. It is a matter of choice. It is our attitude that makes us feel happy or unhappy. It is true, we meet all kinds of situations during the day, and some of them may happiness and what does it means to them answers....', 1, '1', 'active', '2019-02-26 05:38:07', '2019-03-02 15:18:08');

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
(1, 'Nam at doloribus ad velit laborum excepteur irure quo minima numquam qui rerum voluptates fugiat id expedita in obcaecati dolorum', 'https://www.youtube.com/embed/UBMk30rjy0o', 'Mollit cupidatat quis neque eius laudantium ut reprehenderit tempora voluptatibus ullamco qui quae', 1, 'active', '2019-01-16 01:57:18', '2019-03-02 15:11:38');

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
(4, 'Fri Nov 24 1995 00:00:00 GMT+0530 (India Standard Time)', 'Nash Gillespie', '10, 11, 12', 1, '2019-02-14 10:16:00', '2019-02-20 00:46:08'),
(5, 'Thu Nov 24 2011 00:00:00 GMT+0530 (India Standard Time)', 'Nash Gillespie Update', '13, 14, 15', 1, '2019-02-14 10:21:56', '2019-02-14 05:22:37'),
(6, 'Thu Nov 24 2011 00:00:00 GMT+0530 (India Standard Time)', 'Nash Gillespie Update', '16, 17, 18', 1, '2019-02-14 10:54:12', '2019-02-14 05:24:13'),
(7, 'Thu Nov 24 2011 00:00:00 GMT+0530 (India Standard Time)', 'Nash Gillespie Update', '19, 20, 21', 1, '2019-02-14 10:54:53', '2019-02-19 03:16:11'),
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
(10, 'Grace Clayton', '5, 4, 3', 'Wed Feb 13 2019 18:21:54 GMT+0530 (India Standard Time)', 1, '2019-02-14 10:16:00', '2019-02-20 00:46:08'),
(11, 'Xavier Kent', '7, 2, 5', 'Wed Feb 13 2019 08:14:54 GMT+0530 (India Standard Time)', 1, '2019-02-14 10:16:00', '2019-02-20 00:46:08'),
(12, 'Hope Eaton', '7', 'Wed Feb 13 2019 08:15:54 GMT+0530 (India Standard Time)', 1, '2019-02-14 10:16:00', '2019-02-20 00:46:08'),
(13, 'Rajat One', '5, 4, 3, 2, 7', 'Wed Feb 13 2019 19:15:54 GMT+0530 (India Standard Time)', 1, '2019-02-14 10:21:56', '2019-02-14 05:22:37'),
(14, 'Rajat Two', '7, 2, 5, 6, 3, 4', 'Wed Feb 13 2019 08:14:54 GMT+0530 (India Standard Time)', 1, '2019-02-14 10:21:56', '2019-02-14 05:22:37'),
(15, 'Rajat Three', '7, 6, 1, 2, 3, 4, 5', 'Wed Feb 13 2019 08:15:54 GMT+0530 (India Standard Time)', 1, '2019-02-14 10:21:56', '2019-02-14 05:22:37'),
(16, 'Rajat One', '5, 4, 3, 2, 7', 'Wed Feb 13 2019 19:15:54 GMT+0530 (India Standard Time)', 6, '2019-02-14 10:54:13', '2019-02-14 05:24:13'),
(17, 'Rajat Two', '7, 2, 5, 6, 3, 4', 'Wed Feb 13 2019 08:14:54 GMT+0530 (India Standard Time)', 6, '2019-02-14 10:54:13', '2019-02-14 05:24:13'),
(18, 'Rajat Three', '7, 6, 1, 2, 3, 4, 5', 'Wed Feb 13 2019 08:15:54 GMT+0530 (India Standard Time)', 6, '2019-02-14 10:54:13', '2019-02-14 05:24:13'),
(19, 'Rajat One', '5, 4, 3, 2, 7', 'Wed Feb 13 2019 19:15:54 GMT+0530 (India Standard Time)', 1, '2019-02-14 10:54:53', '2019-02-19 03:16:12'),
(20, 'Rajat Two', '7, 2, 5, 6, 3, 4', 'Wed Feb 13 2019 08:14:54 GMT+0530 (India Standard Time)', 1, '2019-02-14 10:54:53', '2019-02-19 03:16:12'),
(21, 'Rajat Three', '7, 6, 1, 2, 3, 4, 5', 'Wed Feb 13 2019 08:15:54 GMT+0530 (India Standard Time)', 1, '2019-02-14 10:54:53', '2019-02-19 03:16:12'),
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
  `goal_date` varchar(255) NOT NULL,
  `status` enum('active','inactive','delete') DEFAULT 'active',
  `added_by` int(11) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `f_my_vision`
--

INSERT INTO `f_my_vision` (`id`, `image_id`, `vision_title`, `background_id`, `goal_date`, `status`, `added_by`, `created_date`, `updated_date`) VALUES
(1, '', 'dfgdf', 3, 'Mon Mar 04 2019 00:00:00 GMT+0530 (IST)', 'active', 1, NULL, '2019-03-02 01:55:55');

-- --------------------------------------------------------

--
-- Table structure for table `f_notification`
--

CREATE TABLE `f_notification` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` enum('pending','done') DEFAULT 'pending',
  `typeofcontent` varchar(255) NOT NULL COMMENT 'morningfocus, vision, goals etc',
  `contentid` int(11) NOT NULL,
  `notification_datetime` datetime NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `status` enum('active','inactive') DEFAULT 'active',
  `currency` varchar(255) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `f_plans`
--

INSERT INTO `f_plans` (`id`, `title`, `amount`, `type`, `status`, `currency`, `created_date`, `updated_date`) VALUES
(1, 'Per Month', '4.99', 'monthly', 'active', '$', NULL, '2019-01-15 12:18:03'),
(2, 'Per Year', '49.90', 'year', 'active', '$', NULL, '2019-02-21 04:40:19');

-- --------------------------------------------------------

--
-- Table structure for table `f_plans_method`
--

CREATE TABLE `f_plans_method` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `method` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_date` datetime DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `f_plans_method`
--

INSERT INTO `f_plans_method` (`id`, `title`, `method`, `type`, `status`, `created_date`, `updated_date`) VALUES
(1, 'Paypal', 'online', 'online', 'active', '2019-02-21 11:15:59', '2019-02-21 05:45:59'),
(2, 'Google Pay', 'online', 'online', 'active', NULL, '2019-02-21 05:45:59'),
(3, 'Apple Pay', 'online', 'online', 'active', '2019-02-21 11:16:05', '2019-02-21 05:46:18'),
(4, 'Zelle Pay', 'online', 'online', 'active', NULL, '2019-02-21 05:46:24');

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
(4, 'Animi voluptate eligendi numquam voluptatum in ut quo consectetur omnis beatae voluptatem id do dolor magnam dolor', 'https://www.youtube.com/embed/UBMk30rjy0o', 3, 'Daily life can be made happier. It is a matter of choice. It is our attitude that makes us feel happy or unhappy. It is true, we meet all kinds of situations during the day, and some of them may happiness and what does it means to them answers....', 1, '2', 'active', '2019-01-18 12:11:02', '2019-03-02 15:35:47'),
(6, 'Aspernatur voluptas non id fugit rerum irure sit quibusdam dolor velit iure blanditiis officia dolor fuga Eligendi quidem2', 'https://www.youtube.com/embed/UBMk30rjy0o', 3, 'Daily life can be made happier. It is a matter of choice. It is our attitude that makes us feel happy or unhappy. It is true, we meet all kinds of situations during the day, and some of them may happiness and what does it means to them answers....', 1, '2', 'active', '2019-01-18 12:12:00', '2019-03-02 15:35:47'),
(7, 'Consequatur irure a nihil iusto similique optio natus labore sunt quod adipisicing pariatur Qui vitae aut in vel Nam', 'https://www.youtube.com/embed/UBMk30rjy0o', 1, 'Daily life can be made happier. It is a matter of choice. It is our attitude that makes us feel happy or unhappy. It is true, we meet all kinds of situations during the day, and some of them may happiness and what does it means to them answers....', 1, '2', 'active', '2019-01-18 12:32:01', '2019-03-02 15:35:47'),
(8, 'Self Mastery video Listing', 'https://www.youtube.com/embed/UBMk30rjy0o', 4, 'Daily life can be made happier. It is a matter of choice. It is our attitude that makes us feel happy or unhappy. It is true, we meet all kinds of situations during the day, and some of them may happiness and what does it means to them answers....', 1, '2', 'active', '2019-01-18 12:42:16', '2019-03-02 15:35:47'),
(9, 'Add Self Mastery video', 'https://www.youtube.com/embed/UBMk30rjy0o', 1, 'Daily life can be made happier. It is a matter of choice. It is our attitude that makes us feel happy or unhappy. It is true, we meet all kinds of situations during the day, and some of them may happiness and what does it means to them answers....', 1, '2', 'active', '2019-01-18 12:44:00', '2019-03-02 15:35:47'),
(12, 'Daily life can be made happier. It is a matter of choice. It is our attitude that makes us feel happy or unhappy. It is true, we meet all kinds of situations during the day, and some of them may happiness and what does it means to them answers....', 'https://www.youtube.com/embed/UBMk30rjy0o', 1, 'Daily life can be made happier. It is a matter of choice. It is our attitude that makes us feel happy or unhappy. It is true, we meet all kinds of situations during the day, and some of them may happiness and what does it means to them answers....', 1, '1', 'active', '2019-02-26 05:00:07', '2019-03-02 15:35:41'),
(13, 'Daily life can be made happier. It is a matter of choice. It is our attitude that makes us feel happy or unhappy. It is true, we meet all kinds of situations during the day, and some of them may happiness and what does it means to them answers....', 'https://www.youtube.com/embed/UBMk30rjy0o', 2, 'Daily life can be made happier. It is a matter of choice. It is our attitude that makes us feel happy or unhappy. It is true, we meet all kinds of situations during the day, and some of them may happiness and what does it means to them answers....', 1, '1', 'active', '2019-02-26 05:00:16', '2019-03-02 15:35:47'),
(14, 'Daily life can be made happier. It is a matter of choice. It is our attitude that makes us feel happy or unhappy. It is true, we meet all kinds of situations during the day, and some of them may happiness and what does it means to them answers....', 'https://www.youtube.com/embed/UBMk30rjy0o', 3, 'Daily life can be made happier. It is a matter of choice. It is our attitude that makes us feel happy or unhappy. It is true, we meet all kinds of situations during the day, and some of them may happiness and what does it means to them answers....', 1, '1', 'active', '2019-02-26 05:00:24', '2019-03-02 15:35:47'),
(15, 'Daily life can be made happier. It is a matter of choice. It is our attitude that makes us feel happy or unhappy. It is true, we meet all kinds of situations during the day, and some of them may happiness and what does it means to them answers....', 'https://www.youtube.com/embed/UBMk30rjy0o', 4, 'Daily life can be made happier. It is a matter of choice. It is our attitude that makes us feel happy or unhappy. It is true, we meet all kinds of situations during the day, and some of them may happiness and what does it means to them answers....', 1, '1', 'active', '2019-02-26 05:00:29', '2019-03-02 15:35:47');

-- --------------------------------------------------------

--
-- Table structure for table `f_temp_image_upload`
--

CREATE TABLE `f_temp_image_upload` (
  `id` int(11) NOT NULL,
  `file_name` longtext NOT NULL,
  `added_by` int(11) NOT NULL,
  `uuid` mediumtext,
  `status` enum('active','inactive','delete') DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `f_temp_image_upload`
--

INSERT INTO `f_temp_image_upload` (`id`, `file_name`, `added_by`, `uuid`, `status`, `created_date`, `updated_date`) VALUES
(2, '14f89330649bb8c88098223f2dca1c3e.jpg', 17, '3f35781d101c2344', 'active', '2019-03-02', NULL),
(3, 'b12c7bcfc97b43f01a6dc2aeceae9919.jpg', 30, 'ifadabetaapp_1551542306', 'active', '2019-03-14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `f_vision_image_upload`
--

CREATE TABLE `f_vision_image_upload` (
  `id` int(11) NOT NULL,
  `file_name` longtext NOT NULL,
  `added_by` int(11) NOT NULL,
  `vision_id` int(11) NOT NULL,
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
(1, '1, 2, 7, 6, 3, 4', 'sl;f;dflkfjhdkghjfdhgkhkhk', 'Wed Feb 20 2019 02:42:08 GMT+0530 (India Standard Time)', '15', 'Wed Feb 20 2019 02:42:08 GMT+0530 (India Standard Time)', 'active', 1, '2019-02-19 09:49:45', '2019-02-19 21:13:02'),
(2, '6, 2, 3, 1, 5, 7, 4', 'Rajat Gupta', 'Tue Feb 19 2019 09:49:12 GMT+0530 (India Standard Time)', '15', 'Tue Feb 19 2019 09:49:12 GMT+0530 (India Standard Time)', 'active', 1, '2019-02-19 09:49:45', '2019-02-19 21:13:14');

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
  `coach_subcat` int(11) DEFAULT NULL,
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
  `user_type` enum('1','2','3') DEFAULT NULL COMMENT '1=admin, 2=user, 3=coaches',
  `login_token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `is_coach`, `coach_cat`, `coach_subcat`, `password`, `available_sizes`, `token`, `token_valid`, `profile_image`, `mobile_no`, `is_member`, `status`, `modified_time`, `added_date`, `added_by`, `updated_date`, `last_login`, `login_from`, `user_type`, `login_token`) VALUES
(1, 'Archana', 'Arora', 'admin@yopmail.com', 0, NULL, NULL, 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, '20190313-050251.jpg', '8506003445', 0, 'active', NULL, '2019-01-11 05:33:24', 0, '2019-02-19 08:42:14', '2019-03-14 05:29:03', 'Android', '1', '70167e2c-8527-4172-8203-68d3712cb5f1'),
(15, 'Xaviera', 'Scott', 'cedypikiru@yopmail.com', 0, NULL, NULL, '9cbf8a4dcb8e30682b927f352d6559a0', NULL, NULL, NULL, '', '8506003444', 1, 'active', NULL, '2019-01-15 05:38:27', 1, '2019-01-15 00:00:00', NULL, '', '2', ''),
(16, 'Coach', 'Hogan', 'coach@yopmail.com', 0, NULL, NULL, '9cbf8a4dcb8e30682b927f352d6559a0', NULL, NULL, NULL, '', '8056465458', 0, 'active', NULL, '2019-01-15 05:41:03', 1, NULL, NULL, '', '2', ''),
(17, 'End', 'User', 'user@yopmail.com', 1, 2, NULL, '9cbf8a4dcb8e30682b927f352d6559a0', NULL, NULL, NULL, '431584ba0f6d6092d5b6c0f48d7d3a18.jpg', '8523697845', 0, 'active', NULL, '2019-01-15 05:42:05', 1, '2019-01-15 00:00:00', '2019-03-04 11:28:23', 'Android', '3', ''),
(18, 'Eden', 'Frye', 'lohysudy@yopmail.com', 1, 2, NULL, '9cbf8a4dcb8e30682b927f352d6559a0', NULL, NULL, NULL, '', '8887905070', 0, 'inactive', NULL, '2019-01-16 19:32:21', 1, NULL, NULL, '', '3', ''),
(19, 'Post', 'Rajat', 'rajat51@yopmail.com', 0, NULL, NULL, '9cbf8a4dcb8e30682b927f352d6559a0', NULL, NULL, NULL, '', '8506003696', 0, 'active', NULL, '2019-01-20 22:57:41', 0, NULL, NULL, '', '2', ''),
(20, 'Posttt', 'tttttt', 'rajat52@yopmail.com', 0, NULL, NULL, '9cbf8a4dcb8e30682b927f352d6559a0', NULL, NULL, NULL, '', '8506003696', 0, 'active', NULL, '2019-01-20 23:00:02', 0, '2019-03-14 08:13:45', NULL, '', NULL, ''),
(21, 'Post', 'Rajat', 'rajat53@yopmail.com', 1, 1, NULL, '9cbf8a4dcb8e30682b927f352d6559a0', NULL, NULL, NULL, '742d2c56bd070e41e71e10b396e57adc.jpg', '8506003696', 0, 'active', NULL, '2019-01-20 23:06:49', 0, NULL, '2019-03-02 08:36:14', 'Android', '3', ''),
(22, 'Post', 'Rajat', 'rajat54@yopmail.com', 1, 1, NULL, '9cbf8a4dcb8e30682b927f352d6559a0', NULL, NULL, NULL, '596109ccc23d8502ccd50910848d52ea.jpg', '8506003696', 0, 'active', NULL, '2019-01-20 23:10:30', 0, NULL, '2019-03-02 08:00:21', 'Android', '3', ''),
(23, 'Postt', 'Rajatt', 'rajat55@yopmail.com', 0, NULL, NULL, '9cbf8a4dcb8e30682b927f352d6559a0', NULL, NULL, NULL, '', '8506003696', 0, 'active', NULL, '2019-01-20 23:12:26', 0, '2019-03-14 08:12:52', '2019-03-02 08:36:46', 'Android', '2', ''),
(24, 'ffff', 'khkhkh', 'admin5@yopmail.com', 0, NULL, NULL, 'b69812789728cca4a5fe7d5b35cf1081', NULL, NULL, NULL, '', '1234567898', 0, 'inactive', NULL, '2019-03-12 23:55:44', 1, '2019-03-14 08:14:59', NULL, '', '2', ''),
(25, 'Rkjkhk', 'hkjhkjhkjh', 'khkhk@yopmail.com', 0, NULL, NULL, '643ca7cf67a10f3e0cdc182310db17c4', NULL, NULL, NULL, '', '1234567899', 0, 'active', NULL, '2019-03-14 02:52:53', 1, NULL, NULL, '', '2', ''),
(26, 'rajat', 'hhkjhk', 'tekshapers.rajat@gmail.com', 1, NULL, NULL, 'aa187ccb8f51d994c28d7de244ecefc4', NULL, NULL, NULL, '', '4567891589', 0, 'active', NULL, '2019-03-14 02:54:33', 1, NULL, NULL, '', '3', ''),
(27, 'Gary Villarreal', 'Winifred Washington', 'tafotu@yopmail.com', 0, NULL, NULL, 'd41d8cd98f00b204e9800998ecf8427e', NULL, NULL, NULL, '', '7445454545', 0, 'active', NULL, '2019-03-13 22:50:32', 0, NULL, NULL, '', '2', ''),
(28, 'Hnnnn', 'Bnnn', 'plockerappss@gmail.com', 0, NULL, NULL, 'd41d8cd98f00b204e9800998ecf8427e', NULL, NULL, NULL, '', '8569586958', 0, 'active', NULL, '2019-03-14 00:09:23', 0, NULL, NULL, '', '2', '70167e2c-8527-4172-8203-68d3712cb5f1'),
(29, 'Hbbbb', 'Hjj', 'plockeirapps@gmail.com', 0, NULL, NULL, 'd41d8cd98f00b204e9800998ecf8427e', NULL, NULL, NULL, '', '2586958695', 0, 'active', NULL, '2019-03-14 00:14:10', 0, NULL, NULL, '', '2', '70167e2c-8527-4172-8203-68d3712cb5f1'),
(30, 'Bnnn', 'Mmmj', 'plockerapps@gmail.com', 0, NULL, NULL, 'f0a90a2ab11fca93ae77c11d04ee08dd', NULL, NULL, NULL, 'ec8da2a459f124f9cbf96ba9eae1cd2f.jpg', '8569856325', 0, 'active', NULL, '2019-03-14 00:16:39', 0, NULL, '2019-03-14 05:49:02', 'Android', '2', '70167e2c-8527-4172-8203-68d3712cb5f1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `f_category`
--
ALTER TABLE `f_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `f_cms`
--
ALTER TABLE `f_cms`
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
-- Indexes for table `f_notification`
--
ALTER TABLE `f_notification`
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
-- Indexes for table `f_plans_method`
--
ALTER TABLE `f_plans_method`
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
-- AUTO_INCREMENT for table `f_cms`
--
ALTER TABLE `f_cms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `f_coaches_center`
--
ALTER TABLE `f_coaches_center`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `f_coach_category`
--
ALTER TABLE `f_coach_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `f_coach_conversion_log`
--
ALTER TABLE `f_coach_conversion_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `f_focus_meeting_goals`
--
ALTER TABLE `f_focus_meeting_goals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `f_leadership`
--
ALTER TABLE `f_leadership`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `f_notification`
--
ALTER TABLE `f_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `f_plans_method`
--
ALTER TABLE `f_plans_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `f_queries`
--
ALTER TABLE `f_queries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `f_self_mastery`
--
ALTER TABLE `f_self_mastery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `f_temp_image_upload`
--
ALTER TABLE `f_temp_image_upload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
