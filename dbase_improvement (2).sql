-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2018 at 06:32 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbase_improvement`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `ExtractNumber` (`in_string` VARCHAR(50)) RETURNS INT(11) NO SQL
BEGIN
    DECLARE ctrNumber VARCHAR(50);
    DECLARE finNumber VARCHAR(50) DEFAULT '';
    DECLARE sChar VARCHAR(1);
    DECLARE inti INTEGER DEFAULT 1;

    IF LENGTH(in_string) > 0 THEN
        WHILE(inti <= LENGTH(in_string)) DO
            SET sChar = SUBSTRING(in_string, inti, 1);
            SET ctrNumber = FIND_IN_SET(sChar, '0,1,2,3,4,5,6,7,8,9'); 
            IF ctrNumber > 0 THEN
                SET finNumber = CONCAT(finNumber, sChar);
            END IF;
            SET inti = inti + 1;
        END WHILE;
        RETURN CAST(finNumber AS UNSIGNED);
    ELSE
        RETURN 0;
    END IF;    
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `ira_data_improvement`
--

CREATE TABLE `ira_data_improvement` (
  `ID_IMPROVEMENT` int(11) NOT NULL,
  `NO_REGISTRASI` varchar(35) NOT NULL,
  `DEPT_PENGUSUL` varchar(10) DEFAULT NULL,
  `NIK_KARYAWAN` varchar(20) DEFAULT NULL,
  `TGL_USUL` varchar(20) DEFAULT NULL,
  `WAKTU` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `TEMA` varchar(50) NOT NULL,
  `BIAYA` varchar(50) DEFAULT NULL,
  `NO_WR` varchar(50) DEFAULT NULL,
  `PENYELESAIAN` text,
  `LATAR_BELAKANG` text,
  `PERBAIKAN` text,
  `MANFAAT` text,
  `ALAT_BAHAN` varchar(50) DEFAULT NULL,
  `KOREKSI` text,
  `REJECT` text,
  `APPROVER` varchar(50) NOT NULL,
  `KOORDINATOR` varchar(50) NOT NULL,
  `FLAG` int(4) DEFAULT NULL,
  `STATUS` enum('a','r','j','p','d','c','b') NOT NULL DEFAULT 'p',
  `OPL` int(2) NOT NULL DEFAULT '0',
  `TGL_REJEK` varchar(24) NOT NULL,
  `LINE_PROSES` varchar(255) NOT NULL,
  `AREA_MESIN` varchar(255) NOT NULL,
  `JENIS_MESIN` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ira_data_improvement_pengusul`
--

CREATE TABLE `ira_data_improvement_pengusul` (
  `ID` int(11) NOT NULL,
  `NO_REGISTRASI` varchar(35) NOT NULL,
  `NIK_KARYAWAN` varchar(14) NOT NULL,
  `NAMA_KARYAWAN` varchar(50) NOT NULL,
  `ID_DEPT` int(11) DEFAULT NULL,
  `PID_FLAG` varchar(14) DEFAULT NULL,
  `POIN_REG` float DEFAULT NULL,
  `TAHUN` varchar(4) NOT NULL,
  `URUTAN` int(12) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ira_data_opl`
--

CREATE TABLE `ira_data_opl` (
  `id_opl` int(11) NOT NULL,
  `no_registrasi` varchar(30) NOT NULL,
  `waktu_opl` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `no_opl` varchar(30) NOT NULL,
  `nik_approver` varchar(20) DEFAULT NULL,
  `nik_koordinator` varchar(20) NOT NULL,
  `tgl_opl` varchar(15) DEFAULT NULL,
  `tema` varchar(20) DEFAULT NULL,
  `perbaikan` varchar(320) DEFAULT NULL,
  `image_before` varchar(200) DEFAULT NULL,
  `image_after` varchar(200) DEFAULT NULL,
  `bq` text,
  `bc` text,
  `bd` text,
  `bs` text,
  `bm` text,
  `be` text,
  `aq` text,
  `ac` text,
  `ad` text,
  `a_s` text,
  `am` text,
  `ae` text,
  `status` enum('p','a','r','c','d','b') NOT NULL DEFAULT 'p',
  `koreksi` text,
  `keterangan_before` text,
  `keterangan_after` text,
  `koreksi2` varchar(500) NOT NULL,
  `updated` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ira_data_opl_pengusul`
--

CREATE TABLE `ira_data_opl_pengusul` (
  `ID` int(11) NOT NULL,
  `no_registrasi` varchar(20) CHARACTER SET latin1 NOT NULL,
  `nik_pengusul` varchar(20) CHARACTER SET latin1 NOT NULL,
  `poin` float DEFAULT '0',
  `poin_ss` float DEFAULT '0',
  `tahun` year(4) NOT NULL,
  `urutan` int(12) NOT NULL,
  `change_man` int(11) NOT NULL DEFAULT '1',
  `id_opl` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `ira_mst_cg`
--

CREATE TABLE `ira_mst_cg` (
  `ID_CG` varchar(6) DEFAULT NULL,
  `ID_DEPT` int(4) DEFAULT NULL,
  `NAMA_CG` varchar(32) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ira_mst_cg`
--

INSERT INTO `ira_mst_cg` (`ID_CG`, `ID_DEPT`, `NAMA_CG`) VALUES
('CG01', 1, 'PLANNER'),
('CG02', 2, 'RISING STAR'),
('CG03', 3, 'MATRIX'),
('CG04', 3, 'AVATAR'),
('CG05', 4, 'HORENSO'),
('CG06', 4, 'GEMASD'),
('CG07', 4, 'HYBRID'),
('CG08', 4, 'U-VESPA'),
('CG09', 4, 'MACGYVER'),
('CG10', 4, 'SUPERBIN'),
('CG11', 4, 'METAMORPHOSIS'),
('CG12', 5, 'CEPOT WARRIORS'),
('CG13', 5, 'SAUBERPRO'),
('CG14', 6, 'RMPM'),
('CG15', 6, 'FINISH GOODS'),
('CG16', 7, 'BIMASAKTI'),
('CG17', 7, 'GANIMEDA'),
('CG18', 8, 'SALT'),
('CG19', 8, 'EFFERVESCENT'),
('CG20', 8, 'SHINNING'),
('CG21', 9, 'E-MAX'),
('CG22', 10, 'RESIGN');

-- --------------------------------------------------------

--
-- Table structure for table `ira_mst_dept`
--

CREATE TABLE `ira_mst_dept` (
  `ID_DEPT` int(4) UNSIGNED NOT NULL,
  `NAMA_DEPT` varchar(14) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ira_mst_dept`
--

INSERT INTO `ira_mst_dept` (`ID_DEPT`, `NAMA_DEPT`) VALUES
(1, 'MNF'),
(2, 'IOS'),
(3, 'FAIT'),
(4, 'PRD'),
(5, 'ENG'),
(6, 'WHS'),
(7, 'QA'),
(8, 'HRGA');

-- --------------------------------------------------------

--
-- Table structure for table `ira_mst_karyawan`
--

CREATE TABLE `ira_mst_karyawan` (
  `ID_KARYAWAN` int(5) NOT NULL,
  `NIK_KARYAWAN` varchar(17) DEFAULT NULL,
  `NAMA_KARYAWAN` varchar(50) DEFAULT NULL,
  `JABATAN` varchar(50) DEFAULT NULL,
  `ID_DEPT` varchar(4) DEFAULT NULL,
  `ID_SUBDEPT` varchar(10) DEFAULT NULL,
  `ID_CG` varchar(10) DEFAULT NULL,
  `ID_LEVEL` int(11) DEFAULT NULL,
  `FOTO` varchar(50) DEFAULT NULL,
  `TARGET_POIN_REG` double DEFAULT NULL,
  `TARGET_POIN_IMP` double DEFAULT NULL,
  `PASSWORD` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ira_mst_karyawan`
--

INSERT INTO `ira_mst_karyawan` (`ID_KARYAWAN`, `NIK_KARYAWAN`, `NAMA_KARYAWAN`, `JABATAN`, `ID_DEPT`, `ID_SUBDEPT`, `ID_CG`, `ID_LEVEL`, `FOTO`, `TARGET_POIN_REG`, `TARGET_POIN_IMP`, `PASSWORD`) VALUES
(1, 'K170800124', 'AAN NURYADI', 'Sachet D', '4', '7', 'CG06', 6, 'AAN NURYADI PRD.jpg', 26, 26, 'K170800124'),
(2, '180100016', 'ABDUL MUJIB MUSTOPA', 'Sachet D', '4', '7', 'CG06', 6, 'ABDUL MUJIB MUSTOPA PRD.jpg', 26, 26, '180100016'),
(3, 'K161200736', 'ABDUL MUNIF GHOZALI', 'Warehouse RM Minor Helper', '6', '12', 'CG14', 6, 'ABDUL MUNIF WH.jpg', 26, 26, 'K161200736'),
(4, 'K170722445', 'ABDULLOH', 'Eductor Helper', '4', '6', 'CG11', 6, 'ABDULLOH PRD.jpg', 26, 26, 'K170722445'),
(5, 'K180700231', 'ACHMAD FAIZAL', 'Warehouse RM Minor Helper', '6', '12', 'CG14', 6, 'ACHMAD FAIZAL WH.jpg', 26, 26, 'K180700231'),
(6, 'O161200707', 'ACHMAD RIZAL SAMIJAYA', 'Security', '8', '20', 'CG19', 6, 'ACHMAD RIZAL SAMIJAYA HR.jpg', 26, 26, 'O161200707'),
(7, 'K171200351', 'ADE KURNIAWAN', 'Warehouse RM Major Helper', '6', '12', 'CG14', 6, 'ADE KURNIAWAN WH.jpg', 26, 26, 'K171200351'),
(8, 'K170622417', 'ADE LESMANA', 'CANNING', '4', '7', 'CG05', 6, 'ADE LESMANA PRD.jpg', 26, 26, 'K170622417'),
(9, '130193003', 'ADE NANA SUMARNA', 'Bin Washing Operator', '4', '6', 'CG10', 6, 'ADE NANA SUMARNA PRD.jpg', 26, 26, '130193003'),
(10, '061200036', 'ADE SAPRUDIN', 'Processing Operator', '4', '6', 'CG09', 6, 'ADE SAPRUDIN PRD.jpg', 26, 26, '061200036'),
(11, 'K170400204', 'ADE SUTISNA', 'Warehouse PM Assistant', '6', '13', 'CG14', 6, 'ADE SUTISNA WH.jpg', 26, 26, 'K170400204'),
(12, '150791707', 'ADI AMRAN SUKARYA', 'Sachet Packing Operator', '4', '7', 'CG07', 6, 'ADI AMRAN SUKARYA PRD.jpg', 26, 26, '150791707'),
(13, 'K171100305', 'ADI HIDAYANSYAH', 'Bin Washing Helper', '4', '6', 'CG10', 6, 'ADI HIDAYANSYAH PRD.jpg', 26, 26, 'K171100305'),
(14, '160792707', 'ADI SOPANA', 'Eductor Operator', '4', '6', 'CG11', 6, 'ADI SOPANA PRD.jpg', 26, 26, '160792707'),
(15, 'O170500258', 'ADIYANTO BAHTIAR', 'Security', '8', '20', 'CG19', 6, 'ADIYANTO BACHTIAR HR.jpg', 26, 26, 'O170500258'),
(16, '130793036', 'ADNAN SAMSULEH', 'System Inspector', '2', '1', 'CG02', 6, 'ADNAN SAMSULEH IOS.jpg', 26, 26, '130793036'),
(17, '130793037', 'AEP SAEPUDIN', 'Eductor Operator', '4', '6', 'CG11', 6, 'AEP SAEPUDIN PRD.jpg', 26, 26, '130793037'),
(18, '061100030', 'AFRIAN CHANDRA IDRIS', 'Mechanic', '5', '10', 'CG12', 6, 'AFRIAN CANDRA IDRIS ENG.jpg', 26, 26, '061100030'),
(19, 'K171000218', 'AGI RISNANDI MULYANADANA PUTRA', 'Warehouse RM Major Helper', '6', '12', 'CG14', 6, 'AGI RISNANDI WH.jpg', 26, 26, 'K171000218'),
(20, 'K160900535', 'AGUNG SAPTORI', 'Sachet Packing Helper', '4', '7', 'CG07', 6, 'user_profiles.png', 26, 26, 'K160900535'),
(21, '130193004', 'AGUS AKBAR', 'Warehouse RM Major Forklift Operator', '6', '12', 'CG14', 6, 'AGUS AKBAR WH.jpg', 26, 26, '130193004'),
(22, '140792910', 'AGUS NUGROHO', 'CANNING', '4', '7', 'CG05', 6, 'AGUS NUGROHO PRD.jpg', 26, 26, '140792910'),
(23, '130193005', 'AGUS PRASETIYO', 'Utility-WWTP', '5', '11', 'CG13', 6, 'AGUS PRASETYO ENG.jpg', 26, 26, '130193005'),
(24, 'K180400146', 'AGUS RESTU MULYANA', 'QC In Line Field', '7', '17', 'CG16', 6, 'AGUS RESTU MULYANA QA.jpg', 26, 26, 'K180400146'),
(25, 'K180700235', 'AGUS WIDIYANTO', 'Bin Washing Helper', '4', '6', 'CG10', 6, 'AGUS WIDIYANTO PRD.jpg', 26, 26, 'K180700235'),
(26, 'K160900536', 'AHMAD NAHROWI', 'Sachet D', '4', '7', 'CG06', 6, 'user_profiles.png', 26, 26, 'K160900536'),
(27, 'K180700234', 'AHMAD NASIHUDIN', 'Sachet Packing Helper', '4', '6', 'CG11', 6, 'AHMAD NASIHUDIN PRD.jpg', 26, 26, 'K180700234'),
(28, 'K160900537', 'AHMAD NURSYEHU', 'Eductor Helper', '4', '6', 'CG11', 6, 'AHMAD NURSYEKHU PRD.jpg', 26, 26, 'K160900537'),
(29, '160192705', 'AHMAD SAEPUDIN', 'wwtp operator', '5', '11', 'CG13', 6, 'AHMAD SAEPUDIN ENG.jpg', 26, 26, '160192705'),
(30, '130793038', 'AJAT JAPAR', 'Sachet E', '4', '7', 'CG08', 6, 'AJAT JAPAR PRD.jpg', 26, 26, '130793038'),
(31, 'K170100048', 'AKHMAD NUR HIDAYAT', 'Sachet Packing Helper', '4', '7', 'CG05', 6, 'AKHMAD NUR HIDAYAT PRD.jpg', 26, 26, 'K170100048'),
(32, '180700143', 'AKHMAD YUNUS YULIANTO', 'Warehouse RM Major Helper', '6', '12', 'CG14', 6, 'AKHMAD YUNUS YULIANTO WH.jpg', 26, 26, '180700143'),
(33, 'K170800125', 'AKHMAD ZEIN FATHONI', 'Sachet Packing Helper', '4', '7', 'CG07', 6, 'AKHMAD ZEIN FATHONI PRD.jpg', 26, 26, 'K170800125'),
(34, 'K180800290', 'ALDI MAHENDRA SURYANA PUTRA', 'Sachet Packing Helper', '4', '7', 'CG07', 6, 'ALDI MAHENDRA SURYANA PUTRA PRD.jpg', 26, 26, 'K180800290'),
(35, 'K170900192', 'ALDI WIGIANA', 'QC In Line Field', '7', '17', 'CG16', 6, 'ALDI WIGIANA QA.JPG', 26, 26, 'K170900192'),
(36, '150291703', 'ALI NURDIN', 'Warehouse RM Minor Assistant', '6', '12', 'CG14', 6, 'ALI NURDIN WH.jpg', 26, 26, '150291703'),
(37, '130793039', 'ALI ROHMAN', 'Warehouse RM Major Preparator', '6', '12', 'CG14', 6, 'ALI ROHMAN WH.jpg', 26, 26, '130793039'),
(38, '130793040', 'AMRIH PANUNTUN', 'Sachet Packing Helper', '4', '7', 'CG07', 6, 'AMRIH PANUNTUN PRD.jpg', 26, 26, '130793040'),
(39, '130793041', 'ANDI KUSUMA', 'Blending Forklift Operator', '4', '7', 'CG08', 6, 'ANDI KUSUMA PRD.jpg', 26, 26, '130793041'),
(40, 'K160900538', 'ANDRIYANTO', 'Production Store Helper', '4', '6', 'CG10', 6, 'ANDRIYANTO PRD.jpg', 26, 26, 'K160900538'),
(41, '130793042', 'ANGGA CHRISTIAN YONATHAN', 'Warehouse PM Checker', '6', '13', 'CG14', 6, 'ANGGA CRISTHIAN YONATAN WH.jpg', 26, 26, '130793042'),
(42, 'K180200050', 'ANGGA SAEPUL HAJAN', 'Bin Washing Helper', '4', '6', 'CG11', 6, 'ANGGA SAEPUL HAJAN PRD.jpg', 26, 26, 'K180200050'),
(43, 'O171200113', 'ANJAR DWI ANTO', 'Cleaning Service', '8', '20', 'CG19', 6, 'ANJAR DWI ANTO HR.jpg', 26, 26, 'O171200113'),
(44, '130193006', 'APANDI', 'Compounding Operator', '4', '6', 'CG11', 6, 'APANDI PRD.jpg', 26, 26, '130193006'),
(45, '070200030', 'ARDIAN', 'Warehouse RM Minor Preparator', '6', '12', 'CG14', 6, 'ARDIAN WH.jpg', 26, 26, '070200030'),
(46, '120992525', 'ARDIKA FAUDIN', 'Sachet A', '4', '7', 'CG07', 6, 'ARDIKA FAUDIN PRD.jpg', 26, 26, '120992525'),
(47, '120192503', 'ARDISON', 'Bin Washing Forklift Operator', '4', '6', 'CG10', 6, 'ARDISON PRD.jpg', 26, 26, '120192503'),
(48, 'K180400147', 'ARI MUHAMAD MUKORIN', 'QC In Line Field', '7', '17', 'CG16', 6, 'ARI MUHAMAD MUKORIN QA.jpg', 26, 26, 'K180400147'),
(49, 'K170800128', 'ARIESTA GALUH SANJAYA', 'Sachet Packing Helper', '4', '7', 'CG07', 6, 'ARIESTA GALUH SANJAYA PRD.jpg', 26, 26, 'K170800128'),
(50, 'O171100093', 'ARIFIN', 'Cleaning Service', '8', '20', 'CG19', 6, 'ARIFIN HR.jpg', 26, 26, 'O171100093'),
(51, '170700031', 'ARIS SUPARLI', 'Sachet D', '4', '7', 'CG06', 6, 'ARIS SUPARLI PRD.jpg', 26, 26, '170700031'),
(52, '140792911', 'ARIYANTO', 'CANNING', '4', '7', 'CG05', 6, 'ARIYANTO PRD.jpg', 26, 26, '140792911'),
(53, '061200037', 'ASEP CAHYAN', 'A SACHET', '4', '7', 'CG07', 6, 'ASEP CAHYAN PRD.jpg', 26, 26, '061200037'),
(54, '070300033', 'ASEP HAEDAR', 'Evaporator Operator', '4', '6', 'CG09', 6, 'ASEP HAEDAR PRD.jpg', 26, 26, '070300033'),
(55, 'K170800126', 'ASEP IBRAHIM', 'Dumping Helper', '4', '7', 'CG08', 6, 'ASEP IBRAHIM PRD.jpg', 26, 26, 'K170800126'),
(56, '140792912', 'ASEP IRPAN', 'Sachet D', '4', '7', 'CG06', 6, 'ASEP IRPAN PRD.jpg', 26, 26, '140792912'),
(57, 'K170100033', 'ASEP JAMALUDIN', 'Sachet D', '4', '7', 'CG06', 6, 'ASEP JAMALUDIN PRD.jpg', 26, 26, 'K170100033'),
(58, 'O170100011', 'ASEP MUSDIONO', 'Komandan', '8', '20', 'CG19', 6, 'ASEP MUSDIONO HR.jpg', 26, 26, 'O170100011'),
(59, '130793043', 'ASEP ROBAN', 'Utility-WWTP', '5', '11', 'CG13', 6, 'ASEP ROBAN ENG.jpg', 26, 26, '130793043'),
(60, 'K161100677', 'ASKARUDIN AL AYUBI', 'Bin Washing Helper', '4', '6', 'CG10', 6, 'ASKARUDIN AL AYUBI PRD.jpg', 26, 26, 'K161100677'),
(61, '130193007', 'ASMI LASARI', 'Sachet Operator', '4', '7', 'CG07', 6, 'ASMI LASARI PRD.jpg', 26, 26, '130193007'),
(62, 'K161100678', 'BAGUS ABDUROHMAN', 'Sachet D', '4', '7', 'CG06', 6, 'BAGUS ABDUROHMAN PRD.jpg', 26, 26, 'K161100678'),
(63, '150291704', 'BAGUS SANTOSO', 'Warehouse RM Major Helper', '6', '12', 'CG14', 6, 'BAGUS SANTOSO WH.jpg', 26, 26, '150291704'),
(64, '140792913', 'BAHRUDIN', 'Mechanic', '5', '10', 'CG12', 6, 'BAHRUDIN ENG.jpg', 26, 26, '140792913'),
(65, '150800189', 'BAHRUDIN DWI NURYANTO', 'Electrical Technician', '5', '8', 'CG12', 6, 'BAHRUDIN DWI NURYANTO.jpg', 26, 26, '150800189'),
(66, '150791708', 'BAMBANG RISTYANTO', 'Bin Washing Operator', '4', '6', 'CG10', 6, 'BAMBANG RISTIANTO PRD.jpg', 26, 26, '150791708'),
(67, 'K170722446', 'BAYU GILLANG WIDYARTA', 'QC Inline Field', '7', '17', 'CG16', 6, 'BAYU GILANG WIDIYARTA QA.jpg', 26, 26, 'K170722446'),
(68, '120992526', 'BAYU SEPTO PRASETYO', 'Warehouse FG Checker', '6', '15', 'CG15', 6, 'BAYU SEPTO WH.jpg', 26, 26, '120992526'),
(69, '140792914', 'BENI SETIYAWAN', 'Sachet D', '4', '7', 'CG06', 6, 'BENI SETIYAWAN PRD.jpg', 26, 26, '140792914'),
(70, 'K170722447', 'BIMA DWI ATMAJA', 'Drier Continous Cleaner', '4', '6', 'CG09', 6, 'BIMA DWI ATMAJA PRD.jpg', 26, 26, 'K170722447'),
(71, '130393035', 'BOBBY FAHMI FARHANUDIN', 'QC In Line Analyst', '7', '17', 'CG16', 6, 'BOBBY FAHMI FARHANUDIN QA.jpg', 26, 26, '130393035'),
(72, '121092527', 'BUDI MAULANA NUGRAHA', 'Mechanic', '5', '10', 'CG12', 6, 'BUDI MAULANA NUGRAHA ENG.jpg', 26, 26, '121092527'),
(73, 'K170100012', 'CAHYADI', 'Driver', '8', '20', 'CG19', 6, 'CAHYADI HR.jpg', 26, 26, 'K170100012'),
(74, '100192703', 'CANDRA KURNIAWAN', 'Sachet E', '4', '7', 'CG06', 6, 'CANDRA KURNIAWAN PRD.jpg', 26, 26, '100192703'),
(75, 'O170622427', 'CARDI MAHODI', 'Security', '8', '20', 'CG19', 6, 'CARDI MAHODI HR.jpg', 26, 26, 'O170622427'),
(76, '140792915', 'CECEP SUPRIADI', 'Sachet E', '4', '7', 'CG06', 6, 'CECEP SUPRIADI PRD.jpg', 26, 26, '140792915'),
(77, 'K171000215', 'CEP DANI HAMDANI', 'Dumping Helper', '4', '7', 'CG08', 6, 'CEP DANI PRD.jpg', 26, 26, 'K171000215'),
(78, 'O180700058', 'CHOERUL ANWAR', 'Cleaning Service', '8', '20', 'CG19', 6, 'CHOERUL ANWAR HR.jpg', 26, 26, 'O180700058'),
(79, '130793044', 'DAIKIN PURNA YUDHA', 'X-Ray Operator', '4', '7', 'CG07', 6, 'DAIKIAN PURNA YUDHA PRD.jpg', 26, 26, '130793044'),
(80, 'O180600063', 'DANANG MAHENDRA', 'Cleaning Service', '8', '20', 'CG19', 6, 'DANANG MAHENDRA.jpg', 26, 26, 'O180600063'),
(81, '130193008', 'DANI PURWANEGARA', 'Warehouse RM Minor Preparator', '6', '12', 'CG14', 6, 'DANI PURWANEGARA WH.jpg', 26, 26, '130193008'),
(82, '180100019', 'DANIS SENO PRABOWO', 'Sachet Packing Helper', '4', '7', 'CG07', 6, 'DANIS SENO PRD.jpg', 26, 26, '180100019'),
(83, '130793045', 'DARMA ARDHI', 'Sachet E', '4', '7', 'CG06', 6, 'DARMA ARDHI PRD.jpg', 26, 26, '130793045'),
(84, '061100031', 'DARYONO', 'Evaporator Operator', '4', '6', 'CG09', 6, 'DARYONO PRD.jpg', 26, 26, '061100031'),
(85, 'K180800295', 'DEBBY INDRA SISWADI', 'Sachet Packing Helper', '4', '7', 'CG07', 6, 'DEBBY INDRA SISWADI PRD.jpg', 26, 26, 'K180800295'),
(86, 'K170400206', 'DEDE DARPIANSYAH', 'Eductor Helper', '4', '6', 'CG11', 6, 'DEDE DARPIANSYAH PRD.jpg', 26, 26, 'K170400206'),
(87, 'K180100012', 'DEDE IMAM ALI DASTIN', 'Sachet E', '4', '7', 'CG06', 6, 'DEDE IMAM ALI DASTIN PRD.jpg', 26, 26, 'K180100012'),
(88, 'K180300122', 'DEDE IRWANTO', 'Sachet Packing Helper', '4', '7', 'CG07', 6, 'DEDE IRWANTO PRD.jpg', 26, 26, 'K180300122'),
(89, '121192530', 'DEDE KUSNANDAR', 'A SACHET', '4', '7', 'CG07', 6, 'DEDE KUSNANDAR PRD.jpg', 26, 26, '121192530'),
(90, 'K180600206', 'DEDEN JAELANI', 'Warehouse RM Major Helper', '6', '12', 'CG14', 6, 'DEDEN JAELANI WH.jpg', 26, 26, 'K180600206'),
(91, '130193009', 'DEDEN SETIA JAYA SOMANTRI', 'Bin Filling Forklift Operator', '4', '6', 'CG09', 6, 'DEDEN SETIA JAYA S PRD.jpg', 26, 26, '130193009'),
(92, 'K171200348', 'DEDI SUPRIYADI', 'Sachet E', '4', '7', 'CG06', 6, 'DEDI SUPRIYADI PRD.jpg', 26, 26, 'K171200348'),
(93, 'O170722448', 'DEDY VANTOS', 'Security', '8', '20', 'CG19', 6, 'DEDY VANTOS HR.jpg', 26, 26, 'O170722448'),
(94, 'K160900541', 'DENI DAMARA', 'Eductor Helper', '4', '6', 'CG11', 6, 'DENI DAMARA PRD.jpg', 26, 26, 'K160900541'),
(95, 'K180900332', 'DENI HIMAWAN SUTANTO', 'Warehouse RM Major Helper', '6', '12', 'CG14', 6, 'DENI HIMAWAN SUTANTO WH.jpg', 26, 26, 'K180900332'),
(96, '120292512', 'DENY SUPRAPTO', 'QC Incoming Analyst', '7', '17', 'CG16', 6, 'DENY SUPRAPTO QA.JPG', 26, 26, '120292512'),
(97, '180100014', 'DERI INDRIANI', 'Finance & Accounting Administration', '3', '5', 'CG04', 6, 'DERI INDRIANI FA.jpg', 26, 26, '180100014'),
(98, 'O170900010', 'DERRY RUDIANTO', 'Cleaning Service', '8', '20', 'CG19', 6, 'DERRY RUDIANTO HR.jpg', 26, 26, 'O170900010'),
(99, '130193010', 'DEVI SAFITRI SUNDARI', 'Sachet D', '4', '7', 'CG06', 6, 'DEVI SAFITRI PRD.jpg', 26, 26, '130193010'),
(100, '120292513', 'DIAN SANJAYA', 'Sachet E', '4', '7', 'CG08', 6, 'DIAN SANJAYA PRD.jpg', 26, 26, '120292513'),
(101, 'K160900543', 'DIANTO', 'Can Packing Helper', '4', '7', 'CG07', 6, 'DIANTO PRD.jpg', 26, 26, 'K160900543'),
(102, '130193011', 'DIDI SUPRIADI', 'Compounding Operator', '4', '6', 'CG11', 6, 'DIDI SUPRIADI PRD.jpg', 26, 26, '130193011'),
(103, '130793046', 'DIDIK PURWANTO', 'Dumping Forklift Operator', '4', '7', 'CG08', 6, 'DIDIK PURWANTO PRD.jpg', 26, 26, '130793046'),
(104, 'K180800296', 'DIKA LESMANA', 'Warehouse PM Assistant', '6', '13', 'CG14', 6, 'DIKA LESMANA WH.jpg', 26, 26, 'K180800296'),
(105, 'K171100325', 'DIKI RENALDI', 'QC In Line Field', '7', '17', 'CG16', 6, 'DIKI RENALDI QA.jpg', 26, 26, 'K171100325'),
(106, '121092528', 'DODI ISKANDAR', 'QC Microbiology Analyst', '7', '16', 'CG17', 6, 'DODI ISKANDAR QA.jpg', 26, 26, '121092528'),
(107, '130193012', 'DWIKI ARIA DARMAWAN', 'Sachet D', '4', '7', 'CG06', 6, 'DWIKI ARYA DARMAWAN PRD.jpg', 26, 26, '130193012'),
(108, '180100018', 'EDI SAPUTRA', 'Sachet E', '4', '7', 'CG06', 6, 'EDI SAPUTRA PRD.jpg', 26, 26, '180100018'),
(109, 'O170100051', 'EDI SUTARDI', 'Security', '8', '20', 'CG19', 6, 'EDI SUTARDI HR.jpg', 26, 26, 'O170100051'),
(110, 'O171100092', 'EKA AMSORI', 'Cleaning Service', '8', '20', 'CG19', 6, 'EKA AMSORI HR.jpg', 26, 26, 'O171100092'),
(111, '120192504', 'EKO ARIES SANTOSO', 'Store Room', '5', '9', 'CG12', 6, 'EKO ARIES SANTOSO ENG.jpg', 26, 26, '120192504'),
(112, '070100007', 'EKO WAHYUDI', 'Mechanic', '5', '10', 'CG12', 6, 'EKO WAHYUDI ENG ok.jpg', 26, 26, '070100007'),
(113, '130193013', 'ERFAN KIMA BAHTERA', 'Utility-WWTP', '5', '11', 'CG13', 6, 'ERFAN KIMA BAHTERA ENG.jpg', 26, 26, '130193013'),
(114, '130193014', 'ERIS MOCHAMAD FIRDAUS', 'QC Incoming Analyst', '7', '17', 'CG16', 6, 'ERIS MOCHAMAD FIRDAUS QA.jpg', 26, 26, '130193014'),
(115, '180500114', 'EUIS DIAN ANGGRAENI', 'QC Inline Field', '7', '17', 'CG16', 6, 'EUIS.jpg', 26, 26, '180500114'),
(116, 'K170800121', 'FAHRUL ROZAB', 'Mechanical Technician', '5', '10', 'CG12', 6, 'FAHRUL ROZAB ENG.jpg', 26, 26, 'K170800121'),
(117, '170122440', 'FAJAR MAULANA', 'Warehouse RM Minor Helper', '6', '12', 'CG14', 6, 'FAJAR MAULANA WH.jpg', 26, 26, '170122440'),
(118, '180100022', 'FATONI', 'Warehouse RM Major Helper', '6', '12', 'CG14', 6, 'FATONI WH.jpg', 26, 26, '180100022'),
(119, 'K180800291', 'FEBRI ADI PUTRA', 'Sachet Packing Helper', '4', '7', 'CG07', 6, 'FEBRI ADI PUTRA PRD.jpg', 26, 26, 'K180800291'),
(120, 'K170200112', 'FEBRI HARTOYO', 'Warehouse RM Minor Helper', '6', '12', 'CG14', 6, 'FEBRI HARTOYO WH.jpg', 26, 26, 'K170200112'),
(121, '130193016', 'FEBRIANGGONO DANNY SETIYADI', 'Sachet A', '4', '7', 'CG07', 6, 'FEBRIANGGONO DANY SETIADI PRD.jpg', 26, 26, '130193016'),
(122, 'K171000273', 'FITRI DEWI WIJAYANTI', 'TPM Admin', '2', '1', 'CG02', 6, 'user_profiles.png', 26, 26, 'K171000273'),
(123, 'O180600052', 'FITRI SURTINAWATI', 'Security', '8', '20', 'CG19', 6, 'user_profiles.png', 26, 26, 'O180600052'),
(124, 'K180800292', 'FRANDY MAULANA HIDAYAT', 'Sachet Packing Helper', '4', '7', 'CG07', 6, 'FRANDY MAULANA HIDAYAT PRD.jpg', 26, 26, 'K180800292'),
(125, 'O171000083', 'FRANSISCO SURYATNO', 'Security', '8', '20', 'CG19', 6, 'FRANSISCO SURYATNO HR.jpg', 26, 26, 'O171000083'),
(126, '160600339', 'GALIH PANGESTU', 'Mechanic forklift', '5', '10', 'CG12', 6, 'GALIH PANGESTU ENG.jpg', 26, 26, '160600339'),
(127, 'K171000266', 'GINANJAR PAMUNGKAS', 'Warehouse RM Minor Helper', '6', '12', 'CG14', 6, 'GINANJAR PAMUNGKAS WH.jpg', 26, 26, 'K171000266'),
(128, 'K170900193', 'GUGUM GUMILAR', 'Sachet E', '4', '7', 'CG06', 6, 'GUGUM GUMILAR PRD.jpg', 26, 26, 'K170900193'),
(129, '121192531', 'GUMILAR INDRA FEBRIANSYAH', 'Dumping Operator', '4', '7', 'CG08', 6, 'GUMILAR INDRA PRD.jpg', 26, 26, '121192531'),
(130, 'K180700246', 'HAFIS FAISAL KURNIAWAN', 'Warehouse RM Minor Helper', '6', '12', 'CG14', 6, 'HAFIS FAISAL KURNIAWAN WH.jpg', 26, 26, 'K180700246'),
(131, '150791709', 'HAPPY SUGESTIE PRAHARA', 'Admin HRGA', '8', '20', 'CG19', 6, 'HAPPY SUGESTIE PRAHARA HR.jpg', 26, 26, '150791709'),
(132, 'O170722449', 'HENDI', 'Cleaning Service', '8', '20', 'CG19', 6, 'HENDI HR.jpg', 26, 26, 'O170722449'),
(133, '150291705', 'HERI HENDRIANA', 'Warehouse FG Forklift Operator', '6', '15', 'CG15', 6, 'HERI HENDRIANA WH.jpg', 26, 26, '150291705'),
(134, '130793047', 'HERI KURNIAWAN', 'Sachet A', '4', '7', 'CG07', 6, 'HERI KURNIAWAN PRD.jpg', 26, 26, '130793047'),
(135, '130793048', 'HERIYANA', 'QC Microbiology Analyst', '7', '16', 'CG17', 6, 'HERIYANA QA.jpg', 26, 26, '130793048'),
(136, 'O180700062', 'HERLIES PRIYANTO', 'Security', '8', '20', 'CG19', 6, 'user_profiles.png', 26, 26, 'O180700062'),
(137, '180100020', 'HERMAN RESTU FAUZI', 'Dumping Helper', '4', '7', 'CG07', 6, 'HERMAN RESTU FAUZI PRD.jpg', 26, 26, '180100020'),
(138, '120292514', 'HERMAWAN', 'CIP Operator', '4', '6', 'CG09', 6, 'HERMAWAN PRD.jpg', 26, 26, '120292514'),
(139, '130193018', 'HERU AHMAD SAPRUDIN', 'Sachet D', '4', '7', 'CG06', 6, 'HERU AHMAD SAPRUDIN PRD.jpg', 26, 26, '130193018'),
(140, '170700032', 'HERU HAERUDIN', 'Sachet D', '4', '7', 'CG06', 6, 'HERU HAERUDIN PRD.jpg', 26, 26, '170700032'),
(141, '130793049', 'IKMAL MAULANA', 'Utility-WWTP', '5', '11', 'CG13', 6, 'IKMAL MAULANA ENG.jpg', 26, 26, '130793049'),
(142, 'K180900333', 'ILHAM COKRO BASKORO', 'Warehouse RM Minor Helper', '6', '12', 'CG14', 6, 'ILHAM COKRO BASKORO WH.jpg', 26, 26, 'K180900333'),
(143, 'O171100100', 'ILHAM GULTOM', 'Cleaning Service', '8', '20', 'CG19', 6, 'ILHAM GULTOM HR.jpg', 26, 26, 'O171100100'),
(144, 'K170200100', 'ILHAM JONENDA LAKSANA', 'Sachet D', '4', '7', 'CG06', 6, 'ILHAM JOENDA LAKSANA PRD.jpg', 26, 26, 'K170200100'),
(145, '160792709', 'ILHAM YOBI', 'Purchasing Administration', '8', '21', 'CG20', 6, 'ILHAM YOBI HR.jpg', 26, 26, '160792709'),
(146, 'K170900188', 'IMAM MUNTASYIR HUDA', 'Sachet D', '4', '7', 'CG06', 6, 'IMAM MUNTASYIR HUDA PRD.jpg', 26, 26, 'K170900188'),
(147, 'K171200347', 'IMAM ROKHANI', 'CANNING', '4', '7', 'CG05', 6, 'IMAM ROKHANI PRD.jpg', 26, 26, 'K171200347'),
(148, 'K161100679', 'IMAM SYAFEI', 'Blending Helper', '4', '7', 'CG08', 6, 'IMAM SYAFEI PRD.jpg', 26, 26, 'K161100679'),
(149, 'K170500242', 'INDRI RAHAYU', 'Personel Administration', '8', '19', 'CG18', 6, 'INDRI RAHAYU HR.jpg', 26, 26, 'K170500242'),
(150, '130900125', 'INSANI GUSTRIANJAR MUHAROM', 'Electrical Technician', '5', '8', 'CG12', 6, 'INSANI GUSTRIANJAR MUHAROM ENG.jpg', 26, 26, '130900125'),
(151, 'K150900225', 'IQBAL MIFTAHUL BAROKAH', 'Eductor Helper', '4', '6', 'CG11', 6, 'IQBAL MIFTAHUL BAROKAH PRD.jpg', 26, 26, 'K150900225'),
(152, 'K171000216', 'IQBAL NUGRAHA', 'Sachet Packing Helper', '4', '7', 'CG07', 6, 'IQBAL NUGRAHA PRD.jpg', 26, 26, 'K171000216'),
(153, '130793050', 'IRFAN HIMAWAN', 'QC In Line Analyst', '7', '17', 'CG16', 6, 'IRFAN HIMAWAN QA.jpg', 26, 26, '130793050'),
(154, '140792916', 'IRPAN HIDAYAT PAMIL', 'Sachet D', '4', '7', 'CG06', 6, 'IRFAN HIDAYAT PAMIL PRD.jpg', 26, 26, '140792916'),
(155, 'O171000084', 'ITA SUSILAWATI', 'Cleaning Service', '8', '20', 'CG19', 6, 'ITA SUSILAWATI HR.jpg', 26, 26, 'O171000084'),
(156, '140792917', 'IWAN PERMANA', 'QC Microbiology Analyst', '7', '16', 'CG17', 6, 'IWAN PERMANA QA.jpg', 26, 26, '140792917'),
(157, 'O180400022', 'JAELANI ABDUL KODIR', 'Security', '8', '20', 'CG19', 6, 'JAELANI ABDUL KODIR HR.jpg', 26, 26, 'O180400022'),
(158, '120192505', 'JAJANG ABDUL ROHMAN', 'Drier Continous Cleaner', '4', '6', 'CG09', 6, 'JAJANG ABDUL ROHMAN PRD.jpg', 26, 26, '120192505'),
(159, '130193019', 'JAKARIA (CK)', 'Processing Operator', '4', '6', 'CG09', 6, 'JAKARIA CK PRD.jpg', 26, 26, '130193019'),
(160, '130793051', 'JOHAN KERTIONO', 'CANNING', '4', '7', 'CG05', 6, 'JOHAN KERTIONO PRD.jpg', 26, 26, '130793051'),
(161, 'K161000595', 'JOJO SUNARJO', 'Warehouse RM Minor Helper', '6', '12', 'CG14', 6, 'user_profiles.png', 26, 26, 'K161000595'),
(162, '130793055', 'JUJUN SIROJUDIN', 'Bin Filling Forklift Operator', '4', '6', 'CG09', 6, 'JUJUN SIROJUDIN PRD.jpg', 26, 26, '130793055'),
(163, 'K170622420', 'KAMIL YAHYA', 'QC Inline Field', '7', '17', 'CG16', 6, 'KAMIL YAHYA  QA.jpg', 26, 26, 'K170622420'),
(164, '130193020', 'KANDA', 'Warehouse RM Major Forklift Operator', '6', '12', 'CG14', 6, 'KANDA WH.jpg', 26, 26, '130193020'),
(165, '121192532', 'KARNAEN', 'Sachet D', '4', '7', 'CG06', 6, 'KARNAEN PRD.jpg', 26, 26, '121192532'),
(166, '120892522', 'KARYA SETIAWAN', 'Bin Washing Operator', '4', '6', 'CG10', 6, 'KARYA SETIAWAN PRD.jpg', 26, 26, '120892522'),
(167, 'K170200113', 'KHAERUL IMAM', 'Warehouse FG Helper', '6', '15', 'CG15', 6, 'KHOERUL IMAM WH.jpg', 26, 26, 'K170200113'),
(168, 'K180300124', 'KUKUH GUMILANG', 'Store Keeper', '5', '9', 'CG12', 6, 'KUKUH GUMILANG ENG ok.jpg', 26, 26, 'K180300124'),
(169, '130193021', 'KUSNADI', 'Warehouse FG Forklift Operator', '6', '15', 'CG15', 6, 'KUSNADI WH.jpg', 26, 26, '130193021'),
(170, 'O180700061', 'LEMAN', 'Security', '8', '20', 'CG19', 6, 'LEMAN HR.jpg', 26, 26, 'O180700061'),
(171, 'O180500043', 'LILIS SUMARNI', 'Cleaning Service', '8', '20', 'CG19', 6, 'LILIS SUMARNI HR.jpg', 26, 26, 'O180500043'),
(172, '130193022', 'MADA', 'Sachet E', '4', '7', 'CG06', 6, 'MADA PRD.jpg', 26, 26, '130193022'),
(173, '110891212', 'MARKUS', 'Fat Operator', '4', '6', 'CG11', 6, 'MARKUS PRD.jpg', 26, 26, '110891212'),
(174, 'K180800297', 'MARWAN ABDUL ANWAR', 'Sachet Packing Helper', '4', '7', 'CG07', 6, 'MARWAN ABDUL ANWAR PRD.jpg', 26, 26, 'K180800297'),
(175, '110191207', 'MAULANA ABDUL SALIM', 'Blending Forklift Operator', '4', '7', 'CG08', 6, 'MAULANA ABDUL SALIM PRD.jpg', 26, 26, '110191207'),
(176, '171122509', 'MOCHAMAD FADDLY ADI', 'Bin Washing Operator', '4', '6', 'CG10', 6, 'MOEHAMAD FADDLY ADI PRD.jpg', 26, 26, '171122509'),
(177, '150191702', 'MOEHAMMAD FADJAR FADILLAH', 'ELECTRICAL', '5', '8', 'CG12', 6, 'MOEHAMMAD FADJAR FADILLAH ENG.jpg', 26, 26, '150191702'),
(178, '130793052', 'MOHAMMAD DWI ADHITYA', 'Warehouse RM Minor Preparator', '6', '12', 'CG14', 6, 'MUHAMAD DWI ADITYA WH.jpg', 26, 26, '130793052'),
(179, '140792918', 'MOKHAMMAD MUSLIH', 'A SACHET', '4', '7', 'CG07', 6, 'user_profiles.png', 26, 26, '140792918'),
(180, 'K170800129', 'MUFTIAR', 'Warehouse RM Minor Helper', '6', '12', 'CG14', 6, 'MUFTIAR WH.jpg', 26, 26, 'K170800129'),
(181, '180500116', 'MUHAMAD ALFIAN', 'Blending Operator', '4', '7', 'CG08', 6, 'MUHAMAD ALFIAN PRD.jpg', 26, 26, '180500116'),
(182, '160200110', 'MUHAMAD BAGUS FAISAL', 'Application & Development Support', '3', '4', 'CG03', 6, 'MUHAMAD BAGUS FAISAL IT.jpg', 26, 26, '160200110'),
(183, 'K171000217', 'MUHAMAD BASIR', 'Eductor Helper', '4', '6', 'CG11', 6, 'MUHAMAD BASIR PRD.jpg', 26, 26, 'K171000217'),
(184, 'K180800298', 'MUHAMAD MISBAH', 'QC In Line Field', '7', '17', 'CG16', 6, 'MUHAMAD MISBAH QA.jpg', 26, 26, 'K180800298'),
(185, 'K170800130', 'MUHAMAD NANDAR NUGRAHA', 'Bin Washing Helper', '4', '6', 'CG10', 6, 'MUHAMAD NANDAR PRD.jpg', 26, 26, 'K170800130'),
(186, 'K180200064', 'MUHAMAD RIDWAN', 'Warehouse RM Major Helper', '6', '12', 'CG14', 6, 'MUHAMAD RIDWAN WH.jpg', 26, 26, 'K180200064'),
(187, 'K170900189', 'MUHAMAD RISNANDAR NAWAWI', 'Sachet Packing Helper', '4', '7', 'CG07', 6, 'MUHAMAD RISNANDAR PRD.jpg', 26, 26, 'K170900189'),
(188, 'K180800293', 'MUHAMMAD AINUR ROFIQ', 'Sachet Packing Helper', '4', '7', 'CG07', 6, 'MUHAMMAD A\'INUR ROFIQ PRD.jpg', 26, 26, 'K180800293'),
(189, 'K170500257', 'MUHAMMAD HAMDANI', 'HVAC Helper', '5', '8', 'CG12', 6, 'MUHAMMAD HAMDANI ENG.jpg', 26, 26, 'K170500257'),
(190, '170122441', 'MUHAMMAD IQBAL FAUZY', 'Utility Operator', '5', '11', 'CG13', 6, 'MUHAMMAD IQBAL FAUZY ENG.jpg', 26, 26, '170122441'),
(191, 'O151000278', 'MUHAMMAD SANUSI', 'Security', '8', '20', 'CG19', 6, 'MUHAMMAD SANUSI HR.jpg', 26, 26, 'O151000278'),
(192, '121192533', 'MUHAMMAD SHANDI SUMANTRI', 'Sachet D', '4', '7', 'CG06', 6, 'MUHAMMAD SHANDI SUMANTRI PRD.jpg', 26, 26, '121192533'),
(193, '130193023', 'MUHAMMAD SYAIFUL ANWAR', 'Bin Filling Operator', '4', '6', 'CG09', 6, 'MUHAMAD SYAIFUL ANWAR PRD.jpg', 26, 26, '130193023'),
(194, '120892523', 'MUKTI WIBOWO', 'Warehouse Administration', '6', '12', 'CG14', 6, 'MUKTI WIBOWO WH.jpg', 26, 26, '120892523'),
(195, 'O170800008', 'MULYANA', 'Cleaning Service', '8', '20', 'CG19', 6, 'MULYANA HR.jpg', 26, 26, 'O170800008'),
(196, 'K171000220', 'MUSTAGHBIRIN', 'Warehouse RM Major Helper', '6', '12', 'CG14', 6, 'MUSTAGHBIRIN WH.jpg', 26, 26, 'K171000220'),
(197, 'K170900199', 'NANDI SUNARDI', 'Warehouse FG Assistant', '6', '15', 'CG15', 6, 'NANDI SUNARDI WH.jpg', 26, 26, 'K170900199'),
(198, 'O160700381', 'NANI', 'Cleaning Service', '8', '20', 'CG19', 6, 'NANI HR.jpg', 26, 26, 'O160700381'),
(199, 'K180700223', 'NATALIA SUMANTO SIHOMBING', 'Receptionist', '8', '20', 'CG19', 6, 'NATALIA SUMANTO SIHOMBING HR.jpg', 26, 26, 'K180700223'),
(200, 'K171100314', 'NUKMANUL ANWAR', 'Warehouse FG Asisstant', '6', '15', 'CG15', 6, 'NUKMANUL ANWAR WH.jpg', 26, 26, 'K171100314'),
(202, 'K170900208', 'NUR AHMAD BUKHORI AINUL YAQIN AL FAIZ', 'Warehouse RM Minor Assistant', '6', '12', 'CG14', 6, 'NUR AHMAD BUKHORI AINUL YAQIN WH.jpg', 26, 26, 'K170900208'),
(203, '130193024', 'NUR FAJRI', 'Compounding Operator', '4', '6', 'CG11', 6, 'NUR FAJRI PRD.jpg', 26, 26, '130193024'),
(204, 'K171200352', 'NURHAMAD', 'Warehouse FG Helper', '6', '15', 'CG15', 6, 'NURHAMAD WH.jpg', 26, 26, 'K171200352'),
(205, '120192506', 'NURJANAH', 'D SACHET', '4', '7', 'CG07', 6, 'NURJANAH PRD.JPG', 26, 26, '120192506'),
(206, 'K170800131', 'NURZAMAN', 'Mechanic Helper', '5', '10', 'CG12', 6, 'NURZAMAN ENG.jpg', 26, 26, 'K170800131'),
(207, 'O171200114', 'OHAN', 'Security', '8', '20', 'CG19', 6, 'OHAN HR.jpg', 26, 26, 'O171200114'),
(208, '121192534', 'ONDI NUGROHO', 'QC Microbiology Analyst', '7', '16', 'CG17', 6, 'ONDI NUGROHO QA.jpg', 26, 26, '121192534'),
(209, '141092924', 'PANDU WIJAYADI', 'Mechanical Technician', '5', '10', 'CG12', 6, 'PANDU WIJAYADI ENG.jpg', 26, 26, '141092924'),
(210, '170700033', 'PEBI', 'Sachet Packing Helper', '4', '7', 'CG07', 6, 'PEBI PRD.jpg', 26, 26, '170700033'),
(211, '130793057', 'PINGKAN ASRI KURNIAWATI', 'Document Controller', '2', '1', 'CG02', 6, 'PINGKAN ASRI KURNIAWATI IOS.jpg', 26, 26, '130793057'),
(212, '130193025', 'PRIYANTO', 'Utility-WWTP', '5', '11', 'CG13', 6, 'PRIYANTO ENG.jpg', 26, 26, '130193025'),
(213, '070100015', 'RADEN ABBAS FAUZI', 'A SACHET', '4', '7', 'CG07', 6, 'RADEN ABBAS FAUZI PRD.jpg', 26, 26, '070100015'),
(214, 'K170100056', 'RAFI AMALI', 'Sachet A', '4', '7', 'CG07', 6, 'RAFI AMALI PRD.jpg', 26, 26, 'K170100056'),
(215, '070200029', 'RAHMAT NURHIDAYAT', 'CIP Operator', '4', '6', 'CG09', 6, 'RAHMAT NURHIDAYAT PRD.jpg', 26, 26, '070200029'),
(216, 'K170500277', 'RENALDI MUHAMAD FIRDAUS', 'Helper', '6', '12', 'CG14', 6, 'RENALDI M. FIRDAUS WH.jpg', 26, 26, 'K170500277'),
(217, 'K170622425', 'RENDI SUHADI', 'Sachet A', '4', '7', 'CG07', 6, 'RENDI SUHADI PRD.jpg', 26, 26, 'K170622425'),
(218, 'K170622423', 'REZA EKO PRASETYO', 'Dumping Helper', '4', '7', 'CG08', 6, 'REZA EKO PRASETYO PRD.jpg', 26, 26, 'K170622423'),
(219, 'K170622429', 'RIAN MAULANA', 'Warehouse PM Assistant', '6', '13', 'CG14', 6, 'RIAN MAULANA WH.jpg', 26, 26, 'K170622429'),
(220, 'K170300148', 'RIAN PERMANA SIDIK', 'Warehouse PM Assistant', '6', '13', 'CG14', 6, 'RIAN PERMANA SIDIK WH.jpg', 26, 26, 'K170300148'),
(221, '180700139', 'RICHO PRIO PRAYOGO', 'QC Microbiology Analyst', '7', '16', 'CG17', 6, 'RICHO PRIO PRAYOGO QA.jpg', 26, 26, '180700139'),
(222, 'K161200738', 'RICKY KHAMBALI', 'CANNING', '4', '7', 'CG05', 6, 'RICKY KHAMBALI PRD.jpg', 26, 26, 'K161200738'),
(223, '130193026', 'RIDWAN', 'Drier Circle Admin', '4', '6', 'CG09', 6, 'RIDWAN PRD.jpg', 26, 26, '130193026'),
(224, '180500115', 'RIDWAN NUGRAHA', 'QA Admin', '7', '16', 'CG17', 6, 'RIDWAN NUGRAHA QA.jpg', 26, 26, '180500115'),
(225, '121192541', 'RIESTA SHASYA FAUZIAH', 'QC In Line Analyst', '7', '17', 'CG16', 6, 'RIESTA SHASHA FAUZIYAH QA.JPG', 26, 26, '121192541'),
(226, '180100015', 'RIO ANGGARA', 'Dumping Operator', '4', '7', 'CG08', 6, 'RIO ANGGARA PRD.jpg', 26, 26, '180100015'),
(227, '150791710', 'RIRIS PURWANTO', 'Drier Roving Operator', '4', '6', 'CG10', 6, 'RIRIS PURWANTO PRD.jpg', 26, 26, '150791710'),
(228, '121192535', 'RISNAWATI', 'Sachet D', '4', '7', 'CG06', 6, 'RISNAWATI PRD.jpg', 26, 26, '121192535'),
(229, 'K171000221', 'RIYAN MAULANA YUSUF', 'Warehouse RM Major Helper', '6', '12', 'CG14', 6, 'RIYAN MAULANA YUSUF WH.jpg', 26, 26, 'K171000221'),
(230, 'K170800127', 'RIZKY DWI APRIYANTO', 'Blending Helper', '4', '7', 'CG08', 6, 'RIZKY DWI APRIYANTO PRD.jpg', 26, 26, 'K170800127'),
(231, 'K180700232', 'ROY FEBRIAN', 'Warehouse RM Minor Helper', '6', '12', 'CG14', 6, 'ROY FEBRIAN WH.jpg', 26, 26, 'K180700232'),
(232, 'K170622426', 'RUDI HARDIANSAH', 'Sachet E', '4', '7', 'CG06', 6, 'RUDI HARDIANSYAH PRD.jpg', 26, 26, 'K170622426'),
(233, '121192536', 'RUDI RAHMAN', 'Sachet D', '4', '7', 'CG06', 6, 'RUDI RAHMAN PRD.jpg', 26, 26, '121192536'),
(234, '180100012', 'RUDI ROSIDIN', 'Forklift Maintenance Helper', '5', '10', 'CG12', 6, 'RUDI ROSIDIN ENG.jpg', 26, 26, '180100012'),
(235, '130193027', 'RUDI SETIAWAN', 'BLENDING', '4', '7', 'CG08', 6, 'RUDI SETIAWAN PRD.jpg', 26, 26, '130193027'),
(236, 'K170722450', 'SAEFUDDIN', 'Dumping Helper', '4', '7', 'CG08', 6, 'SAEFUDDIN PRD.jpg', 26, 26, 'K170722450'),
(237, '120192507', 'SAEPUDIN', 'Dumping Forklift Operator', '4', '7', 'CG08', 6, 'SAEPUDIN PRD.jpg', 26, 26, '120192507'),
(238, 'K180700233', 'SAEPUL RIFAI', 'Sachet Packing Helper', '4', '6', 'CG11', 6, 'SAEFUL RIFAI PRD.jpg', 26, 26, 'K180700233'),
(239, '100192705', 'SAEPULLAH', 'CIP Operator', '4', '6', 'CG09', 6, 'SAEPULLAH PRD.jpg', 26, 26, '100192705'),
(240, 'O170900015', 'SAIDIN IMRON WIJAYA', 'Cleaning Service', '8', '20', 'CG19', 6, 'SAIDIN IMRON WIJAYA HR.jpg', 26, 26, 'O170900015'),
(241, '170122442', 'SAIFUL BAHRI', 'Warehouse PM Assistant', '6', '13', 'CG14', 6, 'SAIFUL BAHRI WH.jpg', 26, 26, '170122442'),
(242, '130793053', 'SAMROJI', 'Eductor Operator', '4', '6', 'CG11', 6, 'SAMROJI PRD.jpg', 26, 26, '130793053'),
(243, '130193028', 'SAMSIANTO', 'Utility-WWTP', '5', '11', 'CG13', 6, 'SAMSIANTO ENG.jpg', 26, 26, '130193028'),
(244, 'O160600377', 'SAMSUDIN', 'Security', '8', '20', 'CG19', 6, 'SAMSUDIN HR.jpg', 26, 26, 'O160600377'),
(245, '180100017', 'SANIP KOMARUDIN', 'CANNING', '4', '7', 'CG05', 6, 'SANIP KOMARUDIN PRD.JPG', 26, 26, '180100017'),
(246, '180700142', 'SANITA', 'Bin Washing Helper', '4', '6', 'CG10', 6, 'SANITA PRD.jpg', 26, 26, '180700142'),
(247, '130793058', 'SANNI SUTIADI', 'Tipping Forklift Operator', '4', '7', 'CG07', 6, 'SANNI SUTADI PRD.jpg', 26, 26, '130793058'),
(248, 'K161100682', 'SEPTIAN MAULANA', 'Blending Helper', '4', '7', 'CG08', 6, 'SEPTIAN MAULANA PRD.jpg', 26, 26, 'K161100682'),
(249, 'K180800294', 'SEPTRIAN EKO WINARTO', 'Sachet Packing Helper', '4', '7', 'CG07', 6, 'SEPTRIAN EKO WINARTO PRD.jpg', 26, 26, 'K180800294'),
(250, 'O170622430', 'SETIA MAULANA', 'Cleaning Service', '8', '20', 'CG19', 6, 'SETIA MULYANA HR.jpg', 26, 26, 'O170622430'),
(251, '130193029', 'SHANDY ASMARA', 'Bin Filling Forklift Operator', '4', '6', 'CG10', 6, 'SHANDY ASMARA PRD.jpg', 26, 26, '130193029'),
(252, 'K170900190', 'SHOFWAN HANIF', 'Mechanic Helper', '5', '10', 'CG12', 6, 'SHOFWAN HANIF ENG.jpg', 26, 26, 'K170900190'),
(253, '180100013', 'SIDIK TRIPAMBUDI', 'Mechanic Helper', '5', '10', 'CG12', 6, 'SIDIK TRI PAMBUDI ENG.jpg', 26, 26, '180100013'),
(254, 'K180700245', 'SITI FAUZIAH NUR AMIN', 'QC In Line Field', '7', '17', 'CG16', 6, 'SITI FAUZIAH NUR AMIN QA.jpg', 26, 26, 'K180700245'),
(255, 'K170100058', 'SOLIHIN', 'Sachet Packing Helper', '4', '7', 'CG07', 6, 'SOLIHIN PRD.jpg', 26, 26, 'K170100058'),
(256, 'K161100683', 'SUBUR WIYONO', 'Sachet Packing Helper', '4', '7', 'CG07', 6, 'SUBUR WIYONO PRD.jpg', 26, 26, 'K161100683'),
(257, '130193030', 'SUDARWANTO', 'CANNING', '4', '7', 'CG05', 6, 'SUDARWANTO PRD.jpg', 26, 26, '130193030'),
(258, '121192537', 'SUGIANTO', 'Sachet D', '4', '7', 'CG06', 6, 'SUGIANTO PRD.jpg', 26, 26, '121192537'),
(259, 'O180500041', 'SUHENDI', 'Cleaning Service', '8', '20', 'CG19', 6, 'SUHENDI HR.jpg', 26, 26, 'O180500041'),
(260, '130193031', 'SUHERI', 'Warehouse RM Minor Preparator', '6', '12', 'CG14', 6, 'SUHERI WH.jpg', 26, 26, '130193031'),
(261, '121192538', 'SULISWANTO', 'Sachet D', '4', '7', 'CG06', 6, 'SULISWANTO PRD.jpg', 26, 26, '121192538'),
(262, 'K170100059', 'SULTHON FAUZI', 'Warehouse RM Minor Helper', '6', '12', 'CG14', 6, 'SULTHON FAUZI WH.jpg', 26, 26, 'K170100059'),
(263, '150491706', 'SUMARNA', 'PPIC', '1', '2', 'CG01', 6, 'SUMARNA MDP.jpg', 26, 26, '150491706'),
(264, 'O180500042', 'SURYANTO', 'Security', '8', '20', 'CG19', 6, 'SURYANTO HR.jpg', 26, 26, 'O180500042'),
(265, '130193032', 'SURYATI', 'Sachet Packing Helper', '4', '7', 'CG07', 6, 'SURYATI PRD.jpg', 26, 26, '130193032'),
(266, '121092529', 'SUSANTO RONNI', 'Bin Filling Forklift Operator', '4', '6', 'CG09', 6, 'SUSANTO RONI PRD.jpg', 26, 26, '121092529'),
(267, 'K180300121', 'SUSENO', 'Sachet Packing Helper', '4', '7', 'CG07', 6, 'SUSENO PRD.jpg', 26, 26, 'K180300121'),
(268, '130193033', 'SYAHRUL HIDAYAT', 'CANNING', '4', '7', 'CG05', 6, 'SYAHRUL HIDAYAT PRD.jpg', 26, 26, '130193033'),
(269, '120192508', 'TARMAN SUTISNA', 'Blending Forklift Operator', '4', '7', 'CG08', 6, 'TARMAN SUTISNA PRD.jpg', 26, 26, '120192508'),
(270, 'K170222443', 'TATA TAOFIK QUROHMAN', 'QC Microbiology Field', '7', '16', 'CG17', 6, 'TATA TAOFIK QUROHMAN QA.jpg', 26, 26, 'K170222443'),
(271, 'K160700384', 'TATANG MEINSYAHYAR', 'Driver', '8', '20', 'CG19', 6, 'TATANG MEISYAYAR HR.jpg', 26, 26, 'K160700384'),
(272, '140792920', 'TAUFIK FARIDZAL', 'Drier Roving Operator', '4', '6', 'CG09', 6, 'TAUFIK FARIDZAL PRD.jpg', 26, 26, '140792920'),
(273, 'O170500252', 'TAUFIK HIDAYAT', 'Security', '8', '20', 'CG19', 6, 'TAUFIK HIDAYAT HR.jpg', 26, 26, 'O170500252'),
(274, 'O170900016', 'TEDI RAHMAT', 'Cleaning Service', '8', '20', 'CG19', 6, 'TEDI RAHMAT HR.jpg', 26, 26, 'O170900016'),
(275, 'K180300108', 'TENDI SOBARNANSYAH', 'Mechanic Helper', '5', '10', 'CG12', 6, 'TENDI SOBARNANSYAH ENG.jpg', 26, 26, 'K180300108'),
(276, 'O170900009', 'TIAS OKTAVIAN', 'Cleaning Service Leader', '8', '20', 'CG19', 6, 'TIAS OKTAVIAN HR.jpg', 26, 26, 'O170900009'),
(277, '140292909', 'TRI AGUSTIARTY WARDHANY', 'QC In Line Analyst', '7', '17', 'CG16', 6, 'TRI AGUSTRIARTI WARDHANY QA.jpg', 26, 26, '140292909'),
(278, 'K170300157', 'TRIYANA', 'Warehouse RM Major Helper', '6', '12', 'CG14', 6, 'TRIYANA WH.jpg', 26, 26, 'K170300157'),
(279, '120192509', 'USEP YUSEPA', 'Sachet A', '4', '7', 'CG07', 6, 'USEP YUSEPA PRD.jpg', 26, 26, '120192509'),
(280, '120692520', 'USMAN', 'Warehouse PM Checker', '6', '13', 'CG14', 6, 'USMAN WH.jpg', 26, 26, '120692520'),
(281, 'K170100280', 'UTBAH FARQAD ASSALMI SADDAM', 'Sachet D', '4', '7', 'CG06', 6, 'UTBAH FARQAD PRD .jpg', 26, 26, 'K170100280'),
(282, '110191208', 'UUM UMBARA', 'Blending Operator', '4', '7', 'CG08', 6, 'UUM UMBARA PRD.jpg', 26, 26, '110191208'),
(283, '120892524', 'VICKRY JANI HARIYANTO', 'Electrical Technician', '5', '8', 'CG12', 6, 'VICKRY JANI HARIYANTO ENG.jpg', 26, 26, '120892524'),
(284, '170700034', 'WAHDAN AMIR ZAHIDIN', 'HRD Administration', '8', '19', 'CG18', 6, 'WAHDAN AMIR ZAHIDIN HR.jpg', 26, 26, '170700034'),
(285, 'K171200349', 'WAHYU CANDRA MAULANA', 'Sachet D', '4', '7', 'CG06', 6, 'WAHYU CHANDRA PRD.jpg', 26, 26, 'K171200349'),
(286, 'O160100010', 'WAHYU ROSADI', 'Security', '8', '20', 'CG19', 6, 'WAHYU ROSADI HR.jpg', 26, 26, 'O160100010'),
(287, '130193034', 'WARDI SAEPUDIN', 'Utility-WWTP', '5', '11', 'CG13', 6, 'WARDI SAEPUDIN ENG.jpg', 26, 26, '130193034'),
(288, '120692521', 'WEMPI NUR HIDAYAT', 'Warehouse RM Major Checker', '6', '12', 'CG14', 6, 'WEMPI NURHIDAYAT WH.jpg', 26, 26, '120692521'),
(289, '180100021', 'WULAN NUR FATIMAH', 'Sachet D', '4', '7', 'CG06', 6, 'WULAN NURFATIMAH PRD.jpg', 26, 26, '180100021'),
(290, 'O170200102', 'WULAN VERINASARI', 'Security', '8', '20', 'CG19', 6, 'WULAN VERINASARI HR.jpg', 26, 26, 'O170200102'),
(291, '120292516', 'YAYAT NURHIDAYAT', 'Bin Filling Operator', '4', '6', 'CG09', 6, 'YAYAT NURHIDAYAT PRD.jpg', 26, 26, '120292516'),
(292, '110191209', 'YERI KUSNADI', 'Processing Operator', '4', '6', 'CG09', 6, 'YERI KUSNADI PRD.jpg', 26, 26, '110191209'),
(293, 'K180300123', 'YOGI ISKANDAR', 'Sachet Packing Helper', '4', '7', 'CG07', 6, 'YOGI ISKANDAR PRD.jpg', 26, 26, 'K180300123'),
(294, 'K160900548', 'YUDI ANGGA SAPUTRA', 'Sachet Packing Helper', '4', '7', 'CG07', 6, 'YUDI ANGGA SAPUTRA PRD.jpg', 26, 26, 'K160900548'),
(295, 'O171000085', 'YUDI SAPUTRA', 'Security', '8', '20', 'CG19', 6, 'YUDI SAPUTRA HR.jpg', 26, 26, 'O171000085'),
(296, '160192706', 'YUNIAR TRI PRAKOSO', 'QC In Line Analyst', '7', '17', 'CG16', 6, 'YUNIAR TRI PRAKOSO QA.jpg', 26, 26, '160192706'),
(297, '070100024', 'YUSUF HAMDANI', 'Evaporator Operator', '4', '6', 'CG09', 6, 'YUSUF HAMDANI PRD.jpg', 26, 26, '070100024'),
(298, '121192539', 'YUSUP SYAHRONI', 'Sachet D', '4', '7', 'CG06', 6, 'YUSUF SYAHRONI PRD.jpg', 26, 26, '121192539'),
(299, '140792921', 'ZAENUDDIN', 'A SACHET', '4', '7', 'CG07', 6, 'ZAENUDIN PRD.jpg', 26, 26, '140792921'),
(300, '121192540', 'ZENAL MULYANA', 'Sachet D', '4', '7', 'CG06', 6, 'ZENAL MULYANA PRD.jpg', 26, 26, '121192540'),
(301, '070100001', 'ADI SETIAHADI', 'SPV', '4', '6', 'CG09', 2, 'ADI SETIAHADI PRD.jpg', 0, 0, '070100001'),
(302, '110191206', 'AGA WALESSA', 'TPM Staff', '2', '1', 'CG02', 2, 'AGA WALESSA IOS.jpg', 0, 0, '110191206'),
(303, '120200010', 'AGUNG JOKO SUPRIHANTO', 'SPV', '4', '6', 'CG11', 2, 'AGUNG JOKO SUPRIHATNO PRD.jpg', 0, 0, '120200010'),
(304, '070100013', 'AGUS RIYANTO', 'Purchasing Supervisor', '8', '21', 'CG20', 2, 'AGUS RIYANTO HR.jpg', 0, 0, '070100013'),
(305, '070100004', 'AGUS TURANTO', 'SPV', '4', '6', 'CG10', 2, 'AGUS TURANTO PRD.jpg', 0, 0, '070100004'),
(306, '120500031', 'AKHMAD MAKHALI', 'IT Supervisor', '3', '4', 'CG03', 2, 'AKHMAD MAKHALI IT.jpg', 0, 0, '120500031'),
(307, '160200097', 'ALIT PRADANA', 'Filling & Packing Coordinator', '4', '7', 'CG07', 2, 'ALIT PRADANA PRD.jpg', 0, 0, '160200097'),
(308, '160300138', 'BONARDO JOHAN MARKUS MANULLANG', 'General Affair Staff', '8', '20', 'CG19', 2, 'BONARDO JOHAN MARKUS MANULLANG HR.jpg', 0, 0, '160300138'),
(309, '080900030', 'BUGI NOVRIYANTO', 'SPV', '4', '7', 'CG06', 2, 'BUGI NOVRIANTO PRD.jpg', 0, 0, '080900030'),
(310, '140300020', 'DICKA SEPTYAN RENDRA PRABOWO', 'Electrical Supervisor', '5', '8', 'CG13', 2, 'DICKA SEPTYAN RENDRA PRABOWO ENG.jpg', 0, 0, '140300020'),
(311, '090593002', 'HALILY SOFYAN AL HASAN', 'System Staff', '2', '1', '', 2, 'HALILY SOFYAN AL HASAN IOS.jpg', 0, 0, '090593002'),
(312, '070600083', 'HENDI ISKANDAR', 'QA Laboratory Supervisor', '7', '16', 'CG16', 2, 'HENDI ISKANDAR QA.jpg', 0, 0, '070600083'),
(313, '170622418', 'JOHN HENDRI PURBA', 'Filling & Packing Supervisor', '4', '7', 'CG05', 2, 'JOHN HENDRI PURBA PRD.jpg', 0, 0, '170622418'),
(314, '070400065', 'MARLENY PATANDUNG', 'Warehouse Dept Head', '6', '', 'CG14', 2, 'MARLENY PATANDUNG WH.jpg', 0, 0, '070400065'),
(316, '111200086', 'SADHU PUTRI SUSANTI', 'FA SPV', '3', '5', 'CG04', 2, 'SADHU PUTRI SUSANTI FA.jpg', 0, 0, '111200086'),
(317, '060700017', 'SRI REJEKI', 'Spv BPSD', '2', '2', 'CG02', 2, 'SRI REJEKI IOS.jpg', 0, 0, '060700017'),
(318, '061200039', 'SUNGATNO', 'QC In Line Supervisor', '7', '17', 'CG17', 2, 'SUNGATNO QA.jpg', 0, 0, '061200039'),
(319, '150600127', 'YOPPY SUKMANDAR', 'Maintenance System Supervisor', '5', '', 'CG12', 2, 'YOPPY SUKMANDAR ENG.jpg', 0, 0, '150600127'),
(320, '120292517', 'YUANITA JOHAN', 'PPIC Coordinator', '1', '1', 'CG01', 2, 'YUANITA JOHAN MDP.jpg', 0, 0, '120292517'),
(321, '060800020', 'YUNIARTO', 'Spv Eng', '5', '', 'CG12', 2, 'YUNIARTO ENG.jpg', 0, 0, '060800020'),
(322, '120292511', 'AHMAD SAHRONI', 'STAFF Produksi', '4', '7', '', 3, '', 0, 0, '120292511'),
(323, '120692519', 'DINA MUSTIKA WENI', 'Eng Administration', '5', '8', '', 3, '', 0, 0, '120692519'),
(324, '070400068', 'DWI ISDARYANTO', 'Warehouse RM Major Staff', '6', '12', '', 3, '', 0, 0, '070400068'),
(325, '1603001300', 'DWI PARAMITHA', 'Recruitment & Learning Development Staff', '8', '19', '', 3, '', 0, 0, '1603001300'),
(326, '061100032', 'MUHAMAD EFENDI', 'Tote Bin Washing Circle Leader', '4', '6', '', 3, '', 0, 0, '061100032'),
(327, '140700131S', 'PUTRI PUSPITA SARI', 'Finance & Accounting Staff', '3', '5', '', 3, '', 0, 0, '140700131S'),
(328, '1202925150', 'RUDI SUGIARTO', 'Improvement Junior Staff', '2', '1', '', 3, '', 0, 0, '1202925150'),
(329, '061100034', 'TIWIK SUYANTI', 'Staff QA', '7', '16', '', 3, '', 0, 0, '061100034'),
(330, '110900055', 'HERMANSYAH', 'Fasilitator FI', '2', '', '', 4, '', 0, 0, '110900055'),
(331, '120292515', 'RUDI SUGIARTO SEKRE', 'Improvement Junior Staff', '1', '', '', 4, '', 0, 0, '120292515'),
(332, '110900055K', 'HERMANSYAH C', 'komite', '1', '', '', 7, '', 0, 0, '110900055K'),
(333, '120292515S', 'RUDI SUGIARTO KOM', 'komite', '1', '', '', 7, '', 0, 0, '120292515S'),
(334, '080900030S', 'BUGI NOVRIYANTO', 'SPV', '4', '7', 'CG08', 2, '', 0, 0, '080900030S'),
(335, '070400065S', 'MARLENY PATANDUNG', 'Warehouse Dept Head', '6', '', 'CG15', 2, '', 0, 0, '070400065S'),
(337, '140700131', 'PUTRI PUSPITA SARI', 'Finance & Accounting Staff', '3', '4', '', 3, '', 0, 0, '140700131'),
(338, '1603001300S', 'DWI PARAMITHA', 'Recruitment & Learning Development Staff', '8', '20', '', 3, '', 0, 0, '1603001300S'),
(339, '1603001300SS', 'DWI PARAMITHA', 'Recruitment & Learning Development Staff', '8', '21', '', 3, '', 0, 0, '1603001300SS'),
(340, '070400068S', 'DWI ISDARYANTO', 'Warehouse RM Major Staff', '6', '13', '', 3, '', 0, 0, '070400068S'),
(341, '070400068SS', 'DWI ISDARYANTO', 'Warehouse RM Major Staff', '6', '14', '', 3, '', 0, 0, '070400068SS'),
(342, '070400068SSS', 'DWI ISDARYANTO', 'Warehouse RM Major Staff', '6', '15', '', 3, '', 0, 0, '070400068SSS'),
(343, '061100034S', 'TIWIK SUYANTI', 'Staff QA', '7', '17', '', 3, '', 0, 0, '061100034S'),
(344, '061100034SS', 'TIWIK SUYANTI', 'Staff QA', '7', '18', '', 3, '', 0, 0, '061100034SS'),
(345, '120692519S', 'DINA MUSTIKA WENI', 'Eng Administration', '5', '9', '', 3, '', 0, 0, '120692519S'),
(346, '120692519SS', 'DINA MUSTIKA WENI', 'Eng Administration', '5', '10', '', 3, '', 0, 0, '120692519SS'),
(347, '120692519SSS', 'DINA MUSTIKA WENI', 'Eng Administration', '5', '11', '', 3, '', 0, 0, '120692519SSS'),
(348, '180600122', 'Bernadheta Rismisari Handayani', 'HR Dept Head', '8', '19', 'CG18', 2, NULL, 0, 0, '180600122');

-- --------------------------------------------------------

--
-- Table structure for table `ira_mst_level`
--

CREATE TABLE `ira_mst_level` (
  `ID_LEVEL` int(11) NOT NULL,
  `LEVEL` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ira_mst_level`
--

INSERT INTO `ira_mst_level` (`ID_LEVEL`, `LEVEL`) VALUES
(1, 'administrator'),
(2, 'approver'),
(3, 'koordinator'),
(4, 'sekretariat'),
(6, 'improver'),
(7, 'komite');

-- --------------------------------------------------------

--
-- Table structure for table `ira_mst_point_opl`
--

CREATE TABLE `ira_mst_point_opl` (
  `KD_TEMA` varchar(2) NOT NULL,
  `TEMA` varchar(14) NOT NULL,
  `POINT` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ira_mst_point_opl`
--

INSERT INTO `ira_mst_point_opl` (`KD_TEMA`, `TEMA`, `POINT`) VALUES
('Q', 'Quality', 2),
('C', 'Cost', 2),
('D', 'Delivery', 2),
('S', 'Safety', 2),
('M', 'Moral', 1),
('E', 'Environment', 2);

-- --------------------------------------------------------

--
-- Table structure for table `ira_mst_subdept`
--

CREATE TABLE `ira_mst_subdept` (
  `ID_SUBDEPT` int(10) NOT NULL,
  `ID_DEPT` int(10) NOT NULL,
  `NAMA_SUBDEPT` varchar(30) NOT NULL,
  `KD_URUTAN` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ira_mst_subdept`
--

INSERT INTO `ira_mst_subdept` (`ID_SUBDEPT`, `ID_DEPT`, `NAMA_SUBDEPT`, `KD_URUTAN`) VALUES
(1, 2, 'IOS', 8),
(2, 1, 'PPIC', 11),
(3, 1, 'I2C', 12),
(4, 3, 'FAIT-IT', 6),
(5, 3, 'FAIT-FA', 7),
(6, 4, 'PND', 9),
(7, 4, 'FNP', 10),
(8, 5, 'ELECTRICAL', 16),
(9, 5, 'STORE KEEPER', 23),
(10, 5, 'MECHANICAL', 24),
(11, 5, 'UTILITY', 25),
(12, 6, 'RM', 26),
(13, 6, 'PM', 27),
(14, 6, 'DISPENSING', 28),
(15, 6, 'FINISH GOOD', 29),
(16, 7, 'MICROBIOLOGY', 17),
(17, 7, 'INLINE', 18),
(18, 7, 'CHEMPYS', 19),
(19, 8, 'HR TRAINING', 20),
(20, 8, 'HRGA', 21),
(21, 8, 'PURCHASING', 22);

-- --------------------------------------------------------

--
-- Table structure for table `ira_mst_tema`
--

CREATE TABLE `ira_mst_tema` (
  `NO_TEMA` int(2) UNSIGNED NOT NULL,
  `NAMA_TEMA` varchar(24) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ira_mst_tema`
--

INSERT INTO `ira_mst_tema` (`NO_TEMA`, `NAMA_TEMA`) VALUES
(1, 'QUALITY'),
(2, 'COST'),
(3, 'DELIVERY'),
(4, 'SAFETY'),
(5, 'MORAL'),
(6, 'ENVIRONMENT');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ira_data_improvement`
--
ALTER TABLE `ira_data_improvement`
  ADD PRIMARY KEY (`ID_IMPROVEMENT`),
  ADD UNIQUE KEY `index_data_improvement` (`ID_IMPROVEMENT`,`NO_REGISTRASI`,`NIK_KARYAWAN`);

--
-- Indexes for table `ira_data_improvement_pengusul`
--
ALTER TABLE `ira_data_improvement_pengusul`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `NO_REGISTRASI` (`NO_REGISTRASI`);

--
-- Indexes for table `ira_data_opl`
--
ALTER TABLE `ira_data_opl`
  ADD PRIMARY KEY (`id_opl`),
  ADD KEY `id_opl` (`id_opl`);

--
-- Indexes for table `ira_data_opl_pengusul`
--
ALTER TABLE `ira_data_opl_pengusul`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `ira_mst_dept`
--
ALTER TABLE `ira_mst_dept`
  ADD PRIMARY KEY (`ID_DEPT`);

--
-- Indexes for table `ira_mst_karyawan`
--
ALTER TABLE `ira_mst_karyawan`
  ADD PRIMARY KEY (`ID_KARYAWAN`),
  ADD UNIQUE KEY `index_karyawan` (`NIK_KARYAWAN`,`ID_DEPT`,`ID_SUBDEPT`,`ID_CG`);

--
-- Indexes for table `ira_mst_level`
--
ALTER TABLE `ira_mst_level`
  ADD PRIMARY KEY (`ID_LEVEL`);

--
-- Indexes for table `ira_mst_point_opl`
--
ALTER TABLE `ira_mst_point_opl`
  ADD PRIMARY KEY (`KD_TEMA`);

--
-- Indexes for table `ira_mst_subdept`
--
ALTER TABLE `ira_mst_subdept`
  ADD PRIMARY KEY (`ID_SUBDEPT`),
  ADD UNIQUE KEY `KD_URUTAN` (`KD_URUTAN`);

--
-- Indexes for table `ira_mst_tema`
--
ALTER TABLE `ira_mst_tema`
  ADD PRIMARY KEY (`NO_TEMA`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ira_data_improvement`
--
ALTER TABLE `ira_data_improvement`
  MODIFY `ID_IMPROVEMENT` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ira_data_improvement_pengusul`
--
ALTER TABLE `ira_data_improvement_pengusul`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ira_data_opl`
--
ALTER TABLE `ira_data_opl`
  MODIFY `id_opl` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ira_data_opl_pengusul`
--
ALTER TABLE `ira_data_opl_pengusul`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ira_mst_karyawan`
--
ALTER TABLE `ira_mst_karyawan`
  MODIFY `ID_KARYAWAN` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=349;

--
-- AUTO_INCREMENT for table `ira_mst_level`
--
ALTER TABLE `ira_mst_level`
  MODIFY `ID_LEVEL` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ira_mst_subdept`
--
ALTER TABLE `ira_mst_subdept`
  MODIFY `ID_SUBDEPT` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `ira_mst_tema`
--
ALTER TABLE `ira_mst_tema`
  MODIFY `NO_TEMA` int(2) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
