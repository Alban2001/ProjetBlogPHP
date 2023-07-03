-- phpMyAdmin SQL Dump
-- version 6.0.0-dev+20230528.920751a77a
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : Lun. 03 Juil. 2023 à 09:15
-- Version du serveur : 5.7.11
-- Version de PHP : 8.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bdd_blogpro`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `titre` varchar(125) NOT NULL,
  `image` varchar(30) NOT NULL,
  `chapo` longtext NOT NULL,
  `contenu` longtext NOT NULL,
  `date_creation` datetime NOT NULL,
  `date_derniere_maj` datetime NOT NULL,
  `id_utilisateur` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `titre`, `image`, `chapo`, `contenu`, `date_creation`, `date_derniere_maj`, `id_utilisateur`) VALUES
(74, 'Mon apprentissage chez BT FORMATION', '64961036d0dd85.66385516.jpg', '                         Nulla quis nisi consectetur, blandit lorem sed, feugiat ante. Aenean lorem ex, lobortis eu eleifend quis, lacinia eget nisl. Nunc est enim, rhoncus ut viverra at, ultricies ut mauris. In volutpat suscipit rutrum. Duis sollicitudin ligula id iaculis tempus. Duis fermentum mauris eu quam egestas, vel efficitur turpis malesuada. Curabitur vel aliquam risus, eu pulvinar nibh. ', '                        \r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sit amet augue vel erat iaculis pulvinar. Mauris mollis pulvinar nunc nec vestibulum. Vestibulum dignissim elementum iaculis. Maecenas ornare ex at ornare accumsan. Suspendisse sagittis in magna ac accumsan. Duis tempus, erat vitae tincidunt maximus, eros lectus accumsan dolor, nec efficitur ipsum lectus eget risus. Phasellus posuere ornare neque vitae laoreet. Cras varius ligula ac erat blandit euismod. Duis at orci libero. Duis ornare neque sed ipsum ultricies sollicitudin. Curabitur volutpat est a facilisis sodales. Sed eget neque et velit cursus viverra vitae sed ipsum. Nulla at nisl eget turpis ultricies auctor. Aenean nec hendrerit sem, sit amet interdum dolor.\r\n\r\nNulla quis nisi consectetur, blandit lorem sed, feugiat ante. Aenean lorem ex, lobortis eu eleifend quis, lacinia eget nisl. Nunc est enim, rhoncus ut viverra at, ultricies ut mauris. In volutpat suscipit rutrum. Duis sollicitudin ligula id iaculis tempus. Duis fermentum mauris eu quam egestas, vel efficitur turpis malesuada. Curabitur vel aliquam risus, eu pulvinar nibh.\r\n\r\nAliquam erat volutpat. Nulla eu rutrum augue, eget fringilla tortor. Nullam ut nulla aliquet, semper nulla vitae, feugiat dolor. Cras fermentum enim sit amet sapien pharetra, non eleifend justo cursus. Proin tempor lacus sed dictum vestibulum. Curabitur porta porttitor enim id pharetra. Ut eget mollis nunc. Vestibulum auctor, ipsum quis iaculis accumsan, lorem leo sodales enim, in facilisis lorem dui ut justo. Vestibulum blandit, libero et condimentum venenatis, nisl lacus dictum ante, sit amet pulvinar ligula tellus nec mauris. Nullam dictum massa vitae turpis malesuada sollicitudin.\r\n\r\nCurabitur eu molestie dui, eget commodo lectus. Morbi accumsan pellentesque interdum. In scelerisque auctor justo, non mattis justo pulvinar a. Suspendisse nibh metus, eleifend non ullamcorper quis, aliquet eu lorem. Donec ipsum nulla, ornare in dui non, volutpat fringilla eros. Morbi pulvinar tellus ornare justo condimentum, sed mollis massa vestibulum. Integer gravida tortor diam, ac pellentesque arcu porttitor ut. Maecenas tempus fringilla volutpat. Donec nec consectetur neque, non placerat libero. Etiam cursus nibh feugiat, congue diam non, ornare felis. Curabitur non hendrerit nulla, nec mattis erat.\r\n\r\nNam in eros nec velit vestibulum maximus. Suspendisse eget nibh sodales, mattis odio nec, ullamcorper felis. Integer nec orci quis neque malesuada tincidunt vel eu sapien. Cras dictum ac nulla efficitur posuere. Proin sollicitudin lorem non lectus pellentesque, id convallis libero pharetra. Aliquam vel lobortis dui, a euismod eros. Etiam in ex id diam pretium rhoncus a ac turpis. Nam pharetra diam non risus tincidunt eleifend. In volutpat sollicitudin semper. Aliquam vel sagittis sapien. Nunc auctor arcu nulla, tempus gravida felis gravida sed. ', '2023-06-23 19:34:17', '2023-07-03 09:30:32', 1),
(92, 'Ma formation chez OpenClassrooms', '64974bdbeb12b1.00469655.jpg', 'Nulla quis nisi consectetur, blandit lorem sed, feugiat ante. Aenean lorem ex, lobortis eu eleifend quis, lacinia eget nisl. Nunc est enim, rhoncus ut viverra at, ultricies ut mauris. In volutpat suscipit rutrum. Duis sollicitudin ligula id iaculis tempus. Duis fermentum mauris eu quam egestas, vel efficitur turpis malesuada. Curabitur vel aliquam risus, eu pulvinar nibh. ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sit amet augue vel erat iaculis pulvinar. Mauris mollis pulvinar nunc nec vestibulum. Vestibulum dignissim elementum iaculis. Maecenas ornare ex at ornare accumsan. Suspendisse sagittis in magna ac accumsan. Duis tempus, erat vitae tincidunt maximus, eros lectus accumsan dolor, nec efficitur ipsum lectus eget risus. Phasellus posuere ornare neque vitae laoreet. Cras varius ligula ac erat blandit euismod. Duis at orci libero. Duis ornare neque sed ipsum ultricies sollicitudin. Curabitur volutpat est a facilisis sodales. Sed eget neque et velit cursus viverra vitae sed ipsum. Nulla at nisl eget turpis ultricies auctor. Aenean nec hendrerit sem, sit amet interdum dolor.\r\n\r\nNulla quis nisi consectetur, blandit lorem sed, feugiat ante. Aenean lorem ex, lobortis eu eleifend quis, lacinia eget nisl. Nunc est enim, rhoncus ut viverra at, ultricies ut mauris. In volutpat suscipit rutrum. Duis sollicitudin ligula id iaculis tempus. Duis fermentum mauris eu quam egestas, vel efficitur turpis malesuada. Curabitur vel aliquam risus, eu pulvinar nibh.\r\n\r\nAliquam erat volutpat. Nulla eu rutrum augue, eget fringilla tortor. Nullam ut nulla aliquet, semper nulla vitae, feugiat dolor. Cras fermentum enim sit amet sapien pharetra, non eleifend justo cursus. Proin tempor lacus sed dictum vestibulum. Curabitur porta porttitor enim id pharetra. Ut eget mollis nunc. Vestibulum auctor, ipsum quis iaculis accumsan, lorem leo sodales enim, in facilisis lorem dui ut justo. Vestibulum blandit, libero et condimentum venenatis, nisl lacus dictum ante, sit amet pulvinar ligula tellus nec mauris. Nullam dictum massa vitae turpis malesuada sollicitudin.\r\n\r\nCurabitur eu molestie dui, eget commodo lectus. Morbi accumsan pellentesque interdum. In scelerisque auctor justo, non mattis justo pulvinar a. Suspendisse nibh metus, eleifend non ullamcorper quis, aliquet eu lorem. Donec ipsum nulla, ornare in dui non, volutpat fringilla eros. Morbi pulvinar tellus ornare justo condimentum, sed mollis massa vestibulum. Integer gravida tortor diam, ac pellentesque arcu porttitor ut. Maecenas tempus fringilla volutpat. Donec nec consectetur neque, non placerat libero. Etiam cursus nibh feugiat, congue diam non, ornare felis. Curabitur non hendrerit nulla, nec mattis erat.\r\n\r\nNam in eros nec velit vestibulum maximus. Suspendisse eget nibh sodales, mattis odio nec, ullamcorper felis. Integer nec orci quis neque malesuada tincidunt vel eu sapien. Cras dictum ac nulla efficitur posuere. Proin sollicitudin lorem non lectus pellentesque, id convallis libero pharetra. Aliquam vel lobortis dui, a euismod eros. Etiam in ex id diam pretium rhoncus a ac turpis. Nam pharetra diam non risus tincidunt eleifend. In volutpat sollicitudin semper. Aliquam vel sagittis sapien. Nunc auctor arcu nulla, tempus gravida felis gravida sed. ', '2023-06-24 22:02:35', '2023-07-03 09:31:24', 1),
(93, 'Simulation réseau sur CISCO', '64a27abdf03371.83026240.png', 'Nulla quis nisi consectetur, blandit lorem sed, feugiat ante. Aenean lorem ex, lobortis eu eleifend quis, lacinia eget nisl. Nunc est enim, rhoncus ut viverra at, ultricies ut mauris. In volutpat suscipit rutrum. Duis sollicitudin ligula id iaculis tempus. Duis fermentum mauris eu quam egestas, vel efficitur turpis malesuada. Curabitur vel aliquam risus, eu pulvinar nibh. ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sit amet augue vel erat iaculis pulvinar. Mauris mollis pulvinar nunc nec vestibulum. Vestibulum dignissim elementum iaculis. Maecenas ornare ex at ornare accumsan. Suspendisse sagittis in magna ac accumsan. Duis tempus, erat vitae tincidunt maximus, eros lectus accumsan dolor, nec efficitur ipsum lectus eget risus. Phasellus posuere ornare neque vitae laoreet. Cras varius ligula ac erat blandit euismod. Duis at orci libero. Duis ornare neque sed ipsum ultricies sollicitudin. Curabitur volutpat est a facilisis sodales. Sed eget neque et velit cursus viverra vitae sed ipsum. Nulla at nisl eget turpis ultricies auctor. Aenean nec hendrerit sem, sit amet interdum dolor.\r\n\r\nNulla quis nisi consectetur, blandit lorem sed, feugiat ante. Aenean lorem ex, lobortis eu eleifend quis, lacinia eget nisl. Nunc est enim, rhoncus ut viverra at, ultricies ut mauris. In volutpat suscipit rutrum. Duis sollicitudin ligula id iaculis tempus. Duis fermentum mauris eu quam egestas, vel efficitur turpis malesuada. Curabitur vel aliquam risus, eu pulvinar nibh.\r\n\r\nAliquam erat volutpat. Nulla eu rutrum augue, eget fringilla tortor. Nullam ut nulla aliquet, semper nulla vitae, feugiat dolor. Cras fermentum enim sit amet sapien pharetra, non eleifend justo cursus. Proin tempor lacus sed dictum vestibulum. Curabitur porta porttitor enim id pharetra. Ut eget mollis nunc. Vestibulum auctor, ipsum quis iaculis accumsan, lorem leo sodales enim, in facilisis lorem dui ut justo. Vestibulum blandit, libero et condimentum venenatis, nisl lacus dictum ante, sit amet pulvinar ligula tellus nec mauris. Nullam dictum massa vitae turpis malesuada sollicitudin.\r\n\r\nCurabitur eu molestie dui, eget commodo lectus. Morbi accumsan pellentesque interdum. In scelerisque auctor justo, non mattis justo pulvinar a. Suspendisse nibh metus, eleifend non ullamcorper quis, aliquet eu lorem. Donec ipsum nulla, ornare in dui non, volutpat fringilla eros. Morbi pulvinar tellus ornare justo condimentum, sed mollis massa vestibulum. Integer gravida tortor diam, ac pellentesque arcu porttitor ut. Maecenas tempus fringilla volutpat. Donec nec consectetur neque, non placerat libero. Etiam cursus nibh feugiat, congue diam non, ornare felis. Curabitur non hendrerit nulla, nec mattis erat.\r\n\r\nNam in eros nec velit vestibulum maximus. Suspendisse eget nibh sodales, mattis odio nec, ullamcorper felis. Integer nec orci quis neque malesuada tincidunt vel eu sapien. Cras dictum ac nulla efficitur posuere. Proin sollicitudin lorem non lectus pellentesque, id convallis libero pharetra. Aliquam vel lobortis dui, a euismod eros. Etiam in ex id diam pretium rhoncus a ac turpis. Nam pharetra diam non risus tincidunt eleifend. In volutpat sollicitudin semper. Aliquam vel sagittis sapien. Nunc auctor arcu nulla, tempus gravida felis gravida sed. ', '2023-06-24 22:04:17', '2023-07-03 09:37:33', 1),
(94, 'Les serveurs informatiques', '64974c5eed4458.90032710.png', 'Nulla quis nisi consectetur, blandit lorem sed, feugiat ante. Aenean lorem ex, lobortis eu eleifend quis, lacinia eget nisl. Nunc est enim, rhoncus ut viverra at, ultricies ut mauris. In volutpat suscipit rutrum. Duis sollicitudin ligula id iaculis tempus. Duis fermentum mauris eu quam egestas, vel efficitur turpis malesuada. Curabitur vel aliquam risus, eu pulvinar nibh. ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sit amet augue vel erat iaculis pulvinar. Mauris mollis pulvinar nunc nec vestibulum. Vestibulum dignissim elementum iaculis. Maecenas ornare ex at ornare accumsan. Suspendisse sagittis in magna ac accumsan. Duis tempus, erat vitae tincidunt maximus, eros lectus accumsan dolor, nec efficitur ipsum lectus eget risus. Phasellus posuere ornare neque vitae laoreet. Cras varius ligula ac erat blandit euismod. Duis at orci libero. Duis ornare neque sed ipsum ultricies sollicitudin. Curabitur volutpat est a facilisis sodales. Sed eget neque et velit cursus viverra vitae sed ipsum. Nulla at nisl eget turpis ultricies auctor. Aenean nec hendrerit sem, sit amet interdum dolor.\r\n\r\nNulla quis nisi consectetur, blandit lorem sed, feugiat ante. Aenean lorem ex, lobortis eu eleifend quis, lacinia eget nisl. Nunc est enim, rhoncus ut viverra at, ultricies ut mauris. In volutpat suscipit rutrum. Duis sollicitudin ligula id iaculis tempus. Duis fermentum mauris eu quam egestas, vel efficitur turpis malesuada. Curabitur vel aliquam risus, eu pulvinar nibh.\r\n\r\nAliquam erat volutpat. Nulla eu rutrum augue, eget fringilla tortor. Nullam ut nulla aliquet, semper nulla vitae, feugiat dolor. Cras fermentum enim sit amet sapien pharetra, non eleifend justo cursus. Proin tempor lacus sed dictum vestibulum. Curabitur porta porttitor enim id pharetra. Ut eget mollis nunc. Vestibulum auctor, ipsum quis iaculis accumsan, lorem leo sodales enim, in facilisis lorem dui ut justo. Vestibulum blandit, libero et condimentum venenatis, nisl lacus dictum ante, sit amet pulvinar ligula tellus nec mauris. Nullam dictum massa vitae turpis malesuada sollicitudin.\r\n\r\nCurabitur eu molestie dui, eget commodo lectus. Morbi accumsan pellentesque interdum. In scelerisque auctor justo, non mattis justo pulvinar a. Suspendisse nibh metus, eleifend non ullamcorper quis, aliquet eu lorem. Donec ipsum nulla, ornare in dui non, volutpat fringilla eros. Morbi pulvinar tellus ornare justo condimentum, sed mollis massa vestibulum. Integer gravida tortor diam, ac pellentesque arcu porttitor ut. Maecenas tempus fringilla volutpat. Donec nec consectetur neque, non placerat libero. Etiam cursus nibh feugiat, congue diam non, ornare felis. Curabitur non hendrerit nulla, nec mattis erat.\r\n\r\nNam in eros nec velit vestibulum maximus. Suspendisse eget nibh sodales, mattis odio nec, ullamcorper felis. Integer nec orci quis neque malesuada tincidunt vel eu sapien. Cras dictum ac nulla efficitur posuere. Proin sollicitudin lorem non lectus pellentesque, id convallis libero pharetra. Aliquam vel lobortis dui, a euismod eros. Etiam in ex id diam pretium rhoncus a ac turpis. Nam pharetra diam non risus tincidunt eleifend. In volutpat sollicitudin semper. Aliquam vel sagittis sapien. Nunc auctor arcu nulla, tempus gravida felis gravida sed. ', '2023-06-24 22:04:46', '2023-07-03 09:36:34', 1),
(97, 'Fonctionnement du langage PHP', '64a279b41631e4.10404738.png', 'Nulla quis nisi consectetur, blandit lorem sed, feugiat ante. Aenean lorem ex, lobortis eu eleifend quis, lacinia eget nisl. Nunc est enim, rhoncus ut viverra at, ultricies ut mauris. In volutpat suscipit rutrum. Duis sollicitudin ligula id iaculis tempus. Duis fermentum mauris eu quam egestas, vel efficitur turpis malesuada. Curabitur vel aliquam risus, eu pulvinar nibh. ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sit amet augue vel erat iaculis pulvinar. Mauris mollis pulvinar nunc nec vestibulum. Vestibulum dignissim elementum iaculis. Maecenas ornare ex at ornare accumsan. Suspendisse sagittis in magna ac accumsan. Duis tempus, erat vitae tincidunt maximus, eros lectus accumsan dolor, nec efficitur ipsum lectus eget risus. Phasellus posuere ornare neque vitae laoreet. Cras varius ligula ac erat blandit euismod. Duis at orci libero. Duis ornare neque sed ipsum ultricies sollicitudin. Curabitur volutpat est a facilisis sodales. Sed eget neque et velit cursus viverra vitae sed ipsum. Nulla at nisl eget turpis ultricies auctor. Aenean nec hendrerit sem, sit amet interdum dolor.\r\n\r\nNulla quis nisi consectetur, blandit lorem sed, feugiat ante. Aenean lorem ex, lobortis eu eleifend quis, lacinia eget nisl. Nunc est enim, rhoncus ut viverra at, ultricies ut mauris. In volutpat suscipit rutrum. Duis sollicitudin ligula id iaculis tempus. Duis fermentum mauris eu quam egestas, vel efficitur turpis malesuada. Curabitur vel aliquam risus, eu pulvinar nibh.\r\n\r\nAliquam erat volutpat. Nulla eu rutrum augue, eget fringilla tortor. Nullam ut nulla aliquet, semper nulla vitae, feugiat dolor. Cras fermentum enim sit amet sapien pharetra, non eleifend justo cursus. Proin tempor lacus sed dictum vestibulum. Curabitur porta porttitor enim id pharetra. Ut eget mollis nunc. Vestibulum auctor, ipsum quis iaculis accumsan, lorem leo sodales enim, in facilisis lorem dui ut justo. Vestibulum blandit, libero et condimentum venenatis, nisl lacus dictum ante, sit amet pulvinar ligula tellus nec mauris. Nullam dictum massa vitae turpis malesuada sollicitudin.\r\n\r\nCurabitur eu molestie dui, eget commodo lectus. Morbi accumsan pellentesque interdum. In scelerisque auctor justo, non mattis justo pulvinar a. Suspendisse nibh metus, eleifend non ullamcorper quis, aliquet eu lorem. Donec ipsum nulla, ornare in dui non, volutpat fringilla eros. Morbi pulvinar tellus ornare justo condimentum, sed mollis massa vestibulum. Integer gravida tortor diam, ac pellentesque arcu porttitor ut. Maecenas tempus fringilla volutpat. Donec nec consectetur neque, non placerat libero. Etiam cursus nibh feugiat, congue diam non, ornare felis. Curabitur non hendrerit nulla, nec mattis erat.\r\n\r\nNam in eros nec velit vestibulum maximus. Suspendisse eget nibh sodales, mattis odio nec, ullamcorper felis. Integer nec orci quis neque malesuada tincidunt vel eu sapien. Cras dictum ac nulla efficitur posuere. Proin sollicitudin lorem non lectus pellentesque, id convallis libero pharetra. Aliquam vel lobortis dui, a euismod eros. Etiam in ex id diam pretium rhoncus a ac turpis. Nam pharetra diam non risus tincidunt eleifend. In volutpat sollicitudin semper. Aliquam vel sagittis sapien. Nunc auctor arcu nulla, tempus gravida felis gravida sed. ', '2023-06-25 00:23:54', '2023-07-03 09:33:08', 1),
(100, 'Projet WordPress : Chalets et Caviar', '649a96ace5f532.40421742.png', 'Nulla quis nisi consectetur, blandit lorem sed, feugiat ante. Aenean lorem ex, lobortis eu eleifend quis, lacinia eget nisl. Nunc est enim, rhoncus ut viverra at, ultricies ut mauris. In volutpat suscipit rutrum. Duis sollicitudin ligula id iaculis tempus. Duis fermentum mauris eu quam egestas, vel efficitur turpis malesuada. Curabitur vel aliquam risus, eu pulvinar nibh.', 'Nulla quis nisi consectetur, blandit lorem sed, feugiat ante. Aenean lorem ex, lobortis eu eleifend quis, lacinia eget nisl. Nunc est enim, rhoncus ut viverra at, ultricies ut mauris. In volutpat suscipit rutrum. Duis sollicitudin ligula id iaculis tempus. Duis fermentum mauris eu quam egestas, vel efficitur turpis malesuada. Curabitur vel aliquam risus, eu pulvinar nibh.  Nulla quis nisi consectetur, blandit lorem sed, feugiat ante. Aenean lorem ex, lobortis eu eleifend quis, lacinia eget nisl. Nunc est enim, rhoncus ut viverra at, ultricies ut mauris. In volutpat suscipit rutrum. Duis sollicitudin ligula id iaculis tempus. Duis fermentum mauris eu quam egestas, vel efficitur turpis malesuada. Curabitur vel aliquam risus, eu pulvinar nibh.  Nulla quis nisi consectetur, blandit lorem sed, feugiat ante. Aenean lorem ex, lobortis eu eleifend quis, lacinia eget nisl. Nunc est enim, rhoncus ut viverra at, ultricies ut mauris. In volutpat suscipit rutrum. Duis sollicitudin ligula id iaculis tempus. Duis fermentum mauris eu quam egestas, vel efficitur turpis malesuada. Curabitur vel aliquam risus, eu pulvinar nibh.  Nulla quis nisi consectetur, blandit lorem sed, feugiat ante. Aenean lorem ex, lobortis eu eleifend quis, lacinia eget nisl. Nunc est enim, rhoncus ut viverra at, ultricies ut mauris. In volutpat suscipit rutrum. Duis sollicitudin ligula id iaculis tempus. Duis fermentum mauris eu quam egestas, vel efficitur turpis malesuada. Curabitur vel aliquam risus, eu pulvinar nibh. ', '2023-06-27 09:58:36', '2023-07-03 09:35:36', 1);

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `id_article` smallint(5) UNSIGNED NOT NULL,
  `contenu` longtext NOT NULL,
  `date_creation` datetime NOT NULL,
  `valide` tinyint(1) NOT NULL,
  `id_utilisateur` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id`, `id_article`, `contenu`, `date_creation`, `valide`, `id_utilisateur`) VALUES
(4, 92, 'Nulla quis nisi consectetur, blandit lorem sed, feugiat ante. Aenean lorem ex, lobortis eu eleifend quis, lacinia eget nisl. Nunc est enim, rhoncus ut viverra at, ultricies ut mauris. In volutpat suscipit rutrum. Duis sollicitudin ligula id iaculis tempus. Duis fermentum mauris eu quam egestas, vel efficitur turpis malesuada. Curabitur vel aliquam risus, eu pulvinar nibh. ', '2023-06-27 16:16:45', 0, 1),
(5, 92, 'Nulla quis nisi consectetur, blandit lorem sed, feugiat ante. Aenean lorem ex, lobortis eu eleifend quis, lacinia eget nisl. Nunc est enim, rhoncus ut viverra at, ultricies ut mauris. In volutpat suscipit rutrum. Duis sollicitudin ligula id iaculis tempus. Duis fermentum mauris eu quam egestas, vel efficitur turpis malesuada. Curabitur vel aliquam risus, eu pulvinar nibh. ', '2023-06-27 16:17:07', 1, 1),
(6, 92, 'Nulla quis nisi consectetur, blandit lorem sed, feugiat ante. Aenean lorem ex, lobortis eu eleifend quis, lacinia eget nisl. Nunc est enim, rhoncus ut viverra at, ultricies ut mauris. In volutpat suscipit rutrum. Duis sollicitudin ligula id iaculis tempus. Duis fermentum mauris eu quam egestas, vel efficitur turpis malesuada. Curabitur vel aliquam risus, eu pulvinar nibh. ', '2023-06-27 16:17:42', 0, 1),
(8, 92, 'Nulla quis nisi consectetur, blandit lorem sed, feugiat ante. Aenean lorem ex, lobortis eu eleifend quis, lacinia eget nisl. Nunc est enim, rhoncus ut viverra at, ultricies ut mauris. In volutpat suscipit rutrum. Duis sollicitudin ligula id iaculis tempus. Duis fermentum mauris eu quam egestas, vel efficitur turpis malesuada. Curabitur vel aliquam risus, eu pulvinar nibh. ', '2023-06-28 23:57:10', 1, 2),
(9, 92, 'Nulla quis nisi consectetur, blandit lorem sed, feugiat ante. Aenean lorem ex, lobortis eu eleifend quis, lacinia eget nisl. Nunc est enim, rhoncus ut viverra at, ultricies ut mauris. In volutpat suscipit rutrum. Duis sollicitudin ligula id iaculis tempus. Duis fermentum mauris eu quam egestas, vel efficitur turpis malesuada. Curabitur vel aliquam risus, eu pulvinar nibh. ', '2023-06-29 00:30:26', 1, 4),
(12, 92, 'Nulla quis nisi consectetur, blandit lorem sed, feugiat ante. Aenean lorem ex, lobortis eu eleifend quis, lacinia eget nisl. Nunc est enim, rhoncus ut viverra at, ultricies ut mauris. In volutpat suscipit rutrum. Duis sollicitudin ligula id iaculis tempus. Duis fermentum mauris eu quam egestas, vel efficitur turpis malesuada. Curabitur vel aliquam risus, eu pulvinar nibh. ', '2023-06-29 17:03:59', 0, 1),
(14, 97, 'Nulla quis nisi consectetur, blandit lorem sed, feugiat ante. Aenean lorem ex, lobortis eu eleifend quis, lacinia eget nisl. Nunc est enim, rhoncus ut viverra at, ultricies ut mauris. In volutpat suscipit rutrum. Duis sollicitudin ligula id iaculis tempus. Duis fermentum mauris eu quam egestas, vel efficitur turpis malesuada. Curabitur vel aliquam risus, eu pulvinar nibh. ', '2023-06-29 19:45:18', 0, 6),
(15, 97, 'Nulla quis nisi consectetur, blandit lorem sed, feugiat ante. Aenean lorem ex, lobortis eu eleifend quis, lacinia eget nisl. Nunc est enim, rhoncus ut viverra at, ultricies ut mauris. In volutpat suscipit rutrum. Duis sollicitudin ligula id iaculis tempus. Duis fermentum mauris eu quam egestas, vel efficitur turpis malesuada. Curabitur vel aliquam risus, eu pulvinar nibh. ', '2023-06-29 20:19:57', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) NOT NULL,
  `adresse_mail` varchar(125) NOT NULL,
  `mot_de_passe` varchar(125) NOT NULL,
  `valide` tinyint(1) UNSIGNED NOT NULL,
  `role` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `adresse_mail`, `mot_de_passe`, `valide`, `role`) VALUES
(1, 'VOIRIOT', 'Alban', 'alban.voiriot@gmail.com', '$2y$10$7dWwcv4WyKksyHFjNSexVeGJ1WrXd1IMC8e2baevB0OaLUMzYQEAW', 1, 'admin'),
(2, 'VOIRIOT', 'Robin', 'robin.voiriot@gmail.com', '$2y$10$MvxyBYo283xeszvrpX.AeOGVsrBz0V5nloIAYkW5BJ5QeOIsoK9ui', 1, 'user'),
(3, 'VOIRIOT', 'Emmanuel', 'emmanuel.voiriot@gmail.com', '$2y$10$LestpwbNWGdJ.lZmVDq57OLYuRS0MLYPZ97JwVJzTVsPhMeGnWjBu', 1, 'user'),
(4, 'VOIRIOT', 'Vola', 'vola.voiriot@gmail.com', '$2y$10$3O5No7.XsmS02MwBXAWXhOCBfh6RcDroia6fEiVxxeqJosTo7bv2u', 1, 'user'),
(8, 'VOIRIOT', 'Tom', 'tom.voiriot@gmail.com', '$2y$10$IB1UW26aJOHF7DV6HxhqT.fQKJp.paLmrcgDPgqPiR7kOeZ7NNUua', 0, 'user'),
(10, 'UserOpenClassrooms', 'UserOpenClassrooms', 'user@openclassrooms.fr', '$2y$10$g/z2NPnddc95nGJhZ.u83eC6gRemzk0hpLl7FTedljUxVBybgNfZi', 1, 'admin');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Utilisateur` (`id_utilisateur`) USING BTREE;

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id`,`id_article`),
  ADD KEY `idUtilisateur` (`id_utilisateur`) USING BTREE,
  ADD KEY `idArticle` (`id_article`) USING BTREE;

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
