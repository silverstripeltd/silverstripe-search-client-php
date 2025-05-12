<?php

namespace Silverstripe\Search\Client\Model;

class SearchRequestResultField extends \ArrayObject
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
     * @var SearchRequestResultFieldRaw|null
     */
    protected $raw;
    /**
     * If given for a field type other than text, it will be silently ignored.
     *
     * @var SearchRequestResultFieldSnippet|null
     */
    protected $snippet;
    /**
     * 
     *
     * @return SearchRequestResultFieldRaw|null
     */
    public function getRaw(): SearchRequestResultFieldRaw
    {
        return $this->raw;
    }
    /**
     * 
     *
     * @param SearchRequestResultFieldRaw|null $raw
     *
     * @return self
     */
    public function setRaw(SearchRequestResultFieldRaw $raw): self
    {
        $this->initialized['raw'] = true;
        $this->raw = $raw;
        return $this;
    }
    /**
     * If given for a field type other than text, it will be silently ignored.
     *
     * @return SearchRequestResultFieldSnippet|null
     */
    public function getSnippet(): SearchRequestResultFieldSnippet
    {
        return $this->snippet;
    }
    /**
     * If given for a field type other than text, it will be silently ignored.
     *
     * @param SearchRequestResultFieldSnippet|null $snippet
     *
     * @return self
     */
    public function setSnippet(SearchRequestResultFieldSnippet $snippet): self
    {
        $this->initialized['snippet'] = true;
        $this->snippet = $snippet;
        return $this;
    }
}