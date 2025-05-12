<?php

namespace Silverstripe\Search\Client\Model;

class RequestFacetRange extends \ArrayObject
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
     * @var string
     */
    protected $type;
    /**
     * 
     *
     * @var mixed
     */
    protected $name;
    /**
     * 
     *
     * @var list<RequestFacetRangeObject>
     */
    protected $ranges;
    /**
     * 
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
    /**
     * 
     *
     * @param string $type
     *
     * @return self
     */
    public function setType(string $type): self
    {
        $this->initialized['type'] = true;
        $this->type = $type;
        return $this;
    }
    /**
     * 
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * 
     *
     * @param mixed $name
     *
     * @return self
     */
    public function setName($name): self
    {
        $this->initialized['name'] = true;
        $this->name = $name;
        return $this;
    }
    /**
     * 
     *
     * @return list<RequestFacetRangeObject>
     */
    public function getRanges(): array
    {
        return $this->ranges;
    }
    /**
     * 
     *
     * @param list<RequestFacetRangeObject> $ranges
     *
     * @return self
     */
    public function setRanges(array $ranges): self
    {
        $this->initialized['ranges'] = true;
        $this->ranges = $ranges;
        return $this;
    }
}