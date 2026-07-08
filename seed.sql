INSERT INTO `agence` (`id_agence`, `nom_ville`) VALUES
(1, 'Paris'),
(2, 'Lyon'),
(3, 'Marseille'),
(4, 'Toulouse'),
(5, 'Nice'),
(6, 'Nantes'),
(7, 'Strasbourg'),
(8, 'Montpellier'),
(9, 'Bordeaux'),
(10, 'Lille'),
(11, 'Rennes'),
(14, 'Reims');

INSERT INTO `user` (`id_user`, `nom`, `prenom`, `email`, `telephone`, `mot_de_passe`, `role`) VALUES
(1, 'Martin', 'Alexandre', 'alexandre.martin@email.fr', '0612345678', '$2y$10$KTvE.Z6evPXcQsH4WTq0V.P9gBrc.PyWWSfvdrYRx6QX6KW6UNXey', 'admin'),
(2, 'Dubois', 'Sophie', 'sophie.dubois@email.fr', '0698765432', '$2y$10$hRzQlUC3gqg8M7vC6HGOUesm7b.I5Fcz2olPmuu6qbT8o2ganfuma', 'user'),
(3, 'Bernard', 'Julien', 'julien.bernard@email.fr', '0622446688', '$2y$10$Xini.pJlq6H2Z8jfTvdPKuVS9Z6Ne7tamNtDGc5K53r8L26nBDb/C', 'user'),
(4, 'Moreau', 'Camille', 'camille.moreau@email.fr', '0611223344', '$2y$10$oNKtY.C17zOampJ2rjqp3.YoPhrheTsl3dM9r.VlAWAAJrkikwa0m', 'user'),
(5, 'Lefèvre', 'Lucie', 'lucie.lefevre@email.fr', '0777889900', '$2y$10$0d92mueibGV5tdp./KS9c.mdRTvYzotu.taCm9e/THEbvgxVJeNDi', 'user'),
(6, 'Leroy', 'Thomas', 'thomas.leroy@email.fr', '0655443322', '$2y$10$qc9aODQCfZMgdJXQciaHPuA.ZvnaV4c1dfA/gvZwHQqZnIEWOPcDO', 'user'),
(7, 'Roux', 'Chloé', 'chloe.roux@email.fr', '0633221199', '$2y$10$GFu/W/jIrWVBBjuE5HC2LuuJrblODFR7dmkXzTm2SUHu8JadqZtMe', 'user'),
(8, 'Petit', 'Maxime', 'maxime.petit@email.fr', '0766778899', '$2y$10$XG/Ia/a.NxkzycEBusyZbu3PjOQRDNbZPXFrYmDZunoy0eM7O6Kfy', 'user'),
(9, 'Garnier', 'Laura', 'laura.garnier@email.fr', '0688776655', '$2y$10$GYwo8IPStxbhe4jbwuIB3.xhti/4fRfM7qKwYD8QGvvHdVmJiHOhS', 'user'),
(10, 'Dupuis', 'Antoine', 'antoine.dupuis@email.fr', '0744556677', '$2y$10$VoGa7wXXk7z0EPJQnQO6FOtCCCaQbFsDApm4k2ay07hOHrRckPWjG', 'user'),
(11, 'Lefebvre', 'Emma', 'emma.lefebvre@email.fr', '0699887766', '$2y$10$ayel7GDD7sLJSxLW.qUOr.amMdlGcceJm37iug2tVf75cAcxc.xhi', 'user'),
(12, 'Fontaine', 'Louis', 'louis.fontaine@email.fr', '0655667788', '$2y$10$ojcuUArKJy4SSIWRXc3aA.e4mGUL75LrqhNh75QSoxP7DEJDzQUpi', 'user'),
(13, 'Chevalier', 'Clara', 'clara.chevalier@email.fr', '0788990011', '$2y$10$qp48nuoHkkc8etmGCWfwEOJaS3LgNG2Kda1el.l9XykKK4V9u7G.m', 'user'),
(14, 'Robin', 'Nicolas', 'nicolas.robin@email.fr', '0644332211', '$2y$10$3KMi/k28GtTKK1w1.O1P7OHHN73Edsv/BhGWgYISUyObP8R3UD.OS', 'user'),
(15, 'Gauthier', 'Marine', 'marine.gauthier@email.fr', '0677889922', '$2y$10$FlLwgqKqEhg797U84fOdceD5hlGlala.Fq5OwbL5qsY0ZeK0jH70O', 'user'),
(16, 'Fournier', 'Pierre', 'pierre.fournier@email.fr', '0722334455', '$2y$10$xkccICJJ0/W4ieFe7Sl0Re6jq0LqbFQzFu4hIlX6hkitHAi7bF8jG', 'user'),
(17, 'Girard', 'Sarah', 'sarah.girard@email.fr', '0688665544', '$2y$10$rQ1X/Xs8MxI.9mva1cvDGO.4N7/B8EZUV.Di2SJOoYQ17muWwHq8K', 'user'),
(18, 'Lambert', 'Hugo', 'hugo.lambert@email.fr', '0611223366', '$2y$10$6MQ1KdVwSvjzsFy5Kn/Zb.CbrGQ173q985b2JrQtyrNlPsznH3PVG', 'user'),
(19, 'Masson', 'Julie', 'julie.masson@email.fr', '0733445566', '$2y$10$cipOzBMssymSkyEggZnXJONX.EroGnPQn6/9nWlsm3dkmCLj4YlQi', 'user'),
(20, 'Henry', 'Arthur', 'arthur.henry@email.fr', '0666554433', '$2y$10$y14wgq8BSr2NrsWfwunjqOmH7a6pqWKyPUdgtZMd3.8t8MN8wCyYW', 'user');

INSERT INTO `trajet` (`id_trajet`, `gdh_depart`, `gdh_arrivee`, `nb_places_total`, `nb_places_dispo`, `id_user`, `id_agence_dep`, `id_agence_arr`) VALUES
(1, '2026-06-25 12:30:00', '2026-06-30 12:30:00', 10, 10, 2, 1, 4),
(4, '2026-11-03 12:00:00', '2026-11-04 03:00:00', 6, 6, 2, 1, 2),
(5, '2026-11-03 12:00:00', '2026-11-04 03:00:00', 6, 6, 2, 2, 6);