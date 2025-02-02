-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 02 fév. 2025 à 21:39
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bytebazaar`
--

-- --------------------------------------------------------

--
-- Structure de la table `accounts`
--

CREATE TABLE `accounts` (
  `aid` int(11) NOT NULL,
  `afname` varchar(100) NOT NULL,
  `alname` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `username` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `accounts`
--

INSERT INTO `accounts` (`aid`, `afname`, `alname`, `phone`, `email`, `dob`, `username`, `gender`, `password`) VALUES
(5, 'adil', 'chagri', '+212770498924', 'adilchagri7@gmail.com', '2023-05-03', 'admin1', 'M', 'admin123'),
(14, 'laraib', 'akhtar', '16050920011', 'jbelchouaib@gmail.com', '2023-05-02', 'jbel', 'M', '12345678'),
(21, 'adil', 'chagri', '+212770498926', 'thealiendesigner@gmail.com', '2004-11-03', 'alien1', 'M', 'alien123@alien');

-- --------------------------------------------------------

--
-- Structure de la table `cart`
--

CREATE TABLE `cart` (
  `aid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `cqty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comment_text` text NOT NULL,
  `timestamp` datetime DEFAULT current_timestamp(),
  `aid` int(11) NOT NULL,
  `is_approved` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_text`, `timestamp`, `aid`, `is_approved`) VALUES
(3, 'adil', '2025-02-02 17:44:14', 14, 1),
(4, 'adil', '2025-02-02 18:53:30', 14, 1),
(5, 'good website', '2025-02-02 19:12:22', 21, 1);

-- --------------------------------------------------------

--
-- Structure de la table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `subject`, `message`, `created_at`) VALUES
(1, 'adil chagri', 'adilchagri7@gmail.com', 'remarque', 'ahvbisbckibk', '2025-02-02 19:59:41');

-- --------------------------------------------------------

--
-- Structure de la table `order-details`
--

CREATE TABLE `order-details` (
  `oid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `order-details`
--

INSERT INTO `order-details` (`oid`, `pid`, `qty`) VALUES
(17, 35, 5);

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `oid` int(11) NOT NULL,
  `dateod` date NOT NULL,
  `datedel` date DEFAULT NULL,
  `aid` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(50) NOT NULL,
  `country` varchar(100) NOT NULL,
  `account` char(16) DEFAULT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`oid`, `dateod`, `datedel`, `aid`, `address`, `city`, `country`, `account`, `total`) VALUES
(17, '2023-05-15', '2023-05-15', 14, 'Faisal town b block', 'Lahore', 'Pakistan', NULL, 375);

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `pid` int(11) NOT NULL,
  `pname` varchar(100) NOT NULL,
  `category` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `price` int(11) NOT NULL,
  `qtyavail` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `brand` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`pid`, `pname`, `category`, `description`, `price`, `qtyavail`, `img`, `brand`) VALUES
(27, 'Core i5 3570', 'cpu', 'Attention all tech enthusiasts! Upgrade your computer performance with the powerful i5 3570 processor! Built on Intel Ivy Bridge architecture, this quad-core processor boasts a base clock speed of 3.4', 250, 10, 'x14.jpeg', 'Intel'),
(30, 'Razer BlackWidow V4 Pro', 'keyboard', ' Take your gaming experience to the next level with the Razer BlackWidow V4 Pro! This mechanical gaming keyboard features Razer signature green switches, providing tactile feedback and optimized actua', 370, 15, 'x3.jpeg', 'Razor'),
(31, 'Hp Gaming Mouse M160', 'mouse', ' Dominate your opponents with the HP Gaming Mouse M160! This high-performance mouse features six programmable buttons and a high-precision optical sensor, allowing for quick and accurate movements in ', 130, 19, 'x5.jpeg', 'Hp'),
(32, 'Asus  Motherboard B450', 'motherboard', 'Upgrade your rig with the ASUS B450 motherboard! This motherboard features an AM4 socket that supports AMD Ryzen processors, providing you with the power you need for intense gaming and multitasking. ', 230, 12, 'x15.jpeg', 'Asus'),
(33, 'Ryzen 7 3700x ', 'cpu', 'Experience lightning-fast performance with the AMD Ryzen 7 3700X processor! With 8 cores and 16 threads, this processor delivers unrivaled speed and processing power for demanding tasks, including gam', 350, 7, 'x6.jpeg', 'Ryzen'),
(34, 'Nvidia GTX 1660Ti GPU', 'gpu', 'Take your PC experience to the next level with the NVIDIA GeForce GTX 1660 Ti graphics card! This high-performance graphics card features NVIDIA Turing architecture and 6GB of GDDR6 memory, providing ', 160, 5, 'x9.jpeg', 'Nvidia'),
(35, 'HyperX Fury Ram 16GB', 'ram', 'Upgrade your PC performance with HyperX Fury RAM! With speeds of up to 3200MHz and capacities ranging from 8GB to 64GB, HyperX Fury RAM is the perfect choice for anyone looking to improve their PC mul', 76, 3, '71GJY5+c14L._SY450_.jpg', 'HyperX'),
(36, 'Geforce RTX 4080 16GB', 'gpu', 'The NVIDIA GeForce RTX 4080 delivers the ultra performance and features that enthusiast gamers and creators demand. Bring your games and creative projects to life with ray tracing and AI-powered graph', 550, 12, 'lol.jpeg', 'Nvidia'),
(37, 'Asus Rog Strix B550-E', 'motherboard', 'Gamers and PC enthusiasts, elevate your build with the ASUS ROG Strix B550-E Gaming motherboard! Designed with performance in mind, this high-end motherboard features the latest PCIe 4.0 technology, a', 380, 3, 'rog.jpeg', 'Asus'),
(38, 'MageGee Mechanical Gaming Keyboard', 'keyboard', 'Upgrade your gaming setup with the MageGee Mechanical Gaming Keyboard. Built with high-quality and durable materials, this keyboard features mechanical switches that provide a tactile and satisfying t', 270, 6, 'no.jpeg', 'MageGee'),
(39, 'Intel Core i9-10900K 3.7 GHz ', 'cpu', 'Experience the ultimate performance with the Intel Core i9-10900K 3.7 GHz processor. With 10 cores and 20 threads, this high-end processor delivers blazing-fast speeds and unparalleled multitasking ca', 470, 15, 'i.jpeg', 'Intel'),
(40, 'Redragon Gaming Mouse', 'mouse', ' Take your gaming to the next level with the RedDragon gaming mouse. This high-performance gaming mouse features an ergonomic design with customizable RGB lighting, making it not only comfortable to u', 140, 5, 'red.jpeg', 'Redragon'),
(41, 'Razer Cynosa V2 RGB Gaming Keyboard ', 'keyboard', ' The Razer Cynosa V2 RGB Gaming Keyboard is a must-have accessory for any avid gamer looking to take their gaming experience to the next level. With its fully customizable RGB lighting, you can create', 160, 8, 'r.jpeg', 'Razor'),
(42, 'Glorious Model O Gaming Mouse', 'mouse', 'The Glorious Model O is a gaming mouse that is built to deliver superior performance, accuracy, and speed to gamers of all levels. With its sleek and ergonomic design, this mouse is designed to fit co', 140, 8, 'g.jpeg', 'Glorious'),
(43, 'Geforce RTX 3080 12GB Zotac', 'gpu', 'The GeForce RTX 3080 12GB Zotac is a high-performance graphics card designed for gamers and professionals who require the best in graphical processing power. This graphics card is powered by the NVIDI', 370, 4, 'Rtx.jpeg', 'Nvidia');

-- --------------------------------------------------------

--
-- Structure de la table `reviews`
--

CREATE TABLE `reviews` (
  `oid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `rtext` varchar(1000) DEFAULT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reviews`
--

INSERT INTO `reviews` (`oid`, `pid`, `rtext`, `rating`) VALUES
(17, 35, ' a very good product nice and fast...', 4);

-- --------------------------------------------------------

--
-- Structure de la table `wishlist`
--

CREATE TABLE `wishlist` (
  `aid` int(11) NOT NULL,
  `pid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`aid`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Index pour la table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`aid`,`pid`),
  ADD KEY `cartfk2` (`pid`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `aid` (`aid`);

--
-- Index pour la table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `order-details`
--
ALTER TABLE `order-details`
  ADD PRIMARY KEY (`oid`,`pid`),
  ADD KEY `orderdtfk2` (`pid`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`oid`),
  ADD KEY `ordersfk` (`aid`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`);

--
-- Index pour la table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`oid`,`pid`),
  ADD KEY `reviewsfk2` (`pid`);

--
-- Index pour la table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`aid`,`pid`),
  ADD KEY `wishlistfk2` (`pid`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cartfk1` FOREIGN KEY (`aid`) REFERENCES `accounts` (`aid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cartfk2` FOREIGN KEY (`pid`) REFERENCES `products` (`pid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`aid`) REFERENCES `accounts` (`aid`) ON DELETE CASCADE;

--
-- Contraintes pour la table `order-details`
--
ALTER TABLE `order-details`
  ADD CONSTRAINT `orderdtfk1` FOREIGN KEY (`oid`) REFERENCES `orders` (`oid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderdtfk2` FOREIGN KEY (`pid`) REFERENCES `products` (`pid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `ordersfk` FOREIGN KEY (`aid`) REFERENCES `accounts` (`aid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviewsfk1` FOREIGN KEY (`oid`) REFERENCES `orders` (`oid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reviewsfk2` FOREIGN KEY (`pid`) REFERENCES `products` (`pid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlistfk1` FOREIGN KEY (`aid`) REFERENCES `accounts` (`aid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wishlistfk2` FOREIGN KEY (`pid`) REFERENCES `products` (`pid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
