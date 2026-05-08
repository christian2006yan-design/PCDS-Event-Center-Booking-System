-- MySQL dump 10.13  Distrib 8.0.44, for Win64 (x86_64)
--
-- Host: localhost    Database: pcds_booking
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bookings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_name` varchar(255) DEFAULT NULL,
  `event_date_start` date DEFAULT NULL,
  `event_date_end` date DEFAULT NULL,
  `event_time_start` time DEFAULT NULL,
  `event_time_end` time DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `course` varchar(45) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `guests` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `bookingscol` varchar(45) DEFAULT NULL,
  `booked_by` varchar(45) DEFAULT NULL,
  `booking_id` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1519 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookings`
--

LOCK TABLES `bookings` WRITE;
/*!40000 ALTER TABLE `bookings` DISABLE KEYS */;
/*!40000 ALTER TABLE `bookings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','123',NULL,NULL),(17,'rap1','rap1',NULL,NULL),(18,'dad','dad',NULL,NULL),(19,'toc','$2y$10$8IP7l5Xf92hlp7G2IwlkdOtPXbi5GbmAZCtQhO09xUiLZFg56Igl.',NULL,NULL),(20,'asdsad','$2y$10$E.ZTXQZI2jJjmY/2zLzSpehASyiNvgKmWhPEvD77VX0.Krj8r1YK6',NULL,NULL),(21,'sadasd','$2y$10$OorWVzDqcrdw4uz3jFnVS.vHbCNnHolk6H5PGoZkVxw84guSzofJm',NULL,NULL),(22,'adsa','$2y$10$i/ywXkRZ8gaa9JB7YEdK3O9gfCDE1chPjkoAHSjfj7omahZaHC/uy',NULL,NULL),(23,'asdsd','$2y$10$wYikK.DkwVdgUwWhBsuW..ml9AGQjiJwkPAbGD4rjcEUU8XuhYINW',NULL,NULL),(24,'asd','$2y$10$4xUixc8Qed8aW4xfO01pMe0G369pznRodUw6XpJ3XJ0kLqfGP1I9.',NULL,NULL),(25,'dasdas','$2y$10$qWgFEK9ryGgbHbMgcQWpCecm0oT/.tNebsu4Usm/bn8ZOIyz7vCN.',NULL,NULL),(26,'sad','$2y$10$rsZTRu/r0oKR1GT1WI0FAeE7d2MSOqorGGatZiMqFQI3sgRGMWo52',NULL,NULL),(27,'dasdasd','$2y$10$pCJThmGN3w9L3gDIEoN4O.YZlp7bK3phWjEhm1gazN2NV1BB99yce',NULL,NULL),(28,'asdasd','$2y$10$NHKZEfTnlucqcwV2gDBmxuqLyEFaZSuWvJ7lR9s4Wbr6LkA.zwt8S',NULL,NULL),(29,'dadasdadasda','$2y$10$B//WW7QsIdMQux3qqEqXZOvrIVsIDbp.0NFV1iukkIeADy50oEGPW',NULL,NULL),(30,'sasad','$2y$10$1teKi/4zFNA2ydojDWLkweMTbx3rq1aXGOqymCZEJ/s0/zYIQSgTq',NULL,NULL),(31,'dasdsadasdsad','$2y$10$7Nr6MHcmJ8oBEB5n42aaZe9nuL4vVBL1sL4ZGP0T7eXgMfd51TNPy',NULL,NULL),(32,'sdadassadsa','$2y$10$dKfDuBzbBOwN0q0.sbYLLuz17Psn0Kr8n1.rQnz8XwN8SarCZSu/a',NULL,NULL),(33,'sadasdasdas','$2y$10$vSfjIbnEwt0/0TghAG1e1ufEgGnEYv.JDl0VjVTTqrQGdM1QlAPy6',NULL,NULL),(34,'dasdasdasdsad','$2y$10$t5k1daSonxrZ0f52YzvYl.jzGszpP4tvTxGcQPFdCOW.Xmvf79Qii',NULL,NULL),(35,'asddd','$2y$10$ZB/1uM/Viyyrd7xBqr61Ie5IaxOVeXGPlGmW12Zws94BFThtc/lXC',NULL,NULL),(36,'dasw','$2y$10$PwskdmKh.VY.kdLwocQQpO.3hFFw5iOzQSS.9RbV6U0IbOSjSOB72',NULL,NULL);
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

-- Dump completed on 2026-05-08 20:34:24
