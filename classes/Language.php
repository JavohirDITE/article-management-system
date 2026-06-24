<?php
/**
 * Language Manager Class
 * Класс управления языками
 * Til boshqaruv klassi
 */

class Language
{
    private static string $currentLang = 'uz';
    private static array $translations = [];

    /**
     * Initialize language system
     */
    public static function init(): void
    {
        self::$translations = require __DIR__ . '/../config/languages.php';
        
        // Get language from session or default
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (isset($_SESSION['lang']) && array_key_exists($_SESSION['lang'], self::$translations)) {
            self::$currentLang = $_SESSION['lang'];
        }
    }

    /**
     * Set current language
     */
    public static function setLanguage(string $lang): void
    {
        if (array_key_exists($lang, self::$translations)) {
            self::$currentLang = $lang;
            $_SESSION['lang'] = $lang;
        }
    }

    /**
     * Get current language
     */
    public static function getCurrentLanguage(): string
    {
        return self::$currentLang;
    }

    /**
     * Get translation for a key
     */
    public static function get(string $key): string
    {
        return self::$translations[self::$currentLang][$key] ?? $key;
    }

    /**
     * Get all available languages
     */
    public static function getAvailableLanguages(): array
    {
        return [
            'uz' => 'O\'zbekcha',
            'ru' => 'Русский',
            'en' => 'English'
        ];
    }
}
