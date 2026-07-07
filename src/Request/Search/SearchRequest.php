<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client\Request\Search;

use JsonSerializable;
use Silverstripe\Search\Client\Model\Pagination;
use Silverstripe\Search\Client\Model\Search\Filters;
use Silverstripe\Search\Client\Model\Search\Geolocation;
use Silverstripe\Search\Client\Model\Field\Boost;
use Silverstripe\Search\Client\Model\Search\FacetRange;
use Silverstripe\Search\Client\Model\Search\FacetValue;
use Silverstripe\Search\Client\Model\Field\ResultField;
use Silverstripe\Search\Client\Model\Field\SearchFieldWeight;
use Silverstripe\Search\Client\Model\Search\Tags;
use stdClass;

class SearchRequest implements JsonSerializable
{

    /**
     * Array of sort objects, EG: [["_score" => "desc"], ["title" => "asc"]]
     *
     * @var array<int, array<string, string|Geolocation>>|null
     */
    private ?array $sorts = null;

    private ?Pagination $page = null;

    /**
     * @var array<string, SearchFieldWeight>|null
     */
    private ?array $searchFields = null;

    /**
     * @var array<string, ResultField>|null
     */
    private ?array $resultFields = null;

    /**
     * @var array<string, array<int, FacetValue|FacetRange>>|null
     */
    private ?array $facets = null;

    private ?Filters $filters = null;

    /**
     * @var array<string, array<int, Boost>>|null
     */
    private ?array $boosts = null;

    private ?Tags $analytics = null;

    private bool $recordAnalytics = true;

    /**
     * Override the engine precision for this request only. Valid values are 1 - 11 (inclusive). When null, the engine's
     * configured precision (set in the dashboard) is used.
     */
    private ?int $precision = null;

    public function __construct(private readonly string $query)
    {
    }

    public function getQuery(): string
    {
        return $this->query;
    }

    /**
     * @return array<int, array<string, string|Geolocation>>|null
     */
    public function getSorts(): ?array
    {
        return $this->sorts;
    }

    public function addSort(string $fieldName, string|Geolocation $direction): static
    {
        $this->sorts ??= [];
        $this->sorts[] = [$fieldName => $direction];

        return $this;
    }

    /**
     * @param array<int, array<string, string|Geolocation>>|null $sorts
     */
    public function setSorts(?array $sorts): static
    {
        if ($sorts === null) {
            $this->sorts = null;

            return $this;
        }

        $this->sorts = [];

        foreach ($sorts as $sortItem) {
            foreach ($sortItem as $fieldName => $direction) {
                $this->addSort($fieldName, $direction);
            }
        }

        return $this;
    }

    public function getPage(): ?Pagination
    {
        return $this->page;
    }

    public function setPage(?Pagination $page): static
    {
        $this->page = $page;

        return $this;
    }

    /**
     * @return array<string, SearchFieldWeight>|null
     */
    public function getSearchFields(): ?array
    {
        return $this->searchFields;
    }

    public function addSearchField(string $fieldName, SearchFieldWeight $weight): static
    {
        $this->searchFields ??= [];
        $this->searchFields[$fieldName] = $weight;

        return $this;
    }

    /**
     * @param array<string, SearchFieldWeight>|null $searchFields
     */
    public function setSearchFields(?array $searchFields): static
    {
        if ($searchFields === null) {
            $this->searchFields = null;

            return $this;
        }

        $this->searchFields = [];

        foreach ($searchFields as $fieldName => $weight) {
            $this->addSearchField($fieldName, $weight);
        }

        return $this;
    }

    /**
     * @return array<string, ResultField>|null
     */
    public function getResultFields(): ?array
    {
        return $this->resultFields;
    }

    public function addResultField(string $fieldName, ResultField $resultField): static
    {
        $this->resultFields ??= [];
        $this->resultFields[$fieldName] = $resultField;

        return $this;
    }

    /**
     * @param array<string, ResultField>|null $resultFields
     */
    public function setResultFields(?array $resultFields): static
    {
        if ($resultFields === null) {
            $this->resultFields = null;

            return $this;
        }

        $this->resultFields = [];

        foreach ($resultFields as $fieldName => $resultField) {
            $this->addResultField($fieldName, $resultField);
        }

        return $this;
    }

    /**
     * @return array<string, array<int, FacetValue|FacetRange>>|null
     */
    public function getFacets(): ?array
    {
        return $this->facets;
    }

    public function addFacet(string $fieldName, FacetValue|FacetRange $facet): static
    {
        $this->facets ??= [];
        $this->facets[$fieldName] ??= [];
        $this->facets[$fieldName][] = $facet;

        return $this;
    }

    /**
     * @param array<string, array<int, FacetValue|FacetRange>>|null $facets
     */
    public function setFacets(?array $facets): static
    {
        if ($facets === null) {
            $this->facets = null;

            return $this;
        }

        $this->facets = [];

        foreach ($facets as $fieldName => $fieldFacets) {
            foreach ($fieldFacets as $facet) {
                $this->addFacet($fieldName, $facet);
            }
        }

        return $this;
    }

    public function getFilters(): ?Filters
    {
        return $this->filters;
    }

    public function setFilters(?Filters $filters): static
    {
        $this->filters = $filters;

        return $this;
    }

    /**
     * @return array<string, array<int, Boost>>|null
     */
    public function getBoosts(): ?array
    {
        return $this->boosts;
    }

    public function addBoost(string $fieldName, Boost $boost): static
    {
        $this->boosts ??= [];
        $this->boosts[$fieldName] ??= [];
        $this->boosts[$fieldName][] = $boost;

        return $this;
    }

    /**
     * @param array<string, array<int, Boost>>|null $boosts
     */
    public function setBoosts(?array $boosts): static
    {
        if ($boosts === null) {
            $this->boosts = null;

            return $this;
        }

        $this->boosts = [];

        foreach ($boosts as $fieldName => $fieldBoosts) {
            foreach ($fieldBoosts as $boost) {
                $this->addBoost($fieldName, $boost);
            }
        }

        return $this;
    }

    public function getAnalytics(): ?Tags
    {
        return $this->analytics;
    }

    public function setAnalytics(?Tags $analytics): static
    {
        $this->analytics = $analytics;

        return $this;
    }

    public function getRecordAnalytics(): bool
    {
        return $this->recordAnalytics;
    }

    public function setRecordAnalytics(bool $recordAnalytics): static
    {
        $this->recordAnalytics = $recordAnalytics;

        return $this;
    }

    public function getPrecision(): ?int
    {
        return $this->precision;
    }

    public function setPrecision(?int $precision): static
    {
        $this->precision = $precision;

        return $this;
    }

    public function jsonSerialize(): array
    {
        $payload = [
            'query' => $this->query,
        ];

        if ($this->sorts !== null) {
            $payload['sort'] = $this->sorts;
        }

        if ($this->page !== null) {
            $payload['page'] = $this->page;
        }

        if ($this->searchFields !== null) {
            $payload['search_fields'] = $this->searchFields !== []
                ? $this->searchFields
                : new stdClass();
        }

        if ($this->resultFields !== null) {
            $payload['result_fields'] = $this->resultFields !== []
                ? $this->resultFields
                : new stdClass();
        }

        if ($this->facets !== null) {
            $payload['facets'] = $this->facets !== []
                ? $this->facets
                : new stdClass();
        }

        if ($this->filters !== null) {
            $payload['filters'] = $this->filters;
        }

        if ($this->boosts !== null) {
            $payload['boosts'] = $this->boosts !== []
                ? $this->boosts
                : new stdClass();
        }

        if ($this->analytics !== null) {
            $payload['analytics'] = $this->analytics;
        }

        if ($this->precision !== null) {
            $payload['precision'] = $this->precision;
        }

        $payload['record_analytics'] = $this->recordAnalytics;

        return $payload;
    }

}
