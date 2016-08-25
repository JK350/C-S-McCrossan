-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.20-log - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2012-05-25 13:22:07
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping database structure for surplusequip
CREATE DATABASE IF NOT EXISTS `surplusequip` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `surplusequip`;


-- Dumping structure for table surplusequip.equip_category
CREATE TABLE IF NOT EXISTS `equip_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `equip_type_flag` tinyint(4) NOT NULL,
  `cat_short_desc` varchar(100) NOT NULL,
  `cat_desc` varchar(255) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- Dumping data for table surplusequip.equip_category: 14 rows
/*!40000 ALTER TABLE `equip_category` DISABLE KEYS */;
INSERT INTO `equip_category` (`category_id`, `equip_type_flag`, `cat_short_desc`, `cat_desc`) VALUES
	(1, 1, 'Motor Graders', 'Motor Graders'),
	(2, 1, 'Excavators', 'Excavators'),
	(3, 1, 'Dozers', 'Dozers'),
	(4, 1, 'Rollers', 'Rollers'),
	(5, 1, 'Wheel Loaders', 'Wheel Loaders'),
	(6, 1, 'Scrapers', 'Scrapers'),
	(7, 1, 'Truck Cranes', 'Truck Cranes'),
	(8, 1, 'Off-Road Trucks', 'Off-Road Trucks'),
	(9, 1, 'Crawler Cranes', 'Crawler Cranes'),
	(10, 1, 'Asphalt Paving Equipment', 'Asphalt Paving Equipment'),
	(11, 1, 'Concrete Paving Equipment', 'Concrete Paving Equipment'),
	(12, 1, 'Rough Terrain Cranes', 'Rough Terrain Cranes'),
	(13, 7, 'Flatbed Trucks', 'Flatbed Trucks'),
	(30, 9, 'Starships', 'Starships');
/*!40000 ALTER TABLE `equip_category` ENABLE KEYS */;


-- Dumping structure for table surplusequip.equip_image
CREATE TABLE IF NOT EXISTS `equip_image` (
  `equip_image_id` int(11) NOT NULL AUTO_INCREMENT,
  `equip_sales_id` int(11) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `sort_order` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`equip_image_id`),
  KEY `equip_sales_id` (`equip_sales_id`)
) ENGINE=MyISAM AUTO_INCREMENT=214 DEFAULT CHARSET=utf8;

-- Dumping data for table surplusequip.equip_image: 153 rows
/*!40000 ALTER TABLE `equip_image` DISABLE KEYS */;
INSERT INTO `equip_image` (`equip_image_id`, `equip_sales_id`, `image_name`, `sort_order`) VALUES
	(1, 1001, 'cat', 2),
	(2, 1001, 'cat2', 1),
	(14, 1001, 'cat3', 0),
	(36, 1002, 'cat135h_4', 0),
	(37, 1002, 'cat135h_3', 0),
	(34, 1002, 'cat135h_2', 0),
	(33, 1002, 'cat135h_1', 0),
	(23, 1003, 'cat135h_2', 2),
	(22, 1003, 'cat135h_1', 1),
	(24, 1003, 'cat135h_3', 3),
	(25, 1003, 'cat135h_4', 4),
	(26, 1005, 'komatsu_1', 1),
	(27, 1005, 'komatsu_2', 2),
	(28, 1005, 'komatsu_3', 3),
	(29, 1005, 'komatsu_4', 4),
	(30, 1005, 'komatsu_5', 5),
	(31, 1005, 'komatsu_6', 6),
	(32, 1005, 'komatsu_7', 7),
	(38, 1004, 'cat_lg', 0),
	(39, 1004, 'cat2_lg', 0),
	(40, 1006, 'P186a', 1),
	(41, 1006, 'P186', 2),
	(43, 1008, 'D9R_Cab_3', 14),
	(82, 1008, 'D177a', 2),
	(84, 1008, 'D177c', 1),
	(83, 1008, 'D177b', 4),
	(105, 1009, 'BH187a', 2),
	(63, 1010, 'L111', 2),
	(58, 1012, 'TC216', 1),
	(52, 1013, 'TC217', 1),
	(53, 1014, 'S144', 1),
	(54, 1016, 'B99', 1),
	(81, 1022, 'DL200h', 16),
	(66, 1023, 'P211b', 3),
	(65, 1023, 'P211a', 1),
	(64, 1010, 'L111', 2),
	(67, 1023, 'P211c', 5),
	(68, 1023, 'P211d', 7),
	(73, 1023, 'P211e', 2),
	(71, 1023, 'P211f', 9),
	(74, 1022, 'DL200a', 2),
	(75, 1022, 'DL200b', 4),
	(76, 1022, 'DL200c', 6),
	(77, 1022, 'DL200d', 8),
	(78, 1022, 'DL200e', 10),
	(79, 1022, 'DL200f', 12),
	(80, 1022, 'DL200g', 14),
	(85, 1008, 'D177d', 6),
	(86, 1008, 'D177e', 9),
	(89, 1008, 'D177h', 8),
	(88, 1008, 'D177g', 12),
	(90, 1017, 'D178a', 2),
	(91, 1017, 'D178b', 4),
	(92, 1017, 'D178c', 6),
	(93, 1017, 'D178d', 8),
	(94, 1017, 'D178e', 10),
	(95, 1017, 'D178f', 12),
	(96, 1011, 'BH216a', 2),
	(97, 1011, 'BH216b', 4),
	(104, 1011, 'BH216i', 6),
	(99, 1011, 'BH216d', 8),
	(100, 1011, 'BH216e', 10),
	(101, 1011, 'BH216f', 12),
	(102, 1011, 'BH216g', 14),
	(103, 1011, 'BH216h', 16),
	(106, 1009, 'BH187b', 4),
	(114, 1009, 'BH187i', 16),
	(108, 1009, 'BH187d', 8),
	(111, 1009, 'BH187f', 12),
	(110, 1009, 'BH187e', 10),
	(112, 1009, 'BH187g', 14),
	(115, 1009, 'BH187n', 6),
	(116, 1016, 'B99a', 2),
	(117, 1016, 'B99b', 4),
	(118, 1016, 'B99c', 6),
	(119, 1016, 'B99d', 8),
	(120, 1016, 'B99e', 10),
	(121, 1016, 'B99f', 12),
	(123, 1016, 'B99h', 14),
	(125, 1012, 'TC216a', 2),
	(126, 1012, 'TC216b', 4),
	(127, 1012, 'TC216c', 6),
	(128, 1012, 'TC216d', 8),
	(129, 1012, 'TC216e', 10),
	(130, 1012, 'TC216f', 12),
	(131, 1012, 'TC216g', 14),
	(133, 1014, 'S144a', 2),
	(134, 1014, 'S144b', 4),
	(135, 1014, 'S144c', 6),
	(136, 1014, 'S144d', 8),
	(137, 1014, 'S144e', 10),
	(138, 1014, 'S144f', 12),
	(139, 1014, 'S144g', 14),
	(140, 1014, 'S144h', 16),
	(141, 1014, 'S144i', 18),
	(142, 1015, 'S145a', 2),
	(143, 1015, 'S145b', 4),
	(144, 1015, 'S145c', 6),
	(145, 1015, 'S145d', 8),
	(146, 1015, 'S145e', 10),
	(147, 1015, 'S145f', 12),
	(148, 1015, 'S145g', 14),
	(149, 1015, 'S145h', 16),
	(150, 1015, 'S145i', 18),
	(151, 1018, 'S155a', 2),
	(152, 1018, 'S155b', 4),
	(153, 1018, 'S155c', 6),
	(154, 1018, 'S155d', 8),
	(155, 1018, 'S155e', 10),
	(156, 1018, 'S155f', 12),
	(157, 1018, 'S155g', 14),
	(158, 1018, 'S155h', 16),
	(159, 1019, 'S156a', 2),
	(160, 1019, 'S156b', 4),
	(161, 1019, 'S156c', 6),
	(162, 1019, 'S156d', 8),
	(163, 1019, 'S156e', 10),
	(164, 1019, 'S156f', 12),
	(165, 1019, 'S156g', 14),
	(166, 1019, 'S156h', 16),
	(167, 1020, 'S153a', 2),
	(168, 1020, 'S153b', 4),
	(169, 1020, 'S153c', 6),
	(170, 1020, 'S153d', 8),
	(171, 1020, 'S153e', 10),
	(172, 1020, 'S153f', 12),
	(173, 1020, 'S153g', 14),
	(174, 1020, 'S153h', 16),
	(175, 1020, 'S153i', 18),
	(176, 1021, 'S154a', 2),
	(177, 1021, 'S154b', 4),
	(178, 1021, 'S154c', 6),
	(179, 1021, 'S154d', 8),
	(180, 1021, 'S154e', 10),
	(181, 1021, 'S154f', 12),
	(182, 1021, 'S154g', 14),
	(183, 1021, 'S154h', 16),
	(184, 1024, 'T197_Main', 2),
	(185, 1024, 'T197_Bed', 4),
	(186, 1024, 'T197_Pass_Side', 6),
	(187, 1024, 'T197_Front', 8),
	(188, 1024, 'T197_Back', 10),
	(189, 1024, 'T197_Tool_Shed', 12),
	(190, 1024, 'T197_Steer_Tire', 14),
	(191, 1024, 'T197_Rear_Tires', 16),
	(192, 1023, 'P211_TopCon_Grade_Ctrl_Sys', 11),
	(193, 1023, 'P211_Screed_ID', 13),
	(194, 1023, 'P211_On_Board_Gen', 15),
	(195, 1023, 'P211_New_Toe_Arms', 17),
	(197, 1025, 'L138', 2),
	(202, 0, '', 0),
	(203, 0, '', 0),
	(204, 0, '', 0);
/*!40000 ALTER TABLE `equip_image` ENABLE KEYS */;


-- Dumping structure for table surplusequip.equip_pw
CREATE TABLE IF NOT EXISTS `equip_pw` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table surplusequip.equip_pw: ~1 rows (approximately)
/*!40000 ALTER TABLE `equip_pw` DISABLE KEYS */;
INSERT INTO `equip_pw` (`username`, `password`) VALUES
	('21232f297a57a5a743894a0e4a801fc3', 'e4f8257c4afe30dcee42972a58ebdd59');
/*!40000 ALTER TABLE `equip_pw` ENABLE KEYS */;


-- Dumping structure for table surplusequip.equip_sales
CREATE TABLE IF NOT EXISTS `equip_sales` (
  `equip_sales_id` int(11) NOT NULL AUTO_INCREMENT,
  `item` varchar(255) DEFAULT NULL,
  `type_flag` tinyint(4) NOT NULL,
  `category_id` int(11) NOT NULL,
  `equip_make` varchar(255) DEFAULT NULL,
  `equip_model` varchar(255) DEFAULT NULL,
  `equip_year` varchar(50) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `hours_use` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `internal_nbr` varchar(50) DEFAULT NULL,
  `description` longtext,
  `photos_id` int(11) DEFAULT NULL,
  `contact_name` varchar(255) DEFAULT NULL,
  `contact_phone` varchar(50) DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `sold_ind` tinyint(4) NOT NULL DEFAULT '0',
  `active_status_flag` tinyint(4) NOT NULL DEFAULT '0',
  `create_dt_tm` datetime NOT NULL,
  `update_dt_tm` datetime NOT NULL,
  PRIMARY KEY (`equip_sales_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1064 DEFAULT CHARSET=utf8;

-- Dumping data for table surplusequip.equip_sales: 21 rows
/*!40000 ALTER TABLE `equip_sales` DISABLE KEYS */;
INSERT INTO `equip_sales` (`equip_sales_id`, `item`, `type_flag`, `category_id`, `equip_make`, `equip_model`, `equip_year`, `location`, `hours_use`, `price`, `internal_nbr`, `description`, `photos_id`, `contact_name`, `contact_phone`, `contact_email`, `sold_ind`, `active_status_flag`, `create_dt_tm`, `update_dt_tm`) VALUES
	(1014, 'Caterpillar 627F', 1, 6, 'Caterpillar', '627F', '1998', 'Maple Grove (Minneapolis), MN', '18500', 160000.00, 'S144', '', NULL, 'Equipment Sales', '763-425-4167', 'equipmentsales@mccrossan.com', 0, 1, '2011-05-02 14:56:44', '2011-05-02 15:24:44'),
	(1011, 'Caterpillar 345BL', 1, 2, 'Caterpillar', '345BL', '2002', 'Maple Grove (Minneapolis), MN', '10969', 90000.00, 'BH216', '', NULL, 'Equipment Sales', '763-425-4167', 'equipmentsales@mccrossan.com', 0, 1, '2011-05-02 14:48:49', '2011-05-07 06:26:15'),
	(1012, 'Terex RT450', 1, 12, 'Terex', 'RT450', '2000', 'Maple Grove (Minneapolis), MN', '7900', 150000.00, 'TC216', '', NULL, 'Equipment Sales', '763-425-4167', 'equipmentsales@mccrossan.com', 0, 1, '2011-05-02 14:53:41', '2011-11-28 12:53:45'),
	(1008, 'Caterpillar D9R', 1, 3, 'Caterpillar', 'D9R', '1999', 'Maple Grove (Minneapolis), MN', '13731', 195000.00, 'D177', '', NULL, 'Equipment Sales', '763-425-4167', 'equipmentsales@mccrossan.com', 0, 1, '2011-05-02 10:31:37', '2012-03-22 12:13:16'),
	(1009, 'Caterpillar 245II', 1, 2, 'Caterpillar', '245II', '1990', 'Maple Grove (Minneapolis), MN', '15514', 37500.00, 'BH187', '', NULL, 'Equipment Sales', '763-425-4167', 'equipmentsales@mccrossan.com', 0, 1, '2011-05-02 14:42:42', '2011-05-02 15:24:24'),
	(1013, 'Grove RT650E', 1, 12, 'Grove', 'RT650E', '2001', 'Maple Grove (Minneapolis), MN', '7500', 210000.00, 'TC217', '', NULL, 'Equipment Sales', '763-425-4167', 'equipmentsales@mccrossan.com', 1, 1, '2011-05-02 14:55:08', '2011-09-26 06:49:19'),
	(1010, 'Caterpillar 980G', 1, 5, 'Caterpillar', '980G', '1999', 'Maple Grove (Minneapolis), MN', '19595', 85000.00, 'L111', '', NULL, 'Equipment Sales', '763-425-4167', 'equipmentsales@mccrossan.com', 0, 0, '2011-05-02 14:47:27', '2011-10-18 14:52:59'),
	(1015, 'Caterpillar 627F', 1, 6, 'Caterpillar', '627F', '1999', 'Maple Grove (Minneapolis), MN', '18500', 160000.00, 'S145', '', NULL, 'Equipment Sales', '763-425-4167', 'equipmentsales@mccrossan.com', 0, 1, '2011-05-02 14:58:17', '2011-05-07 07:02:42'),
	(1016, 'Caterpillar 16G', 1, 1, 'Caterpillar', '16G', '1974', 'Maple Grove (Minneapolis), MN', '11599', 57500.00, 'B99', '', NULL, 'Equipment Sales', '763-425-4167', 'equipmentsales@mccrossan.com', 1, 1, '2011-05-02 14:59:16', '2011-11-28 12:36:17'),
	(1017, 'Caterpillar D9T', 1, 3, 'Caterpillar', 'D9T', '2005', 'Maple Grove (Minneapolis), MN', '6695', 455000.00, 'D178', '', NULL, 'Equipment Sales', '763-425-4167', 'equipmentsales@mccrossan.com', 0, 1, '2011-05-02 15:00:39', '2011-05-07 06:25:40'),
	(1018, 'Caterpillar 631EII', 1, 6, 'Caterpillar', '631EII', '1998', 'Maple Grove (Minneapolis), MN', '13978', 150000.00, 'S155', '', NULL, 'Equipment Sales', '763-425-4167', 'equipmentsales@mccrossan.com', 0, 1, '2011-05-02 15:04:26', '2011-12-16 15:16:48'),
	(1019, 'Caterpillar 631EII', 1, 6, 'Caterpillar', '631EII', '1998', 'Maple Grove (Minneapolis), MN', '13598', 150000.00, 'S156', '', NULL, 'Equipment Sales', '763-425-4167', 'equipmentsales@mccrossan.com', 0, 1, '2011-05-02 15:08:03', '2012-03-22 12:31:47'),
	(1020, 'Caterpillar 631EII', 1, 6, 'Caterpillar', '631EII', '1996', 'Maple Grove (Minneapolis), MN', '19595', 135000.00, 'S153', '', NULL, 'Equipment Sales', '763-425-4167', 'equipmentsales@mccrossan.com', 0, 1, '2011-05-02 15:11:33', '2011-05-07 07:18:12'),
	(1021, 'Caterpillar 631EII', 1, 6, 'Caterpillar', '631EII', '1996', 'Maple Grove (Minneapolis), MN', '19579', 135000.00, 'S154', '', NULL, 'Equipment Sales', '763-425-4167', 'equipmentsales@mccrossan.com', 0, 1, '2011-05-02 15:12:31', '2011-05-07 07:21:12'),
	(1022, 'Manitowoc 4600', 1, 9, 'Manitowoc', '4600', '1975', 'Maple Grove (Minneapolis), MN', '12600', 250000.00, 'DL200', NULL, NULL, 'Equipment Sales', '763-425-4167', 'equipmentsales@mccrossan.com', 0, 1, '2011-05-02 15:17:23', '2012-03-22 12:13:13'),
	(1023, 'Blaw Knox PF5510', 1, 10, 'Blaw Knox', 'PF5510', '1999', 'Maple Grove (Minneapolis), MN', '3816', 35000.00, 'P211', 'Includes TopCon Grade Control System and an Onboard Generator.  Toe Arms have been recently replaced.  This unit has an Omni III screed which extends up to 20\' widths.', NULL, 'Equipment Sales', '763-425-4167', 'equipmentsales@mccrossan.com', 0, 1, '2011-05-02 15:21:31', '2012-04-09 16:05:25'),
	(1024, 'Sterling LT7500', 7, 13, 'Sterling', 'LT7500', '2002', 'Maple Grove (Minneapolis), MN', '252000', 27500.00, 'T197', '2002 STerling Flatbed Truck with Heavy Duty Headache Rack and 26\' Bed.  Toolboxes on either side.', NULL, 'Equipment Sales', '763-425-4167', 'equipmentsales@mccrossan.com', 0, 1, '2011-06-23 11:09:07', '2011-06-23 11:09:07'),
	(1025, 'Komatsu WA-500', 1, 5, 'Komatsu', 'WA-500', '2005', 'Maple Grove (Minneapolis), MN', '5100', 135000.00, 'L138', '', NULL, 'Equipment Sales', '763-425-4167', 'equipmentsales@mccrossan.com', 1, 1, '2011-10-26 08:54:00', '2011-12-16 08:59:25'),
	(1026, 'Tonka Front Loader', 1, 3, 'Tonka', 'Front Loader', '1556', 'Maple Grove (Minneapolis), MN', '2', 0.00, '154258', 'Wheel Loaders', NULL, 'Bruce Jonason', '763-425-4167', 'equipmentsales@mccrossan.com', 0, 2, '2012-03-22 12:12:28', '2012-04-09 15:36:23'),
	(1045, 'The Testmobile', 1, 2, 'The', 'Testmobile', '2012', 'Maple Grove (Minneapolis), MN', 'Enough', 0.00, 'pi', 'Imagination Land', NULL, 'Bruce Jonason', '763-425-4167', 'equipmentsales@mccrossan.com', 0, 0, '2012-04-05 12:45:37', '2012-04-09 15:40:45'),
	(1061, 'Rebel X-wing', 2, 4, 'Rebel', 'X-wing', '2001', 'Maple Grove (Minneapolis), MN', '15', 15000000.00, '55', 'This is the base version of a rebel X-wing.  R2 droid is not included.', NULL, 'Equipment Sales', '763-425-4167', 'equipmentsales@mccrossan.com', 0, 1, '2012-04-09 16:07:03', '2012-04-09 16:26:32');
/*!40000 ALTER TABLE `equip_sales` ENABLE KEYS */;


-- Dumping structure for table surplusequip.equip_type
CREATE TABLE IF NOT EXISTS `equip_type` (
  `type_flag` int(3) NOT NULL,
  `type_description` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`type_flag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table surplusequip.equip_type: ~9 rows (approximately)
/*!40000 ALTER TABLE `equip_type` DISABLE KEYS */;
INSERT INTO `equip_type` (`type_flag`, `type_description`) VALUES
	(1, 'Heavy Equipment'),
	(2, 'Aggregates'),
	(3, 'Asphalt'),
	(4, 'Barriers/Construction Mateial'),
	(5, 'Structures'),
	(6, 'Tools/Small Equipment'),
	(7, 'Trucks'),
	(8, 'Vehicles'),
	(9, 'Other');
/*!40000 ALTER TABLE `equip_type` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
