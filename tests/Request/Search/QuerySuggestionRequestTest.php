<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client\Tests\Request\Search;

use PHPUnit\Framework\TestCase;
use Silverstripe\Search\Client\Request\Search\QuerySuggestionRequest;

class QuerySuggestionRequestTest extends TestCase
{

    public function testDefaults(): void
    {
        $request = new QuerySuggestionRequest('test query');

        $this->assertSame('test query', $request->getQuery());
        $this->assertSame(10, $request->getSize());
        $this->assertNull($request->getFields());
    }

    public function testJsonSerializeDefaults(): void
    {
        $request = new QuerySuggestionRequest('test query');

        $this->assertSame(
            ['query' => 'test query', 'size' => 10],
            $request->jsonSerialize(),
        );
    }

    public function testJsonSerializeFull(): void
    {
        $request = new QuerySuggestionRequest('test query');
        $request->setSize(5);
        $request->setFields(['title', 'description']);

        $this->assertSame(
            [
                'query' => 'test query',
                'size' => 5,
                'fields' => ['title', 'description'],
            ],
            $request->jsonSerialize(),
        );
    }

    public function testFluentSetters(): void
    {
        $request = new QuerySuggestionRequest('test');

        $this->assertSame($request, $request->setSize(5));
        $this->assertSame($request, $request->setFields(['title']));
    }

}
