## Library Used & Version
PHP 7.1.33

Laravel Version 5.8
Logger View  - arcanedev/log-viewer
JWT Token - firebase/php-jwt

## Constants Used
Jwt Session Experiy Time 365 Days
Jwt Token key "test"

## Database
Used Laravel Migrations

## SQL

DROP TABLE IF EXISTS `documents`;
CREATE TABLE `documents` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `document` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `documents` (`id`, `user_id`, `document`, `created_at`, `updated_at`) VALUES
(1,	11,	'uploads/1650399299_5fc2abd4b60af_Rohit Quick Service–Release Note.pdf',	'2020-11-28 14:28:12',	'2020-11-28 14:28:12'),
(2,	11,	'uploads/1832584906_5fc2abe3ecd36_Rohit Quick Service–Release Note.pdf',	'2020-11-28 14:28:27',	'2020-11-28 14:28:27');

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1,	'2014_10_12_000000_create_users_table',	1),
(2,	'2014_10_12_100000_create_password_resets_table',	1),
(4,	'2020_11_28_183106_login_flag_user_table',	2),
(6,	'2020_11_28_194946_documents',	3);

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_logged_in` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `is_logged_in`) VALUES
(11,	'admin',	'admin@gmail.com',	'2020-11-28 18:13:16',	'$2y$10$BaVAtDdh.nvKe1XMuy.joO4Lqm/tHETncmSZ9aMBCCfm3SAvHR59W',	NULL,	'2020-11-28 18:13:16',	'2020-11-28 14:00:53',	1);

Note:- Please run database migration or else use above sql query


## ENV FILE CONFIGURATION CHANGE

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=<DATABASE_NAME>
DB_USERNAME=<DATABASE_USERNAME>
DB_PASSWORD=<DATABASE_PASSWORD>



