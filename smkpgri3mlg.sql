-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2021 at 02:02 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smkpgri3mlg`
--
CREATE DATABASE IF NOT EXISTS `smkpgri3mlg` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `smkpgri3mlg`;

-- --------------------------------------------------------

--
-- Table structure for table `agenda`
--

CREATE TABLE `agenda` (
  `agenda_id` bigint(20) UNSIGNED NOT NULL,
  `agenda_title` text NOT NULL,
  `agenda_description` text NOT NULL,
  `agenda_start` date DEFAULT NULL,
  `agenda_end` date DEFAULT NULL,
  `file_directory` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `isactive` tinyint(1) NOT NULL,
  `isapprove` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agenda`
--

INSERT INTO `agenda` (`agenda_id`, `agenda_title`, `agenda_description`, `agenda_start`, `agenda_end`, `file_directory`, `created_at`, `created_by`, `updated_at`, `updated_by`, `isactive`, `isapprove`) VALUES
(2, 'Lomba 10 Novembar 2k19', '<p>test</p>\r\n', '2019-11-09', '2019-11-11', '', '2019-11-05 15:18:32', 4, '2019-11-05 15:18:32', 4, 1, 1),
(3, '3RPA sedang ujian', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus iaculis in neque id semper. Morbi justo sem, elementum id ante ac, sodales consectetur massa. Donec ac nisl sollicitudin sem scelerisque auctor ut eu libero. Sed ultrices mollis nulla, sit amet malesuada enim efficitur et. Etiam ut neque mauris. Mauris gravida sem est, ac consectetur augue porttitor in. Nunc ex libero, condimentum in hendrerit eget, aliquet a dui.</p>\r\n\r\n<p>Duis non bibendum eros, blandit sagittis augue. Phasellus lacinia aliquam metus nec molestie. Mauris est risus, blandit ut pulvinar quis, ultrices in ante. Cras luctus augue at viverra sagittis. Etiam et arcu quis nisi venenatis finibus quis at urna. Mauris aliquam dui ante, nec bibendum neque euismod eget. Morbi faucibus condimentum velit, vel ullamcorper quam rhoncus quis. Phasellus arcu ipsum, scelerisque vitae enim cursus, iaculis euismod lacus. Etiam luctus, tortor at fringilla dapibus, ipsum diam vestibulum enim, eu accumsan elit magna eget ligula. Nunc rhoncus nulla id massa eleifend, sit amet tincidunt lorem dignissim. Maecenas consequat egestas tincidunt. Phasellus posuere, enim ut convallis rhoncus, mi erat molestie leo, nec pharetra felis sem eu nisl.</p>\r\n', NULL, NULL, 'public/images/uploads/IMG_20190926_095446.jpg', '2019-11-13 14:52:28', 4, '2019-11-13 14:52:28', 4, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `berita_id` bigint(20) UNSIGNED NOT NULL,
  `berita_title` text NOT NULL,
  `berita_description` text DEFAULT NULL,
  `file_directory` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `isactive` tinyint(1) NOT NULL,
  `isapprove` tinyint(1) NOT NULL DEFAULT 0,
  `view_count` int(7) NOT NULL DEFAULT 0,
  `view_count_week` int(7) UNSIGNED NOT NULL DEFAULT 0,
  `view_count_month` int(7) UNSIGNED NOT NULL DEFAULT 0,
  `view_count_year` int(7) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`berita_id`, `berita_title`, `berita_description`, `file_directory`, `created_at`, `created_by`, `updated_at`, `updated_by`, `isactive`, `isapprove`, `view_count`, `view_count_week`, `view_count_month`, `view_count_year`) VALUES
(3, 'Ketiduran ea', '<p>TEST</p>\r\n', 'public/images/uploads/IMG_20191011_121455.jpg', '2019-10-24 01:48:06', 4, '2019-10-24 01:48:06', 4, 1, 1, 0, 0, 0, 0),
(4, 'SMK PGRI 3 Mewajibkan seluruh warganya untuk memakai Cosplay Pahlawan di tanggal 11 November 2019', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus iaculis in neque id semper. Morbi justo sem, elementum id ante ac, sodales consectetur massa. Donec ac nisl sollicitudin sem scelerisque auctor ut eu libero. Sed ultrices mollis nulla, sit amet malesuada enim efficitur et. Etiam ut neque mauris. Mauris gravida sem est, ac consectetur augue porttitor in. Nunc ex libero, condimentum in hendrerit eget, aliquet a dui.</p>\r\n\r\n<p>Duis non bibendum eros, blandit sagittis augue. Phasellus lacinia aliquam metus nec molestie. Mauris est risus, blandit ut pulvinar quis, ultrices in ante. Cras luctus augue at viverra sagittis. Etiam et arcu quis nisi venenatis finibus quis at urna. Mauris aliquam dui ante, nec bibendum neque euismod eget. Morbi faucibus condimentum velit, vel ullamcorper quam rhoncus quis. Phasellus arcu ipsum, scelerisque vitae enim cursus, iaculis euismod lacus. Etiam luctus, tortor at fringilla dapibus, ipsum diam vestibulum enim, eu accumsan elit magna eget ligula. Nunc rhoncus nulla id massa eleifend, sit amet tincidunt lorem dignissim. Maecenas consequat egestas tincidunt. Phasellus posuere, enim ut convallis rhoncus, mi erat molestie leo, nec pharetra felis sem eu nisl.</p>\r\n', 'public/images/uploads/31efb48a-136c-4e29-bfd8-4234a3507e2a.jpg', '2019-11-10 05:34:45', 4, '2019-11-20 21:40:02', 4, 1, 1, 21, 1, 21, 21),
(8, 'Ruang Kelas', '<p><strong>Ruang Kelas</strong>&nbsp;adalah suatu&nbsp;<a href=\"https://id.wikipedia.org/wiki/Ruangan\">ruangan</a>&nbsp;dalam bangunan&nbsp;<a href=\"https://id.wikipedia.org/wiki/Sekolah_(institusi)\">sekolah</a>, yang berfungsi sebagai tempat untuk kegiatan tatap muka dalam proses&nbsp;<a href=\"https://id.wikipedia.org/w/index.php?title=Kegiatan_belajar_mengajar&amp;action=edit&amp;redlink=1\">kegiatan belajar mengajar</a>&nbsp;(KBM). Mebeler dalam ruangan ini terdiri dari&nbsp;<a href=\"https://id.wikipedia.org/wiki/Meja\">meja</a>&nbsp;<a href=\"https://id.wikipedia.org/wiki/Siswa\">siswa</a>,&nbsp;<a href=\"https://id.wikipedia.org/wiki/Kursi\">kursi</a>&nbsp;siswa, meja&nbsp;<a href=\"https://id.wikipedia.org/wiki/Guru\">guru</a>, lemari kelas,&nbsp;<a href=\"https://id.wikipedia.org/wiki/Papan_tulis\">papan tulis</a>, serta aksesoris ruangan lainnya yang sesuai. Ukuran yang umum adalah 9m x 8m. Ruang kelas memiliki syarat&nbsp;<a href=\"https://id.wikipedia.org/w/index.php?title=Kelayakan&amp;action=edit&amp;redlink=1\">kelayakan</a>&nbsp;dan&nbsp;<a href=\"https://id.wikipedia.org/wiki/Standar\">standar</a>&nbsp;tertentu, misalnya ukuran,&nbsp;<a href=\"https://id.wikipedia.org/w/index.php?title=Pencahayaan&amp;action=edit&amp;redlink=1\">pencahayaan</a>&nbsp;alami,&nbsp;<a href=\"https://id.wikipedia.org/w/index.php?title=Sirkulasi_udara&amp;action=edit&amp;redlink=1\">sirkulasi udara</a>, dan persyaratan lainnya yang telah dibakukan oleh pihak berwenang terkait.</p>\r\n', 'public/images/uploads/1574234472.jpg', '2019-11-20 07:21:11', 4, '2019-11-20 07:53:29', 4, 0, 0, 0, 0, 0, 0),
(12, 'Banyak Siswa terkena buku kasus, Kabid proses kewalahan ngebom SMS ke wali murid', '<p>Padatnya aktivitas ayah dan bunda terekam kuat dalam benakku. Kerja keras seakan jadi menu wajib bagiku. Namun, ada hal yang menjadi titik lemahku. Dua kali tangisku pecah ketika cita-citaku tak tersampaikan. Pertama, ketika gagal masuk fakultas kedokteran karena faktor biaya. Kuingat kata-kata bunda di telingaku.</p>\r\n\r\n<p>&ldquo;Kita tak cukup uang untuk kamu masuk Fakultas Kedokteran. Sabar ya, Nak!&rdquo; ucap Bunda lembut, tapi pasti.</p>\r\n\r\n<p>Kedua, ketika gagal mendaftar ke STPDN karena tinggi badan kurang. Kegagalan itu tentu saja membuatku terluka. Ayah Bunda tiada putus-putusnya membangkitkan diriku hingga kedua kakiku benar-benar mampu berpijak.</p>\r\n', 'public/images/uploads/1574318846.jpg', '2021-02-25 03:57:00', 4, '2019-11-21 06:47:39', 4, 1, 1, 89, 3, 89, 89),
(11, 'Kostum SMK PGRI 3 Malang saat Hari Pahlawan Nasional', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tincidunt nisi vel augue dictum, et ullamcorper lacus aliquam. Nunc vel ullamcorper lacus, eget viverra lectus. Duis lacinia ac lacus ac egestas. Nulla pellentesque dapibus arcu, vel tincidunt est varius a. Maecenas ultricies ex a elit eleifend pellentesque id quis turpis. In tempor lobortis arcu, ac lacinia diam facilisis lacinia. Praesent velit leo, vestibulum sed tortor vel, cursus vestibulum purus. Sed maximus tempor maximus. Mauris in hendrerit arcu. Proin sit amet sollicitudin enim. Morbi nec laoreet elit.</p>\r\n\r\n<p>Morbi fringilla, est vitae mollis egestas, justo ex tincidunt metus, eget fringilla dui tortor et arcu. Suspendisse vel vestibulum eros. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas vitae pharetra lorem. Quisque id mauris ultricies tellus tincidunt finibus eu et ante. Cras mollis dui nulla, id laoreet turpis sollicitudin et. Curabitur malesuada, eros vel egestas faucibus, urna ipsum hendrerit justo, vitae euismod enim elit in enim. Integer tristique hendrerit felis at gravida. In cursus tristique arcu, at laoreet lorem.</p>\r\n\r\n<p>Donec in imperdiet arcu, eget hendrerit lorem. Suspendisse venenatis venenatis justo quis vehicula. Vestibulum at finibus orci. Donec varius auctor eros, et ultrices felis. Suspendisse eu laoreet augue, at imperdiet tellus. Morbi commodo dignissim consequat. Suspendisse convallis vulputate metus, eget pretium lectus egestas quis.</p>\r\n', 'public/images/uploads/1574288929.jpg', '2019-11-20 22:28:48', 4, '2019-11-20 22:35:35', 4, 1, 1, 4, 0, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `berita_hashtag`
--

CREATE TABLE `berita_hashtag` (
  `berita_id` int(11) NOT NULL,
  `hashtag_name` varchar(16) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `berita_hashtag`
--

INSERT INTO `berita_hashtag` (`berita_id`, `hashtag_name`) VALUES
(4, 'hari pahlawan'),
(4, 'kostum'),
(4, 'pahlawan'),
(4, 'pejuang'),
(8, 'kelas'),
(8, 'ruang'),
(8, 'sekolah'),
(11, 'hari pahlawan'),
(11, 'kostum'),
(11, 'pahlawan'),
(12, 'buku kasus'),
(12, 'guru'),
(12, 'kasus'),
(12, 'siswa'),
(12, 'wali murid'),
(13, 'kasembon'),
(13, 'ketua osis'),
(13, 'mojokerto'),
(13, 'selingkuh'),
(13, 'siswa'),
(13, 'siswa smk'),
(15, 'buku kasus'),
(15, 'depan guru'),
(15, 'mantap mantap'),
(16, 'ujian'),
(16, 'ujian praktek'),
(17, 'australia'),
(17, 'koala');

-- --------------------------------------------------------

--
-- Table structure for table `departement`
--

CREATE TABLE `departement` (
  `departement_id` bigint(20) UNSIGNED NOT NULL,
  `departement_name` text NOT NULL,
  `departement_description` text DEFAULT NULL,
  `file_directory` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `isactive` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departement`
--

INSERT INTO `departement` (`departement_id`, `departement_name`, `departement_description`, `file_directory`, `created_at`, `created_by`, `updated_at`, `updated_by`, `isactive`) VALUES
(1, 'Bisnis dan Manajemen', '<p>efiwgbkwgb&nbsp;<strong>sdv ksdjvb</strong> jdsvbk sgs abf qjiqg qq ohq qo ie iq oq uqie&nbsp; qhfudq&nbsp;</p>\r\n', '', '2019-10-11 03:30:42', 4, '2019-11-08 04:22:37', 4, 1),
(2, 'Otomotif', '<p>Test 2</p>\r\n', 'public/images/uploads/background.jpg', '2021-02-25 07:15:10', 4, '2019-11-08 04:18:13', 4, 0),
(3, 'Pemesinan', '<p>ahdvc</p>\r\n', 'public/images/uploads/background.jpg', '2019-10-12 09:11:43', 4, '2019-11-08 04:17:50', 4, 1),
(4, 'Elektro', '<p>Departemen Elektro adalah Departemen yang mengelompokkan Jurusan yang berkaitan dengan Kelistrikan. Di dalam Departemen ini terdapat PJB Class, PLN Class, LG Class.</p>\r\n', 'public/images/uploads/1575873132.png', '2019-10-24 01:27:01', 4, '2019-12-09 06:32:12', 4, 1),
(10, 'Informatika', '<p>Informatika sistem informasi</p>\r\n', 'public/images/uploads/1579749964.jpg', '2020-01-23 03:26:03', 4, '2020-01-23 03:26:03', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hashtag`
--

CREATE TABLE `hashtag` (
  `hashtag` varchar(16) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hashtag`
--

INSERT INTO `hashtag` (`hashtag`) VALUES
('australia'),
('buku kasus'),
('depan guru'),
('guru'),
('hari pahlawan'),
('kasembon'),
('kasus'),
('kelas'),
('ketua osis'),
('koala'),
('kostum'),
('mojokerto'),
('pahlawan'),
('pejuang'),
('pojok'),
('ruang'),
('sekolah'),
('siswa'),
('siswa smk'),
('ujian'),
('ujian praktek'),
('wali murid');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `jurusan_id` bigint(20) UNSIGNED NOT NULL,
  `departement_id` int(11) NOT NULL,
  `jurusan_name` text NOT NULL,
  `jurusan_description` text DEFAULT NULL,
  `file_directory` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `isactive` tinyint(1) NOT NULL,
  `icon` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`jurusan_id`, `departement_id`, `jurusan_name`, `jurusan_description`, `file_directory`, `created_at`, `created_by`, `updated_at`, `updated_by`, `isactive`, `icon`) VALUES
(1, 5, 'Animasi', '', '', '2019-10-15 01:51:54', 4, '2019-11-08 04:20:03', 4, 1, NULL),
(2, 5, 'Multimedia', '', '', '2019-10-31 21:23:50', 4, '2019-11-08 04:19:41', 4, 1, NULL),
(3, 5, 'Rekayasa Perangkat Lunak', '', '', '2019-11-08 04:18:40', 4, '2019-11-08 04:18:40', 4, 1, NULL),
(4, 5, 'Teknik Komputer Jaringan', '', '', '2019-11-08 04:19:24', 4, '2019-11-08 04:19:24', 4, 1, NULL),
(5, 4, 'Instrumen Pembangkit', '', '', '2019-11-08 04:20:37', 4, '2019-11-08 04:20:37', 4, 1, NULL),
(6, 4, 'Kimia Pembangkit', '', '', '2019-11-08 04:20:55', 4, '2019-11-08 04:20:55', 4, 1, NULL),
(7, 3, 'Pemesinan', '', '', '2019-11-08 04:21:39', 4, '2019-11-08 04:21:39', 4, 1, NULL),
(8, 3, 'Pengelasan', '', '', '2019-11-08 04:21:52', 4, '2019-11-08 04:21:52', 4, 1, NULL),
(9, 1, 'Marketing', '', '', '2019-11-08 04:22:55', 4, '2019-12-06 08:17:34', 4, 1, NULL),
(10, 4, 'Mekanik Pembangkit', '', '', '2019-11-08 04:23:12', 4, '2019-11-08 04:23:12', 4, 1, NULL),
(11, 2, 'Bodi Otomotif', '', '', '2019-11-08 04:23:30', 4, '2019-12-09 06:27:49', 4, 1, NULL),
(12, 2, 'Teknik Kendaraan Ringan', '', '', '2019-11-08 04:23:45', 4, '2019-11-08 04:23:45', 4, 1, NULL),
(13, 2, 'Teknik Sepeda Motor', '', '', '2019-11-08 04:24:00', 4, '2019-11-08 04:24:13', 4, 1, NULL),
(14, 4, 'Elektronika Industri', '<p><strong>Jurusan Teknik Elektronika Industri (TEI)</strong>&nbsp;SMK PGRI 3 Malang merupakan jurusan elektro yang mempelajari sistem kontrol industri yang bergerak dibidang mikrokontroler dan PLC (programable logic controller).</p>\r\n\r\n<p>Lulusan dari jurusan TEI ini diharapkan mampu merencanakan dan membuat sistem kendali otomatis, memprogram sistem mikrokontroler dan robotik. Keahlian yang didapat :</p>\r\n\r\n<ul>\r\n	<li>Sistem Intrumentasi</li>\r\n	<li>Arduino Programming</li>\r\n	<li>Desain Robotik</li>\r\n	<li>Sistem PLC</li>\r\n	<li>Sistem Pneumatik</li>\r\n</ul>\r\n', 'public/images/uploads/1575624128.jpeg', '2019-11-08 04:25:24', 4, '2019-12-06 09:22:08', 4, 1, NULL),
(15, 4, 'Audio Video', '<ol>\r\n	<li><strong>Jurusan Teknik Audio Video (TAV)</strong>&nbsp;SMK PGRI 3 Malang merupakan jurusan elektro yang mempelajari :</li>\r\n	<li>Audio (suara) dan Video (gambar) yang diproses secara elektronik&nbsp;</li>\r\n	<li>Home Appliance (HA)</li>\r\n	<li>Handphone (HP)</li>\r\n</ol>\r\n\r\n<p>Lulusan dari Jurusan TAV ini diharapkan mampu menjadi tenaga professional dibidang Audio Video dan Home Appliance yang handal dan terampil, bidang tersebut antara lain:</p>\r\n\r\n<ul>\r\n	<li>Arduino Programing (pemerograman mikrokontroller)</li>\r\n	<li>Sistem Audio : Perencanaan sistem audio, pembuatan sistem audio, pengujian.</li>\r\n	<li>Sistem Video : Sistem radio, Sistem televisi analog dan digital, LCD TV, LED TV.</li>\r\n	<li>Sistem Home Appliance : Maintenance mesin pendingin/Refrigrator &nbsp;(Kulkas dan AC), Mesin cuci</li>\r\n	<li>Sistem Handphone : Sistem telekomunikasi HP, Maintenance HP</li>\r\n</ul>\r\n', 'public/images/uploads/1575622337.jpeg', '2019-11-08 04:25:43', 4, '2019-12-06 08:52:17', 4, 1, NULL),
(16, 4, 'Hotel Engineering', '', '', '2019-11-08 04:25:55', 4, '2019-11-08 04:25:55', 4, 1, NULL),
(19, 8, 'Keahlian', '', '', '2019-12-05 13:34:49', 4, '2019-12-05 13:34:49', 4, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `komentar_id` bigint(20) UNSIGNED NOT NULL,
  `berita_id` int(20) NOT NULL,
  `reply_to` int(20) DEFAULT NULL,
  `nama` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` text DEFAULT NULL,
  `website` text DEFAULT NULL,
  `komentar_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `komentar_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `isapprove` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`komentar_id`, `berita_id`, `reply_to`, `nama`, `email`, `website`, `komentar_text`, `komentar_date`, `isapprove`) VALUES
(1, 4, NULL, 'Ahmad Husein Hambali', 'ahmadhuseinh.03@gmail.com', 'https://example.com', 'T_T', '2020-01-18 11:53:02', 0),
(2, 4, NULL, 'Supri', 'test@gmail.com', 'https://example.com', 'asjfbakfha siuqd advasj ', '2020-01-18 11:55:01', 0),
(3, 4, NULL, 'Rohman', 'rohman.ea@gmail.com', 'https://example.com', 'afjajuvww;kbswhi wug wg wg9w iwuufiwi9 iwg wif9i q ', '2020-01-18 11:56:19', 0),
(5, 4, 1, 'Fico', 'fico@gmail.com', 'https://example.com', 'Sabar bro', '2020-01-19 09:26:50', 0),
(10, 4, 5, 'Ahmad Husein Hambali', 'ahmadhuseinh.03@gmail.com', 'https://example.com', 'Oke bro', '2020-01-21 05:34:00', 0),
(9, 4, 8, 'Ahmad Husein Hambali', 'ahmadhuseinh.03@gmail.com', 'https://example.com', 'Iya ', '2020-01-21 05:32:26', 0),
(8, 4, 1, 'Anonymous', 'someone@gmail.com', 'https://www.google.com', 'hmm', '2020-01-21 01:50:47', 0),
(11, 4, 3, 'Ahmad Husein Hambali', 'ahmadhuseinh.03@gmail.com', 'https://example.com', 'Apa si ga jelas', '2020-01-21 15:12:31', 0);

-- --------------------------------------------------------

--
-- Table structure for table `partner`
--

CREATE TABLE `partner` (
  `partner_id` bigint(20) UNSIGNED NOT NULL,
  `partner_name` varchar(100) NOT NULL,
  `partner_address` text DEFAULT NULL,
  `partner_phone` varchar(20) DEFAULT NULL,
  `partner_email` varchar(64) DEFAULT NULL,
  `file_directory` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` int(11) NOT NULL,
  `isactive` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `partner`
--

INSERT INTO `partner` (`partner_id`, `partner_name`, `partner_address`, `partner_phone`, `partner_email`, `file_directory`, `created_at`, `created_by`, `updated_at`, `updated_by`, `isactive`) VALUES
(1, 'Role Play Studio', 'Malang', '089295472732', 'owner@roleplaystudio.co.id', 'public/images/uploads/14570603_697855117035071_5928827545638009645_o.png', '2019-11-09 03:45:19', 1, '2019-11-09 05:38:20', 4, 1),
(7, 'Alfamart', '', '', '', 'public/images/uploads/alfamart-logo-fix.png', '2019-11-09 05:51:48', 4, '2019-11-09 05:51:48', 4, 1),
(5, 'Mikrotik', '', '', '', 'public/images/uploads/1280px-MikroTik_logo.svg.png', '2019-11-09 05:45:40', 4, '2019-11-09 05:45:40', 4, 1),
(6, 'Pembangkit Jawa Bali', '', '', '', 'public/images/uploads/PJB_LOGO_transp.gif', '2019-11-09 05:48:02', 4, '2019-11-09 05:48:02', 4, 1),
(8, 'Suzuki', '', '', '', 'public/images/uploads/64e773194975e702677c5089fc6c8ae2.png', '2019-11-09 05:55:26', 4, '2019-11-09 05:55:26', 4, 1),
(9, 'Toyota', '', '', '', 'public/images/uploads/images.png', '2019-11-09 06:01:34', 4, '2019-11-09 06:01:34', 4, 1),
(10, 'Swiss Belinn', '', '', '', 'public/images/uploads/images.jpg', '2019-11-09 06:15:51', 4, '2019-11-09 06:15:51', 4, 1),
(11, 'LG', '', '', '', 'public/images/uploads/LG_Electronics-logo-72D5E801F6-seeklogo.com.png', '2019-11-09 06:16:08', 4, '2019-11-09 06:16:08', 4, 1),
(13, 'PT Surabaya Autocomp Indonesia', 'Ngoro Industri Persada blok T ', '087678902786', 'someone23@gmail.com', 'public/images/uploads/1574400311.png', '2019-11-22 05:25:11', 4, '2019-11-22 05:26:12', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sosmed`
--

CREATE TABLE `sosmed` (
  `sosmed_id` bigint(20) UNSIGNED NOT NULL,
  `sosmed_platform` varchar(32) NOT NULL,
  `sosmed_akunid` varchar(32) NOT NULL,
  `sosmed_akuntautan` text DEFAULT NULL,
  `file_directory` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `isactive` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sosmed`
--

INSERT INTO `sosmed` (`sosmed_id`, `sosmed_platform`, `sosmed_akunid`, `sosmed_akuntautan`, `file_directory`, `created_at`, `created_by`, `updated_at`, `updated_by`, `isactive`) VALUES
(1, 'Facebook', 'SMK PGRI 3 Malang', 'https://facebook.com/smkpgri3malang', NULL, '2019-11-08 17:14:39', 1, '2020-01-23 03:36:30', 4, 0),
(2, 'Instagram', '@skariga_official', 'https://www.instagram.com/skariga_official/', NULL, '2019-11-08 17:15:44', 1, '2019-11-09 16:27:38', 4, 1),
(3, 'Twitter', '', NULL, NULL, '2019-11-08 17:16:31', 1, '2019-11-08 17:16:53', 1, 1),
(4, 'Google', 'skariga', '', NULL, '2019-11-08 17:17:30', 1, '2019-11-09 02:37:48', 4, 1),
(5, 'Pinterest', '', NULL, NULL, '2019-11-08 17:19:37', 1, '2019-11-08 17:19:41', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(32) NOT NULL,
  `pswd` varchar(50) NOT NULL,
  `fullname` varchar(64) DEFAULT NULL,
  `role` varchar(16) NOT NULL DEFAULT 'ADMIN',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `isactive` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `pswd`, `fullname`, `role`, `created_at`, `updated_at`, `isactive`) VALUES
(4, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Developer', 'ADMIN', '2019-09-19 14:09:35', '2019-09-19 14:09:35', 1),
(3, 'admin_depa', '21232f297a57a5a743894a0e4a801fc3', 'Skariga Departements', 'DEPARTEMEN', '2021-02-25 06:29:49', '2019-09-19 02:13:59', 1),
(6, 'kabid', '21232f297a57a5a743894a0e4a801fc3', 'Kepala Bidang', 'KABID', '2021-02-25 06:29:56', '2019-09-20 06:30:21', 1),
(9, 'adi_kodim', '21232f297a57a5a743894a0e4a801fc3', 'Adhy', 'KESISWAAN', '2019-09-26 05:23:09', '2019-09-26 05:23:09', 1),
(12, 'bki', '21232f297a57a5a743894a0e4a801fc3', 'BKI SMK PGRI 3', 'BKI', '2019-11-06 16:47:50', '2019-11-06 16:47:50', 1),
(13, 'market', '21232f297a57a5a743894a0e4a801fc3', 'Bakul SKARIGA', 'MARKETING', '2021-02-25 06:29:12', '2019-11-06 16:49:12', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`agenda_id`),
  ADD UNIQUE KEY `agenda_id` (`agenda_id`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD UNIQUE KEY `berita_id` (`berita_id`);

--
-- Indexes for table `berita_hashtag`
--
ALTER TABLE `berita_hashtag`
  ADD PRIMARY KEY (`berita_id`,`hashtag_name`);

--
-- Indexes for table `departement`
--
ALTER TABLE `departement`
  ADD PRIMARY KEY (`departement_id`),
  ADD UNIQUE KEY `departement_id` (`departement_id`);

--
-- Indexes for table `hashtag`
--
ALTER TABLE `hashtag`
  ADD PRIMARY KEY (`hashtag`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`jurusan_id`),
  ADD UNIQUE KEY `jurusan_id` (`jurusan_id`);

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`komentar_id`),
  ADD UNIQUE KEY `komentar_id` (`komentar_id`);

--
-- Indexes for table `partner`
--
ALTER TABLE `partner`
  ADD PRIMARY KEY (`partner_id`),
  ADD UNIQUE KEY `partner_id` (`partner_id`);

--
-- Indexes for table `sosmed`
--
ALTER TABLE `sosmed`
  ADD PRIMARY KEY (`sosmed_id`),
  ADD UNIQUE KEY `sosmed_id` (`sosmed_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agenda`
--
ALTER TABLE `agenda`
  MODIFY `agenda_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `berita_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `departement`
--
ALTER TABLE `departement`
  MODIFY `departement_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `jurusan_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `komentar_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `partner`
--
ALTER TABLE `partner`
  MODIFY `partner_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `sosmed`
--
ALTER TABLE `sosmed`
  MODIFY `sosmed_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `decrease_berita_week_1606042325` ON SCHEDULE AT '2020-11-29 17:52:05' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE berita SET view_count_week = view_count_week - 1
      			WHERE berita_id = 12;$$

CREATE DEFINER=`root`@`localhost` EVENT `decrease_berita_month_1606042325` ON SCHEDULE AT '2020-12-22 17:52:05' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE berita SET view_count_month = view_count_month - 1
      			WHERE berita_id = 12;$$

CREATE DEFINER=`root`@`localhost` EVENT `decrease_berita_year_1606042325` ON SCHEDULE AT '2021-11-22 17:52:05' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE berita SET view_count_year = view_count_year - 1
      			WHERE berita_id = 12$$

CREATE DEFINER=`root`@`localhost` EVENT `decrease_berita_week_1614225420` ON SCHEDULE AT '2021-03-04 10:57:00' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE berita SET view_count_week = view_count_week - 1
      			WHERE berita_id = 12;$$

CREATE DEFINER=`root`@`localhost` EVENT `decrease_berita_month_1614225420` ON SCHEDULE AT '2021-03-25 10:57:00' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE berita SET view_count_month = view_count_month - 1
      			WHERE berita_id = 12;$$

CREATE DEFINER=`root`@`localhost` EVENT `decrease_berita_year_1614225420` ON SCHEDULE AT '2022-02-25 10:57:01' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE berita SET view_count_year = view_count_year - 1
      			WHERE berita_id = 12$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
