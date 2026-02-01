CREATE TABLE staff (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    position VARCHAR(100) NOT NULL,
    shift ENUM('Paradite','Mesndrrim','Pasdite') NOT NULL,
    photo VARCHAR(255)
);

INSERT INTO staff (name, position, shift) VALUES
('Auron Blakaj', 'Menaxher', 'Paradite'),
('Drion Gegollaj', 'Menaxher', 'Pasdite'),
('Dardan Bujupaj', 'Kamarier', 'Paradite'),
('Smajl Mehmetukaj', 'Kamarier', 'Pasdite'),
('Yll Nuradini', 'Ndihmes-Kamarier', 'Mesndrrim');
