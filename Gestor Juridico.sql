-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema Gestor_Juridico
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema Gestor_Juridico
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `Gestor_Juridico` DEFAULT CHARACTER SET utf8 ;
USE `Gestor_Juridico` ;

-- -----------------------------------------------------
-- Table `Gestor_Juridico`.`Clientes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Gestor_Juridico`.`Clientes` (
  `Id_Clientes` INT(11) NOT NULL AUTO_INCREMENT,
  `Nom` VARCHAR(60) NOT NULL,
  `ApeP` VARCHAR(60) NOT NULL,
  `ApeM` VARCHAR(60) NOT NULL,
  `Ciudad` VARCHAR(45) NOT NULL,
  `Estado` VARCHAR(45) NOT NULL,
  `Calle` VARCHAR(45) NOT NULL,
  `NumCasa` INT(11) NOT NULL,
  `Colonia` VARCHAR(45) NOT NULL,
  `Email` VARCHAR(45) NOT NULL,
  `Telefono` CHAR(10) NOT NULL,
  `Edad` INT NOT NULL,
  `CURP` CHAR(18) NOT NULL,
  `Ocupacion` VARCHAR(45) NULL,
  `Sexo` CHAR(1) NOT NULL,
  `diaN` INT NOT NULL,
  `MesN` INT NOT NULL,
  `AnioN` INT NOT NULL,
  PRIMARY KEY (`Id_Clientes`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Gestor_Juridico`.`DocCliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Gestor_Juridico`.`DocCliente` (
  `Id_DocCliente` INT(11) NOT NULL AUTO_INCREMENT,
  `Doc_ComDom` VARCHAR(200) NOT NULL,
  `Doc_INE` VARCHAR(200) NOT NULL,
  `Doc_ActaN` VARCHAR(200) NOT NULL,
  `Id_Clientes` INT(11) NOT NULL,
  PRIMARY KEY (`Id_DocCliente`),
  INDEX `FK_idClientes_idx` (`Id_Clientes` ASC),
  CONSTRAINT `FK_idClientes`
    FOREIGN KEY (`Id_Clientes`)
    REFERENCES `Gestor_Juridico`.`Clientes` (`Id_Clientes`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Gestor_Juridico`.`Empleado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Gestor_Juridico`.`Empleado` (
  `Id_NoEmpleado` INT(11) NOT NULL AUTO_INCREMENT,
  `Nom` VARCHAR(60) NOT NULL,
  `ApeP` VARCHAR(60) NOT NULL,
  `ApeM` VARCHAR(60) NOT NULL,
  `Edad` INT NOT NULL,
  `Sexo` CHAR(1) NOT NULL,
  `NumCasa` INT NOT NULL,
  `Calle` VARCHAR(45) NOT NULL,
  `Colonia` VARCHAR(45) NOT NULL,
  `Telefono` CHAR(10) NOT NULL,
  `Curp` CHAR(18) NOT NULL,
  `Ciudad` VARCHAR(45) NOT NULL,
  `Estado` VARCHAR(45) NOT NULL,
  `Especialidad` VARCHAR(60) NOT NULL,
  PRIMARY KEY (`Id_NoEmpleado`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Gestor_Juridico`.`Caso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Gestor_Juridico`.`Caso` (
  `Id_NoExpediente` INT(11) NOT NULL AUTO_INCREMENT,
  `Juzgado` VARCHAR(45) NOT NULL,
  `Estatus` VARCHAR(45) NOT NULL,
  `Materia` VARCHAR(45) NOT NULL,
  `Costo` INT NOT NULL,
  `DiaR` INT NOT NULL,
  `MesR` INT NOT NULL,
  `AnioR` INT NOT NULL,
  `Id_Clientes` INT(11) NOT NULL,
  `Id_NoEmpleado` INT(11) NOT NULL,
  PRIMARY KEY (`Id_NoExpediente`),
  INDEX `FK_Clientes_idx` (`Id_Clientes` ASC),
  INDEX `FK_Empleado_idx` (`Id_NoEmpleado` ASC),
  CONSTRAINT `FK_Clientes`
    FOREIGN KEY (`Id_Clientes`)
    REFERENCES `Gestor_Juridico`.`Clientes` (`Id_Clientes`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_Empleado`
    FOREIGN KEY (`Id_NoEmpleado`)
    REFERENCES `Gestor_Juridico`.`Empleado` (`Id_NoEmpleado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Gestor_Juridico`.`DocCaso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Gestor_Juridico`.`DocCaso` (
  `Id_DocCaso` INT(11) NOT NULL AUTO_INCREMENT,
  `Id_NoExpediente` INT(11) NOT NULL,
  `URL_Doc` VARCHAR(200) NOT NULL,
  `Nombre_Doc` VARCHAR(80) NOT NULL,
  PRIMARY KEY (`Id_DocCaso`),
  INDEX `FK_Caso_idx` (`Id_NoExpediente` ASC),
  CONSTRAINT `FK_Caso`
    FOREIGN KEY (`Id_NoExpediente`)
    REFERENCES `Gestor_Juridico`.`Caso` (`Id_NoExpediente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Gestor_Juridico`.`Usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Gestor_Juridico`.`Usuarios` (
  `Id_Usuarios` INT(11) NOT NULL AUTO_INCREMENT,
  `Email` VARCHAR(60) NOT NULL,
  `Password` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`Id_Usuarios`))
ENGINE = InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


