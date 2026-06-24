-- ============================================
-- Article Management System - Database Schema
-- Sistema de gestión de artículos - Esquema de base de datos
-- Maqolalar boshqaruv tizimi - Ma'lumotlar bazasi sxemasi
-- ============================================

-- Create database if not exists
CREATE DATABASE IF NOT EXISTS articles_db 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

-- Use the database
USE articles_db;

-- Drop table if exists (for clean installation)
DROP TABLE IF EXISTS articles;

-- Create articles table
CREATE TABLE articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(100) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    -- Indexes for better performance
    INDEX idx_title (title),
    INDEX idx_author (author),
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB 
  DEFAULT CHARSET=utf8mb4 
  COLLATE=utf8mb4_unicode_ci
  COMMENT='Table for storing articles with multi-language support';

-- Insert sample data (optional - remove if not needed)
INSERT INTO articles (title, author) VALUES
    ('PHP 8.5 - Yangi imkoniyatlar', 'Javohir Dilmurodov'),
    ('MySQL Query Optimization Tips', 'John Smith'),
    ('Веб-разработка для начинающих', 'Иван Петров'),
    ('Modern Web Development with MVC', 'Sarah Johnson'),
    ('Ma\'lumotlar bazasi bilan ishlash', 'Aziz Karimov');

-- Create user for application (optional - adjust credentials as needed)
-- CREATE USER IF NOT EXISTS 'articles_user'@'localhost' IDENTIFIED BY 'secure_password_here';
-- GRANT SELECT, INSERT, UPDATE, DELETE ON articles_db.* TO 'articles_user'@'localhost';
-- FLUSH PRIVILEGES;

-- Display table structure
DESCRIBE articles;

-- Display sample data
SELECT * FROM articles ORDER BY created_at DESC;

-- ============================================
-- End of Schema
-- ============================================
