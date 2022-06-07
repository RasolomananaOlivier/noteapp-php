CREATE DATABASE `noteDb`;
USE `noteDb`;

CREATE TABLE IF NOT EXISTS `notes` (
  `note_id` SMALLINT(6) NOT NULL AUTO_INCREMENT,
  `note_name` VARCHAR(50) NOT NULL,
  `note_description` TEXT NOT NULL,

  PRIMARY KEY(`note_id`)
)