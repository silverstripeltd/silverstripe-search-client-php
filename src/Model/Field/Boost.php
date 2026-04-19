<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client\Model\Field;

use JsonSerializable;

class Boost implements JsonSerializable
{

    /**
     * @var string[]|null
     */
    private ?array $value = null;

    private float $factor = 1.0;

    private ?string $center = null;

    private ?string $function = null;

    private ?string $operation = null;

    public function __construct(private readonly string $type)
    {
    }

    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string[]|null
     */
    public function getValue(): ?array
    {
        return $this->value;
    }

    /**
     * @param string[]|null $value
     */
    public function setValue(?array $value): static
    {
        $this->value = $value;

        return $this;
    }

    public function getFactor(): float
    {
        return $this->factor;
    }

    public function setFactor(float $factor): static
    {
        $this->factor = $factor;

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

    public function jsonSerialize(): array
    {
        $payload = [
            'type' => $this->type,
            'factor' => $this->factor,
        ];

        if ($this->value !== null) {
            $payload['value'] = $this->value;
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

        return $payload;
    }

}
