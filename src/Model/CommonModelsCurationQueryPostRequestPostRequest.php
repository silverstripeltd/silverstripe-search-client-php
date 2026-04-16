<?php

namespace Silverstripe\Search\Client\Model;

class CommonModelsCurationQueryPostRequestPostRequest
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
     * @var string
     */
    protected $query;
    /**
     * @return string
     */
    public function getQuery(): string
    {
        return $this->query;
    }
    /**
     * @param string $query
     *
     * @return self
     */
    public function setQuery(string $query): self
    {
        $this->initialized['query'] = true;
        $this->query = $query;
        return $this;
    }
}