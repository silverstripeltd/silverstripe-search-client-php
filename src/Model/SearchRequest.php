<?php

namespace Silverstripe\Search\Client\Model;

class SearchRequest
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
     * @var string
     */
    protected $query;
    /**
     * 
     *
     * @var null
     */
    protected $sort;
    /**
     * 
     *
     * @var PaginationNoTotals|null
     */
    protected $page;
    /**
     * 
     *
     * @var null
     */
    protected $searchFields;
    /**
     * 
     *
     * @var array<string, SearchRequestResultField>|null
     */
    protected $resultFields;
    /**
     * 
     *
     * @var array<string, list<mixed>>|null
     */
    protected $facets;
    /**
     * 
     *
     * @var Filters|null
     */
    protected $filters;
    /**
     * 
     *
     * @var Tags|null
     */
    protected $analytics;
    /**
     * 
     *
     * @return string
     */
    public function getQuery(): string
    {
        return $this->query;
    }
    /**
     * 
     *
     * @param string $query
     *
     * @return self
     */
    public function setQuery(string $query): self
    {
        $this->initialized['query'] = true;
        $this->query = $query;
        return $this;
    }
    /**
     * 
     *
     * @return null
     */
    public function getSort()
    {
        return $this->sort;
    }
    /**
     * 
     *
     * @param null $sort
     *
     * @return self
     */
    public function setSort($sort): self
    {
        $this->initialized['sort'] = true;
        $this->sort = $sort;
        return $this;
    }
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
    /**
     * 
     *
     * @return null
     */
    public function getSearchFields()
    {
        return $this->searchFields;
    }
    /**
     * 
     *
     * @param null $searchFields
     *
     * @return self
     */
    public function setSearchFields($searchFields): self
    {
        $this->initialized['searchFields'] = true;
        $this->searchFields = $searchFields;
        return $this;
    }
    /**
     * 
     *
     * @return array<string, SearchRequestResultField>|null
     */
    public function getResultFields(): iterable
    {
        return $this->resultFields;
    }
    /**
     * 
     *
     * @param array<string, SearchRequestResultField>|null $resultFields
     *
     * @return self
     */
    public function setResultFields(iterable $resultFields): self
    {
        $this->initialized['resultFields'] = true;
        $this->resultFields = $resultFields;
        return $this;
    }
    /**
     * 
     *
     * @return array<string, list<mixed>>|null
     */
    public function getFacets(): iterable
    {
        return $this->facets;
    }
    /**
     * 
     *
     * @param array<string, list<mixed>>|null $facets
     *
     * @return self
     */
    public function setFacets(iterable $facets): self
    {
        $this->initialized['facets'] = true;
        $this->facets = $facets;
        return $this;
    }
    /**
     * 
     *
     * @return Filters|null
     */
    public function getFilters(): Filters
    {
        return $this->filters;
    }
    /**
     * 
     *
     * @param Filters|null $filters
     *
     * @return self
     */
    public function setFilters(Filters $filters): self
    {
        $this->initialized['filters'] = true;
        $this->filters = $filters;
        return $this;
    }
    /**
     * 
     *
     * @return Tags|null
     */
    public function getAnalytics(): Tags
    {
        return $this->analytics;
    }
    /**
     * 
     *
     * @param Tags|null $analytics
     *
     * @return self
     */
    public function setAnalytics(Tags $analytics): self
    {
        $this->initialized['analytics'] = true;
        $this->analytics = $analytics;
        return $this;
    }
}