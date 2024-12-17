<?php

declare(strict_types=1);

namespace Serhii\ShortNumber;

/**
 * @see https://github.com/short-number/short-number
 */
class Lang
{
    public const DEFAULT_LANG = 'en';
    public const DEFAULT_OVERWRITES = [];

    private static string $lang = self::DEFAULT_LANG;

    /**
     * @var array<string,array<string,string>>
     */
    private static array $overwrites = self::DEFAULT_OVERWRITES;

    /**
     * Set the language by passing language short name
     * like 'en' or 'ru' as the argument.
     * Default is English.
     *
     * @param string $lang ISO 639-1 of the language
     * @param array<string,string>|null $overwrites
     */
    public static function set(string $lang, array|null $overwrites = null): void
    {
        self::$lang = $lang;

        if ($overwrites) {
            self::$overwrites[$lang] = $overwrites;
        }
    }

    /**
     * Set the language and overwrites to the default values.
     */
    public static function setToDefaults(): void
    {
        self::$lang = self::DEFAULT_LANG;
        self::$overwrites = self::DEFAULT_OVERWRITES;
    }

    public static function current(): string
    {
        return self::$lang;
    }

    /**
     * @param array<string,array<string,string>> $overwrites
     */
    public static function setOverwrites(array $overwrites): void
    {
        self::$overwrites = $overwrites;
    }

    /**
     * @return array<string,array<string,string>>|null
     */
    public static function getOverwrites(): array|null
    {
        return self::$overwrites;
    }

    /**
     * @return array<string,string>|null
     */
    public static function getLangOverwrites(string $lang): array|null
    {
        return self::$overwrites[$lang] ?? null;
    }
}
