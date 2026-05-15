<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client\Request\Curation;

use JsonSerializable;

class CurationQueryPostRequest implements JsonSerializable
{

    public function __construct(private readonly string $query)
    {
    }

    public function getQuery(): string
    {
        return $this->query;
    }

    public function jsonSerialize(): array
    {
        return [
            'query' => $this->query,
        ];
    }

}
