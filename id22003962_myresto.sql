-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 27, 2024 at 03:51 PM
-- Server version: 10.5.20-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id22003962_myresto`
--

-- --------------------------------------------------------

--
-- Table structure for table `commande`
--

CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `date_commande` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `commande`
--

INSERT INTO `commande` (`id`, `id_client`, `date_commande`) VALUES
(1, 1, '2024-03-24');

-- --------------------------------------------------------

--
-- Table structure for table `ordproduit`
--

CREATE TABLE `ordproduit` (
  `id_commande` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `quantite` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ordproduit`
--

INSERT INTO `ordproduit` (`id_commande`, `id_produit`, `quantite`) VALUES
(1, 1, 4),
(1, 2, 1);

--
-- Triggers `ordproduit`
--
DELIMITER $$
CREATE TRIGGER `increment_vendu` BEFORE INSERT ON `ordproduit` FOR EACH ROW BEGIN
    UPDATE produit
    SET vendu = vendu + NEW.quantite
    WHERE id = NEW.id_produit;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `produit`
--

CREATE TABLE `produit` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `prix` float DEFAULT NULL,
  `vendu` int(11) DEFAULT NULL,
  `isdrink` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `produit`
--

INSERT INTO `produit` (`id`, `name`, `prix`, `vendu`, `isdrink`) VALUES
(1, 'Pizza', 3, 4, 0),
(2, 'Spaghetti', 4.5, 1, 0),
(3, 'Humburger', 3, 4, 0),
(4, 'Cheese Cake', 4.5, 1, 0),
(5, 'Orange Juice', 3, 4, 0),
(6, 'Chawarma', 4.5, 1, 0),
(7, 'Fries', 4.5, 1, 0),
(8, 'Fried Chicken', 3, 4, 0),
(9, 'Mojito', 4.5, 1, 0),
(10, 'tiramisu', 3, 4, 0);


-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `etat` int(1) DEFAULT NULL,
  `is_admin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `email`, `pass`, `etat`, `is_admin`) VALUES
(1, 'Mohammed Achref', 'Hemissi', 'hemissi@gmail.com', '$2y$10$A8AMPZTWhbCmN28eWSRQx.rP1yT5BgbQ9mr7QkR9pfTaT0CNzpjaG', 0, 0),
(2, 'sahbi', 'ben kalaia', 'sahbi@gmail.com', '$2y$10$rC6qJb559xx7Zas7765TIe5pRU5cUySnpldCv/hG76pi6fj3C1RyC', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ordproduit`
--
ALTER TABLE `ordproduit`
  ADD PRIMARY KEY (`id_commande`,`id_produit`),
  ADD KEY `fk_ordproduit_produit` (`id_produit`);

--
-- Indexes for table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ordproduit`
--
ALTER TABLE `ordproduit`
  ADD CONSTRAINT `fk_ordproduit_commande` FOREIGN KEY (`id_commande`) REFERENCES `commande` (`id`),
  ADD CONSTRAINT `fk_ordproduit_produit` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
