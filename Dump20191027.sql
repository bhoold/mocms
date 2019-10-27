CREATE DATABASE  IF NOT EXISTS `mocms` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `mocms`;
-- MySQL dump 10.13  Distrib 8.0.15, for Win64 (x86_64)
--
-- Host: localhost    Database: mocms
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
-- Table structure for table `site_streamer`
--

DROP TABLE IF EXISTS `site_streamer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `site_streamer` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `userid` mediumint(8) DEFAULT NULL,
  `username` varchar(15) DEFAULT '',
  `regtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `regip` char(15) DEFAULT NULL,
  `state` int(1) NOT NULL DEFAULT '-1',
  `idcardpic1` varchar(200) DEFAULT NULL,
  `idcardpic2` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_streamer`
--

LOCK TABLES `site_streamer` WRITE;
/*!40000 ALTER TABLE `site_streamer` DISABLE KEYS */;
INSERT INTO `site_streamer` VALUES (1,49,'gsz','2019-07-26 12:21:03','::1',1,'./uploads/7d7ee11ba7b046e0!400x400_big3.jpg','./uploads/4589900.png'),(2,16,'sdghsssd','2019-07-26 14:00:39','::1',1,'./uploads/45899001.png','./uploads/7d7ee11ba7b046e0!400x400_big4.jpg'),(3,15,'sdghs','2019-07-26 15:52:26','::1',1,'./uploads/3138863203_1284556602_400x4002.jpg','./uploads/7d7ee11ba7b046e0!400x400_big5.jpg'),(4,14,'sdgh','2019-07-26 15:54:09','::1',1,'./uploads/7d7ee11ba7b046e0!400x400_big6.jpg','./uploads/45899002.png');
/*!40000 ALTER TABLE `site_streamer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_streamroom`
--

DROP TABLE IF EXISTS `site_streamroom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `site_streamroom` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `streamerid` mediumint(8) DEFAULT NULL,
  `userid` mediumint(8) DEFAULT NULL,
  `username` varchar(15) DEFAULT '',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` char(15) DEFAULT NULL,
  `state` int(1) NOT NULL DEFAULT '1',
  `title` varchar(100) DEFAULT '',
  `notice` varchar(500) DEFAULT '',
  `code` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_streamroom`
--

LOCK TABLES `site_streamroom` WRITE;
/*!40000 ALTER TABLE `site_streamroom` DISABLE KEYS */;
INSERT INTO `site_streamroom` VALUES (12,4,14,'sdgh','2019-07-28 03:59:20','::1',1,'国服第二','最好看的','4uu14'),(11,1,49,'gsz','2019-07-28 03:57:01','::1',1,'大笨猫','快来看我直播了','1uu49');
/*!40000 ALTER TABLE `site_streamroom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_systemlog`
--

DROP TABLE IF EXISTS `site_systemlog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `site_systemlog` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(15) DEFAULT '',
  `useragent` varchar(300) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` char(15) DEFAULT NULL,
  `content` text,
  `module` varchar(45) DEFAULT NULL,
  `userid` mediumint(8) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_systemlog`
--

LOCK TABLES `site_systemlog` WRITE;
/*!40000 ALTER TABLE `site_systemlog` DISABLE KEYS */;
INSERT INTO `site_systemlog` VALUES (9,'gsz','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36','2019-07-26 09:39:50','::1','登录','Login',NULL),(8,'admin','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36','2019-07-26 09:38:29','::1','登录','Login',NULL),(7,'admin','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36','2019-07-26 09:33:58','::1','登出','Login',NULL),(5,'admin','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36','2019-07-26 09:01:56','::1','登出','Login',NULL),(6,'admin','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36','2019-07-26 09:02:02','::1','登录','Login',NULL),(10,'admin','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36','2019-07-27 06:44:30','::1','登录','Login',NULL),(11,'admin','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36','2019-07-27 19:48:44','::1','登录','Login',NULL),(12,'admin','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36','2019-07-28 02:55:58','::1','登录','Login',NULL),(13,'admin','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36','2019-07-28 04:09:47','::1','登录','Login',NULL),(14,'admin','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36','2019-07-28 08:26:33','::1','登录','Login',NULL),(15,'admin','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36','2019-07-28 14:37:26','::1','登录','Login',NULL),(16,'admin','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36','2019-07-29 05:01:00','::1','登录','Login',NULL),(17,'admin','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36','2019-07-29 05:51:02','::1','登录','Login',NULL),(18,'admin','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36','2019-07-29 05:52:27','::1','登录','Login',NULL),(19,'admin','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36','2019-07-29 11:32:43','::1','登录','Login',NULL),(20,'admin','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36','2019-07-29 14:53:15','::1','登录','Login',NULL),(21,'admin','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36','2019-07-30 05:38:14','::1','登录','Login',NULL),(22,'admin','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36','2019-07-31 05:50:30','::1','登录','Login',NULL),(23,'admin','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36','2019-07-31 13:48:24','::1','登录','Login',NULL),(24,'admin','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36','2019-08-01 09:35:55','::1','登录','Login',NULL),(25,'admin','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36','2019-08-02 06:48:16','::1','登录','Login',NULL),(26,'admin','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36','2019-08-15 03:52:32','::1','登录','Login',NULL),(27,'admin','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.70 Safari/537.36','2019-10-27 12:42:18','::1','登录','Login',NULL);
/*!40000 ALTER TABLE `site_systemlog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_systemuser`
--

DROP TABLE IF EXISTS `site_systemuser`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `site_systemuser` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '',
  `state` int(1) NOT NULL DEFAULT '-1',
  `regip` char(15) NOT NULL DEFAULT '',
  `regtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastloginip` char(15) NOT NULL DEFAULT '',
  `lastlogintime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_systemuser`
--

LOCK TABLES `site_systemuser` WRITE;
/*!40000 ALTER TABLE `site_systemuser` DISABLE KEYS */;
INSERT INTO `site_systemuser` VALUES (1,'admin','ffe317ecad2405070e6f5ffefb3a38a5',1,'::1','2019-07-26 05:33:26','','2019-07-26 05:33:26'),(2,'raven','ffe317ecad2405070e6f5ffefb3a38a5',1,'::1','2019-07-26 05:35:27','','2019-07-26 05:35:27'),(3,'guest','ffe317ecad2405070e6f5ffefb3a38a5',0,'::1','2019-07-26 05:43:21','','2019-07-26 06:43:26');
/*!40000 ALTER TABLE `site_systemuser` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_users`
--

DROP TABLE IF EXISTS `site_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `site_users` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '',
  `sex` int(1) NOT NULL DEFAULT '-1',
  `email` varchar(32) NOT NULL DEFAULT '',
  `state` int(1) NOT NULL DEFAULT '-1',
  `regip` char(15) NOT NULL DEFAULT '',
  `regtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastloginip` char(15) NOT NULL DEFAULT '',
  `lastlogintime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `createbyadmin` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_users`
--

LOCK TABLES `site_users` WRITE;
/*!40000 ALTER TABLE `site_users` DISABLE KEYS */;
INSERT INTO `site_users` VALUES (1,'s','s',-1,'',1,'','2019-07-16 14:18:11','','2019-07-16 14:18:11',0),(2,'test','test',-1,'',1,'::1','2019-07-16 14:21:43','','2019-07-16 14:21:43',0),(3,'test2','825cc0580b95cf663ec288804b37e75b',-1,'',1,'::1','2019-07-16 14:49:30','','2019-07-16 14:49:30',0),(4,'test33','2eed7d13789c6cf1e14133672eb517e3',0,'sd@qq.com',1,'::1','2019-07-16 14:56:19','','2019-07-16 14:56:19',0),(5,'sdf','825cc0580b95cf663ec288804b37e75b',-1,'',1,'::1','2019-07-16 14:57:25','','2019-07-16 14:57:25',0),(6,'sdfsdfsd','3a58fc90a1fb9b8c142dad219d0ba73d',-1,'',1,'::1','2019-07-16 15:04:41','','2019-07-16 15:04:41',0),(7,'dshfgh','7799a914e9ec370fb39d9689362c0e1f',0,'',0,'::1','2019-07-16 15:09:47','','2019-07-19 16:01:12',0),(8,'ssssddddd','ffe317ecad2405070e6f5ffefb3a38a5',-1,'',1,'::1','2019-07-16 16:12:04','','2019-07-27 06:45:06',0),(9,'sy','3225ffe7ddb0df7d5ceedccdc2a76534',-1,'sds@qq.com',1,'::1','2019-07-16 16:21:05','','2019-07-16 16:21:05',0),(14,'sdgh','ffe317ecad2405070e6f5ffefb3a38a5',0,'s@q.com',1,'::1','2019-07-16 17:35:45','','2019-07-26 15:53:52',0),(15,'sdghs','ffe317ecad2405070e6f5ffefb3a38a5',0,'s@q.coms',1,'::1','2019-07-16 17:36:53','','2019-07-26 15:51:51',0),(16,'sdghsssd','ffe317ecad2405070e6f5ffefb3a38a5',0,'s@q.comsd',1,'::1','2019-07-16 17:42:32','','2019-07-26 13:49:05',0),(49,'gsz','ffe317ecad2405070e6f5ffefb3a38a5',0,'',1,'::1','2019-07-24 17:41:51','','2019-07-24 17:41:51',1),(50,'a','ffe317ecad2405070e6f5ffefb3a38a5',-1,'',1,'::1','2019-08-02 07:56:14','','2019-08-02 07:56:14',1);
/*!40000 ALTER TABLE `site_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-10-27 20:49:34
