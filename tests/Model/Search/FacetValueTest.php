<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client\Tests\Model\Search;

use PHPUnit\Framework\TestCase;
use Silverstripe\Search\Client\Model\Search\FacetValue;

class FacetValueTest extends TestCase
{

    public function testDefaults(): void
    {
        $facet = new FacetValue();

        $this->assertSame('value', $facet->getType());
        $this->assertSame(10, $facet->getSize());
        $this->assertNull($facet->getName());
        $this->assertNull($facet->getSort());
    }

    public function testJsonSerializeDefaults(): void
    {
        $facet = new FacetValue();

        $this->assertSame(
            ['type' => 'value', 'size' => 10],
            $facet->jsonSerialize(),
        );
    }

    public function testJsonSerializeFull(): void
    {
        $facet = new FacetValue();
        $facet->setName('category_facet');
        $facet->setSize(20);
        $facet->setSort(['count' => 'desc']);

        $this->assertSame(
            [
                'type' => 'value',
                'size' => 20,
                'name' => 'category_facet',
                'sort' => ['count' => 'desc'],
            ],
            $facet->jsonSerialize(),
        );
    }

    public function testFluentSetters(): void
    {
        $facet = new FacetValue();

        $this->assertSame($facet, $facet->setName('test'));
        $this->assertSame($facet, $facet->setSize(5));
        $this->assertSame($facet, $facet->setSort(['value' => 'asc']));
    }

}
