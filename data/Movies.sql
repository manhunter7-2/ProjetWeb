-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : sam. 23 avr. 2022 à 06:04
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 7.4.28

CREATE DATABASE moviesdb;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `moviesdb`
--

-- --------------------------------------------------------

--
-- Structure de la table `Movies`
--

CREATE TABLE `Movies` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_bin NOT NULL,
  `movDate` date DEFAULT NULL,
  `poster` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `synopsis` varchar(2500) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `Movies`
--

INSERT INTO `Movies` (`id`, `title`, `movDate`, `poster`, `synopsis`) VALUES
(1, 'Jackass', '2002-10-25', 'jackass.jpg', 'Jackass : the movie s\'inspire d\'une émission diffusée sur MTV et dans laquelle des personnes accomplissent des challenges et des cascades plus risqués les uns que les autres.'),
(2, 'Shrek', '2001-07-04', 'shrek.jpg', 'Shrek, un ogre verdâtre, cynique et malicieux, a élu domicile dans un marécage qu\'il croit être un havre de paix. Un matin, alors qu\'il sort faire sa toilette, il découvre de petites créatures agaçantes qui errent dans son marais.Shrek se rend alors au château du seigneur Lord Farquaad, qui aurait soit-disant expulsé ces êtres de son royaume. Ce dernier souhaite épouser la princesse Fiona, mais celle-ci est retenue prisonnière par un abominable dragon.'),
(12, 'LES SEGPA', '2022-04-20', 'segpa.jpg', 'Les SEGPA se font virer de leur Ã©tablissement. Ã€ leur grande surprise, ils intÃ¨grent le prestigieux collÃ¨ge Franklin D. Roosevelt. Le Principal, peu enclin Ã  voir la rÃ©putation de son Ã©cole se dÃ©tÃ©riorer, imagine un stratagÃ¨me pour virer les SEGPA tout en conservant les aides.'),
(13, 'SONIC 2 LE FILM', '2022-03-30', 'sonic-2.jpeg', 'Bien installÃ© dans la petite ville de Green Hills, Sonic veut maintenant prouver quâ€™il a lâ€™Ã©toffe d\' un vÃ©ritable hÃ©ros. Un dÃ©fi de taille se prÃ©sente Ã  lui quand le Dr Robotnik refait son apparition'),
(14, 'Ogre', '2022-04-20', 'ogre.jpeg', 'Fuyant un passÃ© douloureux, ChloÃ© dÃ©marre une nouvelle vie d\'institutrice dans le Morvan avec son fils Jules, 8 ans. Accueillie chaleureusement par les habitants du village, elle tombe sous le charme de Mathieu, un mÃ©decin charismatique et mystÃ©rieux.');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Movies`
--
ALTER TABLE `Movies`
  ADD PRIMARY KEY (`id`,`title`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Movies`
--
ALTER TABLE `Movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
