<?php

namespace Silverstripe\Search\Client\Model;

class SearchResponseMeta extends \ArrayObject
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
    protected $warnings;
    /**
     * 
     *
     * @var mixed
     */
    protected $precision;
    /**
     * 
     *
     * @var SearchResponseEngine|null
     */
    protected $engine;
    /**
     * 
     *
     * @var mixed
     */
    protected $requestId;
    /**
     * 
     *
     * @var PaginationWithTotals
     */
    protected $page;
    /**
     * 
     *
     * @return mixed
     */
    public function getWarnings()
    {
        return $this->warnings;
    }
    /**
     * 
     *
     * @param mixed $warnings
     *
     * @return self
     */
    public function setWarnings($warnings): self
    {
        $this->initialized['warnings'] = true;
        $this->warnings = $warnings;
        return $this;
    }
    /**
     * 
     *
     * @return mixed
     */
    public function getPrecision()
    {
        return $this->precision;
    }
    /**
     * 
     *
     * @param mixed $precision
     *
     * @return self
     */
    public function setPrecision($precision): self
    {
        $this->initialized['precision'] = true;
        $this->precision = $precision;
        return $this;
    }
    /**
     * 
     *
     * @return SearchResponseEngine|null
     */
    public function getEngine(): SearchResponseEngine
    {
        return $this->engine;
    }
    /**
     * 
     *
     * @param SearchResponseEngine|null $engine
     *
     * @return self
     */
    public function setEngine(SearchResponseEngine $engine): self
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
    public function getRequestId()
    {
        return $this->requestId;
    }
    /**
     * 
     *
     * @param mixed $requestId
     *
     * @return self
     */
    public function setRequestId($requestId): self
    {
        $this->initialized['requestId'] = true;
        $this->requestId = $requestId;
        return $this;
    }
    /**
     * 
     *
     * @return PaginationWithTotals
     */
    public function getPage(): PaginationWithTotals
    {
        return $this->page;
    }
    /**
     * 
     *
     * @param PaginationWithTotals $page
     *
     * @return self
     */
    public function setPage(PaginationWithTotals $page): self
    {
        $this->initialized['page'] = true;
        $this->page = $page;
        return $this;
    }
}