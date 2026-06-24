<?php
/**
 * Database Connection Class
 * Класс подключения к базе данных
 * Ma'lumotlar bazasiga ulanish klassi
 */

class Database
{
    private static ?PDO $connection = null;

    /**
     * Get database connection using Singleton pattern
     */
    public static function getConnection(): PDO
    {
        if (self::$connection === null) {
            // Try SQLite first for demo (no server needed)
            if (file_exists(__DIR__ . '/../config/database_sqlite.php')) {
                $config = require __DIR__ . '/../config/database_sqlite.php';
                
                try {
                    $dbFile = $config['database'];
                    $dbDir = dirname($dbFile);
                    
                    // Create directory if not exists
                    if (!is_dir($dbDir)) {
                        mkdir($dbDir, 0777, true);
                    }
                    
                    $needsSetup = !file_exists($dbFile);
                    
                    self::$connection = new PDO(
                        'sqlite:' . $dbFile,
                        null,
                        null,
                        $config['options']
                    );
                    
                    // Create tables if new database
                    if ($needsSetup) {
                        self::setupSQLiteDatabase();
                    }
                    
                    return self::$connection;
                } catch (PDOException $e) {
                    // Fall through to MySQL
                }
            }
            
            // Try MySQL
            $config = require __DIR__ . '/../config/database.php';
            
            $dsn = sprintf(
                "mysql:host=%s;dbname=%s;charset=%s",
                $config['host'],
                $config['dbname'],
                $config['charset']
            );

            try {
                self::$connection = new PDO(
                    $dsn,
                    $config['username'],
                    $config['password'],
                    $config['options']
                );
            } catch (PDOException $e) {
                error_log("Database connection error: " . $e->getMessage());
                throw new Exception("Database connection failed. Please check configuration.");
            }
        }

        return self::$connection;
    }
    
    /**
     * Setup SQLite database schema
     */
    private static function setupSQLiteDatabase(): void
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS articles (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                title TEXT NOT NULL,
                author TEXT NOT NULL,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
            );
            
            CREATE INDEX IF NOT EXISTS idx_title ON articles(title);
            CREATE INDEX IF NOT EXISTS idx_author ON articles(author);
            CREATE INDEX IF NOT EXISTS idx_created_at ON articles(created_at);
            
            INSERT INTO articles (title, author) VALUES
                ('PHP 8.5 - Yangi imkoniyatlar', 'Javohir Dilmurodov'),
                ('MySQL Query Optimization Tips', 'John Smith'),
                ('Веб-разработка для начинающих', 'Иван Петров'),
                ('Modern Web Development with MVC', 'Sarah Johnson'),
                ('Ma''lumotlar bazasi bilan ishlash', 'Aziz Karimov');
        ";
        
        self::$connection->exec($sql);
    }

    /**
     * Prevent cloning of the instance
     */
    private function __clone() {}

    /**
     * Prevent unserializing of the instance
     */
    public function __wakeup()
    {
        throw new Exception("Cannot unserialize singleton");
    }
}
