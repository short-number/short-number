<?php

declare(strict_types=1);

namespace Serhii\ShortNumber;

class Number
{
    /**
     * @var array|null
     */
    private $options;

    /**
     * @var int|null
     */
    private $number;

    private function __construct()
    {
    }

    /**
     * @var \Serhii\ShortNumber\Number|null
     */
    private static $instance;

    public static function singleton(): self
    {
        return static::$instance ?? (static::$instance = new static());
    }

    /**
     * Converts given number to its short form.
     *
     * @param int $number
     * @param int[]|int|null $options
     *
     * @return string
     */
    public static function conv(int $number, $options = []): string
    {
        return self::singleton()->process($number, \is_array($options) ? $options : [$options]);
    }

    /**
     * Converts given number to its short form.
     *
     * @param int $number
     * @param int[]|array $options
     *
     * @return string
     */
    private function process(int $number, array $options): string
    {
        $this->options = $options;
        $this->number = $number;

        Lang::includeTranslations();

        $number_is_negative = $number < 0;

        if ($number_is_negative) {
            $this->number = (int) \abs($this->number);
        }

        $rules = $this->createRules();

        $needed_rule = $this->getRuleThatMatchesNumber($rules);

        $result = !empty($needed_rule)
            ? \current($needed_rule)->formatNumber($this->number)
            : \end($rules)->formatNumber($this->number);

        return $number_is_negative ? "-$result" : $result;
    }

    /**
     * @return \Serhii\ShortNumber\Rule[]
     */
    private function createRules(): array
    {
        return [
            new Rule('', [0, 999], $this->options),
            new Rule('thousand', [Rule::THOUSAND, Rule::MILLION - 1], $this->options),
            new Rule('million', [Rule::MILLION, Rule::BILLION - 1], $this->options),
            new Rule('billion', [Rule::BILLION, Rule::TRILLION - 1], $this->options),
            new Rule('trillion', [Rule::TRILLION, Rule::QUADRILLION - 1], $this->options),
        ];
    }

    /**
     * @param array $rules
     *
     * @return array
     */
    private function getRuleThatMatchesNumber(array $rules): array
    {
        return \array_filter($rules, function ($rule) {
            return $rule->inRange($this->number);
        });
}
}
