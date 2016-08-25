-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.20-log - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2012-05-25 13:15:56
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping database structure for it_inventory
CREATE DATABASE IF NOT EXISTS `it_inventory` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `it_inventory`;


-- Dumping structure for table it_inventory.access
CREATE TABLE IF NOT EXISTS `access` (
  `username` varchar(50) DEFAULT NULL,
  `userPW` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table it_inventory.assets
CREATE TABLE IF NOT EXISTS `assets` (
  `Asset_ID` int(10) NOT NULL AUTO_INCREMENT,
  `Asset_Number` int(5) DEFAULT NULL,
  `Asset_Cat_ID` int(10) DEFAULT NULL,
  `Manufacturer_ID` int(10) DEFAULT NULL,
  `Vendor_ID` int(5) DEFAULT NULL,
  `Model` varchar(150) DEFAULT NULL,
  `Model_ID` int(5) DEFAULT NULL,
  `Date_Purchased` varchar(50) DEFAULT NULL,
  `Serial_Number` varchar(50) DEFAULT NULL,
  `Service_Code` varchar(50) DEFAULT NULL,
  `Model_Number` varchar(50) DEFAULT NULL,
  `Service_Tag` varchar(50) DEFAULT NULL,
  `Express_Service_Tag` varchar(50) DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `Invoice_Number` varchar(15) DEFAULT NULL,
  `Warranty` varchar(150) DEFAULT NULL,
  `Service_Info` varchar(150) DEFAULT NULL,
  `Notes` varchar(500) DEFAULT NULL,
  `Is_Deleted` int(1) DEFAULT NULL,
  PRIMARY KEY (`Asset_ID`),
  KEY `FK_assets_asset_categories` (`Asset_Cat_ID`),
  KEY `FK_assets_manufacturers` (`Manufacturer_ID`),
  KEY `FK_assets_vendors` (`Vendor_ID`),
  KEY `FK_assets_models` (`Model_ID`),
  CONSTRAINT `FK_assets_asset_categories` FOREIGN KEY (`Asset_Cat_ID`) REFERENCES `asset_categories` (`Asset_Cat_ID`),
  CONSTRAINT `FK_assets_manufacturers` FOREIGN KEY (`Manufacturer_ID`) REFERENCES `manufacturers` (`Manufacturer_ID`),
  CONSTRAINT `FK_assets_models` FOREIGN KEY (`Model_ID`) REFERENCES `models` (`Model_ID`),
  CONSTRAINT `FK_assets_vendors` FOREIGN KEY (`Vendor_ID`) REFERENCES `vendors` (`Vendor_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED;

-- Data exporting was unselected.


-- Dumping structure for table it_inventory.asset_categories
CREATE TABLE IF NOT EXISTS `asset_categories` (
  `Asset_Cat_ID` int(10) NOT NULL AUTO_INCREMENT,
  `Asset_Class_ID` int(10) NOT NULL DEFAULT '0',
  `Asset_Cat_Desc` varchar(50) DEFAULT NULL,
  `Is_deleted` int(1) DEFAULT NULL,
  PRIMARY KEY (`Asset_Cat_ID`),
  KEY `FK_asset_categories_asset_class` (`Asset_Class_ID`),
  CONSTRAINT `FK_asset_categories_asset_class` FOREIGN KEY (`Asset_Class_ID`) REFERENCES `asset_class` (`asset_class_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table it_inventory.asset_class
CREATE TABLE IF NOT EXISTS `asset_class` (
  `asset_class_id` int(1) NOT NULL DEFAULT '0',
  `asset_class_desc` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`asset_class_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table it_inventory.computer_software
CREATE TABLE IF NOT EXISTS `computer_software` (
  `Computer_Asset_ID` int(5) NOT NULL DEFAULT '0',
  `Software_Asset_ID` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Computer_Asset_ID`,`Software_Asset_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table it_inventory.employees
CREATE TABLE IF NOT EXISTS `employees` (
  `Employee_ID` int(10) NOT NULL AUTO_INCREMENT,
  `Employee_Full_Name` varchar(50) DEFAULT NULL,
  `Role_ID` int(10) DEFAULT NULL,
  `Location_ID` int(5) DEFAULT NULL,
  `Extension` varchar(5) DEFAULT NULL,
  `Nextel_Number` varchar(20) DEFAULT NULL,
  `Office` varchar(20) DEFAULT NULL,
  `Nextel_Speed` varchar(10) DEFAULT NULL,
  `Nextel_ID` varchar(20) DEFAULT NULL,
  `Notes` varchar(255) DEFAULT NULL,
  `Is_Deleted` int(1) DEFAULT NULL,
  PRIMARY KEY (`Employee_ID`),
  KEY `FK_employees_roles` (`Role_ID`),
  KEY `FK_employees_locations` (`Location_ID`),
  CONSTRAINT `FK_employees_locations` FOREIGN KEY (`Location_ID`) REFERENCES `locations` (`Location_ID`),
  CONSTRAINT `FK_employees_roles` FOREIGN KEY (`Role_ID`) REFERENCES `roles` (`Role_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table it_inventory.employee_assets
CREATE TABLE IF NOT EXISTS `employee_assets` (
  `Employee_ID` int(5) NOT NULL DEFAULT '0',
  `Asset_ID` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Employee_ID`,`Asset_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table it_inventory.locations
CREATE TABLE IF NOT EXISTS `locations` (
  `Location_ID` int(10) NOT NULL AUTO_INCREMENT,
  `Location` varchar(100) DEFAULT NULL,
  `Location_Address` varchar(150) DEFAULT NULL,
  `Location_Main_Phone` varchar(15) DEFAULT NULL,
  `Is_Deleted` int(1) DEFAULT NULL,
  PRIMARY KEY (`Location_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table it_inventory.location_assets
CREATE TABLE IF NOT EXISTS `location_assets` (
  `Location_ID` int(10) NOT NULL DEFAULT '0',
  `Asset_ID` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Location_ID`,`Asset_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table it_inventory.manufacturers
CREATE TABLE IF NOT EXISTS `manufacturers` (
  `Manufacturer_ID` int(3) NOT NULL AUTO_INCREMENT,
  `Manufacturer_Name` varchar(50) DEFAULT NULL,
  `Is_Deleted` int(1) DEFAULT NULL,
  PRIMARY KEY (`Manufacturer_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table it_inventory.models
CREATE TABLE IF NOT EXISTS `models` (
  `Model_ID` int(10) NOT NULL AUTO_INCREMENT,
  `Model_Description` varchar(256) DEFAULT NULL,
  `Is_Deleted` int(1) DEFAULT NULL,
  PRIMARY KEY (`Model_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table it_inventory.printer_toner
CREATE TABLE IF NOT EXISTS `printer_toner` (
  `Printer_Asset_ID` int(10) NOT NULL DEFAULT '0',
  `Toner_Asset_ID` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Printer_Asset_ID`,`Toner_Asset_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table it_inventory.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `Role_ID` int(5) NOT NULL AUTO_INCREMENT,
  `Role_Description` varchar(50) DEFAULT NULL,
  `Is_Deleted` int(11) DEFAULT NULL,
  PRIMARY KEY (`Role_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table it_inventory.software
CREATE TABLE IF NOT EXISTS `software` (
  `Software_Asset_ID` int(10) NOT NULL AUTO_INCREMENT,
  `Software_Cat_ID` int(10) NOT NULL,
  `Software_Name` varchar(256) DEFAULT NULL,
  `Version` varchar(50) DEFAULT NULL,
  `Number_Licences` varchar(15) DEFAULT NULL,
  `License_Number` varchar(128) DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `Notes` varchar(256) DEFAULT NULL,
  `Is_Deleted` int(1) DEFAULT NULL,
  PRIMARY KEY (`Software_Asset_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table it_inventory.toners
CREATE TABLE IF NOT EXISTS `toners` (
  `Toner_Asset_ID` int(5) NOT NULL AUTO_INCREMENT,
  `Toner_Description` varchar(255) DEFAULT NULL,
  `Toner_Model` varchar(100) DEFAULT NULL,
  `Num_In_Stock` int(10) DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `Is_Deleted` int(10) DEFAULT '0',
  PRIMARY KEY (`Toner_Asset_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table it_inventory.vendors
CREATE TABLE IF NOT EXISTS `vendors` (
  `Vendor_ID` int(10) NOT NULL AUTO_INCREMENT,
  `Vendor_Name` varchar(75) DEFAULT NULL,
  `Vendor_Email` varchar(75) DEFAULT NULL,
  `Vendor_Phone` varchar(75) DEFAULT NULL,
  `Is_Deleted` int(1) DEFAULT NULL,
  PRIMARY KEY (`Vendor_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
