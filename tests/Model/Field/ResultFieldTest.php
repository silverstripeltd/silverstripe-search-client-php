<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client\Tests\Model\Field;

use PHPUnit\Framework\TestCase;
use Silverstripe\Search\Client\Model\Field\ResultField;
use Silverstripe\Search\Client\Model\Field\ResultFieldRaw;
use Silverstripe\Search\Client\Model\Field\ResultFieldSnippet;
use stdClass;

class ResultFieldTest extends TestCase
{

    public function testDefaultSerializesToEmptyObject(): void
    {
        $field = new ResultField();

        $this->assertNull($field->getRaw());
        $this->assertNull($field->getSnippet());
        $this->assertInstanceOf(stdClass::class, $field->jsonSerialize());
        $this->assertSame('{}', json_encode($field));
    }

    public function testWithRaw(): void
    {
        $field = new ResultField();
        $field->setRaw(new ResultFieldRaw(200));

        $this->assertSame(
            ['raw' => ['size' => 200]],
            json_decode(json_encode($field), true),
        );
    }

    public function testWithSnippet(): void
    {
        $field = new ResultField();
        $field->setSnippet(new ResultFieldSnippet(100, true));

        $this->assertSame(
            ['snippet' => ['size' => 100, 'fallback' => true]],
            json_decode(json_encode($field), true),
        );
    }

    public function testWithBoth(): void
    {
        $field = new ResultField();
        $field->setRaw(new ResultFieldRaw());
        $field->setSnippet(new ResultFieldSnippet(100));

        $result = json_decode(json_encode($field), true);

        $this->assertArrayHasKey('raw', $result);
        $this->assertArrayHasKey('snippet', $result);
    }

    public function testFluentSetters(): void
    {
        $field = new ResultField();

        $this->assertSame($field, $field->setRaw(new ResultFieldRaw()));
        $this->assertSame($field, $field->setSnippet(new ResultFieldSnippet()));
    }

}
