<?php
/**
 * Main Application File - Article Management System
 * Главный файл приложения - Система управления статьями
 * Asosiy fayl - Maqolalar boshqaruv tizimi
 * 
 * @author Javohir
 * @version 1.0.0
 */

// Start session
session_start();

// Set error reporting for development
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Autoload classes
spl_autoload_register(function ($class) {
    $file = __DIR__ . '/../classes/' . $class . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

// Initialize language system
Language::init();

// Handle language change
if (isset($_GET['lang'])) {
    Language::setLanguage($_GET['lang']);
    header('Location: index.php');
    exit;
}

// Initialize database connection
try {
    $articleModel = new Article();
} catch (Exception $e) {
    die("Database error. Please check your configuration.");
}

// Handle form submissions
$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // CSRF Protection (basic implementation)
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $message = Language::get('error');
        $messageType = 'error';
    } else {
        // Add new article
        if (isset($_POST['action']) && $_POST['action'] === 'add') {
            $title = $_POST['title'] ?? '';
            $author = $_POST['author'] ?? '';

            if (!empty($title) && !empty($author)) {
                try {
                    if ($articleModel->create($title, $author)) {
                        $message = Language::get('success_added');
                        $messageType = 'success';
                    } else {
                        $message = Language::get('error');
                        $messageType = 'error';
                    }
                } catch (Exception $e) {
                    $message = Language::get('error');
                    $messageType = 'error';
                }
            } else {
                $message = Language::get('required_fields');
                $messageType = 'error';
            }
        }

        // Delete article
        if (isset($_POST['action']) && $_POST['action'] === 'delete') {
            $id = (int)($_POST['id'] ?? 0);
            
            if ($id > 0) {
                try {
                    if ($articleModel->delete($id)) {
                        $message = Language::get('success_deleted');
                        $messageType = 'success';
                    } else {
                        $message = Language::get('error');
                        $messageType = 'error';
                    }
                } catch (Exception $e) {
                    $message = Language::get('error');
                    $messageType = 'error';
                }
            }
        }
    }
}

// Generate CSRF token
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Get search query
$search = $_GET['search'] ?? null;

// Get all articles
try {
    $articles = $articleModel->getAll($search);
} catch (Exception $e) {
    $articles = [];
    $message = Language::get('error');
    $messageType = 'error';
}

// Include view
include __DIR__ . '/../views/main.php';
