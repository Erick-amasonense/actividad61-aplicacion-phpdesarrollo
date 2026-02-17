CREATE DATABASE IF NOT EXISTS daftpunk_db;
USE daftpunk_db;

-- 1. Tabla de Usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    usuario_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_usuario VARCHAR(50) NOT NULL UNIQUE,
    contrasena VARCHAR(255) NOT NULL,
    correo VARCHAR(100) NOT NULL,
    creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 2. Tabla de Canciones (CATÁLOGO FIJO)
CREATE TABLE IF NOT EXISTS canciones (
    cancion_id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    album VARCHAR(100) NOT NULL,
    duracion VARCHAR(10) NOT NULL,
    anio INT NOT NULL
);

-- 3. Tabla de Playlists (Cabecera de la lista)
CREATE TABLE IF NOT EXISTS playlists (
    playlist_id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(usuario_id) ON DELETE CASCADE
);

-- 4. Tabla Detalle (Relación Muchos a Muchos: Qué canciones hay en qué lista)
CREATE TABLE IF NOT EXISTS playlist_canciones (
    playlist_id INT NOT NULL,
    cancion_id INT NOT NULL,
    PRIMARY KEY (playlist_id, cancion_id),
    FOREIGN KEY (playlist_id) REFERENCES playlists(playlist_id) ON DELETE CASCADE,
    FOREIGN KEY (cancion_id) REFERENCES canciones(cancion_id) ON DELETE CASCADE
);

-- INSERTAR DATOS: Canciones de Daft Punk precargadas
INSERT INTO canciones (titulo, album, duracion, anio) VALUES
('One More Time', 'Discovery', '5:20', 2000),
('Aerodynamic', 'Discovery', '3:27', 2001),
('Digital Love', 'Discovery', '4:58', 2001),
('Harder, Better, Faster, Stronger', 'Discovery', '3:44', 2001),
('Get Lucky', 'Random Access Memories', '6:09', 2013),
('Instant Crush', 'Random Access Memories', '5:37', 2013),
('Lose Yourself to Dance', 'Random Access Memories', '5:53', 2013),
('Around the World', 'Homework', '7:09', 1997),
('Da Funk', 'Homework', '5:28', 1995),
('Robot Rock', 'Human After All', '4:47', 2005),
('Technologic', 'Human After All', '4:44', 2005);
