-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table healthmonitor.blood_pressure_categories
CREATE TABLE IF NOT EXISTS `blood_pressure_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `systolic_min` int NOT NULL,
  `systolic_max` int NOT NULL,
  `diastolic_min` int NOT NULL,
  `diastolic_max` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table healthmonitor.blood_pressure_categories: ~6 rows (approximately)
DELETE FROM `blood_pressure_categories`;
INSERT INTO `blood_pressure_categories` (`id`, `category`, `systolic_min`, `systolic_max`, `diastolic_min`, `diastolic_max`, `created_at`, `updated_at`) VALUES
	(1, 'Hipotensi', 0, 89, 0, 59, '2025-09-29 02:43:52', NULL),
	(2, 'Normal', 90, 119, 60, 79, '2025-09-29 02:43:56', NULL),
	(3, 'Pra-Hipertensi', 120, 139, 80, 89, '2025-09-29 02:43:58', NULL),
	(4, 'Hipertensi Tahap 1', 140, 159, 90, 99, '2025-09-29 02:44:17', NULL),
	(5, 'Hipertensi Tahap 2', 160, 179, 100, 119, '2025-09-29 02:44:49', NULL),
	(6, 'Kritis', 180, 999, 120, 999, '2025-09-29 02:45:12', NULL);

-- Dumping structure for table healthmonitor.blood_pressure_records
CREATE TABLE IF NOT EXISTS `blood_pressure_records` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `patient_id` bigint unsigned DEFAULT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `systolic` int NOT NULL,
  `diastolic` int NOT NULL,
  `weight` decimal(5,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `blood_pressure_records_user_id_foreign` (`user_id`),
  KEY `blood_pressure_records_patient_id_foreign` (`patient_id`),
  CONSTRAINT `blood_pressure_records_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `blood_pressure_records_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table healthmonitor.blood_pressure_records: ~1 rows (approximately)
DELETE FROM `blood_pressure_records`;
INSERT INTO `blood_pressure_records` (`id`, `user_id`, `patient_id`, `date`, `time`, `systolic`, `diastolic`, `weight`, `created_at`, `updated_at`) VALUES
	(3, 4, NULL, '2025-09-29', '05:51:00', 141, 94, 72.00, '2025-09-28 22:51:45', '2025-09-28 22:51:45');

-- Dumping structure for table healthmonitor.bmi_categories
CREATE TABLE IF NOT EXISTS `bmi_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `min_value` decimal(5,2) NOT NULL,
  `max_value` decimal(5,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table healthmonitor.bmi_categories: ~4 rows (approximately)
DELETE FROM `bmi_categories`;
INSERT INTO `bmi_categories` (`id`, `category`, `min_value`, `max_value`, `created_at`, `updated_at`) VALUES
	(19, 'Kurus', 0.00, 18.40, '2025-09-29 02:46:30', NULL),
	(20, 'Normal', 18.50, 22.90, '2025-09-29 02:46:51', NULL),
	(21, 'Gemuk', 23.00, 24.90, '2025-09-29 02:50:14', NULL),
	(22, 'Obesitas 1', 25.00, 29.90, '2025-09-29 02:50:33', NULL),
	(23, 'Obesitas 2', 30.00, 99.00, '2025-09-29 02:50:46', NULL);

-- Dumping structure for table healthmonitor.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table healthmonitor.failed_jobs: ~0 rows (approximately)
DELETE FROM `failed_jobs`;

-- Dumping structure for table healthmonitor.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table healthmonitor.migrations: ~0 rows (approximately)
DELETE FROM `migrations`;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2025_09_20_025911_add_profile_fields_to_users_table', 1),
	(6, '2025_09_20_025921_create_blood_pressure_records_table', 1),
	(7, '2025_09_20_025930_create_blood_pressure_categories_table', 1),
	(8, '2025_09_20_025939_create_bmi_categories_table', 1),
	(9, '2025_09_20_025945_create_patient_nakes_assignments_table', 1),
	(10, '2025_09_20_034321_add_avatar_to_users_table', 1),
	(11, '2025_09_20_040800_modify_password_column_in_users_table', 1);

-- Dumping structure for table healthmonitor.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table healthmonitor.password_reset_tokens: ~0 rows (approximately)
DELETE FROM `password_reset_tokens`;

-- Dumping structure for table healthmonitor.patient_nakes_assignments
CREATE TABLE IF NOT EXISTS `patient_nakes_assignments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` bigint unsigned NOT NULL,
  `nakes_id` bigint unsigned NOT NULL,
  `assigned_at` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `patient_nakes_assignments_patient_id_foreign` (`patient_id`),
  KEY `patient_nakes_assignments_nakes_id_foreign` (`nakes_id`),
  CONSTRAINT `patient_nakes_assignments_nakes_id_foreign` FOREIGN KEY (`nakes_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `patient_nakes_assignments_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table healthmonitor.patient_nakes_assignments: ~0 rows (approximately)
DELETE FROM `patient_nakes_assignments`;

-- Dumping structure for table healthmonitor.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table healthmonitor.personal_access_tokens: ~0 rows (approximately)
DELETE FROM `personal_access_tokens`;

-- Dumping structure for table healthmonitor.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('pasien','nakes','admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pasien',
  `gender` enum('laki-laki','perempuan') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `height` int DEFAULT NULL COMMENT 'Height in cm',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table healthmonitor.users: ~0 rows (approximately)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `name`, `email`, `avatar`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `gender`, `birth_date`, `height`) VALUES
	(4, 'Johan Ericka Wahyu Prakasa, M.Kom', 'johan@uin-malang.ac.id', 'https://lh3.googleusercontent.com/a/ACg8ocI7rADksojc6HrFT5eQKhURcFujHBdxySW9u_d0Pj4PS_clv5D5=s96-c', '2025-09-28 22:49:36', '$2y$12$zqH9343w5IvKCjVLtBOmv.Z71TIvt/ZNp.2anPUoAbfDYCXnQJ5IG', NULL, '2025-09-28 22:49:37', '2025-09-28 22:50:02', 'pasien', 'laki-laki', '1983-12-13', 175);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
