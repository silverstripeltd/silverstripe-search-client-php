<?php

namespace Silverstripe\Search\Client\Model;

class BoostGetResponse
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
     * ID of the boost
     *
     * @var string
     */
    protected $id;
    /**
     * Types of boosts that can be applied to fields.
     * 
     * Valid combinations:
     * - text: value
     * - number: value, proximity, functional
     * - date: value, proximity
     * - geolocation: proximity
     *
     * @var string
     */
    protected $type;
    /**
     * Boost impact/factor (0-10, one decimal place)
     *
     * @var float
     */
    protected $impact;
    /**
     * Values to boost (for value boost type)
     *
     * @var mixed|null
     */
    protected $values;
    /**
     * Center point for proximity calculation (for proximity boost type)
     *
     * @var mixed|null
     */
    protected $center;
    /**
     * Function to apply (for proximity and functional boost types)
     *
     * @var mixed|null
     */
    protected $function;
    /**
     * How to combine function result with score (for functional boost type)
     *
     * @var string|null
     */
    protected $operation;
    /**
     * ID of the boost
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
    /**
     * ID of the boost
     *
     * @param string $id
     *
     * @return self
     */
    public function setId(string $id): self
    {
        $this->initialized['id'] = true;
        $this->id = $id;
        return $this;
    }
    /**
     * Types of boosts that can be applied to fields.
     * 
     * Valid combinations:
     * - text: value
     * - number: value, proximity, functional
     * - date: value, proximity
     * - geolocation: proximity
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
    /**
    * Types of boosts that can be applied to fields.
    
    Valid combinations:
    - text: value
    - number: value, proximity, functional
    - date: value, proximity
    - geolocation: proximity
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
     * Boost impact/factor (0-10, one decimal place)
     *
     * @return float
     */
    public function getImpact(): float
    {
        return $this->impact;
    }
    /**
     * Boost impact/factor (0-10, one decimal place)
     *
     * @param float $impact
     *
     * @return self
     */
    public function setImpact(float $impact): self
    {
        $this->initialized['impact'] = true;
        $this->impact = $impact;
        return $this;
    }
    /**
     * Values to boost (for value boost type)
     *
     * @return mixed
     */
    public function getValues()
    {
        return $this->values;
    }
    /**
     * Values to boost (for value boost type)
     *
     * @param mixed $values
     *
     * @return self
     */
    public function setValues($values): self
    {
        $this->initialized['values'] = true;
        $this->values = $values;
        return $this;
    }
    /**
     * Center point for proximity calculation (for proximity boost type)
     *
     * @return mixed
     */
    public function getCenter()
    {
        return $this->center;
    }
    /**
     * Center point for proximity calculation (for proximity boost type)
     *
     * @param mixed $center
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
     * Function to apply (for proximity and functional boost types)
     *
     * @return mixed
     */
    public function getFunction()
    {
        return $this->function;
    }
    /**
     * Function to apply (for proximity and functional boost types)
     *
     * @param mixed $function
     *
     * @return self
     */
    public function setFunction($function): self
    {
        $this->initialized['function'] = true;
        $this->function = $function;
        return $this;
    }
    /**
     * How to combine function result with score (for functional boost type)
     *
     * @return string|null
     */
    public function getOperation(): ?string
    {
        return $this->operation;
    }
    /**
     * How to combine function result with score (for functional boost type)
     *
     * @param string|null $operation
     *
     * @return self
     */
    public function setOperation(?string $operation): self
    {
        $this->initialized['operation'] = true;
        $this->operation = $operation;
        return $this;
    }
}