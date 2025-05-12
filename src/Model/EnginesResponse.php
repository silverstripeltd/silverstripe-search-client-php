<?php

namespace Silverstripe\Search\Client\Model;

class EnginesResponse extends \ArrayObject
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
     * @var list<Engine>
     */
    protected $results;
    /**
     * 
     *
     * @return list<Engine>
     */
    public function getResults(): array
    {
        return $this->results;
    }
    /**
     * 
     *
     * @param list<Engine> $results
     *
     * @return self
     */
    public function setResults(array $results): self
    {
        $this->initialized['results'] = true;
        $this->results = $results;
        return $this;
    }
}