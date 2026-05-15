<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client\Request\Curation;

use JsonSerializable;
use stdClass;

class CurationPatchRequest implements JsonSerializable
{

    private ?string $name = null;

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
     * @return array|stdClass
     */
    public function jsonSerialize(): mixed
    {
        $payload = [];

        if ($this->name !== null) {
            $payload['name'] = $this->name;
        }

        return $payload ?: new stdClass();
    }

}
