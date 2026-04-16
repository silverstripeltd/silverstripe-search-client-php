<?php

namespace Silverstripe\Search\Client\Model;

class Range
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
     * @var mixed|null
     */
    protected $from;
    /**
     * @var mixed|null
     */
    protected $to;
    /**
     * @return mixed
     */
    public function getFrom()
    {
        return $this->from;
    }
    /**
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
     * @return mixed
     */
    public function getTo()
    {
        return $this->to;
    }
    /**
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