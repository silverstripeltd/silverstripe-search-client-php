<?php

namespace Silverstripe\Search\Client\Model;

class BoostPatchRequest
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
    protected $impact;
    /**
     * @var mixed|null
     */
    protected $values;
    /**
     * @var mixed|null
     */
    protected $center;
    /**
     * @var mixed|null
     */
    protected $function;
    /**
     * @var string|null
     */
    protected $operation;
    /**
     * @return mixed
     */
    public function getImpact()
    {
        return $this->impact;
    }
    /**
     * @param mixed $impact
     *
     * @return self
     */
    public function setImpact($impact): self
    {
        $this->initialized['impact'] = true;
        $this->impact = $impact;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getValues()
    {
        return $this->values;
    }
    /**
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
     * @return mixed
     */
    public function getCenter()
    {
        return $this->center;
    }
    /**
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
     * @return mixed
     */
    public function getFunction()
    {
        return $this->function;
    }
    /**
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
     * @return string|null
     */
    public function getOperation(): ?string
    {
        return $this->operation;
    }
    /**
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