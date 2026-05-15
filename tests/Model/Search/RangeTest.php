<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client\Tests\Model\Search;

use PHPUnit\Framework\TestCase;
use Silverstripe\Search\Client\Model\Search\Range;

class RangeTest extends TestCase
{

    public function testDefaults(): void
    {
        $range = new Range();

        $this->assertNull($range->getFrom());
        $this->assertNull($range->getTo());
        $this->assertSame([], $range->jsonSerialize());
    }

    public function testWithFrom(): void
    {
        $range = new Range(10);

        $this->assertSame(['from' => 10], $range->jsonSerialize());
    }

    public function testWithTo(): void
    {
        $range = new Range(null, 100);

        $this->assertSame(['to' => 100], $range->jsonSerialize());
    }

    public function testWithBoth(): void
    {
        $range = new Range(10, 100);

        $this->assertSame(
            ['from' => 10, 'to' => 100],
            $range->jsonSerialize(),
        );
    }

    public function testWithStringValues(): void
    {
        $range = new Range('2024-01-01', '2024-12-31');

        $this->assertSame(
            ['from' => '2024-01-01', 'to' => '2024-12-31'],
            $range->jsonSerialize(),
        );
    }

}
