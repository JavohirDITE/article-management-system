# 📰 Article Management System / Sistema Maqolalarni Boshqarish

> Современная система управления статьями с поддержкой трёх языков (Узбекский, Русский, English)
> 
> Zamonaviy uch tilda qo'llab-quvvatlanadigan maqolalar boshqaruv tizimi

[![PHP Version](https://img.shields.io/badge/PHP-8.0%2B-blue)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-5.7%2B-orange)](https://mysql.com)
[![License](https://img.shields.io/badge/License-MIT-green)](LICENSE)

## 🌟 Основные возможности / Asosiy imkoniyatlar / Key Features

### 🔐 Безопасность / Xavfsizlik / Security
- ✅ **SQL Injection Protection** - Prepared Statements для всех запросов
- ✅ **XSS Protection** - Экранирование всех выводимых данных
- ✅ **CSRF Protection** - Токены для защиты форм
- ✅ **Input Sanitization** - Очистка и валидация всех входящих данных

### 🌍 Мультиязычность / Ko'p tillilik / Multi-language
- 🇺🇿 O'zbekcha (Узбекский)
- 🇷🇺 Русский (Russian)
- 🇬🇧 English

### ⚡ Функциональность / Funksiyalar / Features
- ➕ Добавление статей с названием и автором
- 📋 Отображение списка статей в виде таблицы
- 🔍 Поиск статей по названию
- 🗑️ Удаление статей
- 📱 Адаптивный дизайн (работает на всех устройствах)
- 🎨 Современный интерфейс с анимациями
- ⌨️ Горячие клавиши (Ctrl+K для поиска, Ctrl+N для новой статьи)

## 📋 Требования / Talablar / Requirements

- **PHP**: 8.0 или выше
- **MySQL**: 5.7 или выше
- **Web Server**: Apache/Nginx
- **Extensions**: PDO, PDO_MySQL

## 🚀 Установка / O'rnatish / Installation

### Шаг 1: Клонирование / Step 1: Clone

```bash
# Если репозиторий уже скачан, перейдите в папку
cd article-manager
```

### Шаг 2: Настройка базы данных / Step 2: Database Setup

#### Вариант A: Импорт через phpMyAdmin
1. Откройте phpMyAdmin (обычно `http://localhost/phpmyadmin`)
2. Создайте новую базу данных: `articles_db`
3. Импортируйте файл `database/schema.sql`

#### Вариант B: Импорт через командную строку
```bash
mysql -u root -p < database/schema.sql
```

### Шаг 3: Конфигурация / Step 3: Configuration

Откройте файл `config/database.php` и настройте параметры подключения:

```php
return [
    'host' => 'localhost',      // Адрес MySQL сервера
    'dbname' => 'articles_db',  // Имя базы данных
    'username' => 'root',       // Пользователь MySQL
    'password' => '',           // Пароль MySQL (по умолчанию пусто для XAMPP)
    'charset' => 'utf8mb4'
];
```

### Шаг 4: Запуск / Step 4: Launch

#### Для XAMPP:
1. Поместите папку `article-manager` в `C:\xampp\htdocs\`
2. Запустите Apache и MySQL в XAMPP Control Panel
3. Откройте: `http://localhost/article-manager/public/`

#### Для встроенного PHP сервера:
```bash
cd public
php -S localhost:8000
```
Затем откройте: `http://localhost:8000`

## 📁 Структура проекта / Loyiha tuzilmasi / Project Structure

```
article-manager/
├── classes/              # Классы приложения
│   ├── Database.php     # Подключение к БД (Singleton)
│   ├── Article.php      # Модель статей
│   └── Language.php     # Управление языками
├── config/              # Конфигурация
│   ├── database.php     # Настройки БД
│   └── languages.php    # Переводы
├── database/            # SQL файлы
│   └── schema.sql       # Схема БД
├── public/              # Публичная директория
│   ├── index.php        # Главный файл
│   └── assets/          # Статические файлы
│       ├── style.css    # Стили
│       └── script.js    # JavaScript
├── views/               # Шаблоны
│   └── main.php         # Главный шаблон
└── README.md            # Документация
```

## 🎯 Использование / Foydalanish / Usage

### Смена языка / Tilni o'zgartirish / Change Language
Нажмите на флаг в верхнем правом углу или используйте параметр URL:
```
?lang=uz    # Узбекский
?lang=ru    # Русский
?lang=en    # Английский
```

### Горячие клавиши / Tezkor tugmalar / Keyboard Shortcuts
- `Ctrl + K` - Фокус на поиске
- `Ctrl + N` - Фокус на форме добавления
- Click на ID - Копировать ID в буфер обмена

## 🔒 Безопасность / Xavfsizlik / Security

### SQL Injection Protection
Все запросы используют подготовленные выражения (Prepared Statements):
```php
$stmt = $db->prepare("SELECT * FROM articles WHERE title LIKE :search");
$stmt->execute([':search' => $search]);
```

### XSS Protection
Все выводимые данные экранируются:
```php
echo Article::escapeOutput($article['title']);
// или
echo htmlspecialchars($data, ENT_QUOTES | ENT_HTML5, 'UTF-8');
```

### CSRF Protection
Все формы содержат уникальный токен:
```php
<input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
```

## 🎨 Технологии / Texnologiyalar / Technologies

### Backend
- **PHP 8+** - Основной язык программирования
- **PDO** - Безопасная работа с базой данных
- **MySQL** - Система управления базами данных

### Frontend
- **HTML5** - Семантическая разметка
- **CSS3** - Современные стили и анимации
- **JavaScript ES6+** - Интерактивность
- **Font Awesome** - Иконки

### Архитектура
- **MVC Pattern** - Разделение логики
- **Singleton Pattern** - Для подключения к БД
- **Responsive Design** - Адаптивность
- **Progressive Enhancement** - Постепенное улучшение

## 📊 Особенности реализации / Xususiyatlar / Implementation Details

### Класс Database (Singleton)
```php
// Один экземпляр для всего приложения
$db = Database::getConnection();
```

### Класс Article (CRUD операции)
```php
$article = new Article();
$article->create($title, $author);      // Create
$articles = $article->getAll($search);  // Read
$article->delete($id);                  // Delete
```

### Класс Language (Мультиязычность)
```php
Language::init();
echo Language::get('title');  // Вывод перевода
Language::setLanguage('ru');  // Смена языка
```

## 🐛 Отладка / Muammolarni hal qilish / Troubleshooting

### Ошибка подключения к БД
```
Database connection failed
```
**Решение**: Проверьте настройки в `config/database.php`

### Страница не загружается
**Решение**: 
1. Убедитесь, что Apache запущен
2. Проверьте путь к файлу
3. Проверьте права доступа к папке

### Не сохраняются данные
**Решение**:
1. Проверьте, что MySQL запущен
2. Убедитесь, что база данных создана
3. Проверьте права пользователя БД

## 📈 Дальнейшее развитие / Kelajakda rivojlantirish / Future Enhancements

- [ ] Авторизация пользователей
- [ ] Редактирование статей
- [ ] Категории статей
- [ ] Пагинация
- [ ] Экспорт в PDF/Excel
- [ ] API для внешнего доступа
- [ ] Загрузка изображений
- [ ] Полнотекстовый поиск

## 👨‍💻 Автор / Muallif / Author

**Javohir Zokirjonov**
- GitHub: [@JavohirDITE](https://github.com/JavohirDITE)
- Email: javohir@example.com

## 📄 Лицензия / Litsenziya / License

MIT License - свободно используйте для своих проектов!

## 🙏 Благодарности / Minnatdorchilik / Acknowledgments

Спасибо за доверие и возможность продемонстрировать свои навыки!

---

**Создано с ❤️ для демонстрации навыков PHP разработки**

*Made with ❤️ to demonstrate PHP development skills*

*PHP dasturlash ko'nikmalarini namoyish qilish uchun ❤️ bilan yaratilgan*
