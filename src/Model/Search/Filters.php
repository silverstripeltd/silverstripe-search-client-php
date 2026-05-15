<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client\Model\Search;

use JsonSerializable;
use stdClass;

class Filters implements JsonSerializable
{

    /**
     * @var array<int, array<string, mixed>|Filters>|null
     */
    private ?array $all = null;

    /**
     * @var array<int, array<string, mixed>|Filters>|null
     */
    private ?array $any = null;

    /**
     * @var array<int, array<string, mixed>|Filters>|null
     */
    private ?array $none = null;

    /**
     * @return array<int, array<string, mixed>|Filters>|null
     */
    public function getAll(): ?array
    {
        return $this->all;
    }

    /**
     * @param array<int, array<string, mixed>|Filters>|null $all
     */
    public function setAll(?array $all): static
    {
        $this->all = $all;

        return $this;
    }

    /**
     * @return array<int, array<string, mixed>|Filters>|null
     */
    public function getAny(): ?array
    {
        return $this->any;
    }

    /**
     * @param array<int, array<string, mixed>|Filters>|null $any
     */
    public function setAny(?array $any): static
    {
        $this->any = $any;

        return $this;
    }

    /**
     * @return array<int, array<string, mixed>|Filters>|null
     */
    public function getNone(): ?array
    {
        return $this->none;
    }

    /**
     * @param array<int, array<string, mixed>|Filters>|null $none
     */
    public function setNone(?array $none): static
    {
        $this->none = $none;

        return $this;
    }

    /**
     * @return array|stdClass
     */
    public function jsonSerialize(): mixed
    {
        $payload = [];

        if ($this->all !== null) {
            $payload['all'] = $this->all;
        }

        if ($this->any !== null) {
            $payload['any'] = $this->any;
        }

        if ($this->none !== null) {
            $payload['none'] = $this->none;
        }

        return $payload ?: new stdClass();
    }

}
