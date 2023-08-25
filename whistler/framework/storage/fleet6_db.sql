-- MySQL dump 10.19  Distrib 10.3.32-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: f6
-- ------------------------------------------------------
-- Server version	10.3.32-MariaDB-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
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
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `addresses_customer_id_index` (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `addresses`
--

LOCK TABLES `addresses` WRITE;
/*!40000 ALTER TABLE `addresses` DISABLE KEYS */;
/*!40000 ALTER TABLE `addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `api_settings`
--

DROP TABLE IF EXISTS `api_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `api_settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `key_value` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `api_settings_key_name_index` (`key_name`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `api_settings`
--

LOCK TABLES `api_settings` WRITE;
/*!40000 ALTER TABLE `api_settings` DISABLE KEYS */;
INSERT INTO `api_settings` VALUES (1,'api','1','2021-11-20 07:03:58','2021-11-20 07:03:58',NULL),(2,'anyone_register','0','2021-11-20 07:03:58','2021-11-20 07:03:58',NULL),(3,'region_availability','region one, region two, region three','2021-11-20 07:03:58','2021-11-20 07:03:58',NULL),(4,'driver_review','0','2021-11-20 07:03:58','2021-11-20 07:03:58',NULL),(5,'booking','3','2021-11-20 07:03:58','2021-11-20 07:03:58',NULL),(6,'cancel','2','2021-11-20 07:03:58','2021-11-20 07:03:58',NULL),(7,'max_trip','1','2021-11-20 07:03:58','2021-11-20 07:03:58',NULL),(8,'api_key','','2021-11-20 07:03:58','2021-11-20 07:03:58',NULL),(9,'db_url','','2021-11-20 07:03:58','2021-11-20 07:03:58',NULL),(10,'db_secret','','2021-11-20 07:03:58','2021-11-20 07:03:58',NULL),(11,'server_key','','2021-11-20 07:03:58','2021-11-20 07:03:58',NULL),(12,'google_api','0','2021-11-20 07:03:58','2021-11-20 07:03:58',NULL);
/*!40000 ALTER TABLE `api_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `booking_income`
--

DROP TABLE IF EXISTS `booking_income`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `booking_income` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` int(11) DEFAULT NULL,
  `income_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `booking_income_booking_id_income_id_index` (`booking_id`,`income_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking_income`
--

LOCK TABLES `booking_income` WRITE;
/*!40000 ALTER TABLE `booking_income` DISABLE KEYS */;
INSERT INTO `booking_income` VALUES (1,1,3,'2021-11-20 07:03:51','2021-11-20 07:03:51',NULL);
/*!40000 ALTER TABLE `booking_income` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `booking_payments`
--

DROP TABLE IF EXISTS `booking_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `booking_payments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` int(11) DEFAULT NULL,
  `method` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` double NOT NULL,
  `payment_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_details` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking_payments`
--

LOCK TABLES `booking_payments` WRITE;
/*!40000 ALTER TABLE `booking_payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `booking_payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `booking_quotation`
--

DROP TABLE IF EXISTS `booking_quotation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `booking_quotation` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `pickup` timestamp NULL DEFAULT NULL,
  `dropoff` timestamp NULL DEFAULT NULL,
  `pickup_addr` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dest_addr` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `travellers` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL DEFAULT 0,
  `payment` int(11) NOT NULL DEFAULT 0,
  `day` int(11) DEFAULT NULL,
  `mileage` double DEFAULT NULL,
  `waiting_time` int(11) DEFAULT NULL,
  `total` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `tax_total` double(10,2) DEFAULT NULL,
  `total_tax_percent` double(10,2) DEFAULT NULL,
  `total_tax_charge_rs` double(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `booking_quotation_customer_id_user_id_vehicle_id_driver_id_index` (`customer_id`,`user_id`,`vehicle_id`,`driver_id`),
  KEY `booking_quotation_status_payment_index` (`status`,`payment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking_quotation`
--

LOCK TABLES `booking_quotation` WRITE;
/*!40000 ALTER TABLE `booking_quotation` DISABLE KEYS */;
/*!40000 ALTER TABLE `booking_quotation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bookings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `pickup` timestamp NULL DEFAULT NULL,
  `dropoff` timestamp NULL DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `pickup_addr` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dest_addr` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `travellers` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL DEFAULT 0,
  `payment` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bookings_customer_id_driver_id_vehicle_id_user_id_index` (`customer_id`,`driver_id`,`vehicle_id`,`user_id`),
  KEY `bookings_payment_status_index` (`payment`,`status`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookings`
--

LOCK TABLES `bookings` WRITE;
/*!40000 ALTER TABLE `bookings` DISABLE KEYS */;
INSERT INTO `bookings` VALUES (1,4,1,1,6,'2021-11-09 23:29:07','2021-11-10 10:26:56',2880,'368 Matilda Landing Apt. 901\nProhaskatown, SD 24803','887 Sabina Parkway\nNorth Robbie, GA 83557-9858','sample note',2,1,1,'2021-11-20 07:03:41','2021-11-20 07:03:51',NULL),(2,5,1,1,7,'2021-10-26 07:53:04','2021-10-27 10:42:16',2880,'28114 Bernhard Springs\nMcDermottberg, GA 86108','66878 Dora Mountains\nKenyastad, NY 63820','sample note',3,0,0,'2021-11-20 07:03:41','2021-11-20 07:03:41',NULL);
/*!40000 ALTER TABLE `bookings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bookings_meta`
--

DROP TABLE IF EXISTS `bookings_meta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bookings_meta` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` int(10) unsigned NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'null',
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bookings_meta_booking_id_index` (`booking_id`),
  KEY `bookings_meta_key_index` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookings_meta`
--

LOCK TABLES `bookings_meta` WRITE;
/*!40000 ALTER TABLE `bookings_meta` DISABLE KEYS */;
INSERT INTO `bookings_meta` VALUES (1,1,'integer','tax_total','500',NULL,'2021-11-20 07:03:51','2021-11-20 07:03:51'),(2,1,'integer','total_tax_percent','0',NULL,'2021-11-20 07:03:51','2021-11-20 07:03:51'),(3,1,'integer','total_tax_charge_rs','0',NULL,'2021-11-20 07:03:51','2021-11-20 07:03:51'),(4,1,'string','ride_status','Completed',NULL,'2021-11-20 07:03:52','2021-11-20 07:03:52'),(5,1,'string','journey_date','10-11-2021',NULL,'2021-11-20 07:03:52','2021-11-20 07:03:52'),(6,1,'string','journey_time','04:59:07',NULL,'2021-11-20 07:03:52','2021-11-20 07:03:52'),(7,1,'integer','customerid','4',NULL,'2021-11-20 07:03:52','2021-11-20 07:03:52'),(8,1,'integer','vehicleid','1',NULL,'2021-11-20 07:03:52','2021-11-20 07:03:52'),(9,1,'integer','day','1',NULL,'2021-11-20 07:03:52','2021-11-20 07:03:52'),(10,1,'integer','mileage','10',NULL,'2021-11-20 07:03:52','2021-11-20 07:03:52'),(11,1,'integer','waiting_time','0',NULL,'2021-11-20 07:03:52','2021-11-20 07:03:52'),(12,1,'string','date','2021-11-20',NULL,'2021-11-20 07:03:52','2021-11-20 07:03:52'),(13,1,'integer','total','500',NULL,'2021-11-20 07:03:52','2021-11-20 07:03:52'),(14,1,'integer','receipt','1',NULL,'2021-11-20 07:03:52','2021-11-20 07:03:52'),(15,2,'string','ride_status','Upcoming',NULL,'2021-11-20 07:03:52','2021-11-20 07:03:52'),(16,2,'string','journey_date','26-10-2021',NULL,'2021-11-20 07:03:52','2021-11-20 07:03:52'),(17,2,'string','journey_time','13:23:04',NULL,'2021-11-20 07:03:52','2021-11-20 07:03:52');
/*!40000 ALTER TABLE `bookings_meta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat_settings`
--

DROP TABLE IF EXISTS `chat_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chat_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat_settings`
--

LOCK TABLES `chat_settings` WRITE;
/*!40000 ALTER TABLE `chat_settings` DISABLE KEYS */;
INSERT INTO `chat_settings` VALUES (1,'pusher_app_id','','2022-01-23 23:35:30','2022-01-24 00:02:32',NULL),(2,'pusher_app_key','','2022-01-23 23:35:30','2022-01-24 00:02:32',NULL),(3,'pusher_app_secret','','2022-01-23 23:35:30','2022-01-24 00:02:32',NULL),(4,'pusher_app_cluster','','2022-01-23 23:35:30','2022-01-24 00:02:32',NULL);
/*!40000 ALTER TABLE `chat_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_services`
--

DROP TABLE IF EXISTS `company_services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company_services` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_services`
--

LOCK TABLES `company_services` WRITE;
/*!40000 ALTER TABLE `company_services` DISABLE KEYS */;
INSERT INTO `company_services` VALUES (1,'Best price guranteed','fleet-bestprice.png','Lorem ipsum dolor sit amet, consectetur adipisicing elit.Neque at, nobis repudiandae dolores.',NULL,'2021-11-20 07:03:45','2021-11-20 07:03:45'),(2,'24/7 Customer care','fleet-care.png','Lorem ipsum dolor sit amet, consectetur adipisicing elit.Neque at, nobis repudiandae dolores.',NULL,'2021-11-20 07:03:45','2021-11-20 07:03:45'),(3,'Home pickups','fleet-homepickup.png','Lorem ipsum dolor sit amet, consectetur adipisicing elit.Neque at, nobis repudiandae dolores.',NULL,'2021-11-20 07:03:45','2021-11-20 07:03:45'),(4,'Easy Bookings','fleet-easybooking.png','Lorem ipsum dolor sit amet, consectetur adipisicing elit.Neque at, nobis repudiandae dolores.',NULL,'2021-11-20 07:03:45','2021-11-20 07:03:45');
/*!40000 ALTER TABLE `company_services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `driver_logs`
--

DROP TABLE IF EXISTS `driver_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `driver_logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `driver_logs_driver_id_vehicle_id_index` (`driver_id`,`vehicle_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `driver_logs`
--

LOCK TABLES `driver_logs` WRITE;
/*!40000 ALTER TABLE `driver_logs` DISABLE KEYS */;
INSERT INTO `driver_logs` VALUES (1,1,6,'2021-11-20 07:03:53','2021-11-20 07:03:53','2021-11-20 07:03:53'),(2,2,8,'2021-11-22 23:02:01','2021-11-22 23:02:01','2021-11-22 23:02:01');
/*!40000 ALTER TABLE `driver_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `driver_vehicle`
--

DROP TABLE IF EXISTS `driver_vehicle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `driver_vehicle` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(11) DEFAULT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `driver_vehicle_driver_id_vehicle_id_index` (`driver_id`,`vehicle_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `driver_vehicle`
--

LOCK TABLES `driver_vehicle` WRITE;
/*!40000 ALTER TABLE `driver_vehicle` DISABLE KEYS */;
INSERT INTO `driver_vehicle` VALUES (1,1,6,'2021-11-20 07:03:53','2021-11-20 07:03:53'),(2,2,8,'2021-11-22 23:02:01','2021-11-22 23:02:01');
/*!40000 ALTER TABLE `driver_vehicle` ENABLE KEYS */;
UNLOCK TABLES;

-- --------------------------------------------------------

-- --
-- -- Table structure for table `driver_payments`
-- --

DROP TABLE IF EXISTS `driver_payments`;

CREATE TABLE `driver_payments` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `driver_id` int(11) NOT NULL,
  `amount` double(10,2) NOT NULL DEFAULT 0.00,
  `notes` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `driver_payments_driver_id_user_id_index` (`driver_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Table structure for table `email_content`
--

DROP TABLE IF EXISTS `email_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `email_content` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `email_content_key_index` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_content`
--

LOCK TABLES `email_content` WRITE;
/*!40000 ALTER TABLE `email_content` DISABLE KEYS */;
INSERT INTO `email_content` VALUES (1,'insurance','vehicle insurance email content','2021-11-20 07:04:07','2021-11-20 07:04:07',NULL),(2,'vehicle_licence','vehicle licence email content','2021-11-20 07:04:07','2021-11-20 07:04:07',NULL),(3,'driving_licence','driving licence email content','2021-11-20 07:04:07','2021-11-20 07:04:07',NULL),(4,'registration','vehicle registration email content','2021-11-20 07:04:07','2021-11-20 07:04:07',NULL),(5,'service_reminder','service reminder email content','2021-11-20 07:04:07','2021-11-20 07:04:07',NULL),(6,'users','','2021-11-20 07:04:07','2021-11-20 07:04:07',NULL),(7,'options','','2021-11-20 07:04:07','2021-11-20 07:04:07',NULL),(8,'email','0','2021-11-20 07:04:07','2021-11-20 07:04:07',NULL);
/*!40000 ALTER TABLE `email_content` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expense`
--

DROP TABLE IF EXISTS `expense`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expense` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(11) DEFAULT NULL,
  `exp_id` int(11) DEFAULT NULL,
  `type` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'e',
  `amount` double(10,2) NOT NULL DEFAULT 0.00,
  `driver_amount` double(10,2) NULL,
  `user_id` int(11) DEFAULT NULL,
  `expense_type` int(11) DEFAULT NULL,
  `comment` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `expense_vehicle_id_exp_id_user_id_expense_type_index` (`vehicle_id`,`exp_id`,`user_id`,`expense_type`),
  KEY `expense_type_index` (`type`),
  KEY `expense_date_index` (`date`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expense`
--

LOCK TABLES `expense` WRITE;
/*!40000 ALTER TABLE `expense` DISABLE KEYS */;
INSERT INTO `expense` VALUES (1,1,NULL,'e',1763.00,0.00,2,1,'Sample Comment','2021-11-19','2021-11-20 07:03:50','2021-11-20 07:03:50',NULL,NULL),(2,2,NULL,'e',1312.00,0.00,3,4,'Sample Comment','2021-11-15','2021-11-20 07:03:51','2021-11-20 07:03:51',NULL,NULL),(3,1,1,'e',500.00,0.00,2,8,'Sample Comment','2021-11-18','2021-11-20 07:03:53','2021-11-20 07:03:53',NULL,NULL),(4,1,2,'e',500.00,0.00,2,8,'Sample Comment','2021-11-30','2021-11-20 07:03:53','2021-11-20 07:03:53',NULL,NULL);
/*!40000 ALTER TABLE `expense` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expense_cat`
--

DROP TABLE IF EXISTS `expense_cat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expense_cat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `type` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `expense_cat_name_type_index` (`name`,`type`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expense_cat`
--

LOCK TABLES `expense_cat` WRITE;
/*!40000 ALTER TABLE `expense_cat` DISABLE KEYS */;
INSERT INTO `expense_cat` VALUES (1,'Insurance',1,'d','2021-11-20 07:03:54','2021-11-20 07:03:54',NULL),(2,'Patente',1,'d','2021-11-20 07:03:54','2021-11-20 07:03:54',NULL),(3,'Mechanics',1,'d','2021-11-20 07:03:55','2021-11-20 07:03:55',NULL),(4,'Car wash',1,'d','2021-11-20 07:03:55','2021-11-20 07:03:55',NULL),(5,'Vignette',1,'d','2021-11-20 07:03:55','2021-11-20 07:03:55',NULL),(6,'Maintenance',1,'d','2021-11-20 07:03:55','2021-11-20 07:03:55',NULL),(7,'Parking',1,'d','2021-11-20 07:03:55','2021-11-20 07:03:55',NULL),(8,'Fuel',1,'d','2021-11-20 07:03:55','2021-11-20 07:03:55',NULL),(9,'Car Services',1,'d','2021-11-20 07:03:55','2021-11-20 07:03:55',NULL);
/*!40000 ALTER TABLE `expense_cat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fare_settings`
--

DROP TABLE IF EXISTS `fare_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fare_settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `key_value` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fare_settings_key_name_index` (`key_name`),
  KEY `fare_settings_type_id_index` (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fare_settings`
--

LOCK TABLES `fare_settings` WRITE;
/*!40000 ALTER TABLE `fare_settings` DISABLE KEYS */;
INSERT INTO `fare_settings` VALUES (1,'hatchback_base_fare','500','2021-11-20 07:03:59','2021-11-20 07:03:59',NULL,1),(2,'hatchback_base_km','10','2021-11-20 07:03:59','2021-11-20 07:03:59',NULL,1),(3,'hatchback_base_time','2','2021-11-20 07:03:59','2021-11-20 07:03:59',NULL,1),(4,'hatchback_std_fare','20','2021-11-20 07:03:59','2021-11-20 07:03:59',NULL,1),(5,'hatchback_weekend_base_fare','500','2021-11-20 07:03:59','2021-11-20 07:03:59',NULL,1),(6,'hatchback_weekend_base_km','10','2021-11-20 07:03:59','2021-11-20 07:03:59',NULL,1),(7,'hatchback_weekend_wait_time','2','2021-11-20 07:03:59','2021-11-20 07:03:59',NULL,1),(8,'hatchback_weekend_std_fare','20','2021-11-20 07:04:00','2021-11-20 07:04:00',NULL,1),(9,'hatchback_night_base_fare','500','2021-11-20 07:04:00','2021-11-20 07:04:00',NULL,1),(10,'hatchback_night_base_km','10','2021-11-20 07:04:00','2021-11-20 07:04:00',NULL,1),(11,'hatchback_night_wait_time','2','2021-11-20 07:04:00','2021-11-20 07:04:00',NULL,1),(12,'hatchback_night_std_fare','20','2021-11-20 07:04:00','2021-11-20 07:04:00',NULL,1),(13,'sedan_base_fare','500','2021-11-20 07:04:00','2021-11-20 07:04:00',NULL,2),(14,'sedan_base_km','10','2021-11-20 07:04:00','2021-11-20 07:04:00',NULL,2),(15,'sedan_base_time','2','2021-11-20 07:04:00','2021-11-20 07:04:00',NULL,2),(16,'sedan_std_fare','20','2021-11-20 07:04:01','2021-11-20 07:04:01',NULL,2),(17,'sedan_weekend_base_fare','500','2021-11-20 07:04:01','2021-11-20 07:04:01',NULL,2),(18,'sedan_weekend_base_km','10','2021-11-20 07:04:01','2021-11-20 07:04:01',NULL,2),(19,'sedan_weekend_wait_time','2','2021-11-20 07:04:01','2021-11-20 07:04:01',NULL,2),(20,'sedan_weekend_std_fare','20','2021-11-20 07:04:01','2021-11-20 07:04:01',NULL,2),(21,'sedan_night_base_fare','500','2021-11-20 07:04:01','2021-11-20 07:04:01',NULL,2),(22,'sedan_night_base_km','10','2021-11-20 07:04:01','2021-11-20 07:04:01',NULL,2),(23,'sedan_night_wait_time','2','2021-11-20 07:04:01','2021-11-20 07:04:01',NULL,2),(24,'sedan_night_std_fare','20','2021-11-20 07:04:02','2021-11-20 07:04:02',NULL,2),(25,'minivan_base_fare','500','2021-11-20 07:04:02','2021-11-20 07:04:02',NULL,3),(26,'minivan_base_km','10','2021-11-20 07:04:02','2021-11-20 07:04:02',NULL,3),(27,'minivan_base_time','2','2021-11-20 07:04:02','2021-11-20 07:04:02',NULL,3),(28,'minivan_std_fare','20','2021-11-20 07:04:02','2021-11-20 07:04:02',NULL,3),(29,'minivan_weekend_base_fare','500','2021-11-20 07:04:03','2021-11-20 07:04:03',NULL,3),(30,'minivan_weekend_base_km','10','2021-11-20 07:04:03','2021-11-20 07:04:03',NULL,3),(31,'minivan_weekend_wait_time','2','2021-11-20 07:04:03','2021-11-20 07:04:03',NULL,3),(32,'minivan_weekend_std_fare','20','2021-11-20 07:04:03','2021-11-20 07:04:03',NULL,3),(33,'minivan_night_base_fare','500','2021-11-20 07:04:03','2021-11-20 07:04:03',NULL,3),(34,'minivan_night_base_km','10','2021-11-20 07:04:03','2021-11-20 07:04:03',NULL,3),(35,'minivan_night_wait_time','2','2021-11-20 07:04:03','2021-11-20 07:04:03',NULL,3),(36,'minivan_night_std_fare','20','2021-11-20 07:04:03','2021-11-20 07:04:03',NULL,3),(37,'saloon_base_fare','500','2021-11-20 07:04:03','2021-11-20 07:04:03',NULL,4),(38,'saloon_base_km','10','2021-11-20 07:04:03','2021-11-20 07:04:03',NULL,4),(39,'saloon_base_time','2','2021-11-20 07:04:04','2021-11-20 07:04:04',NULL,4),(40,'saloon_std_fare','20','2021-11-20 07:04:04','2021-11-20 07:04:04',NULL,4),(41,'saloon_weekend_base_fare','500','2021-11-20 07:04:04','2021-11-20 07:04:04',NULL,4),(42,'saloon_weekend_base_km','10','2021-11-20 07:04:04','2021-11-20 07:04:04',NULL,4),(43,'saloon_weekend_wait_time','2','2021-11-20 07:04:04','2021-11-20 07:04:04',NULL,4),(44,'saloon_weekend_std_fare','20','2021-11-20 07:04:04','2021-11-20 07:04:04',NULL,4),(45,'saloon_night_base_fare','500','2021-11-20 07:04:04','2021-11-20 07:04:04',NULL,4),(46,'saloon_night_base_km','10','2021-11-20 07:04:04','2021-11-20 07:04:04',NULL,4),(47,'saloon_night_wait_time','2','2021-11-20 07:04:04','2021-11-20 07:04:04',NULL,4),(48,'saloon_night_std_fare','20','2021-11-20 07:04:04','2021-11-20 07:04:04',NULL,4),(49,'suv_base_fare','500','2021-11-20 07:04:04','2021-11-20 07:04:04',NULL,5),(50,'suv_base_km','10','2021-11-20 07:04:04','2021-11-20 07:04:04',NULL,5),(51,'suv_base_time','2','2021-11-20 07:04:04','2021-11-20 07:04:04',NULL,5),(52,'suv_std_fare','20','2021-11-20 07:04:04','2021-11-20 07:04:04',NULL,5),(53,'suv_weekend_base_fare','500','2021-11-20 07:04:04','2021-11-20 07:04:04',NULL,5),(54,'suv_weekend_base_km','10','2021-11-20 07:04:05','2021-11-20 07:04:05',NULL,5),(55,'suv_weekend_wait_time','2','2021-11-20 07:04:05','2021-11-20 07:04:05',NULL,5),(56,'suv_weekend_std_fare','20','2021-11-20 07:04:05','2021-11-20 07:04:05',NULL,5),(57,'suv_night_base_fare','500','2021-11-20 07:04:05','2021-11-20 07:04:05',NULL,5),(58,'suv_night_base_km','10','2021-11-20 07:04:05','2021-11-20 07:04:05',NULL,5),(59,'suv_night_wait_time','2','2021-11-20 07:04:05','2021-11-20 07:04:05',NULL,5),(60,'suv_night_std_fare','20','2021-11-20 07:04:05','2021-11-20 07:04:05',NULL,5),(61,'bus_base_fare','500','2021-11-20 07:04:05','2021-11-20 07:04:05',NULL,6),(62,'bus_base_km','10','2021-11-20 07:04:05','2021-11-20 07:04:05',NULL,6),(63,'bus_base_time','2','2021-11-20 07:04:05','2021-11-20 07:04:05',NULL,6),(64,'bus_std_fare','20','2021-11-20 07:04:05','2021-11-20 07:04:05',NULL,6),(65,'bus_weekend_base_fare','500','2021-11-20 07:04:05','2021-11-20 07:04:05',NULL,6),(66,'bus_weekend_base_km','10','2021-11-20 07:04:05','2021-11-20 07:04:05',NULL,6),(67,'bus_weekend_wait_time','2','2021-11-20 07:04:05','2021-11-20 07:04:05',NULL,6),(68,'bus_weekend_std_fare','20','2021-11-20 07:04:05','2021-11-20 07:04:05',NULL,6),(69,'bus_night_base_fare','500','2021-11-20 07:04:05','2021-11-20 07:04:05',NULL,6),(70,'bus_night_base_km','10','2021-11-20 07:04:05','2021-11-20 07:04:05',NULL,6),(71,'bus_night_wait_time','2','2021-11-20 07:04:05','2021-11-20 07:04:05',NULL,6),(72,'bus_night_std_fare','20','2021-11-20 07:04:05','2021-11-20 07:04:05',NULL,6),(73,'truck_base_fare','500','2021-11-20 07:04:06','2021-11-20 07:04:06',NULL,7),(74,'truck_base_km','10','2021-11-20 07:04:06','2021-11-20 07:04:06',NULL,7),(75,'truck_base_time','2','2021-11-20 07:04:06','2021-11-20 07:04:06',NULL,7),(76,'truck_std_fare','20','2021-11-20 07:04:06','2021-11-20 07:04:06',NULL,7),(77,'truck_weekend_base_fare','500','2021-11-20 07:04:06','2021-11-20 07:04:06',NULL,7),(78,'truck_weekend_base_km','10','2021-11-20 07:04:06','2021-11-20 07:04:06',NULL,7),(79,'truck_weekend_wait_time','2','2021-11-20 07:04:06','2021-11-20 07:04:06',NULL,7),(80,'truck_weekend_std_fare','20','2021-11-20 07:04:06','2021-11-20 07:04:06',NULL,7),(81,'truck_night_base_fare','500','2021-11-20 07:04:06','2021-11-20 07:04:06',NULL,7),(82,'truck_night_base_km','10','2021-11-20 07:04:06','2021-11-20 07:04:06',NULL,7),(83,'truck_night_wait_time','2','2021-11-20 07:04:06','2021-11-20 07:04:06',NULL,7),(84,'truck_night_std_fare','20','2021-11-20 07:04:06','2021-11-20 07:04:06',NULL,7);
/*!40000 ALTER TABLE `fare_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `frontend`
--

DROP TABLE IF EXISTS `frontend`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `frontend` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `key_value` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `frontend_key_name_index` (`key_name`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `frontend`
--

LOCK TABLES `frontend` WRITE;
/*!40000 ALTER TABLE `frontend` DISABLE KEYS */;
INSERT INTO `frontend` VALUES (1,'about_us','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.','2021-11-20 07:04:08','2021-11-20 07:04:08',NULL),(2,'contact_email','master@admin.com','2021-11-20 07:04:08','2021-11-20 07:04:08',NULL),(3,'contact_phone','0123456789','2021-11-20 07:04:08','2021-11-20 07:04:08',NULL),(4,'customer_support','0999988888','2021-11-20 07:04:08','2021-11-20 07:04:08',NULL),(5,'about_description','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.','2021-11-20 07:04:08','2021-11-20 07:04:08',NULL),(6,'about_title','Proudly serving you','2021-11-20 07:04:08','2021-11-20 07:04:08',NULL),(7,'facebook',NULL,'2021-11-20 07:04:08','2021-11-20 07:04:08',NULL),(8,'twitter',NULL,'2021-11-20 07:04:08','2021-11-20 07:04:08',NULL),(9,'instagram',NULL,'2021-11-20 07:04:08','2021-11-20 07:04:08',NULL),(10,'linkedin',NULL,'2021-11-20 07:04:08','2021-11-20 07:04:08',NULL),(11,'faq_link',NULL,'2021-11-20 07:04:08','2021-11-20 07:04:08',NULL),(12,'cities','5','2021-11-20 07:04:08','2021-11-20 07:04:08',NULL),(13,'vehicles','10','2021-11-20 07:04:08','2021-11-20 07:04:08',NULL),(14,'cancellation',NULL,'2021-11-20 07:04:08','2021-11-20 07:04:08',NULL),(15,'terms',NULL,'2021-11-20 07:04:09','2021-11-20 07:04:09',NULL),(16,'privacy_policy',NULL,'2021-11-20 07:04:09','2021-11-20 07:04:09',NULL),(17,'enable','1','2021-11-20 07:04:09','2021-11-20 07:04:09',NULL),(18,'language','English-en','2021-11-20 07:04:09','2021-11-20 07:04:09',NULL),(19,'admin_approval','1','2021-11-20 07:04:09','2021-11-20 07:04:09',NULL),(20,'booking_time','1','2022-01-05 16:00:09','2022-01-05 16:00:09',NULL);
/*!40000 ALTER TABLE `frontend` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fuel`
--

DROP TABLE IF EXISTS `fuel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fuel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `start_meter` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `end_meter` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reference` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `province` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `vendor_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qty` double(10,2) DEFAULT NULL,
  `fuel_from` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cost_per_unit` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `consumption` int(11) DEFAULT NULL,
  `complete` int(11) DEFAULT 0,
  `date` date DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fuel_vehicle_id_user_id_index` (`vehicle_id`,`user_id`),
  KEY `fuel_date_index` (`date`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fuel`
--

LOCK TABLES `fuel` WRITE;
/*!40000 ALTER TABLE `fuel` DISABLE KEYS */;
INSERT INTO `fuel` VALUES (1,1,2,'1000','2000',NULL,'Gujarat','sample note',NULL,10,'Fuel Tank','50',100,0,'2021-11-18',NULL,'2021-11-20 07:03:53','2021-11-20 07:03:53',NULL),(2,1,2,'2000','0',NULL,'Gujarat','sample note',NULL,10,'Fuel Tank','50',0,0,'2021-11-30',NULL,'2021-11-20 07:03:53','2021-11-20 07:03:53',NULL);
/*!40000 ALTER TABLE `fuel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `income`
--

DROP TABLE IF EXISTS `income`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `income` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(11) DEFAULT NULL,
  `income_id` int(11) DEFAULT NULL,
  `amount` double(10,2) NOT NULL DEFAULT 0.00,
  `driver_amount` double(10,2) NULL,
  `user_id` int(11) DEFAULT NULL,
  `income_cat` int(11) DEFAULT NULL,
  `mileage` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `tax_percent` double(10,2) DEFAULT NULL,
  `tax_charge_rs` double(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `income_vehicle_id_income_id_user_id_income_cat_index` (`vehicle_id`,`income_id`,`user_id`,`income_cat`),
  KEY `income_date_index` (`date`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `income`
--

LOCK TABLES `income` WRITE;
/*!40000 ALTER TABLE `income` DISABLE KEYS */;
INSERT INTO `income` VALUES (1,1,NULL,4018.00,0.00,2,1,NULL,'2021-11-15','2021-11-20 07:03:50','2021-11-20 07:03:50',NULL,0.00,0.00),(2,2,NULL,3801.00,0.00,3,1,NULL,'2021-11-19','2021-11-20 07:03:51','2021-11-20 07:03:51',NULL,0.00,0.00),(3,1,1,500.00,0.00,1,1,10,'2021-11-20','2021-11-20 07:03:51','2021-11-20 07:03:51',NULL,0.00,0.00);
/*!40000 ALTER TABLE `income` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `income_cat`
--

DROP TABLE IF EXISTS `income_cat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `income_cat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `type` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `income_cat_name_type_index` (`name`,`type`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `income_cat`
--

LOCK TABLES `income_cat` WRITE;
/*!40000 ALTER TABLE `income_cat` DISABLE KEYS */;
INSERT INTO `income_cat` VALUES (1,'Booking',1,'d','2021-11-20 07:03:54','2021-11-20 07:03:54',NULL);
/*!40000 ALTER TABLE `income_cat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mechanics`
--

DROP TABLE IF EXISTS `mechanics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mechanics` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mechanics`
--

LOCK TABLES `mechanics` WRITE;
/*!40000 ALTER TABLE `mechanics` DISABLE KEYS */;
INSERT INTO `mechanics` VALUES (1,1,'Tracy Lakin','connelly.mckenna@example.com','1-350-561-3982 x177','Electrical Engineering',NULL,'2021-11-20 07:04:11','2021-11-20 07:04:11'),(2,1,'Theresa Toy','chris.haley@example.net','734-670-6060','Electrical Engineering',NULL,'2021-11-20 07:04:12','2021-11-20 07:04:12');
/*!40000 ALTER TABLE `mechanics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `message` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fcm_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `message` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message`
--

LOCK TABLES `message` WRITE;
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
/*!40000 ALTER TABLE `message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from_user` int(10) unsigned DEFAULT NULL,
  `to_user` int(10) unsigned DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `from_user` (`from_user`),
  KEY `to_user` (`to_user`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2016_06_01_000001_create_oauth_auth_codes_table',1),(2,'2016_06_01_000002_create_oauth_access_tokens_table',1),(3,'2016_06_01_000003_create_oauth_refresh_tokens_table',1),(4,'2016_06_01_000004_create_oauth_clients_table',1),(5,'2016_06_01_000005_create_oauth_personal_access_clients_table',1),(6,'2017_06_03_134331_create_expense_table',1),(7,'2017_06_03_134332_create_expense_cat_table',1),(8,'2017_06_03_134332_create_income_table',1),(9,'2017_06_03_134333_create_income_cat_table',1),(10,'2017_06_03_134336_create_password_resets_table',1),(11,'2017_06_03_134337_create_users_table',1),(12,'2017_06_03_134338_create_vehicles_table',1),(13,'2017_07_24_080537_create_booking_table',1),(14,'2017_07_24_080643_create_settings_table',1),(15,'2017_08_01_073926_create_booking_income_table',1),(16,'2017_10_30_064357_create_notifications_table',1),(17,'2017_10_30_094858_create_fuel_table',1),(18,'2017_11_09_105729_create_vendors_table',1),(19,'2017_11_10_062609_create_work_orders_table',1),(20,'2017_11_10_095438_create_notes_table',1),(21,'2017_11_22_093559_create_vehicle_group_table',1),(22,'2017_12_28_091600_create_service_items_table',1),(23,'2017_12_28_122952_create_service_reminder_table',1),(24,'2017_12_28_174333_create_api_settings_table',1),(25,'2018_01_08_062105_create_driver_vehicle_table',1),(26,'2018_01_10_130517_users_meta',1),(27,'2018_01_13_050018_bookings_meta',1),(28,'2018_01_16_095657_fare_settings',1),(29,'2018_01_25_050939_create_vehicles_meta_table',1),(30,'2018_02_06_052302_create_message_table',1),(31,'2018_02_06_125252_create_reviews_table',1),(32,'2018_03_13_124424_create_addresses_table',1),(33,'2018_03_28_085735_create_reasons_table',1),(34,'2018_04_28_073004_create_email_content_table',1),(35,'2018_08_14_061757_create_vehicle_review_table',1),(36,'2019_01_18_063916_add_vendor_id_to_expense',1),(37,'2019_01_19_080738_add_udf_to_vendors',1),(38,'2019_01_19_103826_create_parts_table',1),(39,'2019_01_19_110823_create_vehicle_types_table',1),(40,'2019_01_22_101948_create_driver_logs_table',1),(41,'2019_01_23_113852_add_type_id_to_vehicles_table',1),(42,'2019_01_24_095115_add_type_id_to_fare_settings_table',1),(43,'2019_04_12_092111_create_parts_category_table',1),(44,'2019_04_19_053314_create_work_order_logs_table',1),(45,'2019_05_13_062039_create_push_notification_table',1),(46,'2019_07_18_110031_add_column_to_vendors',1),(47,'2019_07_31_082514_create_testimonials_table',1),(48,'2019_07_31_102801_create_frontend_table',1),(49,'2019_08_01_045837_add_columns_to_message_table',1),(50,'2019_08_19_101509_create_booking_quotation_table',1),(51,'2019_08_22_052138_create_parts_used_table',1),(52,'2019_08_22_113138_add_parts_price_to_work_order_logs_table',1),(53,'2019_08_29_104613_create_company_services_table',1),(54,'2019_09_16_085700_create_teams_table',1),(55,'2019_12_10_083547_add_columns_to_booking_quotation_table',1),(56,'2019_12_16_064152_add_indexes_to_users_table',1),(57,'2019_12_16_064951_add_indexes_to_addresses_table',1),(58,'2019_12_16_065511_add_indexes_to_bookings_table',1),(59,'2019_12_16_083315_add_indexes_to_booking_income_table',1),(60,'2019_12_16_084539_add_indexes_to_booking_quotation_table',1),(61,'2019_12_16_085312_add_indexes_to_driver_logs_table',1),(62,'2019_12_16_085505_add_indexes_to_driver_vehicle_table',1),(63,'2019_12_16_091010_add_indexes_to_email_content_table',1),(64,'2019_12_16_091713_add_indexes_to_expense_table',1),(65,'2019_12_16_094305_add_indexes_to_expense_cat_table',1),(66,'2019_12_16_094651_add_indexes_to_fare_settings_table',1),(67,'2019_12_16_095024_add_indexes_to_frontend_table',1),(68,'2019_12_16_095339_add_indexes_to_fuel_table',1),(69,'2019_12_16_095634_add_indexes_to_income_table',1),(70,'2019_12_16_095953_add_indexes_to_income_cat_table',1),(71,'2019_12_16_100221_add_indexes_to_notes_table',1),(72,'2019_12_16_100437_add_indexes_to_notifications_table',1),(73,'2019_12_16_100545_add_indexes_to_parts_table',1),(74,'2019_12_16_101113_add_indexes_to_parts_used_table',1),(75,'2019_12_16_101540_add_indexes_to_push_notification_table',1),(76,'2019_12_16_101851_add_indexes_to_reviews_table',1),(77,'2019_12_16_102259_add_indexes_to_service_reminder_table',1),(78,'2019_12_16_102555_add_indexes_to_vehicles_table',1),(79,'2019_12_16_104209_add_indexes_to_vehicle_review_table',1),(80,'2019_12_16_104440_add_indexes_to_vendors_table',1),(81,'2019_12_16_104704_add_indexes_to_work_orders_table',1),(82,'2019_12_16_105013_add_indexes_to_work_order_logs_table',1),(83,'2019_12_16_115309_add_indexes_to_api_settings_table',1),(84,'2019_12_17_080649_add_taxes_to_income_table',1),(85,'2019_12_19_052248_create_payment_settings_table',1),(86,'2019_12_19_063520_create_booking_payments_table',1),(87,'2021_01_04_113449_create_twilio_settings_table',1),(88,'2021_06_29_052236_add_udf_field_to_vehicle_review_table',1),(89,'2021_06_29_115538_create_mechanics_table',1),(90,'2021_07_02_051340_create_permission_tables',1),(91,'2021_07_02_052117_add_mechanic_work_order_table',1),(92,'2021_07_02_055514_add_mechanic_work_order_log_table',1),(93,'2021_07_22_071412_create_push_subscriptions_table',1),(94,'2021_07_22_113433_add_provider_to_oauth_clients_table',1),(95,'2021_08_27_121756_add_user_id_to_mechanics_table',1),(96,'2021_08_27_121856_add_user_id_to_parts_category_table',1),(97,'2021_08_27_121941_add_user_id_to_service_items_table',1),(98,'2021_08_27_122008_add_user_id_to_service_reminder_table',1),(99,'2021_08_27_122045_add_user_id_to_vehicle_group_table',1),(100,'2021_08_27_122127_add_user_id_to_vendors_table',1),(101,'2021_08_27_122155_add_user_id_to_work_orders_table',1),(102,'2021_08_27_122217_add_user_id_to_work_order_logs_table',1),(103,'2021_08_27_122259_add_user_id_to_notes_table',1),(104,'2021_09_07_070458_add_user_id_to_users_table',1),(105,'2021_08_07_063711_create_messages_table',1),(106,'2022_01_17_065748_create_chat_settings_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
INSERT INTO `model_has_permissions` VALUES (9,'App\\Model\\User',6),(9,'App\\Model\\User',7),(9,'App\\Model\\User',8),(41,'App\\Model\\User',6),(41,'App\\Model\\User',7),(41,'App\\Model\\User',8),(66,'App\\Model\\User',6),(66,'App\\Model\\User',7),(66,'App\\Model\\User',8),(67,'App\\Model\\User',6),(67,'App\\Model\\User',7),(67,'App\\Model\\User',8),(68,'App\\Model\\User',6),(68,'App\\Model\\User',7),(68,'App\\Model\\User',8),(69,'App\\Model\\User',6),(69,'App\\Model\\User',7),(69,'App\\Model\\User',8),(71,'App\\Model\\User',4),(71,'App\\Model\\User',5),(72,'App\\Model\\User',4),(72,'App\\Model\\User',5),(73,'App\\Model\\User',4),(73,'App\\Model\\User',5),(74,'App\\Model\\User',4),(74,'App\\Model\\User',5),(81,'App\\Model\\User',6),(81,'App\\Model\\User',7),(81,'App\\Model\\User',8),(82,'App\\Model\\User',6),(82,'App\\Model\\User',7),(82,'App\\Model\\User',8),(83,'App\\Model\\User',6),(83,'App\\Model\\User',7),(83,'App\\Model\\User',8),(84,'App\\Model\\User',6),(84,'App\\Model\\User',7),(84,'App\\Model\\User',8),(101,'App\\Model\\User',6),(101,'App\\Model\\User',7),(101,'App\\Model\\User',8),(102,'App\\Model\\User',6),(102,'App\\Model\\User',7),(102,'App\\Model\\User',8),(103,'App\\Model\\User',6),(103,'App\\Model\\User',7),(103,'App\\Model\\User',8),(104,'App\\Model\\User',6),(104,'App\\Model\\User',7),(104,'App\\Model\\User',8);
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\Model\\User',1),(2,'App\\Model\\User',2),(2,'App\\Model\\User',3);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notes`
--

DROP TABLE IF EXISTS `notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `submitted_on` date DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notes_vehicle_id_customer_id_index` (`vehicle_id`,`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notes`
--

LOCK TABLES `notes` WRITE;
/*!40000 ALTER TABLE `notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) unsigned NOT NULL,
  `data` text COLLATE utf8_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`),
  KEY `notifications_type_index` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_access_tokens`
--

DROP TABLE IF EXISTS `oauth_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_access_tokens`
--

LOCK TABLES `oauth_access_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_auth_codes`
--

DROP TABLE IF EXISTS `oauth_auth_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `scopes` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_auth_codes`
--

LOCK TABLES `oauth_auth_codes` WRITE;
/*!40000 ALTER TABLE `oauth_auth_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_auth_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_clients`
--

DROP TABLE IF EXISTS `oauth_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `provider` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_clients`
--

LOCK TABLES `oauth_clients` WRITE;
/*!40000 ALTER TABLE `oauth_clients` DISABLE KEYS */;
INSERT INTO `oauth_clients` VALUES (1,NULL,'Fleet Manager Personal Access Client','RSgOa49VlbquB3GxT1WAO2jReLCnHoWndPfyrJ4p',NULL,'http://localhost',1,0,0,'2021-11-20 07:03:53','2021-11-20 07:03:53'),(2,NULL,'Fleet Manager Password Grant Client','sX7qzt55VQ5pGjl4gkxyycwKz9yE6ngT4EoPEtRH','users','http://localhost',0,1,0,'2021-11-20 07:03:53','2021-11-20 07:03:53');
/*!40000 ALTER TABLE `oauth_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_personal_access_clients`
--

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_personal_access_clients_client_id_index` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_personal_access_clients`
--

LOCK TABLES `oauth_personal_access_clients` WRITE;
/*!40000 ALTER TABLE `oauth_personal_access_clients` DISABLE KEYS */;
INSERT INTO `oauth_personal_access_clients` VALUES (1,1,'2021-11-20 07:03:53','2021-11-20 07:03:53');
/*!40000 ALTER TABLE `oauth_personal_access_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_refresh_tokens`
--

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_refresh_tokens`
--

LOCK TABLES `oauth_refresh_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_refresh_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_refresh_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parts`
--

DROP TABLE IF EXISTS `parts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `availability` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `year` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `barcode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `unit_cost` int(11) DEFAULT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `manufacturer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `udf` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parts_category_id_user_id_availability_index` (`category_id`,`user_id`,`availability`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parts`
--

LOCK TABLES `parts` WRITE;
/*!40000 ALTER TABLE `parts` DISABLE KEYS */;
/*!40000 ALTER TABLE `parts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parts_category`
--

DROP TABLE IF EXISTS `parts_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parts_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parts_category`
--

LOCK TABLES `parts_category` WRITE;
/*!40000 ALTER TABLE `parts_category` DISABLE KEYS */;
INSERT INTO `parts_category` VALUES (1,1,'Engine Parts','2021-11-20 07:03:50','2021-11-20 07:03:50',NULL),(2,1,'Electricals','2021-11-20 07:03:50','2021-11-20 07:03:50',NULL);
/*!40000 ALTER TABLE `parts_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parts_used`
--

DROP TABLE IF EXISTS `parts_used`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parts_used` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `part_id` int(11) DEFAULT NULL,
  `work_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parts_used_part_id_work_id_index` (`part_id`,`work_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parts_used`
--

LOCK TABLES `parts_used` WRITE;
/*!40000 ALTER TABLE `parts_used` DISABLE KEYS */;
/*!40000 ALTER TABLE `parts_used` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_settings`
--

DROP TABLE IF EXISTS `payment_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment_settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `payment_settings_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_settings`
--

LOCK TABLES `payment_settings` WRITE;
/*!40000 ALTER TABLE `payment_settings` DISABLE KEYS */;
INSERT INTO `payment_settings` VALUES (1,'method','[\"cash\"]','2021-11-20 07:04:09','2021-11-20 07:04:09',NULL),(2,'currency_code','INR','2021-11-20 07:04:10','2021-11-20 07:04:10',NULL),(3,'stripe_publishable_key','','2021-11-20 07:04:10','2021-11-20 07:04:10',NULL),(4,'stripe_secret_key','','2021-11-20 07:04:10','2021-11-20 07:04:10',NULL),(5,'razorpay_key','','2021-11-20 07:04:10','2021-11-20 07:04:10',NULL),(6,'razorpay_secret','','2021-11-20 07:04:10','2021-11-20 07:04:10',NULL),(7,'paystack_secret','','2021-11-20 07:04:10','2021-11-20 07:04:10',NULL);
/*!40000 ALTER TABLE `payment_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=136 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'Users add','web','2021-11-20 07:04:15','2021-11-20 07:04:15'),(2,'Users edit','web','2021-11-20 07:04:15','2021-11-20 07:04:15'),(3,'Users delete','web','2021-11-20 07:04:15','2021-11-20 07:04:15'),(4,'Users list','web','2021-11-20 07:04:15','2021-11-20 07:04:15'),(5,'Users import','web','2021-11-20 07:04:15','2021-11-20 07:04:15'),(6,'Drivers add','web','2021-11-20 07:04:15','2021-11-20 07:04:15'),(7,'Drivers edit','web','2021-11-20 07:04:15','2021-11-20 07:04:15'),(8,'Drivers delete','web','2021-11-20 07:04:15','2021-11-20 07:04:15'),(9,'Drivers list','web','2021-11-20 07:04:15','2021-11-20 07:04:15'),(10,'Drivers import','web','2021-11-20 07:04:15','2021-11-20 07:04:15'),(11,'Customer add','web','2021-11-20 07:04:15','2021-11-20 07:04:15'),(12,'Customer edit','web','2021-11-20 07:04:16','2021-11-20 07:04:16'),(13,'Customer delete','web','2021-11-20 07:04:16','2021-11-20 07:04:16'),(14,'Customer list','web','2021-11-20 07:04:16','2021-11-20 07:04:16'),(15,'Customer import','web','2021-11-20 07:04:16','2021-11-20 07:04:16'),(16,'VehicleType add','web','2021-11-20 07:04:16','2021-11-20 07:04:16'),(17,'VehicleType edit','web','2021-11-20 07:04:16','2021-11-20 07:04:16'),(18,'VehicleType delete','web','2021-11-20 07:04:16','2021-11-20 07:04:16'),(19,'VehicleType list','web','2021-11-20 07:04:16','2021-11-20 07:04:16'),(20,'VehicleType import','web','2021-11-20 07:04:16','2021-11-20 07:04:16'),(21,'VehicleMaker add','web','2021-11-20 07:04:16','2021-11-20 07:04:16'),(22,'VehicleMaker edit','web','2021-11-20 07:04:16','2021-11-20 07:04:16'),(23,'VehicleMaker delete','web','2021-11-20 07:04:16','2021-11-20 07:04:16'),(24,'VehicleMaker list','web','2021-11-20 07:04:17','2021-11-20 07:04:17'),(25,'VehicleMaker import','web','2021-11-20 07:04:17','2021-11-20 07:04:17'),(26,'VehicleModels add','web','2021-11-20 07:04:17','2021-11-20 07:04:17'),(27,'VehicleModels edit','web','2021-11-20 07:04:17','2021-11-20 07:04:17'),(28,'VehicleModels delete','web','2021-11-20 07:04:17','2021-11-20 07:04:17'),(29,'VehicleModels list','web','2021-11-20 07:04:17','2021-11-20 07:04:17'),(30,'VehicleModels import','web','2021-11-20 07:04:17','2021-11-20 07:04:17'),(31,'VehicleColors add','web','2021-11-20 07:04:17','2021-11-20 07:04:17'),(32,'VehicleColors edit','web','2021-11-20 07:04:17','2021-11-20 07:04:17'),(33,'VehicleColors delete','web','2021-11-20 07:04:17','2021-11-20 07:04:17'),(34,'VehicleColors list','web','2021-11-20 07:04:17','2021-11-20 07:04:17'),(35,'VehicleColors import','web','2021-11-20 07:04:17','2021-11-20 07:04:17'),(36,'VehicleGroup add','web','2021-11-20 07:04:18','2021-11-20 07:04:18'),(37,'VehicleGroup edit','web','2021-11-20 07:04:18','2021-11-20 07:04:18'),(38,'VehicleGroup delete','web','2021-11-20 07:04:18','2021-11-20 07:04:18'),(39,'VehicleGroup list','web','2021-11-20 07:04:18','2021-11-20 07:04:18'),(40,'VehicleGroup import','web','2021-11-20 07:04:18','2021-11-20 07:04:18'),(41,'VehicleInspection add','web','2021-11-20 07:04:18','2021-11-20 07:04:18'),(42,'VehicleInspection edit','web','2021-11-20 07:04:18','2021-11-20 07:04:18'),(43,'VehicleInspection delete','web','2021-11-20 07:04:18','2021-11-20 07:04:18'),(44,'VehicleInspection list','web','2021-11-20 07:04:18','2021-11-20 07:04:18'),(45,'VehicleInspection import','web','2021-11-20 07:04:18','2021-11-20 07:04:18'),(46,'BookingQuotations add','web','2021-11-20 07:04:18','2021-11-20 07:04:18'),(47,'BookingQuotations edit','web','2021-11-20 07:04:18','2021-11-20 07:04:18'),(48,'BookingQuotations delete','web','2021-11-20 07:04:19','2021-11-20 07:04:19'),(49,'BookingQuotations list','web','2021-11-20 07:04:19','2021-11-20 07:04:19'),(50,'BookingQuotations import','web','2021-11-20 07:04:19','2021-11-20 07:04:19'),(51,'PartsCategory add','web','2021-11-20 07:04:19','2021-11-20 07:04:19'),(52,'PartsCategory edit','web','2021-11-20 07:04:19','2021-11-20 07:04:19'),(53,'PartsCategory delete','web','2021-11-20 07:04:19','2021-11-20 07:04:19'),(54,'PartsCategory list','web','2021-11-20 07:04:19','2021-11-20 07:04:19'),(55,'PartsCategory import','web','2021-11-20 07:04:19','2021-11-20 07:04:19'),(56,'Mechanics add','web','2021-11-20 07:04:19','2021-11-20 07:04:19'),(57,'Mechanics edit','web','2021-11-20 07:04:20','2021-11-20 07:04:20'),(58,'Mechanics delete','web','2021-11-20 07:04:20','2021-11-20 07:04:20'),(59,'Mechanics list','web','2021-11-20 07:04:20','2021-11-20 07:04:20'),(60,'Mechanics import','web','2021-11-20 07:04:20','2021-11-20 07:04:20'),(61,'Vehicles add','web','2021-11-20 07:04:20','2021-11-20 07:04:20'),(62,'Vehicles edit','web','2021-11-20 07:04:20','2021-11-20 07:04:20'),(63,'Vehicles delete','web','2021-11-20 07:04:20','2021-11-20 07:04:20'),(64,'Vehicles list','web','2021-11-20 07:04:20','2021-11-20 07:04:20'),(65,'Vehicles import','web','2021-11-20 07:04:20','2021-11-20 07:04:20'),(66,'Transactions add','web','2021-11-20 07:04:20','2021-11-20 07:04:20'),(67,'Transactions edit','web','2021-11-20 07:04:21','2021-11-20 07:04:21'),(68,'Transactions delete','web','2021-11-20 07:04:21','2021-11-20 07:04:21'),(69,'Transactions list','web','2021-11-20 07:04:21','2021-11-20 07:04:21'),(70,'Transactions import','web','2021-11-20 07:04:21','2021-11-20 07:04:21'),(71,'Bookings add','web','2021-11-20 07:04:21','2021-11-20 07:04:21'),(72,'Bookings edit','web','2021-11-20 07:04:21','2021-11-20 07:04:21'),(73,'Bookings delete','web','2021-11-20 07:04:21','2021-11-20 07:04:21'),(74,'Bookings list','web','2021-11-20 07:04:21','2021-11-20 07:04:21'),(75,'Bookings import','web','2021-11-20 07:04:21','2021-11-20 07:04:21'),(76,'Reports add','web','2021-11-20 07:04:21','2021-11-20 07:04:21'),(77,'Reports edit','web','2021-11-20 07:04:22','2021-11-20 07:04:22'),(78,'Reports delete','web','2021-11-20 07:04:22','2021-11-20 07:04:22'),(79,'Reports list','web','2021-11-20 07:04:22','2021-11-20 07:04:22'),(80,'Reports import','web','2021-11-20 07:04:22','2021-11-20 07:04:22'),(81,'Fuel add','web','2021-11-20 07:04:22','2021-11-20 07:04:22'),(82,'Fuel edit','web','2021-11-20 07:04:22','2021-11-20 07:04:22'),(83,'Fuel delete','web','2021-11-20 07:04:22','2021-11-20 07:04:22'),(84,'Fuel list','web','2021-11-20 07:04:22','2021-11-20 07:04:22'),(85,'Fuel import','web','2021-11-20 07:04:22','2021-11-20 07:04:22'),(86,'Vendors add','web','2021-11-20 07:04:22','2021-11-20 07:04:22'),(87,'Vendors edit','web','2021-11-20 07:04:23','2021-11-20 07:04:23'),(88,'Vendors delete','web','2021-11-20 07:04:23','2021-11-20 07:04:23'),(89,'Vendors list','web','2021-11-20 07:04:23','2021-11-20 07:04:23'),(90,'Vendors import','web','2021-11-20 07:04:23','2021-11-20 07:04:23'),(91,'Parts add','web','2021-11-20 07:04:23','2021-11-20 07:04:23'),(92,'Parts edit','web','2021-11-20 07:04:23','2021-11-20 07:04:23'),(93,'Parts delete','web','2021-11-20 07:04:23','2021-11-20 07:04:23'),(94,'Parts list','web','2021-11-20 07:04:23','2021-11-20 07:04:23'),(95,'Parts import','web','2021-11-20 07:04:23','2021-11-20 07:04:23'),(96,'WorkOrders add','web','2021-11-20 07:04:23','2021-11-20 07:04:23'),(97,'WorkOrders edit','web','2021-11-20 07:04:23','2021-11-20 07:04:23'),(98,'WorkOrders delete','web','2021-11-20 07:04:24','2021-11-20 07:04:24'),(99,'WorkOrders list','web','2021-11-20 07:04:24','2021-11-20 07:04:24'),(100,'WorkOrders import','web','2021-11-20 07:04:24','2021-11-20 07:04:24'),(101,'Notes add','web','2021-11-20 07:04:24','2021-11-20 07:04:24'),(102,'Notes edit','web','2021-11-20 07:04:24','2021-11-20 07:04:24'),(103,'Notes delete','web','2021-11-20 07:04:24','2021-11-20 07:04:24'),(104,'Notes list','web','2021-11-20 07:04:25','2021-11-20 07:04:25'),(105,'Notes import','web','2021-11-20 07:04:25','2021-11-20 07:04:25'),(106,'ServiceReminders add','web','2021-11-20 07:04:25','2021-11-20 07:04:25'),(107,'ServiceReminders edit','web','2021-11-20 07:04:25','2021-11-20 07:04:25'),(108,'ServiceReminders delete','web','2021-11-20 07:04:25','2021-11-20 07:04:25'),(109,'ServiceReminders list','web','2021-11-20 07:04:25','2021-11-20 07:04:25'),(110,'ServiceReminders import','web','2021-11-20 07:04:25','2021-11-20 07:04:25'),(111,'ServiceItems add','web','2021-11-20 07:04:25','2021-11-20 07:04:25'),(112,'ServiceItems edit','web','2021-11-20 07:04:25','2021-11-20 07:04:25'),(113,'ServiceItems delete','web','2021-11-20 07:04:25','2021-11-20 07:04:25'),(114,'ServiceItems list','web','2021-11-20 07:04:25','2021-11-20 07:04:25'),(115,'ServiceItems import','web','2021-11-20 07:04:25','2021-11-20 07:04:25'),(116,'Testimonials add','web','2021-11-20 07:04:26','2021-11-20 07:04:26'),(117,'Testimonials edit','web','2021-11-20 07:04:26','2021-11-20 07:04:26'),(118,'Testimonials delete','web','2021-11-20 07:04:26','2021-11-20 07:04:26'),(119,'Testimonials list','web','2021-11-20 07:04:26','2021-11-20 07:04:26'),(120,'Testimonials import','web','2021-11-20 07:04:26','2021-11-20 07:04:26'),(121,'Team add','web','2021-11-20 07:04:26','2021-11-20 07:04:26'),(122,'Team edit','web','2021-11-20 07:04:26','2021-11-20 07:04:26'),(123,'Team delete','web','2021-11-20 07:04:27','2021-11-20 07:04:27'),(124,'Team list','web','2021-11-20 07:04:27','2021-11-20 07:04:27'),(125,'Team import','web','2021-11-20 07:04:27','2021-11-20 07:04:27'),(126,'Settings add','web','2021-11-20 07:04:27','2021-11-20 07:04:27'),(127,'Settings edit','web','2021-11-20 07:04:27','2021-11-20 07:04:27'),(128,'Settings delete','web','2021-11-20 07:04:27','2021-11-20 07:04:27'),(129,'Settings list','web','2021-11-20 07:04:27','2021-11-20 07:04:27'),(130,'Settings import','web','2021-11-20 07:04:27','2021-11-20 07:04:27'),(131,'Inquiries add','web','2021-11-20 07:04:27','2021-11-20 07:04:27'),(132,'Inquiries edit','web','2021-11-20 07:04:27','2021-11-20 07:04:27'),(133,'Inquiries delete','web','2021-11-20 07:04:27','2021-11-20 07:04:27'),(134,'Inquiries list','web','2021-11-20 07:04:27','2021-11-20 07:04:27'),(135,'Inquiries import','web','2021-11-20 07:04:28','2021-11-20 07:04:28');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `push_notification`
--

DROP TABLE IF EXISTS `push_notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `push_notification` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `user_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `authtoken` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contentencoding` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `endpoint` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `publickey` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `push_notification_user_id_index` (`user_id`),
  KEY `push_notification_user_type_index` (`user_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `push_notification`
--

LOCK TABLES `push_notification` WRITE;
/*!40000 ALTER TABLE `push_notification` DISABLE KEYS */;
/*!40000 ALTER TABLE `push_notification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `push_subscriptions`
--

DROP TABLE IF EXISTS `push_subscriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `push_subscriptions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `subscribable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subscribable_id` bigint(20) unsigned NOT NULL,
  `endpoint` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `public_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `auth_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content_encoding` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `push_subscriptions_endpoint_unique` (`endpoint`),
  KEY `push_subscriptions_subscribable_type_subscribable_id_index` (`subscribable_type`,`subscribable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `push_subscriptions`
--

LOCK TABLES `push_subscriptions` WRITE;
/*!40000 ALTER TABLE `push_subscriptions` DISABLE KEYS */;
/*!40000 ALTER TABLE `push_subscriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reasons`
--

DROP TABLE IF EXISTS `reasons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reasons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `reason` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reasons`
--

LOCK TABLES `reasons` WRITE;
/*!40000 ALTER TABLE `reasons` DISABLE KEYS */;
INSERT INTO `reasons` VALUES (1,'No fuel',NULL,'2021-11-20 07:03:46','2021-11-20 07:03:46'),(2,'Tire punctured',NULL,'2021-11-20 07:03:46','2021-11-20 07:03:46');
/*!40000 ALTER TABLE `reasons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reviews` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `booking_id` int(11) DEFAULT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `ratings` double(8,2) DEFAULT NULL,
  `review_text` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reviews_user_id_booking_id_driver_id_index` (`user_id`,`booking_id`,`driver_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(6,2),(7,1),(7,2),(8,1),(8,2),(9,1),(9,2),(10,1),(11,1),(11,2),(12,1),(12,2),(13,1),(13,2),(14,1),(14,2),(15,1),(16,1),(17,1),(18,1),(19,1),(20,1),(21,1),(22,1),(23,1),(24,1),(25,1),(26,1),(27,1),(28,1),(29,1),(30,1),(31,1),(32,1),(33,1),(34,1),(35,1),(36,1),(37,1),(38,1),(39,1),(40,1),(41,1),(42,1),(43,1),(44,1),(45,1),(46,1),(47,1),(48,1),(49,1),(50,1),(51,1),(52,1),(53,1),(54,1),(55,1),(56,1),(57,1),(58,1),(59,1),(60,1),(61,1),(62,1),(63,1),(64,1),(65,1),(66,1),(67,1),(68,1),(69,1),(70,1),(71,1),(71,2),(72,1),(72,2),(73,1),(73,2),(74,1),(74,2),(75,1),(76,1),(77,1),(78,1),(79,1),(80,1),(81,1),(82,1),(83,1),(84,1),(85,1),(86,1),(87,1),(88,1),(89,1),(90,1),(91,1),(92,1),(93,1),(94,1),(95,1),(96,1),(97,1),(98,1),(99,1),(100,1),(101,1),(102,1),(103,1),(104,1),(105,1),(106,1),(107,1),(108,1),(109,1),(110,1),(111,1),(112,1),(113,1),(114,1),(115,1),(116,1),(117,1),(118,1),(119,1),(120,1),(121,1),(122,1),(123,1),(124,1),(125,1),(126,1),(127,1),(128,1),(129,1),(130,1),(131,1),(132,1),(133,1),(134,1),(135,1);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Super Admin','web','2021-11-20 07:04:28','2021-11-20 07:04:28'),(2,'Admin','web','2021-11-20 07:04:36','2021-11-20 07:04:36');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_items`
--

DROP TABLE IF EXISTS `service_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `time_interval` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'off',
  `overdue_time` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `overdue_unit` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meter_interval` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'off',
  `overdue_meter` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `show_time` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'off',
  `duesoon_time` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `duesoon_unit` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `show_meter` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'off',
  `duesoon_meter` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_items`
--

LOCK TABLES `service_items` WRITE;
/*!40000 ALTER TABLE `service_items` DISABLE KEYS */;
INSERT INTO `service_items` VALUES (1,1,'Change oil','on','60','day(s)','off',NULL,'on','2','day(s)','off',NULL,NULL,'2021-11-20 07:03:53','2021-11-20 07:03:53');
/*!40000 ALTER TABLE `service_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_reminder`
--

DROP TABLE IF EXISTS `service_reminder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_reminder` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `last_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_meter` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `service_reminder_vehicle_id_service_id_index` (`vehicle_id`,`service_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_reminder`
--

LOCK TABLES `service_reminder` WRITE;
/*!40000 ALTER TABLE `service_reminder` DISABLE KEYS */;
/*!40000 ALTER TABLE `service_reminder` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'Website Name','app_name','Fleet Manager','2021-11-20 07:03:56','2021-11-22 23:03:02',NULL),(2,'Business Address 1','badd1','Company Address 1','2021-11-20 07:03:56','2021-11-22 23:03:03',NULL),(3,'Business Address 2','badd2','Company Address 2','2021-11-20 07:03:56','2021-11-22 23:03:03',NULL),(4,'Email Address','email','master@admin.com','2021-11-20 07:03:56','2021-11-22 23:03:03',NULL),(5,'City','city','Bhavnagar','2021-11-20 07:03:56','2021-11-22 23:03:03',NULL),(6,'State','state','Gujarat','2021-11-20 07:03:56','2021-11-22 23:03:03',NULL),(7,'Country','country','India','2021-11-20 07:03:56','2021-11-22 23:03:03',NULL),(8,'Distence Format','dis_format','km','2021-11-20 07:03:56','2021-11-22 23:03:03',NULL),(9,'Language','language','English-en','2021-11-20 07:03:57','2021-11-22 23:03:04',NULL),(10,'Currency','currency','₹','2021-11-20 07:03:57','2021-11-22 23:03:04',NULL),(11,'Tax No','tax_no','ABCD8735XXX','2021-11-20 07:03:57','2021-11-22 23:03:04',NULL),(12,'Invoice Text','invoice_text','Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.','2021-11-20 07:03:57','2021-11-22 23:03:04',NULL),(13,'Small Logo','icon_img','logo-40.png','2021-11-20 07:03:57','2021-11-20 07:03:57',NULL),(14,'Main Logo','logo_img','logo.png','2021-11-20 07:03:57','2021-11-20 07:03:57',NULL),(15,'Time Interval','time_interval','30','2021-11-20 07:03:57','2021-11-22 23:03:04',NULL),(16,'Tax Charge','tax_charge','null','2021-11-20 07:03:57','2021-11-22 23:03:05',NULL),(17,'Fuel Unit','fuel_unit','gallon','2021-11-20 07:03:57','2021-11-22 23:03:04',NULL),(18,'Date Format','date_format','d-m-Y','2021-11-20 07:03:57','2021-11-22 23:03:04',NULL),(19,'Website Footer','web_footer','<p><span style=\"font-size: 16px;\">© Hyvikk Solutions 2023. All Rights Reserved.&nbsp;<span class=\"vertical-spacer d-none d-lg-inline\">|</span>&nbsp;Powered By&nbsp;</span><a href=\"https://hyvikk.com/\" target=\"_blank\" class=\"link\"><span style=\"font-size: 16px;\">Hyvikk</span></a></p>','2021-11-20 07:03:57','2021-11-22 23:03:04',NULL),(20,'Fuel enable for Driver','fuel_enable_driver','1','2021-11-20 07:03:57','2021-11-22 23:03:05',NULL),(21,'Income enable for Driver','income_enable_driver','1','2021-11-20 07:03:57','2021-11-22 23:03:05',NULL),(22,'Expense enable for Driver','expense_enable_driver','1','2021-11-20 07:03:57','2021-11-22 23:03:05',NULL);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `team`
--

DROP TABLE IF EXISTS `team`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `team` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `designation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team`
--

LOCK TABLES `team` WRITE;
/*!40000 ALTER TABLE `team` DISABLE KEYS */;
INSERT INTO `team` VALUES (1,'Elliot Hirthe','Lorem ipsum dolor, sit amet consectetur adipisicing elit. Temporibus neque est nemo et ipsum fugiat, ab facere adipisci. Aliquam quibusdam molestias quisquam distinctio? Culpa, voluptatem voluptates exercitationem sequi velit quaerat.','Owner',NULL,'2021-11-20 07:03:45','2021-11-20 07:03:45',NULL),(2,'Kathlyn Wisoky IV','Lorem ipsum dolor, sit amet consectetur adipisicing elit. Temporibus neque est nemo et ipsum fugiat, ab facere adipisci. Aliquam quibusdam molestias quisquam distinctio? Culpa, voluptatem voluptates exercitationem sequi velit quaerat.','Owner',NULL,'2021-11-20 07:03:45','2021-11-20 07:03:45',NULL),(3,'Prof. Juliana Mante','Lorem ipsum dolor, sit amet consectetur adipisicing elit. Temporibus neque est nemo et ipsum fugiat, ab facere adipisci. Aliquam quibusdam molestias quisquam distinctio? Culpa, voluptatem voluptates exercitationem sequi velit quaerat.','Owner',NULL,'2021-11-20 07:03:45','2021-11-20 07:03:45',NULL),(4,'Deron Ortiz','Lorem ipsum dolor, sit amet consectetur adipisicing elit. Temporibus neque est nemo et ipsum fugiat, ab facere adipisci. Aliquam quibusdam molestias quisquam distinctio? Culpa, voluptatem voluptates exercitationem sequi velit quaerat.','Owner',NULL,'2021-11-20 07:03:45','2021-11-20 07:03:45',NULL),(5,'Dr. Jailyn Feil','Lorem ipsum dolor, sit amet consectetur adipisicing elit. Temporibus neque est nemo et ipsum fugiat, ab facere adipisci. Aliquam quibusdam molestias quisquam distinctio? Culpa, voluptatem voluptates exercitationem sequi velit quaerat.','Owner',NULL,'2021-11-20 07:03:45','2021-11-20 07:03:45',NULL);
/*!40000 ALTER TABLE `team` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `testimonials` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testimonials`
--

LOCK TABLES `testimonials` WRITE;
/*!40000 ALTER TABLE `testimonials` DISABLE KEYS */;
INSERT INTO `testimonials` VALUES (1,'Dahlia Goldner','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet animi doloribus, repudiandae iusto magnam soluta voluptates, expedita aspernatur consectetur! Ex fugit ducimus itaque, quibusdam nemo in animi quae libero repellendus!',NULL,'2021-11-20 07:03:45','2021-11-20 07:03:45',NULL),(2,'Franz Stokes','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet animi doloribus, repudiandae iusto magnam soluta voluptates, expedita aspernatur consectetur! Ex fugit ducimus itaque, quibusdam nemo in animi quae libero repellendus!',NULL,'2021-11-20 07:03:45','2021-11-20 07:03:45',NULL),(3,'Albert Gleason','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet animi doloribus, repudiandae iusto magnam soluta voluptates, expedita aspernatur consectetur! Ex fugit ducimus itaque, quibusdam nemo in animi quae libero repellendus!',NULL,'2021-11-20 07:03:45','2021-11-20 07:03:45',NULL),(4,'Vanessa Bechtelar PhD','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet animi doloribus, repudiandae iusto magnam soluta voluptates, expedita aspernatur consectetur! Ex fugit ducimus itaque, quibusdam nemo in animi quae libero repellendus!',NULL,'2021-11-20 07:03:45','2021-11-20 07:03:45',NULL),(5,'Adah Rau','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet animi doloribus, repudiandae iusto magnam soluta voluptates, expedita aspernatur consectetur! Ex fugit ducimus itaque, quibusdam nemo in animi quae libero repellendus!',NULL,'2021-11-20 07:03:45','2021-11-20 07:03:45',NULL);
/*!40000 ALTER TABLE `testimonials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `twilio_settings`
--

DROP TABLE IF EXISTS `twilio_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `twilio_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `twilio_settings_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `twilio_settings`
--

LOCK TABLES `twilio_settings` WRITE;
/*!40000 ALTER TABLE `twilio_settings` DISABLE KEYS */;
INSERT INTO `twilio_settings` VALUES (1,'sid','','2021-11-20 07:04:11','2021-11-20 07:04:11',NULL),(2,'token','','2021-11-20 07:04:11','2021-11-20 07:04:11',NULL),(3,'from','','2021-11-20 07:04:11','2021-11-20 07:04:11',NULL),(4,'customer_message','','2021-11-20 07:04:11','2021-11-20 07:04:11',NULL),(5,'driver_message','','2021-11-20 07:04:11','2021-11-20 07:04:11',NULL);
/*!40000 ALTER TABLE `twilio_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(95) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `api_token` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_api_token_unique` (`api_token`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_user_type_index` (`user_type`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'Super Administrator','master@admin.com','$2y$10$oRVwGqjS7RT.ae9rLPlbwevOJz88d7mUuDE1vPtWEsHBevanPCq6q','S',NULL,'vNjY40dy2vWTYJqPfsOGRW331lIU8OY2qfUrqL5Oo4RTxnIvsxT9ZVIHlXFv',NULL,'2021-11-20 07:03:48','2021-11-20 07:03:48',NULL),(2,1,'User One','user1@admin.com','$2y$10$0yL5QM7IVdb3B6FUi3m2HugbnC5VK2HncZR0VGr1cvsSEV/Nc/pc.','O',1,'1TxP6fg9WPYmPse2PaRggJUAyt0De9xOYUivQeiSC0N92GYEFVOviNfQq6Qk',NULL,'2021-11-20 07:03:48','2021-11-20 07:03:48',NULL),(3,1,'User Two','user2@admin.com','$2y$10$JPAnaeoH1aw5NIoomGPHyOi03VVOl0y6/iU4Po0Q/d8HaKsOpoPK.','O',1,'dLlOOjzxTrYzA2N9IEJeduRXnpLwrARmnaXvwbtLtPCFgpcZgeYIfErCQ6ja',NULL,'2021-11-20 07:03:48','2021-11-20 07:03:48',NULL),(4,1,'Customer One','customer1@gmail.com','$2y$10$bt3dPDa3tHjUkB.IDINUM.1lqfLy.3M.TTd2qVWDqF5P3wCrVlpLq','C',NULL,'TuaPjW443femKIauadpE0VskcpvSwBke0dsS39YeOaiAAkS8rsek1vuXx9F3',NULL,'2021-11-20 07:03:49','2021-11-20 07:03:49',NULL),(5,1,'Customer Two','customer2@gmail.com','$2y$10$tMH0pfSWraNZLp1.nGhhDOMPhyxjC.tNykK6eXxg88CEZF0Zm.mdW','C',NULL,'0G1fjlmammOVOA7hxpsXAtw0Wp1oWLPC2xCxrCQoqS14m0U2d26sGHw15LuX',NULL,'2021-11-20 07:03:49','2021-11-20 07:03:49',NULL),(6,1,'Mariah Bahringer','nbode@example.net','$2y$10$mRsCYSZSMw0lAle/kxMjGODZ6nt/G3FzB75AUWsTKb7jdq9KXL9ny','D',NULL,'4vyb77kPNaiMyuPG63WUFctB2G3NPjPx1kgafzjBOWWnhEsVS8rScIg7s98O','5aN4c0pRUd','2021-11-20 07:04:12','2021-11-20 07:04:12',NULL),(7,1,'Leland Schuppe','oabshire@example.org','$2y$10$8xlqNIYjbsuuTrMho/4AieRd4AO8XFKL0UpO9L1c/4REs40OlSCXS','D',NULL,'rDQOs9u7J4HX9gRG9ba6SHpDfpcpNqxmKVuZmhgGAc9EK1Zbfs60cBepetsr','yX9YRQfvBJ','2021-11-20 07:04:13','2021-11-20 07:05:06',NULL),(8,1,'Noelle Stafford','kedim@mailinator.com','$2y$10$3x2u23rUc0eqJNqqPO7yNutR/wUZb9CAk97oI2OWVTrlDWexPfyfm','D',NULL,'pN1iP2z5R3KnjTtk2QiJHES7saG5MvxswgHjCaCu9Ob2CR32is6dD98c0txL',NULL,'2021-11-22 23:01:58','2021-11-22 23:01:58',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_meta`
--

DROP TABLE IF EXISTS `users_meta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_meta` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'null',
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_meta_user_id_index` (`user_id`),
  KEY `users_meta_key_index` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_meta`
--

LOCK TABLES `users_meta` WRITE;
/*!40000 ALTER TABLE `users_meta` DISABLE KEYS */;
INSERT INTO `users_meta` VALUES (1,1,'string','profile_image','no-user.jpg',NULL,'2021-11-20 07:03:48','2021-11-20 07:03:48'),(2,1,'string','module','a:15:{i:0;i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:5;i:5;i:6;i:6;i:7;i:7;i:8;i:8;i:9;i:9;i:10;i:10;i:11;i:12;i:12;i:13;i:13;i:14;i:14;i:15;}',NULL,'2021-11-20 07:03:48','2021-11-20 07:03:48'),(3,2,'string','module','a:15:{i:0;i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:5;i:5;i:6;i:6;i:7;i:7;i:8;i:8;i:9;i:9;i:10;i:10;i:11;i:12;i:12;i:13;i:13;i:14;i:14;i:15;}',NULL,'2021-11-20 07:03:48','2021-11-20 07:03:48'),(4,3,'string','module','a:15:{i:0;i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:5;i:5;i:6;i:6;i:7;i:7;i:8;i:8;i:9;i:9;i:10;i:10;i:11;i:12;i:12;i:13;i:13;i:14;i:14;i:15;}',NULL,'2021-11-20 07:03:48','2021-11-20 07:03:48'),(5,4,'string','first_name','Customer',NULL,'2021-11-20 07:03:49','2021-11-20 07:03:49'),(6,4,'string','last_name','One',NULL,'2021-11-20 07:03:49','2021-11-20 07:03:49'),(7,4,'string','address','728 Evalyn Knolls Apt. 119 Lake Jaydenville, MD 74979-3406',NULL,'2021-11-20 07:03:49','2021-11-20 07:03:49'),(8,4,'string','mobno','8639379915669',NULL,'2021-11-20 07:03:49','2021-11-20 07:03:49'),(9,4,'integer','gender','0',NULL,'2021-11-20 07:03:49','2021-11-20 07:03:49'),(10,5,'string','first_name','Customer',NULL,'2021-11-20 07:03:49','2021-11-20 07:03:49'),(11,5,'string','last_name','Two',NULL,'2021-11-20 07:03:49','2021-11-20 07:03:49'),(12,5,'string','address','91158 Luigi Cliffs Lake Darby, MA 39627-1727',NULL,'2021-11-20 07:03:49','2021-11-20 07:03:49'),(13,5,'string','mobno','9773607007903',NULL,'2021-11-20 07:03:49','2021-11-20 07:03:49'),(14,5,'integer','gender','1',NULL,'2021-11-20 07:03:49','2021-11-20 07:03:49'),(15,6,'string','first_name','Mariah',NULL,'2021-11-20 07:04:13','2021-11-20 07:04:13'),(16,6,'string','last_name','Bahringer',NULL,'2021-11-20 07:04:13','2021-11-20 07:04:13'),(17,6,'string','address','842 Dicki Run\nPort Lewis, DC 61595-0469',NULL,'2021-11-20 07:04:13','2021-11-20 07:04:13'),(18,6,'string','phone','03057119344690',NULL,'2021-11-20 07:04:13','2021-11-20 07:04:13'),(19,6,'string','issue_date','2021-11-20',NULL,'2021-11-20 07:04:14','2021-11-20 07:04:14'),(20,6,'string','exp_date','2022-01-20',NULL,'2021-11-20 07:04:14','2021-11-20 07:04:14'),(21,6,'string','start_date','2021-11-20',NULL,'2021-11-20 07:04:14','2021-11-20 07:04:14'),(22,6,'string','end_date','2021-12-20',NULL,'2021-11-20 07:04:14','2021-11-20 07:04:14'),(23,6,'integer','license_number','256612',NULL,'2021-11-20 07:04:14','2021-11-20 07:04:14'),(24,6,'integer','contract_number','5296',NULL,'2021-11-20 07:04:14','2021-11-20 07:04:14'),(25,6,'integer','emp_id','5732787',NULL,'2021-11-20 07:04:14','2021-11-20 07:04:14'),(26,7,'string','first_name','Leland',NULL,'2021-11-20 07:04:14','2021-11-20 07:04:14'),(27,7,'string','last_name','Schuppe',NULL,'2021-11-20 07:04:14','2021-11-20 07:04:14'),(28,7,'string','address','798 Ariel Causeway\nSouth Amirbury, GA 81164',NULL,'2021-11-20 07:04:14','2021-11-20 07:04:14'),(29,7,'string','phone','04450210557668',NULL,'2021-11-20 07:04:14','2021-11-20 07:04:14'),(30,7,'string','issue_date','2021-11-20',NULL,'2021-11-20 07:04:14','2021-11-20 07:04:14'),(31,7,'string','exp_date','2022-01-20',NULL,'2021-11-20 07:04:14','2021-11-20 07:04:14'),(32,7,'string','start_date','2021-11-20',NULL,'2021-11-20 07:04:14','2021-11-20 07:04:14'),(33,7,'string','end_date','2021-12-20',NULL,'2021-11-20 07:04:14','2021-11-20 07:04:14'),(34,7,'integer','license_number','812157',NULL,'2021-11-20 07:04:14','2021-11-20 07:04:14'),(35,7,'integer','contract_number','7824',NULL,'2021-11-20 07:04:14','2021-11-20 07:04:14'),(36,7,'integer','emp_id','4157602',NULL,'2021-11-20 07:04:15','2021-11-20 07:04:15'),(37,6,'integer','vehicle_id','1',NULL,'2021-11-20 07:04:15','2021-11-20 07:04:15'),(38,8,'string','_token','WmxrHtHiGbjZKGrmU10ipMeLfMppXKbHXTPrJMJl',NULL,'2021-11-22 23:01:58','2021-11-22 23:01:58'),(39,8,'string','is_active','1',NULL,'2021-11-22 23:01:58','2021-11-22 23:01:58'),(40,8,'string','is_available','0',NULL,'2021-11-22 23:01:58','2021-11-22 23:01:58'),(41,8,'string','first_name','Noelle',NULL,'2021-11-22 23:01:58','2021-11-22 23:01:58'),(42,8,'string','middle_name','Mona Rutledge',NULL,'2021-11-22 23:01:59','2021-11-22 23:01:59'),(43,8,'string','last_name','Stafford',NULL,'2021-11-22 23:01:59','2021-11-22 23:01:59'),(44,8,'string','vehicle_id','2',NULL,'2021-11-22 23:01:59','2021-11-22 23:01:59'),(45,8,'string','address','Esse neque quos qui',NULL,'2021-11-22 23:01:59','2021-11-22 23:01:59'),(46,8,'string','email','kedim@mailinator.com',NULL,'2021-11-22 23:01:59','2021-11-22 23:01:59'),(47,8,'string','phone_code','+49',NULL,'2021-11-22 23:01:59','2021-11-22 23:01:59'),(48,8,'string','phone','869',NULL,'2021-11-22 23:01:59','2021-11-22 23:01:59'),(49,8,'string','emp_id','Nisi sit ab ea plac',NULL,'2021-11-22 23:01:59','2021-11-22 23:01:59'),(50,8,'string','contract_number','533',NULL,'2021-11-22 23:02:00','2021-11-22 23:02:00'),(51,8,'string','license_number','417',NULL,'2021-11-22 23:02:00','2021-11-22 23:02:00'),(52,8,'string','issue_date','2020-02-19',NULL,'2021-11-22 23:02:00','2021-11-22 23:02:00'),(53,8,'string','exp_date','2022-05-15',NULL,'2021-11-22 23:02:00','2021-11-22 23:02:00'),(54,8,'string','start_date','2006-07-24',NULL,'2021-11-22 23:02:00','2021-11-22 23:02:00'),(55,8,'string','end_date','2022-02-11',NULL,'2021-11-22 23:02:00','2021-11-22 23:02:00'),(56,8,'string','password','password',NULL,'2021-11-22 23:02:00','2021-11-22 23:02:00'),(57,8,'string','gender','1',NULL,'2021-11-22 23:02:00','2021-11-22 23:02:00'),(58,8,'string','econtact','Et placeat excepteu',NULL,'2021-11-22 23:02:00','2021-11-22 23:02:00'),(59,1,'string','language','English-en',NULL,'2021-11-22 23:03:04','2021-11-22 23:03:04');
/*!40000 ALTER TABLE `users_meta` ENABLE KEYS */;
UNLOCK TABLES;


-- Table structure for table `vehicle_group`
--

DROP TABLE IF EXISTS `vehicle_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicle_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicle_group`
--

LOCK TABLES `vehicle_group` WRITE;
/*!40000 ALTER TABLE `vehicle_group` DISABLE KEYS */;
INSERT INTO `vehicle_group` VALUES (1,1,'Default','Default vehicle group','Default vehicle group',NULL,'2021-11-20 07:03:49','2021-11-20 07:03:49');
/*!40000 ALTER TABLE `vehicle_group` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Table structure for table `vehicle_review`
--

DROP TABLE IF EXISTS `vehicle_review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicle_review` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `reg_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kms_outgoing` int(11) DEFAULT NULL,
  `kms_incoming` int(11) DEFAULT NULL,
  `fuel_level_out` int(11) DEFAULT NULL,
  `fuel_level_in` int(11) DEFAULT NULL,
  `datetime_outgoing` datetime DEFAULT NULL,
  `datetime_incoming` datetime DEFAULT NULL,
  `petrol_card` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `lights` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `invertor` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `car_mats` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `int_damage` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `int_lights` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `ext_car` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `tyre` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `ladder` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `leed` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `power_tool` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `ac` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `head_light` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `lock` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `windows` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `condition` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `oil_chk` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `suspension` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `tool_box` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `udf` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vehicle_review_vehicle_id_user_id_index` (`vehicle_id`,`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicle_review`
--

LOCK TABLES `vehicle_review` WRITE;
/*!40000 ALTER TABLE `vehicle_review` DISABLE KEYS */;
INSERT INTO `vehicle_review` VALUES (1,2,8,'875',15,65,3,1,'2019-12-09 00:00:00','1977-04-28 00:00:00','a:2:{s:4:\"flag\";s:1:\"1\";s:4:\"text\";s:20:\"Omnis facere aut cil\";}','a:2:{s:4:\"flag\";s:1:\"0\";s:4:\"text\";s:19:\"Obcaecati obcaecati\";}','a:2:{s:4:\"flag\";s:1:\"0\";s:4:\"text\";s:20:\"Quis doloremque repe\";}','a:2:{s:4:\"flag\";s:1:\"0\";s:4:\"text\";s:19:\"Fugit commodi quide\";}','a:2:{s:4:\"flag\";s:1:\"0\";s:4:\"text\";s:20:\"Numquam deserunt qui\";}','a:2:{s:4:\"flag\";s:1:\"0\";s:4:\"text\";s:20:\"Cupiditate dignissim\";}','a:2:{s:4:\"flag\";s:1:\"1\";s:4:\"text\";s:19:\"Quibusdam dicta qui\";}','a:2:{s:4:\"flag\";s:1:\"0\";s:4:\"text\";s:19:\"Necessitatibus fuga\";}','a:2:{s:4:\"flag\";s:1:\"1\";s:4:\"text\";s:20:\"Ut ut ullam omnis ad\";}','a:2:{s:4:\"flag\";s:1:\"0\";s:4:\"text\";s:20:\"Adipisci irure offic\";}','a:2:{s:4:\"flag\";s:1:\"1\";s:4:\"text\";s:19:\"Fuga Aperiam quaera\";}','a:2:{s:4:\"flag\";s:1:\"0\";s:4:\"text\";s:20:\"Ea ea modi earum ali\";}','a:2:{s:4:\"flag\";s:1:\"0\";s:4:\"text\";s:20:\"Nisi dolor officia e\";}','a:2:{s:4:\"flag\";s:1:\"1\";s:4:\"text\";s:19:\"Unde nisi culpa con\";}','a:2:{s:4:\"flag\";s:1:\"1\";s:4:\"text\";s:20:\"Quisquam eiusmod deb\";}','a:2:{s:4:\"flag\";s:1:\"0\";s:4:\"text\";s:20:\"Ex in beatae consequ\";}','a:2:{s:4:\"flag\";s:1:\"1\";s:4:\"text\";s:20:\"Do est ad et aliquid\";}','a:2:{s:4:\"flag\";s:1:\"0\";s:4:\"text\";s:19:\"Dolores ut eligendi\";}','a:2:{s:4:\"flag\";s:1:\"1\";s:4:\"text\";s:20:\"Doloremque dolores e\";}',NULL,NULL,'2021-11-22 23:02:36','2021-11-22 23:02:36','N;');
/*!40000 ALTER TABLE `vehicle_review` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicle_types`
--

DROP TABLE IF EXISTS `vehicle_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicle_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vehicletype` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `displayname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isenable` int(11) DEFAULT NULL,
  `seats` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicle_types`
--

LOCK TABLES `vehicle_types` WRITE;
/*!40000 ALTER TABLE `vehicle_types` DISABLE KEYS */;
INSERT INTO `vehicle_types` VALUES (1,'Hatchback','Hatchback',NULL,1,4,'2021-11-20 07:03:46','2021-11-20 07:03:46',NULL),(2,'Sedan','Sedan',NULL,1,4,'2021-11-20 07:03:47','2021-11-20 07:03:47',NULL),(3,'Mini van','Mini van',NULL,1,7,'2021-11-20 07:03:47','2021-11-20 07:03:47',NULL),(4,'Saloon','Saloon',NULL,1,4,'2021-11-20 07:03:47','2021-11-20 07:03:47',NULL),(5,'SUV','SUV',NULL,1,4,'2021-11-20 07:03:48','2021-11-20 07:03:48',NULL),(6,'Bus','Bus',NULL,1,40,'2021-11-20 07:03:48','2021-11-20 07:03:48',NULL),(7,'Truck','Truck',NULL,1,3,'2021-11-20 07:03:48','2021-11-20 07:03:48',NULL);
/*!40000 ALTER TABLE `vehicle_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicles`
--

DROP TABLE IF EXISTS `vehicles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `make_name` varchar(100) DEFAULT NULL,
  `model_name` varchar(100) DEFAULT NULL,
  `color_name` varchar(100) DEFAULT NULL,
  `year` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `lic_exp_date` date DEFAULT NULL,
  `reg_exp_date` date DEFAULT NULL,
  `vehicle_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `engine_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `horse_power` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vin` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `license_plate` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mileage` int(11) DEFAULT NULL,
  `in_service` tinyint(4) DEFAULT 0,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `int_mileage` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vehicles_group_id_type_id_user_id_in_service_index` (`group_id`,`type_id`,`user_id`,`in_service`),
  KEY `vehicles_lic_exp_date_reg_exp_date_index` (`lic_exp_date`,`reg_exp_date`),
  KEY `vehicles_license_plate_index` (`license_plate`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicles`
--

LOCK TABLES `vehicles` WRITE;
/*!40000 ALTER TABLE `vehicles` DISABLE KEYS */;
INSERT INTO `vehicles` VALUES (1,'Tata','Punch','Red','2015',1,'2022-07-28','2022-04-19','car1.png','Petrol','190','2342342','9191bh',45464,1,1,'2021-11-20 07:03:50','2021-11-20 07:03:50',NULL,50,3),(2,'Maruti','Suzuki','Blue','2012',1,'2022-11-20','2022-02-18','car1.png','Petrol','150','124578','1245ab',45464,1,1,'2021-11-20 07:03:50','2021-11-20 07:03:50',NULL,40,3);
/*!40000 ALTER TABLE `vehicles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicles_meta`
--

DROP TABLE IF EXISTS `vehicles_meta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicles_meta` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(10) unsigned NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'null',
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vehicles_meta_vehicle_id_index` (`vehicle_id`),
  KEY `vehicles_meta_key_index` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicles_meta`
--

LOCK TABLES `vehicles_meta` WRITE;
/*!40000 ALTER TABLE `vehicles_meta` DISABLE KEYS */;
INSERT INTO `vehicles_meta` VALUES (1,1,'integer','driver_id','6',NULL,'2021-11-20 07:03:50','2021-11-20 07:03:50'),(2,1,'double','average','35.45',NULL,'2021-11-20 07:03:50','2021-11-20 07:03:50'),(3,1,'string','ins_number','70651',NULL,'2021-11-20 07:03:50','2021-11-20 07:03:50'),(4,1,'string','ins_exp_date','2022-05-29',NULL,'2021-11-20 07:03:50','2021-11-20 07:03:50'),(5,2,'double','average','42.5',NULL,'2021-11-20 07:03:50','2021-11-20 07:03:50'),(6,2,'string','ins_number','36945',NULL,'2021-11-20 07:03:50','2021-11-20 07:03:50'),(7,2,'string','ins_exp_date','2022-05-29',NULL,'2021-11-20 07:03:50','2021-11-20 07:03:50'),(8,2,'integer','driver_id','8',NULL,'2021-11-22 23:02:01','2021-11-22 23:02:01');
/*!40000 ALTER TABLE `vehicles_meta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendors`
--

DROP TABLE IF EXISTS `vendors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vendors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `custom_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `province` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `udf` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postal_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vendors_type_index` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendors`
--

LOCK TABLES `vendors` WRITE;
/*!40000 ALTER TABLE `vendors` DISABLE KEYS */;
INSERT INTO `vendors` VALUES (1,1,'Prof. Hiram Kovacek',NULL,'Fuel','http://www.example.com',NULL,'default vendor','04401670207973','64150 Bonnie Way\nWest Nolan, MA 17783-5065',NULL,'Satterfieldland',NULL,'eladio99@example.org',NULL,'2021-11-20 07:04:11','2021-11-20 07:04:11',NULL,NULL,NULL),(2,1,'Melyssa Yost DDS',NULL,'Parts','http://www.example.com',NULL,'default vendor','09923748210738','3016 Newell Manors Suite 126\nWest Jackelineland, CO 52293-3742',NULL,'West Raoul',NULL,'williamson.melany@example.org',NULL,'2021-11-20 07:04:12','2021-11-20 07:04:12',NULL,NULL,NULL);
/*!40000 ALTER TABLE `vendors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `work_order_logs`
--

DROP TABLE IF EXISTS `work_order_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `work_order_logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `created_on` date DEFAULT NULL,
  `required_by` date DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `price` double(8,2) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `meter` int(11) DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `parts_price` double DEFAULT 0,
  `mechanic_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `work_order_logs_vehicle_id_vendor_id_index` (`vehicle_id`,`vendor_id`),
  KEY `work_order_logs_status_index` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `work_order_logs`
--

LOCK TABLES `work_order_logs` WRITE;
/*!40000 ALTER TABLE `work_order_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `work_order_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `work_orders`
--

DROP TABLE IF EXISTS `work_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `work_orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `created_on` date DEFAULT NULL,
  `required_by` date DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `price` double(8,2) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `meter` int(11) DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `mechanic_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `work_orders_vehicle_id_vendor_id_index` (`vehicle_id`,`vendor_id`),
  KEY `work_orders_status_index` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `work_orders`
--

LOCK TABLES `work_orders` WRITE;
/*!40000 ALTER TABLE `work_orders` DISABLE KEYS */;
INSERT INTO `work_orders` VALUES (1,1,'2021-11-20','2021-11-25',2,1,2000.00,'Pending','Sample work order',1398,'sample work order',NULL,'2021-11-20 07:04:12','2021-11-20 07:04:12',1),(2,1,'2021-11-20','2021-11-25',1,2,3000.00,'Pending','Sample work order',2389,'sample work order',NULL,'2021-11-20 07:04:12','2021-11-20 07:04:12',2);
/*!40000 ALTER TABLE `work_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'f6'
--

--
-- Dumping routines for database 'f6'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-02-04 14:49:06
