-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: willywangky
-- ------------------------------------------------------
-- Server version	8.0.19

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `addstock`
--

DROP TABLE IF EXISTS `addstock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `addstock` (
  `id_addstock` int NOT NULL AUTO_INCREMENT,
  `id_product` int DEFAULT NULL,
  `amount` int DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_addstock`),
  KEY `id_product` (`id_product`),
  CONSTRAINT `addstock_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `product` (`id_product`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `addstock`
--

LOCK TABLES `addstock` WRITE;
/*!40000 ALTER TABLE `addstock` DISABLE KEYS */;
INSERT INTO `addstock` VALUES (1,1,10,'Delivered'),(2,2,30,'Delivered'),(3,3,10,'Pending'),(4,6,15,'Delivered'),(5,5,10,'Delivered'),(6,10,10,'Delivered'),(7,1,10,'Pending'),(8,2,2,'Delivered'),(9,2,3,'Delivered');
/*!40000 ALTER TABLE `addstock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product` (
  `id_product` int NOT NULL AUTO_INCREMENT,
  `product_name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `amount_sold` int NOT NULL,
  `stock` int NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image_path` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_product`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,'Dark Chocolate',30000.00,4,1,'Dark chocolate atau cokelat hitam memiliki rasa yang agak pahit. Pahitnya rasa cokelat jenis ini karena terbuat dari 65 persen biji kakao. Selain itu, dark chocolate juga mengandung mineral dan antioksidan yang baik untuk tubuh. ','database/photos/darkchocolate.jpg'),(2,'Plain White Chocolate',45000.00,10,13,'White Chocolate atau cokelat putih terdiri dari kandungan cokelat batangan putih, cocoa butter, lemak cokelat, gula, susu, dan vanilla. Komposisi yang paling dominan adalah vanilla dan gula.','database/photos/plainwhitechocolate.jpg'),(3,'Great Value White Chocolate',60000.00,3,40,'Premium White Chocolate dengan kandungan vanilla dan susu lebih banyak dari white chocolate biasa. Cocok untuk membuat berbagai kudapan manis.','database/photos/greatvaluewhitechocolate.jpg'),(4,'Classic Milk Chocolate',20000.00,6,20,'Milk chocolate biasa. Rasanya manis seperti cokelat pada umumnya.','database/photos/classicmilkchocolate.jpg'),(5,'Lindo Milk Chocolate',40000.00,0,12,'Sesuai namanya, milk chocolate memiliki kandungan tambahan susu, minyak nabati, gula, vanila, dan pasta cokelat alami. Digemari karena rasanya yang manis.','database/photos/lindomilkchocolate.jpg'),(6,'Greentea Choco',75000.00,7,10,'Best seller greentea chocolate from Japan. Perpaduan biji cocoa dan daun teh hijau menghasilkan kombinasi kelezatan yang sempurna.','database/photos/greenteachocolate.jpg'),(7,'Almond Chocolate',40000.00,2,13,'Coklat dengan kacang','database/photos/almondchocolate.jpg'),(8,'Strawberry Chocolate',35000.00,10,15,'Coklat dengan strawberry nikmat','database/photos/strawberrychocolate.jpg'),(9,'Pink Kitkat',60000.00,1,4,'Kitkat dengan rasa coklat stroberi','database/photos/pink-kitkat.jpg'),(10,'Kinder Bueno',100000.00,3,47,'Kinder Joy','database/photos/kinder-bueno.jpg'),(11,'Baking Chocolate',40000.00,0,10,'Coklat buat baking','database/photos/bakingchocolate.jpg'),(12,'Hershey',35000.00,0,20,'Coklat Hershey','database/photos/hershey.jpg'),(13,'Chocoo',100000.00,0,0,'Yummy','database/photos/chocochips.jpg');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transaction` (
  `id_transaction` int NOT NULL AUTO_INCREMENT,
  `id_product` int NOT NULL,
  `id_user` int NOT NULL,
  `amount_purchased` int NOT NULL,
  `total_price` decimal(20,2) NOT NULL,
  `date_purchased` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `address` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_transaction`),
  KEY `id_product` (`id_product`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `product` (`id_product`),
  CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction`
--

LOCK TABLES `transaction` WRITE;
/*!40000 ALTER TABLE `transaction` DISABLE KEYS */;
INSERT INTO `transaction` VALUES (17,9,3,1,60000.00,'2020-11-29 10:50:44','Bandung');
/*!40000 ALTER TABLE `transaction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `token` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'claryms','clarymorgenstern@gmail.com','morgenstern','superuser','26439ac8e9b3cd255ce108883df1271db066f1f7cb'),(2,'jacehd','jacehd@gmail.com','herondale','user','a097da3d5e406abf9a3332c4d53ec484d9881fc18a'),(3,'isabellalw','isabellalw@gmail.com','lightwood','user','ba58cfd066dca393539983d95727289c59053c881f'),(4,'aleclw','aleclightwood@gmail.com','lightwood2','user','b1d8ecc62e0d157fed579e4ffea54270'),(5,'magnusbane','magnusbane@gmail.com','bane','user','7896bbc387c28f7201dfdfe9c7b36989'),(9,'jonathanm','jonathanm10@gmail.com','morgenstern2','user','4f775d63a02cc574faf647bbd083f3ac'),(10,'simonsimon','simon_01@gmail.com','saimen','user','70df7ab0acf02a3fa119cb4bca37b868'),(11,'abcdef','abcdefgmail.com','abcd','user',NULL),(12,'xyz','xyz@gmail.com','1234','user',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-11-29 17:52:24
