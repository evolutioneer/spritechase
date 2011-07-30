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
  `data` varchar(1024) NOT NULL,
  `dialog` varchar(48) NOT NULL,
  `dt_opened` datetime NOT NULL,
  `dt_sent` datetime NOT NULL,
  `title` varchar(128) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `team_id` (`team_id`)
) ENGINE=MyISAM AUTO_INCREMENT=76 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (14,0,0,'{\"projectId\":\"013\"}','round_started','2011-07-24 14:30:20','2011-07-24 14:30:20','New Round:  Seeks the Circuit Bent Casio'),(13,0,32,'{\"projectId\":\"04\"}','round_started','2011-07-23 20:16:35','2011-07-23 20:16:35','New Round: Team Hooligan Seeks the Cupcake Car'),(12,0,32,'{\"projectId\":\"03\"}','round_started','2011-07-23 20:14:09','2011-07-23 20:14:09','New Round: Team Hooligan Seeks the Coke and Mentos'),(15,0,0,'{\"projectId\":\"09\"}','round_started','2011-07-24 15:00:47','2011-07-24 15:00:47','New Round:  Seeks the Fire-Breathing Red Green'),(16,18,0,'{\"projectId\":null,\"partsRoundCt\":1,\"relevantPart\":false,\"newPartUser\":false,\"newPartRound\":false,\"teamPlay\":false}','part_collected','0000-00-00 00:00:00','2011-07-29 00:13:17','Part Collected: Ball'),(17,18,0,'{\"projectId\":\"4\",\"partsRoundCt\":1,\"relevantPart\":false,\"newPartUser\":false,\"newPartRound\":false,\"teamPlay\":false}','part_collected','0000-00-00 00:00:00','2011-07-29 00:13:55','Part Collected: Ball'),(18,18,0,'{\"roundId\":null,\"partId\":\"2\",\"projectId\":\"4\",\"partsRoundCt\":1,\"relevantPart\":false,\"newPartUser\":false,\"newPartRound\":false,\"teamPlay\":false}','part_collected','0000-00-00 00:00:00','2011-07-29 00:15:54','Part Collected: Ball'),(19,18,0,'{\"roundId\":null,\"partId\":\"2\",\"projectId\":null,\"partsRoundCt\":1,\"relevantPart\":false,\"newPartUser\":false,\"newPartRound\":false,\"teamPlay\":false}','part_collected','0000-00-00 00:00:00','2011-07-29 00:19:19','Part Collected: Ball'),(20,0,32,'{\"projectId\":\"015\"}','round_started','2011-07-29 00:23:06','2011-07-29 00:23:06','New Round: Team Hooligan Seeks the Chronotune'),(21,0,32,'{\"roundId\":\"43\"}','round_started','2011-07-29 00:46:12','2011-07-29 00:46:12','New Round: Team Hooligan Seeks the Cigar Box Guitar'),(22,0,33,'{\"roundId\":\"48\"}','round_started','2011-07-29 13:00:15','2011-07-29 13:00:15','New Round: bananabot Seeks the '),(23,18,0,'{\"roundId\":\"49\"}','round_started','2011-07-29 13:02:57','2011-07-29 13:02:57','New Round:  Seeks the '),(24,0,33,'{\"roundId\":\"50\"}','round_started','2011-07-29 13:04:55','2011-07-29 13:04:55','New Round: bananabot Seeks the Cigar Box Guitar'),(25,18,0,'{\"roundId\":\"51\"}','round_started','2011-07-29 13:07:14','2011-07-29 13:07:14','New Round: Omeganaughts Seeks the Cigar Box Guitar'),(26,0,33,'{\"roundId\":\"51\",\"partId\":\"11\",\"partsRoundCt\":1,\"relevantPart\":false,\"newPartUser\":true,\"newPartRound\":false}','part_collected','0000-00-00 00:00:00','2011-07-29 13:13:59','Part Collected: Cigar Box'),(27,0,33,'{\"roundId\":\"51\",\"partId\":null,\"partsRoundCt\":1,\"relevantPart\":true,\"newPartUser\":true,\"newPartRound\":false}','part_collected','0000-00-00 00:00:00','2011-07-29 13:46:11','Part Collected: '),(28,0,33,'{\"roundId\":\"51\",\"partId\":\"51\",\"partsRoundCt\":1,\"relevantPart\":true,\"newPartUser\":true,\"newPartRound\":false}','part_collected','2011-07-29 13:49:16','2011-07-29 13:49:16','Part Collected: Air Cannon'),(29,0,33,'{\"roundId\":\"51\",\"partId\":\"1\",\"partsRoundCt\":1,\"relevantPart\":true,\"newPartUser\":true,\"newPartRound\":false}','part_collected','2011-07-29 13:50:50','2011-07-29 13:50:50','Part Collected: Air Tank'),(30,0,33,'{\"roundId\":\"51\",\"partId\":\"2\",\"partsRoundCt\":1,\"relevantPart\":true,\"newPartUser\":true,\"newPartRound\":false}','part_collected','2011-07-29 13:54:15','2011-07-29 13:54:15','Part Collected: Ball'),(31,0,33,'{\"roundId\":\"51\",\"partId\":\"2\",\"partsRoundCt\":1,\"relevantPart\":true,\"newPartUser\":false,\"newPartRound\":false}','part_collected','2011-07-29 13:54:29','2011-07-29 13:54:29','Part Collected: Ball'),(32,0,33,'{\"roundId\":\"51\",\"partId\":\"50\",\"partsRoundCt\":1,\"relevantPart\":true,\"newPartUser\":true,\"newPartRound\":false}','part_collected','2011-07-29 13:55:16','2011-07-29 13:55:16','Part Collected: Arduino'),(33,0,33,'{\"roundId\":\"51\",\"partId\":\"50\",\"partsRoundCt\":1,\"relevantPart\":true,\"newPartUser\":false}','part_collected','2011-07-29 14:12:12','2011-07-29 14:12:12','Part Collected: Arduino'),(34,0,33,'{\"roundId\":\"51\",\"partId\":\"50\",\"partsRoundCt\":1,\"relevantPart\":true,\"newPartUser\":false}','part_collected','2011-07-29 14:12:26','2011-07-29 14:12:26','Part Collected: Arduino'),(35,0,33,'{\"roundId\":\"51\",\"partId\":\"50\",\"partsRoundCt\":1,\"relevantPart\":true,\"newPartUser\":false}','part_collected','2011-07-29 14:13:09','2011-07-29 14:13:09','Part Collected: Arduino'),(36,0,33,'{\"roundId\":\"51\",\"partId\":\"4\",\"partsRoundCt\":1,\"relevantPart\":true,\"newPartUser\":true}','part_collected','2011-07-29 14:14:40','2011-07-29 14:14:40','Part Collected: Bath Tub'),(37,0,33,'{\"roundId\":\"51\",\"partId\":\"5\",\"partsRoundCt\":1,\"relevantPart\":false,\"newPartUser\":true}','part_collected','2011-07-29 14:16:45','2011-07-29 14:16:45','Part Collected: Battery'),(38,0,33,'{\"roundId\":\"51\",\"partId\":\"6\",\"partsRoundCt\":1,\"relevantPart\":false,\"newPartUser\":true}','part_collected','2011-07-29 14:18:06','2011-07-29 14:18:06','Part Collected: Bowling Ball'),(39,0,33,'{\"roundId\":\"51\",\"partId\":\"11\",\"partsRoundCt\":1,\"relevantPart\":true,\"newPartUser\":false}','part_collected','2011-07-29 14:18:45','2011-07-29 14:18:45','Part Collected: Cigar Box'),(40,0,33,'{\"roundId\":\"51\",\"partId\":\"11\",\"partsRoundCt\":1,\"relevantPart\":true,\"newPartUser\":false}','part_collected','2011-07-29 14:19:28','2011-07-29 14:19:28','Part Collected: Cigar Box'),(41,0,33,'{\"roundId\":\"51\",\"partId\":\"7\",\"partsRoundCt\":1,\"relevantPart\":false,\"newPartUser\":true}','part_collected','2011-07-29 14:20:47','2011-07-29 14:20:47','Part Collected: Cardboard'),(42,0,33,'{\"roundId\":\"51\",\"partId\":\"11\",\"partsRoundCt\":4,\"relevantPart\":true,\"newPartUser\":false}','part_collected','2011-07-29 14:21:07','2011-07-29 14:21:07','Part Collected: Cigar Box'),(43,18,0,'{\"roundId\":null,\"partId\":\"4\",\"projectId\":null,\"partsRoundCt\":1,\"relevantPart\":false,\"newPartUser\":false,\"teamPlay\":false}','part_collected','2011-07-29 14:26:12','2011-07-29 14:26:12','Part Collected: Bath Tub'),(44,0,33,'{\"roundId\":\"52\"}','round_started','2011-07-29 14:27:35','2011-07-29 14:27:35','New Round: bananabot Seeks the Compressed Air Rocket'),(45,18,0,'{\"roundId\":\"52\",\"partId\":\"1\",\"partsRoundCt\":1,\"relevantPart\":false,\"newPartUser\":false}','part_collected','2011-07-29 14:28:14','2011-07-29 14:28:14','Part Collected: Air Tank'),(46,0,33,'{\"roundId\":\"53\"}','round_started','2011-07-29 20:41:50','2011-07-29 20:41:50','New Round: bananabot Seeks the Cigar Box Guitar'),(47,0,33,'{\"roundId\":\"54\"}','round_started','2011-07-29 20:49:10','2011-07-29 20:49:10','New Round: bananabot Seeks the Coke and Mentos'),(48,18,0,'{\"roundId\":\"54\",\"partId\":\"14\",\"partsRoundCt\":1,\"relevantPart\":false,\"newPartUser\":true}','part_collected','2011-07-29 20:49:30','2011-07-29 20:49:30','Part Collected: Coke'),(49,18,0,'{\"roundId\":\"54\",\"partId\":\"25\",\"partsRoundCt\":1,\"relevantPart\":false,\"newPartUser\":true}','part_collected','2011-07-29 20:49:54','2011-07-29 20:49:54','Part Collected: Mentos'),(50,18,0,'{\"roundId\":\"55\"}','round_started','2011-07-29 21:42:29','2011-07-29 21:42:29','New Round: Omeganaughts Seeks the Coke and Mentos'),(51,0,33,'{\"roundId\":\"55\",\"partId\":\"14\",\"partsRoundCt\":1,\"relevantPart\":false,\"newPartUser\":false}','part_collected','2011-07-29 21:43:31','2011-07-29 21:43:31','Part Collected: Coke'),(52,0,33,'{\"roundId\":\"55\",\"partId\":\"10\",\"partsRoundCt\":1,\"relevantPart\":false,\"newPartUser\":true}','part_collected','2011-07-29 21:45:47','2011-07-29 21:45:47','Part Collected: Chicken Wire'),(53,0,33,'{\"roundId\":\"55\",\"partId\":\"11\",\"partsRoundCt\":1,\"relevantPart\":false,\"newPartUser\":false}','part_collected','0000-00-00 00:00:00','2011-07-29 21:46:25','Part Collected: Cigar Box'),(54,0,33,'{\"roundId\":\"55\",\"partId\":\"11\",\"partsRoundCt\":2,\"relevantPart\":false,\"newPartUser\":false}','part_collected','0000-00-00 00:00:00','2011-07-29 21:47:13','Part Collected: Cigar Box'),(55,0,33,'{\"roundId\":\"55\",\"partId\":\"14\",\"partsRoundCt\":2,\"relevantPart\":true,\"newPartUser\":false}','part_collected','0000-00-00 00:00:00','2011-07-29 21:49:37','Part Collected: Coke'),(56,0,33,'{\"roundId\":\"55\",\"partId\":\"14\",\"partsRoundCt\":3,\"relevantPart\":true,\"newPartUser\":false}','part_collected','2011-07-29 21:52:23','2011-07-29 21:52:23','Part Collected: Coke'),(57,0,33,'{\"roundId\":\"55\",\"partId\":\"25\",\"partsRoundCt\":1,\"relevantPart\":true,\"newPartUser\":false}','part_collected','2011-07-29 21:53:50','2011-07-29 21:53:50','Part Collected: Mentos'),(58,18,0,'{\"roundId\":\"56\"}','round_started','2011-07-29 21:57:43','2011-07-29 21:57:43','New Round: Omeganaughts Seeks the Circuit Bent Casio'),(59,0,33,'{\"roundId\":\"56\",\"partId\":\"8\",\"partsRoundCt\":1,\"relevantPart\":true,\"newPartUser\":true}','part_collected','2011-07-29 21:58:38','2011-07-29 21:58:38','Part Collected: Casio Keyboard'),(60,0,33,'{\"roundId\":\"56\",\"partId\":\"31\",\"partsRoundCt\":1,\"relevantPart\":true,\"newPartUser\":true}','part_collected','2011-07-29 21:59:05','2011-07-29 21:59:05','Part Collected: Potentiometer'),(61,0,33,'{\"roundId\":\"56\",\"partId\":\"36\",\"partsRoundCt\":1,\"relevantPart\":true,\"newPartUser\":true}','part_collected','2011-07-29 21:59:32','2011-07-29 21:59:32','Part Collected: Solder'),(62,0,33,'{\"roundId\":\"56\",\"partId\":\"8\",\"partsRoundCt\":2,\"relevantPart\":true,\"newPartUser\":false}','part_collected','2011-07-29 22:00:31','2011-07-29 22:00:31','Part Collected: Casio Keyboard'),(63,18,0,'{\"roundId\":\"57\"}','round_started','2011-07-29 22:01:02','2011-07-29 22:01:02','New Round: Omeganaughts Seeks the Coke and Mentos'),(64,0,33,'{\"roundId\":\"57\",\"partId\":\"14\",\"partsRoundCt\":1,\"relevantPart\":true,\"newPartUser\":false}','part_collected','2011-07-29 22:01:17','2011-07-29 22:01:17','Part Collected: Coke'),(65,18,0,'{\"roundId\":\"58\"}','round_started','2011-07-29 22:02:03','2011-07-29 22:02:03','New Round: Omeganaughts Seeks the Coke and Mentos'),(66,0,33,'{\"roundId\":\"58\",\"partId\":\"14\",\"partsRoundCt\":1,\"relevantPart\":true,\"newPartUser\":false}','part_collected','2011-07-29 22:02:17','2011-07-29 22:02:17','Part Collected: Coke'),(67,18,0,'{\"roundId\":\"59\"}','round_started','2011-07-29 22:03:45','2011-07-29 22:03:45','New Round: Omeganaughts Seeks the Coke and Mentos'),(68,0,33,'{\"roundId\":\"59\",\"partId\":\"14\",\"partsRoundCt\":1,\"relevantPart\":true,\"newPartUser\":false}','part_collected','2011-07-29 22:04:10','2011-07-29 22:04:10','Part Collected: Coke'),(69,18,0,'{\"roundId\":\"60\"}','round_started','2011-07-29 22:04:57','2011-07-29 22:04:57','New Round: Omeganaughts Seeks the Coke and Mentos'),(70,0,33,'{\"roundId\":\"60\",\"partId\":\"14\",\"partsRoundCt\":1,\"relevantPart\":true,\"newPartUser\":false}','part_collected','2011-07-29 22:05:12','2011-07-29 22:05:12','Part Collected: Coke'),(71,0,33,'{\"roundId\":\"60\",\"projectId\":\"3\",\"roundTimeTaken\":\"27 seconds\",\"teamPlay\":false}','round_completed','2011-07-29 22:05:24','2011-07-29 22:05:24','Round Complete: Coke and Mentos'),(72,18,0,'{\"roundId\":\"61\"}','round_started','2011-07-29 22:18:20','2011-07-29 22:18:20','New Round: Omeganaughts Seeks the Coke and Mentos'),(73,0,33,'{\"roundId\":\"61\",\"partId\":\"14\",\"partsRoundCt\":1,\"relevantPart\":true,\"newPartUser\":false}','part_collected','2011-07-29 22:18:32','2011-07-29 22:18:32','Part Collected: Coke'),(74,0,33,'{\"roundId\":\"61\",\"projectId\":\"3\",\"roundTimeTaken\":\"37 seconds\",\"teamPlay\":false}','round_completed','2011-07-29 22:18:57','2011-07-29 22:18:57','Round Complete: Coke and Mentos'),(75,18,0,'{\"roundId\":\"62\"}','round_started','2011-07-29 22:21:08','2011-07-29 22:21:08','New Round: Omeganaughts Seeks the Coke and Mentos');
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
INSERT INTO `parts` VALUES (1,'Air Tank','And you thought we couldn\'t fit any more hot air into this game.  Boy, were you wrong!','airtank','91905',''),(2,'Ball','It\'s all fun and games until someone loses a ball.  And now it\'s yours!','ball','13843',''),(4,'Bath Tub','Empty Description','bathtub','12456',''),(5,'Battery','Empty Description','battery','47323',''),(6,'Bowling Ball','Empty Description','bowlingball','17178',''),(7,'Cardboard','Empty Description','cardboard','85319',''),(8,'Casio Keyboard','Empty Description','keyboard','21495',''),(9,'Chess Board','Empty Description','chessboard','78802',''),(10,'Chicken Wire','Empty Description','chickenwire','71719',''),(11,'Cigar Box','Empty Description','cigarbox','42041',''),(12,'Circuit Board','Empty Description','circuitboard','95559',''),(13,'CO2 Tank','Empty Description','co2','89348',''),(14,'Coke','Empty Description','coke','76966',''),(15,'Duct Tape','Empty Description','ducttape','85951',''),(16,'Fabric','Empty Description','fabric','15626',''),(17,'Flavoring','Empty Description','flavoring','18383',''),(18,'Foam','Empty Description','foam','25903',''),(19,'Gear','Empty Description','gear','13634',''),(20,'Go Kart','Empty Description','gokart','40795',''),(21,'Kids Power Wheel','Empty Description','powerwheels','54590',''),(22,'LED','Empty Description','LED','12655',''),(23,'Lego Blocks','Empty Description','legoblock','76734',''),(24,'Lego Mindstorm','Empty Description','legomindstorm','48346',''),(25,'Mentos','Empty Description','mentos','51875',''),(26,'Metal','Empty Description','metal','78073',''),(27,'Motor','Empty Description','motor','57758',''),(28,'Paper','Empty Description','paper','17689',''),(29,'Pipe','Empty Description','pipe','18799',''),(30,'Plastic','Empty Description','plastic','83983',''),(31,'Potentiometer','Empty Description','pot','85318',''),(32,'Printer','Empty Description','printer','41937',''),(33,'Propane','Empty Description','propane','46555',''),(34,'Propeller','Empty Description','propeller','90026',''),(35,'Pump','Empty Description','pump','95954',''),(36,'Solder','Empty Description','solder','81306',''),(37,'Speaker','Empty Description','speaker','97847',''),(38,'Spring','Empty Description','spring','47191',''),(39,'String','Empty Description','string','33418',''),(40,'Sugar','Empty Description','sugar','96605',''),(41,'Teddy Bear','Empty Description','teddybear','64700',''),(42,'Tubing','Empty Description','tubing','89215',''),(43,'Twinkie','Empty Description','twinkies','21078',''),(44,'Water','Empty Description','water','50892',''),(45,'Wire','Empty Description','wire','51460',''),(46,'Wood','Empty Description','wood','26237',''),(47,'Members','Empty Description','','68408',''),(48,'Property','Empty Description','','28418',''),(49,'Community','Empty Description','','86361',''),(50,'Arduino','Empty Description','circuitboard','92032',''),(51,'Air Cannon','Empty Description','','58045','');
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
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parts_rounds`
--

LOCK TABLES `parts_rounds` WRITE;
/*!40000 ALTER TABLE `parts_rounds` DISABLE KEYS */;
INSERT INTO `parts_rounds` VALUES (33,29,46,'2011-07-23 16:08:42',1),(34,30,16,'2011-07-23 17:39:57',1),(26,26,36,'2011-07-23 04:39:21',1),(25,26,31,'2011-07-23 04:39:10',1),(24,26,8,'2011-07-23 04:38:54',1),(23,26,50,'2011-07-23 04:38:08',2),(32,29,37,'2011-07-23 16:08:29',1),(31,29,32,'2011-07-23 16:08:08',1),(30,29,12,'2011-07-23 16:07:52',1),(29,29,50,'2011-07-23 16:07:19',1),(28,26,45,'2011-07-23 04:40:06',1),(27,26,51,'2011-07-23 04:39:55',1),(35,30,42,'2011-07-23 18:19:29',1),(36,30,18,'2011-07-23 18:19:44',1),(37,39,14,'2011-07-28 01:35:46',1),(38,39,2,'2011-07-29 04:08:42',6),(44,51,4,'2011-07-29 18:14:40',1),(41,51,1,'2011-07-29 17:50:50',1),(40,51,51,'2011-07-29 17:49:16',1),(43,51,50,'2011-07-29 17:55:16',4),(42,51,2,'2011-07-29 17:54:15',2),(39,51,11,'2011-07-29 17:13:59',4),(47,51,7,'2011-07-29 18:20:47',1),(46,51,6,'2011-07-29 18:18:06',1),(45,51,5,'2011-07-29 18:16:45',1),(48,52,1,'2011-07-29 18:28:14',1),(50,54,25,'2011-07-30 00:49:54',1),(49,54,14,'2011-07-30 00:49:30',1),(53,55,11,'2011-07-30 01:46:25',2),(54,55,25,'2011-07-30 01:53:50',1),(51,55,14,'2011-07-30 01:43:31',3),(52,55,10,'2011-07-30 01:45:47',1),(55,56,8,'2011-07-30 01:58:38',2),(56,56,31,'2011-07-30 01:59:05',1),(57,56,36,'2011-07-30 01:59:32',1),(59,57,14,'2011-07-30 02:01:17',1),(61,58,14,'2011-07-30 02:02:17',1),(63,59,14,'2011-07-30 02:04:10',1),(65,60,14,'2011-07-30 02:05:12',1),(67,61,14,'2011-07-30 02:18:32',1);
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
) ENGINE=MyISAM AUTO_INCREMENT=73 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parts_users`
--

LOCK TABLES `parts_users` WRITE;
/*!40000 ALTER TABLE `parts_users` DISABLE KEYS */;
INSERT INTO `parts_users` VALUES (72,45,18,'2011-07-30 01:59:48',1),(71,36,18,'2011-07-30 01:59:32',1),(70,31,18,'2011-07-30 01:59:05',1),(69,8,18,'2011-07-30 01:58:38',2),(68,10,18,'2011-07-30 01:45:47',1),(67,25,18,'2011-07-30 00:49:54',7),(66,14,18,'2011-07-30 00:49:30',9),(65,7,18,'2011-07-29 18:20:47',1),(64,6,18,'2011-07-29 18:18:06',1),(63,5,18,'2011-07-29 18:16:45',1),(62,4,18,'2011-07-29 18:14:40',2),(61,50,18,'2011-07-29 17:55:16',4),(60,2,18,'2011-07-29 17:54:15',2),(59,1,18,'2011-07-29 17:50:50',2),(58,51,18,'2011-07-29 17:49:16',1),(57,11,18,'2011-07-29 17:13:59',6);
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
  `criticism` varchar(256) NOT NULL,
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
INSERT INTO `projects` VALUES (1,'Life-Sized Mouse Trap','This impressively large project has been at both Maker Faires held in Detroit.','You call this a life-sized mouse trap!?  Real live mice are not this big!  You could catch PEOPLE with this thing.','',''),(2,'Maker Bot','A highly successful project to come out of hackerspace culture, the Maker Bot prints 3D parts - and itself can be made with open hardware designs.','Impressive!  I have always wanted to see one of these.  This is the one that extrudes cupcakes, right?','',''),(3,'Coke and Mentos','A sensation on YouTube, adding Mentos to Coke will cause rapid expansion of gases and spectacular fun.  Check out the show at Maker Faire Detroit.','Coke and mentos, together again... ever so briefly.  Why doesn\'t the parts list include an umbrella?','coke_mentos','71223'),(4,'Cupcake Car','A fleet of cupcake cars made its way across previous Maker Faires - some of them still wander the landscape.','A car that looks like a cupcake - or a cupcake that looks like a car?  You decide.','cupcake_car','20032'),(5,'Waterfall Swing','Always a favorite, the waterfall swing does not hit guests with its water, but times blasts of water to avoid dousing the swinger.','A waterfall swing.  I could have used this a few weeks ago when it was roasting hot outside.','',''),(6,'FIRST Robot','FIRST Robotics is a program that allows young adults to experience engineering challenges first hand.  The high school FIRST program gives teenagers the chance to build a robot.','I hardly think this is the FIRST robot - wouldn\'t it be made from wood, stones, and talkative tiny dinosaurs?','',''),(7,'Compressed Air Rocket','Readily available parts can be used to assemble a compressed air rocket.  The concept is simple but the engineering challenges are great for air time, distance, and structural integrity.','A compressed air rocket??  I thought you were building me a space shuttle.  Thanks a lot.','',''),(8,'Twinkie Car','A go-kart converted into a gigantic Twinkie, equipped with an on-board CO2 cannon for firing twinkies at passers by.  Why?  It\'s anyone\'s guess.','You have to be kidding me.  A car that shoots twinkies?  Who came up with THAT idea?','',''),(9,'Fire-Breathing Red Green','The likeness of Canadian comedian Red Green, built out of duct tape and 16 feet tall.  Because that was not enough, the creators added propane and a trigger to let him breathe fire.','A sixteen foot tall statue that breathes fire, and is made of flammable plastics.  Fun for the whole family.','',''),(10,'Giant Lego Chess','Life-sized chess pieces made entirely out of Lego - a very ambitious and visually impressive project.','Legos and chess.  Can you get much nerdier than this?  Not that I admit to liking both of these things...','',''),(11,'Learn to Solder Badge','A staple of the Maker Shed, these badges let newcomers to electronics try their hand at the most basic skill of soldering.','Poker chip plus LED equals edutainment!  You\'ll have to show me how you did that one.','badge','35823'),(12,'Cigar Box Guitar','Empty Description','Now I have a Cigar Box Guitar.  But I can\'t play it!  Couldn\'t you have made me a Cigar Box MP3 player or something?','cigar_box_guitar','21132'),(13,'Circuit Bent Casio','Conventional electronic music equipment can be hacked to play all sorts of unexpected tones through a process called \"circuit bending.\"  This project shows the idea in action.','This is quite interesting.  Look at all those switches and knobs...  Don\'t turn it on, that\'ll spoil the effect.','circuit_bent_casio','91437'),(14,'Quadcopter','A helicopter that flies with four parallel propellers and motors, quad copters can offer a high degree of maneuverability and speed in the air.','Oh, a QUAD copter?  I thought you were making a SQUAD copter.  Now I have to send my pilot friends home.  Thanks a lot.','',''),(15,'Chronotune','Tired of listening to the same old radio stations?  Try the Chronotune - a time-traveling radio that lets you hear broadcasts from throughout time!  (Disclaimer: does not actually travel through time.)','I had a time traveling radio before it was cool.  Then it went back, to before when I was cool enough to have one.','',''),(16,'Open Soda','With the right combination of distilled water, flavors, sugar, and chemicals, you can create your own carbonated beverages.','No more closed soda!  Down with the military industrial beverage complex!  We will have soda... OUR way.','',''),(17,'Gigantic Puppet Head','Perhaps you have seen him wandering around Maker Faire Detroit!  The Gigantic Puppet Head can amuse or terrify, depending on how old you are.','This puppet looks big enough to eat children whole.  How delightful!  And you only made one?','',''),(18,'Hackerspace','Hackerspaces are collectives of artists, engineers, and other hands-on learners.  They are centers of creative output and day to day innovation.','Come on, anyone can make a hackerspace.  This wasn\'t a challenging project at all to pick! ... Riiiight.','',''),(19,'Power Wheels Racer','Take an old kid\'s power wheels car, put in a new engine, real brakes, and a big battery.  What do you get?  High-powered fun for big kids!','I saw one of these on the news last night!  It had flipped over and caught on fire after peeling out.  Can\'t wait to try this one.','',''),(20,'Talking Teddy Bear','Popular talking doll toys have dotted our childhoods.  With inexpensive modern electronics you can create your own with little expense or trouble.','A talking teddy bear!  This isn\'t creepy at all.  I will enjoy feeling its eyes in the back of my head when the lights are out in my bedroom.','','');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
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
) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rounds`
--

LOCK TABLES `rounds` WRITE;
/*!40000 ALTER TABLE `rounds` DISABLE KEYS */;
INSERT INTO `rounds` VALUES (62,33,0,3,'2011-07-29 22:21:08','0000-00-00 00:00:00','0000-00-00 00:00:00'),(61,33,0,3,'2011-07-29 22:18:20','2011-07-29 22:18:57','0000-00-00 00:00:00'),(60,33,0,3,'2011-07-29 22:04:57','2011-07-29 22:05:24','0000-00-00 00:00:00'),(59,33,0,3,'2011-07-29 22:03:45','2011-07-29 22:04:26','0000-00-00 00:00:00'),(58,33,0,3,'2011-07-29 22:02:03','2011-07-29 22:02:30','0000-00-00 00:00:00'),(57,33,0,3,'2011-07-29 22:01:02','2011-07-29 22:01:31','2011-07-29 22:01:58'),(56,33,0,13,'2011-07-29 21:57:43','2011-07-29 21:59:48','2011-07-29 22:00:55'),(55,33,0,3,'2011-07-29 21:42:29','0000-00-00 00:00:00','2011-07-29 21:57:36'),(54,0,18,3,'2011-07-29 20:49:10','0000-00-00 00:00:00','2011-07-29 21:42:18'),(53,0,18,12,'2011-07-29 20:41:50','0000-00-00 00:00:00','2011-07-29 20:48:31'),(52,0,18,7,'2011-07-29 14:27:35','0000-00-00 00:00:00','2011-07-29 20:41:33'),(51,33,0,12,'2011-07-29 13:07:14','0000-00-00 00:00:00','2011-07-29 14:25:59'),(50,0,18,12,'2011-07-29 13:04:55','0000-00-00 00:00:00','2011-07-29 13:07:00'),(49,0,18,15,'2011-07-29 13:02:57','0000-00-00 00:00:00','2011-07-29 13:04:35'),(48,33,0,9,'2011-07-29 13:00:15','0000-00-00 00:00:00','2011-07-29 13:02:52'),(47,33,0,15,'2011-07-29 12:33:36','0000-00-00 00:00:00','2011-07-29 12:57:48'),(46,33,0,15,'2011-07-29 12:30:16','0000-00-00 00:00:00','0000-00-00 00:00:00'),(45,33,0,15,'2011-07-29 12:29:39','0000-00-00 00:00:00','0000-00-00 00:00:00'),(44,33,0,15,'2011-07-29 12:29:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
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
  `dt_start` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dt_stop` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teams`
--

LOCK TABLES `teams` WRITE;
/*!40000 ALTER TABLE `teams` DISABLE KEYS */;
INSERT INTO `teams` VALUES (31,'Our Team, Yo','0000-00-00 00:00:00','0000-00-00 00:00:00'),(32,'Team Hooligan','0000-00-00 00:00:00','0000-00-00 00:00:00'),(33,'Omeganaughts','2011-07-29 04:49:09','0000-00-00 00:00:00');
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
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (18,'bananabot','admin',33,'2011-07-04 12:40:34','2011-07-29 04:49:09',1,62,'45115tyd','9885e0c2971fdc37b0c64d5bdb4c052f1d70ebf1'),(24,'george','user',33,'2011-07-23 00:27:08','2011-07-29 04:49:09',1,62,'00499zoy','ac38fb32bdcd94887ef9568b378df02d207efd1c'),(25,'boingy','user',33,'2011-07-24 14:12:04','2011-07-29 04:49:09',1,62,'28303tmw','ac38fb32bdcd94887ef9568b378df02d207efd1c'),(23,'simpleton','user',33,'2011-07-23 00:26:56','2011-07-29 04:49:09',1,62,'10039onz','ac38fb32bdcd94887ef9568b378df02d207efd1c'),(26,'boingy2','user',33,'2011-07-24 14:21:20','2011-07-29 04:49:09',1,62,'41809kyh','4c4968a213631d5441c39e00f02a0d47d11f254b'),(27,'boingy3','user',33,'2011-07-24 14:22:46','2011-07-29 04:49:09',1,62,'18677eoy','ac38fb32bdcd94887ef9568b378df02d207efd1c'),(28,'boingy4','user',0,'2011-07-24 14:23:18','2011-07-24 17:23:18',1,NULL,'71815oyd','ac38fb32bdcd94887ef9568b378df02d207efd1c'),(29,'username','user',0,'2011-07-24 14:54:37','2011-07-24 17:54:37',1,NULL,'62090dnm','ac38fb32bdcd94887ef9568b378df02d207efd1c'),(30,'Binky','user',0,'2011-07-24 14:56:43','2011-07-24 18:56:43',1,NULL,'54508rzn','ac38fb32bdcd94887ef9568b378df02d207efd1c'),(31,'tester','user',0,'2011-07-25 12:47:38','2011-07-25 16:47:38',1,NULL,'65131als','ac38fb32bdcd94887ef9568b378df02d207efd1c'),(32,'testy123','user',0,'2011-07-25 15:11:42','2011-07-25 19:11:42',1,NULL,'92721fqf','ac38fb32bdcd94887ef9568b378df02d207efd1c'),(33,'donkeyfart','user',0,'2011-07-25 23:45:04','2011-07-26 03:45:04',1,NULL,'04151wgd','ac38fb32bdcd94887ef9568b378df02d207efd1c'),(34,'','user',0,'2011-07-29 12:29:00','2011-07-29 16:29:00',1,NULL,'85626xgq','');
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

-- Dump completed on 2011-07-30  0:04:35
