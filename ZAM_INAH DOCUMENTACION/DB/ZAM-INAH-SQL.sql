-- MySQL Script generated by MySQL Workbench
-- Mon Oct 21 13:08:27 2024
-- Model: zaminah    Version: 1.0
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
-- Table `roles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `roles` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `roles` (
  `idRol` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `tipo` ENUM('administrador', 'usuario') NOT NULL,
  PRIMARY KEY (`idRol`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `usuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `usuarios` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `usuarios` (
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
    REFERENCES `roles` (`idRol`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `estados`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `estados` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `estados` (
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
-- Table `culturas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `culturas` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `culturas` (
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
  `idZonaArqueologica` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) NOT NULL,
  `foto` BLOB NOT NULL,
  `significado` VARCHAR(200) NOT NULL,
  `descripcion` VARCHAR(1200) NOT NULL,
  `acceso` VARCHAR(500) NOT NULL,
  `horario` VARCHAR(60) NOT NULL,
  `costoEntrada` DECIMAL(4,2) NOT NULL,
  `contacto` VARCHAR(50) NOT NULL,
  `idCultura` INT UNSIGNED NOT NULL,
  `idEstadoRepublica` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idZonaArqueologica`),
  INDEX `idEstadoRepublica_idx` (`idEstadoRepublica` ASC) VISIBLE,
  INDEX `idCultura_idx` (`idCultura` ASC) VISIBLE,
  UNIQUE INDEX `nombre_UNIQUE` (`nombre` ASC) VISIBLE,
  CONSTRAINT `idEstadoRepublica`
    FOREIGN KEY (`idEstadoRepublica`)
    REFERENCES `estados` (`idEstadoRepublica`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `idCultura`
    FOREIGN KEY (`idCultura`)
    REFERENCES `culturas` (`idCultura`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `resenias`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `resenias` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `resenias` (
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
    REFERENCES `usuarios` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `idZonaArqueologica`
    FOREIGN KEY (`idZonaArqueologica`)
    REFERENCES `zonas` (`idZonaArqueologica`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `ubicaciones_zonas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ubicaciones_zonas` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `ubicaciones_zonas` (
  `idUbicacionZona` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `latitud` DECIMAL(6,3) NOT NULL,
  `longitud` DECIMAL(6,3) NOT NULL,
  `idZonaArqueologica` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idUbicacionZona`),
  UNIQUE INDEX `idZonaArqueologica_UNIQUE` (`idZonaArqueologica` ASC) VISIBLE,
  CONSTRAINT `idZonaArqueologica`
    FOREIGN KEY (`idZonaArqueologica`)
    REFERENCES `zonas` (`idZonaArqueologica`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `culturas_estados`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `culturas_estados` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `culturas_estados` (
  `idCulturaEstado` INT NOT NULL AUTO_INCREMENT,
  `idCultura` INT UNSIGNED NOT NULL,
  `idEstadoRepublica` INT UNSIGNED NOT NULL,
  INDEX `id_cultura_idx` (`idCultura` ASC) VISIBLE,
  INDEX `id_estado_republica_idx` (`idEstadoRepublica` ASC) VISIBLE,
  PRIMARY KEY (`idCulturaEstado`),
  CONSTRAINT `idCultura`
    FOREIGN KEY (`idCultura`)
    REFERENCES `culturas` (`idCultura`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `idEstadoRepublica`
    FOREIGN KEY (`idEstadoRepublica`)
    REFERENCES `estados` (`idEstadoRepublica`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `resenias_fotos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `resenias_fotos` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `resenias_fotos` (
  `idReseniaFoto` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `foto` BLOB NOT NULL,
  `idResenia` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idReseniaFoto`),
  UNIQUE INDEX `idresenia_foto_UNIQUE` (`idReseniaFoto` ASC) VISIBLE,
  INDEX `idResenia_idx` (`idResenia` ASC) VISIBLE,
  CONSTRAINT `idResenia`
    FOREIGN KEY (`idResenia`)
    REFERENCES `resenias` (`idResenia`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `zonas_fotos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zonas_fotos` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `zonas_fotos` (
  `idZonaFoto` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `foto` BLOB NOT NULL,
  `idZonaArqueologica` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idZonaFoto`),
  UNIQUE INDEX `idzonas_fotos_UNIQUE` (`idZonaFoto` ASC) VISIBLE,
  INDEX `idZonaArqueologica_idx` (`idZonaArqueologica` ASC) VISIBLE,
  CONSTRAINT `idZonaArqueologica`
    FOREIGN KEY (`idZonaArqueologica`)
    REFERENCES `zonas` (`idZonaArqueologica`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `culturas_fotos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `culturas_fotos` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `culturas_fotos` (
  `idCulturaFoto` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `foto` BLOB NOT NULL,
  `idCultura` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idCulturaFoto`),
  UNIQUE INDEX `idculturas_fotos_UNIQUE` (`idCulturaFoto` ASC) VISIBLE,
  INDEX `idCultura_idx` (`idCultura` ASC) VISIBLE,
  CONSTRAINT `idCultura`
    FOREIGN KEY (`idCultura`)
    REFERENCES `culturas` (`idCultura`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `ubicaciones_estados`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ubicaciones_estados` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `ubicaciones_estados` (
  `idUbicacionEstado` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `latitud` DECIMAL(6,3) NOT NULL,
  `longitud` DECIMAL(6,3) NOT NULL,
  `idEstadoRepublica` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idUbicacionEstado`),
  UNIQUE INDEX `idubicaciones_estados_UNIQUE` (`idUbicacionEstado` ASC) VISIBLE,
  UNIQUE INDEX `idEstadoRepublica_UNIQUE` (`idEstadoRepublica` ASC) VISIBLE,
  CONSTRAINT `idEstadoRepublica`
    FOREIGN KEY (`idEstadoRepublica`)
    REFERENCES `estados` (`idEstadoRepublica`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
