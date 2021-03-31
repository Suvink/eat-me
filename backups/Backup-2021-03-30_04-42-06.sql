-- MariaDB dump 10.17  Distrib 10.4.11-MariaDB, for osx10.10 (x86_64)
--
-- Host: localhost    Database: eat_me
-- ------------------------------------------------------
-- Server version	10.4.11-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `add_stock`
--

DROP TABLE IF EXISTS `add_stock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `add_stock` (
  `grnNo` int(11) NOT NULL,
  `added_quntity` int(11) NOT NULL,
  `date&time` datetime(6) NOT NULL,
  `inventoryId` int(11) NOT NULL,
  PRIMARY KEY (`grnNo`),
  KEY `inventoryId` (`inventoryId`),
  CONSTRAINT `add_stock_ibfk_1` FOREIGN KEY (`inventoryId`) REFERENCES `inventory` (`inventoryId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `add_stock`
--

LOCK TABLES `add_stock` WRITE;
/*!40000 ALTER TABLE `add_stock` DISABLE KEYS */;
/*!40000 ALTER TABLE `add_stock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer` (
  `customerId` int(11) NOT NULL AUTO_INCREMENT,
  `contactNo` int(11) NOT NULL,
  `firstName` varchar(20) DEFAULT NULL,
  `lastName` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `profileType` varchar(12) NOT NULL,
  PRIMARY KEY (`customerId`)
) ENGINE=InnoDB AUTO_INCREMENT=1014 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (1001,771655199,'Suvin','Nimnaka','hello@suvin.me','PROVISIONED'),(1002,768452198,'Mike','Oxmall','hirunz@oxmall.com','ACTIVE'),(1008,771655198,'Suvin','Nimnaka','hello@suvin.me','ACTIVE'),(1009,773296001,'user-A0HN9CYV2D','user-A0HN9CYV2D','user-A0HN9CYV2D@eat-me.live','PROVISIONED'),(1010,772836442,'user-QUVLXG10HR','user-QUVLXG10HR','user-QUVLXG10HR@eat-me.live','PROVISIONED'),(1011,768043101,'user-2LK3B9ISED','user-2LK3B9ISED','user-2LK3B9ISED@eat-me.live','PROVISIONED'),(1012,778337436,'user-BZLCIAUGOM','user-BZLCIAUGOM','user-BZLCIAUGOM@eat-me.live','PROVISIONED'),(1013,765369973,'Maheshi','Yatipansalawa','meesiyatipansalawa@gmail.com','PROVISIONED');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_rates_order`
--

DROP TABLE IF EXISTS `customer_rates_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_rates_order` (
  `orderRateId` int(11) NOT NULL AUTO_INCREMENT,
  `orderRating` int(11) NOT NULL,
  `description` longtext NOT NULL,
  `orderId` int(11) NOT NULL,
  PRIMARY KEY (`orderRateId`),
  KEY `orderId` (`orderId`),
  CONSTRAINT `customer_rates_order_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `order_details` (`orderId`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_rates_order`
--

LOCK TABLES `customer_rates_order` WRITE;
/*!40000 ALTER TABLE `customer_rates_order` DISABLE KEYS */;
INSERT INTO `customer_rates_order` VALUES (29,4,'Test review',5002);
/*!40000 ALTER TABLE `customer_rates_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `delivery_fees`
--

DROP TABLE IF EXISTS `delivery_fees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `delivery_fees` (
  `type` varchar(20) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `delivery_fees`
--

LOCK TABLES `delivery_fees` WRITE;
/*!40000 ALTER TABLE `delivery_fees` DISABLE KEYS */;
INSERT INTO `delivery_fees` VALUES ('standard',100);
/*!40000 ALTER TABLE `delivery_fees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dine_in_order`
--

DROP TABLE IF EXISTS `dine_in_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dine_in_order` (
  `dineInId` int(11) NOT NULL AUTO_INCREMENT,
  `orderId` int(11) NOT NULL,
  `tableNo` int(11) NOT NULL,
  PRIMARY KEY (`dineInId`),
  KEY `orderId` (`orderId`),
  CONSTRAINT `dine_in_order_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `order_details` (`orderId`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dine_in_order`
--

LOCK TABLES `dine_in_order` WRITE;
/*!40000 ALTER TABLE `dine_in_order` DISABLE KEYS */;
INSERT INTO `dine_in_order` VALUES (2,5002,6),(14,5003,6),(16,5004,6),(20,5007,4);
/*!40000 ALTER TABLE `dine_in_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dp_rates_customer`
--

DROP TABLE IF EXISTS `dp_rates_customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dp_rates_customer` (
  `customerRateId` int(11) NOT NULL AUTO_INCREMENT,
  `customerRating` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `staffId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  PRIMARY KEY (`customerRateId`),
  KEY `staffId` (`staffId`),
  KEY `customerId` (`customerId`),
  CONSTRAINT `dp_rates_customer_ibfk_1` FOREIGN KEY (`staffId`) REFERENCES `staff` (`staffId`),
  CONSTRAINT `dp_rates_customer_ibfk_2` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dp_rates_customer`
--

LOCK TABLES `dp_rates_customer` WRITE;
/*!40000 ALTER TABLE `dp_rates_customer` DISABLE KEYS */;
/*!40000 ALTER TABLE `dp_rates_customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favourite_order`
--

DROP TABLE IF EXISTS `favourite_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `favourite_order` (
  `favoriteId` int(11) NOT NULL AUTO_INCREMENT,
  `orderId` int(11) NOT NULL,
  `cutomerId` int(11) NOT NULL,
  PRIMARY KEY (`favoriteId`),
  KEY `cutomerId` (`cutomerId`),
  KEY `orderId` (`orderId`),
  CONSTRAINT `favourite_order_ibfk_1` FOREIGN KEY (`cutomerId`) REFERENCES `customer` (`customerId`),
  CONSTRAINT `favourite_order_ibfk_2` FOREIGN KEY (`orderId`) REFERENCES `order_details` (`orderId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favourite_order`
--

LOCK TABLES `favourite_order` WRITE;
/*!40000 ALTER TABLE `favourite_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `favourite_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventory`
--

DROP TABLE IF EXISTS `inventory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventory` (
  `inventoryId` int(11) NOT NULL AUTO_INCREMENT,
  `itemName` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`inventoryId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventory`
--

LOCK TABLES `inventory` WRITE;
/*!40000 ALTER TABLE `inventory` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `itemNo` int(11) NOT NULL AUTO_INCREMENT,
  `itemName` varchar(20) NOT NULL,
  `availability` varchar(10) NOT NULL,
  `price` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `url` text NOT NULL,
  PRIMARY KEY (`itemNo`)
) ENGINE=InnoDB AUTO_INCREMENT=5015 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (2015,'Vanilla Sundae','true',200,'desserts','https://i.ibb.co/XJBqy6c/vanila-sundae.png'),(5001,'Checken Salad','true',350,'mains','https://i.ibb.co/bHjg9zT/chicken-salad.png'),(5002,'Chicken Burgers','true',400,'mains','https://i.ibb.co/nQxm5Vp/chicken-burger.png'),(5003,'Beef Pasta','true',280,'mains','https://i.ibb.co/k3xvBqp/chicken-pasta.png'),(5004,'Chicken Fried Rice','false',250,'mains','https://i.ibb.co/vcBSBTs/chicken-rice.png'),(5005,'Dosai','true',20,'mains','https://i.ibb.co/cTrjrD9/dosai.png'),(5006,'Garlic Bread','true',190,'starters','https://i.ibb.co/BnFrCpF/garlic-bread.png'),(5007,'Chicken Wings','true',400,'starters','https://i.ibb.co/CBgR3hP/chicken-wings.png'),(5008,'French Fries','true',150,'starters','https://i.ibb.co/pXTKBGX/french-fries.png'),(5009,'Coca Cola 1L','true',250,'beverages','https://i.ibb.co/BTWcnbd/coke.png'),(5010,'Milkshake','true',300,'beverages','https://i.ibb.co/vxCv6PQ/milkshake.png'),(5011,'Faluda','true',120,'beverages','https://i.ibb.co/WG0g27z/falooda.png'),(5012,'Mineral Water 1L','true',50,'beverages','https://i.ibb.co/1svdj5D/water.png'),(5013,'Watalappan','true',80,'desserts','https://i.ibb.co/PN7NzvT/watalappan.jpg'),(5014,'Fruit Salad','true',120,'desserts','https://i.ibb.co/dsZg8sC/fruit-salad.png');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `minor_staff`
--

DROP TABLE IF EXISTS `minor_staff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `minor_staff` (
  `minorId` int(11) NOT NULL AUTO_INCREMENT,
  `staffId` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`minorId`),
  KEY `staffId` (`staffId`),
  CONSTRAINT `minor_staff_ibfk_1` FOREIGN KEY (`staffId`) REFERENCES `staff` (`staffId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `minor_staff`
--

LOCK TABLES `minor_staff` WRITE;
/*!40000 ALTER TABLE `minor_staff` DISABLE KEYS */;
/*!40000 ALTER TABLE `minor_staff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `online_order`
--

DROP TABLE IF EXISTS `online_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `online_order` (
  `onlineId` int(11) NOT NULL AUTO_INCREMENT,
  `orderId` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `delivery_fee` int(11) NOT NULL,
  PRIMARY KEY (`onlineId`),
  KEY `orderId` (`orderId`),
  CONSTRAINT `online_order_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `order_details` (`orderId`)
) ENGINE=InnoDB AUTO_INCREMENT=2378 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `online_order`
--

LOCK TABLES `online_order` WRITE;
/*!40000 ALTER TABLE `online_order` DISABLE KEYS */;
INSERT INTO `online_order` VALUES (2370,5000,'35B, Kitulampitiya RD, Kalegana',100),(2374,5001,'35B, Kitulampitiya RD, Kalegana',100),(2376,5005,'35B, Kitulampitiya RD, Kalegana',100),(2377,5006,'35B, Kitulampitiya RD, Kalegana',100);
/*!40000 ALTER TABLE `online_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_details` (
  `orderId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `orderType` varchar(20) NOT NULL,
  `amount` int(11) NOT NULL,
  `paymentType` varchar(20) NOT NULL,
  `payment_status` varchar(30) NOT NULL,
  `timestamp` varchar(20) NOT NULL,
  `assignedTime` int(11) NOT NULL,
  `preparedTime` int(11) NOT NULL,
  `orderStatus` int(11) NOT NULL,
  PRIMARY KEY (`orderId`),
  KEY `customerId` (`customerId`),
  CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_details`
--

LOCK TABLES `order_details` WRITE;
/*!40000 ALTER TABLE `order_details` DISABLE KEYS */;
INSERT INTO `order_details` VALUES (5000,1008,'online',830,'cash','COMPLETED','1616597657',0,0,8),(5001,1008,'online',380,'cash','COMPLETED','1616621880',0,0,8),(5002,1008,'dinein',550,'payhere','COMPLETED','1616630646',0,0,8),(5003,1008,'dinein',550,'cash','COMPLETED','1616763403',0,0,8),(5004,1008,'dinein',470,'cash','COMPLETED','1616902228',0,0,8),(5005,1008,'online',520,'cash','PENDING','1616954652',0,0,8),(5006,1008,'online',1250,'cash','PENDING','1617025066',0,0,1),(5007,1008,'dinein',400,'cash','PENDING','1617048583',0,0,1);
/*!40000 ALTER TABLE `order_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_includes_menu`
--

DROP TABLE IF EXISTS `order_includes_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_includes_menu` (
  `orderMenuId` int(11) NOT NULL AUTO_INCREMENT,
  `orderId` int(11) NOT NULL,
  `itemNo` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `dateAndTime` varchar(128) NOT NULL,
  PRIMARY KEY (`orderMenuId`),
  KEY `orderId` (`orderId`),
  KEY `itemNo` (`itemNo`),
  CONSTRAINT `order_includes_menu_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `order_details` (`orderId`),
  CONSTRAINT `order_includes_menu_ibfk_2` FOREIGN KEY (`itemNo`) REFERENCES `menu` (`itemNo`)
) ENGINE=InnoDB AUTO_INCREMENT=173 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_includes_menu`
--

LOCK TABLES `order_includes_menu` WRITE;
/*!40000 ALTER TABLE `order_includes_menu` DISABLE KEYS */;
INSERT INTO `order_includes_menu` VALUES (112,5000,5001,1,'1616597657'),(113,5000,5003,1,'1616597657'),(114,5000,5005,5,'1616597657'),(118,5001,5003,1,'1616621880'),(120,5002,5007,1,'1616630646'),(121,5002,5008,1,'1616630646'),(153,5003,5003,1,'1616763403'),(154,5003,5004,1,'1616763403'),(155,5003,5005,1,'1616763403'),(159,5004,5003,1,'1616902228'),(160,5004,5006,1,'1616902228'),(165,5005,5002,1,'1616954652'),(166,5005,5005,1,'1616954654'),(167,5006,5001,1,'1617025066'),(168,5006,5007,2,'1617025067'),(172,5007,5002,1,'1617048584');
/*!40000 ALTER TABLE `order_includes_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `otp_temp`
--

DROP TABLE IF EXISTS `otp_temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `otp_temp` (
  `token` varchar(10) NOT NULL,
  `otp` int(11) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `timeStamp` varchar(255) NOT NULL,
  PRIMARY KEY (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `otp_temp`
--

LOCK TABLES `otp_temp` WRITE;
/*!40000 ALTER TABLE `otp_temp` DISABLE KEYS */;
/*!40000 ALTER TABLE `otp_temp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `retrieve_stock`
--

DROP TABLE IF EXISTS `retrieve_stock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `retrieve_stock` (
  `retrieveId` int(11) NOT NULL,
  `retrieve_quantity` int(11) NOT NULL,
  `retrieved_date&time` datetime(6) NOT NULL,
  `inventoryId` int(11) NOT NULL,
  PRIMARY KEY (`retrieveId`),
  KEY `inventoryId` (`inventoryId`),
  CONSTRAINT `retrieve_stock_ibfk_1` FOREIGN KEY (`inventoryId`) REFERENCES `inventory` (`inventoryId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `retrieve_stock`
--

LOCK TABLES `retrieve_stock` WRITE;
/*!40000 ALTER TABLE `retrieve_stock` DISABLE KEYS */;
/*!40000 ALTER TABLE `retrieve_stock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `staff` (
  `staffId` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `contactNo` int(11) NOT NULL,
  `email` varchar(20) NOT NULL,
  `roleId` int(11) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`staffId`),
  KEY `roleId` (`roleId`),
  CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`roleId`) REFERENCES `staff_roles` (`roleId`)
) ENGINE=InnoDB AUTO_INCREMENT=1002 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff`
--

LOCK TABLES `staff` WRITE;
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
INSERT INTO `staff` VALUES (1001,'Bunny','G',740131770,'bunny@sukii.com',4,'bunny');
/*!40000 ALTER TABLE `staff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staff_order`
--

DROP TABLE IF EXISTS `staff_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `staff_order` (
  `manageId` int(11) NOT NULL AUTO_INCREMENT,
  `orderId` int(11) NOT NULL,
  `staffId` int(11) NOT NULL,
  PRIMARY KEY (`manageId`),
  KEY `orderId` (`orderId`),
  KEY `staffId` (`staffId`),
  CONSTRAINT `staff_order_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `order_details` (`orderId`),
  CONSTRAINT `staff_order_ibfk_2` FOREIGN KEY (`staffId`) REFERENCES `staff` (`staffId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff_order`
--

LOCK TABLES `staff_order` WRITE;
/*!40000 ALTER TABLE `staff_order` DISABLE KEYS */;
INSERT INTO `staff_order` VALUES (3,4323,1001);
/*!40000 ALTER TABLE `staff_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staff_roles`
--

DROP TABLE IF EXISTS `staff_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `staff_roles` (
  `roleId` int(11) NOT NULL AUTO_INCREMENT,
  `roleName` text NOT NULL,
  `salary` int(11) NOT NULL,
  PRIMARY KEY (`roleId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff_roles`
--

LOCK TABLES `staff_roles` WRITE;
/*!40000 ALTER TABLE `staff_roles` DISABLE KEYS */;
INSERT INTO `staff_roles` VALUES (1,'admin',20000),(2,'kitchen manager',15000),(4,'cashier',15000);
/*!40000 ALTER TABLE `staff_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staff_salary`
--

DROP TABLE IF EXISTS `staff_salary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `staff_salary` (
  `salaryId` int(11) NOT NULL AUTO_INCREMENT,
  `staffId` int(11) NOT NULL,
  `roleId` int(11) NOT NULL,
  `workingHrs` float NOT NULL,
  PRIMARY KEY (`salaryId`),
  KEY `roleId` (`roleId`),
  KEY `staffId` (`staffId`),
  CONSTRAINT `staff_salary_ibfk_1` FOREIGN KEY (`roleId`) REFERENCES `staff_roles` (`roleId`),
  CONSTRAINT `staff_salary_ibfk_2` FOREIGN KEY (`staffId`) REFERENCES `staff` (`staffId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff_salary`
--

LOCK TABLES `staff_salary` WRITE;
/*!40000 ALTER TABLE `staff_salary` DISABLE KEYS */;
/*!40000 ALTER TABLE `staff_salary` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-03-30  4:42:06
