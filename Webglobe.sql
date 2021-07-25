-- Adminer 4.8.1 MySQL 5.5.5-10.5.10-MariaDB-0ubuntu0.21.04.1 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

CREATE DATABASE `Webglobe` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `Webglobe`;

DROP TABLE IF EXISTS `persons`;
CREATE TABLE `persons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(90) NOT NULL,
  `surname` varchar(90) NOT NULL,
  `email` varchar(90) NOT NULL,
  `telephone` varchar(90) NOT NULL,
  `works_positons_id` int(11) NOT NULL,
  `salary` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `works_positons_id` (`works_positons_id`),
  CONSTRAINT `persons_ibfk_2` FOREIGN KEY (`works_positons_id`) REFERENCES `works_positions` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `persons` (`id`, `name`, `surname`, `email`, `telephone`, `works_positons_id`, `salary`) VALUES
(98,	'Meno',	'Priezvisko',	'e@e.sk',	'987',	173,	987);

DROP TABLE IF EXISTS `person_tituls`;
CREATE TABLE `person_tituls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titul_name` varchar(90) NOT NULL,
  `code` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `person_tituls` (`id`, `titul_name`, `code`) VALUES
(1,	'magister, Mgr. art – magister umenia,',	'Mgr'),
(2,	'inžinier',	'Ing'),
(3,	' inžinier architekt',	'Ing. arch'),
(4,	'doktor prírodných vied',	'RNDr'),
(5,	'doktor farmácie',	'PharmDr'),
(6,	'doktor filozofie',	'PhDr'),
(7,	'doktor práv',	'JUDr'),
(8,	'doktor pedagogiky',	'PeaDr'),
(9,	'doktor teológie',	'ThDr'),
(10,	'doktor všeobecného lekárstva',	'MUDr'),
(11,	'doktor zubného lekárstva',	'MDDr'),
(12,	'doktor veterinárneho lekárstva',	'MVDr'),
(13,	'doktor všeobecne',	'PhD'),
(14,	'docent',	'doc'),
(15,	'profesor',	'prof'),
(16,	'kandidát vied',	'CSc');

DROP TABLE IF EXISTS `pivot_titul_person`;
CREATE TABLE `pivot_titul_person` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `persons_id` int(11) NOT NULL,
  `person_tituls_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `persons_id` (`persons_id`),
  KEY `person_tituls_id` (`person_tituls_id`),
  CONSTRAINT `pivot_titul_person_ibfk_1` FOREIGN KEY (`persons_id`) REFERENCES `persons` (`id`),
  CONSTRAINT `pivot_titul_person_ibfk_2` FOREIGN KEY (`person_tituls_id`) REFERENCES `person_tituls` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `pivot_titul_person` (`id`, `persons_id`, `person_tituls_id`) VALUES
(285,	98,	1);

DROP TABLE IF EXISTS `works_positions`;
CREATE TABLE `works_positions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `work_name` varchar(90) NOT NULL,
  `standard_salary` int(11) NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `works_positions` (`id`, `work_name`, `standard_salary`) VALUES
(171,	'Administrácia',	1000),
(172,	'Pomocný pracovník',	900),
(173,	'Riaditeľ',	2500);

-- 2021-07-25 17:24:32
