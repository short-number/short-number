<?php

declare(strict_types=1);

namespace Serhii\ShortNumber;

final class Number
{
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
     * Converts given number to its short representation form.
     */
    public static function conv(int $number): string
    {
        return self::singleton()->process($number);
    }

    private function process(int $number): string
    {
        $sets = $this->langLoader->load(__DIR__ . "/../resources/sets.php");

        dd($sets);

        return '';
    }
}
