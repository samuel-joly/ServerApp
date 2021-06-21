-- MySQL dump 10.13  Distrib 8.0.23, for Linux (x86_64)
--
-- Host: localhost    Database: pp6-forum
-- ------------------------------------------------------
-- Server version	8.0.23-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `badge`
--

DROP TABLE IF EXISTS `badge`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `badge` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `badge`
--

LOCK TABLES `badge` WRITE;
/*!40000 ALTER TABLE `badge` DISABLE KEYS */;
/*!40000 ALTER TABLE `badge` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emote`
--

DROP TABLE IF EXISTS `emote`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `emote` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `markup_name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emote`
--

LOCK TABLES `emote` WRITE;
/*!40000 ALTER TABLE `emote` DISABLE KEYS */;
INSERT INTO `emote` VALUES (1,'Flamme','Everything is Fine','faya.svg'),(2,'Faya','Everything is Fine','faya.svg'),(3,'Faya','Everything is Fine','faya.svg');
/*!40000 ALTER TABLE `emote` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `message` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_author` int NOT NULL,
  `id_topic` int NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message`
--

LOCK TABLES `message` WRITE;
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
INSERT INTO `message` VALUES (1,2,3,'EDITEDsaaa'),(2,2,1,'Message test'),(3,9,3,'Le message de base'),(4,10,3,'le contenu d\'un message'),(5,10,3,'le contenu d\'un message'),(6,11,3,'UN emssage !'),(7,12,3,'Une nouveau message poru le 2eme topic'),(8,12,2,'Une nouveau message poru le 2eme topic'),(9,12,2,'Une nouveau message poru le 2eme topic'),(10,12,2,'Une nouveau message poru le 2eme topic'),(11,12,0,'Encore un message pour le deuxieme topic'),(12,29,2,'Encore un message pour le deuxieme topic'),(13,30,2,'Encore un message pour le deuxieme topic'),(14,32,2,'Encore un message pour le deuxieme topic'),(15,37,2,'Encore un message pour le deuxieme topic'),(16,38,2,'Encore un message pour le deuxieme topic'),(17,40,2,'Encore un message pour le deuxieme topic'),(18,44,2,'Encore un message pour le deuxieme topic'),(19,45,2,'Encore un message pour le deuxieme topic'),(20,48,2,'Encore un message pour le deuxieme topic'),(21,49,2,'Encore un message pour le deuxieme topic'),(22,51,2,'Encore un message pour le deuxieme topic'),(23,52,2,'Encore un message pour le deuxieme topic'),(24,53,2,'Encore un message pour le deuxieme topic'),(25,55,2,'Encore un message pour le deuxieme topic'),(26,56,2,'Encore un message pour le deuxieme topic'),(27,57,2,'Encore un message pour le deuxieme topic'),(28,58,2,'Encore un message pour le deuxieme topic'),(29,59,2,'Encore un message pour le deuxieme topic'),(30,60,2,'Encore un message pour le deuxieme topic'),(31,60,2,'Encore un message pour le deuxieme topic'),(32,60,2,'Encore un message pour le deuxieme topic'),(33,60,2,'Encore un message pour le deuxieme topic'),(34,60,2,'Encore un message pour le deuxieme topic'),(35,60,2,'Encore un message pour le deuxieme topic'),(36,76,2,'Encore un message pour le deuxieme topic'),(37,77,2,'Encore un message pour le deuxieme topic'),(38,78,2,'Encore un message pour le deuxieme topic'),(39,60,2,'Encore un message pour le deuxieme topic'),(40,80,2,'Encore un message pour le deuxieme topic'),(41,60,2,'Encore un message pour le deuxieme topic'),(42,82,2,'Encore un message pour le deuxieme topic'),(43,60,2,'Encore un message pour le deuxieme topic'),(44,60,2,'Encore un message pour le deuxieme topic'),(45,60,2,'Encore un message pour le deuxieme topic'),(46,86,2,'Encore un message pour le deuxieme topic'),(47,60,2,'Encore un message pour le deuxieme topic');
/*!40000 ALTER TABLE `message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reaction`
--

DROP TABLE IF EXISTS `reaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reaction` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_message` int NOT NULL,
  `id_user` int NOT NULL,
  `id_emote` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reaction`
--

LOCK TABLES `reaction` WRITE;
/*!40000 ALTER TABLE `reaction` DISABLE KEYS */;
INSERT INTO `reaction` VALUES (17,5,12,1),(22,2,12,4),(23,10,12,2),(24,10,12,3),(28,5,29,2),(29,5,30,2),(30,5,32,2),(31,5,37,2),(32,5,38,2),(33,5,40,2);
/*!40000 ALTER TABLE `reaction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (10,'admin'),(11,'user');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tag` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag`
--

LOCK TABLES `tag` WRITE;
/*!40000 ALTER TABLE `tag` DISABLE KEYS */;
INSERT INTO `tag` VALUES (1,'PHP'),(2,'JS');
/*!40000 ALTER TABLE `tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `thread_notifications`
--

DROP TABLE IF EXISTS `thread_notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `thread_notifications` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `id_topic` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `thread_notifications`
--

LOCK TABLES `thread_notifications` WRITE;
/*!40000 ALTER TABLE `thread_notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `thread_notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `topic`
--

DROP TABLE IF EXISTS `topic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `topic` (
  `id` int NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) NOT NULL,
  `id_author` int NOT NULL,
  `id_answer` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `topic`
--

LOCK TABLES `topic` WRITE;
/*!40000 ALTER TABLE `topic` DISABLE KEYS */;
INSERT INTO `topic` VALUES (1,'Premier topic',2,0),(2,'test',2,0),(3,'Le vrai topic 3',12,0),(4,'Une nouveau message poru le 2eme topic',12,0),(5,'Nouvelle creation de topic',29,0),(6,'Nouvelle creation de topic31',31,0),(7,'Nouvelle creation de topic32',32,0),(8,'Nouvelle creation de topicnull',37,0),(9,'Nouvelle creation de topic38',38,0),(10,'Nouvelle creation de topic40',40,0),(11,'Nouvelle creation de topic44',44,0),(12,'Nouvelle creation de topic48',48,0),(13,'Nouvelle creation de topic49',49,0),(14,'Nouvelle creation de topic51',51,0),(15,'Nouvelle creation de topic52',52,0),(16,'Nouvelle creation de topic53',53,0),(17,'Nouvelle creation de topic55',55,0),(18,'Nouvelle creation de topic56',56,0),(19,'Nouvelle creation de topic57',57,0),(20,'Nouvelle creation de topic58',58,0),(21,'Nouvelle creation de topic59',59,0),(22,'Nouvelle creation de topic60',60,0),(23,'Nouvelle creation de topic601',60,0),(24,'Nouvelle creation de topic601s',60,0),(29,'Nouvelle creation de topic76',76,0),(30,'Nouvelle creation de topic77',77,0),(31,'Nouvelle creation de topic78',78,0),(33,'Nouvelle creation de topic80',80,0),(35,'Nouvelle creation de topic82',82,0),(39,'Nouvelle creation de topic86',86,0);
/*!40000 ALTER TABLE `topic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `topic_tag`
--

DROP TABLE IF EXISTS `topic_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `topic_tag` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_topic` int NOT NULL,
  `id_tag` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `topic_tag`
--

LOCK TABLES `topic_tag` WRITE;
/*!40000 ALTER TABLE `topic_tag` DISABLE KEYS */;
INSERT INTO `topic_tag` VALUES (16,2,2);
/*!40000 ALTER TABLE `topic_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(60) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `role` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'testeur','test','medias/avatar/1.png','testeur@mail.com',11),(2,'updated','romain','medias/avatar/2.png','test@mail.com',11),(3,'updated','$2y$10$sxvTmbB/u3gu8UAJw.AWeu7Ssx9mYSmclMiwhMTvgKI3Ziku0APfq',NULL,'testeur@test.com',11),(4,'testeur','$2y$10$DK/mie2maM7I2gLTUt/buO8aDEpJg26xYSnvGRODFhfV51gV9hOvO',NULL,'testeur@test.com',11),(5,'testeur','$2y$10$QcRNf1zpsDdW8azJWtp8MeRUuTCd.tqp.OQ0BI/PDwLfxmm25NC8e',NULL,'testeur@test.com',11),(6,'testeur','$2y$10$mLQ8KFkP0wYKuy8RriNpzuULuLatDamAhUfLL5FzB/c.YPIfmlYZy',NULL,'testeur@test.com',11),(7,'testeurdefal','$2y$10$INudedd1PEIkpHAwKdcI2eaF2cRDzTLFaz/R5Oc0jBs/34K6kV3Sy',NULL,'testeudsar@test.comsad',11),(8,'Sam','$2y$10$pmC94mwPDTh8QQS/AOT2vu14a4VspTL5wGcGiB0NgSJdlbm.iVZIW',NULL,'teste@teste.com',11),(10,'ledeuxiemetesteur','$2y$10$9ToMHDjQBTJJcUNL0Wi/Eum6BwYWoS0CvRMMoF5LfeSTnlt0Orty.',NULL,'ledeuxiemetesteur@lestests.com',0),(11,'Supertest','$2y$10$41wv38GABrBnX4YfZT.pBuzjTIQ5gLYbRzPt2NwQfxmhF487xPEjG',NULL,'emailetest@email.com',0),(12,'Un Pseudo pas commode','$2y$10$E5RBGCBk/bvE/Xy966TgLeyfYLcUPMPd2RiCCT.Ry.vD02X.7Sw7q','medias/avatar/12.png','unEmailPasCOmmeLesAutre@email.com',10),(14,'letestdeuxieme','$2y$10$B3tKc8Wtek6hOaVSB8rHmuuFQUmvx0cxrsjYD0JLJqldOxitxDib.',NULL,'samueljoly0@test.com',0),(15,'testeurdetest','$2y$10$C8y5KYRGOsFdl5qmetlP2uRrN.QTk1daLY1ahn9PGlDWOV5aZiZPq',NULL,'testeur@testeur.tes',0),(16,'unitTest','$2y$10$Ln/JOYp1TqBKI6QxWlOB..zxZPCcK0Hd9YwAv2fQ8LSZXnePuOqtC',NULL,'unitTest@mail.com',0),(60,'Admin','$2y$10$3ZgGDNCKPt9YcQdNXJKUqeKpsZ0pZqPr.pT937o9Qb82OMMRxrdE6',NULL,'Admin@root.mail',10);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_badge`
--

DROP TABLE IF EXISTS `user_badge`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_badge` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_badge` int NOT NULL,
  `id_user` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_badge`
--

LOCK TABLES `user_badge` WRITE;
/*!40000 ALTER TABLE `user_badge` DISABLE KEYS */;
INSERT INTO `user_badge` VALUES (1,1,5),(2,5,2);
/*!40000 ALTER TABLE `user_badge` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-03-12 15:00:05
