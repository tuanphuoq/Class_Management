-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2021 at 05:25 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `class_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `id` bigint(10) NOT NULL,
  `class_id` bigint(10) NOT NULL,
  `title` varchar(255) COLLATE utf32_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf32_unicode_ci NOT NULL,
  `expired_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`id`, `class_id`, `title`, `description`, `expired_date`, `created_at`, `updated_at`) VALUES
(2, 8, 'Bài tập về nhà 1', 'Bài tập về nhà 1 cho phần cú pháp lệnh lập trình C', '2021-06-11', '2021-06-08 08:42:03', '2021-06-08 08:42:03'),
(3, 8, 'Bài tập về nhà 2', 'Bài tập về nhà 1 cho phần cú pháp lệnh lập trình C', '2021-07-22', '2021-07-15 02:52:17', '2021-07-15 02:52:17'),
(4, 8, 'Bài tập về nhà 3', 'Bài tập về nhà 1 cho phần cú pháp lệnh lập trình C', '2021-07-29', '2021-07-15 03:03:10', '2021-07-15 03:03:10');

-- --------------------------------------------------------

--
-- Table structure for table `assignment_documents`
--

CREATE TABLE `assignment_documents` (
  `id` int(11) NOT NULL,
  `assignment_id` int(10) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` char(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `assignment_documents`
--

INSERT INTO `assignment_documents` (`id`, `assignment_id`, `title`, `url`, `created_at`, `updated_at`) VALUES
(1, 4, 'tài liệu sql', 'assignments/1626453993-assignmentbase_ecc.sql', '2021-07-16 09:46:33', '2021-07-16 09:46:33');

-- --------------------------------------------------------

--
-- Table structure for table `assignment_submits`
--

CREATE TABLE `assignment_submits` (
  `id` bigint(10) NOT NULL,
  `assignment_id` bigint(10) NOT NULL,
  `user_id` bigint(10) NOT NULL,
  `description` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `file` char(255) COLLATE utf32_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `assignment_submits`
--

INSERT INTO `assignment_submits` (`id`, `assignment_id`, `user_id`, `description`, `file`, `created_at`, `updated_at`) VALUES
(1, 4, 7, 'nộp bài', 'assignments/1626343706-base_ecc (1).sql', '2021-07-15 03:08:26', '2021-07-15 03:08:26');

-- --------------------------------------------------------

--
-- Table structure for table `attend_classes`
--

CREATE TABLE `attend_classes` (
  `id` int(20) UNSIGNED NOT NULL,
  `class_id` int(20) NOT NULL,
  `student_id` bigint(20) NOT NULL,
  `teacher_id` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `attend_classes`
--

INSERT INTO `attend_classes` (`id`, `class_id`, `student_id`, `teacher_id`, `created_at`, `updated_at`) VALUES
(11, 8, 0, 3, '2021-06-08 08:15:17', '2021-06-08 08:15:17'),
(12, 7, 0, 3, '2021-06-08 16:01:26', '2021-06-08 09:00:33'),
(13, 7, 5, 3, '2021-06-13 01:22:34', '2021-06-13 01:22:34'),
(14, 8, 2, 3, '2021-06-13 01:26:25', '2021-06-13 01:26:25'),
(15, 7, 2, 3, '2021-06-13 01:26:26', '2021-06-13 01:26:26'),
(17, 8, 7, 3, '2021-07-15 03:07:17', '2021-07-15 03:07:17'),
(18, 8, 6, 1, '2021-07-15 15:56:50', '2021-07-15 15:56:50');

-- --------------------------------------------------------

--
-- Table structure for table `classrooms`
--

CREATE TABLE `classrooms` (
  `id` int(20) UNSIGNED NOT NULL,
  `class_code` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `creator_id` int(11) NOT NULL,
  `room` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `class_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '0 - deleted, 1 - active, 2 - finish',
  `class_image` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `classrooms`
--

INSERT INTO `classrooms` (`id`, `class_code`, `creator_id`, `room`, `class_name`, `subject`, `description`, `status`, `class_image`, `created_at`, `updated_at`) VALUES
(7, 'ID2791', 3, '333-B5', 'Lập trình hướng đối tượng', 'Lập trình', NULL, 2, 'images/class-1623164405.png', '2021-06-08 15:00:05', '2021-06-13 08:27:54'),
(8, 'ID7922', 3, '321-B5', 'Lập trình C', 'Lập trình', NULL, 1, 'images/class-1623165317.png', '2021-06-08 15:15:17', '2021-07-15 09:48:18');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) NOT NULL,
  `class_id` int(11) NOT NULL,
  `commentor` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `content` varchar(255) COLLATE utf32_unicode_ci NOT NULL,
  `attachment` char(255) COLLATE utf32_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `class_id`, `commentor`, `created_at`, `updated_at`, `content`, `attachment`) VALUES
(19, 7, 1, '2021-06-13 01:19:32', '2021-06-13 01:19:32', 'Đây là lớp của giảng viên Thanh Tuấn - môn học Lập trình hướng đối tượng', NULL),
(20, 7, 5, '2021-06-13 01:23:05', '2021-06-13 01:23:05', 'Đây là comment của học viên sau khi tham gia lớp học', NULL),
(21, 7, 2, '2021-06-13 01:27:03', '2021-06-13 01:27:03', 'Đây là comment của học viên thứ 2', NULL),
(22, 8, 3, '2021-07-15 03:05:02', '2021-07-15 03:05:02', 'bình luận 1', NULL),
(25, 8, 3, '2021-07-16 22:08:20', '2021-07-16 22:08:20', 'thầy gửi bài tập', 'documents/1626498500-test2.png'),
(27, 8, 3, '2021-07-16 22:18:32', '2021-07-16 22:18:32', 'cả file này nữa nhé', 'documents/1626499112-vaccines.sql'),
(33, 8, 3, '2021-07-16 22:25:23', '2021-07-16 22:25:23', 'tài liệu liên quan đây em nhé', 'documents/1626499523-vaccines.sql');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf32_unicode_ci NOT NULL,
  `source` char(255) COLLATE utf32_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `class_id`, `description`, `source`, `created_at`, `updated_at`) VALUES
(8, 8, 'tài liệu 1', 'documents/1626343706-base_ecc (1).sql', '2021-07-15 03:24:34', '2021-07-15 03:24:34');

-- --------------------------------------------------------

--
-- Table structure for table `invite_joins`
--

CREATE TABLE `invite_joins` (
  `id` int(20) UNSIGNED NOT NULL,
  `teacher_id` int(20) NOT NULL,
  `class_id` int(20) NOT NULL,
  `student_id` bigint(20) NOT NULL,
  `state` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `invite_joins`
--

INSERT INTO `invite_joins` (`id`, `teacher_id`, `class_id`, `student_id`, `state`, `created_at`, `updated_at`) VALUES
(4, 3, 8, 2, 1, '2021-06-13 08:26:25', '2021-06-13 01:26:25'),
(5, 3, 7, 5, 1, '2021-06-13 08:22:34', '2021-06-13 01:22:34'),
(6, 3, 7, 2, 1, '2021-06-13 08:26:26', '2021-06-13 01:26:26'),
(7, 1, 8, 6, 1, '2021-07-15 22:56:50', '2021-07-15 15:56:50'),
(8, 3, 8, 7, 1, '2021-07-15 10:07:17', '2021-07-15 03:07:17'),
(9, 3, 8, 5, 2, '2021-07-15 23:17:05', '2021-07-15 16:17:05');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('anhnv@gmail.com', '$2y$10$edgn7mJDX6zvBwORrM0/VeSTK5moHEoD1gG8s5TlWVn5jcBnrh/9e', '2020-10-10 21:44:57');

-- --------------------------------------------------------

--
-- Table structure for table `request_joins`
--

CREATE TABLE `request_joins` (
  `id` int(20) UNSIGNED NOT NULL,
  `class_id` int(20) NOT NULL,
  `student_id` bigint(20) NOT NULL,
  `state` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `request_joins`
--

INSERT INTO `request_joins` (`id`, `class_id`, `student_id`, `state`, `created_at`, `updated_at`) VALUES
(5, 8, 2, 1, '2021-07-15 09:49:54', '2021-07-15 02:49:54'),
(6, 8, 5, 2, '2021-07-15 23:06:48', '2021-07-15 16:06:48'),
(7, 8, 8, 0, '2021-07-17 00:26:01', '2021-07-17 00:26:01');

-- --------------------------------------------------------

--
-- Table structure for table `sub_comments`
--

CREATE TABLE `sub_comments` (
  `id` bigint(20) NOT NULL,
  `parent_comment_id` int(11) NOT NULL,
  `commentor` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `content` varchar(255) COLLATE utf32_unicode_ci NOT NULL,
  `attachment` char(255) COLLATE utf32_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `sub_comments`
--

INSERT INTO `sub_comments` (`id`, `parent_comment_id`, `commentor`, `created_at`, `updated_at`, `content`, `attachment`) VALUES
(15, 19, 3, '2021-06-13 01:20:12', '2021-06-13 01:20:12', 'Đây là comment của giảng viên xác nhận lớp học', NULL),
(16, 20, 3, '2021-06-13 01:23:22', '2021-06-13 01:23:22', 'Reply comment học viên', NULL),
(17, 20, 5, '2021-06-13 01:25:03', '2021-06-13 01:25:03', 'reply lần 2', NULL),
(18, 20, 3, '2021-06-13 01:25:21', '2021-06-13 01:25:21', 'xác nhận reply lần 2 của học viên', NULL),
(19, 21, 3, '2021-06-13 01:27:18', '2021-06-13 01:27:18', 'xác nhận comment', NULL),
(20, 22, 7, '2021-07-15 03:07:53', '2021-07-15 03:07:53', 'trả lời bình luận', NULL),
(21, 22, 3, '2021-07-16 23:29:22', '2021-07-16 23:29:22', 'đã xem', NULL),
(24, 25, 6, '2021-07-16 23:54:27', '2021-07-16 23:54:27', 'em gửi lại thầy tài liệu', 'documents/1626504867-test2.png'),
(25, 27, 6, '2021-07-16 23:57:09', '2021-07-16 23:57:09', 'tài liệu bổ sung', 'documents/1626505029-test2.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) NOT NULL DEFAULT 3,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', 1, NULL, '$2y$10$aYtRMrsMFr.3P9LEMs3o8uZ82kw0b5pZe2xS9hVmAJ1rWOTLuwK66', NULL, '2020-10-10 06:07:33', '2020-10-10 20:48:53'),
(2, 'Nguyễn Vân Anh', 'anhnv@gmail.com', 3, NULL, '$2y$10$NHh89Lc7dTuk52FqNSh7S.Z6ezQ/VKLmCSZRe6OfM.Y6BdeYvfMpe', NULL, '2020-10-10 06:08:43', '2020-10-11 09:29:18'),
(3, 'Thanh Tuấn', 'tuan.tt@gmail.com', 2, NULL, '$2y$10$fArfPnoJZUmdMBHjJbegwualaZNgGW6lrKX53nEoJIUxRi16A8w2i', NULL, '2021-06-08 06:55:51', '2021-06-08 06:56:26'),
(5, 'Minh Anh', 'ma@gmail.com', 3, NULL, '$2y$10$wYgfmWG6qsGFZ.Dc.Dm/Cu.fS9.GipaKyhvaw/QaVmyx.PkYjYKL2', NULL, '2021-06-13 00:02:47', '2021-06-13 00:04:33'),
(6, 'Ngọc Anh', 'ma1@gmail.com', 3, NULL, '$2y$10$UGUmh2O3fmKgrcIPOJ6alejJkS/srMAbqgOrJ1KjBUiDhUXd.ee/u', NULL, '2021-07-15 02:44:58', '2021-07-15 02:44:58'),
(7, 'Ngọc Hoa', 'ma2@gmail.com', 3, NULL, '$2y$10$8dpxqtpNdByeXYsaWB65pOwmO8T/aNwOQ0D5tfNo74sTiHxuGVBKu', NULL, '2021-07-15 02:55:52', '2021-07-15 03:09:52'),
(8, 'Hùng Dũng', 'hd@gmail.com', 3, NULL, '$2y$10$KLu8JjA3mYbCQ/f1uRtPR.1gGaYOO70BOwoZ8p4ZSKsEKkkWcz3jO', NULL, '2021-07-17 00:25:39', '2021-07-17 00:25:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assignment_documents`
--
ALTER TABLE `assignment_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assignment_submits`
--
ALTER TABLE `assignment_submits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attend_classes`
--
ALTER TABLE `attend_classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classrooms`
--
ALTER TABLE `classrooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invite_joins`
--
ALTER TABLE `invite_joins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `request_joins`
--
ALTER TABLE `request_joins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_comments`
--
ALTER TABLE `sub_comments`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `assignment_documents`
--
ALTER TABLE `assignment_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `assignment_submits`
--
ALTER TABLE `assignment_submits`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attend_classes`
--
ALTER TABLE `attend_classes`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `classrooms`
--
ALTER TABLE `classrooms`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `invite_joins`
--
ALTER TABLE `invite_joins`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `request_joins`
--
ALTER TABLE `request_joins`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sub_comments`
--
ALTER TABLE `sub_comments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
