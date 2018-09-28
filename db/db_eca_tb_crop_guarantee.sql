-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: db_eca
-- ------------------------------------------------------
-- Server version	5.7.21-log

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
-- Table structure for table `tb_crop_guarantee`
--

DROP TABLE IF EXISTS `tb_crop_guarantee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_crop_guarantee` (
  `id_crop_guarantee` int(11) NOT NULL AUTO_INCREMENT,
  `str_month` varchar(2) NOT NULL,
  `str_year` varchar(4) NOT NULL,
  `db_value` double NOT NULL,
  `tb_city_id_city` int(11) NOT NULL,
  `tb_beneficiaries_id_beneficiaries` bigint(20) NOT NULL,
  PRIMARY KEY (`id_crop_guarantee`),
  KEY `fk_tb_crop_guarantee_tb_city1_idx` (`tb_city_id_city`),
  KEY `fk_tb_crop_guarantee_tb_beneficiaries1_idx` (`tb_beneficiaries_id_beneficiaries`),
  CONSTRAINT `fk_tb_crop_guarantee_tb_beneficiaries1` FOREIGN KEY (`tb_beneficiaries_id_beneficiaries`) REFERENCES `tb_beneficiaries` (`id_beneficiaries`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_crop_guarantee_tb_city1` FOREIGN KEY (`tb_city_id_city`) REFERENCES `tb_city` (`id_city`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_crop_guarantee`
--

LOCK TABLES `tb_crop_guarantee` WRITE;
/*!40000 ALTER TABLE `tb_crop_guarantee` DISABLE KEYS */;
INSERT INTO `tb_crop_guarantee` VALUES (2,'05','2015',301,2,2),(5,'09','2014',181,1,5);
/*!40000 ALTER TABLE `tb_crop_guarantee` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-09-28 14:35:56
