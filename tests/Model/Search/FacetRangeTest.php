<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client\Tests\Model\Search;

use PHPUnit\Framework\TestCase;
use Silverstripe\Search\Client\Model\Search\FacetRange;
use Silverstripe\Search\Client\Model\Search\FacetRangeObject;

class FacetRangeTest extends TestCase
{

    public function testDefaults(): void
    {
        $ranges = [new FacetRangeObject(0, 100, 'low')];
        $facet = new FacetRange($ranges);

        $this->assertSame('range', $facet->getType());
        $this->assertNull($facet->getName());
        $this->assertCount(1, $facet->getRanges());
    }

    public function testJsonSerializeMinimal(): void
    {
        $ranges = [new FacetRangeObject(0, 100)];
        $facet = new FacetRange($ranges);

        $result = json_decode(json_encode($facet), true);

        $this->assertSame('range', $result['type']);
        $this->assertCount(1, $result['ranges']);
        $this->assertSame(0, $result['ranges'][0]['from']);
        $this->assertSame(100, $result['ranges'][0]['to']);
        $this->assertArrayNotHasKey('name', $result);
    }

    public function testJsonSerializeWithName(): void
    {
        $ranges = [new FacetRangeObject(0, 50)];
        $facet = new FacetRange($ranges);
        $facet->setName('price_ranges');

        $result = json_decode(json_encode($facet), true);

        $this->assertSame('price_ranges', $result['name']);
    }

    public function testFluentSetters(): void
    {
        $facet = new FacetRange([]);

        $this->assertSame($facet, $facet->setName('test'));
    }

}
