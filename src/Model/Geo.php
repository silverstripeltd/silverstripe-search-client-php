<?php

namespace Silverstripe\Search\Client\Model;

class Geo extends \ArrayObject
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
     * @var Coordinate|list<mixed>|string
     */
    protected $center;
    /**
     * 
     *
     * @var string
     */
    protected $unit;
    /**
     * 
     *
     * @var mixed
     */
    protected $distance;
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
    /**
     * 
     *
     * @return Coordinate|list<mixed>|string
     */
    public function getCenter()
    {
        return $this->center;
    }
    /**
     * 
     *
     * @param Coordinate|list<mixed>|string $center
     *
     * @return self
     */
    public function setCenter($center): self
    {
        $this->initialized['center'] = true;
        $this->center = $center;
        return $this;
    }
    /**
     * 
     *
     * @return string
     */
    public function getUnit(): string
    {
        return $this->unit;
    }
    /**
     * 
     *
     * @param string $unit
     *
     * @return self
     */
    public function setUnit(string $unit): self
    {
        $this->initialized['unit'] = true;
        $this->unit = $unit;
        return $this;
    }
    /**
     * 
     *
     * @return mixed
     */
    public function getDistance()
    {
        return $this->distance;
    }
    /**
     * 
     *
     * @param mixed $distance
     *
     * @return self
     */
    public function setDistance($distance): self
    {
        $this->initialized['distance'] = true;
        $this->distance = $distance;
        return $this;
    }
}