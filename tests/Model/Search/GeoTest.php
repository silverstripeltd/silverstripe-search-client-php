<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client\Tests\Model\Search;

use PHPUnit\Framework\TestCase;
use Silverstripe\Search\Client\Model\Coordinate;
use Silverstripe\Search\Client\Model\Search\Geo;

class GeoTest extends TestCase
{

    public function testMinimal(): void
    {
        $center = new Coordinate(-41.2865, 174.7762);
        $geo = new Geo($center, 'km');

        $this->assertSame($center, $geo->getCenter());
        $this->assertSame('km', $geo->getUnit());
        $this->assertNull($geo->getFrom());
        $this->assertNull($geo->getTo());
        $this->assertNull($geo->getDistance());
    }

    public function testJsonSerializeMinimal(): void
    {
        $geo = new Geo(new Coordinate(-41.2865, 174.7762), 'km');

        $result = json_decode(json_encode($geo), true);

        $this->assertSame(-41.2865, $result['center']['latitude']);
        $this->assertSame(174.7762, $result['center']['longitude']);
        $this->assertSame('km', $result['unit']);
        $this->assertArrayNotHasKey('from', $result);
        $this->assertArrayNotHasKey('to', $result);
        $this->assertArrayNotHasKey('distance', $result);
    }

    public function testJsonSerializeFull(): void
    {
        $geo = new Geo(new Coordinate(-41.2865, 174.7762), 'mi');
        $geo->setFrom(0);
        $geo->setTo(100);
        $geo->setDistance(50);

        $result = json_decode(json_encode($geo), true);

        $this->assertSame(0, $result['from']);
        $this->assertSame(100, $result['to']);
        $this->assertSame(50, $result['distance']);
    }

    public function testFluentSetters(): void
    {
        $geo = new Geo(new Coordinate(0, 0), 'km');

        $this->assertSame($geo, $geo->setFrom(1));
        $this->assertSame($geo, $geo->setTo(10));
        $this->assertSame($geo, $geo->setDistance(5));
    }

}
