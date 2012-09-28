-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.5.8-log - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4197
-- Date/time:                    2012-09-28 13:59:26
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table helpme.attachments
DROP TABLE IF EXISTS `attachments`;
CREATE TABLE IF NOT EXISTS `attachments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `date_add` datetime NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_type` varchar(255) NOT NULL,
  `raw_name` varchar(255) NOT NULL,
  `file_ext` varchar(255) NOT NULL,
  `file_size` float unsigned NOT NULL,
  `is_image` tinyint(1) unsigned NOT NULL,
  `image_width` varchar(255) NOT NULL,
  `image_height` int(5) unsigned NOT NULL,
  `image_type` int(5) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Dumping data for table helpme.attachments: 0 rows
DELETE FROM `attachments`;
/*!40000 ALTER TABLE `attachments` DISABLE KEYS */;
/*!40000 ALTER TABLE `attachments` ENABLE KEYS */;


-- Dumping structure for table helpme.ci_sessions
DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(255) DEFAULT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` longtext NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Dumping data for table helpme.ci_sessions: 0 rows
DELETE FROM `ci_sessions`;
/*!40000 ALTER TABLE `ci_sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `ci_sessions` ENABLE KEYS */;


-- Dumping structure for table helpme.config
DROP TABLE IF EXISTS `config`;
CREATE TABLE IF NOT EXISTS `config` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `field` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `field` (`field`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Dumping data for table helpme.config: 3 rows
DELETE FROM `config`;
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
INSERT INTO `config` (`id`, `field`, `name`, `value`) VALUES
	(1, 'sitename', 'Nom de la plateforme', 'Help Me !'),
	(2, 'noreply', 'E-mail de réponse', 'no-reply@mydomain.com'),
	(3, 'system_email', 'E-mail système', 'contact@mydomain.com');
/*!40000 ALTER TABLE `config` ENABLE KEYS */;


-- Dumping structure for table helpme.contact
DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `date_sent` datetime NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `ip` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Dumping data for table helpme.contact: 0 rows
DELETE FROM `contact`;
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact` ENABLE KEYS */;


-- Dumping structure for table helpme.faq
DROP TABLE IF EXISTS `faq`;
CREATE TABLE IF NOT EXISTS `faq` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order` int(10) unsigned NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Dumping data for table helpme.faq: 0 rows
DELETE FROM `faq`;
/*!40000 ALTER TABLE `faq` DISABLE KEYS */;
/*!40000 ALTER TABLE `faq` ENABLE KEYS */;


-- Dumping structure for table helpme.responses
DROP TABLE IF EXISTS `responses`;
CREATE TABLE IF NOT EXISTS `responses` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `date_add` datetime NOT NULL,
  `text` text NOT NULL,
  `ip` varchar(50) NOT NULL,
  `ticket_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `attachment_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `text` (`text`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Dumping data for table helpme.responses: 0 rows
DELETE FROM `responses`;
/*!40000 ALTER TABLE `responses` DISABLE KEYS */;
/*!40000 ALTER TABLE `responses` ENABLE KEYS */;


-- Dumping structure for table helpme.roles
DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Dumping data for table helpme.roles: 3 rows
DELETE FROM `roles`;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`) VALUES
	(1, 'Super Admin'),
	(2, 'Admin'),
	(3, 'Utilisateur');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;


-- Dumping structure for table helpme.tickets
DROP TABLE IF EXISTS `tickets`;
CREATE TABLE IF NOT EXISTS `tickets` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `date_add` datetime NOT NULL,
  `date_maj` datetime NOT NULL,
  `state` enum('open','close') NOT NULL DEFAULT 'open',
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `ip` char(50) NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `attachment_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `title` (`title`,`text`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Dumping data for table helpme.tickets: 0 rows
DELETE FROM `tickets`;
/*!40000 ALTER TABLE `tickets` DISABLE KEYS */;
/*!40000 ALTER TABLE `tickets` ENABLE KEYS */;


-- Dumping structure for table helpme.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `date_add` datetime NOT NULL,
  `last_visit` datetime NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `sitename` varchar(255) NOT NULL,
  `role` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Dumping data for table helpme.users: 1 rows
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `date_add`, `last_visit`, `status`, `username`, `email`, `password`, `ip`, `lastname`, `firstname`, `sitename`, `role`) VALUES
	(1, '2012-09-28 13:54:25', '2012-09-28 13:54:45', 'active', 'sadmin', 'contact@mydomain.com', '1a37e5eb4ea24b24b0d287e0df00f91715ca2e04', '127.0.0.1', 'HELPME', 'Support', 'Help Me !', 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
