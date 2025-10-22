/*
 Navicat Premium Data Transfer

 Source Server         : Doctor
 Source Server Type    : MySQL
 Source Server Version : 90100
 Source Host           : localhost:3306
 Source Schema         : wp-kai1

 Target Server Type    : MySQL
 Target Server Version : 90100
 File Encoding         : 65001

 Date: 21/10/2025 14:22:53
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for attendance_records
-- ----------------------------
DROP TABLE IF EXISTS `attendance_records`;
CREATE TABLE `attendance_records`  (
  `attendance_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint UNSIGNED NOT NULL,
  `attendance_date` date NOT NULL,
  `check_in_time` time NULL DEFAULT NULL,
  `check_out_time` time NULL DEFAULT NULL,
  `status` enum('Present','Absent','Late','Leave') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `working_hours` decimal(5, 2) NOT NULL DEFAULT 0.00,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`attendance_id`) USING BTREE,
  INDEX `attendance_records_employee_id_foreign`(`employee_id` ASC) USING BTREE,
  CONSTRAINT `attendance_records_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of attendance_records
-- ----------------------------

-- ----------------------------
-- Table structure for cache
-- ----------------------------
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache`  (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cache
-- ----------------------------

-- ----------------------------
-- Table structure for cache_locks
-- ----------------------------
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks`  (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cache_locks
-- ----------------------------

-- ----------------------------
-- Table structure for departments
-- ----------------------------
DROP TABLE IF EXISTS `departments`;
CREATE TABLE `departments`  (
  `department_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `department_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `status` enum('active','inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`department_id`) USING BTREE,
  UNIQUE INDEX `departments_department_code_unique`(`department_code` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of departments
-- ----------------------------
INSERT INTO `departments` VALUES (1, 'Human Resources', 'HR', 'Manages employee relations, recruitment, and HR policies', 'active', '2025-10-20 09:46:46', '2025-10-20 09:46:46');
INSERT INTO `departments` VALUES (2, 'Information Technology', 'IT', 'Manages technology infrastructure and software development', 'active', '2025-10-20 09:46:46', '2025-10-20 09:46:46');
INSERT INTO `departments` VALUES (3, 'Finance', 'FIN', 'Handles financial planning, accounting, and budgeting', 'active', '2025-10-20 09:46:46', '2025-10-20 09:46:46');
INSERT INTO `departments` VALUES (4, 'Marketing', 'MKT', 'Manages marketing campaigns and brand development', 'active', '2025-10-20 09:46:46', '2025-10-20 09:46:46');
INSERT INTO `departments` VALUES (5, 'Sales', 'SAL', 'Drives revenue through customer acquisition and retention', 'active', '2025-10-20 09:46:46', '2025-10-20 09:46:46');
INSERT INTO `departments` VALUES (6, 'Operations', 'OPS', 'Manages day-to-day business operations', 'active', '2025-10-20 09:46:46', '2025-10-20 09:46:46');
INSERT INTO `departments` VALUES (7, 'Customer Service', 'CS', 'Provides customer support and handles inquiries', 'active', '2025-10-20 09:46:46', '2025-10-20 09:46:46');

-- ----------------------------
-- Table structure for employee_awards
-- ----------------------------
DROP TABLE IF EXISTS `employee_awards`;
CREATE TABLE `employee_awards`  (
  `award_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint UNSIGNED NOT NULL,
  `award_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `award_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `award_date` date NOT NULL,
  `reason` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `value` decimal(10, 2) NOT NULL DEFAULT 0.00,
  `given_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`award_id`) USING BTREE,
  INDEX `employee_awards_employee_id_foreign`(`employee_id` ASC) USING BTREE,
  CONSTRAINT `employee_awards_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of employee_awards
-- ----------------------------

-- ----------------------------
-- Table structure for employees
-- ----------------------------
DROP TABLE IF EXISTS `employees`;
CREATE TABLE `employees`  (
  `employee_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('Male','Female') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `national_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `hire_date` date NOT NULL,
  `department_id` bigint UNSIGNED NOT NULL,
  `position_id` bigint UNSIGNED NOT NULL,
  `employee_type` enum('Full-time','Part-time','Contract') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','resigned') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`employee_id`) USING BTREE,
  UNIQUE INDEX `employees_employee_code_unique`(`employee_code` ASC) USING BTREE,
  INDEX `employees_department_id_foreign`(`department_id` ASC) USING BTREE,
  INDEX `employees_position_id_foreign`(`position_id` ASC) USING BTREE,
  CONSTRAINT `employees_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `employees_position_id_foreign` FOREIGN KEY (`position_id`) REFERENCES `positions` (`position_id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 32 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of employees
-- ----------------------------
INSERT INTO `employees` VALUES (26, 'EMP-20251020-HWBTE3', 'Dawn Cooke', 'Female', '2005-06-17', 'Dolores et non liber', 'bageceby@mailinator.com', '+1 (935) 421-6546', 'Et aperiam illo cons', '1982-06-19', 1, 1, 'Full-time', 'active', 'profile_photos/1760928587.jpg', '2025-10-20 02:49:47', '2025-10-20 02:57:05');
INSERT INTO `employees` VALUES (27, 'EMP-20251020-6O9W3Z', 'Hermione George', 'Male', '2017-11-02', 'Qui omnis autem magn', 'liqediresi@mailinator.com', '+1 (272) 159-9568', 'Numquam mollit expli', '2017-12-29', 2, 4, 'Part-time', 'active', 'profile_photos/1760928587.jpg', '2025-10-20 02:51:00', '2025-10-20 02:51:00');
INSERT INTO `employees` VALUES (28, 'EMP-20251020-YP79D4', 'Hayfa Schultz', 'Male', '1970-01-02', 'Sit soluta doloremqu', 'cuhov@mailinator.com', '+1 (298) 832-8632', 'Repudiandae dolores', '2016-07-09', 2, 7, 'Full-time', 'active', 'profile_photos/1760928587.jpg', '2025-10-20 02:51:10', '2025-10-20 02:51:10');
INSERT INTO `employees` VALUES (29, 'EMP-20251020-H8XQDY', 'Hanna Frost', 'Female', '1987-02-22', 'Veniam consectetur', 'nyrix@mailinator.com', '+1 (174) 265-8044', 'Molestiae optio qui', '2017-10-05', 2, 5, 'Full-time', 'active', 'profile_photos/1760928587.jpg', '2025-10-20 02:51:52', '2025-10-20 02:51:52');
INSERT INTO `employees` VALUES (30, 'EMP-20251020-143C2R', 'Robin Tillman', 'Male', '2016-11-18', 'Recusandae Est ut', 'ramewe@mailinator.com', '+1 (752) 968-6087', 'Mollitia libero debi', '2019-10-15', 7, 20, 'Full-time', 'active', 'profile_photos/1760928587.jpg', '2025-10-20 02:52:05', '2025-10-20 02:52:05');
INSERT INTO `employees` VALUES (31, 'EMP-20251020-O2Q8TW', 'Kelly Marks', 'Female', '1994-06-03', 'Accusantium ipsum m', 'qyxas@mailinator.com', '+1 (949) 926-5891', 'Dolores dolore nostr', '2015-07-21', 1, 3, 'Full-time', 'active', 'profile_photos/1760928587.jpg', '2025-10-20 02:52:21', '2025-10-20 02:52:21');

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for job_batches
-- ----------------------------
DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches`  (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `cancelled_at` int NULL DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of job_batches
-- ----------------------------

-- ----------------------------
-- Table structure for jobs
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED NULL DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `jobs_queue_index`(`queue` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jobs
-- ----------------------------

-- ----------------------------
-- Table structure for languages
-- ----------------------------
DROP TABLE IF EXISTS `languages`;
CREATE TABLE `languages`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `languages_name_unique`(`name` ASC) USING BTREE,
  UNIQUE INDEX `languages_code_unique`(`code` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of languages
-- ----------------------------
INSERT INTO `languages` VALUES (1, 'English', 'en', '2025-10-18 09:46:30', '2025-10-18 09:46:30');
INSERT INTO `languages` VALUES (2, 'Khmer', 'km', '2025-10-18 09:46:30', '2025-10-18 09:46:30');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '0001_01_01_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '0001_01_01_000001_create_cache_table', 1);
INSERT INTO `migrations` VALUES (3, '0001_01_01_000002_create_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2025_07_19_093417_create_departments_table', 1);
INSERT INTO `migrations` VALUES (5, '2025_07_19_093446_create_positions_table', 1);
INSERT INTO `migrations` VALUES (6, '2025_07_19_094415_create_employees_table', 1);
INSERT INTO `migrations` VALUES (7, '2025_07_26_010206_create_attendance_records_table', 1);
INSERT INTO `migrations` VALUES (8, '2025_07_26_010439_create_payrolls_table', 1);
INSERT INTO `migrations` VALUES (9, '2025_07_26_010801_create_employee_awards_table', 1);
INSERT INTO `migrations` VALUES (10, '2025_07_26_011042_create_reward_points_table', 1);
INSERT INTO `migrations` VALUES (11, '2025_07_26_011253_create_missions_table', 1);
INSERT INTO `migrations` VALUES (12, '2025_10_18_092536_add_employee_code_to_employees_table', 1);
INSERT INTO `migrations` VALUES (13, '2025_10_18_093850_add_language_and_role_to_users_table', 1);
INSERT INTO `migrations` VALUES (14, '2025_10_18_094349_create_roles_table', 1);
INSERT INTO `migrations` VALUES (15, '2025_10_18_094353_create_languages_table', 1);
INSERT INTO `migrations` VALUES (16, '2025_10_18_094428_add_role_id_and_language_id_to_users_table', 1);

-- ----------------------------
-- Table structure for missions
-- ----------------------------
DROP TABLE IF EXISTS `missions`;
CREATE TABLE `missions`  (
  `mission_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint UNSIGNED NOT NULL,
  `mission_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `destination` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('Planned','In Progress','Completed') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mission_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `approved_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`mission_id`) USING BTREE,
  INDEX `missions_employee_id_foreign`(`employee_id` ASC) USING BTREE,
  CONSTRAINT `missions_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of missions
-- ----------------------------

-- ----------------------------
-- Table structure for password_reset_tokens
-- ----------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_reset_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for payrolls
-- ----------------------------
DROP TABLE IF EXISTS `payrolls`;
CREATE TABLE `payrolls`  (
  `payroll_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint UNSIGNED NOT NULL,
  `payroll_month` date NOT NULL,
  `basic_salary` decimal(10, 2) NOT NULL DEFAULT 0.00,
  `bonus` decimal(10, 2) NOT NULL DEFAULT 0.00,
  `deductions` decimal(10, 2) NOT NULL DEFAULT 0.00,
  `net_salary` decimal(10, 2) NOT NULL DEFAULT 0.00,
  `status` enum('Pending','Paid','Failed') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_date` date NULL DEFAULT NULL,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`payroll_id`) USING BTREE,
  INDEX `payrolls_employee_id_foreign`(`employee_id` ASC) USING BTREE,
  CONSTRAINT `payrolls_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of payrolls
-- ----------------------------

-- ----------------------------
-- Table structure for positions
-- ----------------------------
DROP TABLE IF EXISTS `positions`;
CREATE TABLE `positions`  (
  `position_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `position_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `department_id` bigint UNSIGNED NOT NULL,
  `is_managerial` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`position_id`) USING BTREE,
  INDEX `positions_department_id_foreign`(`department_id` ASC) USING BTREE,
  CONSTRAINT `positions_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of positions
-- ----------------------------
INSERT INTO `positions` VALUES (1, 'HR Manager', 'Oversees all HR operations and strategies', 'Manager', 1, 1, '2025-10-20 09:46:46', '2025-10-20 09:46:46');
INSERT INTO `positions` VALUES (2, 'HR Specialist', 'Handles recruitment and employee relations', 'Specialist', 1, 0, '2025-10-20 09:46:46', '2025-10-20 09:46:46');
INSERT INTO `positions` VALUES (3, 'Recruiter', 'Sources and interviews potential candidates', 'Junior', 1, 0, '2025-10-20 09:46:46', '2025-10-20 09:46:46');
INSERT INTO `positions` VALUES (4, 'IT Director', 'Leads technology strategy and team', 'Director', 2, 1, '2025-10-20 09:46:46', '2025-10-20 09:46:46');
INSERT INTO `positions` VALUES (5, 'Senior Developer', 'Develops and maintains software applications', 'Senior', 2, 0, '2025-10-20 09:46:46', '2025-10-20 09:46:46');
INSERT INTO `positions` VALUES (6, 'Junior Developer', 'Assists in software development projects', 'Junior', 2, 0, '2025-10-20 09:46:46', '2025-10-20 09:46:46');
INSERT INTO `positions` VALUES (7, 'System Administrator', 'Manages IT infrastructure and networks', 'Specialist', 2, 0, '2025-10-20 09:46:46', '2025-10-20 09:46:46');
INSERT INTO `positions` VALUES (8, 'DevOps Engineer', 'Handles deployment and system automation', 'Senior', 2, 0, '2025-10-20 09:46:46', '2025-10-20 09:46:46');
INSERT INTO `positions` VALUES (9, 'Finance Manager', 'Manages financial operations and reporting', 'Manager', 3, 1, '2025-10-20 09:46:46', '2025-10-20 09:46:46');
INSERT INTO `positions` VALUES (10, 'Accountant', 'Handles bookkeeping and financial records', 'Specialist', 3, 0, '2025-10-20 09:46:46', '2025-10-20 09:46:46');
INSERT INTO `positions` VALUES (11, 'Financial Analyst', 'Analyzes financial data and trends', 'Specialist', 3, 0, '2025-10-20 09:46:46', '2025-10-20 09:46:46');
INSERT INTO `positions` VALUES (12, 'Marketing Manager', 'Leads marketing initiatives and campaigns', 'Manager', 4, 1, '2025-10-20 09:46:46', '2025-10-20 09:46:46');
INSERT INTO `positions` VALUES (13, 'Content Creator', 'Creates marketing content and materials', 'Specialist', 4, 0, '2025-10-20 09:46:46', '2025-10-20 09:46:46');
INSERT INTO `positions` VALUES (14, 'Digital Marketing Specialist', 'Manages digital marketing channels', 'Specialist', 4, 0, '2025-10-20 09:46:46', '2025-10-20 09:46:46');
INSERT INTO `positions` VALUES (15, 'Sales Manager', 'Oversees sales team and targets', 'Manager', 5, 1, '2025-10-20 09:46:46', '2025-10-20 09:46:46');
INSERT INTO `positions` VALUES (16, 'Sales Executive', 'Handles customer sales and relationships', 'Specialist', 5, 0, '2025-10-20 09:46:46', '2025-10-20 09:46:46');
INSERT INTO `positions` VALUES (17, 'Business Development Officer', 'Identifies new business opportunities', 'Senior', 5, 0, '2025-10-20 09:46:46', '2025-10-20 09:46:46');
INSERT INTO `positions` VALUES (18, 'Operations Manager', 'Manages operational processes', 'Manager', 6, 1, '2025-10-20 09:46:46', '2025-10-20 09:46:46');
INSERT INTO `positions` VALUES (19, 'Operations Coordinator', 'Coordinates daily operations', 'Specialist', 6, 0, '2025-10-20 09:46:46', '2025-10-20 09:46:46');
INSERT INTO `positions` VALUES (20, 'Customer Service Manager', 'Leads customer service team', 'Manager', 7, 1, '2025-10-20 09:46:46', '2025-10-20 09:46:46');
INSERT INTO `positions` VALUES (21, 'Customer Support Agent', 'Provides customer support', 'Junior', 7, 0, '2025-10-20 09:46:46', '2025-10-20 09:46:46');

-- ----------------------------
-- Table structure for reward_points
-- ----------------------------
DROP TABLE IF EXISTS `reward_points`;
CREATE TABLE `reward_points`  (
  `reward_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint UNSIGNED NOT NULL,
  `points` int NOT NULL DEFAULT 0,
  `reason` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `awarded_date` date NOT NULL,
  `awarded_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`reward_id`) USING BTREE,
  INDEX `reward_points_employee_id_foreign`(`employee_id` ASC) USING BTREE,
  CONSTRAINT `reward_points_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of reward_points
-- ----------------------------

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `roles_name_unique`(`name` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'admin', '2025-10-18 09:46:30', '2025-10-18 09:46:30');
INSERT INTO `roles` VALUES (2, 'employee', '2025-10-18 09:46:30', '2025-10-18 09:46:30');

-- ----------------------------
-- Table structure for sessions
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions`  (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NULL DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `sessions_user_id_index`(`user_id` ASC) USING BTREE,
  INDEX `sessions_last_activity_index`(`last_activity` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sessions
-- ----------------------------
INSERT INTO `sessions` VALUES ('5oNAPdbvJpWAZ9hZkNFGaUPW99wyiEG3PHBODFJ0', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVHM3bk9UNG55d3N5UmVGOEkxSThzbUZ4RDB1bXhTN1VtNmcydERrZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9lbXBsb3llZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1761030321);
INSERT INTO `sessions` VALUES ('WkS0zFa0gNTRQSOH2jZj4wZHuC1Ul9F49FZ2Iy0Y', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYmVPak81RlE4cURRdXk3M2piSzdyQlR6TTV1M0RKc1VHQm9CMWJjNyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1760931095);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `language_id` bigint UNSIGNED NOT NULL,
  `language` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `role` enum('admin','employee') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'employee',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email` ASC) USING BTREE,
  INDEX `users_role_id_foreign`(`role_id` ASC) USING BTREE,
  INDEX `users_language_id_foreign`(`language_id` ASC) USING BTREE,
  CONSTRAINT `users_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Mann Chealy', 'Mashacampro@gmail.com', NULL, '$2y$12$QgZ7hozpP7H8upktgXIHtO5nFe11vrg3XycRW1dpBRpbERIgCQ676', 2, 1, 'en', 'employee', NULL, '2025-10-18 09:49:54', '2025-10-18 09:49:54');
INSERT INTO `users` VALUES (2, 'Meng', 'chealymann@gmail.com', NULL, '$2y$12$.BgEbTBzxu3qQR.J/xl/Quob8bfSWM4Ktec5jxhOXW.hzTwPNPDim', 1, 1, 'en', 'employee', NULL, '2025-10-18 09:53:23', '2025-10-18 09:53:23');

SET FOREIGN_KEY_CHECKS = 1;
