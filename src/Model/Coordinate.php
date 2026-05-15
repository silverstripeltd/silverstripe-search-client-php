<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client\Model;

use JsonSerializable;

class Coordinate implements JsonSerializable
{

    public function __construct(
        private readonly float|string $latitude,
        private readonly float|string $longitude,
    ) {
    }

    public function getLatitude(): float|string
    {
        return $this->latitude;
    }

    public function getLongitude(): float|string
    {
        return $this->longitude;
    }

    public function jsonSerialize(): array
    {
        return [
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ];
    }

}
