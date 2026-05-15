<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client\Model\Search;

use JsonSerializable;

class Range implements JsonSerializable
{

    public function __construct(
        private readonly string|int|float|null $from = null,
        private readonly string|int|float|null $to = null,
    ) {
    }

    public function getFrom(): string|int|float|null
    {
        return $this->from;
    }

    public function getTo(): string|int|float|null
    {
        return $this->to;
    }

    public function jsonSerialize(): array
    {
        $payload = [];

        if ($this->from !== null) {
            $payload['from'] = $this->from;
        }

        if ($this->to !== null) {
            $payload['to'] = $this->to;
        }

        return $payload;
    }

}
