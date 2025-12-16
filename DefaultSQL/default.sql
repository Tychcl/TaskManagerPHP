
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- Statuses
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Statuses`;

CREATE TABLE `Statuses`
(
    `Id` tinyint unsigned NOT NULL AUTO_INCREMENT,
    `Name` VARCHAR(10) NOT NULL,
    PRIMARY KEY (`Id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- Tasks
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Tasks`;

CREATE TABLE `Tasks`
(
    `Id` INTEGER NOT NULL AUTO_INCREMENT,
    `Title` TEXT NOT NULL,
    `Description` TEXT NOT NULL,
    `Status` tinyint unsigned,
    PRIMARY KEY (`Id`),
    INDEX `Status` (`Status`),
    CONSTRAINT `tasks_ibfk_1`
        FOREIGN KEY (`Status`)
        REFERENCES `Statuses` (`Id`)
        ON UPDATE CASCADE
        ON DELETE SET NULL
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
