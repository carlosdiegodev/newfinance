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
  `ativo` int(11) NOT NULL,
  PRIMARY KEY (`id_centrodecusto`),
  UNIQUE KEY `nome_UNIQUE` (`nome`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `centrodecusto`
--

LOCK TABLES `centrodecusto` WRITE;
/*!40000 ALTER TABLE `centrodecusto` DISABLE KEYS */;
INSERT INTO `centrodecusto` VALUES (1,'Diego',1),(2,'Leidy',1),(3,'Natus',1),(4,'Recebidos de volta',1);
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
INSERT INTO `centrodecusto_finalidade` VALUES (1,42,1);
/*!40000 ALTER TABLE `centrodecusto_finalidade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contasapagar`
--

DROP TABLE IF EXISTS `contasapagar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contasapagar` (
  `id_contasapagar` int(11) NOT NULL AUTO_INCREMENT,
  `id_centrodecusto` int(11) NOT NULL,
  `descricao` varchar(400) NOT NULL,
  `datadereferencia` date NOT NULL,
  `datadevencimento` date NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `pago` int(11) NOT NULL,
  `ativo` int(11) NOT NULL,
  PRIMARY KEY (`id_contasapagar`),
  KEY `centrodecusto_idx` (`id_centrodecusto`),
  CONSTRAINT `centrodecusto` FOREIGN KEY (`id_centrodecusto`) REFERENCES `centrodecusto` (`id_centrodecusto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contasapagar`
--

LOCK TABLES `contasapagar` WRITE;
/*!40000 ALTER TABLE `contasapagar` DISABLE KEYS */;
INSERT INTO `contasapagar` VALUES (1,1,'FACULDADE DIEGO','2017-02-10','2017-02-10',1030.01,1,1),(2,1,'UNIMED DA LEIDYs','2019-07-01','2018-06-01',1258.90,1,1);
/*!40000 ALTER TABLE `contasapagar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `finalidade`
--

DROP TABLE IF EXISTS `finalidade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `finalidade` (
  `id_finalidade` int(11) NOT NULL AUTO_INCREMENT,
  `id_grupodefinalidade` int(11) DEFAULT NULL,
  `nome` varchar(128) NOT NULL,
  `ativo` int(11) NOT NULL,
  PRIMARY KEY (`id_finalidade`),
  UNIQUE KEY `nome_UNIQUE` (`nome`),
  KEY `fk_finalidade_grupodefinalidade1_idx` (`id_grupodefinalidade`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `finalidade`
--

LOCK TABLES `finalidade` WRITE;
/*!40000 ALTER TABLE `finalidade` DISABLE KEYS */;
INSERT INTO `finalidade` VALUES (1,1,'Juros Bradesco',1),(2,1,'Empréstimo',1),(3,2,'Teste de Finalidade',1),(4,2,'Nova finalidade',1),(7,NULL,'testenovafinalidade',1),(8,3,'TesteFinalidade',1),(9,NULL,'teste',1),(11,NULL,'testenovo',1),(12,NULL,'testenovo1',1),(14,NULL,'testenovo1234',1),(16,NULL,'TesteOK123Finalidade',1),(17,NULL,'TesteOK123Finalidade1',1),(18,4,'NovaFinalidadez',1),(19,5,'NovaFinalidadezzz',1),(20,6,'TesteNovaFinalidade1',1),(21,6,'Funfou',1),(22,4,'Funfaste',1),(23,1,'adfsasdASDAdsa',1),(24,7,'FinalidadeHappy',1),(25,8,'Testz',1),(26,9,'ultimo teste finalidade',1),(27,10,'Agora vai',1),(28,11,'asdas sda sda sdas ',1),(29,NULL,'testeasdasdasd',1),(30,12,'novafinalidadefinalidade',1),(31,13,'lastfinalidade9',1),(32,NULL,'larc',1),(33,10,'last999',1),(34,NULL,'Urry',1),(35,NULL,'tasdljsdafdsfkjkfads',1),(36,NULL,'asddasfafdadfadfdafs',1),(37,NULL,'a',1),(38,NULL,'luidne',1),(39,1,'juros caríssimos',1),(40,14,'asldasoiudsajkldalhklklkasd',1),(41,14,'dsfsdfzzzzz',1),(42,15,'Comida fora de casa',1);
/*!40000 ALTER TABLE `finalidade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `formadepagamento`
--

DROP TABLE IF EXISTS `formadepagamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `formadepagamento` (
  `id_formadepagamento` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` int(11) DEFAULT NULL,
  `nome` varchar(100) NOT NULL,
  `ativo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_formadepagamento`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `formadepagamento`
--

LOCK TABLES `formadepagamento` WRITE;
/*!40000 ALTER TABLE `formadepagamento` DISABLE KEYS */;
INSERT INTO `formadepagamento` VALUES (1,1,'Dinheiro',1);
/*!40000 ALTER TABLE `formadepagamento` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupodefinalidade`
--

LOCK TABLES `grupodefinalidade` WRITE;
/*!40000 ALTER TABLE `grupodefinalidade` DISABLE KEYS */;
INSERT INTO `grupodefinalidade` VALUES (15,'Alimentação',1);
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
  `id_lancamentopai` int(11) DEFAULT NULL,
  `id_centrodecusto` int(11) NOT NULL,
  `id_finalidade` int(11) NOT NULL,
  `id_formadepagamento` int(11) NOT NULL,
  `tipolancamento` int(11) NOT NULL,
  `despesaconfirmada` int(11) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `datadoacontecimento` datetime DEFAULT NULL,
  `datareferencia` datetime DEFAULT NULL,
  `datapagamento` datetime NOT NULL,
  `numerodocumento` varchar(50) DEFAULT NULL,
  `localdadespesa` varchar(100) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `descricaodetalhada` varchar(5000) DEFAULT NULL,
  `datacadastro` datetime DEFAULT CURRENT_TIMESTAMP,
  `ativo` int(11) NOT NULL,
  `numeroparcela` int(11) DEFAULT NULL,
  `qtparcelas` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_lancamento`),
  KEY `fk_lancamento_centrodecusto_finalidade1_idx` (`id_centrodecusto`,`id_finalidade`),
  KEY `fk_lancamento_lancamento_idx` (`id_lancamentopai`),
  KEY `fk_formadepagamento_idx` (`id_formadepagamento`),
  CONSTRAINT `fk_formadepagamento` FOREIGN KEY (`id_formadepagamento`) REFERENCES `formadepagamento` (`id_formadepagamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lancamento_centrodecusto_finalidade1` FOREIGN KEY (`id_centrodecusto`, `id_finalidade`) REFERENCES `centrodecusto_finalidade` (`id_centrodecusto`, `id_finalidade`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lancamento_lancamento` FOREIGN KEY (`id_lancamentopai`) REFERENCES `lancamento` (`id_lancamento`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;
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

-- Dump completed on 2017-02-03 18:27:20
