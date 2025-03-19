-- -------------------------------------------------------------
-- -------------------------------------------------------------
-- TablePlus 1.2.4
--
-- https://tableplus.com/
--
-- Database: mysql
-- Generation Time: 2025-03-20 02:10:59.432605
-- -------------------------------------------------------------

CREATE TABLE `offers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_nasabah` varchar(100) NOT NULL,
  `periode_awal` date NOT NULL,
  `periode_akhir` date NOT NULL,
  `kendaraan` varchar(100) NOT NULL,
  `harga_pertanggungan` decimal(15,2) NOT NULL,
  `jenis_pertanggungan` int(11) NOT NULL CHECK (`jenis_pertanggungan` in (1,2)),
  `risiko_banjir` tinyint(1) DEFAULT 0,
  `risiko_gempa` tinyint(1) DEFAULT 0,
  `total_premi` decimal(15,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` enum('admin','agent','marketing') NOT NULL DEFAULT 'marketing',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `insurance_db`.`offers` (`id`, `nama_nasabah`, `periode_awal`, `periode_akhir`, `kendaraan`, `harga_pertanggungan`, `jenis_pertanggungan`, `risiko_banjir`, `risiko_gempa`, `total_premi`, `created_at`) VALUES 
(1, 'Budi R', '2024-01-01', '2025-01-01', 'Toyota Avanza', 200000000.00, 1, 1, 0, 400000.00, '2025-03-19 01:18:42'),
(2, 'Amri', '2024-02-20', '2025-02-20', 'Beat', 12000000.00, 1, 1, 1, 26400.00, '2025-03-19 01:39:54'),
(3, 'Jurdi', '2021-02-01', '2024-02-01', 'Pajero', 520000000.00, 1, 1, 1, 1144000.00, '2025-03-19 02:53:46'),
(4, 'Bobi', '2025-02-02', '2026-02-02', 'Vario', 25000000.00, 2, 0, 1, 130000.00, '2025-03-19 02:54:19');

INSERT INTO `insurance_db`.`users` (`id`, `username`, `password`, `created_at`, `role`) VALUES 
(1, 'admin', '$2y$10$7x4vMH/JQ2KSR98uiWkI9ueybHYSnE5wx3iBZoM3eoX9qeo8P1JFu', '2025-03-18 22:20:14', 'admin'),
(2, 'budi', '$2y$10$TeVXzhok/IJED/Awu/uELuX9sNfjh.tIab123gnJrB.mcJ7IFn0Ee', '2025-03-20 00:28:19', 'agent'),
(3, 'kartini', '$2y$10$iTdJap6PssKrbam9fx4.Ju6.l55NdVK9hhGPKpzbBLYdLLVNxVqT2', '2025-03-20 00:28:58', 'marketing');

