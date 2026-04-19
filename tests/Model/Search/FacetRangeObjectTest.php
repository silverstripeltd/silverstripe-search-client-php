<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client\Tests\Model\Search;

use PHPUnit\Framework\TestCase;
use Silverstripe\Search\Client\Model\Search\FacetRangeObject;

class FacetRangeObjectTest extends TestCase
{

    public function testDefaults(): void
    {
        $range = new FacetRangeObject();

        $this->assertNull($range->getFrom());
        $this->assertNull($range->getTo());
        $this->assertNull($range->getName());
        $this->assertSame([], $range->jsonSerialize());
    }

    public function testWithFrom(): void
    {
        $range = new FacetRangeObject(from: 10);

        $this->assertSame(['from' => 10], $range->jsonSerialize());
    }

    public function testWithTo(): void
    {
        $range = new FacetRangeObject(to: 100);

        $this->assertSame(['to' => 100], $range->jsonSerialize());
    }

    public function testWithName(): void
    {
        $range = new FacetRangeObject(name: 'cheap');

        $this->assertSame(['name' => 'cheap'], $range->jsonSerialize());
    }

    public function testFull(): void
    {
        $range = new FacetRangeObject(0, 50, 'low');

        $this->assertSame(
            ['from' => 0, 'to' => 50, 'name' => 'low'],
            $range->jsonSerialize(),
        );
    }

}
