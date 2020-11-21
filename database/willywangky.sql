-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2020 at 09:45 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `willywangky`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id_product` int(11) NOT NULL,
  `product_name` text COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `amount_sold` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `image_path` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id_product`, `product_name`, `price`, `amount_sold`, `stock`, `description`, `image_path`) VALUES
(1, 'Dark Chocolate', '30000.00', 2, 3, 'Dark chocolate atau cokelat hitam memiliki rasa yang agak pahit. Pahitnya rasa cokelat jenis ini karena terbuat dari 65 persen biji kakao. Selain itu, dark chocolate juga mengandung mineral dan antioksidan yang baik untuk tubuh. ', 'database/photos/darkchocolate.jpg'),
(2, 'Plain White Chocolate', '45000.00', 3, 9, 'White Chocolate atau cokelat putih terdiri dari kandungan cokelat batangan putih, cocoa butter, lemak cokelat, gula, susu, dan vanilla. Komposisi yang paling dominan adalah vanilla dan gula.', 'database/photos/plainwhitechocolate.jpg'),
(3, 'Great Value White Chocolate', '60000.00', 3, 10, 'Premium White Chocolate dengan kandungan vanilla dan susu lebih banyak dari white chocolate biasa. Cocok untuk membuat berbagai kudapan manis.', 'database/photos/greatvaluewhitechocolate.jpg'),
(4, 'Classic Milk Chocolate', '20000.00', 6, 19, 'Milk chocolate biasa. Rasanya manis seperti cokelat pada umumnya.', 'database/photos/classicmilkchocolate.jpg'),
(5, 'Lindo Milk Chocolate', '40000.00', 0, 12, 'Sesuai namanya, milk chocolate memiliki kandungan tambahan susu, minyak nabati, gula, vanila, dan pasta cokelat alami. Digemari karena rasanya yang manis.', 'database/photos/lindomilkchocolate.jpg'),
(6, 'Greentea Choco', '75000.00', 7, 4, 'Best seller greentea chocolate from Japan. Perpaduan biji cocoa dan daun teh hijau menghasilkan kombinasi kelezatan yang sempurna.', 'database/photos/greenteachocolate.jpg'),
(13, 'Almond Chocolate', '40000.00', 0, 15, 'Coklat dengan kacang', 'database/photos/almondchocolate.jpg'),
(14, 'Strawberry Chocolate', '35000.00', 0, 20, 'Coklat dengan strawberry nikmat', 'database/photos/strawberrychocolate.jpg'),
(15, 'Pink Kitkat', '60000.00', 0, 5, 'Kitkat dengan rasa coklat stroberi', 'database/photos/pink-kitkat.jpg'),
(16, 'Kinder Bueno', '100000.00', 0, 50, 'Kinder Joy', 'database/photos/kinder-bueno.jpg'),
(17, 'Baking Chocolate', '40000.00', 0, 10, 'Coklat buat baking', 'database/photos/bakingchocolate.jpg'),
(18, 'Hershey', '35000.00', 0, 20, 'Coklat Hershey', 'database/photos/hershey.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id_transaction` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `amount_purchased` int(11) NOT NULL,
  `total_price` decimal(20,2) NOT NULL,
  `date_purchased` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `address` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id_transaction`, `id_product`, `id_user`, `amount_purchased`, `total_price`, `date_purchased`, `address`) VALUES
(1, 6, 2, 1, '75000.00', '2020-10-24 10:52:10', 'Taman Holis'),
(2, 2, 3, 2, '90000.00', '2020-10-24 10:52:10', 'Jl. Ganesha'),
(3, 3, 3, 3, '180000.00', '2020-10-24 10:52:10', 'Bandung'),
(4, 5, 2, 1, '40000.00', '2020-10-24 13:25:00', 'Cisitu'),
(5, 5, 2, 1, '40000.00', '2020-10-23 03:55:10', 'Cisitu Indah'),
(6, 1, 2, 1, '30000.00', '2020-10-24 14:35:00', 'Lembang'),
(7, 2, 3, 1, '45000.00', '2020-10-24 15:58:45', 'Jakarta');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `token` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `email`, `pass`, `category`, `token`) VALUES
(1, 'claryms', 'clarymorgenstern@gmail.com', 'morgenstern', 'superuser', '33207ebdb05c61891ff837a15a1ccf5266f63dd24c'),
(2, 'jacehd', 'jacehd@gmail.com', 'herondale', 'user', '1322caac08dfadc10a8a9d036ec9a848b4844f507e'),
(3, 'isabellalw', 'isabellalw@gmail.com', 'lightwood', 'user', 'd8d2972cc193ab59933c69ec5895772b06e590fa51'),
(4, 'aleclw', 'aleclightwood@gmail.com', 'lightwood2', 'user', 'b1d8ecc62e0d157fed579e4ffea54270'),
(5, 'magnusbane', 'magnusbane@gmail.com', 'bane', 'user', '7896bbc387c28f7201dfdfe9c7b36989'),
(9, 'jonathanm', 'jonathanm10@gmail.com', 'morgenstern2', 'user', '4f775d63a02cc574faf647bbd083f3ac'),
(10, 'simonsimon', 'simon_01@gmail.com', 'saimen', 'user', '70df7ab0acf02a3fa119cb4bca37b868');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id_transaction`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id_transaction` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
