-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2023 at 03:25 PM
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
-- Table structure for table `redirects`
--

CREATE TABLE `redirects` (
  `id` int(11) NOT NULL,
  `full_url` longtext NOT NULL,
  `short_url_code` varchar(50) NOT NULL,
  `hits` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `redirects`
--

INSERT INTO `redirects` (`id`, `full_url`, `short_url_code`, `hits`, `created_at`, `updated_at`) VALUES
(9, 'https://www.google.com/search?q=testing+code&rlz=1C1CHBF_en-GBIN1075IN1075&oq=te&gs_lcrp=EgZjaHJvbWUqBggAEEUYOzIGCAAQRRg7MgYIARBFGDkyDwgCEAAYQxiDARixAxiKBTINCAMQABiDARixAxiABDIGCAQQRRg8MgYIBRBFGDwyBggGEEUYPDIGCAcQRRg80gEIMjAwOWowajeoAgCwAgA&sourceid=chrome&ie=UTF-8', 'wTPj2C', 0, '2023-09-15 13:05:47', '2023-09-15 13:05:47'),
(10, 'https://www.google.com/search?q=html+css&rlz=1C1CHBF_en-GBIN1075IN1075&oq=html+css&gs_lcrp=EgZjaHJvbWUqDQgAEAAYgwEYsQMYgAQyDQgAEAAYgwEYsQMYgAQyDQgBEAAYgwEYsQMYgAQyDQgCEAAYgwEYsQMYgAQyBwgDEAAYgAQyDQgEEAAYgwEYsQMYgAQyBggFEEUYPDIGCAYQRRg8MgYIBxBFGDzSAQgxMjk0ajBqN6gCALACAA&sourceid=chrome&ie=UTF-8', 'WlCogE', 0, '2023-09-15 13:06:39', '2023-09-15 13:06:39'),
(11, 'https://www.w3schools.com/html/html_css.asp', 'rxPhqG', 0, '2023-09-15 13:07:11', '2023-09-15 13:07:11'),
(12, 'https://itsjameswhite.medium.com/five-ways-to-check-shortened-links-for-safety-31e8e0dc1865', 'WOZPNf', 0, '2023-09-15 13:24:26', '2023-09-15 13:24:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `redirects`
--
ALTER TABLE `redirects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `short_url_code` (`short_url_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `redirects`
--
ALTER TABLE `redirects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
