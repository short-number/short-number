<?php

declare(strict_types=1);

namespace Serhii\ShortNumber;

class Rule
{
    public const THOUSAND = 1000;
    public const MILLION = 1000000;
    public const BILLION = 1000000000;
    public const TRILLION = 1000000000000;
    public const QUADRILLION = 1000000000000000;

    /**
     * @var string|null
     */
    private $number_name;

    /**
     * @var int[]
     */
    private $range;

    /**
     * @param int[] $range
     */
    public function __construct(string $number_name, array $range)
    {
        $this->number_name = $number_name;
        $this->range = $range;
    }

    public function formatNumber(int $num): string
    {
        if ($num < self::THOUSAND) {
            return $num . $this->getSuffix();
        }

        $short_num = explode(',', number_format((float) $num))[0];

        return $short_num . $this->getSuffix();
    }

    /**
     * Check if given value is in number range, for example
     * a thousand must be in range 1000 - 999_999
     */
    public function inRange(int $num): bool
    {
        [$min, $max] = $this->range;
        return $num >= $min && $num <= $max;
    }

    private function getSuffix(): string
    {
        if (!$this->number_name) {
            return '';
        }

        return Lang::trans($this->number_name);
    }
}
