CREATE DATABASE IF NOT EXISTS daftpunk_db;
USE daftpunk_db;

CREATE TABLE IF NOT EXISTS usuarios (
    usuario_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_usuario VARCHAR(50) NOT NULL UNIQUE,
    contrasena VARCHAR(255) NOT NULL,
    correo VARCHAR(100) NOT NULL,
    creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS canciones (
    cancion_id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    album VARCHAR(100) NOT NULL,
    duracion VARCHAR(10) NOT NULL,
    anio INT NOT NULL,
    soundcloud_url VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS playlists (
    playlist_id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(usuario_id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS playlist_canciones (
    playlist_id INT NOT NULL,
    cancion_id INT NOT NULL,
    PRIMARY KEY (playlist_id, cancion_id),
    FOREIGN KEY (playlist_id) REFERENCES playlists(playlist_id) ON DELETE CASCADE,
    FOREIGN KEY (cancion_id) REFERENCES canciones(cancion_id) ON DELETE CASCADE
);

INSERT INTO canciones (titulo, album, duracion, anio, soundcloud_url) VALUES
('One More Time', 'Discovery', '5:20', 2000, 'https://soundcloud.com/daftpunkofficialmusic/one-more-time?utm_source=clipboard&utm_medium=text&utm_campaign=social_sharing'),
('Aerodynamic', 'Discovery', '3:27', 2001, 'https://soundcloud.com/daftpunkofficialmusic/aerodynamic?utm_source=clipboard&utm_medium=text&utm_campaign=social_sharing'),
('Digital Love', 'Discovery', '4:58', 2001, 'https://soundcloud.com/daftpunkofficialmusic/digital-love?utm_source=clipboard&utm_medium=text&utm_campaign=social_sharing'),
('Harder, Better, Faster, Stronger', 'Discovery', '3:44', 2001, 'https://soundcloud.com/daftpunkofficialmusic/harder-better-faster?utm_source=clipboard&utm_medium=text&utm_campaign=social_sharing'),
('Get Lucky', 'Random Access Memories', '6:09', 2013, 'https://soundcloud.com/eldjkb/get-lucky-original-version?utm_source=clipboard&utm_medium=text&utm_campaign=social_sharing'),
('Instant Crush', 'Random Access Memories', '5:37', 2013, 'https://soundcloud.com/aaron-gardea/daft-punk-instant-crush?utm_source=clipboard&utm_medium=text&utm_campaign=social_sharing'),
('Lose Yourself to Dance', 'Random Access Memories', '5:53', 2013, 'https://soundcloud.com/kofiers/daft-punk-lose-yourself-dance?utm_source=clipboard&utm_medium=text&utm_campaign=social_sharing'),
('Around the World', 'Homework', '7:09', 1997, 'https://soundcloud.com/daftpunkofficialmusic/around-the-world?utm_source=clipboard&utm_medium=text&utm_campaign=social_sharing'),
('Da Funk', 'Homework', '5:28', 1995, 'https://soundcloud.com/daftpunkofficialmusic/da-funk?utm_source=clipboard&utm_medium=text&utm_campaign=social_sharing'),
('Technologic', 'Human After All', '4:44', 2005, 'https://soundcloud.com/daftpunkofficialmusic/technologic?utm_source=clipboard&utm_medium=text&utm_campaign=social_sharing'),
('Robot Rock', 'Human After All', '4:47', 2005, 'https://soundcloud.com/daftpunkofficialmusic/robot-rock?utm_source=clipboard&utm_medium=text&utm_campaign=social_sharing'),
('Something About Us', 'Discovery', '3:51', 2001, 'https://soundcloud.com/daftpunkofficialmusic/something-about-us?utm_source=clipboard&utm_medium=text&utm_campaign=social_sharing'),
('Veridis Quo', 'Discovery', '5:44', 2001, 'https://soundcloud.com/daftpunkofficialmusic/veridis-quo?in=joefreed/sets/songs-like-verdis-quo-1&utm_source=clipboard&utm_medium=text&utm_campaign=social_sharing'),
('Doin it Right', 'Random Access Memories', '4:11', 2013, 'https://soundcloud.com/daftpunkofficialmusic/doin-it-right?in=daftpunkofficialmusic/sets/random-access-memories-4&utm_source=clipboard&utm_medium=text&utm_campaign=social_sharing'),
('Giorgio by Moroder', 'Random Access Memories', '9:04', 2013, 'https://soundcloud.com/daftpunkofficialmusic/giorgio-by-moroder?in=daftpunkofficialmusic/sets/random-access-memories-4&utm_source=clipboard&utm_medium=text&utm_campaign=social_sharing');

INSERT INTO usuarios (nombre_usuario, contrasena, correo) VALUES 
('usuarioErEn', 'ErickEncarnacion@2006', 'eencarnacionc02@educantabria.es');