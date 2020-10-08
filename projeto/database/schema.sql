-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema prova
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema prova
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `prova` DEFAULT CHARACTER SET utf8 ;
USE `prova` ;

-- -----------------------------------------------------
-- Table `prova`.`agentes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `prova`.`agentes` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `cpf` CHAR(14) NOT NULL,
  `nome` VARCHAR(155) NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `deleted_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `cpf_UNIQUE` (`cpf` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prova`.`pacientes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `prova`.`pacientes` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `agente_id` INT UNSIGNED NOT NULL,
  `idade` INT(3) NULL,
  `end_rua` VARCHAR(155) NOT NULL,
  `end_bairro` VARCHAR(100) NOT NULL,
  `end_cidade` VARCHAR(100) NOT NULL,
  `end_uf` CHAR(2) NOT NULL,
  `end_complemento` VARCHAR(155) NULL,
  `end_cep` CHAR(8) NULL,
  `telefone` CHAR(15) NULL,
  `celular` CHAR(16) NULL,
  `deleted_at` TIMESTAMP NULL,
  INDEX `fk_agente_agente_id_idx` (`agente_id` ASC),
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_agente_agente_id`
    FOREIGN KEY (`agente_id`)
    REFERENCES `prova`.`agentes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prova`.`medicos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `prova`.`medicos` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `agente_id` INT UNSIGNED NOT NULL,
  `crm` CHAR(25) NOT NULL,
  UNIQUE INDEX `crm_UNIQUE` (`crm` ASC),
  INDEX `fk_agentes_id_medicos_idx` (`agente_id` ASC),
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_agentes_id_medicos`
    FOREIGN KEY (`agente_id`)
    REFERENCES `prova`.`agentes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prova`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `prova`.`users` (
  `id` INT NOT NULL,
  `agente_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(30) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `role` CHAR(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC),
  INDEX `fk_agentes_users_agente_id_idx` (`agente_id` ASC),
  CONSTRAINT `fk_agentes_users_agente_id`
    FOREIGN KEY (`agente_id`)
    REFERENCES `prova`.`agentes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prova`.`especialidades`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `prova`.`especialidades` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `espec` VARCHAR(155) NOT NULL,
  `descricao` VARCHAR(255) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prova`.`especialidade_medico`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `prova`.`especialidade_medico` (
  `id` INT NOT NULL,
  `especialidade_id` INT UNSIGNED NOT NULL,
  `medico_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_especialidades_especialidade_id_idx` (`especialidade_id` ASC),
  INDEX `fk_medicos_medio_id_idx` (`medico_id` ASC),
  CONSTRAINT `fk_especialidades_especialidade_id`
    FOREIGN KEY (`especialidade_id`)
    REFERENCES `prova`.`especialidades` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_medicos_medio_id`
    FOREIGN KEY (`medico_id`)
    REFERENCES `prova`.`medicos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prova`.`atendimentos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `prova`.`atendimentos` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `paciente_id` INT UNSIGNED NOT NULL,
  `medico_id` INT UNSIGNED NOT NULL,
  `disponibilidade` TINYINT UNSIGNED NULL,
  `created_at` TIMESTAMP NOT NULL,
  `updated_at` TIMESTAMP NULL,
  `deleted_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  INDEX `atendimentos_paciente_id_idx` (`paciente_id` ASC),
  INDEX `atendimentos_medico_id_idx` (`medico_id` ASC),
  CONSTRAINT `atendimentos_paciente_id`
    FOREIGN KEY (`paciente_id`)
    REFERENCES `prova`.`pacientes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `atendimentos_medico_id`
    FOREIGN KEY (`medico_id`)
    REFERENCES `prova`.`medicos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prova`.`arquivos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `prova`.`arquivos` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `filename` VARCHAR(155) NOT NULL,
  `filesize` CHAR(20) NOT NULL,
  `mimetype` CHAR(50) NOT NULL,
  `filepath` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `deleted_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prova`.`exames`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `prova`.`exames` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `paciente_id` INT UNSIGNED NOT NULL,
  `medico_id` INT UNSIGNED NOT NULL,
  `arquivo_id` INT UNSIGNED NOT NULL,
  `data_exame` DATE NOT NULL,
  `created_at` TIMESTAMP NOT NULL,
  `updated_at` TIMESTAMP NULL,
  `deleted_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  INDEX `exames_medico_id_idx` (`medico_id` ASC),
  INDEX `exames_paciente_id_idx` (`paciente_id` ASC),
  INDEX `exames_arquivo_id_idx` (`arquivo_id` ASC),
  CONSTRAINT `exames_medico_id`
    FOREIGN KEY (`medico_id`)
    REFERENCES `prova`.`medicos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `exames_paciente_id`
    FOREIGN KEY (`paciente_id`)
    REFERENCES `prova`.`pacientes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `exames_arquivo_id`
    FOREIGN KEY (`arquivo_id`)
    REFERENCES `prova`.`arquivos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prova`.`laudos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `prova`.`laudos` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `medico_id` INT UNSIGNED NOT NULL,
  `exame_id` INT UNSIGNED NOT NULL,
  `testes_realizados` TEXT NOT NULL,
  `motivo` VARCHAR(155) NOT NULL,
  `laudo` TEXT NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `deleted_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  INDEX `laudos_medico_id_idx` (`medico_id` ASC),
  INDEX `laudos_exame_id_idx` (`exame_id` ASC),
  CONSTRAINT `laudos_medico_id`
    FOREIGN KEY (`medico_id`)
    REFERENCES `prova`.`medicos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `laudos_exame_id`
    FOREIGN KEY (`exame_id`)
    REFERENCES `prova`.`exames` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
