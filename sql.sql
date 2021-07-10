-- MySQL dump 10.13  Distrib 8.0.25, for Linux (x86_64)
--
-- Host: localhost    Database: LogServer
-- ------------------------------------------------------
-- Server version	8.0.25-0ubuntu0.20.04.1

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
-- Table structure for table `database`
--

DROP TABLE IF EXISTS `database`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `database` (
  `id` int NOT NULL AUTO_INCREMENT,
  `database_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `database`
--

LOCK TABLES `database` WRITE;
/*!40000 ALTER TABLE `database` DISABLE KEYS */;
INSERT INTO `database` VALUES (1,'portfolio');
/*!40000 ALTER TABLE `database` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `portfolio_log`
--

DROP TABLE IF EXISTS `portfolio_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `portfolio_log` (
  `id` int NOT NULL AUTO_INCREMENT,
  `hostname` varchar(255) DEFAULT NULL,
  `port` varchar(255) DEFAULT NULL,
  `size_of_response` varchar(50) DEFAULT NULL,
  `request_protocol` varchar(20) DEFAULT NULL,
  `error_log_id` varchar(50) DEFAULT NULL,
  `request_method` varchar(50) DEFAULT NULL,
  `request_status` varchar(255) DEFAULT NULL,
  `time_to_respond` varchar(100) DEFAULT NULL,
  `request_url` varchar(600) DEFAULT NULL,
  `user_agent` varchar(600) DEFAULT NULL,
  `age` varchar(20) DEFAULT NULL,
  `connection` varchar(50) DEFAULT NULL,
  `request_host` varchar(100) DEFAULT NULL,
  `date_of_request` varchar(150) DEFAULT NULL,
  `request_content_type` varchar(150) DEFAULT NULL,
  `request_content_encoding` varchar(150) DEFAULT NULL,
  `cors` varchar(50) DEFAULT NULL,
  `request_referer` varchar(200) DEFAULT NULL,
  `request_accept` varchar(200) DEFAULT NULL,
  `request_language` varchar(50) DEFAULT NULL,
  `response_encoding` varchar(20) DEFAULT NULL,
  `response_content_type` varchar(50) DEFAULT NULL,
  `response_keep_alive` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10723 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `portfolio_log`
--

LOCK TABLES `portfolio_log` WRITE;
/*!40000 ALTER TABLE `portfolio_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `portfolio_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (3,'administrator','$2y$10$Zflu5tm/RKR4iTN.l3zH.O1wXhI3l/nq4UNhE5Etk5kS/.OdWMjlS');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `web_app`
--

DROP TABLE IF EXISTS `web_app`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `web_app` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `log_database` varchar(50) NOT NULL,
  `db_database` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `web_app`
--

LOCK TABLES `web_app` WRITE;
/*!40000 ALTER TABLE `web_app` DISABLE KEYS */;
INSERT INTO `web_app` VALUES (1,'portfolio','portfolio_log','portfolio'),(2,'ServerConfig','ServerConfig_log','');
/*!40000 ALTER TABLE `web_app` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-06-23 17:06:27
