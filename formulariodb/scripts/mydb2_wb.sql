SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

ALTER TABLE `mydb`.`users` ADD COLUMN `roles_idrol` INT(11) NOT NULL  AFTER `cities_idcity` , 
  ADD CONSTRAINT `fk_users_roles1`
  FOREIGN KEY (`roles_idrol` )
  REFERENCES `mydb`.`roles` (`idrol` )
  ON DELETE NO ACTION
  ON UPDATE NO ACTION
, ADD INDEX `fk_users_roles1_idx` (`roles_idrol` ASC) ;

CREATE  TABLE IF NOT EXISTS `mydb`.`roles` (
  `idrol` INT(11) NOT NULL AUTO_INCREMENT ,
  `rol` VARCHAR(45) NULL DEFAULT NULL ,
  PRIMARY KEY (`idrol`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

CREATE  TABLE IF NOT EXISTS `mydb`.`resources` (
  `idresource` INT(11) NOT NULL AUTO_INCREMENT ,
  `resource` VARCHAR(255) NULL DEFAULT NULL ,
  PRIMARY KEY (`idresource`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

CREATE  TABLE IF NOT EXISTS `mydb`.`roles_has_resources` (
  `roles_idrol` INT(11) NOT NULL ,
  `resources_idresource` INT(11) NOT NULL ,
  PRIMARY KEY (`roles_idrol`, `resources_idresource`) ,
  INDEX `fk_roles_has_resources_resources1_idx` (`resources_idresource` ASC) ,
  INDEX `fk_roles_has_resources_roles1_idx` (`roles_idrol` ASC) ,
  CONSTRAINT `fk_roles_has_resources_roles1`
    FOREIGN KEY (`roles_idrol` )
    REFERENCES `mydb`.`roles` (`idrol` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_roles_has_resources_resources1`
    FOREIGN KEY (`resources_idresource` )
    REFERENCES `mydb`.`resources` (`idresource` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
