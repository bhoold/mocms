CREATE DATABASE  IF NOT EXISTS `mocms` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `mocms`;
-- MySQL dump 10.13  Distrib 8.0.15, for Win64 (x86_64)
--
-- Host: localhost    Database: livewebsite
-- ------------------------------------------------------
-- Server version	8.0.15

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `site_auth_groups`
--

DROP TABLE IF EXISTS `site_auth_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `site_auth_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_auth_groups`
--

LOCK TABLES `site_auth_groups` WRITE;
/*!40000 ALTER TABLE `site_auth_groups` DISABLE KEYS */;
INSERT INTO `site_auth_groups` VALUES (1,'admin','Administrator');
/*!40000 ALTER TABLE `site_auth_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_auth_login_attempts`
--

DROP TABLE IF EXISTS `site_auth_login_attempts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `site_auth_login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_auth_login_attempts`
--

LOCK TABLES `site_auth_login_attempts` WRITE;
/*!40000 ALTER TABLE `site_auth_login_attempts` DISABLE KEYS */;
/*!40000 ALTER TABLE `site_auth_login_attempts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_auth_users`
--

DROP TABLE IF EXISTS `site_auth_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `site_auth_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_email` (`email`),
  UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  UNIQUE KEY `uc_remember_selector` (`remember_selector`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_auth_users`
--

LOCK TABLES `site_auth_users` WRITE;
/*!40000 ALTER TABLE `site_auth_users` DISABLE KEYS */;
INSERT INTO `site_auth_users` VALUES (1,'127.0.0.1','admin','$2y$12$F.1G2c/TQDGg8U5qtmqYG.7O3NAet/e1ld82Txi59U0B.XYYzhQrC','admin@admin.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1268889823,1567095255,1,'Admin','istrator','ADMIN','0');
/*!40000 ALTER TABLE `site_auth_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_auth_users_groups`
--

DROP TABLE IF EXISTS `site_auth_users_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `site_auth_users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_auth_users_groups`
--

LOCK TABLES `site_auth_users_groups` WRITE;
/*!40000 ALTER TABLE `site_auth_users_groups` DISABLE KEYS */;
INSERT INTO `site_auth_users_groups` VALUES (1,1,1);
/*!40000 ALTER TABLE `site_auth_users_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_region`
--

DROP TABLE IF EXISTS `site_region`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `site_region` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `shortname` varchar(45) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `pinyin` varchar(45) DEFAULT NULL COMMENT '拼音',
  `citycode` varchar(45) DEFAULT NULL COMMENT '行政区域编码',
  `zipcode` varchar(45) DEFAULT NULL COMMENT '邮编',
  `lng` varchar(45) DEFAULT NULL COMMENT '地理坐标经度',
  `lat` varchar(45) DEFAULT NULL COMMENT '地理坐标纬度',
  `level` int(11) DEFAULT NULL COMMENT '级别，一级省二级市三级区',
  `pid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '父ID',
  `pcode` varchar(45) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=154 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_region`
--

LOCK TABLES `site_region` WRITE;
/*!40000 ALTER TABLE `site_region` DISABLE KEYS */;
INSERT INTO `site_region` VALUES (1,'北京','北京市',NULL,'110000',NULL,NULL,NULL,1,0,NULL,'2019-09-21 23:23:21','2019-09-27 18:05:07'),(2,'上海','上海市',NULL,'310000',NULL,NULL,NULL,1,0,NULL,'2019-09-21 23:23:21','2019-09-27 18:05:07'),(3,'天津','天津市',NULL,'120000',NULL,NULL,NULL,1,0,NULL,'2019-09-21 23:23:21','2019-09-27 18:05:07'),(4,'重庆','重庆市',NULL,'500000',NULL,NULL,NULL,1,0,NULL,'2019-09-21 23:23:21','2019-09-27 18:05:07'),(5,'河北','河北省',NULL,'130000',NULL,NULL,NULL,1,0,NULL,'2019-09-27 18:05:07','2019-09-27 18:05:07'),(6,'山西','山西省',NULL,'140000',NULL,NULL,NULL,1,0,NULL,'2019-09-27 18:05:07','2019-09-27 18:05:07'),(7,'内蒙古','内蒙古自治区',NULL,'150000',NULL,NULL,NULL,1,0,NULL,'2019-09-27 18:05:10','2019-09-27 18:11:58'),(8,'辽宁','辽宁省',NULL,'210000',NULL,NULL,NULL,1,0,NULL,'2019-09-27 18:05:10','2019-09-27 18:11:58'),(9,'吉林','吉林省',NULL,'220000',NULL,NULL,NULL,1,0,NULL,'2019-09-27 18:11:58','2019-09-27 18:11:58'),(10,'黑龙江','黑龙江省',NULL,'230000',NULL,NULL,NULL,1,0,NULL,'2019-09-27 18:13:42','2019-09-27 18:13:42'),(11,'江苏','江苏省',NULL,'320000',NULL,NULL,NULL,1,0,NULL,'2019-09-27 18:26:07','2019-09-27 18:26:07'),(12,'浙江','浙江省',NULL,'330000',NULL,NULL,NULL,1,0,NULL,'2019-09-27 18:26:07','2019-09-27 18:26:07'),(13,'安徽','安徽省',NULL,'340000',NULL,NULL,NULL,1,0,NULL,'2019-09-27 18:26:07','2019-09-27 18:26:07'),(14,'福建','福建省',NULL,'350000',NULL,NULL,NULL,1,0,NULL,'2019-09-27 18:26:07','2019-09-27 18:26:07'),(15,'江西','江西省',NULL,'360000',NULL,NULL,NULL,1,0,NULL,'2019-09-27 18:26:07','2019-09-27 18:26:07'),(16,'山东','山东省',NULL,'370000',NULL,NULL,NULL,1,0,NULL,'2019-09-27 18:26:07','2019-09-27 18:26:07'),(17,'河南','河南省',NULL,'410000',NULL,NULL,NULL,1,0,NULL,'2019-09-27 18:26:07','2019-09-27 18:26:07'),(18,'湖北','湖北省',NULL,'420000',NULL,NULL,NULL,1,0,NULL,'2019-09-27 18:26:07','2019-09-27 18:26:07'),(19,'湖南','湖南省',NULL,'430000',NULL,NULL,NULL,1,0,NULL,'2019-09-27 18:26:07','2019-09-27 18:26:07'),(20,'广东','广东省',NULL,'440000',NULL,NULL,NULL,1,0,NULL,'2019-09-27 18:26:07','2019-09-27 18:26:07'),(21,'广西','广西壮族自治区',NULL,'450000',NULL,NULL,NULL,1,0,NULL,'2019-09-27 18:26:07','2019-09-27 18:26:07'),(22,'海南','海南省',NULL,'460000',NULL,NULL,NULL,1,0,NULL,'2019-09-27 18:26:07','2019-09-27 18:26:07'),(23,'四川','四川省',NULL,'510000',NULL,NULL,NULL,1,0,NULL,'2019-09-27 18:26:07','2019-09-27 18:26:07'),(24,'贵州','贵州省',NULL,'520000',NULL,NULL,NULL,1,0,NULL,'2019-09-27 18:26:07','2019-09-27 18:26:07'),(25,'云南','云南省',NULL,'530000',NULL,NULL,NULL,1,0,NULL,'2019-09-27 18:26:07','2019-09-27 18:26:07'),(26,'西藏','西藏自治区',NULL,'540000',NULL,NULL,NULL,1,0,NULL,'2019-09-27 18:26:07','2019-09-27 18:26:07'),(27,'陕西','陕西省',NULL,'610000',NULL,NULL,NULL,1,0,NULL,'2019-09-27 18:26:07','2019-09-27 18:26:07'),(28,'甘肃','甘肃省',NULL,'620000',NULL,NULL,NULL,1,0,NULL,'2019-09-27 18:26:07','2019-09-27 18:26:07'),(29,'青海','青海省',NULL,'630000',NULL,NULL,NULL,1,0,NULL,'2019-09-27 18:26:07','2019-09-27 18:26:07'),(30,'宁夏','宁夏回族自治区',NULL,'640000',NULL,NULL,NULL,1,0,NULL,'2019-09-27 18:26:07','2019-09-27 18:26:07'),(31,'新疆','新疆维吾尔自治区',NULL,'650000',NULL,NULL,NULL,1,0,NULL,'2019-09-27 18:26:07','2019-09-27 18:26:07'),(32,'台湾','台湾省',NULL,'710000',NULL,NULL,NULL,1,0,NULL,'2019-09-27 18:26:07','2019-09-27 18:26:07'),(33,'香港','香港特别行政区',NULL,'810000',NULL,NULL,NULL,1,0,NULL,'2019-09-27 18:26:07','2019-09-27 18:26:07'),(34,'澳门','澳门特别行政区',NULL,'820000',NULL,NULL,NULL,1,0,NULL,'2019-09-27 18:26:07','2019-09-27 18:26:07'),(35,'东城区','东城区',NULL,'110101',NULL,NULL,NULL,2,1,NULL,'2019-09-27 18:33:50','2019-09-27 18:33:50'),(36,'西城区','西城区',NULL,'110102',NULL,NULL,NULL,2,1,NULL,'2019-09-27 18:33:50','2019-09-27 18:33:50'),(37,'朝阳区','朝阳区',NULL,'110105',NULL,NULL,NULL,2,1,NULL,'2019-09-27 18:33:50','2019-09-27 18:33:50'),(38,'丰台区','丰台区',NULL,'110106',NULL,NULL,NULL,2,1,NULL,'2019-09-27 18:33:50','2019-09-27 18:33:50'),(39,'石景山区','石景山区',NULL,'110107',NULL,NULL,NULL,2,1,NULL,'2019-09-27 18:33:50','2019-09-27 18:33:50'),(40,'海淀区','海淀区',NULL,'110108',NULL,NULL,NULL,2,1,NULL,'2019-09-27 18:33:50','2019-09-27 18:33:50'),(41,'门头沟区','门头沟区',NULL,'110109',NULL,NULL,NULL,2,1,NULL,'2019-09-27 18:33:50','2019-09-27 18:33:50'),(42,'房山区','房山区',NULL,'110111',NULL,NULL,NULL,2,1,NULL,'2019-09-27 18:33:50','2019-09-27 18:33:50'),(43,'通州区','通州区',NULL,'110112',NULL,NULL,NULL,2,1,NULL,'2019-09-27 18:33:50','2019-09-27 18:33:50'),(44,'顺义区','顺义区',NULL,'110113',NULL,NULL,NULL,2,1,NULL,'2019-09-27 18:33:50','2019-09-27 18:33:50'),(45,'昌平区','昌平区',NULL,'110114',NULL,NULL,NULL,2,1,NULL,'2019-09-27 18:33:50','2019-09-27 18:33:50'),(46,'大兴区','大兴区',NULL,'110115',NULL,NULL,NULL,2,1,NULL,'2019-09-27 18:33:50','2019-09-27 18:33:50'),(47,'怀柔区','怀柔区',NULL,'110116',NULL,NULL,NULL,2,1,NULL,'2019-09-27 18:33:50','2019-09-27 18:33:50'),(48,'平谷区','平谷区',NULL,'110117',NULL,NULL,NULL,2,1,NULL,'2019-09-27 18:33:50','2019-09-27 18:33:50'),(49,'密云区','密云区',NULL,'110118',NULL,NULL,NULL,2,1,NULL,'2019-09-27 18:33:50','2019-09-27 18:33:50'),(50,'延庆区','延庆区',NULL,'110119',NULL,NULL,NULL,2,1,NULL,'2019-09-27 18:33:50','2019-09-27 18:33:50'),(51,'和平区','和平区',NULL,'120101',NULL,NULL,NULL,2,3,NULL,'2019-09-27 18:39:43','2019-09-27 18:39:43'),(52,'河东区','河东区',NULL,'120102',NULL,NULL,NULL,2,3,NULL,'2019-09-27 18:39:43','2019-09-27 18:39:43'),(53,'河西区','河西区',NULL,'120103',NULL,NULL,NULL,2,3,NULL,'2019-09-27 18:39:43','2019-09-27 18:39:43'),(54,'南开区','南开区',NULL,'120104',NULL,NULL,NULL,2,3,NULL,'2019-09-27 18:39:43','2019-09-27 18:39:43'),(55,'河北区','河北区',NULL,'120105',NULL,NULL,NULL,2,3,NULL,'2019-09-27 18:39:43','2019-09-27 18:39:43'),(56,'红桥区','红桥区',NULL,'120106',NULL,NULL,NULL,2,3,NULL,'2019-09-27 18:39:43','2019-09-27 18:39:43'),(57,'东丽区','东丽区',NULL,'120110',NULL,NULL,NULL,2,3,NULL,'2019-09-27 18:39:43','2019-09-27 18:39:43'),(58,'西青区','西青区',NULL,'120111',NULL,NULL,NULL,2,3,NULL,'2019-09-27 18:39:43','2019-09-27 18:39:43'),(59,'津南区','津南区',NULL,'120112',NULL,NULL,NULL,2,3,NULL,'2019-09-27 18:39:43','2019-09-27 18:39:43'),(60,'北辰区','北辰区',NULL,'120113',NULL,NULL,NULL,2,3,NULL,'2019-09-27 18:39:43','2019-09-27 18:39:43'),(61,'武清区','武清区',NULL,'120114',NULL,NULL,NULL,2,3,NULL,'2019-09-27 18:39:43','2019-09-27 18:39:43'),(62,'宝坻区','宝坻区',NULL,'120115',NULL,NULL,NULL,2,3,NULL,'2019-09-27 18:39:43','2019-09-27 18:39:43'),(63,'滨海新区','滨海新区',NULL,'120116',NULL,NULL,NULL,2,3,NULL,'2019-09-27 18:39:43','2019-09-27 18:39:43'),(64,'宁河区','宁河区',NULL,'120117',NULL,NULL,NULL,2,3,NULL,'2019-09-27 18:39:43','2019-09-27 18:39:43'),(65,'静海区','静海区',NULL,'120118',NULL,NULL,NULL,2,3,NULL,'2019-09-27 18:39:43','2019-09-27 18:39:43'),(66,'蓟州区','蓟州区',NULL,'120119',NULL,NULL,NULL,2,3,NULL,'2019-09-27 18:39:43','2019-09-27 18:39:43'),(67,'黄浦区','黄浦区',NULL,'310101',NULL,NULL,NULL,2,2,NULL,'2019-09-27 18:53:42','2019-09-27 18:53:42'),(68,'徐汇区','徐汇区',NULL,'310104',NULL,NULL,NULL,2,2,NULL,'2019-09-27 18:53:42','2019-09-27 18:53:42'),(69,'长宁区','长宁区',NULL,'310105',NULL,NULL,NULL,2,2,NULL,'2019-09-27 18:53:42','2019-09-27 18:53:42'),(70,'静安区','静安区',NULL,'310106',NULL,NULL,NULL,2,2,NULL,'2019-09-27 18:53:42','2019-09-27 18:53:42'),(71,'普陀区','普陀区',NULL,'310107',NULL,NULL,NULL,2,2,NULL,'2019-09-27 18:53:42','2019-09-27 18:53:42'),(72,'虹口区','虹口区',NULL,'310109',NULL,NULL,NULL,2,2,NULL,'2019-09-27 18:53:42','2019-09-27 18:53:42'),(73,'杨浦区','杨浦区',NULL,'310110',NULL,NULL,NULL,2,2,NULL,'2019-09-27 18:53:42','2019-09-27 18:53:42'),(74,'闵行区','闵行区',NULL,'310112',NULL,NULL,NULL,2,2,NULL,'2019-09-27 18:53:42','2019-09-27 18:53:42'),(75,'宝山区','宝山区',NULL,'310113',NULL,NULL,NULL,2,2,NULL,'2019-09-27 18:53:42','2019-09-27 18:53:42'),(76,'嘉定区','嘉定区',NULL,'310114',NULL,NULL,NULL,2,2,NULL,'2019-09-27 18:53:42','2019-09-27 18:53:42'),(77,'浦东新区','浦东新区',NULL,'310115',NULL,NULL,NULL,2,2,NULL,'2019-09-27 18:53:42','2019-09-27 18:53:42'),(78,'金山区','金山区',NULL,'310116',NULL,NULL,NULL,2,2,NULL,'2019-09-27 18:53:42','2019-09-27 18:53:42'),(79,'松江区','松江区',NULL,'310117',NULL,NULL,NULL,2,2,NULL,'2019-09-27 18:53:42','2019-09-27 18:53:42'),(80,'青浦区','青浦区',NULL,'310118',NULL,NULL,NULL,2,2,NULL,'2019-09-27 18:53:42','2019-09-27 18:53:42'),(81,'奉贤区','奉贤区',NULL,'310120',NULL,NULL,NULL,2,2,NULL,'2019-09-27 18:53:42','2019-09-27 18:53:42'),(82,'崇明区','崇明区',NULL,'310151',NULL,NULL,NULL,2,2,NULL,'2019-09-27 18:53:42','2019-09-27 18:53:42'),(83,'万州区','万州区',NULL,'500101',NULL,NULL,NULL,2,4,NULL,'2019-09-27 19:03:33','2019-09-27 19:03:33'),(84,'涪陵区','涪陵区',NULL,'500102',NULL,NULL,NULL,2,4,NULL,'2019-09-27 19:03:33','2019-09-27 19:03:33'),(85,'渝中区','渝中区',NULL,'500103',NULL,NULL,NULL,2,4,NULL,'2019-09-27 19:03:33','2019-09-27 19:03:33'),(86,'大渡口区','大渡口区',NULL,'500104',NULL,NULL,NULL,2,4,NULL,'2019-09-27 19:03:33','2019-09-27 19:03:33'),(87,'江北区','江北区',NULL,'500105',NULL,NULL,NULL,2,4,NULL,'2019-09-27 19:03:33','2019-09-27 19:03:33'),(88,'沙坪坝区','沙坪坝区',NULL,'500106',NULL,NULL,NULL,2,4,NULL,'2019-09-27 19:03:33','2019-09-27 19:03:33'),(89,'九龙坡区','九龙坡区',NULL,'500107',NULL,NULL,NULL,2,4,NULL,'2019-09-27 19:03:33','2019-09-27 19:03:33'),(90,'南岸区','南岸区',NULL,'500108',NULL,NULL,NULL,2,4,NULL,'2019-09-27 19:03:33','2019-09-27 19:03:33'),(91,'北碚区','北碚区',NULL,'500109',NULL,NULL,NULL,2,4,NULL,'2019-09-27 19:03:33','2019-09-27 19:03:33'),(92,'綦江区','綦江区',NULL,'500110',NULL,NULL,NULL,2,4,NULL,'2019-09-27 19:03:33','2019-09-27 19:03:33'),(93,'大足区','大足区',NULL,'500111',NULL,NULL,NULL,2,4,NULL,'2019-09-27 19:03:33','2019-09-27 19:03:33'),(94,'渝北区','渝北区',NULL,'500112',NULL,NULL,NULL,2,4,NULL,'2019-09-27 19:03:33','2019-09-27 19:03:33'),(95,'巴南区','巴南区',NULL,'500113',NULL,NULL,NULL,2,4,NULL,'2019-09-27 19:03:33','2019-09-27 19:03:33'),(96,'黔江区','黔江区',NULL,'500114',NULL,NULL,NULL,2,4,NULL,'2019-09-27 19:03:33','2019-09-27 19:03:33'),(97,'长寿区','长寿区',NULL,'500115',NULL,NULL,NULL,2,4,NULL,'2019-09-27 19:03:33','2019-09-27 19:03:33'),(98,'江津区','江津区',NULL,'500116',NULL,NULL,NULL,2,4,NULL,'2019-09-27 19:03:33','2019-09-27 19:03:33'),(99,'合川区','合川区',NULL,'500117',NULL,NULL,NULL,2,4,NULL,'2019-09-27 19:03:33','2019-09-27 19:03:33'),(100,'永川区','永川区',NULL,'500118',NULL,NULL,NULL,2,4,NULL,'2019-09-27 19:03:33','2019-09-27 19:03:33'),(101,'南川区','南川区',NULL,'500119',NULL,NULL,NULL,2,4,NULL,'2019-09-27 19:03:33','2019-09-27 19:03:33'),(102,'璧山区','璧山区',NULL,'500120',NULL,NULL,NULL,2,4,NULL,'2019-09-27 19:03:33','2019-09-27 19:03:33'),(103,'铜梁区','铜梁区',NULL,'500151',NULL,NULL,NULL,2,4,NULL,'2019-09-27 19:03:33','2019-09-27 19:03:33'),(104,'潼南区','潼南区',NULL,'500152',NULL,NULL,NULL,2,4,NULL,'2019-09-27 19:03:33','2019-09-27 19:03:33'),(105,'荣昌区','荣昌区',NULL,'500153',NULL,NULL,NULL,2,4,NULL,'2019-09-27 19:03:33','2019-09-27 19:03:33'),(106,'开州区','开州区',NULL,'500154',NULL,NULL,NULL,2,4,NULL,'2019-09-27 19:03:33','2019-09-27 19:03:33'),(107,'梁平区','梁平区',NULL,'500155',NULL,NULL,NULL,2,4,NULL,'2019-09-27 19:03:33','2019-09-27 19:03:33'),(108,'武隆区','武隆区',NULL,'500156',NULL,NULL,NULL,2,4,NULL,'2019-09-27 19:03:33','2019-09-27 19:03:33'),(109,'城口县','城口县',NULL,'500229',NULL,NULL,NULL,2,4,NULL,'2019-09-27 19:03:33','2019-09-27 19:03:33'),(110,'丰都县','丰都县',NULL,'500230',NULL,NULL,NULL,2,4,NULL,'2019-09-27 19:03:33','2019-09-27 19:03:33'),(111,'垫江县','垫江县',NULL,'500231',NULL,NULL,NULL,2,4,NULL,'2019-09-27 19:03:33','2019-09-27 19:03:33'),(112,'忠县','忠县',NULL,'500233',NULL,NULL,NULL,2,4,NULL,'2019-09-27 19:03:33','2019-09-27 19:03:33'),(113,'云阳县','云阳县',NULL,'500235',NULL,NULL,NULL,2,4,NULL,'2019-09-27 19:03:33','2019-09-27 19:03:33'),(114,'奉节县','奉节县',NULL,'500236',NULL,NULL,NULL,2,4,NULL,'2019-09-27 19:03:33','2019-09-27 19:03:33'),(115,'巫山县','巫山县',NULL,'500237',NULL,NULL,NULL,2,4,NULL,'2019-09-27 19:03:33','2019-09-27 19:03:33'),(116,'巫溪县','巫溪县',NULL,'500238',NULL,NULL,NULL,2,4,NULL,'2019-09-27 19:03:33','2019-09-27 19:03:33'),(117,'石柱土家族自治县','石柱土家族自治县',NULL,'500240',NULL,NULL,NULL,2,4,NULL,'2019-09-27 19:03:33','2019-09-27 19:03:33'),(118,'秀山土家族苗族自治县','秀山土家族苗族自治县',NULL,'500241',NULL,NULL,NULL,2,4,NULL,'2019-09-27 19:03:33','2019-09-27 19:03:33'),(119,'酉阳土家族苗族自治县','酉阳土家族苗族自治县',NULL,'500242',NULL,NULL,NULL,2,4,NULL,'2019-09-27 19:03:33','2019-09-27 19:03:33'),(120,'彭水苗族土家族自治县','彭水苗族土家族自治县',NULL,'500243',NULL,NULL,NULL,2,4,NULL,'2019-09-27 19:03:33','2019-09-27 19:03:33'),(121,'石家庄市','石家庄市',NULL,'130100',NULL,NULL,NULL,2,5,NULL,'2019-09-27 19:09:34','2019-09-27 19:09:34'),(122,'唐山市','唐山市',NULL,'130200',NULL,NULL,NULL,2,5,NULL,'2019-09-27 19:09:34','2019-09-27 19:09:34'),(123,'秦皇岛市','秦皇岛市',NULL,'130300',NULL,NULL,NULL,2,5,NULL,'2019-09-27 19:09:34','2019-09-27 19:09:34'),(124,'邯郸市','邯郸市',NULL,'130400',NULL,NULL,NULL,2,5,NULL,'2019-09-27 19:09:34','2019-09-27 19:09:34'),(125,'邢台市','邢台市',NULL,'130500',NULL,NULL,NULL,2,5,NULL,'2019-09-27 19:09:34','2019-09-27 19:09:34'),(126,'保定市','保定市',NULL,'130600',NULL,NULL,NULL,2,5,NULL,'2019-09-27 19:09:34','2019-09-27 19:09:34'),(127,'张家口市','张家口市',NULL,'130700',NULL,NULL,NULL,2,5,NULL,'2019-09-27 19:09:34','2019-09-27 19:09:34'),(128,'承德市','承德市',NULL,'130800',NULL,NULL,NULL,2,5,NULL,'2019-09-27 19:09:34','2019-09-27 19:09:34'),(129,'沧州市','沧州市',NULL,'130900',NULL,NULL,NULL,2,5,NULL,'2019-09-27 19:09:34','2019-09-27 19:09:34'),(130,'廊坊市','廊坊市',NULL,'131000',NULL,NULL,NULL,2,5,NULL,'2019-09-27 19:09:34','2019-09-27 19:09:34'),(131,'衡水市','衡水市',NULL,'131100',NULL,NULL,NULL,2,5,NULL,'2019-09-27 19:09:34','2019-09-27 19:09:34'),(132,'长安区','长安区',NULL,'130102',NULL,NULL,NULL,3,121,NULL,'2019-09-27 19:15:01','2019-09-27 19:15:01'),(133,'桥西区','桥西区',NULL,'130104',NULL,NULL,NULL,3,121,NULL,'2019-09-27 19:15:01','2019-09-27 19:15:01'),(134,'新华区','新华区',NULL,'130105',NULL,NULL,NULL,3,121,NULL,'2019-09-27 19:15:01','2019-09-27 19:15:01'),(135,'井陉矿区','井陉矿区',NULL,'130107',NULL,NULL,NULL,3,121,NULL,'2019-09-27 19:15:01','2019-09-27 19:15:01'),(136,'裕华区','裕华区',NULL,'130108',NULL,NULL,NULL,3,121,NULL,'2019-09-27 19:15:01','2019-09-27 19:15:01'),(137,'藁城区','藁城区',NULL,'130109',NULL,NULL,NULL,3,121,NULL,'2019-09-27 19:15:01','2019-09-27 19:15:01'),(138,'鹿泉区','鹿泉区',NULL,'130110',NULL,NULL,NULL,3,121,NULL,'2019-09-27 19:15:01','2019-09-27 19:15:01'),(139,'栾城区','栾城区',NULL,'130111',NULL,NULL,NULL,3,121,NULL,'2019-09-27 19:15:01','2019-09-27 19:15:01'),(140,'井陉县','井陉县',NULL,'130121',NULL,NULL,NULL,3,121,NULL,'2019-09-27 19:15:01','2019-09-27 19:15:01'),(141,'正定县','正定县',NULL,'130123',NULL,NULL,NULL,3,121,NULL,'2019-09-27 19:15:01','2019-09-27 19:15:01'),(142,'行唐县','行唐县',NULL,'130125',NULL,NULL,NULL,3,121,NULL,'2019-09-27 19:15:01','2019-09-27 19:15:01'),(143,'灵寿县','灵寿县',NULL,'130126',NULL,NULL,NULL,3,121,NULL,'2019-09-27 19:15:01','2019-09-27 19:15:01'),(144,'高邑县','高邑县',NULL,'130127',NULL,NULL,NULL,3,121,NULL,'2019-09-27 19:15:01','2019-09-27 19:15:01'),(145,'深泽县','深泽县',NULL,'130128',NULL,NULL,NULL,3,121,NULL,'2019-09-27 19:15:01','2019-09-27 19:15:01'),(146,'赞皇县','赞皇县',NULL,'130129',NULL,NULL,NULL,3,121,NULL,'2019-09-27 19:15:01','2019-09-27 19:15:01'),(147,'无极县','无极县',NULL,'130130',NULL,NULL,NULL,3,121,NULL,'2019-09-27 19:15:01','2019-09-27 19:15:01'),(148,'平山县','平山县',NULL,'130131',NULL,NULL,NULL,3,121,NULL,'2019-09-27 19:15:01','2019-09-27 19:15:01'),(149,'元氏县','元氏县',NULL,'130132',NULL,NULL,NULL,3,121,NULL,'2019-09-27 19:15:01','2019-09-27 19:15:01'),(150,'赵县','赵县',NULL,'130133',NULL,NULL,NULL,3,121,NULL,'2019-09-27 19:15:01','2019-09-27 19:15:01'),(151,'辛集市','辛集市',NULL,'130181',NULL,NULL,NULL,3,121,NULL,'2019-09-27 19:15:01','2019-09-27 19:15:01'),(152,'晋州市','晋州市',NULL,'130183',NULL,NULL,NULL,3,121,NULL,'2019-09-27 19:15:01','2019-09-27 19:15:01'),(153,'新乐市','新乐市',NULL,'130184',NULL,NULL,NULL,3,121,NULL,'2019-09-27 19:15:01','2019-09-27 19:15:01');
/*!40000 ALTER TABLE `site_region` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_system_auth_groups`
--

DROP TABLE IF EXISTS `site_system_auth_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `site_system_auth_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_system_auth_groups`
--

LOCK TABLES `site_system_auth_groups` WRITE;
/*!40000 ALTER TABLE `site_system_auth_groups` DISABLE KEYS */;
INSERT INTO `site_system_auth_groups` VALUES (1,'admin','Administrator'),(4,'test',''),(11,'管理员','');
/*!40000 ALTER TABLE `site_system_auth_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_system_auth_login_attempts`
--

DROP TABLE IF EXISTS `site_system_auth_login_attempts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `site_system_auth_login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_system_auth_login_attempts`
--

LOCK TABLES `site_system_auth_login_attempts` WRITE;
/*!40000 ALTER TABLE `site_system_auth_login_attempts` DISABLE KEYS */;
/*!40000 ALTER TABLE `site_system_auth_login_attempts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_system_auth_users`
--

DROP TABLE IF EXISTS `site_system_auth_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `site_system_auth_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_email` (`email`),
  UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  UNIQUE KEY `uc_remember_selector` (`remember_selector`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_system_auth_users`
--

LOCK TABLES `site_system_auth_users` WRITE;
/*!40000 ALTER TABLE `site_system_auth_users` DISABLE KEYS */;
INSERT INTO `site_system_auth_users` VALUES (1,'127.0.0.1','admin','$2y$12$F.1G2c/TQDGg8U5qtmqYG.7O3NAet/e1ld82Txi59U0B.XYYzhQrC','admin@admin.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1268889823,1572180411,1,'Admin','istrator','ADMIN','0'),(2,'::1','sff@qq.com','$2y$10$BV2sVtV1oxKEdDS.O51kLuiwis7Tg4K2ML/A.ETChPO3xSJ0TLk82','sff@qq.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1564733317,NULL,1,'test','aa','',''),(4,'::1','test','$2y$10$ea5OdfrJMT3UxVgp0xsoYeqd1IIRoFCuOuf0u2q/CoSyGmCCLjmJK','sdfs@sdf.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1564737622,NULL,1,'名字','姓氏2','公司名','ets'),(5,'::1','sd','$2y$10$wnlwYG.hLhFmYGkW7K04R.CTyabwFO.xGEKHhdUYEIMldoI2.9AcS','sdf@q.comk',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1564943059,NULL,1,'dsf','b','sdf','g'),(6,'::1','asd','$2y$10$k0nQykxPoPMKdUMR4DHRWew1e52dBVVBW8hOxO8uIJanueq4nSxGW','sfd@qq.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1564978389,NULL,1,'sdf','sdf','',''),(7,'::1','sdsdfsd','$2y$10$4HeojX/Pv22oZ6I854DQV.FViiRnA361jKqPXdiaaA1Xg1WUiUtM.','sdfs@sfs.sdfsd',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1564978418,NULL,1,'dd','sf','sdf','d'),(9,'::1','arhe','$2y$10$xj3Q48QGYK.3AUWWyoFu8Oatf7aUUaoKMqvQ.GyOoaKWy5/.Vhj8u','se@af.sdf',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1564978496,NULL,1,'fdg','dg','',''),(10,'::1','erg','$2y$10$HLSCLfFQiuVa8Wzq/uLgge5XyQeyTy8odRIQL7oKj5EpUGCOnmt0G','sgs@sdeg.sfd',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1564978526,NULL,1,'dg','dfg','',''),(11,'::1','sdfsg','$2y$10$u3xMb2tEZSjT/.Lq.m.akeFiW3OVpQFsj5HgZWhBJoBS8re2HZjhC','fsdf@sg.rge',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1564978546,NULL,1,'dgdf','dfg','',''),(12,'::1','testsd','$2y$10$cC/03rsr5hfordB1XLmvj.GFp6gPTieL9n9nmYvdKgLs/Xr6Uspgm','fsgae@xfg.fgdf',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1564981313,NULL,1,NULL,NULL,NULL,NULL),(13,'::1','dga','$2y$10$Lpd74oCkWOnyMQfqMketAu7elvr6A1LSeQ77wdhi8g7L6gxfg8/Ea','sdf@sf.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1564989012,NULL,1,NULL,NULL,NULL,NULL),(14,'::1','rgadf','$2y$10$yff/la6Ijr6W4R3ciatfvun.S33oaQ5Zwam27Ebq5/58J9OmT7WjS','dfg@s.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1564989041,NULL,1,NULL,NULL,NULL,NULL),(15,'::1','sgad','$2y$10$rv1PcpLYeKq2ekCFlFpTVuG2BNqSLWzIbYPqq4Y68EAyuAo2nRThq','sgfs@gd.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1564989080,NULL,1,NULL,NULL,NULL,NULL),(16,'::1','fdgs','$2y$10$2yO9eNNpQNKWoSy2HFWQv.GrxnxZZXq0O8hx3mIpjlafUc4RlfYea','sdgfs@sf.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1564989290,NULL,1,NULL,NULL,NULL,NULL),(17,'::1','dsgfds','$2y$10$22AcTHzk3rvzSHuiH1cdcOT1sYgfHUkk/LL2AVv020cHaM1poPNEK','dgs@sg.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1564989305,NULL,1,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `site_system_auth_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_system_auth_users_groups`
--

DROP TABLE IF EXISTS `site_system_auth_users_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `site_system_auth_users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`),
  CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `site_system_auth_groups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `site_system_auth_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_system_auth_users_groups`
--

LOCK TABLES `site_system_auth_users_groups` WRITE;
/*!40000 ALTER TABLE `site_system_auth_users_groups` DISABLE KEYS */;
INSERT INTO `site_system_auth_users_groups` VALUES (1,1,1);
/*!40000 ALTER TABLE `site_system_auth_users_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_system_uploadfile`
--

DROP TABLE IF EXISTS `site_system_uploadfile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `site_system_uploadfile` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_system_uploadfile`
--

LOCK TABLES `site_system_uploadfile` WRITE;
/*!40000 ALTER TABLE `site_system_uploadfile` DISABLE KEYS */;
INSERT INTO `site_system_uploadfile` VALUES (1,1,'3138869189_12845566023.jpg','uploads/3138869189_12845566023.jpg','2019-09-18 04:38:33','2019-09-18 04:38:33'),(2,1,'3138863203_1284556602_400x400.jpg','uploads/3138863203_1284556602_400x400.jpg','2019-09-18 04:39:02','2019-09-18 04:39:02'),(3,1,'3138863203_1284556602_400x4001.jpg','uploads/3138863203_1284556602_400x4001.jpg','2019-09-18 04:39:09','2019-09-18 04:39:09'),(4,1,'3138863203_1284556602_400x4002.jpg','uploads/3138863203_1284556602_400x4002.jpg','2019-09-18 04:39:18','2019-09-18 04:39:18'),(5,1,'timg00001.jpg','uploads/timg00001.jpg','2019-09-18 04:41:01','2019-09-18 04:41:01'),(6,1,'timg00002.jpg','uploads/timg00002.jpg','2019-09-18 04:41:12','2019-09-18 04:41:12'),(7,1,'timg00003.jpg','uploads/timg00003.jpg','2019-09-18 04:41:17','2019-09-18 04:41:17'),(8,1,'7d7ee11ba7b046e0!400x400_big.jpg','uploads/7d7ee11ba7b046e0!400x400_big.jpg','2019-09-18 05:26:00','2019-09-18 05:26:00'),(9,1,'4589900.png','uploads/4589900.png','2019-09-18 05:26:00','2019-09-18 05:26:00'),(10,1,'c27d32fba00ce36b!400x400_big.jpg','uploads/c27d32fba00ce36b!400x400_big.jpg','2019-09-18 05:50:48','2019-09-18 05:50:48'),(11,1,'3139632369_12845566021.jpg','uploads/3139632369_12845566021.jpg','2019-09-18 05:51:18','2019-09-18 05:51:18'),(12,1,'3138839010_1284556602_400x4001.jpg','uploads/3138839010_1284556602_400x4001.jpg','2019-09-18 05:52:20','2019-09-18 05:52:20'),(13,1,'3138881109_1284556602.jpg','uploads/3138881109_1284556602.jpg','2019-09-18 05:52:49','2019-09-18 05:52:49'),(14,1,'timg000021.jpg','uploads/timg000021.jpg','2019-09-18 05:54:08','2019-09-18 05:54:08'),(15,1,'timg000011.jpg','uploads/timg000011.jpg','2019-09-18 05:54:09','2019-09-18 05:54:09'),(16,1,'timg000031.jpg','uploads/timg000031.jpg','2019-09-18 05:54:09','2019-09-18 05:54:09'),(17,1,'timg000032.jpg','uploads/timg000032.jpg','2019-09-18 05:54:46','2019-09-18 05:54:46'),(18,1,'timg000012.jpg','uploads/timg000012.jpg','2019-09-18 05:54:46','2019-09-18 05:54:46'),(19,1,'timg000022.jpg','uploads/timg000022.jpg','2019-09-18 05:54:47','2019-09-18 05:54:47'),(20,1,'3137347226_1284556602.jpg','uploads/3137347226_1284556602.jpg','2019-09-18 06:06:01','2019-09-18 06:06:01'),(21,1,'3138839010_1284556602_400x4002.jpg','uploads/3138839010_1284556602_400x4002.jpg','2019-09-18 06:07:07','2019-09-18 06:07:07'),(22,1,'c27d32fba00ce36b!400x400_big1.jpg','uploads/c27d32fba00ce36b!400x400_big1.jpg','2019-09-18 06:07:14','2019-09-18 06:07:14'),(23,1,'timg000033.jpg','uploads/timg000033.jpg','2019-09-18 06:07:15','2019-09-18 06:07:15'),(24,1,'timg000034.jpg','uploads/timg000034.jpg','2019-09-18 06:07:23','2019-09-18 06:07:23'),(25,1,'timg000013.jpg','uploads/timg000013.jpg','2019-09-18 06:07:24','2019-09-18 06:07:24'),(26,1,'timg000023.jpg','uploads/timg000023.jpg','2019-09-18 06:07:24','2019-09-18 06:07:24'),(27,1,'3137347226_12845566021.jpg','uploads/3137347226_12845566021.jpg','2019-09-18 06:08:44','2019-09-18 06:08:44'),(28,1,'3138839010_1284556602_400x4003.jpg','uploads/3138839010_1284556602_400x4003.jpg','2019-09-18 06:08:49','2019-09-18 06:08:49'),(29,1,'3137347226_12845566022.jpg','uploads/3137347226_12845566022.jpg','2019-09-18 06:08:55','2019-09-18 06:08:55'),(30,1,'3138839010_1284556602_400x4004.jpg','uploads/3138839010_1284556602_400x4004.jpg','2019-09-18 06:08:56','2019-09-18 06:08:56'),(31,1,'3138863203_1284556602_400x4003.jpg','uploads/3138863203_1284556602_400x4003.jpg','2019-09-18 06:08:56','2019-09-18 06:08:56'),(32,1,'3138869189_12845566024.jpg','uploads/3138869189_12845566024.jpg','2019-09-18 06:08:57','2019-09-18 06:08:57'),(33,1,'3138863203_1284556602.jpg','uploads/3138863203_1284556602.jpg','2019-09-18 06:08:57','2019-09-18 06:08:57'),(34,1,'3138881109_12845566021.jpg','uploads/3138881109_12845566021.jpg','2019-09-18 06:08:58','2019-09-18 06:08:58'),(35,1,'3137347226_12845566023.jpg','uploads/3137347226_12845566023.jpg','2019-09-18 06:14:01','2019-09-18 06:14:01'),(36,1,'7d7ee11ba7b046e0!400x400_big1.jpg','uploads/7d7ee11ba7b046e0!400x400_big1.jpg','2019-09-18 06:15:08','2019-09-18 06:15:08'),(37,1,'45899001.png','uploads/45899001.png','2019-09-18 06:15:08','2019-09-18 06:15:08'),(38,1,'3137347226_12845566024.jpg','uploads/3137347226_12845566024.jpg','2019-09-18 12:17:11','2019-09-18 12:17:11'),(39,1,'3138839010_1284556602_400x4005.jpg','uploads/3138839010_1284556602_400x4005.jpg','2019-09-18 12:17:11','2019-09-18 12:17:11'),(40,1,'3138839010_1284556602_400x4006.jpg','uploads/3138839010_1284556602_400x4006.jpg','2019-09-18 12:17:21','2019-09-18 12:17:21'),(41,1,'3137347226_12845566025.jpg','uploads/3137347226_12845566025.jpg','2019-09-18 12:17:21','2019-09-18 12:17:21'),(42,1,'3138863203_12845566021.jpg','uploads/3138863203_12845566021.jpg','2019-09-18 12:20:39','2019-09-18 12:20:39'),(43,1,'3138863203_1284556602_400x4004.jpg','uploads/3138863203_1284556602_400x4004.jpg','2019-09-18 12:20:39','2019-09-18 12:20:39'),(44,1,'3138869189_12845566025.jpg','uploads/3138869189_12845566025.jpg','2019-09-18 12:20:40','2019-09-18 12:20:40'),(45,1,'7d7ee11ba7b046e0!400x400_big2.jpg','uploads/7d7ee11ba7b046e0!400x400_big2.jpg','2019-09-18 12:21:10','2019-09-18 12:21:10'),(46,1,'3137347226_12845566026.jpg','uploads/3137347226_12845566026.jpg','2019-09-18 12:28:04','2019-09-18 12:28:04'),(47,1,'3137347226_12845566027.jpg','uploads/3137347226_12845566027.jpg','2019-09-18 12:29:25','2019-09-18 12:29:25'),(48,1,'45899002.png','uploads/45899002.png','2019-09-18 14:13:52','2019-09-18 14:13:52'),(49,1,'7d7ee11ba7b046e0!400x400_big3.jpg','uploads/7d7ee11ba7b046e0!400x400_big3.jpg','2019-09-18 14:13:53','2019-09-18 14:13:53'),(50,1,'3137347226_12845566028.jpg','uploads/3137347226_12845566028.jpg','2019-09-18 14:13:53','2019-09-18 14:13:53'),(51,1,'3138839010_1284556602_400x4007.jpg','uploads/3138839010_1284556602_400x4007.jpg','2019-09-18 14:13:54','2019-09-18 14:13:54'),(52,1,'云盒子_文件_回收站.png','uploads/云盒子_文件_回收站.png','2019-09-18 14:15:11','2019-09-18 14:15:11'),(53,1,'QQ图片20190917235842.png','uploads/QQ图片20190917235842.png','2019-09-18 14:15:54','2019-09-18 14:15:54'),(54,1,'QQ图片20190918000242.png','uploads/QQ图片20190918000242.png','2019-09-18 14:17:21','2019-09-18 14:17:21'),(55,1,'7d7ee11ba7b046e0!400x400_big4.jpg','uploads/7d7ee11ba7b046e0!400x400_big4.jpg','2019-09-18 15:08:45','2019-09-18 15:08:45'),(56,1,'45899003.png','uploads/45899003.png','2019-09-18 15:08:45','2019-09-18 15:08:45'),(57,1,'3137347226_12845566029.jpg','uploads/3137347226_12845566029.jpg','2019-09-18 15:08:46','2019-09-18 15:08:46'),(58,1,'3138839010_1284556602_400x4008.jpg','uploads/3138839010_1284556602_400x4008.jpg','2019-09-18 15:08:46','2019-09-18 15:08:46'),(59,1,'3138863203_12845566022.jpg','uploads/3138863203_12845566022.jpg','2019-09-18 15:10:20','2019-09-18 15:10:20'),(60,1,'3138869189_12845566026.jpg','uploads/3138869189_12845566026.jpg','2019-09-18 15:10:21','2019-09-18 15:10:21'),(61,1,'3138881109_12845566022.jpg','uploads/3138881109_12845566022.jpg','2019-09-18 15:10:21','2019-09-18 15:10:21'),(62,1,'timg000014.jpg','uploads/timg000014.jpg','2019-09-18 15:11:20','2019-09-18 15:11:20'),(63,1,'timg000024.jpg','uploads/timg000024.jpg','2019-09-18 15:11:21','2019-09-18 15:11:21'),(64,1,'timg000035.jpg','uploads/timg000035.jpg','2019-09-18 15:11:21','2019-09-18 15:11:21'),(65,1,'3137347226_128455660210.jpg','uploads/3137347226_128455660210.jpg','2019-09-18 15:11:58','2019-09-18 15:11:58'),(66,1,'3138839010_1284556602_400x4009.jpg','uploads/3138839010_1284556602_400x4009.jpg','2019-09-18 15:11:59','2019-09-18 15:11:59'),(67,1,'3138863203_1284556602_400x4005.jpg','uploads/3138863203_1284556602_400x4005.jpg','2019-09-18 15:11:59','2019-09-18 15:11:59'),(68,1,'3138863203_12845566023.jpg','uploads/3138863203_12845566023.jpg','2019-09-18 15:12:00','2019-09-18 15:12:00'),(69,1,'3138869189_12845566027.jpg','uploads/3138869189_12845566027.jpg','2019-09-18 15:12:00','2019-09-18 15:12:00'),(70,1,'3138881109_12845566023.jpg','uploads/3138881109_12845566023.jpg','2019-09-18 15:12:01','2019-09-18 15:12:01'),(71,1,'3139632369_12845566022.jpg','uploads/3139632369_12845566022.jpg','2019-09-18 15:12:01','2019-09-18 15:12:01'),(72,1,'QQ图片20190917235742.png','uploads/QQ图片20190917235742.png','2019-09-18 15:15:24','2019-09-18 15:15:24'),(73,1,'QQ图片20190917235657.png','uploads/QQ图片20190917235657.png','2019-09-18 15:15:25','2019-09-18 15:15:25'),(74,1,'QQ图片20190917235716.png','uploads/QQ图片20190917235716.png','2019-09-18 15:15:25','2019-09-18 15:15:25'),(75,1,'QQ图片20190917235752.png','uploads/QQ图片20190917235752.png','2019-09-18 15:15:26','2019-09-18 15:15:26'),(76,1,'QQ图片20190917235802.png','uploads/QQ图片20190917235802.png','2019-09-18 15:15:26','2019-09-18 15:15:26'),(77,1,'QQ图片201909172358421.png','uploads/QQ图片201909172358421.png','2019-09-18 15:15:27','2019-09-18 15:15:27'),(78,1,'QQ图片20190917235915.png','uploads/QQ图片20190917235915.png','2019-09-18 15:15:28','2019-09-18 15:15:28'),(79,1,'QQ图片20190918000032.png','uploads/QQ图片20190918000032.png','2019-09-18 15:15:28','2019-09-18 15:15:28'),(80,1,'QQ图片20190918000100.png','uploads/QQ图片20190918000100.png','2019-09-18 15:15:29','2019-09-18 15:15:29'),(81,1,'QQ图片20190918000114.png','uploads/QQ图片20190918000114.png','2019-09-18 15:15:29','2019-09-18 15:15:29'),(82,1,'QQ图片20190918000130.png','uploads/QQ图片20190918000130.png','2019-09-18 15:15:29','2019-09-18 15:15:29'),(83,1,'QQ图片20190918000153.png','uploads/QQ图片20190918000153.png','2019-09-18 15:15:30','2019-09-18 15:15:30'),(84,1,'QQ图片20190918000219.png','uploads/QQ图片20190918000219.png','2019-09-18 15:15:31','2019-09-18 15:15:31'),(85,1,'QQ图片201909180002421.png','uploads/QQ图片201909180002421.png','2019-09-18 15:15:31','2019-09-18 15:15:31'),(86,1,'QQ图片20190918000305.png','uploads/QQ图片20190918000305.png','2019-09-18 15:15:31','2019-09-18 15:15:31'),(87,1,'QQ图片20190918000327.png','uploads/QQ图片20190918000327.png','2019-09-18 15:15:32','2019-09-18 15:15:32'),(88,1,'QQ图片20190918000356.png','uploads/QQ图片20190918000356.png','2019-09-18 15:15:32','2019-09-18 15:15:32'),(89,1,'QQ图片20190918000415.png','uploads/QQ图片20190918000415.png','2019-09-18 15:15:33','2019-09-18 15:15:33'),(90,1,'QQ图片20190918000508.png','uploads/QQ图片20190918000508.png','2019-09-18 15:15:33','2019-09-18 15:15:33'),(91,1,'QQ图片20190918000532.png','uploads/QQ图片20190918000532.png','2019-09-18 15:15:34','2019-09-18 15:15:34'),(92,1,'云盒子_IM_1.png','uploads/云盒子_IM_1.png','2019-09-18 15:15:34','2019-09-18 15:15:34'),(93,1,'云盒子_IM_2.png','uploads/云盒子_IM_2.png','2019-09-18 15:15:35','2019-09-18 15:15:35'),(94,1,'云盒子_IM_3.png','uploads/云盒子_IM_3.png','2019-09-18 15:15:35','2019-09-18 15:15:35'),(95,1,'云盒子_IM_4.png','uploads/云盒子_IM_4.png','2019-09-18 15:15:36','2019-09-18 15:15:36'),(96,1,'云盒子_IM_6.png','uploads/云盒子_IM_6.png','2019-09-18 15:15:36','2019-09-18 15:15:36'),(97,1,'云盒子_IM_5.png','uploads/云盒子_IM_5.png','2019-09-18 15:15:37','2019-09-18 15:15:37'),(98,1,'云盒子_编辑_excel文件.png','uploads/云盒子_编辑_excel文件.png','2019-09-18 15:15:37','2019-09-18 15:15:37'),(99,1,'云盒子_编辑_word文件.png','uploads/云盒子_编辑_word文件.png','2019-09-18 15:15:38','2019-09-18 15:15:38'),(100,1,'云盒子_查看_execl文件.png','uploads/云盒子_查看_execl文件.png','2019-09-18 15:15:38','2019-09-18 15:15:38'),(101,1,'云盒子_查看_pdf文件.png','uploads/云盒子_查看_pdf文件.png','2019-09-18 15:15:39','2019-09-18 15:15:39'),(102,1,'云盒子_查看_word文件.png','uploads/云盒子_查看_word文件.png','2019-09-18 15:15:39','2019-09-18 15:15:39'),(103,1,'云盒子_查看_图片文件.png','uploads/云盒子_查看_图片文件.png','2019-09-18 15:15:40','2019-09-18 15:15:40'),(104,1,'云盒子_查看_压缩文件.png','uploads/云盒子_查看_压缩文件.png','2019-09-18 15:15:40','2019-09-18 15:15:40'),(105,1,'云盒子_查看_音频文件.png','uploads/云盒子_查看_音频文件.png','2019-09-18 15:15:41','2019-09-18 15:15:41'),(106,1,'云盒子_登陆后界面.png','uploads/云盒子_登陆后界面.png','2019-09-18 15:15:41','2019-09-18 15:15:41'),(107,1,'云盒子_登陆界面.png','uploads/云盒子_登陆界面.png','2019-09-18 15:15:42','2019-09-18 15:15:42'),(108,1,'云盒子_登陆界面_弹框.png','uploads/云盒子_登陆界面_弹框.png','2019-09-18 15:15:42','2019-09-18 15:15:42'),(109,1,'云盒子_同事.png','uploads/云盒子_同事.png','2019-09-18 15:15:43','2019-09-18 15:15:43'),(110,1,'云盒子_同事_查找用户.png','uploads/云盒子_同事_查找用户.png','2019-09-18 15:15:43','2019-09-18 15:15:43'),(111,1,'云盒子_同事_工作组.png','uploads/云盒子_同事_工作组.png','2019-09-18 15:15:44','2019-09-18 15:15:44'),(112,1,'云盒子_同事_用户.png','uploads/云盒子_同事_用户.png','2019-09-18 15:15:44','2019-09-18 15:15:44'),(113,1,'云盒子_同事_用户组.png','uploads/云盒子_同事_用户组.png','2019-09-18 15:15:45','2019-09-18 15:15:45'),(114,1,'云盒子_文件_公司文档_表格方式.png','uploads/云盒子_文件_公司文档_表格方式.png','2019-09-18 15:15:45','2019-09-18 15:15:45'),(115,1,'云盒子_文件_公司文档_图标方式.png','uploads/云盒子_文件_公司文档_图标方式.png','2019-09-18 15:15:46','2019-09-18 15:15:46'),(116,1,'云盒子_文件_回收站1.png','uploads/云盒子_文件_回收站1.png','2019-09-18 15:15:46','2019-09-18 15:15:46'),(117,1,'云盒子_文件_回收站_搜索.png','uploads/云盒子_文件_回收站_搜索.png','2019-09-18 15:15:47','2019-09-18 15:15:47'),(118,1,'云盒子_文件_我的收藏.png','uploads/云盒子_文件_我的收藏.png','2019-09-18 15:15:47','2019-09-18 15:15:47'),(119,1,'云盒子_文件_我的收藏_搜索.png','uploads/云盒子_文件_我的收藏_搜索.png','2019-09-18 15:15:48','2019-09-18 15:15:48'),(120,1,'云盒子_查看_视频文件.png','uploads/云盒子_查看_视频文件.png','2019-09-18 15:15:48','2019-09-18 15:15:48'),(121,1,'3137347226_128455660211.jpg','uploads/3137347226_128455660211.jpg','2019-09-18 18:46:13','2019-09-18 18:46:13');
/*!40000 ALTER TABLE `site_system_uploadfile` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-10-27 21:19:28
