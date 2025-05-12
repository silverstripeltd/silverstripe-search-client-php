<?php

namespace Silverstripe\Search\Client\Model;

class PaginationWithTotals extends \ArrayObject
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
     * Number representing the current page of results.
     *
     * @var int
     */
    protected $current;
    /**
     * Number representing the results per page.
     *
     * @var int
     */
    protected $size;
    /**
    * Number representing the total pages of results.
           Value is 0 when you paginate beyond 10,000 results.
    *
    * @var int
    */
    protected $totalPages;
    /**
    * Number representing the total results across all pages.
           The values 0 through 9999 are exact counts.
           The value 10000 is a pseudo keyword representing greater than or equal to 10,000 results.
    *
    * @var int
    */
    protected $totalResults;
    /**
     * Number representing the current page of results.
     *
     * @return int
     */
    public function getCurrent(): int
    {
        return $this->current;
    }
    /**
     * Number representing the current page of results.
     *
     * @param int $current
     *
     * @return self
     */
    public function setCurrent(int $current): self
    {
        $this->initialized['current'] = true;
        $this->current = $current;
        return $this;
    }
    /**
     * Number representing the results per page.
     *
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }
    /**
     * Number representing the results per page.
     *
     * @param int $size
     *
     * @return self
     */
    public function setSize(int $size): self
    {
        $this->initialized['size'] = true;
        $this->size = $size;
        return $this;
    }
    /**
    * Number representing the total pages of results.
           Value is 0 when you paginate beyond 10,000 results.
    *
    * @return int
    */
    public function getTotalPages(): int
    {
        return $this->totalPages;
    }
    /**
    * Number representing the total pages of results.
           Value is 0 when you paginate beyond 10,000 results.
    *
    * @param int $totalPages
    *
    * @return self
    */
    public function setTotalPages(int $totalPages): self
    {
        $this->initialized['totalPages'] = true;
        $this->totalPages = $totalPages;
        return $this;
    }
    /**
    * Number representing the total results across all pages.
           The values 0 through 9999 are exact counts.
           The value 10000 is a pseudo keyword representing greater than or equal to 10,000 results.
    *
    * @return int
    */
    public function getTotalResults(): int
    {
        return $this->totalResults;
    }
    /**
    * Number representing the total results across all pages.
           The values 0 through 9999 are exact counts.
           The value 10000 is a pseudo keyword representing greater than or equal to 10,000 results.
    *
    * @param int $totalResults
    *
    * @return self
    */
    public function setTotalResults(int $totalResults): self
    {
        $this->initialized['totalResults'] = true;
        $this->totalResults = $totalResults;
        return $this;
    }
}