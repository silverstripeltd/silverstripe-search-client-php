<?php

namespace Silverstripe\Search\Client\Model;

class SpellingSuggestionRequest extends \ArrayObject
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
     * A query for which to receive spelling suggestions.
     *
     * @var string
     */
    protected $query;
    /**
     * Maximum number of spelling suggestions to return. Must be between 1 and 10. Defaults to 1.
     *
     * @var int
     */
    protected $size = 1;
    /**
     * Specify the document fields to look for suggestions within. At least 1 field is required.
     *
     * @var list<string>
     */
    protected $fields;
    /**
     * Whether you would like a 'snippet' field to be returned with each of your results.
     *
     * @var mixed
     */
    protected $formatted = false;
    /**
     * A query for which to receive spelling suggestions.
     *
     * @return string
     */
    public function getQuery(): string
    {
        return $this->query;
    }
    /**
     * A query for which to receive spelling suggestions.
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
     * Maximum number of spelling suggestions to return. Must be between 1 and 10. Defaults to 1.
     *
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }
    /**
     * Maximum number of spelling suggestions to return. Must be between 1 and 10. Defaults to 1.
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
     * Specify the document fields to look for suggestions within. At least 1 field is required.
     *
     * @return list<string>
     */
    public function getFields(): array
    {
        return $this->fields;
    }
    /**
     * Specify the document fields to look for suggestions within. At least 1 field is required.
     *
     * @param list<string> $fields
     *
     * @return self
     */
    public function setFields(array $fields): self
    {
        $this->initialized['fields'] = true;
        $this->fields = $fields;
        return $this;
    }
    /**
     * Whether you would like a 'snippet' field to be returned with each of your results.
     *
     * @return mixed
     */
    public function getFormatted()
    {
        return $this->formatted;
    }
    /**
     * Whether you would like a 'snippet' field to be returned with each of your results.
     *
     * @param mixed $formatted
     *
     * @return self
     */
    public function setFormatted($formatted): self
    {
        $this->initialized['formatted'] = true;
        $this->formatted = $formatted;
        return $this;
    }
}