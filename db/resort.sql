-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 26, 2025 at 04:46 AM
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
  `description` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag1` bigint UNSIGNED DEFAULT NULL,
  `tag2` bigint UNSIGNED DEFAULT NULL,
  `tag3` bigint UNSIGNED DEFAULT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1=active, 0=inactive',
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`id`, `description`, `tag1`, `tag2`, `tag3`, `image`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'But I must explain to you how all this mistaken idea denouncing pleasure and praising pain was born and I will give you a complec ount of the system, and expound the actual teachin reatexplorer of the truth, the master-builder of human happiness. No ways one rejdislikes, or avoids pleasure itself, because', NULL, NULL, NULL, NULL, 1, 1, NULL, '2025-03-20 23:58:55', '2025-03-20 23:58:55'),
(2, 'But I must explain to you how all this mistaken idea denouncing pleasure and praising pain was born and I will give you a complec ount of the system, and expound the actual teachin reatexplorer of the truth, the master-builder of human happiness. No ways one rejdislikes, or avoids pleasure itself, because', NULL, NULL, NULL, 'uploads/aboutUs/1742536785.jpg', 1, 1, NULL, '2025-03-20 23:59:45', '2025-03-20 23:59:45');

-- --------------------------------------------------------

--
-- Table structure for table `amenities`
--

DROP TABLE IF EXISTS `amenities`;
CREATE TABLE IF NOT EXISTS `amenities` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=active,0=inactive',
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `amenities_name_index` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `amenities`
--

INSERT INTO `amenities` (`id`, `name`, `description`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Amfnj13', 'sjdfjw', 1, 1, 1, '2025-02-15 10:48:03', '2025-02-15 10:50:38', '2025-02-15 10:50:38'),
(2, 'ere', NULL, 1, 1, NULL, '2025-02-15 10:51:19', '2025-02-15 10:51:19', NULL),
(3, 'test456', 'sdfghjkl', 1, 1, NULL, '2025-02-26 09:26:15', '2025-02-26 09:26:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('sabbir@gmail.com|127.0.0.1:timer', 'i:1758348114;', 1758348114),
('sabbir@gmail.com|127.0.0.1', 'i:1;', 1758348114);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `food_cost` decimal(10,2) NOT NULL DEFAULT '0.00',
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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `checkouts`
--

INSERT INTO `checkouts` (`id`, `checkout_date`, `booking_id`, `room_cost`, `food_cost`, `laundry_cost`, `service_cost`, `other_cost`, `subtotal`, `discount`, `discount_type`, `vat`, `grand_total`, `advanced`, `due`, `payment_method`, `transaction_id`, `file`, `note`, `payment_status`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, '2025-09-12', 10, 5000.00, 0.00, 0.00, 500.00, 0.00, 5500.00, 10.00, 'percent', 5.00, 5225.00, NULL, NULL, 'cash', NULL, NULL, NULL, 1, 0, 1, NULL, '2025-09-12 13:33:34', '2025-09-12 13:33:34', NULL),
(4, '2025-09-13', 12, 20000.00, 0.00, 0.00, 0.00, 0.00, 20000.00, 0.00, 'percent', 0.00, 20000.00, NULL, NULL, 'bkash', '1234567897654', NULL, NULL, 1, 0, 1, NULL, '2025-09-13 07:21:06', '2025-09-13 07:21:06', NULL),
(5, '2025-09-26', 13, 2200.00, 200.00, 0.00, 0.00, 0.00, 2400.00, 0.00, 'percent', 0.00, 2400.00, NULL, NULL, 'cash', NULL, NULL, NULL, 1, 0, 1, NULL, '2025-09-25 22:42:22', '2025-09-25 22:42:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `check_ins`
--

DROP TABLE IF EXISTS `check_ins`;
CREATE TABLE IF NOT EXISTS `check_ins` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `invoice` int DEFAULT NULL,
  `checkout_id` bigint UNSIGNED DEFAULT NULL,
  `package_id` bigint UNSIGNED DEFAULT NULL,
  `start_date` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_date` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `day` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `adult` int NOT NULL,
  `kids` int DEFAULT NULL,
  `room_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid_no` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` int DEFAULT NULL,
  `gender` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name2` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid_no2` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile2` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone2` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email2` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=active,0=inactive',
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `check_ins_start_date_index` (`start_date`),
  KEY `check_ins_date_date_index` (`end_date`),
  KEY `check_ins_day_index` (`day`),
  KEY `check_ins_adult_index` (`adult`),
  KEY `check_ins_kids_index` (`kids`),
  KEY `check_ins_room_no_index` (`room_id`),
  KEY `check_ins_name_index` (`name`),
  KEY `check_ins_nid_no_index` (`nid_no`),
  KEY `check_ins_address_index` (`address`),
  KEY `check_ins_mobile_index` (`mobile`),
  KEY `check_ins_phone_index` (`phone`),
  KEY `check_ins_email_index` (`email`),
  KEY `check_ins_name2_index` (`name2`),
  KEY `check_ins_nid_no2_index` (`nid_no2`),
  KEY `check_ins_address2_index` (`address2`),
  KEY `check_ins_mobile2_index` (`mobile2`),
  KEY `check_ins_phone2_index` (`phone2`),
  KEY `check_ins_email2_index` (`email2`),
  KEY `check_ins_file_index` (`file`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `check_ins`
--

INSERT INTO `check_ins` (`id`, `invoice`, `checkout_id`, `package_id`, `start_date`, `end_date`, `day`, `adult`, `kids`, `room_id`, `name`, `nid_no`, `address`, `mobile`, `phone`, `email`, `age`, `gender`, `name2`, `nid_no2`, `address2`, `mobile2`, `phone2`, `email2`, `file`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(9, NULL, NULL, NULL, '2025-03-03', '2025-03-13', '10', 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, '2025-03-01 04:16:34', '2025-09-12 07:07:16', '2025-09-12 07:07:16'),
(6, NULL, NULL, NULL, '2025-03-01', '2025-03-02', '1', 2, 0, '[\"3\"]', 'Nazmul', '42536322', 'dhaka', '01778213931', NULL, 'dassa@gmail.com', 27, 'Male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '2025-03-01 03:29:01', '2025-03-01 03:29:41', NULL),
(5, NULL, NULL, NULL, '2025-03-01', '2025-03-02', '1', 1, 0, '[\"2\",\"3\"]', 'Admin', '1234568345', 'Savar dhaka', '01778213123', NULL, 'drsazibbd27@gmail.com', 27, 'Male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '2025-03-01 02:18:08', '2025-03-01 02:25:22', NULL),
(10, NULL, 3, NULL, '2025-09-12', '2025-09-14', '2', 2, 0, '[\"1\"]', 'Mr. Amanullah Aman', '1212343456', '12/12 Gulshan-1, Dhaka', '01700545600', NULL, NULL, 26, 'Male', NULL, NULL, NULL, NULL, NULL, NULL, 'uploads/documents/1757694962.jpg', 1, 1, 1, '2025-09-12 07:11:18', '2025-09-12 13:33:34', NULL),
(12, NULL, 4, 1, '2025-09-13', '2025-09-14', '1', 3, 0, '[\"1\"]', 'Mr. Asim Akram', '1223234323', '12/12 Mirpur-12, Dhaka', '01700545600', NULL, 'asim@gmail.com', NULL, 'Male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, '2025-09-13 06:57:31', '2025-09-13 07:21:06', NULL),
(13, 7061, 5, NULL, '2025-09-24', '2025-09-25', '1', 2, 0, '[\"1\"]', 'test', '2323444323', '12/12 Mirpur-12, Dhaka', '01700545600', NULL, NULL, 29, 'Male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '2025-09-25 22:17:28', '2025-09-25 22:42:22', NULL),
(14, 3661, NULL, NULL, '2025-09-26', '2025-09-26', '0', 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, '2025-09-25 22:46:02', '2025-09-25 22:46:20', '2025-09-25 22:46:20');

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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dinings`
--

INSERT INTO `dinings` (`id`, `user_id`, `food_id`, `quantity`, `price`, `subtotal`, `remarks`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(7, 6, 1, 2, 200.00, 400.00, NULL, 1, NULL, NULL, '2025-09-20 12:46:11', '2025-09-20 12:46:11'),
(8, 13, 1, 1, 200.00, 200.00, NULL, 1, NULL, NULL, '2025-09-25 22:41:46', '2025-09-25 22:41:46');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

DROP TABLE IF EXISTS `expenses`;
CREATE TABLE IF NOT EXISTS `expenses` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `expense_title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receiver_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_amount` decimal(10,2) DEFAULT NULL,
  `due_amount` decimal(10,2) DEFAULT NULL,
  `payment_method` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'cash,bkash,nagad,card,bank',
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=paid,0=unpaid,2=partial',
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `expense_title`, `receiver_name`, `payment_amount`, `due_amount`, `payment_method`, `note`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Laundry', 'Mr. Ashiq', 1000.00, 0.00, 'cash', 'test2', 1, 1, 1, '2025-09-16 12:50:22', '2025-09-16 13:02:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `foods`
--

DROP TABLE IF EXISTS `foods`;
CREATE TABLE IF NOT EXISTS `foods` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` bigint DEFAULT NULL,
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=active,0=inactive',
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `foods`
--

INSERT INTO `foods` (`id`, `name`, `type`, `category`, `price`, `image`, `priority`, `remarks`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Mixed Cary', 'Veg', 'Lunch', 200.00, 'uploads/food/1758355327.png', NULL, 'test', 1, 1, 1, '2025-09-20 01:52:50', '2025-09-20 02:02:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `house_keepings`
--

DROP TABLE IF EXISTS `house_keepings`;
CREATE TABLE IF NOT EXISTS `house_keepings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `amenities_id` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `room_no` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `vendor_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `house_keepings`
--

INSERT INTO `house_keepings` (`id`, `amenities_id`, `room_no`, `description`, `vendor_id`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '[\"2\",\"3\"]', '2', 'dfghjk efef', '1', 1, 1, 1, '2025-03-03 11:38:25', '2025-09-09 09:48:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laundries`
--

DROP TABLE IF EXISTS `laundries`;
CREATE TABLE IF NOT EXISTS `laundries` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `amenities_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `room_no` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `vendor_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=received,0=assigned',
  `assign_date` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receive_date` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `laundries_amenities_id_index` (`amenities_id`),
  KEY `laundries_room_no_index` (`room_no`),
  KEY `laundries_vendor_id_index` (`vendor_id`),
  KEY `laundries_assign_date_index` (`assign_date`),
  KEY `laundries_receive_date_index` (`receive_date`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laundries`
--

INSERT INTO `laundries` (`id`, `amenities_id`, `quantity`, `room_no`, `description`, `vendor_id`, `note`, `status`, `assign_date`, `receive_date`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, '[\"2\",\"3\"]', '[\"1\",\"2\"]', NULL, NULL, '1', NULL, 0, '2025-03-05', NULL, 1, NULL, '2025-03-05 06:39:48', '2025-09-09 09:49:04', '2025-09-09 09:49:04'),
(4, '[\"2\",\"3\"]', '[\"2\",\"4\"]', NULL, NULL, '1', NULL, 1, '2025-09-09', NULL, 1, 1, '2025-09-09 09:49:31', '2025-09-14 12:20:28', NULL);

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
  `amenities_id` bigint DEFAULT NULL,
  `quantity` int NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laundry_receiveds`
--

INSERT INTO `laundry_receiveds` (`id`, `laundry_id`, `vendor_id`, `assign_date`, `amenities_id`, `quantity`, `status`, `note`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 4, 1, '2025-09-09', 3, 4, 'Returned', 'late', NULL, NULL, '2025-09-14 11:49:42', '2025-09-14 12:19:36', NULL),
(4, 4, 1, '2025-09-09', 2, 2, 'Returned', '14/09', NULL, NULL, '2025-09-14 11:49:42', '2025-09-14 12:19:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(8, '2025_02_16_171301_create_check_ins_table', 2),
(12, '2025_02_26_171716_create_house_keepings_table', 3),
(13, '2025_02_26_173838_create_laundries_table', 3),
(14, '2025_03_03_164001_create_vendors_table', 4),
(15, '2025_03_21_051825_create_about_us_table', 5),
(16, '2025_04_11_162201_create_packages_table', 6),
(17, '2025_04_12_050227_create_package_categories_table', 7),
(18, '2025_08_30_071730_create_sliders_table', 8),
(19, '2025_09_12_190400_create_checkouts_table', 9),
(20, '2025_09_14_172339_create_laundry_receiveds_table', 10),
(22, '2025_09_15_170710_create_expenses_table', 11),
(24, '2025_09_20_062816_create_foods_table', 12),
(25, '2025_09_20_154531_create_dinings_table', 12);

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

DROP TABLE IF EXISTS `packages`;
CREATE TABLE IF NOT EXISTS `packages` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `no_of_person` bigint UNSIGNED DEFAULT NULL,
  `no_of_day` bigint UNSIGNED DEFAULT NULL,
  `price` double DEFAULT NULL,
  `price_for` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_of_bed_room` bigint UNSIGNED DEFAULT NULL,
  `no_of_bed` bigint UNSIGNED DEFAULT NULL,
  `no_food_serve` bigint UNSIGNED DEFAULT NULL,
  `food_item` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `description` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1=active, 0=inactive',
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `name`, `category_id`, `no_of_person`, `no_of_day`, `price`, `price_for`, `no_of_bed_room`, `no_of_bed`, `no_food_serve`, `food_item`, `description`, `image`, `start_date`, `end_date`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Package-1', 1, 2, 2, 20000, 'Fixed', NULL, NULL, NULL, NULL, 'djhwui', 'uploads/packages/1744394495.png', NULL, NULL, 1, 1, 1, '2025-04-11 12:01:35', '2025-09-07 09:46:55');

-- --------------------------------------------------------

--
-- Table structure for table `package_categories`
--

DROP TABLE IF EXISTS `package_categories`;
CREATE TABLE IF NOT EXISTS `package_categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1=active, 0=inactive',
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `package_categories`
--

INSERT INTO `package_categories` (`id`, `name`, `description`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Summer', NULL, 1, 1, NULL, '2025-04-12 11:41:16', '2025-04-12 11:41:16');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
CREATE TABLE IF NOT EXISTS `rooms` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `room_no` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `floor` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` bigint DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `available_status` tinyint(1) NOT NULL DEFAULT '0',
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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `type`, `name`, `room_no`, `floor`, `priority`, `description`, `image`, `available_status`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1', 'test', '102', '1st Floor', NULL, NULL, 'uploads/room/1757354315.png', 0, 1, 1, 1, '2025-02-24 10:01:59', '2025-09-25 22:42:22', NULL),
(2, '1', 'test2', '1011', '6th Floor', NULL, NULL, 'uploads/room/1757354086.jpg', 1, 1, 1, 1, '2025-02-24 10:26:07', '2025-09-08 11:54:46', NULL),
(3, '1', 'test33', '1022', '5th Floor', 1022, NULL, 'uploads/room/1757354017.png', 1, 1, 1, 1, '2025-02-28 22:47:10', '2025-09-08 11:53:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `room_types`
--

DROP TABLE IF EXISTS `room_types`;
CREATE TABLE IF NOT EXISTS `room_types` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_code` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adult_capacity` bigint DEFAULT NULL,
  `kids_capacity` bigint DEFAULT NULL,
  `base_price` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` bigint DEFAULT NULL,
  `amenities` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room_types`
--

INSERT INTO `room_types` (`id`, `name`, `type`, `short_code`, `adult_capacity`, `kids_capacity`, `base_price`, `priority`, `amenities`, `description`, `image`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'RT2', 'Room', NULL, 2, NULL, '2200', NULL, '[\"ere\",\"test456\"]', NULL, NULL, 1, 1, 1, '2025-02-15 10:56:19', '2025-03-22 03:46:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('i7xt0wByqrUGmcnRsBnNlnicGrS2AIbichR28Azc', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiRnBXVktsMVpITDBNQmZtNzRYUGVYWVZYek0xNUZJblc5UE15RGViRSI7czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI5OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvY2hlY2tJbiI7fX0=', 1758861981);

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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `name`, `image`, `remarks`, `hierarchy`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, NULL, 'uploads/slider/1757166602_68bc3c0a0481d.jpg', NULL, 1, 1, 1, '2025-09-06 07:50:02', '2025-09-06 07:50:02'),
(2, NULL, 'uploads/slider/1757166774_68bc3cb65815e.jpg', NULL, 2, 1, 1, '2025-09-06 07:52:54', '2025-09-06 07:52:54'),
(3, NULL, 'uploads/slider/1757166792_68bc3cc8b9ed5.jpg', NULL, 3, 1, 1, '2025-09-06 07:53:12', '2025-09-06 07:54:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin@gmail.com', '2025-02-15 10:45:53', '$2y$12$PIs/a0tXXRuweNsu/AV6AOzJAMTG2zfcGldK7jEBPDVigPW4glR9a', 'I2VtWQK7w1QFLRNJUsv2fUUXf8OR52Y8q9z8KF91ltm96XZGjzFlRxtm1amJ', '2025-02-15 10:45:54', '2025-02-15 10:45:54');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

DROP TABLE IF EXISTS `vendors`;
CREATE TABLE IF NOT EXISTS `vendors` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid_no` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `mobile` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `name`, `nid_no`, `address`, `mobile`, `email`, `gender`, `image`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Mr. Ashiq', '2323234323', NULL, '01756545678', 'ashiq@gmail.com', 'Male', NULL, 1, 1, NULL, '2025-09-09 09:36:11', '2025-09-09 09:36:11', NULL),
(2, 'Md. Osim', '2323444323', '12/12 Mirpur, Dhaka-1212', '01700545678', 'osim@gmail.com', 'Male', 'uploads/documents/1757432846.jpeg', 1, 1, 1, '2025-09-09 09:37:36', '2025-09-09 09:47:27', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
