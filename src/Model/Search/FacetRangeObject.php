<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client\Model\Search;

use JsonSerializable;

class FacetRangeObject implements JsonSerializable
{

    public function __construct(
        private readonly string|int|float|null $from = null,
        private readonly string|int|float|null $to = null,
        private readonly ?string $name = null,
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

    public function getName(): ?string
    {
        return $this->name;
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

        if ($this->name !== null) {
            $payload['name'] = $this->name;
        }

        return $payload;
    }

}
