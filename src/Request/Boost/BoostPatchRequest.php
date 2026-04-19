<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client\Request\Boost;

use JsonSerializable;
use stdClass;

class BoostPatchRequest implements JsonSerializable
{

    private ?float $impact = null;

    /**
     * @var string[]|null
     */
    private ?array $values = null;

    private ?string $center = null;

    private ?string $function = null;

    private ?string $operation = null;

    public function getImpact(): ?float
    {
        return $this->impact;
    }

    public function setImpact(?float $impact): static
    {
        $this->impact = $impact;

        return $this;
    }

    /**
     * @return string[]|null
     */
    public function getValues(): ?array
    {
        return $this->values;
    }

    /**
     * @param string[]|null $values
     */
    public function setValues(?array $values): static
    {
        $this->values = $values;

        return $this;
    }

    public function getCenter(): ?string
    {
        return $this->center;
    }

    public function setCenter(?string $center): static
    {
        $this->center = $center;

        return $this;
    }

    public function getFunction(): ?string
    {
        return $this->function;
    }

    public function setFunction(?string $function): static
    {
        $this->function = $function;

        return $this;
    }

    public function getOperation(): ?string
    {
        return $this->operation;
    }

    public function setOperation(?string $operation): static
    {
        $this->operation = $operation;

        return $this;
    }

    /**
     * @return array|stdClass
     */
    public function jsonSerialize(): mixed
    {
        $payload = [];

        if ($this->impact !== null) {
            $payload['impact'] = $this->impact;
        }

        if ($this->values !== null) {
            $payload['values'] = $this->values;
        }

        if ($this->center !== null) {
            $payload['center'] = $this->center;
        }

        if ($this->function !== null) {
            $payload['function'] = $this->function;
        }

        if ($this->operation !== null) {
            $payload['operation'] = $this->operation;
        }

        return $payload ?: new stdClass();
    }

}
