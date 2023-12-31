-- MySQL Script generated by MySQL Workbench
-- 01/18/17 11:35:52
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema NewFinance
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema NewFinance
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `NewFinance` DEFAULT CHARACTER SET utf8 ;
USE `NewFinance` ;

-- -----------------------------------------------------
-- Table `NewFinance`.`centrodecusto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `NewFinance`.`centrodecusto` (
  `id_centrodecusto` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(128) NOT NULL,
  `ativo` BIT NOT NULL,
  PRIMARY KEY (`id_centrodecusto`),
  UNIQUE INDEX `nome_UNIQUE` (`nome` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `NewFinance`.`grupodefinalidade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `NewFinance`.`grupodefinalidade` (
  `id_grupodefinalidade` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(128) NOT NULL,
  `Ativo` BIT NOT NULL,
  PRIMARY KEY (`id_grupodefinalidade`),
  UNIQUE INDEX `nome_UNIQUE` (`nome` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `NewFinance`.`finalidade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `NewFinance`.`finalidade` (
  `id_finalidade` INT NOT NULL AUTO_INCREMENT,
  `id_grupodefinalidade` INT NOT NULL,
  `nome` VARCHAR(128) NOT NULL,
  `ativo` BIT NOT NULL,
  PRIMARY KEY (`id_finalidade`, `id_grupodefinalidade`),
  UNIQUE INDEX `nome_UNIQUE` (`nome` ASC),
  INDEX `fk_finalidade_grupodefinalidade1_idx` (`id_grupodefinalidade` ASC),
  CONSTRAINT `fk_finalidade_grupodefinalidade1`
    FOREIGN KEY (`id_grupodefinalidade`)
    REFERENCES `NewFinance`.`grupodefinalidade` (`id_grupodefinalidade`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `NewFinance`.`centrodecusto_finalidade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `NewFinance`.`centrodecusto_finalidade` (
  `id_centrodecusto` INT NOT NULL,
  `id_finalidade` INT NOT NULL,
  `ativo` BIT NOT NULL,
  PRIMARY KEY (`id_centrodecusto`, `id_finalidade`),
  INDEX `fk_centrodecusto_has_finalidade_finalidade1_idx` (`id_finalidade` ASC),
  INDEX `fk_centrodecusto_has_finalidade_centrodecusto1_idx` (`id_centrodecusto` ASC),
  UNIQUE INDEX `chave_unica` (`id_centrodecusto` ASC, `id_finalidade` ASC),
  CONSTRAINT `fk_centrodecusto_has_finalidade_centrodecusto1`
    FOREIGN KEY (`id_centrodecusto`)
    REFERENCES `NewFinance`.`centrodecusto` (`id_centrodecusto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_centrodecusto_has_finalidade_finalidade1`
    FOREIGN KEY (`id_finalidade`)
    REFERENCES `NewFinance`.`finalidade` (`id_finalidade`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `NewFinance`.`lancamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `NewFinance`.`lancamento` (
  `id_lancamento` INT NOT NULL AUTO_INCREMENT,
  `id_centrodecusto` INT NOT NULL,
  `id_finalidade` INT NOT NULL,
  `valor` DECIMAL(10,2) NULL,
  PRIMARY KEY (`id_lancamento`, `id_centrodecusto`, `id_finalidade`),
  INDEX `fk_lancamento_centrodecusto_finalidade1_idx` (`id_centrodecusto` ASC, `id_finalidade` ASC),
  CONSTRAINT `fk_lancamento_centrodecusto_finalidade1`
    FOREIGN KEY (`id_centrodecusto` , `id_finalidade`)
    REFERENCES `NewFinance`.`centrodecusto_finalidade` (`id_centrodecusto` , `id_finalidade`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `NewFinance`.`table1`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `NewFinance`.`table1` (
)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `NewFinance`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `NewFinance`.`usuario` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(128) NOT NULL,
  `login` VARCHAR(45) NOT NULL,
  `senha` VARCHAR(32) NOT NULL,
  `ativo` BIT NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE INDEX `nome_UNIQUE` (`nome` ASC),
  UNIQUE INDEX `login_UNIQUE` (`login` ASC))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
