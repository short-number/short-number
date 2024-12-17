<?php

declare(strict_types=1);

namespace Serhii\ShortNumber;

use RuntimeException;

final class SetLoader
{
    public function __construct()
    {
    }

    public function load(string $lang): AbbreviationSet
    {
        $path = __DIR__ . "/../sets/{$lang}.php";
        $set = require $path;

        if (!$set instanceof AbbreviationSet) {
            throw new RuntimeException("[Short Number]: Failed to load set from {$path}");
        }

        return $set;
    }
}
