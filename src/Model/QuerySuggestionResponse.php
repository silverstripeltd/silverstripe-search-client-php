<?php

namespace Silverstripe\Search\Client\Model;

class QuerySuggestionResponse extends \ArrayObject
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
     * @var list<QuerySuggestionResponseValue>
     */
    protected $results;
    /**
     * 
     *
     * @return list<QuerySuggestionResponseValue>
     */
    public function getResults(): array
    {
        return $this->results;
    }
    /**
     * 
     *
     * @param list<QuerySuggestionResponseValue> $results
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