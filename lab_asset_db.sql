-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2025 at 08:33 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lab_asset_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Barang Habis Pakai', '', '2025-07-16 08:10:24', '2025-07-16 08:10:24');

-- --------------------------------------------------------

--
-- Table structure for table `conditions`
--

CREATE TABLE `conditions` (
  `id` int(11) NOT NULL,
  `condition_name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `conditions`
--

INSERT INTO `conditions` (`id`, `condition_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Baik', '', '2025-07-16 08:43:10', '2025-07-16 08:43:10'),
(2, 'Rusak', '', '2025-07-16 08:43:18', '2025-07-16 08:43:18'),
(3, 'Expired', '', '2025-07-16 08:43:27', '2025-07-16 08:43:27');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `item_code` varchar(20) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL,
  `item_type_id` int(11) NOT NULL,
  `power_type_id` int(11) DEFAULT NULL,
  `item_kind_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `condition_id` int(11) NOT NULL,
  `brand` varchar(100) DEFAULT NULL,
  `specification` text DEFAULT NULL,
  `initial_stock` int(11) NOT NULL DEFAULT 0,
  `current_stock` int(11) NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `item_code`, `item_name`, `category_id`, `item_type_id`, `power_type_id`, `item_kind_id`, `unit_id`, `location_id`, `condition_id`, `brand`, `specification`, `initial_stock`, `current_stock`, `description`, `created_at`, `updated_at`) VALUES
(1, 'PKCB-000001', 'Aquades', 1, 2, 3, 2, 3, 2, 1, 'Aquades', 'Aquades 10 liter', 6, 7, '', '2025-07-16 08:44:23', '2025-07-21 05:10:59'),
(3, 'PKCB-000002', 'Keyboad', 1, 1, 2, 3, 2, 1, 1, 'Logi', 'wireless', 5, 2, '', '2025-07-16 08:47:50', '2025-07-17 09:23:09');

-- --------------------------------------------------------

--
-- Table structure for table `item_incomings`
--

CREATE TABLE `item_incomings` (
  `id` int(11) NOT NULL,
  `incoming_code` varchar(20) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date_in` date NOT NULL,
  `supplier` varchar(100) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_incomings`
--

INSERT INTO `item_incomings` (`id`, `incoming_code`, `item_id`, `quantity`, `date_in`, `supplier`, `notes`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'BM-20250716-0001', 1, 4, '2025-07-16', 'PT COPY', 'Masuk ', 1, '2025-07-16 08:50:52', '2025-07-16 08:50:52');

-- --------------------------------------------------------

--
-- Table structure for table `item_kinds`
--

CREATE TABLE `item_kinds` (
  `id` int(11) NOT NULL,
  `kind_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_kinds`
--

INSERT INTO `item_kinds` (`id`, `kind_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Besi', '', '2025-07-16 08:14:32', '2025-07-16 08:14:32'),
(2, 'Chemical', '', '2025-07-16 08:14:41', '2025-07-16 08:14:41'),
(3, 'Plastik', '', '2025-07-16 08:14:54', '2025-07-16 08:14:54');

-- --------------------------------------------------------

--
-- Table structure for table `item_outgoings`
--

CREATE TABLE `item_outgoings` (
  `id` int(11) NOT NULL,
  `outgoing_code` varchar(20) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date_out` date NOT NULL,
  `recipient` varchar(100) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_outgoings`
--

INSERT INTO `item_outgoings` (`id`, `outgoing_code`, `item_id`, `quantity`, `date_out`, `recipient`, `notes`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'BK-20250717-0001', 1, 2, '2025-07-17', 'syarif', 'demo', 1, '2025-07-17 08:00:48', '2025-07-17 08:00:48'),
(2, 'BK-20250717-0002', 3, 3, '2025-07-17', 'syarif2', 'demo2', 1, '2025-07-17 09:23:09', '2025-07-17 09:23:09');

-- --------------------------------------------------------

--
-- Table structure for table `item_types`
--

CREATE TABLE `item_types` (
  `id` int(11) NOT NULL,
  `type_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_types`
--

INSERT INTO `item_types` (`id`, `type_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Alat', '', '2025-07-16 08:12:11', '2025-07-16 08:12:11'),
(2, 'Material', '', '2025-07-16 08:12:30', '2025-07-16 08:12:46');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `location_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `location_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Lab Lantai 2', '', '2025-07-16 08:16:19', '2025-07-16 08:16:19'),
(2, 'Lab Lantai 3', '', '2025-07-16 08:16:30', '2025-07-16 08:16:30');

-- --------------------------------------------------------

--
-- Table structure for table `power_types`
--

CREATE TABLE `power_types` (
  `id` int(11) NOT NULL,
  `power_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `power_types`
--

INSERT INTO `power_types` (`id`, `power_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Listrik', '', '2025-07-16 08:13:30', '2025-07-16 08:13:30'),
(2, 'Baterai', '', '2025-07-16 08:13:44', '2025-07-16 08:13:44'),
(3, 'Tanpa Daya', '', '2025-07-16 08:13:56', '2025-07-16 08:13:56');

-- --------------------------------------------------------

--
-- Table structure for table `stock_opnames`
--

CREATE TABLE `stock_opnames` (
  `id` int(11) NOT NULL,
  `opname_code` varchar(20) NOT NULL,
  `item_id` int(11) NOT NULL,
  `stock_before` int(11) NOT NULL,
  `stock_after` int(11) NOT NULL,
  `difference` int(11) NOT NULL,
  `opname_date` date NOT NULL,
  `notes` text DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock_opnames`
--

INSERT INTO `stock_opnames` (`id`, `opname_code`, `item_id`, `stock_before`, `stock_after`, `difference`, `opname_date`, `notes`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'OP-20250721-0001', 1, 8, 7, -1, '2025-07-21', 'demo kurang 1', 1, '2025-07-21 05:10:59', '2025-07-21 05:10:59');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(11) NOT NULL,
  `unit_name` varchar(50) NOT NULL,
  `symbol` varchar(10) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `unit_name`, `symbol`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Unit', 'Unt', '', '2025-07-16 08:15:34', '2025-07-16 08:15:34'),
(2, 'Pcs', 'Pcs', '', '2025-07-16 08:15:49', '2025-07-16 08:15:49'),
(3, 'Buah', 'Bh', '', '2025-07-16 08:16:01', '2025-07-16 08:16:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `role` enum('admin','operator','viewer') NOT NULL DEFAULT 'operator',
  `photo` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `fullname`, `role`, `photo`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@lab.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator', 'admin', NULL, '2025-07-15 10:16:53', NULL),
(2, 'syarif', 'syarif@gmail.com', '$2y$10$oJkwm59XlfApSG3scphHoupgV4fJcJV39JAnZ2J4DHuP2bXUVnxia', 'A Syarif', 'operator', NULL, '2025-07-16 08:09:31', '2025-07-16 08:09:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conditions`
--
ALTER TABLE `conditions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `item_code` (`item_code`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `item_type_id` (`item_type_id`),
  ADD KEY `power_type_id` (`power_type_id`),
  ADD KEY `item_kind_id` (`item_kind_id`),
  ADD KEY `unit_id` (`unit_id`),
  ADD KEY `location_id` (`location_id`),
  ADD KEY `condition_id` (`condition_id`);

--
-- Indexes for table `item_incomings`
--
ALTER TABLE `item_incomings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `incoming_code` (`incoming_code`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `item_kinds`
--
ALTER TABLE `item_kinds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_outgoings`
--
ALTER TABLE `item_outgoings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `outgoing_code` (`outgoing_code`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `item_types`
--
ALTER TABLE `item_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `power_types`
--
ALTER TABLE `power_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_opnames`
--
ALTER TABLE `stock_opnames`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `opname_code` (`opname_code`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `conditions`
--
ALTER TABLE `conditions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `item_incomings`
--
ALTER TABLE `item_incomings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `item_kinds`
--
ALTER TABLE `item_kinds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `item_outgoings`
--
ALTER TABLE `item_outgoings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `item_types`
--
ALTER TABLE `item_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `power_types`
--
ALTER TABLE `power_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stock_opnames`
--
ALTER TABLE `stock_opnames`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `items_ibfk_2` FOREIGN KEY (`item_type_id`) REFERENCES `item_types` (`id`),
  ADD CONSTRAINT `items_ibfk_3` FOREIGN KEY (`power_type_id`) REFERENCES `power_types` (`id`),
  ADD CONSTRAINT `items_ibfk_4` FOREIGN KEY (`item_kind_id`) REFERENCES `item_kinds` (`id`),
  ADD CONSTRAINT `items_ibfk_5` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`),
  ADD CONSTRAINT `items_ibfk_6` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`),
  ADD CONSTRAINT `items_ibfk_7` FOREIGN KEY (`condition_id`) REFERENCES `conditions` (`id`);

--
-- Constraints for table `item_incomings`
--
ALTER TABLE `item_incomings`
  ADD CONSTRAINT `item_incomings_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `item_incomings_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `item_outgoings`
--
ALTER TABLE `item_outgoings`
  ADD CONSTRAINT `item_outgoings_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `item_outgoings_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `stock_opnames`
--
ALTER TABLE `stock_opnames`
  ADD CONSTRAINT `stock_opnames_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `stock_opnames_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
