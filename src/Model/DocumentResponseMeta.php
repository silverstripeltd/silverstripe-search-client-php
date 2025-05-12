<?php

namespace Silverstripe\Search\Client\Model;

class DocumentResponseMeta extends \ArrayObject
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
    protected $score;
    /**
     * 
     *
     * @var mixed
     */
    protected $engine;
    /**
     * 
     *
     * @var mixed
     */
    protected $id;
    /**
     * 
     *
     * @return mixed
     */
    public function getScore()
    {
        return $this->score;
    }
    /**
     * 
     *
     * @param mixed $score
     *
     * @return self
     */
    public function setScore($score): self
    {
        $this->initialized['score'] = true;
        $this->score = $score;
        return $this;
    }
    /**
     * 
     *
     * @return mixed
     */
    public function getEngine()
    {
        return $this->engine;
    }
    /**
     * 
     *
     * @param mixed $engine
     *
     * @return self
     */
    public function setEngine($engine): self
    {
        $this->initialized['engine'] = true;
        $this->engine = $engine;
        return $this;
    }
    /**
     * 
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * 
     *
     * @param mixed $id
     *
     * @return self
     */
    public function setId($id): self
    {
        $this->initialized['id'] = true;
        $this->id = $id;
        return $this;
    }
}