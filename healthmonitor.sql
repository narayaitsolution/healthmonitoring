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

-- Dumping data for table healthmonitor.blood_pressure_categories: ~6 rows (approximately)
DELETE FROM `blood_pressure_categories`;
INSERT INTO `blood_pressure_categories` (`id`, `category`, `systolic_min`, `systolic_max`, `diastolic_min`, `diastolic_max`, `created_at`, `updated_at`) VALUES
	(1, 'Hipotensi', 0, 119, 0, 79, '2025-09-19 20:25:48', '2025-09-19 20:25:48'),
	(2, 'Normal', 120, 129, 80, 84, '2025-09-19 20:25:48', '2025-09-19 20:25:48'),
	(3, 'Pre-hipertensi', 130, 139, 85, 89, '2025-09-19 20:25:48', '2025-09-19 20:25:48'),
	(4, 'Hipertensi Stage 1', 140, 159, 90, 99, '2025-09-19 20:25:48', '2025-09-19 20:25:48'),
	(5, 'Hipertensi Stage 2', 160, 179, 100, 109, '2025-09-19 20:25:48', '2025-09-19 20:25:48'),
	(6, 'Hipertensi Krisis', 180, 999, 110, 999, '2025-09-19 20:25:48', '2025-09-19 20:25:48'),
	(7, 'Hipotensi', 0, 119, 0, 79, '2025-09-28 13:57:55', '2025-09-28 13:57:55'),
	(8, 'Normal', 120, 129, 80, 84, '2025-09-28 13:57:55', '2025-09-28 13:57:55'),
	(9, 'Pre-hipertensi', 130, 139, 85, 89, '2025-09-28 13:57:55', '2025-09-28 13:57:55'),
	(10, 'Hipertensi Stage 1', 140, 159, 90, 99, '2025-09-28 13:57:55', '2025-09-28 13:57:55'),
	(11, 'Hipertensi Stage 2', 160, 179, 100, 109, '2025-09-28 13:57:55', '2025-09-28 13:57:55'),
	(12, 'Hipertensi Krisis', 180, 999, 110, 999, '2025-09-28 13:57:55', '2025-09-28 13:57:55');

-- Dumping data for table healthmonitor.blood_pressure_records: ~1 rows (approximately)
DELETE FROM `blood_pressure_records`;
INSERT INTO `blood_pressure_records` (`id`, `user_id`, `patient_id`, `date`, `time`, `systolic`, `diastolic`, `weight`, `created_at`, `updated_at`) VALUES
	(1, 2, NULL, '2025-09-28', '17:09:00', 137, 88, 72.00, '2025-09-28 10:11:24', '2025-09-28 10:11:24');

-- Dumping data for table healthmonitor.bmi_categories: ~6 rows (approximately)
DELETE FROM `bmi_categories`;
INSERT INTO `bmi_categories` (`id`, `category`, `min_value`, `max_value`, `created_at`, `updated_at`) VALUES
	(1, 'Underweight', 0.00, 18.49, '2025-09-19 20:26:19', '2025-09-19 20:26:19'),
	(2, 'Normal', 18.50, 24.99, '2025-09-19 20:26:19', '2025-09-19 20:26:19'),
	(3, 'Overweight', 25.00, 29.99, '2025-09-19 20:26:19', '2025-09-19 20:26:19'),
	(4, 'Obesitas I', 30.00, 34.99, '2025-09-19 20:26:19', '2025-09-19 20:26:19'),
	(5, 'Obesitas II', 35.00, 39.99, '2025-09-19 20:26:19', '2025-09-19 20:26:19'),
	(6, 'Obesitas III', 40.00, 999.99, '2025-09-19 20:26:19', '2025-09-19 20:26:19'),
	(7, 'Underweight', 0.00, 18.49, '2025-09-28 13:57:58', '2025-09-28 13:57:58'),
	(8, 'Normal', 18.50, 24.99, '2025-09-28 13:57:58', '2025-09-28 13:57:58'),
	(9, 'Overweight', 25.00, 29.99, '2025-09-28 13:57:58', '2025-09-28 13:57:58'),
	(10, 'Obesitas I', 30.00, 34.99, '2025-09-28 13:57:58', '2025-09-28 13:57:58'),
	(11, 'Obesitas II', 35.00, 39.99, '2025-09-28 13:57:58', '2025-09-28 13:57:58'),
	(12, 'Obesitas III', 40.00, 999.99, '2025-09-28 13:57:58', '2025-09-28 13:57:58');

-- Dumping data for table healthmonitor.failed_jobs: ~0 rows (approximately)
DELETE FROM `failed_jobs`;

-- Dumping data for table healthmonitor.migrations: ~10 rows (approximately)
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
	(10, '2025_09_20_034321_add_avatar_to_users_table', 2),
	(11, '2025_09_20_040800_modify_password_column_in_users_table', 3);

-- Dumping data for table healthmonitor.password_reset_tokens: ~0 rows (approximately)
DELETE FROM `password_reset_tokens`;

-- Dumping data for table healthmonitor.patient_nakes_assignments: ~0 rows (approximately)
DELETE FROM `patient_nakes_assignments`;

-- Dumping data for table healthmonitor.personal_access_tokens: ~0 rows (approximately)
DELETE FROM `personal_access_tokens`;

-- Dumping data for table healthmonitor.users: ~0 rows (approximately)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `name`, `email`, `avatar`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `gender`, `birth_date`, `height`) VALUES
	(1, 'Naraya IT Solution', 'narayaitsolution@gmail.com', 'https://lh3.googleusercontent.com/a/ACg8ocKn9X5i8Krn7gNCAsenjd28rM1LDQ1zJqEoMu2t0rCvRh22rC0=s96-c', '2025-09-19 21:09:00', '$2y$12$CZDLnWtGyk7G6C1VEMq2yO/bJUqYZBgyU2PB1IsClKY.g2uTXrXOO', NULL, '2025-09-19 21:09:01', '2025-09-19 21:09:15', 'pasien', 'laki-laki', '1980-01-01', 172),
	(2, 'Johan Ericka Wahyu Prakasa, M.Kom', 'johan@uin-malang.ac.id', 'https://lh3.googleusercontent.com/a/ACg8ocI7rADksojc6HrFT5eQKhURcFujHBdxySW9u_d0Pj4PS_clv5D5=s96-c', '2025-09-28 02:57:52', '$2y$12$201XF2XVo32kfEadEzxYFudibu5h/gTEcwXXZWyj.b8O9ZYOv8k5S', NULL, '2025-09-28 02:57:52', '2025-09-28 02:58:07', 'pasien', 'laki-laki', '1983-12-13', 175);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
