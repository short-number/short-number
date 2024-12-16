<?php

declare(strict_types=1);

namespace Serhii\ShortNumber;

class Lang
{
    private static string $lang = 'en';

    /**
     * @var list<string>|null
     */
    private static array|null $overwrites;

    /**
     * Set the language by passing language short name
     * like 'en' or 'ru' as the argument.
     * If given language is not supported by this package,
     * its language will be set to English by default.
     * If you don't call this method, the default
     * language will be also English.
     *
     * @param string $lang ISO 639-1 of the language
     * @param list<string>|null $overwrites
     *
     * @see https://github.com/short-number/short-number
     */
    public static function set(string $lang, array|null $overwrites = null): void
    {
        self::$lang = $lang;
        self::$overwrites = $overwrites;
    }

    public static function current(): string
    {
        return self::$lang;
    }

    /**
     * @param array<string,string> $overwrites
     */
    public static function setOverwrites(array $overwrites): void
    {
        self::$overwrites = $overwrites;
    }
}
