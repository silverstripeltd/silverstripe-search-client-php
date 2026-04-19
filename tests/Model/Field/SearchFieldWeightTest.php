<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client\Tests\Model\Field;

use PHPUnit\Framework\TestCase;
use Silverstripe\Search\Client\Model\Field\SearchFieldWeight;
use stdClass;

class SearchFieldWeightTest extends TestCase
{

    public function testDefaultSerializesToEmptyObject(): void
    {
        $weight = new SearchFieldWeight();

        $this->assertNull($weight->getWeight());
        $this->assertInstanceOf(stdClass::class, $weight->jsonSerialize());
        $this->assertSame('{}', json_encode($weight));
    }

    public function testWithIntWeight(): void
    {
        $weight = new SearchFieldWeight(5);

        $this->assertSame(5, $weight->getWeight());
        $this->assertSame(['weight' => 5], $weight->jsonSerialize());
    }

    public function testWithFloatWeight(): void
    {
        $weight = new SearchFieldWeight(2.5);

        $this->assertSame(2.5, $weight->getWeight());
        $this->assertSame(['weight' => 2.5], $weight->jsonSerialize());
    }

}
