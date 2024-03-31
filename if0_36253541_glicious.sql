-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql206.infinityfree.com
-- Generation Time: Mar 29, 2024 at 07:50 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_36253541_glicious`
--

-- --------------------------------------------------------

--
-- Table structure for table `cartebancaire`
--

CREATE TABLE `cartebancaire` (
  `id` int(11) NOT NULL ,
  `numero` varchar(16) DEFAULT NULL,
  `montant` decimal(10,2) DEFAULT NULL,
  `code` int(3) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
insert into `cartebancaire` (`id`, `numero`, `montant`, `code`) values
(1, '1234567891234567', 1000, 123),



-- --------------------------------------------------------

--
-- Table structure for table `commande`
--

CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `date_commande` date DEFAULT NULL,
  `lieu` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `etat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `commande`
--

INSERT INTO `commande` (`id`, `id_client`, `date_commande`, `lieu`, `etat`) VALUES
(1, 1, '2024-03-24', NULL, NULL);

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
(1, 2, 1),
(1, 9, 10);

-- --------------------------------------------------------

--
-- Table structure for table `produit`
--

CREATE TABLE `produit` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
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
(3, 'Hamburger', 11, 11, 0),
(4, 'Cheese cake', 15, 5, 0),
(5, 'Orange Juice', 7, 0, 1),
(6, 'Chawarma', 14, 30, 0),
(7, 'Fries', 7, 4, 0),
(8, 'Fried Chichen', 13, 6, 0),
(9, 'Detox', 7, 0, 1),
(10, 'Tiramisu', 10, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pass` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `etat` int(1) DEFAULT NULL,
  `is_admin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `email`, `pass`, `etat`, `is_admin`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', '$2y$10$HddkCy5ua/yki23uaAhMNOKxsZ.GbwXOp9gtDhOSiEjmCujeWRedC', 0, 1),
(2, 'Mohammed Achref', 'Hemissi', 'achref.hemissi@gmail.com', '$2y$10$6z9z2ohdRoirCl6EtSR.Q.o0wOf./mblVqT4IvAK0aUWEYYkEMS9.', 0, 0),
(3, 'dhia', 'medeni', 'dhia@gmail.com', '$2y$10$et9R8h5iWsBIRs3bJjHUuOkT15bAJV41Go./BqpfahOepB6xyd1Bi', 1, 0),
(4, 'sami', 'bey', 'amine.hemissi2007@gmail.com', '$2y$10$fgdiw3LiCpyfVv87yKP1ZONynw4RnPyc01vG6AHS5cds9DSg6nkqi', 1, 0),
(5, 'Dhia ', 'Medini', 'meddhia310@gmail.com', '$2y$10$h.sH8ebC4n9OmMNiMmuXven2d1P4X/amZQIT8m6tD8KvziqPFP4/q', 0, 0),
(6, 'Dhia', 'Medini', 'a@a.com', '$2y$10$xLHPzxVOPzdxmmy58SKBV.MhlzHiuXdp0Akmdvkd0HLNP4SwQIep.', 0, 0),
(7, 'ben kalaia', 'mohamed sahbi', 'mohamedsahbi.benkalia@insat.ucar.tn', '$2y$10$7nYMwalDJ6daLuw7IN6Am.dy.0.ufSsTuDx9op66ZKFeWPQHc0s4i', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cartebancaire`
--
ALTER TABLE `cartebancaire`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `numero` (`numero`);

--
-- Indexes for table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_commande_client` (`id_client`);

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
-- Constraints for table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `fk_commande_client` FOREIGN KEY (`id_client`) REFERENCES `utilisateur` (`id`);

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
