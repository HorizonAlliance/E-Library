-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 22, 2024 at 12:17 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `digital_library`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` bigint UNSIGNED NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `publisher` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `release_date` datetime NOT NULL,
  `cover` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `synopsis` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_duration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `author`, `publisher`, `category_id`, `release_date`, `cover`, `file`, `synopsis`, `created_at`, `updated_at`, `title`, `read_duration`) VALUES
(1, 'azka', 'naufal', 3, '2024-08-09 00:00:00', 'covers/uKrCNedQ6joi4qMqLVslvsJt4yPoonyDS8Xn4raX.jpg', 'files/hkhZZwFDjzu9VJsu8iqSzlK7wbt32mMUlr5NAb1o.pdf', 'azkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuhazkasepuh', '2024-08-08 13:40:52', '2024-08-08 13:40:52', 'Soul', 7),
(2, 'arrofi', 'Alone', 5, '2024-08-01 00:00:00', 'covers/hURv7y0XEIPZmUDu8Q9AG5bCiLu86ftIh35RT21H.jpg', 'files/13Bn4BCfBNDzFT6kCsG2kOEiU2irdoWvbW8tYmZu.pdf', 'AloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAloneAlone', '2024-08-08 13:45:25', '2024-08-08 13:45:25', 'Memory', 9);

-- --------------------------------------------------------

--
-- Table structure for table `book_suggestions`
--

CREATE TABLE `book_suggestions` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publisher` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `book_suggestions`
--

INSERT INTO `book_suggestions` (`id`, `user_id`, `title`, `author`, `publisher`, `description`, `created_at`, `updated_at`) VALUES
(1, 5, 'The Rise of Majapahit', 'Setyo Wardoyo', 'Grasindo', 'Novel ini menceritakan asal mula berdirinya Kerajaan Majapahit setelah jatuhnya Singasari akibat serangan dari Kerajaan Gelang-Gelang dan Mongolia.', '2024-08-18 06:23:12', '2024-08-18 06:23:12'),
(2, 6, 'Gadis Pantai', 'Pramoedya Ananta Toer', NULL, 'bertutur tentang kehidupan seorang gadis belia yang dilahirkan di sebuah kampung nelayan di Kabupaten Rembang, Jawa Tengah.', '2024-08-21 07:08:29', '2024-08-21 07:08:29');

-- --------------------------------------------------------

--
-- Table structure for table `book_suggestions_likes`
--

CREATE TABLE `book_suggestions_likes` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `suggestions_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `book_suggestions_likes`
--

INSERT INTO `book_suggestions_likes` (`id`, `user_id`, `suggestions_id`, `created_at`, `updated_at`) VALUES
(1, 6, 1, '2024-08-21 06:57:14', '2024-08-21 06:57:14');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Fantasy', '2024-08-08 13:34:31', '2024-08-08 13:34:31'),
(3, 'Fiksi', '2024-08-08 13:35:26', '2024-08-08 13:35:26'),
(4, 'Action', '2024-08-08 13:35:36', '2024-08-08 13:35:36'),
(5, 'Romance', '2024-08-08 13:35:42', '2024-08-08 13:35:42');

-- --------------------------------------------------------

--
-- Table structure for table `collections`
--

CREATE TABLE `collections` (
  `id` bigint UNSIGNED NOT NULL,
  `book_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `collections`
--

INSERT INTO `collections` (`id`, `book_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 5, '2024-08-11 08:08:16', '2024-08-11 08:08:16'),
(2, 2, 5, '2024-08-11 08:55:09', '2024-08-11 08:55:09'),
(3, 1, 6, '2024-08-12 04:45:06', '2024-08-12 04:45:06');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_08_01_004559_create_books_table', 1),
(5, '2024_08_01_004735_create_categories_table', 1),
(6, '2024_08_01_004820_create_reviews_table', 1),
(7, '2024_08_01_005237_create_collections_table', 1),
(8, '2024_08_01_011835_create_permissions_table', 1),
(9, '2024_08_02_064709_modifypermissiontable', 1),
(10, '2024_08_03_141647_modify_table_books', 1),
(11, '2024_08_08_011449_modifty_table_books', 1),
(12, '2024_08_08_035013_add_expirated_to_permissions_table', 1),
(13, '2024_08_09_025046_modify_table_permissions_field_status', 2),
(14, '2024_08_18_064637_create_book_suggestions_table', 3),
(15, '2024_08_18_065815_create_book_suggestions_likes_table', 3),
(16, '2024_08_18_070712_create_book_suggestions', 4),
(17, '2024_08_18_070816_create_book_suggestions', 5),
(18, '2024_08_18_133110_moodify_table_books_suggestions_drop_collumn_likes', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `book_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `librarian` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expirated` timestamp NULL DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `status` enum('proces','decline','accept','expirated') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `user_id`, `book_id`, `created_at`, `updated_at`, `librarian`, `expirated`, `note`, `status`) VALUES
(1, 5, 1, '2024-08-08 19:02:31', '2024-08-10 20:38:45', 'Librariann', '2024-08-07 19:02:31', NULL, 'expirated'),
(2, 5, 2, '2024-08-10 08:54:44', '2024-08-20 08:00:04', 'Adminnnnn', '2024-08-20 00:03:50', NULL, 'expirated'),
(3, 6, 1, '2024-08-21 08:23:54', '2024-08-21 08:27:12', 'Librariann', '2024-08-28 08:27:12', NULL, 'accept');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `book_id` bigint UNSIGNED NOT NULL,
  `ulasan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `book_id`, `ulasan`, `rating`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 'it`s okay', 7, '2024-08-14 12:59:57', '2024-08-14 12:59:57'),
(2, 5, 2, 'very nice', 10, '2024-08-15 07:38:18', '2024-08-15 07:38:18'),
(3, 6, 1, 'i like it', 8, '2024-08-21 08:28:21', '2024-08-21 08:28:21');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('7Z1pJ3ib5RWClTVdqglpTZtSofDqFzdMQCoPTrVt', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36 Edg/127.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiS2VNQ0J0bFBCWGxlZkV2aUVVNERtUGUwRERYNnpNTDlKV3VZOFZIcyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO30=', 1724256249),
('BLMXXSQTzulBLwBc15sdrY4dmXYRKTALNt0flM20', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiaGo4REFRTG0wdVJvQmpQanBET3NraURmRjlKc2ZzWXZncXhRWDFNbCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjY7fQ==', 1724256093);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','librarian','reader') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'reader',
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `address`, `email`, `password`, `role`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Vradita Candra', 'Vradita', 'Mojogedang', 'vradita@gmail.com', '$2y$12$ikZA.8gElhYKu557P.c19.ZWkyG2I5c4JTcqU4Ntf1mQJznxnqnLG', 'reader', '3rUD49CWgMI0B1Q9Xpiv9sYpSfHuNDUA2yPSTWdN.jpg', NULL, '2024-08-08 12:56:01', '2024-08-08 12:56:01'),
(3, 'Adminnnnn', 'Mimin', 'not known', 'Admin@gmail.com', '$2y$12$4Bdh/5dsMkrohXaYAbfdVORR7AMlF4Qe4rlDRWrzzOPZOIAH5D0Bm', 'admin', 'LqY6kQoyL640ykFrmsf3bNGkufKu0eENIggPrdT9.png', NULL, '2024-08-08 12:57:20', '2024-08-21 09:03:44'),
(4, 'Librariann', 'Librarian', 'not known', 'librarian@gmail.com', '$2y$12$b4np5dRB1k7LMwsU6slfLepxOVV1jx7kVZ140s.20.fNRbk5RkVYW', 'librarian', '7Bxr6i0U71gbgeOWNpA8lw0fn8IHoLi8CHj5XjKh.png', NULL, '2024-08-08 12:58:10', '2024-08-08 12:58:10'),
(5, 'Reader', 'Reader', 'unknown', 'reader@gmail.com', '$2y$12$viRg02IR7C298WM4RhAgoOfZFziYy/sbZnpRsZBr0wp4MG0hVMny6', 'reader', '2yiHTcbugmXolkTweoy7d2CUWDbQ7SZOpnX05BSS.png', NULL, '2024-08-08 18:48:04', '2024-08-08 18:48:04'),
(6, 'reader2', 'reader2', 'ntah bro', 'reader2@gmail.com', '$2y$12$gCxQNwjOYZyRE5rZVGrDBu0OWS5xWgI669OjN5j1938k.664vrKOm', 'reader', 'CAAj3wBlgQlupUXTC4FULnERnuHwDLR2cXGcXuAR.jpg', NULL, '2024-08-12 04:44:45', '2024-08-12 04:44:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_suggestions`
--
ALTER TABLE `book_suggestions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_suggestions_user_id_foreign` (`user_id`);

--
-- Indexes for table `book_suggestions_likes`
--
ALTER TABLE `book_suggestions_likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_suggestions_likes_user_id_foreign` (`user_id`),
  ADD KEY `book_suggestions_likes_suggestions_id_foreign` (`suggestions_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collections`
--
ALTER TABLE `collections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `collections_book_id_foreign` (`book_id`),
  ADD KEY `collections_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_user_id_foreign` (`user_id`),
  ADD KEY `permissions_book_id_foreign` (`book_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_book_id_foreign` (`book_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `book_suggestions`
--
ALTER TABLE `book_suggestions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `book_suggestions_likes`
--
ALTER TABLE `book_suggestions_likes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `collections`
--
ALTER TABLE `collections`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book_suggestions`
--
ALTER TABLE `book_suggestions`
  ADD CONSTRAINT `book_suggestions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `book_suggestions_likes`
--
ALTER TABLE `book_suggestions_likes`
  ADD CONSTRAINT `book_suggestions_likes_suggestions_id_foreign` FOREIGN KEY (`suggestions_id`) REFERENCES `book_suggestions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `book_suggestions_likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `collections`
--
ALTER TABLE `collections`
  ADD CONSTRAINT `collections_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `collections_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
