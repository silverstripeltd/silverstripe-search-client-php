<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client\Model\Field;

use JsonSerializable;
use stdClass;

class ResultFieldRaw implements JsonSerializable
{

    public function __construct(private readonly ?int $size = null)
    {
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    /**
     * @return array|stdClass
     */
    public function jsonSerialize(): mixed
    {
        if ($this->size !== null) {
            return ['size' => $this->size];
        }

        // An empty raw field is valid and should serialise as {} not []
        return new stdClass();
    }

}
