# 📬 Информация для отправки / Yuborish uchun ma'lumot / Submission Information

## 👋 Ассалому алайкум / Здравствуйте!

Я выполнил тестовое задание для позиции **PHP Developer** и с удовольствием представляю свою работу.

---

## 🎯 Что было сделано / Nima qilindi / What was done

✅ **Полная функциональность согласно ТЗ:**
- ➕ Форма добавления статей (название, автор)
- 📋 Список статей в виде таблицы с ID, названием, автором и датой
- 🔍 Поиск по названию статей
- 🗑️ Удаление статей с подтверждением
- 🔐 Защита от SQL Injection (Prepared Statements)
- 🛡️ Защита от XSS атак (htmlspecialchars, strip_tags)
- 🔒 CSRF защита для всех форм
- 📱 Адаптивный дизайн для всех устройств

✅ **Дополнительные возможности (бонус):**
- 🌍 **Три языка интерфейса**: Узбекский, Русский, English
- 🎨 Современный красивый дизайн с анимациями
- ⌨️ Горячие клавиши (Ctrl+K - поиск, Ctrl+N - новая статья)
- 🏗️ Архитектура на основе MVC паттерна
- 🔄 Singleton паттерн для Database
- 📦 Чистый, документированный код
- ✨ Валидация на клиенте и сервере
- 💾 Автоматические уведомления о действиях
- 📊 Индексы в БД для оптимизации

---

## 🔗 Ссылки / Havolalar / Links

### GitHub Repository:
**https://github.com/JavohirDITE/article-management-system**

### Архив проекта:
📦 **article-management-system.zip** (прилагается к письму / вложено)

---

## 📂 Структура проекта / Loyiha tuzilmasi / Project Structure

```
article-management-system/
├── classes/              # PHP классы (MVC архитектура)
│   ├── Database.php     # Подключение к БД (Singleton)
│   ├── Article.php      # Модель статей (CRUD + защита)
│   └── Language.php     # Мультиязычность
├── config/              # Конфигурационные файлы
│   ├── database.php     # Настройки БД
│   └── languages.php    # Переводы на 3 языка
├── database/            
│   └── schema.sql       # SQL схема с примерами
├── public/              # Публичная директория
│   ├── index.php        # Главный контроллер
│   ├── .htaccess        # Apache конфигурация + безопасность
│   └── assets/          
│       ├── style.css    # Адаптивные стили
│       └── script.js    # JavaScript с валидацией
├── views/               
│   └── main.php         # HTML шаблон
├── README.md            # Подробная документация
├── INSTALL.md           # Инструкция по установке
└── LICENSE              # MIT License
```

---

## 🚀 Как запустить / Qanday ishga tushirish / How to run

### Быстрый старт:

1️⃣ **Импортируйте БД:**
```sql
Откройте phpMyAdmin → Импорт → database/schema.sql
```

2️⃣ **Настройте подключение:**
```php
// config/database.php
'username' => 'root',
'password' => '',  // ваш пароль
```

3️⃣ **Откройте в браузере:**
```
http://localhost/article-manager/public/
```

📖 **Полная инструкция:** см. файл `INSTALL.md`

---

## 🔒 Безопасность / Xavfsizlik / Security

### SQL Injection Protection ✅
```php
// Prepared Statements для всех запросов
$stmt = $db->prepare("SELECT * FROM articles WHERE title LIKE :search");
$stmt->execute([':search' => $search]);
```

### XSS Protection ✅
```php
// Двойная защита: при вводе и выводе
$input = htmlspecialchars(strip_tags($input), ENT_QUOTES | ENT_HTML5, 'UTF-8');
```

### CSRF Protection ✅
```php
// Уникальный токен для каждой сессии
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
```

---

## 💡 Технологии и подходы / Texnologiyalar / Technologies

### Backend:
- ✅ PHP 8+ (использованы современные возможности)
- ✅ PDO с Prepared Statements
- ✅ MySQL с индексами для производительности
- ✅ MVC архитектура
- ✅ Singleton паттерн

### Frontend:
- ✅ Чистый JavaScript (ES6+)
- ✅ CSS3 с Flexbox/Grid
- ✅ Адаптивный дизайн (Mobile First)
- ✅ Font Awesome иконки

### Безопасность:
- ✅ Input sanitization
- ✅ Output escaping
- ✅ CSRF tokens
- ✅ Security headers (.htaccess)

---

## 📊 Особенности реализации / Xususiyatlar / Features

### 🌍 Мультиязычность
- Переключение языков без перезагрузки данных
- Сохранение выбранного языка в сессии
- Легко добавить новые языки

### 🎨 UX/UI
- Автоскрытие уведомлений через 5 секунд
- Подтверждение перед удалением
- Анимации при наведении
- Копирование ID по клику
- Валидация в реальном времени

### 🏗️ Архитектура
- Разделение логики и представления
- Повторное использование кода
- Легкая поддержка и расширение
- Автозагрузка классов

---

## 📝 Комментарии к коду / Kod haqida / Code Notes

Весь код:
- ✅ Хорошо документирован (PHPDoc комментарии)
- ✅ Следует PSR стандартам
- ✅ Использует type hints
- ✅ Обрабатывает ошибки
- ✅ Легко читается и понимается

---

## 🎓 О себе / Men haqimda / About Me

**Javohir Zokirjonov**
- 💻 PHP Developer
- 📧 GitHub: [@JavohirDITE](https://github.com/JavohirDITE)
- 🎯 Опыт работы с: PHP, MySQL, JavaScript, HTML/CSS
- 🌟 Знание паттернов проектирования и best practices
- 🚀 Стремление к качественному, безопасному коду

---

## 📩 Контакты / Bog'lanish / Contact

Буду рад обсудить решение и ответить на любые вопросы!

**Telegram:** @JavohirDITE (или как указано в переписке)
**GitHub:** https://github.com/JavohirDITE
**Email:** javohir@example.com

---

## 🙏 Заключение / Xulosa / Conclusion

Я постарался сделать не просто "работающий код", а профессиональное решение, которое:
- ✅ Безопасно и защищено
- ✅ Удобно для пользователей (UX/UI)
- ✅ Легко поддерживается (Clean Code)
- ✅ Готово к расширению
- ✅ Соответствует современным стандартам

Надеюсь, моя работа вам понравится! 

С уважением,  
**Javohir Zokirjonov**

---

**P.S.** Если возникнут какие-либо вопросы по установке или работе приложения - пожалуйста, напишите мне. Я оперативно отвечу и помогу! 🚀

---

<div align="center">

**Создано с ❤️ для демонстрации профессиональных навыков PHP разработки**

*Made with ❤️ to demonstrate professional PHP development skills*

*PHP dasturlash ko'nikmalarini namoyish qilish uchun ❤️ bilan yaratilgan*

</div>
