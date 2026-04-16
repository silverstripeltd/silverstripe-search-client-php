<?php

namespace Silverstripe\Search\Client\Model;

class CommonModelsCurationPostRequestPostRequest
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
    protected $name;
    /**
     * @var mixed|null
     */
    protected $queries;
    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * @param mixed $name
     *
     * @return self
     */
    public function setName($name): self
    {
        $this->initialized['name'] = true;
        $this->name = $name;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getQueries()
    {
        return $this->queries;
    }
    /**
     * @param mixed $queries
     *
     * @return self
     */
    public function setQueries($queries): self
    {
        $this->initialized['queries'] = true;
        $this->queries = $queries;
        return $this;
    }
}