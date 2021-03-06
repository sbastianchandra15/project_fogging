/*
SQLyog Community v13.0.0 (64 bit)
MySQL - 10.3.16-MariaDB : Database - db_pro_fogging
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_pro_fogging` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_pro_fogging`;

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `admin` */

insert  into `admin`(`id_user`,`username`,`password`) values 
(1,'admin','7815696ecbf1c96e6894b779456d330e'),
(2,'aaa','7815696ecbf1c96e6894b779456d330e');

/*Table structure for table `alat_fogging` */

DROP TABLE IF EXISTS `alat_fogging`;

CREATE TABLE `alat_fogging` (
  `id_alat` int(11) NOT NULL AUTO_INCREMENT,
  `id_kat` int(11) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `no_seri` varchar(50) DEFAULT NULL,
  `tgl_beli` date DEFAULT NULL,
  PRIMARY KEY (`id_alat`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `alat_fogging` */

insert  into `alat_fogging`(`id_alat`,`id_kat`,`nama`,`no_seri`,`tgl_beli`) values 
(1,1,'nama','12345','2020-05-29'),
(2,3,'nama 2','4321','2020-05-24'),
(5,3,'Nama 3','1234','2020-05-30');

/*Table structure for table `customer` */

DROP TABLE IF EXISTS `customer`;

CREATE TABLE `customer` (
  `no_ktp` varchar(20) DEFAULT NULL,
  `scan_ktp` text DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `telp` varchar(20) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `tgl_register` date DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `customer` */

insert  into `customer`(`no_ktp`,`scan_ktp`,`nama`,`alamat`,`telp`,`tgl_lahir`,`tgl_register`,`email`,`password`,`username`) values 
('12345678901',NULL,'Nama 1a','alamat 1a','021 88483161','2020-12-31','2020-01-01','email@maill.com','7815696ecbf1c96e6894b779456d330e','customer1'),
('12345555555555',NULL,'asddddd','dsa','021 8848316','2006-01-31','2020-05-30','email@maill.com','7815696ecbf1c96e6894b779456d330e','customer3');

/*Table structure for table `kategori_alat` */

DROP TABLE IF EXISTS `kategori_alat`;

CREATE TABLE `kategori_alat` (
  `id_kat` int(11) NOT NULL AUTO_INCREMENT,
  `kategori` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_kat`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `kategori_alat` */

insert  into `kategori_alat`(`id_kat`,`kategori`) values 
(1,'Kategori A'),
(3,'Kategori B'),
(4,'Kategori C'),
(5,'');

/*Table structure for table `pesan_detail` */

DROP TABLE IF EXISTS `pesan_detail`;

CREATE TABLE `pesan_detail` (
  `id_pesan_detail` int(11) NOT NULL AUTO_INCREMENT,
  `no_pesan` varchar(20) DEFAULT NULL,
  `id_alat` int(11) DEFAULT NULL,
  `qty` decimal(5,2) DEFAULT NULL,
  `harga` decimal(11,2) DEFAULT NULL,
  `total` decimal(13,2) DEFAULT NULL,
  PRIMARY KEY (`id_pesan_detail`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `pesan_detail` */

insert  into `pesan_detail`(`id_pesan_detail`,`no_pesan`,`id_alat`,`qty`,`harga`,`total`) values 
(1,'1',5,3.00,10001.00,30003.00),
(2,'1',2,2.00,20002.00,40004.00);

/*Table structure for table `pesan_header` */

DROP TABLE IF EXISTS `pesan_header`;

CREATE TABLE `pesan_header` (
  `no_pesan` varchar(20) NOT NULL,
  `tgl` date DEFAULT NULL,
  `no_ktp` varchar(20) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`no_pesan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pesan_header` */

insert  into `pesan_header`(`no_pesan`,`tgl`,`no_ktp`,`keterangan`) values 
('1','2020-06-03','12345678901','asddsa');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
