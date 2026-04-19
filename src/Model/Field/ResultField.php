<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client\Model\Field;

use JsonSerializable;
use stdClass;

class ResultField implements JsonSerializable
{

    private ?ResultFieldRaw $raw = null;

    private ?ResultFieldSnippet $snippet = null;

    public function getRaw(): ?ResultFieldRaw
    {
        return $this->raw;
    }

    public function setRaw(?ResultFieldRaw $raw): static
    {
        $this->raw = $raw;

        return $this;
    }

    public function getSnippet(): ?ResultFieldSnippet
    {
        return $this->snippet;
    }

    public function setSnippet(?ResultFieldSnippet $snippet): static
    {
        $this->snippet = $snippet;

        return $this;
    }

    /**
     * @return array|stdClass
     */
    public function jsonSerialize(): mixed
    {
        $payload = [];

        if ($this->raw !== null) {
            $payload['raw'] = $this->raw;
        }

        if ($this->snippet !== null) {
            $payload['snippet'] = $this->snippet;
        }

        return $payload ?: new stdClass();
    }

}
