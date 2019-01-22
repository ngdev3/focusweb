-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2019 at 06:46 AM
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
(1, 'Voluptas ratione do nemo tempora ratione et eiusmod unde sit quis in quis', 'http://www.luzidecoro.in', 'Nostrum nostrum est error explicabo Cillum', 1, 'inactive', '2019-01-16 01:40:20', NULL),
(2, 'Libero quasi qui voluptatum veniam odio earum beatae pariatur Reprehenderit odio harum', 'http://www.hozycumarusiqa.me', 'Laudantium qui qui sequi dicta cillum esse', 1, 'active', '2019-01-16 01:40:25', NULL),
(3, 'Ad in non omnis eligendi voluptatibus consequatur Quo culpa sint sequi dolor modi tempora', 'http://www.nutugexemyderi.com', 'Aute rerum voluptatum odit sit consequatur Nihil quia recusandae Odit provident nulla enim explicabo Vero exercitationem', 1, 'active', '2019-01-16 01:40:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `f_coach_category`
--

CREATE TABLE `f_coach_category` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `currency` varchar(255) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `f_coach_category`
--

INSERT INTO `f_coach_category` (`id`, `title`, `amount`, `type`, `currency`, `created_date`, `updated_date`) VALUES
(1, 'Self Mastery', '4.99', 'monthly', '$', NULL, '2019-01-17 11:40:56'),
(2, 'Business Leadership', '4.90', 'year', '$', NULL, '2019-01-17 11:41:00');

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
(1, 'Nam at doloribus ad velit laborum excepteur irure quo minima numquam qui rerum voluptates fugiat id expedita in obcaecati dolorum', 'http://www.fulafy.us', 'Mollit cupidatat quis neque eius laudantium ut reprehenderit tempora voluptatibus ullamco qui quae', 1, 'inactive', '2019-01-16 01:57:18', NULL);

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
(1, '2001-03-01', '2019-01-30', '4:10:15 PM', '16:10:15', '16:10:15', 'dfgdfgdgooo', 'dgfdfgdg555', 'delete', 1, '2019-01-16 11:40:16', '2019-01-16 11:27:43'),
(2, '2019-05-01', '1970-01-01', '4:41:45 PM', '16:41:45', '16:41:45', 'ddd', 'dddd', 'delete', 1, '2019-01-16 12:11:55', '2019-01-16 12:36:51'),
(3, '2019-01-01', '2019-03-02', '4:46:30 PM', '16:46:30', '16:46:30', 'gdfgd', 'fgdfgdfgdfg', 'active', 1, '2019-01-16 12:16:48', '2019-01-16 06:50:57');

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

INSERT INTO `f_self_mastery` (`id`, `title`, `url`, `description`, `added_by`, `type`, `status`, `created_date`, `updated_date`) VALUES
(1, 'one', 'http://www.fulafy.uscb', 'Mollit cupidatat quis neque eius laudantium ut reprehenderit tempora voluptatibus ullamco qui quae', 1, '1', 'inactive', '2019-01-16 01:57:18', '2019-01-18 11:40:19'),
(2, 'Officia in quae voluptatibus tempora tempor molestias ut irure cum tenetur', 'http://www.fulafy.uscb', 'Dolorem odit lorem animi cupidatat fugit dolore qui consectetur molestiae natus aliquip expedita commodi minus officia', 1, '1', 'active', '2019-01-18 11:42:15', '2019-01-18 11:40:30'),
(3, 'In proident nostrum numquam in qui aut nisi aliquip quia enim laboris aute et', 'http://www.fulafy.uscb', 'Ea adipisci consequuntur irure non dolor ea et sit doloribus autem', 1, '1', 'active', '2019-01-18 11:42:25', '2019-01-18 11:40:30'),
(4, 'Animi voluptate eligendi numquam voluptatum in ut quo consectetur omnis beatae voluptatem id do dolor magnam dolor', 'http://www.fulafy.uscb', 'Adipisicing voluptatem sint enim quis dolorem', 1, '2', 'active', '2019-01-18 12:11:02', '2019-01-18 11:40:30'),
(5, 'Fugiat et omnis dolor rerum et esse 1', 'http://www.fulafy.uscb', 'Rerum molestiae nesciunt explicabo Incididunt ut quasi dolor', 1, '1', 'active', '2019-01-18 12:11:54', '2019-01-18 11:40:30'),
(6, 'Aspernatur voluptas non id fugit rerum irure sit quibusdam dolor velit iure blanditiis officia dolor fuga Eligendi quidem2', 'http://www.fulafy.uscb', 'Enim itaque accusamus ullam libero quas harum accusantium amet reprehenderit et quaerat eius aut ut id molestias', 1, '2', 'active', '2019-01-18 12:12:00', '2019-01-18 11:40:30'),
(7, 'Consequatur irure a nihil iusto similique optio natus labore sunt quod adipisicing pariatur Qui vitae aut in vel Nam', 'http://www.fulafy.uscb', 'Nam molestiae corrupti reprehenderit similique voluptas nulla consequuntur', 1, '2', 'active', '2019-01-18 12:32:01', '2019-01-18 11:40:30'),
(8, 'Self Mastery video Listing', 'http://www.xurofafywuniq.co.uk', 'Self Mastery video Listing', 1, '2', 'active', '2019-01-18 12:42:16', '2019-01-18 07:13:44'),
(9, 'Add Self Mastery video', 'http://www.pogyq.org.au', 'Add Self Mastery video', 1, '2', 'active', '2019-01-18 12:44:00', NULL);

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
(1, 'Rajat', 'Gupta', 'admin@yopmail.com', 0, NULL, 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, '20190118-012925.jpg', '8506003445', 0, 'active', NULL, '2019-01-11 05:33:24', 0, NULL, '2019-01-15 05:21:27', '', '1'),
(15, 'Xaviera', 'Scott', 'cedypikiru@yopmail.com', 0, NULL, '26c8b760b746633ac4bb6ebee967a8df', NULL, NULL, NULL, '', '8506003444', 1, 'active', NULL, '2019-01-15 05:38:27', 1, '2019-01-15 00:00:00', NULL, '', '2'),
(16, 'Coach', 'Hogan', 'coach@yopmail.com', 0, NULL, '40b9dfa806aed160f6047cffad3180c8', NULL, NULL, NULL, '', '8056465458', 0, 'active', NULL, '2019-01-15 05:41:03', 1, NULL, NULL, '', '2'),
(17, 'End', 'User', 'user@yopmail.com', 1, 2, '922508177e9c7e017697c15fb57c5601', NULL, NULL, NULL, '', '8523697845', 0, 'active', NULL, '2019-01-15 05:42:05', 1, '2019-01-15 00:00:00', NULL, '', '3'),
(18, 'Eden', 'Frye', 'lohysudy@yopmail.com', 1, 2, 'ddd56dbcc3e8a4d482fe2cb7a5753af8', NULL, NULL, NULL, '', '8887905070', 0, 'inactive', NULL, '2019-01-16 19:32:21', 1, NULL, NULL, '', '3'),
(19, 'Post', 'Rajat', 'rajat51@yopmail.com', 0, NULL, 'd41d8cd98f00b204e9800998ecf8427e', NULL, NULL, NULL, '', '8506003696', 0, 'active', NULL, '2019-01-20 22:57:41', 0, NULL, NULL, '', '2'),
(20, 'Post', 'Rajat', 'rajat52@yopmail.com', 0, NULL, 'd41d8cd98f00b204e9800998ecf8427e', NULL, NULL, NULL, '', '8506003696', 0, 'active', NULL, '2019-01-20 23:00:02', 0, NULL, NULL, '', NULL),
(21, 'Post', 'Rajat', 'rajat53@yopmail.com', 0, NULL, 'd278212eee10f20d8d1b032cc5f971c2', NULL, NULL, NULL, '', '8506003696', 0, 'active', NULL, '2019-01-20 23:06:49', 0, NULL, NULL, '', NULL),
(22, 'Post', 'Rajat', 'rajat54@yopmail.com', 0, NULL, '6358dd1b9b9fbb0638b2cefe1961e15f', NULL, NULL, NULL, '', '8506003696', 0, 'active', NULL, '2019-01-20 23:10:30', 0, NULL, NULL, '', '2'),
(23, 'Post', 'Rajat', 'rajat55@yopmail.com', 0, NULL, '0ef3e419b0bb5196187e01d2b9ba4292', NULL, NULL, NULL, '', '8506003696', 0, 'active', NULL, '2019-01-20 23:12:26', 0, '2019-01-21 00:00:00', '2019-01-21 05:20:41', 'android', '2');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `f_coaches_center`
--
ALTER TABLE `f_coaches_center`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `f_coach_category`
--
ALTER TABLE `f_coach_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `f_temp_image_upload`
--
ALTER TABLE `f_temp_image_upload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
