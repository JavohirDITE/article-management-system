<?php
session_start();

// Klasslarni yuklash
require_once __DIR__ . '/../classes/Database.php';
require_once __DIR__ . '/../classes/Article.php';

// Bazaga ulanish
try {
    $articleModel = new Article();
} catch (Exception $e) {
    die("Ma'lumotlar bazasiga ulanib bo'lmadi. Iltimos, sozlamalarni tekshiring.");
}

$message = '';
$messageType = '';

// POST so'rovlarni qayta ishlash
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // CSRF tekshiruvi
    if (!isset($_POST['token']) || $_POST['token'] !== ($_SESSION['token'] ?? '')) {
        $message = 'Xatolik yuz berdi!';
        $messageType = 'error';
    } else {

        // Maqola qo'shish
        if (isset($_POST['action']) && $_POST['action'] === 'add') {
            $title  = $_POST['title'] ?? '';
            $author = $_POST['author'] ?? '';

            if ($title !== '' && $author !== '') {
                if ($articleModel->create($title, $author)) {
                    $message = "Maqola muvaffaqiyatli qo'shildi!";
                    $messageType = 'success';
                } else {
                    $message = 'Xatolik yuz berdi!';
                    $messageType = 'error';
                }
            } else {
                $message = "Barcha maydonlarni to'ldiring!";
                $messageType = 'error';
            }
        }

        // Maqolani o'chirish
        if (isset($_POST['action']) && $_POST['action'] === 'delete') {
            $id = (int)($_POST['id'] ?? 0);
            if ($id > 0) {
                if ($articleModel->delete($id)) {
                    $message = "Maqola o'chirildi!";
                    $messageType = 'success';
                } else {
                    $message = 'Xatolik yuz berdi!';
                    $messageType = 'error';
                }
            }
        }
    }
}

// CSRF token yaratish
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}

// Qidiruv
$search = $_GET['search'] ?? '';

// Maqolalar ro'yxatini olish
$articles = $articleModel->getAll($search ?: null);

// Sahifani ko'rsatish
require __DIR__ . '/../views/main.php';
