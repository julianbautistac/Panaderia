-- MySQL dump 10.13  Distrib 8.0.28, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: panaderia
-- ------------------------------------------------------
-- Server version	8.0.28

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
-- Table structure for table `exedente`
--

DROP TABLE IF EXISTS `exedente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `exedente` (
  `id_exedente` int unsigned NOT NULL AUTO_INCREMENT,
  `cantidad_producto` int NOT NULL,
  `cantidad_produccion` int NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id_exedente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exedente`
--

LOCK TABLES `exedente` WRITE;
/*!40000 ALTER TABLE `exedente` DISABLE KEYS */;
/*!40000 ALTER TABLE `exedente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nombres`
--

DROP TABLE IF EXISTS `nombres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nombres` (
  `id_nombre` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'Llave primaria',
  `Nombre` varchar(30) NOT NULL,
  `Apellido_pat` varchar(30) NOT NULL,
  `Apellido_mat` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nombres`
--

LOCK TABLES `nombres` WRITE;
/*!40000 ALTER TABLE `nombres` DISABLE KEYS */;
/*!40000 ALTER TABLE `nombres` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pedidos` (
  `id_pedido` int unsigned NOT NULL,
  `cantidad_producto` int NOT NULL,
  PRIMARY KEY (`id_pedido`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos`
--

LOCK TABLES `pedidos` WRITE;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produccion`
--

DROP TABLE IF EXISTS `produccion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produccion` (
  `id_produccion` int unsigned NOT NULL,
  `fecha` date NOT NULL,
  `cantidad_produccion` int NOT NULL,
  `pronostico_tiempo` varchar(15) NOT NULL,
  `fk_id_pedido` int unsigned DEFAULT NULL,
  `fk_id_exedente` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id_produccion`),
  KEY `fk_id_pedido` (`fk_id_pedido`),
  KEY `fk_id_exedente` (`fk_id_exedente`),
  CONSTRAINT `produccion_ibfk_1` FOREIGN KEY (`fk_id_pedido`) REFERENCES `pedidos` (`id_pedido`),
  CONSTRAINT `produccion_ibfk_2` FOREIGN KEY (`fk_id_exedente`) REFERENCES `exedente` (`id_exedente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produccion`
--

LOCK TABLES `produccion` WRITE;
/*!40000 ALTER TABLE `produccion` DISABLE KEYS */;
/*!40000 ALTER TABLE `produccion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produccion_usuario`
--

DROP TABLE IF EXISTS `produccion_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produccion_usuario` (
  `fk_id_usuario` int unsigned DEFAULT NULL,
  `fk_id_produccion` int unsigned DEFAULT NULL,
  KEY `fk_id_usuario` (`fk_id_usuario`),
  KEY `fk_id_produccion` (`fk_id_produccion`),
  CONSTRAINT `produccion_usuario_ibfk_1` FOREIGN KEY (`fk_id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  CONSTRAINT `produccion_usuario_ibfk_2` FOREIGN KEY (`fk_id_produccion`) REFERENCES `produccion` (`id_produccion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produccion_usuario`
--

LOCK TABLES `produccion_usuario` WRITE;
/*!40000 ALTER TABLE `produccion_usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `produccion_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id_usuario` int unsigned NOT NULL AUTO_INCREMENT,
  `usuario` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `fk_id_nombre` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `fk_id_nombre` (`fk_id_nombre`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`fk_id_nombre`) REFERENCES `nombres` (`id_nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-21 22:13:01
