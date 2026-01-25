DROP DATABASE IF EXISTS proyecto_eventos;
CREATE DATABASE proyecto_eventos CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE proyecto_eventos;

-- Taula de rols
CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
);

-- Taula d'usuaris
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role_id INT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (role_id) REFERENCES roles(id)
);

-- Taula d'events
CREATE TABLE events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    description TEXT,
    location VARCHAR(150),
    event_date DATE NOT NULL,
    price DECIMAL(10,2) DEFAULT 0.00,
    created_by INT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(id)
);

-- Taula d'inscripcions
CREATE TABLE registrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    event_id INT NOT NULL,
    status ENUM('pendent','confirmada','cancel·lada') DEFAULT 'pendent',
    registered_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (event_id) REFERENCES events(id)
);

-- Dades inicials
INSERT INTO roles (name) VALUES
('organitzador'),
('assistent');

INSERT INTO users (name, email, password, role_id) VALUES
('Admin Organitzador', 'organitzador@example.com', 'TEMP', 1),
('Usuari Assistent', 'assistent@example.com', 'TEMP', 2);

INSERT INTO events (title, description, location, event_date, price, created_by) VALUES
('Concert Rock', 'Concert de rock al centre', 'Barcelona', '2025-06-10', 25.00, 1),
('Taller de Cuina', 'Aprèn cuina italiana', 'Girona', '2025-07-01', 40.00, 1),
('Conferència Tech', 'Novetats en tecnologia web', 'Barcelona', '2025-05-20', 0.00, 1),
('Fira d''Art', 'Exposició d''art local', 'Tarragona', '2025-08-15', 10.00, 1);

INSERT INTO registrations (user_id, event_id, status) VALUES
(2, 1, 'confirmada'),
(2, 2, 'pendent'),
(2, 3, 'cancel·lada'),
(2, 4, 'confirmada');