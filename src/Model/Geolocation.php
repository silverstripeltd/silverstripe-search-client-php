<?php

namespace Silverstripe\Search\Client\Model;

class Geolocation extends \ArrayObject
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
     * @var Coordinate|list<mixed>|string
     */
    protected $center;
    /**
     * 
     *
     * @var string
     */
    protected $order;
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
    public function getOrder(): string
    {
        return $this->order;
    }
    /**
     * 
     *
     * @param string $order
     *
     * @return self
     */
    public function setOrder(string $order): self
    {
        $this->initialized['order'] = true;
        $this->order = $order;
        return $this;
    }
}