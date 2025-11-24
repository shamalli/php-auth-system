CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    phone VARCHAR(20) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Пример тестового пользователя (пароль: password123)
INSERT INTO users (name, email, phone, password) VALUES 
('Тестовый Пользователь', 'test@example.com', '+79991234567', '$2y$12$5KWlI9xj7DGWjikvJ0nhu.kIvqEdB3As5M/lpOjmAxlupDCthSRmS');