-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2026 at 05:19 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u826528245_global`
--

-- --------------------------------------------------------

--
-- Table structure for table `adjustbalances`
--

CREATE TABLE `adjustbalances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `distributor_id` varchar(255) DEFAULT NULL,
  `company_id` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `operation` varchar(255) DEFAULT NULL,
  `total_balance` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `distributor_id` varchar(255) DEFAULT NULL,
  `sup_dist_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `distributor_id`, `sup_dist_id`, `name`, `amount`, `user_id`, `date`, `created_at`, `updated_at`) VALUES
(31, 'GAS11298320', 'GAS11291927', 'Fino Payment Bank', '10582', 'GAS11298320', '16-05-2026', '2026-05-16 17:15:15', '2026-05-16 17:16:41'),
(32, 'GAS11298320', 'GAS11291927', 'Airtel Payment Bank', '15000', 'GAS11298320', '16-05-2026', '2026-05-16 17:15:36', '2026-05-16 17:19:08'),
(33, 'GAS11298320', 'GAS11291927', 'Paynearby', '11877', 'GAS11298320', '16-05-2026', '2026-05-16 17:19:33', '2026-05-16 17:19:46'),
(34, 'GAS11298320', 'GAS11291927', 'Recharge Partner', '13000', 'GAS11298320', '16-05-2026', '2026-05-16 17:20:10', '2026-05-16 17:20:18'),
(35, 'GAS11298320', 'GAS11291927', 'Renova Pay', '12500', 'GAS11298320', '16-05-2026', '2026-05-16 17:20:32', '2026-05-16 17:20:56'),
(36, 'GAS11298320', 'GAS11291927', 'Go Payments', '14000', 'GAS11298320', '16-05-2026', '2026-05-16 17:20:43', '2026-05-16 17:21:06'),
(37, 'GAS11298320', 'GAS11291927', 'Soul Pay', '14500', 'GAS11298320', '16-05-2026', '2026-05-16 17:21:28', '2026-05-16 17:21:36');

-- --------------------------------------------------------

--
-- Table structure for table `companybalances`
--

CREATE TABLE `companybalances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `retailer_id` varchar(255) DEFAULT NULL,
  `distributor_id` varchar(255) DEFAULT NULL,
  `fos_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companybalances`
--

INSERT INTO `companybalances` (`id`, `company_id`, `amount`, `retailer_id`, `distributor_id`, `fos_id`, `created_at`, `updated_at`) VALUES
(58, '35', '1000', 'GAS05111710', 'GAS11298320', NULL, '2026-05-16 17:44:05', '2026-05-16 17:44:05'),
(61, '31', '234', 'GAS05111160', 'GAS11298320', 'GAS05117881', '2026-05-30 18:45:26', '2026-05-30 18:45:26');

-- --------------------------------------------------------

--
-- Table structure for table `company_access_requests`
--

CREATE TABLE `company_access_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `company_id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `approved_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `company_access_requests`
--

INSERT INTO `company_access_requests` (`id`, `created_at`, `updated_at`, `company_id`, `user_id`, `status`, `approved_by`) VALUES
(1, '2026-06-01 13:30:59', '2026-06-01 13:30:59', '32', 'GAS05111160', 1, 'GAS05161868'),
(2, '2026-06-01 13:40:24', '2026-06-01 13:40:24', '31', 'GAS05111160', 1, 'GAS05161868'),
(3, '2026-06-01 13:42:48', '2026-06-01 13:42:54', '33', 'GAS05111160', 2, 'GAS05161868'),
(4, '2026-06-02 12:54:16', '2026-06-02 12:54:29', '32', 'GAS05111710', 2, 'GAS05111710'),
(5, '2026-06-02 12:54:49', '2026-06-02 12:55:01', '31', 'GAS05111710', 2, 'GAS05161868'),
(6, '2026-06-02 12:55:27', '2026-06-02 12:55:27', '36', 'GAS05111710', 1, 'GAS05111710'),
(7, '2026-06-02 12:59:03', '2026-06-02 12:59:03', '33', 'GAS05111710', 1, 'GAS05161868');

-- --------------------------------------------------------

--
-- Table structure for table `creditcharges`
--

CREATE TABLE `creditcharges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sup_dist_id` varchar(255) DEFAULT NULL,
  `distributor_id` varchar(255) DEFAULT NULL,
  `company_id` varchar(255) DEFAULT NULL,
  `retailer_id` varchar(255) DEFAULT NULL,
  `ch_amount` varchar(255) DEFAULT NULL,
  `operation` varchar(255) DEFAULT NULL,
  `total_balance` varchar(255) DEFAULT NULL,
  `remarks` varchar(2000) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `debitpayments`
--

CREATE TABLE `debitpayments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `distributor_id` varchar(255) DEFAULT NULL,
  `sup_dist_id` varchar(255) DEFAULT NULL,
  `fos_id` varchar(255) DEFAULT NULL,
  `company_id` varchar(255) DEFAULT NULL,
  `retailer_id` varchar(255) DEFAULT NULL,
  `total_amount` varchar(255) DEFAULT NULL,
  `total_balance` varchar(255) DEFAULT NULL,
  `opening_balance` varchar(255) DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `payment_mode` varchar(255) DEFAULT NULL,
  `payment_date` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `payment_remarks` varchar(2000) DEFAULT NULL,
  `paycollection_id` varchar(255) DEFAULT NULL,
  `payment_collect` varchar(255) DEFAULT NULL,
  `collect_date` varchar(255) DEFAULT NULL,
  `collect_remarks` varchar(2000) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fosassigns`
--

CREATE TABLE `fosassigns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `distributor_id` varchar(255) DEFAULT NULL,
  `old_fos_id` varchar(255) DEFAULT NULL,
  `fos_id` varchar(255) DEFAULT NULL,
  `retailer_id` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fosassigns`
--

INSERT INTO `fosassigns` (`id`, `distributor_id`, `old_fos_id`, `fos_id`, `retailer_id`, `date`, `created_by`, `created_at`, `updated_at`) VALUES
(3, 'GAS06274892', 'GAS06279179', 'GAS06279179', 'GAS06278328', '27-06-2024', 'GAS06272625', '2024-06-27 17:31:24', '2024-06-27 17:31:24'),
(4, 'GAS06274892', 'GAS06279179', 'GAS06279043', 'GAS06278328', '27-06-2024', 'GAS06272625', '2024-06-27 18:12:21', '2024-06-27 18:12:21'),
(5, 'GAS06274892', 'GAS06279179', 'GAS06279043', 'GAS06274498', '27-06-2024', 'GAS06272625', '2024-06-27 18:12:21', '2024-06-27 18:12:21'),
(6, 'GAS06274892', 'GAS06279043', 'GAS06279179', 'GAS06278328', '27-06-2024', 'GAS06272625', '2024-06-27 18:14:12', '2024-06-27 18:14:12'),
(7, 'GAS06274892', 'GAS06279043', 'GAS06279179', 'GAS06274498', '27-06-2024', 'GAS06272625', '2024-06-27 18:14:12', '2024-06-27 18:14:12'),
(8, 'GAS06274892', 'GAS06279179', 'GAS06279043', 'GAS06278472', '28-06-2024', 'GAS06272625', '2024-06-28 05:32:02', '2024-06-28 05:32:02'),
(9, 'GAS06274892', 'GAS06279179', 'GAS06279043', 'GAS06278328', '28-06-2024', 'GAS06272625', '2024-06-28 05:32:02', '2024-06-28 05:32:02'),
(10, 'GAS06274892', 'GAS06279179', 'GAS06279043', 'GAS06274498', '28-06-2024', 'GAS06272625', '2024-06-28 05:32:02', '2024-06-28 05:32:02'),
(11, 'GAS06274892', 'GAS06279179', 'GAS06279179', 'GAS06278472', '31-08-2024', 'GAS06279179', '2024-06-28 05:33:27', '2024-08-31 12:50:03'),
(12, 'GAS06274892', 'GAS06279043', 'GAS06279179', 'GAS06278328', '28-06-2024', 'GAS06272625', '2024-06-28 05:33:27', '2024-06-28 05:33:27'),
(13, 'GAS06274892', 'GAS06279043', 'GAS06279179', 'GAS06274498', '28-06-2024', 'GAS06272625', '2024-06-28 05:33:27', '2024-06-28 05:33:27'),
(14, 'GAS06274892', 'GAS06279179', 'GAS06279043', 'GAS06278328', '02-09-2024', 'GAS06272625', '2024-09-02 15:01:09', '2024-09-02 15:01:09'),
(15, 'GAS06274892', 'GAS06279179', 'GAS06279043', 'GAS06274498', '02-09-2024', 'GAS06272625', '2024-09-02 15:01:09', '2024-09-02 15:01:09'),
(16, 'GAS06274892', 'GAS06279043', 'GAS06279179', 'GAS06278328', '02-09-2024', 'GAS06272625', '2024-09-02 15:02:36', '2024-09-02 15:02:36'),
(17, 'GAS06274892', 'GAS06279043', 'GAS06279179', 'GAS06274498', '02-09-2024', 'GAS06272625', '2024-09-02 15:02:36', '2024-09-02 15:02:36');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(36, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(37, '2019_08_19_000000_create_failed_jobs_table', 1),
(38, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(39, '2023_11_07_145939_create_users_table', 1),
(40, '2023_11_08_163812_create_companies_table', 1),
(41, '2023_11_08_181507_create_topups_table', 1),
(42, '2023_11_20_060910_create_adjustbalances_table', 1),
(43, '2023_11_20_091430_create_fosassigns_table', 1),
(44, '2023_12_26_082000_create_debitpayments_table', 1),
(45, '2024_01_16_064143_create_products_table', 1),
(46, '2024_01_16_075553_create_orders_table', 1),
(47, '2024_01_30_062527_create_companybalances_table', 2),
(48, '2024_02_27_055045_create_notes_table', 3),
(49, '2024_03_08_110353_create_creditcharges_table', 4),
(50, '2026_05_25_185952_create_company_access_requests_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `message1` varchar(1000) DEFAULT NULL,
  `message2` varchar(4000) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `retailer_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `required_date` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `detail` text DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

CREATE TABLE `order_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `otps`
--

CREATE TABLE `otps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `otp` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_code` varchar(255) DEFAULT NULL,
  `distributor_id` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `available_quantity` int(11) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `detail` varchar(4000) DEFAULT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `topups`
--

CREATE TABLE `topups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `distributor_id` varchar(255) DEFAULT NULL,
  `sup_dist_id` varchar(255) DEFAULT NULL,
  `fos_id` varchar(255) DEFAULT NULL,
  `topup_id` varchar(255) DEFAULT NULL,
  `company_id` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `topup_type` int(10) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `retailer_remarks` varchar(2000) DEFAULT NULL,
  `month` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `approver_id` varchar(255) DEFAULT NULL,
  `total_balance` varchar(255) DEFAULT NULL,
  `opening_balance` varchar(255) DEFAULT NULL,
  `total_charge` varchar(255) DEFAULT NULL,
  `topup_remarks` varchar(2000) DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `total_amount` varchar(255) DEFAULT NULL,
  `payment_mode` varchar(255) DEFAULT NULL,
  `payment_date` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `payment_remarks` varchar(2000) DEFAULT NULL,
  `paycollection_id` varchar(255) DEFAULT NULL,
  `payment_collect` varchar(255) DEFAULT '0',
  `collect_date` varchar(255) DEFAULT NULL,
  `collect_remarks` varchar(2000) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `topups`
--

INSERT INTO `topups` (`id`, `distributor_id`, `sup_dist_id`, `fos_id`, `topup_id`, `company_id`, `amount`, `topup_type`, `user_id`, `retailer_remarks`, `month`, `date`, `status`, `approver_id`, `total_balance`, `opening_balance`, `total_charge`, `topup_remarks`, `payment_status`, `total_amount`, `payment_mode`, `payment_date`, `image`, `transaction_id`, `payment_remarks`, `paycollection_id`, `payment_collect`, `collect_date`, `collect_remarks`, `created_at`, `updated_at`) VALUES
(166, 'GAS11298320', 'GAS11291927', NULL, 'tp05166060', '35', '1000', 1, 'GAS05111710', 'Requesting for Adding 1000', '2026-05', '2026-05-16', '1', 'GAS05117148', '1000', NULL, NULL, 'Recharged 1000 to Anshul', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, '2026-05-16 17:39:18', '2026-05-16 17:44:05'),
(167, 'GAS11298320', 'GAS11291927', NULL, 'tp05164191', '35', '0.00', 2, 'GAS05111710', NULL, NULL, NULL, '1', NULL, '-2000', '1000', NULL, NULL, '1', '1000', 'cash', '2026-05-16', NULL, '1000', 'Remova Pay Cash paid to FOS', 'GAS05117148', '1', '2026-05-30', NULL, '2026-05-16 18:00:19', '2026-05-30 12:53:00'),
(182, 'GAS11298320', 'GAS11291927', 'GAS05117881', 'tp05311027', '31', '123', 1, 'GAS05111160', NULL, '2026-05', '2026-05-31', '1', 'GAS05161868', '123', NULL, NULL, NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, '2026-05-30 18:44:02', '2026-05-30 18:45:26'),
(183, 'GAS11298320', 'GAS11291927', 'GAS05117881', 'tp05317821', '31', '111', 1, 'GAS05111160', NULL, '2026-05', '2026-05-31', '1', 'GAS05161868', '234', NULL, NULL, NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, '2026-05-30 18:47:52', '2026-05-30 18:48:47'),
(185, 'GAS11298320', 'GAS11291927', 'GAS05117881', 'tp05312748', '31', '0.00', 2, 'GAS05111160', NULL, NULL, NULL, '1', NULL, '134', '234', NULL, NULL, '1', '100', 'cash', '2026-05-31', NULL, NULL, NULL, 'GAS05117881', '1', '2026-05-31', NULL, '2026-05-30 19:07:05', '2026-05-30 19:07:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `distributor_id` varchar(255) DEFAULT NULL,
  `sup_dist_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `whatsapp` varchar(255) DEFAULT NULL,
  `shop` varchar(255) DEFAULT NULL,
  `refrence` varchar(255) DEFAULT NULL,
  `adhaar` varchar(255) DEFAULT NULL,
  `pan` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `address` varchar(1000) DEFAULT NULL,
  `per_address` varchar(1000) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `fos` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `distributor_id`, `sup_dist_id`, `name`, `email`, `phone`, `whatsapp`, `shop`, `refrence`, `adhaar`, `pan`, `date`, `password`, `address`, `per_address`, `role`, `fos`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(66, 'GAS04274965', 'GAS04274965', 'GAS04274965', 'Admin', 'admin123@gmail.com', '9871819334', '9871819334', 'Admin', NULL, '1234 5678 9854', 'NA', '2002-01-01', 'Gauri1234@#$', 'BAROLA SEC 49 NOIDA', 'BAROLA SEC 49 NOIDA', '0', NULL, '1', 'GAS04274965', '2024-04-27 09:22:46', '2024-04-27 09:22:46'),
(67, 'GAS11291927', 'GAS04274965', 'GAS04274965', 'Surya', 'suryasingh1981@gmail.com', '5646346345', '6456363456', 'Suray Shop', NULL, '9849849849', 'FYSPKI6589U', '2025-11-28', '2348740', 'PWHOIEDUF', 'GHDSKJDFDF', '1', NULL, '1', 'GAS04274965', '2025-11-29 18:28:19', '2025-11-29 18:28:19'),
(68, 'GAS11298320', 'GAS11291927', 'GAS11291927', 'Surya Distributer', 'egrdelhi1234@gmail.com', '6567890[', '8798797', 'Surya Distributor Shop', NULL, 'lfeajf9348ut349', 'lfsdkjflk', '2025-11-02', 'Gas@1234', '9ut98re', '89utew9r8gud9fg', '2', NULL, '1', 'GAS11291927', '2025-11-29 18:30:54', '2025-11-29 18:30:54'),
(69, 'GAS05117148', 'GAS11298320', 'GAS11291927', 'Raghav kumar', 'kumarraghav026@gmail.com', '9911825985', '9911825985', 'Raghu', NULL, '955855468665', 'FKOKP5826C', '1998-06-01', '4554680', 'District Centre', 'Address is permenant', '3', NULL, '1', 'GAS11298320', '2026-05-11 16:52:22', '2026-05-11 16:52:22'),
(70, 'GAS05111710', 'GAS11298320', 'GAS11291927', 'Anshul', 'canshul313@gmail.com', '4649848964', '6549848', 'Shop Retailer', NULL, '5098353409', 'SDLKFJSLK', '1988-06-04', '8346377', 'Retailer Address', 'Retailer Permanent  Address', '5', NULL, '1', 'GAS11298320', '2026-05-11 16:55:32', '2026-05-11 16:55:32'),
(71, 'GAS05117881', 'GAS11298320', 'GAS11291927', 'Dhanajay', 'dhananjyek@gmail.com', '9846546549', '98465465498', 'FOS Shop', NULL, '465466', 'SLKDFJSLKDFJ', '1956-05-10', '5039938', 'FOS Address', 'FOS Permanent Address', '4', NULL, '1', 'GAS11298320', '2026-05-11 16:59:57', '2026-05-11 16:59:57'),
(72, 'GAS05114180', 'GAS11298320', 'GAS11291927', 'DK FOS', 'dk4187958@gmail.com', '6545', '4654654654', '564654', NULL, '654654654654', '654654', '275760-05-06', '5957897', 'fos1  ADDRESS', 'FOS1 PERMANENT ADDRESS', '4', NULL, '1', 'GAS11298320', '2026-05-11 17:02:15', '2026-05-11 17:02:15'),
(73, 'GAS05111160', 'GAS11298320', 'GAS11291927', 'Rishabh Kumar', 'rk5057238@gmail.com', '564654', '654654', '6546546', NULL, '5465465', '465465', '5465-06-04', '5820268', 'Retailer 1 Address', 'Retailer 1 Permanent Address', '5', 'GAS05117881', '1', 'GAS11298320', '2026-05-11 17:04:00', '2026-05-11 17:04:00'),
(74, 'GAS05147495', 'GAS11291927', 'GAS11291927', 'SURYA PRAKASH SINGH', 'gas2023to2024@gmail.com', '9211939394', '9211939394', 'SURYA COMMUNICATION', NULL, '634503487124', 'BNJPS5403C', '1990-10-10', '9211939394', 'BAROLA', 'BAROLA', '2', NULL, '1', 'GAS11291927', '2026-05-14 13:40:21', '2026-05-14 13:40:21'),
(75, 'GAS05161061', 'GAS11298320', 'GAS11291927', 'Rohit Kumar', 'paynearby2022to2023@gmail.com', '409534', '44345345034', 'Rohit Shop', NULL, '53489573495', 'LSDFJLSKJF', '2026-05-10', '7552285', 'DSFSDF', 'DFSDFSDF', '4', NULL, '1', 'GAS11298320', '2026-05-16 16:42:29', '2026-05-16 16:42:29'),
(76, 'GAS05161857', 'GAS11298320', 'GAS11291927', 'gas2026to2027 retailer', 'gas2026to2027@gmail.com', '45397594', '50983054380', 'gas2026to2027 Shop', NULL, '40958340953', 'DSLKFJSDLF', '2026-05-13', '3022930', 'SDFSDF', 'ASDGDSF', '5', 'GAS05161061', '1', 'GAS11298320', '2026-05-16 17:06:40', '2026-05-16 17:06:40'),
(77, 'GAS05161868', 'GAS11298320', 'GAS11291927', 'gas2027to2028 retailer', 'gas2027to2028@gmail.com', '05834058`', '39480332', 'gas2027to2028 Shop', NULL, '049382304', 'LFDKJSLSD', '2026-05-13', '3922885', 'GDFJLKQ', 'ldfjsdlkfjsd', '3', NULL, '1', 'GAS11298320', '2026-05-16 17:08:52', '2026-05-16 17:08:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adjustbalances`
--
ALTER TABLE `adjustbalances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companybalances`
--
ALTER TABLE `companybalances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_access_requests`
--
ALTER TABLE `company_access_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `creditcharges`
--
ALTER TABLE `creditcharges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `debitpayments`
--
ALTER TABLE `debitpayments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fosassigns`
--
ALTER TABLE `fosassigns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_product_order_id_foreign` (`order_id`),
  ADD KEY `order_product_product_id_foreign` (`product_id`);

--
-- Indexes for table `otps`
--
ALTER TABLE `otps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topups`
--
ALTER TABLE `topups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adjustbalances`
--
ALTER TABLE `adjustbalances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `companybalances`
--
ALTER TABLE `companybalances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `company_access_requests`
--
ALTER TABLE `company_access_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `creditcharges`
--
ALTER TABLE `creditcharges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `debitpayments`
--
ALTER TABLE `debitpayments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fosassigns`
--
ALTER TABLE `fosassigns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_product`
--
ALTER TABLE `order_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `otps`
--
ALTER TABLE `otps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `topups`
--
ALTER TABLE `topups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `order_product_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
