# Maqolalar ro'yxati

PHP da yozilgan oddiy maqolalar boshqaruv tizimi.

## Imkoniyatlari

- Maqola qo'shish (nom va muallif)
- Maqolalar ro'yxatini ko'rish (jadval shaklida)
- Maqola nomi bo'yicha qidirish
- Maqolani o'chirish

## Xavfsizlik

- SQL Injection himoyasi — PDO prepared statements
- XSS himoyasi — htmlspecialchars() orqali
- CSRF himoyasi — token orqali

## O'rnatish

### 1. Ma'lumotlar bazasini yaratish

phpMyAdmin orqali yoki terminal orqali `database/schema.sql` faylini import qiling:

```
mysql -u root -p < database/schema.sql
```

### 2. Sozlamalarni o'zgartirish

`config/database.php` faylida o'z ma'lumotlaringizni kiriting:

```php
'host'     => 'localhost',
'dbname'   => 'articles_db',
'username' => 'root',
'password' => '',
```

### 3. Ishga tushirish

XAMPP orqali:
- Papkani `htdocs` ga ko'chiring
- Apache va MySQL ni ishga tushiring
- Brauzerda `http://localhost/article-manager/public/` oching

Yoki PHP built-in server orqali:
```
cd public
php -S localhost:8000
```

## Fayl tuzilishi

```
article-manager/
├── classes/
│   ├── Database.php    — Bazaga ulanish
│   └── Article.php     — Maqola modeli
├── config/
│   └── database.php    — Baza sozlamalari
├── database/
│   └── schema.sql      — SQL fayl
├── public/
│   ├── index.php       — Asosiy fayl
│   └── assets/
│       └── style.css   — CSS stillar
└── views/
    └── main.php        — HTML shablon
```

## Texnologiyalar

- PHP 8+
- MySQL
- PDO
- HTML/CSS
