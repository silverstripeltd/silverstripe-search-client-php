<?php

namespace Silverstripe\Search\Client\Model;

class SearchRequestResultFieldSnippet extends \ArrayObject
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
    * Character length of the snippet returned (to the nearest word). Must be at least 20; defaults to 
           100.
    *
    * @var mixed
    */
    protected $size = 100;
    /**
     * If true, return the raw text field as the snippet (if no snippet is found). Defaults to true.
     *
     * @var mixed
     */
    protected $fallback = true;
    /**
    * Character length of the snippet returned (to the nearest word). Must be at least 20; defaults to 
           100.
    *
    * @return mixed
    */
    public function getSize()
    {
        return $this->size;
    }
    /**
    * Character length of the snippet returned (to the nearest word). Must be at least 20; defaults to 
           100.
    *
    * @param mixed $size
    *
    * @return self
    */
    public function setSize($size): self
    {
        $this->initialized['size'] = true;
        $this->size = $size;
        return $this;
    }
    /**
     * If true, return the raw text field as the snippet (if no snippet is found). Defaults to true.
     *
     * @return mixed
     */
    public function getFallback()
    {
        return $this->fallback;
    }
    /**
     * If true, return the raw text field as the snippet (if no snippet is found). Defaults to true.
     *
     * @param mixed $fallback
     *
     * @return self
     */
    public function setFallback($fallback): self
    {
        $this->initialized['fallback'] = true;
        $this->fallback = $fallback;
        return $this;
    }
}