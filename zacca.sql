-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2024-07-05 15:27:52
-- サーバのバージョン： 10.4.32-MariaDB
-- PHP のバージョン: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `zacca`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `cart`
--

CREATE TABLE `cart` (
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'アクセサリー'),
(2, 'インテリア雑貨'),
(3, 'キッチン雑貨'),
(4, 'ステーショナリー'),
(5, 'その他雑貨');

-- --------------------------------------------------------

--
-- テーブルの構造 `contacts`
--

CREATE TABLE `contacts` (
  `contact_id` int(11) NOT NULL,
  `contact_name` varchar(50) NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `contact_tel` varchar(13) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `favorites`
--

CREATE TABLE `favorites` (
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_name` varchar(100) NOT NULL,
  `order_zipcode` varchar(8) NOT NULL,
  `order_address` varchar(255) NOT NULL,
  `order_building` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `orders_detail`
--

CREATE TABLE `orders_detail` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_price` int(6) NOT NULL,
  `product_description` text DEFAULT NULL,
  `product_img_num` int(2) NOT NULL DEFAULT 0,
  `pickup` int(1) NOT NULL DEFAULT 0,
  `category_id` int(2) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_price`, `product_description`, `product_img_num`, `pickup`, `category_id`, `created_at`) VALUES
(1, '2個の花のピアス', 3000, 'アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。\r\nアイテム説明が入ります。アイテム説明が入ります。', 4, 1, 1, '2024-03-04 00:00:00'),
(2, 'プレートピアス', 800, 'アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。', 1, 0, 1, '2024-03-06 00:00:00'),
(3, 'ブレスレット', 2000, 'アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。', 1, 1, 1, '2024-03-07 00:00:00'),
(4, 'カトラリーセット', 1500, 'アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。\r\nアイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。', 1, 0, 3, '2024-03-08 00:00:00'),
(5, 'レトロな時計', 2500, 'アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。', 1, 0, 2, '2024-03-09 00:00:00'),
(6, 'フォトフレーム', 2200, 'アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。', 1, 1, 5, '2024-03-10 00:00:00'),
(7, 'ペンケース', 1200, 'アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。', 1, 0, 4, '2024-03-11 00:00:00'),
(8, 'ビーズのピアス', 1600, 'アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。', 1, 1, 1, '2024-03-13 00:00:00'),
(9, '北欧柄の水筒', 2000, 'アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。', 0, 0, 3, '2024-03-14 00:00:00'),
(10, 'ポッド', 3000, 'アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。', 0, 0, 2, '2024-03-14 00:00:00'),
(11, 'カレンダー', 1600, 'アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。', 0, 0, 4, '2024-03-15 00:00:00'),
(12, 'ガラスの花瓶', 2400, 'アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。', 0, 0, 2, '2024-03-17 00:00:00'),
(13, 'ビーズのネックレス', 3300, 'アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。', 0, 0, 1, '2024-03-18 00:00:00'),
(14, 'スマホケース', 1500, 'アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。', 0, 0, 4, '2024-03-20 00:00:00'),
(15, 'キルティングリュック', 5500, 'アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。', 0, 0, 5, '2024-03-23 00:00:00'),
(16, 'かごバッグ', 4800, 'アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。', 0, 0, 5, '2024-03-24 00:00:00'),
(17, 'コーヒーミル', 7000, 'アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。', 0, 0, 3, '2024-03-24 00:00:00'),
(18, '北欧柄の水筒', 2500, 'アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。', 0, 1, 3, '2024-03-25 00:00:00'),
(19, 'スマホケース', 3300, 'アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。アイテム説明が入ります。', 0, 0, 5, '2024-03-25 00:00:00'),
(20, 'スマホスタンド', 3600, NULL, 0, 0, 5, '2024-04-15 19:14:28'),
(21, 'コースター', 1200, NULL, 0, 0, 2, '2024-04-15 19:15:50'),
(22, 'ドライフラワー', 2400, NULL, 0, 0, 2, '2024-04-15 19:15:50'),
(23, 'テーブルランプ', 7200, NULL, 0, 0, 2, '2024-04-15 19:59:52');

-- --------------------------------------------------------

--
-- テーブルの構造 `products_detail`
--

CREATE TABLE `products_detail` (
  `product_id` int(5) NOT NULL,
  `type_id` int(1) NOT NULL,
  `type_name` varchar(10) NOT NULL DEFAULT 'none',
  `quantity` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `products_detail`
--

INSERT INTO `products_detail` (`product_id`, `type_id`, `type_name`, `quantity`) VALUES
(1, 1, 'ベージュ', 94),
(1, 2, 'ホワイト', 97),
(2, 1, 'ナシ', 100),
(3, 1, 'ナシ', 96),
(4, 1, 'ブラウン', 90),
(4, 2, 'ナチュラル', 0),
(5, 1, 'ナシ', 100),
(6, 1, 'ナシ', 98),
(7, 1, 'ナシ', 96),
(8, 1, 'ナシ', 100),
(9, 1, 'ナシ', 100),
(10, 1, 'ナシ', 100),
(11, 1, 'ナシ', 100),
(12, 1, 'ナシ', 100),
(13, 1, 'ナシ', 100),
(14, 1, 'ナシ', 100),
(15, 1, 'ナシ', 100),
(16, 1, 'ナシ', 100),
(17, 1, 'ナシ', 100),
(18, 1, 'イエロー', 94),
(18, 2, 'ホワイト', 100),
(19, 1, 'ベージュ', 97),
(19, 2, 'ブラウン', 100),
(20, 1, 'シルバー', 0),
(20, 2, 'ホワイト', 0),
(21, 1, 'ナシ', 0),
(22, 1, 'イエロー', 100),
(22, 2, 'ピンク', 0),
(22, 3, 'ブルー', 0),
(23, 1, 'ゴールド', 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `user_id` int(5) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name_kana` varchar(50) NOT NULL,
  `first_name_kana` varchar(50) NOT NULL,
  `gender` int(1) NOT NULL,
  `year` int(4) NOT NULL,
  `month` int(2) NOT NULL,
  `day` int(2) NOT NULL,
  `zipcode` varchar(7) NOT NULL,
  `prefecture` int(2) NOT NULL,
  `city` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `building` varchar(100) NOT NULL,
  `tel` varchar(13) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`user_id`, `email`, `pwd`, `last_name`, `first_name`, `last_name_kana`, `first_name_kana`, `gender`, `year`, `month`, `day`, `zipcode`, `prefecture`, `city`, `address`, `building`, `tel`, `created_at`) VALUES
(1, 'sample@example.com', '$2y$10$vGAOoQ5SE5xwPPL1jegwc.UCIHP6VqoujUN2OpuMI6KJFuyJyoAua', '佐藤', '美咲', 'さとう', 'みさき', 2, 1994, 9, 20, '160-000', 8, '新宿区', '新宿0-0-0', '', '070-0000-0000', '2024-07-05 21:03:11');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`user_id`,`product_id`,`type_id`),
  ADD KEY `prod_id` (`product_id`);

--
-- テーブルのインデックス `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- テーブルのインデックス `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`contact_id`);

--
-- テーブルのインデックス `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`user_id`,`product_id`),
  ADD KEY `prod_id` (`product_id`,`user_id`) USING BTREE;

--
-- テーブルのインデックス `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- テーブルのインデックス `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD PRIMARY KEY (`order_id`,`product_id`,`type_id`),
  ADD KEY `product_id` (`product_id`,`type_id`);

--
-- テーブルのインデックス `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- テーブルのインデックス `products_detail`
--
ALTER TABLE `products_detail`
  ADD PRIMARY KEY (`product_id`,`type_id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- テーブルの AUTO_INCREMENT `contacts`
--
ALTER TABLE `contacts`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- テーブルの制約 `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `favorites_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- テーブルの制約 `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- テーブルの制約 `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD CONSTRAINT `orders_detail_ibfk_3` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_detail_ibfk_4` FOREIGN KEY (`product_id`,`type_id`) REFERENCES `products_detail` (`product_id`, `type_id`);

--
-- テーブルの制約 `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- テーブルの制約 `products_detail`
--
ALTER TABLE `products_detail`
  ADD CONSTRAINT `products_detail_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
