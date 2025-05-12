<?php

namespace Silverstripe\Search\Client\Model;

class QuerySuggestionRequest extends \ArrayObject
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
     * A partial query for which to receive suggestions.
     *
     * @var string
     */
    protected $query;
    /**
     * Maximum number of query suggestions to return. Must be between 1 and 20. Defaults to 10.
     *
     * @var int
     */
    protected $size = 10;
    /**
     * Specify the document fields to look for suggestions within. Defaults to all text fields.
     *
     * @var mixed
     */
    protected $fields;
    /**
     * A partial query for which to receive suggestions.
     *
     * @return string
     */
    public function getQuery(): string
    {
        return $this->query;
    }
    /**
     * A partial query for which to receive suggestions.
     *
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
    /**
     * Maximum number of query suggestions to return. Must be between 1 and 20. Defaults to 10.
     *
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }
    /**
     * Maximum number of query suggestions to return. Must be between 1 and 20. Defaults to 10.
     *
     * @param int $size
     *
     * @return self
     */
    public function setSize(int $size): self
    {
        $this->initialized['size'] = true;
        $this->size = $size;
        return $this;
    }
    /**
     * Specify the document fields to look for suggestions within. Defaults to all text fields.
     *
     * @return mixed
     */
    public function getFields()
    {
        return $this->fields;
    }
    /**
     * Specify the document fields to look for suggestions within. Defaults to all text fields.
     *
     * @param mixed $fields
     *
     * @return self
     */
    public function setFields($fields): self
    {
        $this->initialized['fields'] = true;
        $this->fields = $fields;
        return $this;
    }
}