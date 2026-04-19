<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client\Model\Field;

use JsonSerializable;
use stdClass;

class ResultFieldSnippet implements JsonSerializable
{

    public function __construct(
        private readonly ?int $size = null,
        private readonly ?bool $fallback = null,
    ) {
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function getFallback(): ?bool
    {
        return $this->fallback;
    }

    /**
     * @return array|stdClass
     */
    public function jsonSerialize(): mixed
    {
        $payload = [];

        if ($this->size !== null) {
            $payload['size'] = $this->size;
        }

        if ($this->fallback !== null) {
            $payload['fallback'] = $this->fallback;
        }

        return $payload ?: new stdClass();
    }

}
