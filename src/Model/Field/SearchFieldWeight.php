<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client\Model\Field;

use JsonSerializable;
use stdClass;

class SearchFieldWeight implements JsonSerializable
{

    public function __construct(private readonly int|float|null $weight = null)
    {
    }

    public function getWeight(): int|float|null
    {
        return $this->weight;
    }

    /**
     * @return array|stdClass
     */
    public function jsonSerialize(): mixed
    {
        if ($this->weight !== null) {
            return ['weight' => $this->weight];
        }

        return new stdClass();
    }

}
