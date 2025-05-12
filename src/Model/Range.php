<?php

namespace Silverstripe\Search\Client\Model;

class Range extends \ArrayObject
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
    protected $from;
    /**
     * 
     *
     * @var mixed
     */
    protected $to;
    /**
     * 
     *
     * @return mixed
     */
    public function getFrom()
    {
        return $this->from;
    }
    /**
     * 
     *
     * @param mixed $from
     *
     * @return self
     */
    public function setFrom($from): self
    {
        $this->initialized['from'] = true;
        $this->from = $from;
        return $this;
    }
    /**
     * 
     *
     * @return mixed
     */
    public function getTo()
    {
        return $this->to;
    }
    /**
     * 
     *
     * @param mixed $to
     *
     * @return self
     */
    public function setTo($to): self
    {
        $this->initialized['to'] = true;
        $this->to = $to;
        return $this;
    }
}