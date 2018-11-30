-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Mer 07 Novembre 2018 à 14:18
-- Version du serveur :  5.7.24-0ubuntu0.18.04.1
-- Version de PHP :  7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `db_intrawild`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(8) NOT NULL,
  `title` varchar(64) NOT NULL,
  `content` text NOT NULL,
  `date_actuality` datetime DEFAULT NULL,
  `id_author` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `article`
--

INSERT INTO `article` (`id`, `title`, `content`, `date_actuality`, `id_author`) VALUES
(5, 'Hackathon à la WCS', '<p>Les 30 et 31 octobre 2018 a eu lieu le premier hackathon de la promo de septembre 2018.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Si tu as fait ce hackathon, tu t&rsquo;es s&ucirc;rement senti lessiv&eacute; de cette exp&eacute;rience. Rassure-toi, c&rsquo;est normal !</p>\r\n\r\n<p>Tous les anciens sont pass&eacute;s par l&agrave; avant toi.</p>\r\n\r\n<p>Mais si tu as surv&eacute;cu &agrave; ce hackathon, tu as d&ucirc; te rendre compte que tu as &eacute;norm&eacute;ment appris.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>C&rsquo;est &ccedil;a la magie du hackathon : apprendre en 2 jours plus que tu n&rsquo;aurais appris en 2 semaines.</p>\r\n\r\n<p>Tu es pouss&eacute; dans tes retranchements, tu dois apprendre &agrave; travailler sous pression. A cause de &ccedil;a, tu dois g&eacute;rer ton stress, et savoir classer tes objectifs par priorit&eacute;s.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Le but principal est de faire un travail efficace et propre, en 2 jours de temps, alors qu&rsquo;on te demande un travail assez&hellip; mastoc !</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Mais tu es un grand d&eacute;veloppeur en devenir, parfois en entreprise tu seras confront&eacute; &agrave; des situations identiques : on te demandera de r&eacute;parer un bug, ou de cr&eacute;er une nouvelle fonctionnalit&eacute; &agrave; la derni&egrave;re minute.<br>Et comme tu as &eacute;t&eacute; choisi &agrave; la Wild pour ton esprit de combativit&eacute;, tu te sortiras de chaque situation comme un gagnant.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>M&ecirc;me si tu as &eacute;ventuellement rat&eacute; ce premier hackathon, tu vas pouvoir te remettre en question, comprendre tes erreurs.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Sors de cette exp&eacute;rience grandi petit Yoda ;)</p>\r\n', '2018-11-07 12:32:28', 14),
(6, 'Save the date : visite chez IBM', '<p>Le 22 novembre prochain aura lieu la visite des locaux d&rsquo;IBM.</p>\r\n\r\n<p>Rencontre avec l&rsquo;&eacute;quipe, pr&eacute;sentation de l&rsquo;entreprise&hellip; Ce sera l&rsquo;occasion pour toi de montrer qui tu es, montrer ce que tu vaux, mais surtout rendre int&eacute;ressant ton profil pour donner envie aux recruteurs de t&rsquo;engager en stage ;)</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>N&rsquo;h&eacute;site pas &agrave; venir avec ton CV (mais attention, avec un CV joli comme tu as appris &agrave; le faire pendant l&rsquo;atelier CV :) ), mais surtout &agrave; discuter aux recruteurs et &agrave; l&rsquo;&eacute;quipe pendant la visite ;)</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Exerce ton pouvoir charismatique pour charmer IBM et, pourquoi pas, r&eacute;ussir &agrave; int&eacute;grer l&rsquo;&eacute;quipe :)</p>\r\n', '2018-11-07 12:32:52', 14);

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int(8) NOT NULL,
  `name` varchar(64) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `category`
--

INSERT INTO `category` (`id`, `name`, `description`) VALUES
(1, 'Aide', 'Discussion générale de sujets d\'aides'),
(2, 'Veille', 'Discussion générale sur les veilles'),
(3, 'Divers', 'Discussion générale');

-- --------------------------------------------------------

--
-- Structure de la table `language`
--

CREATE TABLE `language` (
  `id` int(8) NOT NULL,
  `language` varchar(16) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `language`
--

INSERT INTO `language` (`id`, `language`) VALUES
(1, 'PHP'),
(2, 'Javascript'),
(3, 'undefined'),
(4, 'unknow');

-- --------------------------------------------------------

--
-- Structure de la table `promotion`
--

CREATE TABLE `promotion` (
  `id` int(11) NOT NULL,
  `promotion` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `promotion`
--

INSERT INTO `promotion` (`id`, `promotion`) VALUES
(1, 'septembre_2018'),
(2, 'janvier_2019'),
(3, 'undefined');

-- --------------------------------------------------------

--
-- Structure de la table `reply`
--

CREATE TABLE `reply` (
  `id` int(8) NOT NULL,
  `content` text NOT NULL,
  `date` datetime NOT NULL,
  `user_id` int(8) NOT NULL,
  `topic_id` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `topic`
--

CREATE TABLE `topic` (
  `id` int(8) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `user_id` int(8) NOT NULL,
  `category_id` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `topic`
--

INSERT INTO `topic` (`id`, `subject`, `date`, `user_id`, `category_id`) VALUES
(1, 'PHP', '2018-10-16 00:00:00', 50, 1),
(2, 'JavaScript', '2018-10-16 00:00:00', 50, 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(8) NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) DEFAULT NULL COMMENT '1 for staff, 0 for students',
  `mobile` int(10) DEFAULT NULL,
  `github` varchar(32) DEFAULT NULL,
  `gitlab` varchar(32) DEFAULT NULL,
  `linkedin` varchar(32) DEFAULT NULL,
  `google_drive_mail` varchar(255) DEFAULT NULL,
  `description` text,
  `creationDate` datetime DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `token` varchar(10) DEFAULT NULL,
  `token_expire` datetime DEFAULT NULL,
  `is_confirmed` tinyint(1) DEFAULT NULL COMMENT 'if 0 : is not confirmed; if 1 : confirmed',
  `id_language` int(1) DEFAULT NULL COMMENT '1 for PHP, 2 for JS, 3 for undefined, 4 for unknown',
  `id_promotion` int(1) DEFAULT NULL COMMENT '1 for Sept 18, 2 for Janv 2019, 3 for undefined'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `email`, `password`, `role`, `mobile`, `github`, `gitlab`, `linkedin`, `google_drive_mail`, `description`, `creationDate`, `avatar`, `token`, `token_expire`, `is_confirmed`, `id_language`, `id_promotion`) VALUES
(40, 'Loic', 'Brassart', '', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'loic_brassart.jpg', NULL, NULL, NULL, 3, 3),
(41, 'Gaetan', 'Rolé-Dubruille', 'role-d_g@epitech;eu', 'undefined', 1, NULL, NULL, NULL, NULL, '', 'Passionné de muscul depuis 30 ans, je soulève 200 grammes en développé couché. J\'ai appelé mon chien Regex par amour pour le code.', '2018-10-17 00:00:00', 'gaetan_role.jpg', NULL, NULL, 0, 3, 3),
(45, 'Olivier', 'Trentesaux', '', 'undefined', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-10-17 00:00:00', 'olivier_trentesaux.jpg', NULL, NULL, NULL, 3, 3),
(47, 'Ellie', 'Delattre', '', 'undefined', 0, NULL, NULL, NULL, NULL, NULL, NULL, '2018-10-17 00:00:00', 'elie_delattre.jpg', NULL, NULL, NULL, 2, 1),
(49, 'Marc', 'Castelain', 'ma.castelain@gmail.com', '$2y$10$IyOpjFdTo8icv/d/jRj0QeoJFpmKRFwQjydfmNzb0GMvLjEhaO.GC', 1, NULL, NULL, NULL, NULL, NULL, 'Fervent défenseur des droits des oies du galapagos, j\'adore déguster du whisky face à un coucher de soleil habillé en tenue d\'Adam.', '2018-11-05 16:49:35', 'marc_castelain.jpg', '', '2018-11-05 17:31:48', 1, 1, 1),
(50, 'Thomas', 'Sy', 'sy.thomas.pro@gmail.com', '$2y$10$.xWTZNjsTFSHeA8sqTVU8ecIezouRxUu4/Mn2qVFTDj4BCWpgHom2', 1, NULL, NULL, NULL, NULL, NULL, 'Féru de lecture de magazines animaliers, j\'aime aussi cultiver de l\'herbe de cannabis dans ma chambre en me raccordant illégalement sur le disjoncteur de la voisine.', '2018-11-05 17:51:55', 'thomas_sy.jpg', NULL, NULL, 0, 1, 1),
(51, 'Emma', 'Kimpe', 'emmaemobaka@gmail.com', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'emma_kimpe.jpg', NULL, NULL, NULL, 2, 1),
(52, 'Jérôme', 'Vignerot', 'jer.vignerot@gmail.com', '', 0, NULL, NULL, NULL, NULL, NULL, 'Actuellement en panne de box internet, j\'utilise le partage de connexion de mon abonnement téléphonique,  d\'où ma dernière facture de 15 000$', NULL, 'jerome_vignerot.jpg', NULL, NULL, NULL, 1, 1),
(53, 'Nicolas', 'Bogucki', '', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'nicolas_bogucki.jpg', NULL, NULL, NULL, 1, 1),
(55, 'Steven', 'Antal', '', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'steven_antal.jpg', NULL, NULL, NULL, 2, 1),
(57, 'Maureen', 'Vinchent', '', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'maureen_vinchent.jpg', NULL, NULL, NULL, 2, 1),
(60, 'Antoine', 'Maluta', '', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'antoine_maluta.jpg', NULL, NULL, NULL, 2, 1),
(61, 'Nicolas', 'Duhamel', '', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'nicolas_duhamel.jpg', NULL, NULL, NULL, 2, 1),
(64, 'Emilie', 'Boeglen', '', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'emilie_boeglen.jpg', NULL, NULL, NULL, 2, 1),
(65, 'François-Axel', 'Gaveau', '', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'francois-axel_gaveau.jpg', NULL, NULL, NULL, 2, 1),
(66, 'Arlensiu', 'Celis', '', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'arlensiu_celis.jpg', NULL, NULL, NULL, 2, 1),
(69, 'Jean-Michel', 'Bravo', '', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'jean-michel_bravo.jpg', NULL, NULL, NULL, 2, 1),
(70, 'Vincent', 'Leschaeve', '', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'vincent_leschaeve.jpg', NULL, NULL, NULL, 1, 1),
(71, 'Julie', 'Delmas', '', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'julie_delmas.jpg', NULL, NULL, NULL, 1, 1),
(72, 'Julien', 'Sambon', '', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'julien_sambon.jpg', NULL, NULL, NULL, 1, 1),
(73, 'Florian', 'Radureau', '', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'florian_radureau.jpg', NULL, NULL, NULL, 1, 1),
(74, 'Vladimir', 'Solovev', '', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'vladimir_solovev.jpg', NULL, NULL, NULL, 1, 1),
(75, 'Fleur', 'Castel', '', '', 0, NULL, NULL, NULL, NULL, NULL, 'Curieuse de tout, j\'aime la vie et les petits oiseaux qui chantent !', NULL, 'fleur_castel.jpg', NULL, NULL, NULL, 1, 1),
(76, 'Christophe', 'Kuchmac', '', '', 0, NULL, NULL, NULL, NULL, NULL, 'J\'adore la moto et les édredons en cachemire', NULL, 'christophe_kuchmac.jpg', NULL, NULL, NULL, 1, 1),
(77, 'Sami', 'Aid', '', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'sami_aid.jpg', NULL, NULL, NULL, 1, 1),
(80, 'Bill', 'Gates', 'bill.gates@gmail.com', '', 1, NULL, NULL, NULL, NULL, NULL, 'Futur étudiant à la Wild, je suis passé modifier mon profil afin d\'être visible par tous les Wilders dans ce sublime intranet de Lille !', NULL, 'bill_gates.jpg', NULL, NULL, NULL, 4, 2);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `topic_id` (`topic_id`);

--
-- Index pour la table `topic`
--
ALTER TABLE `topic`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_language` (`id_language`),
  ADD KEY `fk_user_promotion` (`id_promotion`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `language`
--
ALTER TABLE `language`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `promotion`
--
ALTER TABLE `promotion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `reply`
--
ALTER TABLE `reply`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `topic`
--
ALTER TABLE `topic`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `reply`
--
ALTER TABLE `reply`
  ADD CONSTRAINT `fk_reply_topic_id` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id`),
  ADD CONSTRAINT `fk_reply_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `topic`
--
ALTER TABLE `topic`
  ADD CONSTRAINT `fk_topic_category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `fk_topic_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_language` FOREIGN KEY (`id_language`) REFERENCES `language` (`id`),
  ADD CONSTRAINT `fk_user_promotion` FOREIGN KEY (`id_promotion`) REFERENCES `promotion` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
