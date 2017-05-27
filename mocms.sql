/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : mocms

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2017-05-27 17:56:24
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `site_admin`
-- ----------------------------
DROP TABLE IF EXISTS `site_admin`;
CREATE TABLE `site_admin` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(15) NOT NULL DEFAULT '',
  `password` char(32) NOT NULL DEFAULT '',
  `email` char(32) NOT NULL DEFAULT '',
  `regip` char(15) NOT NULL DEFAULT '',
  `regdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastloginip` int(10) NOT NULL DEFAULT '0',
  `lastlogintime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of site_admin
-- ----------------------------
INSERT INTO site_admin VALUES ('1', 'aaaaaaaaa', '$2y$10$wRiTpKUCxWhP98tgREYnGuUTc', 'asdf@qq.com', '::1', '2017-04-17 04:04:22', '0', '2017-04-17 04:04:22');
INSERT INTO site_admin VALUES ('2', 'aaaaaaaaaa', '$2y$10$uXB/2ZGXLzriRWqet3NZ1.vQs', 'asdf@qq.com', '::1', '2017-04-17 04:04:32', '0', '2017-04-17 04:04:32');
INSERT INTO site_admin VALUES ('3', 'aaaaaaaaaaa', '$2y$10$bN5CwmaGMEvHE2eTdv3.kODUg', 'asd234f@qq.com', '::1', '2017-04-17 04:06:37', '0', '2017-04-18 19:55:12');
INSERT INTO site_admin VALUES ('4', 'admin', '$2y$10$cd9rYBxvpUxovjhGtkwOWu6OV', 'admin@admin.com', '::1', '2017-04-17 04:10:23', '0', '2017-04-17 04:10:23');
