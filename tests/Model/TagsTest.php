<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client\Tests\Model;

use PHPUnit\Framework\TestCase;
use Silverstripe\Search\Client\Model\Search\Tags;

class TagsTest extends TestCase
{

    public function testGetTags(): void
    {
        $tags = new Tags(['tag-one', 'tag-two']);

        $this->assertSame(['tag-one', 'tag-two'], $tags->getTags());
    }

    public function testJsonSerialize(): void
    {
        $tags = new Tags(['tag-one', 'tag-two']);

        $this->assertSame(
            ['tags' => ['tag-one', 'tag-two']],
            $tags->jsonSerialize(),
        );
    }

    public function testJsonSerializeEmpty(): void
    {
        $tags = new Tags([]);

        $this->assertSame(
            ['tags' => []],
            $tags->jsonSerialize(),
        );
    }

}
