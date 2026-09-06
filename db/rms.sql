-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 06, 2026 at 03:56 PM
-- Server version: 8.3.0
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rms`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

DROP TABLE IF EXISTS `about_us`;
CREATE TABLE IF NOT EXISTS `about_us` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag1` bigint UNSIGNED DEFAULT NULL,
  `tag2` bigint UNSIGNED DEFAULT NULL,
  `tag3` bigint UNSIGNED DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1=active, 0=inactive',
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `amenities`
--

DROP TABLE IF EXISTS `amenities`;
CREATE TABLE IF NOT EXISTS `amenities` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=active,0=inactive',
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `amenities_name_index` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `checkouts`
--

DROP TABLE IF EXISTS `checkouts`;
CREATE TABLE IF NOT EXISTS `checkouts` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `checkout_date` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `booking_id` bigint UNSIGNED NOT NULL,
  `room_cost` decimal(10,2) NOT NULL,
  `food_cost` decimal(10,2) DEFAULT NULL,
  `laundry_cost` decimal(10,2) DEFAULT NULL,
  `service_cost` decimal(10,2) DEFAULT NULL,
  `other_cost` decimal(10,2) DEFAULT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `discount_type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'percentage,fixed',
  `vat` decimal(10,2) DEFAULT NULL,
  `grand_total` decimal(10,2) NOT NULL,
  `advanced` decimal(10,2) DEFAULT NULL,
  `due` decimal(10,2) DEFAULT NULL,
  `payment_method` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'cash,card,bkash,nagad,bank',
  `transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=active,0=inactive',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=active,0=inactive',
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `checkouts_checkout_date_index` (`checkout_date`),
  KEY `checkouts_booking_id_index` (`booking_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `check_ins`
--

DROP TABLE IF EXISTS `check_ins`;
CREATE TABLE IF NOT EXISTS `check_ins` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `invoice` bigint UNSIGNED DEFAULT NULL,
  `checkout_id` bigint UNSIGNED DEFAULT NULL,
  `package_id` bigint UNSIGNED DEFAULT NULL,
  `start_date` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_date` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `day` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adult` int NOT NULL,
  `kids` int DEFAULT NULL,
  `room_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid_no` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name2` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid_no2` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile2` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email2` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=active,0=inactive',
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `check_ins_invoice_index` (`invoice`),
  KEY `check_ins_checkout_id_index` (`checkout_id`),
  KEY `check_ins_start_date_index` (`start_date`),
  KEY `check_ins_end_date_index` (`end_date`),
  KEY `check_ins_day_index` (`day`),
  KEY `check_ins_adult_index` (`adult`),
  KEY `check_ins_kids_index` (`kids`),
  KEY `check_ins_room_id_index` (`room_id`),
  KEY `check_ins_name_index` (`name`),
  KEY `check_ins_nid_no_index` (`nid_no`),
  KEY `check_ins_address_index` (`address`),
  KEY `check_ins_mobile_index` (`mobile`),
  KEY `check_ins_email_index` (`email`),
  KEY `check_ins_gender_index` (`gender`),
  KEY `check_ins_age_index` (`age`),
  KEY `check_ins_name2_index` (`name2`),
  KEY `check_ins_nid_no2_index` (`nid_no2`),
  KEY `check_ins_address2_index` (`address2`),
  KEY `check_ins_mobile2_index` (`mobile2`),
  KEY `check_ins_email2_index` (`email2`),
  KEY `check_ins_file_index` (`file`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dinings`
--

DROP TABLE IF EXISTS `dinings`;
CREATE TABLE IF NOT EXISTS `dinings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint DEFAULT NULL,
  `food_id` bigint DEFAULT NULL,
  `quantity` bigint DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `subtotal` decimal(10,2) NOT NULL DEFAULT '0.00',
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=active,0=inactive',
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enquiries`
--

DROP TABLE IF EXISTS `enquiries`;
CREATE TABLE IF NOT EXISTS `enquiries` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `type` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'contact' COMMENT 'contact,booking',
  `room_type_id` bigint UNSIGNED DEFAULT NULL,
  `check_in` date DEFAULT NULL,
  `check_out` date DEFAULT NULL,
  `guests` int DEFAULT NULL,
  `status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new' COMMENT 'new,responded,closed',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

DROP TABLE IF EXISTS `expenses`;
CREATE TABLE IF NOT EXISTS `expenses` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `expense_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receiver_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_amount` decimal(10,2) DEFAULT NULL,
  `due_amount` decimal(10,2) DEFAULT NULL,
  `payment_method` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'cash,bkash,nagad,card,bank',
  `note` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=paid,0=unpaid,2=partial',
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

DROP TABLE IF EXISTS `faqs`;
CREATE TABLE IF NOT EXISTS `faqs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` int DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=active,0=inactive',
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `foods`
--

DROP TABLE IF EXISTS `foods`;
CREATE TABLE IF NOT EXISTS `foods` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` bigint UNSIGNED DEFAULT NULL COMMENT 'Lower value means higher priority',
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=active,0=inactive',
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

DROP TABLE IF EXISTS `galleries`;
CREATE TABLE IF NOT EXISTS `galleries` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `caption` text COLLATE utf8mb4_unicode_ci,
  `priority` int DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=active,0=inactive',
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `house_keepings`
--

DROP TABLE IF EXISTS `house_keepings`;
CREATE TABLE IF NOT EXISTS `house_keepings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `amenities_id` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `room_no` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `vendor_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=clean,0=dirty',
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `house_keepings_amenities_id_index` (`amenities_id`),
  KEY `house_keepings_room_no_index` (`room_no`),
  KEY `house_keepings_vendor_id_index` (`vendor_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `journal_posts`
--

DROP TABLE IF EXISTS `journal_posts`;
CREATE TABLE IF NOT EXISTS `journal_posts` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `body` longtext COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `published_at` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=active,0=inactive',
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `journal_posts_slug_unique` (`slug`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laundries`
--

DROP TABLE IF EXISTS `laundries`;
CREATE TABLE IF NOT EXISTS `laundries` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `amenities_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `room_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `vendor_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=received,0=assigned',
  `assign_date` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receive_date` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `laundries_amenities_id_index` (`amenities_id`),
  KEY `laundries_room_no_index` (`room_no`),
  KEY `laundries_vendor_id_index` (`vendor_id`),
  KEY `laundries_quantity_index` (`quantity`),
  KEY `laundries_assign_date_index` (`assign_date`),
  KEY `laundries_receive_date_index` (`receive_date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laundry_receiveds`
--

DROP TABLE IF EXISTS `laundry_receiveds`;
CREATE TABLE IF NOT EXISTS `laundry_receiveds` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `laundry_id` bigint UNSIGNED NOT NULL,
  `vendor_id` bigint UNSIGNED NOT NULL,
  `assign_date` date NOT NULL,
  `amenities_id` int NOT NULL,
  `quantity` int NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `priority` bigint DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=active,0=inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menus_name_index` (`name`),
  KEY `menus_priority_index` (`priority`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_01_19_180003_create_menus_table', 1),
(5, '2025_02_14_164546_create_room_types_table', 1),
(6, '2025_02_14_164555_create_rooms_table', 1),
(7, '2025_02_15_163105_create_amenities_table', 1),
(8, '2025_02_16_171301_create_check_ins_table', 1),
(9, '2025_02_26_171716_create_house_keepings_table', 1),
(10, '2025_02_26_173838_create_laundries_table', 1),
(11, '2025_03_03_164001_create_vendors_table', 1),
(12, '2025_03_21_051825_create_about_us_table', 1),
(13, '2025_04_11_162201_create_packages_table', 1),
(14, '2025_04_12_050227_create_package_categories_table', 1),
(15, '2025_08_30_071730_create_sliders_table', 1),
(16, '2025_09_12_190400_create_checkouts_table', 1),
(17, '2025_09_14_172339_create_laundry_receiveds_table', 1),
(18, '2025_09_15_170710_create_expenses_table', 1),
(19, '2025_09_20_062816_create_foods_table', 1),
(20, '2025_09_20_154531_create_dinings_table', 1),
(21, '2026_09_04_214501_create_faqs_table', 1),
(22, '2026_09_04_214502_create_galleries_table', 1),
(23, '2026_09_04_214503_create_journal_posts_table', 1),
(24, '2026_09_04_214504_create_enquiries_table', 1),
(25, '2026_09_04_220001_create_stays_table', 1),
(26, '2026_09_04_220002_create_rate_tiers_table', 1),
(27, '2026_09_04_220003_create_promos_table', 1),
(28, '2026_09_04_220004_create_reservations_table', 1),
(29, '2026_09_04_220005_create_settings_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

DROP TABLE IF EXISTS `packages`;
CREATE TABLE IF NOT EXISTS `packages` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `no_of_person` bigint UNSIGNED DEFAULT NULL,
  `no_of_day` bigint UNSIGNED DEFAULT NULL,
  `price` double DEFAULT NULL,
  `price_for` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_of_bed_room` bigint UNSIGNED DEFAULT NULL,
  `no_of_bed` bigint UNSIGNED DEFAULT NULL,
  `no_food_serve` bigint UNSIGNED DEFAULT NULL,
  `food_item` mediumtext COLLATE utf8mb4_unicode_ci,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1=active, 0=inactive',
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `package_categories`
--

DROP TABLE IF EXISTS `package_categories`;
CREATE TABLE IF NOT EXISTS `package_categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1=active, 0=inactive',
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('mossie67@example.com', '$2y$04$KxCKb9kaL6O1vrtxxxn5uumihtNmfXW7.U1sowPu6cTyvSr/sZbcG', '2026-09-04 10:24:56'),
('gwilderman@example.org', '$2y$04$SI6J3Pw1JyZ7BlgAjz9R1epucCzcX4ePUIup/fPhzDkGjBiKq2JsS', '2026-09-04 10:24:58');

-- --------------------------------------------------------

--
-- Table structure for table `promos`
--

DROP TABLE IF EXISTS `promos`;
CREATE TABLE IF NOT EXISTS `promos` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('pct','flat') COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` decimal(8,4) NOT NULL,
  `label` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `starts_on` date DEFAULT NULL,
  `ends_on` date DEFAULT NULL,
  `min_nights` tinyint UNSIGNED DEFAULT NULL,
  `stay_slugs` json DEFAULT NULL,
  `max_uses` int UNSIGNED DEFAULT NULL,
  `used_count` int UNSIGNED NOT NULL DEFAULT '0',
  `max_uses_per_email` int UNSIGNED DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `promos_code_unique` (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rate_tiers`
--

DROP TABLE IF EXISTS `rate_tiers`;
CREATE TABLE IF NOT EXISTS `rate_tiers` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `stay_id` bigint UNSIGNED NOT NULL,
  `from_guests` tinyint UNSIGNED NOT NULL,
  `weekday_rate` int UNSIGNED NOT NULL,
  `weekend_rate` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `rate_tiers_stay_id_from_guests_unique` (`stay_id`,`from_guests`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stay_id` bigint UNSIGNED NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `nights` smallint UNSIGNED NOT NULL,
  `guests` tinyint UNSIGNED NOT NULL,
  `guest_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guest_phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guest_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guest_note` text COLLATE utf8mb4_unicode_ci,
  `promo_id` bigint UNSIGNED DEFAULT NULL,
  `promo_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nightly_rate` int UNSIGNED NOT NULL,
  `gross` int UNSIGNED NOT NULL,
  `weekday_discount` int UNSIGNED NOT NULL DEFAULT '0',
  `promo_discount` int UNSIGNED NOT NULL DEFAULT '0',
  `net` int UNSIGNED NOT NULL,
  `vat` int UNSIGNED NOT NULL,
  `total` int UNSIGNED NOT NULL,
  `amount_paid` int UNSIGNED NOT NULL DEFAULT '0',
  `status` enum('pending','confirmed','cancelled','completed','no_show') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_status` enum('unpaid','partial','paid','refunded') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid',
  `source` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'website',
  `confirmed_at` timestamp NULL DEFAULT NULL,
  `cancelled_at` timestamp NULL DEFAULT NULL,
  `cancel_reason` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `reservations_reference_unique` (`reference`),
  KEY `reservations_promo_id_foreign` (`promo_id`),
  KEY `reservations_stay_id_check_in_check_out_index` (`stay_id`,`check_in`,`check_out`),
  KEY `reservations_status_index` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
CREATE TABLE IF NOT EXISTS `rooms` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `room_no` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `floor` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` bigint DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `available_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=booked,0=available',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=active,0=inactive',
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rooms_type_index` (`type`),
  KEY `rooms_name_index` (`name`),
  KEY `rooms_room_no_index` (`room_no`),
  KEY `rooms_floor_index` (`floor`),
  KEY `rooms_priority_index` (`priority`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_types`
--

DROP TABLE IF EXISTS `room_types`;
CREATE TABLE IF NOT EXISTS `room_types` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_code` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adult_capacity` bigint DEFAULT NULL,
  `kids_capacity` bigint DEFAULT NULL,
  `base_price` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` bigint DEFAULT NULL,
  `amenities` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=active,0=inactive',
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `room_types_name_index` (`name`),
  KEY `room_types_type_index` (`type`),
  KEY `room_types_short_code_index` (`short_code`),
  KEY `room_types_adult_capacity_index` (`adult_capacity`),
  KEY `room_types_kids_capacity_index` (`kids_capacity`),
  KEY `room_types_base_price_index` (`base_price`),
  KEY `room_types_priority_index` (`priority`),
  KEY `room_types_amenities_index` (`amenities`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('TfLPJMNYb8Kl4kibKlMxumZdK3T0WzT33HGIpWYt', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVXVOTzhkTUlRMlh2eGM2dkNDNno1ckRTNWRyeFlaRHpJRnp4ZzdMNCI7czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3Jvb21zIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1788539558);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` json NOT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

DROP TABLE IF EXISTS `sliders`;
CREATE TABLE IF NOT EXISTS `sliders` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` mediumtext COLLATE utf8mb4_unicode_ci,
  `hierarchy` bigint UNSIGNED DEFAULT NULL COMMENT 'Lower value means higher priority',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=Active, 0=Inactive',
  `created_by` bigint UNSIGNED DEFAULT NULL COMMENT 'Stores the ID of the user who created the record',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Stores the creation time of the record',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Stores the last update time of the record',
  PRIMARY KEY (`id`),
  KEY `sliders_created_by_foreign` (`created_by`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stays`
--

DROP TABLE IF EXISTS `stays`;
CREATE TABLE IF NOT EXISTS `stays` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meaning` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `min_guests` tinyint UNSIGNED NOT NULL DEFAULT '1',
  `max_guests` tinyint UNSIGNED NOT NULL DEFAULT '3',
  `pricing_mode` enum('per_person_occupancy','per_person_group') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'per_person_occupancy',
  `whole_unit_only` tinyint(1) NOT NULL DEFAULT '0',
  `hero_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` smallint UNSIGNED NOT NULL DEFAULT '0',
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `stays_slug_unique` (`slug`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Douglas Marks I', 'stroman.jaiden@example.org', '2026-09-04 10:24:52', '$2y$04$c9C1oSLFnCnRvXilpmFVF.jsIjIO2osnJcuVidbCVZjntBJCkwTKq', 'oFMXhblw0y', '2026-09-04 10:24:52', '2026-09-04 10:24:52'),
(2, 'Prof. Milton Boyer', 'turcotte.amalia@example.org', '2026-09-04 10:24:52', '$2y$04$c9C1oSLFnCnRvXilpmFVF.jsIjIO2osnJcuVidbCVZjntBJCkwTKq', '0GSWBEcsy4', '2026-09-04 10:24:52', '2026-09-04 10:24:52'),
(3, 'Lance Thompson V', 'runte.olga@example.net', '2026-09-04 10:24:53', '$2y$04$c9C1oSLFnCnRvXilpmFVF.jsIjIO2osnJcuVidbCVZjntBJCkwTKq', 'bzJE1LeVVH9ljrNxZBdunQVIsJ1ebDWh5LNQupURNfXminv5iAbbRTTu1HvF', '2026-09-04 10:24:53', '2026-09-04 10:24:53'),
(4, 'Dr. Chelsea Blanda', 'adriana.weissnat@example.net', NULL, '$2y$04$c9C1oSLFnCnRvXilpmFVF.jsIjIO2osnJcuVidbCVZjntBJCkwTKq', 'AdAHGd0TE0', '2026-09-04 10:24:53', '2026-09-04 10:24:53'),
(5, 'Dr. Myrl Armstrong PhD', 'kmckenzie@example.net', '2026-09-04 10:24:54', '$2y$04$c9C1oSLFnCnRvXilpmFVF.jsIjIO2osnJcuVidbCVZjntBJCkwTKq', 'R86XTQBXkm', '2026-09-04 10:24:54', '2026-09-04 10:24:54'),
(6, 'Miss Mariane Harris', 'gschmidt@example.com', NULL, '$2y$04$c9C1oSLFnCnRvXilpmFVF.jsIjIO2osnJcuVidbCVZjntBJCkwTKq', 'z7TWHChcBs', '2026-09-04 10:24:54', '2026-09-04 10:24:54'),
(7, 'Gonzalo Ward', 'cjones@example.org', '2026-09-04 10:24:54', '$2y$04$c9C1oSLFnCnRvXilpmFVF.jsIjIO2osnJcuVidbCVZjntBJCkwTKq', '0gSFEFc7uF', '2026-09-04 10:24:54', '2026-09-04 10:24:54'),
(8, 'Dr. Gilbert Stokes', 'ekulas@example.org', '2026-09-04 10:24:55', '$2y$04$c9C1oSLFnCnRvXilpmFVF.jsIjIO2osnJcuVidbCVZjntBJCkwTKq', 'bz9uCs5gHH', '2026-09-04 10:24:55', '2026-09-04 10:24:55'),
(9, 'Katelynn Champlin', 'lula.oconner@example.com', '2026-09-04 10:24:55', '$2y$04$c9C1oSLFnCnRvXilpmFVF.jsIjIO2osnJcuVidbCVZjntBJCkwTKq', 'C9bP8LzREy', '2026-09-04 10:24:55', '2026-09-04 10:24:55'),
(10, 'Dr. Lilly Bailey', 'mossie67@example.com', '2026-09-04 10:24:56', '$2y$04$c9C1oSLFnCnRvXilpmFVF.jsIjIO2osnJcuVidbCVZjntBJCkwTKq', 'ifJNPjZ4d4', '2026-09-04 10:24:56', '2026-09-04 10:24:56'),
(11, 'Lue Lowe PhD', 'gwilderman@example.org', '2026-09-04 10:24:58', '$2y$04$c9C1oSLFnCnRvXilpmFVF.jsIjIO2osnJcuVidbCVZjntBJCkwTKq', 'ZDTReeE2a8', '2026-09-04 10:24:58', '2026-09-04 10:24:58'),
(12, 'Dr. Flavie Howe I', 'jaclyn.armstrong@example.org', '2026-09-04 10:24:59', '$2y$04$8RYdRwrxgK/ZrSoEWVoZYuk23/VXU5jhElxo69LtP1eHw0X.CrdHa', 'cJwUPdtRtrtmhOwS1MjTvUdlBFnUs4ZaA9NmSTBSxB06lyp4WmPOI5Uz6pTj', '2026-09-04 10:24:59', '2026-09-04 10:24:59'),
(13, 'Emile Wintheiser II', 'genesis13@example.net', '2026-09-04 10:24:59', '$2y$04$O/yckWb5/Ja2ujHOgMYyxuSX3CHBBrThe7sth/xufiJN1HThX4XlS', 'iwHp3niYyD', '2026-09-04 10:24:59', '2026-09-04 10:24:59'),
(14, 'Aurore Lebsack', 'cstamm@example.net', '2026-09-04 10:24:59', '$2y$04$c9C1oSLFnCnRvXilpmFVF.jsIjIO2osnJcuVidbCVZjntBJCkwTKq', 'jaAtvEdVNe', '2026-09-04 10:24:59', '2026-09-04 10:24:59'),
(15, 'Test User', 'test@example.com', NULL, '$2y$04$YLTzW1VQ5PoMeQTEk6ACouITymfw6ittmG4H7OdpcKY/aguTfqybq', NULL, '2026-09-04 10:25:01', '2026-09-04 10:25:01'),
(16, 'Jewel Rosenbaum', 'sschuster@example.net', '2026-09-04 10:25:01', '$2y$04$c9C1oSLFnCnRvXilpmFVF.jsIjIO2osnJcuVidbCVZjntBJCkwTKq', 'P9P2GsncvO', '2026-09-04 10:25:01', '2026-09-04 10:25:01'),
(17, 'Prof. Alvera Mohr IV', 'hane.rodger@example.net', '2026-09-04 10:25:05', '$2y$04$c9C1oSLFnCnRvXilpmFVF.jsIjIO2osnJcuVidbCVZjntBJCkwTKq', 'YHvXOg9Tnh', '2026-09-04 10:25:05', '2026-09-04 10:25:05'),
(18, 'Test User', 'claudia.kling@example.org', '2026-09-04 10:25:06', '$2y$04$c9C1oSLFnCnRvXilpmFVF.jsIjIO2osnJcuVidbCVZjntBJCkwTKq', 'RRkOaAJy3W', '2026-09-04 10:25:06', '2026-09-04 10:25:06'),
(20, 'Prof. Dewitt Johns V', 'cortez.bartoletti@example.net', '2026-09-04 10:25:07', '$2y$04$c9C1oSLFnCnRvXilpmFVF.jsIjIO2osnJcuVidbCVZjntBJCkwTKq', 'qaIlPawAGj', '2026-09-04 10:25:07', '2026-09-04 10:25:07');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

DROP TABLE IF EXISTS `vendors`;
CREATE TABLE IF NOT EXISTS `vendors` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid_no` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `mobile` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=active,0=inactive',
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vendors_name_index` (`name`),
  KEY `vendors_nid_no_index` (`nid_no`),
  KEY `vendors_mobile_index` (`mobile`),
  KEY `vendors_email_index` (`email`),
  KEY `vendors_gender_index` (`gender`),
  KEY `vendors_image_index` (`image`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
