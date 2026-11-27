<?php

declare(strict_types=1);

namespace Serhii\ShortNumber;

use InvalidArgumentException;
use RuntimeException;

final class SetLoader
{
    public function __construct()
    {
    }

    public function load(string $lang): AbbreviationSet
    {
        if (preg_match('/\A[a-z]{2}\z/', $lang) !== 1) {
            throw new InvalidArgumentException("[Short Number]: Unsupported language '{$lang}'");
        }

        $path = __DIR__ . "/../sets/{$lang}.php";

        if (!is_file($path)) {
            throw new InvalidArgumentException("[Short Number]: Unsupported language '{$lang}'");
        }

        $set = require $path;

        if (!$set instanceof AbbreviationSet) {
            throw new RuntimeException("[Short Number]: Failed to load set from {$path}");
        }

        return $set;
    }
}
