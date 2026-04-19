<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client\Model\Search;

use JsonSerializable;
use Silverstripe\Search\Client\Model\Coordinate;

class Geo implements JsonSerializable
{

    private int|float|string|null $from = null;

    private int|float|string|null $to = null;

    private ?int $distance = null;

    public function __construct(
        private readonly Coordinate $center,
        private readonly string $unit,
    ) {
    }

    public function getCenter(): Coordinate
    {
        return $this->center;
    }

    public function getUnit(): string
    {
        return $this->unit;
    }

    public function getFrom(): int|float|string|null
    {
        return $this->from;
    }

    public function setFrom(int|float|string|null $from): static
    {
        $this->from = $from;

        return $this;
    }

    public function getTo(): int|float|string|null
    {
        return $this->to;
    }

    public function setTo(int|float|string|null $to): static
    {
        $this->to = $to;

        return $this;
    }

    public function getDistance(): ?int
    {
        return $this->distance;
    }

    public function setDistance(?int $distance): static
    {
        $this->distance = $distance;

        return $this;
    }

    public function jsonSerialize(): array
    {
        $payload = [
            'center' => $this->center,
            'unit' => $this->unit,
        ];

        if ($this->from !== null) {
            $payload['from'] = $this->from;
        }

        if ($this->to !== null) {
            $payload['to'] = $this->to;
        }

        if ($this->distance !== null) {
            $payload['distance'] = $this->distance;
        }

        return $payload;
    }

}
