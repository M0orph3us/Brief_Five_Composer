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
--