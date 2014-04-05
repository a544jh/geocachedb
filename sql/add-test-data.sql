INSERT INTO users (name, password, registred, role, bio)
VALUES ('testuser', '$1$s0m8Gzmo$HKI7ZxsCSLc8y27UlT6Ky.', current_date, 0, 'bio');
INSERT INTO users (name, password, registred, role, bio)
VALUES ('testadmin', '$1$BX8UaP8j$LPXUuzvtaSoP2bK7OHkrS1', current_date, 5, 'bio');
INSERT INTO geocaches (name, type, description, hint, ownerid, difficulty,
terrain, latitude, longitude, archived)
VALUES ('Test cache', 'Trad.', 'Description', 'Kiven alla',
(SELECT id FROM users WHERE name = 'testuser'), 1, 1, 60.2044349, 24.96181584, false);
