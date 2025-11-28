CREATE DATABASE IF NOT EXISTS red_social_quorum;
USE red_social_quorum;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    foto_perfil VARCHAR(255) DEFAULT 'default_profile.png',
    foto_portada VARCHAR(255) DEFAULT 'default_cover.png',
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
