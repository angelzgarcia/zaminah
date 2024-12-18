-- MySQL Script generated by MySQL Workbench
-- Sat Oct 12 23:40:32 2024
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema zam
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema zam
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `zam` DEFAULT CHARACTER SET utf8 ;
SHOW WARNINGS;
USE `zam` ;

-- -----------------------------------------------------
-- Table `rol`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rol` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `rol` (
  `idRol` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `tipo` ENUM('administrador', 'usuario') NOT NULL,
  PRIMARY KEY (`idRol`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `usuario` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `google_id` BIGINT UNSIGNED NOT NULL,
  `nombre` VARCHAR(80) NOT NULL,
  `genero` VARCHAR(10) NOT NULL,
  `foto` BLOB NOT NULL,
  `email` VARCHAR(65) NOT NULL,
  `numero` BIGINT UNSIGNED NOT NULL,
  `password` VARCHAR(25) NOT NULL,
  `token` VARCHAR(8) NOT NULL,
  `confirmado` TINYINT NOT NULL,
  `status` ENUM('activo', 'inactivo') NOT NULL,
  `idRol` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idUsuario`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) VISIBLE,
  UNIQUE INDEX `numero_UNIQUE` (`numero` ASC) VISIBLE,
  INDEX `id_rol_idx` (`idRol` ASC) VISIBLE,
  UNIQUE INDEX `google_id_UNIQUE` (`google_id` ASC) VISIBLE,
  CONSTRAINT `idRol`
    FOREIGN KEY (`idRol`)
    REFERENCES `rol` (`idRol`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `estado_republica`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `estado_republica` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `estado_republica` (
  `idEstadoRepublica` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(30) NOT NULL,
  `capital` VARCHAR(45) NOT NULL,
  `foto` BLOB NOT NULL,
  `videoInformativo` VARCHAR(100) NOT NULL,
  `tripticoZonas` BLOB NOT NULL,
  `guiaEstado` BLOB NOT NULL,
  PRIMARY KEY (`idEstadoRepublica`),
  UNIQUE INDEX `nombre_UNIQUE` (`nombre` ASC) VISIBLE)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `cultura`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cultura` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `cultura` (
  `idCultura` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) NOT NULL,
  `periodo` VARCHAR(50) NOT NULL,
  `significado` VARCHAR(200) NOT NULL,
  `descripcion` VARCHAR(1200) NOT NULL,
  `foto` BLOB NOT NULL,
  `aportaciones` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`idCultura`),
  UNIQUE INDEX `nombre_UNIQUE` (`nombre` ASC) VISIBLE)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `zonas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zonas` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `zonas` (
  `` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) NOT NULL,
  `foto` BLOB NOT NULL,
  `significado` VARCHAR(200) NOT NULL,
  `descripcion` VARCHAR(1200) NOT NULL,
  `acceso` VARCHAR(500) NOT NULL,
  `horario` VARCHAR(60) NOT NULL,
  `costoEntrada` DECIMAL(4,2) NOT NULL,
  `contacto` VARCHAR(50) NOT NULL,
  `idEstadoRepublica` INT UNSIGNED NOT NULL,
  `idCultura` INT UNSIGNED NOT NULL,
  PRIMARY KEY (``),
  INDEX `idEstadoRepublica_idx` (`idEstadoRepublica` ASC) VISIBLE,
  INDEX `idCultura_idx` (`idCultura` ASC) VISIBLE,
  UNIQUE INDEX `nombre_UNIQUE` (`nombre` ASC) VISIBLE,
  CONSTRAINT `idEstadoRepublica`
    FOREIGN KEY (`idEstadoRepublica`)
    REFERENCES `estado_republica` (`idEstadoRepublica`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `idCultura`
    FOREIGN KEY (`idCultura`)
    REFERENCES `cultura` (`idCultura`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `resenia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `resenia` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `resenia` (
  `idResenia` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `mensaje` VARCHAR(200) NOT NULL,
  `puntuacion` TINYINT UNSIGNED NOT NULL,
  `foto` BLOB NOT NULL,
  `idUsuario` INT UNSIGNED NOT NULL,
  `idZonaArqueologica` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idResenia`),
  INDEX `idUsuario_idx` (`idUsuario` ASC) VISIBLE,
  INDEX `idZonaArqueologica_idx` (`idZonaArqueologica` ASC) VISIBLE,
  CONSTRAINT `idUsuario`
    FOREIGN KEY (`idUsuario`)
    REFERENCES `usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `idZonaArqueologica`
    FOREIGN KEY (`idZonaArqueologica`)
    REFERENCES `zonas` (``)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `ubicacion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ubicacion` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `ubicacion` (
  `idUbicacion` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `latitud` DECIMAL(6,3) NOT NULL,
  `longitud` DECIMAL(6,3) NOT NULL,
  `idZonaArqueologica` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idUbicacion`),
  UNIQUE INDEX `idZonaArqueologica_UNIQUE` (`idZonaArqueologica` ASC) VISIBLE,
  CONSTRAINT `idZonaArqueologica`
    FOREIGN KEY (`idZonaArqueologica`)
    REFERENCES `zonas` (``)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `cultura_estado`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cultura_estado` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `cultura_estado` (
  `idCulturaEstado` INT NOT NULL AUTO_INCREMENT,
  `idCultura` INT UNSIGNED NOT NULL,
  `idEstadoRepublica` INT UNSIGNED NOT NULL,
  INDEX `id_cultura_idx` (`idCultura` ASC) VISIBLE,
  INDEX `id_estado_republica_idx` (`idEstadoRepublica` ASC) VISIBLE,
  PRIMARY KEY (`idCulturaEstado`),
  CONSTRAINT `idCultura`
    FOREIGN KEY (`idCultura`)
    REFERENCES `cultura` (`idCultura`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `idEstadoRepublica`
    FOREIGN KEY (`idEstadoRepublica`)
    REFERENCES `estado_republica` (`idEstadoRepublica`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
