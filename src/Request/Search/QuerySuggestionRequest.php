<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client\Request\Search;

use JsonSerializable;

class QuerySuggestionRequest implements JsonSerializable
{

    private int $size = 10;

    /**
     * @var string[]|null
     */
    private ?array $fields = null;

    public function __construct(private readonly string $query)
    {
    }

    public function getQuery(): string
    {
        return $this->query;
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

    /**
     * @return string[]|null
     */
    public function getFields(): ?array
    {
        return $this->fields;
    }

    /**
     * @param string[]|null $fields
     */
    public function setFields(?array $fields): static
    {
        $this->fields = $fields;

        return $this;
    }

    public function jsonSerialize(): array
    {
        $payload = [
            'query' => $this->query,
            'size' => $this->size,
        ];

        if ($this->fields !== null) {
            $payload['fields'] = $this->fields;
        }

        return $payload;
    }

}
