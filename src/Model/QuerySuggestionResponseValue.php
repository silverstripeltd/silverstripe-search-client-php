<?php

namespace Silverstripe\Search\Client\Model;

class QuerySuggestionResponseValue extends \ArrayObject
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
     * @var string
     */
    protected $raw;
    /**
     * 
     *
     * @return string
     */
    public function getRaw(): string
    {
        return $this->raw;
    }
    /**
     * 
     *
     * @param string $raw
     *
     * @return self
     */
    public function setRaw(string $raw): self
    {
        $this->initialized['raw'] = true;
        $this->raw = $raw;
        return $this;
    }
}