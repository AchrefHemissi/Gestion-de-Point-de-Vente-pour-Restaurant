-- Database: `if0_36253541_glicious`

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";




CREATE TABLE `cartebancaire` (
  `id` int(11) NOT NULL,
  `numero` varchar(16) DEFAULT NULL,
  `montant` decimal(10,2) DEFAULT NULL,
  `code` int(3) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



INSERT INTO `cartebancaire` (`id`, `numero`, `montant`, `code`) VALUES
(1, '100100100', '999050.00', 123);


CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `date_commande` date DEFAULT NULL,
  `lieu` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `etat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO `commande` (`id`, `id_client`, `date_commande`, `lieu`, `etat`) VALUES
(1, 11, '2024-04-03', 'Beja', 0),
(2, 11, '2024-04-03', 'Tunis', 0),
(3, 2, '2024-04-03', 'denden', 0);



CREATE TABLE `ordproduit` (
  `id_commande` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `quantite` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO `ordproduit` (`id_commande`, `id_produit`, `quantite`) VALUES
(1, 9, 4),
(2, 4, 2),
(3, 3, 1),
(3, 7, 1),
(3, 8, 1);


CREATE TABLE `produit` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prix` float DEFAULT NULL,
  `vendu` int(11) DEFAULT NULL,
  `isdrink` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO `produit` (`id`, `name`, `prix`, `vendu`, `isdrink`) VALUES
(1, 'Pizza', 3, 0, 0),
(2, 'Spaghetti', 4.5, 0, 0),
(3, 'Hamburger', 11, 1, 0),
(4, 'Cheese cake', 15, 2, 0),
(5, 'Orange Juice', 7, 0, 1),
(6, 'Chawarma', 14, 0, 0),
(7, 'Fries', 7, 1, 0),
(8, 'Fried Chichen', 13, 1, 0),
(9, 'Mojito', 7, 4, 1),
(10, 'Tiramisu', 10, 0, 0);



CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pass` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `etat` int(1) DEFAULT NULL,
  `is_admin` int(11) DEFAULT NULL,
  `num_tel` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `email`, `pass`, `etat`, `is_admin`, `num_tel`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', '$2y$10$HddkCy5ua/yki23uaAhMNOKxsZ.GbwXOp9gtDhOSiEjmCujeWRedC', 0, 1, 0),
(2, 'Mohammed Achref', 'Hemissi', 'achref.hemissi@gmail.com', '$2y$10$6z9z2ohdRoirCl6EtSR.Q.o0wOf./mblVqT4IvAK0aUWEYYkEMS9.', 0, 0, 12121212),
(11, 'Dhia', 'Medini', 'medini@gmail.com', '$2y$10$eXNAHZkVwNxGkG4ROrSYYOXxkp7qnQg2nJMu5jQJHoEy7HDlHl2RS', 0, 0, 34563456);


ALTER TABLE `cartebancaire`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `numero` (`numero`);

ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_commande_client` (`id_client`);


ALTER TABLE `ordproduit`
  ADD PRIMARY KEY (`id_commande`,`id_produit`),
  ADD KEY `fk_ordproduit_produit` (`id_produit`);


ALTER TABLE `produit`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);



ALTER TABLE `commande`
  ADD CONSTRAINT `fk_commande_client` FOREIGN KEY (`id_client`) REFERENCES `utilisateur` (`id`);


ALTER TABLE `ordproduit`
  ADD CONSTRAINT `fk_ordproduit_commande` FOREIGN KEY (`id_commande`) REFERENCES `commande` (`id`),
  ADD CONSTRAINT `fk_ordproduit_produit` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id`);
COMMIT;
