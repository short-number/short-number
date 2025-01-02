<?php

declare(strict_types=1);

namespace Serhii\ShortNumber;

final class Number
{
    /**
     * @var array<string,AbbreviationSet>
     */
    private static array $cache;

    private SetLoader $setLoader;
    private Config $config;

    private static self|null $instance = null;

    private function __construct()
    {
        $this->setLoader = new SetLoader();
        $this->config = new Config();
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
    public static function short(int $number): string
    {
        return self::singleton()->process($number);
    }

    public static function configure(Config $config): void
    {
        self::singleton()->config = $config;
    }

    private function process(int $number): string
    {
        $lang = Lang::current();
        $isNegative = $number < 0;

        if ($isNegative) {
            $number = (int) abs($number);
        }

        $set = match (true) {
            isset(self::$cache[$lang]) => self::$cache[$lang],
            default => self::$cache[$lang] = $this->setLoader->load($lang),
        };

        $result = (new NumberShortener($number, $set, $this->config))->shorten();

        if ($isNegative) {
            $result = '-' . $result;
        }

        if (!empty($set->overwrites)) {
            $result = $this->applyDefaultOverwrites($result, $set->overwrites);
        }

        return $result;
    }

    /**
     * @param non-empty-array<string,string> $overwrites
     */
    private function applyDefaultOverwrites(string $result, array $overwrites): string
    {
        foreach ($overwrites as $key => $overwrite) {
            if ($key === $result) {
                return $overwrite;
            }
        }

        return $result;
    }
}
