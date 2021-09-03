-- MySQL dump 10.13  Distrib 8.0.26, for Win64 (x86_64)
--
-- Host: localhost    Database: tshirt_cart
-- ------------------------------------------------------
-- Server version	5.7.33

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
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(255) NOT NULL,
  `Apellido` varchar(255) NOT NULL,
  `Correo` varchar(255) NOT NULL,
  `Direccion` varchar(255) NOT NULL,
  `Barrio` varchar(255) DEFAULT NULL,
  `Sector` varchar(255) NOT NULL,
  `Lugar` varchar(255) NOT NULL,
  `Telefono` varchar(255) DEFAULT NULL,
  `precio_total` float(6,2) NOT NULL DEFAULT '0.00',
  `orden_estado` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,'Ahsan','Zameer','ahsnzmeerkhan@gmail.com','L-14 Gulshan-e-Malir, Malir Halt Karachi','L-14 Gulshan-e-Malir, Malir Halt Karachi','United States','California','75210',120.00,'confirmed','2021-02-15 11:16:10','2021-02-15 11:16:10'),(2,'Ahsan','Zameer','ahsnzmeerkhan@gmail.com','L-14 Gulshan-e-Malir, Malir Halt Karachi','L-14 Gulshan-e-Malir, Malir Halt Karachi','United States','California','75210',0.00,'confirmed','2021-02-15 11:18:47','2021-02-15 11:18:47'),(3,'Ahsan','Zameer','ahsnzmeerkhan@gmail.com','L-14 Gulshan-e-Malir, Malir Halt Karachi','L-14 Gulshan-e-Malir, Malir Halt Karachi','United States','California','75210',114.00,'confirmed','2021-02-15 11:21:50','2021-02-15 11:21:50'),(4,'Sandra','Lopez','sandra@gmail.com','Rios N4-161 y Chile','Rios N4-161 y Chile','United States','California','593',47.50,'confirmed','2021-09-02 17:49:37','2021-09-02 17:49:37'),(5,'Cristian','Mora','mora@gmail.com','Valparaiso E34-0','Valparaiso E34-0','United Lugars','California','098654780',85.50,'confirmed','2021-09-02 19:52:09','2021-09-02 19:52:09'),(6,'Nocol','SADFG','mra@gmail.com','Sangolqui','Sangolqui','Sur','Casa','0995497659',57.00,'confirmed','2021-09-02 20:51:18','2021-09-02 20:51:18'),(7,'Karla','Castillo','karla@gmail.com','Rios y Chile','Rios y Chile','Centro','Casa','0995463647',19.00,'confirmed','2021-09-02 23:01:20','2021-09-02 23:01:20'),(8,'Marco','Andrade','marco@gmail.com','Av. Simon Bolivar','Av. Simon Bolivar','Sur','Trabajo','0967853120',161.50,'confirmed','2021-09-02 23:36:44','2021-09-02 23:36:44'),(9,'Alvaro','Acosta','alvaro@gmail.com','Patria','Patria','Norte','Trabajo','2345678',19.00,'confirmed','2021-09-02 23:40:19','2021-09-02 23:40:19'),(10,'Carlos','Vaca','cv@gmail.com','Av. Simon Bolivar','Av. Simon Bolivar','Sur','Casa','0987654321',85.50,'confirmed','2021-09-02 23:44:09','2021-09-02 23:44:09');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-09-02 18:49:45
