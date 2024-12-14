<?php

declare(strict_types=1);

namespace Serhii\ShortNumber;

use RuntimeException;

final class LangLoader
{
    public function __construct()
    {
    }

    /**
     * @return array<string,AbbreviationSet>
     */
    public function load(string $path): array
    {
        $sets = require $path;

        if (!is_array($sets)) {
            throw new RuntimeException('[Short Number]: Failed to load language sets');
        }

        return $sets;
    }
}
