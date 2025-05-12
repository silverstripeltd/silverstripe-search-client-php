<?php

namespace Silverstripe\Search\Client\Model;

class SearchRequestSearchFieldsWeight extends \ArrayObject
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
     * @var mixed
     */
    protected $weight;
    /**
     * 
     *
     * @return mixed
     */
    public function getWeight()
    {
        return $this->weight;
    }
    /**
     * 
     *
     * @param mixed $weight
     *
     * @return self
     */
    public function setWeight($weight): self
    {
        $this->initialized['weight'] = true;
        $this->weight = $weight;
        return $this;
    }
}