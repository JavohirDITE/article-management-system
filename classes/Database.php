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
                throw new Exception("Database connection failed");
            }
        }

        return self::$connection;
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
