<?php

namespace Silverstripe\Search\Client\Model;

class SearchRequestResultFieldRaw extends \ArrayObject
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
    * Length of the return value (to the nearest word). Can only be used on text fields. If given for 
           a field type other than text, it will be silently ignored. Defaults to the entire text field.
    *
    * @var mixed
    */
    protected $size;
    /**
    * Length of the return value (to the nearest word). Can only be used on text fields. If given for 
           a field type other than text, it will be silently ignored. Defaults to the entire text field.
    *
    * @return mixed
    */
    public function getSize()
    {
        return $this->size;
    }
    /**
    * Length of the return value (to the nearest word). Can only be used on text fields. If given for 
           a field type other than text, it will be silently ignored. Defaults to the entire text field.
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
}