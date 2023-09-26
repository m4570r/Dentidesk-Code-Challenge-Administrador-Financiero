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
    ('Sueldo', 2500000.00, 'ingreso', '2023-09-01'),
    ('Arriendo', -800000.00, 'egreso', '2023-09-05'),
    ('Compras del Supermercado', -350000.00, 'egreso', '2023-09-10'),
    ('Venta de objetos usados', 300000.00, 'ingreso', '2023-09-15'),
    ('Cuenta de luz', -50000.00, 'egreso', '2023-09-20'),
    ('Pago de Credito', -200000.00, 'egreso', '2023-09-25');
	
	
CREATE TABLE monthly_profit (
    id INT AUTO_INCREMENT PRIMARY KEY,
    month DATE UNIQUE NOT NULL,
    total_profit DECIMAL(10, 2) DEFAULT 0.00,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


