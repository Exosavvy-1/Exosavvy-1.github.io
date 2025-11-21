CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255),
    password VARCHAR(255),
    role ENUM('admin','user') DEFAULT 'user'
);

CREATE TABLE images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    filename VARCHAR(255),
    uploaded_for INT,
    uploaded_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (uploaded_for) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (uploaded_by) REFERENCES users(id) ON DELETE SET NULL
);

INSERT INTO users (username, password, role)
VALUES (
    'admin',
    -- password = TYra@5987 --
    '$2b$10$aFPMlYU959chN.D5Ykbo9Obv8bBKcQdo39NsqsBXVgXgqCAdR6HlG',
    'admin'
);
