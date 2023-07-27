CREATE DATABASE  IF NOT EXISTS `newfinance` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `newfinance`;
-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: localhost    Database: newfinance
-- ------------------------------------------------------
-- Server version	5.7.14

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
-- Table structure for table `centrodecusto`
--

DROP TABLE IF EXISTS `centrodecusto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `centrodecusto` (
  `id_centrodecusto` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(128) NOT NULL,
  `ativo` bit(1) NOT NULL,
  PRIMARY KEY (`id_centrodecusto`),
  UNIQUE KEY `nome_UNIQUE` (`nome`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `centrodecusto`
--

LOCK TABLES `centrodecusto` WRITE;
/*!40000 ALTER TABLE `centrodecusto` DISABLE KEYS */;
INSERT INTO `centrodecusto` VALUES (1,'Diego',''),(2,'Natus','');
/*!40000 ALTER TABLE `centrodecusto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `centrodecusto_finalidade`
--

DROP TABLE IF EXISTS `centrodecusto_finalidade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `centrodecusto_finalidade` (
  `id_centrodecusto` int(11) NOT NULL,
  `id_finalidade` int(11) NOT NULL,
  `ativo` int(11) NOT NULL,
  PRIMARY KEY (`id_centrodecusto`,`id_finalidade`),
  UNIQUE KEY `chave_unica` (`id_centrodecusto`,`id_finalidade`),
  KEY `fk_centrodecusto_has_finalidade_finalidade1_idx` (`id_finalidade`),
  KEY `fk_centrodecusto_has_finalidade_centrodecusto1_idx` (`id_centrodecusto`),
  CONSTRAINT `fk_centrodecusto_has_finalidade_centrodecusto1` FOREIGN KEY (`id_centrodecusto`) REFERENCES `centrodecusto` (`id_centrodecusto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_centrodecusto_has_finalidade_finalidade1` FOREIGN KEY (`id_finalidade`) REFERENCES `finalidade` (`id_finalidade`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `centrodecusto_finalidade`
--

LOCK TABLES `centrodecusto_finalidade` WRITE;
/*!40000 ALTER TABLE `centrodecusto_finalidade` DISABLE KEYS */;
INSERT INTO `centrodecusto_finalidade` VALUES (1,1,1);
/*!40000 ALTER TABLE `centrodecusto_finalidade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `finalidade`
--

DROP TABLE IF EXISTS `finalidade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `finalidade` (
  `id_finalidade` int(11) NOT NULL AUTO_INCREMENT,
  `id_grupodefinalidade` int(11) NOT NULL,
  `nome` varchar(128) NOT NULL,
  `ativo` int(11) NOT NULL,
  PRIMARY KEY (`id_finalidade`,`id_grupodefinalidade`),
  UNIQUE KEY `nome_UNIQUE` (`nome`),
  KEY `fk_finalidade_grupodefinalidade1_idx` (`id_grupodefinalidade`),
  CONSTRAINT `fk_finalidade_grupodefinalidade1` FOREIGN KEY (`id_grupodefinalidade`) REFERENCES `grupodefinalidade` (`id_grupodefinalidade`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `finalidade`
--

LOCK TABLES `finalidade` WRITE;
/*!40000 ALTER TABLE `finalidade` DISABLE KEYS */;
INSERT INTO `finalidade` VALUES (1,1,'Juros Bradesco',1);
/*!40000 ALTER TABLE `finalidade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupodefinalidade`
--

DROP TABLE IF EXISTS `grupodefinalidade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grupodefinalidade` (
  `id_grupodefinalidade` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(256) NOT NULL,
  `Ativo` int(11) NOT NULL,
  PRIMARY KEY (`id_grupodefinalidade`),
  UNIQUE KEY `nome_UNIQUE` (`nome`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupodefinalidade`
--

LOCK TABLES `grupodefinalidade` WRITE;
/*!40000 ALTER TABLE `grupodefinalidade` DISABLE KEYS */;
INSERT INTO `grupodefinalidade` VALUES (1,'Banco, etc.',1);
/*!40000 ALTER TABLE `grupodefinalidade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lancamento`
--

DROP TABLE IF EXISTS `lancamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lancamento` (
  `id_lancamento` int(11) NOT NULL AUTO_INCREMENT,
  `id_centrodecusto` int(11) NOT NULL,
  `id_finalidade` int(11) NOT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id_lancamento`,`id_centrodecusto`,`id_finalidade`),
  KEY `fk_lancamento_centrodecusto_finalidade1_idx` (`id_centrodecusto`,`id_finalidade`),
  CONSTRAINT `fk_lancamento_centrodecusto_finalidade1` FOREIGN KEY (`id_centrodecusto`, `id_finalidade`) REFERENCES `centrodecusto_finalidade` (`id_centrodecusto`, `id_finalidade`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lancamento`
--

LOCK TABLES `lancamento` WRITE;
/*!40000 ALTER TABLE `lancamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `lancamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(128) NOT NULL,
  `login` varchar(45) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `ativo` bit(1) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `nome_UNIQUE` (`nome`),
  UNIQUE KEY `login_UNIQUE` (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-01-18 18:25:11
