-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 21 mai 2021 à 20:10
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
-- Structure de la table `loc_couleur`
--

CREATE TABLE `loc_couleur` (
  `idcouleur` int(11) NOT NULL,
  `libel` varchar(255) NOT NULL,
  `date_create` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `loc_factures`
--

CREATE TABLE `loc_factures` (
  `idfact` int(11) NOT NULL,
  `numfacture` varchar(100) NOT NULL,
  `idpersonne` int(11) NOT NULL,
  `typefacture` int(11) NOT NULL,
  `date_creation` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `loc_ligne_facture`
--

CREATE TABLE `loc_ligne_facture` (
  `id_ligne` int(11) NOT NULL,
  `idvehicule` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix_U_loction` double NOT NULL,
  `prix_total_ligne` double NOT NULL,
  `idfacture` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `loc_marque`
--

CREATE TABLE `loc_marque` (
  `idmarque` int(11) NOT NULL,
  `libel` varchar(255) NOT NULL,
  `date_add` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `loc_personnes`
--

CREATE TABLE `loc_personnes` (
  `idPers` int(11) NOT NULL,
  `nom` varchar(225) NOT NULL,
  `prenoms` varchar(255) NOT NULL,
  `nom_entreprise` varchar(255) NOT NULL,
  `contacts` varchar(255) NOT NULL,
  `adresse_geo` varchar(255) NOT NULL,
  `typePer` int(11) NOT NULL,
  `typeMode` int(11) NOT NULL COMMENT '1=> Entreprise / 2=> Particulier',
  `date_insert` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `loc_typepersone`
--

CREATE TABLE `loc_typepersone` (
  `idtypeP` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `date_add` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `loc_typevehicule`
--

CREATE TABLE `loc_typevehicule` (
  `idtypeV` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `date_add` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `loc_vehicules`
--

CREATE TABLE `loc_vehicules` (
  `idv` int(11) NOT NULL,
  `immatri` varchar(200) NOT NULL,
  `fournisseur` int(11) NOT NULL,
  `marque` int(11) NOT NULL,
  `typeVehicule` int(11) NOT NULL,
  `couleurVehicule` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0=>libre / 1=> en location',
  `date_mise_loction` int(11) NOT NULL,
  `date_fin_location` int(11) NOT NULL,
  `date_ajoute` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `loc_couleur`
--
ALTER TABLE `loc_couleur`
  ADD PRIMARY KEY (`idcouleur`);

--
-- Index pour la table `loc_factures`
--
ALTER TABLE `loc_factures`
  ADD PRIMARY KEY (`idfact`);

--
-- Index pour la table `loc_ligne_facture`
--
ALTER TABLE `loc_ligne_facture`
  ADD PRIMARY KEY (`id_ligne`);

--
-- Index pour la table `loc_marque`
--
ALTER TABLE `loc_marque`
  ADD PRIMARY KEY (`idmarque`);

--
-- Index pour la table `loc_personnes`
--
ALTER TABLE `loc_personnes`
  ADD PRIMARY KEY (`idPers`);

--
-- Index pour la table `loc_typepersone`
--
ALTER TABLE `loc_typepersone`
  ADD PRIMARY KEY (`idtypeP`);

--
-- Index pour la table `loc_typevehicule`
--
ALTER TABLE `loc_typevehicule`
  ADD PRIMARY KEY (`idtypeV`);

--
-- Index pour la table `loc_vehicules`
--
ALTER TABLE `loc_vehicules`
  ADD PRIMARY KEY (`idv`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `loc_couleur`
--
ALTER TABLE `loc_couleur`
  MODIFY `idcouleur` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `loc_factures`
--
ALTER TABLE `loc_factures`
  MODIFY `idfact` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `loc_ligne_facture`
--
ALTER TABLE `loc_ligne_facture`
  MODIFY `id_ligne` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `loc_marque`
--
ALTER TABLE `loc_marque`
  MODIFY `idmarque` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `loc_personnes`
--
ALTER TABLE `loc_personnes`
  MODIFY `idPers` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `loc_typepersone`
--
ALTER TABLE `loc_typepersone`
  MODIFY `idtypeP` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `loc_typevehicule`
--
ALTER TABLE `loc_typevehicule`
  MODIFY `idtypeV` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `loc_vehicules`
--
ALTER TABLE `loc_vehicules`
  MODIFY `idv` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
