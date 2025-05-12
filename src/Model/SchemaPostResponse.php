<?php

namespace Silverstripe\Search\Client\Model;

class SchemaPostResponse extends \ArrayObject
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
     * 
     *
     * @var bool
     */
    protected $acknowledged;
    /**
     * 
     *
     * @return bool
     */
    public function getAcknowledged(): bool
    {
        return $this->acknowledged;
    }
    /**
     * 
     *
     * @param bool $acknowledged
     *
     * @return self
     */
    public function setAcknowledged(bool $acknowledged): self
    {
        $this->initialized['acknowledged'] = true;
        $this->acknowledged = $acknowledged;
        return $this;
    }
}