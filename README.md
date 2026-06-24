# Maqolalar boshqaruvi

Test topshiriq uchun qilingan oddiy PHP dastur.

## O'rnatish

### 1. MySQL bazasini yarating

```sql
mysql -u root -p < database/schema.sql
```

Yoki phpMyAdmin orqali `database/schema.sql` faylini import qiling.

### 2. Database sozlamasini o'zgartiring

`config/database.php` faylida o'zingizning ma'lumotlaringizni kiriting:

```php
return [
    'host' => 'localhost',
    'dbname' => 'articles_db',
    'username' => 'root',
    'password' => '',
    // ...
];
```

### 3. Ishga tushiring

XAMPP uchun:
- Papkani `C:\xampp\htdocs\` ga qo'ying
- Apache va MySQL ni ishga tushiring
- `http://localhost/article-manager/public/` ga o'ting

Yoki oddiy PHP serverni ishga tushiring:
```bash
cd public
php -S localhost:8000
```

## Nima qilindi

- Maqola qo'shish, ko'rish, qidirish, o'chirish
- SQL Injection himoyasi (PDO prepared statements)
- XSS himoyasi (htmlspecialchars, strip_tags)
- CSRF himoyasi (tokenlar)
- 3 tilda: O'zbek, Rus, Ingliz

## Struktura

```
├── classes/        - PHP klasslar
├── config/         - Sozlamalar
├── database/       - SQL fayl
├── public/         - Asosiy fayllar (index.php, css, js)
└── views/          - HTML shablonlar
```

## Muallif

Javohir Zokirjonov
