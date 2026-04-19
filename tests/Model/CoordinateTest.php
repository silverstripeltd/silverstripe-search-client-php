<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client\Tests\Model;

use PHPUnit\Framework\TestCase;
use Silverstripe\Search\Client\Model\Coordinate;

class CoordinateTest extends TestCase
{

    public function testWithFloats(): void
    {
        $coordinate = new Coordinate(-41.2865, 174.7762);

        $this->assertSame(-41.2865, $coordinate->getLatitude());
        $this->assertSame(174.7762, $coordinate->getLongitude());
    }

    public function testWithStrings(): void
    {
        $coordinate = new Coordinate('-41.2865', '174.7762');

        $this->assertSame('-41.2865', $coordinate->getLatitude());
        $this->assertSame('174.7762', $coordinate->getLongitude());
    }

    public function testJsonSerialize(): void
    {
        $coordinate = new Coordinate(-41.2865, 174.7762);

        $this->assertSame(
            ['latitude' => -41.2865, 'longitude' => 174.7762],
            $coordinate->jsonSerialize(),
        );
    }

}
