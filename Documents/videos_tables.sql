-- -----------------------------------------------------
-- Table `FormElements`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `FormElements` ;

CREATE TABLE IF NOT EXISTS `FormElements` (
  `id` INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `title` VARCHAR(250),
  `description` TEXT,
  `tagid` VARCHAR(50)
) ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `Videos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Videos` ;

CREATE TABLE IF NOT EXISTS `Videos` (
  `id` INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `title` VARCHAR(250),
  `description` TEXT,
  `filename` VARCHAR(100)
) ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `PlayVideoByCaller`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PlayVideoByCaller` ;

CREATE TABLE IF NOT EXISTS `PlayVideoByCaller` (
  `id` INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `title` VARCHAR(250),
  `id_formelement` INT UNSIGNED NOT NULL,
  `id_video` INT UNSIGNED NOT NULL,
  `start` INT UNSIGNED,
  `ends` INT UNSIGNED,
  `playevent` TINYINT UNSIGNED,
  CONSTRAINT `fk_formelement1` FOREIGN KEY (`id_formelement`) REFERENCES `FormElements` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_video1` FOREIGN KEY (`id_video`) REFERENCES `Videos` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `VideoEvents`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `VideoEvents` ;

CREATE TABLE IF NOT EXISTS `VideoEvents` (
  `id` INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `id_video` INT UNSIGNED NOT NULL,  
  `ontime` INT UNSIGNED,
  `timeout` INT UNSIGNED,
  `type` TINYINT UNSIGNED,
  `jsondata` VARCHAR(250),
  CONSTRAINT `fk_video2` FOREIGN KEY (`id_video`) REFERENCES `Videos` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE = InnoDB;