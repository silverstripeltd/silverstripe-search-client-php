<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client\Tests\Model\Field;

use PHPUnit\Framework\TestCase;
use Silverstripe\Search\Client\Model\Field\ResultFieldSnippet;
use stdClass;

class ResultFieldSnippetTest extends TestCase
{

    public function testDefaultSerializesToEmptyObject(): void
    {
        $snippet = new ResultFieldSnippet();

        $this->assertNull($snippet->getSize());
        $this->assertNull($snippet->getFallback());
        $this->assertInstanceOf(stdClass::class, $snippet->jsonSerialize());
        $this->assertSame('{}', json_encode($snippet));
    }

    public function testWithSize(): void
    {
        $snippet = new ResultFieldSnippet(100);

        $this->assertSame(['size' => 100], $snippet->jsonSerialize());
    }

    public function testWithFallback(): void
    {
        $snippet = new ResultFieldSnippet(null, true);

        $this->assertSame(['fallback' => true], $snippet->jsonSerialize());
    }

    public function testWithBothProperties(): void
    {
        $snippet = new ResultFieldSnippet(150, false);

        $this->assertSame(
            ['size' => 150, 'fallback' => false],
            $snippet->jsonSerialize(),
        );
    }

}
