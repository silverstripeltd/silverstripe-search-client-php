<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client\Tests\Model\Search;

use PHPUnit\Framework\TestCase;
use Silverstripe\Search\Client\Model\Coordinate;
use Silverstripe\Search\Client\Model\Search\Geolocation;

class GeolocationTest extends TestCase
{

    public function testConstruction(): void
    {
        $center = new Coordinate(-41.2865, 174.7762);
        $geolocation = new Geolocation($center, 'asc');

        $this->assertSame($center, $geolocation->getCenter());
        $this->assertSame('asc', $geolocation->getOrder());
    }

    public function testJsonSerialize(): void
    {
        $geolocation = new Geolocation(new Coordinate(-41.2865, 174.7762), 'desc');

        $result = json_decode(json_encode($geolocation), true);

        $this->assertSame(-41.2865, $result['center']['latitude']);
        $this->assertSame(174.7762, $result['center']['longitude']);
        $this->assertSame('desc', $result['order']);
    }

}
