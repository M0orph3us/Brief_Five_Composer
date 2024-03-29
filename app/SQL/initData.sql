--
-- Unloading data from the `opening` table
--
INSERT INTO
    `opening` (
        `uuid`, `opening_day`, `morning_opening_hour`, `morning_closing_hour`, `evening_opening_hour`, `evening_closing_hour`
    )
VALUES (
        0x11eee858a41541cda78b00ff64196eed, 'Lundi', '12:00:00', '15:00:00', '19:00:00', '23:00:00'
    ),
    (
        0x11eee858b369ba25a78b00ff64196eed, 'Mardi', '12:00:00', '15:00:00', '19:00:00', '23:00:00'
    ),
    (
        0x11eee858c0e85765a78b00ff64196eed, 'Mercredi', '12:00:00', '15:00:00', '19:00:00', '23:00:00'
    ),
    (
        0x11eee858ce84426ca78b00ff64196eed, 'Jeudi', '12:00:00', '15:00:00', '19:00:00', '23:00:00'
    ),
    (
        0x11eee858dfdd1f46a78b00ff64196eed, 'Vendredi', '12:00:00', '15:00:00', '19:00:00', '23:00:00'
    ),
    (
        0x11eee8597df1db84a78b00ff64196eed, 'Samedi', '12:00:00', '15:00:00', '19:00:00', '00:00:00'
    );

COMMIT;

--
-- Unloading data from the `availabletables` table
--

INSERT INTO
    `availabletables` (`uuid`, `quantity_tables`)
VALUES (
        0x11eee8572dddf837a78b00ff64196eed, 50
    );

COMMIT;

--
-- Unloading data from the `teams` table
--

INSERT INTO
    `teams` (
        `uuid`, `firstname`, `lastname`
    )
VALUES (
        0x11eeecff4276bb95853f00ff64196eed, 'Luffy', 'Monkey'
    ),
    (
        0x11eeed085119bc28853f00ff64196eed, 'Nico', 'Robin'
    ),
    (
        0x11eeed085119bf19853f00ff64196eed, 'Luke', 'Skywalker'
    );

COMMIT;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO
    `reservations` (
        `uuid`, `number_of_persons`, `baby_chair`, `reserved_on`, `uuid_users`
    )
VALUES (
        0x11eeedc88948118f853f00ff64196eed, 4, '0', '2024-04-17', 0x11eeec89544275079f6300ff64196eed
    ),
    (
        0x11eeedc8dfa6f245853f00ff64196eed, 4, '1', '2024-04-19', 0x11eeec89544275079f6300ff64196eed
    );

COMMIT;

--
-- Déchargement des données de la table `users`
--
INSERT INTO
    `users` (
        `uuid`, `firstname`, `lastname`, `mail`, `password`, `role`, `created_at`
    )
VALUES (
        0x11eeec853e04427d9f6300ff64196eed, 'admin', 'admin', 'admin@admin.com', '$2y$10$Jyczs/ig7PoSgnoAVznsXOww3u.EaI4z3dMxpMgD.2f/cUchshiYu', 'super_admin', '2024-03-27'
    ),
    (
        0x11eeec885ac3e6ff9f6300ff64196eed, 'Gael', 'MOREAU', 'moreau.gael.pro@gmail.com', '$2y$10$8JmYzCEhd7xqE4giys8gKu8xFIKs3J3Z/6Ldddoown3TJgGeqb.Du', 'admin', '2024-03-27'
    ),
    (
        0x11eeec89089ef6809f6300ff64196eed, 'Gael', 'MOREAU', 'moreau.gaaael.pro@gmail.com', '$2y$10$P7Z3nWZQSKloZThj/c6AK.BY/UyssRBbvEGR3JFpMwcjZTkW.bJ0O', 'user', '2024-03-27'
    ),
    (
        0x11eeec89544275079f6300ff64196eed, 'Gaellle', 'MOREAU', 'moreeeeau.gael.pro@gmail.com', '$2y$10$Zp8e97G4pxu35glkdrM8guz6v6/AQGnEDP/lOPpadaszhFYb7zZOO', 'user', '2024-03-27'
    );

COMMIT;