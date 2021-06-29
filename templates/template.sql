CREATE DATABASE  IF NOT EXISTS `portfolio`;
USE `portfolio`;

DROP TABLE IF EXISTS `Education`;
CREATE TABLE `Education` (
  `eduId` int(11) NOT NULL AUTO_INCREMENT,
  `college` varchar(255) DEFAULT NULL,
  `degreeType` varchar(255) DEFAULT NULL,
  `degreeField` varchar(255) DEFAULT NULL,
  `description` varchar(5000) DEFAULT NULL,
  `activities` varchar(255) DEFAULT NULL,
  `startDate` varchar(45) DEFAULT NULL,
  `endDate` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`eduId`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `Jobs`;
CREATE TABLE `Jobs` (
  `jobId` int(11) NOT NULL AUTO_INCREMENT,
  `company` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(5000) DEFAULT NULL,
  `startDate` varchar(45) DEFAULT NULL,
  `endDate` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`jobId`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `ProjectTags`;
CREATE TABLE `ProjectTags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `projectId` int(11) NOT NULL,
  `tagId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `Projects`;
CREATE TABLE `Projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `urlDemo` varchar(255) DEFAULT NULL,
  `urlRepo` varchar(255) DEFAULT NULL,
  `thumbnailName` varchar(255) DEFAULT NULL,
  `thumbnailAlt` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `Tags`;
CREATE TABLE `Tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tag_UNIQUE` (`tag`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;