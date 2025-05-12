<?php

namespace Silverstripe\Search\Client\Model;

class DocumentField extends \ArrayObject
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
    protected $raw;
    /**
     * 
     *
     * @var mixed
     */
    protected $snippet;
    /**
     * 
     *
     * @return mixed
     */
    public function getRaw()
    {
        return $this->raw;
    }
    /**
     * 
     *
     * @param mixed $raw
     *
     * @return self
     */
    public function setRaw($raw): self
    {
        $this->initialized['raw'] = true;
        $this->raw = $raw;
        return $this;
    }
    /**
     * 
     *
     * @return mixed
     */
    public function getSnippet()
    {
        return $this->snippet;
    }
    /**
     * 
     *
     * @param mixed $snippet
     *
     * @return self
     */
    public function setSnippet($snippet): self
    {
        $this->initialized['snippet'] = true;
        $this->snippet = $snippet;
        return $this;
    }
}