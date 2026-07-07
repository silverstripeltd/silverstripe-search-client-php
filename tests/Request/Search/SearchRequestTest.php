<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client\Tests\Request\Search;

use PHPUnit\Framework\TestCase;
use Silverstripe\Search\Client\Model\Field\Boost;
use Silverstripe\Search\Client\Model\Pagination;
use Silverstripe\Search\Client\Model\Search\FacetRange;
use Silverstripe\Search\Client\Model\Search\FacetRangeObject;
use Silverstripe\Search\Client\Model\Search\FacetValue;
use Silverstripe\Search\Client\Model\Search\Filters;
use Silverstripe\Search\Client\Model\Search\Geolocation;
use Silverstripe\Search\Client\Model\Coordinate;
use Silverstripe\Search\Client\Model\Field\ResultField;
use Silverstripe\Search\Client\Model\Field\ResultFieldRaw;
use Silverstripe\Search\Client\Model\Field\ResultFieldSnippet;
use Silverstripe\Search\Client\Model\Field\SearchFieldWeight;
use Silverstripe\Search\Client\Model\Search\Tags;
use Silverstripe\Search\Client\Request\Search\SearchRequest;
use stdClass;

class SearchRequestTest extends TestCase
{

    public function testMinimalPayload(): void
    {
        $request = new SearchRequest('test query');

        $result = $request->jsonSerialize();

        $this->assertSame('test query', $result['query']);
        $this->assertTrue($result['record_analytics']);
        // Only query and record_analytics should be present
        $this->assertCount(2, $result);
    }

    public function testGetQuery(): void
    {
        $request = new SearchRequest('hello world');

        $this->assertSame('hello world', $request->getQuery());
    }

    // Sort tests

    public function testAddSort(): void
    {
        $request = new SearchRequest('test');
        $request->addSort('_score', 'desc');
        $request->addSort('title', 'asc');

        $sorts = $request->getSorts();

        $this->assertCount(2, $sorts);
        $this->assertSame(['_score' => 'desc'], $sorts[0]);
        $this->assertSame(['title' => 'asc'], $sorts[1]);
    }

    public function testAddSortWithGeolocation(): void
    {
        $request = new SearchRequest('test');
        $geolocation = new Geolocation(new Coordinate(-41.2865, 174.7762), 'asc');
        $request->addSort('location', $geolocation);

        $result = json_decode(json_encode($request), true);

        $this->assertSame(-41.2865, $result['sort'][0]['location']['center']['latitude']);
    }

    public function testSetSortsNull(): void
    {
        $request = new SearchRequest('test');
        $request->addSort('title', 'asc');
        $request->setSorts(null);

        $this->assertNull($request->getSorts());
    }

    public function testSetSortsDelegatesToAddSort(): void
    {
        $request = new SearchRequest('test');
        $request->setSorts([['_score' => 'desc'], ['title' => 'asc']]);

        $sorts = $request->getSorts();

        $this->assertCount(2, $sorts);
        $this->assertSame(['_score' => 'desc'], $sorts[0]);
    }

    public function testSortInPayload(): void
    {
        $request = new SearchRequest('test');
        $request->addSort('_score', 'desc');

        $result = $request->jsonSerialize();

        $this->assertArrayHasKey('sort', $result);
    }

    // Pagination tests

    public function testSetPage(): void
    {
        $request = new SearchRequest('test');
        $request->setPage(new Pagination(3, 25));

        $result = json_decode(json_encode($request), true);

        $this->assertSame(3, $result['page']['current']);
        $this->assertSame(25, $result['page']['size']);
    }

    // Search fields tests

    public function testAddSearchField(): void
    {
        $request = new SearchRequest('test');
        $request->addSearchField('title', new SearchFieldWeight(5));
        $request->addSearchField('body', new SearchFieldWeight());

        $fields = $request->getSearchFields();

        $this->assertCount(2, $fields);
        $this->assertInstanceOf(SearchFieldWeight::class, $fields['title']);
        $this->assertInstanceOf(SearchFieldWeight::class, $fields['body']);
    }

    public function testSetSearchFieldsNull(): void
    {
        $request = new SearchRequest('test');
        $request->addSearchField('title', new SearchFieldWeight());
        $request->setSearchFields(null);

        $this->assertNull($request->getSearchFields());
    }

    public function testSetSearchFieldsDelegatesToAddSearchField(): void
    {
        $request = new SearchRequest('test');
        $request->setSearchFields([
            'title' => new SearchFieldWeight(5),
            'body' => new SearchFieldWeight(),
        ]);

        $this->assertCount(2, $request->getSearchFields());
    }

    public function testSearchFieldsEmptySerializesToObject(): void
    {
        $request = new SearchRequest('test');
        $request->setSearchFields([]);

        $result = $request->jsonSerialize();

        $this->assertInstanceOf(stdClass::class, $result['search_fields']);
        $this->assertSame('{}', json_encode($result['search_fields']));
    }

    // Result fields tests

    public function testAddResultField(): void
    {
        $request = new SearchRequest('test');
        $field = (new ResultField())->setRaw(new ResultFieldRaw(200));
        $request->addResultField('title', $field);

        $this->assertCount(1, $request->getResultFields());
        $this->assertSame($field, $request->getResultFields()['title']);
    }

    public function testSetResultFieldsNull(): void
    {
        $request = new SearchRequest('test');
        $request->addResultField('title', new ResultField());
        $request->setResultFields(null);

        $this->assertNull($request->getResultFields());
    }

    public function testResultFieldsEmptySerializesToObject(): void
    {
        $request = new SearchRequest('test');
        $request->setResultFields([]);

        $result = $request->jsonSerialize();

        $this->assertInstanceOf(stdClass::class, $result['result_fields']);
    }

    // Facet tests

    public function testAddFacetValue(): void
    {
        $request = new SearchRequest('test');
        $request->addFacet('category', new FacetValue());

        $facets = $request->getFacets();

        $this->assertArrayHasKey('category', $facets);
        $this->assertCount(1, $facets['category']);
        $this->assertInstanceOf(FacetValue::class, $facets['category'][0]);
    }

    public function testAddFacetRange(): void
    {
        $request = new SearchRequest('test');
        $ranges = [new FacetRangeObject(0, 100, 'low')];
        $request->addFacet('price', new FacetRange($ranges));

        $facets = $request->getFacets();

        $this->assertInstanceOf(FacetRange::class, $facets['price'][0]);
    }

    public function testAddMultipleFacetsToSameField(): void
    {
        $request = new SearchRequest('test');
        $request->addFacet('price', new FacetValue());
        $request->addFacet('price', new FacetRange([]));

        $this->assertCount(2, $request->getFacets()['price']);
    }

    public function testSetFacetsNull(): void
    {
        $request = new SearchRequest('test');
        $request->addFacet('category', new FacetValue());
        $request->setFacets(null);

        $this->assertNull($request->getFacets());
    }

    public function testFacetsEmptySerializesToObject(): void
    {
        $request = new SearchRequest('test');
        $request->setFacets([]);

        $result = $request->jsonSerialize();

        $this->assertInstanceOf(stdClass::class, $result['facets']);
    }

    // Filters tests

    public function testSetFilters(): void
    {
        $filters = new Filters();
        $filters->setAll([['status' => 'published']]);

        $request = new SearchRequest('test');
        $request->setFilters($filters);

        $this->assertSame($filters, $request->getFilters());

        $result = json_decode(json_encode($request), true);

        $this->assertArrayHasKey('filters', $result);
        $this->assertSame([['status' => 'published']], $result['filters']['all']);
    }

    // Boosts tests

    public function testAddBoost(): void
    {
        $request = new SearchRequest('test');
        $boost = new Boost('value');
        $boost->setValue(['premium']);
        $request->addBoost('category', $boost);

        $boosts = $request->getBoosts();

        $this->assertArrayHasKey('category', $boosts);
        $this->assertCount(1, $boosts['category']);
        $this->assertSame($boost, $boosts['category'][0]);
    }

    public function testAddMultipleBoostsToSameField(): void
    {
        $request = new SearchRequest('test');
        $request->addBoost('title', new Boost('value'));
        $request->addBoost('title', new Boost('functional'));

        $this->assertCount(2, $request->getBoosts()['title']);
    }

    public function testSetBoostsNull(): void
    {
        $request = new SearchRequest('test');
        $request->addBoost('title', new Boost('value'));
        $request->setBoosts(null);

        $this->assertNull($request->getBoosts());
    }

    public function testBoostsEmptySerializesToObject(): void
    {
        $request = new SearchRequest('test');
        $request->setBoosts([]);

        $result = $request->jsonSerialize();

        $this->assertInstanceOf(stdClass::class, $result['boosts']);
    }

    // Analytics tests

    public function testSetAnalytics(): void
    {
        $request = new SearchRequest('test');
        $tags = new Tags(['tag-one']);
        $request->setAnalytics($tags);

        $this->assertSame($tags, $request->getAnalytics());

        $result = json_decode(json_encode($request), true);

        $this->assertSame(['tag-one'], $result['analytics']['tags']);
    }

    public function testRecordAnalyticsDefault(): void
    {
        $request = new SearchRequest('test');

        $this->assertTrue($request->getRecordAnalytics());
    }

    public function testSetRecordAnalytics(): void
    {
        $request = new SearchRequest('test');
        $request->setRecordAnalytics(false);

        $result = $request->jsonSerialize();

        $this->assertFalse($result['record_analytics']);
    }

    // Precision tests

    public function testPrecisionDefaultsToNull(): void
    {
        $request = new SearchRequest('test');

        $this->assertNull($request->getPrecision());
    }

    public function testPrecisionOmittedFromPayloadWhenNull(): void
    {
        $request = new SearchRequest('test');

        $this->assertArrayNotHasKey('precision', $request->jsonSerialize());
    }

    public function testSetPrecision(): void
    {
        $request = new SearchRequest('test');
        $request->setPrecision(10);

        $this->assertSame(10, $request->getPrecision());

        $result = $request->jsonSerialize();

        $this->assertSame(10, $result['precision']);
    }

    public function testSetPrecisionNull(): void
    {
        $request = new SearchRequest('test');
        $request->setPrecision(10);
        $request->setPrecision(null);

        $this->assertNull($request->getPrecision());
        $this->assertArrayNotHasKey('precision', $request->jsonSerialize());
    }

    // Full payload test

    public function testFullPayload(): void
    {
        $request = new SearchRequest('full test');
        $request->addSort('_score', 'desc');
        $request->setPage(new Pagination(1, 20));
        $request->addSearchField('title', new SearchFieldWeight(5));
        $request->addResultField('title', (new ResultField())->setRaw(new ResultFieldRaw()));
        $request->addFacet('category', new FacetValue());

        $filters = new Filters();
        $filters->setAll([['status' => 'published']]);
        $request->setFilters($filters);

        $boost = new Boost('value');
        $boost->setValue(['premium']);
        $request->addBoost('category', $boost);

        $request->setAnalytics(new Tags(['search-page']));
        $request->setRecordAnalytics(true);
        $request->setPrecision(7);

        $result = json_decode(json_encode($request), true);

        $this->assertSame('full test', $result['query']);
        $this->assertSame(7, $result['precision']);
        $this->assertArrayHasKey('sort', $result);
        $this->assertArrayHasKey('page', $result);
        $this->assertArrayHasKey('search_fields', $result);
        $this->assertArrayHasKey('result_fields', $result);
        $this->assertArrayHasKey('facets', $result);
        $this->assertArrayHasKey('filters', $result);
        $this->assertArrayHasKey('boosts', $result);
        $this->assertArrayHasKey('analytics', $result);
        $this->assertTrue($result['record_analytics']);
    }

    // Fluent setter tests

    public function testFluentSetters(): void
    {
        $request = new SearchRequest('test');

        $this->assertSame($request, $request->addSort('title', 'asc'));
        $this->assertSame($request, $request->setSorts(null));
        $this->assertSame($request, $request->setPage(null));
        $this->assertSame($request, $request->addSearchField('title', new SearchFieldWeight()));
        $this->assertSame($request, $request->setSearchFields(null));
        $this->assertSame($request, $request->addResultField('title', new ResultField()));
        $this->assertSame($request, $request->setResultFields(null));
        $this->assertSame($request, $request->addFacet('cat', new FacetValue()));
        $this->assertSame($request, $request->setFacets(null));
        $this->assertSame($request, $request->setFilters(null));
        $this->assertSame($request, $request->addBoost('title', new Boost('value')));
        $this->assertSame($request, $request->setBoosts(null));
        $this->assertSame($request, $request->setAnalytics(null));
        $this->assertSame($request, $request->setRecordAnalytics(true));
        $this->assertSame($request, $request->setPrecision(5));
        $this->assertSame($request, $request->setPrecision(null));
    }

}
