<?php

declare(strict_types=1);

namespace Serhii\ShortNumber;

final class Number
{
    /**
     * @var array<string,AbbreviationSet>
     */
    private static array $cache;

    private LangLoader $langLoader;

    private static self|null $instance = null;

    private function __construct()
    {
        $this->langLoader = new LangLoader();
    }

    public static function singleton(): self
    {
        return self::$instance ?? (self::$instance = new self());
    }

    /**
     * Converts given number to its short representation form
     * based on the language.
     * If the number is negative, the minus sign is included.
     * For example, for most languages, the number 1721 will be
     * converted to '1k'. Unless you overwrite the output suffix.
     */
    public static function conv(int $number): string
    {
        return self::singleton()->process($number);
    }

    private function process(int $number): string
    {
        $lang = Lang::get();

        $set = match (true) {
            isset(self::$cache[$lang]) => self::$cache[$lang],
            default => self::$cache[$lang] = $this->langLoader->load($lang),
        };

        $shortNumber = (new NumberShortener($number, $set))->shorten();

        if ($number < 0) {
            $shortNumber = '-' . $shortNumber;
        }

        return $shortNumber;
    }
}
