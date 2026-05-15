<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client\Model\Search;

use JsonSerializable;

class FacetRange implements JsonSerializable
{

    private ?string $name = null;

    /**
     * @param FacetRangeObject[] $ranges
     */
    public function __construct(
        private readonly array $ranges,
        private readonly string $type = 'range',
    ) {
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return FacetRangeObject[]
     */
    public function getRanges(): array
    {
        return $this->ranges;
    }

    public function jsonSerialize(): array
    {
        $payload = [
            'type' => $this->type,
            'ranges' => $this->ranges,
        ];

        if ($this->name !== null) {
            $payload['name'] = $this->name;
        }

        return $payload;
    }

}
