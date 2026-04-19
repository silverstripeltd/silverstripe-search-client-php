<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client\Tests\Request\Search;

use PHPUnit\Framework\TestCase;
use Silverstripe\Search\Client\Request\Search\SpellingSuggestionRequest;

class SpellingSuggestionRequestTest extends TestCase
{

    public function testDefaults(): void
    {
        $request = new SpellingSuggestionRequest('tset', ['title']);

        $this->assertSame('tset', $request->getQuery());
        $this->assertSame(['title'], $request->getFields());
        $this->assertSame(1, $request->getSize());
        $this->assertFalse($request->isFormatted());
    }

    public function testJsonSerializeDefaults(): void
    {
        $request = new SpellingSuggestionRequest('tset', ['title', 'body']);

        $this->assertSame(
            [
                'query' => 'tset',
                'fields' => ['title', 'body'],
                'size' => 1,
                'formatted' => false,
            ],
            $request->jsonSerialize(),
        );
    }

    public function testJsonSerializeCustom(): void
    {
        $request = new SpellingSuggestionRequest('tset', ['title']);
        $request->setSize(3);
        $request->setFormatted(true);

        $this->assertSame(
            [
                'query' => 'tset',
                'fields' => ['title'],
                'size' => 3,
                'formatted' => true,
            ],
            $request->jsonSerialize(),
        );
    }

    public function testFluentSetters(): void
    {
        $request = new SpellingSuggestionRequest('test', ['title']);

        $this->assertSame($request, $request->setSize(5));
        $this->assertSame($request, $request->setFormatted(true));
    }

}
