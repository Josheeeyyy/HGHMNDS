/*
SQLyog Community v12.4.0 (64 bit)
MySQL - 10.4.32-MariaDB : Database - hghmnds_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`hghmnds_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `hghmnds_db`;

/*Table structure for table `feedback` */

DROP TABLE IF EXISTS `feedback`;

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `rating` varchar(255) DEFAULT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `feedback` */

insert  into `feedback`(`id`,`name`,`email`,`user_id`,`message`,`rating`,`submitted_at`) values 
(1,'Junel','junel@gmail.com',NULL,'','4','2025-05-23 00:06:46'),
(2,'Darnel','',NULL,'nigga','5','2025-05-23 00:09:23');

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `category` enum('Shirt','Bottoms','Accessories') NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `main_image` varchar(255) DEFAULT NULL,
  `hover_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `products` */

insert  into `products`(`id`,`name`,`category`,`description`,`price`,`main_image`,`hover_image`,`created_at`) values 
(1,'GAME ON SHIRT','Shirt','Shirt\r\n',1500.00,'images/shirt1.jpg','images/shirt1hover.jpg','2025-05-22 23:01:06'),
(2,'CAPTIVE SKULL SHIRT','Shirt','Shirt\r\n',2000.00,'images/shirt2.jpg','images/shirt2hover.jpg','2025-05-22 23:23:07'),
(3,'AUTHENTIC TEE','Shirt','Shirt\r\n',1500.00,'images/shirt3.jpg','images/shirt3hover.jpg','2025-05-22 23:23:31'),
(4,'HORNED GUARD TEE','Shirt','Shirt\r\n',2000.00,'images/shirt4.jpg','images/shirt4hover.jpg','2025-05-22 23:23:38'),
(5,'THORN ABSTRACT PANTS','Bottoms','Pants',1500.00,'images/bottoms1.jpg','images/bottoms1hover.jpg','2025-05-22 23:39:39'),
(6,'ELECTRIC SHOCK PANTS','Bottoms','Pants',2000.00,'images/bottoms2.jpg','images/bottoms2hover.jpg','2025-05-22 23:39:44'),
(7,'HM X UND - EMERGER PANTS','Bottoms','Pants',1500.00,'images/bottoms3.jpg','images/bottoms3hover.jpg','2025-05-22 23:39:52'),
(8,'HM X UND - MINTED PANTS','Bottoms','Pants',2000.00,'images/bottoms4.jpg','images/bottoms4hover.jpg','2025-05-22 23:40:09'),
(9,'SEA ELEMENTS BEACH TOWEL','Accessories','Accessories',1500.00,'images/acc1.jpg','images/acc1hover.jpg','2025-05-22 23:43:23'),
(10,'UNBRIGHT UTILITY BAG','Accessories','Accessories',2000.00,'images/acc2.jpg','images/acc2hover.jpg','2025-05-22 23:46:30'),
(11,'SUNLESS BELTBAG','Accessories','Accessories',1500.00,'images/acc3.jpg','images/acc3hover.jpg','2025-05-22 23:46:34'),
(12,'DOWNBEAT POUCH','Accessories','Accessories',2000.00,'images/acc4.jpg','images/acc4hover.jpg','2025-05-22 23:46:42');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`password`,`created_at`) values 
(1,NULL,'dump@gmail.com','$2y$10$thdSxi/eMn90Wu.pY5E7zecuek1IaZi3ht79V7GQ0qoJdEAw0kk6W','2025-05-22 23:03:38');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
