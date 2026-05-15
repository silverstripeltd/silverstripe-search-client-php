<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client\Request\Curation;

use JsonSerializable;
use stdClass;

class CurationDocumentPatchRequest implements JsonSerializable
{

    private ?int $type = null;

    private ?int $sort = null;

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(?int $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getSort(): ?int
    {
        return $this->sort;
    }

    public function setSort(?int $sort): static
    {
        $this->sort = $sort;

        return $this;
    }

    /**
     * @return array|stdClass
     */
    public function jsonSerialize(): mixed
    {
        $payload = [];

        if ($this->type !== null) {
            $payload['type'] = $this->type;
        }

        if ($this->sort !== null) {
            $payload['sort'] = $this->sort;
        }

        return $payload ?: new stdClass();
    }

}
