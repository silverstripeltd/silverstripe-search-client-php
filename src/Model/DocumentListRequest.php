<?php

namespace Silverstripe\Search\Client\Model;

class DocumentListRequest
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
     * @var DocumentListPagination|null
     */
    protected $page;
    /**
     * @return DocumentListPagination|null
     */
    public function getPage(): ?DocumentListPagination
    {
        return $this->page;
    }
    /**
     * @param DocumentListPagination|null $page
     *
     * @return self
     */
    public function setPage(?DocumentListPagination $page): self
    {
        $this->initialized['page'] = true;
        $this->page = $page;
        return $this;
    }
}