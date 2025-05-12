<?php

namespace Silverstripe\Search\Client\Model;

class DocumentListResponse extends \ArrayObject
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
     * @var DocumentListResponseMeta
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
     * @return DocumentListResponseMeta
     */
    public function getMeta(): DocumentListResponseMeta
    {
        return $this->meta;
    }
    /**
     * 
     *
     * @param DocumentListResponseMeta $meta
     *
     * @return self
     */
    public function setMeta(DocumentListResponseMeta $meta): self
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
}