-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2020 at 03:01 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ehealth`
--

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `nik` bigint(16) NOT NULL,
  `name` varchar(64) NOT NULL,
  `birth` date NOT NULL,
  `place` varchar(64) NOT NULL,
  `gender` varchar(64) NOT NULL,
  `blood_type` varchar(64) NOT NULL,
  `address` varchar(256) NOT NULL,
  `religion` varchar(64) NOT NULL,
  `marital_status` varchar(64) NOT NULL,
  `job` varchar(64) NOT NULL,
  `nationality` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `nik`, `name`, `birth`, `place`, `gender`, `blood_type`, `address`, `religion`, `marital_status`, `job`, `nationality`) VALUES
(10, 9876543210987654, 'Naga Siren', '1999-05-12', 'Radiant', 'Perempuan', 'AB+', 'Jl. Toplane no 123 Stockholm', 'Konghucu', 'Cerai Mati', 'Penyanyi', 'Seattle'),
(12, 1923161514151214, 'Tatang Tango', '2000-07-07', 'Radiant', 'Laki-laki', 'O+', 'Jl. Midlane No. 05 Nairobi', '', '', 'Petani', 'Kenya'),
(17, 9865321245786532, 'Ian Icewall', '2020-09-25', 'Wild West', 'Laki-laki', 'AB-', 'Jl. Toplane No. 153 Rio', 'Islam', 'Belum Kawin', 'Peternak', 'Brazil'),
(18, 7894563216549514, 'Fafaojan', '1995-05-05', 'Polus', 'Laki-laki', 'A+', 'Jl. Cafetaria No. 101 Denver', 'Islam', 'Belum Kawin', 'Streamer', 'WNI');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `poly_id` int(11) NOT NULL,
  `poly_reg_id` int(11) NOT NULL,
  `pay_date` varchar(64) NOT NULL,
  `total` int(11) NOT NULL,
  `status` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `patient_id`, `poly_id`, `poly_reg_id`, `pay_date`, `total`, `status`) VALUES
(1, 10, 3, 2, '13 September 2020, 6:28 pm', 123000, 'Belum dibayar'),
(2, 12, 1, 1, '13 September 2020, 7:01 pm', 57000, 'Lunas'),
(3, 10, 3, 2, '13 September 2020, 8:50 pm', 127500, 'Belum dibayar'),
(4, 12, 1, 1, '13 September 2020, 9:12 pm', 82000, 'Belum dibayar'),
(5, 12, 1, 1, '13 September 2020, 10:15 pm', 112000, 'Belum dibayar'),
(6, 10, 3, 2, '14 September 2020, 6:23 pm', 52500, 'Belum dibayar'),
(7, 18, 3, 3, '14 September 2020, 7:46 pm', 152500, 'Lunas'),
(8, 17, 2, 5, '15 September 2020, 7:38 am', 1500, 'Belum dibayar'),
(9, 17, 2, 5, '15 September 2020, 7:41 am', 1500, 'Belum dibayar'),
(10, 17, 2, 5, '15 September 2020, 7:45 am', 1500, 'Belum dibayar'),
(11, 18, 3, 3, '15 September 2020, 7:52 am', 59277, 'Belum dibayar');

-- --------------------------------------------------------

--
-- Table structure for table `poly`
--

CREATE TABLE `poly` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `cost` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `poly`
--

INSERT INTO `poly` (`id`, `name`, `cost`) VALUES
(1, 'Poli Anak', 'Rp. 2.000'),
(2, 'Poli Umum', 'Rp. 1.500'),
(3, 'Poli Mata', 'Rp. 2.500'),
(4, 'Poli Gigi', 'Rp. 2.000');

-- --------------------------------------------------------

--
-- Table structure for table `poly_registration`
--

CREATE TABLE `poly_registration` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `poly_id` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `poly_registration`
--

INSERT INTO `poly_registration` (`id`, `patient_id`, `poly_id`, `date`) VALUES
(1, 12, 1, '2020-09-16'),
(3, 18, 3, '2020-09-16'),
(5, 17, 2, '2020-09-17');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(12, 'Bakti Qilan Mufid', 'admin', '3x4_biru.png', '$2y$10$ZKRROgGZ1jgW.63oMjCKLOIV5qzdDz0PfdXaINDcQDk7dvdvWpvKG', 1, 1, 1599818540),
(14, 'Kowalski Pinguin', 'operator', 'kowalski.jpg', '$2y$10$AVIkVZ3dHUxcMjgUdCrWFOa/OECXJy/zwvATmCLqVmnOrjY0U42GS', 2, 1, 1599820904);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(3, 2, 2),
(7, 1, 3),
(8, 1, 2),
(13, 2, 5),
(14, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'User'),
(5, 'Pelayanan');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Operator');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(2, 2, 'My Profile', 'user', 'fas fa-fw fa-user', 1),
(3, 2, 'Edit Profile', 'user/edit', 'fas fa-fw fa-user-edit', 1),
(7, 1, 'Role', 'admin/role', 'fas fa-fw fa-user-tie', 1),
(8, 2, 'Change Password', 'user/changepassword', 'fas fa-fw fa-key', 1),
(9, 5, 'Pendaftaran Pasien Baru', 'pelayanan/index', 'fas fa-fw fa-pen-alt', 1),
(10, 5, 'Pendataan Pasien', 'pelayanan/p_pasien', 'fas fa-fw fa-sign', 1),
(11, 5, 'Pendaftaran Poli', 'pelayanan/daftar', 'fas fa-fw fa-keyboard', 1),
(12, 5, 'Pendataan Pasien Poli', 'pelayanan/p_poli', 'fas fa-fw fa-pen-alt', 1),
(13, 5, 'Pencatatan Pembayaran', 'pelayanan/pembayaran', 'fas fa-fw fa-dollar-sign', 1),
(16, 1, 'Kelola poli', 'admin/poli', 'fas fa-fw fa-user-tie', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poly`
--
ALTER TABLE `poly`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poly_registration`
--
ALTER TABLE `poly_registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `poly`
--
ALTER TABLE `poly`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `poly_registration`
--
ALTER TABLE `poly_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
