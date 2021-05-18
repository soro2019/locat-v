-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 18 mai 2021 à 17:11
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.3.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `dblocativ`
--

-- --------------------------------------------------------

--
-- Structure de la table `attribution_sub_inventory`
--

CREATE TABLE `attribution_sub_inventory` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `id_inv` int(11) NOT NULL,
  `id_sub` int(11) NOT NULL,
  `date_create` int(11) NOT NULL,
  `starting_date` int(11) NOT NULL DEFAULT 0,
  `date_end` int(11) NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL COMMENT '1=terminé, 0=commencé, 2=continué, 3=validé -1=encours',
  `user_id_validator` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `attribution_sub_inventory`
--

INSERT INTO `attribution_sub_inventory` (`id`, `user_id`, `id_inv`, `id_sub`, `date_create`, `starting_date`, `date_end`, `status`, `user_id_validator`) VALUES
(1, 8, 1, 1, 1616913772, 1616914182, 1616931632, 3, 9),
(2, 8, 1, 2, 1616913772, 1616914306, 1616931692, 3, 9),
(3, 11, 1, 4, 1616913886, 1616914142, 1616931328, 3, 14),
(4, 8, 3, 4, 1617381354, 1617381451, 1617381623, 3, 9),
(5, 8, 4, 7, 1619606072, 1619606291, 1619606316, 1, NULL),
(6, 8, 4, 1, 1619606072, 1619606422, 1619606425, 1, NULL),
(7, 8, 4, 2, 1619606164, 1619606439, 1619606458, 1, NULL),
(8, 8, 4, 4, 1619606164, 1619606478, 1619606487, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `brands`
--

INSERT INTO `brands` (`id`, `name`, `description`) VALUES
(1, 'HUAWEI', NULL),
(2, 'SAMSUNG', NULL),
(3, 'TECNO', NULL),
(5, 'itel', '');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(55) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(4, '24 POSITION', ''),
(5, 'AGENDA', ''),
(6, 'AGRAFEUSE', ''),
(7, 'ARDOISE', ''),
(8, 'ARRACHE', ''),
(9, 'ART PLASTIQUE', ''),
(10, 'ATTACHE', ''),
(11, 'AUTOCOLLANT', ''),
(12, 'BEAUX-LIVRES', ''),
(13, 'BLOC NOTE', ''),
(14, 'BOITE GOUTER', ''),
(15, 'CALCULATRICE', ''),
(16, 'CARNET', ''),
(17, 'CARTE', ''),
(18, 'CARTON RIGIDE', ''),
(19, 'CARTONNEE', ''),
(20, 'CHAUSSURE', ''),
(21, 'CLASSEUR', ''),
(22, 'COLLE', ''),
(23, 'COPIE DOUBLE', ''),
(24, 'COUVERTURE', ''),
(25, 'COUVRE LIVRE', ''),
(26, 'CRAYON DE COULEUR', ''),
(27, 'CRAYON GRAPHITE', ''),
(28, 'DECO', ''),
(29, 'DESSEIN', ''),
(30, 'DICTIONNAIRE', ''),
(31, 'DIDACTIQUE', ''),
(32, 'EAU DE COLOGNE', ''),
(33, 'ECRITURE', ''),
(34, 'EDUCATIF', ''),
(35, 'EFFACEUR', ''),
(36, 'ELASTIQUE', ''),
(37, 'ENVELOPPE', ''),
(38, 'EPICES', ''),
(39, 'FEUILLE', ''),
(40, 'FICHES', ''),
(41, 'FIXE DOCUMENTS', ''),
(42, 'GEOMETRIE', ''),
(43, 'GOURDE', ''),
(44, 'JOUET', ''),
(45, 'JOURNAL', ''),
(46, 'JOURNAUX', ''),
(47, 'LINGETTES', ''),
(48, 'LIT', ''),
(49, 'LITTERATURE', ''),
(50, 'MAGAZINE', ''),
(51, 'PAPIER HYGIENIQUE', ''),
(52, 'PAPIER MINISTRE', ''),
(53, 'PARAPHEUR', ''),
(54, 'PARASCOLAIRE', ''),
(55, 'PELLICULEE', ''),
(56, 'POCHETTE', ''),
(57, 'POLYPRO', ''),
(58, 'PORTE CLE', ''),
(59, 'POST-IT', ''),
(60, 'POT', ''),
(61, 'PROFESSEUR', ''),
(62, 'PROTEGE', ''),
(63, 'PROTEGE DOCUMENT', ''),
(64, 'PUNAISE', ''),
(65, 'RAME', ''),
(66, 'RANGEMENT', ''),
(67, 'REGISTRE', ''),
(68, 'RELUIRE', ''),
(69, 'REPERTOIRE', ''),
(70, 'REVUE', ''),
(71, 'RUBAN DOUBLE', ''),
(72, 'SACS', ''),
(73, 'SCOLAIRE', ''),
(74, 'SERVIETTE', ''),
(75, 'TABLEAU', ''),
(76, 'TAILLE CRAYON', ''),
(77, 'TALC', ''),
(78, 'TEXTE', ''),
(79, 'TRANCHANT', ''),
(80, 'TROUSSE', ''),
(81, 'VERRE', ''),
(82, 'VETTEMENT', ''),
(83, '24-juin', ''),
(84, '26-juin', ''),
(85, '1 POCHE', ''),
(86, '1 TROU', ''),
(87, '10MM', ''),
(89, '10X14', ''),
(90, '11X16', ''),
(91, '11X17', ''),
(94, '11X22', ''),
(95, '12 chiffres', ''),
(96, '12 INDEX', ''),
(97, '12 POSITIONS', ''),
(98, '125X200', ''),
(99, '12CM', ''),
(100, '12MM', ''),
(101, '12X17', ''),
(102, '12X18', ''),
(104, '14 chiffres', ''),
(105, '148X210', ''),
(106, '14MM', ''),
(107, '14X21', ''),
(109, '15 FEUILLE', ''),
(110, '16X22', ''),
(112, '17X22', ''),
(121, '18 POSITIONS', ''),
(122, '18CM', ''),
(123, '19mmX33m', ''),
(124, '1POCHE', ''),
(125, '2 ANNEAUX', ''),
(126, '2 POCHES', ''),
(127, '2 TROU', ''),
(128, '20 FEUILLES', ''),
(129, '20ml', ''),
(130, '21CM', ''),
(131, '21X29', ''),
(141, '22X32', ''),
(142, '23X35', ''),
(143, '24 POSITIONS', ''),
(144, '24X31', ''),
(145, '24X32', ''),
(150, '25MM', ''),
(151, '2B', ''),
(152, '2H', ''),
(153, '2HB', ''),
(154, '30 FEUILLES', ''),
(155, '30X40', ''),
(156, '32MM', ''),
(157, '3B', ''),
(158, '4 ANNEAUX', ''),
(159, '45 FEUILLES', ''),
(160, '4B', ''),
(162, '4mm', ''),
(163, '50 FEUILLES', ''),
(165, '500 FEUILLES', ''),
(166, '5B', ''),
(167, '6 INDEX', ''),
(168, '60 PCS', ''),
(169, '65X100', ''),
(170, '6B', ''),
(171, '70X100', ''),
(172, '72PCS', ''),
(173, '76X76', ''),
(174, '9CM', ''),
(175, '9X13', ''),
(176, '9X14', ''),
(177, 'A3', ''),
(178, 'A4', ''),
(180, 'A4 5X5', ''),
(182, 'A5 5X5', ''),
(183, 'ACTIVITES', ''),
(186, 'ADHESIF', ''),
(192, 'ADHESIVE', ''),
(193, 'ADULTE', ''),
(198, 'ALLUMINIUM', ''),
(201, 'ALPHABETISATION', ''),
(203, 'ANGLAIS', ''),
(204, 'ANNALE', ''),
(206, 'AQUARELLE', ''),
(207, 'ASSORTIS', ''),
(211, 'AUTOCOLLANTS', ''),
(212, 'AVEC PERFO', ''),
(213, 'B12', ''),
(215, 'BANDE DESSINEE', ''),
(217, 'BATON', ''),
(218, 'BD', ''),
(220, 'BIBLE', ''),
(221, 'BILINGUE', ''),
(222, 'BIMENSUEL', ''),
(225, 'BIMESTRIEL', ''),
(226, 'BLANCHE', ''),
(228, 'BLANCO', ''),
(229, 'BOITE', ''),
(230, 'BRACELET', ''),
(232, 'BUREAU', ''),
(233, 'CALCULETTE', ''),
(234, 'CARTES DE VISITE', ''),
(235, 'CARTON', ''),
(236, 'CHEMISE', ''),
(238, 'CHIFFON', ''),
(239, 'CISEAUX', ''),
(240, 'COFFRET', ''),
(241, 'COLLEGE', ''),
(248, 'COLORIAGE', ''),
(249, 'COMMERCE', ''),
(250, 'COMMUNICATION', ''),
(251, 'COMPAS', ''),
(252, 'COMPTABILITE', ''),
(255, 'COMPTINE', ''),
(256, 'COMTABILITE', ''),
(258, 'CONTE', ''),
(260, 'CONTINE', ''),
(261, 'CORBEILLE', ''),
(263, 'CORRECTEUR', ''),
(264, 'COUR ELEMENTAIRE', ''),
(268, 'COUR MOYEN', ''),
(272, 'COUR PREPARATOIRE', ''),
(275, 'COURS MOYEN', ''),
(278, 'COURSE', ''),
(282, 'CRAIE', ''),
(283, 'CREATION', ''),
(284, 'CREPON', ''),
(285, 'CRITERIUM', ''),
(286, 'CROCHETS', ''),
(287, 'CUISINE', ''),
(289, 'CUTTER', ''),
(290, 'DECORATION', ''),
(291, 'DEV PERSONNEL', ''),
(292, 'DEVP PERSONNEL', ''),
(296, 'DIRECTION', ''),
(297, 'DOS', ''),
(298, 'DROIT', ''),
(301, 'DRONE', ''),
(305, 'EFFA\'SEC', ''),
(306, 'ELECTRONIQUE', ''),
(307, 'ENFANT', ''),
(309, 'ENTREPRENEURIAT', ''),
(310, 'EQUERRE', ''),
(311, 'ETIQUETTE', ''),
(312, 'FEUTRE', ''),
(313, 'FIGURINE', ''),
(314, 'FLUO', ''),
(315, 'FL?TE', ''),
(316, 'G/S', ''),
(317, 'Gar?on G', ''),
(318, 'GOMME', ''),
(319, 'GOMMET', ''),
(320, 'GOUACHE', ''),
(321, 'GOUTER', ''),
(322, 'GRAPHIQUE', ''),
(324, 'HB', ''),
(325, 'HEBDO', ''),
(326, 'HEBDOMADAIRE', ''),
(329, 'HS', ''),
(330, 'IMAGIER', ''),
(331, 'INCOLORE', ''),
(332, 'INFORMATIQUE', ''),
(333, 'JETON', ''),
(334, 'JEUNESSE', ''),
(339, 'KIT', ''),
(342, 'KRAFT', ''),
(345, 'LAINE', ''),
(348, 'LANGUE', ''),
(353, 'LEXIQUE', ''),
(355, 'LIQUIDE', ''),
(356, 'LIVRE MUSIQUE', ''),
(357, 'LUMINEUX', ''),
(358, 'LYCEE', ''),
(360, 'M/S', ''),
(361, 'MAGGAZINE', ''),
(362, 'MANAGEMENT', ''),
(364, 'MANUEL', ''),
(365, 'MARIAGE', ''),
(366, 'MARKETING', ''),
(368, 'MARQUEUR', ''),
(369, 'MATERNELLE', ''),
(370, 'MATHEMATIQUE', ''),
(373, 'MENSUEL', ''),
(376, 'MINE', ''),
(377, 'MIXTE G', ''),
(378, 'MIXTE M', ''),
(379, 'MOUCHOIR', ''),
(380, 'MULTI-USAGE', ''),
(381, 'MUSIQUE', ''),
(382, 'NOIR', ''),
(383, 'OEUILLETS', ''),
(384, 'PALETTE', ''),
(386, 'PAPIER CALQUE', ''),
(387, 'PAPIER DESSIN', ''),
(388, 'PAPIER TOILETTE', ''),
(389, 'PATE', ''),
(390, 'P?TE A MODELER', ''),
(392, 'PAYSAGE', ''),
(393, 'PETITE ENFANCE', ''),
(398, 'PHILOSOPHIE', ''),
(401, 'PINCEAU', ''),
(402, 'PLASTIDECOR', ''),
(403, 'PLASTIQUE', ''),
(405, 'PLAYDOH', ''),
(409, 'POCHETTE DESSIN', ''),
(410, 'POCHETTE VUES', ''),
(411, 'PRESCOLAIRE', ''),
(418, 'PRIMAIRE', ''),
(425, 'PUZZLE', ''),
(426, 'QUOTIDIEN', ''),
(429, 'RAPPORTEUR', ''),
(430, 'REGLE', ''),
(433, 'RESSOURCES HUMAINES', ''),
(435, 'RLX A PEINDRE', ''),
(436, 'ROMAN', ''),
(437, 'ROULETTE', ''),
(439, 'RUBAN', ''),
(440, 'S/M', ''),
(441, 'S/S', ''),
(442, 'SANS PERFO', ''),
(445, 'SANTE', ''),
(447, 'SCIENTIFIQUE', ''),
(448, 'SECONDAIRE', ''),
(454, 'SPECIAL', ''),
(455, 'SPIRALE', ''),
(456, 'STATISTIQUE', ''),
(458, 'STYLO BILLE', ''),
(459, 'STYLO ROLLER', ''),
(460, 'TABLE', ''),
(462, 'TECHNIQUE', ''),
(467, 'TENUE SCOLAIRE', ''),
(469, 'TOILETTE', ''),
(470, 'TRANSPARENT', ''),
(472, 'TRIMESTRIEL', ''),
(475, 'TROLLEY', ''),
(476, 'VOYAGE', ''),
(880, 'JOUET EDUCATIF', 'Jouet educatif'),
(881, 'COSMETIQUE', 'Cosmétique'),
(882, 'JEUX DE SOCIETE', 'JEUX DE SOCIETE'),
(886, 'SCRABBLE', 'LIVRE+JEU SCRABBLE'),
(887, 'CARTES', 'JEUX DE CARTES'),
(888, 'ATLAS', 'ATLAS DU MONDE'),
(889, 'JEU DE SOCIÉTÉ ', 'JEU AVEC 2 OU PLUSIEURS JOUEURS'),
(891, 'EVEIL', 'HISTOIRE POUR TOUT PETIT'),
(892, 'ALBUM ILLUSTRE', 'HISTOIRE POUR ENFANT'),
(893, 'ALBUM COLORIAGE', 'LIVRE COLORIAGE'),
(894, 'LIVRE SONORE', 'LIVRE A MUSIQUES'),
(896, 'JEUX DE FAMILLE', 'JEUX DE CARTES'),
(897, 'QUIZ', 'JEUX DE CARTES'),
(898, '1ERE ENCYCLO', 'IMAGIER DE LA BIBLE'),
(899, 'LOISIR', 'DIVERTISSEMENT'),
(900, 'CADEAUX', 'A OFFRIR'),
(901, 'ALBUM FAMILLE', 'ALBUM');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `prenoms` varchar(255) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `contact_2` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `profession` varchar(255) NOT NULL,
  `date_naiss` date NOT NULL,
  `lieu_naiss` varchar(255) NOT NULL,
  `lieu_habitation` varchar(255) NOT NULL,
  `date_add` int(11) NOT NULL,
  `type_piece` int(1) NOT NULL COMMENT '1=CNI,2=Attestation,3=Passeport,4=Carte Consulaire;5=autre',
  `num_piece` varchar(50) NOT NULL,
  `IDDOSSIER` varchar(20) NOT NULL,
  `user` int(11) NOT NULL,
  `user_modif` int(11) NOT NULL,
  `date_modif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `full_name`, `prenoms`, `contact`, `contact_2`, `email`, `profession`, `date_naiss`, `lieu_naiss`, `lieu_habitation`, `date_add`, `type_piece`, `num_piece`, `IDDOSSIER`, `user`, `user_modif`, `date_modif`) VALUES
(1, 'SORO', 'LOHOYIRIMEH', '0779815420', '', 'sor@gmail.com', '', '2000-03-10', 'DALOA', 'Yopougon', 1615108780, 1, 'C02145879123', 'ID1', 12, 1, 1616911102);

-- --------------------------------------------------------

--
-- Structure de la table `details_vente`
--

CREATE TABLE `details_vente` (
  `id` int(11) NOT NULL,
  `idclient` int(11) NOT NULL,
  `idvente` int(11) NOT NULL,
  `versement` varchar(10) NOT NULL,
  `montant` int(11) NOT NULL,
  `echeance` date NOT NULL,
  `status` int(11) NOT NULL COMMENT '-1:retard, 0:en cours, 1:payé',
  `montant_penalite` int(11) NOT NULL,
  `date_paiement` int(11) NOT NULL,
  `user_encaisse` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `details_vente`
--

INSERT INTO `details_vente` (`id`, `idclient`, `idvente`, `versement`, `montant`, `echeance`, `status`, `montant_penalite`, `date_paiement`, `user_encaisse`) VALUES
(1, 1, 1, 'V1', 50000, '2021-03-28', 1, 0, 1616912803, 1),
(2, 1, 1, 'V2', 40000, '2021-04-28', 1, 0, 1616913526, 12),
(3, 1, 1, 'V3', 29000, '2021-05-28', 1, 0, 1619605105, 1),
(4, 1, 2, 'V1', 50000, '2021-04-02', 1, 0, 1617387012, 1),
(5, 1, 2, 'V2', 69000, '2021-04-02', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `format_dates`
--

CREATE TABLE `format_dates` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `format_date` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `format_dates`
--

INSERT INTO `format_dates` (`id`, `code`, `format_date`) VALUES
(1, 'd/m/Y', 'dd/mm/yyyy'),
(2, 'm-d-Y', 'mm-dd-yyyy'),
(3, 'm/d/Y', 'mm/dd/yyyy'),
(4, 'm.d.Y', 'mm.dd.yyyy'),
(5, 'd.m.Y', 'dd.mm.yyyy'),
(6, 'd-m-Y', 'dd-mm-yyyy');

-- --------------------------------------------------------

--
-- Structure de la table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'manager', 'Manager'),
(2, 'compteurs', 'Compteur'),
(3, 'validateur', 'Validateur'),
(6, 'vendeurs', 'les vendeurs uniquement'),
(8, 'promoteur', 'test');

-- --------------------------------------------------------

--
-- Structure de la table `inventory`
--

CREATE TABLE `inventory` (
  `id_inventory` int(11) NOT NULL,
  `nom_inventaire` varchar(500) NOT NULL,
  `des_inventaire` text DEFAULT NULL,
  `date_create` int(11) NOT NULL,
  `date_end` int(11) DEFAULT 0,
  `etat` tinyint(1) DEFAULT 0 COMMENT '0: not begin; 1: Inventaire terminé; 2: Validation en Cours; 3:Validation terminé. -1 : En cours d''inventaire,\r\n4:Archivé',
  `assigner` tinyint(1) NOT NULL COMMENT '-1=ona commencé l''assignation; 1=assignation terminé; 0= pas encore assigne\r\n',
  `exporter` tinyint(1) NOT NULL,
  `import_quantity` tinyint(4) NOT NULL DEFAULT 0,
  `nb_sub_fini` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `inventory`
--

INSERT INTO `inventory` (`id_inventory`, `nom_inventaire`, `des_inventaire`, `date_create`, `date_end`, `etat`, `assigner`, `exporter`, `import_quantity`, `nb_sub_fini`) VALUES
(1, 'Inventaire du mois de Mars', '', 1616913629, 1616931692, 4, 1, 0, 0, 3),
(3, 'Inventaire du mois d\'Avril', '', 1617381338, 1617381623, 4, 1, 0, 0, 1),
(4, 'Inventaire Avril', '', 1619605924, 1619606487, 1, 1, 0, 0, 4);

-- --------------------------------------------------------

--
-- Structure de la table `inventory_products`
--

CREATE TABLE `inventory_products` (
  `id` int(11) NOT NULL,
  `id_inv` int(11) NOT NULL,
  `id_sub` int(11) NOT NULL,
  `id_products` int(11) NOT NULL,
  `qte` int(7) NOT NULL,
  `created` int(11) NOT NULL,
  `etat` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=non validé, 1=validé, 3=encours'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `label` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `languages`
--

INSERT INTO `languages` (`id`, `code`, `label`) VALUES
(1, 'en', 'English'),
(2, 'fr', 'Français');

-- --------------------------------------------------------

--
-- Structure de la table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `permission`
--

CREATE TABLE `permission` (
  `id` int(11) NOT NULL,
  `group_id` tinyint(1) NOT NULL,
  `product-add` tinyint(1) NOT NULL,
  `product-list` tinyint(1) NOT NULL,
  `product-edit` tinyint(4) NOT NULL,
  `product-delete` int(11) NOT NULL,
  `product-export` int(11) NOT NULL,
  `product-import` tinyint(1) NOT NULL,
  `settings-system_settings` tinyint(1) NOT NULL,
  `settings-product_setting` tinyint(1) NOT NULL,
  `userManagement-list` tinyint(1) NOT NULL,
  `userManagement-add` tinyint(1) NOT NULL,
  `userManagement-edit` tinyint(4) NOT NULL,
  `userManagement-account_status` tinyint(4) NOT NULL,
  `userManagement-add_group` tinyint(4) NOT NULL,
  `userManagement-delete_group` tinyint(1) NOT NULL,
  `userManagement-edit_group` tinyint(4) NOT NULL,
  `userManagement-list_group` tinyint(1) NOT NULL,
  `userManagement-permission` tinyint(1) NOT NULL,
  `inventory-add` tinyint(1) NOT NULL,
  `inventory-list` tinyint(1) NOT NULL,
  `inventory-add_sub` tinyint(1) NOT NULL,
  `main-dashbord` tinyint(1) NOT NULL,
  `backups` tinyint(1) NOT NULL,
  `documentation` tinyint(1) NOT NULL,
  `inventory-assignment` tinyint(1) NOT NULL,
  `settings-categories` tinyint(4) NOT NULL DEFAULT 0,
  `settings-brands` tinyint(4) NOT NULL DEFAULT 0,
  `settings-warehouse` tinyint(4) NOT NULL,
  `settings-supplier` tinyint(4) NOT NULL,
  `inventory-list_sub` tinyint(1) NOT NULL DEFAULT 0,
  `inventory-edit` tinyint(4) NOT NULL,
  `inventory-delete` tinyint(4) NOT NULL,
  `inventory-export` tinyint(4) NOT NULL,
  `inventory-edit_sub` tinyint(4) NOT NULL,
  `inventory-view` tinyint(1) NOT NULL,
  `inventory-modifie-assigne` tinyint(1) NOT NULL DEFAULT 0,
  `userManagement-view` tinyint(1) NOT NULL DEFAULT 0,
  `inventory-assigne-validator` tinyint(1) NOT NULL,
  `inventory-qnt-import` tinyint(1) NOT NULL,
  `sell-add` int(11) NOT NULL,
  `sell-payments` int(11) NOT NULL,
  `sell-list` int(11) NOT NULL,
  `sell-add_client` int(11) NOT NULL,
  `sell-list_client` int(11) NOT NULL,
  `client-delete` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `permission`
--

INSERT INTO `permission` (`id`, `group_id`, `product-add`, `product-list`, `product-edit`, `product-delete`, `product-export`, `product-import`, `settings-system_settings`, `settings-product_setting`, `userManagement-list`, `userManagement-add`, `userManagement-edit`, `userManagement-account_status`, `userManagement-add_group`, `userManagement-delete_group`, `userManagement-edit_group`, `userManagement-list_group`, `userManagement-permission`, `inventory-add`, `inventory-list`, `inventory-add_sub`, `main-dashbord`, `backups`, `documentation`, `inventory-assignment`, `settings-categories`, `settings-brands`, `settings-warehouse`, `settings-supplier`, `inventory-list_sub`, `inventory-edit`, `inventory-delete`, `inventory-export`, `inventory-edit_sub`, `inventory-view`, `inventory-modifie-assigne`, `userManagement-view`, `inventory-assigne-validator`, `inventory-qnt-import`, `sell-add`, `sell-payments`, `sell-list`, `sell-add_client`, `sell-list_client`, `client-delete`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(2, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, 4, 0, 1, 0, 0, 0, 0, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5, 6, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 0),
(6, 7, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(7, 8, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `permission_on`
--

CREATE TABLE `permission_on` (
  `id` int(11) NOT NULL,
  `group_id` tinyint(1) NOT NULL,
  `product-add` tinyint(1) NOT NULL,
  `product-list` tinyint(1) NOT NULL,
  `product-import` tinyint(1) NOT NULL,
  `product-supp` tinyint(1) NOT NULL,
  `settings-system_settings` tinyint(1) NOT NULL,
  `settings-product_setting` tinyint(1) NOT NULL,
  `userManagement-list` tinyint(1) NOT NULL,
  `userManagement-add` tinyint(1) NOT NULL,
  `userManagement-permission` tinyint(1) NOT NULL,
  `inventory-add` tinyint(1) NOT NULL,
  `inventory-list` tinyint(1) NOT NULL,
  `inventory-add_sub` tinyint(1) NOT NULL,
  `inventory-delete_inventory` tinyint(1) NOT NULL,
  `inventory-list_sub` tinyint(1) NOT NULL,
  `inventory-delete_sub_inventory` tinyint(1) NOT NULL,
  `inventory-modification_inventory_assignation` tinyint(1) NOT NULL,
  `inventory-assignment` tinyint(1) NOT NULL,
  `main-dossier_de_inventaire` tinyint(1) NOT NULL,
  `main-description_production` tinyint(1) NOT NULL,
  `main-receptionForProduit` tinyint(1) NOT NULL,
  `main-commencescanne` tinyint(1) NOT NULL,
  `main-endInventaire` tinyint(1) NOT NULL,
  `main-disconnection` tinyint(1) NOT NULL,
  `main-valideinventaire` tinyint(1) NOT NULL,
  `main-validationinventaireByproduit` tinyint(1) NOT NULL,
  `main-corrections` tinyint(1) NOT NULL,
  `settings-categories` tinyint(4) NOT NULL DEFAULT 0,
  `settings-brands` tinyint(4) NOT NULL DEFAULT 0,
  `divers-categories` tinyint(1) NOT NULL,
  `divers-delete_categories` tinyint(1) NOT NULL,
  `divers-brand` tinyint(1) NOT NULL,
  `divers-delete_brand` tinyint(1) NOT NULL,
  `backups` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `permission_on`
--

INSERT INTO `permission_on` (`id`, `group_id`, `product-add`, `product-list`, `product-import`, `product-supp`, `settings-system_settings`, `settings-product_setting`, `userManagement-list`, `userManagement-add`, `userManagement-permission`, `inventory-add`, `inventory-list`, `inventory-add_sub`, `inventory-delete_inventory`, `inventory-list_sub`, `inventory-delete_sub_inventory`, `inventory-modification_inventory_assignation`, `inventory-assignment`, `main-dossier_de_inventaire`, `main-description_production`, `main-receptionForProduit`, `main-commencescanne`, `main-endInventaire`, `main-disconnection`, `main-valideinventaire`, `main-validationinventaireByproduit`, `main-corrections`, `settings-categories`, `settings-brands`, `divers-categories`, `divers-delete_categories`, `divers-brand`, `divers-delete_brand`, `backups`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `brand` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `qnt_appro` int(11) NOT NULL,
  `prix_vente` int(8) NOT NULL,
  `date_add` int(11) NOT NULL,
  `codeIdentification` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `brand`, `name`, `quantity`, `qnt_appro`, `prix_vente`, `date_add`, `codeIdentification`) VALUES
(1, 2, 'S20FE', 56, 10, 350000, 1613777441, 1611571866),
(2, 2, 'ZFOLD2', 62, 2, 1300000, 1613067394, 1613067394),
(3, 1, 'MATE PAT T18', 26, 15, 84000, 1615296148, 1615296148),
(4, 1, 'MEX 4758', 30, 7, 78000, 1619602511, 1615311086),
(5, 2, 'MEXX 3060', 5, 5, 80000, 1614367406, 1614367222);

-- --------------------------------------------------------

--
-- Structure de la table `products_by_vente`
--

CREATE TABLE `products_by_vente` (
  `id` int(11) NOT NULL,
  `emeil` varchar(250) NOT NULL,
  `vente` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `products_by_vente`
--

INSERT INTO `products_by_vente` (`id`, `emeil`, `vente`) VALUES
(1, 'EMEI75481230', 1),
(2, 'EMEI157892', 2);

-- --------------------------------------------------------

--
-- Structure de la table `product_on_inventory`
--

CREATE TABLE `product_on_inventory` (
  `id` int(11) NOT NULL,
  `id_products` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `ref` varchar(255) NOT NULL,
  `qntsoumise` int(11) NOT NULL,
  `qntcompter` int(11) NOT NULL,
  `qntvalider` int(11) NOT NULL,
  `id_inv` int(11) NOT NULL,
  `id_sub` int(11) NOT NULL,
  `id_counter` int(11) NOT NULL,
  `id_validator` int(11) NOT NULL,
  `date_add` int(11) NOT NULL,
  `datecompte` int(11) NOT NULL,
  `datevalidate` int(11) NOT NULL,
  `etat` tinyint(1) NOT NULL COMMENT '	0=non validé, 1=validé, 3=encours'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `product_on_inventory`
--

INSERT INTO `product_on_inventory` (`id`, `id_products`, `code`, `ref`, `qntsoumise`, `qntcompter`, `qntvalider`, `id_inv`, `id_sub`, `id_counter`, `id_validator`, `date_add`, `datecompte`, `datevalidate`, `etat`) VALUES
(1, 3, '1615296148', '', 26, 20, 0, 4, 7, 8, 0, 0, 1619606291, 0, 0),
(2, 4, '1615311086', '', 30, 35, 0, 4, 1, 8, 0, 0, 1619606422, 0, 0),
(3, 1, '1611571866', '', 56, 56, 0, 4, 2, 8, 0, 0, 1619606439, 0, 0),
(4, 2, '1613067394', '', 62, 60, 0, 4, 2, 8, 0, 0, 1619606456, 0, 0),
(5, 5, '1614367222', '', 5, 50, 0, 4, 4, 8, 0, 0, 1619606478, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `product_on_inventory_history`
--

CREATE TABLE `product_on_inventory_history` (
  `ID_HIST` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `id_products` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `ref` varchar(255) NOT NULL,
  `qntsoumise` int(11) NOT NULL,
  `qntcompter` int(11) NOT NULL,
  `qntvalider` int(11) NOT NULL,
  `id_inv` int(11) NOT NULL,
  `id_sub` int(11) NOT NULL,
  `id_counter` int(11) NOT NULL,
  `id_validator` int(11) NOT NULL,
  `date_add` int(11) NOT NULL,
  `datecompte` int(11) NOT NULL,
  `datevalidate` int(11) NOT NULL,
  `etat` tinyint(1) NOT NULL COMMENT '	0=non validé, 1=validé, 3=encours'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `product_on_inventory_history`
--

INSERT INTO `product_on_inventory_history` (`ID_HIST`, `id`, `id_products`, `code`, `ref`, `qntsoumise`, `qntcompter`, `qntvalider`, `id_inv`, `id_sub`, `id_counter`, `id_validator`, `date_add`, `datecompte`, `datevalidate`, `etat`) VALUES
(1, 1, 3, '1615296148', '', 27, 20, 20, 1, 4, 11, 14, 0, 1616914142, 1616930903, 1),
(2, 2, 4, '1615311086', '', 23, 10, 10, 1, 1, 8, 9, 0, 1616914182, 1616931571, 1),
(3, 3, 1, '1611571866', '', 56, 65, 60, 1, 4, 11, 14, 0, 1616914204, 1616931328, 1),
(4, 4, 2, '1613067394', '', 62, 10, 10, 1, 1, 8, 9, 0, 1616914287, 1616931632, 1),
(5, 5, 5, '1614367222', '', 8, 20, 20, 1, 2, 8, 9, 0, 1616914306, 1616931692, 1),
(6, 1, 3, '1615296148', '', 27, 12, 15, 3, 4, 8, 9, 0, 1617381451, 1617381594, 1),
(7, 2, 4, '1615311086', '', 23, 12, 12, 3, 4, 8, 9, 0, 1617381468, 1617381598, 1),
(8, 3, 5, '1614367222', '', 8, 12, 13, 3, 4, 8, 9, 0, 1617381486, 1617381605, 1),
(9, 4, 1, '1611571866', '', 56, 12, 13, 3, 4, 8, 9, 0, 1617381510, 1617381611, 1),
(10, 5, 2, '1613067394', '', 62, 10, 11, 3, 4, 8, 9, 0, 1617381524, 1617381623, 1);

-- --------------------------------------------------------

--
-- Structure de la table `product_settings`
--

CREATE TABLE `product_settings` (
  `id` int(11) NOT NULL,
  `code` tinyint(1) NOT NULL,
  `ref` tinyint(1) NOT NULL,
  `name` tinyint(1) NOT NULL,
  `category` tinyint(1) NOT NULL,
  `quantity` tinyint(1) NOT NULL,
  `brand` tinyint(1) NOT NULL,
  `supplier` tinyint(1) NOT NULL,
  `location` tinyint(1) NOT NULL,
  `price` tinyint(1) NOT NULL,
  `warehouse` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `product_settings`
--

INSERT INTO `product_settings` (`id`, `code`, `ref`, `name`, `category`, `quantity`, `brand`, `supplier`, `location`, `price`, `warehouse`) VALUES
(1, 1, 1, 1, 0, 0, 0, 0, 0, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `relationsubinv_inv`
--

CREATE TABLE `relationsubinv_inv` (
  `id` int(11) NOT NULL,
  `id_inventory` int(11) NOT NULL,
  `id_sub_inventory` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `relationsubinv_inv`
--

INSERT INTO `relationsubinv_inv` (`id`, `id_inventory`, `id_sub_inventory`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 4),
(4, 2, 7),
(5, 2, 1),
(6, 2, 2),
(7, 2, 4),
(8, 3, 4),
(9, 4, 7),
(10, 4, 1),
(11, 4, 2),
(12, 4, 4);

-- --------------------------------------------------------

--
-- Structure de la table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `system_name` varchar(255) NOT NULL,
  `format_date` varchar(255) NOT NULL,
  `time_zone` varchar(255) NOT NULL,
  `language` varchar(255) NOT NULL,
  `date_update` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `settings`
--

INSERT INTO `settings` (`id`, `system_name`, `format_date`, `time_zone`, `language`, `date_update`) VALUES
(1, 'E-boutique', 'Y-m-d', 'Africa/Abidjan', 'fr', 1611101670);

-- --------------------------------------------------------

--
-- Structure de la table `sub_inventory`
--

CREATE TABLE `sub_inventory` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text DEFAULT NULL,
  `date_create` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `sub_inventory`
--

INSERT INTO `sub_inventory` (`id`, `title`, `description`, `date_create`, `status`) VALUES
(1, 'Block E', '', 1600642875, 1),
(2, 'Bock A', NULL, 1600642875, 1),
(4, 'Bock C', NULL, 1600642875, 1),
(7, 'Block D', NULL, 1600642875, 1);

-- --------------------------------------------------------

--
-- Structure de la table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date_create` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `date_create`) VALUES
(1, 'SORO', 1593465710),
(2, 'BAMBA', 1600902687),
(3, 'JORDY', 1600902692);

-- --------------------------------------------------------

--
-- Structure de la table `timezones`
--

CREATE TABLE `timezones` (
  `timezone_id` int(10) UNSIGNED NOT NULL,
  `timezone_groupe_fr` varchar(50) DEFAULT NULL,
  `timezone_groupe_en` varchar(50) DEFAULT NULL,
  `timezone_detail` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `timezones`
--

INSERT INTO `timezones` (`timezone_id`, `timezone_groupe_fr`, `timezone_groupe_en`, `timezone_detail`) VALUES
(1, 'Afrique', 'Africa', 'Africa/Abidjan'),
(2, 'Afrique', 'Africa', 'Africa/Accra'),
(3, 'Afrique', 'Africa', 'Africa/Addis_Ababa'),
(4, 'Afrique', 'Africa', 'Africa/Algiers'),
(5, 'Afrique', 'Africa', 'Africa/Asmara'),
(6, 'Afrique', 'Africa', 'Africa/Asmera'),
(7, 'Afrique', 'Africa', 'Africa/Bamako'),
(8, 'Afrique', 'Africa', 'Africa/Bangui'),
(9, 'Afrique', 'Africa', 'Africa/Banjul'),
(10, 'Afrique', 'Africa', 'Africa/Bissau'),
(11, 'Afrique', 'Africa', 'Africa/Blantyre'),
(12, 'Afrique', 'Africa', 'Africa/Brazzaville'),
(13, 'Afrique', 'Africa', 'Africa/Bujumbura'),
(14, 'Afrique', 'Africa', 'Africa/Cairo'),
(15, 'Afrique', 'Africa', 'Africa/Casablanca'),
(16, 'Afrique', 'Africa', 'Africa/Ceuta'),
(17, 'Afrique', 'Africa', 'Africa/Conakry'),
(18, 'Afrique', 'Africa', 'Africa/Dakar'),
(19, 'Afrique', 'Africa', 'Africa/Dar_es_Salaam'),
(20, 'Afrique', 'Africa', 'Africa/Djibouti'),
(21, 'Afrique', 'Africa', 'Africa/Douala'),
(22, 'Afrique', 'Africa', 'Africa/El_Aaiun'),
(23, 'Afrique', 'Africa', 'Africa/Freetown'),
(24, 'Afrique', 'Africa', 'Africa/Gaborone'),
(25, 'Afrique', 'Africa', 'Africa/Harare'),
(26, 'Afrique', 'Africa', 'Africa/Johannesburg'),
(27, 'Afrique', 'Africa', 'Africa/Juba'),
(28, 'Afrique', 'Africa', 'Africa/Kampala'),
(29, 'Afrique', 'Africa', 'Africa/Khartoum'),
(30, 'Afrique', 'Africa', 'Africa/Kigali'),
(31, 'Afrique', 'Africa', 'Africa/Kinshasa'),
(32, 'Afrique', 'Africa', 'Africa/Lagos'),
(33, 'Afrique', 'Africa', 'Africa/Libreville'),
(34, 'Afrique', 'Africa', 'Africa/Lome'),
(35, 'Afrique', 'Africa', 'Africa/Luanda'),
(36, 'Afrique', 'Africa', 'Africa/Lubumbashi'),
(37, 'Afrique', 'Africa', 'Africa/Lusaka'),
(38, 'Afrique', 'Africa', 'Africa/Malabo'),
(39, 'Afrique', 'Africa', 'Africa/Maputo'),
(40, 'Afrique', 'Africa', 'Africa/Maseru'),
(41, 'Afrique', 'Africa', 'Africa/Mbabane'),
(42, 'Afrique', 'Africa', 'Africa/Mogadishu'),
(43, 'Afrique', 'Africa', 'Africa/Monrovia'),
(44, 'Afrique', 'Africa', 'Africa/Nairobi'),
(45, 'Afrique', 'Africa', 'Africa/Ndjamena'),
(46, 'Afrique', 'Africa', 'Africa/Niamey'),
(47, 'Afrique', 'Africa', 'Africa/Nouakchott'),
(48, 'Afrique', 'Africa', 'Africa/Ouagadougou'),
(49, 'Afrique', 'Africa', 'Africa/Porto-Novo'),
(50, 'Afrique', 'Africa', 'Africa/Sao_Tome'),
(51, 'Afrique', 'Africa', 'Africa/Timbuktu'),
(52, 'Afrique', 'Africa', 'Africa/Tripoli'),
(53, 'Afrique', 'Africa', 'Africa/Tunis'),
(54, 'Afrique', 'Africa', 'Africa/Windhoek'),
(55, 'Amérique', 'America', 'America/Adak'),
(56, 'Amérique', 'America', 'America/Anchorage'),
(57, 'Amérique', 'America', 'America/Anguilla'),
(58, 'Amérique', 'America', 'America/Antigua'),
(59, 'Amérique', 'America', 'America/Araguaina'),
(60, 'Amérique', 'America', 'America/Argentina/Buenos_Aires'),
(61, 'Amérique', 'America', 'America/Argentina/Catamarca'),
(62, 'Amérique', 'America', 'America/Argentina/ComodRivadavia'),
(63, 'Amérique', 'America', 'America/Argentina/Cordoba'),
(64, 'Amérique', 'America', 'America/Argentina/Jujuy'),
(65, 'Amérique', 'America', 'America/Argentina/La_Rioja'),
(66, 'Amérique', 'America', 'America/Argentina/Mendoza'),
(67, 'Amérique', 'America', 'America/Argentina/Rio_Gallegos'),
(68, 'Amérique', 'America', 'America/Argentina/Salta'),
(69, 'Amérique', 'America', 'America/Argentina/San_Juan'),
(70, 'Amérique', 'America', 'America/Argentina/San_Luis'),
(71, 'Amérique', 'America', 'America/Argentina/Tucuman'),
(72, 'Amérique', 'America', 'America/Argentina/Ushuaia'),
(73, 'Amérique', 'America', 'America/Aruba'),
(74, 'Amérique', 'America', 'America/Asuncion'),
(75, 'Amérique', 'America', 'America/Atikokan'),
(76, 'Amérique', 'America', 'America/Atka'),
(77, 'Amérique', 'America', 'America/Bahia'),
(78, 'Amérique', 'America', 'America/Bahia_Banderas'),
(79, 'Amérique', 'America', 'America/Barbados'),
(80, 'Amérique', 'America', 'America/Belem'),
(81, 'Amérique', 'America', 'America/Belize'),
(82, 'Amérique', 'America', 'America/Blanc-Sablon'),
(83, 'Amérique', 'America', 'America/Boa_Vista'),
(84, 'Amérique', 'America', 'America/Bogota'),
(85, 'Amérique', 'America', 'America/Boise'),
(86, 'Amérique', 'America', 'America/Buenos_Aires'),
(87, 'Amérique', 'America', 'America/Cambridge_Bay'),
(88, 'Amérique', 'America', 'America/Campo_Grande'),
(89, 'Amérique', 'America', 'America/Cancun'),
(90, 'Amérique', 'America', 'America/Caracas'),
(91, 'Amérique', 'America', 'America/Catamarca'),
(92, 'Amérique', 'America', 'America/Cayenne'),
(93, 'Amérique', 'America', 'America/Cayman'),
(94, 'Amérique', 'America', 'America/Chicago'),
(95, 'Amérique', 'America', 'America/Chihuahua'),
(96, 'Amérique', 'America', 'America/Coral_Harbour'),
(97, 'Amérique', 'America', 'America/Cordoba'),
(98, 'Amérique', 'America', 'America/Costa_Rica'),
(99, 'Amérique', 'America', 'America/Creston'),
(100, 'Amérique', 'America', 'America/Cuiaba'),
(101, 'Amérique', 'America', 'America/Curacao'),
(102, 'Amérique', 'America', 'America/Danmarkshavn'),
(103, 'Amérique', 'America', 'America/Dawson'),
(104, 'Amérique', 'America', 'America/Dawson_Creek'),
(105, 'Amérique', 'America', 'America/Denver'),
(106, 'Amérique', 'America', 'America/Detroit'),
(107, 'Amérique', 'America', 'America/Dominica'),
(108, 'Amérique', 'America', 'America/Edmonton'),
(109, 'Amérique', 'America', 'America/Eirunepe'),
(110, 'Amérique', 'America', 'America/El_Salvador'),
(111, 'Amérique', 'America', 'America/Ensenada'),
(112, 'Amérique', 'America', 'America/Fort_Wayne'),
(113, 'Amérique', 'America', 'America/Fortaleza'),
(114, 'Amérique', 'America', 'America/Glace_Bay'),
(115, 'Amérique', 'America', 'America/Godthab'),
(116, 'Amérique', 'America', 'America/Goose_Bay'),
(117, 'Amérique', 'America', 'America/Grand_Turk'),
(118, 'Amérique', 'America', 'America/Grenada'),
(119, 'Amérique', 'America', 'America/Guadeloupe'),
(120, 'Amérique', 'America', 'America/Guatemala'),
(121, 'Amérique', 'America', 'America/Guayaquil'),
(122, 'Amérique', 'America', 'America/Guyana'),
(123, 'Amérique', 'America', 'America/Halifax'),
(124, 'Amérique', 'America', 'America/Havana'),
(125, 'Amérique', 'America', 'America/Hermosillo'),
(126, 'Amérique', 'America', 'America/Indiana/Indianapolis'),
(127, 'Amérique', 'America', 'America/Indiana/Knox'),
(128, 'Amérique', 'America', 'America/Indiana/Marengo'),
(129, 'Amérique', 'America', 'America/Indiana/Petersburg'),
(130, 'Amérique', 'America', 'America/Indiana/Tell_City'),
(131, 'Amérique', 'America', 'America/Indiana/Vevay'),
(132, 'Amérique', 'America', 'America/Indiana/Vincennes'),
(133, 'Amérique', 'America', 'America/Indiana/Winamac'),
(134, 'Amérique', 'America', 'America/Indianapolis'),
(135, 'Amérique', 'America', 'America/Inuvik'),
(136, 'Amérique', 'America', 'America/Iqaluit'),
(137, 'Amérique', 'America', 'America/Jamaica'),
(138, 'Amérique', 'America', 'America/Jujuy'),
(139, 'Amérique', 'America', 'America/Juneau'),
(140, 'Amérique', 'America', 'America/Kentucky/Louisville'),
(141, 'Amérique', 'America', 'America/Kentucky/Monticello'),
(142, 'Amérique', 'America', 'America/Knox_IN'),
(143, 'Amérique', 'America', 'America/Kralendijk'),
(144, 'Amérique', 'America', 'America/La_Paz'),
(145, 'Amérique', 'America', 'America/Lima'),
(146, 'Amérique', 'America', 'America/Los_Angeles'),
(147, 'Amérique', 'America', 'America/Louisville'),
(148, 'Amérique', 'America', 'America/Lower_Princes'),
(149, 'Amérique', 'America', 'America/Maceio'),
(150, 'Amérique', 'America', 'America/Managua'),
(151, 'Amérique', 'America', 'America/Manaus'),
(152, 'Amérique', 'America', 'America/Marigot'),
(153, 'Amérique', 'America', 'America/Martinique'),
(154, 'Amérique', 'America', 'America/Matamoros'),
(155, 'Amérique', 'America', 'America/Mazatlan'),
(156, 'Amérique', 'America', 'America/Mendoza'),
(157, 'Amérique', 'America', 'America/Menominee'),
(158, 'Amérique', 'America', 'America/Merida'),
(159, 'Amérique', 'America', 'America/Metlakatla'),
(160, 'Amérique', 'America', 'America/Mexico_City'),
(161, 'Amérique', 'America', 'America/Miquelon'),
(162, 'Amérique', 'America', 'America/Moncton'),
(163, 'Amérique', 'America', 'America/Monterrey'),
(164, 'Amérique', 'America', 'America/Montevideo'),
(165, 'Amérique', 'America', 'America/Montreal'),
(166, 'Amérique', 'America', 'America/Montserrat'),
(167, 'Amérique', 'America', 'America/Nassau'),
(168, 'Amérique', 'America', 'America/New_York'),
(169, 'Amérique', 'America', 'America/Nipigon'),
(170, 'Amérique', 'America', 'America/Nome'),
(171, 'Amérique', 'America', 'America/Noronha'),
(172, 'Amérique', 'America', 'America/North_Dakota/Beulah'),
(173, 'Amérique', 'America', 'America/North_Dakota/Center'),
(174, 'Amérique', 'America', 'America/North_Dakota/New_Salem'),
(175, 'Amérique', 'America', 'America/Ojinaga'),
(176, 'Amérique', 'America', 'America/Panama'),
(177, 'Amérique', 'America', 'America/Pangnirtung'),
(178, 'Amérique', 'America', 'America/Paramaribo'),
(179, 'Amérique', 'America', 'America/Phoenix'),
(180, 'Amérique', 'America', 'America/Port-au-Prince'),
(181, 'Amérique', 'America', 'America/Port_of_Spain'),
(182, 'Amérique', 'America', 'America/Porto_Acre'),
(183, 'Amérique', 'America', 'America/Porto_Velho'),
(184, 'Amérique', 'America', 'America/Puerto_Rico'),
(185, 'Amérique', 'America', 'America/Rainy_River'),
(186, 'Amérique', 'America', 'America/Rankin_Inlet'),
(187, 'Amérique', 'America', 'America/Recife'),
(188, 'Amérique', 'America', 'America/Regina'),
(189, 'Amérique', 'America', 'America/Resolute'),
(190, 'Amérique', 'America', 'America/Rio_Branco'),
(191, 'Amérique', 'America', 'America/Rosario'),
(192, 'Amérique', 'America', 'America/Santa_Isabel'),
(193, 'Amérique', 'America', 'America/Santarem'),
(194, 'Amérique', 'America', 'America/Santiago'),
(195, 'Amérique', 'America', 'America/Santo_Domingo'),
(196, 'Amérique', 'America', 'America/Sao_Paulo'),
(197, 'Amérique', 'America', 'America/Scoresbysund'),
(198, 'Amérique', 'America', 'America/Shiprock'),
(199, 'Amérique', 'America', 'America/Sitka'),
(200, 'Amérique', 'America', 'America/St_Barthelemy'),
(201, 'Amérique', 'America', 'America/St_Johns'),
(202, 'Amérique', 'America', 'America/St_Kitts'),
(203, 'Amérique', 'America', 'America/St_Lucia'),
(204, 'Amérique', 'America', 'America/St_Thomas'),
(205, 'Amérique', 'America', 'America/St_Vincent'),
(206, 'Amérique', 'America', 'America/Swift_Current'),
(207, 'Amérique', 'America', 'America/Tegucigalpa'),
(208, 'Amérique', 'America', 'America/Thule'),
(209, 'Amérique', 'America', 'America/Thunder_Bay'),
(210, 'Amérique', 'America', 'America/Tijuana'),
(211, 'Amérique', 'America', 'America/Toronto'),
(212, 'Amérique', 'America', 'America/Tortola'),
(213, 'Amérique', 'America', 'America/Vancouver'),
(214, 'Amérique', 'America', 'America/Virgin'),
(215, 'Amérique', 'America', 'America/Whitehorse'),
(216, 'Amérique', 'America', 'America/Winnipeg'),
(217, 'Amérique', 'America', 'America/Yakutat'),
(218, 'Amérique', 'America', 'America/Yellowknife'),
(219, 'Antarctique', 'Antarctica', 'Antarctica/Casey'),
(220, 'Antarctique', 'Antarctica', 'Antarctica/Davis'),
(221, 'Antarctique', 'Antarctica', 'Antarctica/DumontDUrville'),
(222, 'Antarctique', 'Antarctica', 'Antarctica/Macquarie'),
(223, 'Antarctique', 'Antarctica', 'Antarctica/Mawson'),
(224, 'Antarctique', 'Antarctica', 'Antarctica/McMurdo'),
(225, 'Antarctique', 'Antarctica', 'Antarctica/Palmer'),
(226, 'Antarctique', 'Antarctica', 'Antarctica/Rothera'),
(227, 'Antarctique', 'Antarctica', 'Antarctica/South_Pole'),
(228, 'Antarctique', 'Antarctica', 'Antarctica/Syowa'),
(229, 'Antarctique', 'Antarctica', 'Antarctica/Vostok'),
(230, 'Arctique', 'Arctic', 'Arctic/Longyearbyen'),
(231, 'Asie', 'Asia', 'Asia/Aden'),
(232, 'Asie', 'Asia', 'Asia/Almaty'),
(233, 'Asie', 'Asia', 'Asia/Amman'),
(234, 'Asie', 'Asia', 'Asia/Anadyr'),
(235, 'Asie', 'Asia', 'Asia/Aqtau'),
(236, 'Asie', 'Asia', 'Asia/Aqtobe'),
(237, 'Asie', 'Asia', 'Asia/Ashgabat'),
(238, 'Asie', 'Asia', 'Asia/Ashkhabad'),
(239, 'Asie', 'Asia', 'Asia/Baghdad'),
(240, 'Asie', 'Asia', 'Asia/Bahrain'),
(241, 'Asie', 'Asia', 'Asia/Baku'),
(242, 'Asie', 'Asia', 'Asia/Bangkok'),
(243, 'Asie', 'Asia', 'Asia/Beirut'),
(244, 'Asie', 'Asia', 'Asia/Bishkek'),
(245, 'Asie', 'Asia', 'Asia/Brunei'),
(246, 'Asie', 'Asia', 'Asia/Calcutta'),
(247, 'Asie', 'Asia', 'Asia/Choibalsan'),
(248, 'Asie', 'Asia', 'Asia/Chongqing'),
(249, 'Asie', 'Asia', 'Asia/Chungking'),
(250, 'Asie', 'Asia', 'Asia/Colombo'),
(251, 'Asie', 'Asia', 'Asia/Dacca'),
(252, 'Asie', 'Asia', 'Asia/Damascus'),
(253, 'Asie', 'Asia', 'Asia/Dhaka'),
(254, 'Asie', 'Asia', 'Asia/Dili'),
(255, 'Asie', 'Asia', 'Asia/Dubai'),
(256, 'Asie', 'Asia', 'Asia/Dushanbe'),
(257, 'Asie', 'Asia', 'Asia/Gaza'),
(258, 'Asie', 'Asia', 'Asia/Harbin'),
(259, 'Asie', 'Asia', 'Asia/Hebron'),
(260, 'Asie', 'Asia', 'Asia/Ho_Chi_Minh'),
(261, 'Asie', 'Asia', 'Asia/Hong_Kong'),
(262, 'Asie', 'Asia', 'Asia/Hovd'),
(263, 'Asie', 'Asia', 'Asia/Irkutsk'),
(264, 'Asie', 'Asia', 'Asia/Istanbul'),
(265, 'Asie', 'Asia', 'Asia/Jakarta'),
(266, 'Asie', 'Asia', 'Asia/Jayapura'),
(267, 'Asie', 'Asia', 'Asia/Jerusalem'),
(268, 'Asie', 'Asia', 'Asia/Kabul'),
(269, 'Asie', 'Asia', 'Asia/Kamchatka'),
(270, 'Asie', 'Asia', 'Asia/Karachi'),
(271, 'Asie', 'Asia', 'Asia/Kashgar'),
(272, 'Asie', 'Asia', 'Asia/Kathmandu'),
(273, 'Asie', 'Asia', 'Asia/Katmandu'),
(274, 'Asie', 'Asia', 'Asia/Kolkata'),
(275, 'Asie', 'Asia', 'Asia/Krasnoyarsk'),
(276, 'Asie', 'Asia', 'Asia/Kuala_Lumpur'),
(277, 'Asie', 'Asia', 'Asia/Kuching'),
(278, 'Asie', 'Asia', 'Asia/Kuwait'),
(279, 'Asie', 'Asia', 'Asia/Macao'),
(280, 'Asie', 'Asia', 'Asia/Macau'),
(281, 'Asie', 'Asia', 'Asia/Magadan'),
(282, 'Asie', 'Asia', 'Asia/Makassar'),
(283, 'Asie', 'Asia', 'Asia/Manila'),
(284, 'Asie', 'Asia', 'Asia/Muscat'),
(285, 'Asie', 'Asia', 'Asia/Nicosia'),
(286, 'Asie', 'Asia', 'Asia/Novokuznetsk'),
(287, 'Asie', 'Asia', 'Asia/Novosibirsk'),
(288, 'Asie', 'Asia', 'Asia/Omsk'),
(289, 'Asie', 'Asia', 'Asia/Oral'),
(290, 'Asie', 'Asia', 'Asia/Phnom_Penh'),
(291, 'Asie', 'Asia', 'Asia/Pontianak'),
(292, 'Asie', 'Asia', 'Asia/Pyongyang'),
(293, 'Asie', 'Asia', 'Asia/Qatar'),
(294, 'Asie', 'Asia', 'Asia/Qyzylorda'),
(295, 'Asie', 'Asia', 'Asia/Rangoon'),
(296, 'Asie', 'Asia', 'Asia/Riyadh'),
(297, 'Asie', 'Asia', 'Asia/Saigon'),
(298, 'Asie', 'Asia', 'Asia/Sakhalin'),
(299, 'Asie', 'Asia', 'Asia/Samarkand'),
(300, 'Asie', 'Asia', 'Asia/Seoul'),
(301, 'Asie', 'Asia', 'Asia/Shanghai'),
(302, 'Asie', 'Asia', 'Asia/Singapore'),
(303, 'Asie', 'Asia', 'Asia/Taipei'),
(304, 'Asie', 'Asia', 'Asia/Tashkent'),
(305, 'Asie', 'Asia', 'Asia/Tbilisi'),
(306, 'Asie', 'Asia', 'Asia/Tehran'),
(307, 'Asie', 'Asia', 'Asia/Tel_Aviv'),
(308, 'Asie', 'Asia', 'Asia/Thimbu'),
(309, 'Asie', 'Asia', 'Asia/Thimphu'),
(310, 'Asie', 'Asia', 'Asia/Tokyo'),
(311, 'Asie', 'Asia', 'Asia/Ujung_Pandang'),
(312, 'Asie', 'Asia', 'Asia/Ulaanbaatar'),
(313, 'Asie', 'Asia', 'Asia/Ulan_Bator'),
(314, 'Asie', 'Asia', 'Asia/Urumqi'),
(315, 'Asie', 'Asia', 'Asia/Vientiane'),
(316, 'Asie', 'Asia', 'Asia/Vladivostok'),
(317, 'Asie', 'Asia', 'Asia/Yakutsk'),
(318, 'Asie', 'Asia', 'Asia/Yekaterinburg'),
(319, 'Asie', 'Asia', 'Asia/Yerevan'),
(320, 'Atlantique', 'Atlantic', 'Atlantic/Azores'),
(321, 'Atlantique', 'Atlantic', 'Atlantic/Bermuda'),
(322, 'Atlantique', 'Atlantic', 'Atlantic/Canary'),
(323, 'Atlantique', 'Atlantic', 'Atlantic/Cape_Verde'),
(324, 'Atlantique', 'Atlantic', 'Atlantic/Faeroe'),
(325, 'Atlantique', 'Atlantic', 'Atlantic/Faroe'),
(326, 'Atlantique', 'Atlantic', 'Atlantic/Jan_Mayen'),
(327, 'Atlantique', 'Atlantic', 'Atlantic/Madeira'),
(328, 'Atlantique', 'Atlantic', 'Atlantic/Reykjavik'),
(329, 'Atlantique', 'Atlantic', 'Atlantic/South_Georgia'),
(330, 'Atlantique', 'Atlantic', 'Atlantic/St_Helena'),
(331, 'Atlantique', 'Atlantic', 'Atlantic/Stanley'),
(332, 'Australie', 'Australia', 'Australia/ACT'),
(333, 'Australie', 'Australia', 'Australia/Adelaide'),
(334, 'Australie', 'Australia', 'Australia/Brisbane'),
(335, 'Australie', 'Australia', 'Australia/Broken_Hill'),
(336, 'Australie', 'Australia', 'Australia/Canberra'),
(337, 'Australie', 'Australia', 'Australia/Currie'),
(338, 'Australie', 'Australia', 'Australia/Darwin'),
(339, 'Australie', 'Australia', 'Australia/Eucla'),
(340, 'Australie', 'Australia', 'Australia/Hobart'),
(341, 'Australie', 'Australia', 'Australia/LHI'),
(342, 'Australie', 'Australia', 'Australia/Lindeman'),
(343, 'Australie', 'Australia', 'Australia/Lord_Howe'),
(344, 'Australie', 'Australia', 'Australia/Melbourne'),
(345, 'Australie', 'Australia', 'Australia/NSW'),
(346, 'Australie', 'Australia', 'Australia/North'),
(347, 'Australie', 'Australia', 'Australia/Perth'),
(348, 'Australie', 'Australia', 'Australia/Queensland'),
(349, 'Australie', 'Australia', 'Australia/South'),
(350, 'Australie', 'Australia', 'Australia/Sydney'),
(351, 'Australie', 'Australia', 'Australia/Tasmania'),
(352, 'Australie', 'Australia', 'Australia/Victoria'),
(353, 'Australie', 'Australia', 'Australia/West'),
(354, 'Australie', 'Australia', 'Australia/Yancowinna'),
(355, 'Europe', 'Europe', 'Europe/Amsterdam'),
(356, 'Europe', 'Europe', 'Europe/Andorra'),
(357, 'Europe', 'Europe', 'Europe/Athens'),
(358, 'Europe', 'Europe', 'Europe/Belfast'),
(359, 'Europe', 'Europe', 'Europe/Belgrade'),
(360, 'Europe', 'Europe', 'Europe/Berlin'),
(361, 'Europe', 'Europe', 'Europe/Bratislava'),
(362, 'Europe', 'Europe', 'Europe/Brussels'),
(363, 'Europe', 'Europe', 'Europe/Bucharest'),
(364, 'Europe', 'Europe', 'Europe/Budapest'),
(365, 'Europe', 'Europe', 'Europe/Chisinau'),
(366, 'Europe', 'Europe', 'Europe/Copenhagen'),
(367, 'Europe', 'Europe', 'Europe/Dublin'),
(368, 'Europe', 'Europe', 'Europe/Gibraltar'),
(369, 'Europe', 'Europe', 'Europe/Guernsey'),
(370, 'Europe', 'Europe', 'Europe/Helsinki'),
(371, 'Europe', 'Europe', 'Europe/Isle_of_Man'),
(372, 'Europe', 'Europe', 'Europe/Istanbul'),
(373, 'Europe', 'Europe', 'Europe/Jersey'),
(374, 'Europe', 'Europe', 'Europe/Kaliningrad'),
(375, 'Europe', 'Europe', 'Europe/Kiev'),
(376, 'Europe', 'Europe', 'Europe/Lisbon'),
(377, 'Europe', 'Europe', 'Europe/Ljubljana'),
(378, 'Europe', 'Europe', 'Europe/London'),
(379, 'Europe', 'Europe', 'Europe/Luxembourg'),
(380, 'Europe', 'Europe', 'Europe/Madrid'),
(381, 'Europe', 'Europe', 'Europe/Malta'),
(382, 'Europe', 'Europe', 'Europe/Mariehamn'),
(383, 'Europe', 'Europe', 'Europe/Minsk'),
(384, 'Europe', 'Europe', 'Europe/Monaco'),
(385, 'Europe', 'Europe', 'Europe/Moscow'),
(386, 'Europe', 'Europe', 'Europe/Nicosia'),
(387, 'Europe', 'Europe', 'Europe/Oslo'),
(388, 'Europe', 'Europe', 'Europe/Paris'),
(389, 'Europe', 'Europe', 'Europe/Podgorica'),
(390, 'Europe', 'Europe', 'Europe/Prague'),
(391, 'Europe', 'Europe', 'Europe/Riga'),
(392, 'Europe', 'Europe', 'Europe/Rome'),
(393, 'Europe', 'Europe', 'Europe/Samara'),
(394, 'Europe', 'Europe', 'Europe/San_Marino'),
(395, 'Europe', 'Europe', 'Europe/Sarajevo'),
(396, 'Europe', 'Europe', 'Europe/Simferopol'),
(397, 'Europe', 'Europe', 'Europe/Skopje'),
(398, 'Europe', 'Europe', 'Europe/Sofia'),
(399, 'Europe', 'Europe', 'Europe/Stockholm'),
(400, 'Europe', 'Europe', 'Europe/Tallinn'),
(401, 'Europe', 'Europe', 'Europe/Tirane'),
(402, 'Europe', 'Europe', 'Europe/Tiraspol'),
(403, 'Europe', 'Europe', 'Europe/Uzhgorod'),
(404, 'Europe', 'Europe', 'Europe/Vaduz'),
(405, 'Europe', 'Europe', 'Europe/Vatican'),
(406, 'Europe', 'Europe', 'Europe/Vienna'),
(407, 'Europe', 'Europe', 'Europe/Vilnius'),
(408, 'Europe', 'Europe', 'Europe/Volgograd'),
(409, 'Europe', 'Europe', 'Europe/Warsaw'),
(410, 'Europe', 'Europe', 'Europe/Zagreb'),
(411, 'Europe', 'Europe', 'Europe/Zaporozhye'),
(412, 'Europe', 'Europe', 'Europe/Zurich'),
(413, 'Indien', 'Indian', 'Indian/Antananarivo'),
(414, 'Indien', 'Indian', 'Indian/Chagos'),
(415, 'Indien', 'Indian', 'Indian/Christmas'),
(416, 'Indien', 'Indian', 'Indian/Cocos'),
(417, 'Indien', 'Indian', 'Indian/Comoro'),
(418, 'Indien', 'Indian', 'Indian/Kerguelen'),
(419, 'Indien', 'Indian', 'Indian/Mahe'),
(420, 'Indien', 'Indian', 'Indian/Maldives'),
(421, 'Indien', 'Indian', 'Indian/Mauritius'),
(422, 'Indien', 'Indian', 'Indian/Mayotte'),
(423, 'Indien', 'Indian', 'Indian/Reunion'),
(424, 'Pacifique', 'Pacific', 'Pacific/Apia'),
(425, 'Pacifique', 'Pacific', 'Pacific/Auckland'),
(426, 'Pacifique', 'Pacific', 'Pacific/Chatham'),
(427, 'Pacifique', 'Pacific', 'Pacific/Chuuk'),
(428, 'Pacifique', 'Pacific', 'Pacific/Easter'),
(429, 'Pacifique', 'Pacific', 'Pacific/Efate'),
(430, 'Pacifique', 'Pacific', 'Pacific/Enderbury'),
(431, 'Pacifique', 'Pacific', 'Pacific/Fakaofo'),
(432, 'Pacifique', 'Pacific', 'Pacific/Fiji'),
(433, 'Pacifique', 'Pacific', 'Pacific/Funafuti'),
(434, 'Pacifique', 'Pacific', 'Pacific/Galapagos'),
(435, 'Pacifique', 'Pacific', 'Pacific/Gambier'),
(436, 'Pacifique', 'Pacific', 'Pacific/Guadalcanal'),
(437, 'Pacifique', 'Pacific', 'Pacific/Guam'),
(438, 'Pacifique', 'Pacific', 'Pacific/Honolulu'),
(439, 'Pacifique', 'Pacific', 'Pacific/Johnston'),
(440, 'Pacifique', 'Pacific', 'Pacific/Kiritimati'),
(441, 'Pacifique', 'Pacific', 'Pacific/Kosrae'),
(442, 'Pacifique', 'Pacific', 'Pacific/Kwajalein'),
(443, 'Pacifique', 'Pacific', 'Pacific/Majuro'),
(444, 'Pacifique', 'Pacific', 'Pacific/Marquesas'),
(445, 'Pacifique', 'Pacific', 'Pacific/Midway'),
(446, 'Pacifique', 'Pacific', 'Pacific/Nauru'),
(447, 'Pacifique', 'Pacific', 'Pacific/Niue'),
(448, 'Pacifique', 'Pacific', 'Pacific/Norfolk'),
(449, 'Pacifique', 'Pacific', 'Pacific/Noumea'),
(450, 'Pacifique', 'Pacific', 'Pacific/Pago_Pago'),
(451, 'Pacifique', 'Pacific', 'Pacific/Palau'),
(452, 'Pacifique', 'Pacific', 'Pacific/Pitcairn'),
(453, 'Pacifique', 'Pacific', 'Pacific/Pohnpei'),
(454, 'Pacifique', 'Pacific', 'Pacific/Ponape'),
(455, 'Pacifique', 'Pacific', 'Pacific/Port_Moresby'),
(456, 'Pacifique', 'Pacific', 'Pacific/Rarotonga'),
(457, 'Pacifique', 'Pacific', 'Pacific/Saipan'),
(458, 'Pacifique', 'Pacific', 'Pacific/Samoa'),
(459, 'Pacifique', 'Pacific', 'Pacific/Tahiti'),
(460, 'Pacifique', 'Pacific', 'Pacific/Tarawa'),
(461, 'Pacifique', 'Pacific', 'Pacific/Tongatapu'),
(462, 'Pacifique', 'Pacific', 'Pacific/Truk'),
(463, 'Pacifique', 'Pacific', 'Pacific/Wake'),
(464, 'Pacifique', 'Pacific', 'Pacific/Wallis'),
(465, 'Pacifique', 'Pacific', 'Pacific/Yap'),
(466, 'Autres', 'Other', 'Brazil/Acre'),
(467, 'Autres', 'Other', 'Brazil/DeNoronha'),
(468, 'Autres', 'Other', 'Brazil/East'),
(469, 'Autres', 'Other', 'Brazil/West'),
(470, 'Autres', 'Other', 'CET'),
(471, 'Autres', 'Other', 'CST6CDT'),
(472, 'Autres', 'Other', 'Canada/Atlantic'),
(473, 'Autres', 'Other', 'Canada/Central'),
(474, 'Autres', 'Other', 'Canada/East-Saskatchewan'),
(475, 'Autres', 'Other', 'Canada/Eastern'),
(476, 'Autres', 'Other', 'Canada/Mountain'),
(477, 'Autres', 'Other', 'Canada/Newfoundland'),
(478, 'Autres', 'Other', 'Canada/Pacific'),
(479, 'Autres', 'Other', 'Canada/Saskatchewan'),
(480, 'Autres', 'Other', 'Canada/Yukon'),
(481, 'Autres', 'Other', 'Chile/Continental'),
(482, 'Autres', 'Other', 'Chile/EasterIsland'),
(483, 'Autres', 'Other', 'Cuba'),
(484, 'Autres', 'Other', 'EET'),
(485, 'Autres', 'Other', 'EST'),
(486, 'Autres', 'Other', 'EST5EDT'),
(487, 'Autres', 'Other', 'Egypt'),
(488, 'Autres', 'Other', 'Eire'),
(489, 'Autres', 'Other', 'Etc/GMT'),
(490, 'Autres', 'Other', 'Etc/GMT+0'),
(491, 'Autres', 'Other', 'Etc/GMT+1'),
(492, 'Autres', 'Other', 'Etc/GMT+10'),
(493, 'Autres', 'Other', 'Etc/GMT+11'),
(494, 'Autres', 'Other', 'Etc/GMT+12'),
(495, 'Autres', 'Other', 'Etc/GMT+2'),
(496, 'Autres', 'Other', 'Etc/GMT+3'),
(497, 'Autres', 'Other', 'Etc/GMT+4'),
(498, 'Autres', 'Other', 'Etc/GMT+5'),
(499, 'Autres', 'Other', 'Etc/GMT+6'),
(500, 'Autres', 'Other', 'Etc/GMT+7'),
(501, 'Autres', 'Other', 'Etc/GMT+8'),
(502, 'Autres', 'Other', 'Etc/GMT+9'),
(503, 'Autres', 'Other', 'Etc/GMT-0'),
(504, 'Autres', 'Other', 'Etc/GMT-1'),
(505, 'Autres', 'Other', 'Etc/GMT-10'),
(506, 'Autres', 'Other', 'Etc/GMT-11'),
(507, 'Autres', 'Other', 'Etc/GMT-12'),
(508, 'Autres', 'Other', 'Etc/GMT-13'),
(509, 'Autres', 'Other', 'Etc/GMT-14'),
(510, 'Autres', 'Other', 'Etc/GMT-2'),
(511, 'Autres', 'Other', 'Etc/GMT-3'),
(512, 'Autres', 'Other', 'Etc/GMT-4'),
(513, 'Autres', 'Other', 'Etc/GMT-5'),
(514, 'Autres', 'Other', 'Etc/GMT-6'),
(515, 'Autres', 'Other', 'Etc/GMT-7'),
(516, 'Autres', 'Other', 'Etc/GMT-8'),
(517, 'Autres', 'Other', 'Etc/GMT-9'),
(518, 'Autres', 'Other', 'Etc/GMT0'),
(519, 'Autres', 'Other', 'Etc/Greenwich'),
(520, 'Autres', 'Other', 'Etc/UCT'),
(521, 'Autres', 'Other', 'Etc/UTC'),
(522, 'Autres', 'Other', 'Etc/Universal'),
(523, 'Autres', 'Other', 'Etc/Zulu'),
(524, 'Autres', 'Other', 'GB'),
(525, 'Autres', 'Other', 'GB-Eire'),
(526, 'Autres', 'Other', 'GMT'),
(527, 'Autres', 'Other', 'GMT+0'),
(528, 'Autres', 'Other', 'GMT-0'),
(529, 'Autres', 'Other', 'GMT0'),
(530, 'Autres', 'Other', 'Greenwich'),
(531, 'Autres', 'Other', 'HST'),
(532, 'Autres', 'Other', 'Hongkong'),
(533, 'Autres', 'Other', 'Iceland'),
(534, 'Autres', 'Other', 'Iran'),
(535, 'Autres', 'Other', 'Israel'),
(536, 'Autres', 'Other', 'Jamaica'),
(537, 'Autres', 'Other', 'Japan'),
(538, 'Autres', 'Other', 'Kwajalein'),
(539, 'Autres', 'Other', 'Libya'),
(540, 'Autres', 'Other', 'MET'),
(541, 'Autres', 'Other', 'MST'),
(542, 'Autres', 'Other', 'MST7MDT'),
(543, 'Autres', 'Other', 'Mexico/BajaNorte'),
(544, 'Autres', 'Other', 'Mexico/BajaSur'),
(545, 'Autres', 'Other', 'Mexico/General'),
(546, 'Autres', 'Other', 'NZ'),
(547, 'Autres', 'Other', 'NZ-CHAT'),
(548, 'Autres', 'Other', 'Navajo'),
(549, 'Autres', 'Other', 'PRC'),
(550, 'Autres', 'Other', 'PST8PDT'),
(551, 'Autres', 'Other', 'Poland'),
(552, 'Autres', 'Other', 'Portugal'),
(553, 'Autres', 'Other', 'ROC'),
(554, 'Autres', 'Other', 'ROK'),
(555, 'Autres', 'Other', 'Singapore'),
(556, 'Autres', 'Other', 'Turkey'),
(557, 'Autres', 'Other', 'UCT'),
(558, 'Autres', 'Other', 'US/Alaska'),
(559, 'Autres', 'Other', 'US/Aleutian'),
(560, 'Autres', 'Other', 'US/Arizona'),
(561, 'Autres', 'Other', 'US/Central'),
(562, 'Autres', 'Other', 'US/East-Indiana'),
(563, 'Autres', 'Other', 'US/Eastern'),
(564, 'Autres', 'Other', 'US/Hawaii'),
(565, 'Autres', 'Other', 'US/Indiana-Starke'),
(566, 'Autres', 'Other', 'US/Michigan'),
(567, 'Autres', 'Other', 'US/Mountain'),
(568, 'Autres', 'Other', 'US/Pacific'),
(569, 'Autres', 'Other', 'US/Pacific-New'),
(570, 'Autres', 'Other', 'US/Samoa'),
(571, 'Autres', 'Other', 'UTC'),
(572, 'Autres', 'Other', 'Universal'),
(573, 'Autres', 'Other', 'W-SU'),
(574, 'Autres', 'Other', 'WET'),
(575, 'Autres', 'Other', 'Zulu');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `genre` varchar(1) DEFAULT NULL,
  `nblogin` tinyint(1) NOT NULL,
  `matricule` varchar(225) DEFAULT NULL,
  `Code_postal` varchar(255) DEFAULT NULL,
  `Ville` varchar(255) DEFAULT NULL,
  `Compte_Contribuable` varchar(255) DEFAULT NULL,
  `RaisonSociale` varchar(255) DEFAULT NULL,
  `RegistreCommerce` varchar(255) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `Adresse` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `genre`, `nblogin`, `matricule`, `Code_postal`, `Ville`, `Compte_Contribuable`, `RaisonSociale`, `RegistreCommerce`, `type`, `Adresse`) VALUES
(1, '127.0.0.1', 'admin', '$2y$10$6yehApY1yBSZRHx0K6zppuAs8qObKqBxP6dW7fvAr7019pS7xIUua', 'admin@admin.com', NULL, '', NULL, NULL, NULL, NULL, NULL, 1268889823, 1621349373, 1, 'Admin', 'JPRO', 'MANAGER', '0', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(8, '127.0.0.1', 'soro', '$2y$10$6yehApY1yBSZRHx0K6zppuAs8qObKqBxP6dW7fvAr7019pS7xIUua', 'soro@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1605546725, 1619606101, 1, 'soro', 'lohoyirimeh', 'COMPTEURS', '', 'M', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(9, '127.0.0.1', 'tuo', '$2y$10$6yehApY1yBSZRHx0K6zppuAs8qObKqBxP6dW7fvAr7019pS7xIUua', 'tuo@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1605546762, 1617381578, 1, 'Tuo', 'aba', 'VALIDATEUR', '', 'M', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(11, '127.0.0.1', 'ali', '$2y$10$6yehApY1yBSZRHx0K6zppuAs8qObKqBxP6dW7fvAr7019pS7xIUua', 'seor@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1605616240, 1616927619, 1, 'ali', 'lao', 'COMPTEURS', '', 'F', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(12, '127.0.0.1', 'Koss', '$2y$10$ZjufcGaDvQAislv3.OGAze3Y4Gh0oyQc/WlQGBEJdjoYADJwCC4dC', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615105600, 1619603741, 1, 'Koss', 'Ouattara', 'VENDEURS', '', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(14, '127.0.0.1', 'david', '$2y$10$hGoVeywZ8x118rUEzJdjD.nk5gqTV299VbTJT3lbb0pY9y6om1sAu', 'david@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1616929519, 1616929606, 1, 'david', 'david', 'VALIDATEUR', '', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '');

-- --------------------------------------------------------

--
-- Structure de la table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(2, 1, 1),
(32, 8, 2),
(33, 9, 3),
(35, 11, 2),
(36, 12, 6),
(37, 14, 3);

-- --------------------------------------------------------

--
-- Structure de la table `ventes`
--

CREATE TABLE `ventes` (
  `id` int(11) NOT NULL,
  `codeVente` int(11) NOT NULL,
  `idClient` int(11) NOT NULL,
  `idProduit` int(11) NOT NULL,
  `qnt` int(11) NOT NULL,
  `prix_u` int(11) NOT NULL,
  `prix_acc` int(11) NOT NULL,
  `montantV1` int(11) NOT NULL,
  `prixTotalVente` int(11) NOT NULL,
  `nb_versement` int(11) NOT NULL,
  `dateVente` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `observation` text NOT NULL,
  `contatClient` varchar(50) NOT NULL,
  `penalite` int(11) NOT NULL DEFAULT 0,
  `type_vente` tinyint(1) NOT NULL,
  `date_create` int(11) NOT NULL,
  `user` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ventes`
--

INSERT INTO `ventes` (`id`, `codeVente`, `idClient`, `idProduit`, `qnt`, `prix_u`, `prix_acc`, `montantV1`, `prixTotalVente`, `nb_versement`, `dateVente`, `status`, `observation`, `contatClient`, `penalite`, `type_vente`, `date_create`, `user`) VALUES
(1, 2147483647, 1, 3, 1, 84000, 35000, 50000, 119000, 3, '2021-03-28', 1, 'Il vous reste 69000', '0779815420', 0, 1, 1616912803, 1),
(2, 2147483647, 1, 3, 1, 84000, 35000, 50000, 119000, 2, '2021-04-02', 0, '', '0779815420', 0, 1, 1617387012, 1);

-- --------------------------------------------------------

--
-- Structure de la table `warehouse`
--

CREATE TABLE `warehouse` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `create` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `warehouse`
--

INSERT INTO `warehouse` (`id`, `name`, `create`) VALUES
(1, 'WAREHOUSE 1', 127589404),
(2, 'ENTREPOT 1', 1600902682),
(3, 'ENTREPOT 2', 1600902683),
(4, 'ENTREPOT 3', 1600902685),
(5, 'ENTREPOT 4', 1600902685),
(6, 'ENTREPOT 5', 1600902686),
(7, 'ENTREPOT 6', 1600902687),
(8, 'ENTREPOT 7', 1600902687),
(9, 'ENTREPOT 8', 1600902688),
(10, 'ENTREPOT 9', 1600902688),
(11, 'ENTREPOT 10', 1600902689),
(12, 'ENTREPOT 11', 1600902689),
(13, 'ENTREPOT 12', 1600902692),
(14, 'ENTREPOT 13', 1600902693);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `attribution_sub_inventory`
--
ALTER TABLE `attribution_sub_inventory`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `details_vente`
--
ALTER TABLE `details_vente`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `format_dates`
--
ALTER TABLE `format_dates`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id_inventory`);

--
-- Index pour la table `inventory_products`
--
ALTER TABLE `inventory_products`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `permission_on`
--
ALTER TABLE `permission_on`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `products_by_vente`
--
ALTER TABLE `products_by_vente`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `product_on_inventory`
--
ALTER TABLE `product_on_inventory`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `product_on_inventory_history`
--
ALTER TABLE `product_on_inventory_history`
  ADD PRIMARY KEY (`ID_HIST`);

--
-- Index pour la table `product_settings`
--
ALTER TABLE `product_settings`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `relationsubinv_inv`
--
ALTER TABLE `relationsubinv_inv`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sub_inventory`
--
ALTER TABLE `sub_inventory`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `timezones`
--
ALTER TABLE `timezones`
  ADD PRIMARY KEY (`timezone_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_email` (`email`),
  ADD UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  ADD UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  ADD UNIQUE KEY `uc_remember_selector` (`remember_selector`);

--
-- Index pour la table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- Index pour la table `ventes`
--
ALTER TABLE `ventes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `attribution_sub_inventory`
--
ALTER TABLE `attribution_sub_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=902;

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `details_vente`
--
ALTER TABLE `details_vente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `format_dates`
--
ALTER TABLE `format_dates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id_inventory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `inventory_products`
--
ALTER TABLE `inventory_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT pour la table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `permission_on`
--
ALTER TABLE `permission_on`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `products_by_vente`
--
ALTER TABLE `products_by_vente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `product_on_inventory`
--
ALTER TABLE `product_on_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `product_on_inventory_history`
--
ALTER TABLE `product_on_inventory_history`
  MODIFY `ID_HIST` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `product_settings`
--
ALTER TABLE `product_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `relationsubinv_inv`
--
ALTER TABLE `relationsubinv_inv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `sub_inventory`
--
ALTER TABLE `sub_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `timezones`
--
ALTER TABLE `timezones`
  MODIFY `timezone_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=698;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT pour la table `ventes`
--
ALTER TABLE `ventes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
