<?php

declare(strict_types=1);

namespace Serhii\ShortNumber;

use LogicException;

final class Number
{
    /**
     * @var array<string,AbbreviationSet>
     */
    private static array $cache;

    private SetLoader $setLoader;
    private Config $config;
    private bool $configLocked = false;

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

    /**
     * Sets the configuration. Can be called multiple times until
     * the configuration is locked with configureOnce().
     */
    public static function configure(Config $config): void
    {
        $instance = self::singleton();
        $instance->assertConfigNotLocked();
        $instance->config = $config;
    }

    /**
     * Sets the configuration and prevents any further changes.
     * Changing the language with Lang::set() is still allowed.
     *
     * @throws LogicException when the configuration is already locked
     */
    public static function configureOnce(Config $config): void
    {
        $instance = self::singleton();
        $instance->assertConfigNotLocked();
        $instance->config = $config;
        $instance->configLocked = true;
    }

    private function assertConfigNotLocked(): void
    {
        if ($this->configLocked) {
            throw new LogicException(
                '[Short Number]: Configuration is already set and cannot be changed.',
            );
        }
    }

    private function process(int $number): string
    {
        $lang = Lang::current();
        $isNegative = $number < 0;

        $absolute = str_replace('-', '', (string) $number);

        $set = match (true) {
            isset(self::$cache[$lang]) => self::$cache[$lang],
            default => self::$cache[$lang] = $this->setLoader->load($lang),
        };

        $result = (new NumberShortener($absolute, $set, $this->config))->shorten();

        if ($isNegative) {
            $result = '-' . $result;
        }

        return $result;
    }
}
