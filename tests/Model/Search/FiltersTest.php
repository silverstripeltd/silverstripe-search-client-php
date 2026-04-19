<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client\Tests\Model\Search;

use PHPUnit\Framework\TestCase;
use Silverstripe\Search\Client\Model\Search\Filters;
use stdClass;

class FiltersTest extends TestCase
{

    public function testDefaultSerializesToEmptyObject(): void
    {
        $filters = new Filters();

        $this->assertNull($filters->getAll());
        $this->assertNull($filters->getAny());
        $this->assertNull($filters->getNone());
        $this->assertInstanceOf(stdClass::class, $filters->jsonSerialize());
        $this->assertSame('{}', json_encode($filters));
    }

    public function testWithAllFilter(): void
    {
        $filters = new Filters();
        $filters->setAll([['status' => 'published']]);

        $this->assertSame(
            ['all' => [['status' => 'published']]],
            $filters->jsonSerialize(),
        );
    }

    public function testWithAnyFilter(): void
    {
        $filters = new Filters();
        $filters->setAny([['category' => 'news'], ['category' => 'blog']]);

        $this->assertSame(
            ['any' => [['category' => 'news'], ['category' => 'blog']]],
            $filters->jsonSerialize(),
        );
    }

    public function testWithNoneFilter(): void
    {
        $filters = new Filters();
        $filters->setNone([['status' => 'archived']]);

        $this->assertSame(
            ['none' => [['status' => 'archived']]],
            $filters->jsonSerialize(),
        );
    }

    public function testNestedFilters(): void
    {
        $inner = new Filters();
        $inner->setAny([['category' => 'news'], ['category' => 'blog']]);

        $outer = new Filters();
        $outer->setAll([$inner, ['status' => 'published']]);

        $result = json_decode(json_encode($outer), true);

        $this->assertCount(2, $result['all']);
        $this->assertArrayHasKey('any', $result['all'][0]);
    }

    public function testWithAllThreeFilters(): void
    {
        $filters = new Filters();
        $filters->setAll([['status' => 'published']]);
        $filters->setAny([['category' => 'news']]);
        $filters->setNone([['type' => 'draft']]);

        $result = $filters->jsonSerialize();

        $this->assertArrayHasKey('all', $result);
        $this->assertArrayHasKey('any', $result);
        $this->assertArrayHasKey('none', $result);
    }

    public function testFluentSetters(): void
    {
        $filters = new Filters();

        $this->assertSame($filters, $filters->setAll([]));
        $this->assertSame($filters, $filters->setAny([]));
        $this->assertSame($filters, $filters->setNone([]));
    }

}
