<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client\Request\Curation;

use JsonSerializable;

class CurationPostRequest implements JsonSerializable
{

    private ?string $name = null;

    /**
     * @var string[]|null
     */
    private ?array $queries = null;

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
     * @return string[]|null
     */
    public function getQueries(): ?array
    {
        return $this->queries;
    }

    /**
     * @param string[]|null $queries
     */
    public function setQueries(?array $queries): static
    {
        $this->queries = $queries;

        return $this;
    }

    public function jsonSerialize(): array
    {
        $payload = [];

        if ($this->name !== null) {
            $payload['name'] = $this->name;
        }

        if ($this->queries !== null) {
            $payload['queries'] = $this->queries;
        }

        return $payload;
    }

}
