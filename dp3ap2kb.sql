-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 21, 2025 at 03:59 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dp3ap2kb`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` bigint UNSIGNED NOT NULL,
  `log_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` bigint UNSIGNED DEFAULT NULL,
  `causer_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` bigint UNSIGNED DEFAULT NULL,
  `properties` json DEFAULT NULL,
  `batch_uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `event`, `subject_id`, `causer_type`, `causer_id`, `properties`, `batch_uuid`, `created_at`, `updated_at`) VALUES
(1, 'default', 'Dokumen \"gg\" telah deleted', 'App\\Models\\Document', 'deleted', 4, 'App\\Models\\User', 1, '{\"old\": {\"title\": \"gg\"}}', NULL, '2025-11-17 01:46:29', '2025-11-17 01:46:29'),
(2, 'default', 'Pesan dari \"jkbkb\" telah deleted', 'App\\Models\\ContactMessage', 'deleted', 2, 'App\\Models\\User', 1, '{\"old\": {\"name\": \"jkbkb\", \"email\": \"dondisetiawan1234@gmail.com\", \"status\": \"read\", \"message\": \"oinikbjknjk kjbjk onhn kiubk kjunk\", \"subject\": \"nn\"}}', NULL, '2025-11-17 01:49:39', '2025-11-17 01:49:39'),
(3, 'default', 'Pesan dari \"skdbks\" telah created', 'App\\Models\\ContactMessage', 'created', 16, 'App\\Models\\User', 1, '{\"attributes\": {\"name\": \"skdbks\", \"email\": \"300secret@livinitlarge.net\", \"status\": \"unread\", \"message\": \"sdfds  dksnffdsj jskdncds\", \"subject\": \"dfds efsd\"}}', NULL, '2025-11-17 01:50:06', '2025-11-17 01:50:06'),
(4, 'contact_messages', 'Pesan dari \"test\" telah created', 'App\\Models\\ContactMessage', 'created', 17, 'App\\Models\\User', 1, '{\"attributes\": {\"deleted\": null}}', NULL, '2025-11-17 01:52:12', '2025-11-17 01:52:12'),
(5, 'contact_messages', 'Pesan dari \"test\" telah dihapus', 'App\\Models\\ContactMessage', 'deleted', 18, 'App\\Models\\User', 1, '{\"old\": {\"name\": \"test\", \"email\": \"300secret@livinitlarge.net\", \"status\": \"unread\", \"message\": \"akjsa kjadba kjadn alnjd\", \"subject\": \"test again\"}}', NULL, '2025-11-17 01:55:03', '2025-11-17 01:55:03'),
(6, 'contact_messages', 'Pesan dari \"asep\" telah dihapus', 'App\\Models\\ContactMessage', 'deleted', 3, 'App\\Models\\User', 1, '{\"old\": {\"name\": \"asep\", \"email\": \"pasep9984@gmail.com\", \"status\": \"unread\", \"message\": \"akndaoj oaijdioa oaiosndo oaisjdoa aoijdao\", \"subject\": \"sds\"}}', NULL, '2025-11-17 01:55:21', '2025-11-17 01:55:21'),
(7, 'default', 'Berita \"test deskripsi\" telah created', 'App\\Models\\Post', 'created', 4, 'App\\Models\\User', 1, '{\"attributes\": {\"body\": \"<p>Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.</p>\\r\\n<p>Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.</p>\\r\\n<p>Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.</p>\\r\\n<p>Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.</p>\\r\\n<p>Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.</p>\", \"image\": \"posts/QO52BwCArf39mOvdTnvlATwV7RMqyGChKrUfenlM.png\", \"title\": \"test deskripsi\", \"status\": \"draft\", \"excerpt\": \"Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus dui...\", \"published_at\": null}}', NULL, '2025-11-18 01:18:27', '2025-11-18 01:18:27'),
(8, 'default', 'Berita \"test deskripsi\" telah updated', 'App\\Models\\Post', 'updated', 4, 'App\\Models\\User', 1, '{\"old\": {\"status\": \"draft\", \"published_at\": null}, \"attributes\": {\"status\": \"published\", \"published_at\": \"2025-11-18T08:18:45.000000Z\"}}', NULL, '2025-11-18 01:18:45', '2025-11-18 01:18:45'),
(9, 'default', 'Berita \"test deskripsi\" telah updated', 'App\\Models\\Post', 'updated', 4, 'App\\Models\\User', 1, '{\"old\": [], \"attributes\": []}', NULL, '2025-11-18 01:18:58', '2025-11-18 01:18:58'),
(10, 'default', 'Berita \"test deskripsi\" telah updated', 'App\\Models\\Post', 'updated', 4, 'App\\Models\\User', 1, '{\"old\": {\"body\": \"<p>Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.</p>\\r\\n<p>Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.</p>\\r\\n<p>Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.</p>\\r\\n<p>Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.</p>\\r\\n<p>Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.</p>\"}, \"attributes\": {\"body\": \"<p style=\\\"text-align: justify;\\\">Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.</p>\\r\\n<p style=\\\"text-align: justify;\\\">Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.</p>\\r\\n<p style=\\\"text-align: justify;\\\">Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.</p>\\r\\n<p style=\\\"text-align: justify;\\\">Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.</p>\\r\\n<p style=\\\"text-align: justify;\\\">Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.</p>\"}}', NULL, '2025-11-18 01:19:26', '2025-11-18 01:19:26'),
(11, 'default', 'Berita \"test deskripsi\" telah updated', 'App\\Models\\Post', 'updated', 4, 'App\\Models\\User', 1, '{\"old\": [], \"attributes\": []}', NULL, '2025-11-18 01:19:29', '2025-11-18 01:19:29'),
(12, 'default', 'Berita \"test 2\" telah updated', 'App\\Models\\Post', 'updated', 2, 'App\\Models\\User', 1, '{\"old\": {\"status\": \"published\"}, \"attributes\": {\"status\": \"private\"}}', NULL, '2025-11-18 01:20:20', '2025-11-18 01:20:20'),
(13, 'default', 'Berita \"test 2\" telah updated', 'App\\Models\\Post', 'updated', 2, 'App\\Models\\User', 1, '{\"old\": {\"status\": \"private\", \"published_at\": \"2025-09-30T03:39:13.000000Z\"}, \"attributes\": {\"status\": \"published\", \"published_at\": \"2025-11-18T08:20:27.000000Z\"}}', NULL, '2025-11-18 01:20:27', '2025-11-18 01:20:27'),
(14, 'default', 'Berita \"test deskripsi\" telah updated', 'App\\Models\\Post', 'updated', 4, 'App\\Models\\User', 1, '{\"old\": [], \"attributes\": []}', NULL, '2025-11-18 01:20:42', '2025-11-18 01:20:42'),
(15, 'default', 'Berita \"khbskd\" telah created', 'App\\Models\\Post', 'created', 5, 'App\\Models\\User', 1, '{\"attributes\": {\"body\": \"<p><em>Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.</em></p>\\r\\n<p><em>Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.</em></p>\\r\\n<p><em>Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.</em></p>\\r\\n<p><em>Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.</em></p>\\r\\n<p><em>Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.</em></p>\", \"image\": \"posts/S5njzDHr1UpVaMABYCl9ZfwCWXjDttTEP21zm5co.png\", \"title\": \"khbskd\", \"status\": \"published\", \"excerpt\": \"Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus dui...\", \"published_at\": \"2025-11-18T08:21:36.000000Z\"}}', NULL, '2025-11-18 01:21:36', '2025-11-18 01:21:36'),
(16, 'default', 'Berita \"khbskd\" telah updated', 'App\\Models\\Post', 'updated', 5, 'App\\Models\\User', 1, '{\"old\": [], \"attributes\": []}', NULL, '2025-11-18 01:22:05', '2025-11-18 01:22:05'),
(17, 'default', 'Berita \"test menggunakan sluq\" telah updated', 'App\\Models\\Post', 'updated', 1, 'App\\Models\\User', 1, '{\"old\": {\"image\": \"posts/0IcmnyQzmOnE7LL3KgNrpdPPlgnYsENrb0AS4ZnZ.jpg\"}, \"attributes\": {\"image\": \"posts/dVKtzrj8mFcEKJ3TJ0Nh19txgK4HvoAMLQ4HPR88.png\"}}', NULL, '2025-11-18 01:22:59', '2025-11-18 01:22:59'),
(18, 'default', 'Berita \"berita ke 5\" telah created', 'App\\Models\\Post', 'created', 6, 'App\\Models\\User', 1, '{\"attributes\": {\"body\": \"<p><strong><span style=\\\"color: rgb(0, 0, 0);\\\">Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.</span></strong></p>\\r\\n<p><strong><span style=\\\"color: rgb(0, 0, 0);\\\">Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.</span></strong></p>\\r\\n<p><strong><span style=\\\"color: rgb(0, 0, 0);\\\">Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.</span></strong></p>\\r\\n<p><strong><span style=\\\"color: rgb(0, 0, 0);\\\">Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.</span></strong></p>\\r\\n<p><strong><span style=\\\"color: rgb(0, 0, 0);\\\">Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.</span></strong></p>\", \"image\": \"posts/cramvJzC72TXffXi0DjmKwZHhw3byGH4n37bfLqY.png\", \"title\": \"berita ke 5\", \"status\": \"published\", \"excerpt\": \"Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus dui...\", \"published_at\": \"2025-11-18T08:25:23.000000Z\"}}', NULL, '2025-11-18 01:25:23', '2025-11-18 01:25:23'),
(19, 'default', 'Berita \"test menggunakan sluq\" telah updated', 'App\\Models\\Post', 'updated', 1, 'App\\Models\\User', 1, '{\"old\": {\"image\": \"posts/dVKtzrj8mFcEKJ3TJ0Nh19txgK4HvoAMLQ4HPR88.png\"}, \"attributes\": {\"image\": \"posts/SpmiiWb9iIu6C68aY7phK2Atk3W2arZFIw2OdQH9.jpg\"}}', NULL, '2025-11-18 01:47:02', '2025-11-18 01:47:02'),
(20, 'default', 'Berita \"berita ke 5\" telah updated', 'App\\Models\\Post', 'updated', 6, 'App\\Models\\User', 1, '{\"old\": {\"image\": \"posts/cramvJzC72TXffXi0DjmKwZHhw3byGH4n37bfLqY.png\"}, \"attributes\": {\"image\": \"posts/YOVRKiWVjOS8ODlpq8uDZ3gp161155CzdwSgHx6I.jpg\"}}', NULL, '2025-11-18 01:47:49', '2025-11-18 01:47:49'),
(21, 'default', 'Berita \"berita ke 5\" telah updated', 'App\\Models\\Post', 'updated', 6, 'App\\Models\\User', 1, '{\"old\": [], \"attributes\": []}', NULL, '2025-11-18 01:49:03', '2025-11-18 01:49:03'),
(22, 'default', 'Berita \"berita ke 5 shb jbkbk kjbkj jksdjb jkbkb kjbskb sdjbbc\" telah updated', 'App\\Models\\Post', 'updated', 6, 'App\\Models\\User', 1, '{\"old\": {\"title\": \"berita ke 5\"}, \"attributes\": {\"title\": \"berita ke 5 shb jbkbk kjbkj jksdjb jkbkb kjbskb sdjbbc\"}}', NULL, '2025-11-18 01:50:31', '2025-11-18 01:50:31'),
(23, 'default', 'Berita \"test deskripsi\" telah updated', 'App\\Models\\Post', 'updated', 4, NULL, NULL, '{\"old\": [], \"attributes\": []}', NULL, '2025-11-18 19:35:54', '2025-11-18 19:35:54'),
(24, 'default', 'Pengaturan Global telah updated', 'App\\Models\\Setting', 'updated', 1, 'App\\Models\\User', 1, '{\"old\": {\"site_name\": \"DP3A\", \"copyright_text\": \"DP3A KATINGAN\"}, \"attributes\": {\"site_name\": \"DP3AP2KB\", \"copyright_text\": \"DP3AP2KB KATINGAN\"}}', NULL, '2025-11-18 19:45:07', '2025-11-18 19:45:07'),
(25, 'default', 'Berita \"berita ke 5 shb jbkbk kjbkj jksdjb jkbkb kjbskb sdjbbc\" telah updated', 'App\\Models\\Post', 'updated', 6, 'App\\Models\\User', 1, '{\"old\": [], \"attributes\": []}', NULL, '2025-11-19 01:32:30', '2025-11-19 01:32:30'),
(26, 'contact_messages', 'Pesan dari \"asad\" telah dihapus', 'App\\Models\\ContactMessage', 'deleted', 4, 'App\\Models\\User', 1, '{\"old\": {\"name\": \"asad\", \"email\": \"karbit@gmail.com\", \"status\": \"unread\", \"message\": \"test desai notifikasi\", \"subject\": \"sdsfsd\"}}', NULL, '2025-11-19 22:12:43', '2025-11-19 22:12:43'),
(27, 'contact_messages', 'Pesan dari \"test\" telah dihapus', 'App\\Models\\ContactMessage', 'deleted', 14, 'App\\Models\\User', 1, '{\"old\": {\"name\": \"test\", \"email\": \"pasep9984@gmail.com\", \"status\": \"unread\", \"message\": \"akdnasljd kajndndal adlndalnd\\r\\na,md aaaaaaaaaaaaaaaaaaaa\", \"subject\": \"as\"}}', NULL, '2025-11-19 22:12:45', '2025-11-19 22:12:45'),
(28, 'contact_messages', 'Pesan dari \"skdbks\" telah dihapus', 'App\\Models\\ContactMessage', 'deleted', 16, 'App\\Models\\User', 1, '{\"old\": {\"name\": \"skdbks\", \"email\": \"300secret@livinitlarge.net\", \"status\": \"unread\", \"message\": \"sdfds  dksnffdsj jskdncds\", \"subject\": \"dfds efsd\"}}', NULL, '2025-11-19 22:12:47', '2025-11-19 22:12:47'),
(29, 'contact_messages', 'Pesan dari \"test\" telah dihapus', 'App\\Models\\ContactMessage', 'deleted', 17, 'App\\Models\\User', 1, '{\"old\": {\"name\": \"test\", \"email\": \"300secret@livinitlarge.net\", \"status\": \"unread\", \"message\": \"dkj jj all aj  bhdb kdbks mndb s shdbsdn\", \"subject\": \"test log\"}}', NULL, '2025-11-19 22:12:49', '2025-11-19 22:12:49');

-- --------------------------------------------------------

--
-- Table structure for table `agendas`
--

CREATE TABLE `agendas` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agendas`
--

INSERT INTO `agendas` (`id`, `title`, `date`, `time`, `description`, `created_at`, `updated_at`) VALUES
(2, 'test bulan depan', '2025-10-01', '09:58:00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2025-09-30 19:56:53', '2025-10-01 00:17:53'),
(3, 'test tanggal yang sama', '2025-10-01', '14:34:00', NULL, '2025-10-01 00:34:35', '2025-10-01 00:34:35');

-- --------------------------------------------------------

--
-- Table structure for table `bidangs`
--

CREATE TABLE `bidangs` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bidangs`
--

INSERT INTO `bidangs` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'test', 'test', '2025-10-01 01:14:56', '2025-10-01 01:14:56'),
(2, 'test 2', 'test-2', '2025-10-01 01:46:17', '2025-10-01 01:46:17'),
(3, 'test 3', 'test-3', '2025-10-01 01:47:24', '2025-10-01 01:47:24');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-356a192b7913b04c54574d18c28d46e6395428ab', 'i:1;', 1763369707),
('laravel-cache-356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1763369707;', 1763369707),
('laravel-cache-5c785c036466adea360111aa28563bfd556b5fba', 'i:3;', 1763344267),
('laravel-cache-5c785c036466adea360111aa28563bfd556b5fba:timer', 'i:1763344267;', 1763344267),
('laravel-cache-illuminate:queue:restart', 'i:1763349407;', 2078709407),
('laravel-cache-spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:1:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:12:\"manage users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:2;}}}s:5:\"roles\";a:1:{i:0;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:11:\"super admin\";s:1:\"c\";s:3:\"web\";}}}', 1763701197);

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
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unread',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_size` int UNSIGNED NOT NULL,
  `download_count` int UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `title`, `file_path`, `file_type`, `file_size`, `download_count`, `created_at`, `updated_at`) VALUES
(1, 'gg', 'documents/tsEGlupECBqtF3Kt00W3rANf5KgnxoUoOg0MGYIt.pdf', 'pdf', 708, 1, '2025-09-29 18:57:44', '2025-09-29 19:41:51'),
(2, 'Profil  Dinas  P3APPKB (1)', 'documents/Xbyi2KzhikzzdjDo6WJkggcLVeiV3qxrwn57pK19.pdf', 'pdf', 708, 0, '2025-09-29 19:37:37', '2025-09-29 19:37:37');

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
(4, '2025_09_17_031133_create_permission_tables', 2),
(5, '2025_09_17_031255_create_personal_access_tokens_table', 3),
(6, '2025_09_29_030609_create_sliders_table', 4),
(7, '2025_09_29_034915_add_order_to_sliders_table', 5),
(8, '2025_09_29_074405_create_photos_table', 6),
(9, '2025_09_29_081340_create_videos_table', 7),
(10, '2025_09_30_014924_create_documents_table', 8),
(11, '2025_09_30_031405_create_categories_table', 9),
(12, '2025_09_30_031433_create_posts_table', 9),
(13, '2025_09_30_031444_create_category_post_table', 9),
(14, '2025_10_01_021712_create_agendas_table', 10),
(15, '2025_10_01_075859_create_bidangs_table', 11),
(16, '2025_10_01_075900_create_pegawais_table', 11),
(17, '2025_10_27_035430_create_pimpinans_table', 12),
(18, '2025_10_27_035430_create_riwayat_pendidikans_table', 12),
(19, '2025_10_27_035431_create_riwayat_pekerjaans_table', 12),
(20, '2025_11_03_024516_add_quote_and_jabatan_to_pimpinans_table', 13),
(21, '2025_11_03_034149_create_settings_table', 14),
(22, '2025_11_03_050632_create_visi_misis_table', 15),
(23, '2025_11_03_065542_add_last_seen_to_users_table', 16),
(24, '2025_11_03_072923_add_soft_deletes_to_users_table', 17),
(25, '2025_11_10_043850_drop_category_tables', 18),
(26, '2025_11_10_080544_create_tugas_table', 19),
(27, '2025_11_10_083940_make_file_path_nullable_in_tugas_table', 20),
(28, '2025_11_12_034848_create_struktur_bidangs_table', 21),
(29, '2025_11_12_034904_create_struktur_anggotas_table', 21),
(30, '2025_11_12_043521_add_is_shifted_to_struktur_bidangs_table', 22),
(31, '2025_11_13_022314_create_quick_links_table', 23),
(32, '2025_11_13_023140_add_footer_and_general_fields_to_settings_table', 23),
(33, '2025_11_14_025319_add_map_and_tiktok_to_settings_table', 24),
(34, '2025_11_14_075157_create_contact_messages_table', 25),
(35, '2025_11_17_035013_add_notification_email_to_settings_table', 26),
(36, '2025_11_17_081206_create_activity_log_table', 27),
(37, '2025_11_17_081207_add_event_column_to_activity_log_table', 27),
(38, '2025_11_17_081208_add_batch_uuid_column_to_activity_log_table', 27);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(2, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 2),
(1, 'App\\Models\\User', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('dondisetiawan1234@gmail.com', '$2y$12$A7O0D34SNZRsps3iPSoPO.vmZS.YmIxQiyq9HRuBY7gTxJJ/4QlLq', '2025-11-16 21:02:36');

-- --------------------------------------------------------

--
-- Table structure for table `pegawais`
--

CREATE TABLE `pegawais` (
  `id` bigint UNSIGNED NOT NULL,
  `bidang_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('asn','non-asn') COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pegawais`
--

INSERT INTO `pegawais` (`id`, `bidang_id`, `name`, `position`, `nip`, `photo`, `status`, `order`, `created_at`, `updated_at`) VALUES
(1, 1, 'Dons', 'Plt. KABID KETENTRAMAN DAN KETERTIBAN MASYARAKAT', '-', 'pegawai-photos/YGtewFgQO59Xz4RA1jSUetCFKa6PHGUCnNz5uJjc.jpg', 'asn', 1, '2025-10-01 01:34:10', '2025-10-26 22:48:28'),
(2, 2, 'test 2', 'Polisi Pamong Praja Ahli Muda', '982939232', 'pegawai-photos/LDFt897DvAZg2sVnDnWFldZFJKhTfoLZ1rXvDmvR.jpg', 'non-asn', 1, '2025-10-01 01:40:42', '2025-10-06 19:11:05');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'manage users', 'web', '2025-11-02 23:49:01', '2025-11-02 23:49:01');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'MyApp', 'd99cab065695d28878621f79465ba9b9eee6ac7f0042cbec8853517d31ee7ba7', '[\"*\"]', NULL, NULL, '2025-11-20 19:52:03', '2025-11-20 19:52:03'),
(2, 'App\\Models\\User', 1, 'MyApp', 'cbdda5f5ad4ae50c2171071264d27eaef959b521d1359ceaa5fe5f804c121c93', '[\"*\"]', '2025-11-20 19:57:04', NULL, '2025-11-20 19:55:49', '2025-11-20 19:57:04');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` bigint UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `image`, `title`, `created_at`, `updated_at`) VALUES
(1, 'photos/KQB6HpnsLnxFB0om8rBiCi6ZrR3RX9TFrua2ewyx.jpg', 'Desain Dashboard', '2025-09-29 00:54:02', '2025-09-29 00:54:02'),
(3, 'photos/s289LPUXsYOvlYUDnMxWqltWEv3rqT38LuP0cser.png', 'Gemini Generated Image H80S5Jh80S5Jh80S', '2025-10-26 23:28:52', '2025-10-26 23:28:52'),
(4, 'photos/RbShUAQVaKQAhXzZ1hLauIqV2uVgeIGZeVezeX0q.png', 'Gemini Generated Image Imn3Dtimn3Dtimn3', '2025-10-26 23:29:18', '2025-10-26 23:29:18'),
(5, 'photos/q1atryTbI0XD6QhCTkQxc6sL9YmK1RG8RgrtrL2T.png', 'Carbon (3)', '2025-10-26 23:29:34', '2025-10-26 23:29:34');

-- --------------------------------------------------------

--
-- Table structure for table `pimpinans`
--

CREATE TABLE `pimpinans` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pangkat_golongan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quote` text COLLATE utf8mb4_unicode_ci,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `agama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pimpinans`
--

INSERT INTO `pimpinans` (`id`, `name`, `photo`, `nip`, `pangkat_golongan`, `jabatan`, `quote`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `agama`, `created_at`, `updated_at`) VALUES
(1, 'Pak Bahlil', 'pimpinan/sp7paqZKSVaURvS9nrg22bbWalk0zAKQRYwrXEAq.jpg', '198208172010012008', 'A', 'Orang Biasa', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vitae tristique tellus. Praesent et tellus.', 'dckdabckd', '2025-10-29', '-', 'Islam', '2025-10-26 21:12:04', '2025-11-02 19:59:46');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('published','draft','private') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `view_count` int UNSIGNED NOT NULL DEFAULT '0',
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `slug`, `image`, `excerpt`, `body`, `status`, `view_count`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'test menggunakan sluq', 'test-menggunakan-sluq', 'posts/SpmiiWb9iIu6C68aY7phK2Atk3W2arZFIw2OdQH9.jpg', 'test', '<p>test</p>', 'published', 8, '2025-09-29 20:36:40', '2025-09-29 20:36:40', '2025-11-18 01:47:02'),
(2, 1, 'test 2', 'test-2', 'posts/6T2ZH2AZW6B2Qe7hL1Nhetv6YqG7XH0E0d3X2Aqm.jpg', 'jbjh', '<p>jbjh</p>', 'published', 23, '2025-11-18 01:20:27', '2025-09-29 20:39:13', '2025-11-18 01:20:27'),
(4, 1, 'test deskripsi', 'test-deskripsi', 'posts/QO52BwCArf39mOvdTnvlATwV7RMqyGChKrUfenlM.png', 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus dui...', '<p style=\"text-align: justify;\">Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.</p>\r\n<p style=\"text-align: justify;\">Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.</p>\r\n<p style=\"text-align: justify;\">Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.</p>\r\n<p style=\"text-align: justify;\">Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.</p>\r\n<p style=\"text-align: justify;\">Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.</p>', 'published', 4, '2025-11-18 01:18:45', '2025-11-18 01:18:26', '2025-11-18 19:35:54'),
(5, 1, 'khbskd', 'khbskd', 'posts/S5njzDHr1UpVaMABYCl9ZfwCWXjDttTEP21zm5co.png', 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus dui...', '<p><em>Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.</em></p>\r\n<p><em>Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.</em></p>\r\n<p><em>Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.</em></p>\r\n<p><em>Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.</em></p>\r\n<p><em>Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.</em></p>', 'published', 1, '2025-11-18 01:21:36', '2025-11-18 01:21:36', '2025-11-18 01:22:05'),
(6, 1, 'berita ke 5 shb jbkbk kjbkj jksdjb jkbkb kjbskb sdjbbc', 'berita-ke-5-shb-jbkbk-kjbkj-jksdjb-jkbkb-kjbskb-sdjbbc', 'posts/YOVRKiWVjOS8ODlpq8uDZ3gp161155CzdwSgHx6I.jpg', 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus dui...', '<p><strong><span style=\"color: rgb(0, 0, 0);\">Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.</span></strong></p>\r\n<p><strong><span style=\"color: rgb(0, 0, 0);\">Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.</span></strong></p>\r\n<p><strong><span style=\"color: rgb(0, 0, 0);\">Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.</span></strong></p>\r\n<p><strong><span style=\"color: rgb(0, 0, 0);\">Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.</span></strong></p>\r\n<p><strong><span style=\"color: rgb(0, 0, 0);\">Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.</span></strong></p>', 'published', 2, '2025-11-18 01:25:23', '2025-11-18 01:25:23', '2025-11-19 01:32:30');

-- --------------------------------------------------------

--
-- Table structure for table `quick_links`
--

CREATE TABLE `quick_links` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quick_links`
--

INSERT INTO `quick_links` (`id`, `title`, `url`, `order`, `created_at`, `updated_at`) VALUES
(1, 'pimpinan', 'http://127.0.0.1:8000/profil-pimpinan', 1, '2025-11-12 19:53:10', '2025-11-12 20:04:01');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_pekerjaans`
--

CREATE TABLE `riwayat_pekerjaans` (
  `id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `urutan` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_pendidikans`
--

CREATE TABLE `riwayat_pendidikans` (
  `id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `urutan` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `riwayat_pendidikans`
--

INSERT INTO `riwayat_pendidikans` (`id`, `judul`, `keterangan`, `deskripsi`, `urutan`, `created_at`, `updated_at`) VALUES
(1, 'it', 'lulus 210', 'unpar', 2, '2025-10-26 21:45:05', '2025-10-26 22:01:08'),
(2, 'hbhk', 'skdckj', 'sljdn', 1, '2025-10-26 22:01:08', '2025-10-26 22:01:08');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2025-11-02 23:49:01', '2025-11-02 23:49:01'),
(2, 'super admin', 'web', '2025-11-02 23:49:01', '2025-11-02 23:49:01');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 2);

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
('QoOAg83sV5PRpv6n29FptRAXrmKmqm6LFUwYMLPM', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQkZMZTBUVjczZGp4TkdWT0RYRDBFWmlFQVYzZW00akkxOWpsRVZ3aCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9fQ==', 1763627644),
('wv4G1GZtsGPqZ5SbF5FMV0u4u01a7OWwebbOT01Y', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWmZMQ1plTFBTa3RKWjBKQzdab2VXRjY5bGR5WFFieGxWVDRocVZ1QyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9fQ==', 1763695716);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `site_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copyright_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notification_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `google_map_url` text COLLATE utf8mb4_unicode_ci,
  `footer_about` text COLLATE utf8mb4_unicode_ci,
  `jam_kerja` json DEFAULT NULL,
  `telepon` json DEFAULT NULL,
  `facebook_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tiktok_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_name`, `site_logo`, `copyright_text`, `notification_email`, `alamat`, `google_map_url`, `footer_about`, `jam_kerja`, `telepon`, `facebook_url`, `instagram_url`, `youtube_url`, `twitter_url`, `whatsapp_url`, `tiktok_url`, `created_at`, `updated_at`) VALUES
(1, 'DP3AP2KB', 'settings/5yZGhRtf2UsoYJjXmCLFHvZL0pEMC1Uwl863hgGe.png', 'DP3AP2KB KATINGAN', NULL, 'Jl. Prof. Soedarto No.70, Sumurboto, Kec. Banyumanik, Kota Semarang', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d777776.4176965063!2d112.44400659092263!3d-1.417700478719626!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dfce246471d67bb%3A0xf2db9a410b98a678!2sDinas%20Pemberdayaan%20Masyarakat%20Dan%20Pemerintahan%20Desa%20Kabupaten%20Katingan!5e1!3m2!1sid!2sid!4v1763103716280!5m2!1sid!2sid', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus non ex ut sapien fringilla tempor ut at enim. Aenean varius vel arcu quis convallis. Nulla et erat condimentum, varius libero sit amet, maximus nulla. Mauris ornare tristique est, eget lacinia augue egestas eu. Praesent suscipit orci est, sit amet dapibus lectus commodo sit amet. Fusce faucibus posuere magna, in rutrum turpis pellentesque vel. Pellentesque vel felis lobortis sapien luctus finibus. Vivamus venenatis finibus est, et dictum risus bibendum a.', '[\"Senin - Jum\'at : 08:00 - 16:00\", \"Sabtu - minggu : 08:00 - 16:00\"]', '[\"7668868\"]', NULL, 'https://www.youtube.com/watch?v=9OPxlTh_Zus', 'https://www.youtube.com/watch?v=9OPxlTh_Zus', NULL, NULL, NULL, '2025-11-02 20:54:01', '2025-11-18 19:45:06');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `order` int UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `image`, `title`, `status`, `order`, `created_at`, `updated_at`) VALUES
(1, 'sliders/juO3qJ9xO3wBeF6bM959w3AWUiM9cpIFXHDYTsI8.jpg', NULL, 1, 1, '2025-09-28 20:20:19', '2025-11-14 01:20:12'),
(2, 'sliders/MTQ4mIXrkesr0Ho5vNjAkdbSH00ZSxwDORmu6s9h.jpg', 'test 2', 1, 2, '2025-09-28 20:31:20', '2025-11-14 01:20:12'),
(5, 'sliders/2VCGoz1tl2E4J9Mv84SEpiXPny54foEkwgD4hSCi.png', NULL, 0, 3, '2025-11-03 20:15:57', '2025-11-14 01:20:12');

-- --------------------------------------------------------

--
-- Table structure for table `struktur_anggotas`
--

CREATE TABLE `struktur_anggotas` (
  `id` bigint UNSIGNED NOT NULL,
  `struktur_bidang_id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_visible` tinyint(1) NOT NULL DEFAULT '1',
  `urutan` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `struktur_anggotas`
--

INSERT INTO `struktur_anggotas` (`id`, `struktur_bidang_id`, `nama`, `jabatan`, `nip`, `foto`, `is_visible`, `urutan`, `created_at`, `updated_at`) VALUES
(2, 3, 'test 2', 'test', '98', NULL, 1, 2, '2025-11-11 21:03:22', '2025-11-11 21:57:27'),
(3, 1, 'test 3', 'test 3', '988', NULL, 1, 1, '2025-11-11 21:08:50', '2025-11-11 21:10:29'),
(5, 3, 'testjj', 'sdcds', NULL, NULL, 1, 1, '2025-11-11 21:33:49', '2025-11-11 21:57:27'),
(6, 4, 'gg', 'aa', NULL, NULL, 1, 1, '2025-11-11 21:53:56', '2025-11-11 21:53:56'),
(7, 3, 'user3', '3', NULL, NULL, 1, 3, '2025-11-11 21:55:50', '2025-11-11 21:57:27'),
(8, 3, 'user 4', '4', NULL, NULL, 1, 4, '2025-11-11 21:56:09', '2025-11-11 21:57:27'),
(10, 5, 'spacer', 's', NULL, NULL, 0, 2, '2025-11-11 22:19:59', '2025-11-12 01:00:20'),
(11, 5, 'hch', 'jkj', NULL, NULL, 1, 1, '2025-11-11 22:20:18', '2025-11-12 01:00:20'),
(12, 5, 'hh', 'jh', NULL, NULL, 0, 3, '2025-11-11 22:20:41', '2025-11-12 01:00:20'),
(13, 5, 'hjvj', ',jbjk', NULL, NULL, 0, 4, '2025-11-11 22:20:53', '2025-11-12 01:00:20');

-- --------------------------------------------------------

--
-- Table structure for table `struktur_bidangs`
--

CREATE TABLE `struktur_bidangs` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_bidang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `urutan` int NOT NULL DEFAULT '0',
  `is_shifted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `struktur_bidangs`
--

INSERT INTO `struktur_bidangs` (`id`, `nama_bidang`, `urutan`, `is_shifted`, `created_at`, `updated_at`) VALUES
(1, 'pemimpin', 1, 0, '2025-11-11 21:01:44', '2025-11-12 23:03:43'),
(3, 'section 2', 3, 0, '2025-11-11 21:18:18', '2025-11-12 23:03:43'),
(4, 'test bang', 2, 1, '2025-11-11 21:53:30', '2025-11-12 23:03:43'),
(5, '4', 4, 0, '2025-11-11 22:19:24', '2025-11-12 23:03:43');

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `id` bigint UNSIGNED NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tugas`
--

INSERT INTO `tugas` (`id`, `file_path`, `file_name`, `file_size`, `created_at`, `updated_at`) VALUES
(1, 'dokumen/dGTkzVUds5Ppu1VKwECSNb65Wu1mZoMENOn5bdXv.pdf', 'gg (1) (1).pdf', '707.65 KB', '2025-11-10 01:16:07', '2025-11-10 01:43:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_seen` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `last_seen`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'dons', 'karbit@gmail.com', NULL, '$2y$12$RhnBABV0l/h484sx5stDQetZYJH5pfBG9vw5S5D/GC7YAXSE3Z/Au', 'aFc4BRbGjDdQY0Ci0lo1vmkKzTZgfapdcrgyl680s2prh1Vs9z9gOunhMNjl', '2025-11-20 19:57:43', '2025-09-28 19:17:34', '2025-09-28 19:17:34', NULL),
(2, 'test', '300secret@livinitlarge.net', NULL, '$2y$12$55XZbj3GvMJcjFHG2d6Xx.1KGjQIscVInyIIbU/MDHBjjrRA4nQ.m', NULL, '2025-11-03 00:48:04', '2025-11-03 00:05:05', '2025-11-03 00:52:47', '2025-11-03 00:52:47'),
(4, 'dons', 'dondisetiawan1234@gmail.com', NULL, '$2y$12$POdtmPDKbvt79CJC30CbJeIbJvg2UznhaZ6ckZ7S75kLH0lVZi68q', NULL, NULL, '2025-11-16 21:02:12', '2025-11-16 21:02:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` bigint UNSIGNED NOT NULL,
  `youtube_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `youtube_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `youtube_url`, `youtube_id`, `title`, `thumbnail`, `created_at`, `updated_at`) VALUES
(1, 'https://www.youtube.com/watch?v=vbmxHwavf_Y', 'vbmxHwavf_Y', 'UNBOXING XIAOMI 17 PRO MAX, Test Layar Belakang, Test Kamera', 'https://img.youtube.com/vi/vbmxHwavf_Y/hqdefault.jpg', '2025-09-29 01:28:55', '2025-09-29 01:28:55'),
(3, 'https://www.youtube.com/watch?v=5ku7LN3px4c', '5ku7LN3px4c', 'UNBOXING XIAOMI 17 PRO MAX, Test Layar Belakang, Test Kamera', 'https://img.youtube.com/vi/5ku7LN3px4c/hqdefault.jpg', '2025-09-29 01:41:39', '2025-09-29 01:41:39'),
(4, 'https://www.youtube.com/watch?v=53WeiGvAOD4a', '53WeiGvAOD4', 'UPDATE Udang Radioaktif dan Kontaminasi Cs-137 di Cikande', 'https://img.youtube.com/vi/53WeiGvAOD4/hqdefault.jpg', '2025-10-06 19:17:34', '2025-10-06 19:17:34'),
(5, 'https://www.youtube.com/watch?v=xuOzBCf1eXM', 'xuOzBCf1eXM', 'Bahlil Ngaku &#39;Ditegur Sayang&#39; oleh Presiden Prabowo - [Primetime News]', 'https://img.youtube.com/vi/xuOzBCf1eXM/hqdefault.jpg', '2025-10-26 23:11:57', '2025-10-26 23:11:57'),
(6, 'https://www.youtube.com/watch?v=4qN130ySBqE', '4qN130ySBqE', 'Building my dream copper', 'https://img.youtube.com/vi/4qN130ySBqE/hqdefault.jpg', '2025-11-14 01:19:33', '2025-11-14 01:19:53');

-- --------------------------------------------------------

--
-- Table structure for table `visi_misis`
--

CREATE TABLE `visi_misis` (
  `id` bigint UNSIGNED NOT NULL,
  `visi` text COLLATE utf8mb4_unicode_ci,
  `misi` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visi_misis`
--

INSERT INTO `visi_misis` (`id`, `visi`, `misi`, `created_at`, `updated_at`) VALUES
(1, NULL, '[]', '2025-11-02 22:14:31', '2025-11-02 23:04:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject_type`,`subject_id`),
  ADD KEY `causer` (`causer_type`,`causer_id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

--
-- Indexes for table `agendas`
--
ALTER TABLE `agendas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bidangs`
--
ALTER TABLE `bidangs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bidangs_name_unique` (`name`),
  ADD UNIQUE KEY `bidangs_slug_unique` (`slug`);

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
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pegawais`
--
ALTER TABLE `pegawais`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pegawais_bidang_id_foreign` (`bidang_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pimpinans`
--
ALTER TABLE `pimpinans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`),
  ADD KEY `posts_user_id_foreign` (`user_id`);

--
-- Indexes for table `quick_links`
--
ALTER TABLE `quick_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `riwayat_pekerjaans`
--
ALTER TABLE `riwayat_pekerjaans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `riwayat_pendidikans`
--
ALTER TABLE `riwayat_pendidikans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `struktur_anggotas`
--
ALTER TABLE `struktur_anggotas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `struktur_anggotas_struktur_bidang_id_foreign` (`struktur_bidang_id`);

--
-- Indexes for table `struktur_bidangs`
--
ALTER TABLE `struktur_bidangs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visi_misis`
--
ALTER TABLE `visi_misis`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `agendas`
--
ALTER TABLE `agendas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bidangs`
--
ALTER TABLE `bidangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `pegawais`
--
ALTER TABLE `pegawais`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pimpinans`
--
ALTER TABLE `pimpinans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `quick_links`
--
ALTER TABLE `quick_links`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `riwayat_pekerjaans`
--
ALTER TABLE `riwayat_pekerjaans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `riwayat_pendidikans`
--
ALTER TABLE `riwayat_pendidikans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `struktur_anggotas`
--
ALTER TABLE `struktur_anggotas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `struktur_bidangs`
--
ALTER TABLE `struktur_bidangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `visi_misis`
--
ALTER TABLE `visi_misis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pegawais`
--
ALTER TABLE `pegawais`
  ADD CONSTRAINT `pegawais_bidang_id_foreign` FOREIGN KEY (`bidang_id`) REFERENCES `bidangs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `struktur_anggotas`
--
ALTER TABLE `struktur_anggotas`
  ADD CONSTRAINT `struktur_anggotas_struktur_bidang_id_foreign` FOREIGN KEY (`struktur_bidang_id`) REFERENCES `struktur_bidangs` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
