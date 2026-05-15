<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client\Model;

use JsonSerializable;

class Pagination implements JsonSerializable
{

    public function __construct(
        private readonly int $current = 1,
        private readonly int $size = 10,
    ) {
    }

    public function getCurrent(): int
    {
        return $this->current;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function jsonSerialize(): array
    {
        return [
            'current' => $this->current,
            'size' => $this->size,
        ];
    }

}
