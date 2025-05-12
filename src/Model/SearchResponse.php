<?php

namespace Silverstripe\Search\Client\Model;

class SearchResponse extends \ArrayObject
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
     * @var SearchResponseMeta
     */
    protected $meta;
    /**
     * 
     *
     * @var list<array<string, mixed>>
     */
    protected $results;
    /**
     * 
     *
     * @var mixed
     */
    protected $facets;
    /**
     * 
     *
     * @return SearchResponseMeta
     */
    public function getMeta(): SearchResponseMeta
    {
        return $this->meta;
    }
    /**
     * 
     *
     * @param SearchResponseMeta $meta
     *
     * @return self
     */
    public function setMeta(SearchResponseMeta $meta): self
    {
        $this->initialized['meta'] = true;
        $this->meta = $meta;
        return $this;
    }
    /**
     * 
     *
     * @return list<array<string, mixed>>
     */
    public function getResults(): array
    {
        return $this->results;
    }
    /**
     * 
     *
     * @param list<array<string, mixed>> $results
     *
     * @return self
     */
    public function setResults(array $results): self
    {
        $this->initialized['results'] = true;
        $this->results = $results;
        return $this;
    }
    /**
     * 
     *
     * @return mixed
     */
    public function getFacets()
    {
        return $this->facets;
    }
    /**
     * 
     *
     * @param mixed $facets
     *
     * @return self
     */
    public function setFacets($facets): self
    {
        $this->initialized['facets'] = true;
        $this->facets = $facets;
        return $this;
    }
}