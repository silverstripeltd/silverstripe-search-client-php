<?php

namespace Silverstripe\Search\Client\Model;

class EnginesResponse
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
     * @var list<EngineName>
     */
    protected $results;
    /**
     * @return list<EngineName>
     */
    public function getResults(): array
    {
        return $this->results;
    }
    /**
     * @param list<EngineName> $results
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