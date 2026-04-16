<?php

namespace Silverstripe\Search\Client\Model;

class Coordinate
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
     * @var mixed
     */
    protected $latitude;
    /**
     * @var mixed
     */
    protected $longitude;
    /**
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }
    /**
     * @param mixed $latitude
     *
     * @return self
     */
    public function setLatitude($latitude): self
    {
        $this->initialized['latitude'] = true;
        $this->latitude = $latitude;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }
    /**
     * @param mixed $longitude
     *
     * @return self
     */
    public function setLongitude($longitude): self
    {
        $this->initialized['longitude'] = true;
        $this->longitude = $longitude;
        return $this;
    }
}