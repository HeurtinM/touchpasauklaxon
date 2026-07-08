CREATE TABLE `agence` (
  `id_agence` int(11) NOT NULL,
  `nom_ville` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(50) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `trajet` (
  `id_trajet` int(11) NOT NULL,
  `gdh_depart` datetime NOT NULL,
  `gdh_arrivee` datetime NOT NULL,
  `nb_places_total` int(11) NOT NULL,
  `nb_places_dispo` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_agence_dep` int(11) NOT NULL,
  `id_agence_arr` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `agence`
  ADD PRIMARY KEY (`id_agence`);

ALTER TABLE `trajet`
  ADD PRIMARY KEY (`id_trajet`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_agence_dep` (`id_agence_dep`),
  ADD KEY `id_agence_arr` (`id_agence_arr`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

ALTER TABLE `agence`
  MODIFY `id_agence` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `trajet`
  MODIFY `id_trajet` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `trajet`
  ADD CONSTRAINT `trajet_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `trajet_ibfk_2` FOREIGN KEY (`id_agence_dep`) REFERENCES `agence` (`id_agence`),
  ADD CONSTRAINT `trajet_ibfk_3` FOREIGN KEY (`id_agence_arr`) REFERENCES `agence` (`id_agence`);