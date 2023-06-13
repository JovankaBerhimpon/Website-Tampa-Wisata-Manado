-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 13, 2023 at 01:24 PM
-- Server version: 10.5.20-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id20905761_login_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `usernames` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `passwords` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `usernames`, `email`, `passwords`, `image`) VALUES
(153, 'Jovanka Berhimpon', 'jovankaberhimpon@gmail.com', 'e58cc5ca94270acaceed13bc82dfedf7', ''),
(154, 'Naomi Kamea', 'naomikamea@gmail.com', 'b53477c2821c1bf0da5d40e57b870d35', ''),
(155, 'Shergio Wuisan', 'shergiowuisan@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `komentar` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `nama`, `komentar`, `foto`, `rating`) VALUES
(5, 'Jovanka Berhimpon', 'Dari atas gunung lokon torang boleh lia pemandangan pe gagaaa skali,  depe jalur mendaki cma dekat soalnya depe jalan oto so sampe di kaki gunung, depe kawah memang karu ba asap-asap ', 'uploaded_img/gunung lokon.jpg', 4),
(6, 'Naomi Kamea', 'Pemandangannya bagus skali kong pe banyak spot foto, kalo malam ley nd kalah gaga soalnya ada deng depe lampu-lampu  yang klo mo foto pe bagus skli.', 'uploaded_img/DanauuuuLinow.jpg', 5),
(7, 'Shergio Wuisan', 'Di pante Pulisan depe aer ba garam makanya jangan minum wkwk,  pemandangan di sana komang pe gaga skali... dari depe paser putih kong depe aer pe jernih, pokonya bagus for mo pasiar keluarga.', 'uploaded_img/WhatsApp Image 2023-06-12 at 23.15.35.jpg', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
