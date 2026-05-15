<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client\Request\Search;

use JsonSerializable;

class SpellingSuggestionRequest implements JsonSerializable
{

    private int $size = 1;

    private bool $formatted = false;

    /**
     * @param string[] $fields
     */
    public function __construct(
        private readonly string $query,
        private readonly array $fields,
    ) {
    }

    public function getQuery(): string
    {
        return $this->query;
    }

    /**
     * @return string[]
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function setSize(int $size): static
    {
        $this->size = $size;

        return $this;
    }

    public function isFormatted(): bool
    {
        return $this->formatted;
    }

    public function setFormatted(bool $formatted): static
    {
        $this->formatted = $formatted;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'query' => $this->query,
            'fields' => $this->fields,
            'size' => $this->size,
            'formatted' => $this->formatted,
        ];
    }

}
