<?php

namespace Silverstripe\Search\Client\Model;

class DocumentListRequest extends \ArrayObject
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
     * @var PaginationNoTotals|null
     */
    protected $page;
    /**
     * 
     *
     * @return PaginationNoTotals|null
     */
    public function getPage(): PaginationNoTotals
    {
        return $this->page;
    }
    /**
     * 
     *
     * @param PaginationNoTotals|null $page
     *
     * @return self
     */
    public function setPage(PaginationNoTotals $page): self
    {
        $this->initialized['page'] = true;
        $this->page = $page;
        return $this;
    }
}