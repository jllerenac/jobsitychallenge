-- MySQL dump 10.13  Distrib 8.0.13, for Linux (x86_64)
--
-- Host: localhost    Database: josellerena
-- ------------------------------------------------------
-- Server version	8.0.13

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8mb4 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `josellerena`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `josellerena` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */;

USE `josellerena`;

--
-- Table structure for table `codeigniter_register`
--

DROP TABLE IF EXISTS `codeigniter_register`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `codeigniter_register` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `twitter_user` varchar(50) DEFAULT NULL,
  `password` text NOT NULL,
  `verification_key` varchar(250) NOT NULL,
  `is_email_verified` enum('no','yes') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `codeigniter_register`
--

LOCK TABLES `codeigniter_register` WRITE;
/*!40000 ALTER TABLE `codeigniter_register` DISABLE KEYS */;
INSERT INTO `codeigniter_register` VALUES (1,'Jose Llerena','josellerenacarpio@gmail.com','Jose_Llerena','$2y$10$vZIXuQfDrglSsSkRoR6x1uKpYj6rJaFkOspSlz.G0lIBEla9qZ0QW','306d00b473e7b86e35d3c276bf1ab806','yes'),(2,'Alfredo Llerena','alfredollerenas@hotmail.com','Hacker0x01','$2y$10$8Dy2WoM4qHNyHLWJDDR9s.Y4FHU8Jq5rjEpWowl42A9.w9UMkLzV.','57dd7c47d87db3a0882702c80240094a','yes');
/*!40000 ALTER TABLE `codeigniter_register` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `twitter`
--

DROP TABLE IF EXISTS `twitter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `twitter` (
  `id` varchar(25) NOT NULL,
  `tweet` varchar(140) NOT NULL,
  `hidden` int(1) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `twitter`
--

LOCK TABLES `twitter` WRITE;
/*!40000 ALTER TABLE `twitter` DISABLE KEYS */;
INSERT INTO `twitter` VALUES ('1032752972567142403','@adriana_verar Vikings',1,1),('1033095364939841543','@NSAGov Excellent requirement, not for me, I ain\'t from the US, but good luck finding the best fit',1,1),('1172571671406043136','@S1r1u5_ @Hacker0x01 Good, thats a motivation to always try',1,1),('1186047059759116291','Starting to test with Twitter API',1,1),('1186310858416242688','@GeneralEG64 Congratulations! ????',0,2),('603789695944892416','@danieltosh love your show greetings from Ecuador',1,1),('798199982516043778','@MashiRafael Estimado Sr. Presidente buena noticia, una consulta alguna vez pensó en un tren de transporte de carga o pasajeros? Saludos',1,1),('842102924859850753','@NatGeo it barely shows something, I really doubt if python really killed hyena, probably hyena was already dead',1,1),('880829423506915328','@MunicipioCuenca Salvemos el Refugio de la Fundación ARCA con 300 perritos - ¡Firma la petic... https://t.co/Wx4KO54esK via @ChangeorgLatino',0,1);
/*!40000 ALTER TABLE `twitter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_entry`
--

DROP TABLE IF EXISTS `user_entry`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `user_entry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `entry` varchar(140) NOT NULL,
  `entry_date` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_entry_1_idx` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_entry`
--

LOCK TABLES `user_entry` WRITE;
/*!40000 ALTER TABLE `user_entry` DISABLE KEYS */;
INSERT INTO `user_entry` VALUES (18,'Question','about','2018-10-20 13:24:09',1),(20,'One','of the doubts','2019-10-10 11:24:09',1),(21,'New tweet','Twiter','2019-10-17 18:24:21',1),(22,'Where is ','My new desk ','2019-10-20 13:24:09',1),(23,'Php','php has been evolving','2019-10-20 13:30:17',1),(24,'Java','What about java','2019-10-20 13:55:02',1),(25,'History','history of C++','2019-10-20 19:17:06',2);
/*!40000 ALTER TABLE `user_entry` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'josellerena'
--
/*!50003 DROP FUNCTION IF EXISTS `checkHidden` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `checkHidden`(tweetId varchar(25)) RETURNS int(1)
BEGIN
DECLARE hiddenTweet INT(1);
	SELECT hidden INTO hiddenTweet FROM josellerena.twitter WHERE id = tweetId;
if hiddenTweet is null then
	return 0;
end if ;
RETURN hiddenTweet; 
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `obtain_twitterUser` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `obtain_twitterUser`(userId int) RETURNS varchar(50) CHARSET utf8
BEGIN
DECLARE twitterUser VARCHAR(50);
	select twitter_user into twitterUser from josellerena.codeigniter_register where id = userId;
RETURN twitterUser;  
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `obtain_username` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `obtain_username`(userId int) RETURNS varchar(250) CHARSET utf8
BEGIN
DECLARE userName VARCHAR(250);
	select name into userName from josellerena.codeigniter_register where id = userId;
RETURN userName; 
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `hideTweet` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `hideTweet`(IN tweetId VARCHAR(25), IN tweet varchar(140), IN user_id INT(11))
BEGIN
 DECLARE existingId VARCHAR(25);
	SELECT id INTO existingId from josellerena.twitter WHERE id = tweetId;
    if existingId is null then
		INSERT INTO josellerena.twitter VALUES(tweetId,tweet,1,user_id);
	else
		UPDATE josellerena.twitter SET hidden = 1 WHERE id = tweetId ;
	end if;
   
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insertEntry` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertEntry`(IN entryTitle varchar(50), IN entryValue varchar(140), IN user_id INT(11))
BEGIN
 DECLARE a INT DEFAULT 0;
   INSERT INTO josellerena.user_entry VALUES(DEFAULT,entryTitle,entryValue,current_timestamp(),user_id);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-10-22 15:27:25
