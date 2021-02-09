-- MySQL dump 10.13  Distrib 8.0.21, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: project_akademik
-- ------------------------------------------------------
-- Server version	8.0.21

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `data_guru`
--

DROP TABLE IF EXISTS `data_guru`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `data_guru` (
  `id_guru` int NOT NULL AUTO_INCREMENT,
  `nama_guru` varchar(35) NOT NULL,
  `nip` varchar(24) NOT NULL COMMENT 'NIY NIGK',
  `kelamin` varchar(1) NOT NULL,
  `alamat_guru` text NOT NULL,
  `telpon_guru` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nik` int DEFAULT NULL,
  `status_pns` int NOT NULL COMMENT 'jika YA di isi angka 1',
  `foto_guru` varchar(100) NOT NULL,
  PRIMARY KEY (`id_guru`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_guru`
--

LOCK TABLES `data_guru` WRITE;
/*!40000 ALTER TABLE `data_guru` DISABLE KEYS */;
/*!40000 ALTER TABLE `data_guru` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_siswa`
--

DROP TABLE IF EXISTS `data_siswa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `data_siswa` (
  `id_siswa` int NOT NULL AUTO_INCREMENT,
  `nama_siswa` varchar(50) NOT NULL,
  `nis` int NOT NULL,
  `tempat_lahir` varchar(35) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `kelamin` varchar(1) NOT NULL,
  `agama` varchar(20) NOT NULL,
  `status_dlm_kel` varchar(20) NOT NULL,
  `anakke` int NOT NULL,
  `alamat_siswa` text NOT NULL,
  `telpon_siswa` varchar(35) NOT NULL,
  `asal_sekolah` varchar(25) NOT NULL,
  `kelas` varchar(11) NOT NULL,
  `diterima_tanggal` date NOT NULL,
  `nama_ayah` varchar(25) NOT NULL,
  `nama_ibu` varchar(25) NOT NULL,
  `alamat_ortu` text NOT NULL,
  `telpon_ortu` varchar(30) NOT NULL,
  `kerja_ayah` varchar(10) NOT NULL,
  `kerja_ibu` varchar(10) NOT NULL,
  `nama_wali` varchar(20) NOT NULL,
  `alamat_wali` text NOT NULL,
  `telpon_wali` varchar(20) NOT NULL,
  `kerja_wali` varchar(10) NOT NULL,
  `tahun_ajaran` varchar(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nisn` int NOT NULL,
  `foto_siswa` varchar(100) NOT NULL,
  `status` int NOT NULL COMMENT 'status alumni jika 0 maka alumni',
  PRIMARY KEY (`id_siswa`),
  UNIQUE KEY `nis` (`nis`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_siswa`
--

LOCK TABLES `data_siswa` WRITE;
/*!40000 ALTER TABLE `data_siswa` DISABLE KEYS */;
/*!40000 ALTER TABLE `data_siswa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ekstrakurikuler`
--

DROP TABLE IF EXISTS `ekstrakurikuler`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ekstrakurikuler` (
  `id_ekstra` int NOT NULL AUTO_INCREMENT,
  `nama_ekstra` varchar(50) NOT NULL,
  PRIMARY KEY (`id_ekstra`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ekstrakurikuler`
--

LOCK TABLES `ekstrakurikuler` WRITE;
/*!40000 ALTER TABLE `ekstrakurikuler` DISABLE KEYS */;
/*!40000 ALTER TABLE `ekstrakurikuler` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `info_sekolah`
--

DROP TABLE IF EXISTS `info_sekolah`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `info_sekolah` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_aplikasi` varchar(30) NOT NULL,
  `nama_sekolah` varchar(50) NOT NULL,
  `npsn` varchar(25) NOT NULL,
  `nss` varchar(25) NOT NULL,
  `alamat_sekolah` text NOT NULL,
  `kode_pos` varchar(8) NOT NULL,
  `kelurahan` varchar(30) NOT NULL,
  `kecamatan` varchar(30) NOT NULL,
  `kabupaten` varchar(30) NOT NULL,
  `provinsi` varchar(35) NOT NULL,
  `website` varchar(30) NOT NULL,
  `telpon` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `logo` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `info_sekolah`
--

LOCK TABLES `info_sekolah` WRITE;
/*!40000 ALTER TABLE `info_sekolah` DISABLE KEYS */;
INSERT INTO `info_sekolah` VALUES (1,'SINO-SMA MUH 7','SD Santa Maria Timika','20403149','304046007031','JL. Ki Hajar Dewantoro, Timika, Inauga, Papua Timur, Kabupaten Mimika, Papua 99971','12345','ketanggungan','wirobrajan','kota yogyakarta','daerah istimewa yogyakarta','smamuh3jogja.sch.id','376901 / 389976','smamuh3yogya@yahoo.com','1538571784_SMA_MUHAMMADIYAH_7.png');
/*!40000 ALTER TABLE `info_sekolah` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setup_kelas`
--

DROP TABLE IF EXISTS `setup_kelas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `setup_kelas` (
  `id_kelas` int NOT NULL AUTO_INCREMENT,
  `nama_kelas` varchar(10) NOT NULL,
  `kategori_kls` char(10) NOT NULL,
  PRIMARY KEY (`id_kelas`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setup_kelas`
--

LOCK TABLES `setup_kelas` WRITE;
/*!40000 ALTER TABLE `setup_kelas` DISABLE KEYS */;
/*!40000 ALTER TABLE `setup_kelas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setup_pelajaran`
--

DROP TABLE IF EXISTS `setup_pelajaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `setup_pelajaran` (
  `id_pelajaran` int NOT NULL AUTO_INCREMENT,
  `id_kat_mapel` int NOT NULL,
  `nama_pelajaran` varchar(50) NOT NULL,
  PRIMARY KEY (`id_pelajaran`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setup_pelajaran`
--

LOCK TABLES `setup_pelajaran` WRITE;
/*!40000 ALTER TABLE `setup_pelajaran` DISABLE KEYS */;
/*!40000 ALTER TABLE `setup_pelajaran` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setup_semester`
--

DROP TABLE IF EXISTS `setup_semester`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `setup_semester` (
  `id_semester` int NOT NULL AUTO_INCREMENT,
  `semester` varchar(6) NOT NULL,
  `status_semester` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_semester`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setup_semester`
--

LOCK TABLES `setup_semester` WRITE;
/*!40000 ALTER TABLE `setup_semester` DISABLE KEYS */;
INSERT INTO `setup_semester` VALUES (1,'ganjil',0),(2,'genap',1);
/*!40000 ALTER TABLE `setup_semester` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setup_tahun`
--

DROP TABLE IF EXISTS `setup_tahun`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `setup_tahun` (
  `id_tahun` int NOT NULL AUTO_INCREMENT,
  `tahun` char(10) NOT NULL,
  `status_aktif` int NOT NULL,
  PRIMARY KEY (`id_tahun`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setup_tahun`
--

LOCK TABLES `setup_tahun` WRITE;
/*!40000 ALTER TABLE `setup_tahun` DISABLE KEYS */;
INSERT INTO `setup_tahun` VALUES (4,'2020/2021',0),(6,'2021/2022',1);
/*!40000 ALTER TABLE `setup_tahun` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_berat_tinggi`
--

DROP TABLE IF EXISTS `tbl_berat_tinggi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_berat_tinggi` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `tinggi_badan` int DEFAULT NULL,
  `berat_badan` int DEFAULT NULL,
  `id_siswa` bigint NOT NULL,
  `id_semester` bigint DEFAULT NULL,
  `id_tahun` bigint DEFAULT NULL,
  `id_kelas` bigint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_berat_tinggi`
--

LOCK TABLES `tbl_berat_tinggi` WRITE;
/*!40000 ALTER TABLE `tbl_berat_tinggi` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_berat_tinggi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_catatanwk`
--

DROP TABLE IF EXISTS `tbl_catatanwk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_catatanwk` (
  `id_catwk` int NOT NULL AUTO_INCREMENT,
  `nis` int NOT NULL,
  `id_kelas` int NOT NULL,
  `id_wali` int NOT NULL,
  `id_semester` int NOT NULL,
  `id_tahun` int NOT NULL,
  `catatanwk` text NOT NULL,
  PRIMARY KEY (`id_catwk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_catatanwk`
--

LOCK TABLES `tbl_catatanwk` WRITE;
/*!40000 ALTER TABLE `tbl_catatanwk` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_catatanwk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_deskripsi_nilai`
--

DROP TABLE IF EXISTS `tbl_deskripsi_nilai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_deskripsi_nilai` (
  `id_deskripsi` int NOT NULL AUTO_INCREMENT,
  `id_nilai` int NOT NULL,
  `id_pelajaran` int NOT NULL,
  `nis` int NOT NULL,
  `pengetahuan` text,
  `ketrampilan` text,
  `semester` int NOT NULL,
  `id_tahun` int NOT NULL,
  PRIMARY KEY (`id_deskripsi`),
  UNIQUE KEY `id_nilai` (`id_nilai`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_deskripsi_nilai`
--

LOCK TABLES `tbl_deskripsi_nilai` WRITE;
/*!40000 ALTER TABLE `tbl_deskripsi_nilai` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_deskripsi_nilai` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_jadwal`
--

DROP TABLE IF EXISTS `tbl_jadwal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_jadwal` (
  `id_jadwal` int NOT NULL AUTO_INCREMENT,
  `id_guru` int NOT NULL,
  `id_pelajaran` int NOT NULL,
  `id_kelas` int NOT NULL,
  `id_tahun` int NOT NULL,
  `id_semester` int NOT NULL,
  PRIMARY KEY (`id_jadwal`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_jadwal`
--

LOCK TABLES `tbl_jadwal` WRITE;
/*!40000 ALTER TABLE `tbl_jadwal` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_jadwal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_kategori_mapel`
--

DROP TABLE IF EXISTS `tbl_kategori_mapel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_kategori_mapel` (
  `id_kat_mapel` int NOT NULL AUTO_INCREMENT,
  `kategori_mapel` varchar(50) NOT NULL,
  PRIMARY KEY (`id_kat_mapel`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_kategori_mapel`
--

LOCK TABLES `tbl_kategori_mapel` WRITE;
/*!40000 ALTER TABLE `tbl_kategori_mapel` DISABLE KEYS */;
INSERT INTO `tbl_kategori_mapel` VALUES (1,'KELOMPOK A (WAJIB)'),(2,'KELOMPOK B (MUATAN LOKAL)');
/*!40000 ALTER TABLE `tbl_kategori_mapel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_kategori_nilai`
--

DROP TABLE IF EXISTS `tbl_kategori_nilai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_kategori_nilai` (
  `id_kategori` int NOT NULL AUTO_INCREMENT,
  `kategori` char(25) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_kategori_nilai`
--

LOCK TABLES `tbl_kategori_nilai` WRITE;
/*!40000 ALTER TABLE `tbl_kategori_nilai` DISABLE KEYS */;
INSERT INTO `tbl_kategori_nilai` VALUES (1,'PH-KD1'),(2,'PH-KD2'),(3,'PH-KD3'),(4,'PH-KD4'),(5,'US');
/*!40000 ALTER TABLE `tbl_kategori_nilai` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_kategori_nilai_tryout`
--

DROP TABLE IF EXISTS `tbl_kategori_nilai_tryout`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_kategori_nilai_tryout` (
  `id_kategori` int NOT NULL AUTO_INCREMENT,
  `kategori` char(25) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_kategori_nilai_tryout`
--

LOCK TABLES `tbl_kategori_nilai_tryout` WRITE;
/*!40000 ALTER TABLE `tbl_kategori_nilai_tryout` DISABLE KEYS */;
INSERT INTO `tbl_kategori_nilai_tryout` VALUES (1,'TRYOUT-1'),(2,'TRYOUT-2'),(3,'TRYOUT-3');
/*!40000 ALTER TABLE `tbl_kategori_nilai_tryout` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_kehadiran`
--

DROP TABLE IF EXISTS `tbl_kehadiran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_kehadiran` (
  `id_kehadiran` int NOT NULL AUTO_INCREMENT,
  `nis` int NOT NULL,
  `id_kelas` int NOT NULL,
  `id_tahun` int NOT NULL,
  `semester` int NOT NULL,
  `sakit` int NOT NULL,
  `izin` int NOT NULL,
  `tnp_ket` int NOT NULL,
  `terlambat` int NOT NULL,
  `meninggalkan_sek` int NOT NULL,
  `tdk_upacara` int NOT NULL,
  `pm_s` int NOT NULL,
  `pm_i` int NOT NULL,
  `pm_a` int NOT NULL,
  `pm_t` int NOT NULL,
  PRIMARY KEY (`id_kehadiran`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_kehadiran`
--

LOCK TABLES `tbl_kehadiran` WRITE;
/*!40000 ALTER TABLE `tbl_kehadiran` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_kehadiran` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_kepsek`
--

DROP TABLE IF EXISTS `tbl_kepsek`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_kepsek` (
  `id_kepsek` int NOT NULL AUTO_INCREMENT,
  `id_guru` int NOT NULL,
  `id_tahun` int NOT NULL,
  `id_semester` int NOT NULL,
  `tgl_rapor` text NOT NULL,
  `tgl_siswa_diterima` text NOT NULL,
  PRIMARY KEY (`id_kepsek`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_kepsek`
--

LOCK TABLES `tbl_kepsek` WRITE;
/*!40000 ALTER TABLE `tbl_kepsek` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_kepsek` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_kkm`
--

DROP TABLE IF EXISTS `tbl_kkm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_kkm` (
  `id_kkm` int NOT NULL AUTO_INCREMENT,
  `id_tahun` int NOT NULL,
  `id_pelajaran` int NOT NULL,
  `kategori_kls` char(10) NOT NULL COMMENT 'ini berkaitan dengan tbl kelas tingkat kelas',
  `kkm` int NOT NULL,
  PRIMARY KEY (`id_kkm`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_kkm`
--

LOCK TABLES `tbl_kkm` WRITE;
/*!40000 ALTER TABLE `tbl_kkm` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_kkm` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_kondisi_fisik`
--

DROP TABLE IF EXISTS `tbl_kondisi_fisik`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_kondisi_fisik` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `penglihatan` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `pendengaran` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `gigi` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `id_siswa` bigint NOT NULL,
  `id_semester` bigint DEFAULT NULL,
  `id_tahun` bigint NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_kondisi_fisik`
--

LOCK TABLES `tbl_kondisi_fisik` WRITE;
/*!40000 ALTER TABLE `tbl_kondisi_fisik` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_kondisi_fisik` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_nilai`
--

DROP TABLE IF EXISTS `tbl_nilai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_nilai` (
  `id_nilai` int NOT NULL AUTO_INCREMENT,
  `nis` int NOT NULL,
  `id_pelajaran` int NOT NULL,
  `id_kelas` int NOT NULL,
  `id_guru` int NOT NULL,
  `nilai_pengetahuan` int NOT NULL,
  `nilai_ketrampilan` int NOT NULL,
  `id_kategori` int NOT NULL,
  `id_tahun` int NOT NULL,
  `semester` int NOT NULL,
  PRIMARY KEY (`id_nilai`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_nilai`
--

LOCK TABLES `tbl_nilai` WRITE;
/*!40000 ALTER TABLE `tbl_nilai` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_nilai` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_nilai_ekstra`
--

DROP TABLE IF EXISTS `tbl_nilai_ekstra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_nilai_ekstra` (
  `id_ekst` int NOT NULL AUTO_INCREMENT,
  `nis` int NOT NULL,
  `id_kelas` int NOT NULL,
  `id_wali` int NOT NULL,
  `id_semester` int NOT NULL,
  `id_tahun` int NOT NULL,
  `id_ekstra` int NOT NULL,
  `nilai` varchar(2) NOT NULL,
  `deskripsi` text NOT NULL,
  PRIMARY KEY (`id_ekst`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_nilai_ekstra`
--

LOCK TABLES `tbl_nilai_ekstra` WRITE;
/*!40000 ALTER TABLE `tbl_nilai_ekstra` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_nilai_ekstra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_nilai_sikap`
--

DROP TABLE IF EXISTS `tbl_nilai_sikap`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_nilai_sikap` (
  `id_sikap` int NOT NULL AUTO_INCREMENT,
  `nis` int NOT NULL,
  `id_kelas` int NOT NULL,
  `id_wali` int NOT NULL,
  `id_semester` int NOT NULL,
  `id_tahun` int NOT NULL,
  `predikat_spiritual` varchar(1) DEFAULT NULL,
  `sikap_spiritual` text,
  `predikat_sosial` varchar(1) DEFAULT NULL,
  `sikap_sosial` text,
  PRIMARY KEY (`id_sikap`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_nilai_sikap`
--

LOCK TABLES `tbl_nilai_sikap` WRITE;
/*!40000 ALTER TABLE `tbl_nilai_sikap` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_nilai_sikap` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_nilai_tryout`
--

DROP TABLE IF EXISTS `tbl_nilai_tryout`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_nilai_tryout` (
  `id_nilai` int NOT NULL AUTO_INCREMENT,
  `nis` int NOT NULL,
  `id_pelajaran` int NOT NULL,
  `id_kelas` int NOT NULL,
  `id_guru` int NOT NULL,
  `nilai` double(6,2) DEFAULT NULL,
  `id_kategori` int NOT NULL,
  `id_tahun` int NOT NULL,
  `semester` int NOT NULL,
  PRIMARY KEY (`id_nilai`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_nilai_tryout`
--

LOCK TABLES `tbl_nilai_tryout` WRITE;
/*!40000 ALTER TABLE `tbl_nilai_tryout` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_nilai_tryout` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_post`
--

DROP TABLE IF EXISTS `tbl_post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_post` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `tgl_post` datetime NOT NULL,
  `type_post` varchar(15) NOT NULL,
  `judul_post` varchar(40) NOT NULL,
  `isi_post` text NOT NULL,
  `privacy_post` varchar(10) NOT NULL,
  `author_post` int NOT NULL,
  PRIMARY KEY (`id_post`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_post`
--

LOCK TABLES `tbl_post` WRITE;
/*!40000 ALTER TABLE `tbl_post` DISABLE KEYS */;
INSERT INTO `tbl_post` VALUES (2,'2018-10-02 00:00:00','pengumuman','Petunjuk Penggunaan Aplikasi','<p>Berikut adalah petunjuk<strong> Penggunaan Aplikasi</strong></p>','publik',1),(4,'2018-10-02 16:03:04','pengumuman','Petunjuk Teknis Wali Kelas','<p>fgjfgjfdjfgjghdjdfjhdfj</p>','wali_kelas',1),(5,'2018-10-03 09:43:38','halaman','Halaman Publik','<p>Isi halaman Publik</p>','publik',1),(6,'2018-10-03 09:44:05','halaman','Halaman guru','<p>Halaman guru</p>','guru',1),(7,'2018-10-03 09:44:30','halaman','Halaman Wali Kelas','<p>Isi halaman wali kelas</p>','wali_kelas',1);
/*!40000 ALTER TABLE `tbl_post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_prestasi_siswa`
--

DROP TABLE IF EXISTS `tbl_prestasi_siswa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_prestasi_siswa` (
  `id_prestasi` int NOT NULL AUTO_INCREMENT,
  `nis` int NOT NULL,
  `id_kelas` int NOT NULL,
  `id_wali` int NOT NULL,
  `id_semester` int NOT NULL,
  `id_tahun` int NOT NULL,
  `jenis_kegiatan` varchar(40) NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY (`id_prestasi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_prestasi_siswa`
--

LOCK TABLES `tbl_prestasi_siswa` WRITE;
/*!40000 ALTER TABLE `tbl_prestasi_siswa` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_prestasi_siswa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_ruangan`
--

DROP TABLE IF EXISTS `tbl_ruangan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_ruangan` (
  `id_ruangan` int NOT NULL AUTO_INCREMENT,
  `nis` int NOT NULL,
  `id_kelas` int NOT NULL,
  `id_tahun` int NOT NULL,
  PRIMARY KEY (`id_ruangan`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_ruangan`
--

LOCK TABLES `tbl_ruangan` WRITE;
/*!40000 ALTER TABLE `tbl_ruangan` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_ruangan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_wali`
--

DROP TABLE IF EXISTS `tbl_wali`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_wali` (
  `id_wali` int NOT NULL AUTO_INCREMENT,
  `id_guru` int NOT NULL,
  `id_tahun` int NOT NULL,
  `id_kelas` int NOT NULL,
  PRIMARY KEY (`id_wali`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_wali`
--

LOCK TABLES `tbl_wali` WRITE;
/*!40000 ALTER TABLE `tbl_wali` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_wali` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_admin`
--

DROP TABLE IF EXISTS `user_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_admin` (
  `id_admin` int NOT NULL AUTO_INCREMENT,
  `nama_admin` varchar(20) NOT NULL,
  `nip` varchar(12) NOT NULL,
  `kelamin` varchar(1) NOT NULL,
  `alamat_admin` text NOT NULL,
  `telpon_admin` varchar(12) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `foto_admin` varchar(100) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_admin`
--

LOCK TABLES `user_admin` WRITE;
/*!40000 ALTER TABLE `user_admin` DISABLE KEYS */;
INSERT INTO `user_admin` VALUES (1,'Administrator','123456789','L','Jl. Kapten Piere Tendean no.58 Yogyakarta','087839595916','admin','e00cf25ad42683b3df678c61f42c6bda','1535427175_avatar5copy.png');
/*!40000 ALTER TABLE `user_admin` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-02-09 19:13:25
