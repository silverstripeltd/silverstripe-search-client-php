<?php

namespace Silverstripe\Search\Client\Model;

class SettingsResponse
{
    /**
     * @var array
     */
    protected $initialized = [];
    public function isInitialized($property): bool
    {
        return array_key_exists($property, $this->initialized);
    }
    /**
     * @var int
     */
    protected $precision;
    /**
     * @return int
     */
    public function getPrecision(): int
    {
        return $this->precision;
    }
    /**
     * @param int $precision
     *
     * @return self
     */
    public function setPrecision(int $precision): self
    {
        $this->initialized['precision'] = true;
        $this->precision = $precision;
        return $this;
    }
}