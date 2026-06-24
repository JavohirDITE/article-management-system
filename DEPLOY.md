# 🚀 Деплой на InfinityFree

## 📦 Что загружать на сервер

### Структура на сервере (в папке htdocs):
```
htdocs/
├── index.php              ← из public/
├── .htaccess              ← из public/
├── assets/                ← из public/assets/
│   ├── style.css
│   └── script.js
├── classes/               ← вся папка
│   ├── Database.php
│   ├── Article.php
│   └── Language.php
├── config/                ← вся папка
│   ├── database.php
│   └── languages.php
├── views/                 ← вся папка
│   └── main.php
└── database/              ← только schema.sql
    └── schema.sql
```

## ⚙️ Настройка database.php

После создания базы данных в phpMyAdmin, отредактируй `config/database.php`:

```php
<?php
return [
    'host' => 'sql123.infinityfree.net',      // ⬅️ Hostname из InfinityFree
    'dbname' => 'epiz_12345678_articles',     // ⬅️ Твоя база данных
    'username' => 'epiz_12345678',            // ⬅️ Твой username
    'password' => 'твой_пароль',              // ⬅️ Твой пароль
    'charset' => 'utf8mb4',
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]
];
```

## ✅ Чек-лист перед деплоем

- [ ] Зарегистрирован на InfinityFree
- [ ] Создан хостинг аккаунт
- [ ] Все файлы загружены
- [ ] База данных создана
- [ ] schema.sql импортирован
- [ ] config/database.php настроен
- [ ] Сайт открывается
- [ ] Все функции работают

## 🌐 Твоя ссылка

После деплоя твой сайт будет доступен по адресу типа:
```
http://your-subdomain.rf.gd
```

## 💡 Полная инструкция

См. файл: `DEPLOYMENT_OPTIONS.md` в корне проекта
