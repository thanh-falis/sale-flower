/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.5.5-10.4.14-MariaDB : Database - db_banhang
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_banhang` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `db_banhang`;

/*Table structure for table `bill_detail` */

DROP TABLE IF EXISTS `bill_detail`;

CREATE TABLE `bill_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_bill` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` double NOT NULL,
  `delete` tinyint(1) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `bill_detail` */

insert  into `bill_detail`(`id`,`id_bill`,`id_product`,`quantity`,`unit_price`,`delete`,`created_at`,`updated_at`) values (1,5,7,2,1500000,0,'2021-07-14','2021-07-14'),(2,5,8,1,699000,0,'2021-07-14','2021-07-14'),(3,6,8,1,699000,0,'2021-07-19','2021-07-19'),(4,6,9,1,1100000,0,'2021-07-19','2021-07-19'),(5,6,12,1,1160000,0,'2021-07-19','2021-07-19'),(6,8,7,1,1500000,0,'2021-07-20','2021-07-20'),(7,8,29,1,1260000,0,'2021-07-20','2021-07-20'),(8,9,23,1,720000,0,'2021-07-20','2021-07-20'),(9,9,51,1,1040000,0,'2021-07-20','2021-07-20'),(10,10,29,1,1260000,0,'2021-07-20','2021-07-20'),(11,10,33,1,900000,0,'2021-07-20','2021-07-20'),(12,11,7,1,1500000,0,'2021-07-20','2021-07-20'),(13,11,8,1,699000,0,'2021-07-20','2021-07-20'),(14,12,7,2,1500000,0,'2021-07-20','2021-07-20'),(15,13,5,1,990000,0,'2021-07-20','2021-07-20'),(16,13,15,1,1300000,0,'2021-07-20','2021-07-20'),(17,14,22,1,649000,0,'2021-07-20','2021-07-20'),(18,14,23,1,720000,0,'2021-07-20','2021-07-20'),(19,15,22,1,649000,0,'2021-07-20','2021-07-20'),(20,15,23,1,720000,0,'2021-07-20','2021-07-20');

/*Table structure for table `bills` */

DROP TABLE IF EXISTS `bills`;

CREATE TABLE `bills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_customer` int(11) NOT NULL,
  `date_order` date NOT NULL,
  `total` double NOT NULL,
  `payment` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `note` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `delete` tinyint(1) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `bills` */

insert  into `bills`(`id`,`id_customer`,`date_order`,`total`,`payment`,`status`,`note`,`delete`,`created_at`,`updated_at`) values (5,8,'2021-07-14',3699000,'COD',1,NULL,0,'2021-07-14','2021-07-18'),(6,10,'2021-07-19',2959000,'COD',0,NULL,0,'2021-07-19','2021-07-19'),(7,11,'2021-07-20',2760000,'COD',0,NULL,0,'2021-07-20','2021-07-20'),(8,11,'2021-07-20',2760000,'COD',0,NULL,0,'2021-07-20','2021-07-20'),(9,11,'2021-07-20',1760000,'COD',0,NULL,0,'2021-07-20','2021-07-20'),(10,11,'2021-07-20',2160000,'COD',0,NULL,0,'2021-07-20','2021-07-20'),(11,11,'2021-07-20',2199000,'COD',0,NULL,0,'2021-07-20','2021-07-20'),(12,11,'2021-07-20',3000000,'COD',0,NULL,0,'2021-07-20','2021-07-20'),(13,11,'2021-07-20',2290000,'COD',0,NULL,0,'2021-07-20','2021-07-20'),(14,11,'2021-07-20',1369000,'COD',0,NULL,0,'2021-07-20','2021-07-20'),(15,11,'2021-07-20',1369000,'COD',0,NULL,0,'2021-07-20','2021-07-20');

/*Table structure for table `customer` */

DROP TABLE IF EXISTS `customer`;

CREATE TABLE `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `customer` */

insert  into `customer`(`id`,`name`,`gender`,`email`,`password`,`address`,`phone_number`,`note`,`created_at`,`updated_at`) values (10,'Nguyễn Văn','nam','thenhelma2020@gmail.com','$2y$10$hTSxpB1vS9ILmkHnO2UVAOGskApWNmQ9E977Cm3C8YaX3O/AmnmFu','126- đường số 7, phường 3, Gò Vấp, Tp. HCM','0906789548',NULL,'2021-07-16','2021-07-16'),(11,'Thanh Trần','nam','nguyen.van.thanh.itvn@gmail.com','$2y$10$OxWsHRFDpzck.oAKI1D5NOQ.hJ5/E6XdU.bEpwvhxk43amUHgZkpK','126- đường số 7, phường 3, Gò Vấp, Tp. HCM','0906789548',NULL,'2021-07-20','2021-07-20');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

/*Table structure for table `news` */

DROP TABLE IF EXISTS `news`;

CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `news` */

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `id_type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `unit_price` float NOT NULL,
  `promotion_price` float NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `unit` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `new` int(5) NOT NULL,
  `flag` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `products` */

insert  into `products`(`id`,`name`,`id_type`,`description`,`unit_price`,`promotion_price`,`image`,`unit`,`new`,`flag`,`created_at`,`updated_at`) values (1,'MẪU ĐƠN HỒNG',2,'',1430000,0,'Mau-don-hong.jpg','Không có sẵn',0,0,NULL,NULL),(2,'ÁNH HỒNG',2,'',1000000,86000,'anh-hong.jpg','Không có sẵn',0,0,NULL,NULL),(3,'TRUE LOVE (100 BÔNG HỒNG)',2,'',1500000,0,'true-love-100-bong.jpg','Không có sẵn',0,0,NULL,NULL),(4,'YÊU THƯƠNG TÍM',2,'',990000,0,'yeu-thuong-tim.jpg','Không có sẵn',0,0,NULL,NULL),(5,'ÁNH NGỌC',2,'',990000,0,'anh-ngoc.png','Không có sẵn',0,0,NULL,NULL),(6,'MÙA THU (MẪU ĐƠN)',2,'',1600000,0,'mua-thu-mau-don.jpg','Cần đặt trước',1,0,NULL,NULL),(7,'KHOẢNH KHẮC',2,'',1500000,1400000,'khoanh-khac.png','Cần đặt trước',1,0,NULL,NULL),(8,'PHÚT ĐẦU TIÊN',2,'',699000,0,'phut-dau-tien.jpg','Cần đặt trước',1,0,NULL,NULL),(9,'THÀNH CÔNG HỒNG',2,'',1100000,0,'thanh-cong-hong.jpg','Cần đặt trước',1,0,NULL,NULL),(10,'SWEET HEART',2,'',1800000,0,'sweet-heart.jpg','Cần đặt trước',1,0,NULL,NULL),(11,'KẾT NỐI YÊU THƯƠNG',2,'',730000,0,'ket-noi-yeu-thuong.jpg','Cần đặt trước',0,0,NULL,NULL),(12,'DIỆU KỲ',2,'',1160000,910000,'dieu-ky.png','Cần đặt trước',1,0,NULL,NULL),(13,'KHÚC CA MÊ LY',2,'',1700000,0,'ca-khuc-me-ly.jpg','Cần đặt trước',0,0,NULL,NULL),(14,'THANH XUÂN TƯƠI ĐẸP',2,'',1980000,0,'thanh-xuan-tuoi-dep.jpg','Cần đặt trước',0,0,NULL,NULL),(15,'HÂN HOAN',2,'',1300000,0,'han-hoan.jpg','Cần dặt trước',0,0,NULL,NULL),(16,'TÌNH YÊU MÀU XANH',2,'',2060000,0,'tinh-yeu-mau-xanh.jpg','Cần đặt trước',0,0,NULL,NULL),(17,'MÁ HỒNG',2,'',360000,0,'ma-hong.jpg','Không có sẵn',0,0,NULL,NULL),(18,'THANH NHÃ',2,'',1300000,1150000,'thanh-nha.jpg','Không có sẵn',0,0,NULL,NULL),(19,'TRỌN VẸN (101 ĐÓA HỒNG)',2,'',1800000,0,'tron-ven-101-doa-hong.jpg','Không có sẵn',0,0,NULL,NULL),(20,'CHÍN TẦNG MÂY',2,'',1200000,0,'chin-tang-may.jpg','Không có sẵn',0,0,NULL,NULL),(21,'HOA CẦM TAY CÔ DÂU TÌNH YÊU CHÂN THÀNH',1,'',9350000,0,'hoa-tinh-yeu-co-dau-tinh-yeu-chan-thanh.jpg','Cần đặt trước',0,0,NULL,NULL),(22,'HOA CƯỚI BABY HỒNG',1,'',649000,0,'hoa-cuoi-baby-hong.jpg','Cần dặt trước',0,0,NULL,NULL),(23,'HẠNH PHÚC LỨA ĐÔI',1,'',720000,660000,'hanh-phuc-lua-doi.jpg','Cần đặt trước',1,0,NULL,NULL),(24,'HOA CƯỚI MẮT CƯỜI',1,'',539000,0,'hoa-cuoi-mat-cuoi.jpg','Cần đặt trước',1,0,NULL,NULL),(25,'HOA CẦM TAY CÔ DÂU KIM CƯƠNG',1,'',660000,0,'hoa-cam-tay-co-dau-kim-cuong.jpg','Cần đặt trước',1,0,NULL,NULL),(26,'HOA NGÀY CƯỚI RẠNG NGỜI',1,'',715000,0,'hoa-ngay-cuoi-rang-ngoi.jpg','Cần đặt trước',1,0,NULL,NULL),(27,'HOA CẦM TAY CÔ DÂU MÂY TRẮNG',1,'',1370000,0,'hoa-cam-tay-co-dau-may-trang.jpg','Cần đặt trước',0,0,NULL,NULL),(28,'NGÀY SÁNH ĐÔI',1,'',580000,0,'ngay-sanh-doi.jpg','Cần đặt trước',0,0,NULL,NULL),(29,'NGÀY HẠNH PHÚC',1,'',1260000,1150000,'ngay-hanh-phuc.jpg','Cần đặt trước',1,0,NULL,NULL),(30,'HOA CẦM TAY CÔ DÂU VƯỜN TÌNH YÊU',1,'',1320000,0,'hoa-cam-tay-co-dau-vuon-tinh-yeu.jpg','Cần đặt trước',0,0,NULL,NULL),(31,'TƯƠI SÁNG',3,'',960000,0,'tuoi-sang.jpg','Cần đặt trước',0,0,NULL,NULL),(32,'HOA CHÚC MỪNG VƯƠN LÊN',3,'',1000000,900000,'hoa-chuc-mung-vuon-len.jpg','Cần đặt trước',1,0,NULL,NULL),(33,'VẠN LỘC',3,'',900000,0,'van-loc.jpg','Cần đặt trước',1,0,NULL,NULL),(34,'KỆ HOA KHAI TRƯƠNG TRANG TRỌNG',3,'',1500000,0,'ke-hoa-khai-truong-trang-trong.jpg','Cần đặt trước',0,0,NULL,NULL),(35,'KỆ HOA KHAI TRƯƠNG ĐẠI CÁT',3,'',970000,0,'ke-hoa-khai-truong-dai-cat.jpg','Cần đặt trước',0,0,NULL,NULL),(36,'KỆ HOA KHAI TRƯƠNG PHÁT ĐẠT',3,'',1900000,0,'ke-hoa-khai-truong-phat-dat.jpg','Cần đặt trước',0,0,NULL,NULL),(37,'KỆ HOA CHÚC MỪNG TẤN TIẾN',3,'',1080000,0,'ke-hoa-chuc-mung-tan-tien.jpg','Cần đặt trước',0,0,NULL,NULL),(38,'CHÚC THÀNH CÔNG 1',3,'',980000,850000,'chuc-thanh-cong.jpg','Cần đặt trước',1,0,NULL,NULL),(39,'SỨC SỐNG',3,'',1150000,0,'suc-song.jpg','Cần đặt trước',0,0,NULL,NULL),(40,'HOA CHÚC MỪNG HỒNG PHÁT',3,'',1760000,0,'hoa-chuc-mung-hong-phat.jpg','Cần đặt trước',0,0,NULL,NULL),(41,'HOA TANG LỄ DÒNG THỜI GIAN',4,'',1510000,1400000,'dong-thoi-gian.jpg','Cần đặt trước',1,0,NULL,NULL),(42,'YÊN NGHỈ',4,'',1510000,0,'yen-nghi.jpg','Cần đặt trước',0,0,NULL,NULL),(43,'VÒNG HOA TANG LỄ THIÊN THU 1',4,'',1570000,0,'thien-thu.jpg','Cần đặt trước',1,0,NULL,NULL),(44,'HOA CHIA BUỒN VÔ THƯỜNG',4,'',1040000,0,'vo-thuong.jpg','Cần đặt trước',1,0,NULL,NULL),(45,'HOA CHIA BUỒN THIÊN ĐÀNG',4,'',1510000,0,'thien-dang.jpg','Cần dặt trước',1,0,NULL,NULL),(46,'VÒNG HOA TANG LỄ THIÊN THU',4,'',2860000,2690000,'thien-thu-1.jpg','Cần đặt trước',1,0,NULL,NULL),(47,'VÒNG HOA TANG LỄ NGUYỆN CẦU',4,'',1270000,0,'nguyen-cau.jpg','Cần đặt trước',0,0,NULL,NULL),(48,'HOA CHIA BUỒN KÝ ỨC',4,'',4000000,3800000,'ky-uc.jpg','Cần đặt trước',0,0,NULL,NULL),(49,'HOA CHI BUỒN LY BIỆT',4,'',1420000,0,'ly-biet.jpg','Cần đặt trước',0,0,NULL,NULL),(50,'LỜI GIÃ TỪ',4,'',2440000,2300000,'loi-gia-tu.jpg','Cần đặt trước',0,0,NULL,NULL),(51,'CHUNG ĐÔI',6,'',1040000,1000000,'chung-doi.jpg','Cần đặt trước',0,0,NULL,NULL),(52,'RIÊNG MÌNH EM',6,'',590000,0,'rieng-minh-em.jpg','Cần đặt trước',0,0,NULL,NULL),(53,'GIỎ HOA CHÀO XUÂN',6,'',1140000,1000000,'gio-hoa-chao-xuan.jpg','Cần đặt trước',0,0,NULL,NULL),(55,'DUY NHẤT',6,'',590000,0,'duy-nhat.jpg','Cần đặt trước',0,0,NULL,NULL),(56,'CHÚC THÀNH CÔNG',6,'',1270000,1110000,'chuc-thanh-cong.jpg','Cần đặt trước',0,0,NULL,NULL),(57,'HƯƠNG TÌNH YÊU',6,'',720000,0,'huong-tinh-yeu.jpg','Cần đặt trước',0,0,NULL,NULL),(60,'HOA CHIA BUỒN ĐỒNG CẢM',4,'Đồng cảm với người th&acirc;n gia đ&igrave;nh c&oacute; người đ&atilde; khuất',2640000,0,'2YpC_hoa-chia-buon-dong-cam.jpg','Không có sẵn',0,0,'2021-07-16 22:29:06','2021-07-16 22:29:06');

/*Table structure for table `slide` */

DROP TABLE IF EXISTS `slide`;

CREATE TABLE `slide` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `slide` */

insert  into `slide`(`id`,`link`,`image`) values (1,NULL,'banner-hoa.jpg'),(2,NULL,'banner-hoa1.jpg'),(3,NULL,'banner-hoa2.jpg'),(4,NULL,'banner-hoa3.jpg');

/*Table structure for table `type_product` */

DROP TABLE IF EXISTS `type_product`;

CREATE TABLE `type_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `delete` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `type_product` */

insert  into `type_product`(`id`,`name`,`description`,`delete`,`created_at`,`updated_at`) values (1,'Hoa Cưới','hoa cho cô dâu',0,'2021-07-09 00:00:00','2021-07-15 21:20:03'),(2,'Hoa Sinh Nhật','hoa cho sinh nhật',0,'2021-07-09 00:00:00','2021-07-15 22:22:23'),(3,'Hoa Khai Trương','',0,'2021-07-09 00:00:00','2021-07-09 00:00:00'),(4,'Hoa Tang Lễ','',0,'2021-07-12 00:00:00','2021-07-15 22:45:13'),(6,'Hoa Tươi','',0,'2021-07-09 00:00:00','2021-07-15 22:45:06'),(12,'Hoa hậu','Hoa hậu',1,'2021-07-15 19:25:56','2021-07-15 19:25:56');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `power` tinyint(1) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`full_name`,`email`,`password`,`phone`,`address`,`power`,`remember_token`,`created_at`,`updated_at`) values (5,'Nguyễn Văn Thanh','phubui2702@gmail.com','$2y$10$5I/sGAXJ/aGYQ/RK.fynyOWNHWyP6B480FoJRTlmIeM6opjWL1M.2','0937790683','127- đường số 7, phường 3, Gò Vấp, Tp. HCM',1,NULL,'2021-07-15','2021-07-15'),(6,'admin','admin@localhost.com','$2y$10$PYtdVkNwq/i1Z.SK2WAqHeQUgMKwxcgZEg7xEhbywFfNNaSO/ZNlS','0937790683','71/11, Chu Văn An, p26, Q. Bình Thạnh, tp.HCM',1,NULL,'2021-07-15','2021-07-15');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
