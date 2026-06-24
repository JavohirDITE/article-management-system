<?php
/**
 * SQLite Database Configuration (для демо без MySQL)
 * For demo purposes without MySQL server
 */

return [
    'driver' => 'sqlite',
    'database' => __DIR__ . '/../database/articles.db',
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]
];
