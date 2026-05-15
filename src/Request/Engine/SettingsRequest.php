<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client\Request\Engine;

use JsonSerializable;

class SettingsRequest implements JsonSerializable
{

    public function __construct(private readonly int $precision)
    {
    }

    public function getPrecision(): int
    {
        return $this->precision;
    }

    public function jsonSerialize(): array
    {
        return [
            'precision' => $this->precision,
        ];
    }

}
