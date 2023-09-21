-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2023 at 11:00 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `url_shortener`
--

-- --------------------------------------------------------

--
-- Table structure for table `qrcodes`
--

CREATE TABLE `qrcodes` (
  `id` int(11) NOT NULL,
  `full_url` longtext NOT NULL,
  `ip` varchar(100) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `valid_from` timestamp NOT NULL DEFAULT current_timestamp(),
  `valid_till` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_paid` int(11) NOT NULL DEFAULT 0,
  `created_by` varchar(100) NOT NULL,
  `updated_by` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `qrcodes`
--

INSERT INTO `qrcodes` (`id`, `full_url`, `ip`, `is_active`, `valid_from`, `valid_till`, `is_paid`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'https://media.licdn.com/dms/image/D4D03AQGn6vAZxkhO8g/profile-displayphoto-shrink_800_800/0/1689209595765?e=2147483647&v=beta&t=l_biSauO7UEqtEN8lDTId_He_Kvw3SC60c_eFlVvknw', '127.0.0.1', 1, '2023-09-20 09:45:51', '2023-09-20 09:45:51', 0, 'smita', 'admin', '2023-09-20 09:45:51', '2023-09-21 05:48:52'),
(2, 'http://127.0.0.1/phpmyadmin/index.php?route=/sql&db=url_shortener&table=redirects&pos=0', '127.0.0.1', 1, '2023-09-20 10:04:57', '2023-09-20 10:04:57', 1, 'admin', 'admin', '2023-09-20 10:04:57', '2023-09-21 07:04:25'),
(3, 'http://127.0.0.1/phpmyadmin/index.php?route=/sql&db=url_shortener&table=qrcodes&pos=0', '127.0.0.1', 1, '2023-09-20 09:22:43', '2023-09-20 09:22:43', 0, 'admin', 'admin', '2023-09-20 09:22:43', '2023-09-20 09:22:43'),
(4, 'https://www.w3schools.com/howto/howto_css_display_element_hover.asp', '127.0.0.1', 1, '2023-09-21 04:50:38', '2023-09-21 04:50:38', 0, 'admin', 'admin', '2023-09-21 04:50:38', '2023-09-21 04:50:38');

-- --------------------------------------------------------

--
-- Table structure for table `redirects`
--

CREATE TABLE `redirects` (
  `id` int(11) NOT NULL,
  `full_url` longtext NOT NULL,
  `short_url_code` varchar(50) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `hits` int(11) NOT NULL,
  `validity` int(11) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `valid_from` timestamp NOT NULL DEFAULT current_timestamp(),
  `valid_till` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_paid` int(11) NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `updated_by` varchar(100) NOT NULL DEFAULT 'connect2sazad',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `redirects`
--

INSERT INTO `redirects` (`id`, `full_url`, `short_url_code`, `ip`, `hits`, `validity`, `is_active`, `valid_from`, `valid_till`, `is_paid`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(50, 'https://chat.openai.com/c/5a43c545-be28-4e1e-825d-b7ee43ae1e0e', 'okJfM', '127.0.0.1', 3, 365, 1, '2022-09-18 08:08:46', '2023-09-18 08:08:46', 1, 'admin', 'admin', '2023-09-18 08:08:46', '2023-09-18 11:37:19'),
(51, 'http://127.0.0.1/phpmyadmin/index.php?route=/sql&db=url_shortener&table=redirects&pos=0', 'xD4hq', '127.0.0.1', 1, 180, 1, '2023-09-18 08:07:18', '2023-09-18 08:07:18', 0, 'admin', 'admin', '2023-09-18 08:07:18', '2023-09-18 09:24:38'),
(60, 'http://127.0.0.1/url_shortene', 'wgynE', '127.0.0.1', 0, 180, 1, '2023-09-18 09:31:19', '2023-09-18 09:31:19', 0, 'admin', 'admin', '2023-09-18 09:31:19', '2023-09-18 09:31:19'),
(61, 'https://www.google.com/search?q=apple&rlz=1C1CHBF_en-GBIN1075IN1075&oq=apple&gs_lcrp=EgZjaHJvbWUyBggAEEUYOTIHCAEQABiPAjIHCAIQABiPAtIBCDExMzVqMGoxqAIAsAIA&sourceid=chrome&ie=UTF-8', 'LVEtz', '127.0.0.1', 1, 180, 1, '2023-09-18 09:34:00', '2024-03-16 08:34:00', 0, 'connect2sazad', 'admin', '2023-09-18 09:34:00', '2023-09-18 09:38:20'),
(62, 'https://safecomputing.umich.edu/be-aware/phishing-and-suspicious-email/shortened-url-security#:~:text=There%20are%20a%20number%20of,tinyurl.com.', 'wxjDZ', '127.0.0.1', 1, 365, 1, '2023-09-18 09:50:14', '2024-09-17 09:50:14', 0, 'connect2sazad', 'admin', '2023-09-18 09:50:14', '2023-09-18 10:01:31'),
(68, 'https://www.google.com/search?q=rtgre&rlz=1C1CHBF_en-GBIN1075IN1075&oq=rtgre&gs_lcrp=EgZjaHJvbWUyBggAEEUYOTIGCAEQRRg5MgYIAhBFGDvSAQc1MTZqMGo3qAIAsAIA&sourceid=chrome&ie=UTF-8', 'qKAJZ', '127.0.0.1', 0, 180, 1, '2023-09-20 08:00:32', '2024-03-18 04:30:32', 0, 'connect2sazad', 'connect2sazad', '2023-09-20 08:00:32', '2023-09-20 08:00:32'),
(69, 'file:///C:/Users/user/Downloads/dist/component-navs.html#', 'tsrcB', '127.0.0.1', 0, 180, 1, '2023-09-20 08:02:23', '2024-03-18 04:32:23', 0, 'connect2sazad', 'connect2sazad', '2023-09-20 08:02:23', '2023-09-20 08:02:23'),
(70, 'https://chat.openai.com/c/c0df1a0e-af53-4492-997d-91b3b298da14', 'wjxPA', '127.0.0.1', 0, 180, 1, '2023-09-20 08:02:56', '2024-03-18 04:32:56', 0, 'connect2sazad', 'connect2sazad', '2023-09-20 08:02:56', '2023-09-20 08:02:56'),
(71, 'https://chat.openai.com/c/d27ce8ea-6a0d-4946-b61a-e051b56bc4a7', 'kXF7I', '127.0.0.1', 1, 180, 1, '2023-09-20 08:09:10', '2024-03-18 04:39:10', 0, 'connect2sazad', 'connect2sazad', '2023-09-20 08:09:10', '2023-09-20 08:09:13'),
(72, 'https://www.facebook.com/shopweb.in/', '3A8We', '127.0.0.1', 1, 180, 1, '2023-09-20 08:16:12', '2024-03-18 04:46:12', 0, 'connect2sazad', 'connect2sazad', '2023-09-20 08:16:12', '2023-09-20 07:45:18'),
(73, 'file:///C:/Users/user/Downloads/dist/component-modal.html', 'nIQUz', '127.0.0.1', 0, 180, 1, '2023-09-20 10:14:45', '2024-03-18 06:44:45', 0, 'admin', 'admin', '2023-09-20 10:14:45', '2023-09-20 10:14:45'),
(74, 'file:///C:/Users/user/Downloads/dist/component-tooltip.html', 'kCfmH', '127.0.0.1', 0, 180, 1, '2023-09-20 10:15:05', '2024-03-18 06:45:05', 0, 'admin', 'admin', '2023-09-20 10:15:05', '2023-09-20 10:15:05'),
(75, 'https://github.com/connect2sazad/shikayaat/blob/master/includes/api.php', 'm2qT9', '127.0.0.1', 1, 180, 1, '2023-09-20 09:17:02', '2024-03-18 05:47:02', 0, 'connect2sazad', 'connect2sazad', '2023-09-20 09:17:02', '2023-09-20 09:17:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(200) NOT NULL,
  `user_type` int(11) NOT NULL DEFAULT 2,
  `username` varchar(100) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `pin` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `user_type`, `username`, `phone`, `password`, `email`, `address`, `city`, `state`, `pin`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 1, 'admin', 7894560023, '$2y$10$MDRuIGfXJrGM5pKB7h843Ortg4hS4Ono3AHn/kOuZUcSECm2LCo3W', 'admin@gmail.com', '', '', '0', '0', '2023-09-16 07:28:27', '2023-09-21 08:08:16'),
(2, 'Sazad Ahemad', 2, 'connect2sazad', 8763438208, '$2y$10$MDRuIGfXJrGM5pKB7h843Ortg4hS4Ono3AHn/kOuZUcSECm2LCo3W', 'mail2sazad@gmail.com', 'Khordha', 'Khordha', 'Odisha', '752055', '2023-09-17 05:19:46', '2023-09-21 08:11:16'),
(4, 'ujhju', 2, 'dfgd', 6543987102, 'dfgdf', 'dfhdf', '', '', '0', '0', '2023-09-18 12:50:11', '2023-09-21 08:08:25'),
(5, 'Smitasuman Mohapatra', 2, 'smita', 9348482191, '$2y$10$5d5XljsO1ffLuTFNNvmmKOJCSuOnQMPLF4M33BHc/kSk6uqBOkTSq', '', '', '', '0', '0', '2023-09-18 12:56:16', '2023-09-18 12:56:16');

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `id` int(11) NOT NULL,
  `type_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `type_name`) VALUES
(1, 'admin'),
(2, 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `qrcodes`
--
ALTER TABLE `qrcodes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `redirects`
--
ALTER TABLE `redirects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `short_url_code` (`short_url_code`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `user_type` (`user_type`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type` (`type_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `qrcodes`
--
ALTER TABLE `qrcodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `redirects`
--
ALTER TABLE `redirects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `qrcodes`
--
ALTER TABLE `qrcodes`
  ADD CONSTRAINT `qrcodes_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`username`),
  ADD CONSTRAINT `qrcodes_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `users` (`username`);

--
-- Constraints for table `redirects`
--
ALTER TABLE `redirects`
  ADD CONSTRAINT `redirects_ibfk_1` FOREIGN KEY (`updated_by`) REFERENCES `users` (`username`),
  ADD CONSTRAINT `redirects_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`username`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_type`) REFERENCES `user_types` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
