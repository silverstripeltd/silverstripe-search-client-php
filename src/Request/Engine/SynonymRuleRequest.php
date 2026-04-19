<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client\Request\Engine;

use JsonSerializable;

class SynonymRuleRequest implements JsonSerializable
{

    public function __construct(private readonly string $synonyms)
    {
    }

    public function getSynonyms(): string
    {
        return $this->synonyms;
    }

    public function jsonSerialize(): array
    {
        return [
            'synonyms' => $this->synonyms,
        ];
    }

}
