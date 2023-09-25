-- Crear la base de datos CodeChallenge
CREATE DATABASE CodeChallenge;

-- Usar la base de datos recién creada
USE CodeChallenge;

-- Crear la tabla transactions
CREATE TABLE transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    description VARCHAR(255) NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    type ENUM('ingreso', 'egreso') NOT NULL,
    date DATE NOT NULL
);


-- Insertar datos de ejemplo en la tabla transactions
INSERT INTO transactions (description, amount, type, date)
VALUES
    ('Sueldo', 2500.00, 'ingreso', '2023-09-01'),
    ('Arriendo', -800.00, 'egreso', '2023-09-05'),
    ('Compras del Supermercado', -150.00, 'egreso', '2023-09-10'),
    ('Venta de objetos usados', 300.00, 'ingreso', '2023-09-15'),
    ('Cuenta de luz', -50.00, 'egreso', '2023-09-20'),
    ('Pago de Credito', -200.00, 'egreso', '2023-09-25');