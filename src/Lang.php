<?php

declare(strict_types=1);

namespace Serhii\ShortNumber;

/**
 * @see https://github.com/short-number/short-number
 */
class Lang
{
    private static string $lang = 'en';

    /**
     * @var array<string,string>|null
     */
    private static array|null $overwrites;

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
