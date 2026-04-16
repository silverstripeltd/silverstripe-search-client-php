<?php

namespace Silverstripe\Search\Client\Model;

class SearchRequestBoost
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
     * Values to boost on. Required for value boosts.
     *
     * @var mixed|null
     */
    protected $value;
    /**
     * Boost factor/impact (0-10). Defaults to 1.
     *
     * @var float
     */
    protected $factor = 1.0;
    /**
     * Center point for proximity boosts.
     *
     * @var mixed|null
     */
    protected $center;
    /**
     * Function for proximity (gaussian, exponential, linear) or functional (logarithmic, exponential, linear) boosts.
     *
     * @var mixed|null
     */
    protected $function;
    /**
     * How to combine function result with score (multiply, add). For functional boosts.
     *
     * @var string|null
     */
    protected $operation;
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
     * Values to boost on. Required for value boosts.
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
    /**
     * Values to boost on. Required for value boosts.
     *
     * @param mixed $value
     *
     * @return self
     */
    public function setValue($value): self
    {
        $this->initialized['value'] = true;
        $this->value = $value;
        return $this;
    }
    /**
     * Boost factor/impact (0-10). Defaults to 1.
     *
     * @return float
     */
    public function getFactor(): float
    {
        return $this->factor;
    }
    /**
     * Boost factor/impact (0-10). Defaults to 1.
     *
     * @param float $factor
     *
     * @return self
     */
    public function setFactor(float $factor): self
    {
        $this->initialized['factor'] = true;
        $this->factor = $factor;
        return $this;
    }
    /**
     * Center point for proximity boosts.
     *
     * @return mixed
     */
    public function getCenter()
    {
        return $this->center;
    }
    /**
     * Center point for proximity boosts.
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
     * Function for proximity (gaussian, exponential, linear) or functional (logarithmic, exponential, linear) boosts.
     *
     * @return mixed
     */
    public function getFunction()
    {
        return $this->function;
    }
    /**
     * Function for proximity (gaussian, exponential, linear) or functional (logarithmic, exponential, linear) boosts.
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
     * How to combine function result with score (multiply, add). For functional boosts.
     *
     * @return string|null
     */
    public function getOperation(): ?string
    {
        return $this->operation;
    }
    /**
     * How to combine function result with score (multiply, add). For functional boosts.
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