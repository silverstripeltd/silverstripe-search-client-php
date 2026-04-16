<?php

namespace Silverstripe\Search\Client\Model;

class SearchRequestSearchFieldsWeight
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
     * @var mixed|null
     */
    protected $weight;
    /**
     * @return mixed
     */
    public function getWeight()
    {
        return $this->weight;
    }
    /**
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