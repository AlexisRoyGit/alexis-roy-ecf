INSERT INTO images_courses(title, name) VALUES ('Foie gras', 'restaurant-1819024_1280.jpg'), ('Saumon fumé', 'max-griss-vyD0eV_5n8Q-unsplash.jpg'),
('Bœuf grillé', 'steak-2272464_1280.jpg'), ('Filet de daurade','fish-716691_1280.jpg'), ('Profiterolles','profiteroles-5750728_1280.jpg');


INSERT INTO hours (hoursNoon, hoursEvening) VALUES ('11:30 - 13:30','20:00 - 23:00'), ('11:30 - 13:30','20:00 - 23:00');
INSERT INTO hours (isClosed) VALUES (1);
INSERT INTO hours (hoursNoon, hoursEvening) VALUES ('11:30 - 13:30','20:00 - 23:00'), ('11:30 - 13:30','20:00 - 23:00'), (null ,'20:00 - 23:30'), ('12:00 - 14:30', null);

INSERT INTO admins VALUES (UUID(), 'adminemail@email.com', '$2y$10$uHOazM9uQagkUGqQ29bgiu8QfQH4QhISMPNYNTsyNbPl/HZpMjH4e');

# Le hash correspond au mot de passe 'password'

INSERT INTO clients VALUES (UUID(), 'clientemail@email.com', '$2y$10$MvdAQT2XPQsXeY9CPPFtnuMbp3/9YyRxDvwi2rd6o.uDwuaOmGyKy', 4, 'Arachides');

# Le hash correspond au mot de passe 'p4$$word'

INSERT INTO reservation(id_reservation, date, hour, guests, allergies) VALUES (UUID(), '2023-05-27', '22:15', 2, 'Arachides'), (UUID(), '2023-05-29', '12:15', 3, 'Soja'), (UUID(), '2023-06-02', '21:00', 5, null);

# Modification de la capacité des convives aux dates ci-dessus 

UPDATE reservation SET limit_capacity = 98 WHERE date = '2023-05-27';
UPDATE reservation SET limit_capacity = 97 WHERE date = '2023-05-29';
UPDATE reservation SET limit_capacity = 95 WHERE date = '2023-06-02';
