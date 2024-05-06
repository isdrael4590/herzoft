-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Mar 12, 2024 at 04:12 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `herZoft`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_code` varchar(255) DEFAULT NULL,
  `product_barcode_symbology` varchar(255) DEFAULT NULL,
  `area` varchar(255) NOT NULL,
  `product_unit` varchar(255) DEFAULT NULL,
  `product_note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(1,1,'V1','ABRE-BOCA + CAJA DE FRESAS','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(2,1,'V2','ADAPTADOR DE MICROS','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(3,1,'V3','ADAPTADORES DE MESA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(4,1,'V4','ADAPTADORES DE UROLOGIA (3)','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(5,1,'V5','ADAPTADORES EN Y (LITOVIU)','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(6,1,'V6','ADSON BRAUN','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(7,1,'V7','AGUJA DE BERRES','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(8,1,'V8','AGUJA DE PUNCIÓN','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(9,1,'V9','AJUSTA ALAMBRE','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(10,1,'V10','ALLIS','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(11,1,'V11','AMIGDALAS N° 1','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(12,1,'V12','AMIGDALAS N° 2','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(13,1,'V13','ANESTESIA RAQUIDEA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(14,1,'V14','APENDICE N°1','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(15,1,'V15','APENDICE N°2','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(16,1,'V16','ARGOLLAS','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(17,1,'V17','ARTROPLASTIA DE RODILLA N° 1','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(18,1,'V18','ARTROPLASTIA DE RODILLA N° 2','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(19,1,'V19','ASEPSIAS CON VASO /COPA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(20,1,'V20','AUTOESTATICO DE KISHNER','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(21,1,'V21','AUTOESTATICO DE T/O','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(22,1,'V22','AUXILIAR DE RINOPLASTIA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(23,1,'V23','BABCOCK','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(24,1,'V24','BANDEJA DE CLIPS ANEURISMA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(25,1,'V25','BANDEJA OFTALMOLOGIA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(26,1,'V26','BASICO MAYOR N°1','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(27,1,'V27','BASICO MAYOR N°2','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(28,1,'V28','BASICO MAYOR N°3','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(29,1,'V29','BENIQUES','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(30,1,'V30','BLEFAROSTATO','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(31,1,'V31','BRONCOSCOPIO ADULTO','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(32,1,'V32','BRONCOSCOPIO INFANTIL','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(33,1,'V33','C. MAYOR INFANTIL','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(34,1,'V34','C. MENOR INFANTIL N°1','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(35,1,'V35','C. MENOR INFANTIL N°2','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(36,1,'V36','C. VASCULAR 35 PZ','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(37,1,'V37','CABEZAL DE N/C','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(38,1,'V38','CABLES ELECTRO LAP','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(39,1,'V39','CABLES NEGROS','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(40,1,'V40','CADERA N°1','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(41,1,'V41','CADERA N°2','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(42,1,'V42','CAJA DE PLACAS Y TORNILLOS DE BIOMAT + INSTRUMENTAL','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(43,1,'V43','CAJA GRANDE DE TORNILLOS Y PLACAS','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(44,1,'V44','CANULA DE SUCCION/IRRIGACIÓN','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(45,1,'V45','CANULAS DE SUCCION','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(46,1,'V46','CANULAS DE SUCCION','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(47,1,'V47','CASTAÑEDA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(48,1,'V48','CEDAZO','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(49,1,'V49','CESAREA N°1','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(50,1,'V50','CESAREA N°2','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(51,1,'V51','CESAREA N°3','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(52,1,'V52','CHAROL 1-2','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(53,1,'V53','CHAROL 3-4','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(54,1,'V54','CINTA METRICA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(55,1,'V55','CIRCUNSICION','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(56,1,'V56','CIRUGIA CORONARIA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(57,1,'V57','CISTICAS','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(58,1,'V58','CISTOSCOPIO ADULTO','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(59,1,'V59','CISTOSCOPIO INFANTIL','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(60,1,'V60','CLIPIADORA  DORADA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(61,1,'V61','CLIPIADORA (LILA)  HEMOLOCK','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(62,1,'V62','CLIPIADORA CLIPS TITANIO 10mm','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(63,1,'V63','CLIPIADORA DOBLE PERFIL','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(64,1,'V64','COAGULADOR DE PLASMA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(65,1,'V65','COLUMNA N/C','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(66,1,'V66','COMPAS','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(67,1,'V67','COMPAS DE CRUTCHFIELD','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(68,1,'V68','COMPAZ','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(69,1,'V69','COMPLEMENTARIO DE LARINGOSCOPIA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(70,1,'V70','COMPLEMENTARIO DE TABIQUE','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(71,1,'V71','CONDUCTORES DE SONDA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(72,1,'V72','CONECTORES DE BOMBA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(73,1,'V73','CONFORMA DE CAMARA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(74,1,'V74','COPA DE CEMENTO','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(75,1,'V75','CORTA ALAMBRE GRANDE  (TONTON)','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(76,1,'V76','CORTA ALAMBRE KHISNER','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(77,1,'V77','CRANEO DE EMERGENCIA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(78,1,'V78','CRANEO ELECTIVA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(79,1,'V79','CRANEOTOMO LIMVATEC','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(80,1,'V80','CRANEOTOMO MIDAS REX','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(81,1,'V81','CRANEOTOMO SYNTHES','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(82,1,'V82','CROSHET','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(83,1,'V83','CUCHARAS','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(84,1,'V84','CUCHILLO URETROTOMIA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(85,1,'V85','CURACION','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(86,1,'V86','CURETAJE N° 1','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(87,1,'V87','CURETAJE N° 2','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(88,1,'V88','CURETAJE N° 3','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(89,1,'V89','CURETAJE N° 4','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(90,1,'V90','CURETAS','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(91,1,'V91','DAVIERES DE ROTULA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(92,1,'V92','DEAVERES','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(93,1,'V93','DECOLADORES','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(94,1,'V94','DERMATOMO','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(95,1,'V95','DESPERIOSTIZADOR','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(96,1,'V96','DESTORNILADORES','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(97,1,'V97','DESTORNILADORES TRIMED (2,0)','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(98,1,'V98','DIAGNOSTICO N° 1','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(99,1,'V99','DIAGNOSTICO N° 2','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(100,1,'V100','DIAGNOSTICO N° 3','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(101,1,'V101','DILATADORES  RECTALES','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(102,1,'V102','DILATADORES DE GUYO','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(103,1,'V103','DILATADORES DE VALVULA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(104,1,'V104','DILATADORES METALICOS CON OLIVA 4 PZ','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(105,1,'V105','DISTRACTOR DE TOBILLO','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(106,1,'V106','DOBLADOR DE PLACAS','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(107,1,'V107','DOBLE ESPATULA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(108,1,'V108','DOPPLER VASCULAR','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(109,1,'V109','ELEVADOR DE GIGLES','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(110,1,'V110','ELEVADOR ESPINAL','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(111,1,'V111','ELEVADOR MALAR','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(112,1,'V112','EMBOLECTOMIA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(113,1,'V113','EMPUJA NUDOS','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(114,1,'V114','ENDOCISTICA LAP.','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(115,1,'V115','ENDOVASCULAR','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(116,1,'V116','EQ DACRIO 16PZ','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(117,1,'V117','EQ DE CHALAZION','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(118,1,'V118','EQ DE CORNEA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(119,1,'V119','EQ DE ESTRABISMO','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(120,1,'V120','EQ DE FACO','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(121,1,'V121','EQ DE PARPADOS','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(122,1,'V122','EQ DE VIAS LAFRIMALES','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(123,1,'V123','EQ DE VITRECTOMIA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(124,1,'V124','EQ ENUCLEACION 13PZ','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(125,1,'V125','EQ EXTRACAPSULAR','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(126,1,'V126','EQ LENTE  2PZ','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(127,1,'V127','EQ LENTE ARTIZAN 2PZ','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(128,1,'V128','EQ. 3.5 MINIFRAGMENTOS','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(129,1,'V129','EQ. ASPIRADOR ULTRASONICO','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(130,1,'V130','EQ. COLUMNA N° 1','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(131,1,'V131','EQ. COLUMNA N° 2','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(132,1,'V132','EQ. COMPLEMENTARIO DE OIDO','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(133,1,'V133','EQ. CORAZON “A”','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(134,1,'V134','EQ. DE ATROSCOPIA ATRHEX  N° 1','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(135,1,'V135','EQ. DE ATROSCOPIA ATRHEX  N° 2','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(136,1,'V136','EQ. DE CIERRE DE PARED','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(137,1,'V137','EQ. DE ENDOSCOPIA NASAL','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(138,1,'V138','EQ. DE ESTERIOTAXIA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(139,1,'V139','EQ. DE LAPAROSCOPIA URO','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(140,1,'V140','EQ. DE LARINGOSCOPIA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(141,1,'V141','EQ. DE MEÑISCOS','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(142,1,'V142','EQ. DE NARIZ N°1','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(143,1,'V143','EQ. DE NARIZ N°2','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(144,1,'V144','EQ. DE OIDO','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(145,1,'V145','EQ. DE PROCEDIMIENTOS N° 1','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(146,1,'V146','EQ. DE PROCEDIMIENTOS N° 2','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(147,1,'V147','EQ. DE PROCEDIMIENTOS N° 3','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(148,1,'V148','EQ. DE PROCTOLOGIA N°1','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(149,1,'V149','EQ. DE PROCTOLOGIA N°2','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(150,1,'V150','EQ. DE PROCTOLOGIA N°3','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(151,1,'V151','EQ. DE PROCTOLOGIA N°4','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(152,1,'V152','EQ. DE TUMORES','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(153,1,'V153','EQ. DE VALVULA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(154,1,'V154','EQ. DE VANDA TVT N°1','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(155,1,'V155','EQ. DE VANDA TVT N°2','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(156,1,'V156','EQ. DE VANDA TVT N°3','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(157,1,'V157','EQ. DE VESICULA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(158,1,'V158','EQ. FRESADO DE OIDO','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(159,1,'V159','EQ. GASPAR','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(160,1,'V160','EQ. GASTROSTOMIA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(161,1,'V161','EQ. LAPAROSCOPIA STORZ  N° 1','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(162,1,'V162','EQ. LAPAROSCOPIA STORZ  N° 2','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(163,1,'V163','EQ. LAPAROSCOPIA STORZ  N° 3','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(164,1,'V164','EQ. LAPAROSCOPIA STORZ  N° 4','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(165,1,'V165','EQ. LAPAROSCOPIA STORZ  N° 5','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(166,1,'V166','EQ. LAPAROSCOPIA STORZ  N° 6','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(167,1,'V167','EQ. LAPAROSCOPIA STORZ BARIATRICA N°1','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(168,1,'V168','EQ. LAPAROSCOPIA STORZ BARIATRICA N°2','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(169,1,'V169','EQ. MOOR DE CADERA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(170,1,'V170','EQ. PERCUTANEO','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(171,1,'V171','ESCOPLOS','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(172,1,'V172','ESCOPLOS ( 7 ) MAXILOPLASTICA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(173,1,'V173','ESCORFINAS','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(174,1,'V174','ESOFAGOSCOPIA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(175,1,'V175','ESPATULA DE DIALISIS','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(176,1,'V176','ESPATULA LAP. URO','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(177,1,'V177','ESPECULO VAGINAL','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(178,1,'V178','ESPECULO VAGINAL PEQ','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(179,1,'V179','ESTILETES','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(180,1,'V180','ESTRIBO DE KISHNER','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(181,1,'V181','ESTRIBO DE STEINMANN','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(182,1,'V182','EVACUADOR DE ELLIK','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(183,1,'V183','EXAMEN GINECOLOGICO','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(184,1,'V184','EXTRACTORA DE VESÍCULA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(185,1,'V185','FLEBOESTRACTOR','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(186,1,'V186','FORCEPS','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(187,1,'V187','FUKUDA 2 PZ','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(188,1,'V188','GANCHO DE ESTRABISMO','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(189,1,'V189','GANCHO DE PIEL','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(190,1,'V190','GUBIA Y CIZALLA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(191,1,'V191','HALO CRANEAL  BODEGA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(192,1,'V192','HARRINGTON','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(193,1,'V193','HERNIA N°1','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(194,1,'V194','HERNIA N°2','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(195,1,'V195','HERNIA N°3','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(196,1,'V196','HISTERECTOMIA N°1','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(197,1,'V197','HISTERECTOMIA N°2','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(198,1,'V198','HISTEROSCOPIO','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(199,1,'V199','HOOK LAP. URO','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(200,1,'V200','IMPACTOR DE GRAPAS','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(201,1,'V201','INS. MINI-PEQ FRAGMENTOS','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(202,1,'V202','INST LAPAROSCOPIA 1 -2','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(203,1,'V203','INST LAPAROSCOPIA 3-4','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(204,1,'V204','INST LAPAROSCOPIA 5 - 6','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(205,1,'V205','INST. BLOQUEO CLAVO UNIVERSAL','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(206,1,'V206','INST. DE MAXILOFACIAL  VERTICALES 19PZ','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(207,1,'V207','INST. DE MAXILOFACIAL 17 PZ','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(208,1,'V208','INST. DE MAXILOFACIAL SAGITAL 19PZ','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(209,1,'V209','INST. INSERCION CLAVO UINIVERSAL','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(210,1,'V210','INTESTINALES','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(211,1,'V211','INYECTOR DE LENTE','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(212,1,'V212','JACOBS CON LLAVE','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(213,1,'V213','JARRAS','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(214,1,'V214','JUEGO DE PZ LAPAROSC.CX BARIATRICA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(215,1,'V215','KELLYS RECTAS','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(216,1,'V216','KOCHER','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(217,1,'V217','LAHEY','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(218,1,'V218','LAPAROSCOPIA INFANTIL','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(219,1,'V219','LAPAROTOMIA N°1','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(220,1,'V220','LAPAROTOMIA N°2','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(221,1,'V221','LAPAROTOMIA N°3','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(222,1,'V222','LAPAROTOMIA N°4','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(223,1,'V223','LAPAROTOMIA N°5','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(224,1,'V224','LAPAROTOMIA N°6','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(225,1,'V225','LAPAROTOMIA PEDIATRICA N°1','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(226,1,'V226','LAPAROTOMIA PEDIATRICA N°2','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(227,1,'V227','LEGRAS','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(228,1,'V228','LIGADURA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(229,1,'V229','LITOTRIPTOR','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(230,1,'V230','MAMOPLASTIA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(231,1,'V231','MANGO DE BISTURI','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(232,1,'V232','MANGO DE BISTURI LAP.','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(233,1,'V233','MANGO DE LAMPARA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(234,1,'V234','MANIPULADOR UTERINO','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(235,1,'V235','MANO N° 1','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(236,1,'V236','MANO N° 2','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(237,1,'V237','MANO N° 3','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(238,1,'V238','MANO N° 4','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(239,1,'V239','MANOPLA/ SOPORTE  DE MANO','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(240,1,'V240','MARTILLOS','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(241,1,'V241','MAXILOPLASTIA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(242,1,'V242','MESA DE MANO (PLASTICA)','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(243,1,'V243','MICRO PINZAS BAYONETAS','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(244,1,'V244','MICROCIRUGIA PEDIATRICA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(245,1,'V245','MICROCIRUGIA PLASTICA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(246,1,'V246','MICROCIRUGIA T/O N° 1','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(247,1,'V247','MICROCIRUGIA T/O N° 2','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(248,1,'V248','MICROCIRUGIA VASCULAR N°1','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(249,1,'V249','MICROCIRUGIA VASCULAR N°2','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(250,1,'V250','MICROFRACTURADORES','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(251,1,'V251','MICRO-NERVIOS PERIFERICOS','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(252,1,'V252','MICRONEUROCIRUGIA DISECTORES','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(253,1,'V253','MICRONEUROCIRUGIA TIJERAS','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(254,1,'V254','MORDAZA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(255,1,'V255','MOSQUITOS CURVOS','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(256,1,'V256','NEFROSCOPIO','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(257,1,'V257','OPTICA DE CADERA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(258,1,'V258','OPTICA DE CX GENERAL','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(259,1,'V259','OPTICA DE RODILLA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(260,1,'V260','OPTICA DE TOBILLO','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(261,1,'V261','OPTICA ENDOSCOPIA NASAL  Y DOC.','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(262,1,'V262','OPTICA NUEVA DE  0° CX GENERAL','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(263,1,'V263','OPTICA NUEVA DE  30°','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(264,1,'V264','OPTICA UROLOGIA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(265,1,'V265','OPTICAY NISSEN 30°','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(266,1,'V266','OSTEOSINTESIS N°1','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(267,1,'V267','OSTEOSINTESIS N°2','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(268,1,'V268','OSTEOSINTESIS N°3','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(269,1,'V269','OSTEOSINTESIS N°4','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(270,1,'V270','OTOSCOPIO NEGRO','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(271,1,'V271','PALAS PARA DESFIBRILADOR','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(272,1,'V272','PARTOS N° 1','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(273,1,'V273','PARTOS N° 2','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(274,1,'V274','PARTOS N° 3','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(275,1,'V275','PARTOS N° 4','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(276,1,'V276','PARTOS N° 5','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(277,1,'V277','PASADOR DE HILO LAP.','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(278,1,'V278','PASADORES DE ALAMBRE','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(279,1,'V279','PASADORES DE VANDA TVT (AGUJAS HELICOIDALES)','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(280,1,'V280','PEDICULO RENAL','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(281,1,'V281','PELADOR Y CORTADOR  DE LASER','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(282,1,'V282','PEQUEÑAS ARTICULACIONES','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(283,1,'V283','PEQUEÑOS FRAGMENTOS','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(284,1,'V284','PERFORADOR SYNTHES','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(285,1,'V285','PERILLAS','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(286,1,'V286','PIEZA DE MANO MAXILOFACIAL + LLAVE','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(287,1,'V287','PIEZAS DE MANO PARA FRESAS','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(288,1,'V288','PIEZAS DE MANO PARA SIERRAS SYNTHES (TRAUMAMED)','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(289,1,'V289','PINZA DE BOLA LAP.','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(290,1,'V290','PINZA PARA MARCAR','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(291,1,'V291','PINZAS DE DISCO (paquete de 3)','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(292,1,'V292','PINZAS DE UROLOGIA LAP ( DOSLEY)','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(293,1,'V293','PINZAS KERRISON (paquete de 5)','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(294,1,'V294','PLASTIA  N° 1','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(295,1,'V295','PLASTIA  N° 2','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(296,1,'V296','PLASTIA  N° 3','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(297,1,'V297','PLASTIA  N° A','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(298,1,'V298','PLASTIA  N° B','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(299,1,'V299','PLASTIA  N° C','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(300,1,'V300','PLASTIA DE EMERGENCIA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(301,1,'V301','PLASTICA N°1','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(302,1,'V302','PLASTICA N°2','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(303,1,'V303','PLASTICA N°3','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(304,1,'V304','PLAYOS','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(305,1,'V305','PLAYOS DE PRESION','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(306,1,'V306','PORTA AGUJAS CX BARIATRICA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(307,1,'V307','PORTA AGUJAS ETHICON UROLOGIA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(308,1,'V308','PORTA AGUJAS NISSEN','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(309,1,'V309','PROCTOLOGIA INFANTIL','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(310,1,'V310','PROSTATECTOMIA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(311,1,'V311','PROTECTORES DE MICROS','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(312,1,'V312','PUENTE DE UROLOGIA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(313,1,'V313','PUNTA DE VITRECTOMIA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(314,1,'V314','PUNTAS CUADRADAS','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(315,1,'V315','PUNTAS PATA DE CABRA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(316,1,'V316','PZ BIPOLAR+CABLE','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(317,1,'V317','PZ BIPOLAR+CABLE OPT','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(318,1,'V318','PZ DE ARTROSCOPIA  (PAQUETE DE 4 PZS)','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(319,1,'V319','PZ DE CATARATA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(320,1,'V320','PZ DE COLANGIOGRAFIA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(321,1,'V321','PZ DE NEFRECTOMIA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(322,1,'V322','PZ DE VITRECTOMIA 4PZ +COCODRILO','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(323,1,'V323','PZ RECUPERADORA  DE SUTURA  (PESCA HILOS)','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(324,1,'V324','PZ TRIDENTE','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(325,1,'V325','PZ. ARO','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(326,1,'V326','PZ. BABCOCK LAP.','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(327,1,'V327','PZ. BABY TISCHLER (BIOPSIA)','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(328,1,'V328','PZ. COCODRILO','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(329,1,'V329','PZ. CUERPO EXTRAÑO ORL.','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(330,1,'V330','PZ. DE CAMPO','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(331,1,'V331','PZ. DE CORTE','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(332,1,'V332','PZ. DE PROSTATA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(333,1,'V333','PZ. GINE','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(334,1,'V334','PZ. LARGAS','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(335,1,'V335','PZ. TISCHLER (BIOPSIA)','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(336,1,'V336','RALLADOR','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(337,1,'V337','REDUCCION INCRUENTA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(338,1,'V338','RESECTOSCOPIO F CONTINUO N°1','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(339,1,'V339','RESECTOSCOPIO F CONTINUO N°2','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(340,1,'V340','RETRACTOR DE URO','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(341,1,'V341','RETRACTORES ABDOMINALES','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(342,1,'V342','REVISION DE GINECOLOGIA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(343,1,'V343','RINOPLASTIA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(344,1,'V344','ROCHESTER','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(345,1,'V345','SACAGRAPAS','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(346,1,'V346','SACA-GRAPAS','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(347,1,'V347','SEMILUNA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(348,1,'V348','SENMILLER','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(349,1,'V349','SEP DE GELPI','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(350,1,'V350','SEP. BALFOUR','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(351,1,'V351','SEP. BENNETT','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(352,1,'V352','SEP. COLUMNA (7PZ)','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(353,1,'V353','SEP. COLUMNA TITANIO  (34PZ)','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(354,1,'V354','SEP. DE COLUMNA LARGOS','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(355,1,'V355','SEP. DE COLUMNA SCOVILLE','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(356,1,'V356','SEP. DE FINOCHIETO Y ESTERNON','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(357,1,'V357','SEP. DE MAMA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(358,1,'V358','SEP. DE ROCHARD','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(359,1,'V359','SEP. DE VENA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(360,1,'V360','SEP. FARABEU','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(361,1,'V361','SEP. HOFFMAN','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(362,1,'V362','SEP. SULLIVAN','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(363,1,'V363','SEP. TAYLOR','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(364,1,'V364','SEP. WEITLANER','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(365,1,'V365','SEP. WOLMAN','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(366,1,'V366','SEP.ESPINAL N/C','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(367,1,'V367','SEPARADOR DE LEYLA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(368,1,'V368','SEPARADOR DE RAIZ','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(369,1,'V369','SEPARADOR EN "S" (2PZ)','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(370,1,'V370','SEPARADOR RICHARDSON','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(371,1,'V371','SET DE AGUJAS','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(372,1,'V372','SET DE SUCCION/IRRIGACIÓN (4PZ)','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(373,1,'V373','SET.  TREPANO ESTEREOTAXICO CAJA N ° 3','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(374,1,'V374','SETS. DE IEQ. CLIPS ANEURISMA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(375,1,'V375','SHAVER DE NEUROCIRUGIA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(376,1,'V376','SHAVER ERGO ARTROSCOPIA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(377,1,'V377','SIERRA DE ESTERNON','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(378,1,'V378','SIERRA DE GIGLES','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(379,1,'V379','SIERRA DE MAXILOFACIAL + LLAVE','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(380,1,'V380','SIERRA STRYKER','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(381,1,'V381','SIERRA Y PERFORADOR COMPAC DRIVE','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(382,1,'V382','SIERRAS','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(383,1,'V383','SINUSITIS','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(384,1,'V384','SISTEMA DE SEPARADORES','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(385,1,'V385','SONDA ACANALADA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(386,1,'V386','SUBDURAL','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(387,1,'V387','TABIQUE N° 1','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(388,1,'V388','TABIQUE N° 2','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(389,1,'V389','TENOTOMOS (2 PZS)','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(390,1,'V390','TIJERA BIPOLAR NEGRA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(391,1,'V391','TIJERA DE ALAMBRE','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(392,1,'V392','TIJERA IRIS','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(393,1,'V393','TIJERA STEVENS CURVA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(394,1,'V394','TIJERA STEVENS RECTA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(395,1,'V395','TIJERAS DE SALA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(396,1,'V396','TIROIDES','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(397,1,'V397','TORACOSCOPIA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(398,1,'V398','TORAX ADULTO','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(399,1,'V399','TORAX INFANTIL','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(400,1,'V400','TRANSESFENOIDAL','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(401,1,'V401','TRANSPLANTE RENAL','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(402,1,'V402','TRAQUEOSTOMIA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(403,1,'V403','TREPANO DE HUDSON','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(404,1,'V404','TROCAR DE UROLOGIA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(405,1,'V405','URETEROSCOPIO FLEXIBLE STORZ caja ploma','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(406,1,'V406','URETEROSCOPIO RIGIDO wolf  storz','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(407,1,'V407','URETEROSCOPIO SEMI RIGIDO  storz','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(408,1,'V408','URETROTOMO R. WOLF','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(409,1,'V409','VALVA DE PESO','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(410,1,'V410','VALVAS GINECOLOGICAS','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(411,1,'V411','VARICES N° 1','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(412,1,'V412','VARICES N° 2','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(413,1,'V413','VARICES N° 3','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(414,1,'V414','VASCULAR ABDOMINAL','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(415,1,'V415','VASCULAR PERIFERICO','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(416,1,'V416','VIA CENTRAL','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(417,1,'V417','VIA SUBCLAVIA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(418,1,'V418','VRT. M. INFERIOR','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(419,1,'V419','BATA + TOALLA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(420,1,'V420','COMPLEMENTARIO DE CADERA N°1','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(421,1,'V421','COMPLEMENTARIO DE CADERA N°2','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(422,1,'V422','MAXILO-ONCOLOGICA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(423,1,'V423','INJERTO OSEO','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(424,1,'V424','EQ. LEFORT ORTOG. VERTICAL','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(425,1,'V425','TRAUMA  FACIAL MANDIBULAR','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(426,1,'V426','ORTOGMATICA SAGITAL','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(427,1,'V427','EQ. DE ORBITA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(428,1,'V428','PLASTIA GENERAL N°1','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(429,1,'V429','PLASTIA GENERAL N°2','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(430,1,'V430','PLASTIA  N° 5','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(431,1,'V431','DERMATOMO BRAUN/ SOUTTEL','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(432,1,'V432','MALLADOR BRAUN','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(433,1,'V433','PINZA CUCHARA POSPARTO','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(434,1,'V434','PINZAS SE DISCO COLUMNA CERVICAL (14)','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(435,1,'V435','SEPARADOR DE CLOWARD','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(436,1,'V436','CURETAS DE NEUROCIRUGIA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(437,1,'V437','ESFERAS DE NEURONAVEGADOR','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(438,1,'V438','COMPLEMENTARIO DE  COLUMNA N°  1','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(439,1,'V439','COMPLEMENTARIO DE  COLUMNA N°  2','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(440,1,'V440','OPTICA DE MUÑECA','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(441,1,'V441','OPTICA DE TUNEL CARPIANO','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(442,1,'V442','INSTRUMENTAL DE PEQUEÑOS FRAGMENTOS PARA TORNILLOS CANULADO 20 PZ','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(443,1,'V443','TORNILLOS CANULADOS MANO INTERFALANGE (2,25 - 3,0)','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(444,1,'V444','INSTRUMENTAL PARA TORNILLOS CANULADOS 6,0','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(445,1,'V445','TORNILLOS CANULADOS 6.0','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(446,1,'V446','EQ. KUNCHER HE-1','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(447,1,'V447','EQUIPO DISTAL - OLECRANEON 2,7 /2,9 / 3,5','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(448,1,'V448','EQUIPO DE CLAVICULA - HUMERO','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(449,1,'V449','GUIAS FEMORALES  (4PIEZAS)','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(450,1,'V450','PERFORADOR MANUAL ( HE-1 )','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(451,1,'V451','SISTEMA PARA MANO/PIE  MINIFRAGMENTOS 2,0/1,3/1,5 BLOQUEO-CORTICAL','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(452,1,'V452','SISTEMA PARA OLECRANEON','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(453,1,'V453','CLAVICULA 3,5 - 2,7','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(454,1,'V454','SISTEMA PARA TOBILLO A Y B','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(455,1,'V455','SISTEMA PARA MUÑECA  MIEMBRO SUPERIOR B  (3,2 - 2,3)','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(456,1,'V456','SISTEMA PARA PIE DELANTERO','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(457,1,'V457','SISTEMA DE TORNILLOS CANULADOS GRANDES COMPRESION (5,5 - 7,3)','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(458,1,'V458','COPA SUBTALAR  (ARTRODESIS SUBASTRAGALINA)','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(459,1,'V459','ACORTAMIENTO CUBITAL 23 PIEZAS','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(460,1,'V460','EQ. PERONE / CLAVOS TENS','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(461,1,'V461','SET COMPLETO INSTRUMENTAL L.C.A 61 PIEZAS','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(462,1,'V462','EQUIPO PARA CIRUGIA DE MANGUITO ROTADOR (3PAQUETES)','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(463,1,'V463','MAXILOFACIAL 32 piezas','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(464,1,'ANGIO1','Asepsia 8 pinzas','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(465,1,'ANGIO2','Semiluna','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(466,1,'ANGIO3','Pocillo','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(467,1,'ANGIO4','Eq. Plastia 21 piezas','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(468,1,'ANGIO5','Porta aguja','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(469,1,'ANGIO6','Eq. Plastia 25 piezas','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(470,1,'ANGIO7','Mangas','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(471,1,'ANGIO8','Manga de Electro','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(472,1,'URO1','Beniquez x 6','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(473,1,'URO2','Beniquez x 10','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(474,1,'URO3','Beniquez x 11','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(475,1,'URO4','Semiluna','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(476,1,'URO5','Bandeja con tapa','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(477,1,'URO6','Bandeja pequeña','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(478,1,'URO7','Eq. Vasectomía 13 + bandeja','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(479,1,'URO8','Ed. Plastia 8 piezas','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(480,1,'DER1','Eq. Exeresis','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(481,1,'DER2','Eq. Uñas','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(482,1,'DER3','Eq. Biopsia','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(483,1,'DER4','Eq. Curación','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(484,1,'DER5','Eq. Retiro de puntos','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(485,1,'DER6','Cureta','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(486,1,'TRAU1','Pinza Mosquito','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(487,1,'TRAU2','Playo','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(488,1,'TRAU3','Semiluna','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(489,1,'TRAU4','Eq. Curación','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(490,1,'PROC1','Pinza Aro','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(491,1,'PROC2','Eq. Curación 2 piezas','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(492,1,'PF1','Espéculo','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(493,1,'PF2','Pinza Nova','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(494,1,'PF3','Pinza Aro','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(495,1,'PF4','Eq. Inserción','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(496,1,'PF5','Tijera','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(497,1,'PF6','Eq. Biopsia','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(498,1,'PF7','Lavacara','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(499,1,'PF8','Pinza Kelly','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(500,1,'CXP1','Rinoscopia','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(501,1,'CXP2','Eq. Sutura','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(502,1,'CXV1','Equipo de Curación','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(503,1,'CXV2','Pinza Mosquito','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(504,1,'GE1','Frasco','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(505,1,'GE2','Tapa ley ton','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(506,1,'GE3','Tubo ley ton','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(507,1,'GE4','Pipeta','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(508,1,'ODON1','Carpul','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(509,1,'ODON2','Kit Odontologico','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(510,1,'ODON3','Contrangulo','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(511,1,'ODON4','Copa','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(512,1,'ODON5','Cureta','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(513,1,'ODON6','Dejes','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(514,1,'ODON7','Destornillador','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(515,1,'ODON8','Elevador recto','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(516,1,'ODON9','Eq Operatorio 5 piezas','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(517,1,'ODON10','Eq. Conexión','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(518,1,'ODON11','Eq. de 15 pinzas','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(519,1,'ODON12','Eq. Diagnóstico 3 piezas','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(520,1,'ODON13','Eq. Operatorio 4 pinzas','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(521,1,'ODON14','Eq. Operatorio 5 piezas','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(522,1,'ODON15','Eq. Operatorio 7 piezas','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(523,1,'ODON16','Eq. Quirúrgico','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(524,1,'ODON17','Eq. Retiro de puntos','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(525,1,'ODON18','Cucharilla','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(526,1,'ODON19','Espejo','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(527,1,'ODON20','Fórceps inferior','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(528,1,'ODON21','Fórceps superior','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(529,1,'ODON22','Fresa','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(530,1,'ODON23','Fresero','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(531,1,'ODON24','Horquilla','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(532,1,'ODON25','Tornillos x 2 und','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(533,1,'ODON26','Lima','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(534,1,'ODON27','Pocillo','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(535,1,'ODON28','Gancho','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(536,1,'ODON29','Succión','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(537,1,'ODON30','Winter','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(538,1,'ODON31','Regla','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(539,1,'ODON32','Punta Cavitron','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(540,1,'ODON33','Perforadora','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(541,1,'ODON34','Arco','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(542,1,'ODON35','Block','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(543,1,'ODON36','Abreboca','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(544,1,'ODON37','Saca Corona','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(545,1,'ODON38','Espatula','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(546,1,'ODON39','Porta Clamp','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(547,1,'ODON40','Grapas','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(548,1,'GINE1','Pinza Aro','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(549,1,'GINE2','Equipo de inserción','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(550,1,'ONCO1','Biopsia 15 pinzas','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(551,1,'ONCO2','Eq. Curación','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(552,1,'ACU1','Campo de Lumbar','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(553,1,'ACU2','Campo de Rodilla','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(554,1,'COFT1','Campo de ojo','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(555,1,'COFT2','Semiluna','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(556,1,'COFT3','Pocillo metálico','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(557,1,'COFT4','Eq. Pterigio','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(558,1,'COFT5','Tapas para Microscopio','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(559,1,'COFT6','Funda para Microscopio','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(560,1,'NEFRO1','Bata','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(561,1,'NEFRO2','Campo de ojo','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(562,1,'NEFRO3','Cambio de línea','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(563,1,'NEFRO4','Eq. Sutura','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(564,1,'NEFRO5','Manga de electro','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(565,1,'NEFRO6','Campo doble','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(566,1,'CI1','Bata - PISO Nro. 4','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(567,1,'CI2','Campo de ojo - PISO Nro. 4','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(568,1,'CI3','Vía central lencería - PISO Nro. 4','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(569,1,'CI4','Eq. Sutura - PISO Nro. 4','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(570,1,'CI5','Eq. Curación - PISO Nro. 4','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(571,1,'CI6','Eq. Traqueotomía - PISO Nro. 4','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(572,1,'CI7','Pinza Aro - PISO Nro. 4','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(573,1,'CI8','Pinza Maguil - PISO Nro. 4','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(574,1,'CI9','Campo Simple - PISO Nro. 4','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(575,1,'HX1','Eq. Curación - PISO Nro. 5','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(576,1,'HX2','Campo de ojo - PISO Nro. 5','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(577,1,'HX3','Bata - PISO Nro. 5','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(578,1,'HX4','Eq. Curación - PISO Nro. 8','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(579,1,'HX5','Eq. Curación - PISO Nro. 9','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(580,1,'HX6','NPT - PISO Nro. 11','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(581,1,'HX7','Ropa para Hemocultivo - PISO Nro. 11','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(582,1,'HX8','Espéculo - PISO Nro. 12','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(583,1,'HX9','Porta esponja - PISO Nro. 12','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(584,1,'HX10','Pinza de Aminoréis - PISO Nro. 12','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(585,1,'HX11','Pinza Aro - PISO Nro. 12','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(586,1,'HX12','NPT - PISO Nro. 12','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(587,1,'E1','Bata + Toalla','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(588,1,'E2','Vía central','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(589,1,'E3','Campo de ojo','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(590,1,'E4','Semiluna','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(591,1,'E5','Eq. Curación','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(592,1,'E6','Eq. Sutura','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(593,1,'E7','Pinza Anatómica','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(594,1,'E8','Campo mediano','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(595,1,'E9','Pinza Porta Esponja','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(596,1,'E10','Pinza Maguil','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(597,1,'ECO1','Campo de  Ojo','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(598,1,'ECO2','Bata','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(599,1,'ECO3','Funda de electro','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(600,1,'NEO1','Semiluna','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(601,1,'NEO2','Perilla','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(602,1,'NEO3','Lavacara','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(603,1,'NEO4','Eq. Umbilical','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(604,1,'NEO5','Eq. Sutura','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(605,1,'NEO6','Vía Central','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(606,1,'NEO7','NPT','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(607,1,'NEO8','Pinza Anatómica','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(608,1,'NEO9','Torunda','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(609,1,'CDE1','Eq. Curación S/B','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(610,1,'CDE2','Eq. Sutura','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(611,1,'CDE3','Eq. Inserción','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(612,1,'CDE4','Espéculo','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(613,1,'CDE5','Lavacara','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(614,1,'CDE6','Jarra','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(615,1,'CDE7','Media sabana','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(616,1,'CDE8','Ropa de partos','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(617,1,'CDE9','Recién Nacidos','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(618,1,'CDE10','Básico de Ropa','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(619,1,'CDE11','Básico de Cistoscopia','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(620,1,'CDE12','Básico de Oftalmología','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(621,1,'CDE13','Campos de ojo de Sop.','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(622,1,'CDE14','Campos de ojo de Oft.','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(623,1,'CDE15','Campos de Instrumental','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(624,1,'CDE16','Campo mediano','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(625,1,'CDE17','Blusa','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(626,1,'CDE18','Bolsillo','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(627,1,'CDE19','Funda de electro','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(628,1,'CDE20','Básico de nariz','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(629,1,'CDE21','Funda mayo','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(630,1,'CDE22','Poncho de ginecología','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(631,1,'CDE23','Poncho abierto','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(632,1,'CDE24','Poncho de neurocirugía','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(633,1,'CDE25','Básico de Ganz','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(634,1,'CDE26','Punción lumbar','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(635,1,'CDE27','Material blanco','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(636,1,'CDE28','Eq. Curación C/B','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(637,1,'CDE29','Mangas','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');
INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_code`, `product_barcode_symbology`, `area`, `product_unit`, `product_note`, `created_at`, `updated_at`) VALUES
(638,1,'CDE30','Poncho de Otologia','C128','CIRUGIA','Un','NA', '2024-03-31 04:56:08', '2024-03-31 04:56:08');


--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_product_code_unique` (`product_code`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;
--
-- Constraints for table `products`
--
/*ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `users` (`id`) ON DELETE CASCADE; */ /*TODO: Chequear si es necesario*/


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;