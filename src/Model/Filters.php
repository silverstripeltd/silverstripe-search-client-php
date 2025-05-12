<?php

namespace Silverstripe\Search\Client\Model;

class Filters
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
     * @var mixed
     */
    protected $all;
    /**
     * 
     *
     * @var mixed
     */
    protected $any;
    /**
     * 
     *
     * @var mixed
     */
    protected $none;
    /**
     * 
     *
     * @return mixed
     */
    public function getAll()
    {
        return $this->all;
    }
    /**
     * 
     *
     * @param mixed $all
     *
     * @return self
     */
    public function setAll($all): self
    {
        $this->initialized['all'] = true;
        $this->all = $all;
        return $this;
    }
    /**
     * 
     *
     * @return mixed
     */
    public function getAny()
    {
        return $this->any;
    }
    /**
     * 
     *
     * @param mixed $any
     *
     * @return self
     */
    public function setAny($any): self
    {
        $this->initialized['any'] = true;
        $this->any = $any;
        return $this;
    }
    /**
     * 
     *
     * @return mixed
     */
    public function getNone()
    {
        return $this->none;
    }
    /**
     * 
     *
     * @param mixed $none
     *
     * @return self
     */
    public function setNone($none): self
    {
        $this->initialized['none'] = true;
        $this->none = $none;
        return $this;
    }
}