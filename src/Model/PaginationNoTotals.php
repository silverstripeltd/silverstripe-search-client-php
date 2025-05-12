<?php

namespace Silverstripe\Search\Client\Model;

class PaginationNoTotals extends \ArrayObject
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
    * Page number of results to return. Must be greater than or equal to 1 and less than or equal to 
           100. Defaults to 1.
    *
    * @var int
    */
    protected $current = 1;
    /**
    * Number of results per page. Must be greater than or equal to 1 and less than or equal to 1000. 
           Defaults to 10.
    *
    * @var int
    */
    protected $size = 10;
    /**
    * Page number of results to return. Must be greater than or equal to 1 and less than or equal to 
           100. Defaults to 1.
    *
    * @return int
    */
    public function getCurrent(): int
    {
        return $this->current;
    }
    /**
    * Page number of results to return. Must be greater than or equal to 1 and less than or equal to 
           100. Defaults to 1.
    *
    * @param int $current
    *
    * @return self
    */
    public function setCurrent(int $current): self
    {
        $this->initialized['current'] = true;
        $this->current = $current;
        return $this;
    }
    /**
    * Number of results per page. Must be greater than or equal to 1 and less than or equal to 1000. 
           Defaults to 10.
    *
    * @return int
    */
    public function getSize(): int
    {
        return $this->size;
    }
    /**
    * Number of results per page. Must be greater than or equal to 1 and less than or equal to 1000. 
           Defaults to 10.
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
}