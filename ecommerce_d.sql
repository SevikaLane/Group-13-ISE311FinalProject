-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 02 Oca 2025, 20:03:15
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `ecommerce_d`
--

-- --------------------------------------------------------



CREATE TABLE `carts` (
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `carts` (`user_id`, `product_id`, `quantity`) VALUES
(1, 1, 9),
(1, 2, 6);



CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`) VALUES
(1, 'Çantalar', NULL),
(2, 'Yemek Kapları', NULL),
(3, 'Su Şişeleri', NULL),
(4, 'Çadırlar', NULL),
(5, 'Sırt Çantaları', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `productcategories`
--

CREATE TABLE `productcategories` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `productcategories`
--

INSERT INTO `productcategories` (`product_id`, `category_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `producttable`
--

CREATE TABLE `producttable` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `producttable` (`id`, `name`, `description`, `price`, `image`, `stock`, `created_at`, `updated_at`, `category_id`) VALUES
(1, 'Outdoor Sırt Çantası', '10L - Mor - NH Arpenaz 50.', 220.00, 'a.jpg', 50, '2024-12-01', '2024-11-30 21:00:00', 1),
(2, 'Isı Yalıtımlı Yemek Kabı', 'Siyah - 0,5L.', 595.99, 'b.jpg', 30, '2024-12-02', '2024-12-01 21:00:00', 2),
(3, 'Su Geçirmez Çanta', '3L-100 Sunset.', 299.99, 'c.jpg', 20, '2024-12-03', '2024-12-02 21:00:00', 1),
(4, 'Outdoor Sırt Çantası', '10L - Siyah - 0,5L.', 199.99, 'd.jpg', 25, '2024-12-04', '2024-12-03 21:00:00', 1),
(5, 'Su Şişesi', 'Hafif ve BPA içermeyen şişe.', 49.99, 'e.jpg', 100, '2024-12-05', '2024-12-04 21:00:00', 3),
(6, 'Çadır', '4 kişilik su geçirmez çadır.', 499.99, 'f.jpg', 15, '2024-12-06', '2024-12-05 21:00:00', 4),
(7, 'Sırt Çantası', 'Laptop bölmeli sırt çantası.', 149.99, 'g.jpg', 40, '2024-12-07', '2024-12-06 21:00:00', 5),
(8, 'El Feneri', 'Suya dayanıklı el feneri.', 59.99, 'h.jpg', 60, '2024-12-08', '2024-12-07 21:00:00', 1),
(9, 'Kamp Ocağı', 'Taşınabilir kamp ocağı.', 149.99, 'i.jpg', 20, '2024-12-11', '2024-12-10 21:00:00', 4),
(10, 'Kamp Sandalyesi', 'Katlanabilir hafif sandalye.', 99.99, 'j.jpg', 50, '2024-12-12', '2024-12-11 21:00:00', 5),
(11, 'Dürbün', 'Gece görüşlü dürbün.', 249.99, 'k.jpg', 10, '2024-12-13', '2024-12-12 21:00:00', 4),
(12, 'Termos', 'Paslanmaz çelik termos.', 129.99, 'l.jpg', 30, '2024-12-14', '2024-12-13 21:00:00', 3),
(13, 'Kamp Tenceresi', 'Celik kamp tenceresi.', 99.99, 'm.jpg', 40, '2024-12-15', '2024-12-14 21:00:00', 2),
(14, 'Yuzme Gozlugu', 'Anti-sis ozellikli gozluk.', 49.99, 'n.jpg', 100, '2024-12-16', '2024-12-15 21:00:00', 3),
(15, 'Dalis Paleti', 'Esnek dalis paleti.', 159.99, 'o.jpg', 30, '2024-12-17', '2024-12-16 21:00:00', 4),
(16, 'Snorkel', 'Konforlu agizlik snorkel.', 69.99, 'p.jpg', 80, '2024-12-18', '2024-12-17 21:00:00', 4),
(17, 'Dagci Ceketi', 'Su gecirmez hafif ceket.', 349.99, 'q.jpg', 20, '2024-12-19', '2024-12-18 21:00:00', 5),
(18, 'Kamp Lambasi', 'Genis isik yayan lamba.', 129.99, 'r.jpg', 30, '2024-12-20', '2024-12-19 21:00:00', 2),
(19, 'Tirmanis Halati', 'Dayanikli tirmanis halati.', 249.99, 's.jpg', 15, '2024-12-21', '2024-12-20 21:00:00', 2),
(20, 'Kayak Gozlugu', 'Buhar onleyici kayak gozlugu.', 199.99, 't.jpg', 25, '2024-12-21', '2024-12-20 21:00:00', 3),
(21, 'Fitness Eldiveni', 'Nefes alabilir fitness eldiveni.', 59.99, 'u.jpg', 50, '2024-12-21', '2024-12-20 21:00:00', 2),
(22, 'Dalis Saati', 'Su gecirmez dalis saati.', 299.99, 'v.jpg', 10, '2024-12-21', '2024-12-20 21:00:00', 3),
(23, 'Kamp Hamak', 'Naylon malzemeden kamp hamak.', 99.99, 'w.jpg', 20, '2024-12-21', '2024-12-20 21:00:00', 4);





CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `users` (`id`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'emre', '$2y$10$MId7MqpmZN8uMDVuS4jxqONBQwut5b49FaIbabuxCtTeUh9JoLYrO', '0000-00-00', '2025-01-01 16:07:40'),
(2, 'doruk', '$2y$10$0Ab2nNJpUCt7dwFOrliQh.Ujc/VZe7va1IBmTZTJYejt95GASCs7u', '0000-00-00', '2025-01-01 16:07:40'),
(3, 'merve', '$2y$10$PFPowKCuW3XbMzg5WLKjKuoUIiXlWnJjc5AZhfwyTECr5p02tOplu', '0000-00-00', '2025-01-01 16:07:40'),
(4, 'sevika', '$2y$10$pbOKvcujWxUQvOrc1G31.eYES6k0EhRdI1SDW1ToD3kI2Q6kUdns.', '0000-00-00', '2025-01-01 16:07:40');




ALTER TABLE `carts`
  ADD PRIMARY KEY (`user_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);


ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`);

ALTER TABLE `productcategories`
  ADD KEY `product_id` (`product_id`),
  ADD KEY `category_id` (`category_id`);


ALTER TABLE `producttable`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);


ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;


ALTER TABLE `producttable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;


ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;


ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `producttable` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;


ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;


ALTER TABLE `productcategories`
  ADD CONSTRAINT `productcategories_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `producttable` (`id`),
  ADD CONSTRAINT `productcategories_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);


ALTER TABLE `producttable`
  ADD CONSTRAINT `producttable_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
