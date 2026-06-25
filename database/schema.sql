-- Ma'lumotlar bazasi va jadval yaratish

CREATE DATABASE IF NOT EXISTS articles_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE articles_db;

CREATE TABLE articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(100) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Namuna ma'lumotlar
INSERT INTO articles (title, author) VALUES
    ('PHP 8 yangi imkoniyatlari', 'Javohir'),
    ('MySQL bilan ishlash asoslari', 'Aziz Karimov'),
    ('Web dasturlash haqida', 'Sardor Toshmatov');
