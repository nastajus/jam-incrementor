-- MySQL Script generated by MySQL Workbench
-- 11/14/14 17:44:04
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema incrementor
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema incrementor
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `incrementor` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `incrementor` ;

-- -----------------------------------------------------
-- Table `incrementor`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `incrementor`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NULL,
  `password` VARCHAR(45) NULL,
  `salt` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `date` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `incrementor`.`products`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `incrementor`.`products` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `value` DECIMAL(20,2) NULL,
  `status` ENUM('ACTIVE','RETIRED') NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `incrementor`.`generators`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `incrementor`.`generators` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `product_id` INT NULL,
  `rate` DECIMAL(10,2) NULL,
  `price` DECIMAL(20,2) NULL,
  `status` ENUM('ACTIVE','RETIRED') NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_product_id_idx` (`product_id` ASC),
  CONSTRAINT `fk_gen_product_id`
    FOREIGN KEY (`product_id`)
    REFERENCES `incrementor`.`products` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `incrementor`.`generators_inventory`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `incrementor`.`generators_inventory` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NULL,
  `generator_id` INT NULL,
  `date` TIMESTAMP NULL,
  `price` DECIMAL(20,2) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_user_id_idx` (`user_id` ASC),
  INDEX `fk_generator_id_idx` (`generator_id` ASC),
  CONSTRAINT `fk_gi_user_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `incrementor`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_generator_id`
    FOREIGN KEY (`generator_id`)
    REFERENCES `incrementor`.`generators` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `incrementor`.`products_inventory`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `incrementor`.`products_inventory` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `product_id` INT NULL,
  `generator_inventory_id` INT NULL COMMENT 'the source where the product came from',
  `rate` DECIMAL(20,2) NULL,
  `price` DECIMAL(20,2) NULL,
  `status` ENUM('ACTIVE','RETIRED') NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_product_id_idx` (`product_id` ASC),
  INDEX `fk_generator_inventory_id_idx` (`generator_inventory_id` ASC),
  CONSTRAINT `fk_pi_product_id`
    FOREIGN KEY (`product_id`)
    REFERENCES `incrementor`.`products` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_generator_inventory_id`
    FOREIGN KEY (`generator_inventory_id`)
    REFERENCES `incrementor`.`generators_inventory` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `incrementor`.`transactions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `incrementor`.`transactions` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `value` DECIMAL(20,2) NULL,
  `type` ENUM('DEBIT','CREDIT') NULL COMMENT 'type is for redundancy check of security, that is show only essentially',
  PRIMARY KEY (`id`),
  INDEX `fk_user_id_idx` (`user_id` ASC),
  CONSTRAINT `fk_trans_user_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `incrementor`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `incrementor`.`balance`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `incrementor`.`balance` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NULL,
  `balance` DECIMAL(20,2) NULL COMMENT 'balance is purely for show, not calculating',
  PRIMARY KEY (`id`),
  INDEX `fk_user_id_idx` (`user_id` ASC),
  CONSTRAINT `fk_bal_user_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `incrementor`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
