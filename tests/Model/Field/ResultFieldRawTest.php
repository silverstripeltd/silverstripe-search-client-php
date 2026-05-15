<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client\Tests\Model\Field;

use PHPUnit\Framework\TestCase;
use Silverstripe\Search\Client\Model\Field\ResultFieldRaw;
use stdClass;

class ResultFieldRawTest extends TestCase
{

    public function testDefaultSerializesToEmptyObject(): void
    {
        $raw = new ResultFieldRaw();

        $this->assertNull($raw->getSize());
        $this->assertInstanceOf(stdClass::class, $raw->jsonSerialize());
        $this->assertSame('{}', json_encode($raw));
    }

    public function testWithSize(): void
    {
        $raw = new ResultFieldRaw(200);

        $this->assertSame(200, $raw->getSize());
        $this->assertSame(['size' => 200], $raw->jsonSerialize());
    }

}
