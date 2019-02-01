-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 19, 2014 at 04:54 PM
-- Server version: 5.5.36-cll-lve
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fo`
--

-- --------------------------------------------------------

--
-- Table structure for table `fx_account_details`
--

CREATE TABLE IF NOT EXISTS `fx_account_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `fullname` varchar(160) DEFAULT NULL,
  `company` varchar(150) NOT NULL,
  `city` varchar(40) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `address` varchar(64) NOT NULL,
  `phone` varchar(32) NOT NULL,
  `vat` varchar(32) NOT NULL,
  `language` varchar(40) DEFAULT 'english',
  `avatar` varchar(32) NOT NULL DEFAULT 'default_avatar.jpg',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=8 ;

--
-- Truncate table before insert `fx_account_details`
--

TRUNCATE TABLE `fx_account_details`;
--
-- Dumping data for table `fx_account_details`
--

INSERT INTO `fx_account_details` (`id`, `user_id`, `fullname`, `company`, `city`, `country`, `address`, `phone`, `vat`, `language`, `avatar`) VALUES
(1, 1, 'John Doe', '-', 'Vancouver', 'Canada', '24 Neue Street', '678-23-5423', '', 'english', 'USER-ADMIN-AVATAR.jpg'),
(2, 2, 'Eric Donald', '1', 'New York', 'United States of America', '', '453 123 5680', '', 'english', 'USER-ERIC-AVATAR.jpg'),
(3, 3, 'Susan Leon', '1', 'Tunis', 'Tunisia', '', '4553-293-2334', '', 'english', 'USER-SUEL-AVATAR.png'),
(4, 4, 'Max Leshan', '2', NULL, NULL, '', '453 123 5680', '', 'english', 'default_avatar.jpg'),
(5, 5, 'Olivia Martine', '2', 'Nairobi', 'Kenya', '', '+254-729421280', '', 'english', 'USER-OLIVIA-AVATAR.jpg'),
(6, 6, 'Riziki Sam', '-', 'Calcutta', 'India', '234 - 2130 Churchill Street', '', '', 'english', 'USER-RIZIKI-AVATAR.png'),
(7, 7, 'Timothy Doe', '-', 'Cancun', 'Mexico', '24 Neue Street', '5236587843', '', 'english', 'USER-GITBENCH-AVATAR.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `fx_activities`
--

CREATE TABLE IF NOT EXISTS `fx_activities` (
  `activity_id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `module` varchar(32) CHARACTER SET latin1 NOT NULL,
  `module_field_id` int(11) NOT NULL,
  `activity` varchar(255) CHARACTER SET latin1 NOT NULL,
  `activity_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `icon` varchar(32) CHARACTER SET latin1 DEFAULT 'fa-coffee',
  `deleted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`activity_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Truncate table before insert `fx_activities`
--

TRUNCATE TABLE `fx_activities`;
--
-- Dumping data for table `fx_activities`
--

INSERT INTO `fx_activities` (`activity_id`, `user`, `module`, `module_field_id`, `activity`, `icon`, `deleted`) VALUES
(1, 1, 'Clients', 1, 'Added a new company Envato Inc', 'fa-user', 0),
(2, 1, 'Clients', 1, 'Updated Company Envato Inc', 'fa-edit', 0),
(3, 1, 'Clients', 2, 'Added a new company Gitbench Inc.', 'fa-user', 0),
(4, 1, 'Clients', 2, 'Updated Company Gitbench Inc.', 'fa-edit', 0),
(5, 1, 'invoices', 1, 'INVOICE #INV348526 created.', 'fa-plus', 0),
(6, 1, 'invoices', 2, 'INVOICE #INV983468 created.', 'fa-plus', 0),
(7, 1, 'invoices', 1, 'Payment of USD 900 received and applied to INVOICE #INV348526', 'fa-usd', 0),
(8, 1, 'invoices', 1, 'INVOICE #INV348526 marked as Sent', 'fa-envelope', 0),
(9, 1, 'estimates', 1, 'Estimate #EST14481 created.', 'fa-plus', 0),
(10, 1, 'estimates', 2, 'Estimate #EST61173 created.', 'fa-plus', 0),
(11, 1, 'estimates', 2, 'ESTIMATE #EST61173 marked as Sent', 'fa-envelope', 0),
(12, 1, 'invoices', 2, 'Payment of USD 50 received and applied to INVOICE #INV983468', 'fa-usd', 0),
(13, 1, 'projects', 1, 'Admin created a project #PRO85924', 'fa-coffee', 0),
(14, 1, 'projects', 1, 'Added a task Fix MySQL Authentication Error #2568', 'fa-tasks', 0),
(15, 1, 'projects', 1, 'Added a task Web Application Installer', 'fa-tasks', 0),
(16, 1, 'projects', 1, 'Added a comment to Project #PRO85924', 'fa-comment', 0),
(17, 1, 'projects', 2, 'Admin created a project #PRO14189', 'fa-coffee', 0),
(18, 1, 'projects', 1, 'Admin edited a project #PRO85924', 'fa-coffee', 0),
(19, 7, 'projects', 1, 'Added a task Shopping Cart', 'fa-tasks', 0),
(20, 7, 'projects', 1, 'Added a comment to Project #PRO85924', 'fa-comment', 0),
(21, 7, 'projects', 1, 'Added a comment to Project #PRO85924', 'fa-comment', 0),
(22, 6, 'projects', 1, 'Riziki edited a project #PRO85924', 'fa-pencil', 0),
(23, 6, 'projects', 1, 'Added a comment to Project #PRO85924', 'fa-comment', 0);

-- --------------------------------------------------------

--
-- Table structure for table `fx_assign_projects`
--

CREATE TABLE IF NOT EXISTS `fx_assign_projects` (
  `a_id` int(11) NOT NULL AUTO_INCREMENT,
  `assigned_user` int(11) NOT NULL,
  `project_assigned` int(11) NOT NULL,
  `assign_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Truncate table before insert `fx_assign_projects`
--

TRUNCATE TABLE `fx_assign_projects`;
--
-- Dumping data for table `fx_assign_projects`
--

INSERT INTO `fx_assign_projects` (`a_id`, `assigned_user`, `project_assigned`) VALUES
(1, 1, 1),
(2, 6, 1),
(3, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `fx_assign_tasks`
--

CREATE TABLE IF NOT EXISTS `fx_assign_tasks` (
  `a_id` int(11) NOT NULL AUTO_INCREMENT,
  `assigned_user` int(11) NOT NULL,
  `project_assigned` int(11) NOT NULL,
  `task_assigned` int(11) NOT NULL,
  `assign_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Truncate table before insert `fx_assign_tasks`
--

TRUNCATE TABLE `fx_assign_tasks`;
--
-- Dumping data for table `fx_assign_tasks`
--

INSERT INTO `fx_assign_tasks` (`a_id`, `assigned_user`, `project_assigned`, `task_assigned`) VALUES
(1, 1, 1, 1),
(2, 6, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `fx_bugs`
--

CREATE TABLE IF NOT EXISTS `fx_bugs` (
  `bug_id` int(11) NOT NULL AUTO_INCREMENT,
  `issue_ref` int(11) NOT NULL,
  `project` int(11) NOT NULL,
  `reporter` int(11) NOT NULL,
  `assigned_to` int(11) NOT NULL,
  `bug_status` enum('Unconfirmed','Confirmed','In Progress','Resolved','Verified') CHARACTER SET latin1 NOT NULL DEFAULT 'Unconfirmed',
  `priority` varchar(100) CHARACTER SET latin1 NOT NULL,
  `bug_description` text CHARACTER SET latin1 NOT NULL,
  `reported_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_modified` varchar(64) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`bug_id`),
  UNIQUE KEY `issue_ref` (`issue_ref`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `fx_bugs`
--

TRUNCATE TABLE `fx_bugs`;
-- --------------------------------------------------------

--
-- Table structure for table `fx_bug_comments`
--

CREATE TABLE IF NOT EXISTS `fx_bug_comments` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `bug_id` int(11) NOT NULL,
  `comment_by` int(11) NOT NULL,
  `comment` text CHARACTER SET latin1 NOT NULL,
  `date_commented` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `fx_bug_comments`
--

TRUNCATE TABLE `fx_bug_comments`;
-- --------------------------------------------------------

--
-- Table structure for table `fx_bug_files`
--

CREATE TABLE IF NOT EXISTS `fx_bug_files` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `bug` int(11) NOT NULL,
  `file_name` text CHARACTER SET latin1 NOT NULL,
  `description` text CHARACTER SET latin1 NOT NULL,
  `uploaded_by` int(11) NOT NULL,
  `date_posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `fx_bug_files`
--

TRUNCATE TABLE `fx_bug_files`;
-- --------------------------------------------------------

--
-- Table structure for table `fx_captcha`
--

CREATE TABLE IF NOT EXISTS `fx_captcha` (
  `captcha_id` bigint(13) unsigned NOT NULL AUTO_INCREMENT,
  `captcha_time` int(10) unsigned NOT NULL,
  `ip_address` varchar(16) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `word` varchar(20) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`captcha_id`),
  KEY `word` (`word`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Truncate table before insert `fx_captcha`
--

TRUNCATE TABLE `fx_captcha`;
--
-- Dumping data for table `fx_captcha`
--

INSERT INTO `fx_captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES
(1, 1413751444, '154.122.108.237', 'jPEAheA6'),
(2, 1413751450, '154.122.108.237', 'Gn3JxHbj');

-- --------------------------------------------------------

--
-- Table structure for table `fx_comments`
--

CREATE TABLE IF NOT EXISTS `fx_comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `project` int(11) NOT NULL,
  `posted_by` int(11) NOT NULL,
  `message` text CHARACTER SET latin1 NOT NULL,
  `date_posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` enum('Yes','No') CHARACTER SET latin1 NOT NULL DEFAULT 'No',
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Truncate table before insert `fx_comments`
--

TRUNCATE TABLE `fx_comments`;
--
-- Dumping data for table `fx_comments`
--

INSERT INTO `fx_comments` (`comment_id`, `project`, `posted_by`, `message`,`deleted`) VALUES
(1, 1, 1, '@DevTeam I keep getting Error 503 Authentication', 'No'),
(2, 1, 7, 'Try this out buddy',  'No'),
(3, 1, 7, 'Try this out buddy',  'Yes'),
(4, 1, 6, 'This has been fixed :)', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `fx_comment_replies`
--

CREATE TABLE IF NOT EXISTS `fx_comment_replies` (
  `reply_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_comment` int(11) NOT NULL,
  `reply_msg` text CHARACTER SET latin1 NOT NULL,
  `replied_by` int(11) NOT NULL,
  `del` enum('Yes','No') CHARACTER SET latin1 NOT NULL DEFAULT 'No',
  `date_posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`reply_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `fx_comment_replies`
--

TRUNCATE TABLE `fx_comment_replies`;
-- --------------------------------------------------------

--
-- Table structure for table `fx_companies`
--

CREATE TABLE IF NOT EXISTS `fx_companies` (
  `co_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_ref` int(32) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `primary_contact` varchar(10) NOT NULL DEFAULT '-',
  `company_email` varchar(64) NOT NULL,
  `company_website` varchar(255) NOT NULL,
  `company_phone` varchar(64) NOT NULL,
  `company_address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(255) NOT NULL,
  `VAT` varchar(64) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`co_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Truncate table before insert `fx_companies`
--

TRUNCATE TABLE `fx_companies`;
--
-- Dumping data for table `fx_companies`
--

INSERT INTO `fx_companies` (`co_id`, `company_ref`, `company_name`, `primary_contact`, `company_email`, `company_website`, `company_phone`, `company_address`, `city`, `country`, `VAT`) VALUES
(1, 6746468, 'Envato Inc', '2', 'wm@gitbench.com', 'http://envato.com', '+123 456 7895', '34 Canopy Street', 'Melbourne', 'Australia', 'S3245'),
(2, 5218529, 'Gitbench Inc.', '4', 'wm@gitbench.com', 'http://gitbench.com', '+123 456 7895', '54 Churchill Road', 'Pretoria', 'South Africa', 'CA3248890767');

-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Table structure for table `fx_estimates`
--

CREATE TABLE IF NOT EXISTS `fx_estimates` (
  `est_id` int(11) NOT NULL AUTO_INCREMENT,
  `reference_no` varchar(32) CHARACTER SET latin1 NOT NULL,
  `client` varchar(64) CHARACTER SET latin1 NOT NULL,
  `due_date` varchar(40) CHARACTER SET latin1 NOT NULL,
  `notes` varchar(255) CHARACTER SET latin1 NOT NULL DEFAULT 'Looking forward for your business.',
  `tax` int(11) NOT NULL DEFAULT '0',
  `status` enum('Accepted','Declined','Pending') CHARACTER SET latin1 NOT NULL DEFAULT 'Pending',
  `date_sent` varchar(64) CHARACTER SET latin1 NOT NULL,
  `est_deleted` enum('Yes','No') CHARACTER SET latin1 NOT NULL DEFAULT 'No',
  `date_saved` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `emailed` enum('Yes','No') CHARACTER SET latin1 NOT NULL DEFAULT 'No',
  `invoiced` enum('Yes','No') CHARACTER SET latin1 DEFAULT 'No',
  PRIMARY KEY (`est_id`),
  UNIQUE KEY `reference_no` (`reference_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Truncate table before insert `fx_estimates`
--

TRUNCATE TABLE `fx_estimates`;
--
-- Dumping data for table `fx_estimates`
--

INSERT INTO `fx_estimates` (`est_id`, `reference_no`, `client`, `due_date`, `notes`, `tax`, `status`, `date_sent`, `est_deleted`, `emailed`, `invoiced`) VALUES
(1, 'EST14481', '2', '01-02-2015', 'Looking forward to doing business with you.', 21, 'Pending', '', 'No', 'No', 'No'),
(2, 'EST61173', '1', '19-10-2014', 'Looking forward to doing business with you.', 10, 'Pending', '2014-10-19 14:16:13', 'No', 'Yes', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `fx_estimate_items`
--

CREATE TABLE IF NOT EXISTS `fx_estimate_items` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `estimate_id` int(11) NOT NULL,
  `item_desc` varchar(200) CHARACTER SET latin1 NOT NULL,
  `unit_cost` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_cost` float NOT NULL,
  `date_saved` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Truncate table before insert `fx_estimate_items`
--

TRUNCATE TABLE `fx_estimate_items`;
--
-- Dumping data for table `fx_estimate_items`
--

INSERT INTO `fx_estimate_items` (`item_id`, `estimate_id`, `item_desc`, `unit_cost`, `quantity`, `total_cost`) VALUES
(1, 1, 'Domain SSL Installation', 150, 1, 150),
(2, 1, 'Laravel Web Application', 1200, 1, 1200),
(3, 2, 'Server Configuration', 120, 2, 240),
(4, 2, 'Application Installer', 120, 2, 240);

-- --------------------------------------------------------

--
-- Table structure for table `fx_files`
--

CREATE TABLE IF NOT EXISTS `fx_files` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `project` int(11) NOT NULL,
  `file_name` text CHARACTER SET latin1 NOT NULL,
  `description` text CHARACTER SET latin1 NOT NULL,
  `uploaded_by` int(11) NOT NULL,
  `date_posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `fx_files`
--

TRUNCATE TABLE `fx_files`;
-- --------------------------------------------------------

--
-- Table structure for table `fx_invoices`
--

CREATE TABLE IF NOT EXISTS `fx_invoices` (
  `inv_id` int(11) NOT NULL AUTO_INCREMENT,
  `reference_no` varchar(32) CHARACTER SET latin1 NOT NULL,
  `client` varchar(64) CHARACTER SET latin1 NOT NULL,
  `due_date` varchar(40) CHARACTER SET latin1 NOT NULL,
  `notes` varchar(255) CHARACTER SET latin1 NOT NULL DEFAULT 'A finance charge of 1.5% will be made on unpaid balances after due day.Thank you for your business.',
  `allow_paypal` enum('Yes','No') CHARACTER SET latin1 NOT NULL DEFAULT 'Yes',
  `tax` int(11) NOT NULL DEFAULT '0',
  `recurring` enum('Yes','No') CHARACTER SET latin1 NOT NULL DEFAULT 'No',
  `r_freq` int(11) NOT NULL DEFAULT '31',
  `currency` varchar(32) CHARACTER SET latin1 NOT NULL DEFAULT 'USD',
  `status` enum('Unpaid','Paid') CHARACTER SET latin1 NOT NULL DEFAULT 'Unpaid',
  `archived` int(11) NOT NULL DEFAULT '0',
  `date_sent` varchar(64) CHARACTER SET latin1 NOT NULL,
  `inv_deleted` enum('Yes','No') CHARACTER SET latin1 NOT NULL DEFAULT 'No',
  `date_saved` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `emailed` enum('Yes','No') CHARACTER SET latin1 NOT NULL DEFAULT 'No',
  PRIMARY KEY (`inv_id`),
  UNIQUE KEY `reference_no` (`reference_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Truncate table before insert `fx_invoices`
--

TRUNCATE TABLE `fx_invoices`;
--
-- Dumping data for table `fx_invoices`
--

INSERT INTO `fx_invoices` (`inv_id`, `reference_no`, `client`, `due_date`, `notes`, `allow_paypal`, `tax`, `recurring`, `r_freq`, `currency`, `status`, `archived`, `date_sent`, `inv_deleted`, `emailed`) VALUES
(1, 'INV348526', '1', '01-02-2015', 'Thank you for your business. Please process this invoice within the due date.', 'Yes', 21, 'No', 31, 'USD', 'Unpaid', 0, '2014-10-19 14:04:33', 'No', 'Yes'),
(2, 'INV983468', '2', '01-02-2015', 'Thank you for your business. Please process this invoice within the due date.', 'Yes', 21, 'No', 31, 'USD', 'Unpaid', 0, '', 'No', 'No');

-- --------------------------------------------------------

--
-- Truncate table before insert `fx_items`
--

TRUNCATE TABLE `fx_items`;
--
-- Dumping data for table `fx_items`
--

INSERT INTO `fx_items` (`item_id`, `invoice_id`, `item_desc`, `unit_cost`, `quantity`, `total_cost`) VALUES
(1, 2, 'Server Configuration', 120, 1, 120),
(2, 2, 'Email Setup', 45, 2, 90),
(3, 1, 'Theme Customization', 1200, 1, 1200);

-- --------------------------------------------------------

--
-- Table structure for table `fx_items_saved`
--

CREATE TABLE IF NOT EXISTS `fx_items_saved` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_desc` varchar(200) CHARACTER SET latin1 NOT NULL,
  `unit_cost` int(11) NOT NULL,
  `deleted` enum('Yes','No') CHARACTER SET latin1 DEFAULT 'No',
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Truncate table before insert `fx_items_saved`
--

TRUNCATE TABLE `fx_items_saved`;
--
-- Dumping data for table `fx_items_saved`
--

INSERT INTO `fx_items_saved` (`item_id`, `item_desc`, `unit_cost`, `deleted`) VALUES
(1, 'Wordpress Installation', 25, 'No'),
(2, 'Domain Setup with SSL', 450, 'No');

-- --------------------------------------------------------

--
-- Table structure for table `fx_login_attempts`
--

CREATE TABLE IF NOT EXISTS `fx_login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(40) COLLATE utf8_bin NOT NULL,
  `login` varchar(50) COLLATE utf8_bin NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `fx_login_attempts`
--

TRUNCATE TABLE `fx_login_attempts`;
-- --------------------------------------------------------

--
-- Table structure for table `fx_messages`
--

CREATE TABLE IF NOT EXISTS `fx_messages` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_to` int(11) NOT NULL,
  `user_from` int(11) NOT NULL,
  `message` text CHARACTER SET latin1 NOT NULL,
  `status` enum('Read','Unread') CHARACTER SET latin1 NOT NULL DEFAULT 'Unread',
  `attached_file` varchar(100) CHARACTER SET latin1 NOT NULL,
  `date_received` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` enum('Yes','No') CHARACTER SET latin1 NOT NULL DEFAULT 'No',
  PRIMARY KEY (`msg_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Truncate table before insert `fx_messages`
--

TRUNCATE TABLE `fx_messages`;
--
-- Dumping data for table `fx_messages`
--

INSERT INTO `fx_messages` (`msg_id`, `user_to`, `user_from`, `message`, `status`, `attached_file`,  `deleted`) VALUES
(1, 6, 7, 'Please send me the screenshots', 'Unread', '','No'),
(2, 7, 1, 'Send me the Project Please', 'Read', '', 'No'),
(3, 7, 1, 'Will get in touch later :)', 'Read', '',  'No'),
(4, 1, 7, 'Thanks for th work :)', 'Read', '',  'No'),
(5, 1, 7, 'Hello there :)', 'Read', '', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `fx_payments`
--

CREATE TABLE IF NOT EXISTS `fx_payments` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice` int(11) NOT NULL,
  `paid_by` int(11) NOT NULL,
  `payer_email` varchar(100) CHARACTER SET latin1 NOT NULL,
  `payment_method` varchar(64) CHARACTER SET latin1 NOT NULL,
  `amount` float NOT NULL,
  `trans_id` varchar(64) CHARACTER SET latin1 NOT NULL,
  `notes` varchar(255) CHARACTER SET latin1 NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `month_paid` varchar(32) CHARACTER SET latin1 NOT NULL,
  `year_paid` varchar(32) CHARACTER SET latin1 NOT NULL,
  `inv_deleted` enum('Yes','No') CHARACTER SET latin1 NOT NULL DEFAULT 'No',
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Truncate table before insert `fx_payments`
--

TRUNCATE TABLE `fx_payments`;
--
-- Dumping data for table `fx_payments`
--

INSERT INTO `fx_payments` (`p_id`, `invoice`, `paid_by`, `payer_email`, `payment_method`, `amount`, `trans_id`, `notes`, `month_paid`, `year_paid`, `inv_deleted`) VALUES
(1, 1, 1, '', '1', 900, '564934', 'Paid by William Levis', '10', '2014', 'No'),
(2, 2, 2, '', '1', 50, '362994', 'Paid by George Yuan via Mastercard', '10', '2014', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `fx_payment_methods`
--

CREATE TABLE IF NOT EXISTS `fx_payment_methods` (
  `method_id` int(11) NOT NULL AUTO_INCREMENT,
  `method_name` varchar(64) CHARACTER SET latin1 NOT NULL DEFAULT 'Paypal',
  PRIMARY KEY (`method_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Truncate table before insert `fx_payment_methods`
--

TRUNCATE TABLE `fx_payment_methods`;
--
-- Dumping data for table `fx_payment_methods`
--

INSERT INTO `fx_payment_methods` (`method_id`, `method_name`) VALUES
(1, 'Paypal'),
(2, 'Cash');

-- --------------------------------------------------------

--
-- Table structure for table `fx_projects`
--

CREATE TABLE IF NOT EXISTS `fx_projects` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_code` varchar(32) CHARACTER SET latin1 NOT NULL,
  `project_title` varchar(255) CHARACTER SET latin1 NOT NULL DEFAULT 'Project Title',
  `client` int(11) NOT NULL,
  `start_date` varchar(32) CHARACTER SET latin1 NOT NULL,
  `due_date` varchar(40) CHARACTER SET latin1 NOT NULL,
  `fixed_rate` enum('Yes','No') CHARACTER SET latin1 NOT NULL DEFAULT 'No',
  `hourly_rate` float NOT NULL,
  `fixed_price` float NOT NULL,
  `progress` int(11) NOT NULL,
  `notes` text CHARACTER SET latin1 NOT NULL,
  `assign_to` varchar(255) NOT NULL,
  `status` enum('On Hold','Active','Done') CHARACTER SET latin1 NOT NULL DEFAULT 'Active',
  `timer` enum('On','Off') CHARACTER SET latin1 NOT NULL DEFAULT 'Off',
  `timer_start` int(11) NOT NULL,
  `time_logged` int(11) NOT NULL,
  `proj_deleted` enum('Yes','No') CHARACTER SET latin1 NOT NULL DEFAULT 'No',
  `auto_progress` enum('TRUE','FALSE') CHARACTER SET latin1 NOT NULL DEFAULT 'FALSE',
  `estimate_hours` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Truncate table before insert `fx_projects`
--

TRUNCATE TABLE `fx_projects`;
--
-- Dumping data for table `fx_projects`
--

INSERT INTO `fx_projects` (`project_id`, `project_code`, `project_title`, `client`, `start_date`, `due_date`, `fixed_rate`, `hourly_rate`, `fixed_price`, `progress`, `notes`, `assign_to`, `status`, `timer`, `timer_start`, `time_logged`, `proj_deleted`, `auto_progress`, `estimate_hours`) VALUES
(1, 'PRO85924', 'Laravel Web Application', 2, '19-10-2014', '01-02-2015', 'No', 60, 0, 43, '', 'a:3:{i:0;s:1:"1";i:1;s:1:"6";i:2;s:1:"7";}', 'Active', 'Off', 0, 4372, 'No', 'FALSE', 300),
(2, 'PRO14189', 'Ruby RESTful API', 1, '19-10-2014', '01-02-2015', 'No', 50, 0, 0, '', 'a:2:{i:0;s:1:"6";i:1;s:1:"7";}', 'Active', 'Off', 0, 3700, 'No', 'FALSE', 30);

-- --------------------------------------------------------

--
-- Table structure for table `fx_project_timer`
--

CREATE TABLE IF NOT EXISTS `fx_project_timer` (
  `timer_id` int(11) NOT NULL AUTO_INCREMENT,
  `project` int(11) NOT NULL,
  `start_time` varchar(64) CHARACTER SET latin1 NOT NULL,
  `end_time` varchar(64) CHARACTER SET latin1 NOT NULL,
  `date_timed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`timer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Truncate table before insert `fx_project_timer`
--

TRUNCATE TABLE `fx_project_timer`;
--
-- Dumping data for table `fx_project_timer`
--

INSERT INTO `fx_project_timer` (`timer_id`, `project`, `start_time`, `end_time` ) VALUES
(1, 2, '1413754495', '1413758195'),
(2, 1, '1413753842', '1413758214');

-- --------------------------------------------------------

--
-- Table structure for table `fx_roles`
--

CREATE TABLE IF NOT EXISTS `fx_roles` (
  `r_id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(64) CHARACTER SET latin1 NOT NULL,
  `default` int(11) NOT NULL,
  PRIMARY KEY (`r_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Truncate table before insert `fx_roles`
--

TRUNCATE TABLE `fx_roles`;
--
-- Dumping data for table `fx_roles`
--

INSERT INTO `fx_roles` (`r_id`, `role`, `default`) VALUES
(1, 'admin', 1),
(2, 'client', 2),
(3, 'collaborator', 3);

-- --------------------------------------------------------

--
-- Table structure for table `fx_saved_tasks`
--

CREATE TABLE IF NOT EXISTS `fx_saved_tasks` (
  `template_id` int(11) NOT NULL AUTO_INCREMENT,
  `task_name` varchar(64) CHARACTER SET latin1 NOT NULL,
  `task_desc` varchar(255) CHARACTER SET latin1 NOT NULL,
  `visible` enum('Yes','No') CHARACTER SET latin1 NOT NULL DEFAULT 'Yes',
  `estimate_hours` float NOT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `saved_by` int(11) NOT NULL,
  PRIMARY KEY (`template_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Truncate table before insert `fx_saved_tasks`
--

TRUNCATE TABLE `fx_saved_tasks`;
--
-- Dumping data for table `fx_saved_tasks`
--

INSERT INTO `fx_saved_tasks` (`template_id`, `task_name`, `task_desc`, `visible`, `estimate_hours`, `saved_by`) VALUES
(1, 'API v1.0 callbacks', 'Description', 'Yes', 10,  1),
(2, 'Ruby Installer', 'Description', 'Yes', 50,  1);

-- --------------------------------------------------------

--
-- Table structure for table `fx_tasks`
--

CREATE TABLE IF NOT EXISTS `fx_tasks` (
  `t_id` int(11) NOT NULL AUTO_INCREMENT,
  `task_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `project` int(11) NOT NULL,
  `assigned_to` varchar(255) CHARACTER SET latin1 NOT NULL,
  `description` text CHARACTER SET latin1 NOT NULL,
  `visible` enum('Yes','No') CHARACTER SET latin1 NOT NULL DEFAULT 'Yes',
  `task_progress` int(11) NOT NULL DEFAULT '0',
  `timer_status` enum('On','Off') CHARACTER SET latin1 NOT NULL DEFAULT 'Off',
  `start_time` int(11) NOT NULL,
  `estimated_hours` int(11) NOT NULL,
  `logged_time` int(11) NOT NULL DEFAULT '0',
  `auto_progress` enum('TRUE','FALSE') CHARACTER SET latin1 NOT NULL DEFAULT 'FALSE',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `added_by` int(11) NOT NULL,
  PRIMARY KEY (`t_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Truncate table before insert `fx_tasks`
--

TRUNCATE TABLE `fx_tasks`;
--
-- Dumping data for table `fx_tasks`
--

INSERT INTO `fx_tasks` (`t_id`, `task_name`, `project`, `assigned_to`, `description`, `visible`, `task_progress`, `timer_status`, `start_time`, `estimated_hours`, `logged_time`, `auto_progress`,  `added_by`) VALUES
(1, 'Fix MySQL Authentication Error #2568', 1, 'a:1:{i:0;s:1:"1";}', 'Fix this please. Thanks', 'Yes', 50, 'Off', 0, 10, 0, 'FALSE',1),
(2, 'Web Application Installer', 1, 'a:1:{i:0;s:1:"6";}', 'Add Web Installer to the Application', 'Yes', 100, 'Off', 0, 5, 0, 'FALSE', 1),
(3, 'Shopping Cart', 1, '', '<blockquote>Add a shopping cart</blockquote>', 'Yes', 80, 'Off', 0, 10, 4503, 'FALSE', 7);

-- --------------------------------------------------------

--
-- Table structure for table `fx_tasks_timer`
--

CREATE TABLE IF NOT EXISTS `fx_tasks_timer` (
  `timer_id` int(11) NOT NULL AUTO_INCREMENT,
  `task` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `start_time` varchar(64) CHARACTER SET latin1 NOT NULL,
  `end_time` varchar(64) CHARACTER SET latin1 NOT NULL,
  `date_timed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`timer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Truncate table before insert `fx_tasks_timer`
--

TRUNCATE TABLE `fx_tasks_timer`;
--
-- Dumping data for table `fx_tasks_timer`
--

INSERT INTO `fx_tasks_timer` (`timer_id`, `task`, `pro_id`, `start_time`, `end_time`) VALUES
(1, 3, 1, '1413753907', '1413758410');

-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Table structure for table `fx_users`
--

CREATE TABLE IF NOT EXISTS `fx_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT '2',
  `activated` tinyint(1) NOT NULL DEFAULT '1',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `ban_reason` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `new_password_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `new_password_requested` datetime DEFAULT NULL,
  `new_email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `new_email_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=8 ;

--
-- Truncate table before insert `fx_users`
--

TRUNCATE TABLE `fx_users`;
--
-- Dumping data for table `fx_users`
--

INSERT INTO `fx_users` (`id`, `username`, `password`, `email`, `role_id`, `activated`, `banned`, `ban_reason`, `new_password_key`, `new_password_requested`, `new_email`, `new_email_key`, `last_ip`, `last_login`, `created`, `modified`) VALUES
(1, 'admin', '$P$B/5.ep8A/VHf/RJ3Bzcu6GvVC1QOhc/', 'billy@gitbench.com', 1, 1, 0, NULL, NULL, NULL, NULL, NULL, '154.122.63.23', '2014-10-19 21:55:39', '2014-10-19 20:44:38', '2014-10-19 21:55:39'),
(2, 'eric', '$P$BA5W1XwnoBzK9WqvPXlRKjCqDA1zd5/', 'john@gitbench.com', 2, 1, 0, NULL, NULL, NULL, NULL, NULL, '154.122.36.195', '2014-10-19 21:37:02', '2014-10-19 20:50:37', '2014-10-19 21:37:02'),
(3, 'suel', '$P$B2rqDAlsUWE6f5ad3nOG5mWZ9rq3S4.', 'sarah@gitbench.com', 2, 1, 0, NULL, NULL, NULL, NULL, NULL, '154.122.126.14', '2014-10-19 21:08:30', '2014-10-19 20:51:14', '2014-10-19 21:08:30'),
(4, 'maxl', '$P$BVTVSvMh1GArcV9TvINBXziNdZHCe1.', 'maxl@gitbench.com', 2, 1, 0, NULL, NULL, NULL, NULL, NULL, '154.122.108.237', '0000-00-00 00:00:00', '2014-10-19 20:54:14', '2014-10-19 20:54:14'),
(5, 'olivia', '$P$B1fYnZSgWPeaPSFemQo128G8BiRGrw1', 'olivia@gitbench.com', 2, 1, 0, NULL, NULL, NULL, NULL, NULL, '154.122.126.14', '2014-10-19 21:09:46', '2014-10-19 20:55:25', '2014-10-19 21:09:46'),
(6, 'riziki', '$P$BSTIaqelkNYOVa4iNHdfthn8b3uZXG0', 'wm@ticketbucket.net', 3, 1, 0, NULL, NULL, NULL, NULL, NULL, '154.122.36.195', '2014-10-19 21:35:17', '2014-10-19 20:57:14', '2014-10-19 21:35:17'),
(7, 'gitbench', '$P$BMnOujxCA.wxKx7OQGhKD9uEgFvAHx0', 'bs@bootstrapstore.net', 3, 1, 0, NULL, NULL, NULL, NULL, NULL, '154.122.63.23', '2014-10-19 21:52:54', '2014-10-19 20:59:13', '2014-10-19 21:52:54');

-- --------------------------------------------------------

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
