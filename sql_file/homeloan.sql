-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2023 at 06:50 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `homeloan`
--

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE `loan` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `loan_amt` varchar(255) NOT NULL,
  `loan_duration` varchar(255) NOT NULL,
  `annual_interest_rate` double DEFAULT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1-under review\r\n2- approve\r\n3- Amount transferred\r\n4- repayment process\r\n5- loan finished',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loan`
--

INSERT INTO `loan` (`id`, `user_id`, `loan_amt`, `loan_duration`, `annual_interest_rate`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 1, '50000', '3', NULL, 1, '2023-04-01 12:29:17', '2023-04-01 12:29:17', NULL),
(6, 4, '50000', '5', NULL, 3, '2023-04-02 02:55:35', '2023-04-03 10:10:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `loan_remarks`
--

CREATE TABLE `loan_remarks` (
  `id` bigint(20) NOT NULL,
  `loan_id` bigint(20) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `remark` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loan_remarks`
--

INSERT INTO `loan_remarks` (`id`, `loan_id`, `status`, `remark`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 6, 2, 'Loan Approve', '2023-04-03 08:49:52', '2023-04-03 08:49:52', NULL),
(3, 6, 3, 'Money has been transferred', '2023-04-03 10:10:08', '2023-04-03 10:10:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` bigint(20) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` tinyint(4) NOT NULL DEFAULT 2,
  `active` tinyint(4) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `phone`, `password`, `role`, `active`, `token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Piyush Agrawal', 'piyush@gmail.com', '7024975928', '$2y$10$CjfWIyG3X8CIAIDerdct0eXyPBvjBKy1Y0g6Gmruq4V7s74RON/EO', 2, 1, 'eUaV3RD8GGTvI0eqjdv8YOEieE77RTyjdseu9FWi', '2023-04-01 01:23:53', '2023-04-01 01:23:53', NULL),
(2, 'Piyush', 'piyush1@gmail.com', '7024971928', '$2y$10$1UtYgGXIv0MphuTDtMphlOso.5Fk9UzUK7eYNaUMEZ8V5ymGOyT9G', 2, 0, 'jEp1UMk1B4FIXe5XNU0i9VqGLHyDme9atjMOyAZn', '2023-04-01 01:29:21', '2023-04-03 12:59:54', NULL),
(3, 'Piyush', 'piyush3@gmail.com', '7024971928', '$2y$10$WfYyy1kofRez4ZaBq/2hb.OUuaHaAfjZg07sbPtHQeWjLlsxF8c6u', 2, 1, 'VIfeaujejj537kU6IA3qkI3CWmzKVPmRdWGfifUf', '2023-04-01 01:36:46', '2023-04-01 01:36:46', NULL),
(4, 'Aman Kumar Sahu', 'aman@gmail.com', '07829229201', '$2y$10$jojO1CmhNPLz8MYWR1nrIeYF6Dyz/JV34S/XZOKOidi/105JndJry', 2, 1, 'qQ1BpEbfRSKcD8fwOJ4VwtUSBbA8t1eo4yVYL6oa', '2023-04-02 02:53:45', '2023-04-02 03:40:06', NULL),
(5, 'Admin', 'admin@gmail.com', '78277282821', '$2y$10$1UtYgGXIv0MphuTDtMphlOso.5Fk9UzUK7eYNaUMEZ8V5ymGOyT9G', 1, 1, 'jwwhhhh2%421UtYgGXIv0MphuTDtMphlOso', '2023-04-02 17:09:26', '2023-04-03 06:25:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `job_type` text NOT NULL,
  `annual_salary` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `address_proof` text NOT NULL,
  `photo` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `job_type`, `annual_salary`, `address`, `address_proof`, `photo`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 1, 'Fruit Shop', '10000', 'Raipur Chhattisgarh', 'adarh_card_1680371956.png', 'photo_1680371956.png', '2023-04-01 07:14:56', '2023-04-01 12:29:17', NULL),
(4, 4, 'I am a rider go higher.', '100000', 'Mumbai Haryana', 'adarh_card_1680423935.png', 'photo_1680423935.png', '2023-04-02 02:55:35', '2023-04-02 02:55:35', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `loan_remarks`
--
ALTER TABLE `loan_remarks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `loan`
--
ALTER TABLE `loan`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `loan_remarks`
--
ALTER TABLE `loan_remarks`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
