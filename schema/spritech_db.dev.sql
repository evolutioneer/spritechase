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
INSERT INTO `parts` VALUES (1,'Air Tank','And you thought we couldn\'t fit any more hot air into this game.  Boy, were you wrong!','','123',''),(2,'Ball','It\'s all fun and games until someone loses a ball.  And now it\'s yours!','','234',''),(4,'Bath Tub','Empty Description','','12456',''),(5,'Battery','Empty Description','','47323',''),(6,'Bowling Ball','Empty Description','','17178',''),(7,'Cardboard','Empty Description','','85319',''),(8,'Casio Keyboard','Empty Description','','21495',''),(9,'Chess Board','Empty Description','','78802',''),(10,'Chicken Wire','Empty Description','','71719',''),(11,'Cigar Box','Empty Description','','42041',''),(12,'Circuit Board','Empty Description','','95559',''),(13,'CO2 Tank','Empty Description','','89348',''),(14,'Coke','Empty Description','','76966',''),(15,'Duct Tape','Empty Description','','85951',''),(16,'Fabric','Empty Description','','15626',''),(17,'Flavoring','Empty Description','','18383',''),(18,'Foam','Empty Description','','25903',''),(19,'Gear','Empty Description','','13634',''),(20,'Go Kart','Empty Description','','40795',''),(21,'Kids Power Wheel','Empty Description','','54590',''),(22,'LED','Empty Description','','12655',''),(23,'Lego Blocks','Empty Description','','76734',''),(24,'Lego Mindstorm','Empty Description','','48346',''),(25,'Mentos','Empty Description','','51875',''),(26,'Metal','Empty Description','','78073',''),(27,'Motor','Empty Description','','57758',''),(28,'Paper','Empty Description','','17689',''),(29,'Pipe','Empty Description','','18799',''),(30,'Plastic','Empty Description','','83983',''),(31,'Potentiometer','Empty Description','','85318',''),(32,'Printer','Empty Description','','41937',''),(33,'Propane','Empty Description','','46555',''),(34,'Propeller','Empty Description','','90026',''),(35,'Pump','Empty Description','','95954',''),(36,'Solder','Empty Description','','81306',''),(37,'Speaker','Empty Description','','97847',''),(38,'Spring','Empty Description','','47191',''),(39,'String','Empty Description','','33418',''),(40,'Sugar','Empty Description','','96605',''),(41,'Teddy Bear','Empty Description','','64700',''),(42,'Tubing','Empty Description','','89215',''),(43,'Twinkie','Empty Description','','21078',''),(44,'Water','Empty Description','','50892',''),(45,'Wire','Empty Description','','51460',''),(46,'Wood','Empty Description','','26237',''),(47,'Members','Empty Description','','68408',''),(48,'Property','Empty Description','','28418',''),(49,'Community','Empty Description','','86361',''),(50,'Arduino','Empty Description','','92032',''),(51,'Air Cannon','Empty Description','','58045','');
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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parts_rounds`
--

LOCK TABLES `parts_rounds` WRITE;
/*!40000 ALTER TABLE `parts_rounds` DISABLE KEYS */;
INSERT INTO `parts_rounds` VALUES (6,15,2,'2011-07-07 03:32:22',2),(5,15,50,'2011-07-07 03:31:22',1);
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
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parts_users`
--

LOCK TABLES `parts_users` WRITE;
/*!40000 ALTER TABLE `parts_users` DISABLE KEYS */;
INSERT INTO `parts_users` VALUES (8,1,8,'2011-06-24 05:07:33',4),(7,2,8,'2011-06-24 05:01:31',2),(9,1,11,'2011-06-29 23:12:56',1),(10,1,13,'2011-06-30 01:44:36',1),(11,1,16,'2011-07-04 14:28:11',1),(24,2,18,'2011-07-07 03:32:22',2),(23,50,18,'2011-07-07 03:31:22',1),(22,1,18,'2011-07-07 03:30:00',1),(21,51,18,'2011-07-07 03:27:06',1);
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
  `asset_3d_url` varchar(128) NOT NULL,
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
INSERT INTO `projects` VALUES (1,'Life-Sized Mouse Trap','Empty Description','','',''),(2,'Maker Bot','Empty Description','','',''),(3,'Coke and Mentos','Empty Description','','',''),(4,'Cupcake Car','Empty Description','','',''),(5,'Waterfall Swing','Empty Description','','',''),(6,'FIRST Robot','Empty Description','','',''),(7,'Compressed Air Rocket','Empty Description','','',''),(8,'Twinkie Car','Empty Description','','',''),(9,'Fire-Breathing Red Green','Empty Description','','',''),(10,'Giant Lego Chess','Empty Description','','',''),(11,'Learn to Solder Badge','Empty Description','','',''),(12,'Cigar Box Guitar','Empty Description','','',''),(13,'Circuit Bent Casio','Empty Description','','',''),(14,'Quadcopter','Empty Description','','',''),(15,'Chronotune','Empty Description','','',''),(16,'Open Soda','Empty Description','','',''),(17,'Gigantic Puppet Head','Empty Description','','',''),(18,'Hackerspace','Empty Description','','',''),(19,'Power Wheels Racer','Empty Description','','',''),(20,'Talking Teddy Bear','Empty Description','','','');
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
  `project_id` int(11) NOT NULL,
  `dt_started` datetime NOT NULL,
  `dt_completed` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `team_id` (`team_id`,`project_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rounds`
--

LOCK TABLES `rounds` WRITE;
/*!40000 ALTER TABLE `rounds` DISABLE KEYS */;
INSERT INTO `rounds` VALUES (15,31,7,'2011-07-06 23:25:59','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `rounds` ENABLE KEYS */;
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
  `time_start` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `time_stop` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teams`
--

LOCK TABLES `teams` WRITE;
/*!40000 ALTER TABLE `teams` DISABLE KEYS */;
INSERT INTO `teams` VALUES (31,'Our Team, Yo','0000-00-00 00:00:00','0000-00-00 00:00:00');
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
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (18,'bananabot','admin',31,'2011-07-04 12:40:34','2011-07-07 03:25:37',1,15,'45115tyd','9885e0c2971fdc37b0c64d5bdb4c052f1d70ebf1'),(19,'gamer','user',31,'2011-07-04 12:41:34','2011-07-07 03:25:37',1,15,'21063gul','ac38fb32bdcd94887ef9568b378df02d207efd1c');
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

-- Dump completed on 2011-07-06 23:35:28
