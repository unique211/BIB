-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2019 at 12:31 PM
-- Server version: 5.7.9
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u886168621_bib`
--

-- --------------------------------------------------------

--
-- Table structure for table `aauth_login_attempts`
--

DROP TABLE IF EXISTS `aauth_login_attempts`;
CREATE TABLE IF NOT EXISTS `aauth_login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(39) DEFAULT '0',
  `timestamp` datetime DEFAULT NULL,
  `login_attempts` tinyint(2) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aauth_login_attempts`
--

INSERT INTO `aauth_login_attempts` (`id`, `ip_address`, `timestamp`, `login_attempts`) VALUES
(2, '::1', '2019-05-02 00:27:18', 2),
(3, '::1', '2019-05-02 05:49:58', 3),
(6, '::1', '2019-05-14 04:49:09', 1);

-- --------------------------------------------------------

--
-- Table structure for table `aauth_pms`
--

DROP TABLE IF EXISTS `aauth_pms`;
CREATE TABLE IF NOT EXISTS `aauth_pms` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) UNSIGNED NOT NULL,
  `receiver_id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text,
  `date_sent` datetime DEFAULT NULL,
  `date_read` datetime DEFAULT NULL,
  `pm_deleted_sender` int(1) NOT NULL,
  `pm_deleted_receiver` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `full_index` (`id`,`sender_id`,`receiver_id`,`date_read`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `aauth_users`
--

DROP TABLE IF EXISTS `aauth_users`;
CREATE TABLE IF NOT EXISTS `aauth_users` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `pass` varchar(64) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `banned` tinyint(1) DEFAULT '0',
  `last_login` datetime DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `forgot_exp` text,
  `remember_time` datetime DEFAULT NULL,
  `remember_exp` text,
  `verification_code` text,
  `totp_secret` varchar(16) DEFAULT NULL,
  `ip_address` text,
  `roleid` int(1) NOT NULL,
  `picture` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `email` (`email`),
  KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aauth_users`
--

INSERT INTO `aauth_users` (`id`, `email`, `pass`, `username`, `banned`, `last_login`, `last_activity`, `date_created`, `forgot_exp`, `remember_time`, `remember_exp`, `verification_code`, `totp_secret`, `ip_address`, `roleid`, `picture`) VALUES
(10, 'martyn.benjamin@gmail.com', 'ca16350c55ced81d071bd550cbc5e92ad319ab41b84ed342a96cf79e4d03f02a', 'admin', 0, '2019-05-22 05:37:29', '2019-05-22 05:37:29', '2019-04-24 06:44:55', NULL, '2019-05-14 00:00:00', 'TRSLvF5fiMck8PwI', NULL, NULL, '::1', 5, 'example.png'),
(11, 'demo@gmail.com', 'ca16350c55ced81d071bd550cbc5e92ad319ab41b84ed342a96cf79e4d03f02a', 'Team Leader', 0, '2019-05-01 23:56:14', '2019-05-01 23:56:14', '2019-04-24 06:44:55', NULL, '2019-05-03 00:00:00', 'cEOM2F1UsihDezJ9', NULL, NULL, '::1', 3, 'example.png'),
(12, 'abc@gmail.com', 'ca16350c55ced81d071bd550cbc5e92ad319ab41b84ed342a96cf79e4d03f02a', 'abc', 0, '2019-05-14 01:24:50', '2019-05-14 01:24:50', '2019-04-24 06:44:55', NULL, '2019-05-14 00:00:00', 'TRSLvF5fiMck8PwI', NULL, NULL, '::1', 5, 'example.png'),
(13, 'test@test.com', 'cd0b3bc90d519a0bfd72a020ea307cad68dba92c91ace606785f93c704b0a6c1', 'Team Leader', 0, '2019-05-22 05:40:11', '2019-05-22 05:40:11', '2019-05-16 01:56:31', NULL, NULL, NULL, NULL, NULL, '::1', 3, 'example.png');

-- --------------------------------------------------------

--
-- Table structure for table `aauth_user_variables`
--

DROP TABLE IF EXISTS `aauth_user_variables`;
CREATE TABLE IF NOT EXISTS `aauth_user_variables` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) UNSIGNED NOT NULL,
  `data_key` varchar(100) NOT NULL,
  `value` text,
  PRIMARY KEY (`id`),
  KEY `user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `acn` varchar(35) NOT NULL,
  `holder` varchar(100) NOT NULL,
  `adate` datetime NOT NULL,
  `lastbal` decimal(16,2) DEFAULT '0.00',
  `code` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `acn` (`acn`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `acn`, `holder`, `adate`, `lastbal`, `code`) VALUES
(1, '12345678', 'Company Sales Account', '2018-01-01 00:00:00', '0.00', 'Company Sales Account');

-- --------------------------------------------------------

--
-- Table structure for table `api_keys`
--

DROP TABLE IF EXISTS `api_keys`;
CREATE TABLE IF NOT EXISTS `api_keys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `key` varchar(40) DEFAULT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',
  `is_private_key` tinyint(1) NOT NULL DEFAULT '0',
  `ip_addresses` text,
  `date_created` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `api_keys`
--

INSERT INTO `api_keys` (`id`, `user_id`, `key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(1, 0, 'c4ef70e75cce8a958ab297c9', 0, 0, 0, NULL, '2019-05-06');

-- --------------------------------------------------------

--
-- Table structure for table `app_system`
--

DROP TABLE IF EXISTS `app_system`;
CREATE TABLE IF NOT EXISTS `app_system` (
  `id` int(1) NOT NULL,
  `cname` char(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(30) NOT NULL,
  `region` varchar(40) NOT NULL,
  `country` varchar(30) NOT NULL,
  `postbox` varchar(15) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `taxid` varchar(20) NOT NULL,
  `tax` int(11) NOT NULL,
  `currency` varchar(4) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `currency_format` int(1) NOT NULL,
  `prefix` varchar(5) NOT NULL,
  `dformat` int(1) NOT NULL,
  `zone` varchar(25) NOT NULL,
  `logo` varchar(30) NOT NULL,
  `lang` varchar(20) DEFAULT 'english',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `app_system`
--

INSERT INTO `app_system` (`id`, `cname`, `address`, `city`, `region`, `country`, `postbox`, `phone`, `email`, `taxid`, `tax`, `currency`, `currency_format`, `prefix`, `dformat`, `zone`, `logo`, `lang`) VALUES
(1, 'Bamboo is Better', '412 Example South Street,', 'Los Angeles', 'FL', 'USA', '123', '410-987-89-60', 'test@example.com', '23442', 1, '$', 0, 'SRN', 2, 'US/Eastern', '1556091612354279320.png', 'english');

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts`
--

DROP TABLE IF EXISTS `bank_accounts`;
CREATE TABLE IF NOT EXISTS `bank_accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `bank` varchar(50) NOT NULL,
  `acn` varchar(50) NOT NULL,
  `code` varchar(50) DEFAULT NULL,
  `note` varchar(2000) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `branch` varchar(100) DEFAULT NULL,
  `enable` enum('Yes','No') NOT NULL DEFAULT 'No',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `billing_terms`
--

DROP TABLE IF EXISTS `billing_terms`;
CREATE TABLE IF NOT EXISTS `billing_terms` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `type` int(1) NOT NULL,
  `terms` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `billing_terms`
--

INSERT INTO `billing_terms` (`id`, `title`, `type`, `terms`) VALUES
(1, 'Payment on receipt', 0, 'Payment due on receipt');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('3nnava32r2et51307dj35i6m5i4kaslt', '::1', 1558516677, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535383531363633333b69647c733a323a223133223b757365726e616d657c733a31313a225465616d204c6561646572223b656d61696c7c733a31333a227465737440746573742e636f6d223b6c6f67676564696e7c623a313b),
('3osf3mliprfkml62keon4nh06toj61r5', '::1', 1558524065, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535383532333836303b69647c733a323a223133223b757365726e616d657c733a31313a225465616d204c6561646572223b656d61696c7c733a31333a227465737440746573742e636f6d223b6c6f67676564696e7c623a313b6661766f75726974655f776562736974657c733a313a2233223b),
('5q7svme0btde2mdutihu1cf13l5r2r2k', '::1', 1558516566, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535383531363332323b69647c733a323a223133223b757365726e616d657c733a31313a225465616d204c6561646572223b656d61696c7c733a31333a227465737440746573742e636f6d223b6c6f67676564696e7c623a313b),
('5rs14hfdbj9f6ind6etilprl6gb5bljl', '::1', 1558518020, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535383531383030343b69647c733a323a223133223b757365726e616d657c733a31313a225465616d204c6561646572223b656d61696c7c733a31333a227465737440746573742e636f6d223b6c6f67676564696e7c623a313b),
('9oclm3akt3tdsiqoakm3n62854shimeh', '::1', 1558516059, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535383531363031393b69647c733a323a223133223b757365726e616d657c733a31313a225465616d204c6561646572223b656d61696c7c733a31333a227465737440746573742e636f6d223b6c6f67676564696e7c623a313b),
('aj9jf8fp45ntb3mon4qo5431g0mft402', '::1', 1558525480, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535383532353239313b69647c733a323a223133223b757365726e616d657c733a31313a225465616d204c6561646572223b656d61696c7c733a31333a227465737440746573742e636f6d223b6c6f67676564696e7c623a313b6661766f75726974655f776562736974657c733a313a2233223b),
('blmsfia21okcajur7o5e6d5kglesulcr', '::1', 1558524864, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535383532343537323b69647c733a323a223133223b757365726e616d657c733a31313a225465616d204c6561646572223b656d61696c7c733a31333a227465737440746573742e636f6d223b6c6f67676564696e7c623a313b6661766f75726974655f776562736974657c733a313a2233223b),
('eit214acbc9rvsbi2mmbuu5hghulnv0v', '::1', 1558523313, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535383532333331303b69647c733a323a223133223b757365726e616d657c733a31313a225465616d204c6561646572223b656d61696c7c733a31333a227465737440746573742e636f6d223b6c6f67676564696e7c623a313b6661766f75726974655f776562736974657c733a313a2233223b),
('etog6ge6n94rot3ne0ktffvuukrj0rta', '::1', 1558514613, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535383531343334313b69647c733a323a223130223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a32353a226d617274796e2e62656e6a616d696e40676d61696c2e636f6d223b6c6f67676564696e7c623a313b6661766f75726974655f776562736974657c733a313a2235223b),
('gcbh4ts32q074vrc53vs5ccuriuu18sc', '::1', 1558514077, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535383531333837343b69647c733a323a223130223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a32353a226d617274796e2e62656e6a616d696e40676d61696c2e636f6d223b6c6f67676564696e7c623a313b6661766f75726974655f776562736974657c733a313a2235223b),
('jbq1utp6vdlivp9m4b9uqmqm39ig83ab', '::1', 1558520910, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535383532303735383b69647c733a323a223133223b757365726e616d657c733a31313a225465616d204c6561646572223b656d61696c7c733a31333a227465737440746573742e636f6d223b6c6f67676564696e7c623a313b),
('k9eio6rlutu5n85iqr1gaopnh9q38b48', '::1', 1558521853, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535383532313833353b69647c733a323a223133223b757365726e616d657c733a31313a225465616d204c6561646572223b656d61696c7c733a31333a227465737440746573742e636f6d223b6c6f67676564696e7c623a313b6661766f75726974655f776562736974657c733a313a2233223b),
('kemvd1umn01p5bak7oluq9ms7fs41b4j', '::1', 1558515696, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535383531353636373b69647c733a323a223130223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a32353a226d617274796e2e62656e6a616d696e40676d61696c2e636f6d223b6c6f67676564696e7c623a313b6661766f75726974655f776562736974657c733a313a2235223b),
('kpk6n4ilrmlq0cigvkegol0kj88k2s2f', '::1', 1558514947, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535383531343634373b69647c733a323a223130223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a32353a226d617274796e2e62656e6a616d696e40676d61696c2e636f6d223b6c6f67676564696e7c623a313b6661766f75726974655f776562736974657c733a313a2235223b),
('kt0ugvol264r00665me4qc4h07dlblqk', '::1', 1558525126, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535383532343932353b69647c733a323a223133223b757365726e616d657c733a31313a225465616d204c6561646572223b656d61696c7c733a31333a227465737440746573742e636f6d223b6c6f67676564696e7c623a313b6661766f75726974655f776562736974657c733a313a2233223b),
('m810f1dhgkme4mmecvb9o5o3l5cctkis', '::1', 1558525818, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535383532353736363b69647c733a323a223133223b757365726e616d657c733a31313a225465616d204c6561646572223b656d61696c7c733a31333a227465737440746573742e636f6d223b6c6f67676564696e7c623a313b6661766f75726974655f776562736974657c733a313a2233223b),
('o8qvfmb70kngp9a7ilg8u7fgvofemir6', '::1', 1558524408, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535383532343138303b69647c733a323a223133223b757365726e616d657c733a31313a225465616d204c6561646572223b656d61696c7c733a31333a227465737440746573742e636f6d223b6c6f67676564696e7c623a313b6661766f75726974655f776562736974657c733a313a2233223b),
('soocvdenjvh41sgs73pocpabhdg3c2k6', '::1', 1558523120, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535383532323932333b69647c733a323a223133223b757365726e616d657c733a31313a225465616d204c6561646572223b656d61696c7c733a31333a227465737440746573742e636f6d223b6c6f67676564696e7c623a313b6661766f75726974655f776562736974657c733a313a2233223b),
('u96kklpk0otm812rl1c2hhden0ms6b45', '::1', 1558518849, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535383531383834383b69647c733a323a223133223b757365726e616d657c733a31313a225465616d204c6561646572223b656d61696c7c733a31333a227465737440746573742e636f6d223b6c6f67676564696e7c623a313b),
('uk6jmke0h2seahv2oqugsp2km5a2j0j7', '::1', 1558515283, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535383531343938333b69647c733a323a223130223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a32353a226d617274796e2e62656e6a616d696e40676d61696c2e636f6d223b6c6f67676564696e7c623a313b6661766f75726974655f776562736974657c733a313a2235223b),
('up6l34nakjhrhabnvadg30obpupe52mm', '::1', 1558515412, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535383531353334393b69647c733a323a223130223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a32353a226d617274796e2e62656e6a616d696e40676d61696c2e636f6d223b6c6f67676564696e7c623a313b6661766f75726974655f776562736974657c733a313a2235223b),
('uqvk8l7g47isu92uncfs4b75r7o6oqtt', '::1', 1558521270, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535383532313037333b69647c733a323a223133223b757365726e616d657c733a31313a225465616d204c6561646572223b656d61696c7c733a31333a227465737440746573742e636f6d223b6c6f67676564696e7c623a313b6661766f75726974655f776562736974657c733a313a2233223b),
('v9vs3javhmc4m26k3ph3ksq3eiclav8a', '::1', 1558527217, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535383532373035353b69647c733a323a223133223b757365726e616d657c733a31313a225465616d204c6561646572223b656d61696c7c733a31333a227465737440746573742e636f6d223b6c6f67676564696e7c623a313b6661766f75726974655f776562736974657c733a313a2233223b),
('voqu38v5p34oa36qbmkurp3vp8g913gu', '::1', 1558521711, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535383532313434313b69647c733a323a223133223b757365726e616d657c733a31313a225465616d204c6561646572223b656d61696c7c733a31333a227465737440746573742e636f6d223b6c6f67676564696e7c623a313b6661766f75726974655f776562736974657c733a313a2233223b),
('vtp7k8u4bqrn454rd62873gufd94e76i', '::1', 1558526795, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535383532363536383b69647c733a323a223133223b757365726e616d657c733a31313a225465616d204c6561646572223b656d61696c7c733a31333a227465737440746573742e636f6d223b6c6f67676564696e7c623a313b6661766f75726974655f776562736974657c733a313a2233223b);

-- --------------------------------------------------------

--
-- Table structure for table `conf`
--

DROP TABLE IF EXISTS `conf`;
CREATE TABLE IF NOT EXISTS `conf` (
  `id` int(1) NOT NULL DEFAULT '1',
  `bank` int(1) NOT NULL,
  `acid` int(11) NOT NULL,
  `ext1` varchar(255) DEFAULT NULL,
  `ext2` varchar(255) DEFAULT NULL,
  `recaptcha_p` varchar(255) DEFAULT NULL,
  `captcha` int(1) NOT NULL,
  `recaptcha_s` varchar(255) DEFAULT NULL,
  UNIQUE KEY `id_2` (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `conf`
--

INSERT INTO `conf` (`id`, `bank`, `acid`, `ext1`, `ext2`, `recaptcha_p`, `captcha`, `recaptcha_s`) VALUES
(1, 1, 1, 'ltr', '0', '0', 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `corn_job`
--

DROP TABLE IF EXISTS `corn_job`;
CREATE TABLE IF NOT EXISTS `corn_job` (
  `id` int(1) NOT NULL,
  `cornkey` varchar(50) NOT NULL,
  `rec_email` int(11) DEFAULT NULL,
  `email` int(11) DEFAULT NULL,
  `rec_due` int(11) DEFAULT NULL,
  `recemail` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `corn_job`
--

INSERT INTO `corn_job` (`id`, `cornkey`, `rec_email`, `email`, `rec_due`, `recemail`) VALUES
(1, '345648', 0, 0, 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

DROP TABLE IF EXISTS `currencies`;
CREATE TABLE IF NOT EXISTS `currencies` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `code` varchar(3) CHARACTER SET latin1 DEFAULT NULL,
  `symbol` varchar(3) DEFAULT NULL,
  `rate` decimal(10,3) NOT NULL,
  `thous` char(1) CHARACTER SET latin1 DEFAULT NULL,
  `dpoint` char(1) CHARACTER SET latin1 NOT NULL,
  `decim` int(2) NOT NULL,
  `cpos` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `code`, `symbol`, `rate`, `thous`, `dpoint`, `decim`, `cpos`) VALUES
(1, 'USD', 'X', '1.000', ',', '.', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `region` varchar(30) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `postbox` varchar(20) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `picture` varchar(100) NOT NULL DEFAULT 'example.png',
  `gid` int(5) NOT NULL DEFAULT '1',
  `company` varchar(100) DEFAULT NULL,
  `taxid` varchar(100) DEFAULT NULL,
  `name_s` varchar(100) DEFAULT NULL,
  `phone_s` varchar(100) DEFAULT NULL,
  `email_s` varchar(100) DEFAULT NULL,
  `address_s` varchar(100) DEFAULT NULL,
  `city_s` varchar(100) DEFAULT NULL,
  `region_s` varchar(100) DEFAULT NULL,
  `country_s` varchar(100) DEFAULT NULL,
  `postbox_s` varchar(100) DEFAULT NULL,
  `balance` float(16,2) DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `gid` (`gid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `customers_group`
--

DROP TABLE IF EXISTS `customers_group`;
CREATE TABLE IF NOT EXISTS `customers_group` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(60) DEFAULT NULL,
  `summary` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers_group`
--

INSERT INTO `customers_group` (`id`, `title`, `summary`) VALUES
(1, 'TradeShow', 'Customers acquired at trade shows'),
(2, 'StoreWalk-in', 'Customers who walk into stores or visit Kiosks'),
(3, 'Corporate', 'Corporate or Business clients');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
CREATE TABLE IF NOT EXISTS `documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `filename` varchar(50) DEFAULT NULL,
  `cdate` date NOT NULL,
  `permission` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employee_profile`
--

DROP TABLE IF EXISTS `employee_profile`;
CREATE TABLE IF NOT EXISTS `employee_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `region` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `postbox` varchar(20) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `phonealt` varchar(15) DEFAULT NULL,
  `picture` varchar(50) NOT NULL DEFAULT 'example.png',
  `sign` varchar(100) DEFAULT 'sign.png',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee_profile`
--

INSERT INTO `employee_profile` (`id`, `username`, `name`, `address`, `city`, `region`, `country`, `postbox`, `phone`, `phonealt`, `picture`, `sign`) VALUES
(10, 'admin', 'BusinessOwner', 'Test Street', 'Test City', 'Test Region', 'Test Country', '123456', '12345678', '0', 'example.png', 'sign.png'),
(11, 'abc', 'abc', 'asd', 'surat', 'Hindu', 'India', '123456', '12345678', '12345678', 'example.png', 'sign.png'),
(13, 'test', 'jhon doe', '119 Plantin en Moretuslei', 'Antwerpen', 'Active', NULL, NULL, '322726401', NULL, 'example.png', 'sign.png');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `color` varchar(7) NOT NULL DEFAULT '#3a87ad',
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  `allDay` varchar(50) NOT NULL DEFAULT 'true',
  `rel` int(2) NOT NULL DEFAULT '0',
  `rid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `rel` (`rel`),
  KEY `rid` (`rid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `goals`
--

DROP TABLE IF EXISTS `goals`;
CREATE TABLE IF NOT EXISTS `goals` (
  `id` int(1) NOT NULL,
  `income` bigint(20) NOT NULL,
  `expense` bigint(20) NOT NULL,
  `sales` bigint(20) NOT NULL,
  `netincome` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `goals`
--

INSERT INTO `goals` (`id`, `income`, `expense`, `sales`, `netincome`) VALUES
(1, 9999, 3333, 99999, 100000);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
CREATE TABLE IF NOT EXISTS `invoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL,
  `invoicedate` date NOT NULL,
  `invoiceduedate` date NOT NULL,
  `subtotal` decimal(16,2) DEFAULT '0.00',
  `shipping` decimal(16,2) DEFAULT '0.00',
  `discount` decimal(16,2) DEFAULT '0.00',
  `tax` decimal(16,2) DEFAULT '0.00',
  `total` decimal(16,2) DEFAULT '0.00',
  `pmethod` varchar(14) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `status` enum('paid','due','canceled','partial') NOT NULL DEFAULT 'due',
  `csd` int(5) NOT NULL DEFAULT '0',
  `eid` int(4) NOT NULL,
  `pamnt` decimal(16,2) DEFAULT '0.00',
  `items` int(11) NOT NULL,
  `taxstatus` enum('yes','no') NOT NULL DEFAULT 'yes',
  `discstatus` tinyint(1) NOT NULL,
  `format_discount` enum('%','flat','b_p','bflat') NOT NULL DEFAULT '%',
  `refer` varchar(20) DEFAULT NULL,
  `term` int(3) NOT NULL,
  `multi` int(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `invoice` (`tid`),
  KEY `eid` (`eid`),
  KEY `csd` (`csd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_items`
--

DROP TABLE IF EXISTS `invoice_items`;
CREATE TABLE IF NOT EXISTS `invoice_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL,
  `pid` int(11) NOT NULL DEFAULT '0',
  `product` varchar(255) DEFAULT NULL,
  `qty` int(11) NOT NULL DEFAULT '0',
  `price` decimal(16,2) NOT NULL DEFAULT '0.00',
  `tax` decimal(16,2) DEFAULT '0.00',
  `discount` decimal(16,2) DEFAULT '0.00',
  `subtotal` decimal(16,2) DEFAULT '0.00',
  `totaltax` decimal(16,2) DEFAULT '0.00',
  `totaldiscount` decimal(16,2) DEFAULT '0.00',
  `product_des` text,
  PRIMARY KEY (`id`),
  KEY `invoice` (`tid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `meta_data`
--

DROP TABLE IF EXISTS `meta_data`;
CREATE TABLE IF NOT EXISTS `meta_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(3) NOT NULL,
  `rid` int(11) NOT NULL,
  `col1` varchar(255) NOT NULL,
  `col2` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`),
  KEY `rid` (`rid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `milestones`
--

DROP TABLE IF EXISTS `milestones`;
CREATE TABLE IF NOT EXISTS `milestones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `sdate` date NOT NULL,
  `edate` date NOT NULL,
  `exp` text NOT NULL,
  `color` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `milestones`
--

INSERT INTO `milestones` (`id`, `pid`, `name`, `sdate`, `edate`, `exp`, `color`) VALUES
(1, 1, 'A1', '2019-04-24', '2019-04-24', '', '#0b97f4'),
(3, 2, 'sfs', '2019-05-10', '2019-05-10', '<p>dfsdf</p>', '#0b97f4'),
(4, 2, 'milestone 1', '2019-05-11', '2019-05-11', '<p>adfsedfedsfdsewf</p>', '#0b97f4'),
(5, 2, 'Desktop Pc', '2019-05-11', '2019-05-11', '<p>adadadfad</p>', '#0b97f4'),
(6, 2, 'Mile stone 2', '2019-05-20', '2019-05-20', '<p>Milestone 2</p>', '#0b97f4');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

DROP TABLE IF EXISTS `notes`;
CREATE TABLE IF NOT EXISTS `notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text,
  `cdate` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `online_payment`
--

DROP TABLE IF EXISTS `online_payment`;
CREATE TABLE IF NOT EXISTS `online_payment` (
  `id` int(11) NOT NULL,
  `default_acid` int(11) NOT NULL DEFAULT '1',
  `currency_code` varchar(3) NOT NULL,
  `enable` int(1) NOT NULL,
  `bank` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `online_payment`
--

INSERT INTO `online_payment` (`id`, `default_acid`, `currency_code`, `enable`, `bank`) VALUES
(1, 1, 'USD', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment_gateways`
--

DROP TABLE IF EXISTS `payment_gateways`;
CREATE TABLE IF NOT EXISTS `payment_gateways` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `enable` enum('Yes','No') NOT NULL,
  `key1` varchar(255) NOT NULL,
  `key2` varchar(255) DEFAULT NULL,
  `currency` varchar(3) NOT NULL DEFAULT 'USD',
  `dev_mode` enum('true','false') NOT NULL,
  `ord` int(5) NOT NULL,
  `surcharge` decimal(16,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_gateways`
--

INSERT INTO `payment_gateways` (`id`, `name`, `enable`, `key1`, `key2`, `currency`, `dev_mode`, `ord`, `surcharge`) VALUES
(1, 'Stripe', 'Yes', 'sk_test_secratekey', 'sk_test_publickey', 'USD', 'true', 1, '0.00'),
(2, 'Authorize.Net', 'Yes', 'TRANSACTIONKEY', 'LOGINID', 'AUD', 'true', 2, '0.00'),
(3, 'Pin Payments', 'Yes', 'TEST', 'none', 'AUD', 'true', 3, '0.00'),
(4, 'PayPal', 'Yes', 'MyPayPalClientId', 'MyPayPalSecret', 'USD', 'true', 4, '0.00'),
(5, 'SecurePay', 'Yes', 'ABC0001', 'abc123', 'AUD', 'true', 5, '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `pcat` int(3) NOT NULL DEFAULT '1',
  `warehouse` int(11) NOT NULL DEFAULT '1',
  `product_name` varchar(50) NOT NULL,
  `product_code` varchar(255) DEFAULT NULL,
  `product_price` decimal(16,2) DEFAULT '0.00',
  `fproduct_price` decimal(16,2) NOT NULL DEFAULT '0.00',
  `taxrate` decimal(16,2) NOT NULL DEFAULT '0.00',
  `disrate` decimal(16,2) NOT NULL DEFAULT '0.00',
  `qty` int(11) NOT NULL,
  `product_des` text,
  `alert` int(11) NOT NULL,
  `product_width` varchar(30) DEFAULT NULL,
  `product_height` varchar(30) DEFAULT NULL,
  `product_lenght` varchar(30) DEFAULT NULL,
  `product_weight` varchar(30) DEFAULT NULL,
  `color` varchar(10) DEFAULT NULL,
  `quick_pick` int(11) DEFAULT NULL,
  `SKU_number` varchar(30) DEFAULT NULL,
  `UPC_barcode` text,
  `Package_quanity_in_bx` int(11) DEFAULT NULL,
  PRIMARY KEY (`pid`),
  KEY `pcat` (`pcat`),
  KEY `warehouse` (`warehouse`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `pcat`, `warehouse`, `product_name`, `product_code`, `product_price`, `fproduct_price`, `taxrate`, `disrate`, `qty`, `product_des`, `alert`, `product_width`, `product_height`, `product_lenght`, `product_weight`, `color`, `quick_pick`, `SKU_number`, `UPC_barcode`, `Package_quanity_in_bx`) VALUES
(1, 1, 1, 'ABC', 'ABC', '20.00', '20.00', '20.00', '20.00', 50, 'ABC TSET', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
(2, 1, 1, 'product 1', 'PR_01', '30000.00', '27500.00', '1200.00', '800.00', 0, 'This is dummy product 1', 20, '1 ft', '1 ft', '3 ft', '1.2 kg', '#FE7555', 1, '4521412541', 'ghjjbhjjkhkjnbhjnjnjknkjhjknmjmjkjhkjnmjmjnkjkn,kmnkjnkknjmnkjnjknhk', 15),
(3, 1, 1, 'product 2', 'PR_02', '20000.00', '17500.00', '200.00', '400.00', 100, 'This is dummy product 2', 20, '1 ft', '1 ft', '3 ft', '1.2 kg', '#FE7555', 1, '4521412541', 'ghjjbhjjkhkjnbhjnjnjknkjhjknmjmjkjhkjnmjmjnkjkn,kmnkjnkkn\r\njmnkjnjknhk', 15),
(4, 1, 1, 'product 3', 'PR_03', '20000.00', '17500.00', '200.00', '400.00', 100, 'This is dummy product 3', 20, '1 ft', '1 ft', '3 ft', '1.2 kg', '#FE7555', 1, '4521412541', 'ghjjbhjjkhkjnbhjnjnjknkjhjknmjmjkjhkjnmjmjnkjkn,kmnkjnkkn\r\njmnkjnjknhk', 15);

-- --------------------------------------------------------

--
-- Table structure for table `product_cat`
--

DROP TABLE IF EXISTS `product_cat`;
CREATE TABLE IF NOT EXISTS `product_cat` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `extra` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_cat`
--

INSERT INTO `product_cat` (`id`, `title`, `extra`) VALUES
(1, 'General', 'General Product Category');

-- --------------------------------------------------------

--
-- Table structure for table `product_warehouse`
--

DROP TABLE IF EXISTS `product_warehouse`;
CREATE TABLE IF NOT EXISTS `product_warehouse` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `extra` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_warehouse`
--

INSERT INTO `product_warehouse` (`id`, `title`, `extra`) VALUES
(1, 'Main Warehouse', 'Main Warehouse D');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `p_id` varchar(20) DEFAULT '1',
  `name` varchar(255) DEFAULT NULL,
  `status` enum('Waiting','Pending','Terminated','Finished','Progress') NOT NULL DEFAULT 'Pending',
  `priority` enum('Low','Medium','High','Urgent') DEFAULT 'Medium',
  `progress` int(3) DEFAULT NULL,
  `cid` int(11) DEFAULT NULL,
  `sdate` date NOT NULL,
  `edate` date DEFAULT NULL,
  `tag` varchar(255) DEFAULT NULL,
  `phase` varchar(255) DEFAULT NULL,
  `note` text,
  `worth` decimal(16,2) DEFAULT '0.00',
  `ptype` int(1) DEFAULT NULL,
  `classification` varchar(30) NOT NULL,
  `quota` text NOT NULL,
  `budget` float NOT NULL,
  `employee_id` varchar(250) NOT NULL,
  `setupdate` date NOT NULL,
  `hourlyrate` float NOT NULL,
  `tlcomission` float NOT NULL,
  `default_warehouse` int(11) NOT NULL,
  `shipping_option` varchar(30) NOT NULL,
  `task_communication` int(11) NOT NULL,
  `setuptime` time DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `p_id` (`p_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `p_id`, `name`, `status`, `priority`, `progress`, `cid`, `sdate`, `edate`, `tag`, `phase`, `note`, `worth`, `ptype`, `classification`, `quota`, `budget`, `employee_id`, `setupdate`, `hourlyrate`, `tlcomission`, `default_warehouse`, `shipping_option`, `task_communication`, `setuptime`) VALUES
(1, '1', 'Test show', 'Progress', 'Low', 0, 0, '2019-04-24', '2019-04-27', 'Some tag', 'Phase 1', '', '10000.00', 1, '', '', 0, '0', '2019-05-09', 0, 0, 0, '', 0, '00:00:00'),
(2, '1', 'abc', 'Progress', 'Medium', 0, NULL, '2019-05-10', NULL, 'hghj', NULL, '             This is dummy Notes.                                       ', '0.00', NULL, 'Store', '10', 100, '', '2019-05-10', 100, 100, 1, 'Pick-up', 1, '10:11:00'),
(3, '1', 'abc', 'Waiting', 'Medium', NULL, NULL, '2019-05-09', NULL, 'hghj', NULL, 'gjhgb', '0.00', NULL, 'Store', '10', 100, '10,11', '2019-05-03', 100, 100, 1, 'Ship', 0, '22:11:00'),
(4, '1', 'abc', 'Waiting', 'Medium', NULL, NULL, '2019-05-09', NULL, 'hghj', NULL, 'gjhgb', '0.00', NULL, 'Store', '10', 100, '10,11', '2019-05-03', 100, 100, 1, 'Ship', 0, '10:30:00'),
(5, '1', 'abc', 'Waiting', 'Medium', NULL, NULL, '2019-05-09', NULL, 'hghj', NULL, 'gjhgb', '0.00', NULL, 'Store', '10', 100, '10,11', '2019-05-03', 100, 100, 1, 'Ship', 0, '10:30:00'),
(6, '1', 'abc', 'Waiting', 'Medium', NULL, NULL, '2019-05-09', NULL, 'hghj', NULL, 'gjhgb', '0.00', NULL, 'Store', '10', 100, '10,11', '2019-05-01', 100, 100, 1, 'Ship', 0, '22:30:00'),
(7, '1', 'abc', 'Waiting', 'Medium', NULL, NULL, '2019-05-09', NULL, 'hghj', NULL, 'gjhgb', '0.00', NULL, 'Store', '10', 100, '10,11', '2019-05-02', 100, 100, 1, 'Ship', 0, '10:30:00'),
(8, '1', 'abc', 'Waiting', 'Medium', NULL, NULL, '2019-05-09', NULL, 'hghj', NULL, 'gjhgb', '0.00', NULL, 'store', '10', 100, '10,11', '2019-05-04', 100, 100, 1, 'Ship', 0, '03:00:00'),
(9, '1', 'Smart Phone', 'Waiting', 'Medium', NULL, NULL, '2019-05-11', NULL, 'Lorem,Ipsum,injected,humour', NULL, 'ABC', '0.00', NULL, 'store', '10', 10000, '10,11', '2019-05-03', 12, 12, 1, 'Ship', 0, '10:30:00'),
(10, '1', 'Smart Phone', 'Waiting', 'Medium', NULL, NULL, '2019-05-11', NULL, 'Lorem,Ipsum,passage,Finibus,Bonorum', NULL, 'sdsd', '0.00', NULL, 'store', '0', 0, '10,11', '2019-05-11', 12, 12, 1, 'Ship', 0, '10:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `project_meta`
--

DROP TABLE IF EXISTS `project_meta`;
CREATE TABLE IF NOT EXISTS `project_meta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `meta_key` int(11) NOT NULL,
  `meta_data` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `key3` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `meta_key` (`meta_key`),
  KEY `key3` (`key3`)
) ENGINE=InnoDB AUTO_INCREMENT=118 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project_meta`
--

INSERT INTO `project_meta` (`id`, `pid`, `meta_key`, `meta_data`, `value`, `key3`) VALUES
(1, 1, 12, NULL, '[Project Created]  @2019-04-24 04:15:59', NULL),
(2, 1, 2, 'true', 'true', NULL),
(4, 1, 12, NULL, '[Project Edited]  @2019-04-24 04:16:31', NULL),
(5, 1, 19, '10', NULL, NULL),
(6, 1, 12, NULL, '[Milestone] A1 @2019-04-24 04:18:53', NULL),
(7, 1, 8, '1', '1', NULL),
(8, 0, 2, NULL, NULL, NULL),
(9, 0, 19, '10', NULL, NULL),
(10, 0, 2, NULL, NULL, NULL),
(11, 0, 19, '10', NULL, NULL),
(12, 0, 19, '11', NULL, NULL),
(13, 0, 2, NULL, NULL, NULL),
(14, 0, 19, '10', NULL, NULL),
(15, 0, 2, NULL, NULL, NULL),
(16, 0, 19, '10', NULL, NULL),
(17, 0, 2, NULL, NULL, NULL),
(18, 0, 19, '10', NULL, NULL),
(19, 0, 2, NULL, NULL, NULL),
(20, 0, 19, '10', NULL, NULL),
(21, 0, 2, NULL, NULL, NULL),
(22, 0, 19, '10', NULL, NULL),
(23, 0, 2, NULL, NULL, NULL),
(24, 0, 19, '10', NULL, NULL),
(25, 0, 2, NULL, NULL, NULL),
(26, 0, 19, '10', NULL, NULL),
(27, 0, 2, NULL, NULL, NULL),
(28, 0, 19, '10', NULL, NULL),
(29, 0, 2, NULL, NULL, NULL),
(30, 0, 19, '10', NULL, NULL),
(31, 0, 2, NULL, NULL, NULL),
(32, 0, 19, '10', NULL, NULL),
(33, 0, 2, NULL, NULL, NULL),
(34, 0, 19, '10', NULL, NULL),
(35, 0, 2, NULL, NULL, NULL),
(36, 0, 19, '10', NULL, NULL),
(37, 0, 2, NULL, NULL, NULL),
(38, 0, 19, '10', NULL, NULL),
(39, 0, 2, NULL, NULL, NULL),
(40, 0, 19, '10', NULL, NULL),
(41, 0, 2, NULL, NULL, NULL),
(42, 0, 19, '10', NULL, NULL),
(43, 0, 2, NULL, NULL, NULL),
(44, 0, 19, '10', NULL, NULL),
(45, 0, 2, NULL, NULL, NULL),
(46, 0, 19, '10', NULL, NULL),
(47, 0, 2, NULL, NULL, NULL),
(48, 0, 2, NULL, NULL, NULL),
(49, 0, 2, NULL, NULL, NULL),
(50, 0, 2, NULL, NULL, NULL),
(51, 0, 2, NULL, NULL, NULL),
(52, 0, 19, '10', NULL, NULL),
(53, 0, 2, NULL, NULL, NULL),
(54, 0, 19, '10', NULL, NULL),
(55, 0, 2, NULL, NULL, NULL),
(56, 0, 19, '10', NULL, NULL),
(57, 0, 2, NULL, NULL, NULL),
(58, 0, 19, '10', NULL, NULL),
(59, 0, 2, NULL, NULL, NULL),
(60, 0, 2, NULL, NULL, NULL),
(61, 0, 2, NULL, NULL, NULL),
(62, 0, 2, NULL, NULL, NULL),
(63, 0, 2, NULL, NULL, NULL),
(64, 0, 2, NULL, NULL, NULL),
(65, 0, 2, NULL, NULL, NULL),
(66, 2, 12, NULL, '[Project Created]  @2019-05-09 05:26:24', NULL),
(67, 2, 2, NULL, NULL, NULL),
(68, 4, 12, NULL, '[Project Created]  @2019-05-09 05:29:25', NULL),
(69, 4, 2, NULL, NULL, NULL),
(70, 5, 12, NULL, '[Project Created]  @2019-05-09 05:31:20', NULL),
(71, 5, 2, NULL, NULL, NULL),
(72, 6, 12, NULL, '[Project Created]  @2019-05-09 05:33:54', NULL),
(73, 6, 2, NULL, NULL, NULL),
(74, 7, 12, NULL, '[Project Created]  @2019-05-09 05:35:10', NULL),
(75, 7, 2, NULL, NULL, NULL),
(76, 0, 2, NULL, NULL, NULL),
(77, 0, 2, NULL, NULL, NULL),
(78, 8, 12, NULL, '[Project Created]  @2019-05-09 05:41:36', NULL),
(79, 8, 2, NULL, NULL, NULL),
(80, 1, 12, NULL, '[Milestone] Smart Phone @2019-05-09 23:49:12', NULL),
(81, 2, 12, NULL, '[Milestone] sfs @2019-05-09 23:50:53', NULL),
(82, 1, 12, NULL, 'Smart Phone @2019-05-09 23:53:29', NULL),
(83, 1, 12, NULL, 'Desktop Pc @2019-05-09 23:55:57', NULL),
(84, 1, 12, NULL, 'jhon doe @2019-05-09 23:56:05', NULL),
(85, 1, 12, NULL, 'Tablets @2019-05-09 23:56:32', NULL),
(86, 1, 12, NULL, 'Mobile Accessories @2019-05-09 23:56:44', NULL),
(87, 1, 12, NULL, 'jhon doe @2019-05-09 23:56:58', NULL),
(88, 1, 12, NULL, 'Smart Phone @2019-05-09 23:57:26', NULL),
(89, 1, 12, NULL, 'Smart Phone @2019-05-10 00:03:28', NULL),
(90, 1, 12, NULL, 'Mobile Accessories @2019-05-10 00:04:25', NULL),
(91, 1, 12, NULL, 'Mobile Accessories @2019-05-10 00:05:09', NULL),
(92, 1, 12, NULL, 'Smart Phone @2019-05-10 00:05:16', NULL),
(93, 1, 12, NULL, 'aaa @2019-05-10 00:06:34', NULL),
(94, 1, 12, NULL, 'Smart Phone @2019-05-10 00:07:01', NULL),
(95, 1, 12, NULL, 'ASD @2019-05-10 00:07:17', NULL),
(96, 2, 12, NULL, '[Project Edited]  @2019-05-10 02:43:04', NULL),
(97, 2, 12, NULL, '[Project Edited]  @2019-05-10 02:43:33', NULL),
(98, 2, 12, NULL, '[Project Edited]  @2019-05-10 02:47:45', NULL),
(99, 2, 12, NULL, '[Show Edited]  @2019-05-10 06:00:17', NULL),
(100, 2, 12, NULL, 'Mobile Accessories @2019-05-10 06:02:16', NULL),
(101, 2, 12, NULL, 'shivani joshi @2019-05-10 06:12:10', NULL),
(102, 2, 12, NULL, '[Show Edited]  @2019-05-10 06:17:34', NULL),
(103, 2, 8, '3', '2', NULL),
(104, 2, 8, '3', '3', NULL),
(105, 2, 12, NULL, '[Milestone] milestone 1 @2019-05-11 03:27:13', NULL),
(106, 2, 12, NULL, '[Milestone] Desktop Pc @2019-05-11 04:09:46', NULL),
(107, 9, 12, NULL, '[Project Created]  @2019-05-11 04:38:09', NULL),
(108, 9, 2, NULL, NULL, NULL),
(109, 10, 12, NULL, '[Project Created]  @2019-05-11 04:39:25', NULL),
(110, 10, 2, NULL, NULL, NULL),
(111, 16, 2, NULL, NULL, NULL),
(112, 2, 13, '10', 'sdefdsafdsafdsaf<br><small>@2019-05-16 02:38:16</small>', NULL),
(113, 2, 13, '10', 'dfSFcsdfdfczxcZDF<br><small>@2019-05-16 02:40:03</small>', NULL),
(114, 2, 13, '10', 'dfsFdSF<br><small>@2019-05-16 02:47:15</small>', NULL),
(115, 2, 13, '10', 'thvbyvy65yv6<br><small>@2019-05-16 03:11:00</small>', NULL),
(116, 2, 12, NULL, '[Milestone] Mile stone 2 @2019-05-20 06:19:17', NULL),
(117, 2, 8, '6', '4', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

DROP TABLE IF EXISTS `purchase`;
CREATE TABLE IF NOT EXISTS `purchase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL,
  `invoicedate` date NOT NULL,
  `invoiceduedate` date NOT NULL,
  `subtotal` decimal(16,2) DEFAULT '0.00',
  `shipping` decimal(16,2) DEFAULT '0.00',
  `discount` decimal(16,2) DEFAULT '0.00',
  `tax` decimal(16,2) DEFAULT '0.00',
  `total` decimal(16,2) DEFAULT '0.00',
  `pmethod` varchar(14) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `status` enum('paid','due','canceled','partial') DEFAULT 'due',
  `csd` int(5) NOT NULL DEFAULT '0',
  `eid` int(4) NOT NULL,
  `pamnt` decimal(16,2) DEFAULT '0.00',
  `items` int(11) NOT NULL,
  `taxstatus` enum('yes','no') DEFAULT 'yes',
  `discstatus` tinyint(1) NOT NULL,
  `format_discount` enum('%','flat','b_p','bflat') DEFAULT NULL,
  `refer` varchar(20) DEFAULT NULL,
  `term` int(3) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `invoice` (`tid`),
  KEY `eid` (`eid`),
  KEY `csd` (`csd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_items`
--

DROP TABLE IF EXISTS `purchase_items`;
CREATE TABLE IF NOT EXISTS `purchase_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `product` varchar(255) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `price` decimal(16,2) DEFAULT '0.00',
  `tax` decimal(16,2) DEFAULT '0.00',
  `discount` decimal(16,2) DEFAULT '0.00',
  `subtotal` decimal(16,2) DEFAULT '0.00',
  `totaltax` decimal(16,2) DEFAULT '0.00',
  `totaldiscount` decimal(16,2) DEFAULT '0.00',
  `product_des` text,
  PRIMARY KEY (`id`),
  KEY `invoice` (`tid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `quotes`
--

DROP TABLE IF EXISTS `quotes`;
CREATE TABLE IF NOT EXISTS `quotes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL,
  `invoicedate` date NOT NULL,
  `invoiceduedate` date NOT NULL,
  `subtotal` decimal(16,2) DEFAULT '0.00',
  `shipping` decimal(16,2) DEFAULT '0.00',
  `discount` decimal(16,2) DEFAULT '0.00',
  `tax` decimal(16,2) DEFAULT '0.00',
  `total` decimal(16,2) DEFAULT '0.00',
  `pmethod` varchar(14) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `status` enum('pending','accepted','rejected') DEFAULT 'pending',
  `csd` int(5) NOT NULL DEFAULT '0',
  `eid` int(4) NOT NULL,
  `pamnt` decimal(16,2) NOT NULL,
  `items` int(11) NOT NULL,
  `taxstatus` enum('yes','no') DEFAULT 'yes',
  `discstatus` tinyint(1) NOT NULL,
  `format_discount` enum('%','flat','b_p','bflat') DEFAULT '%',
  `refer` varchar(20) DEFAULT NULL,
  `term` int(3) NOT NULL,
  `proposal` text,
  `multi` int(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `invoice` (`tid`),
  KEY `eid` (`eid`),
  KEY `csd` (`csd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `quotes_items`
--

DROP TABLE IF EXISTS `quotes_items`;
CREATE TABLE IF NOT EXISTS `quotes_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `product` varchar(255) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `price` decimal(16,2) DEFAULT '0.00',
  `tax` decimal(16,2) DEFAULT '0.00',
  `discount` decimal(16,2) DEFAULT '0.00',
  `subtotal` decimal(16,2) DEFAULT '0.00',
  `totaltax` decimal(16,2) DEFAULT '0.00',
  `totaldiscount` decimal(16,2) DEFAULT '0.00',
  `product_des` text,
  PRIMARY KEY (`id`),
  KEY `invoice` (`tid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rec_invoices`
--

DROP TABLE IF EXISTS `rec_invoices`;
CREATE TABLE IF NOT EXISTS `rec_invoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL,
  `invoicedate` date NOT NULL,
  `invoiceduedate` date NOT NULL,
  `subtotal` decimal(16,2) DEFAULT '0.00',
  `shipping` decimal(16,2) DEFAULT '0.00',
  `discount` decimal(16,2) DEFAULT '0.00',
  `tax` decimal(16,2) DEFAULT '0.00',
  `total` decimal(16,2) DEFAULT '0.00',
  `pmethod` varchar(14) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `status` enum('paid','due','canceled','partial') NOT NULL DEFAULT 'due',
  `csd` int(5) NOT NULL DEFAULT '0',
  `eid` int(4) NOT NULL,
  `pamnt` decimal(16,2) DEFAULT '0.00',
  `items` int(11) NOT NULL,
  `taxstatus` enum('yes','no') DEFAULT 'yes',
  `discstatus` tinyint(1) DEFAULT NULL,
  `format_discount` enum('%','flat','b_p','bflat') DEFAULT '%',
  `refer` varchar(20) DEFAULT NULL,
  `term` int(3) NOT NULL,
  `rec` varchar(10) NOT NULL,
  `ron` enum('Recurring','Stopped') DEFAULT 'Recurring',
  `multi` int(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `invoice` (`tid`),
  KEY `eid` (`eid`),
  KEY `csd` (`csd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rec_invoice_items`
--

DROP TABLE IF EXISTS `rec_invoice_items`;
CREATE TABLE IF NOT EXISTS `rec_invoice_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `product` varchar(255) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `price` decimal(16,2) DEFAULT '0.00',
  `tax` decimal(16,2) DEFAULT '0.00',
  `discount` decimal(16,2) DEFAULT '0.00',
  `subtotal` decimal(16,2) DEFAULT '0.00',
  `totaltax` decimal(16,2) DEFAULT '0.00',
  `totaldiscount` decimal(16,2) DEFAULT '0.00',
  `product_des` text,
  PRIMARY KEY (`id`),
  KEY `invoice` (`tid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

DROP TABLE IF EXISTS `reports`;
CREATE TABLE IF NOT EXISTS `reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `month` varchar(10) DEFAULT NULL,
  `year` int(4) NOT NULL,
  `invoices` int(11) NOT NULL,
  `sales` decimal(16,2) DEFAULT '0.00',
  `items` int(11) NOT NULL,
  `income` decimal(16,2) DEFAULT '0.00',
  `expense` decimal(16,2) DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `showbooth`
--

DROP TABLE IF EXISTS `showbooth`;
CREATE TABLE IF NOT EXISTS `showbooth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `size` varchar(30) NOT NULL,
  `cost` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `product_id` int(11) NOT NULL,
  `teamleader_id` varchar(200) NOT NULL,
  `prid` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `showbooth`
--

INSERT INTO `showbooth` (`id`, `size`, `cost`, `description`, `product_id`, `teamleader_id`, `prid`, `user_id`) VALUES
(3, '10', '22', 'dsfds', 1, '13', 2, 10),
(4, '14', '233', 'fdgd', 1, '11,13', 2, 10),
(5, '3ft', '12.5', 'This is Test Check', 2, '11,13', 2, 13);

-- --------------------------------------------------------

--
-- Table structure for table `showmeta`
--

DROP TABLE IF EXISTS `showmeta`;
CREATE TABLE IF NOT EXISTS `showmeta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` int(11) NOT NULL,
  `metakey` int(11) NOT NULL,
  `meatadata` varchar(200) NOT NULL,
  `value` varchar(200) NOT NULL,
  `key3` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sid` (`sid`),
  KEY `sid_2` (`sid`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `showmeta`
--

INSERT INTO `showmeta` (`id`, `sid`, `metakey`, `meatadata`, `value`, `key3`) VALUES
(1, 2, 12, '', 'Desktop Pc @2019-05-10 06:53:26', NULL),
(2, 2, 12, '', 'Desktop Pc @2019-05-10 08:09:37', NULL),
(3, 2, 12, '', '[Milestone] Desktop Pc @2019-05-11 04:11:26', NULL),
(4, 16, 12, '', '[Show Created]  @2019-05-11 05:09:29', NULL),
(5, 16, 12, '', '[Show Edited]  @2019-05-11 05:25:45', NULL),
(6, 16, 12, '', '[Show Edited]  @2019-05-11 05:26:02', NULL),
(7, 5, 12, '', '[Show Edited]  @2019-05-11 05:33:32', NULL),
(8, 2, 12, '', '[Show Edited]  @2019-05-11 05:37:03', NULL),
(9, 2, 13, '10', 'sdfsg<br><small>@2019-05-16 03:26:15</small>', NULL),
(10, 2, 13, '10', 'sdfsg<br><small>@2019-05-16 03:26:21</small>', NULL),
(11, 2, 13, '10', 'dfsdfdsf<br><small>@2019-05-16 03:27:10</small>', NULL),
(12, 2, 12, '', '[Milestone] Social Media @2019-05-20 05:25:37', NULL),
(15, 17, 12, '', '[Show Created]  @2019-05-21 05:52:20', NULL),
(16, 18, 12, '', '[Show Created]  @2019-05-21 07:44:12', NULL),
(17, 19, 12, '', '[Show Created]  @2019-05-22 04:34:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `showmilestone`
--

DROP TABLE IF EXISTS `showmilestone`;
CREATE TABLE IF NOT EXISTS `showmilestone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `sdate` date NOT NULL,
  `edate` date NOT NULL,
  `exp` text NOT NULL,
  `color` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `showmilestone`
--

INSERT INTO `showmilestone` (`id`, `pid`, `name`, `sdate`, `edate`, `exp`, `color`) VALUES
(1, 2, 'Desktop Pc', '2019-05-11', '2019-05-11', '<p>sdasdads</p>', '#0b97f4');

-- --------------------------------------------------------

--
-- Table structure for table `shows`
--

DROP TABLE IF EXISTS `shows`;
CREATE TABLE IF NOT EXISTS `shows` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `show_id` varchar(255) DEFAULT NULL,
  `show_name` varchar(255) NOT NULL,
  `show_status` enum('Waiting','Pending','Terminated','Finished') NOT NULL DEFAULT 'Waiting',
  `show_attendence` float NOT NULL,
  `show_budget` decimal(10,0) NOT NULL,
  `show_quota` float NOT NULL,
  `show_assign_to` varchar(255) NOT NULL,
  `show_start_date` date NOT NULL,
  `show_end_date` date NOT NULL,
  `show_setup_date` date NOT NULL,
  `show_setup_time` time NOT NULL,
  `show_hourly_wage` float NOT NULL,
  `show_note` text NOT NULL,
  `show_tl_commission` float NOT NULL,
  `show_default_warehouse` int(11) NOT NULL,
  `show_shipping_option` varchar(30) NOT NULL,
  `show_tag` text NOT NULL,
  `show_task_communication` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shows`
--

INSERT INTO `shows` (`id`, `show_id`, `show_name`, `show_status`, `show_attendence`, `show_budget`, `show_quota`, `show_assign_to`, `show_start_date`, `show_end_date`, `show_setup_date`, `show_setup_time`, `show_hourly_wage`, `show_note`, `show_tl_commission`, `show_default_warehouse`, `show_shipping_option`, `show_tag`, `show_task_communication`, `created_at`) VALUES
(1, 'XYXZ', 'SHOW NAME', 'Waiting', 10, '100', 1000, '10,11', '2019-05-09', '2019-05-10', '2019-05-01', '10:30:00', 10000, 'Notes', 100000, 1, 'Ship', 'hbjjhnkj', 0, '2019-05-09 12:03:09'),
(2, '1002', 'XYX', 'Finished', 10, '100', 1000, '10,11', '2019-05-11', '2019-05-11', '2019-05-11', '10:30:00', 10000, 'This is demo show notes 1', 100000, 1, 'Pick-up', 'hbjjhnkj', 1, '2019-05-09 12:03:16'),
(19, NULL, 'Dove ', 'Waiting', 100, '20000', 10, '1,2', '2019-05-22', '2019-05-31', '2019-05-24', '10:30:00', 10, '<p>This is Dummy Note for testing</p>', 15, 1, 'Ship', 'humour, randomised ', 0, '2019-05-22 08:34:11'),
(18, 'SHOW123', 'show testing', 'Waiting', 10, '500', 20, '1,2', '2019-05-01', '2019-05-16', '2019-05-09', '10:30:00', 10, '<p>Hi, This is dummy Data.&nbsp;</p>', 100000, 1, 'Ship', 'scsadc', 1, '2019-05-21 11:44:12');

-- --------------------------------------------------------

--
-- Table structure for table `showtodolist`
--

DROP TABLE IF EXISTS `showtodolist`;
CREATE TABLE IF NOT EXISTS `showtodolist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `showtaskname` varchar(200) NOT NULL,
  `showtaskstatus` enum('Due','Done','Progress','') NOT NULL,
  `showtaskdate` date NOT NULL,
  `showtaskstart` date NOT NULL,
  `showtaskdue` date NOT NULL,
  `showtaskdescription` text NOT NULL,
  `showtaskeid` int(11) NOT NULL,
  `showtaskaid` int(11) NOT NULL,
  `showrelated` int(11) NOT NULL,
  `showpriority` enum('Low','Medium','High','Urgent') NOT NULL,
  `sid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `showtodolist`
--

INSERT INTO `showtodolist` (`id`, `showtaskname`, `showtaskstatus`, `showtaskdate`, `showtaskstart`, `showtaskdue`, `showtaskdescription`, `showtaskeid`, `showtaskaid`, `showrelated`, `showpriority`, `sid`) VALUES
(1, 'Shivani', 'Due', '2019-05-11', '2019-05-11', '2019-05-11', '<p>hjjknjknkj njkiuujioijkmkl<br></p>', 10, 10, 1, 'Medium', 2),
(2, 'aaa', 'Progress', '2019-05-11', '2019-05-11', '2019-05-11', '<p>afaedf<br></p>', 10, 10, 1, 'Medium', 2);

-- --------------------------------------------------------

--
-- Table structure for table `show_location`
--

DROP TABLE IF EXISTS `show_location`;
CREATE TABLE IF NOT EXISTS `show_location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `show_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `contact_person` varchar(30) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `extension` varchar(50) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `address` text NOT NULL,
  `location` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `show_request`
--

DROP TABLE IF EXISTS `show_request`;
CREATE TABLE IF NOT EXISTS `show_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `show_id` int(11) NOT NULL,
  `teamleader_id` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0-no response, 1-Accepted, 2-rejected',
  `requested_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `show_request`
--

INSERT INTO `show_request` (`id`, `show_id`, `teamleader_id`, `status`, `requested_at`) VALUES
(1, 1, 13, 2, '2019-05-21 12:05:49'),
(3, 18, 13, 0, '2019-05-22 04:36:19');

-- --------------------------------------------------------

--
-- Table structure for table `stock_return`
--

DROP TABLE IF EXISTS `stock_return`;
CREATE TABLE IF NOT EXISTS `stock_return` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(8) NOT NULL,
  `invoicedate` date NOT NULL,
  `invoiceduedate` date NOT NULL,
  `subtotal` decimal(16,2) DEFAULT '0.00',
  `shipping` decimal(16,2) DEFAULT '0.00',
  `discount` decimal(16,2) DEFAULT '0.00',
  `tax` decimal(16,2) DEFAULT '0.00',
  `total` decimal(16,2) DEFAULT '0.00',
  `pmethod` varchar(14) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `status` enum('pending','accepted','rejected','partial','canceled') DEFAULT 'pending',
  `csd` int(5) NOT NULL DEFAULT '0',
  `eid` int(4) NOT NULL,
  `pamnt` decimal(16,2) DEFAULT '0.00',
  `items` int(11) NOT NULL,
  `taxstatus` enum('yes','no') DEFAULT 'yes',
  `discstatus` tinyint(1) NOT NULL,
  `format_discount` enum('%','flat','b_p','bflat') DEFAULT NULL,
  `refer` varchar(20) DEFAULT NULL,
  `term` int(3) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `invoice` (`tid`),
  KEY `eid` (`eid`),
  KEY `csd` (`csd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `stock_return_items`
--

DROP TABLE IF EXISTS `stock_return_items`;
CREATE TABLE IF NOT EXISTS `stock_return_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `product` varchar(255) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `price` decimal(16,2) DEFAULT '0.00',
  `tax` decimal(16,2) DEFAULT '0.00',
  `discount` decimal(16,2) DEFAULT '0.00',
  `subtotal` decimal(16,2) DEFAULT '0.00',
  `totaltax` decimal(16,2) DEFAULT '0.00',
  `totaldiscount` decimal(16,2) DEFAULT '0.00',
  `product_des` text,
  PRIMARY KEY (`id`),
  KEY `invoice` (`tid`) KEY_BLOCK_SIZE=1024 USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `storebooth`
--

DROP TABLE IF EXISTS `storebooth`;
CREATE TABLE IF NOT EXISTS `storebooth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `size` varchar(30) NOT NULL,
  `cost` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `product_id` int(11) NOT NULL,
  `teamleader_id` varchar(200) DEFAULT NULL,
  `prid` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `storebooth`
--

INSERT INTO `storebooth` (`id`, `size`, `cost`, `description`, `product_id`, `teamleader_id`, `prid`, `user_id`) VALUES
(1, 'ada', 'sas', 'asds', 1, NULL, 2, 0),
(2, 'ada', 'sas', 'asds', 1, NULL, 2, 0),
(3, 'df', 'sfcsdf', 'vdsfsdf', 1, '10,11', 2, 0),
(4, 'df', 'sfcsdf', 'vdsfsdf', 1, '10,11', 2, 0),
(5, 'asa', 'sas', 'asas', 1, '10,11', 2, 0),
(6, 'asa', 'sas', 'asas', 1, '10,11', 2, 0),
(7, 'sd', 'sadsad', 'sadsad', 1, '10,11', 2, 0),
(8, '23', '232', '2131', 1, '10,11', 2, 0),
(9, 'sdf', 'zasfdsadf', 'asdasd', 1, '10,11,13', 2, 0),
(10, '12jnjm', '12dd', 'sfsdfdsf', 1, '10,11', 2, 10),
(11, 'sad', 'sad', 'asdasd', 1, '10,11', 2, 10);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
CREATE TABLE IF NOT EXISTS `supplier` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `region` varchar(30) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `postbox` varchar(20) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `picture` varchar(100) NOT NULL DEFAULT 'example.png',
  `gid` int(5) NOT NULL DEFAULT '1',
  `company` varchar(100) DEFAULT NULL,
  `taxid` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sys_smtp`
--

DROP TABLE IF EXISTS `sys_smtp`;
CREATE TABLE IF NOT EXISTS `sys_smtp` (
  `id` int(11) NOT NULL,
  `host` varchar(100) NOT NULL,
  `port` int(11) NOT NULL,
  `auth` enum('true','false') NOT NULL,
  `auth_type` enum('none','tls','ssl') NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `sender` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sys_smtp`
--

INSERT INTO `sys_smtp` (`id`, `host`, `port`, `auth`, `auth_type`, `username`, `password`, `sender`) VALUES
(1, 'smtp.com', 587, 'true', 'none', 'support@example.com', '123456', 'support@example.com');

-- --------------------------------------------------------

--
-- Table structure for table `teamleader_apply_show`
--

DROP TABLE IF EXISTS `teamleader_apply_show`;
CREATE TABLE IF NOT EXISTS `teamleader_apply_show` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `TeamLeader_id` int(11) NOT NULL,
  `applied_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=91 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teamleader_apply_show`
--

INSERT INTO `teamleader_apply_show` (`id`, `project_id`, `TeamLeader_id`, `applied_at`) VALUES
(1, 6, 10, '2019-05-13 10:56:33'),
(2, 2, 13, '2019-05-21 15:24:41'),
(3, 2, 13, '2019-05-21 15:28:55'),
(4, 2, 13, '2019-05-21 15:29:04'),
(5, 2, 13, '2019-05-21 15:30:30'),
(6, 1, 13, '2019-05-21 16:18:38'),
(7, 1, 13, '2019-05-21 16:19:16'),
(8, 1, 10, '2019-05-21 16:23:24'),
(9, 1, 13, '2019-05-21 16:24:06'),
(10, 1, 13, '2019-05-21 16:24:26'),
(11, 1, 13, '2019-05-21 16:24:28'),
(12, 1, 13, '2019-05-21 16:25:43'),
(13, 1, 13, '2019-05-21 16:28:01'),
(14, 1, 10, '2019-05-21 16:32:33'),
(15, 1, 10, '2019-05-21 16:37:25'),
(16, 1, 13, '2019-05-21 16:37:51'),
(17, 1, 13, '2019-05-21 16:38:42'),
(18, 1, 13, '2019-05-21 16:39:53'),
(19, 1, 13, '2019-05-21 16:39:59'),
(20, 1, 13, '2019-05-21 16:40:07'),
(21, 1, 13, '2019-05-21 16:40:52'),
(22, 1, 13, '2019-05-21 16:45:05'),
(23, 1, 13, '2019-05-21 16:45:17'),
(24, 1, 13, '2019-05-21 16:50:34'),
(25, 1, 13, '2019-05-21 16:51:23'),
(26, 1, 13, '2019-05-21 16:51:36'),
(27, 1, 13, '2019-05-21 16:52:32'),
(28, 1, 13, '2019-05-21 16:56:35'),
(29, 1, 13, '2019-05-21 17:01:58'),
(30, 1, 13, '2019-05-21 17:02:11'),
(31, 1, 13, '2019-05-21 17:02:20'),
(32, 1, 13, '2019-05-21 17:05:08'),
(33, 1, 13, '2019-05-21 17:09:30'),
(34, 1, 13, '2019-05-21 17:12:07'),
(35, 1, 13, '2019-05-21 17:12:14'),
(36, 1, 13, '2019-05-21 17:12:20'),
(37, 1, 13, '2019-05-21 17:12:28'),
(38, 1, 13, '2019-05-21 17:14:38'),
(39, 1, 13, '2019-05-21 17:16:22'),
(40, 1, 13, '2019-05-21 17:17:32'),
(41, 1, 13, '2019-05-21 17:18:22'),
(42, 1, 13, '2019-05-21 17:18:25'),
(43, 1, 13, '2019-05-21 17:18:29'),
(44, 1, 13, '2019-05-21 17:18:35'),
(45, 1, 13, '2019-05-21 17:20:56'),
(46, 1, 13, '2019-05-21 17:22:15'),
(47, 1, 13, '2019-05-21 17:32:02'),
(48, 1, 13, '2019-05-21 17:35:04'),
(49, 1, 13, '2019-05-21 17:35:44'),
(50, 1, 13, '2019-05-21 17:36:23'),
(51, 1, 13, '2019-05-21 17:45:07'),
(52, 1, 13, '2019-05-21 17:49:53'),
(53, 1, 13, '2019-05-21 17:50:07'),
(54, 1, 13, '2019-05-21 17:50:25'),
(55, 1, 13, '2019-05-21 17:50:40'),
(56, 1, 13, '2019-05-21 17:51:03'),
(57, 1, 13, '2019-05-21 17:51:40'),
(58, 1, 13, '2019-05-21 17:52:04'),
(59, 1, 13, '2019-05-21 17:52:44'),
(60, 1, 13, '2019-05-21 17:52:56'),
(61, 1, 13, '2019-05-21 17:53:17'),
(62, 1, 13, '2019-05-21 17:53:27'),
(63, 1, 10, '2019-05-22 09:09:16'),
(64, 1, 13, '2019-05-22 09:50:58'),
(65, 1, 13, '2019-05-22 09:53:03'),
(66, 1, 13, '2019-05-22 09:57:02'),
(67, 1, 13, '2019-05-22 10:03:34'),
(68, 1, 13, '2019-05-22 10:06:23'),
(69, 1, 13, '2019-05-22 10:06:32'),
(70, 1, 13, '2019-05-22 10:09:21'),
(71, 1, 13, '2019-05-22 10:11:12'),
(72, 1, 13, '2019-05-22 10:11:29'),
(73, 1, 13, '2019-05-22 10:16:15'),
(74, 1, 13, '2019-05-22 10:16:35'),
(75, 1, 13, '2019-05-22 10:16:52'),
(76, 1, 13, '2019-05-22 10:18:09'),
(77, 1, 13, '2019-05-22 10:20:36'),
(78, 1, 13, '2019-05-22 10:21:11'),
(79, 1, 13, '2019-05-22 10:21:17'),
(80, 1, 13, '2019-05-22 10:21:26'),
(81, 1, 13, '2019-05-22 10:21:36'),
(82, 1, 13, '2019-05-22 10:21:42'),
(83, 1, 13, '2019-05-22 10:21:47'),
(84, 1, 13, '2019-05-22 10:21:52'),
(85, 1, 13, '2019-05-22 10:24:17'),
(86, 1, 10, '2019-05-22 10:26:16'),
(87, 1, 10, '2019-05-22 10:26:47'),
(88, 1, 13, '2019-05-22 11:40:49'),
(89, 1, 10, '2019-05-22 11:42:11'),
(90, 1, 10, '2019-05-22 12:58:01');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
CREATE TABLE IF NOT EXISTS `tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `cid` int(11) NOT NULL,
  `status` enum('Solved','Processing','Waiting') NOT NULL,
  `section` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tickets_th`
--

DROP TABLE IF EXISTS `tickets_th`;
CREATE TABLE IF NOT EXISTS `tickets_th` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL,
  `message` text,
  `cid` int(11) NOT NULL,
  `eid` int(11) NOT NULL,
  `cdate` datetime NOT NULL,
  `attach` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tid` (`tid`),
  KEY `cid` (`cid`),
  KEY `eid` (`eid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `todolist`
--

DROP TABLE IF EXISTS `todolist`;
CREATE TABLE IF NOT EXISTS `todolist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tdate` date NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `status` enum('Due','Done','Progress') NOT NULL DEFAULT 'Due',
  `start` date NOT NULL,
  `duedate` date NOT NULL,
  `description` text,
  `eid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `related` int(11) NOT NULL,
  `priority` enum('Low','Medium','High','Urgent') NOT NULL,
  `rid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `todolist`
--

INSERT INTO `todolist` (`id`, `tdate`, `name`, `status`, `start`, `duedate`, `description`, `eid`, `aid`, `related`, `priority`, `rid`) VALUES
(1, '2019-04-24', 'Some test', 'Due', '2019-04-24', '2019-04-24', '', 10, 10, 1, 'Low', 1),
(2, '2019-05-10', 'Mobile Accessories', 'Done', '2019-05-10', '2019-05-10', '<p>ghjbkjh uhmuijoij</p>', 10, 10, 1, 'Medium', 2),
(3, '2019-05-11', 'ABC', 'Due', '2019-05-02', '2019-05-04', '<p>AVgjhkjh hujhkji huihjoijlkml<br></p>', 11, 10, 1, 'High', 2);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acid` int(11) NOT NULL,
  `account` varchar(200) NOT NULL,
  `type` enum('Income','Expense','Transfer') NOT NULL,
  `cat` varchar(200) NOT NULL,
  `debit` decimal(16,2) DEFAULT '0.00',
  `credit` decimal(16,2) DEFAULT '0.00',
  `payer` varchar(200) DEFAULT NULL,
  `payerid` int(11) NOT NULL DEFAULT '0',
  `method` varchar(200) DEFAULT NULL,
  `date` date NOT NULL,
  `tid` int(11) NOT NULL DEFAULT '0',
  `eid` int(11) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `ext` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `transactions_cat`
--

DROP TABLE IF EXISTS `transactions_cat`;
CREATE TABLE IF NOT EXISTS `transactions_cat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transactions_cat`
--

INSERT INTO `transactions_cat` (`id`, `name`) VALUES
(1, 'Sales'),
(2, 'Purchase'),
(3, 'Booth rental'),
(4, 'Display purchase'),
(5, 'Show expenses');

-- --------------------------------------------------------

--
-- Table structure for table `univarsal_api`
--

DROP TABLE IF EXISTS `univarsal_api`;
CREATE TABLE IF NOT EXISTS `univarsal_api` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `key1` varchar(255) DEFAULT NULL,
  `key2` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `method` varchar(10) DEFAULT NULL,
  `other` text,
  `active` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `univarsal_api`
--

INSERT INTO `univarsal_api` (`id`, `name`, `key1`, `key2`, `url`, `method`, `other`, `active`) VALUES
(1, 'Goo.gl URL Shortner', 'yourkey', '0', '0', '0', '0', 0),
(2, 'Twilio SMS API', 'ac', 'key', '+11234567', '0', '0', 1),
(3, 'Company Support', '1', '1', 'support@gmail.com', NULL, '<p>Your footer</p>', 1),
(4, 'Currency', '.', ',', '2', 'l', NULL, NULL),
(5, 'Exchange', 'key1', 'key2', 'USD', NULL, NULL, 1),
(6, 'New Invoice Notification', '[{Company}] Invoice #{BillNumber} Generated', NULL, NULL, NULL, 'Dear Client,\r\nWe are contacting you in regard to a payment received for invoice # {BillNumber} that has been created on your account. You may find the invoice with below link.\r\n\r\nView Invoice\r\n{URL}\r\n\r\nWe look forward to conducting future business with you.\r\n\r\nKind Regards,\r\nTeam\r\n{CompanyDetails}', NULL),
(7, 'Invoice Payment Reminder', '[{Company}] Invoice #{BillNumber} Payment Reminder', NULL, NULL, NULL, '<p>Dear Client,</p><p>We are contacting you in regard to a payment reminder of invoice # {BillNumber} that has been created on your account. You may find the invoice with below link. Please pay the balance of {Amount} due by {DueDate}.</p><p>\r\n\r\n<b>View Invoice</b></p><p><span style="font-size: 1rem;">{URL}\r\n</span></p><p><span style="font-size: 1rem;">\r\nWe look forward to conducting future business with you.</span></p><p><span style="font-size: 1rem;">\r\n\r\nKind Regards,\r\n</span></p><p><span style="font-size: 1rem;">\r\nTeam\r\n</span></p><p><span style="font-size: 1rem;">\r\n{CompanyDetails}</span></p>', NULL),
(8, 'Invoice Refund Proceeded', '{Company} Invoice #{BillNumber} Refund Proceeded', NULL, NULL, NULL, '<p>Dear Client,</p><p>\r\nWe are contacting you in regard to a refund request processed for invoice # {BillNumber} that has been created on your account. You may find the invoice with below link. Please pay the balance of {Amount}  by {DueDate}.\r\n</p><p>\r\nView Invoice\r\n</p><p>{URL}\r\n</p><p>\r\nWe look forward to conducting future business with you.\r\n</p><p>\r\nKind Regards,\r\n</p><p>\r\nTeam\r\n\r\n{CompanyDetails}</p>', NULL),
(9, 'Invoice payment Received', '{Company} Payment Received for Invoice #{BillNumber}', NULL, NULL, NULL, '<p>Dear Client,\r\n</p><p>We are contacting you in regard to a payment received for invoice  # {BillNumber} that has been created on your account. You can find the invoice with below link.\r\n</p><p>\r\nView Invoice</p><p>\r\n{URL}\r\n</p><p>\r\nWe look forward to conducting future business with you.\r\n</p><p>\r\nKind Regards,\r\n</p><p>\r\nTeam\r\n</p><p>\r\n{CompanyDetails}</p>', NULL),
(10, 'Invoice Overdue Notice', '{Company} Invoice #{BillNumber} Generated for you', NULL, NULL, NULL, '<p>Dear Client,</p><p>\r\nWe are contacting you in regard to an Overdue Notice for invoice # {BillNumber} that has been created on your account. You may find the invoice with below link.\r\nPlease pay the balance of {Amount} due by {DueDate}.\r\n</p><p>View Invoice\r\n</p><p>{URL}\r\n</p><p>\r\nWe look forward to conducting future business with you.\r\n</p><p>\r\nKind Regards,\r\n</p><p>\r\nTeam</p><p>\r\n\r\n{CompanyDetails}</p>', NULL),
(11, 'Quote Proposal', '{Company} Quote #{BillNumber} Generated for you', NULL, NULL, NULL, '<p>Dear Client,</p><p>\r\nWe are contacting you in regard to a new quote # {BillNumber} that has been created on your account. You may find the quote with below link.\r\n</p><p>\r\nView Invoice\r\n</p><p>{URL}\r\n</p><p>\r\nWe look forward to conducting future business with you.</p><p>\r\n\r\nKind Regards,</p><p>\r\n\r\nTeam</p><p>\r\n\r\n{CompanyDetails}</p>', NULL),
(12, 'Purchase Order Request', '{Company} Purchase Order #{BillNumber} Requested', NULL, NULL, NULL, '<p>Dear Client,\r\n</p><p>We are contacting you in regard to a new purchase # {BillNumber} that has been requested on your account. You may find the order with below link. </p><p>\r\n\r\nView Invoice\r\n</p><p>{URL}</p><p>\r\n\r\nWe look forward to conducting future business with you.</p><p>\r\n\r\nKind Regards,\r\n</p><p>\r\nTeam</p><p>\r\n\r\n{CompanyDetails}</p>', NULL),
(13, 'Stock Return Mail', '{Company} New purchase return # {BillNumber}', NULL, NULL, NULL, 'Dear Client,\r\n\r\nWe are contacting you in regard to a new purchase return # {BillNumber} that has been requested on your account. You may find the order with below link.\r\n\r\nView Invoice\r\n\r\n{URL}\r\n\r\nWe look forward to conducting future business with you.\r\n\r\nKind Regards,\r\n\r\nTeam\r\n\r\n{CompanyDetails}', NULL),
(30, 'New Invoice Notification', NULL, NULL, NULL, NULL, 'Dear Customer, new invoice  # {BillNumber} generated. {URL} Regards', NULL),
(31, 'Invoice Payment Reminder', NULL, NULL, NULL, NULL, 'Dear Customer, Please make payment of invoice  # {BillNumber}. {URL} Regards', NULL),
(32, 'Invoice Refund Proceeded', NULL, NULL, NULL, NULL, 'Dear Customer, Refund generated of invoice # {BillNumber}. {URL} Regards', NULL),
(33, 'Invoice payment Received', NULL, NULL, NULL, NULL, 'Dear Customer, Payment received of invoice # {BillNumber}. {URL} Regards', NULL),
(34, 'Invoice Overdue Notice', NULL, NULL, NULL, NULL, 'Dear Customer, Dear Customer,Payment is overdue of invoice # {BillNumber}. {URL} Regards', NULL),
(35, 'Quote Proposal', NULL, NULL, NULL, NULL, 'Dear Customer, Dear Customer, a quote created for you # {BillNumber}. {URL} Regards', NULL),
(36, 'Purchase Order Request', NULL, NULL, NULL, NULL, 'Dear Customer, Dear, a purchased order for you # {BillNumber}. {URL} Regards', NULL),
(51, 'QT#', 'PO#', 'REC#', 'SR#', 'TRN#', 'SRN#', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `users_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) DEFAULT NULL,
  `var_key` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `is_deleted` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `user_type` varchar(255) DEFAULT NULL,
  `cid` int(11) DEFAULT NULL,
  PRIMARY KEY (`users_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
