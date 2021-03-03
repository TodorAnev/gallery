-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.11-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for gallery
CREATE DATABASE IF NOT EXISTS `gallery` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `gallery`;

-- Dumping structure for table gallery.tbl_comments
CREATE TABLE IF NOT EXISTS `tbl_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `p_id` int(11) NOT NULL,
  `c_author` varchar(100) NOT NULL,
  `c_body` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`p_id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table gallery.tbl_comments: ~3 rows (approximately)
/*!40000 ALTER TABLE `tbl_comments` DISABLE KEYS */;
INSERT INTO `tbl_comments` (`id`, `p_id`, `c_author`, `c_body`) VALUES
	(35, 61, 'Sample Comment 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse finibus tellus ut suscipit tempus. Praesent semper vulputate magna, et malesuada diam. Sed elementum dolor id maximus efficitur. Mauris non cursus velit. Maecenas nec orci quis metus tempor condimentum id eget diam.'),
	(36, 63, 'Sample Comment 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse finibus tellus ut suscipit tempus. Praesent semper vulputate magna, et malesuada diam. Sed elementum dolor id maximus efficitur. Mauris non cursus velit. Maecenas nec orci quis metus tempor condimentum id eget diam.'),
	(37, 65, 'Sample Comment 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse finibus tellus ut suscipit tempus. Praesent semper vulputate magna, et malesuada diam. Sed elementum dolor id maximus efficitur. Mauris non cursus velit. Maecenas nec orci quis metus tempor condimentum id eget diam.'),
	(38, 68, 'Sample Comment 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse finibus tellus ut suscipit tempus. Praesent semper vulputate magna, et malesuada diam. Sed elementum dolor id maximus efficitur. Mauris non cursus velit. Maecenas nec orci quis metus tempor condimentum id eget diam.'),
	(39, 68, 'Sample Comment 2', 'Curabitur sollicitudin in lacus ac sollicitudin. Etiam semper leo sed ex condimentum euismod. Donec risus ante, sagittis quis velit ac, tincidunt mattis libero.'),
	(40, 68, 'Sample Comment 3', 'Mauris tincidunt magna eu lacus sollicitudin, eget tincidunt elit molestie. Mauris consectetur, sem blandit semper vulputate, diam nisi congue nisi, ac pharetra ex nibh sagittis ante. Etiam pretium ut lacus quis ornare.'),
	(41, 68, 'Sample Comment 4', 'Nulla vitae nisi ullamcorper, vestibulum velit ut, vestibulum eros. Sed varius sed lacus nec dapibus. Integer aliquam ut diam at auctor. Ut eleifend, mi et faucibus pretium, purus ex euismod ante, a mollis turpis risus non purus.'),
	(42, 65, 'Sample Comment 2', 'Curabitur sollicitudin in lacus ac sollicitudin. Etiam semper leo sed ex condimentum euismod. Donec risus ante, sagittis quis velit ac, tincidunt mattis libero.'),
	(43, 65, 'Sample Comment 3', 'Nulla vitae nisi ullamcorper, vestibulum velit ut, vestibulum eros. Sed varius sed lacus nec dapibus. Integer aliquam ut diam at auctor. Ut eleifend, mi et faucibus pretium, purus ex euismod ante, a mollis turpis risus non purus.'),
	(44, 61, 'Sample Comment 2', 'Mauris tincidunt magna eu lacus sollicitudin, eget tincidunt elit molestie. Mauris consectetur, sem blandit semper vulputate, diam nisi congue nisi, ac pharetra ex nibh sagittis ante. Etiam pretium ut lacus quis ornare.');
/*!40000 ALTER TABLE `tbl_comments` ENABLE KEYS */;

-- Dumping structure for table gallery.tbl_photos
CREATE TABLE IF NOT EXISTS `tbl_photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `p_title` varchar(100) NOT NULL,
  `p_description` text NOT NULL,
  `p_filename` varchar(100) NOT NULL,
  `p_type` varchar(100) NOT NULL,
  `p_size` int(11) NOT NULL,
  `p_caption` varchar(100) NOT NULL,
  `p_alternate_text` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table gallery.tbl_photos: ~8 rows (approximately)
/*!40000 ALTER TABLE `tbl_photos` DISABLE KEYS */;
INSERT INTO `tbl_photos` (`id`, `p_title`, `p_description`, `p_filename`, `p_type`, `p_size`, `p_caption`, `p_alternate_text`) VALUES
	(61, 'Sample Post 1', 'Mauris tincidunt magna eu lacus sollicitudin, eget tincidunt elit molestie. Mauris consectetur, sem blandit semper vulputate, diam nisi congue nisi, ac pharetra ex nibh sagittis ante. Etiam pretium ut lacus quis ornare.', 'images-36 copy.jpg', 'image/jpeg', 21672, 'Sample Caption', 'Sample Alternate Text'),
	(62, 'Sample Post 2', 'Mauris tincidunt magna eu lacus sollicitudin, eget tincidunt elit molestie. Mauris consectetur, sem blandit semper vulputate, diam nisi congue nisi, ac pharetra ex nibh sagittis ante. Etiam pretium ut lacus quis ornare.', 'images-50 copy.jpg', 'image/jpeg', 21652, 'Sample Caption', 'Sample Alternate Text'),
	(63, 'Sample Post 3', 'Mauris tincidunt magna eu lacus sollicitudin, eget tincidunt elit molestie. Mauris consectetur, sem blandit semper vulputate, diam nisi congue nisi, ac pharetra ex nibh sagittis ante. Etiam pretium ut lacus quis ornare.', 'images-39.jpg', 'image/jpeg', 24969, 'Sample Caption', 'Sample Alternate Text'),
	(64, 'Sample Post 4', 'Mauris tincidunt magna eu lacus sollicitudin, eget tincidunt elit molestie. Mauris consectetur, sem blandit semper vulputate, diam nisi congue nisi, ac pharetra ex nibh sagittis ante. Etiam pretium ut lacus quis ornare.', 'images-27 copy.jpg', 'image/jpeg', 17662, 'Sample Caption', 'Sample Alternate Text'),
	(65, 'Sample Post 5', 'Mauris tincidunt magna eu lacus sollicitudin, eget tincidunt elit molestie. Mauris consectetur, sem blandit semper vulputate, diam nisi congue nisi, ac pharetra ex nibh sagittis ante. Etiam pretium ut lacus quis ornare.', 'images-35.jpg', 'image/jpeg', 23672, 'Sample Caption', 'Sample Alternate Text'),
	(66, 'Sample Post 6', 'Mauris tincidunt magna eu lacus sollicitudin, eget tincidunt elit molestie. Mauris consectetur, sem blandit semper vulputate, diam nisi congue nisi, ac pharetra ex nibh sagittis ante. Etiam pretium ut lacus quis ornare.', 'images-42 copy.jpg', 'image/jpeg', 22401, 'Sample Caption', 'Sample Alternate Text'),
	(67, 'Sample Post 7', 'Mauris tincidunt magna eu lacus sollicitudin, eget tincidunt elit molestie. Mauris consectetur, sem blandit semper vulputate, diam nisi congue nisi, ac pharetra ex nibh sagittis ante. Etiam pretium ut lacus quis ornare.', 'images-43.jpg', 'image/jpeg', 27955, 'Sample Caption', 'Sample Alternate Text'),
	(68, 'Sample Post 8', 'Mauris tincidunt magna eu lacus sollicitudin, eget tincidunt elit molestie. Mauris consectetur, sem blandit semper vulputate, diam nisi congue nisi, ac pharetra ex nibh sagittis ante. Etiam pretium ut lacus quis ornare.', 'images-18 copy.jpg', 'image/jpeg', 27595, 'Sample Caption', 'Sample Alternate Text'),
	(69, 'Sample Post 9', 'Mauris tincidunt magna eu lacus sollicitudin, eget tincidunt elit molestie. Mauris consectetur, sem blandit semper vulputate, diam nisi congue nisi, ac pharetra ex nibh sagittis ante. Etiam pretium ut lacus quis ornare.', 'images-16.jpg', 'image/jpeg', 21133, 'Sample Caption', 'Sample Alternate Text');
/*!40000 ALTER TABLE `tbl_photos` ENABLE KEYS */;

-- Dumping structure for table gallery.tbl_users
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_username` varchar(50) NOT NULL,
  `u_password` varchar(100) NOT NULL,
  `f_name` varchar(50) NOT NULL,
  `l_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table gallery.tbl_users: ~2 rows (approximately)
/*!40000 ALTER TABLE `tbl_users` DISABLE KEYS */;
INSERT INTO `tbl_users` (`id`, `u_username`, `u_password`, `f_name`, `l_name`) VALUES
	(49, 'admin', 'admin', 'admin', 'admin');
/*!40000 ALTER TABLE `tbl_users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
