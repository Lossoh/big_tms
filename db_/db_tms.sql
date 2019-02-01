/*
Navicat MySQL Data Transfer

Source Server         : PHPMyAdmin
Source Server Version : 50611
Source Host           : 127.0.0.1:3306
Source Database       : db_tms

Target Server Type    : MYSQL
Target Server Version : 50611
File Encoding         : 65001

Date: 2019-01-19 14:40:30
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for activities
-- ----------------------------
DROP TABLE IF EXISTS `activities`;
CREATE TABLE `activities` (
  `activity_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_rowID` int(11) NOT NULL,
  `module` varchar(100) CHARACTER SET latin1 NOT NULL,
  `module_field_id` int(11) NOT NULL,
  `activity` varchar(255) CHARACTER SET latin1 NOT NULL,
  `activity_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `icon` varchar(32) CHARACTER SET latin1 DEFAULT 'fa-coffee',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`activity_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of activities
-- ----------------------------

-- ----------------------------
-- Table structure for activities_cancel_printed
-- ----------------------------
DROP TABLE IF EXISTS `activities_cancel_printed`;
CREATE TABLE `activities_cancel_printed` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `activity_rowID` int(11) NOT NULL,
  `remark` varchar(150) CHARACTER SET latin1 NOT NULL,
  `activity_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`rowID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of activities_cancel_printed
-- ----------------------------

-- ----------------------------
-- Table structure for ap_alloc_dtl
-- ----------------------------
DROP TABLE IF EXISTS `ap_alloc_dtl`;
CREATE TABLE `ap_alloc_dtl` (
  `ap_alloc_hdr_prefix` varchar(4) NOT NULL,
  `ap_alloc_hdr_year` int(6) NOT NULL,
  `ap_alloc_hdr_month` int(4) NOT NULL,
  `ap_alloc_hdr_code` int(11) NOT NULL,
  `row_no` int(11) NOT NULL,
  `alloc_type` char(1) NOT NULL,
  `alloc_amt` double(10,0) NOT NULL,
  `ap_trx_hdr_prefix` varchar(4) NOT NULL DEFAULT '',
  `ap_trx_hdr_year` int(11) NOT NULL DEFAULT '0',
  `ap_trx_hdr_month` int(11) NOT NULL DEFAULT '0',
  `ap_trx_hdr_code` int(11) NOT NULL DEFAULT '0',
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`ap_alloc_hdr_prefix`,`ap_alloc_hdr_year`,`ap_alloc_hdr_month`,`ap_alloc_hdr_code`,`row_no`),
  KEY `aralloc_key` (`ap_alloc_hdr_month`,`ap_alloc_hdr_year`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ap_alloc_dtl
-- ----------------------------

-- ----------------------------
-- Table structure for ap_alloc_hdr
-- ----------------------------
DROP TABLE IF EXISTS `ap_alloc_hdr`;
CREATE TABLE `ap_alloc_hdr` (
  `prefix` varchar(4) NOT NULL,
  `year` int(6) NOT NULL DEFAULT '0',
  `month` int(4) NOT NULL DEFAULT '0',
  `code` int(11) NOT NULL DEFAULT '0',
  `alloc_no` varchar(25) NOT NULL DEFAULT '',
  `alloc_date` date NOT NULL DEFAULT '1901-01-01',
  `creditor_rowID` int(11) NOT NULL DEFAULT '0',
  `alloc_amt` double(10,0) NOT NULL,
  `descs` varchar(60) NOT NULL DEFAULT '',
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`prefix`,`year`,`month`,`code`),
  KEY `aralloc_key` (`alloc_no`,`creditor_rowID`,`month`,`year`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ap_alloc_hdr
-- ----------------------------

-- ----------------------------
-- Table structure for ap_ledger
-- ----------------------------
DROP TABLE IF EXISTS `ap_ledger`;
CREATE TABLE `ap_ledger` (
  `prefix` varchar(4) NOT NULL DEFAULT '',
  `year` int(6) NOT NULL DEFAULT '0',
  `month` int(4) NOT NULL DEFAULT '0',
  `code` int(11) NOT NULL DEFAULT '0',
  `trx_no` varchar(25) NOT NULL,
  `trx_date` date NOT NULL DEFAULT '1901-01-01',
  `creditor_rowID` int(11) NOT NULL DEFAULT '0',
  `type` char(1) NOT NULL DEFAULT 'I',
  `descs` varchar(60) NOT NULL DEFAULT '',
  `trx_amt` double(10,0) NOT NULL,
  `ref_no` varchar(25) NOT NULL,
  `ref_date` date NOT NULL DEFAULT '1901-01-01',
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`prefix`,`year`,`month`,`code`),
  KEY `arledger_key` (`trx_no`,`creditor_rowID`,`month`,`year`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ap_ledger
-- ----------------------------

-- ----------------------------
-- Table structure for ap_trx_dtl
-- ----------------------------
DROP TABLE IF EXISTS `ap_trx_dtl`;
CREATE TABLE `ap_trx_dtl` (
  `prefix` varchar(4) NOT NULL,
  `year` int(4) NOT NULL,
  `month` int(2) NOT NULL,
  `code` int(11) NOT NULL,
  `row_no` int(11) NOT NULL DEFAULT '0',
  `base_amt` double(10,0) NOT NULL DEFAULT '0',
  `tax_amt` double(10,0) NOT NULL DEFAULT '0',
  `wth_amt` double(10,0) NOT NULL DEFAULT '0',
  `total_amt` double(10,0) NOT NULL DEFAULT '0',
  `descs` varchar(60) NOT NULL DEFAULT '',
  `wth_acc_rowID` smallint(11) NOT NULL DEFAULT '0',
  `tax_acc_rowID` smallint(11) NOT NULL DEFAULT '0',
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`prefix`,`year`,`month`,`code`,`row_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ap_trx_dtl
-- ----------------------------

-- ----------------------------
-- Table structure for ap_trx_dtl_do
-- ----------------------------
DROP TABLE IF EXISTS `ap_trx_dtl_do`;
CREATE TABLE `ap_trx_dtl_do` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `prefix` varchar(4) NOT NULL DEFAULT '',
  `year` smallint(4) NOT NULL DEFAULT '0',
  `month` smallint(2) NOT NULL DEFAULT '0',
  `code` bigint(11) NOT NULL DEFAULT '0',
  `trx_no` varchar(30) NOT NULL DEFAULT '',
  `tr_jo_trx_hdr_year` int(11) NOT NULL DEFAULT '0',
  `tr_jo_trx_hdr_month` int(11) NOT NULL DEFAULT '0',
  `tr_jo_trx_hdr_code` int(11) NOT NULL DEFAULT '0',
  `jo_no` varchar(25) NOT NULL DEFAULT '',
  `do_no` varchar(30) NOT NULL DEFAULT '',
  `container_row_no` tinyint(4) NOT NULL DEFAULT '0',
  `count_container` int(11) NOT NULL,
  `container_size` int(10) NOT NULL,
  `container_no` varchar(30) DEFAULT NULL,
  `police_no` varchar(15) NOT NULL,
  `do_date` date NOT NULL DEFAULT '1901-01-01',
  `deliver_date` date NOT NULL DEFAULT '1901-01-01',
  `deliver_weight` double NOT NULL DEFAULT '0',
  `received_date` date NOT NULL DEFAULT '1901-01-01',
  `received_weight` double NOT NULL DEFAULT '0',
  `amount_ap` double NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `invoice_date` date NOT NULL DEFAULT '1901-01-01',
  `invoice_no` varchar(25) NOT NULL DEFAULT '',
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL,
  `time_modified` time NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`,`prefix`,`year`,`month`,`code`,`do_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ap_trx_dtl_do
-- ----------------------------

-- ----------------------------
-- Table structure for ap_trx_hdr
-- ----------------------------
DROP TABLE IF EXISTS `ap_trx_hdr`;
CREATE TABLE `ap_trx_hdr` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `prefix` varchar(4) NOT NULL,
  `year` int(4) NOT NULL,
  `month` int(2) NOT NULL,
  `code` int(11) NOT NULL,
  `ap_kb_type` enum('ap','kb') NOT NULL,
  `trx_no` varchar(25) NOT NULL,
  `trx_date` date NOT NULL DEFAULT '1901-01-01',
  `top` tinyint(4) NOT NULL,
  `come_back` date NOT NULL,
  `ap_type` int(11) NOT NULL,
  `creditor_rowID` smallint(6) NOT NULL DEFAULT '0',
  `ref_no` varchar(35) NOT NULL DEFAULT '',
  `jo_no` varchar(25) NOT NULL,
  `po_no` varchar(35) DEFAULT NULL,
  `category` char(1) NOT NULL,
  `descs` varchar(60) NOT NULL DEFAULT '',
  `base_amt` double(10,0) NOT NULL DEFAULT '0',
  `tax_amt` double(10,0) NOT NULL DEFAULT '0',
  `wth_amt` double(10,0) NOT NULL DEFAULT '0',
  `total_amt` double(10,0) NOT NULL DEFAULT '0',
  `alloc_amt` decimal(10,0) NOT NULL DEFAULT '0',
  `bal_amt` decimal(10,0) NOT NULL DEFAULT '0',
  `total_ap` decimal(10,0) NOT NULL,
  `total_diff` decimal(10,0) NOT NULL,
  `without_tax` tinyint(4) NOT NULL,
  `ref_date` date NOT NULL DEFAULT '1901-01-01',
  `tr_jo_trx_hdr_year` int(4) NOT NULL DEFAULT '0',
  `tr_jo_trx_month` int(2) NOT NULL DEFAULT '0',
  `tr_jo_trx_code` int(11) NOT NULL DEFAULT '0',
  `verified` tinyint(4) NOT NULL,
  `user_verified` int(11) NOT NULL,
  `date_verified` date NOT NULL,
  `time_verified` time NOT NULL,
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`,`prefix`,`year`,`month`,`code`),
  KEY `artrx_key` (`trx_no`,`creditor_rowID`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ap_trx_hdr
-- ----------------------------

-- ----------------------------
-- Table structure for ap_trx_hdr_alloc
-- ----------------------------
DROP TABLE IF EXISTS `ap_trx_hdr_alloc`;
CREATE TABLE `ap_trx_hdr_alloc` (
  `prefix` varchar(4) NOT NULL DEFAULT '',
  `year` int(4) NOT NULL DEFAULT '0',
  `month` int(2) NOT NULL DEFAULT '0',
  `code` int(8) NOT NULL DEFAULT '0',
  `row_no` int(11) NOT NULL DEFAULT '0',
  `alloc_no` varchar(25) NOT NULL DEFAULT '',
  `alloc_date` date NOT NULL DEFAULT '1901-01-01',
  `descs` varchar(75) NOT NULL DEFAULT '',
  `alloc_amt` double NOT NULL DEFAULT '0',
  `ap_no` varchar(25) NOT NULL,
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`prefix`,`year`,`month`,`code`,`row_no`,`date_deleted`,`time_deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ap_trx_hdr_alloc
-- ----------------------------

-- ----------------------------
-- Table structure for ar_alloc_dtl
-- ----------------------------
DROP TABLE IF EXISTS `ar_alloc_dtl`;
CREATE TABLE `ar_alloc_dtl` (
  `ar_alloc_hdr_prefix` varchar(4) NOT NULL,
  `ar_alloc_hdr_year` int(6) NOT NULL,
  `ar_alloc_hdr_month` int(4) NOT NULL,
  `ar_alloc_hdr_code` int(11) NOT NULL,
  `row_no` int(11) NOT NULL,
  `alloc_type` char(1) NOT NULL,
  `alloc_amt` double(10,0) NOT NULL,
  `ar_trx_hdr_prefix` varchar(4) NOT NULL DEFAULT '',
  `ar_trx_hdr_year` int(4) NOT NULL DEFAULT '0',
  `ar_trx_hdr_month` int(2) NOT NULL DEFAULT '0',
  `ar_trx_hdr_code` int(6) NOT NULL DEFAULT '0',
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`ar_alloc_hdr_prefix`,`ar_alloc_hdr_year`,`ar_alloc_hdr_month`,`ar_alloc_hdr_code`,`row_no`),
  KEY `aralloc_key` (`ar_alloc_hdr_month`,`ar_alloc_hdr_year`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ar_alloc_dtl
-- ----------------------------

-- ----------------------------
-- Table structure for ar_alloc_hdr
-- ----------------------------
DROP TABLE IF EXISTS `ar_alloc_hdr`;
CREATE TABLE `ar_alloc_hdr` (
  `prefix` varchar(4) NOT NULL,
  `year` int(4) NOT NULL DEFAULT '0',
  `month` int(4) NOT NULL DEFAULT '0',
  `code` int(11) NOT NULL DEFAULT '0',
  `alloc_no` varchar(25) NOT NULL DEFAULT '',
  `alloc_date` date NOT NULL DEFAULT '1901-01-01',
  `debtor_rowID` int(11) NOT NULL DEFAULT '0',
  `alloc_amt` double(10,0) NOT NULL,
  `descs` varchar(60) NOT NULL DEFAULT '',
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`prefix`,`year`,`month`,`code`),
  KEY `aralloc_key` (`alloc_no`,`debtor_rowID`,`month`,`year`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ar_alloc_hdr
-- ----------------------------

-- ----------------------------
-- Table structure for ar_ledger
-- ----------------------------
DROP TABLE IF EXISTS `ar_ledger`;
CREATE TABLE `ar_ledger` (
  `prefix` varchar(4) NOT NULL DEFAULT '',
  `year` int(4) NOT NULL DEFAULT '0',
  `month` int(4) NOT NULL DEFAULT '0',
  `code` int(11) NOT NULL DEFAULT '0',
  `trx_no` varchar(25) NOT NULL,
  `trx_date` date NOT NULL DEFAULT '1901-01-01',
  `debtor_rowID` int(11) NOT NULL DEFAULT '0',
  `type` char(1) NOT NULL DEFAULT 'I',
  `descs` varchar(60) NOT NULL DEFAULT '',
  `trx_amt` double(10,0) NOT NULL,
  `ref_no` varchar(25) NOT NULL,
  `ref_date` date NOT NULL DEFAULT '1901-01-01',
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`prefix`,`year`,`month`,`code`),
  KEY `arledger_key` (`trx_no`,`debtor_rowID`,`month`,`year`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ar_ledger
-- ----------------------------

-- ----------------------------
-- Table structure for ar_trx_dtl
-- ----------------------------
DROP TABLE IF EXISTS `ar_trx_dtl`;
CREATE TABLE `ar_trx_dtl` (
  `row_detail_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ar_trx_hdr_prefix` varchar(4) NOT NULL,
  `ar_trx_hdr_year` int(4) NOT NULL,
  `ar_trx_hdr_month` int(2) NOT NULL,
  `ar_trx_hdr_code` int(11) NOT NULL,
  `ar_trx_no` varchar(25) NOT NULL,
  `row_no` int(11) NOT NULL DEFAULT '0',
  `income_rowID` int(11) NOT NULL,
  `input_amt` double NOT NULL DEFAULT '0',
  `base_amt` double NOT NULL DEFAULT '0',
  `include_vat` char(1) NOT NULL DEFAULT 'N',
  `tax_amt` double NOT NULL DEFAULT '0',
  `wth_rate_rowID` int(11) NOT NULL DEFAULT '0',
  `wth_amt` double NOT NULL DEFAULT '0',
  `total_amt` double NOT NULL DEFAULT '0',
  `descs` varchar(300) NOT NULL DEFAULT '',
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`row_detail_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ar_trx_dtl
-- ----------------------------

-- ----------------------------
-- Table structure for ar_trx_dtl_do
-- ----------------------------
DROP TABLE IF EXISTS `ar_trx_dtl_do`;
CREATE TABLE `ar_trx_dtl_do` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `trx_no` varchar(25) NOT NULL,
  `do_id` int(11) DEFAULT NULL,
  `ap_id` int(11) DEFAULT NULL,
  `price` double NOT NULL,
  `deleted` smallint(1) NOT NULL DEFAULT '0',
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`rowID`,`trx_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ar_trx_dtl_do
-- ----------------------------

-- ----------------------------
-- Table structure for ar_trx_dtl_do_manual
-- ----------------------------
DROP TABLE IF EXISTS `ar_trx_dtl_do_manual`;
CREATE TABLE `ar_trx_dtl_do_manual` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `prefix` varchar(4) NOT NULL DEFAULT '',
  `year` smallint(4) NOT NULL DEFAULT '0',
  `month` smallint(2) NOT NULL DEFAULT '0',
  `code` bigint(11) NOT NULL DEFAULT '0',
  `trx_no` varchar(30) NOT NULL DEFAULT '',
  `tr_jo_trx_hdr_year` int(11) NOT NULL DEFAULT '0',
  `tr_jo_trx_hdr_month` int(11) NOT NULL DEFAULT '0',
  `tr_jo_trx_hdr_code` int(11) NOT NULL DEFAULT '0',
  `jo_no` varchar(25) NOT NULL DEFAULT '',
  `do_no` varchar(30) NOT NULL DEFAULT '',
  `container_row_no` tinyint(4) NOT NULL DEFAULT '0',
  `count_container` int(11) NOT NULL,
  `container_size` int(10) NOT NULL,
  `container_no` varchar(30) DEFAULT NULL,
  `police_no` varchar(15) NOT NULL,
  `do_date` date NOT NULL DEFAULT '1901-01-01',
  `deliver_date` date NOT NULL DEFAULT '1901-01-01',
  `deliver_weight` int(11) NOT NULL DEFAULT '0',
  `received_date` date NOT NULL DEFAULT '1901-01-01',
  `received_weight` int(11) NOT NULL DEFAULT '0',
  `amount` double NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `invoice_date` date NOT NULL DEFAULT '1901-01-01',
  `invoice_no` varchar(25) NOT NULL DEFAULT '',
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL,
  `time_modified` time NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ar_trx_dtl_do_manual
-- ----------------------------

-- ----------------------------
-- Table structure for ar_trx_hdr
-- ----------------------------
DROP TABLE IF EXISTS `ar_trx_hdr`;
CREATE TABLE `ar_trx_hdr` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `prefix` varchar(4) NOT NULL,
  `year` int(4) NOT NULL,
  `month` int(2) NOT NULL,
  `code` int(11) NOT NULL,
  `trx_no` varchar(25) NOT NULL,
  `trx_date` date NOT NULL DEFAULT '1901-01-01',
  `debtor_rowID` smallint(6) NOT NULL DEFAULT '0',
  `category` char(1) NOT NULL DEFAULT 'I',
  `wholesale` tinyint(1) NOT NULL,
  `tax` tinyint(1) NOT NULL,
  `base_amt` double NOT NULL DEFAULT '0',
  `tax_amt` double NOT NULL DEFAULT '0',
  `wth_amt` double NOT NULL DEFAULT '0',
  `total_amt` double NOT NULL DEFAULT '0',
  `alloc_amt` double NOT NULL DEFAULT '0',
  `bal_amt` double NOT NULL DEFAULT '0',
  `ref_no` varchar(35) NOT NULL DEFAULT '',
  `ref_date` date NOT NULL DEFAULT '1901-01-01',
  `invoice_type` char(1) NOT NULL,
  `descs` varchar(60) NOT NULL DEFAULT '',
  `tr_jo_trx_hdr_year` int(4) NOT NULL DEFAULT '0',
  `tr_jo_trx_hdr_month` int(2) NOT NULL DEFAULT '0',
  `tr_jo_trx_hdr_code` int(11) NOT NULL DEFAULT '0',
  `jo_no` varchar(25) DEFAULT NULL,
  `gl_trx_hdr_prefix` varchar(3) NOT NULL DEFAULT '',
  `gl_trx_hdr_year` int(4) NOT NULL DEFAULT '0',
  `gl_trx_hdr_month` int(2) NOT NULL DEFAULT '0',
  `gl_trx_hdr_code` int(11) NOT NULL DEFAULT '0',
  `gl_trx_hdr_trx_no` varchar(25) NOT NULL DEFAULT '',
  `received_date` date NOT NULL,
  `received_no` varchar(25) NOT NULL,
  `due_date` date NOT NULL,
  `verified` tinyint(4) NOT NULL,
  `user_verified` int(11) NOT NULL,
  `date_verified` date NOT NULL,
  `time_verified` time NOT NULL,
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ar_trx_hdr
-- ----------------------------

-- ----------------------------
-- Table structure for ar_trx_hdr_alloc
-- ----------------------------
DROP TABLE IF EXISTS `ar_trx_hdr_alloc`;
CREATE TABLE `ar_trx_hdr_alloc` (
  `prefix` varchar(4) NOT NULL DEFAULT '',
  `year` int(4) NOT NULL DEFAULT '0',
  `month` int(2) NOT NULL DEFAULT '0',
  `code` int(8) NOT NULL DEFAULT '0',
  `row_no` int(11) NOT NULL DEFAULT '0',
  `alloc_no` varchar(25) NOT NULL DEFAULT '',
  `alloc_date` date NOT NULL DEFAULT '1901-01-01',
  `descs` varchar(75) NOT NULL DEFAULT '',
  `alloc_amt` double NOT NULL DEFAULT '0',
  `ar_no` varchar(25) NOT NULL,
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`prefix`,`year`,`month`,`code`,`row_no`,`date_deleted`,`time_deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ar_trx_hdr_alloc
-- ----------------------------

-- ----------------------------
-- Table structure for cb_balance
-- ----------------------------
DROP TABLE IF EXISTS `cb_balance`;
CREATE TABLE `cb_balance` (
  `year` int(4) NOT NULL,
  `month` int(2) NOT NULL,
  `coa_rowID` smallint(6) NOT NULL,
  `open_amt` double NOT NULL,
  `trx_amt` double NOT NULL,
  `bal_amt` double NOT NULL,
  PRIMARY KEY (`year`,`month`,`coa_rowID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cb_balance
-- ----------------------------

-- ----------------------------
-- Table structure for cb_balance_recon
-- ----------------------------
DROP TABLE IF EXISTS `cb_balance_recon`;
CREATE TABLE `cb_balance_recon` (
  `year` int(4) NOT NULL DEFAULT '0',
  `month` int(2) NOT NULL DEFAULT '0',
  `coa_rowID` smallint(6) NOT NULL,
  `open_recon_amt` double NOT NULL DEFAULT '0',
  `trx_recon_amt` double NOT NULL DEFAULT '0',
  `bal_recon_amt` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`year`,`month`,`coa_rowID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cb_balance_recon
-- ----------------------------

-- ----------------------------
-- Table structure for cb_cash_adv
-- ----------------------------
DROP TABLE IF EXISTS `cb_cash_adv`;
CREATE TABLE `cb_cash_adv` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `prefix` varchar(5) NOT NULL DEFAULT '',
  `year` int(4) NOT NULL DEFAULT '0',
  `month` int(2) NOT NULL DEFAULT '0',
  `code` int(8) NOT NULL DEFAULT '0',
  `trx_no` varchar(25) NOT NULL,
  `advance_no` varchar(25) NOT NULL DEFAULT '',
  `advance_date` date NOT NULL DEFAULT '1901-01-01',
  `advance_type_rowID` smallint(6) NOT NULL DEFAULT '0',
  `employee_driver_rowID` smallint(6) NOT NULL DEFAULT '0',
  `co_driver_rowID` smallint(6) NOT NULL,
  `vehicle_rowID` smallint(6) NOT NULL DEFAULT '0',
  `vehicle_type_rowID` smallint(6) NOT NULL DEFAULT '0',
  `fare_trip_rowID` int(11) NOT NULL DEFAULT '0',
  `split_status` int(1) NOT NULL,
  `dep_rowID` smallint(6) NOT NULL DEFAULT '0',
  `spk_item_rowID` int(11) NOT NULL,
  `spk_container_no` varchar(50) NOT NULL,
  `tr_jo_trx_hdr_year` int(4) NOT NULL,
  `tr_jo_trx_hdr_month` int(2) NOT NULL,
  `tr_jo_trx_hdr_code` int(8) NOT NULL,
  `barcode_no` varchar(6) NOT NULL,
  `advance_amount` double(12,0) NOT NULL DEFAULT '0',
  `advance_extra_amount` double(12,0) NOT NULL,
  `advance_allocation` double(12,0) NOT NULL DEFAULT '0',
  `advance_balance` double(12,0) NOT NULL DEFAULT '0',
  `pay_over_allocation` double NOT NULL DEFAULT '0',
  `description` varchar(255) NOT NULL DEFAULT '',
  `barcodeID` int(11) NOT NULL DEFAULT '0',
  `on_process` int(11) NOT NULL,
  `remark_deleted` varchar(255) DEFAULT NULL,
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`,`prefix`,`year`,`month`,`code`),
  KEY `cashadvkey` (`prefix`,`year`,`month`,`code`),
  KEY `rowID` (`rowID`),
  KEY `trx_no` (`trx_no`),
  KEY `advance_no` (`advance_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPRESSED;

-- ----------------------------
-- Records of cb_cash_adv
-- ----------------------------

-- ----------------------------
-- Table structure for cb_cash_adv_alloc
-- ----------------------------
DROP TABLE IF EXISTS `cb_cash_adv_alloc`;
CREATE TABLE `cb_cash_adv_alloc` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `prefix` varchar(4) NOT NULL DEFAULT '',
  `year` int(4) NOT NULL DEFAULT '0',
  `month` int(2) NOT NULL DEFAULT '0',
  `code` int(8) NOT NULL DEFAULT '0',
  `row_no` int(11) NOT NULL DEFAULT '0',
  `alloc_no` varchar(25) NOT NULL DEFAULT '',
  `alloc_date` date NOT NULL DEFAULT '1901-01-01',
  `descs` varchar(255) NOT NULL DEFAULT '',
  `alloc_amt` double NOT NULL DEFAULT '0',
  `alloc_mode` char(1) NOT NULL DEFAULT 'R',
  `commission_no` varchar(25) DEFAULT NULL,
  `cb_cash_adv_no` varchar(25) DEFAULT NULL,
  `cb_cash_adv_prefix` varchar(4) NOT NULL DEFAULT '',
  `cb_cash_adv_year` int(4) NOT NULL DEFAULT '0',
  `cb_cash_adv_month` int(2) NOT NULL DEFAULT '0',
  `cb_cash_adv_code` int(8) NOT NULL DEFAULT '0',
  `doc_sj` enum('Yes','No') NOT NULL,
  `doc_st` enum('Yes','No') NOT NULL,
  `doc_sm` enum('Yes','No') NOT NULL,
  `doc_sr` enum('Yes','No') NOT NULL,
  `status` tinyint(1) NOT NULL,
  `status_external` tinyint(1) NOT NULL,
  `reference_pok_no_1` varchar(25) NOT NULL,
  `reference_pok_no_2` varchar(25) NOT NULL,
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`,`prefix`,`year`,`month`,`code`,`row_no`,`alloc_no`,`date_deleted`,`time_deleted`),
  KEY `key` (`prefix`,`year`,`month`,`code`,`row_no`),
  KEY `alloc_no` (`alloc_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cb_cash_adv_alloc
-- ----------------------------

-- ----------------------------
-- Table structure for cb_cash_adv_ledger
-- ----------------------------
DROP TABLE IF EXISTS `cb_cash_adv_ledger`;
CREATE TABLE `cb_cash_adv_ledger` (
  `debtor_rowID` int(11) NOT NULL,
  `prefix` varchar(4) NOT NULL DEFAULT '',
  `year` int(4) NOT NULL DEFAULT '0',
  `month` int(2) NOT NULL DEFAULT '0',
  `code` int(8) NOT NULL DEFAULT '0',
  `trx_no` varchar(25) NOT NULL DEFAULT '',
  `trx_amt` double NOT NULL DEFAULT '0',
  `descs` varchar(60) NOT NULL DEFAULT '',
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`debtor_rowID`,`prefix`,`year`,`month`,`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cb_cash_adv_ledger
-- ----------------------------

-- ----------------------------
-- Table structure for cb_memo
-- ----------------------------
DROP TABLE IF EXISTS `cb_memo`;
CREATE TABLE `cb_memo` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `advance_no` varchar(25) NOT NULL,
  `memo_description` varchar(255) NOT NULL,
  `user_created` tinyint(4) NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`rowID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cb_memo
-- ----------------------------

-- ----------------------------
-- Table structure for cb_mf
-- ----------------------------
DROP TABLE IF EXISTS `cb_mf`;
CREATE TABLE `cb_mf` (
  `rowID` smallint(6) NOT NULL AUTO_INCREMENT,
  `coa_rowID` int(6) NOT NULL DEFAULT '0',
  `type` char(1) NOT NULL DEFAULT '',
  `coa_name` varchar(60) NOT NULL DEFAULT '',
  `bank_acc_no` varchar(35) NOT NULL DEFAULT '',
  `bank_acc_name` varchar(60) NOT NULL DEFAULT '',
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`,`coa_rowID`),
  KEY `rowID` (`rowID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cb_mf
-- ----------------------------

-- ----------------------------
-- Table structure for cb_trx_cg
-- ----------------------------
DROP TABLE IF EXISTS `cb_trx_cg`;
CREATE TABLE `cb_trx_cg` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `cb_trx_hdr_prefix` varchar(4) NOT NULL,
  `cb_trx_hdr_year` int(4) NOT NULL DEFAULT '0',
  `cb_trx_hdr_month` int(2) NOT NULL DEFAULT '0',
  `cb_trx_hdr_code` int(8) NOT NULL DEFAULT '0',
  `row_no` int(11) NOT NULL DEFAULT '0',
  `trx_no` varchar(25) NOT NULL,
  `payment_method` varchar(10) DEFAULT NULL,
  `cash_bank` int(11) DEFAULT NULL,
  `cg_no` varchar(25) NOT NULL DEFAULT '',
  `cg_date` date NOT NULL DEFAULT '1901-01-01',
  `coa_rowID` smallint(6) NOT NULL DEFAULT '0',
  `cg_amt` double(15,2) NOT NULL DEFAULT '0.00',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `reference_release_no` varchar(25) NOT NULL,
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`),
  KEY `cbtrx_key` (`cb_trx_hdr_prefix`,`cb_trx_hdr_year`,`cb_trx_hdr_month`,`cb_trx_hdr_code`) USING BTREE,
  KEY `trx_no` (`trx_no`),
  KEY `payment_method` (`payment_method`),
  KEY `status` (`status`),
  KEY `reference_release_no` (`reference_release_no`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cb_trx_cg
-- ----------------------------

-- ----------------------------
-- Table structure for cb_trx_dtl
-- ----------------------------
DROP TABLE IF EXISTS `cb_trx_dtl`;
CREATE TABLE `cb_trx_dtl` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `cb_trx_hdr_prefix` varchar(4) NOT NULL DEFAULT '',
  `cb_trx_hdr_year` int(4) NOT NULL DEFAULT '0',
  `cb_trx_hdr_month` int(2) NOT NULL DEFAULT '0',
  `cb_trx_hdr_code` int(8) NOT NULL DEFAULT '0',
  `row_no` int(6) NOT NULL DEFAULT '0',
  `trx_no` varchar(25) NOT NULL DEFAULT '',
  `trx_date` date NOT NULL DEFAULT '1901-01-01',
  `gl_coa_rowID` smallint(20) NOT NULL DEFAULT '0',
  `cost_rowID` smallint(6) NOT NULL DEFAULT '0',
  `advance_invoice_no` varchar(25) DEFAULT NULL,
  `advance_invoice_type` varchar(15) DEFAULT NULL,
  `advance_invoice_amount` double(15,2) DEFAULT NULL,
  `descs` varchar(255) NOT NULL DEFAULT '',
  `trx_amt` double(15,2) NOT NULL DEFAULT '0.00',
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`),
  KEY `cbtrx_key` (`cb_trx_hdr_prefix`,`cb_trx_hdr_year`,`cb_trx_hdr_month`,`cb_trx_hdr_code`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cb_trx_dtl
-- ----------------------------

-- ----------------------------
-- Table structure for cb_trx_hdr
-- ----------------------------
DROP TABLE IF EXISTS `cb_trx_hdr`;
CREATE TABLE `cb_trx_hdr` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `prefix` varchar(4) NOT NULL,
  `year` int(4) NOT NULL DEFAULT '0',
  `month` int(2) NOT NULL DEFAULT '0',
  `code` int(8) NOT NULL DEFAULT '0',
  `trx_no` varchar(25) NOT NULL DEFAULT '',
  `advance_invoice_trx_no` varchar(25) DEFAULT NULL,
  `advance_type_rowID` smallint(6) DEFAULT NULL,
  `trx_date` date NOT NULL DEFAULT '1901-01-01',
  `payment_type` char(1) DEFAULT NULL,
  `transaction_type` varchar(15) DEFAULT NULL,
  `coa_rowID` smallint(6) NOT NULL DEFAULT '0',
  `descs` varchar(255) NOT NULL DEFAULT '',
  `trx_amt` double(15,2) NOT NULL DEFAULT '0.00',
  `debtor_creditor_rowID` smallint(6) NOT NULL DEFAULT '0',
  `debtor_creditor_type` char(1) NOT NULL,
  `manual_debtor_creditor` varchar(50) NOT NULL DEFAULT '',
  `manual_debtor_creditor_type` char(1) DEFAULT NULL,
  `manual_ref_no` varchar(25) NOT NULL,
  `remark_deleted` varchar(255) DEFAULT NULL,
  `recon_status` char(1) NOT NULL DEFAULT 'N',
  `recon_date` date NOT NULL DEFAULT '1901-01-01',
  `cg_void_status` char(1) NOT NULL DEFAULT 'A',
  `cg_void_date` date NOT NULL DEFAULT '1901-01-01',
  `fund_trf_coa_rowID` int(11) NOT NULL DEFAULT '0',
  `fund_trf` char(1) NOT NULL DEFAULT 'N',
  `branch` smallint(1) NOT NULL,
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`,`prefix`,`year`,`month`,`code`),
  KEY `cbtrx_key` (`prefix`,`year`,`month`,`code`) USING BTREE,
  KEY `rowID` (`rowID`),
  KEY `advance_invoice_trx_no` (`advance_invoice_trx_no`),
  KEY `trx_no` (`trx_no`),
  KEY `coa_rowID` (`coa_rowID`),
  KEY `deleted` (`deleted`),
  KEY `date_created` (`date_created`),
  KEY `time_created` (`time_created`),
  KEY `fund_trf_coa_rowID` (`fund_trf_coa_rowID`),
  KEY `trx_date` (`trx_date`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cb_trx_hdr
-- ----------------------------

-- ----------------------------
-- Table structure for glmaster
-- ----------------------------
DROP TABLE IF EXISTS `glmaster`;
CREATE TABLE `glmaster` (
  `COM` varchar(3) DEFAULT NULL,
  `BRAN` varchar(2) DEFAULT NULL,
  `ACMAIN` varchar(3) DEFAULT NULL,
  `ACSUB` varchar(2) DEFAULT NULL,
  `ACSUBSUB` varchar(2) DEFAULT NULL,
  `CC` varchar(2) DEFAULT NULL,
  `CUR` varchar(3) DEFAULT NULL,
  `ACNAME` varchar(50) DEFAULT NULL,
  `AT` varchar(1) DEFAULT NULL,
  `NB` varchar(1) DEFAULT NULL,
  `FL` varchar(1) DEFAULT NULL,
  `PCOM` varchar(3) DEFAULT NULL,
  `PBRAN` varchar(2) DEFAULT NULL,
  `PMAIN` varchar(3) DEFAULT NULL,
  `PSUB` varchar(2) DEFAULT NULL,
  `PSUBSUB` varchar(2) DEFAULT NULL,
  `PCC` varchar(2) DEFAULT NULL,
  `PCUR` varchar(3) DEFAULT NULL,
  `PFL` varchar(1) DEFAULT NULL,
  `CSFLR` varchar(4) DEFAULT NULL,
  `CSFLD` varchar(4) DEFAULT NULL,
  `BPY01` double DEFAULT NULL,
  `BPY02` double DEFAULT NULL,
  `BPY03` double DEFAULT NULL,
  `BPY04` double DEFAULT NULL,
  `BPY05` double DEFAULT NULL,
  `BPY06` double DEFAULT NULL,
  `BPY07` double DEFAULT NULL,
  `BPY08` double DEFAULT NULL,
  `BPY09` double DEFAULT NULL,
  `BPY10` double DEFAULT NULL,
  `BPY11` double DEFAULT NULL,
  `BPY12` double DEFAULT NULL,
  `BCY01` double DEFAULT NULL,
  `BCY02` double DEFAULT NULL,
  `BCY03` double DEFAULT NULL,
  `BCY04` double DEFAULT NULL,
  `BCY05` double DEFAULT NULL,
  `BCY06` double DEFAULT NULL,
  `BCY07` double DEFAULT NULL,
  `BCY08` double DEFAULT NULL,
  `BCY09` double DEFAULT NULL,
  `BCY10` double DEFAULT NULL,
  `BCY11` double DEFAULT NULL,
  `BCY12` double DEFAULT NULL,
  `BNY01` double DEFAULT NULL,
  `BNY02` double DEFAULT NULL,
  `BNY03` double DEFAULT NULL,
  `BNY04` double DEFAULT NULL,
  `BNY05` double DEFAULT NULL,
  `BNY06` double DEFAULT NULL,
  `BNY07` double DEFAULT NULL,
  `BNY08` double DEFAULT NULL,
  `BNY09` double DEFAULT NULL,
  `BNY10` double DEFAULT NULL,
  `BNY11` double DEFAULT NULL,
  `BNY12` double DEFAULT NULL,
  `APYBEG` double DEFAULT NULL,
  `APY01` double DEFAULT NULL,
  `APY02` double DEFAULT NULL,
  `APY03` double DEFAULT NULL,
  `APY04` double DEFAULT NULL,
  `APY05` double DEFAULT NULL,
  `APY06` double DEFAULT NULL,
  `APY07` double DEFAULT NULL,
  `APY08` double DEFAULT NULL,
  `APY09` double DEFAULT NULL,
  `APY10` double DEFAULT NULL,
  `APY11` double DEFAULT NULL,
  `APY12` double DEFAULT NULL,
  `ACYBEG` double DEFAULT NULL,
  `ACYD00` double DEFAULT NULL,
  `ACYK00` double DEFAULT NULL,
  `ACYD01` double DEFAULT NULL,
  `ACYK01` double DEFAULT NULL,
  `ACYD02` double DEFAULT NULL,
  `ACYK02` double DEFAULT NULL,
  `ACYD03` double DEFAULT NULL,
  `ACYK03` double DEFAULT NULL,
  `ACYD04` double DEFAULT NULL,
  `ACYK04` double DEFAULT NULL,
  `ACYD05` double DEFAULT NULL,
  `ACYK05` double DEFAULT NULL,
  `ACYD06` double DEFAULT NULL,
  `ACYK06` double DEFAULT NULL,
  `ACYD07` double DEFAULT NULL,
  `ACYK07` double DEFAULT NULL,
  `ACYD08` double DEFAULT NULL,
  `ACYK08` double DEFAULT NULL,
  `ACYD09` double DEFAULT NULL,
  `ACYK09` double DEFAULT NULL,
  `ACYD10` double DEFAULT NULL,
  `ACYK10` double DEFAULT NULL,
  `ACYD11` double DEFAULT NULL,
  `ACYK11` double DEFAULT NULL,
  `ACYD12` double DEFAULT NULL,
  `ACYK12` double DEFAULT NULL,
  `F1` varchar(4) DEFAULT NULL,
  `F2` varchar(4) DEFAULT NULL,
  `F3` varchar(4) DEFAULT NULL,
  `F4` varchar(4) DEFAULT NULL,
  `F5` varchar(4) DEFAULT NULL,
  `KOL_CS_SEG` int(11) DEFAULT NULL,
  `KOL_IS_SEG` int(11) DEFAULT NULL,
  `GOLONGAN` varchar(10) DEFAULT NULL,
  `JUDUL` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of glmaster
-- ----------------------------

-- ----------------------------
-- Table structure for gl_balance
-- ----------------------------
DROP TABLE IF EXISTS `gl_balance`;
CREATE TABLE `gl_balance` (
  `fyear` smallint(4) NOT NULL DEFAULT '0',
  `fmonth` smallint(4) NOT NULL DEFAULT '0',
  `coa_rowID` smallint(4) NOT NULL DEFAULT '0',
  `open_amt` double NOT NULL DEFAULT '0',
  `trx_amt` double NOT NULL DEFAULT '0',
  `bal_amt` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`fyear`,`fmonth`,`coa_rowID`),
  KEY `glbal_key` (`coa_rowID`,`fyear`,`fmonth`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of gl_balance
-- ----------------------------

-- ----------------------------
-- Table structure for gl_coa
-- ----------------------------
DROP TABLE IF EXISTS `gl_coa`;
CREATE TABLE `gl_coa` (
  `rowID` smallint(6) NOT NULL AUTO_INCREMENT,
  `acc_cd` varchar(20) NOT NULL DEFAULT '',
  `acc_name` varchar(60) NOT NULL DEFAULT '',
  `acc_type` char(1) NOT NULL DEFAULT 'D',
  `acc_debit_credit` enum('debit','credit') DEFAULT NULL,
  `acc_class` char(1) NOT NULL DEFAULT '',
  `acc_level` tinyint(6) NOT NULL DEFAULT '0',
  `acc_sub_of_rowID` smallint(6) NOT NULL DEFAULT '0',
  `acc_condition` tinyint(2) NOT NULL,
  `acc_profit_loss` tinyint(2) NOT NULL,
  `cash_branch` tinyint(2) NOT NULL,
  `is_cb` char(1) NOT NULL DEFAULT 'N',
  `is_cash` char(1) NOT NULL DEFAULT 'N',
  `is_bank` char(1) NOT NULL DEFAULT 'N',
  `is_vat_in` char(1) NOT NULL DEFAULT 'N',
  `is_vat_out` char(1) NOT NULL DEFAULT 'N',
  `acc_transition` char(1) NOT NULL DEFAULT 'N',
  `active` char(1) NOT NULL DEFAULT 'Y',
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`,`acc_cd`),
  KEY `rowID` (`rowID`)
) ENGINE=InnoDB AUTO_INCREMENT=197 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of gl_coa
-- ----------------------------
INSERT INTO `gl_coa` VALUES ('1', '1', 'AKTIVA', 'H', null, 'A', '1', '0', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '11', '2016-09-05', '17:10:55', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('2', '1.01', 'AKTIVA LANCAR', 'H', null, 'A', '2', '1', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '11', '2016-09-05', '17:11:34', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('3', '1.01.01', 'KAS BANK', 'H', null, 'A', '3', '2', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '11', '2016-09-05', '17:13:34', '11', '2016-09-05', '17:16:39', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('4', '1.01.01.01', 'KAS', 'H', null, 'A', '4', '3', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '11', '2016-09-05', '17:15:54', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('5', '1.01.01.01.01', 'KAS BESAR', 'D', null, 'A', '5', '4', '0', '0', '0', 'N', 'Y', 'N', 'Y', 'Y', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '11', '2016-09-05', '17:17:42', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('6', '1.01.01.01.02', 'KAS KECIL PST', 'D', null, 'A', '5', '4', '0', '0', '0', 'N', 'Y', 'N', 'Y', 'Y', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '11', '2016-09-05', '17:20:52', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('7', '1.01.01.01.03', 'DEPOSITO', 'D', null, 'A', '5', '4', '0', '0', '0', 'N', 'Y', 'N', 'Y', 'Y', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '11', '2016-09-05', '17:21:52', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('8', '1.01.01.01.04', 'KAS KECIL SB', 'D', null, 'A', '5', '4', '0', '0', '1', 'N', 'Y', 'N', 'Y', 'Y', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '11', '2016-09-05', '17:23:09', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('9', '1.01.01.01.05', 'KAS KECIL HLC DAN PRK', 'D', null, 'A', '5', '4', '0', '0', '1', 'N', 'Y', 'N', 'Y', 'Y', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '11', '2016-09-05', '17:24:22', '1', '2016-11-22', '11:35:29', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('10', '1.01.01.01.99', 'AYAT SILANG', 'D', null, 'A', '5', '4', '0', '0', '0', 'N', 'Y', 'N', 'Y', 'Y', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '11', '2016-09-05', '17:25:27', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('11', '1.01.01.02', 'BANK', 'H', null, 'A', '4', '3', '0', '0', '0', 'Y', 'N', 'N', 'N', 'N', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '11', '2016-09-05', '17:26:13', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('12', '1.01.01.02.01', 'BANK MANDIRI 125.001.162.517.5', 'D', null, 'A', '5', '11', '0', '0', '0', 'Y', 'N', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '16:21:11', '4', '2016-09-08', '16:22:46', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('13', '1.01.01.02.02', 'MAYBANK - OPR 2288201368', 'D', null, 'A', '5', '11', '0', '0', '0', 'Y', 'N', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '16:26:27', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('14', '1.01.01.02.03', 'BCA 8400106488', 'D', null, 'A', '5', '11', '0', '0', '0', 'Y', 'N', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '16:27:28', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('15', '1.01.01.02.04', 'MANDIRI ESCROW 125.001.163.502.6', 'D', null, 'A', '5', '11', '0', '0', '0', 'Y', 'N', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '16:28:26', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('16', '1.01.01.02.05', 'MAYBANK - JII 2001521014', 'D', null, 'A', '5', '11', '0', '0', '0', 'Y', 'N', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '16:33:15', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('17', '1.01.02', 'PIUTANG', 'H', null, 'A', '3', '0', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '17:08:36', '4', '2016-09-08', '17:10:08', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('18', '1.01.02.01', 'PIUTANG USAHA', 'H', null, 'A', '4', '17', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '17:11:36', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('19', '1.01.02.01.01', 'PIUTANG CUSTOMER', 'D', null, 'A', '5', '18', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '17:12:31', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('20', '1.01.02.01.02', 'PIUTANG CHEQUE / BILYET GIRO TERIMA MUNDUR', 'D', null, 'A', '5', '18', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '17:14:15', '4', '2016-09-08', '17:14:48', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('21', '1.01.02.01.03', 'PIUTANG LAIN-LAIN', 'D', null, 'A', '5', '18', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '17:16:16', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('22', '1.01.02.02', 'PIUTANG LAIN-LAIN', 'H', null, 'A', '4', '17', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '17:18:52', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('23', '1.01.02.02.01', 'PIUTANG DIREKSI', 'D', null, 'A', '5', '22', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '17:19:41', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('24', '1.01.02.02.02', 'PIUTANG KARYAWAN', 'D', null, 'A', '5', '22', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '17:20:26', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('25', '1.01.02.02.03', 'PIUTANG SUPIR', 'D', null, 'A', '5', '22', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '17:21:10', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('26', '1.01.02.02.04', 'PIUTANG AFILIASI', 'D', null, 'A', '5', '22', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '17:21:46', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('27', '1.01.02.02.05', 'PIUTANG ADV', 'D', null, 'A', '5', '22', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '17:22:28', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('28', '1.01.02.02.06', 'PIUTANG ANGKUTAN A9039FL ', 'D', null, 'A', '5', '22', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '17:23:43', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('29', '1.01.02.02.07', 'PIUTANG ANGKUTAN B9404BYW ', 'D', null, 'A', '5', '22', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '17:24:53', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('30', '1.01.02.02.08', 'PIUTANG ANGKUTAN LANCAR', 'D', null, 'A', '5', '22', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '17:25:47', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('31', '1.01.02.03', 'PIUTANG TAK TERTAGIH', 'H', null, 'A', '4', '17', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '17:26:56', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('32', '1.01.02.03.01', 'PIUTANG TAK TERTAGIH PT.TIK', 'D', null, 'A', '5', '31', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '17:28:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('33', '1.01.02.03.02', 'PIUTANG TAK TERTAGIH PT.TAS', 'D', null, 'A', '5', '31', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '17:28:31', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('34', '1.01.02.03.03', 'PIUTANG TAK TERTAGIH PT.SMJ', 'D', null, 'A', '5', '31', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '17:29:10', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('35', '1.01.02.03.09', 'PENGHAPUSAN PIUTANG TAK TERTAGIH', 'D', null, 'A', '5', '31', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '17:30:04', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('36', '1.01.03', 'UANG MUKA', 'H', null, 'A', '3', '2', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '17:33:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('37', '1.01.03.01', 'UANG MUKA', 'H', null, 'A', '4', '0', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '17:34:43', '4', '2016-09-08', '17:37:07', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('38', '1.01.03.02', 'BIAYA DIBAYAR DIMUKA', 'H', null, 'A', '4', '0', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '17:35:26', '4', '2016-09-08', '18:08:48', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('39', '1.01.03.01.01', 'UANG MUKA OPERASIONAL', 'D', null, 'A', '5', '37', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '17:38:47', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('40', '1.01.03.01.02', 'UANG MUKA UMUM', 'D', null, 'A', '5', '37', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '17:39:30', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('41', '1.01.04', 'PAJAK', 'H', null, 'A', '3', '2', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '17:54:54', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('42', '1.01.04.01', 'PPH 21', 'D', null, 'A', '4', '41', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '17:55:28', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('43', '1.01.04.02', 'PPH 22', 'D', null, 'A', '4', '41', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '17:55:58', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('44', '1.01.04.03', 'PPH 23', 'D', null, 'A', '4', '41', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '17:56:22', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('45', '1.01.04.04', 'PPH 25', 'D', null, 'A', '4', '41', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '17:57:14', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('46', '1.01.04.05', 'PPN MASUKAN', 'D', null, 'A', '4', '41', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '17:57:44', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('47', '1.01.04.06', 'PPN YG DITANGGUHKAN', 'D', null, 'A', '4', '41', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '17:58:23', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('48', '1.02', 'AKTIVA TETAP', 'H', null, 'A', '2', '1', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '17:59:04', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('49', '1.02.01', 'NILAI PEROLEHAN', 'H', null, 'A', '3', '48', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '17:59:35', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('50', '1.02.01.01', 'TANAH', 'D', null, 'A', '4', '49', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:00:08', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('51', '1.02.01.02', 'BANGUNAN', 'D', null, 'A', '4', '49', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:02:38', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('52', '1.02.01.03', 'INVENTARIS KANTOR', 'D', null, 'A', '4', '49', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:04:15', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('53', '1.02.01.04', 'KENDARAAN BERMOTOR', 'D', null, 'A', '4', '49', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:05:53', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('54', '1.02.01.05', 'PERALATAN KANTOR', 'D', null, 'A', '4', '49', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:06:31', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('55', '1.02.01.06', 'PERLATAN BERAT', 'D', null, 'A', '4', '49', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:07:15', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('56', '1.02.01.07', 'MESIN', 'D', null, 'A', '4', '49', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:07:50', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('57', '1.01.03.02.01', 'BIAYA ASURANSI', 'D', null, 'A', '5', '38', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:09:34', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('58', '1.01.03.02.02', 'SEWA DIBAYAR DIMUKA', 'D', null, 'A', '5', '38', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:10:09', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('59', '1.01.03.02.03', 'BIAYA LAIN-LAIN', 'D', null, 'A', '5', '38', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:11:04', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('60', '1.01.03.02.04', 'BIAYA DIBAYAR DIMUKA', 'D', null, 'A', '5', '38', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:11:45', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('61', '1.02.02', 'AKUMULASI PENYUSUTAN', 'H', null, 'A', '3', '48', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:13:25', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('62', '1.02.02.01', 'AP. BANGUNAN', 'D', null, 'A', '4', '61', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:14:06', '4', '2016-09-08', '18:15:31', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('63', '1.02.02.02', 'AP. INVENTARIS KANTOR', 'D', null, 'A', '4', '61', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:14:48', '4', '2016-09-08', '18:15:51', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('64', '1.02.02.03', 'AP. KENDARAAN BERMOTOR', 'D', null, 'A', '4', '61', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:16:16', '4', '2016-09-09', '09:11:37', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('65', '1.02.02.04', 'AP. PERALATAN KANTOR', 'D', null, 'A', '4', '61', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:16:51', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('66', '1.02.02.05', 'AP. PERALATAN BERAT', 'D', null, 'A', '4', '61', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:17:43', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('67', '1.02.02.06', 'AP. MESIN', 'D', null, 'A', '4', '61', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:18:18', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('68', '1.02.03', 'UANG MUKA ASSET', 'H', null, 'A', '3', '48', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:18:55', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('69', '1.02.03.01', 'UANG MUKA ASSET', 'D', null, 'A', '4', '68', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:20:02', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('70', '1.03', 'AKTIVA LAINNYA', 'H', null, 'A', '2', '1', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:21:08', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('71', '1.03.01', 'AKTIVA LAINNYA', 'H', null, 'A', '3', '70', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:21:42', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('72', '1.03.01.01', 'BIAYA PRA OPERASI', 'D', null, 'A', '4', '71', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:22:11', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('73', '1.03.01.02', 'AKUMULASI AMORTISASI', 'D', null, 'A', '4', '71', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:22:48', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('74', '2', 'KEWAJIBAN', 'H', null, 'L', '1', '0', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:23:31', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('75', '2.01', 'KEWAJIBAN JANGKA PENDEK', 'H', null, 'L', '2', '74', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:24:07', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('76', '2.01.01', 'HUTANG USAHA', 'H', null, 'L', '3', '75', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:24:46', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('77', '2.01.01.01', 'HUTANG OUTSTANDING CEK', 'H', null, 'L', '4', '76', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:25:26', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('78', '2.01.01.01.01', 'HUTANG OUTSTANDING MANDIRI', 'D', null, 'L', '5', '77', '0', '0', '0', 'N', 'N', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:26:06', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('79', '2.01.01.01.02', 'HUTANG OUTSTANDING MAYBANK', 'D', null, 'L', '5', '77', '0', '0', '0', 'N', 'N', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:26:51', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('80', '2.01.01.01.03', 'HUTANG OUTSTANDING BCA', 'D', null, 'L', '5', '77', '0', '0', '0', 'N', 'N', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:27:37', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('81', '2.01.01.01.04', 'HUTANG OUTSTANDING MAYBANK-JII', 'D', null, 'L', '5', '77', '0', '0', '0', 'N', 'N', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:28:07', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('82', '2.01.01.02', 'HUTANG SUPPLIER', 'H', null, 'L', '4', '76', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:29:16', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('83', '2.01.01.02.01', 'HUTANG SUPLIER (EXT)', 'D', null, 'L', '5', '82', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:30:33', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('84', '2.01.01.02.02', 'HUTANG SUPPLIER (INT)', 'D', null, 'L', '5', '82', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:31:03', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('85', '2.01.02', 'HUTANG PAJAK', 'H', null, 'L', '3', '75', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:31:39', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('86', '2.01.02.01', 'PPH PSL 21', 'D', null, 'L', '4', '85', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:32:23', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('87', '2.01.02.02', 'PPH PSL 22', 'D', null, 'L', '4', '85', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:32:57', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('88', '2.01.02.03', 'PPH PSL 23', 'D', null, 'L', '4', '85', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:33:20', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('89', '2.01.02.04', 'PPH PSL 25', 'D', null, 'L', '4', '85', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:33:53', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('90', '2.01.02.05', 'PPN', 'D', null, 'L', '4', '85', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:34:15', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('91', '2.01.03', 'HTG UANG MUKA', 'H', null, 'L', '3', '75', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:34:48', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('92', '2.01.03.01', 'HUTANG U/M', 'D', null, 'L', '4', '91', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:35:17', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('93', '2.01.03.02', 'HUTANG U/M ONGKS.ANGKUT P\'FEBRI', 'D', null, 'L', '4', '91', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:36:04', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('94', '2.01.03.03', 'HUTANG U/M ONGKOS ANGKUT P\'ALDI', 'D', null, 'L', '4', '91', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:36:59', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('95', '2.01.03.04', 'HUTANG U/M ONGKOS ANGKUT ANG.LANCAR', 'D', null, 'L', '4', '91', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:37:39', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('96', '2.01.04', 'BIAYA YG MSH HRS DIBAYAR', 'H', null, 'L', '3', '75', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:38:17', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('97', '2.01.04.01', 'BIAYA BUNGA YG TERUTANG', 'D', null, 'L', '4', '96', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:38:47', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('98', '2.01.04.02', 'BIAYA JASA PROFESIONAL', 'D', null, 'L', '4', '96', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:39:17', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('99', '2.01.04.03', 'BIAYA GAJI TERUTANG', 'D', null, 'L', '4', '96', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:39:42', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('100', '2.01.04.04', 'BIAYA LISTRIK TERUTANG', 'D', null, 'L', '4', '96', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:40:09', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('101', '2.01.05', 'HUTANG PIHAK KETIGA', 'H', null, 'L', '3', '75', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:40:56', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('102', '2.01.05.01', 'HUTANG PEMEGANG SAHAM', 'D', null, 'L', '4', '101', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:41:24', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('103', '2.01.05.02', 'HUTANG PT.TIK', 'D', null, 'L', '4', '101', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:41:51', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('104', '2.01.05.03', 'HUTANG BPK. JOHNI INDRA IRSYAD', 'D', null, 'L', '4', '101', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:42:33', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('105', '2.01.05.04', 'HUTANG PT.SMJ', 'D', null, 'L', '4', '101', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:43:03', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('106', '2.01.05.05', 'HUTANG PT.BIG-PBM', 'D', null, 'L', '4', '101', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:44:18', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('107', '2.01.05.06', 'HUTANG PT.THS', 'D', null, 'L', '4', '101', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:44:43', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('108', '2.01.05.07', 'HUTANG BPK. ISMANTO', 'D', null, 'L', '4', '101', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:45:25', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('109', '2.01.05.08', 'HUTANG PT.TAS', 'D', null, 'L', '4', '101', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:46:02', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('110', '2.01.05.09', 'HUTANG BPK. LAUW HARTANTO', 'D', null, 'L', '4', '101', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:46:41', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('111', '2.02', 'KEWAJIBAN JANGKA PANJANG', 'H', null, 'L', '2', '74', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:47:12', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('112', '2.02.01', 'HUTANG BANK', 'H', null, 'L', '3', '111', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:48:02', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('113', '2.02.01.01', 'HUTANG BANK MANDIRI', 'D', null, 'L', '4', '112', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:48:41', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('114', '2.02.01.02', 'HUTANG MAYBANK-OPR', 'D', null, 'L', '4', '112', '0', '0', '0', 'N', 'N', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:49:28', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('115', '2.02.01.03', 'HUTANG MAYBANK-JII', 'D', null, 'L', '4', '112', '0', '0', '0', 'N', 'N', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:50:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('116', '2.02.02', 'HUTANG LAIN-LAIN', 'H', null, 'L', '3', '111', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:51:01', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('117', '2.02.02.01', 'HUTANG LEASING', 'D', null, 'L', '4', '116', '0', '0', '0', 'N', 'N', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:52:17', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('118', '2.02.02.02', 'HUTANG AFILIASI JP', 'D', null, 'L', '4', '116', '0', '0', '0', 'N', 'N', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:52:53', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('119', '4', 'PENDAPATAN', 'H', null, 'I', '1', '0', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:53:46', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('120', '4.01', 'PENDAPATAN USAHA', 'H', null, 'I', '2', '119', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:57:02', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('121', '4.01.01', 'PENDAPATAN JASA USAHA', 'H', null, 'I', '3', '0', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:58:16', '4', '2016-09-08', '18:59:54', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('122', '4.01.02', 'POTONGAN PENDAPATAN JASA USAHA', 'H', null, 'I', '3', '120', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '18:58:53', '4', '2016-09-08', '19:00:29', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('123', '4.01.01.01', 'PENDAPATAN JASA USAHA', 'D', null, 'I', '4', '121', '0', '0', '0', 'N', 'N', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:01:12', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('124', '4.01.01.02', 'PENDAPATAN LAIN-LAIN', 'D', null, 'I', '4', '121', '0', '0', '0', 'N', 'N', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:01:42', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('125', '4.01.02.01', 'POTONGAN PENDAPATAN JASA', 'D', null, 'I', '4', '122', '0', '0', '0', 'N', 'N', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:02:31', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('126', '4.02', 'PENDAPATAN LUAR USAHA', 'H', null, 'I', '2', '119', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:03:21', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('127', '4.02.01', 'PENDAPATAN BANK', 'H', null, 'I', '3', '126', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:04:28', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('128', '4.02.01.01', 'PENDAPATAN BUNGA', 'D', null, 'I', '4', '127', '0', '0', '0', 'N', 'N', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:05:07', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('129', '4.02.01.02', 'PENDAPATAN JASA GIRO', 'D', null, 'I', '4', '127', '0', '0', '0', 'N', 'N', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:05:44', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('130', '4.02.02', 'PENDPATAN LAIN-LAIN', 'H', null, 'I', '3', '126', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:06:14', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('131', '4.02.02.01', 'PENDAPATAN SEWA', 'D', null, 'I', '4', '130', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:07:02', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('132', '4.02.02.02', 'PENDAPATAN LAIN-LAIN', 'D', null, 'I', '4', '130', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:07:32', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('133', '5', 'BIAYA-BIAYA', 'H', null, 'E', '1', '0', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:08:13', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('134', '5.01', 'BIAYA USAHA', 'H', null, 'E', '2', '133', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:09:54', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('135', '5.01.01', 'BIAYA OPERASIONAL', 'H', null, 'E', '3', '134', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:10:24', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('136', '5.01.01.01', 'BIAYA LANGSUNG', 'D', null, 'E', '4', '135', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:10:57', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('137', '5.01.01.02', 'BIAYA KOMISI SUPIR ', 'D', null, 'E', '4', '135', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:11:34', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('138', '5.01.01.03', 'BIAYA MAINTENANCE', 'D', null, 'E', '4', '135', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:12:10', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('139', '5.01.01.04', 'BIAYA ONGKOS ANGKUT', 'D', null, 'E', '4', '135', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:12:49', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('140', '5.01.02', 'POTONGAN BIAYA OPERASIONAL', 'H', null, 'E', '3', '134', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:14:47', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('141', '5.01.02.01', 'POTONGAN BY OPS UJ B9437BYU', 'D', null, 'E', '4', '140', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:16:31', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('142', '5.01.02.02', 'POTONGAN BY OPS UJ B9858BYW', 'D', null, 'E', '4', '140', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:17:31', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('143', '5.01.02.03', 'POTONGAN BY OPS UJ ANGK. LANCAR', 'D', null, 'E', '4', '140', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:18:16', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('144', '5.01.02.04', 'POTONGAN BY KOMISI B9437BYU', 'D', null, 'E', '4', '140', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:19:01', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('145', '5.01.02.05', 'POTONGAN BY KOMISI B9858BYW', 'D', null, 'E', '4', '140', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:19:58', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('146', '5.01.02.06', 'POTONGAN BY KOMISI ANK.LANCAR', 'D', null, 'E', '4', '140', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:30:50', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('147', '5.01.02.07', 'POTONGAN BY MAINTENANCE B9437BYU', 'D', null, 'E', '4', '140', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:35:32', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('148', '5.01.02.08', 'POTONGAN BY MAINTENANCE B9858BYW', 'D', null, 'E', '4', '140', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:36:26', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('149', '5.01.02.09', 'POTONGAN BY MAINTENANCE ANGK.LANCAR', 'D', null, 'E', '4', '140', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:37:15', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('150', '5.01.02.10', 'POTONGAN BY LANGSUNG (GPS) B9858BYW', 'D', null, 'E', '4', '140', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:38:08', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('151', '5.01.02.11', 'POTONGAN BY LANGSUNG (GPS) ANGK.LANCAR', 'D', null, 'E', '4', '140', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:38:55', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('152', '5.01.02.12', 'POTONGAN BIAYA OPS TNP-MAN', 'D', null, 'E', '4', '140', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:39:25', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('153', '5.01.03', 'BIAYA NON OPERSIONAL', 'H', null, 'E', '3', '134', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:40:16', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('154', '5.01.03.01', 'BIAYA GAJI KARYAWAN', 'D', null, 'E', '2', '153', '0', '0', '0', 'N', 'N', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:41:08', '4', '2016-09-08', '19:43:28', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('155', '5.01.03.02', 'BIAYA THR KARYAWAN', 'D', null, 'E', '4', '153', '0', '0', '0', 'N', 'N', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:41:45', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('156', '5.01.03.03', 'BIAYA BONUS KARYAWAN', 'D', null, 'E', '4', '153', '0', '0', '0', 'N', 'N', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:42:38', '4', '2016-09-08', '19:43:53', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('157', '5.01.03.04', 'BIAYA ASURANSI', 'D', null, 'E', '4', '153', '0', '0', '0', 'N', 'N', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:43:01', '4', '2016-09-08', '19:44:15', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('158', '5.01.03.05', 'BIAYA UMUM', 'D', null, 'E', '4', '153', '0', '0', '0', 'N', 'N', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:44:52', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('159', '5.01.01.05', 'BIAYA THR SUPIR ', 'D', null, 'E', '4', '135', '0', '0', '0', 'N', 'N', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:46:01', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('160', '5.01.04', 'BIAYA LAIN-LAIN', 'H', null, 'E', '3', '134', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:46:43', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('161', '5.01.04.01', 'BIAYA LAIN-LAIN', 'H', null, 'E', '4', '160', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:47:33', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('162', '5.01.04.01.01', 'BIAYA BUNGA PINJAMAN', 'D', null, 'E', '5', '161', '0', '0', '0', 'N', 'N', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:48:19', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('163', '5.01.04.01.02', 'BIAYA LAIN-LAIN', 'D', null, 'E', '5', '161', '0', '0', '0', 'N', 'N', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:49:26', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('164', '5.01.04.01.03', 'BIAYA PIUTANG TAK TERTAGIH', 'D', null, 'E', '5', '161', '0', '0', '0', 'N', 'N', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:50:04', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('165', '5.01.04.02', 'BIAYA PENYUSUTAN', 'H', null, 'E', '4', '160', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:50:34', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('166', '5.01.04.02.01', 'BIAYA PENYUSUTAN INVENTARIS KANTOR', 'D', null, 'E', '5', '165', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:51:14', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('167', '5.01.04.02.02', 'BIAYA PENYUSUTAN KENDARAAN', 'D', null, 'E', '5', '165', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:51:52', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('168', '5.01.04.02.03', 'BIAYA PENYUSUTAN PERALATAN KANTOR', 'D', null, 'E', '5', '165', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:52:31', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('169', '5.01.05', 'BIAYA PAJAK', 'H', null, 'E', '3', '134', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:53:11', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('170', '5.01.05.01', 'BIAYA PPH 21', 'D', null, 'E', '4', '169', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:53:59', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('171', '5.01.05.02', 'BIAYA PPH 23', 'D', null, 'E', '4', '169', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:54:26', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('172', '5.01.05.03', 'BIAYA PPH 25', 'D', null, 'E', '4', '169', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:54:55', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('173', '5.01.05.04', 'BIAYA PAJAK PPN', 'D', null, 'E', '4', '169', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:55:38', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('174', '5.01.05.05', 'BIAYA PAJAK KENDARAAN', 'D', null, 'E', '4', '169', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:56:10', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('175', '5.02', 'BIAYA LUAR USAHA', 'H', null, 'E', '2', '133', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:57:12', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('176', '5.02.01', 'BIAYA BANK', 'H', null, 'E', '3', '175', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:57:40', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('177', '5.02.01.01', 'BIAYA ADM BANK', 'D', null, 'E', '4', '176', '0', '0', '0', 'N', 'N', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:58:23', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('178', '5.02.01.02', 'BIAYA PAJAK BUNGA', 'D', null, 'E', '4', '176', '0', '0', '0', 'N', 'N', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:59:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('179', '5.02.01.03', 'BIAYA MATERAI', 'D', null, 'E', '4', '176', '0', '0', '0', 'N', 'N', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '19:59:34', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('180', '5.02.01.04', 'BIAYA BUKU CEK ', 'D', null, 'E', '4', '176', '0', '0', '0', 'N', 'N', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '20:00:25', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('181', '5.02.01.05', 'BIAYA STMT BANK', 'D', null, 'E', '4', '176', '0', '0', '0', 'N', 'N', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '20:01:17', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('182', '5.02.01.06', 'BIAYA PROVISI', 'D', null, 'E', '4', '176', '0', '0', '0', 'N', 'N', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '20:01:51', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('183', '5.02.01.07', 'BIAYA BUNGA PINJAMAN', 'D', null, 'E', '4', '176', '0', '0', '0', 'N', 'N', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '20:02:24', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('184', '2.03', 'HUTANG LAIN-LAIN', 'H', null, 'L', '2', '74', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-09', '09:13:58', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('185', '2.03.01', 'HUTANG INTERNAL', 'H', null, 'L', '3', '184', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-09', '09:16:30', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('186', '2.03.01.01', 'HUTANG AFILIASI', 'D', null, 'L', '4', '185', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-09', '09:17:59', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('187', '2.03.01.02', 'HUTANG LAIN-LAIN', 'D', null, 'L', '4', '185', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-09', '09:18:28', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('188', '2.03.01.03', 'TITIPAN PAK JOHNI INDRA IRSYAD', 'D', null, 'L', '4', '185', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-09', '09:19:06', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('189', '2.03.01.04', 'TITIPAN PT.TIK', 'D', null, 'L', '4', '185', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-09', '09:19:29', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('190', '2.03.01.05', 'TITIPAN PT.TAS', 'D', null, 'L', '4', '185', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-09', '09:20:22', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('191', '2.03.01.06', 'TITIPAN PT.SMJ', 'D', null, 'L', '4', '185', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-09', '09:21:50', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('192', '2.03.01.07', 'TITIPAN PT.TNP', 'D', null, 'L', '4', '185', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-09', '09:22:27', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('193', '2.03.02', 'HUTANG SUPIR', 'H', null, 'L', '3', '184', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-09', '09:24:07', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('194', '2.03.02.01', 'DEPOSIT SUPIR', 'D', null, 'L', '4', '193', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-09', '09:24:36', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('195', '2.03.02.02', 'HUTANG SUPIR', 'D', null, 'L', '4', '193', '0', '0', '0', 'N', 'Y', 'Y', 'N', 'N', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-09', '09:25:13', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `gl_coa` VALUES ('196', 'TEST01', 'TEST011', 'H', null, 'L', '1', '0', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '1', '1', '2016-11-22', '10:57:24', '1', '2016-11-22', '10:57:43', '1', '2016-11-22', '11:34:59');

-- ----------------------------
-- Table structure for gl_period
-- ----------------------------
DROP TABLE IF EXISTS `gl_period`;
CREATE TABLE `gl_period` (
  `rowID` bigint(11) NOT NULL AUTO_INCREMENT,
  `year` smallint(4) NOT NULL DEFAULT '1901',
  `month` tinyint(2) NOT NULL DEFAULT '1',
  `start_date` date NOT NULL DEFAULT '1901-01-01',
  `end_date` date NOT NULL DEFAULT '1901-01-01',
  `close_status` char(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`rowID`,`year`,`month`),
  KEY `rowID` (`rowID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of gl_period
-- ----------------------------

-- ----------------------------
-- Table structure for gl_spec
-- ----------------------------
DROP TABLE IF EXISTS `gl_spec`;
CREATE TABLE `gl_spec` (
  `rowID` smallint(6) NOT NULL AUTO_INCREMENT,
  `acc_rtrnearn` varchar(20) NOT NULL,
  `acc_currearn` varchar(20) NOT NULL,
  `curr_month` tinyint(6) DEFAULT NULL,
  `curr_year` smallint(6) DEFAULT NULL,
  `printed` tinyint(4) DEFAULT NULL,
  `user_printed` int(11) DEFAULT NULL,
  `date_printed` date DEFAULT NULL,
  `time_printed` time DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `time_created` time DEFAULT NULL,
  `user_modified` int(11) DEFAULT NULL,
  `date_modified` date DEFAULT NULL,
  `time_modified` time DEFAULT NULL,
  `user_deleted` int(11) DEFAULT NULL,
  `date_deleted` date DEFAULT NULL,
  `time_deleted` time DEFAULT NULL,
  PRIMARY KEY (`rowID`),
  KEY `rowID` (`rowID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of gl_spec
-- ----------------------------

-- ----------------------------
-- Table structure for gl_trx_dtl
-- ----------------------------
DROP TABLE IF EXISTS `gl_trx_dtl`;
CREATE TABLE `gl_trx_dtl` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `gl_trx_hdr_prefix` varchar(4) NOT NULL,
  `gl_trx_hdr_year` int(4) NOT NULL DEFAULT '0',
  `gl_trx_hdr_month` int(2) NOT NULL DEFAULT '0',
  `gl_trx_hdr_code` int(11) NOT NULL DEFAULT '0',
  `row_no` bigint(11) NOT NULL DEFAULT '0',
  `gl_trx_hdr_journal_no` varchar(25) NOT NULL DEFAULT '',
  `gl_trx_hdr_journal_date` date NOT NULL DEFAULT '1901-01-01',
  `coa_rowID` smallint(6) NOT NULL DEFAULT '0',
  `trx_amt` double(15,2) NOT NULL DEFAULT '0.00',
  `descs` varchar(300) NOT NULL DEFAULT '',
  `dep_rowID` smallint(6) NOT NULL DEFAULT '0',
  `debtor_creditor_type` char(1) NOT NULL DEFAULT 'D',
  `debtor_creditor_rowID` smallint(6) NOT NULL DEFAULT '0',
  `gl_trx_hdr_ref_prefix` varchar(4) NOT NULL DEFAULT '',
  `gl_trx_hdr_ref_year` int(4) NOT NULL DEFAULT '0',
  `gl_trx_hdr_ref_month` int(2) NOT NULL DEFAULT '0',
  `gl_trx_hdr_ref_code` int(8) NOT NULL DEFAULT '0',
  `gl_trx_hdr_ref_no` varchar(25) NOT NULL DEFAULT '',
  `gl_trx_hdr_ref_date` date NOT NULL DEFAULT '1901-01-01',
  `modul` char(2) NOT NULL DEFAULT '',
  `cash_flow` char(1) NOT NULL DEFAULT 'N',
  `base_amt` double(10,0) NOT NULL DEFAULT '0',
  `tax_no` varchar(30) NOT NULL DEFAULT '',
  `tax_date` date NOT NULL DEFAULT '1901-01-01',
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`),
  KEY `gltrx_key` (`gl_trx_hdr_prefix`,`gl_trx_hdr_year`,`gl_trx_hdr_month`,`gl_trx_hdr_code`) USING BTREE,
  KEY `gl_trx_hdr_journal_no` (`gl_trx_hdr_journal_no`),
  KEY `coa_rowID` (`coa_rowID`),
  KEY `date_created` (`date_created`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of gl_trx_dtl
-- ----------------------------

-- ----------------------------
-- Table structure for gl_trx_hdr
-- ----------------------------
DROP TABLE IF EXISTS `gl_trx_hdr`;
CREATE TABLE `gl_trx_hdr` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `prefix` varchar(4) NOT NULL,
  `year` int(4) NOT NULL,
  `month` int(2) NOT NULL,
  `code` int(8) NOT NULL,
  `journal_no` varchar(25) NOT NULL DEFAULT '',
  `journal_date` date NOT NULL DEFAULT '1901-01-01',
  `journal_type` enum('general','cash advance','realization','refund','invoice','account receivable','account payable','advance','reimburse','deposit','commission','cash in','cash out','bank in','bank out','outstanding bank in','outstanding bank out','kontra bon') NOT NULL,
  `creditor_type_rowID` int(11) NOT NULL,
  `descs` varchar(255) NOT NULL DEFAULT '',
  `trx_amt` double(15,2) NOT NULL DEFAULT '0.00',
  `ref_prefix` varchar(4) NOT NULL DEFAULT '',
  `ref_year` int(4) NOT NULL DEFAULT '0',
  `ref_month` int(2) NOT NULL DEFAULT '0',
  `ref_code` int(8) NOT NULL DEFAULT '0',
  `ref_no` varchar(25) NOT NULL DEFAULT '',
  `ref_date` date NOT NULL DEFAULT '1901-01-01',
  `verified` tinyint(4) NOT NULL,
  `user_verified` int(11) NOT NULL,
  `date_verified` date NOT NULL,
  `time_verified` time NOT NULL,
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`),
  KEY `gltrx_key` (`prefix`,`year`,`month`,`code`) USING BTREE,
  KEY `journal_no` (`journal_no`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of gl_trx_hdr
-- ----------------------------

-- ----------------------------
-- Table structure for lg_adv_req_trx_dtl
-- ----------------------------
DROP TABLE IF EXISTS `lg_adv_req_trx_dtl`;
CREATE TABLE `lg_adv_req_trx_dtl` (
  `request_no` varchar(25) NOT NULL,
  `request_date` date NOT NULL,
  `debtor_cd` varchar(25) NOT NULL,
  `jo_no` varchar(25) NOT NULL,
  `line_no` int(11) NOT NULL,
  `descs_cd` varchar(10) NOT NULL,
  `uom_cd` varchar(5) NOT NULL,
  `request_amt` decimal(10,0) NOT NULL,
  `month` tinyint(4) NOT NULL,
  `year` smallint(6) NOT NULL,
  `printed` tinyint(4) DEFAULT NULL,
  `user_printed` int(11) DEFAULT NULL,
  `date_printed` date DEFAULT NULL,
  `time_printed` time DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `time_created` time DEFAULT NULL,
  `user_modified` int(11) DEFAULT NULL,
  `date_modified` date DEFAULT NULL,
  `time_modified` time DEFAULT NULL,
  `user_deleted` int(11) DEFAULT NULL,
  `date_deleted` date DEFAULT NULL,
  `time_deleted` time DEFAULT NULL,
  KEY `lgadvreq_key` (`request_no`,`debtor_cd`,`jo_no`,`month`,`year`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of lg_adv_req_trx_dtl
-- ----------------------------

-- ----------------------------
-- Table structure for lg_adv_req_trx_hdr
-- ----------------------------
DROP TABLE IF EXISTS `lg_adv_req_trx_hdr`;
CREATE TABLE `lg_adv_req_trx_hdr` (
  `request_no` varchar(25) NOT NULL,
  `request_date` date NOT NULL,
  `debtor_cd` varchar(25) NOT NULL,
  `jo_no` varchar(25) NOT NULL,
  `ref_no` varchar(25) NOT NULL,
  `attn1` varchar(30) NOT NULL,
  `attn2` varchar(30) NOT NULL,
  `note` varchar(120) NOT NULL,
  `bank_cd` varchar(25) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `request_amt` decimal(10,0) NOT NULL,
  `percent_adv` decimal(4,0) NOT NULL,
  `advance_amt` double NOT NULL,
  `month` tinyint(4) NOT NULL,
  `year` smallint(6) NOT NULL,
  `printed` tinyint(4) DEFAULT NULL,
  `user_printed` int(11) DEFAULT NULL,
  `date_printed` date DEFAULT NULL,
  `time_printed` time DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `time_created` time DEFAULT NULL,
  `user_modified` int(11) DEFAULT NULL,
  `date_modified` date DEFAULT NULL,
  `time_modified` time DEFAULT NULL,
  `user_deleted` int(11) DEFAULT NULL,
  `date_deleted` date DEFAULT NULL,
  `time_deleted` time DEFAULT NULL,
  PRIMARY KEY (`request_no`),
  KEY `lgadvreq_key` (`request_no`,`jo_no`,`debtor_cd`,`month`,`year`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of lg_adv_req_trx_hdr
-- ----------------------------

-- ----------------------------
-- Table structure for lg_comments
-- ----------------------------
DROP TABLE IF EXISTS `lg_comments`;
CREATE TABLE `lg_comments` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `case_description` varchar(255) NOT NULL,
  `message` text CHARACTER SET latin1 NOT NULL,
  `activated` tinyint(4) DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT '0',
  `user_created` int(11) DEFAULT '0',
  `date_created` date DEFAULT '1901-01-01',
  `time_created` time DEFAULT '00:00:00',
  `user_modified` int(11) DEFAULT '0',
  `date_modified` date DEFAULT '1901-01-01',
  `time_modified` time DEFAULT '00:00:00',
  `user_deleted` int(11) DEFAULT '0',
  `date_deleted` date DEFAULT '1901-01-01',
  `time_deleted` time DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lg_comments
-- ----------------------------

-- ----------------------------
-- Table structure for lg_comment_replies
-- ----------------------------
DROP TABLE IF EXISTS `lg_comment_replies`;
CREATE TABLE `lg_comment_replies` (
  `rowID` bigint(11) NOT NULL AUTO_INCREMENT,
  `comment_rowID` int(11) NOT NULL,
  `reply_message` text CHARACTER SET latin1 NOT NULL,
  `deleted` tinyint(4) DEFAULT '0',
  `user_created` int(11) DEFAULT '0',
  `date_created` date DEFAULT '1901-01-01',
  `time_created` time DEFAULT '00:00:00',
  `datetime_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user_modified` int(11) DEFAULT '0',
  `date_modified` date DEFAULT '1901-01-01',
  `time_modified` time DEFAULT '00:00:00',
  `user_deleted` int(11) DEFAULT '0',
  `date_deleted` date DEFAULT '1901-01-01',
  `time_deleted` time DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lg_comment_replies
-- ----------------------------

-- ----------------------------
-- Table structure for lg_co_trx_dtl
-- ----------------------------
DROP TABLE IF EXISTS `lg_co_trx_dtl`;
CREATE TABLE `lg_co_trx_dtl` (
  `co_no` varchar(25) NOT NULL,
  `co_date` date NOT NULL,
  `debtor_cd` varchar(25) NOT NULL,
  `line_no` smallint(6) NOT NULL,
  `descs_cd` varchar(12) NOT NULL,
  `descs` varchar(30) NOT NULL,
  `qty` double NOT NULL,
  `uom_cd` char(4) NOT NULL,
  `amount` double NOT NULL,
  `month` tinyint(4) NOT NULL,
  `year` smallint(6) NOT NULL,
  `printed` tinyint(4) DEFAULT NULL,
  `user_printed` int(11) DEFAULT NULL,
  `date_printed` date DEFAULT NULL,
  `time_printed` time DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `time_created` time DEFAULT NULL,
  `user_modified` int(11) DEFAULT NULL,
  `date_modified` date DEFAULT NULL,
  `time_modified` time DEFAULT NULL,
  `user_deleted` int(11) DEFAULT NULL,
  `date_deleted` date DEFAULT NULL,
  `time_deleted` time DEFAULT NULL,
  KEY `lgcotrx_key` (`co_no`,`debtor_cd`,`month`,`year`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of lg_co_trx_dtl
-- ----------------------------

-- ----------------------------
-- Table structure for lg_co_trx_hdr
-- ----------------------------
DROP TABLE IF EXISTS `lg_co_trx_hdr`;
CREATE TABLE `lg_co_trx_hdr` (
  `co_no` varchar(25) NOT NULL,
  `co_date` date NOT NULL,
  `debtor_cd` varchar(25) NOT NULL,
  `po_no` varchar(40) NOT NULL,
  `day_close` smallint(6) NOT NULL,
  `co_close_date` date NOT NULL,
  `stype_cd` varchar(25) NOT NULL,
  `descs` varchar(60) NOT NULL,
  `ship_trx_no` varchar(25) NOT NULL,
  `ship_trx_date` date NOT NULL,
  `month` tinyint(4) NOT NULL,
  `year` smallint(6) NOT NULL,
  `printed` tinyint(4) DEFAULT NULL,
  `user_printed` int(11) DEFAULT NULL,
  `date_printed` date DEFAULT NULL,
  `time_printed` time DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `time_created` time DEFAULT NULL,
  `user_modified` int(11) DEFAULT NULL,
  `date_modified` date DEFAULT NULL,
  `time_modified` time DEFAULT NULL,
  `user_deleted` int(11) DEFAULT NULL,
  `date_deleted` date DEFAULT NULL,
  `time_deleted` time DEFAULT NULL,
  PRIMARY KEY (`co_no`),
  KEY `lgcotrx_key` (`co_no`,`debtor_cd`,`month`,`year`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of lg_co_trx_hdr
-- ----------------------------

-- ----------------------------
-- Table structure for lg_do_inv_ap
-- ----------------------------
DROP TABLE IF EXISTS `lg_do_inv_ap`;
CREATE TABLE `lg_do_inv_ap` (
  `do_no` varchar(25) NOT NULL,
  `debtor_cd` varchar(25) NOT NULL,
  `jo_no` varchar(25) NOT NULL,
  `inv_ap_no` varchar(25) NOT NULL,
  `inv_ap_date` date NOT NULL,
  `weight` decimal(10,0) NOT NULL,
  `month` tinyint(4) NOT NULL,
  `year` smallint(6) NOT NULL,
  `printed` tinyint(4) DEFAULT NULL,
  `user_printed` int(11) DEFAULT NULL,
  `date_printed` date DEFAULT NULL,
  `time_printed` time DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `time_created` time DEFAULT NULL,
  `user_modified` int(11) DEFAULT NULL,
  `date_modified` date DEFAULT NULL,
  `time_modified` time DEFAULT NULL,
  `user_deleted` int(11) DEFAULT NULL,
  `date_deleted` date DEFAULT NULL,
  `time_deleted` time DEFAULT NULL,
  KEY `lgdoinvap_key` (`do_no`,`jo_no`,`debtor_cd`,`month`,`year`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of lg_do_inv_ap
-- ----------------------------

-- ----------------------------
-- Table structure for lg_do_inv_ar
-- ----------------------------
DROP TABLE IF EXISTS `lg_do_inv_ar`;
CREATE TABLE `lg_do_inv_ar` (
  `do_no` varchar(25) NOT NULL,
  `jo_no` varchar(25) NOT NULL,
  `creditor_cd` varchar(25) NOT NULL,
  `inv_ar_no` varchar(25) NOT NULL,
  `inv_ar_date` date NOT NULL,
  `weight` decimal(10,0) NOT NULL,
  `month` tinyint(4) NOT NULL,
  `year` smallint(6) NOT NULL,
  `printed` tinyint(4) DEFAULT NULL,
  `user_printed` int(11) DEFAULT NULL,
  `date_printed` date DEFAULT NULL,
  `time_printed` time DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `time_created` time DEFAULT NULL,
  `user_modified` int(11) DEFAULT NULL,
  `date_modified` date DEFAULT NULL,
  `time_modified` time DEFAULT NULL,
  `user_deleted` int(11) DEFAULT NULL,
  `date_deleted` date DEFAULT NULL,
  `time_deleted` time DEFAULT NULL,
  KEY `lgdoinvar` (`do_no`,`jo_no`,`creditor_cd`,`month`,`year`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of lg_do_inv_ar
-- ----------------------------

-- ----------------------------
-- Table structure for lg_do_rcv
-- ----------------------------
DROP TABLE IF EXISTS `lg_do_rcv`;
CREATE TABLE `lg_do_rcv` (
  `do_no` varchar(25) NOT NULL,
  `wo_no` varchar(25) DEFAULT NULL,
  `jo_no` varchar(25) DEFAULT NULL,
  `received_date` date NOT NULL,
  `wieght_rcv` decimal(10,0) NOT NULL,
  `month` tinyint(4) NOT NULL,
  `year` smallint(6) NOT NULL,
  `printed` tinyint(4) DEFAULT NULL,
  `user_printed` int(11) DEFAULT NULL,
  `date_printed` date DEFAULT NULL,
  `time_printed` time DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `time_created` time DEFAULT NULL,
  `user_modified` int(11) DEFAULT NULL,
  `date_modified` date DEFAULT NULL,
  `time_modified` time DEFAULT NULL,
  `user_deleted` int(11) DEFAULT NULL,
  `date_deleted` date DEFAULT NULL,
  `time_deleted` time DEFAULT NULL,
  KEY `lgdorcv_key` (`do_no`,`jo_no`,`month`,`year`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of lg_do_rcv
-- ----------------------------

-- ----------------------------
-- Table structure for lg_do_trx
-- ----------------------------
DROP TABLE IF EXISTS `lg_do_trx`;
CREATE TABLE `lg_do_trx` (
  `do_no` varchar(25) NOT NULL,
  `do_date` date NOT NULL,
  `debtor_cd` varchar(25) DEFAULT NULL,
  `creditor_cd` varchar(25) DEFAULT NULL,
  `wo_no` varchar(25) DEFAULT NULL,
  `jo_no` varchar(25) DEFAULT NULL,
  `driver_cd` varchar(25) DEFAULT NULL,
  `vehicle_cd` varchar(6) DEFAULT NULL,
  `from_cd` varchar(6) NOT NULL,
  `to_cd` varchar(6) NOT NULL,
  `item_cd` varchar(25) NOT NULL,
  `wheight_dlv` decimal(10,0) NOT NULL,
  `month` tinyint(4) NOT NULL,
  `year` smallint(6) NOT NULL,
  `printed` tinyint(4) DEFAULT NULL,
  `user_printed` int(11) DEFAULT NULL,
  `date_printed` date DEFAULT NULL,
  `time_printed` time DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `time_created` time DEFAULT NULL,
  `user_modified` int(11) DEFAULT NULL,
  `date_modified` date DEFAULT NULL,
  `time_modified` time DEFAULT NULL,
  `user_deleted` int(11) DEFAULT NULL,
  `date_deleted` date DEFAULT NULL,
  `time_deleted` time DEFAULT NULL,
  PRIMARY KEY (`do_no`),
  KEY `lgdotrx_key` (`do_no`,`debtor_cd`,`wo_no`,`month`,`year`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of lg_do_trx
-- ----------------------------

-- ----------------------------
-- Table structure for lg_jo_cost_aprv
-- ----------------------------
DROP TABLE IF EXISTS `lg_jo_cost_aprv`;
CREATE TABLE `lg_jo_cost_aprv` (
  `approve_no` varchar(25) NOT NULL,
  `approve_date` date NOT NULL,
  `debtor_cd` varchar(25) NOT NULL,
  `budget_no` varchar(25) NOT NULL,
  `jo_no` varchar(25) NOT NULL,
  `cost_cd` varchar(25) NOT NULL,
  `approved_amt` decimal(10,0) NOT NULL,
  `approve_descs` varchar(60) NOT NULL,
  `descs_inword` varchar(60) NOT NULL,
  `purpose` varchar(60) NOT NULL,
  `remarks` varchar(60) NOT NULL,
  `requested_by` varchar(25) NOT NULL,
  `month` tinyint(4) NOT NULL,
  `year` smallint(6) NOT NULL,
  `printed` tinyint(4) DEFAULT NULL,
  `user_printed` int(11) DEFAULT NULL,
  `date_printed` date DEFAULT NULL,
  `time_printed` time DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `time_created` time DEFAULT NULL,
  `user_modified` int(11) DEFAULT NULL,
  `date_modified` date DEFAULT NULL,
  `time_modified` time DEFAULT NULL,
  `user_deleted` int(11) DEFAULT NULL,
  `date_deleted` date DEFAULT NULL,
  `time_deleted` time DEFAULT NULL,
  PRIMARY KEY (`approve_no`),
  KEY `lgadvaprv_key` (`approve_no`,`jo_no`,`debtor_cd`,`month`,`year`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of lg_jo_cost_aprv
-- ----------------------------

-- ----------------------------
-- Table structure for lg_jo_cost_dtl
-- ----------------------------
DROP TABLE IF EXISTS `lg_jo_cost_dtl`;
CREATE TABLE `lg_jo_cost_dtl` (
  `budget_no` varchar(25) NOT NULL,
  `debtor_cd` varchar(25) NOT NULL,
  `jo_no` varchar(25) NOT NULL,
  `line_no` tinyint(4) NOT NULL,
  `cost_cd` varchar(10) NOT NULL,
  `budget_descs` varchar(60) DEFAULT NULL,
  `approved_decs` varchar(60) DEFAULT NULL,
  `budget_amt` double NOT NULL,
  `approved_amt` double NOT NULL,
  `actual_amt` double NOT NULL,
  `balance_amt` double NOT NULL,
  `month` tinyint(4) NOT NULL,
  `year` smallint(6) NOT NULL,
  `printed` tinyint(4) DEFAULT NULL,
  `user_printed` int(11) DEFAULT NULL,
  `date_printed` date DEFAULT NULL,
  `time_printed` time DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `time_created` time DEFAULT NULL,
  `user_modified` int(11) DEFAULT NULL,
  `date_modified` date DEFAULT NULL,
  `time_modified` time DEFAULT NULL,
  `user_deleted` int(11) DEFAULT NULL,
  `date_deleted` date DEFAULT NULL,
  `time_deleted` time DEFAULT NULL,
  KEY `lgadv_key` (`budget_no`,`jo_no`,`debtor_cd`,`month`,`year`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of lg_jo_cost_dtl
-- ----------------------------

-- ----------------------------
-- Table structure for lg_jo_cost_hdr
-- ----------------------------
DROP TABLE IF EXISTS `lg_jo_cost_hdr`;
CREATE TABLE `lg_jo_cost_hdr` (
  `category` int(1) NOT NULL,
  `budget_no` varchar(25) NOT NULL,
  `budget_date` date NOT NULL,
  `debtor_cd` varchar(25) DEFAULT NULL,
  `jo_no` varchar(25) DEFAULT NULL,
  `adv_type` smallint(6) DEFAULT NULL,
  `budget_amt` double NOT NULL,
  `approved_amt` double NOT NULL,
  `actual_amt` double NOT NULL,
  `balance_amt` double NOT NULL,
  `cb_amt` double NOT NULL,
  `descs_inword` varchar(60) DEFAULT NULL,
  `purpose_of` varchar(60) DEFAULT NULL,
  `budget_descs` varchar(60) DEFAULT NULL,
  `requested_by` varchar(25) DEFAULT NULL,
  `close` char(1) DEFAULT NULL,
  `month` tinyint(4) NOT NULL,
  `year` smallint(6) NOT NULL,
  `printed` tinyint(4) DEFAULT NULL,
  `user_printed` int(11) DEFAULT NULL,
  `date_printed` date DEFAULT NULL,
  `time_printed` time DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `time_created` time DEFAULT NULL,
  `user_modified` int(11) DEFAULT NULL,
  `date_modified` date DEFAULT NULL,
  `time_modified` time DEFAULT NULL,
  `user_deleted` int(11) DEFAULT NULL,
  `date_deleted` date DEFAULT NULL,
  `time_deleted` time DEFAULT NULL,
  PRIMARY KEY (`budget_no`),
  KEY `lgadv_key` (`budget_no`,`jo_no`,`debtor_cd`,`month`,`year`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of lg_jo_cost_hdr
-- ----------------------------

-- ----------------------------
-- Table structure for lg_jo_trx_cnt
-- ----------------------------
DROP TABLE IF EXISTS `lg_jo_trx_cnt`;
CREATE TABLE `lg_jo_trx_cnt` (
  `jo_no` varchar(25) NOT NULL,
  `debtor_cd` varchar(25) NOT NULL,
  `jo_date` date NOT NULL,
  `line_no` smallint(6) NOT NULL,
  `from_cd` varchar(6) DEFAULT NULL,
  `to_cd` varchar(6) DEFAULT NULL,
  `item_cd` varchar(25) NOT NULL,
  `container_no` varchar(15) NOT NULL,
  `container_size` varchar(15) NOT NULL,
  `month` tinyint(4) NOT NULL,
  `year` smallint(6) NOT NULL,
  `printed` tinyint(4) DEFAULT NULL,
  `user_printed` int(11) DEFAULT NULL,
  `date_printed` date DEFAULT NULL,
  `time_printed` time DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `time_created` time DEFAULT NULL,
  `user_modified` int(11) DEFAULT NULL,
  `date_modified` date DEFAULT NULL,
  `time_modified` time DEFAULT NULL,
  `user_deleted` int(11) DEFAULT NULL,
  `date_deleted` date DEFAULT NULL,
  `time_deleted` time DEFAULT NULL,
  KEY `lgjotrx_key` (`jo_no`,`debtor_cd`,`month`,`year`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of lg_jo_trx_cnt
-- ----------------------------

-- ----------------------------
-- Table structure for lg_jo_trx_dtl
-- ----------------------------
DROP TABLE IF EXISTS `lg_jo_trx_dtl`;
CREATE TABLE `lg_jo_trx_dtl` (
  `jo_no` varchar(25) NOT NULL,
  `jo_date` date DEFAULT NULL,
  `debtor_cd` varchar(25) NOT NULL,
  `line_no` smallint(6) NOT NULL,
  `from_cd` varchar(6) DEFAULT NULL,
  `to_cd` varchar(6) NOT NULL,
  `item_cd` varchar(25) NOT NULL,
  `uom_cd` varchar(5) NOT NULL,
  `container` smallint(6) NOT NULL,
  `kubikasi` double NOT NULL,
  `weight` double NOT NULL,
  `weight_wo` double DEFAULT NULL,
  `weight_bal` double NOT NULL,
  `month` tinyint(4) NOT NULL,
  `year` smallint(6) NOT NULL,
  `printed` tinyint(4) DEFAULT NULL,
  `user_printed` int(11) DEFAULT NULL,
  `date_printed` date DEFAULT NULL,
  `time_printed` time DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `time_created` time DEFAULT NULL,
  `user_modified` int(11) DEFAULT NULL,
  `date_modified` date DEFAULT NULL,
  `time_modified` time DEFAULT NULL,
  `user_deleted` int(11) DEFAULT NULL,
  `date_deleted` date DEFAULT NULL,
  `time_deleted` time DEFAULT NULL,
  KEY `lgjotrx_key` (`jo_no`,`debtor_cd`,`month`,`year`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of lg_jo_trx_dtl
-- ----------------------------

-- ----------------------------
-- Table structure for lg_jo_trx_hdr
-- ----------------------------
DROP TABLE IF EXISTS `lg_jo_trx_hdr`;
CREATE TABLE `lg_jo_trx_hdr` (
  `jo_no` varchar(25) NOT NULL,
  `jo_date` date NOT NULL,
  `debtor_cd` varchar(25) NOT NULL,
  `co_no` varchar(25) NOT NULL,
  `po_no` varchar(40) NOT NULL,
  `ship_no` varchar(25) NOT NULL,
  `month` tinyint(4) NOT NULL,
  `year` smallint(6) NOT NULL,
  `printed` tinyint(4) DEFAULT NULL,
  `user_printed` int(11) DEFAULT NULL,
  `date_printed` date DEFAULT NULL,
  `time_printed` time DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `time_created` time DEFAULT NULL,
  `user_modified` int(11) DEFAULT NULL,
  `date_modified` date DEFAULT NULL,
  `time_modified` time DEFAULT NULL,
  `user_deleted` int(11) DEFAULT NULL,
  `date_deleted` date DEFAULT NULL,
  `time_deleted` time DEFAULT NULL,
  PRIMARY KEY (`jo_no`),
  KEY `lgjotrx_key` (`jo_no`,`co_no`,`debtor_cd`,`month`,`year`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of lg_jo_trx_hdr
-- ----------------------------

-- ----------------------------
-- Table structure for lg_settle_trx_dtl
-- ----------------------------
DROP TABLE IF EXISTS `lg_settle_trx_dtl`;
CREATE TABLE `lg_settle_trx_dtl` (
  `settle_no` varchar(25) NOT NULL,
  `settle_date` date NOT NULL,
  `debtor_cd` varchar(25) NOT NULL,
  `budget_no` varchar(25) NOT NULL,
  `jo_no` varchar(25) NOT NULL,
  `line_no` tinyint(4) NOT NULL,
  `cost_cd` varchar(10) NOT NULL,
  `descs` varchar(60) NOT NULL,
  `uom_cd` char(5) NOT NULL,
  `settled_amt` decimal(10,0) NOT NULL,
  `trx_mode` char(1) NOT NULL,
  `month` tinyint(4) NOT NULL,
  `year` smallint(6) NOT NULL,
  `printed` tinyint(4) DEFAULT NULL,
  `user_printed` int(11) DEFAULT NULL,
  `date_printed` date DEFAULT NULL,
  `time_printed` time DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `time_created` time DEFAULT NULL,
  `user_modified` int(11) DEFAULT NULL,
  `date_modified` date DEFAULT NULL,
  `time_modified` time DEFAULT NULL,
  `user_deleted` int(11) DEFAULT NULL,
  `date_deleted` date DEFAULT NULL,
  `time_deleted` time DEFAULT NULL,
  KEY `lgreimburs_key` (`settle_no`,`jo_no`,`budget_no`,`month`,`year`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of lg_settle_trx_dtl
-- ----------------------------

-- ----------------------------
-- Table structure for lg_settle_trx_hdr
-- ----------------------------
DROP TABLE IF EXISTS `lg_settle_trx_hdr`;
CREATE TABLE `lg_settle_trx_hdr` (
  `settle_no` varchar(25) NOT NULL,
  `settle_date` date NOT NULL,
  `debtor_cd` varchar(25) NOT NULL,
  `budget_no` varchar(25) NOT NULL,
  `jo_no` varchar(25) NOT NULL,
  `adv_type` char(255) NOT NULL,
  `settled_amt` decimal(10,0) NOT NULL,
  `descs` varchar(60) NOT NULL,
  `month` tinyint(4) NOT NULL,
  `year` smallint(6) NOT NULL,
  `printed` tinyint(4) DEFAULT NULL,
  `user_printed` int(11) DEFAULT NULL,
  `date_printed` date DEFAULT NULL,
  `time_printed` time DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `time_created` time DEFAULT NULL,
  `user_modified` int(11) DEFAULT NULL,
  `date_modified` date DEFAULT NULL,
  `time_modified` time DEFAULT NULL,
  `user_deleted` int(11) DEFAULT NULL,
  `date_deleted` date DEFAULT NULL,
  `time_deleted` time DEFAULT NULL,
  PRIMARY KEY (`settle_no`),
  KEY `lgreimbrs_key` (`settle_no`,`jo_no`,`budget_no`,`month`,`year`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of lg_settle_trx_hdr
-- ----------------------------

-- ----------------------------
-- Table structure for lg_ship_trx_dtl
-- ----------------------------
DROP TABLE IF EXISTS `lg_ship_trx_dtl`;
CREATE TABLE `lg_ship_trx_dtl` (
  `ship_no` varchar(25) NOT NULL,
  `doc_rec_date` date NOT NULL,
  `palka_no` tinyint(4) NOT NULL,
  `item_cd` varchar(25) NOT NULL,
  `weight` tinyint(4) NOT NULL,
  `month` tinyint(4) NOT NULL,
  `year` smallint(6) NOT NULL,
  `printed` tinyint(4) DEFAULT NULL,
  `user_printed` int(11) DEFAULT NULL,
  `date_printed` date DEFAULT NULL,
  `time_printed` time DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `time_created` time DEFAULT NULL,
  `user_modified` int(11) DEFAULT NULL,
  `date_modified` date DEFAULT NULL,
  `time_modified` time DEFAULT NULL,
  `user_deleted` int(11) DEFAULT NULL,
  `date_deleted` date DEFAULT NULL,
  `time_deleted` time DEFAULT NULL,
  KEY `lgshiptrx_key` (`ship_no`,`month`,`year`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of lg_ship_trx_dtl
-- ----------------------------

-- ----------------------------
-- Table structure for lg_ship_trx_hdr
-- ----------------------------
DROP TABLE IF EXISTS `lg_ship_trx_hdr`;
CREATE TABLE `lg_ship_trx_hdr` (
  `ship_no` varchar(25) NOT NULL,
  `ship_name` varchar(40) NOT NULL,
  `type` char(255) NOT NULL,
  `doc_rec_date` date NOT NULL,
  `eta_date` date NOT NULL,
  `port_cd` smallint(6) NOT NULL,
  `agent` varchar(40) NOT NULL,
  `month` tinyint(4) NOT NULL,
  `year` smallint(6) NOT NULL,
  `printed` tinyint(4) DEFAULT NULL,
  `user_printed` int(11) DEFAULT NULL,
  `date_printed` date DEFAULT NULL,
  `time_printed` time DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `time_created` time DEFAULT NULL,
  `user_modified` int(11) DEFAULT NULL,
  `date_modified` date DEFAULT NULL,
  `time_modified` time DEFAULT NULL,
  `user_deleted` int(11) DEFAULT NULL,
  `date_deleted` date DEFAULT NULL,
  `time_deleted` time DEFAULT NULL,
  PRIMARY KEY (`ship_no`),
  KEY `lgshiptrx_key` (`ship_no`,`month`,`year`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of lg_ship_trx_hdr
-- ----------------------------

-- ----------------------------
-- Table structure for lg_sub_ledger
-- ----------------------------
DROP TABLE IF EXISTS `lg_sub_ledger`;
CREATE TABLE `lg_sub_ledger` (
  `trx_no` varchar(25) NOT NULL,
  `trx_date` date NOT NULL,
  `debtor_cd` varchar(25) NOT NULL,
  `jo_no` varchar(25) NOT NULL,
  `jo_date` date NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `type` char(1) NOT NULL,
  `mode` char(1) NOT NULL,
  `remarks` varchar(60) DEFAULT NULL,
  `month` tinyint(4) NOT NULL,
  `year` smallint(6) NOT NULL,
  `printed` tinyint(4) DEFAULT NULL,
  `user_printed` int(11) DEFAULT NULL,
  `date_printed` date DEFAULT NULL,
  `time_printed` time DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `time_created` time DEFAULT NULL,
  `user_modified` int(11) DEFAULT NULL,
  `date_modified` date DEFAULT NULL,
  `time_modified` time DEFAULT NULL,
  `user_deleted` int(11) DEFAULT NULL,
  `date_deleted` date DEFAULT NULL,
  `time_deleted` time DEFAULT NULL,
  PRIMARY KEY (`trx_no`),
  KEY `lgsubtrx_key` (`trx_no`,`jo_no`,`debtor_cd`,`month`,`year`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of lg_sub_ledger
-- ----------------------------

-- ----------------------------
-- Table structure for lg_tickets
-- ----------------------------
DROP TABLE IF EXISTS `lg_tickets`;
CREATE TABLE `lg_tickets` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `user_rowID` int(11) NOT NULL,
  `company_rowID` int(11) NOT NULL,
  `dep_rowID` int(11) NOT NULL,
  `datetime` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `category_rowID` tinyint(11) DEFAULT NULL,
  `priority_rowID` tinyint(11) DEFAULT NULL,
  `subject` varchar(30) DEFAULT NULL,
  `description` text,
  `attachment` text,
  `status_rowID` tinyint(4) DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT '0',
  `user_created` int(11) DEFAULT '0',
  `date_created` date DEFAULT '1901-01-01',
  `time_created` time DEFAULT '00:00:00',
  `user_modified` int(11) DEFAULT '0',
  `date_modified` date DEFAULT '1901-01-01',
  `time_modified` time DEFAULT '00:00:00',
  `user_deleted` int(11) DEFAULT '0',
  `date_deleted` date DEFAULT '1901-01-01',
  `time_deleted` time DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lg_tickets
-- ----------------------------

-- ----------------------------
-- Table structure for lg_ticket_replies
-- ----------------------------
DROP TABLE IF EXISTS `lg_ticket_replies`;
CREATE TABLE `lg_ticket_replies` (
  `rowID` bigint(11) NOT NULL AUTO_INCREMENT,
  `comment_rowID` int(11) NOT NULL,
  `user_rowID` int(11) NOT NULL,
  `reply_message` text CHARACTER SET latin1 NOT NULL,
  `deleted` tinyint(4) DEFAULT '0',
  `user_created` int(11) DEFAULT '0',
  `date_created` date DEFAULT '1901-01-01',
  `time_created` time DEFAULT '00:00:00',
  `datetime_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user_modified` int(11) DEFAULT '0',
  `date_modified` date DEFAULT '1901-01-01',
  `time_modified` time DEFAULT '00:00:00',
  `user_deleted` int(11) DEFAULT '0',
  `date_deleted` date DEFAULT '1901-01-01',
  `time_deleted` time DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lg_ticket_replies
-- ----------------------------

-- ----------------------------
-- Table structure for lg_wo_trx_dtl
-- ----------------------------
DROP TABLE IF EXISTS `lg_wo_trx_dtl`;
CREATE TABLE `lg_wo_trx_dtl` (
  `wo_no` varchar(25) NOT NULL,
  `wo_date` date DEFAULT NULL,
  `creditor_cd` varchar(25) NOT NULL,
  `jo_no` varchar(25) NOT NULL,
  `from_cd` varchar(6) NOT NULL,
  `to_cd` varchar(6) NOT NULL,
  `item_cd` varchar(25) NOT NULL,
  `uom_cd` varchar(5) NOT NULL,
  `weight` decimal(10,0) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `month` tinyint(4) NOT NULL,
  `year` smallint(6) NOT NULL,
  `printed` tinyint(4) DEFAULT NULL,
  `user_printed` int(11) DEFAULT NULL,
  `date_printed` date DEFAULT NULL,
  `time_printed` time DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `time_created` time DEFAULT NULL,
  `user_modified` int(11) DEFAULT NULL,
  `date_modified` date DEFAULT NULL,
  `time_modified` time DEFAULT NULL,
  `user_deleted` int(11) DEFAULT NULL,
  `date_deleted` date DEFAULT NULL,
  `time_deleted` time DEFAULT NULL,
  KEY `lgwotrx_key` (`wo_no`,`jo_no`,`creditor_cd`,`month`,`year`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of lg_wo_trx_dtl
-- ----------------------------

-- ----------------------------
-- Table structure for lg_wo_trx_hdr
-- ----------------------------
DROP TABLE IF EXISTS `lg_wo_trx_hdr`;
CREATE TABLE `lg_wo_trx_hdr` (
  `wo_no` varchar(25) NOT NULL,
  `wo_date` date NOT NULL,
  `creditor_cd` varchar(25) NOT NULL,
  `jo_no` varchar(25) NOT NULL,
  `attn1` varchar(40) DEFAULT NULL,
  `attn2` varchar(40) DEFAULT NULL,
  `remarks` varchar(60) NOT NULL,
  `status` char(1) NOT NULL,
  `month` tinyint(4) NOT NULL,
  `year` smallint(6) NOT NULL,
  `printed` tinyint(4) DEFAULT NULL,
  `user_printed` int(11) DEFAULT NULL,
  `date_printed` date DEFAULT NULL,
  `time_printed` time DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `time_created` time DEFAULT NULL,
  `user_modified` int(11) DEFAULT NULL,
  `date_modified` date DEFAULT NULL,
  `time_modified` time DEFAULT NULL,
  `user_deleted` int(11) DEFAULT NULL,
  `date_deleted` date DEFAULT NULL,
  `time_deleted` time DEFAULT NULL,
  PRIMARY KEY (`wo_no`),
  KEY `lgwotrx_key` (`wo_no`,`jo_no`,`creditor_cd`,`month`,`year`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of lg_wo_trx_hdr
-- ----------------------------

-- ----------------------------
-- Table structure for messages
-- ----------------------------
DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_to` int(11) NOT NULL,
  `user_from` int(11) NOT NULL,
  `message` text CHARACTER SET latin1 NOT NULL,
  `status` enum('Read','Unread') CHARACTER SET latin1 NOT NULL DEFAULT 'Unread',
  `attached_file` varchar(100) CHARACTER SET latin1 NOT NULL,
  `date_received` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` enum('Yes','No') CHARACTER SET latin1 NOT NULL DEFAULT 'No',
  PRIMARY KEY (`msg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of messages
-- ----------------------------

-- ----------------------------
-- Table structure for mo_vehicle_condition
-- ----------------------------
DROP TABLE IF EXISTS `mo_vehicle_condition`;
CREATE TABLE `mo_vehicle_condition` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(11) NOT NULL,
  `condition` varchar(30) NOT NULL,
  `estimasi` date NOT NULL,
  `note` text NOT NULL,
  `user_created` int(11) NOT NULL,
  `deleted` tinyint(4) NOT NULL,
  `date_created` date NOT NULL,
  `date_modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`rowID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of mo_vehicle_condition
-- ----------------------------

-- ----------------------------
-- Table structure for mo_vehicle_order
-- ----------------------------
DROP TABLE IF EXISTS `mo_vehicle_order`;
CREATE TABLE `mo_vehicle_order` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(11) NOT NULL,
  `order_number` varchar(30) NOT NULL,
  `status_order` enum('stand by','book','load') NOT NULL,
  `user_created` int(11) NOT NULL,
  `deleted` tinyint(4) NOT NULL,
  `date_created` date NOT NULL,
  `date_modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`rowID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of mo_vehicle_order
-- ----------------------------

-- ----------------------------
-- Table structure for mo_vehicle_position
-- ----------------------------
DROP TABLE IF EXISTS `mo_vehicle_position`;
CREATE TABLE `mo_vehicle_position` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(11) NOT NULL,
  `type` varchar(7) NOT NULL,
  `position` varchar(30) NOT NULL,
  `note` text NOT NULL,
  `car_id` int(11) NOT NULL,
  `terminal_key` varchar(10) NOT NULL,
  `gps_time` int(11) NOT NULL,
  `rcv_time` int(11) NOT NULL,
  `latitude` int(11) NOT NULL,
  `longitude` int(11) NOT NULL,
  `speed` int(11) NOT NULL,
  `status` char(8) NOT NULL,
  `user_created` int(11) NOT NULL,
  `deleted` tinyint(4) NOT NULL,
  `date_created` date NOT NULL,
  `date_modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`rowID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of mo_vehicle_position
-- ----------------------------

-- ----------------------------
-- Table structure for persons
-- ----------------------------
DROP TABLE IF EXISTS `persons`;
CREATE TABLE `persons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(50) DEFAULT NULL,
  `lastName` varchar(50) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `dob` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of persons
-- ----------------------------

-- ----------------------------
-- Table structure for po_trx_dtl
-- ----------------------------
DROP TABLE IF EXISTS `po_trx_dtl`;
CREATE TABLE `po_trx_dtl` (
  `po_no` varchar(25) NOT NULL,
  `po_date` date DEFAULT NULL,
  `creditor_cd` varchar(25) NOT NULL,
  `type` char(1) NOT NULL,
  `cost_cd` varchar(6) NOT NULL,
  `item_cd` varchar(25) NOT NULL,
  `descs` varchar(60) DEFAULT NULL,
  `uom_cd` varchar(5) NOT NULL,
  `qty` decimal(10,0) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `month` tinyint(4) NOT NULL,
  `year` smallint(6) NOT NULL,
  `printed` tinyint(4) DEFAULT NULL,
  `user_printed` int(11) DEFAULT NULL,
  `date_printed` date DEFAULT NULL,
  `time_printed` time DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `time_created` time DEFAULT NULL,
  `user_modified` int(11) DEFAULT NULL,
  `date_modified` date DEFAULT NULL,
  `time_modified` time DEFAULT NULL,
  `user_deleted` int(11) DEFAULT NULL,
  `date_deleted` date DEFAULT NULL,
  `time_deleted` time DEFAULT NULL,
  KEY `potrx_key` (`po_no`,`creditor_cd`,`month`,`year`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of po_trx_dtl
-- ----------------------------

-- ----------------------------
-- Table structure for po_trx_hdr
-- ----------------------------
DROP TABLE IF EXISTS `po_trx_hdr`;
CREATE TABLE `po_trx_hdr` (
  `po_no` varchar(25) NOT NULL,
  `po_date` date NOT NULL,
  `creditor_cd` varchar(25) NOT NULL,
  `attn1` varchar(40) DEFAULT NULL,
  `attn2` varchar(40) DEFAULT NULL,
  `descs` varchar(60) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `status` char(1) NOT NULL,
  `month` tinyint(4) NOT NULL,
  `year` smallint(6) NOT NULL,
  `printed` tinyint(4) DEFAULT NULL,
  `user_printed` int(11) DEFAULT NULL,
  `date_printed` date DEFAULT NULL,
  `time_printed` time DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `time_created` time DEFAULT NULL,
  `user_modified` int(11) DEFAULT NULL,
  `date_modified` date DEFAULT NULL,
  `time_modified` time DEFAULT NULL,
  `user_deleted` int(11) DEFAULT NULL,
  `date_deleted` date DEFAULT NULL,
  `time_deleted` time DEFAULT NULL,
  PRIMARY KEY (`po_no`),
  KEY `potrx_key` (`po_no`,`creditor_cd`,`month`,`year`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of po_trx_hdr
-- ----------------------------

-- ----------------------------
-- Table structure for sa_advance_category
-- ----------------------------
DROP TABLE IF EXISTS `sa_advance_category`;
CREATE TABLE `sa_advance_category` (
  `rowID` smallint(6) NOT NULL AUTO_INCREMENT,
  `advance_cd` char(3) NOT NULL DEFAULT '',
  `advance_name` varchar(60) NOT NULL DEFAULT '',
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`,`advance_cd`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sa_advance_category
-- ----------------------------
INSERT INTO `sa_advance_category` VALUES ('1', 'OPR', 'OPERASIONAL', '0', '0', '1901-01-01', '00:00:00', '0', '11', '2016-09-08', '11:45:58', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_advance_category` VALUES ('2', 'PJK', 'PAJAK', '0', '0', '1901-01-01', '00:00:00', '0', '11', '2016-09-08', '11:46:53', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_advance_category` VALUES ('3', 'UMU', 'UMUM', '0', '0', '1901-01-01', '00:00:00', '0', '11', '2016-09-08', '11:47:05', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_advance_category` VALUES ('4', 'WRK', 'WORKSHOP', '0', '0', '1901-01-01', '00:00:00', '0', '11', '2016-09-08', '11:47:18', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_advance_category` VALUES ('5', 'DOC', 'DOCUMENT', '0', '0', '1901-01-01', '00:00:00', '0', '11', '2016-09-08', '11:47:42', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_advance_category` VALUES ('6', 'JMN', 'JAMINAN', '0', '0', '1901-01-01', '00:00:00', '0', '11', '2016-09-08', '11:47:52', '11', '2016-09-08', '11:51:11', '0', '1901-01-01', '00:00:00');

-- ----------------------------
-- Table structure for sa_advance_type
-- ----------------------------
DROP TABLE IF EXISTS `sa_advance_type`;
CREATE TABLE `sa_advance_type` (
  `rowID` smallint(6) NOT NULL AUTO_INCREMENT,
  `advance_cd` varchar(6) NOT NULL DEFAULT '',
  `advance_name` varchar(60) NOT NULL DEFAULT '',
  `by_jo` char(1) NOT NULL DEFAULT 'N',
  `only_driver` char(1) NOT NULL DEFAULT 'N',
  `fare_trip` char(1) NOT NULL DEFAULT 'N',
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`,`advance_cd`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sa_advance_type
-- ----------------------------
INSERT INTO `sa_advance_type` VALUES ('1', '01', 'UANG JALAN', 'Y', 'Y', 'Y', '0', '0', '0000-00-00', '00:00:00', '0', '0', '2015-10-21', '13:59:32', '0', '0000-00-00', '00:00:00', '0', '0000-00-00', '00:00:00');
INSERT INTO `sa_advance_type` VALUES ('2', '02', 'BIAYA LAIN-LAIN', 'Y', 'N', 'Y', '0', '0', '0000-00-00', '00:00:00', '0', '0', '2015-10-21', '14:00:16', '0', '0000-00-00', '00:00:00', '0', '0000-00-00', '00:00:00');
INSERT INTO `sa_advance_type` VALUES ('3', '03', 'BIAYA OPERASIONAL', 'N', 'N', 'N', '0', '0', '0000-00-00', '00:00:00', '0', '0', '2015-10-21', '14:02:27', '0', '0000-00-00', '00:00:00', '0', '0000-00-00', '00:00:00');
INSERT INTO `sa_advance_type` VALUES ('4', '99', 'PINJAMAN', 'N', 'N', 'N', '0', '0', '0000-00-00', '00:00:00', '0', '0', '2015-10-21', '14:03:10', '0', '0000-00-00', '00:00:00', '0', '0000-00-00', '00:00:00');

-- ----------------------------
-- Table structure for sa_ap_type
-- ----------------------------
DROP TABLE IF EXISTS `sa_ap_type`;
CREATE TABLE `sa_ap_type` (
  `rowID` smallint(6) NOT NULL AUTO_INCREMENT,
  `ap_type_cd` varchar(6) NOT NULL DEFAULT '',
  `ap_type_name` varchar(60) NOT NULL DEFAULT '',
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`,`ap_type_cd`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sa_ap_type
-- ----------------------------
INSERT INTO `sa_ap_type` VALUES ('1', '2000', 'PAJAK', '0', '0', '0000-00-00', '00:00:00', '1', '0', '0000-00-00', '00:00:00', '0', '0000-00-00', '00:00:00', '0', '2015-10-05', '09:54:36');
INSERT INTO `sa_ap_type` VALUES ('2', '3000', 'NON PAJAK', '0', '0', '0000-00-00', '00:00:00', '0', '0', '0000-00-00', '00:00:00', '0', '2015-10-05', '09:56:16', '0', '0000-00-00', '00:00:00');

-- ----------------------------
-- Table structure for sa_brand
-- ----------------------------
DROP TABLE IF EXISTS `sa_brand`;
CREATE TABLE `sa_brand` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(150) NOT NULL DEFAULT '0',
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`),
  KEY `rowID` (`rowID`),
  KEY `deleted` (`deleted`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sa_brand
-- ----------------------------
INSERT INTO `sa_brand` VALUES ('1', 'Michellin', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-25', '10:34:18', '1', '2016-11-25', '10:41:21', '0', '0', '0000-00-00', '00:00:00');
INSERT INTO `sa_brand` VALUES ('2', 'Bridgestone', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-25', '10:41:06', '0', '1901-01-01', '00:00:00', '0', '0', '0000-00-00', '00:00:00');

-- ----------------------------
-- Table structure for sa_bugs
-- ----------------------------
DROP TABLE IF EXISTS `sa_bugs`;
CREATE TABLE `sa_bugs` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `issue_ref` int(11) NOT NULL,
  `project` int(11) NOT NULL,
  `reporter` int(11) NOT NULL,
  `assigned_to` int(11) NOT NULL,
  `bug_status` enum('Unconfirmed','Confirmed','In Progress','Resolved','Verified') CHARACTER SET latin1 NOT NULL DEFAULT 'Unconfirmed',
  `priority` varchar(100) CHARACTER SET latin1 NOT NULL,
  `bug_description` text CHARACTER SET latin1 NOT NULL,
  `reported_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_modified` varchar(64) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`rowID`),
  UNIQUE KEY `issue_ref` (`issue_ref`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sa_bugs
-- ----------------------------

-- ----------------------------
-- Table structure for sa_bug_comments
-- ----------------------------
DROP TABLE IF EXISTS `sa_bug_comments`;
CREATE TABLE `sa_bug_comments` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `bug_id` int(11) NOT NULL,
  `comment_by` int(11) NOT NULL,
  `comment` text CHARACTER SET latin1 NOT NULL,
  `date_commented` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sa_bug_comments
-- ----------------------------

-- ----------------------------
-- Table structure for sa_bug_files
-- ----------------------------
DROP TABLE IF EXISTS `sa_bug_files`;
CREATE TABLE `sa_bug_files` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `bug` int(11) NOT NULL,
  `file_name` text CHARACTER SET latin1 NOT NULL,
  `description` text CHARACTER SET latin1 NOT NULL,
  `uploaded_by` int(11) NOT NULL,
  `date_posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sa_bug_files
-- ----------------------------

-- ----------------------------
-- Table structure for sa_captcha
-- ----------------------------
DROP TABLE IF EXISTS `sa_captcha`;
CREATE TABLE `sa_captcha` (
  `captcha_id` bigint(13) unsigned NOT NULL AUTO_INCREMENT,
  `captcha_time` int(10) unsigned NOT NULL,
  `ip_address` varchar(16) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `word` varchar(20) CHARACTER SET latin1 NOT NULL DEFAULT '',
  PRIMARY KEY (`captcha_id`),
  KEY `word` (`word`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sa_captcha
-- ----------------------------

-- ----------------------------
-- Table structure for sa_cb_charge_to
-- ----------------------------
DROP TABLE IF EXISTS `sa_cb_charge_to`;
CREATE TABLE `sa_cb_charge_to` (
  `rowID` smallint(6) NOT NULL AUTO_INCREMENT,
  `expense_cd` varchar(20) NOT NULL DEFAULT '',
  `descs` varchar(60) NOT NULL DEFAULT '',
  `expense_acc_rowID` smallint(20) NOT NULL DEFAULT '0',
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`,`expense_cd`),
  KEY `rowID` (`rowID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sa_cb_charge_to
-- ----------------------------
INSERT INTO `sa_cb_charge_to` VALUES ('1', '1101', 'PERLENGKAPAN KANTOR', '198', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cb_charge_to` VALUES ('2', '1102', 'TELPON & FAX', '199', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cb_charge_to` VALUES ('3', '1103', 'TRANSPORT,TOLL DLL', '200', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cb_charge_to` VALUES ('4', '1104', 'LISTRIK', '201', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cb_charge_to` VALUES ('5', '1105', 'AIR', '202', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cb_charge_to` VALUES ('6', '11111', 'SSSSSSSSSSSSSSSSSSSSS', '168', '0', '0', '1901-01-01', '00:00:00', '1', '11', '2016-02-18', '08:46:28', '0', '1901-01-01', '00:00:00', '11', '2016-02-18', '08:46:56');

-- ----------------------------
-- Table structure for sa_comp
-- ----------------------------
DROP TABLE IF EXISTS `sa_comp`;
CREATE TABLE `sa_comp` (
  `company_config` varchar(255) NOT NULL DEFAULT '',
  `company_value` text,
  PRIMARY KEY (`company_config`),
  KEY `key_companyconfig` (`company_config`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sa_comp
-- ----------------------------
INSERT INTO `sa_comp` VALUES ('address1', 'RUKAN ARTHA GADING NIAGA BLOK B NO. 21-22, JL. BOULEVARD ARTHA GADING KELURAHAN ARTHA GADING BARAT');
INSERT INTO `sa_comp` VALUES ('address2', 'KELAPA GADING');
INSERT INTO `sa_comp` VALUES ('address3', 'JAKARTA UTARA');
INSERT INTO `sa_comp` VALUES ('bank_account_name', 'BERJAYA INDAH GEMILANG');
INSERT INTO `sa_comp` VALUES ('bank_account_no', '2288-20-1368');
INSERT INTO `sa_comp` VALUES ('bank_address_line_1', 'Komp. Puri Niaga III Jl. Puri Kencana Blok M-8 No 1 JKL');
INSERT INTO `sa_comp` VALUES ('bank_address_line_2', 'Jakarta Barat, DKI Jakarta, Indonesia 11610');
INSERT INTO `sa_comp` VALUES ('bank_name', 'BANK MAYBANK KCP PURI KENCANA');
INSERT INTO `sa_comp` VALUES ('company_logo', 'logo.png');
INSERT INTO `sa_comp` VALUES ('comp_cd', 'BIG');
INSERT INTO `sa_comp` VALUES ('comp_id', '4');
INSERT INTO `sa_comp` VALUES ('comp_name', 'BERJAYA INDAH GEMILANG');
INSERT INTO `sa_comp` VALUES ('decimal_separator', ',');
INSERT INTO `sa_comp` VALUES ('default_currency', 'IDR');
INSERT INTO `sa_comp` VALUES ('default_currency_symbol', 'Rp');
INSERT INTO `sa_comp` VALUES ('email1', 'admin@big-tms.com');
INSERT INTO `sa_comp` VALUES ('email2', 'admin@big-tms.com');
INSERT INTO `sa_comp` VALUES ('fax1', '02145857623');
INSERT INTO `sa_comp` VALUES ('fax2', '0');
INSERT INTO `sa_comp` VALUES ('manager_keuangan', 'HENDRO WIJAYA');
INSERT INTO `sa_comp` VALUES ('nppkp_no', '01.882.136.3-045.000');
INSERT INTO `sa_comp` VALUES ('npwp_address1', 'SARANG BANGO NO. 170 RT.008 RW.002 MARUNDA');
INSERT INTO `sa_comp` VALUES ('npwp_address2', 'CILINCING');
INSERT INTO `sa_comp` VALUES ('npwp_address3', 'JAKARTA UTARA');
INSERT INTO `sa_comp` VALUES ('npwp_no', '01.882.136.3-045.000');
INSERT INTO `sa_comp` VALUES ('npwp_post_cd', '11750');
INSERT INTO `sa_comp` VALUES ('post_cd', '14240');
INSERT INTO `sa_comp` VALUES ('reg_date', '2015-04-04');
INSERT INTO `sa_comp` VALUES ('rowID', '1');
INSERT INTO `sa_comp` VALUES ('telp1', '02145857621');
INSERT INTO `sa_comp` VALUES ('telp2', '02145857622');
INSERT INTO `sa_comp` VALUES ('ticket_files', '/file_attachment/IT/ticket/');
INSERT INTO `sa_comp` VALUES ('website', 'www.big-tms.com');

-- ----------------------------
-- Table structure for sa_config
-- ----------------------------
DROP TABLE IF EXISTS `sa_config`;
CREATE TABLE `sa_config` (
  `config_key` varchar(255) CHARACTER SET latin1 NOT NULL,
  `value` text CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`config_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sa_config
-- ----------------------------
INSERT INTO `sa_config` VALUES ('allowed_files', 'gif|jpg|png|pdf|doc|txt|docx|xls|zip|rar');
INSERT INTO `sa_config` VALUES ('base_url2', 'http://localhost/big_tms');
INSERT INTO `sa_config` VALUES ('biaya_stand_by', '25000');
INSERT INTO `sa_config` VALUES ('biaya_uang_makan', '25000');
INSERT INTO `sa_config` VALUES ('company_address', 'INDONESIA');
INSERT INTO `sa_config` VALUES ('company_city', 'DKI JAKARTA');
INSERT INTO `sa_config` VALUES ('company_country', 'INDONESIA');
INSERT INTO `sa_config` VALUES ('company_domain', 'http://big-tms.com');
INSERT INTO `sa_config` VALUES ('company_email', 'hendro@big-tms.com');
INSERT INTO `sa_config` VALUES ('company_logo', 'logo.png');
INSERT INTO `sa_config` VALUES ('company_name', 'PT BERJAYA INDAH GEMILANG');
INSERT INTO `sa_config` VALUES ('company_phone', '+622145847711');
INSERT INTO `sa_config` VALUES ('contact_person', 'HD');
INSERT INTO `sa_config` VALUES ('cron_key', '34WI2L12L87I1A65M90M9A42N41D08A26I');
INSERT INTO `sa_config` VALUES ('default_tax', '10');
INSERT INTO `sa_config` VALUES ('default_terms', 'Thank you for your business. Please process this invoice within the due date.');
INSERT INTO `sa_config` VALUES ('demo_mode', 'FALSE');
INSERT INTO `sa_config` VALUES ('destination_id', '49');
INSERT INTO `sa_config` VALUES ('destination_name', 'Tes');
INSERT INTO `sa_config` VALUES ('developer', 'ig63Yd/+yuA8127gEyTz9TY4pnoeKq8dtocVP44+BJvtlRp8Vqcetwjk51dhSB6Rx8aVIKOPfUmNyKGWK7C/gg==');
INSERT INTO `sa_config` VALUES ('email_estimate_message', 'Hi {CLIENT}<br>\r\nThanks for your business inquiry. <br>\r\n\r\nThe estimate EST {REF} is attached with this email. <br>\r\nEstimate Overview:<br>\r\nEstimate # : EST {REF}<br>\r\nAmount: {CURRENCY} {AMOUNT}<br>\r\n \r\nYou can view the estimate online at:<br>\r\n{LINK}<br>\r\n\r\nBest Regards,<br>\r\n{COMPANY}');
INSERT INTO `sa_config` VALUES ('email_invoice_message', 'Hello {CLIENT}<br>\r\nHere is the invoice of {CURRENCY} {AMOUNT}<br>\r\nYou can view the invoice online at:<br>\r\n\r\n{LINK}<br>\r\n\r\n\r\nBest Regards,<br>\r\n\r\n{COMPANY}');
INSERT INTO `sa_config` VALUES ('file_max_size', '8000');
INSERT INTO `sa_config` VALUES ('invoice_logo', 'invoice_logo.png');
INSERT INTO `sa_config` VALUES ('language', 'english');
INSERT INTO `sa_config` VALUES ('limit_queue', '7200');
INSERT INTO `sa_config` VALUES ('max_percent_realization', '60');
INSERT INTO `sa_config` VALUES ('password_api', 'tik321+');
INSERT INTO `sa_config` VALUES ('password_default', '123456');
INSERT INTO `sa_config` VALUES ('paypal_cancel_url', 'paypal/cancel');
INSERT INTO `sa_config` VALUES ('paypal_email', 'hendro@big-tms.com');
INSERT INTO `sa_config` VALUES ('paypal_ipn_url', 'paypal/t_ipn/ipn');
INSERT INTO `sa_config` VALUES ('paypal_live', 'TRUE');
INSERT INTO `sa_config` VALUES ('paypal_success_url', 'paypal/success');
INSERT INTO `sa_config` VALUES ('point_price', '1000');
INSERT INTO `sa_config` VALUES ('protocol', 'smtp');
INSERT INTO `sa_config` VALUES ('reload_url', '300');
INSERT INTO `sa_config` VALUES ('reminder_message', 'Hello {CLIENT}<br>\r\nThis is a friendly reminder to pay your invoice of {CURRENCY} {AMOUNT}<br>\r\n\r\nYou can view the invoice online at:<br>\r\n\r\n{LINK}<br>\r\n\r\n\r\nBest Regards,<br>\r\n\r\n{COMPANY}');
INSERT INTO `sa_config` VALUES ('reset_key', '34WI2L12L87I1A65M90M9A42N41D08A26I');
INSERT INTO `sa_config` VALUES ('sidebar_theme', 'dark');
INSERT INTO `sa_config` VALUES ('site_author', 'Berjaya Indah Gemilang');
INSERT INTO `sa_config` VALUES ('site_desc', 'Transportation Management Systems is The New ERP Logistic\'s Application ');
INSERT INTO `sa_config` VALUES ('smtp_host', '200.10.10.2');
INSERT INTO `sa_config` VALUES ('smtp_pass', '/fhYfOFhZ61EilmGTh3a6wCX4JQ4FnVG1GqSUEcYCvfZy1CnkI+l5BZEZmbIfYW7MuHS46MZbTH3RH7jIEfTZQ==');
INSERT INTO `sa_config` VALUES ('smtp_port', '25');
INSERT INTO `sa_config` VALUES ('smtp_user', 'hendro@big-tms.com');
INSERT INTO `sa_config` VALUES ('thousand_separator', '.');
INSERT INTO `sa_config` VALUES ('timezone', 'Asia/Bangkok');
INSERT INTO `sa_config` VALUES ('username_api', 'tik_api');
INSERT INTO `sa_config` VALUES ('use_postmark', 'FALSE');
INSERT INTO `sa_config` VALUES ('webmaster_email', 'hendro@big-tms.com');
INSERT INTO `sa_config` VALUES ('website_name', 'Transportation Management Systems');

-- ----------------------------
-- Table structure for sa_cost
-- ----------------------------
DROP TABLE IF EXISTS `sa_cost`;
CREATE TABLE `sa_cost` (
  `rowID` smallint(6) NOT NULL AUTO_INCREMENT,
  `type` char(1) NOT NULL DEFAULT 'D',
  `cost_cd` varchar(20) NOT NULL DEFAULT '',
  `descs` varchar(60) NOT NULL DEFAULT '',
  `wip_acc_rowID` smallint(20) NOT NULL DEFAULT '0',
  `cogs_acc_rowID` smallint(20) NOT NULL DEFAULT '0',
  `fare_trip_comp` char(1) NOT NULL DEFAULT 'N',
  `site_flag` char(1) NOT NULL DEFAULT 'Y',
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`,`cost_cd`),
  KEY `rowID` (`rowID`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sa_cost
-- ----------------------------
INSERT INTO `sa_cost` VALUES ('1', 'H', '5100000', 'BIAYA OPERATIONAL', '0', '0', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('2', 'D', '5101001', 'UANG JALAN TRUK', '41', '119', 'Y', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('3', 'H', '5102000', 'BIAYA PERBAIKAN/PEMELIHARAAN K', '0', '0', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('4', 'D', '5102001', 'BIAYA PERBAIKAN BUNTUT', '41', '121', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('5', 'D', '5102003', 'BIAYA PERBAIKAN DAMTREK', '41', '122', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('6', 'H', '5103000', 'BIAYA PERIZINAN', '41', '123', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('7', 'D', '5103001', 'BIAYA PERIZINAN BUNTUT', '41', '124', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('8', 'D', '5103002', 'BIAYA PERIZINAN DAMTREK', '41', '125', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('9', 'H', '5104000', 'BIAYA KOMISI', '0', '0', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('10', 'D', '5104001', 'BI KOMISI SUPIR', '41', '127', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('11', 'D', '5104002', 'BI BANTUAN KENEK', '41', '128', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('12', 'H', '5105000', 'BIAYA EXTRA SUPIR', '0', '0', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('13', 'D', '5105001', 'BI EXTRA KAWAL', '41', '130', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('14', 'D', '5105002', 'BI EXTRA MUAT / BAWA', '41', '131', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('15', 'D', '5105003', 'BI EXTRA BONGKAR', '41', '132', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('16', 'D', '5105004', 'BI EXTRA NGINAP', '41', '133', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('17', 'D', '5105005', 'BI EXTRA UANG MAKAN', '41', '134', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('18', 'D', '5105006', 'BI EXTRA KPLP', '41', '135', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('19', 'D', '5105007', 'BI EXTRA BAWA CONT KOSONGAN', '41', '136', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('20', 'D', '5105008', 'BI EXTRA PENUMPUKAN CONTAINER', '41', '137', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('21', 'D', '5105009', 'BI EXTRA KEAMANAN', '41', '138', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('22', 'D', '5105010', 'BI EXTRA BATAL MUAT', '41', '139', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('23', 'D', '5105011', 'BI EXTRA TURUN/NAIK CONTAINER', '41', '140', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('24', 'D', '5105012', 'BI EXTRA KOSONGAN', '41', '141', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('25', 'D', '5105013', 'BI EXTRA NGEPOK', '41', '142', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('26', 'D', '5105014', 'BI ONGKOS ANGKUT', '41', '143', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('27', 'D', '5105015', 'BI EXTRA BATAL BONGKAR', '41', '144', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('28', 'D', '5105016', 'BI EXTRA UANG JALAN', '41', '145', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('29', 'D', '5105999', 'BI LAIN-LAIN', '41', '146', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('30', 'H', '5200000', 'KOMPONEN UANG JALAN', '0', '0', 'Y', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('31', 'D', '5201001', 'SEWA KENDARAAN', '41', '148', 'Y', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('32', 'D', '5201002', 'RATE TO CUSTOMER', '41', '149', 'Y', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('33', 'D', '5201003', 'ONGKOS ANGKUT', '41', '150', 'Y', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('34', 'D', '5201004', 'MULTI DROP', '41', '151', 'Y', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('35', 'D', '5201005', 'BIAYA BONGKAR', '41', '152', 'Y', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('36', 'D', '5201006', 'GASOLINE', '41', '153', 'Y', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('37', 'D', '5201007', 'BIAYA TAMBAHAN', '41', '154', 'Y', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('38', 'D', '5201008', 'TOL & PARKIR', '41', '155', 'Y', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('39', 'D', '5201009', 'MEL', '41', '156', 'Y', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('40', 'D', '5201010', 'PORTAL', '41', '157', 'Y', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('41', 'D', '5201011', 'DSP', '41', '158', 'Y', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('42', 'D', '5201012', 'O/B', '41', '159', 'Y', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('43', 'D', '5201013', 'RITASE', '41', '160', 'Y', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('44', 'D', '5201014', 'RATE TRANSPORTER', '41', '161', 'Y', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('45', 'D', '5201015', 'LOADING FEE', '41', '162', 'Y', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('46', 'D', '5201016', 'UNLOADING FEE', '41', '163', 'Y', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('47', 'D', '5201017', 'PACKING / WEIGHT CHANGE', '41', '164', 'Y', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('48', 'D', '5201018', 'ROAD DISPENSATION', '41', '165', 'Y', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('49', 'D', '5201019', 'OTHER', '41', '166', 'Y', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('50', 'D', '5201020', 'OVERNIGHT', '41', '167', 'Y', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('51', 'D', '5201021', 'HELPER', '41', '168', 'Y', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('52', 'D', '5201022', 'HANDLING FEE', '41', '169', 'Y', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('53', 'D', '5201023', 'OPERATIONAL COST', '41', '170', 'Y', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('54', 'D', '5201024', 'COST LABOUR', '41', '171', 'Y', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('55', 'D', '5201025', 'LIFT OFF', '41', '172', 'Y', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('56', 'D', '5201026', 'CLEANING', '41', '173', 'Y', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('57', 'D', '5201027', 'ADMINISTRATION FEE', '41', '174', 'Y', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('58', 'D', '5201028', 'UNLOADING NUTRIFOOD', '41', '175', 'Y', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('59', 'D', '5201029', 'MAINTENANCE NUTRIFOOD', '41', '176', 'Y', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('60', 'D', '5201030', 'MAINTENANCE CAR & TRUCK', '41', '177', 'Y', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('61', 'D', '5201031', 'SPARE PART CAR & TRUCK', '41', '178', 'Y', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('62', 'D', '5201032', 'REGISTRATION CAR & TRUCK', '41', '179', 'Y', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('63', 'D', '5201033', 'MULTI PICK UP', '41', '180', 'Y', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('64', 'D', '5201034', 'OVERWEIGHT', '41', '181', 'Y', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('65', 'D', '5101002', 'OVERLOAD', '59', '59', 'Y', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1', '2016-09-25', '00:18:40', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('66', 'D', '5101003', 'EXTRA TONASE', '59', '59', 'Y', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1', '2016-09-25', '00:19:20', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_cost` VALUES ('67', 'D', '5101004', 'BONUS 3 RIT', '59', '59', 'Y', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1', '2016-09-25', '00:19:53', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');

-- ----------------------------
-- Table structure for sa_creditor
-- ----------------------------
DROP TABLE IF EXISTS `sa_creditor`;
CREATE TABLE `sa_creditor` (
  `rowID` smallint(6) NOT NULL AUTO_INCREMENT,
  `year` smallint(4) NOT NULL DEFAULT '1901',
  `code` smallint(6) NOT NULL DEFAULT '0',
  `creditor_cd` varchar(25) NOT NULL DEFAULT '',
  `creditor_name` varchar(60) NOT NULL DEFAULT '',
  `creditor_type_rowID` smallint(6) NOT NULL DEFAULT '0',
  `category` char(1) NOT NULL DEFAULT 'C',
  `supplier_type` char(1) NOT NULL DEFAULT 'E',
  `id_type` char(1) NOT NULL DEFAULT '',
  `id_no` varchar(40) NOT NULL DEFAULT '',
  `address1` varchar(60) NOT NULL DEFAULT '',
  `address2` varchar(60) NOT NULL DEFAULT '',
  `address3` varchar(40) NOT NULL DEFAULT '',
  `post_cd` varchar(5) NOT NULL DEFAULT '',
  `hp_no1` varchar(20) NOT NULL DEFAULT '',
  `hp_no2` varchar(20) NOT NULL DEFAULT '',
  `telp_no1` varchar(20) NOT NULL DEFAULT '',
  `telp_no2` varchar(20) NOT NULL DEFAULT '',
  `fax_no1` varchar(20) NOT NULL DEFAULT '',
  `fax_no2` varchar(20) NOT NULL DEFAULT '',
  `contact_prs` varchar(40) NOT NULL DEFAULT '',
  `website` varchar(60) NOT NULL DEFAULT '',
  `email` varchar(60) NOT NULL DEFAULT '',
  `sex` char(1) NOT NULL DEFAULT '',
  `pob` varchar(40) NOT NULL DEFAULT '',
  `dob` date NOT NULL DEFAULT '1901-01-01',
  `npwp_no` varchar(20) NOT NULL DEFAULT '',
  `npwp_name` varchar(60) NOT NULL DEFAULT '',
  `reg_date` date NOT NULL DEFAULT '1901-01-01',
  `npwp_address1` varchar(60) NOT NULL DEFAULT '',
  `npwp_address2` varchar(60) NOT NULL DEFAULT '',
  `npwp_address3` varchar(40) NOT NULL DEFAULT '',
  `bank_acc1` varchar(40) NOT NULL DEFAULT '',
  `bank_acc_name1` varchar(40) NOT NULL DEFAULT '',
  `bank_name1` varchar(40) NOT NULL DEFAULT '',
  `bank_address1` varchar(60) NOT NULL DEFAULT '',
  `bank_acc2` varchar(40) NOT NULL DEFAULT '',
  `bank_acc_name2` varchar(40) NOT NULL DEFAULT '',
  `bank_name2` varchar(40) NOT NULL DEFAULT '',
  `bank_address2` varchar(60) NOT NULL DEFAULT '',
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`,`year`,`code`),
  KEY `rowID` (`rowID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sa_creditor
-- ----------------------------
INSERT INTO `sa_creditor` VALUES ('1', '2016', '5', '0005', 'PT ANTARTIKA NUSANTARA', '1', 'I', 'E', 'K', '32145678923', 'Jalan Kebonjeruk', 'Kecamatan Tanah Abang', 'Kota Jakarta Pusat', '21210', '0838123456785', '0812345678905', '0212345678905', '0213456789115', '021212125', '021344551', 'Ujang', 'antartikanusantara.com', 'info@antartikanusantara.com', 'F', 'Jakarta', '2000-08-01', '321.092-1395', 'Antartika', '2013-08-04', 'Jalan Sudirman', 'Kecamatan Sudirman', 'Kota Jakarta Pusat', 'Mandiri', 'Bank Mandiri', 'Bank Mandiri', '', 'BNI46', 'Bank BNI46', 'Bank BNI46', '', '0', '0', '1901-01-01', '00:00:00', '11', '2016-08-19', '09:30:29', '11', '2016-08-19', '10:20:28', '0', '11', '2016-08-19', '10:20:51');
INSERT INTO `sa_creditor` VALUES ('2', '2016', '6', '0006', 'PT MANDALA JAYA', '1', 'C', 'E', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '1970-01-01', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '11', '2016-08-19', '10:21:50', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_creditor` VALUES ('3', '2016', '7', '0007', 'PT BAWANG JAYA', '2', 'C', 'E', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '1970-01-01', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '11', '2016-08-19', '10:22:18', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_creditor` VALUES ('4', '2016', '8', '0008', 'PT SAKTI JAYA', '1', 'C', 'E', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '1970-01-01', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '11', '2016-08-19', '10:25:14', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_creditor` VALUES ('5', '2016', '9', '0009', 'PT KENCANA MITRA', '1', 'C', 'E', 'K', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '1970-01-01', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '11', '2016-08-19', '10:25:36', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_creditor` VALUES ('6', '2016', '10', '0010', 'TIRTA NUSA PERSADA(MAN)', '1', 'C', 'E', 'K', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '1970-01-01', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '1', '2016-10-05', '11:29:24', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');

-- ----------------------------
-- Table structure for sa_creditor_type
-- ----------------------------
DROP TABLE IF EXISTS `sa_creditor_type`;
CREATE TABLE `sa_creditor_type` (
  `rowID` smallint(6) NOT NULL AUTO_INCREMENT,
  `type_cd` varchar(6) NOT NULL DEFAULT '',
  `descs` varchar(60) NOT NULL DEFAULT '',
  `payable_coa_rowID` smallint(6) NOT NULL DEFAULT '0',
  `advance_coa_rowID` smallint(6) NOT NULL DEFAULT '0',
  `deposit_coa_rowID` smallint(6) NOT NULL DEFAULT '0',
  `rounding_coa_rowID` smallint(6) NOT NULL DEFAULT '0',
  `adm_coa_rowID` smallint(6) NOT NULL DEFAULT '0',
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`,`type_cd`),
  KEY `rowID` (`rowID`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sa_creditor_type
-- ----------------------------
INSERT INTO `sa_creditor_type` VALUES ('1', 'ANG', 'ANGKUTAN', '0', '0', '0', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_creditor_type` VALUES ('2', 'UMU', 'UMUM', '0', '0', '0', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');

-- ----------------------------
-- Table structure for sa_debtor
-- ----------------------------
DROP TABLE IF EXISTS `sa_debtor`;
CREATE TABLE `sa_debtor` (
  `rowID` smallint(6) NOT NULL AUTO_INCREMENT,
  `type` char(1) NOT NULL DEFAULT 'C',
  `year` int(4) NOT NULL DEFAULT '0',
  `code` int(4) NOT NULL DEFAULT '0',
  `debtor_cd` varchar(25) NOT NULL DEFAULT '',
  `debtor_name` varchar(60) NOT NULL DEFAULT '',
  `category` char(1) NOT NULL DEFAULT 'C',
  `debtor_type` enum('internal','external') NOT NULL,
  `spare_driver` tinyint(4) NOT NULL,
  `active_period` date NOT NULL,
  `finger_rowID` int(5) NOT NULL,
  `no_ktp` varchar(16) NOT NULL,
  `expired_date_ktp` date NOT NULL,
  `id_type` char(1) NOT NULL DEFAULT '',
  `id_no` varchar(40) NOT NULL DEFAULT '',
  `expired_date_id` date NOT NULL,
  `address1` varchar(60) NOT NULL DEFAULT '',
  `address2` varchar(60) NOT NULL DEFAULT '',
  `address3` varchar(40) NOT NULL DEFAULT '',
  `post_cd` varchar(5) NOT NULL DEFAULT '',
  `hp_no1` varchar(20) NOT NULL DEFAULT '',
  `hp_no2` varchar(20) NOT NULL DEFAULT '',
  `telp_no1` varchar(20) NOT NULL DEFAULT '',
  `telp_no2` varchar(20) NOT NULL DEFAULT '',
  `fax_no1` varchar(20) NOT NULL DEFAULT '',
  `fax_no2` varchar(20) NOT NULL DEFAULT '',
  `contact_prs` varchar(40) NOT NULL DEFAULT '',
  `website` varchar(60) NOT NULL DEFAULT '',
  `email` varchar(60) NOT NULL DEFAULT '',
  `sex` char(1) NOT NULL DEFAULT '',
  `pob` varchar(45) NOT NULL DEFAULT '',
  `dob` date NOT NULL DEFAULT '1901-01-01',
  `debtor_photo` varchar(100) NOT NULL,
  `debtor_photo_ktp` varchar(100) NOT NULL,
  `debtor_photo_sim` varchar(100) NOT NULL,
  `npwp_no` varchar(20) NOT NULL DEFAULT '',
  `npwp_name` varchar(60) NOT NULL DEFAULT '',
  `reg_date` date NOT NULL DEFAULT '1901-01-01',
  `npwp_address1` varchar(60) NOT NULL DEFAULT '',
  `npwp_address2` varchar(60) NOT NULL DEFAULT '',
  `npwp_address3` varchar(40) NOT NULL DEFAULT '',
  `bank_acc1` varchar(40) NOT NULL DEFAULT '',
  `bank_acc_name1` varchar(40) NOT NULL DEFAULT '',
  `bank_name1` varchar(40) NOT NULL DEFAULT '',
  `bank_address1` varchar(60) NOT NULL DEFAULT '',
  `bank_acc2` varchar(40) NOT NULL DEFAULT '',
  `bank_acc_name2` varchar(40) NOT NULL DEFAULT '',
  `bank_name2` varchar(40) NOT NULL DEFAULT '',
  `bank_address2` varchar(60) NOT NULL DEFAULT '',
  `driving_license` char(2) NOT NULL DEFAULT '',
  `driving_license_no` varchar(25) NOT NULL DEFAULT '',
  `driving_license_expired` date NOT NULL DEFAULT '1901-01-01',
  `debtor_type_rowID` int(6) NOT NULL DEFAULT '0',
  `cash_adv_counter` tinyint(6) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`,`type`,`year`,`code`),
  KEY `rowID` (`rowID`),
  KEY `debtor_cd` (`debtor_cd`),
  KEY `debtor_name` (`debtor_name`),
  KEY `category` (`category`),
  KEY `id_type` (`id_type`),
  KEY `pob` (`pob`),
  KEY `dob` (`dob`)
) ENGINE=InnoDB AUTO_INCREMENT=119 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sa_debtor
-- ----------------------------
INSERT INTO `sa_debtor` VALUES ('1', 'D', '2016', '1', '0001', 'BREW AHMAD', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '068', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:08:16', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('2', 'D', '2016', '2', '0002', 'RIFAI', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '3603021305680002', '1970-01-01', 'TANGERANG', 'KP. DANGDEUR RT01/01', 'DANGDEUR, JAYANTI', '', '', '', '', '', '', '', '', '', '', 'M', 'TANGERANG', '1968-05-13', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:08:36', '2', '2016-09-16', '17:25:06', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('3', 'D', '2016', '3', '0003', 'ARNO', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '080', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:08:52', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('4', 'D', '2016', '4', '0004', 'NEDY J', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '090', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:09:21', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('5', 'D', '2016', '5', '0005', 'MAJID', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '114', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:10:09', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('6', 'D', '2016', '6', '0006', 'SULAEMAN BIN UMAR (AJO)', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'S', '730513220354', '2020-05-15', 'KP. PARIUK MESJID RT01/05', 'DS. SUKAMEKARSARI', 'KALANGANYAR-LEBAK', '', '', '', '', '', '', '', '', '', '', 'M', 'LEBAK', '1973-05-15', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:10:32', '2', '2016-09-22', '10:13:47', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('7', 'D', '2016', '7', '0072', 'PARWONO', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '3602122712710001', '1970-01-01', 'BANYUMAS', 'KP. CIOMAS RT02/01', 'SINDANGSARI, SAJIRA', '', '', '', '', '', '', '', '', '', '', 'M', 'BANYUMAS', '1971-12-27', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:11:11', '2', '2016-09-16', '16:46:32', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('8', 'D', '2016', '8', '0008', 'SANALI', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'S', '870725260877', '2019-07-15', 'KP. GENGGONG , RT02/01', 'JUNTI', 'JAWILAN', '', '', '', '', '', '', '', '', '', '', 'M', 'SERANG', '1988-02-07', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:11:28', '2', '2016-09-22', '10:24:49', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('9', 'D', '2016', '9', '0009', 'JANATA', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'S', '760913200971', '2020-09-26', 'KP. GENGGONG , RT02/01', 'JUNTI', 'JAWILAN', '', '', '', '', '', '', '', '', '', '', 'M', 'SERANG', '1978-06-21', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:11:50', '2', '2016-09-22', '10:23:17', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('10', 'D', '2016', '10', '0010', 'JAMAN', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '120', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:12:14', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('11', 'D', '2016', '11', '0011', 'HARTONO', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '124', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:12:44', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('12', 'D', '2016', '12', '0012', 'EMAN (SULAEMAN)', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'S', '830925261496', '2018-09-25', 'JL. P. MOROTAI GG. CINTA DAMAI', 'KEL. JAGABAYA III', 'BANDAR LAMPUNG', '', '', '', '', '', '', '', '', '', '', 'M', 'PADEGLANG', '1983-09-25', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:13:06', '2', '2016-09-22', '10:15:16', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('13', 'D', '2016', '13', '0013', 'HARIS YANTO', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '3604260505760003', '2018-09-25', 'KP. TONGSAN, RT 014/01', 'JUNTI', 'JAWILAN', '', '', '', '', '', '', '', '', '', '', 'M', 'SERANG', '1976-05-05', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:13:22', '2', '2016-09-22', '10:18:42', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('14', 'D', '2016', '14', '0014', 'SANDALI (ALI)', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'S', '8402120590468', '2012-11-20', 'KP. KUNIR RT 11/05', 'SUMUR BANDUNG', 'TANGERANG', '', '', '', '', '', '', '', '', '', '', 'M', 'TANGERANG', '1984-02-07', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:13:45', '2', '2016-09-22', '10:11:46', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('15', 'D', '2016', '15', '0015', 'HARTO', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '332810100381007', '1970-01-01', 'DS. SLAWI KULON', 'RT 03/02', 'SLAWI, TEGAL', '', '', '', '', '', '', '', '', '', '', 'M', 'WONOGIRI', '1981-03-10', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:14:04', '2', '2016-09-16', '17:27:15', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('16', 'D', '2016', '16', '0016', 'SUKARJA (ACENG (SB))', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'S', '900225260844', '2018-02-10', 'KP. BABAKAN, RT02-04', 'GIRIMUKTI', 'CIMAHGA', '', '', '', '', '', '', '', '', '', '', 'M', 'LEBAK', '1990-02-10', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:15:39', '2', '2016-09-22', '10:37:38', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('17', 'D', '2016', '17', '0017', 'KURNADI', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '3604152109940001', '1970-01-01', 'KP. KOPER ERETAN', 'RT 01/02', 'KOPER, CIKANDE', '', '', '', '', '', '', '', '', '', '', 'M', 'SERANG', '1994-09-21', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:16:18', '2', '2016-09-16', '17:33:41', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('18', 'D', '2016', '18', '0018', 'SANIMAN', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '058', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:16:47', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('19', 'D', '2016', '19', '0019', 'SANIMAN', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '058', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '1', '3', '2016-09-08', '15:16:48', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '15:16:59');
INSERT INTO `sa_debtor` VALUES ('20', 'D', '2016', '19', '0019', 'WARMAD', 'I', 'internal', '0', '0000-00-00', '0', '0', '0000-00-00', 'O', '064', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:17:21', '1', '2016-09-30', '13:06:55', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('21', 'D', '2016', '20', '0020', 'KOMENG', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '066', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:17:42', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('22', 'D', '2016', '21', '0021', 'SAMSUDIN B AJAN (SAMSUL)', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '3603282209710004', '1970-01-01', 'JL. DURIAN LK.2', 'KEL. GEDONG AIR', 'BANDAR LAMPUNG', '', '', '', '', '', '', '', '', '', '', 'M', 'KARAWANG', '1971-09-22', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:18:43', '2', '2016-09-22', '10:10:01', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('23', 'D', '2016', '22', '0022', 'MUHAMAD NUR', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '3604262211950007', '2018-11-22', 'KP. WANASARI SABRANG ,RT011/04', 'JUNTI', 'JAWILAN', '', '', '', '', '', '', '', '', '', '', 'M', 'SERANG', '1996-11-22', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:19:00', '2', '2016-09-22', '10:58:11', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('24', 'D', '2016', '23', '0023', 'RAMLI', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '161', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:19:20', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('25', 'D', '2016', '24', '0024', 'DIDI SUHARDI', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '166', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:19:39', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('26', 'D', '2016', '25', '0025', 'AGUNG GUNAEDI', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '920225260104', '1970-01-01', 'JL. SLAMET RIYADI', '', '', '', '', '', '', '', '', '', '', '', '', 'M', 'SERANG', '1992-02-21', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:21:01', '2', '2016-09-16', '17:36:32', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('27', 'D', '2016', '26', '0026', 'SAM', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '173', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:21:14', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('28', 'D', '2016', '27', '0027', 'ADE MUHTAR', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '320107076700016', '1970-01-01', 'KP. TAJURHALANG', 'RT03/03', 'CIJERUK', '', '', '', '', '', '', '', '', '', '', 'M', 'BOGOR', '1970-06-07', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:21:41', '2', '2016-09-16', '17:30:02', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('29', 'D', '2016', '28', '0028', 'HIDAYATULLAH', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '178', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:22:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('30', 'D', '2016', '29', '0029', 'AMJAH (GUSTI)', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'S', '820425285808', '1970-01-01', 'DSN RT04/02', 'GUNUNG MEKAR', 'TERUSAN NUNYAI', '', '', '', '', '', '', '', '', '', '', 'M', 'SERANG', '1982-04-21', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:22:17', '2', '2016-09-16', '17:39:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('31', 'D', '2016', '30', '0030', 'AH. SYAMSUDIN', 'I', 'internal', '0', '0000-00-00', '0', '111', '2016-09-26', 'O', '3604261106680002', '1970-01-01', 'KP. GENGGONG', 'RT 02/01', 'JUNTI, JAWILAN', '', '', '', '', '', '', '', '', '', '', 'M', 'LEBAK', '1968-06-11', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:22:36', '1', '2016-09-26', '09:35:25', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('32', 'D', '2016', '31', '0031', 'ROHIM', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '195', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:22:54', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('33', 'D', '2016', '32', '0032', 'SUPRIATNA', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '196', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:24:13', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('34', 'D', '2016', '33', '0033', 'YAYAN', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '198', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:24:29', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('35', 'D', '2016', '34', '0034', 'ENDANG (HLC)', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '199', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:24:49', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('36', 'D', '2016', '35', '0035', 'TOHA', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '202', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:25:03', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('37', 'D', '2016', '36', '0036', 'MAMAN', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '206', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:25:20', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('38', 'D', '2016', '37', '0037', 'BAHARUDIN', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '208', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:25:33', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('39', 'D', '2016', '38', '0038', 'KAMSIN', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '210', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:25:50', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('40', 'D', '2016', '39', '0039', 'SARMIDI (JAMSADI)', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'S', '810725260138', '2018-07-11', 'JL. SOEKARNO HATTA NO.171', 'KEL. LABUHAN RATU', 'BANDAR LAMPUNG', '', '', '', '', '', '', '', '', '', '', 'M', 'JAKARTA', '1981-07-11', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:26:09', '2', '2016-09-22', '11:01:29', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('41', 'D', '2016', '40', '0040', 'KHAERUDIN (KHAERUL)', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'S', '770212051000062', '2018-02-10', 'KP. GAREDOG , RT05/03', 'DANGDEUR', 'JAYANTI', '', '', '', '', '', '', '', '', '', '', 'M', 'TANGERANG', '1977-02-10', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:26:25', '2', '2016-09-22', '10:21:51', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('42', 'D', '2016', '41', '0041', 'ANDRI', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '288', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:26:40', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('43', 'D', '2016', '42', '0042', 'PRIANTO', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '3603051705820006', '1970-01-01', 'BUKIT GADING CISOKA BLOK A5', 'RT 01/05', 'SELAPAJANG, CISOKA', '', '', '', '', '', '', '', '', '', '', 'M', 'TANGERANG', '1982-05-17', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:27:00', '2', '2016-09-16', '17:31:41', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('44', 'D', '2016', '71', '0071', 'AGUS SETIAWAN (IWAN B)', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '09.5310.200889.0181', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '1', '3', '2016-09-08', '15:27:15', '2', '2016-09-16', '16:44:06', '2', '2016-09-16', '16:47:45');
INSERT INTO `sa_debtor` VALUES ('45', 'D', '2016', '43', '0043', 'ARMAN', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '421', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:27:32', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('46', 'D', '2016', '44', '0044', 'RINAN', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '466', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:27:49', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('47', 'D', '2016', '45', '0045', 'IMAM', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'S', '890425260406', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', 'SERANG', '1996-04-22', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:28:13', '1', '2016-09-13', '09:24:11', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('48', 'D', '2016', '46', '0046', 'TIRI SUTISNA', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '3604262512860001', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', 'SERANG', '1986-12-25', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:28:35', '1', '2016-09-13', '10:39:53', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('49', 'D', '2016', '47', '0047', 'TARNO', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '3312032906920002', '2019-06-29', 'KARANG TENGAH, RT01/02', 'NGANDONO', 'EROMOKO', '', '', '', '', '', '', '', '', '', '', 'M', 'WONOGIRI', '1992-06-29', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '1', '3', '2016-09-08', '15:28:58', '2', '2016-09-22', '10:56:20', '1', '2016-09-25', '15:59:14');
INSERT INTO `sa_debtor` VALUES ('50', 'D', '2016', '48', '0048', 'DEDIH', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '502', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:29:20', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('51', 'D', '2016', '49', '0049', 'SONY', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '535', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:29:34', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('52', 'D', '2016', '50', '0050', 'ACENG (PRIOK)', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '546', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:29:55', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('53', 'D', '2016', '51', '0051', 'DADANG', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '555', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:30:25', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('54', 'D', '2016', '52', '0052', 'RUSMAN', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '602', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:30:42', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('55', 'D', '2016', '53', '0053', 'DEDI JUNAEDI (HLC)', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '606', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:31:09', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('56', 'D', '2016', '54', '0054', 'DARMANTO', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '3506200910800003', '2017-10-09', 'DSN. GEBANGKEREP', 'RT. 002 RW 008', 'DESA TAROKAN', '', '', '', '', '', '', '', '', '', '', 'M', 'KEDIRI', '1980-10-09', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:31:35', '1', '2016-09-13', '09:21:18', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('57', 'D', '2016', '55', '0055', 'AHMID HUSEN', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '631', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:33:31', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('58', 'D', '2016', '57', '0057', 'AHMID HUSEN', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '631', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '1', '3', '2016-09-08', '15:33:31', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '15:33:39');
INSERT INTO `sa_debtor` VALUES ('59', 'D', '2016', '56', '0056', 'SUHENDRA', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '634', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:34:04', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('60', 'D', '2016', '57', '0057', 'AGUS HORY', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '642', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:34:23', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('61', 'D', '2016', '58', '0058', 'AMIR K', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '652', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:34:45', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('62', 'D', '2016', '59', '0059', 'SAMSURI', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '3604261604890005', '2017-04-16', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', 'SERANG', '1989-04-16', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:35:00', '1', '2016-09-13', '09:22:58', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('63', 'D', '2016', '60', '0060', 'HASAN (SB)', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '659', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:35:21', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('64', 'D', '2016', '61', '0061', 'SUHANDI', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '681', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '15:35:36', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('65', 'E', '2016', '1', '0001', 'INDAH HS', 'I', 'internal', '0', '0000-00-00', '0', '0', '2016-10-05', 'O', '1409011', '1970-01-01', 'Jl. Mawar A No.62', 'Tanjung Priok ', '', '14260', '089653065209', '', '', '', '', '', '', '', 'Indah@big-group.co.id', 'F', 'DKI Jakarta', '1994-08-17', '', '20161013_indah_hs_57ff331225d78.jpg', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '3', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '16:14:16', '3', '2016-10-13', '14:09:06', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('66', 'E', '2016', '7', '0007', 'TIKA', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '3275114304890002', '2017-04-03', 'BEKASI', '', '', '17156', '081319511495', '08111813133', '', '', '', '', '', '', 'tika.risswas@big-group.co.id', 'F', 'BEKASI', '1989-04-03', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '3', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '16:14:57', '4', '2016-09-09', '09:35:19', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('67', 'E', '2016', '3', '0003', 'RAHMA', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'F', '', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '3', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '16:15:14', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('68', 'E', '2016', '11', '0011', 'GITHA UF', 'I', 'internal', '0', '0000-00-00', '0', '0', '2016-10-05', 'O', '3172056311950003', '1970-01-01', '', '', '', '', '089605330531', '081212774092', '', '', '', '', '', '', 'githa_paul76@yahoo.com', 'F', 'JAKARTA', '1995-11-23', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '3', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '16:15:31', '1', '2016-10-05', '11:17:02', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('69', 'E', '2016', '5', '0005', 'MANTO', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '3', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '16:15:48', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('70', 'C', '2016', '3', '0003', 'PT. TIRTA INDRA KENCANA', 'C', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '', '1970-01-01', 'RUKAN ARTHA GADING NIAGA', 'BLOK B NO. 21 - 22, KELAPA GADING', 'JAKARTA UTARA', '14240', '', '', '02145857711', '', '', '', 'FEBRIANTO LUKITO', '', '', 'M', '', '1970-01-01', '', '', '', '01.602.576.9-046.000', '01.602.576.9-046.000', '2007-04-09', 'KOMPLEK RUKAN ARTHA GADING NIAGA', 'BLOK B NO. 21 - 22, KELAPA GADING', 'JAKARTA UTARA', '1250004485041', 'PT. TIRTA INDRA KENCANA', 'PT. TIRTA INDRA KENCANA', '', '', '', '', '', '', '', '1901-01-01', '1', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '16:35:41', '4', '2016-09-08', '16:42:02', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('71', 'C', '2016', '6', '0006', 'PT. TRANS ANUGRAH SEJATI', 'C', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '', '1970-01-01', 'RUKAN ARTHA GADING NIAGA', 'BLOK B NO. 21 - 22, KELAPA GADING', 'JAKARTA UTARA', '14240', '', '', '0214580671', '0214580672', '', '', 'ADITYA NUGRAHA', '', '', 'M', '', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '1', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-08', '16:49:50', '4', '2016-09-08', '16:50:36', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('72', 'E', '2016', '6', '0006', 'HENDRO WIJAYA', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '', '1970-01-01', 'JAKARTA', '', '', '', '08153778899', '083894002896', '02145857621', '02145857622', '', '', '', '', 'hendro.wijaya@big-group.co.id', 'M', 'JAKARTA', '1982-10-10', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '3', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-09', '09:31:17', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('73', 'C', '2016', '7', '0007', 'PT. SUMOSOR JAYA', 'C', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '', '1970-01-01', 'RUKAN ARTHA GADING NIAGA', 'BLOK B NO. 21 - 22, JL.BOULEVARD ARTHA GADING', 'KELAPA GADING, JAKARTA UTARA', '14240', '', '', '02145857711', '', '', '', 'FEBRIANTO LUKITO', '', '', 'M', '', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '1', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-09', '09:37:39', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('74', 'C', '2016', '8', '0008', 'PT. TIRTA NUSA PERSADA', 'C', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '', '1970-01-01', 'RUKAN ARTHA GADING NIAGA', 'BLOK D NO. 12, JL.BOULEVARD ARTHA GADIMG', 'KELAPA GADING, JAKARTA UTARA', '14240', '', '', '02145861229', '', '', '', 'MELVA', '', '', 'M', '', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '1', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-09', '09:39:17', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('75', 'C', '2016', '9', '0009', 'PT. KRAKATAU ARGO LOGISTIC', 'C', 'external', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '', '1970-01-01', 'Sunrise Building 1st Floor, Jl.Gunung Ceremai No.3', 'Kotabumi, Komp.Damkar', 'Cilegon ', '42434', '', '', '+62 254-3833', '', '', '', 'MUHAMMAD ZIKRI F.', '', '', 'M', '', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '1', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-09', '09:51:46', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('76', 'D', '2016', '62', '0062', 'AGUS SETIAWAN (IWAN B)', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '0953102008890181', '1970-01-01', 'JAKARTA SELATAN', 'JL. APEL RT01/04', 'PETUKANGAN UTARA / PESANGGRAHAN', '', '', '', '', '', '', '', '', '', '', 'M', 'JAKARTA', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-16', '16:39:44', '2', '2016-09-16', '16:48:16', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('77', 'D', '2016', '63', '0063', 'SUKARDI', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '2016-08-31', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-16', '17:45:40', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('78', 'D', '2016', '64', '0064', 'FIKRI', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '2016-08-30', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-16', '17:51:54', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('79', 'D', '2016', '65', '0065', 'SULEH', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '2016-08-30', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-16', '17:55:07', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('80', 'D', '2016', '66', '0066', 'BAGUS', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '2016-08-30', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-16', '17:56:25', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('81', 'D', '2016', '67', '0067', 'PUDIN', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '2016-08-31', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-16', '17:57:12', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('82', 'D', '2016', '68', '0068', 'AJID', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '2016-08-30', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-16', '18:00:08', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('83', 'D', '2016', '69', '0069', 'SOLEH', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '2016-08-29', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-16', '18:01:09', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('84', 'D', '2016', '70', '0070', 'ANACA', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '2016-08-30', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-16', '18:02:39', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('85', 'D', '2016', '71', '0071', 'NURHADI', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '2016-08-31', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-16', '18:04:24', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('86', 'D', '2016', '72', '0072', 'ROBI', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '2016-08-31', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-16', '18:05:23', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('87', 'D', '2016', '73', '0073', 'UKUNG', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '2016-08-31', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-16', '18:07:43', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('88', 'D', '2016', '74', '0074', 'ALIA', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '2016-08-31', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-16', '18:09:10', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('89', 'D', '2016', '75', '0075', 'MARYADI', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '2016-08-31', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-16', '18:12:27', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('90', 'D', '2016', '76', '0076', 'JAMALUDIN', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '2016-08-30', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-16', '18:14:48', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('91', 'D', '2016', '77', '0077', 'ENDANG (SB)', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '2016-08-30', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-16', '18:15:58', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('92', 'D', '2016', '78', '0078', 'IWAN', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '2016-08-30', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-16', '18:18:10', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('93', 'D', '2016', '79', '0079', 'FIRMAN', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '2016-08-31', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-16', '18:20:45', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('94', 'D', '2016', '80', '0080', 'SUPARNO', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-16', '18:22:24', '2', '2016-09-16', '19:11:58', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('95', 'D', '2016', '81', '0081', 'MARTA', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '2016-08-31', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-16', '18:23:56', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('96', 'D', '2016', '82', '0082', 'EPI', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '2016-08-31', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-16', '18:24:42', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('97', 'D', '2016', '83', '0083', 'JUNALI', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-16', '18:26:16', '2', '2016-09-16', '19:11:31', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('98', 'D', '2016', '84', '0084', 'FADILAH', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '2016-08-31', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-16', '18:28:24', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('99', 'D', '2016', '85', '0085', 'DEDEN', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '2016-08-31', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-16', '18:30:23', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('100', 'D', '2016', '86', '0086', 'HERIYANTO', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '2016-08-31', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-16', '18:31:54', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('101', 'D', '2016', '87', '0087', 'FATHUDIN', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '2016-08-31', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-16', '18:33:24', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('102', 'D', '2016', '88', '0088', 'FAZRI', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '2016-08-31', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-16', '18:35:35', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('103', 'D', '2016', '89', '0089', 'SOLIHIN', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '2016-08-30', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-16', '18:36:48', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('104', 'D', '2016', '90', '0090', 'SUPANDI (HLC)', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '2016-08-31', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-16', '18:38:15', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('105', 'D', '2016', '91', '0091', 'ROBIN HOT', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '2016-08-31', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-16', '18:39:18', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('106', 'D', '2016', '92', '0092', 'IMAM MJ', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '2016-08-31', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-16', '18:40:06', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('107', 'D', '2016', '93', '0093', 'SAEPULOH', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '2016-08-31', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-16', '18:40:59', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('108', 'D', '2016', '94', '0094', 'SUKMADI', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '2016-08-30', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-16', '19:25:08', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('110', 'D', '2016', '95', '0095', 'SABENIK', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '3503010102690011', '2019-02-01', 'KP. GEMBONG RAYA , RT01-01', 'GEMBONG', 'BALARAJA', '', '', '', '', '', '', '', '', '', '', 'M', 'SERANG', '1969-02-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '1', '2016-09-21', '10:11:55', '2', '2016-09-22', '10:59:55', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('111', 'D', '2016', '96', '0096', 'TARNO', 'I', 'internal', '0', '0000-00-00', '0', '', '0000-00-00', 'O', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '1', '2016-09-21', '10:28:18', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('112', 'D', '2016', '97', '0097', 'JOHAN', 'I', 'internal', '0', '0000-00-00', '0', '3602122707900001', '2017-07-27', 'S', '', '1970-01-01', 'KP. CIOMAS', 'KEL. SINDANGSARI, KEC. SAJIRA', 'KAB. LEBAK', '', '', '', '', '', '', '', '', '', '', 'M', 'LEBAK', '1990-07-27', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '1', '2016-09-26', '09:18:42', '1', '2016-09-26', '09:50:19', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('113', 'D', '2016', '98', '0098', 'A. MADJID', 'I', 'internal', '0', '0000-00-00', '0', '0', '2016-09-30', 'S', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '1', '2016-09-30', '13:08:07', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('114', 'D', '2016', '99', '0099', 'SAIR', 'I', 'internal', '0', '0000-00-00', '0', '0', '2016-10-01', 'S', '870713340741', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '1', '2016-10-01', '16:41:32', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('115', 'E', '2016', '12', '0012', 'SUMANTO', 'I', 'internal', '0', '0000-00-00', '0', '0', '2016-10-05', 'S', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '3', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '1', '2016-10-05', '11:19:17', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('116', 'E', '2016', '13', '0013', 'RISTIYANTI S', 'I', 'internal', '0', '0000-00-00', '0', '0', '2016-10-05', 'S', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'F', '', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '3', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '1', '2016-10-05', '11:20:04', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('117', 'D', '2016', '100', '0100', 'M. WASEH', 'I', 'internal', '0', '0000-00-00', '0', '0', '2016-10-17', 'S', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '1', '2016-10-17', '14:24:18', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor` VALUES ('118', 'D', '2016', '101', '0101', 'NANA HANDIANA', 'I', 'internal', '0', '0000-00-00', '0', '0', '2016-10-18', 'S', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', 'M', '', '1970-01-01', '', '', '', '', '', '1970-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '1901-01-01', '2', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '1', '2016-10-18', '11:59:34', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');

-- ----------------------------
-- Table structure for sa_debtor_finger
-- ----------------------------
DROP TABLE IF EXISTS `sa_debtor_finger`;
CREATE TABLE `sa_debtor_finger` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `company_rowID` int(11) NOT NULL,
  `debtor_rowID` int(11) NOT NULL DEFAULT '0',
  `type_finger` tinyint(4) NOT NULL DEFAULT '0',
  `finger` text NOT NULL,
  PRIMARY KEY (`rowID`),
  KEY `id_key` (`debtor_rowID`,`type_finger`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sa_debtor_finger
-- ----------------------------
INSERT INTO `sa_debtor_finger` VALUES ('1', '0', '47', '6', '30820776308206DF048206A6308206A23034302F02010302010204100E13DA509BAF4ED98064D06DE493A80F0410479D6AD1B9A811D2A7A70040339F131702030200000201010482066000F86501C82AE3735CD05E150430B7C1846D2D4E17BA6FA9E004E8AE04309715DAD626A921486822753A77D2BA97BA5C392FC94E12BA3EC966C0408A592BD669B5BBB8A96FD1A9FBB33D2E3882C7FC1B5DFC4B2CA7F8355EEE5A9E9975C86EC0AFEC9B4698A24F87B1A86907AC6C5C628659C1E56C20E0E278CE8C6056FE51EE370291D836A48B7F7B21C4ACB13C3417A981EEEEE8903AEB6DE8CE345BF6F8E8C5B69C012270867F714E2CF874AE9528083EA95BDCC8C989EF2BD8700FE8688A9DFBC767A897C02F37BEA5091779730269806B52CF2BCB44090C19464C32CD1637CF0C477696772D4E4297BFFFB6DC16F58C41C6E6091C047AEF1BF6721BB62E33C18DBE71E9670F2932E2B52AD11135B80444EF37D2C433A89DD41AF256B06C55865D7C71BE081C239B410D3EB7E0DB8C9A17F8D4AC925BFBC019DCF6C61FC8A382C8C886F3754736FFE79C48B6318A5D06EADEFC1799CDAB05600E8FA7BEF1F05058B211BD306DDA6F00F85801C82AE3735CA85F1DDBA4643B5879D80D90C8F96FBC53C7A11C05C7719FCFC92E9BE7996014FE18C2EDE8BDDDA012712BC5C8594014782A220B7923E45ECF21F0564F910274C61BF3A661596AECCF53808B84D1E63DB7DCEF69EA55A151E4D312A3BA112F6F70B096D5323B201F9CAE81439F4D2FDC564A0A04F592DDC139883581971D2316AE2FBE1A0F50E568CF8F5D5292CE8B761015803F4C2F71C4A1338ECDB1B9BE7838991C669041357D334A30FE3D4BFB46E2D730027A2D339448D6108946116AAC75C807331EE2FDA74ADF9D97FFC35D5EFD7A5D1A2AFB712FEB26EA89832E96BCD8BE8A2D0567ECBFD9FEF8BD75E992A7CA74353DF860E49CAD951BA2725023A4D3DED7F0B9E55F704A0E408518745034FB98C60B9899750C7CCC82B60D89159E3A75DC1DEAFDFE5E01A7B77875C5FFF71DE3DB2BB80DAE8EF63F862DDFED83A8B3658261863E3F7667072F3EFE894B5506D4246F00F87F01C82AE3735CC5502F9D22899AB5B89A5DAC994DA81A986AC810DA599873E410893620B7CC3EA4110030659BE0C15DF101AAB46A563D0B1FF56A29DE6C9C2687DAEE2C366EE60C0CC0655FA19DA2E3BA9291EC5720023846900EDB0ED235002005A823886C51710A8187B2E8681BB0BCC261616F7D039435ACF0A6630A62ED2D42E3DC7B5731F575111F15F4D3D6968DB0213EC6CD3B6A0658E94B0BE211502795A3F446B9BD6A576386EBBF2FB89CA54FCF17618C546D0D97AF35927B8578490BC49B532ECDD69D3D29BFA293FECC755C956CE87A5BF921CA491E899A28FFD9EEAD609BD2F08BD1CD429218F3F9E1E7DB981A62E6E0136DC99FA8F9F11ECCF80F86629900D4C5DC296A3387CA895A5173AFEDF5FD76D2ADED39F3AD556014A9C33D6E16F25C8265778FA9203F8BDEB7955980162935B9343AEE2C2A7D4F0F31F0F961B4F1482A1D3A2F32D907C6DE9E35A85705447CC6682B37A516B59A534CCD7B018EBD629D6645E43CBB40E31F99E545A96504A67021E482F34B02F6C4DF6F00E88401C82AE3735CCA5E2D38EDBBA35B2080ED2A659BB63591936D879215DDF166E520A3AFD559AF9C17F5802857AD8018EAFA36E6A1732508B14114115EF91E907CBBBA1C7B182927F9498FADE3A2F4E72E0727C460F68066A54322919572ED9593DB230E2C147F848771EDCEF4FE111571C271B38B4501EC3F5C74B20772F1C5F8636827ED3D899F4984F9B938D3832E2B388A85AB2286AB23FECA121662B97D6F3FBA15FACBE83669F737A29AF8570CCF01BA4158C9FD0EC4277859700AE3F9F4EDCFD56EBB38DE1AA7BAE1BA6922B0830ACFB04CA9DB9F37805A5009CAC00C1AB3A060F5671D09D5304E7FBB4AF334BC64AA5AE9E569874B5884362618CA92E2E13BBF711C955B58D152E260A42769B2DCD4FD9546885D37CCEB6C7968E95B025EA813C6E9BAB7D82F37E5185989B85D79FA4662A75900330B274AA99AA87FE2FEAB15998293495CC99A3255118E609B5AFAEF07769A74EA1C17382DE05C18C7C4DF2C43A1BEA8C5E909914EA39D5908D032246D46821A6B3A116C607860F9F3EA12D5ADB26F00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000201000201000400031100A7BBDA72E68A4018B176DE3BAE993266031100A1C21100CAA111D28B020090270750C4170D3136303931333031353533385A300D06092A864886F70D01010405000381810066548E47D2F9BB70AB2EAF0022DCAE8E19C6BDE86620936F534468FE42D8FC5DD0903E87853AA8E7C8F4A284F443CD1E3D0B139F970FE2B8E49789580B16B7EA4B5DE01A49EF27569F524BB2F999BDD72F231E9A0D3E2EDB33CECEDC8A37B44F6A4C0C53D9A162C12B7600AB0F8419921A133141E650504CE8638B92AE124682');
INSERT INTO `sa_debtor_finger` VALUES ('3', '0', '44', '6', '30820776308206DF048206A6308206A23034302F0201030201020410E4094F7F18294CC4A3EB8C681E3EC7F70410479D6AD1B9A811D2A7A70040339F131702030200000201010482066000F89301C82AE3735CE753105CB728F49A0D14B44731E7BC4A7D0B379467DB822440C6468FB16B826F0DEB10AE5D031386F779D900B0C396FBBECDD7DE9B1632D3919003A726B220DD3A868F5C28B11774A899FF25CCCCE068D2F13689CFFA5751D6FFE074AE9C491A61BA22C45203F59B2F3157CC0EB2C7DE40923A2ED7BC85970579B8D80D1CD169247778D93F7AF1E60DB91999666FD48AFFC08AB00ADAB1B03C23F30F380FAE050D9C3C8967EE65DDA8ECB5D35AD42D1CD6EDCDBD8FE04C87E76D5923D91796B301B3A38CB2173CA7D7FEEFA52BBE91CE4122D7530C7A127684608BB793371B3EB23029FD55A890A401BB931545DCA1A70B7A00EAD01234F77FA3D473460605EB640A8499A269C7C73A3F3C5C53B0C8C406E87EA0D6058B3418C4AB59269FDAF291958CBCCA345F09DE84BC1DD920299504AA21F148F953873942C91BDB19C23F20D3D451E3BADFC509E846B9631D31A1BD15B2CF7D8CB2091FEA61CB2A5071FBED7D5BDC3FDE510BB6CD859AB3D87DDF7C6AD8CBD486029A3886395F57A8B4ADABEF61EA7C2625A8E945988F61446F00F89301C82AE3735CEB5F2EF652171B4686B4B2BA9670C42705E6AFD5671CC5DB6698D47F72B8193816C989E54CF3DC37FCF264928B20D453C71F1DD7567E4129F080661EF5F2ABD1A9765369721740D6274FD2CE9226BFB79372C2339B7375EF0AD7D6B4E92C4E0F4BA909642A0A372F8CD71CF67751722B478027D20963150FA970C7113F0EFB0D8E9993E6D2A101240C5B4874EA9EE8A55BF852932316DB19C4996BD1FA6E4B75DB007A31055EA610094D47CA380B41845A6060E1138F5AA9D09FC970A3B8A895F46207B36D827F7F5BFA116BC1E7FF69BCBE29ED9AA08DDD22DAB1FBBEB2034FC4934705D52C67B6B0D79B60AD2517389D7B6AC76D8F26B52B1634A1D354FB5AED8BC04AF82A802DECCF8B33515D6D9B858822CE5CA27DBF465E3CFCBBD96B265D6A9E72FB8E29DDACED8615393ED5B98DBAC2BC683453AB84712104016A125410342A06DA36FA853F547216EBB70E0500D509EAF52DEE5BF4D228A4C75CDCB5A5069CD1F4D3E8AEA8A72173043DC9EC10F345910390E1E6BAEB8943DB7725B097F72C66531798803D38FA65085D6F00F89301C82AE3735CEA53162F5B9DAF014FF72EF7AB3BD146FC3656E0DB186F771408623E9268FE170EE316D9CF9E158DB4011AAB6756BC2785B106A6698949FC9BC9019F58722C81992E6BF6B17B449049F7C5765029FCCBBDB2DD0FC923CCE6BF7FDA5FDED05598BC11A9EB3BA08EDD82E5678693B7D5272BF589E45CDB6A0391378420F07324D692BC02942F5477CF47BC8C6293FF896182E0929A44AD4761EB0D073FC0D22B3AB4423F6DD6ECA9DA2548DF4540ADE4AD4D19CD19C54CD5D8AEEB0988BE161FABB87A24ED84D74644751E749CCF9D5F13D801F3E87291FB1C9D2894C9FD28D84DF5C537ABB288709A02CC4994DA072D41C8E45117EAD544D532D4B7DE4BA9E7A032FB36D39DBA756CF294D77996FA4C993487103A2853EB6385357F26E3B75210E6E71B2A57A17DC6CE3CCB49ECB357F9A3CA630AE0C3E40D0E19D0A029AEB3FA63580EB4D459FE4705BEE7059F638E82F6C68EA02EDB82566EDC8A5A8DE3857066D475B5ED5503F9BEBD181B3ADC062BB17DFEDEA0A2D2FC536985A94B81237D5D8B9B678EA4DB8D84636A92B3736F00E89301C82AE3735C03542B697E7D37E9A6967A393AEB3540894DA0E0D2E4272D085D4CCD836A8ABC28380529BDE964564B5A5834EA5FBE9B6AEBB063071A285EA21521DA456163FDC73CF5EBF2137DD4C4247824874285B2A6166A9B039A42C8C4848CFEA0C7FF611E342E8370FFAC68C9ABAECD003B3F6F7602C3754A35208EE6D9642B2879F1D17742A2BA9D1A667F51E7FFEC0771C9C44798A421A1B6B41866AAE7F81226E9F836407D52A81E8A8A2EA1783C7DC8C669DA37C5A9EB95B21A1DEE2046063731F75F92E8A2D55E6984D98C50E4A69271DDFEEB6A8417C903244B1F9BC8AD1B7DBD71E3BF5405F49F71E379145060CF6E04F5E899DACAE48A2E78B16BE3B0F06032A7340B834A5958710322DEF564B486188A83B555A02DB64D75206965E4D4BEA883D0F8703D2D2461DA5EF80109D66B1614C8F52E2DEFD98A0B1E51A332034FE2E587C4B20AF8BA023CFBA3E544E08C6D3B8B9AB364EF94D45F5E5C6352912D0F0CBFBC5E79F06C6C40A707EB3E6925650B85087B7DA3BD4CAF923AD7D4134691C02438609F4C8CA887DF7737835C6F0201000201000400031100A7BBDA72E68A4018B176DE3BAE993266031100A1C21100CAA111D28B020090270750C4170D3136303931333032303832315A300D06092A864886F70D0101040500038181009F39E76739653E8ECC8292CF51441BF3BF3FAE5ED650212B4385355F58D783ED7862C314F6A81E56EB328EF4BDE903D0DD1FF441362AB7500CA7CC92366D9C6973F18D00ADE4EC9DD44A73CD0468ACC587C611DC38273E3CB95C642106E6B0CB9625559DC35DB1E1647E7E57D91F9090F1F415474DC2B37778F84200CC0C243F');
INSERT INTO `sa_debtor_finger` VALUES ('4', '0', '44', '3', '30820776308206DF048206A6308206A23034302F0201030201020410AD7F35BCC9D346A5A9A589771269DF630410479D6AD1B9A811D2A7A70040339F131702030200000201010482066000F89301C82AE3735CE8522DDC0947D27BA680EBC30AEB046709C75391F7C1C2B6EFDB5AB7EB3927FB08FCF0D384C577287E5001623590729E65AFCDAC6AE1E28D89EBA9DDE8597C1F5D829DB162B67E279477073BBEFDF135733AFE064FEAE5936CE77EEB514D153A99F9E2FD8FD8F021BC50BFBB36F3249B3EA803B66C68975C78477E91A21C7E28ACB184BF673136087D569AC0DFF45B3900C49BE59A267FC9F7AC9054B82710BB6F8A2B63A3D808FA7A17C8E81B6EDC78B57F74D346CFBF417B1000A81EBE93065954A8BC78624F58DC0AA192CC8BBD27A36C35B75D1F095F598F78B92F246EE317FCF1BC75A2AF70E58E0697EEEB11717897B81E406D73A08C5D706AA5AB582820DADA3FF43BD1B984E623BD1BB3FD3CA05EDB400600B03BF05D567BFBC5FBA79AF065560C5C84065CD62FC6B46ED4F92EF5E3003126CF29629AF14ADF5715F620E5A7BAF6C380F4577E2D4A453DD85B296F4372DC1E1D869B8390ACAC80FB3DD83F45DE5F96A6340A3852415CC1E6E8DC11528779D416DD3589CD24E2C528BB75E9E51B857433DB4ED0181EDFC66F00F89301C82AE3735C0454118A438FA57EA3BE91628DCA1BA1A5AEF4C053586B5789A3CD423BD792F003D4088F491D7B98706D5E77AA4AFF7ABDF50DE30148252ECE3E3CDAE3E9A52E6836A3DEAF4BA3A425ED7B32C0A5BCEEB0C150F3C5ED0F60C7582DA823D23BA7E980604CA10970FE669E3FA01BA8798B52276725AC343DBE498EBA137FE02E309781598769FAEC43C32905271226E694921BCF4E2C7CB4C301D646F8D6024126C83DB62366986A58ADD2FCAF8FFF3ACD2741A8B6FA24EC7B43F999E54BEEAA918175B1B088DDDA10D3671A5E0C598202463F044519FF41A6F306A1D82B3980C4A6201708330C130EEE8922A55BD6C4CCC896A9648A7113CF7BC72C225230E242C2F01BE2FA545F40F1826423BF8F8B201F07B903A403D5BC3BFF8AC7CF933FDA4224D66649B10CE5795707F5ED0E2EEF56857F658A3EC25AA261673406A6DB7637EC669E40D229BAFFBE21C33A141703410399BAE6E3D6386B605C8D8A4D9DE39337C9A145A31735F802190B5E1FD23F05303540EF005F56984AF94AA27B61D401336932455ABF31BA4D01B1573C6F00F89301C82AE3735C00511202D65792DE829DA30BAC2DC5CA7D16C8C6BB9C72DB48C56D9335A18F80530CA9D3F929B5BBBE5C6FA334A1340A9A31FB71D99C55DC603D57CC56DD837485B3926EF166DA48CB6879C5C91FACA66E8D30236CAC9FEE60B48123A52654569C73EFB29105AB05475D214F65F0393C2EB02558DCD9DD0DA001155527C3052EE7C88418580C2B37C0E7BF99F6BAE68AA833B87E06A481EFB0DDC49FFC1BEA51D8A88A5D5E1DDC926454EE71240A7EA50952E4546BE530980A01BE10C0B7C0B077B7DF12756A89098C90FAFDFD434581C43A11F9206C3BBA38A87DB06B01D12E9BDDD44BDFF404AD16F61D4B9E2F5D96FC00760268F6F05E4ABEDC8CA2C823EB9FB776DAF623DC1B1ACEE9414207A2FA3C66AE6027291A701E0FE37F58F365E9EEB9BA0B13F229E9241592847D3D1B4C107B11DFFF806849923247BEDA1DEEBAA1A74F4E54A79B4BEA9319E8070B5BA5242FAF57786BA8EEE2646E854F1CDCEB1A8F04A4AA0BFDB656510EAF365343B0BF42105B31274E29D9D91268DFBF5F258674EBC9D985AC823522034489A86F00E89301C82AE3735C095321F71E9351DEA18B07D82B353B3D37475B980868E1AF9BA926BF047F2B08BCF61438E2F47CCF31AB79E37BF41D6845CE1BC3233339798176750C645DACA9E5BF493E1A2358F620FFEAB9B566983A15A5170BA0A289ECAD6C523326D7116E3D7443953BC861457DE56930205D6425679CC049123A187AD3287AF7CB752E31951C3DAD095064ADA5E045A5E23C732503ED6E9362CACE65E33F738B95D8371226809C8D347EC7DE19C3F7B041F9EF61ACE46CC964D88DDC4F668BAFE570BC903FA503EBC45F1CCE3E35675E34EBC1843CDF4142F950407CBB4288F351884FD1E77E4AEDB98A5755DAB3AC9D6438F44C02FACDCFECDD50B91EA6BAFC53DB39871FDFB4E7DFCCCA227EDF3B82E3DBAF02AB25DA4C86D563131D7EE07D0D6ABC9B46B1BBFCF8C7C4A549E7FC22C1D4B7953C15C199D0CB04D34D0E2E488EBDEFB6540B85B06B638A5F6E8DD0ECB2350CEAC5C08A3CE8FB1F9885E989A3F6BD977D5750E3E74EF77BDE958AB9FEF8D21B75E7F25BF9393165E410E1102C20F3B02E008BB96F33DD59117ADB2DB9EA196F0201000201000400031100A7BBDA72E68A4018B176DE3BAE993266031100A1C21100CAA111D28B020090270750C4170D3136303931333032303834375A300D06092A864886F70D010104050003818100505A9B2FFE41FF414CD168B690479AA180C4C51F01CA40F8DF511A996564E4432CAFB6CA23A3F37D73BF8E860B15190E0BDD636C8CEB9F0FF728692B547564B14B64CF3AA1DCBC8512746AA126541136AD9B2A3A431149F362024531BCBCE43FF000D493C6507A49E81A4C6DB40A7AA9E547986A07CECA86444F61ABC6FF3CFC');
INSERT INTO `sa_debtor_finger` VALUES ('5', '0', '56', '6', '30820776308206DF048206A6308206A23034302F02010302010204104938A736C08544A49D77D46F3F9785020410479D6AD1B9A811D2A7A70040339F131702030200000201010482066000F89201C82AE3735CFD513F498AD220D6673B49C7F01E45A97AD40BB6DBA08F46D9054A80FD546FF105DB68556FE1441A5DDFFA3C391A78ED46A48F15F4B8F57218FFE1813782EF16A6EB260B5D5C6EAB4D5A134FDE22392794BC7A8188AFDACF4F4B61559B651D35CB6D9C8DB538957141B588FED7B2A1BA18C2ED75BA401C4163485EEBA82B97911D92FA26A86704D9B8027E9689A4E71802092B6EAE0FEF753141BE5560000978999FF2F2F219E7C27D57498243F19301829D757BA48B8438945923E0A940E72A027C68262EB56F9B611D578C1B8F76A5A3E420112C2E42D8E3AEF74F1C2E49BBA869EDB69102525FA4BB16DBC699DA51A5A70962EAE3A184CF00AF18677F3081F0383AE4A3A9693FEC6397CC40D3C192AF4E5BF11B03F7C8D8844AC675FFC057B3303C7C0FFCF1D0D8793776141EEF0533E1276912CC9E0F8645FDD0E14FBD58ECE0331F977B5A671F7481529E0EE7B278A10F8014A8B7ED9359A5FA78CB1B80C967A94E4946E899641C2A9F7152354732E16DC4C4D0B36203DFA21056A6ED79936FFE1688C6B697CBEAFE73DA6F00F87E01C82AE3735CEA510CC705C6BBD1661F6560B46ABED59DEBB670C9898AD3F2B7ACCDD856A4353D87478CD0CE8F824E4E46F295E086146235E5CC28E2DFA858908A1EA72785DBF396D75C401351796E09390D7F2F180151576D63114335863D3313EDE9F2B1D84A423D0DCADABE06156418A74F8D2C757BFC602AB664F4D5ABB08AC2814CE0FF0003CDF3E61E1F5CBAD7F734363F770C014D143E3DDE4DFF85EBB649DA387BD171C1BD34A49E915C26D9CF4C479F7DE5CAA264E20FD805A672C922570281E557013064FB32682D1AB0DA73159B4F0477707D50DFF1166434BA6D62CBF1AB54CE8B20527968C07A86D51B59ADC5D0F5BCB11B7A94A83A2290A3AD56A7A2046E35ED7776E0E11A2C6AAE8720EDC13E22036851B0DE65536254FFBD622C704A831EE5FC1014D7A1D5558B836B7427D2296ADC284E50F3C9AE5D12B685FF2A8B5A18F20EDB8A3C28687C9825A991E6D33DD34DFAA256732814D6F23F3B49A7FCDC6726859F05BB64EEAA86F6B6B24A86F3441342A5E95A6E7790596F00F89301C82AE3735CE65F3ADC3BE25C4DE0C8FDAC7196484246960B948202617B863DC3E25F6AD40496C207A1B87F12AFF87B8CF030A984A99D46B83C8F87C50D60ACCDCE449B2073E074A162FB4DDEDEBA8B107D5FA5BB7840ED78191757FAA25C3191EDFD7F80A14A654DB2146FC9938D8826A35B50E63CF5334EF24515797FFB5529153C0AB4BC7E1F2E0949C4237F6BF64317B66F4D49DE9A298D2745B13F0B0FF4A13EAA3302F69BB092DB6E3967A3179AE79B70EDB4067731CD6E02955D173ADE35A7064AF43CE5EF14FD677E05A77231CAC3D20ABC712769DD3FAD91A50FB85CB658E81777428BFEBD5D3C0C06619952D4707A421170B5BD78D127F49E437854BF5207E978FF708F94900F4B2513C991EB499CAB8F51C31DDBFAA695F026DD902240B78DDA491CFD0DB27861A0E1C4AA753413976D45EC8A287BC0BAF43E837A3ED797B2C44AC48C78406D35F72BC1DC1884F505CF4D574037E182809766A3CD0B209A3758405D74EB6096BA0C951C13E2A4F8C791D1C19891CA6893FC66B6C04C914D1D19464F6BC8B6408A2C34C6881E5F586F00E89301C82AE3735C1A5E1B8B376CA6B3EF66AA833FC607816891EA0D854BFC8D360E7E305F5DE5DFF512105B981C0D01A7529B09FCF44895EB64E59BC6D9DFE6774B52BEC43570C050C6CC33D4EA6CA213661F5025E5EB61B46332C7261D85D9769794BC45D107C88D2EE112FC11FFB8489E34D20C6859685B18FF8E4834C61B6A683D92B6D0121D7E59A41CA0B27FB4BD458967DB992CAD989DEE9D7D92AD5FD8789C41E32E73B513791C02020D8593AAFC91E7F2413D55B408376E8E350E3F7FC9A7F65B1A9147DC0FC12A94D501E16656C6205D7611B9BDD56DDB0D93D1C56BE6DF8375FE71C5C8E2992DF7E914396D9AC3DD6780E3F687E60BD79D198DB2E10C278376D4836AB772FF28384FD1CAE2F9855D588ED91A999C7B2FD7F6E55988C1EA8E70DC690C0E8DD5AC9FB03A6722C49D9F6B56FD5F20A8BF3D35051F815BC2B0E0A1B47FB0570548B88B5B53DEA647173DEDFC5C25E1ABCB3444298D5B72CDBB96653B344722865C26A52647BEB7A77D0F2019CEAD056BAE207F8BE3FEE0F49E9BCE674EFEBAD58BC82ACC9BDC66D6F75BEDF26F000000000000000000000000000000000000000000000201000201000400031100A7BBDA72E68A4018B176DE3BAE993266031100A1C21100CAA111D28B020090270750C4170D3136303931333032303935365A300D06092A864886F70D010104050003818100A83511653385C741B1185920C83FA2E413E7FEE19869E8CF85634563D55D45964321ADBDA200B165D2D2853B5F1E4934F2D6D2FE1DD4F1D21CA125D03CF49646C06646A66B9B8073957D871308519639928980063DC26B569ACA96757C260068977A0AB1358F34EB4CECE02E44E3839D640998C44E315F8AC2A615A27E604122');
INSERT INTO `sa_debtor_finger` VALUES ('6', '0', '56', '3', '30820776308206DF048206A6308206A23034302F020103020102041066027922C12E4C8AB8B10D66D12647280410479D6AD1B9A811D2A7A70040339F131702030200000201010482066000F88601C82AE3735CF35338D00219B02B3C3307FF17EF39756246FBCA6FBA1EE73196391E61D8F83EA2FECFE102EB4C4A81B30EE64DDDF060AA3D71716105B78FF999580FC13CB861A5E00DDDF20CD9190D4E7FCECAA9FD0A1C0043DC6FE32BE7F4987846508BD0F5D3626821DD62BAF5AC574C9BC0611E600AF109B61E365BBE3947546EC5EB36CA631408171D0721263581A33930E0429A904778CC557BA1D608EB5F0088B2EBBFD7BE734A30B35DDEDE6D7C0D0B84782621C8546C3691471FE5392A039E4F1D364DD4A1251D3A175FB97DD94D944A8C41D5A2B2C073A5B29B8C025F05CDC1328EFBEC83B1F2705AEF10569381F1C990EA711B6F2A1562BBDB6CFAB43775CEDEC27A0C90B5F7F27B19B539159A602782216654E692B50D1E546FD2A19A266AEDCC7EA9815EEE25A12F83A10E58B804640E450BA0CC774242351C2F7D161B0C029CA7C489C8CD80643FF2CCEFD9EF3056C44EC8251B58746C0C9BDA2F96A4F522C81BC82435A384B0482B2AD4FC93EDC40185B9C6E6B321EDCF44555B9883BD7B16316F00F88801C82AE3735CCF5201F998C1DC2AEFED6D4C4F9E0ADD82BF9B4B1FC15FB6B06F914C8E695A4DFF9E4AB953096D87A546E13D54EAD377BEA47BE5BB80C064A4584A19A9E9006628C2A5D208BEE038747689A0CD94AE217CA6AF8EAB598876CE205C78E7DAAC718897FDFB009770F694C0050208EECC43277FAA6B68FC79C4A56DF2FF3AF927DC950AB9FDFF5E9A3FF053D2FDA862A77D60330397AFD8BBA091E3DFD2D43FE4CE9EFA45BFFF9E99B18F828CCB611A7DFFFF3CC105B8B976992BA90AE18CF6245B76DB020BC4F907704D5F40EE4AB740A6C450E32CF5BA616946F0E0074904F6600E12BEFD90241AE7AA35E4118C60383146EABD3A09FA302AF33BA5CAB2529AF113CFFDA2B1A872779C9839CC22373259380528196DACA8BA132537353279A0382A7BAD86A057F09B62596C31D4412A83D1B9BD2791DB0F81D1808DAE3499092BC1B20EB25B9F9703E997FA1F4497448DC7A48F09C64001F4DF120627549BBC1139E0A477274FA4ED797B31F53F26C16E94E7BA752482D6B2CE37F84F883A610CD12B396F00F87B01C82AE3735CCE5F1D44475CECE12544BDF8A2D63BD9F66732D1F5BA0ECD389C597962F1FAEBF0C0EC8DB6805E6759AA227C1BBBB9DC0B88C7F951509173A395ABFAF46E9829DB7265B78BBED83929093B558BE90293BAF9D6B13256143E297922E54A7E8C4E43BA269D31D62A678613483EB7F15BB5FCE08EFD96F1407442CF58A469CDF617AFE8A1974BAA50E888EC0EE41BB0E37C8D439DDD52DE77EB4ECD1B4225F8971945CB22AA8918FB8FCF2422DB9D263F1800E835CB298B69FA144DF585D5764613C3233E3FE6AAFB12858FA3DBE8A43D270416A5071A5BA1945AEAE460869DFBD1734CF4A1846D9A78C9FDAD649CDF0DD8375F024EA521082EDAA56038CA6D9074D101CA95B2637030BE4A66132DCE09F7F4678EFBC8A202F6352C434E431593B7E2003AD8C2FC0CBDA481BF86F180DD63414EF9E7C2B1A797ADDD969C5C5512B2332ED4231DF58CE29D793BD0A35E47C4DBCB3F29B03341BB088894DFD413F4AFA1A25BDA04466F43509BBBADE779D0A9347E566DCE6F6F00E85401C82AE3735CF851224DDB1259BAA121C1BCB0A00837624311189C58D8A1CCCD6E4CF10628B1A9EB743E408BF71E37107B845A5B1D6007BD23DB50E51FB0F00FD0E8D2F318E2EEA9911B6B974F72436948F85AE96BBAD0AB418C56E8AC4ABDC709E924013A9359ACA2AE59282ACDF9203CC19DE917A7D83C915A2699C63AD83F034880DAABB0E7B773A348455EF078CFE828B77F99DBE32916A568ED543BD9A29FAA5B4FFDBE13BFC9EF7B8C2FE244F3D18C5D916847C18892D7A85909EB3D34E8DC5983F339DEFCB86C39B6384A03AC7312A34AAA5F58831E3873FAA2EDBA94F57BBC37D49034852D52B32182F0163BE939B9E40D875A5ECA56730DFBC17039EFD0789B31FC85744FDECAF8E7ED80986A4BEE91426A647FF792A21F2C67255F334E646BBFE3FBFCC928194DF3811C03BBA85E101753AE2BED8EE74B0606474AACF2F327AAD1398FE95FF92604ED73946807630D4B6F0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000201000201000400031100A7BBDA72E68A4018B176DE3BAE993266031100A1C21100CAA111D28B020090270750C4170D3136303931333032313031335A300D06092A864886F70D0101040500038181004FE80F66886D2E5720C771AF502FC6471EEA1928C000BB1B8E4D4032E27B35C4BD38122CF5F086E297A1CE6BF6C5ADD06C6B6B5D10FA7F162275542E61F78C70D6F9A4164A60FB1464DCE4A39F1DA8D2DEA075F5F7A19058C0CE234565F922B8674FDA6A1C08D653ADD0EACAB1A1564A50D881061B061999A368A5D898BF1DF5');
INSERT INTO `sa_debtor_finger` VALUES ('8', '0', '62', '3', '30820776308206DF048206A6308206A23034302F0201030201020410E1CE7DC05F0C4EA5B36C6CA33ECF89450410479D6AD1B9A811D2A7A70040339F131702030200000201010482066000F89301C82AE3735CDE5225FE2A174D3E0272533AD5A4621D1C86D69162097A31E4A7DEEC77CE0C3F7CEEB7254B9B4871BAD757968F56CE981A57794D0AC31E32B16DAD32F814F528B0F936CE7009747BF05EFC31A632B7B2480093BE1CD93F6850F079EC0B432A4E814F7F2B92F535C08228A6C620045CFFB33B859CCE819D22208458D422A21CF25FEB4DA540D1E27D71A8138D46C0E79CAF50B5DBE172CAE68366C153073727568AB1BDE440CC715ACA80011438C799DBED381060CBC31C6713CA4B872A5EAEF2CF135FC2DAAC3BFC346117BD822AED0426C00D3178C46D805CD2AE705EADF3B9267A6A893074B5C6079AE8DD40870257E5718138B7B36C49193A4C998A3FF1057D0FE17EB866137E357EFA5907594267B5F550DF41FE2D2AC9B94F617173B47D528BE16303D37220974CDCA52CA39F827CDD9CB9CA94D94EB9E19449BD562DB85930D92DF0CCF56F45D054E5E73C340D72783782937D6EBA2823B554A6BC6C459869D04FD9CB11FB5924BA48B578ADE14D3815ACFCB39D2B5124E57C1F59786A32308281BD74CEDB3D05E7AAD4F46F00F89301C82AE3735CA95F2658A0E93B85745F9C3590509B6356E11FDC49AFBD301EB3CD9D6450EDAEDC21EAE0E793BA03FC32030A8CF3A5447430B90CB31CB00FB01DA1260BB93442026D83D6F9B7CE133C4D86F99A6FCF0C3D83AB2463D1AA8D973853733F0CD68BCEB14BB2719E888BB0D0C42C7AD5C7702D5DB3581465853E44297852FF546E958FC1848879479495FC6C12DBB632DD2F15F73B4091427AD3C1C66C0FB77D3C28212B66FD0C9C9F16388A55D43A2ECC5019D6C9A5B60B9A6939DAD8DDE05EB3370BF9981D53BF6FFA8617450D3A18B5BFCE7297001A51C9F84C2F8F6FEFB9BE294048ED067DAD707B7071E6D05BE614BC0787D77376F2F7474C9EFEBC066FE6768D10DE0566E63E3A62995F52F1CC26F29896663CDB56ACBCBCD64FFA2FFAF3D776102E09F0259229CB527E5C454CD7402F5880FC7987DA6F585174F6E5D328D6EBDE6B40706EBCCDE1358C55D7E164FB19494B4794450C0D9820F2264FFE6713BFAB2B451DB814BF9D571C3700CCC66E4F13FF990D3C5149EB185E182D162FA9F6DBD77DD57CB2E19993EFCA9AFD6F00F85F01C82AE3735CDE5573A5FA8BC30387F72234FB331DB909CC2A050D469CC09A779E8139D78AA7FB6CD12EFB4090A5B0B4F3C66BEB1941FE1DAA9FF10520CA036C265682B77ABF09DA55A840E5F24C43B2D262D5600E79AE2B3FA5ACF8DDBF7076AD7433A6E12B11A2C9C22DAA7870157E5744FF2FA4ED97C91B312ACF8600E2D33DD3752747D8A0AF14E0A2384C6A82D0B8E1645D3D336799A1E30E191D3FAE47B65321E3511B37C7A8A7EB19584F26DA8E58261FF0BEF0A31AFD7946B390038B5113776ABE5472AD1806FF12F7ABB322929632F5D4FD0D0EC0136429202C525F7C8650C94994646A47B55C1B73347B549D98B79493EE174E5FDEA399D642F579C0F4AAA9D4D8CDB13FD81D204CA7E40ECBAD2D13DBDF717CC60978832EBB7676DD1170C9919017639A901B83ED337D8F125404DD5444FD419227CED7C69EEFFA258BE7F43B2A6A1550F390DA74086C3D81F3B3706DDA2241BEE04A23E93F7C486F00E82801C82AE3735CD85F0E464C7A2662309AAD2CDDC2A5AF0D666492DA21BBEE8EF70F0E445637180B362FAD0B69F77692175C456EA3EE3AABE27E5A8465A0F26774FB53F3E2B9787DA2E08ADBE3C3780A722F08641CD40221D9C322AA157F0499875E16491B72D8A8087A441E5F75CC7ED56E8275576C1DE5F13001D58CC5EFE84DF64AF959287D845E955D54041B38EFCD172ED91880F5F57F66726E4EDDA546D71231E6E1B45305283B68319FD93CDAB45E4FF1BFB4EEBE1344FC86B4E5C5DB8D1AB0EDF575A06A0770EE0D38EC161DA5A5758095482170B10101DEEC3675ED12871CD89DE67C77FFFC39BEA8B5AD47EF92076D802051BA14AF98BE04AA3769985545B4F1330CE2084F32DC3E2A90B703B8253C07552AACEEA7C31A45FC7ED3D4686513566AEF879F9E6F0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000201000201000400031100A7BBDA72E68A4018B176DE3BAE993266031100A1C21100CAA111D28B020090270750C4170D3136303931333032313035345A300D06092A864886F70D010104050003818100597599565615086781574CDA09940DFEA5EB334B2954AAD5C7267EA0BCBA4F91340CD0DFF66BD1AAFBFCD74184A8C14C1FE39618E8F198EC92D46CB4FA36EC7784637BC949E79B72166CE88BC2BB79FF3C625642C575D0F33BF1D46EE9922E12B2CEAB5FDC4D90F5E27C27167613ADBCDABF05B02D7BADA45DC6237BE9B5D3D9');
INSERT INTO `sa_debtor_finger` VALUES ('9', '0', '2', '6', '30820776308206DF048206A6308206A23034302F0201030201020410E1BEBD29A16E484394950C7171A727A70410479D6AD1B9A811D2A7A70040339F131702030200000201010482066000F83701C82AE3735CA75C10CC684FD9A527108E0335DA77807BCBE7F208A00BE4A2C546CFE1FDCAA5241EBD486AF7026326BF661C379ACCEDFC5C5A2E1E4EEBE2E105AE51CDCD8D9FD0A39C3AF1615CCD9AF807787F89A39657BF6C4EEE8BC714D8B640A9FEDE7BEC0D2240A71DCC2C335B40C93CD23805050B11F9EF39824DB10A756954DD87B7F117ABB4797ACC5E4BD91AA3A213E8115FF8DAFD052285E9CFE455053252EE3701C0DE4633AE12240BD43752CACA5EDFA91BDF8FA2615F0735AF30ED731AEC6A098F6160DA82552668B0469FDA20AECAF2CB38918B365FEB58D8B132CAC90D5E0EBB2AE7F3825CE7AD6C0D35DB7FE289D4DFD69AC71919BF6DB59B857A1AFB17A4174283F83C09ED12EAB8593EE2C4C48BA928794C741EE0B17C56068A1FEDA5A73B79896814E15FF96DF1C1771E4EDAEC83776F00F89301C82AE3735CC95E308D85F4F20F12409E286891A4E3ACD62E13ABAF752462A5672BCB8A532D0FB75D3E76E356B3DECCFBE9DE90B7FB4AA44F70E03FDEA1CD61F67E8CEEB9BBEBBA0EBDE1E5B28DBD39554EDB6A7DC68CD91EDD5063C200856BCA3537CFBD992DD79470CC178135B17FBBE283AA84C24687F644797268D68171C2A5D710D8A2E7A4F3EC938DEF680AFF7D8B363E0A159D8085815865CC02A72E901D83AA2259B285557216D59481A0E50E425C76320E29C32932742F678AF3BF4251E446DA587A44115882C79999DF3424CE5024E033C01763344A9AD3D14F273F27451F36AE58D312C8E7028D248318B969AC9A3DC443733863B8C15B6979EC8D86A452B8B64F9CEFE6E5223EB880EDA43A90D3F01C43D8735A882579516415BDC9652F12762CCFC0C8907BF8FAD961A230B781E19B00800C5C1CA099F0679D9D4C66150034567AB7F88175D305E061B32209CE2352C777175F5297ED322409C352B3E74592E53499140A018B4ABEFF2C0D027EC0223FD87A3B6F4EF8FAE387BB186FB1BE15D2125432D40FE827B6023FACED106F00F82D01C82AE3735CAD5D11C478EAE2D75AD0EA73C61317156800C55B22CBAD33014DD0792A47A02C2662AACB0054164C77858DA30F92F12035985C1D77A8CD407F27ACDD399D6843D2BA6D8570DC8977D0A49809933E50E5CBE3FABF255E74E272BC5663C7AD67DAC9149427800154BD31AA79A03081EFEFB45E7E7C73E7D3824F0785530EF9CEE2120EE31B431F0626B3F7E35565DAED7746A2C95B875509E0BACE83DEE04A5D5472D992A1FB666610141F91BE0C5E162D259EB2ECD96EBDCE6CB939E304C219AEE86B067EDF268DBA9BDFD7594BF94ED54BC33E80318A474E2DDE314529F2E0AD60E457AE3351C950CFCD66A13B4724D2074E2A82CE81258319E32A3B4814CB8D05BDC602342121BE08242CC6D7ECFAD0445C08DEBA7763726FFD68D37D95830C15EA98133330876A6F00E82801C82AE3735CBC5C1CD3EB7E74E5906E8E020131863FBF382E247C94748C383C555E4C90FFDB5F80499460B8DE17537C3A73FAE519C261101A171B1911B40F3CE94CE2BDFD9D9BE5B78899C609ACF0DA77C156D43A6D940319118485DD89BE1FA6F6FC8E02B9D01B62E7BADCE8721870783873A2A92DD1D66EB4E27868663E72FB33784C116E93FC45463F512DFBF172CCEA0B960C8ADBC3B8E9251146045D67FEEDBA4D4AF5911BF349273B9FFBBF0CA8E750EE88BB1F1CF042B2F8EAB248BAFDB0268BB0080A06FF276A4445AAFE4D99E9DFCFF6B7CDB9C6FE763DF76D12F27A34A96A29DF59558861395F6A2D65408C653D9EA71539AC2BB51C2BB3C8FF6248E354F4CBD2FDC95F00EE2408D7FCBF280CD59749026D0C057BF18791594E0E1552B459711DDBB4276F000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000201000201000400031100A7BBDA72E68A4018B176DE3BAE993266031100A1C21100CAA111D28B020090270750C4170D3136303931333033303433365A300D06092A864886F70D0101040500038181009284FAFBC41B7AA1DC0B172A4C8258773E12080FB07866F19FFF8877E8F4612DF87246910A3646372E04D8D50FF509A9ABA5249ED6B449D42A2286EFF13D3C89EADE97CE8C783EDD487F966A8912524B974749AFCB2A5CF2C697C25059594F73581095A59810FA3EA3FD19CB37453DCFCE9B5FD474CF571D8CE71C57EFD11C12');
INSERT INTO `sa_debtor_finger` VALUES ('10', '0', '2', '3', '30820776308206DF048206A6308206A23034302F020103020102041051806EE1C27D44FD9E22F1562D94CF170410479D6AD1B9A811D2A7A70040339F131702030200000201010482066000F88C01C82AE3735CD8532AC9A7E56EC86682ADBD6F8399A301B6FAFA4F2A4B55FAD1AD8DF120758B80588E41509CF86EAB3F2A7DB12FE3E2E4AF17AB56950572AF8F005656D475CDED5B037FBD6BD7345422A596958B92391BFCAF0AD11352101C04845913B8C52678FB8D4AEEC4672641E8D48D63C36A40692AC2F5E32F1FB9BAE30ACCBC31CDAB9E1D1F79435107D392659DE835AB375CC59156A29E08426B6AF54FABB4562ACA0298F21BF01C3874571BA4FB85B8760413282BA41A5FE4C60D28375DFF034FFF9BE0A839217B9CC27BD15C8BE73FBF94FBA037562E30BE425DA765AF85FD238919551B009A4EF25FDD8C88FFFD2B2D954147D456B591DAAF3F945D14BE8EAD065CFB54C9CD3BB4A30950975A3B34F11FE88A025D51C1821AEB1D0AF2CE05583F7FA5AEC93302D23D82237CA72E32274682284CBFBBC25FBCB9CD75B32799EB1C11307B642984BB77E0A2EC3A47D035BEEC5EE8684C9C30BA68FDEF1FD57AF9759DBDDC5DA841A1E5F91B49247BE02902F2EDC0C356C11A82F3B762B9FB17675834D959C9BE82AC6F00F89301C82AE3735CCC531556C34834E40A0A6C985BCD1DB03D527601ED5692D4BF4088C7B8A313F505516AB914D063B849CE5D6DA54D42667F5574CAE2F42F7B4E36BD33DA37CC0967278E2609A632CBD6DA6B2D595A2D9CA04F5743DDB2456D40D7D102884190BD03B925834466AAC8D473E4C6AE532E07961FE64E7A0189284B07C30135FC1042CE5AC5F0350DC71D06D23407E8E6884877411BA1E8CCB117A24FCD809347FE11BBA628F8AC118868028938C9FCF463F0731C7D660CDC117EE766CB06B3F558E18E660F299AB06C4E701CC574E22C0C947BA77F88305FA8B77CA5845ECE20367305CD940CDD8370197DD0495B2C323813F096947973BFB4D76A9FCEE0027C42589D85588C27049CB4C81B11497CB14680F1C5EED8EC7479DE8C82457916E8F2A677B99DA68E1DD61AF37FCB4CD9F2B8341FAF34DA1A4A42194E46DBA296F05BCAAE62E97AD56F8244EB808B1615DB1B12F3BC20A1AA3A5E8D3B8F3FBF67E4E1D0849134E8D5137C5EE8280A8ACCCE4F582706621C05AA0DE4E15636F37008BC69F3328060FA6927D9CF5783E07A226F00F88E01C82AE3735CC75322FDBE231A6E7CA77C38FE2CDD2613A300C4145931DE5A400B2156D29BC2F955438EB9BF808B3CC7BA880FEA02DF8A2C368C5FAB9B8A54952D221FEC42037E9F5EFFCE1CF99DF8FF7B972C27568C1AE51323DFF3D7E13640FC387C720E70DFAF3FCB2F0D4867F3AD5F36C1C91DCB216302FF9BF891CB7867BE998F81457CF499E86BB1D7987D255047DDBDCFC7AAFF57FE1DB2FD6233B55E41C38EE332779DFDA194EC35C28E082F4A049F2CC9D8630677EB2E890B5D1AE5FB20410605BE369B27391E8F84A165A1ED8EDE5481DDAFC6534BC50957AAEC4E9D06C068806A0A0353700664154A3D65EB0D735475842B4063FF2CE4540FD28A3AA13AAB7BDE7C4AD33DB183191E0F5AED0B1BB695147D88EC886AD96695CFFF318A0175FF97B742B99914DC5195E1E65AD2A1DC8BC1068E3E93B5D3D11CF70F1632CB7C7AC857B4951F78FA9B588CE41B7B9F3B45908431C4BF0CAB0650553B8E6DE53F4CC126EDEE025E8FA5295D27E86E8819D17892858CBF1DDEBCF54A2DE45E77BB81332707A4C0933193E66B6F00E88F01C82AE3735CC4542E457FDC949758E7ABDEC1A4EE321F85BE81327FAF0D00F3E9A1C9D0E1441C5217FB1EDF3C2132EFCBA88BC982BA3C26BB9BFF162F97DA6333B53999339B55CDD5AA35B486C223541D20EDF23C721DCD32475047BDA9E36F022D477B7B69F56F321E4A2CB61A182CCF87DDD955D55DBB6DA958297B3B13CCCAC4AC624EA5A413236CF039AF07B9BF9D5D58575E186F2EF0C209A431076A1C08FDD72ED516C807D22CD7678C21B3073BAD98873370CE552C751E36E3D864BC2908354AD56A5080520C86EFDBC9E8B772AF531E4B57A0E4AF5A02001C2F7BF1DA54D623709E3218861581941404758CD41132F2FBFA1732B4E66BF4F16D71E4B67D9BB98CE84338B8ED96CFE68B4426CFCF8647F0A42102EBC469423CA2AD7C55CD9010B847B9A1850FEC606B3855BFEED5E8E00F544F98F29AE12EF4CCDAD45D2E455EAD2E7750CDA79D0C01A42C176BC3B994F9F6C150ABF011101746ACB788E0A142D82524589ABA74657CBD880BAA1411072E633B48E580586BAC565E7A0268B3F7AD2D7C69C071622E7B4D4E616F000000000000000000000000000000000201000201000400031100A7BBDA72E68A4018B176DE3BAE993266031100A1C21100CAA111D28B020090270750C4170D3136303931333033303435395A300D06092A864886F70D010104050003818100A4FAF17F6B35826FF20B1DA7FFE8200AB4CF4C9FB161551A0B044F625BDB4FE9B5CA57A0DF165F79F51593136F74D17A69A5441D5816AAFE4606550E0639137CAED6869BA3A080D7B9B75F6EFA9140381697EB2BA9E321F3DA4F54BED3A08063EC46FB7007D35CA1F88B1F554182AA47C2A962B4268BD084A5D9C31C1BBD048F');
INSERT INTO `sa_debtor_finger` VALUES ('11', '0', '7', '6', '30820776308206DF048206A6308206A23034302F0201030201020410509BA11A46D647BBA0BF34EC57B845AD0410479D6AD1B9A811D2A7A70040339F131702030200000201010482066000F86F01C82AE3735CD866228F95B3205F73B1F7C9E6C659087C77FB02A3BC260D61706425FC55D9A978C1F112CC8A4F23F9581E11B5C5BE9599344F9DE2122FE2CD63EE703327A42BE8558493F7E6C41C10C0A7DF1937F62A0906A026EE1F2A5BEED529BDC2308F86C0410BB8E72AD9AA36B4EBFF3488000EC769F3EA1BB05FC897D6DC8481DEA3E82D1788968DFD4E1AAE02C1F256BF7AF3447A22334CBBDF62ABB67153163D4277EA6356E23DB6627009E53BA6E004E5CB512103441DA682EF01452EB8D35D628CD8B4CFFCC634808EC2E039CF6D44A4D636520EA6BE8370462056F5E19B77A7265F1FDFFC853C8526A9AA4AD82A6A8D26F05D8BA1C21364E537F3339D4105D19BA4411DFBDD908AE72BC7334D67E6E021C1468938ADF7BDF6BB3A8FC54E94EC82A2087D13432E3E5C6E2B54404528960A9462ADC21C2C7D6D41368560E26D6DEF49208E220D4C80444143B58DDE743459C5257560EA52BCFBD5F1AB1EFA1EC26C2B54E902DF362D27A3DD6F00F89301C82AE3735CC858259ACDE03438258D5B6620A7D761D6FD7D33FD8F498ECA9B88584CD5C6933F5E468390B7A3A9340827E638C00BBDB369894EFC8306614230BC048EC74E8958FFB305A911B8587733274E774738CA9C62D3C381C7784B414F148C57FEF4ADE83C82CC531CA04622CD2C813A4F5A9C701F1794C52A7BD740F4388D3ED215883D47B8B9095CA23A0FB19CA1F2E257B9774AD203991F66100A574C435C9873D72E845403D304860606EF4EFDACFC3B4F6C451EBF23F847D63A824AB8C4C0883198222C05D8B7143D86C4207C5E3985AF6482E0558BC2374E99F4A3A60D968BBE043CE22BB10C6BA27C17D064A1549E1E374829E11C87D106B3837CDAB9BC9D9529C532DB12D559A17594FB115F7C1605DFD450B044910FA3A2975A1DEDCC3806EA58C8EB7188B5622271884731E3A0E0B330F22FEB2A896CD2F2E6B6CBBF359AC94C6ECAAE74C3CFA8C8EB08C4B9184401EE773A76AC5365775866B43385D98AF3A009CF0C8C4DDA185B25A45E5C456E6D20440088E3F1EF6874CF817EF372414736F1B7B741BAE9AEBDB54B18F06F00F86701C82AE3735CD3622286D0F6ED2352B985C321B152463765AD1364AB791C9D386E4A05368E5912ECD7B3DE92611FC3525D0C6CB4F0E10E975A0633D0D0094459B5899BAEF3BB7ED8944B3E1BD31ACD8163AB2E5030261B4B0BA4ABBE83DFEF479004832882E2D6769A0F262BBC18EE0422C5C2AC5C85CFE1408CC5E564DB41A75247BC6E6603D2A66B90B84C8E0619C3DAEF57DBA91764164E4C38D2CA9145A6F6121F783DE3F368BF9E286E0537FB73B1BF205EAC6D48C0B6BA51F7DDFDEDC76AEB90A81901723DBEEE54A168E362F4B79A00C7034A115928FD1038278A3DC7345AAF7251D06208805FCC2FA7FE563905C47AF2B1728E824FAF84235D92D7BB0F7B0736A1B50689408CBA7F3A834FC1E04142688FED4639D3A258D44CC715E1BA3C5E4AA2E3938AA3D6806F222D0A2ECBAE9D9A5FB32FC9E59618DEB7555A65A6F5E70BA4473ECE75FD2FF66A6B5F1995824C1118EE0AC3C4627A9912E7563A83FFA30634C0652F6F00E89301C82AE3735CE6582B55ADE67BA60E6FFE9D097648C9905910396FA7CA4D1A5EF773121A6AF2E5299205701E682A184A6082F2D27ED3EDE0FFA1CE04EC8188ECAC5B4B0EAD24B6DF18DD251E02D59B7C6FDA31790D83C2BE72EEACEA31F78356EEC255ED954FA50E8107B7D3EE675B34A20ED4546743982F73FAA25A13988E0708BE036E57B443EEB351287DE5E166FFCDAC23A201C8A24C9D3BC323083F93B06260CCF06C9D4015B6D596AF5CC669600F79B1E704BE0A828B03D14DE41A8486ADDA421D86850A2047033644BE4CA62115FDFDD7E9FCB4C830C1207E260C6E2EA8B58FCF8C07ED1414EBA1831FDFC005B074D2201678FEC6CB48733A699CE4D9140393D725B6CCC676E953435B11FE951AA6670D0D232DD7F6BE61E6135EB197FF64405D1FF9E05AF1718666D13427A109B62A2EDAA38A1A69DA639473B28B60F42FCF88E3D3518077843AAFF559986605DAA7230B7B66BD98A8529ED21DB8FF45B197612277E42C158115386BFF79E1756AEAF8377FA19C710DF7417FE29E9D65C4C8D8256F3905C8D7F495F1A6DB6A23FB538A6F00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000201000201000400031100A7BBDA72E68A4018B176DE3BAE993266031100A1C21100CAA111D28B020090270750C4170D3136303931333033303634315A300D06092A864886F70D01010405000381810032DE7407BE4F431BD51D67AF7BAC7210D1920E57DE4B7DEB8D57C265810B975B4C3D5FC32D02AEA2CAFF84B3585BD338299D95B638C15E2A662B8B532C381BCC3562B85D8DEC3570B33A6FAE81DE9AA3CCF7C4CDEE1969D534B3DECBDAA646FFB36BD1313E9B56457647BAD457773F226E0F9879D3D95AAF3502E330EF6AB1BD');
INSERT INTO `sa_debtor_finger` VALUES ('12', '0', '7', '3', '30820776308206DF048206A6308206A23034302F0201030201020410310665D1394845B4AE108DDA9B16A0B90410479D6AD1B9A811D2A7A70040339F131702030200000201010482066000F86901C82AE3735CA65B140D5C0CE0F4A7A89FE0214E3ACABCFEDE31BE9BE59894D79688DB9BCD4107A69BB6924398DB16D24BEED9A8382636DB7B915D1692A3308216F4926189BB2E83FDB59133771ED5F4E312B41ADDE5C79740DEBF78BA6066E72AA60F3105E87C3F0DA8B5B89D1FC89C6D53147A465C6DF4457DCED2958F7784432D424AB94A3B4036C70DF4C9CB92250B48346B66582F7A7885136EBB202A27FE5B8054962E5A5A148024244A68EDB086659A49700A9C4C81559AE3A4A9A7BF6E8FBA17CA83E6E7F1C1D1CA0C80F75C61AF2EB2F152BC10AD3D097849B2DBA78880E9B155CE3AB37E10A6DEC577BFD2AF79FD7A84C5F88A29381CC4312B9851CFFE45D839D0BBA2F1E8B5FF30B4E5810D592A83EFC985FE39C01E37C7C97625E8487C18369AD2B618E3B15B50DA91F6A0BCDCF25A75D0C6B2C202FC179455071D626637F73CC2AA34199F807F3BD17AD5E57C013421F2E89B9EC90B76F0AD8A1C7C55BCCB55C83749C26F00F87901C82AE3735CD65C1DD4D144DE56EDC4D41DB9DA236499845B7CBBA8C7B15D06527CF74FA2BCF79B534F04C6B09C89B114640AA109C185C293955F3D09EFE483B0522C8E87279F8C9BE88750BFBF6B2995640CA71E3B91193D70356A0171C90FC9B313F8ACE8CA947F337ADB12D3B4C92B45BA86F837A37597B971603AFA311E535DD19D226EF1FE07ED22E54D98D2374CC2658885DC26DC4B034BF66E41257A4F78A2C1EB40A455DE55BB0C582D72F1C9048CE8E46F040694C82E8DE7488BDD782E7A5B81889D474D5884B71D31C7AF08B52B5920397CFDD3425647CDCEA2CBA3A7A2E82649D4F8AE0338D9238184ED162DF31A107AADDF8B5C9C54442186BA88C23713E82E0464020A7475FAFEC6C4FEE45271EE837B1170F599B7C7AC4486B29D913FAC02576114470243A767D9AADC7B563BBBFAD98BA96CF9D68AB30355C1D076BE861812C358582089F7821683837B38AC23233BBAAEE78A3576F869D28F4B80E9385918A4A352BECBB17534626A089FD55372A7B66B076F00F89201C82AE3735CD35A2336676B544D390F1851B2463BC73971224F67D6EDA10CB654C97CEC66E64EAFC146797A2C284C844955B088D78AEB51D2E16C9E70A205D048BF50901A0AF464651376B29172DFBBB392307B867F4722F907CA0E4EEDB5055EF9710FFEEF08391759BE7D80D9F5C349A73116ADF055B66B66092B6B041AE501C560A01950C5784BF329CD4A50A467DA502CF62C90698E4F0C1F85E02BBB6AAD6AECED494FF78DE52C1A27160E10855CF5C7E493622CDF6FDD473FC93EE4015094C0B068A2A5655C0912464B9296FCF45885AC9DD747B504A73497F685A9C1EBE2B461785E697BF2D2E5B9AA80C3CFA578C2E6AFFE58DC6F7738DD471899B9A8F2E508A2242B7D621AAA0D93792814FA7C75CB294903D4EAEA67BC47BC1C78635F304CB4DE7AC5B26EA2C98567FDC26D5008606302C9C16DBA4C4FDF3A6C8683D8C70638653866B0E77619C8016ECE9263F27865129C2E08831CF2968353EEAA74C2E5A7BA8B93699A50E40CB3748F0CCADEBF54D404B85AE8769B6DFD046326027E55D97553D9C614AD2F0ED9E90BD3C9AD6F00E86001C82AE3735CA35A20185A074A4236D4F310DB108B8492B56DF09E264ECB8D8F8A693DA40F0DF6FC55D385A297810E6C22A9171946ECF1D814B62CF93AD172158AC496A7B68969AF60B8D65787354D0995F0AECFC91EB24162CA72C0F24FE288AC0CF5984653133E7B10D8FEF29CAE957D14BC1A8D9337DDBBE0321C3B098C7047D654F14CD91D0AC741251FF211487A53E36D30760E992C9CD760D79BCBDC01C72AEB78AF53088A2EAF0EB557BD9AB29ED4E57AC68D19A050277E0265C04AB3D82985024EB612789D8DC102C8BF376F99C305327FA39E111AE4A78803D1F08257E95010B16B2671E5FCAB9BD2C2B7946303A167702E82801A89F491588AF2E8C6117B6A64A951BABE6D169FB383A8CDE31264CDE56BBA43E65CBE55E9DDFC049AFFF15662E65EA2C08D2611F5449DD3714EC73616BA414FD41AE70D2049530C80AFCBC9D8426B8662FC9D7A18A9B0B7158C85C55FE82B33DAB3CE08E8C2DA9AA66F0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000201000201000400031100A7BBDA72E68A4018B176DE3BAE993266031100A1C21100CAA111D28B020090270750C4170D3136303931333033303730315A300D06092A864886F70D0101040500038181003EA726B41A640DEDF0C825F3614814665C93ACBEA57C991FCE1339D236D7FA0EC3B5F25EFD08C3975BD1E60D24E9FE93E4D00935FEDC3D3C4CA865BF53F22863C121B0D793C1CFAE52C13789D46820AE1310667CEE9F28F6224032E760EDD2C64C788097C8D3314E4742781E1C15F574D02BD34DBC7EED03BBECB4F910FC415C');
INSERT INTO `sa_debtor_finger` VALUES ('13', '0', '15', '6', '30820776308206DF048206A6308206A23034302F02010302010204107DE4FC3E1E7E49CCBA638E825878754C0410479D6AD1B9A811D2A7A70040339F131702030200000201010482066000F86801C82AE3735CC45E22DD77E5DA2F29DFB07BFF13ED9BC47B95590B76DF360E3E1A7CD6779B801E3951DDC0B4F9CCCF0F90CFD068B94BF45D4879B99B8B833DB1AAE5DE009C6F010B6A52E346494FD66C30528663B10FE1F97344192803B9845A395F8F3540BC6C75248E02697A04B0946879E401FB37BC55F1C7077159E8B3D27EAA5D175BA757F8FDBB742992F09094F56FD2C0EB97196F5CDF36B57682F69934D94F70C6BAEBF175B4E7E5BB4165CE11D8F07748BED4D35276BBA182588074115F63A74095B1D33CC533646E8BCBF236517337D4AF02DFB6CF17993B8F56D2D051056EF1A8254E7D70DD0A88A02F7189FD491A2377A41F75B4C3A35FABC69D01E48BED1198E257C3F01F99BCE00AEAEB540AFA3E4A3B748037A54425BD63B24D65080203B05BE32E45D60BB97616AA0310FA7B671AB409D94414AC5280C09D71571ECB981E1715D5680D55DCD09E3A185085A216D1A5D731DC60D3C743E45FA4C7635B420885203A6F00F89201C82AE3735CC05F3D951897CB57B5EC7D831D15FD35D61977B8D6D53AAD50980B7F9C5F3C33796AC0E81955EE32A7FF7F64A6F2C35292429A050BDD76C354F5635484A80DEBA2232B7125DDD1F1411E6BD7D9682E58762E7AEAF9C8B6961FB2F40A006FF374130C27C3590FD0D21BC8D89C957E1A9712FC10D85D9B78AC7C6EF91EB34FAB0C1DA1E9A23F3621C6503AEA09A269CEFE502D8D9A4AF9EBEE9B4EE23856C250A200E468B55FF5BFAE92E57895471C5203F4CE2F35471F8DEE2D7B3FB6AAD376196334D1D472F694FCF64EEC76176ECE57D88C62CCB2D587AAEAE5CFA19E71AD72F9858F71B86EB733BBF64C4DABDE5ED8AE81012062A3ED7EEFC97FDE368C4A1325FDADA85B28F1F7C025E433B9792C471C1141C530560631B74E927ABBAE1F23E7ECA10018CA070DC9500B2F5458A58E1F4D42A322F22D8659C27778FF57F50E3402256D0BBCA08047D5AFCF79A0FDFDBA77AB7828AA9D54586F7F35B288EFED364006BFBCAF119740523622B7ECC588B14BC7C9238ADEEA3138EF197CFFCB6AAF8CF4FAC5ACB2652AE28896316F00F88001C82AE3735CF55E22D7D4C3AD531D1CCAA04F72060DCDAC8E0ADA44763357F7FE8EEFCE6B0B72531E622D1C8D8D428A509C6D992A98848346FA0F5F50A249E0B90F9350B27BEA864F775A4A64E9AD36946F98EF9A5AEA82195AB3935F08311DF1E4E7BBCD7BE3FBD3291C0945C3EDEDA1CD84DFE69AE99BB538DC89B9EAD7E611E379439AE30AED37C158CF8940FC73DD7AD7E5286D43BCA8F9858A03AA86C4DB807FCDA4101B0B7D7FDF6F199E29FCA7901ECCAB04113DD6AB54F6CA48C8A4306A09839587151E22AC9CA82EA6F509AFEBD573A219CF816D2BB9072C262714C67F3A75F09323DF6FD1FC99199D1659FCF58F022CCB358E1864CD789C6EDA304979C3CDBC945C1A308B18F1F9C7255C6D9DFECC4E0A16B7148B4AEE59261CE18F9E8CBCA7EFEA728C802341FDEE7ACC8012EDB460E9CD43B5C45D63F42E9BB1CEB36DBA8FB464AE38DAD42FECFB496F27155822EF92DB7831EABC2541280B21492844D4536340C6343545B82D1252C5CA4F10D5B73B51C3828B0E841F7284F5486F00E89301C82AE3735C105139DE0E35DAE3C1179F62C1967DC646B058441DDACF160777A3BE43426EB50A23193D1B12D5230324B8C955B2F3AAA6072E7DD39FFC8A4ABD5E9B0DA486BF3EA4A95815F05885843EB945569D597254056D7428CA0333A83910B1FEDC0DF6FEFC7B33F552712C045912CADDB5B9F01AAF0C68B4DCFC2519C068153E8EDBA9A439E36924A54BB68059C971CC69A2815F9ADB355D37F8DC24678CAB2EABEC548967238FA4AFCC9F18CD6D1ADD8580BF2BFACE7EDB2C6FAE6853E49285ACFF1B3A9801F9F6F500A061ABCED442FE1163C0A8F818FA76BB9AE3C8BA5B9EB71100D638AC19E2C69C81D6AF3894CAFAD40FFB1CFB8D5D660749DD4C31B1649F4FB83EB9F9B85FF03684D32FA255FCE07B616D1672D43D464E282C6E549CA411382368D19DDF17A4021C9F7BA8B21211E45E291461EB9DCCD07F424A1FBEF7F5FE9CF0DF2EB353B3B2FD50D76DD88D25C61EC814964D042CB485E87374D51FA79DA316349A15CFAF807D0A3E4E2C204D67F99D2AF95D996C69EC49AEAC99FA5275CDD126C1C714739FDBB742D12F86DE6F0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000201000201000400031100A7BBDA72E68A4018B176DE3BAE993266031100A1C21100CAA111D28B020090270750C4170D3136303931333033303832395A300D06092A864886F70D0101040500038181001589B27FB9C8C9156BF55B8B5E4607DA5606BEA392F0C49A53E125EC9B10D8AEB9933C7CAF26D925E7C5823C003DD1355FF908ECE8A73971F87042B82AF4B60AD7D94684F039849DAF29F9F64F7E9BE9A4E2378024F1D4234B7BA28C75AB08FB78B7F5C1CB72B1A32201B12C3CF78F9F864DC844DB15589DB410913DA3AC0931');
INSERT INTO `sa_debtor_finger` VALUES ('14', '0', '15', '3', '30820776308206DF048206A6308206A23034302F0201030201020410B0DA118766584EA0975C5F8BBD8956F90410479D6AD1B9A811D2A7A70040339F131702030200000201010482066000F87D01C82AE3735CDC55157FC5288EFDED57F595B4F9D40FBDB1C5AE17E0BDF8ECB630A39FDB28C54204F86CC700C4A0C5852BEFF2CD2B889C30BF8510A57277301E2B56F0167D252CBDA19478BEE2CA0F521FC1DB504EA6B992217493221E60C6352171C18D055388B512AE04CDBC11E4C7B4A8F2B17DBBA4E6A908696849111192D7266110389AD85FAFEF02812912632F9CD9E66D63AF4A0CC2ACA27082CB598641E8C3A24FAF96F0CF56F403B64A6BC410D58BDDFD78FDE589A1249EBC389E490FD32793EA5499733B9E1BD7257F7CFFF5DE11D969B08F8643C148E2A109D0156EB1EFE59726557E5975D071344EA594B3C1C3BDCB1B1E2D28A3C1AE65AC9A4CB0C8215B0C53839B737493092246B63DCAB229CDFF1FE15D7AF822D1DACC0BF4D3DA802EE671D81A42AE96AA0ABE72312DA5FE0CA54DD9B503A95D56AA7E4DB6F78EAB5A5639F32C083260A20A492F5E729C50E9AEB4AC87A604A95C83277C74FF2C5390868B7418A007B932EBCBF31CC555A4915CA37F1CB7F70BD191896F00F86601C82AE3735CA153134B842A2B4F47F73A1FB7A4E8D7CDE380ED9C21B78A7E9D5CFACDD5C2E7ED8149D8966C9A67C341783F1C3814D73ADB9E760D2DE058F0791F8BB865BEDA56112DFD2B257EA5DF0989BDF35812E3EBD3B1E3CFE519BBC7842605C81AB3145C1E8457DBCA3726753E0AF908D2928062CA711B314C7B3273551A98B98DC5523E8C98C4FF3A014948C8FED3603A5578E89080A8DFC1059FAA1F6555DE9B4A00F48D50591D980C8071A8343DC4E7C766AFC3FA969A1D88452C4026FD8E919387C3F81D567E218E4304A312959D7B3D8E7B525428551190FEFD54C3D1503742768D58173D14F48C438E0D66F12107903F09D7517B39909868BD737F563659D83539093909DFA9B30B5A5FB8285CE2AF24C4F66840B0C08CB87C914034F56471B92D5E3AA49F7340A8A841CFC9042D532879879F644EE71D931E17B6238E2D0FA7413C91F4215EE2328B0BAC42F2394B5CB74A71D1A7713A2B93ADB55C51E8F57D666F00F89301C82AE3735CC45412E07A6FBF513E70E27E2FA437EC83136DEEEFA971CD4F896D38BEFE4AE96DE4B259F6CCEE46DFCA3A80D1FC5C5A18F2AAFC16D4471F78BF397922C86D634A9D4E25F14F3EE0E088F37E3B86A78AE7F4EEA2125833520894F0269CB6EBC59079EF8549CE19B4E7C124725ABF8A6709CEE87FD6885A1E4DC6C4696BE09D78437C3C64DD98832C89EA3DED3CBDE5B8B15A521A95FA0C14D5F584933196E6FC0F01562441A4B706A5B37AB0F1C8CE38499616C0CFDEA5CBAB0C4C10BCEBC314911C597E0C010AA3038C60A844F9A5B42A323EE75A853A3CB9FEDD3002CDE21ABA25312C4CACF95560B7E0CBE21155B2754E4548ADDD6DF328BE7B68C8DF745A6FA02FFD59ED0888BE506D5E90501BCD501A13CBA25FFE403A281EE8DD0C2C4B09A46B781C9D9E43053AB8B21FA6E317CDA6C08A454CF8D894D7B3CBF2FD7CAB934BBAC51E0EA28B36A56D951025DF9B23ACFB1C1B39960A1FA55D3273B96205912041A2F0EFD251E4C73DACFF82667483EED8790CC7A94C0561BF408DE845277700F4A97FD2A346E4A7E8B3281D6F00E86001C82AE3735CA0542977A158E0A37C271779FBBB46CE6588243067ABE1FB3682E586B91B37FCA41036614CE8901A6414C12B1EB32C5B06282375C0CD67EFB63BD23A857D0F70933A99BD4674ED291DD65E518AA715487E2182444F8780582D7992B4B56246FE5F2650979808133B44E18E0A48CC906709F6420EAFBF4911C7E322403CCBBB582A1C3973FABA1D191C590B1D7915A9F922C9B57972AEA1BB11088E1507C41C4F0D2BC473F6AF12AE1DD42FCC5A6391D54B4EE3605D7187322E4B3B3A5ABEE2D9BC13424B4A4320B0C10A1D4678699016D661E80F8CC24363E96BD7DD0CB76F69CDBA656E6CE8F302A4922D56EA5B705A7F9FEEBAE76954A7DD96390D568DFA0B076AA8813194EDEEB934F74573B4BDCAB9DD35E219F2C2A5E0E514E8B583EADCB15B5B06553295AD8FE00BACC4F11FFFC824DBAC18A681E7D7EBC8A7826D5F87D012840B3349527070792C8B5225932383F0F3235D28BE38962C4A6F000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000201000201000400031100A7BBDA72E68A4018B176DE3BAE993266031100A1C21100CAA111D28B020090270750C4170D3136303931333033303930335A300D06092A864886F70D0101040500038181000040E4382FC767AA265BD7E74C6EF589ED4ECDF726AD457131F367D7B2D8766308D6B9E2580AA7D0D76B3F1D59BE01C389D21515DCFC49D7394874E58FC3CD47D1FFF082EF3B2EAEEC41F34F4BA1743AD3C60D0FE3998A1B337733DBCB171CCD1D2132732949FFC7A460C52867EA86538FA9E4116B0562AF07F188E92436361E');
INSERT INTO `sa_debtor_finger` VALUES ('15', '0', '48', '6', '30820776308206DF048206A6308206A23034302F020103020102041070155620264C439EA0338EBF9208B50D0410479D6AD1B9A811D2A7A70040339F131702030200000201010482066000F83401C82AE3735C895F2E7AF74CA2249798CF8D6420523AEF5137D7E036CA348711CEB1406822FA2C9BDBB4BE18255578D1029B6E9DC0B32EF7BC1F5EAC62BA4E646B2A683A8126F3F424D3D88A5B2E41B8CB761EEB93E2B3A08264C19BD07A343E9822FDAA2352096E7BFD3A0D42842A2BFAB8FD9B38F3B8E0A51CABF8A5B4B1B3887C9C0B5551E03C050621931E60228CF921247FC0EB3234358714F33888A1A47FC4A671276BF30935F3013374642B63BBF46AA5D579ACA12B3B2E4C053A536A5E77FCDCD139E201906296E83FC9C82235261A554985E985F3A99936C2B0EAF810F92486841E207D322028B49D4C16518CB59EDC8831FE2358B4C94022D38ADFB13660585C5805AA257CADE14216B584E96D166A29933DEFA624F2AB7E9B09CC0A576359A909320F859BA32266F7F0ADF83EBA214F6F00F83E01C82AE3735CBF5015B463133C1D66D570BD47E8D3235A0F0A0231A554AA1E3C8E5B88EA18D73B1A8A9AF5EF50FC011E5F5CB1A86B526F105702955312379FB13688DAC1C6BABE0F2452688B62D06521AAC3CAA0C6F7170F9DC3EC2EB5FC9C02A20623E961FC58A39BBCF89401A7C9255EBF8151686A3656C94E494A4E2D26BC4CEE5D2C289CEE39EDA67078685374367954555BF6A93D2605E740CF9F5A5A4C6D72481D435775430CB0BDFDA7E161DFE468BFB83762879187B2A09CAE65220A4F6915ED0386D2D824FEFA10C7035D3FF07E9E99DFA39210F6AD8851F1E1E166C32952A9B6054A6694C4410E53DA20020A7A6ECECEB50923F08E2DE66D63E093A2869694B377273522E5A5AD0AA4B0BD4989F511D463F3BEDD4503354718020162C1E349FE2025061D9233D794B8E57DD5DCFED116516A26790515E90D5EDA6F00F85801C82AE3735CAA512CC29D67F98490EE56DBAE813412E12CBCE28AEB7874335BE5DEF8FF26290D8AF4EEAC9C247D8159A13FB3F7F0E50A66ED973C7F9EF9D3C4C0ED913E5D49B9212019EFBA4394BC86BBD3D9F8B936B8C208698EFFA43246D48B19C1F2162331CBBB37B04BACDB8F67690078AF0EB5DDED29494F95961F871239B9B071ACECA450CA24EEF6862470E9743CBD74C1E2D6991615D905C847415D285C88516526FE27B2B4EB5E286188C52AA17DBE1A72E9335B1AA4BF34DF1463D4C27A70BC0CD5FF3E91AB1C25CDC204A2FAA84B787628804354DAEFE81CBD6368E1D907C197CAAD1469AA5FBDDDB1C0108623413BCFA2146F2BF12C49289FA7F84515D16958F8EC71F80F0387613F8A8D0967CF4EF8CDE37373AED3ED0639B30133FA605DFD9BBFF29F2174D7794B0B9C828F162A4C28F275B42326F1D672F7737B91A30C1547BFA621BCEA5DD4E671DF4724B17B47C683DA6F00E86101C82AE3735CBC5F261BFCC253C2B2662595360F0F9DBA064A5C0C34CDB47C101C7028485FC09D73238EF6A1D9236AAC19B4F31075655C47DA669305C1601FA0575B1D39D32892D1C229EE5DC4803D40A55103535551E6375C78EF16F14790AF3F976EA9CFE19EBE4C29CF54CAAF504D7837A839BE4022BA3AEF8B653E6F6DC03679039B2C5C3AF3F6A4E163A1EA0A5F664310B3B52ECF7BCFCF554D9D4ECD95EBFBEF722B3E2C143AB00AB51F95DB59BE0F7AB8DD6B02565254001518FD11C569454202A308A61414A3B5AA00559694C74E3EDBAF8D79CEEE454FAED304CDE1A88BECEBAA480ED06B77BCB0B98167D462894173DB51638BD469652FB8C1DBBB324CE0410E14C9BC459A0AE640E2222A9E1E8BCC76592ABAFDBE3ED211A9B91EC3F258E8E7C6821DEFB7EA2AA8B2AB7E2DD7E4C8ED9F57E6F7AEDB60B7745099A4BF34A4FA10BB89E2643DEE8F53F5D884A1AB8A237901CC1B994BEBFFAC1C38733C6F000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000201000201000400031100A7BBDA72E68A4018B176DE3BAE993266031100A1C21100CAA111D28B020090270750C4170D3136303931333033333832355A300D06092A864886F70D01010405000381810088E65A36491AE19899F5CE49344FE02111F9547406118C333418EB6BE83DDCEC4E5FDD5FF44E452380E64AB9F866E664FC927BDF5CD34824809FC9F4052E43AC5095FF6F8899B7331FEAC42DED34B8B2B4059A434E8959562037A9224A35A24804ABA984617C2A4759351FF1B2EFC2FD9A80DE665995692C192A1C846720F97F');
INSERT INTO `sa_debtor_finger` VALUES ('16', '0', '48', '3', '30820776308206DF048206A6308206A23034302F0201030201020410BBC780F0CB54415BAC5AAFBDA29ED8B60410479D6AD1B9A811D2A7A70040339F131702030200000201010482066000F88E01C82AE3735CD7513E4AADEF87298286EDC28AE682EC43AA7FB805FA56F8D5C73949380A054797D0018BCA40BCCF0D360F017CC1DEF4F7DB4D59768DB6DDC76D90AE7EF6BE832D829A7FD822F921DB29B80AA1D2CC266CEE2C8CE22E78AD97397CAC97CCD31059C84CA9998F9324158E9186A675E5389B072742E82910BC987553992A0400247EAA376A5CB83243327C46D2F4E7A9BFC5CA19B5CA5F44D38106135F79DA13E778F5382A72AAE26EEDDA8659656B34AE8B846F50C804F5DC9372328E4AA8FC920E7F58DF921CB5B19E66E319DC27F1B5AFA5DCB2F5526C7577637A080D6CA20A158E5843BAC0F3FFC489E9EAFFE0C8FB9B8370952EBE9DA9A125730ED559290770D60D3693EAF5C71677965B50559374FF84E7EAA97F77DDC19EEF850B4EC1476EC484D68AE19B8486D1A7032F375A9AECA06437F20A5782DB0E748125C3A32753B487CED87F5723D4E87E1BEAE54303080A3508563DE59DA3A825DE6E701C92D05BCCF3510ED3359EE143278F03B9F664E3C9BBA1165CA793098BA4D4F287E6CC772378C3E6E05D406F00F89301C82AE3735CD7513C1A9478170A5E2BCCF2E501D4FEE76D07C76D376B63A7ACFDD158627E4B8CEFCC77E907055F6E2B9DFF69E3A13AF7FCEEB848057ED5E4CABC1BA6EB06E450F96A267F6EADA6C5CF3EC45D4C22CE3711A2ADBBCB557114FE1E5EAB7C2D9CCC75C74865285D36A3F95309712FFB9BEA1706C180FCC7FA1B5DB9783D04D14B7F22AEFB6977D58412DC5D20CFF94B1E1C8878BEE6724C9AC231E40062E19FC76D998D1F31495E9835F3C4DDB1B3AA88545EF600A1FC981997B2384F49374286F3554179E454F904549E6DE3F699DB9ECC3A546774A60A23F3398BD77228047C8DAAB6332F966EE2E3CDA0438EA020B1B4D2C26305F40951C8F0C394160B6A6A09D16F7977CE089C024E06C4651BF100E63E2B7B0ADDC7EDD8BA374FECF850D9AABE9FF6C96224BF5F2F3BBA4C8076F0235ECC25CE87C8B81F67D868FF73C84C99EE16492C3A7260E09CF0CB52DF41169FDE8C67FC41DCB49945A4A3F8B7724EE665F0766B2364AE85ADCB94E5CF762D3E86510DA7C35858B34523C3E9656655079009E9E945CEC0CA4EFBF857006F00F86C01C82AE3735CBA5F17CDA1F1ECA36022D2815EC0999B1F98C247A03841E2330D358A39B073B4BEBBDCF8F4D1867A6D4BF2322CAD75C7617B081A92441B41D74B0A8F23C2A4C8222E3CA38FDBDCC3755BAB3ABF5DF5A96B44C003A8A52B0DFE6D74F7B139EAFD96A55D101A71FF33304C38874E8EF04CC12B8344421EFB5355D9E83C51778F27A69B3ADDFD3C2022ED5F1A96BC42C448E92AF917F1E43BEDE3AD69C7EEA4DE9B929EC383757297217379CED5730CF7D1D26D1143F8205D52A73254A8E68EBA3EA6750D59DE24F2023B6190EC7C9760F26E872094AC3ECC927D3D6308A169732ECAF8904A1A6F13DB766998D98E0CA4AC43D1B634B8BC6FF7EBDF9AAF598739ABC70595C64753B3FEC718C001D4E1340FA41BA6D9E4C0F45B5B156F6C9A1DF67203181962C4AF664076C3224E4972F2EB87143BFC3EF793D9B78BC1DADB3B4B0568D8498304C6DE70BA6E276AA5EA50C4BDF4B1A8735652263A09115A174D16B86E08D2D7ED2A526F00E87801C82AE3735CD5513886F45C29E420984694B4E1F0B767835366044DE1C84D974613BDE29EAADD05605D445DE2961E608633CF6F42F0BD126E856A739009BED2DB61FE4E56EC1AA7EAA67E10654D47CF3B81C5207BB688644D5A5F96E70F0F179FFA26DC03477800D45E7067C425C302609D8086D269ACCF1CB6F242A94FD0382809A30187C5AD0F997EF91330886E222304455402F2C85331F52C0CF3D728E7BD25BE75E886D63E73C2C540B0CB3D4B2B252AFAACABF4D330E0796AC21E89332D3932B432FA0C5688883FCAEF091E9344A3D0C3D7C1FF4866CE1BA4D1AE12ABB14A977644970DD6DDD38CE75DD2345767B5E9292466188D324418CDF43CBD6A11FE86898E97E4AD999D5BA9DDB557ED10387BA998C10782DFE83EC85DEF744049E4F983DF527ABFECFB9AFD82F403CBA99362997D68DA3F3D3A6CEEE61DDA984AF9CE3660F01819C27573F04401655E630B731A25160A026A6ABD9A00CC9582A548F21F829296B5D23F8454410B57E3C5E5D3F1A96FD0766F6F00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000201000201000400031100A7BBDA72E68A4018B176DE3BAE993266031100A1C21100CAA111D28B020090270750C4170D3136303931333033333834375A300D06092A864886F70D0101040500038181000DF0D7A66876AE8CD54E5491DEF9EA9B6882A25D6D8A32ECB199EBBD57558CBA2962B59AAFEDDC7592565BFDC01D5D0F9BDF005DECB876AA99479654A0B6811C637220CD97AD047BEEBB0A87F305C15044414D21B56D7A13AB792DF3F82DBD7435A12395E4A1174F95BCA82A689E2B70B7DA7A2E1277D593FEA7F3384357F7B5');
INSERT INTO `sa_debtor_finger` VALUES ('18', '0', '28', '3', '30820776308206DF048206A6308206A23034302F0201030201020410AFE746C1CFF54EC8BCA39D7168AC6C7B0410479D6AD1B9A811D2A7A70040339F131702030200000201010482066000F87701C82AE3735CBD511F7A30FBDDA0CC10B1532C0C2B8D668D98861DB5261BCD7962EDCE70365EB1FF509FAFBC8F70BCB451CC2F46353EEB3ABCBE792F726F67F9673B4F38DEFB92701C663575FF7D02CEF1D2FF37F6910BB9D5F03605E663D8007BF479DCF77A35C3FCB7BF89836108402F739F4FA0201D31E64EC547F267AE6602E232AC14D7EC22BE81A9FBDF38F6046F0D0D6B7D0ADF65CC14FE5A4F84D2A15371039B94AA6DE800EDC0BE52E96B01677CB1EFE5BE41388DFC8EB4949CC6D7185D57819E0CEE5B6201D3206D7F3C78A76E93B4ABACD3EEB04BE941DC2EB59D5B09F9F469CA2A4D00B335CA6CBD07424160486F863A0DED316237C167895FF08DE8084FC6711E62B5C64CC7EA2D668F56793B7FA9D80C00C287F83038B97DD404956C0D4AD84EE16C9A5CA6DF78B094D8CF19C36A158FCC82C713169BCE805A8583B3342AED96EF4B6BA65277CA30A5BEFC222D5A9E1A233F4C55E4D29A8DE65D7E97EC7AA6D2E104187460E012FCF317E774B6B20E51FF6F00F86501C82AE3735C8A5F0E2520548809D920D5E4F9BBE1CE302301CBB999856355C9AB906C345A58E8F4C09373604D7F9064CF91482DA782053A21044577A9A8AA6E080275720C542424BB94C06807CA715873505868DCEA9A56D3600B588933BA5073EDF79C9C56823B73D33AD3D38E3B94D3FDD25A2C9459C7033ADEAB1C2164912D4610337DAD13F2A80DD3C50C5BF628410CBEADC98CAFE7C8F584BD5C189181C235D8AE43BA93F51CF2A54D3E9A69E14C175849F388CAC564E2DB7ADE43997D9CA332EE9CC81BC54557D44AA1F33A7E4401E079868CC32F8CC727EF223D9B0393F3674262C61F056DE3B059C61EA0F762FC3D50A90E014E9FF76D03F13DA18E95B45816F7010F1709AFD94A0B1BC5146A523CF417C1BF23DCED7762916B8E8643F62A48AFDD8C01201D9FABC4A7C6C5A2F06532DA1BC19D1CE103C2EAAE8966B4B408937C14456ED24D632F283ACDD2963AD059EE5283F7AFDB6B5AFC3E4DB1FD7E256F48986F00F86A01C82AE3735CB15314E72A9E4785663D85F5BBEB2657D462A33008B3F33CBAA864BE20BA8D3BD4FA1EAAADD41639E0D79CA619497745ABFA73F85691CA1CAAD2F5FCB1C3640C42A11A8CDA302400F2BE344BAFA4CC75A2D8B768F49B1433EA5560A0E030F31251B7C06273662AA0A298C974F856C37FB7B2C8AB00EE4BCFF6BEB9762B459EB74AFA5D936E125B3EEE2FDCE7F27E0E9F563396B3D6CA7C355CB71B6CFB89102E03F5D591704BA63CFED4202D3F51D27CC97788C4F4BE373ACA4F7E10FB4C2EC0FCE4FBF4A7C32AE0DAA2A9C481EBD28234F0609C9DF37299E8233D1EDBC7F269A892E9634A704EC37900F973E6FDEA9C98021927782D753F3C6B77453E8AD8602183CFDBD1EB0A583F9ACDDCAB96A546843CB80A0D86725F9ACC1A8C9EF45B34D49628A6343BD3947312BF94ADAEFEF0A2D7DF3442C879CFDB79D87EFA141F99E100F6CC634D61EEF0F48138775B43D3DB1C04B8395B56ECF63525DF5B64CAF7E16540E3276F00E87501C82AE3735CA75018179C93EBBEE6DFD6C61FECEC9D988ED08B7C6150460947D60ABC97EE4CF24351F8DE85251AAD2E6CADBC2CFD2A1660D5F9E7B73525A8E5D0AD6A8CE105235EB4E97F0124A6A5EE572EFC71A18271EC36BC5F33E85C10B472D6E86270B458FF092B28D703A4D906D68C0D2101E190F3ACB8ACB39391184C999F9517EC26D471073922FF73E747C1602CBCD356844E0FD4E7E3067D1D64C846190DE49B0C8BDF3C64D9912D77C68235BEC2E7E3E77B83A3F7D9AA5BABF2FF371F86D80C6742E3B430DEC1213341AE52A2D66F06A7F71A23149DC67B89EEB3FE658CD756171D5FE0F8876CF83E96A81E74F0CA1444B07021AE19FF9853439F6B344CFD2239F747F590EA248475E97C19A5316154AC5185E2B1FB0B552BA13F83D5DE0EA85C5E0D5FC5FC843DEDB624C784268D2AE9D31E26811C96E5BAC9A5345F262F06B424A7322F4D246E1BE8BCA85516E2989E5A495FE145BE18ABC103799A85BAA38B8086891F4B4A56B78BA6F62DD4CACD9E6F000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000201000201000400031100A7BBDA72E68A4018B176DE3BAE993266031100A1C21100CAA111D28B020090270750C4170D3136303931333038313534395A300D06092A864886F70D01010405000381810052DE4E289568437DE56159D27D558AD659D87F36AA841089398E3DE5143FF9E1C6148022D7422826648F9F1F1DF0063753128688DF539B77E99E8C66D9A6A6B264A83C4C352FC4AAB2F6E6AEFF2A1A76AE9786073BEAF716E8EBB7180F94C02E9F64C1A469DBF38D8032096B152CFA5A5ED983AE1AA2384AFAF7D14EB4A9C677');
INSERT INTO `sa_debtor_finger` VALUES ('19', '0', '43', '6', '30820776308206DF048206A6308206A23034302F02010302010204108769474E39DF4D498674FBCCA71F15E60410479D6AD1B9A811D2A7A70040339F131702030200000201010482066000F85901C82AE3735CD85810F7C2D35E9E7D8141089241E21F83F5B3C79265B55EB20D799641027BF90EAAF3AA07C0B8996A15F3A97B44DFE7224E17FA9AE84C0B84BAAB1C6BBF05B85FD78CE1C65FDCB6F88B09ED98E5EF5E2EA6649FD60FF833FD064C0EC1DB7546B6169F02CF6A369BF2811B4FE21695105DFFD54F19B33B1432F12FF0B5A355A6DF5623D6AE36FFD3F4B043697075C542E6A9813530EF8847648F386813A3F026D3B57E28AE09380D0D8FFA9F42556E979153F80307F0415E74D93C1AF6E89335058376C5B6975C0519627444DEB35BBE4A866F82C34EA7FAC62385DB405CD1A9DCC3B9631529C39CE69DC6ABE539FB25DE68CD1EAE237C56BC391D9330365058BF90338317D23C949844ADF7F7F2ED9E4F7E170B9FF15446311C40B8CB284A59D1CD7BD3694BF46813E83707451FA7838BD028BB3D1C22B7F198181C7BB82121131865080268F7F050B67C5873B3BFACBBA3D7986F00F82B01C82AE3735CBA58179711197AF252B2E6315B675C42FBE0723A4EF45F8D873BB483308A2FFDC55CEB757CC044BEE418937F9A6BFF64F534130BD51D2565CE85EA1A86E5DE4BE4E590DE286B7EB209308D8BE9CBE3B90AC6861FED6CE0204D50CEB92AFB946FC2917D825EE8C23D25CD354AC4CD73C53A1925E1C38F1240ABBC1E81689C3CDFEDBD63536E63C64E88DCEB0E391300AC7278896961A169EA71E53434C2BFF5AAFCE37F85F394CCA7402056F3405F658652E7B721D3B51544173F5BEB8FA0B0A4B29601EBE5BB45698D646ED3343733F5450DD2118373A3862796FDB67E5BCA092A8846068759CE687C3A9ACD08B1D8017D6ADB27F418124212733D9EFDDD9493CA8D64E1A22403C87AD082C897DC9CAFA59F903FE0141DB131F2A949A92785E99DB0B0E36A0F6F00F83D01C82AE3735CD0581F1FE8EB873459591C2889C5D5515BFF4939B5ACABF60292D30F5DA8148595B838C62A577B918FAA8D0D2BD17F2C64F4A6D88C57FB0B40A1D130A6EA25850FE87197122ECAEF45735020B5FCD891267BA404592EDD3F15221FC1EDDC7D2361FDC58AC216E402EA0B1ED0858EAB828AA847C99D7BCA0B96EBBD111C1CA3E2364B1896FB7BC259887A66F401BE2FC2E279AE7E502CBCFAA9097900943B608AC4CCEDC9E322F5554BAD9A7A31FD47AEEB33FEA6D4D0BA3B92BE6C95625917DEC8F37AB70A7499012345DF29DF73BA3EB3931BF8C1D4658E46340AA3186ABD5B8CEFFE47895F9EC982EA5427B4A2A4CF272C84DF7726A492C767E60A2CBA9D906F7FCB2B16F737623A50C02165BBFB8D96ED6C2C2AA18A03660F2D3806563D2D4EEA9D00C9FBBE441926552F4973F7AC4CA240E0ED099E596F00E81201C82AE3735C8A5A05CB57EE0408161168B19C6675CB2003CF6C542C6D85676A40E34041FC9F84EAF71707AEF0088EECD57CE257EBCE1837C0D63D7D18AF1E1F434F7E6FF826B8F0ECBE1600BDF73C3CADF9E904583A6A81DC909D9E165E93862003D03F5E70C29A73996E57F565F5D5EDD389CDF4E1E2FE16A53AC84E03A70A7FFF4F55349760BEE6ABCBF038F3ECAD0783F08E57A69E808DEE73D2238E276B968C41476DECD720A6C9E81FCA9DB916F22845908B3B9CD43A91298A13B9DE78288FC85D762AD7610B4438F39C7F6DABEF91B2782BC26EFBAC995851933D5195CE2CF42C3B60ABE6DC77C340F36175A44D092EC8691F5D5C4CF603C4727C530C454B434CFF4A5A040DC6FB0E8035AF703D91E66F00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000201000201000400031100A7BBDA72E68A4018B176DE3BAE993266031100A1C21100CAA111D28B020090270750C4170D3136303931333038323235315A300D06092A864886F70D010104050003818100396A0FBB814AC6C9D8F4F7BE95D47DF3759F41B68EB6DBD5F94BB65AAFA152937C1E09B058B6E4EB524A27B8E7D4B5819EA05DBF6D818195D8012F885B433B07B6260ECFA6C10CEFD8CD8AB6D03193766E7A29DF5A9A2CB74A24A87AAF72659916030ADCF0B735B8B9AD39E0FBEE5C093FD15D4D8690AD5686820CA8624039B7');
INSERT INTO `sa_debtor_finger` VALUES ('20', '0', '43', '3', '30820776308206DF048206A6308206A23034302F02010302010204103E41C5799CD34972B0F2353803A923A10410479D6AD1B9A811D2A7A70040339F131702030200000201010482066000F80C01C82AE3735CD75E184C9B6F9E3ED35590CFE444215D68EA2B5D0459C1250521373B25EDD6E1F15DDF7DDB78CCB8B879028C7E325C9D6620363CFD550A1BFC73C3FCFA5148F0CDA4F98ABD0961EB64F9C6FF322D29B99A5D5B0CDAF4B7442F2CF49F6BE43EA294F64EC4B378125D73872DAA141BE0DFBAD547AA0D19FDE4921AD939A7E23DEC38FE343C8975602B871A9AB690AE7790B2AF51F847CE1CD807DF634321875525D93301F9169194C47D2B5758C78D8BE2B7AA608FD1B23B1B37ABD4A398E6C4F0F0F7A96D370BAEA5EA1862A99DB78EDEF97E6631D0B863B5B65F765956572B224AE4C3D0099FD5801AF84F340AE672CE4E8732CF4E128B39F6869015F8D6EBCCC058BD099996386F00F82D01C82AE3735CCA5B2A843729C1928242438B3BC50218389D2A918BF291E19C3326215597C4A4B9FDA99120FD515A4353682AF6DF262489D68A2335A0D4E969C663AEFF042D5FFD34DBD22BAF5DE7F31F43830BC6FBEE2EF532255C3A42113AD5C9A15B044ABA4F9FD563091CB79F7D47661A4B8EAAE4F31775569C440137128B3EA8E66FE15CE90C9FEF58E164606EDCCBC68DAC261650734DF81E4D8AC47F92B4E5C4772C9A4AB620AF725BA2AA0948D4A2274B0C094FF6F995CB156EFEFDE339BF597920E4CD74B607AEFF26345DA229323D0CD7F205F451B992230AAC629D7A0C581ED501F9812E8E015B65C49B04AA185C77502EE36F11132D53F10B6F51709616FCED15A179A5CA9BD0807CF4CA64E191E113DF230369006A8F29D0ABBB7E404E44BE6E14A1B8B48898115C6F00F82D01C82AE3735CCC5C197CC90B90B8192905F9626B96E578D3AB641904A76CDFF4183375506D253B099BE4B601F561F5AA11A28EA7E37471364DA5489E08CD7DF7C4CC4DB50BF3915388EBADE9C45B2755C5BDE137F6665028263AEC74893A97432DDBAB4809D343C3ED0304BEA06AA4958C7019B87CE93DB29E2707305B4CE57650A96F37E13AD04A9CA35544747E1B26569E8ED8FC367B25FFDAE412E04BC0573BE388FF1E1DAEB84C688AE1A396DEE7CFCFED7FCE98A1892AE879C9DBF3B98E4865560D9FBF6B454A069462601CFAAE32EBFA2A667C389D297CB6C5F4B56407DE1E7DCA5488019A7C0953BC16E11D7EAB57D75F3643267425CC2DDD6A1B1816A9CD3C2C7E17FFFE67DFC6FB7A3CFFA80562BD17EF46A4EB947E629B18DBB0AED31EEE9D87679517FA9EA22F5EDD6F00E8FD00C82AE3735CD65D0DFE954CC5884E737E7A44509C37CF02F46B3A98CE897A771E14CF08D156F0EEA96AD5466CEBF8A5C181BB59F17B3897D92185DA34B9C760F205655679A7B0940914829CBBEC53DB57A233D0896E5394D2F5C383C363DBC4A14500BFEFFDEC45D9605CE02E596A6C458BC61E12F6E125731FA1D5F4D34E540A67410EB063EE259049281D3D9AF872A53C03F30927B9D3482F667E54CA18882B635286F44F9B81AB44DA85FA2FE4951F7B0E16DF07D149B48DAA59D25F1E4DFC6AA7F4A1F7CC15159BA6C1912F4643CC5FA14900E626536DDC4533DA65A3CBD16B0DE074DFBD31BEEF77E291B025F1F5BF7882C76DAA8C992B0D558CED6F0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000201000201000400031100A7BBDA72E68A4018B176DE3BAE993266031100A1C21100CAA111D28B020090270750C4170D3136303931333038323331315A300D06092A864886F70D0101040500038181001D66656AC9ABBC5BDADC5E5323511D26199A52527B6DE5F3F9EC027E56DADEFEFF21EBD2D9CE515FDF02F92D0AEECFB771BBCC78DCD06696D7465665DAF1BBC5A103770F11E6BDE252CDD584FB65D25C2209FC7CD310B95528997805C30E7173349E8911AD5D2DA0A6FEB537A6C63B36621CE2CA26A8D12CB7A4858F4725E3B1');
INSERT INTO `sa_debtor_finger` VALUES ('21', '0', '17', '6', '30820776308206DF048206A6308206A23034302F0201030201020410DF294E638B8D406F8FDB83D7D1A8B8830410479D6AD1B9A811D2A7A70040339F131702030200000201010482066000F84C01C82AE3735CA25612439DB402BDE3BAF93CD338F794BD163AACC0CC8F920BF03569BA3BB91E042C657D52A4FA9E653B603F701924A48E649BB4C73AA3B0063E11674EF64876A7993E8270FA92C5DB18B437B9A124F8F6B64217B313F41C932FDD6276450B589660A5F49BC363E401E82134A9444E80DE9D3416461047F33E621C69ED5773E534196B5E194B6ABBE2D31830308A1FDE23D4DF32DADEA70498ACF29B688A90F0C90553069329DAB213F9513086A7285E27DE7F66A83ABB2FD5DF4862FE294105D83B47B2041D41076FE3CAE878CF66CC8C1B120CA4CE5D063786E79F37A10EEDC0BFEA545EB89F3C9A7A45C97DDEDA081E67BE29034D5F2B6E86AD0F076C80F4F806BEAA7991F91D343D21184E39DDFE30DCA9038A6E21BC18C88203308AA8F05110CA6ABF6AEB0E97AE0D1F063AE1404AA2DE3B26033AD3840FAF73EA87D4E709E2B52FDC2C0B6F00F83A01C82AE3735CB3561B9C2EFF049D8DB15D31208D4F4553ECDAB108D0B8AFC4B819DA82A84E0C9D9E7617E7E7543EA2FE733A1EB57C40969C22027466D1DD0A10F940F0FE47BF13979BEEF938DC054309E95B144D9BA3BF5BA7301BFF76FAE439B317D35C62F8F49ECDDE4C11E7A42B5DCA3A5947632B2BABE1F723D1B9DD2308802E8D1A40BF0828246032102FDA11E4D8696CD7CE09897F5004F8C618D54E585DDED551224D1BE29B99DD737A949282D5125E3D5A65AF2CF800F114AA4495FDD121BDCA7C1DB4CFFAD1FC7BE7E80D703A3245DAA6753C8D2D94A0ED1CF22EA5095EF299B6F3A971ACEB30C95C7CAB2AB230C56961877E374047ABEE75407A44FEF1C7E4CD491B4454B26E5C318229ACAE25ABB26873FF03D5811100533E2AC3E87A7041D2F2FAB7450F1ECE3AB353A564C1E4E475BBB533074E276F00F83901C82AE3735CB15418E6835676BCDF54B0D6EB94CE0512A7AE34E65AB33CDF4C2436BA94F9B958C6CC68AFFFCC767AE8C0F62B5B57BC9CEAF6BC4B200679995BD940A77B47F93278EA2D8AA39300BCFF856E6AC04A8BA571B0E9622CB82B7D2156FD19E5EC4DDDAB39171721A06FCFADFE02CC93353A87B3CED90FEA64CD661E754B9EE6232C976FF5736615452AE5BA3464CBD5A3CD834B8223A626C59322ACD7553DD86BB5821E6FEAA34582CD5DCD39C9AD50D945CE1F7201F8D5B7FFDD88AA4EA638F399DA94537B147D1340BF7131BE6C510F023E6A4246DC6D3ECD0CB58E9023EF415883941C2D1B03C58E922321DF934CA1759E5E88826A3847ABE5A6D2638C655F40B389121FA3466E0D2F9326AAC47AA6FF933EF6996C510B9D8CA27CD64CA30B9325C1F4AC437CBCAE40409C2A25AF46E3CB7B0C456F00E83801C82AE3735CB35517DF1159DCF248F1961B96D1F2BE0706AA7BAC7425D2A98AF383E95B29C87E742474708566DB09D3B285054A1899C589E2AF45FC2055CF5CA023AF9496E2A4A93730988B6CC60E4AD4F4CD2D751F16ADCB945A60C67A4F76C4BFE7C04E1A9533503E8E04D61BC3F59DD98680B55D76A495503BD4C1F84FE50C30157E0F019153F7FBCF06FF855A4B5E92F7D08007D3F496C4F99A2CE58F488292E1399CF7CA36628D7D1714201D26B1AD7F66E0D3D2D230646AB1B6E28890AD5FDC1FF9F0ECCCB9E65E50F528273DCE4F33BD0CD6934EA499EF3431A0A093B11DC9DA69C4FD5DA04EA267EFC870FE210A48EBB092D55DB398E452B34F019DC17C8BAC80C852FA888FC99AE647F9DB7D84221AF30A0CB75DA18CBE4ECAFAAE2B677B16DC241AAB1C0565AC089F7A1D3C4011AC152EC5A1C26F00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000201000201000400031100A7BBDA72E68A4018B176DE3BAE993266031100A1C21100CAA111D28B020090270750C4170D3136303931333038323931335A300D06092A864886F70D010104050003818100019D7C10D5AD35683EA6F67B79833384B6B8DBDF86F7F26685C42EF6B8305991567544F69FFE0BCF1EAAF95785F4F1F2F29EA3088A87809966902E735B4139DBA4C90DAD36D8356EF4023C0180D5BB37EE1D348423AABB33551CCD35244E659C6D8518A1F32F6F4F04DA1D869BACA2CD33429DA0652829E5C92EFC9E5AD39121');
INSERT INTO `sa_debtor_finger` VALUES ('22', '0', '17', '3', '30820776308206DF048206A6308206A23034302F020103020102041091F37E3F22BE4E8DAE580302374B26B10410479D6AD1B9A811D2A7A70040339F131702030200000201010482066000F86801C82AE3735CA349224138E70583A38A356B7C0E6C243997EFA340052378BBFB232307FF6C29B88F08D736193F0B334D38276E1EA4766302B337FA32638F9DE01848A91161F206772A02EAABE0B914A97288E8AFE48CE7D8551C62270ED83261E70F2BF08AD65B4E7D13F386F2437349ADB6570A585C0E3600C4D36AE8D821F5402B37E4E45C640FA30CF6A3519DF8EF535148B2D43BD9C9637F0656CDD4B0344AEA418EFFF796D0741DDBE44D780E58B89D682547169B6AC9A353960BC5ACC773098DAB708DCED6B614D9C50CAEF35D85BA7CDE8954E6708F78A9941F90F5EFCEE44CC330FBDB34A9F8ECA03BA2EC1AC6C3B13C266B3D03EB2CABBCC03B65396CACA3809C98AFE1AACFDDD0717DEC33424B648B0BD3FFB8F0C1F7318DBA3AF290FAED11C7F8018119A303F4D6C027F2FD360DF800E364EF9654E6F3920D90ED887B7136F7612FE7DBBD5DE4C798BD0EED5E7FDDD5E3A99FD2014CD32F31A9B748DA182495A3EDCBC56F00F87101C82AE3735CD04924B36233C3F7F601627E6824E36FB81FCDC901A01305398B97DA158936026903EE92B31C955D64EECBEA3B0866F68E918E264C7CD14BD2EB168B781E9BABD3E98B7A6F831EC82B9E5C83B8B1398B2C68403400D18646FB61EDFBA9DE6E086EDE056E67A644EDA294AAEEBB313DF886B2A47129DAFC94B4AE8946110D7C9146503236090935C90A80B8B0F0FE8E4A6BC056847839ABE5BA52673DBD4CC0C9149A2E1E15008BD060EA61D993D3AC1D91D85A939F8DA3EAE394AF38B3A6F85F393C0048CF0D4606A7EF6113928E97E9C575B991D3BEB066480819AFB5048EDA48CADCBD6D52F39C5234296CCFE7D2C2096897E0A5CC0E7E4D7749721CE9A00A429116798F676A669C9E4B7DBAE0EE8080751B0422689636786F6AEFB1801DB638DFF7110407C607E62CDACA085E5F530B43EA22C27F5626DCA3AB20A8E5FFBC90C71DC308C3EAE4D3802380FE8C2FFB319A3020D0CD72ABCDCAB5A52F21643CF78FF45F83AA065882F300C06F00F84901C82AE3735CA74D2F09403E0E639AB6E54193178D085447AE2392FF01B75EBB58CB76C4CB9D346441C31FE67E44B09AB4800F562BADDD84DA303E38315A3F02FFA550AFF8A00FE62952B01C8AF7A0030F3F89D193F07254C6C7D177117B683832E3350F46D0CBB5BE34935C12CE60FC6E24F63E51CEAD5EF8497F2854D48A3D1EE4B96306A2AEE35293AEA164FD1A9B6613B3FC2DEB81D9896414C9F535D79F636A8512E870EAA6A34E7E5EA3ACE464636D345603D8621EF395E36D531DFAD2095882CC1B08A5337F44E9D2C28F6E9FFE95FDE03A277507158161C896173BE150D8344486AFCA9BD1295E8931F155447100BCF34E3365EDFBA45E9B7E848DB0A264EF76EFFD583EBD7EF4FB7716570374BAD86467BA8923BF44DFAD66D594B06CA1D75216572BA54363FAAB222931EA80E5AFF376DD5A5AB2B4B52AC009DFCC1521772D67A7A190F7806F00E84D01C82AE3735CA84B23BE022D5AEBE560B3C96C357B478DEB33AA6F20FF7E4CA2290518761633F308E5FCB5147DE2A9FEFCE9301D7749A918035959F10C139AD056C8E48AEB2B2BEFE78458705981E8C7102B84EB64ABD50FECECA6FD80E02BD31B489E9F8A5C7004EB31EE14CE7D2622907DF322850B9596839CDAC0C15A05A779F8EC85AAF5B1E4674072DA9F9D1424666B9173D38B0957E9227C19256A4AF2567719907796DE620E4064294893A763779B903A5B487C614B201A66CE1FC0185F39AB87B63F3C4C8D344ABFBFE2BE9E98D1A3A262AC37B9E8C1F42496CF4A24EDC2E483B8106F9B75795089E8318C02C8D4C5A678CDA79023BF1DFAE5834E12F26BEF90C57155D1B3A36F0A8626F93E62A30CCE9E33796A723ACB9CAE8277B1D87FC51CA66EDA3BA69834CC7E0E715D7C66EF7B5D0232C9B28BAF1A4A70EB620E38639017528135177E872199C46F00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000201000201000400031100A7BBDA72E68A4018B176DE3BAE993266031100A1C21100CAA111D28B020090270750C4170D3136303931333038323933305A300D06092A864886F70D010104050003818100587DA99A08573C20FEA4DCA52915C59813CEBC32FDAC73FD1E6244AE66AFC95CA25246905CA325A853DE3AB0BD43BD303A7B8AD05EA4A878EC2BCDE3D983F7CA78C59086055D3DF22E05E7F816862BB024BA6A01CD976CAA1D154485C806498E8D27A439F156438CB5ADF06D5903AE23FF42B661859A84F4F9C08F00931B17F0');
INSERT INTO `sa_debtor_finger` VALUES ('23', '0', '26', '6', '30820776308206DF048206A6308206A23034302F0201030201020410E7A96EC14BC649EAA1A0EE4D821F85CC0410479D6AD1B9A811D2A7A70040339F131702030200000201010482066000F83901C82AE3735CA65E21F6244FD5AEFE25B2BD786649CD3C356BE3B4F85E76B13842C7E0C09C31A320912997C727B9AA3EEE40071340E356A703D5E4857170CAACBA028C1312B0892065F23A227D4EABA40078D3B397E9F491CC970952ECBF4CD0CCB36962A1F53A2E3C813EEA5A17512113B0726268A34447D27590DBE6A924EAE1EB995FBE4DFE10BB5FEE54BF4798BD56E9A64AB5BE5D7517F885E0186CCCD545B21619670A18604FF1520FDA02D6008C956C3C1A77B993159985880F69D758FD87429CA670A5745EAD5CDCF322B909F7178BC2DC551FF436E16C996F3D8D86A6879C8C8093A933F287B32F5ADCBA777655FD3B06431AD06E4FD0FC7756D4F95C8048CFDDE035EBE2AB39033A36821988D7E1EF86682770C1F519A784956EA04743D3FA636C7A88532CFFF93AD4BC476C664A2D51950B37024C6F00F83F01C82AE3735CAC5E229D86020557570EC77FF6862AE24F117A723959628299D762E59586E6FF15E82512E47612AF56653E041C7EECD891D37AE3CE3236D75435D1797447EE845AB073A1742D69A088EAAE3E26D941B10CA1FBDB5C8DF1FBE9926C51BA5E43D357983BBD0ADB0D7D14447964E123EB037290D36D270A2E37CE5F44B3AA05D96C396D9B810DCB78B74C2DFFB9F67C2060E591744EFBA7D0FD7621079444BF72FCC040123A75B4B2CE6034D7855351375189DF38DF07E558952CF0C59CC24024EAC8283999AE3E2546344BB6E5A56CA53CAD9FE6A93C3A49C5D927952069E65D4925568B42E1100D2A5A6BF3DCA69B2BB7093F11F56CC46C43A45C0916DF8B543CF2D54CF7C568A049258AA800C74A449056688917233AE5B9B8F3132D0BD31CF1F133F277325E842643B75A43E6C431E385AB0F860BD8E6DF39856F00F83B01C82AE3735CB651208AAE57235DDB4421038911E8171D3AACE43FB47C740DE93A1CF685F4B6B8F192F3FF699D4EBADB274B2FC035EAA2A9EF5D05D8209047EC6BC710C1E7EDAEBF1F544C865FCFC2F4E6E626139BA3532C6CB8B935574E8328DF34B1E7360E23756EA9C341C378D288422FE3770D5A46CEE45E1F0CC609C7A42881C91A9B5698218594A50A9ECB1FA2CD66C3987C923AA1EF7DEEE23422323210FC39CEF11DB347D1525BEB48B783322F96082E5BEC068400F99B31CBD33D4409E648AD38EEF81CD59F363997CA7BB25757590834F1BF4C947F34457A99A1E6970876D6D3F12CA8577B9C92869D30CCDC699C9ADC7D4220D0AB9F3AD466CFDC489B0C41F2C65E23B09C406CD90DB1E317C30AC8D8F0B887FE1AFE8F4D17F6497C229F42B204EC22732EEC2DC13C7D1A8E6355B872488F648DB4743C6F00E82C01C82AE3735C8E5F2E1E4A878CE00BA3A9B3309CF21FBD9CCBFC1109AF3147930772AEB18282B495E9453B4F1DD3BC17C6331882E1C49D4752E5E997654F6228986E76D8B60D8A82D39A13E10BEA328B92310B8A39BEC24FEE85667C824BA8613D8D15D81777F832A4C4D8810086A30774EF74F3AAB9CDD7ECF6144CD3C8D4B194B5C8DCB468E8844FE4C4183E56D24ADDB9828EBD06D3F321E762A0E29C619D690B475C390BE921350224996008D8D76F20FA26845667439FE995F22046B2F7641E61D47D27DF87850F3E1DCB1829B598D0776FAB631298D91D9FF48A94E25D4EA4C63EE9D42ADA00A24A386232F2643C79D93E451FC43404E38E185EE297FA2B0084865CAFCF23202CA515F3AA12969C01D2D95904D5DCAB600B817EAA7CEECAF3F46D2CF596165F3B07B4CF6F00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000201000201000400031100A7BBDA72E68A4018B176DE3BAE993266031100A1C21100CAA111D28B020090270750C4170D3136303931333038343731345A300D06092A864886F70D0101040500038181003C426C4E6EAD999F07F8B78A41AA49F7700A3463F330E1A242FC51A27D59A1E707CED8F5A72B9EC3355DC40F2903615880275A12A215CB8A7ED66BD18F65725E1A9D9C7E76F565F8A66521ED2B855753E49309AF4C5D095E9282C8CD9C937383BC104217E0D5D3278D1E39787BCFDD2A68EBE4BE9FF078E29C1A0888795AC16B');
INSERT INTO `sa_debtor_finger` VALUES ('24', '0', '26', '3', '30820776308206DF048206A6308206A23034302F0201030201020410C6C2023F38A2471198277717B9A4A1DA0410479D6AD1B9A811D2A7A70040339F131702030200000201010482066000F82D01C82AE3735CAD512A1C6DC1FF8616A2929B0161877BDA3BC509EEBF80DC3E3831D9671AE0A6916E887BE645411C0D3F461F029B23641772A8F0635B36247B68AB8E777F026130EAD1E3959DD398B615FEDDCC1A41948E9E6FF4359F64C54A1565B4872A887FB6D8295CBB22F598942544E47B7E3D94ED24E030BEB3A4AE85A3951FFE6841DDBCA44FB7DF2EFB66FC38056050B0E743613AB07F9D739C27EAC958BD2E5688FDA7422ACBEA44ADC32EA565B0611CD8D92F092E2AF900211B6332732902A0EA2A268C0D83AA549072BB26E6D1482603252007A89DC3133B359EC087570DAF53B4BBA1B735E11058BCF80BB04682DE869B4CB9E4A2CE786414CD57DD809D5F622B8BD3C1D133BD74F7BF01D45F38478F82D65FACDB35E75C77068B5E171547850EE3169F81E347139F6F00F81A01C82AE3735CB150298C4E8991DC404970F12C5B21E293983C4939E07A990B67112F2DCF9F43315F4F4C41BEE1651042EA005B1CD8948D07E3CEC7A2D21B97C61058AE39218A8C45FB46E53AC9CF770ACC212D2EBC7A710ABD687CFCDAA6A900CE1095EC272D8E361B0E2D5E76EC9CCE50690EA150B4F1CB009BD141AE1D9F6B51DD8899CE3837657F6EFAFEA1C446FDCA2DA3AAA08E40DB9A2576B9E2E78A596A29E67FF12A5FE76049C5DD719FFDF8D041358F5D83723D8FFF3612D40F455D1F1B452115605323EA72A887841207071CFC5BD8D4671942EBEEB10BD82F8A9F68A9E56161FAD4586310F3242586B6D294ED81D87744EB50A2898A1608EB0BE517B3554C3AB8CA707C60DFBDAC991EC8C82E5484D8F667EDC704E76F00F82601C82AE3735CAA5323F482C569E0673D1F27F35ED1FCE01382ED64DB0BDCCFC96B0203E1F101825CE56C44367DC26CD9DCBCEA740BF27368FE861554E02B79B3AFBC28DC8025EB770D939CF19CA10CC451FF20E0470F5630094318DB7DBA2D6118C7CB1F2D3FCD645D466CB7E22FF3BCCA53F485E33AB4FD2FF2F24E32D4C5B05C04EECAEA5DC468E90E872AFC1A98DA0A4D6112D59C28D67D77C710479602DE11E1A7A2D76FA73378429CC36ED4269BF071477206B30D0681CD8FAF1C9C95F1544FC3A029BB06A4989803C27858C617F8AF65F5F8002B225A6CDB51B705A1D8213FB85FB4B303DF138A705C85522E5963340823B3B3CE7C9916B8834A63470037EB93783A66E1EED4435BEB1CB548F76B6825E33D4CD2954D7F70964EFDD15888E3C76E1F3FDD6F00E82D01C82AE3735CDF52158998637AC8C510C24A95966409189B462B8EFA05B25C3694635C71BD9DB8BD1C8A6A2AACCFF3BF69CC726DB8FD4ED7A31EFF92C044D8B49BB0BC71D7A8033C6BE4B55AD5FCCDF91B5FD893210085A6F22C086DB101A946BBBA6C0DBA84DB05C2AA3B595FE64BAA3ADEFC81D080487F21F526399F4FFCB84893124C8CA9EA4EF616D3FC9578577C1BD1B0B9E84D2679581BCB018C437D1F2A20858F8E68473F7CEB812473A8E6D3234EB4AFE388028899D738BA4A90A70608DD20B89DF82FBE3EA297215FC9AC528A1038FF1EDF5FBC70FB01537F9FF7C73470E003C9F3422933B75357CA96B0AA2F2CEC750EA394248F38234A6723FF07D5A2972AF6F316FC55D3C26617DF826E424C3835EE8BC114F10AEA2184AA37B311980DFB7D92D302D7AF9D034B056F00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000201000201000400031100A7BBDA72E68A4018B176DE3BAE993266031100A1C21100CAA111D28B020090270750C4170D3136303931333038343732385A300D06092A864886F70D0101040500038181000A8040A55975F65B952D69D92DC8179E77DA6C2119C7693151D4F9C6C68F17DE87ABCE27863672A8F75BB46818E4BD81F2F3482978C0419A45595080F47EB6D9693D067A4B59472CDCA7A5BF2A7313161078711B43D4EA35337ED66E0C45BFC4B159007E8E01124E30C27CC9397298AEDBB615CFC14269EF4B5FF5D8352AF1F5');
INSERT INTO `sa_debtor_finger` VALUES ('25', '0', '30', '6', '30820776308206DF048206A6308206A23034302F0201030201020410B24692CEC0884A19B82CE18BD1126D5B0410479D6AD1B9A811D2A7A70040339F131702030200000201010482066000F84301C82AE3735C8D56239122B6151C9CE328A453F80AB3107F9E760657B54390B05961058A997EEAAE89AFCD88552F1E65A0635B4A98C76BDACA695EB0C9A99957A3833C5B5B5A2C6BE11EA3A77093AD2F9DF7568B1E5EC5EECFAFE5384B64A6792FC0C517F3F6BBF58E63DB2E6A8FF3571775631614FCB5A78B7BD5CCEF57EE8C6F7B3E6E6001B6FF3879C0B7D3BFEA56448ABE14973DCF8DB435CC563DCDB2B4A150EDE11FE3D7D652523A96272AB1F9985CF7BFA2BDF36CF3694054E21660674E87C124C8839B2E389BA6DE7AB607A79C04E9A91E31C7AA4DFDE8066371A06E74333EEB3B4AD57800D1C0FB07DB4946B22F0CF6E653145C6D3CA59CC2713DCD123C2402190EC77D5B6E1B367ED995A3E690DB42D776FC547BC84AA358EB33ECC44CAA4DA5C16989A1BDDCE478BE994412F61C84D9706C1955AF92CBA33575879B95086C6F00F83001C82AE3735C8E5425DBB4B791FD4FB2E5A623208E1A07AB986440F4C620A063DF4665418996451E255763C0BD93A3527BBE9900768AD2847A0F14C78DD1105890E30724880FCED10161000D875C6A9FFCC6CFEE03989E49FA86535B172D3522E8FB590D3B0816D48255AE1EED15A43C5E977D0934CAC27FD44F01F1FDCEA03BC64F07CC2F22494764F178DF6FC3AEFB7A6189259FFA7CCDFD040F7E3E086482A785044AA2394F4FDC0D9FA7E994DA3AC6DF7776195462B079716CDF26F4A87E5C6EE4B191B93E3200045BB9109948B7FA8F2EDD4117EDA101E0ACC2D80433C44DCC58FE397A668A5D33141B01E209E0821F13C1BB39E352D6FE0AB36E22F6FDED1A5889497B2427408B4C640AB2C0F77D03D70FD3F32A45A6AB493B46C6C88B142DE4DE00D65CA04171EDBBCD58F657E36F00F83401C82AE3735CB75420CDE88ED81C3CA63BB9D24E93544F3D414476D73D1E58EBDB0E103A7A6CBFCCC55C8A026DE0087A66E6F45A3F3F5319C06AADA7247170E0C4190CBFD1C0417A4EE4FE540F1158728933903507002EF033A630CEC390C818ED860C265D31D2970E644AD0F42B442DD648D8E700FB5E05C802CB0982D73563DCBFE838A7EC21F683EDFC460AC314076F2DCE44E4993F95142B71189645D6CEB9DB6147AA37DD5B70B19FD79775D71A414440C355ED45C04F5E8553FC2EFFDE24F34282512182FE1FF8EEDD8819FC288B583E310DE553E5C7EEF48CAAFA0D1050B1C5DE4B37157861C41950900D7253510DE0340C0AD552F6C9976346AA3930856BC887BFFA56C8119E51B1E16B95362AAA0DB01174CBBAC5A6B867874C4522A1AF29BA2CCC55EA1EE88D41E4613ADA6DF75FFFBB6F00E83401C82AE3735CBC532B4227241A91FD8370D1AC121350D2B11039489B20114B17D4C6B840B87480C9CAE31C0ABD3D0DD7CB450D891036AEBC28BE232099FB1CAD71320C33C840585BA756C3716C164B4B6A797B7E6D7805D9DDCC1F88EF9443103BBD96EC2ED7BC126AB0D892D8F6241890A962EC273A22733522A4F091F22D2A81F3FEE6386D4F8A6553B4EA4F171E78D003992C0FF08EE2B406A49F91AF4CA00B71878910581B6E0CE3BFFBA1CA10CBF3B1B7D3196146AB30056C49AF7C01B3C868BB4C53894B576E930DD3D5B971223A772A15A193415049D6776815EFFBCB3D92D31A8C31A02EFF15A9A0003973B215495886E4F87EF72C07D06A6FC950003DDED0FF8FD8A4F4C28FDDF7666907524BBA4FF00272F0FF14C337CBA24A71A01DF52CD928641C03EDE68A5C8F99F9898A6047116B6F0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000201000201000400031100A7BBDA72E68A4018B176DE3BAE993266031100A1C21100CAA111D28B020090270750C4170D3136303931333039303232325A300D06092A864886F70D0101040500038181006F223E880A2585C31A0C17732B40AA800D6652B75A38D3D023B78CC8E8C386E1104790B019838216DF8D41D20E0F2F7D244B435705E5C5674F2182FDC83D99AAC758B93EDF82367F7E4AEE0A88644457CC17AAB5A8C14563BE3D2D08ACE377F47B66E847803659FE27293F0E6CFB91BD07DEB4A73BB11EA717070934952C92BB');
INSERT INTO `sa_debtor_finger` VALUES ('26', '0', '30', '3', '30820776308206DF048206A6308206A23034302F0201030201020410731A82514BF14F09AA20FF609E0333880410479D6AD1B9A811D2A7A70040339F131702030200000201010482066000F89201C82AE3735CFA482C5064E75989A44199A96E438816FC42698B9E1DA32463E6F3BD7F6E838807D86D8D1F841612E62AAC563FD26690F1A245F18BD6122FF82CF9F7712E236774A83B69A8AE41A30502B1FBE0B132ACCB48AE810758FBA87FC8004771EB6173EA1DA9C59101236EFAA287FFC108155FA5F7DDAB81218FB344EDBEEAD3CD01AD25BEAD5B52A74EDEE76FB0D69A7B2A0413E2762C8AABAD3F11CA46D4F702DFF122DE704EFE5B9F2660339BD42A4AF31295202D24280350CFBF2687B3A179F7048B0457AB467D4002A99E4DF57E6415DF0903EF5DE61FB672BF4A1C473D9A1CB303ECA44DCFEB1B66F44A2D47184EF13FFC976DD7FF5E217B56D19CC21D9164926964C72DB5A2F841DCB80339A1C3EF1673A3D0292B6541853829B6E228A070FAC182164CCDAA725408BEAE4AEA9D2B835189A82D13403A9EED26082A722DEDDAF85E8994CCA434CEDF0B275D9D1056F82AF5E929A419AD73E50540808D61ED5087B2DFE3EEADEFA8E8503CB0D59EC88396C9303707A6DFA3B434B8DBAD03939D31C422A81C4D7861694F7EFC996F00F89301C82AE3735CF4562159241D2A77695D66D4AD962489713086A564D2CDE7E0A80B717F0A6ACC15C5A1C0C38ED591C544EB216E1890BBDC4F7049D2A18C73FD224EC7E7CDD682BD97080706575806E986DF14E5D38DADC09A5FB7C72F6408C94A6F11A119F85740D0CC6D9DE245A7CF9C497A8406EB106880574DA16F7EF9C9E8A66980C5896A0FC24BD7118AA202885290AAC994690222776376E37E46BB4E7E0D1A8E2020EBA84522BB34CBE5B085971875A476658FFE70A9978BA9E6099645190D97EBD33C363CD64E473F968AE7CC9E5A8202F1C82D4F4CD19806842EC82B62991827E1286412DF1A71A5FB48F4F566515CB4EC9607EC58C670B74F439ADEBEA1A80F7C2F1E981F17C0FBE2ADA253815457ED3AD215EBD9F6C22E247A1A960D1750C094403A3CEF2A612E87C75D932DB76DDDEA380DE0E15CC306D59DBB813149D84C796DA42DD4D39EED94A3DF46749E91428695F88F5E3FA3CD48A9F3CA0CCB7B44C03787802DE7E474B245720F9FC372965306C44C5EC9F3CA68F774B189E38FFA390FA1070AC3093D3428480315A6832F6F00F86A01C82AE3735CF2561625363FAA1DD14AC22FCF3872551D0754DF6E4DFFDDB11868851450C946E6A4641C04AF855A802A0856935CCFD589D5333EE9F35186A4D76DB3A93791D0BEE9B5BD81F4880F1DFA84582C05EB16319803ACC9D40B9ADE25C7FC1F92CFF4063B05E0A8985571EEF09AAF85BD4C0649C7BAF00F923375D44FDEF2E9BCCBD570AE08EDB2FBFF804F85E3B176EF9345A1F8207AA4C4E05091F282CEAA2C9CE5C8D40207C6B7F51F776E9C2853C71E6B869D4AC79656DEE7B028801F97E5CB1A6ABB47A64F582C08245417AA2872FAF5F21E22E80D3E44083C68908C5365B776B8A9A073C0266DC1F5F01CB0602A7258A83990FB17C2DA06BA48F1FFF8D5A7BBA64BD2380C26081C181AE4C5A87AEFDF1D65A71E2B0025D7D4C870232C0F2B6D4D85DBAA21D3935ED1959369A12175A4240E72B0562D5AD70255B5709F48B8821DBC6EFD7A855D9AA4ACB80213E7991BA4DEBAF761E01C4BB7666932076319BF36508C99396F00E89301C82AE3735C145627FB596741246A600669309B5BC142ABE0FBD75BE97B681030209E6506BC363C232081D934E0FD972C70784CC98AFF2D8D6C075E19C170A66806331C1E6BA1AFABDD1408FFBDCC98AD4A1AF6FFBD4E211D895E112C1CE88182ECA65542D10CEC630ED7A74815941DECBD39F49BA664441D60E559FD3A25EF46550A2A0CD36597FFDD660CD7AE8A58533BC5F8374648B499B2ED5C74FD8756C0A697458064BCD3EE6C0E27FBA5F800D31EB583B3A80C809AFE54B40BAA9C489C91EE2F51563487757190B719E2035837C3E878EB8192D9BB0E2EA2D3844C90F0ECEE41F3117701DD4DCB994544440ACD3DD8D4FE056C25BC7F6FA3B385CAA7171CFC23022B2C5D1CB01547866E2EBEA06AA6FD74565B5CA926CA8C777341CD5F9EB9C3B95CBD3D0D5B39368D604CA10D4FFC105037253561B9316E72DDE50330B933F359B852A0880EBF11E88FC6A9B16C5777635770EED25BEF31BF4F1B322FF23C7F9D3A5A2259ACCFDC2EA853939783C01C143BEEE2D3F7A1D379DA11C56109200BBBE74EA507288B47573E3678B165FC596F0000000000000000000000000000000000000000000000000000000000000000000000000000000000000201000201000400031100A7BBDA72E68A4018B176DE3BAE993266031100A1C21100CAA111D28B020090270750C4170D3136303931333039303233385A300D06092A864886F70D0101040500038181007E45DD5DD01EDA1208ECFD5C0C424C2DCEBF9BE2C54723D3225AA6FF2AB438A085E3D86D69407E6FC39173B8BA3D5EFE54FBD37EEECC18D16C3BFA5A2CCCDB8F066315E703C812F5C9E962BF81EEDD260AEDDB5F24B8B6EC959FD007DA2B8FA2F0F5FB0F5C90BD01251E0EEBF64BBE538437A72C9E823DF9F091CF5B263B33D1');
INSERT INTO `sa_debtor_finger` VALUES ('27', '0', '31', '6', '30820776308206DF048206A6308206A23034302F02010302010204106E64AC842F1A4E24A5509548F14F97FE0410479D6AD1B9A811D2A7A70040339F131702030200000201010482066000F85401C82AE3735CA0542838FCC93DD388DF554C195547196309A98F5E0F7AD9127336E579FC890A7105A19BA07018D8A328C3DAB7982870BB321B3EB403BC6352F308CBDFE8FF1363CAC7280A87C313C60FA3CBDBCF21E8D87BC3BF15792FEE347172918927E935844E421426E05BF259D441DDBC1BE759D2C4554E786A7BB05403F0C4666082BB0635DC0EFE7C1CFC7E8D917A40FA5006C0AD7C3D1EDE8C142098E73578FD726A50119C6D8D2117D2DCA32306C97D08EC37419B2CBCF6758D76FC72B38E34CBDB1F67F3A7BEF52410763EFC9A81B1E66683ADE703A8289710337E9DF8C4180E1A82737CBBCCE82F062A3AB6BEE219FBF94F78C902C9794A9E1772D85FAC7543CE379248994D7717D7AA9E5349AD1C887E21EB27EE618BBA2DABF41DD696BE8B15D22FBF55C7376FE96ED35889B42578DF8C6E009D828AF65225F18C39FAEF1AA0594C864768B79EACAD8B88007A95D26F00F84201C82AE3735CBB5323BCCEC40F8B281D6B9ED202DE10B27535C019D810530F8DF2387A802A9724443904E9024B5C2225931ABCDC4B9FAA59A4CB58A7A8F92898290C84A4BF30DAE7039A2616C0E4860C04E713AE0FF7E867F988C641A075318E0CE29EEF8AD7488206D60DF9E7D601F0B79970B694E120B03C506807C5E301F4958F47C8229C1D503E5692E17D1DF1998CFCA30118F44557E89758AEA1B4C864B61E0C7109B9FE3538ABD6DC74F478327E54C598106195501AA36F9C91F612ACF6D5F718176EB659B387FA661A2AB23F51C4FA5624182A4157D3DF0640D2DE7276BEEFE5F345DA67CD832E2D87212200E59929D23D379560FC52CD4B8418D95D04DFE28AA005C0B6EE50A80F871D1F4A075A1258723351AD7FE2AC567139FFC8783ADBC2BDC6212150DCCBE00C1B3EC806329ED3ADA8A9E2AEB5E1F73AD3AA441F8FA26F00F87101C82AE3735CD8532BE83A422449F47498E1F30414B5C3976CBFC0CD2542686BC4BD74F4854000CF4FBD290BE604E17A77C63165EA83232FA148A3934624B58A868EA65A4DA481B6628250FEAB1A96E1D3C3A0EE632A82E6D3E1FC804C331D2956DCE03D4E66CCA8AC02C7F8DAA6D379449F9D60A035D378933FA13502F0245A12F439C451C298D01E522DE1E30AA40DCE2F069A97383A87F0CAE29DF22E4AAF5B9BB49BA0AD73848614D0BB2C0981450FCEF4967374FCA888AEA97D295D467335E051F1E6F882276C8ED3D8E52DA3E6B410B43E26EFF7D7827E88D32673098D1C90E64411086A1E366AA7BAD770489BA60B16B5B21871D69167A5544055446A3707A7F2E6BCA735C2D6E5F36FB587CDEEA323AE481ACD89F695C1A53B5494AFD4CABAACFF90DCC6545E9DAB06C4F1685F7E425A2B100D5E48BBF9B8A7ECB0C8F2BD2CF1377AA8F7DB8A8146D83111E6EACF79410BEA900BE8F3799429181FD44861CE624C645012CD5E141304A15D5E75146F00E82E01C82AE3735CA05516BDE3390CC46E2FFDAB0A2CB3EB980682E11D52C91CBB7D1B63E735CC5CF1F2EDB30420BD317912DACEB1D6A2EEBA41C9838BAE29963031ACCAACE4E6EB944EAB42E15E9BABF472E45E2582B2AB2C71E46904F1D37489AD92EFC75C2D5A70F8AF8567E822E7B9CA696F5DDC9003B3E266B58DEFE477795A347A983361473D86B4A2E81CA0F3513B2234B8A4D94F6472634641E5177B7DEDDDFAC791B8B72BE3479A30FA6648DD08B1E37CBD7EB1782F6AC0BC4A0C84AA85B071E0BF1DBF95366E00DFFAC5A1FDA70C5152CF09C5B5979A888C61AD4CB35A8B85A29DE05EC98DD51FDDDDA3CD81A9CA9EF278E222615649462BD649E0F435A279DE790EFB5E4DCDC061E64509603210B73B7BF383811EBF86D17D1487BDA61E52FCDEF5F256FE5BF892EC0573B26F0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000201000201000400031100A7BBDA72E68A4018B176DE3BAE993266031100A1C21100CAA111D28B020090270750C4170D3136303931333131303332325A300D06092A864886F70D01010405000381810025B3239FF7B48FB66D90074E395271717E17F94636C6EE15717E9D630EDCB838B5FFB87A2FFF8BCA061ADD0432166BB43BCCA53A51F33C59B1D9057F44DB55A55ABDBB8F8EB19C5EF8189DF661EFD5ECBB468925C8E250014505A6F50A4344F1C5E6FA5A1DAE0DF0DEAF850541D3480894E584A4B41E066EC3EFA512ED53D317');
INSERT INTO `sa_debtor_finger` VALUES ('28', '0', '31', '3', '30820776308206DF048206A6308206A23034302F020103020102041059ED26AFB46049A6B98048B4294914120410479D6AD1B9A811D2A7A70040339F131702030200000201010482066000F84901C82AE3735CDD552975C0D05B82839DE51F9D6D527CE372714786C17BB8562D53AD270D6CA76665B5705C3731B59A0560E03F14110B4C21EE60BC7DBCF76F67AFED9EF643975CAE4CA84D6A160B93411BC16783F8DB73DC8A03798FAA5A7F7E3E8066197057A553868CA5F8DAAA2B201E4DBEE3DAAE85675A76D9BE19A928BFD39F727ED49B2F2AEC018FE4A0A903F5AFCEC62751B728A9558665DF2C4C944E903744311C75DEFE742C8F1FD56193EB47862D4BEBD1B5A7801AFA921385CF7AFE6290ACD15303EF34012C6A7D728573B67FD2C20E55FBEE6045DC9C0DA60C7C34E069C7E0220E29C32DC1D0E13BE8487A6A03DBA1BDF57E3249F9AF30B31D05DD55309C1CFA5275637206281DAA44781F67DEED487B81AA8CC84A0560CD2BAD9FC850F99682C379D91A44A704E6092FFE7D4609E8862C6D33850A2FAEB3E7DF3A1B4D4E61A86243C44D6F00F83001C82AE3735CB5522638FB5045D496FD36B33C7CA42748994AAC2013186BB7015B70D7FC2693087C83F6E8A0FA68D86EADAE994C9D5DD388EF3F69AD5881BBBDC77257F55A03C475952CB3277C9BA289122B307D20D74BAFA7EC4FCFC7CD384C94B6E6B7DD5D9907DFDEA2E23E6D8F41E53BC813F27C01B61ACD2BB9AAFDDE5E411B8C266CFE8A93907F8D26C959647471D8F206BF4E6236588D96362626D67D7598504D1C107E20C4A8E2692BECF9759F7A6067DC679139C9AB0028B707E2747C69F54987BC4C3B2EBD84E141C18468BAD38CD24FC2789CC70095D86B8E7659260B96919CC2D54BDDA7F3BC7C24E97CBAC153E9EC481CB8FA6EA22765E45CDF7DB41C66079512DD13EB935C2A698D229CD4BE7AEA732B8FFB57D7B5D5DE7E0565C0F154970DD87BFF2756599CDE875F8E6F00F84301C82AE3735CAC562ED487E81D363E7B03E64411B449974F769AB3DE1EDE8E2E926090FA457090632EB1B30083EF6BBB9C5A2A9087370191E18C50FD987A50C9F1C562EF4ACFEB05CB17377EEE91D4B3ABB7349D01BD459F6CE3B4EDD0C0F04B8731A269B882994375B27016B323D53C65771201C1523E8261B3F615378E5687CE56E4491171FB871DD631FD16827D959E277EC6D0F942685D68FFF95169D99F426581181376A086EED989100B98C46B903E3ECAACDF4F6226CDFAD4CF0A674F7B21AF7F66DD0BBB253A3566003744EC57579DBBD2D05A48DA02DC6888F5804A721DDC288812949987F2CC7FB22FE95E8202EB5D629F52B813D9E46493BB520F2AFC420C3C75480E86557811BCD1FB6AA3CCD66BCE86AF966D2A9AD007AABF788F3EE78872F0E3BFF2D5CD160706B76647FCCEEC57B9DE7BDEE4E5E1C0BDBAFECA583EC26F00E83701C82AE3735CBA552FB29FF4BA0D21F1BAD22AA1C533D819436239E51A7E295D5FC399AE105FEC1F8B581DD7FCC7DAFBE87D0FD5374B0E056F450EBF238D35758324E1AB2307F60DD06008EB1EFE96ACD8C1FA82987DEF2413E827C6F43FE33BCBE5F100BE5CDD9A5A0E7DB577328A27FD8C17A24232F56DA06482FBF2AF3CBF638867A0F1D1F48B6E4D0D121655A75268C34D87EB28E251634F0DAB1FD60EA498FFED2F9397A565D48588AA8AEAA26276EE070EC81B23398936F2A89756DD0599AD1ADF1D0A497CA696DAE2C95DF71CB1C5A2DA2BA720F3FD7D4B2021BDE90C7653089F70AE54062A9BF3BBB669E4067617735B890CE7D813C4ADBECBCD2FD67809389EAEAE95DFE2E8C1953677EE4DBB9AD86AF936BB5C84FBCF031F2903143D0952398A68B02F5BABFADCF89C03C2C2BBA285DE8140FA6F0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000201000201000400031100A7BBDA72E68A4018B176DE3BAE993266031100A1C21100CAA111D28B020090270750C4170D3136303931333131303333365A300D06092A864886F70D01010405000381810090CBEA2D873F2C7A06E8A081ABBD20D136B76FB17FE881BCD5AA4F41456541B23BF4EDBBE9A537A7EE8D7C7760D2EFE57151B095A56FABAF23EAEAD3B7BBC83349E33EFBC7C56864D1A70BA39BBE787AFCC984D25A77E834C976B9C82A077A654D92BDBF40510E18FDF0C184BFC93BFD14050F0B936D4206EDB399E1CD7A1687');

-- ----------------------------
-- Table structure for sa_debtor_type
-- ----------------------------
DROP TABLE IF EXISTS `sa_debtor_type`;
CREATE TABLE `sa_debtor_type` (
  `rowID` smallint(6) NOT NULL AUTO_INCREMENT,
  `type_cd` varchar(6) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `name` varchar(60) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `category` char(1) CHARACTER SET latin1 NOT NULL DEFAULT 'C',
  `receiveable_coa_rowID` smallint(20) NOT NULL DEFAULT '0',
  `advance_coa_rowID` smallint(6) NOT NULL DEFAULT '0',
  `deposit_coa_rowID` smallint(6) NOT NULL DEFAULT '0',
  `rounding_coa_rowID` smallint(6) NOT NULL DEFAULT '0',
  `adm_coa_rowID` smallint(6) NOT NULL DEFAULT '0',
  `payable_coa_rowID` smallint(6) NOT NULL DEFAULT '0',
  `commission_coa_rowID` smallint(6) NOT NULL DEFAULT '0',
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`,`type_cd`),
  KEY `rowID` (`rowID`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of sa_debtor_type
-- ----------------------------
INSERT INTO `sa_debtor_type` VALUES ('1', 'CST', 'CUSTOMER', 'C', '19', '26', '186', '0', '163', '84', '163', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-16', '17:21:55', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor_type` VALUES ('2', 'SPR', 'SUPIR', 'D', '25', '27', '194', '0', '0', '195', '137', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-16', '17:31:37', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_debtor_type` VALUES ('3', 'KRY', 'KARYAWAN', 'E', '24', '39', '92', '0', '163', '186', '163', '0', '0', '1901-01-01', '00:00:00', '0', '4', '2016-09-16', '17:29:19', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');

-- ----------------------------
-- Table structure for sa_dep
-- ----------------------------
DROP TABLE IF EXISTS `sa_dep`;
CREATE TABLE `sa_dep` (
  `rowID` smallint(6) NOT NULL AUTO_INCREMENT,
  `dep_cd` varchar(6) NOT NULL DEFAULT '',
  `dep_name` varchar(40) NOT NULL DEFAULT '',
  `pool` enum('yes','no') NOT NULL,
  `cash_gl_rowID` smallint(11) NOT NULL DEFAULT '0',
  `cash_out_prefix` varchar(4) NOT NULL DEFAULT '',
  `cash_in_prefix` varchar(4) NOT NULL DEFAULT '',
  `ho_trx` char(1) NOT NULL DEFAULT 'Y',
  `site_flag` char(1) NOT NULL DEFAULT 'N',
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`,`dep_cd`),
  KEY `rowID` (`rowID`),
  KEY `dep_cd` (`dep_cd`),
  KEY `dep_name` (`dep_name`),
  KEY `cash_gl_rowID` (`cash_gl_rowID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sa_dep
-- ----------------------------
INSERT INTO `sa_dep` VALUES ('1', '01', 'FINANCE', 'no', '6', 'KK', 'KM', 'N', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_dep` VALUES ('2', '02', 'ACCOUNTING', 'no', '6', 'KK', 'KM', 'Y', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_dep` VALUES ('3', '03', 'INFORMATION TECHNOLOGY', 'no', '6', 'KK', 'KM', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_dep` VALUES ('4', '04', 'TAX', 'no', '6', 'KK', 'KM', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_dep` VALUES ('5', '05', 'PURCHASING', 'no', '6', 'KK', 'KM', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_dep` VALUES ('6', '06', 'MARKETING', 'no', '6', 'KK', 'KM', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_dep` VALUES ('7', '07', 'IT DEPARTMENT', 'no', '6', 'KK', 'KM', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_dep` VALUES ('8', '08', 'SUMUR BANDUNG', 'yes', '8', 'KK', 'KM', 'Y', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '1', '2016-09-07', '12:59:39', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_dep` VALUES ('11', '09', 'DEPATEMENT BARU', 'no', '7', 'SDVD', 'QWEQ', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '1', '11', '2016-02-17', '15:24:00', '11', '2016-02-17', '15:26:36', '11', '2016-02-17', '15:26:58');
INSERT INTO `sa_dep` VALUES ('12', '10', 'HEAD OFFICE', 'no', '5', 'KK', 'KM', 'N', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '11', '2016-02-17', '15:27:35', '1', '2016-09-16', '17:02:14', '0', '1901-01-01', '00:00:00');

-- ----------------------------
-- Table structure for sa_destination
-- ----------------------------
DROP TABLE IF EXISTS `sa_destination`;
CREATE TABLE `sa_destination` (
  `rowID` smallint(6) NOT NULL AUTO_INCREMENT,
  `destination_no` varchar(6) NOT NULL DEFAULT '',
  `destination_name` varchar(40) NOT NULL DEFAULT '',
  `coordinate_rowID` int(11) NOT NULL,
  `address1` varchar(60) NOT NULL DEFAULT '',
  `address2` varchar(60) NOT NULL DEFAULT '',
  `address3` varchar(25) NOT NULL DEFAULT '',
  `post_cd` varchar(6) NOT NULL DEFAULT '',
  `telp_no` varchar(20) NOT NULL DEFAULT '',
  `contact_prs` varchar(40) NOT NULL DEFAULT '',
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`,`destination_no`),
  KEY `rowID` (`rowID`) USING BTREE,
  KEY `destination_no` (`destination_no`),
  KEY `destination_name` (`destination_name`)
) ENGINE=InnoDB AUTO_INCREMENT=218 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sa_destination
-- ----------------------------
INSERT INTO `sa_destination` VALUES ('1', 'TP1', 'TANJUNG PRIOK', '0', '', '', '', '', '', 'Dono', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('2', 'MRK1', 'MERAK', '0', '', '', '', '', '', 'Kasino', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('3', 'SMB1', 'SUMUR BANDUNG', '0', '', '', '', '', '', 'Indro', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('4', 'SMG1', 'SEMARANG', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('5', 'CRB1', 'CIREBON', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('6', 'CKP1', 'CIKAMPEK', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('10', '007', '007', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '11', '2016-07-20', '10:49:02', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('11', '009', '009', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '11', '2016-07-20', '10:49:10', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('12', '102', '102', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '11', '2016-07-20', '10:51:39', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('13', '106', '106', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '11', '2016-07-20', '10:51:46', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('14', '109', '109', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '11', '2016-07-20', '10:51:56', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('15', '114', 'KADE 114', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '11', '2016-07-20', '10:52:21', '22', '2016-09-06', '10:05:24', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('16', '201', 'KADE 201', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '11', '2016-07-20', '10:52:56', '22', '2016-09-06', '10:05:36', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('17', '115', '115', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '11', '2016-07-20', '10:53:48', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('18', '207', '207', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '11', '2016-07-20', '10:54:12', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('19', '209', '209', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '11', '2016-07-20', '10:55:47', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('20', '210', 'MM2100', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '11', '2016-07-20', '10:55:56', '3', '2016-09-08', '11:42:08', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('21', '211', '211', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '11', '2016-07-20', '10:56:03', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('22', 'BLJ', 'BALARAJA', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '11', '2016-07-20', '10:57:54', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('23', 'HLC', 'HOLCIM', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '11', '2016-07-20', '10:58:03', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('24', '213', '213', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:21:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('25', '214', '214', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:21:13', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('26', '218', '218', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:21:25', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('27', '219', '219', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:21:38', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('28', '223', '223', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:21:48', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('29', '300', '300', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:21:58', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('30', '301', 'KADE 301', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:22:09', '22', '2016-09-06', '10:06:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('31', '302', '302', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:22:16', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('32', '303', '303', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:22:26', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('33', '304', '304', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:22:36', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('34', '305', '305', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:22:46', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('35', 'ACL', 'CPI ANCOL', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:23:28', '22', '2016-09-05', '18:56:01', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('36', 'AIR', 'AIRIN', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:23:39', '22', '2016-09-06', '10:07:37', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('37', 'ANC', 'ANC', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '1', '20', '2016-07-20', '15:23:52', '0', '1901-01-01', '00:00:00', '22', '2016-09-06', '10:10:32');
INSERT INTO `sa_destination` VALUES ('38', 'APW', 'AGUNG RAYA (APW)', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:24:02', '22', '2016-09-06', '10:08:19', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('39', 'ARS', 'ARS', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:24:15', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('40', 'ASX', 'ASPEX KUMBONG - CILEUNGSI', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:24:38', '22', '2016-09-06', '10:09:30', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('41', 'BDI', 'GD. BERDIKARI', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:24:50', '22', '2016-09-06', '10:10:02', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('42', 'BDK', 'BERDIKARI', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:25:06', '22', '2016-09-06', '10:10:20', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('43', 'BGR', 'BOGOR', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:25:15', '22', '2016-09-06', '10:06:27', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('44', 'BJN', 'BOJONEGARA', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:25:25', '22', '2016-09-06', '10:11:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('45', 'BL', 'BL', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '1', '20', '2016-07-20', '15:25:37', '0', '1901-01-01', '00:00:00', '22', '2016-09-06', '10:12:28');
INSERT INTO `sa_destination` VALUES ('46', 'BSA', 'BSA CAKUNG', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:26:10', '22', '2016-09-06', '10:17:18', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('47', 'BSL', 'BSL', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:26:27', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('48', 'CBT', 'CIBITUNG - BEKASI', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:26:36', '22', '2016-09-06', '10:21:17', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('49', 'CDC', 'GD. CDC', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:26:47', '3', '2016-09-06', '10:42:03', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('50', 'CGD', 'CIGADING', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:27:06', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('51', 'CHJ', 'GD. CHEILS JEDANG', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:27:22', '3', '2016-09-06', '10:43:27', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('52', 'CKD', 'CIKANDE', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:27:42', '11', '2016-09-05', '17:57:03', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('53', 'CKP', 'CIKAMPEK', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:28:01', '3', '2016-09-06', '10:43:55', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('54', 'CKR', 'CIKARANG', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:28:12', '3', '2016-09-06', '14:09:17', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('55', 'CLG', 'CILEGON', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:28:19', '22', '2016-09-05', '18:54:28', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('56', 'CT', 'GD. GETOT', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:28:30', '3', '2016-09-06', '14:09:48', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('57', 'CWD', 'CIWANDAN', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:28:39', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('58', 'DDP', 'DADAP, KOSAMBI', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:28:52', '3', '2016-09-06', '14:10:10', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('59', 'DKB', 'GD. DARMA KARTIKA', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:29:01', '3', '2016-09-06', '14:10:51', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('60', 'DWP', 'GD, DWIPA', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:29:10', '3', '2016-09-06', '14:13:30', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('61', 'FKS', 'GD. FKS MULTI AGRO - PASAR KEMIS', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:29:23', '3', '2016-09-06', '14:14:36', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('62', 'GDB', 'GUDANG B ', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:29:30', '3', '2016-09-06', '14:21:39', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('63', 'GDD', 'GUDANG D', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:29:45', '3', '2016-09-06', '15:47:24', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('64', 'GDE', 'GUDANG E', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:29:56', '3', '2016-09-06', '15:47:43', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('65', 'GDF', 'GUDANG F', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:30:07', '3', '2016-09-06', '15:47:56', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('66', 'GDG', 'GUDANG G KBS', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:30:37', '3', '2016-09-06', '15:48:23', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('67', 'GDI', 'GUDANG I KBS', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:30:50', '3', '2016-09-06', '15:48:46', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('68', 'GDJ', 'GUDANG J KBS', '0', '\'', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:30:57', '3', '2016-09-06', '15:49:03', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('69', 'GDK', 'GUDANG KIEC II', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '1', '20', '2016-07-20', '15:31:11', '3', '2016-09-06', '15:49:26', '3', '2016-09-08', '11:40:47');
INSERT INTO `sa_destination` VALUES ('70', 'GGM', 'GOLDEN GRAIN MILLS', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:31:24', '11', '2016-09-05', '17:50:30', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('71', 'GML', 'GOLDEN GRAIN MILLS-KIEC II CIWANDAN', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:31:38', '3', '2016-09-06', '15:50:55', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('72', 'GRS', 'GD. MARUNDA-GARASI', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:31:48', '3', '2016-09-06', '15:51:31', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('73', 'HAC', 'HAC', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '1', '20', '2016-07-20', '15:31:58', '0', '1901-01-01', '00:00:00', '3', '2016-09-07', '10:35:38');
INSERT INTO `sa_destination` VALUES ('74', 'IDR', 'INDORAMA', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:32:13', '3', '2016-09-06', '15:52:31', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('75', 'IKT', 'GD. INDAH KIAT', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:32:20', '3', '2016-09-06', '15:52:57', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('76', 'ING', 'GD. INGOM', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:32:38', '3', '2016-09-06', '15:53:49', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('77', 'JPC', 'JAPFA FEEDMEAL CIKUPA', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:32:49', '11', '2016-09-05', '17:56:33', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('78', 'JPF', 'JAPFA FEEDMILL CIKANDE', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:33:40', '11', '2016-09-05', '17:55:31', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('79', 'JTK', 'JATAKE', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:34:59', '11', '2016-09-05', '17:53:26', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('80', 'KLG', 'GD. BULOG KLP GADING', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:35:23', '3', '2016-09-06', '15:54:30', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('81', 'KPL', 'KAPAL', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:35:33', '3', '2016-09-06', '15:56:04', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('82', 'KPO', 'GUDANG KOPO CIKANDE', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:35:44', '11', '2016-09-05', '17:49:03', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('83', 'KWT', 'GD. KWT CILEGON', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:35:50', '3', '2016-09-06', '16:00:24', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('84', 'L4', 'GUDANG L4', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:36:01', '3', '2016-09-06', '16:00:44', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('85', 'LJS', 'LJS', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '1', '20', '2016-07-20', '15:36:21', '0', '1901-01-01', '00:00:00', '20', '2016-07-20', '15:36:39');
INSERT INTO `sa_destination` VALUES ('86', 'LJK', 'GD. LJK MARUNDA', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:36:48', '3', '2016-09-06', '16:01:11', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('87', 'LUM', 'PT. LUMBUNG NASIONAL- CIBITUNG', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:37:01', '3', '2016-09-06', '16:02:20', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('88', 'MKT', 'GD. MKT', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:37:15', '3', '2016-09-06', '16:03:24', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('89', 'MLD', 'MALINDO', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:37:21', '3', '2016-09-06', '16:03:47', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('90', 'MPK', 'GD. MANDIRI PUTRA YUDHA KONTENA', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:37:34', '3', '2016-09-06', '16:04:26', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('91', 'MRK', 'MERAK', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:37:42', '3', '2016-09-07', '10:35:14', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('92', 'MSA', 'MSA', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:37:51', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('93', 'MTF', 'METROFEED - BEKASI', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:37:58', '3', '2016-09-07', '10:36:22', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('94', 'NHI', 'NEW HOPE INDONESIA', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:38:09', '11', '2016-09-05', '17:46:35', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('95', 'OLK', 'OLK', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '1', '20', '2016-07-20', '15:38:15', '0', '1901-01-01', '00:00:00', '3', '2016-09-07', '10:36:52');
INSERT INTO `sa_destination` VALUES ('96', 'PDD', 'PINDODELI', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:38:25', '11', '2016-09-05', '18:50:46', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('97', 'PKM', 'PASAR KEMIS', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:38:32', '3', '2016-09-07', '10:37:07', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('98', 'PRM', 'GD. PRIMANATA', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:38:45', '3', '2016-09-07', '10:37:46', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('99', 'PRW', 'PURWAKARTA', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:38:59', '3', '2016-09-07', '10:40:01', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('100', 'PSS', 'PASOSO', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:39:07', '3', '2016-09-07', '10:40:23', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('101', 'SB', 'SUMUR BANDUNG', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:39:20', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('102', 'SEN', 'GD. SENKON', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:39:33', '3', '2016-09-07', '10:40:54', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('103', 'SGR', 'SEGARA', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:39:40', '3', '2016-09-07', '10:50:11', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('104', 'SGT', 'SENTRAL GRAIN TERMINAL', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:39:52', '3', '2016-09-07', '11:05:22', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('105', 'SRG', 'SERANG', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:40:01', '3', '2016-09-07', '10:49:05', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('106', 'TNA', 'TANAH ABANG', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:40:07', '3', '2016-09-07', '10:50:41', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('107', 'TPU', 'GD. TRIPANDU', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:40:20', '3', '2016-09-07', '10:51:01', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('108', 'TRI', 'TRISARI', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:40:26', '3', '2016-09-07', '10:51:16', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('109', 'TSP', 'GD. TRANSPORINDO', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:40:37', '3', '2016-09-07', '10:51:45', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('110', 'TWA', 'GUDANG KADO, TAIWA', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:40:44', '11', '2016-09-05', '17:48:40', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('111', 'UT1', 'UTC 1', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:40:58', '3', '2016-09-07', '10:52:13', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('112', 'UT2', 'UTC II', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:41:05', '3', '2016-09-07', '10:52:35', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('113', 'UT3', 'UTC III', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:41:13', '3', '2016-09-07', '10:52:55', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('114', 'WPP', 'PT. WIRA PRIMA PRATAMA - YOS SUDARSO', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:41:26', '3', '2016-09-07', '10:53:59', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('115', 'WJK', 'WONOKOYO JAYA KUSUMA', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:41:40', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('116', 'KMS', 'KERTA MULYA SARIPAKAN', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:43:08', '11', '2016-09-05', '17:47:56', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('117', 'PLI', 'PPLI CILEUNGSI', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:43:25', '3', '2016-09-07', '10:56:34', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('118', 'ADM', 'GD. ADAMAS - CAKUNG', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:43:36', '3', '2016-09-07', '10:57:11', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('119', 'BIG', 'BIG', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '1', '20', '2016-07-20', '15:43:44', '0', '1901-01-01', '00:00:00', '3', '2016-09-07', '10:58:25');
INSERT INTO `sa_destination` VALUES ('120', 'CK', 'CAKUNG', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:44:10', '3', '2016-09-07', '10:59:22', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('121', 'LBR', 'GD. LIBRA', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:44:28', '3', '2016-09-07', '10:59:50', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('122', 'PAS', 'PAS', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '1', '20', '2016-07-20', '15:44:41', '0', '1901-01-01', '00:00:00', '3', '2016-09-07', '11:00:45');
INSERT INTO `sa_destination` VALUES ('123', 'SAS', 'PT. SRIWIJAYA ALAM SEGAR - CIBITUNG', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:44:58', '3', '2016-09-07', '10:42:19', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('124', 'KRW', 'KARAWANG', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:45:09', '3', '2016-09-07', '11:01:28', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('125', 'SUB', 'CIKALONG - SUBANG', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:48:25', '3', '2016-09-07', '11:02:15', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('126', 'CRB', 'CIREBON', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:48:41', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('127', 'IWS', 'INTERWORLD STEEL', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:49:08', '3', '2016-09-07', '11:03:03', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('128', 'RKS', 'RANGKAS BITUNG', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:49:18', '3', '2016-09-07', '10:44:53', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('129', 'SBS', 'SABAS DIAN CIKANDE', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:49:28', '11', '2016-09-05', '17:53:44', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('130', 'BDU', 'BANDUNG', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:49:50', '3', '2016-09-07', '11:03:46', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('131', '208', '208', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:50:20', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('132', 'WLG', 'WELGRO CITEREUP', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:51:16', '11', '2016-09-05', '17:49:59', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('133', 'PRK', 'TG. RPIOK', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:51:31', '3', '2016-09-07', '11:04:22', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('134', 'CIS', 'CIBADAK INDAH SARI', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:51:59', '3', '2016-09-07', '11:04:49', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('135', 'SPF', 'PT. SHINTA PRIMA FEEDMILL', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-20', '15:52:22', '3', '2016-09-07', '11:06:03', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('136', 'STL', 'SENTUL', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-22', '13:47:24', '3', '2016-09-07', '11:06:28', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('137', 'BMM', 'BERKAH MANIS MAKMUR', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-22', '13:47:34', '11', '2016-09-05', '17:51:53', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('138', 'CHD', 'CHD', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '1', '20', '2016-07-22', '13:47:56', '0', '1901-01-01', '00:00:00', '20', '2016-07-22', '13:48:13');
INSERT INTO `sa_destination` VALUES ('139', 'GC', 'PT. GOLD COIN', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-22', '13:48:51', '3', '2016-09-07', '11:07:25', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('140', 'GWM', 'GUDANG WARGA MULYA', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-22', '13:49:31', '3', '2016-09-07', '13:26:35', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('141', 'JKB', 'GD. JAKSON - KREO SERANG', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-22', '13:49:44', '3', '2016-09-07', '13:27:34', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('142', 'JKR', 'JKR', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '1', '20', '2016-07-22', '13:49:54', '0', '1901-01-01', '00:00:00', '3', '2016-09-07', '13:28:31');
INSERT INTO `sa_destination` VALUES ('143', 'JKS', 'JACKSON CIKANDE', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-22', '13:50:01', '11', '2016-09-05', '17:49:22', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('144', 'SUJ', 'GD. SUJ CIGADING', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-22', '13:50:49', '3', '2016-09-07', '13:30:25', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('145', 'UNI', 'PT. UNION', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-22', '13:51:06', '3', '2016-09-07', '10:55:55', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('146', '104', '104', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-22', '13:51:30', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('147', 'CFB', 'CFB', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '1', '20', '2016-07-22', '13:51:53', '0', '1901-01-01', '00:00:00', '3', '2016-09-07', '13:31:42');
INSERT INTO `sa_destination` VALUES ('148', 'PSB', 'PASAR REBO', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-22', '13:53:23', '3', '2016-09-07', '13:32:58', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('149', 'SRD', 'SIERAD BALARAJA', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-22', '13:53:51', '3', '2016-09-07', '10:48:43', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('150', 'CPC', 'CPJF CIKUPA', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-22', '13:58:01', '3', '2016-09-07', '13:33:41', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('151', 'BJP', 'BINTANG JAYA PROTEINA', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-22', '13:58:37', '3', '2016-09-07', '13:34:21', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('152', 'LBS', 'LAPANGAN KBS', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-22', '13:59:08', '3', '2016-09-07', '13:34:55', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('153', 'HRZ', 'PT. HORIZONT INVESMENT', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-22', '14:05:40', '3', '2016-09-07', '13:35:35', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('154', '005', '005', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-22', '14:06:04', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('155', '006', '006', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-22', '14:06:11', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('156', 'TGR', 'TANGERANG', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-22', '14:06:56', '3', '2016-09-08', '10:26:53', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('157', 'KBD', 'KAMPUNG BANDAN', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-22', '14:07:08', '3', '2016-09-08', '10:35:20', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('158', 'GDH', 'GUDANG H', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-22', '14:07:47', '3', '2016-09-08', '10:38:01', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('159', 'GMR', 'GD. MERAK MAS', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-22', '14:08:02', '3', '2016-09-08', '10:39:04', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('160', 'KIE', 'GUDANG KIEC 2', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-22', '14:08:14', '1', '2016-10-12', '23:16:14', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('161', 'JS', 'JS', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '1', '20', '2016-07-22', '14:09:13', '0', '1901-01-01', '00:00:00', '3', '2016-09-07', '13:55:11');
INSERT INTO `sa_destination` VALUES ('162', 'BKS', 'BEKASI', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-22', '14:09:28', '3', '2016-09-08', '10:39:26', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('163', 'SBG', 'PAGADEN - SUBANG', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-22', '14:10:28', '3', '2016-09-07', '10:43:15', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('164', 'SPU', 'SPU FARM - TUNJUNG SERANG', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-22', '14:10:40', '3', '2016-09-08', '10:43:33', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('165', 'CKU', 'CIKUPA', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-22', '14:10:51', '3', '2016-09-08', '10:44:44', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('166', 'UC', 'UC', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '1', '20', '2016-07-22', '15:27:01', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '10:47:45');
INSERT INTO `sa_destination` VALUES ('167', 'BKU', 'BEKASI UTARA', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-22', '15:28:14', '3', '2016-09-08', '10:53:53', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('168', 'CCK', 'CPI CIKANDE', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-22', '15:28:30', '3', '2016-09-08', '10:54:35', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('169', 'CFC', 'CAM FARM CIWERED - CIKUPA', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-22', '15:28:42', '3', '2016-09-08', '10:56:18', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('170', 'CFK', 'PT. CPJF -  FARM GP KUNINGAN', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-22', '15:29:08', '3', '2016-09-08', '10:57:26', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('171', 'CPM', 'CPJF HATCHERY MANIS - TANGERANG', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-22', '15:29:52', '3', '2016-09-08', '10:58:17', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('172', 'CPS', 'PT. CPJF FARM - PAMARAYAN SERANG', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-22', '15:30:08', '3', '2016-09-08', '11:34:06', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('173', 'GAC', 'PT. GLOBAL AGROTECH', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-22', '15:30:28', '3', '2016-09-08', '11:35:02', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('174', 'JRD', 'JRD - SERANG', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-22', '15:30:51', '3', '2016-09-08', '11:35:47', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('175', 'KOP', 'KOP', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '1', '20', '2016-07-22', '15:31:06', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:35:22');
INSERT INTO `sa_destination` VALUES ('176', 'GCM', 'GD. CM', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-29', '13:44:50', '3', '2016-09-08', '13:36:08', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('177', 'CPR', 'CPR', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-29', '14:51:26', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('178', 'CGP', 'CGP', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-29', '15:09:56', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('179', 'SPC', 'SPC', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '20', '2016-07-29', '15:35:45', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('180', 'SPG', 'SERPONG', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '22', '2016-09-05', '18:31:13', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('181', 'KLA', 'KLARI', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '22', '2016-09-05', '18:38:31', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('182', 'CLS', 'CILEUNGSI', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '22', '2016-09-05', '18:43:34', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('183', '004', 'KADE 004', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '22', '2016-09-05', '18:43:49', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('184', 'LMA', 'LEMAH ABANG', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '22', '2016-09-05', '18:44:35', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('185', 'NR', 'NAROGONG', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '22', '2016-09-05', '18:44:56', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('186', 'PLU', 'PLUMPANG', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '22', '2016-09-05', '18:45:14', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('187', 'BUG', 'BUNGASARI FMI', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '22', '2016-09-05', '18:51:30', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('188', 'MRT', 'MUARA TAWAR', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '22', '2016-09-05', '18:53:08', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('189', 'SER', 'SERANG', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '1', '3', '2016-09-07', '10:41:10', '0', '1901-01-01', '00:00:00', '3', '2016-09-07', '10:49:17');
INSERT INTO `sa_destination` VALUES ('190', 'SBY', 'SURABAYA', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-07', '10:41:38', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('191', 'SBA', 'KALIJATI - SUBANG', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-07', '10:42:49', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('192', 'SGL', 'GD. SGL CIOMAS SERANG', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-07', '10:44:04', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('193', 'SBR', 'PT. SUMBER ROSO', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-07', '10:44:27', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('194', 'SKB', 'SUKABUMI', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-07', '10:45:18', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('195', 'SMP', 'SEMPER', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-07', '10:45:35', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('196', 'SKL', 'SUNDA KELAPA', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-07', '10:47:49', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('197', 'SOL', 'SOLO', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-07', '10:48:07', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('198', 'WK', 'WIKA', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-07', '10:54:35', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('199', 'WIR', 'WIRA DEREKINDO - CIKARANG', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-07', '10:55:31', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('200', 'BTG', 'BINTANG TERANG CIKANDE', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-07', '10:58:44', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('201', 'PKS', 'GD. PRAKASA - BEKASI BARAT', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-07', '11:01:04', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('202', 'JFM', 'GD. JAYAFARM SERANG', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-07', '13:29:14', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('203', 'JSC', 'PT. JAKARTA SEREAL, CAKUNG', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-07', '13:55:36', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('204', 'GRH', 'GN. GURUH', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '11:37:42', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('205', 'AGR', 'AGRICO', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '11:39:23', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('206', 'CIF', 'CITRA INA FEEDMILLS', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '11:43:53', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('207', 'UVA', 'UNIVERSAL AGRIBISNISINDO', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '11:46:05', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('208', 'TND', 'TANINDO', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '11:46:51', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('209', 'SHS', 'PT. SHS, SENTUL', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '11:54:58', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('210', 'SMR', 'SINAR MUSTIKA RAYA, TANGERANG', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '11:55:41', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('211', 'BCT', 'BATU CEPER, TANGERANG', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '11:57:08', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('212', 'DRS', 'DUREN SAWIT', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '13:36:22', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('213', 'PBI', 'DS. CIBERES PATOK BEUSI', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '3', '2016-09-08', '13:55:09', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('214', 'CPI', 'CPI BALARAJA', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-10-06', '10:39:23', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('215', 'CJS', 'PT. CJS, CIKANDE', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-10-07', '08:49:46', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('216', 'GDC', 'GUDANG C KBS', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '1', '2016-10-09', '15:07:35', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_destination` VALUES ('217', 'KC1', 'GUDANG KIEC 1', '0', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '1', '2016-10-09', '15:15:35', '1', '2016-10-12', '23:16:35', '0', '1901-01-01', '00:00:00');

-- ----------------------------
-- Table structure for sa_expense
-- ----------------------------
DROP TABLE IF EXISTS `sa_expense`;
CREATE TABLE `sa_expense` (
  `rowID` smallint(6) NOT NULL AUTO_INCREMENT,
  `expense_cd` varchar(20) NOT NULL DEFAULT '',
  `descs` varchar(60) NOT NULL DEFAULT '',
  `advance_category_rowID` int(11) NOT NULL,
  `expense_acc_rowID` int(11) NOT NULL DEFAULT '0',
  `ap_acc_rowID` int(11) NOT NULL,
  `reimburse_acc_rowID` int(11) NOT NULL,
  `advance_acc_rowID` int(11) NOT NULL,
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`,`expense_cd`),
  KEY `rowID` (`rowID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sa_expense
-- ----------------------------
INSERT INTO `sa_expense` VALUES ('1', '1101', 'PERLENGKAPAN KANTOR', '4', '6', '6', '6', '6', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-08', '11:02:01', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_expense` VALUES ('2', '1102', 'TELPON & FAX', '3', '6', '6', '6', '6', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-08', '11:01:40', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_expense` VALUES ('3', '1103', 'TRANSPORT,TOLL DLL', '1', '6', '6', '6', '6', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-08', '11:01:28', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_expense` VALUES ('4', '1104', 'LISTRIK', '3', '6', '6', '6', '6', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-08', '11:01:17', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_expense` VALUES ('5', '1105', 'AIR', '3', '6', '6', '6', '6', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '1', '2016-09-13', '17:03:04', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_expense` VALUES ('13', 'TES', 'TESTING1', '2', '11', '15', '18', '20', '0', '0', '1901-01-01', '00:00:00', '1', '11', '2016-09-13', '16:22:37', '11', '2016-09-13', '16:25:28', '11', '2016-09-13', '16:26:05');

-- ----------------------------
-- Table structure for sa_fare_commission
-- ----------------------------
DROP TABLE IF EXISTS `sa_fare_commission`;
CREATE TABLE `sa_fare_commission` (
  `fare_trip_hdr_rowID` int(11) NOT NULL,
  `vehicle_type_rowID` int(11) NOT NULL,
  `row_no` int(11) NOT NULL DEFAULT '0',
  `container_size` varchar(10) NOT NULL DEFAULT '',
  `mix_weight` int(11) NOT NULL DEFAULT '0',
  `max_weight` int(11) NOT NULL DEFAULT '0',
  `min_delivered_weight` int(11) NOT NULL DEFAULT '0',
  `max_delivered_weight` int(11) NOT NULL DEFAULT '0',
  `fare_driver_amt` double NOT NULL DEFAULT '0',
  `fare_helper_amt` double NOT NULL DEFAULT '0',
  `over_weight_amt` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`fare_trip_hdr_rowID`,`vehicle_type_rowID`,`row_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sa_fare_commission
-- ----------------------------

-- ----------------------------
-- Table structure for sa_fare_trip
-- ----------------------------
DROP TABLE IF EXISTS `sa_fare_trip`;
CREATE TABLE `sa_fare_trip` (
  `rowID` smallint(6) NOT NULL AUTO_INCREMENT,
  `effective_date` date NOT NULL,
  `vehicle_type_rowID` smallint(6) NOT NULL,
  `destination_from_rowID` smallint(6) NOT NULL,
  `destination_to_rowID` smallint(6) NOT NULL,
  `distance` smallint(6) DEFAULT NULL,
  `fare_trip_rate` decimal(10,0) DEFAULT '0',
  `fuel_rate` decimal(10,0) DEFAULT '0',
  `tol_rate` decimal(10,0) DEFAULT '0',
  `load_rate` decimal(10,0) DEFAULT '0',
  `unload_rate` decimal(10,0) DEFAULT '0',
  `other_rate` decimal(10,0) DEFAULT '0',
  `printed` tinyint(4) DEFAULT NULL,
  `user_printed` int(11) DEFAULT NULL,
  `date_printed` date DEFAULT NULL,
  `time_printed` time DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT '0',
  `user_created` int(11) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `time_created` time DEFAULT NULL,
  `user_modified` int(11) DEFAULT NULL,
  `date_modified` date DEFAULT NULL,
  `time_modified` time DEFAULT NULL,
  `user_deleted` int(11) DEFAULT NULL,
  `date_deleted` date DEFAULT NULL,
  `time_deleted` time DEFAULT NULL,
  PRIMARY KEY (`rowID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sa_fare_trip
-- ----------------------------

-- ----------------------------
-- Table structure for sa_fare_trip_dtl
-- ----------------------------
DROP TABLE IF EXISTS `sa_fare_trip_dtl`;
CREATE TABLE `sa_fare_trip_dtl` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `fare_trip_hdr_rowID` int(11) NOT NULL DEFAULT '0',
  `vehicle_type_rowID` int(11) NOT NULL DEFAULT '0',
  `row_no` int(11) NOT NULL,
  `cost_rowID` int(11) NOT NULL DEFAULT '0',
  `reference_id` int(11) NOT NULL,
  `fare_trip_amt` double NOT NULL DEFAULT '0',
  `effective_date` date NOT NULL DEFAULT '1901-01-01',
  `available` char(1) NOT NULL DEFAULT 'Y',
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`)
) ENGINE=InnoDB AUTO_INCREMENT=241 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sa_fare_trip_dtl
-- ----------------------------
INSERT INTO `sa_fare_trip_dtl` VALUES ('1', '1', '0', '1', '0', '1', '305000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '16:37:24', '1', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('2', '2', '0', '1', '0', '1', '545000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '16:38:38', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('3', '3', '0', '1', '0', '1', '608000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '16:53:07', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('4', '4', '0', '1', '0', '1', '275000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '16:55:44', '1', '11', '2016-09-05', '16:56:02');
INSERT INTO `sa_fare_trip_dtl` VALUES ('5', '5', '0', '1', '0', '1', '275000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '16:55:44', '1', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('6', '6', '0', '1', '0', '1', '545000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '16:57:36', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('7', '7', '0', '1', '0', '1', '608000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '16:58:26', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('8', '8', '0', '1', '0', '1', '890000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:02:45', '1', '1', '2016-11-09', '16:38:23');
INSERT INTO `sa_fare_trip_dtl` VALUES ('9', '9', '0', '1', '0', '1', '440000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:05:11', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('10', '10', '0', '1', '0', '2', '585000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:06:26', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('11', '11', '0', '1', '0', '1', '470000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:07:25', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('12', '12', '0', '1', '0', '1', '525000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:08:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('13', '13', '0', '1', '0', '1', '2200000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:09:50', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('14', '14', '0', '1', '0', '1', '3500000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:15:30', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('15', '15', '0', '1', '0', '1', '940000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:17:57', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('16', '16', '0', '1', '0', '1', '875000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:20:02', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('17', '17', '0', '1', '0', '1', '920000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:22:59', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('18', '18', '0', '1', '0', '1', '875000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:23:43', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('19', '19', '0', '1', '0', '1', '735000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:29:03', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('20', '20', '0', '1', '0', '1', '525000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:30:31', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('21', '21', '0', '1', '0', '1', '545000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:31:20', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('22', '22', '0', '1', '0', '1', '525000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:32:29', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('23', '23', '0', '1', '0', '1', '545000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:33:05', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('24', '24', '0', '1', '0', '1', '525000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:33:56', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('25', '25', '0', '1', '0', '1', '545000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:34:22', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('26', '26', '0', '1', '0', '1', '755000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:35:13', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('27', '27', '0', '1', '0', '1', '90000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:35:52', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('28', '28', '0', '1', '0', '1', '90000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:36:23', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('29', '29', '0', '1', '0', '1', '525000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:37:30', '1', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('30', '30', '0', '1', '0', '1', '545000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:37:54', '1', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('31', '31', '0', '1', '0', '1', '735000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:38:32', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('32', '32', '0', '1', '0', '1', '525000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:39:37', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('33', '33', '0', '1', '0', '1', '545000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:40:29', '1', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('34', '34', '0', '1', '0', '1', '130000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:42:41', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('35', '35', '0', '1', '0', '1', '300000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:43:45', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('36', '36', '0', '1', '0', '1', '300000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:44:13', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('37', '37', '0', '1', '0', '1', '890000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:52:39', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('38', '38', '0', '1', '0', '1', '1550000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:55:09', '1', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('39', '39', '0', '1', '0', '1', '880000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:55:47', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('40', '40', '0', '1', '0', '1', '825000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:56:02', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('41', '41', '0', '1', '0', '1', '1197000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:00:51', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('42', '42', '0', '1', '0', '1', '1197000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:01:18', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('43', '43', '0', '1', '0', '1', '608000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:04:05', '1', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('44', '44', '0', '1', '0', '1', '593000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:04:18', '1', '2', '2016-10-14', '08:16:13');
INSERT INTO `sa_fare_trip_dtl` VALUES ('45', '45', '0', '1', '0', '1', '608000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:04:58', '1', '2', '2016-10-14', '08:13:59');
INSERT INTO `sa_fare_trip_dtl` VALUES ('46', '46', '0', '1', '0', '1', '545000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:07:13', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('47', '47', '0', '1', '0', '1', '3154000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:08:46', '1', '1', '2016-10-18', '01:26:45');
INSERT INTO `sa_fare_trip_dtl` VALUES ('48', '48', '0', '1', '0', '1', '3154000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:10:48', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('49', '49', '0', '1', '0', '1', '618000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:11:43', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('50', '50', '0', '1', '0', '1', '650000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:12:25', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('51', '51', '0', '1', '0', '1', '670000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:12:50', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('52', '52', '0', '1', '0', '1', '545000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:13:45', '1', '2', '2016-10-17', '10:08:22');
INSERT INTO `sa_fare_trip_dtl` VALUES ('53', '53', '0', '1', '0', '1', '525000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:14:17', '1', '2', '2016-10-17', '10:08:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('54', '54', '0', '1', '0', '1', '560000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:16:25', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('55', '55', '0', '1', '0', '1', '545000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:18:14', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('56', '56', '0', '1', '0', '1', '560000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:22:19', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('57', '57', '0', '1', '0', '1', '915000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:38:41', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('58', '58', '0', '1', '0', '1', '810000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:40:08', '1', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('59', '59', '0', '1', '0', '1', '1020000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:40:49', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('60', '60', '0', '1', '0', '1', '810000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:41:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('61', '61', '0', '1', '0', '1', '275000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:42:21', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('62', '62', '0', '1', '0', '1', '275000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:43:21', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('63', '63', '0', '1', '0', '1', '270000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:43:52', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('64', '64', '0', '1', '0', '1', '270000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:44:25', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('65', '65', '0', '1', '0', '1', '1775000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:45:16', '1', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('66', '66', '0', '1', '0', '1', '735000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:46:07', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('67', '67', '0', '1', '0', '1', '660000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:46:59', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('68', '68', '0', '1', '0', '1', '625000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:48:01', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('69', '69', '0', '1', '0', '1', '855000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:48:46', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('70', '70', '0', '1', '0', '1', '275000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:49:52', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('71', '71', '0', '1', '0', '1', '200000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:50:32', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('72', '72', '0', '1', '0', '1', '830000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:51:47', '1', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('73', '73', '0', '1', '0', '1', '830000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:52:02', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('74', '74', '0', '1', '0', '1', '890000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:52:34', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('75', '75', '0', '1', '0', '1', '1085000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:53:14', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('76', '76', '0', '1', '0', '1', '1370000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:54:57', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('77', '77', '0', '1', '0', '1', '520000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:56:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('78', '78', '0', '1', '0', '1', '815000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '2', '2016-09-08', '11:54:51', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('79', '79', '0', '1', '0', '2', '560000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:17:16', '1', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('80', '80', '0', '1', '0', '1', '620000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:20:28', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('81', '81', '0', '1', '0', '2', '560000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:20:44', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('82', '82', '0', '1', '0', '1', '855000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '2', '2016-09-08', '13:20:57', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('83', '83', '0', '1', '0', '1', '940000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '2', '2016-09-08', '13:22:24', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('84', '84', '0', '1', '0', '1', '620000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:22:58', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('85', '85', '0', '1', '0', '1', '1835000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '2', '2016-09-08', '13:23:09', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('86', '86', '0', '1', '0', '1', '1050000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:23:58', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('87', '87', '0', '1', '0', '1', '965000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '2', '2016-09-08', '13:27:26', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('88', '88', '0', '1', '0', '1', '955000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '2', '2016-09-08', '13:28:02', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('89', '89', '0', '1', '0', '1', '720000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:28:32', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('90', '90', '0', '1', '0', '1', '1025000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '2', '2016-09-08', '13:28:35', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('91', '91', '0', '1', '0', '1', '830000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '2', '2016-09-08', '13:29:08', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('92', '92', '0', '1', '0', '1', '685000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:29:15', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('93', '93', '0', '1', '0', '1', '940000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '2', '2016-09-08', '13:30:07', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('94', '94', '0', '1', '0', '1', '830000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '2', '2016-09-08', '13:30:35', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('95', '95', '0', '1', '0', '1', '1005000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '2', '2016-09-08', '13:31:17', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('96', '96', '0', '1', '0', '1', '1200000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '2', '2016-09-08', '13:31:50', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('97', '97', '0', '1', '0', '1', '1230000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:31:53', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('98', '98', '0', '1', '0', '1', '1915000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '2', '2016-09-08', '13:32:24', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('99', '99', '0', '1', '0', '1', '550000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:32:36', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('100', '100', '0', '1', '0', '1', '895000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '2', '2016-09-08', '13:33:02', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('101', '101', '0', '1', '0', '1', '2320000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '2', '2016-09-08', '13:33:41', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('102', '102', '0', '1', '0', '1', '2220000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '2', '2016-09-08', '13:34:09', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('103', '103', '0', '1', '0', '1', '890000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '2', '2016-09-08', '13:34:37', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('104', '104', '0', '1', '0', '1', '1200000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '2', '2016-09-08', '13:35:12', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('105', '105', '0', '1', '0', '1', '825000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '2', '2016-09-08', '13:35:36', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('106', '106', '0', '1', '0', '1', '500000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:37:22', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('107', '107', '0', '1', '0', '1', '630000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:37:59', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('108', '108', '0', '1', '0', '1', '390000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:38:37', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('109', '109', '0', '1', '0', '1', '630000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:39:14', '1', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('110', '110', '0', '1', '0', '1', '560000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:39:50', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('111', '111', '0', '1', '0', '1', '560000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:40:59', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('112', '112', '0', '1', '0', '1', '560000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:41:36', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('113', '113', '0', '1', '0', '1', '755000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:42:42', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('114', '114', '0', '1', '0', '1', '630000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:43:07', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('115', '115', '0', '1', '0', '1', '755000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:43:49', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('116', '116', '0', '1', '0', '1', '670000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:44:42', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('117', '117', '0', '1', '0', '1', '1400000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:45:43', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('118', '118', '0', '1', '0', '1', '975000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:46:32', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('119', '119', '0', '1', '0', '1', '1230000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:51:41', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('120', '120', '0', '1', '0', '2', '835000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:53:07', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('121', '121', '0', '1', '0', '1', '1275000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:53:56', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('122', '122', '0', '1', '0', '1', '1230000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:56:09', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('123', '123', '0', '1', '0', '1', '1050000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:56:52', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('124', '124', '0', '1', '0', '1', '200000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:57:52', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('125', '125', '0', '1', '0', '1', '200000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:58:35', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('126', '126', '0', '1', '0', '1', '705000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '14:00:16', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('127', '127', '0', '1', '0', '1', '705000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '14:01:04', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('128', '128', '0', '1', '0', '1', '450000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '14:01:50', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('129', '129', '0', '1', '0', '1', '1230000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '14:02:49', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('130', '130', '0', '1', '0', '1', '280000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '14:03:30', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('131', '131', '0', '1', '0', '1', '1230000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '14:04:41', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('132', '132', '0', '1', '0', '1', '1420000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '14:05:28', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('133', '133', '0', '1', '0', '1', '1275000', '2016-09-08', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '14:06:24', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('134', '134', '0', '1', '0', '1', '275000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '1', '2016-09-24', '23:34:06', '1', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('135', '135', '0', '1', '0', '1', '275000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '1', '2016-09-25', '00:24:18', '1', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('136', '136', '0', '1', '0', '1', '535000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '1', '2016-09-25', '09:36:21', '1', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('137', '137', '0', '1', '0', '1', '545000', '2016-09-26', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '2', '2016-09-26', '10:03:45', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('138', '138', '0', '1', '0', '1', '535000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '2', '2016-09-26', '10:12:26', '1', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('139', '139', '0', '1', '0', '1', '120000', '2016-09-26', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '2', '2016-09-26', '17:07:22', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('140', '140', '0', '1', '0', '1', '3154000', '2016-09-26', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '2', '2016-09-26', '18:04:55', '1', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('141', '141', '0', '1', '0', '1', '3154000', '2016-09-26', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '2', '2016-09-26', '18:12:57', '1', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('142', '142', '0', '1', '0', '1', '3154000', '2016-09-26', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '1', '2016-09-26', '18:20:14', '1', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('143', '143', '0', '1', '0', '1', '3154000', '2016-09-26', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '1', '2016-09-26', '18:21:12', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('144', '144', '0', '1', '0', '1', '535000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '1', '2016-09-26', '19:45:57', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('145', '145', '0', '1', '0', '1', '535000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '1', '2016-09-26', '19:46:12', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('146', '146', '0', '1', '0', '1', '275000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '1', '2016-09-26', '20:17:55', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('147', '147', '0', '1', '0', '1', '275000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '1', '2016-09-26', '20:18:10', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('148', '148', '0', '1', '0', '2', '495000', '2016-09-27', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '1', '2016-09-27', '01:25:25', '1', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('149', '149', '0', '1', '0', '2', '495000', '2016-09-27', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '2', '2016-09-27', '08:52:29', '1', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('150', '150', '0', '1', '0', '1', '855000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '2', '2016-09-27', '15:10:12', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('151', '151', '0', '1', '0', '1', '555000', '2016-09-27', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '2', '2016-09-27', '15:18:45', '1', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('152', '152', '0', '1', '0', '1', '555000', '2016-09-27', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '2', '2016-09-27', '15:22:24', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('153', '153', '0', '1', '0', '2', '495000', '2016-09-27', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '2', '2016-09-28', '09:12:15', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('154', '154', '0', '1', '0', '1', '475000', '2016-09-28', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '1', '2016-09-28', '10:50:24', '1', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('155', '155', '0', '1', '0', '1', '475000', '2016-09-28', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '1', '2016-09-28', '10:50:53', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('156', '156', '0', '1', '0', '2', '130000', '2016-09-28', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '1', '2016-09-28', '14:04:26', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('157', '157', '0', '1', '0', '1', '275000', '2016-09-28', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '1', '2016-09-28', '14:06:13', '1', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('158', '158', '0', '1', '0', '1', '275000', '2016-09-28', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '1', '2016-09-28', '14:06:47', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('159', '159', '0', '1', '0', '1', '495000', '2016-09-27', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '1', '2016-09-28', '18:34:19', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('160', '160', '0', '1', '0', '1', '855000', '2016-09-29', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '1', '2016-09-29', '16:39:09', '1', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('161', '161', '0', '1', '0', '1', '855000', '2016-09-29', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '1', '2016-09-29', '16:39:49', '1', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('162', '162', '0', '1', '0', '1', '855000', '2016-09-29', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '1', '2016-09-29', '16:40:13', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('163', '163', '0', '1', '0', '1', '245000', '2016-09-30', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '2', '2016-09-30', '17:40:55', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('164', '164', '0', '1', '0', '1', '130000', '2016-09-30', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '2', '2016-09-30', '17:43:29', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('165', '165', '0', '1', '0', '1', '245000', '2016-09-30', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '1', '2016-09-30', '21:53:01', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('166', '166', '0', '1', '0', '2', '525000', '2016-10-02', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '1', '2016-10-02', '11:54:56', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('167', '167', '0', '1', '0', '1', '535000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '2', '2016-10-03', '10:28:42', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('168', '168', '0', '1', '0', '2', '545000', '2016-10-04', 'Y', '0', '0', '1901-01-01', '00:00:00', '1', '2016-10-04', '20:26:13', '0', '1901-01-01', '00:00:00', '1', '2', '2016-10-07', '10:42:26');
INSERT INTO `sa_fare_trip_dtl` VALUES ('169', '169', '0', '1', '0', '1', '1600000', '2016-10-06', 'Y', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-06', '10:27:52', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('170', '170', '0', '1', '0', '1', '530000', '2016-10-06', 'Y', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-06', '10:44:02', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('171', '171', '0', '1', '0', '2', '925000', '2016-10-06', 'Y', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-06', '10:52:43', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('172', '172', '0', '1', '0', '2', '735000', '2016-10-06', 'Y', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-06', '13:46:39', '0', '1901-01-01', '00:00:00', '1', '2', '2016-10-06', '13:50:56');
INSERT INTO `sa_fare_trip_dtl` VALUES ('173', '173', '0', '1', '0', '2', '735000', '2016-10-06', 'Y', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-06', '13:50:56', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('174', '174', '0', '1', '0', '1', '545000', '2016-10-07', 'Y', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-07', '08:20:44', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('175', '175', '0', '1', '0', '1', '545000', '2016-10-07', 'Y', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-07', '08:27:40', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('176', '176', '0', '1', '0', '1', '735000', '2016-10-07', 'Y', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-07', '08:45:57', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('177', '177', '0', '1', '0', '1', '580000', '2016-10-07', 'Y', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-07', '08:50:19', '0', '1901-01-01', '00:00:00', '1', '2', '2016-10-07', '11:14:18');
INSERT INTO `sa_fare_trip_dtl` VALUES ('178', '178', '0', '1', '0', '1', '275000', '2016-10-07', 'Y', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-07', '09:24:22', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('179', '179', '0', '1', '0', '1', '525000', '2016-10-07', 'Y', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-07', '10:14:23', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('180', '180', '0', '1', '0', '1', '525000', '2016-10-07', 'Y', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-07', '10:31:34', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('181', '181', '0', '1', '0', '2', '525000', '2016-10-04', 'Y', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-07', '10:42:26', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('182', '182', '0', '1', '0', '1', '545000', '2016-10-07', 'Y', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-07', '11:14:18', '0', '1901-01-01', '00:00:00', '1', '2', '2016-10-07', '11:16:33');
INSERT INTO `sa_fare_trip_dtl` VALUES ('183', '183', '0', '1', '0', '1', '535000', '2016-10-07', 'Y', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-07', '11:16:33', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('184', '184', '0', '1', '0', '1', '545000', '2016-10-07', 'Y', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-07', '13:57:44', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('185', '185', '0', '1', '0', '2', '90000', '2016-10-09', 'Y', '0', '0', '1901-01-01', '00:00:00', '1', '2016-10-09', '15:29:41', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('186', '186', '0', '1', '0', '1', '90000', '2016-10-09', 'Y', '0', '0', '1901-01-01', '00:00:00', '1', '2016-10-09', '15:30:28', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('187', '187', '0', '1', '0', '1', '545000', '2016-10-10', 'Y', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-10', '13:17:53', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('188', '188', '0', '1', '0', '1', '735000', '2016-10-10', 'Y', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-10', '13:29:46', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('189', '189', '0', '1', '0', '1', '855000', '2016-10-11', 'Y', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-11', '08:35:54', '0', '1901-01-01', '00:00:00', '1', '2', '2016-10-11', '08:37:07');
INSERT INTO `sa_fare_trip_dtl` VALUES ('190', '190', '0', '1', '0', '1', '925000', '2016-10-11', 'Y', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-11', '08:37:07', '0', '1901-01-01', '00:00:00', '1', '1', '2016-10-16', '21:36:40');
INSERT INTO `sa_fare_trip_dtl` VALUES ('191', '191', '0', '1', '0', '1', '250000', '2016-10-12', 'Y', '0', '0', '1901-01-01', '00:00:00', '1', '2016-10-12', '23:18:16', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('192', '192', '0', '1', '0', '1', '250000', '2016-10-12', 'Y', '0', '0', '1901-01-01', '00:00:00', '1', '2016-10-12', '23:18:53', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('193', '193', '0', '1', '0', '1', '150000', '2016-10-13', 'Y', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-13', '14:22:27', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('194', '194', '0', '1', '0', '1', '150000', '2016-10-13', 'Y', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-13', '14:23:07', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('195', '195', '0', '1', '0', '1', '743000', '2016-10-13', 'Y', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-13', '17:14:38', '0', '1901-01-01', '00:00:00', '1', '2', '2016-10-14', '08:15:53');
INSERT INTO `sa_fare_trip_dtl` VALUES ('196', '196', '0', '1', '0', '2', '593000', '2016-10-13', 'Y', '0', '0', '1901-01-01', '00:00:00', '1', '2016-10-13', '17:39:52', '0', '1901-01-01', '00:00:00', '1', '2', '2016-10-14', '08:14:28');
INSERT INTO `sa_fare_trip_dtl` VALUES ('197', '197', '0', '1', '0', '1', '545000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-14', '08:13:59', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('198', '198', '0', '1', '0', '2', '525000', '2016-10-13', 'Y', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-14', '08:14:28', '0', '1901-01-01', '00:00:00', '1', '2', '2016-10-14', '08:19:30');
INSERT INTO `sa_fare_trip_dtl` VALUES ('199', '199', '0', '1', '0', '1', '735000', '2016-10-13', 'Y', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-14', '08:15:53', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('200', '200', '0', '1', '0', '1', '525000', '2016-10-13', 'Y', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-14', '08:19:30', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('201', '201', '0', '1', '0', '2', '245000', '2016-10-15', 'Y', '0', '0', '1901-01-01', '00:00:00', '1', '2016-10-15', '10:01:00', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('202', '202', '0', '1', '0', '2', '275000', '2016-10-15', 'Y', '0', '0', '1901-01-01', '00:00:00', '1', '2016-10-15', '18:01:42', '0', '1901-01-01', '00:00:00', '1', '1', '2016-10-15', '18:02:49');
INSERT INTO `sa_fare_trip_dtl` VALUES ('203', '203', '0', '1', '0', '1', '275000', '2016-10-15', 'Y', '0', '0', '1901-01-01', '00:00:00', '1', '2016-10-15', '18:02:28', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('204', '204', '0', '1', '0', '2', '275000', '2016-10-15', 'Y', '0', '0', '1901-01-01', '00:00:00', '1', '2016-10-15', '18:02:49', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('205', '205', '0', '1', '0', '1', '925000', '2016-10-11', 'Y', '0', '0', '1901-01-01', '00:00:00', '1', '2016-10-16', '21:36:40', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('206', '206', '0', '1', '0', '1', '525000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-17', '10:08:00', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('207', '207', '0', '1', '0', '1', '545000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-17', '10:08:22', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('208', '208', '0', '1', '0', '1', '525000', '2016-10-17', 'Y', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-17', '11:15:44', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('209', '209', '0', '1', '0', '1', '525000', '2016-10-17', 'Y', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-17', '11:16:58', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('210', '210', '0', '1', '0', '2', '525000', '2016-10-17', 'Y', '0', '0', '1901-01-01', '00:00:00', '1', '2016-10-17', '13:32:37', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('211', '211', '0', '1', '0', '1', '855000', '2016-10-17', 'Y', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-17', '14:11:03', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('212', '212', '0', '1', '0', '1', '1600000', '2016-10-17', 'Y', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-17', '14:12:03', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('213', '213', '0', '1', '0', '1', '3154000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '1', '2016-10-18', '01:26:45', '0', '1901-01-01', '00:00:00', '1', '1', '2016-10-18', '01:27:22');
INSERT INTO `sa_fare_trip_dtl` VALUES ('214', '214', '0', '1', '0', '1', '3154000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '1', '2016-10-18', '01:27:22', '0', '1901-01-01', '00:00:00', '1', '1', '2016-10-18', '01:36:50');
INSERT INTO `sa_fare_trip_dtl` VALUES ('215', '215', '0', '1', '0', '1', '3154000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '1', '2016-10-18', '01:36:50', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('216', '216', '0', '1', '0', '1', '593000', '2016-10-18', 'Y', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-18', '10:50:19', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('217', '217', '0', '1', '0', '1', '545000', '2016-10-18', 'Y', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-18', '16:38:43', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('218', '218', '0', '1', '0', '1', '525000', '2016-10-18', 'Y', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-18', '16:39:14', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('219', '219', '0', '1', '0', '1', '525000', '2016-10-18', 'Y', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-18', '16:40:53', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('220', '220', '0', '1', '0', '1', '890000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-09', '16:38:23', '0', '1901-01-01', '00:00:00', '1', '1', '2016-11-09', '16:38:44');
INSERT INTO `sa_fare_trip_dtl` VALUES ('221', '221', '0', '1', '0', '1', '890000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-09', '16:38:44', '0', '1901-01-01', '00:00:00', '1', '1', '2016-11-09', '16:39:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('222', '222', '0', '1', '0', '1', '890000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-09', '16:39:00', '0', '1901-01-01', '00:00:00', '1', '1', '2016-11-09', '16:44:09');
INSERT INTO `sa_fare_trip_dtl` VALUES ('223', '223', '0', '1', '0', '1', '890000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-09', '16:44:09', '0', '1901-01-01', '00:00:00', '1', '1', '2016-11-09', '16:52:17');
INSERT INTO `sa_fare_trip_dtl` VALUES ('224', '223', '0', '1', '0', '1', '890000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-09', '16:49:07', '0', '1901-01-01', '00:00:00', '1', '1', '2016-11-09', '16:52:17');
INSERT INTO `sa_fare_trip_dtl` VALUES ('225', '223', '0', '2', '0', '2', '10000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-09', '16:49:07', '0', '1901-01-01', '00:00:00', '1', '1', '2016-11-09', '16:52:17');
INSERT INTO `sa_fare_trip_dtl` VALUES ('226', '223', '0', '1', '0', '1', '890000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-09', '16:52:17', '0', '1901-01-01', '00:00:00', '1', '1', '2016-11-09', '16:54:32');
INSERT INTO `sa_fare_trip_dtl` VALUES ('227', '223', '0', '1', '0', '1', '890000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-09', '16:54:32', '0', '1901-01-01', '00:00:00', '1', '1', '2016-11-09', '17:06:56');
INSERT INTO `sa_fare_trip_dtl` VALUES ('228', '224', '0', '1', '0', '2', '100000', '2016-11-09', 'Y', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-09', '16:58:33', '0', '1901-01-01', '00:00:00', '1', '1', '2016-11-09', '17:02:21');
INSERT INTO `sa_fare_trip_dtl` VALUES ('229', '224', '0', '1', '0', '2', '1000000', '2016-11-09', 'Y', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-09', '17:00:09', '0', '1901-01-01', '00:00:00', '1', '1', '2016-11-09', '17:02:21');
INSERT INTO `sa_fare_trip_dtl` VALUES ('230', '224', '0', '2', '0', '1', '100000', '2016-11-09', 'Y', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-09', '17:00:09', '0', '1901-01-01', '00:00:00', '1', '1', '2016-11-09', '17:02:21');
INSERT INTO `sa_fare_trip_dtl` VALUES ('231', '224', '0', '1', '0', '1', '1000000', '2016-11-09', 'Y', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-09', '17:00:45', '0', '1901-01-01', '00:00:00', '1', '1', '2016-11-09', '17:02:21');
INSERT INTO `sa_fare_trip_dtl` VALUES ('232', '224', '0', '2', '0', '2', '100000', '2016-11-09', 'Y', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-09', '17:00:45', '0', '1901-01-01', '00:00:00', '1', '1', '2016-11-09', '17:02:21');
INSERT INTO `sa_fare_trip_dtl` VALUES ('233', '223', '0', '1', '0', '1', '890000', '2016-09-05', 'Y', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-09', '17:06:56', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_dtl` VALUES ('234', '225', '0', '1', '0', '1', '150000', '2016-11-09', 'Y', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-09', '17:28:15', '0', '1901-01-01', '00:00:00', '1', '1', '2016-11-09', '17:32:10');
INSERT INTO `sa_fare_trip_dtl` VALUES ('235', '225', '0', '2', '0', '2', '0', '2016-11-09', 'Y', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-09', '17:28:15', '0', '1901-01-01', '00:00:00', '1', '1', '2016-11-09', '17:32:10');
INSERT INTO `sa_fare_trip_dtl` VALUES ('236', '225', '0', '1', '0', '1', '150000', '2016-11-09', 'Y', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-09', '17:30:49', '0', '1901-01-01', '00:00:00', '1', '1', '2016-11-09', '17:32:10');
INSERT INTO `sa_fare_trip_dtl` VALUES ('237', '225', '0', '2', '0', '2', '50000', '2016-11-09', 'Y', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-09', '17:30:49', '0', '1901-01-01', '00:00:00', '1', '1', '2016-11-09', '17:32:10');
INSERT INTO `sa_fare_trip_dtl` VALUES ('238', '226', '0', '1', '0', '1', '1000000', '2016-11-09', 'Y', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-09', '17:33:51', '0', '1901-01-01', '00:00:00', '1', '1', '2016-11-09', '17:35:05');
INSERT INTO `sa_fare_trip_dtl` VALUES ('239', '226', '0', '1', '0', '1', '1000000', '2016-11-09', 'Y', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-09', '17:34:31', '0', '1901-01-01', '00:00:00', '1', '1', '2016-11-09', '17:35:05');
INSERT INTO `sa_fare_trip_dtl` VALUES ('240', '226', '0', '2', '0', '2', '300000', '2016-11-09', 'Y', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-09', '17:34:31', '0', '1901-01-01', '00:00:00', '1', '1', '2016-11-09', '17:35:05');

-- ----------------------------
-- Table structure for sa_fare_trip_hdr
-- ----------------------------
DROP TABLE IF EXISTS `sa_fare_trip_hdr`;
CREATE TABLE `sa_fare_trip_hdr` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `destination_from_rowID` int(11) NOT NULL DEFAULT '0',
  `destination_to_rowID` int(11) NOT NULL DEFAULT '0',
  `fare_trip_no` varchar(20) NOT NULL DEFAULT '',
  `fare_trip_cd` varchar(20) NOT NULL DEFAULT '',
  `distance` int(11) NOT NULL DEFAULT '0',
  `trip_condition` enum('short distance','long distance','pok') NOT NULL,
  `poin` int(5) NOT NULL,
  `split` int(1) NOT NULL,
  `trip_type` char(2) NOT NULL,
  `komisi_supir` double NOT NULL,
  `komisi_kernet` double(11,0) NOT NULL,
  `deposit` double NOT NULL,
  `min_amount` double NOT NULL,
  `os_amount` double NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `cost_id` int(11) NOT NULL,
  `total` double NOT NULL,
  `estimated_time_receipt` int(11) NOT NULL,
  `effective_date` date NOT NULL DEFAULT '1901-01-01',
  `note` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`,`destination_from_rowID`,`destination_to_rowID`),
  KEY `rowID` (`rowID`),
  KEY `destination_from_rowID` (`destination_from_rowID`),
  KEY `destination_to_rowID` (`destination_to_rowID`),
  KEY `fare_trip_cd` (`fare_trip_cd`)
) ENGINE=InnoDB AUTO_INCREMENT=227 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sa_fare_trip_hdr
-- ----------------------------
INSERT INTO `sa_fare_trip_hdr` VALUES ('1', '82', '22', '', 'KPO-BLJ', '0', 'short distance', '0', '0', '1', '40000', '15000', '0', '0', '0', '4', '2', '275000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '16:37:24', '1', '2016-09-25', '00:24:18', '1', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('2', '50', '22', '', 'CGD-BLJ', '0', 'short distance', '0', '0', '1', '82500', '15000', '0', '0', '0', '5', '2', '545000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '16:38:38', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('3', '50', '82', '', 'CGD-KPO', '0', 'short distance', '0', '0', '1', '67500', '15000', '0', '0', '0', '5', '2', '608000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '16:53:07', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('4', '82', '22', '', 'KPO-BLJ', '0', 'short distance', '0', '0', '1', '40000', '15000', '0', '0', '0', '5', '2', '275000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '16:55:44', '0', '1901-01-01', '00:00:00', '1', '11', '2016-09-05', '16:56:02');
INSERT INTO `sa_fare_trip_hdr` VALUES ('5', '82', '22', '', 'KPO-BLJ', '0', 'short distance', '0', '0', '1', '40000', '15000', '0', '0', '0', '5', '2', '275000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '16:55:44', '1', '2016-09-24', '23:34:06', '1', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('6', '50', '22', '', 'CGD-BLJ', '0', 'short distance', '0', '0', '1', '82500', '15000', '0', '0', '0', '4', '2', '545000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '16:57:36', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('7', '50', '82', '', 'CGD-KPO', '0', 'short distance', '0', '0', '1', '67500', '15000', '0', '0', '0', '4', '2', '608000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '16:58:26', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('8', '11', '22', '', '009-BLJ', '0', 'short distance', '0', '0', '2', '110000', '20000', '0', '0', '0', '2', '2', '890000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:02:45', '0', '1901-01-01', '00:00:00', '1', '1', '2016-11-09', '16:38:23');
INSERT INTO `sa_fare_trip_hdr` VALUES ('9', '15', '123', '', '114-SAS', '0', 'short distance', '0', '0', '1', '45000', '15000', '0', '0', '0', '4', '2', '440000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:05:11', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('10', '15', '96', '', '114-PD', '0', 'short distance', '0', '0', '1', '65000', '15000', '0', '0', '0', '4', '2', '585000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:06:26', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('11', '15', '87', '', '114-LUM', '0', 'short distance', '0', '0', '1', '55000', '15000', '0', '0', '0', '4', '2', '470000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:07:25', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('12', '15', '48', '', '114-CBT', '0', 'short distance', '0', '0', '1', '45000', '15000', '0', '0', '0', '4', '2', '525000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:08:00', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('13', '29', '22', '', '300-BLJ', '0', 'short distance', '0', '0', '2', '79750', '20000', '0', '0', '0', '3', '2', '2200000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:09:50', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('14', '29', '22', '', '300-BLJ', '0', 'short distance', '0', '0', '2', '110000', '20000', '0', '0', '0', '2', '2', '3500000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:15:30', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('15', '30', '22', '', '301-BLJ', '0', 'short distance', '0', '0', '2', '100000', '20000', '0', '0', '0', '2', '2', '940000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:17:57', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('16', '30', '22', '', '301-BLJ', '0', 'short distance', '0', '0', '2', '79750', '20000', '0', '0', '0', '3', '2', '875000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:20:02', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('17', '36', '22', '', 'AIR-BLJ', '0', 'short distance', '0', '0', '2', '79750', '20000', '0', '0', '0', '3', '2', '920000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:22:59', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('18', '36', '22', '', 'AIR-BLJ', '0', 'short distance', '0', '0', '2', '110000', '20000', '0', '0', '0', '2', '2', '875000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:23:43', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('19', '50', '94', '', 'CGD-NHI', '0', 'short distance', '0', '0', '1', '100000', '17500', '0', '0', '0', '3', '2', '735000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:29:03', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('20', '50', '116', '', 'CGD-KMS', '0', 'short distance', '0', '0', '1', '57500', '15000', '0', '0', '0', '4', '2', '525000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:30:31', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('21', '50', '116', '', 'CGD-KMS', '0', 'short distance', '0', '0', '1', '57500', '15000', '0', '0', '0', '5', '2', '545000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:31:20', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('22', '50', '110', '', 'CGD-TWA', '0', 'short distance', '0', '0', '1', '72500', '15000', '0', '0', '0', '4', '2', '525000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:32:29', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('23', '50', '110', '', 'CGD-TWA', '0', 'short distance', '0', '0', '1', '72500', '15000', '0', '0', '0', '5', '2', '545000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:33:05', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('24', '50', '94', '', 'CGD-NHI', '0', 'short distance', '0', '0', '1', '82500', '15000', '0', '0', '0', '4', '2', '525000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:33:56', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('25', '50', '94', '', 'CGD-NHI', '0', 'short distance', '0', '0', '1', '82500', '15000', '0', '0', '0', '5', '2', '545000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:34:22', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('26', '50', '110', '', 'CGD-TWA', '0', 'short distance', '0', '0', '1', '100000', '17500', '0', '0', '0', '3', '2', '755000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:35:13', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('27', '50', '68', '', 'CGD-GDJ', '0', 'short distance', '0', '0', '1', '0', '0', '0', '0', '0', '4', '2', '90000', '0', '2016-09-05', 'POK', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:35:52', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('28', '50', '67', '', 'CGD-GDI', '0', 'short distance', '0', '0', '1', '0', '0', '0', '0', '0', '4', '2', '90000', '0', '2016-09-05', 'POK', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:36:23', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('29', '50', '137', '', 'CGD-BMM', '0', 'short distance', '0', '0', '1', '77500', '15000', '0', '0', '0', '4', '2', '535000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:37:30', '1', '2016-09-25', '09:36:21', '1', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('30', '50', '137', '', 'CGD-BMM', '0', 'short distance', '0', '0', '1', '77500', '15000', '0', '0', '0', '5', '2', '535000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:37:54', '2', '2016-09-26', '10:12:26', '1', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('31', '50', '137', '', 'CGD-BMM', '0', 'short distance', '0', '0', '1', '90000', '17500', '0', '0', '0', '3', '2', '735000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:38:32', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('32', '50', '115', '', 'CGD-WJK', '0', 'short distance', '0', '0', '1', '67500', '15000', '0', '0', '0', '4', '2', '525000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:39:37', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('33', '50', '115', '', 'CGD-WJK', '0', 'short distance', '0', '0', '1', '67500', '15000', '0', '0', '0', '5', '2', '535000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:40:29', '2', '2016-10-03', '10:28:42', '1', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('34', '50', '160', '', 'CGD-KIE', '0', 'short distance', '0', '0', '1', '0', '0', '0', '0', '0', '4', '2', '130000', '0', '2016-09-05', 'POK', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:42:41', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('35', '50', '140', '', 'CGD-GWM', '0', 'short distance', '0', '0', '1', '35000', '15000', '0', '0', '0', '4', '2', '300000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:43:45', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('36', '50', '140', '', 'CGD-GWM', '0', 'short distance', '0', '0', '1', '35000', '15000', '0', '0', '0', '5', '2', '300000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:44:13', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('37', '16', '101', '', '201-SB', '0', 'short distance', '0', '0', '2', '110000', '20000', '0', '0', '0', '2', '2', '890000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:52:39', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('38', '29', '101', '', '300-SB', '0', 'short distance', '0', '0', '2', '79750', '20000', '0', '0', '0', '3', '2', '825000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:55:09', '11', '2016-09-05', '17:56:02', '1', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('39', '29', '101', '', '300-SB', '0', 'short distance', '0', '0', '2', '110000', '20000', '0', '0', '0', '2', '2', '880000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:55:47', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('40', '29', '101', '', '300-SB', '0', 'short distance', '0', '0', '2', '79750', '20000', '0', '0', '0', '3', '2', '825000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '17:56:02', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('41', '50', '132', '', 'CGD-WLG', '0', 'short distance', '0', '0', '1', '80000', '15000', '0', '0', '0', '4', '2', '1197000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:00:51', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('42', '50', '132', '', 'CGD-WLG', '0', 'short distance', '0', '0', '1', '80000', '15000', '0', '0', '0', '5', '2', '1197000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:01:18', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('43', '50', '143', '', 'CGD-JKS', '0', 'short distance', '0', '0', '1', '67500', '15000', '0', '0', '0', '4', '2', '593000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:04:05', '11', '2016-09-05', '18:04:18', '1', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('44', '50', '143', '', 'CGD-JKS', '0', 'short distance', '0', '0', '1', '67500', '15000', '0', '0', '0', '4', '2', '593000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:04:18', '0', '1901-01-01', '00:00:00', '1', '2', '2016-10-14', '08:16:13');
INSERT INTO `sa_fare_trip_hdr` VALUES ('45', '50', '143', '', 'CGD-JKS', '0', 'short distance', '0', '0', '1', '67500', '15000', '0', '0', '0', '5', '2', '608000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:04:58', '0', '1901-01-01', '00:00:00', '1', '2', '2016-10-14', '08:13:59');
INSERT INTO `sa_fare_trip_hdr` VALUES ('46', '52', '129', '', 'CKD-SBS', '0', 'short distance', '0', '0', '1', '82500', '15000', '0', '0', '0', '5', '2', '545000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:07:13', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('47', '50', '126', '', 'CGD-CRB', '0', 'short distance', '0', '0', '1', '300000', '20000', '0', '0', '0', '3', '2', '3154000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:08:46', '0', '1901-01-01', '00:00:00', '1', '1', '2016-10-18', '01:26:45');
INSERT INTO `sa_fare_trip_hdr` VALUES ('48', '57', '126', '', 'CWD-CRB', '0', 'short distance', '0', '0', '1', '300000', '20000', '0', '0', '0', '3', '2', '3154000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:10:48', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('49', '57', '82', '', 'CWD-KPO', '0', 'short distance', '0', '0', '1', '57500', '15000', '0', '0', '0', '5', '2', '618000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:11:43', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('50', '57', '110', '', 'CWD-TWA', '0', 'short distance', '0', '0', '1', '57500', '15000', '0', '0', '0', '4', '2', '650000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:12:25', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('51', '57', '110', '', 'CWD-TWA', '0', 'short distance', '0', '0', '1', '57500', '15000', '0', '0', '0', '5', '2', '670000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:12:50', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('52', '67', '22', '', 'GDI-BLJ', '0', 'short distance', '0', '0', '1', '72500', '15000', '0', '0', '0', '5', '2', '545000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:13:45', '0', '1901-01-01', '00:00:00', '1', '2', '2016-10-17', '10:08:22');
INSERT INTO `sa_fare_trip_hdr` VALUES ('53', '67', '22', '', 'GDI-BLJ', '0', 'short distance', '0', '0', '1', '72500', '15000', '0', '0', '0', '4', '2', '525000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:14:17', '0', '1901-01-01', '00:00:00', '1', '2', '2016-10-17', '10:08:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('54', '67', '94', '', 'GDI-NHI', '0', 'short distance', '0', '0', '1', '72500', '15000', '0', '0', '0', '5', '2', '560000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:16:25', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('55', '68', '22', '', 'GDJ-BLJ', '0', 'short distance', '0', '0', '1', '82500', '15000', '0', '0', '0', '5', '2', '545000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:18:14', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('56', '68', '94', '', 'GDJ-NHI', '0', 'short distance', '0', '0', '1', '72500', '15000', '0', '0', '0', '5', '2', '560000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:22:19', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('57', '74', '102', '', 'IDR-SEN', '0', 'short distance', '0', '0', '2', '100000', '20000', '0', '0', '0', '2', '2', '915000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:38:41', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('58', '74', '157', '', 'IDR-KBD', '0', 'short distance', '0', '0', '2', '100000', '20000', '0', '0', '0', '2', '2', '810000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:40:08', '11', '2016-09-05', '18:41:00', '1', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('59', '75', '102', '', 'IKT-SEN', '0', 'short distance', '0', '0', '2', '90550', '20000', '0', '0', '0', '3', '2', '1020000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:40:49', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('60', '74', '157', '', 'IDR-KBD', '0', 'short distance', '0', '0', '2', '100000', '20000', '0', '0', '0', '2', '2', '810000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:41:00', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('61', '82', '94', '', 'KPO-NHI', '0', 'short distance', '0', '0', '1', '35000', '15000', '0', '0', '0', '4', '2', '275000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:42:21', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('62', '82', '94', '', 'KPO-NHI', '0', 'short distance', '0', '0', '1', '35000', '15000', '0', '0', '0', '5', '2', '275000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:43:21', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('63', '82', '110', '', 'KPO-TWA', '0', 'short distance', '0', '0', '1', '40000', '15000', '0', '0', '0', '4', '2', '270000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:43:52', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('64', '82', '110', '', 'KPO-TWA', '0', 'short distance', '0', '0', '1', '40000', '15000', '0', '0', '0', '5', '2', '270000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:44:25', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('65', '91', '22', '', 'MRK-BLJ', '0', 'short distance', '0', '0', '2', '110000', '20000', '0', '0', '0', '2', '2', '855000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:45:16', '2', '2016-09-27', '15:10:12', '1', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('66', '91', '22', '', 'MRK-BLJ', '0', 'short distance', '0', '0', '1', '100000', '17500', '0', '0', '0', '3', '2', '735000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:46:07', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('67', '91', '22', '', 'MRK-BLJ', '0', 'short distance', '0', '0', '1', '82500', '15000', '0', '0', '0', '5', '2', '660000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:46:59', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('68', '91', '137', '', 'MRK-BMM', '0', 'short distance', '0', '0', '1', '87500', '15000', '0', '0', '0', '5', '2', '625000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:48:01', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('69', '91', '137', '', 'MRK-BMM', '0', 'short distance', '0', '0', '1', '90000', '17500', '0', '0', '0', '3', '2', '855000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:48:46', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('70', '110', '22', '', 'TWA-BLJ', '0', 'short distance', '0', '0', '1', '35000', '15000', '0', '0', '0', '5', '2', '275000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:49:52', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('71', '110', '94', '', 'TWA-NHI', '0', 'short distance', '0', '0', '1', '20000', '15000', '0', '0', '0', '5', '2', '200000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:50:32', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('72', '111', '22', '', 'UT1-BLJ', '0', 'short distance', '0', '0', '2', '79750', '20000', '0', '0', '0', '3', '2', '830000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:51:47', '11', '2016-09-05', '18:52:02', '1', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('73', '111', '22', '', 'UT1-BLJ', '0', 'short distance', '0', '0', '2', '79750', '20000', '0', '0', '0', '3', '2', '830000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:52:02', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('74', '111', '22', '', 'UT1-BLJ', '0', 'short distance', '0', '0', '2', '100000', '20000', '0', '0', '0', '2', '2', '890000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:52:34', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('75', '111', '52', '', 'UT1-CKD', '0', 'short distance', '0', '0', '2', '86900', '20000', '0', '0', '0', '3', '2', '1085000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:53:14', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('76', '111', '55', '', 'UT1-CLG', '0', 'short distance', '0', '0', '2', '100000', '20000', '0', '0', '0', '2', '2', '1370000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:54:57', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('77', '111', '35', '', 'UT1-ACL', '0', 'short distance', '0', '0', '2', '65000', '20000', '0', '0', '0', '2', '2', '520000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '11', '2016-09-05', '18:56:00', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('78', '111', '79', '', 'UT1-JTK', '0', 'short distance', '0', '0', '2', '65000', '20000', '0', '0', '0', '3', '2', '815000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-09-08', '11:54:51', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('79', '23', '120', '', 'HLC-CK', '0', 'short distance', '0', '0', '3', '57500', '15000', '0', '0', '0', '13', '2', '560000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:17:16', '3', '2016-09-08', '13:20:44', '1', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('80', '23', '184', '', 'HLC-LMA', '0', 'short distance', '0', '0', '1', '57500', '15000', '0', '0', '0', '13', '2', '620000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:20:28', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('81', '23', '120', '', 'HLC-CK', '0', 'short distance', '0', '0', '3', '57500', '15000', '0', '0', '0', '13', '2', '560000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:20:44', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('82', '111', '156', '', 'UT1-TGR', '0', 'short distance', '0', '0', '2', '75000', '20000', '0', '0', '0', '2', '2', '855000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-09-08', '13:20:57', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('83', '111', '110', '', 'UT1-TWA', '0', 'short distance', '0', '0', '2', '100000', '20000', '0', '0', '0', '2', '2', '940000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-09-08', '13:22:24', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('84', '23', '54', '', 'HLC-CKR', '0', 'short distance', '0', '0', '1', '57500', '15000', '0', '0', '0', '13', '2', '620000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:22:58', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('85', '111', '130', '', 'UT1-BDU', '0', 'short distance', '0', '0', '2', '105000', '20000', '0', '0', '0', '3', '2', '1835000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-09-08', '13:23:09', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('86', '23', '52', '', 'HLC-CKD', '0', 'short distance', '0', '0', '1', '90000', '15000', '0', '0', '0', '13', '2', '1050000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:23:58', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('87', '112', '22', '', 'UT2-BLJ', '0', 'short distance', '0', '0', '1', '74750', '20000', '0', '0', '0', '3', '2', '965000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-09-08', '13:27:26', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('88', '112', '22', '', 'UT2-BLJ', '0', 'short distance', '0', '0', '2', '110000', '20000', '0', '0', '0', '2', '2', '955000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-09-08', '13:28:02', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('89', '23', '156', '', 'HLC-TGR', '0', 'short distance', '0', '0', '1', '57500', '15000', '0', '0', '0', '13', '2', '720000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:28:32', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('90', '113', '22', '', 'UT3-BLJ', '0', 'short distance', '0', '0', '2', '110000', '20000', '0', '0', '0', '2', '2', '1025000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-09-08', '13:28:35', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('91', '113', '22', '', 'UT3-BLJ', '0', 'short distance', '0', '0', '2', '74750', '20000', '0', '0', '0', '3', '2', '830000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-09-08', '13:29:08', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('92', '23', '124', '', 'HLC-KRW', '0', 'short distance', '0', '0', '1', '65000', '15000', '0', '0', '0', '13', '2', '685000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:29:15', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('93', '113', '110', '', 'UT3-TWA', '0', 'short distance', '0', '0', '2', '100000', '20000', '0', '0', '0', '2', '2', '940000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-09-08', '13:30:07', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('94', '113', '110', '', 'UT3-TWA', '0', 'short distance', '0', '0', '2', '74750', '20000', '0', '0', '0', '3', '2', '830000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-09-08', '13:30:35', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('95', '113', '52', '', 'UT3-CKD', '0', 'short distance', '0', '0', '2', '86900', '20000', '0', '0', '0', '3', '2', '1005000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-09-08', '13:31:17', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('96', '113', '82', '', 'UT3-KPO', '0', 'short distance', '0', '0', '2', '82250', '20000', '0', '0', '0', '2', '2', '1200000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-09-08', '13:31:50', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('97', '23', '55', '', 'HLC-CLG', '0', 'short distance', '0', '0', '1', '90000', '15000', '0', '0', '0', '13', '2', '1230000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:31:53', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('98', '113', '130', '', 'UT3-BDU', '0', 'short distance', '0', '0', '2', '105000', '20000', '0', '0', '0', '3', '2', '1915000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-09-08', '13:32:24', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('99', '23', '48', '', 'HLC-CBT', '0', 'short distance', '0', '0', '1', '57500', '15000', '0', '0', '0', '13', '2', '550000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:32:36', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('100', '113', '124', '', 'UT3-KRW', '0', 'short distance', '0', '0', '2', '74750', '20000', '0', '0', '0', '3', '2', '895000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-09-08', '13:33:02', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('101', '113', '126', '', 'UT3-CRB', '0', 'short distance', '0', '0', '2', '140000', '20000', '0', '0', '0', '2', '2', '2320000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-09-08', '13:33:41', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('102', '113', '126', '', 'UT3-CRB', '0', 'short distance', '0', '0', '2', '130000', '20000', '0', '0', '0', '3', '2', '2220000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-09-08', '13:34:09', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('103', '113', '101', '', 'UT3-SB', '0', 'short distance', '0', '0', '2', '110000', '20000', '0', '0', '0', '2', '2', '890000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-09-08', '13:34:37', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('104', '132', '22', '', 'WLG-BLJ', '0', 'short distance', '0', '0', '1', '80000', '15000', '0', '0', '0', '4', '2', '1200000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-09-08', '13:35:12', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('105', '114', '22', '', 'WPP-BLJ', '0', 'short distance', '0', '0', '2', '110000', '20000', '0', '0', '0', '3', '2', '825000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-09-08', '13:35:36', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('106', '23', '212', '', 'HLC-DRS', '0', 'short distance', '0', '0', '1', '57500', '15000', '0', '0', '0', '13', '2', '500000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:37:22', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('107', '23', '12', '', 'HLC-102', '0', 'short distance', '0', '0', '1', '100000', '20000', '0', '0', '0', '13', '2', '630000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:37:59', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('108', '23', '136', '', 'HLC-STL', '0', 'short distance', '0', '0', '1', '390000', '15000', '0', '0', '0', '13', '2', '390000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:38:37', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('109', '23', '21', '', 'HLC-211', '0', 'short distance', '0', '0', '2', '100000', '20000', '0', '0', '0', '2', '2', '630000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:39:14', '3', '2016-09-08', '13:43:07', '1', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('110', '23', '186', '', 'HLC-PLU', '0', 'short distance', '0', '0', '1', '57500', '15000', '0', '0', '0', '13', '2', '560000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:39:50', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('111', '15', '15', '', '114-114', '0', 'short distance', '0', '0', '1', '40000', '15000', '0', '0', '0', '13', '2', '560000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:40:59', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('112', '23', '183', '', 'HLC-004', '0', 'short distance', '0', '0', '1', '57500', '15000', '0', '0', '0', '13', '2', '560000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:41:36', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('113', '23', '30', '', 'HLC-301', '0', 'short distance', '0', '0', '1', '100000', '20000', '0', '0', '0', '2', '2', '755000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:42:42', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('114', '23', '21', '', 'HLC-211', '0', 'short distance', '0', '0', '2', '100000', '20000', '0', '0', '0', '2', '2', '630000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:43:07', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('115', '23', '10', '', 'HLC-007', '0', 'short distance', '0', '0', '2', '100000', '20000', '0', '0', '0', '2', '2', '755000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:43:49', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('116', '23', '180', '', 'HLC-SPG', '0', 'short distance', '0', '0', '1', '57500', '15000', '0', '0', '0', '13', '2', '670000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:44:42', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('117', '23', '52', '', 'HLC-CKD', '0', 'short distance', '0', '0', '2', '145250', '17500', '0', '0', '0', '2', '2', '1400000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:45:43', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('118', '23', '6', '', 'HLC-CKP1', '0', 'short distance', '0', '0', '1', '72500', '15000', '0', '0', '0', '13', '2', '975000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:46:32', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('119', '23', '105', '', 'HLC-SRG', '0', 'short distance', '0', '0', '1', '90000', '15000', '0', '0', '0', '13', '2', '1230000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:51:41', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('120', '23', '22', '', 'HLC-BLJ', '0', 'short distance', '0', '0', '1', '80000', '15000', '0', '0', '0', '13', '2', '835000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:53:07', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('121', '23', '50', '', 'HLC-CGD', '0', 'short distance', '0', '0', '1', '90000', '15000', '0', '0', '0', '13', '2', '1275000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:53:56', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('122', '23', '213', '', 'HLC-PBI', '0', 'short distance', '0', '0', '1', '90000', '15000', '0', '0', '0', '13', '2', '1230000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:56:09', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('123', '23', '165', '', 'HLC-CKU', '0', 'short distance', '0', '0', '1', '90000', '15000', '0', '0', '0', '13', '2', '1050000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:56:52', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('124', '23', '185', '', 'HLC-NR', '0', 'short distance', '0', '0', '1', '40000', '15000', '0', '0', '0', '13', '2', '200000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:57:52', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('125', '23', '198', '', 'HLC-WK', '0', 'short distance', '0', '0', '1', '40000', '15000', '0', '0', '0', '13', '2', '200000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '13:58:35', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('126', '23', '30', '', 'HLC-301', '0', 'short distance', '0', '0', '2', '100000', '20000', '0', '0', '0', '2', '2', '705000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '14:00:16', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('127', '23', '10', '', 'HLC-007', '0', 'short distance', '0', '0', '1', '100000', '20000', '0', '0', '0', '2', '2', '705000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '14:01:04', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('128', '23', '43', '', 'HLC-BGR', '0', 'short distance', '0', '0', '1', '40000', '15000', '0', '0', '0', '13', '2', '450000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '14:01:50', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('129', '23', '125', '', 'HLC-SUB', '0', 'short distance', '0', '0', '1', '90000', '15000', '0', '0', '0', '13', '2', '1230000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '14:02:49', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('130', '23', '182', '', 'HLC-CLS', '0', 'short distance', '0', '0', '1', '40000', '15000', '0', '0', '0', '13', '2', '280000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '14:03:30', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('131', '23', '163', '', 'HLC-SBG', '0', 'short distance', '0', '0', '1', '90000', '15000', '0', '0', '0', '13', '2', '1230000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '14:04:40', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('132', '23', '52', '', 'HLC-CKD', '0', 'short distance', '0', '0', '1', '145250', '17500', '0', '0', '0', '3', '2', '1420000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '14:05:28', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('133', '23', '57', '', 'HLC-CWD', '0', 'short distance', '0', '0', '1', '90000', '15000', '0', '0', '0', '13', '2', '1275000', '0', '2016-09-08', '', '1', '0', '0', '1901-01-01', '00:00:00', '3', '2016-09-08', '14:06:24', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('134', '82', '22', '', 'KPO-BLJ', '0', 'short distance', '0', '0', '1', '40000', '15000', '0', '0', '0', '5', '2', '275000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '1', '2016-09-24', '23:34:06', '1', '2016-09-26', '20:18:10', '1', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('135', '82', '22', '', 'KPO-BLJ', '0', 'short distance', '0', '0', '1', '40000', '15000', '0', '0', '0', '4', '2', '275000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '1', '2016-09-25', '00:24:18', '1', '2016-09-26', '20:17:55', '1', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('136', '50', '137', '', 'CGD-BMM', '0', 'short distance', '0', '0', '1', '77500', '15000', '0', '0', '0', '4', '2', '535000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '1', '2016-09-25', '09:36:21', '1', '2016-09-26', '19:45:57', '1', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('137', '57', '94', '', 'CWD-NHI', '0', 'short distance', '0', '0', '1', '82500', '15000', '0', '0', '0', '5', '2', '545000', '0', '2016-09-26', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-09-26', '10:03:44', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('138', '50', '137', '', 'CGD-BMM', '0', 'short distance', '0', '0', '1', '77500', '15000', '0', '0', '0', '5', '2', '535000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-09-26', '10:12:26', '1', '2016-09-26', '19:46:12', '1', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('139', '101', '22', '', 'SB-BLJ', '0', 'short distance', '0', '0', '1', '0', '0', '0', '0', '0', '4', '2', '120000', '0', '2016-09-26', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-09-26', '17:07:22', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('140', '160', '126', '', 'KIE-CRB', '0', 'long distance', '0', '0', '1', '300000', '20000', '0', '2000000', '1154000', '2', '2', '3154000', '0', '2016-09-26', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-09-26', '18:04:55', '2', '2016-09-26', '18:12:57', '1', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('141', '160', '126', '', 'KIE-CRB', '0', 'long distance', '0', '0', '1', '300000', '20000', '0', '2000000', '1154000', '2', '2', '3154000', '0', '2016-09-26', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-09-26', '18:12:57', '1', '2016-09-26', '18:20:14', '1', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('142', '160', '126', '', 'KIE-CRB', '0', 'long distance', '0', '0', '1', '300000', '20000', '0', '2000000', '1154000', '2', '2', '3154000', '0', '2016-09-26', '', '1', '0', '0', '1901-01-01', '00:00:00', '1', '2016-09-26', '18:20:14', '1', '2016-09-26', '18:21:12', '1', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('143', '160', '126', '', 'KIE-CRB', '0', 'long distance', '0', '0', '1', '300000', '20000', '0', '2000000', '1154000', '2', '2', '3154000', '0', '2016-09-26', '', '1', '0', '0', '1901-01-01', '00:00:00', '1', '2016-09-26', '18:21:12', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('144', '50', '137', '', 'CGD-BMM', '0', 'short distance', '0', '0', '1', '77500', '15000', '0', '0', '0', '4', '2', '535000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '1', '2016-09-26', '19:45:57', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('145', '50', '137', '', 'CGD-BMM', '0', 'short distance', '0', '0', '1', '77500', '15000', '0', '0', '0', '5', '2', '535000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '1', '2016-09-26', '19:46:12', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('146', '82', '22', '', 'KPO-BLJ', '0', 'short distance', '0', '0', '1', '40000', '15000', '0', '0', '0', '4', '2', '275000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '1', '2016-09-26', '20:17:55', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('147', '82', '22', '', 'KPO-BLJ', '0', 'short distance', '0', '0', '1', '40000', '15000', '0', '0', '0', '5', '2', '275000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '1', '2016-09-26', '20:18:10', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('148', '140', '94', '', 'GWM-NHI', '0', 'short distance', '0', '0', '1', '72500', '15000', '0', '0', '0', '4', '2', '495000', '0', '2016-09-27', '', '1', '0', '0', '1901-01-01', '00:00:00', '1', '2016-09-27', '01:25:25', '1', '2016-09-28', '18:34:19', '1', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('149', '140', '94', '', 'GWM-NHI', '0', 'short distance', '0', '0', '1', '72500', '15000', '0', '0', '0', '5', '2', '495000', '0', '2016-09-27', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-09-27', '08:52:29', '2', '2016-09-28', '09:12:15', '1', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('150', '91', '22', '', 'MRK-BLJ', '0', 'short distance', '0', '0', '2', '110000', '20000', '0', '0', '0', '2', '2', '855000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-09-27', '15:10:12', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('151', '91', '22', '', 'MRK-BLJ', '0', 'short distance', '0', '0', '2', '60000', '17500', '0', '0', '0', '5', '2', '555000', '0', '2016-09-27', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-09-27', '15:18:45', '2', '2016-09-27', '15:22:24', '1', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('152', '91', '22', '', 'MRK-BLJ', '0', 'short distance', '0', '0', '2', '60000', '17500', '0', '0', '0', '5', '2', '555000', '0', '2016-09-27', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-09-27', '15:22:24', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('153', '140', '94', '', 'GWM-NHI', '0', 'short distance', '0', '0', '1', '72500', '15000', '0', '0', '0', '5', '2', '495000', '0', '2016-09-27', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-09-28', '09:12:15', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('154', '140', '94', '', 'GWM-NHI', '0', 'short distance', '0', '0', '1', '72500', '15000', '0', '0', '0', '14', '2', '475000', '0', '2016-09-28', '', '1', '0', '0', '1901-01-01', '00:00:00', '1', '2016-09-28', '10:50:24', '1', '2016-09-28', '10:50:53', '1', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('155', '140', '94', '', 'GWM-NHI', '0', 'short distance', '0', '0', '1', '72500', '15000', '0', '0', '0', '14', '2', '475000', '0', '2016-09-28', '', '1', '0', '0', '1901-01-01', '00:00:00', '1', '2016-09-28', '10:50:53', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('156', '50', '160', '', 'CGD-KIE', '0', 'short distance', '0', '0', '1', '0', '0', '0', '0', '0', '14', '2', '130000', '0', '2016-09-28', 'pok', '1', '0', '0', '1901-01-01', '00:00:00', '1', '2016-09-28', '14:04:26', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('157', '82', '22', '', 'KPO-BLJ', '0', 'short distance', '0', '0', '1', '40000', '15000', '0', '0', '0', '14', '2', '275000', '0', '2016-09-28', '', '1', '0', '0', '1901-01-01', '00:00:00', '1', '2016-09-28', '14:06:13', '1', '2016-09-28', '14:06:47', '1', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('158', '82', '22', '', 'KPO-BLJ', '0', 'short distance', '0', '0', '1', '40000', '15000', '0', '0', '0', '14', '2', '275000', '0', '2016-09-28', '', '1', '0', '0', '1901-01-01', '00:00:00', '1', '2016-09-28', '14:06:47', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('159', '140', '94', '', 'GWM-NHI', '0', 'short distance', '0', '0', '1', '72500', '15000', '0', '0', '0', '4', '2', '495000', '0', '2016-09-27', '', '1', '0', '0', '1901-01-01', '00:00:00', '1', '2016-09-28', '18:34:19', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('160', '91', '22', '', 'MRK-BLJ', '0', 'short distance', '0', '0', '2', '110000', '15000', '0', '0', '0', '3', '2', '855000', '0', '2016-09-29', '', '1', '0', '0', '1901-01-01', '00:00:00', '1', '2016-09-29', '16:39:09', '1', '2016-09-29', '16:39:49', '1', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('161', '91', '22', '', 'MRK-BLJ', '0', 'short distance', '0', '0', '2', '110000', '20000', '0', '0', '0', '3', '2', '855000', '0', '2016-09-29', '', '1', '0', '0', '1901-01-01', '00:00:00', '1', '2016-09-29', '16:39:49', '1', '2016-09-29', '16:40:13', '1', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('162', '91', '22', '', 'MRK-BLJ', '0', 'short distance', '0', '0', '2', '110000', '20000', '0', '0', '0', '3', '2', '855000', '0', '2016-09-29', '', '1', '0', '0', '1901-01-01', '00:00:00', '1', '2016-09-29', '16:40:13', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('163', '57', '176', '', 'CWD-GCM', '0', 'short distance', '0', '0', '1', '0', '0', '0', '0', '0', '4', '2', '245000', '0', '2016-09-30', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-09-30', '17:40:55', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('164', '57', '160', '', 'CWD-KIE', '0', 'short distance', '0', '0', '1', '0', '0', '0', '0', '0', '4', '2', '130000', '0', '2016-09-30', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-09-30', '17:43:29', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('165', '50', '176', '', 'CGD-GCM', '0', 'short distance', '0', '0', '1', '0', '0', '0', '0', '0', '4', '2', '245000', '0', '2016-09-30', '', '1', '0', '0', '1901-01-01', '00:00:00', '1', '2016-09-30', '21:53:01', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('166', '50', '115', '', 'CGD-WJK', '0', 'short distance', '0', '0', '1', '67500', '15000', '0', '0', '0', '14', '2', '525000', '0', '2016-10-02', '', '1', '0', '0', '1901-01-01', '00:00:00', '1', '2016-10-02', '11:54:56', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('167', '50', '115', '', 'CGD-WJK', '0', 'short distance', '0', '0', '1', '67500', '15000', '0', '0', '0', '5', '2', '535000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-03', '10:28:42', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('168', '50', '22', '', 'CGD-BLJ', '0', 'short distance', '0', '0', '1', '82500', '15000', '0', '0', '0', '14', '2', '545000', '0', '2016-10-04', '', '1', '0', '0', '1901-01-01', '00:00:00', '1', '2016-10-04', '20:26:13', '0', '1901-01-01', '00:00:00', '1', '2', '2016-10-07', '10:42:26');
INSERT INTO `sa_fare_trip_hdr` VALUES ('169', '91', '133', '', 'MRK-PRK', '0', 'short distance', '0', '0', '2', '100000', '20000', '0', '0', '0', '3', '2', '1600000', '0', '2016-10-06', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-06', '10:27:52', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('170', '57', '214', '', 'CWD-CPI', '0', 'short distance', '0', '0', '1', '72500', '15000', '0', '0', '0', '4', '2', '530000', '0', '2016-10-06', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-06', '10:44:02', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('171', '91', '82', '', 'MRK-KPO', '0', 'short distance', '0', '0', '2', '110000', '20000', '0', '0', '0', '3', '2', '925000', '0', '2016-10-06', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-06', '10:52:43', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('172', '50', '214', '', 'CGD-CPI', '0', 'short distance', '0', '0', '2', '100000', '17500', '0', '0', '0', '3', '2', '735000', '0', '2016-10-06', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-06', '13:46:39', '0', '1901-01-01', '00:00:00', '1', '2', '2016-10-06', '13:50:56');
INSERT INTO `sa_fare_trip_hdr` VALUES ('173', '50', '214', '', 'CGD-CPI', '0', 'short distance', '0', '0', '2', '100000', '17500', '0', '0', '0', '2', '2', '735000', '0', '2016-10-06', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-06', '13:50:56', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('174', '176', '94', '', 'GCM-NHI', '0', 'short distance', '0', '0', '1', '82500', '15000', '0', '0', '0', '4', '2', '545000', '0', '2016-10-07', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-07', '08:20:44', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('175', '50', '214', '', 'CGD-CPI', '0', 'short distance', '0', '0', '1', '82500', '15000', '0', '0', '0', '4', '2', '545000', '0', '2016-10-07', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-07', '08:27:40', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('176', '50', '214', '', 'CGD-CPI', '0', 'short distance', '0', '0', '1', '100000', '17500', '0', '0', '0', '2', '2', '735000', '0', '2016-10-07', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-07', '08:45:57', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('177', '57', '215', '', 'CWD-CJS', '0', 'short distance', '0', '0', '1', '82500', '15000', '0', '0', '0', '4', '2', '580000', '0', '2016-10-07', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-07', '08:50:19', '0', '1901-01-01', '00:00:00', '1', '2', '2016-10-07', '11:14:18');
INSERT INTO `sa_fare_trip_hdr` VALUES ('178', '82', '214', '', 'KPO-CPI', '0', 'short distance', '0', '0', '1', '40000', '15000', '0', '0', '0', '4', '2', '275000', '0', '2016-10-07', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-07', '09:24:22', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('179', '50', '214', '', 'CGD-CPI', '0', 'short distance', '0', '0', '1', '82500', '15000', '0', '0', '0', '14', '2', '525000', '0', '2016-10-07', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-07', '10:14:23', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('180', '176', '94', '', 'GCM-NHI', '0', 'short distance', '0', '0', '1', '82500', '15000', '0', '0', '0', '14', '2', '525000', '0', '2016-10-07', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-07', '10:31:34', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('181', '50', '22', '', 'CGD-BLJ', '0', 'short distance', '0', '0', '1', '82500', '15000', '0', '0', '0', '14', '2', '525000', '0', '2016-10-04', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-07', '10:42:26', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('182', '57', '215', '', 'CWD-CJS', '0', 'short distance', '0', '0', '1', '57500', '15000', '0', '0', '0', '4', '2', '545000', '0', '2016-10-07', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-07', '11:14:18', '0', '1901-01-01', '00:00:00', '1', '2', '2016-10-07', '11:16:33');
INSERT INTO `sa_fare_trip_hdr` VALUES ('183', '57', '215', '', 'CWD-CJS', '0', 'short distance', '0', '0', '1', '57500', '15000', '0', '0', '0', '4', '2', '535000', '0', '2016-10-07', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-07', '11:16:33', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('184', '50', '214', '', 'CGD-CPI', '0', 'short distance', '0', '0', '1', '82500', '15000', '0', '0', '0', '5', '2', '545000', '0', '2016-10-07', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-07', '13:57:44', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('185', '50', '216', '', 'CGD-GDC', '0', 'short distance', '0', '0', '1', '0', '0', '0', '0', '0', '4', '2', '90000', '0', '2016-10-09', '', '1', '0', '0', '1901-01-01', '00:00:00', '1', '2016-10-09', '15:29:41', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('186', '50', '216', '', 'CGD-GDC', '0', 'short distance', '0', '0', '1', '0', '0', '0', '0', '0', '14', '2', '90000', '0', '2016-10-09', '', '1', '0', '0', '1901-01-01', '00:00:00', '1', '2016-10-09', '15:30:28', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('187', '68', '214', '', 'GDJ-CPI', '0', 'short distance', '0', '0', '1', '82500', '15000', '0', '0', '0', '4', '2', '545000', '0', '2016-10-10', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-10', '13:17:53', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('188', '68', '214', '', 'GDJ-CPI', '0', 'short distance', '0', '0', '1', '100000', '17500', '0', '0', '0', '2', '2', '735000', '0', '2016-10-10', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-10', '13:29:46', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('189', '91', '82', '', 'MRK-KPO', '0', 'short distance', '0', '0', '1', '110000', '20000', '0', '0', '0', '2', '2', '855000', '0', '2016-10-11', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-11', '08:35:54', '0', '1901-01-01', '00:00:00', '1', '2', '2016-10-11', '08:37:07');
INSERT INTO `sa_fare_trip_hdr` VALUES ('190', '91', '82', '', 'MRK-KPO', '0', 'short distance', '0', '0', '1', '110000', '20000', '0', '0', '0', '2', '2', '925000', '0', '2016-10-11', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-11', '08:37:07', '0', '1901-01-01', '00:00:00', '1', '1', '2016-10-16', '21:36:40');
INSERT INTO `sa_fare_trip_hdr` VALUES ('191', '50', '217', '', 'CGD-KC1', '0', 'short distance', '0', '0', '1', '0', '0', '0', '0', '0', '4', '2', '250000', '0', '2016-10-12', '', '1', '0', '0', '1901-01-01', '00:00:00', '1', '2016-10-12', '23:18:16', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('192', '50', '217', '', 'CGD-KC1', '0', 'short distance', '0', '0', '1', '0', '0', '0', '0', '0', '14', '2', '250000', '0', '2016-10-12', '', '1', '0', '0', '1901-01-01', '00:00:00', '1', '2016-10-12', '23:18:53', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('193', '57', '67', '', 'CWD-GDI', '0', 'short distance', '0', '0', '1', '0', '0', '0', '0', '0', '4', '2', '150000', '0', '2016-10-13', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-13', '14:22:27', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('194', '57', '67', '', 'CWD-GDI', '0', 'short distance', '0', '0', '1', '0', '0', '0', '0', '0', '5', '2', '150000', '0', '2016-10-13', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-13', '14:23:07', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('195', '50', '143', '', 'CGD-JKS', '0', 'short distance', '0', '0', '1', '100000', '17500', '0', '0', '0', '2', '2', '743000', '0', '2016-10-13', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-13', '17:14:38', '0', '1901-01-01', '00:00:00', '1', '2', '2016-10-14', '08:15:53');
INSERT INTO `sa_fare_trip_hdr` VALUES ('196', '50', '143', '', 'CGD-JKS', '0', 'short distance', '0', '0', '1', '67500', '15000', '0', '0', '0', '14', '2', '593000', '0', '2016-10-13', '', '1', '0', '0', '1901-01-01', '00:00:00', '1', '2016-10-13', '17:39:52', '0', '1901-01-01', '00:00:00', '1', '2', '2016-10-14', '08:14:28');
INSERT INTO `sa_fare_trip_hdr` VALUES ('197', '50', '143', '', 'CGD-JKS', '0', 'short distance', '0', '0', '1', '67500', '15000', '0', '0', '0', '5', '2', '545000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-14', '08:13:59', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('198', '50', '143', '', 'CGD-JKS', '0', 'short distance', '0', '0', '1', '67500', '15000', '0', '0', '0', '14', '2', '525000', '0', '2016-10-13', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-14', '08:14:28', '0', '1901-01-01', '00:00:00', '0', '2', '2016-10-14', '08:19:30');
INSERT INTO `sa_fare_trip_hdr` VALUES ('199', '50', '143', '', 'CGD-JKS', '0', 'short distance', '0', '0', '1', '100000', '17500', '0', '0', '0', '2', '2', '735000', '0', '2016-10-13', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-14', '08:15:53', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('200', '50', '143', '', 'CGD-JKS', '0', 'short distance', '0', '0', '1', '67500', '15000', '0', '0', '0', '4', '2', '525000', '0', '2016-10-13', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-14', '08:19:30', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('201', '50', '176', '', 'CGD-GCM', '0', 'short distance', '0', '0', '1', '0', '0', '0', '0', '0', '14', '2', '245000', '0', '2016-10-15', '', '1', '0', '0', '1901-01-01', '00:00:00', '1', '2016-10-15', '10:01:00', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('202', '82', '214', '', 'KPO-CPI', '0', 'short distance', '0', '0', '1', '0', '0', '0', '0', '0', '5', '2', '275000', '0', '2016-10-15', '', '1', '0', '0', '1901-01-01', '00:00:00', '1', '2016-10-15', '18:01:42', '0', '1901-01-01', '00:00:00', '1', '1', '2016-10-15', '18:02:49');
INSERT INTO `sa_fare_trip_hdr` VALUES ('203', '82', '214', '', 'KPO-CPI', '0', 'short distance', '0', '0', '1', '40000', '15000', '0', '0', '0', '14', '2', '275000', '0', '2016-10-15', '', '1', '0', '0', '1901-01-01', '00:00:00', '1', '2016-10-15', '18:02:28', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('204', '82', '214', '', 'KPO-CPI', '0', 'short distance', '0', '0', '1', '40000', '15000', '0', '0', '0', '5', '2', '275000', '0', '2016-10-15', '', '1', '0', '0', '1901-01-01', '00:00:00', '1', '2016-10-15', '18:02:49', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('205', '91', '82', '', 'MRK-KPO', '0', 'short distance', '0', '0', '2', '110000', '20000', '0', '0', '0', '2', '2', '925000', '0', '2016-10-11', '', '1', '0', '0', '1901-01-01', '00:00:00', '1', '2016-10-16', '21:36:40', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('206', '67', '214', '', 'GDI-CPI', '0', 'short distance', '0', '0', '1', '72500', '15000', '0', '0', '0', '4', '2', '525000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-17', '10:08:00', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('207', '67', '214', '', 'GDI-CPI', '0', 'short distance', '0', '0', '1', '72500', '15000', '0', '0', '0', '5', '2', '545000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-17', '10:08:22', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('208', '67', '214', '', 'GDI-CPI', '0', 'short distance', '0', '0', '1', '72500', '15000', '0', '0', '0', '14', '2', '525000', '0', '2016-10-17', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-17', '11:15:44', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('209', '68', '214', '', 'GDJ-CPI', '0', 'short distance', '0', '0', '1', '82500', '15000', '0', '0', '0', '14', '2', '525000', '0', '2016-10-17', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-17', '11:16:58', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('210', '50', '94', '', 'CGD-NHI', '0', 'short distance', '0', '0', '1', '82500', '15000', '0', '0', '0', '14', '2', '525000', '0', '2016-10-17', '', '1', '0', '0', '1901-01-01', '00:00:00', '1', '2016-10-17', '13:32:37', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('211', '91', '110', '', 'MRK-TWA', '0', 'short distance', '0', '0', '1', '79750', '20000', '0', '0', '0', '3', '2', '855000', '0', '2016-10-17', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-17', '14:11:03', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('212', '91', '110', '', 'MRK-TWA', '0', 'short distance', '0', '0', '1', '100000', '20000', '0', '0', '0', '2', '2', '1600000', '0', '2016-10-17', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-17', '14:12:03', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('213', '50', '126', '', 'CGD-CRB', '0', 'short distance', '0', '0', '1', '300000', '20000', '0', '0', '0', '2', '2', '3154000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '1', '2016-10-18', '01:26:45', '0', '1901-01-01', '00:00:00', '1', '1', '2016-10-18', '01:27:22');
INSERT INTO `sa_fare_trip_hdr` VALUES ('214', '50', '126', '', 'CGD-CRB', '0', 'long distance', '0', '0', '1', '300000', '20000', '0', '0', '0', '2', '2', '3154000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '1', '2016-10-18', '01:27:22', '0', '1901-01-01', '00:00:00', '1', '1', '2016-10-18', '01:36:50');
INSERT INTO `sa_fare_trip_hdr` VALUES ('215', '50', '126', '', 'CGD-CRB', '0', 'long distance', '0', '0', '1', '300000', '20000', '0', '2000000', '1154000', '2', '2', '3154000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '1', '2016-10-18', '01:36:50', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('216', '50', '82', '', 'CGD-KPO', '0', 'short distance', '0', '0', '1', '67500', '15000', '0', '0', '0', '14', '2', '593000', '0', '2016-10-18', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-18', '10:50:19', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('217', '57', '115', '', 'CWD-WJK', '0', 'short distance', '0', '0', '1', '57500', '15000', '0', '0', '0', '5', '2', '545000', '0', '2016-10-18', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-18', '16:38:43', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('218', '57', '115', '', 'CWD-WJK', '0', 'short distance', '0', '0', '1', '57500', '15000', '0', '0', '0', '4', '2', '525000', '0', '2016-10-18', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-18', '16:39:14', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('219', '57', '115', '', 'CWD-WJK', '0', 'short distance', '0', '0', '1', '57500', '15000', '0', '0', '0', '14', '2', '525000', '0', '2016-10-18', '', '1', '0', '0', '1901-01-01', '00:00:00', '2', '2016-10-18', '16:40:53', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('220', '11', '22', '', '009-BLJ', '0', 'short distance', '0', '0', '1', '110000', '20000', '0', '0', '0', '2', '2', '890000', '0', '2016-09-05', 'test', '1', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-09', '16:38:23', '0', '1901-01-01', '00:00:00', '1', '1', '2016-11-09', '16:38:44');
INSERT INTO `sa_fare_trip_hdr` VALUES ('221', '11', '22', '', '009-BLJ', '0', 'short distance', '0', '0', '3', '110000', '20000', '0', '0', '0', '2', '2', '890000', '0', '2016-09-05', 'test', '1', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-09', '16:38:44', '0', '1901-01-01', '00:00:00', '1', '1', '2016-11-09', '16:39:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('222', '11', '22', '', '009-BLJ', '0', 'short distance', '0', '0', '2', '110000', '20000', '0', '0', '0', '2', '2', '890000', '0', '2016-09-05', 'test', '1', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-09', '16:39:00', '0', '1901-01-01', '00:00:00', '1', '1', '2016-11-09', '16:44:09');
INSERT INTO `sa_fare_trip_hdr` VALUES ('223', '11', '22', '', '009-BLJ', '0', 'short distance', '0', '0', '2', '110000', '20000', '0', '0', '0', '2', '2', '890000', '0', '2016-09-05', '', '1', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-09', '16:49:07', '1', '2016-11-09', '17:06:56', '0', '0', '0000-00-00', '00:00:00');
INSERT INTO `sa_fare_trip_hdr` VALUES ('224', '3', '5', '', 'SMB1-CRB1', '0', 'long distance', '0', '0', '2', '1000000', '0', '0', '0', '0', '9', '2', '1100000', '0', '2016-11-09', 'test edit', '1', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-09', '16:58:33', '1', '2016-11-09', '17:00:45', '1', '1', '2016-11-09', '17:02:21');
INSERT INTO `sa_fare_trip_hdr` VALUES ('225', '2', '6', '', 'MRK1-CKP1', '100', 'short distance', '0', '0', '1', '100000', '0', '0', '0', '0', '9', '3', '200000', '0', '2016-11-09', 'test edit', '1', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-09', '17:28:15', '1', '2016-11-09', '17:30:49', '1', '1', '2016-11-09', '17:32:10');
INSERT INTO `sa_fare_trip_hdr` VALUES ('226', '1', '2', '', 'TP1-MRK1', '100000', 'long distance', '0', '0', '2', '1500000', '0', '0', '0', '0', '9', '2', '1300000', '0', '2016-11-09', 'test edit', '1', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-09', '17:33:51', '1', '2016-11-09', '17:34:31', '1', '1', '2016-11-09', '17:35:05');

-- ----------------------------
-- Table structure for sa_finger_device
-- ----------------------------
DROP TABLE IF EXISTS `sa_finger_device`;
CREATE TABLE `sa_finger_device` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `device_fingername` varchar(30) DEFAULT '',
  `device_serialnumber` varchar(255) DEFAULT '',
  `device_position` smallint(6) DEFAULT '0',
  PRIMARY KEY (`rowID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sa_finger_device
-- ----------------------------
INSERT INTO `sa_finger_device` VALUES ('1', 'POS DOKUMEN', '{CE694E99-1529-FB40-A240-B279640A1983}', '1');
INSERT INTO `sa_finger_device` VALUES ('2', 'POS VERIFIKASI', '{CE694E99-1529-FB40-A240-B279640A1983a}', '2');
INSERT INTO `sa_finger_device` VALUES ('3', 'POS CIWANDAN', '', '3');

-- ----------------------------
-- Table structure for sa_income
-- ----------------------------
DROP TABLE IF EXISTS `sa_income`;
CREATE TABLE `sa_income` (
  `rowID` smallint(6) NOT NULL AUTO_INCREMENT,
  `type` char(1) NOT NULL DEFAULT '',
  `income_cd` varchar(20) NOT NULL DEFAULT '',
  `descs` varchar(60) NOT NULL DEFAULT '',
  `accrued_coa_rowID` smallint(6) NOT NULL DEFAULT '0',
  `income_coa_rowID` smallint(6) NOT NULL DEFAULT '0',
  `vat_coa_rowID` smallint(6) NOT NULL DEFAULT '0',
  `jo_rate` char(1) NOT NULL DEFAULT 'N',
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`,`income_cd`),
  KEY `rowID` (`rowID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sa_income
-- ----------------------------
INSERT INTO `sa_income` VALUES ('1', 'H', '1000', 'PENDAPATAN', '123', '123', '173', 'N', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');

-- ----------------------------
-- Table structure for sa_invoice_type
-- ----------------------------
DROP TABLE IF EXISTS `sa_invoice_type`;
CREATE TABLE `sa_invoice_type` (
  `rowID` smallint(6) NOT NULL AUTO_INCREMENT,
  `inv_type_cd` varchar(6) NOT NULL DEFAULT '',
  `inv_type_name` varchar(60) NOT NULL DEFAULT '',
  `cb_coa_rowID` smallint(6) NOT NULL DEFAULT '0',
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`,`inv_type_cd`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sa_invoice_type
-- ----------------------------
INSERT INTO `sa_invoice_type` VALUES ('1', '1101', 'Pajak', '0', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_invoice_type` VALUES ('2', '1102', 'NON PAJAK', '0', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_invoice_type` VALUES ('3', '1103', 'Operational', '0', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_invoice_type` VALUES ('4', '123456', 'SEDEEDRR', '0', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_invoice_type` VALUES ('5', '12345', 'WERTYYU', '0', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');

-- ----------------------------
-- Table structure for sa_item
-- ----------------------------
DROP TABLE IF EXISTS `sa_item`;
CREATE TABLE `sa_item` (
  `rowID` smallint(6) NOT NULL AUTO_INCREMENT,
  `item_cd` varchar(20) NOT NULL DEFAULT '',
  `item_name` varchar(60) NOT NULL DEFAULT '',
  `minimum` int(11) NOT NULL,
  `maximum` int(11) NOT NULL,
  `uom_rowID` smallint(6) NOT NULL DEFAULT '0',
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`,`item_cd`),
  KEY `rowID` (`rowID`),
  KEY `item_cd` (`item_cd`),
  KEY `item_name` (`item_name`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sa_item
-- ----------------------------
INSERT INTO `sa_item` VALUES ('1', '001', 'JAGUNG', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '14:34:57', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('2', '002', 'RAPESEED MEAL (RSM)', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '14:35:22', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('3', '003', 'SOYABEAN MEAL (SBM)', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '14:35:53', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('4', '004', 'CORN GLUTEN MEAL (MBM)', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '14:36:23', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('5', '005', 'MEAT BONE MEAL (MBM)', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '14:36:49', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('6', '006', 'FISH MEAL ', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '14:37:22', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('7', '007', 'TERIGU', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '14:38:07', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('8', '008', 'INDUSTRI', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '14:38:49', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('9', '009', 'TAPIOKA', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '14:39:45', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('10', '010', 'W.B POLLARD', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '14:40:11', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('11', '011', 'W.B PELLET', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '14:40:28', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('12', '012', 'CANOLA MEAL', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '14:41:11', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('13', '013', 'RICE (BERAS)', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '14:41:28', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('14', '014', 'SUGAR (GULA)', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '14:41:49', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('15', '015', 'SALT (GARAM)', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '14:42:08', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('16', '016', 'SOYBEAN (KEDELAI)', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '14:42:33', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('17', '017', 'GROUNDNUT MEAL', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '14:43:50', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('18', '018', 'WHEAT FLOUR', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '14:44:11', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('19', '019', 'FISH FEED (PAKAN IKAN)', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '14:44:43', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('20', '020', 'FISH OIL (MINYAK IKAN)', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '14:45:05', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('21', '021', 'PREMIX', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '14:46:20', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('22', '022', 'MONOSODIUM PHOSPHATE', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '14:46:55', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('23', '023', 'DICALCIUM PHOSPATE (DCP)', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '14:47:24', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('24', '024', 'MONOPOTASIUM PHOSPHATE', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '14:48:25', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('25', '025', 'MONOCALCIUM PHOSPHATE', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '14:48:52', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('26', '026', 'MONODICALCIUM PHOSPHATE', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '14:49:35', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('27', '027', 'ASCORBAT MONOPHOSPHATE', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '14:50:02', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('28', '028', 'MONO AMMONIUM PHOSPHATE', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '14:50:38', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('29', '029', 'SOLMAX', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '14:51:04', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('30', '030', 'YELLOW SOYBEAN', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '14:51:36', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('31', '031', 'MAGNESIUM SULPHATE', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '14:52:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('32', '032', 'FERROUS SULPHATE', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '14:55:34', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('33', '033', 'COLISTIN SULPHATE', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '14:57:07', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('34', '034', 'ZINC SULPHATE', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '14:57:26', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('35', '035', '3 NITRO', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '14:58:27', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('36', '036', 'VITAMIN', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '14:58:46', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('37', '037', 'OBAT TERNAK', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '14:59:15', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('38', '038', 'PAKAN TERNAK', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '14:59:33', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('39', '039', 'SPARE PARTS', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '15:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('40', '040', 'MACHINE', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '15:00:14', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('41', '041', 'FROZEN CHICKEN', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '15:00:32', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('42', '042', 'PONDFOS', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '15:00:55', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('43', '043', 'MAINAN ANAK', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '15:01:35', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('44', '044', 'DOG FOOD', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '15:01:58', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('45', '045', 'PALLET', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '15:02:15', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('46', '046', 'KERTAS (PAPPER)', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '15:02:34', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('47', '047', 'BIJI PLASTIK', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '15:02:55', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('48', '048', 'FEED WHEAT', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '15:03:49', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('49', '049', 'ALUMUNIUM', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '15:04:30', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('50', '050', 'BINDER', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '15:05:14', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('51', '051', 'BONE MEAL', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '15:05:44', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('52', 'CEMENT', 'CEMENT', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '15:08:10', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('53', 'SMC', 'SEMEN CURAH', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '15:08:40', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('54', '052', 'DEDAK', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '15:09:12', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('55', '053', 'DITILLERS DRIED GRAINS', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '15:09:39', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('56', '054', 'FROZEN FISH', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '15:10:06', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('57', '055', 'FROZEN POTATO', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '15:10:30', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('58', '056', 'LIMBAH PPLI', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '15:12:27', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('59', '057', 'SOYBEAN OIL', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '15:13:31', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('60', '058', 'SOYBEAN PELLET', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '15:14:22', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('61', '059', 'TISSUE', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-09', '15:14:44', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('62', '060', 'UKRAINE FEED WHEAT', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-20', '10:54:07', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('63', '003B', 'SBM BRAZIL', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '1', '2016-09-24', '16:01:37', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('64', '001M', 'JAGUNG MAKASAR', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '1', '2016-09-24', '16:02:18', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('65', '001B', 'JAGUNG BRAZIL', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '1', '2016-09-24', '16:22:15', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('66', '203A', 'GANDUM ARGENTINA', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '1', '2016-09-24', '16:22:45', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('67', 'DDG', 'DISTILLERS DRIED GRAINS', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-29', '11:31:47', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('68', '061', 'MILLING WHEAT', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-30', '17:56:12', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('69', '062', 'JAGUNG SUMBAWA', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-10-07', '08:38:14', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('70', '063', 'SBM ARGENTINA', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-10-13', '14:10:46', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_item` VALUES ('71', '064', 'GANDUM UKRAINA', '0', '0', '1', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-10-13', '18:04:49', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');

-- ----------------------------
-- Table structure for sa_koordinat_poi
-- ----------------------------
DROP TABLE IF EXISTS `sa_koordinat_poi`;
CREATE TABLE `sa_koordinat_poi` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `location_name` varchar(150) NOT NULL DEFAULT '0',
  `latitude` varchar(25) NOT NULL,
  `longitude` varchar(25) NOT NULL,
  `image_url` varchar(100) NOT NULL,
  `icon_url` varchar(150) NOT NULL,
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`),
  KEY `rowID` (`rowID`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sa_koordinat_poi
-- ----------------------------
INSERT INTO `sa_koordinat_poi` VALUES ('3', 'PT New Hope Indo -  Jl. Raya Serang No.56, Sumur Bandung, Jayanti, Tangerang, Banten 15610, Indonesia', '-6.215527', '106.40832', '20161122190932_5834357cee9c9.jpg', '', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-17', '13:06:28', '1', '2016-11-22', '19:09:32', '1', '1', '2016-12-13', '17:00:00');
INSERT INTO `sa_koordinat_poi` VALUES ('4', ' Charoen Pokphand Indonesia Feedmill Cangkudu Balaraja Tangerang, Banten 15610 Indonesia', '-6.226682', '106.425265', '20161122190833_583435419699d.jpg', '', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-17', '13:06:49', '1', '2016-11-22', '19:38:30', '1', '1', '2016-12-13', '17:00:00');
INSERT INTO `sa_koordinat_poi` VALUES ('5', 'Dealer Honda Nangela Motor Jl. Raya Cikande Rangkasbitung Majasari Jawilan Serang Banten 42177', '-6.3030828', '106.3539857', '20161124111334_583668ee574fe.jpg', '', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-24', '09:40:19', '1', '2016-11-24', '11:13:34', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_koordinat_poi` VALUES ('6', 'Garasi Sumur Bandung Jl. Raya Serang No. 56 Sumur Bandung Jayanti Tangerang Banten 15610', '-6.2162807', '106.4080073', '20161124111322_583668e28f454.jpg', '', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-24', '09:45:15', '1', '2016-11-24', '11:13:22', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_koordinat_poi` VALUES ('7', 'Gudang J Jl. Kawasan Industri Krakatau Steel Tegalratu Ciwandan Kota Cilegon Banten 42445', '-6.0151799', '105.9628687', '20161124111311_583668d7317d6.jpg', '', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-24', '09:47:45', '1', '2016-11-24', '11:13:11', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_koordinat_poi` VALUES ('8', 'Gudang KMS Jl. Tol Tangerang Merak Kaserangan Ciruas Serang Banten 42183', '-6.1297469', '106.2593069', '20161124111236_583668b4e7183.jpg', '', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-24', '09:49:59', '1', '2016-11-24', '11:12:36', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_koordinat_poi` VALUES ('9', 'Gudang WM Jl. Raya Cikande Rangkasbitung Majasari Jawilan Serang Banten 42181', '-6.0235368', '106.0883901', '20161124111225_583668a979808.jpg', '', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-24', '09:51:35', '1', '2016-11-24', '11:12:25', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_koordinat_poi` VALUES ('10', 'Kantor Camat Jawilan Jl. Raya Cikande Rangkasbitung Majasari Jawilan Serang Banten 42177', '-6.2737972', '106.3447234', '20161124111137_58366879abe78.jpg', '', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-24', '09:53:46', '1', '2016-11-24', '11:11:37', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_koordinat_poi` VALUES ('11', 'Kecamatan Jayanti Jl. Raya Serang No. 9246 Cikande Jayanti Serang Banten 15610', '-6.2078401', '106.3856898', '20161124111116_58366864d1440.jpg', '', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-24', '09:56:24', '1', '2016-11-24', '11:11:16', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_koordinat_poi` VALUES ('12', 'Pertigaan Cikande Asem Jl. Raya Serang No. 9246 Cikande Jayanti Serang Banten 15610', '-6.2063924', '106.3689311', '20161124111100_58366854b8e2a.jpg', '', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-24', '09:57:12', '1', '2016-11-24', '11:11:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_koordinat_poi` VALUES ('13', 'Pintu Gerbang GD Kopo Jl. Raya Cikande Rangkasbitung No. 184 Bojot Jawilan Serang Banten 42177', '-6.3114241', '106.3493775', '20161124111043_583668436c8ce.jpg', '', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-24', '09:58:18', '1', '2016-11-24', '11:10:43', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_koordinat_poi` VALUES ('14', 'Pintu Keluar KBS Jl. Kawasan Industri Krakatau Steel Tegalratu Ciwandan Kota Cilegon Banten 42445', '-6.0165176', '105.9712702', '20161124111021_5836682dba735.jpg', '', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-24', '09:59:51', '1', '2016-11-24', '11:10:21', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_koordinat_poi` VALUES ('15', 'Pintu Masuk Dan Keluar Ciwandan Jl. Raya Anyer No. 7 Kepuh Ciwandan Kota Cilegon Banten 42446', '-6.0222798', '105.9564664', '20161124110919_583667ef48a45.jpg', '', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-24', '10:01:21', '1', '2016-11-24', '11:09:19', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_koordinat_poi` VALUES ('16', 'Pintu Masuk Kawasan KMS Jl. Tol Tangerang Merak Kaserangan Ciruas Serang Banten 42183', '-6.1297469', '106.2593069', '20161124110833_583667c191b44.jpg', '', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-24', '10:02:29', '1', '2016-11-24', '11:08:33', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_koordinat_poi` VALUES ('17', 'Pintu Masuk KBS Jl. Kawasan Industri Krakatau Steel Tegalratu Ciwandan Kota Cilegon Banten 42445', '-6.0191028', '105.966664', '20161124110513_583666f963894.jpg', '', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-24', '10:03:26', '1', '2016-11-24', '11:05:13', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_koordinat_poi` VALUES ('18', 'Pintu Masuk Pergudangan CM 1 Jl. Jaya Karta No. 22 Ramanuju Kec. Purwakarta Kota Cilegon Banten 42431', '-6.0058656', '106.0397364', '20161124110448_583666e060d9c.jpg', '', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-24', '10:04:08', '1', '2016-11-24', '11:04:48', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_koordinat_poi` VALUES ('19', 'TB Sumber Sarana Jl. Raya Cikande Rangkasbitung Kareo Jawilan Serang Banten 42177', '-6.2562573', '106.3546669', '20161124110425_583666c964d40.jpg', '', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-24', '10:04:55', '1', '2016-11-24', '11:04:25', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_koordinat_poi` VALUES ('20', 'WonokoyoJl. Raya Cikande Rangkasbitung Cikande Serang Banten 42186', '-6.2200611', '106.3608848', '20161124110404_583666b44b375.jpg', '', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-24', '10:06:15', '1', '2016-11-24', '11:04:04', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_koordinat_poi` VALUES ('21', 'Bulog Cikande Jl. Raya Jakarta Nambo Ilir Kibin Serang Banten 42185', '-6.1929906', '106.3448953', '20161124110336_58366698e9629.jpg', '', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-24', '10:35:29', '1', '2016-11-24', '11:03:37', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_koordinat_poi` VALUES ('22', 'Gerbang Tol Ciujung Jl. Raya Serang Jakarta Np. 182 Sentul Kragilan Serang Banten 42184', '-6.1400793', '106.2873723', '20161124110322_5836668ab1632.jpg', '', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-24', '10:39:22', '1', '2016-11-24', '11:03:22', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_koordinat_poi` VALUES ('23', 'Gudang Kado Jl. Raya Serang Jakarta Np. 91 Gembong Balaraja Tangerang Banten 15610', '-6.2223348', '106.4381994', '20161124110311_5836667f9f670.jpg', '', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-24', '10:44:50', '1', '2016-11-24', '11:03:11', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_koordinat_poi` VALUES ('24', 'Pintu Masuk Kawasan PT. Nikomas Jl. Raya Serang Jakarta No. 21 Ciagel Kibin Serang Banten 42185', '-6.1608227', '106.3229744', '20161124110258_58366672b177d.jpg', '', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-24', '10:45:48', '1', '2016-11-24', '11:02:58', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_koordinat_poi` VALUES ('25', 'Pintu Masuk Kawasan Modern Jl. Raya Serang Jakarta Kibin Serang Banten 42185', '-6.1863494', '106.3420296', '20161124110245_5836666539ff1.jpg', '', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-24', '10:46:58', '1', '2016-11-24', '11:02:45', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_koordinat_poi` VALUES ('26', 'Polsek Cikande Jl. Raya Jakarta Parigi Cikande Serang Banten 42186', '-6.2071275', '106.3618227', '20161124110233_58366659c2b21.jpg', '', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-24', '10:47:44', '1', '2016-11-24', '11:02:33', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_koordinat_poi` VALUES ('27', 'PT. Charoen Phokphand Indo Jl. Raya Serang No. 6 Cangkudu Balaraja Tangerang Banten 15610', '-6.2263327', '106.4247709', '20161124105933_583665a5eebba.jpg', '', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-24', '10:49:33', '1', '2016-11-24', '10:59:34', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_koordinat_poi` VALUES ('28', 'PT. Lung Cheong Industri Jl. Tol Tangerang Merak Kragilan Serang Banten 42184', '-6.1360185', '106.271679', '20161124105919_583665974187c.jpg', '', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-24', '10:50:11', '1', '2016-11-24', '10:59:19', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_koordinat_poi` VALUES ('29', 'PT. New Hope Indonesia Jl. Raya Serang No. 56 Sumur Bandung Jayanti Tangerang Banten 15610', '-6.2156638', '106.402701', '20161124105859_583665830e240.jpg', '', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-24', '10:50:45', '1', '2016-11-24', '10:58:59', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_koordinat_poi` VALUES ('30', 'SPBU Selikur Indonesia Jl. Raya Serang Jakarta Kragilan Serang Banten 42184', '-6.1429439', '106.3067637', '20161124105829_58366565b74c5.jpg', '', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-24', '10:51:18', '1', '2016-11-24', '10:58:29', '0', '0', '1901-01-01', '00:00:00');

-- ----------------------------
-- Table structure for sa_loan_parameter
-- ----------------------------
DROP TABLE IF EXISTS `sa_loan_parameter`;
CREATE TABLE `sa_loan_parameter` (
  `RowID` int(11) NOT NULL AUTO_INCREMENT,
  `comm_amount_from` double(15,0) DEFAULT '0',
  `comm_amount_to` double(15,0) DEFAULT NULL,
  `loan_amount` double(15,0) DEFAULT '0',
  PRIMARY KEY (`RowID`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sa_loan_parameter
-- ----------------------------
INSERT INTO `sa_loan_parameter` VALUES ('1', '0', '200000', '0');
INSERT INTO `sa_loan_parameter` VALUES ('2', '200001', '250000', '50000');
INSERT INTO `sa_loan_parameter` VALUES ('3', '250001', '350000', '100000');
INSERT INTO `sa_loan_parameter` VALUES ('4', '350001', '550000', '150000');
INSERT INTO `sa_loan_parameter` VALUES ('5', '550001', '750000', '200000');
INSERT INTO `sa_loan_parameter` VALUES ('6', '750001', '900000', '250000');
INSERT INTO `sa_loan_parameter` VALUES ('7', '900001', '1100000', '300000');
INSERT INTO `sa_loan_parameter` VALUES ('8', '1100001', '1200000', '350000');
INSERT INTO `sa_loan_parameter` VALUES ('9', '1200001', '1300000', '400000');
INSERT INTO `sa_loan_parameter` VALUES ('10', '1300001', '1400000', '450000');
INSERT INTO `sa_loan_parameter` VALUES ('11', '1400001', '1500000', '500000');
INSERT INTO `sa_loan_parameter` VALUES ('12', '1500001', '1600000', '550000');
INSERT INTO `sa_loan_parameter` VALUES ('13', '1600001', '1700000', '600000');
INSERT INTO `sa_loan_parameter` VALUES ('14', '1700001', '1800000', '650000');
INSERT INTO `sa_loan_parameter` VALUES ('15', '1800001', '1900000', '700000');
INSERT INTO `sa_loan_parameter` VALUES ('16', '1900001', '2000000', '750000');
INSERT INTO `sa_loan_parameter` VALUES ('17', '2000001', '2100000', '800000');
INSERT INTO `sa_loan_parameter` VALUES ('18', '2100001', '2200000', '850000');
INSERT INTO `sa_loan_parameter` VALUES ('19', '2200001', '2300000', '900000');
INSERT INTO `sa_loan_parameter` VALUES ('20', '2300001', '2400000', '950000');
INSERT INTO `sa_loan_parameter` VALUES ('21', '2400001', '2500000', '1000000');
INSERT INTO `sa_loan_parameter` VALUES ('22', '2500001', '2600000', '1050000');
INSERT INTO `sa_loan_parameter` VALUES ('23', '2600001', '2700000', '1100000');
INSERT INTO `sa_loan_parameter` VALUES ('24', '2700001', '2800000', '1150000');
INSERT INTO `sa_loan_parameter` VALUES ('25', '2800001', '2900000', '1200000');
INSERT INTO `sa_loan_parameter` VALUES ('26', '2900001', '3000000', '1250000');

-- ----------------------------
-- Table structure for sa_login_attempts
-- ----------------------------
DROP TABLE IF EXISTS `sa_login_attempts`;
CREATE TABLE `sa_login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(40) COLLATE utf8_bin NOT NULL,
  `login` varchar(50) COLLATE utf8_bin NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of sa_login_attempts
-- ----------------------------

-- ----------------------------
-- Table structure for sa_menu
-- ----------------------------
DROP TABLE IF EXISTS `sa_menu`;
CREATE TABLE `sa_menu` (
  `Seq_Menu` int(11) NOT NULL AUTO_INCREMENT,
  `Kd_Menu` int(11) NOT NULL,
  `Nm_Menu` char(50) NOT NULL,
  `Link_Menu` char(50) NOT NULL,
  `ParentID` int(11) NOT NULL,
  `Lang` char(50) NOT NULL,
  `status` enum('0','1') NOT NULL,
  PRIMARY KEY (`Seq_Menu`)
) ENGINE=InnoDB AUTO_INCREMENT=144 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sa_menu
-- ----------------------------
INSERT INTO `sa_menu` VALUES ('1', '1', 'Master', 'master', '0', 'master', '1');
INSERT INTO `sa_menu` VALUES ('2', '2', 'Item', 'items', '1', 'items', '1');
INSERT INTO `sa_menu` VALUES ('8', '8', 'Shift', 'shift', '1', 'collapseOne', '1');
INSERT INTO `sa_menu` VALUES ('9', '9', 'Transaction', 'transaksi', '0', 'transaction', '1');
INSERT INTO `sa_menu` VALUES ('10', '47', 'Vessel', 'vessel', '9', 'vessel', '1');
INSERT INTO `sa_menu` VALUES ('11', '11', 'Orders', 'orders', '9', 'orders', '1');
INSERT INTO `sa_menu` VALUES ('12', '12', 'Barcode Lists', 'orders/barcode_lists', '9', 'barcode_lists', '1');
INSERT INTO `sa_menu` VALUES ('13', '13', 'Verify Barcode', 'orders/verify_barcode', '9', 'verify_barcode', '1');
INSERT INTO `sa_menu` VALUES ('14', '14', 'Receipt Document', 'orders/receipt_document', '9', 'receipt_document', '1');
INSERT INTO `sa_menu` VALUES ('15', '15', 'Document Monitoring', 'orders/document_monitoring', '9', 'document_monitoring', '1');
INSERT INTO `sa_menu` VALUES ('18', '18', 'Closing Kapal Aktif', 'closingsjk', '9', 'collapseTwo', '1');
INSERT INTO `sa_menu` VALUES ('19', '19', 'List Kendaraan', 'kendaraan', '9', 'collapseTwo', '1');
INSERT INTO `sa_menu` VALUES ('20', '20', 'Last Status Kendaraan', 'laststatustruck', '9', 'collapseTwo', '1');
INSERT INTO `sa_menu` VALUES ('21', '80', 'Setting', 'settings', '0', 'settings', '0');
INSERT INTO `sa_menu` VALUES ('22', '22', 'Default Setting', 'settings/update/default', '21', 'default_settings', '1');
INSERT INTO `sa_menu` VALUES ('23', '23', 'Profile Setting', 'settings/profile_setting', '21', 'profile_settings', '1');
INSERT INTO `sa_menu` VALUES ('24', '24', 'Monitoring', 'monitoring', '0', 'monitoring', '1');
INSERT INTO `sa_menu` VALUES ('25', '2', 'Company', 'company', '1', 'companies', '1');
INSERT INTO `sa_menu` VALUES ('26', '4', 'Department', 'department', '1', 'departments', '1');
INSERT INTO `sa_menu` VALUES ('27', '3', 'Chart of Accounts', 'coa', '1', 'coas', '1');
INSERT INTO `sa_menu` VALUES ('28', '28', 'Period', 'period', '1', 'periods', '1');
INSERT INTO `sa_menu` VALUES ('29', '5', 'Debtor Type', 'debtor_type', '1', 'debtor_types', '1');
INSERT INTO `sa_menu` VALUES ('30', '6', 'Debtor', 'debtor', '1', 'debtors', '1');
INSERT INTO `sa_menu` VALUES ('31', '31', 'Driver', 'driver', '1', 'drivers', '1');
INSERT INTO `sa_menu` VALUES ('32', '32', 'Employee', 'employee', '1', 'employees', '1');
INSERT INTO `sa_menu` VALUES ('33', '7', 'Expense', 'expense', '1', 'expenses', '1');
INSERT INTO `sa_menu` VALUES ('34', '8', 'Cost Code', 'cost_code', '1', 'cost_codes', '1');
INSERT INTO `sa_menu` VALUES ('35', '35', 'Port', 'port', '1', 'ports', '1');
INSERT INTO `sa_menu` VALUES ('36', '10', 'Vehicle Category', 'vehicle_category', '1', 'vehicle_categories', '1');
INSERT INTO `sa_menu` VALUES ('37', '99', 'Balance Sheet Report', 'balance_sheet_report', '88', 'balance_sheet_report', '1');
INSERT INTO `sa_menu` VALUES ('38', '55', 'Realization List (Branch)', 'realizations_branch', '9', 'realizations_branch', '1');
INSERT INTO `sa_menu` VALUES ('39', '9', 'Destination To', 'destination_to', '1', 'destination_tos', '1');
INSERT INTO `sa_menu` VALUES ('40', '40', 'Unit Of Measure', 'uom', '1', 'uoms', '1');
INSERT INTO `sa_menu` VALUES ('41', '41', 'Cargo', 'item', '1', 'items', '1');
INSERT INTO `sa_menu` VALUES ('42', '42', 'Order Type', 'order_type', '1', 'order_types', '1');
INSERT INTO `sa_menu` VALUES ('43', '43', 'Order Description', 'order_description', '1', 'order_descriptions', '1');
INSERT INTO `sa_menu` VALUES ('44', '44', 'Invoice Type', 'invoice_type', '1', 'invoice_types', '1');
INSERT INTO `sa_menu` VALUES ('45', '45', 'Advance Type', 'advance_type', '1', 'advance_type', '1');
INSERT INTO `sa_menu` VALUES ('46', '46', 'AP Type', 'ap_type', '1', 'ap_types', '1');
INSERT INTO `sa_menu` VALUES ('47', '12', 'Vehicle', 'vehicle', '1', 'vehicles', '1');
INSERT INTO `sa_menu` VALUES ('48', '11', 'Fare Trip', 'fare_trip', '1', 'fare_trips', '1');
INSERT INTO `sa_menu` VALUES ('49', '49', 'Mapping Setup', 'mapping_setup', '1', 'mapping_setups', '1');
INSERT INTO `sa_menu` VALUES ('50', '50', 'Work Order', 'work_order', '9', 'work_orders', '1');
INSERT INTO `sa_menu` VALUES ('51', '51', 'Job Order', 'job_order', '9', 'job_orders', '1');
INSERT INTO `sa_menu` VALUES ('52', '52', 'Cash Advance List', 'finances/cash_advance_list', '9', 'cash_advance_list', '1');
INSERT INTO `sa_menu` VALUES ('53', '53', 'Delivery Order', 'delivery_order', '9', 'delivery_orders', '1');
INSERT INTO `sa_menu` VALUES ('54', '54', 'Cash Advance', 'finances/cash_advance', '9', 'cash_advance', '1');
INSERT INTO `sa_menu` VALUES ('55', '55', 'System Administration', 'System_Administration', '0', 'system_administration', '1');
INSERT INTO `sa_menu` VALUES ('56', '63', 'Cash Bank Payment', 'cash_bank_payment', '9', 'cash_bank_payment', '1');
INSERT INTO `sa_menu` VALUES ('57', '57', 'Invoice', 'invoice', '9', 'invoices', '1');
INSERT INTO `sa_menu` VALUES ('58', '58', 'Menus', 'menu', '1', 'menus', '1');
INSERT INTO `sa_menu` VALUES ('59', '59', 'Users', 'users/account', '1', 'users', '1');
INSERT INTO `sa_menu` VALUES ('75', '53', 'Vehicle Document', 'vehicle_document', '24', 'vehicle_documents', '1');
INSERT INTO `sa_menu` VALUES ('76', '54', 'Vehicle Position', 'vehicle_position', '24', 'vehicle_positions', '1');
INSERT INTO `sa_menu` VALUES ('77', '55', 'Vehicle Condition', 'vehicle_condition', '24', 'vehicle_conditions', '1');
INSERT INTO `sa_menu` VALUES ('78', '56', 'Vehicle Order', 'vehicle_order', '24', 'vehicle_orders', '1');
INSERT INTO `sa_menu` VALUES ('79', '9', 'Destination', 'destination', '1', 'destination', '1');
INSERT INTO `sa_menu` VALUES ('81', '57', 'Reference', 'vehicle_reference', '1', 'references', '1');
INSERT INTO `sa_menu` VALUES ('82', '56', 'Verification Document (Unverified)', 'verification_document', '9', 'verification_document', '1');
INSERT INTO `sa_menu` VALUES ('83', '61', 'Deposit', 'deposit', '9', 'deposit', '1');
INSERT INTO `sa_menu` VALUES ('84', '62', 'Generate Commission', 'generate_commission', '9', 'generate_commission', '1');
INSERT INTO `sa_menu` VALUES ('85', '66', 'Verify Driver', 'verify_driver', '9', 'verify_driver', '1');
INSERT INTO `sa_menu` VALUES ('86', '6', 'Creditor', 'creditor', '1', 'creditors', '1');
INSERT INTO `sa_menu` VALUES ('87', '58', 'Account Payable', 'account_payable', '9', 'account_payable', '1');
INSERT INTO `sa_menu` VALUES ('88', '65', 'Reports', 'reports', '0', 'reports', '1');
INSERT INTO `sa_menu` VALUES ('89', '66', 'Cash Advance Employee and Driver', 'receivable_employee', '88', 'receivable_employee', '1');
INSERT INTO `sa_menu` VALUES ('90', '67', 'Driver Monitoring', 'driver_monitoring', '24', 'driver_monitoring', '1');
INSERT INTO `sa_menu` VALUES ('91', '68', 'Cash Bank Payment And Receive', 'cb_payment_receive', '88', 'cb_payment_receive', '1');
INSERT INTO `sa_menu` VALUES ('92', '59', 'Advance', 'advance', '9', 'advance', '1');
INSERT INTO `sa_menu` VALUES ('93', '45', 'Cash Advance Type', 'cash_advance_type', '1', 'cash_advance_types', '1');
INSERT INTO `sa_menu` VALUES ('94', '71', 'Tire', 'tire', '24', 'tire', '1');
INSERT INTO `sa_menu` VALUES ('95', '72', 'Accu', 'accu', '24', 'accu', '1');
INSERT INTO `sa_menu` VALUES ('96', '73', 'Vehicle Utilities', 'utility_vehicles', '88', 'utility_vehicles', '1');
INSERT INTO `sa_menu` VALUES ('97', '60', 'Reimburse', 'reimburse', '9', 'reimburse', '1');
INSERT INTO `sa_menu` VALUES ('98', '54', 'Realization List', 'realizations', '9', 'realizations', '1');
INSERT INTO `sa_menu` VALUES ('99', '76', 'Realization Report', 'realization_report', '88', 'realization_report', '1');
INSERT INTO `sa_menu` VALUES ('100', '64', 'Cash Bank Payment (Branch)', 'cash_bank_payment_branch', '9', 'cash_bank_payment_branch', '1');
INSERT INTO `sa_menu` VALUES ('101', '65', 'Journal', 'journal', '9', 'general_ledger', '1');
INSERT INTO `sa_menu` VALUES ('102', '79', 'Schedule & Event', 'schedule_event', '24', 'schedule_event', '1');
INSERT INTO `sa_menu` VALUES ('103', '50', 'Container', 'container', '9', 'container', '1');
INSERT INTO `sa_menu` VALUES ('104', '36', 'POI Coordinate', 'koordinat_poi', '1', 'koordinat_poi', '1');
INSERT INTO `sa_menu` VALUES ('105', '48', 'Job Order EMKL', 'job_order_emkl', '9', 'job_order_emkl', '1');
INSERT INTO `sa_menu` VALUES ('106', '12', 'Transporter\'s Tarif', 'transporter_tarif', '1', 'transporter_tarif', '1');
INSERT INTO `sa_menu` VALUES ('107', '84', 'Cash Advance Pending', 'cash_advance_pending', '88', 'cash_advance_pending', '1');
INSERT INTO `sa_menu` VALUES ('108', '85', 'Verification Document Report', 'verification_document_report', '88', 'verification_document_report', '1');
INSERT INTO `sa_menu` VALUES ('109', '80', 'Cash Advance Deleted', 'cash_advance_deleted', '24', 'cash_advance_deleted', '1');
INSERT INTO `sa_menu` VALUES ('110', '87', 'Vehicle Monitor', 'vehicle_monitor', '24', 'vehicle_monitor', '1');
INSERT INTO `sa_menu` VALUES ('111', '88', 'Cancel Printed', 'ca_invoice_printed', '24', 'ca_invoice_printed', '1');
INSERT INTO `sa_menu` VALUES ('112', '49', 'SPK Transporter', 'spk_transporter', '9', 'spk_transporter', '1');
INSERT INTO `sa_menu` VALUES ('113', '90', 'Approval Reimburse', 'approval_reimburse', '9', 'approval_reimburse', '1');
INSERT INTO `sa_menu` VALUES ('114', '91', 'Brand', 'brand', '1', 'brand', '1');
INSERT INTO `sa_menu` VALUES ('115', '92', 'Planning Order', 'planning_order', '9', 'planning_order', '1');
INSERT INTO `sa_menu` VALUES ('116', '93', 'Part/Service', 'part_service', '1', 'part_service', '1');
INSERT INTO `sa_menu` VALUES ('117', '79', 'Workshop', 'workshop', '0', 'workshop', '1');
INSERT INTO `sa_menu` VALUES ('118', '95', 'Service History', 'service_history', '117', 'service_history', '1');
INSERT INTO `sa_menu` VALUES ('119', '96', 'Planning Order Monitor', 'planning_order_monitor', '24', 'planning_order_monitor', '1');
INSERT INTO `sa_menu` VALUES ('120', '97', 'General Ledger Report', 'general_ledger_report', '88', 'general_ledger_report', '1');
INSERT INTO `sa_menu` VALUES ('121', '99', 'Driver Attendance', 'driver_attendance', '88', 'driver_attendance', '1');
INSERT INTO `sa_menu` VALUES ('122', '100', 'Invoice Report', 'invoice_report', '88', 'invoice_report', '1');
INSERT INTO `sa_menu` VALUES ('123', '53', 'Cash Advance List (Branch)', 'finances/cash_advance_list_branch', '9', 'cash_advance_list_branch', '1');
INSERT INTO `sa_menu` VALUES ('124', '98', 'Journal Report', 'journal_report', '88', 'journal_report', '1');
INSERT INTO `sa_menu` VALUES ('125', '69', 'Cash Bank Payment And Receive (Branch)', 'cb_payment_receive_branch', '88', 'cb_payment_receive_branch', '1');
INSERT INTO `sa_menu` VALUES ('126', '77', 'Realization Report (Branch)', 'realization_branch_report', '88', 'realization_branch_report', '1');
INSERT INTO `sa_menu` VALUES ('127', '104', 'Account Payable Report', 'account_payable_report', '88', 'account_payable_report', '1');
INSERT INTO `sa_menu` VALUES ('128', '81', 'Refund List', 'refunds', '24', 'refunds', '1');
INSERT INTO `sa_menu` VALUES ('129', '83', 'Cash Advance Destination', 'cash_advance_destination', '88', 'cash_advance_destination', '1');
INSERT INTO `sa_menu` VALUES ('130', '56', 'Verification Document (Verified)', 'verification_document_verified', '9', 'verification_document_verified', '1');
INSERT INTO `sa_menu` VALUES ('131', '108', 'Upload Driver Attendance', 'upload_driver_attendance', '9', 'upload_driver_attendance', '1');
INSERT INTO `sa_menu` VALUES ('132', '109', 'Driver Attendance Monitor', 'driver_attendance_monitor', '24', 'driver_attendance_monitor', '1');
INSERT INTO `sa_menu` VALUES ('133', '110', 'DO Not Yet Invoiced Report', 'do_not_yet_invoiced_report', '88', 'do_not_yet_invoiced_report', '1');
INSERT INTO `sa_menu` VALUES ('134', '111', 'Delivery Order Commission', 'do_commission_report', '88', 'do_commission_report', '1');
INSERT INTO `sa_menu` VALUES ('135', '112', 'Yearly Bonus', 'yearly_bonus_report', '88', 'yearly_bonus_report', '1');
INSERT INTO `sa_menu` VALUES ('136', '113', 'Loan Report', 'loan_report', '88', 'loan_report', '1');
INSERT INTO `sa_menu` VALUES ('137', '114', 'Service Receipt', 'service_receipt', '117', 'service_receipt', '1');
INSERT INTO `sa_menu` VALUES ('138', '115', 'Deposit Report', 'deposit_report', '88', 'deposit_report', '1');
INSERT INTO `sa_menu` VALUES ('139', '116', 'Trial Balance Report', 'trial_balance_report', '88', 'trial_balance_report', '1');
INSERT INTO `sa_menu` VALUES ('140', '117', 'Reimburse Report', 'reimburse_report', '88', 'reimburse_report', '1');
INSERT INTO `sa_menu` VALUES ('141', '118', 'Check Balancing Report', 'check_balancing_report', '88', 'check_balancing_report', '1');
INSERT INTO `sa_menu` VALUES ('142', '119', 'Service History Report', 'service_history_report', '88', 'service_history_report', '1');
INSERT INTO `sa_menu` VALUES ('143', '120', 'Cheque/Giro Report', 'cheque_giro_report', '88', 'cheque_giro_report', '1');

-- ----------------------------
-- Table structure for sa_order_descs
-- ----------------------------
DROP TABLE IF EXISTS `sa_order_descs`;
CREATE TABLE `sa_order_descs` (
  `rowID` smallint(6) NOT NULL AUTO_INCREMENT,
  `descs_cd` varchar(10) NOT NULL DEFAULT '',
  `descs` varchar(35) NOT NULL DEFAULT '',
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`,`descs_cd`),
  KEY `rowID` (`rowID`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sa_order_descs
-- ----------------------------

-- ----------------------------
-- Table structure for sa_order_type
-- ----------------------------
DROP TABLE IF EXISTS `sa_order_type`;
CREATE TABLE `sa_order_type` (
  `rowID` smallint(6) NOT NULL AUTO_INCREMENT,
  `type` char(1) NOT NULL,
  `type_cd` varchar(6) NOT NULL DEFAULT '',
  `descs` varchar(25) NOT NULL DEFAULT '',
  `curah` char(1) NOT NULL DEFAULT 'N',
  `container` char(1) NOT NULL DEFAULT 'N',
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`,`type_cd`),
  KEY `rowID` (`rowID`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sa_order_type
-- ----------------------------

-- ----------------------------
-- Table structure for sa_part_service_hdr
-- ----------------------------
DROP TABLE IF EXISTS `sa_part_service_hdr`;
CREATE TABLE `sa_part_service_hdr` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `type` enum('service','part','material','template') NOT NULL,
  `row_no` int(11) NOT NULL,
  `code` varchar(25) NOT NULL,
  `name` varchar(150) NOT NULL DEFAULT '0',
  `work_hours` double NOT NULL,
  `flat_rate` double NOT NULL,
  `moving_type` enum('slow','fast') DEFAULT NULL,
  `variant` varchar(100) NOT NULL,
  `brand_rowID` int(11) NOT NULL,
  `uom_rowID` int(11) NOT NULL,
  `discount_type` varchar(10) NOT NULL,
  `discount` double NOT NULL,
  `sale_price` double NOT NULL,
  `hpp` double NOT NULL,
  `reorder` smallint(6) NOT NULL,
  `last_stock` smallint(6) NOT NULL,
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`,`code`),
  KEY `rowID` (`rowID`),
  KEY `deleted` (`deleted`) USING BTREE,
  KEY `brand_rowID` (`brand_rowID`),
  KEY `uom_rowID` (`uom_rowID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sa_part_service_hdr
-- ----------------------------

-- ----------------------------
-- Table structure for sa_port
-- ----------------------------
DROP TABLE IF EXISTS `sa_port`;
CREATE TABLE `sa_port` (
  `rowID` smallint(6) NOT NULL AUTO_INCREMENT,
  `port_cd` varchar(6) NOT NULL DEFAULT '',
  `port_name` varchar(60) NOT NULL DEFAULT '',
  `port_type` enum('PORT','WAREHOUSE','DEPO') NOT NULL,
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`,`port_cd`),
  KEY `rowID` (`rowID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sa_port
-- ----------------------------
INSERT INTO `sa_port` VALUES ('1', 'TP', 'TANJUNG PRIOK', 'PORT', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_port` VALUES ('2', 'MRK', 'MERAK', 'PORT', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_port` VALUES ('3', 'SDK', 'SUNDA KELAPA', 'PORT', '0', '0', '1901-01-01', '00:00:00', '11', '2016-02-18', '08:52:46', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_port` VALUES ('4', 'TES', 'TESTING', 'PORT', '0', '0', '1901-01-01', '00:00:00', '11', '2016-07-12', '11:57:00', '0', '1901-01-01', '00:00:00', '1', '11', '2016-07-12', '11:57:13');
INSERT INTO `sa_port` VALUES ('6', 'CGD', 'CIGADING', 'PORT', '0', '0', '1901-01-01', '00:00:00', '11', '2016-08-10', '10:03:34', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_port` VALUES ('7', 'CWD', 'CIWANDAN', 'PORT', '0', '0', '1901-01-01', '00:00:00', '1', '2016-09-08', '13:56:02', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_port` VALUES ('8', 'KPO', 'GUDANG KOPO', 'WAREHOUSE', '0', '0', '1901-01-01', '00:00:00', '1', '2016-09-28', '22:25:49', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_port` VALUES ('9', 'GWM', 'GUDANG WARGA MULYA', 'WAREHOUSE', '0', '0', '1901-01-01', '00:00:00', '1', '2016-09-29', '14:57:55', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_port` VALUES ('10', 'KIE', 'GUDANG KIEC', 'WAREHOUSE', '0', '0', '1901-01-01', '00:00:00', '1', '2016-09-29', '15:03:15', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_port` VALUES ('11', 'HLC', 'HOLCIM PLANT', 'PORT', '0', '0', '1901-01-01', '00:00:00', '1', '2016-10-07', '09:12:16', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_port` VALUES ('12', 'GCM', 'GUDANG CM1', 'WAREHOUSE', '0', '0', '1901-01-01', '00:00:00', '1', '2016-10-12', '21:28:19', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_port` VALUES ('13', 'TEST', 'TESTING', 'PORT', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-02', '16:23:16', '1', '2016-11-02', '16:26:10', '1', '1', '2016-11-02', '16:26:17');
INSERT INTO `sa_port` VALUES ('14', 'TPERAK', 'TANJUNG PERAK', 'WAREHOUSE', '0', '0', '1901-01-01', '00:00:00', '1', '2016-11-08', '09:06:52', '1', '2016-11-08', '09:07:11', '1', '1', '2016-11-08', '09:07:17');

-- ----------------------------
-- Table structure for sa_reference
-- ----------------------------
DROP TABLE IF EXISTS `sa_reference`;
CREATE TABLE `sa_reference` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `type_ref` varchar(255) DEFAULT NULL,
  `type_no` tinyint(4) DEFAULT NULL,
  `type_name` varchar(255) DEFAULT NULL,
  `Kondisi_Ref_Char_01` varchar(100) DEFAULT NULL,
  `Kondisi_Ref_Char_02` varchar(100) DEFAULT NULL,
  `Kondisi_Ref_Char_03` varchar(100) DEFAULT NULL,
  `Kondisi_Ref_Char_04` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`rowID`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sa_reference
-- ----------------------------
INSERT INTO `sa_reference` VALUES ('1', 'kondisi_truck', '1', 'Siap Jalan', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('2', 'kondisi_truck', '2', 'Jalan', null, 'go-50x50.png', null, null);
INSERT INTO `sa_reference` VALUES ('3', 'kondisi_truck', '3', 'Perbaikan', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('4', 'kondisi_truck', '4', 'Rusak', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('5', 'surat_truck', '1', 'BPKB', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('6', 'surat_truck', '2', 'STNK', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('7', 'surat_truck', '3', 'KIR', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('8', 'gps_truck', '1', 'Jalan', '11', 'go-50x50.png', null, null);
INSERT INTO `sa_reference` VALUES ('9', 'gps_truck', '2', 'Macet/Antri/Parkir', '11', 'traffic-50x50.png', null, null);
INSERT INTO `sa_reference` VALUES ('10', 'gps_truck', '3', 'Makan AKI', '01', 'accu-50x50.png', null, null);
INSERT INTO `sa_reference` VALUES ('11', 'gps_truck', '4', 'Berhenti', '00', 'stop-50x50.png', null, null);
INSERT INTO `sa_reference` VALUES ('12', 'gps_truck', '5', 'Check Instalasi ACC & Engine', '10', 'ignition-50x50.png', null, null);
INSERT INTO `sa_reference` VALUES ('13', 'gps_truck', '6', 'Mohon diperiksa', '10', 'repair-50x50.png', null, null);
INSERT INTO `sa_reference` VALUES ('14', 'gps_truck', '7', 'Data Tidak Tersedia', null, 'notready-50x50.png', null, null);
INSERT INTO `sa_reference` VALUES ('15', 'sites', '1', 'Cigading', 'Pelabuhan Cigading', null, null, null);
INSERT INTO `sa_reference` VALUES ('16', 'sites', '2', 'Tanjung Priok', 'Pelabuhan Tanjung Priok', null, null, null);
INSERT INTO `sa_reference` VALUES ('17', 'sites', '3', 'Sumur Bandung', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('18', 'sites', '4', 'Holcim', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('19', 'companies', '1', 'TIK', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('20', 'companies', '2', 'TAS', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('21', 'companies', '3', 'SMJ', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('22', 'companies', '4', 'BIG PBM', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('23', 'companies', '5', 'BIG TRANSPORT', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('24', 'destination_flag', '1', 'SUMBER', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('25', 'destination_flag', '2', 'CLIENT', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('26', 'destination_flag', '3', 'POK', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('27', 'truck_type', '1', 'AKE', 'ENGKEL', null, null, null);
INSERT INTO `sa_reference` VALUES ('28', 'truck_type', '2', 'DT', 'DUMP TRUCK', null, null, null);
INSERT INTO `sa_reference` VALUES ('29', 'truck_type', '3', 'GD', 'GANDENGAN', null, null, null);
INSERT INTO `sa_reference` VALUES ('30', 'truck_type', '4', 'OT 20\" / TR', 'OPEN TOP 20\" / TRAILER', null, null, null);
INSERT INTO `sa_reference` VALUES ('31', 'truck_type', '5', 'OT 30\" / TR', 'OPEN TOP 30\" / TRAILER', null, null, null);
INSERT INTO `sa_reference` VALUES ('32', 'truck_type', '6', 'OT 40\" / TR', 'OPEN TOP 40\" / TRAILER', null, null, null);
INSERT INTO `sa_reference` VALUES ('33', 'truck_type', '7', 'TT', 'TRONTON', null, null, null);
INSERT INTO `sa_reference` VALUES ('34', 'vessel_status', '1', 'OPEN', 'primary', 'vessels/view_by_status/', 'open', 'vessels/mark_status/');
INSERT INTO `sa_reference` VALUES ('35', 'vessel_status', '2', 'ON PROGRESS', 'success', 'vessels/view_by_status/', 'on_progress', 'vessels/mark_status/');
INSERT INTO `sa_reference` VALUES ('36', 'vessel_status', '3', 'SUSPENDED', 'warning', 'vessels/view_by_status/', 'suspended', 'vessels/mark_status/');
INSERT INTO `sa_reference` VALUES ('37', 'vessel_status', '4', 'CLOSED', 'default', 'vessels/view_by_status/', 'closed', 'vessels/mark_status/');
INSERT INTO `sa_reference` VALUES ('38', 'vessel_status', '5', 'VOID', 'danger', 'vessels/view_by_status/', 'void', 'vessels/mark_status/');
INSERT INTO `sa_reference` VALUES ('39', 'vessel_palka', '1', 'palka_1', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('40', 'vessel_palka', '2', 'palka_2', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('41', 'vessel_palka', '3', 'palka_3', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('42', 'vessel_palka', '4', 'palka_4', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('43', 'vessel_palka', '5', 'palka_5', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('44', 'vessel_palka', '6', 'palka_6', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('45', 'vessel_palka', '7', 'palka_7', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('46', 'vessel_palka', '8', 'palka_8', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('47', 'vessel_palka', '9', 'palka_9', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('48', 'vessel_palka', '10', 'palka_10', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('49', 'party', '1', 'A', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('50', 'party', '2', 'B', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('51', 'party', '3', 'C', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('52', 'party', '4', 'D', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('53', 'party', '5', 'E', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('54', 'party', '6', 'F', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('55', 'party', '7', 'G', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('56', 'party', '8', 'H', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('57', 'party', '9', 'I', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('58', 'party', '10', 'J', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('59', 'item_type', '1', 'C', 'BULK', null, null, null);
INSERT INTO `sa_reference` VALUES ('60', 'item_type', '2', 'B', 'BAG', null, null, null);
INSERT INTO `sa_reference` VALUES ('61', 'item_type', '3', 'O', 'OTHER', null, null, null);
INSERT INTO `sa_reference` VALUES ('62', 'ticket_status', '1', 'NEW', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('63', 'ticket_status', '2', 'ON PROGRESS', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('64', 'ticket_status', '3', 'CLOSED', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('65', 'ticket_status', '4', 'SUSPENDED', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('66', 'ticket_status', '5', 'VOID', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('67', 'ticket_category', '1', 'GENERAL', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('68', 'ticket_category', '2', 'HARDWARE', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('69', 'ticket_category', '3', 'SOFTWARE', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('70', 'ticket_category', '4', 'NETWORKING', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('71', 'priority', '1', 'LOW(1 week)', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('72', 'priority', '2', 'MEDIUM(3 days)', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('73', 'priority', '3', 'HIGH(1 day)', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('74', 'priority', '4', 'URGENT', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('75', 'jo_type', '1', 'BULK', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('76', 'jo_type', '2', 'CONTAINER', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('77', 'jo_type', '3', 'OTHER', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('78', 'cb_type', '1', 'BKK', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('79', 'cb_type', '2', 'BKM', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('80', 'cb_type', '3', 'BBK', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('81', 'cb_type', '4', 'BBM', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('82', 'max_loan', null, '1000000', '400000', null, null, null);
INSERT INTO `sa_reference` VALUES ('83', 'max_loan', null, '500000', '200000', null, null, null);
INSERT INTO `sa_reference` VALUES ('84', 'max_loan', null, '1500000', '500000', null, null, null);
INSERT INTO `sa_reference` VALUES ('85', 'max_loan', null, 'else', '1000000', null, null, null);
INSERT INTO `sa_reference` VALUES ('86', 'top_kb', '0', 'CASH', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('87', 'top_kb', '7', '7 DAYS', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('88', 'top_kb', '14', '14 DAYS', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('89', 'top_kb', '21', '21 DAYS', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('90', 'top_kb', '30', '30 DAYS', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('91', 'top_kb', '45', '45 DAYS', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('92', 'top_kb', '60', '60 DAYS', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('93', 'top_kb', '75', '75 DAYS', null, null, null, null);
INSERT INTO `sa_reference` VALUES ('94', 'top_kb', '90', '90 DAYS', null, null, null, null);

-- ----------------------------
-- Table structure for sa_roles
-- ----------------------------
DROP TABLE IF EXISTS `sa_roles`;
CREATE TABLE `sa_roles` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(64) CHARACTER SET latin1 NOT NULL,
  `default` int(11) NOT NULL,
  PRIMARY KEY (`rowID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sa_roles
-- ----------------------------
INSERT INTO `sa_roles` VALUES ('1', 'admin', '1');
INSERT INTO `sa_roles` VALUES ('2', 'client', '2');
INSERT INTO `sa_roles` VALUES ('3', 'collaborator', '3');
INSERT INTO `sa_roles` VALUES ('4', 'general', '4');

-- ----------------------------
-- Table structure for sa_spec
-- ----------------------------
DROP TABLE IF EXISTS `sa_spec`;
CREATE TABLE `sa_spec` (
  `rowID` smallint(6) NOT NULL AUTO_INCREMENT,
  `gl_coaID_trans_acc` smallint(20) NOT NULL DEFAULT '0',
  `gl_coaID_cash_opr_acc` smallint(20) NOT NULL DEFAULT '0',
  `gl_coaID_bank_receipt_acc` smallint(20) NOT NULL DEFAULT '0',
  `gl_coaID_bank_payment_acc` smallint(20) NOT NULL DEFAULT '0',
  `employeeID_cash_adv` smallint(10) NOT NULL DEFAULT '0',
  `uom_rowID` smallint(6) NOT NULL DEFAULT '0',
  `cogs_journal_to` varchar(25) NOT NULL DEFAULT '',
  `general_jrn` varchar(3) NOT NULL DEFAULT '',
  `memorial_jrn` varchar(3) NOT NULL DEFAULT '',
  `reversal_jrn` varchar(3) NOT NULL DEFAULT '',
  `bank_in_prefix` varchar(3) NOT NULL DEFAULT '',
  `bank_out_prefix` varchar(3) NOT NULL DEFAULT '',
  `cash_in_prefix` varchar(3) NOT NULL DEFAULT '',
  `cash_out_prefix` varchar(3) NOT NULL DEFAULT '',
  `bank_rcp` varchar(3) NOT NULL DEFAULT '',
  `bank_pay` varchar(3) NOT NULL DEFAULT '',
  `cash_rcp` varchar(3) NOT NULL DEFAULT '',
  `cash_pay` varchar(3) NOT NULL DEFAULT '',
  `wo` varchar(3) NOT NULL DEFAULT '',
  `po` varchar(3) NOT NULL DEFAULT '',
  `co` varchar(3) NOT NULL DEFAULT '',
  `jo` varchar(3) NOT NULL DEFAULT '',
  `do` varchar(3) NOT NULL DEFAULT '',
  `pod` varchar(3) NOT NULL DEFAULT '',
  `cash_adv_bgt` varchar(3) NOT NULL DEFAULT '',
  `cash_adv_apv` varchar(3) NOT NULL DEFAULT '',
  `cash_adv_stl` varchar(3) NOT NULL DEFAULT '',
  `cash_adv` varchar(3) NOT NULL DEFAULT '',
  `closing_jo` varchar(3) NOT NULL DEFAULT '',
  `ar_inv` varchar(3) NOT NULL DEFAULT '',
  `ar_inv_no_tax` varchar(3) NOT NULL DEFAULT '',
  `ap_inv` varchar(3) NOT NULL DEFAULT '',
  `ap_inv_no_tax` varchar(3) NOT NULL DEFAULT '',
  `kontra_bon` varchar(3) NOT NULL,
  `commission_prefix` varchar(4) NOT NULL,
  `deposit_prefix` varchar(3) NOT NULL DEFAULT '',
  `advance_prefix` varchar(3) NOT NULL,
  `reimburse_prefix` varchar(3) NOT NULL,
  `spk_transporter` varchar(3) NOT NULL,
  `service_history` varchar(3) NOT NULL,
  `planning_order` varchar(3) NOT NULL,
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sa_spec
-- ----------------------------
INSERT INTO `sa_spec` VALUES ('1', '20', '7', '9', '10', '6', '1', 'WIP', 'JU', 'JM', 'JK', 'BM', 'BK', 'KM', 'KK', 'BBM', 'BBK', 'BKM', 'BKK', 'WO', 'PO', 'CO', 'JO', 'DO', 'PD', 'BG', 'AP', 'JM', 'AV', 'JM', 'INV', '', 'AP', '', 'KB', 'COMM', 'DEP', 'ADV', 'RMB', 'SPK', 'SVH', 'PLO', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');

-- ----------------------------
-- Table structure for sa_template_service
-- ----------------------------
DROP TABLE IF EXISTS `sa_template_service`;
CREATE TABLE `sa_template_service` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(25) NOT NULL,
  `service_code` varchar(25) NOT NULL DEFAULT '0',
  `work_hours_template` double(5,0) NOT NULL,
  `flat_rate_template` double NOT NULL,
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`,`code`),
  KEY `rowID` (`rowID`),
  KEY `deleted` (`deleted`) USING BTREE,
  KEY `code` (`code`) USING BTREE,
  KEY `service_rowID` (`service_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sa_template_service
-- ----------------------------

-- ----------------------------
-- Table structure for sa_tire_brand
-- ----------------------------
DROP TABLE IF EXISTS `sa_tire_brand`;
CREATE TABLE `sa_tire_brand` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `tire_brand` text NOT NULL,
  PRIMARY KEY (`rowID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sa_tire_brand
-- ----------------------------

-- ----------------------------
-- Table structure for sa_transporter_tarif_dtl
-- ----------------------------
DROP TABLE IF EXISTS `sa_transporter_tarif_dtl`;
CREATE TABLE `sa_transporter_tarif_dtl` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `transporter_tarif_rowID` int(11) NOT NULL,
  `to_rowID` int(11) NOT NULL,
  `vehicle_type_rowID` int(11) NOT NULL,
  `price` double NOT NULL,
  `printed` tinyint(4) NOT NULL,
  `user_printed` int(11) NOT NULL,
  `date_printed` date NOT NULL,
  `time_printed` time NOT NULL,
  `user_created` int(11) NOT NULL,
  `date_created` date NOT NULL,
  `time_created` time NOT NULL,
  `user_modified` int(11) NOT NULL,
  `date_modified` date NOT NULL,
  `time_modified` time NOT NULL,
  `deleted` tinyint(4) NOT NULL,
  `user_deleted` int(11) NOT NULL,
  `date_deleted` date NOT NULL,
  `time_deleted` time NOT NULL,
  PRIMARY KEY (`rowID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sa_transporter_tarif_dtl
-- ----------------------------

-- ----------------------------
-- Table structure for sa_transporter_tarif_hdr
-- ----------------------------
DROP TABLE IF EXISTS `sa_transporter_tarif_hdr`;
CREATE TABLE `sa_transporter_tarif_hdr` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `creditor_rowID` int(11) NOT NULL,
  `jo_type` tinyint(1) NOT NULL,
  `cargo_rowID` int(11) NOT NULL,
  `from_rowID` varchar(25) NOT NULL,
  `printed` tinyint(4) NOT NULL,
  `user_printed` int(11) NOT NULL,
  `date_printed` date NOT NULL,
  `time_printed` time NOT NULL,
  `user_created` int(11) NOT NULL,
  `date_created` date NOT NULL,
  `time_created` time NOT NULL,
  `user_modified` int(11) NOT NULL,
  `date_modified` date NOT NULL,
  `time_modified` time NOT NULL,
  `deleted` tinyint(4) NOT NULL,
  `user_deleted` int(11) NOT NULL,
  `date_deleted` date NOT NULL,
  `time_deleted` time NOT NULL,
  PRIMARY KEY (`rowID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sa_transporter_tarif_hdr
-- ----------------------------

-- ----------------------------
-- Table structure for sa_un_sessions
-- ----------------------------
DROP TABLE IF EXISTS `sa_un_sessions`;
CREATE TABLE `sa_un_sessions` (
  `session_id` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of sa_un_sessions
-- ----------------------------
INSERT INTO `sa_un_sessions` VALUES ('2c029d7fab61ae07bd40a1a9699f9309', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.110 Safari/537.36', '1547882497', 0x613A32333A7B733A393A22757365725F64617461223B733A303A22223B733A31343A227265717565737465645F70616765223B733A33333A22687474703A2F2F6C6F63616C686F73742F6269675F746D732F686F6D6570616765223B733A31303A22757365725F726F774944223B733A313A2231223B733A383A22757365726E616D65223B733A353A2261646D696E223B733A373A22757365725F6964223B733A313A2231223B733A31333A22636F6D70616E795F726F774944223B733A313A2234223B733A393A226465705F726F774944223B733A313A2238223B733A31323A227061727469616C5F64617461223B733A313A2230223B733A31303A22726F6C655F726F774944223B733A313A2232223B733A31373A22726F6C655F726F7749445F766572696679223B733A313A2232223B733A363A22737461747573223B733A313A2231223B733A31353A22636F6D6D656E745F63726561746564223B733A313A2230223B733A31353A22636F6D6D656E745F75706461746564223B733A313A2230223B733A31353A22636F6D6D656E745F64656C65746564223B733A313A2230223B733A31343A22636F6D6D656E745F766965776564223B733A313A2230223B733A31373A22636F6D6D656E745F616374697661746564223B733A313A2230223B733A31353A22636F6D6D656E745F7265706C696564223B733A313A2230223B733A31343A227469636B65745F63726561746564223B733A313A2231223B733A31343A227469636B65745F75706461746564223B733A313A2231223B733A31343A227469636B65745F64656C65746564223B733A313A2231223B733A31333A227469636B65745F766965776564223B733A313A2231223B733A31343A227469636B65745F7265706C696564223B733A313A2231223B733A31333A2270726576696F75735F70616765223B733A33333A22687474703A2F2F6C6F63616C686F73742F6269675F746D732F686F6D6570616765223B7D);
INSERT INTO `sa_un_sessions` VALUES ('5923718b8b4b5aa348524e5e61d4c16f', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.110 Safari/537.36', '1547650327', 0x613A32353A7B733A393A22757365725F64617461223B733A303A22223B733A31343A227265717565737465645F70616765223B733A39383A22687474703A2F2F6C6F63616C686F73742F6269675F746D732D6F6C642F7265736F757263652F706C7567696E2F626F6F7473747261702D646174657069636B65722F626F6F7473747261702D646174657069636B65722E6D696E2E6373732E6D6170223B733A31303A22757365725F726F774944223B733A313A2231223B733A383A22757365726E616D65223B733A353A2261646D696E223B733A373A22757365725F6964223B733A313A2231223B733A31333A22636F6D70616E795F726F774944223B733A313A2234223B733A393A226465705F726F774944223B733A313A2238223B733A31323A227061727469616C5F64617461223B733A313A2230223B733A31303A22726F6C655F726F774944223B733A313A2232223B733A31373A22726F6C655F726F7749445F766572696679223B733A313A2232223B733A363A22737461747573223B733A313A2231223B733A31353A22636F6D6D656E745F63726561746564223B733A313A2230223B733A31353A22636F6D6D656E745F75706461746564223B733A313A2230223B733A31353A22636F6D6D656E745F64656C65746564223B733A313A2230223B733A31343A22636F6D6D656E745F766965776564223B733A313A2230223B733A31373A22636F6D6D656E745F616374697661746564223B733A313A2230223B733A31353A22636F6D6D656E745F7265706C696564223B733A313A2230223B733A31343A227469636B65745F63726561746564223B733A313A2231223B733A31343A227469636B65745F75706461746564223B733A313A2231223B733A31343A227469636B65745F64656C65746564223B733A313A2231223B733A31333A227469636B65745F766965776564223B733A313A2231223B733A31343A227469636B65745F7265706C696564223B733A313A2231223B733A31333A2270726576696F75735F70616765223B733A39383A22687474703A2F2F6C6F63616C686F73742F6269675F746D732D6F6C642F7265736F757263652F706C7567696E2F626F6F7473747261702D646174657069636B65722F626F6F7473747261702D646174657069636B65722E6D696E2E6373732E6D6170223B733A31313A22706167655F686561646572223B733A363A226D6173746572223B733A31313A22706167655F64657461696C223B733A343A22636F6173223B7D);
INSERT INTO `sa_un_sessions` VALUES ('d7b211ba5f023764ecf34f014c863c1e', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.110 Safari/537.36', '1547656004', 0x613A32353A7B733A393A22757365725F64617461223B733A303A22223B733A31303A22757365725F726F774944223B733A313A2231223B733A383A22757365726E616D65223B733A353A2261646D696E223B733A373A22757365725F6964223B733A313A2231223B733A31333A22636F6D70616E795F726F774944223B733A313A2234223B733A393A226465705F726F774944223B733A313A2238223B733A31323A227061727469616C5F64617461223B733A313A2230223B733A31303A22726F6C655F726F774944223B733A313A2232223B733A31373A22726F6C655F726F7749445F766572696679223B733A313A2232223B733A363A22737461747573223B733A313A2231223B733A31353A22636F6D6D656E745F63726561746564223B733A313A2230223B733A31353A22636F6D6D656E745F75706461746564223B733A313A2230223B733A31353A22636F6D6D656E745F64656C65746564223B733A313A2230223B733A31343A22636F6D6D656E745F766965776564223B733A313A2230223B733A31373A22636F6D6D656E745F616374697661746564223B733A313A2230223B733A31353A22636F6D6D656E745F7265706C696564223B733A313A2230223B733A31343A227469636B65745F63726561746564223B733A313A2231223B733A31343A227469636B65745F75706461746564223B733A313A2231223B733A31343A227469636B65745F64656C65746564223B733A313A2231223B733A31333A227469636B65745F766965776564223B733A313A2231223B733A31343A227469636B65745F7265706C696564223B733A313A2231223B733A31343A227265717565737465645F70616765223B733A32383A22687474703A2F2F6C6F63616C686F73742F6269675F746D732F636F61223B733A31333A2270726576696F75735F70616765223B733A32383A22687474703A2F2F6C6F63616C686F73742F6269675F746D732F636F61223B733A31313A22706167655F686561646572223B733A363A226D6173746572223B733A31313A22706167655F64657461696C223B733A343A22636F6173223B7D);

-- ----------------------------
-- Table structure for sa_uom
-- ----------------------------
DROP TABLE IF EXISTS `sa_uom`;
CREATE TABLE `sa_uom` (
  `rowID` smallint(6) NOT NULL AUTO_INCREMENT,
  `uom_cd` varchar(6) NOT NULL DEFAULT '',
  `descs` varchar(40) NOT NULL DEFAULT '',
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`,`uom_cd`),
  KEY `rowID` (`rowID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sa_uom
-- ----------------------------
INSERT INTO `sa_uom` VALUES ('1', 'KGS', 'KILO GRAMS', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_uom` VALUES ('2', 'TON', 'TON', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');

-- ----------------------------
-- Table structure for sa_usermenu
-- ----------------------------
DROP TABLE IF EXISTS `sa_usermenu`;
CREATE TABLE `sa_usermenu` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `company_rowID` tinyint(4) NOT NULL DEFAULT '1',
  `dep_rowID` tinyint(4) NOT NULL DEFAULT '1',
  `user_rowID` int(10) NOT NULL,
  `Kd_Menu` int(11) NOT NULL,
  `Availabled` tinyint(4) NOT NULL DEFAULT '0',
  `Created` tinyint(1) NOT NULL DEFAULT '0',
  `Viewed` tinyint(4) NOT NULL DEFAULT '0',
  `Updated` tinyint(4) NOT NULL DEFAULT '0',
  `Deleted` tinyint(4) NOT NULL DEFAULT '0',
  `Approved` tinyint(4) NOT NULL,
  `Verified` tinyint(4) NOT NULL DEFAULT '0',
  `Verified_Second` tinyint(4) NOT NULL,
  `FullAccess` tinyint(4) NOT NULL DEFAULT '0',
  `PrintLimited` tinyint(4) NOT NULL DEFAULT '0',
  `PrintUnlimited` tinyint(4) NOT NULL DEFAULT '0',
  `PrintOne` tinyint(4) NOT NULL DEFAULT '0',
  `PrintTwo` tinyint(4) NOT NULL DEFAULT '0',
  `Actived` tinyint(4) NOT NULL DEFAULT '0',
  `Kondisi` tinyint(4) NOT NULL DEFAULT '0',
  `Surat` tinyint(4) NOT NULL DEFAULT '0',
  `Alat` tinyint(4) NOT NULL DEFAULT '0',
  `StatusUsermenu` enum('0','1') CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`rowID`),
  UNIQUE KEY `key01` (`company_rowID`,`dep_rowID`,`user_rowID`,`Kd_Menu`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=157 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of sa_usermenu
-- ----------------------------
INSERT INTO `sa_usermenu` VALUES ('1', '4', '1', '1', '1', '0', '1', '1', '1', '1', '0', '0', '0', '0', '0', '0', '0', '0', '1', '0', '0', '0', '1');
INSERT INTO `sa_usermenu` VALUES ('2', '4', '1', '1', '9', '0', '1', '1', '1', '1', '0', '0', '0', '0', '0', '0', '1', '1', '1', '1', '1', '1', '1');
INSERT INTO `sa_usermenu` VALUES ('3', '4', '1', '1', '25', '0', '1', '1', '1', '1', '0', '0', '0', '0', '0', '0', '0', '0', '1', '0', '0', '0', '1');
INSERT INTO `sa_usermenu` VALUES ('4', '4', '1', '1', '26', '0', '1', '1', '1', '1', '0', '0', '0', '0', '0', '0', '1', '1', '1', '1', '1', '1', '1');
INSERT INTO `sa_usermenu` VALUES ('5', '4', '1', '1', '27', '0', '1', '1', '1', '1', '0', '0', '0', '0', '0', '0', '0', '0', '1', '0', '0', '0', '1');
INSERT INTO `sa_usermenu` VALUES ('6', '4', '1', '1', '29', '0', '1', '1', '1', '1', '0', '0', '0', '0', '0', '0', '0', '0', '1', '0', '0', '0', '1');
INSERT INTO `sa_usermenu` VALUES ('7', '4', '1', '1', '30', '0', '1', '1', '1', '1', '0', '0', '0', '0', '0', '0', '1', '1', '1', '1', '1', '1', '1');
INSERT INTO `sa_usermenu` VALUES ('8', '4', '1', '1', '33', '0', '1', '1', '1', '1', '0', '0', '0', '0', '0', '0', '1', '1', '1', '1', '1', '1', '1');
INSERT INTO `sa_usermenu` VALUES ('9', '4', '1', '1', '34', '0', '1', '1', '1', '1', '0', '0', '0', '0', '0', '0', '1', '1', '1', '1', '1', '1', '1');
INSERT INTO `sa_usermenu` VALUES ('10', '4', '1', '1', '35', '0', '1', '1', '1', '1', '0', '0', '0', '0', '0', '0', '1', '1', '1', '1', '1', '1', '1');
INSERT INTO `sa_usermenu` VALUES ('11', '4', '1', '1', '36', '0', '1', '1', '1', '1', '0', '0', '0', '0', '0', '0', '1', '1', '1', '1', '1', '1', '1');
INSERT INTO `sa_usermenu` VALUES ('12', '4', '1', '1', '37', '0', '1', '1', '1', '1', '0', '0', '0', '0', '0', '0', '1', '1', '1', '1', '1', '1', '0');
INSERT INTO `sa_usermenu` VALUES ('13', '4', '1', '1', '38', '0', '1', '1', '1', '1', '0', '0', '0', '0', '0', '0', '1', '1', '1', '1', '1', '1', '1');
INSERT INTO `sa_usermenu` VALUES ('14', '4', '1', '1', '40', '0', '1', '1', '1', '1', '0', '0', '0', '0', '0', '0', '1', '1', '1', '1', '1', '1', '1');
INSERT INTO `sa_usermenu` VALUES ('15', '4', '1', '1', '41', '0', '1', '1', '1', '1', '0', '0', '0', '0', '0', '0', '1', '1', '1', '1', '1', '1', '1');
INSERT INTO `sa_usermenu` VALUES ('16', '4', '1', '1', '42', '0', '1', '1', '1', '1', '0', '0', '0', '0', '0', '0', '1', '1', '1', '1', '1', '1', '1');
INSERT INTO `sa_usermenu` VALUES ('17', '4', '1', '1', '45', '0', '1', '1', '1', '1', '0', '0', '0', '0', '0', '0', '1', '1', '1', '1', '1', '1', '1');
INSERT INTO `sa_usermenu` VALUES ('18', '4', '1', '1', '48', '0', '1', '1', '1', '1', '0', '0', '0', '0', '0', '0', '1', '1', '1', '1', '1', '1', '1');
INSERT INTO `sa_usermenu` VALUES ('19', '4', '1', '1', '51', '0', '1', '1', '1', '1', '0', '0', '0', '0', '0', '0', '1', '1', '1', '1', '1', '1', '1');
INSERT INTO `sa_usermenu` VALUES ('20', '4', '1', '1', '52', '0', '1', '1', '1', '1', '0', '0', '0', '0', '0', '1', '1', '1', '1', '1', '1', '1', '1');
INSERT INTO `sa_usermenu` VALUES ('21', '4', '1', '1', '53', '0', '1', '1', '1', '1', '0', '0', '0', '0', '0', '0', '1', '1', '1', '1', '1', '1', '0');
INSERT INTO `sa_usermenu` VALUES ('22', '4', '1', '1', '55', '0', '1', '1', '1', '1', '0', '0', '0', '0', '0', '0', '0', '0', '1', '0', '0', '0', '0');
INSERT INTO `sa_usermenu` VALUES ('23', '4', '1', '1', '56', '0', '1', '1', '1', '1', '0', '0', '0', '0', '0', '1', '0', '0', '1', '1', '1', '1', '1');
INSERT INTO `sa_usermenu` VALUES ('24', '4', '1', '1', '57', '0', '1', '1', '1', '1', '0', '1', '0', '0', '0', '1', '1', '1', '1', '1', '1', '1', '1');
INSERT INTO `sa_usermenu` VALUES ('25', '4', '1', '1', '58', '0', '1', '1', '1', '1', '0', '0', '0', '0', '0', '0', '1', '1', '1', '1', '1', '1', '1');
INSERT INTO `sa_usermenu` VALUES ('26', '4', '1', '1', '59', '0', '1', '1', '1', '1', '0', '0', '0', '0', '0', '0', '1', '1', '1', '1', '1', '1', '1');
INSERT INTO `sa_usermenu` VALUES ('27', '4', '1', '1', '60', '0', '1', '1', '1', '1', '0', '0', '0', '0', '0', '0', '1', '1', '1', '1', '1', '1', '1');
INSERT INTO `sa_usermenu` VALUES ('28', '4', '1', '1', '47', '1', '1', '1', '1', '1', '1', '1', '0', '1', '0', '1', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO `sa_usermenu` VALUES ('29', '4', '1', '1', '24', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO `sa_usermenu` VALUES ('30', '4', '1', '1', '21', '1', '1', '1', '1', '1', '1', '1', '0', '1', '0', '1', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO `sa_usermenu` VALUES ('31', '4', '1', '1', '75', '1', '1', '1', '1', '1', '1', '1', '0', '1', '0', '1', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO `sa_usermenu` VALUES ('32', '4', '1', '1', '77', '1', '1', '1', '1', '1', '1', '1', '0', '1', '0', '1', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO `sa_usermenu` VALUES ('33', '4', '1', '1', '78', '1', '1', '1', '1', '1', '1', '1', '0', '1', '0', '1', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO `sa_usermenu` VALUES ('34', '4', '1', '1', '76', '1', '1', '1', '1', '1', '1', '1', '0', '1', '0', '1', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO `sa_usermenu` VALUES ('35', '4', '1', '1', '79', '1', '1', '1', '1', '1', '1', '1', '0', '1', '0', '1', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO `sa_usermenu` VALUES ('36', '4', '1', '1', '81', '1', '1', '1', '1', '1', '1', '1', '0', '1', '0', '1', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO `sa_usermenu` VALUES ('37', '4', '1', '1', '82', '1', '1', '1', '1', '1', '1', '1', '0', '1', '0', '1', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO `sa_usermenu` VALUES ('38', '4', '1', '1', '83', '1', '1', '1', '1', '1', '1', '1', '0', '1', '0', '1', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO `sa_usermenu` VALUES ('39', '4', '1', '1', '84', '1', '1', '1', '1', '1', '1', '1', '0', '1', '0', '1', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO `sa_usermenu` VALUES ('40', '4', '1', '1', '85', '1', '1', '1', '1', '1', '1', '1', '0', '1', '0', '1', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO `sa_usermenu` VALUES ('41', '4', '1', '1', '86', '1', '1', '1', '1', '1', '1', '1', '0', '1', '0', '1', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO `sa_usermenu` VALUES ('42', '4', '1', '1', '87', '1', '1', '1', '1', '1', '1', '1', '0', '1', '0', '1', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO `sa_usermenu` VALUES ('43', '4', '1', '1', '89', '1', '1', '1', '1', '1', '1', '1', '0', '1', '0', '1', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO `sa_usermenu` VALUES ('44', '4', '1', '1', '88', '1', '1', '1', '1', '1', '1', '1', '0', '1', '0', '1', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO `sa_usermenu` VALUES ('45', '4', '1', '1', '90', '1', '1', '1', '1', '1', '1', '1', '0', '1', '0', '1', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO `sa_usermenu` VALUES ('46', '4', '1', '1', '91', '1', '1', '1', '1', '1', '1', '1', '0', '1', '0', '1', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO `sa_usermenu` VALUES ('47', '4', '1', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO `sa_usermenu` VALUES ('76', '4', '1', '1', '93', '1', '1', '1', '1', '1', '1', '1', '0', '1', '0', '1', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO `sa_usermenu` VALUES ('77', '4', '1', '1', '92', '1', '1', '1', '1', '1', '1', '1', '0', '1', '0', '1', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO `sa_usermenu` VALUES ('78', '4', '1', '1', '95', '1', '1', '1', '1', '1', '1', '1', '0', '1', '0', '1', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO `sa_usermenu` VALUES ('79', '4', '1', '1', '94', '1', '1', '1', '1', '1', '1', '1', '0', '1', '0', '1', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO `sa_usermenu` VALUES ('80', '4', '1', '1', '96', '1', '1', '1', '1', '1', '1', '1', '0', '1', '0', '1', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO `sa_usermenu` VALUES ('81', '4', '1', '1', '97', '1', '1', '1', '1', '1', '1', '1', '0', '1', '0', '1', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO `sa_usermenu` VALUES ('108', '4', '1', '1', '98', '1', '1', '1', '1', '1', '1', '1', '0', '1', '0', '1', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO `sa_usermenu` VALUES ('120', '4', '8', '1', '99', '1', '1', '1', '1', '1', '1', '1', '0', '1', '0', '1', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO `sa_usermenu` VALUES ('132', '4', '8', '1', '100', '1', '1', '1', '1', '1', '1', '1', '0', '1', '0', '1', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO `sa_usermenu` VALUES ('137', '4', '8', '1', '101', '1', '1', '1', '1', '1', '1', '1', '0', '1', '0', '1', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO `sa_usermenu` VALUES ('143', '4', '8', '1', '102', '1', '1', '1', '1', '1', '1', '1', '0', '1', '0', '1', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO `sa_usermenu` VALUES ('145', '4', '8', '1', '10', '1', '1', '1', '1', '1', '1', '1', '0', '1', '0', '1', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO `sa_usermenu` VALUES ('146', '4', '8', '1', '103', '1', '1', '1', '1', '1', '1', '1', '0', '1', '0', '1', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO `sa_usermenu` VALUES ('147', '4', '8', '1', '104', '1', '1', '1', '1', '1', '1', '1', '0', '1', '0', '1', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO `sa_usermenu` VALUES ('148', '4', '8', '1', '105', '1', '1', '1', '1', '1', '1', '1', '0', '1', '0', '1', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO `sa_usermenu` VALUES ('149', '4', '8', '1', '106', '1', '1', '1', '1', '1', '1', '1', '0', '1', '0', '1', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO `sa_usermenu` VALUES ('150', '4', '8', '1', '107', '1', '1', '1', '1', '1', '1', '1', '0', '1', '0', '1', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO `sa_usermenu` VALUES ('151', '4', '8', '1', '108', '1', '1', '1', '1', '1', '1', '1', '0', '1', '0', '1', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO `sa_usermenu` VALUES ('152', '4', '8', '1', '109', '1', '1', '1', '1', '1', '1', '1', '0', '1', '0', '1', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO `sa_usermenu` VALUES ('153', '4', '8', '1', '110', '1', '1', '1', '1', '1', '1', '1', '0', '1', '0', '1', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO `sa_usermenu` VALUES ('154', '4', '8', '1', '111', '1', '1', '1', '1', '1', '1', '1', '0', '1', '0', '1', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO `sa_usermenu` VALUES ('155', '4', '8', '1', '112', '1', '1', '1', '1', '1', '1', '1', '0', '1', '0', '1', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO `sa_usermenu` VALUES ('156', '4', '8', '1', '113', '1', '1', '1', '1', '1', '1', '1', '0', '1', '1', '1', '0', '0', '0', '0', '0', '0', '1');

-- ----------------------------
-- Table structure for sa_users
-- ----------------------------
DROP TABLE IF EXISTS `sa_users`;
CREATE TABLE `sa_users` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `company_rowID` tinyint(4) NOT NULL,
  `dep_rowID` smallint(4) NOT NULL,
  `partial_data` tinyint(4) NOT NULL DEFAULT '0',
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `role_rowID` int(11) NOT NULL DEFAULT '2',
  `activated` tinyint(1) NOT NULL DEFAULT '1',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `ban_reason` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT '',
  `comment_created` tinyint(4) NOT NULL DEFAULT '0',
  `comment_updated` tinyint(4) NOT NULL DEFAULT '0',
  `comment_deleted` tinyint(4) NOT NULL DEFAULT '0',
  `comment_viewed` tinyint(4) NOT NULL DEFAULT '0',
  `comment_activated` tinyint(4) NOT NULL DEFAULT '0',
  `comment_replied` tinyint(4) NOT NULL DEFAULT '0',
  `new_password_key` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `new_password_requested` datetime DEFAULT NULL,
  `new_email` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `new_email_key` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `printer_default` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `destination_id` int(11) DEFAULT '0',
  `vessel_id` int(11) DEFAULT NULL,
  `last_ip` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ticket_created` tinyint(4) NOT NULL DEFAULT '0',
  `ticket_updated` tinyint(4) NOT NULL DEFAULT '0',
  `ticket_deleted` tinyint(4) NOT NULL DEFAULT '0',
  `ticket_viewed` tinyint(4) NOT NULL DEFAULT '0',
  `ticket_replied` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`rowID`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `dep_rowID` (`dep_rowID`),
  KEY `password` (`password`),
  KEY `company_rowID` (`dep_rowID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of sa_users
-- ----------------------------
INSERT INTO `sa_users` VALUES ('1', '4', '8', '0', 'admin', '$P$B8S7quKSV0neCuusLd6FH0tC1vTITK1', 'admin@big-tms.com', '2', '1', '0', '', '0', '0', '0', '0', '0', '0', null, null, null, null, null, '0', null, '::1', '2019-01-19 14:21:56', '0000-00-00 00:00:00', '2019-01-19 14:21:56', '1', '1', '1', '1', '1');

-- ----------------------------
-- Table structure for sa_user_details
-- ----------------------------
DROP TABLE IF EXISTS `sa_user_details`;
CREATE TABLE `sa_user_details` (
  `rowID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_rowID` int(11) NOT NULL,
  `fullname` varchar(160) DEFAULT NULL,
  `company` varchar(150) NOT NULL,
  `city` varchar(40) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `address` varchar(64) NOT NULL,
  `phone` varchar(32) NOT NULL,
  `vat` varchar(32) NOT NULL,
  `language` varchar(40) DEFAULT 'english',
  `avatar` varchar(32) NOT NULL DEFAULT 'default_avatar.jpg',
  PRIMARY KEY (`rowID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of sa_user_details
-- ----------------------------
INSERT INTO `sa_user_details` VALUES ('1', '1', 'Administrator', 'BERJAYA INDAH GEMILANG', 'Jakarta Utara', 'Indonesia', 'Sunter Agung', '081234567890', '12345', 'english', 'default_avatar.jpg');

-- ----------------------------
-- Table structure for sa_vehicle
-- ----------------------------
DROP TABLE IF EXISTS `sa_vehicle`;
CREATE TABLE `sa_vehicle` (
  `rowID` smallint(6) NOT NULL AUTO_INCREMENT,
  `dep_rowID` smallint(6) NOT NULL,
  `police_no` varchar(15) NOT NULL DEFAULT '',
  `police_no_ref` varchar(20) NOT NULL DEFAULT '',
  `vehicle_type` varchar(20) NOT NULL DEFAULT '',
  `gps_car_id` int(11) NOT NULL DEFAULT '0',
  `gps_no` varchar(15) NOT NULL DEFAULT '',
  `debtor_rowID` smallint(6) NOT NULL DEFAULT '0',
  `no_stnk` varchar(20) NOT NULL,
  `status_stnk` enum('asli','fotocopy') NOT NULL,
  `expired_stnk` date NOT NULL,
  `no_kir` varchar(20) NOT NULL,
  `status_kir` enum('asli','fotocopy') NOT NULL,
  `expired_kir` date NOT NULL,
  `no_bpkb` varchar(20) NOT NULL,
  `status_bpkb` enum('asli','fotocopy') NOT NULL,
  `no_insurance` varchar(20) NOT NULL,
  `status_insurance` enum('asli','fotocopy') NOT NULL,
  `expired_insurance` date NOT NULL,
  `no_kiu` varchar(20) NOT NULL,
  `status_kiu` enum('asli','fotocopy') NOT NULL,
  `expired_kiu` date NOT NULL,
  `vehicle_photo` varchar(35) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`,`police_no`),
  KEY `rowID` (`rowID`),
  KEY `police_no` (`police_no`),
  KEY `vehicle_type` (`vehicle_type`),
  KEY `debtor_rowID` (`debtor_rowID`),
  KEY `gps_car_id` (`gps_car_id`) USING BTREE,
  KEY `deleted` (`deleted`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sa_vehicle
-- ----------------------------
INSERT INTO `sa_vehicle` VALUES ('1', '0', 'A 9039 FL', '', 'DUMP TRUCK', '0', '', '16', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', 'asli', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '20161114093755_58292383d617c.jpg', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-08', '15:19:40', '1', '2016-11-14', '09:37:55', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle` VALUES ('2', '0', 'B 9034 EP', '', 'DUMP TRUCK SPECIAL', '0', '4231211545', '13', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', 'asli', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', '0', '0', '0', '1901-01-01', '00:00:00', '0', '1', '2016-09-28', '12:41:34', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle` VALUES ('3', '0', 'B 9106 UEJ', '', 'DUMP TRUCK', '0', '6221107158', '14', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', 'asli', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', '0', '0', '0', '1901-01-01', '00:00:00', '0', '1', '2016-09-25', '02:56:42', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle` VALUES ('4', '0', 'B 9201 UYW', '', 'DUMP TRUCK', '0', '4231212431', '21', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', 'asli', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-08', '15:22:18', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle` VALUES ('5', '0', 'B 9202 UYW', '', 'DUMP TRUCK', '0', '6221107192', '12', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', 'asli', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-08', '15:38:33', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle` VALUES ('6', '0', 'B 9203 UYW', '', 'DUMP TRUCK', '0', '6221107149', '0', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', 'asli', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-08', '13:54:07', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle` VALUES ('7', '0', 'B 9204 UYW', '', 'DUMP TRUCK', '0', '6221107191', '0', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', 'asli', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-08', '13:55:40', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle` VALUES ('8', '0', 'B 9205 UYW', '', 'DUMP TRUCK', '0', '6221107149', '44', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', 'asli', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-08', '15:45:55', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle` VALUES ('9', '0', 'B 9223 UEJ', '', 'TRAILER', '0', '', '24', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', 'asli', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-08', '15:40:51', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle` VALUES ('10', '0', 'B 9250 UEK', '', 'TRAILER', '0', '4231212166', '0', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', 'asli', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-08', '14:09:38', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle` VALUES ('11', '0', 'B 9253 UEK', '', 'TRAILER', '0', '4231211906', '11', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', 'asli', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-08', '15:38:05', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle` VALUES ('12', '0', 'B 9254 UEK', '', 'HEAD TRUCK', '0', '6221107249', '20', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', 'asli', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-30', '11:06:17', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle` VALUES ('13', '0', 'B 9255 UEK', '', 'TRAILER', '0', '4231019322', '40', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', 'asli', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-08', '15:44:40', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle` VALUES ('14', '0', 'B 9259 UEK', '', 'HEAD TRUCK', '0', '4231211618', '46', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', 'asli', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-26', '18:17:48', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle` VALUES ('15', '0', 'B 9286 UEJ', '', 'HEAD TRUCK', '0', '6221107182', '0', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', 'asli', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '20161114094407_582924f7a73a9.jpg', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-08', '14:13:31', '1', '2016-11-14', '09:44:07', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle` VALUES ('16', '0', 'B 9329 GJ', '', 'DUMP TRUCK', '0', '', '0', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', 'asli', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-08', '14:16:48', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle` VALUES ('17', '0', 'B 9403 AL', '', 'DUMP TRUCK', '0', '', '0', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', 'asli', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-08', '14:17:08', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle` VALUES ('18', '0', 'B 9404 BYW', '', 'DUMP TRUCK SPECIAL', '0', '4231212431', '15', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', 'asli', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', '0', '0', '0', '1901-01-01', '00:00:00', '0', '1', '2016-10-18', '13:28:05', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle` VALUES ('19', '0', 'B 9437 BYU', '', 'DUMP TRUCK', '0', '', '0', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', 'asli', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '20161019181731_5807564b06f21.jpg', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-08', '14:18:44', '1', '2016-10-19', '18:17:31', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle` VALUES ('20', '0', 'B 9475 UEL', '', 'TRAILER', '0', '', '45', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', 'asli', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-08', '15:46:12', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle` VALUES ('21', '0', 'B 9476 UEL', '', 'TRAILER', '0', '', '0', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', 'asli', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-08', '14:19:21', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle` VALUES ('22', '0', 'B 9519 UEK', '', 'DUMP TRUCK', '0', '6221107114', '26', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', 'asli', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', '0', '0', '0', '1901-01-01', '00:00:00', '0', '1', '2016-09-26', '09:10:52', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle` VALUES ('23', '0', 'B 9521 UYV', '', 'DUMP TRUCK', '0', '4231211177', '0', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', 'asli', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', '0', '0', '0', '1901-01-01', '00:00:00', '0', '1', '2016-09-26', '14:34:57', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle` VALUES ('24', '0', 'B 9524 UEK', '', 'DUMP TRUCK', '0', '6221107179', '7', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', 'asli', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', '0', '0', '0', '1901-01-01', '00:00:00', '0', '1', '2016-09-26', '10:57:46', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle` VALUES ('25', '0', 'B 9525 UEK', '', 'HEAD TRUCK', '0', '6221107169', '0', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', 'asli', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-08', '14:22:15', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle` VALUES ('26', '0', 'B 9542 UZ', '', 'DUMP TRUCK', '0', '', '0', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', 'asli', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-08', '14:22:28', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle` VALUES ('27', '0', 'B 9556 UFU', '', 'DUMP TRUCK', '0', '6221107168', '47', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', 'asli', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-08', '15:47:03', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle` VALUES ('28', '0', 'B 9557 UFU', '', 'DUMP TRUCK', '0', '6221107157', '31', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', 'asli', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-08', '15:43:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle` VALUES ('29', '0', 'B 9558 UFU', '', 'DUMP TRUCK', '0', '6221107164', '9', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', 'asli', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-08', '15:36:45', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle` VALUES ('30', '0', 'B 9559 UFU', '', 'DUMP TRUCK', '0', '4231211888', '42', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', 'asli', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-08', '15:45:23', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle` VALUES ('31', '0', 'B 9560 UFU', '', 'DUMP TRUCK', '0', '6221107102', '0', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', 'asli', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-08', '14:24:35', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle` VALUES ('32', '0', 'B 9614 UEK', '', 'HEAD TRUCK', '0', '4231019639', '5', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', 'asli', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-30', '11:06:48', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle` VALUES ('33', '0', 'B 9615 UEK', '', 'HEAD TRUCK', '0', '', '0', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', 'asli', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-08', '14:25:36', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle` VALUES ('34', '0', 'B 9616 UEK', '', 'HEAD TRUCK', '0', '6221107185', '41', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', 'asli', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-08', '15:45:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle` VALUES ('35', '0', 'B 9617 UEK', '', 'HEAD TRUCK', '0', '', '0', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', 'asli', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-08', '14:26:13', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle` VALUES ('36', '0', 'B 9618 UEK', '', 'HEAD TRUCK', '0', '6221107131', '18', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', 'asli', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-08', '15:21:37', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle` VALUES ('37', '0', 'B 9621 UEK', '', 'DUMP TRUCK', '0', '', '8', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', 'asli', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', '0', '0', '0', '1901-01-01', '00:00:00', '0', '1', '2016-09-27', '15:00:58', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle` VALUES ('38', '0', 'B 9626 UEK', '', 'DUMP TRUCK', '0', '6221107178', '43', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', 'asli', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', '0', '0', '0', '1901-01-01', '00:00:00', '0', '1', '2016-09-26', '09:37:13', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle` VALUES ('39', '0', 'B 9627 UEK', '', 'DUMP TRUCK', '0', '4231019509', '22', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', 'asli', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', '0', '0', '0', '1901-01-01', '00:00:00', '0', '1', '2016-09-26', '09:03:38', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle` VALUES ('40', '0', 'B 9683 WX', '', 'TRAILER', '0', '', '0', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', 'asli', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-08', '14:28:29', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle` VALUES ('41', '0', 'B 9797 UEJ', '', 'TRAILER', '0', '', '0', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', 'asli', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-08', '14:28:54', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle` VALUES ('42', '0', 'B 9802 UFU', '', 'LIGHT TRUCK', '0', '', '35', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', 'asli', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-08', '15:44:10', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle` VALUES ('43', '0', 'B 9803 UFU', '', 'LIGHT TRUCK', '0', '', '0', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', 'asli', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-08', '14:29:33', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle` VALUES ('44', '0', 'B 9809 UFU', '', 'LIGHT TRUCK', '0', '', '0', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', 'asli', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-08', '14:30:42', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle` VALUES ('45', '0', 'B 9810 UFU', '', 'LIGHT TRUCK', '0', '', '4', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', 'asli', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-08', '15:22:51', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle` VALUES ('46', '0', 'B 9811 UFU', '', 'LIGHT TRUCK', '0', '', '0', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', 'asli', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-08', '14:31:08', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle` VALUES ('47', '0', 'B 9858 BYW', '', 'DUMP TRUCK', '0', '4231212161', '49', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', 'asli', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-08', '15:47:19', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle` VALUES ('48', '0', 'B 9859 UEJ', '', 'TRAILER', '0', '6221107167', '25', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', 'asli', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-08', '15:41:12', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle` VALUES ('49', '0', 'B 9988 UZ', '', 'DUMP TRUCK', '0', '', '0', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', 'asli', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-09-08', '14:32:18', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle` VALUES ('50', '0', 'B 9539 BEU', '', 'DUMP TRUCK SPECIAL', '0', '', '28', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', 'asli', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', '0', '0', '0', '1901-01-01', '00:00:00', '0', '1', '2016-09-29', '23:00:06', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle` VALUES ('53', '0', 'B 9455 UYY', '', 'DUMP TRUCK', '0', '', '0', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', 'asli', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2', '2016-10-06', '13:03:55', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle` VALUES ('60', '0', 'A 1111 B', '', 'HEAD TRUCK', '0', '', '0', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', 'asli', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '20161019172015_580748df3c478.jpg', '0', '0', '0', '1901-01-01', '00:00:00', '0', '1', '2016-10-19', '15:57:33', '1', '2016-10-19', '17:20:15', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle` VALUES ('61', '8', 'T 12345 F', '', 'DUMP TRUCK SPECIAL', '0', '1234', '9', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', 'asli', '', 'asli', '1970-01-01', '', 'asli', '1970-01-01', '', '0', '0', '0', '1901-01-01', '00:00:00', '0', '1', '2016-10-25', '18:12:12', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');

-- ----------------------------
-- Table structure for sa_vehicle_reference
-- ----------------------------
DROP TABLE IF EXISTS `sa_vehicle_reference`;
CREATE TABLE `sa_vehicle_reference` (
  `rowID` smallint(6) NOT NULL AUTO_INCREMENT,
  `reference` varchar(50) NOT NULL DEFAULT '',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`),
  KEY `rowID` (`rowID`),
  KEY `reference` (`reference`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sa_vehicle_reference
-- ----------------------------
INSERT INTO `sa_vehicle_reference` VALUES ('1', 'SOLAR', '0', '11', '2016-07-19', '14:54:53', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle_reference` VALUES ('2', 'BAYAR TOL', '0', '11', '2016-07-19', '14:57:15', '0', '1901-01-01', '00:00:00');

-- ----------------------------
-- Table structure for sa_vehicle_type
-- ----------------------------
DROP TABLE IF EXISTS `sa_vehicle_type`;
CREATE TABLE `sa_vehicle_type` (
  `rowID` smallint(6) NOT NULL AUTO_INCREMENT,
  `type_cd` varchar(6) NOT NULL DEFAULT '',
  `type_name` varchar(60) NOT NULL DEFAULT '',
  `vehicle_type` varchar(20) NOT NULL,
  `weight` double(11,0) NOT NULL DEFAULT '0',
  `max_weight` double(11,0) NOT NULL DEFAULT '0',
  `min_weight` double(11,0) NOT NULL DEFAULT '0',
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`,`type_cd`),
  KEY `rowID` (`rowID`),
  KEY `type_cd` (`type_cd`),
  KEY `type_name` (`type_name`),
  KEY `vehicle_type` (`vehicle_type`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sa_vehicle_type
-- ----------------------------
INSERT INTO `sa_vehicle_type` VALUES ('1', '1X20', '1 X 20 FEET', 'HEAD TRUCK', '0', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '11', '2016-07-20', '13:27:04', '11', '2016-09-01', '19:54:36', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle_type` VALUES ('2', '2X20', '2 X 20 FEET', 'HEAD TRUCK', '0', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '11', '2016-07-20', '13:27:20', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle_type` VALUES ('3', '1X40', '1 X 40 FEET', 'HEAD TRUCK', '0', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '11', '2016-07-20', '13:27:38', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle_type` VALUES ('4', 'DT', 'DUMP TRUCK', 'DUMP TRUCK', '0', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '11', '2016-07-20', '13:27:57', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle_type` VALUES ('5', 'DTTLR', 'DUMP TRUCK  TRAILER', 'DUMP TRUCK', '0', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '11', '2016-07-20', '13:50:46', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle_type` VALUES ('6', 'TRI', 'TRINTIN', 'HEAD TRUCK', '0', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '11', '2016-07-20', '13:51:18', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle_type` VALUES ('7', 'TRO', 'TRONTON', 'HEAD TRUCK', '0', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '11', '2016-07-20', '13:51:30', '11', '2016-07-20', '13:51:45', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle_type` VALUES ('8', 'ENG', 'ENGKEL', 'HEAD TRUCK', '0', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '11', '2016-07-20', '13:55:31', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle_type` VALUES ('9', '1X30', '1 X 30 FEET', 'HEAD TRUCK', '0', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '11', '2016-07-20', '13:55:57', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle_type` VALUES ('10', 'tes', 'TES 1', 'HEAD TRUCK', '1901', '1001', '5011', '0', '0', '1901-01-01', '00:00:00', '1', '11', '2016-09-01', '19:44:39', '11', '2016-09-01', '19:45:53', '11', '2016-09-01', '19:46:06');
INSERT INTO `sa_vehicle_type` VALUES ('11', 'DT1', 'DUMP TRUCK BOROS 1', 'DUMP TRUCK', '0', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '11', '2016-09-05', '16:43:39', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle_type` VALUES ('12', 'DT2', 'DUMP TRUCK BOROS 2', 'DUMP TRUCK', '0', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '11', '2016-09-05', '16:44:12', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle_type` VALUES ('13', 'ISO', 'ISO TANK', 'LIGHT TRUCK', '0', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '11', '2016-09-05', '18:43:59', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle_type` VALUES ('14', 'DTI', 'DUMP TRUCK IRIT', 'DUMP TRUCK SPECIAL', '0', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '1', '2016-09-28', '10:49:34', '1', '2016-09-28', '12:42:53', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle_type` VALUES ('15', 'DTTRIN', 'DUMPTRUCK TRINTON', 'DUMP TRUCK', '0', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '1', '2016-10-03', '17:37:24', '1', '2016-10-03', '17:38:31', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_vehicle_type` VALUES ('16', 'DTTRON', 'DUMPTRUCK TRONTON', 'DUMP TRUCK', '0', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '1', '2016-10-03', '17:37:47', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');

-- ----------------------------
-- Table structure for sa_wth_rate
-- ----------------------------
DROP TABLE IF EXISTS `sa_wth_rate`;
CREATE TABLE `sa_wth_rate` (
  `rowID` smallint(6) NOT NULL AUTO_INCREMENT,
  `wth_type` smallint(6) NOT NULL DEFAULT '0',
  `wth_rate` tinyint(4) NOT NULL DEFAULT '0',
  `descs` varchar(40) NOT NULL DEFAULT '',
  `wth_coa_rowID` smallint(6) NOT NULL DEFAULT '0',
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`,`wth_type`,`wth_rate`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sa_wth_rate
-- ----------------------------
INSERT INTO `sa_wth_rate` VALUES ('1', '21', '2', 'PPh Pasal 21 2%', '73', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_wth_rate` VALUES ('2', '22', '4', 'PPh Pasal 22 4%', '73', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_wth_rate` VALUES ('3', '23', '6', 'PPh Pasal 23 6%', '73', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_wth_rate` VALUES ('4', '23', '4', 'PPh Pasal 23 4%', '73', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');
INSERT INTO `sa_wth_rate` VALUES ('5', '23', '2', 'PPh Pasal 23 2%', '73', '0', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00', '0', '1901-01-01', '00:00:00');

-- ----------------------------
-- Table structure for template
-- ----------------------------
DROP TABLE IF EXISTS `template`;
CREATE TABLE `template` (
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of template
-- ----------------------------

-- ----------------------------
-- Table structure for tr_accu_dtl
-- ----------------------------
DROP TABLE IF EXISTS `tr_accu_dtl`;
CREATE TABLE `tr_accu_dtl` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `accu_rowID` int(11) NOT NULL,
  `accu_no` varchar(25) NOT NULL,
  `accu_condition` varchar(20) NOT NULL,
  `accu_brand` varchar(30) NOT NULL,
  `accu_type` varchar(30) NOT NULL,
  `accu_size` varchar(30) NOT NULL,
  `user_created` int(11) NOT NULL,
  `datetime_created` datetime NOT NULL,
  `user_modified` int(11) NOT NULL,
  `datetime_modified` datetime NOT NULL,
  PRIMARY KEY (`rowID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tr_accu_dtl
-- ----------------------------

-- ----------------------------
-- Table structure for tr_accu_hdr
-- ----------------------------
DROP TABLE IF EXISTS `tr_accu_hdr`;
CREATE TABLE `tr_accu_hdr` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `vehicle_rowID` int(11) NOT NULL,
  `debtor_rowID` int(11) NOT NULL,
  `date` date NOT NULL,
  `photo_url` text,
  `user_created` int(11) NOT NULL,
  `datetime_created` datetime NOT NULL,
  `user_modified` int(11) NOT NULL,
  `datetime_modified` datetime NOT NULL,
  `deleted` tinyint(4) NOT NULL,
  `user_deleted` tinyint(4) NOT NULL,
  `datetime_deleted` datetime NOT NULL,
  PRIMARY KEY (`rowID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tr_accu_hdr
-- ----------------------------

-- ----------------------------
-- Table structure for tr_advance_trx_dtl
-- ----------------------------
DROP TABLE IF EXISTS `tr_advance_trx_dtl`;
CREATE TABLE `tr_advance_trx_dtl` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `advance_number` varchar(25) NOT NULL,
  `expense_rowID` int(11) NOT NULL,
  `descs` text NOT NULL,
  `amount` double NOT NULL,
  `user_created` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `deleted` tinyint(4) NOT NULL,
  `user_deleted` int(11) NOT NULL,
  `date_deleted` datetime NOT NULL,
  PRIMARY KEY (`rowID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tr_advance_trx_dtl
-- ----------------------------

-- ----------------------------
-- Table structure for tr_advance_trx_hdr
-- ----------------------------
DROP TABLE IF EXISTS `tr_advance_trx_hdr`;
CREATE TABLE `tr_advance_trx_hdr` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `prefix` varchar(4) NOT NULL,
  `year` int(4) NOT NULL,
  `month` int(2) NOT NULL,
  `code` int(11) NOT NULL,
  `advance_code` char(3) NOT NULL,
  `advance_number` varchar(25) NOT NULL,
  `advance_date` date NOT NULL,
  `jo_type_advance` varchar(10) NOT NULL,
  `jo_no` varchar(25) NOT NULL,
  `advance_type_rowID` int(11) NOT NULL,
  `debtor_rowID` int(11) NOT NULL,
  `dp_creditor_rowID` int(11) NOT NULL,
  `advance_total` double NOT NULL,
  `remark` text NOT NULL,
  `printed` tinyint(4) NOT NULL,
  `user_printed` int(11) NOT NULL,
  `date_printed` date NOT NULL,
  `time_printed` time NOT NULL,
  `user_created` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `user_modified` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `deleted` tinyint(4) NOT NULL,
  `user_deleted` int(11) NOT NULL,
  `date_deleted` datetime NOT NULL,
  PRIMARY KEY (`rowID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tr_advance_trx_hdr
-- ----------------------------

-- ----------------------------
-- Table structure for tr_advreq_trx_hdr
-- ----------------------------
DROP TABLE IF EXISTS `tr_advreq_trx_hdr`;
CREATE TABLE `tr_advreq_trx_hdr` (
  `request_no` varchar(25) NOT NULL,
  `request_date` date NOT NULL,
  `debtor_rowID` varchar(10) NOT NULL,
  `wo_no` varchar(25) NOT NULL,
  `ref_no` varchar(25) NOT NULL,
  `attn1` varchar(30) NOT NULL,
  `attn2` varchar(30) NOT NULL,
  `note` varchar(120) NOT NULL,
  `price_amt` decimal(10,0) NOT NULL,
  `percent_adv` decimal(4,0) NOT NULL,
  `request_amt` decimal(10,0) NOT NULL,
  `adv_amt` decimal(10,0) NOT NULL,
  `month` tinyint(4) NOT NULL,
  `year` smallint(6) NOT NULL,
  `printed` tinyint(4) DEFAULT NULL,
  `user_printed` int(11) DEFAULT NULL,
  `date_printed` date DEFAULT NULL,
  `time_printed` time DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `time_created` time DEFAULT NULL,
  `user_modified` int(11) DEFAULT NULL,
  `date_modified` date DEFAULT NULL,
  `time_modified` time DEFAULT NULL,
  `user_deleted` int(11) DEFAULT NULL,
  `date_deleted` date DEFAULT NULL,
  `time_deleted` time DEFAULT NULL,
  PRIMARY KEY (`request_no`),
  KEY `lgadvreq_key` (`request_no`,`wo_no`,`debtor_rowID`,`month`,`year`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tr_advreq_trx_hdr
-- ----------------------------

-- ----------------------------
-- Table structure for tr_approval_reimburse
-- ----------------------------
DROP TABLE IF EXISTS `tr_approval_reimburse`;
CREATE TABLE `tr_approval_reimburse` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `reimburse_no` varchar(25) NOT NULL,
  `reimburse_date` date NOT NULL,
  `reimburse_total` double NOT NULL DEFAULT '0',
  `user_approved` int(11) NOT NULL,
  `date_approved` date NOT NULL,
  `time_approved` time NOT NULL,
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`),
  KEY `lgjotrx_key` (`rowID`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tr_approval_reimburse
-- ----------------------------

-- ----------------------------
-- Table structure for tr_commission_trx
-- ----------------------------
DROP TABLE IF EXISTS `tr_commission_trx`;
CREATE TABLE `tr_commission_trx` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `year` int(4) NOT NULL,
  `month` int(2) NOT NULL,
  `code` int(4) NOT NULL,
  `commission_no` varchar(25) NOT NULL,
  `until_date` date NOT NULL,
  `period` tinyint(4) NOT NULL,
  `total_driver_commission` double NOT NULL,
  `total_co_driver_commission` double NOT NULL,
  `total_deposit` double NOT NULL,
  `total_loan` double NOT NULL,
  `printed` tinyint(4) NOT NULL,
  `user_printed` int(11) NOT NULL,
  `date_printed` date NOT NULL,
  `time_printed` time NOT NULL,
  `user_created` int(11) NOT NULL,
  `date_created` date NOT NULL,
  `time_created` time NOT NULL,
  `user_modified` int(11) NOT NULL,
  `date_modified` date NOT NULL,
  `time_modified` time NOT NULL,
  `deleted` tinyint(4) NOT NULL,
  `user_deleted` int(11) NOT NULL,
  `date_deleted` date NOT NULL,
  `time_deleted` time NOT NULL,
  PRIMARY KEY (`rowID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tr_commission_trx
-- ----------------------------

-- ----------------------------
-- Table structure for tr_commission_trx_alloc
-- ----------------------------
DROP TABLE IF EXISTS `tr_commission_trx_alloc`;
CREATE TABLE `tr_commission_trx_alloc` (
  `prefix` varchar(4) NOT NULL DEFAULT '',
  `year` int(4) NOT NULL DEFAULT '0',
  `month` int(2) NOT NULL DEFAULT '0',
  `code` int(8) NOT NULL DEFAULT '0',
  `row_no` int(11) NOT NULL DEFAULT '0',
  `alloc_no` varchar(25) NOT NULL DEFAULT '',
  `alloc_date` date NOT NULL DEFAULT '1901-01-01',
  `descs` varchar(75) NOT NULL DEFAULT '',
  `alloc_amt` double NOT NULL DEFAULT '0',
  `commission_no` varchar(25) NOT NULL,
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`prefix`,`year`,`month`,`code`,`row_no`,`date_deleted`,`time_deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tr_commission_trx_alloc
-- ----------------------------

-- ----------------------------
-- Table structure for tr_commission_trx_dtl
-- ----------------------------
DROP TABLE IF EXISTS `tr_commission_trx_dtl`;
CREATE TABLE `tr_commission_trx_dtl` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `commission_rowID` int(11) NOT NULL,
  `debtor_rowID` int(11) NOT NULL,
  `driver_commission` double NOT NULL,
  `co_driver_commission` double NOT NULL,
  `amount_deposit` double NOT NULL,
  `max_saldo_loan` double NOT NULL,
  `amount_loan` double NOT NULL,
  `printed` tinyint(4) NOT NULL,
  `user_printed` int(11) NOT NULL,
  `date_printed` date NOT NULL,
  `time_printed` time NOT NULL,
  `user_created` int(11) NOT NULL,
  `date_created` date NOT NULL,
  `time_created` time NOT NULL,
  `user_modified` int(11) NOT NULL,
  `date_modified` date NOT NULL,
  `time_modified` time NOT NULL,
  `deleted` tinyint(4) NOT NULL,
  `user_deleted` int(11) NOT NULL,
  `date_deleted` date NOT NULL,
  `time_deleted` time NOT NULL,
  PRIMARY KEY (`rowID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tr_commission_trx_dtl
-- ----------------------------

-- ----------------------------
-- Table structure for tr_container_trx
-- ----------------------------
DROP TABLE IF EXISTS `tr_container_trx`;
CREATE TABLE `tr_container_trx` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `jo_no` varchar(25) NOT NULL,
  `container_type` enum('20ft','40ft','45ft') NOT NULL,
  `container_no` varchar(50) NOT NULL,
  `seal_no` varchar(50) NOT NULL,
  `replacement_seal_no` varchar(50) DEFAULT NULL,
  `weight` int(11) NOT NULL,
  `printed` tinyint(4) NOT NULL,
  `user_printed` int(11) NOT NULL,
  `date_printed` date NOT NULL,
  `time_printed` time NOT NULL,
  `user_created` int(11) NOT NULL,
  `date_created` date NOT NULL,
  `time_created` time NOT NULL,
  `user_modified` int(11) NOT NULL,
  `date_modified` date NOT NULL,
  `time_modified` time NOT NULL,
  `deleted` tinyint(4) NOT NULL,
  `user_deleted` int(11) NOT NULL,
  `date_deleted` date NOT NULL,
  `time_deleted` time NOT NULL,
  PRIMARY KEY (`rowID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tr_container_trx
-- ----------------------------

-- ----------------------------
-- Table structure for tr_cost_ledger
-- ----------------------------
DROP TABLE IF EXISTS `tr_cost_ledger`;
CREATE TABLE `tr_cost_ledger` (
  `prefix` varchar(3) NOT NULL DEFAULT '',
  `year` int(4) NOT NULL DEFAULT '0',
  `month` int(2) NOT NULL DEFAULT '0',
  `code` int(11) NOT NULL DEFAULT '0',
  `cost_rowID` smallint(6) NOT NULL DEFAULT '0',
  `row_no` int(11) NOT NULL DEFAULT '0',
  `trx_amt` double NOT NULL DEFAULT '0',
  `tr_jo_trx_hdr_year` int(4) NOT NULL DEFAULT '0',
  `tr_jo_trx_hdr_month` int(2) NOT NULL DEFAULT '0',
  `tr_jo_trx_hdr_code` int(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`prefix`,`year`,`month`,`code`,`cost_rowID`,`row_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tr_cost_ledger
-- ----------------------------

-- ----------------------------
-- Table structure for tr_cost_trx
-- ----------------------------
DROP TABLE IF EXISTS `tr_cost_trx`;
CREATE TABLE `tr_cost_trx` (
  `prefix` varchar(4) NOT NULL DEFAULT '',
  `year` int(4) NOT NULL DEFAULT '0',
  `month` int(2) NOT NULL DEFAULT '0',
  `code` int(11) NOT NULL DEFAULT '0',
  `row_no` int(11) NOT NULL DEFAULT '0',
  `trx_no` varchar(25) NOT NULL DEFAULT '',
  `trx_date` date NOT NULL DEFAULT '1901-01-01',
  `cost_rowID` smallint(6) NOT NULL DEFAULT '0',
  `trx_amt` double(10,0) NOT NULL DEFAULT '0',
  `descs` varchar(60) NOT NULL DEFAULT '',
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`prefix`,`year`,`month`,`code`,`row_no`,`trx_no`,`date_deleted`,`time_deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tr_cost_trx
-- ----------------------------

-- ----------------------------
-- Table structure for tr_deposit_trx
-- ----------------------------
DROP TABLE IF EXISTS `tr_deposit_trx`;
CREATE TABLE `tr_deposit_trx` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `prefix` varchar(4) NOT NULL,
  `year` smallint(4) NOT NULL,
  `month` tinyint(2) NOT NULL,
  `code` int(6) NOT NULL,
  `deposit_number` varchar(25) NOT NULL,
  `date` date NOT NULL,
  `debtor_rowID` int(11) NOT NULL,
  `amount` double NOT NULL,
  `remark` text NOT NULL,
  `commission_no` varchar(25) NOT NULL,
  `user_created` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `user_modified` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `deleted` tinyint(4) NOT NULL,
  `user_deleted` int(11) NOT NULL,
  `date_deleted` datetime NOT NULL,
  PRIMARY KEY (`rowID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tr_deposit_trx
-- ----------------------------

-- ----------------------------
-- Table structure for tr_deposit_trx_alloc
-- ----------------------------
DROP TABLE IF EXISTS `tr_deposit_trx_alloc`;
CREATE TABLE `tr_deposit_trx_alloc` (
  `prefix` varchar(4) NOT NULL DEFAULT '',
  `year` int(4) NOT NULL DEFAULT '0',
  `month` int(2) NOT NULL DEFAULT '0',
  `code` int(8) NOT NULL DEFAULT '0',
  `row_no` int(11) NOT NULL DEFAULT '0',
  `alloc_no` varchar(25) NOT NULL DEFAULT '',
  `alloc_date` date NOT NULL DEFAULT '1901-01-01',
  `descs` varchar(75) NOT NULL DEFAULT '',
  `alloc_amt` double NOT NULL DEFAULT '0',
  `deposit_no` varchar(25) NOT NULL,
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`prefix`,`year`,`month`,`code`,`row_no`,`date_deleted`,`time_deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tr_deposit_trx_alloc
-- ----------------------------

-- ----------------------------
-- Table structure for tr_do_trx
-- ----------------------------
DROP TABLE IF EXISTS `tr_do_trx`;
CREATE TABLE `tr_do_trx` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `prefix` varchar(4) NOT NULL DEFAULT '',
  `year` smallint(4) NOT NULL DEFAULT '0',
  `month` smallint(2) NOT NULL DEFAULT '0',
  `code` bigint(11) NOT NULL DEFAULT '0',
  `trx_no` varchar(30) NOT NULL DEFAULT '',
  `tr_jo_trx_hdr_year` int(11) NOT NULL DEFAULT '0',
  `tr_jo_trx_hdr_month` int(11) NOT NULL DEFAULT '0',
  `tr_jo_trx_hdr_code` int(11) NOT NULL DEFAULT '0',
  `jo_no` varchar(25) NOT NULL DEFAULT '',
  `do_no` varchar(50) NOT NULL DEFAULT '',
  `komisi_supir` double NOT NULL,
  `komisi_kernet` double NOT NULL,
  `first_comm_driver` double NOT NULL,
  `first_comm_co_driver` double NOT NULL,
  `deposit` double NOT NULL,
  `container_row_no` tinyint(4) NOT NULL DEFAULT '0',
  `count_container` int(11) NOT NULL,
  `container_size` int(10) NOT NULL,
  `container_no` varchar(30) DEFAULT NULL,
  `do_date` date NOT NULL DEFAULT '1901-01-01',
  `deliver_date` date NOT NULL DEFAULT '1901-01-01',
  `deliver_weight` double NOT NULL DEFAULT '0',
  `received_date` date NOT NULL DEFAULT '1901-01-01',
  `received_weight` double NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `invoice_date` date NOT NULL DEFAULT '1901-01-01',
  `invoice_no` varchar(25) NOT NULL DEFAULT '',
  `commission_no` varchar(25) NOT NULL,
  `sj_id` bigint(20) NOT NULL DEFAULT '0',
  `sj_period` int(11) NOT NULL DEFAULT '0',
  `document_id` int(11) NOT NULL DEFAULT '0',
  `document_separate_id` int(11) NOT NULL DEFAULT '0',
  `unload_receipt_id` int(11) NOT NULL DEFAULT '0',
  `load_receipt_id` int(11) NOT NULL DEFAULT '0',
  `company_id` int(11) NOT NULL DEFAULT '0',
  `site_id` int(11) NOT NULL DEFAULT '0',
  `vessel_id` int(11) NOT NULL DEFAULT '0',
  `reg_no_sj` varchar(6) NOT NULL DEFAULT '',
  `sj_no` int(11) NOT NULL DEFAULT '0',
  `rev_sj_no` int(11) NOT NULL DEFAULT '0',
  `sj_ref` varchar(30) NOT NULL DEFAULT '',
  `sj_date` date NOT NULL DEFAULT '1901-01-01',
  `sj_time` time NOT NULL DEFAULT '00:00:00',
  `destination_from` int(20) NOT NULL DEFAULT '0',
  `destination_to` int(20) NOT NULL DEFAULT '0',
  `item_id` int(1) NOT NULL DEFAULT '0',
  `item_type` char(1) NOT NULL,
  `party_id` int(1) NOT NULL DEFAULT '0',
  `po_ref` varchar(30) NOT NULL,
  `po_client` varchar(30) NOT NULL,
  `po_date` date NOT NULL DEFAULT '1901-01-01',
  `qty_po` double NOT NULL,
  `palka_id` int(11) NOT NULL DEFAULT '0',
  `truck_id` int(11) NOT NULL DEFAULT '0',
  `truck_type_id` int(30) NOT NULL DEFAULT '0',
  `transporter_id` int(10) NOT NULL DEFAULT '0',
  `shipping_name` varchar(30) NOT NULL,
  `stevedore_name` varchar(30) NOT NULL,
  `bl_doc` varchar(30) NOT NULL,
  `client_id` int(20) NOT NULL DEFAULT '0',
  `qty_bulk_delivery_bruto` double(11,2) NOT NULL,
  `qty_bulk_delivery_tarra` double(11,2) NOT NULL,
  `qty_bulk_delivery_netto` double(11,2) NOT NULL,
  `qty_bulk_receipt_bruto` double(11,0) NOT NULL,
  `qty_bulk_receipt_tarra` double(11,0) NOT NULL,
  `qty_bulk_receipt_netto` double(11,0) NOT NULL,
  `driver_name` varchar(20) NOT NULL,
  `destination_description` varchar(40) NOT NULL,
  `remarks` varchar(40) NOT NULL,
  `barcode_id` int(11) NOT NULL DEFAULT '0',
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_print` int(11) NOT NULL DEFAULT '0',
  `print_date` date NOT NULL DEFAULT '1901-01-01',
  `print_time` time NOT NULL DEFAULT '00:00:00',
  `user_barcode` int(11) NOT NULL DEFAULT '0',
  `barcode_date` date NOT NULL DEFAULT '1901-01-01',
  `barcode_time` time NOT NULL DEFAULT '00:00:00',
  `barcode_datetime` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `user_gateout` int(11) NOT NULL DEFAULT '0',
  `gateout_date` date NOT NULL DEFAULT '1901-01-01',
  `gateout_time` time NOT NULL DEFAULT '00:00:00',
  `gateout_datetime` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `user_arrived_destination` int(11) NOT NULL DEFAULT '0',
  `arrived_destination_date` date NOT NULL DEFAULT '1901-01-01',
  `arrived_destination_time` time NOT NULL DEFAULT '00:00:00',
  `arrived_destination_datetime` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `user_destination_in` int(11) NOT NULL DEFAULT '0',
  `destination_in_date` date NOT NULL DEFAULT '1901-01-01',
  `destination_in_time` time NOT NULL DEFAULT '00:00:00',
  `destination_in_datetime` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `user_receipt` int(10) NOT NULL DEFAULT '0',
  `receipt_date` date NOT NULL DEFAULT '1901-01-01',
  `receipt_time` time NOT NULL DEFAULT '00:00:00',
  `receipt_datetime` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
  `recap` tinyint(4) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_remark` varchar(255) NOT NULL,
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL,
  `time_modified` time NOT NULL,
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  `verified` smallint(1) NOT NULL,
  `user_verified` int(11) NOT NULL,
  `date_verified` date NOT NULL,
  `time_verified` time NOT NULL,
  PRIMARY KEY (`rowID`,`prefix`,`year`,`month`,`code`,`do_no`),
  KEY `rowID` (`rowID`),
  KEY `prefix` (`prefix`),
  KEY `year` (`year`),
  KEY `month` (`month`),
  KEY `code` (`code`),
  KEY `trx_no` (`trx_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tr_do_trx
-- ----------------------------

-- ----------------------------
-- Table structure for tr_jo_emkl_trx_do
-- ----------------------------
DROP TABLE IF EXISTS `tr_jo_emkl_trx_do`;
CREATE TABLE `tr_jo_emkl_trx_do` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `prefix` varchar(4) NOT NULL,
  `year` int(4) NOT NULL,
  `month` int(2) NOT NULL,
  `code` int(11) NOT NULL,
  `revisi` smallint(6) NOT NULL,
  `do_no` varchar(25) NOT NULL,
  `jo_no` varchar(25) NOT NULL,
  `jo_detail_rowID` int(11) NOT NULL,
  `container_rowID` int(11) NOT NULL,
  `from_rowID` int(11) NOT NULL,
  `to_rowID` int(11) NOT NULL,
  `container_no` varchar(25) NOT NULL,
  `port_warehouse` varchar(50) NOT NULL,
  `vessel_name` varchar(60) NOT NULL,
  `po_spk_no` varchar(25) NOT NULL,
  `sent_to` varchar(100) NOT NULL,
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`),
  KEY `lgjotrx_key` (`rowID`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tr_jo_emkl_trx_do
-- ----------------------------

-- ----------------------------
-- Table structure for tr_jo_emkl_trx_doc
-- ----------------------------
DROP TABLE IF EXISTS `tr_jo_emkl_trx_doc`;
CREATE TABLE `tr_jo_emkl_trx_doc` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `jo_no` varchar(25) NOT NULL,
  `po_no` varchar(25) NOT NULL DEFAULT '',
  `bl_no` varchar(25) NOT NULL,
  `eta_date` date NOT NULL,
  `start_demurage` date NOT NULL,
  `free_time` tinyint(4) NOT NULL,
  `sppb_date` date NOT NULL,
  `po_check` tinyint(1) NOT NULL DEFAULT '0',
  `po_date` date NOT NULL,
  `po_original` tinyint(1) NOT NULL DEFAULT '0',
  `po_copy` tinyint(1) NOT NULL DEFAULT '0',
  `bl_check` tinyint(1) NOT NULL DEFAULT '0',
  `bl_date` date NOT NULL,
  `bl_original` tinyint(1) NOT NULL DEFAULT '0',
  `bl_copy` tinyint(1) NOT NULL DEFAULT '0',
  `complete_date` date NOT NULL DEFAULT '0000-00-00',
  `quarantine_officer_name` varchar(30) NOT NULL,
  `quarantine_process_date` date NOT NULL DEFAULT '1901-01-01',
  `quarantine_finish_date` date NOT NULL,
  `quarantine_type` varchar(50) NOT NULL DEFAULT '',
  `tila_officer_name` varchar(30) NOT NULL,
  `tila_date` date NOT NULL,
  `reimburse_date` date NOT NULL,
  `survey_date` date NOT NULL,
  `guarantee_officer_name` varchar(30) NOT NULL,
  `guarantee_date` date NOT NULL,
  `back_guarantee_date` date NOT NULL,
  `finish_guarantee_date` date NOT NULL,
  `do_officer_name` varchar(30) NOT NULL,
  `redeem_date` date NOT NULL,
  `validation_date` date NOT NULL,
  `validation_date_1` date NOT NULL,
  `validation_date_2` date NOT NULL,
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`),
  KEY `lgjotrx_key` (`rowID`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tr_jo_emkl_trx_doc
-- ----------------------------

-- ----------------------------
-- Table structure for tr_jo_emkl_trx_do_process
-- ----------------------------
DROP TABLE IF EXISTS `tr_jo_emkl_trx_do_process`;
CREATE TABLE `tr_jo_emkl_trx_do_process` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `jo_no` varchar(25) NOT NULL,
  `officer_name` varchar(30) NOT NULL,
  `collection_date` date NOT NULL,
  `remark` varchar(150) NOT NULL DEFAULT '0',
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`),
  KEY `lgjotrx_key` (`rowID`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tr_jo_emkl_trx_do_process
-- ----------------------------

-- ----------------------------
-- Table structure for tr_jo_emkl_trx_dtl
-- ----------------------------
DROP TABLE IF EXISTS `tr_jo_emkl_trx_dtl`;
CREATE TABLE `tr_jo_emkl_trx_dtl` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `jo_no` varchar(25) NOT NULL,
  `party` char(1) NOT NULL,
  `item_rowID` smallint(6) NOT NULL,
  `fare_trip_rowID` int(11) NOT NULL,
  `weight` double NOT NULL DEFAULT '0',
  `container_type` smallint(6) NOT NULL,
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`),
  KEY `lgjotrx_key` (`rowID`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tr_jo_emkl_trx_dtl
-- ----------------------------

-- ----------------------------
-- Table structure for tr_jo_emkl_trx_hdr
-- ----------------------------
DROP TABLE IF EXISTS `tr_jo_emkl_trx_hdr`;
CREATE TABLE `tr_jo_emkl_trx_hdr` (
  `year` int(6) NOT NULL DEFAULT '0',
  `month` int(6) NOT NULL DEFAULT '0',
  `code` int(6) NOT NULL DEFAULT '0',
  `jo_no` varchar(25) NOT NULL,
  `jo_date` date NOT NULL,
  `jo_type` smallint(1) NOT NULL,
  `debtor_rowID` smallint(6) NOT NULL DEFAULT '0',
  `po_spk_no` varchar(25) NOT NULL DEFAULT '',
  `so_no` varchar(25) NOT NULL,
  `bl_no` varchar(25) NOT NULL,
  `vessel_rowID` int(11) NOT NULL DEFAULT '0',
  `vessel_no` varchar(25) NOT NULL DEFAULT '',
  `vessel_name` varchar(60) NOT NULL DEFAULT '',
  `port_jo_type` enum('POK','PORT','WAREHOUSE') NOT NULL,
  `port_rowID` smallint(6) NOT NULL DEFAULT '0',
  `description` varchar(255) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `invoice_date` date NOT NULL DEFAULT '1901-01-01',
  `invoice_no` varchar(25) NOT NULL DEFAULT '',
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`year`,`month`,`code`),
  KEY `lgjotrx_key` (`year`,`month`,`code`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tr_jo_emkl_trx_hdr
-- ----------------------------

-- ----------------------------
-- Table structure for tr_jo_trx_cnt
-- ----------------------------
DROP TABLE IF EXISTS `tr_jo_trx_cnt`;
CREATE TABLE `tr_jo_trx_cnt` (
  `rowID` int(12) NOT NULL AUTO_INCREMENT,
  `jo_trx_hdr_year` int(6) NOT NULL,
  `jo_trx_hdr_month` int(6) NOT NULL,
  `jo_trx_hdr_code` int(6) NOT NULL,
  `container_no` varchar(10) NOT NULL DEFAULT '',
  `container_size` varchar(12) NOT NULL DEFAULT '',
  `weight` decimal(10,0) NOT NULL DEFAULT '0',
  `row_no` smallint(6) NOT NULL DEFAULT '0',
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '0000-00-00',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`,`jo_trx_hdr_year`,`jo_trx_hdr_month`,`jo_trx_hdr_code`,`container_no`),
  KEY `lgjotrx_key` (`jo_trx_hdr_month`,`jo_trx_hdr_year`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tr_jo_trx_cnt
-- ----------------------------

-- ----------------------------
-- Table structure for tr_jo_trx_hdr
-- ----------------------------
DROP TABLE IF EXISTS `tr_jo_trx_hdr`;
CREATE TABLE `tr_jo_trx_hdr` (
  `year` int(6) NOT NULL DEFAULT '0',
  `month` int(6) NOT NULL DEFAULT '0',
  `code` int(6) NOT NULL DEFAULT '0',
  `jo_no` varchar(25) NOT NULL,
  `jo_date` date NOT NULL,
  `jo_type` smallint(1) NOT NULL,
  `debtor_rowID` smallint(6) NOT NULL DEFAULT '0',
  `po_spk_no` varchar(25) NOT NULL DEFAULT '',
  `so_no` varchar(25) NOT NULL,
  `vessel_rowID` int(11) NOT NULL DEFAULT '0',
  `vessel_no` varchar(25) NOT NULL DEFAULT '',
  `vessel_name` varchar(60) NOT NULL DEFAULT '',
  `port_jo_type` enum('POK','PORT','WAREHOUSE','DEPO') NOT NULL,
  `port_rowID` smallint(6) NOT NULL DEFAULT '0',
  `fare_trip_rowID` int(11) NOT NULL DEFAULT '0',
  `destination_from_rowID` smallint(6) NOT NULL DEFAULT '0',
  `destination_to_rowID` smallint(6) NOT NULL DEFAULT '0',
  `item_rowID` smallint(6) NOT NULL DEFAULT '0',
  `weight` double NOT NULL DEFAULT '0',
  `wholesale` tinyint(4) NOT NULL DEFAULT '0',
  `regular_type` tinyint(4) NOT NULL,
  `price_amount` double NOT NULL DEFAULT '0',
  `price_20ft` double(10,0) NOT NULL DEFAULT '0',
  `container_20ft` int(10) NOT NULL DEFAULT '0',
  `price_40ft` double(10,0) NOT NULL DEFAULT '0',
  `container_40ft` int(10) NOT NULL DEFAULT '0',
  `price_45ft` double(10,0) NOT NULL DEFAULT '0',
  `container_45ft` int(10) NOT NULL DEFAULT '0',
  `description` varchar(255) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `invoice_date` date NOT NULL DEFAULT '1901-01-01',
  `invoice_no` varchar(25) NOT NULL DEFAULT '',
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`year`,`month`,`code`),
  KEY `lgjotrx_key` (`year`,`month`,`code`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tr_jo_trx_hdr
-- ----------------------------

-- ----------------------------
-- Table structure for tr_log_attendance
-- ----------------------------
DROP TABLE IF EXISTS `tr_log_attendance`;
CREATE TABLE `tr_log_attendance` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `debtor_id` int(11) NOT NULL,
  `absent_code` char(1) NOT NULL,
  `note` text NOT NULL,
  `type_finger` int(11) NOT NULL,
  `user_modified` int(11) NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  `user_created` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_transfer` datetime NOT NULL,
  PRIMARY KEY (`rowID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tr_log_attendance
-- ----------------------------

-- ----------------------------
-- Table structure for tr_log_driver_attendance
-- ----------------------------
DROP TABLE IF EXISTS `tr_log_driver_attendance`;
CREATE TABLE `tr_log_driver_attendance` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `finger_id` int(11) NOT NULL,
  `attendance_time` datetime NOT NULL,
  `note` text NOT NULL,
  `uang_makan` tinyint(4) NOT NULL,
  `stand_by` tinyint(4) NOT NULL,
  `terminal_id` tinyint(4) NOT NULL,
  `user_created` int(11) NOT NULL,
  `date_created` date NOT NULL,
  `time_created` time NOT NULL,
  `user_modified` int(11) NOT NULL,
  `date_modified` date NOT NULL,
  `time_modified` time NOT NULL,
  PRIMARY KEY (`rowID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tr_log_driver_attendance
-- ----------------------------

-- ----------------------------
-- Table structure for tr_monitoring_trx_last_position
-- ----------------------------
DROP TABLE IF EXISTS `tr_monitoring_trx_last_position`;
CREATE TABLE `tr_monitoring_trx_last_position` (
  `car_id` int(11) NOT NULL DEFAULT '0',
  `terminal_key` varchar(15) NOT NULL,
  `gps_time` int(11) NOT NULL DEFAULT '0',
  `rcv_time` int(11) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `latitude` int(11) DEFAULT NULL,
  `longitude` int(11) DEFAULT NULL,
  `speed` int(11) DEFAULT NULL,
  `head` int(11) DEFAULT NULL,
  `valid` int(11) DEFAULT NULL,
  `fuel` int(11) DEFAULT NULL,
  `status` char(8) NOT NULL,
  `mileage` bigint(20) NOT NULL,
  `ex_bytes` char(16) NOT NULL,
  `acc` int(11) DEFAULT NULL,
  PRIMARY KEY (`car_id`,`terminal_key`,`gps_time`),
  KEY `car_id` (`car_id`),
  KEY `gps_time` (`gps_time`),
  KEY `vehicle_id` (`vehicle_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of tr_monitoring_trx_last_position
-- ----------------------------

-- ----------------------------
-- Table structure for tr_planning_order_dtl
-- ----------------------------
DROP TABLE IF EXISTS `tr_planning_order_dtl`;
CREATE TABLE `tr_planning_order_dtl` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `trx_no` varchar(25) NOT NULL DEFAULT '0',
  `vehicle_rowID` int(11) NOT NULL,
  `ritase` int(5) NOT NULL,
  `remark` varchar(150) NOT NULL,
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`),
  KEY `rowID` (`rowID`),
  KEY `deleted` (`deleted`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tr_planning_order_dtl
-- ----------------------------

-- ----------------------------
-- Table structure for tr_planning_order_hdr
-- ----------------------------
DROP TABLE IF EXISTS `tr_planning_order_hdr`;
CREATE TABLE `tr_planning_order_hdr` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `prefix` varchar(4) NOT NULL,
  `year` int(4) NOT NULL,
  `month` int(2) NOT NULL,
  `code` int(11) NOT NULL,
  `trx_no` varchar(25) NOT NULL DEFAULT '0',
  `trx_date` date NOT NULL,
  `jo_no` varchar(25) NOT NULL,
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`),
  KEY `rowID` (`rowID`),
  KEY `deleted` (`deleted`) USING BTREE,
  KEY `jo_no` (`jo_no`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tr_planning_order_hdr
-- ----------------------------

-- ----------------------------
-- Table structure for tr_queue
-- ----------------------------
DROP TABLE IF EXISTS `tr_queue`;
CREATE TABLE `tr_queue` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `debtor_id` int(11) NOT NULL,
  `type_finger` int(11) NOT NULL DEFAULT '0',
  `user_modified` int(11) NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`rowID`),
  KEY `rowID` (`rowID`),
  KEY `debtor_id` (`debtor_id`),
  KEY `type_finger` (`type_finger`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tr_queue
-- ----------------------------

-- ----------------------------
-- Table structure for tr_reimburse_trx_adv_dtl
-- ----------------------------
DROP TABLE IF EXISTS `tr_reimburse_trx_adv_dtl`;
CREATE TABLE `tr_reimburse_trx_adv_dtl` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `reimburse_number` varchar(25) NOT NULL,
  `advance_number` varchar(25) NOT NULL,
  `advance_total` double NOT NULL,
  `user_created` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `deleted` tinyint(4) NOT NULL,
  `user_deleted` int(11) NOT NULL,
  `date_deleted` datetime NOT NULL,
  PRIMARY KEY (`rowID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tr_reimburse_trx_adv_dtl
-- ----------------------------

-- ----------------------------
-- Table structure for tr_reimburse_trx_dtl
-- ----------------------------
DROP TABLE IF EXISTS `tr_reimburse_trx_dtl`;
CREATE TABLE `tr_reimburse_trx_dtl` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `reimburse_number` varchar(25) NOT NULL,
  `expense_rowID` int(11) NOT NULL,
  `descs` text NOT NULL,
  `amount` double NOT NULL,
  `user_created` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `deleted` tinyint(4) NOT NULL,
  `user_deleted` int(11) NOT NULL,
  `date_deleted` datetime NOT NULL,
  PRIMARY KEY (`rowID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tr_reimburse_trx_dtl
-- ----------------------------

-- ----------------------------
-- Table structure for tr_reimburse_trx_hdr
-- ----------------------------
DROP TABLE IF EXISTS `tr_reimburse_trx_hdr`;
CREATE TABLE `tr_reimburse_trx_hdr` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `prefix` varchar(4) NOT NULL,
  `year` int(4) NOT NULL,
  `month` int(2) NOT NULL,
  `code` int(11) NOT NULL,
  `reimburse_number` varchar(25) NOT NULL,
  `reimburse_date` date NOT NULL,
  `jo_type_advance` varchar(10) NOT NULL,
  `jo_no` varchar(25) NOT NULL,
  `advance_type_rowID` int(11) NOT NULL,
  `advance_total` double NOT NULL,
  `reimburse_total` double NOT NULL,
  `paid_total` double NOT NULL,
  `remark` text NOT NULL,
  `printed` tinyint(4) NOT NULL,
  `user_printed` int(11) NOT NULL,
  `date_printed` date NOT NULL,
  `time_printed` time NOT NULL,
  `user_created` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `user_modified` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `deleted` tinyint(4) NOT NULL,
  `user_deleted` int(11) NOT NULL,
  `date_deleted` datetime NOT NULL,
  PRIMARY KEY (`rowID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tr_reimburse_trx_hdr
-- ----------------------------

-- ----------------------------
-- Table structure for tr_service_history_dtl
-- ----------------------------
DROP TABLE IF EXISTS `tr_service_history_dtl`;
CREATE TABLE `tr_service_history_dtl` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `trx_no` varchar(25) NOT NULL DEFAULT '0',
  `complaint_note` varchar(150) NOT NULL,
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`),
  KEY `rowID` (`rowID`),
  KEY `deleted` (`deleted`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tr_service_history_dtl
-- ----------------------------

-- ----------------------------
-- Table structure for tr_service_history_hdr
-- ----------------------------
DROP TABLE IF EXISTS `tr_service_history_hdr`;
CREATE TABLE `tr_service_history_hdr` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `prefix` varchar(4) NOT NULL,
  `year` int(4) NOT NULL,
  `month` int(2) NOT NULL,
  `code` int(11) NOT NULL,
  `trx_no` varchar(25) NOT NULL DEFAULT '0',
  `trx_date` date NOT NULL,
  `vehicle_rowID` int(11) NOT NULL,
  `type` enum('Check','Regular','Urgent') NOT NULL,
  `last_km` int(9) NOT NULL,
  `debtor_rowID` int(11) NOT NULL,
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`),
  KEY `rowID` (`rowID`),
  KEY `deleted` (`deleted`) USING BTREE,
  KEY `vehicle_rowID` (`vehicle_rowID`),
  KEY `debtor_rowID` (`debtor_rowID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tr_service_history_hdr
-- ----------------------------

-- ----------------------------
-- Table structure for tr_service_receipt_dtl
-- ----------------------------
DROP TABLE IF EXISTS `tr_service_receipt_dtl`;
CREATE TABLE `tr_service_receipt_dtl` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `trx_no` varchar(25) NOT NULL DEFAULT '0',
  `spk_no` varchar(25) NOT NULL,
  `descriptions` varchar(150) NOT NULL,
  `amount` double NOT NULL,
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`),
  KEY `rowID` (`rowID`),
  KEY `deleted` (`deleted`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tr_service_receipt_dtl
-- ----------------------------

-- ----------------------------
-- Table structure for tr_service_receipt_hdr
-- ----------------------------
DROP TABLE IF EXISTS `tr_service_receipt_hdr`;
CREATE TABLE `tr_service_receipt_hdr` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `prefix` varchar(4) NOT NULL,
  `year` smallint(6) NOT NULL,
  `month` tinyint(2) NOT NULL,
  `code` int(11) NOT NULL,
  `trx_no` varchar(25) NOT NULL DEFAULT '0',
  `trx_date` date NOT NULL,
  `debtor_rowID` int(11) NOT NULL,
  `remark` varchar(150) NOT NULL,
  `total` double NOT NULL,
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`),
  KEY `rowID` (`rowID`),
  KEY `deleted` (`deleted`) USING BTREE,
  KEY `vehicle_rowID` (`total`),
  KEY `debtor_rowID` (`debtor_rowID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tr_service_receipt_hdr
-- ----------------------------

-- ----------------------------
-- Table structure for tr_spk_service_history
-- ----------------------------
DROP TABLE IF EXISTS `tr_spk_service_history`;
CREATE TABLE `tr_spk_service_history` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `code` tinyint(4) NOT NULL,
  `trx_no` varchar(25) NOT NULL DEFAULT '0',
  `trx_date` date NOT NULL,
  `complaint_no` varchar(25) NOT NULL,
  `receipt_no` varchar(25) NOT NULL,
  `type_work_list` enum('Unit','Template') NOT NULL,
  `template_service_code` varchar(25) NOT NULL,
  `change_oil` tinyint(1) NOT NULL,
  `cost_service` double NOT NULL,
  `cost_part` double NOT NULL,
  `cost_labour` double NOT NULL,
  `cost_other` double NOT NULL,
  `cost_total` double NOT NULL,
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`),
  KEY `rowID` (`rowID`),
  KEY `deleted` (`deleted`) USING BTREE,
  KEY `complaint_no` (`complaint_no`),
  KEY `template_service_code` (`template_service_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tr_spk_service_history
-- ----------------------------

-- ----------------------------
-- Table structure for tr_spk_service_history_mechanic
-- ----------------------------
DROP TABLE IF EXISTS `tr_spk_service_history_mechanic`;
CREATE TABLE `tr_spk_service_history_mechanic` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(25) NOT NULL,
  `debtor_rowID` int(11) NOT NULL,
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`,`code`),
  KEY `rowID` (`rowID`),
  KEY `deleted` (`deleted`) USING BTREE,
  KEY `code` (`code`) USING BTREE,
  KEY `debtor_rowID` (`debtor_rowID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tr_spk_service_history_mechanic
-- ----------------------------

-- ----------------------------
-- Table structure for tr_spk_service_history_part_material
-- ----------------------------
DROP TABLE IF EXISTS `tr_spk_service_history_part_material`;
CREATE TABLE `tr_spk_service_history_part_material` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(25) NOT NULL,
  `part_material_code` varchar(25) NOT NULL DEFAULT '0',
  `qty` double NOT NULL,
  `price` double NOT NULL,
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`,`code`),
  KEY `rowID` (`rowID`),
  KEY `deleted` (`deleted`) USING BTREE,
  KEY `code` (`code`) USING BTREE,
  KEY `part_material_code` (`part_material_code`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tr_spk_service_history_part_material
-- ----------------------------

-- ----------------------------
-- Table structure for tr_spk_service_history_work_list
-- ----------------------------
DROP TABLE IF EXISTS `tr_spk_service_history_work_list`;
CREATE TABLE `tr_spk_service_history_work_list` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(25) NOT NULL,
  `service_code` varchar(25) NOT NULL DEFAULT '0',
  `work_hours_spk` double(5,0) NOT NULL,
  `flat_rate_spk` double NOT NULL,
  `progress_date` date NOT NULL,
  `start_hours` time NOT NULL,
  `end_hours` time NOT NULL,
  `status` enum('Progress','Pending','Finish','Cancel') NOT NULL,
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`,`code`),
  KEY `rowID` (`rowID`),
  KEY `code` (`code`) USING BTREE,
  KEY `service_code` (`service_code`) USING BTREE,
  KEY `deleted` (`deleted`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tr_spk_service_history_work_list
-- ----------------------------

-- ----------------------------
-- Table structure for tr_spk_transporter_dtl
-- ----------------------------
DROP TABLE IF EXISTS `tr_spk_transporter_dtl`;
CREATE TABLE `tr_spk_transporter_dtl` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `spk_no` varchar(25) NOT NULL,
  `jo_emkl_detail_rowID` int(11) NOT NULL,
  `vehicle_type_rowID` int(11) NOT NULL DEFAULT '0',
  `price` double NOT NULL,
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`rowID`),
  KEY `lgjotrx_key` (`rowID`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tr_spk_transporter_dtl
-- ----------------------------

-- ----------------------------
-- Table structure for tr_spk_transporter_hdr
-- ----------------------------
DROP TABLE IF EXISTS `tr_spk_transporter_hdr`;
CREATE TABLE `tr_spk_transporter_hdr` (
  `year` int(4) NOT NULL DEFAULT '0',
  `month` int(2) NOT NULL DEFAULT '0',
  `code` int(11) NOT NULL DEFAULT '0',
  `spk_no` varchar(25) NOT NULL,
  `spk_date` date NOT NULL,
  `creditor_rowID` int(11) NOT NULL DEFAULT '0',
  `jo_type` tinyint(1) NOT NULL,
  `jo_no` varchar(25) NOT NULL DEFAULT '',
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`year`,`month`,`code`,`deleted`,`date_deleted`,`time_deleted`),
  KEY `lgjotrx_key` (`year`,`month`,`code`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tr_spk_transporter_hdr
-- ----------------------------

-- ----------------------------
-- Table structure for tr_tire_dtl
-- ----------------------------
DROP TABLE IF EXISTS `tr_tire_dtl`;
CREATE TABLE `tr_tire_dtl` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `tire_rowID` int(11) NOT NULL,
  `tire_no` varchar(25) NOT NULL,
  `tire_condition` varchar(20) NOT NULL,
  `tire_brand` varchar(30) NOT NULL,
  `tire_type` varchar(30) NOT NULL,
  `tire_size` varchar(30) NOT NULL,
  `user_created` int(11) NOT NULL,
  `datetime_created` datetime NOT NULL,
  `user_modified` int(11) NOT NULL,
  `datetime_modified` datetime NOT NULL,
  PRIMARY KEY (`rowID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tr_tire_dtl
-- ----------------------------

-- ----------------------------
-- Table structure for tr_tire_hdr
-- ----------------------------
DROP TABLE IF EXISTS `tr_tire_hdr`;
CREATE TABLE `tr_tire_hdr` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `vehicle_rowID` int(11) NOT NULL,
  `debtor_rowID` int(11) NOT NULL,
  `date` date NOT NULL,
  `tire_position` varchar(30) NOT NULL,
  `photo_url` text,
  `user_created` int(11) NOT NULL,
  `datetime_created` datetime NOT NULL,
  `user_modified` int(11) NOT NULL,
  `datetime_modified` datetime NOT NULL,
  `deleted` tinyint(4) NOT NULL,
  `user_deleted` tinyint(4) NOT NULL,
  `datetime_deleted` datetime NOT NULL,
  PRIMARY KEY (`rowID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tr_tire_hdr
-- ----------------------------

-- ----------------------------
-- Table structure for tr_vessel_trx
-- ----------------------------
DROP TABLE IF EXISTS `tr_vessel_trx`;
CREATE TABLE `tr_vessel_trx` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `year` int(4) NOT NULL,
  `code` int(8) NOT NULL,
  `row_no` int(3) NOT NULL,
  `trx_no` varchar(25) NOT NULL,
  `eta_date` date NOT NULL,
  `vessel_name` varchar(100) NOT NULL,
  `port_rowID` int(11) NOT NULL,
  `agent` varchar(100) NOT NULL,
  `original` tinyint(4) NOT NULL,
  `copy` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `remark` varchar(150) NOT NULL,
  `printed` tinyint(4) NOT NULL,
  `user_printed` int(11) NOT NULL,
  `date_printed` date NOT NULL,
  `time_printed` time NOT NULL,
  `user_created` int(11) NOT NULL,
  `date_created` date NOT NULL,
  `time_created` time NOT NULL,
  `user_modified` int(11) NOT NULL,
  `date_modified` date NOT NULL,
  `time_modified` time NOT NULL,
  `deleted` tinyint(4) NOT NULL,
  `user_deleted` int(11) NOT NULL,
  `date_deleted` date NOT NULL,
  `time_deleted` time NOT NULL,
  PRIMARY KEY (`rowID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tr_vessel_trx
-- ----------------------------

-- ----------------------------
-- Table structure for tr_vessel_trx_dtl
-- ----------------------------
DROP TABLE IF EXISTS `tr_vessel_trx_dtl`;
CREATE TABLE `tr_vessel_trx_dtl` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `trx_no` varchar(25) NOT NULL,
  `etb_date_vessel` date NOT NULL,
  `remark_vessel` varchar(150) NOT NULL,
  `printed` tinyint(4) NOT NULL,
  `user_printed` int(11) NOT NULL,
  `date_printed` date NOT NULL,
  `time_printed` time NOT NULL,
  `user_created` int(11) NOT NULL,
  `date_created` date NOT NULL,
  `time_created` time NOT NULL,
  `user_modified` int(11) NOT NULL,
  `date_modified` date NOT NULL,
  `time_modified` time NOT NULL,
  `deleted` tinyint(4) NOT NULL,
  `user_deleted` int(11) NOT NULL,
  `date_deleted` date NOT NULL,
  `time_deleted` time NOT NULL,
  PRIMARY KEY (`rowID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tr_vessel_trx_dtl
-- ----------------------------

-- ----------------------------
-- Table structure for tr_wo_trx_hdr
-- ----------------------------
DROP TABLE IF EXISTS `tr_wo_trx_hdr`;
CREATE TABLE `tr_wo_trx_hdr` (
  `code` int(6) NOT NULL,
  `year` int(4) NOT NULL,
  `wo_no` varchar(25) NOT NULL,
  `wo_date` date NOT NULL,
  `ref_no` varchar(25) NOT NULL,
  `debtor_rowID` smallint(6) NOT NULL,
  `vessel_no` varchar(25) DEFAULT NULL,
  `vessel_name` varchar(40) DEFAULT NULL,
  `port_rowID` smallint(6) DEFAULT NULL,
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`code`,`year`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tr_wo_trx_hdr
-- ----------------------------

-- ----------------------------
-- Procedure structure for GetKategori
-- ----------------------------
DROP PROCEDURE IF EXISTS `GetKategori`;
DELIMITER ;;
CREATE DEFINER=`german`@`%` PROCEDURE `GetKategori`(IN key_kat varchar(15),IN awal int,IN banyak int)
BEGIN

PREPARE STMT FROM

'SELECT *

FROM lg_comments

WHERE case_description like ? 

ORDER BY case_description

LIMIT ?,?';

SET @KEY = key_kat;

SET @START = awal;

SET @LIMIT = banyak;

EXECUTE STMT USING @KEY,@START, @LIMIT;

END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for GetKategorii
-- ----------------------------
DROP PROCEDURE IF EXISTS `GetKategorii`;
DELIMITER ;;
CREATE DEFINER=`german`@`%` PROCEDURE `GetKategorii`(IN case_description varchar(255),IN activated tinyint,IN user_created int,IN date_created date, IN time_created time )
BEGIN

INSERT INTO lg_comments (case_description, activated, user_created, date_created, time_created)

VALUES (case_description,activated,user_created, date_created, time_created);

END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `cb_bal_ins`;
DELIMITER ;;
CREATE TRIGGER `cb_bal_ins` AFTER INSERT ON `cb_trx_hdr` FOR EACH ROW BEGIN
IF (SELECT COUNT(*) FROM cb_balance WHERE year=NEW.year AND month=NEW.month AND coa_rowID =NEW.coa_rowID )=0 THEN
INSERT INTO cb_balance ( year, month, coa_rowID, open_amt, trx_amt, bal_amt )
VALUES  ( NEW.year,
	  NEW.month,
	  NEW.coa_rowID,
	  0,
	  NEW.trx_amt,
	  NEW.trx_amt 
	);
ELSE
UPDATE cb_balance
SET trx_amt = (SELECT SUM(trx_amt) FROM  cb_trx_hdr 
WHERE	cb_balance.coa_rowID 	= cb_trx_hdr.coa_rowID
AND	cb_balance.year	 	= cb_trx_hdr.year
AND	cb_balance.month	= cb_trx_hdr.month
AND          cb_trx_hdr.deleted = 0),
bal_amt = IF(open_amt >0, open_amt - (SELECT SUM(trx_amt) FROM  cb_trx_hdr
WHERE	cb_balance.coa_rowID 	= cb_trx_hdr.coa_rowID
AND	cb_balance.year	 	= cb_trx_hdr.year
AND	cb_balance.month	= cb_trx_hdr.month
AND          cb_trx_hdr.deleted = 0),
(SELECT SUM(trx_amt) FROM  cb_trx_hdr
WHERE	cb_balance.coa_rowID 	= cb_trx_hdr.coa_rowID
AND	cb_balance.year	 	= cb_trx_hdr.year
AND	cb_balance.month	= cb_trx_hdr.month
AND          cb_trx_hdr.deleted = 0));
END IF;
END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `cb_bal_upd`;
DELIMITER ;;
CREATE TRIGGER `cb_bal_upd` AFTER UPDATE ON `cb_trx_hdr` FOR EACH ROW BEGIN
UPDATE cb_balance
SET trx_amt = (SELECT SUM(trx_amt) FROM  cb_trx_hdr 
WHERE	cb_balance.coa_rowID 	= cb_trx_hdr.coa_rowID
AND	cb_balance.year	 	= cb_trx_hdr.year
AND	cb_balance.month	= cb_trx_hdr.month
AND          cb_trx_hdr.deleted = 0),
bal_amt = IF(open_amt >0, open_amt - (SELECT SUM(trx_amt) FROM  cb_trx_hdr
WHERE	cb_balance.coa_rowID 	= cb_trx_hdr.coa_rowID
AND	cb_balance.year	 	= cb_trx_hdr.year
AND	cb_balance.month	= cb_trx_hdr.month
AND          cb_trx_hdr.deleted = 0),
(SELECT SUM(trx_amt) FROM  cb_trx_hdr
WHERE	cb_balance.coa_rowID 	= cb_trx_hdr.coa_rowID
AND	cb_balance.year	 	= cb_trx_hdr.year
AND	cb_balance.month	= cb_trx_hdr.month
AND          cb_trx_hdr.deleted = 0));
END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `gl_bal_ins`;
DELIMITER ;;
CREATE TRIGGER `gl_bal_ins` AFTER INSERT ON `gl_trx_dtl` FOR EACH ROW BEGIN
IF (SELECT COUNT(*) FROM gl_balance WHERE fyear=NEW.gl_trx_hdr_year AND fmonth=NEW.gl_trx_hdr_month AND coa_rowID =NEW.coa_rowID )=0 THEN
INSERT INTO gl_balance ( fyear, fmonth, coa_rowID, open_amt, trx_amt, bal_amt )
VALUES  ( NEW.gl_trx_hdr_year,
	  NEW.gl_trx_hdr_month,
	  NEW.coa_rowID,
	  0,
	  NEW.trx_amt,
	  NEW.trx_amt 
	);
ELSE
UPDATE gl_balance
SET trx_amt = (SELECT SUM(trx_amt) FROM  gl_trx_dtl 
WHERE	gl_balance.coa_rowID 	= gl_trx_dtl.coa_rowID
AND	gl_balance.fyear	 	= gl_trx_dtl.gl_trx_hdr_year
AND	gl_balance.fmonth	= gl_trx_dtl.gl_trx_hdr_month
AND          gl_trx_dtl.deleted = 0),
bal_amt = IF(open_amt >0, open_amt - (SELECT SUM(trx_amt) FROM  gl_trx_dtl 
WHERE	gl_balance.coa_rowID 	= gl_trx_dtl.coa_rowID
AND	gl_balance.fyear	 	= gl_trx_dtl.gl_trx_hdr_year
AND	gl_balance.fmonth	= gl_trx_dtl.gl_trx_hdr_month
AND          gl_trx_dtl.deleted = 0),
(SELECT SUM(trx_amt) FROM  gl_trx_dtl 
WHERE	gl_balance.coa_rowID 	= gl_trx_dtl.coa_rowID
AND	gl_balance.fyear	 	= gl_trx_dtl.gl_trx_hdr_year
AND	gl_balance.fmonth	= gl_trx_dtl.gl_trx_hdr_month
AND          gl_trx_dtl.deleted = 0));
END IF;
END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `gl_bal_upd`;
DELIMITER ;;
CREATE TRIGGER `gl_bal_upd` AFTER UPDATE ON `gl_trx_dtl` FOR EACH ROW BEGIN
UPDATE gl_balance
SET trx_amt = (SELECT SUM(trx_amt) FROM  gl_trx_dtl 
WHERE	gl_balance.coa_rowID 	= gl_trx_dtl.coa_rowID
AND	gl_balance.fyear	 	= gl_trx_dtl.gl_trx_hdr_year
AND	gl_balance.fmonth	= gl_trx_dtl.gl_trx_hdr_month
AND          gl_trx_dtl.deleted = 0),
bal_amt = IF(open_amt >0, open_amt - (SELECT SUM(trx_amt) FROM  gl_trx_dtl 
WHERE	gl_balance.coa_rowID 	= gl_trx_dtl.coa_rowID
AND	gl_balance.fyear	 	= gl_trx_dtl.gl_trx_hdr_year
AND	gl_balance.fmonth	= gl_trx_dtl.gl_trx_hdr_month
AND          gl_trx_dtl.deleted = 0),
(SELECT SUM(trx_amt) FROM  gl_trx_dtl 
WHERE	gl_balance.coa_rowID 	= gl_trx_dtl.coa_rowID
AND	gl_balance.fyear	 	= gl_trx_dtl.gl_trx_hdr_year
AND	gl_balance.fmonth	= gl_trx_dtl.gl_trx_hdr_month
AND          gl_trx_dtl.deleted = 0));
END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `insert_mo_vehicle_position`;
DELIMITER ;;
CREATE TRIGGER `insert_mo_vehicle_position` AFTER DELETE ON `tr_monitoring_trx_last_position` FOR EACH ROW BEGIN

INSERT INTO mo_vehicle_position (type, car_id, vehicle_id, gps_time, rcv_time,latitude,longitude,speed,status,user_created,deleted,date_created)
VALUES  ( 'GPS',OLD.car_id, OLD.vehicle_id, OLD.gps_time, OLD.rcv_time, OLD.latitude, OLD.longitude,OLD.speed, OLD.status, 1,0, CURDATE());


END
;;
DELIMITER ;
