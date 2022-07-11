-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : db.3wa.io
-- Généré le : mer. 01 juin 2022 à 15:35
-- Version du serveur :  5.7.33-0ubuntu0.18.04.1-log
-- Version de PHP : 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `camillelefort_projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `pseudo` varchar(250) COLLATE utf8_bin NOT NULL,
  `email` varchar(250) COLLATE utf8_bin NOT NULL,
  `password` varchar(260) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id_admin`, `pseudo`, `email`, `password`) VALUES
(1, 'Administrateur', '$2y$10$mWl0f2z/PiAvbVcbkz5wOeAVCEngLpBrB.enV8YfwuXLelAZvHA3W', '$2y$10$mWl0f2z/PiAvbVcbkz5wOeAVCEngLpBrB.enV8YfwuXLelAZvHA3W');

-- --------------------------------------------------------

--
-- Structure de la table `artists`
--

CREATE TABLE `artists` (
  `id_artist` int(11) NOT NULL,
  `name` varchar(250) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `artists`
--

INSERT INTO `artists` (`id_artist`, `name`) VALUES
(1, 'Orelsan'),
(2, 'Harry Styles'),
(3, 'Angele'),
(4, 'Stromae'),
(5, 'Borns'),
(6, 'Muse'),
(7, 'Imagine Dragons'),
(8, 'Cage the Elephant'),
(9, 'Yungblood'),
(10, 'Lil Nas X'),
(11, 'Lana Del Rey'),
(12, 'Jessie Reyez'),
(13, 'Lomepal'),
(14, 'Tsew the kid'),
(15, 'Royal Blood'),
(16, '5 seconds of summer'),
(17, 'Mitski'),
(18, 'Vampire weekend'),
(19, 'Rosalia'),
(20, 'Muddy Monk'),
(21, 'Billie Eilish');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id_category` int(11) NOT NULL,
  `cat_name` varchar(250) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id_category`, `cat_name`) VALUES
(3, 'Pop'),
(4, 'Rock'),
(5, 'Rap'),
(6, 'Electronique'),
(7, 'Rock indépendant'),
(8, 'RnB'),
(9, 'Musique alternative'),
(10, 'Soul');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id_message` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `lastname` varchar(50) COLLATE utf8_bin NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `phone` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8_bin NOT NULL,
  `object` varchar(250) COLLATE utf8_bin NOT NULL,
  `message` text COLLATE utf8_bin NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id_message`, `id_user`, `lastname`, `name`, `phone`, `email`, `object`, `message`, `date`) VALUES
(6, 25, 'Test1', 'Utilisateur1', 657334528, 'utilisateur1@utilisateur.fr', 'Message test1', '\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris nec dignissim leo, quis fringilla lorem. Pellentesque suscipit vel massa eu dapibus. Nam interdum est vel sapien convallis suscipit. Morbi et tellus luctus, tincidunt libero eget, tincidunt nunc. Sed mattis auctor diam, et euismod enim blandit ut. Sed molestie id augue elementum pulvinar. Pellentesque nec turpis viverra, ultrices risus ac, auctor nibh. Nulla facilisi. In ultrices sem sed nunc ultrices malesuada. Nunc quis leo aliquam, cursus sem id, sollicitudin leo. Pellentesque erat elit, gravida vulputate bibendum ut, vehicula at risus. Morbi commodo tortor in erat viverra ornare. Praesent nec efficitur mauris.\r\n\r\nAliquam erat volutpat. Ut arcu risus, euismod at velit id, pulvinar mollis enim. Aliquam scelerisque sollicitudin dui, eget auctor ipsum sodales a. Maecenas id luctus sapien. Maecenas vitae malesuada magna, eget scelerisque nunc. Vestibulum neque arcu, condimentum nec ullamcorper nec, vulputate et nisi. Integer gravida sem in luctus dapibus. Aenean nec mattis felis, nec hendrerit libero. Donec sit amet neque eget diam pellentesque ornare viverra ac mi. Cras lobortis arcu non justo euismod, sed mattis mi facilisis. Vivamus augue augue, vestibulum eget nulla in, congue porta tellus. Pellentesque ultrices tincidunt sem sed posuere.', '2022-05-24 09:26:16'),
(7, 27, 'Test3', 'Utilisateur3', 589865896, 'utilisateur3@utilisateur.fr', 'Message test2', '\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris nec dignissim leo, quis fringilla lorem. Pellentesque suscipit vel massa eu dapibus. Nam interdum est vel sapien convallis suscipit. Morbi et tellus luctus, tincidunt libero eget, tincidunt nunc. Sed mattis auctor diam, et euismod enim blandit ut. Sed molestie id augue elementum pulvinar. Pellentesque nec turpis viverra, ultrices risus ac, auctor nibh. Nulla facilisi. In ultrices sem sed nunc ultrices malesuada. Nunc quis leo aliquam, cursus sem id, sollicitudin leo. Pellentesque erat elit, gravida vulputate bibendum ut, vehicula at risus. Morbi commodo tortor in erat viverra ornare. Praesent nec efficitur mauris.\r\n\r\nAliquam erat volutpat. Ut arcu risus, euismod at velit id, pulvinar mollis enim. Aliquam scelerisque sollicitudin dui, eget auctor ipsum sodales a. Maecenas id luctus sapien. Maecenas vitae malesuada magna, eget scelerisque nunc. Vestibulum neque arcu, condimentum nec ullamcorper nec, vulputate et nisi. Integer gravida sem in luctus dapibus. Aenean nec mattis felis, nec hendrerit libero. Donec sit amet neque eget diam pellentesque ornare viverra ac mi. Cras lobortis arcu non justo euismod, sed mattis mi facilisis. Vivamus augue augue, vestibulum eget nulla in, congue porta tellus. Pellentesque ultrices tincidunt sem sed posuere.', '2022-05-24 09:40:25'),
(9, 0, 'Test5', 'Invité1', 987965689, 'invite1@invite.fr', 'Message test3', '\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris nec dignissim leo, quis fringilla lorem. Pellentesque suscipit vel massa eu dapibus. Nam interdum est vel sapien convallis suscipit. Morbi et tellus luctus, tincidunt libero eget, tincidunt nunc. Sed mattis auctor diam, et euismod enim blandit ut. Sed molestie id augue elementum pulvinar. Pellentesque nec turpis viverra, ultrices risus ac, auctor nibh. Nulla facilisi. In ultrices sem sed nunc ultrices malesuada. Nunc quis leo aliquam, cursus sem id, sollicitudin leo. Pellentesque erat elit, gravida vulputate bibendum ut, vehicula at risus. Morbi commodo tortor in erat viverra ornare. Praesent nec efficitur mauris.\r\n\r\nAliquam erat volutpat. Ut arcu risus, euismod at velit id, pulvinar mollis enim. Aliquam scelerisque sollicitudin dui, eget auctor ipsum sodales a. Maecenas id luctus sapien. Maecenas vitae malesuada magna, eget scelerisque nunc. Vestibulum neque arcu, condimentum nec ullamcorper nec, vulputate et nisi. Integer gravida sem in luctus dapibus. Aenean nec mattis felis, nec hendrerit libero. Donec sit amet neque eget diam pellentesque ornare viverra ac mi. Cras lobortis arcu non justo euismod, sed mattis mi facilisis. Vivamus augue augue, vestibulum eget nulla in, congue porta tellus. Pellentesque ultrices tincidunt sem sed posuere.', '2022-05-24 09:53:31');

-- --------------------------------------------------------

--
-- Structure de la table `details_order`
--

CREATE TABLE `details_order` (
  `id_order` int(11) NOT NULL,
  `id_event` int(11) NOT NULL,
  `id_cat` int(11) NOT NULL,
  `cat_name` varchar(250) COLLATE utf8_bin NOT NULL,
  `quantity` int(20) NOT NULL,
  `prices` float(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `details_order`
--

INSERT INTO `details_order` (`id_order`, `id_event`, `id_cat`, `cat_name`, `quantity`, `prices`) VALUES
(66, 4, 16, 'Cat 1', 2, 45.00),
(68, 5, 19, 'Cat 2', 2, 40.00),
(69, 3, 14, 'Cat 1', 3, 45.00),
(69, 21, 49, 'Cat 1', 2, 70.00),
(70, 7, 22, 'Cat 1', 2, 80.00),
(71, 2, 11, 'Cat 2', 3, 35.00),
(72, 9, 28, 'Cat 2', 2, 65.00),
(73, 1, 7, 'Cat 1', 4, 80.00),
(74, 15, 36, 'Cat 1', 4, 45.00),
(75, 19, 46, 'Cat 2', 3, 39.00);

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

CREATE TABLE `events` (
  `id_event` int(11) NOT NULL,
  `artist` varchar(250) COLLATE utf8_bin NOT NULL,
  `date` date NOT NULL,
  `category` varchar(250) COLLATE utf8_bin NOT NULL,
  `poster` varchar(250) COLLATE utf8_bin NOT NULL,
  `name` varchar(250) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `banner` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `on_slider` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `time` time NOT NULL,
  `lowest_price` int(11) NOT NULL,
  `video` varchar(250) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `events`
--

INSERT INTO `events` (`id_event`, `artist`, `date`, `category`, `poster`, `name`, `description`, `banner`, `on_slider`, `time`, `lowest_price`, `video`) VALUES
(1, 'Harry Styles', '2022-06-21', 'Pop', 'harry-styles.png', 'Love on Tour', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'harry-styles-banner.png', 'yes', '20:00:00', 65, 'https://www.youtube.com/embed/E07s5ZYygMg'),
(2, 'Imagine Dragons', '2022-06-25', 'Rock', 'imagine-dragons.png', 'Evolve Tour', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', '', '20:00:00', 35, 'https://www.youtube.com/embed/TO-_3tck2tg'),
(3, 'Angele', '2022-05-26', 'Pop', 'angele.png', 'Nonante-cinq tour', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', '', '20:00:00', 35, 'https://www.youtube.com/embed/5TqetBMBTww'),
(4, 'Orelsan', '2022-08-19', 'Rap', 'orelsan.png', 'Orelsan tour', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', '', '20:00:00', 35, 'https://www.youtube.com/embed/rXF1Si3LEEU'),
(5, 'Stromae', '2022-05-29', 'Electronique', 'stromae.png', 'Multitude tour', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'stromae-banner.png', 'yes', '20:00:00', 40, 'https://www.youtube.com/embed/DO8NSL5Wyeg'),
(6, 'Borns', '2022-06-14', 'Pop', 'borns.png', 'Borns tour', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', '', '20:00:00', 35, 'https://www.youtube.com/embed/pLBmqwA4AGc'),
(7, 'Muse', '2022-08-11', 'Rock', 'muse.png', 'Simulation world tour', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'muse-banner.png', 'yes', '20:00:00', 65, 'https://www.youtube.com/embed/QP3zRBtgvJo'),
(8, 'Cage the Elephant', '2022-11-24', 'Rock', 'cage-the-elephant.png', 'Cage the Elephant Tour', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', '', '20:00:00', 35, 'https://www.youtube.com/embed/KVYup3Qwh8Q'),
(9, 'Yungblud', '2022-07-12', 'Rock', 'yungblud.png', 'Life on Mars tour', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', '', '20:00:00', 55, 'https://www.youtube.com/embed/02T6xLNXEE0'),
(10, 'Lil nas X', '2022-09-08', 'Rap', 'lil-nas-x.png', 'Long live montero tour', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'lil-nas-x-banner.png', 'yes', '20:00:00', 80, 'https://www.youtube.com/embed/UTHLKHL_whs'),
(11, 'Lana Del Rey', '2022-06-06', 'Rock indépendant', 'lana-del-rey.png', 'Blue Banisters tour', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', '', '20:00:00', 45, 'https://www.youtube.com/embed/fN0OmdJUl0I'),
(12, 'Jessie Reyez', '2022-06-22', 'RnB', 'jessie-reyez.png', 'Before love came to kill us tour', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', '', '20:00:00', 40, 'https://www.youtube.com/embed/SP4M1WGquSU'),
(15, 'Lomepal', '2022-06-24', 'Rap', 'lomepal.png', 'Jeanine tour', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', '', '20:00:00', 35, 'https://www.youtube.com/embed/Bkm03KcnKHE'),
(16, 'Tsew the kid', '2022-06-09', 'Rap', 'tsew-the-kid.png', 'Diavolana tour', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', '', '20:00:00', 30, 'https://www.youtube.com/embed/RDnP-3Yukg4'),
(17, 'Royal blood', '2022-05-17', 'Rock', 'royal-blood.png', 'Royal blood 2022 European tour', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', '', '20:00:00', 39, 'https://www.youtube.com/embed/dsMU2pOCBuw'),
(18, '5 seconds of summer', '2022-06-30', 'Rock', '5-seconds-of-summer.png', 'No shame tour', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', '', '20:00:00', 45, 'https://www.youtube.com/embed/GoQ85cs5fk0'),
(19, 'Mitski', '2022-07-08', 'Rock indépendant', 'mitski.png', 'Mitski 2022 tour', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', '', '20:00:00', 39, 'https://www.youtube.com/embed/P4J3Z9xgjWQ'),
(20, 'Vampire weekend', '2022-06-15', 'Musique alternative', 'vampire-weekend.png', 'FOTB tour', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', '', '20:00:00', 35, 'https://www.youtube.com/embed/FwkrrU2WYKg'),
(21, 'Rosalia', '2022-07-21', 'Pop', 'rosalia.png', 'El mal querer tour', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'rosalia-banner.png', 'yes', '20:00:00', 55, 'https://www.youtube.com/embed/e-CEd6xrRQc'),
(22, 'Muddy Monk', '2022-07-21', 'Pop', 'muddy-monk.png', 'Muddy Monk tour', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', '', '20:00:00', 35, 'https://www.youtube.com/embed/rjSr4GooMdo'),
(27, 'Billie Eilish', '2022-09-13', 'Pop', 'billie-eilish.png', 'Happier Than Ever Tour', 'feruhfpreuzh', 'billie-eilish-banner.png', 'yes', '20:00:00', 65, 'https://www.youtube.com/embed/5GJWxDKyk3A');

-- --------------------------------------------------------

--
-- Structure de la table `newsletter`
--

CREATE TABLE `newsletter` (
  `id_user` int(11) NOT NULL,
  `email` varchar(250) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `newsletter`
--

INSERT INTO `newsletter` (`id_user`, `email`) VALUES
(22, 'utilisateur2@utilisateur.fr'),
(23, 'utilisateur3@utilisateur.fr'),
(24, 'utilisateur4@utilisateur.fr'),
(25, 'invite2@invite.fr'),
(26, 'invite3@invite.fr'),
(27, 'delphine.berghmans@gmail.com'),
(28, 'justakenora@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL,
  `id_user` int(50) NOT NULL,
  `date` datetime NOT NULL,
  `payment` float(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`id_order`, `id_user`, `date`, `payment`) VALUES
(66, 25, '2022-05-24 09:23:43', 90.00),
(68, 25, '2022-05-24 09:27:39', 80.00),
(69, 26, '2022-05-24 09:33:02', 275.00),
(70, 27, '2022-05-24 09:39:43', 160.00),
(71, 27, '2022-05-24 09:43:30', 105.00),
(72, 27, '2022-05-24 09:44:46', 130.00),
(73, 28, '2022-05-24 09:49:30', 320.00),
(74, 28, '2022-05-24 09:50:34', 180.00),
(75, 29, '2022-05-24 09:57:47', 117.00);

-- --------------------------------------------------------

--
-- Structure de la table `tickets`
--

CREATE TABLE `tickets` (
  `id_price` int(11) NOT NULL,
  `id_event` int(11) NOT NULL,
  `name` varchar(250) COLLATE utf8_bin NOT NULL,
  `price` float(6,2) NOT NULL,
  `original_stock` int(11) DEFAULT NULL,
  `remaining_stock` int(11) DEFAULT NULL,
  `sold_stock` int(11) DEFAULT NULL,
  `description` varchar(250) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `tickets`
--

INSERT INTO `tickets` (`id_price`, `id_event`, `name`, `price`, `original_stock`, `remaining_stock`, `sold_stock`, `description`) VALUES
(7, 1, 'Cat 1', 80.00, 30, 26, 4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(8, 1, 'Cat 2', 70.00, 40, 40, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(9, 1, 'Cat 3', 65.00, 65, 65, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(10, 2, 'Cat 1', 50.00, 45, 45, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(11, 2, 'Cat 2', 35.00, 70, 67, 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(12, 10, 'Cat 1', 110.00, 20, 20, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(13, 10, 'Cat 2', 95.00, 30, 30, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(14, 3, 'Cat 1', 45.00, 40, 37, 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(15, 3, 'Cat 2', 35.00, 70, 70, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(16, 4, 'Cat 1', 45.00, 60, 58, 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(17, 4, 'Cat 2', 35.00, 90, 90, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(18, 5, 'Cat 1', 50.00, 30, 30, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(19, 5, 'Cat 2', 40.00, 60, 58, 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(20, 6, 'Cat 1', 45.00, 50, 50, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(21, 6, 'Cat 2', 35.00, 70, 70, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(22, 7, 'Cat 1', 80.00, 25, 23, 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(23, 7, 'Cat 2', 70.00, 30, 30, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(24, 7, 'Cat 3', 65.00, 40, 40, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(25, 8, 'Cat 1', 45.00, 50, 50, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(26, 8, 'Cat 2', 35.00, 40, 40, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(27, 9, 'Cat 1', 70.00, 45, 45, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(28, 9, 'Cat 2', 65.00, 60, 58, 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(29, 9, 'Cat 3', 55.00, 80, 80, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(30, 10, 'Cat 3', 80.00, 15, 15, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(31, 11, 'Cat 1', 60.00, 30, 30, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(32, 11, 'Cat 2', 50.00, 40, 40, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(33, 11, 'Cat 3', 45.00, 55, 55, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(34, 12, 'Cat 1', 50.00, 30, 30, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(35, 12, 'Cat 2', 40.00, 20, 20, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(36, 15, 'Cat 1', 45.00, 40, 36, 4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(37, 15, 'Cat 2', 35.00, 55, 55, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(38, 16, 'Cat 1', 39.00, 25, 25, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(39, 16, 'Cat 2', 30.00, 35, 35, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(40, 17, 'Cat 1', 45.00, 50, 50, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(41, 17, 'Cat 2', 39.00, 30, 30, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(42, 18, 'Cat 1', 60.00, 70, 70, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(43, 18, 'Cat 2', 55.00, 30, 30, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(44, 18, 'Cat 3', 45.00, 20, 20, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(45, 19, 'Cat 1', 45.00, 30, 30, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(46, 19, 'Cat 2', 39.00, 40, 37, 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(47, 20, 'Cat 1', 45.00, 50, 50, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(48, 20, 'Cat 2', 35.00, 30, 30, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(49, 21, 'Cat 1', 70.00, 40, 38, 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(50, 21, 'Cat 2', 65.00, 25, 25, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(51, 21, 'Cat 3', 55.00, 50, 50, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(52, 22, 'Cat 1', 45.00, 45, 45, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(53, 22, 'Cat 2', 35.00, 20, 20, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `lastname` varchar(250) COLLATE utf8_bin NOT NULL,
  `name` varchar(250) COLLATE utf8_bin NOT NULL,
  `email` varchar(250) COLLATE utf8_bin NOT NULL,
  `adress` varchar(250) COLLATE utf8_bin NOT NULL,
  `postcode` varchar(250) COLLATE utf8_bin NOT NULL,
  `city` varchar(250) COLLATE utf8_bin NOT NULL,
  `country` varchar(250) COLLATE utf8_bin NOT NULL,
  `phone` varchar(250) COLLATE utf8_bin NOT NULL,
  `birthdate` date NOT NULL,
  `password` varchar(260) COLLATE utf8_bin NOT NULL,
  `newsletter` varchar(10) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `lastname`, `name`, `email`, `adress`, `postcode`, `city`, `country`, `phone`, `birthdate`, `password`, `newsletter`) VALUES
(25, 'Test1', 'Utilisateur1', 'utilisateur1@utilisateur.fr', '5 rue des Hyacinthes', '75000', 'Paris', 'France', '0657334528', '1980-02-15', '$2y$10$DBZHmnfIFCj0ar/rijprHudrnviMEaiZ6N6q9zy5r5ardfM/k5KTW', NULL),
(26, 'Test2', 'Utilisateur2', 'utilisateur2@utilisateur.fr', '157 rue Alphonse B.', '1060', 'Bruxelles', 'Belgique', '00322799655886', '1990-08-25', '$2y$10$fxkC0TVoi0oBqco.DlO0HeRonCFoMQxbqDNWzHpnLWFigVB59ZoDa', 'yes'),
(27, 'Test3', 'Utilisateur3', 'utilisateur3@utilisateur.fr', '13 impasse des Peupliers', 'La Rochelle', '17000', 'France', '0589865896', '1995-12-17', '$2y$10$XzrLTwzcSrUh1bqyVfVELu2YzfCgJpnde9rVYjXUtcL5kQCfMJbRO', 'yes'),
(28, 'Test4', 'Utilisateur4', 'utilisateur4@utilisateur.fr', '22 boulevard du Général Roques', '66000', 'Perpignan', 'Paris', '0468907633', '1993-04-06', '$2y$10$Ga0hFsSiGRFejtU7wGERqe4ZT9h696mwHV4eDR2asQt34u54Pj63u', 'yes'),
(29, 'Test5', 'Utilisateur5', 'utilisateur5@utilisateur.fr', '66 rue des Caoutchoucs', '75000', 'Paris', 'France', '065646876', '1975-06-26', '$2y$10$gOLV.RZNii./7JjTsmRg2OhAn0m6ZV4fiLSeA.wgXdLqbU1fJVE5O', NULL),
(30, 'Berghmans', 'Delphine ', 'delphine.berghmans@gmail.com', 'Rue Jules Besme 116', '1081', 'Koekelberg', 'Belgique', '0493942631', '1982-12-23', '$2y$10$6ZIi7cpSLfa9V8Itr4IPj.f5sqEj4JyEw3i11ukKi1mH6e0NbjhL6', 'yes');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Index pour la table `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`id_artist`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_category`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id_message`);

--
-- Index pour la table `details_order`
--
ALTER TABLE `details_order`
  ADD KEY `id_order` (`id_order`) USING BTREE,
  ADD KEY `id_event` (`id_event`) USING BTREE;

--
-- Index pour la table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id_event`);

--
-- Index pour la table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id_user`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `id_user` (`id_user`) USING BTREE;

--
-- Index pour la table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id_price`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `artists`
--
ALTER TABLE `artists`
  MODIFY `id_artist` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `events`
--
ALTER TABLE `events`
  MODIFY `id_event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT pour la table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id_price` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
