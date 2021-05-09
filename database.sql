/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


CREATE DATABASE IF NOT EXISTS `pizzeria` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `pizzeria`;

CREATE TABLE IF NOT EXISTS `admin` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', 'admin@mail.com', '$2y$12$OU/nmAZeqzskOwXDfqBl8ePX632NMJXyh7QwR58xpGYaSGtZebgFa', NULL, '2021-03-22 15:44:59', NULL);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;


CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `name`) VALUES
	(1, 'Pizzes'),
	(2, 'Piadina'),
	(3, 'Rotolino'),
	(4, 'Focaccia'),
	(5, 'Amanides'),
	(6, 'Pasta');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;


CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `amount` decimal(7,2) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL COMMENT 'A',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` (`id`, `user_id`, `created_at`, `amount`, `status`) VALUES
	(1, 1, '2021-03-21 20:05:17', 37.50, 'Pending'),
	(2, 1, '2021-03-21 20:07:53', 37.50, 'Pending'),
	(3, 1, '2021-03-21 20:10:51', 37.50, 'Approved'),
	(4, 2, '2021-03-21 20:15:38', 19.00, 'Pending'),
	(5, 2, '2021-03-21 20:16:11', 34.75, 'Pending'),
	(6, 3, '2021-03-22 12:52:44', 27.00, 'Approved');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;


CREATE TABLE IF NOT EXISTS `order_lines` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned DEFAULT NULL,
  `product_id` int(10) unsigned DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(7,2) DEFAULT NULL,
  `amount` decimal(7,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `order_lines_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `order_lines_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*!40000 ALTER TABLE `order_lines` DISABLE KEYS */;
INSERT INTO `order_lines` (`id`, `order_id`, `product_id`, `quantity`, `price`, `amount`) VALUES
	(1, 1, 11, 1, 5.50, 5.50),
	(2, 1, 13, 3, 8.00, 24.00),
	(3, 1, 14, 1, 8.00, 8.00),
	(4, 2, 11, 1, 5.50, 5.50),
	(5, 2, 13, 3, 8.00, 24.00),
	(6, 2, 14, 1, 8.00, 8.00),
	(7, 3, 11, 1, 5.50, 5.50),
	(8, 3, 13, 3, 8.00, 24.00),
	(9, 3, 14, 1, 8.00, 8.00),
	(10, 4, 11, 1, 5.50, 5.50),
	(11, 4, 13, 1, 8.00, 8.00),
	(12, 4, 12, 1, 5.50, 5.50),
	(13, 5, 13, 3, 8.00, 24.00),
	(14, 5, 14, 1, 8.00, 8.00),
	(15, 5, 8, 1, 2.75, 2.75),
	(16, 6, 12, 2, 5.50, 11.00),
	(17, 6, 13, 2, 8.00, 16.00);
/*!40000 ALTER TABLE `order_lines` ENABLE KEYS */;


CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  `price` decimal(7,2) DEFAULT NULL,
  `category_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id`, `name`, `description`, `image`, `price`, `category_id`) VALUES
	(1, 'Marguerita', 'Salsa de tomàquet i mozzarella\r\nSalsa de tomate y mozzarela', NULL, 2.50, 1),
	(2, 'Pernil dolç', 'Jamón dulce', NULL, 2.75, 1),
	(3, 'Bacó', 'Beicon', NULL, 2.75, 1),
	(4, 'Llonganissa, mozzarella, ceba caramelitzada i salsa brava', 'Longaniza, mozzarella, cebolla caramelizada y salsa brava', NULL, 4.50, 2),
	(5, 'Parquetta, ceba caramelitzada i mozzarella', 'Parquetta, cebolla caramelizada y mozzarella', NULL, 4.50, 2),
	(6, '2 formatges: Mozzarella i formatge de cabra', '2 quesos: Mozzarella y queso de cabra', NULL, 4.50, 2),
	(7, 'Pernil dolç i formatge', 'Jamón dulce y queso', NULL, 2.75, 3),
	(8, 'Pernil salat, enciam i mozzarella', 'Jamón serrano, lechuga y mozzarella', NULL, 2.75, 2),
	(9, 'Simple', 'Simple', NULL, 2.50, 3),
	(10, 'Farcida (Embutits variats)', 'Rellena (embutidos variados)', NULL, 2.75, 3),
	(11, 'Caprese', 'Tomàquet, mozzarella, olives negres, oli de alfàbrega\r\nTomate, mozzarella, aceitunas negras y aceite de albahaca', NULL, 5.50, 5),
	(12, 'Cabra', 'mézclum, nous, formatge de cabra, xerry, vinagreta de fruits vermells\r\nmezclum, nueces, queso de cabra, cherry y vinagreta de frutos rojos', NULL, 5.50, 5),
	(13, 'Tortellini', 'Amb Salsa: Carbonara, 4 Formatges, Pesto', NULL, 8.00, 6),
	(14, 'Maccheroni', 'Amb Salsa: Carbonara, 4 Formatges, Pesto', NULL, 8.00, 6);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;


CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Test Customer', 'test@mail.com', '$2y$12$gcZx3cZmybiE2c/pEZ47jeZl7486oEw68NQM8pczryVvIYBTf/ZO.', NULL, '2021-03-21 19:34:50', '2021-03-21 19:34:50'),
	(2, 'Jackeline', 'jackeline@mail.com', '$2y$12$gcZx3cZmybiE2c/pEZ47jeZl7486oEw68NQM8pczryVvIYBTf/ZO.', NULL, '2021-03-21 20:15:00', '2021-03-22 09:14:03'),
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
