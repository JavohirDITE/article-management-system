<?php
/**
 * Database Configuration
 * Конфигурация базы данных
 * Ma'lumotlar bazasi sozlamalari
 */

return [
    'host' => 'localhost',
    'dbname' => 'articles_db',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8mb4',
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]
];
