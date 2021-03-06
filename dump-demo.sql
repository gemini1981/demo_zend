-- MySQL dump 10.17  Distrib 10.3.15-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: demo
-- ------------------------------------------------------
-- Server version	10.3.15-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `polizze`
--

DROP TABLE IF EXISTS `polizze`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `polizze` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idutente` int(11) NOT NULL,
  `numero` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `compagnia` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dataemissione` date NOT NULL,
  `datascadenza` date NOT NULL,
  `premio` float(10,2) NOT NULL,
  `tipo` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `polizze_UN` (`numero`,`compagnia`),
  KEY `polizze_utenti_FK` (`idutente`),
  CONSTRAINT `polizze_utenti_FK` FOREIGN KEY (`idutente`) REFERENCES `utenti` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `polizze`
--

LOCK TABLES `polizze` WRITE;
/*!40000 ALTER TABLE `polizze` DISABLE KEYS */;
INSERT INTO `polizze` VALUES (20,13,'N0001','assicurazione1','2019-06-02','2019-06-02',10.44,'casa'),(21,13,'N0002','assicurazione1','2019-06-02','2019-06-22',23.00,'auto');
/*!40000 ALTER TABLE `polizze` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `polizze_auto`
--

DROP TABLE IF EXISTS `polizze_auto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `polizze_auto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idpolizza` int(11) NOT NULL,
  `marca` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modello` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `targa` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `polizze_casa_id_polizza_IDX` (`idpolizza`) USING BTREE,
  CONSTRAINT `polizze_auto_polizze_FK` FOREIGN KEY (`idpolizza`) REFERENCES `polizze` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `polizze_auto`
--

LOCK TABLES `polizze_auto` WRITE;
/*!40000 ALTER TABLE `polizze_auto` DISABLE KEYS */;
INSERT INTO `polizze_auto` VALUES (2,21,'audi','tt','JJ888MM');
/*!40000 ALTER TABLE `polizze_auto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `polizze_casa`
--

DROP TABLE IF EXISTS `polizze_casa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `polizze_casa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idpolizza` int(11) NOT NULL,
  `citta` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cap` int(10) DEFAULT NULL,
  `indirizzo` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `civico` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `polizze_casa_id_polizza_IDX` (`idpolizza`) USING BTREE,
  CONSTRAINT `polizze_casa_polizze_FK` FOREIGN KEY (`idpolizza`) REFERENCES `polizze` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `polizze_casa`
--

LOCK TABLES `polizze_casa` WRITE;
/*!40000 ALTER TABLE `polizze_casa` DISABLE KEYS */;
INSERT INTO `polizze_casa` VALUES (8,20,'milano',20137,'via cadolini','30');
/*!40000 ALTER TABLE `polizze_casa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utenti`
--

DROP TABLE IF EXISTS `utenti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utenti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nome` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cognome` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `utenti_UN` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utenti`
--

LOCK TABLES `utenti` WRITE;
/*!40000 ALTER TABLE `utenti` DISABLE KEYS */;
INSERT INTO `utenti` VALUES (13,'demo1@email.com','$2y$10$FPgKyKMnhgrp8zZbntcEnOaE9mk9unNlkVZceMg1uG0Nojceq2Maa','nome1','cognome1'),(14,'demo2@email.com','$2y$10$eeHNFAvCyMfdb4iBlU8NY.II7Of/R7s8.sPdMzaPCdX7OYh/w2Rl6','nome2','cognome2');
/*!40000 ALTER TABLE `utenti` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'demo'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-06-02 19:03:45
