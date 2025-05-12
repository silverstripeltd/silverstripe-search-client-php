<?php

namespace Silverstripe\Search\Client\Model;

class RequestFacetValue extends \ArrayObject
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
     * @var int
     */
    protected $size = 10;
    /**
     * 
     *
     * @var array<string, string>|null
     */
    protected $sort;
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
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }
    /**
     * 
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
     * 
     *
     * @return array<string, string>|null
     */
    public function getSort(): iterable
    {
        return $this->sort;
    }
    /**
     * 
     *
     * @param array<string, string>|null $sort
     *
     * @return self
     */
    public function setSort(iterable $sort): self
    {
        $this->initialized['sort'] = true;
        $this->sort = $sort;
        return $this;
    }
}