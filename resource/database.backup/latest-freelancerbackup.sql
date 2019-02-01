#
# TABLE STRUCTURE FOR: fx_account_details
#

DROP TABLE IF EXISTS fx_account_details;

CREATE TABLE `fx_account_details` (
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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

INSERT INTO fx_account_details (`id`, `user_id`, `fullname`, `company`, `city`, `country`, `address`, `phone`, `vat`, `language`, `avatar`) VALUES (1, 1, NULL, 'NULL', NULL, NULL, 'NULL', '', 'NULL', 'english', 'default_avatar.jpg');


#
# TABLE STRUCTURE FOR: fx_activities
#

DROP TABLE IF EXISTS fx_activities;

CREATE TABLE `fx_activities` (
  `activity_id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `module` varchar(32) NOT NULL,
  `module_field_id` int(11) NOT NULL,
  `activity` varchar(255) NOT NULL,
  `activity_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `icon` varchar(32) DEFAULT 'fa-coffee',
  `deleted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`activity_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: fx_bug_comments
#

DROP TABLE IF EXISTS fx_bug_comments;

CREATE TABLE `fx_bug_comments` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `bug_id` int(11) NOT NULL,
  `comment_by` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date_commented` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: fx_bug_files
#

DROP TABLE IF EXISTS fx_bug_files;

CREATE TABLE `fx_bug_files` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `bug` int(11) NOT NULL,
  `file_name` text NOT NULL,
  `description` text NOT NULL,
  `uploaded_by` int(11) NOT NULL,
  `date_posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: fx_bugs
#

DROP TABLE IF EXISTS fx_bugs;

CREATE TABLE `fx_bugs` (
  `bug_id` int(11) NOT NULL AUTO_INCREMENT,
  `issue_ref` int(11) NOT NULL,
  `project` int(11) NOT NULL,
  `reporter` int(11) NOT NULL,
  `assigned_to` int(11) NOT NULL,
  `bug_status` enum('Unconfirmed','Confirmed','In Progress','Resolved','Verified') NOT NULL DEFAULT 'Unconfirmed',
  `priority` varchar(100) NOT NULL,
  `bug_description` text NOT NULL,
  `reported_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_modified` varchar(64) NOT NULL,
  PRIMARY KEY (`bug_id`),
  UNIQUE KEY `issue_ref` (`issue_ref`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: fx_captcha
#

DROP TABLE IF EXISTS fx_captcha;

CREATE TABLE `fx_captcha` (
  `captcha_id` bigint(13) unsigned NOT NULL AUTO_INCREMENT,
  `captcha_time` int(10) unsigned NOT NULL,
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `word` varchar(20) NOT NULL,
  PRIMARY KEY (`captcha_id`),
  KEY `word` (`word`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO fx_captcha (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES (1, 1411480674, '::1', '30yGCPFp');


#
# TABLE STRUCTURE FOR: fx_comment_replies
#

DROP TABLE IF EXISTS fx_comment_replies;

CREATE TABLE `fx_comment_replies` (
  `reply_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_comment` int(11) NOT NULL,
  `reply_msg` text NOT NULL,
  `replied_by` int(11) NOT NULL,
  `del` enum('Yes','No') NOT NULL DEFAULT 'No',
  `date_posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`reply_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: fx_comments
#

DROP TABLE IF EXISTS fx_comments;

CREATE TABLE `fx_comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `project` int(11) NOT NULL,
  `posted_by` int(11) NOT NULL,
  `message` text NOT NULL,
  `date_posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` enum('Yes','No') NOT NULL DEFAULT 'No',
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: fx_config
#

DROP TABLE IF EXISTS fx_config;

CREATE TABLE `fx_config` (
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO fx_config (`key`, `value`) VALUES ('allowed_files', 'gif|jpg|png|pdf|doc|txt|docx|xls|zip');
INSERT INTO fx_config (`key`, `value`) VALUES ('base_url', 'http://localhost/devfo/');
INSERT INTO fx_config (`key`, `value`) VALUES ('company_address', '235 Aeon Street<br>\r\n95014 Quintana Roo<br>\r\nCancun');
INSERT INTO fx_config (`key`, `value`) VALUES ('company_city', 'Cancun');
INSERT INTO fx_config (`key`, `value`) VALUES ('company_country', 'Mexico');
INSERT INTO fx_config (`key`, `value`) VALUES ('company_domain', 'http://localhost/devfo/');
INSERT INTO fx_config (`key`, `value`) VALUES ('company_email', 'wm@gitbench.com');
INSERT INTO fx_config (`key`, `value`) VALUES ('company_logo', 'logo.png');
INSERT INTO fx_config (`key`, `value`) VALUES ('company_name', 'Gitbench Inc.');
INSERT INTO fx_config (`key`, `value`) VALUES ('company_phone', '+123 456 789');
INSERT INTO fx_config (`key`, `value`) VALUES ('contact_person', 'John Doe');
INSERT INTO fx_config (`key`, `value`) VALUES ('cron_key', '34WI2L12L87I1A65M90M9A42N41D08A26I');
INSERT INTO fx_config (`key`, `value`) VALUES ('default_currency', 'USD');
INSERT INTO fx_config (`key`, `value`) VALUES ('default_currency_symbol', '$');
INSERT INTO fx_config (`key`, `value`) VALUES ('default_tax', '0');
INSERT INTO fx_config (`key`, `value`) VALUES ('default_terms', 'Thank you for your business. Please process this invoice within the due date.');
INSERT INTO fx_config (`key`, `value`) VALUES ('demo_mode', 'FALSE');
INSERT INTO fx_config (`key`, `value`) VALUES ('developer', 'ig63Yd/+yuA8127gEyTz9TY4pnoeKq8dtocVP44+BJvtlRp8Vqcetwjk51dhSB6Rx8aVIKOPfUmNyKGWK7C/gg==');
INSERT INTO fx_config (`key`, `value`) VALUES ('email_estimate_message', 'Hi {CLIENT}<br>\r\nThanks for your business inquiry. <br>\r\n\r\nThe estimate EST {REF} is attached with this email. <br>\r\nEstimate Overview:<br>\r\nEstimate # : EST {REF}<br>\r\nAmount: {CURRENCY} {AMOUNT}<br>\r\n \r\nYou can view the estimate online at:<br>\r\n{LINK}<br>\r\n\r\nBest Regards,<br>\r\n{COMPANY}');
INSERT INTO fx_config (`key`, `value`) VALUES ('email_invoice_message', 'Hello {CLIENT}<br>\r\nHere is the invoice of {CURRENCY} {AMOUNT}<br>\r\nYou can view the invoice online at:<br>\r\n\r\n{LINK}<br>\r\n\r\n\r\nBest Regards,<br>\r\n\r\n{COMPANY}');
INSERT INTO fx_config (`key`, `value`) VALUES ('file_max_size', '8000');
INSERT INTO fx_config (`key`, `value`) VALUES ('language', 'english');
INSERT INTO fx_config (`key`, `value`) VALUES ('paypal_cancel_url', 'paypal/cancel');
INSERT INTO fx_config (`key`, `value`) VALUES ('paypal_email', 'wm@gitbench.com');
INSERT INTO fx_config (`key`, `value`) VALUES ('paypal_ipn_url', 'paypal/t_ipn/ipn');
INSERT INTO fx_config (`key`, `value`) VALUES ('paypal_live', 'TRUE');
INSERT INTO fx_config (`key`, `value`) VALUES ('paypal_success_url', 'paypal/success');
INSERT INTO fx_config (`key`, `value`) VALUES ('protocol', 'mail');
INSERT INTO fx_config (`key`, `value`) VALUES ('reminder_message', 'Hello {CLIENT}<br>\r\nThis is a friendly reminder to pay your invoice of {CURRENCY} {AMOUNT}<br>\r\n\r\nYou can view the invoice online at:<br>\r\n\r\n{LINK}<br>\r\n\r\n\r\nBest Regards,<br>\r\n\r\n{COMPANY}');
INSERT INTO fx_config (`key`, `value`) VALUES ('reset_key', '34WI2L12L87I1A65M90M9A42N41D08A26I');
INSERT INTO fx_config (`key`, `value`) VALUES ('site_author', 'William M.');
INSERT INTO fx_config (`key`, `value`) VALUES ('site_desc', 'Freelancer Office is a Web based PHP application for Freelancers - buy it on Codecanyon');
INSERT INTO fx_config (`key`, `value`) VALUES ('smtp_host', '');
INSERT INTO fx_config (`key`, `value`) VALUES ('smtp_pass', '/Ab3IS09BMBLmTV7nmdS2UnAczBFZL/nlMRT68gDHiOds/kLnj+xuxR9DyslRnmKi/WKIkDtfvbb24HM0ICTbQ==');
INSERT INTO fx_config (`key`, `value`) VALUES ('smtp_port', '25');
INSERT INTO fx_config (`key`, `value`) VALUES ('smtp_user', '');
INSERT INTO fx_config (`key`, `value`) VALUES ('use_postmark', 'FALSE');
INSERT INTO fx_config (`key`, `value`) VALUES ('version', '1.4');
INSERT INTO fx_config (`key`, `value`) VALUES ('webmaster_email', 'wm@gitbench.com');
INSERT INTO fx_config (`key`, `value`) VALUES ('website_name', 'Freelancer Office');


#
# TABLE STRUCTURE FOR: fx_countries
#

DROP TABLE IF EXISTS fx_countries;

CREATE TABLE `fx_countries` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `value` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=243 DEFAULT CHARSET=latin1;

INSERT INTO fx_countries (`id`, `value`) VALUES (1, 'Afghanistan');
INSERT INTO fx_countries (`id`, `value`) VALUES (2, 'Aringland Islands');
INSERT INTO fx_countries (`id`, `value`) VALUES (3, 'Albania');
INSERT INTO fx_countries (`id`, `value`) VALUES (4, 'Algeria');
INSERT INTO fx_countries (`id`, `value`) VALUES (5, 'American Samoa');
INSERT INTO fx_countries (`id`, `value`) VALUES (6, 'Andorra');
INSERT INTO fx_countries (`id`, `value`) VALUES (7, 'Angola');
INSERT INTO fx_countries (`id`, `value`) VALUES (8, 'Anguilla');
INSERT INTO fx_countries (`id`, `value`) VALUES (9, 'Antarctica');
INSERT INTO fx_countries (`id`, `value`) VALUES (10, 'Antigua and Barbuda');
INSERT INTO fx_countries (`id`, `value`) VALUES (11, 'Argentina');
INSERT INTO fx_countries (`id`, `value`) VALUES (12, 'Armenia');
INSERT INTO fx_countries (`id`, `value`) VALUES (13, 'Aruba');
INSERT INTO fx_countries (`id`, `value`) VALUES (14, 'Australia');
INSERT INTO fx_countries (`id`, `value`) VALUES (15, 'Austria');
INSERT INTO fx_countries (`id`, `value`) VALUES (16, 'Azerbaijan');
INSERT INTO fx_countries (`id`, `value`) VALUES (17, 'Bahamas');
INSERT INTO fx_countries (`id`, `value`) VALUES (18, 'Bahrain');
INSERT INTO fx_countries (`id`, `value`) VALUES (19, 'Bangladesh');
INSERT INTO fx_countries (`id`, `value`) VALUES (20, 'Barbados');
INSERT INTO fx_countries (`id`, `value`) VALUES (21, 'Belarus');
INSERT INTO fx_countries (`id`, `value`) VALUES (22, 'Belgium');
INSERT INTO fx_countries (`id`, `value`) VALUES (23, 'Belize');
INSERT INTO fx_countries (`id`, `value`) VALUES (24, 'Benin');
INSERT INTO fx_countries (`id`, `value`) VALUES (25, 'Bermuda');
INSERT INTO fx_countries (`id`, `value`) VALUES (26, 'Bhutan');
INSERT INTO fx_countries (`id`, `value`) VALUES (27, 'Bolivia');
INSERT INTO fx_countries (`id`, `value`) VALUES (28, 'Bosnia and Herzegovina');
INSERT INTO fx_countries (`id`, `value`) VALUES (29, 'Botswana');
INSERT INTO fx_countries (`id`, `value`) VALUES (30, 'Bouvet Island');
INSERT INTO fx_countries (`id`, `value`) VALUES (31, 'Brazil');
INSERT INTO fx_countries (`id`, `value`) VALUES (32, 'British Indian Ocean territory');
INSERT INTO fx_countries (`id`, `value`) VALUES (33, 'Brunei Darussalam');
INSERT INTO fx_countries (`id`, `value`) VALUES (34, 'Bulgaria');
INSERT INTO fx_countries (`id`, `value`) VALUES (35, 'Burkina Faso');
INSERT INTO fx_countries (`id`, `value`) VALUES (36, 'Burundi');
INSERT INTO fx_countries (`id`, `value`) VALUES (37, 'Cambodia');
INSERT INTO fx_countries (`id`, `value`) VALUES (38, 'Cameroon');
INSERT INTO fx_countries (`id`, `value`) VALUES (39, 'Canada');
INSERT INTO fx_countries (`id`, `value`) VALUES (40, 'Cape Verde');
INSERT INTO fx_countries (`id`, `value`) VALUES (41, 'Cayman Islands');
INSERT INTO fx_countries (`id`, `value`) VALUES (42, 'Central African Republic');
INSERT INTO fx_countries (`id`, `value`) VALUES (43, 'Chad');
INSERT INTO fx_countries (`id`, `value`) VALUES (44, 'Chile');
INSERT INTO fx_countries (`id`, `value`) VALUES (45, 'China');
INSERT INTO fx_countries (`id`, `value`) VALUES (46, 'Christmas Island');
INSERT INTO fx_countries (`id`, `value`) VALUES (47, 'Cocos (Keeling) Islands');
INSERT INTO fx_countries (`id`, `value`) VALUES (48, 'Colombia');
INSERT INTO fx_countries (`id`, `value`) VALUES (49, 'Comoros');
INSERT INTO fx_countries (`id`, `value`) VALUES (50, 'Congo');
INSERT INTO fx_countries (`id`, `value`) VALUES (51, 'Congo');
INSERT INTO fx_countries (`id`, `value`) VALUES (52, ' Democratic Republic');
INSERT INTO fx_countries (`id`, `value`) VALUES (53, 'Cook Islands');
INSERT INTO fx_countries (`id`, `value`) VALUES (54, 'Costa Rica');
INSERT INTO fx_countries (`id`, `value`) VALUES (55, 'Ivory Coast (Ivory Coast)');
INSERT INTO fx_countries (`id`, `value`) VALUES (56, 'Croatia (Hrvatska)');
INSERT INTO fx_countries (`id`, `value`) VALUES (57, 'Cuba');
INSERT INTO fx_countries (`id`, `value`) VALUES (58, 'Cyprus');
INSERT INTO fx_countries (`id`, `value`) VALUES (59, 'Czech Republic');
INSERT INTO fx_countries (`id`, `value`) VALUES (60, 'Denmark');
INSERT INTO fx_countries (`id`, `value`) VALUES (61, 'Djibouti');
INSERT INTO fx_countries (`id`, `value`) VALUES (62, 'Dominica');
INSERT INTO fx_countries (`id`, `value`) VALUES (63, 'Dominican Republic');
INSERT INTO fx_countries (`id`, `value`) VALUES (64, 'East Timor');
INSERT INTO fx_countries (`id`, `value`) VALUES (65, 'Ecuador');
INSERT INTO fx_countries (`id`, `value`) VALUES (66, 'Egypt');
INSERT INTO fx_countries (`id`, `value`) VALUES (67, 'El Salvador');
INSERT INTO fx_countries (`id`, `value`) VALUES (68, 'Equatorial Guinea');
INSERT INTO fx_countries (`id`, `value`) VALUES (69, 'Eritrea');
INSERT INTO fx_countries (`id`, `value`) VALUES (70, 'Estonia');
INSERT INTO fx_countries (`id`, `value`) VALUES (71, 'Ethiopia');
INSERT INTO fx_countries (`id`, `value`) VALUES (72, 'Falkland Islands');
INSERT INTO fx_countries (`id`, `value`) VALUES (73, 'Faroe Islands');
INSERT INTO fx_countries (`id`, `value`) VALUES (74, 'Fiji');
INSERT INTO fx_countries (`id`, `value`) VALUES (75, 'Finland');
INSERT INTO fx_countries (`id`, `value`) VALUES (76, 'France');
INSERT INTO fx_countries (`id`, `value`) VALUES (77, 'French Guiana');
INSERT INTO fx_countries (`id`, `value`) VALUES (78, 'French Polynesia');
INSERT INTO fx_countries (`id`, `value`) VALUES (79, 'French Southern Territories');
INSERT INTO fx_countries (`id`, `value`) VALUES (80, 'Gabon');
INSERT INTO fx_countries (`id`, `value`) VALUES (81, 'Gambia');
INSERT INTO fx_countries (`id`, `value`) VALUES (82, 'Georgia');
INSERT INTO fx_countries (`id`, `value`) VALUES (83, 'Germany');
INSERT INTO fx_countries (`id`, `value`) VALUES (84, 'Ghana');
INSERT INTO fx_countries (`id`, `value`) VALUES (85, 'Gibraltar');
INSERT INTO fx_countries (`id`, `value`) VALUES (86, 'Greece');
INSERT INTO fx_countries (`id`, `value`) VALUES (87, 'Greenland');
INSERT INTO fx_countries (`id`, `value`) VALUES (88, 'Grenada');
INSERT INTO fx_countries (`id`, `value`) VALUES (89, 'Guadeloupe');
INSERT INTO fx_countries (`id`, `value`) VALUES (90, 'Guam');
INSERT INTO fx_countries (`id`, `value`) VALUES (91, 'Guatemala');
INSERT INTO fx_countries (`id`, `value`) VALUES (92, 'Guinea');
INSERT INTO fx_countries (`id`, `value`) VALUES (93, 'Guinea-Bissau');
INSERT INTO fx_countries (`id`, `value`) VALUES (94, 'Guyana');
INSERT INTO fx_countries (`id`, `value`) VALUES (95, 'Haiti');
INSERT INTO fx_countries (`id`, `value`) VALUES (96, 'Heard and McDonald Islands');
INSERT INTO fx_countries (`id`, `value`) VALUES (97, 'Honduras');
INSERT INTO fx_countries (`id`, `value`) VALUES (98, 'Hong Kong');
INSERT INTO fx_countries (`id`, `value`) VALUES (99, 'Hungary');
INSERT INTO fx_countries (`id`, `value`) VALUES (100, 'Iceland');
INSERT INTO fx_countries (`id`, `value`) VALUES (101, 'India');
INSERT INTO fx_countries (`id`, `value`) VALUES (102, 'Indonesia');
INSERT INTO fx_countries (`id`, `value`) VALUES (103, 'Iran');
INSERT INTO fx_countries (`id`, `value`) VALUES (104, 'Iraq');
INSERT INTO fx_countries (`id`, `value`) VALUES (105, 'Ireland');
INSERT INTO fx_countries (`id`, `value`) VALUES (106, 'Israel');
INSERT INTO fx_countries (`id`, `value`) VALUES (107, 'Italy');
INSERT INTO fx_countries (`id`, `value`) VALUES (108, 'Jamaica');
INSERT INTO fx_countries (`id`, `value`) VALUES (109, 'Japan');
INSERT INTO fx_countries (`id`, `value`) VALUES (110, 'Jordan');
INSERT INTO fx_countries (`id`, `value`) VALUES (111, 'Kazakhstan');
INSERT INTO fx_countries (`id`, `value`) VALUES (112, 'Kenya');
INSERT INTO fx_countries (`id`, `value`) VALUES (113, 'Kiribati');
INSERT INTO fx_countries (`id`, `value`) VALUES (114, 'Korea (north)');
INSERT INTO fx_countries (`id`, `value`) VALUES (115, 'Korea (south)');
INSERT INTO fx_countries (`id`, `value`) VALUES (116, 'Kuwait');
INSERT INTO fx_countries (`id`, `value`) VALUES (117, 'Kyrgyzstan');
INSERT INTO fx_countries (`id`, `value`) VALUES (118, 'Lao People\'s Democratic Republic');
INSERT INTO fx_countries (`id`, `value`) VALUES (119, 'Latvia');
INSERT INTO fx_countries (`id`, `value`) VALUES (120, 'Lebanon');
INSERT INTO fx_countries (`id`, `value`) VALUES (121, 'Lesotho');
INSERT INTO fx_countries (`id`, `value`) VALUES (122, 'Liberia');
INSERT INTO fx_countries (`id`, `value`) VALUES (123, 'Libyan Arab Jamahiriya');
INSERT INTO fx_countries (`id`, `value`) VALUES (124, 'Liechtenstein');
INSERT INTO fx_countries (`id`, `value`) VALUES (125, 'Lithuania');
INSERT INTO fx_countries (`id`, `value`) VALUES (126, 'Luxembourg');
INSERT INTO fx_countries (`id`, `value`) VALUES (127, 'Macao');
INSERT INTO fx_countries (`id`, `value`) VALUES (128, 'Macedonia');
INSERT INTO fx_countries (`id`, `value`) VALUES (129, 'Madagascar');
INSERT INTO fx_countries (`id`, `value`) VALUES (130, 'Malawi');
INSERT INTO fx_countries (`id`, `value`) VALUES (131, 'Malaysia');
INSERT INTO fx_countries (`id`, `value`) VALUES (132, 'Maldives');
INSERT INTO fx_countries (`id`, `value`) VALUES (133, 'Mali');
INSERT INTO fx_countries (`id`, `value`) VALUES (134, 'Malta');
INSERT INTO fx_countries (`id`, `value`) VALUES (135, 'Marshall Islands');
INSERT INTO fx_countries (`id`, `value`) VALUES (136, 'Martinique');
INSERT INTO fx_countries (`id`, `value`) VALUES (137, 'Mauritania');
INSERT INTO fx_countries (`id`, `value`) VALUES (138, 'Mauritius');
INSERT INTO fx_countries (`id`, `value`) VALUES (139, 'Mayotte');
INSERT INTO fx_countries (`id`, `value`) VALUES (140, 'Mexico');
INSERT INTO fx_countries (`id`, `value`) VALUES (141, 'Micronesia');
INSERT INTO fx_countries (`id`, `value`) VALUES (142, 'Moldova');
INSERT INTO fx_countries (`id`, `value`) VALUES (143, 'Monaco');
INSERT INTO fx_countries (`id`, `value`) VALUES (144, 'Mongolia');
INSERT INTO fx_countries (`id`, `value`) VALUES (145, 'Montserrat');
INSERT INTO fx_countries (`id`, `value`) VALUES (146, 'Morocco');
INSERT INTO fx_countries (`id`, `value`) VALUES (147, 'Mozambique');
INSERT INTO fx_countries (`id`, `value`) VALUES (148, 'Myanmar');
INSERT INTO fx_countries (`id`, `value`) VALUES (149, 'Namibia');
INSERT INTO fx_countries (`id`, `value`) VALUES (150, 'Nauru');
INSERT INTO fx_countries (`id`, `value`) VALUES (151, 'Nepal');
INSERT INTO fx_countries (`id`, `value`) VALUES (152, 'Netherlands');
INSERT INTO fx_countries (`id`, `value`) VALUES (153, 'Netherlands Antilles');
INSERT INTO fx_countries (`id`, `value`) VALUES (154, 'New Caledonia');
INSERT INTO fx_countries (`id`, `value`) VALUES (155, 'New Zealand');
INSERT INTO fx_countries (`id`, `value`) VALUES (156, 'Nicaragua');
INSERT INTO fx_countries (`id`, `value`) VALUES (157, 'Niger');
INSERT INTO fx_countries (`id`, `value`) VALUES (158, 'Nigeria');
INSERT INTO fx_countries (`id`, `value`) VALUES (159, 'Niue');
INSERT INTO fx_countries (`id`, `value`) VALUES (160, 'Norfolk Island');
INSERT INTO fx_countries (`id`, `value`) VALUES (161, 'Northern Mariana Islands');
INSERT INTO fx_countries (`id`, `value`) VALUES (162, 'Norway');
INSERT INTO fx_countries (`id`, `value`) VALUES (163, 'Oman');
INSERT INTO fx_countries (`id`, `value`) VALUES (164, 'Pakistan');
INSERT INTO fx_countries (`id`, `value`) VALUES (165, 'Palau');
INSERT INTO fx_countries (`id`, `value`) VALUES (166, 'Palestinian Territories');
INSERT INTO fx_countries (`id`, `value`) VALUES (167, 'Panama');
INSERT INTO fx_countries (`id`, `value`) VALUES (168, 'Papua New Guinea');
INSERT INTO fx_countries (`id`, `value`) VALUES (169, 'Paraguay');
INSERT INTO fx_countries (`id`, `value`) VALUES (170, 'Peru');
INSERT INTO fx_countries (`id`, `value`) VALUES (171, 'Philippines');
INSERT INTO fx_countries (`id`, `value`) VALUES (172, 'Pitcairn');
INSERT INTO fx_countries (`id`, `value`) VALUES (173, 'Poland');
INSERT INTO fx_countries (`id`, `value`) VALUES (174, 'Portugal');
INSERT INTO fx_countries (`id`, `value`) VALUES (175, 'Puerto Rico');
INSERT INTO fx_countries (`id`, `value`) VALUES (176, 'Qatar');
INSERT INTO fx_countries (`id`, `value`) VALUES (177, 'Runion');
INSERT INTO fx_countries (`id`, `value`) VALUES (178, 'Romania');
INSERT INTO fx_countries (`id`, `value`) VALUES (179, 'Russian Federation');
INSERT INTO fx_countries (`id`, `value`) VALUES (180, 'Rwanda');
INSERT INTO fx_countries (`id`, `value`) VALUES (181, 'Saint Helena');
INSERT INTO fx_countries (`id`, `value`) VALUES (182, 'Saint Kitts and Nevis');
INSERT INTO fx_countries (`id`, `value`) VALUES (183, 'Saint Lucia');
INSERT INTO fx_countries (`id`, `value`) VALUES (184, 'Saint Pierre and Miquelon');
INSERT INTO fx_countries (`id`, `value`) VALUES (185, 'Saint Vincent and the Grenadines');
INSERT INTO fx_countries (`id`, `value`) VALUES (186, 'Samoa');
INSERT INTO fx_countries (`id`, `value`) VALUES (187, 'San Marino');
INSERT INTO fx_countries (`id`, `value`) VALUES (188, 'Sao Tome and Principe');
INSERT INTO fx_countries (`id`, `value`) VALUES (189, 'Saudi Arabia');
INSERT INTO fx_countries (`id`, `value`) VALUES (190, 'Senegal');
INSERT INTO fx_countries (`id`, `value`) VALUES (191, 'Serbia and Montenegro');
INSERT INTO fx_countries (`id`, `value`) VALUES (192, 'Seychelles');
INSERT INTO fx_countries (`id`, `value`) VALUES (193, 'Sierra Leone');
INSERT INTO fx_countries (`id`, `value`) VALUES (194, 'Singapore');
INSERT INTO fx_countries (`id`, `value`) VALUES (195, 'Slovakia');
INSERT INTO fx_countries (`id`, `value`) VALUES (196, 'Slovenia');
INSERT INTO fx_countries (`id`, `value`) VALUES (197, 'Solomon Islands');
INSERT INTO fx_countries (`id`, `value`) VALUES (198, 'Somalia');
INSERT INTO fx_countries (`id`, `value`) VALUES (199, 'South Africa');
INSERT INTO fx_countries (`id`, `value`) VALUES (200, 'South Georgia and the South Sandwich Islands');
INSERT INTO fx_countries (`id`, `value`) VALUES (201, 'Spain');
INSERT INTO fx_countries (`id`, `value`) VALUES (202, 'Sri Lanka');
INSERT INTO fx_countries (`id`, `value`) VALUES (203, 'Sudan');
INSERT INTO fx_countries (`id`, `value`) VALUES (204, 'Suriname');
INSERT INTO fx_countries (`id`, `value`) VALUES (205, 'Svalbard and Jan Mayen Islands');
INSERT INTO fx_countries (`id`, `value`) VALUES (206, 'Swaziland');
INSERT INTO fx_countries (`id`, `value`) VALUES (207, 'Sweden');
INSERT INTO fx_countries (`id`, `value`) VALUES (208, 'Switzerland');
INSERT INTO fx_countries (`id`, `value`) VALUES (209, 'Syria');
INSERT INTO fx_countries (`id`, `value`) VALUES (210, 'Taiwan');
INSERT INTO fx_countries (`id`, `value`) VALUES (211, 'Tajikistan');
INSERT INTO fx_countries (`id`, `value`) VALUES (212, 'Tanzania');
INSERT INTO fx_countries (`id`, `value`) VALUES (213, 'Thailand');
INSERT INTO fx_countries (`id`, `value`) VALUES (214, 'Togo');
INSERT INTO fx_countries (`id`, `value`) VALUES (215, 'Tokelau');
INSERT INTO fx_countries (`id`, `value`) VALUES (216, 'Tonga');
INSERT INTO fx_countries (`id`, `value`) VALUES (217, 'Trinidad and Tobago');
INSERT INTO fx_countries (`id`, `value`) VALUES (218, 'Tunisia');
INSERT INTO fx_countries (`id`, `value`) VALUES (219, 'Turkey');
INSERT INTO fx_countries (`id`, `value`) VALUES (220, 'Turkmenistan');
INSERT INTO fx_countries (`id`, `value`) VALUES (221, 'Turks and Caicos Islands');
INSERT INTO fx_countries (`id`, `value`) VALUES (222, 'Tuvalu');
INSERT INTO fx_countries (`id`, `value`) VALUES (223, 'Uganda');
INSERT INTO fx_countries (`id`, `value`) VALUES (224, 'Ukraine');
INSERT INTO fx_countries (`id`, `value`) VALUES (225, 'United Arab Emirates');
INSERT INTO fx_countries (`id`, `value`) VALUES (226, 'United Kingdom');
INSERT INTO fx_countries (`id`, `value`) VALUES (227, 'United States of America');
INSERT INTO fx_countries (`id`, `value`) VALUES (228, 'Uruguay');
INSERT INTO fx_countries (`id`, `value`) VALUES (229, 'Uzbekistan');
INSERT INTO fx_countries (`id`, `value`) VALUES (230, 'Vanuatu');
INSERT INTO fx_countries (`id`, `value`) VALUES (231, 'Vatican City');
INSERT INTO fx_countries (`id`, `value`) VALUES (232, 'Venezuela');
INSERT INTO fx_countries (`id`, `value`) VALUES (233, 'Vietnam');
INSERT INTO fx_countries (`id`, `value`) VALUES (234, 'Virgin Islands (British)');
INSERT INTO fx_countries (`id`, `value`) VALUES (235, 'Virgin Islands (US)');
INSERT INTO fx_countries (`id`, `value`) VALUES (236, 'Wallis and Futuna Islands');
INSERT INTO fx_countries (`id`, `value`) VALUES (237, 'Western Sahara');
INSERT INTO fx_countries (`id`, `value`) VALUES (238, 'Yemen');
INSERT INTO fx_countries (`id`, `value`) VALUES (239, 'Zaire');
INSERT INTO fx_countries (`id`, `value`) VALUES (240, 'Zambia');
INSERT INTO fx_countries (`id`, `value`) VALUES (241, 'Zimbabwe');


#
# TABLE STRUCTURE FOR: fx_estimate_items
#

DROP TABLE IF EXISTS fx_estimate_items;

CREATE TABLE `fx_estimate_items` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `estimate_id` int(11) NOT NULL,
  `item_desc` varchar(200) NOT NULL,
  `unit_cost` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_cost` float NOT NULL,
  `date_saved` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: fx_estimates
#

DROP TABLE IF EXISTS fx_estimates;

CREATE TABLE `fx_estimates` (
  `est_id` int(11) NOT NULL AUTO_INCREMENT,
  `reference_no` varchar(32) NOT NULL,
  `client` varchar(64) NOT NULL,
  `due_date` varchar(40) NOT NULL,
  `notes` varchar(255) NOT NULL DEFAULT 'Looking forward for your business.',
  `tax` int(11) NOT NULL DEFAULT '0',
  `status` enum('Accepted','Declined','Pending') NOT NULL DEFAULT 'Pending',
  `date_sent` varchar(64) NOT NULL,
  `est_deleted` enum('Yes','No') NOT NULL DEFAULT 'No',
  `date_saved` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `emailed` enum('Yes','No') NOT NULL DEFAULT 'No',
  `invoiced` enum('Yes','No') DEFAULT 'No',
  PRIMARY KEY (`est_id`),
  UNIQUE KEY `reference_no` (`reference_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: fx_files
#

DROP TABLE IF EXISTS fx_files;

CREATE TABLE `fx_files` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `project` int(11) NOT NULL,
  `file_name` text NOT NULL,
  `description` text NOT NULL,
  `uploaded_by` int(11) NOT NULL,
  `date_posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: fx_invoices
#

DROP TABLE IF EXISTS fx_invoices;

CREATE TABLE `fx_invoices` (
  `inv_id` int(11) NOT NULL AUTO_INCREMENT,
  `reference_no` varchar(32) NOT NULL,
  `client` varchar(64) NOT NULL,
  `due_date` varchar(40) NOT NULL,
  `notes` varchar(255) NOT NULL DEFAULT 'A finance charge of 1.5% will be made on unpaid balances after due day.Thank you for your business.',
  `allow_paypal` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `tax` int(11) NOT NULL DEFAULT '0',
  `recurring` enum('Yes','No') NOT NULL DEFAULT 'No',
  `r_freq` int(11) NOT NULL DEFAULT '31',
  `status` enum('Unpaid','Paid') NOT NULL DEFAULT 'Unpaid',
  `archived` int(11) NOT NULL DEFAULT '0',
  `date_sent` varchar(64) NOT NULL,
  `inv_deleted` enum('Yes','No') NOT NULL DEFAULT 'No',
  `date_saved` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `emailed` enum('Yes','No') NOT NULL DEFAULT 'No',
  PRIMARY KEY (`inv_id`),
  UNIQUE KEY `reference_no` (`reference_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: fx_ipn_log
#

DROP TABLE IF EXISTS fx_ipn_log;

CREATE TABLE `fx_ipn_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `listener_name` varchar(3) DEFAULT NULL COMMENT 'Either IPN or API',
  `transaction_type` varchar(16) DEFAULT NULL COMMENT 'The type of call being made to the listener',
  `transaction_id` varchar(19) DEFAULT NULL COMMENT 'The unique transaction ID generated by PayPal',
  `status` varchar(16) DEFAULT NULL COMMENT 'The status of the call',
  `message` varchar(512) DEFAULT NULL COMMENT 'Explanation of the call status',
  `ipn_data_hash` varchar(32) DEFAULT NULL COMMENT 'MD5 hash of the IPN post data',
  `detail` text COMMENT 'Detail text (potentially JSON) on this call',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: fx_ipn_order_items
#

DROP TABLE IF EXISTS fx_ipn_order_items;

CREATE TABLE `fx_ipn_order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `item_name` varchar(127) DEFAULT NULL COMMENT 'Item name as passed by you, the merchant. Or, if not passed by you, as entered by your customer. If this is a shopping cart transaction, Paypal will append the number of the item (e.g., item_name_1,item_name_2, and so forth).',
  `item_number` varchar(127) DEFAULT NULL COMMENT 'Pass-through variable for you to track purchases. It will get passed back to you at the completion of the payment. If omitted, no variable will be passed back to you.',
  `quantity` varchar(127) DEFAULT NULL COMMENT 'Quantity as entered by your customer or as passed by you, the merchant. If this is a shopping cart transaction, PayPal appends the number of the item (e.g., quantity1,quantity2).',
  `mc_gross` decimal(10,2) DEFAULT NULL COMMENT 'Full amount of the customer''s payment',
  `mc_handling` decimal(10,2) DEFAULT NULL COMMENT 'Total handling charge associated with the transaction',
  `mc_shipping` decimal(10,2) DEFAULT NULL COMMENT 'Total shipping amount associated with the transaction',
  `tax` decimal(10,2) DEFAULT NULL COMMENT 'Amount of tax charged on payment',
  `cost_per_item` decimal(10,2) DEFAULT NULL COMMENT 'Cost of an individual item',
  `option_name_1` varchar(64) DEFAULT NULL COMMENT 'Option 1 name as requested by you',
  `option_selection_1` varchar(200) DEFAULT NULL COMMENT 'Option 1 choice as entered by your customer',
  `option_name_2` varchar(64) DEFAULT NULL COMMENT 'Option 2 name as requested by you',
  `option_selection_2` varchar(200) DEFAULT NULL COMMENT 'Option 2 choice as entered by your customer',
  `option_name_3` varchar(64) DEFAULT NULL COMMENT 'Option 3 name as requested by you',
  `option_selection_3` varchar(200) DEFAULT NULL COMMENT 'Option 3 choice as entered by your customer',
  `option_name_4` varchar(64) DEFAULT NULL COMMENT 'Option 4 name as requested by you',
  `option_selection_4` varchar(200) DEFAULT NULL COMMENT 'Option 4 choice as entered by your customer',
  `option_name_5` varchar(64) DEFAULT NULL COMMENT 'Option 5 name as requested by you',
  `option_selection_5` varchar(200) DEFAULT NULL COMMENT 'Option 5 choice as entered by your customer',
  `option_name_6` varchar(64) DEFAULT NULL COMMENT 'Option 6 name as requested by you',
  `option_selection_6` varchar(200) DEFAULT NULL COMMENT 'Option 6 choice as entered by your customer',
  `option_name_7` varchar(64) DEFAULT NULL COMMENT 'Option 7 name as requested by you',
  `option_selection_7` varchar(200) DEFAULT NULL COMMENT 'Option 7 choice as entered by your customer',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: fx_ipn_orders
#

DROP TABLE IF EXISTS fx_ipn_orders;

CREATE TABLE `fx_ipn_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notify_version` varchar(64) DEFAULT NULL COMMENT 'IPN Version Number',
  `verify_sign` varchar(127) DEFAULT NULL COMMENT 'Encrypted string used to verify the authenticityof the tansaction',
  `test_ipn` int(11) DEFAULT NULL,
  `protection_eligibility` varchar(24) DEFAULT NULL COMMENT 'Which type of seller protection the buyer is protected by',
  `charset` varchar(127) DEFAULT NULL COMMENT 'Character set used by PayPal',
  `btn_id` varchar(40) DEFAULT NULL COMMENT 'The PayPal buy button clicked',
  `address_city` varchar(40) DEFAULT NULL COMMENT 'City of customers address',
  `address_country` varchar(64) DEFAULT NULL COMMENT 'Country of customers address',
  `address_country_code` varchar(2) DEFAULT NULL COMMENT 'Two character ISO 3166 country code',
  `address_name` varchar(128) DEFAULT NULL COMMENT 'Name used with address (included when customer provides a Gift address)',
  `address_state` varchar(40) DEFAULT NULL COMMENT 'State of customer address',
  `address_status` varchar(20) DEFAULT NULL COMMENT 'confirmed/unconfirmed',
  `address_street` varchar(200) DEFAULT NULL COMMENT 'Customer''s street address',
  `address_zip` varchar(20) DEFAULT NULL COMMENT 'Zip code of customer''s address',
  `first_name` varchar(64) DEFAULT NULL COMMENT 'Customer''s first name',
  `last_name` varchar(64) DEFAULT NULL COMMENT 'Customer''s last name',
  `payer_business_name` varchar(127) DEFAULT NULL COMMENT 'Customer''s company name, if customer represents a business',
  `payer_email` varchar(127) DEFAULT NULL COMMENT 'Customer''s primary email address. Use this email to provide any credits',
  `payer_id` varchar(13) DEFAULT NULL COMMENT 'Unique customer ID.',
  `payer_status` varchar(20) DEFAULT NULL COMMENT 'verified/unverified',
  `contact_phone` varchar(20) DEFAULT NULL COMMENT 'Customer''s telephone number.',
  `residence_country` varchar(2) DEFAULT NULL COMMENT 'Two-Character ISO 3166 country code',
  `business` varchar(127) DEFAULT NULL COMMENT 'Email address or account ID of the payment recipient (that is, the merchant). Equivalent to the values of receiver_email (If payment is sent to primary account) and business set in the Website Payment HTML.',
  `receiver_email` varchar(127) DEFAULT NULL COMMENT 'Primary email address of the payment recipient (that is, the merchant). If the payment is sent to a non-primary email address on your PayPal account, the receiver_email is still your primary email.',
  `receiver_id` varchar(13) DEFAULT NULL COMMENT 'Unique account ID of the payment recipient (i.e., the merchant). This is the same as the recipients referral ID.',
  `custom` varchar(255) DEFAULT NULL COMMENT 'Custom value as passed by you, the merchant. These are pass-through variables that are never presented to your customer.',
  `invoice` varchar(127) DEFAULT NULL COMMENT 'Pass through variable you can use to identify your invoice number for this purchase. If omitted, no variable is passed back.',
  `memo` varchar(255) DEFAULT NULL COMMENT 'Memo as entered by your customer in PayPal Website Payments note field.',
  `tax` decimal(10,2) DEFAULT NULL COMMENT 'Amount of tax charged on payment',
  `auth_id` varchar(19) DEFAULT NULL COMMENT 'Authorization identification number',
  `auth_exp` varchar(28) DEFAULT NULL COMMENT 'Authorization expiration date and time, in the following format: HH:MM:SS DD Mmm YY, YYYY PST',
  `auth_amount` int(11) DEFAULT NULL COMMENT 'Authorization amount',
  `auth_status` varchar(20) DEFAULT NULL COMMENT 'Status of authorization',
  `num_cart_items` int(11) DEFAULT NULL COMMENT 'If this is a PayPal shopping cart transaction, number of items in the cart',
  `parent_txn_id` varchar(19) DEFAULT NULL COMMENT 'In the case of a refund, reversal, or cancelled reversal, this variable contains the txn_id of the original transaction, while txn_id contains a new ID for the new transaction.',
  `payment_date` varchar(28) DEFAULT NULL COMMENT 'Time/date stamp generated by PayPal, in the following format: HH:MM:SS DD Mmm YY, YYYY PST',
  `payment_status` varchar(20) DEFAULT NULL COMMENT 'Payment status of the payment',
  `payment_type` varchar(10) DEFAULT NULL COMMENT 'echeck/instant',
  `pending_reason` varchar(20) DEFAULT NULL COMMENT 'This variable is only set if payment_status=pending',
  `reason_code` varchar(20) DEFAULT NULL COMMENT 'This variable is only set if payment_status=reversed',
  `remaining_settle` int(11) DEFAULT NULL COMMENT 'Remaining amount that can be captured with Authorization and Capture',
  `shipping_method` varchar(64) DEFAULT NULL COMMENT 'The name of a shipping method from the shipping calculations section of the merchants account profile. The buyer selected the named shipping method for this transaction',
  `shipping` decimal(10,2) DEFAULT NULL COMMENT 'Shipping charges associated with this transaction. Format unsigned, no currency symbol, two decimal places',
  `transaction_entity` varchar(20) DEFAULT NULL COMMENT 'Authorization and capture transaction entity',
  `txn_id` varchar(19) DEFAULT NULL COMMENT 'A unique transaction ID generated by PayPal',
  `txn_type` varchar(20) DEFAULT NULL COMMENT 'cart/express_checkout/send-money/virtual-terminal/web-accept',
  `exchange_rate` decimal(10,2) DEFAULT NULL COMMENT 'Exchange rate used if a currency conversion occured',
  `mc_currency` varchar(3) DEFAULT NULL COMMENT 'Three character country code. For payment IPN notifications, this is the currency of the payment, for non-payment subscription IPN notifications, this is the currency of the subscription.',
  `mc_fee` decimal(10,2) DEFAULT NULL COMMENT 'Transaction fee associated with the payment, mc_gross minus mc_fee equals the amount deposited into the receiver_email account. Equivalent to payment_fee for USD payments. If this amount is negative, it signifies a refund or reversal, and either ofthose p',
  `mc_gross` decimal(10,2) DEFAULT NULL COMMENT 'Full amount of the customer''s payment',
  `mc_handling` decimal(10,2) DEFAULT NULL COMMENT 'Total handling charge associated with the transaction',
  `mc_shipping` decimal(10,2) DEFAULT NULL COMMENT 'Total shipping amount associated with the transaction',
  `payment_fee` decimal(10,2) DEFAULT NULL COMMENT 'USD transaction fee associated with the payment',
  `payment_gross` decimal(10,2) DEFAULT NULL COMMENT 'Full USD amount of the customers payment transaction, before payment_fee is subtracted',
  `settle_amount` decimal(10,2) DEFAULT NULL COMMENT 'Amount that is deposited into the account''s primary balance after a currency conversion',
  `settle_currency` varchar(3) DEFAULT NULL COMMENT 'Currency of settle amount. Three digit currency code',
  `auction_buyer_id` varchar(64) DEFAULT NULL COMMENT 'The customer''s auction ID.',
  `auction_closing_date` varchar(28) DEFAULT NULL COMMENT 'The auction''s close date. In the format: HH:MM:SS DD Mmm YY, YYYY PSD',
  `auction_multi_item` int(11) DEFAULT NULL COMMENT 'The number of items purchased in multi-item auction payments',
  `for_auction` varchar(10) DEFAULT NULL COMMENT 'This is an auction payment - payments made using Pay for eBay Items or Smart Logos - as well as send money/money request payments with the type eBay items or Auction Goods(non-eBay)',
  `subscr_date` varchar(28) DEFAULT NULL COMMENT 'Start date or cancellation date depending on whether txn_type is subcr_signup or subscr_cancel',
  `subscr_effective` varchar(28) DEFAULT NULL COMMENT 'Date when a subscription modification becomes effective',
  `period1` varchar(10) DEFAULT NULL COMMENT '(Optional) Trial subscription interval in days, weeks, months, years (example a 4 day interval is 4 D',
  `period2` varchar(10) DEFAULT NULL COMMENT '(Optional) Trial period',
  `period3` varchar(10) DEFAULT NULL COMMENT 'Regular subscription interval in days, weeks, months, years',
  `amount1` decimal(10,2) DEFAULT NULL COMMENT 'Amount of payment for Trial period 1 for USD',
  `amount2` decimal(10,2) DEFAULT NULL COMMENT 'Amount of payment for Trial period 2 for USD',
  `amount3` decimal(10,2) DEFAULT NULL COMMENT 'Amount of payment for regular subscription  period 1 for USD',
  `mc_amount1` decimal(10,2) DEFAULT NULL COMMENT 'Amount of payment for trial period 1 regardless of currency',
  `mc_amount2` decimal(10,2) DEFAULT NULL COMMENT 'Amount of payment for trial period 2 regardless of currency',
  `mc_amount3` decimal(10,2) DEFAULT NULL COMMENT 'Amount of payment for regular subscription period regardless of currency',
  `recurring` varchar(1) DEFAULT NULL COMMENT 'Indicates whether rate recurs (1 is yes, blank is no)',
  `reattempt` varchar(1) DEFAULT NULL COMMENT 'Indicates whether reattempts should occur on payment failure (1 is yes, blank is no)',
  `retry_at` varchar(28) DEFAULT NULL COMMENT 'Date PayPal will retry a failed subscription payment',
  `recur_times` int(11) DEFAULT NULL COMMENT 'The number of payment installations that will occur at the regular rate',
  `username` varchar(64) DEFAULT NULL COMMENT '(Optional) Username generated by PayPal and given to subscriber to access the subscription',
  `password` varchar(24) DEFAULT NULL COMMENT '(Optional) Password generated by PayPal and given to subscriber to access the subscription (Encrypted)',
  `subscr_id` varchar(19) DEFAULT NULL COMMENT 'ID generated by PayPal for the subscriber',
  `case_id` varchar(28) DEFAULT NULL COMMENT 'Case identification number',
  `case_type` varchar(28) DEFAULT NULL COMMENT 'complaint/chargeback',
  `case_creation_date` varchar(28) DEFAULT NULL COMMENT 'Date/Time the case was registered',
  `order_status` enum('PAID','WAITING','REJECTED') DEFAULT NULL COMMENT 'Additional variable to make payment_status more actionable',
  `discount` decimal(10,2) DEFAULT NULL COMMENT 'Additional variable to record the discount made on the order',
  `shipping_discount` decimal(10,2) DEFAULT NULL COMMENT 'Record the discount made on the shipping',
  `ipn_track_id` varchar(127) DEFAULT NULL COMMENT 'Internal tracking variable added in April 2011',
  `transaction_subject` varchar(255) DEFAULT NULL COMMENT 'Describes the product for a button-based purchase',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UniqueTransactionID` (`txn_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: fx_items
#

DROP TABLE IF EXISTS fx_items;

CREATE TABLE `fx_items` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `item_desc` varchar(200) NOT NULL,
  `unit_cost` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_cost` float NOT NULL,
  `date_saved` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: fx_items_saved
#

DROP TABLE IF EXISTS fx_items_saved;

CREATE TABLE `fx_items_saved` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_desc` varchar(200) NOT NULL,
  `unit_cost` int(11) NOT NULL,
  `deleted` enum('Yes','No') DEFAULT 'No',
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: fx_login_attempts
#

DROP TABLE IF EXISTS fx_login_attempts;

CREATE TABLE `fx_login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(40) COLLATE utf8_bin NOT NULL,
  `login` varchar(50) COLLATE utf8_bin NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

#
# TABLE STRUCTURE FOR: fx_messages
#

DROP TABLE IF EXISTS fx_messages;

CREATE TABLE `fx_messages` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_to` int(11) NOT NULL,
  `user_from` int(11) NOT NULL,
  `message` text NOT NULL,
  `status` enum('Read','Unread') NOT NULL DEFAULT 'Unread',
  `attached_file` varchar(100) NOT NULL,
  `date_received` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` enum('Yes','No') NOT NULL DEFAULT 'No',
  PRIMARY KEY (`msg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: fx_payment_methods
#

DROP TABLE IF EXISTS fx_payment_methods;

CREATE TABLE `fx_payment_methods` (
  `method_id` int(11) NOT NULL AUTO_INCREMENT,
  `method_name` varchar(64) NOT NULL DEFAULT 'Paypal',
  PRIMARY KEY (`method_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO fx_payment_methods (`method_id`, `method_name`) VALUES (1, 'Paypal');
INSERT INTO fx_payment_methods (`method_id`, `method_name`) VALUES (2, 'Cash');


#
# TABLE STRUCTURE FOR: fx_payments
#

DROP TABLE IF EXISTS fx_payments;

CREATE TABLE `fx_payments` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice` int(11) NOT NULL,
  `paid_by` int(11) NOT NULL,
  `payer_email` varchar(100) NOT NULL,
  `payment_method` varchar(64) NOT NULL,
  `amount` float NOT NULL,
  `trans_id` varchar(64) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `month_paid` varchar(32) NOT NULL,
  `year_paid` varchar(32) NOT NULL,
  `inv_deleted` enum('Yes','No') NOT NULL DEFAULT 'No',
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: fx_project_timer
#

DROP TABLE IF EXISTS fx_project_timer;

CREATE TABLE `fx_project_timer` (
  `timer_id` int(11) NOT NULL AUTO_INCREMENT,
  `project` int(11) NOT NULL,
  `start_time` varchar(64) NOT NULL,
  `end_time` varchar(64) NOT NULL,
  `date_timed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`timer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: fx_projects
#

DROP TABLE IF EXISTS fx_projects;

CREATE TABLE `fx_projects` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_code` varchar(32) NOT NULL,
  `project_title` varchar(255) NOT NULL DEFAULT 'Project Title',
  `client` int(11) NOT NULL,
  `start_date` varchar(32) NOT NULL,
  `due_date` varchar(40) NOT NULL,
  `fixed_rate` enum('Yes','No') NOT NULL DEFAULT 'No',
  `hourly_rate` float NOT NULL,
  `fixed_price` float NOT NULL,
  `progress` int(11) NOT NULL,
  `notes` text NOT NULL,
  `assign_to` int(11) NOT NULL DEFAULT '1',
  `status` enum('On Hold','Active','Done') NOT NULL DEFAULT 'Active',
  `timer` enum('On','Off') NOT NULL DEFAULT 'Off',
  `timer_start` int(11) NOT NULL,
  `time_logged` int(11) NOT NULL,
  `proj_deleted` enum('Yes','No') NOT NULL DEFAULT 'No',
  `auto_progress` enum('TRUE','FALSE') NOT NULL DEFAULT 'FALSE',
  `estimate_hours` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: fx_roles
#

DROP TABLE IF EXISTS fx_roles;

CREATE TABLE `fx_roles` (
  `r_id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(64) NOT NULL,
  `default` int(11) NOT NULL,
  PRIMARY KEY (`r_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO fx_roles (`r_id`, `role`, `default`) VALUES (1, 'admin', 1);
INSERT INTO fx_roles (`r_id`, `role`, `default`) VALUES (2, 'client', 2);
INSERT INTO fx_roles (`r_id`, `role`, `default`) VALUES (3, 'collaborator', 3);


#
# TABLE STRUCTURE FOR: fx_saved_tasks
#

DROP TABLE IF EXISTS fx_saved_tasks;

CREATE TABLE `fx_saved_tasks` (
  `template_id` int(11) NOT NULL AUTO_INCREMENT,
  `task_name` varchar(64) NOT NULL,
  `task_desc` varchar(255) NOT NULL,
  `visible` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `estimate_hours` float NOT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `saved_by` int(11) NOT NULL,
  PRIMARY KEY (`template_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: fx_tasks
#

DROP TABLE IF EXISTS fx_tasks;

CREATE TABLE `fx_tasks` (
  `t_id` int(11) NOT NULL AUTO_INCREMENT,
  `task_name` varchar(255) NOT NULL,
  `project` int(11) NOT NULL,
  `assigned_to` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `visible` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `task_progress` int(11) NOT NULL DEFAULT '0',
  `timer_status` enum('On','Off') NOT NULL DEFAULT 'Off',
  `start_time` int(11) NOT NULL,
  `estimated_hours` int(11) NOT NULL,
  `logged_time` int(11) NOT NULL DEFAULT '0',
  `auto_progress` enum('TRUE','FALSE') NOT NULL DEFAULT 'FALSE',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `added_by` int(11) NOT NULL,
  PRIMARY KEY (`t_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: fx_tasks_timer
#

DROP TABLE IF EXISTS fx_tasks_timer;

CREATE TABLE `fx_tasks_timer` (
  `timer_id` int(11) NOT NULL AUTO_INCREMENT,
  `task` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `start_time` varchar(64) NOT NULL,
  `end_time` varchar(64) NOT NULL,
  `date_timed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`timer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: fx_un_sessions
#

DROP TABLE IF EXISTS fx_un_sessions;

CREATE TABLE `fx_un_sessions` (
  `session_id` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO fx_un_sessions (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('4e2765b5a3148ef392b03c27565d727d', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:32.0) Gecko/20100101 Firefox/32.0', 1411534356, 'a:7:{s:9:\"user_data\";s:0:\"\";s:14:\"requested_page\";s:40:\"http://localhost/devfo/settings/database\";s:7:\"user_id\";s:1:\"1\";s:8:\"username\";s:5:\"admin\";s:7:\"role_id\";s:1:\"1\";s:6:\"status\";s:1:\"1\";s:13:\"previous_page\";s:46:\"http://localhost/devfo/settings/update/general\";}');


#
# TABLE STRUCTURE FOR: fx_user_autologin
#

DROP TABLE IF EXISTS fx_user_autologin;

CREATE TABLE `fx_user_autologin` (
  `key_id` char(32) COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

#
# TABLE STRUCTURE FOR: fx_users
#

DROP TABLE IF EXISTS fx_users;

CREATE TABLE `fx_users` (
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO fx_users (`id`, `username`, `password`, `email`, `role_id`, `activated`, `banned`, `ban_reason`, `new_password_key`, `new_password_requested`, `new_email`, `new_email_key`, `last_ip`, `last_login`, `created`, `modified`) VALUES (1, 'admin', '$P$B.BL3sx4fQsTaRQrOVYiZCzRNZhUj41', 'wm@gitbench.com', 1, 1, 0, NULL, NULL, NULL, NULL, NULL, '::1', '2014-09-24 06:47:49', '2014-09-23 15:58:42', '2014-09-24 07:47:49');


