-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2024 at 11:33 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tsolar_web_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, '<b>dwawawawa</b>', '<b>adwdwdfcw&nbsp;</b>', '2023-10-31 23:42:29', '2023-11-01 00:53:18');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `hyperlink` varchar(255) DEFAULT NULL,
  `pdf` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `description`, `image`, `hyperlink`, `pdf`, `created_at`, `updated_at`) VALUES
(2, 'daw', 'dddddddddddddddddd\r\ndddddddddd\r\nddddddddddddddddddddd\r\ndddddd\r\nddddddddddddddddddd', '1698312115.jpg', 'https://www.abplive.com/', NULL, '2023-10-26 03:51:55', '2023-10-30 04:06:17'),
(3, 'Blanditiis in ex sim', 'Voluptatibus ut amet Voluptatibus ut ametVoluptatibus ut ametVoluptatibus ut ametVoluptatibus ut ametVoluptatibus ut ametVoluptatibus ut ametVoluptatibus ut ametVoluptatibus ut ametVoluptatibus ut ametVoluptatibus ut ametVoluptatibus ut ametVoluptatibus ut ametVoluptatibus ut ametVoluptatibus ut ametVoluptatibus ut ametVoluptatibus ut ametVoluptatibus ut amet', '1698657892.png', 'https://www.ndtv.com/', NULL, '2023-10-30 03:54:52', '2023-10-30 03:54:52'),
(4, 'Hic laboris ut sit m', 'Amet aspernatur dig Amet aspernatur digAmet aspernatur digAmet aspernatur digAmet aspernatur digAmet aspernatur digAmet aspernatur digAmet aspernatur digAmet aspernatur digAmet aspernatur digAmet aspernatur digAmet aspernatur digAmet aspernatur digAmet aspernatur digAmet aspernatur digAmet aspernatur digAmet aspernatur digAmet aspernatur digAmet aspernatur digAmet aspernatur dig', '1698657956.png', 'https://www.abplive.com/', NULL, '2023-10-30 03:55:56', '2023-10-30 03:55:56'),
(5, 'Sit aperiam aut eaq', 'Vero ut est dolores Vero ut est doloresVero ut est doloresVero ut est doloresVero ut est doloresVero ut est doloresVero ut est dolores', '1698657980.png', 'https://www.abplive.com/', NULL, '2023-10-30 03:56:20', '2023-10-30 03:56:20');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Sybil Daniel', '2023-10-19 02:49:52', '2023-10-19 02:49:52', NULL),
(2, 'Daria Willis', '2023-10-19 02:49:54', '2023-10-19 02:49:54', NULL),
(3, 'Merritt Huffman', '2023-10-19 02:49:57', '2023-10-19 02:49:57', NULL),
(4, 'Figzo', '2023-10-25 23:47:05', '2023-10-25 23:47:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `products_id` bigint(20) UNSIGNED NOT NULL,
  `size_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `payment_status` tinyint(1) NOT NULL DEFAULT 0,
  `checked_out_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `customer_id`, `products_id`, `size_id`, `order_id`, `quantity`, `payment_status`, `checked_out_at`, `created_at`, `updated_at`) VALUES
(17, 1, 5, 5, 18, 3, 1, NULL, '2023-10-31 03:08:30', '2023-11-02 01:34:39'),
(19, 1, 6, 6, 18, 2, 1, NULL, '2023-10-31 05:23:54', '2023-11-02 01:34:39'),
(20, 1, 8, 8, 18, 1, 1, NULL, '2023-11-01 06:22:19', '2023-11-02 01:34:39'),
(21, 1, 6, 6, 19, 1, 1, NULL, '2023-11-02 01:36:12', '2023-11-02 01:36:18');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `visible` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`, `visible`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Solar Carport', '1698734771.png', 'true', '2023-10-19 02:47:43', '2023-10-31 01:16:11', NULL),
(2, 'Solar', '1698734782.png', 'true', '2023-10-19 02:47:55', '2023-10-31 01:16:22', NULL),
(3, 'Carport', '1698734789.png', 'true', '2023-10-19 02:48:35', '2023-10-31 01:16:29', NULL),
(4, 'Sunpower', '1698734798.png', 'true', '2023-10-19 02:48:48', '2023-10-31 01:16:38', NULL),
(5, 'Solar Carports', '1697703565.png', 'false', '2023-10-19 02:49:25', '2023-10-19 02:49:33', '2023-10-19 02:49:33'),
(6, 'Energie', '1698734806.png', 'true', '2023-10-25 04:08:55', '2023-10-31 01:16:46', NULL),
(7, 'Sunenergie', '1698734814.png', 'true', '2023-10-25 04:09:21', '2023-10-31 01:16:54', NULL),
(8, 'Kyle Hood', '1699011702.png', NULL, '2023-11-03 06:11:43', '2023-11-03 06:11:43', NULL),
(9, 'Home solar panels', '1699012760.png', NULL, '2023-11-03 06:29:20', '2023-11-03 06:29:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `message` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` longtext DEFAULT NULL,
  `address` mediumtext DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `customer_id` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `image`, `address`, `phone`, `password`, `remember_token`, `created_at`, `updated_at`, `customer_id`, `email_verified_at`) VALUES
(1, 'Pritam', 'pritam@gmail.com', '1698320801.png', 'qewq', '1231231231', '$2y$10$hCgniRQRK9DgA.qhx29WpuC1S6eHPH7i176Ib7khzdxvD1OzAhe5i', NULL, '2023-10-19 02:57:03', '2023-10-26 06:17:22', 'CS-001', NULL),
(2, 'Gopal Makwana', 'gopal@gmail.com', NULL, NULL, NULL, '$2y$10$EgmWIAEQ6k7/lGUuicUTPOwfac8G3unrqHujvxOmWNLwmKAT5C28q', NULL, '2023-10-19 02:58:30', '2024-01-03 01:34:11', 'CS-002', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `email_otps`
--

CREATE TABLE `email_otps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `otp` varchar(255) NOT NULL,
  `created_at` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_otps`
--

INSERT INTO `email_otps` (`id`, `email`, `otp`, `created_at`) VALUES
(1, 'pritamphp.quantumitinnovation@gmail.com', '599337', 1704265595);

-- --------------------------------------------------------

--
-- Table structure for table `enquiries`
--

CREATE TABLE `enquiries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `message` longtext NOT NULL,
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
-- Table structure for table `home_page_banners`
--

CREATE TABLE `home_page_banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_page_banners`
--

INSERT INTO `home_page_banners` (`id`, `image`, `created_at`, `updated_at`) VALUES
(13, '1699009903.png', '2023-11-03 05:41:43', '2023-11-03 05:41:43'),
(14, '1699009913.png', '2023-11-03 05:41:53', '2023-11-03 05:41:53');

-- --------------------------------------------------------

--
-- Table structure for table `image_galleries`
--

CREATE TABLE `image_galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `image_galleries`
--

INSERT INTO `image_galleries` (`id`, `image`, `created_at`, `updated_at`) VALUES
(3, '1698657805.png', '2023-10-30 03:53:25', '2023-10-30 03:53:25'),
(4, '1698657810.png', '2023-10-30 03:53:30', '2023-10-30 03:53:30'),
(5, '1698657816.png', '2023-10-30 03:53:36', '2023-10-30 03:53:36'),
(6, '1698657822.png', '2023-10-30 03:53:42', '2023-10-30 03:53:42'),
(7, '1698657827.png', '2023-10-30 03:53:47', '2023-10-30 03:53:47'),
(8, '1698657833.png', '2023-10-30 03:53:53', '2023-10-30 03:53:53');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_09_14_101431_create_categories_table', 1),
(7, '2023_09_14_102334_add_soft_delete_to_categories_table', 1),
(8, '2023_09_18_120249_add_role_to_users_table', 1),
(9, '2023_09_19_054110_modify_role_to_users', 1),
(10, '2023_09_19_084348_create_email_otps_table', 1),
(11, '2023_09_20_052253_create_products_table', 1),
(12, '2023_09_20_084609_add_soft_delete_to_products_table', 1),
(13, '2023_09_20_105409_update_discount_to_products_table', 1),
(14, '2023_09_20_113905_update_specification_to_products_table', 1),
(15, '2023_09_21_101028_create_customers_table', 1),
(16, '2023_09_26_050052_add_image_and_visible_to_categories_table', 1),
(17, '2023_09_26_051530_add_position_visible_to_categories_table', 1),
(18, '2023_09_26_100607_create_contact_us_table', 1),
(19, '2023_09_26_122200_add_position_visible_to_products_table', 1),
(20, '2023_09_27_090251_create_size_quantities_table', 1),
(21, '2023_09_27_091420_add_product_images_to_products_table', 1),
(22, '2023_09_27_091634_create_enquiries_table', 1),
(23, '2023_09_28_093122_create_brands_table', 1),
(24, '2023_09_28_093327_add_brand_to_products_table', 1),
(25, '2023_09_29_093546_add_soft_delete_to_brands_table', 1),
(26, '2023_10_04_052021_create_roles_table', 1),
(27, '2023_10_04_052034_add_roles_to_users_table', 1),
(28, '2023_10_04_061042_add_customer_id_to_customers_table', 1),
(29, '2023_10_05_065910_create_order_table', 1),
(30, '2023_10_05_070014_create_cart_table', 1),
(31, '2023_10_05_070216_add_shipping_to_products_table', 1),
(32, '2023_10_05_114804_add_status_to__size_quantities_table', 1),
(33, '2023_10_06_063100_add_phone_address_to_customers_table', 1),
(34, '2023_10_06_121509_create_statuses_table', 1),
(35, '2023_10_06_121736_add_status_to_cart_table', 1),
(36, '2023_10_12_101231_create_return_product_table', 1),
(37, '2023_10_13_093905_create_tags_table', 1),
(38, '2023_10_13_094111_add_tags_to_products_table', 1),
(39, '2023_10_25_105918_add_latest_to_products_table', 2),
(40, '2023_10_26_043741_create_newsletters_table', 3),
(41, '2023_10_26_060016_create_blogs_table', 4),
(42, '2023_10_26_060045_create_testimonials_table', 4),
(43, '2023_10_26_060127_create_image_galleries_table', 4),
(44, '2023_10_26_060212_create_home_page_banners_table', 4),
(46, '2023_10_30_121904_add_pdf_to_blogs_table', 5),
(47, '2023_10_31_050521_add_email_verified_at_to_customers', 5),
(48, '2023_11_01_050219_create_about_us_table', 5),
(49, '2023_11_01_050308_create_privacy_policies_table', 6),
(50, '2023_11_01_063440_create_order_statuses_table', 7),
(51, '2023_11_01_071404_add_order_status_to_carts_table', 7),
(52, '2023_11_01_103134_add_bulk_to_order_status_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `newsletters`
--

CREATE TABLE `newsletters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `newsletters`
--

INSERT INTO `newsletters` (`id`, `email`, `created_at`, `updated_at`) VALUES
(1, 'pritam@gmail.com', '2023-10-25 23:44:30', '2023-10-25 23:44:30'),
(2, 'pritam1@gmail.com', '2023-10-25 23:46:33', '2023-10-25 23:46:33'),
(3, 'pritam2@gmail.com', '2023-10-25 23:48:13', '2023-10-25 23:48:13');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `bunch` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `order_id`, `customer_id`, `bunch`, `created_at`, `updated_at`) VALUES
(18, 'ORD-761625', '1', 0, '2023-11-02 01:34:39', '2023-11-02 03:16:44'),
(19, 'ORD-696666', '1', 0, '2023-11-02 01:36:18', '2023-11-02 01:36:42');

-- --------------------------------------------------------

--
-- Table structure for table `order_statuses`
--

CREATE TABLE `order_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cart_id` bigint(20) UNSIGNED NOT NULL,
  `bulk` tinyint(1) NOT NULL DEFAULT 0,
  `status` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`status`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
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
-- Table structure for table `privacy_policies`
--

CREATE TABLE `privacy_policies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `privacy_policies`
--

INSERT INTO `privacy_policies` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, '<b>p</b>Privacy Policy', '<b>p</b>Privacy Policy Description', '2023-10-31 23:44:39', '2023-11-01 00:48:18');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `specification` longtext NOT NULL,
  `price` int(11) NOT NULL,
  `discount` int(11) DEFAULT NULL,
  `image` mediumtext NOT NULL,
  `product_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`product_images`)),
  `material` varchar(255) NOT NULL,
  `visible` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `shipping` int(11) NOT NULL DEFAULT 0,
  `tags` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`tags`)),
  `latest` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `brand_id`, `category_id`, `product_id`, `product_name`, `specification`, `price`, `discount`, `image`, `product_images`, `material`, `visible`, `created_at`, `updated_at`, `deleted_at`, `shipping`, `tags`, `latest`) VALUES
(5, 4, 2, 'PD-001', 'Deborah  Shields Shieldsv Shields', 'Nihil ea mollitia la', 571, 38, '1698832907.png', '[\"1698734352242.png\",\"1698734352947.png\",\"1698734352302.png\",\"1698832881316.png\"]', 'Nulla aliqua Necess', 'true', '2023-10-31 01:09:12', '2023-11-01 05:07:21', NULL, 20, '[\"September Reid\",\"Keefe Christensen\"]', 0),
(6, 3, 1, 'PD-006', 'Ursula Schwartz', 'Est sed facere fugia', 679, 56, '1698734374.png', '[\"1698734374567.png\",\"1698734374492.png\",\"1698734374603.png\"]', 'Non atque distinctio', NULL, '2023-10-31 01:09:34', '2023-10-31 01:10:13', NULL, 9, '[\"September Reid\",\"Keefe Christensen\"]', 1),
(7, 4, 1, 'PD-007', 'Macaulay Curtis', 'Eaque in magnam tene', 934, 39, '1698734391.png', '[\"1698734392643.png\",\"1698734392302.png\",\"1698734392615.png\"]', 'Nisi pariatur Quis', NULL, '2023-10-31 01:09:52', '2023-10-31 01:10:12', NULL, 15, '[\"Regina Mccarty\",\"September Reid\",\"Keefe Christensen\"]', 1),
(8, 3, 2, 'PD-008', 'Brynne Herman', 'Sed esse qui eaque t', 54, 60, '1698734408.png', '[\"1698734408201.png\",\"1698734408728.png\",\"1698734408757.png\"]', 'Earum aliquid fugiat', 'true', '2023-10-31 01:10:08', '2023-10-31 01:10:15', NULL, 2, '[\"Regina Mccarty\",\"September Reid\"]', 1);

-- --------------------------------------------------------

--
-- Table structure for table `return_product`
--

CREATE TABLE `return_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `cart_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `comments` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', NULL, NULL),
(2, 'Manager ', NULL, NULL),
(3, 'Sub Admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `size_quantities`
--

CREATE TABLE `size_quantities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `size` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `products_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `size_quantities`
--

INSERT INTO `size_quantities` (`id`, `size`, `quantity`, `products_id`, `created_at`, `updated_at`, `status`) VALUES
(5, '445', 808, 5, '2023-10-31 01:09:12', '2023-11-02 01:34:39', 1),
(6, '342', 383, 6, '2023-10-31 01:09:34', '2023-11-02 01:36:18', 1),
(7, '299', 626, 7, '2023-10-31 01:09:52', '2023-10-31 01:09:52', 1),
(8, '60', 758, 8, '2023-10-31 01:10:08', '2023-11-02 01:34:39', 1);

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Regina Mccarty', '2023-10-19 02:50:04', '2023-10-19 02:50:04'),
(2, 'September Reid', '2023-10-19 02:50:06', '2023-10-19 02:50:06'),
(3, 'Keefe Christensen', '2023-10-19 02:50:09', '2023-10-19 02:50:09');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` text NOT NULL,
  `username` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `description`, `username`, `image`, `created_at`, `updated_at`) VALUES
(2, 'pariatCupiditate id pariatCupiditate id pariatCupiditatfffffffffffffffffffffffffffffffffffffffffffff', 'befetadep', '1698900084.png', '2023-10-30 03:52:35', '2023-11-01 23:11:24'),
(3, 'Aut pariatur Esse  Aut pariatur Esse Aut pariatur Esse Aut pariatur Esse Aut pariggggggggggggggggggg', 'fymyre', '1698900101.png', '2023-10-30 03:52:49', '2023-11-01 23:11:41'),
(4, 'Ipsum aliqua Hic Na Ipsum aliqua Hic NaIpsum aliqua Hic Na', 'tiduqeliv', '1698900109.png', '2023-10-31 01:08:49', '2023-11-01 23:11:49'),
(5, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibu', 'daw daaw', '1698901287.png', '2023-11-01 23:31:27', '2023-11-01 23:31:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', 'admin@admin.com', NULL, '$2y$10$l4LF4L21M5BX4WWYQRbQ3.YQYStrMlFdWuGCZGb1R0iNbDvdf9yza', NULL, '2023-10-19 02:43:25', '2024-01-03 01:37:11'),
(2, 2, 'gopal makwana', 'gopal@gmail.com', NULL, '$2y$10$XngbGbK44jBCxHWj4W4VkeW0fnCypg70KYPiauuo2JIVNK/tNqEuG', NULL, '2023-11-06 03:38:09', '2024-01-03 03:39:58'),
(3, 2, 'PRITAMBHAI PRAVINBHAI MAKWANA', 'pritamphp@wd.com', NULL, '$2y$10$OKXU3OPxICdTJYQb2BHeNuTeQBq8g1DslTDLpkYv8XIGl1keIDnMy', NULL, '2024-01-03 02:45:03', '2024-01-03 02:45:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_customer_id_foreign` (`customer_id`),
  ADD KEY `cart_products_id_foreign` (`products_id`),
  ADD KEY `cart_size_id_foreign` (`size_id`),
  ADD KEY `cart_order_id_foreign` (`order_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_email_unique` (`email`);

--
-- Indexes for table `email_otps`
--
ALTER TABLE `email_otps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email_otps_email_index` (`email`);

--
-- Indexes for table `enquiries`
--
ALTER TABLE `enquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `home_page_banners`
--
ALTER TABLE `home_page_banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image_galleries`
--
ALTER TABLE `image_galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_statuses`
--
ALTER TABLE `order_statuses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_statuses_cart_id_foreign` (`cart_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

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
-- Indexes for table `privacy_policies`
--
ALTER TABLE `privacy_policies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `return_product`
--
ALTER TABLE `return_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `return_product_order_id_foreign` (`order_id`),
  ADD KEY `return_product_cart_id_foreign` (`cart_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_role_name_unique` (`role_name`);

--
-- Indexes for table `size_quantities`
--
ALTER TABLE `size_quantities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `size_quantities_products_id_foreign` (`products_id`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `email_otps`
--
ALTER TABLE `email_otps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `enquiries`
--
ALTER TABLE `enquiries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `home_page_banners`
--
ALTER TABLE `home_page_banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `image_galleries`
--
ALTER TABLE `image_galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `order_statuses`
--
ALTER TABLE `order_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `privacy_policies`
--
ALTER TABLE `privacy_policies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `return_product`
--
ALTER TABLE `return_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `size_quantities`
--
ALTER TABLE `size_quantities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `cart_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`),
  ADD CONSTRAINT `cart_products_id_foreign` FOREIGN KEY (`products_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `cart_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `size_quantities` (`id`);

--
-- Constraints for table `order_statuses`
--
ALTER TABLE `order_statuses`
  ADD CONSTRAINT `order_statuses_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `return_product`
--
ALTER TABLE `return_product`
  ADD CONSTRAINT `return_product_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `return_product_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `size_quantities`
--
ALTER TABLE `size_quantities`
  ADD CONSTRAINT `size_quantities_products_id_foreign` FOREIGN KEY (`products_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
