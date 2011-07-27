-- MySQL dump 10.13  Distrib 5.1.54, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: spritech_db
-- ------------------------------------------------------
-- Server version	5.1.54-1ubuntu4

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
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `data` varchar(256) NOT NULL,
  `dialog` varchar(48) NOT NULL,
  `dt_opened` datetime NOT NULL,
  `dt_sent` datetime NOT NULL,
  `title` varchar(128) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `team_id` (`team_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (14,0,0,'{\"projectId\":\"013\"}','round_started','2011-07-24 14:30:20','2011-07-24 14:30:20','New Round:  Seeks the Circuit Bent Casio'),(13,0,32,'{\"projectId\":\"04\"}','round_started','2011-07-23 20:16:35','2011-07-23 20:16:35','New Round: Team Hooligan Seeks the Cupcake Car'),(12,0,32,'{\"projectId\":\"03\"}','round_started','2011-07-23 20:14:09','2011-07-23 20:14:09','New Round: Team Hooligan Seeks the Coke and Mentos'),(15,0,0,'{\"projectId\":\"09\"}','round_started','2011-07-24 15:00:47','2011-07-24 15:00:47','New Round:  Seeks the Fire-Breathing Red Green');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `part_rounds`
--

DROP TABLE IF EXISTS `part_rounds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `part_rounds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team_id` int(11) NOT NULL,
  `part_id` int(11) NOT NULL,
  `dt_found` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ct` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `team_id` (`team_id`,`part_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `part_rounds`
--

LOCK TABLES `part_rounds` WRITE;
/*!40000 ALTER TABLE `part_rounds` DISABLE KEYS */;
/*!40000 ALTER TABLE `part_rounds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `part_users`
--

DROP TABLE IF EXISTS `part_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `part_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `part_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `dt_found` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ct` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `part_id` (`part_id`,`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `part_users`
--

LOCK TABLES `part_users` WRITE;
/*!40000 ALTER TABLE `part_users` DISABLE KEYS */;
INSERT INTO `part_users` VALUES (8,1,8,'2011-06-24 05:07:33',2),(7,2,8,'2011-06-24 05:01:31',1);
/*!40000 ALTER TABLE `part_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parts`
--

DROP TABLE IF EXISTS `parts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `desc` varchar(256) NOT NULL,
  `asset_thumb_url` varchar(128) NOT NULL,
  `qr_value` varchar(12) NOT NULL,
  `meta` varchar(8) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `qr_value` (`qr_value`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parts`
--

LOCK TABLES `parts` WRITE;
/*!40000 ALTER TABLE `parts` DISABLE KEYS */;
INSERT INTO `parts` VALUES (1,'Air Tank','And you thought we couldn\'t fit any more hot air into this game.  Boy, were you wrong!','airtank','123',''),(2,'Ball','It\'s all fun and games until someone loses a ball.  And now it\'s yours!','ball','234',''),(4,'Bath Tub','Empty Description','bathtub','12456',''),(5,'Battery','Empty Description','battery','47323',''),(6,'Bowling Ball','Empty Description','bowlingball','17178',''),(7,'Cardboard','Empty Description','cardboard','85319',''),(8,'Casio Keyboard','Empty Description','keyboard','21495',''),(9,'Chess Board','Empty Description','chessboard','78802',''),(10,'Chicken Wire','Empty Description','chickenwire','71719',''),(11,'Cigar Box','Empty Description','cigarbox','42041',''),(12,'Circuit Board','Empty Description','circuitboard','95559',''),(13,'CO2 Tank','Empty Description','co2','89348',''),(14,'Coke','Empty Description','coke','76966',''),(15,'Duct Tape','Empty Description','ducttape','85951',''),(16,'Fabric','Empty Description','fabric','15626',''),(17,'Flavoring','Empty Description','flavoring','18383',''),(18,'Foam','Empty Description','foam','25903',''),(19,'Gear','Empty Description','gear','13634',''),(20,'Go Kart','Empty Description','gokart','40795',''),(21,'Kids Power Wheel','Empty Description','powerwheels','54590',''),(22,'LED','Empty Description','LED','12655',''),(23,'Lego Blocks','Empty Description','legoblock','76734',''),(24,'Lego Mindstorm','Empty Description','legomindstorm','48346',''),(25,'Mentos','Empty Description','mentos','51875',''),(26,'Metal','Empty Description','metal','78073',''),(27,'Motor','Empty Description','motor','57758',''),(28,'Paper','Empty Description','paper','17689',''),(29,'Pipe','Empty Description','pipe','18799',''),(30,'Plastic','Empty Description','plastic','83983',''),(31,'Potentiometer','Empty Description','pot','85318',''),(32,'Printer','Empty Description','printer','41937',''),(33,'Propane','Empty Description','propane','46555',''),(34,'Propeller','Empty Description','propeller','90026',''),(35,'Pump','Empty Description','pump','95954',''),(36,'Solder','Empty Description','solder','81306',''),(37,'Speaker','Empty Description','speaker','97847',''),(38,'Spring','Empty Description','spring','47191',''),(39,'String','Empty Description','string','33418',''),(40,'Sugar','Empty Description','sugar','96605',''),(41,'Teddy Bear','Empty Description','teddybear','64700',''),(42,'Tubing','Empty Description','tubing','89215',''),(43,'Twinkie','Empty Description','twinkies','21078',''),(44,'Water','Empty Description','water','50892',''),(45,'Wire','Empty Description','wire','51460',''),(46,'Wood','Empty Description','wood','26237',''),(47,'Members','Empty Description','','68408',''),(48,'Property','Empty Description','','28418',''),(49,'Community','Empty Description','','86361',''),(50,'Arduino','Empty Description','circuitboard','92032',''),(51,'Air Cannon','Empty Description','','58045','');
/*!40000 ALTER TABLE `parts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parts_projects`
--

DROP TABLE IF EXISTS `parts_projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parts_projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `part_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `part_id` (`part_id`,`project_id`)
) ENGINE=MyISAM AUTO_INCREMENT=101 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parts_projects`
--

LOCK TABLES `parts_projects` WRITE;
/*!40000 ALTER TABLE `parts_projects` DISABLE KEYS */;
INSERT INTO `parts_projects` VALUES (26,27,2),(25,12,2),(24,46,1),(23,26,1),(22,19,1),(21,6,1),(20,4,1),(68,46,12),(67,39,12),(66,11,12),(80,32,15),(79,12,15),(78,50,15),(27,30,2),(28,46,2),(29,14,3),(30,25,3),(31,5,4),(32,16,4),(33,26,4),(34,27,4),(35,26,5),(36,35,5),(37,42,5),(38,44,5),(39,2,6),(40,5,6),(41,12,6),(42,19,6),(43,26,6),(44,27,6),(45,38,6),(46,1,7),(47,7,7),(48,28,7),(49,42,7),(50,51,8),(51,10,8),(52,18,8),(53,20,8),(54,43,8),(55,10,9),(56,15,9),(57,29,9),(58,33,9),(59,46,9),(60,9,10),(61,23,10),(62,24,10),(63,12,11),(64,22,11),(65,36,11),(69,8,13),(70,31,13),(71,36,13),(72,45,13),(73,5,14),(74,12,14),(75,26,14),(76,27,14),(77,34,14),(81,37,15),(82,46,15),(83,13,16),(84,17,16),(85,40,16),(86,44,16),(87,16,17),(88,18,17),(89,42,17),(90,5,19),(91,12,19),(92,19,19),(93,21,19),(94,27,19),(95,50,20),(96,37,20),(97,41,20),(98,49,18),(99,47,18),(100,48,18);
/*!40000 ALTER TABLE `parts_projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parts_rounds`
--

DROP TABLE IF EXISTS `parts_rounds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parts_rounds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `round_id` int(11) NOT NULL,
  `part_id` int(11) NOT NULL,
  `dt_found` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ct` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `team_id` (`round_id`,`part_id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parts_rounds`
--

LOCK TABLES `parts_rounds` WRITE;
/*!40000 ALTER TABLE `parts_rounds` DISABLE KEYS */;
INSERT INTO `parts_rounds` VALUES (33,29,46,'2011-07-23 16:08:42',1),(34,30,16,'2011-07-23 17:39:57',1),(26,26,36,'2011-07-23 04:39:21',1),(25,26,31,'2011-07-23 04:39:10',1),(24,26,8,'2011-07-23 04:38:54',1),(23,26,50,'2011-07-23 04:38:08',2),(32,29,37,'2011-07-23 16:08:29',1),(31,29,32,'2011-07-23 16:08:08',1),(30,29,12,'2011-07-23 16:07:52',1),(29,29,50,'2011-07-23 16:07:19',1),(28,26,45,'2011-07-23 04:40:06',1),(27,26,51,'2011-07-23 04:39:55',1),(35,30,42,'2011-07-23 18:19:29',1),(36,30,18,'2011-07-23 18:19:44',1);
/*!40000 ALTER TABLE `parts_rounds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parts_users`
--

DROP TABLE IF EXISTS `parts_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parts_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `part_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `dt_found` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ct` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `part_id` (`part_id`,`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parts_users`
--

LOCK TABLES `parts_users` WRITE;
/*!40000 ALTER TABLE `parts_users` DISABLE KEYS */;
INSERT INTO `parts_users` VALUES (8,1,8,'2011-06-24 04:07:33',4),(7,2,8,'2011-06-24 04:01:31',2),(9,1,11,'2011-06-29 22:12:56',1),(10,1,13,'2011-06-30 00:44:36',1),(11,1,16,'2011-07-04 13:28:11',1),(49,32,18,'2011-07-23 16:08:08',1),(48,12,18,'2011-07-23 16:07:52',1),(47,45,18,'2011-07-23 04:40:06',1),(46,51,18,'2011-07-23 04:39:55',1),(45,36,18,'2011-07-23 04:39:21',1),(44,31,18,'2011-07-23 04:39:10',1),(43,8,18,'2011-07-23 04:38:54',1),(42,50,18,'2011-07-23 04:38:08',3),(50,37,18,'2011-07-23 16:08:29',1),(51,46,18,'2011-07-23 16:08:42',1),(52,16,18,'2011-07-23 17:39:57',1),(53,42,18,'2011-07-23 18:19:29',1),(54,18,18,'2011-07-23 18:19:44',1);
/*!40000 ALTER TABLE `parts_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `desc` varchar(512) NOT NULL,
  `asset_thumb_url` varchar(128) NOT NULL,
  `asset_id` varchar(128) NOT NULL,
  `ar_marker_id` varchar(8) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (1,'Life-Sized Mouse Trap','Empty Description','','mousetrap',''),(2,'Maker Bot','Empty Description','','maker_bot',''),(3,'Coke and Mentos','Empty Description','','coke_mentos',''),(4,'Cupcake Car','Empty Description','','cupcake_car',''),(5,'Waterfall Swing','Empty Description','','waterfall_swing',''),(6,'FIRST Robot','Empty Description','','first_robot',''),(7,'Compressed Air Rocket','Empty Description','','air_rocket',''),(8,'Twinkie Car','Empty Description','','twinkie_car',''),(9,'Fire-Breathing Red Green','Empty Description','','red_green',''),(10,'Giant Lego Chess','Empty Description','','lego_chess',''),(11,'Learn to Solder Badge','Empty Description','','solder_badge',''),(12,'Cigar Box Guitar','Empty Description','','cigar_box_guitar',''),(13,'Circuit Bent Casio','Empty Description','','circuit_bent_casio',''),(14,'Quadcopter','Empty Description','','quadcopter',''),(15,'Chronotune','Empty Description','','chronotune',''),(16,'Open Soda','Empty Description','','open_soda',''),(17,'Gigantic Puppet Head','Empty Description','','gigantic_puppet_head',''),(18,'Hackerspace','Empty Description','','hackerspace',''),(19,'Power Wheels Racer','Empty Description','','power_wheels',''),(20,'Talking Teddy Bear','Empty Description','','teddy_bear','');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects_users`
--

DROP TABLE IF EXISTS `projects_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `dt_found` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`,`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects_users`
--

LOCK TABLES `projects_users` WRITE;
/*!40000 ALTER TABLE `projects_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `projects_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rounds`
--

DROP TABLE IF EXISTS `rounds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rounds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `dt_started` datetime NOT NULL,
  `dt_completed` datetime NOT NULL,
  `dt_canceled` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `team_id` (`team_id`,`project_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rounds`
--

LOCK TABLES `rounds` WRITE;
/*!40000 ALTER TABLE `rounds` DISABLE KEYS */;
INSERT INTO `rounds` VALUES (33,32,0,13,'2011-07-23 19:10:08','0000-00-00 00:00:00','2011-07-23 20:15:43'),(32,32,0,3,'2011-07-23 18:44:57','0000-00-00 00:00:00','2011-07-23 19:08:42'),(31,32,0,4,'2011-07-23 15:46:36','0000-00-00 00:00:00','2011-07-23 18:44:11'),(30,32,0,17,'2011-07-23 13:12:06','2011-07-23 15:19:44','0000-00-00 00:00:00'),(29,32,0,15,'2011-07-23 02:52:48','2011-07-23 13:08:42','0000-00-00 00:00:00'),(28,32,0,15,'2011-07-23 02:51:40','0000-00-00 00:00:00','2011-07-23 02:52:41'),(27,32,0,12,'2011-07-23 02:37:47','0000-00-00 00:00:00','2011-07-23 02:51:31'),(26,32,0,13,'2011-07-23 01:18:55','2011-07-23 01:40:06','0000-00-00 00:00:00'),(25,32,0,3,'2011-07-23 00:41:00','0000-00-00 00:00:00','2011-07-23 01:18:25'),(34,32,0,7,'2011-07-23 19:35:29','0000-00-00 00:00:00','0000-00-00 00:00:00'),(35,32,0,6,'2011-07-23 19:39:17','0000-00-00 00:00:00','0000-00-00 00:00:00'),(36,32,0,10,'2011-07-23 19:39:59','0000-00-00 00:00:00','0000-00-00 00:00:00'),(37,32,0,6,'2011-07-23 19:49:52','0000-00-00 00:00:00','0000-00-00 00:00:00'),(38,32,0,3,'2011-07-23 20:14:09','0000-00-00 00:00:00','0000-00-00 00:00:00'),(39,32,0,4,'2011-07-23 20:16:35','0000-00-00 00:00:00','0000-00-00 00:00:00'),(40,0,0,13,'2011-07-24 14:30:20','0000-00-00 00:00:00','0000-00-00 00:00:00'),(41,0,0,9,'2011-07-24 15:00:47','0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `rounds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sprites`
--

DROP TABLE IF EXISTS `sprites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sprites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(55) NOT NULL,
  `data` varchar(128) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sprites`
--

LOCK TABLES `sprites` WRITE;
/*!40000 ALTER TABLE `sprites` DISABLE KEYS */;
/*!40000 ALTER TABLE `sprites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sprites_users`
--

DROP TABLE IF EXISTS `sprites_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sprites_users` (
  `user_id` int(11) NOT NULL,
  `sprite_id` int(11) NOT NULL,
  KEY `user_id` (`user_id`,`sprite_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sprites_users`
--

LOCK TABLES `sprites_users` WRITE;
/*!40000 ALTER TABLE `sprites_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `sprites_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teams`
--

DROP TABLE IF EXISTS `teams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(55) NOT NULL,
  `dt_start` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dt_stop` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teams`
--

LOCK TABLES `teams` WRITE;
/*!40000 ALTER TABLE `teams` DISABLE KEYS */;
INSERT INTO `teams` VALUES (31,'Our Team, Yo','0000-00-00 00:00:00','0000-00-00 00:00:00'),(32,'Team Hooligan','0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `teams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(55) NOT NULL,
  `role` varchar(5) NOT NULL DEFAULT 'user',
  `team_id` int(11) NOT NULL,
  `dt_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dt_last_active` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ct_active` int(11) NOT NULL,
  `current_round_id` int(11) DEFAULT NULL,
  `ar_marker_id` varchar(8) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `team_id` (`team_id`),
  KEY `current_round_id` (`current_round_id`,`ar_marker_id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (18,'bananabot','admin',32,'2011-07-04 12:40:34','2011-07-23 23:16:35',1,39,'45115tyd','9885e0c2971fdc37b0c64d5bdb4c052f1d70ebf1'),(24,'george','user',32,'2011-07-23 00:27:08','2011-07-23 23:16:35',1,39,'00499zoy','ac38fb32bdcd94887ef9568b378df02d207efd1c'),(25,'boingy','user',0,'2011-07-24 14:12:04','2011-07-24 17:12:04',1,NULL,'28303tmw','ac38fb32bdcd94887ef9568b378df02d207efd1c'),(23,'simpleton','user',32,'2011-07-23 00:26:56','2011-07-23 23:16:35',1,39,'10039onz','ac38fb32bdcd94887ef9568b378df02d207efd1c'),(26,'boingy2','user',0,'2011-07-24 14:21:20','2011-07-24 17:21:20',1,NULL,'41809kyh','4c4968a213631d5441c39e00f02a0d47d11f254b'),(27,'boingy3','user',0,'2011-07-24 14:22:46','2011-07-24 17:22:46',1,NULL,'18677eoy','ac38fb32bdcd94887ef9568b378df02d207efd1c'),(28,'boingy4','user',0,'2011-07-24 14:23:18','2011-07-24 17:23:18',1,NULL,'71815oyd','ac38fb32bdcd94887ef9568b378df02d207efd1c'),(29,'username','user',0,'2011-07-24 14:54:37','2011-07-24 17:54:37',1,NULL,'62090dnm','ac38fb32bdcd94887ef9568b378df02d207efd1c'),(30,'Binky','user',0,'2011-07-24 14:56:43','2011-07-24 18:56:43',1,NULL,'54508rzn','ac38fb32bdcd94887ef9568b378df02d207efd1c'),(31,'tester','user',0,'2011-07-25 12:47:38','2011-07-25 16:47:38',1,NULL,'65131als','ac38fb32bdcd94887ef9568b378df02d207efd1c'),(32,'testy123','user',0,'2011-07-25 15:11:42','2011-07-25 19:11:42',1,NULL,'92721fqf','ac38fb32bdcd94887ef9568b378df02d207efd1c'),(33,'donkeyfart','user',0,'2011-07-25 23:45:04','2011-07-26 03:45:04',1,NULL,'04151wgd','ac38fb32bdcd94887ef9568b378df02d207efd1c');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2011-07-27 13:25:06
