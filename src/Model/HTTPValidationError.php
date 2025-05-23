<?php

namespace Silverstripe\Search\Client\Model;

class HTTPValidationError extends \ArrayObject
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
     * @var list<ValidationError>
     */
    protected $detail;
    /**
     * 
     *
     * @return list<ValidationError>
     */
    public function getDetail(): array
    {
        return $this->detail;
    }
    /**
     * 
     *
     * @param list<ValidationError> $detail
     *
     * @return self
     */
    public function setDetail(array $detail): self
    {
        $this->initialized['detail'] = true;
        $this->detail = $detail;
        return $this;
    }
}