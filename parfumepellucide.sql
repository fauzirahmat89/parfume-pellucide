-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2025 at 07:10 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parfumepellucide`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-356a192b7913b04c54574d18c28d46e6395428ab', 'i:1;', 1764994707),
('laravel-cache-356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1764994707;', 1764994707),
('laravel-cache-5c785c036466adea360111aa28563bfd556b5fba', 'i:3;', 1765523647),
('laravel-cache-5c785c036466adea360111aa28563bfd556b5fba:timer', 'i:1765523647;', 1765523647),
('laravel-cache-chat:product_context', 's:1042:\"Katalog ringkas Pellucide (jangan tampilkan mentah; jawab singkat):\n- Day Cream | Cream | 10 ml | Rp 89.000 | Mencerahkan Kulit Yang Kusam; Melembabkan Kulit\n- Night Cream | Cream | 10 ml | Rp 89.000 | Mencerahkan Wajah; Membuat Wajah Menjadi Glowing\n- Facial Wash | Cleanser | 100 ml | Rp 125.000 | Mencerahkan Kulit Secara Maksimal; Membersihkan Wajah Dari Kotoran, Minyak dan Debu\n- Toner | Toner | 100 ml | Rp 99.000 | Mengecilkan Pori-pori Wajah; Menyeimbangkan PH Kulit\n- HB Brightening | Serum | 100 ml | Rp 149.000 | Menjaga Kelembaban Kulit; Membantu Mencerahkan Warna Kulit\n- Vitamin C + Salmon DNA Serum | Serum | 10 ml | Rp 175.000 | Salmon DNA 10x Lebih Baik Dari Kolagen Biasa; Menyehatkan Kulit\n- AHA Booster Serum | Serum | 10 ml | Rp 165.000 | Membantu Merangsang Produksi Kolagen; Meratakan Warna Kulit\n- Brightening + Ceramide Serum | Serum | 10 ml | Rp 165.000 | Melembabkan Kulit; Menghaluskan Tekstur Kulit\n- Eye Cream | Cream | 10 ml | Rp 135.000 | Meningkatkan Kekencangan Kulit; Mengurangi Garis Halus di Sekitar Mata\";', 1765524189);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_12_05_000001_create_products_table', 2),
(5, '2025_12_05_000002_create_settings_table', 2),
(6, '2025_12_05_000003_add_role_to_users_table', 3),
(7, '2025_12_05_000004_create_product_images_table', 4),
(8, '2025_12_05_000005_backfill_product_images', 5);

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `size` varchar(50) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `category` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `benefits` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`benefits`)),
  `image` varchar(255) DEFAULT NULL,
  `is_hot` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `shopee_link` varchar(500) DEFAULT NULL,
  `tokopedia_link` varchar(500) DEFAULT NULL,
  `whatsapp_number` varchar(20) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `size`, `price`, `category`, `description`, `benefits`, `image`, `is_hot`, `is_active`, `shopee_link`, `tokopedia_link`, `whatsapp_number`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'Day Cream', 'day-cream', '10 ml', 89000.00, 'Cream', 'Day Cream Pellucide untuk perlindungan kulit siang hari.', '[\"Mencerahkan Kulit Yang Kusam\",\"Melembabkan Kulit\",\"Melindungi Kulit Dari Paparan Sinar UV\",\"Merawat Kekencangan Kulit\",\"Menenangkan Kulit Yang Iritasi\"]', 'products/FBYjj4q3gYoLPCImMuzg380BIZBCYu0DYr4WWcOX.webp', 1, 1, 'https://shopee.co.id/pellucide', 'https://tokopedia.com/pellucide', '6281234567890', 1, '2025-12-05 04:28:10', '2025-12-17 05:45:17'),
(2, 'Night Cream', 'night-cream', '10 ml', 89000.00, 'Cream', 'Night Cream untuk nutrisi maksimal saat tidur.', '[\"Mencerahkan Wajah\",\"Membuat Wajah Menjadi Glowing\",\"Menghilangkan Noda di Wajah\",\"Melembabkan Kulit Wajah\",\"Merawat Kekencangan Kulit\",\"Menghaluskan dan Menutrisi Kulit\",\"Mencegah Tanda Penuaan Pada Kulit\"]', 'products/EbJomvBbrBNQseqBf4uYdQag1jnPMhhV1TMvh9JZ.webp', 1, 1, 'https://shopee.co.id/pellucide', 'https://tokopedia.com/pellucide', '6281234567890', 2, '2025-12-05 04:28:10', '2025-12-17 05:47:11'),
(3, 'Facial Wash', 'facial-wash', '100 ml', 125000.00, 'Cleanser', 'Facial wash lembut untuk kulit bersih dan cerah.', '[\"Mencerahkan Kulit Secara Maksimal\",\"Membersihkan Wajah Dari Kotoran, Minyak dan Debu\",\"Mengangkat Minyak Berlebih\"]', 'products/uPD0q673K8MTgbJzyw2VfNQfRmfuFixJMGXG2dvN.webp', 1, 1, 'https://shopee.co.id/pellucide', 'https://tokopedia.com/pellucide', '6281234567890', 3, '2025-12-05 04:28:10', '2025-12-17 05:48:19'),
(4, 'Toner', 'toner', '100 ml', 99000.00, 'Toner', 'Toner menyeimbangkan pH untuk kulit sehat.', '[\"Mengecilkan Pori-pori Wajah\",\"Menyeimbangkan PH Kulit\",\"Melembabkan dan Menyegarkan Kulit\",\"Mengurangi Jerawat\",\"Mendetoksifikasi Kulit\"]', 'products/eRro5T7PDb0blp6Ni0QCcxhCoGT9IluynB4eHh8L.webp', 1, 1, 'https://shopee.co.id/pellucide', 'https://tokopedia.com/pellucide', '6281234567890', 4, '2025-12-05 04:28:10', '2025-12-17 05:49:26'),
(5, 'HB Brightening', 'hb-brightening', '100 ml', 149000.00, 'Serum', 'Serum brightening untuk kulit cerah dan lembap.', '[\"Menjaga Kelembaban Kulit\",\"Membantu Mencerahkan Warna Kulit\",\"Merawat Kekencangan Kulit\",\"Menjaga Elastisitas Kulit\",\"Melindungi Kulit Dari Efek Buruk Sinar UV\"]', 'products/wYcffzER4ONDIQdfBPTKa5xJ6PDZowyBGvjl2Q3d.webp', 0, 1, 'https://shopee.co.id/pellucide', 'https://tokopedia.com/pellucide', '6281234567890', 5, '2025-12-05 04:28:10', '2025-12-17 05:49:46'),
(6, 'Vitamin C + Salmon DNA Serum', 'vitamin-c-salmon-dna-serum', '10 ml', 175000.00, 'Serum', 'Serum Vitamin C + Salmon DNA untuk kulit sehat bercahaya.', '[\"Salmon DNA 10x Lebih Baik Dari Kolagen Biasa\",\"Menyehatkan Kulit\",\"Mencerahkan Kulit\",\"Meratakan Tekstur Kulit\",\"Menghilangkan Flek Hitam\",\"Menjaga Kekencangan Kulit\",\"Menjaga Kekenyalan Kulit\"]', 'products/nIDBcKvHjHtPp22KwUEXimtHYDcMN6et69xSQqjj.webp', 0, 1, 'https://shopee.co.id/pellucide', 'https://tokopedia.com/pellucide', '6281234567890', 6, '2025-12-05 04:28:10', '2025-12-17 05:50:06'),
(7, 'AHA Booster Serum', 'aha-booster-serum', '10 ml', 165000.00, 'Serum', 'Booster AHA untuk tekstur kulit lebih halus.', '[\"Membantu Merangsang Produksi Kolagen\",\"Meratakan Warna Kulit\",\"Membantu Proses Pengelupasan Kulit\",\"Memudarkan Garis-garis Halus dan Kerut\",\"Memudarkan Bintik Hitam dan Bekas Luka\",\"Mengurangi Pembesaran Pori-pori kulit\",\"Mengurangi Efek Penuaan\",\"Membantu Efektifitas Penyerapan Zat Aktif Untuk Perawatan Kulit\"]', 'products/a2AYkggKQHxbzKEyF45VJBU3DcMsfqivm1Xo2ybS.webp', 0, 1, 'https://shopee.co.id/pellucide', 'https://tokopedia.com/pellucide', '6281234567890', 7, '2025-12-05 04:28:10', '2025-12-17 05:50:24'),
(8, 'Brightening + Ceramide Serum', 'brightening-ceramide-serum', '10 ml', 165000.00, 'Serum', 'Serum ceramide untuk barrier kulit kuat dan lembap.', '[\"Melembabkan Kulit\",\"Menghaluskan Tekstur Kulit\",\"Memperkuat Lapisan Pelindung Kulit\",\"Mengurangi Gejala Kulit Kering\",\"Membuat Kulit Glowy dan Kenyal\"]', 'products/rgxGdqCPoEv2eE9NTt7OjwDsIFaaOL95pqxEFjsk.webp', 0, 1, 'https://shopee.co.id/pellucide', 'https://tokopedia.com/pellucide', '6281234567890', 8, '2025-12-05 04:28:10', '2025-12-17 05:51:18'),
(9, 'Eye Cream', 'eye-cream', '10 ml', 135000.00, 'Cream', 'Eye cream untuk area mata kencang dan cerah.', '[\"Meningkatkan Kekencangan Kulit\",\"Mengurangi Garis Halus di Sekitar Mata\",\"Meningkatkan Produksi Kolagen\",\"Meminimalkan dan Mengencangkan Kantung Mata\",\"Meningkatkan Hidrasi dan Kelembaban Kulit\",\"Meregenerasi Sel-sel Kulit di Area Sekitar Mata\",\"Membantu Mencerahkan Area Gelap di Sekitar Mata\"]', 'products/JZFIykcwfUt9TPlq65rSsg8v1Ffi9iRXIMx4j8iD.webp', 0, 1, 'https://shopee.co.id/pellucide', 'https://tokopedia.com/pellucide', '6281234567890', 9, '2025-12-05 04:28:10', '2025-12-17 05:51:52');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `path` varchar(500) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `path`, `sort_order`, `created_at`, `updated_at`) VALUES
(18, 1, 'products/FBYjj4q3gYoLPCImMuzg380BIZBCYu0DYr4WWcOX.webp', 0, '2025-12-17 05:45:16', '2025-12-17 05:45:16'),
(19, 1, 'products/eUfGRtQBb1gTT9TquDW6NpS9WIHHsbuyRu0KVr0B.webp', 1, '2025-12-17 05:45:32', '2025-12-17 05:45:32'),
(20, 2, 'products/EbJomvBbrBNQseqBf4uYdQag1jnPMhhV1TMvh9JZ.webp', 0, '2025-12-17 05:46:59', '2025-12-17 05:47:11'),
(21, 2, 'products/yCiwsZRaClKlghYmqoKtoN7K2TmPVuldrOCdYXyf.webp', 1, '2025-12-17 05:46:59', '2025-12-17 05:47:11'),
(22, 3, 'products/uPD0q673K8MTgbJzyw2VfNQfRmfuFixJMGXG2dvN.webp', 0, '2025-12-17 05:48:19', '2025-12-17 05:48:19'),
(23, 3, 'products/7UWaCM6g0ffykDCvfsqgBDojZb9yu6aoBJn2uLro.webp', 1, '2025-12-17 05:48:19', '2025-12-17 05:48:19'),
(24, 4, 'products/eRro5T7PDb0blp6Ni0QCcxhCoGT9IluynB4eHh8L.webp', 0, '2025-12-17 05:49:26', '2025-12-17 05:49:26'),
(25, 4, 'products/orQGUEfcvCRAhXrYLUiFyqvYMQadkc3ELnX23xvi.webp', 1, '2025-12-17 05:49:26', '2025-12-17 05:49:26'),
(26, 5, 'products/wYcffzER4ONDIQdfBPTKa5xJ6PDZowyBGvjl2Q3d.webp', 0, '2025-12-17 05:49:45', '2025-12-17 05:49:45'),
(27, 5, 'products/tetcIgRXHeEOgeLeKQnpA5eDxq720kZwpCmzlu0C.webp', 1, '2025-12-17 05:49:46', '2025-12-17 05:49:46'),
(28, 6, 'products/nIDBcKvHjHtPp22KwUEXimtHYDcMN6et69xSQqjj.webp', 0, '2025-12-17 05:50:06', '2025-12-17 05:50:06'),
(29, 6, 'products/2phj6pqgSmnKwNdcuHXSqVdMHkjNXnRN9P8cFnTg.webp', 1, '2025-12-17 05:50:06', '2025-12-17 05:50:06'),
(30, 7, 'products/a2AYkggKQHxbzKEyF45VJBU3DcMsfqivm1Xo2ybS.webp', 0, '2025-12-17 05:50:24', '2025-12-17 05:50:24'),
(31, 7, 'products/l77SSbUwMDtP0Ixoz6vdUnyvdkLMVfyEZkOoHi0o.webp', 1, '2025-12-17 05:50:24', '2025-12-17 05:50:24'),
(32, 8, 'products/rgxGdqCPoEv2eE9NTt7OjwDsIFaaOL95pqxEFjsk.webp', 0, '2025-12-17 05:51:18', '2025-12-17 05:51:18'),
(33, 8, 'products/TtArTe9H5bBMijUYFVnDbvNTMRnSyGh3ANTgirQ0.webp', 1, '2025-12-17 05:51:18', '2025-12-17 05:51:18'),
(34, 9, 'products/JZFIykcwfUt9TPlq65rSsg8v1Ffi9iRXIMx4j8iD.webp', 0, '2025-12-17 05:51:34', '2025-12-17 05:51:52'),
(35, 9, 'products/xPV3yZuzkiPH4SzRwaa71GgeiYaunjbZx7i03iWu.webp', 1, '2025-12-17 05:51:34', '2025-12-17 05:51:52');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('nXLKqQYiyuzdscyuA0XO0dq0Vh2zP2fUCXFRg0cZ', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZlB5Znh6Q3N3a1E0Vk9NREFFZHZDSGkzY0oxRzA1aTIzMjNaNWtsNyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9wcm9kdWN0cy81L2VkaXQiO3M6NToicm91dGUiO3M6MTk6ImFkbWluLnByb2R1Y3RzLmVkaXQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1765976863),
('W3QPIFFMb3gX54MxGVy5ZucvULweDacyDzuu9Y1S', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiT1R6aldXenFxbGVlS28zWjBvWG5BVnRRMGVCdnIyaFFBRVRuU3VRMiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1766025843);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Pellucide', 'admin@pellucide.com', NULL, '$2y$12$CgCCRmBjPaYhOLeK434qreSqOgLng1D2otYFLyro37sAKdC4n3m3y', 'admin', 'B99YDGm8CgaU6g69zCz2pQxmLTGTF4Ig63yxU26vzqpO9D1POxZqkftoRutF', '2025-12-05 04:27:54', '2025-12-05 09:03:37');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
