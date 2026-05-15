<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client\Model\Search;

use JsonSerializable;

class FacetValue implements JsonSerializable
{

    private ?string $name = null;

    private int $size = 10;

    /**
     * EG: ["count" => "desc"] or ["value" => "asc"]
     *
     * @var array<string, string>|null
     */
    private ?array $sort = null;

    public function __construct(private readonly string $type = 'value')
    {
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
     * @return array<string, string>|null
     */
    public function getSort(): ?array
    {
        return $this->sort;
    }

    /**
     * @param array<string, string>|null $sort
     */
    public function setSort(?array $sort): static
    {
        $this->sort = $sort;

        return $this;
    }

    public function jsonSerialize(): array
    {
        $payload = [
            'type' => $this->type,
            'size' => $this->size,
        ];

        if ($this->name !== null) {
            $payload['name'] = $this->name;
        }

        if ($this->sort !== null) {
            $payload['sort'] = $this->sort;
        }

        return $payload;
    }

}
