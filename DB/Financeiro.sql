-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema db_financeiro
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema db_financeiro
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `db_financeiro` DEFAULT CHARACTER SET utf8 ;
USE `db_financeiro` ;

-- -----------------------------------------------------
-- Table `db_financeiro`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_financeiro`.`usuario` (
  `id_usuario` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome_usuario` VARCHAR(50) NOT NULL,
  `email_usuario` VARCHAR(50) NOT NULL,
  `senha_usuario` VARCHAR(20) NOT NULL,
  `data_cadastro` DATE NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE INDEX `email_usuario_UNIQUE` (`email_usuario` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_financeiro`.`empresa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_financeiro`.`empresa` (
  `id_empresa` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome_empresa` VARCHAR(50) NOT NULL,
  `telefone_empresa` VARCHAR(11) NULL,
  `endereco_empresa` VARCHAR(100) NULL,
  `id_usuario` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id_empresa`),
  INDEX `fk_empresa_usuario1_idx` (`id_usuario` ASC) VISIBLE,
  CONSTRAINT `fk_empresa_usuario1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `db_financeiro`.`usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = '	';


-- -----------------------------------------------------
-- Table `db_financeiro`.`conta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_financeiro`.`conta` (
  `id_conta` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `banco_conta` VARCHAR(50) NOT NULL,
  `agencia_conta` VARCHAR(8) NOT NULL,
  `numero_conta` VARCHAR(12) NOT NULL,
  `saldo_conta` DECIMAL(10,2) NOT NULL,
  `id_usuario` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id_conta`),
  INDEX `fk_conta_usuario1_idx` (`id_usuario` ASC) VISIBLE,
  CONSTRAINT `fk_conta_usuario1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `db_financeiro`.`usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_financeiro`.`categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_financeiro`.`categoria` (
  `id_categoria` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome_categoria` VARCHAR(35) NOT NULL,
  `id_usuario` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id_categoria`),
  INDEX `fk_categoria_usuario1_idx` (`id_usuario` ASC) VISIBLE,
  CONSTRAINT `fk_categoria_usuario1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `db_financeiro`.`usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_financeiro`.`movimento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_financeiro`.`movimento` (
  `id_movimento` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `tipo_movimento` TINYINT(1) NOT NULL,
  `data_movimento` DATE NOT NULL,
  `valor_movimento` DECIMAL(10,2) NOT NULL,
  `obs_movimento` VARCHAR(100) NULL,
  `id_empresa` INT UNSIGNED NOT NULL,
  `id_conta` INT UNSIGNED NOT NULL,
  `id_categoria` INT UNSIGNED NOT NULL,
  `id_usuario` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id_movimento`),
  INDEX `fk_movimento_empresa_idx` (`id_empresa` ASC) VISIBLE,
  INDEX `fk_movimento_conta1_idx` (`id_conta` ASC) VISIBLE,
  INDEX `fk_movimento_categoria1_idx` (`id_categoria` ASC) VISIBLE,
  INDEX `fk_movimento_usuario1_idx` (`id_usuario` ASC) VISIBLE,
  CONSTRAINT `fk_movimento_empresa`
    FOREIGN KEY (`id_empresa`)
    REFERENCES `db_financeiro`.`empresa` (`id_empresa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_movimento_conta1`
    FOREIGN KEY (`id_conta`)
    REFERENCES `db_financeiro`.`conta` (`id_conta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_movimento_categoria1`
    FOREIGN KEY (`id_categoria`)
    REFERENCES `db_financeiro`.`categoria` (`id_categoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_movimento_usuario1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `db_financeiro`.`usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
