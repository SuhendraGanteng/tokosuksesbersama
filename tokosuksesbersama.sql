-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.39 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for tokosuksesbersama
CREATE DATABASE IF NOT EXISTS `tokosuksesbersama` /*!40100 DEFAULT CHARACTER SET armscii8 COLLATE armscii8_bin */;
USE `tokosuksesbersama`;

-- Dumping structure for table tokosuksesbersama.detail_pesanan
CREATE TABLE IF NOT EXISTS `detail_pesanan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pesanan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(255) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_pesanan` (`id_pesanan`),
  KEY `id_user` (`id_user`),
  KEY `id_produk` (`id_produk`),
  CONSTRAINT `detail_pesanan_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detail_pesanan_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table tokosuksesbersama.detail_pesanan: ~8 rows (approximately)
INSERT IGNORE INTO `detail_pesanan` (`id`, `id_pesanan`, `id_user`, `id_produk`, `nama_produk`, `harga`, `qty`, `tanggal`) VALUES
	(27, 50, 7, 11, 'Kursi Bakso Gold', 46000, 2, '2023-11-13 18:20:51'),
	(28, 51, 7, 12, 'Kursi Rotan', 110000, 12, '2023-11-15 13:22:29'),
	(29, 51, 7, 14, 'Gayung Jumbo Warna', 156000, 24, '2023-11-15 13:22:29'),
	(30, 52, 7, 13, 'Toples 2kg', 8000, 1, '2023-11-15 13:30:48'),
	(31, 53, 7, 17, 'Keranjang Luxi', 12000, 1, '2023-11-15 13:31:24'),
	(32, 54, 7, 18, 'Gelas ftc-5', 8000, 2, '2023-11-15 13:32:04'),
	(33, 55, 7, 11, 'Kursi Bakso Gold', 23000, 1, '2023-11-16 19:28:53'),
	(34, 55, 7, 14, 'Gayung Jumbo Warna', 78000, 12, '2023-11-16 19:28:53');

-- Dumping structure for table tokosuksesbersama.kategori
CREATE TABLE IF NOT EXISTS `kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table tokosuksesbersama.kategori: ~5 rows (approximately)
INSERT IGNORE INTO `kategori` (`id`, `nama`, `slug`, `gambar`) VALUES
	(3, 'Peralatan Mandi', 'peralatan-mandi', '52-Gayung.jpg'),
	(4, 'Kursi', 'kursi', '663-Kursi Rotan.jpg'),
	(5, 'Toples', 'toples', '287-Toples.jpg'),
	(6, 'Keranjang', 'keranjang', '98-Keranjang.jpg'),
	(7, 'Gelas kaca', 'gelas-kaca', '918-gelas ftc.jpg');

-- Dumping structure for table tokosuksesbersama.keranjang
CREATE TABLE IF NOT EXISTS `keranjang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `berat` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_produk` (`id_produk`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `keranjang_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `keranjang_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table tokosuksesbersama.keranjang: ~0 rows (approximately)

-- Dumping structure for table tokosuksesbersama.kota
CREATE TABLE IF NOT EXISTS `kota` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `provinsi_id` int(11) NOT NULL,
  `kota_id` int(11) NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=502 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tokosuksesbersama.kota: ~501 rows (approximately)
INSERT IGNORE INTO `kota` (`id`, `provinsi_id`, `kota_id`, `nama`) VALUES
	(1, 21, 1, 'Aceh Barat - (Kabupaten)'),
	(2, 21, 2, 'Aceh Barat Daya - (Kabupaten)'),
	(3, 21, 3, 'Aceh Besar - (Kabupaten)'),
	(4, 21, 4, 'Aceh Jaya - (Kabupaten)'),
	(5, 21, 5, 'Aceh Selatan - (Kabupaten)'),
	(6, 21, 6, 'Aceh Singkil - (Kabupaten)'),
	(7, 21, 7, 'Aceh Tamiang - (Kabupaten)'),
	(8, 21, 8, 'Aceh Tengah - (Kabupaten)'),
	(9, 21, 9, 'Aceh Tenggara - (Kabupaten)'),
	(10, 21, 10, 'Aceh Timur - (Kabupaten)'),
	(11, 21, 11, 'Aceh Utara - (Kabupaten)'),
	(12, 32, 12, 'Agam - (Kabupaten)'),
	(13, 23, 13, 'Alor - (Kabupaten)'),
	(14, 19, 14, 'Ambon - (Kota)'),
	(15, 34, 15, 'Asahan - (Kabupaten)'),
	(16, 24, 16, 'Asmat - (Kabupaten)'),
	(17, 1, 17, 'Badung - (Kabupaten)'),
	(18, 13, 18, 'Balangan - (Kabupaten)'),
	(19, 15, 19, 'Balikpapan - (Kota)'),
	(20, 21, 20, 'Banda Aceh - (Kota)'),
	(21, 18, 21, 'Bandar Lampung - (Kota)'),
	(22, 9, 22, 'Bandung - (Kabupaten)'),
	(23, 9, 23, 'Bandung - (Kota)'),
	(24, 9, 24, 'Bandung Barat - (Kabupaten)'),
	(25, 29, 25, 'Banggai - (Kabupaten)'),
	(26, 29, 26, 'Banggai Kepulauan - (Kabupaten)'),
	(27, 2, 27, 'Bangka - (Kabupaten)'),
	(28, 2, 28, 'Bangka Barat - (Kabupaten)'),
	(29, 2, 29, 'Bangka Selatan - (Kabupaten)'),
	(30, 2, 30, 'Bangka Tengah - (Kabupaten)'),
	(31, 11, 31, 'Bangkalan - (Kabupaten)'),
	(32, 1, 32, 'Bangli - (Kabupaten)'),
	(33, 13, 33, 'Banjar - (Kabupaten)'),
	(34, 9, 34, 'Banjar - (Kota)'),
	(35, 13, 35, 'Banjarbaru - (Kota)'),
	(36, 13, 36, 'Banjarmasin - (Kota)'),
	(37, 10, 37, 'Banjarnegara - (Kabupaten)'),
	(38, 28, 38, 'Bantaeng - (Kabupaten)'),
	(39, 5, 39, 'Bantul - (Kabupaten)'),
	(40, 33, 40, 'Banyuasin - (Kabupaten)'),
	(41, 10, 41, 'Banyumas - (Kabupaten)'),
	(42, 11, 42, 'Banyuwangi - (Kabupaten)'),
	(43, 13, 43, 'Barito Kuala - (Kabupaten)'),
	(44, 14, 44, 'Barito Selatan - (Kabupaten)'),
	(45, 14, 45, 'Barito Timur - (Kabupaten)'),
	(46, 14, 46, 'Barito Utara - (Kabupaten)'),
	(47, 28, 47, 'Barru - (Kabupaten)'),
	(48, 17, 48, 'Batam - (Kota)'),
	(49, 10, 49, 'Batang - (Kabupaten)'),
	(50, 8, 50, 'Batang Hari - (Kabupaten)'),
	(51, 11, 51, 'Batu - (Kota)'),
	(52, 34, 52, 'Batu Bara - (Kabupaten)'),
	(53, 30, 53, 'Bau-Bau - (Kota)'),
	(54, 9, 54, 'Bekasi - (Kabupaten)'),
	(55, 9, 55, 'Bekasi - (Kota)'),
	(56, 2, 56, 'Belitung - (Kabupaten)'),
	(57, 2, 57, 'Belitung Timur - (Kabupaten)'),
	(58, 23, 58, 'Belu - (Kabupaten)'),
	(59, 21, 59, 'Bener Meriah - (Kabupaten)'),
	(60, 26, 60, 'Bengkalis - (Kabupaten)'),
	(61, 12, 61, 'Bengkayang - (Kabupaten)'),
	(62, 4, 62, 'Bengkulu - (Kota)'),
	(63, 4, 63, 'Bengkulu Selatan - (Kabupaten)'),
	(64, 4, 64, 'Bengkulu Tengah - (Kabupaten)'),
	(65, 4, 65, 'Bengkulu Utara - (Kabupaten)'),
	(66, 15, 66, 'Berau - (Kabupaten)'),
	(67, 24, 67, 'Biak Numfor - (Kabupaten)'),
	(68, 22, 68, 'Bima - (Kabupaten)'),
	(69, 22, 69, 'Bima - (Kota)'),
	(70, 34, 70, 'Binjai - (Kota)'),
	(71, 17, 71, 'Bintan - (Kabupaten)'),
	(72, 21, 72, 'Bireuen - (Kabupaten)'),
	(73, 31, 73, 'Bitung - (Kota)'),
	(74, 11, 74, 'Blitar - (Kabupaten)'),
	(75, 11, 75, 'Blitar - (Kota)'),
	(76, 10, 76, 'Blora - (Kabupaten)'),
	(77, 7, 77, 'Boalemo - (Kabupaten)'),
	(78, 9, 78, 'Bogor - (Kabupaten)'),
	(79, 9, 79, 'Bogor - (Kota)'),
	(80, 11, 80, 'Bojonegoro - (Kabupaten)'),
	(81, 31, 81, 'Bolaang Mongondow (Bolmong) - (Kabupaten)'),
	(82, 31, 82, 'Bolaang Mongondow Selatan - (Kabupaten)'),
	(83, 31, 83, 'Bolaang Mongondow Timur - (Kabupaten)'),
	(84, 31, 84, 'Bolaang Mongondow Utara - (Kabupaten)'),
	(85, 30, 85, 'Bombana - (Kabupaten)'),
	(86, 11, 86, 'Bondowoso - (Kabupaten)'),
	(87, 28, 87, 'Bone - (Kabupaten)'),
	(88, 7, 88, 'Bone Bolango - (Kabupaten)'),
	(89, 15, 89, 'Bontang - (Kota)'),
	(90, 24, 90, 'Boven Digoel - (Kabupaten)'),
	(91, 10, 91, 'Boyolali - (Kabupaten)'),
	(92, 10, 92, 'Brebes - (Kabupaten)'),
	(93, 32, 93, 'Bukittinggi - (Kota)'),
	(94, 1, 94, 'Buleleng - (Kabupaten)'),
	(95, 28, 95, 'Bulukumba - (Kabupaten)'),
	(96, 16, 96, 'Bulungan (Bulongan) - (Kabupaten)'),
	(97, 8, 97, 'Bungo - (Kabupaten)'),
	(98, 29, 98, 'Buol - (Kabupaten)'),
	(99, 19, 99, 'Buru - (Kabupaten)'),
	(100, 19, 100, 'Buru Selatan - (Kabupaten)'),
	(101, 30, 101, 'Buton - (Kabupaten)'),
	(102, 30, 102, 'Buton Utara - (Kabupaten)'),
	(103, 9, 103, 'Ciamis - (Kabupaten)'),
	(104, 9, 104, 'Cianjur - (Kabupaten)'),
	(105, 10, 105, 'Cilacap - (Kabupaten)'),
	(106, 3, 106, 'Cilegon - (Kota)'),
	(107, 9, 107, 'Cimahi - (Kota)'),
	(108, 9, 108, 'Cirebon - (Kabupaten)'),
	(109, 9, 109, 'Cirebon - (Kota)'),
	(110, 34, 110, 'Dairi - (Kabupaten)'),
	(111, 24, 111, 'Deiyai (Deliyai) - (Kabupaten)'),
	(112, 34, 112, 'Deli Serdang - (Kabupaten)'),
	(113, 10, 113, 'Demak - (Kabupaten)'),
	(114, 1, 114, 'Denpasar - (Kota)'),
	(115, 9, 115, 'Depok - (Kota)'),
	(116, 32, 116, 'Dharmasraya - (Kabupaten)'),
	(117, 24, 117, 'Dogiyai - (Kabupaten)'),
	(118, 22, 118, 'Dompu - (Kabupaten)'),
	(119, 29, 119, 'Donggala - (Kabupaten)'),
	(120, 26, 120, 'Dumai - (Kota)'),
	(121, 33, 121, 'Empat Lawang - (Kabupaten)'),
	(122, 23, 122, 'Ende - (Kabupaten)'),
	(123, 28, 123, 'Enrekang - (Kabupaten)'),
	(124, 25, 124, 'Fakfak - (Kabupaten)'),
	(125, 23, 125, 'Flores Timur - (Kabupaten)'),
	(126, 9, 126, 'Garut - (Kabupaten)'),
	(127, 21, 127, 'Gayo Lues - (Kabupaten)'),
	(128, 1, 128, 'Gianyar - (Kabupaten)'),
	(129, 7, 129, 'Gorontalo - (Kabupaten)'),
	(130, 7, 130, 'Gorontalo - (Kota)'),
	(131, 7, 131, 'Gorontalo Utara - (Kabupaten)'),
	(132, 28, 132, 'Gowa - (Kabupaten)'),
	(133, 11, 133, 'Gresik - (Kabupaten)'),
	(134, 10, 134, 'Grobogan - (Kabupaten)'),
	(135, 5, 135, 'Gunung Kidul - (Kabupaten)'),
	(136, 14, 136, 'Gunung Mas - (Kabupaten)'),
	(137, 34, 137, 'Gunungsitoli - (Kota)'),
	(138, 20, 138, 'Halmahera Barat - (Kabupaten)'),
	(139, 20, 139, 'Halmahera Selatan - (Kabupaten)'),
	(140, 20, 140, 'Halmahera Tengah - (Kabupaten)'),
	(141, 20, 141, 'Halmahera Timur - (Kabupaten)'),
	(142, 20, 142, 'Halmahera Utara - (Kabupaten)'),
	(143, 13, 143, 'Hulu Sungai Selatan - (Kabupaten)'),
	(144, 13, 144, 'Hulu Sungai Tengah - (Kabupaten)'),
	(145, 13, 145, 'Hulu Sungai Utara - (Kabupaten)'),
	(146, 34, 146, 'Humbang Hasundutan - (Kabupaten)'),
	(147, 26, 147, 'Indragiri Hilir - (Kabupaten)'),
	(148, 26, 148, 'Indragiri Hulu - (Kabupaten)'),
	(149, 9, 149, 'Indramayu - (Kabupaten)'),
	(150, 24, 150, 'Intan Jaya - (Kabupaten)'),
	(151, 6, 151, 'Jakarta Barat - (Kota)'),
	(152, 6, 152, 'Jakarta Pusat - (Kota)'),
	(153, 6, 153, 'Jakarta Selatan - (Kota)'),
	(154, 6, 154, 'Jakarta Timur - (Kota)'),
	(155, 6, 155, 'Jakarta Utara - (Kota)'),
	(156, 8, 156, 'Jambi - (Kota)'),
	(157, 24, 157, 'Jayapura - (Kabupaten)'),
	(158, 24, 158, 'Jayapura - (Kota)'),
	(159, 24, 159, 'Jayawijaya - (Kabupaten)'),
	(160, 11, 160, 'Jember - (Kabupaten)'),
	(161, 1, 161, 'Jembrana - (Kabupaten)'),
	(162, 28, 162, 'Jeneponto - (Kabupaten)'),
	(163, 10, 163, 'Jepara - (Kabupaten)'),
	(164, 11, 164, 'Jombang - (Kabupaten)'),
	(165, 25, 165, 'Kaimana - (Kabupaten)'),
	(166, 26, 166, 'Kampar - (Kabupaten)'),
	(167, 14, 167, 'Kapuas - (Kabupaten)'),
	(168, 12, 168, 'Kapuas Hulu - (Kabupaten)'),
	(169, 10, 169, 'Karanganyar - (Kabupaten)'),
	(170, 1, 170, 'Karangasem - (Kabupaten)'),
	(171, 9, 171, 'Karawang - (Kabupaten)'),
	(172, 17, 172, 'Karimun - (Kabupaten)'),
	(173, 34, 173, 'Karo - (Kabupaten)'),
	(174, 14, 174, 'Katingan - (Kabupaten)'),
	(175, 4, 175, 'Kaur - (Kabupaten)'),
	(176, 12, 176, 'Kayong Utara - (Kabupaten)'),
	(177, 10, 177, 'Kebumen - (Kabupaten)'),
	(178, 11, 178, 'Kediri - (Kabupaten)'),
	(179, 11, 179, 'Kediri - (Kota)'),
	(180, 24, 180, 'Keerom - (Kabupaten)'),
	(181, 10, 181, 'Kendal - (Kabupaten)'),
	(182, 30, 182, 'Kendari - (Kota)'),
	(183, 4, 183, 'Kepahiang - (Kabupaten)'),
	(184, 17, 184, 'Kepulauan Anambas - (Kabupaten)'),
	(185, 19, 185, 'Kepulauan Aru - (Kabupaten)'),
	(186, 32, 186, 'Kepulauan Mentawai - (Kabupaten)'),
	(187, 26, 187, 'Kepulauan Meranti - (Kabupaten)'),
	(188, 31, 188, 'Kepulauan Sangihe - (Kabupaten)'),
	(189, 6, 189, 'Kepulauan Seribu - (Kabupaten)'),
	(190, 31, 190, 'Kepulauan Siau Tagulandang Biaro (Sitaro) - (Kabupaten)'),
	(191, 20, 191, 'Kepulauan Sula - (Kabupaten)'),
	(192, 31, 192, 'Kepulauan Talaud - (Kabupaten)'),
	(193, 24, 193, 'Kepulauan Yapen (Yapen Waropen) - (Kabupaten)'),
	(194, 8, 194, 'Kerinci - (Kabupaten)'),
	(195, 12, 195, 'Ketapang - (Kabupaten)'),
	(196, 10, 196, 'Klaten - (Kabupaten)'),
	(197, 1, 197, 'Klungkung - (Kabupaten)'),
	(198, 30, 198, 'Kolaka - (Kabupaten)'),
	(199, 30, 199, 'Kolaka Utara - (Kabupaten)'),
	(200, 30, 200, 'Konawe - (Kabupaten)'),
	(201, 30, 201, 'Konawe Selatan - (Kabupaten)'),
	(202, 30, 202, 'Konawe Utara - (Kabupaten)'),
	(203, 13, 203, 'Kotabaru - (Kabupaten)'),
	(204, 31, 204, 'Kotamobagu - (Kota)'),
	(205, 14, 205, 'Kotawaringin Barat - (Kabupaten)'),
	(206, 14, 206, 'Kotawaringin Timur - (Kabupaten)'),
	(207, 26, 207, 'Kuantan Singingi - (Kabupaten)'),
	(208, 12, 208, 'Kubu Raya - (Kabupaten)'),
	(209, 10, 209, 'Kudus - (Kabupaten)'),
	(210, 5, 210, 'Kulon Progo - (Kabupaten)'),
	(211, 9, 211, 'Kuningan - (Kabupaten)'),
	(212, 23, 212, 'Kupang - (Kabupaten)'),
	(213, 23, 213, 'Kupang - (Kota)'),
	(214, 15, 214, 'Kutai Barat - (Kabupaten)'),
	(215, 15, 215, 'Kutai Kartanegara - (Kabupaten)'),
	(216, 15, 216, 'Kutai Timur - (Kabupaten)'),
	(217, 34, 217, 'Labuhan Batu - (Kabupaten)'),
	(218, 34, 218, 'Labuhan Batu Selatan - (Kabupaten)'),
	(219, 34, 219, 'Labuhan Batu Utara - (Kabupaten)'),
	(220, 33, 220, 'Lahat - (Kabupaten)'),
	(221, 14, 221, 'Lamandau - (Kabupaten)'),
	(222, 11, 222, 'Lamongan - (Kabupaten)'),
	(223, 18, 223, 'Lampung Barat - (Kabupaten)'),
	(224, 18, 224, 'Lampung Selatan - (Kabupaten)'),
	(225, 18, 225, 'Lampung Tengah - (Kabupaten)'),
	(226, 18, 226, 'Lampung Timur - (Kabupaten)'),
	(227, 18, 227, 'Lampung Utara - (Kabupaten)'),
	(228, 12, 228, 'Landak - (Kabupaten)'),
	(229, 34, 229, 'Langkat - (Kabupaten)'),
	(230, 21, 230, 'Langsa - (Kota)'),
	(231, 24, 231, 'Lanny Jaya - (Kabupaten)'),
	(232, 3, 232, 'Lebak - (Kabupaten)'),
	(233, 4, 233, 'Lebong - (Kabupaten)'),
	(234, 23, 234, 'Lembata - (Kabupaten)'),
	(235, 21, 235, 'Lhokseumawe - (Kota)'),
	(236, 32, 236, 'Lima Puluh Koto/Kota - (Kabupaten)'),
	(237, 17, 237, 'Lingga - (Kabupaten)'),
	(238, 22, 238, 'Lombok Barat - (Kabupaten)'),
	(239, 22, 239, 'Lombok Tengah - (Kabupaten)'),
	(240, 22, 240, 'Lombok Timur - (Kabupaten)'),
	(241, 22, 241, 'Lombok Utara - (Kabupaten)'),
	(242, 33, 242, 'Lubuk Linggau - (Kota)'),
	(243, 11, 243, 'Lumajang - (Kabupaten)'),
	(244, 28, 244, 'Luwu - (Kabupaten)'),
	(245, 28, 245, 'Luwu Timur - (Kabupaten)'),
	(246, 28, 246, 'Luwu Utara - (Kabupaten)'),
	(247, 11, 247, 'Madiun - (Kabupaten)'),
	(248, 11, 248, 'Madiun - (Kota)'),
	(249, 10, 249, 'Magelang - (Kabupaten)'),
	(250, 10, 250, 'Magelang - (Kota)'),
	(251, 11, 251, 'Magetan - (Kabupaten)'),
	(252, 9, 252, 'Majalengka - (Kabupaten)'),
	(253, 27, 253, 'Majene - (Kabupaten)'),
	(254, 28, 254, 'Makassar - (Kota)'),
	(255, 11, 255, 'Malang - (Kabupaten)'),
	(256, 11, 256, 'Malang - (Kota)'),
	(257, 16, 257, 'Malinau - (Kabupaten)'),
	(258, 19, 258, 'Maluku Barat Daya - (Kabupaten)'),
	(259, 19, 259, 'Maluku Tengah - (Kabupaten)'),
	(260, 19, 260, 'Maluku Tenggara - (Kabupaten)'),
	(261, 19, 261, 'Maluku Tenggara Barat - (Kabupaten)'),
	(262, 27, 262, 'Mamasa - (Kabupaten)'),
	(263, 24, 263, 'Mamberamo Raya - (Kabupaten)'),
	(264, 24, 264, 'Mamberamo Tengah - (Kabupaten)'),
	(265, 27, 265, 'Mamuju - (Kabupaten)'),
	(266, 27, 266, 'Mamuju Utara - (Kabupaten)'),
	(267, 31, 267, 'Manado - (Kota)'),
	(268, 34, 268, 'Mandailing Natal - (Kabupaten)'),
	(269, 23, 269, 'Manggarai - (Kabupaten)'),
	(270, 23, 270, 'Manggarai Barat - (Kabupaten)'),
	(271, 23, 271, 'Manggarai Timur - (Kabupaten)'),
	(272, 25, 272, 'Manokwari - (Kabupaten)'),
	(273, 25, 273, 'Manokwari Selatan - (Kabupaten)'),
	(274, 24, 274, 'Mappi - (Kabupaten)'),
	(275, 28, 275, 'Maros - (Kabupaten)'),
	(276, 22, 276, 'Mataram - (Kota)'),
	(277, 25, 277, 'Maybrat - (Kabupaten)'),
	(278, 34, 278, 'Medan - (Kota)'),
	(279, 12, 279, 'Melawi - (Kabupaten)'),
	(280, 8, 280, 'Merangin - (Kabupaten)'),
	(281, 24, 281, 'Merauke - (Kabupaten)'),
	(282, 18, 282, 'Mesuji - (Kabupaten)'),
	(283, 18, 283, 'Metro - (Kota)'),
	(284, 24, 284, 'Mimika - (Kabupaten)'),
	(285, 31, 285, 'Minahasa - (Kabupaten)'),
	(286, 31, 286, 'Minahasa Selatan - (Kabupaten)'),
	(287, 31, 287, 'Minahasa Tenggara - (Kabupaten)'),
	(288, 31, 288, 'Minahasa Utara - (Kabupaten)'),
	(289, 11, 289, 'Mojokerto - (Kabupaten)'),
	(290, 11, 290, 'Mojokerto - (Kota)'),
	(291, 29, 291, 'Morowali - (Kabupaten)'),
	(292, 33, 292, 'Muara Enim - (Kabupaten)'),
	(293, 8, 293, 'Muaro Jambi - (Kabupaten)'),
	(294, 4, 294, 'Muko Muko - (Kabupaten)'),
	(295, 30, 295, 'Muna - (Kabupaten)'),
	(296, 14, 296, 'Murung Raya - (Kabupaten)'),
	(297, 33, 297, 'Musi Banyuasin - (Kabupaten)'),
	(298, 33, 298, 'Musi Rawas - (Kabupaten)'),
	(299, 24, 299, 'Nabire - (Kabupaten)'),
	(300, 21, 300, 'Nagan Raya - (Kabupaten)'),
	(301, 23, 301, 'Nagekeo - (Kabupaten)'),
	(302, 17, 302, 'Natuna - (Kabupaten)'),
	(303, 24, 303, 'Nduga - (Kabupaten)'),
	(304, 23, 304, 'Ngada - (Kabupaten)'),
	(305, 11, 305, 'Nganjuk - (Kabupaten)'),
	(306, 11, 306, 'Ngawi - (Kabupaten)'),
	(307, 34, 307, 'Nias - (Kabupaten)'),
	(308, 34, 308, 'Nias Barat - (Kabupaten)'),
	(309, 34, 309, 'Nias Selatan - (Kabupaten)'),
	(310, 34, 310, 'Nias Utara - (Kabupaten)'),
	(311, 16, 311, 'Nunukan - (Kabupaten)'),
	(312, 33, 312, 'Ogan Ilir - (Kabupaten)'),
	(313, 33, 313, 'Ogan Komering Ilir - (Kabupaten)'),
	(314, 33, 314, 'Ogan Komering Ulu - (Kabupaten)'),
	(315, 33, 315, 'Ogan Komering Ulu Selatan - (Kabupaten)'),
	(316, 33, 316, 'Ogan Komering Ulu Timur - (Kabupaten)'),
	(317, 11, 317, 'Pacitan - (Kabupaten)'),
	(318, 32, 318, 'Padang - (Kota)'),
	(319, 34, 319, 'Padang Lawas - (Kabupaten)'),
	(320, 34, 320, 'Padang Lawas Utara - (Kabupaten)'),
	(321, 32, 321, 'Padang Panjang - (Kota)'),
	(322, 32, 322, 'Padang Pariaman - (Kabupaten)'),
	(323, 34, 323, 'Padang Sidempuan - (Kota)'),
	(324, 33, 324, 'Pagar Alam - (Kota)'),
	(325, 34, 325, 'Pakpak Bharat - (Kabupaten)'),
	(326, 14, 326, 'Palangka Raya - (Kota)'),
	(327, 33, 327, 'Palembang - (Kota)'),
	(328, 28, 328, 'Palopo - (Kota)'),
	(329, 29, 329, 'Palu - (Kota)'),
	(330, 11, 330, 'Pamekasan - (Kabupaten)'),
	(331, 3, 331, 'Pandeglang - (Kabupaten)'),
	(332, 9, 332, 'Pangandaran - (Kabupaten)'),
	(333, 28, 333, 'Pangkajene Kepulauan - (Kabupaten)'),
	(334, 2, 334, 'Pangkal Pinang - (Kota)'),
	(335, 24, 335, 'Paniai - (Kabupaten)'),
	(336, 28, 336, 'Parepare - (Kota)'),
	(337, 32, 337, 'Pariaman - (Kota)'),
	(338, 29, 338, 'Parigi Moutong - (Kabupaten)'),
	(339, 32, 339, 'Pasaman - (Kabupaten)'),
	(340, 32, 340, 'Pasaman Barat - (Kabupaten)'),
	(341, 15, 341, 'Paser - (Kabupaten)'),
	(342, 11, 342, 'Pasuruan - (Kabupaten)'),
	(343, 11, 343, 'Pasuruan - (Kota)'),
	(344, 10, 344, 'Pati - (Kabupaten)'),
	(345, 32, 345, 'Payakumbuh - (Kota)'),
	(346, 25, 346, 'Pegunungan Arfak - (Kabupaten)'),
	(347, 24, 347, 'Pegunungan Bintang - (Kabupaten)'),
	(348, 10, 348, 'Pekalongan - (Kabupaten)'),
	(349, 10, 349, 'Pekalongan - (Kota)'),
	(350, 26, 350, 'Pekanbaru - (Kota)'),
	(351, 26, 351, 'Pelalawan - (Kabupaten)'),
	(352, 10, 352, 'Pemalang - (Kabupaten)'),
	(353, 34, 353, 'Pematang Siantar - (Kota)'),
	(354, 15, 354, 'Penajam Paser Utara - (Kabupaten)'),
	(355, 18, 355, 'Pesawaran - (Kabupaten)'),
	(356, 18, 356, 'Pesisir Barat - (Kabupaten)'),
	(357, 32, 357, 'Pesisir Selatan - (Kabupaten)'),
	(358, 21, 358, 'Pidie - (Kabupaten)'),
	(359, 21, 359, 'Pidie Jaya - (Kabupaten)'),
	(360, 28, 360, 'Pinrang - (Kabupaten)'),
	(361, 7, 361, 'Pohuwato - (Kabupaten)'),
	(362, 27, 362, 'Polewali Mandar - (Kabupaten)'),
	(363, 11, 363, 'Ponorogo - (Kabupaten)'),
	(364, 12, 364, 'Pontianak - (Kabupaten)'),
	(365, 12, 365, 'Pontianak - (Kota)'),
	(366, 29, 366, 'Poso - (Kabupaten)'),
	(367, 33, 367, 'Prabumulih - (Kota)'),
	(368, 18, 368, 'Pringsewu - (Kabupaten)'),
	(369, 11, 369, 'Probolinggo - (Kabupaten)'),
	(370, 11, 370, 'Probolinggo - (Kota)'),
	(371, 14, 371, 'Pulang Pisau - (Kabupaten)'),
	(372, 20, 372, 'Pulau Morotai - (Kabupaten)'),
	(373, 24, 373, 'Puncak - (Kabupaten)'),
	(374, 24, 374, 'Puncak Jaya - (Kabupaten)'),
	(375, 10, 375, 'Purbalingga - (Kabupaten)'),
	(376, 9, 376, 'Purwakarta - (Kabupaten)'),
	(377, 10, 377, 'Purworejo - (Kabupaten)'),
	(378, 25, 378, 'Raja Ampat - (Kabupaten)'),
	(379, 4, 379, 'Rejang Lebong - (Kabupaten)'),
	(380, 10, 380, 'Rembang - (Kabupaten)'),
	(381, 26, 381, 'Rokan Hilir - (Kabupaten)'),
	(382, 26, 382, 'Rokan Hulu - (Kabupaten)'),
	(383, 23, 383, 'Rote Ndao - (Kabupaten)'),
	(384, 21, 384, 'Sabang - (Kota)'),
	(385, 23, 385, 'Sabu Raijua - (Kabupaten)'),
	(386, 10, 386, 'Salatiga - (Kota)'),
	(387, 15, 387, 'Samarinda - (Kota)'),
	(388, 12, 388, 'Sambas - (Kabupaten)'),
	(389, 34, 389, 'Samosir - (Kabupaten)'),
	(390, 11, 390, 'Sampang - (Kabupaten)'),
	(391, 12, 391, 'Sanggau - (Kabupaten)'),
	(392, 24, 392, 'Sarmi - (Kabupaten)'),
	(393, 8, 393, 'Sarolangun - (Kabupaten)'),
	(394, 32, 394, 'Sawah Lunto - (Kota)'),
	(395, 12, 395, 'Sekadau - (Kabupaten)'),
	(396, 28, 396, 'Selayar (Kepulauan Selayar) - (Kabupaten)'),
	(397, 4, 397, 'Seluma - (Kabupaten)'),
	(398, 10, 398, 'Semarang - (Kabupaten)'),
	(399, 10, 399, 'Semarang - (Kota)'),
	(400, 19, 400, 'Seram Bagian Barat - (Kabupaten)'),
	(401, 19, 401, 'Seram Bagian Timur - (Kabupaten)'),
	(402, 3, 402, 'Serang - (Kabupaten)'),
	(403, 3, 403, 'Serang - (Kota)'),
	(404, 34, 404, 'Serdang Bedagai - (Kabupaten)'),
	(405, 14, 405, 'Seruyan - (Kabupaten)'),
	(406, 26, 406, 'Siak - (Kabupaten)'),
	(407, 34, 407, 'Sibolga - (Kota)'),
	(408, 28, 408, 'Sidenreng Rappang/Rapang - (Kabupaten)'),
	(409, 11, 409, 'Sidoarjo - (Kabupaten)'),
	(410, 29, 410, 'Sigi - (Kabupaten)'),
	(411, 32, 411, 'Sijunjung (Sawah Lunto Sijunjung) - (Kabupaten)'),
	(412, 23, 412, 'Sikka - (Kabupaten)'),
	(413, 34, 413, 'Simalungun - (Kabupaten)'),
	(414, 21, 414, 'Simeulue - (Kabupaten)'),
	(415, 12, 415, 'Singkawang - (Kota)'),
	(416, 28, 416, 'Sinjai - (Kabupaten)'),
	(417, 12, 417, 'Sintang - (Kabupaten)'),
	(418, 11, 418, 'Situbondo - (Kabupaten)'),
	(419, 5, 419, 'Sleman - (Kabupaten)'),
	(420, 32, 420, 'Solok - (Kabupaten)'),
	(421, 32, 421, 'Solok - (Kota)'),
	(422, 32, 422, 'Solok Selatan - (Kabupaten)'),
	(423, 28, 423, 'Soppeng - (Kabupaten)'),
	(424, 25, 424, 'Sorong - (Kabupaten)'),
	(425, 25, 425, 'Sorong - (Kota)'),
	(426, 25, 426, 'Sorong Selatan - (Kabupaten)'),
	(427, 10, 427, 'Sragen - (Kabupaten)'),
	(428, 9, 428, 'Subang - (Kabupaten)'),
	(429, 21, 429, 'Subulussalam - (Kota)'),
	(430, 9, 430, 'Sukabumi - (Kabupaten)'),
	(431, 9, 431, 'Sukabumi - (Kota)'),
	(432, 14, 432, 'Sukamara - (Kabupaten)'),
	(433, 10, 433, 'Sukoharjo - (Kabupaten)'),
	(434, 23, 434, 'Sumba Barat - (Kabupaten)'),
	(435, 23, 435, 'Sumba Barat Daya - (Kabupaten)'),
	(436, 23, 436, 'Sumba Tengah - (Kabupaten)'),
	(437, 23, 437, 'Sumba Timur - (Kabupaten)'),
	(438, 22, 438, 'Sumbawa - (Kabupaten)'),
	(439, 22, 439, 'Sumbawa Barat - (Kabupaten)'),
	(440, 9, 440, 'Sumedang - (Kabupaten)'),
	(441, 11, 441, 'Sumenep - (Kabupaten)'),
	(442, 8, 442, 'Sungaipenuh - (Kota)'),
	(443, 24, 443, 'Supiori - (Kabupaten)'),
	(444, 11, 444, 'Surabaya - (Kota)'),
	(445, 10, 445, 'Surakarta (Solo) - (Kota)'),
	(446, 13, 446, 'Tabalong - (Kabupaten)'),
	(447, 1, 447, 'Tabanan - (Kabupaten)'),
	(448, 28, 448, 'Takalar - (Kabupaten)'),
	(449, 25, 449, 'Tambrauw - (Kabupaten)'),
	(450, 16, 450, 'Tana Tidung - (Kabupaten)'),
	(451, 28, 451, 'Tana Toraja - (Kabupaten)'),
	(452, 13, 452, 'Tanah Bumbu - (Kabupaten)'),
	(453, 32, 453, 'Tanah Datar - (Kabupaten)'),
	(454, 13, 454, 'Tanah Laut - (Kabupaten)'),
	(455, 3, 455, 'Tangerang - (Kabupaten)'),
	(456, 3, 456, 'Tangerang - (Kota)'),
	(457, 3, 457, 'Tangerang Selatan - (Kota)'),
	(458, 18, 458, 'Tanggamus - (Kabupaten)'),
	(459, 34, 459, 'Tanjung Balai - (Kota)'),
	(460, 8, 460, 'Tanjung Jabung Barat - (Kabupaten)'),
	(461, 8, 461, 'Tanjung Jabung Timur - (Kabupaten)'),
	(462, 17, 462, 'Tanjung Pinang - (Kota)'),
	(463, 34, 463, 'Tapanuli Selatan - (Kabupaten)'),
	(464, 34, 464, 'Tapanuli Tengah - (Kabupaten)'),
	(465, 34, 465, 'Tapanuli Utara - (Kabupaten)'),
	(466, 13, 466, 'Tapin - (Kabupaten)'),
	(467, 16, 467, 'Tarakan - (Kota)'),
	(468, 9, 468, 'Tasikmalaya - (Kabupaten)'),
	(469, 9, 469, 'Tasikmalaya - (Kota)'),
	(470, 34, 470, 'Tebing Tinggi - (Kota)'),
	(471, 8, 471, 'Tebo - (Kabupaten)'),
	(472, 10, 472, 'Tegal - (Kabupaten)'),
	(473, 10, 473, 'Tegal - (Kota)'),
	(474, 25, 474, 'Teluk Bintuni - (Kabupaten)'),
	(475, 25, 475, 'Teluk Wondama - (Kabupaten)'),
	(476, 10, 476, 'Temanggung - (Kabupaten)'),
	(477, 20, 477, 'Ternate - (Kota)'),
	(478, 20, 478, 'Tidore Kepulauan - (Kota)'),
	(479, 23, 479, 'Timor Tengah Selatan - (Kabupaten)'),
	(480, 23, 480, 'Timor Tengah Utara - (Kabupaten)'),
	(481, 34, 481, 'Toba Samosir - (Kabupaten)'),
	(482, 29, 482, 'Tojo Una-Una - (Kabupaten)'),
	(483, 29, 483, 'Toli-Toli - (Kabupaten)'),
	(484, 24, 484, 'Tolikara - (Kabupaten)'),
	(485, 31, 485, 'Tomohon - (Kota)'),
	(486, 28, 486, 'Toraja Utara - (Kabupaten)'),
	(487, 11, 487, 'Trenggalek - (Kabupaten)'),
	(488, 19, 488, 'Tual - (Kota)'),
	(489, 11, 489, 'Tuban - (Kabupaten)'),
	(490, 18, 490, 'Tulang Bawang - (Kabupaten)'),
	(491, 18, 491, 'Tulang Bawang Barat - (Kabupaten)'),
	(492, 11, 492, 'Tulungagung - (Kabupaten)'),
	(493, 28, 493, 'Wajo - (Kabupaten)'),
	(494, 30, 494, 'Wakatobi - (Kabupaten)'),
	(495, 24, 495, 'Waropen - (Kabupaten)'),
	(496, 18, 496, 'Way Kanan - (Kabupaten)'),
	(497, 10, 497, 'Wonogiri - (Kabupaten)'),
	(498, 10, 498, 'Wonosobo - (Kabupaten)'),
	(499, 24, 499, 'Yahukimo - (Kabupaten)'),
	(500, 24, 500, 'Yalimo - (Kabupaten)'),
	(501, 5, 501, 'Yogyakarta - (Kota)');

-- Dumping structure for table tokosuksesbersama.kurir
CREATE TABLE IF NOT EXISTS `kurir` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tokosuksesbersama.kurir: ~3 rows (approximately)
INSERT IGNORE INTO `kurir` (`id`, `kode`, `nama`) VALUES
	(1, 'jne', 'JNE'),
	(2, 'pos', 'POS'),
	(3, 'tiki', 'TIKI');

-- Dumping structure for table tokosuksesbersama.penilaian
CREATE TABLE IF NOT EXISTS `penilaian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produk` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nilai` int(2) DEFAULT NULL,
  `komentar` text COLLATE armscii8_bin,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- Dumping data for table tokosuksesbersama.penilaian: ~5 rows (approximately)
INSERT IGNORE INTO `penilaian` (`id`, `id_produk`, `id_user`, `nilai`, `komentar`) VALUES
	(8, 2, 6, 4, 'mantap bangett dahh saya kasih 4 bintang dulu'),
	(9, 2, 7, 5, 'paling sedap lah terima kasih toko sukses bersama'),
	(10, 12, 7, 4, ''),
	(11, 13, 7, 4, 'terima kasih toko sukses bersama produk ini sangat baik sekali, saya kasih 4 bintang dulu'),
	(12, 11, 7, 4, 'Terimakasih Toko Sukses Bersama, saya berikan 4 bintang dulu ya');

-- Dumping structure for table tokosuksesbersama.pesanan
CREATE TABLE IF NOT EXISTS `pesanan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `no_pesanan` varchar(255) NOT NULL,
  `no_resi` varchar(255) DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `berat` int(11) NOT NULL,
  `kurir` varchar(255) NOT NULL,
  `layanan` varchar(255) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `ongkos_kirim` int(11) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `status` enum('Sudah Bayar','Belum Bayar') NOT NULL DEFAULT 'Belum Bayar',
  `snap_token` varchar(255) DEFAULT NULL,
  `tanggal` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `keterangan` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table tokosuksesbersama.pesanan: ~6 rows (approximately)
INSERT IGNORE INTO `pesanan` (`id`, `id_user`, `no_pesanan`, `no_resi`, `nama`, `no_hp`, `berat`, `kurir`, `layanan`, `total_harga`, `ongkos_kirim`, `total_bayar`, `alamat`, `status`, `snap_token`, `tanggal`, `keterangan`) VALUES
	(50, 7, 'NP1699874451', 'SPXZOEKL15S', 'suhendra', '085171647703', 100, 'jne', 'REG (Layanan Reguler)_14000_3-5', 46000, 14000, 60000, 'fggfgfhg Sekadau - (Kabupaten) Kalimantan Barat', 'Sudah Bayar', 'd7f23653-857d-478a-be16-d62a9e04b6e6', '2023-11-13 18:20:51', 'Pesanan diterima'),
	(51, 7, 'NP1700029347', 'SPXZOEKL12Z', 'suhendra', '085171647703', 1080, 'tiki', 'REG (Regular Service)_9000_2', 266000, 9000, 275000, 'kota baru Pontianak - (Kabupaten) Kalimantan Barat', 'Sudah Bayar', 'd7b3c1b9-1c55-4f05-ad70-57e00e56624f', '2023-11-15 13:22:27', 'Dalam Pengiriman'),
	(52, 7, 'NP1700029847', 'SPXZOEKL12A', 'suhendra', '085171647703', 20, 'pos', 'Pos Reguler (Pos Reguler)_21000_4 HARI', 8000, 21000, 29000, 'kota baru Kayong Utara - (Kabupaten) Kalimantan Barat', 'Sudah Bayar', '80f70f16-7fc7-4ed0-a24f-434bf3cc8dd0', '2023-11-15 13:30:47', 'Dalam Pengiriman'),
	(53, 7, 'NP1700029883', 'SPXZOEOPEO1', 'suhendra', '085171647703', 20, 'tiki', 'REG (Regular Service)_9000_2', 12000, 9000, 21000, 'kota baru\r\n Pontianak - (Kota) Kalimantan Barat', 'Sudah Bayar', '9c095e78-d163-4cbd-849e-34be359cbc33', '2023-11-15 13:31:23', 'Dalam Pengiriman'),
	(54, 7, 'NP1700029924', 'SPXZOEKL112', 'suhendra', '085171647703', 60, 'pos', 'Pos Nextday (Pos Nextday)_11000_1 HARI', 8000, 11000, 19000, 'kota baru Pontianak - (Kabupaten) Kalimantan Barat', 'Sudah Bayar', '31b32266-635b-4ba7-a814-6bb66eb927e9', '2023-11-15 13:32:04', 'Dalam Pengiriman'),
	(55, 7, 'NP1700137731', 'SPXZOEKLP21', 'suhendra', '085171647703', 290, 'jne', 'YES (Yakin Esok Sampai)_12000_1-1', 101000, 12000, 113000, 'kota baru gang usaha bersama 1 Pontianak - (Kota) Kalimantan Barat', 'Sudah Bayar', '6c9af944-afe9-4958-b3b7-35fcc530ea48', '2023-11-16 19:28:51', 'Pesanan diterima');

-- Dumping structure for table tokosuksesbersama.produk
CREATE TABLE IF NOT EXISTS `produk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kategori` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `harga` varchar(11) DEFAULT NULL,
  `harga_lusin` varchar(11) DEFAULT NULL,
  `harga_kodi` varchar(11) DEFAULT NULL,
  `harga_gross` varchar(11) DEFAULT NULL,
  `stok` int(11) NOT NULL,
  `berat` int(11) NOT NULL,
  `keterangan` text,
  `gambar` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_kategori` (`id_kategori`),
  KEY `id_supplier` (`id_supplier`),
  CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `produk_ibfk_2` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table tokosuksesbersama.produk: ~8 rows (approximately)
INSERT IGNORE INTO `produk` (`id`, `id_kategori`, `id_supplier`, `nama`, `slug`, `harga`, `harga_lusin`, `harga_kodi`, `harga_gross`, `stok`, `berat`, `keterangan`, `gambar`) VALUES
	(11, 4, 2, 'Kursi Bakso Gold', 'kursi-bakso-gold', '23000', '120000', '', '', 15, 50, 'Barang Baik', '434-Kursi Bakso Gold.jpg'),
	(12, 4, 2, 'Kursi Rotan', 'kursi-rotan', '14000', '110000', '', '', 37, 50, 'baik', '848-Kursi Rotan.jpg'),
	(13, 5, 1, 'Toples 2kg', 'toples-2kg', '8000', '82000', '', '', 59, 20, 'Warnah ditentukan pemilik toko', '542-Toples.jpg'),
	(14, 3, 1, 'Gayung Jumbo Warna', 'gayung-jumbo-warna', '7000', '78000', '', '', 24, 20, '', '46-Gayung.jpg'),
	(15, 5, 1, 'Toples Sunflower', 'toples-sunflower', '8000', '70000', '', '', 60, 20, '', '605-Toples Sunflower.jpg'),
	(16, 3, 1, 'Gayung Coklat', 'gayung-coklat', '5000', '50000', '', '', 59, 10, '', '792-gayung 1.jpg'),
	(17, 6, 1, 'Keranjang Luxi', 'keranjang-luxi', '12000', '90000', '', '', 59, 20, '', '741-Keranjang.jpg'),
	(18, 7, 1, 'Gelas ftc-5', 'gelas-ftc-5', '4000', '40000', '', '384000', 22, 30, '', '594-gelas ftc.jpg');

-- Dumping structure for table tokosuksesbersama.provinsi
CREATE TABLE IF NOT EXISTS `provinsi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `provinsi_id` int(11) NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tokosuksesbersama.provinsi: ~34 rows (approximately)
INSERT IGNORE INTO `provinsi` (`id`, `provinsi_id`, `nama`) VALUES
	(1, 1, 'Bali'),
	(2, 2, 'Bangka Belitung'),
	(3, 3, 'Banten'),
	(4, 4, 'Bengkulu'),
	(5, 5, 'DI Yogyakarta'),
	(6, 6, 'DKI Jakarta'),
	(7, 7, 'Gorontalo'),
	(8, 8, 'Jambi'),
	(9, 9, 'Jawa Barat'),
	(10, 10, 'Jawa Tengah'),
	(11, 11, 'Jawa Timur'),
	(12, 12, 'Kalimantan Barat'),
	(13, 13, 'Kalimantan Selatan'),
	(14, 14, 'Kalimantan Tengah'),
	(15, 15, 'Kalimantan Timur'),
	(16, 16, 'Kalimantan Utara'),
	(17, 17, 'Kepulauan Riau'),
	(18, 18, 'Lampung'),
	(19, 19, 'Maluku'),
	(20, 20, 'Maluku Utara'),
	(21, 21, 'Nanggroe Aceh Darussalam (NAD)'),
	(22, 22, 'Nusa Tenggara Barat (NTB)'),
	(23, 23, 'Nusa Tenggara Timur (NTT)'),
	(24, 24, 'Papua'),
	(25, 25, 'Papua Barat'),
	(26, 26, 'Riau'),
	(27, 27, 'Sulawesi Barat'),
	(28, 28, 'Sulawesi Selatan'),
	(29, 29, 'Sulawesi Tengah'),
	(30, 30, 'Sulawesi Tenggara'),
	(31, 31, 'Sulawesi Utara'),
	(32, 32, 'Sumatera Barat'),
	(33, 33, 'Sumatera Selatan'),
	(34, 34, 'Sumatera Utara');

-- Dumping structure for table tokosuksesbersama.supplier
CREATE TABLE IF NOT EXISTS `supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `alamat` text,
  `keterangan` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table tokosuksesbersama.supplier: ~2 rows (approximately)
INSERT IGNORE INTO `supplier` (`id`, `nama`, `alamat`, `keterangan`) VALUES
	(1, 'Shinpo Plastic Houseware Dan Furniture ', ' Jl. Peternakan III No.38, RT.7/RW.1, Kapuk, Kecamatan Cengkareng, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11720', 'Pemasok Produk Plastic'),
	(2, 'SL PLASTIC', 'Jl.Kamal Raya Outer Ring Road Rukan Golf Lake Venice A-36 Cengkareng Timur, Jakarta Barat', 'Produk Perabotan Rumah Tangga');

-- Dumping structure for table tokosuksesbersama.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('1','2') NOT NULL DEFAULT '2' COMMENT '1: admin, 2: user',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table tokosuksesbersama.user: ~5 rows (approximately)
INSERT IGNORE INTO `user` (`id`, `nama`, `email`, `no_hp`, `password`, `level`) VALUES
	(1, 'Admin E Commerce', 'admin@gmail.com', '0895361152485', '$2y$10$ZxXxQf9MYgyNc4xP2G.1P.4Dbvqt7IhCedMTzM59wT7dKm7jxO4q.', '1'),
	(2, 'Budi Santoso', 'budi.santoso@example.com', '+62 812-3456-7890', '$2y$10$s97ThShpkJcybcWMKkRItu85u22Esh4b8OXN3zkPdeLO1FDbgIUGW', '2'),
	(3, 'Rina Dewi', 'rina.dewi@example.com', '+62 813-9876-5432', '$2y$10$s97ThShpkJcybcWMKkRItu85u22Esh4b8OXN3zkPdeLO1FDbgIUGW', '2'),
	(6, 'yosep', 'yosep@gmail.com', '085753613718', '$2y$10$hAxq3qGm6iagdnTuxf65W.CJvqiqNqn9CO0Uv77NDwxHum6Rxh60y', '2'),
	(7, 'suhendra', 'suhendra@gmail.com', '085171647703', '$2y$10$Gi5LSlnMc8EpAJvQ4JAVG.FfbilJt/51IXLLcTRV3k2cEf7e3kyUW', '2');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
