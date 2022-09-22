-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2022 at 12:01 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pms1`
--

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `total_price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`id`, `date`, `total_price`, `created_at`, `updated_at`) VALUES
(1, '2022-07-13', 46000, '2022-07-13 11:18:49', '2022-07-13 11:18:49'),
(2, '2022-07-13', 1530000, '2022-07-13 12:15:07', '2022-07-13 12:15:07');

-- --------------------------------------------------------

--
-- Table structure for table `bill_drug`
--

CREATE TABLE `bill_drug` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bill_id` bigint(20) UNSIGNED NOT NULL,
  `drug_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bill_drug`
--

INSERT INTO `bill_drug` (`id`, `bill_id`, `drug_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, NULL, NULL),
(2, 1, 2, 4, NULL, NULL),
(3, 1, 3, 2, NULL, NULL),
(4, 2, 1, 108, NULL, NULL),
(5, 2, 2, 4, NULL, NULL),
(6, 2, 3, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `drugs`
--

CREATE TABLE `drugs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body_system` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `expiration_date` date NOT NULL,
  `quantity` int(11) NOT NULL,
  `form` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dose` double(8,2) NOT NULL,
  `price_for_public` int(11) NOT NULL,
  `place` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prescription` tinyint(1) NOT NULL DEFAULT 0,
  `scientific_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `drugs`
--

INSERT INTO `drugs` (`id`, `name`, `company`, `body_system`, `price`, `expiration_date`, `quantity`, `form`, `dose`, `price_for_public`, `place`, `prescription`, `scientific_name`, `created_at`, `updated_at`) VALUES
(1, 'sleep K', 'mous', 'head', 1500, '2022-07-20', 16, 'drink', 1000.00, 14000, 'a1 b4', 1, 'i dont fucking know i not a fucking doctor', '2022-07-13 10:46:45', '2022-08-13 13:35:03'),
(2, 'sleep dose', 'mous', 'head', 1500, '2022-10-02', 82, 'drink', 1000.00, 3500, 'a1 b4', 1, 'i dont fucking know i not a fucking doctor', '2022-07-13 10:47:05', '2022-08-13 13:35:03'),
(3, 'sleep act', 'mous', 'head', 1500, '2022-12-15', 61, 'drink', 1000.00, 2000, 'a1 b4', 0, 'i dont fucking know i not a fucking doctor', '2022-07-13 10:47:44', '2022-08-13 13:35:03');

-- --------------------------------------------------------

--
-- Table structure for table `drug_order`
--

CREATE TABLE `drug_order` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `drug_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `drug_order`
--

INSERT INTO `drug_order` (`id`, `order_id`, `drug_id`, `created_at`, `updated_at`, `quantity`) VALUES
(1, 1, 1, NULL, NULL, '50'),
(2, 1, 2, NULL, NULL, '50'),
(3, 1, 3, NULL, NULL, '50'),
(4, 2, 1, NULL, NULL, '5'),
(5, 2, 2, NULL, NULL, '5'),
(6, 2, 3, NULL, NULL, '5'),
(7, 3, 1, NULL, NULL, '5'),
(8, 3, 2, NULL, NULL, '5'),
(9, 3, 3, NULL, NULL, '5'),
(10, 4, 1, NULL, NULL, '5'),
(11, 4, 2, NULL, NULL, '5'),
(12, 4, 3, NULL, NULL, '5');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_05_20_173447_create_suppliers_table', 1),
(6, '2022_05_21_182641_create_drugs_table', 1),
(7, '2022_05_22_060532_create_orders_table', 1),
(8, '2022_05_22_182012_create_drug_order_table', 1),
(9, '2022_05_23_145632_create_roles_table', 1),
(10, '2022_06_04_114020_add_quantity_to_drug_order_table', 1),
(11, '2022_06_23_143019_create_bills_table', 1),
(12, '2022_07_08_125124_create_bill_drug_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `supplier_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `total_price` int(11) NOT NULL,
  `paid` int(11) NOT NULL,
  `remaining` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `supplier_id`, `supplier_name`, `date`, `total_price`, `paid`, `remaining`, `created_at`, `updated_at`) VALUES
(1, 1, 'abwl', '2022-07-13', 975000, 20000, 955000, '2022-07-13 11:22:22', '2022-07-13 11:22:22'),
(2, 1, 'abwl', '2022-07-13', 97500, 20000, 77500, '2022-07-13 13:24:22', '2022-07-13 13:24:22'),
(3, 1, 'abwl', '2022-08-13', 97500, 25000, 72500, '2022-08-13 13:34:52', '2022-08-13 13:34:52'),
(4, 1, 'abwl', '2022-08-13', 97500, 30000, 67500, '2022-08-13 13:35:03', '2022-08-13 13:35:03');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'auth_token', '5f439f411801a0ae0ba1531bc7ec7c79f385145fcc5d8b22919b9bf070b7124e', '[\"*\"]', NULL, '2022-07-13 10:44:58', '2022-07-13 10:44:58'),
(2, 'App\\Models\\User', 2, 'auth_token', 'b4cfc03916cbf293eea62dad2fca1b7bed214ca23b3c4b578f9dfa964df8d3c5', '[\"*\"]', NULL, '2022-07-13 10:45:12', '2022-07-13 10:45:12');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `loans` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `company`, `email`, `phone_number`, `loans`, `created_at`, `updated_at`) VALUES
(1, 'walter', 'newShit', 'new@gamil.com', '0938306656', 272500, '2022-07-13 11:21:29', '2022-08-13 13:35:03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pharmacy_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` enum('Male','Female','Unspecified') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `pharmacy_name`, `date_of_birth`, `gender`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'waleed123', 'waleed123@gmail.com', '$2y$10$MNByfB6/3kW3i2k6yPa3fev3YqDonOhMg0on30rHTe7tup8a25pKK', 'pms', '1999-12-04', 'Male', NULL, '2022-07-13 10:44:58', '2022-07-13 10:44:58'),
(2, 'waleed123', 'waleed1234@gmail.com', '$2y$10$03T4vIi0C8JIMOGd9Um04OtjE6zqZH/Ka3bSi8DMX2gr.FDtwiKPa', 'pms', '1999-12-04', 'Unspecified', NULL, '2022-07-13 10:45:12', '2022-07-13 10:45:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bill_drug`
--
ALTER TABLE `bill_drug`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_drug_bill_id_foreign` (`bill_id`),
  ADD KEY `bill_drug_drug_id_foreign` (`drug_id`);

--
-- Indexes for table `drugs`
--
ALTER TABLE `drugs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drug_order`
--
ALTER TABLE `drug_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `drug_order_order_id_foreign` (`order_id`),
  ADD KEY `drug_order_drug_id_foreign` (`drug_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_supplier_id_foreign` (`supplier_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `suppliers_email_unique` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bill_drug`
--
ALTER TABLE `bill_drug`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `drugs`
--
ALTER TABLE `drugs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `drug_order`
--
ALTER TABLE `drug_order`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bill_drug`
--
ALTER TABLE `bill_drug`
  ADD CONSTRAINT `bill_drug_bill_id_foreign` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bill_drug_drug_id_foreign` FOREIGN KEY (`drug_id`) REFERENCES `drugs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `drug_order`
--
ALTER TABLE `drug_order`
  ADD CONSTRAINT `drug_order_drug_id_foreign` FOREIGN KEY (`drug_id`) REFERENCES `drugs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `drug_order_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
