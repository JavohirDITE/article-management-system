# 🚀 Установка и настройка / O'rnatish va sozlash / Installation Guide

## Быстрый старт / Tezkor boshlash / Quick Start

### 1️⃣ Загрузка проекта

Если вы скачали ZIP-архив:
```bash
# Распакуйте архив в нужную папку
# Extract the archive to desired folder
# Arxivni kerakli papkaga chiqaring
```

### 2️⃣ Настройка окружения

#### Для Windows (XAMPP):

**Шаг 1:** Установите XAMPP
- Скачайте с: https://www.apachefriends.org/
- Установите в `C:\xampp`

**Шаг 2:** Скопируйте проект
```
C:\xampp\htdocs\article-manager\
```

**Шаг 3:** Запустите сервисы
1. Откройте XAMPP Control Panel
2. Нажмите "Start" для Apache
3. Нажмите "Start" для MySQL

#### Для встроенного PHP сервера:

```bash
cd article-manager/public
php -S localhost:8000
```

### 3️⃣ Создание базы данных

#### Способ 1: phpMyAdmin (Рекомендуется для начинающих)

1. Откройте браузер: `http://localhost/phpmyadmin`
2. Войдите (обычно без пароля для XAMPP)
3. Нажмите "Новая" слева для создания БД
4. Имя: `articles_db`
5. Кодировка: `utf8mb4_unicode_ci`
6. Нажмите "Создать"
7. Выберите БД `articles_db`
8. Перейдите на вкладку "Импорт"
9. Выберите файл `database/schema.sql`
10. Нажмите "Вперёд"

#### Способ 2: Командная строка

```bash
# Для Windows
mysql -u root -p < database\schema.sql

# Для Linux/Mac
mysql -u root -p < database/schema.sql
```

### 4️⃣ Конфигурация подключения

Откройте файл: `config/database.php`

**Для XAMPP (по умолчанию):**
```php
return [
    'host' => 'localhost',
    'dbname' => 'articles_db',
    'username' => 'root',
    'password' => '',  // Обычно пусто
    'charset' => 'utf8mb4'
];
```

**Для другого сервера:**
```php
return [
    'host' => 'localhost',        // или IP адрес
    'dbname' => 'articles_db',    
    'username' => 'your_username', // ваш пользователь
    'password' => 'your_password', // ваш пароль
    'charset' => 'utf8mb4'
];
```

### 5️⃣ Проверка установки

Откройте в браузере:
- **XAMPP**: `http://localhost/article-manager/public/`
- **Встроенный сервер**: `http://localhost:8000/`

Вы должны увидеть главную страницу с формой добавления статей!

---

## 🔧 Расширенная настройка / Kengaytirilgan sozlash / Advanced Configuration

### Изменение порта встроенного сервера

```bash
php -S localhost:9000  # Вместо 8000
```

### Настройка виртуального хоста (Apache)

Создайте файл: `C:\xampp\apache\conf\extra\httpd-vhosts.conf`

Добавьте:
```apache
<VirtualHost *:80>
    ServerName articles.local
    DocumentRoot "C:/xampp/htdocs/article-manager/public"
    
    <Directory "C:/xampp/htdocs/article-manager/public">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

Отредактируйте: `C:\Windows\System32\drivers\etc\hosts`
```
127.0.0.1 articles.local
```

Перезапустите Apache, откройте: `http://articles.local`

### Настройка прав доступа (Linux/Mac)

```bash
# Дать права на запись
chmod -R 755 article-manager/
chmod -R 777 article-manager/cache/  # если есть папка cache

# Установить владельца (замените www-data на вашего пользователя)
chown -R www-data:www-data article-manager/
```

---

## 🐛 Решение проблем / Muammolarni hal qilish / Troubleshooting

### ❌ Ошибка: "Database connection failed"

**Причина**: Неверные данные подключения

**Решение**:
1. Проверьте, что MySQL запущен
2. Проверьте `config/database.php`
3. Убедитесь, что БД `articles_db` существует
4. Проверьте имя пользователя и пароль

**Проверка MySQL:**
```bash
mysql -u root -p
# Введите пароль (или Enter, если пусто)

# В консоли MySQL:
SHOW DATABASES;
# Должна быть articles_db
```

### ❌ Ошибка: "Fatal error: Class 'PDO' not found"

**Причина**: Не включено расширение PDO

**Решение для XAMPP**:
1. Откройте `C:\xampp\php\php.ini`
2. Найдите и раскомментируйте (уберите `;`):
   ```ini
   extension=pdo_mysql
   ```
3. Сохраните и перезапустите Apache

### ❌ Ошибка: "Access denied for user"

**Причина**: Неверный пароль MySQL

**Решение**:
```bash
# Сбросить пароль root в MySQL
mysqladmin -u root password "новый_пароль"

# Или оставить пустым (для разработки):
mysqladmin -u root password ""
```

### ❌ Страница не загружается / белый экран

**Решение**:
1. Включите отображение ошибок в `php.ini`:
   ```ini
   display_errors = On
   error_reporting = E_ALL
   ```
2. Проверьте логи Apache: `C:\xampp\apache\logs\error.log`
3. Проверьте права доступа к файлам

### ❌ Не работают стили

**Решение**:
1. Проверьте путь в `views/main.php`:
   ```html
   <link rel="stylesheet" href="assets/style.css">
   ```
2. Убедитесь, что файл существует: `public/assets/style.css`
3. Очистите кэш браузера (Ctrl+Shift+R)

### ❌ Не работает переключение языков

**Решение**:
1. Проверьте, что сессии включены:
   ```ini
   # В php.ini
   session.auto_start = 1
   ```
2. Проверьте права на папку сессий:
   ```bash
   # Linux/Mac
   chmod 777 /tmp
   ```

---

## ✅ Проверка требований / Talablarni tekshirish / Requirements Check

Создайте файл `check_requirements.php` в папке `public/`:

```php
<?php
echo "<h1>System Requirements Check</h1>";

// PHP Version
echo "<h2>PHP Version: " . phpversion() . "</h2>";
if (version_compare(phpversion(), '8.0.0', '>=')) {
    echo "✅ PHP version OK<br>";
} else {
    echo "❌ PHP 8.0+ required<br>";
}

// PDO
if (extension_loaded('pdo')) {
    echo "✅ PDO extension loaded<br>";
} else {
    echo "❌ PDO extension not loaded<br>";
}

// PDO MySQL
if (extension_loaded('pdo_mysql')) {
    echo "✅ PDO_MySQL extension loaded<br>";
} else {
    echo "❌ PDO_MySQL extension not loaded<br>";
}

// Database Connection Test
try {
    $config = require '../config/database.php';
    $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";
    $pdo = new PDO($dsn, $config['username'], $config['password']);
    echo "✅ Database connection successful<br>";
} catch (PDOException $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "<br>";
}

echo "<h2>Server Information</h2>";
phpinfo();
?>
```

Откройте: `http://localhost/article-manager/public/check_requirements.php`

---

## 📦 Создание архива для отправки / Arxiv yaratish / Create Archive

### Windows:
```bash
# Используйте WinRAR или 7-Zip
# Выберите папку article-manager
# Нажмите "Добавить в архив"
# Формат: ZIP
```

### Linux/Mac:
```bash
cd ..
zip -r article-manager.zip article-manager/ -x "*.git*" "*.DS_Store"
```

---

## 🎯 Следующие шаги / Keyingi qadamlar / Next Steps

После успешной установки:

1. ✅ Проверьте все функции (добавление, поиск, удаление)
2. ✅ Проверьте все 3 языка
3. ✅ Проверьте адаптивность (откройте на телефоне)
4. ✅ Почитайте README.md для деталей

---

## 📞 Помощь / Yordam / Support

Если что-то не работает:

1. Проверьте логи ошибок
2. Запустите `check_requirements.php`
3. Убедитесь, что все файлы на месте
4. Проверьте конфигурацию БД

**Контакты:**
- GitHub: @JavohirDITE
- Email: javohir@example.com

---

✨ **Успешной работы! / Muvaffaqiyatli ish! / Good luck!** ✨
