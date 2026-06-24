-- ============================================
-- Article Management System - Database Schema
-- For InfinityFree hosting
-- ============================================

-- Drop table if exists
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
  COMMENT='Table for storing articles';

-- Insert sample data
INSERT INTO articles (title, author) VALUES
    ('PHP 8.5 - Yangi imkoniyatlar', 'Javohir Zokirjonov'),
    ('MySQL Query Optimization Tips', 'John Smith'),
    ('Веб-разработка для начинающих', 'Иван Петров'),
    ('Modern Web Development with MVC', 'Sarah Johnson'),
    ('Ma\'lumotlar bazasi bilan ishlash', 'Aziz Karimov');

-- ============================================
-- End of Schema
-- ============================================
