<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client\Model\Search;

use JsonSerializable;
use Silverstripe\Search\Client\Model\Coordinate;

class Geolocation implements JsonSerializable
{

    public function __construct(
        private readonly Coordinate $center,
        private readonly string $order,
    ) {
    }

    public function getCenter(): Coordinate
    {
        return $this->center;
    }

    public function getOrder(): string
    {
        return $this->order;
    }

    public function jsonSerialize(): array
    {
        return [
            'center' => $this->center,
            'order' => $this->order,
        ];
    }

}
