-- Adminer 4.8.0 MySQL 8.0.25 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL,
  `update_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `category` (`id`, `name`, `created_at`, `update_at`) VALUES
(21,	'Makanan',	'2021-06-04 09:08:33',	'2021-06-04 09:08:33'),
(22,	'Snack',	'2021-06-04 09:08:42',	'2021-06-04 09:08:42');

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `lang` varchar(150) NOT NULL,
  `auth_id` int NOT NULL,
  `status` tinyint NOT NULL,
  `type` int NOT NULL,
  `count` int NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `category_id` int NOT NULL,
  `price` int NOT NULL,
  `preview` varchar(150) NOT NULL,
  `stock` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `product` (`id`, `title`, `slug`, `lang`, `auth_id`, `status`, `type`, `count`, `created_at`, `updated_at`, `category_id`, `price`, `preview`, `stock`) VALUES
(1,	'Pop Mie',	'pop-mie',	'en',	18,	1,	6,	0,	'2021-06-04 09:01:36',	'2021-06-04 09:01:36',	21,	6000,	'https://portal.panelo.co/paneloresto/uploads/20/12/07122016073250025fcdd54a7e85b.jpg',	1),
(2,	'Nasi Goreng Pedas',	'nasi-goreng',	'en',	18,	1,	6,	0,	'2021-06-04 09:02:47',	'2021-06-04 09:02:47',	21,	1500,	'https://portal.panelo.co/paneloresto/uploads/20/10/21102016032509585f8fab0e771b0.jpg',	1),
(3,	'nasi goreng',	'nasi-goreng',	'en',	18,	1,	6,	0,	'2021-06-04 09:04:06',	'2021-06-04 09:04:06',	21,	12000,	'https://portal.panelo.co/paneloresto/uploads/20/10/21102016032509585f8fab0e771b0.jpg',	10),
(4,	'Tahu',	'tahu',	'en',	18,	1,	6,	0,	'2021-06-04 09:05:24',	'2021-06-04 09:05:24',	22,	2000,	'https://portal.panelo.co/paneloresto/uploads/20/12/07122016073247255fcdd4354c14a.jpg',	20),
(5,	'Beng Beng',	'beng-beng',	'en',	18,	1,	6,	0,	'2021-06-04 09:06:21',	'2021-06-04 09:06:21',	22,	2000,	'https://portal.panelo.co/paneloresto/uploads/20/12/07122016073215155fcdc7ab18dd9.jpg',	10);

-- 2021-06-04 10:40:17
