<?php

declare(strict_types=1);

namespace Serhii\ShortNumber\Exceptions;

use Exception;

final class LargeNumberException extends Exception
{
    public function __construct(int $number)
    {
        parent::__construct("Number {$number} is too large to process");
    }
}
