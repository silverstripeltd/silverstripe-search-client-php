<?php

namespace Silverstripe\Search\Client\Model;

class SettingsRequest extends \ArrayObject
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
     * Precision setting for your engine. Valid values are 1 - 11 (inclusive)
     *
     * @var int
     */
    protected $precision;
    /**
     * Precision setting for your engine. Valid values are 1 - 11 (inclusive)
     *
     * @return int
     */
    public function getPrecision(): int
    {
        return $this->precision;
    }
    /**
     * Precision setting for your engine. Valid values are 1 - 11 (inclusive)
     *
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