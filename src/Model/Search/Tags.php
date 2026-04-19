<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client\Model\Search;

use JsonSerializable;

class Tags implements JsonSerializable
{

    /**
     * @param string[] $tags
     */
    public function __construct(private readonly array $tags)
    {
    }

    /**
     * @return string[]
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    public function jsonSerialize(): array
    {
        return [
            'tags' => $this->tags,
        ];
    }

}
