-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: cravelab
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

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
-- Table structure for table `addresses`
--

DROP TABLE IF EXISTS `addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `userId` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `homeAddress` varchar(255) DEFAULT NULL,
  `additionalInformation` text DEFAULT NULL,
  `defaultAddress` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `addresses`
--

/*!40000 ALTER TABLE `addresses` DISABLE KEYS */;
INSERT INTO `addresses` VALUES (2,'2','kogi','ggt','ogbe strt','sure',NULL),(3,'1','delta','asaba','okpanam road','close to palace','false'),(4,'1','lagos','ikeja','ikorodu','yes my guy','true'),(5,'11','chicago','dc','no 4 wall street','just a chill guy','true');
/*!40000 ALTER TABLE `addresses` ENABLE KEYS */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'admin','admin@gmail.com','admin'),(2,'test','joj573466@gmail.com','admin');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'all'),(2,'snacks'),(3,'drinks');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

--
-- Table structure for table `feedbacks`
--

DROP TABLE IF EXISTS `feedbacks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feedbacks` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `create_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Create Time',
  `ProductId` int(11) NOT NULL COMMENT 'user review of the product',
  `message` varchar(255) NOT NULL COMMENT 'user feed back message',
  `senderName` varchar(255) DEFAULT 'user',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedbacks`
--

/*!40000 ALTER TABLE `feedbacks` DISABLE KEYS */;
INSERT INTO `feedbacks` VALUES (1,'2025-07-13 11:38:41',12,'nice food','Jovis'),(2,'2025-07-13 18:35:44',9,'so tasty and fresh','Jovis'),(4,'2025-07-13 11:41:00',10,'crunchy ','Jovis'),(5,'2025-07-14 09:09:06',10,'E nor sweet','Jovis'),(6,'2025-07-16 09:13:30',15,'tasty','Jovis'),(8,'2025-08-04 11:03:30',16,'Very nice and satisfying','jovisco');
/*!40000 ALTER TABLE `feedbacks` ENABLE KEYS */;

--
-- Table structure for table `orderitems`
--

DROP TABLE IF EXISTS `orderitems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orderitems` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `orderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orderitems`
--

/*!40000 ALTER TABLE `orderitems` DISABLE KEYS */;
INSERT INTO `orderitems` VALUES (17,18,12,2,3000.00),(18,18,15,2,500.00),(19,19,14,1,6000.00),(20,2,14,1,6000.00),(21,3,10,2,2000.00),(22,4,10,2,2000.00),(23,4,14,1,6000.00),(24,5,10,2,2000.00),(25,5,12,1,3000.00),(26,5,13,1,2000.00),(27,5,14,1,6000.00),(28,6,10,3,2000.00),(29,6,12,1,3000.00),(30,6,14,6,6000.00),(31,7,10,4,2000.00),(32,7,12,2,3000.00),(33,7,13,5,2000.00),(34,7,14,7,6000.00),(35,8,12,3,3000.00);
/*!40000 ALTER TABLE `orderitems` ENABLE KEYS */;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `userId` int(11) NOT NULL,
  `addressId` int(11) NOT NULL,
  `orderLabel` varchar(50) NOT NULL,
  `orderDate` date NOT NULL DEFAULT curdate(),
  `status` varchar(50) NOT NULL DEFAULT 'pending',
  `totalPrice` decimal(10,2) NOT NULL,
  `paymentMethod` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (3,1,4,'ID23091','2025-07-31','successful',4400.00,'1'),(4,11,5,'ID191411','2025-07-31','successful',11000.00,'2'),(5,11,5,'ID282011','2025-08-01','successful',16500.00,'1'),(6,1,4,'ID19551','2025-08-04','successful',49500.00,'1'),(7,1,4,'ID55021','2025-08-04','successful',72600.00,'2'),(8,1,4,'ID06181','2025-08-04','successful',9900.00,'1');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;

--
-- Table structure for table `paymentmethods`
--

DROP TABLE IF EXISTS `paymentmethods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `paymentmethods` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `name` varchar(50) NOT NULL,
  `accountName` varchar(255) NOT NULL,
  `accountNo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paymentmethods`
--

/*!40000 ALTER TABLE `paymentmethods` DISABLE KEYS */;
INSERT INTO `paymentmethods` VALUES (1,'opay','Jovinci','9075020441'),(2,'palmpay','Onyekachukwu Jovis','9135199045');
/*!40000 ALTER TABLE `paymentmethods` ENABLE KEYS */;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `orderId` int(11) NOT NULL,
  `imageUrl` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
INSERT INTO `payments` VALUES (7,3,'uploads/payments/testingpic1753968311.jpeg'),(8,4,'uploads/payments/5b40f46ba6f11c585aa7e4507e17efa51753971587.jpeg'),(9,5,'uploads/payments/b29d251f5388fe43d8b33b7f1508094b1754040532.jpeg'),(10,6,'uploads/payments/bfbe7f00bc40cbb272296043f5dac4051754299223.jpeg'),(11,7,'uploads/payments/5b40f46ba6f11c585aa7e4507e17efa51754301322.jpeg'),(12,8,'uploads/payments/5b40f46ba6f11c585aa7e4507e17efa51754305610.jpeg');
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `create_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Create Time',
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_available` tinyint(1) DEFAULT 1,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `categoryId` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (10,'2025-07-11 22:02:56','sharwama','Savor the rich taste of our Classic Chicken Shawarma Wrap—tender, spice-marinated chicken slices, slow-roasted to perfection and wrapped in soft flatbread. Filled with crisp lettuce, fresh tomatoes, pickles, and drizzled with creamy garlic sauce, this shawarma delivers bold flavor in every bite. Perfect for a quick meal or satisfying snack.',2000.00,'uploads/products/food21752271376.jpeg',1,'2025-07-11 22:02:56','2'),(12,'2025-07-29 21:42:38','meatpie','enjoy the satisfactory taste in every bite',3000.00,'uploads/products/food41753825358.jpeg',1,'2025-07-29 21:42:38','2'),(14,'2025-07-14 10:08:00','papaya rice','rice way dey clear eye',6000.00,'uploads/products/food21752487680.jpeg',1,'2025-07-14 10:08:00','1'),(15,'2025-07-14 10:08:37','eggroll','enjoy the satisfactory taste in every bite',500.00,'uploads/products/donut1752487717.jpeg',1,'2025-07-14 10:08:37','2'),(16,'2025-08-04 11:01:56','Rice','Fried Rice with sauce flavoured turkey',20000.00,'uploads/products/food31754305316.jpeg',1,'2025-08-04 11:01:56','1');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `create_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Create Time',
  `name` varchar(255) NOT NULL,
  `phoneNo` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'2025-07-19 20:43:27','jovisco','09075020441','joj573466@gmail.com','12345'),(2,'2025-07-09 21:29:15','jojo','09075020441','jovis@gmail.com','12345'),(11,'2025-07-19 20:21:19','reuben','09075020441','joj573466@gmail.com222','NWACHUKWU1');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

--
-- Dumping routines for database 'cravelab'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-08-04 21:19:27
