-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 05, 2021 lúc 06:15 PM
-- Phiên bản máy phục vụ: 10.1.40-MariaDB
-- Phiên bản PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `class_management`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `assignments`
--

CREATE TABLE `assignments` (
  `id` bigint(10) NOT NULL,
  `class_id` bigint(10) NOT NULL,
  `title` varchar(255) COLLATE utf32_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf32_unicode_ci NOT NULL,
  `expired_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `assignments`
--

INSERT INTO `assignments` (`id`, `class_id`, `title`, `description`, `expired_date`, `created_at`, `updated_at`) VALUES
(1, 1, 'Bài tập buổi 1', 'Hoàn thành bài tập buổi 1 trước ngày 20/03/2021', '2021-03-20', '2021-03-09 10:37:52', '2021-03-09 01:21:40');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `assignment_submits`
--

CREATE TABLE `assignment_submits` (
  `id` bigint(10) NOT NULL,
  `assignment_id` bigint(10) NOT NULL,
  `user_id` bigint(10) NOT NULL,
  `description` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `file` char(255) COLLATE utf32_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `attend_classes`
--

CREATE TABLE `attend_classes` (
  `id` int(20) UNSIGNED NOT NULL,
  `class_id` int(20) NOT NULL,
  `student_id` bigint(20) NOT NULL,
  `teacher_id` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `attend_classes`
--

INSERT INTO `attend_classes` (`id`, `class_id`, `student_id`, `teacher_id`, `created_at`, `updated_at`) VALUES
(1, 4, 2, 1, '2020-10-14 12:41:39', '0000-00-00 00:00:00'),
(2, 1, 2, 1, '2020-10-22 15:47:13', '2020-10-15 08:31:44'),
(3, 2, 2, 1, '2020-11-20 21:18:10', '2020-11-20 21:18:10'),
(9, 7, 2, 3, '2020-11-20 22:07:28', '2020-11-20 22:07:28'),
(10, 8, 2, 3, '2020-11-20 22:35:00', '2020-11-20 22:35:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `classrooms`
--

CREATE TABLE `classrooms` (
  `id` int(20) UNSIGNED NOT NULL,
  `class_code` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `creator_id` int(11) NOT NULL,
  `room` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `class_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '0 - deleted, 1 - active, 2 - finish',
  `class_image` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `classrooms`
--

INSERT INTO `classrooms` (`id`, `class_code`, `creator_id`, `room`, `class_name`, `subject`, `description`, `status`, `class_image`, `created_at`, `updated_at`) VALUES
(1, 'ID4381', 3, 'A3-246', 'Tiếng anh chuyên ngành', 'English', NULL, 1, 'images/class-1605932084.jpeg', '2020-11-21 04:14:44', '2021-03-21 10:32:56'),
(2, 'ID9966', 1, 'alo', 'alo', 'alo', NULL, 1, 'images/class-1602411322.png', '2020-10-11 10:15:22', '2021-03-21 10:32:59'),
(3, 'ID9702', 1, 'alo', 'alo', 'alo', NULL, 1, 'images/class-1602412517.png', '2020-10-11 10:35:17', '2021-03-21 10:33:02'),
(4, 'ID3572', 1, 'alo', 'alo', 'alo', NULL, 1, 'images/class-1602413211.png', '2020-10-11 10:46:51', '2021-03-21 10:32:20'),
(6, 'ID6688', 1, 'A3-245', 'Test', 'Tets ter', NULL, 1, 'images/class-1606910214.jpeg', '2020-10-12 15:53:18', '2021-03-21 10:33:06');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) NOT NULL,
  `class_id` int(11) NOT NULL,
  `commentor` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `content` varchar(255) COLLATE utf32_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`id`, `class_id`, `commentor`, `created_at`, `updated_at`, `content`) VALUES
(1, 1, 1, '2020-10-22 05:46:03', '2020-10-22 05:46:03', 'value=\"test lorem na\"'),
(2, 1, 1, '2020-10-22 05:54:44', '2020-10-22 05:54:44', 'test comment'),
(3, 1, 1, '2020-10-22 05:55:14', '2020-10-22 05:55:14', 'test 2'),
(9, 1, 2, '2020-10-22 08:49:02', '2020-10-22 08:49:02', 'test student'),
(12, 1, 1, '2021-03-06 19:55:53', '2021-03-06 19:55:53', 'test'),
(13, 1, 1, '2021-03-06 19:56:18', '2021-03-06 19:56:18', 'ơ sao ý nhỉ'),
(14, 1, 1, '2021-03-06 19:56:33', '2021-03-06 19:56:33', '@@'),
(18, 1, 1, '2021-03-07 07:52:04', '2021-03-07 08:40:57', '@@ hihi');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `documents`
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
-- Đang đổ dữ liệu cho bảng `documents`
--

INSERT INTO `documents` (`id`, `class_id`, `description`, `source`, `created_at`, `updated_at`) VALUES
(4, 1, 'Đề cương đồ án', 'documents/DoAnCuoiKi-v3.pdf', '2020-10-22 09:42:00', '2020-10-22 09:42:00'),
(5, 8, 'test up ảnh', 'documents/author2.png', '2020-11-20 22:10:24', '2020-11-20 22:10:24'),
(6, 1, 'new document test', 'documents/TO-THANH-TUAN-CV.pdf', '2021-03-08 23:45:14', '2021-03-08 23:45:14');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `invite_joins`
--

CREATE TABLE `invite_joins` (
  `id` int(20) UNSIGNED NOT NULL,
  `teacher_id` int(20) NOT NULL,
  `class_id` int(20) NOT NULL,
  `student_id` bigint(20) NOT NULL,
  `state` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `invite_joins`
--

INSERT INTO `invite_joins` (`id`, `teacher_id`, `class_id`, `student_id`, `state`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 2, 1, '2020-11-21 04:18:10', '2020-11-20 21:18:10'),
(2, 3, 7, 2, 1, '2020-11-21 05:07:28', '2020-11-20 22:07:28'),
(3, 3, 8, 2, 1, '2020-11-21 05:35:00', '2020-11-20 22:35:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('anhnv@gmail.com', '$2y$10$edgn7mJDX6zvBwORrM0/VeSTK5moHEoD1gG8s5TlWVn5jcBnrh/9e', '2020-10-10 21:44:57');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `request_joins`
--

CREATE TABLE `request_joins` (
  `id` int(20) UNSIGNED NOT NULL,
  `class_id` int(20) NOT NULL,
  `student_id` bigint(20) NOT NULL,
  `state` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `request_joins`
--

INSERT INTO `request_joins` (`id`, `class_id`, `student_id`, `state`, `created_at`, `updated_at`) VALUES
(2, 2, 1, 1, '2020-11-21 04:22:36', '2020-11-20 21:22:36'),
(3, 6, 2, 0, '2020-10-23 23:20:17', '2020-10-23 23:20:17'),
(4, 8, 2, 1, '2020-11-21 05:02:31', '2020-11-20 22:02:31');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sub_comments`
--

CREATE TABLE `sub_comments` (
  `id` bigint(20) NOT NULL,
  `parent_comment_id` int(11) NOT NULL,
  `commentor` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `content` varchar(255) COLLATE utf32_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sub_comments`
--

INSERT INTO `sub_comments` (`id`, `parent_comment_id`, `commentor`, `created_at`, `updated_at`, `content`) VALUES
(1, 13, 1, '2021-03-06 21:54:26', '2021-03-06 21:54:26', 'hong hao'),
(4, 13, 1, '2021-03-07 05:54:54', '2021-03-07 05:54:54', 'check'),
(5, 13, 1, '2021-03-07 06:06:46', '2021-03-07 09:11:41', 'hú @@'),
(9, 14, 1, '2021-03-07 07:51:52', '2021-03-07 07:51:52', 'fuck'),
(10, 18, 1, '2021-03-07 07:53:11', '2021-03-07 07:53:11', 'hihi'),
(11, 13, 1, '2021-03-07 08:56:44', '2021-03-07 09:09:47', 'hihi @@'),
(12, 18, 1, '2021-03-08 03:11:41', '2021-03-08 03:11:41', 'test'),
(13, 14, 1, '2021-03-08 03:29:27', '2021-03-08 03:29:27', '123'),
(14, 14, 1, '2021-03-08 03:29:48', '2021-03-08 03:29:48', 'bôm');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) NOT NULL DEFAULT '3',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', 1, NULL, '$2y$10$aYtRMrsMFr.3P9LEMs3o8uZ82kw0b5pZe2xS9hVmAJ1rWOTLuwK66', NULL, '2020-10-10 06:07:33', '2020-10-10 20:48:53'),
(2, 'Nguyễn Vân Anh', 'anhnv@gmail.com', 3, NULL, '$2y$10$NHh89Lc7dTuk52FqNSh7S.Z6ezQ/VKLmCSZRe6OfM.Y6BdeYvfMpe', NULL, '2020-10-10 06:08:43', '2020-10-11 09:29:18'),
(3, 'Thanh Tuấn', 'tuantt@gmail.com', 2, NULL, '$2y$10$ANtV0m.xoRupHupQLyVepO9BBRooB6cbZhH8aCS7wgoyZ.5Pda2.y', NULL, '2020-11-20 21:10:07', '2021-03-22 07:35:24');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `assignment_submits`
--
ALTER TABLE `assignment_submits`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `attend_classes`
--
ALTER TABLE `attend_classes`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `classrooms`
--
ALTER TABLE `classrooms`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `invite_joins`
--
ALTER TABLE `invite_joins`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `request_joins`
--
ALTER TABLE `request_joins`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `sub_comments`
--
ALTER TABLE `sub_comments`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `assignment_submits`
--
ALTER TABLE `assignment_submits`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `attend_classes`
--
ALTER TABLE `attend_classes`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `classrooms`
--
ALTER TABLE `classrooms`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `invite_joins`
--
ALTER TABLE `invite_joins`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `request_joins`
--
ALTER TABLE `request_joins`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `sub_comments`
--
ALTER TABLE `sub_comments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
