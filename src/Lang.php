<?php

declare(strict_types=1);

namespace Serhii\ShortNumber;

class Lang
{
    /**
     * @var string
     */
    public static $lang = 'en';

    /**
     * @var array<string, array<string>>|null
     */
    private static $translations;

    /**
     * @var string[]|null
     */
    private static $custom_translations;

    /**
     * Set the language by passing language short name
     * like 'en' or 'ru' as the argument.
     * If given language is not supported by this package,
     * its language will be set to English by default.
     * If you don't call this method, the default
     * language will be also English.
     *
     * @param string $lang ISO 639-1 of the language
     * @param string[]|null $custom_translations
     *
     * @see https://github.com/short-number/short-number
     */
    public static function set(string $lang, ?array $custom_translations = null): void
    {
        self::includeTranslations();
        self::$lang = in_array($lang, self::availableLanguages(), true) ? $lang : 'en';
        self::$custom_translations = $custom_translations;
    }

    /**
     * Returns array of languages that are currently in lang directory
     *
     * @return string[]
     */
    private static function availableLanguages(): array
    {
        return self::$translations ? array_keys(self::$translations) : [];
    }

    /**
     * @param string $index The key name of the translation
     * @return string Needed translation for current language,
     * if translation not found returns empty string
     */
    public static function trans(string $index): string
    {
        if (!self::$translations) {
            self::includeTranslations();
        }

        /** @phpstan-ignore-next-line */
        $lang = self::$translations[self::$lang];

        if (self::$custom_translations) {
            $lang = array_merge($lang, self::$custom_translations);
        }

        return $lang[$index] ?? '';
    }

    public static function includeTranslations(): void
    {
        if (!self::$translations) {
            self::$translations = require __DIR__ . '/../resources/translations.php';
        }
    }
}
